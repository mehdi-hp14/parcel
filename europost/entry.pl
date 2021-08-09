$heading="entry";

use CGI;
use LWP::UserAgent;
use CGI qw/:standard/;
use CGI qw(param);
use CGI::Cookie;
use HTTP::Cookies;
use File::Basename;
use POSIX;

$CGI::POST_MAX = 1024 * 10000;

sub entry1{

&myheader($heading);

&topmenu($heading);

$SQL = "SELECT country FROM members WHERE userid=$isUser";
&my_sql;
$usercountry = "";
if ($column = $sth->fetchrow_hashref)
	{
	$usercountry = $column->{'country'};
	}
$sth->finish;

print qq|<div class="ha8"><h1><font color="#000080" size="1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;New Delivery and Shipment</font></h1>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Please enter the following information in order to create a new Delivery and Shipment<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Failure to enter the correct data will result in surcharges being billed for you and will delay delivery of your parcel.<br /><br />
<font size="2" face="Arial">
	<form class="nofrm" id="frmawb" name="frm" method="POST" onsubmit="return validateForm(this);" action="$script">
	<input name="returnhere" type="hidden" value="0" />
	<input name="entry" type="hidden" value="2" />
	<input name="entid" type="hidden" value="0" />
	<input name="cf" type="hidden" value="entry" />
	<input name="imported" type="hidden" value="0" />
	<input name="uid" type="hidden" value="$isUser" />
	<input name="ucountry" type="hidden" value="$usercountry" />
	<input name="cargo_log" type="hidden" value="" />
	<input name="flight_log" type="hidden" value="" />
	<table style="background-color:#FDF3D0; width: 100%" align="left">
		<tr>
			<td width="50">Date:&nbsp;<br /><span style="vertical-align: top;" />(dd.mm.yy)</span></td>
			<td width="150"><div style="vertical-align: middle;"><input tabindex=1 name="ord_date" type="text" size="8" style="vertical-align: middle; height:18px;" value="$ord_date" MAXLENGTH=8 /></div></td>
			<td width="730" rowspan="7"><div style="width:720px; height:155px; padding: 3px; overflow: auto;" id="cargoinf">&nbsp;</div><div style="width:720px; height:110px; padding:3px; overflow: auto;" id="flightinf">&nbsp;</div></td>
		</tr>
		<tr>
			<td width="50">MAWB:&nbsp;</td>
			<td width="150"><div style="vertical-align: top;"><input tabindex=2 name="ord_awb1" type="text" size="3" value="$ord_awb1" style="height:18px;" MAXLENGTH=3 />&nbsp;<input tabindex=3 name="ord_awb2" type="text" size="8" style="height:18px;" value="$ord_awb2" MAXLENGTH=8 onblur="fetch_cargo(this.form);" />&nbsp;&nbsp;</div>
			</td>
		</tr>
		<tr>
			<td width="50">Flight&nbsp;No:&nbsp;</td>
			<td width="150"><input tabindex=4 name="ord_flight" type="text" style="height:18px;" size="10" value="$ord_flight" onblur="fetch_flight(this.form);" /></td>
		</tr>
		<tr>
			<td width="50">Total&nbsp;Weight:&nbsp;<span class="text2">*</span></td>
			<td width="150"><input tabindex=5 name="ord_totw" type="text" size="10" style="height:18px;" value="$ord_totw" /></td>
		</tr>
		<tr>
			<td width="50">Total&nbsp;Bags:&nbsp;</td>
			<td width="150"><input tabindex=6 name="ord_totb" type="text" size="10" style="height:18px;" value="$ord_totb" /></td>
		</tr>
		<tr>
			<td width="200" colspan="2"><div id="pbar4" style="vertical-align: top;"><a href="javascript: ShowImportPopup();">Import Delivery Sheet...</a>&nbsp;(<a href="javascript:void(0);" onClick="javascript:window.open('help.html','Importhelp','width=' + (screen.width - 40) + ',height=' + (screen.height - 100) + ',top=20,left=10,scrollbars=yes,toolbar=no,status=no,menubar=yes,resizable=yes,location=no')">How?</a>)</div></td>
		</tr>
		<tr>
			<td width="50">No.&nbsp;of&nbsp;SRs:&nbsp;</td>
			<td width="150"><select tabindex=7 name="ord_hawbcount" style="height:20px; width:50px;" onChange="ChangeHAWB(this.options[this.selectedIndex].text);">|;
			
			print qq|<option value="1" selected>1</option>|;
			for( $i = 2 ; $i <= 500 ; $i++ )
				{
				print qq|<option value="$i">$i</option>|;
				}
			
			print qq|</select></td>
		</tr>
		<tr>
		<td width="100%" colspan="3">
<DIV ID="divHAWB">
</DIV>

<script>ChangeHAWB(1);</script>
		
		</td>
		</tr>
		<tr>
		<td width="100%" colspan="3" align="center">
		<center><br /><input name="submit1" type="submit" value=" Save & Finish " size="30" onClick="document.frm.returnhere.value='0';" />&nbsp;&nbsp;&nbsp;&nbsp;<input name="submit2" type="submit" value=" Save & Continue " size="30" onClick="document.frm.returnhere.value='1';" /></center>
		</td>
		</tr>
		</table>
&nbsp;

	</form>
</font>

</div>
|;
&footer;

}

sub entry2{
#	unless ($ord_date) {&error_page("Wrong data specified! Date is invalid. Please press back button in your browser to correct the problem."); exit;} 
#	unless ($ord_awb1 && $ord_awb2 && $ord_awb1 =~ /^\s*[0-9]{3}\s*$/ && $ord_awb2 =~ /^\s*[0-9]{8}\s*$/ ) {&error_page("Wrong data specified! MAWB is invalid. Please press back button in your browser to correct the problem."); exit;} 
#	unless ($ord_flight) {&error_page("Wrong data specified! Flight No. is invalid. Please press back button in your browser to correct the problem."); exit;} 

	my $tmptmp;
	my $j;
	
	if( $ord_awb1 || $ord_awb2 )
		{
		unless ($ord_awb1 && $ord_awb2 && $ord_awb1 =~ /^\s*[0-9]{3}\s*$/ && $ord_awb2 =~ /^\s*[0-9]{8}\s*$/ ) {&error_page("Wrong data specified! MAWB is invalid. Please press back button in your browser to correct the problem."); exit;} 
		}

	unless ($ord_totw && $ord_totw =~ /^\s*[0-9\.]+\s*$/) {&error_page("Wrong data specified! Total Weight is invalid. Please press back button in your browser to correct the problem."); exit;} 
#	unless ($ord_totb && $ord_totb =~ /^\s*[0-9]+\s*$/) {&error_page("Wrong data specified! Total Bags is invalid. Please press back button in your browser to correct the problem."); exit;} 

	unless ($ord_hawbcount && $ord_hawbcount =~ /^\s*[0-9]+\s*$/) {&error_page("Wrong data specified! Num. of HAWBs is invalid. Please press back button in your browser to correct the problem."); exit;} 

	for( $l = 1; $l <= ${'ord_hawbcount'} ; $l++ )
		{
		my $w0;
		$w0 = "dis[$l]";
		if( ${$w0} eq "0" )
			{
			my ($w, $w2);
			$w = "hawb[$l]";
			unless (${$w}) {error_page("[" . ${$w} . "]"); exit; &error_page("Wrong data specified! HAWB No. in SR# $l is invalid. Please press back button in your browser to correct the problem."); exit;} 
		 	$w = "lvhv[$l]";
		 	$w2 = ${$w};
			unless (${$w}) {&error_page("Wrong data specified! Value Category in SR# $l is invalid. Please press back button in your browser to correct the problem."); exit;} 
		 	$w = "currency[$l]";
			unless (${$w} eq '$' || ${$w} eq '£' || ${$w} eq '€' ) {&error_page("Wrong data specified! Currency in SR# $l is invalid. Please press back button in your browser to correct the problem."); exit;} 
		 	$w = "value[$l]";
			unless (${$w} && ${$w} =~ /^\s*[0-9\.]+\s*$/) {&error_page("Wrong data specified! Value in SR# $l is invalid. Please press back button in your browser to correct the problem."); exit;} 
		 	$w = "content[$l]";
			unless (${$w}) {&error_page("Wrong data specified! Content in SR# $l is invalid. Please press back button in your browser to correct the problem."); exit;} 
		 	$w = "cod[$l]";
		 	if( ${$w} )
		 		{
				unless ( ${$w} =~ /^\s*[0-9\.]+\s*$/) {&error_page("Wrong data specified! COD Amount in SR# $l is invalid. Please press back button in your browser to correct the problem."); exit;} 
				}
		 	$w = "item[$l]";
		 	$total_items2 = ${$w};
			unless (${$w} && ${$w} =~ /^\s*[0-9]+\s*$/) {&error_page("Wrong data specified! Item in SR# $l is invalid. Please press back button in your browser to correct the problem."); exit;} 
			for( $j = 1 ; $j <= $total_items2 ; $j++ )
				{
			 	$w = "weight[$l][$j]";
				unless (${$w} && ${$w} =~ /^\s*[0-9\.]+\s*$/) {&error_page("Wrong data specified! Weight in SR# $l Bag No. $j is invalid. Please press back button in your browser to correct the problem."); exit;} 
			 	$w = "bags[$l][$j]";
				unless ( ${$w} && ${$w} =~ /^\s*[0-9]+\s*$/) {&error_page("Wrong data specified! Bag Details Ref in SR# $l Bag No. $j is invalid. Please press back button in your browser to correct the problem."); exit;}
			 	$w = "length[$l][$j]";
				unless (${$w} && ${$w} =~ /^\s*[0-9]+\s*$/) {&error_page("Wrong data specified! Length in SR# $l Bag No. $j is invalid. Please press back button in your browser to correct the problem."); exit;} 
			 	$w = "width[$l][$j]";
				unless (${$w} && ${$w} =~ /^\s*[0-9]+\s*$/) {&error_page("Wrong data specified! Width in SR# $l Bag No. $j is invalid. Please press back button in your browser to correct the problem."); exit;} 
			 	$w = "height[$l][$j]";
				unless (${$w} && ${$w} =~ /^\s*[0-9]+\s*$/) {&error_page("Wrong data specified! Height in SR# $l Bag No. $j is invalid. Please press back button in your browser to correct the problem."); exit;} 
				}
		 	$w = "semail[$l]";
		 	if( ${$w} )
		 		{
				unless (${$w} =~ m~^(?:[a-zA-Z0-9_^&amp;/+-])+(?:\.(?:[a-zA-Z0-9_^&amp;/+-])+)*@(?:(?:\[?(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?))\.){3}(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\]?)|(?:[a-zA-Z0-9-]+\.)+(?:[a-zA-Z]){2,}\.?)$~)  {&error_page("Wrong data specified! Invalid Email format of Shipper in SR# $l is invalid. Please press back button in your browser to correct the problem."); exit;} 
				}
#		 	$w = "scountry[$l]";
#			unless ($imported eq "1" || $entid || ${$w}) {&error_page("Wrong data specified! Country of Shipper in SR# $l is invalid. Please press back button in your browser to correct the problem."); exit;} 
		 	$w = "remail[$l]";
		 	if( ${$w} )
		 		{
				unless (${$w} =~ m~^(?:[a-zA-Z0-9_^&amp;/+-])+(?:\.(?:[a-zA-Z0-9_^&amp;/+-])+)*@(?:(?:\[?(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?))\.){3}(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\]?)|(?:[a-zA-Z0-9-]+\.)+(?:[a-zA-Z]){2,}\.?)$~)  {&error_page("Wrong data specified! Invalid Email format of Receiver in SR# $l is invalid. Please press back button in your browser to correct the problem."); exit;} 
				}
#		 	$w = "rcontact[$l]";
#		 	$w2 = "rcompany[$l]";
#			unless ($imported eq "1" || $entid || ${$w} || ${$w2}) {&error_page("Wrong data specified! Contact or Company of Receiver must have value in SR# $l. Please press back button in your browser to correct the problem."); exit;} 
#		 	$w = "radd1[$l]";
#			unless ($imported eq "1" || $entid || ${$w}) {&error_page("Wrong data specified! Address 1 of Receiver in SR# $l is invalid. Please press back button in your browser to correct the problem."); exit;} 
		 	$w = "rphone[$l]";
			unless ($imported eq "1" || $entid || ${$w}) {&error_page("Wrong data specified! Phone of Receiver in SR# $l is invalid. Please press back button in your browser to correct the problem."); exit;} 
#		 	$w = "rtown[$l]";
#			unless ($imported eq "1" || $entid || ${$w}) {&error_page("Wrong data specified! Town of Receiver in SR# $l is invalid. Please press back button in your browser to correct the problem."); exit;} 
#		 	$w = "rpcode[$l]";
#			unless ($imported eq "1" || $entid || ${$w}) {&error_page("Wrong data specified! Post Code of Receiver in SR# $l is invalid. Please press back button in your browser to correct the problem."); exit;} 
		 	$w = "rcountry[$l]";
			unless ($imported eq "1" || $entid || ${$w}) {&error_page("Wrong data specified! Country of Receiver in SR# $l is invalid. Please press back button in your browser to correct the problem."); exit;} 
			}
		}

	$ord_flight =~ s/'/''/g;
	$cargo_log =~ s/'/''/g;
	$cargo_log =~ s/\n/ /sg;
	$flight_log =~ s/\n/ /sg;
	
	my $usercgi = new CGI;
	my $userip = $usercgi->remote_host(); 

	if( $ord_totb	)
		{ $ord_totbsql = $ord_totb; }
	else
		{ $ord_totbsql = '0'; }

	$e_has_lv = 0;
	$e_has_hv = 0;
	$e_has_mhv = 0;
	$e_has_pe = 0;
	$e_tot_weight = 0;

	if( $entid )
		{
		$SQL = "SELECT userid FROM entries WHERE entid=$entid";
		&my_sql;
		if ($column = $sth->fetchrow_hashref)
			{
			$uid = $column->{'userid'};
			$sth->finish;
			}
		else
			{
			$sth->finish;
			error_page("Delivery and Shipment not found");
			exit;
			}

		$SQL = "UPDATE entries SET entdate='$ord_date', awb1='$ord_awb1', awb2='$ord_awb2',flight='$ord_flight',habwcount=$ord_hawbcount,	totw=$ord_totw, totb=$ord_totbsql, ip='$userip', clogclosed='$cargo_log', flightlog='$flight_log' WHERE entid=$entid";
		
		&my_sql;
		$sth->finish;

		for( $l = 1; $l <= $ord_hawbcount ; $l++ )
			{
			my $w0;
			$w0 = "dis[$l]";
			if( ${$w0} eq "0" )
				{
				my $w;
	
				$SQL = "DELETE FROM entdetails WHERE entid=$entid AND sr=$l";
				&my_sql;
				$sth->finish;
		
				$SQL = "DELETE FROM bags WHERE entid=$entid and srid=$l";
				&my_sql;
				$sth->finish;
		
				$SQLFLDS = "(entid,sr,hawb,item,value,lvhv,hold,cod,content,currency,scontact,scompany,semail,sadd1,sadd2,sphone,stown,scounty,spcode,scountry,rcontact,rcompany,remail,radd1,radd2,rphone,rtown,rcounty,rpcode,rcountry,carrier,reference,estcar,estprice,endprice,ispaid,csved,cb_pervalue,cb_fixcharge,cb_cardcharge,cb_agentshare,cb_cbafter)";
		
				$SQLVALS = "($entid,";
				$SQLVALS = $SQLVALS . $l . ",'";
				$w = "hawb[$l]";
				$SQLVALS = $SQLVALS . ${$w} . "',";
			 	$w = "item[$l]";
			 	$total_items = ${$w};
				$SQLVALS = $SQLVALS . ${$w} . ",";
			 	$w = "value[$l]";
				$SQLVALS = $SQLVALS . ${$w} . ",";
	
			 	$w = "lvhv[$l]";
			 	if( ${$w} eq "LV" )
			 		{
			 		$mylvhv = 1;
					$e_has_lv = 1;
			 		}
			 	elsif( ${$w} eq "HV" )
			 		{
			 		$mylvhv = 2;
					$e_has_hv = 1;
			 		}
			 	elsif( ${$w} eq "MHV" )
			 		{
			 		$mylvhv = 3;
					$e_has_mhv = 1;
			 		}
			 	else
			 		{
			 		$mylvhv = 4;
					$e_has_pe = 1;
			 		}
			 		
				$SQLVALS = $SQLVALS . $mylvhv . ",";
	
			 	$w = "hold[$l]";
			 	if( ${$w} eq "HOLD" )
			 		{
					$SQLVALS = $SQLVALS . "1,";
					}
				else
			 		{
					$SQLVALS = $SQLVALS . "0,";
					}
					
			 	$w = "cod[$l]";
			 	if( ${$w} )
			 		{
					$SQLVALS = $SQLVALS . ${$w} . ",'";
					}
				else
			 		{
					$SQLVALS = $SQLVALS . "0,'";
					}
				
			 	$w = "content[$l]";
			 	$tmptmp = ${$w};
				$tmptmp =~ s/'/''/g;
				$SQLVALS = $SQLVALS . $tmptmp . "','";
			 	$w = "currency[$l]";
				$SQLVALS = $SQLVALS . ${$w} . "','";
				
			 	$w = "scontact[$l]";
			 	$tmptmp = ${$w};
				$tmptmp =~ s/'/''/g;
				$SQLVALS = $SQLVALS . $tmptmp . "','";
			 	$w = "scompany[$l]";
			 	$tmptmp = ${$w};
				$tmptmp =~ s/'/''/g;
				$SQLVALS = $SQLVALS . $tmptmp . "','";
			 	$w = "semail[$l]";
			 	$tmptmp = ${$w};
				$tmptmp =~ s/'/''/g;
				$SQLVALS = $SQLVALS . $tmptmp . "','";
			 	$w = "sadd1[$l]";
			 	$tmptmp = ${$w};
				$tmptmp =~ s/'/''/g;
				$SQLVALS = $SQLVALS . $tmptmp . "','";
			 	$w = "sadd2[$l]";
			 	$tmptmp = ${$w};
				$tmptmp =~ s/'/''/g;
				$SQLVALS = $SQLVALS . $tmptmp . "','";
			 	$w = "sphone[$l]";
			 	$tmptmp = ${$w};
				$tmptmp =~ s/'/''/g;
				$SQLVALS = $SQLVALS . $tmptmp . "','";
			 	$w = "stown[$l]";
			 	$tmptmp = ${$w};
				$tmptmp =~ s/'/''/g;
				$SQLVALS = $SQLVALS . $tmptmp . "','";
			 	$w = "scounty[$l]";
			 	$tmptmp = ${$w};
				$tmptmp =~ s/'/''/g;
				$SQLVALS = $SQLVALS . $tmptmp . "','";
			 	$w = "spcode[$l]";
			 	$tmptmp = ${$w};
				$tmptmp =~ s/'/''/g;
				$SQLVALS = $SQLVALS . $tmptmp . "',";
			 	$w = "scountry[$l]";
			 	if( ${$w} )
			 		{
					$SQLVALS = $SQLVALS . ${$w} . ",'";
					}
				else
			 		{
					$SQLVALS = $SQLVALS . "0,'";
					}

			 	$w = "rcontact[$l]";
			 	$tmptmp = ${$w};
				$tmptmp =~ s/'/''/g;
				$SQLVALS = $SQLVALS . $tmptmp . "','";
			 	$w = "rcompany[$l]";
			 	$tmptmp = ${$w};
				$tmptmp =~ s/'/''/g;
				$SQLVALS = $SQLVALS . $tmptmp . "','";
			 	$w = "remail[$l]";
			 	$tmptmp = ${$w};
				$tmptmp =~ s/'/''/g;
				$SQLVALS = $SQLVALS . $tmptmp . "','";
			 	$w = "radd1[$l]";
			 	$tmptmp = ${$w};
				$tmptmp =~ s/'/''/g;
				$SQLVALS = $SQLVALS . $tmptmp . "','";
			 	$w = "radd2[$l]";
			 	$tmptmp = ${$w};
				$tmptmp =~ s/'/''/g;
				$SQLVALS = $SQLVALS . $tmptmp . "','";
			 	$w = "rphone[$l]";
			 	$tmptmp = ${$w};
				$tmptmp =~ s/'/''/g;
				$SQLVALS = $SQLVALS . $tmptmp . "','";
			 	$w = "rtown[$l]";
			 	$tmptmp = ${$w};
				$tmptmp =~ s/'/''/g;
				$SQLVALS = $SQLVALS . $tmptmp . "','";
			 	$w = "rcounty[$l]";
			 	$tmptmp = ${$w};
				$tmptmp =~ s/'/''/g;
				$SQLVALS = $SQLVALS . $tmptmp . "','";
			 	$w = "rpcode[$l]";
			 	$tmptmp = ${$w};
				$tmptmp =~ s/'/''/g;
				$SQLVALS = $SQLVALS . $tmptmp . "',";
			 	$w = "rcountry[$l]";
				if( ${$w} )
					{
					$SQLVALS = $SQLVALS . ${$w} . ",";
					}
				else
					{
					$SQLVALS = $SQLVALS . "0,";
					}

				$SQLVALS = $SQLVALS . "0,'',0,0,0,0,'',0,0,0,0,0)";

				$SQL = "INSERT INTO entdetails $SQLFLDS VALUES $SQLVALS";
				&my_sql;
				$sth->finish;

				for( $bagi = 1 ; $bagi <= $total_items ; $bagi++ )
					{
					my ($w1, $w2, $w3, $w4, $w5, $wu);
					$SQLFLDS = "(bagid,entid,srid,bag,weight,length,width,height)";

					$SQLVALS = "(0, $entid,";
					$SQLVALS = $SQLVALS . $l . ",";
					$w1 = "bags[$l][$bagi]";
					$SQLVALS = $SQLVALS . ${$w1} . ",";
					$w2 = "weight[$l][$bagi]";
					$SQLVALS = $SQLVALS . ${$w2} . ",";
					$w3 = "length[$l][$bagi]";
					$SQLVALS = $SQLVALS . ${$w3} . ",";
					$w4 = "width[$l][$bagi]";
					$SQLVALS = $SQLVALS . ${$w4} . ",";
					$w5 = "height[$l][$bagi]";
					$SQLVALS = $SQLVALS . ${$w5} . ")";

					$wu = toCurr((${$w3} * ${$w4} * ${$w5}) / 4000);
					$wu = (${$w2} + 1 - 1) if( (${$w2} + 1 - 1) > $wu );

					$e_tot_weight = $e_tot_weight + $wu;

					$SQL = "INSERT INTO bags $SQLFLDS VALUES $SQLVALS";
					&my_sql;
					$sth->finish;
					}
				}
			}

		$SQL = "SELECT ceclv,cechv,cecmhv,cecpe,ahcminkg,ahccharge,ahcperkg,fas,aircol FROM members WHERE userid=$uid";
		&my_sql;
		if ($column = $sth->fetchrow_hashref)
			{
			$e_ceclv = $column->{'ceclv'} + 1 - 1;
			$e_cechv = $column->{'cechv'} + 1 - 1;
			$e_cecmhv = $column->{'cecmhv'} + 1 - 1;
			$e_cecpe = $column->{'cecpe'} + 1 - 1;
			
			$e_ahcminkg = $column->{'ahcminkg'} + 1 - 1;
			$e_ahccharge = $column->{'ahccharge'} + 1 - 1;
			$e_ahcperkg = $column->{'ahcperkg'} + 1 - 1;
			$e_fas = $column->{'fas'} + 1 - 1;
			$e_aircol = $column->{'aircol'} + 1 - 1;
			}
		else
			{
			$e_ceclv = 0;
			$e_cechv = 0;
			$e_cecmhv = 0;
			$e_cecpe = 0;
			
			$e_ahcminkg = 0;
			$e_ahccharge = 0;
			$e_ahcperkg = 0;
			$e_fas = 0;
			$e_aircol = 0;
			}
		$sth->finish;
		
		if( $e_has_lv && $e_ceclv )
			{
			$SQL = "SELECT amount FROM accounts WHERE userid=$uid AND aref=$entid AND atype='L'";
			&my_sql;
			if( $column = $sth->fetchrow_hashref )
				{
				$SQL2 = "DELETE FROM accounts WHERE userid=$uid AND aref=$entid AND atype='L'";
				&my_sql2;
				$sth2->finish;
				}
			$sth->finish;

			$e_ceclv = -1 * $e_ceclv;
			$SQL = "INSERT INTO accounts (accid, userid, adate, amount, atype, aref, asubref, asubrefstr, adesc) VALUES (0, $uid, CURRENT_TIMESTAMP(), $e_ceclv, 'L', $entid, 0, '', 'Credit Subtracted for Entry Ref. $entid. for Custom Entry Charge for LV')";
			&my_sql;
			$sth->finish;
			}

		if( $e_has_hv && $e_cechv )
			{
			$SQL = "SELECT amount FROM accounts WHERE userid=$uid AND aref=$entid AND atype='H'";
			&my_sql;
			if( $column = $sth->fetchrow_hashref )
				{
				$SQL2 = "DELETE FROM accounts WHERE userid=$uid AND aref=$entid AND atype='H'";
				&my_sql2;
				$sth2->finish;
				}
			$sth->finish;

			$e_cechv = -1 * $e_cechv;
			$SQL = "INSERT INTO accounts (accid, userid, adate, amount, atype, aref, asubref, asubrefstr, adesc) VALUES (0, $uid, CURRENT_TIMESTAMP(), $e_cechv, 'H', $entid, 0, '', 'Credit Subtracted for Entry Ref. $entid. for Custom Entry Charge for HV')";
			&my_sql;
			$sth->finish;
			}

		if( $e_has_mhv && $e_cecmhv )
			{
			$SQL = "SELECT amount FROM accounts WHERE userid=$uid AND aref=$entid AND atype='M'";
			&my_sql;
			if( $column = $sth->fetchrow_hashref )
				{
				$SQL2 = "DELETE FROM accounts WHERE userid=$uid AND aref=$entid AND atype='M'";
				&my_sql2;
				$sth2->finish;
				}
			$sth->finish;

			$e_cecmhv = -1 * $e_cecmhv;
			$SQL = "INSERT INTO accounts (accid, userid, adate, amount, atype, aref, asubref, asubrefstr, adesc) VALUES (0, $uid, CURRENT_TIMESTAMP(), $e_cecmhv, 'M', $entid, 0, '', 'Credit Subtracted for Entry Ref. $entid. for Custom Entry Charge for MHV')";
			&my_sql;
			$sth->finish;
			}

		if( $e_has_pe && $e_cecpe )
			{
			$SQL = "SELECT amount FROM accounts WHERE userid=$uid AND aref=$entid AND atype='P'";
			&my_sql;
			if( $column = $sth->fetchrow_hashref )
				{
				$SQL2 = "DELETE FROM accounts WHERE userid=$uid AND aref=$entid AND atype='P'";
				&my_sql2;
				$sth2->finish;
				}
			$sth->finish;

			$e_cecpe = -1 * $e_cecpe;
			$SQL = "INSERT INTO accounts (accid, userid, adate, amount, atype, aref, asubref, asubrefstr, adesc) VALUES (0, $uid, CURRENT_TIMESTAMP(), $e_cecpe, 'P', $entid, 0, '', 'Credit Subtracted for Entry Ref. $entid. for Custom Entry Charge for PE')";
			&my_sql;
			$sth->finish;
			}
		

		if( $e_ahccharge && $e_tot_weight && $e_ahcperkg )
			{
			$SQL = "SELECT amount FROM accounts WHERE userid=$uid AND aref=$entid AND atype='A'";
			&my_sql;
			if( $column = $sth->fetchrow_hashref )
				{
				$SQL2 = "DELETE FROM accounts WHERE userid=$uid AND aref=$entid AND atype='A'";
				&my_sql2;
				$sth2->finish;
				}
			$sth->finish;
			if( $e_tot_weight <= $e_ahcminkg )
				{
				$e_ahccharge = -1 * $e_ahccharge;
				$SQL = "INSERT INTO accounts (accid, userid, adate, amount, atype, aref, asubref, asubrefstr, adesc) VALUES (0, $uid, CURRENT_TIMESTAMP(), $e_ahccharge, 'A', $entid, 0, '', 'Credit Subtracted for Entry Ref. $entid. for Airline Handling Charge')";
				&my_sql;
				$sth->finish;
				}
			else
				{
				my $tot_ahc;
				$tot_ahc = toCurr($e_ahccharge + ceil($e_tot_weight - $e_ahcminkg) * $e_ahcperkg);
				
				$tot_ahc = -1 * $tot_ahc;
				$SQL = "INSERT INTO accounts (accid, userid, adate, amount, atype, aref, asubref, asubrefstr, adesc) VALUES (0, $uid, CURRENT_TIMESTAMP(), $tot_ahc, 'A', $entid, 0, '', 'Credit Subtracted for Entry Ref. $entid. for Airline Handling Charge')";
				&my_sql;
				$sth->finish;
				}
			}

		if( $e_fas )
			{
			$SQL = "SELECT amount FROM accounts WHERE userid=$uid AND aref=$entid AND atype='F'";
			&my_sql;
			if( $column = $sth->fetchrow_hashref )
				{
				$SQL2 = "DELETE FROM accounts WHERE userid=$uid AND aref=$entid AND atype='F'";
				&my_sql2;
				$sth2->finish;
				}
			$sth->finish;

			$e_fas = -1 * $e_fas;
			$SQL = "INSERT INTO accounts (accid, userid, adate, amount, atype, aref, asubref, asubrefstr, adesc) VALUES (0, $uid, CURRENT_TIMESTAMP(), $e_fas, 'F', $entid, 0, '', 'Credit Subtracted for Entry Ref. $entid. for FAS Account service charge')";
			&my_sql;
			$sth->finish;
			}

		if( $e_aircol )
			{
			$SQL = "SELECT amount FROM accounts WHERE userid=$uid AND aref=$entid AND atype='O'";
			&my_sql;
			if( $column = $sth->fetchrow_hashref )
				{
				$SQL2 = "DELETE FROM accounts WHERE userid=$uid AND aref=$entid AND atype='O'";
				&my_sql2;
				$sth2->finish;
				}
			$sth->finish;

			$e_aircol = -1 * $e_aircol;
			$SQL = "INSERT INTO accounts (accid, userid, adate, amount, atype, aref, asubref, asubrefstr, adesc) VALUES (0, $uid, CURRENT_TIMESTAMP(), $e_aircol, 'O', $entid, 0, '', 'Credit Subtracted for Entry Ref. $entid. for Airport Collection Charge')";
			&my_sql;
			$sth->finish;
			}
	
		$noredirect=1;
		&estimate;
		
		if( $isUser != 6 )
			{
			&SendEmail($myemail, $adminemail, "Europost D&S Ref.: $entid is changed", "<p>Dear $salesman,<br><br>The Delivery and Shipment Ref.: $entid is just edited by \"$fullname\". You may visit the Delivery and Shipment at:<br><br><a href=\"$scripturl?cf=entry&view=1&entid=$entid\">$scripturl?cf=entry&view=1&entid=$entid</a><br><br>Your Sincerely,<br>Administrator</p>");
			}

		if( $returnhere eq '0' )
			{		
			if( $fromlist )
				{
				$redirect ="$script?cf=member&userid=$isUser";
				}
			else
				{
				$redirect="$script?cf=orderok";
				}
			}
		else
			{
			$redirect="$script?cf=entry&edit=1&entid=$entid";
			}
		print $form->redirect(-url=>$redirect);
		}
	else
		{
		$SQLFLDS = "(entid,userid,entdate,status,type,awb1,awb2,flight,habwcount,totw,totb,ip, clogclosed, flogclosed, cargolog, flightlog, finalprice, lvitems, mvitems)";
		$SQLVALS = "(0,$isUser, '$ord_date', 1, 1, '$ord_awb1', '$ord_awb2', '$ord_flight', $ord_hawbcount, $ord_totw, $ord_totbsql, '$userip', 0, 0, '$cargo_log', '$flight_log',0, 0, 0)";
	
		$uid = $isUser;
		$SQL = "INSERT INTO entries $SQLFLDS VALUES $SQLVALS";
		
		&my_sql;
		$sth->finish;
	
		$entid = 0;
		$SQL = "SELECT LAST_INSERT_ID() as entid FROM entries"; 
		&my_sql;
		if ($column = $sth->fetchrow_hashref)
			{
			$entid = $column->{'entid'};
			}
		$sth->finish;
	
		$e_has_lv = 0;
		$e_has_hv = 0;
		$e_has_mhv = 0;
		$e_has_pe = 0;
		$e_tot_weight = 0;

		if( $entid )
			{
			for( $l = 1; $l <= $ord_hawbcount ; $l++ )
				{
				my $w;
		
				$SQLFLDS = "(entid,sr,hawb,item,value,lvhv,hold,cod,content,currency,scontact,scompany,semail,sadd1,sadd2,sphone,stown,scounty,spcode,scountry,rcontact,rcompany,remail,radd1,radd2,rphone,rtown,rcounty,rpcode,rcountry,carrier,reference,estcar,estprice,endprice,ispaid,csved,cb_pervalue,cb_fixcharge,cb_cardcharge,cb_agentshare,cb_cbafter)";
				$SQLVALS = "($entid,";
				$SQLVALS = $SQLVALS . $l . ",'";
				$w = "hawb[$l]";
				$SQLVALS = $SQLVALS . ${$w} . "',";
			 	$w = "item[$l]";
			 	$total_items = ${$w};
				$SQLVALS = $SQLVALS . ${$w} . ",";
			 	$w = "value[$l]";
				$SQLVALS = $SQLVALS . ${$w} . ",";
	
			 	$w = "lvhv[$l]";
			 	if( ${$w} eq "LV" )
			 		{
			 		$mylvhv = 1;
			 		$e_has_lv = 1;
			 		}
			 	elsif( ${$w} eq "HV" )
			 		{
			 		$mylvhv = 2;
			 		$e_has_hv = 1;
			 		}
			 	elsif( ${$w} eq "MHV" )
			 		{
			 		$mylvhv = 3;
			 		$e_has_mhv = 1;
			 		}
			 	else
			 		{
			 		$mylvhv = 4;
			 		$e_has_pe = 1;
			 		}
			 		
				$SQLVALS = $SQLVALS . $mylvhv . ",";
	
			 	$w = "hold[$l]";
			 	if( ${$w} eq "HOLD" )
			 		{
					$SQLVALS = $SQLVALS . "1,";
					}
				else
			 		{
					$SQLVALS = $SQLVALS . "0,";
					}
					
			 	$w = "cod[$l]";
			 	if( ${$w} )
			 		{
					$SQLVALS = $SQLVALS . ${$w} . ",'";
					}
				else
			 		{
					$SQLVALS = $SQLVALS . "0,'";
					}
				
			 	$w = "content[$l]";
			 	$tmptmp = ${$w};
				$tmptmp =~ s/'/''/g;
				$SQLVALS = $SQLVALS . $tmptmp . "','";
			 	$w = "currency[$l]";
				$SQLVALS = $SQLVALS . ${$w} . "','";
				
			 	$w = "scontact[$l]";
			 	$tmptmp = ${$w};
				$tmptmp =~ s/'/''/g;
				$SQLVALS = $SQLVALS . $tmptmp . "','";
			 	$w = "scompany[$l]";
			 	$tmptmp = ${$w};
				$tmptmp =~ s/'/''/g;
				$SQLVALS = $SQLVALS . $tmptmp . "','";
			 	$w = "semail[$l]";
			 	$tmptmp = ${$w};
				$tmptmp =~ s/'/''/g;
				$SQLVALS = $SQLVALS . $tmptmp . "','";
			 	$w = "sadd1[$l]";
			 	$tmptmp = ${$w};
				$tmptmp =~ s/'/''/g;
				$SQLVALS = $SQLVALS . $tmptmp . "','";
			 	$w = "sadd2[$l]";
			 	$tmptmp = ${$w};
				$tmptmp =~ s/'/''/g;
				$SQLVALS = $SQLVALS . $tmptmp . "','";
			 	$w = "sphone[$l]";
			 	$tmptmp = ${$w};
				$tmptmp =~ s/'/''/g;
				$SQLVALS = $SQLVALS . $tmptmp . "','";
			 	$w = "stown[$l]";
			 	$tmptmp = ${$w};
				$tmptmp =~ s/'/''/g;
				$SQLVALS = $SQLVALS . $tmptmp . "','";
			 	$w = "scounty[$l]";
			 	$tmptmp = ${$w};
				$tmptmp =~ s/'/''/g;
				$SQLVALS = $SQLVALS . $tmptmp . "','";
			 	$w = "spcode[$l]";
			 	$tmptmp = ${$w};
				$tmptmp =~ s/'/''/g;
				$SQLVALS = $SQLVALS . $tmptmp . "',";
			 	$w = "scountry[$l]";
			 	if( ${$w} )
			 		{
					$SQLVALS = $SQLVALS . ${$w} . ",'";
					}
				else
			 		{
					$SQLVALS = $SQLVALS . "0,'";
					}

			 	$w = "rcontact[$l]";
			 	$tmptmp = ${$w};
				$tmptmp =~ s/'/''/g;
				$SQLVALS = $SQLVALS . $tmptmp . "','";
			 	$w = "rcompany[$l]";
			 	$tmptmp = ${$w};
				$tmptmp =~ s/'/''/g;
				$SQLVALS = $SQLVALS . $tmptmp . "','";
			 	$w = "remail[$l]";
			 	$tmptmp = ${$w};
				$tmptmp =~ s/'/''/g;
				$SQLVALS = $SQLVALS . $tmptmp . "','";
			 	$w = "radd1[$l]";
			 	$tmptmp = ${$w};
				$tmptmp =~ s/'/''/g;
				$SQLVALS = $SQLVALS . $tmptmp . "','";
			 	$w = "radd2[$l]";
			 	$tmptmp = ${$w};
				$tmptmp =~ s/'/''/g;
				$SQLVALS = $SQLVALS . $tmptmp . "','";
			 	$w = "rphone[$l]";
			 	$tmptmp = ${$w};
				$tmptmp =~ s/'/''/g;
				$SQLVALS = $SQLVALS . $tmptmp . "','";
			 	$w = "rtown[$l]";
			 	$tmptmp = ${$w};
				$tmptmp =~ s/'/''/g;
				$SQLVALS = $SQLVALS . $tmptmp . "','";
			 	$w = "rcounty[$l]";
			 	$tmptmp = ${$w};
				$tmptmp =~ s/'/''/g;
				$SQLVALS = $SQLVALS . $tmptmp . "','";
			 	$w = "rpcode[$l]";
			 	$tmptmp = ${$w};
				$tmptmp =~ s/'/''/g;
				$SQLVALS = $SQLVALS . $tmptmp . "',";
			 	$w = "rcountry[$l]";
				if( ${$w} )
					{
					$SQLVALS = $SQLVALS . ${$w} . ",";
					}
				else
					{
					$SQLVALS = $SQLVALS . "0,";
					}

				$SQLVALS = $SQLVALS . "0,'',0,0,0,0,'',0,0,0,0,0)";
				
				$SQL = "INSERT INTO entdetails $SQLFLDS VALUES $SQLVALS";
#				print "Content-type: text/plain\n\n"; 
#				print "\n$SQL";
				&my_sql;
				$sth->finish;

#				print "Content-type: text/plain\n\n"; 
#				print "[$total_items]\n";

				for( $bagi = 1 ; $bagi <= $total_items ; $bagi++ )
					{
					my ($w1, $w2, $w3, $w4, $w5, $wu);
					$SQLFLDS = "(bagid,entid,srid,bag,weight,length,width,height)";

					$SQLVALS = "(0, $entid,";
					$SQLVALS = $SQLVALS . $l . ",";
					$w1 = "bags[$l][$bagi]";
					$SQLVALS = $SQLVALS . ${$w1} . ",";
					$w2 = "weight[$l][$bagi]";
					$SQLVALS = $SQLVALS . ${$w2} . ",";
					$w3 = "length[$l][$bagi]";
					$SQLVALS = $SQLVALS . ${$w3} . ",";
					$w4 = "width[$l][$bagi]";
					$SQLVALS = $SQLVALS . ${$w4} . ",";
					$w5 = "height[$l][$bagi]";
					$SQLVALS = $SQLVALS . ${$w5} . ")";

					$wu = toCurr((${$w3} * ${$w4} * ${$w5}) / 4000);
					$wu = (${$w2} + 1 - 1) if( (${$w2} + 1 - 1) > $wu );

					$e_tot_weight = $e_tot_weight + $wu;

					$SQL = "INSERT INTO bags $SQLFLDS VALUES $SQLVALS";
#					print "[$SQL]\n";
					&my_sql;
					$sth->finish;
					}
	
			 	$w = "msg[$l]";
			 	$tmptmp = ${$w};
				$tmptmp =~ s/'/''/g;
				if( $tmptmp )
					{
					require "/home/europost/public_html/message.pl";
					&SendMessage($entid,$l,$isUser,$myadminid,$tmptmp, 0);
					}
				}
	
			$entitems = 0;
			$SQL = "SELECT COUNT(*) as entitems FROM entdetails WHERE entid=$entid"; 
			&my_sql;
			if ($column = $sth->fetchrow_hashref)
				{
				$entitems = $column->{'entitems'};
				}
			$sth->finish;
	
			if( $entitems == $ord_hawbcount )
				{
				$SQL = "SELECT ceclv,cechv,cecmhv,cecpe,ahcminkg,ahccharge,ahcperkg,fas,aircol FROM members WHERE userid=$isUser";
				&my_sql;
				if ($column = $sth->fetchrow_hashref)
					{
					$e_ceclv = $column->{'ceclv'} + 1 - 1;
					$e_cechv = $column->{'cechv'} + 1 - 1;
					$e_cecmhv = $column->{'cecmhv'} + 1 - 1;
					$e_cecpe = $column->{'cecpe'} + 1 - 1;
					
					$e_ahcminkg = $column->{'ahcminkg'} + 1 - 1;
					$e_ahccharge = $column->{'ahccharge'} + 1 - 1;
					$e_ahcperkg = $column->{'ahcperkg'} + 1 - 1;
					$e_fas = $column->{'fas'} + 1 - 1;
					$e_aircol = $column->{'aircol'} + 1 - 1;
					}
				else
					{
					$e_ceclv = 0;
					$e_cechv = 0;
					$e_cecmhv = 0;
					$e_cecpe = 0;
					
					$e_ahcminkg = 0;
					$e_ahccharge = 0;
					$e_ahcperkg = 0;
					$e_fas = 0;
					$e_aircol = 0;
					}
				
				$sth->finish;
				
				if( $e_has_lv && $e_ceclv )
					{
					$e_ceclv = -1 * $e_ceclv;
					$SQL = "INSERT INTO accounts (accid, userid, adate, amount, atype, aref, asubref, asubrefstr, adesc) VALUES (0, $isUser, CURRENT_TIMESTAMP(), $e_ceclv, 'L', $entid, 0, '', 'Credit Subtracted for Entry Ref. $entid. for Custom Entry Charge for LV')";
					&my_sql;
					$sth->finish;
					}

				if( $e_has_hv && $e_cechv )
					{
					$e_cechv = -1 * $e_cechv;
					$SQL = "INSERT INTO accounts (accid, userid, adate, amount, atype, aref, asubref, asubrefstr, adesc) VALUES (0, $isUser, CURRENT_TIMESTAMP(), $e_cechv, 'H', $entid, 0, '', 'Credit Subtracted for Entry Ref. $entid. for Custom Entry Charge for HV')";
					&my_sql;
					$sth->finish;
					}

				if( $e_has_mhv && $e_cecmhv )
					{
					$e_cecmhv = -1 * $e_cecmhv;
					$SQL = "INSERT INTO accounts (accid, userid, adate, amount, atype, aref, asubref, asubrefstr, adesc) VALUES (0, $isUser, CURRENT_TIMESTAMP(), $e_cecmhv, 'M', $entid, 0, '', 'Credit Subtracted for Entry Ref. $entid. for Custom Entry Charge for MHV')";
					&my_sql;
					$sth->finish;
					}

				if( $e_has_pe && $e_cecpe )
					{
					$e_cecpe = -1 * $e_cecpe;
					$SQL = "INSERT INTO accounts (accid, userid, adate, amount, atype, aref, asubref, asubrefstr, adesc) VALUES (0, $isUser, CURRENT_TIMESTAMP(), $e_cecpe, 'P', $entid, 0, '', 'Credit Subtracted for Entry Ref. $entid. for Custom Entry Charge for PE')";
					&my_sql;
					$sth->finish;
					}
				

				if( $e_ahccharge && $e_tot_weight && $e_ahcperkg )
					{
					if( $e_tot_weight <= $e_ahcminkg )
						{
						$e_ahccharge = -1 * $e_ahccharge;
						$SQL = "INSERT INTO accounts (accid, userid, adate, amount, atype, aref, asubref, asubrefstr, adesc) VALUES (0, $isUser, CURRENT_TIMESTAMP(), $e_ahccharge, 'A', $entid, 0, '', 'Credit Subtracted for Entry Ref. $entid. for Airline Handling Charge')";
						&my_sql;
						$sth->finish;
						}
					else
						{
						my $tot_ahc;
						$tot_ahc = toCurr($e_ahccharge + ceil($e_tot_weight - $e_ahcminkg) * $e_ahcperkg);
						
						$tot_ahc = -1 * $tot_ahc;
						$SQL = "INSERT INTO accounts (accid, userid, adate, amount, atype, aref, asubref, asubrefstr, adesc) VALUES (0, $isUser, CURRENT_TIMESTAMP(), $tot_ahc, 'A', $entid, 0, '', 'Credit Subtracted for Entry Ref. $entid. for Airline Handling Charge')";
						&my_sql;
						$sth->finish;
						}
					}

				if( $e_fas )
					{
					$e_fas = -1 * $e_fas;
					$SQL = "INSERT INTO accounts (accid, userid, adate, amount, atype, aref, asubref, asubrefstr, adesc) VALUES (0, $isUser, CURRENT_TIMESTAMP(), $e_fas, 'F', $entid, 0, '', 'Credit Subtracted for Entry Ref. $entid. for FAS Account service charge')";
					&my_sql;
					$sth->finish;
					}

				if( $e_aircol )
					{
					$e_aircol = -1 * $e_aircol;
					$SQL = "INSERT INTO accounts (accid, userid, adate, amount, atype, aref, asubref, asubrefstr, adesc) VALUES (0, $isUser, CURRENT_TIMESTAMP(), $e_aircol, 'O', $entid, 0, '', 'Credit Subtracted for Entry Ref. $entid. for Airport Collection Charge')";
					&my_sql;
					$sth->finish;
					}

				$noredirect=1;
				&estimate;
				if( $isUser != 6 )
					{
					&SendEmail($myemail, $adminemail, "New Europost D&S (Ref.: $entid)", "<p>Dear $salesman,<br><br>A new Delivery and Shipment, Ref.: $entid, is just placed in your system by \"$fullname\". You may visit the Delivery and Shipment at:<br><br><a href=\"$scripturl?cf=entry&view=1&entid=$entid\">$scripturl?cf=entry&view=1&entid=$entid</a><br><br>Your Sincerely,<br>Administrator</p>");
					}
		
				if( $returnhere eq '0' )
					{		
					$redirect="$script?cf=orderok";
					}
				else
					{
					$redirect="$script?cf=entry&edit=1&entid=$entid";
					}
				print $form->redirect(-url=>$redirect);
				}
			else
				{
				$SQL = "DELETE FROM bags WHERE entid=$entid";
				&my_sql;
				$sth->finish;
				$SQL = "DELETE FROM entdetails WHERE entid=$entid";
				&my_sql;
				$sth->finish;
				$SQL = "DELETE FROM entries WHERE entid=$entid";
				&my_sql;
				$sth->finish;
				$SQL = "DELETE FROM messages WHERE entryid=$entid";
				&my_sql;
				$sth->finish;
	
				&error_page("Couldn't save the Delivery and Shipment rows in the database. Please try again. If the problem persists, please call the administrator."); exit;
				}
			}
		else
			{
			&error_page("Couldn't save the Delivery and Shipment in the database. Please try again. If the problem persists, please call the administrator."); exit;
			}
		}
}

