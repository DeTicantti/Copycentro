<?php

include("funciones/menu.php");
session_start();

//seguridad extra
if ($_SESSION['nivel']== "1" || $_SESSION['nivel']=="2") {


if ($_SESSION['nivel'] == "1") {
    //asignamos menu
    $menu = getMenuAdmin();
    
}
else{   
    //asignamos menu
    $menu = getMenuUser();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="FormularioUsuarios" content="Usuarios">

    <title>Intranet</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="intranet.js"> </script>
    <script>
    
    </script>


</head>
<body>
<div class="container">
<header>
    <div class="headerr"><img src="../img/logocopycentro.pn" alt=""></div>
    
    <h2>Bienvenido, <?php echo $_SESSION['name']?></h2>
    <div class="closeSession">
    <a href="../login/salir.php">Cerrar sesión</a>
    </div>
</header>
<?php
    echo $menu;
?>
</br>
<br>
<div>
    <h1 class="last"><<<<< <?php echo $_SESSION['name']?> >>>>></h1>
</div>

<?php 


?>
</div>  

<footer class="last"><?php echo $_SESSION['name']?></footer>

</body>
</html>
<?php


}else{
    define("inicio","../index.php?msj=id-denegado");
    header("location: ".inicio);
}
?>

