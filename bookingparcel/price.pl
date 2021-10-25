$heading="price";

use CGI;
use CGI qw/:standard/;
use CGI qw(param);

sub home{
&myheader($heading);

&topmenu($heading);

print qq|<div class="ha8"><h1><font color="#000080" size="1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Service Prices</font></h1>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Please select the follown optins, then you can edit the prirces<br /><br />|;


	print qq|
	<form name="frm" action="$script" method="POST">
	<table width="100%" border="0" style="background-color:#FDF3D0;">
	<input name="editzone" type="hidden" value="1" />
	<input name="cf" type="hidden" value="price" />|;
	
	
	if( $userprice )
		{
		print qq|
		<input name="userprice" type="hidden" value="$userprice" />
		<tr>
		<td width="100">Agent:</td>
		<td width="900"><B>
		|;
		
		print get_memname($userprice);
		
		print qq|</B></td>
		</tr>|;
		}
	else
		{
		print qq|
		<tr>
		<td width="100">Agent: </td>
		<td width="900">
		<select name="userprice">
		<option value="-1">Booking Prices for Normal users</option>
		<option value="0">--------------------------------</option>
		<option value="-2">Original Prices For Agents</option>
		<option value="0">--------------------------------</option>|;
	
		$SQL = "SELECT username, userid FROM members WHERE userid <> $myadminid ORDER BY username";
		&my_sql;
		
		while ($column = $sth->fetchrow_hashref)
			{
			print qq|<option value="$column->{'userid'}">$column->{'username'}</option>|;
			}
	
		$sth->finish;
	
		print qq|</select></td>
		</tr>|;
		}
	print qq|
	<tr>
	<td width="100">Carrier Name: </td>
	<td width="900">
	<select name="carrier" onChange="fetch_services(this.value);">
	<option value="">Please Select ...</option>|;

	$SQL = "SELECT id, name FROM carriers ORDER BY name";
	&my_sql;
	
	while ($column = $sth->fetchrow_hashref)
		{
		print qq|<option value="$column->{'id'}">$column->{'name'}</option>|;
		}

	$sth->finish;

	print qq|</select></td>
	</tr>
	<tr>
	<td width="100">Service Name: </td>
	<td width="900"><div style="vertical-align: middle; padding:3px; float:left;" id="sinf">&nbsp;</div></td>
	</tr>
	<tr>
	<td width="100">Zone: </td>
	<td width="900"><div style="vertical-align: middle; padding:3px; float:left;" id="zinf">&nbsp;</div></td>
	</tr>
	<tr>
	<td colspan="2"><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="submit" type="submit" value="Edit Prices" size="25" /></td>
	</tr>
	</table>
	</form>
	|;
		

print qq|
</div>
|;

&footer;
}


sub assign{
	unless($userprice) {&error_page("Agen not found."); exit;} 

	$SQL = "DELETE FROM prices WHERE userid=$userprice";
	&my_sql;
	$sth->finish;

	$SQL = "insert into prices select 0 as priceid, $userprice as userid, servid, zone, perkg, base_kg, base_price, nondoccharge, kgs, price, extra from prices where userid=0";
	&my_sql;
	$sth->finish;

	$redirect="$script?cf=assignok&userprice=$userprice";
	print $form->redirect(-url=>$redirect);
}


