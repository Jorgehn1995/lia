<?php include '../lib/index.php';

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="iso-8859-1">
  <?php $titulo="Notas por Grado";
  include '../lib/header.php'; ?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <meta content="Sistema para el control de notas escolares" name="description" />
  <meta content="Jorge Hernandez" name="author" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <link href="../../plugins/fancibox/jquery.fancybox.min.css" rel="stylesheet">


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
  <style media="screen">
  .vText {
    writing-mode: vertical-lr;
    transform: rotate(180deg);
    font-size:12px;
  }
  </style>

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
                <li class="breadcrumb-item"><a href="./">Calificaciones</a></li>
                <li class="breadcrumb-item active">Por Grado</li>
              </ol>
            </div>
            <h4 class="page-title">Calificaciones Por Grado</h4>
          </div>
        </div>
      </div>
      <!-- end page title end breadcrumb -->
      <div class="row">
        <div class="col-md-3">
          <div class="card-box">
            <h4 class="m-t-0 m-b-30 header-title"><b>Seleccionar Bloque</b></h4>
            <select id="bloques" class="form-control select2">
              <option>Grado</option>
              <?php
              for ($i=1; $i <=$bloqueencurso ; $i++) {
                if ($i==$bloqueencurso) {
                  $s="selected";
                }else {
                  $s="";
                }
                echo '<option '.$s.' value="'.$i.'">Bloque '.$i.'</option>';
              }
               ?>

            </select>
          </div>
        </div>
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
                echo "<optgroup label=\"$grado\">";
                for ($i=1; $i <=5 ; $i++) {
                  $s="sec"."$i";
                  $sec=$cg[$s];
                  if ($sec=="") {

                  }else {
                    echo "<option value=\"$idg-$sec\">$grado $sec</option>";
                  }
                }
                echo "</optgroup>";
              }
              ?>
            </select>
          </div>
        </div>


        <div class="col-md-5">
          <div class="card-box">
            <h4 class="m-t-0 m-b-30 header-title"><b>Fichas a</b></h4>
            <button id="fg" class="btn btn-success waves-effect waves-light m-b-5 btn-fichaxgrado"> <i class=" ti-printer "></i> <span>Fichas de Grados</span></button>
            <!--<button id="excel" class="btn btn-success waves-effect waves-light m-b-5"> <i class=" mdi mdi-file-excel-box "></i> <span>Excel</span> </button>
            <button id="word" class="btn btn-primary waves-effect waves-light m-b-5"> <i class=" mdi mdi-file-word-box "></i> <span>Word</span> </button>
            <button class="btn btn-danger waves-effect waves-light m-b-5"> <i class=" mdi mdi-file-pdf-box "></i> <span>PDF</span> </button>-->
          </div>
        </div>
      </div>
      <div class="row" style="display:none;" id="table-container" >
        <div class="col-md-12">
          <div class="card-box table-responsive" id="docx">
            <!--<h4 class="m-t-0 header-title">Calificaciones Por Alumno</h4>-->
            <div class="WordSection1" id="tabladedatos">

            </div>
          </div>
        </div>
      </div>
      <!-- end container -->
    </div>
    <!-- end wrapper -->


    <!-- Footer -->
    <?php include '../lib/foo.php'; ?>
    <!-- End Footer -->
    <?php require '../lib/scripts.php'; ?>
    <script src="../../plugins/fancibox/jquery.fancybox.min.js"></script>
    <script type="text/javascript">
    function fancyoffice(url,nombre){

      //var nurl="https://view.officeapps.live.com/op/view.aspx?src=http://www.inmedcoop.com/aprofe/nube/"+url;
      //alert(url);
      $.fancybox.open([{
        src  : url,
        type : "iframe",
        opts : {
          caption : nombre
        }
      }], {
        loop : false
      });
      return false;
    }
    $('body').on("click", '.btn-ficha',function(){
      var b=$("#bloques").val();
      var nurl="../reportes/generarficha.php?id="+$(this).data("id")+"&b="+b;
      fancyoffice(nurl,name);
    });
    $('body').on("click", '.btn-fichaxgrado',function(){
      var b=$("#bloques").val();
      var idgrado=$("#grados").val();
      var sp=idgrado.split("-");
      var materias = 0;
      var idg=sp[0];
      var sec=sp[1];
      var b=$("#bloques").val();
      var nurl="../reportes/fg.php?idgrado="+idg+"&sec="+sec+"&b="+b;
      fancyoffice(nurl,name);
    });
    $(document).ready(function() {
      $("#excel").click(function(e) {
        var grado = document.getElementById('grados').value;
        if (grado=="Grado") {
          swal({
            title: "Seleccione un Grado",
            //text: "You will not be able to recover this imaginary file!",
            type: "warning",
            confirmButtonClass: 'btn-warning',
            confirmButtonText: "Ok",
            closeOnConfirm: false
          });
        }else {
          window.open('data:application/vnd.ms-excel,' + escape($('#tabladedatos').html()));
          //Response.AddHeader("Content-Disposition", "attachment;filename=myfilename.docx");
        }
        e.preventDefault();
      });

      $("#grados").change(function(){
        //alert(this.value);
        var idgrado=this.value;
        var sp=idgrado.split("-");
        var materias = 0;
        var idg=sp[0];
        var sec=sp[1];
        var b=$("#bloques").val();
        var parametros = {
          "idgrado" : idg,
          "sec":sec,
          "b":b,
        };
        $.ajax({
          data:  parametros,
          url:   '../dinamics/notasxbloque.php',
          type:  'GET',
          beforeSend: function () {
            console.log("cargando");
          },
          success:  function (response) {
            $("#tabladedatos").html(response);
            $("#table-container").show(500);
          }
        });
      });
    });
    </script>
  </body>
  </html>
