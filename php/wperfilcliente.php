<?php
session_start();

if (!isset($_SESSION['Correo_Cliente'])) {
    header("Location: inicioclientes.php");
    exit();
}

$server = "localhost";
$usuario = "root";
$contrasena = "";
$basededatos = "techomedef";

$conexion = new mysqli($server, $usuario, $contrasena, $basededatos);


if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$correo = $_SESSION['Correo_Cliente'];
$nombre = $_SESSION['Nombre_cliente'];
$contraseñaC = $_SESSION['contraseña'];

$sql = "SELECT Nombre_cliente, Correo_Cliente, Contraseña FROM clientes WHERE Correo_Cliente = '$correo'";
$result = $conexion->query($sql);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["nombre"]) && isset($_POST["email"]) && isset($_POST["contrasena"])) {
        $nuevo_nombre = $_POST["nombre"];
        $nuevo_email = $_POST["email"];
        $nueva_contraseña = $_POST["contrasena"];

        $sql = "UPDATE clientes SET Nombre_cliente='$nuevo_nombre', Correo_Cliente='$nuevo_email', Contraseña='$nueva_contraseña' WHERE Correo_Cliente='$correo'";

        if ($conexion->query($sql) === TRUE) {
            $_SESSION['Nombre_cliente'] = $nuevo_nombre;
            $_SESSION['Correo_Cliente'] = $nuevo_email;
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
