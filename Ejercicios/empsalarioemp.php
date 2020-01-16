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

	$dnis = obtenerDni($db);
	
	echo '<form action="" method="post">';
?>
	<div>
	
	<label for="dni">Empleados:</label>
	<select name="dni">
		<?php foreach($dnis as $dni) : ?>
			<option> <?php echo $dni ?> </option>
		<?php endforeach; ?>
	</select>
	</br>
	</BR>
	
	Salario:
	
	<input type='text' name='sala'><br><br>
	
	
<?php

	echo '<div><input type="submit" value="Cambiar"></div>
	
	</form>';
	
} else { 
	
	$empleado = $_POST['dni'];
	$sal = $_POST['sala'];
	
	$conn = new mysqli('localhost', 'root', 'rootroot', 'empleadosnn');

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	$sql = "UPDATE empleado SET salario=salario+salario*($sal/100) where nombre='$empleado'";

	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
	
}
?>

<?php

function obtenerDni($db) {
	$dnis = array();
	
	$sql = "SELECT dni,nombre FROM empleado";
	
	$resultado = mysqli_query($db, $sql);
	if ($resultado) {
		while ($row = mysqli_fetch_assoc($resultado)) {
			$dnis[] = $row['nombre'];
		}
	}
	return $dnis;
}

?>