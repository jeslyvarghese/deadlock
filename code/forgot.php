<?php session_start();
$_SESSION['status']="reset";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script>
</script>
</head>
<div id="email_box" height="100" width="250">
<div id="comment">
<h2><tt>Memory Loss!! Often it happens. Too much of herbs!!
No worries.. we can help.. </tt></h2>
</div>
<form name = "forgot" method = "post" action = "reset.php?referrer=forgot.php">
Enter your e-mail id here: <span title="Enter your email id here."> <input type="text" name = "email" value="email"/></span><br/>
<input type="submit"/>
</form>
</div>
</body>
</head>