<?php

namespace App\Livewire;

use App\Models\Student;
use Livewire\Component;

class StudentList extends Component
{
    public $students;

    public $s_id;

    public $name;

    public $email;

    public $rollno;

    public $check = true;

    public function mount()
    {

        $this->students = Student::all();
    }

    public function render()
    {

        return view('livewire.student-list');
    }

    public function deleteStudent($id)
    {
        $student = Student::find($id);
        if ($student) {
            $student->delete();
            $this->students = Student::all(); // Refresh the list after deletion
        }

    }

    public function updateData($id)
    {
        $this->s_id = $id;
        $student = Student::find($id);
        $this->name = $student->name;
        $this->email = $student->email;
        $this->rollno = $student->rollno;
        $this->check = false;
    }
}
