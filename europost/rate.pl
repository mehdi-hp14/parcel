
$heading="rate";

sub home{
&myheader($heading);

&topmenu($heading);

print qq|

<div class="ha2"><h1><font color="#000080" size="1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;UK Domestic</font></h1>
<span class="text1 b">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;From £5.50 +VAT and Fuel Charges with DHL (up to
10 KG)<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;and DPD ( UP to 30 KG) Express Delivery Service</span>
<div class="clear boxx"><h1><font color="#000080" size="1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Worldwide Air Express</font></h1>
<span class="text1 b">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;From £20.00 .</span>&nbsp;
</div>
<div class="boxx clear"><h1><font color="#000080" size="1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Europ Road Express</font></h1>
&nbsp;<span class="text1 b">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;From £12.00 (up to 30 KG) with DHL<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;and DPD delivery
Service</span>
<br /><br /><br />
<a href="#"><img src="img/rates/rates_04.jpg" alt="express delivery" width="59" height="93" border="0" class="img1 floatl" /></a></div><a href="#" class="floatr underline text1 link1">more</a></div>

|;

&footer;

}

1;