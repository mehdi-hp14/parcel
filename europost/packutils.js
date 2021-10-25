function trim (str) {
	var whitespace = ' \n\r\t\f';
	for (var i = 0; i < str.length; i++) {
		if (whitespace.indexOf(str.charAt(i)) === -1) {
			str = str.substring(i);
			break;
		}
	}
	for (i = str.length - 1; i >= 0; i--) {
		if (whitespace.indexOf(str.charAt(i)) === -1) {
			str = str.substring(0, i + 1);
			break;
		}
	}
	return whitespace.indexOf(str.charAt(0)) === -1 ? str : '';
}

function ChangePackages(n) {
var strpack = "";
var i = 1;
var j = 1;
var h = 20;
var w = 40;
var detect = navigator.userAgent.toLowerCase();
if ( detect.indexOf('firefox') + 1 > 0 ) {w=w-2;}
n = parseInt(n) + 1;

for (i = 1; i < n; i++)
	{
	if( i < 10 )
		{
		strpack = strpack + "<div style=\"vertical-align: top;\">Pack.  "+i+":&nbsp;&nbsp;";
		}
	else
		{
		strpack = strpack + "<div style=\"vertical-align: top;\">Pack. "+i+":&nbsp;&nbsp;";
		}

	strpack = strpack + "Weight:&nbsp;<Input type=\"text\" name=\"weight["+ i +"]\" style=\"width:50px;height:15px;\" value=\"" + ((typeof(document.frm.elements["weight["+i+"]"]) != "undefined") ? document.frm.elements["weight["+i+"]"].value : "") + "\" onchange=\"CalculateVolume(" + i + ")\" /><FONT SIZE=-2>&nbsp;kg&nbsp;&nbsp;&nbsp;&nbsp;</FONT>";
	strpack = strpack + "Length:&nbsp;<Input type=\"text\" name=\"length["+ i +"]\" style=\"width:50px;height:15px;\" value=\"" + ((typeof(document.frm.elements["length["+i+"]"]) != "undefined") ? document.frm.elements["length["+i+"]"].value : "") + "\" onchange=\"CalculateVolume(" + i + ")\" /><FONT SIZE=-2>&nbsp;cm&nbsp;&nbsp;&nbsp;&nbsp;</FONT>";
	strpack = strpack + "Width:&nbsp;<Input type=\"text\" name=\"width["+ i +"]\" style=\"width:50px;height:15px;\" value=\"" + ((typeof(document.frm.elements["width["+i+"]"]) != "undefined") ? document.frm.elements["width["+i+"]"].value : "") + "\" onchange=\"CalculateVolume(" + i + ")\" /><FONT SIZE=-2>&nbsp;cm&nbsp;&nbsp;&nbsp;&nbsp;</FONT>";
	strpack = strpack + "Height:&nbsp;<Input type=\"text\" name=\"height["+ i +"]\" style=\"width:50px;height:15px;\" value=\"" + ((typeof(document.frm.elements["height["+i+"]"]) != "undefined") ? document.frm.elements["height["+i+"]"].value : "") + "\" onchange=\"CalculateVolume(" + i + ")\" /><FONT SIZE=-2>&nbsp;cm&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</FONT>";
	strpack = strpack + "Volume Metric:&nbsp;<Input type=\"text\" name=\"volume["+ i +"]\" style=\"color:#000000;background-color:#F0F0F0;width:50px;height:15px;\" disabled value=\"" + ((typeof(document.frm.elements["volume["+i+"]"]) != "undefined") ? document.frm.elements["volume["+i+"]"].value : "") + "\" /><FONT SIZE=-2>&nbsp;kg&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</FONT>";

	if (i == 1 && n > 2) 
		{
		strpack = strpack + "&nbsp;&nbsp;<IMG SRC=\"img/copydown.gif\" alt=\"Copy to all packages\" title=\"Copy to all packages\" style=\"cursor: pointer\" onclick=\"copydown(document.frm);\" />";
		}
	strpack = strpack + "</div>";
	}
document.getElementById('divPackages').innerHTML = strpack;

for (i = 1; i < n; i++)
	{
	document.frm.elements["volume["+i+"]"].disabled = true;
	}
}

