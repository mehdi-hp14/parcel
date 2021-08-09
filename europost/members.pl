
use CGI; ## load the cgi module

sub home{
&myheader("members");

&topmenu("members");

print qq|<div class="ha8"><h1><font color="#000080" size="1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Register New Agent/Member</font></h1>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Please specify the following information in order to register as a new agent/member<br /><br />
<font size="2" face="Arial">
	<form name="form" method="POST" onSubmit="return formcheck(this)" action="$script">
	<input name="register" type="hidden" value="1" />
	<input name="cf" type="hidden" value="members" />
	<table style="background-color:#FDF3D0; width: 100%" align="left">
		<tr>
			<td style="width: 200px">Username <span class="text2">*</span></td>
			<td style="width: 800px">&nbsp;&nbsp;&nbsp;<input name="username" type="text" size="20" /></td>
		</tr>
		<tr>
			<td style="width: 200px">Password <span class="text2">*</span></td>
			<td style="width: 800px">&nbsp;&nbsp;&nbsp;<input name="pass1" type="password" size="20" /></td>
		</tr>
		<tr>
			<td style="width: 200px">Repeat Password <span class="text2">*</span></td>
			<td style="width: 800px">&nbsp;&nbsp;&nbsp;<input name="pass2" type="password" size="20" /></td>
		</tr>
		<tr>
			<td style="width: 200px">Title <span class="text2">*</span></td>
			<td style="width: 800px">&nbsp;&nbsp;&nbsp;<select name="sal">
			<option selected>Mr.</option>
			<option>Miss.</option>
			<option>Mrs.</option>
			</select></td>
		</tr>
		<tr>
			<td style="width: 200px">First Name <span class="text2">*</span></td>
			<td style="width: 800px">&nbsp;&nbsp;&nbsp;<input name="fname" type="text" size="30" /></td>
		</tr>
		<tr>
			<td style="width: 200px">Last Name <span class="text2">*</span></td>
			<td style="width: 800px">&nbsp;&nbsp;&nbsp;<input name="lname" type="text" size="30" /></td>
		</tr>
		<tr>
			<td style="width: 200px">Company </td>
			<td style="width: 800px">&nbsp;&nbsp;&nbsp;<input name="company" type="text" size="30" /></td>
		</tr>
		<tr>
			<td style="width: 200px">Land Phone <span class="text2">*</span></td>
			<td style="width: 800px">+&nbsp;<input name="tel1" type="text" size="5" />&nbsp;(&nbsp;<input name="tel2" type="text" size="5" />&nbsp;)&nbsp;&nbsp;<input name="tel3" type="text" size="21" /></td>
		</tr>
		<tr>
			<td style="width: 200px">Cell Phone <span class="text2">*</span></td>
			<td style="width: 800px">+&nbsp;<input name="mob1" type="text" size="5" />&nbsp;(&nbsp;<input name="mob2" type="text" size="5" />&nbsp;)&nbsp;&nbsp;<input name="mob3" type="text" size="21" /></td>
		</tr>
		<tr>
			<td style="width: 200px">Fax <span class="text2">*</span></td>
			<td style="width: 800px">+&nbsp;<input name="fax1" type="text" size="5" />&nbsp;(&nbsp;<input name="fax2" type="text" size="5" />&nbsp;)&nbsp;&nbsp;<input name="fax3" type="text" size="21" /></td>
		</tr>
		<tr>
			<td style="width: 200px">Address <span class="text2">*</span></td>
			<td style="width: 800px">&nbsp;&nbsp;&nbsp;<textarea name="add" cols="34" rows="3"></textarea>&nbsp;</td>
		</tr>
		<tr>
			<td style="width: 200px">Post Code <span class="text2">*</span></td>
			<td style="width: 800px">&nbsp;&nbsp;&nbsp;<input name="postcode" type="text" size="20" /></td>
		</tr>
		<tr>
			<td style="width: 200px">Country <span class="text2">*</span></td>
			<td style="width: 800px">&nbsp;&nbsp;&nbsp;<select name="country">|;
			
			&get_countries;
			
			print qq|</select></td>
		</tr>
		<tr>
			<td style="width: 200px">City <span class="text2">*</span></td>
			<td style="width: 800px">&nbsp;&nbsp;&nbsp;<input name="city" type="text" size="28" /></td>
		</tr>
		<tr>
			<td style="width: 200px">Email <span class="text2">*</span></td>
			<td style="width: 800px">&nbsp;&nbsp;&nbsp;<input name="email" type="text" size="47" /></td>
		</tr>
		<tr>
			<td style="width: 200px">Website </td>
			<td style="width: 800px">&nbsp;&nbsp;&nbsp;<input name="website" type="text" size="47" value="http://" /></td>
		</tr>
		<tr>
			<td style="width: 1000px" colspan="2" align="center"><center><br /><input type="submit" value="Register" size="20" />&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" value="Reset" size="20" /></center></td>
		</tr>
	</table>
	&nbsp;
	</form>
</font>
</div>

|;

&footer;

}

