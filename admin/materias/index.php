<?php require '../lib/sesion.php';
require '../lib/data.php'; ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <?php $titulo="Materias"; include '../lib/header.php'; ?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <meta content="Sistema para el control de notas escolares" name="description" />
  <meta content="Jorge Hernandez" name="author" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />

  <!-- App css -->
  <!-- DataTables -->
  <link href="../../plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
  <link href="../../plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
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
                <li class="breadcrumb-item"><a href="./">Alumnos</a></li>
                <li class="breadcrumb-item active">Materias</li>
              </ol>
            </div>
            <h4 class="page-title">Materias</h4>
          </div>
        </div>
      </div>

      <!-- sample modal content -->

      <!-- end page title end breadcrumb -->
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <button type='button' class='info add btn btn-simple btn-success btn-icon' data-toggle='modal' data-target='#datos' title='Agregar un nuevo alumno' ><i class=' ti-plus '></i> Agregar Materias</button>
          </div>
        </div>

      </div>
      <div class="row" style="display:none;" id="add">
        <div class="col-md-12">
          <div class="card-box">
            <form class=""  id="add-form">
              <?php include 'alumnform.php'; ?>
              <div class="row">
                <div class="col-md-12">

                  <div class="pull-right">
                    <p class="text-muted ">(*) Datos Obligatorios</p>
                    <button class="btn save btn-success waves-effect waves-light m-b-5"> <i class="fa  fa-save  m-r-5"></i> <span>Guardar Datos</span> </button>
                    <button class="btn clear btn-warning waves-effect waves-light m-b-5"> <i class="fa  fa-sticky-note-o m-r-5"></i> <span>Limpiar</span> </button>
                    <button class="btn cancel btn-danger waves-effect waves-light m-b-5"> <i class="fa  fa-ban m-r-5"></i> <span>Cancelar</span> </button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div id="blank" style="display:none;" class="row">
        <div class="col-md-12">
          <div class="card-box">
            <div class="text-center">
              <h5>Sin materias en la base de datos</h5>
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
                  <th>ID</th>
                  <th>Nombre de la Materia</th>
                  <th>Nombre Corto</th>
                  <th class="disabled-sorting text-right">Opciones</th>
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
function content(){
  $("#blank").css("display", "none");
  $("#content").css("display", "block");
}
function blank(){
  $("#content").css("display", "none");
  $("#blank").css("display", "block");
}
function requerido(campo){
  swal({
    title: "Campo Requerido",
    text: campo,
    icon: "warning",
  });
}
function error(campo){
  swal({
    title: "Error",
    text: campo,
    icon: "warning",
  });
}
function cargar(){
  var table =$('#datatables').DataTable({
    "destroy":true,
    "ajax":{
      "method":"POST",
      "url":"json.php"
    },
    "lengthChange": false,
    dom:'Bfrtip',
    buttons: ['excel', 'pdf'],
    "columns":[
      {"data":"idnombremateria"},
      {"data":"nombre"},
      {"data":"corto"},
      {"data":"opciones"},
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
  table.buttons().container()
  .appendTo($('.col-md-6:eq(0)', table.table().container()));
}

function enblanco(){
  var tabla = "nombrematerias";
  var parametros = {
    "tabla" : tabla,
  };
  $.ajax({
    data:  parametros,
    url:   '../json/enblanco.php',
    type:  'POST',
    beforeSend: function () {

    },
    success:  function (response) {
      if (response['r']) {
        if (response['msg']==0) {
          blank();
        }else {
          cargar();
          content();
        }
      }else {
        error(response['msg']);
      }
    }
  });
}
function limpiar(){
  $("#id").val("0");
  $(".inputcontrol").val("");
}
function export2excel(){
  var orden=$("#orden").val();
  var nombreorden=$("#orden option:selected").text();
  $.get('../PHPExcel/alumnos2excel.php?orden='+orden+'&no='+nombreorden,function(data){
    location="../PHPExcel/"+data;
    //$.get('../PHPExcel/unlink.php?file='+data,function(data2){});
  });
}
function guardar(){
  var blank=0;
  if ($('.inputcontrol').val()=="") {
    requerido("Los campos con un (*) son obligatorios");
    blank=1;
  }
  if (blank==0) {
    //console.log("todo bien");
    var id  = $("#id").val();
    var nombre = $("#nombre").val();
    var corto = $("#corto").val()
    var parametros = {
      "id" : id,
      "nombre":nombre,
      "corto" : corto
    };
    //console.log(parametros);
    $.ajax({
      data:  parametros,
      url:   'ajax.php',
      type:  'GET',
      beforeSend: function () {

      },
      success:  function (response) {
        //alert(response);
        if (response=="true") {
          $("#add").toggle(500);
          limpiar();
          cargar();
          swal({
            title: "Exito",
            text: "Materia Ingresada Exitosamente",
            icon: "success",
          });
        }else {
          swal({
            title: "Error",
            text: response,
            icon: "warning",
          });
        }
      }
    });
  }
}

$('#datatables').on('click','.edit',function(){
  var table = $('#datatables').DataTable();
  var data = table.row($(this).parents("tr")).data();
  var id = data.idnombremateria;
  var nombre=data.nombre;
  var corto=data.corto;
  $("#id").val(id);
  $("#nombre").val(nombre);
  $("#corto").val(corto);
  $("#add").show(500);
  $('html,body').animate({
    scrollTop:0//$("#add").offset().top
  },1000);
});
$(document).ready(function() {
  enblanco();
  $(".cancel").click(function(e){
    $("#add").toggle(500);
    e.preventDefault();
  });
  $(".clear").click(function(e){
    e.preventDefault();
    limpiar();
  });
  $(".add").click(function(e){
    $("#add").toggle(500);
    limpiar();
    e.preventDefault();
  });
  $(".save").click(function(e){
    e.preventDefault();
    guardar();
  });
});
</script>
</html>
