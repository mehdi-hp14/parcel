// JavaScript Document
function GetXmlHttpObject()
{
  var xmlHttp=null;
  try
    {
    // Firefox, Opera 8.0+, Safari
    xmlHttp=new XMLHttpRequest();
    }
  catch (e)
    {
    // Internet Explorer
    try
      {
      xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
      }
    catch (e)
      {
      xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
      }
    }
  return xmlHttp;
}
function lang(language){
  var setlang=language;
  xmlHttp=GetXmlHttpObject()
  var url="language.php?q="+setlang;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}
function stateChanged() 
{ 
if (xmlHttp.readyState==4)
{ 
window.location.reload();
}
}


function popUp(url){
 window.open(url,"pop","width=570,height=450,toolbars=0,scrollbars=1")
}
function addbookmark(){
bookmarkurl="http://www.<?=$domain?>/"
 bookmarktitle="Welcome To Alibaba Clone"
 if (document.all)
  window.external.AddFavorite(bookmarkurl,bookmarktitle)
}
 