sub edit
{
	unless ($memid) {&error_page("Agent/Member Reference is not correct."); exit;} 

&myheader("editmember");

&topmenu("editmember");

	$SQL = "SELECT sum(amount) as credit FROM accounts WHERE userid = $memid"; 
	&my_sql;
	if( $column = $sth->fetchrow_hashref )
		{
		$oldcredit = $column->{'credit'};
		}
	else
		{
		$oldcredit = 0;
		}
	$sth->finish;	

	if( $isAdmin )
		{
		$SQL = "SELECT * FROM members WHERE userid = $memid"; 
		&my_sql;
		$cspan = qq| colspan="9" |;
		}
	else
		{
		$SQL = "SELECT * FROM members WHERE userid = $memid and status=2"; 
		&my_sql;
		$cspan = "";
		}
	

	&my_sql;

	$column = $sth->fetchrow_hashref;
	
	unless( $column )
		{
		$sth->finish;
		&error_page("Agent/Member not found."); exit;
		}

	unless( $isAdmin || $column->{'userid'} == $isUser ) {&error_page("You don't have enough permission for this operation."); exit;}

if( $isAdmin )
	{
	print qq|<div class="ha8"><h1><font color="#000080" size="1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Edit Agent/Member Information</font></h1>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Please edit the following information in order to edit the Agent/Member Information<br /><br />	|;
	}
else
	{
	print qq|<div class="ha8"><h1><font color="#000080" size="1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Edit Profile Information</font></h1>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Please edit the following information in order to edit the Profile Information<br /><br />	|;
	}

print qq|

<div class="ha8">
<font size="2" face="Arial">
	<form name="form" method="POST" onSubmit="return formcheck(this)" action="$script">
	<input name="memid" type="hidden" value="$memid" />
	<input name="username" type="hidden" value="$column->{'username'}" />
	<input name="register" type="hidden" value="1" />
	<input name="fromlist" type="hidden" value="$fromlist" />
	<input name="cf" type="hidden" value="members" />
	<table style="width: 100%" align="left">
		<tr>
			<td style="width: 200px">Username </td>
			<td style="width: 800px" $cspan>&nbsp;&nbsp;&nbsp;<b>$column->{'username'}</b></td>
		</tr>
		<tr>
			<td style="width: 200px">Password <span class="text2">*</span></td>
			<td style="width: 800px" $cspan>&nbsp;&nbsp;&nbsp;<input name="pass1" type="password" size="20" value="$column->{'password'}" /></td>
		</tr>
		<tr>
			<td style="width: 200px">Repeat Password <span class="text2">*</span></td>
			<td style="width: 800px" $cspan>&nbsp;&nbsp;&nbsp;<input name="pass2" type="password" size="20" value="$column->{'password'}" /></td>
		</tr>
		<tr>
			<td style="width: 200px">Title <span class="text2">*</span></td>
			<td style="width: 800px" $cspan>&nbsp;&nbsp;&nbsp;<select name="sal">
			<option |;
			
			print "selected" if( $column->{'sal'} eq "Mr." );
			
			print qq|>Mr.</option>
			<option |;

			print "selected" if( $column->{'sal'} eq "Miss." );
			
			print qq|>Miss.</option>
			<option |;
			
			print "selected" if( $column->{'sal'} eq "Mrs." );
			
			print qq|>Mrs.</option>
			</select></td>
		</tr>
|;

	my $tmpstr = $column->{'fname'};
	$tmpstr =~ s/"/&quot;/g;

print qq|		
		<tr>
			<td style="width: 200px">First Name <span class="text2">*</span></td>
			<td style="width: 800px" $cspan>&nbsp;&nbsp;&nbsp;<input name="fname" type="text" size="30" value="$tmpstr" /></td>
		</tr>
|;

	$tmpstr = $column->{'lname'};
	$tmpstr =~ s/"/&quot;/g;

print qq|		
		<tr>
			<td style="width: 200px">Last Name <span class="text2">*</span></td>
			<td style="width: 800px" $cspan>&nbsp;&nbsp;&nbsp;<input name="lname" type="text" size="30" value="$tmpstr" /></td>
		</tr>
|;

	$tmpstr = $column->{'company'};
	$tmpstr =~ s/"/&quot;/g;

print qq|		
		<tr>
			<td style="width: 200px">Company </td>
			<td style="width: 800px" $cspan>&nbsp;&nbsp;&nbsp;<input name="company" type="text" size="30" value="$tmpstr" /></td>
		</tr>
		<tr>
			<td style="width: 200px">Land Phone <span class="text2">*</span></td>
			<td style="width: 800px" $cspan>+&nbsp;<input name="tel1" type="text" size="5" value="$column->{'tel1'}" />&nbsp;(&nbsp;<input name="tel2" type="text" size="5" value="$column->{'tel2'}" />&nbsp;)&nbsp;&nbsp;<input name="tel3" type="text" size="21" value="$column->{'tel3'}" /></td>
		</tr>
		<tr>
			<td style="width: 200px">Cell Phone <span class="text2">*</span></td>
			<td style="width: 800px" $cspan>+&nbsp;<input name="mob1" type="text" size="5" value="$column->{'mob1'}" />&nbsp;(&nbsp;<input name="mob2" type="text" size="5" value="$column->{'mob2'}" />&nbsp;)&nbsp;&nbsp;<input name="mob3" type="text" size="21" value="$column->{'mob3'}" /></td>
		</tr>
		<tr>
			<td style="width: 200px">Fax <span class="text2">*</span></td>
			<td style="width: 800px" $cspan>+&nbsp;<input name="fax1" type="text" size="5" value="$column->{'fax1'}" />&nbsp;(&nbsp;<input name="fax2" type="text" size="5" value="$column->{'fax2'}" />&nbsp;)&nbsp;&nbsp;<input name="fax3" type="text" size="21" value="$column->{'fax3'}" /></td>
		</tr>
		<tr>
			<td style="width: 200px">Address <span class="text2">*</span></td>
			<td style="width: 800px" $cspan>&nbsp;&nbsp;&nbsp;<textarea name="add" cols="34" rows="3">$column->{'address'}</textarea>&nbsp;</td>
		</tr>
|;

	$tmpstr = $column->{'postcode'};
	$tmpstr =~ s/"/&quot;/g;

print qq|		
		<tr>
			<td style="width: 200px">Post Code <span class="text2">*</span></td>
			<td style="width: 800px" $cspan>&nbsp;&nbsp;&nbsp;<input name="postcode" type="text" size="20" value="$tmpstr" /></td>
		</tr>
		<tr>
			<td style="width: 200px">Country <span class="text2">*</span></td>
			<td style="width: 800px" $cspan>&nbsp;&nbsp;&nbsp;<select name="country">|;
			
			&get_countries($column->{'country'});
			
			print qq|</select></td>
		</tr>
|;

	$tmpstr = $column->{'city'};
	$tmpstr =~ s/"/&quot;/g;

print qq|		
		<tr>
			<td style="width: 200px">City <span class="text2">*</span></td>
			<td style="width: 800px" $cspan>&nbsp;&nbsp;&nbsp;<input name="city" type="text" size="28" value="$tmpstr" /></td>
		</tr>
		<tr>
			<td style="width: 200px">Email <span class="text2">*</span></td>
			<td style="width: 800px" $cspan>&nbsp;&nbsp;&nbsp;<input name="email" type="text" size="47" value="$column->{'email'}" /></td>
		</tr>
		<tr>
			<td style="width: 200px">Website </td>
			<td style="width: 800px" $cspan>&nbsp;&nbsp;&nbsp;<input name="website" type="text" size="47" value="$column->{'website'}" />|;
			
if( $isAdmin )
	{
	print "<br /><br />";
	}
			
		print qq|
			</td>
		</tr>
|;

if( $isAdmin )
	{
	print qq|
		<tr style="background-color:#FFCC99;">
			<td colspan="9">
<input type="hidden" name="numcbl" value="0">			
<input type="hidden" name="numcbm" value="0">			
<input type="hidden" name="oldcredit" value="$oldcredit" />
			<center><b>Manage Agent/Member Account</b></center></td>
		</tr>
		<tr>
			<td style="width: 200px">&nbsp</td>
			<td colspan="9">&nbsp;</td>
		</tr>
		<tr>
			<td style="width: 200px">Agent Credit</td>
			<td colspan="4">£&nbsp;<input name="credit" type="text" size="5" value="$oldcredit" /></td>
		</tr>
		<tr>
			<td style="width: 100px">Custom Entry Charge </td>
			<td style="width: 100px">For LV:</td><td style="width: 100px">£&nbsp;<input name="ceclv" type="text" size="5" value="$column->{'ceclv'}" /></td><td style="width: 100px">For HV:</td><td style="width: 80px">£&nbsp;<input name="cechv" type="text" size="5" value="$column->{'cechv'}" /></td><td style="width: 100px">For MHV:</td><td style="width: 80px">£&nbsp;<input name="cecmhv" type="text" size="5" value="$column->{'cecmhv'}" /></td><td style="width: 140px">For Personal Effects:</td><td style="width: 100px">£&nbsp;<input name="cecpe" type="text" size="5" value="$column->{'cecpe'}" /></td>
		</tr>
		<tr>
			<td style="width: 100px">Airline Handling Charge </td>
			<td style="width: 100px">Min. Weight:</td><td style="width: 100px">&nbsp;&nbsp;&nbsp;<input name="ahcminkg" type="text" size="5" value="$column->{'ahcminkg'}" />&nbsp;<small>Kgs</small></td><td style="width: 100px">Min. Charge:</td><td style="width: 80px">£&nbsp;<input name="ahccharge" type="text" size="5" value="$column->{'ahccharge'}" /></td><td style="width: 100px">Per Kg Charge:</td><td colspan="2">£&nbsp;<input name="ahcperkg" type="text" size="5" value="$column->{'ahcperkg'}" /></td>
		</tr>
		<tr>
			<td style="width: 100px">FAS Account Service Charge </td>
			<td colspan="8">£&nbsp;<input name="fas" type="text" size="5" value="$column->{'fas'}" /></td>
		</tr>
		<tr>
			<td style="width: 200px">Airport Collection Charge </td>
			<td colspan="8">£&nbsp;<input name="aircol" type="text" size="5" value="$column->{'aircol'}" /></td>
		</tr>
		<tr>
			<td style="width: 200px">EPX Cash Back </td>
			<td colspan="8"><input name="epxcb" type="radio" value="1" style="border:0px;" |;
		
			print "checked " if( $column->{'epxcb'} eq "1" );
			
			print qq| onClick="Javascript:ChangeCB(true);" />Enabled&nbsp;&nbsp;&nbsp;&nbsp;<input name="epxcb" type="radio" value="0" style="border:0px;" |;

			print "checked " if( $column->{'epxcb'} eq "0" );
			
			print qq| onClick="Javascript:ChangeCB(false);" />Disable</td>
		</tr>
		<tr>
			<td style="width: 200px">
			<b>LOW VALUE RULES</b>&nbsp;&nbsp;<a href="javascript:AddRule('l');"><img src="img/content/add.gif" width="16" height="16" border="0" alt="Add New Rule" /></a>&nbsp;&nbsp;<a href="javascript:DelRule('l');"><img src="img/content/del.gif" width="16" height="16" border="0" alt="Delete Last Rule" /></a>
			</td>
			<td colspan="8"><hr width="100%" size="1" noshade></td>
		</tr>
		<tr>
			<td style="width: 1000px" $cspan>
			<div id="divRulesl">
			|;

			$SQL2 = "SELECT * FROM cashback WHERE userid = $memid AND lvmv = 'l' order by cbid"; 
			&my_sql2;
			my $ri = 0;
			while( $column2 = $sth2->fetchrow_hashref )
				{
				$ri++;
				if( $ri < 10 )
					{
					print qq|<div style="vertical-align: top;">Rule.&nbsp;&nbsp;&nbsp;$ri:&nbsp;|;
					}
				else
					{
					print qq|<div style="vertical-align: top;">Rule.&nbsp;$ri:&nbsp;|;
					}
				print qq|From&nbsp;<Input type="text" name="fromkgl[$ri]" style="width:27px;height:15px;" value="$column2->{'fromkg'}" /><FONT SIZE=-2>&nbsp;kg&nbsp;&nbsp;</FONT>|;
				print qq|up to&nbsp;<Input type="text" name="tokgl[$ri]" style="width:27px;height:15px;" value="$column2->{'tokg'}" /><FONT SIZE=-2>&nbsp;kg&nbsp;&nbsp;</FONT>|;
				print qq|%&nbsp;<Input type="text" name="pervaluel[$ri]" style="width:27px;height:15px;" value="$column2->{'pervalue'}" />&nbsp;of Value of Goods&nbsp;+&nbsp;|;
				print qq|£&nbsp;<Input type="text" name="fixchargel[$ri]" style="width:27px;height:15px;" value="$column2->{'fixcharge'}" />&nbsp;+&nbsp;|;
				print qq|%&nbsp;<Input type="text" name="cardchargel[$ri]" style="width:27px;height:15px;" value="$column2->{'cardcharge'}" />&nbsp;(Card Service Charge);&nbsp;&nbsp;We will pay credit to Agent |;
				print qq|£&nbsp;<Input type="text" name="agentsharel[$ri]" style="width:27px;height:15px;" value="$column2->{'agentshare'}" />&nbsp;&nbsp;|;
				print qq|after&nbsp;<Input type="text" name="cbafterl[$ri]" style="width:27px;height:15px;" value="$column2->{'cbafter'}" />&nbsp;items.|;
				print qq|</div>|;
				}
			$sth2->finish;
			print qq|
			</div>
			</td>
		</tr>
		<tr>
		<tr>
			<td style="width: 200px">
			<b>MH VALUE RULES</b>&nbsp;&nbsp;&nbsp;&nbsp;<small>&nbsp;<small><a href="javascript:AddRule('m');"><img src="img/content/add.gif" width="16" height="16" border="0" alt="Add New Rule" /></a>&nbsp;&nbsp;<a href="javascript:DelRule('m');"><img src="img/content/del.gif" width="16" height="16" border="0" alt="Delete Last Rule" /></a>
			</td>
			<td colspan="8"><hr width="100%" size="1" noshade></td>
		</tr>
		<tr>
			<td style="width: 1000px" $cspan>
			<div id="divRulesm">
			|;

			$SQL2 = "SELECT * FROM cashback WHERE userid = $memid AND lvmv = 'm' order by cbid"; 
			&my_sql2;
			$ri = 0;
			while( $column2 = $sth2->fetchrow_hashref )
				{
				$ri++;
				if( $ri < 10 )
					{
					print qq|<div style="vertical-align: top;">Rule.&nbsp;&nbsp;&nbsp;$ri:&nbsp;|;
					}
				else
					{
					print qq|<div style="vertical-align: top;">Rule.&nbsp;$ri:&nbsp;|;
					}
				print qq|From&nbsp;<Input type="text" name="fromkgm[$ri]" style="width:27px;height:15px;" value="$column2->{'fromkg'}" /><FONT SIZE=-2>&nbsp;kg&nbsp;&nbsp;</FONT>|;
				print qq|up to&nbsp;<Input type="text" name="tokgm[$ri]" style="width:27px;height:15px;" value="$column2->{'tokg'}" /><FONT SIZE=-2>&nbsp;kg&nbsp;&nbsp;</FONT>|;
				print qq|%&nbsp;<Input type="text" name="pervaluem[$ri]" style="width:27px;height:15px;" value="$column2->{'pervalue'}" />&nbsp;of Value of Goods&nbsp;+&nbsp;|;
				print qq|£&nbsp;<Input type="text" name="fixchargem[$ri]" style="width:27px;height:15px;" value="$column2->{'fixcharge'}" />&nbsp;+&nbsp;|;
				print qq|%&nbsp;<Input type="text" name="cardchargem[$ri]" style="width:27px;height:15px;" value="$column2->{'cardcharge'}" />&nbsp;(Card Service Charge);&nbsp;&nbsp;We will pay credit to Agent |;
				print qq|£&nbsp;<Input type="text" name="agentsharem[$ri]" style="width:27px;height:15px;" value="$column2->{'agentshare'}" />&nbsp;&nbsp;|;
				print qq|after&nbsp;<Input type="text" name="cbafterm[$ri]" style="width:27px;height:15px;" value="$column2->{'cbafter'}" />&nbsp;items.|;
				print qq|</div>|;
				}
			$sth2->finish;
			print qq|
			</div>
			</td>
		</tr>
		<tr>
			<td style="width: 1000px" $cspan align="center"><center><br /><input type="submit" value="Save Information" size="20" /></center></td>
		</tr>
		|;
	}
else
	{
	if( $column->{'epxcb'} eq "1" )
		{
	print qq|
		<tr style="background-color:#FFCC99;">
			<td colspan="2">
			<center><b>EPX Cash Back</b></center></td>
		</tr>
		<tr>
			<td colspan="2">&nbsp</td>
		</tr>
		<tr>
			<td>
			<b>LOW VALUE RULES</b>&nbsp;&nbsp;
			</td>
			<td>
			<hr width="100%" size="1" noshade>
			</td>
		</tr>
		<tr>
			<td colspan="2">
			|;

			$SQL2 = "SELECT * FROM cashback WHERE userid = $memid AND lvmv = 'l' order by cbid"; 
			&my_sql2;
			my $ri = 0;
			while( $column2 = $sth2->fetchrow_hashref )
				{
				$ri++;
				if( $ri < 10 )
					{
					print qq|<div style="vertical-align: top;">Rule.&nbsp;&nbsp;&nbsp;$ri:&nbsp;|;
					}
				else
					{
					print qq|<div style="vertical-align: top;">Rule.&nbsp;$ri:&nbsp;|;
					}
				print qq|From&nbsp;$column2->{'fromkg'}<FONT SIZE=-2>&nbsp;kg&nbsp;&nbsp;&nbsp;&nbsp;</FONT>|;
				print qq|up to&nbsp;$column2->{'tokg'}<FONT SIZE=-2>&nbsp;kg&nbsp;&nbsp;&nbsp;&nbsp;</FONT>|;
				print qq|%&nbsp;$column2->{'pervalue'}&nbsp;of Value of Goods&nbsp;+&nbsp;|;
				print qq|£&nbsp;$column2->{'fixcharge'}&nbsp;+&nbsp;|;
				print qq|%&nbsp;$column2->{'cardcharge'}&nbsp;(Card Service Charge);&nbsp;&nbsp;|;
				print qq|We will pay credit to yout £&nbsp;$column2->{'agentshare'}|;
				print qq|&nbsp;&nbsp;after&nbsp;$column2->{'cbafter'}&nbsp;items.|;
				print "</div>";
				}
			$sth2->finish;
			print qq|
			</td>
		</tr>
		<tr>
			<td>
			<b>MH VALUE RULES</b>&nbsp;&nbsp;&nbsp;&nbsp;<small>&nbsp;<small></td>
			<td>
			<hr width="100%" size="1" noshade>
			</td>
		</tr>
		<tr>
			<td colspan="2">
			|;

			$SQL2 = "SELECT * FROM cashback WHERE userid = $memid AND lvmv = 'm' order by cbid"; 
			&my_sql2;
			$ri = 0;
			while( $column2 = $sth2->fetchrow_hashref )
				{
				$ri++;
				if( $ri < 10 )
					{
					print qq|<div style="vertical-align: top;">Rule.&nbsp;&nbsp;&nbsp;$ri:&nbsp;|;
					}
				else
					{
					print qq|<div style="vertical-align: top;">Rule.&nbsp;$ri:&nbsp;|;
					}
				print qq|From&nbsp;$column2->{'fromkg'}<FONT SIZE=-2>&nbsp;kg&nbsp;&nbsp;&nbsp;&nbsp;</FONT>|;
				print qq|up to&nbsp;$column2->{'tokg'}<FONT SIZE=-2>&nbsp;kg&nbsp;&nbsp;&nbsp;&nbsp;</FONT>|;
				print qq|%&nbsp;$column2->{'pervalue'}&nbsp;of Value of Goods&nbsp;+&nbsp;|;
				print qq|£&nbsp;$column2->{'fixcharge'}&nbsp;+&nbsp;|;
				print qq|%&nbsp;$column2->{'cardcharge'}&nbsp;(Card Service Charge);&nbsp;&nbsp;|;
				print qq|We will pay credit to you £&nbsp;$column2->{'agentshare'}|;
				print qq|&nbsp;&nbsp;after&nbsp;$column2->{'cbafter'}&nbsp;items.|;
				print "</div>";
				}
			$sth2->finish;
			print qq|
			</td>
		</tr>
		|;	
		}
		
		print qq|
		<tr>
			<td style="width: 1000px" colspan="2" align="center"><center><br /><input type="submit" value="Save Information" size="20" /></center></td>
		</tr>
		|;
	}

print qq|
	</table>
	<script language="Javascript">
	|;
	
	if( $column->{'epxcb'} eq "1" )
		{ print "ChangeCB(true);"; }
	else
		{ print "ChangeCB(false);"; }

	$sth->finish;

	print qq|
	</script>
	&nbsp;
	</form>
</font>
</div>

|;

&footer;

}

