<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Tables;
use App\Models\Category;
use App\Models\Factures;
use App\Models\Serveurs;
use Illuminate\Http\Request;

class CommandListController extends Controller
{
    //
    public function command()
    {
        $menus = Menu::with('category')->paginate(6);

        return view('commandList', compact('menus'));
    }

    public function commandList()
    {
        $factures = Factures::with('serveurs','tables')->paginate(5);
        $tables = Tables::where('');
        $servers = Serveurs::all();
        $factures = Factures::with('serveurs','tables')->paginate(5);

        return view('commandList', compact('factures',));
    }

    public function menuDetails($id)
    {
        $menu = Menu::find($id);

        return view('menu.details', compact('menu'));
    }

    // public function commandList()
    // {
    //     $menus = Menu::paginate(10);
    //     $facture = Factures::first(); // or some other way to get a Facture instance
        
    //     return view('commandList', [
    //         'menus' => $menus,
    //         'facture' => $facture
    //     ]);
    // }


}
