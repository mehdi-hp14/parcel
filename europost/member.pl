
$heading="member";

sub home{
&myheader($heading);

&topmenu($heading);

print qq|
<div class="ha8">
|;
if( $isAdmin )
	{
	print qq|<a href="$script?cf=members&viewall=1&userid=$isAdmin"><img alt="View Agents/Members" style="vertical-align: middle;" src="img/content/agents.gif" width="30" height="28" border = "0"></a>
	&nbsp;<a href="$script?cf=members&viewall=1&userid=$isAdmin" class="underline link2">View Agents/Members</a>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="$script?cf=orders&viewall=1&userid=$isAdmin"><img alt="View Bookings" style="vertical-align: middle;" src="img/content/quote.gif" width="30" height="28" border = "0"></a>
	&nbsp;<a href="$script?cf=orders&viewall=1&userid=$isAdmin" class="underline link2">View Bookings</a>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="$script?cf=settings&userid=$isAdmin"><img alt="Settings" style="vertical-align: middle;" src="img/content/settings.gif" width="30" height="28" border = "0"></a>
	&nbsp;<a href="$script?cf=settings&userid=$isAdmin" class="underline link2">Global Settings</a>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="$script?cf=price"><img alt="Prices" style="vertical-align: middle;" src="img/content/prices.gif" width="30" height="28" border = "0"></a>
	&nbsp;<a href="$script?cf=price" class="underline link2">Prices</a>
	<br /><br /><hr width="100%" size="1" noshade /><br /><br />|;
	
#	if( $origip eq "89.165." )
#		{
#		require "/home/europost/public_html/entry2.pl";
#		}
#	else		
#		{
		require "/home/europost/public_html/entry.pl";
#		}
	
	&viewall(1);
	}
else
	{
	print qq|
	<a href="$script?cf=entry&entry=1&userid=$isUser"><img alt="New Delivery and Shipment" style="vertical-align: middle;" src="img/content/newentry.gif" width="30" height="28" border = "0"></a>
	&nbsp;<a href="$script?cf=entry&entry=1&userid=$isUser" class="underline link2">New Delivery and Shipment</a>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
	<a href="$script?cf=members&view=1&memid=$isUser"><img alt="View Profile Information" style="vertical-align: middle;" src="img/content/agents.gif" width="30" height="28" border = "0"></a>
	&nbsp;<a href="$script?cf=members&view=1&memid=$isUser" class="underline link2">View Profile Information</a>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
	<a href="$script?cf=members&edit=1&memid=$isUser"><img alt="Edit Profile Information" style="vertical-align: middle;" src="img/content/edit.gif" width="30" height="28" border = "0"></a>
	&nbsp;<a href="$script?cf=members&edit=1&memid=$isUser" class="underline link2">Edit Profile Information</a>
	<br /><br /><hr width="100%" size="1" noshade />	
	<br /><br />|;

#	if( $origip eq "89.165." )
#		{
#		require "/home/europost/public_html/entry2.pl";
#		}
#	else
#		{
		require "/home/europost/public_html/entry.pl";
#		}
	&viewall(1);
	}
print qq|
</div>
|;


&footer;

}

1;