<?php
// Configuración de la conexión a la base de datos
$server = "localhost";
$usuario = "root";
$contraseña = "";
$basededatos = "techome";

// Establecer la conexión a la base de datos
$conexion = new mysqli($server, $usuario, $contraseña, $basededatos);
$mensaje = ""; // Variable para almacenar mensajes de resultado

// Comprobar si la conexión a la base de datos fue exitosa
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Comprobar si la solicitud HTTP es de tipo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los valores del formulario
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    // Crear una consulta SQL para buscar un usuario por correo
    $sql = "SELECT Correo_Cliente, contraseña,Nombre_cliente FROM clientes WHERE Correo_Cliente = '$correo'";
    $result = $conexion->query($sql);

    // Comprobar si la consulta SQL fue exitosa
    if ($result === false) {
        die("Error en la consulta SQL: " . $conexion->error);
    }

    // Comprobar si se encontraron resultados en la consulta
    if ($result->num_rows > 0) {
        // Obtener la primera fila de resultados
        $row = $result->fetch_assoc();
        $contrasena_db = $row['contraseña'];
        $nombre=$row["nombre_cliente"];

        // Comprobar si la contraseña ingresada coincide con la almacenada en la base de datos
        if ($contrasena == $contrasena_db) {
            $mensaje = "Inicio de sesión exitoso. ¡Bienvenido!";
            session_start();
            $_SESSION['Correo_Cliente'] = $correo;
            $_SESSION['contraseña'] = $contrasena_db;
            $_SESSION['Nombre_cliente'] = $nombre;
            header('Location: Menu.php'); 
            exit();
        } else {
            $mensaje = "Error en el inicio de sesión. Comprueba tus credenciales.";
        }
    } else {
        $mensaje = "Error en el inicio de sesión. El correo no existe en la base de datos.";
    }
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TecHome</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .Box {
            background-color: #fff;
            padding: 20px;
            border-radius: 4px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .Form {
            max-width: 300px;
            margin: 0 auto;
        }

        label,
        input {
            display: block;
            margin-bottom: 10px;
        }

        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="Box">
        <div class="Form">
            <h2>Inicia Sesión</h2>
            <form method="POST" action="inicioclientes.php"> <!-- Reemplaza 'nombre_de_esta_pagina.php' con el nombre de tu archivo PHP -->
                <div class="InputBox">
                    <label for="correo">Correo electrónico:</label>
                    <input type="email" id="correo" name="correo" required> <!-- Agregamos el atributo 'name' para que los datos se envíen correctamente -->
                </div>
                <div class="InputBox">
                    <label for="contrasena">Contraseña:</label> <!-- Corregimos el id de la etiqueta 'input' -->
                    <input type="password" id="contrasena" name="contrasena" required> <!-- Agregamos el atributo 'name' para que los datos se envíen correctamente -->
                </div>
                <div class="link">
                    <a href="#">¿Olvidaste la clave?</a>
                </div>
                <div class="Buttons"></div>
                <button type="submit">Listo</button>
            </form>
            <button type="button" onclick="window.location.href='registroclientes.php'">Registrarse</button>
            <?php echo $mensaje;  ?>
        </div>
    </div>
</body>
</html>
