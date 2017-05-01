<?php

	require_once("pageGenerator.php");
	require_once ("dbLogin.php");

	$body = '';

	if(isset($_POST['confirm'])) {
		$banName = $_POST['banName'];

		$db_connection = new mysqli($host, $user, $dbpassword, $database);
	
		if ($db_connection->connect_error) {
			die($db_connection->connect_error);
		}

		$query = "update `Users` set `banned` = 'T' where (`name`='$banName');";

		$db_result = $db_connection->query($query);
		if (!$db_result) {
			die("Update failed: ". $db_connection->error);
		}

		$query = "delete from `Reports` where (`name`='$banName');";
		$db_result = $db_connection->query($query);
		if (!$db_result) {
			die("Update failed: ". $db_connection->error);
		}
		else {
			$body .= 'Successfully banned user: '.$banName;
		}

		$body .= "<br><br><button class='btn btn-primary' id='back'>Back</button>
  						<script> var btn = document.getElementById('back');
  								 btn.addEventListener('click', function() {
      							 document.location.href = 'admin.php';});</script>";
		$page = generatePage($body, "Confirmation Page");
		echo $page;

		$db_connection->close();

	}
	else {
		echo "failed";
	}

?>