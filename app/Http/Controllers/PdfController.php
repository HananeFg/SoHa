<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\Menu;
use Illuminate\Support\Facades\View;

class PdfController extends Controller
{
    
    
    public function generatePdf($factureId)
    {
        
        $items = Menu::all();

        $dompdf = new Dompdf();
        $html = View::make('ticket', ['items' => $items])->render();
        $dompdf->loadHtml($html);

        // Set paper size and orientation
        $dompdf->setPaper('80mm', 'auto');

        // Render the PDF
        $dompdf->render();

        // Output the PDF as a stream or save it to a file
        $output = $dompdf->output();

        return response($output, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="document.pdf"',
        ]);
    }

     
}