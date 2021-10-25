#!/usr/bin/perl -s

#214 51003816

#print "Content-type: text/plain\n\n"; 
#print "The site is currently off-line for scheduled maintenance until 10:00 PM PST.";exit;

#use strict;
use CGI::Carp qw/fatalsToBrowser/;
use Time::Local;
use CGI qw (:standard);

$| = 1;

my @total_price;
my $timestamp = scalar(localtime());
$time = time();
$form = new CGI;
$ip = $form->remote_addr();

@variables = $form->param;

foreach $variables (@variables) 
	{
	${$variables} = $form->param($variables);

	#if(${$variables} =~ /$blocked/i){&error("You are not allowed to use this software");exit;}
	unless($description || $subject || $textmessage || $message || $text || $startpage || $html || $htmlmessage || $delivery_page || $serial_text)
		{
		${$variables} =~s/\'//g;
		}
	}

$cf  = 'payok';

eval { &main; };

if ($@) { &error("$@"); }

sub main{
require "/home/europost/public_html/config.pl";
$adminid=$myadminid;
&connect_sql;
$script="index.cgi";
$scripturl="$DomainURL/index.cgi";
require "/home/europost/public_html/variables.pl";
require "/home/europost/public_html/globals.pl";
&getdate;
$date = &date;

&se_setup unless( $nosettings );

if( $logedout )
	{
	$sessioncookie = "";
	}
else
	{
	$sessioncookie = $form->cookie('userid');
	}


if( $sessioncookie )
	{
	$uidcookie = $form->cookie('uid');
	$TSQL = "SELECT userid, uid FROM users WHERE userid=$sessioncookie AND uid = '$uidcookie' AND (permanent = 1 OR DATE_ADD(lastlogin,INTERVAL 15 MINUTE) >= CURRENT_TIMESTAMP())";
	&tmy_sql;
	
	if($tcolumn = $tsth->fetchrow_hashref)
		{
		$SQL2 = "UPDATE users SET lastlogin=CURRENT_TIMESTAMP() WHERE userid=$tcolumn->{'userid'} AND uid='$tcolumn->{'uid'}'";
		&my_sql2;
		$sth2->finish;
		}
	else
		{
		$sessioncookie = "";
		}
	$tsth->finish;
	}

$fullname = "";

if( $sessioncookie )
	{
	if( $sessioncookie eq $adminid )
		{
		$isUser = $adminid;
		$isAdmin = $adminid;
		$fullname = $form->cookie('fullname');
		}
	else
		{
		$isUser = $sessioncookie;
		$isAdmin = 0;
		$fullname = $form->cookie('fullname');
		}
	}
else
	{
	$isUser = 0;
	$isAdmin = 0;
	}

require "/home/europost/public_html/$cf.pl";

&home;exit;

#print $form->redirect(-url=>"$script");
#&myheader;

}

###################### ERROR ###################
sub error {
print $form->header;
print qq|<html><body><p><center><strong>$_[0]</strong></center></p></body></html>|;
exit;
}

