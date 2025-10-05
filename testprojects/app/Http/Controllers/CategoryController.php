<?php

    namespace App\Http\Controllers;

    use App\Models\Category;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Storage;
    class CategoryController extends Controller
    {
        public function index()
        {
            $categories = Category::all();

            return view('category.index', compact('categories'));
        }

        public function create()
        {
            return view('category.create');
        }

        public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $category = new Category;
        // Handle image upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = $request->slug . '-' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('category', $filename, 'public');
            $category->image = $path;
        }

        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->save();
        $request->session()->flash('success', 'Category created successfully');
        return redirect()->route('category.index');
    }

}
