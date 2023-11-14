<?php
// Iniciar sesión
session_start();

// Verificar si el trabajador tiene una sesión
if (!isset($_SESSION['Rut_Trabajador'])) {
    // Redirigir o mostrar un mensaje de error si no hay sesión
    header("Location:iniciosesionT.php");
    exit();
}

// Conexion a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "techome";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el ID del pedido desde la URL
$id_pedido = $_GET['id_pedido'];

// Obtener el estado actual del pedido
$sql_estado_actual = "SELECT estado, Rut_Trabajador FROM Pedido_aceptado WHERE ID_pedido = '$id_pedido'";
$result_estado_actual = $conn->query($sql_estado_actual);

if ($result_estado_actual->num_rows > 0) {
    $row = $result_estado_actual->fetch_assoc();
    $estado_actual = $row['estado'];
    $rut_trabajador = $row['Rut_Trabajador'];

    // Obtener el nuevo estado desde el formulario HTML
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nuevo_estado = $_POST['nuevo_estado'];

        // Verificar y actualizar el estado
        if (($estado_actual === "en camino" && $nuevo_estado === "trabajando") || ($estado_actual === "trabajando" && $nuevo_estado === "finalizado")) {
            $sql_update = "UPDATE Pedido_aceptado SET estado = '$nuevo_estado' WHERE ID_pedido = '$id_pedido' AND Rut_Trabajador = '$rut_trabajador'";
            $conn->query($sql_update);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Calificar Pedido</title>
</head>
<body>
    <h1>Calificar Pedido</h1>
    <form method="post">
        <label for="nuevo_estado">Nuevo Estado:</label>
        <select name="nuevo_estado" id="nuevo_estado">
            <option value="trabajando">Trabajando</option>
            <option value="finalizado">Finalizado</option>
        </select>
        <button type="submit">Actualizar Estado</button>
    </form>

    <?php
// ...

// Obtener la dirección del cliente
$sql_direccion_cliente = "SELECT c.direccion, c.ciudad, c.region FROM Pedido_aceptado p
                        JOIN ID_solicitud s ON p.ID_solicitud = s.ID_solicitud
                        JOIN Clientes c ON s.ID_cliente = c.ID_cliente
                        WHERE p.ID_pedido = '$id_pedido'";

$result_direccion_cliente = $conn->query($sql_direccion_cliente);

if ($result_direccion_cliente->num_rows > 0) {
    $row_direccion_cliente = $result_direccion_cliente->fetch_assoc();
    $direccion_cliente = $row_direccion_cliente['direccion'];
    $ciudad_cliente = $row_direccion_cliente['ciudad'];
    $region_cliente = $row_direccion_cliente['region'];

    // Utilizar la API de Google Maps para convertir la dirección en coordenadas
    $direccion_completa = $direccion_cliente . ', ' . $ciudad_cliente . ', ' . $region_cliente;
    $direccion_codificada = urlencode($direccion_completa);

    $google_maps_api_key = 'AIzaSyATSU1EeteVslU-X-zhkkAEaCpEhSpyR_c'; // Reemplazar con tu clave API de Google Maps

    // URL de la API de Google Maps para geocodificar la dirección
    $url_geocoding = "https://maps.googleapis.com/maps/api/geocode/json?address=$direccion_codificada&key=$google_maps_api_key";

    // Mostrar la dirección que se va a buscar (puedes comentar o eliminar esta línea en producción)
    echo "<script>alert('Buscando la dirección: $direccion_completa');</script>";

    $geocoding_data = file_get_contents($url_geocoding);
    $geocoding_result = json_decode($geocoding_data, true);

    if ($geocoding_result && $geocoding_result['status'] === 'OK') {
        $latitud = $geocoding_result['results'][0]['geometry']['location']['lat'];
        $longitud = $geocoding_result['results'][0]['geometry']['location']['lng'];

        // Mostrar el mapa centrado en las coordenadas obtenidas
        echo "<iframe
                width='600'
                height='450'
                frameborder='0' style='border:0'
                src='https://www.google.com/maps/embed/v1/place?q=$latitud,$longitud&key=$google_maps_api_key' allowfullscreen>
              </iframe>";
    } else {
        // Mostrar un alert con las variables en caso de error
        echo "<script>alert('Error al obtener las coordenadas. Direccion: $direccion_cliente, Ciudad: $ciudad_cliente, Region: $region_cliente');</script>";
    }
} else {
    // Mostrar un alert con las variables en caso de error
    echo "<script>alert('Error al obtener la dirección del cliente $direccion_completa.');</script>";
}
?>





</body>
</html>

<?php
// Cerrar la conexión a la base de datos al finalizar
$conn->close();
?>
