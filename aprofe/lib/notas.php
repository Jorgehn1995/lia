
<div class="table-responsive">
  <table class="table table-no-bordered table-hover">
    <thead>
      <tr>
        <th>Materia</th>
        <th style="font-size:10px;">BI</th>
        <th style='font-size:10px; background-color:#E6E6E6;'>15%</th>
        <th style="font-size:10px;">BII</th>
        <th style='font-size:10px; background-color:#E6E6E6;'>20%</th>
        <th style="font-size:10px;">BIII</th>
        <th style='font-size:10px; background-color:#E6E6E6;'>25%</th>
        <th style="font-size:10px;">BIV</th>
        <th style='font-size:10px; background-color:#E6E6E6;'>40%</th>
        <th>Total</th>
      </tr>
    </thead>
    <?php
    include ("../../conexion/conexion.php");
    $ganada = 'color: #669;    font-size: 12px; font-weight: normal; ';
    $perdida = 'color:#FA5858;   font-size: 14px; font-weight: bold;  ';
    $perdidap = 'color: #669;   font-size: 14px;  ';
    $cero = 'visibility: hidden;';
    $msg = "SN";
    for ($i=1; $i <=$datos['cc'] ; $i++) {
      $m=$mcorto[$i-1];
      $f=0;
      echo "<tr> <td>$m</td>";
      for ($b=1; $b <=4 ; $b++) {
        $nota=0;
        $porc=0;
        $sqlcuadro="SELECT * FROM `cuadro` WHERE idcole='$idcole' AND idalumno='$id' AND idmateria='$i' AND idbloque='$b'";
        $mostrar=mysqli_query($conexion,$sqlcuadro);
        while ($mos=mysqli_fetch_array($mostrar)) {
          $nota=$mos['total'];
          $porc=$mos['porcentaje'];
        }
        $bq=$nota;
        $bqp=$porc;
        if($bq < 60){
          if($bq < 1){
            $roja = $cero;
            $rojap = $cero;
            $B1C1 = $msg;
          }else{
            $roja = $perdida;
            $rojap = $perdidap;
          }
        } else{
          $roja = $ganada;
          $rojap = $ganada;
        };
        echo "<td> <h5 style='$roja'>$bq</h5>  </td>";
        echo "<td style='background-color:#E6E6E6;'> <h5 style='$rojap'>$bqp</h5>  </td>";
        $f=$f+$porc;
      }
      echo "<td>$f</td></tr>";
    }

    include ("../../conexion/cerrar_conexion.php");
    ?>
  </table>
</div>
