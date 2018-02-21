<?php require '../lib/sesion.php';
require '../lib/data.php'; ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <?php $titulo="Alumnos"; include '../lib/header.php'; ?>

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
            <h4 class="page-title">Alumnos</h4>
          </div>
        </div>
      </div>

      <!-- sample modal content -->

      <!-- end page title end breadcrumb -->
      <div class="row">
        <div class="col-md-6">
          <div class="card-box">
            <div class="form-group">
              <button type='button' class='info add btn  btn-outline-success btn-icon' data-toggle='modal' data-target='#datos' title='Agregar un nuevo alumno' ><i class=' ti-plus '></i> Agregar Alumno</button>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card-box">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <select id="orden" class="form-control select2" name="">
                    <option value="codigo">Codigo</option>
                    <option value="apellidos">Apellidos</option>
                    <option value="nombres">Nombres</option>
                    <option value="grado">Grado</option>
                    <option value="nacimiento">Edad</option>
                    <option value="otros">Talonario</option>
                    <option value="insertdate">Fecha de Inscripción</option>
                    <option value="ultimaactualizacion">Ultima Modificación</option>
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <button type='button' id="excel" class=' btn btn-simple btn-outline-success btn-icon' data-toggle='modal' data-target='#datos' title='Agregar un nuevo alumno' ><i class=' mdi mdi-file-excel '></i> Exportar a Excel</button>
                  <!--<button type='button' id="pdf" class=' btn btn-simple btn-outline-danger btn-icon' data-toggle='modal' data-target='#datos' title='Agregar un nuevo alumno' ><i class=' mdi mdi-file-pdf '></i> Exportar a PDF</button>-->
                </div>
              </div>
            </div>
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
              <h5>Sin alumnos en la base de datos</h5>
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
                  <th>Codigo</th>
                  <th>Apellidos</th>
                  <th>Nombres</th>
                  <th>Grado</th>
                  <th>Edad</th>
                  <th>Talonario</th>
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

  <div id="infoalumno" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title" id="myModalLabel">Datos del Alumno</h4>
        </div>
        <div class="modal-body">
          <div class="col-lg-12 col-md-12">
            <div class="text-center">
              <div class="member-card">
                <div class="thumb-lg member-thumb m-b-10 center-page">
                  <img src="../../assets/images/users/user.png"  class="rounded-circle img-thumbnail" alt="profile-image">
                </div>

                <div class="">
                  <h5 class="m-b-5 m-t-10" id="txtnombre">Apellidos, Nombres</h5>
                  <p class="text-muted" id="txtcodigo">@codigopersonal</p>
                </div>

                <!---<button type="button" class="btn btn-warning btn-sm w-sm waves-effect m-t-10 waves-light">Editar</button>-->

                <div class="text-left m-t-40">
                  <p class="text-muted font-13"><strong>Edad :</strong> <span class="m-l-15" id="txtedad">txtEdad</span></p>

                  <p class="text-muted font-13"><strong>Fecha de Nacimiento :</strong><span class="m-l-15" id="txtnacimiento">txtNacimiento</span></p>

                  <p class="text-muted font-13"><strong>Encargado :</strong> <span class="m-l-15" id="txtencargado">txtEncargado</span></p>

                  <p class="text-muted font-13"><strong>Tel Encargado :</strong> <span class="m-l-15" id="txttelencargado">txtTelencargado</span></p>
                  <p class="text-muted font-13"><strong># Talonario :</strong> <span class="m-l-15" id="txttalonario">txtTalonario</span></p>
                  <p class="text-muted font-13"><strong>Ultima Actualización :</strong> <span class="m-l-15" id="txtua">txtUA</span></p>
                  <p class="text-muted font-13"><strong>Fecha de Inscripción :</strong> <span class="m-l-15" id="txtins">txtIns</span></p>
                  <p class="text-muted font-13"><strong>Estado Actual :</strong> <span class="m-l-15" id="txtstatus">txtStatus</span></p>
                </div>

              </div>

            </div> <!-- end card-box -->
          </div> <!-- end col -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary-outline waves-effect" data-dismiss="modal">Cerrar</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
