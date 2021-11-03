<?php
use Dompdf\Dompdf;
class PDFPrinter
{
    private $pdfPrinter;

    public function __construct()
    {

    }
    public function printPDF(){
        $cantidad=$_GET['cantidad'];
        $comprobante=$_GET['comprobante'];
        $dia=$_GET['dia'];
        $origen=$_GET['origen'];
        $destino=$_GET['destino'];
        $tipoVuelo=$_GET['tipo'];
        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->loadHtml(
            '<h1 style="border: 1px solid black; padding: 5px;">Resumen de su Reserva</h1><br>
            <h3>- Cantidad de pasajes adquiridos: '.$cantidad.'</h3><br>
            <h4>- Codigo de comprobante: ' .$comprobante. '</h4><br>
            <h4>- Dia de Partida: ' .$dia.'</h4><br>
            <h4>- Punto de Partida: ' .$origen. '</h4><br>
            <h4>- Punto de Destino: ' .$destino. '</h4><br>
            <h4>- Tipo de Vuelo: ' .$tipoVuelo. '</h4>'
        );

//      (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

//      Render the HTML as PDF
        $dompdf->render();

//      Output the generated PDF to Browser
        $dompdf->stream("comprobante.pdf" , ['Attachment' => 0]);
    }
}