
use CGI; ## load the cgi module

$heading = "orders";

sub home{
}

sub view{
	unless ($orderid) { &error_page("Not valid Booking Ref.!"); exit;}

	$SQL = "SELECT orders.*, zones.*, services.id as serviceid, services.service as service, members.userid as uid, members.username, members.sal, members.fname, members.lname, members.company, members.email FROM orders LEFT JOIN zones on orders.zoneid=zones.zoneid LEFT JOIN services on zones.servid=services.id LEFT OUTER JOIN members ON orders.userid=members.userid WHERE orderid = $orderid"; 
	&my_sql;
	if ($column = $sth->fetchrow_hashref){

		unless( $isAdmin || $column->{'userid'} == $isUser ) {&error_page("You don't have enough permission for this operation."); exit;}

		&myheader("viewbook");
		&topmenu("viewbook");

print qq|

<div class="ha8">
				<span class="text1"><font face="Arial" size="2"><b>Booking Details:</b></font></span>
				<br /><br />
				|;

if( $isAdmin )
	{
	print qq|<h1><center><font color="#000080" size="1">

				<a href="$script?cf=orders&delete=1&orderid=$orderid" class="noneunderline" onclick="javascript:return confirm('Are you sure you want to delete this booking?')"><img src="img/content/delete.jpg" width="16" height="16" border="0" alt="Delete Booking" valign="middle" style="vertical-align: middle;" /></a>&nbsp;&nbsp;<a href="$script?cf=orders&delete=1&orderid=$orderid" class="noneunderline" onclick="javascript:return confirm('Are you sure you want to delete this booking?')">Delete Booking</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" class="noneunderline" onClick="javascript:window.open('$script?cf=orders&printit=1&orderid=$orderid','printbooking','width=' + (screen.width - 40) + ',height=' + (screen.height - 100) + ',top=20,left=10,scrollbars=yes,toolbar=no,status=no,menubar=yes,resizable=no,location=no')"><img src="img/content/print.jpg" width="16" height="16" border="0" alt="Print Booking" valign="middle" style="vertical-align: middle;" /></a>&nbsp;&nbsp;<a href="javascript:void(0);" class="noneunderline" onClick="javascript:window.open('$script?cf=orders&printit=1&orderid=$orderid','printbooking','width=' + (screen.width - 40) + ',height=' + (screen.height - 100) + ',top=20,left=10,scrollbars=yes,toolbar=no,status=no,menubar=yes,resizable=no,location=no')">Print Booking</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				|;
				
		if( $column->{'type'} == 1 )
			{
			print qq|<a class="noneunderline" href="$script?cf=orders&priority=2&orderid=$orderid"><img src="img/content/uparrow.jpg" width="16" height="16" border="0" alt="Make Booking as 'High Priority'" valign="middle" style="vertical-align: middle;" /></a>&nbsp;&nbsp;<a class="noneunderline" href="$script?cf=orders&priority=2&orderid=$orderid">Make Booking as 'High Priority'<a>|;
			}
		else
			{
			print qq|<a class="noneunderline" href="$script?cf=orders&priority=1&orderid=$orderid"><img src="img/content/dnarrow.jpg" width="16" height="16" border="0" alt="Make Booking as 'Normal Priority'" valign="middle" style="vertical-align: middle;" /></a>&nbsp;&nbsp;<a class="noneunderline" href="$script?cf=orders&priority=1&orderid=$orderid">Make Booking as 'Normal Priority'</a>|;
			}
				
				print qq|
	</center></font></h1>|;
	}
else
	{
	print qq|<h1><center><font color="#000080" size="1"><a href="javascript:void(0);" class="noneunderline" onClick="javascript:window.open('$script?cf=orders&printit=1&orderid=$orderid','printbooking','width=' + (screen.width - 40) + ',height=' + (screen.height - 100) + ',top=20,left=10,scrollbars=yes,toolbar=no,status=no,menubar=yes,resizable=no,location=no')"><img src="img/content/print.jpg" width="16" height="16" border="0" alt="Print Booking" valign="middle" style="vertical-align: middle;" /></a>&nbsp;&nbsp;<a href="javascript:void(0);" class="noneunderline" onClick="javascript:window.open('$script?cf=orders&printit=1&orderid=$orderid','printbooking','width=' + (screen.width - 40) + ',height=' + (screen.height - 100) + ',top=20,left=10,scrollbars=yes,toolbar=no,status=no,menubar=yes,resizable=no,location=no')">Print Booking</a></font></center></h1>|;
	}

print qq|
<font size="2" face="Arial">
	<table style="width: 100%" align="left" border="1" cellpadding="2" cellspacing="0">|;
	
if( $isAdmin )
{
print qq|
		<tr>
			<td style="background-color:#FDF3D0"><center><big><b>Booking Details</b></big></center></td>
		</tr>
		<tr>
			<td align="left">
			<b>Booking Ref.:</b> $column->{'orderid'}<br />|;
	
			if( $column->{'uid'} )
				{
				print qq|<b>Username:</b> <a href="$scripturl?cf=members&view=1&memid=$column->{'uid'}">$column->{'username'}</a><br />|;
				print "&nbsp;&nbsp;&nbsp;<b>Full Name:</b> $column->{'sal'} $column->{'fname'} $column->{'lname'}<br />";
				print "&nbsp;&nbsp;&nbsp;<b>Company:</b> $column->{'company'}<br />";
				print qq|&nbsp;&nbsp;&nbsp;<b>Email:</b> <a href="mailto:$column->{'email'}">$column->{'email'}</a><br />|;
				}
			print "<b>Date:</b> $column->{'orderdate'}<br />";
			print "<b>Type:</b> ";
			
			if( $column->{'type'} == 2 )
				{
				print "<font color=\"#FF0000\">High Priority</font><br />";
				}
			else
				{
				print "Normal Priority<br />";
				}

			if( $column->{'status'} == 2 )
				{
				print qq|<form style="background-color:#FFFFFF" calss="nofrm" action="$script" onsubmit="return validateForm(this);">|;
				}
			
			print "<b>Status:</b> ";

			if( $column->{'status'} == 9 )
				{
				print "Canceled<br />";
				}
			elsif( $column->{'status'} == 4 )
				{
				$TSQL = "SELECT carriers.abbr as scarabr, services.service as servicename from services LEFT JOIN carriers ON services.carid=carriers.id WHERE services.id=$column->{'bservice'}";
				&tmy_sql;
				if ($tcolumn = $tsth->fetchrow_hashref)
					{
					if( $tcolumn->{'scarabr'} eq "DHL" )
						{
						print qq|Done     (Service: $tcolumn->{'servicename'} - Tracking No.: <a href="$script?cf=track&track=2&dhl=$column->{'breference'}" target=_BLANK>$column->{'breference'}</a>)
						&nbsp;&nbsp;<a href="$script?cf=track&track=2&dhl=$column->{'breference'}" target=_BLANK><img src="img/content/track.gif" width="37" height="28" border="0" alt="Track It!" style="vertical-align: middle;" /></a>
						&nbsp;&nbsp;&nbsp;&nbsp;<a href="$script?cf=orders&changestatus=6&orderid=$orderid">Cancel Assigned Booking</a>
						&nbsp;&nbsp;&nbsp;<a href="$script?cf=orders&changestatus=5&orderid=$orderid" target=_BLANK>Resend Invoice</a>
						<br />|;
						}
					elsif( $tcolumn->{'scarabr'} eq "DPD" )
						{
						print qq|Done     (Service: $tcolumn->{'servicename'} - Tracking No.: <a href="$script?cf=track&track=2&dpd=$column->{'breference'}" target=_BLANK>$column->{'breference'}</a>)
						&nbsp;&nbsp;<a href="$script?cf=track&track=2&dpd=$column->{'breference'}" target=_BLANK><img src="img/content/track.gif" width="37" height="28" border="0" alt="Track It!" style="vertical-align: middle;" /></a>
						&nbsp;&nbsp;&nbsp;&nbsp;<a href="$script?cf=orders&changestatus=6&orderid=$orderid">Cancel Assigned Booking</a>
						&nbsp;&nbsp;&nbsp;<a href="$script?cf=orders&changestatus=5&orderid=$orderid" target=_BLANK>Resend Invoice</a>
						<br />|;
						}
					else
						{
						print qq|Done     (Service: $tcolumn->{'servicename'} - Tracking No.: $column->{'breference'})
						&nbsp;&nbsp;&nbsp;&nbsp;<a href="$script?cf=orders&changestatus=6&orderid=$orderid">Cancel Assigned Booking</a>
						&nbsp;&nbsp;&nbsp;<a href="$script?cf=orders&changestatus=5&orderid=$orderid" target=_BLANK>Resend Invoice</a>
						<br />|;
						}
					}
				$tsth->finish;
				}
			elsif( $column->{'status'} == 3 )
				{
				$TSQL = "SELECT carriers.abbr as scarabr, services.service as servicename from services LEFT JOIN carriers ON services.carid=carriers.id WHERE services.id=$column->{'bservice'}";
				&tmy_sql;
				if ($tcolumn = $tsth->fetchrow_hashref)
					{
					if( $tcolumn->{'scarabr'} eq "DHL" )
						{
						print qq|Booked   (Service: $tcolumn->{'servicename'} - Tracking No.: <a href="$script?cf=track&track=2&dhl=$column->{'breference'}" target=_BLANK>$column->{'breference'}</a>)
						&nbsp;&nbsp;<a href="$script?cf=track&track=2&dhl=$column->{'breference'}" target=_BLANK><img src="img/content/track.gif" width="37" height="28" border="0" alt="Track It!" style="vertical-align: middle;" /></a>
						&nbsp;&nbsp;&nbsp;&nbsp;<a href="$script?cf=orders&changestatus=6&orderid=$orderid">Cancel Assigned Booking</a>
						&nbsp;&nbsp;&nbsp;&nbsp;<a href="$script?cf=orders&changestatus=4&orderid=$orderid">Make Booking As Done</a>
						&nbsp;&nbsp;&nbsp;&nbsp;<a href="$script?cf=orders&changestatus=5&orderid=$orderid" target=_BLANK>Resend Invoice</a>
						<br />|;
						}
					elsif( $tcolumn->{'scarabr'} eq "DPD" )
						{
						print qq|Booked   (Service: $tcolumn->{'servicename'} - Tracking No.: <a href="$script?cf=track&track=2&dpd=$column->{'breference'}" target=_BLANK>$column->{'breference'}</a>)
						&nbsp;&nbsp;<a href="$script?cf=track&track=2&dpd=$column->{'breference'}" target=_BLANK><img src="img/content/track.gif" width="37" height="28" border="0" alt="Track It!" style="vertical-align: middle;" /></a>
						&nbsp;&nbsp;&nbsp;&nbsp;<a href="$script?cf=orders&changestatus=6&orderid=$orderid">Cancel Assigned Booking</a>
						&nbsp;&nbsp;&nbsp;&nbsp;<a href="$script?cf=orders&changestatus=4&orderid=$orderid">Make Booking As Done</a>
						&nbsp;&nbsp;&nbsp;&nbsp;<a href="$script?cf=orders&changestatus=5&orderid=$orderid" target=_BLANK>Resend Invoice</a>
						<br />|;
						}
					else
						{
						print qq|Booked   (Service: $tcolumn->{'servicename'} - Tracking No.: $column->{'breference'})
						&nbsp;&nbsp;&nbsp;&nbsp;<a href="$script?cf=orders&changestatus=6&orderid=$orderid">Cancel Assigned Booking</a>
						<br />|;
						}
					}
				$tsth->finish;
				}
			elsif( $column->{'status'} == 2 )
				{
				if( $column->{'payid'} )
					{
					print qq|Paid via PayPal (TxId:$column->{'payid'})&nbsp;&nbsp;&nbsp;|;
					}
				else
					{
					print qq|Paid&nbsp;&nbsp;&nbsp;|;
					}
				
				print qq|<a href="$script?cf=orders&changestatus=9&orderid=$orderid">Make Booking As Canceled</a>&nbsp;&nbsp;|;
				
				if( $column->{'payid'} )
					{
					print "OR<br />";
					}
				else
					{
					print "OR&nbsp;&nbsp;&nbsp;";
					}
				
				print qq|
				<input name="cf" type="hidden" value="orders" />
				<input name="changestatus" type="hidden" value="3" />
				<input name="orderid" type="hidden" value="$orderid" />
				<select name="service">
				<option value="">Please Select ...</option>
				|;
			
				$TSQL = "SELECT DISTINCT id, service FROM services ORDER BY service";
				&tmy_sql;
			
				while ($tcolumn = $tsth->fetchrow_hashref)
					{
					print qq|<option value="$tcolumn->{'id'}"|;
					
					if( $tcolumn->{'id'} == $column->{'serviceid'} )
						{
						print " selected ";
						}
					
					print qq|>$tcolumn->{'service'}</option>\n|;
					}
		
				$tsth->finish;
			
				print qq|
				</select>
				&nbsp;&nbsp;Tracking No.:<input name="reference" type="text" size="20" value="" MAXLENGTH=20 />
				&nbsp;&nbsp;<input type="submit" value="Make Booking as Booked" />
				</form>
				<br />|;
				}
			else
				{
				print qq|<font color="#FF0000">Not Processed</font>
				&nbsp;&nbsp;&nbsp;<a href="$script?cf=orders&changestatus=2&orderid=$orderid">Make Booking As Paid</a>
				<br />
				|;
				}
				
print qq|
</td>
		</tr>|;
}

print qq|	
		<tr>
			<td style="background-color:#FDF3D0"><center><big><b>Collection Address</b></big></center></td>
		</tr>
		<tr>
			<td align="left">
			<b>Contact Name:</b> $column->{'s_contact'}<br />|;
	
			print "<b>Company:</b> $column->{'s_company'}<br />" if( $column->{'s_company'} );
			print "<b>Land Phone:</b> +$column->{'s_tel1'} ( $column->{'s_tel2'} ) $column->{'s_tel3'}<br />";
			print "<b>Cell Phone:</b> +$column->{'s_mob1'} ( $column->{'s_mob2'} ) $column->{'s_mob3'}<br />"  if( $column->{'s_mob1'} || $column->{'s_mob2'} || $column->{'s_mob3'} );
			print "<b>Fax:</b> +$column->{'s_fax1'} ( $column->{'s_fax2'} ) $column->{'s_fax3'}<br />"  if( $column->{'s_fax1'} || $column->{'s_fax2'} || $column->{'s_fax3'} );
			print "<b>Address:</b> $column->{'s_add1'}<br />";
			print "$column->{'s_add2'}<br />"  if( $column->{'s_add2'} );

print qq|
			<b>Post Code:</b> $column->{'s_postcode'}<br />
			<b>City:</b> $column->{'s_city'}<br />
			<b>County:</b> $column->{'s_state'}<br />
			<b>Country:</b> |; 
			
			print get_country($column->{'s_country'});

			print qq|<br /><b>Email:</b> <a href="mailto:$column->{'s_email'}">$column->{'s_email'}</a>| if($column->{'s_email'});
			
print qq|<br />
			<b>Ready Time:</b> $column->{'fromtime'}<br />
			<b>Deadline Time:</b> $column->{'totime'}<br />
</td>
		</tr>
		<tr>
			<td style="background-color:#FDF3D0"><center><big><b>Delivery Address</b></big></td>
		</tr>
		<tr>
			<td align="left">
			<b>Recipient Name:</b> $column->{'d_contact'}<br />|;
	
			print "<b>Recipient Company:</b> $column->{'d_company'}<br />" if( $column->{'d_company'} );
			print "<b>Land Phone:</b> +$column->{'d_tel1'} ( $column->{'d_tel2'} ) $column->{'d_tel3'}<br />";
			print "<b>Cell Phone:</b> +$column->{'d_mob1'} ( $column->{'d_mob2'} ) $column->{'d_mob3'}<br />"  if( $column->{'d_mob1'} || $column->{'d_mob2'} || $column->{'d_mob3'} );
			print "<b>Fax:</b> +$column->{'d_fax1'} ( $column->{'d_fax2'} ) $column->{'d_fax3'}<br />"  if( $column->{'d_fax1'} || $column->{'d_fax2'} || $column->{'d_fax3'} );
			print "<b>Address:</b> $column->{'d_add1'}<br />";
			print "$column->{'d_add2'}<br />"  if( $column->{'d_add2'} );

print qq|
			<b>Post Code:</b> $column->{'d_postcode'}<br />
			<b>City:</b> $column->{'d_city'}<br />
			<b>County:</b> $column->{'d_state'}<br />
			<b>Country:</b> |;
			
			print get_country($column->{'d_country'});

			print qq|<br /><b>Email:</b> <a href="mailto:$column->{'d_email'}">$column->{'d_email'}</a>| if($column->{'d_email'});
			
print qq|
</td>
		</tr>
		<tr>
			<td style="background-color:#FDF3D0"><center><big><b>Shipment Details</b></big></center></td>
		</tr>
		<tr>
			<td align="left">|;

			print qq|<b>Content:</b> |;
			
			if( $column->{'docu'} eq "1" )
				{
				print "Document<br />";
				}
			else
				{
				print "Parcel<br />";
				print qq|<b>Contents:</b> $column->{'content'}<br />|;
				}

			print qq|
			<b>Value:</b> £&nbsp;$column->{'val'}<br />
	
			<b>Number of Packages:</b> $column->{'packages'}<br /><br />
		
			<table width="650" align="left" border="1" cellspaceing="0">
			<tr>
			<th width="100" align="left">Pack</th>
			<th width="100" align="left">Weight <small>(kg)</small></th>
			<th width="100" align="left">Length <small>(cm)</small></th>
			<th width="100" align="left">Width <small>(cm)</small></th>
			<th width="100" align="left">Height <small>(cm)</small></th>
			<th width="150" align="left">Vol. Weight <small>(kg)</small></th>
			</tr>	
			|;

			$SQL2 = "SELECT * FROM orderdetails WHERE orderid = $orderid ORDER BY item"; 
			&my_sql2;
			
			$actualw = 0;
			$volw = 0;
			while ($column2 = $sth2->fetchrow_hashref)
				{
				$tmpvolw = toCurr((($column2->{'length'} * $column2->{'width'} * $column2->{'height'}) / 4000));
				$actualw = $actualw + $column2->{'weight'};
				$volw = $volw + $tmpvolw;
				print "<tr>\n";
				print "<td width=\"100\" align=\"left\">$column2->{'item'}</td>";
				print "<td width=\"100\"  align=\"left\">$column2->{'weight'}</td>";
				print "<td width=\"100\"  align=\"left\">$column2->{'length'}</td>";
				print "<td width=\"100\"  align=\"left\">$column2->{'width'}</td>";
				print "<td width=\"100\"  align=\"left\">$column2->{'height'}</td>";
				print "<td width=\"150\"  align=\"left\">$tmpvolw</td>";
				print "</tr>\n";
				}
			print "<tr>\n";
			print "<td width=\"100\" align=\"left\"><b>Total:</b></td>";
			print "<td colspan=\"4\" align=\"left\">$actualw</td>";
			print "<td width=\"150\"  align=\"left\">$volw</td>";

			$actualw = $volw if( $volw > $actualw );

			print "</tr>\n";
			print "<tr>\n";
			print "<td colspan=\"6\" align=\"left\"><b><u>Total Weight:&nbsp;$actualw Kgs</u></b></td>";
			print "</tr>\n";
			$sth2->finish;
				
			print qq|
			</table>
			</td>
		</tr>
		<tr>
			<td style="background-color:#FDF3D0"><center><big><b>Service & Quote</b></big></center></td>
		</tr>
		<tr>
			<td align="left">
			<b>Service Name:</b> $column->{'service'}<br />
			<ul>|;
			
			if( $column->{'odutiable'} )
				{ 
				print "<li>$column->{'odutiable'}</li>";
				}

			if( $column->{'opartcover'} )
				{ 
				print "<li>$column->{'opartcover'}</li>";
				}

			if( $column->{'oinvreq'} )
				{ 
				print "<li>$s_invtext</li>";
				}
			
			print "</ul>";
			
		print qq|
			<br /><span style="border-style: solid; border-width: 2px; padding: 3px; margin: 3px"><b>Price: £|;

			print toCurr($column->{'oprice'}+$column->{'ofuel'}+$column->{'obook'}+$column->{'oremote'}+$column->{'ocust'});
			
			if( $column->{'vatpercent'} && $column->{'vatpercent'} > 0 )
				{
				print " + ";
				print omit0($column->{'vatpercent'});
				print "% VAT";
				}
			print qq|</b></span><br /><br />
</td>
		</tr>
	</table>
</font>
<br />
|;

print qq|
<br />
</div>

|;

&footer;

		$sth->finish;
	}
	else
		{
			$sth->finish;
			error_page("Booking not found!");
		}
}

