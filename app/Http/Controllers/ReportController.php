<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use App\Models\Details;
use App\Models\Factures;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index()
    {
        $factures = Factures::with('details','menus');
        return view("reports.index", compact('factures'));
    }
    

    public function generate(Request $request)
    {
        //validation
        $this->validate($request,[
            "from" => "required",
            "to" => "required",
        ]);
        //initialisation
        $startDate = "00-00-00 00:00:00"; // Initialisation de la variable $startDate
        $endDate = "00-00-00 00:00:00"; // Initialisation de la variable $endDate
        $total = 0;
        //get data
        $startDate = date("Y-m-d H:i:s",strtotime($request->from."00:00:00"));
        $endDate = date("Y-m-d H:i:s",strtotime($request->to."23:59:59"));
        $factures = Factures::whereBetween("created_at",[$startDate,$endDate])
        ->where("payment_status","paid")->get();
        //return data
        return view("reports.index")->with([
            "startDate" => $startDate,
            "endDate" => $endDate,
            "total" => $factures->sum('total_price'),
            "factures" => $factures
        ]);
    }

    public function export(Request $request)
    {
        //
      
        // $quantity =Details
        $factures = Factures::all();
        // $server = Serveurs::where('id',$serverId)->get();
        // $table = Tables::where('id',$tableId)->get();
      
        $dompdf = new Dompdf();
        
        $html = View::make('reports.export', ['factures' => $factures])->render();
        $dompdf->loadHtml($html);
      
        $dompdf->render();

        
        $dompdf->stream('document.pdf');

    }
}
 