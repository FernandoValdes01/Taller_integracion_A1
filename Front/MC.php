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
    $Correo_Cliente = $_SESSION['Correo_Cliente'];
    $nombre = $_SESSION['nombre_Cliente'];
    $contraseñaC = $_SESSION['contraseña'];

    $sql = "SELECT Nombre_cliente, Correo_Cliente, Contraseña FROM clientes WHERE Correo_Cliente = '$correo'";
    $result = $conexion->query($sql);

    $_SESSION['Correo_Cliente'] = $correo;
    $_SESSION['nombre_Cliente'] = $nombre;
    $_SESSION['contraseña'] = $contraseñaC;


    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (isset($_POST["nombre"]) && isset($_POST["email"]) && isset($_POST["contrasena"])) {
            $nuevo_nombre = $_POST["nombre"];
            $nuevo_email = $_POST["email"];
            $nueva_contraseña = $_POST["contrasena"];

            $sql = "UPDATE clientes SET nombre_cliente='$nuevo_nombre', Correo_Cliente='$nuevo_email', Contraseña='$nueva_contraseña' WHERE Correo_Cliente='$correo'";

            if ($conexion->query($sql) === TRUE) {
                $_SESSION['nombre_Cliente'] = $nuevo_nombre;
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <title>TecHome® | Carpinteros</title>

    <style>
        body{
            text-shadow: 2px 0 0 #000, -2px 0 0 #000, 0 2px 0 #000, 0 -2px 0 #000, 1px 1px #000, -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000;
            background: url(background-body.png);
            background-color: #FAFAFA;
            color: #F1EFEF;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        }  

        header {
            text-shadow: 2px 0 0 #000, -2px 0 0 #000, 0 2px 0 #000, 0 -2px 0 #000, 1px 1px #000, -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000;
            background: url(background.png);
            background-color: #142850;
            border: 2px solid #2C74B3;
            text-align: left;
            margin-top: 1%;
            margin-bottom: 1%;
            margin-left: 1%;
            margin-right: 7%;
            padding-top: 2%;
            padding-bottom: 2%;
            padding-left: 3%;
            padding-right: 1%;
            border-radius: 10px;
        }

        h1 {
            margin: 0;
        }

        .Trabajador{
            background: url(background2.png);
            color: white;
            background-color: #142850;
            text-align: center;
            margin-top: 1%;
            margin-bottom: 1%;
            margin-left: 1%;
            margin-right: 5%;
            padding: 2%;
            border-radius: 10px;
        }

        #menu a{
            color: #fff;
            text-decoration: none;
        }

        .trabajos-disponibles {
            background: url(big-background.png);
            background-color: #142850;
            text-align: center;
            margin-top: 5%;
            margin-bottom: 1%;
            margin-left: 1%;
            margin-right: 6%;
            padding: 2%;
            border-radius: 10px;
        }

        .trabajos-disponibles ul {
            list-style-type: none;
            padding: 0;
            display: flex;
            flex-wrap: wrap;
        }

        .trabajos-disponibles li {
            flex: 1;
            padding: 20px;
            text-align: center;
            border-radius: 5px;
        }

        p {
            margin: 5px 0;
        }

        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .SolicitarServicio{
            text-decoration: none;
            background-color: #142850;
            color: white;
            border: 2px solid #2C74B3;
            text-align: center;
            margin: 1%;
            padding: 2%;
            border-radius: 10px;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        }

        .SolicitarServicio:hover{
            background-color: #2C74B3;
            color: #fff;
        }

        footer{
            text-shadow: 2px 0 0 #000, -2px 0 0 #000, 0 2px 0 #000, 0 -2px 0 #000, 1px 1px #000, -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000;
            background: url(background.png);
            background-color: #142850;
            text-align: center;
            margin-top: 7%;
            margin-bottom: 1%;
            margin-left: 1%;
            margin-right: 1%;
            padding: 2%;
            border-radius: 10px;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        }

        .footer-info{
            display: flex;
            margin-top: 1%;
            margin-bottom: 7%;
        }

        .contactanos{
            font-size: large;
            position: absolute;
            margin-left: 27%;
        }

        .ubicacion{
            font-size: large;
            position: absolute;
            margin-left: 43.5%;
        }

        .informacion{
            font-size: large;
            position: absolute;
            margin-left: 57%;
        }

        .bottom-footer-text{
            display: flex;
            justify-content: center;
            background: url(background2.png);
            border-radius: 5px;
            padding: 1%;
        }

        #menu {
            text-shadow: 2px 0 0 #000, -2px 0 0 #000, 0 2px 0 #000, 0 -2px 0 #000, 1px 1px #000, -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000;
            background: url(background.png);
            position: fixed;
            font-size: large;
            top: 0;
            right: -305px; 
            width: 300px;
            height: 100%;
            border-left: 2px solid #142850;
            color: #fff;
            transition: right 0.3s;
            z-index: 11;
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
        }
        
        #content {
            padding: 20px;
            text-align: center;
            margin-top: 10px;
            margin-bottom: 10px;
        }
        
        #menu-toggle {
            text-shadow: 2px 0 0 #000, -2px 0 0 #000, 0 2px 0 #000, 0 -2px 0 #000, 1px 1px #000, -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000;
            background: url(background.png);
            border: 2px solid #2C74B3;
            position: fixed;
            top: 20px;
            right: 20px;
            cursor: pointer;
            color: #fff;
            padding: 1%;
            margin-top: 1%;
            margin-right: 1%;
            border-radius: 10px;
            z-index: 12;
        }

        #menu-toggle{
            transition: all .7s ease;
        }

        #menu-toggle:hover{
            transform: rotate(180deg);
        }



    </style>
