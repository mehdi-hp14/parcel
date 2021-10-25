
$heading="thankreg";

sub home{
&myheader($heading);

&topmenu($heading);

print qq|

<div class="ha2"><font color="#009933" size="2">
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
Thank you for your registration. An email will be sent to you soon regarding your registration.
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
</font></div>

|;

&footer;

}

1;