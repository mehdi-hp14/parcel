
########################################################
# Copyright (c) QuickPayPro, LLC - www.QuickPayPro.com #
########################################################

#use CGI qw (:standard);

#my $timestamp = scalar(localtime());
#$time = time();
#$form = new CGI;

$heading="settings";

############################################
sub home{
	my $msg = shift;
	
		unless( $isAdmin ) {&error_page("You don't have enough permission for this operation."); exit;}

unless( $msg )
	{
	&se_setup;
	}
	
&myheader($heading);
&topmenu($heading);


print qq|<div class="ha8"><h1><font color="#000080" size="1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Global Settings</font></h1>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Please set the following items. These values are used as default values<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;whenever it's not specified a distict value for them.<br /><br />
|;

if( $msg )
	{
	print qq|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#FF0000"><b>* $msg</b></font><br /><br />|;
	}

print qq|
<font size="2" face="Arial">
	<form name="form" method="POST" onSubmit="return formcheck(this)" action="$script">
	<input name="nosettings" type="hidden" value="1" />
	<input name="edit" type="hidden" value="1" />
	<input name="cf" type="hidden" value="settings" />
	<table style="width: 100%" align="left">
		<tr>
			<td style="width: 300px">Global Profit: </td>
			<td style="width: 700px">&nbsp;&nbsp;&nbsp;&nbsp;<input name="s_profit" type="text" size="5" value="$s_profit" style="height:18px;" />&nbsp;%</td>
		</tr>
		<tr>
			<td style="width: 300px">Fuel Extra Surecharge: </td>
			<td style="width: 700px">&nbsp;&nbsp;&nbsp;&nbsp;<input name="s_fuelextra" type="text" size="5" value="$s_fuelextra" style="height:18px;" />&nbsp;%</td>
		</tr>
		<tr>
			<td style="width: 300px">VAT description: </td>
			<td style="width: 700px">&nbsp;&nbsp;&nbsp;&nbsp;<input name="s_vattext" type="text" size="120" value="$s_vattext" style="height:18px;" /></td>
		</tr>
		<tr>
			<td style="width: 300px">Fuel surchare description: </td>
			<td style="width: 700px">&nbsp;&nbsp;&nbsp;&nbsp;<input name="s_fueltext" type="text" size="120" value="$s_fueltext" style="height:18px;" /></td>
		</tr>
		<tr>
			<td style="width: 300px">War Fee charge description: </td>
			<td style="width: 700px">&nbsp;&nbsp;&nbsp;&nbsp;<input name="s_wartext" type="text" size="120" value="$s_wartext" style="height:18px;" /></td>
		</tr>
		<tr>
			<td style="width: 300px">Duitable Countries charge description: </td>
			<td style="width: 700px">&nbsp;&nbsp;&nbsp;&nbsp;<input name="s_duttext" type="text" size="120" value="$s_duttext" style="height:18px;" /></td>
		</tr>
		<tr>
			<td style="width: 300px">Remote extra charge description: </td>
			<td style="width: 700px">&nbsp;&nbsp;&nbsp;&nbsp;<input name="s_remotetext" type="text" size="120" value="$s_remotetext" style="height:18px;" /></td>
		</tr>
		<tr>
			<td style="width: 300px">Saturday delivery extra charge description: </td>
			<td style="width: 700px">&nbsp;&nbsp;&nbsp;&nbsp;<input name="s_satdelexttext" type="text" size="120" value="$s_satdelexttext" style="height:18px;" /></td>
		</tr>
		<tr>
			<td style="width: 300px">Saturday collection extra charge description: </td>
			<td style="width: 700px">&nbsp;&nbsp;&nbsp;&nbsp;<input name="s_satcolexttext" type="text" size="120" value="$s_satcolexttext" style="height:18px;" /></td>
		</tr>
		<tr>
			<td style="width: 300px">Booking extra charge description: </td>
			<td style="width: 700px">&nbsp;&nbsp;&nbsp;&nbsp;<input name="s_booktext" type="text" size="120" value="$s_booktext" style="height:18px;" /></td>
		</tr>
		<tr>
			<td style="width: 300px">Customs charge description: </td>
			<td style="width: 700px">&nbsp;&nbsp;&nbsp;&nbsp;<input name="s_custtext" type="text" size="120" value="$s_custtext" style="height:18px;" /></td>
		</tr>
		<tr>
			<td style="width: 300px">Invoice description: </td>
			<td style="width: 700px">&nbsp;&nbsp;&nbsp;&nbsp;<input name="s_invtext" type="text" size="120" value="$s_invtext" style="height:18px;" /></td>
		</tr>
		<tr>
			<td style="width: 300px">VAT No.: </td>
			<td style="width: 700px">&nbsp;&nbsp;&nbsp;&nbsp;<input name="s_vatno" type="text" size="20" value="$s_vatno" style="height:18px;" /></td>
		</tr>
		<tr>
			<td style="width: 300px">USD rate compared to GBP: </td>
			<td style="width: 700px">&nbsp;&nbsp;&nbsp;&nbsp;<input name="s_usd" type="text" size="20" value="$s_usd" style="height:18px;" /></td>
		</tr>
		<tr>
			<td style="width: 300px">EURO rate compared to GBP: </td>
			<td style="width: 700px">&nbsp;&nbsp;&nbsp;&nbsp;<input name="s_euro" type="text" size="20" value="$s_euro" style="height:18px;" /></td>
		</tr>
		<tr>
			<td style="width: 300px">PayPal Surecharge: </td>
			<td style="width: 700px">&nbsp;&nbsp;&nbsp;&nbsp;<input name="s_paypal" type="text" size="5" value="$s_paypal" style="height:18px;" />&nbsp;%</td>
		</tr>

		<tr>
			<td style="width: 1000px" colspan="2" align="center"><center><br /><input type="submit" value="Save Settings" size="20" /></center></td>
		</tr>
	</table>
	&nbsp;
	</form>
</font>
</div>

|;

&footer;
}

