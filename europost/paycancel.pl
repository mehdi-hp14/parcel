
$heading="bookok";

sub home{
&myheader($heading);

&topmenu($heading);

print qq|

<div class="ha8"><font color="#FF0000" size="2">
<center>
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
Your payment was NOT successfull! However, we will call you soon to follow up your booking.
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
</center>
</font></div>

|;

&footer;

}

1;