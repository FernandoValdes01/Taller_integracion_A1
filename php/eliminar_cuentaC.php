<?php
session_start();

// Configuración de la conexión a la base de datos
$server = "localhost";
$usuario = "root";
$contraseña = "";
$basededatos = "techome";


$conexion = new mysqli($server, $usuario, $contraseña, $basededatos);


if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $contrasena_usuario = $_POST["contrasena"];
    $confirmar_contrasena = $_POST["confirmar_contrasena"];


    if (isset($_SESSION['contraseña']) && isset($_SESSION['Correo_Cliente'])) {
        $contraseñadb_ = $_SESSION['contraseña'];
        $correo = $_SESSION['Correo_Cliente'];

        if ($contrasena_usuario === $confirmar_contrasena && $contrasena_usuario === $contraseñadb_) {

            $sql = "DELETE FROM clientes WHERE Correo_Cliente = '$correo'";
            $result = $conexion->query($sql);

            if ($result === false) {
                die("Error en la consulta SQL: " . $conexion->error);
            }

            if ($conexion->query($sql) === TRUE) {
                echo "Cuenta eliminada exitosamente.";

                session_destroy();
            } else {
                echo "Error al eliminar la cuenta: " . $conexion->error;
            }
        } else {
            echo "La contraseña no coincide o es incorrecta. No se pudo eliminar la cuenta.";
        }
    } else {
        echo "Los valores de sesión no están definidos.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Eliminar Cuenta</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<header>
    <h1>¿Por qué desea eliminar su cuenta?</h1>
</header>
<body>
<div id="container">
    <div id="menu">
        <ul>
            <li><a href="Menu.php">Inicio</a></li>
            <li><a href="configuracion de cliente.html">Configuracion</a></li>
            <li><a href="NuestrahistoriaC1.html">Quienes somos</a></li>
            <li><a href="Direcciones1.html">Direcciones</a></li>
            <li><a href="soportec1.html">Soporte</a></li>
            <li><a href="politica de privacidadc1.html">Política de Privacidad</a></li>
            <li><a href="/Cliente/cliente2/clientevisita.html">Cerrar sesión</a></li>
        </ul>
    </div>

    <form action="eliminar_cuentaC.php" method="post" onsubmit="return validarFormulario();">
        <div class="Opciones">
            <p>
                <input type="radio" name="motivo" value="No longer need the account" onclick="mostrarOtroMotivo()"> No me satisface la empresa<br>
                <input type="radio" name="motivo" value="Found a better service" onclick="mostrarOtroMotivo()"> Encontré un servicio mejor<br>
                <input type="radio" name="motivo" value="Privacy concerns" onclick="mostrarOtroMotivo()"> Los trabajadores no son eficientes<br>
                <input type="radio" name="motivo" value="Privacy concerns" onclick="mostrarOtroMotivo()"> Preocupaciones de privacidad<br>
                <input type="radio" name="motivo" value="Other" onclick="mostrarOtroMotivo()"> Otro<br>
            </p>
        </div>
        <div class="Otro_motivo" style="display: none;">
            <p>
                Especifique la razón: <br>
                <textarea name="otro_motivo" rows="4" cols="50"></textarea>
            </p>
        </div>
    </form>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="contrasena">Contraseña:</label>
        <input type="password" name="contrasena" id="contrasena" required>
        <br>
        <label for="confirmar_contrasena">Confirmar Contraseña:</label>
        <input type="password" name="confirmar_contrasena" id="confirmar_contrasena" required>
        <br>
        <button type="submit">Eliminar Cuenta</button>
    </form>
    <h3>.</h3>
    <footer>TecHome® 2023 | Derechos reservados</footer>
</div>
</body>
</html>

<div id="menu-toggle">&#9776;</div> 
<script>
const menu = document.getElementById('menu');
const menuToggle = document.getElementById('menu-toggle');
const perfil = document.getElementById('perfil');
const config = document.getElementById('config');
const quienesSomos = document.getElementById('quienes-somos');
const direcciones = document.getElementById('direcciones');

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
</html>

<script>
function mostrarOtroMotivo() {
    var motivoSeleccionado = document.querySelector('input[name="motivo"]:checked').value;
    var otroMotivoCampo = document.querySelector('.Otro_motivo');

    if (motivoSeleccionado === 'Other') {
        otroMotivoCampo.style.display = 'block'; 
    } else {
        otroMotivoCampo.style.display = 'none'; 
    }
}

function validarFormulario() {
    var correo = document.getElementById('correo').value;
    if (correo === '') {
        alert('Por favor, ingrese su correo electrónico.');
        return false; 
    }
    return true; 
}
</script>
