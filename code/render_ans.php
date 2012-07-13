<?php
#renders question
session_start();
if(isset($_GET['referrer'])&&isset($_SESSION['status'])&&$_GET['referrer']=="game"&&$_SESSION['status']=="play")
{	
header("Content-Type: text/xml");
$id = $_SESSION['user_id'];
if(isset($id))
{
include "../cult/config.php";
$cxn = mysqli_connect("localhost",$dbuname,$dbpwd)or die("Failed to connect");
mysqli_select_db($cxn,$dbname)or die("Failed to select");
$query = "SELECT q_id FROM ugame_info WHERE auth_id='$id'";
$res = mysqli_query($cxn,$query)or die(mysqli_error($cxn));
$squid = mysqli_fetch_assoc($res);
$squid = $squid['q_id'];
$_SESSION['q'] = $squid;
$query = "SELECT Question FROM questions WHERE ID='$squid'";
$res = mysqli_query($cxn,$query)or die(mysqli_error($cxn));
$hug = mysqli_fetch_assoc($res);
$hug = $hug['Question'];
$query = "SELECT img FROM questions WHERE ID='$squid'";
$res = mysqli_query($cxn,$query)or die(mysqli_error($cxn));
$ar =  mysqli_fetch_array($res);
mysqli_close($cxn);
$mug= base64_encode($ar['img']);
if($mug=="")
$mug="null";
echo '<?xml version="1.0" encoding="UTF-8"?><qpaper><question>'.$hug.'</question><image>'.$mug.'</image></qpaper>';
}
else
{
#fuck.. how on earth did u get here????
}
}
else
{
header( "Location: ../errordocs/error404.htm" );
#error pages
}
?>
