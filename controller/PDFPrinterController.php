<?php

require_once('./third-party/phpqrcode/qrlib.php');

class PDFPrinterController{
    private $PDFPrinter;
    
    /**
     * @param $PDFPrinter
     */
    public function __construct($PDFPrinter)
    {
        $this->PDFPrinter = $PDFPrinter;
    }
    public function imprimirPdf(){
        $url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $urlImagen = $this->generarQR($url);
        $this->PDFPrinter->printPDF($urlImagen);
    }
    public function imprimirCheckIn(){
        $this->PDFPrinter->printCheckIn();
    }

    function generarQR($url){

        $tempDir = "public/";
    
        $codeContents = "$url";
    
        
        $fileName = '000_file_'.md5($codeContents).'.png';
        $pngAbsoluteFilePath = $tempDir.$fileName;

        //QRcode::png($codeContents);
         if (!file_exists($pngAbsoluteFilePath)) {
             QRcode::png($codeContents, $pngAbsoluteFilePath,QR_ECLEVEL_L,3);
         }
         
        $urlImagen = "C:/xampp/htdocs/public/$fileName";
        //echo '<img src="../public/'.$fileName.'"/>';
         $urlBase64 = "data:image/png;base64," . base64_encode(file_get_contents($urlImagen));
        return $urlBase64;
    
    }


}