<?php include '../lib/sesion.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title><?php echo "$cole"; ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
  <meta content="Coderthemes" name="author" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />

  <link rel="shortcut icon" href="../../assets/images/favicon.ico">

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
      <br>
      <div class="row">
        <div class="col-md-12">
          <div class="card-box">
            <form action="../lib/agregar.php" method="GET">
              <div class="row">
                <div class="col-md-8">
                  <div class="form-group">
                    <label for="field-1" class="control-label">Nombre</label>
                    <input type="text" class="form-control" name="nombre" id="f1" placeholder="">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="field-2" class="control-label">ABR</label>
                    <input type="text" class="form-control" name="abr" id="f2" placeholder="">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="field-4" class="control-label">Telefono</label>
                    <input type="text" class="form-control" name="telefono" id="f4" placeholder="">
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form-group">
                    <label for="field-5" class="control-label">Email</label>
                    <input type="email" class="form-control" name="email" id="f5" placeholder="">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="pull-right">
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Agregar Colegio</button>
                  </div>
                </div>
              </div>
            </form>
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

    <!-- App js -->
    <script src="../../assets/js/jquery.core.js"></script>
    <script src="../../assets/js/jquery.app.js"></script>
    <script src="../../assets/js/jquery.menu.js"></script>

  </body>
  </html>
