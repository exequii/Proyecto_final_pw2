<?php
use Dompdf\Dompdf;
use Dompdf\Options;

class PDFPrinter
{
    private $pdfPrinter;

    public function __construct()
    {

    }
    public function printPDF($urlImagen){
        $cantidad=$_GET['cantidad'];
        $comprobante=$_GET['comprobante'];
        $dia=$_GET['dia'];
        $origen=$_GET['origen'];
        $destino=$_GET['destino'];
        $tipoVuelo=$_GET['tipo'];
        $tipo_servicio=$_GET['tipo_servicio'];
        $fila_asiento=$_GET['fila_asiento'];
        $numero_asiento=$_GET['numero_asiento'];

        $options = new Options();
        $options->set('isRemoteEnabled',TRUE);
        $dompdf = new Dompdf($options);

        $dompdf->loadHtml(
            '<h1 style="border: 1px solid black; padding: 5px;">Resumen de su Reserva</h1><br>
            <h3>- Cantidad de pasajes adquiridos: '.$cantidad.'</h3><br>
            <h4>- Codigo de comprobante: ' .$comprobante. '</h4><br>
            <h4>- Dia de Partida: ' .$dia.'</h4><br>
            <h4>- Punto de Partida: ' .$origen. '</h4><br>
            <h4>- Punto de Destino: ' .$destino. '</h4><br>
            <h4>- Tipo de Vuelo: ' .$tipoVuelo. '</h4><br>
            <h4>- Tipo de Servicio: ' .$tipo_servicio. '</h4><br>
            <h4>- Fila: ' .$fila_asiento. '</h4><br>
            <h4>- Numero asiento: ' .$numero_asiento. '</h4><br>
            <img src="'.$urlImagen.'"/>'.$urlImagen.'
            '
        );


//      (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

//      Render the HTML as PDF
        $dompdf->render();

//      Output the generated PDF to Browser
        $dompdf->stream("comprobante.pdf" , ['Attachment' => 0]);
    }
}