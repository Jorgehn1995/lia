<?php
require '../lib/sesion.php';
require '../../conexion/conexion.php';
require '../../assets/glib/isset.php';
header('Content-Type: application/json');
$require=dx("id");
$data=array();
if ($require==1) {
  $dropzone= '<div class="row uploadzone" >
  <div class="col-md-12 portlets">
  <div class="m-b-30" id="formDropZone">
  </div>
  </div>
  </div>';
}elseif ($require==2) {
  $dropzone='<div class="form-group no-margin">
    <label for="field-7" class="control-label">Compartir Video de YouTube</label>
    <div class="input-group">
    <input type="text" name="example-input2-group2" id="inputlink"  class="form-control" placeholder="Pega aqui tu enlace de Youtube">
    <span class="input-group-btn">
    <button type="button" class="btn waves-effect waves-light btn-success btn-uplink" data-tipo="youtube">Subir</button>
    </span>
    </div>
    <p id="txtup" class="text-success">Archivo Subido</p>
  </div>';
}elseif ($require==3) {
  $dropzone='<div class="form-group no-margin">
    <label for="field-7" class="control-label">Compartir Enlace de Internet</label>
    <div class="input-group">
    <input type="text" id="inputlink" name="example-input2-group2" class="form-control" placeholder="Pega aqui tu enlace de internet">
    <span class="input-group-btn">
    <button type="button" class="btn waves-effect waves-light btn-success btn-uplink " data-tipo="link">Subir</button>
    </span>

    </div>
    <p id="txtup" class="text-success">Archivo Subido</p>
  </div>';
}elseif ($require==4) {
  $dropzone='<div class="form-group no-margin">
    <label for="field-7" class="control-label">Seleciona un Archivo de tu Nube</label>
    <select class="form-control select2" id="fileshare" name="">
      <option value="none">Archivos de Tu Nube</option>
    </select>
  </div>';
}
$agg = array(
  'r' => true,
  'zone' => $dropzone,
);
array_push($data, $agg);
echo utf8_decode(json_encode($data, JSON_UNESCAPED_UNICODE));
?>
