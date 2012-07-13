<?php
session_start();
if(isset($_GET['referrer'])&&isset($_SESSION['status'])&&$_GET['referrer']=="register.php"&&$_SESSION['status']=="register")
{	
if(isset($_POST['info']))
{
if($_POST['info']=="email"&&isset($_POST['email']))
	email_info();
}
else
{
echo 666;
}
}
else
{#redirect to error page
}?>
<?php
function create_sql_connection()
	{
		include_once(../cult/config.php);
		$cxn = mysqli_connect("localhost",$dbuname,$dbpwd)or die("Failed to connect");
		mysqli_select_db($cxn,$dbname)or die("Failed to select");
		return $cxn
	}
function email_info()
{
	$email = $_POST['email'];
	if(strchr($email,"@")!=false&&strchr($email,".")!=false)
	{
	include "../cult/config.php";
	$cxn = mysqli_connect("localhost",$dbuname,$dbpwd)or die("Failed to connect");
	mysqli_select_db($cxn,$dbname)or die("Failed to select");
	$query = "SELECT * FROM user WHERE email='$email'";
	 $res = mysqli_query($cxn,$query)or die(mysqli_error($cxn));
	if(mysqli_num_rows($res)!=0)
	{
		echo 800;
		$_SESSION['stat'] = "FAIL";
	}
	else
	{
		echo 888;
		$_SESSION['stat'] = "SUCC";
	}
mysqli_close($cxn);
}
else
{
echo 801;
$_SESSION['stat'] = "FAIL";
}
}
?>