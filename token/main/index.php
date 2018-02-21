<!DOCTYPE html>
<?php
if (isset($_GET['token'])) {
  $token=$_GET['token'];
}else {
  exit("Error: No Se Encontro Token");
}
require '../../assets/crypt.php';
require '../../conexion/conexion.php';
$f=0;
$sql="SELECT * FROM `colegio` WHERE token='$token'";
$con=mysqli_query($conexion,$sql);
while ($a=mysqli_fetch_array($con)) {
  $f=1;
  $cole['id']=$a['idcole'];
  $cole['nombre']=$a['nombre'];
  $cole['abr']=$a['abr'];
  $cole['lema']=$a['lema'];
  $cole['dir']=$a['direccion'];
  $cole['telefono']=$a['telefono'];
  $cole['email']=$a['email'];
  $cole['logo']=$a['logo'];
  if ($cole['logo']=="") {
    $cole['logo']="../../assets/images/users/default.jpg";
  }
  $cole['primaria']=$a['primaria'];
  $cole['basico']=$a['basico'];
  $cole['diversificado']=$a['diversificado'];
  if ($cole['primaria']==1) {
    $pri="checked";
  }else {
    $pri="";
  }
  if ($cole['basico']==1) {
    $bas="checked";
  }else {
    $bas="";
  }
  if ($cole['diversificado']==1) {
    $div="checked";
  }else {
    $div="";
  }
}
if ($f==0) {
  exit("Token no encontrado");
}else {
  $idcole=$cole['id'];
}
$sql="SELECT * FROM `usuarios` WHERE idcole='$idcole' and modulo='D'";
$con=mysqli_query($conexion,$sql);
while ($a=mysqli_fetch_array($con)) {
  $us['id']=$a['idusuarios'];
  $us['usuario']=$a['usuario'];
  $us['codigo']=$a['codigo'];
  $us['pass']=$a['pass'];
  $us['fotoperfil']=$a['fotoperfil'];
}
?>
<html>
<head>
  <meta charset="utf-8" />
  <title>Registrar Colegio</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
  <meta content="Coderthemes" name="author" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />

  <link rel="shortcut icon" href="../../assets/images/favicon.ico">

  <!--Form Wizard-->
  <link rel="stylesheet" type="text/css" href="../../plugins/jquery.steps/css/jquery.steps.css" />

  <!-- App css -->
  <link href="../../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="../../assets/css/icons.css" rel="stylesheet" type="text/css" />
  <link href="../../assets/css/style.css" rel="stylesheet" type="text/css" />

  <script src="../../assets/js/modernizr.min.js"></script>

</head>