sub changestatus{
	my $newstatus = shift;
	
	unless ($orderid) {&error_page("Not valid Booking Reference!"); exit;} 
	unless ($newstatus) {&error_page("New Status is not defined!"); exit;} 

	my $str2send = "";
	my $fg_email;

	if( $newstatus eq "3" || $newstatus eq "5" )
		{
		if( $newstatus eq "3" )
			{
			unless ($service) {&error_page("Please select a Service Carrier!"); exit;} 
			unless ($reference && length($reference) >= 8 ) {&error_page("Please specify a valid Tracking No.!"); exit;} 
			}

		my $scarname = "";
		
		$TSQL = "SELECT * from orders WHERE orderid=$orderid";
		&tmy_sql;
		if ($tcolumn = $tsth->fetchrow_hashref)
			{
			my ($str1, $str2, $str3, $str4, $str5, $str6);
			
			if( $newstatus eq "5" )
				{
				$service = $tcolumn->{'bservice'};
				$reference = $tcolumn->{'breference'};
				}
				
			$SQL2 = "SELECT carriers.abbr as scarabr from services LEFT JOIN carriers ON services.carid=carriers.id WHERE services.id=$service";
			&my_sql2;
			if ($column2 = $sth2->fetchrow_hashref)
				{
				$scarname = $column2->{'scarabr'};
				}
			$sth2->finish;
			
			if( $scarname eq "DHL" )
				{
				$str6 = "You can track your parcel by visiting <a href=\"$scripturl?cf=track&track=2&dhl=$reference\">$scripturl?cf=track&track=2&dhl=$reference</a><br />";
				}
			elsif( $scarname eq "DPD" )
				{
				$str6 = "You can track your parcel by visiting <a href=\"$scripturl?cf=track&track=2&dpd=$reference\">$scripturl?cf=track&track=2&dhl=$reference</a><br />";
				}
			else
				{
				$str6 = "";
				}
			
			if( $tcolumn->{'s_company'}	)
				{
				$str1 = "&nbsp;&nbsp;($tcolumn->{'s_company'})<br />";
				}
			else
				{
				$str1 = "";
				}
			
			$str2 = toCurr($tcolumn->{'oprice'}+$tcolumn->{'ofuel'}+$tcolumn->{'obook'}+$tcolumn->{'oremote'}+$tcolumn->{'ocust'});
			$str3 = toCurr($tcolumn->{'oprice'}+$tcolumn->{'ofuel'}+$tcolumn->{'obook'}+$tcolumn->{'oremote'}+$tcolumn->{'ocust'}+$tcolumn->{'ovat'});
			
			if( $tcolumn->{'ovat'} > 0 )
				{
				if( $tcolumn->{'vatpercent'} > 0 )
					{
					$str4 = "VAT \@$tcolumn->{'vatpercent'}\%";
					}
				else
					{
					$str4 = "VAT \@17.50\%";
					}
				}
			else
				{
				$str4 = "&nbsp;";
				}

			if( $tcolumn->{'ovat'} > 0 )
				{
				$str5 = "£$tcolumn->{'ovat'}";
				}
			else
				{
				$str5 = "&nbsp;";
				}

			$fg_email = $tcolumn->{'s_email'};

			$str2send = <<END_OF_MESSAGE_EMAIL;

<body>
			
<font face="Tahoma" size="2"><p>Dear $tcolumn->{'s_contact'},<br><br>Your parcel has been booked.$str6
Here is your invoice:<br /><br /><br /></font>

<center>


<table style="width: 800px; border-width: 0px;" cellspacing="0">
	<tr>
		<td style="width: 250px; border-color:black; border-left-style: solid;border-left-width: 1px;border-top-style: solid;border-top-width: 1px;">
		<img src="$Domain/img/content/slogan_01.gif" width="237" height="56" /></td>
		<td style="font-size: x-large;text-align: center; border-color:black; border-right-style: solid;border-right-width: 1px;border-top-style: solid;border-top-width: 1px; width: 550px" colspan="3"><strong>INVOICE</strong>&nbsp;&nbsp;
		</td>
	</tr>
	<tr>
		<td style="width: 250px; border-color:black; border-left-style: solid;border-left-width: 1px;border-bottom-style: solid;border-bottom-width: 1px;">Unit E5 , Aladdin Business 
		Centre<br />
		246 Long Drive<br />
		Greenford Middx<br />
		UB6 8UH<br />
		Tel: +44 203 255 2056<br />
		Fax:+44 208 575 0209<br />
		<strong>VAT No. $s_vatno</strong></td>
		<td colspan="3" style="border-color:black; border-right-style: solid;border-right-width: 1px;border-bottom-style: solid;border-bottom-width: 1px; width: 550px" align="left">
		INVOICE TO : $tcolumn->{'s_contact'} $str1		
		DATE : $tcolumn->{'orderdate'}<br />
		ORDER REF. : EPX$orderid<br />
		BOOKING REF. : $scarname - $reference</td>
	</tr>
	<tr>
		<td style="width: 250px; border-color:black; border-width: 0px;">&nbsp;
		</td>
		<td style="width: 300px; border-color:black; border-width: 0px;">&nbsp;
		</td>
		<td style="width: 250px; border-color:black; border-width: 0px;" colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2" style="width: 550px; border-color:black; border-left-style: solid;border-left-width: 1px;border-right-style: none;border-right-width: 1px;border-top-style: solid;border-top-width: 1px;border-bottom-style: solid;border-bottom-width: 1px;"><center><strong>DESCRIPTION</strong></center></td>
		<td style="width: 130px; border-color:black; border-left-style: none;border-left-width: 1px;border-right-style: solid;border-right-width: 1px;border-top-style: solid;border-top-width: 1px;border-bottom-style: solid;border-bottom-width: 1px;">&nbsp;</td>
		<td style="width: 120px; border-color:black; border-style: solid;border-width: 1px;"><center><strong>AMOUNT</strong></center></td>
	</tr>
	<tr>
		<td colspan="2" style="width: 550px; border-color:black; border-left-style: solid;border-left-width: 1px;border-right-style: none;border-right-width: 1px;border-top-style: solid;border-top-width: 1px;border-bottom-style: solid;border-bottom-width: 1px;" align="left"><br />&nbsp;DELIVERY AND 
		COLLECTION<br /><br /></td>
		<td style="width: 130px; border-color:black; border-left-style: none;border-left-width: 1px;border-right-style: solid;border-right-width: 1px;border-top-style: solid;border-top-width: 1px;border-bottom-style: solid;border-bottom-width: 1px;">&nbsp;</td>
		<td style="width: 120px; border-color:black; border-style: solid;border-width: 1px;" align="right">
		£$str2&nbsp;&nbsp;
		</td>
	</tr>
	<tr>
		<td colspan="2" style="width: 550px; border-color:black; border-top-style: solid;border-top-width: 1px;border-right-style: solid;border-right-width: 1px;">&nbsp;</td>
		<td align="left" style="width: 130px; border-color:black; border-style: solid;border-width: 1px;">SUB TOTAL</td>
		<td style="width: 120px; border-color:black; border-style: solid;border-width: 1px;" align="right">£$str2&nbsp;&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2" style="width: 550px; border-color:black; border-right-style: solid;border-right-width: 1px;">&nbsp;</td>
		<td align="left" style="width: 130px; border-color:black; border-style: solid;border-width: 1px;">
		$str4
		</td>
		<td style="width: 120px; border-color:black; border-style: solid;border-width: 1px;" align="right">
		$str5&nbsp;&nbsp;
		</td>
	</tr>
	<tr>
		<td colspan="2" style="width: 550px; border-color:black; border-right-style: solid;border-right-width: 1px;">&nbsp;</td>
		<td align="left" style="width: 130px; border-color:black; border-style: solid;border-width: 1px;"><strong>TOTAL</strong></td>
		<td style="width: 120px; border-color:black; border-style: solid;border-width: 1px;" align="right">£$str3&nbsp;&nbsp;</td>
	</tr>
	</table>
</center>
</body>
			
END_OF_MESSAGE_EMAIL

}
		$tsth->finish;
		
		$SQL = "UPDATE orders SET status=$newstatus, bservice=$service, breference='$reference' where orderid=$orderid";
		}
	else
		{
		if( $newstatus eq "6" )
			{
			$SQL = "UPDATE orders SET status='2', bservice=0, breference='' where orderid=$orderid";
			}
		else
			{
			$SQL = "UPDATE orders SET status=$newstatus where orderid=$orderid";
			}
		}
		
	if( $newstatus ne "5" )
		{
		&my_sql;
		$sth->finish;
		}

	if( $str2send )
		{
		&SendEmail($fg_email, $myemail, "EuroPostExpress Invoice", $str2send);
		}

	$redirect="$script?cf=orders&view=1&orderid=$orderid";
	print $form->redirect(-url=>$redirect);
}

