<?php

    function borrarErrores(){
        if(isset($_SESSION['errores'])) {
            $_SESSION['errores'] = null;
            unset($_SESSION['errores']);
        }
    }