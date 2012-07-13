<?php
session_start();
$user_name = strip_tags($_POST['uname']);
$password =  strip_tags($_POST['password']);
$_SESSION['val'] = 'reconing'
if(isset($user_name)&&isset($password))
	{
			include_once("functions.php");
			$password = crypt(crypt($password,$user_name),$user_name);
			$cxn = create_sql_connection();
			$query = "SELECT Admin_ID FROM knightsofwar WHERE User_Name='$user_name' AND Password = '$password'";
			$result = mysqli_query($cxn,$query);
			$result = mysqli_fetch_array($result);
			if(mysqli_no_rows($result)<1)
			{
				die("Error wrong password/username try again!");
			}
			$result['Admin_ID'];
			$_SESSION['Admin_ID'] = $id;
			mysqli_close()
			echo "You have sucessfully logged in. Since you are in backend we are lazy to provide you with any cool redirections. Click here to proceed..";
	}
else
	{
		header( "Location: ../errordocs/error404.htm" );
	}
?>