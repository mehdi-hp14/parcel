#!/usr/bin/perl -s

#214 51003816

#print "Content-type: text/plain\n\n"; 
#print "The site is currently off-line for scheduled maintenance until 10:00 PM PST.";exit;

#use strict;
use CGI::Carp qw/fatalsToBrowser/;
use Time::Local;
use CGI qw (:standard);

open(TSTLOG, ">>/home/europost/public_html/log.txt");
print TSTLOG "In Notify\n";
close(TSTLOG);
