<?php $cien=100; ?>
<table class="table table-no-bordered table-hover">
  <thead>
    <tr>
      <th>Clase</th>
      <th><small><small>Puntos Faltantes</small></small></th>
      <th>Resultado</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $ganada = '';
    $perdida = 'color:#FA5858;   font-size: 14px; font-weight: bold;  ';
    include ("../../conexion/conexion.php");
    //////////////////
    for ($i=1; $i <=$datos['cc'] ; $i++) {
      $m=$mcorto[$i-1];
      $f=0;
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
        $f=$f+$porc;
      }
      if ($f<60) {
        $lblc="warning";
        $lbl="No Aprobado";
      }else {
        $lblc="success";
        $lbl="Aprobado";
      }
      $faltante=round((60-$f)/0.40);
      if ($faltante<60) {
        $alert=$ganada;
      }else {
        $alert=$perdida;
      }
      $m=$mcorto[$i-1];
      echo "<tr> <td>$m</td>";
      echo "<td style='$alert'>$faltante</td>";
      echo "<td><span class='badge badge-$lblc'>$lbl</span></td>";
      echo "</tr>";
    }
    include ("../../conexion/cerrar_conexion.php");
     ?>
  </tbody>
</table>
