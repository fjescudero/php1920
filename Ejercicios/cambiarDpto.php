<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'rootroot');
define('DB_DATABASE', 'empleadosnn');
$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
   
   if (!$db) {
		die("Error conexión: " . mysqli_connect_error());
	}

if (!isset($_POST) || empty($_POST)) { 

	$departamentos = obtenerDepartamentos($db);
	$dnis = obtenerDni($db);
	
	echo '<form action="" method="post">';
?>
	<div>
	
	<label for="dni">DNI empleados:</label>
	<select name="dni">
		<?php foreach($dnis as $dni) : ?>
			<option> <?php echo $dni ?> </option>
		<?php endforeach; ?>
	</select>
	</br>
	<label for="departamento">Nuevo Departamento:</label>
	<select name="departamento">
		<?php foreach($departamentos as $departamento) : ?>
			<option> <?php echo $departamento ?> </option>
		<?php endforeach; ?>
	</select>
	</div>
	</BR>
	
<?php

	echo '<div><input type="submit" value="Cambiar"></div>
	
	</form>';
	
} else { 
	
	$DNI = $_POST['dni'];
	$departamento = $_POST['departamento'];
	
	$codigo = obtenerCodigo($db,$departamento);
	
	$conn = new mysqli('localhost', 'root', 'rootroot', 'empleadosnn');

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	$sql = "UPDATE emple_depart SET cod_dpto='$codigo' where dni='$DNI'";

	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
	
}
?>

<?php

function obtenerDepartamentos($db) {
	$departamentos = array();
	
	$sql = "SELECT cod_dpto,nombre_dpto FROM departamento";
	
	$resultado = mysqli_query($db, $sql);
	if ($resultado) {
		while ($row = mysqli_fetch_assoc($resultado)) {
			$departamentos[] = $row['nombre_dpto'];
		}
	}
	return $departamentos;
}

function obtenerDni($db) {
	$dnis = array();
	
	$sql = "SELECT dni,nombre FROM empleado";
	
	$resultado = mysqli_query($db, $sql);
	if ($resultado) {
		while ($row = mysqli_fetch_assoc($resultado)) {
			$dnis[] = $row['dni'];
		}
	}
	return $dnis;
}

function obtenerCodigo($db,$departamento) {

	$idDepartamento = null;
	
	$sql = "SELECT cod_dpto FROM departamento WHERE nombre_dpto = '$departamento'";
	$resultado = mysqli_query($db, $sql);
	if ($resultado) {
		while ($row = mysqli_fetch_assoc($resultado)) {
			$idDepartamento = $row['cod_dpto'];
		}
	}
	
	return $idDepartamento;

}

?>