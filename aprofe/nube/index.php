<?php include '../lib/sesion.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <?php $titulo="Nube Personal";
  include '../lib/header.php'; ?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <meta content="Sistema para el control de notas escolares" name="description" />
  <meta content="Jorge Hernandez" name="author" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <link href="../../plugins/dropzone/dist/dropzone.css" rel="stylesheet" type="text/css" />
  <link href="../../plugins/dropzone/dist/basic.css" rel="stylesheet" type="text/css" />

  <!-- DataTables -->
  <link href="../../plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
  <link href="../../plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
  <!-- Responsive datatable examples -->
  <link href="../../plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
  <!-- App css -->
  <link href="../../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="../../assets/css/icons.css" rel="stylesheet" type="text/css" />
  <link href="../../assets/css/styleprofe.css" rel="stylesheet" type="text/css" />

  <script src="../../assets/js/modernizr.min.js"></script>
  <link href="../../plugins/fancibox/jquery.fancybox.min.css" rel="stylesheet">

  <style media="screen">
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
    }

  td{
    font-size: 14px;
  }
</style>
</head>

<body>

  <?php include '../lib/menu.php'; ?>


  <div class="wrapper">
    <div class="head">
      <div class="row">
        <div class="col-md-12">
          <h2 class="text-light"><b>Tu Nube</b> <small><small>> Tus Archivos</small></small> </h2>
        </div>
        <div class="col-md-12">
          <p class="text-light">Guarda información, archivos y accede a ella en cualquier momento, tienes hasta 25GB para tus archivos </p>
        </div>
      </div>
    </div>
    <div class="container-fluid">

      <!-- Page-Title -->
      <div class="row">
        <div class="col-sm-12">
          <div class="page-title-box">
            <div class="btn-group pull-right">
              <ol class="breadcrumb hide-phone p-0 m-0">
                <li class="breadcrumb-item"><a href="../"><?php echo "$abrcole"; ?></a></li>
                <li class="breadcrumb-item"><a href="./">Nube</a></li>
                <li class="breadcrumb-item active">Inicio</li>
              </ol>
            </div>
            <h4 class="page-title">Nube Personal</h4>
          </div>
        </div>
      </div>
      <!-- end page title end breadcrumb -->
      <div class="row" id="classdiv">
        <div class="col-md-2">
          <div class="form-group">
            <div class="row">
              <div class="col-6 col-md-12">
                <div class="form-group">
                  <button type="button" class="btn btn-success btn-block " id="up" name="button">Subir Archivo</button>
                </div>
              </div>
              <div class="col-6 col-md-12">
                <button type="button" disabled class="btn btn-secondary btn-block " id="nc" name="button">Crear Carpeta</button>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-10">
          <div class="row" id="prevrow" style="display:none;" >
            <div class="col-md-12">
              <div class="card-box" >
                <h5>Vista Previa</h5>
                <hr>
                <div class="col-md-12" id="prevbox">

                </div>
                <div class="col-md-2 col-12">
                  <button type="button" class="btn btn-danger btn-sm btn-block cerrarvp" name="button">Cerrar Vista Previa</button>
                </div>
              </div>
            </div>
          </div>
          <div class="row uploadzone" style="display:none;">
            <div class="col-md-12 portlets">
              <!-- Your awesome content goes here -->
              <div class="m-b-30" id="formDropZone">

              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="card-box">
                <div class="row">
                  <div class="col-md-12">
                    <p>Tu Nube</p>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class=" table-responsive">
                      <!--<h4 class="m-t-0 header-title">Calificaciones Por Alumno</h4>-->
                      <table id="archivos" class="table table-striped table-hover display responsive nowrap" cellspacing="0" width="100%" >
                        <thead>
                          <tr>
                            <th width="85%"><span id="titlec">Archivo</span></th>
                            <th width="15%">Opciones</th>
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
          </div>
        </div>
      </div>
    </div> <!-- end container -->
  </div>
  <!-- end wrapper -->

  <div id="renombrar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="width:55%;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title" id="custom-width-modalLabel">Renombrar Archivo</h4>
        </div>
        <div class="modal-body">
          <div class="row" style="display:none;">
            <div class="col-md-12">
              <div class="form-group">
                <input type="text" class="form-control" id="idnube" >
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="field-1" class="control-label">Nombre</label>
                <input type="text" class="form-control" id="nnombre" placeholder="Nombre de Archivo">
              </div>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary waves-effect waves-light btn-gn">Guardar Cambios</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  <div id="carpeta" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="width:55%;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title" id="custom-width-modalLabel">Crear Carpeta</h4>
        </div>
        <div class="modal-body">

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="field-1" class="control-label">Nombre de la carpeta</label>
                <input type="text" class="form-control" id="ncarpeta" placeholder="Nombre">
              </div>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary waves-effect waves-light btn-cc">Crear Carpeta</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  <!-- Footer -->
  <?php
  include '../lib/foo.php';
  require '../lib/scripts.php';
  ?>
  <!-- Dropzone js -->
  <script src="../../plugins/dropzone/dist/dropzone.js"></script>

  <script src="../../plugins/fancibox/jquery.fancybox.min.js"></script>
  <script src="../../plugins/datatables/dataTables.responsive.min.js"></script>
  <!-- End Footer -->
  <!-- jQuery  -->

  <script type="text/javascript">
  function comprobarraiz(raiz, nombre ="Tu Nube"){
    var parametros = {
      "raiz":raiz
    };
    $.ajax({
      data:  parametros,
      url:   'comprobarraiz.php',
      type:  'POST',
      beforeSend: function () {

      },
      error: function () {
        swal("Sin Internet", "No se puede conectar a la base de datos", "error");
      },
      success:  function (response) {
        if (response=="true") {
          cargar(raiz);
          $("#titlec").html(nombre)
          history.pushState(null,"","?raiz="+raiz);
        }else {
          cargar('./');
          history.pushState(null,"","?raiz=./");
        }
      },
      timeout:10000
    });
  }
  function notifi(tipo,titulo,msg){
    $.Notification.autoHideNotify(tipo, 'top right', titulo, msg);
  }
  function preview(url,name,type){
    //alert(type);
    $(".uploadzone").hide(500);
    $("#prevrow").hide(500);
    var src ="../../archivos/"+url;
    var docs ="archivos/"+url;
    if (type=="Imagen") {
      fancyimages(src,name);
    }
    if (type=="PDF") {
      fancyiframe(src,name);
    }
    if (type=="Word" || type=="Excel" || type=="xlxs") {
      var nurl="https://view.officeapps.live.com/op/view.aspx?src=http://www.inmedcoop.com/"+docs;

      fancyoffice(nurl,name);
    }
    if (type=="YouTube") {
      fancyembed(url,name);
    }
    if (type=="Video") {
      var visor='<p class="text-muted">'+name+'</p><br><video style="width:100%; max-width:300px; height:auto;" preload="none" controls id="video">'+
      '<source src="'+src+'" type="video/mp4">'+
      'Tu navegador no implementa el elemento <code>video</code>.'+
      '</video>';
      $("#prevbox").html(visor);
      $("#prevrow").show(500);
      $('html,body').animate({
        scrollTop:0//$("#add").offset().top
      },1000);
      return false;
    }
    if (type=="Audio") {
      var visor='<p class="text-muted">'+name+'</p><audio src="'+src+'" preload="none" controls  id="audio">'+
      'Your browser does not support the <code>audio</code> element.'+
      '</audio>';
      $("#prevbox").html(visor);
      $("#prevrow").show(500);
      $('html,body').animate({
        scrollTop:0//$("#add").offset().top
      },1000);
      return false;
    }
  }
  function renombrar(){
    $("#renombrar").modal('toggle');
    var nombre=$("#nnombre").val();
    var idnube=$("#idnube").val();
    var parametros = {
      "id":idnube,
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
      },
      success:  function (response) {
        if (response=="true") {
          notifi("success","Nombre Cambiado","Se ha cambiado el nombre del archivo exitosamente");
          cargar();
        }else {
          swal("Error", response, "error");
        }
      },
      timeout:10000
    });
  }
  function eliminar(idnube){
    var id=idnube;
    var parametros = {
      "id":idnube
    };
    $.ajax({
      data:  parametros,
      url:   'eliminar.php',
      type:  'POST',
      beforeSend: function () {

      },
      error: function () {
        swal("Sin Internet", "No se puede conectar a la base de datos", "error");
      },
      success:  function (response) {
        if (response=="true") {
          notifi("success","Archivo Eliminado","Se ha elminado el archivo exitosamente");
          cargar();
        }else {
          swal("Error", response, "error");
        }
      },
      timeout:10000
    });
  }
  function crearcarpeta(){
    var raiz=vars['raiz'];
    if (raiz==null) {
      raiz="./";
    }
    var ncarpeta=$("#ncarpeta").val();
    var parametros = {
      "raiz":raiz,
      "nombre":ncarpeta
    };
    $.ajax({
      data:  parametros,
      url:   'crearcarpeta.php',
      type:  'POST',
      beforeSend: function () {

      },
      error: function () {
        swal("Sin Internet", "No se puede conectar a la base de datos", "error");
      },
      success:  function (response) {
        if (response=="true") {
          notifi("success","Carpeta Creada","Se ha creado la carpeta exitosamente");
          var raiz=vars['raiz'];
          if (raiz==null) {
            raiz="./";
          }
          comprobarraiz(raiz);
        }else {
          swal("Error", response, "error");
        }
      },
      timeout:10000
    });
  }
  function limpiardropzone(){
    $("#formDropZone").html("<form id='dZUpload' class='dropzone borde-dropzone' style='cursor: pointer;'>"+
    "<div class='dz-default dz-message text-center'>"+
    "<span><h2>Arrastra tus archivos o haz click aqui</h2></span><br>"+
    "</div></form>");

    myAwesomeDropzone = {
      url: "main.php",
      addRemoveLinks: true,
      paramName: "uploadfile",
      maxFilesize: 25, // MB
      dictRemoveFile: "Listo",
      params: {
        raiz:"./"
        //parametro2:'valor2'
      },
      success: function (file, response) {
        var imgName = response;
        file.previewElement.classList.add("dz-success");
        $(".uploadzone").slideToggle(500);

        cargar();
        notifi("success","Archivo Subido",response);
        //limpiardropzone("Archivo subido con exito","Arrastra otro o haz click para subir mas");
        //console.log("Successfully uploaded :" + imgName);
      },
      error: function (file, response) {
        //file.previewElement.classList.add("dz-error");
        //console.log(response);
        swal({
          title: "Archivo Muy Pesado",
          text: response,
          icon: "error",
        });
        myDropzone.removeFile(file);
      }
    } // FIN myAwesomeDropzone
    var myDropzone = new Dropzone("#dZUpload", myAwesomeDropzone);
    myDropzone.on("complete", function(file,response) {
      //myDropzone.removeFile(file);
      //aqui se ejecuta el codigo de notificacion
      //var imgName = response;
      //console.log("Successfully uploaded :" + response);
    });
  }
  function cargar(raiz){
    if (raiz==null) {
      raiz="";
    }
    var url="json.php?raiz="+raiz;
    $('#archivos').DataTable({
      "destroy":true,
      "ajax":{
        "method":"POST",
        "url":url
      },
      //searching: false,
      //orderable: false,
      destroy: true,
      "paging":   false,
      //"ordering": false,
      "info":     false,
      "columns":[
        {"data":"nombrearchivo"},
        {"data":"opt"},
      ],
      "pagingType": "full_numbers",
      "lengthMenu": [
        [25, 50, 100, -1],
        [25, 50, 100, "Todos"]
      ],
      responsive: true,
      language: {
        "sProcessing":     "Procesando...",
        "sLengthMenu":     "Mostrar _MENU_ registros",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "No tienes archivos en esta carpeta",
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
  function fancyimages(url,nombre){
    $.fancybox.open([{
      src  : url,
      type : "image",
      opts : {
        caption : nombre
      }
    }], {
      loop : false
    });
    return false;
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
  function fancyoffice(url,nombre){

    //var nurl="https://view.officeapps.live.com/op/view.aspx?src=http://www.inmedcoop.com/aprofe/nube/"+url;
    //alert(url);
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
  function fancyembed(url,nombre){
    $.fancybox.open([{
      src  : url,
      opts : {
        caption : nombre
      }
    }], {
      loop : false
    });
    return false;
  }
  $(document).ready(function(){
    $(".btn-gn").click(function(){
      var r=vars['raiz'];
      if (r==null) {
        r="./";
      }
      renombrar(r);
    });
    $(".btn-cc").click(function(){
      crearcarpeta();
    });
    var raiz=vars['raiz'];
    if (raiz==null) {
      raiz="./";
    }
    comprobarraiz(raiz);
    limpiardropzone("Arrastra tus archivos aqui");
    $(".cerrarvp").click(function(){
      $("#prevrow").hide(500,function(){
        $("#prevbox").html("");
      });

    });
  });
  $('#up').on('click', function (event) {
    $(".uploadzone").slideToggle(500);
  });
  $('#nc').on('click', function (event) {
    $("#carpeta").modal();
  });
  $('#archivos tbody').on('click','.ver',function(e){
    var table = $('#archivos').DataTable();
    if ($(this).closest("tr").hasClass("child")) {
      var data = table.row($(this).closest("tr").prev()[0]).data();
    }else {
      var data = table.row($(this).closest("tr")).data();
    }
    var tipo = data.tipo;
    var nombre = data.nombre;
    var direccion = data.direccion;
    preview(direccion,nombre,tipo);
  });
  $('#archivos tbody').on('click','.open',function(e){
    var table = $('#archivos').DataTable();
    if ($(this).closest("tr").hasClass("child")) {
      var data = table.row($(this).closest("tr").prev()[0]).data();
    }else {
      var data = table.row($(this).closest("tr")).data();
    }
    var raiz = data.idnube;
    var nom =data.nombrese;
    comprobarraiz(raiz,nom);
  });
  $('#archivos tbody').on('click','.renombrar',function(e){
    var table = $('#archivos').DataTable();
    if ($(this).closest("tr").hasClass("child")) {
      var data = table.row($(this).closest("tr").prev()[0]).data();
    }else {
      var data = table.row($(this).closest("tr")).data();
    }
    var idnube = data.idnube;
    var nombre = data.nombrese;
    $("#nnombre").val(nombre);
    $("#idnube").val(idnube);
    $("#renombrar").modal();
  });
  $('#archivos tbody').on('click','.eliminar',function(e){
    var table = $('#archivos').DataTable();
    if ($(this).closest("tr").hasClass("child")) {
      var data = table.row($(this).closest("tr").prev()[0]).data();
    }else {
      var data = table.row($(this).closest("tr")).data();
    }
    var idnube = data.idnube;
    swal({
      title: "¿Estás Seguro?",
      text: "Una vez eliminado el archivo no podrás recobrarlo!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
          eliminar(idnube);
      }
    });
  });
  </script>

</body>
</html>
