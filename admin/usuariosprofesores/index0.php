<?php require '../lib/sesion.php';
require '../lib/data.php'; ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <?php $titulo="Usuarios"; include '../lib/header.php'; ?>

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
                <li class="breadcrumb-item active">Alumnos</li>
              </ol>
            </div>
            <h4 class="page-title">Usuarios</h4>
          </div>
        </div>
      </div>

      <!-- sample modal content -->

      <!-- end page title end breadcrumb -->

      <div id="blank" style="display:none;" class="row">
        <div class="col-md-12">
          <div class="card-box">
            <div class="text-center">
              <h5>Sin alumnos en la base de datos</h5>
            </div>
          </div>
        </div>
      </div>
      <div class="row" style="display:none;" id="set">
        <div class="col-md-10">
          <div class="card-box">
            <div class="row">
              <div class="col-md-2" style="display:none;">
                <div class="form-group">
                  <label for="cod" class="control-label">Identificador *</label>
                  <input type="text" class="form-control" id="id" value="0" readonly placeholder="id">
                </div>
              </div>
              <div class="col-md-2" style="display:none;">
                <div class="form-group">
                  <label for="cod" class="control-label">type *</label>
                  <input type="text" class="form-control" id="type" value="0" readonly placeholder="id">
                </div>
              </div>
              <div class="col-md-3">
                <div class="widget-user">
                    <img src="../../assets/images/user.png" class="rounded-circle" alt="user">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="nombres" class="control-label text-muted">Nombre del Usuario</label>
                  <h4 id="hnombre">Nombres</h4>
                </div>
              </div>
              <div class="col-md-5">
                <div class="form-group">
                  <label for="nombres" class="control-label text-muted">Tipo de Cuenta</label>
                  <h4 id="htipo">account type</h4>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-8">
                <div class="form-group">
                  <label for="nombres"  class="control-label text-muted">Nombre del Usuario</label>
                  <input type="text" id="usuario" class="form-control" name="" value="">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="pass" class="control-label text-muted">Contraseña</label>
                  <div class="row">
                    <button type='button'  id="reset" class=' btn btn-block btn-outline-warning btn-icon' name="pass" title='Restablecer Contraseña' ><i class=' ti-lock  '></i> Restablecer Contraseña</button>
                  </div>
                </div>
              </div>
              <div class="col-md-4" style="display:none;">
                <div class="form-group">
                  <label for="nombres" class="control-label text-muted">Token</label>
                  <input type="text" id="token" class="form-control" disabled name="" value="">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="col-md-12 pull-right">
            <div class="btn-group-vertical">
              <button type='button' id="excel" class=' btn btn-outline-success btn-icon' title='Cambiar Usuario' ><i class='  ti-save '></i> Guardar Cambios</button>
              <button type='button' id="excel" class=' btn btn-outline-danger btn-icon' title='Eliminar la foto de perfil del usuario' ><i class='ti-image '></i> Eliminar Foto de Perfil</button>
              <button type='button' id="excel" class=' btn btn-outline-secondary btn-icon' title='Imprimir Token' ><i class='ti-printer '></i> Imprimir</button>
              <button type='button' id="excel" class=' btn btn-outline-danger btn-icon' title='Desacivar el usuario' ><i class='ti-key '></i> Desactivar Usuario</button>
              <button type='button' id="cancel" class=' btn btn-danger btn-icon' title='Cancelar' ><i class='ti-close '></i> Cancelar</button>
            </div>
          </div>

        </div>
      </div>
      <div class="row">
        <div class="col-md-12" >
          <div class="card-box">

            <div class="col-md-12" id="divtabla">

            </div>
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
function up(){
  $('html,body').animate({
    scrollTop:0//$("#add").offset().top
  },1000);
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
function cargarprofesores(){
  $("#divtabla").html('<h4>Datos de Profesores</h4><hr><table id="profesores" class="table table-striped table-hover" cellspacing="0" ><thead><tr><th>Usuario</th><th>Nombre</th><th>Estado del profesor</th><th class="disabled-sorting text-right">Acciones</th></tr></thead><tbody></tbody></table>');

  var btn1 = "<button type='button' class='editprofe btn btn-warning btn-sm waves-effect waves-light m-b-5' title='Editar' ><i class=' ti-pencil-alt '></i></button></div>"
  var btn2 = "<button type='button' class='info btn btn-simple btn-info btn-icon' data-toggle='modal' data-target='#datos' title='Datos Personales' ><i class=' ti-info-alt '></i></button> <button type='button' class='reporte btn btn-simple btn-warning btn-icon' title='Reporte academico' ><i class=' ti-pencil-alt '></i></button>"
  $('#profesores').DataTable({
    "destroy":true,
    "ajax":{
      "method":"POST",
      "url":"profesores.php"
    },
    "columns":[
      {"data":"usuario"},
      {"data":"nombre"},
      {"data":"activo"},

      {
        "defaultContent": btn1
      }
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
}
$('body').on('click','.editprofe',function(){

  $("#set").show(500);
  up();
  var table = $('#profesores').DataTable();
  var data = table.row($(this).parents("tr")).data();
  console.log(data);
  $("#id").val(data.idprofesor);
  $('#type').val("P");
  $('#hnombre').text(data.nombre);
  $('#htipo').text("Profesor");
  $("#token").val("No disponible para profesores");
  $("#usuario").val(data.usuario);
  //var id = data.idalumno;
  //location.href="modificar.php?id="+id;
});
$(document).ready(function(){
  cargarprofesores();
  $("#cancel").click(function(){
    $("#set").hide(500);
  });

  //cargaralumnos();
});
</script>
</html>
