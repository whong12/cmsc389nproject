<?php

function generatePage($body, $title="Chat App") {
    $page = <<<EOPAGE
<!doctype html>
<html lang="en">
<html>
    <head> 
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" href="chatstyle.css">
        <title>$title</title>	
		<script src="chat.js?1515"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </head>
            
    <body>
            $body
    </body>
</html>
EOPAGE;

    return $page;
}
?>