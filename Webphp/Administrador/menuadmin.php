<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recursos Humanos Techome</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #2c3e50;
            color: white;
            text-align: center;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 99vh;
        }

        h1 {
            font-size: 36px;
        }

        .button {
            display: inline-block;
            padding: 20px 39px;
            margin: 20px;
            font-size: 18px;
            text-align: center;
            text-decoration: none;
            border-radius: 8px;
            color: white;
            background-color: #3498db;
            transition: transform 0.3s ease-in-out;
        }
        .button:hover {
            transform: scale(1.25);
        }
    </style>
</head>
<body>
    <h1>Recursos Humanos Techome</h1>
    <a href="trabajadores.php" class="button">Revisar Trabajadores</a>
    <a href="revisionsolicitantes.php" class="button">Revisar Solicitantes</a>
    <a href="asistenciacliente.php" class="button">Solicitudes de Asistencia Clientes</a>
    <a href="asistenciatrabajadores.php" class="button">Solicitudes de Asistencia Trabajador</a>
</body>
</html>
