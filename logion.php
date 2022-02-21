<?php
	if(isset($_GET['error'])&& $_GET['error']!="login"){
		header("Location: index.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>LoginEjemplo </title>
</head>
<body>
	<div><h1>LOGIN</h1>
		<?php  
			if(isset($_GET["error"])){
				echo "<p>usuario o contraseña invalidos.Intente nuevamente. </p>";

			}
		?>
		<form action="logion.php" method="post" >
			<div><input type="text" name="usuario" placeholder="Usuario">
			</div>
			<div><input type="password" name="password" placeholder="Contraseña">	
			</div>
			<button type="submit" name="enviar">Entrar</button>
		</form>
	</div>
</body>
</html>