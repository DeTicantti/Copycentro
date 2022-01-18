
<?php

include("funciones/menu.php");
session_start();

//seguridad extra
if ($_SESSION['nivel']== "1" || $_SESSION['nivel']=="2") {


if ($_SESSION['nivel'] == "1") {
    //asignamos menu
    $menu = getMenuAdmin();
    
}
else{   
    //asignamos menu
    $menu = getMenuUser();
}


require('funciones/conexion.php');
require('funciones/funcs.php');
if (!isset($_SESSION['nivel'])) {
    header('Location: ../index.php');
}
$sql = "SELECT * FROM clientes";
$res = $con->prepare($sql);
$res->execute();
$res->store_result();
$error = array();
?>
<!DOCTYPE html>
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
    $mod = "clientes";
    $menu2 = dabase($mod);
    echo $menu2;

?>

</div>

<div class="jumbotron barra">
        <?php
       
        ?>
        <article>
        <table id="example" class="table table-striped table-bordered" cellspading="0" width="100%">
                    <thead>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Fecha de registro</th>  
                        <th>Ultima visita</th>
                        <th>Precio especial</th>
                        <th>Acciones</th>    
                    </thead>
                    <tbody>
                        <?php
                        if ($res->num_rows>0) {
                            $res->bind_result($clienteid,$clientenom,$fechareg,$fechavis,$clientepre);
                        while ($res->fetch()) { ?>
                            
                            <tr>
                                <td>
                                    <?php echo $clienteid;?>
                                </td>
                                
                                <td>
                                    <?php echo $clientenom;?>
                                </td>
                                <td>
                                    <?php echo $fechareg;?>
                                </td>
                                <td>
                                
                                    <?php echo $fechavis;?>
                                    <div class="total">
                                    <a href="db/cli/done.php?id= <?php echo $clienteid ?>"><i class="fas fa-lg fa-retweet"></i></a>
                                </div>
                                </td>
                                <td>
                                <?php echo $clientepre;?>
                                </td> 
                                <td>
                                <div class="action left">
                                
                                <div class="errormn ns te">
                                    <a href="db/lib/insertar.php?cli=<?php echo $clienteid ;?>"><i class="fas fa-file-pdf"></i></a>
                                </div>
                                </div>
                                </td>
                            </tr>
                            
                            <?php
                }
                }else {$error[] = " no hay ningun cliente guardado";}

                if (count($error)> 0) {
                    echo "<div class='error'>";
                    foreach ($error as $mal){
                        echo "<i class='fas fa-exclamation-circle'></i>".$mal."<br>";
                    }
                    echo "</div>";
                }
                        
                       // $con->close();
                        ?>
                    </tbody>
                    <tfoot>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Fecha de registro</th>  
                        <th>Ultima visita</th>
                        <th>Precio especial</th>
                        <th>Acciones</th>  
                    </tfoot>
                </table>
                </article>
                <article>
                <?php 
                $sql2 = "SELECT l.nombre, l.autor, l.editorial, l.edicion, l.archivo, l.precio, u.nombre FROM libros l INNER JOIN clientes u ON l.clienteid = u.clienteid";
                $res2 = $con->prepare($sql2);
                $res2->execute();
                $res2->store_result();
                ?>
                <br>
                <br>
                <br>
                <br>
<div class="otra">

                <table id="examples" class="table table-striped table-bordered" cellspading="0" width="100%">
        <thead>
            <tr>                
                
                <th hidden>Editorial</th>
                <th>cliente</th>
                <th>Nombre</th>
                <th>Archivo</th>
                <th>Precio</th>
                
                <!--<th>Salary</th>-->
            </tr>
        </thead>
        <tbody>
        <?php


                        if ($res2->num_rows>0) {
                            //$res->bind_result($id,$nombre,$autor,$editorial,$edicion,$tipo,$precio,$archivo,$idcli);
                            $res2->bind_result($nombre,$autor,$editorial,$edicion,$archivo,$precio,$idcli);
                            while ($res2->fetch()) {
                             ?>
                            
                            <!--<th>-->
                            <tr>
                                
                                <td hidden>
                                    
                                    <?php echo $editorial;?>
                                </td>
                                <td>
                                    
                                    <?php echo $idcli;?>
                                </td>
                                
                                <td>
                                    <?php echo $nombre;?>
                                </td>
                                
                                
                                <td>
                                    <iframe src="db/lib/<?php echo $archivo;?>" class="rounded" alt=""></iframe>
                                </td> 
                                <td>
                                    <span class="precio">$</span><?php echo $precio?>
                                </td>
                                <!--<td>
                                <div class="action left">
                                <div class="sucessmn ns">
                                
                                    <a href="db/lib/modificar.php?id= <?php echo $id ;?>&nom=<?php echo $nombre ;?>&aut=<?php echo $autor ?>&edi=<?php echo $editorial?>&ed=<?php echo $edicion ?>&pre=<?php echo $precio?>&arch=<?php echo $archivo ?>"><i class="fas fa-xs fa-retweet"></i></a>
                                </div>
                                <div class="errormn ns">
                                    <a href="db/lib/borrar.php?id= <?php echo $id ;?>"><i class="fas fa-xs fa-trash-alt"></i></a>
                                </div>
                                </div>
                                </td>-->
                            </tr>
                            <!--</th>-->
                            <?php
                } }else {$error[] = " no hay ningun libro guardado";}

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
                <!--<th>Id</th>-->
                <th hidden>Editorial</th>
                <th>cliente</th>
                <th>Nombre</th>
                <th>Archivo</th>
                <th>Precio</th>
                
                <!--<th>Salary</th>-->
            </tr>
        </tfoot>
    </table>
    </article>

    </div>

</div>  
<div class="btn-add">
        <a href="$"><i class="fas fa-plus-circle"></i></a>
    </div>


<footer class="last">Bienvenido <?php echo $_SESSION['name']?></footer>

<div class="btn-add">
        <a href="db/cli/insertar.php"><i class="fas fa-plus-circle"></i></a>
    </div>

<script>
const head = document.querySelector('.lisCli');
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
             // 1 - inicializacion
              select:true,  
              
              //2 - tipo de selección 
              /*select:{
                  style:'sinlge' //single o multi
              }*/
                
               // 3 - fila o celda 
              /*select:{            
                items:'cell' //cell o row      
              }*/

            //4 - uso del checkbox
            /* columnDefs: [ {
                orderable: false,
                className: 'select-checkbox',
                targets: 0
            } ],
            select: {
                style:    'os',
                selector: 'td:first-child'
            },  */
            
            //5 - cambio de idioma     
            // language: {
            //     select: {
            //         rows: {
            //             _: "Ud. seleccionó %d registros", //msj cuando todavia no seleccionó nada
            //             0: "Haga clic en una fila para seleccionarla.", //aviso
            //             1: "Solo 1 fila seleccionada" //aviso
            //         }
            //     }
            // }


            // 6 - uso de botones
            /*dom: 'Bfrtip',
                buttons: [
                    'selected',
                    'selectedSingle',
                    'selectAll',
                    'selectNone',
                    'selectRows',
                    'selectColumns',
                    'selectCells'
                ],*/

         });
     })
     $(document).ready(function(){
         $("#examples").dataTable({
             // 1 - inicializacion
              select:true,  
              

         });
     })
    </script>
</body>
</html>
<?php


}else{
    define("inicio","../index.php?msj=id-denegado");
    header("location: ".inicio);
}
?>