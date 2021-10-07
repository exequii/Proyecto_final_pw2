<?php include('conexion.php');?>
<?php include('helpers.php');?>


<!DOCTYPE html>
<html>
<title>TP FINAL - ENTREGA 1</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css" />
<link
        rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Raleway"
/>
<link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
/>
<style>
    body,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        font-family: "Raleway", Arial, Helvetica, sans-serif;
    }
</style>
<body class="w3-light-grey">
<!-- Navigation Bar -->
<div class="w3-bar w3-white w3-large">
  <a href="index.php" class="w3-bar-item w3-button w3-red w3-mobile"
    ><i class="fa fa-bed w3-margin-right"></i>Logo</a
  >
  <a href="registro.php" class="w3-bar-item w3-button w3-mobile"
    >Registro</a
  >
  <a href="#contact" class="w3-bar-item w3-button w3-mobile">Contacto</a>

    <?php if (isset($_SESSION['usuario'])){
        echo '<a href = "usuario.php" class="w3-bar-item w3-button w3-right w3-light-grey w3-mobile">' .
                        $_SESSION['usuario']['usuario'] . '</a>';
    }else {
        echo '<a href = "login.php" class="w3-bar-item w3-button w3-right w3-light-grey w3-mobile" > Login</a>';
    }
    ?>

</div>
