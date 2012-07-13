<?php
session_start();
Header("Content-type:image");
include "../cult/config.php";
$cxn = mysqli_connect("localhost",$dbuname,$dbpwd)or die("Failed to connect");
mysqli_select_db($cxn,$dbname)or die("Failed to select");
$squid = $_SESSION['q'];
$query = "SELECT img FROM questions WHERE ID='$squid'";
$res = mysqli_query($cxn,$query)or die(mysqli_error($cxn));
$ar =  mysqli_fetch_array($res);
mysqli_close($cxn);
echo $ar['img'];
?>