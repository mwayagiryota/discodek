<?php
// Database details
DEFINE ('DB_USER', '');
DEFINE ('DB_PASSWORD', '');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'chesconn_db1');

// Create connection
$dbc = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check connection and end script if connection failure 
if ($dbc->connect_error) {
	die("Connection failed: " . $dbc->connect_error);
}
// Character encoding for text handling
$dbc -> set_charset("utf8");
?>

