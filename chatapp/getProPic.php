<?php
	require_once("dblogin.php");
	$db_connection = new mysqli($host, $user, $password, $database);
	if ($db_connection->connect_error) {
		die($db_connection->connect_error);
	}
	$usernm = $_GET['user'];
	$query = "select picture from users where name = \"$usernm\"";
	$result = $db_connection->query($query);
	$resultArr = $result->fetch_array(MYSQLI_ASSOC);
	header("Content type: impage/jpeg");
	echo $resultArr['picture'];
?>