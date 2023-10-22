<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar cuenta Cliente</title>
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
    <div class="container">
        <h1>¿Por qué desea eliminar su cuenta?</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onsubmit="return validarFormulario();">
            <div class="form-group">
                <label for="Correo_Cliente">Correo Cliente:</label>
                <input type="email" name="Correo_Cliente" required>
            </div>

            <div class="form-group">
                <label for="Contraseña">Contraseña:</label>
                <input type="password" name="Contraseña" required>
            </div>

            <div class="form-group">
                <label for="ID_Direccion">ID_Direccion:</label>
                <input type="text" name="ID_Direccion" required>
            </div>

            <div class="form-group">
                <label for="Nombre_cliente">Nombre Cliente:</label>
                <input type="text" name="Nombre_cliente" required>
            </div>

            <div class="form-group">
                <label for="Direccion">Direccion:</label>
                <input type="text" name="Direccion" required>
            </div>

            <div class="form-group">
                <label for="Indicaciones">Indicaciones:</label>
                <input type="text" name="Indicaciones" required>
            </div>

            <div class="form-group">
                <label for="Ciudad">Ciudad:</label>
                <input type="text" name="Ciudad" required>
            </div>

            <div class="form-group">
                <label for="Region">Region:</label>
                <input type="text" name="Region" required>
            </div>

            <input type="submit" class="Botón_de_enviar" value="Eliminar">
        </form>

        <?php
        session_start();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $Correo_Cliente = $_POST['Correo_Cliente'];
            $Contraseña = $_POST['Contraseña'];

            $host = "localhost";
            $usuario = "root";
            $contrasena = "";
            $base_datos = "techome";
            $conexion = new mysqli($host, $usuario, $contrasena, $base_datos);

            if ($conexion->connect_error) {
                die("Error de conexión a la base de datos: " . $conexion->connect_error);
            }

            $sql = "DELETE FROM clientes WHERE Correo_Cliente = '$Correo_Cliente' AND Contraseña = '$Contraseña'";

            if ($conexion->query($sql) === TRUE) {
                echo "Cliente eliminado con éxito.";
            } else {
                echo "Error al eliminar al cliente: " . $conexion->error;
            }

            $conexion->close();
        }
        ?>
    </div>
</body>
</html>