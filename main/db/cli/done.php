<?php
require('../../funciones/conexion.php');
$errors = array();
$id = $_GET['id'];

if (isset($_GET['id'])) {
    

if (empty($id)) {
        $errors[] = "el id esta vacio";
    }else{
        $sql = "UPDATE clientes set fechavisita = NOW() WHERE clienteid = ?";
        $request = $con->prepare($sql);
        $request->bind_param("i",$id);
        if ($request->execute()) {
            $res = "¡Visita actualizada correctamente¡";
        }else $errors[] = "Ocurrio un error";
        
        //$request->bind_param()   
    }
}else $errors[] = "No puedes estar en esta página";

?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <META HTTP-EQUIV="REFRESH" CONTENT="2;URL=../../clientes.php"> 
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
                            echo "<div class='sucess'><i class='fas fa-check-circle'></i> ¡Visita agregada!</div>";
                        }else{
                            $errors[] = "Ya se registro la visita del dia de hoy";
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