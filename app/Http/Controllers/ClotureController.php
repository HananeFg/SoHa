<?php

namespace App\Http\Controllers;

use App\Models\Details;
use App\Models\Factures;
use App\Models\Category;
use App\Models\Cloture;
use App\Models\Serveurs;
use App\Models\Menu;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

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

        $menus = Menu::all();
        $menuData = [];
        
        foreach ($menus as $menu) {
            $menuTotalAmount = Factures::join('details', 'factures.id', '=', 'details.facture_id')
                ->where('details.produit_id', $menu->id)
                ->whereDate('factures.created_at', $today) // Filter by today's date
                ->sum('details.montant');
        
            $menuTotalQuantity = Factures::join('details', 'factures.id', '=', 'details.facture_id')
                ->where('details.produit_id', $menu->id)
                ->whereDate('factures.created_at', $today) // Filter by today's date
                ->sum('details.quantity');
        
            $menuData[] = [
                'menu' => $menu->title,
                'totalAmount' => $menuTotalAmount,
                'totalQuantity' => $menuTotalQuantity,
            ];
        }

        $totalAmountCash = DB::table('factures')
            ->where('payment_type', 'cash')
            ->whereDate('datetime_facture', $today)
            ->sum('total_price');
        
        $totalAmountCard = DB::table('factures')
            ->where('payment_type', 'card')
            ->whereDate('datetime_facture', $today)
            ->sum('total_price');
        
        $totalAmountGratuit = DB::table('factures')
            ->where('payment_type', 'gratuit')
            ->whereDate('datetime_facture', $today)
            ->sum('total_price');

            $servers = Serveurs::all();
            $serverData = [];
            $totalAmountDay = 0; // Variable to store the total amount of the day
            
            foreach ($servers as $server) {
                $serverTotalAmount = Factures::where('serveur_id', $server->id)
                    ->whereDate('datetime_facture', $today)
                    ->sum('total_price');
            
                $serverData[] = [
                    'server' => $server->name,
                    'totalAmount' => $serverTotalAmount,
                ];
                
                $totalAmountDay += $serverTotalAmount; // Increment the day's total amount
            }
        
            $cloture = Cloture::latest()->first();
        
            return view("cloture")
                ->with('categoryData', $categoryData)
                ->with('menuData', $menuData)
                ->with('totalAmountCash', $totalAmountCash)
                ->with('totalAmountCard', $totalAmountCard)
                ->with('totalAmountGratuit', $totalAmountGratuit)
                ->with('serverData', $serverData)
                ->with('totalAmountDay', $totalAmountDay) // Pass the day's total amount to the view
                ->with('cloture', $cloture);
        }
        public function store(Request $request)
    {
        $cloture = new Cloture();
        $cloture->dateImpression = now(); // Date d'impression actuelle
        $cloture->dateOuverture = $request->input('ouverture');
        $cloture->dateFermeture = $request->input('fermeture');
        $cloture->save();

        // Rediriger l'utilisateur vers une autre page ou afficher un message de succès
        return redirect()->route('cloture')->with('success', 'Clôture enregistrée avec succès.')->with('cloture', $cloture);;
    }

    public function create()
{
    return view('cloture');
}
    
}
 