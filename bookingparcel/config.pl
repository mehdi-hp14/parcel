########################################################
# Copyright (c) QuickPayPro, LLC - www.QuickPayPro.com #
########################################################

$maxhits="30";
$maxthreads=1;
unless($nh){$nh=0;}

# CONFIG VARIABLES
$Domain = "www.europostexpress.co.uk"; # MUST INCLUDE Top Level Domain Extension (tld) - .com, .net, .biz, etc...
$mycompany="EuroPost Express (UK) Ltd.";

$adminusercookie="adminid";
$adminpasscookie="adminpass";
$adminexpirecookie="+1y";
$myadminid="3";
$mypassword="1";

$sql_host="localhost";# can also be an IP or domain
#shahyar
$sql_dataname = "europost_main";
$sql_userid = "europost_main";
$sql_password = '6N3rvFHp!O[T';


# OPTIONAL VARIABLES
$lightcolor="#E1EBFF";
$darkcolor="#3A6CCB";
$hovercolor="#3A6CCB";
$mylogo="logo.jpg";
$mybackground="background.jpg";
#$myemail="sales\@$Domain";

#$myemail="Courier\@europostexpress.co.uk";
$myemail="booking\@europostexpress.co.uk";
#$adminemail="admin\@$Domain";
$adminemail="admin\@europostexpress.co.uk";
$adminname="EuroPostExpress Administrator";
$salesman="Fazel Zohrabpour";
$replyemail='noreply\@$Domain';
$sendmail = '/usr/sbin/sendmail';
$mkdir = "/bin/mkdir";
$paypalemail="order\@goldenkeydirectory.com";

# DO NOT EDIT BELOW THIS LINE
$DomainURL = "http://$Domain";
$SecureDomainURL = "https://$Domain";
$cgiurl = "$DomainURL";
$secureurl="$SecureDomainURL/index.cgi";
$refurl = "$DomainURL";
$homepath = "/home/europost/public_html";
$uploadpath = "/home/europost/public_html/upload";
$cgipath = "$homepath";
$version= "2";


######## CONNECT TO DATABASE ##########
sub connect_sql{
use DBI;
$DSN  = "DBI:mysql:$sql_dataname:$sql_host";
$dbh  = DBI->connect($DSN,$sql_userid,$sql_password)
|| &error("Database connection failed: $DBI::errstr") unless $dbh;
return;
}

######## EXECUTE SQL COMMAND ##########
sub my_sql{
eval{ $sth = $dbh->prepare($SQL); $sth->execute;};
if($@){$dbh->disconnect;&error("Database error $@");exit;}
return ($sth);
}

sub my_sqls{
eval{ $sths = $dbh->prepare($SQLS); $sths->execute;};
if($@){$dbh->disconnect;&error("Database error $@");exit;}
return ($sths);
}

sub my_sql2{
eval{ $sth2 = $dbh->prepare($SQL2); };
if($@){$dbh->disconnect;&error("Database error $@");exit;}
else {$sth2->execute; }
return ($sth2);
}

sub tmy_sql{
eval{ $tsth = $dbh->prepare($TSQL); $tsth->execute;};
if($@){$dbh->disconnect;&error("Database error $@");exit;}
return ($tsth);
}

######## QUOTE DATA FOR MYSQL ##########
sub quote_data{
	my ($field) = shift;
	if (!defined($field) || $field eq '')
	{
		$field = '';
	}
	return $dbh->quote($field);
}

1;


