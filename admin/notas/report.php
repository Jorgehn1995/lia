<?php
require '../lib/index.php';
if (isset($_GET['id'])) {
  $id=$_GET['id'];
  $datos=data($id,$idcole,$bloqueencurso);
  $mcorto=materias($datos['idgrado'], $idcole,0);
  if (isset($_GET['url'])) {
    $url=$_GET['url'];
  }else {
    $url="./";
  }
  $c=$datos["lblcolor"];
}else {
  header("location:./");
}

?>
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
      <br>
      <!-- end page title end breadcrumb -->
        <div class="row">
          <div class="col-md-8">
            <div class="card-box">
              <h5><b><?php echo $datos["apellidos"]; ?></b>, <?php echo $datos["nombres"]; ?></h5>
            </div>
          </div>
          <div class="col-md-4">
            <div class="pull-right">
              <div class="btn-group">

                <button type="button" onclick="location='<?php echo $url; ?>'" class="btn btn-default  btn-round"name="button"><i class=" ti-angle-left"></i> Regresar</button>
                <button type="button" onclick='location="../reportes/ficha.php?acodigo=<?php echo $amigo; ?>&lg=<?php echo $lugardegrado; ?>&rc=<?php echo $ficharendiC; ?>&r1=<?php echo $ficharendi1; ?>&r2=<?php echo $ficharendi2; ?>"' class="btn btn-primary btn-round" target="_blank" name="button"><i class=" mdi mdi-file-document "></i> Imprimir Ficha</button>
                <button type="button" onclick='location="../excel/individual2.php?codigo=<?php echo $amigo; ?>"' class="btn btn-success  btn-round" name="button"><i class=" ti-upload "></i> Importar Excel</button>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <p class="text-muted font-14 m-b-20"> Información</p>
            <div class="card-box">
              <table class="table  table-no-bordered table-hover">
                <thead>
                  <tr>
                    <th class="text-center">Grado</th>
                    <th class="text-center">Sección</th>
                    <th class="text-center">Clave</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="text-center"><?php echo $datos["grado"]; ?></td>
                    <td class="text-center"><?php echo $datos["seccion"]; ?></td>
                    <td class="text-center"><?php echo $datos["clave"]; ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="col-md-4">
            <p class="text-muted font-14 m-b-20"> Clases Perdidas</p>
            <div class="card-box">
              <table class="table  table-no-bordered table-hover">
                <thead>
                  <tr>
                    <th>B I</th>
                    <th>B II</th>
                    <th>B III</th>
                    <th>B IV</th>
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="text-center"><?php echo $datos["cp1"]; ?></td>
                    <td class="text-center"><?php echo $datos["cp2"]; ?></td>
                    <td class="text-center"><?php echo $datos["cp3"]; ?></td>
                    <td class="text-center"><?php echo $datos["cp4"]; ?></td>
                    <td class="text-center"><?php echo $datos["cpt"]; ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="col-md-4">
            <p class="text-muted font-14 m-b-20"> Rendimiento</p>
            <div class="card-box">
              <table class="table  table-no-bordered table-hover">
                <thead>
                  <tr>
                    <th class="text-center">Posicion</th>
                    <th class="text-center">Promedio</th>
                    <th class="text-center">Rendimiento</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="text-center"><?php echo $datos["lg"]; ?></td>
                    <td class="text-center"><?php echo $datos["prociclo"]; ?></td>
                    <td class="text-center"><?php echo "<span class='btn btn-outline-".$datos['lblcolor']."'>".$datos["lblmsg"]."</span>" ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-8">
            <p class="text-muted font-14 m-b-20"> Ficha de Calificaciones</p>
            <div class="card-box">
              <?php include '../lib/notas.php'; ?>
            </div>
          </div>
          <div class="col-md-4">
            <p class="text-muted font-14 m-b-20"> Ciclo Escolar</p>
            <div class="card-box">
              <?php include '../lib/progreso.php'; ?>
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

  <!-- App js -->
  <script src="../../assets/js/jquery.core.js"></script>
  <script src="../../assets/js/jquery.app.js"></script>
  <!--<script src="../../assets/js/jquery.menu.js"></script>-->

</body>
</html>
