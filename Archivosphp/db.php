<?php

    $db_server = "localhost";
    $db_usuario = "root";
    $db_contrasena = "";
    $db_nombre = "techome";

    try{
        $conexion = new PDO("mysql:host=$db_server;dbname=$db_nombre",$db_usuario,$db_contrasena);
    }catch(Exception $ex){
        echo $ex->getMessage();
    }

?>
