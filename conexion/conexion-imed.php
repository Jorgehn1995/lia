<?php

$host = "localhost";
$host2="mysql.hostinger.es";
$user = "root";
$user2="u182425983_admin";
//$user2="u270127236_admin";
$pass = "";
$pass2 = "imed2017";
$tablaalumnos="sefprueba";
$tablaalumnos2="u182425983_admin";
$server1="$host, $user, $pass, $tablaalumnos";
$server2="$host2, $user2, $pass2, $tablaalumnos2";
$conectserver=$server1;
$mysqli = new mysqli($host2, $user2, $pass2, $tablaalumnos2);
mysqli_set_charset($mysqli, "utf8");
/* comprobar la conexión */
if ($mysqli->connect_errno) {
  printf("Conexión fallida: %s\n", $mysqli->connect_error);
  exit();
}
/* comprobar si el servidor sigue vivo */
if ($mysqli->ping()) {
  /*¡La conexión está bien!\n*/
  printf ("");
} else {
  printf ("Error: %s\n", $mysqli->error);
}
/* cerrar la conexión */
$mysqli->close();
$conexion=mysqli_connect($host2, $user2, $pass2, $tablaalumnos2);
$acentos =$conexion->query("SET NAMES 'utf8'");
?>
