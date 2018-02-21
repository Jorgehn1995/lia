<?php require '../lib/index.php';
if (isset($_GET['idgrado'])) {
  $idgrado=$_GET['idgrado'];
}else {
  $idgrado="";
}
if (isset($_GET['sec'])) {
  $sec=$_GET['sec'];
}else {
  $sec="";
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <?php $titulo="Asesores"; include '../lib/header.php'; ?>
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
  <link href="../../plugins/switchery/switchery.min.css" rel="stylesheet" />
  <script src="../../assets/js/modernizr.min.js"></script>

</head>

<body>
  <input type="text" style="display:none;" id="idcole" value="<?php echo $idcole; ?>">
  <input type="text" style="display:none;" id="idgrado" value="<?php echo $idgrado; ?>">
  <input type="text" style="display:none;" id="sec" value="<?php echo $sec; ?>">
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

                <li class="breadcrumb-item active">Asesores</li>
              </ol>
            </div>
            <h4 class="page-title">Asesores</h4>
          </div>
        </div>
      </div>
      <!-- end page title end breadcrumb  -->

      <div id="blank" style="display:none;" class="row">
        <div class="col-md-12">
          <div class="card-box">
            <div class="text-center">
              <div class="">
                <div class="text-center">
                  <br>
                  <img src="../../assets/images/nodatafound2.png" width="80" height="auto" alt=""><br>
                  <div id="icon">
                    <h5 class="text-muted">Selecione un grado para asignaciones</h5>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div style="display:none;" id="content" class="row">

        <div class="row">
          <div class="col-md-12" id="asignar" style="display:none;" >
            <div class="card-box">
              <div class="row">
                <div class="col-md-2" style="display:none;">
                  <div class="form-group">
                    <label for="cod" class="control-label">Identificador *</label>
                    <input type="text" class="form-control " id="id" value="0" readonly placeholder="id">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="cod" class="control-label">Grado *</label>
                    <input type="text" id="nmateria" class="form-control" disabled name="" value="">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="nombres" class="control-label">Asesor *</label>
                    <div id="divprofesores">
                      <select class="form-control select2" id="profesores" name="">
                        <option value="none">Seleciona Asesor</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">

                  <div class="pull-right">
                    <p class="text-muted ">(*) Datos Obligatorios</p>
                    <button class="btn save btn-success waves-effect waves-light m-b-5"> <i class=" ti-link "></i> <span>Guardar Datos</span> </button>
                    <button class="btn unlink btn-danger waves-effect waves-light m-b-5"> <i class=" ti-unlink "></i> <span>Desasignar Datos</span> </button>
                    <button class="btn cancel btn-secondary waves-effect waves-light m-b-5"> <i class="fa  fa-ban m-r-5"></i> <span>Cancelar</span> </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card-box table-responsive">
              <!--<h4 class="m-t-0 header-title">Calificaciones Por Alumno</h4>-->
              <table id="datatables" class="table table-striped table-hover" cellspacing="0" >
                <thead>
                  <tr>
                    <th width="45%">Nombre Grado</th>
                    <th width="5%">Seccion</th>
                    <th width="35%">Asesor</th>
                    <th width="15%"class="disabled-sorting text-right">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
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
function blank(){
  $("#content").css("display", "none");
  $("#blank").css("display", "block");
}
function notifi(tipo,titulo,msg){
  $.Notification.autoHideNotify(tipo, 'top right', titulo, msg);
}
function selectmaterias(idnm){
  var idgrado = $("#idgrado").val();
  var seccion = $("#sec").val();
  var parametros = {
    "idgrado" : idgrado,
    "seccion" : seccion,
    "idnm":idnm
  };
  $.ajax({
    data:  parametros,
    url:   'selectmaterias.php',
    type:  'POST',
    success: function (response) {
      $("#divmaterias").html(response);
      $("#materias").select2();
    }
  });
}
function guardar(){

  var id = $("#id").val();
  var idprofe=$("#profesores").val();
  var parametros = {
    "id" : id,
    "idprofe":idprofe
  };
  $.ajax({
    data:  parametros,
    url:   'ajax.php',
    type:  'POST',
    success: function (response) {
      if (response=="true") {
        notifi("success","Exito","Asesor Asignado Exitosamente");
        $("#asignar").hide(500);
        //$("#selectgrade").show(500);
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
function desasignar(){
  var id = $("#id").val();
  var idprofe=$("#profesores").val();
  var parametros = {
    "id":id,
    "idprofe":idprofe
  };
  $.ajax({
    data:  parametros,
    url:   'ajaxdesasignar.php',
    type:  'POST',
    success: function (response) {
      if (response=="true") {
        notifi("success","Exito","Asesor Desasignado Exitosamente");
        $("#asignar").hide(500);
        //$("#selectgrade").show(500);
        cargar();
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
function selectgrados(idprofe){
  var idgrado = $("#idgrado").val();
  var seccion = $("#sec").val();
  var parametros = {
    "idgrado" : idgrado,
    "seccion" : seccion
  };
  $.ajax({
    data:  parametros,
    url:   '../phpshared/selectgradeselected.php',
    type:  'POST',
    success: function (response) {
      $("#divgrados").html(response);
      $("#grados").select2();
    }
  });
}
function selectprofesores(idprofe){
  var parametros = {
    "idprofe":idprofe
  };
  $.ajax({
    data:  parametros,
    url:   'selectprofesores.php',
    type:  'POST',
    success: function (response) {
      $("#divprofesores").html(response);
      $("#profesores").select2();
    }
  });
}
function cargar(){

  var btn1 = "<div class='pull-right btn-group'><button type='button' class='save btn btn-success btn-sm waves-effect waves-light m-b-5' title='Editar' >Guardar <i class='  ti-save  '></i></button></div>"
  var btn2 = "<button type='button' class='info btn btn-simple btn-info btn-icon' data-toggle='modal' data-target='#datos' title='Datos Personales' ><i class=' ti-info-alt '></i></button> <button type='button' class='reporte btn btn-simple btn-warning btn-icon' title='Reporte academico' ><i class=' ti-pencil-alt '></i></button>"
  $('#datatables').DataTable({
    "lengthChange": false,
    dom:'Bfrtip',
    buttons: ['excel', 'pdf'],
    "destroy":true,
    "ajax":{
      "method":"POST",
      "url":"json.php"
    },
    searching: false,
    orderable: false,
    destroy: true,
    "paging":   false,
    "ordering": false,
    "info":     false,
    "columns":[
      {"data":"nombregrado"},
      {"data":"seccion"},
      {"data":"profesor"},
      {"data":"opciones"},
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
  content();
}
$('#datatables').on('click','.edit',function(){
  var table = $('#datatables').DataTable();
  var data = table.row($(this).parents("tr")).data();
  var id = data.idgrado+"-"+data.seccion;
  var idprofe= data.idprofesor;
  var nombremateria= data.nombregrado;
  var seccion=data.seccion;
  selectprofesores(idprofe);
  $('#id').val(id);
  $("#nmateria").val(nombremateria+" "+seccion);
  $("#asignar").show(500);
  //$("#selectgrade").hide(500);
  $('html,body').animate({
    scrollTop:0//$("#add").offset().top
  },1000);
});
$('body').on('change','#grados',function(){
  var title=$(document).attr('title');
  var ntt=title.split(" - ");
  var ntitle=$('#grados option:selected').text();
  var nt=ntt[0]+" - "+ntitle;
  $(document).attr('title',nt);
  var grados=$(this).val();
  var exp=grados.split('-');
  $('#idgrado').val(exp[0]);
  $("#sec").val(exp[1]);
  cargar();
});
$(document).ready(function() {
  $(".add-profesores").click(function(){
    location="../profesores/";
  });
  $(".add-materias").click(function(){
    location="../materias/";
  });
  cargar();
  selectgrados();

  $(".save").click(function(){
    guardar();
    cargar();
  })
  $(".unlink").click(function(){
    swal({
      title: "¿Estas Seguro?",
      text: "Se borrarán los datos de la materia y el profesor asociados",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((value) => {
      if (value) {
        desasignar();
      }
    });
  })
  $(".cancel").click(function(){
    $("#asignar").hide(500);
    //$("#selectgrade").show(500);
  });
});
</script>
<link href="../../plugins/switchery/switchery.min.css" rel="stylesheet" />
<script src="../../plugins/select2/select2.min.js" type="text/javascript"></script>
</html>
