<div class="row">
  <div class="col-md-2" style="display:none;">
    <div class="form-group">
      <label for="cod" class="control-label">Identificador *</label>
      <input type="text" class="form-control" id="id" value="0" readonly placeholder="id">
    </div>
  </div>
  <div class="col-md-2">
    <div class="form-group">
      <label for="cod" class="control-label">Codigo Personal *</label>
      <input type="text" class="form-control" id="cod"   placeholder="Codigo">
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="nombres" class="control-label">Nombres *</label>
      <input type="text" class="form-control" id="nombres"   placeholder="Nombres">
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="field-3" class="control-label">Apellidos *</label>
      <input type="text" class="form-control" id="apellidos"   placeholder="Apellidos">
    </div>
  </div>
  <div class="col-md-2">
    <div class="form-group">
      <label for="grado" class="control-label">Grado a cursar *</label>
      <select    id="grado" class="form-control select2">
        <option value="">Seleccionar</option>
        <?php require '../phpshared/selectgradeonly.php' ?>
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
        <option value="M">Masculino</option>
        <option value="F">Femenino</option>
      </select>
    </div>
  </div>
  <div class="col-md-2">
    <div class="form-group">
      <label for="nacimiento" class="control-label">Nacimiento *</label>
      <div class="input-group">
        <input type="text" class="form-control"   placeholder="dd/mm/aaaa" id="nacimiento">
        <span class="input-group-addon bg-primary b-0 text-white"><i class=" ti-calendar "></i></span>
      </div><!-- input-group -->
    </div>
  </div>
  <div class="col-md-2">
    <div class="form-group">
      <label for="nacionalidad" class="control-label">Nacionalidad *</label>
      <select id="nacionalidad"   class="form-control select2">
        <option value="">Seleccionar</option>
        <option value="Guatemalteca">Guatemalteco</option>
        <option value="Extrangero">Extranjero</option>
      </select>
    </div>
  </div>
  <div class="col-md-2">
    <div class="form-group">
      <label for="doc" class="control-label">Documento</label>
      <select id="doc" class="form-control select2">
        <option>Seleccionar</option>
        <option value="CUI">CUI</option>
        <option value="Pasaporte">Pasaporte</option>
        <option value="Acta de Nacimiento">Acta de Nacimiento</option>
      </select>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="nodoc" class="control-label"># Documento</label>
      <input type="text" class="form-control" id="nodoc" placeholder="Número de documento">
    </div>
  </div>

</div>
<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label for="encargado" class="control-label">Encargado *</label>
      <input type="text"    class="form-control" id="encargado" placeholder="Nombre de encargado">
    </div>
  </div>
  <div class="col-md-2">
    <div class="form-group">
      <label for="tel-encargado" class="control-label">Telefono Encargado *</label>
      <input type="text"    class="form-control" id="tel-encargado" placeholder="Telefono">
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label for="otros" class="control-label">Otros Datos</label>
      <input type="text" class="form-control" id="otros" placeholder="Otros datos">
    </div>
  </div>
</div>
