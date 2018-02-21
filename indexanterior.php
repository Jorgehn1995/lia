<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
    <title>INEBCO .:. Sistema LIA</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
  <meta content="Coderthemes" name="author" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />

  <link rel="shortcut icon" href="assets/images/favicon.ico">

  <!-- App css -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
  <link href="assets/css/style.css" rel="stylesheet" type="text/css" />

  <script src="assets/js/modernizr.min.js"></script>

</head>
<body>

  <div class="wrapper-page">

    <div class="text-center">
      <a href="./" class="logo-lg"><i class=" mdi mdi-server-network "></i> <span>INEBCO</span> </a>
    </div>

    <form id="login" class="form-horizontal m-t-20" action="">

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
        <div class="col-xs-12">
          <button class="btn btn-outline-primary w-md waves-effect waves-light" id="submit" type="submit">Ingresar
          </button>
        </div>
      </div>

    </form>
  </div>


  <!-- jQuery  -->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/popper.min.js"></script><!-- Popper for Bootstrap --><!-- Tether for Bootstrap -->
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/waves.js"></script>
  <script src="assets/js/jquery.slimscroll.js"></script>
  <script src="assets/js/jquery.scrollTo.min.js"></script>


  <!-- App js -->
  <script src="assets/js/jquery.core.js"></script>
  <script src="assets/js/jquery.app.js"></script>
  <script src="assets/js/jquery.applog.js"></script>


</body>
</html>