sub import1{
	print $form->header;
	
	print qq~
	<html>
	<head>
	<script langugae="javascript">

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

function GetFileObject()
{
	if (window.ActiveXObject)
  	{
	  // code for IE6, IE5
		try
		  {
		  	return new ActiveXObject("Scripting.FileSystemObject");
		  }
		catch(err)
		  {
			alert("Your browser settings does not allow ActiveX and Scripting to be run.\\nPlease configure the browser settings and try again.");
			return null;
		  }	  
	  }
	if (window.XMLHttpRequest)
	  {
		alert("Your browser does not support XMLHTTP. Import is not possible.");
	  return null;
	  // code for IE7+, Firefox, Chrome, Opera, Safari
		//	  return new XMLHttpRequest();
	  }

	alert("Your browser does not support XMLHTTP. Import is not possible.");
	return null;
}

function Import(frmread)
{
	frm2change = parent.parent.parent.document.getElementById('frmawb');

	if( frmread.filename.value == "" )
		{
		alert("Please select a file to import");
		return false;
		}

	if( frmread.delimiter.value == "" )
		{
		alert("Please select a delimiter character");
		return false;
		}
		
	var fso  = GetFileObject();
	if( fso == null )
		{
		return false;
		}

	var totalcolumns;
	var totalsize;
	try
		{
		var ff = fso.GetFile(frmread.filename.value);
		totalsize = ff.size;
		}
	catch(err)
		{
		totalsize = 'Unknown';
		}
		
	var fh = fso.OpenTextFile(frmread.filename.value, 1, false, 0);
	if( fh == null )
		{
		alert("Cannot open the file!");
		return false;
		}			
		
	var str = "";

	var c_awb = -1;
	var c_company = -1;
	var c_contact = -1;
	var c_email = -1;
	var c_add1 = -1;
	var c_add2 = -1;
	var c_town = -1;
	var c_state = -1;
	var c_country = -1;
	var c_postcode = -1;
	var c_tel = -1;
	var c_items = -1;
	var c_weight = -1;
	var c_length = -1;
	var c_width = -1;
	var c_height = -1;
	var c_val = -1;
	var c_content = -1;
	var c_value = -1;
	var c_currency = -1;
	var c_cod = -1;
	var c_bags = -1;
	var c_note = -1;
	var c_shipper = -1;

	var readsize = 0;

	if (!fh.AtEndOfStream)
		str = String(fh.ReadLine()).toUpperCase();
	else
		{
		fh.Close();
		alert("Invalid file format! Header is not valid.");
		return false;
		}
	
	var headArr = str.split(frmread.delimiter.value);
	if( headArr.length < 12 )
		{
		fh.Close();
		alert("Invalid file format! Header is not valid.");
		return false;
		}

	totalcolumns = headArr.length;

	for( i = 0 ; i < totalcolumns ; i++ )
	{
		switch(headArr[i])
		{
		case "HAWB":
			c_awb = i;
			break;
		case "COMPANY":
			c_company = i;
			break;
		case "CONTACT":
			c_contact = i;
			break;
		case "ADDRESS 1":
		case "ADDRESS1":
		case "ADD 1":
		case "ADD1":
		case "ADDR 1":
		case "ADDR1":
			c_add1 = i;
			break;
		case "ADDRESS 2":
		case "ADDRESS2":
		case "ADD 2":
		case "ADD2":
		case "ADDR 2":
		case "ADDR2":
			c_add2 = i;
			break;
		case "TOWN":
		case "CITY":
			c_town = i;
			break;
		case "COUNTY":
		case "STATE":
		case "PROVINCE":
			c_state = i;
			break;
		case "COUNTRY":
			c_country = i;
			break;
		case "POSTCODE":
			c_postcode = i;
			break;
		case "EMAIL":
		case "E-MAIL":
		case "E.MAIL":
			c_email = i;
			break;
		case "TEL NO":
		case "TEL":
		case "TELNO":
		case "PHONE":
		case "TELEPHONE":
		case "TEL.":
			c_tel = i;
			break;
		case "NO OF PCS":
		case "ITEM":
		case "ITEMS":
			c_items = i;
			break;
		case "WEIGHT":
			c_weight = i;
			break;
		case "LENGTH":
			c_length = i;
			break;
		case "WIDTH":
			c_width = i;
			break;
		case "HEIGHT":
			c_height = i;
			break;
		case "HV/LV":
		case "LV/HV":
		case "HV/LV/MHV":
			c_val = i;
			break;
		case "DESCRIP":
		case "DESC":
		case "DESCRIPTION":
		case "CONTENT":
		case "CONTENTS":
		case "DESCRIPT":
		case "DESC.":
		case "DESCRIP.":
		case "DESCRIPT.":
			c_content = i;
			break;
		case "VALUE":
			c_value = i;
			break;
		case "CURRENCY":
			c_currency = i;
			break;
		case "COD AMOUNTS":
		case "COD":
		case "COD AMOUNT":
			c_cod = i;
			break;
		case "BAG REF":
		case "BAG REFS":
		case "BAG":
		case "BAGS":
		case "BAG REF1":
		case "BAG REF 1":
			c_bags = i;
			break;
		case "NOTES":
		case "NOTE":
		case "NOTE/HOLD/UNHOLD":
		case "NOTE/HOLD":
			c_note = i;
		case "SENDER":
		case "SENDER ADD":
		case "SENDER ADDRESS":
		case "SENDER ADD.":
		case "SHIPPER":
		case "SHIPPER ADD":
		case "SHIPPER ADDRESS":
		case "SHIPPER ADD.":
			c_shipper = i;
		
		}
	}

	if( c_awb == -1 )
		{
		fh.Close();
		alert("Invalid file format! HAWB column does not exist.");
		return false;
		}
	if( c_content == -1 )
		{
		fh.Close();
		alert("Invalid file format! CONTENT column does not exist.");
		return false;
		}
	if( c_add1 == -1 )
		{
		fh.Close();
		alert("Invalid file format! ADDRESS 1 column does not exist.");
		return false;
		}
	if( c_items == -1 )
		{
		fh.Close();
		alert("Invalid file format! NO OF PCS column does not exist.");
		return false;
		}
	if( c_weight == -1 )
		{
		fh.Close();
		alert("Invalid file format! WEIGTH column does not exist.");
		return false;
		}
	if( c_length == -1 )
		{
		fh.Close();
		alert("Invalid file format! LENGTH column does not exist.");
		return false;
		}
	if( c_width == -1 )
		{
		fh.Close();
		alert("Invalid file format! WIDTH column does not exist.");
		return false;
		}
	if( c_height == -1 )
		{
		fh.Close();
		alert("Invalid file format! HEIGHT column does not exist.");
		return false;
		}
	if( c_val == -1 )
		{
		fh.Close();
		alert("Invalid file format! VALUE CATEGORY column does not exist.");
		return false;
		}
	if( c_tel == -1 )
		{
		fh.Close();
		alert("Invalid file format! PHONE column does not exist.");
		return false;
		}
	if( c_value == -1 )
		{
		fh.Close();
		alert("Invalid file format! VALUE column does not exist.");
		return false;
		}
	if( c_currency == -1 )
		{
		fh.Close();
		alert("Invalid file format! CURRENCY column does not exist.");
		return false;
		}
	
	i = 0;
	k = 0;
	while ( !fh.AtEndOfStream )
		{
		i++;

		str = String(fh.ReadLine());
		readsize = readsize + str.length;

		var recArr = str.split(frmread.delimiter.value);
		if( recArr.length != totalcolumns )
			{
			for( x=0 ; x < totalcolumns ; x++ )
				if( recArr[x] != "" )
					break;
			if( x < recArr.length )
				k++;
			i--;
			}
		else if( recArr[c_awb] == "" || isInteger(recArr[c_awb]) == false || recArr[c_items] == "" || isInteger(recArr[c_items]) == false || recArr[c_weight] == "" || isDecimal(recArr[c_weight]) == false || recArr[c_length] == "" || isInteger(recArr[c_length]) == false || recArr[c_width] == "" || isInteger(recArr[c_width]) == false || recArr[c_height] == "" || isInteger(recArr[c_height]) == false || recArr[c_val] == "" || recArr[c_value] == "" || isDecimal(recArr[c_value]) == false || recArr[c_currency] == "" || (recArr[c_cod] != "" && isDecimal(recArr[c_cod]) == false) || recArr[c_bags] == "" || (recArr[c_bags] != "" && isNumber(recArr[c_bags]) == false) || (recArr[c_currency].toUpperCase() != "USD" && recArr[c_currency].toUpperCase() != "POUND" && recArr[c_currency].toUpperCase() != "EURO") || recArr[c_tel] == "" )
			{
			i--;
			if( recArr[c_awb] != "" || recArr[c_items] != ""  || recArr[c_weight] != "" || recArr[c_length] != "" || recArr[c_width] != "" || recArr[c_height] != "" || recArr[c_val] != "" || recArr[c_value] != "" || recArr[c_currency] != "" || recArr[c_cod] != "" || recArr[c_bags] != "" || recArr[c_tel] != "")
				k++;
			}

		str2write = "Calculating File Size: " + readsize + " / " + totalsize + " Bytes<br />Valid Records: " + i;
		if( k > 0 )
			 str2write = str2write + "<br /><font color=\\\"#FF0000\\\">Invalid Records: " + k;

		document.getElementById('pbar').innerHTML = str2write;
		}

	parent.parent.parent.ChangeHAWB(i);

	fh.Close();

	frm2change.elements['ord_hawbcount'].selectedIndex = i - 1;

	var fh = fso.OpenTextFile(frmread.filename.value, 1, false, 0);
	if( fh == null )
		{
		alert("Cannot open the file!");
		return false;
		}			

	if (!fh.AtEndOfStream)
		fh.SkipLine();

	j = 0;
	k = 0;
	tot_weight = 0;
	log = "";
	mtot = 0;
	tt = 0;
	while ( !fh.AtEndOfStream )
		{
		j++;
		mtot++;

		str = String(fh.ReadLine());

		var recArr = str.split(frmread.delimiter.value);
		if( recArr.length != totalcolumns )
			{
			for( x=0 ; x < totalcolumns ; x++ )
				if( recArr[x] != "" )
					break;
			if( x < recArr.length )
				{
				log = log + "SR#" + (mtot + 1) + ": Column count is not equal to Header [" + recArr.length + "]\\n";
				k++;
				}
			j--;
			}
		else if( recArr[c_awb] == "" || isInteger(recArr[c_awb]) == false || recArr[c_items] == "" || isInteger(recArr[c_items]) == false || recArr[c_weight] == "" || isDecimal(recArr[c_weight]) == false || recArr[c_length] == "" || isInteger(recArr[c_length]) == false || recArr[c_width] == "" || isInteger(recArr[c_width]) == false || recArr[c_height] == "" || isInteger(recArr[c_height]) == false || recArr[c_val] == "" || recArr[c_value] == "" || isDecimal(recArr[c_value]) == false || recArr[c_currency] == "" || (recArr[c_cod] != "" && isDecimal(recArr[c_cod]) == false) || recArr[c_bags] == "" || (recArr[c_bags] != "" && isNumber(recArr[c_bags]) == false) || (recArr[c_currency].toUpperCase() != "USD" && recArr[c_currency].toUpperCase() != "POUND" && recArr[c_currency].toUpperCase() != "EURO") || recArr[c_tel] == "" )
			{
			j--;
			if( recArr[c_awb] != "" || recArr[c_items] != ""  || recArr[c_weight] != "" || recArr[c_length] != "" || recArr[c_width] != "" || recArr[c_height] != "" || recArr[c_val] != "" || recArr[c_value] != "" || recArr[c_currency] != "" || recArr[c_cod] != "" || recArr[c_bags] != "" || recArr[c_tel] != "" )
				{
				k++;
				if( recArr[c_awb] == "" || isInteger(recArr[c_awb]) == false )
					log = log + "SR#" + (mtot + 1) + ": HAWB Invalid [" + recArr[c_awb] + "]\\n";
				else if( recArr[c_items] == "" || isInteger(recArr[c_items]) == false )
					log = log + "SR#" + (mtot + 1) + ": Items Invalid [" + recArr[c_items] + "]\\n";
				else if( recArr[c_weight] == "" || isDecimal(recArr[c_weight]) == false )
					log = log + "SR#" + (mtot + 1) + ": Weight Invalid [" + recArr[c_Weight] + "]\\n";
				else if( recArr[c_length] == "" || isInteger(recArr[c_length]) == false )
					log = log + "SR#" + (mtot + 1) + ": Length Invalid [" + recArr[c_length] + "]\\n";
				else if( recArr[c_width] == "" || isInteger(recArr[c_width]) == false )
					log = log + "SR#" + (mtot + 1) + ": Width Invalid [" + recArr[c_width] + "]\\n";
				else if( recArr[c_height] == "" || isInteger(recArr[c_height]) == false )
					log = log + "SR#" + (mtot + 1) + ": Height Invalid [" + recArr[c_height] + "]\\n";
				else if( recArr[c_val] == ""  )
					log = log + "SR#" + (mtot + 1) + ": Value Category [" + recArr[c_val] + "]\\n";
				else if( recArr[c_value] == "" || isDecimal(recArr[c_value]) == false )
					log = log + "SR#" + (mtot + 1) + ": Value Invalid [" + recArr[c_value] + "]\\n";
				else if( recArr[c_currency] == "" || (recArr[c_currency].toUpperCase() != "USD" && recArr[c_currency].toUpperCase() != "POUND" && recArr[c_currency].toUpperCase() != "EURO") )
					log = log + "SR#" + (mtot + 1) + ": Currency Invalid [" + recArr[c_currency] + "]\\n";
				else if( recArr[c_cod] != "" && isDecimal(recArr[c_cod]) == false )
					log = log + "SR#" + (mtot + 1) + ": COD Amount Invalid [" + recArr[c_cod] + "]\\n";
				else if( recArr[c_bags] == "" || (recArr[c_bags] != "" && isNumber(recArr[c_bags]) == false) )
					log = log + "SR#" + (mtot + 1) + ": Bag Details Ref Invalid [" + recArr[c_cod] + "]\\n";
				else if( recArr[c_tel] == "" )
					log = log + "SR#" + (mtot + 1) + ": Phone Invalid [" + recArr[c_tel] + "]\\n";
				else
					log = log + "SR#" + (mtot + 1) + ": Unknow Error\\n";
				}
			}
		else
			{
			frm2change.elements["hawb["+j+"]"].value = recArr[c_awb];
			frm2change.elements["weight["+j+"]"].value = recArr[c_weight];
			tot_weight = tot_weight + parseFloat(recArr[c_weight]);
			vol_weight = (parseFloat(recArr[c_length]) * parseFloat(recArr[c_width]) * parseFloat(recArr[c_height])) / 4000;
			frm2change.elements["vweight["+j+"]"].value = vol_weight;
			frm2change.elements["length["+j+"]"].value = recArr[c_length];
			frm2change.elements["width["+j+"]"].value = recArr[c_width];
			frm2change.elements["height["+j+"]"].value = recArr[c_height];
			frm2change.elements["item["+j+"]"].value = recArr[c_items];
			if( recArr[c_currency].toUpperCase() == "USD" )
				frm2change.elements["currency["+j+"]"].value = "\$";
			else if( recArr[c_currency].toUpperCase() == "POUND" )
				frm2change.elements["currency["+j+"]"].value = "£";
			else
				frm2change.elements["currency["+j+"]"].value = "€";
			frm2change.elements["value["+j+"]"].value = recArr[c_value];
			
			if( c_cod != -1 && recArr[c_cod] != "" )
				frm2change.elements["cod["+j+"]"].value = recArr[c_cod];
			frm2change.elements["bags["+j+"]"].value = recArr[c_bags];
			
			if( c_note != -1 && recArr[c_note].toUpperCase() == "HOLD" )
				{
				frm2change.elements["hold["+j+"]"].checked = 1;
				recArr[c_note] = "";
				}
			else
				frm2change.elements["hold["+j+"]"].checked = 0;
	
			frm2change.elements["content["+j+"]"].value = recArr[c_content];
			
			if( c_contact != -1 && recArr[c_contact] != "" )
				frm2change.elements["rcontact["+j+"]"].value = recArr[c_contact];
			if( c_company != -1 && recArr[c_company] != "" )
				frm2change.elements["rcompany["+j+"]"].value = recArr[c_company];
			if( c_add1 != -1 && recArr[c_add1] != "" )
				frm2change.elements["radd1["+j+"]"].value = recArr[c_add1];
			if( c_add2 != -1 && recArr[c_add2] != "" )
				frm2change.elements["radd2["+j+"]"].value = recArr[c_add2];
			frm2change.elements["rphone["+j+"]"].value = recArr[c_tel];
			if( c_town != -1 && recArr[c_town] != "" )
				frm2change.elements["rtown["+j+"]"].value = recArr[c_town];
			if( c_state != -1 && recArr[c_state] != "" )
				frm2change.elements["rcounty["+j+"]"].value = recArr[c_state];
			if( c_postcode != -1 && recArr[c_postcode] != "" )
				frm2change.elements["rpcode["+j+"]"].value = recArr[c_postcode];
			if( c_country != -1 && recArr[c_country] != "" )
				{
				var jjj;
				for( jjj = 0 ; jjj < frm2change.elements["rcountry["+j+"]"].length ; jjj++ )
					if( frm2change.elements["rcountry["+j+"]"].options[jjj].text == recArr[c_country] )
						frm2change.elements["rcountry["+j+"]"].selectedIndex = jjj;
				}

			if( c_shipper != -1 && recArr[c_shipper] != "" )
				frm2change.elements["sadd1["+j+"]"].value = recArr[c_shipper];
			if( c_note != -1 && recArr[c_note] != "" )
				frm2change.elements["msg["+j+"]"].value = recArr[c_note];
			else
				frm2change.elements["msg["+j+"]"].value = "";

			document.getElementById('pbar2').innerHTML = "<font color=\\\"#006600\\\">Importing... #" + j + " of " + i + "</font>";
			}
		}

	fh.Close();

	frm2change.elements['ord_totw'].value = tot_weight.toFixed(2);
	frm2change.elements['imported'].value = "1";

	if( k == 0 )
		{
		alert(j + " SR records imported successfully.");
		parent.parent.CloseDPG_importpopup();
		}
	else
		{
		alert(j + " SR records imported successfully, However,\\n" + k + " records were dropped due to invalidity.");
		document.getElementById('pbar3').innerHTML = "Error Log:<br /><textarea style=\\\"width:530px;height:100px;\\\" readonly>" + log + "</textarea><br /><br /><center><input type=\\\"button\\\" value=\\\"Close Window\\\" onClick=\\\"parent.parent.CloseDPG_importpopup()\\\" /></center>";
		}

	return false;
}
	
	</script>
	</head>
	<body>
	<form method="POST" enctype="multipart/form-data" onsubmit="javascript: return Import(this);">
	<input type="hidden" name="cf" value="error" />
	File Name:&nbsp;<input type="file" name="filename" size=55 /><br />
	Delimiter:&nbsp;&nbsp;&nbsp;<input type="text" name="delimiter" MAXLENGTH=1 value="," style="width: 15px;" /><br /><br />
	
	<center>
	<input type="submit" value="Import" size=20/>
	</center>
	</form>
	<div id="pbar" name="pbar">Calculating File Size: ----- / ----- Bytes<br />Valid Records: -----<br /><br /><br /></div>
	<div id="pbar2" name="pbar2"></div><br />
	<div id="pbar3" name="pbar3">Error Log:<br /><textarea style="width:530px;height:100px;" readonly></textarea></div>
	</body>
	</html>
	~;
}

