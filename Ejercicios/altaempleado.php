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
	
	echo '<form action="" method="post">';
?>
	<div>
	
	DNI:
	
	<input type='text' name='dni'><br><br>
	
	Nombre:
	
	<input type='text' name='nombre'><br><br>
	
	Apellidos:
	
	<input type='text' name='apellido'><br><br>
	
	Fecha Nacimiento:
	
	<input type='date' name='fechanac'><br><br>
	
	Salario:
	
	<input type='text' name='salario'><br><br>
	
	Fecha Incorporacion:
	
	<input type='date' name='fechainc'><br><br>
	
	Fecha Salida:
	
	<input type='date' name='fechasal'><br><br>
	
	<label for="departamento">Departamentos:</label>
	<select name="departamento">
		<?php foreach($departamentos as $departamento) : ?>
			<option> <?php echo $departamento ?> </option>
		<?php endforeach; ?>
	</select>
	</div>
	</BR>
	
<?php

	echo '<div><input type="submit" value="Alta"></div>
	
	</form>';
	
} else { 
	
	$DNI = $_POST['dni'];
	$nombre = $_POST['nombre'];
	$apellido = $_POST['apellido'];
	$fechnac = $_POST['fechanac'];
	$sal = $_POST['salario'];
	$fechinc = $_POST['fechainc'];
	$fechsal = $_POST['fechasal'];
	$departamento = $_POST['departamento'];
	
	$codigo = obtenerCodigo($db,$departamento);
	
	$conn = new mysqli('localhost', 'root', 'rootroot', 'empleadosnn');

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	$sql = "INSERT INTO empleado (dni,nombre,apellidos,fecha_nac,salario) VALUES ('$DNI','$nombre','$apellido','$fechnac','$sal')";
	$conn->query($sql);
	$sql = "INSERT INTO emple_depart (dni,cod_dpto,fecha_ini,fecha_fin) VALUES ('$DNI','$codigo','$fechinc','$fechsal')";

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