sub editzone{
	my $msg = shift;

	unless($userprice) {&error_page("Incomplete data entered! Please select Agent."); exit;} 
	unless($carrier) {&error_page("Incomplete data entered! Please select Carrier field."); exit;} 
	unless($service) {&error_page("Incomplete data entered! Please select Service field."); exit;} 

&myheader($heading);

&topmenu($heading);

print qq|<div class="ha8"><h1><font color="#000080" size="1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Service Prices</font></h1>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Please edit the following prices and then click the Save button.<br /><br />|;

if( $msg )
	{
	print qq|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#FF0000"><b>* $msg</b></font><br /><br />|;
	}


	$SQL = "SELECT service, bycountry FROM services where id=$service";
	&my_sql;
	if ($column = $sth->fetchrow_hashref)
		{
		$servname = $column->{'service'};
		$bycountry = $column->{'bycountry'};
		}
	$sth->finish;

	$zonenums = 0;
	if( $bycountry )
		{
		if( $zone )
			{
			if( $userprice eq "-1" )
				{	$SQL = "SELECT prices.*, countries.country as country FROM prices LEFT JOIN countries ON prices.zone=countries.id WHERE prices.userid IS NULL AND servid=$service and zone=$zone ORDER BY extra, kgs"; }
			elsif( $userprice eq "-2" )
				{	$SQL = "SELECT prices.*, countries.country as country FROM prices LEFT JOIN countries ON prices.zone=countries.id WHERE prices.userid=0 AND servid=$service and zone=$zone ORDER BY extra, kgs"; }
			else
				{	$SQL = "SELECT prices.*, countries.country as country FROM prices LEFT JOIN countries ON prices.zone=countries.id WHERE prices.userid=$userprice AND servid=$service and zone=$zone ORDER BY extra, kgs"; }
			$zonenums = 1;
			print "<b>Service: $servname - Country: ";
			print get_country($zone);
			print "</b><br /><br />";
			}
		else
			{
			if( $userprice eq "-1" )
				{$SQL = "SELECT count(distinct kgs) as zonenums FROM prices WHERE prices.userid IS NULL AND servid=$service";}
			elsif( $userprice eq "-2" )
				{$SQL = "SELECT count(distinct kgs) as zonenums FROM prices WHERE prices.userid=0 AND servid=$service";}
			else
				{$SQL = "SELECT count(distinct kgs) as zonenums FROM prices WHERE prices.userid=$userprice AND servid=$service";}
			&my_sql;
			if ($column = $sth->fetchrow_hashref)
				{
				$zonenums = $column->{'zonenums'};
				}
			$sth->finish;
	

			if( $userprice eq "-1" )
				{$SQL = "SELECT prices.*, countries.country as country FROM prices LEFT JOIN countries ON prices.zone=countries.id WHERE prices.userid IS NULL AND servid=$service ORDER BY country, extra, kgs";}
			elsif( $userprice eq "-2" )
				{$SQL = "SELECT prices.*, countries.country as country FROM prices LEFT JOIN countries ON prices.zone=countries.id WHERE prices.userid=0 AND servid=$service ORDER BY country, extra, kgs";}
			else
				{$SQL = "SELECT prices.*, countries.country as country FROM prices LEFT JOIN countries ON prices.zone=countries.id WHERE prices.userid=$userprice AND servid=$service ORDER BY country, extra, kgs";}
			print "<b>Service: $servname - All Countries</b><br /><br />";
			}
		}
	else
		{
		if( $zone )
			{
			if( $userprice eq "-1" )
				{$SQL = "SELECT * FROM prices WHERE prices.userid IS NULL AND servid=$service and zone=$zone ORDER BY extra, kgs";}
			elsif( $userprice eq "-2" )
				{$SQL = "SELECT * FROM prices WHERE prices.userid=0 AND servid=$service and zone=$zone ORDER BY extra, kgs";}
			else
				{$SQL = "SELECT * FROM prices WHERE prices.userid=$userprice AND servid=$service and zone=$zone ORDER BY extra, kgs";}
			$zonenums = 1;
			print "<b>Service: $servname - Zone: $zone</b><br /><br />";
			}
		else
			{
			if( $userprice eq "-1" )
				{$SQL = "SELECT count(distinct zone) as zonenums FROM prices WHERE prices.userid IS NULL AND servid=$service";}
			elsif( $userprice eq "-2" )
				{$SQL = "SELECT count(distinct zone) as zonenums FROM prices WHERE prices.userid=0 AND servid=$service";}
			else
				{$SQL = "SELECT count(distinct zone) as zonenums FROM prices WHERE prices.userid=$userprice AND servid=$service";}
						
			&my_sql;
			if ($column = $sth->fetchrow_hashref)
				{
				$zonenums = $column->{'zonenums'};
				}
			$sth->finish;
	
			if( $userprice eq "-1" )
				{$SQL = "SELECT * FROM prices WHERE prices.userid IS NULL AND servid=$service ORDER BY extra, kgs, zone";}
			elsif( $userprice eq "-2" )
				{$SQL = "SELECT * FROM prices WHERE prices.userid=0 AND servid=$service ORDER BY extra, kgs, zone";}
			else
				{$SQL = "SELECT * FROM prices WHERE prices.userid=$userprice AND servid=$service ORDER BY extra, kgs, zone";}
			
			print "<b>Service: $servname - All Zones</b><br /><br />";
			}
		}
	$fldnums = $zonenums+1;
	$allprices = "";
	
	&my_sql;

	print qq|
	<table border="0" style="background-color:#FDF3D0;">
	<form name="frm" action="$script" method="POST">
	<input name="savezone" type="hidden" value="1" />
	<input name="cf" type="hidden" value="price" />
	<input name="carrier" type="hidden" value="$carrier" />
	<input name="service" type="hidden" value="$service" />
	<input name="userprice" type="hidden" value="$userprice" />|;

	if( $bycountry )
		{
		if( $zone )
			{
			print qq|
			<tr style="background-color:#FFCC99;">
			<th style="background-color:#FFCC99;"><b>Kgs</b></th>
			<th style="background-color:#FFCC99;">|;
			
			print get_country($zone);
			
			print "</th>";

			print "</tr>";
			}
		else
			{
			print qq|<tr style="background-color:#FFCC99;">
							 <th style="background-color:#FFCC99;"><b>Country</b></th>|;
				
			if( $userprice eq "-1" )
				{$TSQL = "SELECT distinct kgs FROM prices WHERE prices.userid IS NULL AND servid=$service order by kgs";}
			elsif( $userprice eq "-2" )
				{$TSQL = "SELECT distinct kgs FROM prices WHERE prices.userid=0 AND servid=$service order by kgs";}
			else
				{$TSQL = "SELECT distinct kgs FROM prices WHERE prices.userid=$userprice AND servid=$service order by kgs";}
						
			&tmy_sql;
			while ($tcolumn = $tsth->fetchrow_hashref)
				{
				print qq|<th style="background-color:#FFCC99;">$tcolumn->{'kgs'} Kgs</th>|;
				}
			$tsth->finish;
				
			print "</tr>";
			}
		}
	else
		{
		if( $zone )
			{
			print qq|
			<tr style="background-color:#FFCC99;">
			<th style="background-color:#FFCC99;"><b>Kgs</b></th>
			<th style="background-color:#FFCC99;"><b>Zone $zone</b></th>
			</tr>
			|;
			}
		else
			{
			print qq|<tr style="background-color:#FFCC99;">
					<th style="background-color:#FFCC99;"><b>Kgs</b></th>|;
				
			for( $zi = 1 ; $zi <= $zonenums ; $zi++ )
				{
				print qq|<th style="background-color:#FFCC99;">Zone $zi</th>|;
				}
			print "</tr>";
			}
		}
				
	print qq|<tr style="background-color:#FFFFCC;">|;
	
	$znum = 0;
	$last_kgs = 0;
	$turn = 0;
	while ($column = $sth->fetchrow_hashref)
		{
		if( $znum == 0 || $znum == $zonenums )
			{
			if( $turn )
				{
				$bccolor = "#FFCC00";
				}
			else
				{
				$bccolor = "#FFFFCC";
				}
			if( $turn )
				{ $turn = 0; }
			else
				{ $turn = 1; }
			
			if( $column->{'extra'} )
				{
				if( $znum != 0 )
					{
					print qq|</tr>
					<tr style="background-color:#FFCC99;">|;
					}
				print qq|
				<td colspan="$fldnums"><B>Prices per additional $column->{'kgs'} kg above:</b></td>
				</tr>
				<tr style="background-color:$bccolor;">
				<td><b>$last_kgs</b></td>
				|;
				}
			else
				{
				if( $bycountry )
					{
					if( $znum != 0 )
						{
						print qq|</tr>
						<tr style="background-color:$bccolor;">|;
						}
					if( $zone )
						{
						print qq|
						<td><b>$column->{'kgs'}</b></td>|;
						}
					else
						{
						print qq|
						<td><b>$column->{'country'}</b></td>|;
						}
					}
				else
					{
					if( $znum != 0 )
						{
						print qq|</tr>
						<tr style="background-color:$bccolor;">|;
						}
					print qq|
					<td><b>$column->{'kgs'}</b></td>|;
					}
				}

			$last_kgs = $column->{'kgs'};
			$znum = 0;
			}
		
		$znum++;
		print qq|<td><center><input name="p$column->{'priceid'}" type="text" value="$column->{'price'}" size="6" onkeydown="changecolor(this)" /><input name="kz$column->{'priceid'}" type="hidden" value="$column->{'kgs'};$znum" size="6" /></center></td>|;
		$allprices = $allprices . $column->{'priceid'} . ";";
		}

	$sth->finish;

	print qq|</tr>
	<tr>
	<td colspan="$fldnums"><center><br />
	<input type="hidden" name="allprices" value="$allprices" />
	<input type="submit" value="Save" size="20" /><br /></center>
	</td>
	</tr>
	</form>
	</table>
</div>
|;

&footer;
}

