<?php
function d($var, $number = "t"){
  $found=0;
  $nvar="";
  if (isset($_GET[$var])) {
    $nvar=$_GET[$var];
    $found=1;
  }
  if ($found==0) {
    if (isset($_POST[$var])) {
      $nvar=$_POST[$var];
      $found=1;
    }
  }
  if ($found==0) {
    if ($number=="n") {
      $nvar=0;
    }else {
      $nvar="";
    }
  }
  return $nvar;
}
function dx($var, $number = "t"){
  $found=0;
  $nvar="";
  if (isset($_GET[$var])) {
    $nvar=$_GET[$var];
    $found=1;
  }
  if ($found==0) {
    if (isset($_POST[$var])) {
      $nvar=$_POST[$var];
      $found=1;
    }
  }
  if ($found==0) {
    exit ("$var");
  }else {
    return $nvar;
  }
}
function chk($var){
  $found=0;
  $nvar="";
  if (isset($_GET[$var])) {
    $nvar=$_GET[$var];
    $found=1;
  }
  if ($found==0) {
    if (isset($_POST[$var])) {
      $nvar=$_POST[$var];
      $found=1;
    }
  }
  if ($found==0) {
    $nvar=0;
  }else {
    $nvar=1;
  }
  return $nvar;
}
function df($fecha){
  $f=explode("/",$fecha);
  return $f[0];
}
function mf($fecha){
  $f=explode("/",$fecha);
  return $f[1];
}
function af($fecha){
  $f=explode("/",$fecha);
  return $f[2];
}
?>
