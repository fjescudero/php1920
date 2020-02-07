<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Web compras</title>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>

<body>
<h1>CONSULTA DE COMPRAS - Nombre del alumno</h1>
<?php
include "conexion.php";


/* Se muestra el formulario la primera vez */
if (!isset($_POST) || empty($_POST)) { 

	$clientes = obtenerClientes($db);
	
    /* Se inicializa la lista valores*/
	echo '<form action="" method="post">';
?>
<div class="container ">
<!--Aplicacion-->
<div class="card border-success mb-3" style="max-width: 30rem;">
<div class="card-body">

	<div class="form-group">
	<label for="cliente">Clientes:</label>
	<select name="cliente">
	<?php foreach($clientes as $cliente) : ?>
		<option> <?php echo $cliente ?> </option>
	<?php endforeach; ?>
	</select>
	</div>
	</BR>
	
	<div class="form-group">
	Fecha 1 <input type="date" name="fecha1" class="form-control">
    </div>
	
	<div class="form-group">
	Fecha 2 <input type="date" name="fecha2" class="form-control">
    </div>
	
	</BR></BR>
	
	
<?php
	echo '<div><input type="submit" value="Consulta Compras"></div>
	</form>';
} else { 
	
	$cliente = $_POST['cliente'];
	$fecha1 = $_POST['fecha1'];
	$fecha2 = $_POST['fecha2'];
	
	$conn = new mysqli('localhost', 'root', 'rootroot', 'comprasweb');
			
		obtenerCompras($db,$cliente,$fecha1,$fecha2);

	$conn->close();
	
}

?>

<?php
// Funciones utilizadas en el programa

	function obtenerClientes($db) {
	$clientes = array();
	
	$sql = "SELECT nif,nombre FROM cliente";
	
	$resultado = mysqli_query($db, $sql);
	if ($resultado) {
		while ($row = mysqli_fetch_assoc($resultado)) {
			$clientes[] = $row['nif'];
		}
	}
	return $clientes;
}	

	function obtenerCompras($db,$cliente,$fecha1,$fecha2) {

		$sql = "SELECT nif,id_producto,fecha_compra,unidades from compra where nif='$cliente' and fecha_compra>'$fecha1' and fecha_compra<'$fecha2'";
	
		$resultado = mysqli_query($db, $sql);
	
		if ($resultado) {
			while($row = mysqli_fetch_assoc($resultado)) {
				echo "Codigo del Cliente: " . $row["nif"] ." | Codigo del Producto: ". $row["id_producto"]. " | Unidades: ". $row["unidades"]." | Fecha: ". $row["fecha_compra"]."<br>";
			}
		}
	}


?>



</body>

</html>