<?php require '../lib/index.php';
if (isset($_GET['idgrado'])) {
  $idgrado=$_GET['idgrado'];
}else {
  $idgrado="";
}
if (isset($_GET['sec'])) {
  $sec=$_GET['sec'];
}else {
  $sec="";
}
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
  <link href="../../plugins/switchery/switchery.min.css" rel="stylesheet" />
  <script src="../../assets/js/modernizr.min.js"></script>

</head>

<body>
  <input type="text" style="display:none;" id="idcole" value="<?php echo $idcole; ?>">
  <input type="text" style="display:none;" id="idgrado" value="<?php echo $idgrado; ?>">
  <input type="text" style="display:none;" id="sec" value="<?php echo $sec; ?>">
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

                <li class="breadcrumb-item active">Grados</li>
              </ol>
            </div>
            <h4 class="page-title">Grados</h4>
          </div>
        </div>
      </div>
      <!-- end page title end breadcrumb  -->


      <div id="blank" style="display:none;" class="row">
        <div class="col-md-12">
          <div class="card-box">
            <div class="text-center">
              <h5>Grado no encontrado</h5>
            </div>
          </div>
        </div>
      </div>
      <div style="display:none;" id="content" class="row">
        <div class="col-md-12">
          <div class="card-box table-responsive">
            <!--<h4 class="m-t-0 header-title">Calificaciones Por Alumno</h4>-->
            <table id="datatables" class="table table-striped table-hover" cellspacing="0" >
              <thead>
                <tr>
                  <th width="5%"># Materia</th>
                  <th width="15%">Codigo</th>
                  <th width="25%">Materia</th>
                  <th width="15%">Codigo Profesor</th>
                  <th width="25%">Profesor</th>
                  <th width="10%">Reporte</th>
                  <th width="5%"class="disabled-sorting text-right">Acciones</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div> <!-- end container -->
  </div>
  <!-- end wrapper -->


  <!-- Footer -->
  <?php include '../lib/foo.php'; ?>
  <!-- End Footer -->
  <?php require '../lib/scripts.php'; ?>
  <!--  Modal content for the above example -->


</body>

<script type="text/javascript">
$(document).ready(function() {

  function listargrados(){
    function cargar(){
      var idcole=$("#idcole").val();
      var idgrado=$("#idgrado").val();
      var sec=$("#sec").val();
      var url="../json/materias.php?idgrado="+idgrado+"&sec="+sec;

      var btn1 = "<div class='pull-right btn-group'><button type='button' class='save btn btn-success btn-sm waves-effect waves-light m-b-5' title='Editar' >Guardar <i class='  ti-save  '></i></button></div>"
      var btn2 = "<button type='button' class='info btn btn-simple btn-info btn-icon' data-toggle='modal' data-target='#datos' title='Datos Personales' ><i class=' ti-info-alt '></i></button> <button type='button' class='reporte btn btn-simple btn-warning btn-icon' title='Reporte academico' ><i class=' ti-pencil-alt '></i></button>"
      $('#datatables').DataTable({
        "destroy":true,
        "ajax":{
          "method":"POST",
          "url":url
        },
        searching: false,
        orderable: false,
        destroy: true,
        "paging":   false,
        "ordering": false,
        "info":     false,
        "columns":[
          {"data":"num"},
          {"data":"idnombremateria"},
          {"data":"nombremateria"},
          {"data":"codprofe"},
          {"data":"nombreprofe"},
          {"data":"activo"},
          {
            "defaultContent": btn1
          }
        ],
        "pagingType": "full_numbers",
        "lengthMenu": [
          [10, 25, 50, -1],
          [10, 25, 50, "Todos"]
        ],
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
      // Edit record
      table.on('click', '.save', function() {
        var data = table.row($(this).parents("tr")).data();
        var idmateria=data.idmateria;
        var idcole=data.idcole;
        var idgrado=data.idgrado;
        var num=data.num;
        var sec=$('#sec').val();
        var idnombremateria = $(this).parents("tr").find('#idmateria').val();
        var idprofe=$(this).parents("tr").find('#codprofe').val();
        console.log(sec+" ------ "+idmateria+"---"+num+"-------"+idnombremateria+"----------"+idprofe);
      });

      // Delete a record
      table.on('click', '.remove', function(e) {
        $tr = $(this).closest('tr');
        table.row($tr).remove().draw();
        e.preventDefault();
      });

      //Like record
      table.on('click', '.info', function() {
        var data = table.row($(this).parents("tr")).data();
        //var val = $(this).parents("tr").find("#activo").val(); //ESTO SI ES UN TEXT BOX SI ES UN LABEL AL FINAL ES TEXT()
        var val = $(this).parents("tr").find("#activo").val();
        console.log(val);
        console.log(data);
      });

      table.on('click', '.reporte', function() {
        var data = table.row($(this).parents("tr")).data();
        var codigo = data.idalumno;
        //alert(codigo);
        location.href="report.php?id="+codigo;
      });

      $('.card .material-datatables label').addClass('form-group');
      content();
    }

    cargar();
  }
  listargrados();
});
</script>
<link href="../../plugins/switchery/switchery.min.css" rel="stylesheet" />
<script src="../../plugins/select2/select2.min.js" type="text/javascript"></script>
</html>
