<!DOCTYPE html>
<html>
<head>
    <title>Registro de Cliente</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<style>

body {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    margin: 0;
    padding: 0;
    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
}

    header{

        background-color: #0d3c6e;
        color: #fff;
        text-align: center;
        padding: 25px;
        margin-top: -11px;
        margin-left: 0px;
        margin-right: 0px;

    }

    footer{ 

        color: #fff;
        text-align: center;
        background-color: #0d3c6e;
        margin-top: 252px;
        margin-bottom: -10px;
        margin-left: 0px;
        margin-right: 0px;

    }

    input{
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        display: block;
        margin-bottom: 0px;
        margin-top: 0%;
    }

    select{
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        display: block;
        margin-bottom: 10px;
        margin-top: 0%;
    }

    .st_correcto{

        position: absolute;
        bottom: 0;
        left: 0;
        background-color: #90ee90;
        display: block;
        border-radius: 5px;
        color: #fff;
        padding: 10px;
        margin-left: 44.2%;
        margin-bottom: 190px;
        width: 200px;
        text-align: center;
    }

        .st_incorrecto{

            position: absolute;
            bottom: 0;
            left: 0;
            background-color: #fa7268;
            display: block;
            border-radius: 5px;
            color: #fff;
            padding: 10px;
            margin-left: 44.2%;
            margin-bottom: 190px;
            width: 200px;
            text-align: center;
        }

        .Box {
    padding: 20px;
    margin-left: auto;
    margin-right: auto;
    margin-top: 90px;
    background-color: #f2f2f2;
    border-radius: 5px;
    text-align: center; 
}

input, select, label {
    margin-bottom: 10px;
}



</style>
<body>
    <h1>Registro de Cliente</h1>
    <?php

    $host = "localhost";
    $usuario = "root";
    $contrasena = "";
    $base_datos = "techome";


    function generarIDUnico($conexion) {
        return rand(1000, 9999);
    }


    function generarDireccion() {
        $direccion = "Calle " . rand(1, 100);
        $indicaciones = "Indicaciones " . rand(1, 10);
        $ciudad = "Ciudad " . rand(1, 5);
        $region = "Región " . rand(1, 3);
        return [$direccion, $indicaciones, $ciudad, $region];
    }


    function verificarCorreoExistente($conexion, $correo) {
        $sql = "SELECT Correo_Cliente FROM clientes WHERE Correo_Cliente = '$correo'";
        $result = $conexion->query($sql);
        return $result && $result->num_rows > 0; 
    }


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['nombre']) && isset($_POST['correo']) && isset($_POST['contraseña']) && isset($_POST['confirmar_contrasena'])) {

            $conexion = new mysqli($host, $usuario, $contrasena, $base_datos);
            if ($conexion->connect_error) {
                die("Error de conexión a la base de datos: " . $conexion->connect_error);
            }


            $nombre = $_POST['nombre'];
            $correo = $_POST['correo'];
            $contrasena = $_POST['contraseña'];
            $confirmar_contrasena = $_POST['confirmar_contrasena'];

            if (verificarCorreoExistente($conexion, $correo)) {
                echo "Ya existe un cliente con este correo electrónico.";
            } elseif ($contrasena !== $confirmar_contrasena) {
                echo "Las contraseñas no coinciden.";
            } else {

                list($direccion, $indicaciones, $ciudad, $region) = generarDireccion();


                $id_cliente = generarIDUnico($conexion);
                $id_direccion = generarIDUnico($conexion);

                $sql = "INSERT INTO direccion (ID_Direccion, Direccion, Indicaciones, Ciudad, Region) VALUES ('$id_direccion', '$direccion', '$indicaciones', '$ciudad', '$region')";
                if ($conexion->query($sql) === TRUE) {

                    $sql = "INSERT INTO clientes (Correo_Cliente, Nombre_cliente, Contraseña, ID_Direccion) VALUES ('$correo','$nombre','$contrasena', '$id_direccion')";
                    if ($conexion->query($sql) === TRUE) {
                        echo "Registro exitoso.";
                    } else {

                        echo "Error al registrar el cliente: " . $conexion->error;
                    }
                } else {
                    echo "Error al registrar la dirección: " . $conexion->error;
                }
            }


            $conexion->close();
        }
    }
    ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required><br>

        <label for="correo">Correo:</label>
        <input type="email" name="correo" required><br>

        <label for="contraseña">Contraseña:</label>
        <input type="password" name="contraseña" required><br>

        <label for="confirmar_contrasena">Confirmar Contraseña:</label>
        <input type="password" name="confirmar_contrasena" required><br>

        <input type="submit" value="Registrar">
    </form>
</body>
</html>
