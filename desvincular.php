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
    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
    background-color: #27496D;
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
    margin-left: 1%;
    margin-right: 6%;
    padding: 3%;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 99vh;
    border-radius: 9px;
}

footer {
    background-color: #142850;
    border: 2px solid #2C74B3;
    text-align: center;
    margin: 1%;
    padding: 2%;
    border-radius: 9px;
    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
}

a {
    text-decoration: none;
    color: #fff;
}

button.button-style {
    background-color: #142850;
    border: 2px solid #2C74B3;
    color: #F1EFEF;
    border-radius: 5px;
    padding: 0.5%;
    width: 99%;
    margin-bottom: 9px;
}
input {
    background-color: #142850;
    border: 2px solid #2C74B3;
    border-radius: 9px;
}

section {
    background-color: #0A2647;
    border: 3px solid #144272;
    padding-top: 5%;
    padding-bottom: 5%;
    padding-left: 5%;
    padding-right: 6%;
    border-radius: 9px;
}

button:hover {
    background-color: #2C74B3;
    color: #fff;
}

.secondbutton {
    margin-bottom: 9%;
}

.container {
    max-width: 960px;
    margin-top: auto;
    margin-bottom: auto;
    margin-left: auto;
    margin-right: auto;
    padding: 20px;
}
.profile-section {
    margin-top: 3%;
}
.profile-section h2 {
    margin-bottom: 9px;
}
.profile-section label {
    display: block;
    margin-bottom: 9px;
}
.profile-section input[type="text"],
.profile-section input[type="password"],
.profile-section input[type="email"] {
    width: 99%;
    padding: 9px;
    margin-bottom: 20px;
    border-radius: 3px;
}
.profile-section button {
    float: right;
    padding: 9px 20px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
}
h1 {
    margin: 0;
}

.trabajador-info {
    text-align: center;
    padding: 20px;
}
.trabajador-avatar {
    border-radius: 50%;
    width: 99px;
    height: 99px;
    background-color: #fff;
    display: inline-block;
}
.trabajador-nombre {
    font-size: 24px;
    margin-top: 9px;
}
.trabajos-disponibles {
    background-color: #fff;
    padding: 20px;
    margin: 20px;
    border-radius: 5px;
    box-shadow: 0 0 9px rgba(0, 0, 0, 0.1);
}
ul {
    list-style-type: none;
    padding: 0;
}
li {
    list-style-type: none;
    padding: 0;
}
.trabajo {
    background-color: #0A2647;
    border: 3px solid #144272;
    padding: 3%;
    border-radius: 9px;
}

#passtext {
    margin-top: 20px;
    padding-top: 50px;
}

#menu {
    position: fixed;
    top: 0;
    right: -303px;
    width: 300px;
    height: 99%;
    background-color: #142850;
    border: 2px solid #2C74B3;
    border-radius: 9px;
    color: #fff;
    transition: right 0.3s;
}

#menu.active {
    right: 0;
}

#menu ul {
    list-style: none;
    padding: 0;
}

#menu ul li {
    padding: 15px;
    text-align: left;
    margin-left: 5%;
    cursor: pointer;
    border-bottom: 1px solid #142850;
}

#content {
    padding: 20px;
    text-align: center;
    margin-top: 9px;
    margin-bottom: 9px;
}

#menu-toggle {
    position: fixed;
    top: 20px;
    right: 20px;
    cursor: pointer;
    color: #fff;
    padding: 1%;
    margin-top: 1%;
    margin-right: 1%;
    background-color: #142850;
    border: 2px solid #2C74B3;
    border-radius: 9px;
}

.trabajador-container {
    background-color: #0A2647;
    border: 3px solid #144272;
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 9px;
    box-shadow: 0 0 9px rgba(0, 0, 0, 0.1);
}

.trabajador-container p {
    margin: 5px 0;
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
        <h1>Configuración del Administrador - TecHome</h1>
    </header>
    <div class="container">
        <div class="profile-section">
        </div>
    </div>

    <div class="trabajadores-section">
        <h2>Lista de Trabajadores</h2>
    </div>
</body>
</html>
