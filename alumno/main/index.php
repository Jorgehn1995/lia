<?php include '../lib/sesion.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <?php $titulo="Inicio Profesores";
  include '../lib/header.php'; ?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <meta content="Sistema para el control de notas escolares" name="description" />
  <meta content="Jorge Hernandez" name="author" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />

  <!-- App css -->
  <link href="../../plugins/select2/select2.css" rel="stylesheet" type="text/css" />
  <link href="../../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="../../assets/css/icons.css" rel="stylesheet" type="text/css" />
  <link href="../../assets/css/styleprofe.css" rel="stylesheet" type="text/css" />
  <link href="../../assets/css/stylenews.css" rel="stylesheet" type="text/css" />

  <script src="../../assets/js/modernizr.min.js"></script>
  <style media="screen">
  .rounded-circle, .head{

    background: rgba(59,153,156,1);
    background: -moz-linear-gradient(left, rgba(59,153,156,1) 0%, rgba(0,177,156,1) 100%);
    background: -webkit-gradient(left top, right top, color-stop(0%, rgba(59,153,156,1)), color-stop(100%, rgba(0,177,156,1)));
    background: -webkit-linear-gradient(left, rgba(59,153,156,1) 0%, rgba(0,177,156,1) 100%);
    background: -o-linear-gradient(left, rgba(59,153,156,1) 0%, rgba(0,177,156,1) 100%);
    background: -ms-linear-gradient(left, rgba(59,153,156,1) 0%, rgba(0,177,156,1) 100%);
    background: linear-gradient(to right, rgba(59,153,156,1) 0%, rgba(0,177,156,1) 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#3b999c', endColorstr='#00b19c', GradientType=1 );

  }
  .head{
    width: 100%;
    height: auto;
    padding: 2em;
  }
  .conversation-list {

    padding: 0px !important; }
    .conversation-list .conversation-text {
      display: inline-block;
      float: left;
      font-size: 12px;
      margin-left: 5px;
      width: 90%; }
      .c-list li {
        margin-bottom: 0px;
        margin-top: 0px;
       }
    </style>
  </head>

  <body>

    <?php include '../lib/menu.php'; ?>


    <div class="wrapper">
      <div class="head">
        <div class="row">
          <div class="col-md-12">
            <h2 class="text-light"><b>Inicio</b> <small><small>> Perfil Alumnos</small></small> </h2>
          </div>
          <div class="col-md-12">
            <p class="text-light">Accede a tus calificaciones, entrega tareas y revisa tus pagos desde donde quieras</p>
          </div>
        </div>
      </div>
      <div class="alert alert-success alert-dismissable" style="display:none;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        Se han añadido las siguientes <a href="#" class="alert-link">funciones</a>:
        <ul>
          <li style="display:none;">Registro de inicio de sesión</li>
          <li >Seguimiento sobre registro de notas</li>
          <li style="display:none;">Ver ingreso de notas de asesor</li>
        </ul>
      </div>
      <div class="container-fluid">
        <br>
        <!-- Page-Title -->

        <!-- end page title end breadcrumb -->
        <div class="row" >
          <!-- CHAT -->
          <div class="col-lg-4" style="display:none;">
            <div class="card-box">
              <h4 class="m-t-0 m-b-20 header-title"><b>Registro de Inicio de Sesión</b></h4>

              <div class="chat-conversation" >
                <ul class="conversation-list c-list nicescroll" >

                  <li class="clearfix ">
                    <div class="conversation-text ">
                      <div class="alert alert-success ">
                        <i class="text-success">Sesión Iniciada</i>
                        <i class="text-muted">hace 0 segundos</i>
                        <p>
                          Inicio de sesión registrado con fecha 06-03-2018 a las 3:50 p.m
                        </p>
                      </div>
                    </div>
                  </li>
                  <li class="clearfix ">
                    <div class="conversation-text">
                      <div class="alert alert-danger ">
                        <b><i class="text-danger">Sesión Finalizada</i></b>
                        <i class="text-muted">hace 0 segundos</i>
                        <p>
                          Inicio de sesión registrado con fecha 06-03-2018 a las 3:50 p.m
                        </p>
                      </div>
                    </div>
                  </li>

                </ul>

              </div>
            </div>

          </div> <!-- end col-->
          <div class="col-lg-4">
            <div class="card-box">
              <h4 class="m-t-0 m-b-20 header-title"><b>Registro de Notas</b></h4>

              <div class="chat-conversation">
                <ul class="conversation-list nicescroll" id="classdiv">

                </ul>

              </div>
            </div>

          </div> <!-- end col-->
          <div class="col-md-8">
            <div class="col-lg-12">
              <div class="card-box">
                <h4 class="m-t-0 m-b-20 header-title"><b>Listado de Asistencia</b></h4>
                <div class="row">
                  <div class="col-md-4" >
                    <select class="form-control select2" id="size" name="">
                      <option value="v">Vertical</option>
                      <option value="h">Horizontal</option>
                    </select>
                  </div>
                  <div class="col-md-4" id="divmes">
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
                  <div class="col-md-4">
                    <button type='button' class='gen1 add btn btn-simple btn-success btn-icon' data-toggle='modal' data-target='#datos' title='Descargar' ><i class=' mdi mdi-file-pdf  '></i> Descargar Listados</button>
                  </div>
                </div>

              </div>

            </div> <!-- end col-->
            <div class="col-lg-12">
              <div class="card-box">
                <h4 class="m-t-0 m-b-20 header-title"><b>Registros de Calificaciones</b></h4>
                <div class="row">
                  <div class="col-md-8" >
                    <select class="form-control select2" id="br" name="">
                      <?php
                        for ($i=1; $i <=4 ; $i++) {
                          $s="";
                          if ($i==$bloqueencurso) {
                            $s="selected";
                          }
                          echo '<option '.$s.' value="'.$i.'">Bloque '.$i.'</option>';
                        }
                       ?>

                    </select>
                  </div>
                  <div class="col-md-4">
                    <button type='button' class='gen2 add btn btn-simple btn-success btn-icon' data-toggle='modal' data-target='#datos' title='Descargar' ><i class=' mdi mdi-file-pdf  '></i> Descargar Registros</button>
                  </div>
                </div>

              </div>

            </div> <!-- end col-->
          </div>


        </div>
      </div> <!-- end container -->
    </div>
    <!-- end wrapper -->
<iframe id="iframe" src="" style="display:none;" width="100%" height="600px"></iframe>

    <!-- Footer -->
    <?php
    include '../lib/foo.php';
    require '../lib/scripts.php';
    ?>

    <!-- End Footer -->
    <!-- jQuery  -->
    <script type="text/javascript">
    function asistencia(){
      var mes=$("#mes").val();
      var t=$("#size").val();
        var url="../listados/asistencia.php?m="+mes+"&size="+t;
        //$.get(url);
        $("#iframe").attr("src", url);

    }
    $(".gen1").on('click',function(){
      asistencia();
    });
    function registros(){
      var bloque=$("#br").val();
        var url="../listados/?b="+bloque;
        //$.get(url);
        $("#iframe").attr("src", url);

    }
    $(".gen2").on('click',function(){
      registros();
    });
    function cargarmaterias(){
      var parametros = {
        "idgrado" : "idgrado",
        "seccion" : "seccion",
        "idprofe":"idprofe"
      };
      $.ajax({
        data:  parametros,
        url:   'lognotas.php',
        type:  'POST',
        beforeSend: function () {
          var load='<div class="">'+
            '<div class="text-center">'+
              '<br>'+
              '<img src="../../assets/images/loadcustom.gif" width="80" height="auto" alt=""><br>'+
              '<h3 class="text-muted">Cargando Alumnos</h3>'+
              '<div id="icon">'+
                '<h5 class="text-muted">Esto puede tardar unos minutos</h5>'+
              '</div>'+
            '</div>'+
          '</div>';
          $('#classdiv').html(load);
        },
        success: function (response) {
          $("#classdiv").html(response);
        }
      });
    }
    $('body').on("click",".header",function(){
      $(".wbody").slideUp(500);
      var wbody=$(this).parent().parent().find(".wbody");
      if (wbody.is(':visible')) {
        wbody.slideUp(500);
      }else {
        wbody.slideDown(500);
      }
    });
    $(document).ready(function(){
      cargarmaterias();

    });
  </script>

</body>
</html>
