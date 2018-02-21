<div class="row">
  <div class="col-md-2" style="display:none;">
    <div class="form-group">
      <label for="cod" class="control-label">Identificador *</label>
      <input type="text" class="form-control" id="id" value="0" readonly placeholder="id">
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group">
      <label for="cod" class="control-label">Codigo Personal *</label>
      <input type="text" class="form-control" id="cod" autocomplete="off" placeholder="Codigo">
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="nombres" class="control-label">Nombres *</label>
      <input type="text" class="form-control" id="nombres"  autocomplete="off" placeholder="Nombres">
    </div>
  </div>
  <div class="col-md-5">
    <div class="form-group">
      <label for="field-3" class="control-label">Apellidos *</label>
      <input type="text" class="form-control" id="apellidos" autocomplete="off"  placeholder="Apellidos">
    </div>
  </div>

</div>

<div class="row">
  <div class="col-md-3">
    <div class="form-group">
      <label for="nacimiento" class="control-label">Nacimiento *</label>
      <div class="input-group">
        <input type="text" class="form-control"   placeholder="dd/mm/aaaa"  id="nacimiento">
        <span class="input-group-addon bg-primary b-0 text-white"><i class=" ti-calendar "></i></span>
      </div><!-- input-group -->
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group" id="divgenero">
      <label for="genero" class="control-label">Genero *</label>
      <select id="genero"   class="form-control select2">
        <option value="">Seleccionar</option>
        <option value="M">Masculino</option>
        <option value="F">Femenino</option>
      </select>
    </div>
  </div>

  <div class="col-md-5">
    <div class="form-group" id="divgrado">



    </div>
  </div>
  <div class="col-md-3" style="display:none;">
    <div class="form-group">
      <label for="nacionalidad" class="control-label">Nacionalidad *</label>
      <select id="nacionalidad"   class="form-control select2">
        <option value="">Seleccionar</option>
        <option value="Guatemalteca">Guatemalteco</option>
        <option value="Extrangero">Extranjero</option>
      </select>
    </div>
  </div>
  <div class="col-md-2" style="display:none;">
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
  <div class="col-md-4" style="display:none;">
    <div class="form-group">
      <label for="nodoc" class="control-label"># Documento</label>
      <input type="text" class="form-control" id="nodoc" placeholder="Número de documento">
    </div>
  </div>

</div>
<div class="row">
  <div class="col-md-5">
    <div class="form-group">
      <label for="encargado" class="control-label">Encargado *</label>
      <input type="text"    class="form-control" autocomplete="false" id="encargado" placeholder="Nombre de encargado">
    </div>
  </div>
  <div class="col-md-2">
    <div class="form-group">
      <label for="tel-encargado" class="control-label">Telefono Encargado *</label>
      <input type="text"    class="form-control" autocomplete="off" id="tel-encargado" placeholder="Telefono">
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group">
      <label for="otros" class="control-label">Talonario</label>
      <input type="text" class="form-control" autocomplete="off" id="otros" placeholder="Numero">
    </div>
  </div>
  <div class="col-md-2">
    <div class="form-group">
      <label for="otros" class="control-label">- Correlativo</label>
      <input type="text" class="form-control" id="otros2" disabled placeholder="Correlativo">
    </div>
  </div>
</div>
