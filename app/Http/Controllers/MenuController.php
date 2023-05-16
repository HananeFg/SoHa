<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use App\Models\Category;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMenuRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMenuRequest $request, Menu $menu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        //
    }

    // public function menu()
    // {
    //     $categories = Category::all();
    //     $menus = Menu::all();

    //     return view('menu', compact('categories', 'menus'));
    // }

    public function menu(Request $request)
    {
        $categories = Category::all();
        $selectedCategory = $request->input('category_id');
        $menus = Menu::when($selectedCategory, function ($query) use ($selectedCategory) {
            return $query->where('category_id', $selectedCategory);
        })->get();
    
        // dd($categories, $menus);
        return view('menu', compact('categories', 'menus', 'selectedCategory'));
    }
    

}