<body>

  <div class="">

    <div class="container-fluid">

      <!-- Page-Title -->
      <div class="col-md-12 text-center">
        <a href="index.html" class="logo-lg"><i class="mdi mdi-radar"></i> <span>GES</span> </a>
      </div>
      <!-- end page title end breadcrumb -->

      <!-- Wizard with Validation -->

      <div class="row">
        <div class="col-sm-12">
          <div class="card-box">
            <h4 class="m-t-0 header-title"><b>Registre Su Colegio</b></h4>
            <p class="text-muted m-b-30 font-13">
              Siga los pasos para finalizar el registro de su colegio
            </p>

            <form id="wizard-validation-form" action="update.php" method="POST" enctype="multipart/form-data">
              <div>
                <h3>Usuario</h3>
                <section>

                      <input style="display:none;" value="<?php echo $idcole; ?>" name="idcole" type="text">

                  <div class="form-group clearfix">
                    <label class="control-label"  for="userName2">Usuario *</label>
                    <div class="">

                      <input class="form-control required" value="<?php echo $us['usuario']; ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Este sera su usuario para ingresar su cuenta" id="user" name="user" type="text">
                    </div>
                  </div>
                  <div class="form-group clearfix">
                    <label class="control-label"  for="userName2">Contraseña *</label>
                    <div>
                      <input type="text" id="pass"  name="password" class="form-control required" required
                      placeholder="Ingrese una Contraseña para su cuenta"/>
                    </div>
                  </div>
                  <div class="form-group clearfix">
                    <label class="col-lg-12 control-label ">(*) Datos Obligatorios</label>
                  </div>
                </section>
                <h3>Datos del Colegio</h3>
                <section>
                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-8">
                        <div class="form-group clearfix">
                          <label class="control-label" for=""> Nombre del Colegio *</label>
                          <div class="">
                            <input id="" name="nombre" type="text" value="<?php echo $cole['nombre']; ?>" class="required form-control">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group clearfix">
                          <label class="control-label" for=""> Abreviatura *</label>
                          <div class="">
                            <input id="" name="abr" value="<?php echo $cole['abr']; ?>" type="text" class="required form-control">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-8">
                        <div class="form-group clearfix">
                          <label class="control-label" for=""> Direccion *</label>
                          <div class="">
                            <input id="" name="dir" type="text" value="<?php echo $cole['dir']; ?>" class="required form-control">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group clearfix">
                          <label class="control-label" for=""> Telefono *</label>
                          <div class="">
                            <input id=""  name="tel" type="text" value="<?php echo $cole['telefono']; ?>" class="required form-control">
                          </div>
                        </div>

                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group clearfix">
                          <label class="control-label" for=""> Correo *</label>
                          <div class="">
                            <input id="" name="email" type="email" value="<?php echo $cole['email']; ?>" class="required form-control">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group clearfix">
                          <label class="control-label" for=""> Lema </label>
                          <div class="">
                            <input id="" name="lema" type="text" value="<?php echo $cole['lema']; ?>" class=" form-control">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <label class="control-label" for=""> Niveles que su colegio imparte</label>
                      <div class="col-md-12">
                        <div class="checkbox checkbox-primary">
                          <input id="primaria" name="primaria" <?php echo $pri; ?> type="checkbox">
                          <label for="primaria">
                            Primaria
                          </label>
                        </div>
                        <div class="checkbox checkbox-primary">
                          <input id="basico" <?php echo $bas; ?> name="basico" type="checkbox">
                          <label for="basico">
                            Básico
                          </label>
                        </div>
                        <div class="checkbox checkbox-primary">
                          <input id="diversificado" <?php echo $div; ?> name="diversificado" type="checkbox">
                          <label for="diversificado">
                            Diversificado
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group clearfix">
                      <label class="col-lg-12 control-label ">(*) Obligatorio</label>
                    </div>
                  </div>
                </section>
                <h3>Logotipo</h3>
                <section>
                  <div class="form-group clearfix">
                    <div class="col-md-12">
                      <div class="text-center">
                        <div class="thumb-lg member-thumb m-b-10 center-page" >

                          <img src="<?php echo "../../assets/images/users/".$cole['logo'] ?>" id="pf" class="rounded-circle img-thumbnail" alt="profile-image">
                        </div>
                        <input type="file" onChange="LimitAttach(this,1);" name="logotipo" id="nuevologo" class="form-control" value="">
                      </div>
                    </div>
                  </div>
                </section>

                <h3>Finalizar</h3>
                <section>
                  <div class="">

                  </div>
                  <div class="">
                    <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#custom-width-modal">Ver Terminos y Condiciones</button>
                  </div>
                  <div class="form-group clearfix">
                    <div class="col-lg-12">
                      <input id="acceptTerms-2" name="terminos" type="checkbox" class="required">
                      <label for="acceptTerms-2">Acepto los Terminos y Condiciones.</label>
                    </div>
                  </div>

                </section>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- End row -->
    </div> <!-- end container -->
  </div>
  <!-- end wrapper -->
  <div id="custom-width-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="width:55%;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title" id="custom-width-modalLabel">Términos y Condiciones de uso</h4>
        </div>
        <div class="modal-body">
          <h4>1. Información importante</h4>
          <p>Debe leer cuidadosamente los siguientes términos y condiciones. La compra o uso de nuestros productos implica que usted ha leído y aceptado estos términos y condiciones.</p>
          <hr>
          <h4>2. Licencia</h4>
          <p>Nuestro sitio web le concede una licencia limitada no exclusiva para utilizar los servicios que ofrecemos siempre y cuando se hayan ofrecido como gratuitos y no nos hacemos responsable del mal uso o manejo que sus usuarios puedan hacer.</p>
          <h5>a) USO LIMITADO</h5>
          <p>Solo se permite 1 registro por colegio, y podrá utilizar bajo su responsabilidad las herramientas que ponemos a su disposición siempre y cuando estén en la categoría de “Gratis” si el producto requiere un pago, deberá hacerlo para poder utilizar dicho servicio.</p>
          <h5>b) MODIFICACIONES</h5>
          <p>No tiene autorización para hacer modificaciones al sitio</p>
          <h5>c) USO NO AUTORIZADO</h5>
          <p>Usted no podrá ofrecer o cobrar por nuestros servicios denominados “gratis” o de “pago” como suyos y tampoco podrá cobrar remuneración alguna a ningún particular o persona jurídica por registrarse en nuestra web sin consentimiento escrito de nuestra empresa.</p>

          <h5>d) ASIGNABILIDAD</h5>
          <p>Usted no puede sub-licenciar, asignar, o transferir esta licencia a cualquier persona sin consentimiento escrito de nuestra compañía.</p>
          <h5>e) PROPIEDAD</h5>
          <p>Usted no puede declarar propiedad intelectual o exclusiva a ninguno de nuestros productos, modificado o sin modificar. Todos los productos son propiedad independiente de los proveedores del contenido.
            Nuestros productos se proporcionan “tal cual” sin ningún tipo de garantía, expresa o implícita. En ningún caso seremos responsables de ningún daño incluyendo, pero no limitado a, daños directos, indirectos, especiales, fortuitos o consecuentes u otras pérdidas resultantes del uso o de la imposibilidad de utilizar nuestros productos así como tampoco la perdida de datos de registros o calificaciones.</p>
            <hr>
            <h4>3. Política de reembolso</h4>
            <p>Puesto que nuestra compañía está ofreciendo mercancías irrevocables no-tangibles, no realizamos reembolsos después de que se le haya dado acceso al producto, el cual usted es responsable de entender antes de comprar cualquier artículo en nuestro sitio web. Por favor, asegúrese de haber leído cuidadosamente la descripción del producto y absténgase de comprar al no entender las descripciones. Hacemos solamente excepciones con esta regla cuando la descripción no se ajusta al producto. El plazo para cualquier solicitud de reembolso es de una semana después de la fecha de adquisición.</p>
            <h5>3. Política de reembolso</h5>
            <p>La compra del cliente puede ser aplazada para la comprobación antifraude manual durante 10-20 minutos. También puede ser suspendida por más tiempo (alrededor de 20 horas) para una investigación más rigurosa, para evitar transacciones fraudulentas.</p>
            <h5>5. Instalación de los productos</h5>
            <p>La instalación de los productos que puedan requerirla (Sistema de pagos, etc.) no está incluida en el precio. Si necesita servicios de instalación, puede contactar con nuestro Soporte Técnico.</p>
            <h3>Nuestra compañía se reserva los derechos de cambiar o de modificar estos términos sin previo aviso.</h3>


          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cerrar</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


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
    <script src="../../plugins/bootstrap-inputmask/bootstrap-inputmask.min.js" type="text/javascript"></script>

    <!--Form Wizard-->
    <script src="../../plugins/jquery.steps/js/jquery.steps.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="../../plugins/jquery-validation/js/jquery.validate.min.js"></script>

    <!--wizard initialization-->
    <script src="../../assets/pages/jquery.wizard-init.js" type="text/javascript"></script>

    <!-- App js -->
    <script src="../../assets/js/jquery.core.js"></script>
    <script src="../../assets/js/jquery.app.js"></script>
    <script src="../../assets/js/jquery.menu.js"></script>
    <script src="../../assets/js/soloimagenes.js"></script>

    <script type="text/javascript">
    $(document).ready(function(){
      $("#nuevologo").change(function(){
        if (document.getElementById('nuevologo').value=="") {

        }else {
          var file = document.querySelector('#nuevologo').files[0];
          var blob = URL.createObjectURL(file);
          document.querySelector('#pf').src = blob;
        }
      });
    });
    </script>

  </body>
  </html>
