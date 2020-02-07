<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Web compras</title>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>

<body>
<h1>ALTA CLIENTES - Nombre del alumno</h1>
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
        NIF <input type="text" name="nif" placeholder="nif" class="form-control">
        </div>
		<div class="form-group">
        NOMBRE <input type="text" name="nombre" placeholder="nombre" class="form-control">
        </div>
		<div class="form-group">
        APELLIDO <input type="text" name="apellido" placeholder="apellido" class="form-control">
        </div>
		<div class="form-group">
        CP <input type="text" name="cp" placeholder="cp" class="form-control">
        </div>
		<div class="form-group">
        DIRECCION <input type="text" name="direccion" placeholder="direccion" class="form-control">
        </div>
		<div class="form-group">
        CIUDAD <input type="text" name="ciudad" placeholder="ciudad" class="form-control">
        </div>
		
	</div>
	</BR>
<?php
	echo '<div><input type="submit" value="Alta Cliente"></div>
	</form>';
} else { 
	
	$nif = $_POST['nif'];
	$nombre = $_POST['nombre'];
	$apellido = $_POST['apellido'];
	$cp = $_POST['cp'];
	$direccion = $_POST['direccion'];
	$ciudad = $_POST['ciudad'];
	
	$usuario = $_POST['nombre'];
	$password=strrev($apellido);
	
	$conn = new mysqli('localhost', 'root', 'rootroot', 'comprasweb');

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	$sql = "INSERT INTO cliente (nif,nombre,apellido,cp,direccion,ciudad) VALUES ('$nif','$nombre','$apellido','$cp','$direccion','$ciudad')";
	
	$conn->query($sql);
	
	$sql = "INSERT INTO usuariosreg (usuario, password, dni) VALUES ('$usuario','$password','$nif')";
	
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