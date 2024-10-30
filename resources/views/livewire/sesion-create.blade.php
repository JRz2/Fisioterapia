<div>
    <div>
        <!-- Botón para agregar sesión -->
        <x-button 
            wire:click="create" 
            class=" text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300">
            Agregar Sesion
        </x-button> 
        <div class="mt-4">
            <form wire:submit="save">
                <x-dialog-modal wire:model="opencreate" maxWidth="2xl">
                    <x-slot name="title">
                        <div class="text-2xl font-bold text-gray-900 border-b pb-2">
                            NUEVA SESIÓN
                        </div>
                    </x-slot>
                
                    <x-slot name="content">
                        <div class="bg-white shadow-lg rounded-lg p-6 flex flex-col h-[60vh]">
                            <div class="flex-grow flex gap-6 overflow-auto">
                                <!-- Columna de datos básicos -->
                                <div class="w-1/3 space-y-4">
                                    <x-label class="text-sm font-semibold text-gray-700">
                                        Fecha:
                                    </x-label>
                                    <input wire:model="fecha" type="date" class="w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                
                                    <x-label class="text-sm font-semibold text-gray-700 mt-4">
                                        Anexos:
                                    </x-label>
                                    <input type="file" wire:model="ruta" multiple class="w-full p-2 border border-gray-300 rounded-lg shadow-sm">
                                    @error('ruta.*') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                
                                <!-- Columna de sintomatología y observaciones -->
                                <div class="w-1/3 space-y-4">
                                    <x-label class="text-sm font-semibold text-gray-700">
                                        Sintomatología
                                    </x-label>
                                    <x-textarea wire:model="sintoma" class="resize-none h-[30%] w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    </x-textarea>
                
                                    <x-label class="text-sm font-semibold text-gray-700 mt-4">
                                        Observación
                                    </x-label>
                                    <x-textarea wire:model="observacion" class="resize-none h-[30%] w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    </x-textarea>
                                </div>
                
                                <!-- Columna de recomendaciones y tratamiento -->
                                <div class="w-1/3 space-y-4">
                                    <x-label class="text-sm font-semibold text-gray-700">
                                        Recomendaciones
                                    </x-label>
                                    <x-textarea wire:model="recomendacion" class="resize-none h-[30%] w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    </x-textarea>
                
                                    <x-label class="text-sm font-semibold text-gray-700 mt-4">
                                        Plan de tratamiento
                                    </x-label>
                                    <x-textarea wire:model="tratamiento" class="resize-none h-[30%] w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    </x-textarea>
                                </div>
                            </div>
                        </div>
                    </x-slot>
                
                    <x-slot name="footer">
                        <div class="w-full flex justify-end bg-gray-100">
                            <x-danger-button wire:click="keyrand" x-on:click="show = false">
                                Cancelar
                            </x-danger-button>
                
                            <x-button>
                                Guardar
                            </x-button>
                        </div>
                    </x-slot>
                </x-dialog-modal>
            </form>
        </div>
    </div>
    
</div>
