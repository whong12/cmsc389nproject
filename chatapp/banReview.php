<?php

	require_once("pageGenerator.php");
	require_once ("dbLogin.php");
	require_once("helper.php");

	if(isset($_POST['report'])) {
		$name = $_POST['report'];

		$db_connection = new mysqli($host, $user, $dbpassword, $database);
	
		if ($db_connection->connect_error) {
			die($db_connection->connect_error);
		}

		$query = "select * from `Reports` where (`name`='$name')";

		$db_result = $db_connection->query($query);
		if (!$db_result) {
			die("Retrieval failed: ". $db_connection->error);
		} else {
			$msg = "";
			$msg .= '<form action="banProcess.php" method="post">';
			$num_rows = $db_result->num_rows;
			if ($num_rows === 0) {
				$result = '<br>';
				$page = generatePage($result, "No Reports To process");
				echo $page;
			} else {
				$name_array = array();
				for ($row_index = 0; $row_index < $num_rows; $row_index++) {
					$db_result->data_seek($row_index);
					$row = $db_result->fetch_array(MYSQLI_ASSOC);
					$msg  .= reportReview($row);
				}
				$msg .= "</form>";
				$msg .= "<button class='btn btn-primary' id='back'>Back</button>
  						<script> var btn = document.getElementById('back');
  								 btn.addEventListener('click', function() {
      							 document.location.href = 'admin.php';});</script>";
				$page = generatePage($msg, "Review Comments");
				echo $page;
				
			}
		}

		$db_result->close();
		$db_connection->close();
	}
	else {
		echo "failed";
	}

?>