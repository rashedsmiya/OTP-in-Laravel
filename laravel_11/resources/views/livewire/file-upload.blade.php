<div>
     <h1>File Upload</h1>
     <form wire:submit.prevent="save">
        <input type="file" wire:model="photo">

        @error('photo') <span class="error">{{ $message }}</span>
                    
        @enderror

        <button type="submit">File Upload</button>
     </form>

     <br>
     <br>

     <button wire:click="export">
            File Download
     </button>
</div>