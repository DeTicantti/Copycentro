<?php
$con = new mysqli("localhost","root","","copycentro");
if ($con->connect_errno) {
    echo "Algo salio mal ".$con->errno; 
}
