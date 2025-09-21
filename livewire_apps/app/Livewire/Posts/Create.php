<?php 

    namespace App\Livewire\Posts;

    use App\Models\Post;
    use Livewire\Component;

    class Create extends Component
    {   
        public $title, $content;
        
        protected $rules = [
            'title' => 'required|min:3|max:255',
            'content' => 'nullable|string|max:500',
        ];
         
        public function save()
        {
            $this->validate();
            Post::create([
                'title' => $this->title,
                'content' => $this->content,
            ]);
            session()->flash('success', __('Post created successfully!'));

            return redirect()->route('posts.index');
        }

        public function render()
        {
            return view('livewire.posts.create');
        }
}

