<?php
// Configuración de la conexión a la base de datos TecHome
$servername = "localhost";
$username = "root";
$password = "";
$database = "techome";

// Recuperar los datos del formulario
$region = $_POST['region'];
$ciudad = $_POST['ciudad'];
$direccion = $_POST['direccion'];
$indicaciones = $_POST['indicaciones'];

// Crear una conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

// Crear la consulta SQL para insertar los datos en la tabla de direcciones
$sql = "INSERT INTO direccion (region, ciudad, direccion, indicaciones) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
0
// Vincular los parámetros
$stmt->bind_param("ssss", $region, $ciudad, $direccion, $indicaciones);

// Ejecutar la consulta y verificar si se realizó con éxito
if ($stmt->execute()) {
    // La inserción fue exitosa
    header("Location: ExitoDireccion.html");
    exit();
} else {
    header("Location: ErrorDirecciones.html");
    exit();
}
// Cerrar la conexión a la base de datos
$conn->close();
?>
