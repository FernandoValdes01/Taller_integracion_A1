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

    $correo = $_POST['Correo_Trabajador'];
    $contrasena = $_POST['contrasena'];


    $sql = "SELECT Rut_Trabajador,Correo_Trabajador, contraseña,Nombre_Trabajador,Foto,Profesion,Monto_Cuenta,Calificacion,Descripcion FROM trabajador WHERE Correo_Trabajador = '$correo'";
    $result = $conexion->query($sql);


    if ($result === false) {
        die("Error en la consulta SQL: " . $conexion->error);
    }


    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();
        $rut_trabajador=$row['Rut_Trabajador'];
        $contrasena_db = $row['contraseña'];
        $nombre = $row["Nombre_Trabajador"];
        $calificacion = $row["Calificacion"];    
        $Monto_cuenta = $row["Monto_Cuenta"];
        $descripcion = $row["Descripcion"];
        $foto = $row["Foto"];
        $profesion=$row["Profesion"];

}   
    if ($contrasena == $contrasena_db) {
    $mensaje = "Inicio de sesión exitoso. ¡Bienvenido!";
    session_start();
    $_SESSION['Rut_Trabajador']=$rut_trabajador;
    $_SESSION['Correo_Trabajador'] = $correo;
    $_SESSION['contraseña'] = $contrasena_db;
    $_SESSION['Nombre_Trabajador'] = $nombre;
    $_SESSION['Calificacion'] = $calificacion;
    $_SESSION['Monto_Cuenta'] = $Monto_cuenta;
    $_SESSION['Descripcion'] = $descripcion;
    $_SESSION['Foto'] = $foto; 
    $_SESSION['Profesion']=$profesion;
    header('Location:perfiltrabajador.php');
    exit();
    } else {
    $mensaje = "Error en el inicio de sesión. Comprueba tus credenciales.";
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

