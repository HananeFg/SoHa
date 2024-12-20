<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use DB;

class AjoutCategoryController extends Controller
{
   
    public function index() {
     
    return view('ajoutCategory');

    }

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
        return redirect()->route('ajoutCategory');
        
       
    }
}

