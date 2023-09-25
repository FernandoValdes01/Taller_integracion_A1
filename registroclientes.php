<!DOCTYPE html>
<html>
<head>
    <title>Registro de Cliente</title>
</head>
<body>
    <h1>Registro de Cliente</h1>
    <?php
    $host = "localhost";
    $usuario = "root";
    $contrasena = "";
    $base_datos = "test";

    function generarIDUnico($conexion) {
        return rand(1000, 9999);
    }

    function generarCalleNumero() {
        $calle = "Calle " . rand(1, 100);
        $numero = rand(1, 500);
        return [$calle, $numero];
    }

    function verificarCorreoExistente($conexion, $correo) {
        $sql = "SELECT ID_Cliente FROM clientes WHERE correo = '$correo'";
        $result = $conexion->query($sql);
        return $result->num_rows > 0;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $conexion = new mysqli($host, $usuario, $contrasena, $base_datos);
        if ($conexion->connect_error) {
            die("Error de conexión a la base de datos: " . $conexion->connect_error);
        }

        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $contrasena = $_POST['contraseña'];
        $confirmar_contrasena = $_POST['confirmar_contrasena'];

        if (verificarCorreoExistente($conexion, $correo)) {
            echo "Ya existe un cliente con este correo electrónico.";
        } elseif ($contrasena !== $confirmar_contrasena) {
            echo "Las contraseñas no coinciden.";
        } else {
            list($calle, $numero) = generarCalleNumero();


            $id_cliente = generarIDUnico($conexion);
            $id_direccion = generarIDUnico($conexion);

            $sql = "INSERT INTO direccion (ID_Direccion, calle, numero) VALUES ('$id_direccion', '$calle', '$numero')";
            if ($conexion->query($sql) === TRUE) {
                $sql = "INSERT INTO clientes (ID_Cliente, nombre_cliente, correo, contraseña, ID_Direccion) VALUES ('$id_cliente', '$nombre', '$correo', '$contrasena', '$id_direccion')";
                if ($conexion->query($sql) === TRUE) {
                    echo "Registro exitoso." ;
                } else {
                }
            } else {
            }
        }

        $conexion->close();
    }
    ?>
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
