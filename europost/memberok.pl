
$heading="member";

sub home{
&myheader($heading);

&topmenu($heading);

print qq|

<div class="ha8"><font color="#009933" size="2">
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<center>Agent Information saved successfully.</center>
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
</font></div>

|;

&footer;

}

1;