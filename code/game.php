<?php session_start();
//if (isset($_GET['referrer'])&&isset($_SESSION['status'])&&$_SESSION['status']=="play"){ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!--<link href='http://fonts.googleapis.com/css?family=MedievalSharp' rel='stylesheet' type='text/css'>-->
<link rel = "stylesheet" type="text/css" href="../css/game.css"/>
<link rel = "stylesheet" type="text/css" href="../css/index.css"/>
<link rel = "stylesheet" type="text/css" href="../css/login.css"/>
<link rel = "stylesheet" type="text/css" href="../css/reveal.css"/>
<link  href="http://fonts.googleapis.com/css?family=Cabin+Sketch:bold" rel="stylesheet" type="text/css" >
<script type="text/javascript" src="../scripts/jquery.js"></script>
<script type="text/javascript" src="../scripts/jquery-ui.js"></script>
<script src="../scripts/jquery.reveal.js" type="text/javascript"></script>
<script type="text/javascript" src="../scripts/hoverbox.js"></script>
<script type="text/javascript">
function getinfo()
{
url = "fetchgameinfo.php?referrer=game&"+Math.random()*99;
type = "info";
info_http.open("POST", url, true);
//Send the proper header information along with the request
info_http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
info_http.send(null);
}
$(document).ready(function(){
	var paneOut = 0;
	$("#sideLabel").click(function(){
		if(paneOut == 0) {
			$("#sidePane").animate({right:'0'}, 300);
			paneOut = 1;
		} else {
			$("#sidePane").animate({right:'-200'}, 300);
			paneOut = 0;
		}
	});
	getinfo();
});


