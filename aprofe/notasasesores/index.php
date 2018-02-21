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

  <!-- DataTables -->
  <link href="../../plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
  <link href="../../plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
  <link href="../../plugins/datatables/fixedColumns.dataTables.min.css" rel="stylesheet" type="text/css" />
  <!-- App css -->
  <link href="../../plugins/select2/select2.css" rel="stylesheet" type="text/css" />
  <link href="../../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />



  <link href="../../assets/css/icons.css" rel="stylesheet" type="text/css" />
  <link href="../../assets/css/style.css" rel="stylesheet" type="text/css" />

  <script src="../../assets/js/modernizr.min.js"></script>
  <style media="screen">

  .headblack{
    border:1pt solid black;
  }

  td{
    font-size:11px;
    padding:0px;
    padding-left:0px;
    padding-right: 0px;
  }
  th{
    font-size:10px;
    padding:0px;
    text-align: center;
    padding-left:0px;
    padding-right: 0px;

    /*transform: rotate(90deg);*/
  }
  .mtext{
    max-width: 15px;
  }
  .rotatetext{
    font-size:9px;
    /*transform: rotate(-90deg);*/
    line-height: 1em;
  }
  table.dataTable.table-striped.DTFC_Cloned tbody tr:nth-of-type(odd) {
    background-color: #F3F3F3;
  }
  table.dataTable.table-striped.DTFC_Cloned tbody tr:nth-of-type(even) {
    background-color: white;
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
      <br>
      <!-- end page title end breadcrumb -->
      <div class="row">
        <div class="col-md-4">
          <div class="card-box">
            <h4 class="m-t-0 m-b-10 header-title"><b>Grado</b></h4>
            <p class="text-muted nombreclase"><?php echo $_GET['idgrado'] ?></p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card-box">
            <h3 class="m-t-0 m-b-30 header-title"><b>Bloque</b></h3>
            <h4 class="m-t-0 m-b-25 header-title"><b class="bloque"><?php echo $_GET['bloque'] ?></b></h4>
          </div>
        </div>
        <div class="col-md-4 hide-phone">
          <div class="card-box">
            <h4 class="m-t-0 m-b-30 header-title"><b>Acciones</b></h4>
            <p class="text-mutex">...</p>
            <!--<button type="button" class="btn btn-danger  waves-effect waves-light" > Ver PDF </button>-->
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card-box">
            <!--<h4 class="m-t-0 header-title">Calificaciones Por Alumno</h4>-->
            <div style="width:100%; padding-left:-10px; ">
              <div  class="table-responsive" id="divcuadro">
                <div class="">
                  <div class="text-center">
                    <br>
                    <img src="../../assets/images/nodatafound.png" width="80" height="auto" alt=""><br>
                    <h3 class="text-muted">Cuadro de Calificaciones</h3>
                    <div id="icon">
                      <h5 class="text-muted">Selecione un grado para poder calificar</h5>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div> <!-- end container -->
  </div>
  <!-- end wrapper -->
  <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Datos de la Actividad</h4>
        </div>
        <div class="modal-body">
          <div class="row" style="display:none;">
            <div class="col-md-6">
              <div class="form-group">
                <label for="field-1" class="control-label"></label>
                <input type="text" class="form-control" id="idactividad" placeholder="">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="field-3" class="control-label">Nombre Actividad</label>
                <input type="text" class="form-control" id="nombreactividad" placeholder="Nombre Actividad">
              </div>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-info waves-effect waves-light actsave">Guardar</button>
        </div>
      </div>
    </div>
  </div><!-- /.modal -->

  <!-- Footer -->
  <?php
  include '../lib/foo.php';
  require '../lib/scripts.php';
  ?>
  <!-- End Footer -->
  <!-- jQuery  -->

  <script type="text/javascript">
  function loaddata(){
    var idgrado = vars['idgrado'];
    var bloque =vars['bloque'];
    var seccion= vsrs['seccion'];
  }
  function NaN2Zero(n){
    return isNaN( n ) ? 0 : n;
  }
  function nosearchbox(){
    $(".select2-search, .select2-focusser").remove();
  }
  function datat(){
    var id = $('#grados').val();
    $('#cuadro').DataTable({
      "destroy":true,
      "lengthChange": false,
      dom:'Bfrtip',
      buttons: ['excel', 'pdf'],
      "paging":   false,
      scrollY:"300px",
      scrollX:"50%",
      "bSort" : false,
      //scrollCollapse:true,
      //fixedColumns: {
      //leftColumns: 2
      //},
      //searching: false,
      "orderable": false,
      //orderable: false,
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
  }
  function notifi(tipo,titulo,msg){
    $.Notification.autoHideNotify(tipo, 'top right', titulo, msg);
  }
  function cargarcuadro(){
    var idmate=1;
    var idgrado = vars['idgrado'];
    var bloque =vars['bloque'];
    var seccion= vars['seccion'];
    var id = idmate+"-"+bloque+"-"+idgrado+"-"+seccion;
    var parametros = {
      "id":id
    };
    $.ajax({
      data:  parametros,
      url:   'tablacuadro.php',
      type:  'GET',
      beforeSend: function () {
        swal("Cargando Alumnos: esto puede tardar unos minutos...", {
          buttons: false,
        });
      },
      error: function () {
        swal("Sin Internet", "No se puede conectar a la base de datos", "error");
      },
      success:  function (response) {
        //console.log(response);
        $('#divcuadro').html(response);
        $('.dataTable').wrap('<div class="dataTables_scroll" />');
        datat();
        desplazar();
        swal.close();
      },
      //timeout:25000
    });
  }
  function desplazar(){
    /*
    Algoritmo para desplazarse por cada una de las celdas
    @autor -- Jorge Hernandez
    */
    var table = $('#cuadro').DataTable();
    table.on('keydown', '.datagrid', function(tecla) {
      if (tecla.keyCode==39) {
        var $next =$(this).parent("td").next().find(".datagrid");
        if ($next.val()==null) {
          var maxscroll = $('#cuadro').width();
          //alert(maxscroll);
          //$(".dataTables_scrollBody").scrollLeft(0);
        }
        $next.select();
        return false;
      }
      if (tecla.keyCode==37) {
        var $prev =$(this).parent("td").prev().find(".datagrid");
        if ($prev.val()==null) {
          $(".dataTables_scrollBody").animate({
            scrollLeft: 0
          }, 500);
          //$(".dataTables_scrollBody").scrollLeft(0);
        }
        //$prev.val();
        $prev.select();
        return false;
        //$prev.focus();
      }
      if (tecla.keyCode==40) {
        var dataid=$(this).attr("id");
        var $down = $(this).parent("td").parent().next().find("#"+dataid)
        if ($down.val()==null) {
          $(this).select();
        }
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
  }
  function nombremateria(){
    var id = $('#grados').val();
    var parametros = {
      "id":id
    };
    $.ajax({
      data:  parametros,
      url:   'nombremateria.php',
      type:  'GET',
      success:  function (response) {
        $(".nombreclase").text(response);
      },
      //timeout:25000
    });
  }
  function setname(){
      var actividad=$("#idactividad").val();
      var idmate=1;
      var idgrado = vars['idgrado'];
      var bloque =vars['bloque'];
      var seccion= vars['seccion'];
      var id = idmate+"-"+bloque+"-"+idgrado+"-"+seccion+"-"+actividad;
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
        },
        error: function () {
          swal("Sin Internet", "No se puede conectar a la base de datos", "error");
          //$d.css('background-color', '#F5A9A9');
        },
        success:  function (response) {
          //console.log(idcuadro+" - "+response);
          if (response=='true') {
            notifi("success","Nombre Guardado","Se ha guardado exitosamente el nombre de la actividad "+nombre);
            $('body').find("#"+actividad).html(nombre);
            $("#con-close-modal").modal("hide");
          }
        },
        timeout:10000
      });
      return nombre;
  }
  function guardar(idnota, punteo, $d){
    var parametros = {
      "idnota":idnota,
      "punteo":punteo
    };
    $.ajax({
      data:  parametros,
      url:   'insertnotas.php',
      type:  'GET',
      beforeSend: function () {

      },
      error: function () {
        swal("Sin Internet", "No se puede conectar a la base de datos", "error");
        $d.css('background-color', '#F5A9A9');
      },
      success:  function (response) {
        //console.log(idnota+" - "+response);
        if (response=="Exito") {
          $d.css('background-color', '#A9F5A9');
        }else {
          $d.css('background-color', '#F5A9A9');
          swal("Error!", response, "error");
        }
        //swal("Good job!", response, "success");
      },
      timeout:10000
    });
  }
  $('body').on("change",".datagrid", function(){
    var table = $('#cuadro').DataTable();
    var obtenido =NaN2Zero(parseFloat($(this).val()));
    var idnota = $(this).data("idnota");
    var total=0;
    var $d=$(this).parent("td")
    $(this).parents("tr").find('.datagrid').each(function(){
      total+=NaN2Zero(parseFloat($(this).val()));
    });
    if (Math.round(total)>=100) {
      total=100;
    }
    guardar(idnota, obtenido, $d);
    $(this).parents("tr").find('#total').text(total);
    //var obtenido=$(this).data("idnota");
    //alert(obtenido+" este es el valor");
  });
  $('body').on("click",".actividad",function(){
    var nombreact=$(this).text();
    var idact=$(this).attr("id");
    $('body').find("#idactividad").val(idact);
    $('body').find("#nombreactividad").val(nombreact);
  });
  $('body').on("click",".actsave",function(){
    setname();
  });
  $(document).ready(function(){
    nosearchbox();
    cargarcuadro();
    $("#grados").change(function(){

      nombremateria();
    });
  });
</script>
</body>
</html>
