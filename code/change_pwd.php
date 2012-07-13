<?php  #change password
	session_start();
	if(isset($_GET['referrer'])&&isset($_SESSION['status'])&&$_GET['referrer']=="change.php"&&$_SESSION['status']=="functions")
{
	include "../cult/config.php";
	$auth_id = $_SESSION['user_id'];
	$oldpwd = $_POST['old'];
	$newpwd = $_POST['new'];
	$conpwd = $_POST['con'];
	if(isset($oldpwd)&&isset($newpwd)&&isset($conpwd))
	{
	if($newpwd==$conpwd)
	{
	$cxn = mysqli_connect("localhost",$dbuname,$dbpwd)or die("Failed to connect");
	mysqli_select_db($cxn,$dbname)or die("Failed to select");
	$query = "SELECT DES_DECRYPT(pwd),U_ID FROM auth WHERE ID='$auth_id'";
	$res = mysqli_query($cxn,$query)or die(mysqli_error($cxn));
	$mystic = mysqli_fetch_array($res);
	if(crypt(crypt($oldpwd,$mystic['U_ID']),$mystic['U_ID'])==$mystic['DES_DECRYPT(pwd)'])
	{
		$prd = crypt(crypt($newpwd,$mystic['U_ID']),$mystic['U_ID']);
		$query = "UPDATE  auth SET pwd = DES_ENCRYPT('$prd') WHERE ID='$auth_id'";
		mysqli_query($cxn,$query)or die(mysqli_error($cxn));
		mysqli_close($cxn);
		echo 700;
		#pwd changed
	}
	else
	{
	echo 602;
	#error wrong user name
	mysqli_close($cxn);
	}}
	else
	 {
	 echo 601;
	#error user name does not match
	}
	}
	else
	{
	#freak ... how u got here??
	header( "Location: ../errordocs/session_expired.htm" );
	}
}
else
{
	header( "Location: ../errordocs/error404.htm" );
#redirect to error page
}
	?>