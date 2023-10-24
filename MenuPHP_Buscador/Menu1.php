<?php

if (isset($_SESSION['Correo_Cliente'])) {
    $Correo_Cliente = $_SESSION['Correo_Cliente'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link rel="stylesheet" href="style.css">
    <title>Techome</title>
    <style>

        body {
            background-color: #27496D;
            color: #F1EFEF;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        }

        a{
            color: #fff;
            text-decoration: none;
        }

        header{
            background-color: #142850;
            border: 2px solid #2C74B3;
            text-align: center;
            margin-top: 1%;
            margin-bottom: 1%;
            margin-left: 1%;
            margin-right: 7%;
            padding: 1%;
            border-radius: 10px;
        }

        footer{ 
            background-color: #142850;
            border: 2px solid #2C74B3;
            text-align: center;
            margin: 1%;
            padding: 2%;
            border-radius: 10px;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        }

        .valoracion {
            background-color: #0A2647;
            border: 3px solid #144272;
            padding: 10px;
            border-radius: 10px;
            margin-left: 2%;
            margin-right: 2%;
            margin-bottom: 2%;
            margin-top: 1%;
        }

        .valoracion li{
            flex: 1;
            background-color: #142850;
            padding: 20px;
            text-align: center;
            border: 1px solid #2C74B3;
            border-radius: 5px;
        }

        .valoracion ul{
            list-style-type: none;
            padding: 0;
            display: flex;
            flex-wrap: wrap;
        }

        #menu {
            position: fixed;
            top: 0;
            right: -303px; 
            width: 300px;
            height: 100%;
            background-color: #142850;
            border: 2px solid #2C74B3;
            border-radius: 10px;
            color: #fff;
            transition: right 0.3s;
        }

        #menu.active {
            right: 0;
        }

        #menu ul {
            list-style: none;
            padding: 0;
        }

        #menu ul li {
            padding: 15px;
            text-align: left;
            margin-left: 5%;
            cursor: pointer;
            border-bottom: 1px solid #142850;
        }

        #content {
            margin-top: 7%;
            margin-left: 2%;
            padding: 2%;
        }

        #menu-toggle {
            position: fixed;
            top: 20px;
            right: 20px;
            cursor: pointer;
            color: #fff;
            padding: 1%;
            margin-top: 1%;
            margin-right: 1%;
            background-color: #142850;
            border: 2px solid #2C74B3;
            border-radius: 10px;
        }

        #maintext{
            color: #fff;
            text-align: left;
            padding: 1%;
            margin-top: 1.3%;
        }

        #nextText{
            margin-top: 50px;
            text-align: center;
        }

        #elec-service{
            position: absolute;
            display: block;
            width: 200px;
            text-align: center;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            font-weight: 700;
            background-color: #142850;
            border: 5px solid #2C74B3;
            border-radius: 50px;
            padding: 8px;
            margin-top: 1%;
            margin-left: 14%;
        }

        #info-service{
            position: absolute;
            display: block;
            width: 200px;
            text-align: center;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            font-weight: 700;
            background-color: #142850;
            border: 5px solid #2C74B3;
            border-radius: 50px;
            padding: 8px;
            margin-top: 1%;
            margin-left: 29%;
        }

        #meca-service{
            position: absolute;
            display: block;
            width: 200px;
            text-align: center;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            font-weight: 700;
            background-color: #142850;
            border: 5px solid #2C74B3;
            border-radius: 50px;
            padding: 8px;
            margin-top: 1%;
            margin-left: 44%;
        }

        #gafi-service{
            position: absolute;
            display: block;
            width: 200px;
            text-align: center;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            font-weight: 700;
            background-color: #142850;
            border: 5px solid #2C74B3;
            border-radius: 50px;
            padding: 8px;
            margin-top: 1%;
            margin-left: 59%;
        }

        #carpi-service{
            position: absolute;
            display: block;
            width: 200px;
            text-align: center;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            font-weight: 700;
            background-color: #142850;
            border: 5px solid #2C74B3;
            border-radius: 50px;
            padding: 8px;
            margin-top: 1%;
            margin-left: 74%;
        }

        #elec-service:hover{
            background-color: #2C74B3;
            color: #fff;
        }

        #info-service:hover{
            background-color: #2C74B3;
            color: #fff;
        }

        #meca-service:hover{
            background-color: #2C74B3;
            color: #fff;
        }

        #gafi-service:hover{
            background-color: #2C74B3;
            color: #fff;
        }

        #carpi-service:hover{
            background-color: #2C74B3;
            color: #fff;
        }

        </style>
