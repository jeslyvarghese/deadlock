<?php #login validation
  session_start();
 if(isset($_GET['referrer'])&&isset($_SESSION['status'])&&$_GET['referrer']=="login"&&$_SESSION['status']=="login")
{ $email = strip_tags($_POST['email']);
  $pwd = $_POST['pwd'];
  
  include "../cult/config.php";
  $cxn = mysqli_connect("localhost",$dbuname,$dbpwd);
  mysqli_select_db($cxn,$dbname);
  $query = "SELECT ID FROM user WHERE email = '$email'";
  $res = mysqli_query($cxn,$query) or die(mysqli_error($cxn));
  if(mysqli_num_rows($res)==0)
  {
  echo 601;
  }
  else
  {
  $ar = mysqli_fetch_array($res);
  $id = $ar['ID'];
  $query = "SELECT  DES_DECRYPT(pwd) FROM auth WHERE U_ID = '$id'";
  $res = mysqli_query($cxn,$query)or die(mysqli_error($cxn));
  $mystic = mysqli_fetch_assoc($res);
  if((crypt(crypt($pwd,$id),$id))==$mystic['DES_DECRYPT(pwd)'])
	{
	$query = "SELECT ID  FROM auth WHERE U_ID = '$id'";
	$res = mysqli_query($cxn,$query)or die(mysqli_error($cxn));
	$id = mysqli_fetch_assoc($res);
	$_SESSION['user_id'] = $id['ID'];
	$_SESSION['status']="play";
	echo 700;
	}
 else
	echo 602;
}
mysqli_close($cxn);
}
else
{
header( "Location: ../errordocs/error404.htm" );
#redirect to error page
}
?>
  