sub edit{
	unless ($orderid) {&error_page("Booking Reference is not correct."); exit;} 

	unless( $isAdmin ) {&error_page("You don't have enough permission for this operation."); exit;}

	$SQL = "SELECT orders.*, carriers.abbr as carabr, zones.tt1, zones.tt2, zones.remotett, zones.custcharge, services.remcharge, zones.satdelext, zones.satcolext, zones.descript FROM orders LEFT JOIN zones ON orders.zoneid=zones.zoneid LEFT JOIN services on zones.servid=services.id LEFT JOIN carriers ON services.carid=carriers.id WHERE orderid=$orderid"; 

	&my_sql;

	$column = $sth->fetchrow_hashref;
	
	unless( $column )
		{
		$sth->finish;
		&error_page("Booking not found."); exit;
		}

	&myheader($heading);
	
	&topmenu($heading);

print qq|<div class="ha8"><h1><font color="#000080" size="1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Edit Booking</font></h1>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Please edit the following information in order to edit the Booking<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Failure to enter the correct data will result in surcharges being billed and will delay delivery of the parcel.<br /><br />
<font size="2" face="Arial">
	<form class="nofrm" id="frmawb" name="frm" method="POST" onsubmit="return formcheck(this);" action="$script">
	<input name="orderid" type="hidden" value="$orderid" />
	<input name="book" type="hidden" value="6" />
	<input name="cf" type="hidden" value="book" />
	<input name="fromlist" type="hidden" value="$fromlist" />
	<table style="background-color:#FDF3D0; width: 100%" align="left">
		<tr style="background-color:#FFCC99;">
			<td style="width: 1000px" colspan="2"><center><big><b>Sender Specification</b></big></center></td>
		</tr>
		<tr>
			<td style="width: 200px">Contact Name <span class="text2">*</span></td>
			<td style="width: 800px">&nbsp;&nbsp;&nbsp;<input name="id_contact" id="id_contact" type="text" size="20" value="$column->{'s_contact'}" /></td>
		</tr>
		<tr>
			<td style="width: 200px">Company </td>
			<td style="width: 800px">&nbsp;&nbsp;&nbsp;<input name="id_company" id="id_company" type="text" size="20" value="$column->{'s_company'}" /></td>
		</tr>
		<tr>
			<td style="width: 200px">Land Phone <span class="text2">*</span></td>
			<td style="width: 800px">+&nbsp;<input name="tel1" type="text" size="5" value="$column->{'s_tel1'}" />&nbsp;(&nbsp;<input name="tel2" type="text" size="5" value="$column->{'s_tel2'}" />&nbsp;)&nbsp;&nbsp;<input name="tel3" type="text" size="21" value="$column->{'s_tel3'}" /></td>
		</tr>
		<tr>
			<td style="width: 200px">Cell Phone </td>
			<td style="width: 800px">+&nbsp;<input name="mob1" type="text" size="5" value="$column->{'s_mob1'}" />&nbsp;(&nbsp;<input name="mob2" type="text" size="5" value="$column->{'s_mob2'}" />&nbsp;)&nbsp;&nbsp;<input name="mob3" type="text" size="21" value="$column->{'s_mob3'}" /></td>
		</tr>
		<tr>
			<td style="width: 200px">Fax </td>
			<td style="width: 800px">+&nbsp;<input name="fax1" type="text" size="5" value="$column->{'s_fax1'}" />&nbsp;(&nbsp;<input name="fax2" type="text" size="5" value="$column->{'s_fax2'}" />&nbsp;)&nbsp;&nbsp;<input name="fax3" type="text" size="21" value="$column->{'s_fax3'}" /></td>
		</tr>
		<tr>
			<td style="width: 200px">Address <span class="text2">*</span></td>
			<td style="width: 800px">&nbsp;&nbsp;&nbsp;<input name="id_add1" id="id_add1" type="text" size="28" value="$column->{'s_add1'}" /><br>
															 &nbsp;&nbsp;&nbsp;<input name="id_add2" id="id_add2" type="text" size="28" value="$column->{'s_add2'}" /></td>
		</tr>
		<tr>
			<td style="width: 200px">City </td>
			<td style="width: 800px">&nbsp;&nbsp;&nbsp;$column->{'s_city'}</td>
		</tr>
		<tr>
			<td style="width: 200px">County <span class="text2">*</span></td>
			<td style="width: 800px">&nbsp;&nbsp;&nbsp;<input name="id_county" id="id_county" type="text" size="28" value="$column->{'s_state'}" /></td>
		</tr>
		<tr>
			<td style="width: 200px">Post Code </td>
			<td style="width: 800px">&nbsp;&nbsp;&nbsp;$column->{'s_postcode'}</td>
		</tr>
		<tr>
			<td style="width: 200px">Country </td>
			<td style="width: 800px">&nbsp;&nbsp;&nbsp;|;
			
			print get_country($column->{'s_country'});
			
			print qq|
			</td>
		</tr>
		<tr>
			<td style="width: 200px">Email </td>
			<td style="width: 800px">&nbsp;&nbsp;&nbsp;<input name="email" type="text" size="47" value="$column->{'s_email'}" /></td>
		</tr>
		<tr>
			<td style="width: 200px">Ready Time </td>
			<td style="width: 800px">&nbsp;&nbsp;&nbsp;<input name="fromtime" type="text" size="5" MAXLENGTH=5 value="$column->{'fromtime'}" /></td>
		</tr>
		<tr>
			<td style="width: 200px">Deadline Time </td>
			<td style="width: 800px">&nbsp;&nbsp;&nbsp;<input name="totime" type="text" size="5" MAXLENGTH=5 value="$column->{'totime'}" /></td>
		</tr>
		<tr style="background-color:#FFCC99;">
			<td style="width: 1000px" colspan="2"><center><big><b>Receiver Specification</b></big></center></td>
		</tr>
		<tr>
			<td style="width: 200px">Recipient Name <span class="text2">*</span></td>
			<td style="width: 800px">&nbsp;&nbsp;&nbsp;<input name="id_dest_contact" id="id_dest_contact" type="text" size="20" value="$column->{'d_contact'}" /></td>
		</tr>
		<tr>
			<td style="width: 200px">Recipient Company </td>
			<td style="width: 800px">&nbsp;&nbsp;&nbsp;<input name="id_dest_company" id="id_dest_company" type="text" size="20" value="$column->{'d_company'}" /></td>
		</tr>
		<tr>
			<td style="width: 200px">Land Phone <span class="text2">*</span></td>
			<td style="width: 800px">+&nbsp;<input name="dest_tel1" type="text" size="5" value="$column->{'d_tel1'}" />&nbsp;(&nbsp;<input name="dest_tel2" type="text" size="5" value="$column->{'d_tel2'}" />&nbsp;)&nbsp;&nbsp;<input name="dest_tel3" type="text" size="21" value="$column->{'d_tel3'}" /></td>
		</tr>
		<tr>
			<td style="width: 200px">Cell Phone </td>
			<td style="width: 800px">+&nbsp;<input name="dest_mob1" type="text" size="5" value="$column->{'d_mob1'}" />&nbsp;(&nbsp;<input name="dest_mob2" type="text" size="5" value="$column->{'d_mob2'}" />&nbsp;)&nbsp;&nbsp;<input name="dest_mob3" type="text" size="21" value="$column->{'d_mob3'}" /></td>
		</tr>
		<tr>
			<td style="width: 200px">Fax </td>
			<td style="width: 800px">+&nbsp;<input name="dest_fax1" type="text" size="5" value="$column->{'d_fax1'}" />&nbsp;(&nbsp;<input name="dest_fax2" type="text" size="5" value="$column->{'d_fax2'}" />&nbsp;)&nbsp;&nbsp;<input name="dest_fax3" type="text" size="21" value="$column->{'d_fax3'}" /></td>
		</tr>
		<tr>
			<td style="width: 200px">Address <span class="text2">*</span></td>
			<td style="width: 800px">&nbsp;&nbsp;&nbsp;<input name="id_dest_add1" id="id_dest_add1" type="text" size="28" value="$column->{'d_add1'}" /><br>
															 &nbsp;&nbsp;&nbsp;<input name="id_dest_add2" id="id_dest_add2" type="text" size="28" value="$column->{'d_add2'}" /></td>
		</tr>
		<tr>
			<td style="width: 200px">City </td>
			<td style="width: 800px">&nbsp;&nbsp;&nbsp;$column->{'d_city'}</td>
		</tr>
		<tr>
			<td style="width: 200px">County <span class="text2">*</span></td>
			<td style="width: 800px">&nbsp;&nbsp;&nbsp;<input name="id_dest_state" id="id_dest_state" type="text" size="28" value="$column->{'d_state'}" /></td>
		</tr>
		<tr>
			<td style="width: 200px">Post Code </td>
			<td style="width: 800px">&nbsp;&nbsp;&nbsp;$column->{'d_postcode'}</td>
		</tr>
		<tr>
			<td style="width: 200px">Country </td>
			<td style="width: 800px">&nbsp;&nbsp;&nbsp;|;
			
			print get_country($column->{'d_country'});
			
			print qq|
			</td>
		</tr>
		<tr>
			<td style="width: 200px">Email </td>
			<td style="width: 800px">&nbsp;&nbsp;&nbsp;<input name="dest_email" type="text" size="47" value="$column->{'d_email'}" /></td>
		</tr>
		<tr style="background-color:#FFCC99;">
			<td style="width: 1000px" colspan="2"><center><big><b>Shipment Details</b></big></center></td>
		</tr>
			
		<tr>
			<td style="width: 200px">
			Content
			</td>
			<td style="width: 800px">
			|;
			
			if( $column->{'docu'} eq "1" )
				{ print "&nbsp;&nbsp;&nbsp;Document"; }
			else			
				{ 
				print qq|&nbsp;&nbsp;&nbsp;Parcel
			</td>
			</tr>
			<tr>
			<td style="width: 200px">Contents <span class="text2">*</span></td>
			<td style="width: 800px">
			&nbsp;&nbsp;&nbsp;<input name="content" type="text" size="47" value="$column->{'content'}" />
			|;
			}
			
			print qq|
			</td>
			</tr>
			<tr>
			<td style="width: 200px">Value <span class="text2">*</span></td>
			<td style="width: 200px">£&nbsp;<input name="val" type="text" size="10" value="$column->{'val'}" />
			</td>
			</tr>
			<tr>
			<td style="width: 1000px" colspan="2">

			Number of Packages: $column->{'packages'} <br /><br />
			<table width="820" align="left" border="0">
			<tr>
			<th width="100" align="left">Pack</th>
			<th width="180" align="left">Weight <small>(kg)</small></th>
			<th width="180" align="left">Length <small>(cm)</small></th>
			<th width="180" align="left">Width <small>(cm)</small></th>
			<th width="180" align="left">Height <small>(cm)</small></th>
			</tr>	
			|;
			
			$SQL2 = "SELECT * FROM orderdetails WHERE orderid=$orderid order by item"; 
		
			&my_sql2;
		
			while( $column2 = $sth2->fetchrow_hashref )
				{
				print "<tr>\n";
				print "<td width=\"100\" align=\"left\">$column2->{'item'}</td>";
				
				$w = "weight[$l]";
				print "<td width=\"180\"  align=\"left\">$column2->{'weight'}</td>";

				$w = "length[$l]";
				print "<td width=\"180\"  align=\"left\">$column2->{'length'}</td>";

				$w = "width[$l]";
				print "<td width=\"180\"  align=\"left\">$column2->{'width'}</td>";

				$w = "height[$l]";
				print "<td width=\"180\"  align=\"left\">$column2->{'height'}</td>";
				print "</tr>\n";
				}

			print "</table>\n";

			$sth2->finish;
			
			$mycarabr = "\L$column->{'carabr'}";
			print qq|
		</td>
		</tr>
		<tr style="background-color:#FFCC99;">
			<td style="width: 1000px" colspan="2"><center><big><b>Service &amp; Quote</b></big></center></td>
		</tr>
		<tr>
			<td style="width: 1000px" colspan="2" align="left">

		<table border=0 width=100% cellpadding=0 cellspacing=0>
		<tr>
		<td width=60 valign="middle" align="left"><image src="img/services/$mycarabr.gif" /></td>|;
		
		print qq|
		<td valign="middle"><FONT SIZE=4><B>$column->{'service'}</B></FONT></td>
		</tr>
		</table>
		
		<b>Delivery Time:</b> |;
		
		if( $column->{'tt1'} == $column->{'tt2'} )
			{
			if( $column->{'tt1'} + $column->{'remotett'} == 1 )
				{
				print "Next Working Day";
				}
			else
				{
				print $column->{'tt1'} + $column->{'remotett'};
				print " Working Days";
				}
			}
		else
			{
			print $column->{'tt1'} + $column->{'remotett'};
			print "-";
			print $column->{'tt2'} + $column->{'remotett'};
			print " Working Days";	
			}
		
		if( $column->{'remotett'} && $column->{'remotett'} > 0)
			{
			print "&nbsp;&nbsp;(The collection and/or delivery address is remote area and this is included in the time frame)";
			}
		
			print "<br />\n<ul>";
		
		if( $column->{'odutiable'} )
			{
			print "<li>" . $column->{'odutiable'} . "</li>";
			}
		
		if( $column->{'opartcover'} )
			{
			print "<li>" . $column->{'opartcover'} . "</li>";
			}
		
		if( $column->{'oinvreq'} )
			{
			print "<li>$s_invtext</li>";
			}
		
		if( $column->{'custcharge'} && $column->{'custcharge'} > 0 )
			{
			my $strstr = $s_custtext;
			my $strval = omit0($column->{'custcharge'});
			$strstr =~ s/\[value\]/$strval/i;
			print "<li>$strstr</li>";
			}
		
		if( $column->{'oremote'} && $column->{'oremote'} > 0 )
			{
			my $strstr = $s_remotetext;
			my $strval = omit0($column->{'oremote'});
			$strstr =~ s/\[value\]/$strval/i;
			print "<li>$strstr</li>";
			}
		else
			{
			if( $column->{'remcharge'} && $column->{'remcharge'} > 0 )
				{
				my $strstr;
				if( $column->{'carabr'} eq "DHL" )
					{
					$strstr = $s_remotetext . " <u>MAY</u> apply. To find out if it's applied, please visit: <a href=\"http://raslist.dhl.com\" target=_BLANK>raslist.dhl.com</a>";
					}
				else
					{
					$strstr = $s_remotetext . " <u>MAY</u> apply.";
					}
				my $strval = omit0($column->{'remcharge'});
				$strstr =~ s/\[value\]/$strval/i;
				print qq|<li><font color="#FF0000">$strstr</font></li>|;
				}
			}
		
		if( $column->{'satdelext'} && $column->{'satdelext'} > 0 )
			{
			my $strstr = $s_satdelexttext;
			my $strval = omit0($column->{'satdelext'});
			$strstr =~ s/\[value\]/$strval/i;
			print "<li>$strstr</li>";
			}
		
		if( $column->{'satcolext'} && $column->{'satcolext'} > 0 )
			{
			my $strstr = $s_satcolexttext;
			my $strval = omit0($column->{'satcolext'});
			$strstr =~ s/\[value\]/$strval/i;
			print "<li>$strstr</li>";
			}
		
		if( $column->{'obook'} && $column->{'obook'} > 0 )
			{
			my $strstr = $s_booktext;
			my $strval = omit0($column->{'obook'});
			$strstr =~ s/\[value\]/$strval/i;
			print "<li>$strstr</li>";
			}
		
		if( $column->{'ofuel'} && $column->{'ofuel'} > 0 )
			{
			my $strstr = $s_fueltext;
			my $strval = omit0($column->{'ofuel'});
			$strstr =~ s/\[value\]/$strval/i;
			print "<li>$strstr</li>";
			}
		
		if( $column->{'vatpercent'} && $column->{'vatpercent'} > 0 )
			{
			my $strstr = $s_vattext;
			my $strval = omit0($column->{'vatpercent'});
			$strstr =~ s/\[value\]/$strval/i;
			print "<li>$strstr</li>";
			}
		
		if( $column->{'descript'} )
			{
			print "<li>" . $column->{'descript'} . "</li>";
			}
		
		print "</ul>";
		
		$mytotal_price = toCurr($column->{'oprice'}+$column->{'ofuel'}+$column->{'obook'}+$column->{'oremote'}+$column->{'ocust'});
		
		print qq|<FONT SIZE=4><B>Price: £$mytotal_price|;
			
		if( $column->{'vatpercent'} && $column->{'vatpercent'} > 0 )
			{
			print " + ";
			print omit0($column->{'vatpercent'});
			print qq|% VAT|;
			}
			
		print qq|</B></FONT><BR />
			
			</td>
		</tr>
		<tr>
			<td style="width: 1000px" colspan="2"><center>
			<input name="lastsubmit" type="submit" value="Save Booking" size="30" />
			</center></td>
		</tr>
	
	</table>
&nbsp;|;

	$sth->finish;

print qq|
</font>
</form>


</div>
|;
&footer;
}

