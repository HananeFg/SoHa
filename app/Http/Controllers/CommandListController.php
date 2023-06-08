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
    public function commandList()
    {
        $factures = Factures::with('tables','serveurs')->paginate(5);

        return view('commandList', compact('factures'));
    }
    public function command()
    {
        $factures = Factures::with('tables','serveurs')->paginate(5);

        return view('command', compact('factures'));
    }

}
