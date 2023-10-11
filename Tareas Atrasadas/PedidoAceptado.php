<?php
include("db.php");

if($_POST){
    print_r($_POST);

    $nombre_pedido=(isset($_POST["nombre_pedido"])?$_POST["nombre_pedido"]:"");
    $precio=(isset($_POST["precio"])?$_POST["precio"]:"");
    $fecha=(isset($_POST["fecha"])?$_POST["fecha"]:"");

    $sentencia=$conexion->prepare("INSERT INTO 
    pedido aceptado(ID_pedido, nombre_pedido, precio, fecha, ID_solicitud, Rut_Trabajador) 
    VALUES (NULL, :nombre_pedido, :precio, :fecha, NULL, NULL;");

     $sentencia->bindParam(":nombre_pedido",$tipo_servicio);
     $sentencia->bindParam(":precio",$descripcion);
     $sentencia->bindParam(":fecha",$descripcion);
     $sentencia->execute();
}

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
    background-color: #fff  ;
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

    color: #fff;
    text-decoration: none;

}

footer{ 

    color: #fff;
    text-align: center;
    background-color: #0d3c6e;
    margin-bottom: -10px;
    margin-top: 437px;

}

.solicitud-info {
    background-color: #f2f2f2;
    padding: 20px;
    margin-top: 100px;
    margin-bottom: 20px;
    margin-left: 50px;
    margin-right: 50px;
    border-radius: 5px;
}

.usuario-nombre {
    font-size: 24px;
    margin-bottom: 10px;
}

.problema-detalle {
    font-size: 16px;
    margin-bottom: 20px;
}

.direccion {
    font-size: 16px;
}

.boton-aceptar {
    margin-top: 20px;
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

    </style>
</head>
<body>
    <header>
        <h1>Detalle de Solicitud</h1>
    </header>
    <form action="#" method="post" enctype="multipart/form-data">
        <div class="solicitud-info">
            <div class="usuario-nombre">Nombre del Usuario</div>
            <div class="problema-detalle">Detalle del Problema:</div>
            <p> Aenean quis commodo turpis. Quisque eget ante lorem. 
            Interdum et malesuada fames ac ante ipsum primis in faucibus. 
            Ut iaculis pretium tellus, molestie commodo nisl dapibus eu. Integer arcu tortor, 
            malesuada non nisl ullamcorper, ultrices viverra nibh. Nulla iaculis magna et odio aliquam vulputate. 
            Proin lacinia felis eget mi faucibus pretium. </p>
            <div class="direccion">Dirección: #123, ===== </div><br><br>
            <label for="nombre_pedido">Nombre del Pedido:</label>
            <input type="text" id="nombre_pedido" name="nombre_pedido" required><br><br>
    
            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" required><br><br>
    
            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha" required><br><br>
    
            <button type="submit">Aceptar Trabajo</button>
        </div>
    </form>
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
