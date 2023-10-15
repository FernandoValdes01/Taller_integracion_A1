<?php
include("db.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de Ayuda</title>
    <link rel="stylesheet" href=""> 

    <style>

body {
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            background-color: #27496D;
            color: #F1EFEF;
        }

        header {
            background-color: #142850;
            border: 2px solid #2C74B3;
            text-align: left;
            margin-top: 1%;
            margin-bottom: 1%;
            margin-left: 1%;
            margin-right: 7%;
            padding: 3%;
            border-radius: 10px;
        }

        footer{ 
            background-color: #142850;
            border: 2px solid #2C74B3;
            text-align: center;
            margin: 1%;
            padding: 2%;
            border-radius: 10px;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        }

        a{
            color: #fff;
            text-decoration: none;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        button {
            background-color: #27496D;
            border: 2px solid #2C74B3;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #2C74B3;
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
            background-color: #142850;
            border: 2px solid #2C74B3;
            padding: 20px;
            margin-top: 3%;
            margin-bottom: 3%;
            margin-left: 10%;
            margin-right: 10%;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .trabajo {
            background-color: #f2f2f2;
            padding: 10px;
            border-radius: 5px;
        }

        .trabajador {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #0A2647;
            border: 3px solid #144272;
            padding: 20px;
            text-align: center;
            border-radius: 5px;
        }

        #menu {
            position: fixed;
            top: 0;
            right: -303px; 
            width: 300px;
            height: 100%;
            background-color: #142850;
            border: 2px solid #2C74B3;
            border-radius: 10px;
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
            margin-top: 1%;
            margin-right: 1%;
            background-color: #142850;
            border: 2px solid #2C74B3;
            border-radius: 10px;
        }

    </style>
</head>
<body>
    <header>
        <h1>Detalle de Ayuda</h1>
    </header>
    <div class="Form">
        <div class="solicitud-info">
        <h2>Detalle del Pedido</h2>
        <?php
        if (isset($_GET['ID_solicitud'])) {
            // Obtén el valor de ID_solicitud desde la URL
            $idSolicitud = $_GET['ID_solicitud'];

            // Realiza una consulta para obtener los detalles de la solicitud
            $consulta = $conexion->prepare("SELECT 
                solicitudservicio.*, clientes.nombre_Cliente, direccion.direccion, direccion.indicaciones,
                direccion.Ciudad, direccion.region FROM solicitudservicio
                JOIN clientes ON solicitudservicio.Correo_Cliente = clientes.Correo_Cliente
                JOIN direccion ON clientes.id_direccion = direccion.ID_direccion
                WHERE solicitudservicio.ID_solicitud = :ID_solicitud");

            $consulta->bindParam(':ID_solicitud', $idSolicitud);
            $consulta->execute();

            if ($solicitud = $consulta->fetch(PDO::FETCH_ASSOC)) {

                echo '<div class="usuario-nombre">Nombre del Usuario: ' . htmlspecialchars($solicitud['nombre_Cliente']) . '</div>';
                echo '<br>';
                echo '<div class="correo-cliente">Correo del Cliente: ' . $solicitud['Correo_Cliente'] . '</div>';
                echo '<br>';
                echo '<div class="direccion">Dirección: ' . htmlspecialchars($solicitud['direccion']) . '</div>';
                echo '<br>';
                echo '<div class="indicaciones">Indicaciones: ' . htmlspecialchars($solicitud['indicaciones']) . '</div>';
                echo '<br>';
                echo '<div class="Ciudad">Ciudad: ' . htmlspecialchars($solicitud['Ciudad']) . '</div>';
                echo '<br>';
                echo '<div class="region">Región: ' . htmlspecialchars($solicitud['region']) . '</div>';
                echo '<br>';
                echo '<div class="problema-detalle">Detalle del Problema:<br>' . htmlspecialchars($solicitud['descripcion']) . '</div>';

            } else {
                echo '<p>No se encontró la solicitud solicitada.</p>';
            }
        } else {
            echo '<p>Parámetro ID_solicitud no proporcionado.</p>';
        }



        ?>  
            <br>
            <!-- header("Location: TrabajosDisponibles.php"); -->
                <button type="submit">Aceptar Trabajo</button>
        </div>
    </div>    
    <footer>TecHome® 2023 | Derechos reservados</footer>

<div id="menu">
<ul>
    <li> <a href="MaqPerfilTrabajador.html">Perfil</a></li>
    <li> <a href="ganancias.html">Ganancias</li>
    <li> <a href="historial_de_pedidos.html">Pedidos  anteriores</a></li>
    <li> <a href="billetera.html">Billetera</a></li>
    <li> <a href="soporte.html">Soporte</a></li>
    <li> <a href="politica de privacidad.html">Politíca de Privacidad</a></li>
    <li><a href="EliminarCuentaT.html">Eliminar cuenta</a></li>
    <li> <a href="InicioT.html">Cerrar sesion</a></li>


</ul>
</div>

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
