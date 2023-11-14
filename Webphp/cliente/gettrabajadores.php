<ul>
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
    $count = 0;
    while ($row = $result->fetch_assoc()) {
        if ($count < 9) {
            echo "<li>";
            echo '<div class="valoracion">';
            echo '<p><strong>Servicio:</strong> ' . $row["Profesion"] . '</p>';
            echo '<p><strong>Calificación:</strong> ' . $row["Calificacion"] . '</p>';
            echo '</div>';
            echo "</li>";
            $count++;
        } else {
            break;
        }
    }
} else {
    echo "No se encontraron registros.";
}

$conn->close();
?>
</ul>