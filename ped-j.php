<?php
        // Inicia la sesión de PHP
        session_start();

        // Función para validar la entrada del usuario
        function validarInput($input) {
            // La función trim elimina espacios en blanco al principio y al final del input
            $input = trim($input);
            // La función stripslashes elimina las barras invertidas de un string, útil para evitar problemas de seguridad
            $input = stripslashes($input);
            // La función htmlspecialchars convierte caracteres especiales en entidades HTML, protegiendo contra ataques XSS
            $input = htmlspecialchars($input);
            return $input;
        }
// Verifica si se ha enviado el formulario utilizando el método POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['calificar_pedido']) && isset($_SESSION['Correo_Cliente'])) {
    // Si se cumplen las tres condiciones a continuación, se procederá a calificar el pedido:S
    // 1. $_SERVER["REQUEST_METHOD"] verifica el método de solicitud, que debe ser POST para enviar datos al servidor.
    // 2. isset($_POST['calificar_pedido']) verifica si se ha presionado el botón de "calificar_pedido" en el formulario.
    // 3. isset($_SESSION['Correo_Cliente']) verifica si el usuario ha iniciado sesión almacenando su correo en la variable de sesión 'Correo_Cliente'.
    // Esto garantiza que solo los usuarios autenticados puedan calificar el pedido.
// Utiliza la función validarInput para obtener y validar los valores enviados desde el formulario
$ID_pedido = validarInput($_POST['ID_pedido']);
$calificacion = validarInput($_POST['calificacion']);
$rut_trabajador = validarInput($_POST['Rut_trabajador']);
            $host = "localhost";
            $usuario = "root";
            $contrasena = "";
            $base_datos = "techome";
            $conexion = new mysqli($host, $usuario, $contrasena, $base_datos);
            // Verifica si la conexión a la base de datos es exitosa
            if ($conexion->connect_error) {
                die("Conexión fallida: " . $conexion->connect_error);
            }

            // Verificar si el pedido está en estado "finalizado"
            $estadoFinalizado = "finalizado";
            // Se define un valor que indica el estado "finalizado" del pedido.
            
            $sqlEstado = "SELECT estado FROM `pedido_aceptado` WHERE ID_pedido = ?";
            // Se crea una consulta SQL para seleccionar el estado de un pedido específico.
            
            $stmtEstado = $conexion->prepare($sqlEstado);
            // Se prepara una sentencia SQL utilizando la conexión a la base de datos.
            
            $stmtEstado->bind_param("i", $ID_pedido);
            // Se vincula el valor de $ID_pedido a la consulta preparada. El "i" indica que es un valor de tipo entero.
            
            $stmtEstado->execute();
            // Se ejecuta la consulta SQL.
            
            $stmtEstado->bind_result($estado);
            // Se vincula la columna 'estado' de la consulta preparada a la variable $estado.
            
            $stmtEstado->fetch();
            // Se recupera el resultado de la consulta y se almacena en la variable $estado.
            
            $stmtEstado->close();
            // Se cierra la sentencia preparada para liberar recursos.

            // Si el pedido está en estado "finalizado", se permite la calificación
            if ($estado === $estadoFinalizado) {
                // El pedido está en estado "finalizado", por lo que se puede calificar
                $sql_pedido = "UPDATE `pedido_aceptado` SET `calificacion` = ? WHERE `ID_pedido` = ?";
                // Se crea una consulta SQL para actualizar la tabla 'pedido_aceptado' y registrar la calificación del pedido.
                $stmt_pedido = $conexion->prepare($sql_pedido);
                // Se prepara una sentencia SQL utilizando la conexión a la base de datos.
                $stmt_pedido->bind_param("ii", $calificacion, $ID_pedido);
                // Se vinculan los valores de $calificacion y $ID_pedido a la consulta preparada.
                // "ii" indica que ambos valores son enteros.
            
                if ($stmt_pedido->execute()) {
                    // Si la ejecución de la consulta tiene éxito, se actualiza la calificación del pedido en la base de datos.
                    echo "<p>¡Gracias por calificar el pedido con $calificacion estrellas!</p>";
                    // Cuando la consulta se ejecuta con éxito, se muestra un mensaje en la página web agradeciendo al usuario por calificar el pedido con la cantidad de estrellas especificada.
                } else {
                    // Si hay un error en la actualización, se muestra un mensaje de error.
                    echo "<p>Error al actualizar la calificación del pedido.</p>";
                    // En caso de que la ejecución de la consulta no tenga éxito, se muestra un mensaje de error indicando que hubo un problema al actualizar la calificación del pedido.
                }
            
                // Incrementar en uno el número de pedidos calificados del trabajador
                $sql_trabajador = "UPDATE `trabajador` SET `Pedidos` = `Pedidos` + 1 WHERE `Rut_trabajador` = ?";
                // Se crea una consulta SQL para incrementar en uno el número de pedidos calificados del trabajador.
                $stmt_trabajador = $conexion->prepare($sql_trabajador);
                // Se prepara una sentencia SQL utilizando la conexión a la base de datos.
                $stmt_trabajador->bind_param("s", $rut_trabajador);
                // Se vincula el valor de $rut_trabajador a la consulta preparada.
                // "s" indica que el valor es una cadena.
            
                if ($stmt_trabajador->execute()) {
                    // Si la ejecución de la consulta tiene éxito, se incrementa el número de pedidos calificados del trabajador.
                    // Éxito al incrementar el número de pedidos calificados del trabajador
                } else {
                    // Si hay un error en la actualización, se muestra un mensaje de error.
                    echo "<p>Error al actualizar el número de pedidos calificados del trabajador.</p>";
                }
            } else {
                // El pedido no está en estado "finalizado", mostrar un mensaje de error
                echo "<p>No puedes calificar este pedido porque no está en estado 'finalizado'.</p>";
            }