function CalculateVolume(i)
{
	if( document.frm.trans[2].checked )
		{
		document.frm.elements["volume["+i+"]"].value = document.frm.elements["weight["+i+"]"].value;
		}
	else
		{
	  if ( ((document.frm.elements["length["+i+"]"].value * 1) > 0) && ((document.frm.elements["width["+i+"]"].value * 1) > 0) && ((document.frm.elements["height["+i+"]"].value * 1) > 0) )
	  	{
		  if (document.frm.elements["length["+i+"]"].value != parseInt(document.frm.elements["length["+i+"]"].value)) {document.frm.elements["length["+i+"]"].value = Math.ceil (document.frm.elements["length["+i+"]"].value);}
		  if (document.frm.elements["width["+i+"]"].value != parseInt(document.frm.elements["width["+i+"]"].value)) {document.frm.elements["width["+i+"]"].value = Math.ceil (document.frm.elements["width["+i+"]"].value);}
	  	if (document.frm.elements["height["+i+"]"].value != parseInt(document.frm.elements["height["+i+"]"].value)) {document.frm.elements["height["+i+"]"].value = Math.ceil (document.frm.elements["height["+i+"]"].value);}
	  	document.frm.elements["volume["+i+"]"].value = Math.ceil ((document.frm.elements["length["+i+"]"].value * document.frm.elements["width["+i+"]"].value * document.frm.elements["height["+i+"]"].value) / 4000);
	  	}
	  }
}

function countrycheck(theElm, sd) {
  var country = trim(theElm.options[theElm.selectedIndex].text);
  
  if( country == "United Kingdom" || country.substring(0, 4) == "UK -" )
  	{
	  if( sd == 1 )
	  	document.getElementById('id_source_postcode').innerHTML = "&nbsp;&nbsp;&nbsp;Post Code:&nbsp;<input name=\"id_postcodeS\" type=\"text\" SIZE=8 MAXLENGTH=8 style=\"vertical-align: middle; height: 18px;\" value=\"\" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name=\"id_cityS\" type=\"hidden\" value=\"\" />";
	  else
	  	document.getElementById('id_dest_postcode').innerHTML =   "&nbsp;&nbsp;&nbsp;Post Code:&nbsp;<input name=\"id_postcodeD\" type=\"text\" SIZE=8 MAXLENGTH=8 style=\"vertical-align: middle; height: 18px;\" value=\"\" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name=\"id_cityD\" type=\"hidden\" value=\"\" />";
  	}
  else
  	{
	  if( sd == 1 )
	  	document.getElementById('id_source_postcode').innerHTML = "&nbsp;&nbsp;&nbsp;Post Code:&nbsp;<input name=\"id_postcodeS\" type=\"text\" SIZE=8 MAXLENGTH=8 style=\"vertical-align: middle; height: 18px;\" value=\"\" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color=\"#FF0000\"><u>OR</u></font></u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Village/Town/City:&nbsp;<input name=\"id_cityS\" type=\"text\" SIZE=20 style=\"vertical-align: middle; height: 18px;\" value=\"\" />";
	  else
	  	document.getElementById('id_dest_postcode').innerHTML =   "&nbsp;&nbsp;&nbsp;Post Code:&nbsp;<input name=\"id_postcodeD\" type=\"text\" SIZE=8 MAXLENGTH=8 style=\"vertical-align: middle; height: 18px;\" value=\"\" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color=\"#FF0000\"><u>OR</u></font></u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Village/Town/City:&nbsp;<input name=\"id_cityD\" type=\"text\" SIZE=20 style=\"vertical-align: middle; height: 18px;\" value=\"\" />";
  	}
  

  if (country == "Nigeria" || country == "Ghana" || country == "Ivory Coast") 
		{
  	alert ("Security Check\n------------------\n\nDue to the high number of fraudulent incidents involving "+country+", you will need to supply \na land line telephone number for the collection address so we may contact you to verify your details.\n\nSorry for any inconvenience this may cause.");
  	}
}

