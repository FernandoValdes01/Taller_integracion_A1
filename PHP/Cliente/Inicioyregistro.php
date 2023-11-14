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
    $sql = "SELECT ID_cliente,Correo_Cliente, contraseña, nombre_Cliente FROM clientes WHERE Correo_Cliente = '$correo'";
    $result = $conexion->query($sql);

    if ($result === false) {
        die("Error en la consulta SQL: " . $conexion->error);
    }

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $contrasena_db = $row['contraseña'];
        $nombre = $row["nombre_Cliente"];
        $ID_cliente = $row["ID_cliente"];
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

<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "techome";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("La conexión falló: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['correo'];
    $nombre = $_POST['nombre'];
    $contrasena = $_POST['contrasena'];

    $sql = "INSERT INTO clientes (Correo_Cliente, nombre_Cliente, contraseña) VALUES ('$correo', '$nombre', '$contrasena')";

    if ($conn->query($sql) === TRUE) {
        echo "Datos insertados correctamente";
    } else {
        echo "Error al insertar datos: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TecHome</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Verdana', 'Monaco', sans-serif;
            background: linear-gradient(150deg, #1A5276, #6C3EE2);
            height: 100vh;
            overflow: hidden;
        }
        
        .contenedor-form {
            background: rgba(255, 255, 255, .7);
            max-width: 500px;
            width: 100%;
            margin: 48px auto;
            border-radius: 10px;
            color: #1A5276;
            position: relative;
        }

        .contenedor-form .toggle {
            position: absolute;
            top: 7px;
            right: 7px;
            width: 100px;
            height: 30px;
            font-size: 12px;
            line-height: 25px;
            text-align: center;
            border-top: 2px solid #1A5276;
            border-bottom: 2px solid #1A5276;
            cursor: pointer;
            transition: all .5s ease;
        }

        .contenedor-form .toggle:hover {
            border-top: 2px solid #6C3EE2;
            border-bottom: 2px solid #6C3EE2;
        }

        .contenedor-form .toggle span {
            letter-spacing: 1px;
        }

        .contenedor-form h2 {
            margin: 0 0 28px 0;
            font-size: 20px;
            font-weight: 400;
            line-height: 1;
        }

        .contenedor-form input[type="text"],
        .contenedor-form input[type="password"],
        .contenedor-form input[type="email"] {
            outline: none;
            display: block;
            width: 100%;
            padding: 10px 15px;
            margin: 0 0 20px 0;
            background: white;
            color: #1A5276;
            border: none;
            border-radius: 2px;
            border-bottom: 4px solid #1A5276;
            box-sizing: border-box;
            font-family: 'Verdana', 'Monaco', sans-serif;
            font-size: 16px;
            font-weight: normal;
            transition: all .5s ease;
        }

        .contenedor-form input[type="text"]:focus,
        .contenedor-form input[type="password"]:focus,
        .contenedor-form input[type="email"]:focus {
            border-bottom: 4px solid #6C3EE2;
        }

        .contenedor-form input[type="submit"] {
            background: #1A5276;
            color: #fff;
            width: 100%;
            border: none;
            padding: 10px 0;
            font-size: 16px;
            font-weight: normal;
            font-family: 'Verdana', 'Monaco', sans-serif;
            letter-spacing: 1px;
            cursor: pointer;
            transition: all .5s ease;
        }

        .contenedor-form input[type="submit"]:hover {
            background: rgba(26, 82, 118, 0.7);
        }

        .contenedor-form .reset-password {
            background: #276A8C;
            width: 100%;
            padding: 15px 0;
            text-align: center;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        .contenedor-form .reset-password a {
            color: #fff;
            text-decoration: none;
            font-size: 16px;
        }

        .contenedor-form .formulario {
            display: none;
            padding: 40px;
        }

        .contenedor-form .formulario:nth-child(2) {
            display: block;
        }

        button[type="submit"]{
            width: 100%;
            height: 50px;
            border: 1px solid;
            background: #1A5276;
            border-radius: 25px;
            font-size: 10px;
            margin: 2px;
            color: white;
            cursor: pointer;
            outline: none;
        }

        button[type="submit"]:hover{
            border-color: #1A5276;
            transition: .5s;
        }

        
    </style>
</head>
<body>
<div class="contenedor-form">
        <div class="toggle" id="toggleButton" onclick="toggleButtonText(); changeBodyStyle(); CambiarColor(); CambiarColorDiv();">
            <span id="toggleText">Crear Cuenta</span>
        </div>
        
        <div class="formulario">
        <h1>Inicia Sesión</h1>
        <form method="POST" action="inicioyregistro.php"> <!-- Reemplaza 'nombre_de_esta_pagina.php' con el nombre de tu archivo PHP -->
            <div class="InputBox">
                <label for="correo">Correo electrónico:</label>
                <input type="email" id="correo" name="correo" required> <!-- Agregamos el atributo 'name' para que los datos se envíen correctamente -->
            </div>
            <div class="InputBox">
                <label for="contrasena">Contraseña:</label> <!-- Corregimos el id de la etiqueta 'input' -->
                <input type="password" id="contrasena" name="contrasena" required> <!-- Agregamos el atributo 'name' para que los datos se envíen correctamente -->
            </div>
            <div class="Buttons">
                <button type="submit">Listo</button>
                <?php echo $mensaje;  ?>
            </div>
        </form>
    </div>
        
        <div class="formulario">
            <h1>Registrar</h1>
            <form id="registro-form" method="POST" action="inicioyregistro.php">
                <div class="Box">
                    <label for="correo">Correo electrónico:</label>
                    <input type="email" id="correo" name="correo" required>
                </div>
                
                <div class="Box">
                    <label for="nombre">Nombre Completo:</label>
                    <input type="text" id="nombrecompleto" name="nombre" required>
                </div>

                <div class="Box">
                    <label for="contrasena">Contraseña:</label>
                    <input type="password" id="contrasena" name="contrasena" required>
                </div>
                
                <div class="Box">
                    <label for="confirmar-contrasena">Confirmar Contraseña:</label>
                    <input type="password" id="confirmar-contrasena" required>
                </div>

                <div class="Buttons">
                    <button type="submit" id="submitButton" onclick="validarFormulario()">Listo</button>
                </div>
            </form>
        </div>
        <div class="reset-password">
            <a href="#">¿Olvidaste tu contraseña?</a>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        document.getElementById('registro-form').addEventListener('submit', function(event) {
                event.preventDefault(); 
                window.location.href = 'Home.html';
            });

        function validarFormulario() {
        var contrasena = document.getElementById("contrasena").value;
        var confirmarContrasena = document.getElementById("confirmar-contrasena").value;

        if (contrasena !== confirmarContrasena) {
            alert("Las contraseñas no son iguales");
            return false;
        }
        return true;
    }

        $('.toggle').click(function(){
            $('.formulario').animate({
                height: "toggle",
                'padding-top': 'toggle',
                'padding-bottom': 'toggle',
                opacity: 'toggle'
            }, "slow");
            
            $('body').toggleClass('login-body');
        });

        function toggleButtonText() {
            var toggleText = document.getElementById("toggleText");

            if (toggleText.innerText === "Crear Cuenta") {
                toggleText.innerText = "Iniciar Sesión";
            } else {
                toggleText.innerText = "Crear Cuenta";
            }
        }

        function changeBodyStyle() {
            var body = document.body;

            if ($('#toggleText').text() === "Crear Cuenta") {
                body.style.background = "linear-gradient(150deg, #1A5276, #6C3EE2)";
            } else {
                body.style.background = "linear-gradient(150deg, #009688, #66BB6A)";
            }
        }
        
        function CambiarColor() {
        var button = document.getElementById('submitButton');

        if ($('#toggleText').text() === "Crear Cuenta") {
            button.style.backgroundColor = '#1A5276';
        } else {
            button.style.backgroundColor = '#009688';
        }
    }

    function CambiarColorDiv() {
        var a = document.querySelector('.reset-password');
        var toggleText = document.getElementById('toggleText').innerText.trim();

        if (toggleText === "Crear Cuenta") {
            a.style.backgroundColor = '#276A8C';
        } else {
            a.style.backgroundColor = '#35AD62';
        }
    }

    </script>
</body>
</html>
