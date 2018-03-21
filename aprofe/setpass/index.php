<?php include '../lib/sesion.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <?php $titulo="Cambiar Contraseña";
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
        <div class="col-md-12">
          <h2 class="text-light"><b>Cambiar </b> <small><small>Contraseña</small></small> </h2>
        </div>
        <div class="col-md-12">
          <p class="text-light">Cambia tu contraseña para mantener tu perfil siempre seguro</p>
        </div>
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
                    <img src="../../assets/images/users/user.jpg" class="rounded-circle" alt="user" id="photoid">
                  </div>
                </div>
              </div>
            </div>
            <div class="row justify-content-center name">
              <div class="row  justify-content-center">
                <?php
                require '../../conexion/conexion.php';
                $sql="SELECT * FROM `profesores` WHERE idprofesor='$idusuario' LIMIT 1";
                $query=mysqli_query($conexion,$sql);
                while ($a=mysqli_fetch_array($query)) {
                  $nombre=$a['nombres'];
                  $apellidos=$a['apellidos'];
                }
                require '../../conexion/cerrar_conexion.php';
                ?>
                <h3><?php echo "$nombre"; ?> <strong><?php echo "$apellidos"; ?></strong></h3>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="card-box">
            <div class="row justify-content-center">
              <div class="col-md-4">
                <h4><strong>Confirma tus datos</strong></h4>
                <hr>
              </div>
            </div>
            <div class="row justify-content-center">
              <div class="col-md-4">
                <div class="form-group no-margin">
                  <label for="field-7" class="control-label">Contraseña actual</label>
                  <input type="password" id="actual" class="form-control" name="" value="">
                </div>
              </div>
            </div>
            <div class="row justify-content-center">
              <div class="col-md-4">
                <h4><strong>Ingresa tu nueva contraseña</strong></h4>
                <hr>
              </div>
            </div>
            <div class="row justify-content-center">
              <div class="col-md-4">
                <div class="form-group no-margin">
                  <label for="field-7" class="control-label">Nueva Contraseña</label>
                  <input type="text" id="nueva" class="form-control nc" name="" value="">
                </div>
              </div>
            </div>
            <div class="row justify-content-center">
              <div class="col-md-4">
                <div class="form-group no-margin">
                  <label for="field-7" class="control-label">Repite tu nueva contraseña</label>
                  <input type="text" id="rnueva" class="form-control nc" name="" value="">
                  <p style="display:none;" class=" text-danger noco"> Tus contraseñas nuevas no coinciden</p>
                </div>
              </div>
            </div>
            <div class="row justify-content-center">
              <div class="col-md-4">
                <div class="form-group no-margin">
                  <button type="button" class="btn btn-outline-success save" name="button"><i class="ti-reload"></i> Cambiar Contraseña</button>
                </div>
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
    function notifi(tipo,titulo,msg){
      $.Notification.autoHideNotify(tipo, 'top right', titulo, msg);
    }
    function cambiar(actual, nueva){
      var parametros = {
        "actual" : actual,
        "nueva" : nueva
      };
      $.ajax({
        data:  parametros,
        url:   'close.php',
        type:  'GET',
        success: function (r) {
          notifi(r[0]['type'],r[0]['title'],r[0]['msg']);
          if (r[0]['r']) {
            location.reload();
          }
        }
      });
    }
    $('body').on('keyup','#rnueva',function(){
      //console.log($(this).val()+" "+$('#nueva').val());
      if ($(this).val()!=$('#nueva').val()) {
        $('.nc').addClass("parsley-error");
        $('.nc').removeClass("has-success");
        $('.noco').show();
      }else {
        $('.nc').removeClass("parsley-error");
        $('.nc').addClass("has-success");
        $('.noco').hide();
      }
    });
    $('body').on('click','.save',function(){
      var actual=$('#actual').val();
      var nueva=$('#nueva').val();
      var rnueva=$('#rnueva').val();
      if (rnueva!=nueva) {
        $('.nc').addClass("parsley-error");
        $('.nc').removeClass("has-success");
        $('.noco').show();
        notifi("error","No Coinciden","Las contraseñas nuevas no coinciden");
      }else {
        $('.nc').removeClass("parsley-error");
        $('.nc').addClass("has-success");
        $('.noco').hide();
        swal({
          title: "¿Estas Seguro?",
          text: "Estas seguro que quieres cambiar tu contraseña",
          icon: "warning",
          buttons: true,
          dangerMode: false,
        })
        .then((willDelete) => {
          if (willDelete) {
            cambiar(actual,nueva);
          } else {

          }
        });

      }
    });
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

    });
    </script>

  </body>
  </html>
