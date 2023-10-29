<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $mensaje = $_POST["mensaje"];

    // Obten la clave primaria del cliente desde la sesión
    $id_cliente = $_SESSION["ID_cliente"]; // Asegúrate de que la clave primaria se almacene en $_SESSION["ID_cliente"]

    // Conexión a la base de datos (reemplaza con tus propios detalles)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "techome";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("La conexión a la base de datos falló: " . $conn->connect_error);
    }

    // Query para insertar datos en la tabla AsistenciaC
    $sql = "INSERT INTO AsistenciaC (ID_cliente, nombre, correo, mensaje) VALUES ('$id_cliente', '$nombre', '$correo', '$mensaje')";

    if ($conn->query($sql) === true) {
        echo "Registro exitoso";
    } else {
        echo "Error al registrar: " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TecHome® | Soporte técnico</title>
    <style>
body {
    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
    background-color: #27496D;
    color: #F1EFEF;
}

header {
    background-color: #142850;
    border: 2px solid #2C74B3;
    text-align: left;
    margin-top: 1%;
    margin-bottom: 1%;
    margin-left: 1%;
    margin-right: 7%;
    padding-top: 2%;
    padding-bottom: 2%;
    padding-left: 3%;
    padding-right: 1%;
    border-radius: 9px;
}

section{
    background-color: #0A2647;
    border: 3px solid #144272;
    margin-top: 5%;
    margin-bottom: 5%;
    margin-left: 9%;
    margin-right: 9%;
    border-radius: 9px;
}

button{
    background-color: #142850;
    border: 3px solid #2C74B3;
    color: #F1EFEF;
}

footer{ 
    background-color: #142850;
    border: 2px solid #2C74B3;
    text-align: center;
    margin: 1%;
    padding: 2%;
    border-radius: 9px;
    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
}

a{
    text-decoration: none;
    color: #fff;
}

.container {
    max-width: 960px;
    margin: 20px auto;
    padding: 20px;
}

.contact-info {
    margin-top: 30px;
    padding-top: 20px;
}

.contact-info h2 {
    margin-bottom: 9px;
}

.contact-info p {
    margin-bottom: 20px;
}

.contact-form {
    margin-top: 30px;
    padding-top: 20px;
}

.contact-form h2 {
    margin-bottom: 9px;
}

.contact-form label {
    display: block;
    margin-bottom: 9px;
}

.contact-form input[type="text"],
.contact-form input[type="email"],
.contact-form textarea {
    width: 99%;
    padding: 9px;
    margin-bottom: 20px;
    border-radius: 3px;
    border: 5px solid #2C74B3;
}

.contact-form textarea {
    resize: vertical;
}

.contact-form button {
    padding: 9px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    color: #F1EFEF;
    background-color: #27496D;
    border: 2px solid #2C74B3;
}

.contact-form button:hover {
    background-color: #2C74B3;
}

.faq {
    margin-top: 30px;
    border-top: 1px solid #ccc;
    padding-top: 20px;
}

.faq h2 {
    margin-bottom: 9px;
}

.faq-item {
    margin-bottom: 20px;
}

.faq-question {
    font-weight: bold;
}

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
    padding: 20px;
    text-align: center;
    margin-top: 9px;
    margin-bottom: 9px;
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
    border-radius: 9px;
}
    </style>
