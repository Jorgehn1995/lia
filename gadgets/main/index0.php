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
            <h2 class="text-light"><b>Inicio</b> <small><small>> Perfil Profesores</small></small> </h2>
          </div>
          <div class="col-md-12">
            <p class="text-light">Califica, guarda información y accede a ella cuando quieras</p>
          </div>
        </div>
      </div>
      <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        Se han añadido las siguientes <a href="#" class="alert-link">funciones</a>:
        <ul>
          <li>Registro de inicio de sesión</li>
          <li>Seguimiento sobre registro de notas</li>
          <li>Ver ingreso de notas de asesor</li>
        </ul>
      </div>
      <div class="container-fluid">
        <br>
        <!-- Page-Title -->

        <!-- end page title end breadcrumb -->
        <div class="row" >
          <!-- CHAT -->
          <div class="col-lg-4">
            <div class="card-box">
              <h4 class="m-t-0 m-b-20 header-title"><b>Registro de Inicio de Sesión</b></h4>

              <div class="chat-conversation" id="classdiv">
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
                <ul class="conversation-list nicescroll">

                  <li class="clearfix ">

                    <div class="conversation-text">
                      <div class="ctext-wrap">
                        <i class="text-success">Nota Agregada</i>
                        <i class="text-muted"><small>hace 2 horas</small></i>
                        <p>
                          Haz agregado <b>3 pts</b> a  Jorge Hernandez en la clase <b>Tecnologias de la informacion y la comunicacion</b>
                        </p>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="pull-right">
                              <a href="#" class="text-success"><b>Ver</b></a>
                              <a href="#" class="text-danger"><b>Deshacer</b></a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>

                </ul>

              </div>
            </div>

          </div> <!-- end col-->
          <div class="col-lg-4">
            <div class="card-box">
              <h4 class="m-t-0 m-b-20 header-title"><b>Registro de Asesores</b></h4>

              <div class="chat-conversation">
                <ul class="conversation-list nicescroll">

                  <li class="clearfix ">

                    <div class="conversation-text">
                      <div class="ctext-wrap">
                        <i class="text-success">Nota Agregada</i>
                        <i class="text-muted">hace 2 horas</i>
                        <p>
                          Edwin ha agregado <b>3 pts</b> a  Jorge Hernandez en la clase por la actiidad disfrases
                        </p>
                        <div class="row">

                          <div class="col-md-12">
                            <div class="pull-right">
                              <a href="#" class="text-success"><b>Ver</b></a>
                              <a href="#" class="text-danger"><b>Deshacer</b></a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>

                </ul>

              </div>
            </div>

          </div> <!-- end col-->

        </div>
      </div> <!-- end container -->
    </div>
    <!-- end wrapper -->


    <!-- Footer -->
    <?php
    include '../lib/foo.php';
    require '../lib/scripts.php';
    ?>

    <!-- End Footer -->
    <!-- jQuery  -->
    <script type="text/javascript">
    function cargarmaterias(){
      var parametros = {
        "idgrado" : "idgrado",
        "seccion" : "seccion",
        "idprofe":"idprofe"
      };
      $.ajax({
        data:  parametros,
        url:   'clases.php',
        type:  'POST',
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
      //cargarmaterias();

    });
  </script>

</body>
</html>
