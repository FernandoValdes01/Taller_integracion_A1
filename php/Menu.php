<?php

session_start();


if (!isset($_SESSION['Correo_Cliente'])) {

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TecHome</title>
    <style>
        body {
            margin-top: -21px;
            margin-left: 0;
            margin-right: 0;
            padding: 0;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        }
        a{

            color: #fff;
            text-decoration: none;

        }
        header{

            background-color: #0d3c6e;
            margin-bottom: 10px;

        }
        footer{ 
            color: #fff;
            text-align: center;
            background-color: #0d3c6e;
            margin-bottom: -10px;

        }
        .valoracion {
            background-color: #f2f2f2;
            padding: 10px;
            border-radius: 5px;
            margin-left: 20px;
            margin-right: 20px;
            margin-bottom: 20px;
            margin-top: 10px;
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
            margin-top: 50px;
            margin-right: 250px;
            padding: 20px;
        }
        #menu-toggle {
            position: fixed;
            top: 30px;
            right: 20px;
            cursor: pointer;
            color: #fff;
        }
        #maintext{

            color: #fff;
            text-align: center;
            padding: 20px;
            margin-top: 20px;

        }

        #nextText{

            margin-top: 50px;
            text-align: center;

        }
        #elec-service{

            display: block;
            width: 200px;
            text-align: center;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            font-weight: 700;
            background-color: #0f66c3;
            border-radius: 50px;
            padding: 8px;
            margin-top: 20px;
            margin-left: 330px;

        }
        #info-service{

            display: block;
            width: 200px;
            text-align: center;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            font-weight: 700;
            background-color: #0f66c3;
            border-radius: 50px;
            padding: 8px;
            margin-top: -41px;
            margin-left: 570px;

        }
        #meca-service{

            display: block;
            width: 200px;
            text-align: center;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            font-weight: 700;
            background-color: #0f66c3;
            border-radius: 50px;
            padding: 8px;
            margin-top: -41px;
            margin-left: 810px;

        }
        #gafi-service{

            display: block;
            width: 200px;
            text-align: center;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            font-weight: 700;
            background-color: #0f66c3;
            border-radius: 50px;
            padding: 8px;
            margin-top: -41px;
            margin-left: 1050px;

        }
        #carpi-service{

            display: block;
            width: 200px;
            text-align: center;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            font-weight: 700;
            background-color: #0f66c3;
            border-radius: 50px;
            padding: 8px;
            margin-top: -41px;
            margin-left: 1290px;

        }


        </style>
</head>
<body>
    <header>
        <div id="maintext">
            <h1>
                Bievenido a TecHome
            </h1>
        </div>
        

    </header>

    <div id = nextText>
        <h2>¡Nuestros servicios!</h2>
        <h3>Categorias:</h3>
    </div>
    

    <div id="elec-service">
        <a href="MElectricista2.html">Servicio de electricidad</a>
    </div>
    <div id="info-service">
        <a href="MInformaticos2.html">Servicio de informatica</a>
    </div>
    <div id="meca-service">
        <a href="MMecanicos2.html">Servicio de mecanico</a>
    </div>
    <div id="gafi-service">
        <a href="MGasfiter2.html">Servicio de gafiteria</a>
    </div>

    <div id="carpi-service">
        <a href="Mcarpintero2.html">Servicio de carpinteria</a>
    </div>

    

    <div id="menu">
        <ul>
            <li><a href="InicioC.html">Iniciar sesion</a></li>
            <li><a href="Registro.html">Registro</a></li>
            <li><a href="Nuestrahistoria2.html">Quienes somos</a></li>
            <li><a href="soporte.html">Soporte</a></li>
            <li><a href="politica de privacidadc.html">Politica de privacidad</a></li>
        </ul>
        </div>
        <div id="content">
        <h1>Servicios Mejor Evaluados</h1>
        <p>Estos son nuestros servicios de distintas categorias mejor evaluados.</p>
        </div>
        <div class="valoracion">
            <h2>Servicio informatico 1</h2>
            <p>Servicio valorado en 5 estrellas</p>
        </div>
        <div class="valoracion">
            <h2>Servicio informatico 2</h2>
            <p>Servicio valorado en 3 estrellas</p>
        </div>
        <div class="valoracion">
            <h2>Servicio carpinteria 1</h2>
            <p>Servicio valorado en 4,5 estrellas</p>
        </div>

        <div id="menu-toggle">&#9776;</div> <!-- Ícono de tres líneas horizontales -->
        <script>
            
            const menu = document.getElementById('menu');
            const menuToggle = document.getElementById('menu-toggle');
            const Inicio = document.getElementById("Iniciar sesion");
            const config = document.getElementById('config');
            const quienesSomos = document.getElementById('quienes-somos');
        
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
            </body>
    <footer>TecHome® 2023 | Derechos reservados</footer>
</body>
</html>
<?php
    exit(); // Salir del script si el usuario no ha iniciado sesión
}

