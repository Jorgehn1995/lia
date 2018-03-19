
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <meta content="Sistema para el control de notas escolares" name="description" />
  <meta content="Jorge Hernandez" name="author" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />

  <!-- App css -->
  <link href="../../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
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
  .head{
    width: 100%;
    height: auto;
    padding: 2em;
  }
  .conversation-list {

    padding: 0px !important; }
    .conversation-list .conversation-text {
      display: inline-block;
      float: left;
      font-size: 12px;
      margin-left: 5px;
      width: 90%; }
      .c-list li {
        margin-bottom: 0px;
        margin-top: 0px;
      }
      </style>
    </head>

    <body>
      <div class="wrapper">
        <div class="container-fluid">
          <div class="row" style="display:none">
            <div class="col-md-12">
              <div class="form-group">
                <label for="">Tiempo</label>
                <input type="text" id="tiempo" class="form-control" name="" value="">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="">Punteo</label>
                <input type="text" id="punteo" class="form-control" name="" value="">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="">Nota</label>
                <input type="text" id="nota" class="form-control" name="" value="">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="">Puntos</label>
                <input type="text" id="total" disabled class="form-control" name="" value="">
              </div>
            </div>
          </div>
        </div> <!-- end container -->
      </div>
      <!-- jQuery  -->
      <script src="../../assets/js/jquery.min.js"></script>
      <script src="../../assets/js/popper.min.js"></script><!-- Popper for Bootstrap --><!-- Tether for Bootstrap -->
      <script src="../../assets/js/bootstrap.min.js"></script>
      <script src="../../assets/js/waves.js"></script>
      <script src="../../assets/js/jquery.slimscroll.js"></script>
      <script src="../../assets/js/jquery.nicescroll.js"></script>
      <script src="../../assets/js/jquery.scrollTo.min.js"></script>

      <script src="../../plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
      <script type="text/javascript" src="../../plugins/multiselect/js/jquery.multi-select.js"></script>
      <script type="text/javascript" src="../../plugins/jquery-quicksearch/jquery.quicksearch.js"></script>
      <script src="../../plugins/select2/select2.min.js" type="text/javascript"></script>
      <script src="../../plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
      <script src="../../plugins/bootstrap-inputmask/bootstrap-inputmask.min.js" type="text/javascript"></script>
      <script src="../../plugins/switchery/switchery.min.js"></script>

      <!--Nestable list-->
      <script src="../../plugins/nestable/jquery.nestable.js"></script>
      <!-- Responsive examples -->

      <script src="../../plugins/moment/moment.js"></script>
      <script src="../../plugins/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
      <script src="../../plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
      <script src="../../plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
      <script src="../../plugins/bootstrap-sweetalert/sweetalert.min.js"></script>

      <script src="../../assets/pages/jquery.form-advanced.init.js"></script>

      <!-- Notification js -->
      <script src="../../plugins/notifyjs/dist/notify.min.js"></script>
      <script src="../../plugins/notifications/notify-metro.js"></script>
      <script src="../lib/appneed.js"></script>





      <!-- Required datatable js -->
      <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>

      <script src="../../plugins/datatables/dataTables.bootstrap4.min.js"></script>
      <script src="../../plugins/datatables/dataTables.fixedColumns.min.js"></script>

      <!-- Counter Up  -->
      <script src="../../plugins/waypoints/lib/jquery.waypoints.min.js"></script>
      <script src="../../plugins/counterup/jquery.counterup.min.js"></script>

      <!-- circliful Chart -->
      <script src="../../plugins/jquery-circliful/js/jquery.circliful.min.js"></script>
      <script src="../../plugins/jquery-sparkline/jquery.sparkline.min.js"></script>

      <!-- skycons -->
      <script src="../../plugins/skyicons/skycons.min.js" type="text/javascript"></script>

      <!--Morris Chart-->
      <script src="../../plugins/morris/morris.min.js"></script>
      <script src="../../plugins/raphael/raphael-min.js"></script>


      <!-- App js -->
      <script src="../../assets/js/jquery.core.js"></script>
      <script src="../../assets/js/jquery.app.js"></script>
      <!--  <script src="../../assets/js/jquery.exportbuttons.js"></script>-->

      <!--<script src="../../assets/js/jquery.menu.js"></script>-->
      <script src="../../assets/js/accent-neutralise.js"></script>


      <!-- End Footer -->
      <!-- jQuery  -->
      <script type="text/javascript">

      $(document).ready(function(){
        $("#nota").keyup(function(){
          var punteo=$("#punteo").val();
          var nota =$("#nota").val();
          var total =(nota/70)*punteo;
          $("#total").val(total);
        });

      });
      </script>

    </body>
    </html>
