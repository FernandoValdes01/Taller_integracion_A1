<?php
session_start();

/* Valores para establecer en las variables de sesión
$rut = "123456789";
$nombre = "Usuario Ejemplo";
$cargo = "Administrador";
$contrasena_db = "contrasena_segura";
*/
// Establecer las variables de sesión
$_SESSION['rut'];
$_SESSION['nombre'] ;
$_SESSION['cargo'];
$_SESSION['contrasena'] ;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Valores de Sesión</title>
</head>
<body>

<h2>Valores de Sesión</h2>

<p>Rut: <?php echo $_SESSION['rut']; ?></p>
<p>Nombre: <?php echo $_SESSION['nombre']; ?></p>
<p>Cargo: <?php echo $_SESSION['cargo']; ?></p>
<p>Contraseña: <?php echo $_SESSION['contrasena']; ?></p>

</body>
</html>
