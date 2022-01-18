<?php
require('../../funciones/conexion.php');
$errors = array();
if (isset($_GET['id'])) {
    $idComment = $con->real_escape_string($_GET['id']);
    if (empty($idComment)) {
        $errors[] = "el id esta vacio";
    }else{
        $sql = "DELETE FROM clientes WHERE clienteid = $idComment";
        $request = $con->query($sql);
        
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
        <META HTTP-EQUIV="REFRESH" CONTENT="2;URL=../../clientes.php"> 
        <link rel="stylesheet" href="../../style.css" type="text/css">
        <link rel="stylesheet" href="../../../fontawesomeweb/css/all.min.css" type="text/css">
    </head>
    <body>
    <div class="container">
        <div class="comments">
        <h1>Borrado</h1>
            <div class="comment">
                <?php  
                if (isset($request)) {
                    if ($request) {
                        if ($con->affected_rows>0) {
                            echo "<div class='sucess'><i class='fas fa-check-circle'></i> Cliente Borrado Correctamente</div>";
                        }else{
                            $errors[] = "Este cliente no existe";
                        }
                    }else{$errors[] = "Error en la consulta";}
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