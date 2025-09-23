<div>

    <h1>Student Registration</h1>

    @if (session()->has('success'))
    
        <p style="color: green;">
            {{ session('success') }}
        </p>
        
    @endif
    
    <form wire:submit.prevent="submit">
        <input type="text" placeholder="Name" wire:model="name">
        @error('name') <span class="error">{{ $message }}</span> @enderror    
        <br>
        <br>
        <input type="text" placeholder="Roll No" wire:model="rollno">
        @error('rollno') <span class="error">{{ $message }}</span> @enderror    
        <br>
        <br>
        <input type="email" placeholder="Email" wire:model="email">
        @error('email') <span class="error">{{ $message }}</span> @enderror    
        <br>
        <br>
        <button type="submit">Save</button>
    </form>

</div>
      