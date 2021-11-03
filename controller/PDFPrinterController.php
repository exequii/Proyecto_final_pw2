<?php
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
        $this->PDFPrinter->printPDF();
    }


}