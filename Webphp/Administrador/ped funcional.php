<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "techome";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) 
{die("La conexion fallo: " . $conn->connect_error);
}$estado_pedido = "";
$calificacion_pedido = "";
$nombre_trabajador = "";
$pedidos_trabajador = "";
$rut_trabajador = "";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if ($_SERVER["REQUEST_METHOD"] == "POST")
    {$ID_pedido = $_POST['ID_pedido'];
    $Rut_trabajador = $_POST['Rut_trabajador'];
    $calificacion_pedido = $_POST['calificacion'] ?? '';
    $consulta_sql = "SELECT ss.ID_cliente, pa.estado, pa.calificacion, pa.Rut_Trabajador, t.Nombre_Trabajador, t.Pedidos FROM solicitudservicio ss JOIN pedido_aceptado pa ON ss.ID_solicitud = pa.ID_solicitud JOIN trabajador t ON pa.Rut_Trabajador = t.Rut_trabajador WHERE pa.ID_pedido = '$ID_pedido';";
    $result = $conn->query($consulta_sql);
    if ($result === false) {echo "Error en la consulta: " . $conn->error;}
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $ID_cliente = $row['ID_cliente'];
        $estado_pedido = $row['estado'];
        $calificacion_pedido_anterior = $row['calificacion'];
        $rut_trabajador = $row['Rut_Trabajador'];
        $nombre_trabajador = $row['Nombre_Trabajador'];
        $pedidos_trabajador = $row['Pedidos'];
        if (empty($calificacion_pedido_anterior)) {
            $update_sql = "UPDATE pedido_aceptado SET calificacion = '$calificacion_pedido' WHERE ID_pedido = '$ID_pedido';";
            if ($conn->query($update_sql) === TRUE) {
                echo "La calificacion se ha actualizado correctamente.";
                $incrementar_pedidos_sql = "UPDATE trabajador SET Pedidos = Pedidos + 1 WHERE Rut_trabajador = '$rut_trabajador';";
                if ($conn->query($incrementar_pedidos_sql) === TRUE) {echo "El numero de pedidos del trabajador se ha incrementado en 1 con éxito.";}
                    else {echo "Error al actualizar el numero de pedidos del trabajador: " . $conn->error;}}
            else {echo "Error al actualizar la calificacion: " . $conn->error;}}
        else {echo "Este pedido ya ha sido calificado anteriormente.";}} 
    else {echo "No se encontraron resultados para el ID de pedido proporcionado.";}}
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
<style>
        body {
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            background-color: #27496D;
            color: #F1EFEF;}
        header {
            background-color: #142850;
            border: 2px solid #2C74B3;
            text-align: left;
            margin-top: 1%;
            margin-bottom: 1%;
            margin-left: 1%;
            margin-right: 6%;
            padding: 3%;
            border-radius: 9px;}
        footer{
            background-color: #142850;
            border: 2px solid #2C74B3;
            text-align: center;
            margin: 1%;
            padding: 2%;
            border-radius: 9px;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;}
        a{
            text-decoration: none;
            color: #fff;}
        button.button-style {
        background-color: #142850;
        border: 2px solid #2C74B3;
        color: #F1EFEF;
        border-radius: 5px;
        padding: 0.5%;
        width: 99%;
        margin-bottom: 9px;}
        input{
            background-color: #142850;
            border: 2px solid #2C74B3;
            border-radius: 9px;}
        section{
            background-color: #0A2647;
            border: 3px solid #144272;
            padding-top: 5%;
            padding-bottom: 5%;
            padding-left: 5%;
            padding-right: 6%;
            border-radius: 9px;}
        button:hover{
            background-color: #2C74B3;
            color: #fff;}
        .secondbutton{
            margin-bottom: 9%;}
        .container {
            max-width: 960px;
            margin-top: auto;
            margin-bottom: auto;
            margin-left: auto;
            margin-right: auto;
            padding: 20px;}
        .profile-section {
            margin-top: 3%;}
        .profile-section h2 {
            margin-bottom: 9px;}
        .profile-section label {
            display: block;
            margin-bottom: 9px;}
        .profile-section input[type="text"],
        .profile-section input[type="password"],
        .profile-section input[type="email"] 
            {width: 99%;
            padding: 9px;
            margin-bottom: 20px;
            border-radius: 3px;}
        .profile-section button {
            float: right;
            padding: 9px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;}
        h1 {    
            margin: 0;}
        .trabajador-info {
            text-align: center;
            padding: 20px;}
        .trabajador-avatar {
            border-radius: 50%;
            width: 99px;
            height: 99px;
            background-color: #fff;
            display: inline-block;}
        .trabajador-nombre {
            font-size: 24px;
            margin-top: 10px;}
        .trabajos-disponibles {
            background-color: #fff;
            padding: 20px;
            margin: 20px;
            border-radius: 5px;
            box-shadow: 0 0 9px rgba(0, 0, 0, 0.1);}
        ul {
            list-style-type: none;
            padding: 0;}
        li {
            list-style-type: none;
            padding: 0;}
        .trabajo {
            background-color: #0A2647;
            border: 3px solid #144272;
            padding: 3%;
            border-radius: 9px;}
        #passtext{
            margin-top: 20px;
            padding-top: 50px;}
        #menu {
            position: fixed;
            top: 0;
            right: -303px; 
            width: 300px;
            height: 99%;
            background-color: #142850;
            border: 2px solid #2C74B3;
            border-radius: 9px;
            color: #fff;
            transition: right 0.3s; }
        #menu.active {
            right: 0; }
        #menu ul {
            list-style: none;
            padding: 0;}
        #menu ul li {
            padding: 15px;
            text-align: left;
            margin-left: 5%;
            cursor: pointer;
            border-bottom: 1px solid #142850;}
        #content {
            padding: 20px;
            text-align: center;
            margin-top: 9px;
            margin-bottom: 9px;}
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
            border-radius: 9px;}
