<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Web compras</title>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>

<body>
<h1>CONSULTA DE STOCK - Nombre del alumno</h1>
<?php
include "conexion.php";


/* Se muestra el formulario la primera vez */
if (!isset($_POST) || empty($_POST)) { 

	$productos = obtenerProductos($db);
	
    /* Se inicializa la lista valores*/
	echo '<form action="" method="post">';
?>
<div class="container ">
<!--Aplicacion-->
<div class="card border-success mb-3" style="max-width: 30rem;">
<div class="card-body">

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
	echo '<div><input type="submit" value="Consultar Stock"></div>
	</form>';
} else { 

	$producto = $_POST['producto'];
	
	$codigoProducto = obtenerCodigoProducto($db,$producto);
	
	$conn = new mysqli('localhost', 'root', 'rootroot', 'comprasweb');

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	obtenerCantidadProductos($db,$codigoProducto);
	
	$conn->close();
	
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

function obtenerCantidadProductos($db,$id) {

	$sql = "SELECT cantidad,id_producto from almacena where id_producto='$id'";
	
	$resultado = mysqli_query($db, $sql);
	
	if (mysqli_num_rows($resultado) > 0) {
    
    while($row = mysqli_fetch_assoc($resultado)) {
        echo "Codigo del Producto: " . $row["id_producto"] ." | Cantidad del Producto: ". $row["cantidad"]. "<br>";
    }
} else {
    echo "No hay stock del producto seleccionado";
}
	
	
}


?>



</body>

</html>