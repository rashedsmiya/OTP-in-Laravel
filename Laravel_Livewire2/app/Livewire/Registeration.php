<?php

namespace App\Livewire;

use Livewire\Component;

class Registeration extends Component
{
    public $name;

    public $rollno;

    public $email;

    public function render()
    {
        return view('livewire.registeration');
    }

    public function submit()
    {
        $this->validate([
            'name' =>'required',
            'rollno' =>'required|min:3   ',
        ]);

        // session()->flash('message', 'Form submitted successfully.');

        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Form submitted successfully.']);
    }
}
