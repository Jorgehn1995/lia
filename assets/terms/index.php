<!DOCTYPE html>
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
            <h4 class="m-t-0 header-title"><b>Terminos y Condiciones</b></h4>
            <p class="text-muted m-b-30 font-13">
              Términos y Condiciones de uso
1. Información importante
Debe leer cuidadosamente los siguientes términos y condiciones. La compra o uso de nuestros productos implica que usted ha leído y aceptado estos términos y condiciones.
2. Licencia
Nuestro sitio web le concede una licencia limitada no exclusiva para utilizar los servicios que ofrecemos siempre y cuando se hayan ofrecido como gratuitos y no nos hacemos responsable del mal uso o manejo que sus usuarios puedan hacer.
a) USO LIMITADO
Solo se permite 1 registro por colegio, y podrá utilizar bajo su responsabilidad las herramientas que ponemos a su disposición siempre y cuando estén en la categoría de “Gratis” si el producto requiere un pago, deberá hacerlo para poder utilizar dicho servicio.
b) MODIFICACIONES
No tiene autorización para hacer modificaciones al sitio
c) USO NO AUTORIZADO
Usted no podrá ofrecer o cobrar por nuestros servicios denominados “gratis” o de “pago” como suyos y tampoco podrá cobrar remuneración alguna a ningún particular o persona jurídica por registrarse en nuestra web sin consentimiento escrito de nuestra empresa.

d) ASIGNABILIDAD
Usted no puede sub-licenciar, asignar, o transferir esta licencia a cualquier persona sin consentimiento escrito de nuestra compañía.
e) PROPIEDAD
Usted no puede declarar propiedad intelectual o exclusiva a ninguno de nuestros productos, modificado o sin modificar. Todos los productos son propiedad independiente de los proveedores del contenido.
Nuestros productos se proporcionan “tal cual” sin ningún tipo de garantía, expresa o implícita. En ningún caso seremos responsables de ningún daño incluyendo, pero no limitado a, daños directos, indirectos, especiales, fortuitos o consecuentes u otras pérdidas resultantes del uso o de la imposibilidad de utilizar nuestros productos así como tampoco la perdida de datos de registros o calificaciones.
3. Política de reembolso
Puesto que nuestra compañía está ofreciendo mercancías irrevocables no-tangibles, no realizamos reembolsos después de que se le haya dado acceso al producto, el cual usted es responsable de entender antes de comprar cualquier artículo en nuestro sitio web. Por favor, asegúrese de haber leído cuidadosamente la descripción del producto y absténgase de comprar al no entender las descripciones. Hacemos solamente excepciones con esta regla cuando la descripción no se ajusta al producto. El plazo para cualquier solicitud de reembolso es de una semana después de la fecha de adquisición.
4. Comprobación antifraude
La compra del cliente puede ser aplazada para la comprobación antifraude manual durante 10-20 minutos. También puede ser suspendida por más tiempo (alrededor de 20 horas) para una investigación más rigurosa, para evitar transacciones fraudulentas.
5. Instalación de los productos
La instalación de los productos que puedan requerirla (Sistema de pagos, etc.) no está incluida en el precio. Si necesita servicios de instalación, puede contactar con nuestro Soporte Técnico.
Nuestra compañía se reserva los derechos de cambiar o de modificar estos términos sin previo aviso.

            </p>


          </div>
        </div>
      </div>
      <!-- End row -->
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
