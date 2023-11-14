<?php
    session_start();

    if (isset($_SESSION['Correo_Trabajador'])) {
        $correo = $_SESSION['Correo_Trabajador'];
        $Correo_Cliente = $_SESSION['Correo_Trabajador'];
        $nombre = $_SESSION['Nombre_Trabajador'];
        $contraseñaC = $_SESSION['contraseña'];
    } else {
        header("Location: iniciosesionT.php");
        exit();
    }

    $host = "localhost";
    $usuario = "root";
    $contrasena = "";
    $base_de_datos = "techome";

    $conexion = mysqli_connect($host, $usuario, $contrasena, $base_de_datos);

    if (mysqli_connect_error()) {
        die("Error de conexión a la base de datos: " . mysqli_connect_error());
    }

    $correoTrabajador = $_SESSION['Correo_Trabajador'];
    $correoTrabajador = mysqli_real_escape_string($conexion, $correoTrabajador);

    $query = "SELECT  Nombre_Trabajador, profesion, Rut_Trabajador, Correo_Trabajador FROM trabajador WHERE Correo_Trabajador = '$correoTrabajador'";
    $resultado = mysqli_query($conexion, $query);

    if ($resultado && $fila = mysqli_fetch_assoc($resultado)) {
        $nombreTrabajador = $fila['Nombre_Trabajador'];
        $profesion = $fila['profesion'];
        $rutTrabajador = $fila['Rut_Trabajador'];
        $correoTrabajador = $fila['Correo_Trabajador'];
    } else {
        die("Error: No se pudo encontrar la información del trabajador.");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TecHome® | Trabajador</title>
</head>

<style>
    .Container{
        background-color: #142850;
        border: 2px solid #2C74B3;
        text-align: center;
        margin-top: 1%;
        margin-bottom: 1%;
        margin-left: 1%;
        margin-right: 5%;
        padding: 2%;
        border-radius: 10px;
    }

    .Datos{
        background-color: #142850;
        border: 2px solid #2C74B3;
        text-align: center;
        margin-top: 1%;
        margin-bottom: 1%;
        margin-left: 1%;
        margin-right: 5%;
        padding: 2%;
        border-radius: 10px;
    }

    .Imagen {
        position: absolute;
        display: flex;
        margin-left: 5%;
    }

    .trabajador-avatar {
        border-radius: 50%;
        margin-top: 15%;
        width: 160px;
        height: 160px;
        background-color: #fff;
    }

    body{
        background-color: #27496D;
        color: #F1EFEF;
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        
    }  
    
    header{

        background-color: #142850;
        border: 2px solid #2C74B3;
        text-align: center;
        margin-top: 1%;
        margin-bottom: 1%;
        margin-left: 1%;
        margin-right: 5%;
        padding: 2%;
        border-radius: 10px;
    }

    a{

        background-color: #27496D;
        border: 2px solid #2C74B3;
        text-decoration: none;
        color: #F1EFEF;
        padding: 2%;
        border-radius: 10px;
    }


    footer{
        background-color: #142850;
        border: 2px solid #2C74B3;
        text-align: center;
        margin-top: 1%;
        margin-bottom: 1%;
        margin-left: 1%;
        margin-right: 5%;
        padding: 2%;
        border-radius: 10px;
    }

    a:hover{

        background-color: #2C74B3;
        color: #fff;
    }

    #menu {
        position: fixed;
        top: 0;
        right: -253px; 
        width: 250px;
        height: 100%;
        background-color: #142850;
        border: 2px solid #2C74B3;
        border-radius: 10px;
        margin-top: 0.5%;
        margin-bottom: 0.5%;
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
    }
    #content {
        margin-right: 250px; 
        padding: 20px;
    }
    #menu-toggle {
        position: fixed;
        top: 20px;
        right: 20px;
        cursor: pointer;
        color: #fff;
        padding: 1%;
        background-color: #142850;
        border: 2px solid #2C74B3;
        border-radius: 10px;
    }

