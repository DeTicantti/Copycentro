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
    $name = trim($_POST['name']);
    $user = trim($_POST['usuario']);
    $pass = $_POST['contrasena'];
    $passRe = $_POST['repContrasena'];
    if (!esVacia($user,$pass,$passRe)) {     //true si es vacia false si no es vacia
        
        if (!is_numeric($user)) {
            
            if (validaLargo($user)) {
                
                if (!usuarioExiste($user)) {
                    
                    if (validaPass($pass,$passRe)) {
                        $hash = hashPass($pass);
                        
                        if (registro($user,$hash)) {
                            $registro = "el usuario se registro correctamente";
                        }else {
                            $errors[] = "error en el registro";
                        }
                    }else {
                        $errors[] = "Las contraseñas no coinciden";
                    }
                }else {
                    $errors[] = "El usuario ya existe";
                }
                
            }else {
                $errors[] = "Tu usuario debe ser mayor a 3 caracteres y menor a 20";
                
            }
            
        }else {
            $errors[] = "Tu usuario no puede ser de solo numeros";
            
        }
    }else{
        $errors[] = "no puedes dejar campos vacios";
        
    }
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
    <a href="../../usuarios.php">Volver</a>
    </div>
</header>

</br>
<div>
<h1>Nuevo usuario</h1>
<?php
if (isset($registro)) {
            
            if(isset($registro)){
                ?>
                <div class="bg sucess text-white p-2 mx-5 text-center">
                    <?php echo $registro;?>
                </div>
            
            <?php
            }else $errors[] = "algo salio mal";

        }
        include('../../funciones/errors.php');
            ?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="contact" id="general">
	<label for="name"><span>Nombre:</span></label>
	<input type="text" name="name" id="name" required></input></br>
	<label for="precio"><span>Usuario</span></label>
	<input type="text" name="usuario" require>
	<label for="mail"><span>Contraseña</span></label>
	<input type="password" name="contrasena" required></input></br>
	<label for="fon"><span>Confirmar contraseña </span></label>
	<input type="password" name="repContrasena" required></input>

	<input type="reset" class="send" value="Borrar"></input>
	<input type="submit" class="send" value="Enviar" name="enviar"></input>
</form>




</div>





</div>  

<footer class="last">Insertar</footer>

</body>
</html>