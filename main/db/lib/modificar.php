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

//session_start();
require('../../funciones/conexion.php');
require('../../funciones/funcs.php');
if (!isset($_SESSION['nivel'])) {
    header('Location:../../../index.php');
}
$errors = array();
if (isset($_GET['ide'])) {
if (isset($_POST['enviar'])) {
    $ided = $_POST['id'];
    $idUser = $_SESSION['nivel'];
    $nombre = $_POST['name'];
    $autor = $_POST['autor'];
    $editorial = $_POST['editorial'];
    $edicion = $_POST['edicion'];
    $precio = $_POST['precio'];
    if (!empty($ided) && !empty($nombre) && !empty($autor) && !empty($edicion) && !empty($editorial) && !empty($precio)) {
        $sql = "UPDATE libros SET nombre=?,autor=?,editorial=?,edicion=?,precio=? WHERE id=?";
        $res = $con->prepare($sql);
        $res->bind_param("sssiii",$nombre,$autor,$editorial,$edicion,$precio,$ided);
        if ($res->execute()) {
            $resp = "¡Archivo Modificado!";
        }else $errors[] = "error en la consulta";
        
    }else{
        var_dump($_POST);
         $errors[] = "faltan campos"; }
    
}else $errors[] = "error inesperado";
}else{
if (isset($_GET['id'])) {
    $id = $con->real_escape_string($_GET['id']);
    $nombre = $con->real_escape_string($_GET['nom']);
    $autor = $con->real_escape_string($_GET['aut']);
    $editorial = $con->real_escape_string($_GET['edi']);
    $edicion = $_GET['ed'];
    //$tipo = $con->real_escape_string($_GET['tip']);
    $precio = $_GET['pre'];
    $archivo = $con->real_escape_string($_GET['arch']);
    //$idcli = $con->real_escape_string($_GET['cli']);
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
<h1>Modificar Libro</h1>

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


<form action="done.php?ide=true" method="post" class="contact" id="general" enctype="multipart/form-data">
    <label for="name"><span>Nombre del libro</span></label>
	<input type="text" name="name" id="name" value="<?php echo $nombre ?>" required></input></br>
	<label for="autor"><span>Autor</span></label>
	<input type="text" name="autor" id="autor" value="<?php echo $autor?>" require>
    <label for="editorial"><span>Editorial</span></label>
	<input type="text" name="editorial" id="editorial" value="<?php echo $editorial?>" required></input></br>
	<label for="edicion"><span>Edición</span></label>
	<input type="number" name="edicion" id="edicion" value="<?php echo $edicion?>" require>
    <label for="precio"><span>Precio</span></label>
	<input type="number" name="precio" id="edicion" value="<?php echo $precio?>" require>
    <br>
    <label hidden for=""><span></span></label>
	<input type="text" name="id" id="edicion" value="<?php echo $id?>" hidden require>
    
<br>
<div class="left">

<label for="" class=""><span>Esta editando el archivo...</span></label>
<iframe src="<?php echo $archivo;?>" class="rounded" alt=""></iframe>
</div>
<br>

	
	<input type="submit" class="send" value="Modificar" name="enviar"></input>
</form>




</div>





</div>  

<footer class="last">Modificar</footer>

</body>
</html>