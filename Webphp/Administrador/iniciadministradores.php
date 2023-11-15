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
            $_SESSION['contrasena'] = $contrasena_db;
            header('Location: menuadmin.php');
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
        body{
            margin: 0;
            padding: 0;
            font-family: 'Verdana', 'Monaco', sans-serif;
            background: linear-gradient(150deg, #FF4F00, #E58729);
            color: #444444;
            height: 100vh;
            overflow: hidden;
        }  

        .Formulario{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 400px;
            background: white;
            border-radius: 10px;
        }

        .Formulario h1{
            color: #444444;
            text-align: center;
        }

        .Formulario p{
            font-size: 25px;
            text-align: center;
            padding: 0 0 20px 0;
            border-bottom: 1px solid silver;
        }

        .Formulario form{
            padding: 0 40px;
            box-sizing: border-box;
        }

        form .InputBox{
            position: relative;
            border-bottom: 2px solid silver;
            margin: 30px 0;
        }

        .InputBox input{
            width: 100%;
            padding: 0 5px;
            height: 40px;
            font-size: 16px;
            border: none;
            background: none;
            outline: none;
        }

        .InputBox label{
            position: absolute;
            top: -15%;
            left: 5px;
            color: #adadad;
            transform: translate(-10%);
            font-size: 16px;
            pointer-events: none;
            transition: .5s;
        }

        .InputBox span::before{
            content: '';
            position: absolute;
            top: 40px;
            left: 0;
            width: 100%;
            height: 2px;
            background: #1A5276;
            transition: .5s;
        }

        .InputBox input:focus ~ label,
        .InputBox input:focus ~ label{
            top: -20px;
            color: #1A5276;
        }

        .InputBox input:focus ~ span:before,
        .InputBox input:focus ~ span:before{
            width: 100%;
        }

        .link{
            margin: -5px 0 20px 5px;
            color: #2874A6; 
            cursor: pointer;
        }

        .link:hover{
            text-decoration: underline;
        }

        button[type="submit"]{
            width: 100%;
            height: 50px;
            border: 1px solid;
            background: #FF4F00;
            border-radius: 25px;
            font-size: 10px;
            margin: 2px;
            color: white;
            cursor: pointer;
            outline: none;
        }

        button[type="submit"]:hover{
            border-color: #E58729;
            transition: .5s;
        }

    </style>
</head>
<body>
    <div class="Formulario">
        <h1>Inicia Sesión</h1>
        <p>Administrador</p>
        <form method="POST" action="inicioAdministrador.php">
            <div class="InputBox">
                <input type="text" id="rut" name="rut" required>
                <label for="rut">Rut:</label>
            </div>
        
            <div class="InputBox">
                <input type="password" id="contrasena" name="contrasena" required> <!-- Agregamos el atributo 'name' para que los datos se envíen correctamente -->
                <label for="contrasena">Contraseña:</label> <!-- Corregimos el id de la etiqueta 'input' -->
            </div>
            <div class="link">
                <a href="#">¿Olvidaste la clave?</a>
            </div>
            <div class="Buttons">
                <button type="submit">Listo</button>
                <?php echo $mensaje;  ?>
            </div>
        </form>
    </div>

        <script>
        function moveLabelUp(inputId) {
            const input = document.getElementById(inputId);
            const label = input.nextElementSibling; // Get the label element next to the input
            if (input.value.trim() !== '') {
                label.style.transform = 'translate(-10%)'; // Move label up
                label.style.fontSize = '16px';
            } else {
                label.style.transform = ''; // Reset label position
                label.style.fontSize = '16px';
            }
        }
    </script>
    </div>
</body>
</html>
