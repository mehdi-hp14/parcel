use HTML::Entities;
use Mail::Sendmail 0.75; # doesn't work with v. 0.74!

###################### HEADER ##############################
sub myheader($)
{
	my ($string, @c) = @_;

	if( $#c > 0)
		{
		print $cgiCkie->header(-cookie=>\@c);
		}
	else
		{
		print $form->header;
		}

#	print "<!--$debugstr-->";
	if( $string eq "home" or $string eq "book" )
		{
		print qq|<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<meta name="description" content="Uk, Europue and Worldwide next day and same day pallet/parcel delivery and multi-courier service, including DHL, DPD, Night Frieght, Aramex." />
		<meta name="keywords" content="parcel delivery service, uk courier delivery,next day delivery,pallet delivery,uk europe delivery,import services,free parcel collection,tracking,hermes,carrier,dhl it now,dhl parcel" />
		|;
		}
	else
		{
		print qq|<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		|;
		}
	print qq|
	<link rel="SHORTCUT ICON" href="http://www.europostexpress.com/favicon.ico" />
	|;
	if( $string eq 'member' || $string eq 'vieworders' )
		{
		print qq|<meta http-equiv="refresh" content="300">|;
		}
		
	if( $string eq "home" or $string eq "book" )
		{
		print qq~
		<title>UK &amp; International Parcel Delivery &amp; DHL DPD Courier Services Discounted Parcel Pallet Delivery</title>
		~;
		}
	else
		{
		print qq~
		<title>Europost Express Official Website</title>
		~;
		}

	&memutils if( $string eq "members" || $string eq "editmember" );
	if( $isAdmin )
		{
		if( $string eq "members" )
			{
			&memberscheck("username,pass1,pass2,fname,lname,tel1,tel2,tel3,mob1,mob2,mob3,fax1,fax2,fax3,add,postcode,country,city,email");
			}
		elsif( $string eq "editmember" )
			{
			&memberscheck("username,pass1,pass2,fname,lname,tel1,tel2,tel3,mob1,mob2,mob3,fax1,fax2,fax3,add,postcode,country,city,email,credit,ceclv,cechv,cecmhv,cecpe,ahcminkg,ahccharge,ahcperkg,fas,aircol,epxcb");
			}
		}
	else
		{
		&memberscheck("username,pass1,pass2,fname,lname,tel1,tel2,tel3,mob1,mob2,mob3,fax1,fax2,fax3,add,postcode,country,city,email") if( $string eq "members" || $string eq "editmember" );
		}
	&packutils if( $string eq 'book' && $book eq "1" );
	&orderutils if( $string eq 'entry' && ($entry eq "1" || $edit eq "1" ));
	&outils if( $string eq 'viewent' );
	&eutils if( $string eq "book" && ($book eq "3" || $book eq "4") );
	&putils if( $string eq "price" );
	&butils if( $string eq 'viewbook' );
	&memberscheck("id_contact,tel1,tel2,tel3,id_add1,id_town,id_county,id_postcode,email,fromtime,totime") if( $string eq "book" && $book eq "3" );
	&memberscheck("id_dest_contact,dest_tel1,dest_tel2,dest_tel3,id_dest_add1,id_dest_city,id_dest_state,id_dest_postcode, _dest_email") if( $string eq "book" && $book eq "4" );
	&memberscheck("id_contact,tel1,tel2,tel3,id_add1,id_county,_email,id_dest_contact,dest_tel1,dest_tel2,dest_tel3,id_dest_add1,id_dest_state,_dest_email,fromtime,totime") if( $string eq "orders" && $edit eq "1" );
	&settingcheck if( $string eq "settings");

	&memviewutils if( $isAdmin && $string eq "viewprofile" );

	print qq|<link href="css/main.css" rel="stylesheet" type="text/css" />
	<link href="css/link.css" rel="stylesheet" type="text/css" />
	<link href="css/forms.css" rel="stylesheet" type="text/css" />
	|;

	print qq|<link href="css/dhl.css" rel="stylesheet" type="text/css" />\n<link href="css/dpd.css" rel="stylesheet" type="text/css" />	| if( $string eq "trackit" );
	
	print qq|
	</head>
	<body>
	|;

	&popuputils if( $string eq 'entry' && $entry eq "1" );

}
##################### FOOTER ######################
sub footer($)
{
my $string = shift;
print qq|
<!--<div class="ha3 rt">Copyright <a href="$script" class="noneunderline">
	Europost Express Ltd.</a> © 2008-2009. All rights reserved</div>-->
	
<div><p><center>|;

	if( $string eq "book" )
		{
		print qq|<a href="$script?cf=terms" class="noneunderline">Terms &amp; Conditions</a>&nbsp;-&nbsp;<a href="$script?cf=prohibit" class="noneunderline">Prohibited / Restricted Items</a>&nbsp;-&nbsp;<a href="$script?cf=packaging" class="noneunderline">Packaging Guidelines</a><br>|;
		}
	else
		{
		print qq|<a href="$script?cf=terms" class="noneunderline">Terms &amp; Conditions</a>&nbsp;-&nbsp;|;
		}

print qq|Copyright <a href="$script" class="noneunderline"> Europost Express Ltd.</a> © 2008-2009. All rights reserved</center></p></div>
</body>
</html>
|;
}


sub topmenu($)
{
	my $string = shift;
	my $spacer;
	my $submenu;
	
	print qq|<div class="ha1">
	<a href="$script"><img src="img/content/slogan_01.gif" alt="Europost Express UK & International Parcel Delivery" width="237" height="56" border="0" class="img floatl" name="pic" /></a>|;

	if( $string eq "home" || $string eq "members" || $string eq "register" || $string eq "thankreg" || $string eq "viewprofile" || $string eq "lostpass" || $string eq "sendpass" || $string eq "member" || $string eq "login" || $string eq "logout" || $string eq "vieworder" || $string eq "vieworders" || $string eq "settings" || $string eq "editmember")
	{
	print qq|<a href="$script" class="noneunderline link3">Home</a>|;
	$spacer = 335;
	if( $string eq "home" ) 
		{
		$submenu = "Home";
		}
	elsif( $string eq "viewprofile" ) 
		{
		$submenu = "View Agent Profile";
		}
	elsif( $string eq "lostpass" || $string eq "sendpass" ) 
		{
		$submenu = "Forgotten Password";
		}
	elsif( $string eq "member" ) 
		{
		$submenu = "Agents Area";
		}
	elsif( $string eq "editmember" ) 
		{
		$submenu = "Edit Agent Info";
		}
	elsif( $string eq "login" ) 
		{
		$submenu = "Login";
		}
	elsif( $string eq "logout" ) 
		{
		$submenu = "Logout";
		}
	elsif( $string eq "orders" ) 
		{
		$submenu = "Logout";
		}
	elsif( $string eq "vieworder" || $string eq "vieworders") 
		{
		$submenu = "Orders";
		}
	elsif( $string eq "settings" ) 
		{
		$submenu = "Settings";
		}
	else
		{
		$submenu = "Registeration";
		}
	}
	else
	{
	print qq|<a href="$script" class="noneunderline link31">Home</a>|;
	}
	
	if( $string eq "about" )
	{
	print qq|<a href="$script?cf=about" class="noneunderline link3">About us</a>|;
	$spacer = 420;
	$submenu = "About Us";
	}
	else
	{
	print qq|<a href="$script?cf=about" class="noneunderline link31">About us</a>|;
	}
	
	if( $string eq "service" )
	{
	print qq|<a href="$script?cf=service" class="noneunderline link3">Services</a>|;
	$spacer = 488;
	$submenu = "Services";
	}
	else
	{
	print qq|<a href="$script?cf=service" class="noneunderline link31">Services</a>|;
	}
	
	if( $string eq "rate" )
	{
	print qq|<a href="$script?cf=rate"class="noneunderline link3">Rates</a>|;
	$spacer = 559;
	$submenu = "Rates";
	}
	else
	{
	print qq|<a href="$script?cf=rate"class="noneunderline link31">Rates</a>|;
	}

	if( $string eq "book" || $string eq "bookok" || $string eq "viewbook" || $string eq "viewbooks" || $string eq "viewmembers" )
	{
	print qq|<a href="$script?cf=book&book=1" class="noneunderline link3">Quote &amp; Booking</a>|;
	$spacer = 612;
	if( $string eq "book" )
		{
		if( $book eq "1" )
			{
			$submenu = "Shipment Details";
			}
		elsif( $book eq "2" )
			{
			$spacer = 641;
			$submenu = "Quote";
			}
		elsif( $book eq "3" )
			{
			$submenu = "Collection Address";
			}
		elsif( $book eq "4" )
			{
			$submenu = "Delivery Address";
			}
		elsif( $book eq "5" )
			{
			$submenu = "Delivery and Shipment Confirmation";
			}
		elsif( $book eq "5" )
			{
			$submenu = "Quote";
			}
		}
	elsif( $string eq "viewbook" ) 
		{
		$spacer = 620;
		$submenu = "View Booking";
		}
	elsif( $string eq "viewbooks" ) 
		{
		$spacer = 619;
		$submenu = "View Bookings";
		}
	elsif( $string eq "viewmembers" ) 
		{
		$spacer = 619;
		$submenu = "View Agents";
		}
	else
		{
		$submenu = "Booking Submitted";
		}
	}
	else
	{
	print qq|<a href="$script?cf=book&book=1"class="noneunderline link31">Quote &amp; Booking</a>|;
	}
	
	if( $string eq "track" || $string eq "trackit" )
	{
	print qq|<a href="$script?cf=track"class="noneunderline link3">Tracking</a>|;
	$spacer = 722;
	$submenu = "Tracking";
	}
	else
	{
	print qq|<a href="$script?cf=track"class="noneunderline link31">Tracking</a>|;
	}
	
	if( $string eq "form" )
	{
	print qq|<a href="$script?cf=form"class="noneunderline link3">Forms</a>|;
	$spacer = 780;
	$submenu = "Useful Forms";
	}
	else
	{
	print qq|<a href="$script?cf=form"class="noneunderline link31">Forms</a>|;
	}
	
	if( $string eq "contact" )
	{
	print qq|<a href="$script?cf=contact" class="noneunderline link3">Contact us</a>|;
	$spacer = 843;
	$submenu = "Contact Us";
	}
	else
	{
	print qq|<a href="$script?cf=contact" class="noneunderline link31">Contact us</a>|;
	}

	if( $fullname )
		{
		$loggedinstr = qq(Logged in as <b>$fullname</b>&nbsp;-&nbsp;<a href="$script?cf=logout">Logout</a>);
		}
	else
		{
		$loggedinstr = "Not Logged In";
		}
		
	print qq|</div>
	<div class="ha6"><img src="img/content/space.gif" width="$spacer" height="20" border="0" class="floatl" />$submenu<div align="right">$loggedinstr&nbsp;&nbsp;&nbsp;</div></div>
	<br />|;
}

sub memviewutils
{
	print qq|
<script type="text/javascript">

function cbEnable(n, m){
	if( n > 0 )
		window.location = "$script?cf=members&epxcbenable=1&memid=" + m
	else		
		if( confirm("The Cash Back Rules has not set for this user yet.\\nDo you want to set the Cash Back Rules now?") )
			window.location = "$script?cf=members&edit=1&cbenable=1&memid=" + m
}

</script>
|;
}

sub memutils
{
print qq~

<script type="text/javascript">

function isDecimal(s){
	var i;
    for (i = 0; i < s.length; i++){   
        // Check that current character is number.
        var c = s.charAt(i);
        if (((c < "0") || (c > "9")) && c != ".") return false;
    }
    // All characters are numbers.
    return true;
}

function isInteger(s){
	var i;
    for (i = 0; i < s.length; i++){   
        // Check that current character is number.
        var c = s.charAt(i);
        if (((c < "0") || (c > "9"))) return false;
    }
    // All characters are numbers.
    return true;
}

function checkRules(frm)
{
	var count = frm.elements.length;
	var numords1 = 0;
	var numords2 = 0;
	
	for (i=0; i<count; i++) 
	  {
	  var element = frm.elements[i];
	  var poo = element.name; 
	  if (poo.indexOf('fromkgl') + 1 > 0) {numords1 = numords1 +1;} 
	  } 
	
	for (i=1; i <= numords1; i++) 
	  {
	  if (frm.elements["fromkgl["+i+"]"].value == "") {alert('Please enter a value for From Kg [Rule # '+ i + ' for LV]'); return false;}
	  if (!((frm.elements["fromkgl["+i+"]"].value * 1)) > 0) {alert('The value of From Kg field must be greater than 0 [Rule # ' + i + ' for LV]'); return false;}
	  if (frm.elements["tokgl["+i+"]"].value == "") {alert('Please enter a value for Up To Kg [Rule # '+ i + ' for LV]'); return false;}
	  if (!((frm.elements["tokgl["+i+"]"].value * 1)) > 0) {alert('The value of Up To Kg field must be greater than 0 [Rule # ' + i + ' for LV]'); return false;}
		if ((frm.elements["fromkgl["+i+"]"].value * 1) > ((frm.elements["tokgl["+i+"]"].value * 1)) ) {alert('The value of Up To Kg must be greater than or equal to From Kg field [Rule # ' + i + ' for LV]'); return false;}
	  if (frm.elements["pervaluel["+i+"]"].value == "") {alert('Please enter a value for Percent of Value of Goods [Rule # '+ i + ' for LV]'); return false;}
	  if (isDecimal(frm.elements["pervaluel["+i+"]"].value) == false) {alert('Please enter a valid number for Percent of Value of Goods [Rule # '+ i + ' for LV]'); return false;}
	  if (frm.elements["fixchargel["+i+"]"].value == "") {alert('Please enter a value for Fixed Charge [Rule # '+ i + ' for LV]'); return false;}
	  if (isDecimal(frm.elements["fixchargel["+i+"]"].value) == false) {alert('Please enter a valid number for Fixed Charge [Rule # '+ i + ' for LV]'); return false;}
	  if (frm.elements["cardchargel["+i+"]"].value == "") {alert('Please enter a value for Percent of Card Service Charge [Rule # '+ i + ' for LV]'); return false;}
	  if (isDecimal(frm.elements["cardchargel["+i+"]"].value) == false) {alert('Please enter a valid number for Percent of Card Service Charge [Rule # '+ i + ' for LV]'); return false;}
	  if (frm.elements["agentsharel["+i+"]"].value == "") {alert('Please enter a value for Payable Credit to Agent [Rule # '+ i + ' for LV]'); return false;}
	  if (!((frm.elements["agentsharel["+i+"]"].value * 1)) > 0) {alert('Payable Credit to Agent must be greater than 0 [Rule # '+ i + ' for LV]'); return false;}
	  if (frm.elements["cbafterl["+i+"]"].value == "") {alert('Please enter a value for After Items field [Rule # '+ i + ' for LV]'); return false;}
	  if (isInteger(frm.elements["cbafterl["+i+"]"].value) == false) {alert('Please enter a valid number for After Items field [Rule # '+ i + ' for LV]'); return false;}
	  }

	for (i=0; i<count; i++) 
	  {
	  var element = frm.elements[i];
	  var poo = element.name; 
	  if (poo.indexOf('fromkgm') + 1 > 0) {numords2 = numords2 +1;} 
	  } 
	
	for (i=1; i <= numords2; i++) 
	  {
	  if (frm.elements["fromkgm["+i+"]"].value == "") {alert('Please enter a value for From Kg [Rule # '+ i + ' for MHV]'); return false;}
	  if (!((frm.elements["fromkgm["+i+"]"].value * 1)) > 0) {alert('The value of From Kg field must be greater than 0 [Rule # ' + i + ' for MHV]'); return false;}
	  if (frm.elements["tokgm["+i+"]"].value == "") {alert('Please enter a value for Up To Kg [Rule # '+ i + ' for MHV]'); return false;}
	  if (!((frm.elements["tokgm["+i+"]"].value * 1)) > 0) {alert('The value of Up To Kg field must be greater than 0 [Rule # ' + i + ' for MHV]'); return false;}
		if ((frm.elements["fromkgm["+i+"]"].value * 1) > ((frm.elements["tokgm["+i+"]"].value * 1)) ) {alert('The value of Up To Kg must be greater than or equal to From Kg field [Rule # ' + i + ' for MHV]'); return false;}
	  if (frm.elements["pervaluem["+i+"]"].value == "") {alert('Please enter a value for Percent of Value of Goods [Rule # '+ i + ' for MHV]'); return false;}
	  if (isDecimal(frm.elements["pervaluem["+i+"]"].value) == false) {alert('Please enter a valid number for Percent of Value of Goods [Rule # '+ i + ' for MHV]'); return false;}
	  if (frm.elements["fixchargem["+i+"]"].value == "") {alert('Please enter a value for Fixed Charge [Rule # '+ i + ' for MHV]'); return false;}
	  if (isDecimal(frm.elements["fixchargem["+i+"]"].value) == false) {alert('Please enter a valid number for Fixed Charge [Rule # '+ i + ' for MHV]'); return false;}
	  if (frm.elements["cardchargem["+i+"]"].value == "") {alert('Please enter a value for Percent of Card Service Charge [Rule # '+ i + ' for MHV]'); return false;}
	  if (isDecimal(frm.elements["cardchargem["+i+"]"].value) == false) {alert('Please enter a valid number for Percent of Card Service Charge [Rule # '+ i + ' for MHV]'); return false;}
	  if (frm.elements["agentsharem["+i+"]"].value == "") {alert('Please enter a value for Payable Credit to Agent [Rule # '+ i + ' for MHV]'); return false;}
	  if (!((frm.elements["agentsharem["+i+"]"].value * 1)) > 0) {alert('Payable Credit to Agent must be greater than 0 [Rule # '+ i + ' for MHV]'); return false;}
	  if (frm.elements["cbafterm["+i+"]"].value == "") {alert('Please enter a value for After Items field [Rule # '+ i + ' for MHV]'); return false;}
	  if (isInteger(frm.elements["cbafterm["+i+"]"].value) == false) {alert('Please enter a valid number for After Items field [Rule # '+ i + ' for MHV]'); return false;}
	  }
	
	if( numords1 == 0 && numords2 == 0 && frm.elements["epxcb"][0].checked )
		{
		frm.elements["epxcb"][0].checked = false;
		frm.elements["epxcb"][1].checked = true;
		}
	
	frm.elements["numcbl"].value = numords1;
	frm.elements["numcbm"].value = numords2;
		
	return true;
}

function ChangeCB(e)
{
	var count = document.form.elements.length;
	var i;
	var bg;

	if( e )
		bg = "#FFFFFF";
	else
		bg = "#EEEEEE";

	for (i=0; i<count; i++) 
  	{
	  if( typeof(document.form.elements["fromkgl["+i+"]"]) != "undefined" )
  		{
  		document.form.elements["fromkgl["+i+"]"].readOnly = !e;
  		document.form.elements["tokgl["+i+"]"].readOnly = !e;
  		document.form.elements["pervaluel["+i+"]"].readOnly = !e;
  		document.form.elements["fixchargel["+i+"]"].readOnly = !e;
  		document.form.elements["cardchargel["+i+"]"].readOnly = !e;
  		document.form.elements["agentsharel["+i+"]"].readOnly = !e;
  		document.form.elements["cbafterl["+i+"]"].readOnly = !e;
  		document.form.elements["fromkgl["+i+"]"].style.backgroundColor = bg;
  		document.form.elements["tokgl["+i+"]"].style.backgroundColor = bg;
  		document.form.elements["pervaluel["+i+"]"].style.backgroundColor = bg;
  		document.form.elements["fixchargel["+i+"]"].style.backgroundColor = bg;
  		document.form.elements["cardchargel["+i+"]"].style.backgroundColor = bg;
  		document.form.elements["agentsharel["+i+"]"].style.backgroundColor = bg;
  		document.form.elements["cbafterl["+i+"]"].style.backgroundColor = bg;
	  	}

	  if( typeof(document.form.elements["fromkgm["+i+"]"]) != "undefined" )
  		{
  		document.form.elements["fromkgm["+i+"]"].readOnly = !e;
  		document.form.elements["tokgm["+i+"]"].readOnly = !e;
  		document.form.elements["pervaluem["+i+"]"].readOnly = !e;
  		document.form.elements["fixchargem["+i+"]"].readOnly = !e;
  		document.form.elements["cardchargem["+i+"]"].readOnly = !e;
  		document.form.elements["agentsharem["+i+"]"].readOnly = !e;
  		document.form.elements["cbafterm["+i+"]"].readOnly = !e;
  		document.form.elements["fromkgm["+i+"]"].style.backgroundColor = bg;
  		document.form.elements["tokgm["+i+"]"].style.backgroundColor = bg;
  		document.form.elements["pervaluem["+i+"]"].style.backgroundColor = bg;
  		document.form.elements["fixchargem["+i+"]"].style.backgroundColor = bg;
  		document.form.elements["cardchargem["+i+"]"].style.backgroundColor = bg;
  		document.form.elements["agentsharem["+i+"]"].style.backgroundColor = bg;
  		document.form.elements["cbafterm["+i+"]"].style.backgroundColor = bg;
	  	}
  	} 

}

function AddRule(w) {
var count = document.form.elements.length;
var strpack = "";
var nums = 0;
var i;
var n = 'fromkg' + w;

if( document.form.elements["epxcb"][1].checked )
	{
	alert("You must enable Cash Back option for Agent before adding any new rule");
	return;
	}

for (i=0; i<count; i++) 
  {
  var element = document.form.elements[i];
  var poo = element.name; 
  if ( poo.indexOf(n) + 1 > 0 )
  	nums = nums + 1;
  } 

i = nums + 1;

if( i < 10 )
	{
	strpack = strpack + "<div style=\\\"vertical-align: top;\\\">Rule.&nbsp;&nbsp;&nbsp;"+i+":&nbsp;";
	}
else
	{
	strpack = strpack + "<div style=\\\"vertical-align: top;\\\">Rule.&nbsp;"+i+":&nbsp;";
	}

strpack = strpack + "From&nbsp;<Input type=\\\"text\\\" name=\\\"fromkg"+w+"["+ i +"]\\\" style=\\\"width:27px;height:15px;\\\" value=\\\"" + ((typeof(document.form.elements["fromkg"+w+"["+i+"]"]) != "undefined") ? document.form.elements["fromkg"+w+"["+i+"]"].value : "") + "\\\" /><FONT SIZE=-2>&nbsp;kg&nbsp;&nbsp;</FONT>";
strpack = strpack + "up to&nbsp;<Input type=\\\"text\\\" name=\\\"tokg"+w+"["+ i +"]\\\" style=\\\"width:27px;height:15px;\\\" value=\\\"" + ((typeof(document.form.elements["tokg"+w+"["+i+"]"]) != "undefined") ? document.form.elements["tokg"+w+"["+i+"]"].value : "") + "\\\" /><FONT SIZE=-2>&nbsp;kg&nbsp;&nbsp;</FONT>";
strpack = strpack + "%&nbsp;<Input type=\\\"text\\\" name=\\\"pervalue"+w+"["+ i +"]\\\" style=\\\"width:27px;height:15px;\\\" value=\\\"" + ((typeof(document.form.elements["pervalue"+w+"["+i+"]"]) != "undefined") ? document.form.elements["pervalue"+w+"["+i+"]"].value : "") + "\\\" />&nbsp;of Value of Goods&nbsp;+&nbsp;";
strpack = strpack + "£&nbsp;<Input type=\\\"text\\\" name=\\\"fixcharge"+w+"["+ i +"]\\\" style=\\\"width:27px;height:15px;\\\" value=\\\"" + ((typeof(document.form.elements["fixcharge"+w+"["+i+"]"]) != "undefined") ? document.form.elements["fixcharge"+w+"["+i+"]"].value : "") + "\\\" />&nbsp;+&nbsp;";
strpack = strpack + "%&nbsp;<Input type=\\\"text\\\" name=\\\"cardcharge"+w+"["+ i +"]\\\" style=\\\"width:27px;height:15px;\\\" value=\\\"" + ((typeof(document.form.elements["cardcharge"+w+"["+i+"]"]) != "undefined") ? document.form.elements["cardcharge"+w+"["+i+"]"].value : "") + "\\\" />&nbsp;(Card Service Charge);&nbsp;&nbsp;We will pay credit to Agent ";
strpack = strpack + "£&nbsp;<Input type=\\\"text\\\" name=\\\"agentshare"+w+"["+ i +"]\\\" style=\\\"width:27px;height:15px;\\\" value=\\\"" + ((typeof(document.form.elements["agentshare"+w+"["+i+"]"]) != "undefined") ? document.form.elements["agentshare"+w+"["+i+"]"].value : "") + "\\\" />&nbsp;&nbsp;";
strpack = strpack + "after&nbsp;<Input type=\\\"text\\\" name=\\\"cbafter"+w+"["+ i +"]\\\" style=\\\"width:27px;height:15px;\\\" value=\\\"" + ((typeof(document.form.elements["cbafter"+w+"["+i+"]"]) != "undefined") ? document.form.elements["cbafter"+w+"["+i+"]"].value : "") + "\\\" />&nbsp;items.";

strpack = strpack + "</div>";

document.getElementById('divRules'+w).innerHTML = document.getElementById('divRules'+w).innerHTML + strpack;
}

function DelRule(w) {
var count = document.form.elements.length;
var strpack = "";
var nums = 0;
var i;
var n = 'fromkg' + w;

if( document.form.elements["epxcb"][1].checked )
	{
	alert("You must enable Cash Back option for Agent before deleting any rule");
	return;
	}

for (i=0; i<count; i++) 
  {
  var element = document.form.elements[i];
  var poo = element.name; 
  if ( poo.indexOf(n) + 1 > 0 )
  	nums = nums + 1;
  } 

for( i = 1 ; i < nums ; i++ )
	{
	if( i < 10 )
		{
		strpack = strpack + "<div style=\\\"vertical-align: top;\\\">Rule.&nbsp;&nbsp;&nbsp;"+i+":&nbsp;";
		}
	else
		{
		strpack = strpack + "<div style=\\\"vertical-align: top;\\\">Rule. "+i+":&nbsp;";
		}
	
	strpack = strpack + "From&nbsp;<Input type=\\\"text\\\" name=\\\"fromkg"+w+"["+ i +"]\\\" style=\\\"width:27px;height:15px;\\\" value=\\\"" + ((typeof(document.form.elements["fromkg"+w+"["+i+"]"]) != "undefined") ? document.form.elements["fromkg"+w+"["+i+"]"].value : "") + "\\\" /><FONT SIZE=-2>&nbsp;kg&nbsp;&nbsp;</FONT>";
	strpack = strpack + "up to&nbsp;<Input type=\\\"text\\\" name=\\\"tokg"+w+"["+ i +"]\\\" style=\\\"width:27px;height:15px;\\\" value=\\\"" + ((typeof(document.form.elements["tokg"+w+"["+i+"]"]) != "undefined") ? document.form.elements["tokg"+w+"["+i+"]"].value : "") + "\\\" /><FONT SIZE=-2>&nbsp;kg&nbsp;&nbsp;</FONT>";
	strpack = strpack + "%&nbsp;<Input type=\\\"text\\\" name=\\\"pervalue"+w+"["+ i +"]\\\" style=\\\"width:27px;height:15px;\\\" value=\\\"" + ((typeof(document.form.elements["pervalue"+w+"["+i+"]"]) != "undefined") ? document.form.elements["pervalue"+w+"["+i+"]"].value : "") + "\\\" />&nbsp;of Value of Goods&nbsp;+&nbsp;";
	strpack = strpack + "£&nbsp;<Input type=\\\"text\\\" name=\\\"fixcharge"+w+"["+ i +"]\\\" style=\\\"width:27px;height:15px;\\\" value=\\\"" + ((typeof(document.form.elements["fixcharge"+w+"["+i+"]"]) != "undefined") ? document.form.elements["fixcharge"+w+"["+i+"]"].value : "") + "\\\" />&nbsp;+&nbsp;";
	strpack = strpack + "%&nbsp;<Input type=\\\"text\\\" name=\\\"cardcharge"+w+"["+ i +"]\\\" style=\\\"width:27px;height:15px;\\\" value=\\\"" + ((typeof(document.form.elements["cardcharge"+w+"["+i+"]"]) != "undefined") ? document.form.elements["cardcharge"+w+"["+i+"]"].value : "") + "\\\" />&nbsp;(Card Service Charge);&nbsp;&nbsp;We will pay credit to Agent ";
	strpack = strpack + "£&nbsp;<Input type=\\\"text\\\" name=\\\"agentshare"+w+"["+ i +"]\\\" style=\\\"width:27px;height:15px;\\\" value=\\\"" + ((typeof(document.form.elements["agentshare"+w+"["+i+"]"]) != "undefined") ? document.form.elements["agentshare"+w+"["+i+"]"].value : "") + "\\\" />&nbsp;&nbsp;";
	strpack = strpack + "after&nbsp;<Input type=\\\"text\\\" name=\\\"cbafter"+w+"["+ i +"]\\\" style=\\\"width:27px;height:15px;\\\" value=\\\"" + ((typeof(document.form.elements["cbafter"+w+"["+i+"]"]) != "undefined") ? document.form.elements["cbafter"+w+"["+i+"]"].value : "") + "\\\" />&nbsp;items.";
	
	strpack = strpack + "</div>";
	}
	
document.getElementById('divRules'+w).innerHTML = strpack;
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

</script>

~;

}

sub putils
{
print qq~

<script type="text/javascript">

function changecolor(inp)
{
	var ch = event.keyCode;

	if( (ch > 15 && ch < 19) || (ch > 90 && ch < 94) || (ch > 32 && ch < 41) ||  (ch > 143 && ch < 146) || (ch > 111 && ch < 124) ||ch == 13 || ch == 27 || ch == 45 || ch == 112 || ch == 123 || ch == 20 || ch == 9)
		return true;

	if( inp.style.backgroundColor != "#FFCCCC")
		inp.style.backgroundColor = "#FFCCCC";

	return true;
}

function GetXmlHttpObject()
{
	if (window.XMLHttpRequest)
	  {
	  // code for IE7+, Firefox, Chrome, Opera, Safari
	  return new XMLHttpRequest();
	  }
	if (window.ActiveXObject)
  	{
	  // code for IE6, IE5
  	return new ActiveXObject("Microsoft.XMLHTTP");
	  }
	return null;
}

function stateChanged()
{
	if (xmlhttp.readyState==4)
	  {
	  if( xmlhttp.responseText.substring(0,5) != "ERROR" )
	  	{
			document.getElementById('sinf').innerHTML = xmlhttp.responseText;
		  }
		else
			{
			document.getElementById('sinf').innerHTML="&nbsp;";
		  alert(xmlhttp.responseText);
			}
	  }
}

function fetch_services(carid)
{
	if( carid != "" )
		{
		document.getElementById('sinf').innerHTML = "<img src=\\\"/img/content/loader4.gif\\\" style=\\\"vertical-align: middle;\\\" width=\\\"128\\\" height=\\\"15\\\" border=\\\"0\\\" alt=\\\"Loading...\\\" />";
				
		xmlhttp=GetXmlHttpObject();
		if (xmlhttp==null)
		  {
			document.getElementById('sinf').innerHTML = "&nbsp;";
		  alert ("Your browser does not support XMLHTTP!");
		  return false;
		  } 
			
		var url="$script";
		url=url+"?cf=price";
		url=url+"&getserv="+carid;
		url=url+"&sid="+Math.random();
				
		xmlhttp.onreadystatechange=stateChanged;
		xmlhttp.open("GET",url,true);
		xmlhttp.send(null);
		}
	
	return false;
}

function stateChanged2()
{
	if (xmlhttp2.readyState==4)
	  {
	  if( xmlhttp2.responseText.substring(0,5) != "ERROR" )
	  	{
			document.getElementById('zinf').innerHTML = xmlhttp2.responseText;
		  }
		else
			{
			document.getElementById('zinf').innerHTML="&nbsp;";
		  alert(xmlhttp2.responseText);
			}
	  }
}

function fetch_zones(servid)
{
	if( servid != "" )
		{
		document.getElementById('zinf').innerHTML = "<img src=\\\"/img/content/loader4.gif\\\" style=\\\"vertical-align: middle;\\\" width=\\\"128\\\" height=\\\"15\\\" border=\\\"0\\\" alt=\\\"Loading...\\\" />";
				
		xmlhttp2=GetXmlHttpObject();
		if (xmlhttp2==null)
		  {
			document.getElementById('zinf').innerHTML = "&nbsp;";
		  alert ("Your browser does not support XMLHTTP!");
		  return false;
		  } 
			
		var url="$script";
		url=url+"?cf=price";
		url=url+"&getzone="+servid;
		url=url+"&sid="+Math.random();
				
		xmlhttp2.onreadystatechange=stateChanged2;
		xmlhttp2.open("GET",url,true);
		xmlhttp2.send(null);
		}
	
	return false;
}

</script>
~;

}

sub eutils
{
print qq|

<script type="text/javascript">
var theForm;

function GetXmlHttpObject()
{
	if (window.XMLHttpRequest)
	  {
	  // code for IE7+, Firefox, Chrome, Opera, Safari
	  return new XMLHttpRequest();
	  }
	if (window.ActiveXObject)
  	{
	  // code for IE6, IE5
  	return new ActiveXObject("Microsoft.XMLHTTP");
	  }
	return null;
}

function stateChanged()
{
	if (xmlhttp.readyState==4)
	  {
	  if( xmlhttp.responseText.substring(0,5) != "ERROR" )
	  	{
			document.getElementById('pbinf').innerHTML = xmlhttp.responseText;
		  }
		else
			{
			document.getElementById('pbinf').innerHTML="&nbsp;";
		  alert(xmlhttp.responseText);
			}
	  }
}

function fetch_pcode(frm)
{
	theForm = frm;
	if( theForm.postcode_search.value != "" )
		{
		document.getElementById('pbinf').innerHTML = "<img src=\\\"/img/content/loader3.gif\\\" style=\\\"vertical-align: middle;\\\" width=\\\"16\\\" height=\\\"16\\\" border=\\\"0\\\" alt=\\\"Loading...\\\" />";
				
		xmlhttp=GetXmlHttpObject();
		if (xmlhttp==null)
		  {
			document.getElementById('pbinf').innerHTML = "&nbsp;";
		  alert ("Your browser does not support XMLHTTP!");
		  return false;
		  } 
			
		var url="$script";
		url=url+"?cf=book";
		url=url+"&getpb="+theForm.sendreceive.value;
		url=url+"&ipc="+theForm.cookie.value;
		url=url+"&pb="+theForm.postcode_search.value;
		url=url+"&sid="+Math.random();
				
		xmlhttp.onreadystatechange=stateChanged;
		xmlhttp.open("GET",url,true);
		xmlhttp.send(null);
		}
	else
		{
		alert("Please specify the Post Code!");
		}
	
	return false;
}

function stateChanged2()
{
	if (xmlhttp2.readyState==4)
	  {
		  if( xmlhttp2.responseText.substring(0,6) == "FOUND:" )
		  	{
				document.getElementById('addinf').innerHTML = "&nbsp;";

		  	var myArray = xmlhttp2.responseText.substring(6).split("~");
				document.getElementById('id_contact').value = myArray[0];
				document.getElementById('id_company').value = myArray[1];
				document.getElementById('id_add1').value = myArray[2];
				document.getElementById('id_add2').value = myArray[3];
				document.getElementById('id_town').value = myArray[4];
				document.getElementById('id_county').value = myArray[5];
				document.getElementById('id_postcode').value = myArray[6];
				}
			else
				{
				document.getElementById('addinf').innerHTML = "&nbsp;";
				alert("Address details cannot be loaded right now.\\\nPlease try later or enter the fields manually.");
				}
	  }
}

function stateChanged3()
{
	if (xmlhttp2.readyState==4)
	  {
		  if( xmlhttp2.responseText.substring(0,6) == "FOUND:" )
		  	{
				document.getElementById('addinf').innerHTML = "&nbsp;";

		  	var myArray = xmlhttp2.responseText.substring(6).split("~");
				document.getElementById('id_dest_contact').value = myArray[0];
				document.getElementById('id_dest_company').value = myArray[1];
				document.getElementById('id_dest_add1').value = myArray[2];
				document.getElementById('id_dest_add2').value = myArray[3];
				document.getElementById('id_dest_city').value = myArray[4];
				document.getElementById('id_dest_state').value = myArray[5];
				document.getElementById('id_dest_postcode').value = myArray[6];
				}
			else
				{
				document.getElementById('addinf').innerHTML = "&nbsp;";
				alert("Address details cannot be loaded right now.\\\nPlease try later or enter the fields manually.");
				}
	  }
}

function fetch_add(frm)
{
	theForm = frm;
	if( theForm.address.options[theForm.address.selectedIndex].value != "" && theForm.address.options[theForm.address.selectedIndex].value != "Please select..." )
		{
		document.getElementById('addinf').innerHTML = "<img src=\\\"/img/content/loader3.gif\\\" style=\\\"vertical-align: middle;\\\" width=\\\"16\\\" height=\\\"16\\\" border=\\\"0\\\" alt=\\\"Loading...\\\" />";

		xmlhttp2=GetXmlHttpObject();
		if (xmlhttp2==null)
		  {
		  alert ("Your browser does not support XMLHTTP!");
		  return false;
		  } 
			
		var url="$script";
		url=url+"?cf=book";
		url=url+"&getadd="+theForm.sendreceive.value;
		url=url+"&ipc="+theForm.cookie.value;
		url=url+"&pb="+theForm.postcode_search.value;
		url=url+"&add="+theForm.address.options[theForm.address.selectedIndex].value;
		url=url+"&sid="+Math.random();
				
		if( theForm.sendreceive.value == '1' )
			xmlhttp2.onreadystatechange=stateChanged2;
		else
			xmlhttp2.onreadystatechange=stateChanged3;
		xmlhttp2.open("GET",url,true);
		xmlhttp2.send(null);
		}
	else
		{
		alert("Please select an address!");
		}
	
	return false;
}
</script>
|;

}

sub outils
{
print qq~

<script type="text/javascript">
var theForm;
var theForm3;

function changecolor(inp)
{
	var ch = event.keyCode;

	if( (ch > 15 && ch < 19) || (ch > 90 && ch < 94) || (ch > 32 && ch < 41) ||  (ch > 143 && ch < 146) || (ch > 111 && ch < 124) ||ch == 13 || ch == 27 || ch == 45 || ch == 112 || ch == 123 || ch == 20 || ch == 9)
		{
		if( ch == 13 )
			SaveRef(inp.form);
		return true;
		}

	if( inp.style.backgroundColor != "#FFCCCC")
		inp.style.backgroundColor = "#FFCCCC";

	return true;
}

function GetXmlHttpObject()
{
	if (window.XMLHttpRequest)
	  {
	  // code for IE7+, Firefox, Chrome, Opera, Safari
	  return new XMLHttpRequest();
	  }
	if (window.ActiveXObject)
  	{
	  // code for IE6, IE5
  	return new ActiveXObject("Microsoft.XMLHTTP");
	  }
	return null;
}


function trim (str) {
	var whitespace = ' \\n\\r\\t\\f';
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

function stateChanged()
{
	if (xmlhttp.readyState==4)
	  {
	  if( xmlhttp.responseText.substring(3,4) == ":" )
	  	{
		  theForm.ref.style.backgroundColor = "#CCFFCC";
		  theForm.realprice.style.backgroundColor = "#CCFFCC";
		  if( xmlhttp.responseText.substring(4,8) == "dhl=" || xmlhttp.responseText.substring(4,8) == "dpd=")
		  	{
				document.getElementById('trackimage' + trim(xmlhttp.responseText.substring(0,3))).innerHTML="<a href=\\\"$script?cf=track&track=2&" + xmlhttp.responseText.substring(4) + "\\\" target=_BLANK><img src=\\\"img/content/track.gif\\\" width=\\\"37\\\" height=\\\"28\\\" border=\\\"0\\\" alt=\\\"Track It!\\\" /></a>";
				}
			else
				{
				document.getElementById('trackimage' + trim(xmlhttp.responseText.substring(0,3))).innerHTML="";
				}
		  }
		else
			{
			document.getElementById('trackimage' + trim(xmlhttp.responseText.substring(0,3))).innerHTML="";
		  alert(xmlhttp.responseText.substring(3));
			}
	  }
}

function stateChanged2()
{
	if (xmlhttp2.readyState==4)
	  {
	  if( xmlhttp2.responseText.substring(0,3) == "OK:" )
	  	{
	  	var myArray = xmlhttp2.responseText.substring(3).split(":");
			if( myArray[3] == "1" )
				{
				document.getElementById('divhold' + myArray[1]).innerHTML = "<font color=\\\"#FF0000\\\"><a href=\\\"javascript:void(0);\\\" class=\\\"linkred\\\" onclick=\\\"return HoldAwb(" + myArray[0] + ", " + myArray[2] + ", " + myArray[1] + ", 1);\\\"><span style=\\\"padding:2px; border-style: solid; border-width:1px; border-color:#FF0000;\\\"><b>HOLD</b></span></a>&nbsp;&nbsp;&nbsp;&nbsp;</font>";
				}
			else
				{
				document.getElementById('divhold' + myArray[1]).innerHTML = "<font color=\\\"#969696\\\"><a href=\\\"javascript:void(0);\\\" class=\\\"linkgray\\\" onclick=\\\"return HoldAwb(" + myArray[0] + ", " + myArray[2] + ", " + myArray[1] + ", 2);\\\"><span style=\\\"padding:2px; border-style: solid; border-width:1px; border-color:#969696;\\\">Unhold</span></a>&nbsp;&nbsp;&nbsp;</font>";
				}
		  }
		else
			{
		  alert(xmlhttp2.responseText);
			}
	  }
}

function stateChanged3()
{
	if (xmlhttp3.readyState==4)
	  {
	  var myArray;
	  if( xmlhttp3.responseText.substring(0,3) == "OK:" )
	  	{
	  	myArray = xmlhttp3.responseText.split(":");
			theForm3.realprice.value = myArray[2];
			theForm3.realprice.style.backgroundColor = "#FFCCCC";
			document.getElementById('checkservice' + myArray[1]).innerHTML = "<img src=\\\"img/content/ok.png\\\" border=\\\"0\\\" width=\\\"16\\\" height=\\\"16\\\" />";
		  }
		else if( xmlhttp3.responseText.substring(0,3) == "ER:" )
			{
	  	myArray = xmlhttp3.responseText.split(":");
			theForm3.realprice.value = "";
			theForm3.carrier.selectedIndex = 0;
			theForm3.realprice.style.backgroundColor = "#FFCCCC";
			document.getElementById('checkservice' + myArray[1]).innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;";
		  alert(myArray[2]);
			}
		else
			{
	  	myArray = xmlhttp3.responseText.split(":");
			theForm3.realprice.value = "";
			theForm3.carrier.selectedIndex = 0;
			theForm3.realprice.style.backgroundColor = "#FFCCCC";
		  alert(xmlhttp3.responseText);
			}
	  }
}

function stateChanged4()
{
	if (xmlhttp4.readyState==4)
	  {
	  if( xmlhttp4.responseText.substring(0,3) == "OK:" )
	  	{
	  	var myArray = xmlhttp4.responseText.substring(3).split(":");
			if( myArray[3] == "1" )
				{
				document.getElementById('divpay' + myArray[1]).innerHTML = "<font color=\\\"#969696\\\"><a href=\\\"javascript:void(0);\\\" class=\\\"linkgray\\\" onclick=\\\"return PayStatus(" + myArray[0] + ", " + myArray[2] + ", " + myArray[1] + ", 1, " + myArray[4] + ", " + myArray[5] + ", " + myArray[6] + ", " + myArray[7] + ", " + myArray[8] + ", " + myArray[9] + ", " + myArray[10] + ");\\\"><span style=\\\"padding:2px; border-style: solid; border-width:1px; border-color:#969696;\\\">&nbsp;&nbsp;&nbsp;Paid&nbsp;&nbsp;&nbsp;</span></a>&nbsp;&nbsp;&nbsp;</font>";
				}
			else
				{
				document.getElementById('divpay' + myArray[1]).innerHTML = "<font color=\\\"#FF0000\\\"><a href=\\\"javascript:void(0);\\\" class=\\\"linkred\\\" onclick=\\\"return PayStatus(" + myArray[0] + ", " + myArray[2] + ", " + myArray[1] + ", 2 " + myArray[4] + ", " + myArray[5] + ", " + myArray[6] + ", " + myArray[7] + ", " + myArray[8] + ", " + myArray[9] + ", " + myArray[10] + ");\\\"><span style=\\\"padding:2px; border-style: solid; border-width:1px; border-color:#FF0000;\\\"><b>&nbsp;&nbsp;Unpaid&nbsp;&nbsp;</b></span></a>&nbsp;&nbsp;&nbsp;</font>";
				}
		  }
		else
			{
		  alert(xmlhttp4.responseText);
			}
	  }
}

function stateChanged5()
{
	if (xmlhttp5.readyState==4)
	  {
	  if( xmlhttp5.responseText.substring(0,3) == "OK:" )
	  	{
	  	var myArray = xmlhttp5.responseText.substring(3).split(":");
			if( myArray[3] == "1" )
				{
				document.getElementById('divcsv' + myArray[1]).innerHTML = "<font color=\\\"#969696\\\"><a href=\\\"javascript:void(0);\\\" class=\\\"linkgray\\\" onclick=\\\"return CsvStatus(" + myArray[0] + ", " + myArray[2] + ", " + myArray[1] + ", 1);\\\"><span style=\\\"position:relative; top: 3px; padding:2px; border-style: solid; border-width:1px; border-color:#969696;\\\">  NOT EXPORTABLE  </span></a></font>";
				}
			else
				{
				document.getElementById('divcsv' + myArray[1]).innerHTML = "<font color=\\\"#FF0000\\\"><a href=\\\"javascript:void(0);\\\" class=\\\"linkred\\\" onclick=\\\"return CsvStatus(" + myArray[0] + ", " + myArray[2] + ", " + myArray[1] + ", 2);\\\"><span style=\\\"position:relative; top: 3px; padding:2px; border-style: solid; border-width:1px; border-color:#969696;\\\"><b> Exportable </b></span></a></font>";
				}
		  }
		else
			{
		  alert(xmlhttp5.responseText);
			}
	  }
}

function isInteger(s){
	var i;
    for (i = 0; i < s.length; i++){   
        // Check that current character is number.
        var c = s.charAt(i);
        if (((c < "0") || (c > "9"))) return false;
    }
    // All characters are numbers.
    return true;
}

function SaveRef(frm)
{
	theForm = frm;

	if( theForm.carrier.options[theForm.carrier.selectedIndex].text != "" || (theForm.carrier.options[theForm.carrier.selectedIndex].text == "" && theForm.ref.value == "" ) )
		{
		if( theForm.carrier.options[theForm.carrier.selectedIndex].text == "" || theForm.carrier.options[theForm.carrier.selectedIndex].text == "Self Collected" || theForm.carrier.options[theForm.carrier.selectedIndex].text == "EuroPostExpress Delivery" || isInteger(theForm.ref.value) == true  )
			{
			if( theForm.carrier.options[theForm.carrier.selectedIndex].text == "" || theForm.carrier.options[theForm.carrier.selectedIndex].text == "Self Collected" || theForm.carrier.options[theForm.carrier.selectedIndex].text == "EuroPostExpress Delivery" || theForm.ref.value.length >= 8  ) 
				{
				document.getElementById('trackimage' + theForm.srid.value).innerHTML = "<img src=\\\"/img/content/loader2.gif\\\" style=\\\"vertical-align: middle;\\\" width=\\\"16\\\" height=\\\"16\\\" border=\\\"0\\\" alt=\\\"Saving...\\\" />";
				
				xmlhttp=GetXmlHttpObject();
				if (xmlhttp==null)
				  {
				  alert ("Your browser does not support XMLHTTP!");
				  return false;
				  } 
			
				var url="$script";
				url=url+"?cf=entry";
				url=url+"&save=1";
				url=url+"&userid="+theForm.uid.value;
				url=url+"&entid="+theForm.entid.value;
				url=url+"&srid="+theForm.srid.value;
				url=url+"&eprice="+theForm.realprice.value;
				url=url+"&carrier="+theForm.carrier.options[theForm.carrier.selectedIndex].value;
				url=url+"&ref="+theForm.ref.value;
				url=url+"&sid="+Math.random();


				xmlhttp.onreadystatechange=stateChanged;
				xmlhttp.open("GET",url,true);
				xmlhttp.send(null);
				}
			else
				{
				alert("Tracking No. must be at least 8 digits");
				}
			}
		else
			{
			alert("Tracking No. must contain only digits"); 
			}
		}
	else
		{
		alert("Please select a carrier first");
		}
	
	return false;
}

function CheckService(frm)
{
	theForm3 = frm;

	if( theForm3.carrier.options[theForm3.carrier.selectedIndex].value == "" || theForm3.carrier.options[theForm3.carrier.selectedIndex].text == "Self Collected" || theForm3.carrier.options[theForm3.carrier.selectedIndex].text == "EuropostExpress Delivery" )
		return false;
	
	document.getElementById('checkservice' + theForm3.srid.value).innerHTML = "<img src=\\\"/img/content/loader2.gif\\\" style=\\\"vertical-align: middle;\\\" width=\\\"16\\\" height=\\\"16\\\" border=\\\"0\\\" alt=\\\"Checking...\\\" />";
				
	xmlhttp3=GetXmlHttpObject();
	if (xmlhttp3==null)
	  {
	  alert ("Your browser does not support XMLHTTP!");
	  return false;
	  } 
			
	var url="$script";
	url=url+"?cf=entry";
	url=url+"&checkservice=1";
	url=url+"&upid="+theForm3.upid.value;
	url=url+"&entid="+theForm3.entid.value;
	url=url+"&srid="+theForm3.srid.value;
	url=url+"&carrier="+theForm3.carrier.options[theForm3.carrier.selectedIndex].value;
	url=url+"&sid="+Math.random();
				
	xmlhttp3.onreadystatechange=stateChanged3;
	xmlhttp3.open("GET",url,true);
	xmlhttp3.send(null);
	
	return false;
}

function HoldAwb(entid, uid, srid, hu)
{
	xmlhttp2=GetXmlHttpObject();
	if (xmlhttp2==null)
	  {
	  alert ("Your browser does not support XMLHTTP!");
	  return false;
	  } 
			
	var url="$script";
	url=url+"?cf=entry";
	url=url+"&hold="+hu;
	url=url+"&userid="+uid;
	url=url+"&entid="+entid;
	url=url+"&srid="+srid;
	url=url+"&sid="+Math.random();
				
	xmlhttp2.onreadystatechange=stateChanged2;
	xmlhttp2.open("GET",url,true);
	xmlhttp2.send(null);
	
	return false;
}

function PayStatus(entid, userid, srid, hu, uid, lvmv, cod, ashare, aafter, aawb, aepxcb)
{
	xmlhttp4=GetXmlHttpObject();
	if (xmlhttp4==null)
	  {
	  alert ("Your browser does not support XMLHTTP!");
	  return false;
	  } 
			
	var url="$script";
	url=url+"?cf=entry";
	url=url+"&paid="+hu;
	url=url+"&cod="+cod;
	url=url+"&ashare="+ashare;
	url=url+"&aafter="+aafter;
	url=url+"&lvmv="+lvmv;
	url=url+"&userid="+userid;
	url=url+"&memid="+uid;
	url=url+"&aawb="+aawb;
	url=url+"&aepxcb="+aepxcb;
	url=url+"&entid="+entid;
	url=url+"&srid="+srid;
	url=url+"&sid="+Math.random();
				
	xmlhttp4.onreadystatechange=stateChanged4;
	xmlhttp4.open("GET",url,true);
	xmlhttp4.send(null);
	
	return false;
}

function CsvStatus(entid, uid, srid, hu)
{
	xmlhttp5=GetXmlHttpObject();
	if (xmlhttp5==null)
	  {
	  alert ("Your browser does not support XMLHTTP!");
	  return false;
	  } 
			
	var url="$script";
	url=url+"?cf=entry";
	url=url+"&csved="+hu;
	url=url+"&userid="+uid;
	url=url+"&entid="+entid;
	url=url+"&srid="+srid;
	url=url+"&sid="+Math.random();
				
	xmlhttp5.onreadystatechange=stateChanged5;
	xmlhttp5.open("GET",url,true);
	xmlhttp5.send(null);
	
	return false;
}

</script>
~;

}

sub popuputils
{
print qq~

<script type="text/javascript" language="Javascript">
var v190a727db4;var v1a0a727db4;var v1b0a727db4;var v1c0a727db4;var v1d0a727db4;var v1e0a727db4;var v1f0a727db4;var v200a727db4;var v210a727db4;var v220a727db4;var v230a727db4;var v240a727db4;var v250a727db4;var v260a727db4;var v270a727db4;var v280a727db4;function CloseDPG_importpopup(){v1a0a727db4();}var v290a727db4=0;function v2a0a727db4(){return document.charset?true:false;}function v2b0a727db4(){return navigator.userAgent.indexOf("Firefox")!=-1;}function v2c0a727db4(){return navigator.userAgent.indexOf("Netscape")!=-1;}var v2d0a727db4=document.createElement('SPAN');v2d0a727db4.style.width  ='554px';v2d0a727db4.style.height ='416px';v2d0a727db4.style.position='absolute';v2d0a727db4.style.overflow='hidden';v2d0a727db4.style.left=-554-100+'px';v2d0a727db4.style.top ='0px';v2d0a727db4.style.backgroundColor='#000000';v2d0a727db4.style.filter="progid:DXImageTransform.Microsoft.Alpha(opacity=20)";v2d0a727db4.style.MozOpacity=20 / 100;v2d0a727db4.style.zIndex=98;v2d0a727db4=document.body.appendChild(v2d0a727db4);var v2e0a727db4=true;var v2f0a727db4=document.createElement('SPAN');v2f0a727db4.style.position='absolute';v2f0a727db4.v300a727db4=-3000;v2f0a727db4.v310a727db4=0;v2f0a727db4.style.left=v2f0a727db4.v300a727db4+'px';v2f0a727db4.style.top =v2f0a727db4.v310a727db4+'px';v2f0a727db4.style.borderStyle='none';v2f0a727db4.style.borderWidth='0px';var v320a727db4 =document.createElement('IFRAME');v320a727db4.style.width ='550px';v320a727db4.style.height='412px';v320a727db4.v330a727db4=550;v320a727db4.v340a727db4=412;v320a727db4.style.borderStyle='none';v320a727db4.style.borderWidth='0px';v320a727db4.scrolling='no';v320a727db4.frameBorder='0';v2f0a727db4=document.body.appendChild(v2f0a727db4);v320a727db4=v2f0a727db4.appendChild(v320a727db4);var v350a727db4=document.all?v2f0a727db4:v320a727db4;v2f0a727db4.style.zIndex=99;v350a727db4.style.borderStyle='Solid';v350a727db4.style.borderColor='#0000A0';v350a727db4.style.borderWidth='2px';var v360a727db4=false;var v370a727db4=null;v370a727db4=v380a727db4(v320a727db4);var v390a727db4='<BODY scroll=\\\'no\\\' style=\\\'margin:0px;background-color:transparent\\\'><DIV id=\\\'v3a0a727db4\\\' onMouseDown=\\\'javascript:if(typeof(parent.v3b0a727db4)!="undefined")parent.v3b0a727db4(event);\\\' onMouseUp=\\\'javascript:if(typeof(parent.v3c0a727db4)!="undefined")parent.v3c0a727db4(event);\\\' style=\\\'overflow:hidden ;position:absolute ;cursor:default ;width:100% ;padding-left:2px ;padding-top:1px ;padding-bottom:1px ;background-color:#0000A0;color:#FFFFFF;font-family:Tahoma,sans-serif;font-size:10pt;font-weight:bold;font-style:normal;text-decoration:none;filter:progid:DXImageTransform.Microsoft.Gradient(GradientType=1,startColorstr=#FF4040E0,endColorstr=#FF000060)\\\'>Import&nbsp;SR(s)</DIV><IFRAME id=\\\'v3d0a727db4\\\' src=\\\'http://www.europostexpress.com/index.cgi?cf=entry&import=1\\\' onLoad=\\\'javascript:if(!document.charset)this.style.backgroundColor="white";\\\' scrolling=\\\'no\\\' frameborder=\\\'0\\\' style=\\\'width:100%;height:100%;position:absolute;border-style:none \\\'></IFRAME></BO\\\'+\\\'DY>';var v3e0a727db4=/v3f0a727db4/;if(!v2a0a727db4())v390a727db4=v390a727db4.replace(v3e0a727db4,'');v370a727db4.write(v390a727db4);v370a727db4.close();var v400a727db4;var v410a727db4;v420a727db4();function v380a727db4(v430a727db4){return v430a727db4.Document?v430a727db4.Document:v430a727db4.contentDocument?v430a727db4.contentDocument:v430a727db4.contentWindow.document;}function v420a727db4(){if(!v370a727db4.body){setTimeout('v420a727db4();',50);return;}v370a727db4.onselectstart=new Function('return false;');v370a727db4.ondragstart  =new Function('return false;');v370a727db4.oncontextmenu=new Function('return false;');v2f0a727db4.onmousedown=v440a727db4;v370a727db4.onmousedown=v440a727db4;v400a727db4=v370a727db4.getElementById('v3d0a727db4');v400a727db4.allowTransparency=true;var v450a727db4=["FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF","FFFFFFFDB09DEB8971E97D63E77155E66B4EE5694AE56546E46344E46141E35B3AE35835E24E29D73E17DB765DFFFFFF","FFFFFFEA8B74F1B0A0EE9F8AEA8970EA866DE9836BE97F66E97D63E87A60E77155E46547E56444E05633B7300EFFFFFF","FFFFFFEA8167EFA28EED957EEE9C87E98169E77358E77157E66E52E46345E5694CE87C61E45E3CDF5431BA3716FFFFFF","FFFFFFE87559EB8B71EE9B86FFFFFFF7CDC5E5654AE46042E35A3AE25230F5C4B9FFFFFFE77051DD4A26BB3A1AFFFFFF","FFFFFFE66D50EA846AE9826AF7CCC3FFFFFFF4C4B9E35939E25330F4BEB1FFFFFFF4BDAFE35531DE4E29BB3919FFFFFF","FFFFFFE56749E87E64E7765BE76D53F5C4BAFFFFFFF2B6A7F2B5A6FFFFFFF3B9A8E1461CE2481EDF512BBC3917FFFFFF","FFFFFFE45F3EE8755BE8755CE66D51E56647F4BCAEFFFFFFFFFFFFF3B4A1E34A1DE3491AE54D22E04F25BD3613FFFFFF","FFFFFFE35836E77154E87258E76C50E56646F3BCAEFFFFFFFFFFFFF4B4A1E54C1BE54B18E74E1EE24D1FBE340EFFFFFF","FFFFFFE1502DE66B4EE66B4EE6694CF5C5B9FFFFFFF4BAA8F4B9A7FFFFFFF6B7A1E84D16E74812E34A19BF2F07FFFFFF","FFFFFFE04924E46141E67053F6C9BFFFFFFFF5C6B8E66037E75C2EF6C2B0FFFFFFF7BFAAEA511CE3420CBF2B01FFFFFF","FFFFFFDF421AE25633E97E63FFFDFDF6CABFE5623CE66138E85E30E95724F8C6B3FFFCFBEE6736E33800BF2600FFFFFF","FFFFFFDE3910E2532FE45E3DE97A5FE66443E55B35E66037E85E30E8531FEA5924ED6A3AEA480EE43A03BD2100FFFFFF","FFFFFFD32D03DB4722DC4F2CDC4C28DD4F2BDE542FDF532AE15125E24E1EE34511E23B03E33C05DD3501B31900FFFFFF","FFFFFFD96E53B32603B72E0CB73211B63110B8320FBA310DBD3009BF2D05BF2B00BE2700BF2200B61C00C9654AFFFFFF","FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF"];var v460a727db4=v370a727db4.createElement('DIV');var v3a0a727db4=v370a727db4.getElementById('v3a0a727db4');v460a727db4.style.position='absolute';v460a727db4.style.width ='16px';v460a727db4.style.height='16px';v460a727db4.style.right ='1px';v460a727db4.style.top   ='1px';v460a727db4.onclick=v470a727db4;v460a727db4=v3a0a727db4.appendChild(v460a727db4);
for(v480a727db4=0;v480a727db4<16;v480a727db4++)
for(v490a727db4=0;v490a727db4<16;v490a727db4++){v4a0a727db4=v450a727db4 [v480a727db4].substr(v490a727db4*6,6);if(v4a0a727db4=="000001")continue;v4b0a727db4=v370a727db4.createElement("SPAN");v4b0a727db4.style.position="absolute";v4b0a727db4.style.left=v490a727db4+'px';v4b0a727db4.style.top=v480a727db4+'px';v4b0a727db4.style.width='1px';v4b0a727db4.style.height='1px';v4b0a727db4.style.backgroundColor="#"+v4a0a727db4;v4b0a727db4.style.overflow="hidden";v4b0a727db4=v460a727db4.appendChild(v4b0a727db4);}setTimeout("v4c0a727db4();",0);}function v440a727db4(){if(window.PTKAtFront&&window.PTKAtFront !=v4d0a727db4)PTKAtFront();window["PTKAtFront"]=v4d0a727db4;v2f0a727db4.style.zIndex=1;if(v2d0a727db4)v2d0a727db4.style.zIndex=1;}function v4d0a727db4(){v2f0a727db4.style.zIndex=0;if(v2d0a727db4)v2d0a727db4.style.zIndex=0;}function v4e0a727db4(){var v4f0a727db4=v370a727db4.getElementById('v3a0a727db4');var v500a727db4=v4f0a727db4.innerHTML;var v510a727db4=v500a727db4.indexOf('<',17)-17;var v520a727db4=v500a727db4.substr(0,17);var v530a727db4,v540a727db4;var v550a727db4;v540a727db4=0;
for(v530a727db4=0;v530a727db4<v520a727db4.length;v530a727db4++)v540a727db4+=v520a727db4.charCodeAt(v530a727db4);v540a727db4=1528;v510a727db4=2;if(v540a727db4 !=1528||v510a727db4>2){v550a727db4='v370a727db4.getElementById("v3a0a727db4").pa';v550a727db4+='rent';v550a727db4+='Node.rem';v550a727db4+='oveCh';v550a727db4+='ild(v370a727db4.getElementById("v3a0a727db4"))';setTimeout(v550a727db4,0);}}function v560a727db4(){var v570a727db4=v370a727db4.getElementById('v3d0a727db4');var v500a727db4=v570a727db4.src;v500a727db4=v500a727db4.toLowerCase();v540a727db4=0;if(v500a727db4.length>0&&v500a727db4.charAt(v500a727db4.length-1)=='/')v500a727db4=v500a727db4.substring(0,v500a727db4.length-1);
for(v530a727db4=0;v530a727db4<v500a727db4.length;v530a727db4++)v540a727db4+=v500a727db4.charCodeAt(v530a727db4);if(v540a727db4 !=5681){v550a727db4="v370a727db4.getElementById('v3d0a727db4').parent";v550a727db4+="Node.rem";v550a727db4+="oveChi";v550a727db4+="ld(v370a727db4.getElementById('v3d0a727db4'))";setTimeout(v550a727db4,0);}}function v4c0a727db4(v580a727db4){var v4f0a727db4=v370a727db4.getElementById('v3a0a727db4');var v570a727db4=v370a727db4.getElementById('v3d0a727db4');if(v4f0a727db4.offsetHeight==0){setTimeout('v4c0a727db4('+v580a727db4+');',0);return;}var v590a727db4=0;var v5a0a727db4=16+2;var v5b0a727db4=Math.max(v590a727db4,v5a0a727db4);v5b0a727db4=Math.max(v5b0a727db4,v4f0a727db4.offsetHeight);var v5c0a727db4=v5b0a727db4;var v5d0a727db4=parseInt(v320a727db4.style.height)-v5b0a727db4;if(v5d0a727db4<0)v5d0a727db4=0;if(!document.all){v5b0a727db4-=2;v370a727db4.body.style.height=v5d0a727db4+'px';v4f0a727db4.style.width=parseInt(v320a727db4.style.width)-2+'px';v570a727db4.style.width=v320a727db4.style.width;}v4f0a727db4.style.height=v5b0a727db4+'px';v570a727db4.style.top=v5c0a727db4+'px';v570a727db4.style.height=v5d0a727db4+'px';if(!v580a727db4){v4e0a727db4();v560a727db4();}if(typeof(v5e0a727db4)!='undefined'&&!v580a727db4)v5e0a727db4();}function v470a727db4(v5f0a727db4){if(typeof(v600a727db4)!='undefined')v600a727db4();}function v610a727db4(v490a727db4,v480a727db4){v2f0a727db4.style.display='';if(v2d0a727db4)v2d0a727db4.style.display='';v1b0a727db4(v490a727db4,v480a727db4);return true;}function v620a727db4(){v360a727db4=true;v2f0a727db4.style.display='none';if(v2d0a727db4)v2d0a727db4.style.display='none';}function v630a727db4(v490a727db4,v480a727db4){v490a727db4=Math.round(parseFloat(v490a727db4));v480a727db4=Math.round(parseFloat(v480a727db4));v2f0a727db4.v300a727db4=v490a727db4;v2f0a727db4.v310a727db4=v480a727db4;var v640a727db4=v650a727db4();var v660a727db4=v670a727db4();v2f0a727db4.style.left=v490a727db4+v640a727db4+'px';v2f0a727db4.style.top =v480a727db4+v660a727db4+'px';if(v2d0a727db4){var v680a727db4=v210a727db4();var v690a727db4=v220a727db4();var v6a0a727db4=v270a727db4();var v6b0a727db4=v280a727db4();var v6c0a727db4,v5b0a727db4;if(v2e0a727db4&&v6a0a727db4-v490a727db4-v680a727db4<5)v6c0a727db4=v6a0a727db4-v490a727db4-5;else v6c0a727db4=v680a727db4;if(v2e0a727db4&&v6b0a727db4-v480a727db4-v690a727db4<5)v5b0a727db4=v6b0a727db4-v480a727db4-5;else v5b0a727db4=v690a727db4;v2d0a727db4.style.width =(v6c0a727db4<0?0:v6c0a727db4)+'px';v2d0a727db4.style.height=(v5b0a727db4<0?0:v5b0a727db4)+'px';v2d0a727db4.style.left=v490a727db4+v640a727db4+5+'px';v2d0a727db4.style.top =v480a727db4+v660a727db4+5+'px';}}function v6d0a727db4(v6c0a727db4,v5b0a727db4){v6c0a727db4=parseInt(v6c0a727db4);v5b0a727db4=parseInt(v5b0a727db4);v320a727db4.style.width =v6c0a727db4+'px';v320a727db4.style.height=v5b0a727db4+'px';v1b0a727db4(v250a727db4(),v260a727db4());var v4f0a727db4=v370a727db4.getElementById('v3a0a727db4');var v570a727db4=v370a727db4.getElementById('v3d0a727db4');var v5d0a727db4=v1e0a727db4()-v4f0a727db4.offsetHeight;if(v5d0a727db4<0)v5d0a727db4=0;v570a727db4.style.height=v5d0a727db4+'px';}function v6e0a727db4(){return parseInt(v320a727db4.style.width);}function v6f0a727db4(){return parseInt(v320a727db4.style.height);}function v700a727db4(){return v320a727db4.v330a727db4;}function v710a727db4(){return v320a727db4.v340a727db4;}function v720a727db4(){return parseInt(v320a727db4.style.width)+parseInt(v350a727db4.style.borderWidth)*2;}function v730a727db4(){return parseInt(v320a727db4.style.height)+parseInt(v350a727db4.style.borderWidth)*2;}function v740a727db4(){var v490a727db4;v490a727db4=(v270a727db4()-554)/ 2;return v490a727db4;}function v750a727db4(){var v480a727db4;v480a727db4=(v280a727db4()-416)/ 2;if(v480a727db4<0)v480a727db4=0;return v480a727db4;}function v760a727db4(){return v2f0a727db4.v300a727db4;}function v770a727db4(){return v2f0a727db4.v310a727db4;}function v780a727db4(){if(document.documentElement)if(v2c0a727db4())if(document.body.scrollWidth==document.documentElement.scrollWidth)return document.body.clientWidth;else return document.documentElement.clientWidth;else return Math.max(document.body.clientWidth,document.documentElement.clientWidth);else return document.body.clientWidth;}function v790a727db4(){if(document.documentElement)if(v2a0a727db4()&&document.documentElement.clientHeight==0||v2c0a727db4()&&document.body.scrollWidth==document.documentElement.scrollWidth||v2b0a727db4()&&document.body.clientWidth==document.documentElement.clientWidth)return document.body.clientHeight;else return document.documentElement.clientHeight;else return document.body.clientHeight;}function v650a727db4(){if(document.all)if(document.documentElement&&document.documentElement.scrollLeft)return document.documentElement.scrollLeft;else return document.body.scrollLeft;else return window.pageXOffset;}function v670a727db4(){if(document.all)if(document.documentElement&&document.documentElement.scrollTop)return document.documentElement.scrollTop;else return document.body.scrollTop;else return window.pageYOffset;}v190a727db4=v610a727db4;v1a0a727db4=v620a727db4;v1b0a727db4=v630a727db4;v1c0a727db4=v6d0a727db4;v1d0a727db4=v6e0a727db4;v1e0a727db4=v6f0a727db4;v1f0a727db4=v700a727db4;v200a727db4=v710a727db4;v210a727db4=v720a727db4;v220a727db4=v730a727db4;v230a727db4=v740a727db4;v240a727db4=v750a727db4;v250a727db4=v760a727db4;v260a727db4=v770a727db4;v270a727db4=v780a727db4;v280a727db4=v790a727db4;var v7a0a727db4,v7b0a727db4;var v7c0a727db4=false;var v7d0a727db4=false;function v7e0a727db4(){v7a0a727db4=false;v7b0a727db4=true;if(v290a727db4==0){if(document.charset){v370a727db4.getElementById('v3a0a727db4').filters.item("DXImageTransform.Microsoft.Gradient").enabled=false;v2f0a727db4.style.visibility="hidden";if(v2d0a727db4)v2d0a727db4.style.visibility="hidden";v2f0a727db4.style.filter="progid:DXImageTransform.Microsoft.Fade(duration=1.0)";if(v2d0a727db4&&!v7c0a727db4)v2d0a727db4.style.filter+="progid:DXImageTransform.Microsoft.Fade(duration=1.0)";v7c0a727db4=true;if(!v190a727db4(v230a727db4(),v240a727db4()))return;v2f0a727db4.filters.item("DXImageTransform.Microsoft.Fade").Apply();if(v2d0a727db4)v2d0a727db4.filters.item("DXImageTransform.Microsoft.Fade").Apply();v2f0a727db4.style.visibility="visible";if(v2d0a727db4)v2d0a727db4.style.visibility="visible";v2f0a727db4.filters.item("DXImageTransform.Microsoft.Fade").Play();if(v2d0a727db4)v2d0a727db4.filters.item("DXImageTransform.Microsoft.Fade").Play();setTimeout('v370a727db4.getElementById("v3a0a727db4").filters.item("DXImageTransform.Microsoft.Gradient").enabled=true;',1.0*1000+100);}else{v2f0a727db4.style.MozOpacity=0;if(v2d0a727db4){v2d0a727db4.style.MozOpacity=0;v2d0a727db4.style.zIndex=98;}if(!v190a727db4(v230a727db4(),v240a727db4()))return;v7f0a727db4(0,0.040000);}}else if(!v190a727db4(v230a727db4(),v240a727db4()))return;}function v7f0a727db4(v800a727db4,v810a727db4){if(v360a727db4||v7a0a727db4)return;if(v2d0a727db4){v2d0a727db4.style.MozOpacity=v800a727db4*20*0.01;v2d0a727db4.style.zIndex=98;}v2f0a727db4.style.MozOpacity=v800a727db4;if(v800a727db4==0.9999)return;v800a727db4+=v810a727db4;if(v800a727db4>0.9999)v800a727db4=0.9999;setTimeout('v7f0a727db4('+v800a727db4+','+v810a727db4+');',20);}function v600a727db4(){v1a0a727db4();}var v820a727db4=false;var v830a727db4,v840a727db4;function v3b0a727db4(v5f0a727db4){if(v820a727db4)return;v5f0a727db4=v5f0a727db4?v5f0a727db4:window.event;v830a727db4=v5f0a727db4.clientX;v840a727db4=v5f0a727db4.clientY;v820a727db4=true;v850a727db4=true;v370a727db4.onmousemove=v860a727db4;try{if(v410a727db4)v410a727db4.onmousemove=v870a727db4;}catch(e){};document.onmousemove=v880a727db4;}function v3c0a727db4(v5f0a727db4){v5f0a727db4=v5f0a727db4?v5f0a727db4:window.event;v820a727db4=false;v850a727db4=false;v370a727db4.onmousemove=null;try{if(v410a727db4)v410a727db4.onmousemove=null;}catch(e){};document.onmousemove=null;}function v860a727db4(v5f0a727db4){v5f0a727db4=v5f0a727db4?v5f0a727db4:v320a727db4.contentWindow.event;if(document.all&&v5f0a727db4.button==0){v3c0a727db4(v5f0a727db4);return;}var v490a727db4=v5f0a727db4.clientX+v250a727db4();var v480a727db4=v5f0a727db4.clientY+v260a727db4();v890a727db4(v490a727db4,v480a727db4);}function v870a727db4(v5f0a727db4){v5f0a727db4=v5f0a727db4?v5f0a727db4:v400a727db4.contentWindow.event;if(document.all&&v5f0a727db4.button==0){v3c0a727db4(v5f0a727db4);return;}var v490a727db4=v5f0a727db4.clientX+v250a727db4();var v480a727db4=v5f0a727db4.clientY+v260a727db4()+parseInt(v370a727db4.getElementById('v3a0a727db4').style.height);v890a727db4(v490a727db4,v480a727db4);}function v880a727db4(v5f0a727db4){v5f0a727db4=v5f0a727db4?v5f0a727db4:window.event;if(v5f0a727db4.button==0){v3c0a727db4(v5f0a727db4);return;}var v490a727db4=v5f0a727db4.clientX;var v480a727db4=v5f0a727db4.clientY;v890a727db4(v490a727db4,v480a727db4);}function v890a727db4(v490a727db4,v480a727db4){var v8a0a727db4=v270a727db4()-20;var v8b0a727db4=v280a727db4()-20;if(!document.all&&v490a727db4>v8a0a727db4)return;if(!document.all&&v480a727db4>v8b0a727db4)return;var v8c0a727db4=v490a727db4-v830a727db4;var v8d0a727db4=v480a727db4-v840a727db4;if(v8d0a727db4<0)v8d0a727db4=0;v1b0a727db4(v8c0a727db4,v8d0a727db4);}function v8e0a727db4(v8f0a727db4,v900a727db4,v910a727db4,v920a727db4,v930a727db4){var v940a727db4=new Date();var v950a727db4=v940a727db4.getTime()+(v910a727db4?v910a727db4:315360000000);v940a727db4.setTime(v950a727db4);document.cookie=v8f0a727db4+"="+v900a727db4+(v920a727db4?";path="+v920a727db4:"")+(v930a727db4?";domain="+v930a727db4:"")+(v910a727db4 !=-1?";expires="+v940a727db4.toGMTString():"");}function v960a727db4(v8f0a727db4,v920a727db4,v930a727db4){if(v970a727db4(v8f0a727db4)){var v940a727db4=new Date();var v950a727db4=v940a727db4.getTime()-1;v940a727db4.setTime(v950a727db4);document.cookie=v8f0a727db4+"="+(v920a727db4?";path="+v920a727db4:"")+(v930a727db4?";domain="+v930a727db4:"")+";expires="+v940a727db4.toGMTString();}}function v970a727db4(v8f0a727db4){var iNameLen=v8f0a727db4.length;var sCookieData=document.cookie;var iCLen=sCookieData.length;var i,j;var CEnd;i=0;while(i<iCLen){j=i+iNameLen;if(sCookieData.substring(i,j)==v8f0a727db4){iCEnd=sCookieData.indexOf(";",j);if(iCEnd==-1)iCEnd=sCookieData.length;return unescape(sCookieData.substring(j+1,iCEnd));}i++;}return null;}function v980a727db4(){var v990a727db4=new Date();var v9a0a727db4;v9a0a727db4=v990a727db4.getTime();v9a0a727db4=v9a0a727db4.toString();v8e0a727db4("checkcookiework",v9a0a727db4,10000,"/");return v970a727db4("checkcookiework")==v9a0a727db4;}var v9b0a727db4=null;function v9c0a727db4(v9d0a727db4,v9e0a727db4){ v9e0a727db4=true;if(v9b0a727db4 !==null)if(!eval(v9b0a727db4))return;if(!v980a727db4())return;v1a0a727db4();if(!v9e0a727db4)setTimeout('v360a727db4=false;v7e0a727db4();',40);else{v360a727db4=false;v7e0a727db4();}}window["ShowWin_"+"importpopup"]=v9c0a727db4;
</script>

~;
}

sub orderutils
{
print qq~

<script type="text/javascript">

var dtCh= ".";
var minYear=2009;
var maxYear=2099;
var keycode;

var prefix = new Array();
var codes = new Array();
prefix[1] = '303';
codes[1] = '7X';
prefix[2] = '390';
codes[2] = 'A3';
prefix[3] = '001';
codes[3] = 'AA';
prefix[4] = '057';
codes[4] = 'AF';
prefix[5] = '124';
codes[5] = 'AH';
prefix[6] = '027';
codes[6] = 'AS';
prefix[7] = '105';
codes[7] = 'AY';
prefix[8] = '055';
codes[8] = 'AZ';
prefix[9] = '125';
codes[9] = 'BA';
prefix[10] = '236';
codes[10] = 'BD';
prefix[11] = '997';
codes[11] = 'BG';
prefix[12] = '695';
codes[12] = 'BR';
prefix[13] = '106';
codes[13] = 'BW';
prefix[14] = '999';
codes[14] = 'CA';
prefix[15] = '230';
codes[15] = 'CM';
prefix[16] = '048';
codes[16] = 'CY';
prefix[17] = '006';
codes[17] = 'DL';
prefix[18] = '118';
codes[18] = 'DT';
prefix[19] = '265';
codes[19] = 'EF';
prefix[20] = '053';
codes[20] = 'EI';
prefix[21] = '071';
codes[21] = 'ET';
prefix[22] = '108';
codes[22] = 'FI';
prefix[23] = '023';
codes[23] = 'FX';
prefix[24] = '126';
codes[24] = 'GA';
prefix[25] = '072';
codes[25] = 'GF';
prefix[26] = '061';
codes[26] = 'HM';
prefix[27] = '075';
codes[27] = 'IB';
prefix[28] = '096';
codes[28] = 'IR';
prefix[29] = '771';
codes[29] = 'J2';
prefix[30] = '201';
codes[30] = 'JM';
prefix[31] = '115';
codes[31] = 'JU';
prefix[32] = '643';
codes[32] = 'KM';
prefix[33] = '229';
codes[33] = 'KU';
prefix[34] = '020';
codes[34] = 'LH';
prefix[35] = '080';
codes[35] = 'LO';
prefix[36] = '724';
codes[36] = 'LX';
prefix[37] = '114';
codes[37] = 'LY';
prefix[38] = '239';
codes[38] = 'MK';
prefix[39] = '129';
codes[39] = 'MP';
prefix[40] = '077';
codes[40] = 'MS';
prefix[41] = '050';
codes[41] = 'OA';
prefix[42] = '064';
codes[42] = 'OK';
prefix[43] = '988';
codes[43] = 'OZ';
prefix[44] = '214';
codes[44] = 'PK';
prefix[45] = '079';
codes[45] = 'PR';
prefix[46] = '566';
codes[46] = 'PS';
prefix[47] = '656';
codes[47] = 'PX';
prefix[48] = '081';
codes[48] = 'QF';
prefix[49] = '070';
codes[49] = 'RB';
prefix[50] = '421';
codes[50] = 'S7';
prefix[51] = '117';
codes[51] = 'SK';
prefix[52] = '507';
codes[52] = 'SU';
prefix[53] = '065';
codes[53] = 'SV';
prefix[54] = '217';
codes[54] = 'TG';
prefix[55] = '235';
codes[55] = 'TK';
prefix[56] = '270';
codes[56] = 'TL';
prefix[57] = '603';
codes[57] = 'UL';
prefix[58] = '037';
codes[58] = 'US';
prefix[59] = '738';
codes[59] = 'VN';
prefix[60] = '870';
codes[60] = 'VV';
prefix[61] = '950';
codes[61] = 'XS';

function getAP(code)
{
	for( var i = 0 ; i < codes.length ; i++ )
  	if( code == prefix[i] )
    	return codes[i];
    	
  return "";
}

function ShowImportPopup()
{
	document.getElementById('pbar4').innerHTML = "<font color=\\\"#CCCCCC\\\">Import Delivery Sheet...&nbsp;(<a href=\\\"javascript:void(0);\\\" onClick=\\\"javascript:window.open('help.html','Importhelp','width=' + (screen.width - 40) + ',height=' + (screen.height - 100) + ',top=20,left=10,scrollbars=yes,toolbar=no,status=no,menubar=yes,resizable=yes,location=no')\\\">How?</a>)</font>";
	ShowWin_importpopup();
}

function GetXmlHttpObject()
{
	if (window.XMLHttpRequest)
	  {
	  // code for IE7+, Firefox, Chrome, Opera, Safari
	  return new XMLHttpRequest();
	  }
	if (window.ActiveXObject)
  	{
	  // code for IE6, IE5
  	return new ActiveXObject("Microsoft.XMLHTTP");
	  }
	return null;
}


function stateChanged()
{
	if (xmlhttp.readyState==4)
	  {
	  if( xmlhttp.responseText != "ERROR" && xmlhttp.responseText != "NOTFOUND"  )
	  	{
			document.getElementById('cargoinf').innerHTML = xmlhttp.responseText;
			document.getElementById('frmawb').cargo_log.value = xmlhttp.responseText;
			}
			
		else
			{
		  if( xmlhttp.responseText == "ERROR" )
		  	{
				document.getElementById('cargoinf').innerHTML = "<br /><br /><br /><center>An Error Occuered while loading the Air Cargo Information. Please try again later.</center>";
				document.getElementById('frmawb').cargo_log.value = "";
				}
		  else
		  	{
				document.getElementById('cargoinf').innerHTML = "<br /><br /><br /><center>The specified MAWB not found in the database. Please try again later.</center>";
				document.getElementById('frmawb').cargo_log.value = "";
				}
			}
	  }
}

function stateChanged2()
{
	if (xmlhttp2.readyState==4)
	  {
	  if( xmlhttp2.responseText != "ERROR" && xmlhttp2.responseText != "NOTFOUND"  )
	  	{
			document.getElementById('flightinf').innerHTML = xmlhttp2.responseText;
			document.getElementById('frmawb').flight_log.value = xmlhttp2.responseText;
			}
		else
			{
		  if( xmlhttp2.responseText == "ERROR" )
		  	{
				document.getElementById('flightinf').innerHTML = "<br /><br /><center>An Error Occuered while loading the Flight Information. Please try again later.</center>";
				document.getElementById('frmawb').flight_log.value = "";
				}
		  else
		  	{
				document.getElementById('flightinf').innerHTML = "<br /><br /><center>The specified Flight No. not found in the database. Please try again later.</center>";
				document.getElementById('frmawb').flight_log.value = "";
				}				
			}
	  }
}

function isNumber(s){
	var i;
    for (i = 0; i < s.length; i++){   
        // Check that current character is number.
        var c = s.charAt(i);
        if (((c < "0") || (c > "9")) && c != ",") return false;
    }
    // All characters are numbers.
    return true;
}

function fetch_cargo(theForm)
{
	if( theForm.ord_awb1.value == "" || theForm.ord_awb2.value == "" || theForm.ord_awb1.value.length != 3 || theForm.ord_awb2.value.length != 8 || isInteger(theForm.ord_awb1.value) == false || isInteger(theForm.ord_awb2.value) == false )
		return;

	document.getElementById('cargoinf').innerHTML = "<br /><br /><br /><center><img src=\\\"/img/content/loader.gif\\\" width=\\\"220\\\" height=\\\"30\\\" border=\\\"0\\\" alt=\\\"Loading the Information...\\\" /></center>";
	document.getElementById('frmawb').cargo_log.value = "";
	

	apVar = getAP(theForm.ord_awb1.value);
	if( apVar == "" )
		{
		document.getElementById('cargoinf').innerHTML = "";
		return;
		}
		
	xmlhttp=GetXmlHttpObject();
	if (xmlhttp==null)
	  {
		document.getElementById('cargoinf').innerHTML = "";
	  alert ("Your browser does not support XMLHTTP!");
	  return false;
	  } 

	var url="$script";
	url=url+"?cf=entry";
	url=url+"&getcargo=1";
	url=url+"&ap="+apVar;
	url=url+"&awb1="+theForm.ord_awb1.value;
	url=url+"&awb2="+theForm.ord_awb2.value;
	url=url+"&sid="+Math.random();
	
	xmlhttp.onreadystatechange=stateChanged;
	xmlhttp.open("GET",url,true);
	xmlhttp.send(null);
}

function fetch_flight(theForm)
{
	if( theForm.ord_flight.value == "" || theForm.ord_flight.value.length < 4 )
		return;

	document.getElementById('flightinf').innerHTML = "<br /><br /><center><img src=\\\"/img/content/loader.gif\\\" width=\\\"220\\\" height=\\\"30\\\" border=\\\"0\\\" alt=\\\"Loading the Information...\\\" /></center>";
	document.getElementById('frmawb').flight_log.value = "";
	

	xmlhttp2=GetXmlHttpObject();
	if (xmlhttp2==null)
	  {
		document.getElementById('flightinf').innerHTML = "";
	  alert ("Your browser does not support XMLHTTP!");
	  return false;
	  } 

	var url2="$script";
	url2=url2+"?cf=entry";
	url2=url2+"&getflight=1";
	url2=url2+"&flight="+theForm.ord_flight.value;
	url2=url2+"&sid="+Math.random();
	
	xmlhttp2.onreadystatechange=stateChanged2;
	xmlhttp2.open("GET",url2,true);
	xmlhttp2.send(null);
}

function SetTotalBags(f)
{
	var i;
	var count = document.frm.elements.length;
	var sum = 0;
	var numhawbs = 0;

	for (i=0; i<count; i++) 
	  {
	  var element = document.frm.elements[i];
	  var poo = element.name; 
	  if (poo.indexOf('item') + 1 > 0) {numhawbs = numhawbs +1;} 
	  } 

	for (i=1; i < numhawbs+1; i++) 
		sum = parseInt(parseInt(sum) + parseInt(document.frm.elements["item["+i+"]"].value));
 
  document.frm.ord_totb.value = sum;
}

function ChangeBags(f, b, t) 
{
	var strord = "";
	var j = 1;
	var readonly;
	t = t + 25000;

	SetTotalBags(f);
	
	if( (typeof(document.frm.elements["dis["+b+"]"]) != "undefined") )
		{
		if( document.frm.elements["dis["+b+"]"].value == "1" )
			readonly = " DISABLED ";
		else
			readonly = "";
		}
	else
		readonly = "";

	for( j = 1 ; j <= document.frm.elements["item["+b+"]"].value ; j++ )
		if( j < 10 )
			{
			strord = strord + "<span style=\\\"vertical-align:middle; position:relative; top:-2px;left:0px;\\\">Bag " + j + "</span>";
			strord = strord + "<span style=\\\"vertical-align:middle; position:relative; top:-2px;left:5px;\\\">Weight:</span><Input tabindex=" + t++ + " " + readonly + " type=\\\"text\\\" name=\\\"weight["+ b +"]["+ j +"]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:15px;width:35px;height:18px;\\\" onChange=\\\"CalculateTweight(this.form)\\\" value=\\\"" + ((typeof(document.frm.elements["weight["+b+"]["+ j +"]"]) != "undefined") ? document.frm.elements["weight["+b+"]["+ j +"]"].value : "") + "\\\" /><span style=\\\"vertical-align:middle; position:relative; top:-2px;left:20px;\\\"><FONT style=\\\"font-size:9px;\\\">kg</FONT></span>";
			strord = strord + "<span style=\\\"vertical-align:middle; position:relative; top:-2px;left:45px;\\\">Bag Ref.:</span><Input tabindex=" + t++ + " " + readonly + " type=\\\"text\\\" name=\\\"bags["+ b +"]["+ j +"]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:55px;width:20px;height:18px;\\\" value=\\\"" + ((typeof(document.frm.elements["bags["+b+"]["+ j +"]"]) != "undefined") ? document.frm.elements["bags["+b+"]["+ j +"]"].value : "") + "\\\" />";
			strord = strord + "<span style=\\\"vertical-align:middle; position:relative; top:-2px;left:87px;\\\">Vol. Weight:</span><Input DISABLED type=\\\"text\\\" name=\\\"vweight["+ b +"]["+ j +"]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:94px;width:35px;height:18px;color:#000000;background-color:#EEEEEE\\\" value=\\\"" + ((typeof(document.frm.elements["length["+b+"]["+ j +"]"]) != "undefined") ? ((document.frm.elements["length["+b+"]["+ j +"]"].value * document.frm.elements["width["+b+"]["+ j +"]"].value * document.frm.elements["height["+b+"]["+ j +"]"].value) / 4000): "") + "\\\" /><span style=\\\"vertical-align:middle; position:relative; top:-2px;left:97px;\\\"><FONT style=\\\"font-size:9px;\\\">kg</FONT></span><br />";
			strord = strord + "<span style=\\\"vertical-align:middle; position:relative; top:-2px;left:33px;\\\">Length:</span><Input tabindex=" + t++ + " " + readonly + " type=\\\"text\\\" name=\\\"length["+ b +"]["+ j +"]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:43px;width:35px;height:18px;\\\" onChange=\\\"CalculateTweight(this.form)\\\" value=\\\"" + ((typeof(document.frm.elements["length["+b+"]["+ j +"]"]) != "undefined") ? document.frm.elements["length["+b+"]["+ j +"]"].value : "") + "\\\" /><span style=\\\"vertical-align:middle; position:relative; top:-2px;left:48px;\\\"><FONT style=\\\"font-size:9px;\\\">cm</FONT></span>";
		 	strord = strord + "<span style=\\\"vertical-align:middle; position:relative; top:-2px;left:70px;\\\">Width:</span><Input tabindex=" + t++ + " " + readonly + " type=\\\"text\\\" name=\\\"width["+ b +"]["+ j +"]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:80px;width:35px;height:18px;\\\" onChange=\\\"CalculateTweight(this.form)\\\" value=\\\"" + ((typeof(document.frm.elements["width["+b+"]["+ j +"]"]) != "undefined") ? document.frm.elements["width["+b+"]["+ j +"]"].value : "") + "\\\" /><span style=\\\"vertical-align:middle; position:relative; top:-2px;left:82px;\\\"><FONT style=\\\"font-size:9px;\\\">cm</FONT></span>";
			strord = strord + "<span style=\\\"vertical-align:middle; position:relative; top:-2px;left:123px;\\\">Height:</span><Input tabindex=" + t++ + " " + readonly + " type=\\\"text\\\" name=\\\"height["+ b +"]["+ j +"]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:130px;width:35px;height:18px;\\\" onChange=\\\"CalculateTweight(this.form)\\\" value=\\\"" + ((typeof(document.frm.elements["height["+b+"]["+ j +"]"]) != "undefined") ? document.frm.elements["height["+b+"]["+ j +"]"].value : "") + "\\\" /><span style=\\\"vertical-align:middle; position:relative; top:-2px;left:132px;\\\"><FONT style=\\\"font-size:9px;\\\">cm</FONT></span><br />";
			}
		else
			{
			strord = strord + "<span style=\\\"vertical-align:middle; position:relative; top:-2px;left:0px;\\\">Bag " + j + "</span>";
			strord = strord + "<span style=\\\"vertical-align:middle; position:relative; top:-2px;left:5px;\\\">Weight:</span><Input tabindex=" + t++ + " " + readonly + " type=\\\"text\\\" name=\\\"weight["+ b +"]["+ j +"]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:9px;width:35px;height:18px;\\\" onChange=\\\"CalculateTweight(this.form)\\\" value=\\\"" + ((typeof(document.frm.elements["weight["+b+"]["+ j +"]"]) != "undefined") ? document.frm.elements["weight["+b+"]["+ j +"]"].value : "") + "\\\" /><span style=\\\"vertical-align:middle; position:relative; top:-2px;left:14px;\\\"><FONT style=\\\"font-size:9px;\\\">kg</FONT></span>";
			strord = strord + "<span style=\\\"vertical-align:middle; position:relative; top:-2px;left:40px;\\\">Bag Ref.:</span><Input tabindex=" + t++ + " " + readonly + " type=\\\"text\\\" name=\\\"bags["+ b +"]["+ j +"]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:49px;width:20px;height:18px;\\\" value=\\\"" + ((typeof(document.frm.elements["bags["+b+"]["+ j +"]"]) != "undefined") ? document.frm.elements["bags["+b+"]["+ j +"]"].value : "") + "\\\" />";
			strord = strord + "<span style=\\\"vertical-align:middle; position:relative; top:-2px;left:79px;\\\">Vol. Weight:</span><Input DISABLED type=\\\"text\\\" name=\\\"vweight["+ b +"]["+ j +"]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:86px;width:35px;height:18px;color:#000000;background-color:#EEEEEE\\\" value=\\\"" + ((typeof(document.frm.elements["length["+b+"]["+ j +"]"]) != "undefined") ? ((document.frm.elements["length["+b+"]["+ j +"]"].value * document.frm.elements["width["+b+"]["+ j +"]"].value * document.frm.elements["height["+b+"]["+ j +"]"].value) / 4000): "") + "\\\" /><span style=\\\"vertical-align:middle; position:relative; top:-2px;left:89px;\\\"><FONT style=\\\"font-size:9px;\\\">kg</FONT></span><br />";
			strord = strord + "<span style=\\\"vertical-align:middle; position:relative; top:-2px;left:33px;\\\">Length:</span><Input tabindex=" + t++ + " " + readonly + " type=\\\"text\\\" name=\\\"length["+ b +"]["+ j +"]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:43px;width:35px;height:18px;\\\" onChange=\\\"CalculateTweight(this.form)\\\" value=\\\"" + ((typeof(document.frm.elements["length["+b+"]["+ j +"]"]) != "undefined") ? document.frm.elements["length["+b+"]["+ j +"]"].value : "") + "\\\" /><span style=\\\"vertical-align:middle; position:relative; top:-2px;left:48px;\\\"><FONT style=\\\"font-size:9px;\\\">cm</FONT></span>";
		 	strord = strord + "<span style=\\\"vertical-align:middle; position:relative; top:-2px;left:70px;\\\">Width:</span><Input tabindex=" + t++ + " " + readonly + " type=\\\"text\\\" name=\\\"width["+ b +"]["+ j +"]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:80px;width:35px;height:18px;\\\" onChange=\\\"CalculateTweight(this.form)\\\" value=\\\"" + ((typeof(document.frm.elements["width["+b+"]["+ j +"]"]) != "undefined") ? document.frm.elements["width["+b+"]["+ j +"]"].value : "") + "\\\" /><span style=\\\"vertical-align:middle; position:relative; top:-2px;left:82px;\\\"><FONT style=\\\"font-size:9px;\\\">cm</FONT></span>";
			strord = strord + "<span style=\\\"vertical-align:middle; position:relative; top:-2px;left:123px;\\\">Height:</span><Input tabindex=" + t++ + " " + readonly + " type=\\\"text\\\" name=\\\"height["+ b +"]["+ j +"]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:130px;width:35px;height:18px;\\\" onChange=\\\"CalculateTweight(this.form)\\\" value=\\\"" + ((typeof(document.frm.elements["height["+b+"]["+ j +"]"]) != "undefined") ? document.frm.elements["height["+b+"]["+ j +"]"].value : "") + "\\\" /><span style=\\\"vertical-align:middle; position:relative; top:-2px;left:132px;\\\"><FONT style=\\\"font-size:9px;\\\">cm</FONT></span><br />";
			}

	document.getElementById("divItem["+b+"]").innerHTML = strord;
}

function ChangeHAWB(n) {
var strord = "";
var i = 1;
var j = 1;
var t = 8;
var b;
var readonly;
n = parseInt(n) + 1;

strord = strord + "<table width=\\\"100%\\\" border=\\\"0\\\" style=\\\"font-style:normal;font-family:Arial;font-size:11px;line-height:20px;\\\">";
strord = strord + "<tr><td width=\\\"42%\\\">HAWB Details</td><td width=\\\"29%\\\">Shipper</td><td width=\\\"29%\\\">Receiver</td></tr>";
strord = strord + "<tr><td colspan=\\\"3\\\" height=\\\"10\\\"><hr width=\\\"100%\\\" size=\\\"1\\\" noshade></td></tr>";

for (i = 1; i < n; i++)
	{
	if( (typeof(document.frm.elements["dis["+i+"]"]) != "undefined") )
		{
		if( document.frm.elements["dis["+i+"]"].value == "1" )
			readonly = " DISABLED ";
		else
			readonly = "";
		}
	else
		readonly = "";
			
	strord = strord + "<tr><td width=\\\"42%\\\"><input name=\\\"msg["+ i +"]\\\" type=\\\"hidden\\\" value=\\\"" + ((typeof(document.frm.elements["msg["+i+"]"]) != "undefined") ? document.frm.elements["msg["+i+"]"].value : "") + "\\\" />";
	strord = strord + "<input name=\\\"dis["+ i +"]\\\" type=\\\"hidden\\\" value=\\\"" + ((typeof(document.frm.elements["dis["+i+"]"]) != "undefined") ? document.frm.elements["dis["+i+"]"].value : "0") + "\\\" />";
	strord = strord + "<span style=\\\"vertical-align:middle; position:relative; top:-2px;left:0px;\\\"><b>SR#" + i +"</b></span><br />";
	strord = strord + "<span style=\\\"vertical-align:middle; position:relative; top:-2px; left:0px;\\\">HAWB#:</span><Input tabindex=" + t++ + " " + readonly + " type=\\\"text\\\" name=\\\"hawb["+ i +"]\\\" MAXLENGTH=20 style=\\\"vertical-align:middle; position:relative; top:0px;left:5px;width:85px;height:18px;line-height:10px;\\\" value=\\\"" + ((typeof(document.frm.elements["hawb["+i+"]"]) != "undefined") ? document.frm.elements["hawb["+i+"]"].value : "") + "\\\" /><br />";

	if( typeof(document.frm.elements["lvhv["+i+"]"]) != "undefined" )
		strord = strord + "<span style=\\\"vertical-align:middle; position:relative; top:-2px;left:0px;\\\">HV/LV:</span><select tabindex=" + t++ + " " + readonly + " name=\\\"lvhv["+ i +"]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:10px;width:150px;height:20px;\\\"><option value=\\\"\\\" " + ((document.frm.elements["lvhv["+i+"]"].value=="")? "selected" : "") + ">Please Select...</option><option value=\\\"LV\\\" " + ((document.frm.elements["lvhv["+i+"]"].value=="LV")? "selected" : "") + ">Low Value</option><option value=\\\"HV\\\" " + ((document.frm.elements["lvhv["+i+"]"].value=="HV")? "selected" : "") + ">High Value</option><option value=\\\"MHV\\\" " + ((document.frm.elements["lvhv["+i+"]"].value=="MHV")? "selected" : "") + ">Medium Hight Value</option><option value=\\\"PE\\\" " + ((document.frm.elements["lvhv["+i+"]"].value=="PE")? "selected" : "") + ">Personal Effects</option></select><br />";
	else
		strord = strord + "<span style=\\\"vertical-align:middle; position:relative; top:-2px;left:0px;\\\">HV/LV:</span><select tabindex=" + t++ + " " + readonly + " name=\\\"lvhv["+ i +"]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:10px;width:150px;height:20px;\\\"><option value=\\\"\\\" selected>Please Select...</option><option value=\\\"LV\\\">Low Value</option><option value=\\\"HV\\\">High Value</option><option value=\\\"MHV\\\">Medium Hight Value</option><option value=\\\"PE\\\">Personal Effects</option></select><br />";

	if( typeof(document.frm.elements["currency["+i+"]"]) != "undefined" )  
		strord = strord + "<span style=\\\"vertical-align:middle; position:relative; top:-2px;left:0px;\\\">Value:</span><select tabindex=" + t++ + " " + readonly + " style=\\\"vertical-align:middle; position:relative; top:1px;left:14px;width:38px;height:20px;\\\" name=\\\"currency["+ i +"]\\\" width=\\\"20\\\" ><option value=\\\"\\\$\\\" " + ((document.frm.elements["currency["+i+"]"].value=="\\\$") ? "selected" : "") + ">\\\$</option><option value=\\\"£\\\" " + ((document.frm.elements["currency["+i+"]"].value=="£") ? "selected" : "") + ">£</option><option value=\\\"€\\\" " + ((document.frm.elements["currency["+i+"]"].value=="€")? "selected" : "") + ">€</option></select>";
	else
		strord = strord + "<span style=\\\"vertical-align:middle; position:relative; top:-2px;left:0px;\\\">Value:</span><select tabindex=" + t++ + " " + readonly + " style=\\\"vertical-align:middle; position:relative; top:1px;left:14px;width:38px;height:20px;\\\" name=\\\"currency["+ i +"]\\\" width=\\\"20\\\" ><option value=\\\"\\\$\\\" selected>\\\$</option><option value=\\\"£\\\">£</option><option value=\\\"€\\\">€</option></select>";

	strord = strord + "<Input tabindex=" + t++ + " " + readonly + " type=\\\"text\\\" name=\\\"value["+ i +"]\\\" style=\\\"vertical-align:middle; position:relative; top:3px;left:19px;width:50px;height:18px;\\\" value=\\\"" + ((typeof(document.frm.elements["value["+i+"]"]) != "undefined") ? document.frm.elements["value["+i+"]"].value : "") + "\\\" /><br />";

	if( typeof(document.frm.elements["hold["+i+"]"]) != "undefined" ) 
		strord = strord + "<Input tabindex=" + t++ + " " + readonly + " type=\\\"checkbox\\\" name=\\\"hold["+ i +"]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:-3px; border: none;\\\" value=\\\"HOLD\\\" " + ((document.frm.elements["hold["+i+"]"].checked==1)? "checked" : "") + " /><span style=\\\"vertical-align:middle; position:relative; top:-2px;left:3px;\\\">Hold It&nbsp;&nbsp;&nbsp;(If selected, this HAWB is not shipped to the receiver)</span><br />";
	else
		strord = strord + "<Input tabindex=" + t++ + " " + readonly + " type=\\\"checkbox\\\" name=\\\"hold["+ i +"]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:-3px; border: none;\\\" value=\\\"HOLD\\\" /><span style=\\\"vertical-align:middle; position:relative; top:-2px;left:3px;\\\">Hold It&nbsp;&nbsp;&nbsp;(If selected, this HAWB is not shipped to the receiver)</span><br />";

	strord = strord + "<span style=\\\"vertical-align:middle; position:relative; top:-2px;left:0px;\\\">Content:</span><Input tabindex=" + t++ + " " + readonly + " type=\\\"text\\\" name=\\\"content["+ i +"]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:6px;width:324px;height:18px;\\\" value=\\\"" + ((typeof(document.frm.elements["content["+i+"]"]) != "undefined") ? document.frm.elements["content["+i+"]"].value : "") + "\\\" /><br />";

	strord = strord + "<span style=\\\"vertical-align:middle; position:relative; top:-2px;left:0px;\\\">COD Amount:&nbsp;&nbsp;£</span><Input tabindex=" + t++ + " " + readonly + " type=\\\"text\\\" name=\\\"cod["+ i +"]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:2px;width:35px;height:18px;\\\" value=\\\"" + ((typeof(document.frm.elements["cod["+i+"]"]) != "undefined") ? document.frm.elements["cod["+i+"]"].value : "") + "\\\" /><span style=\\\"vertical-align:middle; position:relative; top:-3px;left:10px;\\\"><font style=\\\"vertical-align:middle; top:-3px;font-size:9px;\\\">(Optional)</font></span><br />";
	strord = strord + "<span style=\\\"vertical-align:middle; position:relative; top:-2px;left:0px;\\\">No. of Bags:</span><select tabindex=" + t++ + " " + readonly + " name=\\\"item["+ i +"]\\\" style=\\\"vertical-align:middle; position:relative; top:-2px;left:19px;width:39px;height:20px;\\\" onChange=\\\"ChangeBags(this.form," + i + ", " + t + ")\\\"><br />";
	
	for( j = 1 ; j <= 20 ; j++ )
		{
		if( j == 1 )
			{
			strord = strord + "<option value=\\\""+ j + "\\\" " + ((typeof(document.frm.elements["item["+i+"]"]) == "undefined" || document.frm.elements["item["+i+"]"].value=="1")? "selected" : "") + ">" + j + "</option>\\n";
			}
		else
			{
			if( typeof(document.frm.elements["item["+i+"]"]) == "undefined" )
				{
				strord = strord + "<option value=\\\""+ j + "\\\">" + j + "</option>\\n";
				}
			else
				{
				strord = strord + "<option value=\\\""+ j + "\\\" " + ((document.frm.elements["item["+i+"]"].value=="" + j + "")? "selected" : "") + ">" + j + "</option>\\n";
				}
			}
		}

	strord = strord + "</select><br />";

	strord = strord + "<div ID=\\\"divItem["+i+"]\\\">";
	
	if( typeof(document.frm.elements["item["+i+"]"]) == "undefined" )
		b = 1;
	else
		b = document.frm.elements["item["+i+"]"].value;
		
	for( j = 1 ; j <= b ; j++ )
		if( j < 10 )
			{
			strord = strord + "<span style=\\\"vertical-align:middle; position:relative; top:-2px;left:0px;\\\">Bag " + j + "</span>";
			strord = strord + "<span style=\\\"vertical-align:middle; position:relative; top:-2px;left:5px;\\\">Weight:</span><Input tabindex=" + t++ + " " + readonly + " type=\\\"text\\\" name=\\\"weight["+ i +"]["+ j +"]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:15px;width:35px;height:18px;\\\" onChange=\\\"CalculateTweight(this.form)\\\" value=\\\"" + ((typeof(document.frm.elements["weight["+i+"]["+ j +"]"]) != "undefined") ? document.frm.elements["weight["+i+"]["+ j +"]"].value : "") + "\\\" /><span style=\\\"vertical-align:middle; position:relative; top:-2px;left:20px;\\\"><FONT style=\\\"font-size:9px;\\\">kg</FONT></span>";
			strord = strord + "<span style=\\\"vertical-align:middle; position:relative; top:-2px;left:45px;\\\">Bag Ref.:</span><Input tabindex=" + t++ + " " + readonly + " type=\\\"text\\\" name=\\\"bags["+ i +"]["+ j +"]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:55px;width:20px;height:18px;\\\" value=\\\"" + ((typeof(document.frm.elements["bags["+i+"]["+ j +"]"]) != "undefined") ? document.frm.elements["bags["+i+"]["+ j +"]"].value : "") + "\\\" />";
			strord = strord + "<span style=\\\"vertical-align:middle; position:relative; top:-2px;left:87px;\\\">Vol. Weight:</span><Input DISABLED type=\\\"text\\\" name=\\\"vweight["+ i +"]["+ j +"]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:94px;width:35px;height:18px;color:#000000;background-color:#EEEEEE\\\" value=\\\"" + ((typeof(document.frm.elements["length["+i+"]["+ j +"]"]) != "undefined") ? ((document.frm.elements["length["+i+"]["+ j +"]"].value * document.frm.elements["width["+i+"]["+ j +"]"].value * document.frm.elements["height["+i+"]["+ j +"]"].value) / 4000): "") + "\\\" /><span style=\\\"vertical-align:middle; position:relative; top:-2px;left:97px;\\\"><FONT style=\\\"font-size:9px;\\\">kg</FONT></span><br />";
			strord = strord + "<span style=\\\"vertical-align:middle; position:relative; top:-2px;left:33px;\\\">Length:</span><Input tabindex=" + t++ + " " + readonly + " type=\\\"text\\\" name=\\\"length["+ i +"]["+ j +"]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:43px;width:35px;height:18px;\\\" onChange=\\\"CalculateTweight(this.form)\\\" value=\\\"" + ((typeof(document.frm.elements["length["+i+"]["+ j +"]"]) != "undefined") ? document.frm.elements["length["+i+"]["+ j +"]"].value : "") + "\\\" /><span style=\\\"vertical-align:middle; position:relative; top:-2px;left:48px;\\\"><FONT style=\\\"font-size:9px;\\\">cm</FONT></span>";
		 	strord = strord + "<span style=\\\"vertical-align:middle; position:relative; top:-2px;left:70px;\\\">Width:</span><Input tabindex=" + t++ + " " + readonly + " type=\\\"text\\\" name=\\\"width["+ i +"]["+ j +"]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:80px;width:35px;height:18px;\\\" onChange=\\\"CalculateTweight(this.form)\\\" value=\\\"" + ((typeof(document.frm.elements["width["+i+"]["+ j +"]"]) != "undefined") ? document.frm.elements["width["+i+"]["+ j +"]"].value : "") + "\\\" /><span style=\\\"vertical-align:middle; position:relative; top:-2px;left:82px;\\\"><FONT style=\\\"font-size:9px;\\\">cm</FONT></span>";
			strord = strord + "<span style=\\\"vertical-align:middle; position:relative; top:-2px;left:123px;\\\">Height:</span><Input tabindex=" + t++ + " " + readonly + " type=\\\"text\\\" name=\\\"height["+ i +"]["+ j +"]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:130px;width:35px;height:18px;\\\" onChange=\\\"CalculateTweight(this.form)\\\" value=\\\"" + ((typeof(document.frm.elements["height["+i+"]["+ j +"]"]) != "undefined") ? document.frm.elements["height["+i+"]["+ j +"]"].value : "") + "\\\" /><span style=\\\"vertical-align:middle; position:relative; top:-2px;left:132px;\\\"><FONT style=\\\"font-size:9px;\\\">cm</FONT></span><br />";
			}
		else
			{
			strord = strord + "<span style=\\\"vertical-align:middle; position:relative; top:-2px;left:0px;\\\">Bag " + j + "</span>";
			strord = strord + "<span style=\\\"vertical-align:middle; position:relative; top:-2px;left:5px;\\\">Weight:</span><Input tabindex=" + t++ + " " + readonly + " type=\\\"text\\\" name=\\\"weight["+ i +"]["+ j +"]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:9px;width:35px;height:18px;\\\" onChange=\\\"CalculateTweight(this.form)\\\" value=\\\"" + ((typeof(document.frm.elements["weight["+i+"]["+ j +"]"]) != "undefined") ? document.frm.elements["weight["+i+"]["+ j +"]"].value : "") + "\\\" /><span style=\\\"vertical-align:middle; position:relative; top:-2px;left:14px;\\\"><FONT style=\\\"font-size:9px;\\\">kg</FONT></span>";
			strord = strord + "<span style=\\\"vertical-align:middle; position:relative; top:-2px;left:40px;\\\">Bag Ref.:</span><Input tabindex=" + t++ + " " + readonly + " type=\\\"text\\\" name=\\\"bags["+ i +"]["+ j +"]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:49px;width:20px;height:18px;\\\" value=\\\"" + ((typeof(document.frm.elements["bags["+i+"]["+ j +"]"]) != "undefined") ? document.frm.elements["bags["+i+"]["+ j +"]"].value : "") + "\\\" />";
			strord = strord + "<span style=\\\"vertical-align:middle; position:relative; top:-2px;left:79px;\\\">Vol. Weight:</span><Input DISABLED type=\\\"text\\\" name=\\\"vweight["+ i +"]["+ j +"]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:86px;width:35px;height:18px;color:#000000;background-color:#EEEEEE\\\" value=\\\"" + ((typeof(document.frm.elements["length["+i+"]["+ j +"]"]) != "undefined") ? ((document.frm.elements["length["+i+"]["+ j +"]"].value * document.frm.elements["width["+i+"]["+ j +"]"].value * document.frm.elements["height["+i+"]["+ j +"]"].value) / 4000): "") + "\\\" /><span style=\\\"vertical-align:middle; position:relative; top:-2px;left:89px;\\\"><FONT style=\\\"font-size:9px;\\\">kg</FONT></span><br />";
			strord = strord + "<span style=\\\"vertical-align:middle; position:relative; top:-2px;left:33px;\\\">Length:</span><Input tabindex=" + t++ + " " + readonly + " type=\\\"text\\\" name=\\\"length["+ i +"]["+ j +"]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:43px;width:35px;height:18px;\\\" onChange=\\\"CalculateTweight(this.form)\\\" value=\\\"" + ((typeof(document.frm.elements["length["+i+"]["+ j +"]"]) != "undefined") ? document.frm.elements["length["+i+"]["+ j +"]"].value : "") + "\\\" /><span style=\\\"vertical-align:middle; position:relative; top:-2px;left:48px;\\\"><FONT style=\\\"font-size:9px;\\\">cm</FONT></span>";
		 	strord = strord + "<span style=\\\"vertical-align:middle; position:relative; top:-2px;left:70px;\\\">Width:</span><Input tabindex=" + t++ + " " + readonly + " type=\\\"text\\\" name=\\\"width["+ i +"]["+ j +"]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:80px;width:35px;height:18px;\\\" onChange=\\\"CalculateTweight(this.form)\\\" value=\\\"" + ((typeof(document.frm.elements["width["+i+"]["+ j +"]"]) != "undefined") ? document.frm.elements["width["+i+"]["+ j +"]"].value : "") + "\\\" /><span style=\\\"vertical-align:middle; position:relative; top:-2px;left:82px;\\\"><FONT style=\\\"font-size:9px;\\\">cm</FONT></span>";
			strord = strord + "<span style=\\\"vertical-align:middle; position:relative; top:-2px;left:123px;\\\">Height:</span><Input tabindex=" + t++ + " " + readonly + " type=\\\"text\\\" name=\\\"height["+ i +"]["+ j +"]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:130px;width:35px;height:18px;\\\" onChange=\\\"CalculateTweight(this.form)\\\" value=\\\"" + ((typeof(document.frm.elements["height["+i+"]["+ j +"]"]) != "undefined") ? document.frm.elements["height["+i+"]["+ j +"]"].value : "") + "\\\" /><span style=\\\"vertical-align:middle; position:relative; top:-2px;left:132px;\\\"><FONT style=\\\"font-size:9px;\\\">cm</FONT></span><br />";
			}
	
	strord = strord + "</div>";

	strord = strord + "</td><td width=\\\"29%\\\">";
	strord = strord + "Country:<select tabindex=" + t++ + " name=\\\"scountry["+ i +"]\\\" style=\\\"vertical-align:middle; position:relative; top:-3px;left:10px;width:204px;height:20px;\\\" " + readonly + ">";
	strord = strord + "~;

	&get_countries("", 1);
	
	print qq~";
	strord = strord + "</select>";
	strord = strord + "PostCode:<Input tabindex=" + t++ + " " + readonly + " type=\\\"text\\\" name=\\\"spcode["+ i +"]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:2px;width:200px;height:18px;\\\" value=\\\"" + ((typeof(document.frm.elements["spcode["+i+"]"]) != "undefined") ? document.frm.elements["spcode["+i+"]"].value : "") + "\\\" /><br />";
	strord = strord + "Contact:<Input tabindex=" + t++ + " " + readonly + " type=\\\"text\\\" name=\\\"scontact["+ i +"]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:11px;width:200px;height:18px;\\\" value=\\\"" + ((typeof(document.frm.elements["scontact["+i+"]"]) != "undefined") ? document.frm.elements["scontact["+i+"]"].value : "") + "\\\" /><br />";
	strord = strord + "Company:<Input tabindex=" + t++ + " " + readonly + " type=\\\"text\\\" name=\\\"scompany["+ i +"]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:3px;width:200px;height:18px;\\\" value=\\\"" + ((typeof(document.frm.elements["scompany["+i+"]"]) != "undefined") ? document.frm.elements["scompany["+i+"]"].value : "") + "\\\" /><br />";
	strord = strord + "Phone:<Input tabindex=" + t++ + " " + readonly + " type=\\\"text\\\" name=\\\"sphone["+ i +"]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:18px;width:200px;height:18px;\\\" value=\\\"" + ((typeof(document.frm.elements["sphone["+i+"]"]) != "undefined") ? document.frm.elements["sphone["+i+"]"].value : "") + "\\\" /><br />";
	strord = strord + "Email:<Input tabindex=" + t++ + " " + readonly + " type=\\\"text\\\" name=\\\"semail["+ i +"]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:24px;width:200px;height:18px;\\\" value=\\\"" + ((typeof(document.frm.elements["semail["+i+"]"]) != "undefined") ? document.frm.elements["semail["+i+"]"].value : "") + "\\\" /><br />";
	strord = strord + "Add 1:<Input tabindex=" + t++ + " " + readonly + " type=\\\"text\\\" name=\\\"sadd1["+ i +"]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:19px;width:200px;height:18px;\\\" value=\\\"" + ((typeof(document.frm.elements["sadd1["+i+"]"]) != "undefined") ? document.frm.elements["sadd1["+i+"]"].value : "") + "\\\" /><br />";
	strord = strord + "Add 2:<Input tabindex=" + t++ + " " + readonly + " type=\\\"text\\\" name=\\\"sadd2["+ i +"]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:19px;width:200px;height:18px;\\\" value=\\\"" + ((typeof(document.frm.elements["sadd2["+i+"]"]) != "undefined") ? document.frm.elements["sadd2["+i+"]"].value : "") + "\\\" /><br />";
	strord = strord + "Town:<Input tabindex=" + t++ + " " + readonly + " type=\\\"text\\\" name=\\\"stown["+ i +"]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:20px;width:200px;height:18px;\\\" value=\\\"" + ((typeof(document.frm.elements["stown["+i+"]"]) != "undefined") ? document.frm.elements["stown["+i+"]"].value : "") + "\\\" /><br />";
	strord = strord + "County:<Input tabindex=" + t++ + " " + readonly + " type=\\\"text\\\" name=\\\"scounty["+ i +"]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:14px;width:200px;height:18px;\\\" value=\\\"" + ((typeof(document.frm.elements["scounty["+i+"]"]) != "undefined") ? document.frm.elements["scounty["+i+"]"].value : "") + "\\\" /><br />";
	strord = strord + "</td><td width=\\\"29%\\\">";
	strord = strord + "Country:<select tabindex=" + t++ + " name=\\\"rcountry["+ i +"]\\\" style=\\\"vertical-align:middle; position:relative; top:-3px;left:10px;width:204px;height:20px;\\\" " + readonly + ">"
	strord = strord + "~;
	
	&get_countries("", 2); 
	
	print qq~";
	strord = strord + "</select>";
	strord = strord + "PostCode:<Input tabindex=" + t++ + " " + readonly + " type=\\\"text\\\" name=\\\"rpcode["+ i +"]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:2px;width:200px;height:18px;\\\" value=\\\"" + ((typeof(document.frm.elements["rpcode["+i+"]"]) != "undefined") ? document.frm.elements["rpcode["+i+"]"].value : "") + "\\\" /><br />";
	strord = strord + "Contact:<Input tabindex=" + t++ + " " + readonly + " type=\\\"text\\\" name=\\\"rcontact["+ i +"]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:11px;width:200px;height:18px;\\\" value=\\\"" + ((typeof(document.frm.elements["rcontact["+i+"]"]) != "undefined") ? document.frm.elements["rcontact["+i+"]"].value : "") + "\\\" /><br />";
	strord = strord + "Company:<Input tabindex=" + t++ + " " + readonly + " type=\\\"text\\\" name=\\\"rcompany["+ i +"]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:3px;width:200px;height:18px;\\\" value=\\\"" + ((typeof(document.frm.elements["rcompany["+i+"]"]) != "undefined") ? document.frm.elements["rcompany["+i+"]"].value : "") + "\\\" /><br />";
	strord = strord + "Phone:<Input tabindex=" + t++ + " " + readonly + " type=\\\"text\\\" name=\\\"rphone["+ i +"]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:18px;width:200px;height:18px;\\\" value=\\\"" + ((typeof(document.frm.elements["rphone["+i+"]"]) != "undefined") ? document.frm.elements["rphone["+i+"]"].value : "") + "\\\" /><br />";
	strord = strord + "Email:<Input tabindex=" + t++ + " " + readonly + " type=\\\"text\\\" name=\\\"remail["+ i +"]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:24px;width:200px;height:18px;\\\" value=\\\"" + ((typeof(document.frm.elements["remail["+i+"]"]) != "undefined") ? document.frm.elements["remail["+i+"]"].value : "") + "\\\" /><br />";
	strord = strord + "Add 1:<Input tabindex=" + t++ + " " + readonly + " type=\\\"text\\\" name=\\\"radd1["+ i +"]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:19px;width:200px;height:18px;\\\" value=\\\"" + ((typeof(document.frm.elements["radd1["+i+"]"]) != "undefined") ? document.frm.elements["radd1["+i+"]"].value : "") + "\\\" /><br />";
	strord = strord + "Add 2:<Input tabindex=" + t++ + " " + readonly + " type=\\\"text\\\" name=\\\"radd2["+ i +"]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:19px;width:200px;height:18px;\\\" value=\\\"" + ((typeof(document.frm.elements["radd2["+i+"]"]) != "undefined") ? document.frm.elements["radd2["+i+"]"].value : "") + "\\\" /><br />";
	strord = strord + "Town:<Input tabindex=" + t++ + " " + readonly + " type=\\\"text\\\" name=\\\"rtown["+ i +"]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:20px;width:200px;height:18px;\\\" value=\\\"" + ((typeof(document.frm.elements["rtown["+i+"]"]) != "undefined") ? document.frm.elements["rtown["+i+"]"].value : "") + "\\\" /><br />";
	strord = strord + "County:<Input tabindex=" + t++ + " " + readonly + " type=\\\"text\\\" name=\\\"rcounty["+ i +"]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:14px;width:200px;height:18px;\\\" value=\\\"" + ((typeof(document.frm.elements["rcounty["+i+"]"]) != "undefined") ? document.frm.elements["rcounty["+i+"]"].value : "") + "\\\" /><br />";
	strord = strord + "</td></tr><tr><td colspan=\\\"3\\\" height=\\\"10\\\"><hr width=\\\"100%\\\" size=\\\"1\\\" noshade></td></tr>";
	}

	strord = strord + "</table>";

	document.getElementById('divHAWB').innerHTML = strord;

	SetTotalBags(document.frm);
	
	if( typeof(window['document.frm.ord_totw']) != "undefined" )
		{
	  document.frm.ord_totw.value = '';
	  document.frm.ord_totb.value = '';
	  }
}


function CalculateTweight(theForm)
{
var count = theForm.elements.length;
var numhawbs = 0;
var sum = 0.0;
var i;
var j;

for (i=0; i<count; i++) 
  {
  var element = theForm.elements[i];
  var poo = element.name; 
  if (poo.indexOf('item') + 1 > 0) {numhawbs = numhawbs +1;} 
  } 

for (i=1; i < numhawbs+1; i++) 
  {
  for( j = 1 ; j <= theForm.elements["item["+i+"]"].value ; j++ )
  	{
	  if( theForm.elements["length["+i+"]["+j+"]"].value != "" && isInteger(theForm.elements["length["+i+"]["+j+"]"].value) == true &&
  	theForm.elements["width["+i+"]["+j+"]"].value != "" && isInteger(theForm.elements["width["+i+"]["+j+"]"].value) == true &&
	  theForm.elements["height["+i+"]["+j+"]"].value != "" && isInteger(theForm.elements["height["+i+"]["+j+"]"].value) == true )
			theForm.elements["vweight["+i+"]["+j+"]"].value = parseFloat(((theForm.elements["length["+i+"]["+j+"]"].value * theForm.elements["width["+i+"]["+j+"]"].value * theForm.elements["height["+i+"]["+j+"]"].value)/4000)).toFixed(2);
		
	  if( theForm.elements["weight["+i+"]["+j+"]"].value != "" && isDecimal(theForm.elements["weight["+i+"]["+j+"]"].value) == true )
  		{
	  	if( theForm.elements["vweight["+i+"]["+j+"]"].value != "" && (theForm.elements["vweight["+i+"]["+j+"]"].value * 1) > (theForm.elements["weight["+i+"]["+j+"]"].value * 1) )
			  sum = parseFloat(parseFloat(sum) + parseFloat(theForm.elements["vweight["+i+"]["+j+"]"].value)).toFixed(2);
  		else
		  	sum = parseFloat(parseFloat(sum) + parseFloat(theForm.elements["weight["+i+"]["+j+"]"].value)).toFixed(2);
		  }
		}
  }
  
  theForm.ord_totw.value = sum;
}

function isInteger(s){
	var i;
    for (i = 0; i < s.length; i++){   
        // Check that current character is number.
        var c = s.charAt(i);
        if (((c < "0") || (c > "9"))) return false;
    }
    // All characters are numbers.
    return true;
}

function isDecimal(s){
	var i;
    for (i = 0; i < s.length; i++){   
        // Check that current character is number.
        var c = s.charAt(i);
        if (((c < "0") || (c > "9")) && c != ".") return false;
    }
    // All characters are numbers.
    return true;
}

function stripCharsInBag(s, bag){
	var i;
    var returnString = "";
    // Search through string's characters one by one.
    // If character is not in bag, append to returnString.
    for (i = 0; i < s.length; i++){   
        var c = s.charAt(i);
        if (bag.indexOf(c) == -1) returnString += c;
    }
    return returnString;
}

function daysInFebruary (year){
	// February has 29 days in any year evenly divisible by four,
    // EXCEPT for centurial years which are not also divisible by 400.
    return (((year % 4 == 0) && ( (!(year % 100 == 0)) || (year % 400 == 0))) ? 29 : 28 );
}
function DaysArray(n) {
	for (var i = 1; i <= n; i++) {
		this[i] = 31
		if (i==4 || i==6 || i==9 || i==11) {this[i] = 30}
		if (i==2) {this[i] = 29}
   } 
   return this
}

function isDate(dtStr){
	var daysInMonth = DaysArray(12)
	var pos1=dtStr.indexOf(dtCh)
	var pos2=dtStr.indexOf(dtCh,pos1+1)
	var strDay=dtStr.substring(0,pos1)
	var strMonth=dtStr.substring(pos1+1,pos2)
	var strYear=dtStr.substring(pos2+1)
	if( (strYear.length == 1 || strYear.length == 2) && isInteger(strYear) )
		{
		if( strYear.length == 2 )
			{
			if( strYear.substring(0,1) == '0' )
				strYr = parseInt(strYear.substring(1,2));
			else
				strYr = parseInt(strYear);
			}
		else
			strYr = parseInt(strYear);

		strYr = strYr + 2000;
		strYr = '' + strYr;
		}
	else
		{
		alert("Please enter a valid 2 digit year between "+minYear+" and "+maxYear);
		return false;
		}

	if (strDay.charAt(0)=="0" && strDay.length>1) strDay=strDay.substring(1)
	if (strMonth.charAt(0)=="0" && strMonth.length>1) strMonth=strMonth.substring(1)
	for (var i = 1; i <= 3; i++) {
		if (strYr.charAt(0)=="0" && strYr.length>1) strYr=strYr.substring(1)
	}
	month=parseInt(strMonth)
	day=parseInt(strDay)
	year=parseInt(strYr)
	if (pos1==-1 || pos2==-1){
		alert("The date format should be : dd.mm.yy")
		return false
	}
	if (strMonth.length<1 || month<1 || month>12){
		alert("Please enter a valid month")
		return false
	}
	if (strDay.length<1 || day<1 || day>31 || (month==2 && day>daysInFebruary(year)) || day > daysInMonth[month]){
		alert("Please enter a valid day")
		return false
	}
	if (strYear.length != 2 || year==0 || year<minYear || year>maxYear){
		alert("Please enter a valid 2 digit year between "+minYear+" and "+maxYear)
		return false
	}
	if (dtStr.indexOf(dtCh,pos2+1)!=-1 || isInteger(stripCharsInBag(dtStr, dtCh))==false){
		alert("Please enter a valid date")
		return false
	}
return true
}

function validateForm (theForm) {

if( theForm.ord_awb1.value.lenght > 0 || theForm.ord_awb2.value.lenght > 0 )
	{
	if( isInteger(theForm.ord_awb1.value) == false ) {alert("MAWB part 1 must contain only digits"); theForm.ord_awb1.focus(); return false;}
	if( theForm.ord_awb1.value.length != 3 ) {alert("MAWB part 1 must be exactly 3 digits"); theForm.ord_awb1.focus(); return false;}
	if( isInteger(theForm.ord_awb2.value) == false ) {alert("MAWB part 2 must contain only digits"); theForm.ord_awb2.focus(); return false;}
	if( theForm.ord_awb2.value.length != 8 ) {alert("MAWB part 2 must be exactly 8 digits"); theForm.ord_awb2.focus(); return false;}
	}

var count = theForm.elements.length;
var numords = 0;
var j;
for (i=0; i<count; i++) 
  {
  var element = theForm.elements[i];
  var poo = element.name; 
  if (poo.indexOf('item') + 1 > 0) {numords = numords +1;} 
  } 

for (i=1; i < numords+1; i++) 
  {
  if( theForm.elements["dis["+i+"]"].value == "0" )
  	{
	  if (theForm.elements["hawb["+i+"]"].value == "") {alert('Please enter a value for HAWB [SR# '+ i + ']'); return false;}
	  if (theForm.elements["lvhv["+i+"]"].value == "" ) {alert('Please select a value for HV/LV field [SR# ' + i + ']'); return false;}
	  if (!((theForm.elements["value["+i+"]"].value * 1)) > 0) {alert('Please enter a value for Value field [SR# ' + i + ']'); return false;}
	  if (theForm.elements["content["+i+"]"].value == "") {alert('Please enter a value for content [SR# ' + i + ']'); return false;}
	  if (theForm.elements["cod["+i+"]"].value != "" && theForm.elements["cod["+i+"]"].value != "0" && theForm.elements["cod["+i+"]"].value != "0.0" && theForm.elements["cod["+i+"]"].value != "0.00" && !((theForm.elements["cod["+i+"]"].value * 1) > 0)) {alert('COD Amount value must be decimal [SR# ' + i + ']'); return false;}
	  if (theForm.elements["item["+i+"]"].value == "") {alert('Please enter a value for item [SR# ' + i + ']'); return false;}
	  for( j = 1 ; j <= theForm.elements["item["+i+"]"].value ; j++ )
	  	{
		  if (!((theForm.elements["weight["+i+"]["+j+"]"].value * 1)) > 0) {alert('Please enter a value for Weight [SR# ' + i + ' Bag No. ' + j + ']'); return false;}
		  if (theForm.elements["bags["+i+"]["+j+"]"].value == "") {alert('Please enter a value for Bag Details Ref [SR# ' + i + ' Bag No. ' + j + ']'); return false;}
		  if (isInteger(theForm.elements["bags["+i+"]["+j+"]"].value) == false ) {alert('Bag Details Ref Must be an integer number [SR# ' + i + ' Bag No. ' + j + ']'); return false;}
		  if (!((theForm.elements["length["+i+"]["+j+"]"].value * 1)) > 0 || isInteger(theForm.elements["length["+i+"]["+j+"]"].value) == false) {alert('Please enter a value for Length [SR# ' + i + ' Bag No. ' + j + ']'); return false;}
		  if (!((theForm.elements["width["+i+"]["+j+"]"].value * 1)) > 0 || isInteger(theForm.elements["width["+i+"]["+j+"]"].value) == false || theForm.elements["width["+i+"]["+j+"]"].value == "0" || theForm.elements["width["+i+"]["+j+"]"].value == "0.0" || theForm.elements["width["+i+"]["+j+"]"].value == "0.00" ) {alert('Please enter a value for Width [SR# ' + i + ' Bag No. ' + j + ']'); return false;}
		  if (!((theForm.elements["height["+i+"]["+j+"]"].value * 1)) > 0 || isInteger(theForm.elements["height["+i+"]["+j+"]"].value) == false) {alert('Please enter a value for Height [SR# ' + i + ' Bag No. ' + j + ']'); return false;}
		  }
	  if (theForm.elements["semail["+i+"]"].value != "") 
	  	{
			if(theForm.elements["semail["+i+"]"].value.indexOf('\@', 0) == -1)
				{
				alert('Please enter a valid email of shipper [SR# ' + i + ']');return false;
				}
		
			if(theForm.elements["semail["+i+"]"].value.indexOf('.', 0) == -1)
				{
				alert('Please enter a valid email of shipper [SR# ' + i + ']');return false;
				}
	  	}
//	  if (theForm.elements["imported"].value =="0" && theForm.elements["entid"].value == "0" && theForm.elements["scountry["+i+"]"].value == "") {alert('Please enter a value for Country of shipper [SR# ' + i + ']'); return false;}
//	  if (theForm.elements["imported"].value =="0" && theForm.elements["entid"].value == "0" && theForm.elements["rcontact["+i+"]"].value == "" && theForm.elements["rcompany["+i+"]"].value == "" ) {alert('Please enter a value for Contact or Company of receiver [SR# ' + i + ']'); return false;}
	  
	  if (theForm.elements["entid"].value == "0" && theForm.elements["rphone["+i+"]"].value == "") {alert('Please enter a value for Phone of receiver [SR# ' + i + ']'); return false;}
	  if (theForm.elements["remail["+i+"]"].value != "") 
	  	{
			if(theForm.elements["remail["+i+"]"].value.indexOf('\@', 0) == -1)
				{
				alert('Please enter a valid email of receiver [SR# ' + i + ']');return false;
				}
		
			if(theForm.elements["remail["+i+"]"].value.indexOf('.', 0) == -1)
				{
				alert('Please enter a valid email of receiver [SR# ' + i + ']');return false;
				}
	  	}
//	  if (theForm.elements["imported"].value =="0" && theForm.elements["entid"].value == "0" && theForm.elements["radd1["+i+"]"].value == "") {alert('Please enter a value for Address 1 of receiver [SR# ' + i + ']'); return false;}
//	  if (theForm.elements["imported"].value =="0" && theForm.elements["entid"].value == "0" && theForm.elements["rtown["+i+"]"].value == "") {alert('Please enter a value for Town of receiver [SR# ' + i + ']'); return false;}
//	  if (theForm.elements["imported"].value =="0" && theForm.elements["entid"].value == "0" && theForm.elements["rpcode["+i+"]"].value == "") {alert('Please enter a value for Post Code of receiver [SR# ' + i + ']'); return false;}
	  if (theForm.elements["imported"].value =="0" && theForm.elements["entid"].value == "0" && theForm.elements["rcountry["+i+"]"].value == "") {alert('Please enter a value for Country of receiver [SR# ' + i + ']'); return false;}
	  }
  }

if( theForm.ord_totw.value=="") {	alert("Please enter a value for Total Weight");theForm.ord_totw.focus();return false;}
if( isDecimal(theForm.ord_totw.value) == false) { alert("Total Weight must be numeric");theForm.ord_totw.focus();return false;}
if( theForm.ord_totb.value.lenght > 0 )
	if( isInteger(theForm.ord_totb.value) == false) { alert("Total Bags must be integer");theForm.ord_totb.focus();return false;}

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
	
	return true;
}

</script>
~;
}


sub butils
{
print qq~
<script type="text/javascript">

function validateForm (theForm) 
{
if( theForm.service.value == "" ) 
	{
	alert("Please select a service"); theForm.service.focus(); return false;
	}
if( theForm.reference.value == "" || theForm.reference.value.length < 8) 
	{
	alert("Please enter a valid Tracking No."); theForm.reference.focus(); return false;
	}

return true;
}

</script>
~;
}

sub packutils
{
print qq(<script type="text/javascript" src="packutils.js"></script>);
}

sub memberscheck($)
{
	my $check = shift;

print qq~
<script LANGUAGE="JavaScript">
function isDecimal(s){
	var i;
    for (i = 0; i < s.length; i++){   
        // Check that current character is number.
        var c = s.charAt(i);
        if (((c < "0") || (c > "9")) && c != ".") return false;
    }
    // All characters are numbers.
    return true;
}

function formcheck(theForm) 
{
~;

my ($has_pass, $hasuser);
$has_pass = 0;
$has_user = 0;
@fields = split(/,/,$check);
foreach $field(@fields)
	{
	if($field eq "username")
		{
		$has_user = 1;
		print qq|
		if (theForm.username.value=="") 
			{
			alert("Please enter the User Name");theForm.username.focus();return false
			}
		|;
		}
		if($field eq "pass1")
			{
			$has_pass = 1;
			print qq|
			if (theForm.pass1.value=="") 
				{
				alert("Please enter the Password");theForm.pass1.focus();return false
				}
				|;
			}

		if($field eq "pass2")
			{
			print qq|
			if (theForm.pass2.value=="") 
				{
				alert("Please enter the Repeat Password");theForm.pass2.focus();return false
				}
				|;
			}

		if($field eq "id_dest_contact")
			{
			print qq|
			if (theForm.id_dest_contact.value=="") 
			{
			alert("Please enter the Recipient Name");theForm.id_dest_contact.focus();return false
			}
			|;
			}

		if($field eq "id_contact")
			{
			print qq|
			if (theForm.id_contact.value=="") 
			{
			alert("Please enter the Contact Name");theForm.id_contact.focus();return false
			}
			|;
			}

		if($field eq "fname")
			{
			print qq|
			if (theForm.fname.value=="") 
			{
			alert("Please enter the First Name");theForm.fname.focus();return false
			}
			|;
			}

		if($field eq "lname")
			{
			print qq|
			if (theForm.lname.value=="") 
			{
			alert("Please enter the Last Name");theForm.lname.focus();return false
			}
			|;
			}

		if($field eq "company")
			{
			print qq|
			if (theForm.company.value=="") 
			{
			alert("Please enter the Company");theForm.company.focus();return false
			}
			|;
			}

		if($field eq "dest_tel1")
			{
			print qq|
			if (theForm.dest_tel1.value=="") 
			{
			alert("Please enter the Land Phone");theForm.dest_tel1.focus();return false
			}
			|;
			}

		if($field eq "dest_tel2")
			{
			print qq|
			if (theForm.dest_tel2.value=="") 
			{
			alert("Please enter the Land Phone");theForm.dest_tel2.focus();return false
			}
			|;
			}

		if($field eq "dest_tel3")
			{
			print qq|
			if (theForm.dest_tel3.value=="") 
			{
			alert("Please enter the Land Phone");theForm.dest_tel3.focus();return false
			}
			|;
			}

		if($field eq "tel1")
			{
			print qq|
			if (theForm.tel1.value=="") 
			{
			alert("Please enter the Land Phone");theForm.tel1.focus();return false
			}
			|;
			}

		if($field eq "tel2")
			{
			print qq|
			if (theForm.tel2.value=="") 
			{
			alert("Please enter the Land Phone");theForm.tel2.focus();return false
			}
			|;
			}

		if($field eq "tel3")
			{
			print qq|
			if (theForm.tel3.value=="") 
			{
			alert("Please enter the Land Phone");theForm.tel3.focus();return false
			}
			|;
			}


		if($field eq "mob1")
			{
			print qq|
			if (theForm.mob1.value=="") 
			{
			alert("Please enter the Cell Phone");theForm.mob1.focus();return false
			}
			|;
			}

		if($field eq "mob2")
			{
			print qq|
			if (theForm.mob2.value=="") 
			{
			alert("Please enter the Cell Phone");theForm.mob2.focus();return false
			}
			|;
			}

		if($field eq "mob3")
			{
			print qq|
			if (theForm.mob3.value=="") 
			{
			alert("Please enter the Cell Phone");theForm.mob3.focus();return false
			}
			|;
			}

		if($field eq "fax1")
			{
			print qq|
			if (theForm.fax1.value=="") 
			{
			alert("Please enter the Fax");theForm.fax1.focus();return false
			}
			|;
			}

		if($field eq "fax2")
			{
			print qq|
			if (theForm.fax2.value=="") 
			{
			alert("Please enter the Fax");theForm.fax2.focus();return false
			}
			|;
			}

		if($field eq "fax3")
			{
			print qq|
			if (theForm.fax3.value=="") 
			{
			alert("Please enter the Fax");theForm.fax3.focus();return false
			}
			|;
			}

		if($field eq "fromtime")
			{
			print qq~
			if (theForm.fromtime.value=="") 
			{
			alert("Please enter the Ready Time");theForm.fromtime.focus();return false
			}
			
			if( theForm.fromtime.value.length != 5 )
			{
			alert("Please enter the a valid Ready Time. (Format HH:MM)");theForm.fromtime.focus();return false
			}
			
			if( theForm.fromtime.value.charCodeAt(0) < 48 || theForm.fromtime.value.charCodeAt(0) > 57 || theForm.fromtime.value.charCodeAt(1) < 48 || theForm.fromtime.value.charCodeAt(1) > 57 || theForm.fromtime.value.charCodeAt(2) != 58 || theForm.fromtime.value.charCodeAt(3) < 48 || theForm.fromtime.value.charCodeAt(3) > 57 || theForm.fromtime.value.charCodeAt(4) < 48 || theForm.fromtime.value.charCodeAt(4) > 57 )
			{
			alert("Please enter the a valid Ready Time. (Format HH:MM)");theForm.fromtime.focus();return false
			}

			if( parseInt(theForm.fromtime.value.substring(0, 2)) > 24 || parseInt(theForm.fromtime.value.substring(3, 5)) > 59 )
			{
			alert("Please enter the a valid Ready Time. (Format HH:MM)");theForm.fromtime.focus();return false
			}
			~;
			}

		if($field eq "totime")
			{
			print qq~
			if (theForm.totime.value=="") 
			{
			alert("Please enter the Deadline Time");theForm.totime.focus();return false
			}
			
			if( theForm.totime.value.length != 5 )
			{
			alert("Please enter the a valid Deadline Time. (Format HH:MM)");theForm.totime.focus();return false
			}
			
			if( theForm.totime.value.charCodeAt(0) < 48 || theForm.totime.value.charCodeAt(0) > 57 || theForm.totime.value.charCodeAt(1) < 48 || theForm.totime.value.charCodeAt(1) > 57 || theForm.totime.value.charCodeAt(2) != 58 || theForm.totime.value.charCodeAt(3) < 48 || theForm.totime.value.charCodeAt(3) > 57 || theForm.totime.value.charCodeAt(4) < 48 || theForm.totime.value.charCodeAt(4) > 57 )
			{
			alert("Please enter the a valid Deadline Time. (Format HH:MM)");theForm.totime.focus();return false
			}

			if( parseInt(theForm.totime.value.substring(0, 2)) > 24 || parseInt(theForm.totime.value.substring(3, 5)) > 59 )
			{
			alert("Please enter the a valid Deadline Time. (Format HH:MM)");theForm.fromtime.focus();return false
			}
			
			if( theForm.fromtime.value.substring(0, 2) == theForm.totime.value.substring(0, 2) )
				{
				if( parseInt(theForm.fromtime.value.substring(3, 5)) > parseInt(theForm.totime.value.substring(3, 5)) )
					{
					alert("Ready Time must be less than Deadline Time"); theForm.totime.focus();return false
					}
				}
			else
				{
				if( parseInt(theForm.fromtime.value.substring(0, 2)) > parseInt(theForm.totime.value.substring(0, 2)) )
					{
					alert("Ready Time must be less than Deadline Time"); theForm.totime.focus();return false
					}
				}
			~;
			}


		if($field eq "id_dest_add1")
			{
			print qq|
			if (theForm.id_dest_add1.value=="") 
			{
			alert("Please enter the Address");theForm.id_dest_add1.focus();return false
			}
			|;
			}

		if($field eq "id_add1")
			{
			print qq|
			if (theForm.id_add1.value=="") 
			{
			alert("Please enter the Address");theForm.id_add1.focus();return false
			}
			|;
			}

		if($field eq "add")
			{
			print qq|
			if (theForm.add.value=="") 
			{
			alert("Please enter the Address");theForm.add.focus();return false
			}
			|;
			}


		if($field eq "id_dest_postcode")
			{
			print qq|
			if (theForm.id_dest_postcode.value=="") 
			{
			alert("Please enter the Post Code");theForm.id_dest_postcode.focus();return false
			}
			|;
			}

		if($field eq "id_postcode")
			{
			print qq|
			if (theForm.id_postcode.value=="") 
			{
			alert("Please enter the Post Code");theForm.id_postcode.focus();return false
			}
			|;
			}

		if($field eq "postcode")
			{
			print qq|
			if (theForm.postcode.value=="") 
			{
			alert("Please enter the Post Code");theForm.postcode.focus();return false
			}
			|;
			}

		if($field eq "country")
			{
			print qq|
			if (theForm.country.value=="") 
			{
			alert("Please enter the Country");theForm.country.focus();return false
			}
			|;
			}

		if($field eq "id_dest_city")
			{
			print qq|
			if (theForm.id_dest_city.value=="") 
			{
			alert("Please enter the City");theForm.id_dest_city.focus();return false
			}
			|;
			}

		if($field eq "id_town")
			{
			print qq|
			if (theForm.id_town.value=="") 
			{
			alert("Please enter the City");theForm.id_town.focus();return false
			}
			|;
			}

		if($field eq "city")
			{
			print qq|
			if (theForm.city.value=="") 
			{
			alert("Please enter the City");theForm.city.focus();return false
			}
			|;
			}

		if($field eq "id_dest_state")
			{
			print qq|
			if (theForm.id_dest_state.value=="") 
			{
			alert("Please enter the County");theForm.id_dest_state.focus();return false
			}
			|;
			}

		if($field eq "id_county")
			{
			print qq|
			if (theForm.id_county.value=="") 
			{
			alert("Please enter the County");theForm.id_county.focus();return false
			}
			|;
			}

		if($field eq "email")
			{
			print qq|
			if (theForm.email.value=="") 
				{
				alert("Please enter the Email Address");theForm.email.focus();return false
				}
			
			if(theForm.email.value.indexOf('\@', 0) == -1)
				{
				alert("Please Enter a Valid Email Address");theForm.email.focus();return false
				}
		
			if(theForm.email.value.indexOf('.', 0) == -1)
				{
				alert("Please Enter a Valid Email Address");theForm.email.focus();return false
				}
			|;
			}

		if($field eq "_email")
			{
			print qq|
			if (theForm.email.value!="") 
			{
				if(theForm.email.value.indexOf('\@', 0) == -1)
					{
					alert("Please Enter a Valid Email Address");theForm.email.focus();return false
					}
			
				if(theForm.email.value.indexOf('.', 0) == -1)
					{
					alert("Please Enter a Valid Email Address");theForm.email.focus();return false
					}
			}
			|;
			}

		if($field eq "_dest_email")
			{
			print qq|
			if (theForm.dest_email.value!="") 
			{
				if(theForm.dest_email.value.indexOf('\@', 0) == -1)
					{
					alert("Please Enter a Valid Email Address");theForm.dest_email.focus();return false
					}
			
				if(theForm.dest_email.value.indexOf('.', 0) == -1)
					{
					alert("Please Enter a Valid Email Address");theForm.dest_email.focus();return false
					}
			}
			|;
			}

		if($field eq "website")
			{
			print qq~
			if ( theForm.website.value == "" || theForm.website.value == "http://" ) 
			{
			alert("Please enter the Website");theForm.website.focus();return false
			}
			~;
			}

		if($field eq "credit")
			{
			print qq~
			if (theForm.credit.value=="" || isDecimal(theForm.credit.value) == false) 
			{
			alert("Please enter the Agent Credit");theForm.credit.focus();return false
			}
			~;
			}

		if($field eq "ceclv")
			{
			print qq~
			if (theForm.ceclv.value=="") 
			{
			alert("Please enter the Custom Entry Charge for LV");theForm.ceclv.focus();return false
			}
			~;
			}
			
		if($field eq "cechv")
			{
			print qq~
			if (theForm.cechv.value=="") 
			{
			alert("Please enter the Custom Entry Charge for HV");theForm.cechv.focus();return false
			}
			~;
			}

		if($field eq "cecmhv")
			{
			print qq~
			if (theForm.cecmhv.value=="") 
			{
			alert("Please enter the Custom Entry Charge for MHV");theForm.cecmhv.focus();return false
			}
			~;
			}

		if($field eq "cecpe")
			{
			print qq~
			if (theForm.cecpe.value=="") 
			{
			alert("Please enter the Custom Entry Charge for PE");theForm.cecpe.focus();return false
			}
			~;
			}

		if($field eq "ahcminkg")
			{
			print qq~
			if (theForm.ahcminkg.value=="") 
			{
			alert("Please enter the Air Handling Charge Min. Weight");theForm.ahcminkg.focus();return false
			}
			~;
			}

		if($field eq "ahccharge")
			{
			print qq~
			if (theForm.ahccharge.value=="") 
			{
			alert("Please enter the Air Handling Min. Charge");theForm.ahccharge.focus();return false
			}
			~;
			}

		if($field eq "ahcperkg")
			{
			print qq~
			if (theForm.ahcperkg.value=="") 
			{
			alert("Please enter the Air Handling Per Kg Charge");theForm.ahcperkg.focus();return false
			}
			~;
			}

		if($field eq "fas")
			{
			print qq~
			if (theForm.fas.value=="") 
			{
			alert("Please enter the FAS Account Service Charge");theForm.fas.focus();return false
			}
			~;
			}


		if($field eq "aircol")
			{
			print qq~
			if (theForm.aircol.value=="") 
			{
			alert("Please enter the Airport Collection Charge ");theForm.aircol.focus();return false
			}
			~;
			}


		if($field eq "epxcb")
			{
			print qq~
			if ( !theForm.epxcb[0].checked && !theForm.epxcb[1].checked ) 
				{
				alert("Please select a value for EPX Cash Back");
				return false
				}
			
			if( checkRules(theForm) == false )
				{
				return false;
				}
			~;
			}

	}#foreach


	if( $has_user )
		{
		print qq|
		  if( !fncmIsEnglish( theForm.username.value ) )
		  	{
				alert('Username should be entered in English only.'); 
				return false;
				}
				|;
		}

	if( $has_pass )
		{
		print qq|
		if (theForm.pass1.value != theForm.pass2.value) 
			{
			alert("Passwords are not the same");theForm.pass1.value="";theForm.pass2.value="";theForm.pass1.focus();return false
			}

		if (theForm.pass1.value.toString().length < 5 ) 
			{
			alert("Password length must be 5 characters or more.");theForm.pass1.value="";theForm.pass2.value="";theForm.pass1.focus();return false
			}
			|;
		}


	print qq|
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
		theForm.submit();
	}
}
</script>
|;
}

sub settingcheck()
{
print qq~
<script LANGUAGE="JavaScript">

function isInteger(s){
	var i;
    for (i = 0; i < s.length; i++){   
        // Check that current character is number.
        var c = s.charAt(i);
        if (((c < "0") || (c > "9"))) return false;
    }
    // All characters are numbers.
    return true;
}

function isDecimal(s){
	var i;
    for (i = 0; i < s.length; i++){   
        // Check that current character is number.
        var c = s.charAt(i);
        if (((c < "0") || (c > "9")) && c != ".") return false;
    }
    // All characters are numbers.
    return true;
}

function formcheck(theForm) 
{
	if (theForm.s_profit.value=="") 
		{
		alert("Please enter a value for the Total Profit field");theForm.s_profit.focus();return false
		}
	if (!isDecimal(theForm.s_profit.value)) 
		{
		alert("The value of Total Profit must be numeric");theForm.s_profit.focus();return false
		}
	if (theForm.s_profit.value < 0 || theForm.s_profit.value > 100 ) 
		{
		alert("The value of Total Profit must be between 0 and 100");theForm.s_profit.focus();return false
		}
	if (theForm.s_vattext.value=="") 
		{
		alert("Please enter a value for the VAT description field");theForm.s_vattext.focus();return false
		}
	if (theForm.s_fueltext.value=="") 
		{
		alert("Please enter a value for the Fuel surchare description field");theForm.s_fueltext.focus();return false
		}
	if (theForm.s_remotetext.value=="") 
		{
		alert("Please enter a value for the Remote extra charge description field");theForm.s_remotetext.focus();return false
		}
	if (theForm.s_satdelexttext.value=="") 
		{
		alert("Please enter a value for the Saturday delivery extra charge description field");theForm.s_satdelexttext.focus();return false
		}
	if (theForm.s_satcolexttext.value=="") 
		{
		alert("Please enter a value for the Saturday collection extra charge description field");theForm.s_satcolexttext.focus();return false
		}
	if (theForm.s_booktext.value=="") 
		{
		alert("Please enter a value for the Booking extra charge description field");theForm.s_booktext.focus();return false
		}
	if (theForm.s_custtext.value=="") 
		{
		alert("Please enter a value for the Customs charge description field");theForm.s_custtext.focus();return false
		}
	if (theForm.s_invtext.value=="") 
		{
		alert("Please enter a value for the Invoice description field");theForm.s_invtext.focus();return false
		}
	if (theForm.s_usd.value=="") 
		{
		alert("Please enter a value for the USD rate field");theForm.s_usd.focus();return false
		}
	if (!isDecimal(theForm.s_usd.value)) 
		{
		alert("The value of USD rate must be numeric");theForm.s_usd.focus();return false
		}
	if (theForm.s_euro.value=="") 
		{
		alert("Please enter a value for the EURO rate field");theForm.s_euro.focus();return false
		}
	if (!isDecimal(theForm.s_euro.value)) 
		{
		alert("The value of EURO rate must be numeric");theForm.s_euro.focus();return false
		}


	ua = new String(navigator.userAgent);
	if (ua.match(/IE/g)) 
	{
		for (i=1; i<form.elements.length; i++) 
			{
			if (form.elements[i].type == 'submit') 
				{
				form.elements[i].disabled = true;
				}
			}
		form.submit();
	}
}
</script>
~;
}


sub error_page($)
{
	my $errmessage = shift;

	&myheader("error");

	&topmenu("error");

	print qq|<div class="ha8"><font color="#ff0000" size="2"><br /><br /><br /><br /><br /><center>$errmessage</center></font><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /></div>|;
	
	&footer;
}

sub Werror_page($)
{
	my $errmessage = shift;


			print $form->header;
			
			print qq~
			<html>
			<head>
			<title></title>
<script language="javascript">
if (document.all || document.layers || document.getElementById )
{
	window.left = 10;
	window.top = 10;
	window.width = screen.availWidth - 20;
	window.height = screen.availHeight - 20;
}
</script>
			</head>
			<body>
			<div align="center" valign="middle" style="vertical-align: middle;">
			<img src="img/content/slogan_01.gif" alt="Europost Express UK & International Parcel Delivery" width="235" height="56" style="float: left;" /><span style="float: right;"><H1>$mycompany</H1></span>
			</div>
			
			<font class="nofrm" size="2" face="Arial">
				<br /><br /><br /><br /><br /><br /><br /><br /><br /><center>$errmessage</center><br /><br /><br /><br /><br /><br /><br /><br /><br />
			</font>
			</body>
			</html>
					~;
}

sub omit0
{
	my $strval = shift;

	$strval =~ s/^(\d+\.\d)0$/$1/;
	$strval =~ s/^(\d+)\.0$/$1/;

	return $strval;	
}

sub toCurr
{
	my $strval = shift;

	if( $strval =~ /\d+\.\d{3,}/ )
		{
		$strval = sprintf("%.2f", $strval + 0.005);
		$strval = $strval + 1 - 1;
		}
	
	return $strval;	
}

sub SendEmail
{
	my ($to, $from, $subject, $message) = @_;
	
	%mail = (
         from => $from,
         to => $to,
         subject => $subject,
         'content-type' => 'text/html; charset="iso-8859-1"'
	);

	$mail{body} = <<END_OF_BODY;
<html>$message</html>
END_OF_BODY

unless( sendmail(%mail) )
	{
	&error_page("Error in sending email. Error: $Mail::Sendmail::error"); 
	exit;
	}

#	my $sendmail = '/usr/lib/sendmail';
#	open(MAIL, "|$sendmail -oi -t");
#	print MAIL "From: $from\n";
#	print MAIL "To: $to\n";
#	print MAIL "Subject: $subject\n\n";
#	print MAIL "$message\n";
#	close(MAIL);
} 

################### GET COUNTRIES #############################

sub get_destination{
&get_countries
}

sub get_countries{
	my ($sel, $injs) = @_;
	my $qchar;
	
	if( $injs )
		{
		$qchar = "\\\"";
		}
	else
		{
		$qchar = "\"";
		}
	
	
	my $countyrow;
	
	print qq|<option value=$qchar$qchar |;

	if( $sel eq "" && $injs == 1 )
		{
		print qq|" + ((typeof(document.frm.elements["scountry["+i+"]"]) != "undefined") ? ((document.frm.elements["scountry["+i+"]"].value=="")? "selected" : "") : ((document.frm.elements["ucountry"].value == "") ? "selected" : "")) + "|;
		}
	elsif( $sel eq "" && $injs == 2 )
		{
		print qq|" + ((typeof(document.frm.elements["rcountry["+i+"]"]) != "undefined") ? ((document.frm.elements["rcountry["+i+"]"].value=="")? "selected" : "") : "selected") + "|;
		}
	else
		{ 
	 	print qq|selected| unless($sel);
	 	}
  
	if( $injs )
		{
 		print qq|> (Select a Country) </option><option value=\\\"221\\\" |;
# 		";
		}
	else
		{
		print qq|> (Select a Country) </option><option value=\"221\" |;
# 		";
		}

	if( $sel eq "" && $injs == 1 )
		{
		print qq|" + ((typeof(document.frm.elements["scountry["+i+"]"]) != "undefined") ? ((document.frm.elements["scountry["+i+"]"].value=="221")? "selected" : "") : ((document.frm.elements["ucountry"].value == "221") ? "selected" : "")) + "|;
		}
	elsif( $sel eq "" && $injs == 2 )
		{
		print qq|" + ((typeof(document.frm.elements["rcountry["+i+"]"]) != "undefined") ? ((document.frm.elements["rcountry["+i+"]"].value=="221")? "selected" : "") : "") + "|;
		}
	else
		{ 
 		print qq|selected| if($sel eq "221" );
 		}
 
	if( $injs )
		{
 		print qq|> United Kingdom </option>|;
# 		";
 		}
	else
		{
 		print qq|> United Kingdom </option>|;
# 		";
 		}

 	print qq|<option value=$qchar$qchar> -------------------------------- </option>|;
 
	$TSQL = "SELECT * FROM countries WHERE country <> 'United Kingdom' ORDER BY country"; 
	&tmy_sql;

	while($countyrow = $tsth->fetchrow_hashref)
		{
		print qq|<option value=$qchar$countyrow->{'id'}$qchar |;

		if( $sel eq "" && $injs == 1 )
			{
			print qq|" + ((typeof(document.frm.elements["scountry["+i+"]"]) != "undefined") ? ((document.frm.elements["scountry["+i+"]"].value=="$countyrow->{'id'}")? "selected" : "") : ((document.frm.elements["ucountry"].value == "$countyrow->{'id'}") ? "selected" : "")) + "|;
			}
		elsif( $sel eq "" && $injs == 2 )
			{
			print qq|" + ((typeof(document.frm.elements["rcountry["+i+"]"]) != "undefined") ? ((document.frm.elements["rcountry["+i+"]"].value=="$countyrow->{'id'}")? "selected" : "") : "") + "|;
			}
		else
			{ 
		  print qq|selected| if($sel eq $countyrow->{'id'} );
		  }
		
		print qq|> $countyrow->{'country'} </option>|;
		}

	$tsth->finish;
}

sub get_country {
	my ($countyrow, $countryname);

	$TSQL = "SELECT * FROM countries WHERE id=$_[0]";
	&tmy_sql;

	if($countyrow = $tsth->fetchrow_hashref)
		{
		$countryname = $countyrow->{'country'};
		}
	else
		{
		$countryname = "";
		}

	$tsth->finish;

	return $countryname;
}

sub get_carrier {
	my $tcolumn;
	my @ret;

	$TSQL = "SELECT carriers.abbr, carriers.name, services.service FROM services LEFT JOIN carriers ON services.carid=carriers.id WHERE active=1 and services.id=$_[0]";
	&tmy_sql;

	$ret[0] = "";
	$ret[1] = "&nbsp;";
	$ret[2] = "&nbsp;";
	if($tcolumn = $tsth->fetchrow_hashref)
		{
		if( $tcolumn->{'abbr'} )
			{
			$ret[0] = $tcolumn->{'abbr'};
			$ret[1] = $tcolumn->{'name'};
			$ret[2] = $tcolumn->{'service'};
			};
		}
	$tsth->finish;

	unless( $ret[0] )
		{
		$TSQL = "SELECT abbr, name FROM carriers WHERE hasservice=0 and id=$_[0]";
		&tmy_sql;
		if($tcolumn = $tsth->fetchrow_hashref)
			{
			$ret[0] = $tcolumn->{'abbr'};
			$ret[1] = $tcolumn->{'name'};
			$ret[2] = $tcolumn->{'name'};
			}
		$tsth->finish;
		}

  return @ret;
}

sub get_carrier {
	my $tcolumn;
	my @ret;

	$TSQL = "SELECT carriers.abbr, carriers.name, services.service FROM services LEFT JOIN carriers ON services.carid=carriers.id WHERE active=1 and services.id=$_[0]";
	&tmy_sql;

	$ret[0] = "";
	$ret[1] = "&nbsp;";
	$ret[2] = "&nbsp;";
	if($tcolumn = $tsth->fetchrow_hashref)
		{
		if( $tcolumn->{'abbr'} )
			{
			$ret[0] = $tcolumn->{'abbr'};
			$ret[1] = $tcolumn->{'name'};
			$ret[2] = $tcolumn->{'service'};
			};
		}
	$tsth->finish;

	unless( $ret[0] )
		{
		$TSQL = "SELECT abbr, name FROM carriers WHERE hasservice=0 and id=$_[0]";
		&tmy_sql;
		if($tcolumn = $tsth->fetchrow_hashref)
			{
			$ret[0] = $tcolumn->{'abbr'};
			$ret[1] = $tcolumn->{'name'};
			$ret[2] = $tcolumn->{'name'};
			}
		$tsth->finish;
		}

  return @ret;
}

################ ROUND/PAD NUMBERS ###############
sub round {
my $number = shift;
$number = int($number * (10 ** 2) + .5) / (10 ** 2);
return $number;
}
sub pad {
my $number = shift;
if (index($number,".") >= 0) {
	my($left,$right) = split(/\./,$number);
	if (length($right) == 0) {
		$number = $number . "00";
		}
		elsif (length($right) == 1) { $number = $number . "0"; }
	}
	else { $number = $number . ".00"; }
return $number;
}

sub trim($)
{
	my $string = shift;
	$string =~ s/^\s+//;
	$string =~ s/\s+$//;
	return $string;
}


sub get_cookie{
	my ($r, $c) = @_;
	my $t;
	
	$t = $r->header("Set-Cookie");
	
	if( $t =~ m/^$c=([^;]+);/i )
		{
		return $1;
		}
	else
		{
		$t = $r->header("Set-Cookie2");
		if( $t =~ m/^$c=([^;]+);/i )
			{
			return $1;
			}
		else
			{
			return "";
			}
		}
}

sub get_mememail
{
	my $memberid = shift;
	
	$TSQL = "SELECT * FROM members WHERE userid = $memberid and status=2"; 
	&tmy_sql;

	if ($memcolumn = $tsth->fetchrow_hashref)
		{
		$mem_userid = $memcolumn->{'userid'};
		$mem_username = $memcolumn->{'username'};
		$mem_sal = $memcolumn->{'sal'};
		$mem_fname = $memcolumn->{'fname'};
		$mem_lname = $memcolumn->{'lname'};
		$mem_email = $memcolumn->{'email'};
		$mem_status = $memcolumn->{'status'};
		$mem_type = $memcolumn->{'type'};
		}
	else
		{
		$mem_userid = 0;
		}

	$tsth->finish;
}

sub get_memname
{
	my $memberid = shift;
	my $m_username;
	
	$TSQL = "SELECT username FROM members WHERE userid = $memberid and status=2"; 
	&tmy_sql;

	if ($memcolumn = $tsth->fetchrow_hashref)
		{
		$m_username = $memcolumn->{'username'};
		}
	else
		{
		$m_username = "";
		}

	$tsth->finish;
	
	return $m_username;
}

###################### DONE ##############################

sub prev_next{
$lasthits=$nh-$maxhits;
$nexthits=$nh+$maxhits;
$nexturl=$ENV{'QUERY_STRING'};
$nexturl =~ s/&nh=\d+//;
print qq|<table width="100%" cellpadding="2"><tr class="box1"><td align="right">|;
unless($lasthits < 0){
print qq|
<a href="$script?$nexturl&nh=$lasthits"><< Previous Results</a>&nbsp;|;
}
unless($nexthits > $totalhits-1){
print qq|&nbsp;<a href="$script?$nexturl&nh=$nexthits">Next Results >></a>|;
}
print qq|</td></tr></table>|;
}

################### WIZARD HEADER #############################
sub popheader{
print $form->header;
print qq|<html>

<head>
<title>$mycompany</title>
<style>P{ font-size: 11px; font-family: Tahoma; color: #000000 }
td           { font-size: 11px; font-family: Tahoma; color: #000000; }
a:link, a:visited { text-decoration: none; color: blue }
a:active, a:hover { text-decoration: underline; color: navy }
</style><base target="_self">
</head>

<body topmargin="0" leftmargin="0" rightmargin="0" marginheight="0" marginwidth="0" bgcolor="#E8E8D8" onload="self.focus()">

|;
}
################## WIZARD FOOTER ##############################
sub popfooter{
print qq|

</body>

</html>

|;
}

################### GET STATES #############################
sub get_states{
print qq|
<OPTION VALUE="">Click to Select
	<OPTION VALUE="Outside US">Outside United States
	<OPTION VALUE="AL">Alabama
	<OPTION VALUE="AK">Alaska
	<OPTION VALUE="AB">Alberta
	<OPTION VALUE="AS">American Samoa	
	<OPTION VALUE="AZ">Arizona
	<OPTION VALUE="AR">Arkansas
	<OPTION VALUE="AA">Armed Forces - USA/Canada
	<OPTION VALUE="AE">Armed Forces - Europe
	<OPTION VALUE="AP">Armed Forces - Pacific
	<OPTION VALUE="BC">British Columbia
	<OPTION VALUE="CA">California
	<OPTION VALUE="CO">Colorado
	<OPTION VALUE="CT">Connecticut
	<OPTION VALUE="DE">Delaware
	<OPTION VALUE="DC">District of Columbia
	<OPTION VALUE="FM">Federated States of Micronesia
	<OPTION VALUE="FL">Florida
	<OPTION VALUE="GA">Georgia
	<OPTION VALUE="GU">Guam
	<OPTION VALUE="HI">Hawaii
	<OPTION VALUE="ID">Idaho
	<OPTION VALUE="IL">Illinois
	<OPTION VALUE="IN">Indiana
	<OPTION VALUE="IA">Iowa
	<OPTION VALUE="KS">Kansas
	<OPTION VALUE="KY">Kentucky
	<OPTION VALUE="LA">Louisiana
	<OPTION VALUE="ME">Maine
	<OPTION VALUE="MB">Manitoba
	<OPTION VALUE="MH">Marshall Islands
	<OPTION VALUE="MD">Maryland
	<OPTION VALUE="MA">Massachusetts
	<OPTION VALUE="MI">Michigan
	<OPTION VALUE="MN">Minnesota
	<OPTION VALUE="MS">Mississippi
	<OPTION VALUE="MO">Missouri
	<OPTION VALUE="MT">Montana
	<OPTION VALUE="NE">Nebraska
	<OPTION VALUE="NV">Nevada
	<OPTION VALUE="NB">New Brunswick
	<OPTION VALUE="NH">New Hampshire
	<OPTION VALUE="NJ">New Jersey
	<OPTION VALUE="NM">New Mexico
	<OPTION VALUE="NY">New York
	<OPTION VALUE="NF">Newfoundland
	<OPTION VALUE="NC">North Carolina
	<OPTION VALUE="ND">North Dakota
	<OPTION VALUE="MP">Northern Mariana Island	
	<OPTION VALUE="NT">Northwest Territories
	<OPTION VALUE="NS">Nova Scotia
	<OPTION VALUE="OH">Ohio
	<OPTION VALUE="OK">Oklahoma
	<OPTION VALUE="ON">Ontario
	<OPTION VALUE="OR">Oregon
	<OPTION VALUE="PW">Palau Island
	<OPTION VALUE="PA">Pennsylvania
	<OPTION VALUE="PE">Prince Edward Island
	<OPTION VALUE="PR">Puerto Rico
	<OPTION VALUE="QC">Quebec
	<OPTION VALUE="RI">Rhode Island
	<OPTION VALUE="SK">Saskatchewan
	<OPTION VALUE="SC">South Carolina
	<OPTION VALUE="SD">South Dakota
	<OPTION VALUE="TN">Tennessee
	<OPTION VALUE="TX">Texas
	<OPTION VALUE="UT">Utah
	<OPTION VALUE="VT">Vermont
	<OPTION VALUE="VI">Virgin Islands
	<OPTION VALUE="VA">Virginia
	<OPTION VALUE="WA">Washington
	<OPTION VALUE="WV">West Virginia
	<OPTION VALUE="WI">Wisconsin
	<OPTION VALUE="WY">Wyoming
	<OPTION VALUE="YT">Yukon Territory|;
}
################### GET COUNTRIES #############################
sub get_languages{
print qq|
 <option value="lang_all" > (All Languages) </option> 
 <option value="lang_ar" > Arabic </option> 
 <option value="lang_zh-CN" > Chinese (S) </option> 
 <option value="lang_zh-TW" > Chinese (T) </option> 
 <option value="lang_cs" > Czech </option> 
 <option value="lang_da" > Danish </option> 
 <option value="lang_nl" > Dutch </option> 
 <option value="lang_en" > English </option> 
 <option value="lang_et" > Estonian </option> 
 <option value="lang_fi" > Finnish </option> 
 <option value="lang_fr" > French </option> 
 <option value="lang_de" > German </option> 
 <option value="lang_el" > Greek </option> 
 <option value="lang_iw" > Hebrew </option> 
 <option value="lang_hu" > Hungarian </option> 
 <option value="lang_is" > Icelandic </option> 
 <option value="lang_it" > Italian </option> 
 <option value="lang_ja" > Japanese </option> 
 <option value="lang_ko" > Korean </option> 
 <option value="lang_lv" > Latvian </option> 
 <option value="lang_lt" > Lithuanian </option> 
 <option value="lang_no" > Norwegian </option> 
 <option value="lang_pt" > Portuguese </option> 
 <option value="lang_pl" > Polish </option> 
 <option value="lang_ro" > Romanian </option> 
 <option value="lang_ru" > Russian </option> 
 <option value="lang_es" > Spanish </option> 
 <option value="lang_sv" > Swedish </option> 
 <option value="lang_tr" > Turkish </option> 
|;
}

sub get_topics{
print qq|
 <option value="all" > (All Topics) </option> 
 <option value="unclesam" > US. Government </option> 
 <option value="linux" > Linux </option> 
 <option value="mac" > Macintosh </option> 
 <option value="bsd" > FreeBSD </option> 
|;
}


#####################################################

@months2 = ("01","02","03","04","05","06","07","08","09","10","11","12");
@days2 = ("01","02","03","04","05","06","07","08","09",10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31);
sub select_day2{
&select_month2;
print qq|<select size="1" name="viewday">|;
foreach $days(@days2){
	if($days eq $viewday){
		$selected="selected";
	}
	print qq|<option $selected>$days</option>|;
	$selected="";
}
print qq|</select> |;
&select_year;
}

sub select_month2{
	print qq|<select size="1" name="viewmonth">|;

	foreach $monthname(@months2){
		if($monthname eq $viewmonth){
			$selected="selected";
		}
	   print qq| <option value="$monthname" $selected>$monthname</option>|;
		$selected="";
	}
	   print qq|</select> |;
}

sub select_day{
&select_month;
print qq|<select size="1" name="viewday">|;
if($viewday){$thisday=$viewday;}
print qq|<option value="$thisday">$thisday</option>|;
foreach $days(@days){
print qq|<option>$days</option>|;
}
print qq|</select> |;
&select_year;
}

sub select_month{
print qq|<select size="1" name="viewmonth">|;
if($viewmonth){$thismonth=$viewmonth;}
print qq|<option value="$thismonth">$thismonth</option>|;
foreach $monthname(@monthnames){
   print qq| <option value="$monthname">$monthname</option>|;
}
   print qq|</select> |;
}

sub select_year{
	print qq|<select size="1" name="viewyear">|;
	$nextyear=$thisyear+1;
	$lastyear=$thisyear-1;
	$previousyear=$thisyear-2;
	#@years=($nextyear,$thisyear,$lastyear,$previousyear);
	 @years=($thisyear,$nextyear,$lastyear,$previousyear);

	foreach $years(@years){
		if($years eq $viewyear){
			$selected="selected";
		}
		print qq|<option value="$years" $selected>$years</option>|;
		$selected="";
	}
	print qq|</select> |;
}
################### DATE ROUTINES ###################
sub date {

    my ($sec, $min, $hour, $day, $mon, $year, $dweek, $dyear, $daylight) = localtime(time());
    my (@months) = qw!01 02 03 04 05 06 07 08 09 10 11 12!;
	($day < 10) and ($day = "0$day");
	$year = $year - 100;
    return "$months[$mon]/$day/0$year";
}
sub supporttime {

    my ($sec, $min, $hour, $day, $mon, $year, $dweek, $dyear, $daylight) = localtime($_[0]);
    my (@months) = qw!1 2 3 4 5 6 7 8 9 10 11 12!;
	($day < 10) and ($day = "$day");
	($min < 10) and ($min = "0$min");
	$year = $year - 100;
    return "$months[$mon]/$day/0$year $hour:$min";
}
sub convertdate {

    my ($sec, $min, $hour, $day, $mon, $year, $dweek, $dyear, $daylight) = localtime($_[0]);
    my (@months) = qw!01 02 03 04 05 06 07 08 09 10 11 12!;
	($day < 10) and ($day = "0$day");
	$year = $year - 100;
    return "$months[$mon]/$day/0$year";
}
@monthnames = ("January","February","March","April","May","June","July","August","September","October","November","December");
@days = (1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31);
sub getdate {
	$time = time();
    ($sec, $min, $hour, $thisday, $mon, $year, $dweek, $dyear, $daylight) = localtime($time);
    $thismonth = $monthnames[$mon];
	$thisyear = $year + 1900;
}
sub getmon {
	if($_[0] eq "January" ) {
		return 1; }
	elsif($_[0] eq "February" ) {
		return 2;}
	elsif($_[0] eq "March" ) {
		return 3;}
	elsif($_[0] eq "April" ) {
		return 4;}
	elsif($_[0] eq "May" ) {
		return 5;}
	elsif($_[0] eq "June" ) {
		return 6;}
	elsif($_[0] eq "July" ) {
		return 7;}
	elsif($_[0] eq "August" ) {
		return 8;}
	elsif($_[0] eq "September" ) {
		return 9;}
	elsif($_[0] eq "October" ) {
		return 10;}
	elsif($_[0] eq "November" ) {
		return 11;}
	elsif($_[0] eq "December" ) {
		return 12;}
}
sub getmonname {
	return $monthnames[$_[0] - 1];
}

sub get_languagename {
    my (%languages) = (
"lang_all" => "(All Languages)",
"lang_ar" => "Arabic",
"lang_zh-CN" => "Chinese (S)",
"lang_zh-TW" => "Chinese (T)",
"lang_cs" => "Czech",
"lang_da" => "Danish",
"lang_nl" => "Dutch",
"lang_en" => "English",
"lang_et" => "Estonian",
"lang_fi" => "Finnish",
"lang_fr" => "French",
"lang_de" => "German",
"lang_el" => "Greek",
"lang_iw" => "Hebrew",
"lang_hu" => "Hungarian",
"lang_is" => "Icelandic",
"lang_it" => "Italian",
"lang_ja" => "Japanese",
"lang_ko" => "Korean",
"lang_lv" => "Latvian",
"lang_lt" => "Lithuanian",
"lang_no" => "Norwegian",
"lang_pt" => "Portuguese",
"lang_pl" => "Polish",
"lang_ro" => "Romanian",
"lang_ru" => "Russian",
"lang_es" => "Spanish",
"lang_sv" => "Swedish",
"lang_tr" => "Turkish");
    
	return $languages{$_[0]};
}

sub get_topicname {
    my (%topics) = (
"all" => "(All Topics)",
"unclesam" => "US. Government",
"linux" => "Linux",
"mac" => "Macintosh",
"bsd" => "FreeBSD");
    
	return $topics{$_[0]};
}

sub getmonth {
	$time = time();
    ($sec, $min, $hour, $day, $mon, $theyear, $dweek, $dyear, $daylight) = localtime($_[0]);
	$month = $monthnames[$mon];
	$year = $theyear + 1900;
}
sub revertdate {
    my (%themonths) = ("January" => 0, "February" => 1, "March" => 2, "April" => 3, "May" => 4, "June" => 5, 
                    "July" => 6, "August" => 7, "September" => 8, "October" => 9, "November" => 10,"December" => 11);
my ($thetime);
		eval {$theyear = $viewyear - 1900; 
        $thetime = timelocal(0,0,0, $viewday, $themonths{$viewmonth}, $theyear);};
          if ($@) { return undef; } # Could return 0 if you want.
 return "$thetime"; 
}
sub revertdate2 {
my ($thetime);
		eval {$theyear = $viewyear - 1900; 
        $thetime = timelocal(0,0,0, $viewday,$viewmonth, $viewyear);};
          if ($@) { return undef; } # Could return 0 if you want.
 return "$thetime"; 
}


1;
