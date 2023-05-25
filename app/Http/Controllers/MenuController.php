<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use App\Models\Category;
use App\Models\Tables;
use App\Models\User;
use App\Models\Serveurs;
use App\Models\Factures;
use App\Models\Details;





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
        $tables = Tables::all();
        $servers = Serveurs::all();
       

        
        $selectedCategory = $request->input('category_id');
        $menus = Menu::when($selectedCategory, function ($query) use ($selectedCategory) {
            return $query->where('category_id', $selectedCategory);
        })->get();
        $facture = new Factures();
        $facture->datetime_facture=date('Y-m-d H:i:s');
        $facture->save();   
        // dd($categories, $menus);
      
        return view('menu', compact('categories','servers','facture', 'menus','tables', 'selectedCategory'));
    }

    public function printOrder()
    {
    return view('printTicket');
    }

    public function insertProduct(Request $request)
{
    try {
        $item = $request->input('item');
        $factureId = $request->input('facture');

        // Check if the product already exists in the database for the given facture
        $existingDetail = Details::where('produit_id', $item['menuItemId'])
            ->where('facture_id', $factureId)
            ->first();

        if ($existingDetail) {
            $existingDetail->save();
        } else {
            // Create a new entry for the product
                
            $detail = new Details();
            $detail->produit_id = $item['menuItemId'];
            $detail->unit_price = $item['menuItemPrice'];
            $detail->facture_id = $factureId;
            $detail->quantity = $item['quantity'];
            $detail->montant = $item['quantity']*$item['menuItemPrice'];
            $detail->save();
        }
        

        return response()->json(['success' => true, 'message' => 'Product inserted successfully']);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()]);
    }
}

    public function insertData(Request $request)
    {
        $tableId = $request->input('tableId');
        $serverId = $request->input('serverId');
        
        $facture = Factures::where('id', $request->input('factureId'))->update([
        'table_id' => $tableId,
        'serveur_id' => $serverId  
        ]);
        
        // dd(($facteur));

        return response()->json(['success' => true]);
    }

}
