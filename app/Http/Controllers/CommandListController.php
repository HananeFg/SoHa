<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Category;

class CommandListController extends Controller
{
    //
    public function command()
    {
        $menus = Menu::with('category')->paginate(10);

        return view('commandList', compact('menus'));
    }

    public function menuDetails($id)
    {
        $menu = Menu::find($id);

        return view('menu.details', compact('menu'));
    }

}
