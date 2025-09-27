<?php

namespace App\Livewire;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Models\Imgconsulta;

class ConsultaImg extends Component
{
    use WithFileUploads;         
    public $openadd = false;
    public $imagen = [];
    public $consultaId;

    protected $rules = [
        'imagen.*' => 'image|max:10240', // 10MB por imagen (ajusta si quieres)
    ];

    public function mount($consultaId){
        $this->consultaId = $consultaId;
    }

    /*public function saveadd(){  
        if ($this->imagen) {
            foreach ($this->imagen as $img) {
                $path = $img->store('consultas'); 
                Imgconsulta::create([
                    'consulta_id' => $this->consultaId, 
                    'ruta' => $path,
                ]);
            }
        }
        $this->dispatch('imgexamen-created');
        $this->dispatch('swal:success', [
            'title' => 'Imagenes',
            'text' => 'Guardado Correctamente',
        ]);
        $this->reset('imagen');
        $this->openadd = false;
    }*/

    public function saveadd()
    {
        $this->validate();

        if ($this->imagen && count($this->imagen) > 0) {
            foreach ($this->imagen as $uploaded) {
                // Guardar el archivo localmente en storage (opcional, útil para referencia)
                $path = $uploaded->store('consultas', 'public'); // storage/app/public/consultas/...
                
                // Preparamos Data URI (base64). Intentamos redimensionar/comprimir si Intervention está disponible.
                $useIntervention = class_exists(\Intervention\Image\ImageManagerStatic::class);
                $maxDimension = 1024; // px máximo ancho/alto al redimensionar
                $quality = 80; // calidad JPEG 0-100 si se reencodea

                try {
                    if ($useIntervention) {
                        // Si tienes intervention/image instalado
                        // composer require intervention/image
                        $img = \Intervention\Image\ImageManagerStatic::make($uploaded->getRealPath());

                        // Redimensionar manteniendo aspect ratio si es demasiado grande
                        if ($img->width() > $maxDimension || $img->height() > $maxDimension) {
                            $img->resize($maxDimension, $maxDimension, function ($constraint) {
                                $constraint->aspectRatio();
                                $constraint->upsize();
                            });
                        }

                        // Re-encode según mime para controlar tamaño
                        $mime = $uploaded->getClientMimeType() ?? 'image/jpeg';
                        if (Str::contains($mime, ['png'])) {
                            $encoded = (string) $img->encode('png');
                            $prefix = 'data:image/png;base64,';
                        } else {
                            // jpeg por defecto
                            $encoded = (string) $img->encode('jpg', $quality);
                            $prefix = 'data:image/jpeg;base64,';
                        }

                        $base64 = base64_encode($encoded);
                        $dataUri = $prefix . $base64;
                    } else {
                        // Si no está Intervention, usamos el fichero original (puede ser grande)
                        $realPath = $uploaded->getRealPath();
                        $mime = $uploaded->getClientMimeType() ?: mime_content_type($realPath);
                        $base64 = base64_encode(file_get_contents($realPath));
                        $dataUri = "data:{$mime};base64,{$base64}";
                    }
                } catch (\Exception $e) {
                    Log::error('Error creando Data URI: '.$e->getMessage(), ['file' => $uploaded->getClientOriginalName()]);
                    // fallback: intentar con el archivo crudo
                    $realPath = $uploaded->getRealPath();
                    $mime = $uploaded->getClientMimeType() ?: mime_content_type($realPath);
                    $base64 = base64_encode(@file_get_contents($realPath));
                    $dataUri = "data:{$mime};base64,{$base64}";
                }

                // Llamada a Meshy con Data URI
                $taskId = null;
                try {
                    $response = Http::withToken(config('services.meshy.key'))
                        ->timeout(30) // ajusta timeout si tus imágenes son grandes
                        ->post('https://api.meshy.ai/openapi/v1/image-to-3d', [
                            'image_url' => $dataUri,
                            'enable_pbr' => true,
                            'should_remesh' => true,
                            'should_texture' => true,
                        ]);

                    if ($response->successful()) {
                        $taskId = $response->json('result') ?? null;
                    } else {
                        Log::warning('Meshy responded non-success', [
                            'status' => $response->status(),
                            'body' => $response->body(),
                            'file' => $path,
                        ]);
                    }
                } catch (\Exception $e) {
                    Log::error('Exception calling Meshy: '.$e->getMessage(), ['file' => $path]);
                }

                // Guardar registro en BD (campos meshy_* asumidos en tu migracion)
                Imgconsulta::create([
                    'consulta_id'   => $this->consultaId,
                    'ruta'          => $path,
                    'meshy_task_id' => $taskId,
                    'meshy_status'  => null,
                ]);
            }
        }

        $this->dispatchBrowserEvent('imgexamen-created');
        $this->dispatchBrowserEvent('swal:success', [
            'title' => 'Imágenes',
            'text'  => 'Guardado correctamente y tarea enviada a Meshy',
        ]);

        $this->reset('imagen');
        $this->openadd = false;
    }

    public function checkMeshyTasks()
    {
        $imgs = Imgconsulta::where('consulta_id', $this->consultaId)
            ->whereNotNull('meshy_task_id')
            ->where(function ($q) {
                $q->whereNull('meshy_status')
                  ->orWhereIn('meshy_status', ['PENDING', 'IN_PROGRESS']);
            })->get();

        foreach ($imgs as $img) {
            try {
                $res = Http::withToken(config('services.meshy.key'))
                    ->timeout(10)
                    ->get("https://api.meshy.ai/openapi/v1/image-to-3d/{$img->meshy_task_id}");

                if ($res->successful()) {
                    $data = $res->json();
                    $img->meshy_status = $data['status'] ?? $img->meshy_status;
                    $img->meshy_progress = $data['progress'] ?? $img->meshy_progress;
                    $img->meshy_result = $data;
                    $img->save();
                } else {
                    Log::warning('Meshy check failed', [
                        'id' => $img->meshy_task_id,
                        'status' => $res->status(),
                        'body' => $res->body(),
                    ]);
                }
            } catch (\Exception $e) {
                Log::error('Error checking Meshy task: ' . $e->getMessage(), [
                    'task' => $img->meshy_task_id,
                ]);
            }
        }
    }

    public function cancelar(){
        $this->reset('imagen');
    }

    public function create(){
        $this->openadd = true;
    }

    public function render()
    {
         $imagenes = Imgconsulta::where('consulta_id', $this->consultaId)->get();
        return view('livewire.consulta-img', compact('imagenes'));
        //return view('livewire.consulta-img');
    }
}
