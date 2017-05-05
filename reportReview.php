<?php

require_once("pageGenerator.php");
require_once ("dblogin.php");
require_once("helper.php");

if(isset($_POST['report'])) {
	$name = $_POST['report'];
	$msg = '';
	$msg .= '<div class="form"><form action="reportProcess.php" method="post">';
	$msg .= reportForm($name);
	$msg .= '</form></div>';
	$msg .= "<br><button class='btn btn-primary' id='back'>Back</button>
			<script> var btn = document.getElementById('back');
				btn.addEventListener('click', function() {
				document.location.href = 'reportForm.php';});</script>";
	$page = generatePage($msg, "Provide Reasons");
	echo $page;

}
else {
	echo "failed";
}
?>