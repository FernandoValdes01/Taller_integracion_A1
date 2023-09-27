<?php

    include("con_bd.php");

if (isset($_POST['subir'])){

    if (strlen($_POST ['nombre']) < 1 && strlen($_POST ['correo']) < 1 && strlen($_POST ['rut_pasaporte']) < 1 && strlen($_POST ['titulo_certificacion']) && strlen($_POST ['area']) < 1){

        $nombre = trim($_POST['nombre']);
        $correo = trim($_POST['correo']);
        $rut = trim($_POST['rut_pasaporte']);
        $titulo= trim($_POST['titulo_certificacion']);
        $area= trim($_POST['area']);

        $consulta = "INSERT INTO `trabajadores`(`ID_trabajador`, `nombre_trabajador`, `titulo`, `correo`, `profesion`) VALUES ('$rut','$nombre','$titulo','$correo')";

        $resultado = mysqli_query($conexion, $consulta);
    }
    

}

?>