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

&getdate;
$date = &date;

$heading="Update";

$t_ua = LWP::UserAgent->new;
$t_ua->agent("Mozilla/5.0");
$t_ua->timeout(10);

my ($curr, $rate);
my (@c_arr, @r_arr);

my $t_response = $t_ua->get('http://www.x-rates.com/calculator.html');
if( $t_response->is_success )
	{
	if( $t_response->content =~ m|var rate = new Array\((.+)\);|i )
		{
		my $rate = $1;
		$rate =~ s/ //g;
		@r_arr = split(/,/,$rate);
		}

	if( $#r_arr >= 0 && $t_response->content =~ m|var currency = new Array\((.+)\);|i )
		{
		my $curr = $1;
		$curr =~ s/ //g;
		@c_arr = split(/,/,$curr);

		if( $#r_arr == $#c_arr )
			{
			my ($c_usd, $c_euro) = (0, 0);

			for( my $j = 0 ; $j <= $#c_arr ; $j++ )
				{
				$c_arr[$j] =~ s/"//g;
				if( $c_arr[$j] eq "GBP" )
					{
					$r_arr[$j] =~ s/"//g;
					$c_usd = $r_arr[$j] + 1 - 1;
					}
				elsif( $c_arr[$j] eq "EUR" )
					{
					$r_arr[$j] =~ s/"//g;
					$c_euro = $r_arr[$j] + 1 - 1;
					}
				}
				
			if( $c_usd != 0 && $c_euro != 0 )
				{
				my $newrate = $c_usd / $c_euro;
				$newrate = "$newrate";
				
				$newrate =~ s/(\d+(\.\d{1,6})?).*/$1/;

				$SQL = "UPDATE settings SET value = '$c_usd' WHERE name = 'usd'";
				&my_sql;
				$sth->finish;

				$SQL = "UPDATE settings SET value = '$newrate' WHERE name = 'euro'";
				&my_sql;
				$sth->finish;
				}
			}
		}
	}

1;