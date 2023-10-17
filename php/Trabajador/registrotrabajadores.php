<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "techome";

$conn = new mysqli($servername, $username, $password, $database);

$correcto = "Registrado exitosamente";
$incorrecto = "Error al registrar";

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rut = $_POST["rut"];
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $titulos = $_POST["titulos"];
    $profesion = $_POST["profesion"];

    $profesionesValidas = ["mecanico", "electricista", "informatico", "gasfiteria", "carpinteria"];
    if (!in_array($profesion, $profesionesValidas)) {
        die("La profesión ingresada no es válida.");
    }

    $sql = "INSERT INTO trabajadores (Rut_Trabajador, Nombre_Trabajador, Correo_Trabajador, Titulos, Profesion)
            VALUES ('$rut', '$nombre', '$correo', '$titulos', '$profesion')";

    if ($conn->query($sql) === TRUE) {
        echo "<p class='st_correcto'>$correcto</p>";
    } else {
        echo "<p class='st_incorrecto'>$incorrecto</p>" . $conn->error;
    }
}


$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registro de Trabajador</title>
</head>

<style>

    body {
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


    .Box{
        padding: 20px;
        margin-left: 43%;
        margin-right: 43%;
        margin-top: 90px;
        background-color: #f2f2f2;
        border-radius: 5px;
    }


</style>

<body>
    <header>
        <h1>Registro de Trabajador</h1>
    </header>

    <div class = "Box">
            <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                Rut: <input type="text" name="rut" required><br>
                Nombre: <input type="text" name="nombre" required><br>
                Correo: <input type="email" name="correo" required><br>
                Titulos: <input type="text" name="titulos"><br>
                Profesión: 
                    <select name="profesion">
                        <option value="mecanico">Mecánico</option>
                        <option value="electricista">Electricista</option>
                        <option value="informatico">Informático</option>
                        <option value="gasfiteria">Gasfitería</option>
                        <option value="carpinteria">Carpintería</option>
            </select><br>
        <input type="submit" value="Registrar Trabajador">
        </form>
    </div>

    <footer>TecHome® 2023 | Derechos reservados</footer>

</body>
</html>