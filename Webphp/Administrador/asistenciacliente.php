<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asistencias Cliente</title>
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
            height: 100vh;}
        h1 {
            font-size: 36px;
            margin-bottom: 20px;}
        .container {
            border: 1px solid #ddd;
            padding: 10px;
            margin: 10px;
            border-radius: 5px;
            background-color: #f5f5f5;
            color: black;}
        .responder-btn {
            padding: 5px 10px;
            margin-top: 10px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;}
        nav {
            background-color: #333;
            padding: 10px;
            text-align: center;}
        nav a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            margin: 0 10px;
            border-radius: 4px;
            border: 1px solid white;}
    </style>
</head>
<body>
    <nav>
        <a href="menuadmin.php">Menú Admin</a>
    </nav>
    <h1>Asistencias Cliente</h1>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            ?>
            <div class="container">
                <p><strong>ID_AsistenciaT:</strong> <?php echo $row["ID_AsistenciaC"]; ?></p>
                <p><strong>Rut Trabajador:</strong> <?php echo $row["ID_cliente"]; ?></p>
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
                window.location.href = "responderC.php?id=" + idAsistenciaC + "&respuesta=" + encodeURIComponent(respuesta);}}
    </script>
    <script>
        function responder(idAsistenciaC) {
            var respuesta = prompt("Ingrese la respuesta:");
            if (respuesta !== null) {
                window.location.href = "responder.php?id=" + idAsistenciaC + "&respuesta=" + encodeURIComponent(respuesta);}}
    </script>
</body>
</html>