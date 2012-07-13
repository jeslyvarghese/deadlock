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
			$query = "INSERT INTO knightsofwar(User_Name,Password) VALUES('$user_name','$password')";
			mysqli_query($cxn,$query);
			mysqli_close()
			echo "The account has been created with specified user name and password";
	}
else
	{
		header( "Location: ../errordocs/error404.htm" );
	}
?>