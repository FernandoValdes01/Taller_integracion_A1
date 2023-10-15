
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Trabajador</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #007bff;
            color: #fff;
            text-align: center;
            padding: 20px 0;
        }

        h1 {
            margin: 0;
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
            display: flex;
            flex-wrap: wrap;
        }

        li {
            flex: 1;
            background-color: #f0f0f0;
            padding: 20px;
            text-align: center;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        p {
            margin: 5px 0 0;
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

    </style>
</head>
<body>
    <header>
        <h1>[Servicio de Carpinteria] Disponible</h1>
    </header>
    <div class="trabajos-disponibles">
        <h2>Informaticos Disponibles</h2>
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

            $sql = "SELECT * FROM trabajador WHERE Profesion = 'carpintero'";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<li>";
                    echo "<div class='Trabajador'>";
                    echo "<h3> Nombre: " . $row["Nombre_Trabajador"] . "</h3><br>";
                    echo "<p>Rut: " . $row["Rut_Trabajador"] . "</p><br>";
                    echo "<p>Correo: " . $row["Correo_Trabajador"] . "</p><br>";
                    echo "<button class='solicitarServicio'>Solicitar Servicio</button>";
                    echo "</div>";
                    echo "</li>";
                }
            } else {
                echo "No se encontraron trabajadores con la profesión 'carpintero'.";
            }

            $conn->close();
            ?>

        </ul>
    </div>
</script>
</body>
</html>
