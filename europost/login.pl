
use CGI; ## load the cgi module
use Digest::MD5; 

$heading="login";

sub home{
&myheader(heading);

&topmenu(heading);

print qq|

<div class="ha2">
<div class="clear box" style="width: 218; height: 263">
<table border="0" cellspacing="0" cellpadding="0">
<tr class="box1">
<td class="box1">
<form id="form1" name="form" method="post" action="$script?cf=login&login=1">
<input class="i"  onblur="if(this.value==''){this.value='Login:';}" onfocus="if(this.value=='Login:'){this.value='';}" value="Login:" name="username"/><br />
<input class="i"  onblur="if(this.value==''){this.value='Password:';}" onfocus="if(this.value=='Password:'){this.value='';}" value="Password:" name="password"/><br />
<input type="checkbox" value="1" name="savelogin" style="vertical-align: top; border:0px;" />&nbsp;Remember Me.<br />
<div class="rt">
<a href="javascript:void(0);" onclick="javascript:document.form1.submit();">
<img src="img/index/index_04.gif" alt="Enter" width="49" height="24" border="0" /></a></div></form><div class="rt">
<a href="$script?cf=members" class="underline text1 link1">Register</a>
<br />
<a href="$script?cf=members&lostpass=1" class="underline text1 link1">Forget your password</a>
</div>
</td>
</tr>
</table>
</div>

</div>

|;

&footer;

}


sub login{
	unless ($username) {&error_page("Incomplete data entered! Please enter the Username field."); exit;} 
	unless ($password) {&error_page("Incomplete data entered! Please enter the Password field."); exit;} 

	my $usercgi = new CGI; 
	my $userip = $usercgi->remote_host(); 

	$userid = 0;
	$SQL = "SELECT userid, sal, fname, lname, status FROM members WHERE username = '$username' and password='$password' and status=2"; 
	&my_sql;
	if ($column = $sth->fetchrow_hashref)
		{
		$userid = $column->{'userid'};
		$fullname = $column->{'fname'} . ' ' . $column->{'lname'};
		$status = $column->{'status'};
		$sth->finish;
		if( $status == 1 )
			{
			error_page("Your account has not been activated yet."); exit;
			}
		elsif( $status == 3 )
			{
			error_page("Your account is suspended."); exit;
			}
		elsif( $status == 4 )
			{
			error_page("There is no such an account."); exit;
			}
		else
			{
			my $fut_time;
			
			if( $savelogin eq "1" )
				{
				$fut_time = gmtime(time()+365*24*3600)." GMT";
				}
			else
				{
				$fut_time = gmtime(time()+24*3600)." GMT";;
				}

			my $ustr;
			while( 1 )
				{
				$ustr = Digest::MD5::md5_base64( rand );
				
				$TSQL = "SELECT uid FROM users WHERE uid = '$ustr'";
				&tmy_sql;
				
				unless($tcolumn = $tsth->fetchrow_hashref)
					{
					$tsth->finish;
					last;
					}
				$tsth->finish;
				}
			
			$SQL2 = "INSERT INTO users (uid,userid,ip,lastlogin,permanent) VALUES ('$ustr',$userid, '$userip', CURRENT_TIMESTAMP(), '$savelogin')";
			&my_sql2;
			$sth2->finish;
	
			$sessioncookie1 = $form->cookie(-name=>userid, -value=>$userid, -expires=>$fut_time);
			$sessioncookie2 = $form->cookie(-name=>fullname, -value=>$fullname, -expires=>$fut_time);
			$sessioncookie3 = $form->cookie(-name=>uid, -value=>$ustr, -expires=>$fut_time);
			$loginurl ="$script?cf=member&userid=$userid&logedout=0&userip=$userip";
			print $form->redirect(-url=>$loginurl, -cookie=>[$sessioncookie1, $sessioncookie2, $sessioncookie3]);
			}
		}
	else
		{
		$sth->finish;
		error_page("Username or Password is not correct. Please try again.");
		exit;
		}
}

1;