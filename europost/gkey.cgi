#!/usr/bin/perl

#use strict;
use CGI::Carp qw(fatalsToBrowser);
use DBI();
use CGI qw(param);
use Digest::MD5;
use Mail::Sendmail 0.75; # doesn't work with v. 0.74!
use Time::Local;
use Date::Calc qw(Add_Delta_Days);

$| = 1;


BEGIN {
    my $b__dir = (-d $homedir .'/perl'?$homedir .'/perl':( getpwuid($>) )[7].'/perl');
    unshift @INC,$b__dir.'5/lib/perl5',$b__dir.'5/lib/perl5/x86_64-linux-thread-multi',map { $b__dir . $_ } @INC;
}

my %In;

sub AddLeadingZero
{
	my $strval = shift;

	if( length($strval) == 1 )
		{
		return  '0' . $strval;
		}
	else
		{
		return  $strval;
		}
}

sub Parse
{
	my $buffer;

	if( $ENV{REQUEST_METHOD} eq 'GET' ) 
		{ 
		$buffer = $ENV{QUERY_STRING}; 
		}
	else 
		{ 
		read(STDIN, $buffer, $ENV{CONTENT_LENGTH}); 
		}

	my @pairs = split(/&/,$buffer);
	for(@pairs)
		{
		$_ =~ tr/+/ /;
		my ($n,$v) = split /=/,$_,2;
		$v =~ s/%([a-fA-F0-9]{2})/pack("C",hex($1))/eg;
		last if $v =~ /\<[\s*]applet/sig;
		last if $v =~ /\<[\s*]script/sig;
		$In{$n} = $v;
		}

  $In{'delete'} = 0 if !exists $In{'delete'};
  $In{'email'} = '' if !exists $In{'email'};
  $In{'company'} = '' if !exists $In{'company'};
  $In{'name'} = '' if !exists $In{'name'};
  $In{'prog'} = 'I' if !exists $In{'prog'};

  $In{'add'} = 0 if !exists $In{'add'};
  $In{'subadd'} = 0 if !exists $In{'subadd'};
  $In{'message'} = '' if !exists $In{'message'};
}

sub error_page
{
	&showHeader;
	print "<p><h4>Error: $_[0]</h4></p>\n";
	&showFooter;
}

sub mydie
{
	&error_page($_[0]);
	die 1;
}

sub showHeader
{
	print "<html>\n";
	print "<head><title>Golden Key Download Page</title><meta http-equiv=\"Content-Language\" content=\"fa\">\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1256\">\n</head>\n";
	print qq(<script language="JavaScript">
		function go_home() {
			window.location="gkey.cgi?" + Math.random()*16;
	}
	</script>
	);
	print "<body>\n";
	print qq(<br><a href="#" onClick="javascript:go_home()">Home</a><br>\n); 
	print "<br><font color=#FF0000><b><big>$In{'message'}</big></b></font><br>\n"; 
}

sub showFooter
{
	print "</body>\n";
	print "</html>\n";
}

