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
    $sql = "SELECT * FROM trabajador ORDER BY Calificacion DESC";
} elseif ($order === 'peor') {
    $sql = "SELECT * FROM trabajador ORDER BY Calificacion ASC";
} else {
    $sql = "SELECT * FROM trabajador";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>#</th><th>Nombre</th><th>Correo</th><th>Profesión</th><th>Calificación</th></tr>";
    $count = 1;
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $count . "</td><td>" . $row["Nombre_Trabajador"] . "</td><td>" . $row["Correo_Trabajador"] . "</td><td>" . $row["Profesion"] . "</td><td>" . $row["Calificacion"] . "</td></tr>";
        $count++;
    }
    echo "</table>";
} else {
    echo "0 resultados";
}
$conn->close();
?>
