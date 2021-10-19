<?php

class InicioController{

    private $printer;

    public function __construct($printer)
    {
        $this->printer = $printer;
    }

    public function show()
    {
        if (isset($_SESSION['usuario'])){
            $data['usuario'] = $_SESSION['usuario'];
            if (isset($_SESSION['admin'])){
                $data['admin'] = $_SESSION['admin'];
            }
            echo $this->printer->render( "view/inicioView.html", $data);
        }else {
            echo $this->printer->render("view/inicioView.html");
        }
    }

    function logout(){
        if(isset($_SESSION['usuario'])){
            session_destroy();
        }

        header('Location: index.php');
    }
}

?>