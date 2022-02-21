<?php
	$moneda='$ ';
	$localhost='localhost';
	$usuario='root';
	$contrasena='';
	$nombre_bd='carrito';
	$costo_envio=1.50;
	$impuestos =array('IVA'=>12, 'imp_salida_divisa'=>5);
	$mysqli=new mysqli($localhost, $usuario, $contrasena, $nombre_bd);
	if($mysqli->connect_error){
		die('error: ('.$mysqli->connect_errno .') '.$mysqli->connect_error);
	}
?>