sub register{
	unless ($username) {&error_page("Incomplete data entered! Please enter the Username field."); exit;} 
	if ($username =~ /'/ ) {&error_page("Username cannot contain ' character!"); exit;} 
	if ($username =~ /"/ ) {&error_page("Username cannot contain \" character!"); exit;} 
	unless ($pass1) {&error_page("Incomplete data entered! Please enter the Password field."); exit;} 
	if ($pass1 =~ /'/ ) {&error_page("Password cannot contain ' character!"); exit;} 
	if ($pass1 =~ /"/ ) {&error_page("Password cannot contain \" character!"); exit;} 
	unless ($pass2) {&error_page("Incomplete data entered! Please enter the Repeat Password field."); exit;} 
	unless ($sal) {&error_page("Incomplete data entered! Please enter the Title field."); exit;} 
	unless ($fname) {&error_page("Incomplete data entered! Please enter the First Name field."); exit;} 
	unless ($lname) {&error_page("Incomplete data entered! Please enter the Last Name field."); exit;} 
	unless ($tel1 && $tel2 && $tel3 ) {&error_page("Incomplete data entered! Please enter the Land Phone field."); exit;} 
	unless ($tel1 =~ /^\s*[0-9]+\s*$/ && $tel2 =~ /^\s*[0-9]+\s*$/ && $tel3 =~ /^\s*[0-9]+\s*$/ ) {&error_page("Wrong data specified! Land Phone field is invalid. Please press back button in your browser to correct the problem."); exit;} 
	unless ($mob1 && $mob2 && $mob3 ) {&error_page("Incomplete data entered! Please enter the Cell Phone field."); exit;} 
	unless ($mob1 =~ /^\s*[0-9]+\s*$/ && $mob2 =~ /^\s*[0-9]+\s*$/ && $mob3 =~ /^\s*[0-9]+\s*$/ ) {&error_page("Wrong data specified! Cell Phone field is invalid. Please press back button in your browser to correct the problem."); exit;} 
	unless ($fax1 && $fax2 && $fax3 ) {&error_page("Incomplete data entered! Please enter the Fax field."); exit;} 
	unless ($fax1 =~ /^\s*[0-9]+\s*$/ && $fax2 =~ /^\s*[0-9]+\s*$/ && $fax3 =~ /^\s*[0-9]+\s*$/ ) {&error_page("Wrong data specified! Fax field is invalid. Please press back button in your browser to correct the problem."); exit;} 
	unless ($add) {&error_page("Incomplete data entered! Please enter the Address field."); exit;} 
	unless ($postcode) {&error_page("Incomplete data entered! Please enter the Post Code field."); exit;} 
	unless ($country) {&error_page("Incomplete data entered! Please enter the Country field."); exit;} 
	unless ($city) {&error_page("Incomplete data entered! Please enter the City field."); exit;} 
	unless ($email) {&error_page("Incomplete data entered! Please enter the Email field."); exit;} 
	if ($email =~ /'/ ) {&error_page("Email cannot contain ' character!"); exit;} 
	if ($email =~ /"/ ) {&error_page("Email cannot contain \" character!"); exit;} 

	unless ($email =~ m~^\s*(?:[a-zA-Z0-9_^&amp;/+-])+(?:\.(?:[a-zA-Z0-9_^&amp;/+-])+)*@(?:(?:\[?(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?))\.){3}(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\]?)|(?:[a-zA-Z0-9-]+\.)+(?:[a-zA-Z]){2,}\.?)\s*$~ ) {&error_page("Email is incorrect! Please enter the a valid email address."); exit;} 
