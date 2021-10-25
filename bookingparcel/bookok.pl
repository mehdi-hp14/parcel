
$heading="bookok";

use CGI;
use CGI qw/:standard/;
use CGI qw(param);
use FileHandle;
use IPC::Open2;


sub home{

# private key file to use
my $MY_KEY_FILE = "private_key_for_europost.pem";

# public certificate file to use - should match the $cert_id
my $MY_CERT_FILE = "public_key_for_europost.pem";

# Paypal's public certificate that they publish on the Profile >
# Website-Certificate page.  Default is to use the sandbox cert.
my $PAYPAL_CERT_FILE;

# File that holds extra parameters for the paypal transaction.
my $MY_PARAM_FILE = "paypal_params.txt";

# path to the openssl binary
my $OPENSSL = "/usr/bin/openssl";
#my $OPENSSL = "C:\\OpenSSL\\Bin\\openssl.exe";
#my $OPENSSL = "/usr/local/bin/openssl";

$SQL = "SELECT packages, s_contact, s_add1, s_add2, s_tel1, s_tel2, s_tel3, s_city, s_state, s_postcode, vatpercent, oprice, ofuel, obook, oremote, ocust, s_email, ovat, oinscharge, cs.country as cscountry, cd.country as cdcountry, volformula, services.service as servicename FROM orders LEFT JOIN countries as cs ON orders.s_country=cs.id LEFT JOIN countries as cd ON orders.d_country=cd.id LEFT JOIN zones on orders.zoneid=zones.zoneid LEFT JOIN services on zones.servid=services.id WHERE orderid=$orderid";
&my_sql;

if ( $column = $sth->fetchrow_hashref )
	{
	$tot_weight = 0;
	$SQL2 = "SELECT * from orderdetails WHERE orderid=$orderid";
	&my_sql2;
	while ( $column2 = $sth2->fetchrow_hashref )
		{
		$wv = toCurr(($column2->{'length'} * $column2->{'width'} * $column2->{'height'}) / $column->{'volformula'});
		$wv = $column2->{'weight'} if( $column2->{'weight'} > $wv );
		$tot_weight = $tot_weight + $wv;
		}
	$sth2->finish;

	$s_contact = $column->{'s_contact'};
	$s_add1 = $column->{'s_add1'};
	$s_add2 = $column->{'s_add2'};
	$tel = $column->{'s_tel1'} . " " . $column->{'s_tel2'} . " " . $column->{'s_tel3'};
	$s_city = $column->{'s_city'};
	$s_state = $column->{'s_state'};
	$s_postcode = $column->{'s_postcode'};
	$cscountry = $column->{'cscountry'};
	$cdcountry = $column->{'cdcountry'};
	$s_email = $column->{'s_email'};
	$packages = $column->{'packages'};
	$servicename = $column->{'servicename'};
	$vatpercent = omit0($column->{'vatpercent'});

	$mytotal_price = toCurr($column->{'oprice'}+$column->{'ofuel'}+$column->{'obook'}+$column->{'oremote'}+$column->{'ocust'}+$column->{'oinscharge'});
	if( $s_paypal > 0 )
		{
		$mytotal_price_pp = toCurr(($column->{'oprice'}+$column->{'ofuel'}+$column->{'obook'}+$column->{'oremote'}+$column->{'ocust'}+$column->{'oinscharge'}) + ((($column->{'oprice'}+$column->{'ofuel'}+$column->{'obook'}+$column->{'oremote'}+$column->{'ocust'}+$column->{'oinscharge'}) * $s_paypal) / 100));
		}
	else
		{
		$mytotal_price_pp = $mytotal_price;
		}
		
	if( $column->{'ovat'} > 0 )
		{
		$myvat = toCurr($column->{'ovat'});
		if( $s_paypal > 0 )
			{
			$myvat_pp = toCurr($column->{'ovat'} + (($column->{'ovat'} * $s_paypal) / 100));
			}
		else
			{
			$myvat_pp = $myvat;
			}
		}
	else
		{
		$myvat = 0;
		$myvat_pp = 0;
		}
	$totaltopay = toCurr($mytotal_price + $myvat);
	}
else
	{
	$orderid = "";
	}
$sth->finish;

&myheader($heading);

&topmenu($heading);

print qq|

<div class="ha8"><H1><font color="#000080" size="2"><b>Parcel Delivery</b></font></H1>
<h2><font color="#000080" size="1"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Booking Payment (Step 6 of 6)</b></font></h2>
<font size="2">

<br />
<br />
|;

if( $orderid )
	{
	if( $s_email ne "shahyar7\@gmail.com" )
		{
		$paypal_site = "https://www.paypal.com/cgi-bin/webscr";
		$paypal_semail = $paypalemail;
		$paypal_bemail = $s_email;
		$custom="epx0";
		$PAYPAL_CERT_FILE = "paypal_cert.pem";
		$paypal_cert_id = "MCFUY4P7XX9MA";
		}
	else
		{
		$paypal_site = "https://www.sandbox.paypal.com/cgi-bin/webscr";
		$paypal_semail = "info_1251820525_biz\@thaimassage.ir";
		$paypal_bemail = "info_1251820359_per\@thaimassage.ir";
		$custom="epx1";
		$PAYPAL_CERT_FILE = "paypal_sandbox_cert.pem";
		$paypal_cert_id = "M2L6E2V8ASDAL";
		}

	unless( -x $OPENSSL )
		{
		error_page("Could not execute $OPENSSL: $!\n");
		exit;
		}
	
	# Send arguments into the openssl commands needed to do the sign,
	# encrypt, s/mime magic commands.  This works under FreeBSD with
	# OpenSSL '0.9.7e 25 Oct 2004' but segfaults with '0.9.7d 17 Mar
	# 2004'.  It also works under OpenBSD with OpenSSL '0.9.7c 30 Sep
	# 2003'.
	my $pid = open2(*READER, *WRITER,
			"$OPENSSL smime -sign -signer $MY_CERT_FILE " .
			"-inkey $MY_KEY_FILE -outform der -nodetach -binary " .
			"| $OPENSSL smime -encrypt -des3 -binary -outform pem " .
			"$PAYPAL_CERT_FILE");
			
	unless( $pid )
		{
	  error_page("Could not run open2 on $OPENSSL: $!\n");
	  exit;
		}
		
  print WRITER "cmd=_ext-enter\n";
  print WRITER "cert_id=$paypal_cert_id\n";
  print WRITER "redirect_cmd=_xclick\n";
  print WRITER "return=$DomainURL/payok.cgi\n";
  print WRITER "cancel_return=$DomainURL/paycancel.cgi\n";
  print WRITER "receiver_email=$paypal_semail\n";
  print WRITER "business=$paypal_semail\n";
  print WRITER "login_email=$paypal_bemail\n";
  print WRITER "email=$paypal_bemail\n";
  print WRITER "custom=$custom\n";
  print WRITER "amount=$mytotal_price_pp\n";
  print WRITER "item_name=Booking Order\n";
  print WRITER "item_number=$orderid\n";
  print WRITER "currency_code=GBP\n";
  print WRITER "invoice=$orderid\n";
  print WRITER "address1=$s_add1\n";
  print WRITER "address2=$s_add2\n";
  print WRITER "city=$s_city\n";
  print WRITER "country=$cscountry\n";
  print WRITER "state=$s_state\n";
  print WRITER "zip=$s_postcode\n";
  print WRITER "last_name=$s_contact\n";
  print WRITER "day_phone_a=$tel\n";
	if( $myvat )
		{
	  print WRITER "tax=$myvat_pp\n";
		}

	# close the writer file-handle
	close(WRITER);
	
	# read in the lines from openssl
	my @lines = <READER>;
	
	# close the reader file-handle which probably closes the openssl processes
	close(READER);
	
#	print "[$OPENSSL smime -sign -signer $MY_CERT_FILE " .
#			"-inkey $MY_KEY_FILE -outform der -nodetach -binary " .
#			"| $OPENSSL smime -encrypt -des3 -binary -outform pem " .
#			"$PAYPAL_CERT_FILE]";
	
#	exit;
	# combine them into one variable
	my $encrypted = join('', @lines);

	print qq|
	<b>Thank you. Your booking saved SUCCESSFULLY in our system.</b><br />
	Please review the booking details below and<br />
	press the button below to pay by Paypal,<br />
	otherwise we will call you soon to follow up your booking.<br /><br />
	If you decide to pay by PayPal, you will be redirected back to<br />
	the EuroPostExpress site after payment is completed.<br />
	Please ensure you allow Paypal to redirect you back to this site once payment is completed.<br /><br />
	<table style="background-color:#FDF3D0; width: 100%" align="center">
	<tr>
	<td colspan="2">
	<b>Booking Summary:</b>
	</td>
	</tr>
	<tr>
	<td width="200">
	<b>Source:</b>
	</td>
	<td width="800">
	$cscountry
	</td>
	</tr>
	<tr>
	<td width="200">
	<b>Destination:</b>
	</td>
	<td width="800">
	$cdcountry
	</td>
	</tr>
	
	<tr>
	<td width="200">
	<b>Number of Packages:</b>
	</td>
	<td width="800">
	$packages
	</td>
	</tr>
	<tr>
	<td width="200">
	<b>Total Weight:</b>
	</td>
	<td width="800">
	$tot_weight&nbsp;<small>Kgs</small>
	</td>
	</tr>
	<tr>
	<td colspan="2" height="10">
	&nbsp;
	</td>
	</tr>
	<tr>
	<td width="200">
	<b>Service:</b>
	</td>
	<td width="800">
	$servicename
	</td>
	</tr>
	<tr>
	<td colspan="2" height="10">
	&nbsp;
	</td>
	</tr>
	<tr>
	<td width="200">
	<b>Courier Services:</b>
	</td>
	<td width="800">
	£ $mytotal_price
	</td>
	</tr>|;
	
	if( $myvat )
		{
		print qq|
		<tr>
		<td width="200">
		<b>VAT @ $vatpercent\%:</b>
		</td>
		<td width="800">
		£ $myvat
		</td>
		</tr>
	|;
	}

	print qq|
		<tr>
		<td width="200">
		<b>Total to Pay::</b>
		</td>
		<td width="800">
		£ $totaltopay
		</td>
		</tr>
	<tr>
	<td colspan="2" height="10">
	&nbsp;
	</td>
	</tr>
	|;
	
	if( $s_paypal > 0 )
		{
		print qq|
		<tr>
		<td colspan="2"><center>
		<span style="padding:2px; border-style: solid; border-width:1px; border-color:#000000;">A 2% surcharge will be added to all Paypal payments.</span>
		</center>
		</td>
		</tr>
		|;
		}
	
	print qq|
	<tr>
	<td colspan="2" height="10">
	&nbsp;
	</td>
	</tr>
	<tr>
	<td colspan="2"><center>
		<form class="nofrm" method="post" action="$paypal_site" onsubmit="this.paypalsubmit.disabled=true;">
		<input type="hidden" name="cmd" value="_s-xclick">
		<input type="hidden" name="encrypted" value="
$encrypted" />
		<input name="paypalsubmit" type="image" src="img/content/btn_paynowCC_LG.gif" width="144" height="47" style="border:0px;" |;
		
		if( $s_paypal > 0 )
			{
			print qq|alt="Pay Now By PayPal ($s_paypal\% Surecharge)" />
			|;
			}
		else
			{
			print qq|alt="Pay Now By PayPal" />
			|;
			}
		
		print qq|
		</form>
		</center>
		</td>
		</tr>
	</table>
	<br />
	<br />
	<br />
	<br />
	|;
	}
else
	{
	print qq|
<br />
<br />
<br />
<br />
<br />
<font color="#FF0000">Booking reference not found!</font>
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
|;
	}
	
print qq|
</font></div>

|;

&footer;

}

1;