</head>
<body>
    <header>
        <h1>Soporte Técnico TecHome</h1>
    </header>

    <div id="menu">
        <ul>
            <li></li>
            <li><a href="clienteiniciado.html">Inicio</a></li>
            <li> <a href="configuracion de cliente.html">Perfil</a></li>
            <li> <a href="NuestrahistoriaC1.html">Quienes somos</li>
            <li> <a href="Direcciones1.html">Direcciones</a></li>
            <li> <a href="soportec1.html">Soporte</a></li>
            <li> <a href="politica de privacidadc1.html">Política de Privacidad</a></li>
            <li> <a href="/HTML/Cliente_visita/clientevisita.html">Cerrar sesión</a></li>
    
        </ul>
    </div>


    <section>
    <div class="container">
        <h2>Bienvenido al soporte técnico de TecHome</h2>
        <p>Aquí encontrarás todo lo que necesitas.</p>
    </div>
    <div class="container faq">
        <h2>Preguntas Frecuentes</h2>
        <div class="faq-item">
            <p class="faq-question">1. ¿Cómo puedo restablecer mi contraseña?</p>
            <p>Sed ut com mod tortor, quis auctor eros. Donec ac nis dui.
            Pellentesque habitant morbi tristique senectus et netus et malesuad fames ac turpis stas. Etiam iaculis gnissi ipsum.
            Donec lacinia sed tellus at ornare.
            Donec imperdiet in mauris ut tru. In sed pharetra era. Nam at ligula faucibus, viverra nisl sed, eleifend mag.</p>
        </div>
        <div class="faq-item">
            <p class="faq-question">2. ¿Cuáles son los métodos de pago aceptados?</p>
            <p>Cras suscipit lobortis posuere. Maecenas pulvinar, nib eu pharetra luctus, nulla metus vestibulum ipsum, a tincidunt ex urna eu est.
            Integer faucibus justo lacus, at malesuada urna fermentum nec. Aliquam vel vestibulum magna, a dapibus metus.
            Fusce vehicula lobortis orci non interdum. Vivamus nulla lacus, porttitor non luctus eget, ultricies at sem.</p>
        </div>
        <div class="faq-item">
            <p class="faq-question">3. ¿Dónde puedo encontrar el manual del usuario?</p>
            <p>Nulla risus pretium ut felis eu, finibus commodo nib.
            Suspendisse congue, enim at convallis ultrices, sapien justo faucibus erat, a ultricies mi lorem et enim.
            Nulla tellus tellus, viverra in consectetur eget, tincidunt vitae ante.
            Pellentesque sollicitudin arcu nib, ut tempus augue tempus id.</p>
        </div>
        <div class="faq-item">
            <p class="faq-question">4. ¿Cuál es el tiempo de respuesta del soporte técnico?</p>
            <p>Aenean metus risus, facilisis condimentum augue luctus, tincidunt pellentesque
            Donec dictum, elit vitae gravida posuere, lorem arcu placerat eros, ac placerat nun quam eget elit.
            Praesent sodales, enim vitae porttitor sollicitudin, diam velit blandit sem, ut luctus nib risus ut urna.</p>
        </div>
    </div>
    <div class="container contact-info">
        <h2>Información de Contacto</h2>
        <p>Si los usuarios tienen alguna pregunta o inquietud sobre la política de privacidad o los términos de uso, pueden ponerse en contacto con nosotros de la siguiente manera:</p>
        <p>Correo Electrónico: <a href="mailto:soporte@tehome.com">soporte@tehome.com</a></p>
        <p>Número de Contacto: +123456789</p>
    </div>
    <div class="container contact-form">
        <h2>Formulario de Contacto</h2>
        <form id="contact-form" method="POST" action=""> <!-- Agregué method y action -->
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="correo">Correo Electrónico:</label>
            <input type="email" id="correo" name="correo" required>

            <label for="mensaje">Mensaje:</label>
            <textarea id="mensaje" name="mensaje" rows="5" required></textarea>

            <button type="submit">Enviar Mensaje</button>
        </form>
    </div>
    </section>


    <footer>TecHome® 2023 | Derechos reservados</footer>

    <div id="menu-toggle">&#9776;</div> <!-- Ícono de tres líneas horizontales -->
    <script>
    const menu = document.getElementById('menu');
    const menuToggle = document.getElementById('menu-toggle');
    const perfil = document.getElementById('perfil');
    const config = document.getElementById('config');
    const quienesSomos = document.getElementById('quienes-somos');
    const direcciones = document.getElementById('direcciones');
    
      /* Manejar el clic en el ícono de menú para mostrar/ocultar el menú deslizante */
    menuToggle.addEventListener('click', () => {
        menu.classList.toggle('active'); // Cambiar la clase para mostrar/ocultar el menú
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