#	unless ($email =~ /^\s+(\w¦\-¦\_¦\.)+\@((\w¦\-¦\_)+\.)+[a-zA-Z]{2,}\s+$/ ) {&error_page("Email is incorrect! Please enter the a valid email address."); exit;} 

	if( $website )
		{
		if( $website eq "http://" )
			{
			$website = "";
			}
		else
			{
			if ($website =~ /'/ ) {&error_page("Website cannot contain ' character!"); exit;} 
			if ($website =~ /"/ ) {&error_page("Website cannot contain \" character!"); exit;} 
			}
		}

	if ($pass1 ne $pass2) {&error_page("Passwords are not the same. Please try again."); exit;} 

	if ( length($pass1) < 5) {&error_page("Password length must be 5 characters or more. Please try again."); exit;} 

	if( $isAdmin )
		{
		unless ($credit =~ /^\s*\-?[0-9\.]+\s*$/ ) {&error_page("Wrong data specified! Agent Credit is invalid. Please press back button in your browser to correct the problem."); exit;} 
		unless ($ceclv =~ /^\s*[0-9\.]+\s*$/ && $ceclv >= 0 ) {&error_page("Wrong data specified! Custom Entry Charge for LV is invalid. Please press back button in your browser to correct the problem."); exit;} 
		unless ($cechv =~ /^\s*[0-9\.]+\s*$/ && $cechv >= 0 ) {&error_page("Wrong data specified! Custom Entry Charge for HV is invalid. Please press back button in your browser to correct the problem."); exit;} 
		unless ($cecmhv =~ /^\s*[0-9\.]+\s*$/ && $cecmhv >= 0 ) {&error_page("Wrong data specified! Custom Entry Charge for MHV is invalid. Please press back button in your browser to correct the problem."); exit;} 
		unless ($cecpe =~ /^\s*[0-9\.]+\s*$/ && $cecpe >= 0 ) {&error_page("Wrong data specified! Custom Entry Charge for PE is invalid. Please press back button in your browser to correct the problem."); exit;} 
		unless ($ahcminkg =~ /^\s*[0-9\.]+\s*$/ && $ahcminkg >= 0 ) {&error_page("Wrong data specified! Airline Handling Charge Min. Weight is invalid. Please press back button in your browser to correct the problem."); exit;} 
		unless ($ahccharge =~ /^\s*[0-9\.]+\s*$/ && $ahccharge >= 0 ) {&error_page("Wrong data specified! Airline Handling Min. Charge is invalid. Please press back button in your browser to correct the problem."); exit;} 
		unless ($ahcperkg =~ /^\s*[0-9\.]+\s*$/ && $ahcperkg >= 0 ) {&error_page("Wrong data specified! Airline Handling Per Kg Charge is invalid. Please press back button in your browser to correct the problem."); exit;} 
		unless ($fas =~ /^\s*[0-9\.]+\s*$/ && $fas >= 0 ) {&error_page("Wrong data specified! FAS Account Service Charge is invalid. Please press back button in your browser to correct the problem."); exit;} 
		unless ($aircol =~ /^\s*[0-9\.]+\s*$/ && $aircol >= 0 ) {&error_page("Wrong data specified! Airport Collection Charge is invalid. Please press back button in your browser to correct the problem."); exit;} 
		if ($epxcb ne "0" && $epxcb ne "1") {&error_page("Incomplete data entered! Please select a value for EPX Cash Back field."); exit;} 

		for( $l = 1; $l <= $numcbl ; $l++ )
			{
			my ($w1, $w2, $w3, $w4, $w5, $w6, $w7);
			$w1 = "fromkgl[$l]";
			unless (${$w1} && ${$w1} =~ /^\s*[0-9\.]+\s*$/ && ${$w1} > 0 ) {&error_page("Please enter a correct value for the From Kg of rule $l for LV."); exit;} 
		 	$w2 = "tokgl[$l]";
			unless (${$w2} && ${$w2} =~ /^\s*[0-9\.]+\s*$/ && ${$w2} > 0 ) {&error_page("Please enter a correct value for the Up To Kg of rule $l for LV."); exit;} 
		 	$w3 = "pervaluel[$l]";
			unless (${$w3} =~ /^\s*[0-9\.]+\s*$/ && ${$w3} >= 0 ) {&error_page("Please enter a correct value for the Percent of Value of Goods of rule $l for LV."); exit;} 
		 	$w4 = "fixchargel[$l]";
			unless (${$w4} =~ /^\s*[0-9\.]+\s*$/ && ${$w4} >= 0 ) {&error_page("Please enter a correct value for the Fixed Charge of rule $l for LV."); exit;} 
		 	$w5 = "cardchargel[$l]";
			unless (${$w5} =~ /^\s*[0-9\.]+\s*$/ && ${$w5} >= 0 ) {&error_page("Please enter a correct value for the Percent Card Service Charge of rule $l for LV."); exit;} 
		 	$w6 = "agentsharel[$l]";
			unless (${$w6} && ${$w6} =~ /^\s*[0-9\.]+\s*$/ && ${$w6} > 0 ) {&error_page("Please enter a correct value for the Payable Credit to Agent of rule $l for LV."); exit;} 
		 	$w7 = "cbafterl[$l]";
			unless (${$w7} =~ /^\s*[0-9]+\s*$/ && ${$w7} >= 0 ) {&error_page("Please enter a correct value for the After Items of rule $l for LV."); exit;} 
			}

		for( $l = 1; $l <= $numcbm ; $l++ )
			{
			my ($w1, $w2, $w3, $w4, $w5, $w6, $w7);
			$w1 = "fromkgm[$l]";
			unless (${$w1} && ${$w1} =~ /^\s*[0-9\.]+\s*$/ && ${$w1} > 0 ) {&error_page("Please enter a correct value for the From Kg of rule $l for MHV."); exit;} 
		 	$w2 = "tokgm[$l]";
			unless (${$w2} && ${$w2} =~ /^\s*[0-9\.]+\s*$/ && ${$w2} > 0 ) {&error_page("Please enter a correct value for the Up To Kg of rule $l for MHV."); exit;} 
		 	$w3 = "pervaluem[$l]";
			unless (${$w3} =~ /^\s*[0-9\.]+\s*$/ && ${$w3} >= 0 ) {&error_page("Please enter a correct value for the Percent of Value of Goods of rule $l for MHV."); exit;} 
		 	$w4 = "fixchargem[$l]";
			unless (${$w4} =~ /^\s*[0-9\.]+\s*$/ && ${$w4} >= 0 ) {&error_page("Please enter a correct value for the Fixed Charge of rule $l for MHV."); exit;} 
		 	$w5 = "cardchargem[$l]";
			unless (${$w5} =~ /^\s*[0-9\.]+\s*$/ && ${$w5} >= 0 ) {&error_page("Please enter a correct value for the Percent Card Service Charge of rule $l for MHV."); exit;} 
		 	$w6 = "agentsharem[$l]";
			unless (${$w6} && ${$w6} =~ /^\s*[0-9\.]+\s*$/ && ${$w6} > 0 ) {&error_page("Please enter a correct value for the Payable Credit to Agent of rule $l for MHV."); exit;} 
		 	$w7 = "cbafterm[$l]";
			unless (${$w7} =~ /^\s*[0-9]+\s*$/ && ${$w7} >= 0 ) {&error_page("Please enter a correct value for the After Items of rule $l for MHV."); exit;} 
			}
	
		if( $numcbl == 0 && $numcbm == 0 && $epxcb eq "1" )
			{
			$epxcb = "0";
			}
		}

	my $usercgi = new CGI; 
	my $userip = $usercgi->remote_host(); 

	$fname =~ s/'/''/g;
	$lname =~ s/'/''/g;
	$company =~ s/'/''/g;
	$add =~ s/'/''/g;
	$postcode =~ s/'/''/g;
	$city =~ s/'/''/g;

	if( $memid )
		{
		$SQL = "SELECT email FROM members WHERE email='$email' AND userid <> $memid"; 
		&my_sql;
		if ($column = $sth->fetchrow_hashref)
			{
			$oldemail = $column->{'email'};
			}
		$sth->finish;
	
		if( !$oldemail  ) 
			{
			if( $isAdmin )
				{
				$SQL = "UPDATE members SET password='$pass1',sal='$sal',fname='$fname',lname='$lname',company='$company',tel1='$tel1',tel2='$tel2',tel3='$tel3',mob1='$mob1',mob2='$mob2',mob3='$mob3',fax1='$fax1',fax2='$fax2',fax3='$fax3',email='$email',website='$website',address='$add',postcode='$postcode',city='$city',country=$country,ceclv=$ceclv,cechv=$cechv,cecmhv=$cecmhv,cecpe=$cecpe,ahcminkg=$ahcminkg,ahccharge=$ahccharge,ahcperkg=$ahcperkg,fas=$fas,aircol=$aircol,epxcb=$epxcb WHERE userid=$memid";
				}
			else
				{
				$SQL = "UPDATE members SET password='$pass1',sal='$sal',fname='$fname',lname='$lname',company='$company',tel1='$tel1',tel2='$tel2',tel3='$tel3',mob1='$mob1',mob2='$mob2',mob3='$mob3',fax1='$fax1',fax2='$fax2',fax3='$fax3',email='$email',website='$website',address='$add',postcode='$postcode',city='$city',country=$country WHERE userid=$memid";
				}
			&my_sql;
			$sth->finish;

			if( $isAdmin )
				{
				$SQL = "DELETE FROM cashback WHERE userid=$memid";
				&my_sql;
				$sth->finish;

				for( $l = 1; $l <= $numcbl ; $l++ )
					{
					my $w;
		
					$SQLFLDS = "(cbid,userid,lvmv,fromkg,tokg,pervalue,fixcharge,cardcharge,agentshare,cbafter)";
			
					$SQLVALS = "(0,$memid,'l',";
					$w = "fromkgl[$l]";
					$SQLVALS = $SQLVALS . ${$w} . ",";
				 	$w = "tokgl[$l]";
					$SQLVALS = $SQLVALS . ${$w} . ",";
				 	$w = "pervaluel[$l]";
					$SQLVALS = $SQLVALS . ${$w} . ",";
				 	$w = "fixchargel[$l]";
					$SQLVALS = $SQLVALS . ${$w} . ",";
				 	$w = "cardchargel[$l]";
					$SQLVALS = $SQLVALS . ${$w} . ",";
				 	$w = "agentsharel[$l]";
					$SQLVALS = $SQLVALS . ${$w} . ",";
				 	$w = "cbafterl[$l]";
					$SQLVALS = $SQLVALS . ${$w} . ")";
					
					$SQL = "INSERT INTO cashback $SQLFLDS VALUES $SQLVALS";
					&my_sql;
					$sth->finish;
					}

				for( $l = 1; $l <= $numcbm ; $l++ )
					{
					my $w;
		
					$SQLFLDS = "(cbid,userid,lvmv,fromkg,tokg,pervalue,fixcharge,cardcharge,agentshare,cbafter)";
			
					$SQLVALS = "(0,$memid,'m',";
					$w = "fromkgm[$l]";
					$SQLVALS = $SQLVALS . ${$w} . ",";
				 	$w = "tokgm[$l]";
					$SQLVALS = $SQLVALS . ${$w} . ",";
				 	$w = "pervaluem[$l]";
					$SQLVALS = $SQLVALS . ${$w} . ",";
				 	$w = "fixchargem[$l]";
					$SQLVALS = $SQLVALS . ${$w} . ",";
				 	$w = "cardchargem[$l]";
					$SQLVALS = $SQLVALS . ${$w} . ",";
				 	$w = "agentsharem[$l]";
					$SQLVALS = $SQLVALS . ${$w} . ",";
				 	$w = "cbafterm[$l]";
					$SQLVALS = $SQLVALS . ${$w} . ")";
					
					$SQL = "INSERT INTO cashback $SQLFLDS VALUES $SQLVALS";
					&my_sql;
					$sth->finish;
					}
				if( $credit != $oldcredit )
					{
					my $adif = $credit - $oldcredit;
					my $adesctmp;
					if( $adif > 0 )
						{
						$adesctmp = "added";
						}
					else
						{
						$adesctmp = "subtracted";
						}
						
					$SQL = "INSERT INTO accounts (accid, userid, adate, amount, atype, aref, asubref, asubrefstr, adesc) VALUES (0, $memid, CURRENT_TIMESTAMP(), $adif, 'D', 0, 0, '', 'Credit directly $adesctmp by Admin.' )";
					&my_sql;
					$sth->finish;
					}
				}

			if( $fromlist )
				{
				$redirect ="$script?cf=members&viewall=1&userid=$isUser";
				}
			else
				{
				$redirect="$script?cf=memberok";
				}

			print $form->redirect(-url=>$redirect);
			}
		else
			{
			error_page("The email address already exists. Please use another email address.");
			}
		}
	else
		{
		$memid = 0;
		$SQL = "SELECT userid, username, email FROM members WHERE username = '$username' or email='$email'"; 
		&my_sql;
		if ($column = $sth->fetchrow_hashref)
			{
			$memid = $column->{'userid'};
			$oldusername = $column->{'username'};
			$oldemail = $column->{'email'};
			}
		$sth->finish;
	
		if( $memid == 0 ) {
			$SQL2 = "SELECT ceclv, cechv, cecmhv, cecpe, ahcminkg, ahccharge, ahcperkg, fas, aircol FROM members where type=9"; 
			&my_sql2;
			if ($column2 = $sth2->fetchrow_hashref)
				{
				$newmem_ceclv = $column2{'ceclv'};
				$newmem_cechv = $column2{'cechv'};
				$newmem_cecmhv = $column2{'cecmhv'};
				$newmem_cecpe = $column2{'cecpe'};
				$newmem_ahcminkg = $column2{'ahcminkg'};
				$newmem_ahccharge = $column2{'ahccharge'};
				$newmem_ahcperkg = $column2{'ahcperkg'};
				$newmem_fas = $column2{'fas'};
				$newmem_aircol = $column2{'aircol'};
				}
			$sth2->finish;

			$newmem_ceclv = "NULL" unless($newmem_ceclv);
			$newmem_cechv = "NULL" unless($newmem_cechv);
			$newmem_cecmhv = "NULL" unless($newmem_cecmhv);
			$newmem_cecpe = "NULL" unless($newmem_cecpe);
			$newmem_ahcminkg = "NULL" unless($newmem_ahcminkg);
			$newmem_ahccharge = "NULL" unless($newmem_ahccharge);
			$newmem_ahcperkg = "NULL" unless($newmem_ahcperkg);
			$newmem_fas = "NULL" unless($newmem_fas);
			$newmem_aircol = "NULL" unless($newmem_aircol);

			$SQLFLDS = "(userid,username,password,sal,fname,lname,company,tel1,tel2,tel3,mob1,mob2,mob3,fax1,fax2,fax3,email,website,address,postcode,city,country,regdate,activedate,enddate,status,type,ceclv,cechv,cecmhv,cecpe,ahcminkg,ahccharge,ahcperkg,fas,aircol,epxcb,ip,lastvisit)";
			$SQLVALS = "(0,'$username', '$pass1', '$sal', '$fname', '$lname', '$company', '$tel1', '$tel2', '$tel3', '$mob1', '$mob2', '$mob3', '$fax1', '$fax2', '$fax3', '$email', '$website', '$add', '$postcode', '$city', '$country', CURRENT_TIMESTAMP(), '0000-00-00', '0000-00-01', 1, 1, $newmem_ceclv, $newmem_cechv, $newmem_cecmhv, $newmem_cecpe, $newmem_ahcminkg, $newmem_ahccharge, $newmem_ahcperkg, $newmem_fas, $newmem_aircol, NULL, '$userip', CURRENT_TIMESTAMP())";
		
			$SQL = "INSERT INTO members $SQLFLDS VALUES $SQLVALS";
			&my_sql;
			$sth->finish;
			
			$SQL = "SELECT LAST_INSERT_ID() as userid FROM members"; 
			&my_sql;
			if ($column = $sth->fetchrow_hashref)
				{
				$memid = $column->{'userid'};
				}
			$sth->finish;
			
			$SQL = "insert into prices select 0 as priceid, $memid as userid, servid, zone, perkg, base_kg, base_price, nondoccharge, kgs, price, extra from prices where userid=0";
			&my_sql;
			$sth->finish;

			$SQL = "INSERT INTO cashback SELECT 0 as cbid, $memid as userid,lvmv,fromkg,tokg,pervalue,fixcharge,cardcharge,agentshare,cbafter FROM cashback LEFT JOIN members ON cashback.userid = members.userid WHERE members.type=9 ORDER BY cbid"; 
			&my_sql;
			$sth->finish;

			&SendEmail($myemail, $adminemail, "New agent/member registration", "<p>Dear $salesman,<br><br>A new agent/member, $sal $fname $lname, is just registered in your system. His/Her account is not acivated yet. You may visit his profile at:<br><br><a href=\"$scripturl?cf=members&view=1&memid=$memid\">$scripturl?cf=members&view=1&memid=$memid</a><br><br>Also, you can activate his/her account directly by visiting the following links:<br><br><a href=\"$scripturl?cf=members&activate=1&memid=$memid\">Activate as International Agent</a><br><a href=\"$scripturl?cf=members&activate=2&memid=$memid\">Activate as Local Retail Agent</a><br><a href=\"$scripturl?cf=members&activate=3&memid=$memid\">Activate as Member</a><br><br>Your Sincerely,<br>Administrator</p>");
	
			$redirect="$script?cf=regthank";
			print $form->redirect(-url=>$redirect);
			}
		else
			{
			if( $oldusername eq $username )
				{
				error_page("The username already exists. Please select another username.");
				}
			else
				{
				error_page("The email address already exists. Please use another email address.");
				}
			}
		}
}

