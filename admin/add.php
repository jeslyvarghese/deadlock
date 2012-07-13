<?php session_start();
if(isset($_SESSION['Admin_ID'])&&$_SESSION['val']=='reconing')
{
$myth_id = $_SESSION['Admin_ID'];
include "../cult/config.php";
$level = $_POST['level'];
$question = $_POST['question'];
$answer = $_POST['answ'];
if($_FILES['img']['tmp_name']!="")
{
$filer="tmp/tmp".rand(1,99).".jpg";
copy ($_FILES['img']['tmp_name'], $filer); 
$handle = fopen($filer, "r");
$pure = addslashes(fread($handle, filesize($filer)));
fclose($handle);
unlink($filer);
}
else
$pure = "";
$cxn = mysqli_connect("localhost",$dbuname,$dbpwd)or die("Failed to connect");
mysqli_select_db($cxn,$dbname)or die("Failed to select");
$query = "SELECT MAX(Pool),MAX(ID) FROM questions WHERE Level='$level'";
$res = mysqli_query($cxn,$query)or die(mysqli_error($cxn));
$hug = mysqli_fetch_array($res);
$hug = $hug['MAX(Pool)'];
$hug++;
$points = $level*10;
$query = "INSERT INTO questions(Level,Pool,Question,img,points,QManager_ID) VALUES('$level','$hug','$question','$pure','$points','$myth_id')" ;
mysqli_query($cxn,$query)or die(mysqli_error($cxn));
$query = "SELECT ID FROM questions WHERE Level='$level' AND Pool='$hug'";
$res = mysqli_query($cxn,$query)or die(mysqli_error($cxn));
$hug = mysqli_fetch_array($res);
$id = $hug['ID'];
$answer = crypt(crypt($answer,$id),$id);
$query = "UPDATE questions SET Answer = DES_ENCRYPT('$answer') WHERE ID='$id'";
$res = mysqli_query($cxn,$query)or die(mysqli_error($cxn));
mysqli_close($cxn);
}
else
{
	header( "Location: ../errordocs/error404.htm" );
}
?>
<a href="ans_edit.php">GO BACK!</a>