sub delete{
	unless ($orderid) {&error_page("Not valid Booking Ref.!"); exit;} 

	$SQL = "SELECT userid FROM orders WHERE orderid = $orderid"; 
	&my_sql;
	if ($column = $sth->fetchrow_hashref){
		$fg_userid = $column->{'userid'};
		$sth->finish;

		if( $isAdmin || $fg_userid == $isUser )
			{
			$SQL = "DELETE FROM orderdetails WHERE orderid=$orderid";
			&my_sql;
			$sth->finish;

			$SQL = "DELETE FROM orders WHERE orderid=$orderid";
			&my_sql;
			$sth->finish;

			if( $fromlist )
				{
				$redirect ="$script?cf=orders&viewall=1&userid=$isUser";
				}
			else
				{
				$redirect="$script?cf=orderdel";
				}

			print $form->redirect(-url=>$redirect);
			}
		else
			{
			&error_page("You don't have enough permission for this operation."); exit;
			}
	}
	else
		{
		$sth->finish;
		&error_page("Booking Ref. $orderid does not exist!"); exit;
		}
}


sub priority{
	unless ($orderid) {&error_page("Not valid Booking Ref.!"); exit;} 

	unless( $isAdmin || $column->{'userid'} == $isUser ) {&error_page("You don't have enough permission for this operation."); exit;}

	$SQL = "UPDATE orders SET type=$priority WHERE orderid=$orderid";
	&my_sql;
	$sth->finish;

	$redirect="$script?cf=orders&view=1&orderid=$orderid";
	print $form->redirect(-url=>$redirect);
}


