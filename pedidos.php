<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Estado de Pedido</title>
    <style>
body {
    background-color: #27496D;
    color: #F1EFEF;
    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif
}

a{
    color: #fff;
    text-decoration: none;
}

header{
    background-color: #142850;
    border: 2px solid #2C74B3;
    text-align: center;
    margin-top: 1%;
    margin-bottom: 1%;
    margin-left: 1%;
    margin-right: 7%;
    padding: 1%;
    border-radius: 10px;
}

footer{ 
    background-color: #142850;
    border: 2px solid #2C74B3;
    text-align: center;
    margin: 1%;
    padding: 2%;
    border-radius: 10px;
    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
}

#menu {
    position: fixed;
    top: 0;
    right: -303px; 
    width: 300px;
    height: 100%;
    background-color: #142850;
    border: 2px solid #2C74B3;
    border-radius: 10px;
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
    margin-top: 7%;
    margin-left: 2%;
    padding: 2%;
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