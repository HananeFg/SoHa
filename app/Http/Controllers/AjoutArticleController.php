<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Menu;
use DB;
use Illuminate\Support\Facades\Storage;

class AjoutArticleController extends Controller
{
    public function index() {
     $categories = Category::all();
    return view('ajoutArticle', compact('categories'));

    }
  
    public function store(Request $request)
    {
        // Validate the form data
        
        $validatedData = $request->validate([
            'title' => 'required',
            'slug' => 'required',
            'unit_price' => 'required|numeric',
            'TVA' => 'required|numeric',
            'image' => 'required|image',
            'category_id' => 'required|exists:categories,id',
        ]);
        
        // Upload the image file
      
      
        $imagePath = Storage::disk('public')->put('articleImage', $request->file('image'));
        $imageUrl = asset('articleImage/' . $imagePath);
        $TTC_price = $validatedData['unit_price'] + $validatedData['TVA'];
        
        // Create a new Article instance
        $article = new Menu();
        $article->title = $validatedData['title'];
        $article->slug = $validatedData['slug'];
        $article->unit_price = $validatedData['unit_price'];
        $article->TVA = $validatedData['TVA'];
        $article->TTC_price = $TTC_price;
        $article->image = $imagePath;
        $article->category_id = $validatedData['category_id'];
        
        $article->save();
     

            // Clear the form input fields
        $request->session()->flash('success', 'Article added successfully');
        
        // Redirect back to the form with an empty form
        return redirect()->route('ajoutArticle');
        
       
    }
}

