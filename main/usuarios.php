<?php

include("funciones/menu.php");
session_start();

//seguridad extra
if ($_SESSION['nivel']== "1" || $_SESSION['nivel']=="2") {


    if ($_SESSION['nivel'] == "1") {
    //asignamos menu
    $menu = getMenuAdmin();
    
    }else{   
    //asignamos menu
    $menu = getMenuUser();
    }



    require('funciones/conexion.php');
    require('funciones/funcs.php');
    if (!isset($_SESSION['nivel'])) {
        header('Location: ../index.php');
    }
    $sql = "SELECT * FROM usuarios";
    $res = $con->prepare($sql);
    $res->execute();
    $res->store_result();
    $error = array();
    ?>
    <!doctype html>
    <html lang="en">
  <head>
  <meta charset="UTF-8">
    <meta name="FormularioUsuarios" content="Inventario">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Intranet</title>
    <link href="../style.css" rel="stylesheet" type="text/css">
    <link href="style.css" rel="stylesheet" type="text/css">
    <!--<link href="https://cdn.datatables.net/r/bs-3.3.5/jq-2.1.4,dt-1.10.8/datatables.min.css" rel="stylesheet" type="text/css" />
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />

    <link href="css/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />-->
    <link href="fontawesomeweb/css/all.min.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="../intranet.js"> </script>
    <!--<script type="text/javascript" src="dataTables.bootstrap.js"></script>-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <!-- datatables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <!-- datatables extension SELECT -->
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">
    <!-- extension BOTONES -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">

   <style>
   table.dataTable thead, table.dataTable tfoot {
           background: linear-gradient(to right, #3F5EFB, #FC466B);
       }
   </style>

  </head>
  <body>
  <div class="container">
        <header>
        <div class="headerr"><img src="../img/logocopycentro.pn" alt=""></div>
    
        <h2>Bienvenido, <?php echo $_SESSION['name']?></h2>
        <div class="closeSession">
            <a href="../login/salir.php">Cerrar sesión</a>
        </div>
        </header>
        <?php
        echo $menu;
        ?>
        </br>

    

        <div class="menu2">
            <?php 
            $mod = "usuarios";
            $menu2 = dabase($mod);
            echo $menu2;
        
            ?>
        </div>

<!-- para ejemplo simple -->
<table id="example" class="display" style="width:100%">
        <thead>
            <tr>                
                <!--<th>Id</th>-->
                <th hidden>ID</th>
                <th>Nombre</th>
                <th>Usuario</th>
                <th>Acciones</th>
                
            </tr>
        </thead>
        <tbody>
        <?php
                        if ($res->num_rows>0) {
                            $res->bind_result($id,$usuario,$pass,$nombre);
                        while ($res->fetch()) { ?>
                            <tr>
                                <td hidden>
                                <?php echo $id;?>
                                </td>
                                <td>
                                    <?php echo $nombre;?>
                                </td>
                                <td>
                                    <?php echo $usuario;?>
                                </td>
                                <td>
                                <div class="action left">
                                <div class="errormn ns">
                                    <a href="db/us/eliminar.php?id= <?php echo $id ;?>"><i class="fas fa-trash-alt"></i></a>
                                </div>
                                </div>
                                </td>
                            </tr>
                            
                            <?php
                }
                }else {$error[] = " no hay ningun usuario guardado";}

                if (count($error)> 0) {
                    echo "<div class='error'>";
                    foreach ($error as $mal){
                        echo "<i class='fas fa-exclamation-circle'></i>".$mal."<br>";
                    }
                    echo "</div>";
                }
                        
                        $con->close();
                        ?>
        </tbody>
        <tfoot>
            <tr>
                <th hidden>ID</th>
                <th>Nombre</th>
                <th>Usuario</th>
                <th>Acciones</th>
            </tr>
        </tfoot>
    </table>
  </div>
  <div class="btn-add">
        <a href="$"><i class="fas fa-plus-circle"></i></a>
    </div>

<footer class="last">Bienvenido <?php echo strtoupper($_SESSION['name'])?></footer>

<!--<script src="" async defer></script>-->

<div class="btn-add">
        <a href="db/us/insertar.php"><i class="fas fa-plus-circle"></i></a>
    </div>

    <script>
const head = document.querySelector('.lisUsu');
    head.classList.add('current');
    </script>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

     <!-- datatables-->
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    
    <!-- datatables extension SELECT -->
    <script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
    
    <!-- extension BOTONES -->
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>

    <script>
     $(document).ready(function(){
         $("#example").dataTable({
             
              select:true,  
              
              
         });
     })
    </script>
  </body>
</html>
<?php }else{
    define("inicio","../index.php?msj=id-denegado");
    header("location: ".inicio);
}?>