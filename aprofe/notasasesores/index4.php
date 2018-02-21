<?php
require '../lib/sesion.php';
require '../../assets/glib/isset.php';
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

  <script src="../../assets/js/modernizr.min.js"></script>
  <style media="screen">
  .vText {
    writing-mode: vertical-lr;
    transform: rotate(180deg);
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
            <h4 class="page-title">Inicio</h4>
          </div>
        </div>
      </div>
      <!-- end page title end breadcrumb -->
      <div class="row">
        <div class="col-md-6">
          <div class="card-box">
            <h4 class="m-t-0 m-b-30 header-title"><b>Seleccionar Grado</b></h4>
            <select id="grados" class="form-control select2">
              <option>Grado</option>
              <?php
              require '../../conexion/conexion.php';
              $sql="SELECT * FROM `materias` INNER JOIN `grados` ON materias.idgrado=grados.idgrado WHERE materias.idnombremateria='$idmateria' GROUP BY materias.idgrado, materias.seccion";
              //$sql="SELECT * FROM `grados` WHERE idcole = '$idcole' order by ciclo";
              $con=mysqli_query($conexion,$sql);

              while ($cg=mysqli_fetch_array($con)) {
                $idg=$cg['idgrado'];
                $grado=$cg['grado'];
                $ciclo=$cg['ciclo'];
                $sec=$cg['seccion'];
                echo "<option value=\"$idmateria-$bloque-$idg-$sec\">$grado $sec</option>";
                require '../../conexion/cerrar_conexion.php';
              }
              ?>
            </select>

          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card-box">
            <!--<h4 class="m-t-0 header-title">Calificaciones Por Alumno</h4>-->
            <div style="width:100%; padding-left:-10px; ">
              <div class="table-responsive">
                <table id="datatables" class="display nowrap table table-bordered table-striped table-hover" cellspacing="0" cellpadding="0" width="100%" >
                  <thead>
                    <tr>
                      <th class="headblack" colspan="2">Datos</th>
                      <th colspan="2">Saber</th>
                      <th colspan="5">Saber Hacer</th>
                      <th colspan="2">Saber Ser</th>
                      <th colspan="3">Saber Convivir</th>
                      <th class="vText" data-toggle="tooltip" data-placement="top" title="Saber Emprender"  width="4%" rowspan="2">Emprender</th>
                    </tr>
                    <tr>
                      <th width="3%">Clave</th>
                      <th width="20%">Nombre</th>
                      <th class="vText" data-toggle="tooltip" data-placement="top" title="Examen"  width="6%">Examen</th>
                      <th class="vText" data-toggle="tooltip" data-placement="top" title="Parcial"  width="6%">Parcial</th>
                      <th class="vText" width="6%">Hacer1</th>
                      <th class="vText" width="6%">Hacer2</th>
                      <th class="vText" width="6%">Hacer3</th>
                      <th class="vText" width="6%">Hacer4</th>
                      <th class="vText" width="6%">Hacer5</th>
                      <th class="vText" data-toggle="tooltip" data-placement="top" title="Entra Puntual a Clases y Sabe Escuchar" width="6%">Sabe Escuchar</th>
                      <th class="vText" data-toggle="tooltip" data-placement="top" title="Usa Correcto el Uniforme" width="6%">Uniforme</th>
                      <th class="vText" data-toggle="tooltip" data-placement="top" title="Respeta y usa vocabulario adecuado" width="6%">Respeto</th>
                      <th class="vText" data-toggle="tooltip" data-placement="top" title="Higiene" width="6%">Higiene</th>
                      <th class="vText" data-toggle="tooltip" data-placement="top" title="Integracion Familiar" width="6%">Integracion</th>

                      <th  width="4%">Total</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> <!-- end container -->
  </div>
  <!-- end wrapper -->


  <!-- Footer -->
  <?php
  include '../lib/foo.php';
  require '../lib/scripts.php';
  ?>
  <!-- End Footer -->
  <!-- jQuery  -->

  <script type="text/javascript">
  $(document).ready(function(){

    $("#grados").change(function(){
      var idcarga=this.value;
      $('#datatables').DataTable({
        "destroy":true,
        "ajax":{
          "method":"POST",
          "url":"../json/inputnotas.php?id="+idcarga
        },
        "columns":[
          {"data":"clave"},
          {"data":"nombre"},
          {"data":"s1"},
          {"data":"s2"},
          {"data":"h1"},
          {"data":"h2"},
          {"data":"h3"},
          {"data":"h4"},
          {"data":"h5"},
          {"data":"r1"},
          {"data":"r2"},
          {"data":"c1"},
          {"data":"c2"},
          {"data":"c3"},
          {"data":"e1"},
          {"data":"total"}
        ],
        "paging":   false,
        "info":     false,
        "autoWidth":false,
        //searching: false,
        "orderable": false,
        responsive: true,
        language: {
          "sProcessing":     "Procesando...",
          "sLengthMenu":     "Mostrar _MENU_ registros",
          "sZeroRecords":    "No se encontraron resultados",
          "sEmptyTable":     "Ningún dato disponible en esta tabla",
          "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
          "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
          "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
          "sInfoPostFix":    "",
          "sSearch":         "Buscar:",
          "sUrl":            "",
          "sInfoThousands":  ",",
          "sLoadingRecords": "Cargando...",
          "oPaginate": {
            "sFirst":    "Primero",
            "sLast":     "Último",
            "sNext":     "Siguiente",
            "sPrevious": "Anterior"
          },
          "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
          }
        }
      });
      var table = $('#datatables').DataTable();
      table.on('keydown', '.datagrid', function(tecla) {
        if (tecla.keyCode==39) {
          var $next =$(this).parent("td").next().find(".datagrid");
          $next.select();
          return false;
        }
        if (tecla.keyCode==37) {
          var $prev =$(this).parent("td").prev().find(".datagrid");
          $prev.select();
          return false;
          //$prev.focus();

        }
        if (tecla.keyCode==40) {
          var dataid=$(this).attr("id");
          var $down = $(this).parent("td").parent().next().find("#"+dataid)
          $down.select();
          return false;
        }
        if (tecla.keyCode==38) {
          var dataid=$(this).attr("id");
          var $up = $(this).parent("td").parent().prev().find("#"+dataid)
          $up.select();
          return false;
        }
      });
      table.on('change', '.datagrid', function() {
        function NaN2Zero(n){
          return isNaN( n ) ? 0 : n;
        }
        var $d=$(this).parent("td");
        var colum=$d.parent().children().index($d);
        var fila=$d.parent().parent().children().index($d.parent());
        //console.log(colum+' '+fila);
        var s1 = NaN2Zero(parseFloat($(this).parents("tr").find('#s1').val()));
        var s2 = NaN2Zero(parseFloat($(this).parents("tr").find('#s2').val()));
        var h1 = NaN2Zero(parseFloat($(this).parents("tr").find('#h1').val()));
        var h2 = NaN2Zero(parseFloat($(this).parents("tr").find('#h2').val()));
        var h3 = NaN2Zero(parseFloat($(this).parents("tr").find('#h3').val()));
        var h4 = NaN2Zero(parseFloat($(this).parents("tr").find('#h4').val()));
        var h5 = NaN2Zero(parseFloat($(this).parents("tr").find('#h5').val()));
        var r1 = NaN2Zero(parseFloat($(this).parents("tr").find('#r1').val()));
        var r2 = NaN2Zero(parseFloat($(this).parents("tr").find('#r2').val()));
        var c1 = NaN2Zero(parseFloat($(this).parents("tr").find('#c1').val()));
        var c2 = NaN2Zero(parseFloat($(this).parents("tr").find('#c2').val()));
        var c3 = NaN2Zero(parseFloat($(this).parents("tr").find('#c3').val()));
        var e1 = NaN2Zero(parseFloat($(this).parents("tr").find('#e1').val()));
        var total =0;
        var total = s1+s2+h1+h2+h3+h4+h5+r1+r2+c1+c2+c3+e1;
        $(this).parents("tr").find('#total').val(total);
        //console.log(total);
      });
    });
    $("#grados").change();
  });
</script>
</body>
</html>
