<?php
session_start();

if (!isset($_SESSION['Rut_Trabajador'])) {
    header("Location: login.php"); 
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "techome";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cambiar_estado'])) {
    $id_pedido = $_POST['id_pedido'];
    $nuevo_estado = $_POST['nuevo_estado'];
    $rut_trabajador = $_SESSION['Rut_Trabajador'];


    $sql_estado_actual = "SELECT estado FROM Pedido_aceptado WHERE ID_pedido = '$id_pedido' AND Rut_Trabajador = '$rut_trabajador'";
    $result_estado_actual = $conn->query($sql_estado_actual);

    if ($result_estado_actual->num_rows > 0) {
        $row = $result_estado_actual->fetch_assoc();
        $estado_actual = $row['estado'];


        if (($estado_actual === "en camino" && $nuevo_estado === "trabajando") || ($estado_actual === "trabajando" && $nuevo_estado === "finalizado")) {
            $sql_update = "UPDATE Pedido_aceptado SET estado = '$nuevo_estado' WHERE ID_pedido = '$id_pedido' AND Rut_Trabajador = '$rut_trabajador'";
            if ($conn->query($sql_update) === TRUE) {
                echo '<script language="javascript">';
                echo 'alert("Estado actualizado con éxito.")';
                echo '</script>';
            } else {
                echo '<script language="javascript">';
                echo 'alert("Error al actualizar el estado: ' . $conn->error . '")';
                echo '</script>';
            }
        } else {
            echo '<script language="javascript">';
            echo 'alert("No se puede cambiar al estado seleccionado. La secuencia de cambio de estado no es válida.")';
            echo '</script>';
        }
    } else {
        echo '<script language="javascript">';
        echo 'alert("No se encontró el pedido asociado a este trabajador.")';
        echo '</script>';
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Cambio de Estado de Pedido</title>
    <style>
body {
    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
    background-color: #27496D;
    color: #F1EFEF;
    display: flex;
    flex-direction: column;
    align-items: center; 
}

header {
    background-color: #142850;
    border: 2px solid #2C74B3;
    color: #F1EFEF;
    margin-top: 1%;
    margin-bottom: 1%;
    margin-left: 1%;
    margin-right: 5%;
    padding: 2%;
    border-radius: 9px;
}

section {
    background-color: #142850;
    border: 2px solid #2C74B3;
    padding: 3%;
    margin-left: 30%;
    margin-right: 30%;
    margin-bottom: 2%;
    border-radius: 9px;
}

footer {
    background-color: #142850;
    border: 2px solid #2C74B3;
    color: #F1EFEF;
    text-align: center;
    margin: 1%;
    padding: 2%;
    border-radius: 9px;
    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
}

h1 {
    font-family: verdana;
    font-size: 30px;
    text-align: center;
}

p {
    margin-left: 15%;
    margin-top: 39px;
    font-family: Arial;
    font-size: 20px;
}

a {
    text-decoration: none;
    color: #F1EFEF;
}

input {
    border-radius: 3px;
    border: 5px solid #2C74B3;
}

textarea {
    border-radius: 3px;
    border: 5px solid #2C74B3;
}

button {
    background-color: #27496D;
    border: 2px solid #2C74B3;
    color: #F1EFEF;
    padding: 1%;
    border-radius: 9px;
}

button:hover {
    background-color: #2C74B3;
    color: #fff;
}

.q_text {
    margin-top: 3%;
    margin-bottom: 3%;
    text-align: center;
}

.Correo {
    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
    font-size: 20px;
    margin-top: 60px;
    margin-left: 15%;
}

.Contraseña {
    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
    font-size: 20px;
    margin-top: 20px;
    margin-left: 15%;
}

.Contraseña label {
    display: block;
    margin-bottom: 9px;
    margin-top: 0%;
}

.Correo label {
    display: block;
    margin-bottom: 9px;
    margin-top: 0%;
}

.Botón_de_enviar {
    margin-left: 15%;
}

#menu {
    position: fixed;
    top: 0;
    right: -253px;
    width: 240px;
    height: 99%;
    background-color: #142850;
    border: 2px solid #2C74B3;
    border-radius: 9px;
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
    border-radius: 9px;
}
    </style>
</head>

<body>
    <header>
        <h1>Estado del Pedido</h1>
    </header>
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
    <section>
        <form action="" method="post">
            <label for="id_pedido">ID del Pedido:</label><br>
            <input type="text" id="id_pedido" name="id_pedido"><br><br>
            <label for="nuevo_estado">Nuevo Estado:</label><br>
            <select id="nuevo_estado" name="nuevo_estado">
                <option value="trabajando">Trabajando</option>
                <option value="finalizado">Finalizado</option>
            </select><br><br>
            <input type="submit" name="cambiar_estado" value="Cambiar Estado">
        </form>
    </section>

    <section>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id_pedido = $_POST['id_pedido'];
            $rut_trabajador = $_SESSION['Rut_Trabajador'];
            $sql_info_cliente = "SELECT clientes.*, direccion.* FROM Pedido_aceptado 
            JOIN clientes ON Pedido_aceptado.ID_solicitud = clientes.ID_direccion
            JOIN direccion ON clientes.ID_direccion = direccion.ID_direccion
            WHERE ID_pedido = '$id_pedido' AND Rut_Trabajador = '$rut_trabajador'";
            $result_info_cliente = $conn->query($sql_info_cliente);

            if ($result_info_cliente->num_rows > 0) {
                $row_cliente = $result_info_cliente->fetch_assoc();
                echo "Información del cliente:<br>";
                echo "ID: " . $row_cliente["ID_cliente"] . "<br>";
                echo "Nombre: " . $row_cliente["nombre_Cliente"] . "<br>";
                echo "Correo electrónico: " . $row_cliente["Correo_Cliente"] . "<br>";
                echo "Información de la dirección:<br>";
                echo "Dirección: " . $row_cliente["direccion"] . "<br>";
                echo "Indicaciones: " . $row_cliente["indicaciones"] . "<br>";
                echo "Ciudad: " . $row_cliente["ciudad"] . "<br>";
                echo "Región: " . $row_cliente["region"] . "<br>";
            }
        }
        ?>
    </section>
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
<?php
$conn->close();
?>
