<div class="card-box">
  <div class="col-md-12">
    <div class="row">
      <div class="col-md-2" style="display:none;">
        <div class="form-group">
          <label for="cod" class="control-label">Identificador *</label>
          <input type="text" class="form-control" id="id" value="<?php echo $id; ?>" readonly placeholder="id">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="ciclo" class="control-label">Nombres *</label>
          <input type="text" class="form-control" id="nombres" value="<?php echo $nombres; ?>" placeholder="Nombres del Profesor">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="grado" class="control-label">Apellidos *</label>
        <input type="text" class="form-control" id="apellidos" value="<?php echo $apellidos; ?>" placeholder="Apellidos del Profesor">
        </div>
      </div>


    </div>
    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
          <label for="cc" class="control-label">Direccion </label>
          <input id="dir" name="example-input1-group1" value="<?php echo $direccion; ?>" class="form-control" placeholder="Direccion" type="text">
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label for="cc" class="control-label">Telefono </label>
          <input id="tel" name="example-input1-group1" value="<?php echo $telefono; ?>" class="form-control" placeholder="Telefono" type="text">
        </div>
      </div>
      <div class="col-md-4" <?php echo $sty; ?> >
        <div class="form-group">
          <label for="grado" class="control-label">Usuario *</label>
          <input type="text" class="form-control" id="user" value="<?php echo $usuario; ?>" placeholder="Nombre de Usuario">
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
