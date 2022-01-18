<?php
/*
$usuario = 'root';
$pass = '';
$db = "copycentro";
$host = "127.0.0.1";
$odbc = "mysql:dbname=copycentro;host=127.0.0.1";
$conex = new PDO($odbc,$usuario,$pass);
*/



    $dbhost = "localhost";
    $db = "copycentro";
    $dbuser = "root";
    $dbpass = "";

    try{
$cadena = "mysql:host=".$dbhost.";dbname=".$db;
$conex = new PDO($cadena,$dbuser,$dbpass);

//$otro = "insert into usuarios (id,usuario,pass,nivel) values (\"4\",\"yo\",\"no\",\"2\")";
//$query = $conex->query($otro);

//while ($registro = mysqli_fetch_array($query)) {
  //  echo $registro[0]." ".$registro[1]." ".$registro[3]." ".$registro[4]."</br>";
//}

echo $otro;

    }catch(PDOException $e){
        echo "ERROR ".$e->getMessage();
    }
   
    
?>