
$heading="priceok";

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
|;

if( $userprice )
	{
	$SQL = "SELECT username FROM members WHERE userid = $userprice";
	&my_sql;
	
	if ($column = $sth->fetchrow_hashref)
		{
		print "All the Prices saved successfully for agent '$column->{'username'}'.";
		}
	else
		{
		print "All the Prices saved successfully for that agent.";
		}

	$sth->finish;
	}
else
	{
	print "All the Prices saved successfully for that agent.";
	}
	
print qq|
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