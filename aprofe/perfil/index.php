<?php include '../lib/sesion.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <?php $titulo="Tu Perfil";
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
  #classdiv{
    margin-top:-2em;
  }
  #photoid{
    margin-top:-4em;
    width: 125px;
    height: 125px;
    border-style: solid;
    border-color: white;
    border-width: 5px;
  }
  .head{
    width: 100%;
    height: 200px;
    padding: 2em;
  }
  .photobox{
    margin:auto;
  }
  .name{
    margin-top:-2em;
  }
</style>
</head>

<body>

  <?php include '../lib/menu.php'; ?>


  <div class="wrapper">
    <div class="head">
      <div class="row">

      </div>
    </div>
    <div class="container-fluid">
      <!-- Page-Title -->

      <!-- end page title end breadcrumb -->
      <div class="row " id="classdiv">
        <div class="col-md-12">
          <div class="card-box">
            <div class="row justify-content-center">
              <div class="row col-md-4 justify-content-center">
                <div class="widget-user ">
                  <div>
                    <img src="../../assets/images/users/avatar-1.jpg" class="rounded-circle" alt="user" id="photoid">
                  </div>
                </div>
              </div>
            </div>
            <div class="row justify-content-center name">
              <div class="row  justify-content-center">
                <p><strong>Nombre</strong> Apellido</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card-box">

          </div>
        </div>
        <div class="col-md-8">
          <div class="card m-b-20">
            <h5 class="card-header">Tarea</h5>
            <div class="card-body">
              <h4 class="card-title">Special title treatment</h4>
              <p class="card-text">With supporting text below as a natural lead-in to
                additional content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
              </div>
            </div>
          </div>
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
