<?php

define('DB_SERVER', '10.131.14.76');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'rootroot');
define('DB_DATABASE', 'empleadosNN');
$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
   
   if (!$db) {
		die("Error conexión: " . mysqli_connect_error());
	}

if (!isset($_POST) || empty($_POST)) { 

	$departamentos = obtenerDepartamentos($db);
	
	echo '<form action="" method="post">';
?>
	<div>
	<label for="departamento">Departamentos:</label>
	<select name="departamento">
		<?php foreach($departamentos as $departamento) : ?>
			<option> <?php echo $departamento ?> </option>
		<?php endforeach; ?>
	</select>
	</div>
	</BR>
<?php
	echo '<div><input type="submit" value="Mostrar Empleados"></div>
	</form>';
} else { 

	$departamento = $_POST['departamento'];
	obtenerEmpleados($db, $departamento);
	
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

function obtenerEmpleados($db, $nombredpto) {
	$idDepartamento = null;
	
	$sql = "SELECT cod_dpto FROM departamento WHERE nombre_dpto = '$nombredpto'";
	$resultado = mysqli_query($db, $sql);
	if ($resultado) {
		while ($row = mysqli_fetch_assoc($resultado)) {
			$idDepartamento = $row['cod_dpto'];
		}
	}
	
	$sql1 = "SELECT nombre, apellidos FROM empleado,emple_depart WHERE empleado.dni=emple_depart.dni and emple_depart.cod_dpto = '$idDepartamento' and fecha_fin='0000-00-00'";
	$resultado1 = mysqli_query($db, $sql1);
		
	if (mysqli_num_rows($resultado1) > 0) {
    
    while($row = mysqli_fetch_assoc($resultado1)) {
        echo "Nombre: " . $row["nombre"] . $row["apellidos"]. "<br>";
    }
} else {
    echo "No hay empleados en el departamento";
}
	
}

?>
