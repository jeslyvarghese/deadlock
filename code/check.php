<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript" src="../scripts/jquery.js"></script>
<script type="text/javascript" >
try {
http= new ActiveXObject("Microsoft.XMLHTTP"); // Trying Internet Explorer
}
catch(e) // Failed
{
http = new XMLHttpRequest(); // Other browsers.
}
</script>
<script type="text/javascript">
$(function(){getinfo();});

var type= null;
var score,attempts,level,tplayers,tlplayers,name,points;
var result = 800;
http.onreadystatechange = function() {//Call a function when the state changes.
	if(http.readyState == 4) {
		if(http.status == 200)
			{
				if(type=="info")
				{
				name =  http.responseXML.getElementsByTagName("name")[0].childNodes[0].nodeValue;
				level = http.responseXML.getElementsByTagName("level")[0].childNodes[0].nodeValue;
				score = http.responseXML.getElementsByTagName("score")[0].childNodes[0].nodeValue;
				attempts = http.responseXML.getElementsByTagName("attempts")[0].childNodes[0].nodeValue;
				points = http.responseXML.getElementsByTagName("points")[0].childNodes[0].nodeValue;
				tplayers = http.responseXML.getElementsByTagName("totalp")[0].childNodes[0].nodeValue;
				tlplayers = http.responseXML.getElementsByTagName("totallp")[0].childNodes[0].nodeValue;
				pool = http.responseXML.getElementsByTagName("pool")[0].childNodes[0].nodeValue;
				info_render();
				}
				else if(type=="leaders")
				{
				}
				else
				{
				result= http.responseText;
				render();
				}
			}
	}
	else
	{
	document.getElementById("status").innerHTML = "<img src='../images/ajax-loader.gif'/> Rotating Some gears...";
	//Have the anime going on here...
	}
}
function info_render()
{
document.getElementById("pname").innerHTML = name;
document.getElementById("score").innerHTML = score;
document.getElementById("level").innerHTML = level;
document.getElementById("lpalyers").innerHTML = tlplayers;
document.getElementById("tplayers").innerHTML = tplayers;
document.getElementById("attempts").innerHTML = attempts;
document.getElementById("points").innerHTML = points;
}
function getinfo()
{
url = "fetchgameinfo.php?"+Math.random()*99;
type = "info";
http.open("POST", url, true);
//Send the proper header information along with the request
http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
http.send(null);
}
</script>

</head>
<body>

<div id = "info_bar">
Welcome, <div id = "pname"></div> <!---Player Name goes in here -->
Score: <div id = "score"></div> <!---Score goes here-->
Attempts for this question: <div id = "attempts"></div> <!---Attempts done goes here-->
Level you are playing: <div id = "level"></div><!--Level info goes here-->
</div><!--Info bar ends here-->

<div id="arena">
Q<div id="question"></div><!--Question will be rendered here-->
<div id="status">Enter your answer</div><!--Status will be in here-->
And what i think the answer is:<div id="answer"><input type="text" name="ans"/></div><!--Answer area goes here-->
</div> <!--Arena ends here-->

<div id="game_bar">
Total players playing the game:<div id="tplayers"></div><!--Info about total palyers go here -->
Players playing this level:<div id="lpalyers"></div><!--Info about -->
Points for this level: <div id="points"></div><!--Points for the level--> 
</div>

And the leaders are:<div id="leaderboard"></div> <!--Leader board goes here..-->
</body>
</html>