</head>
<body>
    <header>
        <div id="maintext">
            <h1>
                Bievenido a TecHome
            </h1>
        </div>
        
        <div id="ctn-icon-search">
            <i class="fas fa-search" id="icon-search"></i>
        </div>
    
        <div id = "icon-menu">
            <i class="fas fa-window-minimize"></i>
        </div>

    </header>

    <div id = nextText>
        <h2>¡Nuestros servicios!</h2>
        <h3>Categorias:</h3>
    </div>
    

    <div id="elec-service">
        <a href="ME.php">Servicio de electricidad</a>
    </div>
    <div id="info-service">
        <a href="MI.php">Servicio de informatica</a>
    </div>
    <div id="meca-service">
        <a href="MM.php">Servicio de mecanico</a>
    </div>
    <div id="gafi-service">
        <a href="MG.php">Servicio de gafiteria</a>
    </div>

    <div id="carpi-service">
        <a href="MC.php">Servicio de carpinteria</a>
    </div>



    <div id="ctn_bars-search">
        <input type="text" id="inputSearch" placeholder="Buscar">
    </div>

    <ul id="box-search">
        <li><a href="#"><i class="fas fa-search"></i>Electricista</a></li>
        <li><a href="#"><i class="fas fa-search"></i>Informatico</a></li>
        <li><a href="#"><i class="fas fa-search"></i>Mecanico</a></li>
        <li><a href="#"><i class="fas fa-search"></i>Gasfiter</a></li>
        <li><a href="#"><i class="fas fa-search"></i>Carpintero</a></li>
    </ul>

    <div id="cover-ctn-search"></div>
    

    <div id="menu">
        <ul>
            <li></li>
            <li><a href="inicioclientes.php">Iniciar sesion</a></li>
            <li><a href="Wregistroclientes.php">Registro</a></li>
            <li><a href="Nuestrahistoria2.html">Quienes somos</a></li>
            <li><a href="soporte.html">Soporte</a></li>
            <li><a href="politica de privacidadc.html">Politica de privacidad</a></li>
        </ul>
        </div>
        <div id="content">
        <h1>Servicios Mejor Evaluados</h1>
        <p>Estos son nuestros servicios de distintas categorias mejor evaluados.</p>
        <button onclick="fetchData('mejor')">Ordenar Mejor</button>
        <button onclick="fetchData('peor')">Ordenar Peor</button>
        </div>
        <div id="trabajadoresContainer">
        <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "techome";

            $conn = new mysqli($servername, $username, $password, $database);

            if ($conn->connect_error) {
                die("Error de conexión: " . $conn->connect_error);
            }

            $sql = "SELECT Profesion, Calificacion FROM trabajador";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $count = 0; 
                while ($row = $result->fetch_assoc()) {
                    if ($count < 10) {
                        echo '<div class="valoracion">';
                        echo '<p><strong>Servicio:</strong> ' . $row["Profesion"] . '</p>';
                        echo '<p><strong>Calificación:</strong> ' . $row["Calificacion"] . '</p>';
                        echo '</div>';
                        $count++;
                    } else {
                        break;
                    }
                }
            } else {
                echo "No se encontraron registros.";
            }
            

            $conn->close();
        ?>
        </div>

        <div id="menu-toggle">&#9776;</div>
        <script>
            
            const menu = document.getElementById('menu');
            const menuToggle = document.getElementById('menu-toggle');
            const Inicio = document.getElementById("Iniciar sesion");
            const config = document.getElementById('config');
            const quienesSomos = document.getElementById('quienes-somos');
        
        menuToggle.addEventListener('click', () => {
            menu.classList.toggle('active'); 
        });
        
        perfil.addEventListener('click', () => {
            console.log('Clic en Perfil');
        });
        
        config.addEventListener('click', () => {
            console.log('Clic en Config');
        });
        
        quienesSomos.addEventListener('click', () => {
            console.log('Clic en Quienes Somos');
        });

        function fetchData(order) {
            fetch('gettrabajadores.php?order=' + order)
                .then(response => response.text())
                .then(data => {
                    document.getElementById('trabajadoresContainer').innerHTML = data;
                })
                .catch(error => {
                    console.error('Hubo un error al obtener los datos: ' + error);
                });
        }

        </script>
        <script src="buscador.js"></script>
            </body>
    <footer>TecHome® 2023 | Derechos reservados</footer>