sub view{
	unless( $isAdmin  || $isUser == $memid ) { error_page("Agent/Member not found!"); exit;}

	$SQL = "SELECT sum(amount) as credit FROM accounts WHERE userid = $memid"; 
	&my_sql;
	if( $column = $sth->fetchrow_hashref )
		{
		$credit = $column->{'credit'};
		}
	else
		{
		$credit = 0;
		}
	$sth->finish;	

	if( $isAdmin )
		{
		$SQL = "SELECT members.userid as userid,username,password,sal,fname,lname,company,tel1,tel2,tel3,mob1,mob2,mob3,fax1,fax2,fax3,email,website,address,postcode,city,country,regdate,activedate,enddate,status,type,ceclv,cechv,cecmhv,cecpe,ahcminkg,ahccharge,ahcperkg,fas,aircol,epxcb,ip,lastvisit, count(cashback.cbid) as cashbackcount FROM members LEFT JOIN cashback ON members.userid=cashback.userid WHERE members.userid = $memid GROUP BY members.userid,username,password,sal,fname,lname,company,tel1,tel2,tel3,mob1,mob2,mob3,fax1,fax2,fax3,email,website,address,postcode,city,country,regdate,activedate,enddate,status,type,ceclv,cechv,cecmhv,cecpe,ahcminkg,ahccharge,ahcperkg,fas,aircol,epxcb,ip,lastvisit"; 
		&my_sql;
		}
	else
		{
		$SQL = "SELECT * FROM members WHERE userid = $memid and status=2"; 
		&my_sql;
		}

	if ($column = $sth->fetchrow_hashref){
		&myheader("viewprofile");
		&topmenu("viewprofile");

print qq|

<div class="ha8">
|;

if( $isAdmin )
	{
	print qq|<span class="text1"><font face="Arial" size="2"><b>View Agent/Member Information:</b></font></span>|;
	}
else
	{
	print qq|<span class="text1"><font face="Arial" size="2"><b>View Profile Information:</b></font></span>|;
	}

print qq|
				<br /><br />
<font size="2" face="Arial">|;

if( $isAdmin )
	{
	print qq|<center><a href="$script?cf=members&edit=1&memid=$memid" class="noneunderline"><img src="img/content/edit.png" width="16" height="16" border="0" alt="Edit Agent/Member Information" valign="middle" style="vertical-align: middle;" /></a>&nbsp;&nbsp;<a href="$script?cf=members&edit=1&memid=$memid" class="noneunderline">Edit Agent/Member Information</a>&nbsp;&nbsp;&nbsp;</center><br />|;
	}
else
	{
	print qq|<center><a href="$script?cf=members&edit=1&memid=$memid" class="noneunderline"><img src="img/content/edit.png" width="16" height="16" border="0" alt="Edit Profile Information" valign="middle" style="vertical-align: middle;" /></a>&nbsp;&nbsp;<a href="$script?cf=members&edit=1&memid=$memid" class="noneunderline">Edit Profile Information</a>&nbsp;&nbsp;&nbsp;</center><br />|;
	}


print qq|
<table style="background-color:#FDF3D0; width: 100%" align="left">
		<tr>
			<td style="width: 200px">Username:</td>
			<td style="width: 800px" colspan="4"><b>$column->{'username'}</b></td>
		</tr>
		<tr>
			<td style="width: 200px">Password:</td>
			<td style="width: 800px" colspan="4">$column->{'password'}</td>
		</tr>
		<tr>
			<td style="width: 200px">Name:</td>
			<td style="width: 800px" colspan="4">$column->{'sal'} $column->{'fname'} $column->{'lname'}</td>
		</tr>
		<tr>
			<td style="width: 200px">Company:</td>
			<td style="width: 800px" colspan="4">$column->{'company'}</td>
		</tr>
		<tr>
			<td style="width: 200px">Land Phone:</td>
			<td style="width: 800px" colspan="4">+$column->{'tel1'}($column->{'tel2'})$column->{'tel3'}</td>
		</tr>
		<tr>
			<td style="width: 200px">Cell Phone:</td>
			<td style="width: 800px" colspan="4">+$column->{'mob1'}($column->{'mob2'})$column->{'mob3'}</td>
		</tr>
		<tr>
			<td style="width: 200px">Fax:</td>
			<td style="width: 800px" colspan="4">+$column->{'fax1'}($column->{'fax2'})$column->{'fax3'}</td>
		</tr>
		<tr>
			<td style="width: 200px">Address:</td>
			<td style="width: 800px" colspan="4">$column->{'address'}</td>
		</tr>
		<tr>
			<td style="width: 200px">Post Code:</td>
			<td style="width: 800px" colspan="4">$column->{'postcode'}</td>
		</tr>
		<tr>
			<td style="width: 200px">Country:</td>
			<td style="width: 800px" colspan="4">|;
			
			print get_country($column->{'country'});
			
			print qq|</td>
		</tr>
		<tr>
			<td style="width: 200px">City:</td>
			<td style="width: 800px" colspan="4">$column->{'city'}</td>
		</tr>
		<tr>
			<td style="width: 200px">Email:</td>
			<td style="width: 800px" colspan="4"><a href="mailto:$column->{'email'}">$column->{'email'}</a></td>
		</tr>
		<tr>
			<td style="width: 200px">Website:</td>
			<td style="width: 800px" colspan="4"><a href="$column->{'website'}" target=_BLANK>$column->{'website'}</a></td>
		</tr>
		<tr>
			<td style="width: 200px">Registration Date:</td>
			<td style="width: 800px" colspan="4">$column->{'regdate'}</td>
		</tr>
		<tr>
			<td style="width: 200px">Activation Date:</td>
			<td style="width: 800px" colspan="4">$column->{'activedate'}</td>
		</tr>
		<tr>
			<td style="width: 200px">Expiration Date:</td>
			<td style="width: 800px" colspan="4">$column->{'enddate'}</td>
		</tr>
		<tr>
			<td style="width: 200px">Status:</td>
			<td style="width: 800px" colspan="4">|;
			
			if( $column->{'status'} == 1 )
				{
				print qq|<font color="#FF0000">Registered</font>|;
				
				if( $isAdmin )
					{
					print qq|&nbsp;&nbsp;
					<a href="$script?cf=members&activate=1&memid=$memid">Activate as International Agent</a>&nbsp;&nbsp;
					<a href="$script?cf=members&activate=2&memid=$memid">Activate as Local Retail Agent</a>&nbsp;&nbsp;
					<a href="$script?cf=members&activate=3&memid=$memid">Activate as Member</a>&nbsp;&nbsp;
					<a href="$script?cf=members&terminate=1&memid=$memid">Terminate</a>
					|;
					}
				}
			elsif( $column->{'status'} == 2 )
				{
				print qq|Activated as |;
				
				if( $column->{'type'} == 1 )
					{
					print "International Agent";
					}
				if( $column->{'type'} == 2 )
					{
					print "Local Retail Agent";
					}
				if( $column->{'type'} == 3 )
					{
					print "Member";
					}
				elsif( $column->{'type'} == 9 )
					{
					print "Administrator";
					}
				
				if( $isAdmin && $column->{'type'} != 9 )
					{
					print qq|&nbsp;&nbsp;
					<a href="$scripturl?cf=members&suspend=1&memid=$memid">Suspend</a>
					|;
					}
				}
			elsif( $column->{'status'} == 3 )
				{
				print qq|<font color="#FF0000">Suspended</font>|;
				
				if( $isAdmin )
					{
					print qq|&nbsp;&nbsp;
					<a href="$script?cf=members&activate=$column->{'type'}&memid=$memid">Re-Activate</a>&nbsp;&nbsp;
					|;
					if( $column->{'type'} != 9 )
						{
						print qq|
						<a href="$script?cf=members&terminate=1&memid=$memid">Terminate</a>
						|;
						}
					}
				}
			elsif( $column->{'status'} == 4 )
				{
				print qq|<font color="#666666">Terminated</font>|;
				
				if( $isAdmin )
					{
					print qq|&nbsp;&nbsp;
					<a href="$script?cf=members&activate=1&memid=$memid">Re-activate as International Agent</a>&nbsp;&nbsp;
					<a href="$script?cf=members&activate=2&memid=$memid">Re-activate as Local Retail Agent</a>&nbsp;&nbsp;
					<a href="$script?cf=members&activate=3&memid=$memid">Re-activate as Member</a>&nbsp;&nbsp;
					|;
					}					
				}
			print qq|</td>
		</tr>
		<tr>
			<td style="width: 200px">Type:</td>
			<td style="width: 800px" colspan="4">|;
			
			if( $column->{'type'} == 1 )
				{
				print "International Agent";
				}
			if( $column->{'type'} == 2 )
				{
				print "Local Retail Agent";
				}
			if( $column->{'type'} == 3 )
				{
				print "Member";
				}
			elsif( $column->{'type'} == 9 )
				{
				print "Administrator";
				}
				
			
			print qq|</td>
		</tr>|;
		
		print qq|
		<tr>
			<td style="width: 200px">Last Login:</td>
			<td style="width: 800px" colspan="4">$column->{'lastvisit'}</td>
		</tr>
		|;
		
		if( $isAdmin )
			{
			print qq|
				<tr>
					<td style="width: 200px">Registred IP:</td>
					<td style="width: 800px" colspan="4">$column->{'ip'}<br /><br /></td>
				</tr>
			|;
			}
			
		print qq|
		<tr style="background-color:#FFCC99;">
			<td colspan="5"><center><b>Agent/Member Account Properties</b></center></td>
		</tr>
		<tr>
			<td style="width: 200px">&nbsp</td>
			<td colspan="4">&nbsp;</td>
		</tr>
		<tr>
			<td style="width: 200px">Agent Credit</td>
			<td colspan="4"><b>|;
			
			if( $credit > 0 )
				{
				print qq|<span style="padding:2px; border-style: solid; border-width:1px; border-color:#969696;">|;
				}
			else
				{
				print "<font color=\"RED\"><span style=\"padding:2px; border-style: solid; border-width:1px; border-color:#FF0000;\">" ;
				}

			print "£&nbsp;$credit";
			
			print "</font>" if($credit <= 0 );
			
			print qq|</span></b>&nbsp;&nbsp;&nbsp;<a href="$scripturl?cf=members&credit=1&memid=$memid" target=_BLANK>Show Details</a></td>
		</tr>
		<tr>
			<td style="width: 200px">Custom Entry Charge:</td>
			<td style="width: 200px"><i>For LV:</i>&nbsp;|;

			print "£" if($column->{'ceclv'} ne "");
			
			print qq|&nbsp;$column->{'ceclv'}</td><td style="width: 200px"><i>For HV:</i>&nbsp;|;

			print "£" if($column->{'cechv'} ne "");
			
			print qq|&nbsp;$column->{'cechv'}</td><td style="width: 200px"><i>For MHV:</i>&nbsp;|;

			print "£" if($column->{'cecmhv'} ne "");
			
			print qq|&nbsp;$column->{'cecmhv'}</td><td style="width: 200px"><i>For Personal Effects:</i>&nbsp;|;

			print "£" if($column->{'cecpe'} ne "");
			
			print qq|&nbsp;$column->{'cecpe'}</td>
		</tr>
		<tr>
			<td style="width: 200px">Airline Handling Charge:</td>
			<td style="width: 200px"><i>Min. Weight:</i>&nbsp;&nbsp;&nbsp;&nbsp;$column->{'ahcminkg'}&nbsp;|;

			print "<small>Kgs</small>" if($column->{'ahcminkg'} ne "");
			
			print qq|</td><td style="width: 200px"><i>Min. Charge:</i>&nbsp;|;

			print "£" if($column->{'ahccharge'} ne "");
			
			print qq|&nbsp;$column->{'ahccharge'}</td><td colspan="2"><i>Per Kg Charge:</i>&nbsp;|;
			
			print "£" if($column->{'ahcperkg'} ne "");
			
			print qq|&nbsp;$column->{'ahcperkg'}</td>
		</tr>
		<tr>
			<td style="width: 200px">FAS Account Service Charge:</td>
			<td $cspan>|;

			print "£" if($column->{'fas'} ne "");
			
			print qq|&nbsp;$column->{'fas'}</td>
		</tr>
		<tr>
			<td style="width: 200px">Airport Collection Charge:</td>
			<td $cspan>|;
			
			print "£" if($column->{'aircol'} ne "");
			
			print qq|&nbsp;$column->{'aircol'}</td>
		</tr>
		|;

			if( $isAdmin )
				{
				print qq|
				<tr>
					<td style="width: 200px">EPX Cash Back:</td>
					<td colspan="4">|;
					
				if( $column->{'epxcb'} )
					{
					print qq|Enabled&nbsp;&nbsp;&nbsp;<a href="$script?cf=members&epxcbenable=2&memid=$memid">Disable</a>|;
					}
				else
					{
					print "Disabled";
					if( $column->{'epxcb'} eq "0" )
						{
						print qq|&nbsp;&nbsp;&nbsp;<a href="javascript: cbEnable($column->{'cashbackcount'}, $memid);">Enable</a>|;
						}
					}

				print qq|</td>
				</tr>|;
				
			if( $column->{'epxcb'} eq "1" )
				{
			print qq|
				<tr style="background-color:#FFCC99;">
					<td colspan="5">
					<center><b>EPX Cash Back</b></center></td>
				</tr>
				<tr>
					<td colspan="5">&nbsp</td>
				</tr>
				<tr>
					<td>
					<b>LOW VALUE RULES</b>&nbsp;&nbsp;
					</td>
					<td colspan="4">
					<hr width="100%" size="1" noshade>
					</td>
				</tr>
				<tr>
					<td colspan="5">
					|;
		
					$SQL2 = "SELECT * FROM cashback WHERE userid = $memid AND lvmv = 'l' order by cbid"; 
					&my_sql2;
					my $ri = 0;
					while( $column2 = $sth2->fetchrow_hashref )
						{
						$ri++;
						if( $ri < 10 )
							{
							print qq|<div style="vertical-align: top;">Rule.&nbsp;&nbsp;&nbsp;$ri:&nbsp;|;
							}
						else
							{
							print qq|<div style="vertical-align: top;">Rule.&nbsp;$ri:&nbsp;|;
							}
						print qq|From&nbsp;$column2->{'fromkg'}<FONT SIZE=-2>&nbsp;kg&nbsp;&nbsp;&nbsp;&nbsp;</FONT>|;
						print qq|up to&nbsp;$column2->{'tokg'}<FONT SIZE=-2>&nbsp;kg&nbsp;&nbsp;&nbsp;&nbsp;</FONT>|;
						print qq|%&nbsp;$column2->{'pervalue'}&nbsp;of Value of Goods&nbsp;+&nbsp;|;
						print qq|£&nbsp;$column2->{'fixcharge'}&nbsp;+&nbsp;|;
						print qq|%&nbsp;$column2->{'cardcharge'}&nbsp;(Card Service Charge);&nbsp;&nbsp;|;
						print qq|We will pay credit to yout £&nbsp;$column2->{'agentshare'}|;
						print qq|&nbsp;&nbsp;after&nbsp;$column2->{'cbafter'}&nbsp;items.|;
						print "</div>";
						}
					$sth2->finish;
					print qq|
					</td>
				</tr>
				<tr>
					<td>
					<b>MH VALUE RULES</b>&nbsp;&nbsp;&nbsp;&nbsp;<small>&nbsp;<small></td>
					<td colspan="4">
					<hr width="100%" size="1" noshade>
					</td>
				</tr>
				<tr>
					<td colspan="5">
					|;
		
					$SQL2 = "SELECT * FROM cashback WHERE userid = $memid AND lvmv = 'm' order by cbid"; 
					&my_sql2;
					$ri = 0;
					while( $column2 = $sth2->fetchrow_hashref )
						{
						$ri++;
						if( $ri < 10 )
							{
							print qq|<div style="vertical-align: top;">Rule.&nbsp;&nbsp;&nbsp;$ri:&nbsp;|;
							}
						else
							{
							print qq|<div style="vertical-align: top;">Rule.&nbsp;$ri:&nbsp;|;
							}
						print qq|From&nbsp;$column2->{'fromkg'}<FONT SIZE=-2>&nbsp;kg&nbsp;&nbsp;&nbsp;&nbsp;</FONT>|;
						print qq|up to&nbsp;$column2->{'tokg'}<FONT SIZE=-2>&nbsp;kg&nbsp;&nbsp;&nbsp;&nbsp;</FONT>|;
						print qq|%&nbsp;$column2->{'pervalue'}&nbsp;of Value of Goods&nbsp;+&nbsp;|;
						print qq|£&nbsp;$column2->{'fixcharge'}&nbsp;+&nbsp;|;
						print qq|%&nbsp;$column2->{'cardcharge'}&nbsp;(Card Service Charge);&nbsp;&nbsp;|;
						print qq|We will pay credit to you £&nbsp;$column2->{'agentshare'}|;
						print qq|&nbsp;&nbsp;after&nbsp;$column2->{'cbafter'}&nbsp;items.|;
						print "</div>";
						}
					$sth2->finish;
					print qq|
					</td>
				</tr>
				|;	
				}
				print qq|

				<tr>
					<td colspan="5">
					<br />
					<a href="$script?cf=price&userprice=$memid"><img alt="Edit Prices" style="vertical-align: middle;" src="img/content/prices.gif" width="26" height="26" border = "0"></a>
					&nbsp;<a href="$script?cf=price&userprice=$memid" class="underline link2">Edit Prices for this Agent/Member</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<a href="$script?cf=price&assign=1&userprice=$memid" onclick="javascript:return confirm('This will delete the cuurent prices that alread assigned to this user.\\n\\nAre you sure you want to delete the current prices for agent/member $column->{'username'}\\nand reassign the Global Prices to his/her account again?')"><img alt="Reassign Prices" style="vertical-align: middle;" src="img/content/prices2.gif" width="26" height="26" border = "0"></a>
					&nbsp;<a href="$script?cf=price&assign=1&userprice=$memid" onclick="javascript:return confirm('This will delete the current prices that alread assigned to this user.\\n\\nAre you sure you want to delete the current prices for agent/member $column->{'username'}\\nand reassign the Global Prices to his/her account again?')" class="underline link2">Reassign Prices for this Agent/Member</a>
					<br /><br /><br />
					</td>
				</tr>
			|;
			}
		else
			{
			if( $column->{'epxcb'} eq "1" )
				{
			print qq|
				<tr style="background-color:#FFCC99;">
					<td colspan="5">
					<center><b>EPX Cash Back</b></center></td>
				</tr>
				<tr>
					<td colspan="5">&nbsp</td>
				</tr>
				<tr>
					<td>
					<b>LOW VALUE RULES</b>&nbsp;&nbsp;
					</td>
					<td>
					<hr width="100%" size="1" noshade>
					</td>
				</tr>
				<tr>
					<td colspan="5">
					|;
		
					$SQL2 = "SELECT * FROM cashback WHERE userid = $memid AND lvmv = 'l' order by cbid"; 
					&my_sql2;
					my $ri = 0;
					while( $column2 = $sth2->fetchrow_hashref )
						{
						$ri++;
						if( $ri < 10 )
							{
							print qq|<div style="vertical-align: top;">Rule.&nbsp;&nbsp;&nbsp;$ri:&nbsp;|;
							}
						else
							{
							print qq|<div style="vertical-align: top;">Rule.&nbsp;$ri:&nbsp;|;
							}
						print qq|From&nbsp;$column2->{'fromkg'}<FONT SIZE=-2>&nbsp;kg&nbsp;&nbsp;&nbsp;&nbsp;</FONT>|;
						print qq|up to&nbsp;$column2->{'tokg'}<FONT SIZE=-2>&nbsp;kg&nbsp;&nbsp;&nbsp;&nbsp;</FONT>|;
						print qq|%&nbsp;$column2->{'pervalue'}&nbsp;of Value of Goods&nbsp;+&nbsp;|;
						print qq|£&nbsp;$column2->{'fixcharge'}&nbsp;+&nbsp;|;
						print qq|%&nbsp;$column2->{'cardcharge'}&nbsp;(Card Service Charge);&nbsp;&nbsp;|;
						print qq|We will pay credit to yout £&nbsp;$column2->{'agentshare'}|;
						print qq|&nbsp;&nbsp;after&nbsp;$column2->{'cbafter'}&nbsp;items.|;
						print "</div>";
						}
					$sth2->finish;
					print qq|
					</td>
				</tr>
				<tr>
					<td>
					<b>MH VALUE RULES</b>&nbsp;&nbsp;&nbsp;&nbsp;<small>&nbsp;<small></td>
					<td>
					<hr width="100%" size="1" noshade>
					</td>
				</tr>
				<tr>
					<td colspan="5">
					|;
		
					$SQL2 = "SELECT * FROM cashback WHERE userid = $memid AND lvmv = 'm' order by cbid"; 
					&my_sql2;
					$ri = 0;
					while( $column2 = $sth2->fetchrow_hashref )
						{
						$ri++;
						if( $ri < 10 )
							{
							print qq|<div style="vertical-align: top;">Rule.&nbsp;&nbsp;&nbsp;$ri:&nbsp;|;
							}
						else
							{
							print qq|<div style="vertical-align: top;">Rule.&nbsp;$ri:&nbsp;|;
							}
						print qq|From&nbsp;$column2->{'fromkg'}<FONT SIZE=-2>&nbsp;kg&nbsp;&nbsp;&nbsp;&nbsp;</FONT>|;
						print qq|up to&nbsp;$column2->{'tokg'}<FONT SIZE=-2>&nbsp;kg&nbsp;&nbsp;&nbsp;&nbsp;</FONT>|;
						print qq|%&nbsp;$column2->{'pervalue'}&nbsp;of Value of Goods&nbsp;+&nbsp;|;
						print qq|£&nbsp;$column2->{'fixcharge'}&nbsp;+&nbsp;|;
						print qq|%&nbsp;$column2->{'cardcharge'}&nbsp;(Card Service Charge);&nbsp;&nbsp;|;
						print qq|We will pay credit to you £&nbsp;$column2->{'agentshare'}|;
						print qq|&nbsp;&nbsp;after&nbsp;$column2->{'cbafter'}&nbsp;items.|;
						print "</div>";
						}
					$sth2->finish;
					print qq|
					<br />
					</td>
				</tr>
				|;	
				}
			}

	print qq|		
	</table>
</font>
</div>
|;

&footer;

		$sth->finish;
	}
	else
		{
			$sth->finish;
			error_page("Agent/Member not found!");
		}
}