sub import2{
	unless ($filename) {&error_page("Wrong data specified! File Name is invalid."); exit;} 

	my $safe_filename_characters = "a-zA-Z0-9_.-";
	my $upload_dir = $uploadpath; 

	my $q = new CGI; 

	my ( $name, $path, $extension ) = fileparse ( $filename, '\..*' );
	$filename = $name . $extension;
	$filename =~ tr/ /_/;
	$filename =~ s/[^$safe_filename_characters]//g;
	
	if ( $filename =~ /^([$safe_filename_characters]+)$/ )
	{
	 $filename = $1;
	}
	else
	{
		&error_page("Wrong data specified! Filename contains invalid characters."); exit;
	} 

	my $upload_filehandle = $q->upload("filename");
	
	unless( open ( UPLOADFILE, ">$upload_dir/$filename" ))  {&error_page("$! ($upload_dir/$filename)"); exit;}
	binmode UPLOADFILE;
	
	while ( <$upload_filehandle> )
	{
	 print UPLOADFILE;
	}
	
	close UPLOADFILE; 
	
	print $form->header;
	
	print qq|
	<html>
	<head>
	</head>
	<body>
	<center>
	<p><img src="upload/$filename" alt="Photo" /></p> 
	</center>
	</body>
	</html>
	|;
}

