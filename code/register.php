<?php #registration config page
session_start();
if(isset($_GET['referrer'])&&isset($_SESSION['status'])&&$_GET['referrer']=="register.php"&&$_SESSION['status']=="register")
{
if(!(isset($_POST['email'])&&isset($_POST['fname'])&&isset($_POST['lname'])&&isset($_POST['phn'])&&isset($_POST['college'])))
$_SESSION['stat']="FAIL";
if($_SESSION['stat']=="FAIL") die("Error");
#info
$email = strip_tags($_POST['email']);
$fname = strip_tags($_POST['fname']);
$lname = strip_tags($_POST['lname']);
$phn   = strip_tags($_POST['phn']);
$college = strip_tags($_POST['college']);
unset($_POST['email']);

#preparing space 
include "../cult/config.php";
$cxn = mysqli_connect("localhost",$dbuname,$dbpwd)or die("Failed to connect");
mysqli_select_db($cxn,$dbname)or die("Failed to select");
$query = "INSERT INTO user(email,fname,lname,college,phn) VALUES('$email','$fname','$lname','$college','$phn')";

if(mysqli_query($cxn,$query))

{
	echo "Success!";
	$res = mysqli_query($cxn,"SELECT ID FROM user WHERE email = '$email'");
	$id = mysqli_fetch_array($res);
	$p = "";
	for($i=0;$i<=12;$i++){
		$p = $p.chr(rand(48,122));}
	echo "Password:".$p."|";
		$id = $id['ID'];
	$prd = crypt(crypt($p,$id),$id);
	echo "Password Crypted:".$prd;
	$query = "INSERT INTO auth(U_ID,pwd) VALUES('$id',DES_ENCRYPT('$prd'))" ;
	if(mysqli_query($cxn,$query))
		{
		#mail function in here...'
		echo "U_ID:".$id;
		
		$query = "SELECT ID FROM auth WHERE U_ID = '$id'" ;
		$res = mysqli_query($cxn,$query)or die(mysqli_error($cxn));
		$hug  = mysqli_fetch_array($res);
		echo $hug['ID'];
		$auth_id = $hug['ID'];
		echo "Auth Id".$auth_id;
		$query = "SELECT Pool FROM questions WHERE Level=1";
		$res = mysqli_query($cxn,$query)or die(mysqli_error($cxn));
		while(($hug=mysqli_fetch_array($res)))
		$pool[] = $hug['Pool'];
		$mypool = $pool[$auth_id*rand(1,9)%(count($pool))];
		echo "MyPool".$mypool;
		$query = "SELECT ID FROM questions WHERE Level=1 AND Pool='$mypool'";
		$res = mysqli_query($cxn,$query)or die(mysqli_error($cxn));
		$hug = mysqli_fetch_array($res);
		$squid = $hug['ID'];
		echo "Squid:".$squid;
		$query = "INSERT INTO ugame_info(q_id,auth_id,attempts,score) VALUES('$squid','$auth_id',0,2000)" ;
		mysqli_query($cxn,$query)or die(mysqli_error($cxn));
		$date = date('d',mktime());
		$query = "INSERT INTO game_stat(qid,uid,date,Level) VALUES('$squid','$auth_id',$date,1)" ;
		mysqli_query($cxn,$query)or die(mysqli_error($cxn));
		echo "Password mailed to your email id";
		}
	else
		{
			echo "password maker failed!";
		}
}
else
{
echo "Faild";
}
mysqli_close($cxn);
}
else
{
header( "Location: ../errordocs/error404.htm" );
#redirect to error page
}
?>
