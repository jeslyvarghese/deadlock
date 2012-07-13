setInterval("getinfo()",1000);
//setInterval("givequestion()",5000);
var url = "functions.php?"+Math.random()*99;
var type= null;
var question,image,score,attempts,level,tplayers,tlplayers,name,points;
var result = 800;
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
function getinfo()
{
url = "fetchgameinfo.php?"+Math.random()*99;
type = "info";
info_http.open("POST", url, true);
//Send the proper header information along with the request
info_http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
info_http.send(null);
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
url = "render_ans.php?"+Math.random()*999;
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
url = "val_ans.php?"+Math.random()*9999;
a_http.open("POST", url, true);
//Send the proper header information along with the request
a_http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
a_http.send(param);
}