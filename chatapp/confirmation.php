<!DOCTYPE HTML>
	<head>
		<meta charset = "UTF-8" />
		<title> Confirmation </title>
	</head>
	<body>
		<h1> User succesfully added with following information </h1>
		<?php
			$SESSION_START();
			$body =<<<heredoc
			Username: $_SESSION['username'];
			Password: $_SESSION['password'];
heredoc;
		?>
		<a href="login.php"> Return to Login Page </a>
	</body>
</HTML>