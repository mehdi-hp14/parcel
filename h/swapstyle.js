/***********************************************************************************************
                             Script to swap between stylesheets
  Written by Mark Wilton-Jones, 05/12/2002. v2.2.1 updated 14/03/2006 for dynamic stylesheets
************************************************************************************************

Please see http://www.howtocreate.co.uk/jslibs/ for details and a demo of this script
Please see http://www.howtocreate.co.uk/jslibs/termsOfUse.html for terms of use

To set up the page in the first place:

	Inbetween the <head> tags, put:

		<script src="PATH TO SCRIPT/swapstyle.js" type="text/javascript" language="javascript1.2"></script>

	Also between the head tags, put your stylesheets, best done as external links, but you can use
	<style ...> tags as well.

		Stylesheets cannot be switched if they have no title attribute and will be used at all times:

			<link rel="stylesheet" type="text/css" href="all.css">

		Stylesheets will be on by default if they have a title attribute and their rel attribute is set to 'stylesheet'.
		Most browsers will only allow one of these to be defined (or several sharing the same title):

			<link rel="stylesheet" type="text/css" href="default.css" title="Default">

		Stylesheets will be off by default if they have a title attribute and their rel attribute is set to 'alternate stylesheet':

			<link rel="alternate stylesheet" type="text/css" href="contrast.css" title="High Contrast">
			<link rel="alternate stylesheet" type="text/css" href="bigFont.css" title="Big Font">

To swap between stylesheets:

	changeStyle();                           //switches off all stylesheets that have title attributes
	changeStyle('Default');                  //switches off all stylesheets that have title attributes that do not match 'Default'
	changeStyle('High Contrast');            //switches off all stylesheets that have title attributes that do not match 'High Contrast'
	changeStyle('Big Font');                 //switches off all stylesheets that have title attributes that do not match 'Big Font'
	changeStyle('High Contrast','Big Font'); //switches off all stylesheets that have title attributes that do not match 'High Contrast' or 'Big Font'

	Opera 7+ and Mozilla also allow users to switch between stylesheets using the view menu (only one at a time though ...)

To make the script remember the user's choice of stylesheets, for example to use on more than one page or if they reload
- includes stylesheets chosen using the view menu in Gecko - it will only attempt to store a cookie if they actually
changed something:

	In these examples, I call the cookie used to store the choice 'styleTestStore'. You could use any name you like.

	To remember only until the browser window is closed:

		<body onload="useStyleAgain('styleTestStore');" onunload="rememberStyle('styleTestStore');">

	To remember for 10 days (for example):

		<body onload="useStyleAgain('styleTestStore');" onunload="rememberStyle('styleTestStore',10);">

Note that some browsers (most notably Opera) do not fire the onunload event when the page is
reloaded, and will only fire it when the user clicks a link or submits a form. If you need the
style preference to be stored even when reloading, you should call rememberStyle immediately
after you call changeStyle.

If you are going to provide users with a mechanism to change stylesheets, you may want to check
if the browser will allow you to change stylesheets first. Use:

	if( document.styleSheets || ( window.opera && document.childNodes ) || ( window.ScriptEngine && ScriptEngine().indexOf('InScript') + 1 && document.createElement ) ) {
		document.write('Something that allows them to choose stylesheets');
	}

It's not perfect, because it will also appear in ICEbrowser, which makes a mess when it tries to
change to an alternate stylesheet. If you want, you can use
	if( ( document.styleSheets || ( window.opera && document.childNodes ) || ( window.ScriptEngine && ScriptEngine().indexOf('InScript') + 1 && document.createElement ) ) && !navigator.__ice_version ) {
but you should then update that if ICE is updated to make it work properly.
________________________________________________________________________________________________*/

function getAllSheets() {
	if( !window.ScriptEngine && navigator.__ice_version ) { return document.styleSheets; }
	if( document.getElementsByTagName ) { var Lt = document.getElementsByTagName('link'), St = document.getElementsByTagName('style');
	} else if( document.styleSheets && document.all ) { var Lt = document.all.tags('LINK'), St = document.all.tags('STYLE');
	} else { return []; } for( var x = 0, os = []; Lt[x]; x++ ) {
		var rel = Lt[x].rel ? Lt[x].rel : Lt[x].getAttribute ? Lt[x].getAttribute('rel') : '';
		if( typeof( rel ) == 'string' && rel.toLowerCase().indexOf('style') + 1 ) { os[os.length] = Lt[x]; }
	} for( var x = 0; St[x]; x++ ) { os[os.length] = St[x]; } return os;
}

function changeStyle() {
	
	window.userHasChosen = window.MWJss;
	
	for( var x = 0, ss = getAllSheets(); ss[x]; x++ ) {
		//if( ss[x].getAttribute("rel").indexOf("alt") != -1) { ss[x].disabled = true; }
		
		if(ss[x].title)
		{
			ss[x].disabled = true;
		}
		for( var y = 0; y < arguments.length; y++ ) { if( ss[x].title == arguments[y] ) { ss[x].disabled = false; } }
	}
	
}

function rememberStyle( cookieName, cookieLife ) {
	
	for( var viewUsed = false, ss = getAllSheets(), x = 0; window.MWJss && MWJss[x] && ss[x]; x++ ) { if( ss[x].disabled != MWJss[x] ) { viewUsed = true; break; } }
	if( !window.userHasChosen && !viewUsed ) { return; }
	for( var x = 0, outLine = '', doneYet = []; ss[x]; x++ ) {
		if( ss[x].title && ss[x].disabled == false && !doneYet[ss[x].title] ) 
		{
			doneYet[ss[x].title] = true; outLine += ( outLine ? ' MWJ ' : '' ) + escape( ss[x].title ); 
		} 
	}
	//setCookie(cookieName, outLine, cookieLife);
	if( ss.length > 0 ) {
		//alert(escape( cookieName ) + '=' + escape( outLine ) + ( cookieLife ? ';expires=' + new Date( ( new Date() ).getTime() + ( cookieLife * 86400000 ) ).toGMTString() : '' ) + ';path=/'); 
		document.cookie = escape( cookieName ) + '=' + escape( outLine ) + ( cookieLife ? ';expires=' + new Date( ( new Date() ).getTime() + ( cookieLife * 86400000 ) ).toGMTString() : '' ) + ';path=/'; 
	}
}

