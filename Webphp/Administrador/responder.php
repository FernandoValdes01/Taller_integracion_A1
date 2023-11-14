<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "techome";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$idAsistenciaT = $_GET['id'];
$respuesta = $_GET['respuesta'];

$sql = "UPDATE asistenciat SET respuesta = '$respuesta' WHERE ID_AsistenciaT = '$idAsistenciaT'";

if ($conn->query($sql) === TRUE) {
    echo "Respuesta agregada con éxito.";
} else {
    echo "Error al agregar la respuesta: " . $conn->error;
}

$conn->close();
?>