function copydown(theForm) {
var count = theForm.elements.length;
var numpackages = 0;
for (i=0; i<count; i++) 
  {
  var element = theForm.elements[i];
  var poo = element.name; 
  if (poo.indexOf('weight') + 1 > 0) {numpackages = numpackages +1;} 
  } 
for (i=2; i < numpackages+1; i++) 
  {
  theForm.elements["weight["+i+"]"].value = theForm.elements["weight["+1+"]"].value;
  theForm.elements["length["+i+"]"].value = theForm.elements["length["+1+"]"].value;
  theForm.elements["width["+i+"]"].value = theForm.elements["width["+1+"]"].value;
  theForm.elements["height["+i+"]"].value = theForm.elements["height["+1+"]"].value;
  theForm.elements["volume["+i+"]"].value = theForm.elements["volume["+1+"]"].value;
  }
}

function fncmIsEnglish(sFieldValue)
{
	var iCount = 0;
	var iCode = 0;
  var bRetValue = true;
  var iFieldWidth = sFieldValue.length;

  for (iCount = 0; iCount < iFieldWidth; iCount++)
    {
    iCode = sFieldValue.charCodeAt (iCount);
    if (iCode > 126)
	    {
  	  bRetValue = false;
      break;
	    }
    }

	return bRetValue;
} // end of fncmIsSingleByte


