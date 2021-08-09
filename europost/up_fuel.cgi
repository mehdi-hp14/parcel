#!/usr/bin/perl -s

$| = 1;


use lib qw(/home/europost/public_html/);

use CGI;
use LWP::UserAgent;
use CGI::Carp qw/fatalsToBrowser/;
use Time::Local;
use CGI qw/:standard/;
use CGI qw(param);


my $timestamp = scalar(localtime());
$time = time();

require "/home/europost/public_html/config.pl";
&connect_sql;
$script="index.cgi";
$scripturl="$DomainURL/index.cgi";
require "/home/europost/public_html/variables.pl";
require "/home/europost/public_html/globals.pl";

require "/home/europost/public_html/book.pl";

&getdate;
$date = &date;

$heading="Update";

$SQL = "SELECT * FROM carriers WHERE dofuel=1";	
&my_sql;

while ( $column = $sth->fetchrow_hashref ) 
	{
	my ($curf, $curm, $nextf);
	
	$curm = $column->{'fuelmonth'};
	$curfr = $column->{'fuelroad'};
	$nextfr = $column->{'nextfuelroad'};
	$curfa = $column->{'fuelair'};
	$nextfa = $column->{'nextfuelair'};
	$retstr = getFuel($column->{'abbr'}, \$curm, \$curfr, \$curfa, \$nextfr, \$nextfa);
	
	if( $retstr )
		{
		$TSQL = "UPDATE carriers SET fuelmonth= $curm, fuelroad=$curfr, fuelair=$curfa, nextfuelroad=$nextfr, nextfuelair=$nextfa WHERE id=$column->{'id'}";	
		&tmy_sql;
		$tsth->finish;
		}
	}

$sth->finish;

1;