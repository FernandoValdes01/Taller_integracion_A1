<?php
    session_start();

    if (!isset($_SESSION['Correo_Cliente'])) {
        header("Location: inicioclientes.php");
        exit();
    }

    $server = "localhost";
    $usuario = "root";
    $contrasena = "";
    $basededatos = "techome";

    $conexion = new mysqli($server, $usuario, $contrasena, $basededatos);

    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    $correo = $_SESSION['Correo_Cliente'];
    $nombre = $_SESSION['nombre_Cliente'];
    $contraseñaC = $_SESSION['contraseña'];

    $sql = "SELECT Nombre_cliente, Correo_Cliente, Contraseña FROM clientes WHERE Correo_Cliente = '$correo'";
    $result = $conexion->query($sql);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (isset($_POST["nombre"]) && isset($_POST["email"]) && isset($_POST["contrasena"])) {
            $nuevo_nombre = $_POST["nombre"];
            $nuevo_email = $_POST["email"];
            $nueva_contraseña = $_POST["contrasena"];

            // Actualizar el perfil en la base de datos
            $sql = "UPDATE clientes SET nombre_cliente='$nuevo_nombre', Correo_Cliente='$nuevo_email', Contraseña='$nueva_contraseña' WHERE Correo_Cliente='$correo'";

            if ($conexion->query($sql) === TRUE) {
                $_SESSION['Nombre_cliente'] = $nuevo_nombre;
                $_SESSION['Correo_Cliente'] = $nuevo_email;
                $_SESSION['contraseña'] = $nueva_contraseña;
                echo "Perfil actualizado con éxito.";
            } else {
                echo "Error al actualizar el perfil: " . $conexion->error;
            }
        } else {
            echo "Error: Alguno de los campos del formulario no se envió correctamente.";
        }
    }

    $conexion->close();
    ?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración del Cliente - TecHome</title>
    <style>
        body {
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }
        header {
            color: #fff;
            background-color: #0d3c6e;
            text-align: center;
            padding: 41px;
        }
        footer{

            color: #fff;
            text-align: center;
            background-color: #0d3c6e;
            margin-top: 65px;
            margin-bottom: -10px;

        }

        a{

            text-decoration: none;
            color: #fff;

        }

        .container {
            max-width: 960px;
            margin: 20px auto;
            padding: 20px;
        }
        .profile-section {
            margin-top: 30px;
        }
        .profile-section h2 {
            margin-bottom: 10px;
        }
        .profile-section label {
            display: block;
            margin-bottom: 10px;
        }
        .profile-section input[type="text"],
        .profile-section input[type="password"],
        .profile-section input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 3px;
        }
        .profile-section button {
            float: right;
            padding: 10px 20px;
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
            width: 100px;
            height: 100px;
            background-color: #fff;
            display: inline-block;
        }
        .trabajador-nombre {
            font-size: 24px;
            margin-top: 10px;
        }
        .trabajos-disponibles {
            background-color: #fff;
            padding: 20px;
            margin: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin: 10px 0;
            list-style-type: none;
            padding: 0;
        }
        .trabajo {
            background-color: #f2f2f2;
            padding: 10px;
            border-radius: 5px;
        }
        #changeinf{

            margin-bottom: 20px;

        }
        #passtext{

            margin-top: 20px;
            padding-top: 50px;

        }

        #menu {
            position: fixed;
            top: 0;
            right: -250px; 
            width: 250px;
            height: 100%;
            background-color: #0f66c3;
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
            text-align: center;
            cursor: pointer;
            border-bottom: 1px solid #0f66c3;
        }
        
        #content {
            padding: 20px;
            text-align: center;
            margin-top: 10px;
            margin-bottom: 10px;
        }
        
        #menu-toggle {
            position: fixed;
            top: 20px;
            right: 20px;
            cursor: pointer;
            color: #fff;
        }
    </style>
</head>
        <div class="profile-section">
<body>
    <header>
        <h1>Configuración del Cliente - TecHome</h1>
    </header>
    <div class="container">
        <div class="profile-section">
            <h2>Tu Perfil</h2>
            <div class="container">
                <div class="trabajo">
                    <h3></h3>
                    <label for="nombre">Nombre:</label>
                    <span id="nombre-actual"><?php echo $nombre; ?></span>
                    <br>
                    <label for="email">Correo Electrónico (Gmail):</label>
                    <span id="email-actual"><?php echo $correo; ?></span>
                </div>
            </div>
            <div id="changeinf">
                <button type="button" id="cambiar-informacion">Cambiar Información</button>
            </div>
            <div id="passtext">
                <h2>Cambiar Contraseña</h2>
            </div>
            <label for="old-password">Antigua Contraseña:</label>
            <input type="password" id="old-password" name="old-password" required>
            <label for="new-password">Nueva Contraseña:</label>
            <input type="password" id="new-password" name="new-password" required>
            <label for="confirm-password">Confirmar Contraseña:</label>
            <input type="password" id="confirm-password" name="confirm-password" required>
            <p id="password-error" style="color: red;"></p>
            <button type="button" id="cambiar-contraseña">Cambiar Contraseña</button>
        </div>
    </div>
    </div>

    <div id="menu">
        <ul>
            <li><a href="clienteiniciado.html">Inicio</a></li>
            <li> <a href="configuracion de cliente.html">Configuracion</a></li>
            <li> <a href="NuestrahistoriaC1.html">Quienes somos</li>
            <li> <a href="Direcciones1.html">Direcciones</a></li>
            <li> <a href="soportec1.html">Soporte</a></li>
            <li> <a href="politica de privacidadc1.html">Política de Privacidad</a></li>
            <li> <a href="/Cliente/cliente2/clientevisita.html">Cerrar sesión</a></li>
        </ul>
    </div>

    <footer>TecHome® 2023 | Derechos reservados</footer>

    <div id="menu-toggle">&#9776;</div> <!-- Ícono de tres líneas horizontales -->

    <script>
            const menu = document.getElementById('menu');
    const menuToggle = document.getElementById('menu-toggle');
    const perfil = document.getElementById('perfil');
    const config = document.getElementById('config');
    const quienesSomos = document.getElementById('quienes-somos');
    const direcciones = document.getElementById('direcciones');
    
    menuToggle.addEventListener('click', () => {
        menu.classList.toggle('active'); 
    });

    perfil.addEventListener('click', () => {
        console.log('Clic en Perfil');
    });

    config.addEventListener('click', () => {
        console.log('Clic en Config');
    });

    quienesSomos.addEventListener('click', () => {
        console.log('Clic en Quienes Somos');
    });
    </script>

    <script>
                document.getElementById('cambiar-informacion').addEventListener('click', function() {
            alert('Esta opción no está disponible todavía');
        });

        document.getElementById('cambiar-contraseña').addEventListener('click', function() {
            const newPassword = document.getElementById('new-password').value;
            const confirmPassword = document.getElementById('confirm-password').value;

            if (newPassword !== confirmPassword) {
                document.getElementById('password-error').textContent = "Las contraseñas no coinciden.";
            } else {
                document.getElementById('password-error').textContent = "";
                alert('Contraseña cambiada con éxito');
            }
        });
    </script>


</body>
</html>
