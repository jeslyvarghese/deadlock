<?php
session_start();
if(isset($_GET['referrer'])&&isset($_SESSION['status'])&&$_GET['referrer']=="game"&&$_SESSION['status']=="play")
{
header("Content-Type: text/xml");
$u_id = $_SESSION['user_id'];
$squid = $_SESSION['q'];
include "../cult/config.php";
$cxn = mysqli_connect("localhost",$dbuname,$dbpwd)or die("Failed to connect");
mysqli_select_db($cxn,$dbname)or die("Failed to select");
$query = "SELECT U_ID FROM auth WHERE ID='$u_id'";
$res = mysqli_query($cxn,$query)or die(mysqli_error($cxn));
$hug = mysqli_fetch_array($res);
$user_id = $hug['U_ID'];
$query = "SELECT COUNT(*) FROM user";
$res = mysqli_query($cxn,$query)or die(mysqli_error($cxn));
$hug = mysqli_fetch_array($res);
$tplayers = $hug['COUNT(*)'];
$query = "SELECT fname FROM user WHERE ID='$user_id'";
$res = mysqli_query($cxn,$query)or die(mysqli_error($cxn));
$hug = mysqli_fetch_array($res);
$user_name = $hug['fname'];
$query = "SELECT attempts,score FROM ugame_info WHERE auth_id='$u_id'";
$res = mysqli_query($cxn,$query)or die(mysqli_error($cxn));
$hug = mysqli_fetch_array($res);
$attempts = $hug['attempts'];
$score = $hug['score'];
$query = "SELECT Level,Pool,points FROM questions WHERE ID='$squid'";
$res = mysqli_query($cxn,$query)or die(mysqli_error($cxn));
$hug = mysqli_fetch_array($res);
$level = $hug['Level'];
$Pool = $hug['Pool'];
$points = $hug['points'];
$query = "SELECT COUNT(*) FROM game_stat WHERE Level='$level'";
$res = mysqli_query($cxn,$query)or die(mysqli_error($cxn));
$hug = mysqli_fetch_array($res);
$tlplayers = $hug['COUNT(*)'];
for($i=1;$i<=$level;$i++)
{
$query = "SELECT COUNT(*) FROM game_stat WHERE Level='$i'";
$res = mysqli_query($cxn,$query)or die(mysqli_error($cxn));
$hug = mysqli_fetch_array($res);
$pllist[] = $hug['COUNT(*)'];
}
mysqli_close($cxn);

$xml = '<?xml version="1.0" encoding="UTF-8"?><info><name>'.$user_name.'</name><totalp>'.$tplayers.'</totalp><attempts>'.$attempts.'</attempts><score>'.$score.'</score><level>'.$level.'</level><pool>'.$Pool.'</pool><points>'.$points.'</points><totallp>'.$tlplayers.'</totallp>';
$i=1;
foreach($pllist as $players)
{
$xml= $xml.'<lev'.$i.'>'.$players.'</lev'.$i.'>';
$i++;
}
$xml = $xml.'</info>';
echo $xml;
}
else
{
	header( "Location: ../errordocs/error404.htm" );
#redirect to error page
}

?>
