<?php
session_start();

$host = "localhost";
$usuario = "root";
$contrasena = "";
$base_de_datos = "techome";

$conexion = new mysqli($host, $usuario, $contrasena, $base_de_datos);

if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}

if (!isset($_SESSION['Rut_Trabajador'])) {
    header("Location: iniciosesionT.php");
    exit();
}

if (!isset($_GET['ID_Pedido'])) {
    echo "Error: Falta el parámetro 'ID_Pedido'.";
    exit();
}

$id_pedido = $_GET['ID_Pedido'];

// Obtener información del pedido, solicitud, cliente y dirección
$consulta = "SELECT pa.*, ss.*, c.*, d.*
             FROM pedido_aceptado pa
             INNER JOIN solicitudservicio ss ON pa.ID_solicitud = ss.ID_solicitud
             INNER JOIN clientes c ON ss.ID_cliente = c.ID_cliente
             INNER JOIN direccion d ON c.ID_direccion = d.ID_direccion
             WHERE pa.ID_pedido = ?";

$stmt = $conexion->prepare($consulta);
$stmt->bind_param("i", $id_pedido);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 0) {
    echo "Error: No se encontraron datos para el ID_Pedido proporcionado.";
    exit();
}

$datos = $resultado->fetch_assoc();

// Guardar datos en variables para su uso posterior
$datos_pedido = $datos;
$datos_solicitud = $datos;
$datos_cliente = $datos;
$datos_direccion = $datos;

// Obtener las variables de dirección, ciudad y región
$direccion = $datos_direccion['direccion'];
$ciudad = $datos_direccion['ciudad'];
$region = $datos_direccion['region'];

// Verificar si se ha enviado un formulario para actualizar el estado del pedido
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['estado_pedido'])) {
        $nuevo_estado = $_POST['estado_pedido'];

        // Actualizar el estado del pedido en la base de datos
        $actualizar_estado = "UPDATE pedido_aceptado SET estado = ? WHERE ID_pedido = ?";
        $stmt_actualizar = $conexion->prepare($actualizar_estado);
        $stmt_actualizar->bind_param("si", $nuevo_estado, $id_pedido);

        if ($stmt_actualizar->execute()) {
            // Actualización exitosa, recargar la página para reflejar el nuevo estado
            header("Location: {$_SERVER['PHP_SELF']}?ID_Pedido={$id_pedido}");
            exit();
        } else {
            echo "Error al actualizar el estado del pedido.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalles del Pedido</title>
    <style>
        body {
            background-color: #121212; /* Fondo oscuro */
            color: #ffffff; /* Texto claro */
            font-family: Arial, sans-serif;
        }

        .container {
            background-color: #0d47a1; /* Azul oscuro */
            padding: 20px;
            margin: 20px;
            border-radius: 10px;
        }

        #map {
            height: 400px;
            width: 100%;
            margin-top: 20px;
        }

        select {
            padding: 10px;
            font-size: 16px;
            margin-top: 10px;
        }

        input[type="submit"] {
            padding: 10px;
            font-size: 16px;
            margin-top: 10px;
            cursor: pointer;
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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyATSU1EeteVslU-X-zhkkAEaCpEhSpyR_c&callback=initMap" async defer></script>
    <script>
        function initMap() {
            var address = "<?php echo $direccion . ', ' . $ciudad . ', ' . $region; ?>";
            var geocoder = new google.maps.Geocoder();
            geocoder.geocode({ 'address': address }, function (results, status) {
                if (status === 'OK') {
                    var map = new google.maps.Map(document.getElementById('map'), {
                        zoom: 8,
                        center: results[0].geometry.location
                    });
                    var marker = new google.maps.Marker({
                        map: map,
                        position: results[0].geometry.location
                    });
                } else {
                    console.error('La geocodificación no tuvo éxito debido a: ' + status);
                }
            });
        }
        
    </script>
</head>
<body>
    <div class="container">
        <h1>Detalles del Pedido</h1>
        <p>ID del Pedido: <?php echo $datos_pedido['ID_pedido']; ?></p>
        <p>Estado actual del Pedido: <?php echo $datos_pedido['estado']; ?></p>

        <form method="post" action="">
            <label for="estado_pedido">Cambiar Estado del Pedido:</label>
            <select name="estado_pedido" id="estado_pedido">
                <option value="Trabajando">Trabajando</option>
                <option value="Finalizado">Finalizado</option>
            </select>

            <input type="submit" value="Actualizar Estado">
        </form>

        <div id="map"></div>
        <div id="menu-toggle">&#9776;</div>
        <div id="menu">
            <ul>
                <li> <a href="perfiltrabajador.php">Perfil</a></li>
                <li> <a href="ganancias.html">Ganancias</a></li>
                <li> <a href="historial_de_pedidos.html">Pedidos anteriores</a></li>
                <li> <a href="billetera.html">Billetera</a></li>
                <li> <a href="soporte.html">Soporte</a></li>
                <li> <a href="politica de privacidad.html">Politíca de Privacidad</a></li>
            </ul>
        </div>
    </div>
    <script>
        const menu = document.getElementById('menu');
        const menuToggle = document.getElementById('menu-toggle');
        const perfil = document.getElementById('perfil');
        const config = document.getElementById('configuracion');
        const quienesSomos = document.getElementById('ganancias');
        const direcciones = document.getElementById('billetera');
        const soporte = document.getElementById('soporte');
        const politicadeprivacidad = document.getElementById('politica');
    
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
    </script>
</body>
</html>

<?php
$conexion->close();
?>
