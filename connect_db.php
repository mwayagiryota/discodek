<?php

DEFINE ('DB_USER', 'chesconn_mwaka');
DEFINE ('DB_PASSWORD', 'LemonS0da!');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'chesconn_db1');

// Create connection
$dbc = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check connection
if ($dbc->connect_error) {
	die("Connection failed: " . $dbc->connect_error);
}

$dbc -> set_charset("utf8");
?>

