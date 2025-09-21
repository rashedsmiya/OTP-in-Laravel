<div>
    <!-- Filter Buttons -->
    <div class="mb-4">
        <button wire:click="setStatus('all')"
            class="px-4 py-2 rounded 
                {{ $status === 'all' ? 'bg-blue-500 text-white' : 'bg-gray-200' }}">
            All
        </button>

        <button wire:click="setStatus('active')"
            class="px-4 py-2 rounded 
                {{ $status === 'active' ? 'bg-green-500 text-white' : 'bg-gray-200' }}">
            Active
        </button>

        <button wire:click="setStatus('inactive')"
            class="px-4 py-2 rounded 
                {{ $status === 'inactive' ? 'bg-red-500 text-white' : 'bg-gray-200' }}">
            Inactive
        </button>
    </div>

    <!-- Posts List -->
    <div>
        @forelse($posts as $post)
            <div class="p-3 border rounded mb-2">
                <h3 class="font-bold">{{ $post->title }}</h3>
                <p>{{ $post->content }}</p>
                <span class="text-sm {{ $post->status ? 'text-green-600' : 'text-red-600' }}">
                    {{ $post->status ? 'Active' : 'Inactive' }}
                </span>
            </div>
        @empty
            <p>No posts found.</p>
        @endforelse
    </div>
</div>