sub printit{
	unless ($orderid) {&error_page("Not valid Booking Ref.!"); exit;} 

	$SQL = "SELECT orders.*, zones.*, services.service as service, members.userid as uid, members.username, members.sal, members.fname, members.lname, members.company, members.email FROM orders LEFT JOIN zones on orders.zoneid=zones.zoneid LEFT JOIN services on zones.servid=services.id LEFT OUTER JOIN members ON orders.userid=members.userid WHERE orderid = $orderid"; 
	&my_sql;
	if ($column = $sth->fetchrow_hashref){

		unless( $isAdmin || $column->{'userid'} == $isUser ) {&error_page("You don't have enough permission for this operation."); exit;}

		print $form->header;

print qq|
<html>
<head>
<title>Booking Ref.: $orderid
</title>
</head>
<body>
		<div align="center" valign="middle" style="vertical-align: middle;">
		<img src="img/content/slogan_01.gif" width="235" height="56" style="float: left;" /><span style="float: right;"><H1>$mycompany</H1></span>
		</div>
		<br />
		<br />
		<br />
		<hr width="100%" size="1" noshade />
		<br />
<font size="2" face="Arial">
<center>
	<table style="width: 100%" align="left" border="1" cellpadding="5" cellspacing="0">
	|;
	
if( $isAdmin )
{
print qq|	
		<tr>
			<td style="background-color:#CCCCCC"><center><big><b>Booking Details</b></big></center></td>
		</tr>
		<tr>
			<td align="left">
			<b>Booking Ref.:</b> $column->{'orderid'}<br />|;
	
			if( $column->{'uid'} )
				{
				print qq|<b>Username:</b> $column->{'username'}<br />|;
				print "&nbsp;&nbsp;&nbsp;<b>Full Name:</b> $column->{'sal'} $column->{'fname'} $column->{'lname'}<br />";
				print "&nbsp;&nbsp;&nbsp;<b>Company:</b> $column->{'company'}<br />";
				print qq|&nbsp;&nbsp;&nbsp;<b>Email:</b> $column->{'email'}<br />|;
				}
			print "<b>Date:</b> $column->{'orderdate'}<br />";
			print "<b>Type:</b> ";
			
			if( $column->{'type'} == 2 )
				{
				print "<I>High Priority</I><br />";
				}
			else
				{
				print "Normal Priority<br />";
				}

			print "<b>Status:</b> ";

			if( $column->{'status'} == 9 )
				{
				print "Canceled<br />";
				}
			elsif( $column->{'status'} == 4 )
				{
				print "Done<br />";
				}
			elsif( $column->{'status'} == 3 )
				{
				print "Booked<br />";
				}
			elsif( $column->{'status'} == 2 )
				{
				print "Paid<br />";
				}
			else
				{
				print "<I>Not Processed</I><br />";
				}
				
print qq|
</td>
		</tr>
		|;
}		
	
print qq|		
		<tr>
			<td style="background-color:#CCCCCC"><center><big><b>Collection Address</b></big></center></td>
		</tr>
		<tr>
			<td align="left">
			<b>Contact Name:</b> $column->{'s_contact'}<br />|;
	
			print "<b>Company:</b> $column->{'s_company'}<br />" if( $column->{'s_company'} );
			print "<b>Land Phone:</b> +$column->{'s_tel1'} ( $column->{'s_tel2'} ) $column->{'s_tel3'}<br />";
			print "<b>Cell Phone:</b> +$column->{'s_mob1'} ( $column->{'s_mob2'} ) $column->{'s_mob3'}<br />"  if( $column->{'s_mob1'} || $column->{'s_mob2'} || $column->{'s_mob3'} );
			print "<b>Fax:</b> +$column->{'s_fax1'} ( $column->{'s_fax2'} ) $column->{'s_fax3'}<br />"  if( $column->{'s_fax1'} || $column->{'s_fax2'} || $column->{'s_fax3'} );
			print "<b>Address:</b> $column->{'s_add1'}<br />";
			print "$column->{'s_add2'}<br />"  if( $column->{'s_add2'} );

print qq|
			<b>Post Code:</b> $column->{'s_postcode'}<br />
			<b>City:</b> $column->{'s_city'}<br />
			<b>County:</b> $column->{'s_state'}<br />
			<b>Country:</b> |;
			
			print get_country($column->{'s_country'});

			print qq|<br /><b>Email:</b> $column->{'s_email'}| if($column->{'s_email'});
			
print qq|<br />
			<b>Ready Time:</b> $column->{'fromtime'}<br />
			<b>Deadline Time:</b> $column->{'totime'}<br />
</td>
		</tr>
		<tr>
			<td style="background-color:#CCCCCC"><center><big><b>Delivery Address</b></big></td>
		</tr>
		<tr>
			<td align="left">
			<b>Recipient Name:</b> $column->{'d_contact'}<br />|;
	
			print "<b>Recipient Company:</b> $column->{'d_company'}<br />" if( $column->{'d_company'} );
			print "<b>Land Phone:</b> +$column->{'d_tel1'} ( $column->{'d_tel2'} ) $column->{'d_tel3'}<br />";
			print "<b>Cell Phone:</b> +$column->{'d_mob1'} ( $column->{'d_mob2'} ) $column->{'d_mob3'}<br />"  if( $column->{'d_mob1'} || $column->{'d_mob2'} || $column->{'d_mob3'} );
			print "<b>Fax:</b> +$column->{'d_fax1'} ( $column->{'d_fax2'} ) $column->{'d_fax3'}<br />"  if( $column->{'d_fax1'} || $column->{'d_fax2'} || $column->{'d_fax3'} );
			print "<b>Address:</b> $column->{'d_add1'}<br />";
			print "$column->{'d_add2'}<br />"  if( $column->{'d_add2'} );

print qq|
			<b>Post Code:</b> $column->{'d_postcode'}<br />
			<b>City:</b> $column->{'d_city'}<br />
			<b>County:</b> $column->{'d_state'}<br />
			<b>Country:</b> |;
			
			print get_country($column->{'d_country'});
			
			print qq|<br /><b>Email:</b> $column->{'d_email'}| if($column->{'d_email'});
			
print qq|
</td>
		</tr>
		<tr>
			<td style="background-color:#CCCCCC"><center><big><b>Shipment Details</b></big></center></td>
		</tr>
		<tr>
			<td align="left">

			<b>Content:</b> |;
			
			if( $column->{'docu'} eq "1" )
				{print "Document<br />";}
			else
				{print "Parcel<br />";
				 print qq|<b>Contents:</b> $column->{'content'}<br />|;
				}

			print qq|
			<b>Value:</b> £ $column->{'val'}<br />
			
			<b>Number of Packages:</b> $column->{'packages'}<br /><br />
		
			<table width="500" align="left" border="0">
			<tr>
			<th width="100" align="left">Pack</th>
			<th width="100" align="left">Weight <small>(kg)</small></th>
			<th width="100" align="left">Length <small>(cm)</small></th>
			<th width="100" align="left">Width <small>(cm)</small></th>
			<th width="100" align="left">Height <small>(cm)</small></th>
			</tr>	
			|;

			$SQL2 = "SELECT * FROM orderdetails WHERE orderid = $orderid ORDER BY item"; 
			&my_sql2;

			$actualw = 0;
			$volw = 0;

			while ($column2 = $sth2->fetchrow_hashref)
				{
				$tmpvolw = toCurr((($column2->{'length'} * $column2->{'width'} * $column2->{'height'}) / 4000));
				$actualw = $actualw + $column2->{'weight'};
				$volw = $volw + $tmpvolw;
				print "<tr>\n";
				print "<td width=\"100\" align=\"left\">$column2->{'item'}</td>";
				print "<td width=\"100\"  align=\"left\">$column2->{'weight'}</td>";
				print "<td width=\"100\"  align=\"left\">$column2->{'length'}</td>";
				print "<td width=\"100\"  align=\"left\">$column2->{'width'}</td>";
				print "<td width=\"100\"  align=\"left\">$column2->{'height'}</td>";
				print "<td width=\"150\"  align=\"left\">$tmpvolw</td>";
				print "</tr>\n";
				}
			print "<tr>\n";
			print "<td width=\"100\" align=\"left\"><b>Total:</b></td>";
			print "<td colspan=\"4\" align=\"left\">$actualw</td>";
			print "<td width=\"150\"  align=\"left\">$volw</td>";

			$actualw = $volw if( $volw > $actualw );

			print "</tr>\n";
			print "<tr>\n";
			print "<td colspan=\"6\" align=\"left\"><b><u>Total Weight:&nbsp;$actualw Kgs</u></b></td>";
			print "</tr>\n";

			$sth2->finish;
				
			print qq|
			</table>
			</td>
		</tr>
		<tr>
			<td style="background-color:#CCCCCC"><center><big><b>Service & Quote</b></big></center></td>
		</tr>
		<tr>
			<td align="left">

			<b>Service Name:</b> $column->{'service'}<br />
			<ul>|;

			if( $column->{'odutiable'} )
				{ 
				print "<li>$column->{'odutiable'}</li>";
				}

			if( $column->{'opartcover'} )
				{ 
				print "<li>$column->{'opartcover'}</li>";
				}

			if( $column->{'oinvreq'} )
				{ 
				print "<li>$s_invtext</li>";
				}
			
			print "</ul>";
			
		print qq|
			<br /><span style="border-style: solid; border-width: 2px; padding: 3px; margin: 3px"><b>Price: £|;

			print toCurr($column->{'oprice'}+$column->{'ofuel'}+$column->{'obook'}+$column->{'oremote'}+$column->{'ocust'});

			if( $column->{'vatpercent'} && $column->{'vatpercent'} > 0 )
				{
				print " + ";
				print omit0($column->{'vatpercent'});
				print "% VAT";
				}
			
			print qq|</b></span><br /><br />


			</td>
		</tr>
	</table>
</center>
</font>
<br />
<script language="JavaScript">window.print();</script>
</body>
</html>
|;

		$sth->finish;
	}
	else
		{
			$sth->finish;
			error_page("Booking not found!");
		}
}

