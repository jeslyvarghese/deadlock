<?php session_start();
$_SESSION['stat'] = "";
$_SESSION['status']="register"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
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
var url = "functions.php?referrer=register.php&"+Math.random()*99;
var result = 800;
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
var params = "email="+document.getElementsByName("email").item(0).value+"&info=email";
http.open("POST", url, true);
//Send the proper header information along with the request
http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
http.send(params);
}
function validate()
{
if(parseInt(result)==888)
{
document.getElementById("status").innerHTML = "Email accepted";
}
else if(parseInt(result)==800)
{
document.getElementById("status").innerHTML = "Email Already Exist!";
//call wrong anime here
}
else if(parseInt(result)==801)
{
document.getElementById("status").innerHTML = "Not a valid email id!";
//call wrong anime here
}
else
{
alert(result);
document.getElementById("status").innerHTML = "Somethings wrong!";
}

}
function v()
{
var x = document.reg;
if(parseInt(result)==888)
{

return true;
}
else
return false;
if(x.email.value==""||x.fname.value==""||x.lname.value==""||x.college.value==""||x.phn.value=="")
return false;
else
true;
}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>deadlock [Sign Up]</title>
</head>
<body>
<form name = "reg" action="register.php?referrer=register.php" method="post" onSubmit="return v();">
Email: <input type="text" name = "email" value="email"onBlur="logme()"/>
Name: <input type="text" name = "fname" value="First" "/> <input name = "lname" type="text" value="Last" />
College: <Input name = "college" type="text" />
Phone: <input name = "phn" type="text" value="000" />
<input type="submit" onClick="v()"/>
</form>
<div id="status"></div>
</body>
</html>
