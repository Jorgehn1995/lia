<div class="row">
  <div class="col-md-6 col-md-offset-6">
    <div class="pull-right">
      <div class="btn-group">
        <button type="button" onclick="location='alumnos.php'" class="btn btn-default btn-round"name="button"><i class="material-icons">arrow_back</i> Regresar</button>
        <button type="button" onclick='location="generarficha.php?acodigo=<?php echo $amigo; ?>&lg=<?php echo $lugardegrado; ?>&rc=<?php echo $ficharendiC; ?>&r1=<?php echo $ficharendi1; ?>&r2=<?php echo $ficharendi2; ?>"' class="btn btn-primary btn-round" target="_blank" name="button"><i class="material-icons">print</i> Imprimir Ficha</button>
        <button type="button" onclick='location="excel/individual.php?codigo=<?php echo $amigo; ?>"' class="btn btn-success btn-round" name="button"><i class="material-icons">file_upload</i> Importar Excel</button>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th class="text-center primary">Nombre del Alumno</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="text-center"><h5 class="card-title"><?php echo "$apellidos"; ?><small>, <?php echo " $nombres"; ?></small></h5></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="col-md-3">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th class="text-center">Posicion</th>
          <th class="text-center">Promedio</th>
          <th class="text-center">Rendimiento</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="text-center"><?php echo "$lugardegrado"; ?></td>
          <td class="text-center"><?php echo "$rendi"; ?></td>
          <td class="text-center"><span class='label label-<?php echo "$colordelabel"; ?>'><?php echo "$lrendimiento"; ?></span></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="col-md-3">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th class="text-center">Grado</th>
          <th class="text-center">Sección</th>
          <th class="text-center">Clave</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="text-center"><?php echo "$grado"; ?></td>
          <td class="text-center"><?php echo "$seccion"; ?></td>
          <td class="text-center"><?php echo "$clave"; ?></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
<div class="row">
  <div class="col-md-6">

  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="text-center">
    <P><strong>FICHA</strong></P>
    </div>
    <?php include 'tabla.php'; ?>
  </div>
  <div class="col-md-6">
    <div class="text-center">
    <p><strong>Clases Perdidas</strong></p>
    </div>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Bloque I</th>
          <th>Bloque II</th>
          <th>Bloque III</th>
          <th>Bloque IV</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo "$clasesperdidasb1"; ?></td>
          <td><?php echo "$clasesperdidasb2"; ?></td>
          <td><?php echo "$clasesperdidasb3"; ?></td>
          <td><?php echo "$clasesperdidasb4"; ?></td>
          <td><?php echo "$totalclasesperdidas"; ?></td>
        </tr>
      </tbody>
    </table>
    <div class="text-center">
    <p><strong>Progreso</strong></p>
    </div>
    <?php include 'progreso.php'; ?>
  </div>
</div>
