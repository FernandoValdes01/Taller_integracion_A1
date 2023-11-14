<?php
session_start();

if (!(isset($_SESSION['rut']) && isset($_SESSION['nombre']))) {
    header("Location: iniciadministradores.php");
    exit();
}


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "techome";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    echo "<script>alert('Conexión fallida: " . $conn->connect_error . "');</script>";
}
$rut = isset($_SESSION['rut']) ? $_SESSION['rut'] : '';
$nombre = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : '';
$cargo = isset($_SESSION['cargo']) ? $_SESSION['cargo'] : '';
if (isset($_POST['actualizar'])) {
}

if (isset($_POST['cambiar'])) {
}

if (isset($_POST['eliminar_cuenta'])) {
}

if (isset($_POST['logout'])) {
}

function mostrarTrabajadores($conn, $rutAdmin) {
    $sql = "SELECT Rut_trabajador, Nombre_Trabajador, Profesion, Pedidos FROM trabajador";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='trabajador-container'>";
            echo "<p>Rut: " . $row['Rut_trabajador'] . "</p>";
            echo "<p>Nombre: " . $row['Nombre_Trabajador'] . "</p>";
            echo "<p>Profesión: " . $row['Profesion'] . "</p>";
            echo "<p>Total de Pedidos: " . $row['Pedidos'] . "</p>";

            echo "<form method='post' action=''>";
            echo "<input type='hidden' name='rut_trabajador' value='" . $row['Rut_trabajador'] . "'>";
            echo "<button type='submit' name='desvincular'>Desvincular</button>";
            echo "</form>";

            echo "</div>";
        }
    } else {
        echo "<p>No hay trabajadores registrados.</p>";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['desvincular'])) {
    $rut_trabajador_desvincular = $_POST['rut_trabajador'];

    $sqlActualizarPedidos = "UPDATE pedido_aceptado SET Rut_Trabajador = NULL WHERE Rut_Trabajador = ?";
    $stmtActualizarPedidos = $conn->prepare($sqlActualizarPedidos);
    $stmtActualizarPedidos->bind_param("s", $rut_trabajador_desvincular);

    if ($stmtActualizarPedidos->execute()) {
        $sqlEliminarTrabajador = "DELETE FROM trabajador WHERE Rut_trabajador = ?";
        $stmtEliminarTrabajador = $conn->prepare($sqlEliminarTrabajador);
        $stmtEliminarTrabajador->bind_param("s", $rut_trabajador_desvincular);

        if ($stmtEliminarTrabajador->execute()) {
            echo "<script>alert('Trabajador desvinculado exitosamente.');</script>";
        } else {
            echo "<script>alert('Error al desvincular al trabajador.');</script>";
        }

        $stmtEliminarTrabajador->close();
    } else {
        echo "<script>alert('Error al actualizar las referencias de pedidos.');</script>";
    }

    $stmtActualizarPedidos->close();
}
mostrarTrabajadores($conn, $rut);
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
body {
    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', 'Geneva', Verdana, sans-serif;
    background-color: #27496D;
    text-align: left;
    color: #F1EFEF;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 99vh;
}

header {
    background-color: #142850;
    border: 2px solid #2C74B3;
    text-align: left;
    margin-top: 1%;
    margin-bottom: 1%;
    margin-left: 0%;
    margin-right: 0%;
    padding: 3%;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 99vh;
    border-radius: 2;
}

.container {
    max-width: 960px;
    margin-top: 1%;
    margin-bottom: 1%;
    margin-left: 0%;
    margin-right: 0%;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 99vh;
    text-align: left;
    padding: 2px;
}

.trabajador-container {
    background-color: #0A2647;
    border: 3px solid #144272;
    padding: 26px;
    border-radius: 9px;
    box-shadow: 0 0 9px rgba(0, 0, 0, 0.1);
}

.trabajador-container p {
    margin: 9px 0;
    line-height: 1.5;
    padding: 5px;
}

.trabajador-container form {
    margin-top: 9px;
}

.trabajador-container button {
    margin-top: 9px;
}
    </style>
</head>
<body>
    <header>
        <h1>Lista de Trabajadores</h1>
    </header>
    <div class="container">
        <div class="profile-section">
        </div>
    </div>

    <div class="trabajadores-section">
        <h2></h2>
    </div>
</body>
</html>
