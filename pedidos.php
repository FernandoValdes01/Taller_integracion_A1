<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Estado de Pedido</title>
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
    <h1>Cambiar Estado de Pedido</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="form-group">
            <label for="Pedido_ID">ID del Pedido:</label>
            <input type="text" name="Pedido_ID" required>
        </div>
        <div class="form-group">
            <label for="Nuevo_Estado">Nuevo Estado:</label>
            <select name="Nuevo_Estado">
                <option value="En Camino">En Camino</option>
                <option value="Trabajando">Trabajando</option>
                <option value="Finalizado">Finalizado</option>
            </select>
        </div>
        <input type="submit" name="cambiar_estado" class="btn-submit" value="Guardar">
    </form>

    <?php
    session_start();
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cambiar_estado'])) {
        $pedido_id = $_POST['Pedido_ID'];
        $nuevo_estado = $_POST['Nuevo_Estado'];

        $host = "localhost";
        $usuario = "root";
        $contrasena = "";
        $base_datos = "techome";
        $conexion = new mysqli($host, $usuario, $contrasena, $base_datos);

        if ($conexion->connect_error) {
            die("Error de conexión a la base de datos: " . $conexion->connect_error);
        }

        // Obtener el estado actual del pedido
        $sql = "SELECT `Estado_pedido` FROM `pedido aceptado` WHERE `ID_pedido` = $pedido_id";
        $resultado = $conexion->query($sql);

        if ($resultado->num_rows == 1) {
            $fila = $resultado->fetch_assoc();
            $estado_actual = $fila['Estado_pedido'];

            // Verificar la secuencia de cambio de estado
            if (
                ($estado_actual == "" && $nuevo_estado == "En Camino") ||
                ($estado_actual == "En Camino" && $nuevo_estado == "Trabajando") ||
                ($estado_actual == "Trabajando" && $nuevo_estado == "Finalizado")
            ) {
                // Cambiar el estado del pedido usando una consulta preparada
                $sql = "UPDATE `pedido aceptado` SET `Estado_pedido` = ? WHERE `ID_pedido` = ?";
                $stmt = $conexion->prepare($sql);
                $stmt->bind_param("si", $nuevo_estado, $pedido_id);

                if ($stmt->execute()) {
                    echo "Estado del pedido actualizado correctamente.";
                } else {
                    echo "Error al cambiar el estado del pedido: " . $stmt->error;
                }

                $stmt->close();
            } else {
                echo "No se permite cambiar el estado de \"$estado_actual\" a \"$nuevo_estado\".";
            }
        } else {
            echo "Pedido no encontrado.";
        }

        $conexion->close();
    }
    ?>
</body>
</html>