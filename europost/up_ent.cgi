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

require "/home/europost/public_html/entry.pl";

&getdate;
$date = &date;

$heading="Update";

$TSQL = "SELECT entid FROM entries WHERE clogclosed=0 and awb1 <> '' and awb2 <> ''";	
&tmy_sql;

while ( $tcolumn = $tsth->fetchrow_hashref ) 
	{
	$entid = $tcolumn->{'entid'};

	$retstr = updateCargo($entid);
	if( $retstr )
		{
		unless( $prnprint )
			{
			print "Content-type: text/plain\n\n";
			$prnprint = 1;
			}
		print $retstr . "\n";
		}
	}

$tsth->finish;

$TSQL = "SELECT entid FROM entries WHERE flogclosed=0 and flight <> ''";	
&tmy_sql;

while ( $tcolumn = $tsth->fetchrow_hashref ) 
	{
	$entid = $tcolumn->{'entid'};

	$retstr = updateFlight($entid);
	if( $retstr )
		{
		unless( $prnprint )
			{
			print "Content-type: text/plain\n\n";
			$prnprint = 1;
			}
		print $retstr . "\n";
		}
	}

$tsth->finish;

#print "Crontab job Finished.\n";

1;