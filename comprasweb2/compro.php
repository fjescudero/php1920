<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Web compras</title>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>

<body>
<h1>COMPRA DE PRODUCTOS - Nombre del alumno</h1>
<?php	
include "conexion.php";
session_start();


/* Se muestra el formulario la primera vez */
if (!isset($_POST) || empty($_POST)) { 

	$productos = obtenerProductos($db);
	
	
    /* Se inicializa la lista valores*/
	echo '<form action="" method="post">';
?>
<div class="container ">
<!--Aplicacion-->
<div class="card border-success mb-3" style="max-width: 30rem;">
<div class="card-header">Datos Producto</div>
<div class="card-body">

	<div class="form-group">
	<label for="producto">Productos:</label>
	<select name="producto">
	<?php foreach($productos as $producto) : ?>
		<option> <?php echo $producto ?> </option>
	<?php endforeach; ?>
	</select>
	</div>
	
	<div class="form-group">
	Cantidad a Comprar <input type="integer" name="cantidad" placeholder="cantidad" class="form-control">
    </div>
	
	<div class="form-group">
	Almacen <input type="integer" name="almacen" placeholder="almacen" class="form-control">
    </div>
	
	<input type="submit" value="Comprar" name="comprar">
	<input type="submit" value="Agregar a la Cesta" name="agregar">
	<input type="submit" value="Limpiar la Cesta" name="limpiar">
	
	</BR>
<?php
	echo '</form>';
	
} else { 
	
	if(isset($_POST['comprar'])) {
	
	echo "Su compra es: ";
	
	var_dump($_SESSION['$cesta']);
	
	echo "Procediendo a la compra de sus productos: ";
	
	$longi=count($_SESSION['$cesta']);
	
	for($i=0; $i<$longi; $i++) {
	
	$producto = $_SESSION['$cesta'][$i][0];
	$cant = $_SESSION['$cesta'][$i][1];
	$almacen = $_SESSION['$cesta'][$i][2];
	
	$fecha=obtenerFecha($db);
	
	$nomb=$_SESSION['nombre'];
	
	$nif=obtenerClientes($db,$nomb);
	
	$codigoProducto = obtenerCodigoProducto($db,$producto);
	
	$conn = new mysqli('localhost', 'root', 'rootroot', 'comprasweb');

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	if(obtenerCantidadProducto($db,$codigoProducto)>0){
		
		if((obtenerCantidadProducto($db,$codigoProducto)-$cant)>0){
			
			$sql = "UPDATE almacena SET cantidad=cantidad-'$cant' where almacena.id_producto='$codigoProducto' and almacena.num_almacen='$almacen'";
			
			$conn->query($sql);
			
			$sql = "INSERT INTO compra (nif,id_producto,fecha_compra,unidades) VALUES ('$nif','$codigoProducto','$fecha','$cant')";
			
			if ($conn->query($sql) === TRUE) {
				echo "New record created successfully";
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
			
		} else {
		
			echo "No hay suficiente stock del producto seleccionado";
		
		}
		
	} else {
		
		echo "No hay stock del producto seleccionado";
		
	}
	
	$conn->close();
	
	}
	
	}
	
	if (isset($_POST['agregar']) && !empty($_POST['agregar'])) {
	  
			if (!isset($_SESSION['$cesta'])){
				
				$_SESSION['$cesta']=array(array($_POST['producto'],$_POST['cantidad'],$_POST['almacen']));
		   
			} else {
				
				array_push($_SESSION['$cesta'],array($_POST['producto'],$_POST['cantidad'],$_POST['almacen']));
		   	
			}
		
		echo "CESTA DE LA COMPRA: ";
		
		var_dump($_SESSION['$cesta']);
		
	}
	
	if(isset($_POST['limpiar'])) {
	
		$_SESSION['$cesta']=null;
		
		echo "Borrando los datos de su cesta...";
		
		echo "</br></br>";
		
		echo "Cesta vacia.";
	
	}
	
	
}
?>

<?php
// Funciones utilizadas en el programa

	function obtenerProductos($db) {
	$productos = array();
	
	$sql = "SELECT id_producto,nombre from producto";
	
	$resultado = mysqli_query($db, $sql);
	if ($resultado) {
		while ($row = mysqli_fetch_assoc($resultado)) {
			$productos[] = $row['nombre'];
		}
	}
	return $productos;
}

	function obtenerCodigoProducto($db,$producto) {

	$idProducto = null;
	
	$sql = "SELECT id_producto,nombre FROM producto WHERE nombre = '$producto'";
	$resultado = mysqli_query($db, $sql);
	if ($resultado) {
		while ($row = mysqli_fetch_assoc($resultado)) {
			$idProducto = $row['id_producto'];
		}
	}
	
	return $idProducto;

}

	function obtenerCantidadProducto($db,$producto) {

	$idProducto = null;
	
	$sql = "SELECT id_producto,cantidad FROM almacena WHERE id_producto = '$producto'";
	$resultado = mysqli_query($db, $sql);
	if ($resultado) {
		while ($row = mysqli_fetch_assoc($resultado)) {
			$idProducto = $row['cantidad'];
		}
	}
	
	return $idProducto;
}

	function obtenerClientes($db,$nombre) {
	$clientes = null;
	
	$sql = "SELECT dni,usuario FROM usuariosreg where usuario='$nombre'";
	
	$resultado = mysqli_query($db, $sql);
	if ($resultado) {
		while ($row = mysqli_fetch_assoc($resultado)) {
			$clientes = $row['dni'];
		}
	}
	
	return $clientes;
}	

	function obtenerFecha($db) {
	
	$sql = "SELECT sysdate() as hoy";
	
	$resultado = mysqli_query($db, $sql);
	$row = mysqli_fetch_assoc($resultado);
	$fecha = $row['hoy'];

	return $fecha;
}	


?>

<br/><br/>

<a href="compro.php">Comprar</a>
<a href="pagina2.php">Inicio</a>

</body>

</html>