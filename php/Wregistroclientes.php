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
    text-align: center; /* Para centrar el contenido horizontalmente */
}

input, select, label {
    margin-bottom: 10px;
}



</style>
<body>
    <h1>Registro de Cliente</h1>
    <?php
    // Configuración de la conexión a la base de datos
    $host = "localhost";
    $usuario = "root";
    $contrasena = "";
    $base_datos = "techome";

    // Función para generar un ID único
    function generarIDUnico($conexion) {
        return rand(1000, 9999);
    }

    // Función para generar una dirección aleatoria
    function generarDireccion() {
        $direccion = "Calle " . rand(1, 100);
        $indicaciones = "Indicaciones " . rand(1, 10);
        $ciudad = "Ciudad " . rand(1, 5);
        $region = "Región " . rand(1, 3);
        return [$direccion, $indicaciones, $ciudad, $region];
    }

    // Función para verificar si un correo ya existe en la base de datos
    function verificarCorreoExistente($conexion, $correo) {
        $sql = "SELECT Correo_Cliente FROM clientes WHERE Correo_Cliente = '$correo'";
        $result = $conexion->query($sql);
        return $result && $result->num_rows > 0; 
    }

    // Verificar si la solicitud HTTP es de tipo POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['nombre']) && isset($_POST['correo']) && isset($_POST['contraseña']) && isset($_POST['confirmar_contrasena'])) {
            // Establecer la conexión a la base de datos
            $conexion = new mysqli($host, $usuario, $contrasena, $base_datos);
            if ($conexion->connect_error) {
                die("Error de conexión a la base de datos: " . $conexion->connect_error);
            }

            // Obtener datos del formulario
            $nombre = $_POST['nombre'];
            $correo = $_POST['correo'];
            $contrasena = $_POST['contraseña'];
            $confirmar_contrasena = $_POST['confirmar_contrasena'];

            // Verificar si el correo ya existe en la base de datos
            if (verificarCorreoExistente($conexion, $correo)) {
                echo "Ya existe un cliente con este correo electrónico.";
            } elseif ($contrasena !== $confirmar_contrasena) {
                echo "Las contraseñas no coinciden.";
            } else {
                // Generar una dirección aleatoria
                list($direccion, $indicaciones, $ciudad, $region) = generarDireccion();

                // Generar IDs únicos para cliente y dirección
                $id_cliente = generarIDUnico($conexion);
                $id_direccion = generarIDUnico($conexion);

                // Insertar la dirección en la base de datos
                $sql = "INSERT INTO direccion (ID_Direccion, Direccion, Indicaciones, Ciudad, Region) VALUES ('$id_direccion', '$direccion', '$indicaciones', '$ciudad', '$region')";
                if ($conexion->query($sql) === TRUE) {
                    // Insertar el cliente en la base de datos
                    $sql = "INSERT INTO clientes (Correo_Cliente, Nombre_cliente, Contraseña, ID_Direccion) VALUES ('$correo','$nombre','$contrasena', '$id_direccion')";
                    if ($conexion->query($sql) === TRUE) {
                        echo "Registro exitoso.";
                    } else {
                        // Manejar errores si la inserción del cliente falla
                        echo "Error al registrar el cliente: " . $conexion->error;
                    }
                } else {
                    // Manejar errores si la inserción de la dirección falla
                    echo "Error al registrar la dirección: " . $conexion->error;
                }
            }

            // Cerrar la conexión a la base de datos
            $conexion->close();
        }
    }
    ?>
    <!-- Formulario de registro -->
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
