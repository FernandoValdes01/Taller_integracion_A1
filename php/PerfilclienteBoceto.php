<?php
session_start();

if (!isset($_SESSION['correo'])) {
    
    header("Location: inicioclientes.php"); 
    exit();
}

$server = "localhost";
$usuario = "root";
$contraseña = "";
$basededatos = "techome";

$conexion = new mysqli($server, $usuario, $contraseña, $basededatos);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}


$correo = $_SESSION['correo']; 
$nombre=$_SESSION['nombre_cliente'];
$contraseñaC=$_SESSION['contraseña'];
$sql = "SELECT nombre_cliente, correo FROM clientes WHERE correo = '$correo'";
$result = $conexion->query($sql);




if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si los campos existen en $_POST antes de acceder a ellos
    if (isset($_POST["nombre"]) && isset($_POST["email"]) && isset($_POST["contrasena"])) {
        $nuevo_nombre = $_POST["nombre"];
        $nuevo_email = $_POST["email"];
        $nueva_contraseña = $_POST["contrasena"];
        
        // Actualizar el perfil en la base de datos
        $sql = "UPDATE clientes SET nombre_cliente='$nuevo_nombre', correo='$nuevo_email', contraseña='$nueva_contraseña' WHERE correo='$correo'";

        if ($conexion->query($sql) === TRUE) {
            $_SESSION['nombre_cliente'] = $nuevo_nombre;
            $_SESSION['correo'] = $nuevo_email;
            $_SESSION['contraseña'] = $nueva_contraseña;
            echo "Perfil actualizado con éxito.";
        } else {
            echo "Error al actualizar el perfil: " . $conexion->error;
        }
    } else {
        echo "Error: Alguno de los campos del formulario no se envió correctamente.";
    }
}




$conexion->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Perfil</title>
</head>
<body>
    <h1>¡Hola <?php echo $nombre; ?>!</h1>
    <h2>Editar Perfil</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" value="<?php echo $nombre; ?>" required><br><br>

        <label for="email">Correo:</label>
        <input type="email" name="email" id="email" value="<?php echo $correo; ?>" required><br><br>

        <label for="contrasena">Contraseña:</label>
        <input type="password" name="contrasena" id="contrasena" value="<?php echo $contraseñaC; ?>" required><br><br>

        <input type="submit" value="Guardar Cambios">
    </form>
</body>
</html>
