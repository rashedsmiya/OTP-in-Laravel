<div>

    @if ($check == true)
     <h1>Student List </h1>
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Roll No</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
            <tr>
                <td>{{ $student['id'] }}</td>
                <td>{{ $student['name'] }}</td>
                <td>{{ $student['rollno'] }}</td>
                <td>{{ $student['email'] }}</td>
                <td> 
                    <button wire:click="updateData({{ $student['id'] }})">Edit</button> 
                    <button wire:click="deleteStudent({{ $student['id'] }})">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
            
    <livewire:student-update :s_id="$s_id" :name="$name" :rollno="$rollno" :email="$email"/>

    @endif

   
</div>