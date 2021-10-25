<? 

	 echo $body = '<html><head><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /><title>Untitled Document</title>
<link href="http://'.stripslashes($domain).'/css/mail.css" rel="stylesheet" type="text/css" /></head><body style="font-family: Arial, Helvetica, sans-serif;font-size:12px;font-weight:normal;color:#000000;"><table width="100%" border="0" cellspacing="0" cellpadding="0" ><tr><td><table width="661" border="0" align="center" cellpadding="0" cellspacing="0" ><tr ><td><img src=http://'.stripslashes($domain).'/images/logo.gif width="207" height="40" /></td>
        <td align="right" valign="bottom"><a href=http://'.stripslashes($domain).'/listings/sell.html><img src=http://'.stripslashes($domain).'/images/faribaba_03.gif  border=0></a>&nbsp;<a href=http://'.stripslashes($domain).'/"listings/buy.html"><img src=http://'.stripslashes($domain).'/images/faribaba_04.gif border=0></a>&nbsp;<a href=http://'.stripslashes($domain).'/General.html?file=General><img src=http://'.stripslashes($domain).'/images/faribaba_08.gif border=0> </td></tr></table>
      <table width="661" border="0" align="center" cellpadding="0" cellspacing="0" class="tablebg">
      <tr><td valign="top">
	  <table width="100%" border="0" cellspacing="0" cellpadding="0"><tr>
      <td style="padding:6px;"  valign="top">
      <span class="subtitle">'.$rs0["es_subject"].'</span><span class="sub-subtitle">
	  <strong>Dear '.$rs0["es_firstname"].'&nbsp;'.$rs0["es_lastname"].'</strong></span></td></tr>
	  </table>
	 
     <table width=100% border="0" align="LEFT" cellpadding="5" cellspacing="3" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">
		
	<tr ><td width=10% align=left > First Name: </td><td width=30% align=left >'.$rs0["es_firstname"].'</td></tr>
	<tr ><td width=10% align=left > Last Name: </td><td width=30% align=left >'.$rs0["es_lastname"].'</td></tr>
	<tr ><td width=10% align=left > Username: </td><td width=30% align=left >'.$rs0["es_username"].'</td></tr>
	<tr ><td width=10% align=left > Password : </td><td width=30% align=left >'.$rs0["es_password"].'</td></tr>
	<tr ><td width=10% align=left > Email : </td><td width=30% align=left >'.$rs0["es_email"].'</td></tr>
		<tr ><td width=10% align=left > Login Url : </td><td width=30% align=left ><a href="http://'.stripslashes($domain).'/signin.php"  class="bottomlink">http://'.stripslashes($domain).'/signin.php</a></td></tr>
	<tr ><td  align=left colspan=2 > <br /><br /><strong>
	<p>Thank you for registering with World Traders Network, the online B2B global $domain_url,trading community. Our aim is to maximise the exposure of your company and products / services to a global $domain_url,audience; creating and increasing the number of enqiries and sales from potential clients. Please login into the site with your registered username & password and then add your companys profile, product catalogues, selling & buying offers and classified ads. If you have any further questions relating to the site or functions. </p></strong> </td></tr>
	<tr ><td  align=left colspan=2 ><br /><br /><br /> <strong>Regards,<br>Admin</strong> </td></tr>
    </table></td></tr> </table></td></tr></table>
    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber1">
<tr><td width="100%" align="center" style="font:Verdana;"><a href="#"><strong>CompanyInfo</strong></a> - <a href="#"><strong>Partnerships</strong></a><br /><a href=http://'.stripslashes($domain).'/>Home</a> -<a href="http://'.stripslashes($domain).'/listings/sell.html" class="bottomlink">Sell_Offers</a> - <a href="http://'.stripslashes($domain).'/listings/buy.html"  class="bottomlink">Buy_Offers</a> - <a href="http://'.stripslashes($domain).'/listings/product.html" class="bottomlink">Products</a> - <a href="http://'.stripslashes($domain).'/listings/profile.html"  class="bottomlink">Companies</a> - <a href="http://'.stripslashes($domain).'/forums.html"  class="bottomlink">Classifieds</a> - <a href="http://'.stripslashes($domain).'/biz_directory.html"  class="bottomlink">Directory</a>
</tr>
</table>
  </tr>
</table>
</body>
</html>';
$subject = "";
$header="From:" . $from . "\r\n" ."Reply-To:". $from  ;

			$header .= "MIME-Version: 1.0\r\n";
			$header .= "Content-type: text/html; charset=iso-8859-1\r\n";
			$to1= "farrukh@b2bspecial.com"; 
					mail($to1,$subject,$body,$header);
			
			
			

?>