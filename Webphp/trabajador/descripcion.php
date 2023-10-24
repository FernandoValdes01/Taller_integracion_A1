<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #152238; 
            color: #FFFFFF; 
            font-family: Arial, sans-serif;
        }
        .container {
            border: 2px solid #fff; 
            padding: 20px;
            width: 400px;
            background-color: #12232E;
            border: radius 10px;
            
        }
        .section {
            margin-bottom: 20px;
        }
        .section-title {
            font-weight: bold;
            margin-bottom: 10px;
        }
        .data {
            margin-bottom: 5px;
        }
        button {
            background-color: #1E3A5F; 
            color: #FFFFFF; 
            border: none;
            padding: 10px 20px;
            margin-right: 10px;
            cursor: pointer;
        }
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
</head>
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

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "techome";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("La conexión a la base de datos falló: " . $conn->connect_error);
}

$solicitud_id = 2; 

$sql = "SELECT * FROM solicitudservicio s 
        INNER JOIN clientes c ON s.ID_cliente = c.ID_cliente
        INNER JOIN direccion d ON c.ID_direccion = d.ID_direccion
        WHERE s.ID_solicitud = $solicitud_id";

$result = $conn->query($sql);

if ($result) {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $nombreCliente = $row['nombre_Cliente'];
            $correoCliente = $row['Correo_Cliente'];
            $direccion = $row['direccion'];
            $indicaciones = $row['indicaciones'];
            $ciudad = $row['ciudad'];
            $region = $row['region'];
            $tipoServicio = $row['tipo_servicio'];
            $descripcion = $row['descripcion'];
            $precio = $row['precio'];
            $rutTrabajador = $row['Rut_Trabajador'];
            ?>
            <div class="container">
                <div class="section">
                    <div class="section-title">DATOS DEL CLIENTE</div>
                    <div class="data">Nombre: <?php echo $nombreCliente; ?></div>
                    <div class="data">Correo: <?php echo $correoCliente; ?></div>
                    <div class="data">Dirección: <?php echo $direccion; ?></div>
                    <div class="data">Indicaciones: <?php echo $indicaciones; ?></div>
                    <div class="data">Ciudad: <?php echo $ciudad; ?></div>
                    <div class="data">Región: <?php echo $region; ?></div>
                </div>
                <div class="section">
                    <div class="section-title">DATOS DE LA SOLICITUD</div>
                    <div class="data">Tipo de Servicio: <?php echo $tipoServicio; ?></div>
                    <div class="data">Descripción: <?php echo $descripcion; ?></div>
                    <div class="data">Precio: <?php echo $precio; ?></div>
                    <div class="data">Rut del Trabajador: <?php echo $rutTrabajador; ?></div>
                </div>
                <div class="section" style="text-align: center;">
                    <button>Aceptar</button>
                    <button>Rechazar</button>
                </div>
            </div>
            <?php
        }
    } else {
        echo "No se encontraron resultados para la ID de solicitud: $solicitud_id";
    }
} else {
    echo "Error en la consulta: " . $conn->error;
}

$conn->close();

?>

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
