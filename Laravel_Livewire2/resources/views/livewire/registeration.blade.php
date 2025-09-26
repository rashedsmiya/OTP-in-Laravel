<div>
    <h1>Student Registeration</h1>

    <form wire:submit.prevent="submit">

        <input type="text" placeholder="Name" wire:model="name">
        @error('name') <span class="error">{{ $message }}</span> @enderror
        <br>
        <input type="number" placeholder="Roll No" wire:model="rollno">
        @error('rollno') <span class="error">{{ $message }}</span> @enderror
        <br>        
        <input type="email" placeholder="Email" wire:model="email">
        @error('email') <span class="error">{{ $message }}</span> @enderror
        <br>
        <button type="submit">Save</button>
   
    </form>
</div>
