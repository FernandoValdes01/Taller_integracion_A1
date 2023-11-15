<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "techome";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$nuevaContrasena = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    function generarContrasena($longitud = 8) {
        $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $longitudCaracteres = strlen($caracteres);
        $contrasena = '';
        for ($i = 0; $i < $longitud; $i++) {
            $contrasena .= $caracteres[rand(0, $longitudCaracteres - 1)];
        }
        return $contrasena;
    }

    if (isset($_POST['correo'])) {
        $correo = $_POST['correo'];

        $nuevaContrasena = generarContrasena();

        $sql = "UPDATE clientes SET contraseña = '$nuevaContrasena' WHERE Correo_Cliente = '$correo'";

        if ($conn->query($sql) === TRUE) {
        } else {
            echo "Error actualizando contraseña: " . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cambio de Contraseña</title>
    <style>
body {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
    color: #ffffff;
    background-color:  #27496D;
    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
}
a {
    color: #fff;
    text-decoration: none;
}
.formulario {
    width: 300px;
    padding: 20px;
    border: 2px solid #b4c6d2;
    border-radius: 10px;
    background-color: #142850;
    color: #ffffff;
}
.formulario label {
    display: block;
    margin-bottom: 10px;
    color: #ffffff;
}
.formulario input[type="email"] {
    width: calc(100% - 20px);
    padding: 10px;
    margin-bottom: 20px;
    border-radius: 5px;
    border: 1px solid #d9e2ec;
    color: #ffffff;
}
.formulario input[type="submit"] {
    width: calc(100% - 20px);
    padding: 10px;
    border-radius: 5px;
    border: none;
    background-color: #3498db;
    color: #ffffff;
    cursor: pointer;
}
.formulario input[type="submit"]:hover {
    background-color: #2576a9;
}
footer {
    background-color: #142850;
    border: 2px solid #2C74B3;
    text-align: center;
    margin: 1%;
    padding: 2%;
    border-radius: 10px;
    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
    color: #ffffff;
}

    </style>
</head>
<body>
    <div class="formulario">
        <h2 style="text-align: center; color: #223b57;">Cambio de Contraseña</h2>
        <form method="post">
            <label for="correo">Correo electrónico:</label>
            <input type="email" id="correo" name="correo"><br><br>
            <input type="submit" value="Cambiar Contraseña">
            <?php if ($nuevaContrasena !== "") : ?>
                <label for="nueva-contrasena">Nueva Contraseña:</label>
                <input type="text" id="nueva-contrasena" value="<?php echo $nuevaContrasena; ?>" readonly>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>