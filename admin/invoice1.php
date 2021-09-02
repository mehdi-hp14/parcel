<?php 

include("../post_forms/cnf.php");
include("conf.php");

if(!(isset($_SESSION['loged_in']) AND isset($_SESSION['loged_in_t']) AND $_SESSION['loged_in']==true AND $_SESSION['loged_in_t']>=time())){

	header("Location: index.php");
	exit("You are not logged in....<br><a href='index.php'>Dashboard</a>");
}

if(isset($_SESSION['loged_in']) AND isset($_SESSION['loged_in_t']) AND $_SESSION['loged_in']==true AND $_SESSION['loged_in_t']>=time()){
	$_SESSION['loged_in_t'] = time()+time_out;
}


if(!(isset($_GET['id']) AND is_numeric($_GET['id']) AND $_GET['id']>0)){
	header("Location: dashboard.php");
	exit;
}
else{
	$id = intval($_GET['id']);
}

require 'mailer/PHPMailerAutoload.php';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Invoice | Booking Parcel Admin</title>
    <link rel="stylesheet" type="text/css" href="css/reset.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/text.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/grid.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/nav.css" media="screen" />
    <!--[if IE 6]><link rel="stylesheet" type="text/css" href="css/ie6.css" media="screen" /><![endif]-->
    <!--[if IE 7]><link rel="stylesheet" type="text/css" href="css/ie.css" media="screen" /><![endif]-->
    <link href="css/fancy-button/fancy-button.css" rel="stylesheet" type="text/css" />
    <!--Jquery UI CSS-->
    <link href="css/themes/base/jquery.ui.all.css" rel="stylesheet" type="text/css" />
    <!-- BEGIN: load jquery -->
    <script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/jquery-ui/jquery.ui.core.min.js"></script>
    <script src="js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.core.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.slide.min.js" type="text/javascript"></script>
    <!-- END: load jquery -->
    <!--jQuery Date Picker-->
    <script src="js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.datepicker.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.progressbar.min.js" type="text/javascript"></script>
    <!-- jQuery dialog related-->
    <script src="js/jquery-ui/external/jquery.bgiframe-2.1.2.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.mouse.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.draggable.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.position.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.resizable.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.dialog.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.core.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.blind.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.explode.min.js" type="text/javascript"></script>
    <!-- jQuery dialog end here-->
    <script src="js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>
    <!--Fancy Button-->
    <script src="js/fancy-button/fancy-button.js" type="text/javascript"></script>
    <script src="js/setup.js" type="text/javascript"></script>
	<script type="text/javascript" src="ckeditor/ckeditor.js"></script>

    <script type="text/javascript">

        $(document).ready(function () {
           // setupTinyMCE();
            //setupDashboardChart('chart1');
            setupLeftMenu();
			setSidebarHeight();


        });
		$(document).ready(function () {
			function checkTime(i) {
				return (i < 10) ? "0" + i : i;
			}
			function startTime() {
				var today = new Date(),
					h = checkTime(today.getHours()),
					m = checkTime(today.getMinutes()),
					s = checkTime(today.getSeconds());
					document.getElementById('time').innerHTML = h + ":" + m + ":" + s;
					t = setTimeout(function () {
					startTime()
				}, 500);
			}
			startTime();
		});

function printContent(el){
	var restorepage = document.body.innerHTML;
	var printcontent = document.getElementById(el).innerHTML;
	document.body.innerHTML = printcontent;
	window.print();
	document.body.innerHTML = restorepage;
}

		
    </script>
</head>
<body>
    <div class="container_12">
        <div class="grid_12 header-repeat">
            <div id="branding">
                <div class="floatleft">
                    <img src="img/logo.png" alt="Logo" /></div>
                <div class="floatright">
                    <div class="floatleft">
                        <img src="img/img-profile.jpg" alt="Profile Pic" /></div>
                    <div class="floatleft marginleft10">
                        <ul class="inline-ul floatleft">
                            <li>Hello Admin</li>
                            <li><a href="logout.php">Logout</a></li>
                        </ul>
                        <br />
                        <span class="small grey">Current Time : <span id="time"></span></span>
                    </div>
                </div>
                <div class="clear">
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
        <div class="grid_12">
            <ul class="nav main">
                <li class="ic-dashboard"><a href="dashboard.php"><span>Dashboard</span></a> </li>
                <li class="ic-grid-tables"><a href="agents.php"><span>Agents</span></a> </li>
                <li class="ic-grid-tables"><a href="premessages.php"><span>Pre-Defined Messages</span></a> </li>
                <li class="ic-notifications"><a href="logout.php"><span>LogOut</span></a></li>

            </ul>
        </div>
        <div class="clear">
        </div>
                    <?php
$con = mysql_connect(DB_HOST,DB_USER,DB_PASS) or die(mysql_error());
mysql_select_db(DB_NAME, $con) or die(mysql_error());
$error_m= "";
if(isset($_POST['t']) AND $_POST['t']==1){
	
}

if($error_m!=""){
	?>
<div class="grid_12">
    <div class="box round first">
        <h2>Notifications</h2>
		<div class="block">
		<?php if($error == false){ ?>
			<div class="message success">
				<h5>Success!</h5>
				<p>
					<?php echo $error_m; ?>
				</p>
				<p>
					the changing is sorted as bellow:
				</p>
				<p><?php foreach($q_p as $k=>$v) {
					$tmp = explode("'",$v);
					echo $tmp[1]."<br>";
					
				} ?></p>
			</div>
		<?php } if($error == true){ ?>
			<div class="message error">
				<h5>Error!</h5>
				<p>
					<?php echo $error_m; ?>
				</p>
			</div>
			
		<?php } ?>
		</div>
	</div>
</div>
	<?php
}
$output = "";
$q = "SELECT * FROM `invoices` WHERE `invoice_type` = ".$_GET['type']." AND `qref`=".$id." ORDER BY `invoice_no` DESC LIMIT 0 , 1";
//echo $q."<br>";
$r = mysql_query($q) or die(mysql_error());
$base = 0;
$date = 0;
if(mysql_num_rows($r)>0){
	$row = mysql_fetch_array($r);
	$base = $row['invoice_no'];
	$invoice_no = $base;
	$date = $row['timestamp'];
}
else{
	$q = "SELECT * FROM `invoices` WHERE `invoice_type` = ".$_GET['type']." ORDER BY `invoice_no` DESC LIMIT 0 , 1";
	$r = mysql_query($q) or die(mysql_error());
	$base = 0;
	if(mysql_num_rows($r)>0){
		$row = mysql_fetch_array($r);
		$base = $row['invoice_no'];
	}
	$invoice_no = $base +1;
}
$q = "SELECT * FROM `quote` WHERE `id`=".$id."";
$r = mysql_query($q) or die(mysql_error());
if(mysql_num_rows($r)>0){
	$_c = 1;
	$row = mysql_fetch_array($r);
}
else{
	$output = "<tr><td colspan=\"15\">No Entery Detected</td></tr>";
}
//1) Daftar Kole Kala => EPE 2016 0044|
$temp = explode("|",$row['hawb']);
$consignee_a = array();
$hawb_a = array();
if(!empty($temp)){
	foreach($temp as $k=>$v){
		if($v!=''){
			$tmp = explode(" => ",$v);
			$hawb_a[] = $tmp[1];
			
			$tmpp = explode(") ",$tmp[0]);
			$consignee_a[] = $tmpp[1];
		}
	}
}
$consignee = implode(" & ", $consignee_a);
$hawb = implode(" & ", $hawb_a);