</body>
</html>
<?php
    session_start();
    
    $host = "localhost";
    $usuario = "root";
    $contrasena = "";
    $base_de_datos = "techome";
    
    $conexion = mysqli_connect($host, $usuario, $contrasena, $base_de_datos);
    
    if (!$conexion) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $query = "SELECT * FROM clientes";
    $result = $conexion->query($query);
    
    mysqli_close($conexion);
    
    
    if (isset($_SESSION['Correo_Cliente'])) {
        header("Location: inicioclientes.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link rel="stylesheet" href="style.css">
    <title>TecHome</title>
    <style>

body {
    background-color: #27496D;
    color: #F1EFEF;
    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
}

a{
    color: #fff;
    text-decoration: none;
}

header{
    background-color: #142850;
    border: 2px solid #2C74B3;
    text-align: center;
    margin-top: 1%;
    margin-bottom: 1%;
    margin-left: 1%;
    margin-right: 7%;
    padding: 1%;
    border-radius: 10px;
}

footer{ 
    background-color: #142850;
    border: 2px solid #2C74B3;
    text-align: center;
    margin: 1%;
    padding: 2%;
    border-radius: 10px;
    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
}

button{

    background-color: #142850;
    border: 2px solid #2C74B3;
    border-radius: 10px;
    color: #fff;
    padding: 0.5%

}

button:hover{

    background-color: #2C74B3;

}

.valoracion {
    background-color: #142850;
    border: 1px solid #2C74B3;
    text-align: center;
    margin: 1% 0;
    padding: 2%;
    border-radius: 10px;
    flex: 0 0 calc(33.33% - 20px);
    margin-right: 20px;
}

.valoracion li{
    flex: 1;
    background-color: #142850;
    padding: 20px;
    text-align: center;
    border: 1px solid #2C74B3;
    border-radius: 5px;
}

.valoracion ul{
    list-style-type: none;
    padding: 0;
    display: flex;
    flex-wrap: wrap;
}


#trabajadoresContainer {
    border: 2px solid #2C74B3;
    border-radius: 10px;
    background-color: #142850;
    margin-left: 3%;
    margin-right: 3%;
    display: flex;
    flex-wrap: wrap;
    justify-content: flex-end;
}

#trabajadoresContainer li{
    flex: 1;
    background-color: #142850;
    padding: 20px;
    text-align: center;
    border-radius: 0px;
}

#trabajadoresContainer ul{
    list-style-type: none;
    padding: 0;
    display: flex;
    flex-wrap: wrap;
}


#menu {
    position: fixed;
    top: 0;
    right: -303px; 
    width: 300px;
    height: 100%;
    background-color: #142850;
    border: 2px solid #2C74B3;
    border-radius: 10px;
    color: #fff;
    transition: right 0.3s;
    z-index: 11;
}

