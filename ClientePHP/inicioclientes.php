<?php
$server = "localhost";
$usuario = "root";
$contraseña = "";
$basededatos = "techome";

$conexion = new mysqli($server, $usuario, $contraseña, $basededatos);
$mensaje = ""; 


if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];
    $sql = "SELECT ID_cliente,Correo_Cliente, contraseña,nombre_Cliente FROM clientes WHERE Correo_Cliente = '$correo'";
    $result = $conexion->query($sql);

    if ($result === false) {
        die("Error en la consulta SQL: " . $conexion->error);
    }

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $contrasena_db = $row['contraseña'];
        $nombre=$row["nombre_Cliente"];
        $ID_cliente=$row["ID_cliente"];
        if ($contrasena == $contrasena_db) {
            $mensaje = "Inicio de sesión exitoso. ¡Bienvenido!";
            session_start();
            $_SESSION['Correo_Cliente'] = $correo;
            $_SESSION['contraseña'] = $contrasena_db;
            $_SESSION['nombre_Cliente'] = $nombre;
            $_SESSION['ID_cliente'] = $ID_cliente;
            header('Location: Menu.php'); 
            exit();
        } else {
            $mensaje = "Error en el inicio de sesión. Comprueba tus credenciales.";
        }
    } else {
        $mensaje = "Error en el inicio de sesión. El correo no existe en la base de datos.";
    }
}


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
            <form method="POST" action="inicioclientes.php">
                <div class="InputBox">
                    <label for="correo">Correo electrónico:</label>
                    <input type="email" id="correo" name="correo" required> 
                </div>
                <div class="InputBox">
                    <label for="contrasena">Contraseña:</label>
                    <input type="password" id="contrasena" name="contrasena" required>  
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
