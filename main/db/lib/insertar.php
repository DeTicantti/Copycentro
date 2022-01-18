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
if (isset($_GET['cli'])) {
    $cli = $_GET['cli'];
    if (isset($_POST['enviar'])) {
        $id = null;
        $idUser = $_SESSION['nivel'];
        $nombre = $_POST['name'];
        $autor = $_POST['autor'];
        $editorial = $_POST['editorial'];
        $edicion = $_POST['edicion'];
        $tipon = $_POST['tipo'];
        $precio = $_POST['precio'];
        $cli = $_GET['cli'];
        
    
        if (!empty($nombre) && !empty($cli) && !empty($autor) && !empty($edicion) && !empty($editorial) && !empty($_FILES)) {
            # code...
        
        
            $fecha = date('Y-m-d');
            $time = date('ism');
            //var_dump($time);
            $tipos = array('image/png','image/jpeg','application/pdf');
            if (in_array($_FILES['archivo']['type'],$tipos)) {
                $tamano = 1024*1024*60; 
                if ($_FILES['archivo']['size'] < $tamano) {
                    $carpeta = "libros/";
                    if (!file_exists($carpeta)) {
                    mkdir($carpeta);
                    }
                    $carpeta .= "$nombre$time";
                //$carpeta .= "$idUser/$fecha";
                //if (!file_exists($carpeta)) {
                  //  mkdir($carpeta);
                //}
                    $tipo = $_FILES['archivo']['type'];
                    $date = date('Ymd-His');
    
                    if (strcmp($tipo,"application/pdf" == 0)) {
                    $archivo = $carpeta.".pdf";   #nombramos a los archivos
                    }elseif (strcmp($tipo,"image/png" == 0)) {
                    $archivo = $carpeta.".png";
                    }else {
                    $archivo = $carpeta.".jpg";
                    }
                    $tmpName = $_FILES['archivo']['tmp_name'];  #guardamos el nombre temporal donde se alojo el archivo
                    if (!file_exists($archivo)) {   //si no existe el archivo procedemos a guardarlo
                        if (move_uploaded_file($tmpName,$archivo)) {    #esta funcion mueve el archivo guardado temporalmente a la variable que contiene otro lugar de alojamiento, si es tru, si podra guardarlo
                            $sql = "INSERT INTO libros (id,nombre,autor,editorial,edicion,tipo,precio,archivo,clienteid) VALUES (?,?,?,?,?,?,?,?,?)";
                            $request = $con->prepare($sql);
                            $request->bind_param("isssisisi",$id,$nombre,$autor,$editorial,$edicion,$tipon,$precio,$archivo,$cli);
                            if ($request->execute()) {
                                $res = "¡Archivo guardado!";
                            }else $errors[] = " Ocurrio un error";
                        }else $errors[] = " No se pudo guardar el archivo";
                    }else $errors[] = " El archivo ya existe";
                }else $errors[] = " El archivo excede el tamaño permitido";
            }else $errors[] = " Tipo de archivo no permitido";
        }else $errors[] = " faltan campos por llenar";
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
        
            <link rel="stylesheet" href="../../fontawesomeweb/css/all.min.css" type="text/css">
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
    <h1>Nuevo Libro</h1>
    
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
    
    
    <form action="<?php echo $_SERVER['PHP_SELF']?>?cli=<?php echo $cli?>" method="post" class="contact" id="general" enctype="multipart/form-data">
        <label for="name"><span>Nombre del libro</span></label>
        <input type="text" name="name" id="name" required></input></br>
        <label for="autor"><span>Autor</span></label>
        <input type="text" name="autor" id="autor" required>
        <label for="editorial"><span>Editorial</span></label>
        <input type="text" name="editorial" id="editorial" required></input></br>
        <label for="edicion"><span>Edición ó año</span></label>
        <input type="number" name="edicion" id="edicion" required>
        <label for="precio"><span>Precio</span></label>
        <input type="number" name="precio" id="edicion" required>
        <input type="number" value="<?php echo $cli?>" name="cli" require hidden>
        
        <label for="tipo"><span>Tipo</span></label>
        <select name="tipo">
        <option value="-" selected disabled hidden>Selecciona uno</option>
            <option value="matematicas">Matemáticas</option>
            <option value="científicos">Ciencias-Cientificos</option>
            <option value="historia">Historia</option>
            <option value="filosofia">Filosofía</option>
            <option value="medico">Médicos</option>
            <option value="idiomas">Idiomas</option>
            <option value="informatica">Informática</option>
            <option value="literatura">Literatura</option>
            <option value="otro">Otro</option>
        </select>

        <br>
        
        
    </br>
    <label for=""><span>Documento</span></label>
        <input type="file" name="archivo">
    <br>
        <input type="reset" class="send" value="Borrar"></input>
        <input type="submit" class="send" value="Guardar" name="enviar"></input>
    </form>
    
    
    
    
    </div>
    
    
    
    
    
    </div>  
    
    <footer class="last">Insertar</footer>
    
    </body>
    </html>

<?php }else{
if (isset($_POST['enviar'])) {
    $id = null;
    $idUser = $_SESSION['nivel'];
    $nombre = $_POST['name'];
    $autor = $_POST['autor'];
    $editorial = $_POST['editorial'];
    $edicion = $_POST['edicion'];
    isset($_POST['tipo'])? $tipo = $_POST['tipo'] : $tipo = "-";
    $precio = $_POST['precio'];
    if (!empty($nombre) && !empty($autor) && !empty($edicion) && !empty($editorial) && !empty($_FILES)) {
        # code...
    
    
        $fecha = date('Y-m-d');
        $time = date('ism');
        //var_dump($time);
        $tipos = array('image/png','image/jpeg','application/pdf');
        if (in_array($_FILES['archivo']['type'],$tipos)) {
            $tamano = 1024*1024*60; 
            if ($_FILES['archivo']['size'] < $tamano) {
                $carpeta = "libros/";
                if (!file_exists($carpeta)) {
                mkdir($carpeta);
                }
                $carpeta .= "$nombre$time";
            //$carpeta .= "$idUser/$fecha";
            //if (!file_exists($carpeta)) {
              //  mkdir($carpeta);
            //}
                $tipo = $_FILES['archivo']['type'];
                $date = date('Ymd-His');

                if (strcmp($tipo,"application/pdf" == 0)) {
                $archivo = $carpeta.".pdf";   #nombramos a los archivos
                }elseif (strcmp($tipo,"image/png" == 0)) {
                $archivo = $carpeta.".png";
                }else {
                $archivo = $carpeta.".jpg";
                }
                $tmpName = $_FILES['archivo']['tmp_name'];  #guardamos el nombre temporal donde se alojo el archivo
                if (!file_exists($archivo)) {   //si no existe el archivo procedemos a guardarlo
                    if (move_uploaded_file($tmpName,$archivo)) {    #esta funcion mueve el archivo guardado temporalmente a la variable que contiene otro lugar de alojamiento, si es tru, si podra guardarlo
                        $sql = "INSERT INTO libros (id,nombre,autor,editorial,edicion,tipo,precio,archivo) VALUES (?,?,?,?,?,?,?,?)";
                            $request = $con->prepare($sql);
                            $request->bind_param("isssisis",$id,$nombre,$autor,$editorial,$edicion,$tipo,$precio,$archivo);
                        if ($request->execute()) {
                            $res = "¡Archivo guardado!";
                        }else $errors[] = " Ocurrio un error";
                    }else $errors[] = " No se pudo guardar el archivo";
                }else $errors[] = " El archivo ya existe";
            }else $errors[] = " El archivo excede el tamaño permitido";
        }else $errors[] = " Tipo de archivo no permitido";
    }else $errors[] = " faltan campos por llenar";
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
<h1>Nuevo Libro</h1>

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


<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="contact" id="general" enctype="multipart/form-data">
	<label for="name"><span>Nombre del libro</span></label>
	<input type="text" name="name" id="name" required></input></br>
	<label for="autor"><span>Autor</span></label>
	<input type="text" name="autor" id="autor" required>
    <label for="editorial"><span>Editorial</span></label>
	<input type="text" name="editorial" id="editorial" required></input></br>
	<label for="edicion"><span>Edición ó año</span></label>
	<input type="number" name="edicion" id="edicion" required>
    <label for="precio"><span>Precio</span></label>
	<input type="number" name="precio" id="edicion" required>
	
    <label for="tipo"><span>Tipo</span></label>
	<select name="tipo">
        <option value="-" selected disabled hidden>Selecciona uno</option>
            <option value="matematicas">Matemáticas</option>
            <option value="científicos">Ciencias-Cientificos</option>
            <option value="historia">Historia</option>
            <option value="filosofia">Filosofía</option>
            <option value="medico">Médicos</option>
            <option value="idiomas">Idiomas</option>
            <option value="informatica">Informática</option>
            <option value="literatura">Literatura</option>
            <option value="otro">Otro</option>
        </select>
    
	
</br>
<label for=""><span>Documento</span></label>
    <input type="file" name="archivo">
<br>
	<input type="reset" class="send" value="Borrar"></input>
	<input type="submit" class="send" value="Guardar" name="enviar"></input>
</form>




</div>





</div>  

<footer class="last">Insertar</footer>

</body>
</html>
<?php }?>