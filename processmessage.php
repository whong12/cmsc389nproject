<?php
require_once("dbLogin.php");

$db_connection = new mysqli($host, $user, $password, $database);
if ($db_connection->connect_error) {
	die($db_connection->connect_error);
}	
$msg = $_POST['action'];
$sender = $_COOKIE['user'];
$query = 'INSERT INTO messages (content, sender) VALUES ("'.$msg.'", "'.$sender.'");';
$result = $db_connection->query($query);
if (!$result) {
	die("Insertion failed: " . $db_connection->error);
} 
$db_connection->close();
?>