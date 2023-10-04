<?php
session_start();

// Configuración de la conexión a la base de datos
$server = "localhost";
$usuario = "root";
$contraseña = "";
$basededatos = "techome";

// Establecer la conexión a la base de datos
$conexion = new mysqli($server, $usuario, $contraseña, $basededatos);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $contrasena_usuario = $_POST["contrasena"];
    $confirmar_contrasena = $_POST["confirmar_contrasena"];
    $contraseñadb_ = $_SESSION['contraseña'];
    $correo = $_SESSION['correo'];

    if ($contrasena_usuario === $confirmar_contrasena && $contrasena_usuario === $contraseñadb_) {
        // Consulta SQL para eliminar la cuenta del usuario
        $sql = "DELETE FROM clientes WHERE correo = '$correo'";
        $result = $conexion->query($sql);

        // Comprobar si la consulta SQL fue exitosa
        if ($result === false) {
            die("Error en la consulta SQL: " . $conexion->error);
        }

        if ($conexion->query($sql) === TRUE) {
            echo "Cuenta eliminada exitosamente.";

            session_destroy();
        } else {
            echo "Error al eliminar la cuenta: " . $conexion->error;
        }
    } else {
        echo "La contraseña no coincide o es incorrecta. No se pudo eliminar la cuenta.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Eliminar Cuenta</title>
</head>
<body>
    <h2>Eliminar Cuenta</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="contrasena">Contraseña:</label>
        <input type="password" name="contrasena" id="contrasena" required>
        <br>
        <label for="confirmar_contrasena">Confirmar Contraseña:</label>
        <input type="password" name="confirmar_contrasena" id="confirmar_contrasena" required>
        <br>
        <button type="submit">Eliminar Cuenta</button>
    </form>
</body>
</html>
