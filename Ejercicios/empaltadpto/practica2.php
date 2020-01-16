<?php

$servername = $_REQUEST['servername'];
$username = $_REQUEST['username'];
$password = $_REQUEST['password'];
$dbname = $_REQUEST['dbname'];
$depart = $_REQUEST['dept'];


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$valor = "SELECT MAX(cod_dpto) FROM departamento";

$v = mysqli_query($conn,$valor);

$fila = mysqli_fetch_assoc($v);

$newval = (String)$fila['MAX(cod_dpto)'];

$elval = (Int)substr($newval,1,3);

$elval = $elval+1;

$valfin = "D00".$elval;

echo $valfin;

$sql = "INSERT INTO departamento (cod_dpto, nombre_dpto) VALUES ('$valfin', '$depart')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>