<div>
    <div>

        <div>
            <input type="file" wire:model="ruta">
            @error('imagenes.*') <span class="error">{{ $message }}</span> @enderror
        </div>

    </div>
</div>
