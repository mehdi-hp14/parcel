$heading="home";

sub home{
&myheader($heading);

&topmenu($heading);

print qq|

<div class="ha2" style="width: 688; height: 665"><h1><img src="img/index/index_01.gif" alt="welcome to our web site" width="170" height="16" /></h1>
<font size="2" face="Arial">
<a href="#"><img src="img/index/index_02.gif" alt="express delivery" width="123" height="112" border="0" class="floatl img1" /></a></font><span class="text1"><font face="Arial"><b><font size="2">EuroPost Express (UK) &nbsp; can always provide you with the flexibility</font></b><font size="2">.</font></font></span><br /> <font size="1" face="Arial"> EuroPost
Express (UK) Ltd would like to take this opportunity to introduce you to our
company.
</font>
<p><font size="1" face="Arial">&nbsp;<span style="font-family: Times New Roman; ">At
EuroPost Exoress (UK) we offer a one-stop solution for all your domestic and
international distribution requirements.</span></font></p>

<div class="clear box" style="width: 218; height: 263">
<table border="0" cellspacing="0" cellpadding="0">
<tr class="box1">
<td class="box1">
<form name="form" method="post" action="$script">
<b>Login:</b><br />
<input type="hidden" name="cf" value="login">
<input type="hidden" name="login" value="1">
<input class="i"  type="text" value="" name="username"/><br />
<input class="i"  type="password" value="" name="password" /><br />
<input type="checkbox" value="1" name="savelogin" style="vertical-align: top; border:0px;" />&nbsp;Remember Me.<br />
<div class="rt"><input type="image" src="img/index/index_04.gif" alt="Enter" width="49" height="24" border="0" /></div></form>
<div class="rt"><a href="$script?cf=members" class="underline text1 link1">Register</a><br />
<a href="$script?cf=members&lostpass=1" class="underline text1 link1">Forget your password</a></div></td>
<td>
<font face="Arial">
<span class="text1"><font size="2" face="Arial"><b>We offer you very competetive cost courier rates because we are in cooperation with 
some of the biggest carriers and shipping lines in the world</b>.</font></span><br />
<font size="1" face="Arial">
<span style="font-family: Times New Roman; ">You can get a competitive price by visiting the <br />
<a href="index.cgi?cf=book&book=1">Quote and Booking</a> section</span>.</font></font></td>
</tr>
</table>
</div><div class="box" style="width: 251; height: 151"><h1><font color="#000080" size="1">Packing Advise</font></h1>
<b>
<font size="2" face="Arial">
<a href="#"><img src="img/index/index_07.jpg" alt="express delivery" width="85" height="86" border="0" class="floatl img1" /></a>&nbsp;<span class="text1">
Our Advice</span></font></b><br />
<font size="1" face="Arial">
Boxes should be durable and double-walled.
Remember that items will get stacked in transit, therefore your packaging
may need to support the weight of other packages. .</font>
<a href="#" class="floatr underline text1 link1">more</a></div></div>

|;

&footer;

}

1;