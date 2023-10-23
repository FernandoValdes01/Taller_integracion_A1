<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estado y Calificacion del Pedido</title>
    <style>
body {
    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
    background-color: #27496D;
    color: #F1EFEF;
    display: flex;
    flex-direction: column;
    align-items: center; /* Centra verticalmente */
}

header {
    background-color: #142850;
    border: 2px solid #2C74B3;
    color: #F1EFEF;
    margin-top: 1%;
    margin-bottom: 1%;
    margin-left: 1%;
    margin-right: 5%;
    padding: 2%;
    border-radius: 9px;
}

section {
    background-color: #142850;
    border: 2px solid #2C74B3;
    padding: 3%;
    margin-left: 30%;
    margin-right: 30%;
    margin-bottom: 2%;
    border-radius: 9px;
}

footer {
    background-color: #142850;
    border: 2px solid #2C74B3;
    color: #F1EFEF;
    text-align: center;
    margin: 1%;
    padding: 2%;
    border-radius: 9px;
    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
}

h1 {
    font-family: verdana;
    font-size: 30px;
    text-align: center;
}

p {
    margin-left: 15%;
    margin-top: 39px;
    font-family: Arial;
    font-size: 20px;
}

a {
    text-decoration: none;
    color: #F1EFEF;
}

input {
    border-radius: 3px;
    border: 5px solid #2C74B3;
}

textarea {
    border-radius: 3px;
    border: 5px solid #2C74B3;
}

button {
    background-color: #27496D;
    border: 2px solid #2C74B3;
    color: #F1EFEF;
    padding: 1%;
    border-radius: 9px;
}

button:hover {
    background-color: #2C74B3;
    color: #fff;
}

.q_text {
    margin-top: 3%;
    margin-bottom: 3%;
    text-align: center;
}

.Correo {
    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
    font-size: 20px;
    margin-top: 60px;
    margin-left: 15%;
}

.Contraseña {
    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
    font-size: 20px;
    margin-top: 20px;
    margin-left: 15%;
}

.Contraseña label {
    display: block;
    margin-bottom: 9px;
    margin-top: 0%;
}

.Correo label {
    display: block;
    margin-bottom: 9px;
    margin-top: 0%;
}

.Botón_de_enviar {
    margin-left: 15%;
}

#menu {
    position: fixed;
    top: 0;
    right: -253px;
    width: 240px;
    height: 99%;
    background-color: #142850;
    border: 2px solid #2C74B3;
    border-radius: 9px;
    margin-top: 0.5%;
    margin-bottom: 0.5%;
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
    text-align: center;
    cursor: pointer;
}

#content {
    margin-right: 250px;
    padding: 20px;
}

#menu-toggle {
    position: fixed;
    top: 20px;
    right: 20px;
    cursor: pointer;
    color: #fff;
    padding: 1%;
    background-color: #142850;
    border: 2px solid #2C74B3;
    border-radius: 9px;
}
    </style>
</head>
<body>
    <div>
    <h1>Consultar Estado y Calificar Pedido</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="form-group">
            <label for="ID_pedido">ID del Pedido:</label>
            <input type="text" name="ID_pedido" required>
        </div>
        <input type="submit" name="consultar_estado" class="btn-submit" value="Consultar Estado del Pedido">
    </form>

    <?php
    if (isset($_POST['consultar_estado']) && isset($_SESSION['Correo_Cliente'])) {
    }

    if (isset($_POST['calificar_pedido']) && isset($_SESSION['Correo_Cliente'])) {
    }
    ?>
    </div>
</body>
</html>

<?php
session_start();

function validarInput($input) {
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}

// Funcion para verificar si un pedido ya ha sido calificado anteriormente
function obtenerPedidoCalificado($correoCliente, $idPedido) {
    // Realiza una consulta a la base de datos para verificar si el pedido ya ha sido calificado por el cliente
    $host = "localhost";
    $usuario = "root";
    $contrasena = "";
    $base_datos = "techome";
    $conexion = new mysqli($host, $usuario, $contrasena, $base_datos);

    if ($conexion->connect_error) {
        die("Conexion fallida: " . $conexion->connect_error);
    }

    $sql = "SELECT COUNT(*) FROM `pedido aceptado` WHERE ID_pedido = ? AND Calificacion IS NOT NULL";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $idPedido);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    $conexion->close();

    return $count > 0;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['consultar_estado']) && isset($_SESSION['Correo_Cliente'])) {
        $Correo_Cliente = $_SESSION['Correo_Cliente'];
        $ID_pedido = validarInput($_POST['ID_pedido']);

        $host = "localhost";
        $usuario = "root";
        $contrasena = "";
        $base_datos = "techome";
        $conexion = new mysqli($host, $usuario, $contrasena, $base_datos);

        if ($conexion->connect_error) {
            die("Conexión fallida: " . $conexion->connect_error);
        }

        $sql = "SELECT Estado_pedido FROM `pedido aceptado` WHERE ID_pedido = ? AND ID_solicitud IN (SELECT ID_solicitud FROM `solicitud de trabajo` WHERE Correo_Cliente = ?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("is", $ID_pedido, $Correo_Cliente);
        $stmt->execute();
        $stmt->bind_result($estado);
        $stmt->fetch();
        $stmt->close();

        if ($estado === "Finalizado") {
            // Verifica si el pedido ya ha sido calificado anteriormente
            $pedido_calificado = obtenerPedidoCalificado($Correo_Cliente, $ID_pedido);

            if (!$pedido_calificado) {
                echo "<p>Estado del Pedido para el Cliente con correo $Correo_Cliente y Pedido ID $ID_pedido: $estado</p>";

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
                echo "<p>Gracias por tu calificacion.</p>";
            }
        } else {
            echo "<p>No puedes calificar el pedido porque no esta en estado 'Finalizado'.</p>";
        }

        $conexion->close();
    }

    if (isset($_POST['calificar_pedido']) && isset($_SESSION['Correo_Cliente'])) {
        $ID_pedido = validarInput($_POST['ID_pedido']);
        $calificacion = validarInput($_POST['Calificacion']);

        $host = "localhost";
        $usuario = "root";
        $contrasena = "";
        $base_datos = "techome";
        $conexion = new mysqli($host, $usuario, $contrasena, $base_datos);

        if ($conexion->connect_error) {
            die("Conexión fallida: " . $conexion->connect_error);
        }
        $pedido_calificado = obtenerPedidoCalificado($_SESSION['Correo_Cliente'], $ID_pedido);

        if (!$pedido_calificado) {
            $sql = "UPDATE `pedido aceptado` SET Calificacion = ? WHERE ID_pedido = ?";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("ii", $calificacion, $ID_pedido);

            if ($stmt->execute()) {
                echo "<p>¡Gracias por calificar el pedido con $calificacion estrellas!</p>";
            } else {
                echo "<p>Error al actualizar la calificacion del pedido.</p>";
            }
        } else {
            echo "<p>Gracias por tu calificacion.</p>";
        }

        $conexion->close();
    }
}?>