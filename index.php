<?php
session_start();
include("conexion.php");
$current_url = urlencode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
if(isset($_POST['login'])){
  $user=$_POST['usuario'];
  $password=$_POST['password'];
  if($user!=""&&$pass!=""){
    $seleccionUsuario=mysqli_query($conn,"SELECT * FROM usuarios WHERE usuario='$user' AND password='$pass' LIMIT 1");
    $totalUsuario=mysql_num_rows($seleccionUsuario);
    if($totalUsuario==1){
      $usuario=mysqli_fetch_assoc($seleccionUsuario);
      $_SESSION['carrito_p']=$usuario['user'];
      header("Location: listar.php");
    }else{
      header("Location: index.php?t=errorLogin");
    }
  }
}

?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Carrito de Compras Proyecto FInal</title>
<link href="estilo.css" rel="stylesheet" type="text/css">
</head>
<body>
<div align="center"><font color="blue" size="10" face="Arial"><b>Lista de Productos</b></font></div><br>

<?php
if(isset($_SESSION["carrito_p"]) && count($_SESSION["carrito_p"])>0)
{
  echo '<div class="cart-view-table-front" id="ver-carrito">';
  echo '<h3>Tu Carrito de Compras</h3>';
  echo '<form method="post" action="actualiza_carrito.php">';
  echo '<table width="100%"  cellpadding="6" cellspacing="0">';
  echo '<tbody>';

  $total =0;
  $b = 0;

  foreach ($_SESSION["carrito_p"] as $elemento_carrito)
  {
    $nombre_p = $elemento_carrito["nombre_p"];
    $cantidad_p = $elemento_carrito["cantidad_p"];
    $precio_p = $elemento_carrito["precio_p"];
    $codigo_p = $elemento_carrito["codigo_p"];
    $bg_color = ($b++%2==1) ? 'odd' : 'even';
   
    echo '<tr class="'.$bg_color.'">';
    echo '<td>Cantidad: <input type="text" size="2" maxlength="2" name="cantidad_p['.$codigo_p.']" value="'.$cantidad_p.'" /></td>';
    echo '<td>'.$nombre_p.'</td>';
    echo '<td><input type="checkbox" name="remove_code[]" value="'.$codigo_p.'" /> Remover</td>';
    echo '</tr>';
   
    $subtotal = ($precio_p * $cantidad_p);
    $total = ($total + $subtotal);

  }
  echo '<td colspan="4">';
  echo '<button type="submit">Actualiza</button><a href="ver_carrito.php">Checkout</a>';
  echo '</td>';
  echo '</tbody>';
  echo '</table>';
  $current_url = urlencode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
  echo '<input type="hidden" name="return_url" value="'.$current_url.'" />';
  echo '</form>';
  echo '</div>';
}

$results = $mysqli->query("SELECT codigo_p, nombre_p, descripcion_p, imagen_p, precio_p FROM productos ORDER BY id ASC");
if($results){ 
$elemento_p = '<ul class="productos">';
while($obj = $results->fetch_object())
{
$elemento_p .= <<<EOT
  <li>
  <form method="post" action="actualiza_carrito.php">
  <div ><h3>{$obj->nombre_p}</h3>
  <div ><img src="imagenes/{$obj->imagen_p}" width="65" height="65"></div>
  <li><div ">{$obj->descripcion_p}</div>
  <div ">
  
  <li>Precio {$moneda}{$obj->precio_p} 
  <br>
  <br>
  <fieldset>

  <label>
    <span>Cantidad de Productos: </span>
    <input type="text" size="2" maxlength="2" name="cantidad_p" value="" />
  </label>
  
  </fieldset>
  <input type="hidden" name="codigo_p" value="{$obj->codigo_p}" />
  <input type="hidden" name="type" value="add" />
  <input type="hidden" name="return_url" value="{$current_url}" />
  <br>

  <div align="center"><button >Agregar</button><div/></form>

  </div>
  </form>
  </li>
EOT;
}
$elemento_p .= '</ul>';
echo $elemento_p;
}
?>    
</body>
</html>