sub showList
{
  my ($dbf, $res, $rec);
	my $row_wor = 0;

  $dbf = DBI->connect("DBI:mysql:database=europost_gkey;host=localhost", "europost_gkey", '!55]RR%s&mRL');
  if( !$dbf )
		{
		print "Cannot open database!";
		return 0;		
		}

  $res = $dbf->prepare("SELECT * FROM download WHERE expdate >= CURRENT_DATE() ORDER BY email");
  $res->execute;

  &showHeader;

	print "<center><font color=#0066FF><h1>List of Active Golden Key Downloads</h1></font></center><br>";
	
  if( $res->rows || $In{'subadd'} )
  	{
  	print "<p><table width=100% border=1 cellpading=1 cellspacing=1>\n";
		print "<tr>\n";
		print "<td colspan=10>\n";
		print qq(<form METHOD=GET action="gkey.cgi">
		<table border=0 cellpading=1 cellspacing=1>
		<tr>
		<td>Program:</td><td><select name="prog">);

		if( $In{'prog'} eq "I" ) { print qq(<option value="I" selected>Iran</option>); }
		else { print qq(<option value="I">Iran</option>); }

		if( $In{'prog'} eq "c" ) { print qq(<option value="c" selected>China</option>); }
		else { print qq(<option value="c">China</option>); }
			
		if( $In{'prog'} eq "G" ) { print qq(<option value="G" selected>Germany</option>); }
		else { print qq(<option value="G">Germany</option>); }
		
		if( $In{'prog'} eq "T" ) { print qq(<option value="T" selected>Taiwan</option>); }
		else { print qq(<option value="T">Taiwan</option>); }

		if( $In{'prog'} eq "R" ) { print qq(<option value="R" selected>Turkey</option>); }
		else { print qq(<option value="R">Turkey</option>); }

		if( $In{'prog'} eq "U" ) { print qq(<option value="U" selected>United Kingdom</option>); }
		else { print qq(<option value="U">United Kingdom</option>); }

		if( $In{'prog'} eq "B" ) { print qq(<option value="B" selected>Bahrain</option>); }
		else { print qq(<option value="B">Bahrain</option>); }

		if( $In{'prog'} eq "E" ) { print qq(<option value="E" selected>Egypt</option>); }
		else { print qq(<option value="E">Egypt</option>); }

		if( $In{'prog'} eq "J" ) { print qq(<option value="J" selected>Jordan</option>); }
		else { print qq(<option value="J">Jordan</option>); }

		if( $In{'prog'} eq "K" ) { print qq(<option value="K" selected>Kuwait</option>); }
		else { print qq(<option value="K">Kuwait</option>); }

		if( $In{'prog'} eq "L" ) { print qq(<option value="L" selected>Lebanon</option>); }
		else { print qq(<option value="L">Lebanon</option>); }

		if( $In{'prog'} eq "O" ) { print qq(<option value="O" selected>Oman</option>); }
		else { print qq(<option value="O">Oman</option>); }

		if( $In{'prog'} eq "Q" ) { print qq(<option value="Q" selected>Qatar</option>); }
		else { print qq(<option value="Q">Qatar</option>); }

		if( $In{'prog'} eq "S" ) { print qq(<option value="S" selected>Saudi Arabia</option>); }
		else { print qq(<option value="S">Saudi Arabia</option>); }

		if( $In{'prog'} eq "s" ) { print qq(<option value="s" selected>Syria</option>); }
		else { print qq(<option value="s">Syria</option>); }

		if( $In{'prog'} eq "u" ) { print qq(<option value="u" selected>UAE</option>); }
		else { print qq(<option value="u">UAE</option>); }

		print qq(</select></td></tr>
		<tr>
		<td>Company Name:</td><td><input type=TEXTBOX name="company" size=50  value="$In{'company'}"></td></tr>
		<tr>
		<input type=HIDDEN name="add" value="1"><br>
		<td>Email:</td><td><input type=TEXTBOX name="email" size=40  value="$In{'email'}"></td></tr>
		<tr>
		<td>Contact Person:</td><td><input type=TEXTBOX name="name" size=50  value="$In{'name'}"></td></tr>
		</table>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=SUBMIT value="Add new record"><br>
		</form>);

		print "</td></tr>\n";
		}
		
	if( $res->rows )
		{
		print "<tr>\n";
		print "<td width=3% align=\"center\">#</td>\n";
		print "<td width=23% align=\"center\"><b>Specification</b></td>\n";
		print "<td width=11% align=\"center\"><b>Program</b></td>\n";
		print "<td width=4% align=\"center\"><b>Visited</b></td>\n";
		print "<td width=4% align=\"center\"><b>Downloaded</b></td>\n";
		print "<td width=12% align=\"center\"><b>Registration Date</b></td>\n";
		print "<td width=12% align=\"center\"><b>Expiry Date</b></td>\n";
		print "<td width=5% align=\"center\">Delete</td>\n";
		print "</tr>\n";

		$rec = $res->fetchrow_hashref();
		while( $rec )
			{
			$row_wor = $row_wor + 1;
			print "<tr>\n";
			print "<td>&nbsp;$row_wor</td>\n";
			print "<td>\n";
			print " <b>Company:</b> " . $rec->{'company'} . "<br>\n" if( $rec->{'company'} );
			print " <b>Name:</b> " . $rec->{'name'} . "<br>\n" if( $rec->{'name'} );
			if( $rec->{'company'} || $rec->{'name'} )
				{
				print " <b>Email:</b> " . $rec->{'email'};
				}
			else
				{
				print " " . $rec->{'email'};
				}
			print "</td>\n";
			if( $rec->{'prog'} eq 'I' )
				{	print "<td><center>Iran</center></td>\n"; }
			elsif( $rec->{'prog'} eq 'G' )
				{	print "<td><center>Germany</center></td>\n"; }
			elsif( $rec->{'prog'} eq 'U' )
				{	print "<td><center>United Kingdom</center></td>\n"; }
			elsif( $rec->{'prog'} eq 'T' )
				{	print "<td><center>Taiwan</center></td>\n"; }
			elsif( $rec->{'prog'} eq 'R' )
				{	print "<td><center>Turkey</center></td>\n"; }
			elsif( $rec->{'prog'} eq 'c' )
				{	print "<td><center>China</center></td>\n"; }
			elsif( $rec->{'prog'} eq 'B' )
				{	print "<td><center>Bahrain</center></td>\n"; }
			elsif( $rec->{'prog'} eq 'E' )
				{	print "<td><center>Egypt</center></td>\n"; }
			elsif( $rec->{'prog'} eq 'J' )
				{	print "<td><center>Jordan</center></td>\n"; }
			elsif( $rec->{'prog'} eq 'K' )
				{	print "<td><center>Kuwait</center></td>\n"; }
			elsif( $rec->{'prog'} eq 'L' )
				{	print "<td><center>Lebanon</center></td>\n"; }
			elsif( $rec->{'prog'} eq 'O' )
				{	print "<td><center>Oman</center></td>\n"; }
			elsif( $rec->{'prog'} eq 'Q' )
				{	print "<td><center>Qatar</center></td>\n"; }
			elsif( $rec->{'prog'} eq 'S' )
				{	print "<td><center>Saudi Arabia</center></td>\n"; }
			elsif( $rec->{'prog'} eq 's' )
				{	print "<td><center>Syria</center></td>\n"; }
			elsif( $rec->{'prog'} eq 'u' )
				{	print "<td><center>UAE</center></td>\n"; }
			else
				{	print "<td><center>---</center></td>\n"; }

			print "<td><center>" . $rec->{'visits'} . "</center></td>\n";
			print "<td><center>" . $rec->{'downloads'} . "</center></td>\n";
			print "<td><center>" . substr($rec->{'regdate'}, 0, 10) . "</center></td>\n";
			print "<td><center>" . substr($rec->{'expdate'}, 0, 10) . "</center></td>\n";
			print "<td><center><a href=\"gkey.cgi?delete=1&prog=$rec->{'prog'}&email=" . $rec->{'email'} . "\">DELETE</a></center></td>\n";
			print "</tr>\n";
			$rec = $res->fetchrow_hashref();
			}

		print "</table>\n";
		}
	else
		{
	  if( $In{'subadd'} )
	  	{
			print "</tr></table>\n";
			}
		else
			{
			print "No record found<br><br>\n<center>Click <a href=\"gkey.cgi?subadd=1\">HERE</a> to add the first record.</center>";
			}
		}

	&showFooter;
  $res->finish;
  $dbf->disconnect;
}


