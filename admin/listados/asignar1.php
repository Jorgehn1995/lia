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
            <h4 class="page-title">Asignar alumno a secciones</h4>
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

        <div class="col-md-6 contenido" style="display:none;" >
          <div class="card-box">
            <h4 class="m-t-0 m-b-30 header-title"><b>Acciones</b></h4>
            <!--<div class="btn-group">
              <button type="button" class="btn btn-warning dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false"><i class="  ti-split-h "></i> <span>Distribuir Alumnos</span>  <span class="caret"></span></button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="#">Distribuir Alumnos</a>
                <a class="dropdown-item" href="#">Distribuir por Genero</a>
              </div>
            </div>-->
            <button id="guardar" class="btn btn-success waves-effect waves-light m-b-5"> <i class="  ti-save   "></i> <span>Guardar Distribución</span> </button>
            <!--<button id="word" class="btn btn-primary waves-effect waves-light m-b-5"> <i class=" mdi mdi-file-word-box "></i> <span>Word</span> </button>-->

          </div>
        </div>
      </div>
      <div class="row blanco">
        <div class="col-md-12 blanco">
          <div class="text-center">
            <p class="text-muted">Sin sección selecionada</p>
          </div>
        </div>
      </div>
      <div class="row contenido" style="display:none;">
        <div class="col-md-6">

          <div class="card-box" id="box-sin-asignar">

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
    $("#grados").change(function(){
      //alert(this.value);
      var idgrado=this.value;
      if (idgrado=="Grado") {
        $('.contenido').hide(200);
        $('.blanco').show(500);
      }else {
        $('.contenido').show(500);
        $('.blanco').hide(500);
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
            var tab="";
            var cont="";

            var boxsa='<div id="sin-asignar-text"><p class="text-muted"> Alumnos sin seccion asignada</p></div><div class="cf nestable-lists"><div class="custom-dd dd" id="sin-asignar"></div></div>'
            $('#box-sin-asignar').html(boxsa);
            //console.log(sec);
            for (var i = 0; i <5; i++) {

              var num=i+1;
              //console.log(i);
              var n="sec"+num;
              //console.log(n);
              //console.log(response[0][n]);
              var sec=response["data"][0][n];
              //console.log(sec);
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
            //console.log(tab);
            $('#nav-tabs').html(tab);
            $('#tab-content').html(cont);
            //console.log(tabla);
            //**************************************************************************
            var secciones=["","A","B","C","D","E"];

            for (var i = 0; i <= 5; i++) {
              if (secciones[i]=="") {
                var nest="sin-asignar"
              }else {
                var nest="seccion"+secciones[i];
              }
              $('#'+nest).nestable();

              var sec=secciones[i];
              var parametros = {
                "idgrado" : idgrado,
                "sec" : sec,
              };
              $.ajax({
                data:  parametros,
                url:   '../json/sinseccion.php',
                type:  'GET',

                beforeSend: function () {

                },
                success:  function (response) {

                  var cantidad = Object.keys(response).length;
                  console.log(cantidad);
                  var olinicio = '<ol class="dd-list">';
                  var olfinal='</ol>';
                  var empty="";
                  var ts=0;
                  var ms=0;
                  var fs=0;
                  if (response[0]['seccion']=="") {
                    nomsec="sin-asignar";
                  }else {
                    nomsec="seccion"+response[0]['seccion'];
                  }
                  for (var a = 1; a <= cantidad; a++){
                    if (response[a-1]['seccion']=="") {
                      var sec="N/A - ";
                    }else {
                      var sec=response[a-1]['seccion']+" - Clave: ";
                    }
                    var nombre = sec+ response[a-1]['clave']+" - "+response[a-1]['genero']+" - "+ response[a-1]['apellidos']+", "+response[a-1]['nombres']+response[a-1]['activo'];
                    empty +='<li class="dd-item dd-nochildren"  data-id="'+response[a-1]['idalumno']+'">';
                    empty += '<div class="dd-handle">'+nombre+'</div>';
                    empty += '</li>';
                    if (response[a-1]['genero']=="M") {
                      ms=ms+1;
                    }else {
                      fs=fs+1;
                    }
                  }
                  var sat="";
                  var m="";
                  var f="";
                  if (cantidad==0) {
                    empty=olinicio+olfinal;
                    sat="No tienes alumnos sin sección asignada en este grado";
                  }else {
                    empty=olinicio+empty+olfinal;
                    sat='Tienes '+cantidad+' alumnos sin sección asignada ';
                  }
                  if (ms==1) {
                     m=ms+" hombre ";
                  }
                  if (ms>1) {
                     m=ms+" hombres ";
                  }
                  if (ms>0) {
                    sat=sat+m;
                  }
                  if (fs==1) {
                    f=" | "+fs+" mujer";
                  }
                  if (fs>1) {
                     f=fs+" mujeres";
                  }
                  if (fs>0) {
                    sat=sat+f;
                  }
                  var mst='<p class="text-muted">  '+sat+'</p>';
                  $('#'+nomsec+"-text").html(mst);
                  $('#'+nomsec).html(empty);
                }

              });
            }
          }
        });
      }
      //**************************************************************************

    });
    $("#guardar").click(function(){
      //serializar();
      var sinasignar= window.JSON.stringify($('#sin-asignar').nestable('serialize'));
      var sec1= window.JSON.stringify($('#seccionA').nestable('serialize'));
      var sec2= window.JSON.stringify($('#seccionB').nestable('serialize'));
      var sec3= window.JSON.stringify($('#seccionC').nestable('serialize'));
      var sec4= window.JSON.stringify($('#seccionD').nestable('serialize'));
      var sec5= window.JSON.stringify($('#seccionE').nestable('serialize'));
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
