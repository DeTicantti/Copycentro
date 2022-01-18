<?php
if (empty($_POST['fechacam'])) {
    //cambio de contador
    ?>
<?php
require('../../funciones/conexion.php');
$errors = array();
$contador = array();
$total = array();
$idmaquina = $_POST['maquinaid'];
//$fechacam = $_POST['fechacam'];
$contafin = $_POST['conf'];
$contain = $_POST['coni'];
if (isset($_POST["maquinaid"]) && isset($_POST["conf"])) {
    //$id = $con->real_escape_string($_POST['maquinaid']);
    //$contFin = $con->real_escape_string($_POST['fechacam']);
    if ($contafin > $contain) {
        
    
    if (empty($idmaquina)) {
        $errors[] = "el id esta vacio";
    }else{
        $sql = "UPDATE contador SET contadori = ?, contadorf = ? WHERE maquinaid =?";
        $request = $con->prepare($sql);
        $request->bind_param("iii",$contain,$contafin,$idmaquina);
        $sql2 = "UPDATE contador SET contadori = ? WHERE maquinaid =?";
        
        if ($request->execute()) {
            $res = "¡contador actualizado¡";
        }else $errors[] = "Ocurrio un error";
        
        //$request->bind_param()
        
    }
    } else $errors[]= "Error en el contador final";
}else{
    
    $errors[] = "Ups! te falto algún campo";
}
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <META HTTP-EQUIV="REFRESH" CONTENT="2;URL=../../contadores.php"> 
        <link rel="stylesheet" href="../../style.css" type="text/css">
        <link rel="stylesheet" href="../../../fontawesomeweb/css/all.min.css" type="text/css">
    </head>
    <body>
    <div class="container">
        <div class="comments">
        <h1></h1>
            <div class="comment">
                <?php  
                
                if (isset($request)) {
                    if ($request) {
                        if ($con->affected_rows>0) {
                            echo "<div class='sucess'><i class='fas fa-check-circle'></i> ¡Contador actualizado!</div>";
                        }else{
                            $errors[] = "Este id no existe";
                        }
                    }else{$errors[] = "Error en la actualización";}
                }
                if (count($errors)>0) {
                    echo "<div class='error'>";
                    foreach($errors as $error){
                        echo "<i class='fas fa-exclamation-circle'></i>".$error."<br>";
                    }
                    echo "</div>";
                    }
                    $con->close();
                ?>    
                
                
            </div>
        
            
        </div>
    
    </div>
    <div class="btn-add">
        <a href="$"><i class="fas fa-plus-circle"></i></a>
    </div>
    
        
        
        <script src="" async defer></script>
    </body>
</html>
    
<?php }else { 
    //cambio de toner
    ?>

    
    <?php
require('../../funciones/conexion.php');
$errors = array();
$idmaquina = $_POST['maquinaid'];
$fechacam = $_POST['fechacam'];
//$contafin = $_POST['conf'];
if (isset($_POST["maquinaid"]) && isset($_POST["fechacam"])) {
    //$id = $con->real_escape_string($_POST['maquinaid']);
    //$contFin = $con->real_escape_string($_POST['fechacam']);
    
    if (empty($idmaquina)) {
        $errors[] = "el id esta vacio";
    }else{
        $sql = "UPDATE contador set fechacam = ? WHERE maquinaid =?";
        $request = $con->prepare($sql);
        $request->bind_param("si",$fechacam,$idmaquina);
        if ($request->execute()) {
            $res = "¡Toner añadido correctamente¡";
        }else $errors[] = "Ocurrio un error";
        
        //$request->bind_param()
        
    }
}else{
    
    $errors[] = "No puedes estar en esta página";
}
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <META HTTP-EQUIV="REFRESH" CONTENT="2;URL=../../contadores.php"> 
        <link rel="stylesheet" href="../../style.css" type="text/css">
        <link rel="stylesheet" href="../../../fontawesomeweb/css/all.min.css" type="text/css">
    </head>
    <body>
    <div class="container">
        <div class="comments">
        <h1></h1>
            <div class="comment">
                <?php  
                
                if (isset($request)) {
                    if ($request) {
                        if ($con->affected_rows>0) {
                            echo "<div class='sucess'><i class='fas fa-check-circle'></i> ¡Cambio de toner actualizado!</div>";
                        }else{
                            $errors[] = "Ya se cambio el toner el dia de hoy";
                        }
                    }else{$errors[] = "Error en la actualización";}
                }
                if (count($errors)>0) {
                    echo "<div class='error'>";
                    foreach($errors as $error){
                        echo "<i class='fas fa-exclamation-circle'></i>".$error."<br>";
                    }
                    echo "</div>";
                    }
                    $con->close();
                ?>    
                
                
            </div>
        
            
        </div>
    
    </div>
    <div class="btn-add">
        <a href="$"><i class="fas fa-plus-circle"></i></a>
    </div>
    
        
        
        <script src="" async defer></script>
    </body>
</html>
<?php }?>
