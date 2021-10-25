
$heading="contact";

sub home{
&myheader($heading);

&topmenu($heading);

print qq|

<div class="ha2"><h1><font color="#000080" size="2">Contact Information</font></h1>
&nbsp;
<span class="text1 b">Europost Express</span>  755 HARROW ROAD 
<p>&nbsp;Wembley  Middlesex</p>
<p>&nbsp;HA0 2LW</p>
<p>Phone: +44 0203 255 2056&nbsp;<br />
Fax: +44 0208 9086947</p>
<p>Email:    <a href="mailto:$myemail" class="underline text11">$myemail</a></p>
<div class="clear boxx" style="width: 326; height: 213"><h1><font color="#000080" size="2">Message
Form</font></h1>
<p>&nbsp;</p>
<form id="form1" name="form1" method="post" action=""><table border="0" cellspacing="0" cellpadding="0">
<tr>
<td class="box1"><input class="i1"  onblur="if(this.value==''){this.value='Your Name:';}" onfocus="if(this.value=='Your Name:'){this.value='';}" value="Your Name:" name="in1"/><br /><input class="i1"  onblur="if(this.value==''){this.value='Your Phone:';}" onfocus="if(this.value=='Your Phone:'){this.value='';}" value="Your Phone:" name="in1"/><br /><input class="i1"  onblur="if(this.value==''){this.value='Your Fax:';}" onfocus="if(this.value=='Your Fax:'){this.value='';}" value="Your Fax:" name="in1"/><br /><input class="i1"  onblur="if(this.value==''){this.value='Your Email:';}" onfocus="if(this.value=='Your Email:'){this.value='';}" value="Your Email:" name="in1"/><br /><input class="i1"  onblur="if(this.value==''){this.value='Your Skype Name:';}" onfocus="if(this.value=='Your Skype Name:'){this.value='';}" value="Your Skype Name:" name="in1"/></td><td><textarea name="in3" class="t" onblur="if(this.value==''){this.value='Message:';}" onfocus="if(this.value=='Message:'){this.value='';}" rows="1" cols="20" >Message:</textarea></td>
</tr>
</table><div class="rt"><a href="javascript:void(0);" onclick="javascript:document.form1.reset();"><img src="img/contact/contact_04.gif" alt="clear" width="50" height="24" border="0" class="img1" /></a><a href="javascript:void(0);" onclick="javascript:document.form1.submit();"><img src="img/contact/contact_05.gif" alt="send" width="50" height="24" border="0" /></a></div></form></div><div class="box"><h1>&nbsp;</h1>
&nbsp;&nbsp;</div></div>

|;

&footer;

}

1;