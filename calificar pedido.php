<?php
session_start();

function validarInput($input) {
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}

// Función para obtener el estado del pedido desde la base de datos
function obtenerEstadoPedidoDesdeBD($ID_pedido) {
    $host = "localhost";
    $usuario = "root";
    $contrasena = "";
    $base_datos = "techome";
    $conexion = new mysqli($host, $usuario, $contrasena, $base_datos);

    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
        return false;
    }

    $sql = "SELECT Estado_pedido FROM `pedido aceptado` WHERE ID_pedido = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $ID_pedido);
    $stmt->execute();
    $stmt->bind_result($estado);
    $stmt->fetch();
    $stmt->close();
    $conexion->close();

    return $estado;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Correo_Cliente'])) {
    $Correo_Cliente  = validarInput($_POST['Correo_Cliente']);
    $ID_pedido = validarInput($_POST['ID_pedido']);

    // Validar que el correo y el ID del pedido existan y sean seguros

    // Obtener el estado del pedido desde la base de datos
    $estadoPedido = obtenerEstadoPedidoDesdeBD($ID_pedido);

    if ($estadoPedido === "Finalizado") {
        echo "<p>Estado del Pedido para el Cliente con correo $Correo_Cliente  y Pedido ID $ID_pedido: $estadoPedido</p>";

        echo '
        <form action="' . $_SERVER['PHP_SELF'] . '" method="post">
            <div class="form-group">
                <label for="Calificacion">Calificación (1-5):</label>
                <input type="number" name="Calificacion" min="1" max="5" required>
            </div>
            <input type="hidden" name="ID_pedido" value="' . $ID_pedido . '">
            <input type="submit" name="calificar_pedido" class="btn-submit" value="Calificar Pedido">
        </form>
        ';
    } else {
        echo "<p>No puedes calificar el pedido porque no está en estado 'Finalizado'.</p>";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['calificar_pedido'])) {
    $ID_pedido = validarInput($_POST['ID_pedido']);
    $calificacion = validarInput($_POST['Calificacion']);

    // Validar que el ID del pedido y la calificación sean seguros

    $calificacionGuardada = guardarCalificacionEnBD($ID_pedido, $calificacion);

    if ($calificacionGuardada) {
        echo "<p>¡Gracias por calificar el pedido con $calificacion estrellas!</p>";
    } else {
        echo "<p>Ocurrió un error al guardar la calificación. Inténtalo de nuevo.</p>";
    }
}

function guardarCalificacionEnBD($ID_pedido, $calificacion) {
    // Conexión a la base de datos (debes configurar tu conexión)
    $host = "localhost";
    $usuario = "root";
    $contrasena = "";
    $base_datos = "techome";
    $conexion = new mysqli($host, $usuario, $contrasena, $base_datos);

    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
        return false;
    }

    // Prepara la consulta SQL con parámetros seguros para evitar SQL injection
    $sql = "UPDATE `pedido aceptado` SET calificacion = ? WHERE ID_pedido = ?";
    $stmt = $conexion->prepare($sql);

    // Vincula los parámetros y ejecuta la consulta
    $stmt->bind_param("ii", $calificacion, $ID_pedido);
    $calificacionGuardada = $stmt->execute();

    // Verifica si se realizó con éxito
    if ($calificacionGuardada) {
        $conexion->close();
        return true;
    } else {
        $conexion->close();
        return false;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estado y Calificación del Pedido</title>
    <style>
        /* Agrega tus estilos CSS aquí */
        .form-group {
            margin: 10px 0;
        }
        .btn-submit {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Consultar Estado y Calificar Pedido</h1>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="form-group">
            <label for="Correo_Cliente">Correo del Cliente:</label>
            <input type="text" name="Correo_Cliente" required>
        </div>
        <div class="form-group">
            <label for="ID_pedido">ID del Pedido:</label>
            <input type="text" name="ID_pedido" required>
        </div>
        <div class="form-group">
            <label for="Contraseña">Contraseña:</label>
            <input type="password" name="Contraseña" required>
        </div>
        <div class="form-group">
            <label for="Nombre_cliente">Nombre Cliente:</label>
            <input type="text" name="Nombre_cliente" required>
        </div>

        <input type="submit" name="consultar_estado" class="btn-submit" value="Consultar Estado del Pedido">
    </form>
</body>
</html>
