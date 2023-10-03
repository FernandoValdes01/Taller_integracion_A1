<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["ID_Direccion"]) && isset($_POST["Direccion"]) && isset($_POST["Indicaciones"]) && isset($_POST["Ciudad"]) && isset($_POST["Region"])) {
    // Conecta a la base de datos (asegúrate de proporcionar las credenciales correctas)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "techome";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Error de conexión a la base de datos: " . $conn->connect_error);
    }

    // Operación para actualizar una dirección
    if (isset($_POST["actualizarDireccion"])) {
        $id = $_POST["id"];
        $region = $_POST["region"];
        $ciudad = $_POST["ciudad"];
        $direccion = $_POST["direccion"];
        $indicaciones = $_POST["indicaciones"];

        $sql = "UPDATE direcciones SET region='$region', ciudad='$ciudad', direccion='$direccion', indicaciones='$indicaciones' WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            echo json_encode(["message" => "Dirección actualizada con éxito"]);
        } else {
            echo json_encode(["error" => "Error al actualizar la dirección: " . $conn->error]);
        }
    }

    // Cierra la conexión a la base de datos
    $conn->close();
}
?>
