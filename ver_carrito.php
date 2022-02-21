<<?php 
session_start();
include "conexion.php";
 ?>

 <!DOCTYPE html>
 <html>
 <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FACTURA</title>
    <link rel="stylesheet" type="text/css" href="estilo.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

 </head>
 <body>
    <center>
    <h1 align="center"><font color="green" size="15" face="Arial"><b>Factura</b></font></h1>
    <div class="cart-view-table-back"></div>
    <table width="100%" cellspacing="0" cellspacing="6">
        <thead><p>Detalle de productos</p>
        <tr><th>Cantidad</th><th>Nombre</th><th>Precio</th><th>Total</th></thead>
        <tbody>
            <?php  
                if(isset($_SESSION['carrito_p'])){
                    $total=0;
                    $b=0;
                    foreach ($_SESSION['carrito_p'] as $elemento_carrito) {
                        $nombre_p=$elemento_carrito["nombre_p"];
                        $cantidad_p=$elemento_carrito["cantidad_p"];
                        $precio_p=$elemento_carrito["precio_p"];
                        $codigo_p=$elemento_carrito["codigo_p"];
                        $subtotal=($precio_p*$cantidad_p);
                        $bg_color = ($b++%2==1) ? 'odd' : 'even';
                        echo '<tr class="table"'.$bg_color.'">';
                        echo '<td scope="col">'.$cantidad_p.'</td>';
                        echo '<td scope="col">'.$nombre_p.'</td>';
                        echo '<td scope="col">'.$moneda.$precio_p.'</td>';
                        echo '<td scope="col">'.$moneda.$subtotal.'</td>';
                        echo  '</tr>';
                        $total=($total+$subtotal);

                        echo '<td scope="col"></td>';
                        echo '<td scope="col" ></td>';
                        echo '<td scope="col" ><p>Subtotal</p></td>';
                        echo '<td scope="col" ><b>'.$moneda.$total.'</b></td>';
                    }
                    $gran_total=$total+$costo_envio;
                    foreach ($impuestos as $key => $value) {
                        $imp_monto=($total*($value/100));
                        $imp_item[$key]=$imp_monto;
                        $gran_total=$gran_total+$imp_monto;
                    }
                    $lista_imp='';
                    foreach ($imp_item as $key => $value) {
                        $lista_imp.=$key.' :  '.$moneda.sprintf("%01.2f",$value).'</br>';
                    }
                    $costo_envio=($costo_envio)?'Costo de envio: '.$moneda.sprintf("%01.2f",$costo_envio).'</br>':'';
                }
            ?>
            <tr><td colspan="5"><br><span style="float:right;text-align.right">
              
                <?php 
                    echo $costo_envio.$lista_imp; ?><b><br>Monto a pagar:</b>
                <?php 
                    echo $moneda.sprintf("%01.2f",$gran_total);
                 ?> 
                 <br>

                 <br><a href="ver_carrito.php" class="button">regresar</a></span></td></tr>
        </tbody>
        <input type="hidden" name="return_url" value="<?php  $current_url=urlencode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
            echo $curren_url; ?>">
    </table>
    </center>
 </body>
 </html>