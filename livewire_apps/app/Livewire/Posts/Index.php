<?php

    namespace App\Livewire\Posts;

    use App\Models\Post;
    use Livewire\Component;
    use Livewire\WithPagination;

    use function view;

    class Index extends Component
    {
        use WithPagination;       
        public $createMode = false;
        public $search = '';
        public $editId = null; 
        public $title = '';
        public $content = '';
        public $filter = '';

        public function render()
        {

        $query = Post::query();

        if ($this->filter === 'active') {
            $query->where('status', 1);
            
        } elseif ($this->filter === 'inactive') {
            $query->where('status', 0);
        }

        if ($this->search) {
            $query->where(function ($query) {
                $query->where('title', 'like', "%{$this->search}%")
                    ->orWhere('content', 'like', "%{$this->search}%");
            });
        }

        $posts = $query->paginate(5);

            // $posts = Post::where('title', 'like', "%{$this->search}%")
            //             ->orWhere('content', 'like', "%{$this->search}%")
            //             ->paginate(5);

            return view('livewire.posts.index', compact('posts'));
        }

        // 🔹 Delete Post
        public function delete($id)
        {
            $post = Post::findOrFail($id);
            $post->delete();

            session()->flash('success', 'Post deleted successfully!');
        }

        // 🔹 Load data into form for editing
        public function edit($id)
        {
            $post = Post::findOrFail($id);

            $this->editId = $post->id;
            $this->title = $post->title;
            $this->content = $post->content;
        }

        // 🔹 Update Post
        public function update()
        {
            $this->validate([
                'title' => 'required|min:3',
                'content' => 'required|min:5',
            ]);

            Post::findOrFail($this->editId)->update([
                'title' => $this->title,
                'content' => $this->content,
            ]);

            $this->reset(['editId', 'title', 'content']);
            session()->flash('success', 'Post updated successfully!');
        }

        public function create()
       {
        $this->validate([
            'title' => 'required|min:3',
            'content' => 'required|min:5',
        ]);

        Post::create([
            'title' => $this->title,
            'content' => $this->content,
        ]);

        $this->reset(['title', 'content', 'createMode']);
        session()->flash('success', 'Post created successfully!');
        }
        public function setStatus( $status ){
        $this->filter = $status;
        $this->render();
       }

        public function toggleStatus($id)
       {
        $post = Post::findOrFail($id);
        $post->status = !$post->status;
        $post->save();

        $this->render();
       }

}
