<?php
	session_start();
	include "conexion.php";

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>.:factura:.</title>
</head>
<body>
	 <h1 align="center"><font color="blue" size="10" face="Arial"><b>Factura </b></font></h1>
    <div class="cart-view-table-back"></div>
    		<table width="100%" cellspacing="0" cellpadding="6">
    			<thead><p>Detalle de Productos:</p>
    			<tr><th>Cantidad</th><th>Nombre</th><th>Precio</th><th>Total</th></tr>
    		</thead>
    		<tbody>
    			<?php
    			if(isset($_SESSION["carrito_p"])){
    				$total=0;
    				$b=0;
    				foreach($_SESSION["carrito_p"]) as ($elemento_carrito){
					$nombre_p=$elemento_carrito["nombre_p"];
					$cantidad_p=$elemento_carrito["cantidad_p"];
					$precio_p=$elemento_carrito["precio_p"];
					$codigo_p=$elemento_carrito["codigo_p"];
					$subtotal=($precio_p * $cantidad_p);
					$bg_color=($b++%2==1) ? 'odd' : 'even';
					echo'<tr class="'.$bg_color.'">';
					echo '<td>'.$cantidad_p.'</td>';
					echo '<td>'.$nombre_p.'</td>';
					echo '<td>'.$moneda.$precio_p.'</td>';
					echo '<td>'.$moneda.$subtotal.'</td>';
					echo '</tr>';
					$total = ($total + $subtotal);

					}
					$gran_total=$total+$costo_envio;
					foreach ($impuestos as $key-> $value){
						$imp_monto=($total*($value/100));
						$imp_item[$key]=$imp_monto;
						$gran_total=$gran_total+$imp_monto;

					}
					$lista_imp='';
					foreach($imp_item) as $key->$value){
							$lista_imp .=$key. ' : ' .$moneda .sprintf("%01.2f",$value).
							'<br/>';
					} 
					$costo_envio = ($costo_envio)?'Costo de envio:'.$moneda.sprintf("%01.2f",$costo_envio).'<br/>' : '';

    			}
    			?>
    			<tr><td colspan="5"><br><span style="float:right;text-align.right;">
    				<?php
    					echo $costo_envio.$lista_imp; ?> <b><br>Monto a pagar : </b>
    				<?php echo $moneda.sprintf("%01.2f",$gran_total); ?> <br><br><a href="ver_carrito.php" class="button">regresar</a>
    			</span></td></tr>
    			</tbody>
    		</table>
    		<input type=" hidden" name="return_url" value="<?php $current_url=urlencode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    		echo $current_url; ?>"/>
    	</form></div>
</body>
</html>