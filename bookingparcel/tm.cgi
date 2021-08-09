#!/usr/bin/perl -s

use CGI;
use LWP::UserAgent;
use Time::Local;
use CGI qw/:standard/;
use CGI qw(param);


my $timestamp = scalar(localtime());
$time = time();

print "Content-type: text/plain\n\n";


print $timestamp . "\n";
