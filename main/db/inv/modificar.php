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
    $id = $_GET['ide'];
    $nombre = $_POST['name'];
    $descripcion = $_POST['des'];
    $precio = $_POST['pre'];
    $cantidad = $_POST['can'];
    
    if (!empty($id) && !empty($nombre) && !empty($descripcion) && !empty($precio) && !empty($cantidad)) {
        $sql = "UPDATE productos SET prod_nom=?,prod_des=?,prod_pre=?,prod_can=? WHERE prod_id=?";
        $res = $con->prepare($sql);
        $res->bind_param("ssiii",$nombre,$descripcion,$precio,$cantidad,$id);
        if ($res->execute()) {
            $resp = "¡Producto Modificado!";
        }else $errors[] = "error en la consulta";
        
    }else{
        var_dump($_POST);
         $errors[] = "faltan campos"; }
    
}else $errors[] = "error inesperado";
}else{
if (isset($_GET['id'])) {
    $id = $con->real_escape_string($_GET['id']);
    $nombre = $con->real_escape_string($_GET['nom']);
    $descripcion = $con->real_escape_string($_GET['des']);
    $img = $con->real_escape_string($_GET['img']);
    $precio = $_GET['pre'];
    $cantidad = $_GET['can'];
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
    <?php echo menulib()?>
    </div>
</header>

</br>
<div>
<h1>Modificar Producto</h1>

<?php 
if (isset($resp)) {
    if ($resp) {
        
    
?>
    <div class="bg- sucess text-white p-2 mx-5 text-center">
    <?php echo $resp ?> 
    </div>
<?php
    }else $errors[] = "algo salio mal";
}
include('../../funciones/errors.php');
?>


<form action="<?php echo $_SERVER['PHP_SELF']; ?>?ide=<?php echo $id?>" method="post" class="contact" id="general" enctype="multipart/form-data">
	<label for="name"><span>Producto</span></label>
	<input type="text" name="name" id="name" value="<?php echo $nombre ?>" required></input></br>
	<label for="desc"><span>Descripción</span>
    <input type="text" name="des" id="desc" value="<?php echo $descripcion ?>" require>
    <label for="prec"><span> Precio </span></label>
	<input type="number" name="pre" id="prec" value="<?php echo $precio ?>"required></input></br>
	
    <label for="existencias"><span>Existencias</span></label>
    <input type="number" name="can" id="existencias" value="<?php echo $cantidad ?>" required>
	
	<label for="archivo"><span> Esta editanto el articulo... </span></label>
    <iframe src="<?php echo $img ?>" class="rounded" alt="producto" width="100%"></iframe>
<br>
	
	<input type="submit" class="send" value="Enviar" name="enviar"></input>
</form>




</div>





</div>  

<footer class="last">Modificar</footer>

</body>
</html>