################ ADD #######################
sub edit{
unless( $isAdmin ) {&error_page("You don't have enough permission for this operation."); exit;}

unless ($s_profit =~ /^\s*[0-9\.]+\s*$/) {&home("Total Profit value must be numeric."); exit;}
if( $s_profit < 0 || $s_profit > 100 ) {&home("Total Profit value must be between 0 and 100"); exit;}
unless ($s_fuelextra =~ /^\s*[0-9\.]+\s*$/) {&home("Fuel Extra Surecharge value must be numeric."); exit;}
if( $s_fuelextra < 0 || $s_fuelextra > 100 ) {&home("Fuel Extra Surecharge value must be between 0 and 100"); exit;}
unless ($s_vattext) {&home("Please enter a value for VAT description field."); exit;} 
if ($s_vattext =~ m/\"/ || $s_vattext =~ m/\'/ ) {&home("VAT description cannot contain \" or \' characters."); exit;} 
unless ($s_fueltext) {&home("Please enter a value for Fuel surchare description field."); exit;} 
unless ($s_wartext) {&home("Please enter a value for War Fee charge description field."); exit;} 
unless ($s_duttext) {&home("Please enter a value for Duitable Countries charge description field."); exit;} 
unless ($s_remotetext) {&home("Please enter a value for Remote extra charge description field."); exit;} 
if ($s_remotetext =~ m/\"/ || $s_remotetext =~ m/\'/ ) {&home("Remote extra charge description cannot contain \" or \' characters."); exit;} 
unless ($s_satdelexttext) {&home("Please enter a value for Saturday delivery extra charge description field."); exit;} 
if ($s_satdelexttext =~ m/\"/ || $s_satdelexttext =~ m/\'/ ) {&home("Saturday delivery extra charge description cannot contain \" or \' characters."); exit;} 
unless ($s_satcolexttext) {&home("Please enter a value for Saturday collection extra charge description field."); exit;} 
if ($s_satcolexttext =~ m/\"/ || $s_satcolexttext =~ m/\'/ ) {&home("Saturday collection extra charge description cannot contain \" or \' characters."); exit;} 
unless ($s_booktext) {&home("Please enter a value for Booking extra charge description field."); exit;} 
if ($s_booktext =~ m/\"/ || $s_booktext =~ m/\'/ ) {&home("Booking extra charge description cannot contain \" or \' characters."); exit;} 
unless ($s_custtext) {&home("Please enter a value for Customs charge description field."); exit;} 
if ($s_custtext =~ m/\"/ || $s_custtext =~ m/\'/ ) {&home("Customs charge description cannot contain \" or \' characters."); exit;} 
unless ($s_invtext) {&home("Please enter a value for Invoice description field."); exit;} 
if ($s_invtext =~ m/\"/ || $s_invtext =~ m/\'/ ) {&home("Invoice description cannot contain \" or \' characters."); exit;} 
unless ($s_vatno =~ /^\s*[0-9 ]+\s*$/) {&home("Please enter a value for VAT No. field."); exit;} 
unless ($s_usd =~ /^\s*[0-9\.]+\s*$/) {&home("USD rate must be numeric."); exit;}
if( $s_usd <= 0 ) {&home("USD rate must be greater than zero"); exit;}
unless ($s_euro =~ /^\s*[0-9\.]+\s*$/) {&home("EURO rate must be numeric."); exit;}
if( $s_euro <= 0 ) {&home("EURO rate must be greater than zero"); exit;}
unless ($s_paypal =~ /^\s*[0-9\.]+\s*$/) {&home("PayPal Surecharge value must be numeric."); exit;}
if( $s_paypal < 0 || $s_paypal > 100 ) {&home("PayPal Surecharge value must be between 0 and 100"); exit;}

