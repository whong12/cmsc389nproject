<?php

	require_once("pageGenerator.php");
	require_once ("dbLogin.php");
	require_once("helper.php");

	$password = '$2y$10$kYOSKqkpb0ZN/d5S/UY1w.aBP96vbFF5mhTsKli258ORy/qkBTewu';

	if(isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW']) &&
	    password_verify($_SERVER['PHP_AUTH_PW'], $password) && $_SERVER['PHP_AUTH_USER'] == 'admin') {

		$db_connection = new mysqli($host, $user, $dbpassword, $database);
	
		if ($db_connection->connect_error) {
			die($db_connection->connect_error);
		}

		$query = "select name from `Reports`";

		$db_result = $db_connection->query($query);
		if (!$db_result) {
			die("Retrieval failed: ". $db_connection->error);
		} else {

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

					$name_array[] = $row['name'];
				}

				$msg = "";
				$msg .= '<form action="banReview.php" method="post">';
				$msg .= reportHelper($name_array);
				$msg .= "</form>";
				$page = generatePage($msg, "Reports to process");
				echo $page;
				
			}
		}

		$db_result->close();
		$db_connection->close();
		
	}
	else {
		header("WWW-Authenticate: Basic realm=\"Example System\"");
		header("HTTP/1.0 401 Unauthorized");
	}

?>