<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "techome";
$region = $_POST['region'];
$ciudad = $_POST['ciudad'];
$direccion = $_POST['direccion'];
$indicaciones = $_POST['indicaciones'];
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}
$sql = "INSERT INTO direccion (region, ciudad, direccion, indicaciones) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $region, $ciudad, $direccion, $indicaciones);
if ($stmt->execute()) {
    header("Location: ExitoDireccion.html");
    exit();
} else {
    header("Location: ErrorDirecciones.html");
    exit();
}
$conn->close();
?>