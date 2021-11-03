<?php
use Dompdf\Dompdf;
class PDFPrinter
{
    private $pdfPrinter;

    public function __construct()
    {

    }
    public function printPDF($data){
        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->loadHtml(
            '<h1>' . $data['nombre'] . '</h1>'
        );

//      (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

//      Render the HTML as PDF
        $dompdf->render();

//      Output the generated PDF to Browser
        $dompdf->stream("comprobante.pdf" , ['Attachment' => 0]);
    }
}