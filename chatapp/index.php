<?php
require_once "dbLogin.php"; 
require_once("support.php");

#login page.
$loginwindow = "";
$loginwindow .= <<<EOLW
<div class="loginwindow" name="login">
	<form class="login_form" method="post" action="index.php">
		Username: <input type="text" name="username" />
		Password: <input type="password" name="password" />
		<input class="submit" type="submit" value="Login" name="Login" /></div>
	</form>
</div>
EOLW;

#once logged in, load last 20 messages.
$current_user = "<p>Logged in as: ".$_COOKIE['user']."</p><br>";
$db_connection = new mysqli($host, $user, $password, $database);
if ($db_connection->connect_error) {
	die($db_connection->connect_error);
}



#display chat window
$chatwindow = "";
$chatwindow .= <<<EOCW
<div class="chatwindow" name="chatwindow">
	<div id="chatbox">
EOCW;

#chat log here
$num_messages = 30;
$query = "select `messageid` as id, `content`, `timestamp`,`sender`,`target` 
			from messages order by id desc limit ".$num_messages.";";
$result = $db_connection->query($query);
if (!$result) {
	die("Insertion failed: " . $db_connection->error);
}

$chatlog = "";
while ($row=mysqli_fetch_row($result)){
	$chatlog = "[".$row[2]."] ".$row[3].": ".$row[1]."<br>".$chatlog;
	#echo implode(" ", $row)."<br>";
}
$chatwindow .= $chatlog;
#current logged in users here
#<div id="loggedin"></div>

$chatwindow .= <<<EOCW
	</div>
    <form name="message" action="index.php" method="post">
        <input name="usermsg" type="text" id="usermsg" size="250"/>
        <input name="submitmsg" type="submit" onclick="processmessage();" id="submitmsg" value="Send" />
    </form>
</div>
EOCW;

$body = $current_user.$chatwindow;
$page = generatePage($body);
echo $page;
echo "<script> 
var input = document.getElementById('usermsg');
input.focus();
input.select();

var objDiv = document.getElementById('chatbox');
objDiv.scrollTop = objDiv.scrollHeight;
</script>";
?>
