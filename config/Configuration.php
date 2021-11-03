<?php


class Configuration{

    private $config;

    /*********************************************** CONTROLLER *******************************************************/

    public function createInicioController(){
        require_once("controller/InicioController.php");
        return new InicioController($this->createPrinter());
    }

    public function createLoginController(){
        require_once("controller/LoginController.php");
        return new LoginController( $this->createLoginModel(), $this->createPrinter());
    }

    public function createRegistroController(){
        require_once("controller/RegistroController.php");
        return new RegistroController( $this->createRegistroModel(), $this->createPrinter());
    }

    public function createPerfilAdminController(){
        require_once("controller/PerfilAdminController.php");
        return new PerfilAdminController( $this->createPerfilAdminModel(), $this->createPrinter(), $this->createLoginModel());
    }

    public function createVerifyController(){
        require_once("controller/VerifyController.php");
        return new VerifyController($this->createLoginModel(),$this->createPrinter());
    }
    public function createTurnosController(){
        require_once("controller/TurnosController.php");
        return new TurnosController($this->createTurnosModel(),$this->createPrinter());
    }
    public function createVuelosController(){
        require_once("controller/VuelosController.php");
        return new VuelosController($this->createVuelosModel(),$this->createPrinter());
    }
    public function createPerfilUsuarioController(){
        require_once("controller/PerfilUsuarioController.php");
        return new PerfilUsuarioController($this->createPerfilUsuarioModel(),$this->createPrinter(),$this->createPDFPrinter());
    }
    public function createPDFPrinterController(){
        require_once("controller/PDFPrinterController.php");
        return new PDFPrinterController($this->createPDFPrinter());
    }

    /*********************************************** MODEL ************************************************************/

    public function createLoginModel(){
        require_once("model/LoginModel.php");
        $database = $this->getDatabase();
        return new LoginModel($database);
    }

    public function createRegistroModel(){
        require_once("model/RegistroModel.php");
        $database = $this->getDatabase();
        return new RegistroModel($database);
    }

    public function createPerfilAdminModel(){
        require_once("model/PerfilAdminModel.php");
        $database = $this->getDatabase();
        return new PerfilAdminModel($database);
    }
    public function createTurnosModel(){
        require_once("model/TurnosModel.php");
        $database = $this->getDatabase();
        return new TurnosModel($database);
    }
    public function createVuelosModel(){
        require_once("model/VuelosModel.php");
        $database = $this->getDatabase();
        return new VuelosModel($database);
    }
    public function createPerfilUsuarioModel(){
        require_once("model/PerfilUsuarioModel.php");
        $database = $this->getDatabase();
        return new PerfilUsuarioModel($database);
    }


    /*******************************************************************************************************************/

    private  function getDatabase(){
        require_once("helpers/MyDatabase.php");
        $config = $this->getConfig();
        return new MyDatabase($config["servername"], $config["username"], $config["password"], $config["dbname"]);
    }

    private  function getConfig(){
        if( is_null( $this->config ))
            $this->config = parse_ini_file("config/config.ini");

        return  $this->config;
    }

    private function getLogger(){
        require_once("helpers/Logger.php");
        return new Logger();
    }

    public function createRouter($defaultController, $defaultAction){
        include_once("helpers/Router.php");
        return new Router($this,$defaultController,$defaultAction);
    }

    private function createPrinter(){
        require_once ('third-party/mustache/src/Mustache/Autoloader.php');
        require_once("helpers/MustachePrinter.php");
        return new MustachePrinter("view/partials");
    }
    private function createPDFPrinter(){
        require_once ('third-party/dompdf/src/Autoloader.php');
        require_once 'third-party/dompdf/autoload.inc.php';
        require_once("helpers/PDFPrinter.php");
        return new PDFPrinter();
    }

}

?>