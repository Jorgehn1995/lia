<?php include '../lib/sesion.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <?php $titulo="Asignar Secciones";
  include '../lib/header.php'; ?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <meta content="Sistema para el control de notas escolares" name="description" />
  <meta content="Jorge Hernandez" name="author" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />


  <link href="../../plugins/nestable/jquery.nestable.css" rel="stylesheet" />
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

  <?php include '../lib/menu.php'; ?>


  <div class="wrapper">
    <div class="container-fluid">

      <!-- Page-Title -->
      <div class="row">
        <div class="col-sm-12">
          <div class="page-title-box">
            <div class="btn-group pull-right">
              <ol class="breadcrumb hide-phone p-0 m-0">
                <li class="breadcrumb-item"><a href="../"><?php echo "$abrcole"; ?></a></li>
                <li class="breadcrumb-item active">Listados</li>

              </ol>
            </div>
            <h4 class="page-title">Asignar alumno a secciones</h4>
          </div>
        </div>
      </div>
      <!-- end page title end breadcrumb -->
      <div class="row">
        <div class="col-md-4">
          <div class="card-box">
            <h4 class="m-t-0 m-b-30 header-title"><b>Seleccionar Grado</b></h4>
            <select id="grados" class="form-control select2">
              <option>Grado</option>
              <?php
              require '../../conexion/conexion.php';
              $sql="SELECT * FROM `grados` WHERE idcole = '$idcole'";
              $con=mysqli_query($conexion,$sql);
              while ($cg=mysqli_fetch_array($con)) {
                $idg=$cg['idgrado'];
                $grado=$cg['boton'];
                //echo "<optgroup label=\"$grado\">";
                echo "<option value=\"$idg\">$grado</option>";
                //echo "</optgroup>";
              }
              ?>
            </select>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card-box">
            <h4 class="m-t-0 m-b-30 header-title"><b>Alineacion</b></h4>
            <select id="alig" class=" form-control select2" name="">
              <option  value="h">Horizontal</option>
              <option selected value="v">Acoplada</option>
            </select>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card-box">
            <h4 class="m-t-0 m-b-25 header-title"><b>Acciones</b></h4>
            <button id="guardar" class="btn btn-success waves-effect waves-light m-b-5"> <i class="  ti-save   "></i> <span>Guardar Distribución</span> </button>
            <button id="print" class="btn btn-secondary waves-effect waves-light m-b-5"> <i class="  ti-printer   "></i> <span> Imprimir</span> </button>
          </div>
        </div>

      </div>

      <div class="row" id="conseccion">

      </div>
      <div class="row" >
        <div class="col-md-6">
          <div class="card-box" id="divsinasignar">
            <h4 class="m-t-0 m-b-25 header-title"><b>Sin Sección</b></h4>
            <!--<div class="btn btn-group">
            <button id="link" class="btn btn-success waves-effect waves-light m-b-5"> <i class=" ti-link "></i> <span> Asignar</span> </button>
            <button id="link" class="btn btn-secondary waves-effect waves-light m-b-5"> <i class=" ti-layout-list-thumb-alt "></i> <span> Ordenar H/M</span> </button>
            <button id="unlink" class="btn btn-danger waves-effect waves-light m-b-5"> <i class=" ti-unlink "></i> <span> Quitar Todos</span> </button>
          </div>-->
          <div class="custom-dd dd" id="sinasignar">

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
<!-- jQuery  -->
<?php include '../lib/scripts.php'; ?>
<!--<script src="../../assets/js/jquery.menu.js"></script>-->
<script type="text/javascript">
function sinasignar() {
  var idgrado=$("#grados").val();
  $.get("sinseccion.php?idgrado="+idgrado,function(data){
    if (data=="") {
      $('#sinasignar').nestable();
    }else {
      $('#sinasignar').html(data);
      $('#sinasignar').nestable();
    }
  });
}
function asignados(){
  var idgrado=$("#grados").val();
  var alig=$("#alig").val();
  if (alig=='h') {
    $.get("conseccion.php?idgrado="+idgrado,function(data){
      //$('#conseccion').nestable();
      $('#conseccion').html(data);
      $('#sec1').nestable();
      $('#sec2').nestable();
      $('#sec3').nestable();
      $('#sec4').nestable();
      $('#sec5').nestable();
    });
  }else {
    $.get("consecciontab.php?idgrado="+idgrado,function(data){
      //$('#conseccion').nestable();
      $('#conseccion').html(data);
      $('#sec1').nestable();
      $('#sec2').nestable();
      $('#sec3').nestable();
      $('#sec4').nestable();
      $('#sec5').nestable();
    });
  }

}
$(document).ready(function(){
  $("#alig").change(function(){
    $("#grados").change();
  });
  $("#print").click(function(){
    location="./";
  });
  $("#grados").change(function(){
    sinasignar();
    asignados();
  });
  $("#guardar").click(function(){
    //serializar();
    var sinasignar= window.JSON.stringify($('#sinasignar').nestable('serialize'));
    var sec1= window.JSON.stringify($('#sec1').nestable('serialize'));
    var sec2= window.JSON.stringify($('#sec2').nestable('serialize'));
    var sec3= window.JSON.stringify($('#sec3').nestable('serialize'));
    var sec4= window.JSON.stringify($('#sec4').nestable('serialize'));
    var sec5= window.JSON.stringify($('#sec5').nestable('serialize'));
    //alert(sec1);
    //console.log(sinasignar);
    //console.log(sec1);
    //console.log(sec2);
    //console.log(sec3);
    //console.log(sec4);
    //console.log(sec5);
    var parametros = {
      "sinasignar": sinasignar,
      "sec1" : sec1,
      "sec2" : sec2,
      "sec3" : sec3,
      "sec4" : sec4,
      "sec5" : sec5
    };
    //console.log(parametros);
    $.ajax({
      data:  parametros,
      url:   '../ajax/ordenarsecciones.php',
      type:  'GET',
      beforeSend: function () {
        swal({
          //title: "Procesando Solicitud",
          text: "Procesando Solicitud",
          icon: false,
          buttons: false
        });
      },
      success:  function (response) {
        //console.log(response);
        if (response=="Exito") {
          swal({
            title: "Exito",
            text: "Asignaciones realizadas con exito",
            icon: "success",
            buttons: false
          });
          $("#grados").change();
        }else {
          swal({
            title: "Error",
            text: response,
            icon: "error",
            buttons: false
          });
        }
      }
    });
  });
});
</script>
</body>
</html>