sub credit{
	unless( $isAdmin  || $isUser == $memid ) { error_page("Agent/Member not found!"); exit;}

	$SQL = "SELECT accounts.*, username from accounts LEFT JOIN members ON accounts.userid=members.userid where accounts.userid=$memid order by accid"; 
	&my_sql;

	&myheader("viewprofile");
	&topmenu("viewprofile");

	print qq|
	<div class="ha8">
	|;

	if( $isAdmin )
		{
		print qq|<span class="text1"><font face="Arial" size="2"><b>View Agent/Member Account Information:</b></font></span>|;
		}
	else
		{
		print qq|<span class="text1"><font face="Arial" size="2"><b>View Account Information:</b></font></span>|;
		}

	print qq|<font size="2" face="Arial">|;

	if ($column = $sth->fetchrow_hashref)
		{
		print qq|
				<br /><br /<center><b>Username: $column->{'username'}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;User ID:	$memid|;

		print qq|
		</b></center><br />
		<table style="background-color:#FDF3D0; width: 100%" align="left" border="1" cellspacing="0" cellpadding="3">
			<tr>
			<th style="width: 150px">Date/Time</th>
			<th style="width: 190px">Type</th>
			<th style="width: 150px">Reference</th>
			<th style="width: 240px">Description</th>
			<th style="width: 80px">Income <small>(£)</small></th>
			<th style="width: 80px">Expence <small>(£)</small></th>
			<th style="width: 80px">Total <small>(£)</small></th>
			</tr>
			|;
		
			$tot_credit = 0;
		while ($column)
			{
			print qq|
			<tr>
			<td>$column->{'adate'}</td>
			<td>|;
			
			if( $column->{'atype'} eq 'C' )
				{
				print 'Cash Back';
				}
			if( $column->{'atype'} eq 'D' )
				{
				if( $column->{'amount'} > 0 )
					{
					print 'Direct Credit';
					}
				else
					{
					print 'Direct Expence';
					}
				}
			if( $column->{'atype'} eq 'L' )
				{
				print 'Custom Entry Charge for LV';
				}
			if( $column->{'atype'} eq 'H' )
				{
				print 'Custom Entry Charge for HV';
				}
			if( $column->{'atype'} eq 'M' )
				{
				print 'Custom Entry Charge for MHV';
				}
			if( $column->{'atype'} eq 'P' )
				{
				print 'Custom Entry Charge for PE';
				}
			if( $column->{'atype'} eq 'A' )
				{
				print 'Airline Handling Charge';
				}
			if( $column->{'atype'} eq 'F' )
				{
				print 'FAS Account Service Charge';
				}
			if( $column->{'atype'} eq 'O' )
				{
				print 'Airport Collection Charge';
				}
			print qq|</td>
			<td>|;
			
			if( $column->{'aref'} )
				{
				print "Entry Ref.: $column->{'aref'} ";
				}
			if( $column->{'asubref'} )
				{
				print "SR# $column->{'asubref'} ";
				}
			if( $column->{'asubrefstr'} )
				{
				print "$column->{'aref'}";
				}
			print "&nbsp;";
			
			print qq|
			</td>
			<td>$column->{'adesc'}</td>
			|;
			
			if( $column->{'amount'} > 0 )
				{
				print "<td>$column->{'amount'}</td><td>&nbsp;</td>";
				}
			else
				{
				print "<td>&nbsp;</td><td>" . (-1 * $column->{'amount'}) . "</td>";
				}

			$tot_credit = $tot_credit + $column->{'amount'};
		
			print "<td>$tot_credit</td></tr>";
			$column = $sth->fetchrow_hashref;
			}	
			print qq|<tr>
			<td colspan="6"><span style="float: right;"><b>Total Credit:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></div></td>
			<td>|;

			print "<font color=\"RED\">" if($tot_credit <= 0 );
			print "<b>£&nbsp;$tot_credit</b>";
			print "</font>" if($tot_credit <= 0 );
			
			print "</td></tr></table><br /><br />";
		}
	else
		{
		print "<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><center>There is no accounting information</center><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />";
		}		

	$sth->finish;
	print qq|		
</font>
</div>
|;

&footer;

}


