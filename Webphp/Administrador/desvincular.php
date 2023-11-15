<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['rut'])) {
    header('Location:inicioAdministrador.php'); // Redirigir a la página de inicio de sesión si no está autenticado
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "techome";


$conn = new mysqli($servername, $username, $password, $dbname); 

function desvincularTrabajador($rut) {
    global $conn;
    // Eliminar de la tabla pedido_aceptado
    $sql_pedido = "DELETE FROM pedido_aceptado WHERE Rut_trabajador = '$rut'";
    mysqli_query($conn, $sql_pedido);

    // Eliminar de la tabla solicitudservicio
    $sql_solicitud = "DELETE FROM solicitudservicio WHERE Rut_trabajador = '$rut'";
    mysqli_query($conn, $sql_solicitud);

    // Eliminar de la tabla trabajador
    $sql_trabajador = "DELETE FROM trabajador WHERE Rut_trabajador = '$rut'";
    mysqli_query($conn, $sql_trabajador);
}

// Verificar si se hizo clic en el botón "Desvincular"
if (isset($_POST['desvincular'])) {
    $rut_trabajador = $_POST['rut_trabajador'];
    desvincularTrabajador($rut_trabajador);
}

// Obtener datos de trabajadores
$sql = "SELECT Rut_trabajador, Nombre_Trabajador, Profesion, Calificacion FROM trabajador";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trabajadores TecHome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
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

<div class="container mt-5">
<a href="menuadmin.php" class="btn btn-primary float-right mb-3">Menú Admin</a>
    <h2 class="mb-4">Trabajadores TecHome</h2>

    <?php
    // Mostrar datos de trabajadores
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='card mb-3'>";
        echo "<div class='card-body'>";
        echo "<h5 class='card-title'>{$row['Nombre_Trabajador']}</h5>";
        echo "<p class='card-text'>Rut: {$row['Rut_trabajador']}</p>";
        echo "<p class='card-text'>Profesión: {$row['Profesion']}</p>";
        echo "<p class='card-text'>Calificación: {$row['Calificacion']}</p>";
        echo "<form method='post' action=''>
                <input type='hidden' name='rut_trabajador' value='{$row['Rut_trabajador']}'>
                <button type='submit' name='desvincular' class='btn btn-danger'>Desvincular</button>
              </form>";
        echo "</div>";
        echo "</div>";
    }
    ?>

</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>