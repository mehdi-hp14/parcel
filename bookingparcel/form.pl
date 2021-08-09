
$heading="form";

sub home{
&myheader($heading);

&topmenu($heading);

print qq|

<div class="ha2"><h1><font color="#000080" size="1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Useful Forms</font></h1>
<br />
<a href="forms/DocumentsListforPersonalEffects.pdf" class="underline link2">Documents List for Personal Effects</a><br /><br />

<a href="forms/C3FormForPersonalEffects.pdf" class="underline link2">C3 Form for Personal Effects</a><br /><br />

<a href="forms/C105A_ForHighValueMoreThan6500BP.pdf" class="underline link2">C105A Form For High Value more than £6500</a><br /><br />
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
|;

&footer;

}

1;