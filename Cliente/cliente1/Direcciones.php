<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["ID_Direccion"]) && isset($_POST["Direccion"]) && isset($_POST["Indicaciones"]) && isset($_POST["Ciudad"]) && isset($_POST["Region"])) {
    // Conecta a la base de datos (asegúrate de proporcionar las credenciales correctas)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "techome";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica la conexión a la base de datos
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Obtiene los valores de la solicitud POST
    $ID_Direccion = $_POST["ID_Direccion"];
    $region = $_POST["Region"];
    $ciudad = $_POST["Ciudad"];
    $direccion = $_POST["Direccion"];
    $indicaciones = $_POST["Indicaciones"];

    // Prepara y ejecuta la consulta SQL para insertar la dirección en la base de datos
    $sql = "INSERT INTO direcciones (ID_Direcion, Direccion, Indicaciones, Ciudad, Region) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $ID_Direccion, $direccion, $indicaciones, $ciudad, $region);
    
    if ($stmt->execute()) {
        // La dirección se ha agregado correctamente a la base de datos
        echo "Dirección agregada con éxito.";
    } else {
        echo "Error al agregar la dirección: " . $stmt->error;
    }

    // Cierra la conexión a la base de datos
    $stmt->close();
    $conn->close();
}
?>
