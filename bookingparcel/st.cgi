#!/usr/bin/perl -s

use CGI::Carp qw/fatalsToBrowser/;
use Time::Local;
use CGI qw (:standard);

$| = 1;

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

print "Content-type: text/plain\n\n";

open(DATA, "<$filein");
@lines = <DATA>;
close(DATA);

$time = int($time);

if( $str )
	{
	$turn = 0;
	}
else
	{
	$turn = 1;
	}

for( $i = 0 ; $i <= $#lines ; $i++ )
{
	if( $lines[$i] =~ m~^(\d{2}):(\d{2}):(\d{2})([,\d\s]+-->\s+)(\d{2}):(\d{2}):(\d{2})([,\d\s]+)$~ )
		{
		if( $turn )
			{
			my ($f1, $f2, $f3, $t1, $t2, $t3, $x1, $x2);
			$f1 = $1;
			$f2 = $2;
			$f3 = $3;
			$x1 = $4;
			$t1 = $5;
			$t2 = $6;
			$t3 = $7;
			$x2 = $8;
			
			$f3 = $f3 + $time;
			if( $f3 >= 60 )
				{
				$f3 = $f3 - 60;
				$f2 = $f2 + 1;
				if( $f2 >= 60 )
					{
					$f2 = $f2 - 60;
					$f1 = $f1 + 1;
					}
				}

			if( $f3 < 0 )
				{
				$f3 = $f3 + 60;
				$f2 = $f2 - 1;
				if( $f2 < 0 )
					{
					$f2 = $f2 + 60;
					$f1 = $f1 - 1;
					}
				}

			$t3 = $t3 + $time;
			if( $t3 >= 60 )
				{
				$t3 = $t3 - 60;
				$t2 = $t2 + 1;
				if( $t2 >= 60 )
					{
					$t2 = $t2 - 60;
					$t1 = $t1 + 1;
					}
				}

			if( $t3 < 0 )
				{
				$t3 = $t3 + 60;
				$t2 = $t2 - 1;
				if( $t2 < 0 )
					{
					$t2 = $t2 + 60;
					$t1 = $t1 - 1;
					}
				}

			printf("%02d:%02d:%02d%s%02d:%02d:%02d%s", $f1, $f2, $f3, $x1, $t1, $t2, $t3, $x2);
			}
		else
			{
			print $lines[$i];
			}
		}
	else
		{
		if( $lines[$i] =~ m/$str/i )
			{
			$turn = 1;
			}
		print $lines[$i];
		}
}


1;