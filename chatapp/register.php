<!DOCTYPE HTML>
	<head>
		<meta charset="UTF-8" />
		<title> Register Account </title>
	</head>
	<body>
		<?php
			include 'dblogin.php';
			if (isset($_POST['register'])) {
				$username = trim($_POST['username']);
				$password2 = trim($_POST['password']);
				$verified = trim($_POST['verified']);
				
				if ($password2 === $verified) {
					if ((strchr($password2, "@") != FALSE || strchr($password2, "$") != FALSE || strchr($password2, "!") != FALSE) && preg_match("/[0-9]/", $password2) 
					&& strlen($password2) >= 6 && strtolower($password2) != $password2 && strtoupper($password2) != $password2) {
							$db_connection = new mysqli($host, $user, $password, $database);
							if ($db_connection->connect_error) {
								echo "<h1> Cannot Connect to database </h1>";
							}
							else {
								$query = "select * from users where name = \"$username\"";
								$result = $db_connection->query($query);
								if (!$result)
									echo "<h1>$db_connection->error </h1>";
								else {
									$num_rows = $result->num_rows;
									if ($num_rows === 0) {
										$hashed = password_hash($password2, PASSWORD_DEFAULT);
										$profilePic = addslashes(file_get_contents($_FILES['profilePic']['tmp_name']));
										$query = "insert into users values(\"$username\",\"$hashed\",\"$profilePic\",'F')";
										$result = $db_connection->query($query);
										if (!$result) {
											echo "<h1> Cannot add user into database at this time </h1>";
										}
										else {
											header('Location: confirmation.php');
										}
									}
									else {
										echo "<h1> User already exists with specified username </h1>";
									}
								}
							}
							$db_connection->close();
						}
					else {
						echo "<h1> Invalid password. Please check requirements. </h1>";
					}
				}
				else {
					echo "<h1> Passwords do not match </h1> ";
				}
			}
			
				$body =<<<heredoc
				<h3> Register for Chatroom Account </h3>
				<form action="register.php" method="POST" enctype="multipart/form-data">	
					Username: <input type="text" name="username"> </input> <br />
					Note: Passwords must meet the following requirements:
					<ol> 
						<li> 6 characters or longer </li>
						<li> Contain at least one number </li>
						<li> Contain at least one capital letter </li>
						<li> At least one of the following characters: @ $ ! </li>
					</ol>
					Password: <input type="password" name="password" required> </input> <br />
					Verify Password <input type="password" id="verified" name="verified" required> </input> <br />
					Profile Picture <input type="file" id="profilePic" name="profilePic" accept="image/*" required> </input> <br />
					<input type="submit" name="register" value="Register"> </input>
				</form>
heredoc;
				echo $body;
			
		?>
	</body>
</HTML>