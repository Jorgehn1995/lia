<?php
require '../lib/index.php';
require '../../assets/glib/isset.php';
$idalumno=d("id");
$dt=data($idalumno,$idcole,4);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <?php $titulo="Modificar Alumno";
  include '../lib/header.php'; ?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <meta content="Sistema para el control de notas escolares" name="description" />
  <meta content="Jorge Hernandez" name="author" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />



  <!-- App css -->
  <link href="../../plugins/select2/select2.css" rel="stylesheet" type="text/css" />
  <link href="../../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="../../assets/css/icons.css" rel="stylesheet" type="text/css" />
  <link href="../../assets/css/style.css" rel="stylesheet" type="text/css" />
  <link href="../../plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">

  <script src="../../assets/js/modernizr.min.js"></script>

</head>

<body>
  <input type="text" style="display:none;" id="idcole" value="<?php echo $idcole; ?>">
  <?php require '../lib/menu.php'; ?>


  <div class="wrapper">
    <div class="container-fluid">

      <!-- Page-Title -->

      <div class="row">
        <div class="col-sm-12">
          <div class="page-title-box">
            <div class="btn-group pull-right">
              <ol class="breadcrumb hide-phone p-0 m-0">
                <li class="breadcrumb-item"><a href="../"><?php echo "$abrcole"; ?></a></li>
                <li class="breadcrumb-item"><a href="./">Alumnos</a></li>
                <li class="breadcrumb-item active">Modificar</li>
              </ol>
            </div>
            <h4 class="page-title">Modificar Alumno</h4>
          </div>
        </div>
      </div>
      <!-- end page title end breadcrumb -->


      <?php
      if ($dt=="false") {
        echo '<div class="row">
          <div class="col-md-12">
            <div class="card-box">
              <div class="text-center">
                <h4>No se ha encontrado el alumno</h4>
                <button class="btn regresar btn-defaulth waves-effect waves-light m-b-5"> <i class=" ti-angle-left "></i> <span>Regresar</span> </button>
              </div>
            </div>
          </div>
        </div>';
      }else {
          include '../phpshared/modifyform.php';
      }
       ?>
    </div> <!-- end container -->
  </div>
  <!-- end wrapper -->


  <!-- Footer -->
  <?php include '../lib/foo.php'; ?>
  <!-- End Footer -->
  <?php require '../lib/scripts.php'; ?>
  <!--  Modal content for the above example -->
  <script type="text/javascript" src="../../assets/js/modificaralumno.js"></script>

</body>

</html>