// Si el usuario ha iniciado sesión, mostrar el contenido de la página de inicio
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TecHome</title>
    <style>
        body {
            background-color: #fff;    
            margin-top: -21px;
            margin-left: 0;
            margin-right: 0;
            padding: 0;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif
        }

        a{

            color: #fff;
            text-decoration: none;

        }
        header{

            background-color: #0d3c6e;
            margin-bottom: 10px;

        }

        footer{ 

            color: #fff;
            text-align: center;
            background-color: #0d3c6e;
            margin-bottom: -10px;

        }

        .valoracion {
            background-color: #f2f2f2;
            padding: 10px;
            border-radius: 5px;
            margin-left: 20px;
            margin-right: 20px;
            margin-bottom: 20px;
            margin-top: 10px;
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
            margin-top: 50px;
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
        #maintext{

            color: #fff;
            text-align: center;
            padding: 20px;
            margin-top: 20px;

        }

        #nextText{

            margin-top: 50px;
            text-align: center;

        }

        #sesion-btn{

            display: block;
            width: 105px;
            text-align: center;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            font-weight: 700;
            background-color: #9b9b9b;
            border-radius: 50px;
            padding: 8px;
            margin: 10px;
        
        }
        #register-btn{

            display: block;
            width: 105px;
            text-align: center;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            font-weight: 700;
            background-color: #9b9b9b;
            border-radius: 50px;
            padding: 8px;
            margin-top: -51px;
            margin-left: 150px;

        }
        #empty{

            margin-top: 0px;
            color: #555;

        }
        #elec-service{

            display: block;
            width: 200px;
            text-align: center;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            font-weight: 700;
            background-color: #0f66c3;
            border-radius: 50px;
            padding: 8px;
            margin-top: 20px;
            margin-left: 330px;

        }
        #info-service{

            display: block;
            width: 200px;
            text-align: center;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            font-weight: 700;
            background-color: #0f66c3;
            border-radius: 50px;
            padding: 8px;
            margin-top: -41px;
            margin-left: 570px;

        }
        #meca-service{

            display: block;
            width: 200px;
            text-align: center;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            font-weight: 700;
            background-color: #0f66c3;
            border-radius: 50px;
            padding: 8px;
            margin-top: -41px;
            margin-left: 810px;

        }
        #gafi-service{

            display: block;
            width: 200px;
            text-align: center;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            font-weight: 700;
            background-color: #0f66c3;
            border-radius: 50px;
            padding: 8px;
            margin-top: -41px;
            margin-left: 1050px;

        }
        #carpi-service{

            display: block;
            width: 200px;
            text-align: center;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            font-weight: 700;
            background-color: #0f66c3;
            border-radius: 50px;
            padding: 8px;
            margin-top: -41px;
            margin-left: 1290px;

        }


        </style>
</head>
<body>
    <header>
        <div id="maintext">
            <h1>
                Bievenido a TecHome
            </h1>
        </div>
        


    </header>
    
    <div id ="nextText">
        <h2>¡Nuestros servicios!</h2>
        <h3>Categorias:</h3>
    
    </div>

    <div id="elec-service">
        <a href="MElectricista1.html">Servicio de electricidad</a>
    </div>
    <div id="info-service">
        <a href="MInformaticos1.html">Servicio de informatica</a>
    </div>
    <div id="meca-service">
        <a href="MMecanicos1.html">Servicio de mecanico</a>
    </div>
    <div id="gafi-service">
        <a href="MGasfiter1.html">Servicio de gafiteria</a>
    </div>

    <div id="carpi-service">
        <a href="Mcarpintero1.html">Servicio de carpinteria</a>
    </div>

    

    <div id="menu">
        <ul>
            <li id="config"> <a href="Perfilcliente.php">Configuracion de perfil</a></li>
            <li id="quienes-somos"> <a href="NuestrahistoriaC1.html">Quienes somos</a></li>
            <li id="direcciones"> <a href="Direcciones1.html">Direcciones</a></li>
            <li id="soporte"> <a href="soportec1.html">Soporte</a></li>
            <li id="politica_de_privacidadc"> <a href="politica de privacidadc1.html">Politíca de Privacidad</a></li>
            <li id="cerrar-sesion"> <a href="/cliente/cliente2/clientevisita.html">Cerrar sesion</a></li>
            <li id="Eliminar_cuenta"> <a href="eliminar_cuentaC.php"> Eliminar Cuenta</a></li>
        </ul>

        </div>
        <div id="content">
        <h1>Servicios Mejor Evaluados</h1>
        <p>Estos son nuestros servicios de distintas categorias mejor evaluados.</p>
        </div>
        <div class="valoracion">
            <h2>Servicio informatico 1</h2>
            <p>Servicio valorado en 5 estrellas</p>
        </div>
        <div class="valoracion">
            <h2>Servicio informatico 2</h2>
            <p>Servicio valorado en 3 estrellas</p>
        </div>
        <div class="valoracion">
            <h2>Servicio carpinteria 1</h2>
            <p>Servicio valorado en 4,5 estrellas</p>
        </div>

        <footer>TecHome® 2023 | Derechos reservados</footer>
        <!-- Ícono de tres líneas horizontales -->
        <div id="menu-toggle">&#9776;</div> 
        <script>
        const menu = document.getElementById('menu');
        const menuToggle = document.getElementById('menu-toggle');
        const configuracion_de_perfil = document.getElementById('config');
        const quienesSomos = document.getElementById('Nuestrahistoria2');
        const direcciones = document.getElementById('direcciones');
        const soporte = document.getElementById('soporte');
        const cerrarSesion = document.getElementById('cerrar-sesion');
        const politica_de_privacidad = document.getElementById('politica_de_privacidadc');
        const Eliminar_Cuenta = document.getElementById('EliminarcuentaC')
        
        menuToggle.addEventListener('click', () => {
            menu.classList.toggle('active'); 
        });
        
        configuracion_de_perfil.addEventListener('click', () => {
            console.log('Clic en Configuración');
        });
        
        quienesSomos.addEventListener('click', () => {
            console.log('Clic en Quienes Somos');
        });

        politica_de_privacidadc.addEventListener('click', () => {
            console.log('Clic en Politicas de Privacidad')
        });

        direcciones.addEventListener('click', ()=> {
            console.log('Clic en Direcciones')
        });

        cerrarsesion.addEventListener('click', () => {
            console.log('Click en Cerrar Sesión')
        });

        Eliminar_Cuenta.addEventListener('clic', () => {
            console.log('Clic en Eliminar Cuenta')
        });
        </script>
</body>
</html>


