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
    function generarIDUnico($conexion) {
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
        $sql = "SELECT ID_Cliente FROM clientes WHERE correo = '$correo'";
        $result = $conexion->query($sql);
        return $result && $result->num_rows > 0; 
    }

    // Verificar si la solicitud HTTP es de tipo POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['nombre']) && isset($_POST['correo']) && isset($_POST['contraseña']) && isset($_POST['confirmar_contrasena'])) {
            // Establecer la conexión a la base de datos
            $conexion = new mysqli($host, $usuario, $contrasena, $base_datos);
            if ($conexion->connect_error) {
                die("Error de conexión a la base de datos: " . $conexion->connect_error);
            }

            // Obtener datos del formulario
            $nombre = $_POST['nombre'];
            $correo = $_POST['correo'];
            $contrasena = $_POST['contraseña'];
            $confirmar_contrasena = $_POST['confirmar_contrasena'];

            // Verificar si el correo ya existe en la base de datos
            if (verificarCorreoExistente($conexion, $correo)) {
                echo "Ya existe un cliente con este correo electrónico.";
            } elseif ($contrasena !== $confirmar_contrasena) {
                echo "Las contraseñas no coinciden.";
            } else {
                // Generar una dirección aleatoria
                list($calle, $numero) = generarCalleNumero();

                // Generar IDs únicos para cliente y dirección
                $id_cliente = generarIDUnico($conexion);
                $id_direccion = generarIDUnico($conexion);

                // Insertar la dirección en la base de datos
                $sql = "INSERT INTO direccion (ID_Direccion, calle, numero) VALUES ('$id_direccion', '$calle', '$numero')";
                if ($conexion->query($sql) === TRUE) {
                    // Insertar el cliente en la base de datos
                    $sql = "INSERT INTO clientes (ID_Cliente, nombre_cliente, correo, contraseña, ID_Direccion) VALUES ('$id_cliente', '$nombre', '$correo', '$contrasena', '$id_direccion')";
                    if ($conexion->query($sql) === TRUE) {
                        echo "Registro exitoso.";
                    } else {
                        // Manejar errores si la inserción del cliente falla
                    }
                } else {
                    // Manejar errores si la inserción de la dirección falla
                }
            }

            // Cerrar la conexión a la base de datos
            $conexion->close();
        }
    }
    ?>
    <!-- Formulario de registro -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required><br>

        <label for="correo">Correo:</label>
        <input type="email" name="correo" required><br>

        <label for="contraseña">Contraseña:</label>
        <input type="password" name="contraseña" required><br>

        <label for="confirmar_contrasena">Confirmar Contraseña:</label>
        <input type="password" name="confirmar_contrasena" required><br>

        <input type="submit" value="Registrar">
    </form>
</body>
</html>

