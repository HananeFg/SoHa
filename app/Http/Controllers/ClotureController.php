<?php

namespace App\Http\Controllers;

use App\Models\Details;
use App\Models\Factures;
use App\Models\Category;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ClotureController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $categoryData = [];

        // Get today's date
        $today = date('Y-m-d');

        foreach ($categories as $category) {
            $categoryTotalAmount = Factures::join('details', 'factures.id', '=', 'details.facture_id')
                ->join('menus', 'details.produit_id', '=', 'menus.id')
                ->where('menus.category_id', $category->id)
                ->whereDate('factures.created_at', $today) // Filter by today's date
                ->sum('details.montant');

            $categoryTotalQuantity = Factures::join('details', 'factures.id', '=', 'details.facture_id')
                ->join('menus', 'details.produit_id', '=', 'menus.id')
                ->where('menus.category_id', $category->id)
                ->whereDate('factures.created_at', $today) // Filter by today's date
                ->sum('details.quantity');

            $categoryData[] = [
                'label' => $category->title,
                'totalAmount' => $categoryTotalAmount,
                'totalQuantity' => $categoryTotalQuantity,
            ];
        }

        return view("cloture")->with('categoryData', $categoryData);
        
        
    }
    
}
 