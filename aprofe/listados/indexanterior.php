<?php require '../lib/index.php'; ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <?php $titulo="Listados";
  include '../lib/header.php'; ?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <meta content="Sistema para el control de notas escolares" name="description" />
  <meta content="Jorge Hernandez" name="author" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />



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

      <br>
      <!-- end page title end breadcrumb -->
      <div class="row">
        <div class="col-md-12">
          <div class="card-box">
            <h4 class="header-title m-t-0 m-b-30">Impresión de Listados</h4>

            <ul class="nav nav-tabs">
              <li class="nav-item">
                <a href="#home" data-toggle="tab" aria-expanded="false" class="nav-link active">
                  De Asistencia
                </a>
              </li>
              <li class="nav-item">
                <a href="#settings" data-toggle="tab" aria-expanded="false" class="nav-link">
                  En Blanco
                </a>
              </li>
              <li class="nav-item">
                <a href="#calif" data-toggle="tab" aria-expanded="false" class="nav-link">
                  Calificación
                </a>
              </li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane fade active show" id="home">
                <div class="row">

                  <div class="col-md-2" >
                    <select class="form-control select2" id="size" name="">
                      <option value="v">Vertical</option>
                      <option value="h">Horizontal</option>
                    </select>
                  </div>
                  <div class="col-md-2" id="divmes">
                    <select class="form-control select2" id="mes" name="">
                      <?php
                      setlocale(LC_ALL, 'es_GT');
                      date_default_timezone_set("America/Guatemala");
                      $meses=array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre");
                      for ($i=1; $i <=12 ; $i++) {
                        $ma=$i-1;
                        $mes=date("m")-1;
                        if ($ma==$mes) {
                          $s="selected";
                        }else {
                          $s="";
                        }
                        echo "<option $s value='$i'>".$meses[$ma]."</option>";
                        $s="";
                      }
                      ?>
                    </select>
                  </div>
                  <div class="col-md-3">
                    <button type='button' class='gen1 add btn btn-simple btn-success btn-icon' data-toggle='modal' data-target='#datos' title='Descargar' ><i class=' mdi mdi-file-pdf  '></i> Descargar Listados</button>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="settings">
                <div class="row">
                  <div class="col-md-3">
                    <?php
                    require '../../conexion/conexion.php';
                    $sql="SELECT * FROM `grados` WHERE idcole = '$idcole'";
                    $con=mysqli_query($conexion,$sql);
                    echo '
                    <select    id="grado2" class="form-control select2">
                    <option value="none">Seleccionar Grado</option>';
                    while ($cg=mysqli_fetch_array($con)) {
                      $idg=$cg['idgrado'];
                      $grado=$cg['boton'];
                      //echo "<optgroup label=\"$grado\">";
                      echo "<option value=\"$idg\">$grado</option>";
                      //echo "</optgroup>";

                    }
                    require '../../conexion/cerrar_conexion.php';
                    echo "</select>";
                    ?>
                  </div>
                  <div class="col-md-2" id="divsec2">
                    <select class="form-control select2" name="">
                      <option value="">Seleccionar</option>
                    </select>
                  </div>
                  <div class="col-md-2">
                    <select class="form-control select2" id="columnas" name="">
                      <option value="none">Columnas</option>
                      <?php
                      for ($o=1; $o <=20 ; $o++) {
                        echo "<option value='$o'>$o</option>";
                      }
                      ?>
                    </select>
                  </div>
                  <div class="col-md-3">
                    <input type="text" name="" class="form-control" value="" id="titulo" placeholder="Titulo del Listado">
                  </div>
                  <div class="col-md-2">
                    <button type='button' class='gen2 btn btn-simple btn-danger btn-icon' data-toggle='modal' data-target='#datos' title='Agregar un nuevo alumno' ><i class=' mdi mdi-file-pdf  '></i> Generar</button>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="calif">
                <div class="row">
                  <div class="col-md-12">
                    <button type="button" class="btn btn-success tcuadros" name="button"><i class="ti-printer"></i> Imprimit Todos los Cuadros de Calificación</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> <!-- end col -->
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card-box" id="frame">
            <div class="">
              <div class="text-center">
                <br>
                <img src="../../assets/images/nodatafound2.png" width="80" height="auto" alt=""><br>
                <div id="icon">
                  <h5 class="text-muted">Selecione un grado para visualizar el listado</h5>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


    </div> <!-- end container -->
  </div>
  <!-- end wrapper -->
  <div class="modal fade mostrarlistado" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title" id="myLargeModalLabel">Listados</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <iframe id="iframe" src="" width="100%" height="600px"></iframe>
            </div>
          </div>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

  <!-- Footer -->
  <?php include '../lib/foo.php'; ?>
  <!-- End Footer -->
  <?php require '../lib/scripts.php'; ?>

</body>

<script type="text/javascript">
function asistencia(){
  var mes=$("#mes").val();
    var url="asistencia.php?m="+mes;
    $("#iframe").attr("src", url);

}
function enblanco(){
  var idgrado=$("#grado2").val();
  var seccion=$('#secciones2').val();
  var columnas=$("#columnas").val();
  var r=1;
  if (idgrado=="none") {
    swal({
      title: "Campo Requerido",
      text: "Necesita Selecionar Un Grado",
      icon: "warning",
    });
    r=0;
  }
  if (seccion=="none" || seccion=='undefined') {
    swal({
      title: "Campo Requerido",
      text: "Necesita Selecionar Una Seccion",
      icon: "warning",
    });
    r=0;
  }
  if (columnas=="none") {
    swal({
      title: "Campo Requerido",
      text: "Necesita Selecionar la Cantidad de Columnas",
      icon: "warning",
    });
    r=0;
  }
  if (r==1) {
    if (seccion=="All") {
      var titulo=$("#titulo").val();
      var grado=idgrado+"-"+seccion+"-"+columnas+"&titulo="+titulo;
      var url="../reportes/listadoenblanco.php?grado="+grado;
      $("#iframe").attr("src", url);
    }else {
      var grado=idgrado+"-"+seccion+"-"+mes;
      var url="../reportes/asistenciagradoseccion.php?grado="+grado;
      $("#iframe").attr("src", url);
    }
    swal("Generando Listado", {
      buttons: false,
    });
    $('#iframe').ready(function() {
      swal.close();
        $(".mostrarlistado").modal();
    });
  }
}

$("#grado1").change(function(){
  $.get("secciones.php?id=1&idgrado="+$("#grado1").val(),function(sec){
    $("#divsec1").html(sec);
    $("#secciones1").select2();
  });
});
$("#grado2").change(function(){
  $.get("secciones.php?id=2&idgrado="+$("#grado2").val(),function(sec){
    $("#divsec2").html(sec);
    $("#secciones2").select2();
  });
});
$(".gen1").on('click',function(){
  asistencia();
});
$(".gen2").on('click',function(){
  enblanco();
});
$(document).ready(function() {
  $(".tcuadros").click(function(){
    var url="../reportes/index.php";
    $("#iframe").attr("src", url);
    swal("Generando Listado", {
      buttons: false,
    });
    $('#iframe').ready(function() {
      swal.close();
        $(".mostrarlistado").modal();
    });
  });
  function content(){
    $("#blank").css("display", "none");
    $("#content").css("display", "block");
  }
  function blank(){
    $("#content").css("display", "none");
    $("#blank").css("display", "block");
  }
});
</script>
</html>
