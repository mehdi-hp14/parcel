// JavaScript Document

function detect()
{
	if(screen.width<=1024||screen.height<=768)
	{
		var linkTag = document.createElement("link");
		linkTag.setAttribute("type", "text/css");
		linkTag.setAttribute("href", "/assets/OLT/style/browser.css");
		linkTag.setAttribute("rel", "stylesheet");
		linkTag.setAttribute("media", "screen");
		
		document.getElementsByTagName("head")[0].appendChild(linkTag);
	}
}

function addEvent(obj, evType, fn)
{ 
	if (obj.addEventListener)
	{ 
		obj.addEventListener(evType, fn, false); 
		return true; 
	} 
	else if (obj.attachEvent)
	{ 
		var r = obj.attachEvent("on"+evType, fn); 
		return r; 
	} 
	else 
	{ 
		return false; 
	} 
}
addEvent(window, 'load', detect);