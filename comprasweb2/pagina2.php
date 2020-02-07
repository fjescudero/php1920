<?php
session_start();
?>
<html>
<head>
<title>Pagina 2</title>
</head>
<body>

<?php

include "conexion.php";

if(isset($_SESSION['nombre'])){
echo "Has iniciado Sesion: ".$_SESSION['nombre'];

?>

<br/><br/>

<form name='mi_formulario' action='compro.php' method='GET'>

<input type="submit" value="Comprar Productos">

</FORM>

<form name='mi_formulario' action='comconsalm.php' method='GET'>

<input type="submit" value="Consultar Compras">

</FORM>

<?php

}else{

$usu = comprobarUsuario($db,$_POST['nombre']);
$pass = comprobarPassword($db,$_POST['nombre']);

if(isset($_POST['nombre'])==$usu and isset($_POST['password'])==$pass){
$_SESSION['nombre'] = $_POST['nombre'];
echo "Has iniciado sesion como: ".$_POST['nombre'];

?>

<br/><br/>

<form name='mi_formulario' action='compro.php' method='GET'>

<input type="submit" value="Comprar Productos">

</FORM>

<form name='mi_formulario' action='comconsalm.php' method='GET'>

<input type="submit" value="Consultar Compras">

</FORM>

<?php

}else{

echo "Acceso Restringido debes hacer Login con tu usuario";
}
}

?>

<?php

function comprobarUsuario($db,$usu) {
	$usuarios = array();
	
	$sql = "SELECT usuario,password FROM usuariosreg where usuario='$usu'";
	
	$resultado = mysqli_query($db, $sql);
	if ($resultado) {
		while ($row = mysqli_fetch_assoc($resultado)) {
			$usuarios[] = $row['usuario'];
		}
	}
	return $usuarios;
}

function comprobarPassword($db,$usu) {
	$passwords = array();
	
	$sql = "SELECT password FROM usuariosreg where usuario='$usu'";
	
	$resultado = mysqli_query($db, $sql);
	if ($resultado) {
		while ($row = mysqli_fetch_assoc($resultado)) {
			$passwords[] = $row['password'];
		}
	}
	return $passwords;
}


?>

<br/><br/>

<a href="loginusu.php">Volver al Login</a>

</body>
</html>