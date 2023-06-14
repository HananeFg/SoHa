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
use App\Models\Payments;
use App\Models\Facture_payment;

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
       
        $showPopup = true;
        
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
        $tableId = session('tableId');
        $serverId = session('serverId');
        $selectedServer = Serveurs::find($serverId);
        $selectedTable = Tables::find($tableId);
      
        return view('menu', compact('categories','showPopup','servers','facture', 'menus','tables','selectedServer','selectedTable' , 'selectedCategory'));
    }

    public function printTicket()
   {
    $tableId = session('tableId');
    $serverId = session('serverId');
    $factureId = session('factureId');
    
    try {
         $item = Details::join('menus', function ($join) {
                $join->on('details.produit_id', '=', 'menus.id');
            })
            ->where('details.facture_id', $factureId)
            ->select('menus.*', 'menus.title as product_name', 'details.quantity as quantity','details.montant as price')
            ->get();
            $totalSum = 0;
            foreach ($item as $itemd) {
                $totalSum += $itemd->price ;
            }
            Factures::where('id', $factureId)->update([
                'total_price' => $totalSum
            ]);

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
    $factureId = session('factureId');
    $tableId = $request->input('tableId');
    $serverId = $request->input('serverId');
    session(['tableId' => $tableId]);
    session(['serverId' => $serverId]);

    Factures::where('id', $factureId)->update([
        'table_id' => $tableId,
        'serveur_id' => $serverId
    ]);

    Tables::where('id', $tableId)->update([
        'status' => 1
    ]);

    $selectedServer = Serveurs::find($serverId);
    $selectedTable = Tables::find($tableId);

    return response()->json([
        'success' => true,
        'selectedServer' => $selectedServer,
        'selectedTable' => $selectedTable
    ]);
}


    public function insertPayment(Request $request)
    {
        try {
            
            $paymentOption = $request->input('payment_option');
            $receivedAmount = $request->input('received_amount');
            $factureId = session('factureId');
            $fact = Factures::where('id', $factureId)->get();
            foreach($fact as $fact){    
            $price =$fact->total_price;
            $change = $receivedAmount - $fact->total_price;
            
            }
           

            if($paymentOption =='card' || $paymentOption =='gratuit' ){
                $change = 0.00;
                $receivedAmount = 0.00;
            }
           
                Factures::where('id', $factureId)->update([
                    'payment_type' => $paymentOption,
                    'total_recieved' => $receivedAmount,
                    'change' => $change,
                    'payment_status' => 'paid'
                ]);

            $payment=new Payments();
            $paymentId=$payment->id;
            $payment->price=$price;
            $payment->save(); 
          
            $facture_payment=new Facture_payment();
            $facture_payment->facture_id=$factureId;
            $facture_payment->payment_id=$paymentId;
            $facture_payment->payment_type=$paymentOption;
            $facture_payment->payment_status='paid';
            $facture_payment->Montant=$receivedAmount;
            $facture_payment->save(); 
            
            $tableId = Factures::where('id', $factureId)->value('table_id');

            Tables::where('id', $tableId)->update(['status' => 0]);
            
             
            return response()->json(['success' => true, 'message' => 'Payment inserted successfully']);
        } catch (\Exception $e) {
            // Log the error message
            Log::error('Error in insertPayment: ' . $e->getMessage());
            // Return error response
            return response()->json(['success' => false, 'message' => 'An error occurred while processing the payment.']);
        }
    }
    public function destroyFact()
    {
        $factureId = session('factureId');
        
        try {
            $facture = Factures::find($factureId);
            
            if (!$facture) {
                return response()->json(['success' => false, 'message' => 'Facture not found']);
            }
            
            $facture->delete();
            
            return redirect()->route('command')->with('success', 'Facture deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('command')->with('error', $e->getMessage());
        }
    }

    public function index()
    {
        //
        return view("managements.products.index")->with([
            "products" => Menu::paginate(5),
            "categories" => Category::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("managements.products.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validation
        $validData = $request->validate([
            'name' => 'required|unique:tables,name',
            'status' => 'required|boolean',
        ]);
        // Create a new table instance
        $table = new Menu();
        $table->name = $validData['name'];
        $table->slug = $validData['name'];
        $table->status = $validData['status'];
        // save instance
        $table->save();

        //store data

        // Clear the form input fields
        $request->session()->flash('success', 'added successfully');

        // Redirect back to the form with an empty form
        return redirect()->route('products.index');
             
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $products)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $product)
    {
        //dd($products);
        $categories = Category::all();
        //
        return view("managements.products.edit")->with([
            "product" => $product,
            "categories" => $categories
        ]);
    }


    public function update(Request $request, $product)
    {   
       
        //
        $categories = Category::all();

        $title = $request->input('title');
        $categoryId = $request->input('category_id');
        $slug = $request->input('slug');
        $unitPrice = $request->input('unit_price');
        $TVA = $request->input('TVA');
        session(['title' =>  $title]);
        session(['category_id' =>  $categoryId]);
        session(['slug' =>  $slug]);
        session(['unit_price' =>  $unitPrice]);
        session(['TVA' =>  $TVA]);
        Menu::where('id', $product)->update([
            'title' =>  $title,
            'category_id' => $categoryId,
            'slug' =>  $slug,
            'unit_price' =>  $unitPrice,
            'TVA' =>  $TVA,
        ]);

        $request->session()->flash('success', 'updated successfully');
        return redirect()->route('products.index')->with('categories', $categories);
    }
    
    
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $product = $request->product;
    
        //delete table
        $products = Menu::find($product);
        $products->delete();
    
        //redirect user
        return redirect()->route("products.index")->with([
            "success" => "article deleted successfully"
        ]);
    }
   
}