#menu.active {
    right: 0;
}

#menu ul {
    list-style: none;
    padding: 0;
}

#menu ul li {
    padding: 15px;
    text-align: left;
    margin-left: 5%;
    cursor: pointer;
    border-bottom: 1px solid #142850;
}

#content {
    margin-top: 7%;
    margin-left: 2%;
    padding: 2%;
}

#menu-toggle {
    position: fixed;
    top: 20px;
    right: 20px;
    cursor: pointer;
    color: #fff;
    padding: 1%;
    margin-top: 1%;
    margin-right: 1%;
    background-color: #142850;
    border: 2px solid #2C74B3;
    border-radius: 10px;
    z-index: 12;
}

#maintext{
    color: #fff;
    text-align: left;
    padding: 1%;
    margin-top: 1.3%;
}

#nextText{
    margin-top: 50px;
    text-align: center;
}

#elec-service{
    position: absolute;
    display: block;
    width: 200px;
    text-align: center;
    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
    font-weight: 700;
    background-color: #142850;
    border: 5px solid #2C74B3;
    border-radius: 50px;
    padding: 8px;
    margin-top: 1%;
    margin-left: 14%;
}

#info-service{
    position: absolute;
    display: block;
    width: 200px;
    text-align: center;
    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
    font-weight: 700;
    background-color: #142850;
    border: 5px solid #2C74B3;
    border-radius: 50px;
    padding: 8px;
    margin-top: 1%;
    margin-left: 29%;
}

#meca-service{
    position: absolute;
    display: block;
    width: 200px;
    text-align: center;
    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
    font-weight: 700;
    background-color: #142850;
    border: 5px solid #2C74B3;
    border-radius: 50px;
    padding: 8px;
    margin-top: 1%;
    margin-left: 44%;
}

#gafi-service{
    position: absolute;
    display: block;
    width: 200px;
    text-align: center;
    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
    font-weight: 700;
    background-color: #142850;
    border: 5px solid #2C74B3;
    border-radius: 50px;
    padding: 8px;
    margin-top: 1%;
    margin-left: 59%;
}

#carpi-service{
    position: absolute;
    display: block;
    width: 200px;
    text-align: center;
    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
    font-weight: 700;
    background-color: #142850;
    border: 5px solid #2C74B3;
    border-radius: 50px;
    padding: 8px;
    margin-top: 1%;
    margin-left: 74%;
}

#elec-service:hover{
    background-color: #2C74B3;
    color: #fff;
}

#info-service:hover{
    background-color: #2C74B3;
    color: #fff;
}

#meca-service:hover{
    background-color: #2C74B3;
    color: #fff;
}

#gafi-service:hover{
    background-color: #2C74B3;
    color: #fff;
}

#carpi-service:hover{
    background-color: #2C74B3;
    color: #fff;
}

