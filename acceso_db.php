<?php
  require_once 'login.php';
  $db_server = mysql_connect($db_hostname, $db_username, $db_password);

  if (!$db_server) die("No es posible hacer la conexión con MySQL: " . mysql_error());

    mysql_select_db($db_database)
    or die("No se logró seleccionar la base de datos: " . mysql_error());
?>