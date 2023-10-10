<!DOCTYPE html>
<html>
<head>
    <title>Registro de Cliente</title>
</head>
<body>
    <h1>Registro de Cliente</h1>
    <?php
    // Configuración de la conexión a la base de datos
    $host = "localhost";
    $usuario = "root";
    $contrasena = "";
    $base_datos = "techome";

    // Función para generar un ID único
    function generarIDUnico() {
        return rand(1000, 9999);
    }

    // Función para generar una calle y número aleatorio
    function generarCalleNumero() {
        $calle = "Calle " . rand(1, 100);
        $numero = rand(1, 500);
        return [$calle, $numero];
    }

    // Función para verificar si un correo ya existe en la base de datos
    function verificarCorreoExistente($conexion, $correo) {
        $sql = "SELECT Correo_Cliente FROM clientes WHERE Correo_Cliente = '$correo'";
        $result = $conexion->query($sql);
        return $result && $result->num_rows > 0;
    }

    // Verificar si la solicitud HTTP es de tipo POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['Correo_Cliente']) && isset($_POST['Nombre_cliente']) && isset($_POST['Contraseña']) && isset($_POST['Direccion']) && isset($_POST['Indicaciones']) && isset($_POST['Ciudad']) && isset($_POST['Region'])) {
            // Establecer la conexión a la base de datos
            $conexion = new mysqli($host, $usuario, $contrasena, $base_datos);
            if ($conexion->connect_error) {
                die("Error de conexión a la base de datos: " . $conexion->connect_error);
            }

            // Obtener datos del formulario
            $correo = $_POST['Correo_Cliente'];
            $nombre = $_POST['Nombre_cliente'];
            $contrasena = $_POST['Contraseña'];
            $direccion = $_POST['Direccion'];
            $indicaciones = $_POST['Indicaciones'];
            $ciudad = $_POST['Ciudad'];
            $region = $_POST['Region'];

            // Verificar si el correo ya existe en la base de datos
            if (verificarCorreoExistente($conexion, $correo)) {
                echo "Ya existe un cliente con este correo electrónico.";
            } else {
                // Generar IDs únicos para dirección y cliente
                $id_direccion = generarIDUnico();
                $id_cliente = generarIDUnico();

                // Insertar la dirección en la base de datos
                $sql = "INSERT INTO direccion (ID_Direccion, Direccion, Indicaciones, Ciudad, Region) VALUES ('$id_direccion', '$direccion', '$indicaciones', '$ciudad', '$region')";
                if ($conexion->query($sql) === TRUE) {
                    // Insertar el cliente en la base de datos
                    $sql = "INSERT INTO clientes (Correo_Cliente, Nombre_cliente, Contraseña, ID_Direccion) VALUES ('$correo', '$nombre', '$contrasena', '$id_direccion')";
                    if ($conexion->query($sql) === TRUE) {
                        echo "Registro exitoso.";
                    } else {
                        echo "Error al insertar el cliente en la base de datos.";
                    }
                } else {
                    echo "Error al insertar la dirección en la base de datos.";
                }
            }

            // Cerrar la conexión a la base de datos
            $conexion->close();
        }
    }
    ?>
    <!-- Formulario de registro -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label for="Correo_Cliente">Correo Cliente:</label>
        <input type="email" name="Correo_Cliente" required><br>

        <label for="Nombre_cliente">Nombre Cliente:</label>
        <input type="text" name="Nombre_cliente" required><br>

        <label for="Contraseña">Contraseña:</label>
        <input type="password" name="Contraseña" required><br>

        <label for="Direccion">Dirección:</label>
        <input type="text" name="Direccion" required><br>

        <label for="Indicaciones">Indicaciones:</label>
        <input type="text" name="Indicaciones" required><br>

        <label for="Ciudad">Ciudad:</label>
        <input type="text" name="Ciudad" required><br>

        <label for="Region">Región:</label>
        <input type="text" name="Region" required><br>

        <input type="submit" value="Registrar">
    </form>
</body>
</html>