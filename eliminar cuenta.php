<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar cuenta Cliente</title>
    <script>
        function validarFormulario() {
            // Asegurarse de que el campo de correo está lleno
            var correo = document.getElementById('correo').value;
            if (correo === '') {
                alert('Por favor, ingrese su correo electrónico.');
                return false;
            }
            return true;
        }
    </script>
    <style>
        h1 {
            font-family: verdana;
            font-size: 30px;
            text-align: center;
        }
        p {
            margin-left: 15%;
            margin-top: 40px;
            font-family: Arial;
            font-size: 20px;
        }
        .Correo {
            font-family: Arial;
            font-size: 20px;
            margin-top: 60px;
            margin-left: 15%;
        }
        .Contraseña {
            font-family: Arial;
            font-size: 20px;
            margin-top: 20px;
            margin-left: 15%;
        }
        .Correo label {
            display: block;
            margin-bottom: 10px;
            margin-top: 0%;
        }
        .Botón_de_enviar {
            margin-left: 15%;
        }
    </style>
</head>
<body>
    <h1>¿Por qué desea eliminar su cuenta?</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onsubmit="return validarFormulario();">
        <div class="Contraseña">
            <label for="Correo_Cliente">Correo Cliente:</label>
            <input type="email" name="Correo_Cliente" required><br>

            <label for="Contraseña">Contraseña:</label>
            <input type="password" name="Contraseña" required><br>

            <label for="ID_Direccion">ID_Direccion:</label>
            <input type="text" name="ID_Direccion" required><br>

            <label for="Nombre_cliente">Nombre Cliente:</label>
            <input type="text" name="Nombre_cliente" required><br>

            <label for="Direccion">Direccion:</label>
            <input type="text" name="Direccion" required><br>

            <label for="Indicaciones">Indicaciones:</label>
            <input type="text" name="Indicaciones" required><br>

            <label for="Ciudad">Ciudad:</label>
            <input type="text" name="Ciudad" required><br>

            <label for="Region">Region:</label>
            <input type="text" name="Region" required><br>

            <input type="submit" value="Eliminar">
        </div>
    </form>
    <?php
    session_start();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Recoger los datos del formulario
        $Correo_Cliente = $_POST['Correo_Cliente'];
        $Contraseña = $_POST['Contraseña'];

        // Conectar a la base de datos
        $host = "localhost";
        $usuario = "root";
        $contrasena = "";  // Contraseña en lugar de Contraseña
        $base_datos = "techome";
        $conexion = new mysqli($host, $usuario, $contrasena, $base_datos);

        if ($conexion->connect_error) {
            die("Error de conexión a la base de datos: " . $conexion->connect_error);
        }

        // Sentencia SQL para eliminar al cliente
        $sql = "DELETE FROM clientes WHERE Correo_Cliente = '$Correo_Cliente' AND Contraseña = '$Contraseña'";

        if ($conexion->query($sql) === TRUE) {
            echo "Cliente eliminado con éxito.";
        } else {
            echo "Error al eliminar al cliente: " . $conexion->error;
        }

        $conexion->close();
    }
    ?>
</body>
</html>