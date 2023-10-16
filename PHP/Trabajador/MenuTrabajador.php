<?php

session_start();

if (!isset($_SESSION['Correo_Trabajador'])) {
    header("Location: iniciosesionT.php");
    exit;
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

$query = "SELECT foto, Nombre_Trabajador, profesion, Rut_Trabajador FROM trabajador WHERE Correo_Trabajador = '$correoTrabajador'";
$resultado = mysqli_query($conexion, $query);

if ($resultado && $fila = mysqli_fetch_assoc($resultado)) {
    $foto = $fila['foto'];
    $nombreTrabajador = $fila['Nombre_Trabajador'];
    $profesion = $fila['profesion'];
    $rutTrabajador = $fila['Rut_Trabajador'];
} else {
    die("Error: No se pudo encontrar la información del trabajador.");
}

mysqli_close($conexion);
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
                <li> <a href="MaqPerfilTrabajador.html">Perfil</a></li>
                <li> <a href="ganancias.html">Ganancias</a></li>
                <li> <a href="historial_de_pedidos.html">Pedidos anteriores</a></li>
                <li> <a href="billetera.html">Billetera</a></li>
                <li> <a href="soporte.html">Soporte</a></li>
                <li> <a href="politica de privacidad.html">Politíca de Privacidad</a></li>
                <li><a href="EliminarCuentaT.html">Eliminar cuenta</a></li>
                <li> <a href="InicioT.html">Cerrar sesion</a></li>
            </ul>
        </div>
    </header>

    <div class="Imagen">
            <img src="<?php echo $foto; ?>" alt="Foto del Trabajador" class="trabajador-avatar">
        </div>
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
        const cerrarsesion = document.getElementById('cerrarsesion');
    
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
    
        cerrarsesion.addEventListener('click', () => {
            console.log('Clic en cerrarcesion ');
        });
    </script>
</body>
</html>