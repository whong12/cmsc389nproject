<?php

function reportHelper($name_array) {
	$body = "";
	$body .= '<table class="table table-bordered">';
	foreach ($name_array as $name) {
		$body .= '<tr><td><input class="btn btn-primary" type="submit" value='.$name.' name="report"></td></tr>';
	}
	$body .= '</table>';
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

function reportForm($name) {
	$body = <<< EOBODY
	<strong>User to Report: $name
	<div class="form-inline">
		<div class="form-group">
			<label>Reason for the report: </label>
			<div class="radio">
				<label><input type="radio" value="Offensive Langauge" name="checkbox" required>Offensive Langauge</label>
			</div>
			<div class="radio">
				<label><input type="radio" value="Spamming Chatroom" name="checkbox">Spamming Chatroom</label>
			</div>
			<div class="radio disabled">
				<label><input type="radio" value="Offensive Username" name="checkbox">Offensive Username</label>
			</div>
			<div class="radio disabled">
				<label><input type="radio" value="Other" name="checkbox">Other</label>
			</div>
		</div>
	</div>
	<label>Additional Comments: </label>
	<div class="form-inline">
		<div class="form-group">
			<textarea rows="5" cols="50" id="comment" name="comment" maxlength="500" required></textarea>
		</div>
	</div>
	<div class="form-inline">
		<div class="form-group">
			<input class='btn btn-primary' type="submit"value="Submit" name="confirm">
		</div>
	</div>
EOBODY;
	$body .= '<input type="hidden" name="banName" value='.$name.'>';
	return $body;
}

?>	