<?php
require '../lib/index.php';
require '../../assets/glib/isset.php';
require '../../conexion/conexion.php';
$idgrado=d("id");
$b="";
$id=0;
$nombres=$b;
$apellidos=$b;
$direccion=$b;
$telefono=$b;
$usuario=$b;
$nr=0;
$sty="style='display:none;'";
if ($idgrado=="") {

}else {
  if ($idgrado=="insert") {
    $sty="style='display:block;'";
    $nr=1;
    $id=0;
    $nombres=$b;
    $apellidos=$b;
    $direccion=$b;
    $telefono=$b;
    $usuario=$b;
  }else {
    $sql="SELECT * FROM `profesores` WHERE idcole='$idcole' and idprofesor='$idgrado'";
    $con=mysqli_query($conexion,$sql);
    if ($con) {
      while ($a=mysqli_fetch_array($con)) {
        $id=$a['idprofesor'];
        $nombres=$a['nombres'];
        $apellidos=$a['apellidos'];
        $direccion=$a['direccion'];
        $telefono=$a['telefono'];
        $usuario=$a['telefono'];
      }
      $nr=$con->num_rows;
    }else {
      echo "Error ".mysqli_errno($conexion).": ".mysqli_error($conexion);
    }

  }
}

require '../../conexion/cerrar_conexion.php';
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
                <li class="breadcrumb-item"><a href="./">Profesores</a></li>
                <li class="breadcrumb-item active">Acciones</li>
              </ol>
            </div>
            <h4 class="page-title">Agregar/Modificar Profesor</h4>
          </div>
        </div>
      </div>
      <!-- end page title end breadcrumb -->


      <?php
      if ($idgrado=="" || $nr==0) {
        echo '<div class="row">
        <div class="col-md-12">
        <div class="card-box">
        <div class="text-center">
        <h4>No se ha encontrado el profesor</h4>
        <button class="btn regresar btn-defaulth waves-effect waves-light m-b-5"> <i class=" ti-angle-left "></i> <span>Regresar</span> </button>
        </div>
        </div>
        </div>
        </div>';
      }else {
        include '../phpshared/profeform.php';
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
  <script type="text/javascript" src=""></script>

</body>
<script type="text/javascript">
$(document).ready(function() {

  function listargrados(){
    $("#ciclo").change(function(){
      function showcar(){
        $("#ncarrera").show(500);
      }
      function hidecar(){
        $("#ncarrera").hide(500);
      }

      if (this.value=="Primaria" || this.value=="Básico" || this.value=="select") {
        hidecar();
      }else {
        showcar();
      }
    });
    function content(){
      $("#blank").css("display", "none");
      $("#content").css("display", "block");
    }
    function blank(){
      $("#content").css("display", "none");
      $("#blank").css("display", "block");
    }
    function requerido(campo){
      swal({
        title: "Campo Requerido",
        text: campo,
        icon: "warning",
      });
    }

    $(".save").click(function(e){
      e.preventDefault();
      var idcole=$("#idcole").val();
      var blank=0;
      if ( $("#user").val() =='') {
        blank=1;
        requerido('{Usuario del Profesor}');
      }else {
        idc=$("#user").val();
        require="usuarios";
        var parametros = {
          "idcole" : idc,
          "require" : require,
        };
        //console.log(parametros);
        $.ajax({
          data:  parametros,
          url:   '../json/blank.php',
          type:  'GET',
          async:false,
          success:  function (val) {
            //alert(val);
            if (val>=1) {
              blank=1;
              swal({
                title: "Usuario Existente",
                text: 'El usuario ya existe, intente con otro',
                icon: "warning",
              });
            }
          }
        });
      }
      if ( $("#apellidos").val() =='') {
        blank=1;
        requerido('{Apellidos del Profesor}');
      }
      if ( $("#nombres").val() =='') {
        blank=1;
        requerido('{Nombres del Profesor}');
      }


      if (blank==0) {
        //console.log("todo bien");
        var id  = $("#id").val();
        if (id=="0") {
          var peticion="insert";
        }else {
          var peticion="modify";
        }
        var nombres = $("#nombres").val();
        var apellidos = $("#apellidos").val();
        var dir = $("#dir").val();
        var tel = $("#tel").val();
        var user = $("#user").val();

        var parametros = {
          "id" : id,
          "idcole" : idcole,
          "peticion":peticion,
          "nombres":nombres,
          "apellidos":apellidos,
          "dir":dir,
          "tel":tel,
          "user":user
        };
        //console.log(parametros);
        $.ajax({
          data:  parametros,
          url:   '../ajax/insertprofe.php',
          type:  'GET',
          beforeSend: function () {

          },
          success:  function (response) {
            //alert(response);
            if (response=="Exito") {
              swal({
                title: "Exito",
                text: "Profesor Ingresado Exitosamente",
                icon: "success",
                buttons: true,
                buttons: ["Regresar", "Ingresar nuevo grado"],
              })
              .then((value) => {
                if (value) {
                  location="../profesores/update.php?id=insert";
                } else {
                  location="./";
                }
              });

            }
            if (response=="Actualizado") {
              swal({
                title: "Actualizado",
                text: "Se ha actualizado la informacion del grado",
                icon: "success",
              });
            }
            if (response=="Error") {
              swal({
                title: "Error",
                text: "Se ha producido un error al ingresar el grado",
                icon: "danger",
              });
            }
          }
        });
      }

    });
    $(".cancel").click(function(){
      location="./";
    });
    $(".clear").click(function(){
      location.reload();
    });
  }
  listargrados();
  $("#ciclo").change();
});
</script>
</html>
