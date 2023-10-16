<?php
session_start();

if (!isset($_SESSION['Correo_Cliente'])) {
    header("Location: inicioclientes.php");
    exit();
}

$server = "localhost";
$usuario = "root";
$contrasena = "";
$basededatos = "techome";

$conexion = new mysqli($server, $usuario, $contrasena, $basededatos);

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$correo = $_SESSION['Correo_Cliente'];
$Correo_Cliente = $_SESSION['Correo_Cliente'];
$nombre = $_SESSION['nombre_Cliente'];
$contraseñaC = $_SESSION['contraseña'];

$sql = "SELECT Nombre_cliente, Correo_Cliente, Contraseña FROM clientes WHERE Correo_Cliente = '$correo'";
$result = $conexion->query($sql);

$_SESSION['Correo_Cliente'] = $correo;
$_SESSION['nombre_Cliente'] = $nombre;
$_SESSION['contraseña'] = $contraseñaC;


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["nombre"]) && isset($_POST["email"]) && isset($_POST["contrasena"])) {
        $nuevo_nombre = $_POST["nombre"];
        $nuevo_email = $_POST["email"];
        $nueva_contraseña = $_POST["contrasena"];

        // Actualizar el perfil en la base de datos
        $sql = "UPDATE clientes SET nombre_cliente='$nuevo_nombre', Correo_Cliente='$nuevo_email', Contraseña='$nueva_contraseña' WHERE Correo_Cliente='$correo'";

        if ($conexion->query($sql) === TRUE) {
            $_SESSION['nombre_Cliente'] = $nuevo_nombre;
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tipo_servicio = $_POST['tipo_servicio'];
    $descripcion = $_POST['descripcion'];

    // Obtener el correo del cliente de la sesión
    $correo_cliente = $_SESSION['Correo_Cliente'];

    $conn = new mysqli('localhost', 'root', '', 'techome');
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    $sql = "INSERT INTO solicitudservicio (tipo_servicio, descripcion, Correo_Cliente) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $tipo_servicio, $descripcion, $correo_cliente);

    if ($stmt->execute()) {
        echo "La descripción se ha insertado en la base de datos con éxito.";
    } else {
        echo "Error al insertar la descripción en la base de datos: " . $stmt->error;
    }

    $conn->close();
} else {
    echo "Acceso no autorizado.";
}

?>
