<?php
// Configuración de la conexión a la base de datos
$server = "localhost";
$usuario = "root";
$contraseña = "";
$basededatos = "techome";

// Establecer la conexión a la base de datos
$conexion = new mysqli($server, $usuario, $contraseña, $basededatos);
$mensaje = ""; // Variable para almacenar mensajes de resultado

// Comprobar si la conexión a la base de datos fue exitosa
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Comprobar si la solicitud HTTP es de tipo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los valores del formulario
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    // Crear una consulta SQL para buscar un usuario por correo
    $sql = "SELECT correo, contraseña FROM clientes WHERE correo = '$correo'";
    $result = $conexion->query($sql);

    // Comprobar si la consulta SQL fue exitosa
    if ($result === false) {
        die("Error en la consulta SQL: " . $conexion->error);
    }

    // Comprobar si se encontraron resultados en la consulta
    if ($result->num_rows > 0) {
        // Obtener la primera fila de resultados
        $row = $result->fetch_assoc();
        $contrasena_db = $row['contraseña'];

        // Comprobar si la contraseña ingresada coincide con la almacenada en la base de datos
        if ($contrasena == $contrasena_db) {
            $mensaje = "Inicio de sesión exitoso. ¡Bienvenido!";
            session_start();
            header();
            exit();
        } else {
            $mensaje = "Error en el inicio de sesión. Comprueba tus credenciales.";
        }
    } else {
        $mensaje = "Error en el inicio de sesión. El correo no existe en la base de datos.";
    }
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Iniciar Sesión</title>
</head>
<body>
    <h2>Iniciar Sesión</h2>
    <p><?php echo $mensaje; ?></p>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="correo">Correo electrónico:</label>
        <input type="email" id="correo" name="correo" required><br><br>
        
        <label for="contrasena">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" required><br><br>
        
        <input type="submit" value="Iniciar Sesión">
    </form>
</body>
</html>
