<?php include '../lib/sesion.php';

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="iso-8859-1">
  <title><?php echo "$cole"; ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <meta content="Sistema para el control de notas escolares" name="description" />
  <meta content="Jorge Hernandez" name="author" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />

  <link rel="shortcut icon" href="../../assets/images/favicon.ico">

  <!-- Sweet Alert css -->
  <link href="../../plugins/bootstrap-sweetalert/sweet-alert.css" rel="stylesheet" type="text/css" />

  <!-- Plugins css-->
  <link href="../../plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" />
  <link href="../../plugins/multiselect/css/multi-select.css"  rel="stylesheet" type="text/css" />
  <link href="../../plugins/select2/select2.css" rel="stylesheet" type="text/css" />
  <link href="../../plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
  <link href="../../plugins/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet">
  <link href="../../plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
  <link href="../../plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
  <link href="../../plugins/switchery/switchery.min.css" rel="stylesheet" />

  <!-- App css -->
  <link href="../../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="../../assets/css/icons.css" rel="stylesheet" type="text/css" />
  <link href="../../assets/css/style.css" rel="stylesheet" type="text/css" />

  <script src="../../assets/js/modernizr.min.js"></script>
  <style media="screen">
  .vText {
    writing-mode: vertical-lr;
    transform: rotate(180deg);
    font-size:12px;
  }
  </style>

</head>

