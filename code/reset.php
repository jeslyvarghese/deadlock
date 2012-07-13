<?php #registration config page
session_start();
if(isset($_GET['referrer'])&&isset($_SESSION['status'])&&$_GET['referrer']=="forgot.php"&&$_SESSION['status']=="reset")
{
if(!(isset($_POST['email'])))
die("ERROR");
#info
$email = strip_tags($_POST['email']);
unset($_POST['email']);
unset($_SESSION['status']);
include "../cult/config.php";
$cxn = mysqli_connect("localhost",$dbuname,$dbpwd)or die("Failed to connect");
mysqli_select_db($cxn,$dbname)or die("Failed to select");
if($res=mysqli_query($cxn,"SELECT ID FROM user WHERE email = '$email'"))
{	if(mysqli_num_rows($res)<=0)
		die("Error this email is not found in our list");
		
	$hug = mysqli_fetch_array($res);
	$id = $hug['ID'];
	$smid = $id;
	$res = mysqli_query($cxn,"SELECT ID FROM auth WHERE U_ID='$id'");
	$hug = mysqli_fetch_array($res);
	$id = $hug['ID'];
		echo "Password change for user id".$id; 
	$p = "";
	for($i=0;$i<=12;$i++){
		$p = $p.chr(rand(48,122));}
	echo "Password:".$p."|";
		$id = $id['ID'];
	$prd = crypt(crypt($p,$smid),$smid);
	echo "Crypted password".$prd;
	$query = "UPDATE auth SET pwd = DES_ENCRYPT('$prd') WHERE U_ID = '$smid'";
	$res = mysqli_query($cxn,$query)or die(mysqli_error($cxn));
	echo $res;
	{
	#email password function here
	echo "Resetted password has been mailed to you..";
	}
}
}
else
{
	header( "Location: ../errordocs/error404.htm" );
#redirect to error pages here
}