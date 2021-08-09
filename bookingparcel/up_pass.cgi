#!/usr/bin/perl -s

$| = 1;


use lib qw(/home/europost/public_html/);

use CGI;
use LWP::UserAgent;
use Time::Local;
use CGI qw/:standard/;
use CGI qw(param);


my $timestamp = scalar(localtime());
$time = time();

my $prnprint = 0;

require "/home/europost/public_html/config.pl";
&connect_sql;
$script="index.cgi";
$scripturl="$DomainURL/index.cgi";
require "/home/europost/public_html/variables.pl";
require "/home/europost/public_html/globals.pl";

$SQL2 = "SELECT DISTINCT userid, uid FROM users WHERE permanent = 0 AND DATE_ADD(lastlogin,INTERVAL 1 DAY) < CURRENT_TIMESTAMP()";	
&my_sql2;

while ( $column2 = $sth2->fetchrow_hashref ) 
	{

	$TSQL = "DELETE FROM users WHERE userid=$column2->{'userid'} AND uid='$column2->{'uid'}'";
	&tmy_sql;
	$tsth->finish;
	}

$sth2->finish;

#print "Crontab job Finished.(Password)\n";

1;