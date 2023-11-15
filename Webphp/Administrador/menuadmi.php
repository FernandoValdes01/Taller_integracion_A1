<?php
    session_start();

    if (isset($_SESSION['Rut_administrador'])) {
        $correo = $_SESSION['Rut_administrador'];
        $contraseñaC = $_SESSION['contrasena'];
        $nombre = $_SESSION['nombre_completo'];
    } else {
        header("Location: iniciadministrador.php");
        exit();
    }
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recursos Humanos Techome</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(150deg, #FF4F00, #E58729);
            color: white;
            text-align: center;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        h1 {
            font-size: 36px;
        }

        .container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
            max-width: 600px;
            width: 100%;
        }

        .button {
            display: inline-block;
            width: calc(50% - 5px);
            padding: 20px 40px;
            margin: 10px;
            font-size: 18px;
            text-align: center;
            text-decoration: none;
            border-radius: 8px;
            color: white;
            background-color: #FF883F;
            transition: transform 0.3s ease-in-out;
            border: 2px solid black; 
        }

        .button:hover {
            transform: scale(1.25);
        }

        .Logo {
            width: 100px;
            height: auto; 
        }

    </style>
</head>
<body>
    <div class="Box">
    <h1>Recursos Humanos TecHome</h1>
        <div class="container"> <!-- Corregido el nombre de la clase a "container" en lugar de "Conteiner" -->
            <a href="desvincular.php" class="button">Revisar Trabajadores</a>
            <a href="revisionsolicitantes.php" class="button">Revisar Solicitantes</a>
            <a href="asistenciacliente.php" class="button">Solicitudes de Asistencia Clientes</a>
            <a href="asistenciatrabajadores.php" class="button">Solicitudes de Asistencia Trabajador</a>
        </div>
    </div>
</body>
</html>
