<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'empresa');

$connection = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
$connection->set_charset("utf8");

if ($connection == false) {
	die("ERRO AO CONECTAR " . mysql_error($connection));
}

?>