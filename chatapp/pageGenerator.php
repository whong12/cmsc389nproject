<?php

function generatePage($body, $title) {
    $page = <<<EOPAGE
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>$title</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
            
    <body>
    	<div class ="container">
    		<div class ="jumbotron">
    			<h2>$title</h2>
        		$body
        	</div>
        </div>
    </body>

</html>
EOPAGE;

    return $page;
}
?>