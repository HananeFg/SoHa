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
use App\Http\Controllers\PdfController;
use Illuminate\Support\Facades\View;
use Dompdf\Dompdf;
use Dompdf\FrameDecorator\Table;
use Illuminate\Support\Facades\Http;

class MenuController extends Controller
{
    /**
     * 
     * Display a listing of the resource.
     */
    private $factureId;

  
   
    

    // 
    public function menu(Request $request)
    {

        $categories = Category::all();
        $tables = Tables::all();
        $servers = Serveurs::all();
       
        $showPopup = false;
        
        $selectedCategory = $request->input('category_id');
        $menus = Menu::when($selectedCategory, function ($query) use ($selectedCategory) {
            return $query->where('category_id', $selectedCategory);
        })->get();
      
        $facture = new Factures();
        $facture->datetime_facture=date('Y-m-d H:i:s');
        $facture->save();        
        session(['factureId' => $facture->id]);
        // dd(($this->factureId));
        // dd($categories, $menus);
      
        return view('menu', compact('categories','showPopup','servers','facture', 'menus','tables', 'selectedCategory'));
    } 

    public function menuId(Request $request,$variable)
    {

        $categories = Category::all();
        $tables = Tables::all();
        $servers = Serveurs::all();     
        $showPopup = false;
        $selectedCategory = $request->input('category_id');
        $menus = Menu::when($selectedCategory, function ($query) use ($selectedCategory) {
            return $query->where('category_id', $selectedCategory);
        })->get();
       
        $facture = Factures::where('id',$variable)->first();
        
        session(['factureId' => $variable]);
        // dd(($this->factureId));
        // dd($categories, $menus);
      
        return view('menu', compact('categories','showPopup','servers','facture', 'menus','tables', 'selectedCategory'));
    }

    public function printTicket()
   {
    $tableId = session('tableId');
    $serverId = session('serverId');
    $factureId = session('factureId');
    try {
        $items = Details::join('menus', function ($join) {
            $join->on('details.produit_id', '=', 'menus.id');
        })
        ->where('details.facture_id', $factureId)
        ->select('menus.*', 'menus.title as product_name', 'details.quantity as quantity')
        ->get();

        // $quantity =Details
        $facture = Factures::where('id',$factureId)->get();
        $server = Serveurs::where('id',$serverId)->get();
        $table = Tables::where('id',$tableId)->get();
      
        $dompdf = new Dompdf();
        
        $html = View::make('ticket', ['items' => $items ,'factureId' => $factureId,'table' => $table,'server' => $server ,'facture' => $facture])->render();
        $dompdf->loadHtml($html);
      
        $dompdf->render();

        
        $dompdf->stream('document.pdf');


    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()]);
    }
    // return response()->json(['success' => false, 'message' => $e->getMessage()]);
   }

   public function printForClient(){
    $tableId = session('tableId');
    $serverId = session('serverId');
    $factureId = session('factureId');
    try {
        $items = Details::join('menus', function ($join) {
            $join->on('details.produit_id', '=', 'menus.id');
        })
        ->where('details.facture_id', $factureId)
        ->select('menus.*', 'menus.title as product_name', 'details.quantity as quantity','details.montant as price')
        ->get();
        $totalSum = 0;
        foreach ($items as $item) {
            $totalSum += $item->price ;
        }
        Factures::where('id', $factureId)->update([
            'total_price' => $totalSum
        ]);


        // $quantity =Details
        $facture = Factures::where('id',$factureId)->get();
        $facturee= Factures::where('id',$factureId)->get();
        $server = Serveurs::where('id',$serverId)->get();
        $table = Tables::where('id',$tableId)->get();
        // dd(($table));
        // dd(($items));
        // $items = Details::where('facture_id', $factureId);
        // dd($items);
        $dompdf = new Dompdf();
        
        $html = View::make('ticketForClient', ['items' => $items ,'factureId' => $factureId,'table' => $table,'server' => $server , 'facture' => $facture ,'facturee' => $facturee])->render();
        $dompdf->loadHtml($html);
        
        // Set paper size and orientation
        // $dompdf->setPaper('80mm', 'auto');

        // Render the PDF
        $dompdf->render();

        // Output the PDF as a stream or save it to a file
        // $output = $dompdf->output();

        $dompdf->stream('document.pdf');


    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()]);
    }
      

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
        session(['tableId' =>  $tableId]);
        session(['serverId' =>  $serverId]);

        
        $facture = Factures::where('id', $request->input('factureId'))->update([
        'table_id' => $tableId,
        'serveur_id' => $serverId  
        ]);
        
        // dd(($facteur));

        return response()->json(['success' => true]);
    }

    public function insertPayment(){

}
   
}
