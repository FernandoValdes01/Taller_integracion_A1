<?php
session_start();

if (!isset($_SESSION['Correo_Cliente'])) {
    header("Location: menu.php");
    exit();
}
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "techome";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("La conexión falló: " . $conn->connect_error);
}

$estado_pedido = "";
$calificacion = "";

$nombre_trabajador = "";
$profesion_trabajador = "";
$descripcion_trabajador = "";
$calificacion_trabajador = "";
$total_pedidos_trabajador = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ID_pedido = $_POST['ID_pedido'];
    $calificacion = $_POST['calificacion'] ?? '';

    $ID_cliente_session = $_SESSION['ID_cliente'];
    $query_solicitud = "SELECT ID_cliente FROM solicitudservicio WHERE ID_solicitud IN (SELECT ID_solicitud FROM pedido_aceptado WHERE ID_pedido = '$ID_pedido')";
    $result_solicitud = $conn->query($query_solicitud);

    if ($result_solicitud->num_rows > 0) {
        $row_solicitud = $result_solicitud->fetch_assoc();
        $ID_cliente_db = $row_solicitud['ID_cliente'];

        if ($ID_cliente_db !== $ID_cliente_session) {
            echo "<script>alert('LOS ID DEL CLIENTE NO CORRESPONDEN: ID Cliente DB: $ID_cliente_db, ID Cliente Session: $ID_cliente_session');</script>";
        } else {
            $estado_query = "SELECT estado, calificacion FROM pedido_aceptado WHERE ID_pedido = '$ID_pedido'";
            $result_estado = $conn->query($estado_query);

            if ($result_estado->num_rows > 0) {
                $row_estado = $result_estado->fetch_assoc();
                $estado_pedido = $row_estado['estado'];
                $calificacion_pedido = $row_estado['calificacion'];

                if ($calificacion_pedido && $calificacion_pedido !== "0") {
                    $calificacion_message = "El pedido ya está calificado: $calificacion_pedido";
                } else {
                    if ($estado_pedido === "Finalizado" && empty($calificacion)) {
                        $calificacion_form = '<div class="container">';
                        $calificacion_form .= '<h2>Calificar Pedido</h2>';
                        $calificacion_form .= '<form method="post" action="' . $_SERVER['PHP_SELF'] . '">';
                        $calificacion_form .= 'Calificación: <input type="text" name="calificacion">';
                        $calificacion_form .= '<br><br>';
                        $calificacion_form .= '<input type="hidden" name="ID_pedido" value="' . $ID_pedido . '">';
                        $calificacion_form .= '<input type="submit" value="Enviar">';
                        $calificacion_form .= '</form>';
                        $calificacion_form .= '</div>';
                    } elseif ($estado_pedido === "Finalizado" && !empty($calificacion)) {
                        $update_sql = "UPDATE pedido_aceptado SET calificacion = '$calificacion' WHERE ID_pedido = '$ID_pedido'";

                        if ($conn->query($update_sql) === TRUE) {
                            $calificacion_message = "Calificación actualizada con éxito.";
                        } else {
                            $calificacion_message = "Error: " . $update_sql . "<br>" . $conn->error;
                        }
                    }
                }
                $trabajador_query = "SELECT Nombre_Trabajador, Profesion, Descripcion, Calificacion, totalpedidos FROM trabajador WHERE Rut_trabajador IN (SELECT Rut_trabajador FROM pedido_aceptado WHERE ID_pedido = '$ID_pedido')";
                $result_trabajador = $conn->query($trabajador_query);

                if ($result_trabajador->num_rows > 0) {
                    $row_trabajador = $result_trabajador->fetch_assoc();
                    $nombre_trabajador = $row_trabajador['Nombre_Trabajador'];
                    $profesion_trabajador = $row_trabajador['Profesion'];
                    $descripcion_trabajador = $row_trabajador['Descripcion'];
                    $calificacion_trabajador = $row_trabajador['Calificacion'];
                    $total_pedidos_trabajador = $row_trabajador['totalpedidos'];
                }
            }
        }
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
<style>
    :root {
        --main-color: #0D6EFD;
        --light-color-1: #BBD6F4; 
        --light-color-2: #E2EDFF; 
        --dark-color-1: #064AB2; 
        --dark-color-2: #042A73; 
        --bg-color: #142850;
    }

    .main-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100vh;
        background-color: #142850; 
        color: #ffffff; 
    }

    .estado-container {
        background-color: var(--light-color-2);
        padding: 20px;
        border-radius: 5px;
        margin-bottom: 20px;
        width: 50%;
        text-align: center;
    }

    .trabajador-container {
        background-color: var(--light-color-2);
        padding: 20px;
        border-radius: 5px;
        width: 50%;
        text-align: center;
    }


    h1 {
        color: var(--main-color);
    }


    h2 {
        color: var(--dark-color-1);
    }


    form {
        margin-top: 20px;
    }

    input[type="submit"] {
        background-color: var(--main-color);
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    p {
        color: var(--dark-color-2);
    }

    input[type="text"] {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        box-sizing: border-box;
        border: 2px solid var(--light-color-1);
        border-radius: 4px;
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

<div class="main-container">

<h1>Consultor de estados</h1>

<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
Ingresar ID_pedido: <input type="text" name="ID_pedido">
<br><br>
<input type="submit" value="Verificar Estado">
</form>

<?php
echo "<div class='estado-container'>";
echo "<h2>Estado del Pedido: $estado_pedido</h2>";
if (!empty($calificacion_message)) {
    echo "<p>$calificacion_message</p>";
}
echo "</div>";

if (!empty($nombre_trabajador)) {
    echo "<div class='trabajador-container'>";
    echo "<h2>Datos del Trabajador</h2>";
    echo "<p>Nombre: $nombre_trabajador</p>";
    echo "<p>Profesión: $profesion_trabajador</p>";
    echo "<p>Descripción: $descripcion_trabajador</p>";
    echo "<p>Calificación: $calificacion_trabajador</p>";
    echo "<p>Total de Pedidos: $total_pedidos_trabajador</p>";
    echo "</div>";
}
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
</div>
</body>
</html>