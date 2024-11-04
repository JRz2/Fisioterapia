<div>
    <div class="informe-container">
        <form wire:submit="save">
            <div class="informe-body">
                <div class="informe-section">
                    <label><strong>Fecha:</strong></label>
                    <input wire:model="fecha" type="date" class="input-text">
                </div>

                <div class="informe-section">
                    <label><strong>Dx:</strong></label>
                    <input wire:model="diagnostico" type="text" class="input-text">
                </div>

           

                <div id="editor-container" style="height: 300px;"></div>
                <input type="hidden" wire:model="informe" id="contenido">

                <div class="informe-section">
                    <label><strong>Rehabilitación fisioterapéutica y kinesiología:</strong></label>
                    <textarea wire:model="rehabilitacion"></textarea>
                </div>

                <div class="informe-section">
                    <label><strong>Recomendaciones:</strong></label>
                    <textarea wire:model="recomendacion"></textarea>
                </div>

                <div class="informe-section">
                    <label><strong>Nota:</strong></label>
                    <textarea wire:model="nota"></textarea>
                </div>
            </div>

            <div>
                <x-button>
                    Guardar
                </x-button>
            </div>  
        </form>
        @if ($consulta->reporte)
        <a class="btn btn-info" href="{{ url('/doctor/reporte/pdf/' . $consulta->id) }}"><i class="fa fa-print"></i>
            IMPRIMIR PDF</a>           
        @endif
    </div>
</div>
