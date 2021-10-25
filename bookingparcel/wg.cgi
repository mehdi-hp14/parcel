#!/usr/bin/perl -s

use CGI::Carp qw/fatalsToBrowser/;
use Time::Local;
use CGI qw (:standard);
 
$| = 1;

$form = new CGI;
@variables = $form->param;

foreach $variables (@variables) 
	{
	${$variables} = $form->param($variables);
	}

print "Content-type: text/plain\n\n"; 

#system( "wget", "-O /home/europost/public_html/dn/$to", "$from");
my $output = qx|wget c -O /home/europost/public_html/dn/$to $from|;

print $output;

#print $!;

print "\n\nDownloaded from\n\n$from\n\nTO\n\n/home/europost/public_html/dn/$to";

1;