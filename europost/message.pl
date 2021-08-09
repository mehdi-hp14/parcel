$heading="entry";

use CGI;
use LWP::UserAgent;
use CGI qw/:standard/;
use CGI qw(param);

sub home{
	unless ($entid) { &Werror_page("Not valid Delivery and Shipment Ref.!"); exit;}
	unless ($entuser) { &Werror_page("Not valid User ID!"); exit;}

	$msgawb = "";
	if( $srid )
		{
		$sridmsg = "SR#$srid";
		$sridstr = "and srid=$srid";

		$SQL = "SELECT hawb FROM entdetails WHERE entid=$entid and sr=$srid"; 
		&my_sql;

		if ($column = $sth->fetchrow_hashref)
			{
			$msgawb = $column->{'hawb'};
			$sridmsg = $sridmsg . " (AWB: $msgawb)";
			}

		$sth->finish;
		$sridstr = "and srid=$srid";
		}
	else
		{
		$srid = "";
		$sridstr = "";
		$sridmsg = "";

		$SQL = "SELECT awb1, awb2 FROM entries WHERE entid=$entid"; 
		&my_sql;

		if ($column = $sth->fetchrow_hashref)
			{
			$msgawb = $column->{'awb1'} . '-' . $column->{'awb2'};
			$sridmsg = $sridmsg . " (MAWB: $msgawb)";
			}

		$sth->finish;

		}

	$SQL = "SELECT messages.* FROM messages WHERE entryid=$entid $sridstr"; 
	&my_sql;

	$i = 0;
	$turn = 0;
	$hadrecord = 0;

	if ($column = $sth->fetchrow_hashref)
		{
		$hadrecord = 1;
		}

	$sth->finish;

	$SQL = "SELECT messages.*, members.username as me_username FROM messages LEFT JOIN members ON members.type <> 9 and (messages.mfrom=members.userid or messages.mto=members.userid) WHERE entryid=$entid $sridstr and (mfrom = $isUser or mto = $isUser) ORDER BY dt"; 
	&my_sql;
	
	$i = 0;
	while ($column = $sth->fetchrow_hashref)
		{
		unless( $i )
			{
			print $form->header;
			
			print qq~
			<html>
			<head>
			<title></title>
			</head>
			<body>
			<div align="center" valign="middle" style="vertical-align: middle;">
			<img src="img/content/slogan_01.gif" width="235" height="56" style="float: left;" /><span style="float: right;"><H3>Messages for D&amp;S $entid $sridmsg</H3></span>
			</div>
			
			<div align="left"><br /><br /><br /><br />
			<font class="nofrm" size="2" face="Arial">
<a href="javascript:void(0);" class="noneunderline" onClick="javascript:window.print();"><img src="img/content/print.jpg" width="16" height="16" border="0" alt="Print Messages" valign="middle" style="vertical-align: middle;" /></a>&nbsp;&nbsp;<a href="javascript:void(0);" class="noneunderline" onClick="javascript:window.print();">Print Messages</a><br /><br />
				<table style="background-color:#FDF3D0; width: 100%" border="1">
					~;
			}
		$i++;

		print qq|<tr>\n<td width="100%" style=|;
		
		if( $turn == 0 )
			{
			print qq|"background-color:#FADE7E;">|;
			}
		else
			{
			print qq|"background-color:#FDF3D0;">|;
			}


		print qq|
		<table border="0" width="100%">
		<tr>
		|;

		unless( $srid )
			{
			if( $column->{'srid'} )
				{
				print qq|<td width="25%"><font color="#663300" size="1">SR#: $column->{'srid'}</font></td>|;
				}
			else
				{
				print qq|<td width="25%"><font color="#663300" size="1">---</font></td>|;
				}
			}
		
		if( $isAdmin )
			{
			if( $column->{'mfrom'} eq $isAdmin )
				{
				print qq|<td width="25%"><font color="#663300" size="1">From: Administrator</font></td>|;
				}
			else
				{
				print qq|<td width="25%"><font color="#663300" size="1">From: <a href="$script?cf=members&view=1&memid=$column->{'mfrom'}" target=_BLANK>$column->{'me_username'}</a></font></td>|;
				}

			if( $column->{'mto'} eq $isAdmin )
				{
				print qq|<td width="25%"><font color="#663300" size="1">To: Administrator</font></td>|;
				}
			else
				{
				print qq|<td width="25%"><font color="#663300" size="1">To: <a href="$script?cf=members&view=1&memid=$column->{'mto'}" target=_BLANK>$column->{'me_username'}</a></font></td>|;
				}
			}
		else
			{
			if( $column->{'mfrom'} eq $isUser )
				{
				print qq|<td width="25%"><font color="#663300" size="1">From: $column->{'me_username'}</font></td>|;
				}
			else
				{
				print qq|<td width="25%"><font color="#663300" size="1">From: Administrator</font></td>|;
				}
			if( $column->{'mto'} eq $isUser )
				{
				print qq|<td width="25%"><font color="#663300" size="1">To: $column->{'me_username'}</font></td>|;
				}
			else
				{
				print qq|<td width="25%"><font color="#663300" size="1">To: Administrator</font></td>|;
				}
			}
		
		print qq|<td width="25%"><font color="#663300" size="1">Date: $column->{'dt'}</font></td>|;

		if( $srid )
			{
			print qq|<td width="25%"><font color="#663300" size="1">&nbsp;</font></td>|;
			}
		
		print "</tr>\n</table>\n<hr size=\"1\" width=\"100%\" noshade />";
		
		$fonted = 0;
		if( $column->{'mread'} == 0 )
			{
			print qq|<b><font color="#000000">|;
			$fonted = 1;
			}
			
			
		print $column->{'message'};

		if( $fonted == 1 )
			{
			print qq|</font></b>|;
			}
		
		print qq|</td>
		</tr>
		|;
				
		if( $turn == 0 )
			{ $turn = 1; }
		else
			{ $turn = 0; }
		}

	$sth->finish;
		
	if( $i == 0 )
		{
		if( $hadrecord == 0 )
			{
			print $form->header;
			
			print qq~
			<html>
			<head>
			<title></title>
			</head>
			<body>
			<div align="center" valign="middle" style="vertical-align: middle;">
			<img src="img/content/slogan_01.gif" width="235" height="56" style="float: left;" /><span style="float: right;"><H3>Messages for D&amp;S $entid $sridmsg</H3></span>
			</div>
			
			<font class="nofrm" size="2" face="Arial">
				<br /><br /><br /><br /><br /><br />There is no messages for this Entry/SR/AWB.<br />Please write the first message in the following box.<br /><br />Message:
				<table borde="0" width="720">
				<tr>
				<td align="left">
				<form method="post" action="$script" onsubmit="if(this.newmsg == '') { alert('Message cannot be empty.'); return false;}">
				<input name="cf" type="hidden" value="message" />
				<input name="userid" type="hidden" value="$isUser" />
				<input name="add" type="hidden" value="1" />
				<input name="entid" type="hidden" value="$entid" />
				<input name="srid" type="hidden" value="$srid" />
				<input name="entuser" type="hidden" value="$entuser" />
				<input name="msgawb" type="hidden" value="$msgawb" />
				<textarea name="msg" style="width:720px;height:300px;">
				</textarea>
				<br /><br />
				<center>
				<input name="submit" type="submit" value="Send Message" />
				</center>
				</form>
				</td>
				</tr>
				</table>
				<br /><br />
			</font>
			</body>
			</html>
					~;
			}
		else
			{
			&Werror_page("You don't have enough permission to access the messages for this Delivery and Shipment."); 
			}
		exit;
		}
	else
		{
		print qq|</table>
		</font>
		</div>
		<div  align="left"><br />
<font class="nofrm" size="2" face="Arial">
		Send a new message:<br />
				<table borde="0" width="720">
				<tr>
				<td align="left">
				<form method="post" action="$script" onsubmit="if(this.newmsg == '') { alert('Message cannot be empty.'); return false;}">
				<input name="cf" type="hidden" value="message" />
				<input name="userid" type="hidden" value="$isUser" />
				<input name="add" type="hidden" value="1" />
				<input name="entid" type="hidden" value="$entid" />
				<input name="srid" type="hidden" value="$srid" />
				<input name="entuser" type="hidden" value="$entuser" />
				<textarea name="msg" style="width:720px;height:150px;">
				</textarea>
				<br /><br />
				<center>
				<input name="submit" type="submit" value="Send Message" />
				</center>
				</form>
				</td>
				</tr>
				</table>
		</font>
		</div>
		</body>
		</html>
		|;

		$SQL = "UPDATE messages SET mread=1 WHERE entryid=$entid $sridstr and mto = $isUser";
		&my_sql;
		$sth->finish;
		}
}

