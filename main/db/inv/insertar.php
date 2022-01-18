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
    $name = strtoupper($_POST['name']);
    $desc = $_POST['desc'];
    $prec = $_POST['prec'];
    $exist = $_POST['exist'];
    
    if (!empty($name) && !empty($desc) && !empty($prec) && !empty($exist) && !empty($_FILES)) {
        # code...
    
    
        $fecha = date('Y-m-d');
        $time = date('ism');
        //var_dump($time);
        $tipos = array('image/png','image/jpeg','application/pdf');
        if (in_array($_FILES['archivo']['type'],$tipos)) {
            $tamano = 1024*1024*60; 
            if ($_FILES['archivo']['size'] < $tamano) {
                $carpeta = "inventario/";
                if (!file_exists($carpeta)) {
                mkdir($carpeta);
                }
                $carpeta .= "$name$time";
            //$carpeta .= "$idUser/$fecha";
            //if (!file_exists($carpeta)) {
              //  mkdir($carpeta);
            //}
                $tipo = $_FILES['archivo']['type'];
                $date = date('Ymd-His');

                if (strcmp($tipo,"application/pdf" == 0)) {
                $archivo = $carpeta.".jpg";   #nombramos a los archivos
                }elseif (strcmp($tipo,"image/png" == 0)) {
                $archivo = $carpeta.".png";
                }else {
                $archivo = $carpeta.".jpg";
                }
                $tmpName = $_FILES['archivo']['tmp_name'];  #guardamos el nombre temporal donde se alojo el archivo
                if (!file_exists($archivo)) {   //si no existe el archivo procedemos a guardarlo
                    if (move_uploaded_file($tmpName,$archivo)) {    #esta funcion mueve el archivo guardado temporalmente a la variable que contiene otro lugar de alojamiento, si es tru, si podra guardarlo
                        $sql = "INSERT INTO productos (prod_id,prod_nom,prod_des,prod_img,prod_pre,prod_can) VALUES (?,?,?,?,?,?)";
                        $request = $con->prepare($sql);
                        $request->bind_param("isssii",$id,$name,$desc,$archivo,$prec,$exist);
                        if ($request->execute()) {
                            $res = "¡Articulo guardado!";
                        }else $errors[] = " Ocurrio un error";
                    }else $errors[] = " No se pudo guardar el articulo";
                }else $errors[] = " El articulo ya existe";
            }else $errors[] = " El archivo excede el tamaño permitido";
        }else $errors[] = " Tipo de archivo no permitido";
    }else  $errors[] = " faltan campos por llenar";
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
    <a href="../../inventario.php">Volver</a>
    </div>
</header>

</br>
<div>
<h1>Nuevo producto</h1>
<?php 
if (isset($res)) {
    if ($res) {
        
    
?>
    <div class="bg- sucess text-white p-2 mx-5 text-center">
    <?php echo $res ?> 
    </div>
<?php
    }else $errors[] = "algo salio mal";
}
include('../../funciones/errors.php');
?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="contact" id="general" enctype="multipart/form-data">
	<label for="name"><span>Producto</span></label>
	<input type="text" name="name" id="name" required></br>
	<label for="desc"><span>Descripción</span></label>
    <input type="text" name="desc" id="desc" required>
    <label for="prec"><span> Precio </span></label>
	<input type="number" name="prec" id="prec" required></br>
	
    <label for="existencias"><span>Existencias</span></label>
    <input type="number" name="exist" id="existencias" required>
	
	<label for="archivo"><span> Imagen </span></label>
</br>
    <input type="file" name="archivo" id="archivo">
<br>
	<input type="reset" class="send" value="Borrar"></input>
	<input type="submit" class="send" value="Enviar" name="enviar"></input>
</form>




</div>





</div>  

<footer class="last">Insertar</footer>

</body>
</html>