</style>
</head>
<body>
    <header>
        <div id="maintext">
            <h1>
                Bievenido a TecHome
            </h1>
        </div>

        <div id="ctn-icon-search">
            <i class="fas fa-search" id="icon-search"></i>
        </div>
    
        <div id = "icon-menu">
            <i class="fas fa-window-minimize"></i>
        </div>
        
    </header>

    
    <div id ="nextText">
        <h2>¡Nuestros servicios!</h2>
        <h3>Categorias:</h3>
    
    </div>

    <div id="elec-service">
        <a href="ME.php">Servicio de electricidad</a>
    </div>
    <div id="info-service">
        <a href="MI.php">Servicio de informatica</a>
    </div>
    <div id="meca-service">
        <a href="MM.php">Servicio de mecanico</a>
    </div>
    <div id="gafi-service">
        <a href="MG.php">Servicio de gafiteria</a>
    </div>

    <div id="carpi-service">
        <a href="MC.php">Servicio de carpinteria</a>
    </div>

    <div id = "cover-ctn-search"></div>

    <div id="ctn_bars-search">
        <input type="text" id="inputSearch" placeholder="Buscar">
    </div>

    <ul id="box-search">
        <li><a href="#"><i class="fas fa-search"></i>Electricista</a></li>
        <li><a href="#"><i class="fas fa-search"></i>Informatico</a></li>
        <li><a href="#"><i class="fas fa-search"></i>Mecanico</a></li>
        <li><a href="#"><i class="fas fa-search"></i>Gasfiter</a></li>
        <li><a href="#"><i class="fas fa-search"></i>Carpintero</a></li>
    </ul>

    <div id="cover-ctn-search"></div>

    

    <div id="menu">
        <ul>
            <li></li>
            <li id="config"> <a href="Perfilcliente.php">Perfil</a></li>
            <li id="quienes-somos"> <a href="NuestrahistoriaC1.html">Quienes somos</a></li>
            <li id="direcciones"> <a href="DireccionesActualizado.html">Direcciones</a></li>
            <li id="soporte"> <a href="soportec1.html">Soporte</a></li>
            <li id="politica_de_privacidadc"> <a href="politica de privacidadc1.html">Politíca de Privacidad</a></li>
        </ul>

        </div>
        <div id="content">
        <h1>Servicios Mejor Evaluados</h1>
        <p>Estos son nuestros servicios de distintas categorias mejor evaluados.</p>
        <button onclick="fetchData('mejor')">Ordenar Mejor</button>
        <button onclick="fetchData('peor')">Ordenar Peor</button>
        </div>
        <div id="trabajadoresContainer">
            <ul>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "techome";

                $conn = new mysqli($servername, $username, $password, $database);

                if ($conn->connect_error) {
                    die("Error de conexión: " . $conn->connect_error);
                }

                $sql = "SELECT Profesion, Calificacion FROM trabajador";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $count = 0;
                    while ($row = $result->fetch_assoc()) {
                        if ($count < 9) {
                            echo "<li>";
                            echo '<div class="valoracion">';
                            echo '<p><strong>Servicio:</strong> ' . $row["Profesion"] . '</p>';
                            echo '<p><strong>Calificación:</strong> ' . $row["Calificacion"] . '</p>';
                            echo '</div>';
                            echo "</li>";
                            $count++;
                        } else {
                            break;
                        }
                    }
                } else {
                    echo "No se encontraron registros.";
                }
                
                $conn->close();
            ?>
            </ul>
        </div>
        <footer>TecHome® 2023 | Derechos reservados</footer>

        <div id="menu-toggle">&#9776;</div> 
        <script>
        const menu = document.getElementById('menu');
        const menuToggle = document.getElementById('menu-toggle');
        const configuracion_de_perfil = document.getElementById('config');
        const quienesSomos = document.getElementById('Nuestrahistoria2');
        const direcciones = document.getElementById('direcciones');
        const soporte = document.getElementById('soporte');
        const politica_de_privacidad = document.getElementById('politica_de_privacidadc');
        
        menuToggle.addEventListener('click', () => {
            menu.classList.toggle('active'); 
        });
        
        configuracion_de_perfil.addEventListener('click', () => {
            console.log('Clic en Configuración');
        });
        
        quienesSomos.addEventListener('click', () => {
            console.log('Clic en Quienes Somos');
        });

        politica_de_privacidadc.addEventListener('click', () => {
            console.log('Clic en Politicas de Privacidad')
        });

        direcciones.addEventListener('click', ()=> {
            console.log('Clic en Direcciones')
        });

        function fetchData(order) {
            fetch('gettrabajadores.php?order=' + order)
                .then(response => response.text())
                .then(data => {
                    document.getElementById('trabajadoresContainer').innerHTML = data;
                })
                .catch(error => {
                    console.error('Hubo un error al obtener los datos: ' + error);
                });
        }
        </script>
        <script src="buscador.js"></script>
</body>
</html>


