<?php

session_start();


if (!isset($_SESSION['Correo_Trabajador'])){
?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TecHome® | Trabajador</title>
</head>

<style>

    body{

        background-color: #27496D;
        color: #F1EFEF;
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        
    
    }  
    
    header{

        background-color: #142850;
        border: 2px solid #2C74B3;
        text-align: center;
        margin: 1%;
        padding: 2%;
        border-radius: 10px;

    }

    a{

        background-color: #27496D;
        border: 2px solid #2C74B3;
        text-decoration: none;
        color: #F1EFEF;
        padding: 0.5%;
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

    a:hover{

        background-color: #2C74B3;
        color: #fff;
    }

    .metodo1{

        margin-top: 3%;
        margin-bottom: 3%;
        margin-left: 3%;
        margin-right: 50%;
        padding: 1%;
        text-align: left;
        background-color: #142850;
        border: 2px solid #2C74B3;
        border-radius: 10px;
    }

    .metodo2{

        margin-top: 3%;
        margin-bottom: 3%;
        margin-left: 50%;
        margin-right: 3%;
        padding: 1%;
        text-align: right;
        background-color: #142850;
        border: 2px solid #2C74B3;
        border-radius: 10px;
    }

    .metodo3{

        margin-top: 3%;
        margin-bottom: 3%;
        margin-left: 3%;
        margin-right: 50%;
        padding: 1%;
        text-align: left;
        background-color: #142850;
        border: 2px solid #2C74B3;
        border-radius: 10px;
    }

    .img1{

        margin-right: 5%;
        position: absolute;
        left: 49%;
        top: 7%;
        z-index: 2;
        transform: scale(0.5);
    }

    .img2{

        margin-right: 5%;
        position: absolute;
        left: 15%;
        top: 75%;
        z-index: 2;
        transform: scale(1.2);
    }

    .img3{

        margin-right: 5%;
        position: absolute;
        left: 50%;
        top: 97%;
        z-index: 2;
        transform: scale(0.5);
    }

</style>

<body>
    <header>

        <h1>Techome</h1>

        <a href="InicioT.html">Iniciar Sesión</a>

        <a href="/PHP/Solicitud_T/solicitud_T.html">Solicitar Trabajo</a>

    </header>


    <div class="metodo1">
        <h2>¿Como trabajamos?</h2>
        <p>
            Sed aliquet tortor quis sapien vulputate, ut consectetur orci dignissim. Curabitur quis augue vitae ex venenatis finibus. Nunc ornare consectetur massa, id tempus orci molestie id. 
            Morbi hendrerit magna quis molestie sodales. Curabitur semper sodales rutrum. Integer eget urna massa. In quis ultricies massa. Suspendisse a euismod sapien. 
            Vestibulum et ligula a odio facilisis tincidunt. Sed vel accumsan nibh. Nulla sem quam, dapibus in diam eu, eleifend euismod ante. In convallis felis ut pretium volutpat. 
            Maecenas ultrices diam sit amet ligula auctor, at accumsan nisi volutpat. Donec aliquet, leo vel mollis tincidunt, leo velit venenatis arcu, et hendrerit nunc urna a risus. 
            Curabitur tincidunt justo nec leo faucibus, eu fringilla quam varius. Phasellus quis arcu a nisl pharetra placerat. Vivamus quis purus eros. Vivamus sagittis dolor eget tempor cursus. 
            Sed erat enim, sollicitudin eu dapibus ut, rhoncus quis nisi.
        </p>
    </div>

    <div class="img1">

        <img src="/IMG/Engineers_Repairing_a_Generator.jpg" alt="">

    </div>

    <div class="metodo2">

        <h2>Te ayudamos</h2>
        <p>

            Phasellus blandit justo ac justo porta molestie. Nunc egestas aliquam felis, a placerat sem pellentesque non. Donec eu ligula eu urna venenatis malesuada. Morbi at tincidunt lorem, ac iaculis odio. 
            Integer mattis nulla massa, sit amet rutrum lorem dignissim et. 
            Suspendisse potenti. Ut venenatis nulla eu lacinia vestibulum. Nunc aliquam nibh eget ante suscipit, tempus bibendum mi facilisis. Nullam convallis consectetur nulla at volutpat.
            Integer mi justo, elementum nec hendrerit nec, consectetur ut lacus. Quisque in vehicula nulla. Etiam venenatis, odio vitae fermentum vehicula, orci metus molestie augue, quis sodales justo libero id dolor. 
            Donec luctus augue non vehicula bibendum. Vestibulum erat erat, semper vel placerat sit amet, porta quis nisl. Morbi ut pharetra enim. In ac rutrum ligula. Sed a volutpat risus. Donec accumsan venenatis commodo

        </p>
    </div>

    <div class="img2">

        <img src="/IMG/OIP.jpg" alt="">

    </div>

    <div class="metodo3">

        <h2>Tu tienes el control</h2>
        <p>

            Aenean a massa eleifend, lacinia nibh quis, venenatis felis. Nulla eu viverra risus, in tincidunt dolor. Nullam euismod volutpat vehicula. Donec porttitor dolor sed commodo sollicitudin. 
            Curabitur sit amet metus molestie, feugiat purus non, venenatis lectus. Etiam turpis urna, mollis convallis vulputate fermentum, commodo sed nisi. Nulla convallis dignissim ipsum at bibendum. 
            Donec gravida viverra metus non fermentum. Suspendisse mattis est id enim condimentum tincidunt. Sed sit amet turpis quis ex suscipit consectetur in eu erat. Quisque arcu magna, suscipit eu gravida vel, tincidunt vitae turpis. 
            Vestibulum fermentum tristique vestibulum. Nullam cursus iaculis lorem, eget porttitor ligula lacinia vel. In finibus pharetra sapien ut finibus.

        </p>

    </div>

    <div class="img3">

        <img src="/IMG/R.jpg" alt="">

    </div>



    <footer>TecHome® 2023 | Derechos reservados</footer>

</body>
</html>
<?php
    exit(); 
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
        margin: 1%;
        padding: 2%;
        border-radius: 10px;
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
    }

    a:hover{

        background-color: #2C74B3;
        color: #fff;
    }

    .metodo1{

        margin-top: 3%;
        margin-bottom: 3%;
        margin-left: 3%;
        margin-right: 50%;
        padding: 1%;
        text-align: left;
        background-color: #142850;
        border: 2px solid #2C74B3;
        border-radius: 10px;
    }

    .metodo2{

        margin-top: 3%;
        margin-bottom: 3%;
        margin-left: 50%;
        margin-right: 7%;
        padding: 1%;
        text-align: right;
        background-color: #142850;
        border: 2px solid #2C74B3;
        border-radius: 10px;
    }

    .metodo3{

        margin-top: 3%;
        margin-bottom: 3%;
        margin-left: 3%;
        margin-right: 50%;
        padding: 1%;
        text-align: left;
        background-color: #142850;
        border: 2px solid #2C74B3;
        border-radius: 10px;
    }

    .img1{

        margin-right: 5%;
        position: absolute;
        left: 43%;
        top: 7%;
        z-index: 2;
        transform: scale(0.5);
    }

    .img2{

        margin-right: 5%;
        position: absolute;
        left: 15%;
        top: 75%;
        z-index: 2;
        transform: scale(1.2);
    }

    .img3{

        margin-right: 5%;
        position: absolute;
        left: 43%;
        top: 97%;
        z-index: 2;
        transform: scale(0.5);
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
    </header>


    <div class="metodo1">
        <h2>¿Como trabajamos?</h2>
        <p>
            Sed aliquet tortor quis sapien vulputate, ut consectetur orci dignissim. Curabitur quis augue vitae ex venenatis finibus. Nunc ornare consectetur massa, id tempus orci molestie id. 
            Morbi hendrerit magna quis molestie sodales. Curabitur semper sodales rutrum. Integer eget urna massa. In quis ultricies massa. Suspendisse a euismod sapien. 
            Vestibulum et ligula a odio facilisis tincidunt. Sed vel accumsan nibh. Nulla sem quam, dapibus in diam eu, eleifend euismod ante. In convallis felis ut pretium volutpat. 
            Maecenas ultrices diam sit amet ligula auctor, at accumsan nisi volutpat. Donec aliquet, leo vel mollis tincidunt, leo velit venenatis arcu, et hendrerit nunc urna a risus. 
            Curabitur tincidunt justo nec leo faucibus, eu fringilla quam varius. Phasellus quis arcu a nisl pharetra placerat. Vivamus quis purus eros. Vivamus sagittis dolor eget tempor cursus. 
            Sed erat enim, sollicitudin eu dapibus ut, rhoncus quis nisi.
        </p>
    </div>

    <div class="img1">

        <img src="/IMG/Engineers_Repairing_a_Generator.jpg" alt="">

    </div>

    <div class="metodo2">

        <h2>Te ayudamos</h2>
        <p>

            Phasellus blandit justo ac justo porta molestie. Nunc egestas aliquam felis, a placerat sem pellentesque non. Donec eu ligula eu urna venenatis malesuada. Morbi at tincidunt lorem, ac iaculis odio. 
            Integer mattis nulla massa, sit amet rutrum lorem dignissim et. 
            Suspendisse potenti. Ut venenatis nulla eu lacinia vestibulum. Nunc aliquam nibh eget ante suscipit, tempus bibendum mi facilisis. Nullam convallis consectetur nulla at volutpat.
            Integer mi justo, elementum nec hendrerit nec, consectetur ut lacus. Quisque in vehicula nulla. Etiam venenatis, odio vitae fermentum vehicula, orci metus molestie augue, quis sodales justo libero id dolor. 
            Donec luctus augue non vehicula bibendum. Vestibulum erat erat, semper vel placerat sit amet, porta quis nisl. Morbi ut pharetra enim. In ac rutrum ligula. Sed a volutpat risus. Donec accumsan venenatis commodo

        </p>
    </div>

    <div class="img2">

        <img src="/IMG/OIP.jpg" alt="">

    </div>

    <div class="metodo3">

        <h2>Tu tienes el control</h2>
        <p>

            Aenean a massa eleifend, lacinia nibh quis, venenatis felis. Nulla eu viverra risus, in tincidunt dolor. Nullam euismod volutpat vehicula. Donec porttitor dolor sed commodo sollicitudin. 
            Curabitur sit amet metus molestie, feugiat purus non, venenatis lectus. Etiam turpis urna, mollis convallis vulputate fermentum, commodo sed nisi. Nulla convallis dignissim ipsum at bibendum. 
            Donec gravida viverra metus non fermentum. Suspendisse mattis est id enim condimentum tincidunt. Sed sit amet turpis quis ex suscipit consectetur in eu erat. Quisque arcu magna, suscipit eu gravida vel, tincidunt vitae turpis. 
            Vestibulum fermentum tristique vestibulum. Nullam cursus iaculis lorem, eget porttitor ligula lacinia vel. In finibus pharetra sapien ut finibus.

        </p>

    </div>

    <div class="img3">

        <img src="/IMG/R.jpg" alt="">

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