<?php include '../lib/sesion.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <?php $titulo="Material de Apoyo";
  include '../lib/header.php'; ?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <meta content="Sistema para el control de notas escolares" name="description" />
  <meta content="Jorge Hernandez" name="author" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <link href="../../plugins/dropzone/dist/dropzone.css" rel="stylesheet" type="text/css" />
  <link href="../../plugins/dropzone/dist/basic.css" rel="stylesheet" type="text/css" />
  <!-- App css -->
  <link href="../../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../../plugins/select2/select2.css" rel="stylesheet" type="text/css" />
  <link href="../../assets/css/icons.css" rel="stylesheet" type="text/css" />
  <link href="../../assets/css/styleprofe.css" rel="stylesheet" type="text/css" />
  <link href="../../assets/css/stylenews.css" rel="stylesheet" type="text/css" />

  <script src="../../assets/js/modernizr.min.js"></script>
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
  #classdiv{
    margin-top:-2em;
  }
  #photoid{
    margin-top:-4em;
    width: 125px;
    height: 125px;
    border-style: solid;
    border-color: white;
    border-width: 5px;
  }
  .head{
    width: 100%;
    height: 230px;
    padding: 2em;
  }
  .photobox{
    margin:auto;
  }
  .name{
    margin-top:-2em;
  }
</style>
</head>

