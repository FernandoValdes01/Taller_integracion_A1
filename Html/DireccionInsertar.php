<?php
// Verifica si se recibieron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexión a la base de datos (ajusta los valores según tu configuración)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "techome";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("La conexión a la base de datos falló: " . $conn->connect_error);
    }

    // Obtener los datos del formulario
    $region = $_POST["region"];
    $ciudad = $_POST["ciudad"];
    $direccion = $_POST["direccion"];
    $indicaciones = $_POST["indicaciones"];

    // Preparar y ejecutar la consulta SQL para insertar los datos en la base de datos
    $sql = "INSERT INTO direccion (direccion, indicaciones, ciudad, region) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $direccion, $indicaciones, $ciudad,$region);

    if ($stmt->execute()) {
        // La inserción fue exitosa
        echo "Los datos se han insertado correctamente en la base de datos.";
    } else {
        // Ocurrió un error durante la inserción
        echo "Error al insertar los datos en la base de datos: " . $stmt->error;
    }

    // Cerrar la conexión a la base de datos
    $stmt->close();
    $conn->close();
} else {
    // Si se intenta acceder a este archivo sin enviar datos por POST, mostrar un mensaje de error
    echo "Acceso no permitido.";
}
?>
