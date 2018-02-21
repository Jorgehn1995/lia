<?php
require '../lib/index.php';
require '../../assets/glib/isset.php';
require '../../conexion/conexion.php';
$idgrado=d("id");
$b="";
$id=0;
$tipo=$b;
$grado=$b;
$esp=$b;
$espn=$b;
$cc=$b;
$sec1=$b;
$sec2=$b;
$sec3=$b;
$sec4=$b;
$sec5=$b;
if ($idgrado=="") {

}else {
  if ($idgrado=="insert") {
    $id=0;
    $tipo=$b;
    $grado=$b;
    $esp=$b;
    $espn=$b;
    $sec1=$b;
    $sec2=$b;
    $sec3=$b;
    $sec4=$b;
    $sec5=$b;
  }else {
    $sql="SELECT * FROM `grados` WHERE idcole='$idcole' and idgrado='$idgrado'";
    $con=mysqli_query($conexion,$sql);
    if ($con) {
      while ($a=mysqli_fetch_array($con)) {
        $tipo=$a['tipo'];
        $id=$a['idgrado'];
        $grado=$a['grado'];
        $esp=$a['nombre'];
        $espn=$a['corto'];
        $cc=$a['clases'];
        for ($i=1; $i <=5 ; $i++) {
          $nom="sec".$i;
          if($a[$nom]==""){
            $$nom="";
          }else {
            $$nom="checked";
          }
        }
      }
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
  <?php $titulo="Agregar/Modificar Grado";
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
                <li class="breadcrumb-item"><a href="./">Grados</a></li>
                <li class="breadcrumb-item active">Acciones</li>
              </ol>
            </div>
            <h4 class="page-title">Agregar/Modificar Grado</h4>
          </div>
        </div>
      </div>
      <!-- end page title end breadcrumb -->


      <?php
      if ($idgrado=="") {
        echo '<div class="row">
        <div class="col-md-12">
        <div class="card-box">
        <div class="text-center">
        <h4>No se ha encontrado el grado</h4>
        <button class="btn regresar btn-defaulth waves-effect waves-light m-b-5"> <i class=" ti-angle-left "></i> <span>Regresar</span> </button>
        </div>
        </div>
        </div>
        </div>';
      }else {
        include '../phpshared/gradeform.php';
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
      if ( $("#cc").val() =='') {
        blank=1;
        requerido('{Cantidad de clases}');
      }
      if ( $("#ciclo").val() =='Primaria' || $("#ciclo").val() =='Básico') {

      }else {
        if ( $("#esp").val() =='') {
          blank=1;
          requerido('{Especialidacion de la Carrera}');
        }
        if ( $("#espn").val() =='') {
          blank=1;
          requerido('{nombre corto de especialidacion de la Carrera}');
        }
      }
      if ( $("#grado").val() =='select') {
        blank=1;
        requerido('{Grado}');
      }
      if ( $("#ciclo").val() =='select') {
        blank=1;
        requerido('{Tipo de Grado}');
      }
      if($("#a").is(':checked')){
        var sec1="A";
      }else {
        var sec1="";
      }

      if($("#b").is(':checked')){
        var sec2="B";
      }else {
        var sec2="";
      }
      if($("#c").is(':checked')){
        var sec3="C";
      }else {
        var sec3="";
      }
      if($("#d").is(':checked')){
        var sec4="D";
      }else {
        var sec4="";
      }
      if($("#e").is(':checked')){
        var sec5="E";
      }else {
        var sec5="";
      }

      if (blank==0) {
        console.log("todo bien");
        var id  = $("#id").val();
        if (id=="0") {
          var peticion="insert";
        }else {
          var peticion="modify";
        }
        var ciclo = $("#ciclo").val();
        var grado = $("#grado").val();
        var esp = $("#esp").val();
        var espn = $("#espn").val();
        var cc = $("#cc").val();
        var parametros = {
          "id" : id,
          "idcole" : idcole,
          "peticion":peticion,
          "ciclo":ciclo,
          "grado":grado,
          "esp":esp,
          "espn":espn,
          "cc":cc,
          "sec1":sec1,
          "sec2":sec2,
          "sec3":sec3,
          "sec4":sec4,
          "sec5":sec5
        };
        console.log(parametros);
        $.ajax({
          data:  parametros,
          url:   '../ajax/insertgrade.php',
          type:  'GET',
          beforeSend: function () {

          },
          success:  function (response) {
            alert(response);
            if (response=="Exito") {
              swal({
                title: "Exito",
                text: "Grado Ingresado Exitosamente",
                icon: "success",
                buttons: true,
                buttons: ["Regresar", "Ingresar nuevo grado"],
              })
              .then((value) => {
                if (value) {
                  location="../grados/update.php?id=insert";
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