$(function(){$("#ans_bar").hide();});
var prev = "";
$(function(){$(".pane").mouseover(function(){$(this).animate({marginLeft:'10px'},100);if(pane[this.id]!=undefined)this.innerHTML="<align='left'>"+pane[this.id]+" on it!</b></align>";});});
$(function(){$(".pane").mouseleave(function(){$(this).animate({marginLeft:'0px'},50);this.innerHTML=this.id;});});
//$(function(){$(".pane").blur(function(){$(this).animate({marginLeft:'0px'},25);this.innerHTML=this.id;});});
</script>
<script type="text/javascript" >
try {
info_http= new ActiveXObject("Microsoft.XMLHTTP"); // Trying Internet Explorer
}
catch(e) // Failed
{
info_http = new XMLHttpRequest(); // Other browsers.
}
try {
q_http= new ActiveXObject("Microsoft.XMLHTTP"); // Trying Internet Explorer
}
catch(e) // Failed
{
q_http = new XMLHttpRequest(); // Other browsers.
}
try {
a_http= new ActiveXObject("Microsoft.XMLHTTP"); // Trying Internet Explorer
}
catch(e) // Failed
{
a_http = new XMLHttpRequest(); // Other browsers.
}
</script>
<script type="text/javascript">
//setInterval("getinfo()",1000);
//setInterval("givequestion()",5000);
var url = 'functions.php?referrer="game"'+Math.random()*99;
var type= null;
var question,image,score,attempts,level,tplayers,tlplayers,name,points;
var result = 800;
var pane =new Array();
info_http.onreadystatechange = function() {//Call a function when the state changes.
	if(info_http.readyState == 4) {
		if(info_http.status == 200)
			{
				name =  info_http.responseXML.getElementsByTagName("name")[0].childNodes[0].nodeValue;
				level = info_http.responseXML.getElementsByTagName("level")[0].childNodes[0].nodeValue;
				score = info_http.responseXML.getElementsByTagName("score")[0].childNodes[0].nodeValue;
				attempts = info_http.responseXML.getElementsByTagName("attempts")[0].childNodes[0].nodeValue;
				points = info_http.responseXML.getElementsByTagName("points")[0].childNodes[0].nodeValue;
				tplayers = info_http.responseXML.getElementsByTagName("totalp")[0].childNodes[0].nodeValue;
				tlplayers = info_http.responseXML.getElementsByTagName("totallp")[0].childNodes[0].nodeValue;
				pool = info_http.responseXML.getElementsByTagName("pool")[0].childNodes[0].nodeValue;
				for(var x=1;x<=level;x++)
				{
				pane[x]= info_http.responseXML.getElementsByTagName("lev"+x)[0].childNodes[0].nodeValue;
				}
				info_render();
			
			}
	}
	else
	{
		//Have the anime going on here...
	}
}
q_http.onreadystatechange = function() {//Call a function when the state changes.
	if(q_http.readyState == 4) {
		if(q_http.status == 200)
			{
				
				question =  q_http.responseXML.getElementsByTagName("question")[0].childNodes[0].nodeValue;
				image =  q_http.responseXML.getElementsByTagName("image")[0].childNodes[0].nodeValue;
				render();
				
			}
	}
	else
	{
	//document.getElementById("status").innerHTML = "<img src='../images/ajax-loader.gif'/> ";
	//Have the anime going on here...
	}
}
a_http.onreadystatechange = function() {//Call a function when the state changes.
	if(a_http.readyState == 4) {
		if(a_http.status == 200)
			{
				{
				result= a_http.responseText;
				render_ans();
				}
			}
	}
	else
	{
	document.getElementById("question").innerHTML = "<img src='../images/ajax-loader.gif'/> ";
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
function render_ans()
{
if(parseInt(result)==666)
{
document.getElementById("status").innerHTML = "Oh Freak !!!! you done it!!!";
}
else if(parseInt(result)==555)
{
document.getElementById("status").innerHTML = "Loosa !!!! you messed up!!!";
}
else
{
document.getElementById("status").innerHTML = "Damn! !!!! Server went nuts!!!";
}
getinfo();
givequestion();
}

function givequestion()
{
url = "render_ans.php?referrer=game&"+Math.random()*999;
type = "question";
q_http.open("POST", url, true);
//Send the proper header information along with the request
q_http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
q_http.send(null);
}
function render()
{
//document.getElementById("status").innerHTML = "Enter your answer!"
document.getElementById("question").innerHTML = question;
if(image!="null")
document.getElementById("image").innerHTML= "<img id = 'img' src='data:image/png;base64,"+image+"'/>";
}
function groove()
{
$("#ans_bar").fadeOut("slow");
param = "&ans="+document.getElementsByName("ans").item(0).value;
url = "val_ans.php?referrer=game&"+Math.random()*9999;
a_http.open("POST", url, true);
//Send the proper header information along with the request
a_http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
a_http.send(param);
}
</script>
<script type="text/javascript">
getinfo();
givequestion();
$(function(){$("#status").click(function(){$("#ans_bar").fadeIn("slow");});});
</script>
</head>
<body>
<div class="header">
	<table width="100%" align="center">
    	<tr>
        <td>Welcome, <a id = "pname" class="inf"></a> <!---Player Name goes in here --></td>
        <td>Score: <a id = "score" class="inf"></a> <!---Score goes here--></td>
        <td>Attempts for this question: <a id = "attempts" class="inf"></a> <!---Attempts done goes here--></td>
        <td>Level you are playing: <a id = "level" class="inf"></a><!--Level info goes here--></td>
        <td><a href="thanks.php?referrer=game.php">Log out!</a></td>
        </tr>
	</table>
</div><!--Info bar/header ends here-->
<div class="splashContainer">
	<div class="splash">
        <div id="arena">
    	    <div id="question"></div><!--Question will be rendered here-->
	        <div id="image"></div><!---Images will be rendered here-->
        </div> <!--Arena ends here-->
        <a data-reveal-id="logDialog"><div id="status" class="showStatus">Enter your answer</div><!--Status will be in here--></a>
        <div id="logDialog" class="logBoxOut">
            <div class="logBoxIn" id="log_box">
                And the answer is:<div id="answer"><input type="text" name="ans"/><input type="button" value="Submit!" onClick="groove()"/></div><!--Answer area goes here-->
	        </div>
        </div>
        
        <div class="sidePane" id="sidePane">
        	<div class="sideLabel" id="sideLabel">Global Statistics</div>
            <div id="game_bar" class="sidePaneInner">
                <div>Total players</div><div><a id="tplayers" class="gbar"></a><!--Info about total palyers go here --></div>
                <div>This level</div><div><a id="lpalyers" class="gbar"></a><!--Info about --></div>
                <div>Points for this level</div><div><a id="points" class="gbar"></a><!--Points for the level--> </div>
            </div>
		</div>
        
        <div id="slider">
            <?php
            for($i=50;$i>=1;$i--)
            {?>
            <div id="<?php echo $i;?>" class="pane">
            <?php echo $i;?></div><?php } ?>
        </div>
        
	</div>
</div>
<div class="footer">Website developed & maintained by <a href="http://www.redatom2.0fees.net" target="_blank"><b>redatom studios</b></a></div>
</body>
</html>
<?php// } else
//{
	//header( "Location: ../errordocs/session_expired.htm" );
#error page redirection function here
//}?>