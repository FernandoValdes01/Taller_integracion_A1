<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "techome";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta SQL para obtener todos los solicitantes
$sql = "SELECT * FROM solicitantes";
$result = $conn->query($sql);

$solicitantes = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $solicitante = array(
            "Rut_solicitante" => $row["Rut_solicitante"],
            "Nombre_Solicitante" => $row["nombre_solicitante"],
            "Correo_Solicitante" => $row["correo_solicitante"],
            "Profesion" => $row["profesion"]
        );
        array_push($solicitantes, $solicitante);
    }
}

$conn->close();

// Devolver los datos en formato JSON
header('Content-Type: application/json');
echo json_encode($solicitantes);
?>
