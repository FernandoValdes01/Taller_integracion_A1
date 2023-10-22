<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "techome";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$order = isset($_GET['order']) ? $_GET['order'] : 'normal';

if ($order === 'mejor') {
    $sql = "SELECT * FROM solicitudservicio ORDER BY precio DESC";
} elseif ($order === 'peor') {
    $sql = "SELECT * FROM solicitudservicio ORDER BY precio ASC";
} else {
    $sql = "SELECT * FROM solicitudservicio";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>#</th><th>ID Solicitud</th><th>Tipo de Servicio</th><th>Descripción</th><th>Correo Cliente</th><th>Precio</th></tr>";
    $count = 1;
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $count . "</td><td>" . $row["ID_solicitud"] . "</td><td>" . $row["tipo_servicio"] . "</td><td>" . $row["descripcion"] . "</td><td>" . $row["ID_cliente"] . "</td><td>" . $row["precio"] . "</td></tr>";
        $count++;
    }
    echo "</table>";
} else {
    echo "0 resultados";
}
$conn->close();
?>
