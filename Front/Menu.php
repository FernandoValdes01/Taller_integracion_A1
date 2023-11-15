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
    <link rel="stylesheet" href="menuStyle.css">
    <title>TecHome® | Home</title>
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

        <div id="menu-toggle"><i class="fas fa-list-ul" style="color: #fafafa;"></i></div> 
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
        <footer>
            <div class = "footer-info">
                <div class = "contactanos"><i class="fas fa-mobile-alt" style="color: #fafafa;"></i> Contactanos: <br>+56 9 89348303</div>
                <div class = "ubicacion"><i class="fas fa-map-marker-alt" style="color: #fafafa;"></i> Direccion: <br>Temuco, Chile</div>
                <div class = "informacion"><i class="fas fa-info-circle" style="color: #fafafa;"></i> Techome: <br>Servicio facil para la gente</div>
            </div>
            <div class = "bottom-footer-text">TecHome® 2023 | Derechos reservados</div>
        </footer>
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
    <link rel="stylesheet" href="menuStyle.css">
    <title>TecHome® | Home</title>
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
        <footer>
            <div class = "footer-info">
                <div class = "contactanos"><i class="fas fa-mobile-alt" style="color: #fafafa;"></i> Contactanos: <br>+56 9 89348303</div>
                <div class = "ubicacion"><i class="fas fa-map-marker-alt" style="color: #fafafa;"></i> Direccion: <br>Temuco, Chile</div>
                <div class = "informacion"><i class="fas fa-info-circle" style="color: #fafafa;"></i> Techome: <br>Servicio facil para la gente</div>
            </div>
            <div class = "bottom-footer-text">TecHome® 2023 | Derechos reservados</div>
        </footer>

        <div id="menu-toggle"><i class="fas fa-list-ul" style="color: #fafafa;"></i></div> 
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