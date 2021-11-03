<?php

class PerfilUsuarioController{
    private $printer;
    private $perfilUsuarioModel;

    public function __construct($perfilUsuarioModel,$printer)
    {
        $this->perfilUsuarioModel = $perfilUsuarioModel;
        $this->printer = $printer;
        $this->pdfPrinter = $pdfPrinter;
    }
    public function show(){
        $data['datos']=$this->perfilUsuarioModel->getDatosUsuario($_SESSION['usuario'][0]['idusuario']);
        $data['usuario'] = $_SESSION['usuario'];
        $data['nivelVuelo'] = $data['usuario'][0]['nivelVuelo'];
        if (isset($_SESSION['usuario'])){
            echo $this->printer->render( "view/perfilUsuarionView.html",$data);
        }
    }
}