<?php require '../lib/index.php'; ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <?php $titulo="Grados";
  include '../lib/header.php'; ?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <meta content="Sistema para el control de notas escolares" name="description" />
  <meta content="Jorge Hernandez" name="author" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />



  <!-- App css -->
  <link href="../../plugins/select2/select2.css" rel="stylesheet" type="text/css" />
  <link href="../../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="../../assets/css/icons.css" rel="stylesheet" type="text/css" />
  <link href="../../assets/css/style.css" rel="stylesheet" type="text/css" />
  <link href="../../plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">

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

                <li class="breadcrumb-item active">Grados</li>
              </ol>
            </div>
            <h4 class="page-title">Grados</h4>
          </div>
        </div>
      </div>
      <!-- end page title end breadcrumb  -->
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <button type='button' class='info add btn btn-simple btn-success btn-icon' data-toggle='modal' data-target='#datos' title='Agregar un nuevo alumno' ><i class=' ti-plus '></i> Agregar Grado</button>
          </div>
        </div>
      </div>

      <div id="blank" style="display:none;" class="row">
        <div class="col-md-12">
          <div class="card-box">
            <div class="text-center">
              <h5>Sin grados en la base de datos</h5>
            </div>
          </div>
        </div>
      </div>
      <div style="display:none;" id="content" class="row">
        <div class="col-md-12">
          <div class="card-box table-responsive">
            <!--<h4 class="m-t-0 header-title">Calificaciones Por Alumno</h4>-->
            <table id="datatables" class="table table-striped table-hover" cellspacing="0" >
              <thead>
                <tr>
                  <th>Grado</th>
                  <th>Secciones</th>
                  <th>Cantidad de Clases</th>
                  <th >Estado</th>
                  <th class="disabled-sorting text-right">Acciones</th>
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
  <!--  Modal content for the above example -->


</body>

<script type="text/javascript">
$(document).ready(function() {

  function listargrados(){
    function content(){
      $("#blank").css("display", "none");
      $("#content").css("display", "block");
    }
    function blank(){
      $("#content").css("display", "none");
      $("#blank").css("display", "block");
    }
    function cargar(){
      var idcole=document.getElementById('idcole').value;
      var require = "grados";
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
            var btn1 = "<div class='pull-right btn-group'><button type='button' class='info btn btn-dark  btn-sm waves-effect waves-light m-b-5'  title='Ver Datos' ><i class='  ti-settings  '></i></button><button type='button' class='edit btn btn-warning btn-sm waves-effect waves-light m-b-5' title='Editar' ><i class=' ti-pencil-alt '></i></button></div>"
            var btn2 = "<button type='button' class='info btn btn-simple btn-info btn-icon' data-toggle='modal' data-target='#datos' title='Datos Personales' ><i class=' ti-info-alt '></i></button> <button type='button' class='reporte btn btn-simple btn-warning btn-icon' title='Reporte academico' ><i class=' ti-pencil-alt '></i></button>"
            $('#datatables').DataTable({
              "destroy":true,
              "ajax":{
                "method":"POST",
                "url":"../json/grados.php"
              },
              "columns":[
                {"data":"boton"},
                {"data":"secciones"},
                {"data":"clases"},
                {"data":"activo"},
                {"data":"opciones"}
              ],
              "pagingType": "full_numbers",
              "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "Todos"]
              ],
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
            // Edit record
            table.on('click', '.edit', function() {
              var data = table.row($(this).parents("tr")).data();
              var id = data.idgrado;
              location.href="update.php?id="+id;
            });

            table.on('click', '.info', function() {
              var data = table.row($(this).parents("tr")).data();
              var id = data.idgrado;


              location.href="../asignarmaterias/?idgrado="+id;
            });

            $('.card .material-datatables label').addClass('form-group');
            content();
          }else {
            blank();
          }
        }
      });
    }
    $(".add").click(function(){
      location="update.php?id=insert";
    });
    cargar();
  }
  listargrados();
});
</script>
</html>
