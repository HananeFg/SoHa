<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view("managements.categories.index")->with([
            "categories" => Category::paginate(5)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("managements.categories.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       // Validate the form data
        
        $validatedData = $request->validate([
            'title' => 'required',
            'slug' => 'required',
            'image' => 'required|image',
        
        ]);
        
        // Upload the image file
        $imagePath = $request->file('image')->store('articleImage', 'public');
        $imageUrl = asset('storage/' . $imagePath);

        // Create a new Article instance
        $category = new Category();
        $category->title = $validatedData['title'];
        $category->slug = $validatedData['slug'];
        $category->image = $imageUrl;
        
        $category->save();
    

        // Clear the form input fields
        $request->session()->flash('success', 'category added successfully');
        
        // Redirect back to the form with an empty form
        return redirect()->route('categories.index');  
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
        return view("managements.categories.edit")->with([
            "category" => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $category)
    {
        //
        $categories = Category::find($category);

        $validData = $request->validate([
            'title' => 'required|unique:categories,title,'.$categories->id,
            'slug' => 'required|boolean',
            'image' => 'required|image',
        ]);
       // Upload the image file
       $imagePath = $request->file('image')->store('articleImage', 'public');
       $imageUrl = asset('storage/' . $imagePath);

        $categories->update([
            "title" => $validData['title'],
            "slug" => Str::slug($validData['name']),
            "image" => $imagePath,
        ]);
        $category->image = $imagePath;

        $request->session()->flash('success', 'Table updated successfully');
        return redirect()->route('tables.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
        $category = $request->category;
    
        //delete table
        $categories = Category::find($category);
        $categories->delete();
    
        //redirect user
        return redirect()->route("categories.index")->with([
            "success" => "category deleted successfully"
        ]);
    }
}
