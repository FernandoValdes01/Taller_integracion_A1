<?php
session_start();

if (isset($_SESSION['Correo_Trabajador'], $_SESSION['Nombre_Trabajador'], $_SESSION['contraseña'])) {
    $correo = $_SESSION['Correo_Trabajador'];
    $Correo_Cliente = $_SESSION['Correo_Trabajador'];
    $nombre = $_SESSION['Nombre_Trabajador'];
    $contraseñaC = $_SESSION['contraseña'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "techome";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("La conexión a la base de datos falló: " . $conn->connect_error);
    }

    $sql = "SELECT Monto_Cuenta FROM trabajador";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $saldo = $row["Monto_Cuenta"];
    } else {
        $saldo = "No se encontró saldo";
    }
} else {
    header("Location: iniciosesionT.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billetera Techome</title>
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

        .wallet {
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

    .wallet{
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

    .transaction{
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

    .balance p{
        f
    }
    </style>
</head>
<body>

    <header>
        <h1>Billetera</h1>
    </header>

    <div class="wallet">
        <h1>[Nombre Trabajador]</h1>

        <div class="balance">
                <h3>Saldo Actual: <?php echo $saldo; ?></h3>
            </div>
            
        <h2>Últimas Transacciones</h2>
        <div class="transaction">
            <p>Fecha: 2023-09-13</p>
            <p>Compra en línea</p>
            <p>Monto: $100.00</p>
        </div>
        <div class="transaction">
            <p>Fecha: 2023-09-11</p>
            <p>Depósito</p>
            <p>Monto: $500.00</p>
        </div>
        <div class="transaction">
            <p>Fecha: 2023-09-11</p>
            <p>Retiro de cajero</p>
            <p>Monto: -$50.00</p>
        </div>
    </div>

    <div id="menu">
        <ul>
            <li> <a href="MaqPerfilTrabajador.html">Perfil</a></li>
            <li> <a href="ganancias.html">Ganancias</li>
            <li> <a href="historial_de_pedidos.html">Pedidos  anteriores</a></li>
            <li> <a href="billetera.html">Billetera</a></li>
            <li> <a href="soporte.html">Soporte</a></li>
            <li> <a href="politica de privacidad.html">Politíca de Privacidad</a></li>

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

    <footer>TecHome® 2023 | Derechos reservados</footer>

</body>
</html>