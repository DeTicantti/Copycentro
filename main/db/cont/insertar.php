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
if (isset($_POST['enviar'])) {
    $id = null;
    $maquinaNom = $_POST['maquina'];
    $conIn = $_POST['contador'];
    //$conFi = null;

    $dateIn = $_POST['date'];
    //$dateFi = null;
    $prod = $_POST['producto'];
    if (!empty($maquinaNom) && !empty($conIn) && !empty($prod) && !empty($dateIn)) {
        $sql = "INSERT INTO contador(maquinaid, maquinanom, contadori, fechaini, producto) VALUES (?,?,?,?,?)";
        $request = $con->prepare($sql);
        $request->bind_param("iiiss",$id,$maquinaNom,$conIn,$dateIn,$prod);
        if ($request->execute()) {
            $res = "¡Maquina Agregada";
        }else $errors[] = "Ocurrio un error";
        
    }else $errors[] = "faltan campos por llenar";
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
    <a href="../../contadores.php">Volver</a>
    </div>
</header>

</br>
<div>
<h1>Nueva maquina</h1>

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

<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" class="contact" id="general">
	<label for="name"><span># maquina:</span></label>
	<input type="number" name="maquina" id="name" required></input></br>
	<label for="precio"><span>contador inicial</span></label>
	<input type="number" name="contador" id="contador" required>
    <label for="prod"><span>Producto</span></label>
	<input type="text" name="producto" id="prod" required>
    <label for="date"><span>Fecha Inicio de toner</span></label>
	<input type="date" name="date" id="date" required>
	
<br>
	<input type="reset" class="send" value="Borrar"></input>
	<input type="submit" class="send" value="Guardar" name="enviar"></input>
</form>




</div>





</div>  

<footer class="last">Insertar</footer>

</body>
</html>