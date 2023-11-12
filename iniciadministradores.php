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
    $rut = $_POST['rut'];
    $contrasena = $_POST['contrasena'];
    $sql = "SELECT Rut_administrador, nombre_completo, cargo, Contraseña_Administrador FROM administradores WHERE Rut_administrador = '$rut'";
    $result = $conexion->query($sql);

    if ($result === false) {
        die("Error en la consulta SQL: " . $conexion->error);
    }

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $contrasena_db = $row['Contraseña_Administrador'];
        $nombre = $row["nombre_completo"];
        $cargo = $row["cargo"];

        if ($contrasena == $contrasena_db) {
            $mensaje = "Inicio de sesión exitoso. ¡Bienvenido!";
            session_start();
            $_SESSION['rut'] = $rut;
            $_SESSION['nombre'] = $nombre;
            $_SESSION['cargo'] = $cargo;
            header('Location: Perfiladministrador.php');
            exit();
        } else {
            $mensaje = "Error en el inicio de sesión. Comprueba tus credenciales.";
        }
    } else {
        $mensaje = "Error en el inicio de sesión. El Rut no existe en la base de datos.";
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
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            background-color: #27496D;
            color: #F1EFEF;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 99vh;
        }

        header {
            background-color: #142850;
            border: 2px solid #2C74B3;
            text-align: left;
            margin-top: 1%;
            margin-bottom: 1%;
            margin-left: 1%;
            margin-right: 6%;
            padding: 3%;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 99vh;
            border-radius: 9px;
        }

        footer{
            background-color: #142850;
            border: 2px solid #2C74B3;
            text-align: center;
            margin: 1%;
            padding: 2%;
            border-radius: 9px;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        }

        a{
            text-decoration: none;
            color: #fff;
        }

        button.button-style {
        background-color: #142850;
        border: 2px solid #2C74B3;
        color: #F1EFEF;
        border-radius: 5px;
        padding: 0.5%;
        width: 99%;
        margin-bottom: 9px;
        }
        input{
            background-color: #142850;
            border: 2px solid #2C74B3;
            border-radius: 9px;
        }

        section{
            background-color: #0A2647;
            border: 3px solid #144272;
            padding-top: 5%;
            padding-bottom: 5%;
            padding-left: 5%;
            padding-right: 6%;
            border-radius: 9px;
        }

        button:hover{
            background-color: #2C74B3;
            color: #fff;
        }

        .secondbutton{
            margin-bottom: 9%;
        }

        .container {
            max-width: 960px;
            margin-top: auto;
            margin-bottom: auto;
            margin-left: auto;
            margin-right: auto;
            padding: 20px;
        }
        .profile-section {
            margin-top: 3%;
        }
        .profile-section h2 {
            margin-bottom: 9px;
        }
        .profile-section label {
            display: block;
            margin-bottom: 9px;
        }
        .profile-section input[type="text"],
        .profile-section input[type="password"],
        .profile-section input[type="email"] {
            width: 99%;
            padding: 9px;
            margin-bottom: 20px;
            border-radius: 3px;
        }
        .profile-section button {
            float: right;
            padding: 9px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        h1 {
            margin: 0;
        }

        .trabajador-info {
            text-align: center;
            padding: 20px;
        }
        .trabajador-avatar {
            border-radius: 50%;
            width: 99px;
            height: 99px;
            background-color: #fff;
            display: inline-block;
        }
        .trabajador-nombre {
            font-size: 24px;
            margin-top: 9px;
        }
        .trabajos-disponibles {
            background-color: #fff;
            padding: 20px;
            margin: 20px;
            border-radius: 5px;
            box-shadow: 0 0 9px rgba(0, 0, 0, 0.1);
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            list-style-type: none;
            padding: 0;
        }
        .trabajo {
            background-color: #0A2647;
            border: 3px solid #144272;
            padding: 3%;
            border-radius: 9px;
        }

        #passtext{
            margin-top: 20px;
            padding-top: 50px;
        }

        #menu {
            position: fixed;
            top: 0;
            right: -303px; 
            width: 300px;
            height: 99%;
            background-color: #142850;
            border: 2px solid #2C74B3;
            border-radius: 9px;
            color: #fff;
            transition: right 0.3s; 
        }
        
        #menu.active {
            right: 0; 
        }
        
        #menu ul {
            list-style: none;
            padding: 0;
        }
        
        #menu ul li {
            padding: 15px;
            text-align: left;
            margin-left: 5%;
            cursor: pointer;
            border-bottom: 1px solid #142850;
        }
        
        #content {
            padding: 20px;
            text-align: center;
            margin-top: 9px;
            margin-bottom: 9px;
        }
        
        #menu-toggle {
            position: fixed;
            top: 20px;
            right: 20px;
            cursor: pointer;
            color: #fff;
            padding: 1%;
            margin-top: 1%;
            margin-right: 1%;
            background-color: #142850;
            border: 2px solid #2C74B3;
            border-radius: 9px;
        }
    </style>
</head>
<body>
    <div class="Box">
        <div class="Form">
            <h2>Inicia Sesión</h2>
            <form method="POST" action="iniciadministradores.php">
                <div class="InputBox">
                    <label for="rut">RUT:</label>
                    <input type="text" name="rut" required><br>
                </div>
                <div class="InputBox">
                    <label for="contrasena">Contraseña:</label>
                    <input type="password" name="contrasena" required><br>
                </div>
                <div class="link">
                    <a href="#">¿Olvidaste la clave?</a>
                </div>
                <div class="Buttons"></div>
                <button type="submit">Listo</button>
            </form>
            <button type="button" onclick="window.location.href='registroadministradores.php'">Registrarse</button>
            <?php echo $mensaje;  ?>
        </div>
    </div>
</body>
</html>