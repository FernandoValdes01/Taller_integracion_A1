<?php
$host = 'localhost';
$username = 'root';
$password = ' ';
$database = 'integracion1'; //Cambiarlo cuando se haga la corrección de la BD



$conn = new mysqli($host, $username, $password, $database);


if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $contrasena = $_POST["contrasena"];

    // Verifica la contraseña (debes agregar más seguridad aquí)
    $sql = "SELECT id FROM usuarios WHERE id = ? AND contrasena = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $usuario_id, $contrasena);

    // Reemplaza $usuario_id con el ID del usuario actual
    $usuario_id = 1; // Cambia esto con la forma en que obtienes el ID del usuario actual

    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows === 1) {
        // Elimina la cuenta del usuario
        $delete_sql = "DELETE FROM usuarios WHERE id = ?";
        $delete_stmt = $conn->prepare($delete_sql);
        $delete_stmt->bind_param("i", $usuario_id);

        if ($delete_stmt->execute()) {
            // Cuenta eliminada con éxito
            header("Location: cuenta_eliminada.php");
            exit();
        } else {
            echo "Error al eliminar la cuenta.";
        }
    } else {
        echo "La contraseña es incorrecta.";
    }
    
    $stmt->close();
}

$conn->close();
?>
