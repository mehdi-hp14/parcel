
$heading="sendpass";

sub home{
&myheader($heading);

&topmenu($heading);

print qq|

<div class="ha2"><font color="#009933" size="2">
Your password has sent to your registered email address successfully.
</font></div>

|;

&footer;

}

1;