function validateForm (theForm) {
var strValues = trim(theForm.id_source.options[theForm.id_source.selectedIndex].text);
if (strValues == "" || strValues == "(Select a Country)" || strValues == "--------------------------------" ) {alert('Please select the source country.'); return false;}

var strValued = trim(theForm.id_dest.options[theForm.id_dest.selectedIndex].text);
if (strValued == "" || strValued == "(Select a Country)" || strValued == "--------------------------------" ) {alert('Please select the destination country.'); return false;}

if( theForm.id_postcodeS.value == "" && theForm.id_cityS.value == "" )
	{
  if( strValues == "United Kingdom" || strValues.substring(0, 4) == "UK -" )
		{alert('Please enter the Postcode of collection address.'); return false;}
	else
		{alert('Please enter the Postcode OR City of collection address.'); return false;}
	}

if( theForm.id_postcodeS.value != "" && theForm.id_cityS.value != "" )
	{
  if( strValues == "United Kingdom" || strValues.substring(0, 4) == "UK -" )
		{alert('Please enter only the Postcode of collection address.'); return false;}
	else
		{alert('Please enter ONLY the Postcode OR City of collection address, not both of them.'); return false;}
	}

if( strValues == "United Kingdom" || strValues.substring(0, 4) == "UK -" )
	{
	if( theForm.id_postcodeS.value == "" && theForm.id_cityS.value != "" )
		{alert('Please enter only the Postcode of collection address.'); return false;}
	}

if( theForm.id_postcodeS.value.indexOf('*') != -1 || theForm.id_cityS.value.indexOf('*') != -1 )
	{
	alert('Psot Code or City cannot conain * character.'); return false;
	}

if( theForm.id_postcodeD.value == "" && theForm.id_cityD.value == "" )
	{
  if( strValued == "United Kingdom" || strValued.substring(0, 4) == "UK -" )
		{alert('Please enter the Postcode of delivery address.'); return false;}
	else
		{alert('Please enter the Postcode OR City of delivery address.'); return false;}
	}

if( theForm.id_postcodeD.value != "" && theForm.id_cityD.value != "" )
	{
  if( strValued == "United Kingdom" || strValued.substring(0, 4) == "UK -" )
		{alert('Please enter only the Postcode of delivery address.'); return false;}
	else
		{alert('Please enter ONLY the Postcode OR City of delivery address, not both of them.'); return false;}
	}

if( strValued == "United Kingdom" || strValued.substring(0, 4) == "UK -" )
	{
	if( theForm.id_postcodeD.value == "" && theForm.id_cityD.value != "" )
		{alert('Please enter only the Postcode of delivery address.'); return false;}
	}

if( theForm.id_postcodeD.value.indexOf('*') != -1 || theForm.id_cityD.value.indexOf('*') != -1 )
	{
	alert('Psot Code or City cannot conain * character.'); return false;
	}

engCheck = true;
if( theForm.id_postcodeS.value != "" )
	{
  engCheck = fncmIsEnglish( theForm.id_postcodeS.value )
  }
if( engCheck && theForm.id_cityS.value != "" )
	{
  engCheck = fncmIsEnglish( theForm.id_cityS.value )
  }
if( engCheck && theForm.id_postcodeD.value != "" )
	{
  engCheck = fncmIsEnglish( theForm.id_postcodeD.value )
  }
if( engCheck && theForm.id_cityD.value != "" )
	{
  engCheck = fncmIsEnglish( theForm.id_cityD.value )
  }

if( !engCheck )
{
	alert('Data should be entered in English only.'); return false;
}

if( theForm.trans[1].checked || theForm.trans[2].checked )
	{
	if( theForm.content.value == ""  )
		{alert('Please enter the Package Contents field.'); return false;}
	if( !theForm.prohibited.checked )
		{alert('You must agree to the Prohibited & Restricted Items List in order to continue.'); return false;}
	}
		
if( !((theForm.val.value * 1) > 0) )
	{alert('Please enter the Value field.'); return false;}

if( !((theForm.insurance.value * 1) >= 0) )
	{alert('Please select an insurance cover.'); return false;}
	
var count = theForm.elements.length;
var numpackages = 0;
for (i=0; i<count; i++) 
  {
  var element = theForm.elements[i];
  var poo = element.name; 
  if (poo.indexOf('weight') + 1 > 0) {numpackages = numpackages +1;} 
  } 
for (i=1; i < numpackages+1; i++) 
  {
  if (!((theForm.elements["weight["+i+"]"].value * 1) > 0)) {alert('Please enter the weight for package '+ i); return false;}
  if (!((theForm.elements["length["+i+"]"].value * 1) > 0)) {alert('Please enter the length of package ' + i); return false;}
  if (!((theForm.elements["width["+i+"]"].value * 1) > 0)) {alert('Please enter the width of package ' + i); return false;}
  if (!((theForm.elements["height["+i+"]"].value * 1) > 0)) {alert('Please enter the height of package ' + i); return false;}
  if (theForm.elements["length["+i+"]"].value != parseInt(theForm.elements["length["+i+"]"].value)) {theForm.elements["length["+i+"]"].value = Math.ceil (theForm.elements["length["+i+"]"].value);}
  if (theForm.elements["width["+i+"]"].value != parseInt(theForm.elements["width["+i+"]"].value)) {theForm.elements["width["+i+"]"].value = Math.ceil (theForm.elements["width["+i+"]"].value);}
  if (theForm.elements["height["+i+"]"].value != parseInt(theForm.elements["height["+i+"]"].value)) {theForm.elements["height["+i+"]"].value = Math.ceil (theForm.elements["height["+i+"]"].value);}
  }
  
  if (strValued == "Turkey") {
    alert ("Please note: The maximum allowable value of any consignment sent to Turkey is £300.\n\nIf you declare a higher value, your goods will be returned by customs at your cost.");
  }
  if (strValued == "Russian Federation") {
    alert ("Please note: The maximum allowable value of any consignment sent to Russian Federation is £220.\n\nIf you declare a higher value, your goods will be returned by customs at your cost.");
  }
  
	ua = new String(navigator.userAgent);
	if (ua.match(/IE/g)) 
	{
		for (i=1; i<theForm.elements.length; i++) 
			{
			if (theForm.elements[i].type == 'submit') 
				{
				theForm.elements[i].disabled = true;
				}
			}
	}

}