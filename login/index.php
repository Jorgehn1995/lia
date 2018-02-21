<?php
$estatuto=session_status();
if ($estatuto < 2){
  session_start();
  if (isset($_SESSION['modulo'])) {
    if ($_SESSION["modulo"]=="D") {
      header("location:../admin/");
    }
    if ($_SESSION["modulo"]=="L") {
      header("location:../alumno/");
    }
    if ($_SESSION["modulo"]=="P") {
      header("location:../aprofe/");
    }
  }
}
require '../conexion/conexion.php';
$sql="SELECT * FROM `colegio` where idcole='1' LIMIT 1";
$query=mysqli_query($conexion,$sql);
while ($a=mysqli_fetch_array($query)) {
  $abr=$a['abr'];
  $nombre=$a['nombre'];
  $logo=$a['logo'];
  $logodoc=$a['logodoc'];
}
require '../conexion/cerrar_conexion.php';
?>

<!DOCTYPE HTML>
<html>
<head>
  <title><?php echo $abr; ?> :: Sistema Educativo LIA</title>
  <link rel="shortcut icon" href="<?php echo "../assets/images/$logodoc"; ?>" type="image/x-icon">
  <link rel="icon" href="<?php echo "../assets/images/$logodoc"; ?>" type="image/x-icon">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

  <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
  <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />

  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="../assets/css/icons.css" rel="stylesheet" type="text/css" />
  <link href="../assets/css/style.css" rel="stylesheet" type="text/css" />
  <script src="js/jquery.min.js"></script>
  <!---start-login-script--->
  <script src="js/login.js"></script>
  <!---//End-login-script--->
  <!-----768px-menu----->
  <link type="text/css" rel="stylesheet" href="css/jquery.mmenu.all.css" />
  <script type="text/javascript" src="js/jquery.mmenu.js"></script>
  <script type="text/javascript">
  //	The menu on the left
  $(function() {
    $('nav#menu-left').mmenu();
  });
  </script>
  <!-----//768px-menu----->
</head>
<body>
  <div class="content">
    <!------start-768px-menu---->

    <!------end-768px-menu---->
    <!---start-header---->
    <div class="header">
      <!---start-wrap---->
      <div class="wrap">
        <div class="header-left">
          <div class="logo">
            <a href="./"><img src="<?php echo "../assets/images/b$logodoc"; ?>"/></a>
          </div>
        </div>
        <div class="header-right">



        </ul>
      </div>
      <div class="clear"> </div>
    </div>
    <div class="clear"> </div>
  </div>
</div>
<div class="main">
  <div class="wrap">
    <div class="main_left">
      <h2><?php echo $abr; ?></h2>
      <p>Bienvenido a <strong>LIA</strong> el sistema educativo de aprendizaje, investigación y gestión estudiantil avanzada del <?php echo $nombre; ?></p>

    </div>
    <div class="main_right">
      <div class="rwrap">
        <form id="login" class="form-horizontal m-t-20" action="">
          <h4 id="title" class="m-t-0 m-b-30 header-title text-center"><b>Iniciar Sesión</b></h4>
          <div class="form-group row">
            <div class="col-12">
              <div class="input-group">
                <span class="input-group-addon"><i class="mdi mdi-account"></i></span>
                <input class="form-control" id="user" type="text" required="" placeholder="Usuario">
              </div>
            </div>
          </div>

          <div class="form-group row">
            <div class="col-12">
              <div class="input-group">
                <span class="input-group-addon"><i class="mdi mdi-key"></i></span>
                <input class="form-control " id="pass" type="password" required="" placeholder="Contraseña">
              </div>
            </div>
          </div>

          <div id="error" style="display:none;" class="form-group row">
            <div class="col-12">
              <p class="text-danger">Usuario o contraseña invalido</p>
            </div>
          </div>

          <div class="form-group text-right m-t-20">
            <div class="col-xs-12 btn btn-group">
              <button class="btn btn-primary w-md waves-effect waves-light" id="submit" type="submit">Ingresar</button>
              <button class="btn btn-secondary w-md waves-effect waves-light" id="submit" type="submit">Regresar a Inicio</button>
            </div>
          </div>
          <div class="form-group text-right m-t-20">
            <span class="text-muted"><a href="#" class="text-muted">Olvidé mi contraseña</a></span>
          </div>

        </form>
      </div>

    </div>
    <div class="clear"> </div>
    <!---//End-header---->
  </div>
</div>
</div>

<script src="js/jquery.applog.js"></script>
</body>
</html>
