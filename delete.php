<?php


//$basededatos = 'integracion1'; Cambiarlo cuando se haga la corrección de la BD


$conn = mysqli_connect("localhost","root","","integracion1"); //Conexion, hay que cambiarlo a futuro.


if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $passwd = $_POST["passwd"];

    //Hay que agregarle la doble verificación (La confirmacion de contraseña) para que funcione correctamente.
    $sql = "SELECT ID_trabajador FROM trabajadores WHERE ID_trabajador = ? AND passwd = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $trabajador_id, $passwd);

    //Reemplazo de la id del trabajador, aquí podemos cambiar el usuario para eliminar la cuenta después.
    $trabajador_id = 1;

    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows === 1) {
        //Proceso de eliminación de la cuenta (WORK IN PROGRESS). Queda adaptarlo con el html final.
        $borrar_cuenta = "DELETE FROM usuarios WHERE id = ?";
        $delete_stmt = $conn->prepare($borrar_cuenta);
        $delete_stmt->bind_param("i", $trabajador_id);

        if ($delete_stmt->execute()) {
            header("Location: delete.php");
            exit();
        } else {
            echo "Error al eliminar la cuenta.";
        }
    } else {
        echo "La contraseña es incorrecta.";
    }
    
    $stmt->close();
}

$conn->close();
?>
