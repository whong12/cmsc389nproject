<?php

require_once("pageGenerator.php");
require_once("helper.php");
require_once ("dblogin.php");

$current_user = $_COOKIE['user'];

$db_connection = new mysqli($host, $user, $password, $database);

if ($db_connection->connect_error) {
	die($db_connection->connect_error);
}

$query = "select name from `Users` where (`name` != '$current_user' AND `banned` = 'F')";

$db_result = $db_connection->query($query);
if (!$db_result) {
	die("Retrieval failed: ". $db_connection->error);
} else {

	$num_rows = $db_result->num_rows;
	if ($num_rows === 0) {
		$result = '<br>';
		$result .= "<br><button class='btn btn-primary' id='back'>Back</button>
			<script> var btn = document.getElementById('back');
				btn.addEventListener('click', function() {
				document.location.href = 'index.php';});</script>";
		$page = generatePage($result, "No User To Report");
		echo $page;
	} else {
		$name_array = array();
		for ($row_index = 0; $row_index < $num_rows; $row_index++) {
			$db_result->data_seek($row_index);
			$row = $db_result->fetch_array(MYSQLI_ASSOC);

			$name_array[] = $row['name'];
		}

		$msg = "";
		$msg .= '<div class="form"><form id="review" action="reportReview.php" method="post">';
		$msg .= reportHelper($name_array);
		$msg .= "</form></div>";
		$msg .= "<br><button class='btn btn-primary' id='back'>Back</button>
			<script> var btn = document.getElementById('back');
				btn.addEventListener('click', function() {
				document.location.href = 'index.php';});</script>";
		$page = generatePage($msg, "Users To Report");
		echo $page;

	}
}

$db_result->close();
$db_connection->close();

?>