if(!isset($_POST['t']) OR $_POST['t']==0)
{
?>

        <div class="grid_12">
            <div class="box round first">
                <h2>Check And Edit Invoice</h2>
                <div class="block">
<?php				
if($_c==1){
	echo "Item ID : ".$id."<br>";
	echo "Tracking ID : ".$row['tid']."<br>";
}

	
?>

<form action="invoice.php?id=<?php echo $id; ?>&type=<?php echo $_GET['type'];?>" method="post">
	<input type="hidden" name="t" value="1">
<?php 
if(!isset($_GET['type']) OR $_GET['type']==0){
	//$row['offered_p']
	$offer_price = $row['offer_price'];
	$currency = "GBP";
	$prices = explode(" | ",$row['offered_p']);
	foreach($prices as $k=>$v){
		if($v!=''){
			$tmp = explode(") ",$v);
			$ttmp = explode("=>",$tmp[1]);
			$confirmed = false;
			$conf_text = "";
			if($ttmp[0]=='on')
			{
				$offer_price = $ttmp[2];
				$currency = $ttmp[3];
				break;
			}
		}
	}

	$offer_price= str_replace(",","",$offer_price);	
$price_for_office = $offer_price;
if($row['discount_type']=='percent')
{
	$price_for_office = ($offer_price * ((100-$row['discount'])/100));
}
elseif($row['discount_type']=='amount'){
	$price_for_office = ($offer_price - $row['discount']);
}
 
$dif_cost = $row['dif_receive'];
$vat = 0;
if($row['export']=='international')
{
	$vat = 0;
}
elseif($row['export']=='domestic')
{
	$vat = ($price_for_office + $dif_cost) * $row['vat'] / 100;
}
?>
	Here is the invoice for our accountancy : <br>
	<table cellpadding='5' cellspacing='1' style='margin-left:auto;margin-right:auto;width:100%;border:0px;font-family:arial;font-size:12px;direction:ltr;border:thin solid #777;'>
		<tbody>
			<tr>
				<td style='background-color:#ffcc33;text-align:left;font-weight:bold;color:#ff3333;' width='80%'>
					Dear Accounant ,<br>Here is the invoice of order by the Tracking ID of <?php echo $row['tid']; ?>:
				</td>
				<td width='20%' bgcolor="#ffffff" align="right" valign="top" style="background-color:#ffffff;text-align:left;font-weight:bold;color:#ff3333;padding:10px 25px 20px 0px">
					<a href="http://bookingparcel.com/" target="_blank" rel="noreferrer"><img src="http://bookingparcel.com/logo.gif" alt="EuropostExpress" width="237" height="56" border="0" style="display:block"></a>
				</td>
			</tr>
			<tr>
				<td colspan="2" style='background-color:#f5f5f5;padding:25px;'>
					<table  border='1' bordercolor='#777' style='margin-left:auto;margin-right:auto;width:90%;border-collapse:collapse;border-color:#777;font-size:12px;text-align:left;'>
						<tbody>
							<tr>
								<td style="padding:5px;" width="55%">
									<span style="font-family:arial;font-size:13px;"><b>Europost Express (UK) Ltd.</b></span><br>4 Corringham Road,<br>Wembley - Middlesex<br>HA9 9QA- London , UK<br>Tel : +44(0) 7886105417 & +44(0) 2083852177<br>VAT No.: 220335165<br>EORI No: GB220 3351 65000
								</td>
								<td style="padding:15px;">
									<center>
										<p><a href="http://bookingparcel.com" target="_blank"><img src="http://bookingparcel.com/logo.gif" alt="EuroPost Express" style="margin-top::15px;" title="EuropPost Express"></a></p>
										<p></p>
										<p></p>
										<p><img src="http://bookingparcel.com/paid.png" style="margin-bottom:15px;"></p>
									</center>
								</td>
							</tr>
							<tr>
								<td>
									<table border='1' bordercolor='#777' style='min-height:166px;margin-left:auto;margin-right:auto;width:100%;border-collapse:collapse;border-color:#777;font-size:12px;text-align:left;'>
										<tr>
											<td style="padding:15px;"><b>INVOICE TO :</b></td>
										</tr>
										<tr>
											<td style="padding:5px; min-height:300px;">
												<p style="color:#F90004">
													<textarea name="address_a" style="margin: 0px; width: 293px; height: 95px;"><?php
													if($row['uname']!='' AND $row['uname']!=null)
													{
														$row2 = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `uname` = '".$row['uname']."'"));
														if($row2['office_address']!='' AND $row2['office_address']!=null)
															echo ($row2['office_address']);
														elseif($row2['address']!='' AND $row2['address']!=null)
															echo ($row2['address']);
													}
													?></textarea>
												</p>
											</td>
										</tr>
									</table>
								</td>
								<td>
									<table border='1' bordercolor='#777' style='min-height:166px;margin-left:auto;margin-right:auto;width:100%;border-collapse:collapse;border-color:#777;font-size:12px;text-align:left;'>
										<tr>
											<td style="padding:15px;" colspan="2">Invoice :</td>
										</tr>
										<tr>
											<td style="padding:5px;">
												DATE :
											</td>
											<td style="padding:5px; text-align:center;">
												<input name="date_a" type="text" value="<?php echo ($date>0 ? date("d.m.Y", $date) : date("d").".".date("m").".".date("Y")); ?>">
											</td>
											
										</tr>
										<tr>
											<td style="padding:5px;">
												ORDER REF.:
											</td>
											<td style="padding:5px; text-align:center;">
												<input name="ref_a" type="text" value="">
											</td>
											
										</tr>
										<tr>
											<td style="padding:5px;">
												BOOKING REF.:
											</td>
											<td style="padding:5px; text-align:center;">
												<input name="booking_ref_a" type="text" value="<?php

								$tid = "EPX-";
								if($row['company']!=''){
									$tid .= strtoupper(substr($row['company'],0,4))."-";
								}
								$tid .= $id;
												echo $tid; ?>">
											</td>
											
										</tr>
										<tr>
											<td style="padding:5px; text-align:center;">
												INVOICE NO. :
											</td>
											<td style="padding:5px; text-align:center;">
												<input name="invoice_num_a" type="text" value="<?php echo $tid."-".$invoice_no; ?>">
											</td>
											
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									
									<table border='1' bordercolor='#777' style='min-height:166px;margin-left:auto;margin-right:auto;width:100%;border-collapse:collapse;border-color:#777;font-size:12px;text-align:left;'>
										<tr>
											<td style="padding:15px;" width="55%">Description</td>
											<td style="padding:15px;" width="5%">Qty</td>
											<td style="padding:15px;" width="20%">Unit Price(<?php echo $currency; ?>)</td>
											<td style="padding:15px;" width="20%">Total Price(<?php echo $currency; ?>)</td>
										</tr>
										<tr>
											<td style="padding:5px; min-height:100px;">
												<p>Collection from <span ><input name="from_a" value="<?php echo $row['from']." - ".$row['from_location']; ?>" type="text"></span> and Delivery to <span ><input name="to_a" value="<?php echo $row['to']." - ".$row['to_location']; ?>" type="text"></span></p>
												<p ><?php echo $consignee; ?></p>
												<p>&nbsp;</p>
												<p>&nbsp;</p>
												<p>&nbsp;</p>
												<p>MAWB: <span ><?php echo $row['mawb1']."-".$row['mawb2']; ?></span></p>
												<p>HAWB: <span ><?php echo $hawb; ?></span></p>
												<p>Weight: <span ><?php echo $row['total_weight']; ?></span> </p>
											</td>
											<td style="padding:5px; text-align:center;">1</td>
											<td style="padding:5px; text-align:center;"><?php echo number_format($price_for_office,2); ?> <?php echo $currency; ?></td>
											<td style="padding:5px; text-align:center;"><?php echo number_format($price_for_office,2); ?> <?php echo $currency; ?></td>
											
										</tr>
										<?php if($dif_cost>0){
										?>
										<tr>
											<td style="padding:5px;">
												Difference Cost 
											<td>
											<td style="padding:5px; text-align:center;">1</td>
											<td style="padding:5px; text-align:center;"><?php echo number_format($dif_cost,2); ?> <?php echo $currency; ?></td>
											<td style="padding:5px; text-align:center;"><?php echo number_format($dif_cost,2); ?> <?php echo $currency; ?></td>
										<tr>
										<?php 
										}
										?>
										<tr>
											<td style="padding:5px;" colspan="2">
												
											</td>
											<td style="text-align:center;" colspan="2">
												
												<table  border='1' bordercolor='#777' style='min-height:166px;margin-left:auto;margin-right:auto;width:100%;border-collapse:collapse;border-color:#777;font-size:12px;text-align:left;'>
													<tr>
														<td style="padding:15px;" width="50%">SUB TOTAL  (<?php echo $currency; ?>)</td>
														<td style="padding:15px;" width="50%"><?php echo number_format(($price_for_office+$dif_cost),2); ?> <?php echo $currency; ?></td>
													</tr>
													<tr>
														<td style="padding:15px;" width="50%">VAT@20.00% (<?php echo $currency; ?>)</td>
														<td style="padding:15px;" width="50%"><?php echo number_format($vat,2); ?> <?php echo $currency; ?></td>
													</tr>
													<tr>
														<td style="padding:15px; font-family:arial;font-size:19px; font-weight:bold;" width="50%">TOTAL</td>
														<td style="padding:15px;" width="50%"><?php echo number_format(($price_for_office+$vat+$dif_cost),2); ?> <?php echo $currency; ?></td>
													</tr>
												</table>
											</td>
											
										</tr>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="2" style='background-color:#f5f5f5;padding:25px;'>
					PLEASE REMIT THE ABOVE AMOUNT TO THE FOLLOWING ACCOUNT:<br>Account Name: Europost Express (UK) Limited<br>Europost Accounts<br>(£) GBP A/C No.: 31892150<br>Sortcode: 40 – 46 – 09<br>IBAN: GB05 HBUK 4046 0931 8921 50<br>BIC: HBUKGB4162k<br>Bank SWIFT Code: HBUKGB4B<br>Euro A/C No.: 76899401<br>IBAN: GB08 MIDL 4005 1576 8994 01<br>BIC/SWIFT Code: HBUKGB4B<br>($) USD A/C No. 76899393<br>IBAN: GB30 MIDL 4005 1576 8993 93<br>BIC/ SWIFT Code: HBUKGB4B
				</td>
			</tr>
		</tbody>
	</table>
<?php }
elseif($_GET['type']==1){
	$offer_price = $row['offer_price'];
	$currency = "GBP";
	$prices = explode(" | ",$row['offered_p']);
	foreach($prices as $k=>$v){
		if($v!=''){
			$tmp = explode(") ",$v);
			$ttmp = explode("=>",$tmp[1]);
			$confirmed = false;
			$conf_text = "";
			if($ttmp[0]=='on')
			{
				$offer_price = $ttmp[2];
				$currency = $ttmp[3];
				break;
			}
		}
	}
	
	$offer_price= str_replace(",","",$offer_price);	
$price_for_office = $offer_price;
$dif_cost = $row['dif_offer'];
?>
	Here is the invoice for the customer : <br>
	<table cellpadding='5' cellspacing='1' style='margin-left:auto;margin-right:auto;width:100%;border:0px;font-family:arial;font-size:12px;direction:ltr;border:thin solid #777;'>
		<tbody>
			<tr>
				<td style='background-color:#ffcc33;text-align:left;font-weight:bold;color:#ff3333;' width='80%'>
					Dear Customer ,<br>Here is the invoice of your order:
				</td>
				<td width='20%' bgcolor="#ffffff" align="right" valign="top" style="background-color:#ffffff;text-align:left;font-weight:bold;color:#ff3333;padding:10px 25px 20px 0px">
					<a href="http://bookingparcel.com/" target="_blank" rel="noreferrer"><img src="http://bookingparcel.com/logo.gif" alt="EuropostExpress" width="237" height="56" border="0" style="display:block"></a>
				</td>
			</tr>
			<tr>
				<td colspan="2" style='background-color:#f5f5f5;padding:25px;'>
					<table  border='1' bordercolor='#777' style='margin-left:auto;margin-right:auto;width:90%;border-collapse:collapse;border-color:#777;font-size:12px;text-align:left;'>
						<tbody>
							<tr>
								<td style="padding:5px;" width="55%">
									<span style="font-family:arial;font-size:13px;"><b>Europost Express (UK) Ltd.</b></span><br>4 Corringham Road,<br>Wembley - Middlesex<br>HA9 9QA- London , UK<br>Tel : +44(0) 7886105417 & +44(0) 2083852177<br>VAT No.: 220335165<br>EORI No: GB220 3351 65000
								</td>
								<td style="padding:15px;">
									<center>
										<p><a href="http://bookingparcel.com" target="_blank"><img src="http://bookingparcel.com/logo.gif" alt="EuroPost Express" style="margin-top::15px;" title="EuropPost Express"></a></p>
										<p></p>
										<p></p>
										<p><img src="http://bookingparcel.com/paid.png" style="margin-bottom:15px;"></p>
									</center>
								</td>
							</tr>
							<tr>
								<td>
									<table border='1' bordercolor='#777' style='min-height:166px;margin-left:auto;margin-right:auto;width:100%;border-collapse:collapse;border-color:#777;font-size:12px;text-align:left;'>
										<tr>
											<td style="padding:15px;"><b>INVOICE TO :</b></td>
										</tr>
										<tr>
											<td style="padding:5px; min-height:300px;">
												<p style="color:#F90004">
													<textarea name="address" style="margin: 0px; width: 293px; height: 95px;"><?php
													if($row['uname']!='' AND $row['uname']!=null)
													{
														$row2 = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `uname` = '".$row['uname']."'"));
														if($row2['address']!='' AND $row2['address']!=null)
															echo ($row2['address']);
													}
													?></textarea>
												</p>
											</td>
										</tr>
									</table>
								</td>
								<td>
									<table border='1' bordercolor='#777' style='min-height:166px;margin-left:auto;margin-right:auto;width:100%;border-collapse:collapse;border-color:#777;font-size:12px;text-align:left;'>
										<tr>
											<td style="padding:15px;" colspan="2">Invoice :</td>
										</tr>
										<tr>
											<td style="padding:5px;">
												DATE :
											</td>
											<td style="padding:5px; text-align:center;">
												<input name="date" type="text" value="<?php echo ($date>0 ? date("d.m.Y", $date) : date("d").".".date("m").".".date("Y")); ?>">
											</td>
											
										</tr>
										<tr>
											<td style="padding:5px;">
												ORDER REF.:
											</td>
											<td style="padding:5px; text-align:center;">
												<input name="ref" type="text" value="">
											</td>
											
										</tr>
										<tr>
											<td style="padding:5px;">
												BOOKING REF.:
											</td>
											<td style="padding:5px; text-align:center;">
												<input name="booking_ref" type="text" value="<?php 

								$tid = "EPX-";
								if($row['company']!=''){
									$tid .= strtoupper(substr($row['company'],0,4))."-";
								}
								$tid .= $id;
												echo $tid; ?>">
											</td>
											
										</tr>
										<tr>
											<td style="padding:5px; text-align:center;">
												INVOICE NO. :
											</td>
											<td style="padding:5px; text-align:center;">
												<input name="invoice_num" type="text" value="<?php echo $tid."-".$invoice_no; ?>">
											</td>
											
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									
									<table border='1' bordercolor='#777' style='min-height:166px;margin-left:auto;margin-right:auto;width:100%;border-collapse:collapse;border-color:#777;font-size:12px;text-align:left;'>
										<tr>
											<td style="padding:15px;" width="55%">Description</td>
											<td style="padding:15px;" width="5%">Qty</td>
											<td style="padding:15px;" width="20%">Unit Price(<?php echo $currency; ?>)</td>
											<td style="padding:15px;" width="20%">Total Price(<?php echo $currency; ?>)</td>
										</tr>
										<tr>
											<td style="padding:5px; min-height:100px;">
												<p>Collection from <span ><input name="from" value="<?php echo $row['from']." - ".$row['from_location']; ?>" type="text"></span> and Delivery to <span ><input name="to" value="<?php echo $row['to']." - ".$row['to_location']; ?>" type="text"></span></p>
												<p ><?php echo $consignee; ?></p>
												<p>&nbsp;</p>
												<p>&nbsp;</p>
												<p>&nbsp;</p>
												<p>MAWB: <span ><?php echo $row['mawb1']."-".$row['mawb2']; ?></span></p>
												<p>HAWB: <span ><?php echo $hawb; ?></span></p>
												<p>Weight: <span ><?php echo $row['total_weight']; ?></span> </p>
											</td>
											<td style="padding:5px; text-align:center;">1</td>
											<td style="padding:5px; text-align:center;"><?php echo number_format($offer_price,2); ?> <?php echo $currency; ?></td>
											<td style="padding:5px; text-align:center;"><?php echo number_format($offer_price,2); ?> <?php echo $currency; ?></td>
											
										</tr>
										<?php if($dif_cost>0){
										?>
										<tr>
											<td style="padding:5px;">
												Difference Cost 
											<td>
											<td style="padding:5px; text-align:center;">1</td>
											<td style="padding:5px; text-align:center;"><?php echo number_format($dif_cost,2); ?> <?php echo $currency; ?></td>
											<td style="padding:5px; text-align:center;"><?php echo number_format($dif_cost,2); ?> <?php echo $currency; ?></td>
										<tr>
										<?php 
										}
										?>
										<tr>
											<td style="padding:5px;" colspan="2">
												
											</td>
											<td style="text-align:center;" colspan="2">
												
												<table  border='1' bordercolor='#777' style='min-height:166px;margin-left:auto;margin-right:auto;width:100%;border-collapse:collapse;border-color:#777;font-size:12px;text-align:left;'>
													<tr>
														<td style="padding:15px;" width="50%">SUB TOTAL  (<?php echo $currency; ?>)</td>
														<td style="padding:15px;" width="50%"><?php echo number_format($dif_cost+$offer_price,2); ?> <?php echo $currency; ?></td>
													</tr>
													<tr>
														<td style="padding:15px;" width="50%">VAT@20.00% (<?php echo $currency; ?>)</td>
														<td style="padding:15px;" width="50%"><?php
														$vat = 0;
														if($row['export']=='international')
														{
															$vat = 0;
														}
														elseif($row['export']=='domestic')
														{
															$vat = ($dif_cost+$offer_price) * $row['vat'] / 100;
														}
														echo number_format($vat,2); ?> <?php echo $currency; ?></td>
													</tr>
													<tr>
														<td style="padding:15px; font-family:arial;font-size:19px; font-weight:bold;" width="50%">TOTAL</td>
														<td style="padding:15px;" width="50%"><?php echo number_format(($offer_price + $vat+$dif_cost),2); ?> <?php echo $currency; ?></td>
													</tr>
												</table>
											</td>
											
										</tr>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="2" style='background-color:#f5f5f5;padding:25px;'>
					PLEASE REMIT THE ABOVE AMOUNT TO THE FOLLOWING ACCOUNT:<br>Account Name: Europost Express (UK) Limited<br>Europost Accounts<br>(£) GBP A/C No.: 31892150<br>Sortcode: 40 – 46 – 09<br>IBAN: GB05 HBUK 4046 0931 8921 50<br>BIC: HBUKGB4162k<br>Bank SWIFT Code: HBUKGB4B<br>Euro A/C No.: 76899401<br>IBAN: GB08 MIDL 4005 1576 8994 01<br>BIC/SWIFT Code: HBUKGB4B<br>($) USD A/C No. 76899393<br>IBAN: GB30 MIDL 4005 1576 8993 93<br>BIC/ SWIFT Code: HBUKGB4B
				</td>
			</tr>
		</tbody>
	</table>
<?php } ?>
	<br>
	<div style="text-align:center;"><button class="btn" name="submit" type="submit">Apply</button></div>
</form>
                </div>
            </div>
        </div>
        <div class="clear"></div>
<?php

}
elseif(isset($_POST['t']) AND $_POST['t']==1)
{
?>

        <div class="grid_12">
            <div class="box round first">
                <h2>Check And Edit Invoice</h2>
                <div class="block">
<?php				
if($_c==1){
	echo "<button class=\"btn\" name=\"submit\" type=\"button\" OnClick=\"window.location.href='invoice.php?id=".$id."'&type=".$_GET['type'].";return false;\">Back</button><br>";
	echo "Item ID : ".$id."<br>";
	echo "Tracking ID : ".$row['tid']."<br>";
}

	
?>

<form action="invoice.php?id=<?php echo $id; ?>&type=<?php echo $_GET['type'];?>" method="post">
	<input type="hidden" name="t" value="2">
	<?php
	foreach($_POST as $k=>$v){
		if($k!="t"){
			echo "<input type='hidden' name='".$k."' value='".$v."'>";
		}
		
	}
	if(!isset($_GET['type']) OR $_GET['type']==0){
		
	$offer_price = $row['offer_price'];
	$currency = "GBP";
	$prices = explode(" | ",$row['offered_p']);
	foreach($prices as $k=>$v){
		if($v!=''){
			$tmp = explode(") ",$v);
			$ttmp = explode("=>",$tmp[1]);
			$confirmed = false;
			$conf_text = "";
			if($ttmp[0]=='on')
			{
				$offer_price = $ttmp[2];
				$currency = $ttmp[3];
				break;
			}
		}
	}
	
	$offer_price= str_replace(",","",$offer_price);	
$dif_cost = $row['dif_receive'];
$price_for_office = $offer_price;
//$price_for_office = $row['offer_price'];
$discount = 0;
if($row['discount_type']=='percent' AND $row['discount']>0)
{
	$dif_cost = ($row['dif_receive'] * ((100-$row['dif_receive'])/100));
	$price_for_office = ($offer_price * ((100-$row['discount'])/100));
	$discount = ($offer_price * (($row['discount'])/100));
}
elseif($row['discount_type']=='amount' AND $row['discount']>0){
	$price_for_office = ($offer_price - $row['discount']);
	$discount = $row['discount'];
}
 
$vat = 0;
if($row['export']=='international')
{
	$vat = 0;
}
elseif($row['export']=='domestic')
{
	$vat = ($dif_cost + $price_for_office) * $row['vat'] / 100;
}
?>
	Here is the invoice for our accountancy : <br>
	<center><button type="button" name="print" class="btn btn-green" onclick="printContent('print')">Print the invoice</button></center><div id="prints">
	<table cellpadding='5' cellspacing='1' border='0' style='margin-left:auto;margin-right:auto;width:100%;border:0px;font-family:arial;font-size:12px;direction:ltr;border:none'>
		<tbody>
			<tr>
				<td style='background-color:#ffcc33;text-align:left;font-weight:bold;color:#ff3333;' width='80%'>
					Dear Accounant ,<br>Here is the invoice of order by the Tracking ID of <?php echo $row['tid']; ?>:
				</td>
				<td width='20%' bgcolor="#ffffff" align="right" valign="top" style="background-color:#ffffff;text-align:left;font-weight:bold;color:#ff3333;padding:10px 25px 20px 0px">
					<a href="http://bookingparcel.com/" target="_blank" rel="noreferrer"><img src="http://bookingparcel.com/logo.gif" alt="EuropostExpress" width="237" height="56" border="0" style="display:block"></a>
				</td>
			</tr>
			<tr>
				<td colspan="2" style='background-color:#f5f5f5;padding:25px;' id="print">
					<table  border='0' style='margin-left:auto;margin-right:auto;width:90%;font-size:12px;text-align:left;'>
						<tbody>
							<tr>
								<td style="padding:5px;" width="55%">
									<span style="font-family:arial;font-size:13px;"><b>Europost Express (UK) Ltd.</b></span><br>4 Corringham Road,<br>Wembley - Middlesex<br>HA9 9QA- London , UK<br>Tel : +44(0) 7886105417 & +44(0) 2083852177<br>VAT No.: 220335165<br>EORI No: GB220 3351 65000
								</td>
								<td style="padding:5px;">
									<center>
										<p><a href="http://bookingparcel.com" target="_blank"><img src="http://bookingparcel.com/logo.gif" alt="EuroPost Express" style="margin-top:5px;" title="EuropPost Express"></a></p>
										<p></p>
										<p></p>
										<p><img src="http://bookingparcel.com/paid.png" style="margin-bottom:5px;"></p>
									</center>
								</td>
							</tr>
							<tr>
								<td>
									<table style='float:right;margin-left:auto;margin-right:auto;width:88%;font-size:12px;text-align:left;padding-bottom:0px;'>
										<tr >
											<td style="padding:5px;font-weight:bold;font-size:2.5em;padding-bottom:0px;" colspan="2">&nbsp; </td>
										</tr>
									</table>
									<table border='1' bordercolor='#777' style='float:left;min-height:166px;margin-left:auto;margin-right:auto;width:97%;border-collapse:collapse;border-color:#777;font-size:12px;text-align:left;'>
										<tr>
											<td style="padding:5px;"><b>INVOICE TO </b></td>
										</tr>
										<tr>
											<td style="padding:5px;">
												<p ><?php echo nl2br((isset($_POST['address_a']) AND trim($_POST['address_a'])!='' AND $_POST['address_a']!=null) ? $_POST['address_a'] : "-----"); ?></p>
											</td>
										</tr>
									</table>
								</td>
								<td>
									<table style='float:right;margin-left:auto;margin-right:auto;width:88%;font-size:12px;text-align:left;padding-bottom:0px;'>
										<tr >
											<td style="padding:5px;font-weight:bold;font-size:2.5em;padding-bottom:0px;" colspan="2">Invoice </td>
										</tr>
									</table>
									<table border='1' bordercolor='#777' style='padding-top:0px;float:right;min-height:166px;margin-left:auto;margin-right:auto;width:88%;border-collapse:collapse;border-color:#777;font-size:12px;text-align:left;'>
										<tr>
											<td style="padding:5px;padding-top:0px;">
												<span style="font-weight:bold;">DATE :</span>
											</td>
											<td style="padding:5px; text-align:center;font-weight:bold;"><?php echo ((isset($_POST['date_a']) AND trim($_POST['date_a'])!='' AND $_POST['date_a']!=null) ? $_POST['date_a'] : "-----"); ?></td>
											
										</tr>
										<tr>
											<td style="padding:5px;">
												<span style="font-weight:bold;">ORDER REF.:</span>
											</td>
											<td style="padding:5px; text-align:center;font-weight:bold;"><?php echo ((isset($_POST['ref_a']) AND trim($_POST['ref_a'])!='' AND $_POST['ref_a']!=null) ? $_POST['ref_a'] : "-----"); ?></td>
											
										</tr>
										<tr>
											<td style="padding:5px;">
												<span style="font-weight:bold;">BOOKING REF.:</span>
											</td>
											<td style="padding:5px; text-align:center;font-weight:bold;"><?php echo ((isset($_POST['booking_ref_a']) AND trim($_POST['booking_ref_a'])!='' AND $_POST['booking_ref_a']!=null) ? $_POST['booking_ref_a'] : "-----"); ?></td>
											
										</tr>
										<tr>
											<td style="padding:5px; text-align:center;">
												<span style="font-weight:bold;">INVOICE NO.:</span>
											</td>
											<td style="padding:5px; text-align:center;font-weight:bold;"><?php echo ((isset($_POST['invoice_num_a']) AND trim($_POST['invoice_num_a'])!='' AND $_POST['invoice_num_a']!=null) ? $_POST['invoice_num_a'] : "-----"); ?></td>
											
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2"style="padding:5px;min-height:5px;"></td>
							</tr>
							<tr>
								<td colspan="2">
									
									<table border='1' bordercolor='#777' style='min-height:166px;margin-left:auto;margin-right:auto;width:100%;border-collapse:collapse;border-color:#777;font-size:12px;text-align:left;'>
										<tr>
											<td style="padding:15px; text-align:center;font-weight:bold;" width="55%">Description</td>
											<td style="padding:15px; text-align:center;font-weight:bold;" width="5%">Qty</td>
											<td style="padding:15px; text-align:center;font-weight:bold;" width="20%">Unit Price(<?php echo $currency; ?>)</td>
											<td style="padding:15px; text-align:center;font-weight:bold;" width="20%">Total Price(<?php echo $currency; ?>)</td>
										</tr>
										<tr>
											<td style="padding:5px; min-height:100px;">
												<span style="font-weight:bold;">
												Collection from <span ><?php echo ((isset($_POST['from_a']) AND trim($_POST['from_a'])!='' AND $_POST['from_a']!=null) ? $_POST['from_a'] : "-----"); ?></span> and Delivery to <span ><?php echo ((isset($_POST['to_a']) AND trim($_POST['to_a'])!='' AND $_POST['to_a']!=null) ? $_POST['to_a'] : "-----"); ?></span><br>
												<span ><?php echo $consignee; ?></span><br><br>
												<?php if(($row['mawb1']."-".$row['mawb2']) != '-'){ ?>MAWB: <span ><?php echo $row['mawb1']."-".$row['mawb2']; ?></span><br><?php } ?>
												HAWB: <span ><?php echo $hawb; ?></span><br><br>
												Weight: <span ><?php echo $row['total_weight'] .((stripos($row['total_weight'], 'kg') != false) ? "" : " Kg"); ?></span></span>
											</td>
											<td style="padding:5px; text-align:center;">1</td>
											<td style="padding:5px; text-align:center;"><?php echo number_format($offer_price,2); ?> <?php echo $currency; ?></td>
											<td style="padding:5px; text-align:center;"><?php echo number_format($offer_price,2); ?> <?php echo $currency; ?></td>
										</tr>
										<?php if($dif_cost>0){
										?>
										<tr>
											<td style="padding:5px;">
												Difference Cost 
											<td>
											<td style="padding:5px; text-align:center;">1</td>
											<td style="padding:5px; text-align:center;"><?php echo number_format($dif_cost,2); ?> <?php echo $currency; ?></td>
											<td style="padding:5px; text-align:center;"><?php echo number_format($dif_cost,2); ?> <?php echo $currency; ?></td>
										<tr>
										<?php 
										}
										?>
										<?php if($discount != '0'){ ?>
										<tr>
											<td style="padding:5px;">
												<?php echo $row['discount']." ".($row['discount_type']=='percent' ? '%' : $currency). " Discount"; ?>
											</td>
											<td style="padding:5px; text-align:center;"></td>
											<td style="padding:5px; text-align:center;"></td>
											<td style="padding:5px; text-align:center;">
											<?php echo "".number_format($discount,2)." ".($currency). "";  ?>
											</td>
											
										</tr>
										<?php } ?>
										<tr>
											<td style="padding:5px;" colspan="2">
												
											</td>
											<td style="text-align:center;" colspan="2">
												
												<table  border='1' bordercolor='#777' style='min-height:166px;margin-left:auto;margin-right:auto;width:100%;border-collapse:collapse;border-color:#777;font-size:12px;text-align:left;'>
													<tr>
														<td style="padding:5px;font-size:10px;" width="50%">SUB TOTAL  (<?php echo $currency; ?>)</td>
														<td style="padding:5px;" width="50%"><?php  echo number_format($price_for_office+$dif_cost,2); ?> <?php echo $currency; ?></td>
													</tr>
													<tr>
														<td style="padding:5px;" width="50%">VAT@20.00% (<?php echo $currency; ?>)</td>
														<td style="padding:5px;" width="50%"><?php echo number_format($vat,2); ?> <?php echo $currency; ?></td>
													</tr>
													<tr>
														<td style="padding:5px; font-weight:bold;" width="50%">TOTAL</td>
														<td style="padding:5px; font-weight:bold;" width="50%"><?php echo number_format(($price_for_office+$vat+$dif_cost),2); ?> <?php echo $currency; ?></td>
													</tr>
												</table>
											</td>
											
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" style='background-color:#f5f5f5;padding:3px;'>
								PLEASE REMIT THE ABOVE AMOUNT TO THE FOLLOWING ACCOUNT:<br>Account Name: Europost Express (UK) Limited<br>Europost Accounts<br>(£) GBP A/C No.: 31892150<br>Sortcode: 40 – 46 – 09<br>IBAN: GB05 HBUK 4046 0931 8921 50<br>BIC: HBUKGB4162k<br>Bank SWIFT Code: HBUKGB4B<br>Euro A/C No.: 76899401<br>IBAN: GB08 MIDL 4005 1576 8994 01<br>BIC/SWIFT Code: HBUKGB4B<br>($) USD A/C No. 76899393<br>IBAN: GB30 MIDL 4005 1576 8993 93<br>BIC/ SWIFT Code: HBUKGB4B
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
		</tbody>
	</table>
	</div>
<?php }
elseif($_GET['type']==1){
	$offer_price = $row['offer_price'];
	$currency = "GBP";
	$prices = explode(" | ",$row['offered_p']);
	foreach($prices as $k=>$v){
		if($v!=''){
			$tmp = explode(") ",$v);
			$ttmp = explode("=>",$tmp[1]);
			$confirmed = false;
			$conf_text = "";
			if($ttmp[0]=='on')
			{
				$offer_price = $ttmp[2];
				$currency = $ttmp[3];
				break;
			}
		}
	}
	
	$offer_price= str_replace(",","",$offer_price);	
$price_for_office = $offer_price;
$dif_cost = $row['dif_offer'];
?>
	Here is the invoice for the customer : <br>
	<center><button type="button" name="print" class="btn btn-green" onclick="printContent('print')">Print the invoice</button></center><div id="prints">
	<table cellpadding='5' cellspacing='1' border='0' style='margin-left:auto;margin-right:auto;width:100%;border:0px;font-family:arial;font-size:12px;direction:ltr;border:none'>
		<tbody>
			<tr>
				<td style='background-color:#ffcc33;text-align:left;font-weight:bold;color:#ff3333;' width='80%'>
					Dear Customer ,<br>Here is the invoice of order by the Tracking ID of <?php echo $row['tid']; ?>:
				</td>
				<td width='20%' bgcolor="#ffffff" align="right" valign="top" style="background-color:#ffffff;text-align:left;font-weight:bold;color:#ff3333;padding:10px 25px 20px 0px">
					<a href="http://bookingparcel.com/" target="_blank" rel="noreferrer"><img src="http://bookingparcel.com/logo.gif" alt="EuropostExpress" width="237" height="56" border="0" style="display:block"></a>
				</td>
			</tr>
			<tr>
				<td colspan="2" style='background-color:#f5f5f5;padding:25px;' id="print">
					<table  border='0' style='margin-left:auto;margin-right:auto;width:90%;font-size:12px;text-align:left;'>
						<tbody>
							<tr>
								<td style="padding:5px;" width="55%">
									<span style="font-family:arial;font-size:13px;"><b>Europost Express (UK) Ltd.</b></span><br>4 Corringham Road,<br>Wembley - Middlesex<br>HA9 9QA- London , UK<br>Tel : +44(0) 7886105417 & +44(0) 2083852177<br>VAT No.: 220335165<br>EORI No: GB220 3351 65000
								</td>
								<td style="padding:5px;">
									<center>
										<p><a href="http://bookingparcel.com" target="_blank"><img src="http://bookingparcel.com/logo.gif" alt="EuroPost Express" style="margin-top:5px;" title="EuropPost Express"></a></p>
										<p></p>
										<p></p>
										<p><img src="http://bookingparcel.com/paid.png" style="margin-bottom:5px;"></p>
									</center>
								</td>
							</tr>
							<tr>
								<td>
									<table style='float:right;margin-left:auto;margin-right:auto;width:88%;font-size:12px;text-align:left;padding-bottom:0px;'>
										<tr >
											<td style="padding:5px;font-weight:bold;font-size:2.5em;padding-bottom:0px;" colspan="2">&nbsp; </td>
										</tr>
									</table>
									<table border='1' bordercolor='#777' style='float:left;min-height:166px;margin-left:auto;margin-right:auto;width:97%;border-collapse:collapse;border-color:#777;font-size:12px;text-align:left;'>
										<tr>
											<td style="padding:5px;"><b>INVOICE TO </b></td>
										</tr>
										<tr>
											<td style="padding:5px;">
												<p ><?php echo nl2br((isset($_POST['address']) AND trim($_POST['address'])!='' AND $_POST['address']!=null) ? $_POST['address'] : "-----"); ?></p>
											</td>
										</tr>
									</table>
								</td>
								<td>
									<table style='float:right;margin-left:auto;margin-right:auto;width:88%;font-size:12px;text-align:left;padding-bottom:0px;'>
										<tr >
											<td style="padding:5px;font-weight:bold;font-size:2.5em;padding-bottom:0px;" colspan="2">Invoice </td>
										</tr>
									</table>
									<table border='1' bordercolor='#777' style='padding-top:0px;float:right;min-height:166px;margin-left:auto;margin-right:auto;width:88%;border-collapse:collapse;border-color:#777;font-size:12px;text-align:left;'>
										<tr>
											<td style="padding:5px;padding-top:0px;">
												<span style="font-weight:bold;">DATE :</span>
											</td>
											<td style="padding:5px; text-align:center;font-weight:bold;"><?php echo ((isset($_POST['date']) AND trim($_POST['date'])!='' AND $_POST['date']!=null) ? $_POST['date'] : "-----"); ?></td>
											
										</tr>
										<tr>
											<td style="padding:5px;">
												<span style="font-weight:bold;">ORDER REF.:</span>
											</td>
											<td style="padding:5px; text-align:center;font-weight:bold;"><?php echo ((isset($_POST['ref']) AND trim($_POST['ref'])!='' AND $_POST['ref']!=null) ? $_POST['ref'] : "-----"); ?></td>
											
										</tr>
										<tr>
											<td style="padding:5px;">
												<span style="font-weight:bold;">BOOKING REF.:</span>
											</td>
											<td style="padding:5px; text-align:center;font-weight:bold;"><?php echo ((isset($_POST['booking_ref']) AND trim($_POST['booking_ref'])!='' AND $_POST['booking_ref']!=null) ? $_POST['booking_ref'] : "-----"); ?></td>
											
										</tr>
										<tr>
											<td style="padding:5px; text-align:center;">
												<span style="font-weight:bold;">INVOICE NO.:</span>
											</td>
											<td style="padding:5px; text-align:center;font-weight:bold;"><?php echo ((isset($_POST['invoice_num']) AND trim($_POST['invoice_num'])!='' AND $_POST['invoice_num']!=null) ? $_POST['invoice_num'] : "-----"); ?></td>
											
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2"style="padding:5px;min-height:5px;"></td>
							</tr>
							<tr>
								<td colspan="2">
									
									<table border='1' bordercolor='#777' style='min-height:166px;margin-left:auto;margin-right:auto;width:100%;border-collapse:collapse;border-color:#777;font-size:12px;text-align:left;'>
										<tr>
											<td style="padding:15px; text-align:center;font-weight:bold;" width="55%">Description</td>
											<td style="padding:15px; text-align:center;font-weight:bold;" width="5%">Qty</td>
											<td style="padding:15px; text-align:center;font-weight:bold;" width="20%">Unit Price(<?php echo $currency; ?>)</td>
											<td style="padding:15px; text-align:center;font-weight:bold;" width="20%">Total Price(<?php echo $currency; ?>)</td>
										</tr>
										<tr>
											<td style="padding:5px; min-height:100px;">
												<span style="font-weight:bold;">
												Collection from <span ><?php echo ((isset($_POST['from']) AND trim($_POST['from'])!='' AND $_POST['from']!=null) ? $_POST['from'] : "-----"); ?></span> and Delivery to <span ><?php echo ((isset($_POST['to']) AND trim($_POST['to'])!='' AND $_POST['to']!=null) ? $_POST['to'] : "-----"); ?></span><br>
												<span ><?php echo $consignee; ?></span><br><br>
												<?php if(($row['mawb1']."-".$row['mawb2']) != '-'){ ?>MAWB: <span ><?php echo $row['mawb1']."-".$row['mawb2']; ?></span><br><?php } ?>
												HAWB: <span ><?php echo $hawb; ?></span><br><br>
												Weight: <span ><?php echo $row['total_weight'] .((stripos($row['total_weight'], 'kg') != false) ? "" : " Kg"); ?></span></span>
											</td>
											<td style="padding:5px; text-align:center;">1</td>
											<td style="padding:5px; text-align:center;"><?php echo number_format($offer_price,2); ?> <?php echo $currency; ?></td>
											<td style="padding:5px; text-align:center;"><?php echo number_format($offer_price,2); ?> <?php echo $currency; ?></td>
										</tr>
										<?php if($dif_cost>0){
										?>
										<tr>
											<td style="padding:5px;">
												Difference Cost 
											<td>
											<td style="padding:5px; text-align:center;">1</td>
											<td style="padding:5px; text-align:center;"><?php echo number_format($dif_cost,2); ?> <?php echo $currency; ?></td>
											<td style="padding:5px; text-align:center;"><?php echo number_format($dif_cost,2); ?> <?php echo $currency; ?></td>
										<tr>
										<?php 
										}
										?>
										<tr>
											<td style="padding:5px;" colspan="2">
												
											</td>
											<td style="text-align:center;" colspan="2">
												
												<table  border='1' bordercolor='#777' style='min-height:166px;margin-left:auto;margin-right:auto;width:100%;border-collapse:collapse;border-color:#777;font-size:12px;text-align:left;'>
													<tr>
														<td style="padding:5px;font-size:10px;" width="50%">SUB TOTAL  (<?php echo $currency; ?>)</td>
														<td style="padding:5px;" width="50%"><?php  echo number_format($offer_price+$dif_cost,2); ?> <?php echo $currency; ?></td>
													</tr>
													<tr>
														<td style="padding:5px;" width="50%">VAT@20.00% (<?php echo $currency; ?>)</td>
														<td style="padding:5px;" width="50%"><?php
														$vat = 0;
														if($row['export']=='international')
														{
															$vat = 0;
														}
														elseif($row['export']=='domestic')
														{
															$vat = ($offer_price+$dif_cost) * $row['vat'] / 100;
														} echo number_format($vat,2); ?> <?php echo $currency; ?></td>
													</tr>
													<tr>
														<td style="padding:5px; font-weight:bold;" width="50%">TOTAL</td>
														<td style="padding:5px; font-weight:bold;" width="50%"><?php echo number_format(($offer_price+$vat+$dif_cost),2); ?> <?php echo $currency; ?></td>
													</tr>
												</table>
											</td>
											
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" style='background-color:#f5f5f5;padding:3px;'>
								PLEASE REMIT THE ABOVE AMOUNT TO THE FOLLOWING ACCOUNT:<br>Account Name: Europost Express (UK) Limited<br>Europost Accounts<br>(£) GBP A/C No.: 31892150<br>Sortcode: 40 – 46 – 09
								<br>IBAN: GB05 HBUK 4046 0931 8921 50<br>BIC: HBUKGB4162k<br>Bank SWIFT Code: HBUKGB4B
								<br>Euro A/C No.: 76899401<br>IBAN: GB08 MIDL 4005 1576 8994 01<br>BIC/SWIFT Code: HBUKGB4B
								<br>($) USD A/C No. 76899393<br>IBAN: GB30 MIDL 4005 1576 8993 93<br>BIC/ SWIFT Code: HBUKGB4B
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
		</tbody>
	</table>
	</div>
<?php } ?>
	<br>
	<div style="text-align:center;"><button class="btn" name="submit" type="submit">Confirm And Send</button></div>
</form>
                </div>
            </div>
        </div>
        <div class="clear"></div>
<?php
}
elseif(isset($_POST['t']) AND $_POST['t']==2)
{
?>

        <div class="grid_12">
            <div class="box round first">
                <h2>Sending the invoice</h2>
                <div class="block">
<?php				
if($_c==1){
	echo "<button class=\"btn\" name=\"submit\" type=\"button\" OnClick=\"window.location.href='invoice.php?id=".$id."&type=".$_GET['type']."';return false;\">Back</button><br>";
	echo "Item ID : ".$id."<br>";
	echo "Tracking ID : ".$row['tid']."<br>";
}

$header = '<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Invoice</title>

<script type="text/javascript">
function printContent(el){
	var restorepage = document.body.innerHTML;
	var printcontent = document.getElementById(el).innerHTML;
	document.body.innerHTML = printcontent;
	window.print();
	document.body.innerHTML = restorepage;
}
</script>
</head>

<body yahoo="yahoo">
<center><button type="button" name="print" class="btn btn-green" onclick="printContent(\'print\')">Print the invoice</button></center><div id="prints">';

$footer='</div>
</body>
</html>';

function writeStringToFile($file, $string){
    $f=fopen($file, "wb");
    $file="\xEF\xBB\xBF".$file; // this is what makes the magic
    fputs($f, $string);
    fclose($f);
}

if(!isset($_GET['type']) OR $_GET['type']==0){ 
	$offer_price = $row['offer_price'];
	$currency = "GBP";
	$prices = explode(" | ",$row['offered_p']);
	foreach($prices as $k=>$v){
		if($v!=''){
			$tmp = explode(") ",$v);
			$ttmp = explode("=>",$tmp[1]);
			$confirmed = false;
			$conf_text = "";
			if($ttmp[0]=='on')
			{
				$offer_price = $ttmp[2];
				$currency = $ttmp[3];
				break;
			}
		}
	}
	
	$offer_price= str_replace(",","",$offer_price);	
$price_for_office = $offer_price;
//$price_for_office = $row['offer_price'];
$discount = 0;
$dif_cost = $row['dif_receive'];
if($row['discount_type']=='percent' AND $row['discount']>0)
{
	$dif_cost = ($dif_cost * ((100-$row['dif_receive'])/100));
	$price_for_office = ($offer_price * ((100-$row['discount'])/100));
	$discount = ($offer_price * (($row['discount'])/100));
}
elseif($row['discount_type']=='amount' AND $row['discount']>0){
	$price_for_office = ($offer_price - $row['discount']);
	$discount = $row['discount'];
}
 
$vat = 0;
if($row['export']=='international')
{
	$vat = 0;
}
elseif($row['export']=='domestic')
{
	$vat = ($dif_cost+$price_for_office) * $row['vat'] / 100;
}
/*
$accountancy_msg='<table cellpadding=\'5\' cellspacing=\'1\' style=\'margin-left:auto;margin-right:auto;width:100%;border:0px;font-family:arial;font-size:12px;direction:ltr;border:thin solid #777;\'>
		<tbody>
			<tr>
				<td style=\'background-color:#ffcc33;text-align:left;font-weight:bold;color:#ff3333;\' width=\'80%\'>
					Dear Accounant ,<br>Here is the invoice of order by the Tracking ID of '.$row['tid'].':
				</td>
				<td width=\'20%\' bgcolor="#ffffff" align="right" valign="top" style="background-color:#ffffff;text-align:left;font-weight:bold;color:#ff3333;padding:10px 25px 20px 0px">
					<a href="http://bookingparcel.com/" target="_blank" rel="noreferrer"><img src="http://bookingparcel.com/logo.gif" alt="EuropostExpress" width="237" height="56" border="0" style="display:block"></a>
				</td>
			</tr>
			<tr>
				<td colspan="2" style=\'background-color:#f5f5f5;padding:25px;\'>
					<table  border=\'1\' bordercolor=\'#777\' style=\'margin-left:auto;margin-right:auto;width:90%;border-collapse:collapse;border-color:#777;font-size:12px;text-align:left;\'>
						<tbody>
							<tr>
								<td style="padding:5px;" width="55%">
									<span style="font-family:arial;font-size:13px;"><b>Europost Express (UK) Ltd.</b></span><br>4 Corringham Road,<br>Wembley - Middlesex<br>HA9 9QA- London , UK<br>Tel : +44(0) 7886105417 & +44(0) 2083852177<br>VAT No.: 220335165<br>EORI No: GB220 3351 65000
								</td>
								<td style="padding:15px;">
									<center>
										<p><a href="http://bookingparcel.com" target="_blank"><img src="http://bookingparcel.com/logo.gif" alt="EuroPost Express" style="margin-top::15px;" title="EuropPost Express"></a></p>
										<p></p>
										<p></p>
										<p><img src="http://bookingparcel.com/paid.png" style="margin-bottom:15px;"></p>
									</center>
								</td>
							</tr>
							<tr>
								<td>
									<table border=\'1\' bordercolor=\'#777\' style=\'min-height:166px;margin-left:auto;margin-right:auto;width:100%;border-collapse:collapse;border-color:#777;font-size:12px;text-align:left;\'>
										<tr>
											<td style="padding:15px;"><b>INVOICE TO :</b></td>
										</tr>
										<tr>
											<td style="padding:5px; min-height:300px;">
												<p style="color:#F90004">'. nl2br((isset($_POST['address_a']) AND trim($_POST['address_a'])!='' AND $_POST['address_a']!=null) ? $_POST['address_a'] : "-----") .'</p>
											</td>
										</tr>
									</table>
								</td>
								<td>
									<table border=\'1\' bordercolor=\'#777\' style=\'min-height:166px;margin-left:auto;margin-right:auto;width:100%;border-collapse:collapse;border-color:#777;font-size:12px;text-align:left;\'>
										<tr>
											<td style="padding:15px;" colspan="2">Invoice :</td>
										</tr>
										<tr>
											<td style="padding:5px;">
												DATE 
											</td>
											<td style="padding:5px; text-align:center;">'.((isset($_POST['date_a']) AND trim($_POST['date_a'])!='' AND $_POST['date_a']!=null) ? $_POST['date_a'] : "-----").'</td>
											
										</tr>
										<tr>
											<td style="padding:5px;">
												ORDER REF. 
											</td>
											<td style="padding:5px; text-align:center;">'.((isset($_POST['ref_a']) AND trim($_POST['ref_a'])!='' AND $_POST['ref_a']!=null) ? $_POST['ref_a'] : "-----").'</td>
											
										</tr>
										<tr>
											<td style="padding:5px;">
												BOOKING REF. 
											</td>
											<td style="padding:5px; text-align:center;">'.((isset($_POST['booking_ref_a']) AND trim($_POST['booking_ref_a'])!='' AND $_POST['booking_ref_a']!=null) ? $_POST['booking_ref_a'] : "-----").'</td>
											
										</tr>
										<tr>
											<td style="padding:5px; text-align:center;">
												INVOICE NO. :
											</td>
											<td style="padding:5px; text-align:center;">'.((isset($_POST['invoice_num_a']) AND trim($_POST['invoice_num_a'])!='' AND $_POST['invoice_num_a']!=null) ? $_POST['invoice_num_a'] : "-----").'</td>
											
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									
									<table border=\'1\' bordercolor=\'#777\' style=\'min-height:166px;margin-left:auto;margin-right:auto;width:100%;border-collapse:collapse;border-color:#777;font-size:12px;text-align:left;\'>
										<tr>
											<td style="padding:15px;" width="55%">Description</td>
											<td style="padding:15px;" width="5%">Qty</td>
											<td style="padding:15px;" width="20%">Unit Price('. $currency.')</td>
											<td style="padding:15px;" width="20%">Total Price('.$currency.')</td>
										</tr>
										<tr>
											<td style="padding:5px; min-height:100px;">
												<p>Collection from <span >'.((isset($_POST['from_a']) AND trim($_POST['from_a'])!='' AND $_POST['from_a']!=null) ? $_POST['from_a'] : "-----").'</span> and Delivery to <span >'.((isset($_POST['to_a']) AND trim($_POST['to_a'])!='' AND $_POST['to_a']!=null) ? $_POST['to_a'] : "-----").'</span></p>
												<p >'.$consignee.'</p>
												<p>&nbsp;</p>
												<p>&nbsp;</p>
												<p>&nbsp;</p>
												<p>MAWB: <span >'.$row['mawb1']."-".$row['mawb2'].'</span></p>
												<p>HAWB: <span >'.$hawb.'</span></p>
												<p>Weight: <span >'.$row['total_weight'].'</span> </p>
											</td>
											<td style="padding:5px; text-align:center;">1</td>
											<td style="padding:5px; text-align:center;">'.number_format($price_for_office,2).' '.$currency.'</td>
											<td style="padding:5px; text-align:center;">'.number_format($price_for_office,2).' '.$currency.'</td>
											
										</tr>
										<tr>
											<td style="padding:5px;" colspan="2">
												
											</td>
											<td style="text-align:center;" colspan="2">
												
												<table  border=\'1\' bordercolor=\'#777\' style=\'min-height:166px;margin-left:auto;margin-right:auto;width:100%;border-collapse:collapse;border-color:#777;font-size:12px;text-align:left;\'>
													<tr>
														<td style="padding:15px;" width="50%">SUB TOTAL  ('. $currency.')</td>
														<td style="padding:15px;" width="50%">'.number_format($price_for_office,2) .' '.$currency.'</td>
													</tr>
													<tr>
														<td style="padding:15px;" width="50%">VAT@20.00% ('.$currency.')</td>
														<td style="padding:15px;" width="50%">'.number_format($vat,2).' '.$currency.'</td>
													</tr>
													<tr>
														<td style="padding:15px; font-family:arial;font-size:19px; font-weight:bold;" width="50%">TOTAL</td>
														<td style="padding:15px;" width="50%">'.number_format(($price_for_office + $vat),2).' '.$currency.'</td>
													</tr>
												</table>
											</td>
											
										</tr>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="2" style=\'background-color:#f5f5f5;padding:25px;\'>
					PLEASE REMIT THE ABOVE AMOUNT TO THE FOLLOWING ACCOUNT:<br>Account Name: Europost Express (UK) Limited<br>Europost Accounts<br>(£) GBP A/C No.: 31892150<br>Sortcode: 40 – 46 – 09<br>IBAN: GB05 HBUK 4046 0931 8921 50<br>BIC: HBUKGB4162k<br>Bank SWIFT Code: HBUKGB4B<br>Euro A/C No.: 76899401<br>IBAN: GB08 MIDL 4005 1576 8994 01<br>BIC/SWIFT Code: HBUKGB4B<br>($) USD A/C No. 76899393<br>IBAN: GB30 MIDL 4005 1576 8993 93<br>BIC/ SWIFT Code: HBUKGB4B
				</td>
			</tr>
		</tbody>
	</table>';*/
$accountancy_msg ='
	<table cellpadding=\'5\' cellspacing=\'1\' border=\'0\' style=\'margin-left:auto;margin-right:auto;width:100%;border:0px;font-family:arial;font-size:12px;direction:ltr;border:none\'>
		<tbody>
			<tr>
				<td style=\'background-color:#ffcc33;text-align:left;font-weight:bold;color:#ff3333;\' width=\'80%\'>
					Dear Customer ,<br>Here is the invoice of order by the Tracking ID of '.$row['tid'].':
				</td>
				<td width=\'20%\' bgcolor="#ffffff" align="right" valign="top" style="background-color:#ffffff;text-align:left;font-weight:bold;color:#ff3333;padding:10px 25px 20px 0px">
					<a href="http://bookingparcel.com/" target="_blank" rel="noreferrer"><img src="http://bookingparcel.com/logo.gif" alt="EuropostExpress" width="237" height="56" border="0" style="display:block"></a>
				</td>
			</tr>
			<tr>
				<td colspan="2" style=\'background-color:#f5f5f5;padding:25px;\' id="print">
					<table  border=\'0\' style=\'margin-left:auto;margin-right:auto;width:90%;font-size:12px;text-align:left;\'>
						<tbody>
							<tr>
								<td style="padding:5px;" width="55%">
									<span style="font-family:arial;font-size:13px;"><b>Europost Express (UK) Ltd.</b></span><br>4 Corringham Road,<br>Wembley - Middlesex<br>HA9 9QA- London , UK<br>Tel : +44(0) 7886105417 & +44(0) 2083852177<br>VAT No.: 220335165<br>EORI No: GB220 3351 65000
								</td>
								<td style="padding:5px;">
									<center>
										<p><a href="http://bookingparcel.com" target="_blank"><img src="http://bookingparcel.com/logo.gif" alt="EuroPost Express" style="margin-top:5px;" title="EuropPost Express"></a></p>
										<p></p>
										<p></p>
										<p><img src="http://bookingparcel.com/paid.png" style="margin-bottom:5px;"></p>
									</center>
								</td>
							</tr>
							<tr>
								<td>
									<table style=\'float:right;margin-left:auto;margin-right:auto;width:88%;font-size:12px;text-align:left;padding-bottom:0px;\'>
										<tr >
											<td style="padding:5px;font-weight:bold;font-size:2.5em;padding-bottom:0px;" colspan="2">&nbsp; </td>
										</tr>
									</table>
									<table border=\'1\' bordercolor=\'#777\' style=\'float:left;min-height:166px;margin-left:auto;margin-right:auto;width:97%;border-collapse:collapse;border-color:#777;font-size:12px;text-align:left;\'>
										<tr>
											<td style="padding:5px;"><b>INVOICE TO </b></td>
										</tr>
										<tr>
											<td style="padding:5px;">
												<p >'.nl2br((isset($_POST['address_a']) AND trim($_POST['address_a'])!='' AND $_POST['address_a']!=null) ? $_POST['address_a'] : "-----").'</p>
											</td>
										</tr>
									</table>
								</td>
								<td>
									<table style=\'float:right;margin-left:auto;margin-right:auto;width:88%;font-size:12px;text-align:left;padding-bottom:0px;\'>
										<tr >
											<td style="padding:5px;font-weight:bold;font-size:2.5em;padding-bottom:0px;" colspan="2">Invoice </td>
										</tr>
									</table>
									<table border=\'1\' bordercolor=\'#777\' style=\'padding-top:0px;float:right;min-height:166px;margin-left:auto;margin-right:auto;width:88%;border-collapse:collapse;border-color:#777;font-size:12px;text-align:left;\'>
										<tr>
											<td style="padding:5px;padding-top:0px;">
												<span style="font-weight:bold;">DATE :</span>
											</td>
											<td style="padding:5px; text-align:center;font-weight:bold;">'.((isset($_POST['date_a']) AND trim($_POST['date_a'])!='' AND $_POST['date_a']!=null) ? $_POST['date_a'] : "-----").'</td>
											
										</tr>
										<tr>
											<td style="padding:5px;">
												<span style="font-weight:bold;">ORDER REF.:</span>
											</td>
											<td style="padding:5px; text-align:center;font-weight:bold;">'.((isset($_POST['ref_a']) AND trim($_POST['ref_a'])!='' AND $_POST['ref_a']!=null) ? $_POST['ref_a'] : "-----").'</td>
											
										</tr>
										<tr>
											<td style="padding:5px;">
												<span style="font-weight:bold;">BOOKING REF.:</span>
											</td>
											<td style="padding:5px; text-align:center;font-weight:bold;">'.((isset($_POST['booking_ref_a']) AND trim($_POST['booking_ref_a'])!='' AND $_POST['booking_ref_a']!=null) ? $_POST['booking_ref_a'] : "-----").'</td>
											
										</tr>
										<tr>
											<td style="padding:5px; text-align:center;">
												<span style="font-weight:bold;">INVOICE NO.:</span>
											</td>
											<td style="padding:5px; text-align:center;font-weight:bold;">'.((isset($_POST['invoice_num_a']) AND trim($_POST['invoice_num_a'])!='' AND $_POST['invoice_num_a']!=null) ? $_POST['invoice_num_a'] : "-----").'</td>
											
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2"style="padding:5px;min-height:5px;"></td>
							</tr>
							<tr>
								<td colspan="2">
									
									<table border=\'1\' bordercolor=\'#777\' style=\'min-height:166px;margin-left:auto;margin-right:auto;width:100%;border-collapse:collapse;border-color:#777;font-size:12px;text-align:left;\'>
										<tr>
											<td style="padding:15px; text-align:center;font-weight:bold;" width="55%">Description</td>
											<td style="padding:15px; text-align:center;font-weight:bold;" width="5%">Qty</td>
											<td style="padding:15px; text-align:center;font-weight:bold;" width="20%">Unit Price('.$currency.')</td>
											<td style="padding:15px; text-align:center;font-weight:bold;" width="20%">Total Price('.$currency.')</td>
										</tr>
										<tr>
											<td style="padding:5px; min-height:100px;">
												<span style="font-weight:bold;">
												Collection from <span >'.((isset($_POST['from_a']) AND trim($_POST['from_a'])!='' AND $_POST['from_a']!=null) ? $_POST['from_a'] : "-----").'</span> and Delivery to <span >'.((isset($_POST['to_a']) AND trim($_POST['to_a'])!='' AND $_POST['to_a']!=null) ? $_POST['to_a'] : "-----").'</span><br>
												<span >'.$consignee.'</span><br><br>';
												if($row['mawb1']!='' AND $row['mawb2']!='') $accountancy_msg .= "MAWB: <span >".$row['mawb1']."-".$row['mawb2']."</span><br>";
												
												$accountancy_msg .= 'HAWB: <span >'.$hawb.'</span><br><br>
												Weight: <span >'.$row['total_weight'] .((stripos($row['total_weight'], 'kg') != false) ? "" : " Kg").'</span></span>
											</td>
											<td style="padding:5px; text-align:center;">1</td>
											<td style="padding:5px; text-align:center;">'.number_format($offer_price,2).' '.$currency.'</td>
											<td style="padding:5px; text-align:center;">'.number_format($offer_price,2).' '.$currency.'</td>
										</tr>';
										if($dif_cost>0){
											$accountancy_msg .='
											<tr>
												<td style="padding:5px;">
													Difference Cost 
												<td>
												<td style="padding:5px; text-align:center;">1</td>
												<td style="padding:5px; text-align:center;">'.number_format($dif_cost,2).' '.$currency.'</td>
												<td style="padding:5px; text-align:center;">'.number_format($dif_cost,2).' '.$currency.'</td>
											<tr>';	
										}										
										$accountancy_msg .=''.(($discount>0) ? "
										<tr>
											<td style=\"padding:5px;\">".$row['discount']." ".($row['discount_type']=='percent' ? '%' : $currency). " Discount
											</td>
											<td style=\"padding:5px; text-align:center;\"></td>
											<td style=\"padding:5px; text-align:center;\"></td>
											<td style=\"padding:5px; text-align:center;\">".number_format($discount,2)." ".($currency). "
											</td>
											
										</tr>" : "").'
										<tr>
											<td style="padding:5px;" colspan="2">
												
											</td>
											<td style="text-align:center;" colspan="2">
												
												<table  border=\'1\' bordercolor=\'#777\' style=\'min-height:166px;margin-left:auto;margin-right:auto;width:100%;border-collapse:collapse;border-color:#777;font-size:12px;text-align:left;\'>
													<tr>
														<td style="padding:5px;font-size:10px;" width="50%">SUB TOTAL  ('.$currency.')</td>
														<td style="padding:5px;" width="50%">'. number_format($price_for_office+$dif_cost,2).' '.$currency.'</td>
													</tr>
													<tr>
														<td style="padding:5px;" width="50%">VAT@20.00% ('.$currency.')</td>
														<td style="padding:5px;" width="50%">'.number_format($vat,2).' '.$currency.'</td>
													</tr>
													<tr>
														<td style="padding:5px; font-weight:bold;" width="50%">TOTAL</td>
														<td style="padding:5px; font-weight:bold;" width="50%">'.number_format(($price_for_office+$vat+$dif_cost),2).' '.$currency.'</td>
													</tr>
												</table>
											</td>
											
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" style=\'background-color:#f5f5f5;padding:3px;\'>
								PLEASE REMIT THE ABOVE AMOUNT TO THE FOLLOWING ACCOUNT:<br>Account Name: Europost Express (UK) Limited<br>Europost Accounts<br>(£) GBP A/C No.: 31892150<br>Sortcode: 40 – 46 – 09<br>IBAN: GB05 HBUK 4046 0931 8921 50<br>BIC: HBUKGB4162k<br>Bank SWIFT Code: HBUKGB4B<br>Euro A/C No.: 76899401<br>IBAN: GB08 MIDL 4005 1576 8994 01<br>BIC/SWIFT Code: HBUKGB4B<br>($) USD A/C No. 76899393<br>IBAN: GB30 MIDL 4005 1576 8993 93<br>BIC/ SWIFT Code: HBUKGB4B
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
		</tbody>
	</table>';
	$temp_html = $header . $accountancy_msg . $footer;
	writeStringToFile("/home/bookingparcel/public_html/admin/invoice/accountant/".$invoice_no.".html",$temp_html);
	echo "<br><a href='invoice/accountant/".$invoice_no.".html'>Accounancy Invoice</a> <br>";
	if($date == 0){
		$q = "INSERT INTO `invoices` (`invoice_no`, `invoice_type`, `qref`, `timestamp`) VALUES (".$invoice_no.", 0, ".$id.", ".time().");";
		mysql_query($q);
	}
	
	$mail = new PHPMailer;
	//$mail->IsSMTP();
	$mail->Host = "mail.bookingparcel.com";
	$mail->Port = 25;
	$mail->SMTPOptions = array(
		'ssl' => array(
			'verify_peer' => false,
			'verify_peer_name' => false,
			'allow_self_signed' => true
		)
	);
	$mail->SMTPAuth = true;
	$mail->Username = "quote1@bookingparcel.com";
	$mail->Password = "02May1964@5017@anitapouya";


	$mail->setFrom('acc@europostexpress.co.uk', 'Cargo EuroPostExpress');
	$mail->addReplyTo('cargo@europostexpress.co.uk', 'Cargo EuroPostExpress');
//	$mail->AddCC('cargo@epxcargo.co.uk', "BookingParcel(invoices)");
	$mail->AddCC('backup1@bookingparcel.com', "BookingParcel(invoices)");
	$mail->addAddress("acc@europostexpress.co.uk", "Invoices");
	$mail->addAttachment("/home/bookingparcel/public_html/admin/invoice/accountant/".$invoice_no.".html");
	
	$mail->CharSet ="utf-8";
	$mail->isHTML(true);
	$mail->Subject = "Invoice For Order ".$row['tid'];
	
	$mail->Body = $accountancy_msg;
	
	if (!$mail->send()) {
		$error_m .= "Mailer Error: " . $mail->ErrorInfo ."<br>";
	} else {
		$error_m .= "acc@europostexpress.co.uk Sent Successfully<br>";
	}
	
}
elseif($_GET['type']==1){

	$offer_price = $row['offer_price'];
	$currency = "GBP";
	$prices = explode(" | ",$row['offered_p']);
	foreach($prices as $k=>$v){
		if($v!=''){
			$tmp = explode(") ",$v);
			$ttmp = explode("=>",$tmp[1]);
			$confirmed = false;
			$conf_text = "";
			if($ttmp[0]=='on')
			{
				$offer_price = $ttmp[2];
				$currency = $ttmp[3];
				break;
			}
		}
	}
	
	$offer_price= str_replace(",","",$offer_price);	
$dif_cost = $row['dif_offer'];
$price_for_office = $offer_price;
$vat = 0;
if($row['export']=='international')
{
	$vat = 0;
}
elseif($row['export']=='domestic')
{
	$vat = ($offer_price+$dif_cost) * $row['vat'] / 100;
}
$customer_msg ='
	<table cellpadding=\'5\' cellspacing=\'1\' border=\'0\' style=\'margin-left:auto;margin-right:auto;width:100%;border:0px;font-family:arial;font-size:12px;direction:ltr;border:none\'>
		<tbody>
			<tr>
				<td style=\'background-color:#ffcc33;text-align:left;font-weight:bold;color:#ff3333;\' width=\'80%\'>
					Dear Customer ,<br>Here is the invoice of order by the Tracking ID of '.$row['tid'].':
				</td>
				<td width=\'20%\' bgcolor="#ffffff" align="right" valign="top" style="background-color:#ffffff;text-align:left;font-weight:bold;color:#ff3333;padding:10px 25px 20px 0px">
					<a href="http://bookingparcel.com/" target="_blank" rel="noreferrer"><img src="http://bookingparcel.com/logo.gif" alt="EuropostExpress" width="237" height="56" border="0" style="display:block"></a>
				</td>
			</tr>
			<tr>
				<td colspan="2" style=\'background-color:#f5f5f5;padding:25px;\' id="print">
					<table  border=\'0\' style=\'margin-left:auto;margin-right:auto;width:90%;font-size:12px;text-align:left;\'>
						<tbody>
							<tr>
								<td style="padding:5px;" width="55%">
									<span style="font-family:arial;font-size:13px;"><b>Europost Express (UK) Ltd.</b></span><br>4 Corringham Road,<br>Wembley - Middlesex<br>HA9 9QA- London , UK<br>Tel : +44(0) 7886105417 & +44(0) 2083852177<br>VAT No.: 220335165<br>EORI No: GB220 3351 65000
								</td>
								<td style="padding:5px;">
									<center>
										<p><a href="http://bookingparcel.com" target="_blank"><img src="http://bookingparcel.com/logo.gif" alt="EuroPost Express" style="margin-top:5px;" title="EuropPost Express"></a></p>
										<p></p>
										<p></p>
										<p><img src="http://bookingparcel.com/paid.png" style="margin-bottom:5px;"></p>
									</center>
								</td>
							</tr>
							<tr>
								<td>
									<table style=\'float:right;margin-left:auto;margin-right:auto;width:88%;font-size:12px;text-align:left;padding-bottom:0px;\'>
										<tr >
											<td style="padding:5px;font-weight:bold;font-size:2.5em;padding-bottom:0px;" colspan="2">&nbsp; </td>
										</tr>
									</table>
									<table border=\'1\' bordercolor=\'#777\' style=\'float:left;min-height:166px;margin-left:auto;margin-right:auto;width:97%;border-collapse:collapse;border-color:#777;font-size:12px;text-align:left;\'>
										<tr>
											<td style="padding:5px;"><b>INVOICE TO </b></td>
										</tr>
										<tr>
											<td style="padding:5px;">
												<p >'.nl2br((isset($_POST['address']) AND trim($_POST['address'])!='' AND $_POST['address']!=null) ? $_POST['address'] : "-----").'</p>
											</td>
										</tr>
									</table>
								</td>
								<td>
									<table style=\'float:right;margin-left:auto;margin-right:auto;width:88%;font-size:12px;text-align:left;padding-bottom:0px;\'>
										<tr >
											<td style="padding:5px;font-weight:bold;font-size:2.5em;padding-bottom:0px;" colspan="2">Invoice </td>
										</tr>
									</table>
									<table border=\'1\' bordercolor=\'#777\' style=\'padding-top:0px;float:right;min-height:166px;margin-left:auto;margin-right:auto;width:88%;border-collapse:collapse;border-color:#777;font-size:12px;text-align:left;\'>
										<tr>
											<td style="padding:5px;padding-top:0px;">
												<span style="font-weight:bold;">DATE :</span>
											</td>
											<td style="padding:5px; text-align:center;font-weight:bold;">'.((isset($_POST['date']) AND trim($_POST['date'])!='' AND $_POST['date']!=null) ? $_POST['date'] : "-----").'</td>
											
										</tr>
										<tr>
											<td style="padding:5px;">
												<span style="font-weight:bold;">ORDER REF.:</span>
											</td>
											<td style="padding:5px; text-align:center;font-weight:bold;">'.((isset($_POST['ref']) AND trim($_POST['ref'])!='' AND $_POST['ref']!=null) ? $_POST['ref'] : "-----").'</td>
											
										</tr>
										<tr>
											<td style="padding:5px;">
												<span style="font-weight:bold;">BOOKING REF.:</span>
											</td>
											<td style="padding:5px; text-align:center;font-weight:bold;">'.((isset($_POST['booking_ref']) AND trim($_POST['booking_ref'])!='' AND $_POST['booking_ref']!=null) ? $_POST['booking_ref'] : "-----").'</td>
											
										</tr>
										<tr>
											<td style="padding:5px; text-align:center;">
												<span style="font-weight:bold;">INVOICE NO.:</span>
											</td>
											<td style="padding:5px; text-align:center;font-weight:bold;">'.((isset($_POST['invoice_num']) AND trim($_POST['invoice_num'])!='' AND $_POST['invoice_num']!=null) ? $_POST['invoice_num'] : "-----").'</td>
											
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2"style="padding:5px;min-height:5px;"></td>
							</tr>
							<tr>
								<td colspan="2">
									
									<table border=\'1\' bordercolor=\'#777\' style=\'min-height:166px;margin-left:auto;margin-right:auto;width:100%;border-collapse:collapse;border-color:#777;font-size:12px;text-align:left;\'>
										<tr>
											<td style="padding:15px; text-align:center;font-weight:bold;" width="55%">Description</td>
											<td style="padding:15px; text-align:center;font-weight:bold;" width="5%">Qty</td>
											<td style="padding:15px; text-align:center;font-weight:bold;" width="20%">Unit Price('.$currency.')</td>
											<td style="padding:15px; text-align:center;font-weight:bold;" width="20%">Total Price('.$currency.')</td>
										</tr>
										<tr>
											<td style="padding:5px; min-height:100px;">
												<span style="font-weight:bold;">
												Collection from <span >'.((isset($_POST['from']) AND trim($_POST['from'])!='' AND $_POST['from']!=null) ? $_POST['from'] : "-----").'</span> and Delivery to <span >'.((isset($_POST['to']) AND trim($_POST['to'])!='' AND $_POST['to']!=null) ? $_POST['to'] : "-----").'</span><br>
												<span >'.$consignee.'</span><br><br>';
												if($row['mawb1']!='' AND $row['mawb2']!='') $customer_msg .= "MAWB: <span >".$row['mawb1']."-".$row['mawb2']."</span><br>";
												
												$customer_msg .= '
												HAWB: <span >'.$hawb.'</span><br><br>
												Weight: <span >'.$row['total_weight'] .((stripos($row['total_weight'], 'kg') != false) ? "" : " Kg").'</span></span>
											</td>
											<td style="padding:5px; text-align:center;">1</td>
											<td style="padding:5px; text-align:center;">'.number_format($offer_price,2).' '.$currency.'</td>
											<td style="padding:5px; text-align:center;">'.number_format($offer_price,2).' '.$currency.'</td>
										</tr>
										';
										if($dif_cost>0){
											$customer_msg .='
											<tr>
												<td style="padding:5px;">
													Difference Cost 
												<td>
												<td style="padding:5px; text-align:center;">1</td>
												<td style="padding:5px; text-align:center;">'.number_format($dif_cost,2).' '.$currency.'</td>
												<td style="padding:5px; text-align:center;">'.number_format($dif_cost,2).' '.$currency.'</td>
											<tr>';	
										}										
										$customer_msg .='
										<tr>
											<td style="padding:5px;" colspan="2">
												
											</td>
											<td style="text-align:center;" colspan="2">
												
												<table  border=\'1\' bordercolor=\'#777\' style=\'min-height:166px;margin-left:auto;margin-right:auto;width:100%;border-collapse:collapse;border-color:#777;font-size:12px;text-align:left;\'>
													<tr>
														<td style="padding:5px;font-size:10px;" width="50%">SUB TOTAL  ('.$currency.')</td>
														<td style="padding:5px;" width="50%">'. number_format($offer_price+$dif_cost,2).' '.$currency.'</td>
													</tr>
													<tr>
														<td style="padding:5px;" width="50%">VAT@20.00% ('.$currency.')</td>
														<td style="padding:5px;" width="50%">'.number_format($vat,2).' '.$currency.'</td>
													</tr>
													<tr>
														<td style="padding:5px; font-weight:bold;" width="50%">TOTAL</td>
														<td style="padding:5px; font-weight:bold;" width="50%">'.number_format(($offer_price+$vat+$dif_cost),2).' '.$currency.'</td>
													</tr>
												</table>
											</td>
											
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" style=\'background-color:#f5f5f5;padding:3px;\'>
								PLEASE REMIT THE ABOVE AMOUNT TO THE FOLLOWING ACCOUNT:<br>Account Name: Europost Express (UK) Limited<br>Europost Accounts<br>(£) GBP A/C No.: 31892150<br>Sortcode: 40 – 46 – 09<br>IBAN: GB05 HBUK 4046 0931 8921 50<br>BIC: HBUKGB4162k<br>Bank SWIFT Code: HBUKGB4B<br>Euro A/C No.: 76899401<br>IBAN: GB08 MIDL 4005 1576 8994 01<br>BIC/SWIFT Code: HBUKGB4B<br>($) USD A/C No. 76899393<br>IBAN: GB30 MIDL 4005 1576 8993 93<br>BIC/ SWIFT Code: HBUKGB4B
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
		</tbody>
	</table>';
	
	$temp_html = $header . $customer_msg . $footer;
	writeStringToFile("/home/bookingparcel/public_html/admin/invoice/customer/".$invoice_no.".html",$temp_html);
	echo "<a href='invoice/customer/".$invoice_no.".html'>Customer Invoice</a> <br>";
	if($date == 0){
		$q = "INSERT INTO `invoices` (`invoice_no`, `invoice_type`, `qref`, `timestamp`) VALUES (".$invoice_no.", 1, ".$id.", ".time().");";
		mysql_query($q);
	}

	
	$mail = new PHPMailer;
	//$mail->IsSMTP();
	$mail->Host = "mail.bookingparcel.com";
	$mail->Port = 25;
	$mail->SMTPOptions = array(
		'ssl' => array(
			'verify_peer' => false,
			'verify_peer_name' => false,
			'allow_self_signed' => true
		)
	);
	$mail->SMTPAuth = true;
	$mail->Username = "quote1@bookingparcel.com";
	$mail->Password = "02May1964@5017@anitapouya";


	$mail->setFrom('acc@europostexpress.co.uk', 'Cargo EuroPostExpress');
	$mail->addReplyTo('cargo@europostexpress.co.uk', 'Cargo EuroPostExpress');
//	$mail->AddCC('cargo@epxcargo.co.uk', "BookingParcel(invoices)");
	$mail->AddCC('backup1@bookingparcel.com', "BookingParcel(invoices)");
	if($row['invemail']!=''){
		$mail->addAddress($row['invemail'], $row['fname']);
		$mail->AddCC($row['email'], $row['fname']);
	}
	else{
		$mail->addAddress($row['email'], $row['fname']);
	}
	//if($row['cc1']!='') $mail->AddCC($row['cc1'], $row['fname']);
	//if($row['cc2']!='') $mail->AddCC($row['cc2'], $row['fname']);
	//if($row['cc3']!='') $mail->AddCC($row['cc3'], $row['fname']);
	//if($row['cc4']!='') $mail->AddCC($row['cc4'], $row['fname']);
	$mail->addAttachment("/home/bookingparcel/public_html/admin/invoice/customer/".$invoice_no.".html");
	
	$mail->CharSet ="utf-8";
	$mail->isHTML(true);
	$mail->Subject = "Invoice For Order ".$row['tid'];
	
	$mail->Body = $customer_msg;
	
	if (!$mail->send()) {
		$error_m .= "Mailer Error: " . $mail->ErrorInfo ."<br>";
	} else {
		$error_m .= $row['email']." Sent Successfully<br>";
	}
}


?>
                </div>
            </div>
        </div>
        <div class="clear"></div>
<?php
}
if($error_m!=""){
	?>
<div class="grid_12">
    <div class="box round first">
        <h2>Notifications</h2>
		<div class="block">
			<div class="message success">
				<h5>Success!</h5>
				<p>
					<?php 
					
					echo $error_m; ?>
				</p>
			</div>
		</div>
	</div>
</div>
	<?php
}
?>
    </div>
    <div class="clear">
    </div>
    <div id="site_info">
        <p>
            Copyright <a href="#">BlueWhale Admin</a>. All Rights Reserved.
        </p>
    </div>
</body>
</html>

<?php 
include("footer.php");
?>