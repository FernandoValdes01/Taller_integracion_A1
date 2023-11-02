<?php
    session_start();

    if (!isset($_SESSION['Correo_Cliente'])) {
        header("Location: inicioclientes.php");
        exit();
    }

    $server = "localhost";
    $usuario = "root";
    $contrasena = "";
    $basededatos = "techome";

    $conexion = new mysqli($server, $usuario, $contrasena, $basededatos);

    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    $correo = $_SESSION['Correo_Cliente'];
    $Correo_Cliente = $_SESSION['Correo_Cliente'];
    $nombre = $_SESSION['nombre_Cliente'];
    $contraseñaC = $_SESSION['contraseña'];

    $sql = "SELECT Nombre_cliente, Correo_Cliente, Contraseña FROM clientes WHERE Correo_Cliente = '$correo'";
    $result = $conexion->query($sql);

    $_SESSION['Correo_Cliente'] = $correo;
    $_SESSION['nombre_Cliente'] = $nombre;
    $_SESSION['contraseña'] = $contraseñaC;


    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (isset($_POST["nombre"]) && isset($_POST["email"]) && isset($_POST["contrasena"])) {
            $nuevo_nombre = $_POST["nombre"];
            $nuevo_email = $_POST["email"];
            $nueva_contraseña = $_POST["contrasena"];

            // Actualizar el perfil en la base de datos
            $sql = "UPDATE clientes SET nombre_cliente='$nuevo_nombre', Correo_Cliente='$nuevo_email', Contraseña='$nueva_contraseña' WHERE Correo_Cliente='$correo'";

            if ($conexion->query($sql) === TRUE) {
                $_SESSION['nombre_Cliente'] = $nuevo_nombre;
                $_SESSION['Correo_Cliente'] = $nuevo_email;
                $_SESSION['contraseña'] = $nueva_contraseña;
                echo "Perfil actualizado con éxito.";
            } else {
                echo "Error al actualizar el perfil: " . $conexion->error;
            }
            
        } else {
            echo "Error: Alguno de los campos del formulario no se envió correctamente.";
        }
    }

    $conexion->close();
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Trabajador</title>

    <style>
        body{
            background-color: #27496D;
            color: #F1EFEF;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        }  

        header{
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

        h1 {
            margin: 0;
        }

        .Trabajador{
            color: white;
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

        .trabajos-disponibles {
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

        ul {
            list-style-type: none;
            padding: 0;
            display: flex;
            flex-wrap: wrap;
        }

        li {
            flex: 1;
            background-color: #142850;
            padding: 20px;
            text-align: center;
            border: 1px solid #2C74B3;
            border-radius: 5px;
        }

        p {
            margin: 5px 0;
        }

        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .SolicitarServicio{
            text-decoration: none;
            background-color: #142850;
            color: white;
            border: 2px solid #2C74B3;
            text-align: center;
            margin: 1%;
            padding: 2%;
            border-radius: 10px;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        }

        .SolicitarServicio:hover{
            background-color: #2C74B3;
            color: #fff;
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

    </style>
</head>
<body>
    <header>
        <h1>[Servicio de Electricista] Disponible</h1>
    </header>
    <div class="trabajos-disponibles">
        <h2>Electricistas Disponibles</h2>
        <ul>
        <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "techome";

            $conn = new mysqli($servername, $username, $password, $database);

            if ($conn->connect_error) {
                die("Error de conexión: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM trabajador WHERE Profesion = 'electricista'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<li>";
                    echo "<div class='Trabajador'>";
                    echo "<h3>Nombre: " . $row["Nombre_Trabajador"] . "</h3><br>";
                    echo "<p>Rut: " . $row["Rut_trabajador"] . "</p><br>";
                    echo "<a href='Solicitarservicio.php?Rut_Trabajador=" . $row["Rut_trabajador"] . "'>Enviar solicitud de servicio</a>";
                    echo "<p>Correo: " . $row["Correo_Trabajador"] . "</p><br>";
                    echo "<a class='SolicitarServicio' href='SolicitudServicio.php?tipo_servicio=electricista&Correo_Cliente={$Correo_Cliente}'>Solicitar Servicio</a>";
                    echo "</div>";
                    echo "</li>";
                }
            } else {
                echo "No se encontraron trabajadores con la profesión 'Electricista'.";
            }

            $conn->close();
        ?>
        </ul>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('.SolicitarServicio');
            buttons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const rutTrabajador = button.getAttribute('data-rut');
                    window.location.href = `SolicitudServicio.php?Rut_Trabajador=${rutTrabajador}`;
                });
            });
        });
    </script>
    <footer>TecHome® 2023 | Derechos reservados</footer>
</body>
</html>
