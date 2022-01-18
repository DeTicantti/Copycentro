<?php
unset($_SESSION);
session_destroy();
define("inicio","../index.php?msj=gracias");
header("location: ".inicio);

?>