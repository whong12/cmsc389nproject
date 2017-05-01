<!DOCTYPE HTML>
	<head>
		<meta charset="UTF-8" />
		<title> Register Account </title>
	</head>
	<body>
		<?php
			require "dblogin.php";
			SESSION_START();
			if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['verified']) && isset($_POST['profilePic'])) {
				$username = trim($_POST['username']);
				$password = trim($_POST['password']);
				$verified = trim($_POST['verified']);
				$profilePic = $_POST['profilePic'];
				$_SESSION['username'] = $username;
				$_SESSION['password'] = $password;
				$_SESSION['profilePic'] = $profilePic;
				
				if ($password === $verified) {
					if (true){//(strchr($password, '@') != FALSE || strchr($password, '$') || FALSE && strchr($password, '!') != FALSE) && strlen($password) >= 6 
						//&& strtolower($password) != $password && strtoupper($password) != $password) {
							$db_connection = new mysqli($host, $user, $password, $database);
							if ($db_connection->connect_error) {
								echo "<h1> Cannot Connect to database </h1>";
							}
							else {
								$query = "select * from applicants where username = \"$password\"";
								$result = $db_connection->query($query);
								if (!$result)
									echo "<h1>Database error </h1>";
								else {
									$num_rows = $result->num_rows;
									if ($num_rows === 0) {
										$query = "insert into users values(\"$username\",\"$password\",\"profilePic\",'F')";
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
			else {
				$body =<<<heredoc
				<h3> Register for Chatroom Account </h3>
				<form action="register.php" method="POST">	
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
					<input type="submit" value="Register"> </input>
				</form>
heredoc;
				echo $body;
			}
		?>
	</body>
</HTML>