<?php

namespace App\Livewire;

use App\Models\Student;
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

    public function updated($field)
    {
        $this->validateOnly($field, [
            'name' => 'required',
            'rollno' => 'required|min:3|max:10',
            'email' => 'required | email',
        ]);
    }

    public function submit()
    {
        $this->validate([
            'name' => 'required',
            'rollno' => 'required|min:3|max:10',
            'email' => 'required|email|unique:students,email',
        ]);

        $student = new Student;
        $student->rollno = $this->rollno;
        $student->name = $this->name;
        $student->email = $this->email;
        $student->save();
        session()->flash('message', 'Student Added Successfully');
        $this->resetFields();
    }

    public function resetFields()
    {
        $this->reset(['name', 'rollno', 'email']);
    }
}
