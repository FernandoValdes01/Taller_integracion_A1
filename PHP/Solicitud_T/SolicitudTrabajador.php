<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud de Trabajo</title>
    <link rel="stylesheet" href="SolicitudTrabajo.css">
    <style>
body{

    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;

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
    margin-top: 137px;
    margin-bottom: -10px;
    margin-left: -8px;
    margin-right: -8px;

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
        <h1>Solicitud de Trabajo</h1>
    </header>

    <form action="#" method="post" enctype="multipart/form-data">
        <div class="Box">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required><br><br>
    
            <label for="correo">Correo:</label>
            <input type="email" id="correo" name="correo" required><br><br>
    
            <label for="rut_pasaporte">RUT o Pasaporte:</label>
            <input type="text" id="rut_pasaporte" name="rut_pasaporte" required><br><br>
    
            <label for="titulo_certificacion">Título o Certificación:</label>
            <input type="text" id="titulo_certificacion" name="titulo_certificacion" required><br><br>

            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" name="imagen" accept="image/*" required><br><br>
    
            <label for="area">Área:</label>
            <select id="area" name="area">
                <option value="Electricista">Electricista</option>
                <option value="Mecánico">Mecánico</option>
                <option value="Gafitería">Gafitería</option>
                <option value="Informática">Informática</option>
                <option value="Carpintería">Carpintería</option>
            </select><br><br>
    
            <button type="submit" name="subir">Enviar Solicitud</button>

        </div>
    </form>

    <?php
        include("registrar.php");
    ?>

    <footer>TecHome® 2023 | Derechos reservados</footer>
</body>
</html>