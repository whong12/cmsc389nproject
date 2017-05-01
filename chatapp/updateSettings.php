<?php
	require_once("dblogin.php");
	require_once("pageGenerator.php");
	$db_connection = new mysqli($host, $user, $dbpassword, $database);

	if ($db_connection->connect_error) {
		die($db_connection->connect_error);
	}
	
	if (!isset($_COOKIE["user"])){
		header("Location: index.php"); /*go back to login if user not set*/
	}
	$usernm = $_COOKIE["user"];
	$errors = "";
	$deleted = 0;
	if (isset($_POST["subBtn"])) {
		$query = "update users set ";
		$changed = 0;
		if (trim($_POST["password"].length != 0) {
			$pw = trim($_POST["password"]);
			$pw2 = trim($_POST["password2"]);
			if (strcmp($pw,$pw2) == 0) {
				$pass = password_hash($pw, PASSWORD_DEFAULT);
				$query .= "password='$pass' ";
				$changed++;
			} else {
				$errors .= "<p><strong>Error: Passwords do not match</strong></p>";
			}
		}
		if (isset($_FILES['userfile']) && $_FILES['userfile']['size'] != 0) {
			$fname = $_FILES['userfile']['tmp_name'];
			$fp = fopen($fname, 'r');
			$toUpload = fread($fp, filesize($fname));
			$toUpload = addslashes($toUpload);
			fclose($fp);
			$query .= "propic='$toUpload' ";
			$changed++;
		}
		if ($changed > 0) {
			$query .= "where username='$usernm'";
			$result = $db_connection->query($sql);
			if (!$result) {
				die("Update failed: " . $db_connection->error);
			} else {
				$errors = "<p>Update Successful</p>";
			}
		}
	} else if (isset($_POST["delBtn"])) {
		$query = "delete from users where username = '$usernm";
		$result = $db_connection->query($sql);
		if (!$result) {
			die("Deletion failed: " . $db_connection->error);
		} else {
			echo "<h1>Account deletion successful</h1>";
			$deleted = 1;
		}
	}
	$query = "select * from users where username = \"$usernm\"";
	$result = $db_connection->query($query);
	if($result && $deleted == 0) {
		$resultArr = $result->fetch_array(MYSQLI_ASSOC);
		/*get other settings like colors in css file later*/
		$body = <<<EOBODY
			<h1>Update Settings</h1>
			<h3>Note: Only edit fields you want to be changed.</h3>
			<form action="{$_SERVER["PHP_SELF"]}" method="post">
				<p><strong>Update password: </strong><input type="password" name="password" /></p>
				<p><strong>Verify updated password: </strong><input type="password" name="password2"/></p>

				<h4>Current Profile Picture:</h4>
				<img src="getProPic.php?user=$usernm" alt="pro_pic" style="width:50%;height:200px;"/>
				<p><strong>Change profile picture: </strong><input type="file" name="profile" accept="image/*">
				<p><input type="submit" name="subBtn" value="Apply and Save changes"/></p>

				$errors
				<hr>
				<p>Want to delete your account? Note: This action is final, and all of your messages will be kept in the chat.<br/>
				<input type="submit" name="delBtn" value="Delete Account"/></p>
			</form>
EOBODY;
		echo generatePage($body, "User Settings");
	} else {
		echo "<h1> error fetching user from db</h1>";
	}

?>
