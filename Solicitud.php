<?php
include("db.php");

if($_POST){
    print_r($_POST);

    $tipo_servicio=(isset($_POST["tipo_servicio"])?$_POST["tipo_servicio"]:"");
    $descripcion=(isset($_POST["descripcion"])?$_POST["descripcion"]:"");

    $sentencia=$conexion->prepare("INSERT INTO 
    solicitud(ID_solicitud, tipo_servicio, descripcion) 
    VALUES (NULL, :tipo_servicio, :descripcion);");

     $sentencia->bindParam(":tipo_servicio",$tipo_servicio);
     $sentencia->bindParam(":descripcion",$descripcion);
         
     $sentencia->execute();

}

?>

<!DOCTYPE html>
<html lang="esp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud Trabajo</title>
</head>
<body>
    <h1>Solicitar Trabajo</h1>
    
    <form action="" method="post" enctype="multipart/form-data">
    <label for="tipo_servicio">Selecciona un servicio:</label>
    <select id="tipo_servicio" name="tipo_servicio">
        <option value="Mantencion">Mantención</option>
        <option value="Reparacion">Reparación</option>
        <option value="Intalacion">Instalación</option>
    </select>
    
    <p>Describe tu problema:</p>
    <textarea id="descripcion" name="descripcion" rows="4" cols="50"></textarea>
    <br>
    <button type="submit">Enviar</button>
    </form>
</body>
</html>
