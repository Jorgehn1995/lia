<?php
require '../lib/sesion.php';
require '../../assets/glib/isset.php';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <?php $titulo="Registros";
  include '../lib/header.php'; ?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <meta content="Sistema para el control de notas escolares" name="description" />
  <meta content="Jorge Hernandez" name="author" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />

  <!-- DataTables -->
  <link href="../../plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />

  <!-- App css -->
  <link href="../../plugins/select2/select2.css" rel="stylesheet" type="text/css" />
  <link href="../../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />



  <link href="../../assets/css/icons.css" rel="stylesheet" type="text/css" />
  <link href="../../assets/css/styleprofe.css" rel="stylesheet" type="text/css" />
<link href="../../plugins/fancibox/jquery.fancybox.min.css" rel="stylesheet">
  <script src="../../assets/js/modernizr.min.js"></script>
  <style media="screen">

  .headblack{
    border:1pt solid black;
  }
  .rounded-circle, .head{

      background: rgba(59,153,156,1);
      background: -moz-linear-gradient(left, rgba(59,153,156,1) 0%, rgba(0,177,156,1) 100%);
      background: -webkit-gradient(left top, right top, color-stop(0%, rgba(59,153,156,1)), color-stop(100%, rgba(0,177,156,1)));
      background: -webkit-linear-gradient(left, rgba(59,153,156,1) 0%, rgba(0,177,156,1) 100%);
      background: -o-linear-gradient(left, rgba(59,153,156,1) 0%, rgba(0,177,156,1) 100%);
      background: -ms-linear-gradient(left, rgba(59,153,156,1) 0%, rgba(0,177,156,1) 100%);
      background: linear-gradient(to right, rgba(59,153,156,1) 0%, rgba(0,177,156,1) 100%);
      filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#3b999c', endColorstr='#00b19c', GradientType=1 );

    }
  .head{
      width: 100%;
      height: auto;
      padding: 2em;
      /*padding-left: 2em;
      padding-right: 2em;
      padding-top: 1em;
      padding-bottom: 0.3em;*/
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
    <input type="text" id="loadkey" name="" value="">

  </div>

  <div class="wrapper">
    <div class="head">
      <div class="row">
        <div class="col-md-12">
          <h2 class="text-light"><b>Registros</b> <small><small> > Bloque I</small></small> </h2>
        </div>
        <div class="col-md-12">
          <p class="text-light">Aqui encontraras tus cuadros de registro de calificaciones</p>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <button type="button" class="btn btn-outline-light btn-change" name="button">Selecionar Cuadro</button>
          </div>
          <div class="form-group">

          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid">

      <!-- Page-Title -->
      <br>
      <!-- end page title end breadcrumb -->
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
  <div id="change" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Seleccionar Cuadro</h4>
        </div>
        <div class="modal-body">
          <div class="row" >
            <div class="col-md-12">
              <div class="form-group" id="divstBloques">

              </div>
            </div>
          </div>
          <div class="row" >
            <div class="col-md-12">
              <div class="form-group" id="divstGrados">
                <label class="control-label" for="">Selecione un grado</label>
                <select class="select2 form-control" name="">
                  <option value="none">Grados</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row" >
            <div class="col-md-12">
              <div class="form-group" id="divstMaterias">
                <label class="control-label" for="">Selecione una materia</label>
                <select class="select2 form-control" name="">
                  <option value="none">Materias</option>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-success waves-effect waves-light btn-cuadro">Mostrar Cuadro</button>
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
<script src="../../plugins/fancibox/jquery.fancybox.min.js"></script>
  <script type="text/javascript">

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
      "paging":   false,
      scrollY:"300px",
      scrollX:"100%",
      "bSort" : false,
      scrollCollapse:true,
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
  function fancyiframe(url,nombre){
    $.fancybox.open([{
      src  : url,
      type : "iframe",
      opts : {
        caption : nombre
      }
    }], {
      loop : false
    });
    return false;
  }
  function notifi(tipo,titulo,msg){
    $.Notification.autoHideNotify(tipo, 'top right', titulo, msg);
  }
  function cargarcuadro(id){

    var id2 = id ;
    var parametros = {
      "id":id2
    };
    $.ajax({
      data:  parametros,
      url:   'tablacuadro.php',
      type:  'GET',
      beforeSend: function () {
        var load='<div class="">'+
          '<div class="text-center">'+
            '<br>'+
            '<img src="../../assets/images/loadcustom.gif" width="80" height="auto" alt=""><br>'+
            '<h3 class="text-muted">Cargando Alumnos</h3>'+
            '<div id="icon">'+
              '<h5 class="text-muted">Esto puede tardar unos minutos</h5>'+
            '</div>'+
          '</div>'+
        '</div>';
        $('#divcuadro').html(load);
      },
      error: function () {
        var ld='<div class="">'+
          '<div class="text-center">'+
            '<br>'+
            '<img src="../../assets/images/nodatafound2.png" width="80" height="auto" alt=""><br>'+
            '<h3 class="text-muted">Sin Internet</h3>'+
            '<div id="icon">'+
              '<h5 class="text-muted">Parece que hubo un error al cargar el cuadro, o haz perdido la conexión a internet</h5><br>'+
            '</div>'+
            '<div class="form-group">'+
              '<button type="button" onClick="cargarcuadro(\''+id+'\');" class="btn btn-outline-success " name="button">Intentar de Nuevo</button>'+
            '</div>'+
          '</div>'+
        '</div>';
        //swal("Sin Internet", "No se puede conectar a la base de datos", "error");
        $('#divcuadro').html(ld);
      },
      success:  function (response) {
        //console.log(response);
        $("#loadkey").val(id);
        $('#divcuadro').html(response);
        $('.dataTable').wrap('<div class="dataTables_scroll" />');
        datat();
        desplazar();
        history.pushState(null,"","?loadkey="+id);
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
      var idlk=$("#loadkey").val();
      var id=$("#loadkey").val()+"-"+actividad;
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
            //cargarcuadro()
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
      "punteo":punteo,
    };
    $.ajax({
      data:  parametros,
      url:   '../ajax/insertnotas.php',
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
          console.log("zona de error");
          swal("Error!", response, "error");
        }
        //swal("Good job!", response, "success");
      },
      timeout:10000
    });
  }
  function selectmateriasinit(){
    //var idmateria=vars['idmateria'];
    var loadkey=vars['loadkey'];
    if (loadkey==null) {
      idmateria="";
    }else {
      var lk=loadkey.split("-");
      var idmateria=lk[0];
    }
    if (idmateria==null) {
      idmateria="";
    }
    var idgrado=vars['idgrado'];
    var sec=vars['sec'];
    if (idgrado==null || sec==null) {
      ig=$("#stGrados").val();
      idg=ig.split("-");
      idgrado=idg[0];
      sec=idg[1];
      //console.log(sec);
    }
    var stMaterias = {
      "idgrado":idgrado,
      "sec":sec,
      "idmateria":idmateria
    };
    $.ajax({
      url:"stMaterias.php",
      data: stMaterias,
      type:  'POST',
      beforeSend: function (){
        $("#divstMaterias").html(loadicon());
      },
      success: function(response){
        //console.log(response);
        $("#divstMaterias").html(response);
        $("#stMaterias").select2();
        nosearchbox();
      },
    });
  }
  function selectgrado(){
    var loadkey=vars['loadkey'];
    if (loadkey==null) {
      idgrado="";
      sec="";
    }else {
      var lk=loadkey.split("-");
      var idgrado=lk[2];
      var sec = lk[3];
    }
    if (idgrado==null || sec==null) {
      idgrado="";
      sec="";
    }
    var stGrados = {
      "idgrado":idgrado,
      "sec":sec
    };
    $.ajax({
      url:"stGrados.php",
      data: stGrados,
      type:  'POST',
      beforeSend: function (){
        $("#divstGrados").html(loadicon());
      },
      success: function(response){
        $("#divstGrados").html(response);
        $("#stGrados").select2();
        selectmateriasinit()
        nosearchbox();
      },
    });

  }
  function selectbloque(){
    var bloque=vars['bloque'];
    var loadkey=vars['loadkey'];
    if (loadkey==null) {
      bloque="";
    }else {
      var lk=loadkey.split("-");
      var bloque=lk[1];
    }
    if (bloque==null) {
      bloque="";
    }
    var stBloques = {
      "bloque":bloque
    };
    $.ajax({
      url:"stBloques.php",
      data: stBloques,
      type:  'POST',
      beforeSend: function (){
        $("#divstBloques").html(loadicon());
      },
      success: function(response){

        $("#divstBloques").html(response);
        $("#stBloques").select2();
        nosearchbox();
      },
    });
  }
  function selectmaterias(){
    //var idmateria=vars['idmateria'];
    var loadkey=vars['loadkey'];
    if (loadkey==null) {
      idmateria="";
    }else {
      var lk=loadkey.split("-");
      var idmateria=lk[0];
    }
    if (idmateria==null) {
      idmateria="";
    }
    var ig=$("#stGrados").val();
    var idg=ig.split("-");
    var idgrado=idg[0];
    var sec=idg[1];
    var stMaterias = {
      "idgrado":idgrado,
      "sec":sec,
      "idmateria":idmateria
    };
    $.ajax({
      url:"stMaterias.php",
      data: stMaterias,
      type:  'POST',
      beforeSend: function (){
        $("#divstMaterias").html(loadicon());
      },
      success: function(response){
        //console.log(response);
        $("#divstMaterias").html(response);
        $("#stMaterias").select2();
        nosearchbox();
      },
    });
  }
  function loadcuadrourl(){
    var loadkey=vars['loadkey'];
    if (loadkey!=null) {
      cargarcuadro(loadkey);
    }
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
  $('body').on("click",".btn-printer",function(){
    var id= $("#loadkey").val();
    //alert("si");
    var url="../print/?lk="+id;
    //alert(url);
    fancyiframe(url,"Reporte");
  });
  $('body').on("click",".btn-cuadro",function(){
    var idmateria = $('body').find("#stMaterias").val();
    var idbloque =$('body').find("#stBloques").val();
    var grado =$('body').find("#stGrados").val();
    var idlk=idmateria+"-"+idbloque+"-"+grado;
    if (idmateria=="none") {
      swal("Sin Materias", "Lo sentimos, no impartes materias /n en el grado selecionado", "error");
    }else {
      //alert(idlk);
      $("#change").modal("hide");
      cargarcuadro(idlk);
    }
  });
  $('body').on("click",".btn-change",function(){
    $("#change").modal().show();
  });
  $('body').on("change","#stGrados",function(){
    selectmaterias();
  });
  $(document).ready(function(){
    loadcuadrourl();
    nosearchbox();
    selectbloque();
    selectgrado();

    $("#grados").change(function(){
      cargarcuadro();
      nombremateria();
    });
  });
</script>
</body>
</html>
