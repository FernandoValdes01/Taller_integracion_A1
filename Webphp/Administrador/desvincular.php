<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        body{
            background: linear-gradient(150deg, #FF4F00, #E58729);
            color: #F1EFEF;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        }  

        header{
            background-color: #FF883F;
            border: 2px solid white;
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
        
        .Container{
            background-color: #FF883F;
            border: 2px solid white;
            text-align: center;
            margin-top: 1%;
            margin-bottom: 1%;
            margin-left: 1%;
            margin-right: 5%;
            padding: 2%;
            border-radius: 10px;
        }

        .trabajador-container {
            background-color: #FF883F;
            border: 2px solid white;
            text-align: center;
            margin-top: 1%;
            margin-bottom: 1%;
            margin-left: 1%;
            margin-right: 5%;
            padding: 2%;
            border-radius: 10px;
        }

        ul {
            list-style: none;
            padding: 0;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        li {
            flex: 1;
            background-color: #FF883F;
            padding: 20px;
            text-align: center;
            border: 1px solid white;
            border-radius: 5px;
            margin: 10px;
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
        <h1>Configuración del Administrador - TecHome</h1>
    </header>
    <div class='Container'>
        <h2>Lista de Trabajadores</h2>
        <?php
            session_start();

            if (!(isset($_SESSION['rut']) && isset($_SESSION['nombre']))) {
                header("Location: inicioAdministrador.php");
                exit();
            }

            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "techome";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                echo "<script>alert('Conexión fallida: " . $conn->connect_error . "');</script>";
            }

            $rut = isset($_SESSION['rut']) ? $_SESSION['rut'] : '';
            $nombre = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : '';
            $cargo = isset($_SESSION['cargo']) ? $_SESSION['cargo'] : '';

            if (isset($_POST['actualizar'])) {
                // ... (código de actualización)
            }

            if (isset($_POST['cambiar'])) {
                // ... (código de cambio de contraseña)
            }

            if (isset($_POST['eliminar_cuenta'])) {
                // ... (código de eliminación de cuenta)
            }

            if (isset($_POST['logout'])) {
                // ... (código de cierre de sesión)
            }

            function mostrarTrabajadores($conn, $rutAdmin) {
                $sql = "SELECT Rut_trabajador, Nombre_Trabajador, Profesion FROM trabajador";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo "<ul>"; 
                    while ($row = $result->fetch_assoc()) {
                        echo "<li>";
                        echo "<div class='trabajador-container'>";
                        echo "<p>Rut: " . $row['Rut_trabajador'] . "</p>";
                        echo "<p>Nombre: " . $row['Nombre_Trabajador'] . "</p>";
                        echo "<p>Profesión: " . $row['Profesion'] . "</p>";

                        echo "<form method='post' action=''>";
                        echo "<input type='hidden' name='rut_trabajador' value='" . $row['Rut_trabajador'] . "'>";
                        echo "<label for='contrasena_admin'>Contraseña del Administrador:</label>";
                        echo "<input type='password' name='contrasena_admin' required>";
                        echo "<button type='submit' name='desvincular'>Desvincular</button>";
                        echo "</form>";

                        echo "</div>";
                        echo "</li>";
                    }
                    echo "</ul>"; 
                    }
                }

            // Proceso para desvincular al trabajador
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['desvincular'])) {
                $rut_trabajador_desvincular = $_POST['rut_trabajador'];
                $contrasena_admin = $_POST['contrasena_admin'];

                // Obtener la contraseña del administrador desde la base de datos
                $sqlGetAdminPassword = "SELECT Contraseña_Administrador FROM administradores WHERE Rut_administrador = ?";
                $stmtGetAdminPassword = $conn->prepare($sqlGetAdminPassword);
                $stmtGetAdminPassword->bind_param("s", $rut);
                $stmtGetAdminPassword->execute();
                $resultAdminPassword = $stmtGetAdminPassword->get_result();

                if ($resultAdminPassword->num_rows > 0) {
                    $rowAdminPassword = $resultAdminPassword->fetch_assoc();
                    $contrasena_admin_guardada = $rowAdminPassword['Contraseña_Administrador'];

                    // Verificar la contraseña del administrador
                    if ($contrasena_admin === $contrasena_admin_guardada) {
                        // Contraseña del administrador correcta, proceder con la desvinculación

                        // Consulta para actualizar las referencias del trabajador en la tabla pedido_aceptado
                        $sqlActualizarPedidos = "UPDATE pedido_aceptado SET Rut_Trabajador = NULL WHERE Rut_Trabajador = ?";
                        $stmtActualizarPedidos = $conn->prepare($sqlActualizarPedidos);
                        $stmtActualizarPedidos->bind_param("s", $rut_trabajador_desvincular);

                        if ($stmtActualizarPedidos->execute()) {
                            // Consulta para eliminar al trabajador
                            $sqlEliminarTrabajador = "DELETE FROM trabajador WHERE Rut_trabajador = ?";
                            $stmtEliminarTrabajador = $conn->prepare($sqlEliminarTrabajador);
                            $stmtEliminarTrabajador->bind_param("s", $rut_trabajador_desvincular);

                            if ($stmtEliminarTrabajador->execute()) {
                                echo "<script>alert('Trabajador desvinculado exitosamente.');</script>";
                            } else {
                                echo "<script>alert('Error al desvincular al trabajador.');</script>";
                            }

                            $stmtEliminarTrabajador->close();
                        } else {
                            echo "<script>alert('Error al actualizar las referencias de pedidos.');</script>";
                        }

                        $stmtActualizarPedidos->close();
                    } else {
                        echo "<script>alert('Contraseña del administrador incorrecta.');</script>";
                    }
                }

                $stmtGetAdminPassword->close();
            }

            // Mostrar trabajadores después de realizar todas las operaciones relacionadas con la base de datos
            mostrarTrabajadores($conn, $rut);

            // Cerrar la conexión después de completar todas las operaciones
            $conn->close();
            ?>
    </div>
</body>
</html>
