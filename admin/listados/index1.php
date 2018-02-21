<?php require '../lib/index.php'; ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title><?php echo "$cole"; ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <meta content="Sistema para el control de notas escolares" name="description" />
  <meta content="Jorge Hernandez" name="author" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />

  <link rel="shortcut icon" href="../../assets/images/favicon.ico">

  <!-- Sweet Alert css -->
  <link href="../../plugins/bootstrap-sweetalert/sweet-alert.css" rel="stylesheet" type="text/css" />

  <!-- Plugins css-->
  <link href="../../plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" />
  <link href="../../plugins/multiselect/css/multi-select.css"  rel="stylesheet" type="text/css" />
  <link href="../../plugins/select2/select2.css" rel="stylesheet" type="text/css" />
  <link href="../../plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
  <link href="../../plugins/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet">
  <link href="../../plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
  <link href="../../plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
  <link href="../../plugins/switchery/switchery.min.css" rel="stylesheet" />

  <!-- App css -->
  <link href="../../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="../../assets/css/icons.css" rel="stylesheet" type="text/css" />
  <link href="../../assets/css/style.css" rel="stylesheet" type="text/css" />

  <script src="../../assets/js/modernizr.min.js"></script>

</head>

<body>
  <input type="text" style="display:none;" id="idcole" value="<?php echo $idcole; ?>">
  <?php require '../lib/menu.php'; ?>


  <div class="wrapper">
    <div class="container-fluid">

      <!-- Page-Title -->

      <div class="row">
        <div class="col-sm-12">
          <div class="page-title-box">
            <div class="btn-group pull-right">
              <ol class="breadcrumb hide-phone p-0 m-0">
                <li class="breadcrumb-item"><a href="../"><?php echo "$abrcole"; ?></a></li>
                <li class="breadcrumb-item"><a href="./">Calificaciones</a></li>
                <li class="breadcrumb-item active">Por Alumno</li>
              </ol>
            </div>
            <h4 class="page-title">Calificaciones Por Alumno</h4>
          </div>
        </div>
      </div>
      <!-- end page title end breadcrumb -->
      <div class="row">
        <div class="col-md-6">
          <div class="card-box">
            <?php require '../phpshared/selectgrade.php'; ?>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card-box">

          </div>
        </div>
      </div>
      <div id="blank" style="display:none;" class="row">
        <div class="col-md-12">
          <div class="card-box">
            <div class="text-center">
              <h5>Sin alumnos en la base de datos</h5> <button type="button" class="btn btn-primary waves-effect waves-light m-b-5" id="go" name="button">Ingresar Alumnos</button>
            </div>
          </div>
        </div>
      </div>
      <div style="display:none;" id="content" class="row">
        <div class="col-md-12">
          <div class="card-box table-responsive">
            <!--<h4 class="m-t-0 header-title">Calificaciones Por Alumno</h4>-->
            <table id="datatables" width="100%" class="table table-striped table-hover" cellspacing="0" >
              <thead>
                <tr>
                  <th>Clave</th>
                  <th>Nombres</th>
                  <th>Apellidos</th>
                  <th>Codigo</th>
                  <th>Grado</th>
                  <th>Seccion</th>
                  <th class="text-right">Estatus</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div> <!-- end container -->
  </div>
  <!-- end wrapper -->


  <!-- Footer -->
  <?php include '../lib/foo.php'; ?>
  <!-- End Footer -->
  <?php require '../lib/scripts.php'; ?>

</body>

<script type="text/javascript">
$(document).ready(function() {

  function full(idgrado){

    $('#datatables').DataTable({
      "ajax":{
        "method":"POST",
        "url":"../json/listados.php?idgrado="+idgrado
      },
      searching: false,
      orderable: false,
      destroy: true,
      "columns":[
        {"data":"clave"},
        {"data":"nombres"},
        {"data":"apellidos"},
        {"data":"codigo"},
        {"data":"ngrado"},
        {"data":"seccion"},
        {"data":"activo"}

      ],
      "paging":   false,
      "ordering": false,
      "info":     false,
      responsive: true,
      language: {
        "sProcessing":     "Procesando...",
        "sLengthMenu":     "Mostrar _MENU_ registros",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún dato disponible en esta tabla",
        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sSearch":         "Buscar:",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
          "sFirst":    "Primero",
          "sLast":     "Último",
          "sNext":     "Siguiente",
          "sPrevious": "Anterior"
        },
        "oAria": {
          "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
          "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
      }
    });
    var table = $('#datatables').DataTable();

    content();
  }
  function content(){
    $("#blank").css("display", "none");
    $("#content").css("display", "block");
  }
  function blank(){
    $("#content").css("display", "none");
    $("#blank").css("display", "block");
  }
  function alumnos(){
    var idcole=document.getElementById('idcole').value;
    var require = "alumnos";
    var parametros = {
      "idcole" : idcole,
      "require" : require
    };
    $.ajax({
      data:  parametros,
      url:   '../json/blank.php',
      type:  'GET',
      beforeSend: function () {

      },
      success:  function (response) {
        //alert(response);
        if (response>0) {
          full('all');
        }else {
          blank();
        }
      }
    });
  }
  $('#grados').change(function(){
    full(this.value);
  });
  alumnos();
});
</script>
</html>
