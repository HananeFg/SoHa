<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Tables;
use App\Models\Category;
use App\Models\Factures;
use App\Models\Serveurs;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CommandListController extends Controller
{
    //
    public function commandList()
    {
        $factures = Factures::with('tables','serveurs')->orderBy('created_at', 'desc')
        ->paginate(5);

        return view('commandList', compact('factures'));
    }
    public function command()
    {
      
    $today = Carbon::today();
    $factures = Factures::with('tables', 'serveurs')
        ->whereDate('created_at', $today)
        ->orderBy('created_at', 'desc')
        ->paginate(5);

    return view('command', compact('factures'));
    }
    

}