sub view{
	unless ($entid) { &error_page("Not valid Delivery and Shipment Ref.!"); exit;}

	updateCargo($entid);
	updateFlight($entid);

	if( $isAdmin )
		{
		$SQL = "SELECT entries.userid AS en_userid, entries.type as en_type, entries.status as en_status,entid,entdate,awb1,awb2,flight,entdate,habwcount,totw,totb,cargolog,flightlog,finalprice,username,sal,fname,lname,company,tel1,tel2,tel3,mob1,mob2,mob3,fax1,fax2,fax3,address,postcode,members.country as country,city,email,website, members.epxcb FROM entries LEFT JOIN members ON entries.userid=members.userid WHERE entries.entid = $entid"; 
		}
	else
		{
		$SQL = "SELECT userid AS en_userid, type as en_type, status as en_status,entid,entdate,awb1,awb2,flight,entdate,habwcount,totw,totb,cargolog,flightlog FROM entries WHERE entries.entid = $entid"; 
		}

	&my_sql;
	if ($column = $sth->fetchrow_hashref){

		unless( $isAdmin || $column->{'en_userid'} == $isUser ) {&error_page("You don't have enough permission for this operation."); exit;}

		&myheader("viewent");
		&topmenu("viewent");

print qq~
<div class="ha8">
				<span class="text1"><font face="Arial" size="2"><b>Delivery and Shipment Info:</b></font></span>
				<br /><br />
				~;

if( $isAdmin )
	{
	print qq|<h1><center><font color="#000080" size="1">
				<a href="$script?cf=entry&estimate=1&entid=$entid&uid=$column->{'en_userid'}" class="noneunderline"><img src="img/content/estimate.gif" width="16" height="16" border="0" alt="Estimate HAWB prices" valign="middle" style="vertical-align: middle;" /></a>&nbsp;&nbsp;<a href="$script?cf=entry&estimate=1&entid=$entid&uid=$column->{'en_userid'}" class="noneunderline">Estimate HAWB prices</a>&nbsp;&nbsp;&nbsp;
				<a href="$script?cf=entry&edit=1&entid=$entid" class="noneunderline"><img src="img/content/edit.png" width="16" height="16" border="0" alt="Edit Delivery and Shipment" valign="middle" style="vertical-align: middle;" /></a>&nbsp;&nbsp;<a href="$script?cf=entry&edit=1&entid=$entid" class="noneunderline">Edit D&amp;S</a>&nbsp;&nbsp;&nbsp;
				<a href="javascript:void(0);" class="noneunderline" onClick="javascript:window.open('$script?cf=entry&printit=1&entid=$entid','printorder','width=' + (screen.width - 40) + ',height=' + (screen.height - 100) + ',top=20,left=10,scrollbars=yes,toolbar=no,status=no,menubar=yes,resizable=no,location=no')"><img src="img/content/print.jpg" width="16" height="16" border="0" alt="Print Delivery and Shipment" valign="middle" style="vertical-align: middle;" /></a>&nbsp;&nbsp;<a href="javascript:void(0);" class="noneunderline" onClick="javascript:window.open('$script?cf=entry&printit=1&entid=$entid','printorder','width=' + (screen.width - 40) + ',height=' + (screen.height - 100) + ',top=20,left=10,scrollbars=yes,toolbar=no,status=no,menubar=yes,resizable=no,location=no')">Print D&amp;S</a>&nbsp;&nbsp;&nbsp;
				<a href="$script?cf=entry&csv=DPD&entid=$entid&uid=$column->{'en_userid'}" class="noneunderline"><img src="img/content/csv.gif" width="16" height="16" border="0" alt="Create CSV File for DPD" valign="middle" style="vertical-align: middle;" /></a>&nbsp;&nbsp;<a href="$script?cf=entry&csv=DPD&entid=$entid&uid=$column->{'en_userid'}" class="noneunderline">Create CSV File for DPD</a>&nbsp;&nbsp;&nbsp;
				|;
				
		if( $column->{'en_type'} == 1 )
			{
			print qq|<a class="noneunderline" href="$script?cf=entry&priority=2&entid=$entid"><img src="img/content/uparrow.jpg" width="16" height="16" border="0" alt="Make Delivery and Shipment as 'High Priority'" valign="middle" style="vertical-align: middle;" /></a>&nbsp;&nbsp;<a class="noneunderline" href="$script?cf=entry&priority=2&entid=$entid">Make D&amp;S as 'High Priority'</a>&nbsp;&nbsp;&nbsp;|;
			}
		else
			{
			print qq|<a class="noneunderline" href="$script?cf=entry&priority=1&entid=$entid"><img src="img/content/dnarrow.jpg" width="16" height="16" border="0" alt="Make Delivery and Shipment as 'Normal Priority'" valign="middle" style="vertical-align: middle;" /></a>&nbsp;&nbsp;<a class="noneunderline" href="$script?cf=entry&priority=1&entid=$entid">Make D&amp;S as 'Normal Priority'</a>&nbsp;&nbsp;&nbsp;|;
			}
				
				print qq|
				<a href="$script?cf=entry&delete=1&entid=$entid" class="noneunderline" onclick="javascript:return confirm('Are you sure you want to delete this Delivery and Shipment?')"><img src="img/content/delete.jpg" width="16" height="16" border="0" alt="Delete Delivery and Shipment" valign="middle" style="vertical-align: middle;" /></a>&nbsp;&nbsp;<a href="$script?cf=entry&delete=1&entid=$entid" class="noneunderline" onclick="javascript:return confirm('Are you sure you want to delete this Delivery and Shipment?')">Delete D&amp;S</a>

	</font></center></h1>|;
	}
else
	{
	print qq|<h1><center><font color="#000080" size="1">
	<a href="$script?cf=entry&edit=1&entid=$entid" class="noneunderline"><img src="img/content/edit.png" width="16" height="16" border="0" alt="Edit Delivery and Shipment" valign="middle" style="vertical-align: middle;" /></a>&nbsp;&nbsp;<a href="$script?cf=entry&edit=1&entid=$entid" class="noneunderline">Edit D&amp;S</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="javascript:void(0);" class="noneunderline" onClick="javascript:window.open('$script?cf=entry&printit=1&entid=$entid','printorder','width=' + (screen.width - 40) + ',height=' + (screen.height - 100) + ',top=20,left=10,scrollbars=yes,toolbar=no,status=no,menubar=yes,resizable=no,location=no')"><img src="img/content/print.jpg" width="16" height="16" border="0" alt="Print Delivery and Shipment" valign="middle" style="vertical-align: middle;" /></a>&nbsp;&nbsp;<a href="javascript:void(0);" class="noneunderline" onClick="javascript:window.open('$script?cf=entry&printit=1&entid=$entid','printorder','width=' + (screen.width - 40) + ',height=' + (screen.height - 100) + ',top=20,left=10,scrollbars=yes,toolbar=no,status=no,menubar=yes,resizable=no,location=no')">Print D&amp;S</a></font></center></h1>|;
	}

print qq|
<font size="2" face="Arial">
	<table style="width: 100%" align="left" border="1" cellpadding="2" cellspacing="0">|;
	
if( $isAdmin )
{
print qq|
		<tr>
			<td style="background-color:#FDF3D0"><center><big><b>Agent Details</b></big></center></td>
		</tr>
		<tr>
			<td align="left">
		<table style="width: 100%" align="left" border="0">
		<tr>
			<td style="width: 20%">Username:</td>
			<td style="width: 80%"><b><a href="$scripturl?cf=members&view=1&memid=$column->{'en_userid'}">$column->{'username'}</a></b></td>
		</tr>
		<tr>
			<td style="width: 20%">Name:</td>
			<td style="width: 80%">$column->{'sal'} $column->{'fname'} $column->{'lname'}</td>
		</tr>
		<tr>
			<td style="width: 20%">Company:</td>
			<td style="width: 80%">$column->{'company'}</td>
		</tr>
		<tr>
			<td style="width: 20%">Land Phone:</td>
			<td style="width: 80%">+$column->{'tel1'}($column->{'tel2'})$column->{'tel3'}</td>
		</tr>
		<tr>
			<td style="width: 20%">Cell Phone:</td>
			<td style="width: 80%">+$column->{'mob1'}($column->{'mob2'})$column->{'mob3'}</td>
		</tr>
		<tr>
			<td style="width: 20%">Fax:</td>
			<td style="width: 80%">+$column->{'fax1'}($column->{'fax2'})$column->{'fax3'}</td>
		</tr>
		<tr>
			<td style="width: 20%">Address:</td>
			<td style="width: 80%">$column->{'address'}</td>
		</tr>
		<tr>
			<td style="width: 20%">Post Code:</td>
			<td style="width: 80%">$column->{'postcode'}</td>
		</tr>
		<tr>
			<td style="width: 20%">Country:</td>
			<td style="width: 80%">|;
			
			print get_country($column->{'country'});
			
			print qq|</td>
		</tr>
		<tr>
			<td style="width: 20%">City:</td>
			<td style="width: 80%">$column->{'city'}</td>
		</tr>
		<tr>
			<td style="width: 20%">Email:</td>
			<td style="width: 80%"><a href="mailto:$column->{'email'}">$column->{'email'}</a></td>
		</tr>
		<tr>
			<td style="width: 20%">Website:</td>
			<td style="width: 80%"><a href="$column->{'website'}" target=_BLANK>$column->{'website'}</a></td>
		</tr>
	</table>
	</td>
	</tr>
	|;
}
	
	print qq|
		<tr>
			<td style="background-color:#FDF3D0"><center><big><b>Delivery and Shipment Specification</b></big></center></td>
		</tr>
		<tr>
			<td align="left">
			<table width="100%" border="0">
			<tr>
			<td width="200">
			<b>Delivery and Shipment Ref.:</b> $column->{'entid'}<br />
			<b>Date:</b> $column->{'entdate'}<br />
			<b>MAWB:</b> $column->{'awb1'}&nbsp;$column->{'awb2'}<br />
			<b>Flight No.:</b> $column->{'flight'}<br />|;
			
if( $isAdmin )
	{			
			print "<br /><b>Type:</b> ";
			
			if( $column->{'en_type'} == 2 )
				{
				print "<font color=\"#FF0000\">High Priority</font>";
				}
			else
				{
				print "Normal Priority";
				}
	}
			print "<br /><b>Status:</b> ";

			if( $column->{'en_status'} == 9 )
				{
				print "Canceled<br />";
				}
			elsif( $column->{'en_status'} == 3 )
				{
				print "Done<br />";
				}
			elsif( $column->{'en_status'} == 2 )
				{
				print "Processing...<br />";
				}
			else
				{
				print "<font color=\"#FF0000\">Not Processed</font><br />";
				}

print qq|
		</td>
		<td>
		<div style="float: left;" align="left">
		$column->{'cargolog'}
		</div>
		<br />
		<div style="float: left;" align="left">
		$column->{'flightlog'}
		</div>
		</td>
		</tr>
		</table>
		</td>
		</tr>
		<tr>
			<td style="background-color:#FDF3D0"><center><big><b>Delivery and Shipment Details</b></big></center></td>
		</tr>
		<tr>
			<td align="left">
			<b>No of HAWB:</b> $column->{'habwcount'}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Total Weight:</b> $column->{'totw'}&nbsp;<small>(kg)</small>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Total Bags:</b> $column->{'totb'}|;
			
			print qq|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Estimated Price:</b> £ $column->{'finalprice'}| if( $isAdmin );
			
			print qq|
			<br />
			<br />
			<table width="100%" align="left" border="0" class="nofrm">
			<tr>
			<th width="30" align="left">SR#</th>
			<th width="90" align="left">HAWB</th>
			<th width="90" align="left">Value</th>
			<th width="50" align="left">No. of Bags</th>
			<th width="60" align="left">Bag Ref.</th>
			<th width="90" align="left">Weight <small>(kg)</small></th>
			<th width="90" align="left">Vol. Weight <center><small>(kg)</small></center></th>
			<th width="120" align="left">Size <small>(cm)</small></th>
			<th width="190" align="left">Shipper</th>
			<th width="190" align="left">Receiver</th>
			</tr>	
			|;

			$SQL2 = "SELECT entdetails.sr, entdetails.hawb, entdetails.item, entdetails.value, entdetails.lvhv, entdetails.hold, entdetails.cod, entdetails.content, entdetails.currency, entdetails.scontact, entdetails.scompany, entdetails.semail, entdetails.sadd1, entdetails.sadd2, entdetails.sphone, entdetails.stown, entdetails.scounty, entdetails.spcode, sc.country as scountry, entdetails.rcontact, entdetails.rcompany, entdetails.remail, entdetails.radd1, entdetails.radd2, entdetails.rphone, entdetails.rtown, entdetails.rcounty, entdetails.rpcode, rc.country as rcountry, entdetails.carrier, entdetails.reference, sum(messages.mread) as messsum, count(messages.mread) as messcount, services.service as estcar, estprice, endprice, ispaid, csved, cb_pervalue, cb_fixcharge, cb_cardcharge, cb_agentshare, cb_cbafter FROM entdetails LEFT JOIN messages ON entdetails.entid=messages.entryid and entdetails.sr=messages.srid and messages.mto=$isUser LEFT JOIN countries AS sc ON sc.id=entdetails.scountry LEFT JOIN countries AS rc ON rc.id=entdetails.rcountry LEFT JOIN services on services.id=entdetails.estcar WHERE entdetails.entid = $entid GROUP BY entdetails.sr, entdetails.hawb, entdetails.item, entdetails.value, entdetails.lvhv, entdetails.hold, entdetails.cod, entdetails.content, entdetails.currency, entdetails.scontact, entdetails.scompany, entdetails.semail, entdetails.sadd1, entdetails.sadd2, entdetails.sphone, entdetails.stown, entdetails.scounty, entdetails.spcode, scountry, entdetails.rcontact, entdetails.rcompany, entdetails.remail, entdetails.radd1, entdetails.radd2, entdetails.rphone, entdetails.rtown, entdetails.rcounty, entdetails.rpcode, rcountry, entdetails.carrier, entdetails.reference, estcar, estprice, endprice, ispaid, csved, cb_agentshare, cb_cbafter ORDER BY sr"; 

			&my_sql2;
			$i = 0;
			
			while ($column2 = $sth2->fetchrow_hashref)
				{
				$i++;

				($carabr, $carname, $srvname) = get_carrier($column2->{'carrier'});
					
				print "<tr height=\"10\">\n";
				print qq|<td colspan="10" height="10">
<div style="width:97%; float:left;"><hr width="100%" size="1" noshade /></div><div style="width:3%; float:right;">&nbsp;
			<a href="javascript:void(0);" class="noneunderline" onClick="javascript:window.open('$script?cf=entry&printawb=1&entid=$entid&srid=$column2->{'sr'}','printawb','width=' + (screen.width - 40) + ',height=520,top=20,left=10,scrollbars=yes,toolbar=no,status=no,menubar=yes,resizable=no,location=no')"><img src="img/content/print.jpg" width="16" height="16" border="0" alt="Print HAWB" valign="middle" style="vertical-align: middle;" /></a>
			</div>
							
				</td>|;

				
				print "</tr>\n<tr>\n";
				print "<td align=\"left\">$column2->{'sr'}</td>";
				print "<td align=\"left\">$column2->{'hawb'}</td>";
				print "<td align=\"left\">$column2->{'currency'} $column2->{'value'}</td>";
				print "<td align=\"left\">$column2->{'item'}</td>";
				
				$TSQL = "SELECT * FROM bags WHERE entid = $entid AND srid=$column2->{'sr'} ORDER BY bagid"; 
				&tmy_sql;
				$tmp_bag = "";
				$tmp_weight = "";
				$tmp_vweight = "";
				$tmp_size = "";
				while ($tcolumn = $tsth->fetchrow_hashref)
					{
					$volweight = toCurr(($tcolumn->{'length'} * $tcolumn->{'width'} * $tcolumn->{'height'}) / 4000);
					$tmp_bag = $tmp_bag . $tcolumn->{'bag'} . "<br />";
					$tmp_weight = $tmp_weight . $tcolumn->{'weight'} . "<br />";
					$tmp_vweight = $tmp_vweight . $volweight . "<br />";
					$tmp_size = $tmp_size . "$tcolumn->{'length'} x $tcolumn->{'width'} x $tcolumn->{'height'}<br />";
					}
				$tsth->finish;

				print "<td align=\"left\">$tmp_bag</td>";
				print "<td align=\"left\">$tmp_weight</td>";
				print "<td align=\"left\">$tmp_vweight</td>";
				print "<td align=\"left\">$tmp_size</td>";
				
				print "<td rowspan=\"2\" align=\"left\"><textarea style=\"width:180px;height:40px;\" readonly>";
				
				if( $column2->{'scontact'} || $column2->{'scompany'} || $column2->{'semail'} ||$column2->{'sadd1'} || $column2->{'sadd2'} || $column2->{'sphone'} || $column2->{'stown'} || $column2->{'scounty'} || $column2->{'spcode'} || $column2->{'scountry'} )
					{
					if ($column2->{'scontact'})
						{
						print qq|$column2->{'scontact'} |;
						}

					if ($column2->{'scompany'})
						{
						print qq|$column2->{'scompany'} |;
						}

					if ($column2->{'sphone'})
						{
						print qq|$column2->{'sphone'} |;
						}

					if ($column2->{'semail'})
						{
						print qq|$column2->{'semail'} |;
						}

					if ($column2->{'sadd1'})
						{
						print qq|$column2->{'sadd1'} |;
						}
	
					if ($column2->{'sadd2'})
						{
						print qq|$column2->{'sadd2'} |; 
						}

					if ($column2->{'stown'})
						{
						print qq|$column2->{'stown'} |;
						}

					if ($column2->{'scounty'})
						{
						print qq|$column2->{'scounty'} |;
						}

					if( $column2->{'spcode'} )
						{
						print qq|$column2->{'spcode'} |;
						}

					if ($column2->{'scountry'})
						{
						print qq|$column2->{'scountry'}|;
						}
					}
				else
					{
						print "&nbsp;";
					}	
				
				print "</textarea></td>\n";
				print "<td rowspan=\"2\" align=\"left\"><textarea style=\"width:180px;height:40px;\" readonly>";

				if( $column2->{'rcontact'} || $column2->{'rcompany'} || $column2->{'remail'} || $column2->{'radd1'} || $column2->{'radd2'} || $column2->{'rphone'} || $column2->{'rtown'} || $column2->{'rcounty'} || $column2->{'rpcode'} || $column2->{'rcountry'} )
					{
					if ($column2->{'rcontact'})
						{
						print qq|$column2->{'rcontact'} |;
						}

					if ($column2->{'rcompany'})
						{
						print qq|$column2->{'rcompany'} |;
						}

					if ($column2->{'rphone'})
						{
						print qq|$column2->{'rphone'} |;
						}

					if ($column2->{'remail'})
						{
						print qq|$column2->{'remail'} |;
						}

					if ($column2->{'radd1'})
						{
						print qq|$column2->{'radd1'} |;
						}
	
					if ($column2->{'radd2'})
						{
						print qq|$column2->{'radd2'} |; 
						}

					if ($column2->{'rtown'})
						{
						print qq|$column2->{'rtown'} |;
						}

					if ($column2->{'rcounty'})
						{
						print qq|$column2->{'rcounty'} |;
						}

					if( $column2->{'rpcode'} )
						{
						print qq|$column2->{'rpcode'} |;
						}

					if ($column2->{'rcountry'})
						{
						print qq|$column2->{'rcountry'}|;
						}
					}
				else
					{
						print "&nbsp;";
					}	

				print "</textarea></td>\n";
				print "</tr>\n";
				print "<tr><td colspan=\"8\" style=\"padding:3px;\">";

				if( $column2->{'hold'} )
					{
					print qq|<div id="divhold$i" style="float: left;"><font color="#FF0000"><a href="javascript:void(0);" onclick="return HoldAwb($entid, $isUser, $i, 1);" class="linkred"><span style="padding:2px; border-style: solid; border-width:1px; border-color:#FF0000;"><b>HOLD</b></span></a>&nbsp;&nbsp;&nbsp;&nbsp;</font></div>|;
					}
				else
					{
					print qq|<div id="divhold$i" style="float: left;"><font color="#969696"><a href="javascript:void(0);" onclick="return HoldAwb($entid, $isUser, $i, 2);" class="linkgray"><span style="padding:2px; border-style: solid; border-width:1px; border-color:#969696;">Unhold</span></a>&nbsp;&nbsp;&nbsp;</font></div>|;
					}

				if( $column2->{'lvhv'} == 1 )
					{
					print qq|<span style="padding:2px; border-style: double; border-left-width:0px; border-right-width:0px; border-top-width:0px; border-bottom-width:3px;"><b>LV</b></span>&nbsp;&nbsp;&nbsp;|;
					}
				elsif( $column2->{'lvhv'} == 2 )
					{
					print qq|<span style="padding:2px; border-style: double; border-left-width:0px; border-right-width:0px; border-top-width:0px; border-bottom-width:3px;"><b>HV</b></span>&nbsp;&nbsp;&nbsp;|;
					}
				elsif( $column2->{'lvhv'} == 3 )
					{
					print qq|<span style="padding:2px; border-style: double; border-left-width:0px; border-right-width:0px; border-top-width:0px; border-bottom-width:3px;"><b>MHV</b></span>&nbsp;&nbsp;&nbsp;|;
					}
				elsif( $column2->{'lvhv'} == 4 )
					{
					print qq|<span style="padding:2px; border-style: double; border-left-width:0px; border-right-width:0px; border-top-width:0px; border-bottom-width:3px;"><b>PE</b></span>&nbsp;&nbsp;&nbsp;|;
					}
		
				if( $column2->{'cod'} && $column2->{'cod'} != 0.0 )
					{
					print "COD Amount: <font color=\"#FF0000\"><b>£ $column2->{'cod'}</b></font>";
					}

				print "</td></tr>";
				print "<tr>\n";
				
				print "<td align=\"left\" colspan=\"10\">\n";
				print "<div style=\"float: left;\">";
				print "<a href=\"javascript:void(0);\" onClick=\"window.open('$script?cf=message&userid=$isUser&entuser=$column->{'en_userid'}&entid=$entid&srid=$column2->{'sr'}','Messages','width=' + (screen.width - 40) + ',height=' + (screen.height - 100) + ',top=20,left=10,scrollbars=yes,toolbar=no,status=no,menubar=yes,resizable=no,location=no')\">";
				if( $column2->{'messcount'} )
					{
					if( $column2->{'messsum'} && $column2->{'messsum'} == $column2->{'messcount'})
						{
						print "<img src=\"img/content/mess.gif\" border=\"0\" width=\"22\" height=\"16\" style=\"float: left;\" /><a/>&nbsp;&nbsp;Content:&nbsp;$column2->{'content'}\n";
						}
					else
						{
						print "<img src=\"img/content/messnew.gif\" border=\"0\" width=\"22\" height=\"16\" style=\"float: left;\" /></a>&nbsp;&nbsp;Content:&nbsp;$column2->{'content'}\n";
						}
					}
				else
					{
					print "<img src=\"img/content/messno.gif\" border=\"0\" width=\"22\" height=\"16\" style=\"float: left;\" /></a>&nbsp;&nbsp;Content:&nbsp;$column2->{'content'}\n";
					}

				print "</div>";

			if( $isAdmin )
				{			
				if( $column2->{'endprice'} && $column2->{'endprice'} != 0 )
					{
					print "<div style=\"float: right;\">";
					print "&nbsp;&nbsp;&nbsp;&nbsp;Carrier: $column2->{'estcar'}";
					print "&nbsp;&nbsp;&nbsp;&nbsp;Final Price: £ $column2->{'endprice'}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
					print "</div>";
					}
				else
					{
					if( $column2->{'estcar'} )
						{
						print "<div style=\"float: right;\">";
						print "&nbsp;&nbsp;&nbsp;&nbsp;Prefered Carrier: $column2->{'estcar'}";
						print "&nbsp;&nbsp;&nbsp;&nbsp;Estimated Price: £ $column2->{'estprice'}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
						print "</div>";
						}
					}
	
				print "<br />";
				print "\n<form class=\"nofrm\" style=\"background-color:#FFFFFF;\"><div style=\"height:20; float: left; vertical-align: middle;\"><input type=\"hidden\" name=\"upid\" value=\"$column->{'en_userid'}\" /><input type=\"hidden\" name=\"entid\" value=\"$entid\" /><input type=\"hidden\" name=\"uid\" value=\"$isAdmin\" /><input type=\"hidden\" name=\"srid\" value=\"$i\" />\n";
				print qq|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Carrier:&nbsp;<select name="carrier" style="width:200px; height:20px; vertical-align: middle;" onChange="return CheckService(this.form);">
				<option value="" |;
				print qq|selected| unless( $column2->{'carrier'} );
				print "></option>\n";

				
				$TSQL = "SELECT services.service as servicename, services.id as serviceid from services WHERE active=1 UNION SELECT carriers.name as servicename, carriers.id as serviceid from carriers WHERE hasservice=0 ORDER BY serviceid"; 
	
				&tmy_sql;
				
				while ($tcolumn = $tsth->fetchrow_hashref)
					{
					print qq|<option value="$tcolumn->{'serviceid'}" |;
					if( $column2->{'carrier'} eq $tcolumn->{'serviceid'} )
						{
						print qq|selected|;
						}
					print ">$tcolumn->{'servicename'}</option>";
					}
				
				$tsth->finish;	
				print "</select></div>";
				print qq|<div style="vertical-align: middle; padding:3px; float: left;" id="checkservice$column2->{'sr'}">&nbsp;&nbsp;&nbsp;&nbsp;</div>|;
				print "<div style=\"float: left;\">&nbsp;&nbsp;Tracking No.:&nbsp;<font size=\"2\"><input style=\"width:70px;height:18px; vertical-align: middle;";
				if( $column2->{'carrier'} )
					{
					print " background-color:#CCFFCC;\" MAXLENGTH=20 name=\"ref\" value=\"$column2->{'reference'}\" type=\"text\" onkeydown=\"changecolor(this)\" /></font>&nbsp;&nbsp;&nbsp;&nbsp;Price:&nbsp;£&nbsp;";
					print "<input style=\"width:60px;height:18px; vertical-align: middle;\" name=\"realprice\" value=\"$column2->{'endprice'}\" type=\"text\" onkeydown=\"changecolor(this)\" />&nbsp;&nbsp;&nbsp;\n";
					}
				else
					{
					print "\" MAXLENGTH=20 name=\"ref\" value=\"$column2->{'reference'}\" type=\"text\" onkeydown=\"changecolor(this)\" /></font>&nbsp;&nbsp;&nbsp;&nbsp;Price:&nbsp;£&nbsp;<input style=\"width:60px;height:18px; vertical-align: middle;\" name=\"realprice\" value=\"$column2->{'endprice'}\" type=\"text\" />\n";
					print "&nbsp;&nbsp;<div style=\"height:20; float: right; vertical-align: middle;\" id=\"trackimage$column2->{'sr'}\"></div>&nbsp;&nbsp;";
					}
					
				if( $column2->{'estcar'} )
					{
					my $val_curred;
					
					if( $column2->{'currency'} eq "£" )
						{
						$val_curred = $column2->{'value'};
						}
					elsif( $column2->{'currency'} eq "\$" )
						{
						$val_curred = $column2->{'value'} * $s_usd;
						}
					elsif( $column2->{'currency'} eq "€" )
						{
						$val_curred = $column2->{'value'} * $s_euro;
						}
					
#					print "[column2 currency: $column2->{'currency'}]";
#					print "[column2 value: $column2->{'value'}]";
#					print "[column2 pervalue: $column2->{'cb_pervalue'}]";
#					print "[column2 fixcharge: $column2->{'cb_fixcharge'}]";
#					print "[column2 cardcharge: $column2->{'cb_cardcharge'}]";
#					print "[s_usd: $s_usd]";
#					print "[val_curred: $val_curred]";
					
					
					my $cod2 = $column2->{'cod'};
#					print "1)[cod2: $cod2]";
					
					$cod2 = $cod2 + (($column2->{'cb_pervalue'} * $val_curred) / 100) + $column2->{'cb_fixcharge'};
#					print "2)[cod2: $cod2]";


					$cod2 =  $cod2 + (($cod2 * $column2->{'cd_cardcharge'}) / 100);
#					print "3)[cod2: $cod2]";
					$cod2 = toCurr($cod2);
#					print "4)[cod2: $cod2]";

#					print "[2cod2: $cod2]";
					
					if( $cod2 )
						{
						if( $column2->{'ispaid'} )
							{
							print qq|<div id="divpay$i" style="float: right; vertical-align: middle;">&nbsp;&nbsp;&nbsp;<font color="#969696"><a href="javascript:void(0);" onclick="return PayStatus($entid, $isAdmin, $i, 1, $column->{'en_userid'}, $column2->{'lvhv'}, $cod2, $column2->{'cb_agentshare'}, $column2->{'cb_cbafter'}, $column2->{'hawb'}, $column->{'epxcb'});" class="linkgray"><span style="position:relative; top: 3px;padding:2px; border-style: solid; border-width:1px; border-colr:#969696;">Amount: £ $cod2 (Paid) </span></a>&nbsp;&nbsp;&nbsp;</font></div>|;
							}
						else
							{
							print qq|<div id="divpay$i" style="float: right; vertical-align: middle;">&nbsp;&nbsp;&nbsp;<font color="#FF0000"><a href="javascript:void(0);" onclick="return PayStatus($entid, $isAdmin, $i, 2, $column->{'en_userid'}, $column2->{'lvhv'}, $cod2, $column2->{'cb_agentshare'}, $column2->{'cb_cbafter'}, $column2->{'hawb'}, $column->{'epxcb'});" class="linkred"><span style="position:relative; top: 3px;padding:2px; border-style: solid; border-width:1px; border-colr:#FF0000;"><b>Amount: £ $cod2 (Unpaid) </b></span></a>&nbsp;&nbsp;&nbsp;</font></div>|;
							}
						}
					}

				if( $column2->{'carrier'} )
					{
					if( $carabr eq "DHL" )
						{
						print "<div style=\"height:20; float: right; vertical-align: middle;\" id=\"trackimage$column2->{'sr'}\"><a href=\"$script?cf=track&track=2&dhl=$column2->{'reference'}\" target=_BLANK><img src=\"img/content/track.gif\" width=\"37\" height=\"28\" border=\"0\" alt=\"Track It!\" /></a></div>&nbsp;&nbsp;";
						}
					elsif( $carabr eq "DPD" )
						{
						print "<div style=\"height:20; float: right; vertical-align: middle;\" id=\"trackimage$column2->{'sr'}\"><a href=\"$script?cf=track&track=2&dpd=$column2->{'reference'}\" target=_BLANK><img src=\"img/content/track.gif\" width=\"37\" height=\"28\" border=\"0\" alt=\"Track It!\" /></a></div>&nbsp;&nbsp;";
						}
					else
						{
						print "<div style=\"height:20; float: right; vertical-align: middle;\" id=\"trackimage$column2->{'sr'}\"></div>&nbsp;&nbsp;";
						}
					}
					
				print "</div>\n";
				
				if( $column2->{'csved'} ne "" )
					{
					if( $column2->{'csved'} eq "H" )
						{
						print qq|<div id="divcsv$i" style="float: right; vertical-align: middle;"><font color="#969696"><span style="position:relative; top: 3px; padding:2px; border-style: solid; border-width:1px; border-colr:#969696;">  Exported to DHL</span></font></div>|;
						}
					elsif( $column2->{'csved'} eq "P" )
						{
						print qq|<div id="divcsv$i" style="float: right; vertical-align: middle;"><font color="#969696"><span style="position:relative; top: 3px; padding:2px; border-style: solid; border-width:1px; border-colr:#969696;">  Exported to DPD</span></font></div>|;
						}
					elsif( $column2->{'csved'} eq "A" )
						{
						print qq|<div id="divcsv$i" style="float: right; vertical-align: middle;"><font color="#969696"><a href="javascript:void(0);" onclick="return CsvStatus($entid, $isAdmin, $i, 1);" class="linkgray"><span style="position:relative; top: 3px;padding:2px; border-style: solid; border-width:1px; border-colr:#969696;">  NOT EXPORTABLE </span></a></font></div>|;
						}
					}
				else
					{
					print qq|<div id="divcsv$i" style="float: right; vertical-align: middle;"><font color="#FF0000"><a href="javascript:void(0);" onclick="return CsvStatus($entid, $isAdmin, $i, 2);" class="linkgray"><span style="position:relative; top: 3px;padding:2px; border-style: solid; border-width:1px; border-colr:#969696;"><b> Exportable </b></span></a></font></div>|;
					}
				
				print "</form></td>\n</tr>\n";
				}
			else
				{			
				if( $column2->{'carrier'} )
					{
					print "<div style=\"height:20; float: left; vertical-align: middle;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Carrier:&nbsp;$srvname\n&nbsp;&nbsp;&nbsp;&nbsp;Tracking No.:&nbsp;$column2->{'reference'}&nbsp;&nbsp;";
					if( $carabr eq "DHL" )
						{
						print "<a href=\"$script?cf=track&track=2&dhl=$column2->{'reference'}\" target=_BLANK><img src=\"img/content/track.gif\" width=\"37\" height=\"28\" border=\"0\" alt=\"Track It!\" /></a></div>\n";
						}
					elsif( $carabr eq "DPD" )
						{
						print "<a href=\"$script?cf=track&track=2&dpd=$column2->{'reference'}\" target=_BLANK><img src=\"img/content/track.gif\" width=\"37\" height=\"28\" border=\"0\" alt=\"Track It!\" /></a></div>\n";
						}
					}
				else
					{
					print "<div style=\"height:20; float: left; vertical-align: middle;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>\n";
					}
				}
			
				}
			$sth2->finish;
				
			print qq|
			</table>
			</td>
		</tr>

	</table>
</font>
<br />
</div>

|;

&footer;

		$sth->finish;
	}
	else
		{
			$sth->finish;
			error_page("Delivery and Shipment not found!");
		}
}

