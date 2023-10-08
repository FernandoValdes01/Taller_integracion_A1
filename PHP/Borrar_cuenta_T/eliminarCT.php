<?php
session_start();


if (!isset($_SESSION['trabajador_id'])) {
    header("Location: boceto.php"); // Arreglar el "Trabajador no iniciado" para que esto no de error.
    exit();
}


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "integracion1";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("La conexión a la base de datos falló: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $trabajador_id = $_SESSION['trabajador_id'];
    $contraseña1 = $_POST["contraseña1"];
    $contraseña2 = $_POST["contraseña2"];
    $motivo = $_POST["motivo"]; // Aún se esta arreglando el motivo.


    if ($contraseña1 !== $contraseña2) {
        echo "Las contraseñas no coinciden. Inténtalo de nuevo.";
    } else {

        $sql = "DELETE FROM trabajadores WHERE Rut_Trabajador = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $trabajador_id);

        if ($stmt->execute()) {
            session_unset();
            session_destroy();
            header("Location: login.php");
            exit();
        } else {
            echo "Error al eliminar la cuenta.";
        }
    }
}
?>