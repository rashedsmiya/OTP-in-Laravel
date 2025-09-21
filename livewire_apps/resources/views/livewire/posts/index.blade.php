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
                  
            <!-- Include this script tag or install `@tailwindplus/elements` via npm: -->
            <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script> 
            <el-dropdown class="relative">
                <a href="#"></a>
            <button class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white/10 px-3 py-2 text-sm font-semibold text-white inset-ring-1 inset-ring-white/5 hover:bg-white/20">
                Filter
                <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="-mr-1 size-5 text-gray-400">
                <path d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" fill-rule="evenodd" />
                </svg>  
            </button>  

            <el-menu anchor="bottom end" popover class="w-56 origin-top-right rounded-md bg-gray-800 outline-1 -outline-offset-1 outline-white/10 transition transition-discrete [--anchor-gap:--spacing(2)] data-closed:scale-95 data-closed:transform data-closed:opacity-0 data-enter:duration-100 data-enter:ease-out data-leave:duration-75 data-leave:ease-in">

                <div class="py-1">
                    <button wire:click="setStatus('all')" class="block px-4 py-2 text-sm text-gray-300 focus:bg-white/5 focus:text-white focus:outline-hidden">All </button>
                    <button wire:click="setStatus('active')"  class="block px-4 py-2 text-sm text-gray-300 focus:bg-white/5 focus:text-white focus:outline-hidden">Active</button>
                    <button wire:click="setStatus('inactive')"  class="block px-4 py-2 text-sm text-gray-300 focus:bg-white/5 focus:text-white focus:outline-hidden">Inactive</button>
                </div>  
                
            </el-menu>
            </el-dropdown>

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
                <td class="border p-2">{{ $post->all }}</td>
                <td class="border p-2">{{ $post->title }}</td>
                <td class="border p-2">{{ Str::limit($post->content, 50) }}</td>
                
                <td class="border p-2">
                    <button wire:click="edit({{ $post->id }})" class="text-blue-600">Edit</button> |
                    <button wire:click="delete({{ $post->id }})" class="text-red-600">Delete</button> |
                    <button wire:click="toggleStatus({{ $post->id }})" class="text-yellow-600">{{ $post->status == 1 ? 'Inactive' : 'Active' }}</button>   
                </td>
                    
                <td class="border p-2">
                  <span>{{ $post->status == 1 ? 'Active ' : 'Inactive' }}</span>
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
