<?php
function encriptar($pass){
  $salt=['cost'=>10];
  $r=password_hash($pass, PASSWORD_BCRYPT,$salt);
  return $r;
}
function verificar($pass, $cryp){
  $r=password_verify($pass,$cryp);
  return  $r;
}
 ?>
