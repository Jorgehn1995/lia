<div class="card-box">
  <div class="col-md-12">
    <div class="row">
      <div class="col-md-2" style="display:none;">
        <div class="form-group">
          <label for="cod" class="control-label">Identificador *</label>
          <input type="text" class="form-control" id="id" value="<?php echo $id; ?>" readonly placeholder="id">
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label for="ciclo" class="control-label">Tipo De Grado *</label>
          <select    id="ciclo" class="form-control select2">
            <option value="select">Seleccionar</option>
            <?php
            for ($g=0; $g <=5 ; $g++) {
              $an = array("Primaria", "Básico", "Bachillerato", "Secretariado", "Magisterio", "Perito");
              $n=$an[$g];
              if ($g==2) {
                echo '<optgroup label="Nivel Diversificado">';
              }
              if ($tipo==$n) {
                echo "<option selected value='$n'>$n</option>";
              }else {
                echo "<option value='$n'>$n</option>";
              }

              if ($g==5) {
                echo '</optgroup>';
              }
            }
            ?>
          </select>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label for="grado" class="control-label">Grado *</label>
          <select    id="grado" class="form-control select2">
            <option value="select">Seleccionar</option>
            <?php
            for ($g=0; $g <=5 ; $g++) {
              $an = array("Primero", "Segundo", "Tercero", "Cuarto", "Quinto", "Sexto");
              $n=$an[$g];
              if ($grado==$n) {
                echo "<option selected value='$n'>$n</option>";
              }else {
                echo "<option value='$n'>$n</option>";
              }
            }
            ?>

          </select>
        </div>
      </div>

      <div class="col-md-4">
        <div class="form-group">
          <label for="cc" class="control-label">Cantidad de Clases *</label>
          <input id="cc" name="example-input1-group1" value="<?php echo $cc; ?>" class="form-control" placeholder="Cantidad de Clases" type="text">
        </div>
      </div>
    </div>
    <div class="row" id="ncarrera" style="display:none;">
      <div class="col-md-6" >
        <div class="form-group">
          <label for="grado" class="control-label">Especialidad *</label>
          <div class="input-group">
            <span class="input-group-addon" data-toggle="tooltip" data-placement="top" title="Ejemp: 'De Educacion Infantil Billingue Intercultural'"><i class=" ti-info "></i></span>
            <input id="esp" class="form-control" value="<?php echo $esp; ?>" placeholder="Escriba el nombre completo de la especialidad de la carrera" type="text">
          </div>
        </div>
      </div>
      <div class="col-md-6" >
        <div class="form-group">
          <label for="grado" class="control-label">Nombre Corto *</label>
          <div class="input-group">
            <span class="input-group-addon" data-toggle="tooltip" data-placement="top" title="Ejemp: 'De Educacion'"><i class=" ti-info "></i></span>
            <input id="espn" class="form-control" value="<?php echo $espn; ?>" placeholder="Escriba un nombre corto para la especialidad" type="text">
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <p class="text-muted font-13 m-b-15 m-t-20">Secciones del grado</p>
        <div class="checkbox checkbox-success form-check-inline">
          <input id="a" <?php echo $sec1; ?> value="option1" type="checkbox">
          <label for="a"> Sección A </label>
        </div>
        <div class="checkbox checkbox-success form-check-inline">
          <input id="b" <?php echo $sec2; ?> value="option1" type="checkbox">
          <label for="b"> Sección B </label>
        </div>
        <div class="checkbox checkbox-success form-check-inline">
          <input id="c" <?php echo $sec3; ?> value="option1" type="checkbox">
          <label for="c"> Sección C </label>
        </div>
        <div class="checkbox checkbox-success form-check-inline">
          <input id="d" <?php echo $sec4; ?> value="option1" type="checkbox">
          <label for="d"> Sección D </label>
        </div>
        <div class="checkbox checkbox-success form-check-inline">
          <input id="e" <?php echo $sec5; ?> value="option1" type="checkbox">
          <label for="e"> Sección E </label>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">

        <div class="pull-right">
          <p class="text-muted ">(*) Datos Obligatorios</p>
          <button class="btn save btn-success waves-effect waves-light m-b-5"> <i class="fa  fa-save  m-r-5"></i> <span>Guardar Datos</span> </button>
          <button class="btn clear btn-warning waves-effect waves-light m-b-5"> <i class="fa  fa-sticky-note-o m-r-5"></i> <span>Limpiar</span> </button>
          <button class="btn cancel btn-danger waves-effect waves-light m-b-5"> <i class="fa  fa-ban m-r-5"></i> <span>Cancelar y Regresar</span> </button>
        </div>
      </div>
    </div>
  </div>
</div>
