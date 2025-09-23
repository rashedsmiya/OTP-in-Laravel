<div>
    
    @if($check == true)

    <h1>Update Update</h1>
 
    <form wire:submit.prevent="updateStudent">

        <input type="text" placeholder="Name" wire:model="name">
        @error('name') <span class="error">{{ $message }}</span> @enderror    
        <br>
        <br>
        <input type="number" placeholder="Roll No" wire:model="rollno">
        @error('rollno') <span class="error">{{ $message }}</span> @enderror    
        <br>
        <br>
        <input type="email" placeholder="Email" wire:model="email">
        @error('email') <span class="error">{{ $message }}</span> @enderror    
        <br>
        <br>
        <button type="submit">Update</button>

    </form>

    @else
        @if (@session()->has('success'))
            <p style="color: green;">
                {{ session('success') }}
            </p>
        @endif
        <livewire:student-list />
    
    @endif

</div>
