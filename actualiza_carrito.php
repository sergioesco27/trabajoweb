<?php
   session_start();
   include("conexion.php");
   if(isset($_POST["type"])&& $_POST['type']=='add' && $_POST["cantidad_p"]>0){
   	   foreach ($_POST as $key => $value) {
   	   	$new_product[$key]=filter_var($value, FILTER_SANITIZE_STRING);
   	   }
   	   //REMOVER VAR INNECESARIAS
   	   unset($new_product['type']);
   	   unset($new_product['return_url']);
   	   //tomar el noombre del producto u precio de la BD
   	   $statement=$mysqli->prepare("SELECT nombre_p, precio_p, stock_p FROM productos WHERE codigo_p=? LIMIT 1");
   	   $statement->bind_param('s', $new_product['codigo_p']);
   	   $statement->execute();
   	   $statement->bind_result($nombre_p, $precio,$stock);

 	   
         while($statement->fetch()){
   	   	//buscar nombre y precio del producto
   	   	$new_product["nombre_p"]=$nombre_p;
   	   	$new_product["precio_p"]=$precio;
            $new_product["stock_p"]=$stock;
            if(isset($_SESSION["carrito_p"])){//si la sesion
               
               if(isset($_SESSION["carrito_p"][$new_product['codigo_p']]))
               {
   	   		unset($_SESSION["carrito_p"][$new_product['codigo_p']]);
   	   	    }
   	        }
              if ($stock>=$_POST["cantidad_p"]) {
              $_SESSION["carrito_p"][$new_product['codigo_p']]=$new_product;
            }
  

       
   }
}
   //actualizacion o remocion de productos
   if(isset($_POST["cantidad_p"])|| isset($_POST["remove_code"]))
   {
   	//actualiza item cant session
   	if(isset($_POST["cantidad_p"])&& is_array($_POST["cantidad_p"])){
   		foreach($_POST["cantidad_p"] as $key => $value) {
   			if(is_numeric($value)){
   				$_SESSION["carrito_p"][$key]["cantidad_p"]=$value;
   			}
   		}

   	}
   	//remover un elemento a la sesion
   	if(isset($_POST["remove_code"])&& is_array($_POST["remove_code"])){
   		foreach ($_POST["remove_code"] as $key){
   		   unset($_SESSION["carrito_p"][$key]);
   		}
   	}
   }
   $return_url=(isset($_POST["return_url"]))?urldecode($_POST["return_url"]):'';
   header('Location:' .$return_url);
?>