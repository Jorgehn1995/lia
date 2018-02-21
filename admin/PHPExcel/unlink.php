<?php
if(isset($_GET['file'])){
  unlink($_GET['file']);
  echo "true";
}else {
  echo "false";
}

 ?>