</body>
<script src="alumnos.js"></script>
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
function cargar(){
  var idcole=$("#idcole").val();
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
        var orden=$("#orden").val();
        var btn1 = "<div class='pull-right btn-group'><button type='button' class='info btn btn-primary  btn-sm waves-effect waves-light m-b-5'  title='Ver Datos' ><i class=' ti-info-alt '></i></button><button type='button' class='edit btn btn-warning btn-sm waves-effect waves-light m-b-5' title='Editar' ><i class=' ti-pencil-alt '></i></button></div>"
        var btn2 = "<button type='button' class='info btn btn-simple btn-info btn-icon' data-toggle='modal' data-target='#datos' title='Datos Personales' ><i class=' ti-info-alt '></i></button> <button type='button' class='reporte btn btn-simple btn-warning btn-icon' title='Reporte academico' ><i class=' ti-pencil-alt '></i></button>"
        $('#datatables').DataTable({
          "lengthChange": false,
          dom:'Bfrtip',
          buttons: ['excel', 'pdf'],
          "destroy":true,
          "ajax":{
            "method":"POST",
            "url":"../json/alumnos.php?orden="+orden
          },
          "columns":[
            {"data":"codigo", "orderable":false},
            {"data":"apellidos"},
            {"data":"nombres"},
            {"data":"grado"},
            {"data":"edad"},
            {"data":"otros"},
            {"data":"activo"},
            {"data":"opciones"},
          ],
          "pagingType": "full_numbers",
          "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "Todos"]
          ],
          "bSort":false,
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

      }else {
        blank();
      }
    }
  });
}
function limpiar(){
  $.get("../phpshared/selectgradeonly.php", function(data){
    $("#divgrado").html(data);
    $("#grado").select2();
  })
  var divgenero='<label for="genero" class="control-label">Genero *</label><select id="genero"   class="form-control select2"><option value="">Seleccionar</option><option value="M">Masculino</option><option value="F">Femenino</option></select>';
  $("#id").val("0");
  $("#cod").val("");
  $("#nombres").val("");
  $("#apellidos").val("");
  $("#grado").val("");
  $("#divgenero").html(divgenero);
  $("#genero").select2();
  $("#nacimiento").val("dd/mm/aaaa");
  $("#nacionalidad").val("");
  $("#doc").val("");
  $("#nodoc").val("");
  $("#encargado").val("");
  $("#tel-encargado").val("");
  $("#otros").val("");
  $("#otros2").val("");
}
function buscardatos(){
  var codigo = $("#cod").val();
  var parametros = {
    "codigo" : codigo
  };
  //console.log(parametros);
  $.ajax({
    data:  parametros,
    url:   '../json/alumnosauto.php',
    type:  'GET',
    beforeSend: function () {

    },
    success:  function (response) {
      //alert(response);
      if (response=="false") {

      }else {
        //console.log(response[0]["nombre"]);
        var nombres = response[0]["nombre"];
        swal({
          title: "Alumno Encontrado",
          text: nombres+'\n'+' ¿Desea Cargar los datos?',
          icon: "info",
          buttons: ["No", "Si"],
        })
        .then((value) => {
          if (value) {
            $("#cod").val(response[0]["codigo"]);
            $("#nombres").val(response[0]["nombres"]);
            $("#apellidos").val(response[0]["apellidos"]);
            //$("#grado").val();
            //$("#genero").val("");
            if (response[0]["nd"]<10) {
              var dia="0"+response[0]["nd"];
            }else {
              var dia=response[0]["nd"];
            }
            if (response[0]["nm"]<10) {
              var mes="0"+response[0]["nm"];
            }else {
              var mes=response[0]["nm"];
            }
            var naci = dia+"/"+mes+"/"+response[0]["na"];
            $("#nacimiento").val(naci);
            $("#nacionalidad").val("");
            $("#doc").val(response[0]["doc"]);
            $("#nodoc").val(response[0]["nodoc"]);
            $("#encargado").val("");
            $("#tel-encargado").val("");
            $("#otros").val("");
          }
        });
      }
    }
  });
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
  if ( $("#tel-encargado").val() =='') {
    blank=1;
    requerido('{Telefono de Encargado}');
  }
  if ( $("#encargado").val() =='') {
    blank=1;
    requerido('{Nombre de Encargado}');
  }


  if ( $("#genero").val() =='') {
    blank=1;
    requerido('{Genero del alumno}');
  }
  if ( $("#grado").val() =='') {
    blank=1;
    requerido('{Grado a cursar}');
  }
  if ( $("#nacimiento").val() =='' || $("#nacimiento").val() =='dd/mm/aaaa') {
    blank=1;
    requerido('{Fecha de Nacimiento}');
  }
  if ( $("#apellidos").val() =='') {
    blank=1;
    requerido('{Apellidos del Alumno}');
  }
  if ( $("#nombres").val() =='') {
    blank=1;
    requerido('{Nombre del Alumno}');
  }
  if ( $("#cod").val() =='') {
    blank=1;
    requerido('{Codigo Personal}');
  }
  if (blank==0) {
    //console.log("todo bien");
    var id  = $("#id").val();
    var idcole = $("#idcole").val();
    var codigo = $("#cod").val();
    var nombres = $("#nombres").val();
    var apellidos = $("#apellidos").val();
    var grado = $("#grado").val();
    var genero = $("#genero").val();
    var nacimiento = $("#nacimiento").val();
    var nacionalidad = $("#nacionalidad").val();
    var doc = $("#doc").val();
    var nodoc = $("#nodoc").val();
    var encargado = $("#encargado").val();
    var telencargado = $("#tel-encargado").val();
    var otros = $("#otros").val()+" - "+$("#otros2").val();
    var parametros = {
      "id" : id,
      "idcole" : idcole,
      "peticion":"insert",
      "codigo" : codigo,
      "nombres" : nombres,
      "apellidos" : apellidos,
      "grado" : grado,
      "genero" : genero,
      "nacimiento" : nacimiento,
      "nacionalidad" : nacionalidad,
      "doc" : doc,
      "nodoc" : nodoc,
      "encargado" : encargado,
      "telencargado" : telencargado,
      "otros": otros
    };
    //console.log(parametros);
    $.ajax({
      data:  parametros,
      url:   '../ajax/insert.php',
      type:  'GET',
      beforeSend: function () {

      },
      success:  function (response) {
        //alert(response);
        if (response=="Exito") {
          $("#add").toggle(500);
          limpiar();
          cargar();
          swal({
            title: "Exito",
            text: "Alumno Ingresado Exitosamente",
            icon: "success",
          });
        }
        if (response=="Duplicado") {
          swal({
            title: "Duplicado",
            text: "El Codigo Ingresado ya esta asignado a otro alumno",
            icon: "warning",
          });
        }
        if (response=="Error") {
          swal({
            title: "Error",
            text: "Se ha producido un error al ingresar el alumno",
            icon: "danger",
          });
        }
      }
    });
  }
}
$('#datatables').on('click','.edit',function(){
  var table = $('#datatables').DataTable();
  var data = table.row($(this).parents("tr")).data();
  var id = data.idalumno;
  location.href="modificar.php?id="+id;
});
$('#datatables').on('click','.info',function(){
  var table = $('#datatables').DataTable();
  var data = table.row($(this).parents("tr")).data();
  $("#txtnombre").text(data.nombre);
  $("#txtcodigo").text("@"+data.codigo);
  $("#txtedad").text(data.edad);
  $("#txtnacimiento").text(data.nacimiento);
  $("#txtencargado").text(data.encargado);
  $("#txttelencargado").text(data.telencargado);
  $("#txttalonario").text(data.otros);
  $("#txtua").text(data.ua);
  $("#txtins").text(data.ins);
  $("#txtstatus").html(data.activo);
});
$(document).ready(function() {
  $("#orden").change(function(){
    cargar();
  });
  cargar();
  $("#excel").click(function(){
    export2excel();
  });
  $('#nacimiento').datepicker({
    autoclose: true,
    todayHighlight: true,
    language: 'es',
  });
  $("#otros").keyup(function(){
    if (isNaN(parseInt($(this).val()))) {
      var otros=0;
    }else {
      var otros=parseInt($(this).val())+11;
    }
    var otros2 =otros;
    $("#otros2").val(otros);
  });
  $("#cod").blur(function(){buscardatos()});
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
