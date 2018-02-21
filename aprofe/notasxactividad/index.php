<?php
require '../lib/sesion.php';
require '../../assets/glib/isset.php';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <?php $titulo="Notas por Actividad";
  include '../lib/header.php'; ?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <meta content="Sistema para el control de notas escolares" name="description" />
  <meta content="Jorge Hernandez" name="author" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />



  <!-- DataTables -->

  <link href="../../plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
  <link href="../../plugins/datatables/fixedColumns.dataTables.min.css" rel="stylesheet" type="text/css" />
  <!-- App css -->
  <link href="../../plugins/select2/select2.css" rel="stylesheet" type="text/css" />
  <link href="../../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />



  <link href="../../assets/css/icons.css" rel="stylesheet" type="text/css" />
  <link href="../../assets/css/styleprofe.css" rel="stylesheet" type="text/css" />

  <script src="../../assets/js/modernizr.min.js"></script>
  <style media="screen">
  . {
    /*writing-mode: vertical-lr;*/
    /*transform: rotate(180deg);*/
    font-size:11px;
  }
  .headblack{
    border:1pt solid black;
  }
  td{
    font-size:11px;
    padding:0px;
    padding-left:0px;
    padding-right: 0px;
  }
  table.dataTable.table-striped.DTFC_Cloned tbody tr:nth-of-type(odd) {
    background-color: #F3F3F3;
  }
  table.dataTable.table-striped.DTFC_Cloned tbody tr:nth-of-type(even) {
    background-color: white;
  }
  input[type=number]::-webkit-inner-spin-button,
  input[type=number]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }

  .saved  {
    border:1px solid transparent;
    border-radius:.25rem
    color:#E0F8E0;
    background-color:#E0F8E0;
    border-color:#c3e6cb;
    padding: 1em !important;
    /*padding-left: .75rem;*/
    /*padding-bottom: -15px !important;*/
    -webkit-transition: background-color 500ms linear;
    -ms-transition: background-color 500ms linear;
    transition: background-color 500ms linear;
  }
  .nosaved  {
    border:1px solid transparent;
    border-radius:.25rem
    color:#F5A9A9;
    background-color:#F5A9A9;
    border-color:#c3e6cb;
    padding: 1em !important;
    /*padding-left: .75rem;*/
    /*padding-bottom: -15px !important;*/
    -webkit-transition: background-color 500ms linear;
    -ms-transition: background-color 500ms linear;
    transition: background-color 500ms linear;
  }
  .inbox-item {
    padding: 1em !important;
  }
  .inbox-item .inbox-item-author {
    font-size: 14px;
  }
  .back-to-top {
    background: none;
    margin: 0;
    position: fixed;
    bottom: 0;
    right: 0;
    width: 70px;
    height: 70px;
    z-index: 99;
    display: none;
    text-decoration: none;
    color: #28a5d4;
    background-color: #0000;
  }
  .back-to-top i {
    font-size: 60px;
  }
  </style>
</head>

