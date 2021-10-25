
$heading="service";

sub home{
&myheader($heading);

&topmenu($heading);

print qq|

<div class="ha2" style="width: 984; height: 2053"><h1><font color="#000080" size="3">Cargo&nbsp; &amp; Delivery
Door to Door Services</font></h1>
<a href="#"><img src="img/services/services_02.jpg" alt="express delivery" width="72" height="119" border="0" class="img1 img11 floatl" /></a><span class="text1">
<b><font size="2" face="Arial">EuroPost
Express has major accounts with the world's largest and best courier
companies.</font></b></span><br />
<font size="1" face="Arial">
Thanks to our massive buying power we have
secured huge discounts off their normal selling rates. This in turn allows us
to offer you some of the lowest courier prices in the country!.<br />
</font><a href="$script?index.cgi?cf=rate" class="underline link2">Sample Rates&nbsp;</a><br />
<div class="clear box" style="width: 420; height: 1234"><h1><font color="#000080" size="3" face="Albertus">Customs
Clearance Services</font></h1>
<p class="ha1"><span class="text1">&nbsp;<font size="2" face="Arial"><b>Personal
Effects and commercial Goods Clearing.</b></font></span><br />
<font size="1" face="Arial">
Our highly trained team of professional staff can
offer advice and <br />assistance to our clients on all import related services.
</font></p>
<div class="floatl box2" style="width: 430; height: 179">

<a href="http://www.personaleffectsclearing.co.uk/" class="underline link2 b" target="_blank">Personal
Effects Clearans Entry £35.00 Only</a>

<!--<a href="img/UK%20Clearance%20&amp;%20Collection%20Charges.pdf" class="underline link2 b" target="_blank">Personal
Effects Clearans Entry £35.00 Only</a>-->
<br /><a href="img/UK%20Clearance%20&amp;%20Collection%20Charges.pdf" class="underline link2 b" target="_blank">Commercial
Goods Customs Clearance Entry ££30 only&nbsp;</a></div>
</div><br />
<div class="box clear">
<a href="#" class="floatr underline text1 link1">more</a></div></div>
<div class="ha3 rt">&nbsp;</div>

|;

&footer;

}

1;