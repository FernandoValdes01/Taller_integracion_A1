<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Estado de Pedido</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }
        h1 {
            text-align: center;
            background-color: #007BFF;
            color: #fff;
            padding: 10px;
        }
        form {
            width: 50%;
            margin: 0 auto;
            text-align: left;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }
        .form-group {
            margin: 20px 0;
        }
        .form-group label {
            display: block;
            font-weight: bold;
        }
        .form-group select, .form-group input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        .btn-submit {
            width: 100%;
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 3px;
        }
    </style>
</head>
<body>
    <h1>Cambiar Estado de Pedido</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="form-group">
            <label for="Rut_Trabajador">RUT del Trabajador:</label>
            <input type="text" name="Rut_Trabajador" required>
        </div>
        <div class="form-group">
            <label for="Nombre_Trabajador">Nombre del Trabajador:</label>
            <input type="text" name="Nombre_Trabajador" required>
        </div>
        <div class="form-group">
            <label for="Correo_Trabajador">Correo del Trabajador:</label>
            <input type="text" name="Correo_Trabajador" required>
        </div>

        <div class "form-group">
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
        $Rut_Trabajador = $_POST['Rut_Trabajador'];
        $Nombre_Trabajador = $_POST['Nombre_Trabajador'];
        $Correo_Trabajador = $_POST['Correo_Trabajador'];
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

        // Verificar que el RUT, nombre y correo del trabajador coincidan en la base de datos

        $sql_verificar = "SELECT * FROM trabajadores WHERE Rut_Trabajador = '$Rut_Trabajador' AND Nombre_Trabajador = '$Nombre_Trabajador' AND Correo_Trabajador = '$Correo_Trabajador'";

        $resultado = $conexion->query($sql_verificar);

        if ($resultado->num_rows > 0) {
            // Cambiar el estado del pedido
            $sql = "UPDATE `pedido aceptado` SET `Estado_pedido` = '$nuevo_estado' WHERE `ID_pedido` = $pedido_id AND `Rut_Trabajador` = '$Rut_Trabajador'";

            if ($conexion->query($sql) === TRUE) {
                echo "Estado del pedido actualizado correctamente.";
            } else {
                echo "Error al cambiar el estado del pedido: " . $conexion->error;
            }
        } else {
            echo "RUT, Nombre o Correo del Trabajador incorrecto. No tienes permiso para cambiar el estado del pedido.";
        }

        $conexion->close();
    }
    ?>
</body>
</html>