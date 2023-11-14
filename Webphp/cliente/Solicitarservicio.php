<?php
session_start();

if (isset($_SESSION['Correo_Cliente']) && isset($_SESSION['ID_cliente'])) {
    $correo = $_SESSION['Correo_Cliente'];
    $Correo_Cliente = $_SESSION['Correo_Cliente'];
    $contraseñaC = $_SESSION['contraseña'];
} else {
    header("Location: inicioclientes.php");
    exit();
}

$rut_trabajador = isset($_GET["Rut_Trabajador"]) ? $_GET["Rut_Trabajador"] : "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tipo_servicio = isset($_POST["tipo_servicio"]) ? $_POST["tipo_servicio"] : "";
    $grado = isset($_POST["grado"]) ? $_POST["grado"] : "";
    $descripcion = isset($_POST["descripcion"]) ? $_POST["descripcion"] : "";
    $precio = isset($_POST["precio"]) ? floatval($_POST["precio"]) : 0.0;

    if (empty($tipo_servicio) || empty($descripcion) || $precio <= 0 || empty($rut_trabajador)) {
        echo "Por favor, complete todos los campos requeridos.";
    } else {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "techome";
        $conn = new mysqli($servername, $username, $password, $database);
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }
        $check_query = "SELECT Rut_trabajador FROM trabajador WHERE Rut_trabajador = ?";
        $check_stmt = $conn->prepare($check_query);
        $check_stmt->bind_param("s", $rut_trabajador);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();

        if ($check_result->num_rows > 0) {
            $sql = "INSERT INTO solicitudservicio (tipo_servicio, descripcion, ID_cliente, precio, Rut_trabajador, Grado) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            if ($stmt) {
                $stmt->bind_param("sssdss", $tipo_servicio, $descripcion, $_SESSION['ID_cliente'], $precio, $rut_trabajador, $grado);
                if ($stmt->execute()) {
                    echo "Solicitud de servicio enviada con éxito.";
                } else {
                    echo "Error al enviar la solicitud de servicio: " . $stmt->error;
                }
                $stmt->close();
            } else {
                echo "Error en la preparación de la sentencia: " . $conn->error;
            }
        } else {
            echo "El Rut_Trabajador especificado no existe en la base de datos.";
        }
        $check_stmt->close();
        $conn->close();
    }
} else {
    echo "Rut del trabajador desde el enlace: " . $rut_trabajador . "<br>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    
<Style>
    body{
            background-color: #27496D;
            color: #F1EFEF;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        }

        .Titulo{
            background-color: #142850;
            border: 2px solid #2C74B3;
            text-align: center;
            margin-top: 1%;
            margin-bottom: 1%;
            margin-left: 1%;
            margin-right: 5%;
            padding: 2%;
            border-radius: 10px;
        }

        .Servicios{
            background-color: #142850;
            border: 2px solid #2C74B3;
            margin-top: 1%;
            margin-bottom: 1%;
            margin-left: 1%;
            margin-right: 5%;
            padding: 8%;
            border-radius: 10px;
        }

        .Almacenador{
            display: flex;
            background-color: #D3D3D3;
            border: 2px solid #2C74B3;
            margin-top: 1%;
            margin-bottom: 1%;
            margin-left: 1%;
            margin-right: 5%;
            padding: 2%;
            border-radius: 10px;
            padding: 10%;
        }

        .Descripcion{
            border: 2px solid grey;
            text-align: center;
            width: 80%;
            margin-top: 1%;
            margin-bottom: 1%;
            margin-left: 5%;
            margin-right: 5%;
            padding: 2%;
            border-radius: 10px;
            padding: 10%;
            resize: none;
        }

        .Boton1{
            
            background-color: #F8DE81;
            border: 2px solid grey;
            border-radius: 10px;
            margin-top: 10%;
            margin-bottom: 1%;
            margin-left: 1%;
            margin-right: 1%;
            width: 24%;
            height: 22%;
            padding: 10px;
        }

        .Boton2{
            background-color: #F08080;
            border: 2px solid grey;
            border-radius: 10px;
            margin-top: 10%;
            margin-bottom: 1%;
            margin-left: 1%;
            margin-right: 1%;
            width: 22%;
            height: 22%;
            padding: 10px;
        }

        .Almacenador span{
            position: absolute;
            bottom: 43%;
            left: 40%;
            color: black;
        }

        #wordCount{
            margin: -5px;
            left: 50%;
        }

        .Precio{
            border-radius: 10px;
            border: 2px solid grey;
            width: 40%;
            height: 10%;
            margin-top: 8%;
            margin-left: 5%;
        }

        footer{ 
            background-color: #142850;
            border: 2px solid #2C74B3;
            text-align: center;
            margin-top: 1%;
            margin-bottom: 1%;
            margin-left: 1%;
            margin-right: 5%;
            padding: 2%;
            border-radius: 10px;
        }

        .tipo{
            color: black;
        }

        .grado{
            color: black;
        }

    </style>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TecHome</title>

</head>
<body>
<div class="Titulo">
    <h1>Solicitud de Servicio</h1>
</div>

<div class="Servicios">
    <div class="Almacenador">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'] . '?Rut_Trabajador=' . $rut_trabajador; ?>">
            <label class="tipo" for="tipo">Tipo de Servicio:</label>
            <select id="tipo_servicio" name="tipo_servicio">
                <option value="Reparacion">Reparación</option>
                <option value="Chequeo">Chequeo</option>
                <option value="Mantenimiento">Mantenimiento</option>
            </select>

            <label class="grado" for="grado">Grado:</label>
            <select id="grado" name="grado">
                <option value="Basico">Básico</option>
                <option value="Medio">Medio</option>
                <option value="Urgente">Urgente</option>
            </select>
            <textarea id="nota" class="Descripcion" name="descripcion" cols="30" placeholder="Descripcion del Servicio" oninput="checkWordCount(this);"></textarea>
            <span id="wordCount">0 palabras</span>
            <input type="number" class="Precio" id="Precio" name="precio" placeholder="Precio">
            <div>
                <input class="Boton1" type="submit" value="Enviar">
                <input class="Boton2" type="button" value="Borrar" onclick="borrarDescripcion()">
            </div>
        </form>
    </div>
</div>


    <script>
            
        function checkWordCount(textarea) {
            var text = textarea.value;
            var words = text.split(/\s+/).filter(function(word) {
                return word.length > 0;
            });
            var wordCount = words.length;

            document.getElementById("wordCount").textContent = wordCount + " palabra" + (wordCount !== 1 ? "s" : "");

            if (wordCount > 600) {
                textarea.value = text.split(/\s+/).slice(0, 600).join(" ");
            }
        }

        function borrarDescripcion() {
            var descripcion = document.getElementById("nota");
            descripcion.value = "";
            var wordCount = document.getElementById("wordCount");
            wordCount.textContent = "0 palabras";
        }
    </script>
    <footer>TecHome® 2023 | Derechos reservados</footer>
</body>
</html>
