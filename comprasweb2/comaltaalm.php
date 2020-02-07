<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Web compras</title>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>

<body>
<h1>ALTA ALMACEN - Nombre del alumno</h1>
<?php
include "conexion.php";


/* Se muestra el formulario la primera vez */
if (!isset($_POST) || empty($_POST)) { 
	
    /* Se inicializa la lista valores*/
	echo '<form action="" method="post">';
?>
<div class="container ">
<!--Aplicacion-->
<div class="card border-success mb-3" style="max-width: 30rem;">
<div class="card-header">Datos Cliente</div>
<div class="card-body">
		<div class="form-group">
        NUM.ALMACEN <input type="integer" name="numalm" placeholder="Numero almacen" class="form-control">
        </div>
		<div class="form-group">
        LOCALIDAD <input type="text" name="localidad" placeholder="Localidad" class="form-control">
        </div>
		
	</div>
	</BR>
<?php
	echo '<div><input type="submit" value="Alta Almacen"></div>
	</form>';
} else { 
	
	$numalm = $_POST['numalm'];
	$localidad = $_POST['localidad'];
	
	$numalm = $numalm*10;
	
	$conn = new mysqli('localhost', 'root', 'rootroot', 'comprasweb');

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	$sql = "INSERT INTO almacen (num_almacen,localidad) VALUES ('$numalm','$localidad')";
	
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




?>



</body>

</html>