<!DOCTYPE HTML>
	<head>
		<meta charset="UTF-8" />
		<title> Chatroom Login </title>
	</head>
	<body>
		<?php 
			include 'dblogin.php';
			if (isset($_POST['username']) && isset($_POST['password'])) {
				$username = trim($_POST['username']);
				$password2 = trim($_POST['password']);
				$db_connection = new mysqli($host, $user, $password, $database);
				if ($db_connection->connect_error) {
					echo "<h1> Error connecting to database </h1>";
				}
				else {
					$query = "select * from users where name=\"$username\"";
					$result = $db_connection->query($query);
					if (!$result) {
						echo "<h1> Error </h1>";
					}
					else {
						if ($result->num_rows === 0) {
							echo "<h1> No User Found with Specified Username </h1>";
						}
						else {
							$row = $result->fetch_array(MYSQLI_ASSOC);
							$hashed = $row['password'];
							$banned = $row['banned'];
							if (password_verify($password2,$hashed)) {
								if ($banned == 'F') {
									setcookie('user', $username, 0, "/", 'localhost', false, false);
									header('Location: index.php');
								}
								else {
									echo "<h1> User has been banned by admin. </h1>";
								}
							}
							else {
								echo "<h1> Invalid Password </h1>";
							}
						}
					}
				}
			}
			
				$body=<<<heredoc
				<h3> Login to Chatroom </h3> 
				<form action="login.php" method="POST">	
					Username: <input type="text" name="username"> </input> <br /> <br />
					Password: <input type="password" name="password"> </input> <br /> <br />
					<a href="register.php"> Don't have an account?</a> &nbsp &nbsp &nbsp <input type="submit" value="Login"> </input>
				</form>
heredoc;
				echo $body;
		?>
	</body>
</HTML>
