<?php
include("db.php");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TecHome Recuperar Contraseña</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .Box {
            background-color: #fff;
            padding: 20px;
            border-radius: 4px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .Form {
            max-width: 300px;
            margin: 0 auto;
        }

        label,
        input {
            display: block;
            margin-bottom: 10px;
        }

        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="Box">
        <div class="Form">
            <h2>Recupere su Contraseña</h2>
            <form method="POST" action="recuperarcontrasenaT.php">
                <div class="InputBox">
                    <label for="Rut_Trabajador">Ingrese su Rut:</label>
                        <input type="text" id="Rut_Trabajador" name="Rut_Trabajador" required><br>
                </div>
                <div class="Buttons">
                    <button type="submit">Recuperar</button><br><br>
                </div>
            </form>
<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene el Rut ingresado en el formulario
    $rut_trabajador = $_POST["Rut_Trabajador"];

    // Realiza una consulta para buscar el rut del trabajador
    $sentencia = $conexion->prepare("SELECT contraseña FROM trabajador WHERE Rut_Trabajador = :Rut_Trabajador");
    $sentencia->bindParam(":Rut_Trabajador", $rut_trabajador);
    $sentencia->execute();

    $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);

    if ($resultado) {
        $contrasenarecuperada = $resultado["contraseña"];
        echo "Su contraseña de trabajador es: $contrasenarecuperada";
        
    } else {
        echo "No se encontró un trabajador con el Rut proporcionado.";
    }
}
?>
                        <br><br>
                        <div class="link">
                <a href="iniciosesionT.php">Volver a Inicio de Sesion</a>
        </div>
    </div>
</body>