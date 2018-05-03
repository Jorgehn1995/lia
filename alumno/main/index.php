<?php include '../lib/sesion.php';?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <?php $titulo = "Inicio Alumnos";
include '../lib/header.php';?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <meta content="Sistema para el control de notas escolares" name="description" />
  <meta content="Jorge Hernandez" name="author" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />

  <!-- App css -->
  <link href="../../plugins/select2/select2.css" rel="stylesheet" type="text/css" />
  <link href="../../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="../../assets/css/icons.css" rel="stylesheet" type="text/css" />
  <link href="../../assets/css/styleprofe.css" rel="stylesheet" type="text/css" />
  <link href="../../assets/css/stylenews.css" rel="stylesheet" type="text/css" />

  <script src="../../assets/js/modernizr.min.js"></script>
  <style media="screen">
    .rounded-circle,
    .head {

      background: rgba(59, 153, 156, 1);
      background: -moz-linear-gradient(left, rgba(59, 153, 156, 1) 0%, rgba(0, 177, 156, 1) 100%);
      background: -webkit-gradient(left top, right top, color-stop(0%, rgba(59, 153, 156, 1)), color-stop(100%, rgba(0, 177, 156, 1)));
      background: -webkit-linear-gradient(left, rgba(59, 153, 156, 1) 0%, rgba(0, 177, 156, 1) 100%);
      background: -o-linear-gradient(left, rgba(59, 153, 156, 1) 0%, rgba(0, 177, 156, 1) 100%);
      background: -ms-linear-gradient(left, rgba(59, 153, 156, 1) 0%, rgba(0, 177, 156, 1) 100%);
      background: linear-gradient(to right, rgba(59, 153, 156, 1) 0%, rgba(0, 177, 156, 1) 100%);
      filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#3b999c', endColorstr='#00b19c', GradientType=1);

    }

    .head {
      width: 100%;
      height: auto;
      padding: 2em;
    }

    .conversation-list {

      padding: 0px !important;
    }

    .conversation-list .conversation-text {
      display: inline-block;
      float: left;
      font-size: 12px;
      margin-left: 5px;
      width: 90%;
    }

    .c-list li {
      margin-bottom: 0px;
      margin-top: 0px;
    }
  </style>
</head>

<body>

  <?php include '../lib/menu.php';?>


  <div class="wrapper">
    <div class="head">
      <div class="row">
        <div class="col-md-12">
          <h2 class="text-light">
            <b>Inicio</b>
            <small>
              <small>> Perfil Alumnos</small>
            </small>
          </h2>
        </div>
        <div class="col-md-12">
          <p class="text-light">Accede a tus calificaciones, entrega tareas y revisa tus pagos desde donde quieras</p>
        </div>
      </div>
    </div>
    <div class="alert alert-success alert-dismissable" style="display:none;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      Se han añadido las siguientes
      <a href="#" class="alert-link">funciones</a>:
      <ul>
        <li style="display:none;">Registro de inicio de sesión</li>
        <li>Seguimiento sobre registro de notas</li>
        <li style="display:none;">Ver ingreso de notas de asesor</li>
      </ul>
    </div>
    <div class="container-fluid">
      <br>
      <!-- Page-Title -->

      <!-- end page title end breadcrumb -->
      <div class="row">
        <!-- CHAT -->
        <div class="col-lg-12">
          <div class="card-box">
            <h4 class="m-t-0 m-b-20 header-title">
              <b>Tus Notas</b>
            </h4>
            <div class="col-md-12">
              <div class="row">
                <div class="col-12 col-md-4 col-lg-4 ">
                  <select id="stBloques" class=" form-control select2" name="">
                    <?php
for ($i = 1; $i <= $bloqueencurso; $i++) {
    $s = "";
    if ($i == $bloqueencurso) {
        $s = "selected";
    } else {
        $s = "";
    }
    echo '<option ' . $s . ' value="' . $i . '">Bloque ' . $i . '</option>';
}

?>
                  </select>
                </div>
              </div>

              <div class="row">
                <div id="main" class="col-md-12">


                </div>
              </div>
            </div>
          </div>

        </div>
        <!-- end col-->



      </div>
    </div>
    <!-- end container -->
  </div>
  <!-- end wrapper -->


  <!-- Footer -->
  <?php
include '../lib/foo.php';
require '../lib/scripts.php';
?>

    <!-- End Footer -->
    <!-- jQuery  -->
    <script type="text/javascript">
      function bloques() {
        var bloque = $('#stBloques').val();
        var parametros = {
          "b": bloque,
        };
        $.ajax({
          data: parametros,
          url: 'notasbloque.php',
          type: 'GET',
          beforeSend: function () {
            var load = '<div class="">' +
              '<div class="text-center">' +
              '<br>' +
              '<img src="../../assets/images/loadcustom.gif" width="80" height="auto" alt=""><br>' +
              '<h3 class="text-muted">Cargando Alumnos</h3>' +
              '<div id="icon">' +
              '<h5 class="text-muted">Esto puede tardar unos minutos</h5>' +
              '</div>' +
              '</div>' +
              '</div>';
            $('#main').html(load);
          },
          success: function (response) {
            $("#main").html(response);
          }
        });
      }
      $('#stBloques').change(function () {
        bloques();
      });
      bloques();
    </script>

</body>

</html>