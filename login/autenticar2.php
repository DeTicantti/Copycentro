<?php
session_start();
//include("../configuracion.php");
require('../main/funciones/funcs.php');
require('../main/funciones/conexion.php');
$errors = array();

 if (isset($_POST['enviar'])) {
    $user = $_POST["name"];
    $user = addslashes($user);
    $user = strip_tags($user);
    $pass = $_POST["pass"];
    $pass = addslashes($pass);
    $pass = strip_tags($pass);
    $sql = "SELECT userid, pass FROM usuarios WHERE user = ?";
    $request = $con->prepare($sql);
    $request->bind_param('s',$user);
    $request->execute();
    $request->store_result();
    $numrows = $request->num_rows;
    echo $numrows;
    if ($numrows>0) {
        $request->bind_result($id,$contra);
        $request->fetch();
        $paContra = password_verify($pass, $contra);
        echo $pass;
        echo $contra;
        if($paContra){ 
            $_SESSION['user']=$user;
            $_SESSION['id']=$id;
            $_SESSION['name'] = $user;
            if ($_SESSION['user']== "carlos") {
                
            $_SESSION['nivel']="1";
            }else {
                $_SESSION['nivel']="2";
            }

            //$lastSesion = lastSession($id);
            define("inicio","../main/index.php");
            header("location:".inicio); 
        }else {
            define("inicio","../index.php?msj=msjError");
            header("location:" .inicio);
            
        }
    }else {
            define("inicio","../index.php?msj=msjError");
            header("location:" .inicio);
    }
 }else {
    define("inicio","../index.php?msj=msjError");
    header("location:" .inicio);
 }
 


//conexion a la base de datos

//$ip = $_SERVER['REMOTE_ADDR'];
/*
if ($user == "adm" && $pass == "adm") {
            /*Variable de sesión
    session_start();
    $_SESSION['nivel']="1"; 
    $_SESSION['name'] = $user;
    define("inicio","../main/index.php");
    header("location:".inicio); 

}
elseif($user == "hola" && $pass == "hola"){
        /*Variable de sesión
        session_start();
        $_SESSION['nivel']="2";
        $_SESSION['name']= $user; 
        define("inicio","../main/index.php");
        header("location:".inicio); 
    
}

else{
    define("inicio","../index.php?msj=msjError");
    header("location:" .inicio);
}

*/
?>