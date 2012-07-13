<?php #validates answer
session_start();
if(isset($_GET['referrer'])&&isset($_SESSION['status'])&&$_GET['referrer']=="game"&&$_SESSION['status']=="play")
{	
if(isset($_SESSION['user_id'])&&isset($_SESSION['q'])&&isset($_POST['ans']))
{
$uid = $_SESSION['user_id'];
$squid = $_SESSION['q'];
$awww = crypt(crypt(strtolower(str_replace(" ","",$_POST['ans'])),$squid),$squid);
include "../cult/config.php";
$cxn = mysqli_connect("localhost",$dbuname,$dbpwd)or die("Failed to connect");
mysqli_select_db($cxn,$dbname)or die("Failed to select");
$query = "SELECT DES_DECRYPT(Answer) FROM questions WHERE ID='$squid'";
$res = mysqli_query($cxn,$query)or die(mysqli_error($cxn));
$hug = mysqli_fetch_assoc($res);
$hug = $hug['DES_DECRYPT(Answer)'];
if($awww==$hug)
{
#fuck.. freak have done it!!!!
$query = "SELECT points,Level FROM questions WHERE ID='$squid'";
$res = mysqli_query($cxn,$query)or die(mysqli_error($cxn));
$hug = mysqli_fetch_array($res);
$points = $hug['points'];
$level = $hug['Level'];
$level =$level +1;
$query = "SELECT Count(Pool) FROM questions WHERE Level='$level'";
$res = mysqli_query($cxn,$query)or die(mysqli_error($cxn));
$hug= mysqli_fetch_array($res);
$pool = $hug['Count(Pool)'];
$query = "SELECT attempts,score FROM ugame_info WHERE auth_id='$uid'";
$res = mysqli_query($cxn,$query)or die(mysqli_error($cxn));
$hug = mysqli_fetch_assoc($res);
$attempts = $hug['attempts'];
$score = $hug['score'];
$score =  $score +$points;
$mypool = $uid*rand(1,9)%$pool+1;
$query = "SELECT ID FROM questions WHERE Level='$level' AND Pool='$mypool'";
$res = mysqli_query($cxn,$query)or die(mysqli_error($cxn));
$hug = mysqli_fetch_array($res);
$squid = $hug['ID'];
$query = "UPDATE  ugame_info SET attempts=0,score='$score',q_id='$squid' WHERE auth_id= '$uid'";
mysqli_query($cxn,$query)or die(mysqli_error($cxn));
mysqli_close($cxn);
$date = date('d',mktime());
$query = "UPDATE  game_stat SET qid='$squid',date='$date',Level='$level' WHERE uid= '$uid'";
mysqli_query($cxn,$query)or die(mysqli_error($cxn));
mysqli_close($cxn);
echo 666;
}
else
{

$query = "SELECT Points,Level FROM questions WHERE ID='$squid'";
$res = mysqli_query($cxn,$query)or die(mysqli_error($cxn));
$hug = mysqli_fetch_assoc($res);
$points = $hug['Points'];
$level = $hug['Level'];
$query = "SELECT attempts,score FROM ugame_info WHERE auth_id='$uid'";
$res = mysqli_query($cxn,$query)or die(mysqli_error($cxn));
$hug = mysqli_fetch_assoc($res);
$attempts = $hug['attempts'];
$score = $hug['score'];
$attempts =$attempts+1;
$score =$score-(int)($attempts/21);
$query = "UPDATE ugame_info SET attempts='$attempts',score='$score' WHERE auth_id= '$uid'";
mysqli_query($cxn,$query)or die(mysqli_error($cxn));
mysqli_close($cxn);
echo 555;
}

}
else
{
#fucker u r not supposed to do dis... stings
}
}
else
{
header( "Location: ../errordocs/error404.htm" );
#redirect to error page
}
?>