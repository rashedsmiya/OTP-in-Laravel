<?php

namespace App\Livewire;

use App\Models\Student;
use Livewire\Component;

class StudentUpdate extends Component
{
    public $s_id;

    public $name;

    public $email;

    public $rollno;

    public $check = true;

    public function render()
    {
        return view('livewire.student-update');
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required',
            'rollno' => 'required|min:3|max:10',
            'email' => 'required|email',
        ]);
    }

    public function updateStudent()
    {
        $this->validate([
            'name' => 'required',
            'rollno' => 'required|min:3|max:10',
            'email' => 'required|email',
        ]);

        $student = Student::find($this->s_id);
        $student->name = $this->name;
        $student->email = $this->email;
        $student->rollno = $this->rollno;
        $student->save();
        session()->flash('Success', 'Student Updated Successfully');
        $this->check = false;
    }
}
