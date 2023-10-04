<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["ID_Direccion"]) && isset($_POST["Direccion"]) && isset($_POST["Indicaciones"]) && isset($_POST["Ciudad"]) && isset($_POST["Region"])) {
    // Conecta a la base de datos (asegúrate de proporcionar las credenciales correctas)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "techome";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($mysqli->connect_error) {
        die("Error en la conexión a la base de datos: " . $mysqli->connect_error);
    }

    // Operación DELETE - Eliminar una dirección por su ID
    if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
        parse_str(file_get_contents("php://input"), $data);
        $id = $data["id"];

        $sql = "DELETE FROM direcciones WHERE id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo json_encode(["message" => "Dirección eliminada con éxito"]);
        } else {
            echo json_encode(["error" => "Error al eliminar la dirección: " . $stmt->error]);
        }
    }

    // Cerrar la conexión
    $mysqli->close();
}
?>
