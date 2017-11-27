<?php
/*
* Este archio muestra los productos en una tabla.
*/
session_start();
include "php/conection.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
</head>
<body>
	<nav class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="index.php">Grusotec</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="index.php">Inicio</a></li>
      </ul>
    </div>
  </div>
</nav>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>Servicios</h1>
			<a href="./cart.php" class="btn btn-warning">Ver Carrito</a>
			<br><br>
<?php
/*
* Esta es la consula para obtener todos los productos de la base de datos.
*/
$products = $con->query("select * from servicio");
?>
<table class="table table-bordered">
<thead>
	<th>Servicio</th>
	<th>Descripcion</th>
	<th>Precio</th>
	<th></th>
</thead>
<?php 
/*
* Apartir de aqui hacemos el recorrido de los productos obtenidos y los reflejamos en una tabla.
*/
while($r=$products->fetch_object()):?>
<tr>
	<td><?php echo $r->nombre;?></td>
	<td><?php echo $r->descripcion;?></td>
	<td style="width:80px;">S/. <?php echo $r->precio; ?></td>
	<td style="width:260px;">
	<?php
	$found = false;

	if(isset($_SESSION["carrito"])){ foreach ($_SESSION["carrito"] as $c) { if($c["servicio_id"]==$r->id){ $found=true; break; }}}
	?>
	<?php if($found):?>
		<a href="cart.php" class="btn btn-info">Agregado</a>
	<?php else:?>
	<form class="form-inline" method="post" action="./php/addtocart.php">
	<input type="hidden" name="servicio_id" value="<?php echo $r->id; ?>">
	  <div class="form-group">
	    <input type="number" name="cantidad" value="1" style="width:100px;" min="1" class="form-control" placeholder="Cantidad">
	  </div>
	  <button type="submit" class="btn btn-primary">Agregar al carrito</button>
	</form>	
	<?php endif; ?>
	</td>
</tr>
<?php endwhile; ?>
</table>
<br><br><hr>
<p>© Todo los derechos son reservados.</p>
		</div>
	</div>
</div>
</body>
</html>