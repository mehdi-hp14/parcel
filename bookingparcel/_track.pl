
use CGI; ## load the cgi module
use LWP::UserAgent;
use CGI qw/:standard/;
use CGI qw(param);

sub home{
&myheader("track");

&topmenu("track");

print qq|

?<div class="ha2">
<font size="2" face="Arial">
	<table style="background-color:#FDF3D0; width: 100%" align="left" cellpading="5">
		<tr>
			<td colspan="3" style="width: 600px">
			Please enter the Tracking No. of either DHL or DPD shipment and press Track button.
			</td>
		</tr>
	<form name="form" class="nofrm" method="POST" action="$script">
		<tr>
			<td style="vertical-align: middle; width: 50px" valign="middle"><img src="$scrip/img/services/dhl_logo.gif" width="50" height="50" border="0"></td>
			<td style="vertical-align: middle; width: 300px" valign="middle">DHL Tracking No.:</td>
			<td style="vertical-align: middle; width: 250px" valign="middle"><input name="dhl" style="height:20px;" type="text" size="20" /></td>
		</tr>
		<tr>
			<td style="vertical-align: middle; width: 50px" valign="middle"><img src="$scrip/img/services/dpd_logo.gif" width="50" height="50" border="0"></td>
			<td style="vertical-align: middle; width: 300px">DPD Tracking No.:</td>
			<td style="vertical-align: middle; width: 250px"><input name="dpd" style="height:20px;" type="text" size="20" /></td>
		</tr>
		<tr>
			<td style="vertical-align: middle; width: 50px" valign="middle"><img src="$scrip/img/services/epx_logo.gif" width="50" height="50" border="0"></td>
			<td style="vertical-align: middle; width: 300px"> Europost Express Worldwide Network Agents HAWB No.:</td>
			<td style="vertical-align: middle; width: 250px"><input name="awb" style="height:20px;" type="text" size="15" /></td>
		</tr>
		<tr>
			<td style="vertical-align: middle; width: 50px" valign="middle"><img src="$scrip/img/services/cargo_logo.gif" width="50" height="50" border="0"></td>
			<td style="vertical-align: middle; width: 200px">Cargo HAWB No.:</td>
			<td style="vertical-align: middle; width: 250px"><input name="car1" style="height:20px;" type="text" size="3"  MAXLENGTH=3 /> &nbsp;<input name="car2" style="height:20px;" type="text" size="10" MAXLENGTH=8 /></td>
		</tr>
		<tr>
			<td style="width: 600px" colspan="3" align="center">
			<center><br />
			<input type="submit" value="Track" size="20" />&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" value="Reset" size="20" />
			</center>
			</td>
		</tr>
	<input name="track" type="hidden" value="1" />
	<input name="cf" type="hidden" value="track" />
	</form>
	</table>
	<br />
	<br />
</font>
</div>

|;

&footer;

}

sub getAP
{
	my $code = shift;
	
	my %codes = (
		"303" => "7X",
		"390" => "A3",
		"001" => "AA",
		"057" => "AF",
		"124" => "AH",
		"027" => "AS",
		"105" => "AY",
		"055" => "AZ",
		"125" => "BA",
		"236" => "BD",
		"997" => "BG",
		"695" => "BR",
		"106" => "BW",
		"999" => "CA",
		"230" => "CM",
		"048" => "CY",
		"006" => "DL",
		"118" => "DT",
		"265" => "EF",
		"053" => "EI",
		"071" => "ET",
		"108" => "FI",
		"023" => "FX",
		"126" => "GA",
		"072" => "GF",
		"061" => "HM",
		"075" => "IB",
		"096" => "IR",
		"771" => "J2",
		"201" => "JM",
		"115" => "JU",
		"643" => "KM",
		"229" => "KU",
		"020" => "LH",
		"080" => "LO",
		"724" => "LX",
		"114" => "LY",
		"239" => "MK",
		"129" => "MP",
		"077" => "MS",
		"050" => "OA",
		"064" => "OK",
		"988" => "OZ",
		"214" => "PK",
		"079" => "PR",
		"566" => "PS",
		"656" => "PX",
		"081" => "QF",
		"070" => "RB",
		"421" => "S7",
		"117" => "SK",
		"507" => "SU",
		"065" => "SV",
		"217" => "TG",
		"235" => "TK",
		"270" => "TL",
		"603" => "UL",
		"037" => "US",
		"738" => "VN",
		"870" => "VV",
		"950" => "XS"
		);

	return $codes{$code};
}