<body>

  <?php include '../lib/menu.php'; ?>


  <div class="wrapper">
    <div class="head">
      <div class="row">
        <div class="col-md-12">
          <h2 class="text-light"><b>Material </b> <small><small>De Apoyo</small></small> </h2>
        </div>
        <div class="col-md-12">
          <p class="text-light">Publica material de apoyo como documentos, sonidos o videos para tus alumnos</p>
        </div>
        <div class="col-md-12">
          <button type="button" class="btn btn-outline-light pub" name="button">Publicar</button>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <!-- Page-Title -->

      <!-- end page title end breadcrumb -->
      <div class="row " id="classdiv">
        <div class="col-md-12" id="publicar" style="display:none;">
          <div class="card-box">
            <div class="row justify-content-center">
              <div class="col-md-12">
                <h4><strong>Publica tu material de apoyo</strong></h4>
                <hr>
              </div>
              <div class="col-md-6">
                <div class="col-md-12">
                  <div class="form-group no-margin">
                    <label for="field-7" class="control-label">1- Selecionar la materia </label>
                    <select class="form-control select2" name="">
                      <option value="none">Seleccione una materia</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group no-margin">
                    <label for="field-7" class="control-label">2- Titulo del Material</label>
                    <input type="text" id="actual" class="form-control" name="" value="">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group no-margin">
                    <label for="field-7" class="control-label">3- Descripción del Material</label>
                    <textarea name="name" class="form-control" rows="3" cols="80"></textarea>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group no-margin">
                    <label for="field-7" class="control-label">4- Archivo a Compartir</label>
                    <input type="text" id="narchivo" disabled class="form-control" name="" placeholder="Sube o selecciona tu archivo en zona de carga" value="">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group no-margin">
                    <button type="button" class="btn btn-outline-success" disabled name="button">Publicar</button>
                    <button type="button" class="btn btn-outline-danger pub" disabled name="button">Cancelar</button>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="col-md-12">
                  <div class="form-group no-margin">
                    <div class="row">
                      <label for="field-7" class="control-label">Zona de Carga</label>
                    </div>
                    <div class="row">
                      <div class="">
                        <button type="button" class="btn btn-success btn-up" data-id="1" name="button"><i class="ti-upload"></i> Subir Archivo</button>
                        <button type="button" class="btn btn-danger btn-up" data-id="2" name="button"><i class=" ti-youtube "></i> YouTube</button>
                        <button type="button" class="btn btn-primary btn-up" data-id="3" name="button"><i class=" ti-link "></i> Enlace</button>
                        <button type="button" class="btn btn-secondary btn-up" data-id="4" name="button"><i class=" ti-cloud "></i> Tu Nube</button>
                      </div>
                    </div>
                    <br>
                    <div class="fileuploadzone">

                    </div>
                  </div>
                </div>

                <div class="col-md-12" style="display:none;">
                  <div class="form-group no-margin">
                    <label for="field-7" class="control-label">ID de Archivo</label>
                    <input type="text" id="idarchivo" class="form-control" name="" value="">
                  </div>
                </div>


              </div>

            </div>



          </div>
        </div>
        <div class="col-md-12">
          <div class="card-box">
            <div class="col-md-12">
              <h4><strong>Tus publicaciones</strong></h4>
              <hr>
            </div>
            <div class="col-md-12">
              <div class="">
                <div class="text-center">
                  <br>
                  <img src="../../assets/images/nodatafound.png" width="80" height="auto" alt=""><br>
                  <h3 class="text-muted">Sin Material Publicado</h3>
                  <div id="icon">
                    <h5 class="text-muted">Aun no tienes material de apoyo publicado para tus alumnos</h5>
                  </div>
                </div>
              </div>'
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
    <script src="../../plugins/dropzone/dist/dropzone.js"></script>

    <!-- End Footer -->
    <!-- jQuery  -->
    <script type="text/javascript">
    function limpiardropzone(){
      $("#formDropZone").html("<form id='dZUpload' class='dropzone borde-dropzone' style='cursor: pointer; height: 100px !important;'>"+
      "<div class='dz-default dz-message text-center'>"+
      "<span><h4>Arrastra tus archivos o haz click aqui</h4></span><br>"+
      "</div></form>");

      myAwesomeDropzone = {
        url: "main.php",
        addRemoveLinks: false,
        paramName: "uploadfile",
        maxFilesize: 25, // MB
        maxFiles:1,
        dictRemoveFile: "Listo",
        params: {
          raiz:"./"
          //parametro2:'valor2'
        },
        success: function (file, response) {
          var imgName = response;
          file.previewElement.classList.add("dz-success");
          //$(".uploadzone").slideToggle(500);

          //console.log(response);
          $("#idarchivo").val(response[0]['idfile']);
          notifi(response[0]['cnotif'],response[0]['title'],response[0]['msg']);
          $("#narchivo").val(response[0]['filename']);
          //limpiardropzone("Archivo subido con exito","Arrastra otro o haz click para subir mas");
          //console.log("Successfully uploaded :" + imgName);
        },
        error: function (file, response) {
          //file.previewElement.classList.add("dz-error");
          //console.log(response);
          swal({
            title: "Solo puedes subir un archivo",
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
    function notifi(tipo,titulo,msg){
      $.Notification.autoHideNotify(tipo, 'top right', titulo, msg);
    }
    $('body').on('click','.pub',function(){
      $('#publicar').slideToggle(500);
    });
    function cambiar(actual, nueva){
      var parametros = {
        "actual" : actual,
        "nueva" : nueva
      };
      $.ajax({
        data:  parametros,
        url:   'close.php',
        type:  'POST',
        success: function (r) {
          notifi(r[0]['type'],r[0]['title'],r[0]['msg']);
          if (r[0]['r']) {
            location.reload();
          }
        }
      });
    }
    $('body').on('keyup','#rnueva',function(){
      //console.log($(this).val()+" "+$('#nueva').val());
      if ($(this).val()!=$('#nueva').val()) {
        $('.nc').addClass("parsley-error");
        $('.nc').removeClass("has-success");
        $('.noco').show();
      }else {
        $('.nc').removeClass("parsley-error");
        $('.nc').addClass("has-success");
        $('.noco').hide();
      }
    });
    $('body').on('click','.btn-up',function(){
      $("#narchivo").val("Sube o selecciona tu archivo en zona de carga");
      $("#idarchivo").val("");
      var id=$(this).data("id");
      $.get("uploadfilezone.php?id="+id,function(r){
        $(".fileuploadzone").html(r[0]['zone']);
        if (id==1) {
          limpiardropzone();
        }
        if (id==4) {
          $("#fileshare").select2();
        }
      });
    });
    $('body').on('click','.save',function(){
      var actual=$('#actual').val();
      var nueva=$('#nueva').val();
      var rnueva=$('#rnueva').val();
      if (rnueva!=nueva) {
        $('.nc').addClass("parsley-error");
        $('.nc').removeClass("has-success");
        $('.noco').show();
        notifi("error","No Coinciden","Las contraseñas nuevas no coinciden");
      }else {
        $('.nc').removeClass("parsley-error");
        $('.nc').addClass("has-success");
        $('.noco').hide();
        swal({
          title: "¿Estas Seguro?",
          text: "Estas seguro que quieres cambiar tu contraseña",
          icon: "warning",
          buttons: true,
          dangerMode: false,
        })
        .then((willDelete) => {
          if (willDelete) {
            cambiar(actual,nueva);
          } else {

          }
        });

      }
    });
    $('body').on("click",".header",function(){
      $(".wbody").slideUp(500);
      var wbody=$(this).parent().parent().find(".wbody");
      if (wbody.is(':visible')) {
        wbody.slideUp(500);
      }else {
        wbody.slideDown(500);
      }
    });
    $(document).ready(function(){
      limpiardropzone();
    });
    </script>

  </body>
  </html>
