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
        die("Conexion fallida: " . $conexion->connect_error);
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['consultar_estado']) && isset($_SESSION['Correo_Cliente'])) {
        $Correo_Cliente = $_SESSION['Correo_Cliente'];
        $ID_pedido = validarInput($_POST['ID_pedido']);

        // Validar que el ID del pedido exista y sea seguro

        // Obtener el estado del pedido desde la base de datos
        $estadoPedido = obtenerEstadoPedidoDesdeBD($ID_pedido);

        if ($estadoPedido === "Finalizado") {
            echo "<p>Estado del Pedido para el Cliente con correo $Correo_Cliente y Pedido ID $ID_pedido: $estadoPedido</p>";

            echo '
            <form action="' . $_SERVER['PHP_SELF'] . '" method="post">
                <div class="form-group">
                    <label for="Calificacion">Calificacion (1-5):</label>
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

    if (isset($_POST['calificar_pedido']) && isset($_SESSION['Correo_Cliente'])) {
        $ID_pedido = validarInput($_POST['ID_pedido']);
        $calificacion = validarInput($_POST['Calificacion']);

        // Aquí deberías implementar la lógica para guardar la calificación en la base de datos.
        // ...

        // Luego, puedes mostrar un mensaje de éxito.
        echo "<p>¡Gracias por calificar el pedido con $calificacion estrellas!</p>";
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
body {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    background-color: #27496D;
    color: #F1EFEF;
    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
    min-height: 99h;
    margin: 0;
}

a {
    color: #fff;
    text-decoration: none;
}

header {
    background-color: #142850;
    border: 2px solid #2C74B3;
    text-align: center;
    margin-top: 1%;
    margin-bottom: 1%;
    margin-left: 1%;
    margin-right: 6%;
    padding: 1%;
    border-radius: 9px;
}

footer {
    background-color: #142850;
    border: 2px solid #2C74B3;
    text-align: center;
    margin: 1%;
    padding: 2%;
    border-radius: 9px;
    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
}

#menu {
    position: fixed;
    top: 0;
    right: -303px;
    width: 300px;
    height: 99%;
    background-color: #142850;
    border: 2px solid #2C74B3;
    border-radius: 9px;
    color: #fff;
    transition: right 0.3s;
}

#menu.active {
    right: 0;
}

#menu ul {
    list-style: none;
    padding: 0;
}

#menu ul li {
    padding: 15px;
    text-align: left;
    margin-left: 5%;
    cursor: pointer;
    border-bottom: 1px solid #142850;
}

#content {
    text-align: center;
    padding: 2%;
    margin-top: 9px;
}

#menu-toggle {
    position: fixed;
    top: 20px;
    right: 20px;
    cursor: pointer;
    color: #fff;
    padding: 1%;
    margin-top: 1%;
    margin-right: 1%;
    background-color: #142850;
    border: 2px solid #2C74B3;
    border-radius: 10px;
}
    </style>
</head>
<body>
    <h1>Consultar Estado y Calificar Pedido</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="form-group">
            <label for="ID_pedido">ID del Pedido:</label>
            <input type="text" name="ID_pedido" required>
        </div>
        <input type="submit" name="consultar_estado" class="btn-submit" value="Consultar Estado del Pedido">
    </form>
</body>
</html>