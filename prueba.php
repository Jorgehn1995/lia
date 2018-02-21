<?php
$pass="Dayana";
echo "$pass";
echo "<br>";
//$salt=['cost'=>12];


echo "<br>********************************************<br>";


$contraencriptada='$2y$10$x/qFqLBvxTGW8zfxUkDtMe0q/jXFQJc5kUHA1.NDld08u37rQximO';
$r=password_hash($pass, PASSWORD_BCRYPT);
echo "$r";


echo "<br>********************************************<br>";
$des=password_verify("Daya", $contraencriptada);
echo $des;
 ?>
