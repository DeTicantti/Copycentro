<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="FormularioUsuarios" content="Usuarios">

    <title>Intranet</title>
    <link href="../../style.css" rel="stylesheet" type="text/css">
    <link href="../style.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="intranet.js"> </script>


</head>
<body>
<div class="container">
<header>
    <div class="closeSession">
    <a href="../../usuarios.php">Volver</a>
    </div>
</header>

</br>
<div>
<h1>Modificar cliente</h1>

<form action="" method="post" class="contact" id="general">
	<label for="name"><span>Nombre:</span></label>
	<input type="text" name="name" id="name" required></input></br>
	<label for="precio"><span>Precio preferencial</span></label>
	<input type="text" name="precio" id="precio" require>
	<label for="mail"><span> E-mail: </span></label>
	<input type="email" name="mail" id="mail" required></input></br>
	<label for="fon"><span> Teléfono: </span></label>
	<input type="text" name="fon" id="fon"></input>
</br>
    <input type="file" name="archivo" id="archivo">
<br>
	<input type="reset" class="send" value="Borrar"></input>
	<input type="submit" class="send" value="Enviar"></input>
</form>




</div>





</div>  

<footer class="last">Modificar</footer>

</body>
</html>