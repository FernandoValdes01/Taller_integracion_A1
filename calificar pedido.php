<?php
session_start();

// Función para validar y limpiar datos de entrada
function validarInput($input) {
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Correo_Cliente'])) {
    $correoCliente = validarInput($_POST['Correo_Cliente']);
    $pedidoID = validarInput($_POST['Pedido_ID']);

    // Validar que el correo y el ID del pedido existan y sean seguros

    // Simulación de estado Finalizado
    $estadoPedido = "Finalizado";

    echo "<p>Estado del Pedido para el Cliente con correo $correoCliente y Pedido ID $pedidoID: $estadoPedido</p>";

    if ($estadoPedido === "Finalizado") {
        echo '
        <form action="' . $_SERVER['PHP_SELF'] . '" method="post">
            <div class="form-group">
                <label for="Calificacion">Calificación (1-5):</label>
                <input type="number" name="Calificacion" min="1" max="5" required>
            </div>
            <input type="hidden" name="Pedido_ID" value="' . $pedidoID . '">
            <input type="submit" name="calificar_pedido" class="btn-submit" value="Calificar Pedido">
        </form>
        ';
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['calificar_pedido'])) {
    $pedidoID = validarInput($_POST['Pedido_ID']);
    $calificacion = validarInput($_POST['Calificacion']);

    // Validar que el ID del pedido y la calificación sean seguros

    $calificacionGuardada = guardarCalificacionEnBD($pedidoID, $calificacion);

    if ($calificacionGuardada) {
        echo "<p>¡Gracias por calificar el pedido con $calificacion estrellas!</p>";
    } else {
        echo "<p>Ocurrió un error al guardar la calificación. Inténtalo de nuevo.</p>";
    }
}

function guardarCalificacionEnBD($pedidoID, $calificacion) {
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
    $stmt->bind_param("ii", $calificacion, $pedidoID);
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

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <div class="form-group">
        <label for="Correo_Cliente">Correo del Cliente:</label>
        <input type="text" name="Correo_Cliente" required>
    </div>
    <div class="form-group">
        <label for="Pedido_ID">ID del Pedido:</label>
        <input type="text" name="Pedido_ID" required>
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