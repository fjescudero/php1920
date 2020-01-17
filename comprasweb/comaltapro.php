<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Web compras</title>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>

<body>
<h1>ALTA PRODUCTOS - Nombre del alumno</h1>
<?php
include "conexion.php";


/* Se muestra el formulario la primera vez */
if (!isset($_POST) || empty($_POST)) { 

	$categorias = obtenerCategorias($db);
	
    /* Se inicializa la lista valores*/
	echo '<form action="" method="post">';
?>
<div class="container ">
<!--Aplicacion-->
<div class="card border-success mb-3" style="max-width: 30rem;">
<div class="card-header">Datos Producto</div>
<div class="card-body">
		<div class="form-group">
        ID PRODUCTO <input type="text" name="idproducto" placeholder="idproducto" class="form-control">
        </div>
		<div class="form-group">
        NOMBRE PRODUCTO <input type="text" name="nombre" placeholder="nombre" class="form-control">
        </div>
		<div class="form-group">
        PRECIO PRODUCTO <input type="text" name="precio" placeholder="precio" class="form-control">
        </div>
	<div class="form-group">
	<label for="categoria">Categorías:</label>
	<select name="categoria">
	<?php foreach($categorias as $categoria) : ?>
		<option> <?php echo $categoria ?> </option>
	<?php endforeach; ?>
	</select>
	</div>
	</BR>
<?php
	echo '<div><input type="submit" value="Alta Producto"></div>
	</form>';
} else { 
	
	$idprod = $_POST['idproducto'];
	$nombre = $_POST['nombre'];
	$prec = $_POST['precio'];
	$categoria = $_POST['categoria'];
	
	$codigo = obtenerCodigo($db,$categoria);
	
	$conn = new mysqli('10.129.22.185', 'root', 'rootroot', 'comprasweb');

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	$sql = "INSERT INTO producto (id_producto,nombre,precio,id_categoria) VALUES ('$idprod','$nombre','$prec','$codigo')";

	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
	
}
?>

<?php
// Funciones utilizadas en el programa

	function obtenerCategorias($db) {
	$categorias = array();
	
	$sql = "SELECT id_categoria,nombre FROM categoria";
	
	$resultado = mysqli_query($db, $sql);
	if ($resultado) {
		while ($row = mysqli_fetch_assoc($resultado)) {
			$categorias[] = $row['nombre'];
		}
	}
	return $categorias;
}

	function obtenerCodigo($db,$categoria) {

	$idCategoria = null;
	
	$sql = "SELECT id_categoria FROM categoria WHERE nombre = '$categoria'";
	$resultado = mysqli_query($db, $sql);
	if ($resultado) {
		while ($row = mysqli_fetch_assoc($resultado)) {
			$idCategoria = $row['id_categoria'];
		}
	}
	
	return $idCategoria;

}

	




?>



</body>

</html>
