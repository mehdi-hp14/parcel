$heading="book";

use CGI;
use LWP::UserAgent;
use CGI qw/:standard/;
use CGI qw(param);
use CGI::Cookie;
use HTTP::Cookies;
use POSIX qw(ceil floor);

sub home{
}

sub book1{

&myheader($heading);

&topmenu($heading);

print qq~
<script type="text/javascript" src="parcel1.js"></script>

<script type="text/javascript" src="parcel2.js"></script>

<script type="text/javascript" src="parcel3.js"></script>

<div class="ha8"><H1><font color="#000080" size="2"><b>Parcel Delivery - UK and Worldwide</b></font></H1>
<h2><font color="#000080" size="2"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Shipment Details (Step 1 of 6)</b></font></h2>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Please choose your delivery source and destination countries below.<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Each additional delivery address will need to be booked separately.<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Failure to enter the correct weight and dimensions will result in surcharges<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;being billed to your card and will delay delivery of your parcel.<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;You can choose parcel delivery, pallet delivery or document delivery.<br /><br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Note1: You must specify the post code if the country is UK.</b><br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Note1: You should fill in only post code <u>OR</u> city of the source and destination for other countries.</b><br /><br />
 	 
<form name="frm" method="POST" onsubmit="return validateForm(this);" action="$script">
<font size="2" face="Arial">
	<input name="book" type="hidden" value="2" />
	<input name="cf" type="hidden" value="book" />
	<table style="background-color:#FDF3D0; width: 100%" align="left" class="frm">
		<tr>
			<td style="width: 150px">Source </td>
			<td style="width: 850px"><div style="float:left;">&nbsp;&nbsp;&nbsp;<select style="height:20px; width:200px;" name="id_source" onchange="countrycheck(this, 1);">~;
			
			&get_countries;
			
			print qq|
</select></div><div style="float:left;" id="id_source_postcode">&nbsp;&nbsp;&nbsp;Post Code:&nbsp;<input name="id_postcodeS" type="text" SIZE=8 MAXLENGTH=8 style="vertical-align: middle; height: 18px;" value="" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#FF0000"><u>OR</u></font></u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Village/Town/City:&nbsp;<input name="id_cityS" type="text" SIZE=20 style="vertical-align: middle; height: 18px;" value="" /></div>			
</td>
		</tr>
		<tr>
			<td style="width: 150px">Destination </td>
			<td style="width: 850px"><div style="float:left;">&nbsp;&nbsp;&nbsp;<select style="height:20px; width:200px;" name="id_dest" onchange="countrycheck(this, 2);">|;
			
			&get_countries;
			
			print qq|
</select></div><div style="float:left;" id="id_dest_postcode">&nbsp;&nbsp;&nbsp;Post Code:&nbsp;<input name="id_postcodeD" type="text" SIZE=8 MAXLENGTH=8 style="vertical-align: middle; height: 18px;" value="" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#FF0000"><u>OR</u></font></u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Village/Town/City:&nbsp;<input name="id_cityD" type="text" SIZE=20 style="vertical-align: middle; height: 18px;" value="" /></div>
</td>
		</tr>

		<tr>
			<td style="width: 150px">Content </td>
			<td style="width: 850px">&nbsp;
			<Input type="radio" name="trans" style="border:0px;width:15px;height:15px;vertical-align: middle;" value="2" />Document&nbsp;
			<Input type="radio" name="trans" style="border:0px;width:15px;height:15px;vertical-align: middle;" value="4" checked />Parcel&nbsp;
			<Input type="radio" name="trans" style="border:0px;width:15px;height:15px;vertical-align: middle;" value="1" />Pallet&nbsp;<br />
			</td>
		</tr>
		<tr>
			<td style="width: 150px">Package Contents: </td>
			<td style="width: 850px">&nbsp;&nbsp;
			<Input type="text" name="content" style="width:200px;height:18px;vertical-align: middle;" value=""/>&nbsp;&nbsp;<a href="javascript:ShowWin_contenthelp()"><img src="img/content/help.gif" width="16" height="16" border="0"></a>&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" name="prohibited" value="1" style="border:0px;width:15px;height:15px;vertical-align: middle;">&nbsp;I have read and agree to the <a href="javascript:ShowWin_prohibitedl()">Terms &amp; Conditions</a></td>
			</tr>
			<tr>
			<td style="width: 150px">Value </td>
			<td style="width: 850px">
			£&nbsp;<Input type="text" name="val" style="width:50px;height:18px;vertical-align: middle;" value=""/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			Insurance Cover:&nbsp;&nbsp;<select name="insurance"><option value="0" selected>No Insurance</option><option value="50">£50</option><option value="100">£100</option><option value="250">£250</option><option value="500">£500</option><option value="750">£750</option><option value="1000">£1000</option></select>&nbsp;&nbsp;<a href="javascript:ShowWin_insuranhelp()"><img src="img/content/help.gif" width="16" height="16" border="0"></a>
			</td>
		</tr>

		<tr>
			<td style="width: 150px">Number of Packages </td>
			<td style="width: 850px"><div style="float:left;">&nbsp;&nbsp;&nbsp;<select name="packagecount" style="height:20px; width:60px;" onChange="ChangePackages(this.options[this.selectedIndex].text);">|;
			
			print qq|<option value="1" selected>1</option>|;
			for( $i = 2 ; $i <= 99 ; $i++ )
				{
				print qq|<option value="$i">$i</option>|;
				}
			
			print qq|</select></div><div style="float:right;"><div style="float:right;"><div style="float:left;"><br />Volume Metric Formula:&nbsp;&nbsp;</div>(Length * Width * Height)<br /><hr size="1" width="150" noshade><center>4000</center></div></div></td>
		</tr>
		<tr>
		<td colspan="2">
<DIV ID="divPackages">
</DIV>

<script>ChangePackages(1);</script>
		
		</td>
		</tr>
		<tr>
		<td colspan="2" align="center">
		<center><br /><input name="submit1" type="submit" value="Next" size="20" /></center>
		</td>
		</tr>
		</table>
&nbsp;

</font>
</form>

</div>

<!-- SEO Monitor by MyPagerank.Net -->
<center><a href="http://www.mypagerank.net/seomonitor-45940.html" target="_blank"><img src="http://www.mypagerank.net/services/seomonitor/seomonitor.php?aut=45940" title="SEO Monitor by MyPagerank.Net"  border="0" /></a></center>
<!-- SEO Monitor by MyPagerank.Net -->

<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-11377768-1");
pageTracker._trackPageview();
} catch(err) {}</script>
|;
&footer($heading);

}

sub AdjustHighlands
{
	my ($country, $pb) = @_;

	if( $country != 221 )
		{
		return $country;
		}

	if( InPostCode("FK17-99,G83,IV1-28,IV33-39,KW1-99,PA21-33,PA35-40,PH3-26,PH30,PH31-44,HS1-9,IV40-51,IV55-56,KA27,KA28,KW15-17,PA20,PA34,PA41-48,PA60-78,ZE1-3,AB10-25,AB31,AB33-38,AB44-56,IV30-32,DD6,KA6,KA18-19,KA26,KA29-30,KY9-10,KY14-16,ML12,TD10-15", $pb) )
		{
		return 234;
		}
	else
		{
		return $country;
		}
}

sub AdjustIreland
{
	my ($country, $pb) = @_;

	if( $country != 221 )
		{
		return $country;
		}

	if( InPostCode("BT1-17", $pb) )
		{
		return 235;
		}
	else
		{
		return $country;
		}
}

