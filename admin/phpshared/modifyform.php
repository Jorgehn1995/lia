
<div class="row">
  <div class="col-md-12">
    <div class="card-box">
      <div class="row">
        <div class="col-md-2" style="display:none;">
          <div class="form-group">
            <label for="cod" class="control-label">Identificador *</label>
            <input type="text" class="form-control" id="idalumno" value="<?php echo $dt['id']; ?>" readonly placeholder="id">
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <label for="cod" class="control-label">Codigo Personal *</label>
            <input type="text" class="form-control" id="cod" value="<?php echo $dt['codigo']; ?>"  placeholder="Codigo">
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label for="nombres" class="control-label">Nombres *</label>
            <input type="text" class="form-control" id="nombres" value="<?php echo $dt['nombres']; ?>"  placeholder="Nombres">
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label for="field-3" class="control-label">Apellidos *</label>
            <input type="text" class="form-control" id="apellidos" value="<?php echo $dt['apellidos']; ?>"  placeholder="Apellidos">
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <label for="grado" class="control-label">Grado a cursar *</label>
            <select    id="grado" class="form-control select2">
              <option value="">Seleccionar</option>
              <?php
              require '../../conexion/conexion.php';
              $sql="SELECT * FROM `grados` WHERE idcole = '$idcole'";
              $con=mysqli_query($conexion,$sql);
              while ($cg=mysqli_fetch_array($con)) {
                $idg=$cg['idgrado'];
                $grado=$cg['boton'];
                if ($dt['idgrado']==$cg['idgrado']) {
                  $s="selected";
                }else {
                  $s="";
                }
                //echo "<optgroup label=\"$grado\">";
                echo "<option $s value=\"$idg\">$grado</option>";
                //echo "</optgroup>";
                require '../../conexion/cerrar_conexion.php';
              }
              ?>
            </select>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-2">
          <div class="form-group">
            <label for="genero" class="control-label">Genero *</label>
            <select id="genero"   class="form-control select2">
              <option value="">Seleccionar</option>
              <?php
              if ($dt['genero']=="M") {
                $m="selected";
                $f="";
              }else {
                $m="";
                $f="selected";
              }
               ?>
               <option value="">Seleccionar</option>
               <option <?php echo $m; ?> value="M">Masculino</option>
               <option <?php echo $f; ?> value="F">Femenino</option>
            </select>
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <label for="nacimiento" class="control-label">Nacimiento *</label>
            <div class="input-group">
              <input type="text" class="form-control"   placeholder="dd/mm/aaaa" value="<?php echo $dt['nacimiento']; ?>" id="nacimiento">
              <span class="input-group-addon bg-primary b-0 text-white"><i class=" ti-calendar "></i></span>
            </div><!-- input-group -->
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <label for="nacionalidad" class="control-label">Nacionalidad *</label>
            <select id="nacionalidad"   class="form-control select2">
              <?php
              if ($dt['nacionalidad']=="Guatemalteca") {
                $g="selected";
                $e="";
              }else {
                $g="";
                $e="selected";
              }
               ?>
              <option value="">Seleccionar</option>
              <option <?php echo $g; ?> value="Guatemalteca">Guatemalteco</option>
              <option <?php echo $e; ?> value="Extrangero">Extranjero</option>
            </select>
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <label for="doc" class="control-label">Documento</label>
            <select id="doc" class="form-control select2">
              <?php
              if ($dt['doc']=="CUI") {
                $c="selected";
                $p="";
                $a="";
              }
              if ($dt['doc']=="Pasaporte") {
                $c="";
                $p="selected";
                $a="";
              }
              if ($dt['doc']=="Acta de Nacimiento") {
                $c="";
                $p="";
                $a="selected";
              }
               ?>
              <option <?php echo $c; ?> value="CUI">CUI</option>
              <option <?php echo $p; ?> value="Pasaporte">Pasaporte</option>
              <option <?php echo $a; ?> value="Acta de Nacimiento">Acta de Nacimiento</option>
            </select>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label for="nodoc" class="control-label"># Documento</label>
            <input type="text" class="form-control" id="nodoc" value="<?php echo $dt['nodoc']; ?>" placeholder="Número de documento">
          </div>
        </div>

      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <label for="encargado" class="control-label">Encargado *</label>
            <input type="text"    class="form-control" id="encargado" value="<?php echo $dt['encargado']; ?>" placeholder="Nombre de encargado">
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <label for="tel-encargado" class="control-label">Telefono Encargado *</label>
            <input type="text"    class="form-control" id="tel-encargado" value="<?php echo $dt['telencargado']; ?>" placeholder="Telefono">
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label for="otros" class="control-label">Otros Datos</label>
            <input type="text" class="form-control" id="otros" value="<?php echo $dt['otros']; ?>" placeholder="Otros datos">
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <label for="estado" class="control-label">Estado</label>
            <select id="estado" class="form-control select2">
              <?php
              if ($dt['estado']=="Activo") {
                $active="selected";
                $suspend="";
                $retired="";
              }
              if ($dt['estado']=="Suspendido") {
                $active="";
                $suspend="selected";
                $retired="";
              }
              if ($dt['estado']=="Retirado") {
                $active="";
                $suspend="";
                $retired="selected";
              }
               ?>
              <option <?php echo $active; ?> value="Activo">Activo</option>
              <option <?php echo $suspend; ?> value="Suspendido">Suspendido</option>
              <option <?php echo $retired; ?> value="Retirado">Retirado</option>
            </select>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="pull-right">
            <p class="text-muted ">(*) Datos Obligatorios</p>
            <button class="btn save btn-success waves-effect waves-light m-b-5"> <i class="fa  fa-save  m-r-5"></i> <span>Actualizar Datos</span> </button>
            <button class="btn cancel btn-danger waves-effect waves-light m-b-5"> <i class="fa  fa-ban m-r-5"></i> <span>Cancelar</span> </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