sub estimate
{
	unless ($entid) { &error_page("Not valid Delivery and Shipment Ref.!"); exit;}
	unless ($uid) { &error_page("Not valid User Ref.!"); exit;}

	require "/home/europost/public_html/book.pl";

#	$SQL2 = "UPDATE entdetails SET estprice=0, cb_pervalue=0, cb_fixcharge=0, cb_cardcharge=0, cb_agentshare=0, cb_cbafter=0 WHERE entid=$entid and sr=$columns->{'sr'}";
#	&my_sql2;
#	$sth2->finish;

	$SQLS = "SELECT * from entdetails LEFT JOIN bags ON entdetails.entid=bags.entid AND entdetails.sr=bags.srid WHERE entdetails.entid=$entid and entdetails.endprice=0 and entdetails.ispaid=0 and entdetails.csved ='' order by sr, bagid"; 
	&my_sqls;
	
	$lastsr = "";
	$lastlvhv = "";
	$srv2do = "0";

#	print "Content-type: text/plain\n\n"; 
	
	my $sr_price = 0;
	my $sr_weight = 0;
	my ($pervalue, $fixcharge, $cardcharge, $wv, $agentshare, $cbfter);

	while ($columns = $sths->fetchrow_hashref)
		{
#		print "<!--entid:$entid-sr:$columns->{'sr'}-->\n";

		@total_price = ();

		if( $lastsr && $lastsr ne $columns->{'sr'} )
			{
			$SQL2 = "SELECT epxcb FROM members WHERE userid=$uid";
			&my_sql2;
			$column2 = $sth2->fetchrow_hashref;
			$epxcbstatus = $column2->{'epxcb'};
			$sth2->finish;
	
			if( $epxcbstatus )
				{
				if( $lastlvhv eq "1" )
					{
					$vvv = "l";
					}
				elsif( $lastlvhv eq "3" )
					{
					$vvv = "m";
					}
				else
					{
					$vvv = "";
					}
	
				if( $vvv )
					{
					$SQL2 = "SELECT * FROM cashback WHERE userid=$uid AND lvmv='$vvv' AND fromkg <= $sr_weight AND tokg >= $sr_weight";
					&my_sql2;
					if( $column2 = $sth2->fetchrow_hashref )
						{
						$pervalue = $column2->{'pervalue'};
						$fixcharge = $column2->{'fixcharge'};
						$cardcharge = $column2->{'cardcharge'};
						$agentshare = $column2->{'agentshare'};
						$cbafter = $column2->{'cbafter'};
						}
					else
						{
						$pervalue = '0';
						$fixcharge = '0';
						$cardcharge = '0';
						$agentshare = '0';
						$cbafter = '0';
						}
					$sth2->finish;
					}
				else
					{
					$pervalue = '0';
					$fixcharge = '0';
					$cardcharge = '0';
					$agentshare = '0';
					$cbafter = '0';
					}
				}
			else
				{
				$pervalue = '0';
				$fixcharge = '0';
				$cardcharge = '0';
				$agentshare = '0';
				$cbafter = '0';
				}

			$SQL2 = "UPDATE entdetails SET estcar=$srv2do, estprice='$sr_price', cb_pervalue=$pervalue, cb_fixcharge=$fixcharge, cb_cardcharge=$cardcharge, cb_agentshare=$agentshare, cb_cbafter=$cbafter WHERE entid=$entid and sr=$lastsr";
#			print "<!--SQL: $SQL2-->\n";
			&my_sql2;
			$sth2->finish;
			$sr_price = 0;
			$sr_weight = 0;
			$srv2do = "0";
			}

		if( $columns->{'scountry'} && $columns->{'rcountry'} && $columns->{'weight'} && $columns->{'length'} && $columns->{'width'} && $columns->{'height'} )
			{
			&get_price("221", "NA1", "", $columns->{'rcountry'}, "$columns->{'rpcode'}", "$columns->{'rtown'}", $columns->{'weight'}, $columns->{'length'}, $columns->{'width'}, $columns->{'height'}, "0", -1, 0, $uid, $srv2do, $columns->{'scountry'}, "0");

#			print qq~<!--get price "221", "NA1", "", $columns->{'rcountry'}, $columns->{'rpcode'}, $columns->{'rtown'}, $columns->{'weight'}, $columns->{'length'}, $columns->{'width'}, $columns->{'height'}, "0", -1, 0, $uid, $srv2do-->~;
	
			@total_price = sort { ($a->{'priority'}) <=> ($b->{'priority'}) } @total_price;
			}

		$srv2do = $total_price[0]->{'servid'};

		$wv = toCurr(($columns->{'length'} * $columns->{'width'} * $columns->{'height'}) / 4000);
		$wv = ($columns->{'weight'} + 1 - 1) if( ($columns->{'weight'} + 1 - 1) > $wv );
		
		$sr_weight = $sr_weight + $wv;
	
#		print "<!--pervalue:$pervalue-fixcharge:$fixcharge-cardcharge:$cardcharge-agentshare:$agentshare-cbafter:$cbafter-->\n";

		if( $#total_price >= 0 )
			{
#			print "<!--price:$total_price[0]->{'price'}-totalfuel:$total_price[0]->{'totalfuel'}-totalremote:$total_price[0]->{'totalremote'}-totalcust:$total_price[0]->{'totalcust'}-totalvat:$total_price[0]->{'totalvat'}-->\n";

			$sr_price = $sr_price + toCurr($total_price[0]->{'price'}+$total_price[0]->{'totalfuel'}+$total_price[0]->{'totalremote'}+$total_price[0]->{'totalcust'}+$total_price[0]->{'totalvat'});
			}

		$lastlvhv = $columns->{'lvhv'};
		$lastsr = $columns->{'sr'};
		}
		
	if( $srv2do )
		{
		$SQL2 = "SELECT epxcb FROM members WHERE userid=$uid";
		&my_sql2;
		$column2 = $sth2->fetchrow_hashref;
		$epxcbstatus = $column2->{'epxcb'};
		$sth2->finish;

		if( $epxcbstatus )
			{
			if( $lastlvhv eq "1" )
				{
				$vvv = "l";
				}
			elsif( $lastlvhv eq "3" )
				{
				$vvv = "m";
				}
			else
				{
				$vvv = "";
				}

			if( $vvv )
				{
				$SQL2 = "SELECT * FROM cashback WHERE userid=$uid AND lvmv='$vvv' AND fromkg <= $sr_weight AND tokg >= $sr_weight";
				&my_sql2;
				if( $column2 = $sth2->fetchrow_hashref )
					{
					$pervalue = $column2->{'pervalue'};
					$fixcharge = $column2->{'fixcharge'};
					$cardcharge = $column2->{'cardcharge'};
					$agentshare = $column2->{'agentshare'};
					$cbafter = $column2->{'cbafter'};
					}
				else
					{
					$pervalue = '0';
					$fixcharge = '0';
					$cardcharge = '0';
					$agentshare = '0';
					$cbafter = '0';
					}
				$sth2->finish;
				}
			else
				{
				$pervalue = '0';
				$fixcharge = '0';
				$cardcharge = '0';
				$agentshare = '0';
				$cbafter = '0';
				}
			}
		else
			{
			$pervalue = '0';
			$fixcharge = '0';
			$cardcharge = '0';
			$agentshare = '0';
			$cbafter = '0';
			}

		$SQL2 = "UPDATE entdetails SET estcar=$srv2do, estprice='$sr_price', cb_pervalue=$pervalue, cb_fixcharge=$fixcharge, cb_cardcharge=$cardcharge, cb_agentshare=$agentshare, cb_cbafter=$cbafter WHERE entid=$entid and sr=$lastsr";
#		print "<!--SQL OutLoop: $SQL2-->\n";
		&my_sql2;
		$sth2->finish;
		}
	$sths->finish;

	my $final_price = 0;
	$SQL = "SELECT sum(estprice) as estprice from entdetails WHERE entid=$entid and endprice=0"; 
	&my_sql;
	if ($column = $sth->fetchrow_hashref)
		{
		$final_price = $column->{'estprice'};
		}
	$sth->finish;
	$SQL = "SELECT sum(endprice) as estprice from entdetails WHERE entid=$entid and endprice<>0"; 
	&my_sql;
	if ($column = $sth->fetchrow_hashref)
		{
		$final_price = $final_price + $column->{'estprice'};
		}
	$sth->finish;
		
	if( $final_price )
		{
		$SQL2 = "UPDATE entries SET finalprice=$final_price WHERE entid=$entid";
		&my_sql2;
		$sth2->finish;
		}
	
	unless( $noredirect )
		{
		if( $fromlist )
			{
			$redirect ="$script?cf=member&userid=$isUser";
			}
		else
			{
			$redirect="$script?cf=entry&view=1&entid=$entid";
			}
		print $form->redirect(-url=>$redirect);
		}	
}


sub save{
	my ($_carabr, $_carname, $_srvname);
	
	print "Content-type: text/plain\n\n";

	if( $srid < 10 )
		{
		$srpad = "$srid  ";
		}
	else
		{
		if( $srid < 100 )
			{
			$srpad = "$srid ";
			}
		else
			{
			$srpad = "$srid";
			}
		}

	unless ($entid) { print "Not valid Delivery and Shipment Ref.!"; exit;}
	unless ($srid && $srid =~ /^\s*[0-9]{1,3}\s*$/) { print "Not valid SR#!"; exit;} 
	unless( $carrier eq "" && $ref eq "" )
		{
		unless ($carrier =~ /^[0-9]+$/ ) { print "Not valid Carrier!"; exit;} 
		
		($_carabr, $_carname, $_srvname) = get_carrier($carrier);

		if( $_carabr eq "DHL" || $_carabr eq "DPD" )
			{
			unless ($ref && $ref =~ /^\s*[0-9]{8,11}\s*$/) { print "Not valid $_carname Trackning No.!"; exit;} 
			}
		else
			{
			$ref = '' unless( $ref );
			}
		}
		
	if( $eprice )
		{
		$epricestr = ", endprice=$eprice ";
		}
	else
		{
		$epricestr = ", endprice=0 ";
		}

	$SQL = "UPDATE entdetails SET carrier=$carrier, reference='$ref' $epricestr WHERE entid=$entid and sr=$srid";
	&my_sql;
	$sth->finish;


	my $final_price = 0;
	$SQL = "SELECT sum(estprice) as estprice from entdetails WHERE entid=$entid and endprice=0"; 
	&my_sql;
	if ($column = $sth->fetchrow_hashref)
		{
		$final_price = $column->{'estprice'};
		}
	$sth->finish;
	$SQL = "SELECT sum(endprice) as estprice from entdetails WHERE entid=$entid and endprice<>0"; 
	&my_sql;
	if ($column = $sth->fetchrow_hashref)
		{
		$final_price = $final_price + $column->{'estprice'};
		}
	$sth->finish;
		
	if( $final_price )
		{
		$SQL = "UPDATE entries SET finalprice=$final_price WHERE entid=$entid";
		&my_sql;
		$sth->finish;
		}

	$SQL = "SELECT entid FROM entdetails WHERE entid=$entid and carrier = 0 LIMIT 1";
	&my_sql;
	if ($column = $sth->fetchrow_hashref)
		{
		$sth->finish;
		$SQL = "UPDATE entries SET status=2 WHERE entid=$entid";
		&my_sql;
		$sth->finish;
		}
	else
		{
		$sth->finish;
		$SQL = "UPDATE entries SET status=3 WHERE entid=$entid";
		&my_sql;
		$sth->finish;
		}

	if( $_carabr eq "" )
		{
		print "$srpad:no=$ref";
		}
	if( $_carabr eq "DHL" )
		{
		print "$srpad:dhl=$ref";
		}
	elsif( $_carabr eq "DPD" )
		{
		print "$srpad:dpd=$ref";
		}
	elsif( $_carabr eq "SC" )
		{
		print "$srpad:sc=$ref";
		}
	elsif( $_carabr eq "EPX" )
		{
		print "$srpad:epx=$ref";
		}
	else
		{
		print "$srpad:no=$ref";
		}
}

sub hold{
	my $holdunhold = shift;
	print "Content-type: text/plain\n\n";

	unless ($entid) { print "Not valid Delivery and Shipment Ref.!"; exit;}
	unless ($srid && $srid =~ /^\s*[0-9]{1,3}\s*$/) { print "Not valid SR#!"; exit;} 
	unless( $holdunhold eq "1" || $holdunhold eq "2" ) { print "Hold/Unhold status is not valid"; exit;} 

	if( $holdunhold eq "1" )
		{
		$holdunhold = "0";
		}
	else
		{
		$holdunhold = "1";
		}
		
	$SQL = "UPDATE entdetails SET hold=$holdunhold WHERE entid=$entid and sr=$srid";
	&my_sql;
	$sth->finish;

	if( $holdunhold eq "0" )
		{
		$holdunhold = "2";
		}
	else
		{
		$holdunhold = "1";
		}

	print "OK:$entid:$srid:$userid:$holdunhold";
}

sub paid{
	my $_ispaid = shift;
	print "Content-type: text/plain\n\n";

	unless ($entid) { print "Not valid Delivery and Shipment Ref.!"; exit;}
	unless ($srid && $srid =~ /^\s*[0-9]{1,3}\s*$/) { print "Not valid SR#!"; exit;} 
	unless ($_ispaid eq "1" || $_ispaid eq "2") { print "Paid/Unpaid status is not valid"; exit;} 

	if( $aepxcb )
		{
		$mustpay = 0;
		
		if( $lvmv eq "1" )
			{
			$_lvmv = "lvitems";
			}
		elsif( $lvmv eq "2" )
			{
			$_lvmv = "mvitems";
			}
			
		if( $aafter && $_lvmv )
			{
			$SQL = "SELECT $_lvmv as lvmvcount FROM entries WHERE entid=$entid";
			&my_sql;
			if ($acolumn = $sth->fetchrow_hashref)
				{
				if( $acolumn->{'lvmvcount'} >= $aafter )
					{
					$mustpay = 1;
					}
				else
					{
					$mustpay = 0;
					}
				}
			$sth->finish;
			}
		elsif( $_lvmv )
			{
			$mustpay = 1;
			}
		}
	else
		{
		$mustpay = 0;
		}

	if( $_ispaid eq "1" )
		{
		$_ispaid = "0";
		}
	else
		{
		$_ispaid = "1";
		}
		
	$SQL = "UPDATE entdetails SET ispaid=$_ispaid WHERE entid=$entid and sr=$srid";
	&my_sql;
	$sth->finish;

	if( $_lvmv )
		{
		$SQL = "UPDATE entries SET $_lvmv=$_lvmv+1 WHERE entid=$entid";
		&my_sql;
		$sth->finish;
		}

	if( $mustpay )
		{
		$SQL = "INSERT INTO accounts (accid, userid, adate, amount, atype, aref, asubref, asubrefstr, adesc) VALUES (0, $memid, CURRENT_TIMESTAMP(), $ashare, 'C', $entid, $srid, '$aawb', 'Credit added for Cash Back for Entry Ref. $entid SR# $srid (HAWB# $aawb).' )";
		&my_sql;
		$sth->finish;
		}

	if( $_ispaid eq "0" )
		{
		$_ispaid = "2";
		}
	else
		{
		$_ispaid = "1";
		}

	print "OK:$entid:$srid:$userid:$_ispaid:$memid:$lvmv:$cod:$ashare:$after:$aepxcb";
}

sub csved{
	my $_csved = shift;
	print "Content-type: text/plain\n\n";

	unless ($entid) { print "Not valid Delivery and Shipment Ref.!"; exit;}
	unless ($srid && $srid =~ /^\s*[0-9]{1,3}\s*$/) { print "Not valid SR#!"; exit;} 
	unless( $_csved eq "1" || $_csved eq "2" ) { print "CSV exportable/Not Exportable status is not valid"; exit;} 

	if( $_csved eq "1" )
		{
		$_csved = "";
		}
	else
		{
		$_csved = "A";
		}
		
	$SQL = "UPDATE entdetails SET csved='$_csved' WHERE entid=$entid and sr=$srid";
	
	&my_sql;
	$sth->finish;

	if( $_csved eq "" )
		{
		$_csved = "2";
		}
	else
		{
		$_csved = "1";
		}

	print "OK:$entid:$srid:$userid:$_csved";
}

sub checkservice{
	print "Content-type: text/plain\n\n";

	unless ($entid) { print "ER:$srid:$entid Not valid Delivery and Shipment Ref.!"; exit;}
	unless ($srid && $srid =~ /^\s*[0-9]{1,3}\s*$/) { print "ER:$srid:$srid Not valid SR#!"; exit;} 
	unless( $carrier eq ""  )
		{
		unless ($carrier =~ /^[0-9]+$/ ) { print "ER:$srid:$srpad Not valid Carrier!"; exit;} 
		}

	require "/home/europost/public_html/book.pl";

	$SQLS = "SELECT * FROM entdetails LEFT JOIN bags on entdetails.entid=bags.entid and entdetails.sr=bags.srid WHERE entdetails.entid=$entid and sr=$srid";
	&my_sqls;
	my $sr_price = 0;
	while ($columns = $sths->fetchrow_hashref)
		{
		if( $columns->{'scountry'} && $columns->{'rcountry'} && $columns->{'weight'} && $columns->{'length'} && $columns->{'width'} && $columns->{'height'} )
			{
			@total_price = ();
			&get_price("221", "NA1", "", $columns->{'rcountry'}, "$columns->{'rpcode'}", "$columns->{'rtown'}", $columns->{'weight'}, $columns->{'length'}, $columns->{'width'}, $columns->{'height'}, "0", -1, 0, $upid, $carrier, $columns->{'scountry'}, "0");
			if( $#total_price >= 0 )
				{
				$sr_price = $sr_price + toCurr($total_price[0]->{'price'}+$total_price[0]->{'totalfuel'}+$total_price[0]->{'totalremote'}+$total_price[0]->{'totalcust'}+$total_price[0]->{'totalvat'});
				}
			}
		}
	$sths->finish;
				
	if( $sr_price )
		{
		print "OK:$srid:$sr_price";
		}
	else
		{
		$sths->finish;
		print "ER:$srid:This HAWB can not be carried by the specified carrier";
		}
}

sub getAP
{
	my $code = shift;
	
	my %codes = (
		"303" => "7X",
		"390" => "A3",
		"001" => "AA",
		"057" => "AF",
		"124" => "AH",
		"027" => "AS",
		"105" => "AY",
		"055" => "AZ",
		"125" => "BA",
		"236" => "BD",
		"997" => "BG",
		"695" => "BR",
		"106" => "BW",
		"999" => "CA",
		"230" => "CM",
		"048" => "CY",
		"006" => "DL",
		"118" => "DT",
		"265" => "EF",
		"053" => "EI",
		"071" => "ET",
		"108" => "FI",
		"023" => "FX",
		"126" => "GA",
		"072" => "GF",
		"061" => "HM",
		"075" => "IB",
		"096" => "IR",
		"771" => "J2",
		"201" => "JM",
		"115" => "JU",
		"643" => "KM",
		"229" => "KU",
		"020" => "LH",
		"080" => "LO",
		"724" => "LX",
		"114" => "LY",
		"239" => "MK",
		"129" => "MP",
		"077" => "MS",
		"050" => "OA",
		"064" => "OK",
		"988" => "OZ",
		"214" => "PK",
		"079" => "PR",
		"566" => "PS",
		"656" => "PX",
		"081" => "QF",
		"070" => "RB",
		"421" => "S7",
		"117" => "SK",
		"507" => "SU",
		"065" => "SV",
		"217" => "TG",
		"235" => "TK",
		"270" => "TL",
		"603" => "UL",
		"037" => "US",
		"738" => "VN",
		"870" => "VV",
		"950" => "XS"
		);

	return $codes{$code};
}

sub updateCargo
{
	my $entry_id = shift;

	$SQL = "SELECT entid, awb1, awb2, cargolog, clogclosed FROM entries WHERE entid=$entry_id"; 

	&my_sql;
	unless ($column = $sth->fetchrow_hashref)
		{
		$sth->finish;
		return "Cargo: Entry $entry_id not found in the database";
		}

	if( $column->{'clogclosed'} == 1 )
		{
		$sth->finish;
		return "";
		}
	
	$entid = $column->{'entid'};

	my $apVar = getAP($column->{'awb1'});
	unless( $apVar ) { return "Cargo: Entry $entry_id awb1 ($column->{'awb1'}) not found in the database"; }

	$ap = $apVar;
	$awb1 = $column->{'awb1'};
	$awb2 = $column->{'awb2'};
	my $oldcargo = $column->{'cargolog'};

	$sth->finish;

	if( $entid && $awb1 && $awb2 )
		{
		my $cargostr = getcargo(1);
	
		if( $cargostr ne "ERROR" )
			{
			if( $cargostr ne "" )
				{
				$cargostr =~ s/'/''/g;
				$cargostr =~ s/\n/ /sg;
				
				if( $oldcargo ne $cargostr )
					{
					$SQL = "UPDATE entries SET cargolog='$cargostr' WHERE entid=$entry_id"; 
					&my_sql;
					$sth->finish;
					}
				}
			else
				{
				if( $oldcargo ne "" )
					{
					$SQL = "UPDATE entries SET clogclosed=1 WHERE entid=$entry_id"; 
					&my_sql;
					$sth->finish;
					}
				}
			}
		}
		
	return "";
}

sub updateFlight
{
	my $entry_id = shift;

	$SQL = "SELECT entid, flight, flightlog, flogclosed FROM entries WHERE entid=$entry_id"; 

	&my_sql;
	unless ($column = $sth->fetchrow_hashref)
		{
		$sth->finish;
		return "Flight: Entry $entry_id not found in the database";
		}

	if( $column->{'flogclosed'} == 1 )
		{
		$sth->finish;
		return "";
		}
	
	$entid = $column->{'entid'};
	$flight = $column->{'flight'};

	my $oldflight = $column->{'flightlog'};

	$sth->finish;

	if( $entid && $flight )
		{
		my $flightstr = getflight(1);

		if( $flightstr ne "ERROR" )
			{
			if( $flightstr ne "" )
				{
				$flightstr =~ s/'/''/g;
				$flightstr =~ s/\n/ /sg;
				
				if( $oldflight ne $flightstr )
					{
					$SQL = "UPDATE entries SET flightlog='$flightstr' WHERE entid=$entry_id"; 
					&my_sql;
					$sth->finish;
					}
				}
			else
				{
				if( $oldflight ne "" )
					{
					$SQL = "UPDATE entries SET flogclosed=1 WHERE entid=$entry_id"; 
					&my_sql;
					$sth->finish;
					}
				}
			}
		}
		
	return "";
}

sub getcargo{
	my $noprint = shift;
	
	print "Content-type: text/plain\n\n" unless( $noprint );

	unless ($ap) {  if( $noprint ) {return "ERROR";} else {print "Not valid Carrier!";} exit;}
	unless ($awb1 && $awb2) { if( $noprint ) {return "ERROR";} else {print "Not valid MAWB!";} exit;}

  $t_ua = LWP::UserAgent->new;
  $t_ua->agent("Mozilla/5.0");
  $t_ua->timeout(10);

	@form_data = (
	"Carrier" => "$ap",
 	"Pfx" => "$awb1",
 	"Shipment" => "$awb2");

	my $t_response = $t_ua->post('http://www.cargoserv.com/tracking.asp',	\@form_data);

	if( $t_response->is_success )
		{
		$tmpcontent = $t_response->content;
		$tmpcontent =~ s|.*?</form>(.*)|$1|is;
		
		if( $tmpcontent =~ m|(<table.*?Current Status.*?</table>)|is )
			{
			$tmpcontent = $1;
			$tmpcontent =~ s|<table(.*?)(<tr.*?</tr>)(.*)</table>|<table$1$3</table>|is;

			if( $tmpcontent =~ m/NO RECORD FOUND/s )
				{
				if( $noprint ) 
					{return "";} 
				else 
					{print "NOTFOUND";}
				}
			else
				{
				$tmpcontent =~ s/ffffff/FBE79F/gi;
				$tmpcontent =~ s/f8f8f8/FDE9BB/gi;
				$tmpcontent =~ s/dedfdf/9D7B06/gi;
				$tmpcontent =~ s/f1f1f1/F8D358/gi;
 				
 				if( $noprint ) 
 					{return $tmpcontent;} 
 				else 
 					{print $tmpcontent;}
				}
			}
		else
			{
			if( $noprint ) 
				{return "";} 
			else 
				{print "NOTFOUND";}
			}
		}
	else
		{
		if( $noprint ) 
			{return "ERROR";} 
		else 
			{print "ERROR";}
		}
}

sub getflight{
	my $noprint = shift;

	print "Content-type: text/plain\n\n" unless( $noprint );

	unless ($flight) { if( $noprint ) {return "ERROR";} else {print "Not valid Flight No.!"; exit;}}

  $t_ua = LWP::UserAgent->new;
  $t_ua->agent("Mozilla/5.0");
  $t_ua->timeout(10);


	@form_data = (
	"javax.portlet.begCacheTok" => "token",
 	"javax.portlet.endCacheTok" => "token",
 	"javax.portlet.tpst" => "bde211e38117ef94303fde9faca12635",
 	"javax.portlet.prp_bde211e38117ef94303fde9faca12635_flightRoute" => "",
 	"javax.portlet.prp_bde211e38117ef94303fde9faca12635_flightNumber" => "$flight",
 	"javax.portlet.prp_bde211e38117ef94303fde9faca12635_flightTerminal" => ""
 	);


	my $t_response = $t_ua->post('http://www.heathrowairport.com/portal/site/heathrow/template.PAGE/menuitem.72f1fecb6bc56d6ee4b12871120103a0/?javax.portlet.tpst=bde211e38117ef94303fde9faca12635&javax.portlet.prp_bde211e38117ef94303fde9faca12635_page=jspView&javax.portlet.begCacheTok=com.vignette.cachetoken&javax.portlet.endCacheTok=com.vignette.cachetoken',	\@form_data);

	if( $t_response->is_success )
		{
		$tmpcontent = $t_response->content;
		
		if( $tmpcontent =~ m|<table\s+id="timeTable"(.*?)</table>|is )
			{
			$tmpcontent = qq|<table id="timeTable"$1</table>|;

			if( $noprint ) 
				{return $tmpcontent;} 
			else 
				{print $tmpcontent;}
			}
		else
			{
			if( $noprint ) 
				{return "";} 
			else 
				{print "NOTFOUND";}
			}
		}
	else
		{
			if( $noprint ) 
				{return "ERROR";} 
			else 
				{print "ERROR";}
		}
}

sub viewall{
	my $hideheader = @_;

unless( $isAdmin || $userid == $isUser ) {&error_page("You don't have enough permission for this operation."); exit;}

unless( $sort )
	{
	$sort =  "i";
	$rev = 1;
	}

if( $isAdmin )
	{
	if( $searchid )
		{
		$SQL = "SELECT entries.userid AS en_userid, entries.type as en_type, entries.status as en_status,entries.entid,entdate,awb1,awb2,flight,entdate,username, finalprice, sum(messages.mread) as messsum, count(messages.mread) as messcount FROM entries LEFT JOIN members ON entries.userid=members.userid LEFT JOIN messages ON entries.entid=messages.entryid and messages.mto=$isUser RIGHT JOIN entdetails ON entries.entid=entdetails.entid WHERE entdetails.hawb='$searchid' GROUP BY entries.userid, entries.type, entries.status,entid,entdate,awb1,awb2,flight,entdate,username,finalprice "; 
		}
	else
		{
		$SQL = "SELECT entries.userid AS en_userid, entries.type as en_type, entries.status as en_status,entid,entdate,awb1,awb2,flight,entdate,username, finalprice, sum(messages.mread) as messsum, count(messages.mread) as messcount FROM entries LEFT JOIN members ON entries.userid=members.userid LEFT JOIN messages ON entries.entid=messages.entryid and messages.mto=$isUser GROUP BY entries.userid, entries.type, entries.status,entid,entdate,awb1,awb2,flight,entdate,username,finalprice "; 
		}

	$sortu = "";
	$sorts = "";
	$sortd = "";
	$sorti = "";
	$sortf = "";
	$sortm = "";
	$isortu = "";
	$isorts = "";
	$isortd = "";
	$isorti = "";
	$isortf = "";
	$isortm = "";
	$img1 = "<img valign=\"middle\" style=\"vertical-align: middle;\" src=\"img/content/";
	$img2 = "\" alt=\"Reverse Sort Order\" width=\"10\" height=\"12\" border=\"0\" />";

	if( $sort eq "u" )
		{
		if( $rev )
			{
			$SQL = $SQL . " ORDER BY username DESC, entries.type DESC, entdate ASC"; 
			$sortu = "";
			$isortu = $img1 . "ad.jpg" . $img2;
			}
		else
			{
			$SQL = $SQL . " ORDER BY username ASC, entries.type DESC, entdate DESC"; 
			$sortu = "&rev=1";
			$isortu = $img1 . "au.jpg" . $img2;
			}
		}
	elsif( $sort eq "i" )
		{
		if( $rev )
			{
			$SQL = $SQL . " ORDER BY entid DESC"; 
			$sorti = "";
			$isorti = $img1 . "ad.jpg" . $img2;
			}
		else
			{
			$SQL = $SQL . " ORDER BY entid ASC"; 
			$sorti = "&rev=1";
			$isorti = $img1 . "au.jpg" . $img2;
			}
		}
	elsif( $sort eq "s" )
		{
		if( $rev )
			{
			$SQL = $SQL . " ORDER BY entries.status DESC, entries.type DESC, entdate ASC"; 
			$sorts = "";
			$isorts = $img1 . "ad.jpg" . $img2;
			}
		else
			{
			$SQL = $SQL . " ORDER BY entries.status ASC, entries.type DESC, entdate DESC"; 
			$sorts = "&rev=1";
			$isorts = $img1 . "au.jpg" . $img2;
			}
		}
	elsif( $sort eq "f" )
		{
		if( $rev )
			{
			$SQL = $SQL . " ORDER BY entries.flight DESC"; 
			$sortf = "";
			$isortf = $img1 . "ad.jpg" . $img2;
			}
		else
			{
			$SQL = $SQL . " ORDER BY entries.flight ASC"; 
			$sortf = "&rev=1";
			$isortf = $img1 . "au.jpg" . $img2;
			}
		}
	elsif( $sort eq "m" )
		{
		if( $rev )
			{
			$SQL = $SQL . " ORDER BY entries.awb1 DESC, entries.awb2 DESC"; 
			$sortm = "";
			$isortm = $img1 . "ad.jpg" . $img2;
			}
		else
			{
			$SQL = $SQL . " ORDER BY entries.awb1 ASC, entries.awb1 ASC"; 
			$sortm = "&rev=1";
			$isortm = $img1 . "au.jpg" . $img2;
			}
		}
	else
		{
		if( $rev )
			{
			$SQL = $SQL . " ORDER BY entries.type DESC, entdate ASC, entid ASC"; 
			$sortd = "";
			$isortd = $img1 . "ad.jpg" . $img2;
			}
		else
			{
			$SQL = $SQL . " ORDER BY entries.type DESC, entdate DESC, entid DESC"; 
			$sortd = "&rev=1";
			$isortd = $img1 . "au.jpg" . $img2;
			}
		}
	&my_sql;
	}
else
	{
	$uid = $isUser;
	if( $searchid )
		{
		$SQL = "SELECT entries.entid, userid as en_userid, entdate, type, entries.status as en_status, awb1, awb2, flight, habwcount, totw, totb, ip, sum(messages.mread) as messsum, count(messages.mread) as messcount FROM entries LEFT JOIN messages ON entries.entid=messages.entryid and messages.mto=$isUser RIGHT JOIN entdetails ON entries.entid=entdetails.entid WHERE userid=$isUser AND entdetails.hawb='$searchid' GROUP BY entid, userid, entdate, type, entries.status, awb1, awb2, flight, habwcount, totw, totb, ip "; 
		}
	else
		{
		$SQL = "SELECT entid, userid as en_userid, entdate, type, entries.status as en_status, awb1, awb2, flight, habwcount, totw, totb, ip, sum(messages.mread) as messsum, count(messages.mread) as messcount FROM entries LEFT JOIN messages ON entries.entid=messages.entryid and messages.mto=$isUser WHERE userid=$isUser $searchstr GROUP BY entid, userid, entdate, type, entries.status, awb1, awb2, flight, habwcount, totw, totb, ip "; 
		}

	$sorts = "";
	$sortd = "";
	$sorti = "";
	$sortf = "";
	$sortm = "";
	$isorts = "";
	$isortd = "";
	$isorti = "";
	$isortf = "";
	$isortm = "";
	$img1 = "<img valign=\"middle\" style=\"vertical-align: middle;\" src=\"img/content/";
	$img2 = "\" alt=\"Reverse Sort Order\" width=\"10\" height=\"12\" border=\"0\" />";

	if( $sort eq "i" )
		{
		if( $rev )
			{
			$SQL = $SQL . " ORDER BY entid DESC"; 
			$sorti = "";
			$isorti = $img1 . "ad.jpg" . $img2;
			}
		else
			{
			$SQL = $SQL . " ORDER BY entid ASC"; 
			$sorti = "&rev=1";
			$isorti = $img1 . "au.jpg" . $img2;
			}
		}
	elsif( $sort eq "s" )
		{
		if( $rev )
			{
			$SQL = $SQL . " ORDER BY status DESC, entdate ASC"; 
			$sorts = "";
			$isorts = $img1 . "ad.jpg" . $img2;
			}
		else
			{
			$SQL = $SQL . " ORDER BY status ASC, entdate DESC"; 
			$sorts = "&rev=1";
			$isorts = $img1 . "au.jpg" . $img2;
			}
		}
	elsif( $sort eq "f" )
		{
		if( $rev )
			{
			$SQL = $SQL . " ORDER BY flight DESC"; 
			$sortf = "";
			$isortf = $img1 . "ad.jpg" . $img2;
			}
		else
			{
			$SQL = $SQL . " ORDER BY flight ASC"; 
			$sortf = "&rev=1";
			$isortf = $img1 . "au.jpg" . $img2;
			}
		}
	elsif( $sort eq "m" )
		{
		if( $rev )
			{
			$SQL = $SQL . " ORDER BY awb1 DESC, awb2 DESC"; 
			$sortm = "";
			$isortm = $img1 . "ad.jpg" . $img2;
			}
		else
			{
			$SQL = $SQL . " ORDER BY awb1 ASC, awb2 ASC"; 
			$sortm = "&rev=1";
			$isortm = $img1 . "au.jpg" . $img2;
			}
		}
	else
		{
		if( $rev )
			{
			$SQL = $SQL . " ORDER BY entdate ASC, entid ASC"; 
			$sortd = "";
			$isortd = $img1 . "ad.jpg" . $img2;
			}
		else
			{
			$SQL = $SQL . " ORDER BY entdate DESC, entid DESC"; 
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
			unless( $hideheader )
				{
				&myheader("vieworders");
				&topmenu("vieworders");
				print qq|<div class="ha8">|;
				}

			print qq|
				<font size="2" face="Arial">
				<div style="float: left;"><span class="text1"><font face="Arial" size="2"><b>List of Delivery and Shippments|;
				
				if( $searchid )
					{
					print " for HAWB: $searchid";
					}
				print qq|</b></font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" class="noneunderline" onClick="javascript:window.open('$script?cf=entry&printlist=1&userid=$isUser','printorderlist','width=' + (screen.width - 40) + ',height=' + (screen.height - 100) + ',top=20,left=10,scrollbars=yes,toolbar=no,status=no,menubar=yes,resizable=no,location=no')"><img src="img/content/print.jpg" width="16" height="16" border="0" alt="Print Delivery and Shipment List" valign="middle" style="vertical-align: middle;" /></a>&nbsp;&nbsp;<a href="javascript:void(0);" class="noneunderline" onClick="javascript:window.open('$script?cf=entry&printlist=1&userid=$isUser','printorderlist','width=' + (screen.width - 40) + ',height=' + (screen.height - 100) + ',top=20,left=10,scrollbars=yes,toolbar=no,status=no,menubar=yes,resizable=no,location=no')">Print Delivery and Shipment List</a></span></div>
				<div style="float: right;">
	<form action="$script" method="GET">
	<input name="cf" type="hidden" value="entry" />
	<input name="viewall" type="hidden" value="1" />
	MAWB No.:&nbsp;<input name="searchid" type="text" value="$searchid" />
	&nbsp;
	<input name="submit" type="submit" value="Search" />
	</form>
				</div>
				<br /><br />
					<table style="width: 100%" align="left" border="1" cellpadding="2" cellspacing="0">
						<tr>
						|;
						if( $isAdmin )
							{
							print qq|
							<th width="22" align="left">Msg.</th>
							<th width="100" align="left"><a class="noneunderline" href="$script?cf=entry&viewall=1&userid=$isUser&sort=i$sorti">$isorti Ref.</a></th>
							<th width="140" align="left"><a class="noneunderline" href="$script?cf=entry&viewall=1&userid=$isUser&sort=d$sortd">$isortd Date</a></th>
							<th width="120" align="left"><a class="noneunderline" href="$script?cf=entry&viewall=1&userid=$isUser&sort=m$sortm">$isortm MAWB</a></th>
							<th width="108" align="left"><a class="noneunderline" href="$script?cf=entry&viewall=1&userid=$isUser&sort=f$sortf">$isortf Flight No</a></th>
							<th width="140" align="left"><a class="noneunderline" href="$script?cf=entry&viewall=1&userid=$isUser&sort=u$sortu">$isortu Username</a></th>
							<th width="120" align="left"><a class="noneunderline" href="$script?cf=entry&userid=$isUser&viewall=1&sort=s$sorts">$isorts Status</a></th>
							<th width="130" align="center">Est. Price <small>(£)</small></th>
							<th width="120" align="center" colspan="6">Action</th>
							</tr>
							|;
							}
						else
							{
							print qq|
							<th width="22" align="left">Msg.</th>
							<th width="170" align="left"><a class="noneunderline" href="$script?cf=entry&viewall=1&userid=$isUser&sort=i$sorti">$isorti Ref.</a></th>
							<th width="200" align="left"><a class="noneunderline" href="$script?cf=entry&viewall=1&userid=$isUser&sort=d$sortd">$isortd Date</a></th>
							<th width="180" align="left"><a class="noneunderline" href="$script?cf=entry&viewall=1&userid=$isUser&sort=m$sortm">$isortm MAWB</a></th>
							<th width="178" align="left"><a class="noneunderline" href="$script?cf=entry&viewall=1&userid=$isUser&sort=f$sortf">$isortf Flight No</a></th>
							<th width="190" align="left"><a class="noneunderline" href="$script?cf=entry&userid=$isUser&viewall=1&sort=s$sorts">$isorts Status</a></th>
							<th width="60" align="center" colspan="3">Action</th>
							</tr>
							|;
							}
			}

		if( $column->{'messcount'} )
			{
			if( $column->{'messsum'} && $column->{'messsum'} == $column->{'messcount'})
				{
				$emailimg = "<a href=\"javascript:void(0);\" onClick=\"window.open('$script?cf=message&userid=$isUser&entuser=$column->{'en_userid'}&entid=$column->{'entid'}','Messages','width=' + (screen.width - 40) + ',height=' + (screen.height - 100) + ',top=20,left=10,scrollbars=yes,toolbar=no,status=no,menubar=yes,resizable=no,location=no')\"><img src=\"img/content/mess.gif\" border=\"0\" width=\"22\" height=\"16\" style=\"float: left;\" /></a>";
				}
			else
				{
				$emailimg = "<a href=\"javascript:void(0);\" onClick=\"window.open('$script?cf=message&userid=$isUser&entuser=$column->{'en_userid'}&entid=$column->{'entid'}','Messages','width=' + (screen.width - 40) + ',height=' + (screen.height - 100) + ',top=20,left=10,scrollbars=yes,toolbar=no,status=no,menubar=yes,resizable=no,location=no')\"><img src=\"img/content/messnew.gif\" border=\"0\" width=\"22\" height=\"16\" style=\"float: left;\" /></a>";
				}
			}
		else
			{
			$emailimg = "<a href=\"javascript:void(0);\" onClick=\"window.open('$script?cf=message&userid=$isUser&entuser=$column->{'en_userid'}&entid=$column->{'entid'}','Messages','width=' + (screen.width - 40) + ',height=' + (screen.height - 100) + ',top=20,left=10,scrollbars=yes,toolbar=no,status=no,menubar=yes,resizable=no,location=no')\"><img src=\"img/content/messno.gif\" border=\"0\" width=\"22\" height=\"16\" style=\"float: left;\" /></a>";
			}

		if( $isAdmin )
			{
			$uid = $column->{'en_userid'};
			if( $column->{'en_type'} == 1 )
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
		<td align="left">$emailimg</td>
		<td align="left"><font color="$clr"><a href="$script?cf=entry&view=1&userid=$isUser&entid=$column->{'entid'}">$column->{'entid'}</font></td>|;

		if( $column->{'entdate'} )
			{ print qq|<td align="left"><font color="$clr">$column->{'entdate'}</font></td>|; }
		else
			{ print qq|<td align="left"><font color="$clr">&nbsp;</font></td>|; }
		
			
		if( $column->{'awb1'} || $column->{'awb2'} )
			{	print qq|<td align="left"><font color="$clr">$column->{'awb1'}&nbsp;$column->{'awb2'}</font></td>|; }
		else
			{	print qq|<td align="left"><font color="$clr">&nbsp;</font></td>|; }

		if( $column->{'flight'} )
			{ print qq|<td align="left"><font color="$clr">$column->{'flight'}</font></td>|; }
		else
			{ print qq|<td align="left"><font color="$clr">&nbsp;</font></td>|; }
		
		print qq|<td align="left"><font color="$clr"><a href="$script?cf=members&view=1&memid=$uid">$column->{'username'}</a></font></td>| if( $isAdmin );
		
		if( $column->{'en_status'} == 9 )
			{
			print qq|<td align="left"><font color="$clr">Canceled</font></td>|;
			}
		if( $column->{'en_status'} == 3 )
			{
			print qq|<td align="left"><font color="$clr">Done</font></td>|;
			}
		elsif( $column->{'en_status'} == 2 )
			{
			print qq|<td align="left"><font color="$clr">Processing...</font></td>|;
			}
		else
			{
			print qq|<td align="left"><font color="#FF0000">Not Processed</font></td>|;
			}

		print qq|<td align="left"><font color="$clr">$column->{'finalprice'}</font></td>| if( $isAdmin );

		$rowentid = $column->{'entid'};
		print qq|<td align="center"><center><a href="$script?cf=entry&edit=1&fromlist=1&entid=$rowentid" class="noneunderline"><img src="img/content/edit.png" width="16" height="16" border="0" alt="Edit Delivery and Shipment" valign="middle" style="vertical-align: middle;" /></a></center></td>|;
		print qq|<td align="center"><center><a href="javascript:void(0);" class="noneunderline" onClick="javascript:window.open('$script?cf=entry&printit=1&entid=$rowentid','printorder','width=' + (screen.width - 40) + ',height=' + (screen.height - 100) + ',top=20,left=10,scrollbars=yes,toolbar=no,status=no,menubar=yes,resizable=no,location=no')"><img src="img/content/print.jpg" width="16" height="16" border="0" alt="Print Delivery and Shipment" valign="middle" style="vertical-align: middle;" /></a></center></td>|;
		print qq|<td align="center"><center><a href="$script?cf=entry&estimate=1&entid=$rowentid&fromlist=1&uid=$uid" class="noneunderline"><img src="img/content/estimate.gif" width="16" height="16" border="0" alt="Estimate HAWB prices" valign="middle" style="vertical-align: middle;" /></a></center></td>| if( $isAdmin );
		print qq|<td align="center"><center><a href="$script?cf=entry&csv=DPD&entid=$rowentid&uid=$uid" class="noneunderline"><img src="img/content/csv.gif" width="16" height="16" border="0" alt="Create CSV File" valign="middle" style="vertical-align: middle;" /></a></center></td>| if( $isAdmin );

		if( $isAdmin )
			{
			print qq|<td align="center"><center>|;

			if( $column->{'en_type'} == 1 )
				{
				print qq|<a class="noneunderline" href="$script?cf=entry&priority=2&fromlist=1&entid=$rowentid"><img src="img/content/uparrow.jpg" width="16" height="16" border="0" alt="Make Delivery and Shipment as 'High Priority'" valign="middle" style="vertical-align: middle;" /></a>|;
				}
			else
				{
				print qq|<a class="noneunderline" href="$script?cf=entry&priority=1&fromlist=1&entid=$rowentid"><img src="img/content/dnarrow.jpg" width="16" height="16" border="0" alt="Make Delivery and Shipment as 'Normal Priority'" valign="middle" style="vertical-align: middle;" /></a>|;
				}

			print qq|</center></td>|;
			}
			
		print qq|<td align="center"><center><a href="$script?cf=entry&delete=1&fromlist=1&entid=$rowentid" class="noneunderline" onclick="javascript:return confirm('Are you sure you want to delete this Delivery and Shipment?')"><img src="img/content/delete.jpg" width="16" height="16" border="0" alt="Delete Delivery and Shipment" valign="middle" style="vertical-align: middle;" /></a></center></td>|;
		
		print "</tr>";

		$i++;
		}

if( $i )
	{
	print qq|		
		</table>
	</font>
	<br />
	|;

unless( $hideheader )
	{	
	print "</div>";

	&footer;
	}
	}
else
	{
	unless( $hideheader )
		{
			&myheader("vieworders");
			&topmenu("vieworders");
			
			print qq|<div class="ha8">|;
		}

	print qq|
		<center><br /><br /><br /><br /><br /><br /><br /><br /><br /><font size="2">
		|;

		if( $searchid )
			{			
			print "HAWB $searchid Not found in the Delivery and Shipments.";
			}
		else
			{
			print "There is not any Delivery and Shipment to display.";
			}
	print "<br /><br /><br /><br /><br /><br /><br /><br /><br /><center></font>";
			
	unless( $hideheader )
		{
			print "</div>";
			&footer;
		}		
	}

}

sub priority{
	unless ($entid) {&error_page("Not valid Delivery and Shipment Ref.!"); exit;} 

	$SQL = "UPDATE entries SET type=$priority WHERE entid=$entid";
	&my_sql;
	$sth->finish;

	if( $fromlist )
		{
		$redirect ="$script?cf=member&userid=$isUser";
		}
	else
		{
		$redirect="$script?cf=entry&view=1&entid=$entid";
		}
	print $form->redirect(-url=>$redirect);
}

sub delete{
	unless ($entid) {&error_page("Not valid Delivery and Shipment Ref.!"); exit;} 

	$SQL = "SELECT userid FROM entries WHERE entid = $entid"; 
	&my_sql;
	if ($column = $sth->fetchrow_hashref){
		$fg_userid = $column->{'userid'};
		$sth->finish;

		if( $isAdmin || $fg_userid == $isUser )
			{
			$SQL = "SELECT reference FROM entdetails WHERE entid=$entid and reference != '' LIMIT 0, 1";
			&my_sql;

			if ($column = $sth->fetchrow_hashref)
				{
				$sth->finish;
				&error_page("Cannot delete this Delivery and Shipment because some of the SRs has been processed."); exit;
				}
			else
				{
				$sth->finish;

				$SQL = "DELETE FROM bags WHERE entid=$entid";
				&my_sql;
				$sth->finish;
				
				$SQL = "DELETE FROM entdetails WHERE entid=$entid";
				&my_sql;
				$sth->finish;
	
				$SQL = "DELETE FROM entries WHERE entid=$entid";
				&my_sql;
				$sth->finish;
	
				if( $fromlist )
					{
					$redirect ="$script?cf=member&userid=$isUser";
					}
				else
					{
					$redirect="$script?cf=entdel";
					}
				print $form->redirect(-url=>$redirect);
				}
			}
		else
			{
			&error_page("You don't have enough permission for this operation."); exit;
			}
	}
	else
		{
		$sth->finish;
		&error_page("The Delivery and Shipment does not exist!"); exit;
		}
}


sub printlist{
unless( $isAdmin || $userid == $isUser ) {&error_page("You don't have enough permission for this operation."); exit;}

if( $isAdmin )
	{
	$SQL = "SELECT entries.userid AS en_userid, entries.type as en_type, entries.status as en_status,entid,entdate,awb1,awb2,flight,entdate,username FROM entries LEFT JOIN members ON entries.userid=members.userid"; 

	$sortu = "";
	$sorts = "";
	$sortd = "";
	$sorti = "";
	$sortf = "";
	$sortm = "";
	$isortu = "";
	$isorts = "";
	$isortd = "";
	$isorti = "";
	$isortf = "";
	$isortm = "";
	$img1 = "<img valign=\"middle\" style=\"vertical-align: middle;\" src=\"img/content/";
	$img2 = "\" alt=\"Reverse Sort Order\" width=\"10\" height=\"12\" border=\"0\" />";

	if( $sort eq "u" )
		{
		if( $rev )
			{
			$SQL = $SQL . " ORDER BY username DESC, entries.type DESC, entdate ASC"; 
			$sortu = "";
			$isortu = $img1 . "ad.jpg" . $img2;
			}
		else
			{
			$SQL = $SQL . " ORDER BY username ASC, entries.type DESC, entdate DESC"; 
			$sortu = "&rev=1";
			$isortu = $img1 . "au.jpg" . $img2;
			}
		}
	elsif( $sort eq "i" )
		{
		if( $rev )
			{
			$SQL = $SQL . " ORDER BY entid DESC"; 
			$sorti = "";
			$isorti = $img1 . "ad.jpg" . $img2;
			}
		else
			{
			$SQL = $SQL . " ORDER BY entid ASC"; 
			$sorti = "&rev=1";
			$isorti = $img1 . "au.jpg" . $img2;
			}
		}
	elsif( $sort eq "s" )
		{
		if( $rev )
			{
			$SQL = $SQL . " ORDER BY entries.status DESC, entries.type DESC, entdate ASC"; 
			$sorts = "";
			$isorts = $img1 . "ad.jpg" . $img2;
			}
		else
			{
			$SQL = $SQL . " ORDER BY entries.status ASC, entries.type DESC, entdate DESC"; 
			$sorts = "&rev=1";
			$isorts = $img1 . "au.jpg" . $img2;
			}
		}
	elsif( $sort eq "f" )
		{
		if( $rev )
			{
			$SQL = $SQL . " ORDER BY entries.flight DESC"; 
			$sortf = "";
			$isortf = $img1 . "ad.jpg" . $img2;
			}
		else
			{
			$SQL = $SQL . " ORDER BY entries.flight ASC"; 
			$sortf = "&rev=1";
			$isortf = $img1 . "au.jpg" . $img2;
			}
		}
	elsif( $sort eq "m" )
		{
		if( $rev )
			{
			$SQL = $SQL . " ORDER BY entries.awb1 DESC, entries.awb2 DESC"; 
			$sortm = "";
			$isortm = $img1 . "ad.jpg" . $img2;
			}
		else
			{
			$SQL = $SQL . " ORDER BY entries.awb1 ASC, entries.awb1 ASC"; 
			$sortm = "&rev=1";
			$isortm = $img1 . "au.jpg" . $img2;
			}
		}
	else
		{
		if( $rev )
			{
			$SQL = $SQL . " ORDER BY entries.type DESC, entdate ASC"; 
			$sortd = "";
			$isortd = $img1 . "ad.jpg" . $img2;
			}
		else
			{
			$SQL = $SQL . " ORDER BY entries.type DESC, entdate DESC"; 
			$sortd = "&rev=1";
			$isortd = $img1 . "au.jpg" . $img2;
			}
		}
	&my_sql;
	}
else
	{
	$uid = $isUser;
	$SQL = "SELECT * FROM entries WHERE userid=$isUser"; 

	$sorts = "";
	$sortd = "";
	$sorti = "";
	$sortf = "";
	$sortm = "";
	$isorts = "";
	$isortd = "";
	$isorti = "";
	$isortf = "";
	$isortm = "";
	$img1 = "<img valign=\"middle\" style=\"vertical-align: middle;\" src=\"img/content/";
	$img2 = "\" alt=\"Reverse Sort Order\" width=\"10\" height=\"12\" border=\"0\" />";

	if( $sort eq "i" )
		{
		if( $rev )
			{
			$SQL = $SQL . " ORDER BY entid DESC"; 
			$sorti = "";
			$isorti = $img1 . "ad.jpg" . $img2;
			}
		else
			{
			$SQL = $SQL . " ORDER BY entid ASC"; 
			$sorti = "&rev=1";
			$isorti = $img1 . "au.jpg" . $img2;
			}
		}
	elsif( $sort eq "s" )
		{
		if( $rev )
			{
			$SQL = $SQL . " ORDER BY status DESC, entdate ASC"; 
			$sorts = "";
			$isorts = $img1 . "ad.jpg" . $img2;
			}
		else
			{
			$SQL = $SQL . " ORDER BY status ASC, entdate DESC"; 
			$sorts = "&rev=1";
			$isorts = $img1 . "au.jpg" . $img2;
			}
		}
	elsif( $sort eq "f" )
		{
		if( $rev )
			{
			$SQL = $SQL . " ORDER BY flight DESC"; 
			$sortf = "";
			$isortf = $img1 . "ad.jpg" . $img2;
			}
		else
			{
			$SQL = $SQL . " ORDER BY flight ASC"; 
			$sortf = "&rev=1";
			$isortf = $img1 . "au.jpg" . $img2;
			}
		}
	elsif( $sort eq "m" )
		{
		if( $rev )
			{
			$SQL = $SQL . " ORDER BY awb1 DESC, awb2 DESC"; 
			$sortm = "";
			$isortm = $img1 . "ad.jpg" . $img2;
			}
		else
			{
			$SQL = $SQL . " ORDER BY awb1 ASC, awb2 ASC"; 
			$sortm = "&rev=1";
			$isortm = $img1 . "au.jpg" . $img2;
			}
		}
	else
		{
		if( $rev )
			{
			$SQL = $SQL . " ORDER BY entdate ASC"; 
			$sortd = "";
			$isortd = $img1 . "ad.jpg" . $img2;
			}
		else
			{
			$SQL = $SQL . " ORDER BY entdate DESC"; 
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
			print $form->header;

			print qq|
		<html>
		<head>
		<title>Booking List
		</title>
		</head>
		<body>
		<div align="center" valign="middle" style="vertical-align: middle;">
		<img src="img/content/slogan_01.gif" width="235" height="56" style="float: left;" /><span style="float: right;" /><H1>List of Delivery and Shippments</H1></span>
		</div>
		<br />
		<br />
		<br />
		<font size="2" face="Arial">
		<center>
					<table style="width: 100%" align="left" border="1" cellpadding="5" cellspacing="0">
						<tr>
						<th width="80" align="left">Delivery and Shipment Ref.</th>
						<th width="100" align="left">Date</th>
						<th width="120" align="left">MAWB</th>
						<th width="100" align="left">Flight No</th>
						|;
						
						print qq|<th width="130" align="left">Username</th>| if( $isAdmin );
						
						print qq|
						<th width="120" align="left">Status</th>
						</tr>
						|;
			}

		if( $isAdmin )
			{
			$uid = $column->{'en_userid'};
			if( $column->{'en_type'} == 1 )
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
		<td align="left">$pretag<font color="#000000">$column->{'entid'}</font>$posttag</td>
		<td align="left">$pretag<font color="#000000">$column->{'entdate'}</font>$posttag</td>
		<td align="left">$pretag<font color="#000000">$column->{'awb1'}&nbsp;$column->{'awb2'}</font>$posttag</td>
		<td align="left">$pretag<font color="#000000">$column->{'flight'}</font>$posttag</td>
		|;
		
		print qq|<td align="left">$pretag<font color="#000000">$column->{'username'}</font>$posttag</td>| if( $isAdmin );
		
		if( $column->{'en_status'} == 9 )
			{
			print qq|<td align="left">$pretag<font color="#000000">Canceled</font>$posttag</td>|;
			}
		elsif( $column->{'en_status'} == 3 )
			{
			print qq|<td align="left">$pretag<font color="#000000">Done</font>$posttag</td>|;
			}
		elsif( $column->{'en_status'} == 2 )
			{
			print qq|<td align="left">$pretag<font color="#000000">Processing...</font>$posttag</td>|;
			}
		else
			{
			print qq|<td align="left">$pretag<font color="#000000">Not Processed</font>$posttag</td>|;
			}
		
		print "</tr>";

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

sub printit{
	unless ($entid) {&error_page("Not valid Delivery and Shipment Ref.!"); exit;} 

	if( $isAdmin )
		{
		$SQL = "SELECT entries.userid AS en_userid, entries.type as en_type, entries.status as en_status,entid,entdate,awb1,awb2,flight,entdate,habwcount,totw,totb,cargolog,flightlog,username,sal,fname,lname,company,tel1,tel2,tel3,mob1,mob2,mob3,fax1,fax2,fax3,address,postcode,members.country as country,city,email,website FROM entries LEFT JOIN members ON entries.userid=members.userid WHERE entries.entid = $entid";
		}
	else
		{
		$SQL = "SELECT userid AS en_userid, type as en_type, status as en_status,entid,entdate,awb1,awb2,flight,entdate,habwcount,totw,totb,cargolog,flightlog FROM entries WHERE entries.entid = $entid"; 
		}
		
	&my_sql;
	if ($column = $sth->fetchrow_hashref){

		unless( $isAdmin || $column->{'en_userid'} == $isUser ) {&error_page("You don't have enough permission for this operation."); exit;}

		print $form->header;

print qq~
<html>
<head>
<title>Delivery and Shipment Ref.: $entid
</title>
</head>
<body>
		<div align="center" valign="middle" style="width: 1440px; vertical-align: middle;">
		<img src="img/content/slogan_01.gif" width="235" height="56" style="float: left;" /><span style="float: right;" /><H1>Delivery and Shipment Info #$entid</H1></span>
		</div>
		<br />

<font size="2" face="Arial">
	<center>
		<table style="width: 1440px;" align="left" border="1" cellpadding="2" cellspacing="0">
		~;
	
if( $isAdmin )
{
print qq|
		<tr>
			<td style="background-color:#CCCCCC"><center><big><b>Agent Details</b></big></center></td>
		</tr>
		<tr>
			<td align="left">
		<table style="width: 1440px;" align="left" border="0">
		<tr>
			<td style="width: 200px">Username:</td>
			<td style="width: 1240px"><b>$column->{'username'}</b></td>
		</tr>
		<tr>
			<td style="width: 200px">Name:</td>
			<td style="width: 1240px">$column->{'sal'} $column->{'fname'} $column->{'lname'}</td>
		</tr>
		<tr>
			<td style="width: 200px">Company:</td>
			<td style="width: 1240px">$column->{'company'}</td>
		</tr>
		<tr>
			<td style="width: 200px">Land Phone:</td>
			<td style="width: 1240px">+$column->{'tel1'}($column->{'tel2'})$column->{'tel3'}</td>
		</tr>
		<tr>
			<td style="width: 200px">Cell Phone:</td>
			<td style="width: 1240px">+$column->{'mob1'}($column->{'mob2'})$column->{'mob3'}</td>
		</tr>
		<tr>
			<td style="width: 200px">Fax:</td>
			<td style="width: 1240px">+$column->{'fax1'}($column->{'fax2'})$column->{'fax3'}</td>
		</tr>
		<tr>
			<td style="width: 200px">Address:</td>
			<td style="width: 1240px">$column->{'address'}</td>
		</tr>
		<tr>
			<td style="width: 200px">Post Code:</td>
			<td style="width: 1240px">$column->{'postcode'}</td>
		</tr>
		<tr>
			<td style="width: 200px">Country:</td>
			<td style="width: 1240px">|;
			
			print get_country($column->{'country'});
			
			print qq|</td>
		</tr>
		<tr>
			<td style="width: 200px">City:</td>
			<td style="width: 1240px">$column->{'city'}</td>
		</tr>
		<tr>
			<td style="width: 200px">Email:</td>
			<td style="width: 1240px"><a href="mailto:$column->{'email'}">$column->{'email'}</a></td>
		</tr>
		<tr>
			<td style="width: 200px">Website:</td>
			<td style="width: 1240px"><a href="$column->{'website'}" target=_BLANK>$column->{'website'}</a></td>
		</tr>
	</table>
	</td>
	</tr>
	|;
}
	
	print qq|
		<tr>
			<td style="background-color:#CCCCCC"><center><big><b>Delivery and Shipment Specification</b></big></center></td>
		</tr>
		<tr>
			<td align="left">
			<table width="100%" border="0">
			<tr>
			<td width="300">
			<b>Delivery and Shipment Ref.:</b> $column->{'entid'}<br />
			<b>Date:</b> $column->{'entdate'}<br />
			<b>MAWB:</b> $column->{'awb1'}&nbsp;$column->{'awb2'}<br />
			<b>Flight No.:</b> $column->{'flight'}<br />
			<b>Date:</b> $column->{'entdate'}<br />|;
			
if( $isAdmin )
	{			
			print "<br /><b>Type:</b> ";
			
			if( $column->{'en_type'} == 2 )
				{
				print "<I>High Priority</I><br />";
				}
			else
				{
				print "Normal Priority<br />";
				}

			print "<b>Status:</b> ";

			if( $column->{'en_status'} == 9 )
				{
				print "Canceled<br />";
				}
			elsif( $column->{'en_status'} == 3 )
				{
				print "Done<br />";
				}
			elsif( $column->{'en_status'} == 2 )
				{
				print "Processing...<br />";
				}
			else
				{
				print "<i>Not Processed</i><br />";
				}
	}				

print qq|
		</td>
		<td width="1130">
		
		<div style="width:1130px; float: left;" align="left">
		$column->{'cargolog'}
		</div>
		<br />
		<div style="width:1130px; float: left;" align="left">
		$column->{'flightlog'}
		</div>
		
		</td>
		</tr>
		</table>
		</td>
		</tr>
		<tr>
			<td style="background-color:#CCCCCC"><center><big><b>Delivery and Shipment Details</b></big></center></td>
		</tr>
		<tr>
			<td align="left">

			<b>No of HAWB:</b> $column->{'habwcount'}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Total Weight:</b> $column->{'totw'}&nbsp;<small>(kg)</small>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Total Bags:</b> $column->{'totb'}<br />
			<br />
			<table width="1440" align="left" border="1" cellspacing="0" cellpadding="2">
			<tr>
			<th width="30" align="left">SR#</th>
			<th width="65" align="left">HAWB</th>
			<th width="60" align="left">Value</th>
			<th width="20" align="left">No. of Bags</th>
			<th width="50" align="left">Bag Ref</th>
			<th width="50" align="left">Weight <small>(kg)</small></th>
			<th width="50" align="left">Vol. Weight <small>(kg)</small></th>
			<th width="60" align="left">Size <small>(cm)</small></th>
			<th width="25" align="left">HV/LV</th>
			<th width="15" align="left">Hold</th>
			<th width="110" align="left">Content</th>
			<th width="60" align="left">COD (£)</th>
			<th width="110" align="left">Shipper</th>
			<th width="110" align="left">Receiver</th>
			<th width="100" align="left">Carrier</th>
			<th width="85" align="left">Tracking No.</th>
			</tr>	
			|;

			$SQL2 = "SELECT entdetails.entid, sr, hawb, item, value, lvhv, hold, cod, content, currency, scontact, scompany, semail, sphone, sadd1, sadd2, stown, scounty, spcode, sc.country as scountry, rcontact, rcompany, remail, rphone, radd1, radd2, rtown, rcounty, rpcode, rc.country as rcountry, carrier, reference FROM entdetails LEFT JOIN countries AS sc ON sc.id=scountry LEFT JOIN countries AS rc ON rc.id=rcountry WHERE entdetails.entid = $entid ORDER BY sr"; 
			&my_sql2;
			
			while ($column2 = $sth2->fetchrow_hashref)
				{
				print "<tr>\n";
				print "<td align=\"left\">$column2->{'sr'}</td>";
				print "<td align=\"left\">$column2->{'hawb'}</td>";
				print "<td align=\"left\">$column2->{'currency'} $column2->{'value'}</td>";
				print "<td align=\"left\">$column2->{'item'}</td>";
				
				$TSQL = "SELECT * FROM bags WHERE entid = $entid AND srid=$column2->{'sr'} ORDER BY bagid"; 
				&tmy_sql;
				$tmp_bag = "";
				$tmp_weight = "";
				$tmp_vweight = "";
				$tmp_size = "";
				while ($tcolumn = $tsth->fetchrow_hashref)
					{
					$volweight = toCurr(($tcolumn->{'length'} * $tcolumn->{'width'} * $tcolumn->{'height'}) / 4000);
					$tmp_bag = $tmp_bag . $tcolumn->{'bag'} . "<br />";
					$tmp_weight = $tmp_weight . $tcolumn->{'weight'} . "<br />";
					$tmp_vweight = $tmp_vweight . $volweight . "<br />";
					$tmp_size = $tmp_size . "$tcolumn->{'length'} x $tcolumn->{'width'} x $tcolumn->{'height'}<br />";
					}
				$tsth->finish;
				
				print "<td align=\"left\">$tmp_bag</td>";
				print "<td align=\"left\">$tmp_weight</td>";
				print "<td align=\"left\">$tmp_vweight</td>";
				print "<td align=\"left\">$tmp_size</td>";

				if( $column2->{'lvhv'} == 1 )
					{ print "<td align=\"center\">LV</td>"; }
				elsif( $column2->{'lvhv'} == 2 )
					{ print "<td align=\"center\">HV</td>"; }
				elsif( $column2->{'lvhv'} == 3 )
					{ print "<td align=\"center\">MHV</td>"; }
				elsif( $column2->{'lvhv'} == 3 )
					{ print "<td align=\"center\">PE</td>"; }
				else
					{ print "<td align=\"center\">&nbsp;</td>"; }

				if( $column2->{'hold'} == 1 )
					{ print "<td align=\"center\">X</td>"; }
				else
					{ print "<td align=\"center\">&nbsp;</td>"; }

				print "<td align=\"left\">$column2->{'content'}</td>";

				if( $column2->{'cod'} > 0 )
					{ print "<td align=\"left\">$column2->{'cod'}</td>"; }
				else
					{ print "<td align=\"left\">&nbsp;</td>"; }

				print "<td align=\"left\">";

				if( $column2->{'scontact'} || $column2->{'scompany'} || $column2->{'semail'} || $column2->{'sphone'} || $column2->{'sadd1'} || $column2->{'sadd2'} || $column2->{'stown'} || $column2->{'scounty'} || $column2->{'spcode'} || $column2->{'scountry'} )
					{
					if ($column2->{'scontact'})
						{
						print qq|$column2->{'scontact'}<br />|;
						}
	
					if ($column2->{'scompany'})
						{
						print qq|$column2->{'scompany'}<br />|; 
						}

					if ($column2->{'sphone'})
						{
						print qq|$column2->{'sphone'}<br />|; 
						}

					if ($column2->{'semail'})
						{
						print qq|$column2->{'semail'}<br />|; 
						}

					if ($column2->{'sadd1'})
						{
						print qq|$column2->{'sadd1'}<br />|;
						}
	
					if ($column2->{'sadd2'})
						{
						print qq|$column2->{'sadd2'}<br />|; 
						}

					if ($column2->{'stown'})
						{
						print qq|$column2->{'stown'}<br />|;
						}

					if ($column2->{'scounty'})
						{
						print qq|$column2->{'scounty'}<br />|;
						}

					if( $column2->{'spcode'} )
						{
						print qq|$column2->{'spcode'}<br />|;
						}

					if ($column2->{'scountry'})
						{
						print qq|$column2->{'scountry'}|;
						}
					}
				else
					{
						print "&nbsp;";
					}	

				
				print "</td>\n";
				print "<td align=\"left\">";

				if( $column2->{'rcontact'} || $column2->{'rcompany'} || $column2->{'rphone'} || $column2->{'remail'} || $column2->{'radd1'} || $column2->{'radd2'} || $column2->{'rtown'} || $column2->{'rcounty'} || $column2->{'rpcode'} || $column2->{'rcountry'} )
					{
					if ($column2->{'rcontact'})
						{
						print qq|$column2->{'rcontact'}<br />|;
						}
	
					if ($column2->{'rcompany'})
						{
						print qq|$column2->{'rcompany'}<br />|; 
						}

					if ($column2->{'rphone'})
						{
						print qq|$column2->{'rphone'}<br />|;
						}

					if ($column2->{'remail'})
						{
						print qq|$column2->{'remail'}<br />|;
						}

					if ($column2->{'radd1'})
						{
						print qq|$column2->{'radd1'}<br />|;
						}
	
					if ($column2->{'radd2'})
						{
						print qq|$column2->{'radd2'}<br />|; 
						}

					if ($column2->{'rtown'})
						{
						print qq|$column2->{'rtown'}<br />|;
						}

					if ($column2->{'rcounty'})
						{
						print qq|$column2->{'rcounty'}<br />|;
						}

					if( $column2->{'rpcode'} )
						{
						print qq|$column2->{'rpcode'}<br />|;
						}

					if ($column2->{'rcountry'})
						{
						print qq|$column2->{'rcountry'}|;
						}
					}
				else
					{
						print "&nbsp;";
					}	
				
				print "</td>\n";

				($carabr, $carname, $srvname) = get_carrier($column2->{'carrier'});

				print "<td align=\"left\">$srvname</td>";

				if( $column2->{'reference'} )
					{ print "<td align=\"left\">$column2->{'reference'}</td>"; }
				else
					{ print "<td align=\"left\">&nbsp;</td>"; }

				print "</tr>\n";
				}
			$sth2->finish;
				
			print qq|
			</table>
			
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
			error_page("Delivery and Shipment not found!");
		}
}


sub printawb{
	unless ($entid) {&error_page("Not valid Delivery and Shipment Ref.!"); exit;} 
	unless ($srid) {&error_page("Not valid SR#!"); exit;} 

	if( $isAdmin )
		{
		$SQL = "SELECT entdetails.entid, sr, hawb, item, value, lvhv, hold, cod, content, currency, scontact, scompany, sphone, semail, sadd1, sadd2, stown, scounty, spcode, sc.country as scountry, rcontact, rcompany, rphone, remail, radd1, radd2, rtown, rcounty, rpcode, rc.country as rcountry, carrier, reference FROM entdetails LEFT JOIN countries AS sc ON sc.id=scountry LEFT JOIN countries AS rc ON rc.id=rcountry WHERE entdetails.entid = $entid AND entdetails.sr = $srid ORDER BY sr"; 
		}
	else
		{
		$SQL = "SELECT entdetails.entid, sr, hawb, item, value, lvhv, hold, cod, content, currency,  scontact, scompany, sadd1, semail, sphone, sadd2, stown, scounty, spcode, sc.country as scountry, rcontact, rcompany, rphone, remail, radd1, radd2, rtown, rcounty, rpcode, rc.country as rcountry, carrier, reference FROM entdetails LEFT JOIN countries AS sc ON sc.id=scountry LEFT JOIN countries AS rc ON rc.id=rcountry RIGHT JOIN entries on entries.entid=entdetails.entid AND entries.userid=$isUser WHERE entdetails.entid = $entid AND entdetails.sr = $srid ORDER BY sr"; 
		}
		
	&my_sql;
	if ($column = $sth->fetchrow_hashref){
		print $form->header;

print qq~
<html>
<head>
<title>HAWB No.: $column->{'hawb'}</title>
</head>
<body>
		<div align="center" valign="middle" style="width: 940px; vertical-align: middle;">
		<img src="img/content/slogan_01.gif" width="235" height="56" style="float: left;" /><span style="float: right;" /><H1>HAWB No.: $column->{'hawb'}</H1></span>
		</div>
		<br />
		<br />
		<br />
		<br />

<font size="2" face="Arial">
	<center>
		<table align="left" border="1" cellpadding="5" cellspacing="0">
		~;
				print qq|
				<tr>
				<td colspan="2">SR#$column->{'sr'}</td>
				</tr>
				<tr>
				<td>HAWB No.:</td><td width="200" align="left">$column->{'hawb'}</td>
				</tr>
				<tr>
				<td>Value:</td><td align="left">$column->{'currency'} $column->{'value'}</td>
				</tr>
				<tr>
				<td>HV/LV:</td>
				|;
				if( $column->{'lvhv'} == 1 )
					{ print qq|<td align="left">LV</td>|; }
				elsif( $column->{'lvhv'} == 2 )
					{ print qq|<td align="left">HV</td>|; }
				elsif( $column->{'lvhv'} == 3 )
					{ print qq|<td align="left">MHV</td>|; }
				elsif( $column->{'lvhv'} == 3 )
					{ print qq|<td align="left">PE</td>|; }
				else
					{ print qq|<td align="left">&nbsp;</td>|; }

				print qq|
				</tr>
				<tr>
				<td>Hold/Unhold:</td>|;
				
				if( $column->{'hold'} == 1 )
					{ print qq|<td align="left">HOLD</td>|; }
				else
					{ print qq|<td align="left">Unhold</td>|; }

				print qq|
				</tr>
				<tr>
				<td>Contents:</td>
				<td align="left">$column->{'content'}</td>
				</tr>
				|;

				if( $column->{'cod'} > 0 )
					{ 
					print qq|
					<tr>
					<td>COD Amount:</td>
					<td align="left">£ $column->{'cod'}</td>
					</tr>
					|; }

				print qq|
				<tr>
				<td>Shipper:</td>
				<td align="left">|;

				if( $column->{'scontact'} || $column->{'scompany'} || $column->{'sphone'} || $column->{'semail'} || $column->{'sadd1'} || $column->{'sadd2'} || $column->{'stown'} || $column->{'scounty'} || $column->{'spcode'} || $column->{'scountry'} )
					{
					if ($column->{'scontact'})
						{
						print qq|$column->{'scontact'}<br />|;
						}
	
					if ($column->{'scompany'})
						{
						print qq|$column->{'scompany'}<br />|; 
						}

					if ($column->{'sphone'})
						{
						print qq|$column->{'sphone'}<br />|;
						}

					if ($column->{'semail'})
						{
						print qq|$column->{'semail'}<br />|;
						}

					if ($column->{'sadd1'})
						{
						print qq|$column->{'sadd1'}<br />|;
						}
	
					if ($column->{'sadd2'})
						{
						print qq|$column->{'sadd2'}<br />|; 
						}

					if ($column->{'stown'})
						{
						print qq|$column->{'stown'}<br />|;
						}

					if ($column->{'scounty'})
						{
						print qq|$column->{'scounty'}<br />|;
						}

					if( $column->{'spcode'} )
						{
						print qq|$column->{'spcode'}<br />|;
						}

					if ($column->{'scountry'})
						{
						print qq|$column->{'scountry'}|;
						}
					}
				else
					{
						print "&nbsp;";
					}	


				print qq|
				</td>
				</tr>
				<tr>
				<td>Receiver:</td>
				<td align="left">
				|;
					
				if( $column->{'rcontact'} || $column->{'rcompany'} || $column->{'remail'} || $column->{'rphone'} || $column->{'radd1'} || $column->{'radd2'} || $column->{'rtown'} || $column->{'rcounty'} || $column->{'rpcode'} || $column->{'rcountry'} )
					{
					if ($column->{'rcontact'})
						{
						print qq|$column->{'rcontact'}<br />|;
						}
	
					if ($column->{'rcompany'})
						{
						print qq|$column->{'rcompany'}<br />|; 
						}

					if ($column->{'rphone'})
						{
						print qq|$column->{'rphone'}<br />|;
						}

					if ($column->{'remail'})
						{
						print qq|$column->{'remail'}<br />|;
						}

					if ($column->{'radd1'})
						{
						print qq|$column->{'radd1'}<br />|;
						}
	
					if ($column->{'radd2'})
						{
						print qq|$column->{'radd2'}<br />|; 
						}

					if ($column->{'rtown'})
						{
						print qq|$column->{'rtown'}<br />|;
						}

					if ($column->{'rcounty'})
						{
						print qq|$column->{'rcounty'}<br />|;
						}

					if( $column->{'rpcode'} )
						{
						print qq|$column->{'rpcode'}<br />|;
						}

					if ($column->{'rcountry'})
						{
						print qq|$column->{'rcountry'}|;
						}
					}
				else
					{
						print "&nbsp;";
					}	

				print qq|
				</td>
				</tr>|;

				if( $column->{'carrier'} != 0 )
					{
					($carabr, $carname, $srvname) = get_carrier($column->{'carrier'});

					print qq|
					<tr>
					<td>Carrier:</td>
					<td align="left">$srvname</td>
					</tr>
					|;
					}

				if( $column->{'reference'} )
					{ 
					print qq|
					<tr>
					<td>Tracking No.:</td>
					<td align="left">$column->{'reference'}</td>
					</tr>|; 
					}
					
				print qq|
				<tr>
				<td>No. of Bags:</td><td align="left">$column->{'item'}</td>
				</tr>|;
				
				$TSQL = "SELECT * FROM bags WHERE entid = $entid AND srid=$srid ORDER BY bagid"; 
				&tmy_sql;
				my $i2 = 0;
				while ($tcolumn = $tsth->fetchrow_hashref)
					{
					$i2++;
					$volweight = toCurr(($tcolumn->{'length'} * $tcolumn->{'width'} * $tcolumn->{'height'}) / 4000);

					print qq|
						<tr>
						<td colspan="2"><center>Bag $i2</center></td></td>
						</tr>
						<tr>
						<td>Bag Reference:</td><td align="left">$tcolumn->{'bag'}</td>
						</tr>
						<tr>
						<td>Weight:</td><td align="left">$tcolumn->{'weight'} <small>Kgs</small></td>
						</tr>
						<tr>
						<td>Volumetric Weight:</td><td align="left">$volweight <small>kg</small></td>
						</tr>
						<tr>
						<td>Size:</td><td align="left">$tcolumn->{'length'} x $tcolumn->{'width'} x $tcolumn->{'height'} <small>cm</small></td>
						</tr>
					|;
					}
				$tsth->finish;
				print "</tr>";
				}
		else
			{
				$sth->finish;
				error_page("SR # not found!");
				exit;
			}

			$sth->finish;
				
			print qq|
			</table>
			
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


sub edit
{
	unless ($entid) {&error_page("Delivery and Shipment Reference is not correct."); exit;} 

&myheader($heading);

&topmenu($heading);

	$SQL = "SELECT * FROM entries WHERE entid=$entid"; 

	&my_sql;

	$column = $sth->fetchrow_hashref;
	
	unless( $column )
		{
		$sth->finish;
		&error_page("Delivery and Shipment not found."); exit;
		}

	unless( $isAdmin || $column->{'userid'} == $isUser ) {&error_page("You don't have enough permission for this operation."); exit;}

	$TSQL = "SELECT max(sr) as maxsr FROM entdetails WHERE entid=$entid AND carrier <> 0";
	&tmy_sql;

	if( $tcolumn = $tsth->fetchrow_hashref )
		{
		$mincount = $tcolumn->{'maxsr'};
		}
	else
		{
		$mincount = 1;
		}
		
	$tsth->finish;

	$SQLS = "SELECT country FROM members WHERE userid=$isUser";
	&my_sqls;
	$usercountry = "";
	if ($columns = $sths->fetchrow_hashref)
		{
		$usercountry = $columns->{'country'};
		}
	$sths->finish;

print qq|<div class="ha8"><h1><font color="#000080" size="1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Edit Delivery and Shipment</font></h1>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Please edit the following information in order to edit the Delivery and Shipment<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Failure to enter the correct data will result in surcharges being billed for you and will delay delivery of your parcel.<br /><br />
<font size="2" face="Arial">
	<form class="nofrm" id="frmawb" name="frm" method="POST" onsubmit="return validateForm(this);" action="$script">
	<input name="ucountry" type="hidden" value="$usercountry" />
	<input name="returnhere" type="hidden" value="0" />
	<input name="entid" type="hidden" value="$entid" />
	<input name="entry" type="hidden" value="2" />
	<input name="cf" type="hidden" value="entry" />
	<input name="fromlist" type="hidden" value="$fromlist" />
	<input name="imported" type="hidden" value="0" />
	<input name="uid" type="hidden" value="$isUser" />
	<input name="cargo_log" type="hidden" value="$column->{'cargolog'}" />
	<input name="flight_log" type="hidden" value="$column->{'flightlog'}" />
	<table style="background-color:#FDF3D0; width: 100%" align="left">
		<tr>
			<td width="50">Date:&nbsp;<br /><span style="vertical-align: top;" />(dd.mm.yy)</span></td>
			<td width="150"><div style="vertical-align: middle;"><input tabindex=1 name="ord_date" type="text" size="8" style="vertical-align: middle; height:18px;" value="$column->{'entdate'}" MAXLENGTH=8 /></div></td>
			<td width="730" rowspan="7"><div style="width:720px; height:155px; padding: 3px; overflow: auto;" id="cargoinf">$column->{'cargolog'}</div><div style="width:720px; height:110px; padding:3px; overflow: auto;" id="flightinf">$column->{'flightlog'}</div></td>
		</tr>
		<tr>
			<td width="50">MAWB:&nbsp;</td>
			<td width="150"><div style="vertical-align: top;"><input tabindex=2 name="ord_awb1" type="text" size="3" value="$column->{'awb1'}" style="height:18px;" MAXLENGTH=3 />&nbsp;<input tabindex=3 name="ord_awb2" type="text" size="8" style="height:18px;" value="$column->{'awb2'}" MAXLENGTH=8 |;
			
			unless( $column->{'clogclosed'} )
				{
				print qq|onblur="fetch_cargo(this.form);"|;
				}
				
			print qq| />&nbsp;&nbsp;</div>
			</td>
		</tr>
		<tr>
			<td width="50">Flight&nbsp;No:&nbsp;</td>
			<td width="150"><input tabindex=4 name="ord_flight" type="text" style="height:18px;" size="10" value="$column->{'flight'}" |;
			
			unless( $column->{'fclogclosed'} )
				{
				print qq|onblur="fetch_flight(this.form);"|;
				}
				
			print qq| /></td>
		</tr>
		<tr>
			<td width="50">Total&nbsp;Weight:&nbsp;<span class="text2">*</span></td>
			<td width="150"><input tabindex=5 name="ord_totw" type="text" size="10" style="height:18px;" value="$column->{'totw'}" /></td>
		</tr>
		<tr>
			<td width="50">Total&nbsp;Bags:&nbsp;</td>
			<td width="150"><input tabindex=6 name="ord_totb" type="text" size="10" style="height:18px;" value="$column->{'totb'}" /></td>
		</tr>
		<tr>
			<td width="50">No.&nbsp;of&nbsp;SRs:&nbsp;</td>
			<td width="150"><select tabindex=7 name="ord_hawbcount" style="height:20px; width:50px;" onChange="ChangeHAWB(this.options[this.selectedIndex].text);">
			|;
			
			for( $i = $mincount ; $i <= 500 ; $i++ )
				{
				if( $i == $column->{'habwcount'} )
					{
					print qq|<option value="$i" selected>$i</option>|;
					}
				else
					{
					print qq|<option value="$i">$i</option>|;
					}
				}
			
			print qq|</select></td>
		</tr>
		<tr>
		<td width="100%" colspan="3">
<DIV ID="divHAWB">
</DIV>

<script language="Javascript">
var strord = "";
var t = 8;
var j;
strord = strord + "<table width=\\\"100%\\\" border=\\\"0\\\" style=\\\"font-style:normal;font-family:Arial;font-size:11px;line-height:20px;\\\">";
strord = strord + "<tr><td width=\\\"42%\\\">HAWB Details</td><td width=\\\"29%\\\">Shipper</td><td width=\\\"29%\\\">Receiver</td></tr>";
strord = strord + "<tr><td colspan=\\\"3\\\" height=\\\"10\\\"><hr width=\\\"100%\\\" size=\\\"1\\\" noshade></td></tr>";
|;

	$sth=>finish;
	$SQL = "SELECT entdetails.entid,entdetails.sr,hawb,item,value,lvhv,hold,cod,content,currency, scontact, scompany, sphone, semail, sadd1, sadd2, stown, scounty, spcode, scountry, rcontact, rcompany, remail, rphone, radd1, radd2, rtown, rcounty, rpcode, rcountry,carrier,reference FROM entdetails WHERE entdetails.entid=$entid order by sr"; 
	&my_sql;

	$hawbrow = 0;
	while( $column = $sth->fetchrow_hashref )
		{
		$hawbrow++;
		if( $column->{'carrier'} )
			{
			$readonlymsg = " DISABLED ";
			$readonlyval = "1";
			}
		else
			{
			$readonlymsg = "";
			$readonlyval = "0";
			}
		print qq|	
			strord = strord + "<tr><td width=\\\"42%\\\"><input name=\\\"msg[$hawbrow]\\\" type=\\\"hidden\\\" value=\\\"\\\" />";
			strord = strord + "<input name=\\\"dis[$hawbrow]\\\" type=\\\"hidden\\\" value=\\\"$readonlyval\\\" />";
			strord = strord + "<span style=\\\"vertical-align:middle; position:relative; top:-2px;left:0px;\\\"><b>SR#$hawbrow</b></span><br />";
			strord = strord + "<span style=\\\"vertical-align:middle; position:relative; top:-2px; left:0px;\\\">HAWB#:</span><Input tabindex=" + t++ + " $readonlymsg type=\\\"text\\\" name=\\\"hawb[$hawbrow]\\\" MAXLENGTH=20 style=\\\"vertical-align:middle; position:relative; top:0px;left:5px;width:85px;height:18px;line-height:10px;\\\" value=\\\"$column->{'hawb'}\\\" /><br />";
			|;

		$tmp_c1 = "";
		$tmp_c2 = "";
		$tmp_c3 = "";
		if( $column->{'currency'} eq "\$" )
			{
			$tmp_c1 = "selected";
			}
		elsif( $column->{'currency'} eq "£" )
			{
			$tmp_c2 = "selected";
			}
		elsif( $column->{'currency'} eq "€" )
			{
			$tmp_c3 = "selected";
			}
	
		$tmp_h1 = "";
		if( $column->{'hold'}  )
			{
			$tmp_h1 = "checked";
			}
	
		$tmp_l1 = "";
		$tmp_l2 = "";
		$tmp_l3 = "";
		$tmp_l4 = "";
		$tmp_l5 = "";
		if( $column->{'lvhv'} == 0  )
			{
			$tmp_l1 = "selected";
			}
		elsif( $column->{'lvhv'} == 1  )
			{
			$tmp_l2 = "selected";
			}
		elsif( $column->{'lvhv'} == 2  )
			{
			$tmp_l3 = "selected";
			}
		elsif( $column->{'lvhv'} == 3  )
			{
			$tmp_l4 = "selected";
			}
		elsif( $column->{'lvhv'} == 4  )
			{
			$tmp_l5 = "selected";
			}
	
		print qq~
		strord = strord + "<span style=\\\"vertical-align:middle; position:relative; top:-2px;left:0px;\\\">HV/LV:</span><select tabindex=" + t++ + " $readonlymsg name=\\\"lvhv[$hawbrow]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:10px;width:150px;height:20px;\\\"><option value=\\\"\\\" $tmp_l1>Please Select...</option><option value=\\\"LV\\\" $tmp_l2>Low Value</option><option value=\\\"HV\\\" $tmp_l3>High Value</option><option value=\\\"MHV\\\" $tmp_l4>Medium Hight Value</option><option value=\\\"PE\\\" $tmp_l5>Personal Effects</option></select><br />";
		strord = strord + "<span style=\\\"vertical-align:middle; position:relative; top:-2px;left:0px;\\\">Value:</span><select tabindex=" + t++ + " $readonlymsg style=\\\"vertical-align:middle; position:relative; top:1px;left:14px;width:38px;height:20px;\\\" name=\\\"currency[$hawbrow]\\\" width=\\\"20\\\" ><option value=\\\"\\\$\\\" $tmp_c1>\\\$</option><option value=\\\"£\\\" $tmp_c2>£</option><option value=\\\"€\\\" $tmp_c3>€</option></select>";
		strord = strord + "<Input tabindex=" + t++ + " $readonlymsg type=\\\"text\\\" name=\\\"value[$hawbrow]\\\" style=\\\"vertical-align:middle; position:relative; top:3px;left:19px;width:50px;height:18px;\\\" value=\\\"$column->{'value'}\\\" /><br />";
		strord = strord + "<Input tabindex=" + t++ + " $readonlymsg type=\\\"checkbox\\\" name=\\\"hold[$hawbrow]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:-3px; border: none;\\\" value=\\\"HOLD\\\" $tmp_h1 /><span style=\\\"vertical-align:middle; position:relative; top:-2px;left:3px;\\\">Hold It&nbsp;&nbsp;&nbsp;(If selected, this HAWB is not shipped to the receiver)</span><br />";
		strord = strord + "<span style=\\\"vertical-align:middle; position:relative; top:-2px;left:0px;\\\">Content:</span><Input tabindex=" + t++ + " $readonlymsg type=\\\"text\\\" name=\\\"content[$hawbrow]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:6px;width:324px;height:18px;\\\" value=\\\"$column->{'content'}\\\" /><br />";
		strord = strord + "<span style=\\\"vertical-align:middle; position:relative; top:-2px;left:0px;\\\">COD Amount:&nbsp;&nbsp;£</span><Input tabindex=" + t++ + " $readonlymsg type=\\\"text\\\" name=\\\"cod[$hawbrow]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:2px;width:35px;height:18px;\\\" value=\\\"$column->{'cod'}\\\" /><span style=\\\"vertical-align:middle; position:relative; top:-3px;left:10px;\\\"><font style=\\\"vertical-align:middle; top:-3px;font-size:9px;\\\">(Optional)</font></span><br />";
		strord = strord + "<span style=\\\"vertical-align:middle; position:relative; top:-2px;left:0px;\\\">No. of Bags:</span><select tabindex=" + t++ + " $readonlymsg name=\\\"item[$hawbrow]\\\" style=\\\"vertical-align:middle; position:relative; top:-2px;left:19px;width:39px;height:20px;\\\" onChange=\\\"ChangeBags(this.form,$hawbrow, " + t + ")\\\"><br />";
	
		for( j = 1 ; j <= 20 ; j++ )
			{
			strord = strord + "<option value=\\\"" + j + "\\\" " + ((j == $column->{'item'} )? "selected" : "") + ">" + j + "</option>\\n";
			}
	
		strord = strord + "</select><br />";
	
		strord = strord + "<div ID=\\\"divItem[$hawbrow]\\\">";
		~;

		$SQL2 = "SELECT * FROM bags WHERE entid=$entid and srid=$column->{'sr'} order by bagid"; 
		&my_sql2;
		$j = 1;	
		while( $column2 = $sth2->fetchrow_hashref )
			{
			$volweight = toCurr(($column2->{'length'} * $column2->{'width'} * $column2->{'height'}) / 4000);

			if( j < 10 )
				{
				print qq~
				strord = strord + "<span style=\\\"vertical-align:middle; position:relative; top:-2px;left:0px;\\\">Bag " + $j + "</span>";
				strord = strord + "<span style=\\\"vertical-align:middle; position:relative; top:-2px;left:5px;\\\">Weight:</span><Input tabindex=" + t++ + " $readonlymsg type=\\\"text\\\" name=\\\"weight[$hawbrow]["+ $j +"]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:15px;width:35px;height:18px;\\\" onChange=\\\"CalculateTweight(this.form)\\\" value=\\\"$column2->{'weight'}\\\" /><span style=\\\"vertical-align:middle; position:relative; top:-2px;left:20px;\\\"><FONT style=\\\"font-size:9px;\\\">kg</FONT></span>";
				strord = strord + "<span style=\\\"vertical-align:middle; position:relative; top:-2px;left:45px;\\\">Bag Ref.:</span><Input tabindex=" + t++ + " $readonlymsg type=\\\"text\\\" name=\\\"bags[$hawbrow]["+ $j +"]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:55px;width:20px;height:18px;\\\" value=\\\"$column2->{'bag'}\\\" />";
				strord = strord + "<span style=\\\"vertical-align:middle; position:relative; top:-2px;left:87px;\\\">Vol. Weight:</span><Input DISABLED type=\\\"text\\\" name=\\\"vweight[$hawbrow]["+ $j +"]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:94px;width:35px;height:18px;color:#000000;background-color:#EEEEEE\\\" value=\\\"$volweight\\\" /><span style=\\\"vertical-align:middle; position:relative; top:-2px;left:97px;\\\"><FONT style=\\\"font-size:9px;\\\">kg</FONT></span><br />";
				strord = strord + "<span style=\\\"vertical-align:middle; position:relative; top:-2px;left:33px;\\\">Length:</span><Input tabindex=" + t++ + " $readonlymsg type=\\\"text\\\" name=\\\"length[$hawbrow]["+ $j +"]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:43px;width:35px;height:18px;\\\" onChange=\\\"CalculateTweight(this.form)\\\" value=\\\"$column2->{'length'}\\\" /><span style=\\\"vertical-align:middle; position:relative; top:-2px;left:48px;\\\"><FONT style=\\\"font-size:9px;\\\">cm</FONT></span>";
			 	strord = strord + "<span style=\\\"vertical-align:middle; position:relative; top:-2px;left:70px;\\\">Width:</span><Input tabindex=" + t++ + " $readonlymsg type=\\\"text\\\" name=\\\"width[$hawbrow]["+ $j +"]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:80px;width:35px;height:18px;\\\" onChange=\\\"CalculateTweight(this.form)\\\" value=\\\"$column2->{'width'}\\\" /><span style=\\\"vertical-align:middle; position:relative; top:-2px;left:82px;\\\"><FONT style=\\\"font-size:9px;\\\">cm</FONT></span>";
				strord = strord + "<span style=\\\"vertical-align:middle; position:relative; top:-2px;left:123px;\\\">Height:</span><Input tabindex=" + t++ + " $readonlymsg type=\\\"text\\\" name=\\\"height[$hawbrow]["+ $j +"]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:130px;width:35px;height:18px;\\\" onChange=\\\"CalculateTweight(this.form)\\\" value=\\\"$column2->{'height'}\\\" /><span style=\\\"vertical-align:middle; position:relative; top:-2px;left:132px;\\\"><FONT style=\\\"font-size:9px;\\\">cm</FONT></span><br />";
				~;
				}
			else
				{
				print qq~
				strord = strord + "<span style=\\\"vertical-align:middle; position:relative; top:-2px;left:0px;\\\">Bag " + $j + "</span>";
				strord = strord + "<span style=\\\"vertical-align:middle; position:relative; top:-2px;left:5px;\\\">Weight:</span><Input tabindex=" + t++ + " $readonlymsg type=\\\"text\\\" name=\\\"weight[$hawbrow]["+ $j +"]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:9px;width:35px;height:18px;\\\" onChange=\\\"CalculateTweight(this.form)\\\" value=\\\"$column2->{'weight'}\\\" /><span style=\\\"vertical-align:middle; position:relative; top:-2px;left:14px;\\\"><FONT style=\\\"font-size:9px;\\\">kg</FONT></span>";
				strord = strord + "<span style=\\\"vertical-align:middle; position:relative; top:-2px;left:40px;\\\">Bag Ref.:</span><Input tabindex=" + t++ + " $readonlymsg type=\\\"text\\\" name=\\\"bags[$hawbrow]["+ $j +"]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:49px;width:20px;height:18px;\\\" value=\\\"$column2->{'bag'}\\\" />";
				strord = strord + "<span style=\\\"vertical-align:middle; position:relative; top:-2px;left:79px;\\\">Vol. Weight:</span><Input DISABLED type=\\\"text\\\" name=\\\"vweight[$hawbrow]["+ $j +"]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:86px;width:35px;height:18px;color:#000000;background-color:#EEEEEE\\\" value=\\\"$volweight\\\" /><span style=\\\"vertical-align:middle; position:relative; top:-2px;left:89px;\\\"><FONT style=\\\"font-size:9px;\\\">kg</FONT></span><br />";
				strord = strord + "<span style=\\\"vertical-align:middle; position:relative; top:-2px;left:33px;\\\">Length:</span><Input tabindex=" + t++ + " $readonlymsg type=\\\"text\\\" name=\\\"length[$hawbrow]["+ $j +"]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:43px;width:35px;height:18px;\\\" onChange=\\\"CalculateTweight(this.form)\\\" value=\\\"$column2->{'length'}\\\" /><span style=\\\"vertical-align:middle; position:relative; top:-2px;left:48px;\\\"><FONT style=\\\"font-size:9px;\\\">cm</FONT></span>";
			 	strord = strord + "<span style=\\\"vertical-align:middle; position:relative; top:-2px;left:70px;\\\">Width:</span><Input tabindex=" + t++ + " $readonlymsg type=\\\"text\\\" name=\\\"width[$hawbrow]["+ $j +"]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:80px;width:35px;height:18px;\\\" onChange=\\\"CalculateTweight(this.form)\\\" value=\\\"$column2->{'width'}\\\" /><span style=\\\"vertical-align:middle; position:relative; top:-2px;left:82px;\\\"><FONT style=\\\"font-size:9px;\\\">cm</FONT></span>";
				strord = strord + "<span style=\\\"vertical-align:middle; position:relative; top:-2px;left:123px;\\\">Height:</span><Input tabindex=" + t++ + " $readonlymsg type=\\\"text\\\" name=\\\"height[$hawbrow]["+ $j +"]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:130px;width:35px;height:18px;\\\" onChange=\\\"CalculateTweight(this.form)\\\" value=\\\"$column2->{'height'}\\\" /><span style=\\\"vertical-align:middle; position:relative; top:-2px;left:132px;\\\"><FONT style=\\\"font-size:9px;\\\">cm</FONT></span><br />";
				~;
				}
				$j++;
			}
	
		$sth2->finish;
		
		print qq~
		strord = strord + "</div>";
	
		strord = strord + "</td><td width=\\\"29%\\\">";
		strord = strord + "Country:<select tabindex=" + t++ + " name=\\\"scountry[$hawbrow]\\\" style=\\\"vertical-align:middle; position:relative; top:-3px;left:10px;width:204px;height:20px;\\\" $readonlymsg>";
		strord = strord + "~;
	
		&get_countries($column->{'scountry'}, 1);
		
		print qq~";
		strord = strord + "</select>";
		strord = strord + "PostCode:<Input tabindex=" + t++ + " $readonlymsg type=\\\"text\\\" name=\\\"spcode[$hawbrow]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:2px;width:200px;height:18px;\\\" value=\\\"$column->{'spcode'}\\\" /><br />";
		strord = strord + "Contact:<Input tabindex=" + t++ + " $readonlymsg type=\\\"text\\\" name=\\\"scontact[$hawbrow]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:11px;width:200px;height:18px;\\\" value=\\\"$column->{'scontact'}\\\" /><br />";
		strord = strord + "Company:<Input tabindex=" + t++ + " $readonlymsg type=\\\"text\\\" name=\\\"scompany[$hawbrow]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:3px;width:200px;height:18px;\\\" value=\\\"$column->{'scompany'}\\\" /><br />";
		strord = strord + "Phone:<Input tabindex=" + t++ + " $readonlymsg type=\\\"text\\\" name=\\\"sphone[$hawbrow]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:18px;width:200px;height:18px;\\\" value=\\\"$column->{'sphone'}\\\" /><br />";
		strord = strord + "Email:<Input tabindex=" + t++ + " $readonlymsg type=\\\"text\\\" name=\\\"semail[$hawbrow]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:24px;width:200px;height:18px;\\\" value=\\\"$column->{'semail'}\\\" /><br />";
		strord = strord + "Add 1:<Input tabindex=" + t++ + " $readonlymsg type=\\\"text\\\" name=\\\"sadd1[$hawbrow]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:19px;width:200px;height:18px;\\\" value=\\\"$column->{'sadd1'}\\\" /><br />";
		strord = strord + "Add 2:<Input tabindex=" + t++ + " $readonlymsg type=\\\"text\\\" name=\\\"sadd2[$hawbrow]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:19px;width:200px;height:18px;\\\" value=\\\"$column->{'sadd2'}\\\" /><br />";
		strord = strord + "Town:<Input tabindex=" + t++ + " $readonlymsg type=\\\"text\\\" name=\\\"stown[$hawbrow]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:20px;width:200px;height:18px;\\\" value=\\\"$column->{'stown'}\\\" /><br />";
		strord = strord + "County:<Input tabindex=" + t++ + " $readonlymsg type=\\\"text\\\" name=\\\"scounty[$hawbrow]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:14px;width:200px;height:18px;\\\" value=\\\"$column->{'scounty'}\\\" /><br />";
		strord = strord + "</td><td width=\\\"29%\\\">";
		strord = strord + "Country:<select tabindex=" + t++ + " name=\\\"rcountry[$hawbrow]\\\" style=\\\"vertical-align:middle; position:relative; top:-3px;left:10px;width:204px;height:20px;\\\" $readonlymsg>"
		strord = strord + "~;
		
		&get_countries($column->{'rcountry'}, 2); 
		
		print qq~";
		strord = strord + "</select>";
		strord = strord + "PostCode:<Input tabindex=" + t++ + " $readonlymsg type=\\\"text\\\" name=\\\"rpcode[$hawbrow]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:2px;width:200px;height:18px;\\\" value=\\\"$column->{'rpcode'}\\\" /><br />";
		strord = strord + "Contact:<Input tabindex=" + t++ + " $readonlymsg type=\\\"text\\\" name=\\\"rcontact[$hawbrow]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:11px;width:200px;height:18px;\\\" value=\\\"$column->{'rcontact'}\\\" /><br />";
		strord = strord + "Company:<Input tabindex=" + t++ + " $readonlymsg type=\\\"text\\\" name=\\\"rcompany[$hawbrow]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:3px;width:200px;height:18px;\\\" value=\\\"$column->{'rcompany'}\\\" /><br />";
		strord = strord + "Phone:<Input tabindex=" + t++ + " $readonlymsg type=\\\"text\\\" name=\\\"rphone[$hawbrow]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:18px;width:200px;height:18px;\\\" value=\\\"$column->{'rphone'}\\\" /><br />";
		strord = strord + "Email:<Input tabindex=" + t++ + " $readonlymsg type=\\\"text\\\" name=\\\"remail[$hawbrow]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:24px;width:200px;height:18px;\\\" value=\\\"$column->{'remail'}\\\" /><br />";
		strord = strord + "Add 1:<Input tabindex=" + t++ + " $readonlymsg type=\\\"text\\\" name=\\\"radd1[$hawbrow]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:19px;width:200px;height:18px;\\\" value=\\\"$column->{'radd1'}\\\" /><br />";
		strord = strord + "Add 2:<Input tabindex=" + t++ + " $readonlymsg type=\\\"text\\\" name=\\\"radd2[$hawbrow]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:19px;width:200px;height:18px;\\\" value=\\\"$column->{'radd2'}\\\" /><br />";
		strord = strord + "Town:<Input tabindex=" + t++ + " $readonlymsg type=\\\"text\\\" name=\\\"rtown[$hawbrow]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:20px;width:200px;height:18px;\\\" value=\\\"$column->{'rtown'}\\\" /><br />";
		strord = strord + "County:<Input tabindex=" + t++ + " $readonlymsg type=\\\"text\\\" name=\\\"rcounty[$hawbrow]\\\" style=\\\"vertical-align:middle; position:relative; top:0px;left:14px;width:200px;height:18px;\\\" value=\\\"$column->{'rcounty'}\\\" /><br />";
		strord = strord + "</td></tr><tr><td colspan=\\\"3\\\" height=\\\"10\\\"><hr width=\\\"100%\\\" size=\\\"1\\\" noshade></td></tr>";
		~;
		}

	$sth->finish;
	
	print qq|
	strord = strord + "</table>";

	document.getElementById('divHAWB').innerHTML = strord;

</script>
		
		</td>
		</tr>
		<tr>
		<td width="100%" colspan="3" align="center">
		<center><br /><input name="submit1" type="submit" value=" Save & Finish " size="30" onClick="document.frm.returnhere.value='0';" />&nbsp;&nbsp;&nbsp;&nbsp;<input name="submit2" type="submit" value=" Save & Continue " size="30" onClick="document.frm.returnhere.value='1';" /></center>

		</td>
		</tr>
		</table>
&nbsp;

	</form>
</div>
|;

&footer;

}

sub csv
{
	my $csvtype = shift;
	
	unless ($entid) {&error_page("Delivery and Shipment Reference is not correct."); exit;} 
	unless( $isAdmin ) {&error_page("You don't have enough permission for this operation."); exit;}

	print "Content-type: application/text\n"; 
	print "Content-disposition: attachment; filename=$csvtype.CSV\n\n"; 
	
	print qq|hawb, bag Mixed, NAME, ADDRESS 1, ADDRESS2, TOWN, COUNTY, Postcode, Country,  J, K, L, M
|;

#	$SQL = "SELECT sr,hawb,hold,item,lvhv,currency,value, rcontact, rcompany, radd1, radd2, rtown, rcounty, rpcode, rcountry, countries.abbr as rcoabbr, zones.origzone, cb_pervalue, cb_fixcharge, cb_cardcharge, cb_agentshare, cb_cbafter FROM entdetails LEFT JOIN countries ON countries.id=entdetails.rcountry left join services on estcar=services.id left join carriers on services.carid=carriers.id left join zones on estcar=zones.servid and zones.countrys=221 and  rcountry=zones.countryd WHERE estcar <> 0 and carriers.abbr='$csvtype' AND entdetails.entid=$entid AND csved='' AND hold=0 AND (ispaid=1 or ((lvhv=1 or lvhv=3) and cod=0 and ((currency='£' and value <= 18) or (currency='€' and value * $s_euro <= 18) or (currency='\$' and value * $s_usd <= 18)))) order by sr"; 
	$SQL = "SELECT sr,hawb,hold,item,lvhv,currency,value, rcontact, rcompany, radd1, radd2, rtown, rcounty, rpcode, rcountry, countries.abbr as rcoabbr, zones.origzone, cb_pervalue, cb_fixcharge, cb_cardcharge, cb_agentshare, cb_cbafter FROM entdetails LEFT JOIN countries ON countries.id=entdetails.rcountry left join services on estcar=services.id left join carriers on services.carid=carriers.id left join zones on estcar=zones.servid and zones.countrys=221 and  rcountry=zones.countryd WHERE estcar <> 0 and carriers.abbr='$csvtype' AND entdetails.entid=$entid AND csved='' AND hold=0 AND (ispaid=1 or ((lvhv=1 or lvhv=2 or lvhv=3) and cod=0)) order by sr"; 
	&my_sql;

	$hawbrow = 0;
	$lastsr = "";
	while( $column = $sth->fetchrow_hashref )
		{
		my ($wv, $srbag, $vvv);
		my ($pervalue, $fixcharge, $cardcharge, $agentshare, $cbafter);
		
		$srbag = "";

		$SQL2 = "SELECT epxcb FROM members WHERE userid=$uid";
		&my_sql2;
		$column2 = $sth2->fetchrow_hashref;
		$epxcbstatus = $column2->{'epxcb'};
		$sth2->finish;

		if( $epxcbstatus )
			{
			if( $column->{'lvhv'} eq "1" )
				{
				$vvv = "l";
				}
			elsif( $column->{'lvhv'} eq "3" )
				{
				$vvv = "m";
				}
			else
				{
				$vvv = "";
				}
			}
		else
			{
			$vvv = "";
			}

		$TSQL = "SELECT bag, weight, length, width, height FROM bags WHERE entid=$entid AND srid=$column->{'sr'} ORDER BY bag";
		&tmy_sql;
		$tot_wv = 0;
		while( $tcolumn = $tsth->fetchrow_hashref )
			{
			$wv = toCurr(($tcolumn->{'length'} * $tcolumn->{'width'} * $tcolumn->{'height'}) / 4000);
			$wv = ($tcolumn->{'weight'} + 1 - 1) if( ($tcolumn->{'weight'} + 1 - 1) > $wv );
			$tot_wv = $tot_wv + $wv;

			$SQL2 = "SELECT count(bag) as bagcount FROM bags WHERE entid=$entid AND bag=$tcolumn->{'bag'}";
			&my_sql2;
			$column2 = $sth2->fetchrow_hashref;
			if( $column2->{'bagcount'} == 1 )
				{
				$srbag = $srbag . "\\" . $tcolumn->{'bag'};
				}
			else
				{
				$srbag = $srbag . "\\M" . $tcolumn->{'bag'};
				}
			$sth2->finish;
			}
		$tsth->finish;
		
		if( substr($srbag, 0, 1) eq "\\" )
			{
			$srbag = substr($srbag, 1);
			}

		if( $csvtype eq "DPD" )
			{
			print qq|EXP$column->{'hawb'},|;
			print qq|$srbag,|;
			print qq|$column->{'rcontact'},|;
			print qq|$column->{'radd1'},|;
			print qq|$column->{'radd2'},|;
			print qq|$column->{'rtown'},|;
			print qq|$column->{'rcounty'},|;
			print qq|$column->{'rpostcode'},|;
			print qq|$column->{'rcoabbr'},|;
			if( $column->{'rcoabbr'} eq "GB" || $column->{'rcoabbr'} eq "IE" )
				{
				print qq|1,|;
				}
			else
				{
				print qq|5,|;
				}
			print qq|$column->{'item'},|;
			if( $column->{'rcoabbr'} eq "GB" )
				{
				if( $tot_wv <= 3 )
					{
					print qq|32,|;
					}
				else
					{
					print qq|12,|;
					}
				}
			elsif( ($column->{'rcoabbr'} eq "IE" || $column->{'origzone'} eq "1") && $tot_wv <= 3 )
				{
				print qq|32,|;
				}
			else
				{
				print qq|19,|;
				}
	
	
			print qq|$tot_wv,
|;
			$SQL2 = "UPDATE entdetails SET csved='P' WHERE entid=$entid AND srid=$column->{'sr'}";
			}
		else
			{
			$SQL2 = "UPDATE entdetails SET csved='H' WHERE entid=$entid AND srid=$column->{'sr'}";
			}
		&my_sql2;
		$sth2->finish;
		
		if( $vvv )
			{
			$mustpay = 0;
	
			if( $vvv eq "l" )
				{
				$_vvv = "lvitems";
				}
			else
				{
				$_vvv = "mvitems";
				}
		
			if( $column->{'cb_cbafter'} )
				{
				$SQL2 = "SELECT $_vvv as lvmvcount FROM entries WHERE entid=$entid";
				&my_sql2;
				if ($column2 = $sth2->fetchrow_hashref)
					{
					if( $column2->{'lvmvcount'} + 1 >= $column->{'cb_cbafter'} )
						{
						$mustpay = 1;
						}
					else
						{
						$mustpay = 0;
						}
					}
				$sth2->finish;
				}
			else
				{
				$mustpay = 1;
				}
			
			if( $mustpay )
				{
				my $val_curred = 1;
				
				if( $column->{'currency'} eq "£" )
					{
					$val_curred = $column->{'value'};
					}
				elsif( $column->{'currency'} eq "\$" )
					{
					$val_curred = $column->{'value'} * $s_usd;
					}
				elsif( $column->{'currency'} eq "€" )
					{
					$val_curred = $column->{'value'} * $s_euro;
					}
				
				my $cod2 = (($column->{'cb_pervalue'} * $val_curred) / 100) + $column->{'cb_fixcharge'};
				$cod2 =  $cod2 + (($cod2 * $column->{'cd_cardcharge'}) / 100);
	
				$SQL2 = "INSERT INTO accounts (accid, userid, adate, amount, atype, aref, asubref, asubrefstr, adesc) VALUES (0, $uid, CURRENT_TIMESTAMP(), $cod2, 'C', $entid, $column->{'sr'}, '$column->{'hawb'}', 'Credit added for Cah Back for Entry Ref. $entid SR# $column->{'sr'} (HAWB# $column->{'hawb'}).' )";
				&my_sql2;
				$sth2->finish;
				}

			$SQL2 = "UPDATE entries SET $_vvv=$_vvv+1 WHERE entid=$entid";
			&my_sql2;
			$sth2->finish;
			}
		}
		
$sth->finish;
}
1;
