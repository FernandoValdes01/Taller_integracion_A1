<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Revisión de Solicitantes</title>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

  <style>
    body {
      background-color: #001f3f;
      color: white;
    }

    .container {
      background-color: #0074cc;
      padding: 20px;
      border-radius: 9px;
    }

    .card {
      background-color: #ffffff;
      color: #001f3f;
      margin-bottom: 20px;
    }

    .navbar {
      background-color: #001f3f;
    }

    .navbar a {
      color: white;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark">
  <a class="navbar-brand" href="menuadmin.php">Menú Admin</a>
</nav>

<div class="container mt-5">
  <h2>Revisión de Solicitantes</h2>
  <div id="solicitantesContainer"></div>
</div>

<script>
function cargarSolicitantes() {
  $.ajax({
    url: 'obtener_solicitantes.php',
    type: 'GET',
    dataType: 'json',
    success: function(data) {
      if (data.length > 0) {
        data.forEach(function(solicitante) {
          var containerHTML = '<div class="card mb-3">';
          containerHTML += '<div class="card-body">';
          containerHTML += '<h5 class="card-title">' + solicitante.Nombre_Solicitante + '</h5>';
          containerHTML += '<p class="card-text">Correo: ' + solicitante.Correo_Solicitante + '</p>';
          containerHTML += '<p class="card-text">Profesión: ' + solicitante.Profesion + '</p>';
          containerHTML += '<button class="btn btn-danger" onclick="rechazarSolicitante(\'' + solicitante.Rut_solicitante + '\')">Rechazar</button>';
          containerHTML += '<button class="btn btn-success" onclick="contratarSolicitante(\'' + solicitante.Rut_solicitante + '\')">Contratar</button>';
          containerHTML += '</div></div>';

          $('#solicitantesContainer').append(containerHTML);
        });
      } else {
        $('#solicitantesContainer').html('<p>No hay solicitantes disponibles.</p>');
      }
    },
    error: function(error) {
      console.log('Error al cargar solicitantes: ' + JSON.stringify(error));
    }
  });
}
function rechazarSolicitante(rutSolicitante) {
  if (confirm('¿Estás seguro de que deseas rechazar a este solicitante?')) {
    $.ajax({
      url: 'acciones_solicitantes.php',
      type: 'POST',
      data: { action: 'rechazar', rut_solicitante: rutSolicitante },
      success: function(response) {
        alert(response);
        cargarSolicitantes();
      },
      error: function(error) {
        console.log('Error al rechazar solicitante: ' + JSON.stringify(error));
      }
    });
  }
}
function contratarSolicitante(rutSolicitante) {
  if (confirm('¿Estás seguro de que deseas contratar a este solicitante?')) {
    $.ajax({
      url: 'acciones_solicitantes.php',
      type: 'POST',
      data: { action: 'contratar', rut_solicitante: rutSolicitante },
      success: function(response) {
        alert(response);
        cargarSolicitantes();
      },
      error: function(error) {
        console.log('Error al contratar solicitante: ' + JSON.stringify(error));
      }
    });
  }
}
$(document).ready(function() {
  cargarSolicitantes();
});
</script>
</body>
</html>