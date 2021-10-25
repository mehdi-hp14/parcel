#!/usr/bin/perl -s

use CGI::Carp qw/fatalsToBrowser/;
use Time::Local;
use CGI qw (:standard);
use LWP::UserAgent;

open(LOG, ">>/home/europost/public_html/paypalposts.txt");

print LOG "In Notify\n";

my $timestamp = scalar(localtime());
$time = time();

read (STDIN, $query, $ENV{'CONTENT_LENGTH'});
$query .= '&cmd=_notify-validate';

print LOG "Query: $query\n";

if( $query =~ /custom=epx1/ )
	{
	$paypal_site = "https://www.sandbox.paypal.com/cgi-bin/webscr";
	}
else
	{
	$paypal_site = "https://www.paypal.com/cgi-bin/webscr";
	}

$form = new CGI;

# post back to PayPal system to validate
use LWP::UserAgent;
$ua = new LWP::UserAgent;
$req = new HTTP::Request 'POST',$paypal_site;
$req->content_type('application/x-www-form-urlencoded');
$req->content($query);
$res2468 = $ua->request($req);

# split posted variables into pairs
@pairs = split(/&/, $query);
$count = 0;
foreach $pair (@pairs) {
	($name, $value) = split(/=/, $pair);
	$value =~ tr/+/ /;
	$value =~ s/%([a-fA-F0-9][a-fA-F0-9])/pack("C", hex($1))/eg;
	$variable{$name} = $value;
	print LOG "VAR: $name=$value\n";

	$count++;
	}

require "/home/europost/public_html/config.pl";
$adminid=$myadminid;
&connect_sql;
require "/home/europost/public_html/variables.pl";
require "/home/europost/public_html/globals.pl";
&getdate;
$date = &date;
	
if ($res2468->is_error) 
	{	
	exit;
	}
elsif ( $res2468->content eq 'VERIFIED' ) 
	{
	print LOG "Not any error\n";

	$orderid = $variable{'item_number'};
	$payment_date = $variable{'payment_date'};
	$txn_id = $variable{'txn_id'};
	$payment_status = $variable{'payment_status'};
	$total = $variable{'payment_gross'};
	$pending_reason = $variable{'pending_reason'};
	$total = $variable{'mc_gross'} unless( $total );
	$payer_id = $variable{'payer_id'}; 
	$payer_email = $variable{'payer_email'};
	$currency = $variable{'mc_currency'};


	print LOG "Total: $total\n";
	print LOG "Orderid: $orderid\n";
	
	if( $orderid && ($payment_status eq "Completed" || ($payment_status eq "Pending" && $pending_reason eq "paymentreview")) )
		{
		$SQL = "SELECT oprice, ofuel, obook, oremote, ocust, ovat from orders WHERE orderid=$orderid";
		print LOG "SQL1: $SQL\n";
	
		&my_sql;
		
		if ( $column = $sth->fetchrow_hashref )
			{
			$mytotal_price = toCurr(($column->{'oprice'}+$column->{'ofuel'}+$column->{'obook'}+$column->{'oremote'}+$column->{'ocust'}) + ((($column->{'oprice'}+$column->{'ofuel'}+$column->{'obook'}+$column->{'oremote'}+$column->{'ocust'}) * 2) / 100));
			$mytotal_vat = toCurr($column->{'ovat'} + (($column->{'ovat'} * 2) / 100));
			}
		else
			{
			$mytotal_price = 0;
			$mytotal_vat = 0;
			}
		$mytotalvated = toCurr($mytotal_price + $mytotal_vat);
		$sth->finish;
		print LOG "PayPal price: $total\n";
		print LOG "DBF price: $mytotalvated\n";
				
		if( $mytotalvated eq $total && $currency eq "GBP" )
			{
			$SQL = "UPDATE orders SET status=2, payid='$txn_id', paydate='$payment_date', payerid='$payer_id', payeremail='$payer_email' WHERE orderid=$orderid AND status=1";
			print LOG "SQL2: $SQL\n";
			&my_sql;
			$sth->finish;
			}
		}
}

print LOG "END of notify\n";

close(LOG);

exit;