function useStyleAgain( cookieName ) {
	for( var x = 0; x < document.cookie.split( "; " ).length; x++ ) {
		var oneCookie = document.cookie.split( "; " )[x].split( "=" );
		if( oneCookie[0] == escape( cookieName ) ) {
			var styleStrings = unescape( oneCookie[1] ).split( " MWJ " );
			for( var y = 0, funcStr = ''; styleStrings[y]; y++ ) { funcStr += ( y ? ',' : '' ) + 'unescape( styleStrings[' + y + '] )'; }
			eval( 'changeStyle(' + funcStr + ');' ); break;
	} } window.MWJss = []; for( var ss = getAllSheets(), x = 0; ss[x]; x++ ) { MWJss[x] = ss[x].disabled; }
}

function getCookie(c_name)
{
if (document.cookie.length>0)
{ 
c_start=document.cookie.indexOf(c_name + "=")
if (c_start!=-1)
{ 
c_start=c_start + c_name.length+1 
c_end=document.cookie.indexOf(";",c_start)
if (c_end==-1) c_end=document.cookie.length
return unescape(document.cookie.substring(c_start,c_end))
} 
}
return ""
}

function setCookie(c_name,value,expiredays)
{
var exdate=new Date();
exdate.setDate(exdate.getDate()+expiredays);
document.cookie=c_name+ "=" +escape(value)+((expiredays==null) ? "" : "; expires="+exdate.toGMTString());
}

function loadStyleSheet()
{
//  useStyleAgain('styleTestStore');
  
  for( var ss = getAllSheets(), x = 0; ss[x]; x++ ) { 
  	if((ss[x].title) && (ss[x].disabled == false) && (ss[x].title == "hicontrast"))
  	{		
  		hideTextSizeButtons();
  	}
  	if((ss[x].title) && (ss[x].disabled == false) && (ss[x].title == "standardtextsize"))
  	{		
  		hoverTextSize("aEnlargeTextStandard");
  		unhoverTextSize("aEnlargeTextMedium");
  		unhoverTextSize("aEnlargeTextLarge");
  		
  	}
  	if((ss[x].title) && (ss[x].disabled == false) && (ss[x].title == "mediumtextsize"))
  	{		
  		hoverTextSize("aEnlargeTextMedium");
  		unhoverTextSize("aEnlargeTextStandard");
  		unhoverTextSize("aEnlargeTextLarge");
  		
  	}
  	if((ss[x].title) && (ss[x].disabled == false) && (ss[x].title == "largetextsize"))
  	{		
  		hoverTextSize("aEnlargeTextLarge");
  		unhoverTextSize("aEnlargeTextMedium");
  		unhoverTextSize("aEnlargeTextStandard");
  		
  	}
  }
}

function hoverTextSize(anchorId)
{
	document.getElementById(anchorId).style.backgroundPosition = "left bottom";
}

function unhoverTextSize(anchorId)
{
	document.getElementById(anchorId).style.backgroundPosition = "left top";
}

function storeStyleSheet()
{
  rememberStyle('styleTestStore',1);
}

function addStyleSheetListeners()
{
		if (window.addEventListener)
	    {
	        window.addEventListener("load", loadStyleSheet, false);
			window.addEventListener("unload", storeStyleSheet, false);
			
	    }
	    else if (window.attachEvent)
	    {
	        window.attachEvent("onload", loadStyleSheet);
			window.attachEvent("onunload", storeStyleSheet);
			
	    }
	    else
	    {
	        window.onload = loadStyleSheet;
			window.onunload = storeStyleSheet;
	    }
}

var contrast = false;

function changeTextSizeStyle()
{

	changeStyle(arguments);
	document.getElementById("liEnlargeTextMedium").style.display = "block";
	document.getElementById("liEnlargeTextLarge").style.display = "block";

}

function displayTextSizeButtons(anchor)
{
	document.getElementById("liEnlargeTextMedium").style.display = "block";
	document.getElementById("liEnlargeTextLarge").style.display = "block";
	unhoverTextSize("aEnlargeTextLarge");
  	unhoverTextSize("aEnlargeTextMedium");
  	unhoverTextSize("aEnlargeTextStandard");
	anchor.style.backgroundPosition = "left bottom";
	anchor.blur();
}

function hideTextSizeButtons()
{
	document.getElementById("liEnlargeTextMedium").style.display = "none";
	document.getElementById("liEnlargeTextLarge").style.display = "none";
}

function toggleContrast(contrasttitle)
{
		contrast = !contrast;
		window.userHasChosen = window.MWJss;
		document.getElementById("liEnlargeTextMedium").style.display = "none";
		document.getElementById("liEnlargeTextLarge").style.display = "none";
		
		for( var x = 0, ss = getAllSheets(); ss[x]; x++ ) {
			for( var y = 0; y < arguments.length; y++ ) 
			{
				if(ss[x].title) 
				{
					ss[x].disabled = true;
					if( ss[x].title == arguments[y] ) { 
						ss[x].disabled = false; 
					}
				}
				 
			}
		} 
		
	
}

addStyleSheetListeners();
useStyleAgain('styleTestStore');