<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Web compras</title>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>

<body>
<h1>APROVISIONAR - Nombre del alumno</h1>
<?php	
include "conexion.php";


/* Se muestra el formulario la primera vez */
if (!isset($_POST) || empty($_POST)) { 

	$almacenes = obtenerAlmacenes($db);
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
        CANTIDAD <input type="integer" name="cantidad" placeholder="cantidad" class="form-control">
        </div>

	<div class="form-group">
	<label for="almacen">Almacenes:</label>
	<select name="almacen">
	<?php foreach($almacenes as $almacen) : ?>
		<option> <?php echo $almacen ?> </option>
	<?php endforeach; ?>
	</select>
	</div>
		
	<div class="form-group">
	<label for="producto">Productos:</label>
	<select name="producto">
	<?php foreach($productos as $producto) : ?>
		<option> <?php echo $producto ?> </option>
	<?php endforeach; ?>
	</select>
	</div>
	</BR>
<?php
	echo '<div><input type="submit" value="Aprovisionar Producto"></div>
	</form>';
} else { 
	
	$cant = $_POST['cantidad'];
	$almacen = $_POST['almacen'];
	$producto = $_POST['producto'];
	
	$codigoProducto = obtenerCodigoProducto($db,$producto);
	
	$conn = new mysqli('localhost', 'root', 'rootroot', 'comprasweb');

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	$sql = "INSERT INTO almacena (num_almacen,id_producto,cantidad) VALUES ('$almacen','$codigoProducto','$cant')";

	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully";
	} else {
		
		$sql = "UPDATE almacena SET cantidad=cantidad+'$cant' where almacena.id_producto='$codigoProducto' and almacena.num_almacen='$almacen'";
		
		if ($conn->query($sql) === TRUE) {
			
			echo "New record created successfully";
			
		} else {
			
				echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
	
	$conn->close();
	
}
?>

<?php
// Funciones utilizadas en el programa

	function obtenerAlmacenes($db) {
	$almacenes = array();
	
	$sql = "SELECT num_almacen,localidad FROM almacen";
	
	$resultado = mysqli_query($db, $sql);
	if ($resultado) {
		while ($row = mysqli_fetch_assoc($resultado)) {
			$almacenes[] = $row['num_almacen'];
		}
	}
	return $almacenes;
}

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

?>



</body>

</html>