sub viewall{

unless( $isAdmin ) {&error_page("You don't have enough permission for this operation."); exit;}

$SQL = "SELECT * FROM members ORDER BY username";
&my_sql;

$i = 0;

while ($column = $sth->fetchrow_hashref)
	{
	unless( $i )
		{
		&myheader("viewmembers");
		&topmenu("viewmembers");

		print qq|
		<div class="ha8">
			<font size="2" face="Arial">
			<span class="text1"><font face="Arial" size="2"><b>List of Agents/Members:</b></font></span>
			<br /><br />
				<table style="width: 100%" align="left" border="1" cellpadding="2" cellspacing="0">
					<tr>
					<th width="140" align="left">Username</th>
					<th width="90" align="left">Password</th>
					<th width="130" align="left">Phone</th>
					<th width="170" align="left">Email</th>
					<th width="130" align="left">Country</th>
					<th width="130" align="left">City</th>
					<th width="90" align="left">Type</th>
					<th width="100" align="left">Status</th>
					<th width="20" align="center">Action</th>
					</tr>
					|;
		}

print qq|
	<tr>
	<td align="left"><font color="#969696"><a href="$script?cf=members&view=1&memid=$column->{'userid'}">$column->{'username'}</font></td>
	<td align="left"><font color="#969696">$column->{'password'}</td>
	<td align="left"><font color="#969696">+$column->{'tel1'}($column->{'tel2'})$column->{'tel3'}</font></td>
	<td align="left"><font color="#969696"><a href="mailto:$column->{'email'}">$column->{'email'}</a></font></td>
	<td align="left"><font color="#969696">|;
	
	print get_country($column->{'country'});
	
	print qq|</td>
	<td align="left"><font color="#969696">$column->{'city'}</td>
	<td align="left">
	|;

		if( $column->{'type'} == 1 )
			{
			print qq|International Agent|;
			}
		elsif( $column->{'type'} == 2 )
			{
			print qq|Local Retail Agent|;
			}
		elsif( $column->{'type'} == 3 )
			{
			print qq|Member|;
			}
		elsif( $column->{'type'} == 9 )
			{
			print qq|<font color="#FF0000">Administrator</font>|;
			}
	
	$rowentid = $column->{'userid'};

	print qq|
	</td>
	<td align="left">
	|;

		if( $column->{'status'} == 1 )
			{
			print qq|<font color="#969696">Registered</font>|;
			}
		elsif( $column->{'status'} == 2 )
			{
			print qq|<font color="#969696">Activated</font>|;
			}
		elsif( $column->{'status'} == 3 )
			{
			print qq|<font color="#FF0000">Suspended</font>|;
			}
		elsif( $column->{'status'} == 4 )
			{
			print qq|<font color="#666666">Terminated</font>|;
			}
	
	$rowentid = $column->{'userid'};

	print qq|
	</td>
	<td align="center">
	<center><a href="$script?cf=members&edit=1&fromlist=1&memid=$rowentid" class="noneunderline"><img src="img/content/edit.png" width="16" height="16" border="0" alt="Edit Agent/Member Information" valign="middle" style="vertical-align: middle;" /></a></center>	
	</td>
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
		&myheader("viewmembers");
		&topmenu("viewmembers");

		print qq|
			<div class="ha8"><font size="2">
			There is not any Agents/Members to display.
			</font></div>
			|;

		&footer;
	}

}


