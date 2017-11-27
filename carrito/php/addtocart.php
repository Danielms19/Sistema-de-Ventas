<?php
/*
* Agrega el producto a la variable de sesion de productos.
*/
session_start();
if(!empty($_POST)){
	if(isset($_POST["servicio_id"]) && isset($_POST["cantidad"])){
		// si es el primer producto simplemente lo agregamos
		if(empty($_SESSION["carrito"])){
			$_SESSION["carrito"]=array( array("servicio_id"=>$_POST["servicio_id"],"cantidad"=> $_POST["cantidad"]));
		}else{
			// apartie del segundo producto:
			$cart = $_SESSION["carrito"];
			$repeated = false;
			// recorremos el carrito en busqueda de producto repetido
			foreach ($cart as $c) {
				// si el producto esta repetido rompemos el ciclo
				if($c["servicio_id"]==$_POST["servicio_id"]){
					$repeated=true;
					break;
				}
			}
			// si el producto es repetido no hacemos nada, simplemente redirigimos
			if($repeated){
				print "<script>alert('Error: Producto Repetido!');</script>";
			}else{
				// si el producto no esta repetido entonces lo agregamos a la variable cart y despues asignamos la variable cart a la variable de sesion
				array_push($cart, array("servicio_id"=>$_POST["servicio_id"],"cantidad"=> $_POST["cantidad"]));
				$_SESSION["carrito"] = $cart;
			}
		}
		print "<script>window.location='../products.php';</script>";
	}
}

?>

