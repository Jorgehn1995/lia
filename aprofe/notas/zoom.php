<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>prueba zoom</title>
</head>
<body>
  <input  id="zoom" type="range" value="100" max="200" min="24">
  <span id="zoomprint">100%</span>
  <p id="elemento">Lorem ipsum dolor amet<p>​
    <script src="../../assets/js/jquery.min.js"></script>

    <script type="text/javascript">

    $(function(){
      $("#zoom").change(function() {
        var unit = $(this).val();
        unit2 = unit+"%";
        $("#zoomprint").text(unit2);
        $("#elemento").css({"zoom": unit2 });
      });
    });
    </script>
  </body>

  </html>
