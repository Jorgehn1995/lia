<?php require '../lib/index.php'; ?>

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

      <div class="row">
        <div class="col-sm-12">
          <div class="page-title-box">
            <div class="btn-group pull-right">
              <ol class="breadcrumb hide-phone p-0 m-0">
                <li class="breadcrumb-item"><a href="../"><?php echo "$abrcole"; ?></a></li>
                <li class="breadcrumb-item"><a href="./">Calificaciones</a></li>
                <li class="breadcrumb-item active">Por Alumno</li>
              </ol>
            </div>
            <h4 class="page-title">Calificaciones Por Alumno</h4>
          </div>
        </div>
      </div>
      <!-- end page title end breadcrumb -->

      <div id="blank" style="display:none;" class="row">
        <div class="col-md-12">
          <div class="card-box">
            <div class="text-center">
              <h5>Sin alumnos en la base de datos</h5> <button type="button" class="btn btn-primary waves-effect waves-light m-b-5" id="go" name="button">Ingresar Alumnos</button>
            </div>
          </div>
        </div>
      </div>
      <div style="display:none;" id="content" class="row">
        <div class="col-md-12">
          <div class="card-box table-responsive">
            <!--<h4 class="m-t-0 header-title">Calificaciones Por Alumno</h4>-->
            <table id="datatables" class="table table-striped table-hover" cellspacing="0" >
              <thead>
                <tr>
                  <th>Nombres</th>
                  <th>Apellidos</th>
                  <th>Grado</th>
                  <th>Seccion</th>
                  <th>Codigo</th>
                  <th class="disabled-sorting text-right">Acciones</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
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
  <script src="../../assets/js/jquery.min.js"></script>
  <script src="../../assets/js/popper.min.js"></script><!-- Popper for Bootstrap --><!-- Tether for Bootstrap -->
  <script src="../../assets/js/bootstrap.min.js"></script>
  <script src="../../assets/js/waves.js"></script>
  <script src="../../assets/js/jquery.slimscroll.js"></script>
  <script src="../../assets/js/jquery.scrollTo.min.js"></script>


  <!-- Required datatable js -->
  <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="../../plugins/datatables/dataTables.bootstrap4.min.js"></script>



  <!-- App js -->
  <script src="../../assets/js/jquery.core.js"></script>
  <script src="../../assets/js/jquery.app.js"></script>


  <!--<script src="../../assets/js/jquery.menu.js"></script>-->
  <script src="../../assets/js/accent-neutralise.js"></script>

</body>
<script src="../../assets/js/alumnos.js"></script>
<script type="text/javascript">
$(document).ready(function() {
  alumnos();
});
</script>
</html>
