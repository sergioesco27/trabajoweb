<?php 

session_start();

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Ejercicio con sesiones</title>
</head>
<body>
	<?php 
		if(isset($_SESSION["USUARIO VALIDO"]))
			echo "bienvenido";
		else
			echo "noautorizado";
</body>
</html>