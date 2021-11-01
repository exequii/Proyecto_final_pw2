<?php

class PerfilUsuarioController{
    private $printer;
    private $perfilUsuarioModel;

    public function __construct($perfilUsuarioModel,$printer)
    {
        $this->perfilUsuarioModel = $perfilUsuarioModel;
        $this->printer = $printer;
    }
    public function show(){
        $data['datos']=$this->perfilUsuarioModel->getDatosUsuario($_SESSION['usuario'][0]['idusuario']);
        if (isset($_SESSION['usuario'])){
            echo $this->printer->render( "view/perfilUsuarionView.html",$data);
        }
    }

}