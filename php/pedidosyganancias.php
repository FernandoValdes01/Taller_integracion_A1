<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de pedidos</title>
    <?php
    session_start();

    
if (isset($_SESSION['Rut_Trabajador'])) {
    $rut_trabajador = $_SESSION['Rut_Trabajador']; 


    $connection = new mysqli("localhost", "root", "", "techome");

    if ($connection->connect_error) {
        die("La conexión ha fallado: " . $connection->connect_error);
    }

    $sql = "SELECT * FROM pedido_aceptado WHERE estado='Finalizado' AND Rut_Trabajador='$rut_trabajador'";
    $result = $connection->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="container">';
            echo '<p>ID_pedido: ' . $row["ID_pedido"] . '</p>';
            echo '<p>Nombre pedido: ' . $row["nombre_pedido"] . '</p>';
            echo '<p>Precio: ' . $row["precio"] . '</p>';
            echo '<p>Fecha: ' . $row["fecha"] . '</p>';
            echo '<p>ID_solicitud: ' . $row["ID_solicitud"] . '</p>';
            echo '<p>Rut_Trabajador: ' . $row["Rut_Trabajador"] . '</p>';
            echo '<p>Estado: ' . $row["estado"] . '</p>';
            echo '</div>';
        }
    } else {
        echo "No se encontraron resultados.";
    }
    $connection->close();
} else {
    echo "La variable de sesión 'rut_trabajador' no está definida.";
}
?>
</head>

<style>
        .container {
        border: 1px solid #ccc;
        padding: 10px;
        margin: 10px;
        width: 300px;
        background-color: #191970; 
        color: #fff; 
        }
    body{

        background-color: #27496D;
        color: #F1EFEF;
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;

    }

    header{

        background-color: #142850;
        border: 2px solid #2C74B3;
        color: #F1EFEF;
        margin-top: 1%;
        margin-bottom: 1%;
        margin-left: 1%;
        margin-right: 5%;
        padding: 2%;
        border-radius: 10px;
    }

    footer{

        background-color: #142850;
        border: 2px solid #2C74B3;
        color: #F1EFEF;
        text-align: center;
        margin: 1%;
        padding: 2%;
        border-radius: 10px;
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;

    }
    
    a{

        text-decoration: none;
        color: #fff;

    }

    #textg{

        margin-top: 50px;
        margin-bottom: 50px;
        text-align: center;

    }

    #texth{

        margin-left: 50px;
        padding: 0px;

    }

    #text1{

        background-color: #0A2647;
        border: 5px solid #144272;
        padding: 10px;
        border-radius: 10px;
        margin-right: 5%;
        margin-left: 5%;
    }

    #text2{

        background-color: #0A2647;
        border: 5px solid #144272;
        padding: 10px;
        border-radius: 10px;
        margin-right: 5%;
        margin-left: 5%;
        margin-top: 2%;
    }

    #text3{

        background-color: #0A2647;
        border: 5px solid #144272;
        padding: 10px;
        border-radius: 10px;
        margin-right: 5%;
        margin-left: 5%;
        margin-top: 2%;
    }

    #text4{

        background-color: #0A2647;
        border: 5px solid #144272;
        padding: 10px;
        border-radius: 10px;
        margin-right: 5%;
        margin-left: 5%;
        margin-top: 2%;
    }

    #text5{

        background-color: #0A2647;
        border: 5px solid #144272;
        padding: 10px;
        border-radius: 10px;
        margin-right: 5%;
        margin-left: 5%;
        margin-top: 2%;
    }

    #menu {
        position: fixed;
        top: 0;
        right: -250px; 
        width: 250px;
        height: 100%;
        background-color: #142850;
        border: 2px solid #2C74B3;
        border-radius: 10px;
        margin-top: 0.5%;
        margin-bottom: 0.5%;
        color: #F1EFEF ;
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
        background-color: #142850;
        border: 2px solid #2C74B3;
        border-radius: 10px;
    }


</style>

    <div id="pedidosContainer"></div>

    <script>
        function getPedidos() {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("pedidosContainer").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "same_file.php", true);
            xmlhttp.send();
        }

        getPedidos();
    </script>

</body>
<div id="menu">
<ul>
    <li> <a href="home_Tiniciado.html">Inicio</a></li>
    <li> <a href="perfilTrabajador.html">Perfil</a></li>
    <li> <a href="ganancias.html">Ganancias</li>
    <li> <a href="historial_de_pedidos.html">Pedidos  anteriores</a></li>
    <li> <a href="billetera.html">Billetera</a></li>
    <li> <a href="soporte.html">Soporte</a></li>
    <li> <a href="politica de privacidad.html">Politíca de Privacidad</a></li>
    <li><a href="EliminarCuentaCActualizado.html">Eliminar cuenta</a></li>
    <li> <a href="InicioT.html">Cerrar sesion</a></li>


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