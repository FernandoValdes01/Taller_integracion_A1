<?php
include("db.php")
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home de Trabajador</title>
    <style>
body {
    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
    background-color: #0d3c6e;
    margin: 0;
    padding: 0;
    }

header {
    background-color: #0d3c6e;
    color: #fff;
    text-align: center;
    margin-top: -1px;
    padding: 20px;
}    

a{

color: black;
text-decoration: none;

}

h1 {
    margin: 0;
}

footer{ 

    color: #fff;
    text-align: center;
    background-color: #0d3c6e;
    margin-bottom: -10px;
    margin-top: 437px;

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
    color: #fff;
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
}

.trabajo {
    background-color: #f2f2f2;
    padding: 10px;
    border-radius: 5px;
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
        margin-right: 250px; 
        padding: 20px;
    }
    #menu-toggle {
        position: fixed;
        top: 20px;
        right: 20px;
        cursor: pointer;
        color: #fff;
    }
    #menu a{
        color: #fff;

    }
    

    </style>
</head>
<body>
    <div class="trabajador-info">
        <div class="trabajador-avatar"></div>
        <div class="trabajador-nombre">Trabajador Conectado</div>
    </div>
    <div class="trabajos-disponibles">
        <h2>Trabajos Disponibles</h2>
        <ul>
        <?php
            // Consulta para obtener las solicitudes desde la base de datos
            $consulta = $conexion->query("SELECT * FROM solicitudservicio");

            while ($solicitud = $consulta->fetch(PDO::FETCH_ASSOC)) {
                echo '<li>';
                echo '<div class="trabajo">';
                echo '<h3>' . htmlspecialchars($solicitud['tipo_servicio']) . '</h3>';
                echo '<p>' . htmlspecialchars($solicitud['descripcion']) . '</p>';
                echo '<a href="PedidoAceptado.php? id=' . $solicitud['ID_solicitud'] . '">Ver Solicitud</a>';
                echo '</div>';
                echo '</li>';
                
            }
            ?>
        </ul>
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