// Cierra la conexión a la base de datos
        $conexion->close();
        }
        ?>
        
<!DOCTYPE html>
<html>
<head>
<style>
:root {
    --main-color: #0A64E4;
    --dark-color-1: #064AB2;
}

body {
    background-color: #87CEEB
}

h1 {
    color: var(--dark-color-1);
}

input[type="submit"] {
    background-color: var(--main-color);
    color: black;
    padding: 9px 20px;
    border-radius: 9px;
    cursor: pointer;
    border: 2px solid #000;
}

input[type="text"] {
    width: 99%;
    padding: 11px 20px;
    margin: 9px 0;
    border: 2px solid #000;
}
</style>
<meta charset="UTF-8">
<!-- Este meta elemento establece el juego de caracteres de la página en UTF-8, que es un estándar ampliamente utilizado para admitir caracteres especiales
multilingües en la web. UTF-8 permite que la página muestre correctamente caracteres como acentos, letras no latinas, emojis y otros símbolos. -->

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Este meta elemento se utiliza para controlar la presentación de la página en dispositivos móviles y la escala de la vista.
Aquí hay una explicación más detallada:
- "name" se refiere al nombre del atributo, que en este caso es "viewport".
- "content" se utiliza para especificar el contenido del atributo.
- "width=device-width" significa que el ancho de la página se ajustará al ancho del dispositivo,
lo que asegura que la página se adapte a la pantalla de manera efectiva en dispositivos móviles.
- "initial-scale=1.0" establece el nivel de escala inicial de la página en 1.0,
lo que significa que la página se mostrará a un tamaño normal sin ningún zoom predeterminado.
Esto es importante para garantizar que la página se vea correctamente en dispositivos móviles sin aplicar un zoom no deseado. -->
    <title>Calificación del Pedido</title>
</head>
<body>
    <div>
        <h1>Calificar Pedido</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <!-- El formulario se enviará al mismo script PHP que generó la página actual.
        El uso de php echo $_SERVER['PHP_SELF'];  asegura que el formulario
        se envíe de vuelta al script PHP actual para su procesamiento. -->
        <div class="form-group">
                <label for="ID_pedido">ID_pedido:</label>
                <input type="text" name="ID_pedido" id="ID_pedido" required>
                
                <label for="calificacion">calificacion (1-5):</label>
                <input type="number" name="calificacion" id="calificacion" min="1" max="5" required>
                
                <label for="Rut_trabajador">Rut_trabajador:</label>
                <input type="text" name="Rut_trabajador" id="Rut_trabajador" required>
            </div>
            <input type="submit" name="calificar_pedido" class="btn-submit" value="Calificar Pedido">
        </form>

    </div>
</body>
</html>