sub lostpassword{
&myheader("lostpass");

&topmenu("lostpass");

print qq|

<div class="ha8">
	<form name="form" method="POST" action="$script">
<font size="2" face="Arial">
	<table style="width: 100%" align="left">
		<tr>
			<td colspan="2" style="width: 600px">
			Please enter your username or password and press Submit button. 
			Your password will be sent to your registered email.<br /><br />
			</td>
		</tr>
		<tr>
			<td style="width: 120px">Username:</td>
			<td style="width: 480px"><input name="username" type="text" size="20" /></td>
		</tr>
		<tr>
			<td style="width: 120px">Email:</td>
			<td style="width: 480px"><input name="email" type="text" size="47" /></td>
		</tr>
		<tr>
			<td style="width: 600px" colspan="2" align="center">
			<center><br />
			<input type="submit" value="Submit" size="20" />&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" value="Reset" size="20" />
			</center>
			</td>
		</tr>
	</table>
	<input name="sendpass" type="hidden" value="1" />
	<input name="cf" type="hidden" value="members" />
	<br />
	<br />
</font>
	</form>
</div>

|;

&footer;
}

sub sendpassword{
	unless ($username || $email) {&error_page("You must specify either your Username or your Email Address to retrieve your password."); exit;} 
	if ($username && $email) {&error_page("You can not specify both your Username and your Email Address. Please go back and specify only one of them."); exit;} 

	$SQL = "SELECT userid, username, sal, fname, lname, password, email FROM members WHERE (username = '$username' or email='$email') and status = 2"; 
	&my_sql;
	$fg_userid = 0;
	if ($column = $sth->fetchrow_hashref){
		$fg_userid = $column->{'userid'};
		$fg_username = $column->{'username'};
		$fg_name = $column->{'sal'} . ' ' . $column->{'fname'} . ' ' . $column->{'lname'};
		$fg_pass = $column->{'password'};
		$fg_email = $column->{'email'};
	}
	$sth->finish;

	if( $fg_userid != 0 ) {
		&SendEmail($fg_email, $adminemail, "Password reminder from $Domain", "<p>Dear $fg_name,<br><br>Your username and password is as follows:<br><br>Username: $fg_username<br>Password: $fg_pass<br><br>$Domain<br>$adminname</p>");

		$redirect="$script?cf=sentpass";
		print $form->redirect(-url=>$redirect);
		}
	else
		{
		error_page("No record was found for the specified username or email!");
		}
}


sub epxcbenable{
	my $epxval = shift;
	unless ($memid) {&error_page("Not valid agent/member ID!"); exit;} 

	if( $epxval eq "1" )
		{
		$SQL = "UPDATE members SET epxcb=1 where userid=$memid";
		}
	else
		{
		$SQL = "UPDATE members SET epxcb=0 where userid=$memid";
		}
	&my_sql;
	$sth->finish;

	$redirect="$script?cf=members&view=1&memid=$memid";
	print $form->redirect(-url=>$redirect);
}


sub activate{
	my $acstat = shift;
	unless ($memid) {&error_page("Not valid user ID!"); exit;} 

	$SQL = "SELECT userid, username, sal, fname, lname, password, email FROM members WHERE userid = $memid"; 
	&my_sql;
	if ($column = $sth->fetchrow_hashref){
		$fg_username = $column->{'username'};
		$fg_name = $column->{'sal'} . ' ' . $column->{'fname'} . ' ' . $column->{'lname'};
		$fg_pass = $column->{'password'};
		$fg_email = $column->{'email'};
		$sth->finish;
	
		$SQL = "UPDATE members set type=$acstat, status=2 where userid=$memid";
		&my_sql;
		$sth->finish;
		
		&SendEmail($fg_email, $adminemail, "Your account has been activated", "<p>Dear $fg_name,<br><br>Your account has activated. Your login information is as follows:<br><br>URL: <a href=\"$DomainURL\">$DomainURL</a><br>Username: $fg_username<br>Password: $fg_pass<br><br>$Domain<br>$adminname</p>");

		$redirect="$script?cf=members&view=1&memid=$memid";
		print $form->redirect(-url=>$redirect);
	}
	else
		{
		$sth->finish;
		&error_page("User ID $memid does not exist!"); exit;
		}
}

sub suspend{
	unless ($memid) {&error_page("Not valid user ID!"); exit;} 

	$SQL = "SELECT userid, username, sal, fname, lname, password, email FROM members WHERE userid = $memid"; 
	&my_sql;
	if ($column = $sth->fetchrow_hashref){
		$fg_username = $column->{'username'};
		$fg_name = $column->{'sal'} . ' ' . $column->{'fname'} . ' ' . $column->{'lname'};
		$fg_pass = $column->{'password'};
		$fg_email = $column->{'email'};
		$sth->finish;
	
		$SQL = "UPDATE members set status=3 where userid=$memid";
		&my_sql;
		$sth->finish;

		&SendEmail($fg_email, $adminemail, "Your account has been suspended", "<p>Dear $fg_name,<br><br>Your account has been suspended. For further information you may contact the administrator by sending an email to <a href=\"mailto:$myemail\">$myemail</a><br><br>$Domain<br>$salesman</p>");

		$redirect="$script?cf=members&view=1&memid=$memid";
		print $form->redirect(-url=>$redirect);
	}
	else
		{
		$sth->finish;
		&error_page("User ID $memid does not exist!"); exit;
		}
}


sub terminate{
	unless ($memid) {&error_page("Not valid user ID!"); exit;} 

	$SQL = "SELECT userid, username, sal, fname, lname, password, email FROM members WHERE userid = $memid"; 
	&my_sql;
	if ($column = $sth->fetchrow_hashref){
		$fg_username = $column->{'username'};
		$fg_name = $column->{'sal'} . ' ' . $column->{'fname'} . ' ' . $column->{'lname'};
		$fg_pass = $column->{'password'};
		$fg_email = $column->{'email'};
		$sth->finish;
	
		$SQL = "UPDATE members set status=4 where userid=$memid";
		&my_sql;
		$sth->finish;

		&SendEmail($fg_email, $adminemail, "Your account has been terminated", "<p>Dear $fg_name,<br><br>Your account has been terminated. For further information you may contact the administrator by sending an email to <a href=\"mailto:$myemail\">$myemail</a><br><br>$Domain<br>$salesman</p>");

		$redirect="$script?cf=members&view=1&memid=$memid";
		print $form->redirect(-url=>$redirect);
	}
	else
		{
		$sth->finish;
		&error_page("User ID $memid does not exist!"); exit;
		}
}

1;