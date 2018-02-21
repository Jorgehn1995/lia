<?php include '../lib/sesion.php'; ?>
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
            <h4 class="page-title">Agregar Alumnos a Secciones</h4>
          </div>
        </div>
      </div>
      <!-- end page title end breadcrumb -->
      <div class="row">

        <div class="col-md-6">
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


        <div class="col-md-6">
          <div class="card-box">
            <h4 class="m-t-0 m-b-30 header-title"><b>Distribuir alumnos de forma equitativa</b></h4>
            <button id="excel" class="btn btn-success waves-effect waves-light m-b-5"> <i class=" ti-menu-alt  "></i> <span>Distribuir Alumnos</span> </button>
            <button id="seri" class="btn btn-success waves-effect waves-light m-b-5"> <i class=" ti-menu-alt  "></i> <span>Serializar</span> </button>
            <!--<button id="word" class="btn btn-primary waves-effect waves-light m-b-5"> <i class=" mdi mdi-file-word-box "></i> <span>Word</span> </button>-->

          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="card-box">
            <p class="text-muted">Alumnos sin sección asignada</p>
            <div class="cf nestable-lists">
              <div class="custom-dd dd" id="sin-asignar">

              </div>
            </div>

            <p><strong>Serialised Output (per list)</strong></p>

            <textarea id="nestable-output" class="form-control"></textarea>

          </div>
        </div>
        <div class="col-md-6" id="secciones">
          <div class="card-box">
            <ul class="nav nav-tabs tabs-bordered" id="nav-tabs">

            </ul>
            <div class="tab-content" id="tab-content">

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
  $(document).ready(function(){
    function activar(){
      // activate Nestable for list 1
      $('#nestable').nestable({
        group: 1

      })
      .on('change', updateOutput);

      // activate Nestable for list 2
      $('#nestable2').nestable({
        group: 1
      })
      .on('change', updateOutput);
    };


    function serializar(){
      var updateOutput = function(e){
        var list   = e.length ? e : $(e.target),
        output = list.data('output');
        if (window.JSON) {
          output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
        } else {
          output.val('JSON browser support required for this demo.');
        }
      };
      // output initial serialised data
      updateOutput($('#sin-asignar').data('output', $('#nestable-output')));
      //updateOutput($('#nestable2').data('output', $('#nestable2-output')));
    };
    $("#seri").click(function(){
      serializar();

    });
    $("#grados").change(function(){
      //alert(this.value);
      var idgrado=this.value;
      //**************************************************************************
      var parametros = {
        "idgrado" : idgrado,
      };
      $.ajax({
        data:  parametros,
        url:   '../json/grados.php',
        type:  'GET',
        beforeSend: function () {

        },
        success:  function (response) {

          for (var i = 0; i <5; i++) {
            var tab="";
            var cont="";
            var num=i+1;
            var n="sec"+num;
            console.log(response[0][n]);
            var sec=response[0][n];
            if (sec=="") {

            }else {
              tab+='<li class="nav-item">';
              if (i==0) {
                var active="active";
              }else {
                var active="";
              }
              tab+= ' <a href="#'+sec+'" data-toggle="tab" aria-expanded="false" class="nav-link '+active+'">';
              tab+='    Seccion '+sec;
              tab+='  </a>';
              tab+='</li>';

              if (i==0) {
                var active="show active";
              }else {
                var active="";
              }
              cont+= '<div class="tab-pane fade '+active+' " id="'+sec+'">';
              cont+=    '<div class="cf nestable-lists">';
              cont+=      '<div class="custom-dd dd" id="seccion'+sec+'">';
              cont+=      '</div>';
              cont+=    '</div>';
              cont+='</div>';
            }
          }
          console.log(tab);
          $('#nav-tabs').html(tab);
          $('#tab-content').html(cont);
          //console.log(tabla);

        }
      });
      //**************************************************************************
      var parametros = {
        "idgrado" : idgrado,
      };
      $.ajax({
        data:  parametros,
        url:   '../json/sinseccion.php',
        type:  'GET',
        beforeSend: function () {

        },
        success:  function (response) {
          var cantidad = Object.keys(response).length;
          var empty = '<ol class="dd-list">';
          for (var a = 1; a <= cantidad; a++){
            var nombre = response[a-1]['apellidos']+", "+response[a-1]['nombres'];
            empty +='<li class="dd-item dd-nochildren"  data-id="'+response[a-1]['idalumno']+'">';
            empty += '<div class="dd-handle">'+nombre+'</div>';
            empty += '</li>';
          }
          empty +='</ol>'
          //alert(tabla);
          $('#sin-asignar').html(empty);
          //console.log(tabla);
          $('#sin-asignar').nestable(

          );
        }
      });
    });
    //init();

  });
  </script>
</body>
</html>
