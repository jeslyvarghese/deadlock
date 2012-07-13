<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel = "stylesheet" type="text/css" href="../css/login.css"/>
<style type="text/css">
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
var url = "login.php?referrer=login&"+(Math.random()*999);
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
var params = "email="+document.getElementsByName("email").item(0).value+"&pwd="+document.getElementsByName("pwd").item(0).value;
<?php $_SESSION['status']="login";?>
http.open("POST", url, true);
//Send the proper header information along with the request
http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
http.send(params);
}
function validate()
{
if(parseInt(result)==700)
{
$("#log_box").effect('explode',null,1000,window.location = "game.php?referrer=login.php").delay(200);
}
else if(parseInt(result)==602)
{
document.getElementById("status").innerHTML = "Wrong Password";
error();
//call wrong anime here
}
else if(parseInt(result)==601)
{
document.getElementById("status").innerHTML = "Wrong Username!";
error();
//call wrong anime here
}
else
{
document.getElementById("status").innerHTML = "Somethings wrong!";
}
}

function error()
{

$(function(){$("#log_box").effect('shake',  {distance: 10, times: 2} , 35);});}
</script>

</head>
<body>
	<div id="logDialog" class="logBoxOut">
    	<div class="logBoxIn" id="log_box">
            <form name = "logy">
            Email: <span title="Enter your email id here."> <input class="tBox" type="text" name = "email" /></span><br/>
            Password:<span title="Enter your password here."> <input class="tBox" type="password" name = "pwd" /></span><br/>
            <span title="Click to login"><input class="sButton" type="button" value="Login" onClick="logme()"/></span>
            </form>
            <div id="status" class="status">Welcome To Deadlock</div>
        </div>
    </div>
</body>
</html>
