<?php

function reportHelper($name_array) {
	$body = "";
	$body .= '<table class="table table-bordered">';
	foreach ($name_array as $name) {
		$body .= '<tr><td><input class="btn btn-primary" type="submit" value='.$name.' name="report"></td></tr>';
	}
	$body >= '</table>';
	return $body;
}

function reportReview($array) {
	$name = $array['name'];
	$checkbox = $array['checkbox'];
	$comment = $array['comment'];
	$body = <<< EOBODY
	<table class="table table-bordered">
		<tr>
			<td><strong>Name</td>
			<td>$name</td>
		</tr>
		<tr>
			<td><strong>Checkbox</td>
			<td>$checkbox</td>
		</tr>
		<tr>
			<td><strong>Comments</td>
			<td>$comment</td>
		</tr>
		<tr>
			<td><strong>Confirm Ban</td>
			<td><input class="btn btn-danger" type="submit" value="confirm" name="confirm"></td>
		</tr>
	</table>
EOBODY;
	$body .= '<input type="hidden" name="banName" value='.$name.'>';
	return $body;
}

?>	