sub savezone{
	unless($userprice) {&error_page("Incomplete data entered! Agent is unknonw."); exit;} 

	my @prices = split(/;/,$allprices);

	foreach $mypriceid (@prices)
		{
		if( $mypriceid )
			{
			$fldname1 = "p$mypriceid";
			$fldname2 = "kz$mypriceid";

			$fldvalue1 = ${$fldname1};
			$fldvalue2 = ${$fldname2};
			
			if( $fldvalue1 == 0 || $fldvalue1 !~ /^\s*\d{1,7}(\.\d{1,2})?\s*$/ )
				{
				my @location = split(/;/, $fldvalue2);
				
				error_page("Price is invalid for in column $location[1] of row $location[0] Kgs"); exit;
				}
			}
		}

	foreach $mypriceid (@prices)
		{
		if( $mypriceid )
			{
			$fldname1 = "p$mypriceid";
			$fldvalue1 = ${$fldname1};

			if( $userprice eq "-1" )
				{$SQL = "UPDATE prices SET price = $fldvalue1 WHERE prices.userid IS NULL AND priceid=$mypriceid";}
			elsif( $userprice eq "-2" )
				{$SQL = "UPDATE prices SET price = $fldvalue1 WHERE prices.userid=0 AND priceid=$mypriceid";}
			else
				{$SQL = "UPDATE prices SET price = $fldvalue1 WHERE prices.userid=$userprice AND priceid=$mypriceid";}
			
			&my_sql;
			$sth->finish;
			}
		}

	$redirect="$script?cf=priceok&userprice=$userprice";
	print $form->redirect(-url=>$redirect);
		
}
 
 
sub fetch_serv{
	my $carorig = shift;
	my $retstr;

	print "Content-type: text/plain\n\n";

	unless ($carorig) { print "ERROR: Carrier cannot be empty!"; exit;}
	
	$TSQL = "SELECT DISTINCT id, service FROM services WHERE carid=$carorig ORDER BY service";
	
	&tmy_sql;

	$retstr = qq|<select name="service" onChange="fetch_zones(this.value);">
		<option value="">Please Select ...</option>
		|;
	
	while ($tcolumn = $tsth->fetchrow_hashref)
		{
		$retstr = $retstr . qq|<option value="$tcolumn->{'id'}">$tcolumn->{'service'}</option>\n|;
		}

	$tsth->finish;
	
	$retstr = $retstr . "</select>";
	
	print $retstr;
}
 