sub viewall{

unless( $isAdmin || $userid == $isUser ) {&error_page("You don't have enough permission for this operation."); exit;}

if( $isAdmin )
	{
	$SQL = "SELECT orderid, orderdate, orders.status as status, orders.type as type, packages, oprice, ofuel, obook, oremote, ocust, ovat, vatpercent, services.service as service, cs.country as s_country, cd.country as d_country, members.userid as userid, members.username as username FROM orders LEFT OUTER JOIN members ON orders.userid=members.userid LEFT JOIN zones on orders.zoneid=zones.zoneid LEFT JOIN services on zones.servid=services.id LEFT JOIN countries as cs ON orders.s_country=cs.id LEFT JOIN countries as cd ON orders.d_country=cd.id";

	$sortu = "";
	$sorts = "";
	$sortd = "";
	$sorti = "";
	$sorto = "";
	$sorte = "";
	$sortv = "";
	$isortu = "";
	$isorts = "";
	$isortd = "";
	$isorti = "";
	$isorto = "";
	$isorte = "";
	$isortv = "";
	$img1 = "<img valign=\"middle\" style=\"vertical-align: middle;\" src=\"img/content/";
	$img2 = "\" alt=\"Reverse Sort Order\" width=\"10\" height=\"12\" border=\"0\" />";

	if( $sort eq "u" )
		{
		if( $rev )
			{
			$SQL = $SQL . " ORDER BY username DESC, orders.type DESC, orderdate ASC"; 
			$sortu = "";
			$isortu = $img1 . "ad.jpg" . $img2;
			}
		else
			{
			$SQL = $SQL . " ORDER BY username ASC, orders.type DESC, orderdate DESC"; 
			$sortu = "&rev=1";
			$isortu = $img1 . "au.jpg" . $img2;
			}
		}
	elsif( $sort eq "i" )
		{
		if( $rev )
			{
			$SQL = $SQL . " ORDER BY orderid DESC"; 
			$sorti = "";
			$isorti = $img1 . "ad.jpg" . $img2;
			}
		else
			{
			$SQL = $SQL . " ORDER BY orderid ASC"; 
			$sorti = "&rev=1";
			$isorti = $img1 . "au.jpg" . $img2;
			}
		}
	elsif( $sort eq "s" )
		{
		if( $rev )
			{
			$SQL = $SQL . " ORDER BY status DESC, orders.type DESC, orderdate ASC"; 
			$sorts = "";
			$isorts = $img1 . "ad.jpg" . $img2;
			}
		else
			{
			$SQL = $SQL . " ORDER BY status ASC, orders.type DESC, orderdate DESC"; 
			$sorts = "&rev=1";
			$isorts = $img1 . "au.jpg" . $img2;
			}
		}
	elsif( $sort eq "o" )
		{
		if( $rev )
			{
			$SQL = $SQL . " ORDER BY s_country DESC, status DESC, orders.type DESC, orderdate ASC"; 
			$sorto = "";
			$isorto = $img1 . "ad.jpg" . $img2;
			}
		else
			{
			$SQL = $SQL . " ORDER BY s_country ASC, status DESC, orders.type DESC, orderdate DESC"; 
			$sorto = "&rev=1";
			$isorto = $img1 . "au.jpg" . $img2;
			}
		}
	elsif( $sort eq "e" )
		{
		if( $rev )
			{
			$SQL = $SQL . " ORDER BY d_country DESC, status DESC, orders.type DESC, orderdate ASC"; 
			$sorte = "";
			$isorte = $img1 . "ad.jpg" . $img2;
			}
		else
			{
			$SQL = $SQL . " ORDER BY d_country ASC, status DESC, orders.type DESC, orderdate DESC"; 
			$sorte = "&rev=1";
			$isorte = $img1 . "au.jpg" . $img2;
			}
		}
	elsif( $sort eq "v" )
		{
		if( $rev )
			{
			$SQL = $SQL . " ORDER BY service DESC, status DESC, orders.type DESC, orderdate ASC"; 
			$sortv = "";
			$isortv = $img1 . "ad.jpg" . $img2;
			}
		else
			{
			$SQL = $SQL . " ORDER BY service ASC, status DESC, orders.type DESC, orderdate DESC"; 
			$sortv = "&rev=1";
			$isortv = $img1 . "au.jpg" . $img2;
			}
		}
	else
		{
		if( $rev )
			{
			$SQL = $SQL . " ORDER BY orders.type DESC, orderdate ASC"; 
			$sortd = "";
			$isortd = $img1 . "ad.jpg" . $img2;
			}
		else
			{
			$SQL = $SQL . " ORDER BY orders.type DESC, orderdate DESC"; 
			$sortd = "&rev=1";
			$isortd = $img1 . "au.jpg" . $img2;
			}
		}
	&my_sql;
	}
else
	{
	$uid = $isUser;
	$SQL = "SELECT orderid, orderdate, status, packages, oprice, ofuel, obook, oremote, ocust, ovat, vatpercent, services.service as service, cs.country as s_country, cd.country as d_country FROM orders  LEFT JOIN zones on orders.zoneid=zones.zoneid LEFT JOIN services on zones.servid=services.id LEFT JOIN countries as cs ON orders.s_country=cs.id LEFT JOIN countries as cd ON orders.d_country=cd.id WHERE userid=$isUser"; 

	$sorts = "";
	$sortd = "";
	$sorti = "";
	$isorts = "";
	$isortd = "";
	$isorti = "";
	$img1 = "<img valign=\"middle\" style=\"vertical-align: middle;\" src=\"img/content/";
	$img2 = "\" alt=\"Reverse Sort Order\" width=\"10\" height=\"12\" border=\"0\" />";

	if( $sort eq "i" )
		{
		if( $rev )
			{
			$SQL = $SQL . " ORDER BY orderid DESC"; 
			$sorti = "";
			$isorti = $img1 . "ad.jpg" . $img2;
			}
		else
			{
			$SQL = $SQL . " ORDER BY orderid ASC"; 
			$sorti = "&rev=1";
			$isorti = $img1 . "au.jpg" . $img2;
			}
		}
	elsif( $sort eq "s" )
		{
		if( $rev )
			{
			$SQL = $SQL . " ORDER BY status DESC, orderdate ASC"; 
			$sorts = "";
			$isorts = $img1 . "ad.jpg" . $img2;
			}
		else
			{
			$SQL = $SQL . " ORDER BY status ASC, orderdate DESC"; 
			$sorts = "&rev=1";
			$isorts = $img1 . "au.jpg" . $img2;
			}
		}
	elsif( $sort eq "o" )
		{
		if( $rev )
			{
			$SQL = $SQL . " ORDER BY s_country DESC, status DESC, orderdate ASC"; 
			$sorto = "";
			$isorto = $img1 . "ad.jpg" . $img2;
			}
		else
			{
			$SQL = $SQL . " ORDER BY s_country ASC, status DESC, orderdate DESC"; 
			$sorto = "&rev=1";
			$isorto = $img1 . "au.jpg" . $img2;
			}
		}
	elsif( $sort eq "e" )
		{
		if( $rev )
			{
			$SQL = $SQL . " ORDER BY d_country DESC, status DESC, orderdate ASC"; 
			$sorte = "";
			$isorte = $img1 . "ad.jpg" . $img2;
			}
		else
			{
			$SQL = $SQL . " ORDER BY d_country ASC, status DESC, orderdate DESC"; 
			$sorte = "&rev=1";
			$isorte = $img1 . "au.jpg" . $img2;
			}
		}
	elsif( $sort eq "v" )
		{
		if( $rev )
			{
			$SQL = $SQL . " ORDER BY service DESC, status DESC, orderdate ASC"; 
			$sortv = "";
			$isortv = $img1 . "ad.jpg" . $img2;
			}
		else
			{
			$SQL = $SQL . " ORDER BY service ASC, status DESC, orderdate DESC"; 
			$sortv = "&rev=1";
			$isortv = $img1 . "au.jpg" . $img2;
			}
		}
	else
		{
		if( $rev )
			{
			$SQL = $SQL . " ORDER BY orderdate ASC"; 
			$sortd = "";
			$isortd = $img1 . "ad.jpg" . $img2;
			}
		else
			{
			$SQL = $SQL . " ORDER BY orderdate DESC"; 
			$sortd = "&rev=1";
			$isortd = $img1 . "au.jpg" . $img2;
			}
		}
	&my_sql;
	}

	$i = 0;

	while ($column = $sth->fetchrow_hashref)
		{
		unless( $i )
			{
			&myheader("viewbooks");
			&topmenu("viewbooks");

			print qq|
			<div class="ha8">
				<font size="2" face="Arial">
				<span class="text1"><font face="Arial" size="2"><b>List of Bookings:</b></font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" class="noneunderline" onClick="javascript:window.open('$script?cf=orders&printlist=1&userid=$isUser','printbookinglist','width=' + (screen.width - 40) + ',height=' + (screen.height - 100) + ',top=20,left=10,scrollbars=yes,toolbar=no,status=no,menubar=yes,resizable=no,location=no')"><img src="img/content/print.jpg" width="16" height="16" border="0" alt="Print Booking List" valign="middle" style="vertical-align: middle;" /></a>&nbsp;&nbsp;<a href="javascript:void(0);" class="noneunderline" onClick="javascript:window.open('$script?cf=orders&printlist=1&userid=$isUser','printbookinglist','width=' + (screen.width - 40) + ',height=' + (screen.height - 100) + ',top=20,left=10,scrollbars=yes,toolbar=no,status=no,menubar=yes,resizable=no,location=no')">Print Booking List</a></span>
				<br /><br />
					<table style="width: 100%" align="left" border="1" cellpadding="2" cellspacing="0">
						<tr>
						<th width="80" align="left"><a class="noneunderline" href="$script?cf=orders&viewall=1&userid=$userid&sort=i$sorti">$isorti Ref.</a></th>
						<th width="120" align="left"><a class="noneunderline" href="$script?cf=orders&viewall=1&userid=$userid&sort=d$sortd">$isortd Date</a></th>
						|;
						
						print qq|<th width="105" align="left"><a class="noneunderline" href="$script?cf=orders&viewall=1&userid=$userid&sort=u$sortu">$isortu Username</a></th>| if( $isAdmin );
						
						print qq|
						<th width="100" align="left"><a class="noneunderline" href="$script?cf=orders&userid=$userid&viewall=1&sort=s$sorts">$isorts Status</a></th>
						<th width="30" align="left">Packs</th>
						<th width="135" align="left">Price</th>|;
						
						if( $isAdmin )
							{
							print qq|
							<th width="120" align="left"><a class="noneunderline" href="$script?cf=orders&userid=$userid&viewall=1&sort=o$sorto">$isorto Source</a></th>
							<th width="120" align="left"><a class="noneunderline" href="$script?cf=orders&userid=$userid&viewall=1&sort=e$sorte">$isorte Destination</a></th>
							<th width="130" align="left"><a class="noneunderline" href="$script?cf=orders&userid=$userid&viewall=1&sort=v$sortv">$isortv Service</a></th>
							|;
							}
						else
							{
							print qq|
							<th width="155" align="left"><a class="noneunderline" href="$script?cf=orders&userid=$userid&viewall=1&sort=o$sorto">$isorto Source</a></th>
							<th width="155" align="left"><a class="noneunderline" href="$script?cf=orders&userid=$userid&viewall=1&sort=e$sorte">$isorte Destination</a></th>
							<th width="165" align="left"><a class="noneunderline" href="$script?cf=orders&userid=$userid&viewall=1&sort=v$sortv">$isortv Service</a></th>
							|;
							}

						print qq|
						<th width="60" align="center" colspan="3">Action</th>
						</tr>
						|;
			}

		if( $isAdmin )
			{
			$uid = $column->{'userid'};
			if( $column->{'type'} == 1 )
				{
				$clr = "#969696";
				}
			else
				{
				$clr = "#000000";
				}
			}
		else
			{
			$clr = "#969696";
			}

	print qq|
		<tr>
		<td align="left"><font color="$clr"><a href="$script?cf=orders&view=1&orderid=$column->{'orderid'}">$column->{'orderid'}</font></td>
		<td align="left"><font color="$clr">$column->{'orderdate'}</font></td>
		|;
		
		print qq|<td align="left"><font color="$clr"><a href="$script?cf=members&view=1&memid=$uid">$column->{'username'}</a></font></td>| if( $isAdmin );
		
		if( $column->{'status'} == 9 )
			{
			print qq|<td align="left"><font color="$clr">Canceled</font></td>|;
			}
		elsif( $column->{'status'} == 4 )
			{
			print qq|<td align="left"><font color="$clr">Done</font></td>|;
			}
		elsif( $column->{'status'} == 3 )
			{
			print qq|<td align="left"><font color="$clr">Booked</font></td>|;
			}
		elsif( $column->{'status'} == 2 )
			{
			print qq|<td align="left"><font color="$clr">Paid</font></td>|;
			}
		else
			{
			print qq|<td align="left"><font color="#FF0000">Not Processed</font></td>|;
			}
		
		print qq|
		<td align="left"><font color="$clr">$column->{'packages'}</font></td>
		<td align="left"><font color="$clr"> £|;
		
		print toCurr($column->{'oprice'}+$column->{'ofuel'}+$column->{'obook'}+$column->{'oremote'}+$column->{'ocust'});
		
		if( $column->{'vatpercent'} && $column->{'vatpercent'} > 0 )
			{
			print " + ";
			print omit0($column->{'vatpercent'});
			print "% VAT";
			}

		print qq|</font></td>|;
		
		print qq|
		<td align="left">$column->{'s_country'}</td>
		<td align="left">$column->{'d_country'}</td>
		<td align="left">$column->{'service'}</td>
		|;
		
		$rowentid = $column->{'orderid'};
		print qq|<td align="center"><center><a href="$script?cf=orders&edit=1&fromlist=1&orderid=$rowentid" class="noneunderline"><img src="img/content/edit.png" width="16" height="16" border="0" alt="Edit Booking" valign="middle" style="vertical-align: middle;" /></a></center></td>
<td align="center"><center><a href="javascript:void(0);" class="noneunderline" onClick="javascript:window.open('$script?cf=orders&printit=1&orderid=$rowentid','printbooking','width=' + (screen.width - 40) + ',height=' + (screen.height - 100) + ',top=20,left=10,scrollbars=yes,toolbar=no,status=no,menubar=yes,resizable=no,location=no')"><img src="img/content/print.jpg" width="16" height="16" border="0" alt="Print Booking" valign="middle" style="vertical-align: middle;" /></a></center></td>
<td align="center"><center>
<a href="$script?cf=orders&delete=1&&fromlist=1&orderid=$rowentid" class="noneunderline" onclick="javascript:return confirm('Are you sure you want to delete this booking?')"><img src="img/content/delete.jpg" width="16" height="16" border="0" alt="Delete Booking" valign="middle" style="vertical-align: middle;" /></a></td>

|;
		
		print qq|
		
		</tr>
		|;

		$i++;
		}

if( $i )
	{
	print qq|		
		</table>
	</font>
	<br />
	</div>
	|;

	&footer;
	}
else
	{
		&myheader("viewbooks");
		&topmenu("viewbooks");

		print qq|
			<div class="ha8"><font size="2">
			There is not any Booking to display.
			</font></div>
			|;

		&footer;
	}

}

