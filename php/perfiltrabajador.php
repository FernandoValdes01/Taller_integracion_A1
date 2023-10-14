<!DOCTYPE html>
<html lang="en">
<head>
<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "techome";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Rut_Trabajador = $_SESSION['Rut_Trabajador'];
    $Nombre_Trabajador = $_POST['Nombre_Trabajador'];
    $Correo_Trabajador = $_POST['Correo_Trabajador'];
    $Profesion = $_SESSION['Profesion']; // Se debe obtener de la sesión, ya que no se recibe del formulario
    $contraseña = $_POST['contraseña'];
    $Descripcion = $_POST['Descripcion'];

    $sql = "UPDATE trabajador SET Nombre_Trabajador='$Nombre_Trabajador', Correo_Trabajador='$Correo_Trabajador', contraseña='$contraseña', Descripcion='$Descripcion' WHERE Rut_Trabajador='$Rut_Trabajador'";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['Nombre_Trabajador'] = $Nombre_Trabajador;
        $_SESSION['Correo_Trabajador'] = $Correo_Trabajador;
        $_SESSION['contraseña'] = $contraseña;
        $_SESSION['Descripcion'] = $Descripcion;
        header("Location: perfilTrabajador.php");
        exit();
    } else {
        echo "Error actualizando el registro: " . $conn->error;
    }
}


$Nombre_Trabajador = $_SESSION['Nombre_Trabajador'] ?? '';
$Correo_Trabajador = $_SESSION['Correo_Trabajador'] ?? '';
$contraseña = $_SESSION['contraseña'] ?? '';
$Descripcion = $_SESSION['Descripcion'] ?? '';
$Rut_Trabajador = $_SESSION['Rut_Trabajador'] ?? '';
$calificacion = $_SESSION['Calificacion'] ?? '';
$Profesion = $_SESSION['Profesion'] ?? '';

$conn->close();
?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TecHome® | Perfil Trabajador</title>
</head>

<style>

    body{

        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        background-color: #27496D;
        color: #F1EFEF;

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

    section{

        background-color: #142850;
        border: 2px solid #2C74B3;
        color: #F1EFEF;
        padding: 3.5%;
        margin-top: 3%;
        margin-bottom: 5%;
        margin-left: 15%;
        margin-right: 15%;
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

    tr{

        background-color: #2C74B3;

    }

    footer{

        background-color: #142850;
        border: 2px solid #2C74B3;
        text-align: center;
        margin: 1%;
        padding: 2%;
        border-radius: 10px;
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
    }

    form{

        display: flex;
        flex-direction: column;
        max-width:15%;
        background-color: #0A2647;
        border: 5px solid #144272;
        padding-top: 5%;
        padding-bottom: 5%;
        padding-left: 10%;
        padding-right: 15%;
        border-radius: 10px;
        margin-left: 30%;
        margin-right: 2%;

    }

    textarea{

        border: 5px solid #2C74B3;
        border-radius: 5px;

    }

    input{

        border: 5px solid #2C74B3;
        border-radius: 5px;

    }

    a:hover{

        background-color: #2C74B3;
        color: #fff;

    }



    .calificacion{

        background-color: #0A2647;
        border: 5px solid #144272;
        padding: 1%;
        border-radius: 10px;
        margin-left: 10%;
        margin-right: 10%;

    }

    .boton{

        color: #F1EFEF;
        margin-top: 0%;
        margin-bottom: 3%;
        margin-left: 60%;
        margin-right: 1%;
        padding: 1%;
        border-radius: 10px;
        text-decoration: none;
        position: absolute;
    }

    .boton_c{

        color: #F1EFEF;
        margin-top: 0%;
        margin-bottom: 3%;
        margin-left: 55%;
        margin-right: 1%;
        padding: 1%;
        border-radius: 10px;
        text-decoration: none;
        position: absolute;

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


</style>

<body>
    
    <header>

        <h1>
            Perfil del trabajador
        </h1>

        <div id="menu">
            <ul>
                <li> <a href="MaqPerfilTrabajador.html">Perfil</a></li>
                <li> <a href="ganancias.html">Ganancias</a></li>
                <li> <a href="historial_de_pedidos.html">Pedidos anteriores</a></li>
                <li> <a href="billetera.html">Billetera</a></li>
                <li> <a href="soporte.html">Soporte</a></li>
                <li> <a href="politica de privacidad.html">Politíca de Privacidad</a></li>
                <li><a href="EliminarCuentaT.html">Eliminar cuenta</a></li>
                <li> <a href="InicioT.html">Cerrar sesion</a></li>
            
            
            </ul>
        </div>

    </header>

    <section>
    <form method="post" action="">
        <div class="perfil">
            <label>Nombre:</label>
            <input type="text" name="Nombre_Trabajador" value="<?php echo htmlspecialchars($Nombre_Trabajador); ?>" readonly>

            <label>Correo:</label>
            <input type="text" name="Correo_Trabajador" value="<?php echo htmlspecialchars($Correo_Trabajador); ?>">

            <label>Profesión:</label>
            <input type="text" name="Profesion" value="<?php echo htmlspecialchars($Profesion); ?>" readonly>

            <label>Contraseña:</label>
            <input type="text" name="contraseña" value="<?php echo htmlspecialchars($contraseña); ?>">

            <label>Descripción:</label>
            <textarea name="Descripcion" id="desc" cols="30" rows="10"><?php echo htmlspecialchars($Descripcion); ?></textarea>
        </div>

        <input type="submit" value="Actualizar" name="submit">
    </form>

    <div class="boton"><a href="perfilTrabajador.html">Guardar</a></div>
    <div class="boton_c"><a href="perfilTrabajador.html">Cancelar</a></div>

    <section>      
        <div class="calificacion">
            <p>Calificación: <?php echo isset($calificacion) ? htmlspecialchars($calificacion) : ''; ?></p>
        </div>
    </section>
</section>
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