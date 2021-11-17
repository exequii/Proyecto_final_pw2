<?php

require 'vendor/autoload.php';

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
        $data['pendientes']=$this->perfilUsuarioModel->getDatosPendientesUsuario($_SESSION['usuario'][0]['idusuario']);
        $data['usuario'] = $_SESSION['usuario'];
        $data['nivelVuelo'] = $data['usuario'][0]['nivelVuelo'];

        foreach($data['pendientes'] as $clave => $pendiente){
            $url = $this->inicializarMP($pendiente['idreserva']);
            $data['pendientes'][$clave]['url'] = $url;
        }

        if (isset($_SESSION['usuario'])){
            echo $this->printer->render( "view/perfilUsuarionView.html",$data);
        }
    }

    function inicializarMP($idreserva){
        
        $token = "TEST-5916094541699370-111014-1eaa90a66f41c97bc3c420d2f70da2a9-238927187";
        MercadoPago\SDK::setAccessToken($token);
    
        $preference = new MercadoPago\Preference();
    
        // Crea un ítem en la preferencia
        $item = new MercadoPago\Item();
        $item->title = 'Reserva Vuelo - GauchoRocket';
        $item->quantity = 1;
        $item->unit_price = 100;
        $preference->back_urls = [
            "success" => "http://localhost/vuelos?pagorealizado=true&id=$idreserva",
            "failure" => "http://localhost/vuelos&pagorealizado=false",
        ];

        $preference->auto_return = 'approved';
        $preference->items = array($item);
        $preference->save();
        return $preference->init_point;
        //header("Location: ".$preference->init_point."");
    }

 
}