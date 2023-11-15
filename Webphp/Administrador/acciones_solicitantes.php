<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "techome";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);}
if (isset($_POST['action']) && isset($_POST['rut_solicitante'])) {
    $action = $_POST['action'];
    $rutSolicitante = $_POST['rut_solicitante'];

    if ($action === 'rechazar') {
        $sql = "DELETE FROM solicitantes WHERE Rut_solicitante = '$rutSolicitante'";
        if ($conn->query($sql) === TRUE) {
            echo "Solicitante rechazado correctamente";
        } else {
            echo "Error al rechazar al solicitante: " . $conn->error;}
    } elseif ($action === 'contratar') {
        $sqlInsert = "INSERT INTO trabajador (Rut_trabajador, Nombre_Trabajador, Correo_Trabajador, Profesion, Monto_Cuenta, contraseña, Calificacion, Descripcion, totalpedidos) SELECT Rut_solicitante, nombre_solicitante, correo_solicitante, profesion, 0, '', 0, '', 0 FROM solicitantes WHERE Rut_solicitante = '$rutSolicitante'";
        if ($conn->query($sqlInsert) === TRUE) {
            $sqlDelete = "DELETE FROM solicitantes WHERE Rut_solicitante = '$rutSolicitante'";
            if ($conn->query($sqlDelete) === TRUE) {
                echo "Solicitante contratado correctamente";
            } else {
                echo "Error al eliminar al solicitante después de contratar: " . $conn->error;
            }
        } else {
            echo "Error al contratar al solicitante: " . $conn->error;
        }
    } else {
        echo "Acción no válida";
    }
} else {
    echo "Parámetros de acción no proporcionados";
}
$conn->close();
?>