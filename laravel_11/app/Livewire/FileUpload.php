<?php

namespace App\Livewire;

use Livewire\Component;

class FileUpload extends Component
{
    use WithFileUploads;

    public $photo;

    public function render()
    {
        return view('livewire.file-upload');
    }

    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'image|max:1024', // 1MB Max
        ]);
    }

    public function save()
    {
        $this->validate([
            'photo' => 'image|max:1024', // 1MB Max
        ]);

        $this->photo->store('photos');

        session()->flash('message', 'Photo successfully uploaded.');
    }

    public function export()
    {
        return response()->download(storage_path('app/photos/'.$this->photo->hashName()));
    }
}
