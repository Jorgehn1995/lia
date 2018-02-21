<?php include '../lib/sesion.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <?php $titulo="Inicio";
  include '../lib/header.php'; ?>

  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
  <meta content="Coderthemes" name="author" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />


  <!--Morris Chart CSS -->
  <link rel="stylesheet" href="../../plugins/morris/morris.css">
  <!-- App css -->
  <link href="../../plugins/jquery-circliful/css/jquery.circliful.css" rel="stylesheet" type="text/css" />
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
                <li class="breadcrumb-item"><a href="#"><?php echo "$abrcole"; ?></a></li>
                <li class="breadcrumb-item active">Inicio</li>
              </ol>
            </div>
            <h4 class="page-title">Inicio</h4>
          </div>
        </div>
      </div>
      <!-- end page title end breadcrumb -->
      <?php
      require '../../conexion/conexion.php';
      $m=0;
      $f=0;
      $snt="SELECT * FROM `alumnos` WHERE idcole='$idcole'";
      $con=mysqli_query($conexion,$snt);
      $cant=$con->num_rows;
      $ss=0;
      while ($r=mysqli_fetch_array($con)) {
        if ($r['genero']=="M") {
          $m=$m+1;
        }else {
          $f=$f+1;
        }
        if ($r['seccion']=="") {
          $ss=$ss+1;
        }
      }
      if ($cant==0) {
        $mp=0;
        $fp=0;
      }else {
        $mp=round(($m/$cant)*100,0);
        $fp=round(($f/$cant)*100,0);
      }

      include '../../conexion/cerrar_conexion.php';
      ?>
      <div class="row">
        <div class="col-sm-6 col-lg-3">
          <div class="card-box widget-icon">
            <div>
              <i class=" ti-user  text-success"></i>
              <div class="wid-icon-info text-right">
                <h3 class="text-success counter m-t-10"><?php echo $cant; ?></h3>
                <p class="text-muted text-nowrap m-b-10">Alumnos Registrados</p>
              </div>
            </div>
          </div>
        </div>

        <div class="col-sm-6 col-lg-3">
          <div class="widget-simple-chart text-right card-box">
            <div class="circliful-chart" data-dimension="90" data-text="<?php echo $mp; ?>%" data-width="5" data-fontsize="14" data-percent="<?php echo $mp; ?>" data-fgcolor="#5fbeaa" data-bgcolor="#ebeff2"></div>
            <h3 class="text-success counter m-t-10"><?php echo $m; ?></h3>
            <p class="text-muted text-nowrap m-b-10">Hombres</p>
          </div>
        </div>

        <div class="col-sm-6 col-lg-3">
          <div class="widget-simple-chart text-right card-box">
            <div class="circliful-chart" data-dimension="90" data-text="<?php echo $fp; ?>%" data-width="5" data-fontsize="14" data-percent="<?php echo $fp; ?>" data-fgcolor="#f76397" data-bgcolor="#ebeff2"></div>
            <h3 class="text-pink m-t-10"> <span class="counter"><?php echo $f; ?></span></h3>
            <p class="text-muted text-nowrap m-b-10">Mujeres</p>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="card-box widget-user widget-simple-chart ">
            <div>
              <img src="<?php echo $fpshared; ?>" class="rounded-circle" alt="user">
              <div class="wid-u-info">
                <h5 class="mt-0 m-b-5 font-16"><?php echo "$abrcole"; ?></h5>
                <p class="text-muted m-b-5 font-13"><?php echo "$colecorreo"; ?></p>
                <div class="col-md-2">
                  <a href="../reportes/ralumnos.php"><small class="text-success"><b>Reporte </b></small></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <!-- col -->
        <div class="col-md-6">
          <div class="row">
            <div class="col-md-12">
              <?php
              if ($ss>=1) {
                echo '<div class="alert alert-danger fade show m-b-0">
                  <h5 class="text-danger">¡Atención!</h5>
                  <p>
                    Tienes '.$ss.' alumnos sin sección asignada, ve a la página <strong>"Asignar sección"</strong>.
                  </p>
                  <p>
                    <button type="button" onclick="location=\'../listados/asignar.php\' " class="btn btn-danger waves-effect waves-light">
                      Ir a <small><strong>"Asignar Sección"</strong></small>
                    </button>
                  </p>
                </div>';
              }
               ?>
            </div>
          </div>
          <div class="card-box">
            <p class="text-muted text-nowrap m-b-10">Edades de Alumnos</p>
            <div id="myfirstchart" ></div>
          </div>
        </div>
        <div class="col-md-6">
          <div  id="" class="row">
            <div class="col-md-12">
              <div class="card-box table-responsive">
                <div class="pull-left">
                  <h4 class="m-t-0 header-title">Estadistica de Alumnos</h4>
                </div>
                <div class="pull-right">
                  <button class="btn print btn-outline-secondary waves-effect waves-light m-b-5"> <i class=" ti-printer "></i> <span> </span> </button>
                </div>
                <table id="datatables" class="table table-striped table-hover" cellspacing="0" >
                  <thead>
                    <tr>
                      <td>Grado</td>
                      <td>Hombres</td>
                      <td>Mujeres</td>
                      <td>Total</td>
                    </tr>
                  </thead>
                  <tbody id="estadistica">
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div  id="" class="row">
            <div class="col-md-12">
              <div class="card-box table-responsive">
                <h4 class="m-t-0 header-title">Inscritos del Dia </h4>
                <table id="datatables" class="table table-striped table-hover" cellspacing="0" >
                  <thead>
                    <tr>
                      <td>Grado</td>
                      <td>Hombres</td>
                      <td>Mujeres</td>
                      <td>Total</td>
                    </tr>
                  </thead>
                  <tbody id="hoy">
                  </tbody>
                </table>
              </div>
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
  <script type="text/javascript">
  function tabla(){
    $.get('tabla.php',function(data){
      $("#estadistica").html(data);
    });
  }
  function hoy(){
    $.get('hoy.php',function(data){
      $("#hoy").html(data);
    });
  }
  function grafica(){
    var parametros = {
      "idcole" : "idcole"
    };
    $.ajax({
      data:  parametros,
      url:   '../json/edades.php',
      type:  'GET',
      beforeSend: function () {

      },
      success:  function (response) {
        //console.log(response);
        Morris.Bar({
          element: 'myfirstchart',
          data: response,
          xkey: 'edades',
          ykeys: ['cantidades'],
          //lineColors: ["#3bafda", "#dcdcdc", "#80deea"],
          barColors: ["#2ECCFA", "#1531B2", "#1AB244", "#B29215"],

          labels: ['Cantidad', 'Años']
        });

      }
    });
  }


  $(document).ready(function($) {
    $(".print").click(function(){
      location="../reportes/estadisticaalumnos.php";
    });
    //$.Notification.notify('error','top right','Titulo Alerta', 'Texto')
    tabla();
    hoy()
    grafica();
    $('.counter').counterUp({
      delay: 100,
      time: 1200
    });
    $('.circliful-chart').circliful();
  });


  </script>
</body>
</html>
