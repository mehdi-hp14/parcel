$heading="order";

use CGI;
use LWP::UserAgent;
use CGI qw/:standard/;
use CGI qw(param);
use CGI::Cookie;
use HTTP::Cookies;

sub home{
}

sub order1{

&myheader($heading);

&topmenu($heading);

$id_source = "UK";

print qq|<div class="ha2"><h1><font color="#000080" size="1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;New Order</font></h1>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Please enter the following information in order to create a new order<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Each additional delivery address will need to be booked separately.<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Failure to enter the correct data will result in surcharges<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;being billed for you and will delay delivery of your parcel.<br /><br />
 	 
<font size="2" face="Arial">
	<form name="frm" method="POST" onsubmit="return validateForm(this);" action="$script">
	<input name="order" type="hidden" value="2" />
	<input name="cf" type="hidden" value="order" />
	<table style="width: 100%" align="left">
		<tr>
			<td style="width: 300px">Date: <span class="text2">*</span></td>
			<td style="width: 300px"><input name="ord_date" type="text" size="10" value="$ord_date" MAXLENGTH=10 />&nbsp;&nbsp;&nbsp;(Format: DD/MM/YYYY)</td>
		</tr>
		<tr>
			<td style="width: 300px">MAWB: <span class="text2">*</span></td>
			<td style="width: 300px"><input name="ord_awb1" type="text" size="3" value="$ord_awb1" MAXLENGTH=3 />&nbsp;<input name="ord_awb2" type="text" size="8" value="$ord_awb2" MAXLENGTH=8 /></td>
		</tr>
		<tr>
			<td style="width: 300px">Flight No: <span class="text2">*</span></td>
			<td style="width: 300px"><input name="ord_flight" type="text" size="10" value="$ord_flight" /></td>
		</tr>
		<tr>
			<td style="width: 300px">Currency: <span class="text2">*</span></td>
			<td style="width: 300px">
				<select name="cvalue" width="20">
					<option value="\$" selected>USD (\$)</option>
					<option value="£">Pound (£)</option>
					<option value="€">Euro (€)</option>
				</select>
			</td>
		</tr>
		<tr>
			<td style="width: 300px">Num. of HAWB: </td>
			<td style="width: 300px"><select name="ord_hawbcount" style="height:20px; width:50px;" onChange="ChangeHAWB(this.options[this.selectedIndex].text);">|;
			
			print qq|<option value="1" selected>1</option>|;
			for( $i = 2 ; $i <= 20 ; $i++ )
				{
				print qq|<option value="$i">$i</option>|;
				}
			
			print qq|</select></td>
		</tr>
		<tr>
		<td colspan="2">
<DIV ID="divHAWB">
</DIV>

<script>ChangeHAWB(1);</script>
		
		</td>
		</tr>
		<tr>
			<td style="width: 300px">Total Weight: <span class="text2">*</span>&nbsp;&nbsp;<input name="ord_totw" type="text" size="10" value="$ord_totw" /></td>
			<td style="width: 300px">Total Bags: <span class="text2">*</span>&nbsp;&nbsp;<input name="ord_totb" type="text" size="10" value="$ord_totb" /></td>
		</tr>
		<tr>
		<td colspan="2" align="center">
		<center><br /><input name="submit1" type="submit" value="Save & Finish Order" size="30" /></center>
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


sub order2{
	unless ($ord_date) {&error_page("Wrong data specified! Date is invalid. Please press back button in your browser to correct the problem."); exit;} 
	unless ($ord_awb1 && $ord_awb2 && $ord_awb1 =~ /^\s*[0-9]{3}\s*$/ && $ord_awb2 =~ /^\s*[0-9]{8}\s*$/ ) {&error_page("Wrong data specified! MAWB is invalid. Please press back button in your browser to correct the problem."); exit;} 
	unless ($ord_flight) {&error_page("Wrong data specified! Flight No. is invalid. Please press back button in your browser to correct the problem."); exit;} 
	unless ($cvalue eq '$' || $cvalue eq '£' || $cvalue eq '€') {&error_page("Wrong data specified! Currency is invalid. Please press back button in your browser to correct the problem."); exit;} 

	unless (${'ord_hawbcount'} && ${'ord_hawbcount'} =~ /^\s*[0-9]+\s*$/) {&error_page("Wrong data specified! Num. of HAWBs is invalid. Please press back button in your browser to correct the problem."); exit;} 
	
	for( $l = 1; $l <= ${'ord_hawbcount'} ; $l++ )
		{
		my $w;
		$w = "hawb[$l]";
		unless (${$w} && ${$w} =~ /^\s*[0-9]+\s*$/) {&error_page("Wrong data specified! HAWB No. in Row $l is invalid. Please press back button in your browser to correct the problem."); exit;} 
	 	$w = "weight[$l]";
		unless (${$w} && ${$w} =~ /^\s*[0-9\.]+\s*$/) {&error_page("Wrong data specified! Weight in Row $l is invalid. Please press back button in your browser to correct the problem."); exit;} 
	 	$w = "item[$l]";
		unless (${$w} && ${$w} =~ /^\s*[0-9]+\s*$/) {&error_page("Wrong data specified! Item in Row $l is invalid. Please press back button in your browser to correct the problem."); exit;} 
	 	$w = "value[$l]";
		unless (${$w} && ${$w} =~ /^\s*[0-9\.]+\s*$/) {&error_page("Wrong data specified! Value in Row $l is invalid. Please press back button in your browser to correct the problem."); exit;} 
	 	$w = "content[$l]";
		unless (${$w}) {&error_page("Wrong data specified! Content in Row $l is invalid. Please press back button in your browser to correct the problem."); exit;} 
	 	$w = "shipper[$l]";
		unless (${$w}) {&error_page("Wrong data specified! Shipper in Package $l is invalid. Please press back button in your browser to correct the problem."); exit;} 
	 	$w = "receiver[$l]";
		unless (${$w}) {&error_page("Wrong data specified! Receiver in Package $l is invalid. Please press back button in your browser to correct the problem."); exit;} 
		}

	unless ($ord_totw && $ord_totw =~ /^\s*[0-9\.]+\s*$/) {&error_page("Wrong data specified! Total Weight is invalid. Please press back button in your browser to correct the problem."); exit;} 
	unless ($ord_totb && $ord_totb =~ /^\s*[0-9]+\s*$/) {&error_page("Wrong data specified! Total Bags is invalid. Please press back button in your browser to correct the problem."); exit;} 

	$ord_flight =~ s/'/\\'/g;
	
	for( $l = 1; $l <= ${'ord_hawbcount'} ; $l++ )
		{
		my $w;
	 	$w = "content[$l]";
		${$w} =~ s/'/\\'/g;
	 	$w = "shipper[$l]";
		${$w} =~ s/'/\\'/g;
	 	$w = "receiver[$l]";
		${$w} =~ s/'/\\'/g;
		}

	my $usercgi = new CGI; 
	my $userip = $usercgi->remote_host(); 
			
	$SQLFLDS = "(entid,userid,entdate,status,awb1,awb2,flight,currency,habwcount,totw,totb,ip)";
	$SQLVALS = "(0,$isUser, '$ord_date', 1, '$ord_awb1', '$ord_awb2', '$ord_flight', '$cvalue', $ord_hawbcount, $ord_totw, $ord_totb, '$userip')";

	$SQL = "INSERT INTO entries $SQLFLDS VALUES $SQLVALS";
	&my_sql;
	$sth->finish;

	$orderid = 0;
	$SQL = "SELECT LAST_INSERT_ID() as entid FROM entries"; 
	&my_sql;
	if ($column = $sth->fetchrow_hashref)
		{
		$entid = $column->{'entid'};
		}
	$sth->finish;

	if( $entid )
		{
		$SQLFLDS = "(entid,row,hawb,weight,item,value,content,shipper,receiver)";

		for( $l = 1; $l <= ${'ord_hawbcount'} ; $l++ )
			{
			my $w;
	
			$SQLVALS = "($entid,";
			$SQLVALS = $SQLVALS . $l . ",'";
			$w = "hawb[$l]";
			$SQLVALS = $SQLVALS . ${$w} . "',";
		 	$w = "weight[$l]";
			$SQLVALS = $SQLVALS . ${$w} . ",";
		 	$w = "item[$l]";
			$SQLVALS = $SQLVALS . ${$w} . ",";
		 	$w = "value[$l]";
			$SQLVALS = $SQLVALS . ${$w} . ",'";
		 	$w = "content[$l]";
			$SQLVALS = $SQLVALS . ${$w} . "','";
		 	$w = "shipper[$l]";
			$SQLVALS = $SQLVALS . ${$w} . "','";
		 	$w = "receiver[$l]";
			$SQLVALS = $SQLVALS . ${$w} . "')";
			
			$SQL = "INSERT INTO entdetails $SQLFLDS VALUES $SQLVALS";
			&my_sql;
			$sth->finish;
			}


		$entitems = 0;
		$SQL = "SELECT COUNT(*) as entitems FROM entdetails WHERE entid=$entid"; 
		&my_sql;
		if ($column = $sth->fetchrow_hashref)
			{
			$entitems = $column->{'entitems'};
			}
		$sth->finish;

		if( $entitems == ${'ord_hawbcount'} )
			{
			&SendEmail($myemail, $adminemail, "New Europost Order (Ref.: $entid)", "<p>Dear $salesman,<br><br>A new order, Ref.: $entid, is just placed in your system by \"$fullname\". You may visit the order at:<br><br><a href=\"$scripturl?cf=order&view=1&entid=$entid\">$scripturl?cf=order&view=1&entid=$entid</a><br><br>Your Sincerely,<br>Administrator</p>");

		
			$redirect="$script?cf=orderok";
			print $form->redirect(-url=>$redirect);
			}
		else
			{
			$SQL = "DELETE FROM entdetails WHERE entid=$entid";
			&my_sql;
			$sth->finish;
			$SQL = "DELETE FROM entries WHERE entid=$entid";
			&my_sql;
			$sth->finish;

			&error_page("Couldn't save the order rows in the database. Please try again. If the problem persists, please call the administrator."); exit;
			}
		}
	else
		{
		&error_page("Couldn't save the order in the database. Please try again. If the problem persists, please call the administrator."); exit;
		}
}

1;