</style>
<body>
    <header>

        <h1>Techome</h1>

        <div id="menu">
            <ul>
                <li> <a href="perfiltrabajador.php">Perfil</a></li>
                <li> <a href="ganancias.html">Ganancias</a></li>
                <li> <a href="historial_de_pedidos.html">Pedidos anteriores</a></li>
                <li> <a href="billetera.html">Billetera</a></li>
                <li> <a href="soporte.html">Soporte</a></li>
                <li> <a href="politica de privacidad.html">Politíca de Privacidad</a></li>
            </ul>
        </div>
    </header>

    <div class="trabajador-info">
        <div class="Almacenador">
            <div class="Datos">
                <h2>Datos del Trabajador</h2>
                <p>Nombre: <?php echo $nombreTrabajador; ?></p>
                <p>Profesión: <?php echo $profesion; ?></p>
                <p>RUT: <?php echo $rutTrabajador; ?></p>
            </div>
    </div>

    <div class="Container">
    <h2>Solicitudes de Servicio</h2>
    <ul>
    <?php
        $tipoServicioTrabajador = $profesion;

        $query = "SELECT * FROM solicitudservicio WHERE Rut_trabajador = '$rutTrabajador' AND ID_solicitud NOT IN (SELECT ID_solicitud FROM pedido_aceptado )";

        $result = mysqli_query($conexion, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<li>";
                echo "Cliente: " . $row['ID_cliente'] . "<br>";
                echo "Id de la Solicitud: "  . $row['ID_solicitud'] . "<br>";
                echo "Precio: "  . $row['precio'] . "<br>";
                echo '<form method="post" action="descripcion.php">';
                echo '<input type="hidden" name="solicitud_id" value="' . $row['ID_solicitud'] . '">';
                echo '<button type="submit" name="accion" value="ver_descripcion">Ver Descripción</button>';
                echo '</form>';
                echo '<form method="post" action="ProcesarSolicitud.php">';
                echo '<input type="hidden" name="solicitud_id" value="' . $row['ID_solicitud'] . '">';
                echo '<button type="submit" name="accion" value="aceptar">Aceptar</button>';
                echo '<button type="submit" name="accion" value="rechazar">Rechazar</button>';
                echo '</form>';
                echo "</li>";
            }
        } else {
            echo "No hay solicitudes de servicio para este trabajador.";
        }
        
    ?>
    </ul>
</div>



    <footer>TecHome® 2023 | Derechos reservados</footer>

    <div id="menu-toggle">&#9776;</div> 
    <script>
        const menu = document.getElementById('menu');
        const menuToggle = document.getElementById('menu-toggle');
        const perfil = document.getElementById('perfil');
        const config = document.getElementById('configuracion');
        const quienesSomos = document.getElementById('ganancias');
        const direcciones = document.getElementById('billetera');
        const soporte = document.getElementById('soporte');
        const politicadeprivacidad = document.getElementById('politica');
    
        menuToggle.addEventListener('click', () => {
            menu.classList.toggle('active');
        });
    
        perfil.addEventListener('click', () => {
            console.log('Clic en Perfil');
        });
    
        config.addEventListener('click', () => {
            console.log('Clic en Config');
        });
    
        Ganancias.addEventListener('click', () => {
            console.log('Clic en Ganancias');
        });
    
        billetera.addEventListener('click', () => {
            console.log('Clic en Billetera');
        });
    
        soporte.addEventListener('click', () => {
            console.log('Clic en soporte');
        });
    
        politica.addEventListener('click', () => {
            console.log('Clic en politica ');
        });
    
        function mostrarDescripcion(id) {
            var descripcionElement = document.getElementById('descripcion-' + id);
            if (descripcionElement.style.display === 'none') {
                descripcionElement.style.display = 'block';
            } else {
                descripcionElement.style.display = 'none';
            }
        }
    </script>
</body>
</html>