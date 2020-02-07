<?php
session_start();
?>
<html>
<head>
<title>Pagina Login</title>
</head>
<body>

<?php

if(isset($_SESSION['nombre'])){

echo "<p>Usuario " . $_SESSION['nombre'] . "";

echo "<p><a href='pagina2.php'>Continuar Comprando</a></p>";

echo "<p><a href='pagina3.php'>Cerrar Sesion</a></p>";

}else {

?>

<form action="pagina2.php" method="POST">
<h1> Login </h1>
<p>Usuario:
<input type="text" placeholder="Introduce usuario" name="nombre" required/>
</p>
<p>Password:
<input type="text" placeholder="Introduce password" name="password" required/>
</p>

<input type="submit" value="Login"/>
</form>

<?php
}
?>

</body>
</html>