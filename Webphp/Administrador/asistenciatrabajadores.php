<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "techome";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
$sql = "SELECT ID_AsistenciaT, Rut_trabajador, nombre, correo, mensaje, fecha, respuesta FROM asistenciat WHERE respuesta IS NULL OR respuesta = ''";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asistencias Trabajador</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #2c3e50;
    color: white;
    text-align: center;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 99vh;}
h1 {
    font-size: 36px;
    margin-bottom: 20px;}
.container {
    border: 1px solid #ddd;
    padding: 9px;
    margin: 9px;
    border-radius: 5px;
    background-color: #f5f5f5;
    color: black;}
.responder-btn {
    padding: 5px 9px;
    margin-top: 9px;
    background-color: #3498db;
    color: white;
    border: none;
    border-radius: 3px;
    cursor: pointer;}
    </style>
</head>
<body>
<nav>
        <a href="menuadmin.php">Menú Admin</a>
    </nav>
    <h2>Asistencias Trabajador</h2>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            ?>
            <div class="container">
                <p><strong>ID_AsistenciaT:</strong> <?php echo $row["ID_AsistenciaT"]; ?></p>
                <p><strong>Rut Trabajador:</strong> <?php echo $row["Rut_trabajador"]; ?></p>
                <p><strong>Nombre:</strong> <?php echo $row["nombre"]; ?></p>
                <p><strong>Correo:</strong> <?php echo $row["correo"]; ?></p>
                <p><strong>Mensaje:</strong> <?php echo $row["mensaje"]; ?></p>
                <p><strong>Fecha:</strong> <?php echo $row["fecha"]; ?></p>
                <p><strong>Respuesta:</strong> <?php echo $row["respuesta"]; ?></p>
                <button class="responder-btn" onclick='responder(<?php echo $row["ID_AsistenciaT"]; ?>)'>Responder</button>
            </div>
            <?php
}} else {
        echo "<p>No hay registros</p>";}
    ?>
    <script>
        function responder(idAsistenciaT) {
            var respuesta = prompt("Ingrese la respuesta:");
            if (respuesta !== null) {
                window.location.href = "responder.php?id=" + idAsistenciaT + "&respuesta=" + encodeURIComponent(respuesta);}}
    </script>
</body>
</html>
<?php
$conn->close();
?>