<!DOCTYPE html>
<html>
<head>
<script>
        function mostrarSolicitantes() {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var solicitantes = JSON.parse(this.responseText);
                    var table = "<table style='width:100%; margin-top: 20px; text-align: center;'><tr><th>Rut</th><th>Nombre</th><th>Correo</th><th>Profesión</th></tr>";
                    for (var i = 0; i < solicitantes.length; i++) {
                        table += "<tr><td>" + solicitantes[i].Rut_solicitante + "</td><td>" + solicitantes[i].Nombre_Solicitante + "</td><td>" + solicitantes[i].Correo_Solicitante + "</td><td>" + solicitantes[i].Profesion + "</td></tr>";
                    }
                    table += "</table>";
                    document.getElementById("solicitantesTabla").innerHTML = table;
                }
            };
            xhttp.open("GET", "obtener_solicitantes.php", true);
            xhttp.send();
        }

        window.onload = function() {
            mostrarSolicitantes();
        }
</script>
    <style>
        <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f7fc; /* Un tono claro de azul */
        }

        form {
            display: flex;
            flex-direction: column;
            background-color: #e6f1fc; /* Un tono ligeramente más oscuro de azul */
            padding: 20px;
            border-radius: 10px;
        }

        h1 {
            text-align: center;
            color: #1f5e9e; /* Un tono azul más oscuro para el título */
        }

        input[type=email] {
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #b9d6f2; /* Un tono más claro de azul para el borde */
        }

        button {
            padding: 10px;
            border-radius: 5px;
            border: none;
            background-color: #1f5e9e; /* Un tono azul más oscuro para el botón */
            color: #ffffff;
            cursor: pointer;
        }

        button:hover {
            background-color: #244f88; /* Un tono ligeramente más oscuro de azul cuando se pasa el cursor sobre el botón */
        }
    </style>
</head>
<body>

<h1>Aceptador de Solicitantes</h1>
    </style>
</head>
<body>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "techome";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if (isset($_POST['gmail'])) {
    $gmail = $_POST['gmail'];

    $sql_select = "SELECT * FROM solicitantes WHERE correo_solicitante = '$gmail'";
    $result = $conn->query($sql_select);

    if ($result && $result->num_rows > 0) {
        // Si hay resultados, almacenamos los datos en variables temporales
        while ($row = $result->fetch_assoc()) {
            $rut = $row["Rut_solicitante"];
            $nombre = $row["nombre_solicitante"];
            $correo = $row["correo_solicitante"];
            $profesion = isset($row["Profesion"]) ? $row["Profesion"] : '';

            // Eliminar los datos de la tabla de solicitantes
            $sql_delete = "DELETE FROM solicitantes WHERE correo_solicitante = '$gmail'";
            $conn->query($sql_delete);

            // Generar contraseña aleatoria
            $password = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(10/strlen($x)) )),1,10);

            // Insertar datos en la tabla de trabajadores
            $sql_insert = "INSERT INTO trabajador (Rut_Trabajador, Nombre_Trabajador, Correo_Trabajador, Profesion, Foto, Monto_Cuenta, Contraseña, Calificacion, Descripcion) 
            VALUES ('$rut', '$nombre', '$correo', '$profesion', '', '', '$password', '', '')";

            if ($conn->query($sql_insert) === TRUE) {
                echo "<script>alert('Se ha asignado la siguiente contraseña al nuevo trabajador: $password');</script>";
            } else {
                echo "Error: " . $sql_insert . "<br>" . $conn->error;
            }
        }
    } else {
        echo "No se encontraron resultados para el correo proporcionado.";
    }
}

$conn->close();
?>

<form method="post">
    <input type="email" name="gmail" placeholder="Ingrese el correo del solicitante">
    <button type="submit" onclick="mostrarSolicitantes(); return false;">Aceptar</button>
</form>

<div id="solicitantesTabla"></div>

</body>
</html>
