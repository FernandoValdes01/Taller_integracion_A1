<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Slide Trabajador</title>
</head>

<style>
a{
    color: #fff;
    text-decoration: none;
    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
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
    margin-top: 7%;
    margin-left: 2%;
    padding: 2%;
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

<body>

<div id="menu">
    <ul>
        <li></li>
        <li> <a href="perfilTrabajador.html">Perfil</a></li>
        <li> <a href="ganancias.html">Ganancias</a></li>
        <li> <a href="historial_de_pedidos.html">Pedidos anteriores</a></li>
        <li> <a href="billetera.html">Billetera</a></li>
        <li> <a href="soporte.html">Soporte</a></li>
        <li> <a href="politica de privacidad.html">Politíca de Privacidad</a></li>
        <li><a href="EliminarCuentaCActualizado.html">Eliminar cuenta</a></li>
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