<body>

  <?php include '../lib/menu.php'; ?>
  <div class="" style="display:none;">
    <?php $idmateria=d("idmateria");
    $bloque=d("bloque");
    echo '<input type="text" name="" id="idmateria" value='.$idmateria.'>';
    echo '<input type="text" name="" id="bloque" value='.$bloque.'>';
    ?>

  </div>

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
            <h4 class=""><?php echo $_GET['materia']." - Bloque ".$_GET['bloque'] ?></h4>
          </div>
        </div>
      </div>
      <!-- end page title end breadcrumb -->
      <div class="row">
        <div class="col-md-6">
          <div class="col-md-12">
            <div class="card-box">
              <h4 class="m-t-0 m-b-0 header-title"><b>Seleccionar Grado</b></h4>
              <select id="grados" class="form-control select2">
                <option>Grado</option>
                <?php
                require '../../conexion/conexion.php';
                $sql="SELECT * FROM `materias` INNER JOIN `grados` ON materias.idgrado=grados.idgrado WHERE materias.idnombremateria='$idmateria' GROUP BY materias.idgrado, materias.seccion";
                //$sql="SELECT * FROM `grados` WHERE idcole = '$idcole' order by ciclo";
                $con=mysqli_query($conexion,$sql);

                while ($cg=mysqli_fetch_array($con)) {
                  $idg=$cg['idgrado'];
                  $grado=$cg['boton'];
                  $ciclo=$cg['ciclo'];
                  $sec=$cg['seccion'];
                  echo "<option value=\"$idmateria-$bloque-$idg-$sec\">$grado $sec</option>";
                  require '../../conexion/cerrar_conexion.php';
                }
                ?>
              </select>

            </div>
          </div>
          <div class="col-md-12" id="selectactividades">

          </div>
          <div class="col-md-12" id="opciones" style="display:none;">
            <div class="card-box">
              <h4 class="m-t-0 m-b-0 header-title"><b>Opciones de la Actividad</b></h4>
              <div class="input-group">
                <input type="text" disabled id="textn" name="" class="form-control" placeholder="Nombre de la actividad">
                <span class="input-group-btn">
                  <div class="btn-group">
                    <button type="button"  class="more btn waves-effect waves-light btn-success">Más</button>
                  </div>
                </span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="col-md-12" id="editar" style="display:none;" >
            <div class="card-box">
              <div class="row">
                <div class="col-md-12">
                  <div class="pull-left">
                    <h4 class="m-t-0 m-b-0 header-title"><b>Editar Actividad</b></h4>
                  </div>
                  <div class="pull-right">
                    <button type="button" class="btn waves-effect waves-light btn-sm cerrareditar btn-danger"><i class="ti-close"></i></button>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-12">
                  <label for="" class="text-muted">Nombre de la actividad</label>
                  <div class="input-group">

                    <input type="text"  id="nombreactividad" class="form-control" placeholder="Nombre de la actividad">
                    <span class="input-group-btn">
                      <div class="btn-group">
                        <button type="button" class="btn guardar waves-effect waves-light btn-success">Guardar</button>
                      </div>
                    </span>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-12">
                  <label for="" class="text-muted">Asignar punteo a todos</label>
                  <div class="input-group">
                    <input type="text"  name="" class="form-control" placeholder="Asignar punteo a todos *">
                    <span class="input-group-btn">
                      <div class="btn-group">
                        <button type="button" class="btn waves-effect waves-light btn-warning">Aplicar</button>
                      </div>
                    </span>
                  </div>
                  <p class="text-muted">*La opción "asignar punteo a todos" asigna a todos los alumnos de este listado el punteo que usted ingrese y lo hace solo la actividad selecionada. Una vez aplicado no se puede revertir</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="card-box" style="padding:0.75em !important;">
              <h4 class="m-t-0 m-b-20 header-title"><b>Lista de Alumnos</b></h4>

              <div class="inbox-widget nicescroll " style="/*height:300px; overflow-y:scroll;*/">
                <div id="workbox" class="">
                  <div class="">
                    <div class="text-center">
                      <br>
                      <img src="../../assets/images/nodatafound.png" width="80" height="auto" alt=""><br>
                      <div id="icon">
                        <h5 class="text-muted">Selecione un grado y una actividad para calificar</h5>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>

          </div> <!-- end col -->
        </div>
      </div>
      <div class="row">

      </div>
    </div>
  </div> <!-- end container -->
  <a href="#" class="back-to-top" style="display: inline;">

    <i class="fa fa-arrow-circle-up"></i>

  </a>
</div>
<!-- end wrapper -->


<!-- Footer -->
<?php
include '../lib/foo.php';
require '../lib/scripts.php';
?>
<!-- End Footer -->
<!-- jQuery  -->
<script>

jQuery(document).ready(function() {
  var offset = 250;
  var duration = 300;
  jQuery(window).scroll(function() {
    if (jQuery(this).scrollTop() > offset) {
      jQuery('.back-to-top').fadeIn(duration);
    } else {
      jQuery('.back-to-top').fadeOut(duration);
    }
  });
  jQuery('.back-to-top').click(function(event) {
    event.preventDefault();
    jQuery('html, body').animate({scrollTop: 0}, duration);
    return false;
  })
});

