<?php
require '../lib/sesion.php';
require '../../conexion/conexion.php';
require '../../assets/datetime.php';
require '../../assets/glib/isset.php';
header('Content-Type: application/json');
$raiz=d("raiz");
if ($raiz=="") {
  $raiz="./";
}
function formatBytes($size, $precision = 2)
{
  if ($size==0) {
    return "0";
  }
  $base = log($size, 1024);
  $suffixes = array('', 'Kb', 'MB', 'GB', 'TB');

  return round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
}
$arreglo= array();
$sentencia = "SELECT *, nube.nombre as nuben, UNIX_TIMESTAMP(nube.creacion) as uni FROM `nube` INNER JOIN `tipoarchivo` on nube.tipo=tipoarchivo.idtipoarchivo WHERE nube.idcole='$idcole' AND nube.idpersonal='$idusuario' AND nube.raiz='$raiz' AND nube.eliminado='0'";
$data=array();
$resultado = mysqli_query($conexion,$sentencia);
while ($a=mysqli_fetch_array($resultado)) {
  $solonombre=utf8_encode(basename($a['nuben'],".".end(explode(".",$a['nuben']))));
  $tipo=$a['tipo'];
  if ($tipo==13) {
    $class="open";
    $boton='<button type="button" data-raiz="'.$a['idnube'].'" class="btn btn-secondary btn-sm waves-effect waves-light open" name="button"><i class="  ti-folder "></i> Abrir</button>';
  }else {
    $boton='<a href="../../archivos/'.$a['direccion'].'" download="'.utf8_encode($a['nuben']).'" class="btn btn-secondary btn-sm waves-effect waves-light"><i class=" ti-download "></i> Descargar</a>';
    $class="ver";
  }
  $agg = array(
    'idnube' => $a['idnube'],
    'nombre' => utf8_encode($a['nuben']),
    'nombrese'=>$solonombre,

    'nombrearchivo'=>'<div class="inbox-widget nicescroll"><a href="javascript:void(0)"  data-raiz="'.$a['idnube'].'" class="'.$class.'">
    <div class="inbox-item">
    <p class="inbox-item-author" style="font-size:14px!important;">'.'<i class="'.$a['icono'].'"></i>'." ".substr($solonombre,0,30).'</p>
    <p class="inbox-item-text">'.$a['nombre'].' - '.utf8_encode("Tamaño ").formatBytes($a['peso'],0)." - ".ago($a['uni']).'</p>
    </div>
    </a></div>',

    'nombrearchivo2' => '<a href="javascript:void(0)" class="btn-light ver">'.'<i class="'.$a['icono'].'"></i>'."  ".substr(utf8_encode($a['nuben']),0,35).'</a>',
    'raiz' => $a['raiz'],
    'direccion' => $a['direccion'],
    'tipo' => $a['nombre'],
    'extension' => $a['extension'],
    'icono' => '<i class="'.$a['icono'].'"></i>',
    'peso' => formatBytes($a['peso'],0),
    'creado'=> ago($a['uni']),
    'opt'=>'<div class="btn-group dropdown">
    '.$boton.'
    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false"><i class="caret"></i></button>
    <div class="dropdown-menu">
    <a class="dropdown-item ver" href="javascript:void(0);">Ver</a>
    <a class="dropdown-item renombrar" href="javascript:void(0);">Renombrar</a>
    <!--<a class="dropdown-item" href="javascript:void(0);">Mover</a>-->
    <a class="dropdown-item eliminar" href="javascript:void(0);">Eliminar</a>
    </div>
    </div>',
  );

  array_push($data, $agg);

}


/////**********************************************************
$arreglo["data"] = $data;

echo utf8_decode(json_encode($arreglo, JSON_UNESCAPED_UNICODE));

mysqli_free_result($resultado);
mysqli_close($conexion);
?>
