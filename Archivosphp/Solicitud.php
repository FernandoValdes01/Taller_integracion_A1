<?php
include("db.php");

if($_POST){
    print_r($_POST);

    session_start();
    $consultaMaxID = $conexion->query("SELECT MAX(ID_solicitud) AS 'max_id' FROM `solicitudservicio`");
    $maxID = $consultaMaxID->fetch(PDO::FETCH_ASSOC);
    $nuevoID = $maxID['max_id'] + 1;

    $correo=$_SESSION['Correo_Cliente'];
    $tipo_servicio=(isset($_POST["tipo_servicio"])?$_POST["tipo_servicio"]:"");
    $descripcion=(isset($_POST["descripcion"])?$_POST["descripcion"]:"");
    

    $sentencia=$conexion->prepare("INSERT INTO `solicitudservicio` (ID_solicitud, tipo_servicio, descripcion, Correo_Cliente) 
    VALUES (:nuevoID, :tipo_servicio, :descripcion, :correo)");

    $sentencia->bindParam(":nuevoID",$nuevoID);
    $sentencia->bindParam(":correo",$correo);
    $sentencia->bindParam(":tipo_servicio",$tipo_servicio);
    $sentencia->bindParam(":descripcion",$descripcion);

    $sentencia->execute();
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Solicitud Ayuda</title>
        <link rel="stylesheet" href="SolicitudTrabajo.css">
        <style>
    body{
    
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        background-color: #fff;
        margin: 0;
        padding: 0;
    }
    
    header{
    
        background-color: #0d3c6e;
        color: #fff;
        text-align: center;
        padding: 25px;
        margin-top: -9px;
        margin-left: -8px;
        margin-right: -8px;
    
    }
    
    footer{ 

    color: #fff;
    text-align: center;
    background-color: #0d3c6e;
    margin-bottom: -10px;
    margin-top: 437px;
    }
    
    h1{
        font-family: Verdana;
        font-size: 32px;
        text-align: center;
    }
    
    .Box{
        padding: 20px;
        margin-left: 15%;
        margin-right: 15%;
        margin-top: 90px;
        background-color: #f2f2f2;
        border-radius: 5px;
    }
    
    label{
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        display: block;
        margin-bottom: 10px;
        margin-top: 0%;
    }
        </style>
    </head>
<body>
    <header>
        <h1>Solicitar Servicio</h1>
    </header>
    <form action="Solicitud.php" method="post" enctype="multipart/form-data">
        <div class="Box">
            <label for="servicio">Selecciona un servicio:</label>
            <select id="servicio" name="servicio">
                <option value="servicio1">Servicio 1</option>
                <option value="servicio2">Servicio 2</option>
                <option value="servicio3">Servicio 3</option>
            </select>
    
            <p>Describe tu problema:</p>
            <textarea id="descripcion" name="descripcion" rows="4" cols="50"></textarea><br><br>
    
            <button type="submit">Enviar</button>
        </div>
    </form>
    <footer>TecHome® 2023 | Derechos reservados</footer>

</body>
</html>
