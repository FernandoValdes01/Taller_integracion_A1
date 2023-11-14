<?php
session_start();

if (isset($_SESSION['Correo_Trabajador'])) {
    $correo = $_SESSION['Correo_Trabajador'];
    $Correo_Trabajador = $_SESSION['Correo_Trabajador'];
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
        $query_last_id = "SELECT MAX(ID_pedido) AS last_id FROM pedido_aceptado";
        $resultado_last_id = mysqli_query($conn, $query_last_id);


        $fila_last_id = mysqli_fetch_assoc($resultado_last_id);
        $pedido_id = $fila_last_id['last_id'] + 1;

        $query_solicitud = "SELECT * FROM solicitudservicio WHERE ID_solicitud = $solicitud_id";
        $resultado_solicitud = mysqli_query($conn, $query_solicitud);

        if ($fila_solicitud = mysqli_fetch_assoc($resultado_solicitud)) {
            $tipo_servicio = $fila_solicitud['tipo_servicio'];
            $descripcion = $fila_solicitud['descripcion'];
            $ID_cliente = $fila_solicitud['ID_cliente'];
            $precio = $fila_solicitud['precio'];
            $Rut_Trabajador = $fila_solicitud['Rut_Trabajador'];
            $Grado = $fila_solicitud['Grado'];

            $insert_query = "INSERT INTO pedido_aceptado (ID_pedido, nombre_pedido, precio, fecha, ID_solicitud, Rut_Trabajador, estado, calificacion) 
                             VALUES ($pedido_id, '$descripcion', $precio, NOW(), $solicitud_id, '$Rut_Trabajador', 'En camino', 0)";
            mysqli_query($conn, $insert_query);

           
            echo '<script>alert("Datos insertados en la tabla pedido_aceptado:\nID_pedido: ' . $pedido_id . '\nnombre_pedido: ' . $descripcion . '\nprecio: ' . $precio . '\nID_solicitud: ' . $solicitud_id . '\nRut_Trabajador: ' . $Rut_Trabajador . '\nestado: En camino\ncalificacion: 0");</script>';
            header("Location: pedidosdef.php?ID_Pedido=" . $pedido_id);
            exit();
        } else {
            echo "No se encontró la solicitud con ID $solicitud_id";
        }
        mysqli_close($conn);
    } else {
        echo "Acción no válida";
    }
}
     elseif ($accion === 'rechazar') {
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
?>