</head>
<body>
    <header>
        <h1>Servicio de Carpinteria | Disponible</h1>
    </header>

    <div id="menu">
        <ul>
            <li></li>
            <li><a href="clienteiniciado.html">Inicio</a></li>
            <li> <a href="configuracion de cliente.html">Perfil</a></li>
            <li> <a href="NuestrahistoriaC1.html">Quienes somos</li>
            <li> <a href="Direcciones1.html">Direcciones</a></li>
            <li> <a href="soportec1.html">Soporte</a></li>
            <li> <a href="politica de privacidadc1.html">Politíca de Privacidad</a></li>
            <li> <a href="/HTML/Cliente_visita/clientevisita.html">Cerrar sesion</a></li>
    
        </ul>
    </div>

    <div class="trabajos-disponibles">
        <h2>Carpinteros Disponibles</h2>
        <ul>
        <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "techome";

            $conn = new mysqli($servername, $username, $password, $database);

            if ($conn->connect_error) {
                die("Error de conexión: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM trabajador WHERE Profesion = 'carpintero'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<li>";
                    echo "<div class='Trabajador'>";
                    echo "<h3>Nombre: " . $row["Nombre_Trabajador"] . "</h3><br>";
                    echo "<p>Rut: " . $row["Rut_trabajador"] . "</p><br>";
                    echo "<a href='Solicitarservicio.php?Rut_Trabajador=" . $row["Rut_trabajador"] . "'>Enviar solicitud de servicio</a>";
                    echo "<p>Correo: " . $row["Correo_Trabajador"] . "</p><br>";
                    echo "<a class='SolicitarServicio' href='SolicitudServicio.php?tipo_servicio=carpintero&Correo_Cliente={$Correo_Cliente}'>Solicitar Servicio</a>";
                    echo "</div>";
                    echo "</li>";
                }
            } else {
                echo "No se encontraron trabajadores con la profesión 'Carpinteria'.";
            }

            $conn->close();
        ?>
        </ul>
    </div>

    <div id="menu-toggle"><i class="fas fa-list-ul" style="color: #fafafa;"></i></div> 
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('.SolicitarServicio');
            buttons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const rutTrabajador = button.getAttribute('data-rut');
                    window.location.href = `SolicitudServicio.php?Rut_Trabajador=${rutTrabajador}`;
                });
            });
        });

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
    <footer>
        <div class = "footer-info">
            <div class = "contactanos"><i class="fas fa-mobile-alt" style="color: #fafafa;"></i> Contactanos: <br>+56 9 89348303</div>
            <div class = "ubicacion"><i class="fas fa-map-marker-alt" style="color: #fafafa;"></i> Direccion: <br>Temuco, Chile</div>
            <div class = "informacion"><i class="fas fa-info-circle" style="color: #fafafa;"></i> Techome: <br>Servicio facil para la gente</div>
        </div>
        <div class = "bottom-footer-text">TecHome® 2023 | Derechos reservados</div>
    </footer>
</body>
</html>