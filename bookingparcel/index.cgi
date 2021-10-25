#!/usr/bin/perl -s

#214 51003816

#print "Content-type: text/plain\n\n"; 
#print "The site is currently off-line for scheduled maintenance until 10:00 PM PST.";exit;

#use strict;
use CGI::Carp qw/fatalsToBrowser/;
use Time::Local;
use CGI qw (:standard);

$| = 1;

BEGIN {
    my $b__dir = (-d $homedir .'/perl'?$homedir .'/perl':( getpwuid($>) )[7].'/perl');
    unshift @INC,$b__dir.'5/lib/perl5',$b__dir.'5/lib/perl5/x86_64-linux-thread-multi',map { $b__dir . $_ } @INC;
}

my @total_price;
my $timestamp = scalar(localtime());
$time = time();
$form = new CGI;
$ip = $form->remote_addr();
$origip = substr($ip, 0, 7);
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

$cf  = 'home' unless( $cf );

eval { &main; };

if ($@) { &error("$@"); }

sub main{
require "/home/europost/public_html/config.pl";
$adminid=$myadminid;
&connect_sql;
$script="index.cgi";
$scripturl="$DomainURL/index.cgi";
require "/home/europost/public_html/variables.pl";

#if( $origip eq "188.34." )
#	{
#	require "/home/europost/public_html/globals2.pl";
#	}
#else
#	{
	require "/home/europost/public_html/globals.pl";
#	}
	
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
	$TSQL = "SELECT userid, uid FROM users WHERE userid=$sessioncookie AND uid = '$uidcookie' AND (permanent = 1 OR DATE_ADD(lastlogin,INTERVAL 1 DAY) >= CURRENT_TIMESTAMP())";
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

if( $cf eq "home" && ($isAdmin || $isUser) )
	{
	$cf = "member";
	$userid=$isUser;
	}

#if($cf eq "book" && !$isAdmin)
#	{
#	$cf = "construct";
#	}

#if($cf eq "book" && $origip eq "188.34.")
#	{
#	$cf = "book2";
#	}

require "/home/europost/public_html/$cf.pl";

unless($adminid){&error_page("Admin ID not defined. You must login as administrator to access this page."); exit;}

if($members){&members;exit;}
if($register){&register;exit;}
if($lostpass){&lostpassword;exit;}
if($sendpass){&sendpassword;exit;}
if($track){&track;exit;}
if($login){&login;exit;}
if($process){&process;exit;}

if(substr($cf, 0, 4) eq "book")
	{ 
	if( $book eq "1" ){&book1;exit;}
	if( $book eq "2" ){&book2;exit;}
	if( $book eq "3" ){&book3;exit;}
	if( $book eq "4" ){&book4;exit;}
	if( $book eq "5" ){&book5;exit;}
	if( $book eq "6" ){&book6;exit;}
	if( $getpb ){&fetch_pb($getpb);exit;}
	if( $getadd ){&fetch_add($getadd);exit;}
	}
	
if($cf eq "member")
	{
	if ($sessioncookie ne $userid)
		{
		error_page("Unauthorized access. Please login in order to access the agent/member area."); exit;
		}
	}


if( $cf eq "entry" ) #|| $cf eq "entry2" )
	{
	if ($isAdmin || $isUser)
		{
		if( $entry eq "1" ){&entry1;exit;}
		if( $entry eq "2" ){ &entry2;exit;}
		if( $import eq "1" ){&import1;exit;}
		if( $import eq "2" ){&import2;exit;}
		}
	else
		{
		&error_page("Your session has been expired, Please Login."); exit;
		}
	}

if($cf eq "settings")
	{
	unless ($isAdmin)
		{
		error_page("Unauthorized access. Please login in order to access this section."); exit;
		}
	}

if($view){if ($isAdmin || $isUser){&view;exit;}else{&error_page("Your session has been expired, Please Login."); exit;}}
if($delete){if ($isAdmin || $isUser){&delete;exit;}else{&error_page("Your session has been expired, Please Login."); exit;}}
if($printit){if ($isAdmin || $isUser){&printit;exit;}else{&error_page("Your session has been expired, Please Login."); exit;}}
if($printawb){if ($isAdmin || $isUser){&printawb;exit;}else{&error_page("Your session has been expired, Please Login."); exit;}}
if($viewall){if ($isAdmin || $isUser){&viewall;exit;}else{&error_page("Your session has been expired, Please Login."); exit;}}
if($printlist){if ($isAdmin || $isUser){&printlist;exit;}else{&error_page("Your session has been expired, Please Login."); exit;}}
if($getcargo){if ($isAdmin || $isUser){&getcargo;exit;}else{&error_page("Your session has been expired, Please Login."); exit;}}
if($getflight){if ($isAdmin || $isUser){&getflight;exit;}else{&error_page("Your session has been expired, Please Login."); exit;}}
if($add){if ($isAdmin || $isUser){&add;exit;}else{&error_page("Your session has been expired, Please Login."); exit;}}
if($edit){if ($isAdmin || $isUser){&edit;exit;}else{&error_page("Your session has been expired, Please Login."); exit;}}
if($hold){if ($isAdmin || $isUser){&hold($hold);exit;}else{	print "Content-type: text/plain\n\n"; print "Your session is expired. Please Login again!"; exit;}}
if($estimate){if ($isAdmin || $isUser){&estimate;exit;}else{&error_page("Your session has been expired, Please Login."); exit;}}
if($credit){if ($isAdmin || $isUser){&credit;exit;}else{&error_page("Your session has been expired, Please Login."); exit;}}
if($activate){if ($isAdmin){&activate($activate);exit;}else{&error_page("Your session has been expired, Please Login."); exit;}}
if($changestatus){if ($isAdmin){&changestatus($changestatus);exit;}else{&error_page("Your session has been expired, Please Login."); exit;}}
if($suspend){if ($$isAdmin){&suspend;exit;}else{&error_page("Your session has been expired, Please Login."); exit;}}
if($terminate){if ($isAdmin){&terminate;exit;}else{&error_page("Your session has been expired, Please Login."); exit;}}
if($priority){if ($isAdmin){&priority;exit;}else{&error_page("Your session has been expired, Please Login."); exit;}}
if($save){if ($isAdmin){&save;exit;}else{	print "Content-type: text/plain\n\n"; print "Your session is expired. Please Login again!"; exit;}}
if($paid){if ($isAdmin){&paid($paid);exit;}else{	print "Content-type: text/plain\n\n"; print "Your session is expired. Please Login again!"; exit;}}
if($csved){if ($isAdmin){&csved($csved);exit;}else{	print "Content-type: text/plain\n\n"; print "Your session is expired. Please Login again!"; exit;}}
if($checkservice){if ($isAdmin){&checkservice;exit;}else{	print "Content-type: text/plain\n\n"; print "Your session is expired. Please Login again!"; exit;}}
if($getserv){if ($isAdmin){&fetch_serv($getserv);exit;}else{&error_page("Your session has been expired, Please Login."); exit;}}
if($getzone){if ($isAdmin){&fetch_zone($getzone);exit;}else{&error_page("Your session has been expired, Please Login."); exit;}}
if($editzone){if ($isAdmin){&editzone;exit;}else{&error_page("Your session has been expired, Please Login."); exit;}}
if($savezone){if ($isAdmin){&savezone;exit;}else{&error_page("Your session has been expired, Please Login."); exit;}}
if($assign){if ($isAdmin){&assign;exit;}else{&error_page("Your session has been expired, Please Login."); exit;}}
if($csv){if ($isAdmin){&csv($csv);exit;}else{&error_page("Your session has been expired, Please Login."); exit;}}
if($epxcbenable){if ($isAdmin){&epxcbenable($epxcbenable);exit;}else{&error_page("Your session has been expired, Please Login."); exit;}}

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

