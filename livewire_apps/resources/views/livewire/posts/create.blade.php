<div class="p-6 max-w-lg mx-auto">
    <h2 class="text-xl font-semibold mb-4">Create Post</h2>

    <form wire:submit.prevent="save">
        <div class="mb-3">
            <label class="block mb-1">Title</label>
            <input type="text" wire:model="title" class="border p-2 w-full rounded">
            @error('title') <span class="text-red-600 text-sm">{{ $message }}</span>@enderror
        </div>

        <div class="mb-3">
            <label class="block mb-1">Content</label>
            <textarea wire:model="content" class="border p-2 w-full rounded"></textarea>
            @error('content') <span class="text-red-600 text-sm">{{ $message }}</span>@enderror
        </div>

        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Save</button>
        <a href="{{ route('posts.index') }}" class="ml-2 text-gray-600">Cancel</a>
    </form>
</div>