sub fetch_zone{
	my $servorig = shift;
	my $retstr;

	print "Content-type: text/plain\n\n";

	unless ($servorig) { print "ERROR: Service cannot be empty!"; exit;}
	
	$TSQL = "SELECT bycountry FROM services WHERE id=$servorig";
	
	&tmy_sql;

	if ($tcolumn = $tsth->fetchrow_hashref)
		{
		$bycountry = $tcolumn->{'bycountry'};
		}
	else
		{
		$bycountry = 0;
		}
		
	$tsth->finish;

	if( $bycountry )
		{
		$TSQL = "SELECT DISTINCT zone, country FROM zones LEFT JOIN countries ON zones.zone=countries.id WHERE servid=$servorig ORDER BY country";
		}
	else
		{
		$TSQL = "SELECT DISTINCT zone FROM zones WHERE servid=$servorig ORDER BY zone";
		}

	&tmy_sql;

	$retstr = qq|<select name="zone">
		<option value="">Please Select ...</option>|;
		
	if( $bycountry )
		{
		$retstr = $retstr . qq|<option value="0">All Countries</option>|;
		}
	else
		{
		$retstr = $retstr . qq|<option value="0">All Zones</option>|;
		}
	
	while ($tcolumn = $tsth->fetchrow_hashref)
		{
		if( $bycountry )
			{
			$retstr = $retstr . qq|<option value="$tcolumn->{'zone'}">$tcolumn->{'country'}</option>|;
			}
		else
			{
			$retstr = $retstr . qq|<option value="$tcolumn->{'zone'}">$tcolumn->{'zone'}</option>|;
			}
		}

	$tsth->finish;

	$retstr = $retstr . "</select>";
	
	print $retstr;
}

1;
