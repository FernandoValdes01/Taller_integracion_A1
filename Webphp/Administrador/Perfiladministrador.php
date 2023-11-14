<?php
session_start();

if (!(isset($_SESSION['rut']) && isset($_SESSION['nombre']))) {
    header("Location: iniciadministradores.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "techome";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo "<script>alert('Conexión fallida: " . $conn->connect_error . "');</script>";
}

$rut = isset($_SESSION['rut']) ? $_SESSION['rut'] : '';
$nombre = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : '';
$cargo = isset($_SESSION['cargo']) ? $_SESSION['cargo'] : '';

if (isset($_POST['actualizar'])) {
    $nuevo_nombre = $_POST['nombre'];
    $nuevo_cargo = $_POST['cargo']; // Nuevo valor del cargo

    $sql = "UPDATE administradores SET nombre_completo='$nuevo_nombre', cargo='$nuevo_cargo' WHERE Rut_administrador='$rut'";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['nombre'] = $nuevo_nombre; // Actualizar nombre en la sesión
        $_SESSION['cargo'] = $nuevo_cargo; // Actualizar cargo en la sesión
        echo "<script>alert('Registro actualizado exitosamente');</script>";
    } else {
        echo "<script>alert('Error al actualizar el registro: " . $conn->error . "');</script>";
    }
}

if (isset($_POST['cambiar'])) {
    $contrasena = $_POST['contrasena'];
    $sql = "UPDATE administradores SET Contraseña_Administrador='$contrasena' WHERE Rut_administrador='$rut'";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Contraseña actualizada exitosamente');</script>";
    } else {
        echo "<script>alert('Error al actualizar la contraseña: " . $conn->error . "');</script>";
    }
}

if (isset($_POST['eliminar_cuenta'])) {
    $contrasena = $_POST['password'];
    $sql = "SELECT Contraseña_Administrador FROM administradores WHERE Rut_administrador='$rut'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($contrasena == $row['Contraseña_Administrador']) {
            $sql_delete_admin = "DELETE FROM administradores WHERE Rut_administrador='$rut'";

            if ($conn->query($sql_delete_admin) === TRUE) {
                session_destroy();
                echo "<script>alert('Cuenta eliminada exitosamente');</script>";
            } else {
                echo "<script>alert('Error al eliminar cuenta: " . $conn->error . "');</script>";
            }
        } else {
            echo "<script>alert('La contraseña ingresada no coincide con la contraseña actual');</script>";
        }
    } else {
        echo "<script>alert('No se encontró ninguna cuenta asociada a este RUT');</script>";
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
            display: flex;
            justify-content: center;
            align-items: center;
            height: 99vh;
        }

        header {
            background-color: #142850;
            border: 2px solid #2C74B3;
            text-align: left;
            margin-top: 1%;
            margin-bottom: 1%;
            margin-left: 1%;
            margin-right: 6%;
            padding: 3%;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 99vh;
            border-radius: 9px;
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

        button.button-style {
        background-color: #142850;
        border: 2px solid #2C74B3;
        color: #F1EFEF;
        border-radius: 5px;
        padding: 0.5%;
        width: 99%;
        margin-bottom: 9px;
        }
        input{
            background-color: #142850;
            border: 2px solid #2C74B3;
            border-radius: 9px;
        }

        section{
            background-color: #0A2647;
            border: 3px solid #144272;
            padding-top: 5%;
            padding-bottom: 5%;
            padding-left: 5%;
            padding-right: 6%;
            border-radius: 9px;
        }

        button:hover{
            background-color: #2C74B3;
            color: #fff;
        }

        .secondbutton{
            margin-bottom: 9%;
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
            margin-bottom: 9px;
        }
        .profile-section label {
            display: block;
            margin-bottom: 9px;
        }
        .profile-section input[type="text"],
        .profile-section input[type="password"],
        .profile-section input[type="email"] {
            width: 99%;
            padding: 9px;
            margin-bottom: 20px;
            border-radius: 3px;
        }
        .profile-section button {
            float: right;
            padding: 9px 20px;
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
            width: 99px;
            height: 99px;
            background-color: #fff;
            display: inline-block;
        }
        .trabajador-nombre {
            font-size: 24px;
            margin-top: 9px;
        }
        .trabajos-disponibles {
            background-color: #fff;
            padding: 20px;
            margin: 20px;
            border-radius: 5px;
            box-shadow: 0 0 9px rgba(0, 0, 0, 0.1);
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
            border-radius: 9px;
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
        <h1>Configuración del Administrador - TecHome</h1>
    </header>
    <div class="container">
        <div class="profile-section">
            <h2>Tu Perfil</h2>
            <div class="container">
                <div class="trabajo">
                    <h3><?php echo $cargo; ?></h3>
                    <label for="nombre">Nombre:</label>
                    <span id="nombre-actual"><?php echo $nombre; ?></span>
                    <br>
                    <label for="rut">RUT:</label>
                    <span id="rut-actual"><?php echo $rut; ?></span>
                </div>
            </div>
            <form method="post" action="">
                <div id="changeinf">
                    <h2>Cambiar Nombre y Cargo</h2>
                    <label for="nombre">Nuevo Nombre:</label>
                    <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>" required>
                    <br>
                    <label for="cargo">Nuevo Cargo:</label>
                    <input type="text" id="cargo" name="cargo" value="<?php echo $cargo; ?>" required>
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
            <form method="post" action="desvincular.php">
    <button type="submit" name="desvincular_trabajador">Desvincular Trabajador</button>
            </form>
        </div>
    </div>
</body>
</html>