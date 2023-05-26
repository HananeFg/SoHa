<?php

namespace App\Http\Controllers;

use Intervention\Image\Facades\Image;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\Menu;


class PdfController extends Controller
{
    

    public function generatePdf()
    {

        $items = Menu::all();
        // Create a new instance of Dompdf
        $dompdf = new Dompdf();
        $dompdf->set_option('isRemoteEnabled', TRUE);
        // Load your HTML content into Dompdf
        $html = view('ticket', ['items' => $items])->render();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('80mm', 'auto');

        // Set paper size and orientation (optional)
        // $dompdf->setPaper('A4', 'portrait');
    
        // Render the PDF
        $dompdf->render();
    
        // Output the PDF as a stream or save it to a file
        $dompdf->stream('document.pdf');
    }
}