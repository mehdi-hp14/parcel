
$heading="orderdel";

sub home{
&myheader($heading);

&topmenu($heading);

print qq|

<div class="ha8"><font color="#009933" size="2">
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
Booking has been deleted successfully.
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