<body>

  <?php include '../lib/menu.php'; ?>


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
                <li class="breadcrumb-item active">Cuadro de Honor</li>
              </ol>
            </div>
            <h4 class="page-title">Cuadro de Honor</h4>
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
              $sql="SELECT * FROM `grados` WHERE idcole = '$idcole'";
              $con=mysqli_query($conexion,$sql);
              while ($cg=mysqli_fetch_array($con)) {
                $idg=$cg['idgrado'];
                $grado=$cg['boton'];
                //echo "<optgroup label=\"$grado\">";
                    echo "<option value=\"$idg\">$grado</option>";
                //echo "</optgroup>";
              }
              ?>
            </select>
          </div>
        </div>


        <div class="col-md-6">
          <div class="card-box">
            <h4 class="m-t-0 m-b-30 header-title"><b>Exportar a</b></h4>
            <button id="excel" class="btn btn-success waves-effect waves-light m-b-5"> <i class=" mdi mdi-file-excel-box "></i> <span>Excel</span> </button>
            <!--<button id="word" class="btn btn-primary waves-effect waves-light m-b-5"> <i class=" mdi mdi-file-word-box "></i> <span>Word</span> </button>-->
            <button class="btn btn-danger waves-effect waves-light m-b-5"> <i class=" mdi mdi-file-pdf-box "></i> <span>PDF</span> </button>
          </div>
        </div>
      </div>
      <div class="row" style="display:none;" id="table-container" >
        <div class="col-md-12">
          <div class="card-box table-responsive" id="docx">
            <!--<h4 class="m-t-0 header-title">Calificaciones Por Alumno</h4>-->
            <div class="WordSection1" id="tabladedatos">

            </div>
          </div>
        </div>
      </div>
      <!-- end container -->
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

    <script src="../../plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
    <script type="text/javascript" src="../../plugins/multiselect/js/jquery.multi-select.js"></script>
    <script type="text/javascript" src="../../plugins/jquery-quicksearch/jquery.quicksearch.js"></script>
    <script src="../../plugins/select2/select2.min.js" type="text/javascript"></script>
    <script src="../../plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
    <script src="../../plugins/bootstrap-inputmask/bootstrap-inputmask.min.js" type="text/javascript"></script>
    <script src="../../plugins/switchery/switchery.min.js"></script>

    <script src="../../plugins/moment/moment.js"></script>
    <script src="../../plugins/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
    <script src="../../plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="../../plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

    <script src="../../assets/pages/jquery.form-advanced.init.js"></script>

    <!-- Required datatable js -->
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables/dataTables.bootstrap4.min.js"></script>


    <!-- Sweet Alert js -->
    <script src="../../plugins/bootstrap-sweetalert/sweet-alert.min.js"></script>
    <script src="../../assets/pages/jquery.sweet-alert.init.js"></script>

    <!-- App js -->
    <script src="../../assets/js/jquery.core.js"></script>
    <script src="../../assets/js/jquery.app.js"></script>
  <!--  <script src="../../assets/js/jquery.exportbuttons.js"></script>-->

    <!--<script src="../../assets/js/jquery.menu.js"></script>-->
    <script src="../../assets/js/accent-neutralise.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
      $("#excel").click(function(e) {
        var grado = document.getElementById('grados').value;
        if (grado=="Grado") {
          swal({
                title: "Seleccione un Grado",
                //text: "You will not be able to recover this imaginary file!",
                type: "warning",
                confirmButtonClass: 'btn-warning',
                confirmButtonText: "Ok",
                closeOnConfirm: false
            });
        }else {
          window.open('data:application/vnd.ms-excel,' + escape($('#tabladedatos').html()));
          //Response.AddHeader("Content-Disposition", "attachment;filename=myfilename.docx");
        }
        e.preventDefault();
      });

      $("#grados").change(function(){
        //alert(this.value);
        var idgrado=this.value;
        var materias = 0;
        var parametros = {
          "idgrado" : idgrado,
        };
        $.ajax({
          data:  parametros,
          url:   '../json/clases.php',
          type:  'GET',
          beforeSend: function () {

          },
          success:  function (response) {
            var materias = Object.keys(response).length;
            //alert(response[0]['nombre']);
            //console.log(response[0]['nombre']);
            var tabla = '<table id="datatables" class="table table-responsive table-striped table-hover" cellspacing="0" >';
            tabla += '<thead>';
            tabla += '<tr>';
            tabla += '<th>Lugar</th>';
            tabla += '<th>Nombre</th>';
            tabla += '<th>Seccion</th>';
            tabla += '<th>Promedio</th>';
            tabla += '<th>Puntos Acumulados</th>';
            tabla += '<th>Clases Perdidas</th>';
            tabla += '<th>Honor</th>';
            tabla += '<th>Reporte</th>';
            tabla += '</tr>';
            tabla += '</thead>';
            tabla += '<tbody id="tbody">';

            tabla += '</tbody></table>';
            tabla += '<div id="load" class="col-12 text-center"><img width="70px" height="70px" src="../../assets/images/load1.gif"/><h5 id="text-load">Cargando </h5></div>'
            //alert(tabla);
            $('#tabladedatos').html(tabla);
            document.getElementById('table-container').style.display="block";
            //console.log(tabla);
            var param = {
              "idgrado" : idgrado
            };
            $.ajax({
              data:  param,
              url:   '../json/cuadrodehonor.php',
              type:  'GET',
              beforeSend: function () {
                document.getElementById("text-load").innerHTML="Cargando Información";
              },
              success:  function (finales) {
                document.getElementById("text-load").innerHTML="Calculando Calificaciones";
                var calum = Object.keys(finales).length;
                //alert(response[0]['nombre']);
                //console.log(finales[0]['nombre']);
                //console.log(calum);
                //console.log(materias);
                tr = '';
                var r ='';
                var t = 0;
                for (var a = 1; a <= calum; a++){
                  tr += '<tr>';
                  tr += '<td>'+finales[a-1]['lugar']+'</td><td>'+finales[a-1]['nombre']+'</td>';
                  tr += '<td>'+finales[a-1]['seccion']+'</td>';
                  tr += '<td>'+finales[a-1]['pro']+'</td>';
                  tr += '<td>'+finales[a-1]['pun']+'</td>';
                  tr += '<td>'+finales[a-1]['cpt']+'</td>';
                  if (finales[a-1]['pun']>0) {
                    if (finales[a-1]['lugar']==1) {
                        tr +='<td><span class="badge badge-primary">Abanderado</span></td>'
                    }
                    if (finales[a-1]['lugar']==2) {
                        tr +='<td><span class="badge badge-info">Primera Escolta</span></td>'
                    }
                    if (finales[a-1]['lugar']==3) {
                        tr +='<td><span class="badge badge-info">Segunda Escolta</span></td>'
                    }
                    if (finales[a-1]['lugar']>3) {
                        tr +='<td><span class="badge badge-success">Cuadro de Honor</span></td>'
                    }
                  }else {
                    tr +='<td><p>Sin Datos</p></td>'
                  }
                  tr += '<td><button onclick=\'location.href="report.php?id="+'+finales[a-1]['id']+'\' type="button" class="btn btn-info waves-effect waves-light m-b-5" title="Reporte academico" ><i class="ti-pencil-alt"></i></button></td>';
                  tr += '</tr>';
                }
                document.getElementById('load').style.display="none";
                $('#tbody').html(tr);
              }
            });
          }
        });
      });
    });
    </script>
  </body>
  </html>