</script>
<script type="text/javascript">
function NaN2Zero(n){
  return isNaN( n ) ? 0 : n;
}
function nosearchbox(){
  $(".select2-search, .select2-focusser").remove();
}
function plisactividad(){
  $("#opciones").hide(500);
  console.log("oculto");
  var workbox='<div class=""><div class="text-center"><br><img src="../../assets/images/nodatafound.png" width="80" height="auto" alt=""><br><div id="icon"><h5 class="text-muted">Selecione una actividad para calificar</h5></div></div></div>';
  $("#workbox").html(workbox);
}
function selectactividades(){
  var id=$("#grados").val();
  var parametros = {
    "id":id,
  };
  $.ajax({
    data:  parametros,
    url:   'selectactividades.php',
    type:  'POST',
    beforeSend: function () {

    },
    error: function () {
      swal("Sin Internet", "No se puede conectar a la base de datos", "error");
    },
    success:  function (response) {
      $("#selectactividades").html(response);
      $('#actividades').select2();
      nosearchbox();

    },
    timeout:10000
  });
}
function cambiarnombre(varnombre){
  $('body').find("#actividades option:selected").text(varnombre);
  cargarnombre();
}
function cargarnombre(){
  var nombre = $('body').find("#actividades option:selected").text();
  //console.log(nombre);
  $("#textn").val(nombre);
  $("#nombreactividad").val(nombre);
}
function cargaralumnos(){
  var actividad=$("#actividades").val();
  if (actividad!="none") {
    var id=$("#grados").val()+"-"+actividad;
    var parametros = {
      "id":id,
    };
    $.ajax({
      data:  parametros,
      url:   'inputdatatareas.php',
      type:  'POST',
      beforeSend: function () {
        swal("Cargando Alumnos...", {
          buttons: false,
        });
      },
      error: function () {
        swal("Sin Internet", "No se puede conectar a la base de datos", "error");
        //$d.css('background-color', '#F5A9A9');
      },
      success:  function (response) {
        //console.log(idcuadro+" - "+response);
        $("#workbox").html(response);
        $("#opciones").show(500);
        swal.close();
        $('body').find(".datagrid").TouchSpin({
          buttondown_class: "btn btn-primary",
          buttonup_class: "btn btn-primary"
        });
        $('body').find(".bootstrap-touchspin-down").attr("tabindex","-1");
        $('body').find(".bootstrap-touchspin-up").attr("tabindex","-1");
        //$(".bootstrap-touchspin-up").attr("tabindex","-1");
      },
      timeout:10000
    });
  }

}
function setname(){

  var actividad=$("#actividades").val();
  var id=$("#grados").val()+"-"+actividad;
  var nombre=$("#nombreactividad").val();
  var parametros = {
    "id":id,
    "nombre":nombre
  };
  $.ajax({
    data:  parametros,
    url:   'guardarnombre.php',
    type:  'POST',
    beforeSend: function () {
      swal("Guardando nombre...", {
        buttons: false,
      });
    },
    error: function () {
      swal("Sin Internet", "No se puede conectar a la base de datos", "error");
      //$d.css('background-color', '#F5A9A9');
    },
    success:  function (response) {
      //console.log(idcuadro+" - "+response);
      if (response=='true') {
        //aqui vere que hacer ------
        cambiarnombre(nombre);
        $("#actividades").select2();
        $("#editar").hide(500);
        nosearchbox();
        swal.close()
      }
    },
    timeout:10000
  });
}

$('body').on("change",".datagrid",function(){
  var $d=$(this).closest(".inbox-item");
  var punteo = NaN2Zero(parseFloat($(this).val()));
  var idnota=$(this).data("idnota");

  var parametros = {
    "idnota":idnota,
    //"campo":campo,
    "punteo":punteo
  };
  $.ajax({
    data:  parametros,
    url:   '../ajax/insertnotas.php',
    type:  'GET',
    beforeSend: function () {

    },
    error: function () {
      swal("Sin Internet", "No se puede conectar a la base de datos", "error");
      $d.removeClass("saved");
      $d.addClass("nosaved");
    },
    success:  function (response) {
      //console.log(idnota+" - "+response);
      if (response=="Exito") {
        $d.removeClass("nosaved");
        $d.addClass("saved");
      }else {
        $d.removeClass("saved");
        $d.addClass("nosaved");
        swal("Error!", response, "error");
      }
      //swal("Good job!", response, "success");
    },
    timeout:10000
  });
});
$('body').on("change","#actividades",function(){
  //console.log("todo bien");

  cargaralumnos();
  cargarnombre();
});
$('body').on("click",".more",function(){
  $("#editar").toggle(500);
});
$('body').on("click",".cerrareditar",function(){
  $("#editar").hide(500);
});
$('body').on("click",".guardar",function(){
  setname();
});
$(document).ready(function(){

  nosearchbox()
  $("#grados").change(function(){
    selectactividades();
    plisactividad();
    $("#editar").hide(500);
  });


});
</script>
</body>
</html>
