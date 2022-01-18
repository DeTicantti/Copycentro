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
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <META HTTP-EQUIV="REFRESH" CONTENT="2;URL=../../libros.php"> 
        <link rel="stylesheet" href="../../style.css" type="text/css">
        <link rel="stylesheet" href="../../../fontawesomeweb/css/all.min.css" type="text/css">
    </head>
    <body>
    <div class="container">
        <div class="comments">
        <h1>Modificado</h1>
            
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
                
                
            
        
            
        </div>
    
    </div>
    <div class="btn-add">
        <a href="$"><i class="fas fa-plus-circle"></i></a>
    </div>
    
        
        
        <script src="" async defer></script>
    </body>
</html>
    
