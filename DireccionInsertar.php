<?php
// Datos de conexión a la base de datos
$servername = "localhost"; // Nombre del servidor de la base de datos
$username = "root"; // Nombre de usuario de la base de datos
$password = ""; // Contraseña de la base de datos
$dbname = "techome"; // Nombre de la base de datos

// Crear una conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("La conexión a la base de datos falló: " . $conn->connect_error);
}

// Recopilar los datos del formulario después de realizar la validación y limpieza
$ID_Direccion = isset($_POST["ID_Direccion"]) ? $conn->real_escape_string($_POST["ID_Direccion"]) : "";
$Region = isset($_POST["Region"]) ? $conn->real_escape_string($_POST["Region"]) : "";
$Ciudad = isset($_POST["Ciudad"]) ? $conn->real_escape_string($_POST["Ciudad"]) : "";
$Direccion = isset($_POST["Direccion"]) ? $conn->real_escape_string($_POST["Direccion"]) : "";
$Indicaciones = isset($_POST["Indicaciones"]) ? $conn->real_escape_string($_POST["Indicaciones"]) : "";

$sql = "INSERT INTO direccion (Direccion, Indicaciones, Ciudad, Region) 
        VALUES ('$Direccion', '$Indicaciones', '$Ciudad', '$Region')";

if ($conn->query($sql) === TRUE) {
    echo "Los datos se han insertado correctamente.";
} else {
    echo "Error al insertar los datos: " . $conn->error;
}

// Cerrar la conexión a la base de datos
$conn->close();
?>

