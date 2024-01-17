<?php

namespace App\Http\Controllers;

// Require the necessary files
//require_once 'dompdf/autoload.inc.php';

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use TCPDF;
use TCPDF_FONTS;
use Illuminate\Http\Request;
//use PDF;
define("DOMPDF_UNICODE_ENABLED", true);
class InvoiceController extends Controller
{

    public function generateInvoice($id)
    {
        // Retrieve the order data from the database
        $order = Order::with('items')
                        ->with('customer')->with('shipping_country')->with('shipping_state')->with('shipping_township')
                        ->with('different_shipping_country')->with('different_shipping_state')->with('different_shipping_township')
                        ->findOrFail($id);

        return view('admin.invoices.invoice', compact('order'));

        // Create an instance of the Dompdf class
$dompdf = new Dompdf();
         // Create an instance of the Options class



        // // Generate the HTML for the invoice using a blade view
         $html = view('admin.invoices.invoice', compact('order'));

        // // Load the HTML content into Dompdf
         $dompdf->loadHtml($html,'UTF-8');

         //$dompdf->setOptions('isRemoteEnabled', true);
        // // Create an instance of Options
        // $options = $dompdf->getOptions();
        // $options->setDefaultFont('Pyidaungsu');
        // $dompdf->setOptions($options);

        //$options = new Options();

// Set your desired options
//$options->set('isRemoteEnabled', 'true');


// Set the options by passing the Options instance
//$dompdf->setOptions($options);

        // // Render the PDF
        $dompdf->render();

        // Output the PDF as a downloadable file
    return $dompdf->stream('invoice.pdf');
        //dd($order);
        //$pdf = PDF::loadView('admin.invoices.invoice',$order  );

        //return $pdf->download('invoice.pdf');

    //     $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8');
    // $pdf->SetCreator('Your Company');
    // $pdf->SetAuthor('Your Name');
    // $pdf->SetTitle('Invoice');
    // $pdf->SetHeaderData('', 0, '', '');
    // $pdf->setHeaderFont(['dejavusans', '', 10]);
    // $pdf->setFooterFont(['dejavusans', '', 10]);
    // $pdf->SetDefaultMonospacedFont('helvetica');
    // $pdf->SetMargins(10, 10, 10);
    // $pdf->SetAutoPageBreak(true, 10);
    // $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
    // // Add the Pyidaungsu font
    // // Add the TTF font
    // //$pdf->SetPageSize('A4');
    // $pdf->AddPage();
    // // Set the TTF font for use
    // // $fontPath = public_path('vendor/tecnickcom/tcpdf/fonts/pyidaungsu.ttf');
    // // $font = TCPDF_FONTS::addTTFfont($fontPath, 'TrueTypeUnicode', '', 32);
    // // $pdf->SetFont($font, '', 12);

    // // Generate the invoice from HTML view
    // $view = view('admin.invoices.invoice', compact('order'))->render();
    // $pdf->writeHTML($view, true, false, true, false, '');

    // // Output the PDF
    // $pdf->Output('invoice.pdf', 'D');

    }

}
