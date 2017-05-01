function processmessage() {
	var clientmsg = $("#usermsg").val();
	var user = getCookie("user");
	var msg = user + " : " + clientmsg + "<br>";
	//alert(user+ " : " + clientmsg);
	//document.getElementById('chatbox').innerHTML  += user + " : " + clientmsg + "<br>";
	$.ajax({
		type: "POST",
		url: 'processmessage.php',
		data:{action:clientmsg},
		success:function(html) {
			//alert(html);
		}
	});
 }

function getCookie(name) {
	var value = "; " + document.cookie;
	var parts = value.split("; " + name + "=");
	if (parts.length == 2) return parts.pop().split(";").shift();
}