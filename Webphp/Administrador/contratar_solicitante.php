<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "techome";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rut = $_POST['rut'];
    $sqlSolicitante = "SELECT * FROM solicitantes WHERE Rut_solicitante = '$rut'";
    $resultSolicitante = $conn->query($sqlSolicitante);
    if ($resultSolicitante) {
        if ($resultSolicitante->num_rows > 0) {
            $solicitante = $resultSolicitante->fetch_assoc();
            echo json_encode(['solicitante' => $solicitante]);
            $sqlInsert = "INSERT INTO trabajador (Rut_trabajador, Nombre_Trabajador, Correo_Trabajador, Profesion)
                          VALUES (111111,holamuywenastardes,elshivo@gmail.com,'Programador')";
            if ($conn->query($sqlInsert) === TRUE) {
                $sqlDelete = "DELETE FROM solicitantes WHERE Rut_solicitante = '$rut'";
                if ($conn->query($sqlDelete) === TRUE) {
                    echo json_encode(['success' => true, 'message' => 'Solicitante contratado con éxito']);}
                    else {
                    echo json_encode(['success' => false, 'message' => 'Error al eliminar solicitante de la tabla de solicitantes', 'error' => $conn->error]);}}
                    else {
                echo json_encode(['success' => false, 'message' => 'Error al insertar solicitante en la tabla de trabajadores', 'error' => $conn->error]);}}
                else {
            echo json_encode(['success' => false, 'message' => 'Solicitante no encontrado']);}}
else {
        echo json_encode(['success' => false, 'message' => 'Error al obtener datos del solicitante', 'error' => $conn->error]);}}
else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);}
$conn->close();
?>