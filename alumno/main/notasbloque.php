<?php
require '../lib/sesion.php';
require '../../conexion/conexion.php';
require '../../assets/glib/isset.php';

$bloque = d("b");
$idgrado = get_query('idgrado');
$sec = get_query('seccion');
$idalumno = get_query('idalumno');
get_autorization($bloque);
echo '<table class="table table-responsive table-hover" >
  <thead>
    <tr>
      <td>#</td>
      <td>Materia</td>
      <td>Nota</td>
      <td>Acciones</td>
    </tr>
  </thead>
  <tbody>';
$ssqqll = "SELECT * FROM `materias` INNER JOIN `grados` ON materias.idgrado=grados.idgrado INNER JOIN `nombrematerias` ON materias.idnombremateria=nombrematerias.idnombremateria WHERE materias.idcole='$idcole' AND materias.idgrado='$idgrado' AND materias.seccion='$sec' ORDER BY num";
$qquery = mysqli_query($conexion, $ssqqll);
if ($qquery->num_rows == 0) {
    echo "Error no se encontraron materias";
} else {
    while ($e = mysqli_fetch_array($qquery)) {
        $nclase = $e['nombreficha'];
        $idnm = $e['idnombremateria'];
        $ngrado = $e['boton'];
        $num = $e['num'];
        if ($nclase == "") {
            $nclase = $e['nombre'];
        }
        $sqlnotas = "SELECT *, SUM(obtenido) as tt FROM notas WHERE idcole='$idcole' AND idalumno='$idalumno' AND idmateria='$idnm' AND idbloque='$bloque' AND idgrado='$idgrado' GROUP BY idalumno";
        $querynotas = mysqli_query($conexion, $sqlnotas);
        if ($querynotas->num_rows == 0) {
            $total = 0;
        }
        while ($f = mysqli_fetch_array($querynotas)) {
            $total = $f["tt"];
        }
        $sqlnotas = "SELECT *, SUM(obtenido) as tt FROM notasasesores WHERE idcole='$idcole' AND idalumno='$idalumno' AND idbloque='$bloque' AND idgrado='$idgrado' GROUP BY idalumno";
        $querynotas = mysqli_query($conexion, $sqlnotas);
        if ($querynotas->num_rows == 0) {
            $na = 0;
        }
        while ($f = mysqli_fetch_array($querynotas)) {
            $na = $f["tt"];
        }

        $total += $na;

        if ($total < 60) {
            $c = "danger";
        } else {
            $c = "success";
        }
        echo "<tr>
      <td>$num</td><td>$nclase </td>  <td><span class='badge badge-$c'>$total</span></td><td>" . '<button  class="btn btn-secondary btn-sm"type="button" name="button">Ver Cuadro</button>' . "</td>
      <tr>";
    }
}
echo "</tbody>
</table>";
?>