sub InPostCode
{
	my ($pcode, $pb) = @_;

	return 1 unless( $pcode );
	
	$pcode = "\U$pcode";
	$pb = "\U$pb";
	$pb = &trim($pb);
	if( $pb =~ /^(.*?) .+$/ )
		{
		$pb =~ s/^(.*?) .+$/$1/;
		}
	else
		{
		if( $pb =~ /^([A-Z]+?[0-9]+?)[A-Z]+.*$/ )
			{
			$pb =~ s/^([A-Z]+?[0-9]+?)[A-Z]+.*$/$1/;
			}
		}
	
	my $adjuster, $adjuster2;

	$adjuster2 = substr($pb, 1, 1);
	if( $adjuster2 =~ /[0-9]/ )
		{
		$adjuster2 = 1;
		}
	else
		{
		$adjuster2 = 0;
		}
	
	my @fields = split(/,/,$pcode);
	foreach my $field(@fields)
		{
		$field = trim($field);
		$adjuster = substr($field, 1, 1);
		if( $adjuster =~ /[0-9]/ )
			{
			$adjuster = 1;
			}
		else
			{
			$adjuster = 0;
			}

		if( substr($field, 0, 2 - $adjuster) eq substr($pb, 0, 2 - $adjuster2) )
			{
			my $field2 = substr($field, 2 - $adjuster);
			my $pb2 = substr($pb, 2 - $adjuster2) + 1 - 1;
			my @flds = split(/-/,$field2);
			if( $#flds == 1 )
				{
				$flds[0] = $flds[0] + 1 - 1;
				$flds[1] = $flds[1] + 1 - 1;
				if( $pb2 >= $flds[0] && $pb2 <= $flds[1] )
					{
					return 1;
					}
				}
			else
				{
				$flds[0] = $flds[0] * 1;
				if( $pb2 == $flds[0] )
					{
					return 1;
					}
				}
			}
		}
		
	return 0;
}

sub IsRemoteArea
{
	my ($r_carname, $r_country, $r_pcode, $r_city) = @_;
	my $r_abbr;

	$r_country = &trim($r_country);
	$r_pcode = &trim($r_pcode);
	$r_city = &trim($r_city);

  $t_ua = LWP::UserAgent->new;
  $t_ua->agent("Mozilla/5.0");
  $t_ua->timeout(10);

	if( $r_carname eq "DHL" )
		{
		$TSQL = "SELECT abbr from countries WHERE id=$r_country";
		&tmy_sql;

		$r_abbr = '';
		if ( $colt = $tsth->fetchrow_hashref )
			{
			$r_abbr = $colt->{'abbr'};
			}
		$tsth->finish;

		return 0 unless($r_abbr);
		
		if( $r_pcode )
			{
			$r_city = "";
			}

		@form_data = (
		"searchCriteria" => "searchCriteria",
		"VTI-GROUP" => "0",
		"selectedCtry" => "$r_abbr",
		"VTI-GROUP" => "3",
		"inputPostalCode" => "$r_pcode",
		"VTI-GROUP" => "4",
		"inputCity" => "$r_city",
		"selectedState" => ""
	 	);

		my $t_response = $t_ua->post('http://raslist.dhl.com/jsp/SearchServlet?fromFilter=true&DPEECTR=Y&cntry_cd=GB&isoCountryCode=EN',	\@form_data);

		if( $t_response->is_success )
			{
			if( $t_response->content =~ m|The location you have selected is not a remote area or is not a valid selection|is )
				{
				return 0;
				}
			else
				{
				if( $t_response->content =~ m|The following are Remote Areas based on your choice of selection|is )
					{
					return 1;
					}
				else
					{
					return 0;
					}
				}
			}
		else
			{
			return 0;
			}
		}
	else
		{
		return 0;
		}
}

my @rem_charge = (-1,-1,-1,-1,-1,-1,-1,-1,-1,-1);
my @services;

sub get_price
{
	my ($tot_src, $tot_srcpb, $tot_srccity, $tot_dst, $tot_dstpb, $tot_dstcity, $tot_weight, $tot_length, $tot_width, $tot_height, $tot_trans, $tot_index, $tot_zone, $tot_ignorebook, $tot_service, $orig_country, $tot_insurance) = @_;
	my $pcode, $row, $wv, $reminder, $myzone, $mustedit;
	
	$mustedit = -1;
	$reminder = 0;

	if( $tot_zone )
		{
		if( $tot_service )
			{
			$SQL = "SELECT zones.*, services.service, services.abbr, services.remcharge as remcharge, services.profit as servprofit, services.isair as isair, services.priority as priority, services.breakable as breakable, carriers.name as carname, carriers.inscharge as inscharge, carriers.insmin as insmin, carriers.abbr as carabr, carriers.fuelmonth as fuelmonth, carriers.fuelair as fuelair, carriers.fuelroad as fuelroad, carriers.nextfuelair as nextfuelair, carriers.nextfuelroad as nextfuelroad from zones RIGHT JOIN services ON services.actives IS NOT NULL AND zones.servid=services.id LEFT JOIN carriers ON services.carid=carriers.id WHERE servid=$tot_service AND countrys=$tot_src AND countryd=$tot_dst AND (maxweight IS NULL OR (maxweight >= $tot_weight AND (volformula IS NULL OR maxweight >= (($tot_length * $tot_width * $tot_height)/volformula)))) AND (maxlength IS NULL OR maxlength >= $tot_length) AND (maxgirth IS NULL OR maxgirth >= (2 * ($tot_width + $tot_height))) AND (transferable & $tot_trans > 0) AND zoneid=$tot_zone ORDER by servid, pcodes DESC, pcoded DESC";
			}
		else
			{
			$SQL = "SELECT zones.*, services.service, services.abbr, services.remcharge as remcharge, services.profit as servprofit, services.isair as isair, services.priority as priority, services.breakable as breakable, carriers.name as carname, carriers.inscharge as inscharge, carriers.insmin as insmin, carriers.abbr as carabr, carriers.fuelmonth as fuelmonth, carriers.fuelair as fuelair, carriers.fuelroad as fuelroad, carriers.nextfuelair as nextfuelair, carriers.nextfuelroad as nextfuelroad from zones RIGHT JOIN services ON services.active IS NOT NULL AND zones.servid=services.id LEFT JOIN carriers ON services.carid=carriers.id WHERE countrys=$tot_src AND countryd=$tot_dst AND (maxweight IS NULL OR (maxweight >= $tot_weight AND (volformula IS NULL OR maxweight >= (($tot_length * $tot_width * $tot_height)/volformula)))) AND (maxlength IS NULL OR maxlength >= $tot_length) AND (maxgirth IS NULL OR maxgirth >= (2 * ($tot_width + $tot_height))) AND (transferable & $tot_trans > 0) AND zoneid=$tot_zone ORDER by servid, pcodes DESC, pcoded DESC";
			}
		}
	else
		{
		if( $tot_service )
			{
			$SQL = "SELECT zones.*, services.service, services.abbr, services.remcharge as remcharge, services.profit as servprofit, services.isair as isair, services.priority as priority, services.breakable as breakable, carriers.name as carname, carriers.inscharge as inscharge, carriers.insmin as insmin, carriers.abbr as carabr, carriers.fuelmonth as fuelmonth, carriers.fuelair as fuelair, carriers.fuelroad, carriers.nextfuelair as nextfuelair, carriers.nextfuelroad as nextfuelroad from zones RIGHT JOIN services ON services.active IS NOT NULL AND zones.servid=services.id LEFT JOIN carriers ON services.carid=carriers.id WHERE servid=$tot_service AND countrys=$tot_src AND countryd=$tot_dst AND (maxweight IS NULL OR (maxweight >= $tot_weight AND (volformula IS NULL OR maxweight >= (($tot_length * $tot_width * $tot_height)/volformula)))) AND (maxlength IS NULL OR maxlength >= $tot_length) AND (maxgirth IS NULL OR maxgirth >= (2 * ($tot_width + $tot_height))) AND (transferable & $tot_trans > 0) ORDER by servid, pcodes DESC, pcoded DESC";
			}
		else
			{
			$SQL = "SELECT zones.*, services.service, services.abbr, services.remcharge as remcharge, services.profit as servprofit, services.isair as isair, services.priority as priority, services.breakable as breakable, carriers.name as carname, carriers.inscharge as inscharge, carriers.insmin as insmin, carriers.abbr as carabr, carriers.fuelmonth as fuelmonth, carriers.fuelair as fuelair, carriers.fuelroad, carriers.nextfuelair as nextfuelair, carriers.nextfuelroad as nextfuelroad from zones RIGHT JOIN services ON services.active IS NOT NULL AND zones.servid=services.id LEFT JOIN carriers ON services.carid=carriers.id WHERE countrys=$tot_src AND countryd=$tot_dst AND (maxweight IS NULL OR (maxweight >= $tot_weight AND (volformula IS NULL OR maxweight >= (($tot_length * $tot_width * $tot_height)/volformula)))) AND (maxlength IS NULL OR maxlength >= $tot_length) AND (maxgirth IS NULL OR maxgirth >= (2 * ($tot_width + $tot_height))) AND (transferable & $tot_trans > 0) ORDER by servid, pcodes DESC, pcoded DESC";
			}
		}

	if( $tot_ignorebook )
		{
#		print "Content-type: text/plain\n\n";
#		print $SQL;
#		exit;
		}

	&my_sql;

	$last_serv = 0;
	
	@services = (0,0,0,0,0,0,0,0,0,0);
	@book_charged = (0,0,0,0,0,0,0,0,0,0);
	@remote_charged = (0,0,0,0,0,0,0,0,0,0);
	@cust_charged = (0,0,0,0,0,0,0,0,0,0);
	@dut_charged = (0,0,0,0,0,0,0,0,0,0);
	@war_charged = (0,0,0,0,0,0,0,0,0,0);
	@ins_charged = (0,0,0,0,0,0,0,0,0,0);
	
	while ($column = $sth->fetchrow_hashref)
		{
		$can_add = 0;
		next if( $last_serv == $column->{'servid'} && $services[$last_serv] == 1 );
		
		$myzone = $column->{'zoneid'};
		$last_serv = $column->{'servid'};
		$pcodes = $column->{'pcodes'};
		$pcoded = $column->{'pcoded'};
		$nopcodes = $column->{'nopcodes'};
		$nopcoded = $column->{'nopcoded'};
		if( $pcodes || $pcoded )
			{
			if( $tot_srcpb )
				{
				$can_add = InPostCode($pcodes, $tot_srcpb);
				}
	
			if( $can_add && $tot_dstpb )
				{
				$can_add = InPostCode($pcoded, $tot_dstpb);
				}
			}
		else
			{
			$can_add = 1;
			}

		if( $can_add && ($nopcodes || $nopcoded) )
			{
			if( $nopcodes && $tot_srcpb )
				{
				if( InPostCode($nopcodes, $tot_srcpb) )
					{
					$can_add = 0;
					}
				}
	
			if( $can_add && $nopcoded && $tot_dstpb )
				{
				if( InPostCode($nopcoded, $tot_dstpb) )
					{
					$can_add = 0;
					}
				}
			}

		if( $can_add )
			{
			my $aref = {};
			$aref->{'zoneid'} = $column->{'zoneid'};
			$aref->{'servid'} = $column->{'servid'};
			$aref->{'service'} = $column->{'service'};
			$aref->{'servabr'} = $column->{'abbr'};
			$aref->{'priority'} = $column->{'priority'};
			$aref->{'carabr'} = $column->{'carabr'};
			$aref->{'tt1'} = $column->{'tt1'};
			$aref->{'tt2'} = $column->{'tt2'};
			$aref->{'remotett'} = $column->{'remotett'};
			$aref->{'warcharge'} = $column->{'warcharge'};
			$aref->{'inscharge'} = $column->{'inscharge'};
			$aref->{'insmin'} = $column->{'insmin'};
#			if( $aref->{'warcharge'} && $column->{'servprofit'} )
#				{
#				$aref->{'warcharge'} = $aref->{'warcharge'} + (($aref->{'warcharge'} * $column->{'servprofit'}) / 100);
#				}
			$aref->{'dutcharge'} = $column->{'dutcharge'};
#			if( $aref->{'dutcharge'} && $column->{'servprofit'} )
#				{
#				$aref->{'dutcharge'} = $aref->{'dutcharge'} + (($aref->{'dutcharge'} * $column->{'servprofit'}) / 100);
#				}
			$aref->{'dutiable'} = $column->{'dutiable'};
				
			if( $tot_src eq $orig_country )
				{
				$aref->{'vat'} = $column->{'vat'};
				}
			else
				{
				$aref->{'vat'} = 0;
				}
			$aref->{'partcover'} = $column->{'partcover'};
			$aref->{'fueled'} = $column->{'fueled'};

			if( $column->{'fueled'} )
				{
				my ($sec,$min,$hour,$mday,$mon,$year,$wday,$yday,$isdst) = localtime;
				$mon++;
				if( $column->{'fuelmonth'} == $mon )
					{
					if( $column->{'isair'} )
						{
						$aref->{'fuel'} = $column->{'fuelair'};
						}
					else
						{
						$aref->{'fuel'} = $column->{'fuelroad'};
						}
					}
				else
					{
					if( $column->{'isair'} )
						{
						$aref->{'fuel'} = $column->{'nextfuelair'};
						}
					else
						{
						$aref->{'fuel'} = $column->{'nextfuelroad'};
						}
					}
				if( $s_fuelextra )
					{
					$aref->{'fuel'} = $aref->{'fuel'} + $s_fuelextra;
					}
				}
			else
				{
				$aref->{'fuel'} = 0;
				}

			$aref->{'satdelext'} = $column->{'satdelext'};
			$aref->{'satcolext'} = $column->{'satcolext'};
			if( $tot_ignorebook )
				{
				$aref->{'bookcharge'} = 0;
				}
			else
				{
				$aref->{'bookcharge'} = $column->{'bookcharge'};
				}
			
			$aref->{'remotecharge'} = $column->{'remotecharge'};
			$aref->{'remcharge'} = $column->{'remcharge'};
			$aref->{'invreq'} = $column->{'invreq'};
			$aref->{'custcharge'} = $column->{'custcharge'};
			$aref->{'descript'} = $column->{'descript'};

			if( $tot_index == -1 )
				{
				for( my $arrIndex = 0 ; $arrIndex <= $#total_price ; $arrIndex++ )
					{
					if( $total_price[$arrIndex]->{'zoneid'} == $aref->{'zoneid'} )
						{
						$mustedit = $arrIndex;
						last;
						}
					}
				}

			if( !$aref->{'remotecharge'} && $column->{'remcharge'} )
				{
				if( $rem_charge[$last_serv] == -1 )
					{
					my ($remote_var1, $remote_var2);
					my ($pbs, $pbd);
					
					$pbs = $tot_srcpb;
					$pbd = $tot_dstpb;
					
					$pbs =~ s/ //g;
					$pbd =~ s/ //g;
					
					$remote_var1 = IsRemoteArea($column->{'carname'}, $tot_src, $pbs, $tot_srccity);
					$remote_var2 = IsRemoteArea($column->{'carname'}, $tot_dst, $pbd, $tot_dstcity);

					if( $remote_var1 == 1 || $remote_var2 == 1 )
						{
						$aref->{'remotecharge'} = $column->{'remcharge'};
						$rem_charge[$last_serv] = 1;
						}
					else
						{
						if( $remote_var1 == -1 && $remote_var2 == -1 )
							{
							$rem_charge[$last_serv] = 2;
							}
						else
							{
							$rem_charge[$last_serv] = 0;
							}
						}
					}
				else
					{
					if( $rem_charge[$last_serv] == 1 )
						{
						$aref->{'remotecharge'} = $column->{'remcharge'};
						}
					}
				}
			else
				{
				if( $aref->{'remotecharge'} )
					{
					$rem_charge[$last_serv] = 1;
					}
				}

			if( $tot_index == -1 )
				{
				if( $column->{'volformula'} )
					{
					$wv = toCurr(($tot_length * $tot_width * $tot_height) / $column->{'volformula'});
					$wv = $tot_weight if( $tot_weight > $wv );
					}
				else
					{
					$wv = $tot_weight;
					}
				}
			else
				{
				$wv = $tot_weight;
				}

			if( $isUser && !$isAdmin )
				{
				$SQL2 = "SELECT * from prices WHERE userid=$isUser AND servid=$column->{'servid'} AND zone=$column->{'zone'} AND $wv <= kgs  AND extra=0 order by kgs LIMIT 1";
				}
			else
				{
				if( $tot_ignorebook )
					{
					$SQL2 = "SELECT * from prices WHERE userid=$tot_ignorebook AND servid=$column->{'servid'} AND zone=$column->{'zone'} AND $wv <= kgs AND extra=0 order by kgs LIMIT 1";
					}
				else
					{
					$SQL2 = "SELECT * from prices WHERE userid IS NULL AND servid=$column->{'servid'} AND zone=$column->{'zone'} AND $wv <= kgs AND extra=0 order by kgs LIMIT 1";
					}
				}

			&my_sql2;

			if ($col = $sth2->fetchrow_hashref)
				{
				$kgs_up = $col->{'kgs'};
#				print "[1:$kgs_up]";
				if( $col->{'perkg'} != 0 )
					{
#					print "[2:$col->{'perkg'}]";
					if( $col->{'base_kg'} != 0 )
						{
						$price_up = $col->{'base_price'} + ceil(($wv - $col->{'base_kg'}) / $col->{'base_kg'}) * $col->{'price'};
#						print "[3:$price_up]";
						}
					else
						{
						$price_up = (ceil($wv) + 1 - 1) * ($col->{'price'} + 1 - 1);
#						print "[4:$price_up]";
						}
					}
				else
					{
					$price_up = $col->{'price'};
#					print "[5:$price_up]";
					}
	
				if( $col->{'nondoccharge'} != 0 )
					{
					$price_up = $price_up + $col->{'nondoccharge'};
#					print "[6:$price_up]";
					}

				if( $column->{'servprofit'} )
					{
					$price_up = $price_up + ($price_up * $column->{'servprofit'}) / 100;
#					print "[7:$price_up]";
					}
				$sth2->finish;

				if( $isUser && !$isAdmin )
					{
					$SQL2 = "SELECT * from prices WHERE userid=$isUser AND servid=$column->{'servid'} AND zone=$column->{'zone'} AND $wv > kgs AND extra=0 order by kgs DESC LIMIT 1";
					}
				else
					{
					if( $tot_ignorebook )
						{
						$SQL2 = "SELECT * from prices WHERE userid=$tot_ignorebook AND servid=$column->{'servid'} AND zone=$column->{'zone'} AND $wv > kgs AND extra=0 order by kgs DESC LIMIT 1";
						}
					else
						{
						$SQL2 = "SELECT * from prices WHERE userid IS NULL AND servid=$column->{'servid'} AND zone=$column->{'zone'} AND $wv > kgs AND extra=0 order by kgs DESC LIMIT 1";
						}
					}
	
				&my_sql2;

				if ($col = $sth2->fetchrow_hashref)
					{
					$kgs_dn = $col->{'kgs'};
					if( $col->{'perkg'} != 0 )
						{
						$kgs_dn = 0;
						$price_dn = 0;
						}
					else
						{
						$price_dn = $col->{'price'};
						}
		
					if( $price_dn != 0 && $col->{'nondoccharge'} != 0 )
						{
						$price_dn = $price_dn + $col->{'nondoccharge'};
						}
	
					if( $price_dn != 0 && $column->{'servprofit'} )
						{
						$price_dn = $price_dn + ($price_dn * $column->{'servprofit'}) / 100;
						}
					$sth2->finish;
					}
				else
					{
					$kgs_dn = 0;
					$price_dn = 0;
					}
				
				if( $wv == $kgs_up )
					{
					$final_price = $price_up;
					}
				else
					{
					if( !$kgs_dn || $kgs_dn == $kgs_up )
						{
						$final_price = $price_up;
						}
					else
						{
						if( $column->{'breakable'} )
							{
							if( (100 * ($price_up - $price_dn)) / $price_dn > 10 )
								{
								$final_price = $price_dn + (($price_up - $price_dn) / ($kgs_up - $kgs_dn)) * ($wv - $kgs_dn);
								}
							else
								{
								$final_price = $price_up;
								}
							}
						else
							{
							$final_price = $price_up;
							}
						}
					}
				}
			else
				{
				$sth2->finish;

				if( $isUser && !$isAdmin )
					{
					$SQL2 = "SELECT * from prices WHERE userid=$isUser AND servid=$column->{'servid'} AND zone=$column->{'zone'} AND extra=0 order by kgs DESC LIMIT 1";
					}
				else
					{
					if( $tot_ignorebook )
						{
						$SQL2 = "SELECT * from prices WHERE userid=$tot_ignorebook AND servid=$column->{'servid'} AND zone=$column->{'zone'} AND extra=0 order by kgs DESC LIMIT 1";
						}
					else
						{
						$SQL2 = "SELECT * from prices WHERE userid IS NULL AND servid=$column->{'servid'} AND zone=$column->{'zone'} AND extra=0 order by kgs DESC LIMIT 1";
						}
					}

				&my_sql2;
				$col = $sth2->fetchrow_hashref;
				return unless( $col );
				$max_kgs = $col->{'kgs'};
				if( $col->{'perkg'} )
					{				
					$max_price = $col->{'kgs'} * $col->{'price'};
					}
				else
					{
					$max_price = $col->{'price'};
					}

				if( $column->{'servprofit'} )
					{
					$max_price = $max_price + ($max_price * $column->{'servprofit'}) / 100;
					}
				
				$sth2->finish;

				if( $isUser && !$isAdmin )
					{
					$SQL2 = "SELECT * from prices WHERE userid=$isUser AND servid=$column->{'servid'} AND zone=$column->{'zone'} AND extra=1";
					}
				else
					{
					if( $tot_ignorebook )
						{
						$SQL2 = "SELECT * from prices WHERE userid=$tot_ignorebook AND servid=$column->{'servid'} AND zone=$column->{'zone'} AND extra=1";
						}
					else
						{
						$SQL2 = "SELECT * from prices WHERE userid IS NULL AND servid=$column->{'servid'} AND zone=$column->{'zone'} AND extra=1";
						}
					}
	
				&my_sql2;
				if( $col = $sth2->fetchrow_hashref )
					{
					$extra_kgs = $col->{'kgs'};
					
					if( $col->{'perkg'} )
						{
						$final_price = ceil($wv) * $col->{'price'};

						if( $col->{'nondoccharge'} )
							{
							$final_price = $final_price + $col->{'nondoccharge'};
							}

						if( $column->{'servprofit'} )
							{
							$final_price = $final_price + ($final_price * $column->{'servprofit'}) / 100;
							}
						$sth2->finish;
						}
					else
						{
						$extra_price = $col->{'price'};

						if( $col->{'nondoccharge'} )
							{
							$extra_price = $extra_price + $col->{'nondoccharge'};
							}

						if( $column->{'servprofit'} )
							{
							$extra_price = $extra_price + ($extra_price * $column->{'servprofit'}) / 100;
							}
						$sth2->finish;

						$final_price = $max_price + ceil(($wv - $max_kgs) / $extra_kgs) * $extra_price;
						}
					}
				else
					{
					$sth2->finish;
					$final_price = $max_price;
					$reminder = $wv - $max_kgs;
					}
				}
				
			$aref->{'price'} = $final_price;

			$aref->{'totalfuel'} = 0;
			$aref->{'totalbook'} = 0;
			$aref->{'totalremote'} = 0;
			$aref->{'totalcust'} = 0;
			$aref->{'totaldut'} = 0;
			$aref->{'totalvat'} = 0;
			$aref->{'totalwar'} = 0;
			$aref->{'totalins'} = 0;

			if( $s_profit )
				{
				$aref->{'price'} = $aref->{'price'} + (($aref->{'price'} * $s_profit) / 100);
				}			

			my $tot_temp = $aref->{'price'};

			if( !$book_charged[$last_serv] && $aref->{'bookcharge'} )
				{
				$aref->{'totalbook'} = $aref->{'bookcharge'};
				if( $tot_index == -1 && $mustedit == -1 )
					{
					$tot_temp = $tot_temp + $aref->{'totalbook'};
					}
				$book_charged[$last_serv] = 1;
				}

			if( !$remote_charged[$last_serv] && $aref->{'remotecharge'} )
				{
				$aref->{'totalremote'} = $aref->{'remotecharge'};
				$tot_temp = $tot_temp + $aref->{'totalremote'};
				$remote_charged[$last_serv] = 1;
				}

			if( !$cust_charged[$last_serv] && $aref->{'custcharge'} )
				{
				$aref->{'totalcust'} = $aref->{'custcharge'};
				$tot_temp = $tot_temp + $aref->{'totalcust'};
				$cust_charged[$last_serv] = 1;
				}

			if( !$dut_charged[$last_serv] && $aref->{'dutcharge'} > 0 )
				{
				$aref->{'totaldut'} = $aref->{'dutcharge'};
				if( $tot_index == -1 && $mustedit == -1 )
					{
					$tot_temp = $tot_temp + $aref->{'totaldut'};
					}
				$dut_charged[$last_serv] = 1;
				}

			if( !$war_charged[$last_serv] && $aref->{'warcharge'} )
				{
				$aref->{'totalwar'} = $aref->{'warcharge'};
				if( $tot_index == -1 && $mustedit == -1 )
					{
					$tot_temp = $tot_temp + $aref->{'totalwar'};
					}
				$war_charged[$last_serv] = 1;
				}

			if( !$ins_charged[$last_serv] && $aref->{'inscharge'} && $tot_insurance ne "0" )
				{
				$aref->{'totalins'} = ($tot_insurance * $aref->{'inscharge'}) / 100;
				if( $aref->{'totalins'} < $aref->{'insmin'} )
					{
					$aref->{'totalins'} = $aref->{'insmin'};
					}
				if( $tot_index == -1 && $mustedit == -1 )
					{
					$tot_temp = $tot_temp + $aref->{'totalins'};
					}
				$ins_charged[$last_serv] = 1;
				}

			if( $aref->{'fueled'} )
				{
				$aref->{'totalfuel'} = ($tot_temp * $aref->{'fuel'}) / 100;
				$tot_temp = $tot_temp + $aref->{'totalfuel'};
				}

			if( $aref->{'vat'} )
				{
				$aref->{'totalvat'} = ($tot_temp * $aref->{'vat'}) / 100;
				}

			if( $tot_index == -1 )
				{
				if( $mustedit != -1 )
					{
					if( $total_price[$mustedit]->{'satdelext'} && $aref->{'satdelext'} ) 
						{
						$total_price[$mustedit]->{'satdelext'} = $total_price[$mustedit]->{'satdelext'} + $aref->{'satdelext'};
						}
					if( $total_price[$mustedit]->{'satcolext'} && $aref->{'satcolext'} ) 
						{
						$total_price[$mustedit]->{'satcolext'} = $total_price[$mustedit]->{'satcolext'} + $aref->{'satcolext'};
						}
					if( !$remote_charged[$last_serv] && $aref->{'remotecharge'} && $total_price[$mustedit]->{'remotecharge'} )
						{
						$total_price[$mustedit]->{'remotecharge'} = $total_price[$mustedit]->{'remotecharge'} + $aref->{'remotecharge'};
						$total_price[$mustedit]->{'totalremote'} = $total_price[$mustedit]->{'totalremote'} + $aref->{'remotecharge'};
						}
					if( $total_price[$mustedit]->{'remcharge'} && $aref->{'remcharge'} ) 
						{
						$total_price[$mustedit]->{'remcharge'} = $total_price[$mustedit]->{'remcharge'} + $aref->{'remcharge'};
						}
					if( !$cust_charged[$last_serv] && $aref->{'custcharge'} && $total_price[$mustedit]->{'custcharge'})
						{
						$total_price[$mustedit]->{'custcharge'} = $total_price[$mustedit]->{'custcharge'} + $aref->{'custcharge'};
						$total_price[$mustedit]->{'totalcust'} = $total_price[$mustedit]->{'totalcust'} + $aref->{'totalcust'};
						}

					if( !$dut_charged[$last_serv] && $aref->{'dutcharge'} > 0 && $total_price[$mustedit]->{'dutcharge'})
						{
						$total_price[$mustedit]->{'dutcharge'} = $total_price[$mustedit]->{'dutcharge'} + $aref->{'dutcharge'};
						$total_price[$mustedit]->{'totaldut'} = $total_price[$mustedit]->{'totaldut'} + $aref->{'totaldut'};
						}
	
					if( !$war_charged[$last_serv] && $aref->{'warcharge'} && $total_price[$mustedit]->{'warcharge'})
						{
						$total_price[$mustedit]->{'warcharge'} = $total_price[$mustedit]->{'warcharge'} + $aref->{'warcharge'};
						$total_price[$mustedit]->{'totalwar'} = $total_price[$mustedit]->{'totalwar'} + $aref->{'totalwar'};
						}

					if( !$ins_charged[$last_serv] && $aref->{'inscharge'} && $total_price[$mustedit]->{'inscharge'})
						{
						$total_price[$mustedit]->{'inscharge'} = $total_price[$mustedit]->{'inscharge'} + $aref->{'inscharge'};
						$total_price[$mustedit]->{'totalins'} = $total_price[$mustedit]->{'totalins'} + $aref->{'totalins'};
						}

					if( $aref->{'totalfuel'} && $total_price[$mustedit]->{'totalfuel'} )
						{
						$total_price[$mustedit]->{'totalfuel'} = $total_price[$mustedit]->{'totalfuel'} + $aref->{'totalfuel'};
						}
	
					if( $aref->{'totalvat'} && $total_price[$mustedit]->{'totalvat'} )
						{
						$total_price[$mustedit]->{'totalvat'} = $total_price[$mustedit]->{'totalvat'} + $aref->{'totalvat'};
						}
	
					$total_price[$mustedit]->{'price'} = $total_price[$mustedit]->{'price'} + $aref->{'price'};
					}
				else
					{
					push(@total_price, $aref);
					}
				}
			else
				{
				if( $total_price[$tot_index]->{'satdelext'} && $aref->{'satdelext'} ) 
					{
					$total_price[$tot_index]->{'satdelext'} = $total_price[$tot_index]->{'satdelext'} + $aref->{'satdelext'};
					}
				if( $total_price[$tot_index]->{'satcolext'} && $aref->{'satcolext'} ) 
					{
					$total_price[$tot_index]->{'satcolext'} = $total_price[$tot_index]->{'satcolext'} + $aref->{'satcolext'};
					}
				if( !$remote_charged[$last_serv] && $aref->{'remotecharge'} && $total_price[$tot_index]->{'remotecharge'} )
					{
					$total_price[$tot_index]->{'remotecharge'} = $total_price[$tot_index]->{'remotecharge'} + $aref->{'remotecharge'};
					$total_price[$tot_index]->{'totalremote'} = $total_price[$tot_index]->{'totalremote'} + $aref->{'remotecharge'};
					}
				if( $total_price[$tot_index]->{'remcharge'} && $aref->{'remcharge'} ) 
					{
					$total_price[$tot_index]->{'remcharge'} = $total_price[$tot_index]->{'remcharge'} + $aref->{'remcharge'};
					}
				if( !$cust_charged[$last_serv] && $aref->{'custcharge'} && $total_price[$tot_index]->{'custcharge'})
					{
					$total_price[$tot_index]->{'custcharge'} = $total_price[$tot_index]->{'custcharge'} + $aref->{'custcharge'};
					$total_price[$tot_index]->{'totalcust'} = $total_price[$tot_index]->{'totalcust'} + $aref->{'totalcust'};
					}
				if( !$dut_charged[$last_serv] && $aref->{'dutcharge'} > 0 && $total_price[$tot_index]->{'dutcharge'})
					{
					$total_price[$tot_index]->{'dutcharge'} = $total_price[$tot_index]->{'dutcharge'} + $aref->{'dutcharge'};
					$total_price[$tot_index]->{'totaldut'} = $total_price[$tot_index]->{'totaldut'} + $aref->{'totaldut'};
					}
				if( !$war_charged[$last_serv] && $aref->{'warcharge'} && $total_price[$tot_index]->{'warcharge'})
					{
					$total_price[$tot_index]->{'warcharge'} = $total_price[$tot_index]->{'warcharge'} + $aref->{'warcharge'};
					$total_price[$tot_index]->{'totalwar'} = $total_price[$tot_index]->{'totalwar'} + $aref->{'totalwar'};
					}
				if( !$ins_charged[$last_serv] && $aref->{'inscharge'} && $total_price[$tot_index]->{'inscharge'})
					{
					$total_price[$tot_index]->{'inscharge'} = $total_price[$tot_index]->{'inscharge'} + $aref->{'inscharge'};
					$total_price[$tot_index]->{'totalins'} = $total_price[$tot_index]->{'totalins'} + $aref->{'totalins'};
					}

				if( $aref->{'totalfuel'} && $total_price[$tot_index]->{'totalfuel'} )
					{
					$total_price[$tot_index]->{'totalfuel'} = $total_price[$tot_index]->{'totalfuel'} + $aref->{'totalfuel'};
					}

				if( $aref->{'totalvat'} && $total_price[$tot_index]->{'totalvat'} )
					{
					$total_price[$tot_index]->{'totalvat'} = $total_price[$tot_index]->{'totalvat'} + $aref->{'totalvat'};
					}

				$total_price[$tot_index]->{'price'} = $total_price[$tot_index]->{'price'} + $aref->{'price'};
				}

			$services[$last_serv] = 1;

			&get_price($tot_src, $tot_srcpb, $tot_srccity, $tot_dst, $tot_dstpb, $tot_dstcity, $reminder, $tot_length, $tot_width, $tot_height, $tot_trans, $#total_price, $myzone, $tot_ignorebook, $tot_service, $orig_country, $tot_insurance) if( $reminder );
			}
		}
	
	$sth->finish;
}


sub book2{
	unless ($id_source) {&error_page("Incomplete data entered! Please select a Source country."); exit;} 
	if( $id_postcodeS && $id_cityS ) {&error_page("Error. You must specify ONLY Post Code OR City of the collection address, not both of them."); exit;} 
	unless( $id_postcodeS || $id_cityS ) {&error_page("Incomplete data entered! Please specify Post Code OR City of the collection address."); exit;} 
	if( $id_postcodeS =~ m/\*/ || $id_cityS =~ m/\*/ ) {&error_page("Post code or City of collection address cannot contain * character."); exit;} 
	if( $id_source == 221 && !postcodeS ) {&error_page("You must specify ONLY post code for UK"); exit;} 
	unless ($id_dest) {&error_page("Incomplete data entered! Please select a Destination country."); exit;} 
	if( $id_postcodeD && $id_cityD ) {&error_page("Error. You must specify ONLY Post Code OR City of the delivery address, not both of them."); exit;} 
	unless( $id_postcodeD || $id_cityD ) {&error_page("Incomplete data entered! Please specify Post Code OR City of the delivery address."); exit;} 
	if( $id_postcodeD =~ m/\*/ || $id_cityD =~ m/\*/ ) {&error_page("Post code or City of delivery address cannot contain * character."); exit;} 
	if( $id_dest == 221 && !postcodeD ) {&error_page("You must specify ONLY post code for UK"); exit;} 
	if ($trans eq "1" || $trans eq "4") 
		{
		$content =~ s/"/&quot;/g;
		unless ($content)	{&error_page("Incomplete data entered! Please specify Parcel/Pallet Package Contents."); exit;} 
		if ($prohibited != "1")	{&error_page("Incomplete data entered! Please agree to the Prohibited & Restricted Items List in order to continue."); exit;} 
		}
	unless ($val && $val =~ /^\s*[0-9\.]+\s*$/) {&error_page("Incomplete data entered! Please enter a valid number for Value field."); exit;} 
	unless ($insurance =~ /^\s*[0-9]+\s*$/) {&error_page("Incomplete data entered! Please select an insurance cover."); exit;} 

#	$id_source = AdjustHighlands($id_source, $id_postcodeS);
#	$id_dest = AdjustHighlands($id_dest, $id_postcodeD);

#	$id_source = AdjustIreland($id_source, $id_postcodeS);
#	$id_dest = AdjustIreland($id_dest, $id_postcodeD);

  $t_ua1 = LWP::UserAgent->new;
  $t_ua1->agent("Mozilla/5.0");
  $t_ua1->timeout(10);

	my $t_response1 = $t_ua1->post('http://www.interparcel.com/quote/');

	my $cookie = "";
	if( $t_response1->is_success )
		{
		$cookie = get_cookie($t_response1, "PHPSESSID");
		}

#print "Content-type: text/plain\n\n"; 

	my $frm;

	$frm = "<input type=\"hidden\" name=\"id_dest\" value=\"$id_dest\" />\n";
	$frm = $frm . "<input type=\"hidden\" name=\"id_source\" value=\"$id_source\" />\n";
	$frm = $frm . "<input type=\"hidden\" name=\"packagecount\" value=\"$packagecount\" />\n";
	$frm = $frm . "<input type=\"hidden\" name=\"id_postcodeS\" value=\"$id_postcodeS\" />\n";
	$frm = $frm . "<input type=\"hidden\" name=\"id_postcodeD\" value=\"$id_postcodeD\" />\n";
	$frm = $frm . "<input type=\"hidden\" name=\"id_cityS\" value=\"$id_cityS\" />\n";
	$frm = $frm . "<input type=\"hidden\" name=\"id_cityD\" value=\"$id_cityD\" />\n";
	$frm = $frm . "<input type=\"hidden\" name=\"content\" value=\"$content\" />\n";
	$frm = $frm . "<input type=\"hidden\" name=\"val\" value=\"$val\" />\n";
	$frm = $frm . "<input type=\"hidden\" name=\"insurance\" value=\"$insurance\" />\n";

	@total_price = ();	

	for( $l = 1; $l <= ${'packagecount'} ; $l++ )
		{
		my ($w1, $w2, $w3, $w4);
		$w1 = "weight[$l]";
		unless (${$w1}) {&error_page("Incomplete data entered! Please enter the weight of package $l."); $frm=""; @total_price = (); exit;} 
		$frm = $frm . "<input type=\"hidden\" name=\"weight[$l]\" value=\"${$w1}\" />\n";
	 	$w2 = "length[$l]";
		unless (${$w2}) {&error_page("Incomplete data entered! Please enter the length of package $l."); $frm=""; @total_price = (); exit;} 
		$frm = $frm . "<input type=\"hidden\" name=\"length[$l]\" value=\"${$w2}\" />\n";
	 	$w3 = "width[$l]";
		unless (${$w3}) {&error_page("Incomplete data entered! Please enter the width of package $l."); $frm=""; @total_price = (); exit;} 
		$frm = $frm . "<input type=\"hidden\" name=\"width[$l]\" value=\"${$w3}\" />\n";
	 	$w4 = "height[$l]";
		unless (${$w4}) {&error_page("Incomplete data entered! Please enter the height of package $l."); $frm=""; @total_price = (); exit;} 
		$frm = $frm . "<input type=\"hidden\" name=\"height[$l]\" value=\"${$w4}\" />\n";

		&get_price($id_source, $id_postcodeS, $id_cityS, $id_dest, $id_postcodeD, $id_cityD, ${$w1}, ${$w2}, ${$w3}, ${$w4}, $trans, -1, 0, 0, 0, $id_source, $insurance);
		}

	@total_price = sort { ($a->{'price'}+$a->{'totalfuel'}+$a->{'totalbook'}+$a->{'totalremote'}+$a->{'totalcust'}+$a->{'totaldut'}+$a->{'totalwar'}+$a->{'totalins'}) <=> ($b->{'price'}+$b->{'totalfuel'}+$b->{'totalbook'}+$b->{'totalremote'}+$b->{'totalcust'}+$b->{'totaldut'}+$b->{'totalwar'}+$b->{'totalins'}) } @total_price;

	if( $#total_price >= 0 )
		{
		&myheader($heading);
			
		&topmenu($heading);

print qq|

<div class="ha8"><H1><font color="#000080" size="2"><b>Parcel Delivery</b></font></H1>
<h2><font color="#000080" size="1"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Quote (Step 2 of 6)</b></font></h2>

<TABLE class="infoheader" width=100% height=60 cellspacing=0 cellpadding=1><TR><TD height=5 colspan=3></td></tr>
<TR>
<TD width=5>&nbsp;</TD><TD class="infoheader" valign=top>Please hover over the services below for a description of each service available.
<br />Click on a service to select it and continue booking.<br />
<U>Please note:</U> Delivery guarantees start from the time the package has been collected.</TD>
<TD width=5>&nbsp;</TD>
</TR>
<TR>
<TD height=5 colspan=3></td>
</tr>
</TABLE>

<br />
<TABLE border=0 width=70% cellpadding=0 cellspacing=0>
<TR>
<TD rowspan=2 valign="top">
|;

print qq|<br /><U><B><font size=2>Available Services</font></B></U><br /><br />|;

for( my $j = 0 ; $j <= $#total_price ; $j++ )
	{

print qq|

<DIV ID="$total_price[$j]->{'servabr'}_title" style="visibility: hidden; position:absolute; top:0; left:0;">
<table border=0 width=100% cellpadding=0 cellspacing=0>
<tr>
<td width=60 align=left><image src="img/services/\L$total_price[$j]->{'carabr'}.gif"|;

print qq| /></td>
<td><FONT SIZE=4><B>$total_price[$j]->{'service'}</B></FONT></td>
</tr>
</table>
</DIV>

<DIV ID="$total_price[$j]->{'servabr'}_box" style="visibility: hidden; position:absolute; top:0; left:0;">
|;
if( $total_price[$j]->{'tt1'} > 0 )
	{
		print qq|
	<b>Delivery Time:</b> |;

	if( $total_price[$j]->{'tt1'} == $total_price[$j]->{'tt2'} )
		{
		if( $total_price[$j]->{'tt1'} + $total_price[$j]->{'remotett'} == 1 )
			{
			print "Next Working Day";
			}
		else
			{
			print $total_price[$j]->{'tt1'} + $total_price[$j]->{'remotett'};
			print " Working Days";
			}
		}
	else
		{
		print $total_price[$j]->{'tt1'} + $total_price[$j]->{'remotett'};
		print "-";
		print $total_price[$j]->{'tt2'} + $total_price[$j]->{'remotett'};
		print " Working Days";	
		}

	if( $total_price[$j]->{'remotett'} )
		{
		print "&nbsp;&nbsp;(The collection and/or delivery address is remote area and this is included in the time frame)";
		}
}

print "<br />\n<ul>";

if( $total_price[$j]->{'partcover'} )
	{
	print "<li>" . $total_price[$j]->{'partcover'} . "</li>";
	}

if( $total_price[$j]->{'invreq'} )
	{
	print "<li>$s_invtext</li>";
	}

if( $total_price[$j]->{'custcharge'} )
	{
	my $strstr = $s_custtext;
	my $strval = omit0($total_price[$j]->{'custcharge'});
	$strstr =~ s/\[value\]/$strval/i;
	print "<li>$strstr</li>";
	}

if( $total_price[$j]->{'remotecharge'} )
	{
	my $strstr = $s_remotetext;
	my $strval = omit0($total_price[$j]->{'remotecharge'});
	$strstr =~ s/\[value\]/$strval/i;
	print "<li>$strstr</li>";
	}
else
	{
	if( $total_price[$j]->{'remcharge'} && $rem_charge[$total_price[$j]->{'servid'}]	== 0 )
		{
		my $strstr;
		if( $total_price[$j]->{'carabr'} eq "DHL" )
			{
			$strstr = $s_remotetext . " <u>MAY</u> apply. To find out if it's applied, please visit: <a href=\"http://raslist.dhl.com\" target=_BLANK>raslist.dhl.com</a>";
			}
		else
			{
			$strstr = $s_remotetext . " <u>MAY</u> apply.";
			}
		my $strval = omit0($total_price[$j]->{'remcharge'});
		$strstr =~ s/\[value\]/$strval/i;
		print qq|<li><font color="#FF0000">$strstr</font></li>|;
		}
	}

if( $total_price[$j]->{'satdelext'} )
	{
	my $strstr = $s_satdelexttext;
	my $strval = omit0($total_price[$j]->{'satdelext'});
	$strstr =~ s/\[value\]/$strval/i;
	print "<li>$strstr</li>";
	}

if( $total_price[$j]->{'satcolext'} )
	{
	my $strstr = $s_satcolexttext;
	my $strval = omit0($total_price[$j]->{'satcolext'});
	$strstr =~ s/\[value\]/$strval/i;
	print "<li>$strstr</li>";
	}

if( $total_price[$j]->{'bookcharge'} )
	{
	my $strstr = $s_booktext;
	my $strval = omit0($total_price[$j]->{'bookcharge'});
	$strstr =~ s/\[value\]/$strval/i;
	print "<li>$strstr</li>";
	}

if( $total_price[$j]->{'warcharge'} )
	{
	my $strstr = $s_wartext;
	my $strval = omit0($total_price[$j]->{'warcharge'});
	$strstr =~ s/\[value\]/$strval/i;
	print "<li>$strstr</li>";
	}

if( $insurance &&  $total_price[$j]->{'totalins'} )
	{
	print "<li>£$insurance Insurance Cover included</li>";
	}

if( $total_price[$j]->{'dutcharge'} > 0 )
	{
	my $strstr;
	if( $total_price[$j]->{'dutiable'} )
		{
		$strstr = $total_price[$j]->{'dutiable'};
		}
	else
		{
		$strstr = $s_duttext;
		}
	my $strval = omit0($total_price[$j]->{'dutcharge'});
	$strstr =~ s/\[value\]/$strval/i;
	print "<li>$strstr</li>";
	}

if( $total_price[$j]->{'fueled'} )
	{
	my $strstr = $s_fueltext;
	my $strval;
	$strval = omit0($total_price[$j]->{'fuel'});
	$strstr =~ s/\[value\]/$strval/i;
	print "<li>$strstr</li>";
	}

if( $total_price[$j]->{'vat'} )
	{
	my $strstr = $s_vattext;
	my $strval = omit0($total_price[$j]->{'vat'});
	$strstr =~ s/\[value\]/$strval/i;
	print "<li>$strstr</li>";
	}

if( $total_price[$j]->{'descript'} )
	{
	print "<li>" . $total_price[$j]->{'descript'} . "</li>";
	}

print qq|
</ul>
</DIV>

<DIV ID="$total_price[$j]->{'servabr'}_price" style="visibility: hidden; position:absolute; top:0; left:0;">|;

	$total_price[$j]->{'price'} = toCurr($total_price[$j]->{'price'});
	$total_price[$j]->{'totalfuel'} = toCurr($total_price[$j]->{'totalfuel'});
	$total_price[$j]->{'totalbook'} = toCurr($total_price[$j]->{'totalbook'});
	$total_price[$j]->{'totalremote'} = toCurr($total_price[$j]->{'totalremote'});
	$total_price[$j]->{'totalcust'} = toCurr($total_price[$j]->{'totalcust'});
	$total_price[$j]->{'totaldut'} = toCurr($total_price[$j]->{'totaldut'});
	$total_price[$j]->{'totalwar'} = toCurr($total_price[$j]->{'totalwar'});
	$total_price[$j]->{'totalins'} = toCurr($total_price[$j]->{'totalins'});
	
	$mytotal_price = toCurr($total_price[$j]->{'price'}+$total_price[$j]->{'totalfuel'}+$total_price[$j]->{'totalbook'}+$total_price[$j]->{'totalremote'}+$total_price[$j]->{'totalcust'}+$total_price[$j]->{'totaldut'}+$total_price[$j]->{'totalwar'}+$total_price[$j]->{'totalins'});
	
	$mytotal_price = $mytotal_price . ".00" unless( $mytotal_price =~ m/\./ );
	$mytotal_price = $mytotal_price . "0" if( $mytotal_price =~ m/\.\d$/ );

	print qq|<FONT SIZE=4><B>Price: £$mytotal_price|;
	
	if( $total_price[$j]->{'vat'} && $total_price[$j]->{'vat'} > 0 )
		{
		print qq| + |;
		print omit0($total_price[$j]->{'vat'});
		print qq|% VAT|;
		}
	
	print qq|</B></FONT><BR />
</DIV>

<form name="form" method="POST" action="$script">

<input type="image" name="$total_price[$j]->{'servabr'}" SRC="img/services/\L$total_price[$j]->{'servabr'}.gif"|;

print qq| value="$total_price[$j]->{'servabr'}" border="0" 
onmouseover="
document.getElementById('showtitle').innerHTML = document.getElementById('$total_price[$j]->{'servabr'}_title').innerHTML;
document.getElementById('showbox').innerHTML = document.getElementById('$total_price[$j]->{'servabr'}_box').innerHTML;
document.getElementById('showprice').innerHTML = document.getElementById('$total_price[$j]->{'servabr'}_price').innerHTML"></A>&nbsp;&nbsp;&nbsp;

<input name="cookie" type="hidden" value="$cookie" />
<input name="zoneid" type="hidden" value="$total_price[$j]->{'zoneid'}" />
<input name="servabr" type="hidden" value="$total_price[$j]->{'servabr'}" />
<input name="carabr" type="hidden" value="$total_price[$j]->{'carabr'}" />
<input name="service" type="hidden" value="$total_price[$j]->{'service'}" />
<input name="tt1" type="hidden" value="$total_price[$j]->{'tt1'}" />
<input name="tt2" type="hidden" value="$total_price[$j]->{'tt2'}" />
<input name="remotett" type="hidden" value="$total_price[$j]->{'remotett'}" />
<input name="warcharge" type="hidden" value="$total_price[$j]->{'warcharge'}" />
<input name="dutcharge" type="hidden" value="$total_price[$j]->{'dutcharge'}" />
<input name="dutiable" type="hidden" value="$total_price[$j]->{'dutiable'}" />
<input name="partcover" type="hidden" value="$total_price[$j]->{'partcover'}" />
<input name="invreq" type="hidden" value="$total_price[$j]->{'invreq'}" />
<input name="custcharge" type="hidden" value="$total_price[$j]->{'custcharge'}" />
<input name="remotecharge" type="hidden" value="$total_price[$j]->{'remotecharge'}" />
<input name="remcharge" type="hidden" value="$total_price[$j]->{'remcharge'}" />
<input name="satdelext" type="hidden" value="$total_price[$j]->{'satdelext'}" />
<input name="satcolext" type="hidden" value="$total_price[$j]->{'satcolext'}" />
<input name="bookcharge" type="hidden" value="$total_price[$j]->{'bookcharge'}" />|;

if( $total_price[$j]->{'fueled'} )
	{
	print qq|
	<input name="fueled" type="hidden" value="$total_price[$j]->{'fuel'}" />
	|;
	}
else
	{
		print qq|
		<input name="fueled" type="hidden" value="0" />
		|;
	}


print qq|
<input name="vat" type="hidden" value="$total_price[$j]->{'vat'}" />
<input name="descript" type="hidden" value="$total_price[$j]->{'descript'}" />
<input name="price" type="hidden" value="$total_price[$j]->{'price'}" />
<input name="totalfuel" type="hidden" value="$total_price[$j]->{'totalfuel'}" />
<input name="totalbook" type="hidden" value="$total_price[$j]->{'totalbook'}" />
<input name="totalremote" type="hidden" value="$total_price[$j]->{'totalremote'}" />
<input name="totalcust" type="hidden" value="$total_price[$j]->{'totalcust'}" />
<input name="totalins" type="hidden" value="$total_price[$j]->{'totalins'}" />
<input name="totalwar" type="hidden" value="$total_price[$j]->{'totalwar'}" />
<input name="totaldut" type="hidden" value="$total_price[$j]->{'totaldut'}" />
<input name="totalvat" type="hidden" value="$total_price[$j]->{'totalvat'}" />
<input name="trans" type="hidden" value="$trans" />
<input name="book" type="hidden" value="3" />
<input name="cf" type="hidden" value="book" />

$frm

</form>
	|;
	}
	
print qq|
</td>
<td></TD>
<TD width=280 valign="top">
<TABLE width=100% height=220 cellpadding=5 style="border: 2px solid #000000; background-color:#FFFFFF">
<TR><TD height=20 valign="top">
<DIV name="showtitle" ID="showtitle" style="visibility: visible; overflow: hidden"><br />
<B>&nbsp;&nbsp;Please hover over the services on<br />&nbsp;&nbsp;the left for details.<br /><br />
&nbsp;&nbsp;Select a service to continue.</B></DIV>
</TD>
</TR>
<TR>
<TD height=50 valign="top">
<DIV name="showbox" ID="showbox" style="visibility: visible; overflow: hidden">&nbsp;</DIV>
</TD>
</TR>
<TR>
<TD valign="bottom">
<DIV name="showprice" ID="showprice" style="visibility: visible; overflow: hidden">&nbsp;</DIV>
</TD></TR>
</TABLE>
</TD></TR>
<tr>
<td>&nbsp;</td></tr></TABLE>
<DIV ID="none" style="visibility: hidden; position:absolute; top:0; left:0;">
<br /><B>&nbsp;&nbsp;Please hover over the services on<br />&nbsp;&nbsp;the left for details.<br /><br />&nbsp;&nbsp;Select a service to continue.</B>
</DIV>

<DIV ID="blank" style="visibility: hidden; position:absolute; top:0; left:0; height:100px;">
&nbsp;
</DIV>

</div>
|;

&footer($heading);

		}
	else
		{
		&error_page("Sorry, this item can not be carried by our service to the specified destination."); exit;
		}
}


sub book3{
	my $frm;

  $t_ua = LWP::UserAgent->new;
  $t_ua->agent("Mozilla/5.0");
  $t_ua->timeout(10);


	$tel1 =~ s/"/&quot;/g;
	$tel2 =~ s/"/&quot;/g;
	$tel3 =~ s/"/&quot;/g;
	$mob1 =~ s/"/&quot;/g;
	$mob2 =~ s/"/&quot;/g;
	$mob3 =~ s/"/&quot;/g;
	$fax1 =~ s/"/&quot;/g;
	$fax2 =~ s/"/&quot;/g;
	$fax3 =~ s/"/&quot;/g;
	$email =~ s/"/&quot;/g;

	$id_contact = "";
	$id_company = "";
	$id_add1 = "";
	$id_add2 = "";
	$id_town = "";
	$id_county = "";
	$id_postcode = "";
	$postcode_search = "";
	$prevent_pb = "";
	
	if( $id_source eq "221" )
		{
		if( $id_postcodeS )
			{
			$postcode_search = $id_postcodeS;
			$id_postcode = $id_postcodeS;
			$prevent_pb = " READONLY ";
			}
		else
			{
			$id_postcode = $id_postcodeS;
			}
		}
	else
		{
		if( $id_postcodeS )
			{
			$id_postcode = $id_postcodeS;
			}
		if( $id_cityS )
			{
			$id_town = $id_cityS;
			}
		}

	$frm = "<input type=\"hidden\" name=\"id_dest\" value=\"$id_dest\" />\n";
	$frm = $frm . "<input type=\"hidden\" name=\"id_source\" value=\"$id_source\" />\n";
	$frm = $frm . "<input type=\"hidden\" name=\"packagecount\" value=\"$packagecount\" />\n";
	$frm = $frm . "<input type=\"hidden\" name=\"id_postcodeD\" value=\"$id_postcodeD\" />\n";
	$frm = $frm . "<input type=\"hidden\" name=\"id_cityD\" value=\"$id_cityD\" />\n";
	$frm = $frm . "<input type=\"hidden\" name=\"content\" value=\"$content\" />\n";
	$frm = $frm . "<input type=\"hidden\" name=\"val\" value=\"$val\" />\n";
	$frm = $frm . "<input type=\"hidden\" name=\"insurance\" value=\"$insurance\" />\n";
	
	for( $l = 1; $l <= ${'packagecount'} ; $l++ )
		{
		my $w;
		$w = "weight[$l]";
		$frm = $frm . "<input type=\"hidden\" name=\"weight[$l]\" value=\"${$w}\" />\n";
	 	$w = "length[$l]";
		$frm = $frm . "<input type=\"hidden\" name=\"length[$l]\" value=\"${$w}\" />\n";
	 	$w = "width[$l]";
		$frm = $frm . "<input type=\"hidden\" name=\"width[$l]\" value=\"${$w}\" />\n";
	 	$w = "height[$l]";
		$frm = $frm . "<input type=\"hidden\" name=\"height[$l]\" value=\"${$w}\" />\n";
		}

	&myheader($heading);

	&topmenu($heading);

print qq|

<div class="ha8"><H1><font color="#000080" size="2"><b>Parcel Delivery</b></font></H1>
<h2><font color="#000080" size="1"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Collection Address (Step 3 of 6)</b></font></h2>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Please enter the details of where we need to collect the package(s) from.<br />|;

if( $cookie && $id_source eq "221" )
	{
	print qq|
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>If you like, you can use the Postcode Search to save typing in the address fields.</b><br />|;
	}
	

print qq|
<br />
<font size="2" face="Arial">

	<table style="background-color:#FDF3D0; width: 100%" align="left">
	<form name="form" method="POST" action="$script" onSubmit="return formcheck(this)">
	<input name="book" type="hidden" value="4" />
	<input name="cf" type="hidden" value="book" />
	<input name="cookie" type="hidden" value="$cookie" />
	<input name="zoneid" type="hidden" value="$zoneid" />
	<input name="servabr" type="hidden" value="$servabr" />
	<input name="carabr" type="hidden" value="$carabr" />
	<input name="service" type="hidden" value="$service" />
	<input name="tt1" type="hidden" value="$tt1" />
	<input name="tt2" type="hidden" value="$tt2" />
	<input name="remotett" type="hidden" value="$remotett" />
	<input name="warcharge" type="hidden" value="$warcharge" />
	<input name="dutcharge" type="hidden" value="$dutcharge" />
	<input name="dutiable" type="hidden" value="$dutiable" />
	<input name="partcover" type="hidden" value="$partcover" />
	<input name="invreq" type="hidden" value="$invreq" />
	<input name="custcharge" type="hidden" value="$custcharge" />
	<input name="remotecharge" type="hidden" value="$remotecharge" />
	<input name="remcharge" type="hidden" value="$remcharge" />
	<input name="satdelext" type="hidden" value="$satdelext" />
	<input name="satcolext" type="hidden" value="$satcolext" />
	<input name="bookcharge" type="hidden" value="$bookcharge" />
	<input name="fueled" type="hidden" value="$fueled" />
	<input name="vat" type="hidden" value="$vat" />
	<input name="descript" type="hidden" value="$descript" />
	<input name="price" type="hidden" value="$price" />
	<input name="totalfuel" type="hidden" value="$totalfuel" />
	<input name="totalbook" type="hidden" value="$totalbook" />
	<input name="totalremote" type="hidden" value="$totalremote" />
	<input name="totalcust" type="hidden" value="$totalcust" />
	<input name="totaldut" type="hidden" value="$totaldut" />
	<input name="totalins" type="hidden" value="$totalins" />
	<input name="totalwar" type="hidden" value="$totalwar" />
	<input name="totalvat" type="hidden" value="$totalvat" />
	<input name="sendreceive" type="hidden" value="1" />
	<input name="trans" type="hidden" value="$trans" />

	$frm
|;

if( $cookie && $id_source eq "221" )
	{
print qq|
<!--		<tr>
			<td style="width: 200px">Post Code Search </td>
			<td style="width: 800px"><div style="float: left;">&nbsp;&nbsp;&nbsp;<input $prevent_pb name="postcode_search" type="text" SIZE=8 MAXLENGTH=8 style="vertical-align: middle; height: 18px;" value="$postcode_search" />&nbsp;&nbsp;<input type="button" name="findaddress" value="Find Address" size="20" style="vertical-align: middle; height: 22px;" onClick="fetch_pcode(this.form);" />&nbsp;&nbsp;</div><div style="vertical-align: middle; padding:3px; float:left;" id="pbinf">&nbsp;</div>&nbsp;&nbsp;<div style="vertical-align: middle; padding:3px; float:left;" id="addinf">&nbsp;</div></td>
		</tr>-->|;
	}
print qq|
		<tr>
			<td style="width: 200px">Contact Name <span class="text2">*</span></td>
			<td style="width: 800px">&nbsp;&nbsp;&nbsp;<input name="id_contact" id="id_contact" type="text" size="20" value="$id_contact" /></td>
		</tr>
		<tr>
			<td style="width: 200px">Company </td>
			<td style="width: 800px">&nbsp;&nbsp;&nbsp;<input name="id_company" id="id_company" type="text" size="20" value="$id_company" /></td>
		</tr>
		<tr>
			<td style="width: 200px">Land Phone <span class="text2">*</span></td>
			<td style="width: 800px">+&nbsp;<input name="tel1" type="text" size="5" />&nbsp;(&nbsp;<input name="tel2" type="text" size="5" />&nbsp;)&nbsp;&nbsp;<input name="tel3" type="text" size="21" /></td>
		</tr>
		<tr>
			<td style="width: 200px">Cell Phone </td>
			<td style="width: 800px">+&nbsp;<input name="mob1" type="text" size="5" />&nbsp;(&nbsp;<input name="mob2" type="text" size="5" />&nbsp;)&nbsp;&nbsp;<input name="mob3" type="text" size="21" /></td>
		</tr>
		<tr>
			<td style="width: 200px">Fax </td>
			<td style="width: 800px">+&nbsp;<input name="fax1" type="text" size="5" />&nbsp;(&nbsp;<input name="fax2" type="text" size="5" />&nbsp;)&nbsp;&nbsp;<input name="fax3" type="text" size="21" /></td>
		</tr>
		<tr>
			<td style="width: 200px">Address <span class="text2">*</span></td>
			<td style="width: 800px">&nbsp;&nbsp;&nbsp;<input name="id_add1" id="id_add1" type="text" size="28" value="$id_add1" /><br>
															 &nbsp;&nbsp;&nbsp;<input name="id_add2" id="id_add2" type="text" size="28" value="$id_add2" /></td>
		</tr>
		<tr>
			<td style="width: 200px">City <span class="text2">*</span></td>
			<td style="width: 800px">&nbsp;&nbsp;&nbsp;<input name="id_town" id="id_town" type="text" size="28" value="$id_town" /></td>
		</tr>
		<tr>
			<td style="width: 200px">County <span class="text2">*</span></td>
			<td style="width: 800px">&nbsp;&nbsp;&nbsp;<input name="id_county" id="id_county" type="text" size="28" value="$id_county" /></td>
		</tr>
		<tr>
			<td style="width: 200px">Post Code <span class="text2">*</span></td>
			<td style="width: 800px">&nbsp;&nbsp;&nbsp;<input $prevent_pb name="id_postcode" id="id_postcode" type="text" size="20" value="$id_postcode" /></td>
		</tr>
		<tr>
			<td style="width: 200px">Country </td>
			<td style="width: 800px">&nbsp;&nbsp;&nbsp;<b>|; 

			print get_country($id_source);
			
			print qq|</b></td>
		</tr>
		<tr>
			<td style="width: 200px">Email <span class="text2">*</span></td>
			<td style="width: 800px">&nbsp;&nbsp;&nbsp;<input name="email" type="text" size="47" value="$email" /></td>
		</tr>
		<tr>
			<td style="width: 200px">Ready Time <span class="text2">*</span></td>
			<td style="width: 800px">&nbsp;&nbsp;&nbsp;<input name="fromtime" type="text" size="5" MAXLENGTH=5 value="$fromtime" />&nbsp;&nbsp;(The time that your parcel is ready for collection. Format: HH:MM)</td>
		</tr>
		<tr>
			<td style="width: 200px">Deadline Time <span class="text2">*</span></td>
			<td style="width: 800px">&nbsp;&nbsp;&nbsp;<input name="totime" type="text" size="5" MAXLENGTH=5 value="$totime" />&nbsp;&nbsp;(The last time that the parcel can be collected. Format: HH:MM)</td>
		</tr>
		<tr>
			<td style="width: 1000px" colspan="2" align="center"><center><br /><input type="submit" value="Next" size="20" />&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" value="Reset" size="20" /></center></td>
		</tr>
	</table>
	&nbsp;
	</form>
</font>
</div>

|;

&footer($heading);

}

sub book4{
	my $frm;

	unless ($id_contact) {&error_page("Incomplete data entered! Please enter the Sender Name field."); exit;} 
	unless ($tel1 && tel2 && tel3 && $tel1 =~ /^\s*[0-9]+\s*$/ && $tel2 =~ /^\s*[0-9]+\s*$/ && $tel3 =~ /^\s*[0-9]+\s*$/) {&error_page("Incomplete data entered! Please enter the Land Phone field."); exit;} 
	unless ($mob1 =~ /^\s*[0-9]*\s*$/ && $mob2 =~ /^\s*[0-9]*\s*$/ && $mob3 =~ /^\s*[0-9]*\s*$/) {&error_page("Wrong data specified! Sender Cell Phone is invalid."); exit;} 
	unless ($fax1 =~ /^\s*[0-9]*\s*$/ && $fax2 =~ /^\s*[0-9]*\s*$/ && $fax3 =~ /^\s*[0-9]*\s*$/) {&error_page("Wrong data specified! Sender Fax is invalid."); exit;} 
	unless ($id_add1) {&error_page("Incomplete data entered! Please enter the Address field."); exit;} 
	unless ($id_town) {&error_page("Incomplete data entered! Please enter the City field."); exit;} 
	unless ($id_county) {&error_page("Incomplete data entered! Please enter the County field."); exit;} 
	unless ($id_source) {&error_page("Incomplete data entered! Please enter the Country field."); exit;} 
	unless ($id_postcode) {&error_page("Incomplete data entered! Please enter the Post Code field."); exit;} 
	unless ($email && trim($email) =~ m~^(?:[a-zA-Z0-9_^&amp;/+-])+(?:\.(?:[a-zA-Z0-9_^&amp;/+-])+)*@(?:(?:\[?(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?))\.){3}(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\]?)|(?:[a-zA-Z0-9-]+\.)+(?:[a-zA-Z]){2,}\.?)$~)  {&error_page("Incomplete data entered! Please enter a valid Email Address."); exit;} 
	unless ($fromtime && $fromtime =~ /^\s*([0-1][0-9])|(2[0-4]):[0-5][0-9]\s*$/) {&error_page("Incomplete data entered! Please enter the Ready Time field. (Format HH:MM)"); exit;} 
	unless ($totime && $totime =~ /^\s*([0-1][0-9])|(2[0-4]):[0-5][0-9]\s*$/) {&error_page("Incomplete data entered! Please enter the Deadline Time field. (Format HH:MM)"); exit;} 

	if( $fromtime gt $totime )
		{
		&error_page("Wrong data specified! Ready Time must be less than Deadline Time."); exit;
		}

	$id_contact =~ s/"/&quot;/g;
	$id_company =~ s/"/&quot;/g;
	$tel1 =~ s/"/&quot;/g;
	$tel2 =~ s/"/&quot;/g;
	$tel3 =~ s/"/&quot;/g;
	$mob1 =~ s/"/&quot;/g;
	$mob2 =~ s/"/&quot;/g;
	$mob3 =~ s/"/&quot;/g;
	$fax1 =~ s/"/&quot;/g;
	$fax2 =~ s/"/&quot;/g;
	$fax3 =~ s/"/&quot;/g;
	$id_add1 =~ s/"/&quot;/g;
	$id_add2 =~ s/"/&quot;/g;
	$id_town =~ s/"/&quot;/g;
	$id_county =~ s/"/&quot;/g;
	$id_postcode =~ s/"/&quot;/g;
	$email =~ s/"/&quot;/g;
	$dest_tel1 =~ s/"/&quot;/g;
	$dest_tel2 =~ s/"/&quot;/g;
	$dest_tel3 =~ s/"/&quot;/g;
	$dest_mob1 =~ s/"/&quot;/g;
	$dest_mob2 =~ s/"/&quot;/g;
	$dest_mob3 =~ s/"/&quot;/g;
	$dest_fax1 =~ s/"/&quot;/g;
	$dest_fax2 =~ s/"/&quot;/g;
	$dest_fax3 =~ s/"/&quot;/g;
	$dest_email =~ s/"/&quot;/g;

	$id_dest_contact = "";
	$id_dest_company = "";
	$id_dest_add1 = "";
	$id_dest_add2 = "";
	$id_dest_city = "";
	$id_dest_state = "";
	$id_dest_postcode = "";
	$postcode_search = "";
	$prevent_pb = "";

	if( $id_dest eq "221" )
		{
		if( $id_postcodeD )
			{
			$postcode_search = $id_postcodeD;
			$id_dest_postcode = $id_postcodeD;
			$prevent_pb = " READONLY ";
			}
		else
			{
			$id_dest_postcode = $id_postcodeD;
			}
		}
	else
		{
		if( $id_postcodeD )
			{
			$id_dest_postcode = $id_postcodeD;
			}
		if( $id_cityS )
			{
			$id_dest_city = $id_cityD;
			}
		}
	
	my $usercgi = new CGI; 
	my $userip = $usercgi->remote_host(); 
	
	$frm = "<input type=\"hidden\" name=\"id_dest\" value=\"$id_dest\" />\n";
	$frm = $frm . "<input type=\"hidden\" name=\"id_source\" value=\"$id_source\" />\n";
	$frm = $frm . "<input type=\"hidden\" name=\"packagecount\" value=\"$packagecount\" />\n";
	$frm = $frm . "<input type=\"hidden\" name=\"content\" value=\"$content\" />\n";
	$frm = $frm . "<input type=\"hidden\" name=\"val\" value=\"$val\" />\n";
	$frm = $frm . "<input type=\"hidden\" name=\"fromtime\" value=\"$fromtime\" />\n";
	$frm = $frm . "<input type=\"hidden\" name=\"totime\" value=\"$totime\" />\n";
	$frm = $frm . "<input type=\"hidden\" name=\"insurance\" value=\"$insurance\" />\n";
	
	for( $l = 1; $l <= ${'packagecount'} ; $l++ )
		{
		my $w;
		$w = "weight[$l]";
		$frm = $frm . "<input type=\"hidden\" name=\"weight[$l]\" value=\"${$w}\" />\n";
	 	$w = "length[$l]";
		$frm = $frm . "<input type=\"hidden\" name=\"length[$l]\" value=\"${$w}\" />\n";
	 	$w = "width[$l]";
		$frm = $frm . "<input type=\"hidden\" name=\"width[$l]\" value=\"${$w}\" />\n";
	 	$w = "height[$l]";
		$frm = $frm . "<input type=\"hidden\" name=\"height[$l]\" value=\"${$w}\" />\n";
		}

&myheader($heading);

&topmenu($heading);

print qq|

<div class="ha8"><H1><font color="#000080" size="2"><b>Parcel Delivery</b></font></H1>
<h2><font color="#000080" size="1"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Delivery Address (Step 4 of 6)</b></font></h2>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Please enter the full delivery address.<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;You must include the postcode / zipcode whenever possible.<br />|;

if( $cookie && $id_dest eq "221" )
	{
	print qq|
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>If you like, you can use the Postcode Search to save typing in the address fields.</b><br />|;
	}

print qq|
<br />
<font size="2" face="Arial">

	<table style="background-color:#FDF3D0; width: 100%" align="left">
		<tr>
		</tr>
	<form name="form" method="POST" action="$script" onSubmit="return formcheck(this)">
	<input name="book" type="hidden" value="5" />
|;

if( $userip eq "89.165.18.27" )
	{
	print qq|	<input name="cf" type="hidden" value="book2" />
|;
	}
else
	{
	print qq|	<input name="cf" type="hidden" value="book" />
|;
	}

	print qq|
	<input name="cf" type="hidden" value="book" />
	<input name="id_contact" type="hidden" value="$id_contact" />
	<input name="id_company" type="hidden" value="$id_company" />
	<input name="tel1" type="hidden" value="$tel1" />
	<input name="tel2" type="hidden" value="$tel2" />
	<input name="tel3" type="hidden" value="$tel3" />
	<input name="mob1" type="hidden" value="$mob1" />
	<input name="mob2" type="hidden" value="$mob2" />
	<input name="mob3" type="hidden" value="$mob3" />
	<input name="fax1" type="hidden" value="$fax1" />
	<input name="fax2" type="hidden" value="$fax2" />
	<input name="fax3" type="hidden" value="$fax3" />
	<input name="id_add1" type="hidden" value="$id_add1" />
	<input name="id_add2" type="hidden" value="$id_add2" />
	<input name="id_town" type="hidden" value="$id_town" />
	<input name="id_county" type="hidden" value="$id_county" />
	<input name="id_source" type="hidden" value="$id_source" />
	<input name="id_postcode" type="hidden" value="$id_postcode" />
	<input name="email" type="hidden" value="$email" />
	<input name="zoneid" type="hidden" value="$zoneid" />
	<input name="servabr" type="hidden" value="$servabr" />
	<input name="carabr" type="hidden" value="$carabr" />
	<input name="service" type="hidden" value="$service" />
	<input name="tt1" type="hidden" value="$tt1" />
	<input name="tt2" type="hidden" value="$tt2" />
	<input name="remotett" type="hidden" value="$remotett" />
	<input name="warcharge" type="hidden" value="$warcharge" />
	<input name="dutcharge" type="hidden" value="$dutcharge" />
	<input name="dutiable" type="hidden" value="$dutiable" />
	<input name="partcover" type="hidden" value="$partcover" />
	<input name="invreq" type="hidden" value="$invreq" />
	<input name="custcharge" type="hidden" value="$custcharge" />
	<input name="remotecharge" type="hidden" value="$remotecharge" />
	<input name="remcharge" type="hidden" value="$remcharge" />
	<input name="satdelext" type="hidden" value="$satdelext" />
	<input name="satcolext" type="hidden" value="$satcolext" />
	<input name="bookcharge" type="hidden" value="$bookcharge" />
	<input name="fueled" type="hidden" value="$fueled" />
	<input name="vat" type="hidden" value="$vat" />
	<input name="descript" type="hidden" value="$descript" />
	<input name="price" type="hidden" value="$price" />
	<input name="totalfuel" type="hidden" value="$totalfuel" />
	<input name="totalbook" type="hidden" value="$totalbook" />
	<input name="totalremote" type="hidden" value="$totalremote" />
	<input name="totalcust" type="hidden" value="$totalcust" />
	<input name="totalins" type="hidden" value="$totalins" />
	<input name="totalwar" type="hidden" value="$totalwar" />
	<input name="totaldut" type="hidden" value="$totaldut" />
	<input name="totalvat" type="hidden" value="$totalvat" />
	<input name="sendreceive" type="hidden" value="2" />
	<input name="trans" type="hidden" value="$trans" />

	$frm
|;


if( $cookie && $id_dest eq "221" )
	{
	print qq|
<!--		<tr>
			<td style="width: 200px">Post Code Search </td>
			<td style="width: 800px"><div style="float: left;">&nbsp;&nbsp;&nbsp;<input $prevent_pb name="postcode_search" type="text" SIZE=8 MAXLENGTH=8 value="$postcode_search" style="vertical-align: middle; height: 18px;" />&nbsp;&nbsp;<input type="button" name="findaddress" value="Find Address" size="20" style="vertical-align: middle; height: 22px;" onClick="fetch_pcode(this.form);" />&nbsp;&nbsp;</div><div style="vertical-align: middle; padding:3px; float:left;" id="pbinf">&nbsp;</div>&nbsp;&nbsp;<div style="vertical-align: middle; padding:3px; float:left;" id="addinf">&nbsp;</div></td>
		</tr>-->
	|;
	}

print qq|
		<tr>
			<td style="width: 200px">Recipient Name <span class="text2">*</span></td>
			<td style="width: 800px">&nbsp;&nbsp;&nbsp;<input name="id_dest_contact" id="id_dest_contact" type="text" size="20" value="$id_dest_contact" /></td>
		</tr>
		<tr>
			<td style="width: 200px">Recipient Company </td>
			<td style="width: 800px">&nbsp;&nbsp;&nbsp;<input name="id_dest_company" id="id_dest_company" type="text" size="20" value="$id_dest_company" /></td>
		</tr>
		<tr>
			<td style="width: 200px">Land Phone <span class="text2">*</span></td>
			<td style="width: 800px">+&nbsp;<input name="dest_tel1" type="text" size="5" />&nbsp;(&nbsp;<input name="dest_tel2" type="text" size="5" />&nbsp;)&nbsp;&nbsp;<input name="dest_tel3" type="text" size="21" /></td>
		</tr>
		<tr>
			<td style="width: 200px">Cell Phone </td>
			<td style="width: 800px">+&nbsp;<input name="dest_mob1" type="text" size="5" />&nbsp;(&nbsp;<input name="dest_mob2" type="text" size="5" />&nbsp;)&nbsp;&nbsp;<input name="dest_mob3" type="text" size="21" /></td>
		</tr>
		<tr>
			<td style="width: 200px">Fax </td>
			<td style="width: 800px">+&nbsp;<input name="dest_fax1" type="text" size="5" />&nbsp;(&nbsp;<input name="dest_fax2" type="text" size="5" />&nbsp;)&nbsp;&nbsp;<input name="dest_fax3" type="text" size="21" /></td>
		</tr>
		<tr>
			<td style="width: 200px">Address <span class="text2">*</span></td>
			<td style="width: 800px">&nbsp;&nbsp;&nbsp;<input name="id_dest_add1" id="id_dest_add1" type="text" size="28" value="$id_dest_add1" /><br>
															 &nbsp;&nbsp;&nbsp;<input name="id_dest_add2" id="id_dest_add2" type="text" size="28" value="$id_dest_add2" /></td>
		</tr>
		<tr>
			<td style="width: 200px">City <span class="text2">*</span></td>
			<td style="width: 800px">&nbsp;&nbsp;&nbsp;<input name="id_dest_city" id="id_dest_city" type="text" size="28" value="$id_dest_city" /></td>
		</tr>
		<tr>
			<td style="width: 200px">County <span class="text2">*</span></td>
			<td style="width: 800px">&nbsp;&nbsp;&nbsp;<input name="id_dest_state" id="id_dest_state" type="text" size="28" value="$id_dest_state" /></td>
		</tr>
		<tr>
			<td style="width: 200px">Post Code <span class="text2">*</span></td>
			<td style="width: 800px">&nbsp;&nbsp;&nbsp;<input $prevent_pb name="id_dest_postcode" id="id_dest_postcode" type="text" size="20" value="$id_dest_postcode" /></td>
		</tr>
		<tr>
			<td style="width: 200px">Country </td>
			<td style="width: 800px">&nbsp;&nbsp;&nbsp;<b>|;
			
			print get_country($id_dest);
			
			print qq|</b></td>
		</tr>
		<tr>
			<td style="width: 200px">Email </td>
			<td style="width: 800px">&nbsp;&nbsp;&nbsp;<input name="dest_email" type="text" size="47" value="$dest_email" /></td>
		</tr>
		<tr>
			<td style="width: 1000px" colspan="2" align="center"><center><br /><input type="submit" value="Next" size="20" />&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" value="Reset" size="20" /></center></td>
		</tr>
	</table>
	&nbsp;
	</form>
</font>
</div>

|;

&footer($heading);

}


sub book5{
	my $frm;

	unless ($id_dest_contact) {&error_page("Incomplete data entered! Please enter the Recipient Name field."); exit;} 
	unless ($dest_tel1 && dest_tel2 && dest_tel3 && $dest_tel1 =~ /^\s*[0-9]+\s*$/ && $dest_tel2 =~ /^\s*[0-9]+\s*$/ && $dest_tel3 =~ /^\s*[0-9]+\s*$/) {&error_page("Incomplete data entered! Please enter the Land Phone field."); exit;} 
	unless ($dest_mob1 =~ /^\s*[0-9]*\s*$/ && $dest_mob2 =~ /^\s*[0-9]*\s*$/ && $dest_mob3 =~ /^\s*[0-9]*\s*$/) {&error_page("Wrong data specified! Recipient Cell Phone is invalid."); exit;} 
	unless ($dest_fax1 =~ /^\s*[0-9]*\s*$/ && $dest_fax2 =~ /^\s*[0-9]*\s*$/ && $dest_fax3 =~ /^\s*[0-9]*\s*$/) {&error_page("Wrong data specified! Recipient Fax is invalid."); exit;} 
	unless ($id_dest_add1) {&error_page("Incomplete data entered! Please enter the Address field."); exit;} 
	unless ($id_dest_city) {&error_page("Incomplete data entered! Please enter the City field."); exit;} 
	unless ($id_dest_state) {&error_page("Incomplete data entered! Please enter the County field."); exit;} 
	unless ($id_dest) {&error_page("Incomplete data entered! Please enter the Country field."); exit;} 
	unless ($id_dest_postcode) {&error_page("Incomplete data entered! Please enter the Post Code field."); exit;} 
	if($dest_email)
		{
		unless (trim($dest_email) =~ m~^(?:[a-zA-Z0-9_^&amp;/+-])+(?:\.(?:[a-zA-Z0-9_^&amp;/+-])+)*@(?:(?:\[?(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?))\.){3}(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\]?)|(?:[a-zA-Z0-9-]+\.)+(?:[a-zA-Z]){2,}\.?)$~)  {&error_page("Incomplete data entered! Invalid Email Address."); exit;} 
		} 
	
	$id_contact =~ s/"/&quot;/g;
	$id_company =~ s/"/&quot;/g;
	$tel1 =~ s/"/&quot;/g;
	$tel2 =~ s/"/&quot;/g;
	$tel3 =~ s/"/&quot;/g;
	$mob1 =~ s/"/&quot;/g;
	$mob2 =~ s/"/&quot;/g;
	$mob3 =~ s/"/&quot;/g;
	$fax1 =~ s/"/&quot;/g;
	$fax2 =~ s/"/&quot;/g;
	$fax3 =~ s/"/&quot;/g;
	$id_add1 =~ s/"/&quot;/g;
	$id_add2 =~ s/"/&quot;/g;
	$id_town =~ s/"/&quot;/g;
	$id_county =~ s/"/&quot;/g;
	$id_postcode =~ s/"/&quot;/g;
	$email =~ s/"/&quot;/g;
	$id_dest_contact =~ s/"/&quot;/g;
	$id_dest_company =~ s/"/&quot;/g;
	$dest_tel1 =~ s/"/&quot;/g;
	$dest_tel2 =~ s/"/&quot;/g;
	$dest_tel3 =~ s/"/&quot;/g;
	$dest_mob1 =~ s/"/&quot;/g;
	$dest_mob2 =~ s/"/&quot;/g;
	$dest_mob3 =~ s/"/&quot;/g;
	$dest_fax1 =~ s/"/&quot;/g;
	$dest_fax2 =~ s/"/&quot;/g;
	$dest_fax3 =~ s/"/&quot;/g;
	$id_dest_add1 =~ s/"/&quot;/g;
	$id_dest_add2 =~ s/"/&quot;/g;
	$id_dest_city =~ s/"/&quot;/g;
	$id_dest_state =~ s/"/&quot;/g;
	$id_dest_postcode =~ s/"/&quot;/g;
	$dest_email =~ s/"/&quot;/g;

	$dest = &get_country($id_dest);
	$source = &get_country($id_source);


	&myheader($heading);

	&topmenu($heading);


	$frm = "<input type=\"hidden\" name=\"id_source\" value=\"$id_source\" />\n";
	$frm = $frm . "<input type=\"hidden\" name=\"id_dest\" value=\"$id_dest\" />\n";
	$frm = $frm . "<input type=\"hidden\" name=\"packagecount\" value=\"$packagecount\" />\n";
	$frm = $frm . "<input type=\"hidden\" name=\"content\" value=\"$content\" />\n";
	$frm = $frm . "<input type=\"hidden\" name=\"val\" value=\"$val\" />\n";
	$frm = $frm . "<input type=\"hidden\" name=\"fromtime\" value=\"$fromtime\" />\n";
	$frm = $frm . "<input type=\"hidden\" name=\"totime\" value=\"$totime\" />\n";
	$frm = $frm . "<input type=\"hidden\" name=\"insurance\" value=\"$insurance\" />\n";
	
	for( $l = 1; $l <= ${'packagecount'} ; $l++ )
		{
		my $w;
		$w = "weight[$l]";
		$frm = $frm . "<input type=\"hidden\" name=\"weight[$l]\" value=\"${$w}\" />\n";
	 	$w = "length[$l]";
		$frm = $frm . "<input type=\"hidden\" name=\"length[$l]\" value=\"${$w}\" />\n";
	 	$w = "width[$l]";
		$frm = $frm . "<input type=\"hidden\" name=\"width[$l]\" value=\"${$w}\" />\n";
	 	$w = "height[$l]";
		$frm = $frm . "<input type=\"hidden\" name=\"height[$l]\" value=\"${$w}\" />\n";
		}

print qq|

<div class="ha8"><H1><font color="#000080" size="2"><b>Parcel Delivery</b></font></H1>
<h2><font color="#000080" size="1"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Booking Confirmation (Step 5 of 6)</b></font></h2>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Please check to see if the booking items are correct.<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;If there is any error, you should discard it and start<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;a new qouting procedure.<br /><br />

<font size="2" face="Arial">
	<table style="background-color:#FDF3D0; width: 100%" align="left" border="1" cellpadding="2" cellspacing="0">
		<tr>
			<td style="background-color:#FDF3D0"><center><big><b>Collection Address</b></big></center></td>
		</tr>
		<tr>
			<td align="left">
			<b>Contact Name:</b> $id_contact<br />|;
	
			print "<b>Company:</b> $id_company<br />" if( $id_company );
			print "<b>Land Phone:</b> +$tel1 ( $tel2 ) $tel3<br />";
			print "<b>Cell Phone:</b> +$mob1 ( $mob2 ) $mob3<br />"  if( $mob1 || $mob2 || $mob3 );
			print "<b>Fax:</b> +$fax1 ( $fax2 ) $fax3<br />"  if( $fax1 || $fax2 || $fax3 );
			print "<b>Address:</b> $id_add1<br />";
			print "$id_add2<br />"  if( $id_add2 );

print qq|
			<b>Post Code:</b> $id_postcode<br />
			<b>City:</b> $id_town<br />
			<b>County:</b> $id_county<br />
			<b>Country:</b> $source|;

			print "<br /><b>Email:</b> $email" if($email);
			
print qq|<br />
			<b>Ready Time:</b> $fromtime<br />
			<b>Deadline Time:</b> $totime<br />
</td>
		</tr>
		<tr>
			<td style="background-color:#FDF3D0"><center><big><b>Delivery Address</b></big></td>
		</tr>
		<tr>
			<td align="left">
			<b>Recipient Name:</b> $id_dest_contact<br />|;
	
			print "<b>Recipient Company:</b> $id_dest_company<br />" if( $id_dest_company );
			print "<b>Land Phone:</b> +$dest_tel1 ( $dest_tel2 ) $dest_tel3<br />";
			print "<b>Cell Phone:</b> +$dest_mob1 ( $dest_mob2 ) $dest_mob3<br />"  if( $dest_mob1 || $dest_mob2 || $dest_mob3 );
			print "<b>Fax:</b> +$dest_fax1 ( $dest_fax2 ) $dest_fax3<br />"  if( $dest_fax1 || $dest_fax2 || $dest_fax3 );
			print "<b>Address:</b> $id_dest_add1<br />";
			print "$id_dest_add2<br />"  if( $id_dest_add2 );

print qq|
			<b>Post Code:</b> $id_dest_postcode<br />
			<b>City:</b> $id_dest_city<br />
			<b>County:</b> $id_dest_state<br />
			<b>Country:</b> $dest|;

			print "<br /><b>Email:</b> $dest_email" if($dest_email);
			
print qq|
</td>
		</tr>
		<tr>
			<td style="background-color:#FDF3D0"><center><big><b>Shipment Details</b></big></center></td>
		</tr>
		<tr>
			<td align="left">|;

			print qq|<b>Content:</b> |;
			if( $trans eq "1" )
				{ 
				print "Pallet<br />"; 
				print qq|<b>Contents:</b> $content<br />|;
				}
			elsif( $trans eq "2" )
				{ 
				print "Document<br />"; 
				}
			else
				{ 
				print "Parcel<br />"; 
				print qq|<b>Contents:</b> $content<br />|;
				}

			print qq|
			<b>Value:</b> £ $val<br />

			<b>Insurance Cover:</b> £ $insurance<br />

			<b>Number of Packages:</b> packagecount<br /><br />
				
			<table width="820" align="left" border="0">
			<tr>
			<th width="100" align="left">Pack</th>
			<th width="120" align="left">Weight <small>(kg)</small></th>
			<th width="120" align="left">Length <small>(cm)</small></th>
			<th width="120" align="left">Width <small>(cm)</small></th>
			<th width="120" align="left">Height <small>(cm)</small></th>
			</tr>	
			|;
			
			for( $l = 1; $l <= ${'packagecount'} ; $l++ )
				{
				my $w;

				print "<tr>\n";
				print "<td width=\"100\" align=\"left\">$l</td>";
				
				$w = "weight[$l]";
				print "<td width=\"180\"  align=\"left\">${$w}</td>";

				$w = "length[$l]";
				print "<td width=\"180\"  align=\"left\">${$w}</td>";

				$w = "width[$l]";
				print "<td width=\"180\"  align=\"left\">${$w}</td>";

				$w = "height[$l]";
				print "<td width=\"180\"  align=\"left\">${$w}</td>";
				print "</tr>\n";
				}
				
			print "</table>\n";

			print qq|
			</td>
		</tr>
		<tr>
			<td style="background-color:#FDF3D0"><center><big><b>Service &amp; Quote</b></big></center></td>
		</tr>
		<tr>
			<td align="left">

<table border=0 width=100% cellpadding=0 cellspacing=0>
<tr>
<td width=60 valign="middle" align="left"><image src="img/services/\L$carabr.gif" /></td>|;

print qq|
<td valign="middle"><FONT SIZE=4><B>$service</B></FONT></td>
</tr>
</table>

<b>Delivery Time:</b> |;

if( $tt1 == $tt2 )
	{
	if( $tt1 + $remotett == 1 )
		{
		print "Next Working Day";
		}
	else
		{
		print $tt1 + $remotett;
		print " Working Days";
		}
	}
else
	{
	print $tt1 + $remotett;
	print "-";
	print $tt2 + $remotett;
	print " Working Days";	
	}


if( $remotett )
	{
	print "&nbsp;&nbsp;(The collection and/or delivery address is remote area and this is included in the time frame)";
	}

	print "<br />\n<ul>";

if( $dutcharge > 0 )
	{
	my $strstr;
	if( $dutiable )
		{
		$strstr = $dutiable;
		}
	else
		{
		$strstr = $s_duttext;
		}
	my $strval = omit0($dutcharge);
	$strstr =~ s/\[value\]/$strval/i;
	print "<li>$strstr</li>";
	}

if( $warcharge )
	{ 
	my $strstr = $s_wartext;
	my $strval = omit0($warcharge);
	$strstr =~ s/\[value\]/$strval/i;
	print "<li>$strstr</li>";
	}

if( $insurance && totalins )
	{ 
	print "<li>£$insurance Insurance Cover included</li>";
	}

if( $partcover )
	{
	print "<li>" . $partcover . "</li>";
	}

if( $invreq )
	{
	print "<li>$s_invtext</li>";
	}

if( $custcharge )
	{
	my $strstr = $s_custtext;
	my $strval = omit0($custcharge);
	$strstr =~ s/\[value\]/$strval/i;
	print "<li>$strstr</li>";
	}

if( $remotecharge )
	{
	my $strstr = $s_remotetext;
	my $strval = omit0($remotecharge);
	$strstr =~ s/\[value\]/$strval/i;
	print "<li>$strstr</li>";
	}
else
	{
	if( $remcharge && $rem_charge[$servid]	== 0 )
		{
		my $strstr;
		if( $carabr eq "DHL" )
			{
			$strstr = $s_remotetext . " <u>MAY</u> apply. To find out if it's applied, please visit: <a href=\"http://raslist.dhl.com\" target=_BLANK>raslist.dhl.com</a>";
			}
		else
			{
			$strstr = $s_remotetext . " <u>MAY</u> apply.";
			}
		my $strval = omit0($remcharge);
		$strstr =~ s/\[value\]/$strval/i;
		print qq|<li><font color="#FF0000">$strstr</font></li>|;
		}
	}

if( $satdelext )
	{
	my $strstr = $s_satdelexttext;
	my $strval = omit0($satdelext);
	$strstr =~ s/\[value\]/$strval/i;
	print "<li>$strstr</li>";
	}

if( $satcolext )
	{
	my $strstr = $s_satcolexttext;
	my $strval = omit0($satcolext);
	$strstr =~ s/\[value\]/$strval/i;
	print "<li>$strstr</li>";
	}

if( $bookcharge )
	{
	my $strstr = $s_booktext;
	my $strval = omit0($bookcharge);
	$strstr =~ s/\[value\]/$strval/i;
	print "<li>$strstr</li>";
	}

if( $warcharge )
	{ 
	my $strstr = $s_wartext;
	my $strval = omit0($warcharge);
	$strstr =~ s/\[value\]/$strval/i;
	print "<li>$strstr</li>";
	}

if( $dutcharge )
	{
	my $strstr = $s_duttext;
	my $strval = omit0($dutcharge);
	$strstr =~ s/\[value\]/$strval/i;
	print "<li>$strstr</li>";
	}

if( $fueled )
	{
	my $strstr = $s_fueltext;
	my $strval = omit0($fueled);
	$strstr =~ s/\[value\]/$strval/i;
	print "<li>$strstr</li>";
	}

if( $vat )
	{
	my $strstr = $s_vattext;
	my $strval = omit0($vat);
	$strstr =~ s/\[value\]/$strval/i;
	print "<li>$strstr</li>";
	}

if( $descript )
	{
	print "<li>" . $descript . "</li>";
	}

print "</ul>";

	$mytotal_price = toCurr($price+$totalfuel+$totalbook+$totalremote+$totalcust+$dutcharge+$warcharge+$totalins);
	$mytotal_price_vated = toCurr($price+$totalfuel+$totalbook+$totalremote+$totalcust+$dutcharge+$totalvat+$warcharge+$totalins);

	$mytotal_price = $mytotal_price . ".00" unless( $mytotal_price =~ m/\./ );
	$mytotal_price = $mytotal_price . "0" if( $mytotal_price =~ m/\.\d$/ );
	$mytotal_price_vated = $mytotal_price_vated . ".00" unless( $mytotal_price_vated =~ m/\./ );
	$mytotal_price_vated = $mytotal_price_vated . "0" if( $mytotal_price_vated =~ m/\.\d$/ );

	print qq|<FONT SIZE=4><B>Price: £$mytotal_price|;
	
	if( $vat && $vat > 0 )
		{
		print " + ";
		print omit0($vat);
		print qq|% VAT|;
		}
	
	
	print qq|</B></FONT><BR />
			
</td>
		</tr>
		<tr>
			<td style="background-color:#FDF3D0"><center><big><b>Confirmation</b></big></center></td>
		</tr>
|;


print qq|			
		<tr>
			<td align="center"><center><form name="quoteconfirm" method="POST" action="$script" onsubmit="this.lastsubmit.disabled=true;">
			If you are sure about the above booking, please press the following button.<br /><br />

	By confirming the above order I accept the following Terms and Conditions:<br /><br />
	<textarea name="terms" readonly style="width:600px;height:240px;">
Terms & Conditions


As a user of this website (referred to as "you/your") you acknowledge that any use of this website including any transactions you make ("use/using") is subject to our terms and conditions below.. 


Definitions

Listed below the following terms that will be found in these terms of carriage: 

Consignment – A parcel or group of parcels sent through this service to each individual address. 
Consignee/Receiver – The person who is receiving the consignment. 
AWB/Airwaybill – The documentation placed on the parcel. 
Third Party - The carrier with whom the order is placed utilising the account that Europost Express has with the major carriers. 
Working Day - Monday to Friday from 9am to 5.30pm within the UK, excluding public and bank holidays. NB Please check with individual overseas countries to establish their working hours. 
Penalty Charge  £15.00 + VAT
Guarantee - Collection or delivery guarantee on applicable service or 'your money back'. 
Driver Release area - Carrier term for a 'safe' area where goods can be left without a signature (USA Only) 

Obligation to the customer 

Europost Express  will arrange delivery of the consignment/s through a third party service with a reputable carrier as chosen at the time of ordering. The Courier will operate between 9AM -5.30PM .

Europost Express can only accept orders online from UK residents, with a UK registered card to ensure VAT is applied correctly and any refunds / credits due can be applied. 


1-3 delivery attempts will be made for each consignment, depending on the service. If unsuccessful the consignment will be returned. It is the customers responsibility to track all orders and contact our offices prior to the return to rectify any issue. Once returned the item will not be re shipped free of charge, as delivery has been attempted and the return completes the agreed contract. 

Europost Express do not come into direct contact with the consignment/s but arrange for the collection through one of the major carriers that we hold an account. Please ensure the correct parcel is given to the correct collecting agent that you have chosen at the time of ordering. 

Export services can be collected from a Residential address or Business. Please note the Import services are collection from a Business address only. 

The carrier / Europost Express have the right to refuse a consignment for a given reason such as No Packaging, insufficient packaging or the consignment being too large. 
In addition Europost Express has the right to refuse any order/user from our system. 

All queries/claims must be directed through Europost Express Ltd who will then contact the relevant carrier on the sender's behalf. If the carrier is contacted directly, Europost Express Ltd may not be able to assist you with your query at a later date. 

Europost Express services are door to door. It is advised to check the zip code (Postcode) before sending for International addresses in case of exclusions. Please note many areas in Turkey, Uganda and Ukraine are not door to door. The only areas that are delivered to the door in Ukraine are as follows-Kiev,Dnipropetrovsk,Zaporizhya,Odessa,Kharkiv,Donetsk,Mariupol,Lviv. 

Please note shipments to the Reunion Isle, are classed as France, but only Express (Air) services will be available to this destination. If any other service (Road) is booked and the parcel returned, no refund will be given. 

All services offer signed for delivery. Delivery may be made to a close Neighbour should the recipient be out. Please also note that certain areas of the USA & Australia are classed as 'Driver release areas' this means that the carrier deems this a 'safe' area and parcels can be left at the door without a signature. No claim can be made for such deliveries. Please check before sending. 

This automated ordering system books the collection as requested by the customer. If this collection fails you must contact Europost Express Ltd where an alternative collection will be booked as soon as possible. 

The automated system books and charges for the delivery. If the consignment/s has to be returned then a return charge will be applied. 

Europost Express Ltd can only deliver to a full street address. 
We cannot deliver to a PO Box. If a consignment has to be returned for this reason, no refund will be given. 

Europost Express  require a telephone number for the receiver who may be called in the event of an address query. Please note for any overseas address a local number is needed, the carrier will not call a UK number. Europost Express  will not re ship any returned item if a telephone number has not been provided and the carry could not call to arrange delivery and no refund will be given.

All prices quoted on this web site are in pounds sterling. 

Payment is taken by our automated system at the end of your order once the service has been booked with our carrier. 

Europost Express reserves the right to refuse any order and will process payment security checks on certain transactions and values. 

Regular users will be given the option to become an Europost Express web member to gain special discounts after 3 months regular shipment ,The discount will be reflected in the quoted price in each member file. 


Tracking is available through our Web site Tracking is available up to a period of 12 weeks from sending. At that stage the tracking number may be re allocated. 
If the driver has used a different tracking number than expected then you will be able to track using the number left at the time of collection on the carriers own website .Hard copy Proof of Delivery will be charged at £5.00 per item. Please note the Proof of delivery is only kept for up to three months after delivery. 

All refunds will be processed within 65 working days. 

Europost Express act as an Online Reseller for the majority of the UK carriers. We do not deal with other Resellers, only the customer sending or receiving the parcel directly.


Prohibited & Restricted Items 

Please check that we are able to carry your contents before placing your order. Items that are strictly Prohibited are listed as such and CANNOT be sent through our services. 

Restricted Items can be sent but will travel without any inclusive or additional damage / loss cover and are therefore sent at the owner’s risk, no claim can be made under any circumstances. 

Please see the Prohibited / Restricted Items section. Prohibited / Restricted items could be subject to non collection, delay, return or confiscation by Customs. If a Prohibited / Restricted item is collected and then later returned, no refund of carriage will be given and return charges may be applicable. (Min. return Charge will be same as Delivery charge + £15.00 Penalty Charge + VAT).

In the event of damage a Prohibited/Restricted item may be held for collection by the Customer. This may be the case if the goods are prohibited and cannot be sent or damaged to such an extent that onward forwarding is not possible. If this is the case you will be notified in writing that goods must be collected within 7 days following this point they will be discarded. If the goods are so badly damaged that the contents are destroyed or that the goods pose a Health & Safety risk then they may be immediately discarded, again you will be notified in writing. No claim for loss or damage can be made on a Prohibited / Restricted item. 

In addition the sender will be liable for any damages caused in transit to other shipments or property resulting from sending a Prohibited / Restricted item. 

Europost Express  operates an automated booking service. If you chose to purchase additional transit cover on a Prohibited / Restricted item the cover is invalidated. 

In addition Europost Express have a check box that must be ticked to state the Prohibited / Restricted items & Terms and Conditions list have been read before an order can be completed. 

Please note - Hazardous / Dangerous goods are strictly prohibited from our services. Failure to declare Dangerous goods can lead to prosecution where unlimited fines and imprisonment is possible. 

Item/s sent within a Hazardous box will be classed as such. DO NOT RE USE OLD HAZARDOUS BOXES. 

The Prohibited Items / Restricted Items must be read and understood as part of these Terms and Conditions. 

Collection & Delivery 

The automated system books the collection as per the customer's request. The system will tell you if the time slot is available if not you can select an alternative. Please note that collection date & time is not guaranteed on any service apart from Europost Express  which offers a money back guarantee if collection fails. 

In the rare event that the courier cannot make the collection please contact Europost Express  immediately where we will re book for collection the Same day if Cut off has not passed or the next working day. Please be aware that we are not aware of any issues with collection until we are contacted. 

Please note, we cannot specify a morning collection. You can request after a certain time if permitted, but collections will be made up until 5.30pm on any given working day. 

The Courier will operate between 8.00am- 5.30pm or for Collect and Deliver up until 9pm if the address is identified as Residential. 

Europost Express services are door to door. It is advised to check the zip code(Postcode)  before sending for International addresses in case of exclusions. Please note many areas in Turkey, Uganda and Ukraine are not door to door. The only areas that are delivered to the door in Ukraine are as follows-Kiev, Dnipropetrovsk , Zaporizhya ,Odessa ,Kharkiv ,Donetsk ,Mariupol, Lviv. 

1-3 delivery attempts will be made for each consignment, depending on the service. If unsuccessful the consignment will be returned. It is the customers responsibility to track all orders and contact our offices prior to the return to rectify any issue. Once returned the item will not be re shipped free of charge, as delivery has been attempted and the return completes the agreed contract. 

Collections & Deliveries are made on Working days only. Saturday collections / Deliveries are available on request but are not guaranteed. Refund of the Saturday surcharge will be applied if delivery is not made on the relevant Saturday. 

Please ensure you are in at the collection time that you request. A surcharge of £15.00 will be applied if you are out when the driver tries to collect. 

A receipt must always be obtained on collection of your consignment. No claim can be made if a collection receipt has not been obtained as there is no proof that the carrier has collected the parcel. In such a case a full refund will be given as there is no proof of service taking place. 


On the advised services the driver will leave a Waybill document that you may have to complete with the to and from address details. 
It is the customer's responsibility to ensure that all the details are correctly completed and displayed on the correct parcel and no claim or reduction will be made if the parcel is sent and the details were incorrect or placed on the incorrect parcel. It is not the driver's responsibility to check this information, so please ensure this is checked before he leaves. 

The price of any timed deliveries that are not delivered by the guaranteed time, such as pre 10am and pre 10.30am service will be refunded in full, so long as the reason for delay has not been a customs query, remote area delivery, Incorrect information having been supplied or attempted delivery. The only exceptions to this is the Europost Express service where the courier charge will be refunded in full if the collection or delivery fails to covered areas within the UK. 

Consignments collected and or delivered in certain areas in Scotland, Wales, Cornwall, Northern Ireland and Offshore Islands may be subject to a 24-48 hour delay with all carriers ,which can take up to 7 days. Glasgow can take an additional hour on the by 9.30am, 3pm service. Please check before sending. 

Shipments to and from remote areas nationally and internationally on all services may be subject to delay and possible service downgrade. Please check the address with us prior to sending for advised transit times. 

Please note that any guaranteed service will guarantee a delivery time once collected. 
In the rare event that the courier cannot make the collection please contact Europost Express immediately where we will re book for collection the Same day if Cut off has not passed or the next working day.

Please note that any re collection requests after 5.00pm will not be dealt with until the following working day. Any re collections for our next day only .
Please be aware that we are not aware of any issues with collection until we are contacted. 

No refund / discount will be given for failed collection unless the Europost Express  service has been booked where a full money back guarantee is in place for failed collection or delivery. 

Transit times must be checked for the service ordered. Guaranteed services are not guaranteed to remote areas. Please check the collection and delivery address before sending to see if the guarantee can be offered for your consignment. 

Non guaranteed shipments list the specified transit time and as stated, are not guaranteed. 

On some services there will be a surcharge if a re delivery is necessary. Please check the service description prior to sending. 

A customs invoice must be completed for ALL countries outside the European Union. An accurate description and reason for Export must be entered on this invoice. If customs find different items than declared or an incorrect reason for export stated (such as Gift when actually purchased) then a Surcharge could be applied or the shipment returned. 

Four copies of the customs Invoice must be given to the driver on collection. 

You will be able to track the progress of your consignment online from our home page. The documentation that is provided at the end of your order or which the driver brings in will contain the tracking number. 

Some of our services are subject to a redelivery charge. 
This is detailed in the surcharges section. Please ensure that the receiver is in to accept the delivery or you will have to pay an additional charge on each delivery attempt. 

Please note we cannot mail to any PO Box address or BFPO address through our services. 

Parcels should not be strapped or attached together. This is not a secure way for parcels to travel in the courier network. No claim can be made for any additional item that was strapped to the original in the event that they become separated in transit. 

Please note that any item travelling through our services must be able to withstand a short drop, fragile items should not be sent though our services. Please see our packaging guidelines and Prohibited / Restricted Items in addition. 


Customs Clearance 

You are pre paying for the postage charges of your consignment/s only. Europost Express Ltd has no control over any customs queries, delays or charges that may arise. Customs charges must be paid in addition by the sender or receiver before delivery is made. Europost Express Ltd reserve the right to pass these charges directly onto the person who placed the order. If you do not wish to pay the charges and the consignment is returned, all return charges will also be passed on. 

Documents up to 1.5Kg do not need a commercial invoice to any destination. These should be declared as zero value. If a value is entered Europost Express cannot be held responsible for any charges that may apply. 

Consignment/s that exceed the value of £4,699 may be delayed as they will require further documentation for clearance. Europost Express do not advise sending any consignment over £1000 as no Transit Cover, cover can be offered over this value. 


Surcharges 

By entering the weight and dimensions of your consignment/s you are pre paying for the postage. If the consignment /s are heavier then the additional weight will be charged to the card that the order was placed on together with a surcharge of £20 + VAT. Additional charges will be confirmed in writing. 

Please ensure you are in at the collection time that you request. A surcharge of £15.00 will be applied if you are out when the driver tries to collect. 

Transit times must be checked for the service ordered. On some services there will be a surcharge if a redelivery is necessary. 

Saturday delivery surcharge is available on request. See section on Collection and Delivery. 

Some areas will be subject to a remote area surcharge. This will be calculated in the quoting system at the time of booking. 

You are pre paying for the postage charges. Any Customs charges will be passed on in addition should they arise. 
Europost Express  cannot carry pallets unless on the Pallet service if available. Any order that is collected on a pallet that is booked on any of our standard services will be surcharged. 

Pallet Service not available for out of UK

Delay / Damage / Loss Claims 

Late Delivery Claims 

Any item that is sent to a guaranteed area on a guaranteed delivery service will be refunded in full. Certain exclusions apply, see below. 

Exclusions 

A Consignment will only be considered late if it is sent on a guaranteed service to a guaranteed area and exceeds the guaranteed delivery date. 

The money back Guarantee for late deliveries is invalidated under any the following circumstances - 
•	Acts of God 
•	Consequences of war 
•	Insufficient packaging / Incorrect labelling 
•	Prohibited / Restricted Items - listed in our Help and information section

On the advised services the driver will leave a Waybill document that you may have to complete with them to and from address details. 
It is the customer's responsibility to ensure that all the details are correctly completed and displayed on the correct parcel and no claim or reduction will be made if the parcel is sent and the details were incorrect or placed on the incorrect parcel. It is not the driver's responsibility to check this information, so please ensure this is checked before he leaves. 

We may supply documentation to accompany your shipment. You will be advised of this at the time of ordering. This must go with the shipment, if not your shipment could be delayed and the carrier may well charge you a higher premium direct. 

Guaranteed services are guaranteed to most areas. It is the Customer responsibility to check the area they are sending to is covered by this guarantee. A refund to admin rate will only be given if a delivery is made late to an area that is guaranteed, as long as the delay has not been caused by customs, incorrect addressing or a failed attempted delivery. 

Please note that any guaranteed service will guarantee a delivery time once collected. 

In the rare event that the courier cannot make the collection please contact Europost Express  immediately where we will re book for collection the Same day if Cut off has not passed or the next working day. Please be aware that we are not aware of any issues with collection until we are contacted. 


Please note we cannot mail to any PO Box address or BFPO address through our services. If such a shipment is sent no claim can be made for delay and return charges may apply. 

If the item is not correctly labelled and or addressed the claim will be voided. 

Any claim must be brought to us within 10 days of receipt in the case of delay. 

Damaged / Lost Claims 

The maximum claim value is the transit cover that is chosen at the time of ordering. 

Each service includes a limited £50 Transit cover against loss or damage. Enhanced cover can be added during the ordering process up to the maximum consignment value of £1000. 

Any enhanced cover that is selected replaces the inclusive cover. 

The claim will be paid to the sender only, the details entered at the time of ordering. Please ensure the exact name or company name is entered at the time of booking as we will charge £10.00 if the cheque needs to be re issued. 

In the event of a claim a copy invoice will be needed to be provided to prove the value of the consignment/s. 

In the rare event of damage all packaging must be kept for inspection by the carrier. The item must be available for inspection in the state it was delivered, at the address it was delivered to. If the item is moved / repaired or if the packaging is not kept any claim will be voided. Photographs of the internal and external packaging as well as the damaged item must be supplied to start a claim. 

In the event of damage repair costs must be supplied. If the item cannot be repaired then we would need this in writing from a specialist for the full claim amount to be considered. 

In the event that a claim is approved and repair costs are paid, no postage will be paid. Postage costs are only paid on approved claims where the full value of the goods have been paid. 

A lost claim can only be processed once the carrier has made extensive searches and deems the goods as lost. 

Any claim must be brought to us within 10 days of receipt in the case of delay/damage, and 28 days in the case of loss. 

Claims can only be re considered up to a period of 12 weeks after despatch as the carrier only holds records for up to this period. If you wish to contest any claim decision, please write in to the Customer Service Director within this period. 

Europost Express  aim to resolve any claim within 28 working days. 

Exclusions 

A receipt must always be obtained on collection of your consignment. No claim can be made if a collection receipt has not been obtained as there is no proof that the carrier has collected the parcel. In such a case a full refund will be given as there is no proof of service taking place. 

Your consignment/s must be packed to a professional standard, packed within a double walled box with the contents cushioned and protected inside. The packaging must also be sufficient to protect the products weight. Any claim resulting from a parcel that is not packaged to a professional standard and in line with the above will be declined. 

In addition the sender will be liable for any damages caused in transit to other shipments or property resulting from sending a consignment that is insufficiently packaged. 

No claim can be made for a Prohibited / Restricted item 

Prohibited / Restricted Items / Items not boxed or sufficiently packed are excluded from our services and could be subject to delay / return / Held for collection by customer. Such goods could also be Discarded if A- they are damaged to such an extent such as smashed glass B- If goods have been held for collection by customer and the time limit advised has been exceeded. Please be aware in such a circumstance, the customer will be aware that collection of said goods must be arranged by a certain date or the goods may incur storage charges, and finally discarded at a cost payable by the sender. No claim for loss or damage can be made on a Prohibited / Restricted Items /Items not boxed or sufficiently packed are excluded from our services and if sent are sent at the owners risk. 

No claim can be made for a Hazardous / Dangerous shipment. 

Hazardous / Dangerous goods are strictly prohibited from our services. Failure to declare Dangerous goods can lead to prosecution where unlimited fines and imprisonment is possible. 

Please see the Prohibited / Restricted Items section in Help and information 

No claim can be made for an item delivered without signature to a 'Driver Release area' (See Definitions) 

The maximum claim value on each consignment is £50.00
Europost Express operates an automated booking service. If you chose to purchase additional transit cover on a Prohibited / Restricted item the cover is invalidated. 

Please note that any item travelling through our services must be able to withstand a short drop, fragile items should not be sent though our services. Any item that is damaged as a result of a fall, with the packaging intact will therefore be declined. Please see our packaging guidelines and Prohibited / Restricted items in addition. 

If the outside packaging is intact, then any claim for damage to the consignment will be invalidated as the internal packaging would not have been sufficient to protect the product. 

Parcels should not be strapped or attached together. This is not a secure way for parcels to travel in the courier network. No claim can be made for any additional item that was strapped to the original in the event that they become separated in transit. 

If the item is moved / repaired or if the packaging is not kept until the claim is completed, then the claim will be voided. 

The damaged item together with all packaging must be kept until the claim is concluded as more photographs or inspection of the item may be necessary. If the damage item and or packaging is not kept the claim will be invalidated. 

Please be aware that you must sign for goods as "damaged" if this is the case. If you sign for goods in good condition, you will not be able to proceed with a claim. If you are unable to check when the driver is there, please sign for goods as "unchecked". 

No claim can be made for an item that has been requested to be returned but then delivered to the receiver. We cannot guarantee to stop any item once in transit, although will try and do so if requested. 


Any claim must be brought to us within 10 days of receipt in the case of delay/damage, and 28 days in the case of loss. 

Claims can only be re considered up to a period of 12 weeks after despatch as the carrier only holds records for up to this period. If you wish to contest any claim decision, please write in to the Customer Service Director within this period. 


Liability 

The person placing the order is responsible for the information entered. Europost Express  Ltd will not be held responsible for wrong information that is entered and any delay this may cause No refunds will be given in this instance. 

On the advised services the driver will leave a Waybill document that you may have to complete with the to and from address details. 
It is the customer's responsibility to ensure that all the details are correctly completed and displayed on the correct parcel and no claim or reduction will be made if the parcel is sent and the details were incorrect or placed on the incorrect parcel. It is not the driver's responsibility to check this information, so please ensure this is checked before he leaves. 

The sender will be liable for any damages caused in transit to other shipments or property resulting from sending a Prohibited / Restricted item or an item that is insufficiently packaged. 

You are pre-paying for the postage charges and Europost Express l Ltd applies these charges on your behalf to its account with the relevant carrier. Europost Express are not liable for any customs charges which may arise. 

Liability is limited to the negligence of the company carrying the goods. Such liability is further limited to the direct loss suffered by the customer who placed the order with Europost Express Ltd only, to the covered maximum, not the receiver of the goods. 

Europost Express  will accept no Liability for any Prohibited / Restricted Items that is sent through our services and subsequently damaged or lost. No claim can be made for a Prohibited / Restricted item as they are either excluded from our services or as in both cases sent at the sender's risk. A customer ticks to state they have read the Prohibited / Restricted items and the Terms and Conditions at the time of ordering. 

Loss, damage or Delay under the following conditions will not be covered: 
•	Acts of God 
•	Consequences of war 
•	Insufficient packaging / Incorrect labelling 
•	Prohibited / Restricted Items - listed in our Help and information section

Europost Express Ltd will deal with the person who placed the order only. 

Liability is also limited to the cost of sending the item only and to the covered value of the consignment if a claim is raised. We will not be liable for any claim for loss of profit, use, breach of contract, loss of revenue, administrative inconvenience, disappointment, or indirect, incidental, financial or consequential loss or damage arising out of, or in relation to, the service you ordered. 

Total liability to you in all respects, and for any type of loss, cost or damage howsoever arising will be limited to £50 per consignment unless you have purchased additional transit cover through us, where the limit of liability will be the cover purchased at the time of ordering. 

Nothing in this Agreement shall be deemed to limit or exclude Europost Express's liability for fraud or for death or personal injury caused by Europost Express's negligence or to the extent otherwise not permitted by law. 

You will indemnify Europost Express Ltd. in respect of all claim demands, damages, liabilities, costs or expenses incurred by Europost Express  or Europost Express's employees, agents or sub-contractors in relation to any claims by third parties arising in connection with this agreement, or as a result of Europost Express providing services, which are in excess of the liability of Europost Express under this agreement. 

Any claim must be brought to us within 10 days of receipt in the case of damage, and in 28 days in the case of loss. 


Severability 

If any part of these terms and conditions is found to be unenforceable as a matter of law, the enforceability of any other part of these terms and conditions will not be affected. 


Governing Law 

These terms and conditions and any contract between us shall be governed by and interpreted in accordance with English Law and the English Courts shall have jurisdiction over any disputes between us. 


Statutory Rights 

These terms and conditions are in addition to your statutory rights as a consumer which remains unaffected. The Contracts (Rights of Third Parties) Act 1999 shall not apply to this agreement. 


Complaints 

We aim to provide outstanding customer service. If you have any complaint about the service you have received from us, please contact our Customer Service Director. Please allow 28 working days for a response to any written correspondence.

	</textarea>
<br /><br />
			<input name="lastsubmit" type="submit" value="Accept Terms and Conditions and Confirm Booking" />
	<input name="book" type="hidden" value="6" />
	<input name="cf" type="hidden" value="$cf" />
	<input name="id_contact" type="hidden" value="$id_contact" />
	<input name="id_company" type="hidden" value="$id_company" />
	<input name="tel1" type="hidden" value="$tel1" />
	<input name="tel2" type="hidden" value="$tel2" />
	<input name="tel3" type="hidden" value="$tel3" />
	<input name="mob1" type="hidden" value="$mob1" />
	<input name="mob2" type="hidden" value="$mob2" />
	<input name="mob3" type="hidden" value="$mob3" />
	<input name="fax1" type="hidden" value="$fax1" />
	<input name="fax2" type="hidden" value="$fax2" />
	<input name="fax3" type="hidden" value="$fax3" />
	<input name="id_add1" type="hidden" value="$id_add1" />
	<input name="id_add2" type="hidden" value="$id_add2" />
	<input name="id_town" type="hidden" value="$id_town" />
	<input name="id_county" type="hidden" value="$id_county" />
	<input name="id_postcode" type="hidden" value="$id_postcode" />
	<input name="email" type="hidden" value="$email" />
	<input name="id_dest_contact" type="hidden" value="$id_dest_contact" />
	<input name="id_dest_company" type="hidden" value="$id_dest_company" />
	<input name="dest_tel1" type="hidden" value="$dest_tel1" />
	<input name="dest_tel2" type="hidden" value="$dest_tel2" />
	<input name="dest_tel3" type="hidden" value="$dest_tel3" />
	<input name="dest_mob1" type="hidden" value="$dest_mob1" />
	<input name="dest_mob2" type="hidden" value="$dest_mob2" />
	<input name="dest_mob3" type="hidden" value="$dest_mob3" />
	<input name="dest_fax1" type="hidden" value="$dest_fax1" />
	<input name="dest_fax2" type="hidden" value="$dest_fax2" />
	<input name="dest_fax3" type="hidden" value="$dest_fax3" />
	<input name="id_dest_add1" type="hidden" value="$id_dest_add1" />
	<input name="id_dest_add2" type="hidden" value="$id_dest_add2" />
	<input name="id_dest_city" type="hidden" value="$id_dest_city" />
	<input name="id_dest_state" type="hidden" value="$id_dest_state" />
	<input name="id_dest_postcode" type="hidden" value="$id_dest_postcode" />
	<input name="dest_email" type="hidden" value="$dest_email" />
	<input name="warcharge" type="hidden" value="$warcharge" />
	<input name="dutcharge" type="hidden" value="$dutcharge" />
	<input name="dutiable" type="hidden" value="$dutiable" />
	<input name="partcover" type="hidden" value="$partcover" />
	<input name="invreq" type="hidden" value="$invreq" />
	<input name="zoneid" type="hidden" value="$zoneid" />
	<input name="price" type="hidden" value="$price" />
	<input name="totalfuel" type="hidden" value="$totalfuel" />
	<input name="totalbook" type="hidden" value="$totalbook" />
	<input name="totalremote" type="hidden" value="$totalremote" />
	<input name="totalcust" type="hidden" value="$totalcust" />
	<input name="totalins" type="hidden" value="$totalins" />
	<input name="totalwar" type="hidden" value="$totalwar" />
	<input name="totaldut" type="hidden" value="$totaldut" />
	<input name="totalvat" type="hidden" value="$totalvat" />
	<input name="vat" type="hidden" value="$vat" />
	<input name="trans" type="hidden" value="$trans" />

	$frm

	</form></center></td>
		</tr>
	</table>
</font>
<br />
</div>

|;

&footer($heading);

}

sub book6{
#	&error_page("Unfortunately, This service is not available at this time. Please try again later. Sorry for any inconveniences."); exit;
	if (!$orderid && $trans != "1" && $trans != "2" && $trans != "4") {&error_page("Wrong data specified! Package Content type is invalid. Please press back button in your browser to correct the problem."); exit;} 
	unless ($orderid || ($packagecount && $packagecount =~ /^\s*[0-9]+\s*$/)) {&error_page("Wrong data specified! Package count is invalid. Please press back button in your browser to correct the problem."); exit;} 

	unless ($orderid || ($zoneid && $packagecount =~ /^\s*[0-9]+\s*$/)) {&error_page("Wrong data specified! Service name is invalid. Please press back button in your browser to correct the problem."); exit;} 
	unless ($orderid || ($price && $price =~ /^\s*[0-9\.]+\s*$/)) {&error_page("Wrong data specified! Service price is invalid. Please press back button in your browser to correct the problem."); exit;} 

	if( !$orderid && $totalfuel )
		{
		unless ( $totalfuel =~ /^\s*[0-9\.]+\s*$/) {&error_page("Wrong data specified! Service price is invalid. Please press back button in your browser to correct the problem."); exit;} 
		}
	if( !$orderid && $totalbook )
		{
		unless ( $totalbook =~ /^\s*[0-9\.]+\s*$/) {&error_page("Wrong data specified! Service price is invalid. Please press back button in your browser to correct the problem."); exit;} 
		}
	if( !orderid && $totalremote )
		{
		unless ( $totalremote =~ /^\s*[0-9\.]+\s*$/) {&error_page("Wrong data specified! Service price is invalid. Please press back button in your browser to correct the problem."); exit;} 
		}
	if( !$orderid && $totalcust )
		{
		unless ( $totalcust =~ /^\s*[0-9\.]+\s*$/) {&error_page("Wrong data specified! Service price is invalid. Please press back button in your browser to correct the problem."); exit;} 
		}
	if( !$orderid && $totaldut )
		{
		unless ( $totaldut =~ /^\s*[0-9\.]+\s*$/) {&error_page("Wrong data specified! Service price is invalid. Please press back button in your browser to correct the problem."); exit;} 
		}
	if( !$orderid && $totalwar )
		{
		unless ( $totalwar =~ /^\s*[0-9\.]+\s*$/) {&error_page("Wrong data specified! Service price is invalid. Please press back button in your browser to correct the problem."); exit;} 
		}
	if( !$orderid && $totalins )
		{
		unless ( $totalins =~ /^\s*[0-9\.]+\s*$/) {&error_page("Wrong data specified! Service price is invalid. Please press back button in your browser to correct the problem."); exit;} 
		}
	if( !$orderid && $totalvat )
		{
		unless ( $totalvat =~ /^\s*[0-9\.]+\s*$/) {&error_page("Wrong data specified! Service price is invalid. Please press back button in your browser to correct the problem."); exit;} 
		}

	if( $trans eq "1" || $trans eq "4" ) 
		{
		unless ($content)	{&error_page("Wrong data specified! Parcel/Pallet Contents field cannot be empty. Please press back button in your browser to correct the problem."); exit;} 
		}

	unless ($val && $val =~ /^\s*[0-9\.]+\s*$/) {&error_page("Wrong data specified! Value field is not a valid number. Please press back button in your browser to correct the problem."); exit;} 
	unless ($insurance && $insurance =~ /^\s*[0-9]+\s*$/) {&error_page("Wrong data specified! Insurance Cover field is not a valid number. Please press back button in your browser to correct the problem."); exit;} 
	unless ($id_contact) {&error_page("Wrong data specified! Sender Contact Name is invalid. Please press back button in your browser to correct the problem."); exit;} 
	unless ($tel1 && $tel2 && $tel3 && $tel1 =~ /^\s*[0-9]+\s*$/ && $tel2 =~ /^\s*[0-9]+\s*$/ && $tel3 =~ /^\s*[0-9]+\s*$/) {&error_page("Wrong data specified! Sender Land Phone is invalid. Please press back button in your browser to correct the problem."); exit;} 
	unless ($mob1 =~ /^\s*[0-9]*\s*$/ && $mob2 =~ /^\s*[0-9]*\s*$/ && $mob3 =~ /^\s*[0-9]*\s*$/) {&error_page("Wrong data specified! Sender Cell Phone is invalid. Please press back button in your browser to correct the problem."); exit;} 
	unless ($fax1 =~ /^\s*[0-9]*\s*$/ && $fax2 =~ /^\s*[0-9]*\s*$/ && $fax3 =~ /^\s*[0-9]*\s*$/) {&error_page("Wrong data specified! Sender Fax is invalid. Please press back button in your browser to correct the problem."); exit;} 
	unless ($id_add1) {&error_page("Wrong data specified! Sender Address is invalid. Please press back button in your browser to correct the problem."); exit;} 
	unless ($orderid || $id_postcode) {&error_page("Wrong data specified! Sender Post Code is invalid. Please press back button in your browser to correct the problem."); exit;} 
	unless ($orderid || $id_town) {&error_page("Wrong data specified! Sender City is invalid. Please press back button in your browser to correct the problem."); exit;} 
	unless ($id_county) {&error_page("Wrong data specified! Sender County is invalid. Please press back button in your browser to correct the problem."); exit;} 
	unless ($orderid || $id_source) {&error_page("Wrong data specified! Sender Country is invalid. Please press back button in your browser to correct the problem."); exit;} 
	unless ($email && $email =~ m/^[\w-_\.]+@([\w-_]+\.)+[a-zA-Z]{2,}$/)  {&error_page("Wrong data specified! Sender Email is invalid. Please press back button in your browser to correct the problem."); exit;} 
	unless ($fromtime && $fromtime =~ /^\s*[0-2][0-9]:[0-5][0-9]\s*$/) {&error_page("Incomplete data entered! Invalid Ready Time field(Format HH:MM). Please press back button in your browser to correct the problem."); exit;} 
	unless ($totime && $totime =~ /^\s*[0-2][0-9]:[0-5][0-9]\s*$/) {&error_page("Incomplete data entered! Invalid Deadline Time field(Format HH:MM). Please press back button in your browser to correct the problem."); exit;} 

	if( $fromtime gt $totime )
		{
		&error_page("Wrong data specified! Ready Time must be less than Deadline Time. Please press back button in your browser to correct the problem."); exit;
		}

	unless ($id_dest_contact) {&error_page("Wrong data specified! Recipient Name is invalid. Please press back button in your browser to correct the problem."); exit;} 
	unless ($dest_tel1 && $dest_tel2 && $dest_tel3) {&error_page("Wrong data specified! Recipient Land Phone is invalid. Please press back button in your browser to correct the problem."); exit;} 
	unless ($id_dest_add1) {&error_page("Wrong data specified! Recipient Address is invalid. Please press back button in your browser to correct the problem."); exit;} 
	unless ($orderid || $id_dest_postcode) {&error_page("Wrong data specified! Recipient Post Code is invalid. Please press back button in your browser to correct the problem."); exit;} 
	unless ($orderid || $id_dest_city) {&error_page("Wrong data specified! Recipient City is invalid. Please press back button in your browser to correct the problem."); exit;} 
	unless ($id_dest_state) {&error_page("Wrong data specified! Recipient County is invalid. Please press back button in your browser to correct the problem."); exit;} 
	unless ($orderid || $id_dest) {&error_page("Wrong data specified! Recipient Country is invalid. Please press back button in your browser to correct the problem."); exit;} 
	if($dest_email)
		{
		unless ($dest_email =~ m/^[\w-_\.]+@([\w-_]+\.)+[a-zA-Z]{2,}$/)  {&error_page("Wrong data specified! Recipient Email is invalid. Please press back button in your browser to correct the problem."); exit;} 
		} 

	if( !$orderid )
		{
		@total_price = ();
		@rem_charge = (-1,-1,-1,-1,-1,-1,-1,-1,-1,-1);

		for( $l = 1; $l <= ${'packagecount'} ; $l++ )
			{
			my ($w1, $w2, $w3, $w4);
			$w1 = "weight[$l]";
			unless (${$w1} && ${$w1} =~ /^\s*[0-9\.]+\s*$/) {&error_page("Wrong data specified! Weight of Package $l is invalid. Please press back button in your browser to correct the problem."); exit;} 
		 	$w2 = "length[$l]";
			unless (${$w2} && ${$w2} =~ /^\s*[0-9]+\s*$/) {&error_page("Wrong data specified! Length of Package $l is invalid. Please press back button in your browser to correct the problem."); exit;} 
		 	$w3 = "width[$l]";
			unless (${$w3} && ${$w3} =~ /^\s*[0-9]+\s*$/) {&error_page("Wrong data specified! Width of Package $l is invalid. Please press back button in your browser to correct the problem."); exit;} 
		 	$w4 = "height[$l]";
			unless (${$w4} && ${$w4} =~ /^\s*[0-9]+\s*$/) {&error_page("Wrong data specified! Height of Package $l is invalid. Please press back button in your browser to correct the problem."); exit;} 

			&get_price($id_source, $id_postcode, $id_cityS, $id_dest, $id_dest_postcode, $id_dest_city, ${$w1}, ${$w2}, ${$w3}, ${$w4}, $trans, -1, 0, 0, 0, $id_source, $insurance);
			}

		for( $l = 0; $l <= $#total_price ; $l++ )
			{
			if( $total_price[$l]->{'zoneid'} eq $zoneid )
				{
				$total_price[$l]->{'price'} = toCurr($total_price[$l]->{'price'});
				$total_price[$l]->{'totalfuel'} = toCurr($total_price[$l]->{'totalfuel'});
				$total_price[$l]->{'totalbook'} = toCurr($total_price[$l]->{'totalbook'});
				$total_price[$l]->{'totalremote'} = toCurr($total_price[$l]->{'totalremote'});
				$total_price[$l]->{'totalcust'} = toCurr($total_price[$l]->{'totalcust'});
				$total_price[$l]->{'totaldut'} = toCurr($total_price[$l]->{'totaldut'});
				$total_price[$l]->{'totalwar'} = toCurr($total_price[$l]->{'totalwar'});
				$total_price[$l]->{'totalins'} = toCurr($total_price[$l]->{'totalins'});

				if( $total_price[$l]->{'price'} ne $price || $total_price[$l]->{'totalfuel'} ne $totalfuel || $total_price[$l]->{'totalbook'} ne $totalbook || $total_price[$l]->{'totalremote'} ne $totalremote || $total_price[$l]->{'totalcust'} ne $totalcust || $total_price[$l]->{'totaldut'} ne $totaldut || $total_price[$l]->{'totalwar'} ne $totalwar || $total_price[$l]->{'totalins'} ne $totalins || $total_price[$l]->{'totalvat'} ne $totalvat )
					{
					&error_page("Internal inconsistency error. Please create a new booking from the first step."); exit;
					}
				} 
			}
		}
		
	$id_contact =~ s/'/''/g;
	$id_company =~ s/'/''/g;
	$id_add1 =~ s/'/''/g;
	$id_add2 =~ s/'/''/g;
	$id_postcode =~ s/'/''/g if( !orderid );
	$id_town =~ s/'/''/g if( !orderid );
	$id_county =~ s/'/''/g;
	$id_source =~ s/'/''/g if( !orderid );
	$id_dest_contact =~ s/'/''/g;
	$id_dest_company =~ s/'/''/g;
	$id_dest_add1 =~ s/'/''/g;
	$id_dest_add2 =~ s/'/''/g;
	$id_dest_postcode =~ s/'/''/g if( !orderid );
	$id_dest_city =~ s/'/''/g if( !orderid );
	$id_dest_state =~ s/'/''/g;
	$id_dest =~ s/'/''/g if( !orderid );
	$service =~ s/'/''/g if( !orderid );
	$content =~ s/'/''/g;

	my $usercgi = new CGI; 
	my $userip = $usercgi->remote_host(); 

	if( $orderid )
		{
		$SQL = "UPDATE orders SET s_contact='$id_contact',s_company='$id_company',s_tel1='$tel1',s_tel2='$tel2',s_tel3='$tel3',s_mob1='$mob1',s_mob2='$mob2',s_mob3='$mob3',s_fax1='$fax1',s_fax2='$fax2',s_fax3='$fax3',s_add1='$id_add1',s_add2='$id_add2',s_state='$id_county',s_email='$email',d_contact='$id_dest_contact',d_company='$id_dest_company',d_tel1='$dest_tel1',d_tel2='$dest_tel2',d_tel3='$dest_tel3',d_mob1='$dest_mob1',d_mob2='$dest_mob2',d_mob3='$dest_mob3',d_fax1='$dest_fax1',d_fax2='$dest_fax2',d_fax3='$dest_fax3',d_add1='$id_dest_add1',d_add2='$id_dest_add2',d_state='$id_dest_state',d_email='$dest_email', content='$content', val='$val', insurance='$insurance', fromtime='$fromtime', totime='$totime' WHERE orderid=$orderid";
		&my_sql;
		$sth->finish;

		if( $fromlist )
			{
			$redirect="$script?cf=orders&viewall=1&userid=$isUser";
			}
		else
			{
			$redirect="$script?cf=bookeditok";
			}
		print $form->redirect(-url=>$redirect);

		}
	else
		{
		if( $trans eq "1" )
			{
			$transferable = "1";
			}
		elsif( $trans eq "2" )
			{
			$transferable = "2";
			}
		else
			{
			$transferable = "6";
			}
		
		$SQLFLDS = "(orderid,userid,orderdate,type,status,zoneid,oprice,ofuel,obook,owarcharge,oinscharge,odutiable,odutcharge,oremote,ocust,ovat,packages,s_contact,s_company,s_tel1,s_tel2,s_tel3,s_mob1,s_mob2,s_mob3,s_fax1,s_fax2,s_fax3,s_add1,s_add2,s_postcode,s_city,s_state,s_country,s_email,d_contact,d_company,d_tel1,d_tel2,d_tel3,d_mob1,d_mob2,d_mob3,d_fax1,d_fax2,d_fax3,d_add1,d_add2,d_postcode,d_city,d_state,d_country,d_email,transferable,opartcover,oinvreq,vatpercent,content,val,insurance,fromtime,totime,bservice,breference,ip)";
		$SQLVALS = "(0,$isUser, CURRENT_TIMESTAMP(), 1, 1, $zoneid, $price, $totalfuel, $totalbook, $totalwar, $totalins, '$dutiable', $totaldut, $totalremote, $totalcust, $totalvat, $packagecount, '$id_contact', '$id_company', '$tel1', '$tel2', '$tel3', '$mob1', '$mob2', '$mob3', '$fax1', '$fax2', '$fax3', '$id_add1', '$id_add2', '$id_postcode', '$id_town', '$id_county', $id_source, '$email', '$id_dest_contact', '$id_dest_company', '$dest_tel1', '$dest_tel2', '$dest_tel3', '$dest_mob1', '$dest_mob2', '$dest_mob3', '$dest_fax1', '$dest_fax2', '$dest_fax3', '$id_dest_add1', '$id_dest_add2', '$id_dest_postcode', '$id_dest_city', '$id_dest_state', $id_dest, '$dest_email', '$transferable', '$partcover', '$invreq', '$vat', '$content', $val, $insurance, '$fromtime', '$totime', 0, '', '$userip')";
	
		$SQL = "INSERT INTO orders $SQLFLDS VALUES $SQLVALS";
		$sss = $SQL;
		&my_sql;
		$sth->finish;
	
		$orderid = 0;
		$SQL = "SELECT LAST_INSERT_ID() as orderid FROM orders"; 
		&my_sql;
		if ($column = $sth->fetchrow_hashref)
			{
			$orderid = $column->{'orderid'};
			}
		$sth->finish;
	
		if( $orderid )
			{
			$SQLFLDS = "(orderid,item,weight,length,width,height)";
	
			for( $l = 1; $l <= ${'packagecount'} ; $l++ )
				{
				my $w;
		
				$SQLVALS = "($orderid,";
				$SQLVALS = $SQLVALS . $l . ",";
				$w = "weight[$l]";
				$SQLVALS = $SQLVALS . ${$w} . ",";
			 	$w = "length[$l]";
				$SQLVALS = $SQLVALS . ${$w} . ",";
			 	$w = "width[$l]";
				$SQLVALS = $SQLVALS . ${$w} . ",";
			 	$w = "height[$l]";
				$SQLVALS = $SQLVALS . ${$w} . ")";
				
				$SQL = "INSERT INTO orderdetails $SQLFLDS VALUES $SQLVALS";
				&my_sql;
				$sth->finish;
				}
	
			$orderitems = 0;
			$SQL = "SELECT COUNT(*) as orderitems FROM orderdetails WHERE orderid=$orderid"; 
			&my_sql;
			if ($column = $sth->fetchrow_hashref)
				{
				$orderitems = $column->{'orderitems'};
				}
			$sth->finish;
	
			if( $orderitems == ${'packagecount'} )
				{
				if( $email ne "shahyar7\@gmail.com" )
					{
					&SendEmail($myemail, $adminemail, "New Europost Booking (Ref.: $orderid)", "<p>Dear $salesman,<br><br>A new booking, Ref.: $orderid, is just placed in your system by \"$id_contact\". You may visit the booking at:<br><br><a href=\"$scripturl?cf=orders&view=1&orderid=$orderid\">$scripturl?cf=orders&view=1&orderid=$orderid</a><br><br>Your Sincerely,<br>Administrator</p>");
					}

				$redirect="$script?cf=bookok&orderid=$orderid";
				print $form->redirect(-url=>$redirect);
				}
			else
				{
				$SQL = "DELETE FROM orderdetails WHERE orderid=$orderid";
				&my_sql;
				$sth->finish;
				$SQL = "DELETE FROM orders WHERE orderid=$orderid";
				&my_sql;
				$sth->finish;
	
				&error_page("Couldn't save the booking items in the database. Please try again. If the problem persists, please call the administrator."); exit;
				}
			}
		else
			{
			&error_page("[$sss] Couldn't save the booking in the database. Please try again. If the problem persists, please call the administrator."); exit;
			}
		}
}

sub fetch_pb{
	my $pborig = shift;

	print "Content-type: text/plain\n\n";

	unless ($pb) { print "ERROR: Post Code cannot be empty!"; exit;}
	
  $t_ua = LWP::UserAgent->new;
  $t_ua->agent("Mozilla/5.0");
  $t_ua->timeout(10);
	$t_ua->cookie_jar(HTTP::Cookies->new(file => "$ENV{HOME}/lwp_cookies.dat"), autosave => 1);

	my(@rest) = ("/", ".interparcel.com", undef, 0, 0, undef, 0);
	$t_ua->cookie_jar->set_cookie(undef, "PHPSESSID", $ipc, @rest);

	@form_data = (
	"action" => "check",
 	"postcode_search" => "$pb"
 	);

	my $t_response = $t_ua->post('http://www.interparcel.com/quote/courier-quote3.php',	\@form_data);

	if( $t_response->is_success )
		{
		$tmpcontent = $t_response->content;
		
		if( $tmpcontent =~ m|<select name="address".*?>(.+?)</select>|is )
			{
			my $find_address = qq|<select name="address" width="100" onChange="fetch_add(this.form);">$1</select>|;
			$find_address =~ s|(.*)</div>(\s+)<option>(.*)|$1$2<option>$3|is;

			print $find_address;
			}
		else
			{
				print "ERROR: Post Code Not Found!";
			}
		}
	else
		{
			print "ERROR: Cannot fetch the Addresses right now,\nPlease try later or enter the fields manually.";
		}
}

sub fetch_add{
	my $addorig = shift;

	print "Content-type: text/plain\n\n";

	unless ($pb) { print "ERROR: Post Code can not be empty"; exit;}
	unless ($add) { print "ERROR: Address must be selected"; exit;}
	
  $t_ua = LWP::UserAgent->new;
  $t_ua->agent("Mozilla/5.0");
  $t_ua->timeout(10);
	$t_ua->cookie_jar(HTTP::Cookies->new(file => "$ENV{HOME}/lwp_cookies.dat"), autosave => 1);

	my(@rest) = ("/", ".interparcel.com", undef, 0, 0, undef, 0);
	$t_ua->cookie_jar->set_cookie(undef, "PHPSESSID", $ipc, @rest);

	print $add
	@form_data = (
	"action" => "check",
	"postcode_id" => "$add",
 	"postcode_search" => "$pb"
 	);

	my $t_response = $t_ua->post('http://www.interparcel.com/quote/courier-quote3.php',	\@form_data);

	if( $t_response->is_success )
		{
		my ($aid_contact, $aid_company, $aid_add1, $id_add2, $aid_town, $aid_county, $aid_postcode);
		
		if( $t_response->content =~ m|<input\s+?NAME="id_contact".+?value="(.*?)".*?>|is )
			{
			$aid_contact = $1;
			}
		else
			{
			$aid_contact = "";
			}
		
		if( $t_response->content =~ m|<input\s+?NAME="id_company".+?value="(.*?)".*?>|is )
			{
			$aid_company = $1;
			}
		else
			{
			$aid_company = "";
			}
		if( $t_response->content =~ m|<input\s+?NAME="id_add1".+?value="(.*?)".*?>|is )
			{
			$aid_add1 = $1;
			}
		else
			{
			$aid_add1 = "";
			}
		
		if( $t_response->content =~ m|<input\s+?NAME="id_add2".+?value="(.*?)".*?>|is )
			{
			$aid_add2 = $1;
			}
		else
			{
			$aid_add2 = "";
			}
		
		if( $t_response->content =~ m|<input\s+?NAME="id_town".+?value="(.*?)".*?>|is )
			{
			$aid_town = $1;
			}
		else
			{
			$aid_town = "";
			}

		if( $t_response->content =~ m|<input\s+?NAME="id_county".+?value="(.*?)".*?>|is )
			{
			$aid_county = $1;
			}
		else
			{
			$aid_county = "";
			}
		
		if( $t_response->content =~ m|<input\s+?NAME="id_postcode".+?value="(.*?)".*?>|is )
			{
			$aid_postcode = $1;
			}
		else
			{
			$aid_postcode = "";
			}
		
		print "FOUND:" . $aid_contact . "~" . $aid_company . "~" . $aid_add1 . "~" . $id_add2 . "~" . $aid_town . "~" . $aid_county . "~" . $aid_postcode;

		}
	else
		{
			print "ERROR: Cannot fetch the Address details right now,\nPlease try later or enter the fields manually.";
		}
}

sub getFuel
{
	my ($carrabr, $curm, $curfr, $curfa, $nextfr, $nextfa) = @_;
	my ($newm1, $newm2, $newfr, $newfa, $newnfr, $newnfa);

  $t_ua = LWP::UserAgent->new;
  $t_ua->agent("Mozilla/5.0");
  $t_ua->timeout(10);
	
	if( $carrabr eq "DHL" )
		{
		#air 
		my $t_response = $t_ua->get('http://www.dhl.co.uk/publish/gb/en/information/shipping/fuel_surcharge/air_express_fuel_surcharge.high.html');
		if( $t_response->is_success )
			{
			if( $t_response->content =~ m|<B>The aviation fuel surcharge(.*?)</B>|is )
				{
				my $strf = $1;
				my ($m1, $m2);
				if( $strf =~ m|sent in (\w+?) is ([0-9\.]+?)%|is )
					{
					my $mymonth = "\L$1";
					my $mypercent = $2;
					if( $mymonth eq "january" )
						{
						$m1 = 1;
						}
					elsif( $mymonth eq "february" )
						{
						$m1 = 2;
						}
					elsif( $mymonth eq "march" )
						{
						$m1 = 3;
						}
					elsif( $mymonth eq "april" )
						{
						$m1 = 4;
						}
					elsif( $mymonth eq "may" )
						{
						$m1 = 5;
						}
					elsif( $mymonth eq "june" )
						{
						$m1 = 6;
						}
					elsif( $mymonth eq "july" )
						{
						$m1 = 7;
						}
					elsif( $mymonth eq "august" )
						{
						$m1 = 8;
						}
					elsif( $mymonth eq "september" )
						{
						$m1 = 9;
						}
					elsif( $mymonth eq "october" )
						{
						$m1 = 10;
						}
					elsif( $mymonth eq "november" )
						{
						$m1 = 11;
						}
					elsif( $mymonth eq "december" )
						{
						$m1 = 12;
						}
					else
						{
						return 0;
						}
	
					if( $mypercent > 0 )
						{
						$newfa = $mypercent;
						}
					else
						{
						return 0;
						}
					}
				else
					{
					return 0;
					}
				
				if( $strf =~ m|the (\w+?) 2009 fuel surcharge will be ([0-9\.]+?)%|is )
					{
					my $mymonth = "\L$1";
					my $mypercent = $2;
					if( $mymonth eq "january" )
						{
						$m2 = 1;
						}
					elsif( $mymonth eq "february" )
						{
						$m2 = 2;
						}
					elsif( $mymonth eq "march" )
						{
						$m2 = 3;
						}
					elsif( $mymonth eq "april" )
						{
						$m2 = 4;
						}
					elsif( $mymonth eq "may" )
						{
						$m2 = 5;
						}
					elsif( $mymonth eq "june" )
						{
						$m2 = 6;
						}
					elsif( $mymonth eq "july" )
						{
						$m2 = 7;
						}
					elsif( $mymonth eq "august" )
						{
						$m2 = 8;
						}
					elsif( $mymonth eq "september" )
						{
						$m2 = 9;
						}
					elsif( $mymonth eq "october" )
						{
						$m2 = 10;
						}
					elsif( $mymonth eq "november" )
						{
						$m2 = 11;
						}
					elsif( $mymonth eq "december" )
						{
						$m2 = 12;
						}
					else
						{
						return 0;
						}
						
					if( $mypercent > 0 )
						{
						$newnfa = $mypercent;
						}
					else
						{
						return 0;
						}
						
					if( $m1 != 12 )
						{
						if( $m2 == $m1 + 1 )
							{
							$newm1 = $m1;
							}
						else
							{
							return 0;
							}
						}
					else
						{
						if( $m2 == 1 )
							{
							$newm1 = $m1;
							}
						else
							{
							return 0;
							}
						}
					}
				else
					{
					return 0;
					}
				}
			else
				{
				return 0;
				}
			}
		else
			{
			return 0;
			}

		#road
		my $t_response = $t_ua->get('http://www.dhl.co.uk/publish/gb/en/information/shipping/fuel_surcharge/road_express_fuel.high.html');
		if( $t_response->is_success )
			{
			if( $t_response->content =~ m|<B>The fuel surcharge(.*?)</B>|is )
				{
				my $strf = $1;
				my ($m1, $m2);
				if( $strf =~ m|sent in (\w+?) is ([0-9\.]+?)%|is )
					{
					my $mymonth = "\L$1";
					my $mypercent = $2;
					if( $mymonth eq "january" )
						{
						$m1 = 1;
						}
					elsif( $mymonth eq "february" )
						{
						$m1 = 2;
						}
					elsif( $mymonth eq "march" )
						{
						$m1 = 3;
						}
					elsif( $mymonth eq "april" )
						{
						$m1 = 4;
						}
					elsif( $mymonth eq "may" )
						{
						$m1 = 5;
						}
					elsif( $mymonth eq "june" )
						{
						$m1 = 6;
						}
					elsif( $mymonth eq "july" )
						{
						$m1 = 7;
						}
					elsif( $mymonth eq "august" )
						{
						$m1 = 8;
						}
					elsif( $mymonth eq "september" )
						{
						$m1 = 9;
						}
					elsif( $mymonth eq "october" )
						{
						$m1 = 10;
						}
					elsif( $mymonth eq "november" )
						{
						$m1 = 11;
						}
					elsif( $mymonth eq "december" )
						{
						$m1 = 12;
						}
					else
						{
						return 0;
						}

					if( $mypercent > 0 )
						{
						$newfr = $mypercent;
						}
					else
						{
						return 0;
						}
					}
				else
					{
					return 0;
					}
				
				if( $strf =~ m|sent in (\w+?) will be ([0-9\.]+?)%|is )
					{
					my $mymonth = "\L$1";
					my $mypercent = $2;
					if( $mymonth eq "january" )
						{
						$m2 = 1;
						}
					elsif( $mymonth eq "february" )
						{
						$m2 = 2;
						}
					elsif( $mymonth eq "march" )
						{
						$m2 = 3;
						}
					elsif( $mymonth eq "april" )
						{
						$m2 = 4;
						}
					elsif( $mymonth eq "may" )
						{
						$m2 = 5;
						}
					elsif( $mymonth eq "june" )
						{
						$m2 = 6;
						}
					elsif( $mymonth eq "july" )
						{
						$m2 = 7;
						}
					elsif( $mymonth eq "august" )
						{
						$m2 = 8;
						}
					elsif( $mymonth eq "september" )
						{
						$m2 = 9;
						}
					elsif( $mymonth eq "october" )
						{
						$m2 = 10;
						}
					elsif( $mymonth eq "november" )
						{
						$m2 = 11;
						}
					elsif( $mymonth eq "december" )
						{
						$m2 = 12;
						}
					else
						{
						return 0;
						}

					if( $mypercent > 0 )
						{
						$newnfr = $mypercent;
						}
					else
						{
						return 0;
						}
						
					if( $m1 != 12 )
						{
						if( $m2 == $m1 + 1 )
							{
							$newm2 = $m1;
							}
						else
							{
							return 0;
							}
						}
					else
						{
						if( $m2 == 1 )
							{
							$newm2 = $m1;
							}
						else
							{
							return 0;
							}
						}
					}
				else
					{
					return 0;
					}
				}
			else
				{
				return 0;
				}
			}
		else
			{
			return 0;
			}
			
		if( $newm1 == $newm2 )
			{
			my ($sec,$min,$hour,$mday,$mon,$year,$wday,$yday,$isdst) = localtime;
			$mon++;
	
			if( $newm1 == $mon )
				{
				$$curm = $newm1;
				$$curfr = $newfr;
				$$curfa = $newfa;
				$$nextfr = $newnfr;
				$$nextfa = $newnfa;
				
				return 1;
				}
			else
				{
				if( $newm1 == $mon - 1 )
					{
					$$curm = $newm1;
					$$curfr = $newfr;
					$$curfa = $newfa;
					$$nextfr = $newnfr;
					$$nextfa = $newnfa;
					
					return 1;
					}
				else
					{
					return 0;
					}
				}
			}
		else
			{
			return 0;
			}
		}
	elsif( $carrabr eq "DPD" )
		{
		#road
		my $t_response = $t_ua->get('http://www.dpd.co.uk/shipping/my_information/general_information/fuel-surcharge.htm');
		if( $t_response->is_success )
			{
			if( $t_response->content =~ m|fuel surcharge rate is ([0-9\.]+?)\s?%|is )
				{
				my $mypercent = $1;
				if( $mypercent > 0 )
					{
					$newfr = $mypercent;
					}
				else
					{
					return 0;
					}
				}
			else
				{
				return 0;
				}
			}
		else
			{
			return 0;
			}
			
		my ($sec,$min,$hour,$mday,$mon,$year,$wday,$yday,$isdst) = localtime;

		$$curm = $mon + 1;
		$$curfr = $newfr;
		$$nextfr = $newfr;
		$$curfa = $newfr;
		$$nextfa = $newfr;

		return 1;
		}
}

1;
