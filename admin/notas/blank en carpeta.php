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
                                    <li class="breadcrumb-item"><a href="./">Calificaciones</a></li>
                                    <li class="breadcrumb-item active">Por Alumno</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Inicio</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

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
        <!--<script src="../../assets/js/jquery.menu.js"></script>-->

    </body>
</html>
