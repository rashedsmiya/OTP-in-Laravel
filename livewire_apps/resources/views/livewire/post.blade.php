<section>
    <div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Posts</h1>

    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-2 rounded mb-3">
            {{ session('success') }}
        </div>
    @endif

        <div class="flex justify-between mb-4">
            <input type="text" wire:model.live="search" placeholder="Search..."
                class="border rounded p-2 w-1/3">
                    
        <button wire:click="$toggle('createMode')"
            class="bg-blue-500 text-white px-4 py-2 rounded">
        + Create
        </button>       
        </div>
            
         @if($createMode)
            <div class="bg-gray-500 p-4 rounded mb-4">
                <input type="text" wire:model="title" placeholder="Title" class="border p-2 rounded w-full mb-2">
                <textarea wire:model="content" placeholder="Content" class="border p-2 rounded w-full mb-2"></textarea>
                <button wire:click="create" class="bg-green-500 text-white px-4 py-2 rounded">Save</button>
                <button wire:click="$set('createMode', false)" class="bg-red-500 text-white px-4 py-2 rounded">Cancel</button>
            </div>
        @endif


    @if($editId)
    <div class="mb-4 p-4 border rounded bg-gray-500">
        <h2 class="text-lg font-bold mb-2">Edit Post</h2>

        <input type="text" wire:model="title" 
               class="border rounded p-2 w-full mb-2" placeholder="Title">

        <textarea wire:model="content" 
                  class="border rounded p-2 w-full mb-2" placeholder="Content"></textarea>

        <button wire:click="update" 
                class="bg-green-500 text-white px-4 py-2 rounded">Update</button>

        <button wire:click="$set('editId', null)" 
                class="bg-gray-500 text-white px-4 py-2 rounded ml-2">Cancel</button>
        </div>
    @endif       
    <table class="w-full border-collapse border">
                
        <thead>
        <tr class="bg-gray-600">
            <th class="border p-2">ID</th>
            <th class="border p-2">All</th>
            <th class="border p-2">Title</th>
            <th class="border p-2">Content</th>
            <th class="border p-2">Action</th>
            <th class="border p-2">Active</th>
        </tr>   
        </thead>

        <tbody> 
        @forelse($posts as $post)
            <tr>

                <td class="border p-2">{{ $post->id }}</td>
                <td class="border p-2">{{ $post->title }}</td>
                <td class="border p-2">{{ Str::limit($post->content, 50) }}</td>
                
                <td class="border p-2">
                    <button wire:click="edit({{ $post->id }})" class="text-blue-600">Edit</button> |
                    <button wire:click="delete({{ $post->id }})" class="text-red-600">Delete</button>
                </td>
                
                <td class="border p-2">
                    <button wire:click="active({{ $post->active }})" class="text-green-600">Actiove</button> |
                    <button wire:click="enabled({{ $post->inactive }})" class="text-yellow-600">Inactive</button>
                </td>
            </tr>
            
        @empty 
        
            <tr>
                <td colspan="4" class="text-center p-3">No posts found.</td>
            </tr>
            
        @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $posts->links() }}
    </div>
</div>

</section>