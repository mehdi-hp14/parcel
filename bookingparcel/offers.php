<?php



include_once "configure.php";



include_once "functions.php";



include_once "language.php";

//////////---------



function main()

{
include($_SESSION['lang'].".php");
global $domain_url,$esrow_off,$uid,$id,$prod,$name,$domain,$index123,$domain_url;
//$id=$_REQUEST['id'];	//		again defined to counter an error 	
$config=mysql_fetch_array(mysql_query("select * from esb2b_config"));
if(($config["es_image_magik"]=="enable"))
{
$img_path=$domain_url."/thumbs2/";
$img_pmt="";
}
else
{
$img_path=$domain_url."/uploadedimages/";
$img_pmt="width=".$config["es_th_width2"]." height=".$config["es_th_width2"];
}
$send_inquiry_icon="esb2b_icons/inquireseller.gif";
$inquiry_basket_icon="esb2b_icons/inquirebasket.gif";
$contact_list_icon="esb2b_icons/addcontact.gif";
$block_list_icon="esb2b_icons/addblock.gif";
$add_fav_icon="esb2b_icons/addfav.gif";
$company_profile_icon="esb2b_icons/viewcompany.gif";

$cid=0;
$keyword="";
if(isset($_REQUEST["cid"])&&($_REQUEST["cid"]<>""))
{
$cid=$_REQUEST["cid"];
}
if(isset($_REQUEST["keyword"])&&($_REQUEST["keyword"]<>""))
{
$keyword=$_REQUEST["keyword"];
}
$catname="";
$category=0;
$cat_query=mysql_query("Select * from esb2b_categories where es_id=" . $cid );
if ($cat=mysql_fetch_array($cat_query))
{
$catname=$cat["es_cat_name"];
$category=$cat["es_id"];
}
$catpath="";
$cat_query=mysql_query("Select * from esb2b_categories where es_id=" . $cid );
while ($rs=mysql_fetch_array($cat_query))
{
$catpath =" > <a href=".$domain_url."/categories/sell/".$rs["es_id"]."/".URLsafe($rs["es_cat_name"]).".html>" .$rs["es_cat_name"]."</a>".$catpath; 
$cat_query=mysql_query("Select * from esb2b_categories where es_id=" . $rs["es_pid"] );
}
if($_GET["prod"]=="sell"){

if($_GET['id']!=""){
//echo "ID : ".$id=$_GET['id'];
$id=$_GET['id'];
//echo "select * from esb2b_offers where es_id=$id";
$esq_row=mysql_fetch_array(mysql_query("select * from esb2b_offers where es_id=$id"));
$title = $$esq_row["title"];
$esq_img="select * from esb2b_offer_images where es_offer_id=$id";
}
}else{

$esq_row=mysql_fetch_array(mysql_query("select * from esb2b_products where es_id=$id"));
$esq_img="select * from esb2b_product_images where es_offer_id=$esq_row[es_id]";
}
$esrs_img=mysql_query($esq_img);
$esrow_img=mysql_fetch_array($esrs_img);
//echo "select * from esb2b_companyprofiles where es_uid=".$esq_row[es_uid];
$profile12=mysql_fetch_array(mysql_query("select * from esb2b_companyprofiles where es_uid=".$esq_row[es_uid]));
$mem=mysql_fetch_array(mysql_query("select * from esb2b_members where es_id=".$esq_row["es_uid"]));
//echo "<br>select * from esb2b_members where es_id=".$esq_row["es_uid"];
$uid = $esq_row["es_uid"];



/* Enquiry Message */
if(isset($_REQUEST['submit'])) 
{
$_SESSION['message']=$_REQUEST[message];
   
header('Location: contactuser.php?es_type=4&es_id='.$name);

}




?> 

<script language="JavaScript">
function win(box)
{
str="<?=$domain_url?>/add_to_contact_pp.html?"  + box;
window.open(str,"Allot","top=5,left=30,toolbars=no,maximize=yes,resize=yes,width=350,height=150,location=no,directories=no,scrollbars=yes");
return false;
}

function win1(box)
{
str="<?=$domain_url?>/add_to_block_pp.html?"  + box;
window.open(str,"Allot","top=5,left=30,toolbars=no,maximize=yes,resize=yes,width=350,height=150,location=no,directories=no,scrollbars=yes");
return false;
}
</script>

<style type="text/css" media="all">
@import url( <?=$domain_url?>/images5/relateJS.css);
@import url( <?=$domain_url?>/images5/layout.css )
@import url( <?=$domain_url?>/images5/layout.css );
@import url( <?=$domain_url?>/images5/font.css );
@import url( <?=$domain_url?>/images5/common.css );
@import url( <?=$domain_url?>/images5/component.css );
@import url( <?=$domain_url?>/images5/style.css );
@import url( <?=$domain_url?>/images5/offers.css );
</style>
<script language="javascript" src="<?=$domain_url?>/images5/ae.js" charset="iso-8859-1"></script>
<script language="javascript" src="<?=$domain_url?>/images5/aisn.js" charset="iso-8859-1"></script>
<!-- base href="http://mxelc.en.mindvisionpk.com/" -->
<style type="text/css">
<!--
.style1 {font-size: 36px}

.Formbx {
	font-family:Arial;
	font-size: 12px;
	font-weight:bold;
	margin::10px 0 0;
	padding:2px 10px;
	text-align:left;
	border-bottom:1px dotted #9e9e9e;
    padding:4px 4px 4px 8px;
}
.Formbx_boom {

	font-family:Arial;
	font-size: 80%;
	border-bottom:1px solid #CCCCCC;
    padding:4px 4px 4px 8px;
	text-align:left;
	font-weight:lighter;
    vertical-align:top;

}
.supply_boom
{
font-family:Arial;
font-size:18px;
color:black;
line-height:1em;
font-weight:normal;
}
.but_supply_boom{
background:url(images/send.gif);
height:30px;
width:100px;
border:medium none;
}
-->
</style>

<td valign="top">
<? if($_SESSION['lang']=="arabic"){?>
<div class="ProductGroup_arb">
<div class="ProductGroupCurrent_arb" style="text-align:right;"><br />
<? if($esrow_img['es_img_url']!=""){?>
<img src="<?php echo $img_path?><? echo $esrow_img['es_img_url'] ?>" width="40" height="40" hspace="6" /> <? }?><br>
<? echo $esq_row["es_title"]; ?> </div>
<div class="detailMain hackborder" style="float:right">
<? }else{?>
<div class="ProductGroup">
<div class="ProductGroupCurrent"><br />
<? if($esrow_img['es_img_url']!=""){?>
<img src="<?php echo $img_path?><? echo $esrow_img['es_img_url'] ?>" height="40" width="40" /> <? }?><? echo $esq_row["es_title"]; ?> </div>
<div class="detailMain hackborder" >
<? }?>	   
<table width="100%">
<tr>
<td style="padding-left:9px;">
<h1> <? echo $esq_row["es_title"]; ?> </h1>
<? if($esrow_img['es_img_url']!=""){?>
<a href="<?=$domain_url?>/uploadedimages/<?php echo $esrow_img["es_img_url"]; ?>" target="_blank">
<img src="<?php echo $img_path?><? echo $esrow_img['es_img_url'] ?>" border="0" <? echo $img_pmt1; ?>></a>	
<? }?>
<div class="detailSummary">
<table class="tables data" border="0" cellpadding="0" cellspacing="0" width="100%">
<tr>
<td class="date-head" width="23%"><? echo $Posted_On  ?>: </td>
<td width="29%"><div class="date"> <?php echo $esq_row["es_postedon"];?></div> </td>
<td class="date-head" width="24%"><? echo $Location ?>:  </td>
<td width="24%"><div class="date"><?php echo $esq_row["es_location"]; ?> </div> </td>
</tr>
	
<tr>
<td class="date-head" width="23%"><? echo $Price ?>: </td>
<td width="29%"> <div class="date">
<?php 
$esq_cur="select * from esb2b_currencies where escur_id=".$esq_row["es_price_cur_id"];
$esrow_cur=mysql_fetch_array(mysql_query($esq_cur));
echo $esrow_cur['escur_symbol'].' '.$esq_row["es_price"]; 
?>						
</div> </td>
<td class="date-head" width="24%"> <? echo $ShippingCost  ?>:  </td>
<td width="24%"><div class="date"> 
<?php echo $esrow_cur['escur_symbol'].' '.$esq_row["es_shipping_cost"]; ?>
</div></td>
</tr>	

<tr>
<td class="date-head" width="23%"> <? echo $Samples_Available ?>: </td>
<td width="29%"> <div class="date"> <?php echo $esq_row["es_samples_available"]; ?> </div> </td>
<td class="date-head" width="24%"> <? echo $Minimum_Order ?>:  </td>
<td width="24%"> <div class="date"> <?php echo $esq_row["es_min_order"]; ?> </div></td>
</tr>

<tr > 
<td class="date-head" width="23%" > <? echo "$Product_Status" ?>:</td>
<td width="29%"> <div class="date"><?php echo $esq_row["es_product_status"]; ?></div></td>
<td class="date-head" width="24%">&nbsp;</td>
<td width="24%"> <div class="date">&nbsp; </div></td>
</tr>	

<tr> <td class="date-head" width="23%"> <? echo "$Payments_Mode" ?>:</td>
<td width="29%"> <div class="date"> 
<?php 
$es_payment_mode=$esq_row["es_payment_mode"];
$es_other_mode=$esq_row["es_other_mode"];
if(strstr($es_payment_mode,'cash'))
echo 'Cash<br>';
if(strstr($es_payment_mode,'cheque'))
echo 'Cheque<br>';
if(strstr($es_payment_mode,'credit'))
echo 'Credit Card<br>';
if(strstr($es_payment_mode,'bank'))
echo 'Bank Transfer<br>';
if(strstr($es_payment_mode,'loc'))
echo 'Letter of Credit<br>';
if(strstr($es_payment_mode,'escrow'))
echo 'Escrow<br>';
echo $es_other_mode;
//echo $es_payment_mode;
//		  echo $esrow_off["es_description"]; ?>
</div></td>
<td class="date-head" width="24%">&nbsp;</td>
<td width="24%"> <div class="date">&nbsp; </div></td>
</tr>

<tr>
<td class="date-head" width="23%"><? echo $Posted_by ?>: </td>
<td colspan="3"> <div class="date">
<?php 
if ($profile12) 
echo $profile12["es_companyname"]; 
else   
echo $mem["es_username"];
?>
</font> <font class="smalltext"> <font class="red"> <strong>[ 
<?php  
$level_query=mysql_query("select * from esb2b_levels where es_levelid=" .$mem["es_memtype"]);
$level= mysql_fetch_array($level_query);
echo $level["es_levelname"];?> ] </strong></font></font></div></td>
</tr>	

<tr>
<td class="date-head"> <? echo $Categories ?>: </td>
<td colspan="3">
<?php 
$esq_cat="select * from esb2b_offer_cats where es_offer_id=$id";
//echo $esq_cat;
$esrs_cat=mysql_query($esq_cat);
/*		$escat_exists=false;
*/		while($esrow_cat=mysql_fetch_array($esrs_cat))
{
$catpath="";
$cat_query=mysql_query("Select * from esb2b_categories where es_id=".$esrow_cat["es_cid"] );
while ($rs=mysql_fetch_array($cat_query))
{
$catpath =" > <a href=".$domain_url."/categories/sell/".$rs[es_id]."/".URLsafe($rs["es_cat_name"]).".html>" .$rs["es_cat_name"]."</a>".$catpath; 
$cat_query=mysql_query("Select * from esb2b_categories where es_id=" . $rs["es_pid"] );
}
echo '<a href='.$domain_url.'/>'.$Home.'</a>'.$catpath.'<br>'; 
}
/*			if(!$escat_exists)
echo $config["es_null_char"];	//prints in case no other category than cid
*/		  
?></td>
</tr>

<tr>
  <td class="date-head" valign="top"><? echo "$Relevant_Images" ?>:</td>
  
  <td colspan="3" valign="top">
 
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" class="innertablestyle_multiple">
        <?php 
		$esq_img="select * from esb2b_offer_images where es_offer_id=$id";
	//	die($esq_img);
		$esrs_img=mysql_query($esq_img);
		if(mysql_num_rows($esrs_img)>0)
		{
			$escnt=0;
			$esimg_per_row=4;
			while($esrow_img=mysql_fetch_array($esrs_img))
			{
		?>
        <?php if($escnt%$esimg_per_row == 0) 
				{ ?>
        <tr> 
          <?php 
				}	//end if 
				$escnt++;
				?>
          <td height="100%"> <table width="100%" height="100%" border="0" cellpadding="5" cellspacing="0"  class="innertablestyle_multiple">
              <tr> 
                <td><div align="center"><a href="uploadedimages/<?php echo $esrow_img["es_img_url"]; ?>" target="_blank"><img src="<?php echo $img_path;?><?php echo $esrow_img["es_img_url"]; ?>" border="0" <? echo $img_pmt; ?>></a></div></td>
              </tr>
            </table></td>
          <?php if($escnt%$esimg_per_row == 0) 
				{ ?>
        </tr>
        <?php 
				}	//end if 
		}		//end while 
		//////-------padding empty tds
			$es_remainder=$escnt%$esimg_per_row;
			$es_no_of_pads=($es_remainder!=0)?$esimg_per_row-$es_remainder:0;
			for($es_new_counter=1;$es_new_counter<=$es_no_of_pads;$es_new_counter++)
			{
			  ?>
        <td class="seperatorstyle"><img src="images/spacer.gif" <? echo $img_pmt; ?> border="0"></td>
        <?php 
			}		//end for padding
		
		}
		else
		{	?>
        <tr> 
          <td class="seperatorstyle" height="25"><font class="normal">&nbsp;<? echo "$NO_images_have_been_uploaded" ?></font></td>
        </tr>
        <?php 
		}		//end else no img defined?>
      </table>  </td>
</tr>


<tr>
<td class="date-head"><?=$Description?>: </td>
<td colspan="3" <? if($_SESSION['lang']=="arabic"){?> align="right" <? }else{?> align="left"<? }?>  >
<?php 
echo $esq_row["es_description"]; 
?>
</td>
</tr>
</table>
</div>


<tr valign="top" class="innertablestyle">
<td colspan="2">
<table width="95%" border="0" cellpadding="5" cellspacing="0" class="Formbx td" align="center">
<tr>
<td align="center">
<form id="formreg" target="_blank" action="" method="post">     					
<table width="690" height="265" border="0" cellpadding="0" cellspacing="0" bgcolor="#F2F6F9">
<tr>
<td colspan="5">&nbsp;</td>
</tr>
<tr>
<td width="5%">&nbsp;</td>
<td width="17%">&nbsp;</td>
<td width="3%">&nbsp;</td>
<td width="72%"><strong class="supply_boom">Send your message to this supplier</strong></td>
<td width="3%">&nbsp;</td>
</tr>
<tr>
<td align="center">&nbsp;</td>
<td align="center" valign="middle"><img src="images/Mail-Pencil.gif" width="100" height="100"/></td>
<td colspan="2" align="center"><table width="72%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
<td align="center" valign="bottom">

<textarea ONFOCUS="clearDefault(this)" id="message" style="color:#000000;"  rows="6"  cols="70" name="message">Enter your message here and then click Send</textarea>
<div id="emailInputAreaTips" class="remark"  align="left" style="color:#999999;">Enter between 20 to 3,000 characters, English only.</div></td>
</tr>
</table></td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td colspan="2" align="center">
<input name="submit" type="submit" class="but_supply_boom" value="" /></td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="5">&nbsp;</td>
</tr>
</table>
</form>
<script type="text/javascript">
<!--
function clearDefault(el) {
if (el.defaultValue==el.value) el.value = ""
}
// -->
</script> 
</td></tr>


<tr valign="top" class="innertablestyle">
<td colspan="2" height="10"></td>
</tr>
<tr valign="top" class="innertablestyle"> 
<td colspan="2"><table border="0" cellspacing="0" cellpadding="0" align="center">
<tr valign="bottom"> 
<td align="center"><a href="<?=$domain_url?>/contactuser.html?es_type=1&es_id=<?php echo $id; ?>"><img src="<?=$domain_url?>/<?php echo $send_inquiry_icon;?>" border="0" alt="Send Inquires" onMouseOver="javascript: window.status='Send Inquiries to user'; return true;" onMouseOut="javascript: window.status=''; return true;" ></a></td>
<?php
  
$esq_com="select * from esb2b_companyprofiles where es_uid=".$uid;
$esrow_com=mysql_fetch_array(mysql_query($esq_com));
if($esrow_com)
{
?>
<td align="center">
<?
$uid=$_GET['uid'];
if($_GET['uid']=="" || $_GET['uid']==-1){
?>
<a href="<?=$domain_url?>/company_index.html?id=<?=$id?>&file=home&prod=<?=$prod?>&uid=<?=$uid?>"><img src="<?=$domain_url?>/<?php echo $company_profile_icon;?>" border="0" alt="View Company Profile" onMouseOver="javascript: window.status='View company profile'; return true;" onMouseOut="javascript: window.status=''; return true;" ></a>
<? }else{
 ?>

<a href="http://<?php  echo $uid.".".stripslashes($domain)?>"><img src="<?php echo $company_profile_icon;?>" border="0" alt="View Company Profile" onMouseOver="javascript: window.status='View company profile'; return true;" onMouseOut="javascript: window.status=''; return true;" ></a>
<? }?></td>

<?php
}		//end if esrow_com 
?>
<td align="center">
<a href="<?=$domain_url?>/addtocart.html?es_type=sell&es_id=<?php echo $id; ?>">
<img src="<?=$domain_url?>/<?php echo $inquiry_basket_icon;?>" border="0" alt="Add to Inquiry Basket" onMouseOver="javascript: window.status='Add to Inquiry Basket'; return true;" onMouseOut="javascript: window.status=''; return true;" ></a>	</td>
<td align="center"> <a href="<?=$domain_url?>/dummy.htm" onMouseOver="javascript: window.status='Add to contact list'; return true;" onMouseOut="javascript: window.status=''; return true;" onClick="return win('<?php echo "es_type=1&es_id=$id&username=".$mem["es_username"]; ?>');"  >
<img src="<?=$domain_url?>/<?php echo $contact_list_icon;?>" border="0" alt="Add to Contact List"></a>	</td>
<td align="center">
<a href="<?=$domain_url?>/dummy.htm" onMouseOver="javascript: window.status='Add to block list'; return true;" onMouseOut="javascript: window.status=''; return true;"  onClick="return win1('<?php echo "es_type=1&es_id=$id&username=".$mem["es_username"]; ?>');"><img src="<?=$domain_url?>/<?php echo $block_list_icon;?>" border="0" alt="Add to Block List"></a>	</td>
<td align="center"> <a href="<?=$domain_url?>/add_to_fav.html?es_type=1&es_id=<?php echo $id; ?>">
<img src="<?=$domain_url?>/<?php echo $add_fav_icon;?>" border="0" alt="Add to Favorites" onMouseOver="javascript: window.status='Add to favorites'; return true;" onMouseOut="javascript: window.status=''; return true;" ></a>	</td>
</tr>
</table></td>
</tr>
</table>
</div> </div> </td>
<?
}// end main
include "offer-new1.php";
?>
