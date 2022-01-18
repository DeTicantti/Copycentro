<?php 
session_start();
if ($_SESSION['nivel']== "1" || $_SESSION['nivel']=="2") {


    if ($_SESSION['nivel'] == "1") {
        //asignamos menu
        function menulib(){
            $resultado = "<a href='../../inventario.php'>Volver</a>";
            return $resultado;
        }
        
    }
    else{   
        //asignamos menu
        function menulib(){
            $resultado = "<a href='../../inventarioUs.php'>Volver</a>";
            return $resultado;
        }
    }
}

//session_start();
require('../../funciones/conexion.php');
require('../../funciones/funcs.php');
if (!isset($_SESSION['nivel'])) {
    header('Location:../../../index.php');
}
$errors = array();
if (isset($_GET['ide'])) {
    if (isset($_POST['enviar'])) {
        $id = $con->real_escape_string($_GET['ide']);
        $nombre = $_POST['name'];
        $descripcion = $_POST['precio'];
        
        
        
        if (!empty($id) && !empty($nombre) && !empty($descripcion)) {
            $sql = "UPDATE clientes SET nombre=?,clienteprecio=? WHERE clienteid=?";
            
            $res = $con->prepare($sql);
            $res->bind_param("ssi",$nombre,$descripcion,$id);
            if ($res->execute()) {
                $resp = "¡Cliente Modificado!";
            }else $errors[] = "error en la consulta";
            
        }else{
            
             $errors[] = "faltan campos"; }
        
    }else $errors[] = "error inesperado";
    }else{
    if (isset($_GET['id'])) {
        $id = $con->real_escape_string($_GET['id']);
        $nombre = $con->real_escape_string($_GET['nom']);
        $descripcion = $_GET['pref'];
        if (empty($id)) {
            $errors[] = "el id esta vacio";
        }
    }else $errors[] = "error inesperado";
    }
    
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="FormularioUsuarios" content="Usuarios">

    <title>Intranet</title>
    <!--<link href="../../style.css" rel="stylesheet" type="text/css">
    <link href="../style.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="intranet.js"> </script>-->
    <link href="../../style.css" rel="stylesheet" type="text/css">
    <link href="../style.css" rel="stylesheet" type="text/css">
    <link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../../css/all.min.css" rel="stylesheet" type="text/css">
    
        <link rel="stylesheet" href="../../../fontawesomeweb/css/all.min.css" type="text/css">
    <script type="text/javascript" src="intranet.js"> </script>


</head>
<body>
<div class="container">
<header>
    <div class="closeSession">
    <a href="../../clientes.php">Volver</a>
    </div>
</header>

</br>
<div>
<h1>Modificar cliente</h1>
<?php 
if (isset($resp)) {
    if ($resp) {
        
    
?>
    <div class="bg- sucess error text-white p-2 mx-5 text-center">
    <?php echo $resp ?> 
    </div>
<?php
    }else $errors[] = "algo salio mal";
}
include('../../funciones/errors.php');
?>

<form action="<?php echo $_SERVER['PHP_SELF'] ?>?ide=<?php echo $id ?>" method="post" class="contact" id="general">
	<label for="name"><span>Nombre</span></label>
	<input type="text" name="name" id="name" value="<?php echo $nombre ?>" required></input></br>
	<!--<label for="mail"><span>Visita</span></label>
	<input type="date" name="visita" required></input></br>-->
	<label for="precio"><span> Precio preferencial </span></label>
    
	<textarea name="precio" id="" cols="30" rows="10" required> <?php echo $descripcion?> </textarea>
</br>
    <!--<input type="file" name="archivo" id="archivo">-->
<br>
	
	<input type="submit" class="send" value="Guardar" name="enviar" required></input>
</form>




</div>





</div>  

<footer class="last">Insertar</footer>

</body>
</html>