sub add{
	unless( $isAdmin || $userid == $isUser ) {&error_page("You don't have enough permission for this operation."); exit;}
	unless ($entid) {&error_page("Not valid Delivery and Shipment Ref.!"); exit;} 
	unless ($entuser) {&error_page("Not valid User ID!"); exit;} 
	unless ($msg) {&error_page("Message cannot be empty!"); exit;} 


	if( $isAdmin )
		{
		&SendMessage($entid,$srid,$isUser,$entuser, $msg, $msgawb, 1);
		}
	else
		{
		&SendMessage($entid,$srid,$isUser,$myadminid, $msg, $msgawb, 1);
		}


	$redirect="$script?cf=message&userid=$isUser&entuser=$entuser&entid=$entid&srid=$srid";
	print $form->redirect(-url=>$redirect);
}


sub SendMessage
{
	my ($mentid,$msrid,$mfrom,$mto, $mmsg, $mmsgawb, $sendemail) = @_;

	
	if( $msrid )
		{
		$msridmsg = "SR# $msrid";
		$msridstr = "&srid=$msrid";
		if( $mmsgawb )
			{
			$mmsgawbstr = "AWB No: $mmsgawb";
			}
		else
			{
			$mmsgawbstr = "";
			}
		}
	else
		{
		$msrid = '0';
		$msridstr = '';
		$msridmsg = '';
		if( $mmsgawb )
			{
			$mmsgawbstr = "MAWB No: $mmsgawb";
			}
		else
			{
			$mmsgawbstr = "";
			}
		}
		

	$SQL = "INSERT INTO messages (messid,entryid,srid,mfrom,mto,dt,status,mread,message) VALUES (0,$mentid,$msrid,$mfrom,$mto, CURRENT_TIMESTAMP(), 0, 0, '$mmsg')";

	&my_sql;
	$sth->finish;

	&get_mememail($mfrom);
	
	$from_userid = $mem_userid;
	$from_username = $mem_username;
	$from_sal = $mem_sal;
	$from_fname = $mem_fname;
	$from_lname = $mem_lname;
	$from_email = $mem_email;
	$from_status = $mem_status;
	$from_type = $mem_type;

	&get_mememail($mto);
	
	$to_userid = $mem_userid;
	$to_username = $mem_username;
	$to_sal = $mem_sal;
	$to_fname = $mem_fname;
	$to_lname = $mem_lname;
	$to_email = $mem_email;
	$to_status = $mem_status;
	$to_type = $mem_type;
	
	
	if( $sendemail )
		{
		if( $from_userid && $to_userid )
			{
			if( "$from_userid" eq $myadminid )
				{
				if( $mmsgawb )
					{
					if( $msrid eq '0' )
						{
						$emailmessage = qq|
						<p>Dear $to_sal $to_fname $to_lname,<br /><br />A new message (Deliver &amp; Shipment Ref: $mentid/MAWB No: $mmsgawb), is just placed in your system by Administrator. Here is the its content:<br />--------------------------------------<br />$mmsg<br />--------------------------------------<br />You can respond to the message by visiting the following link:<br /><br /><a href="$scripturl?cf=message&userid=$to_userid&entuser=$to_userid&entid=$mentid&srid=$msrid">$scripturl?cf=message&userid=$to_userid&entuser=$to_userid&entid=$mentid$msridstr</a><br /><br />Your Sincerely,<br />$Domain<br />$salesman</p>
						|;
						}
					else
						{
						$emailmessage = qq|
						<p>Dear $to_sal $to_fname $to_lname,<br /><br />A new message (Deliver &amp; Shipment Ref: $mentid/SR#$msrid/AWB No: $mmsgawb), is just placed in your system by Administrator. Here is the its content:<br />--------------------------------------<br />$mmsg<br />--------------------------------------<br />You can respond to the message by visiting the following link:<br /><br /><a href="$scripturl?cf=message&userid=$to_userid&entuser=$to_userid&entid=$mentid&srid=$msrid">$scripturl?cf=message&userid=$to_userid&entuser=$to_userid&entid=$mentid$msridstr</a><br /><br />Your Sincerely,<br />$Domain<br />$salesman</p>
						|;
						}
					}
				else
					{
					if( $msrid eq '0' )
						{
						$emailmessage = qq|
						<p>Dear $to_sal $to_fname $to_lname,<br /><br />A new message (Deliver &amp; Shipment Ref: $mentid), is just placed in your system by Administrator. Here is the its content:<br />--------------------------------------<br />$mmsg<br />--------------------------------------<br />You can respond to the message by visiting the following link:<br /><br /><a href="$scripturl?cf=message&userid=$to_userid&entuser=$to_userid&entid=$mentid&srid=$msrid">$scripturl?cf=message&userid=$to_userid&entuser=$to_userid&entid=$mentid$msridstr</a><br /><br />Your Sincerely,<br />$Domain<br />$salesman</p>
						|;
						}
					else
						{
						$emailmessage = qq|
						<p>Dear $to_sal $to_fname $to_lname,<br /><br />A new message (Deliver &amp; Shipment Ref: $mentid/SR#$msrid), is just placed in your system by Administrator. Here is the its content:<br />--------------------------------------<br />$mmsg<br />--------------------------------------<br />You can respond to the message by visiting the following link:<br /><br /><a href="$scripturl?cf=message&userid=$to_userid&entuser=$to_userid&entid=$mentid&srid=$msrid">$scripturl?cf=message&userid=$to_userid&entuser=$to_userid&entid=$mentid$msridstr</a><br /><br />Your Sincerely,<br />$Domain<br />$salesman</p>
						|;
						}
					}
				&SendEmail($to_email, $adminemail, "New Message for D&S $mentid $msridmsg $mmsgawbstr", $emailmessage);
				}
			else
				{
				if( $mmsgawb )
					{
					if( $msrid eq '0' )
						{
						$emailmessage = qq|
						<p>Dear $salesman,<br /><br />A new message (Deliver &amp; Shipment Ref: $mentid/MAWB No: $mmsgawb), is just placed in your system by "$from_username". Here is the its content:<br />--------------------------------------<br />$mmsg<br />--------------------------------------<br />You can respond to the message by visiting the following link:<br /><br /><a href="$scripturl?cf=message&userid=$to_userid&entuser=$from_userid&entid=$mentid&srid=$msrid">$scripturl?cf=message&userid=$to_userid&entuser=$from_userid&entid=$mentid$msridstr</a><br /><br />Your Sincerely,<br />Administrator</p>
						|;
						}
					else
						{
						$emailmessage = qq|
						<p>Dear $salesman,<br /><br />A new message (Deliver &amp; Shipment Ref: $mentid/SR#$msrid/AWB No: $mmsgawb), is just placed in your system by "$from_username". Here is the its content:<br />--------------------------------------<br />$mmsg<br />--------------------------------------<br />You can respond to the message by visiting the following link:<br /><br /><a href="$scripturl?cf=message&userid=$to_userid&entuser=$from_userid&entid=$mentid&srid=$msrid">$scripturl?cf=message&userid=$to_userid&entuser=$from_userid&entid=$mentid$msridstr</a><br /><br />Your Sincerely,<br />Administrator</p>
						|;
						}
					}
				else
					{
					if( $msrid eq '0' )
						{
						$emailmessage = qq|
						<p>Dear $salesman,<br /><br />A new message (Deliver &amp; Shipment Ref: $mentid), is just placed in your system by "$from_username". Here is the its content:<br />--------------------------------------<br />$mmsg<br />--------------------------------------<br />You can respond to the message by visiting the following link:<br /><br /><a href="$scripturl?cf=message&userid=$to_userid&entuser=$from_userid&entid=$mentid&srid=$msrid">$scripturl?cf=message&userid=$to_userid&entuser=$from_userid&entid=$mentid$msridstr</a><br /><br />Your Sincerely,<br />Administrator</p>
						|;
						}
					else
						{
						$emailmessage = qq|
						<p>Dear $salesman,<br /><br />A new message (Deliver &amp; Shipment Ref: $mentid/SR#$msrid), is just placed in your system by "$from_username". Here is the its content:<br />--------------------------------------<br />$mmsg<br />--------------------------------------<br />You can respond to the message by visiting the following link:<br /><br /><a href="$scripturl?cf=message&userid=$to_userid&entuser=$from_userid&entid=$mentid&srid=$msrid">$scripturl?cf=message&userid=$to_userid&entuser=$from_userid&entid=$mentid$msridstr</a><br /><br />Your Sincerely,<br />Administrator</p>
						|;
						}
					}
				&SendEmail($myemail, $adminemail, "New Message for D&S $mentid $msridmsg $mmsgawbstr", $emailmessage);
				}
			}
		}
}
1;
