<?php session_start();
$_SESSION['']
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
</head>
<body>
<form action="add.php" method="post" enctype="multipart/form-data">

Select Level: <select name="level">
<option value="">----</option>
<?php for($i=1;$i<=50;$i++){echo "<option value".$i.">".$i."</option>";}?>
</select>
<br/>

Question:<textarea id ="question" name = "question"  cols="15" rows="5"></textarea>
<br/>
Image:<input type="file" name="img"/>
<br/>
Answer:<input type="text" name="answ"/>
<br />
<input type="submit" value="Submit"/>
<input type="reset" value="clear"/>
</form>
</body>
</html>