sub track{
	unless ($dhl || $dpd || $awb || $car1 || $car2) {&error_page("You must specify a number for tracking"); exit;} 
	
	my $vc = 0;
	
	$vc++ if ($dhl);
	$vc++ if ($dpd);
	$vc++ if ($awb);
	$vc++ if ($car1 || $car2);

	if ($vc > 1) {&error_page("You must specify only one number for tracking. Please go back and specify only one of them."); exit;} 

	if( ($car1 && !$car2) || ($car2 && !$car1) )
		{
		&error_page("You must specify both fields of Cargo HAWB No."); exit;
		}
		
  $t_ua = LWP::UserAgent->new;
  $t_ua->agent("Mozilla/5.0");
  $t_ua->timeout(60);

	if( $dhl )
	{
		@form_data = (
		"pageToInclude" => "RESULTS",
	 	"type" => "fasttrack",
	 	"AWB" => "$dhl"
	 	);
	
		my $t_response = $t_ua->post('http://www.dhl.co.uk/publish/gb/en/eshipping/international_air.high.html',	\@form_data);
	
		if( $t_response->is_success )
			{
			if( $t_response->content =~ m|The service you requested is not available at this time|is )
				{
				error_page("The service you requested is not available at this time. Please try again later."); exit;
				}

			if( $t_response->content =~ m|No Result Found for your Query|is )
				{
				error_page("Could not find the specified number."); exit;
				}
		
			if( $t_response->content =~ m|<DIV\s+id=mainbodydiv(.*?)<input\s|is )
				{
				$dhl_content = "<DIV id=mainbodydiv" . $1;
				
				$dhl_content =~ s|<a\s+(.*?)</a>||sig;
				$dhl_content =~ s|&nbsp; &#45; &nbsp;||sig;
				$dhl_content =~ s|&nbsp([^;])|&nbsp;$1|sig;
				
				$dhl_content =~ s/Result summary/Result summary by DHL/is;
				
				&myheader("trackit");
				&topmenu("trackit");
				
				print qq|
				<div class="ha8">
				$dhl_content
				</div>
				</div>
				<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
				|;
				
				&footer;
				exit;
				}
			else
				{
				if( $t_response->content =~ m|<form name="Form">(.*?)</form>|is )
					{
					$dhl_content = $1;
					
					$dhl_content =~ s|&copy;Copyright.*?</font|</font|sig;
					
#					$dhl_content =~ s/Result summary/Result summary by DHL/is;
					
					&myheader("trackit");
					&topmenu("trackit");
					
					print qq|
					<div class="ha8">
					$dhl_content
					</div>
					</div>
					<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
					|;
					
					&footer;
					exit;
					}
				else
					{
					error_page("Could not load the required information"); exit;
					}
				}
			}
		else
			{
			error_page("The service you requested is not available at this time. Please try again later. (Error:" . $t_response->status_line . ")"); exit;
			}
	}
	elsif( $dpd )
	{
		my $t_response = $t_ua->get("http://www.dpd.co.uk/gsearch.htm?q=$dpd");
	
		if( $t_response->is_success )
			{
			if( $t_response->content =~ m~<DIV\s+id="page_content_full"(.*?)<input\s~is )
				{
				$pdp_content = "<DIV id=\"page_content_full\"" . $1 . "</td>\n</tr>\n</table>\n</div>\n</td>\n</tr>\n</table>\n</div>\n";
				$pdp_content =~ s|<a[^>]+>(.*?)</a>|$1|sig;

				$pdp_content =~ s|<table\s+?class="app-light-row-one"|<table width="100%" class="app-light-row-one"|sig;
			
				$pdp_content =~ s|Track It|<h3>Result summary by DPD</h3>|is;
				
				&myheader("trackit");
				&topmenu("trackit");
				
				print qq|
				<div class="ha8">
				$pdp_content
				</div>
				<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
				|;
				
				&footer;
				exit;
				}
			else
				{
				error_page("Could not load the required information"); exit;
				}
			}
		else
			{
			error_page("The service you requested is not available at this time. Please try again later. (Error:" . $t_response->status_line . ")"); exit;
			}
	}
	elsif( $car1 )
	{
		$apVar = getAP($car1);
		unless( $apVar )
			{
			error_page("The carrier number (3 digits) not found. Please check the number"); exit;
			}

		@form_data = (
		"Carrier" => "$apVar",
	 	"Pfx" => "$car1",
	 	"Shipment" => "$car2");
	
		my $t_response = $t_ua->post('http://www.cargoserv.com/tracking.asp',	\@form_data);
	
		if( $t_response->is_success )
			{
			$tmpcontent = $t_response->content;
			$tmpcontent =~ s|.*?</form>(.*)|$1|is;
			
			if( $tmpcontent =~ m|(<table.*?Current Status.*?</table>)|is )
				{
				$tmpcontent = $1;
				$tmpcontent =~ s|<table(.*?)(<tr.*?</tr>)(.*)</table>|<table$1$3</table>|is;
	
				if( $tmpcontent !~ m/NO RECORD FOUND/s )
					{
					$tmpcontent =~ s/ffffff/FBE79F/gi;
					$tmpcontent =~ s/f8f8f8/FDE9BB/gi;
					$tmpcontent =~ s/dedfdf/9D7B06/gi;
					$tmpcontent =~ s/f1f1f1/F8D358/gi;
	 				
					&myheader("trackit");
					&topmenu("trackit");
					
					print qq|
					<div class="ha8">
					$tmpcontent
					</div>
					<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />					|;
					
					&footer;
					}
				else
					{
					error_page("Could not find the specified number."); exit;
					}
				}
			else
				{
				error_page("Could not load the required information"); exit;
				}
			}
		else
			{
			error_page("The service you requested is not available at this time. Please try again later. (Error:" . $t_response->status_line . ")"); exit;
			}
	}
	else
	{
		$SQL2 = "SELECT entdetails.entid, sr, hawb, weight, item, content, length, width, height, rcontact, rcompany, radd1, radd2, rtown, rcounty, rpcode, rc.country as rcountry, carrier, reference, carriers.abbr as carrier FROM entdetails LEFT JOIN bags on entdetails.entid=bags.entid and entdetails.sr=bags.srid LEFT JOIN countries AS rc ON rc.id=rcountry LEFT JOIN services ON entdetails.carrier=services.id LEFT JOIN carriers on services.carid=carriers.id WHERE hawb='$awb' LIMIT 0, 1"; 

		&my_sql2;
		$i = 0;
		
		if ($column2 = $sth2->fetchrow_hashref)
			{
			if( $column2->{'carrier'} eq "DHL" || $column2->{'carrier'} eq "DPD" )
				{
				if( $column2->{'carrier'} eq "DHL" )
					{
					@form_data = (
					"pageToInclude" => "RESULTS",
				 	"type" => "fasttrack",
				 	"AWB" => "$column2->{'reference'}"
				 	);
				
					my $t_response = $t_ua->post('http://www.dhl.co.uk/publish/gb/en/eshipping/international_air.high.html',	\@form_data);
				
					if( $t_response->is_success )
						{
						if( $t_response->content =~ m|The service you requested is not available at this time|is )
							{
							$sth2->finish;
							error_page("The service you requested is not available at this time. Please try again later."); exit;
							}
			
						if( $t_response->content =~ m|No Result Found|is )
							{
							$sth2->finish;
							error_page("Could not find the specified number."); exit;
							}
					
						if( $t_response->content =~ m|<DIV\s+id=mainbodydiv(.*?)<input\s|is )
							{
							$dhl_content = "<DIV id=mainbodydiv" . $1;
							
							$dhl_content =~ s|<a\s+(.*?)</a>||sig;
							$dhl_content =~ s|&nbsp; &#45; &nbsp;||sig;
							$dhl_content =~ s|&nbsp([^;])|&nbsp;$1|sig;
							
							$dhl_content =~ s/Result summary/Result summary by DHL/is;
							
							&myheader("trackit");
							&topmenu("trackit");
							
							print qq|
							<div class="ha8">
							$dhl_content
							</div>
							</div>
				<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
							|;
				
							$sth2->finish;
							
							&footer;
							exit;
							}
						else
							{
							$sth2->finish;
							error_page("Could not load the required information"); exit;
							}
						}
					else
						{
						$sth2->finish;
						error_page("The service you requested is not available at this time. Please try again later. (Error:" . $t_response->status_line . ")"); exit;
						}
					}				
				else
					{
					my $t_response = $t_ua->get("http://www.dpd.co.uk/gsearch.htm?q=$column2->{'reference'}");
				
					if( $t_response->is_success )
						{
						if( $t_response->content =~ m~<DIV\s+id="page_content_full"(.*?)<input\s~is )
							{
							$pdp_content = "<DIV id=\"page_content_full\"" . $1 . "</td>\n</tr>\n</table>\n</div>\n</td>\n</tr>\n</table>\n</div>\n";
							$pdp_content =~ s|<a[^>]+>(.*?)</a>|$1|sig;
			
							$pdp_content =~ s|<table\s+?class="app-light-row-one"|<table width="100%" class="app-light-row-one"|sig;
						
							$pdp_content =~ s|Track It|<h3>Result summary by DPD</h3>|is;
							
							&myheader("trackit");
							&topmenu("trackit");
							
							print qq|
							<div class="ha8">
							$pdp_content
							</div>
				<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
							|;
							
							$sth2->finish;
							
							&footer;
							exit;
							}
						else
							{
							$sth2->finish;
							error_page("Could not find the specified number."); exit;
							}
						}
					else
						{
						$sth2->finish;
						error_page("The service you requested is not available at this time. Please try again later. (Error:" . $t_response->status_line . ")"); exit;
						}
					}
				}
			else
				{
				if( $column2->{'carrier'} eq "SC" )
					{
					$carrier = "Self Collected";
					}
				elsif( $column2->{'carrier'} eq "EXP" )
					{
					$carrier = "EuroPostExpress Delivery";
					}
				else
					{
					$carrier = "&nbsp;&nbsp;&nbsp;&nbsp;";
					}

				&myheader("trackit");
				&topmenu("trackit");

				$uw0 = ($column2->{'length'} * $column2->{'width'} * $column2->{'height'}) / 4000;
				$uw0 = $column2->{'weight'} if( $column2->{'weight'} > $uw0);
				print qq|
				<div class="ha2">
					<font size="2" face="Arial"><center>
					<table style="background-color:#FDF3D0;" border="1" cellpadding="5" cellspacing="0">
					<tr>
					<td align="left" colspan="2"><b>&nbsp;&nbsp;&nbsp;&nbsp;HAWB $column2->{'hawb'}&nbsp;&nbsp;&nbsp;</b></td>
					</tr>
					<tr>
					<td align="left"><b>Weight </b></td>
					<td align="left">$uw0 <small>kg</small></td>
					</tr>
					<tr>
					<td align="left"><b>No. of Bags </b></td>
					<td align="left">$column2->{'item'}</td>
					</tr>
					<tr>
					<td align="left"><b>Content </b></td>
					<td align="left">$column2->{'content'}</td>
					</tr>|;
					
				if( $column2->{'rcontact'} || $column2->{'rcompany'} || $column2->{'radd1'} || $column2->{'radd2'} || $column2->{'rtown'} || $column2->{'rcounty'} || $column2->{'rpcode'} || $column2->{'rcountry'} )
					{
					print qq|
					<tr>
					<td align="left"><b>Receiver </b></td>
					<td align="left">|;

					if ($column2->{'rcontact'})
						{
						print qq|$column2->{'rcontact'}
|;
						}
	
					if ($column2->{'rcompany'})
						{
						print qq|$column2->{'rcompany'}
|; 
						}

					if ($column2->{'radd1'})
						{
						print qq|$column2->{'radd1'}
|;
						}
	
					if ($column2->{'radd2'})
						{
						print qq|$column2->{'radd2'}
|; 
						}

					if ($column2->{'rtown'})
						{
						print qq|$column2->{'rtown'}
|;
						}

					if ($column2->{'rcounty'})
						{
						print qq|$column2->{'rcounty'}
|;
						}

					if( $column2->{'rpcode'} )
						{
						print qq|$column2->{'rpcode'}
|;
						}

					if ($column2->{'rcountry'})
						{
						print qq|$column2->{'rcountry'}|;
						}

					print qq|</td>
						</tr>|;
					}

					print qq|
					</table></center>|;
					
				if( $column2->{'carrier'} eq "SC" || $column2->{'carrier'} eq "EPX" )
					{
					if( $column2->{'carrier'} eq "SC" )
						{
						print qq|<br /><font color="#FF0000">The HAWB No. is categorized as 'Self Collected' and can not be tracked.</font><br /><br /><br /><br /><br /><br /><br />|;
						}
					else
						{
						print qq|<br /><font color="#FF0000">The HAWB No. is categorized as 'EuroPostExpress Delivery' and can not be tracked.</font><br /><br /><br /><br /><br /><br /><br />|;
						}
					}
				else
					{
					print qq|<br /><font color="#FF0000">The HAWB is not yet received to our office. It will be shipped as soon as we will received it. Please track it later.</font><br /><br /><br /><br /><br /><br /><br />|;
					}
					
				print "</font></div>";
				print "<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />";

				&footer;
				}
			$sth2->finish;
			}
		else
			{
			$sth2->finish;
			error_page("The reference you specied is not found in our database."); exit;
			}
	}
	
}

1;