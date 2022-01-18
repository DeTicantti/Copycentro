<?php
declare(strict_types = 1);

function esVacia($user,$con,$rep):bool{
    if (!empty(trim($user)) && !empty(trim($con)) && !empty(trim($rep)) ) {
        return FALSE;
    }else{return TRUE;}

}
function validaLargo($atm):bool{
    $atm = trim($atm);
    if (strlen($atm)>3 && strlen($atm)<20) {
        return TRUE;
    }else {
        return FALSE;
    }
}

function usuarioExiste($usuaro):bool{
    global $con;
    $usuaro = trim($usuaro);
    $sql = "SELECT user FROM usuarios WHERE user = ?";
    $request = $con->prepare($sql);
    $request->bind_param('s',$usuaro);
    $request->execute();
    $request->store_result();
    $rows = $request->num_rows;
    $request->close();
    if($rows>0){
        return TRUE;
    }else {
        return FALSE;
    }
}

function validaPass($str,$str2):bool{
    if (strcmp($str,$str2)==0) {
        return TRUE;
    }else {
        return FALSE;
    }

}
function hashPass($contra):string{
    $hash = password_hash($contra, PASSWORD_DEFAULT);
    return $hash;
}
function registro($usuario,$contra):bool{
    global $con;
    global $name;
    $date = date("Y-m-d H:i:s");
    $id = null;
    $last = null;
    $sql = "INSERT INTO usuarios (user, pass, nombre) VALUES (?,?,?)";
    $request = $con->prepare($sql);
    $request->bind_param("sss",$usuario,$contra,$name);
    if ($request->execute()) {
        $request->close();
        return TRUE;
    }else {
        $request->close();
        return FALSE;
    }

}   
function loginVacio($user,$pass){
    if (!empty(trim($user)) && !empty(trim($pass))){
        return FALSE;
        # code...
    }else {
        return TRUE;
    }
}

function login($us,$pa){
    global $con;
    $sql = "SELECT userid, pass FROM usuarios WHERE user = ?";
    $request = $con->prepare($sql);
    $request->bind_param('s',$us);
    $request->execute();
    $request->store_result();
    $numrows = $request->num_rows;
    if ($numrows>0) {
        $request->bind_result($id,$contra);
        $request->fetch();
        $paContra = password_verify($pa, $contra);
        if($paContra){ 
            if ($us == "alicia") {
                $_SESSION['nivel']="1";
            }else {
                $_SESSION['nivel']="2";
            }
            $_SESSION['name']=$us;
            //$_SESSION['id']=$id;
            $lastSesion = lastSession($id);
            header("location: http://localhost/o8.0/desarrolloWeb/intranet/main/index.php");
        }else {
            return "Las contraseñas no coinciden";
        }
    }else {
        return "Ese usuario no existe";
    }

}
function lastSession($id){
    global $con;
    $request = $con->prepare("UPDATE user SET ultimaConexion = NOW() WHERE id = ?");
    $request->bind_param("i",$id);
    if ($request->execute()) {
        if ($request->affected_rows>0) {
            $request->close();
            return TRUE;
        }else{
            $request->close();
            return FALSE;}
    }else {
        $request->close();
        return FALSE;
    }
}

//trim quita los espacios en blanco de un string
//strcmp stringcompare, compara dos string, si son iguales devuelve 0
//fetch() vicula los resultados obtenidos en el bind_result
