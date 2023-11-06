<?php
session_start();

if (isset($_SESSION['Correo_Trabajador'])) {
    $correo = $_SESSION['Correo_Trabajador'];
    $Correo_Cliente = $_SESSION['Correo_Trabajador'];
    $nombre = $_SESSION['Nombre_Trabajador'];
    $contraseñaC = $_SESSION['contraseña'];
} else {
    header("Location: iniciosesionT.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "techome";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error en la conexión a la base de datos: " . $conn->connect_error);
}

if (isset($_POST['accion']) && isset($_POST['solicitud_id'])) {
    $accion = $_POST['accion'];
    $solicitud_id = $_POST['solicitud_id'];

    if ($accion === 'aceptar') {
        header("Location: pedidosdef.php?ID_solicitud=" . $solicitud_id);
        exit();
    } elseif ($accion === 'rechazar') {
        $sql_delete_pedido = "DELETE FROM pedido_aceptado WHERE ID_solicitud = ?";
        $stmt_pedido = $conn->prepare($sql_delete_pedido);
        $stmt_pedido->bind_param("i", $solicitud_id);

        if ($stmt_pedido->execute()) {
            $sql_delete_solicitud = "DELETE FROM solicitudservicio WHERE ID_solicitud = ?";
            $stmt_solicitud = $conn->prepare($sql_delete_solicitud);
            $stmt_solicitud->bind_param("i", $solicitud_id);

            if ($stmt_solicitud->execute()) {
                $conn->commit();
                header("Location: ExitoEliminarSolicitud.html");
                exit();
            } else {
                $conn->rollback();
                header("Location: ErrorEliminarSolicitud.html");
            }

            $stmt_solicitud->close();
        } else {
            $conn->rollback();
            header("Location: ErrorEliminarSolicitud.html");
        }

        $stmt_pedido->close();
    }

    $conn->close();
}
?>
