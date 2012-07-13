try {
http= new ActiveXObject("Microsoft.XMLHTTP"); // Trying Internet Explorer
}
catch(e) // Failed
{
http = new XMLHttpRequest(); // Other browsers.
}
