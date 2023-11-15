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
    $count = 1;
    while ($row = $result->fetch_assoc()) {
        echo "<div style='border: 1px solid #ccc; padding: 10px; margin: 10px;'>";
        echo "<p><strong># " . $count . "</strong></p>";
        echo "<p><strong>Nombre:</strong> " . $row["Nombre_Trabajador"] . "</p>";
        echo "<p><strong>Correo:</strong> " . $row["Correo_Trabajador"] . "</p>";
        echo "<p><strong>Profesión:</strong> " . $row["Profesion"] . "</p>";
        echo "<p><strong>Calificación:</strong> " . $row["Calificacion"] . "</p>";
        echo "<div style='display: flex;'>";
        echo "<a href='solicitarservicio.php'><button style='margin-right: 10px;'>Solicitar Servicio</button></a>";
        echo "</div>";
        echo "</div>";
        $count++;
    }
} else {
    echo "0 resultados";
}
$conn->close();
?>
