<?php session_start();
$_SESSION['status']="functions";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style type="text/css">
#tooltip {
    padding: 5px 10px;
    background: #cad7e0;
    border: 1px solid #b2bdc3;
    opacity: 0.90;
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>deadlock [Login]</title>
<script type="text/javascript" src="../scripts/jquery.js"></script>
<script type="text/javascript" src="../scripts/jquery-ui.js"></script>
<script type="text/javascript" src="../scripts/hoverbox.js"></script>
<script type="text/javascript" >
try {
http= new ActiveXObject("Microsoft.XMLHTTP"); // Trying Internet Explorer
}
catch(e) // Failed
{
http = new XMLHttpRequest(); // Other browsers.
}

</script>
<script type="text/javascript">
$(function(){$('span').hoverbox();});
var url = "change_pwd.php?referrer=change.php&"+(Math.random()*999);
var result = "Null";

http.onreadystatechange = function() {//Call a function when the state changes.
	if(http.readyState == 4) {
		if(http.status == 200)
			{
				result= http.responseText;
				validate();
			}
	}
	else
	{
	document.getElementById("status").innerHTML = "<img src='../images/ajax-loader.gif'/> Rotating Some gears...";
	//Have the anime going on here...
	}
}
function logme()
{
var params = "old="+document.changy.old.value+"&new="+document.changy.new.value+"&con="+document.changy.con.value;
http.open("POST", url, true);
//Send the proper header information along with the request
http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
http.send(params);
}
function validate()
{
if(parseInt(result)==700)
{
window.location = "index.php";
}
else if(parseInt(result)==602)
{
document.getElementById("status").innerHTML = "Wrong Password";
//call wrong anime here
}
else if(parseInt(result)==601)
{
document.getElementById("status").innerHTML = "Passwords Don't Match!";
//call wrong anime here
}
else
{
document.getElementById("status").innerHTML = "Bad Bad Server!! It freaked out!";
}
}
</script>

</head>
<div id="log_box" height="100" width="250">
<h2><tt>Making things for your own use when not easily available can't be called 'forging'. We call it creativity!! </tt></h2>
<form name="changy">
Old Password:<span title="Enter your password here."> <input type="password" name = "old" /></span><br/>
New Password:<span title="Enter your password here."> <input type="password" name = "new" /></span><br/>
Confirm Password:<span title="Enter your password here."> <input type="password" name = "con" /></span><br/>
<span title="Click to login"><input type="button" value="Change Password!" onClick="logme()" /></span>
</form>
<div id="status">Welcome To Deadlock</div>
</div>
<body>
</body>
</html>