$SQL = "UPDATE settings SET value = '$s_profit' WHERE name = 'profit'";
&my_sql;
$sth->finish;

$SQL = "UPDATE settings SET value = '$s_fuelextra' WHERE name = 'fuelextra'";
&my_sql;
$sth->finish;

$SQL = "UPDATE settings SET value = '$s_vattext' WHERE name = 'vattext'";
&my_sql;
$sth->finish;

$SQL = "UPDATE settings SET value = '$s_fueltext' WHERE name = 'fueltext'";
&my_sql;
$sth->finish;

$SQL = "UPDATE settings SET value = '$s_duttext' WHERE name = 'duttext'";
&my_sql;
$sth->finish;

$SQL = "UPDATE settings SET value = '$s_wartext' WHERE name = 'wartext'";
&my_sql;
$sth->finish;

$SQL = "UPDATE settings SET value = '$s_remotetext' WHERE name = 'remotetext'";
&my_sql;
$sth->finish;

$SQL = "UPDATE settings SET value = '$s_satdelexttext' WHERE name = 'satdelexttext'";
&my_sql;
$sth->finish;

$SQL = "UPDATE settings SET value = '$s_satcolexttext' WHERE name = 'satcolexttext'";
&my_sql;
$sth->finish;

$SQL = "UPDATE settings SET value = '$s_booktext' WHERE name = 'booktext'";
&my_sql;
$sth->finish;

$SQL = "UPDATE settings SET value = '$s_custtext' WHERE name = 'custtext'";
&my_sql;
$sth->finish;

$SQL = "UPDATE settings SET value = '$s_invtext' WHERE name = 'invtext'";
&my_sql;
$sth->finish;

$SQL = "UPDATE settings SET value = '$s_vatno' WHERE name = 'vatno'";
&my_sql;
$sth->finish;

$SQL = "UPDATE settings SET value = '$s_usd' WHERE name = 'usd'";
&my_sql;
$sth->finish;

$SQL = "UPDATE settings SET value = '$s_euro' WHERE name = 'euro'";
&my_sql;
$sth->finish;

$SQL = "UPDATE settings SET value = '$s_paypal' WHERE name = 'paypal'";
&my_sql;
$sth->finish;

$redirect="$script?cf=settingok";
print $form->redirect(-url=>$redirect);
}

1;