sub subdelete
{
  my ($dbf, $res, $rec);

  $dbf = DBI->connect("DBI:mysql:database=europost_gkey;host=localhost", "europost_gkey", '!55]RR%s&mRL');
  $dbf or return 0;

 	$res = $dbf->prepare("SELECT * FROM download WHERE email='" . $In{'email'} . "' AND prog='". $In{'prog'} . "'");
  $res->execute;

  if( $res->rows )
  	{
		$rec = $res->fetchrow_hashref();
		my $folname = $rec->{'folder'};
  	$res->finish;
  	$dbf->do("DELETE FROM download WHERE email='" . $In{'email'} . "' AND prog='". $In{'prog'} . "'");

		unlink("/home/europost/public_html/goldenkeydirectory.com/downloads/$folname/index.cgi");  	
		rmdir("/home/europost/public_html/goldenkeydirectory.com/downloads/$folname");  	
	 	}
	else
		{
	  $res->finish;
	  }

	$In{'email'} = '';
	$In{'prog'} = '';
	  
  $dbf->disconnect;
}

sub SendEmail
{
	my ($to, $from, $subject, $message) = @_;
	
	%mail = (
         from => $from,
         to => $to,
         subject => $subject,
         'content-type' => 'text/html; charset="utf-8"'
	);

	$mail{body} = <<END_OF_BODY;
<html>$message</html>
END_OF_BODY

unless( sendmail(%mail) )
	{
	&error_page("Error in sending email. Please delete the added program. Error: $Mail::Sendmail::error"); 
	exit;
	}
} 