</style>
</head>
<body>
<div id="menu"><ul>
        <li><a href="perfilTrabajador.html">Perfil</a></li>
        <li><a href="ganancias.html">Ganancias</a></li>
        <li><a href="historial_de_pedidos.html">Pedidos anteriores</a></li>
        <li><a href="billetera.html">Billetera</a></li>
        <li><a href="soporte.html">Soporte</a></li>
        <li><a href="politica de privacidad.html">Politica de Privacidad</a></li>
        <li><a href="EliminarCuentaCActualizado.html">Eliminar cuenta</a></li>
        <li><a href="InicioT.html">Cerrar sesion</a></li></ul></div>
<div id="menu-toggle">&#9776;</div>
<div class="main-container"> <h1>Consultor de estados</h1>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($nombre_trabajador)) 
        {echo "<div class='estado-container'>";
        echo "<h2>Estado del Pedido: $estado_pedido</h2>";
        if (!empty($calificacion_message)) 
            {echo "<p>$calificacion_message</p>";}
        echo "</div>";
        if ($estado_pedido === "Finalizado" && !empty($calificacion_form)) 
            {echo "<div class='calificacion-container'>";
            echo $calificacion_form;}
        echo "<div class='trabajador-container'>";
        echo "<h2>Datos del Trabajador</h2>";
        echo "<p>Total de Pedidos: $pedidos_trabajador</p>";
        echo "<p>rut_trabajador: $rut_trabajador</p>";
        echo "</div>";
        echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="post">';
        echo '<div class="form-group">';
        echo '</form>';
        echo "</div>";} 
        else 
        {echo '<form method="post" action="' . $_SERVER['PHP_SELF'] . '">';
        echo '<div class "form-group">';
        echo '</form>';}
    ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"><div class="form-group">
            <label for="ID_pedido">ID del Pedido:</label>
            <input type="text" name="ID_pedido" required>
        </div><div class="form-group">
            <label for="Rut_trabajador">Rut_trabajador:</label>
            <input type="text" name="Rut_trabajador" required></div>
        <div class="form-group">
            <label for="calificacion">Calificacion (1-5):</label>
            <input type="number" name="calificacion" min="1" max="5" required></div>
        <input type="submit" name="calificar_pedido" class="btn-submit" value="Calificar Pedido">
    </form>
    <script>
        const menu = document.getElementById('menu');
        const menuToggle = document.getElementById('menu-toggle');
        const perfil = document.getElementById('perfil');
        const config = document.getElementById('configuracion');
        const ganancias = document.getElementById('ganancias');
        const billetera = document.getElementById('billetera');
        const soporte = document.getElementById('soporte');
        const politicadeprivacidad = document.getElementById('politica');
        const cerrarsesion = document.getElementById('cerrarsesion');
        menuToggle.addEventListener('click', () => 
        {menu.classList.toggle('active');});
        perfil.addEventListener('click', () => 
        {console.log('Clic en Perfil');});
        config.addEventListener('click', () => 
        {console.log('Clic en Config');});
        ganancias.addEventListener('click', () => 
        {console.log('Clic en Ganancias');});
        billetera.addEventListener('click', () => 
        {console.log('Clic en Billetera');});
        soporte.addEventListener('click', () => 
        { console.log('Clic en soporte');});
        politicadeprivacidad.addEventListener('click', () => 
        {console.log('Clic en politica');});
        cerrarsesion.addEventListener('click', () => 
        {console.log('Clic en cerrarcesion');});
    </script>
</div>
</body>
</html>