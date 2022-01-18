<?php
session_start();
if ($_SESSION['nivel']== "1" || $_SESSION['nivel']=="2") {


    if ($_SESSION['nivel'] == "1") {
        //asignamos menu
        function menulib(){
            $resultado = "<a href='../../libros.php'>Volver</a>";
            return $resultado;
        }
        
    }
    else{   
        //asignamos menu
        function menulib(){
            $resultado = "<a href='../../librosUs.php'>Volver</a>";
            return $resultado;
        }
    }
}
require('../../funciones/conexion.php');
require('../../funciones/funcs.php');
if (!isset($_SESSION['nivel'])) {
    header('Location:../../../index.php');
}
$errors = array();
if (isset($_POST['enviar'])) {
    $id = null;
    $nomcli = $_POST['name'];
    $reg = $_POST['registro'];
    $pre = $_POST['precio'];
    if (!empty($nomcli) && !empty($reg) && !empty($pre)) {
        $sql = "INSERT INTO clientes (clienteid, nombre, fecharegistro, clienteprecio) VALUES (?,?,?,?)";
        $request = $con->prepare($sql);
        $request->bind_param("isss",$id, $nomcli, $reg, $pre);
        if ($request->execute()) {
            $res = "Cliente agregado";
        }else $errors[] = "ocurrio un error";
        
        
    }else $errors[] = "faltan campos por llenar";
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
<h1>Insertar cliente</h1>
<?php 
if (isset($res)) {
    if ($res) {
        
    
?>
    <div class="bg- sucess error text-white p-2 mx-5 text-center">
    <?php echo $res ?> 
    </div>
<?php
    }else $errors[] = "algo salio mal";
}
include('../../funciones/errors.php');
?>

<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="contact" id="general">
	<label for="name"><span>Nombre</span></label>
	<input type="text" name="name" id="name" required></input></br>
	<label for="precio"><span>Registro</span></label>
	<input type="date" name="registro" required>
	<!--<label for="mail"><span>Visita</span></label>
	<input type="date" name="visita" required></input></br>-->
	<label for="fon"><span> Precio preferencial </span></label>
	<textarea name="precio" id="" cols="30" rows="10" required></textarea>
</br>
    <!--<input type="file" name="archivo" id="archivo">-->
<br>
	<input type="reset" class="send" value="Borrar"></input>
	<input type="submit" class="send" value="Guardar" name="enviar"></input>
</form>




</div>





</div>  

<footer class="last">Insertar</footer>

</body>
</html>