sub subadd
{
  my ($dbf, $res, $rec, $folder, $fname, $dirname, $now, $then);

	if( $In{'email'} eq '' )
		{
		$In{'message'} = "Email cannot be empty";
		return;
		}
		
	if( $In{'prog'} eq '' )
		{
		$In{'message'} = "Program must be selected";
		return;
		}
		
  $dbf = DBI->connect("DBI:mysql:database=europost_gkey;host=localhost", "europost_gkey", '!55]RR%s&mRL');
  $dbf or return 0;

 	$res = $dbf->prepare("SELECT expdate, CURRENT_DATE() AS curdate, folder FROM download WHERE email='" . $In{'email'} . "' AND prog='". $In{'prog'} . "'");
  $res->execute;

  if( $res->rows )
  	{
		$rec = $res->fetchrow_hashref();
		if( $rec->{'expdate'} lt $rec->{'curdate'} )
			{
			my $folname = $rec->{'folder'};
			$res->finish;
	  	$dbf->do("DELETE FROM download WHERE email='" . $In{'email'} . "' AND prog='". $In{'prog'} . "'");

			unlink("/home/europost/public_html/goldenkeydirectory.com/downloads/$folname/index.cgi");  	
			rmdir("/home/europost/public_html/goldenkeydirectory.com/downloads/$folname");  	
			}
		else
			{
		  $res->finish;
		  $dbf->disconnect;
			error_page("Email already exist for the specified program!");
		  exit;
		  }
	 	}
	else
		{
		$res->finish;
		}

	$folder = Digest::MD5::md5_hex( rand );

	$dbf->do("INSERT INTO download (prog, company, name, email, regdate, expdate, folder, visits, downloads) VALUES ('". $In{'prog'} . "', '". $In{'company'} . "', '". $In{'name'} . "', '". $In{'email'} . "', CURRENT_DATE(), DATE_ADD(CURRENT_DATE(), INTERVAL 8 DAY), '$folder', 0, 0)");
  $dbf->disconnect;

  my ($sec,$min,$hour,$mday,$mon,$year,$wday,$yday,$isdst) = localtime();

	$year = $year + 1900;
	$mon = $mon + 1;
	
	my ($year, $month, $day) = Add_Delta_Days($year, $mon, $mday, 8);
	
	if( $In{'prog'} eq 'I' )
		{	
		$fname = "IranGoldenKeyDirectorySetup.exe"; 
		$dirname = "Iran GoldenKey Directory Application";
		}
	elsif( $In{'prog'} eq 'G' )
		{	
		$fname = "GermanyGoldenKeyDirectorySetup.exe"; 
		$dirname = "Germany GoldenKey Directory Application";
		}
	elsif( $In{'prog'} eq 'U' )
		{	
		$fname = "UKGoldenKeyDirectorySetup.exe"; 
		$dirname = "UK GoldenKey Directory Application";
		}
	elsif( $In{'prog'} eq 'T' )
		{	
		$fname = "TaiwanGoldenKeyDirectorySetup.exe"; 
		$dirname = "Taiwan GoldenKey Directory Application";
		}
	elsif( $In{'prog'} eq 'R' )
		{	
		$fname = "TurkeyGoldenKeyDirectorySetup.exe"; 
		$dirname = "Turkey GoldenKey Directory Application";
		}
	elsif( $In{'prog'} eq 'c' )
		{	
		$fname = "ChinaGoldenKeyDirectorySetup.exe"; 
		$dirname = "China GoldenKey Directory Application";
		}
	elsif( $In{'prog'} eq 'B' )
		{	
		$fname = "BahrainGoldenKeyDirectorySetup.exe"; 
		$dirname = "Bahrain GoldenKey Directory Application";
		}
	elsif( $In{'prog'} eq 'E' )
		{	
		$fname = "EgyptGoldenKeyDirectorySetup.exe"; 
		$dirname = "Egypt GoldenKey Directory Application";
		}
	elsif( $In{'prog'} eq 'J' )
		{	
		$fname = "JordanGoldenKeyDirectorySetup.exe"; 
		$dirname = "Jordan GoldenKey Directory Application";
		}
	elsif( $In{'prog'} eq 'K' )
		{	
		$fname = "KuwaitGoldenKeyDirectorySetup.exe"; 
		$dirname = "Kuwait GoldenKey Directory Application";
		}
	elsif( $In{'prog'} eq 'L' )
		{	
		$fname = "LebanonGoldenKeyDirectorySetup.exe"; 
		$dirname = "Lebanon GoldenKey Directory Application";
		}
	elsif( $In{'prog'} eq 'O' )
		{	
		$fname = "OmanGoldenKeyDirectorySetup.exe"; 
		$dirname = "Oman GoldenKey Directory Application";
		}
	elsif( $In{'prog'} eq 'Q' )
		{	
		$fname = "QatarGoldenKeyDirectorySetup.exe"; 
		$dirname = "Qatar GoldenKey Directory Application";
		}
	elsif( $In{'prog'} eq 'S' )
		{	
		$fname = "SaudiArabiaGoldenKeyDirectorySetup.exe"; 
		$dirname = "Saudi Arabia GoldenKey Directory Application";
		}
	elsif( $In{'prog'} eq 's' )
		{	
		$fname = "SyriaGoldenKeyDirectorySetup.exe"; 
		$dirname = "Syria GoldenKey Directory Application";
		}
	elsif( $In{'prog'} eq 'u' )
		{	
		$fname = "UAEGoldenKeyDirectorySetup.exe"; 
		$dirname = "UAE GoldenKey Directory Application";
		}

	$month = AddLeadingZero($month);
	$day = AddLeadingZero($day);

	mkdir("/home/europost/public_html/goldenkeydirectory.com/downloads/$folder") or mydie("Cannot create folder. Please delete the added program!");
	open(FILE, ">/home/europost/public_html/goldenkeydirectory.com/downloads/$folder/index.cgi") or  mydie("Cannot create file. Please delete the added program!");
	binmode(FILE);
	print FILE qq~#!/usr/bin/perl
	use CGI::Carp qw(fatalsToBrowser);
	use DBI();
	use Time::Local;

  my (\$sec,\$min,\$hour,\$mday,\$mon,\$cyear,\$wday,\$yday,\$isdst) = localtime();

	\$cyear = \$cyear + 1900;
	\$mon = \$mon + 1;

	\$mon = \&AddLeadingZero(\$mon);
	\$mday = \&AddLeadingZero(\$mday);

	if(-e "/home/europost/gkeydownload/$fname" && "\$cyear\$mon\$mday" le "$year$month$day" )
		{
		my \$filesize = -s "/home/europost/gkeydownload/$fname";
		my \$dbf;

	  \$dbf = DBI->connect("DBI:mysql:database=europost_gkey;host=europostexpress.com", "europost_gkey", '!55]RR%s&mRL');

	  if( \$dbf )
	  	{
			\$dbf->do("UPDATE download SET visits=visits+1 WHERE folder='$folder'");
			}

		print "Content-type: application/octet-stream\\n";
		print "Content-Transfer-Encoding: binary\\n";
	 	print "Content-Length: \$filesize\\n";
  	print "Content-Disposition: attachment; filename=\\\"$fname\\\"; size=\$filesize \\n\\n";


		open ( DFILE, "</home/europost/gkeydownload/$fname" );
		print \$_ while ( read( DFILE, \$_, 16384 ) );
		close DFILE;

	  if( \$dbf )
	  	{
			\$dbf->do("UPDATE download SET downloads=downloads+1 WHERE folder='$folder'");
		  \$dbf->disconnect;
			}
		}
	else
		{
		print "Content-type: text/plain\\n\\n"; 
		print "The specified file does not exist on this server or has been removed.";
		}

sub AddLeadingZero
{
	my \$strval = shift;

	if( length(\$strval) == 1 )
		{
		return  '0' . \$strval;
		}
	else
		{
		return  \$strval;
		}
}
		
~;

	close(FILE);
#	my @fl = ()
  chmod(0755, "/home/europost/public_html/goldenkeydirectory.com/downloads/$folder/index.cgi") or mydie("Cannot change file mode. Please delete the added program!");

	&SendEmail($In{'email'}, "order\@goldenkeydirectory.com", "GoldenKey Directory Download Link", "<p>Dear $In{'name'},<br><br>You can download the demo version of the $dirname at the followng link:<br><br><a href=\"http://www.goldenkeydirectory.com/downloads/$folder\">http://www.goldenkeydirectory.com/downloads/$folder</a><br><br>The above link is valid only for a week (Until $day/$month/$year).<br>If you have any question, please do not hesitate to contact us.<br><br>Yours Sincerely,<br>GoldenKey Directory Sales Department");

	$In{'prog'} = '';
	$In{'company'} = '';
	$In{'name'} = '';
	$In{'email'} = '';
}

sub main
{
	my ($temp, $parameter, $ret, $nomenu);
	
	print "Content-type: text/html\n\n";
	
	$nomenu = 0;
	$temp = '';
	$parameter = '';

	&Parse;

  while( 1 )
  	{
	  $In{'delete'} = 0 if !exists $In{'delete'};
	  $In{'prog'} = 'I' if !exists $In{'prog'};
	  $In{'email'} = '' if !exists $In{'email'};
	  $In{'company'} = '' if !exists $In{'company'};
	  $In{'name'} = '' if !exists $In{'name'};
	
	  if( $In{'delete'} == 1 )
	  	{
	  	subdelete;
	  	showList;
		  last;
	  	}
	  elsif( $In{'add'} == 1 )
	  	{
	  	subadd;
	  	showList;
		  last;
	  	}
	  else
	  	{
	  	showList;
		  last;
	  	}
	  }
}


&main;


