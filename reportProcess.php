<?php

	require_once("pageGenerator.php");
	require_once ("dblogin.php");

	$body = '';

	if(isset($_POST['confirm'])) {
		$banName = $_POST['banName'];
		$checkbox = $_POST['checkbox'];
		$comment = $_POST['comment'];

		$db_connection = new mysqli($host, $user, $password, $database);
	
		if ($db_connection->connect_error) {
			die($db_connection->connect_error);
		}

		$query = "insert into `Reports` (`name`, `checkbox`, `comment`) values
		('$banName' , '$checkbox', '$comment')";

		$db_result = $db_connection->query($query);
		if (!$db_result) {
			die("Report failed: ". $db_connection->error);
		}
		else {
			$body .= 'Successfully reported user: '.$banName;
		}

		$body .= "<br><br><button class='btn btn-primary' id='back'>Back</button>
  						<script> var btn = document.getElementById('back');
  								 btn.addEventListener('click', function() {
      							 document.location.href = 'index.php';});</script>";
		$page = generatePage($body, "Confirmation Page");
		echo $page;

		$db_connection->close();

	}
	else {
		echo "failed";
	}

?>