<?php
// Configuración de la conexión a la base de datos
$server = "localhost";
$usuario = "root";
$contraseña = "";
$basededatos = "techomedef";//a modificar por al nombre

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
    $correo = $_POST['Correo_Trabajador'];
    $contrasena = $_POST['contrasena'];

    // Crear una consulta SQL para buscar un usuario por correo
    $sql = "SELECT Correo_Trabajador, contraseña,Nombre_Trabajador FROM trabajadores WHERE Correo_Trabajador = '$correo'";
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
        $nombre=$row["Nombre_Trabajador"];

        // Comprobar si la contraseña ingresada coincide con la almacenada en la base de datos
        if ($contrasena == $contrasena_db) {
            $mensaje = "Inicio de sesión exitoso. ¡Bienvenido!";
            session_start();
            $_SESSION['Correo_Trabajador'] = $correo;
            $_SESSION['contraseña'] = $contrasena_db;
            $_SESSION['Nombre_Trabajador'] = $nombre;
            header('Location:session.php'); 
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
            <form method="POST" action="iniciosesionT.php">
                <div class="InputBox">
                    <label for="Correo_Trabajador">Correo electrónico:</label>
                    <input type="email" id="Correo_Trabajador" name="Correo_Trabajador" required>
                </div>
                <div class="InputBox">
                    <label for="contrasena">Contraseña:</label>
                    <input type="password" id="contrasena" name="contrasena" required>
                </div>
                <div class="link">
                    <a href="#">¿Olvidaste la clave?</a>
                </div>
                <div class="Buttons">
                    <button type="submit">Listo</button>
                </div>
            </form>
            <button type="button" onclick="window.location.href='registrotrabajador.php'">Registrarse</button>
            <?php echo $mensaje;  ?>
        </div>
    </div>
</body>

