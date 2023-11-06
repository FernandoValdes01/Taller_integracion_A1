
<?php
session_start();

if (!(isset($_SESSION['nombre_Cliente']) && isset($_SESSION['Correo_Cliente']))) {
    header("Location: inicioclientes.php");
    exit();
}


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "techome";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo "<script>alert('Conexión fallida: ".$conn->connect_error."');</script>";
}
$nombre = isset($_SESSION['nombre_Cliente']) ? $_SESSION['nombre_Cliente'] : '';
$correo = isset($_SESSION['Correo_Cliente']) ? $_SESSION['Correo_Cliente'] : '';

if (isset($_POST['actualizar'])) {
    $nuevo_nombre = $_POST['nombre'];
    $nuevo_correo = $_POST['correo']; // Nuevo valor del correo

    $sql = "UPDATE clientes SET nombre_Cliente='$nuevo_nombre', Correo_Cliente='$nuevo_correo' WHERE Correo_Cliente='$correo'";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['nombre_Cliente'] = $nuevo_nombre; // Actualizar nombre en la sesión
        $_SESSION['Correo_Cliente'] = $nuevo_correo; // Actualizar correo en la sesión
        echo "<script>alert('Registro actualizado exitosamente');</script>";
    } else {
        echo "<script>alert('Error al actualizar el registro: " . $conn->error . "');</script>";
    }
}

if (isset($_POST['cambiar'])) {
    $contrasena = $_POST['contrasena'];
    $sql = "UPDATE clientes SET contraseña='$contrasena' WHERE Correo_Cliente='$correo'";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Contraseña actualizada exitosamente');</script>";
    } else {
        echo "<script>alert('Error al actualizar la contraseña: ".$conn->error."');</script>";
    }
}

if (isset($_POST['eliminar_cuenta'])) {
    $contrasena = $_POST['password'];
    $sql = "SELECT contraseña, ID_cliente, ID_direccion FROM clientes WHERE Correo_Cliente='$correo'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($contrasena == $row['contraseña']) {
            $id_cliente = $row['ID_cliente'];
            $id_direccion = $row['ID_direccion'];

            // Eliminar referencias en la tabla clientes
            $sql_delete_clientes = "DELETE FROM clientes WHERE ID_cliente='$id_cliente'";

            if ($conn->query($sql_delete_clientes) === TRUE) {
                // Eliminar registros en direccion
                $sql_delete_direccion = "DELETE FROM direccion WHERE ID_direccion='$id_direccion'";

                if ($conn->query($sql_delete_direccion) === TRUE) {
                    session_destroy();
                    echo "<script>alert('Cuenta y registros relacionados eliminados exitosamente');</script>";
                } else {
                    echo "<script>alert('Error al eliminar registros en la tabla de direccion: " . $conn->error . "');</script>";
                }
            } else {
                echo "<script>alert('Error al eliminar registros en la tabla de clientes: " . $conn->error . "');</script>";
            }
        } else {
            echo "<script>alert('La contraseña ingresada no coincide con la contraseña actual');</script>";
        }
    } else {
        echo "<script>alert('No se encontró ninguna cuenta asociada a este correo electrónico');</script>";
    }
}


if (isset($_POST['logout'])) {
    session_destroy(); 
    echo "<script>alert('Has cerrado la sesión exitosamente'); window.location.href = 'login.php';</script>";
    exit();
}

$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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
            padding: 3%;
            border-radius: 10px;
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

        a{

            text-decoration: none;
            color: #fff;

        }


        button.button-style {
        background-color: #142850;
        border: 2px solid #2C74B3;
        color: #F1EFEF;
        border-radius: 5px;
        padding: 0.5%;
        width: 100%;
        margin-bottom: 10px;
        }
        input{

            background-color: #142850;
            border: 2px solid #2C74B3;
            border-radius: 10px;

        }

        section{

            background-color: #0A2647;
            border: 3px solid #144272;
            padding-top: 5%;
            padding-bottom: 5%;
            padding-left: 5%;
            padding-right: 7%;
            border-radius: 10px;

        }

        button:hover{

            background-color: #2C74B3;
            color: #fff;


        }

        .secondbutton{

            margin-bottom: 10%;

        }

        .container {
            max-width: 960px;
            margin-top: auto;
            margin-bottom: auto;
            margin-left: auto;
            margin-right: auto;
            padding: 20px;
        }
        .profile-section {
            margin-top: 3%;
        }
        .profile-section h2 {
            margin-bottom: 10px;
        }
        .profile-section label {
            display: block;
            margin-bottom: 10px;
        }
        .profile-section input[type="text"],
        .profile-section input[type="password"],
        .profile-section input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 3px;
        }
        .profile-section button {
            float: right;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        h1 {    
            margin: 0;
        }

        .trabajador-info {
            text-align: center;
            padding: 20px;
        }
        .trabajador-avatar {
            border-radius: 50%;
            width: 100px;
            height: 100px;
            background-color: #fff;
            display: inline-block;
        }
        .trabajador-nombre {
            font-size: 24px;
            margin-top: 10px;
        }
        .trabajos-disponibles {
            background-color: #fff;
            padding: 20px;
            margin: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            list-style-type: none;
            padding: 0;
        }
        .trabajo {
            background-color: #0A2647;
            border: 3px solid #144272;
            padding: 3%;
            border-radius: 10px;
        }

        #passtext{

            margin-top: 20px;
            padding-top: 50px;

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
            padding: 20px;
            text-align: center;
            margin-top: 10px;
            margin-bottom: 10px;
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
    <header>
        <h1>Configuración del Cliente - TecHome</h1>
        </header>
<div class="container">
    <div class="profile-section">
        <h2>Tu Perfil</h2>
        <div class="container">
            <div class="trabajo">
                <h3></h3>
                <label for="nombre">Nombre:</label>
                <span id="nombre-actual"><?php echo $nombre; ?></span>
                <br>
                <label for="email">Correo Electrónico (Gmail):</label>
                <span id="email-actual"><?php echo $correo; ?></span>
            </div>
        </div>
        <form method="post" action="">
            <div id="changeinf">
                <h2>Cambiar Nombre y Correo Electrónico</h2>
                <label for="nombre">Nuevo Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>" required>
                <br>
                <label for="correo">Nuevo Correo Electrónico:</label>
                <input type="email" id="correo" name="correo" value="<?php echo $correo; ?>" required>
                <button type="submit" name="actualizar">Actualizar Perfil</button>
            </div>
        </form>
        <form method="post" action="">
            <div id="passtext">
                <h2>Cambiar Contraseña</h2>
                <label for="contrasena">Nueva Contraseña:</label>
                <input type="password" id="contrasena" name="contrasena" required>
                <button type="submit" name="cambiar">Cambiar Contraseña</button>
            </div>
        </form>
        <h2>Cerrar Sesión</h2>
        <form method="post" action="">
            <button class="button-style" type="submit" name="logout">Cerrar Sesión</button>
        </form>
        <form method="post" action="">
            <div id="eliminar_cuenta">
                <h2>Eliminar Cuenta</h2>
            </div>
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit" name="eliminar_cuenta">Eliminar Cuenta</button>
        </form>
    </div>
</div>
</body>
</html>