sub printlist{

unless( $isAdmin || $userid == $isUser ) {&error_page("You don't have enough permission for this operation."); exit;}

if( $isAdmin )
	{
	$SQL = "SELECT orderid, orderdate, orders.status as status, orders.type as type, packages, oprice, ofuel, obook, oremote, ocust, ovat, vatpercent, members.userid as userid, members.username as username FROM orders LEFT OUTER JOIN members ON orders.userid=members.userid";

	if( $sort eq "u" )
		{
		if( $rev )
			{
			$SQL = $SQL . " ORDER BY username DESC, orders.type DESC, orderdate ASC"; 
			}
		else
			{
			$SQL = $SQL . " ORDER BY username ASC, orders.type DESC, orderdate DESC"; 
			}
		}
	elsif( $sort eq "i" )
		{
		if( $rev )
			{
			$SQL = $SQL . " ORDER BY orderid DESC"; 
			}
		else
			{
			$SQL = $SQL . " ORDER BY orderid ASC"; 
			}
		}
	elsif( $sort eq "s" )
		{
		if( $rev )
			{
			$SQL = $SQL . " ORDER BY status DESC, orders.type DESC, orderdate ASC"; 
			}
		else
			{
			$SQL = $SQL . " ORDER BY status ASC, orders.type DESC, orderdate DESC"; 
			}
		}
	else
		{
		if( $rev )
			{
			$SQL = $SQL . " ORDER BY orders.type DESC, orderdate ASC"; 
			}
		else
			{
			$SQL = $SQL . " ORDER BY orders.type DESC, orderdate DESC"; 
			}
		}
	&my_sql;
	}
else
	{
	$SQL = "SELECT orderid, orderdate, status, packages, oprice, ofuel, obook, oremote, ocust, ovat, vatpercent FROM orders WHERE userid=$isUser"; 
	if( $sort eq "i" )
		{
		if( $rev )
			{
			$SQL = $SQL . " ORDER BY orderid DESC"; 
			}
		else
			{
			$SQL = $SQL . " ORDER BY orderid ASC"; 
			}
		}
	elsif( $sort eq "s" )
		{
		if( $rev )
			{
			$SQL = $SQL . " ORDER BY status DESC, orderdate ASC"; 
			}
		else
			{
			$SQL = $SQL . " ORDER BY status ASC, orderdate DESC"; 
			}
		}
	else
		{
		if( $rev )
			{
			$SQL = $SQL . " ORDER BY orderdate ASC"; 
			}
		else
			{
			$SQL = $SQL . " ORDER BY orderdate DESC"; 
			}
		}
	&my_sql;
	}

	$i = 0;

	while ($column = $sth->fetchrow_hashref)
		{
		unless( $i )
			{
			print $form->header;

		print qq|
		<html>
		<head>
		<title>Booking List
		</title>
		</head>
		<body>
		<div align="center" valign="middle" style="vertical-align: middle;">
		<img src="img/content/slogan_01.gif" width="235" height="56" style="float: left;" /><span style="float: right;"><H1>$mycompany</H1></span>
		</div>
		<br />
		<br />
		<br />
		<hr width="100%" size="1" noshade />
		<br />
		<font size="2" face="Arial">
			<center>
			<span class="text1"><font face="Arial" size="2"><b>List of Bookings</b></font></span>
				<br /><br />
					<table style="width: 100%" align="left" border="1" cellpadding="5" cellspacing="0">
						<tr>
						<th width="120" align="left">Ref.</th>
						<th width="220" align="left">Date</th>
						|;
						
						print qq|<th width="220" align="left">Username</th>| if( $isAdmin );
						
						print qq|
						<th width="150" align="left">Status</th>
						<th width="120" align="left">Pack Nums</th>
						<th width="180" align="left">Price</th>
						</tr>
						|;
			}

		if( $isAdmin )
			{
			if( $column->{'type'} == 1 )
				{
				$pretag = "";
				$posttag = "";
				}
			else
				{
				$pretag = "<b>";
				$posttag = "</b>";
				}
			}
		else
			{
			$pretag = "";
			$posttag = "";
			}

	print qq|
		<tr>
		<td align="left">$pretag<font color="#000000">$column->{'orderid'}</font>$posttag</td>
		<td align="left">$pretag<font color="#000000">$column->{'orderdate'}</font>$posttag</td>
		|;
		
		if( $isAdmin )
			{
			if( $column->{'username'} )
				{
				print qq|<td align="left">$pretag<font color="#000000">$column->{'username'}</font>$posttag</td>|;
				}
			else
				{
				print qq|<td align="left">&nbsp;</td>|;
				}
			}
		
		if( $column->{'status'} == 9 )
			{
			print qq|<td align="left">$pretag<font color="#000000">Canceled</font>$posttag</td>|;
			}
		elsif( $column->{'status'} == 4 )
			{
			print qq|<td align="left">$pretag<font color="#000000">Done</font>$posttag</td>|;
			}
		elsif( $column->{'status'} == 3 )
			{
			print qq|<td align="left">$pretag<font color="#000000">Booked</font>$posttag</td>|;
			}
		elsif( $column->{'status'} == 2 )
			{
			print qq|<td align="left">$pretag<font color="#000000">Paid</font>$posttag</td>|;
			}
		else
			{
			print qq|<td align="left">$pretag<font color="#000000"><u>Not Processed</u></font>$posttag</td>|;
			}
		
		print qq|
		<td align="left">$pretag<font color="#000000">$column->{'packages'}</font>$posttag</td>
		<td align="left">$pretag<font color="#000000"> £|;
		
		print toCurr($column->{'oprice'}+$column->{'ofuel'}+$column->{'obook'}+$column->{'oremote'}+$column->{'ocust'});

		if( $column->{'vatpercent'} && $column->{'vatpercent'} > 0 )
			{
			print " + ";
			print omit0($column->{'vatpercent'});
			print "% VAT";
			}
		
		print qq|</font>$posttag</td>
		</tr>
		|;

		$i++;
		}

if( $i )
	{
	print qq|		
		</table>
		</center>
	</font>
	<br />
<script language="JavaScript">window.print();</script>
	</body>
	</html>
	|;

	}
}

1;