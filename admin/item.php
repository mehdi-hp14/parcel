<?php

include("../post_forms/cnf.php");
include("conf.php");
require 'mailer/PHPMailerAutoload.php';

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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Dashboard | Booking Parcel Admin</title>
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

<style>
    .agents_table {
		table-layout:fixed;
		margin-left:auto;
		margin-right:auto;
		width:98%;
		border-collapse:collapse;
		border-color:#777;
		font-size:12px;
		white-space: nowrap;
		word-break: break-all;
		word-wrap: break-word;
    }
	.agents_td {
		word-break: break-all;
		word-wrap: break-word;
		white-space: nowrap;
	}
</style>
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
$('#checkall').click(function(event) {
    if(this.checked) {
        // Iterate each checkbox
        $(':checkbox').each(function() {
            this.checked = true;
        });
    }
	else{
        // Iterate each checkbox
        $(':checkbox').each(function() {
            this.checked = false;
        });
	}
});
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
    </script>
<script type="text/javascript">
	function choosemsg(){
		var choosemsg = document.getElementById('choosemsg');
		var p = choosemsg.options[choosemsg.selectedIndex].value;
		if(p!='-')
			location.assign('premsend.php?mid='+p+'&id=<?php echo $id; ?>&type=2');
	}
	function choosemsgemail(){
		var choosemsgemail = document.getElementById('choosemsgemail');
		var p = choosemsgemail.options[choosemsgemail.selectedIndex].value;
		if(p!='-')
			location.assign('premsend.php?mid='+p+'&id=<?php echo $id; ?>&type=1');
	}

function printContent(el){
	var restorepage = document.body.innerHTML;
	var printcontent = document.getElementById(el).innerHTML;
	document.body.innerHTML = printcontent;
	window.print();
	document.body.innerHTML = restorepage;
}
$(function() {
        var scntDiv = $('#attach_d');
        var i = $('#attach_d p').size() + 1;

        $('#addScnt').live('click', function() {

                $('<p><label for="attachment"><input type="file" id="attachment" name="uploaded_file[]" accept=".gif,.jpg,.jpeg,.png,.pdf,.zip,.rtf,.doc,.docx,.xls,.xlsx"></label>&nbsp;&nbsp;<a href="#" id="addScnt"><img src="../post_forms/images/icons/fam/add.png"></a>&nbsp;<a href="#" id="remScnt"><img src="../post_forms/images/icons/fam/delete.png"></a>&nbsp;&nbsp;&nbsp;please note that supported extentions are (.gif,.jpg,.jpeg,.png,.pdf,.zip) And maximum size is 2MB.</p>').appendTo(scntDiv);
                i++;
                return false;
        });

        $('#remScnt').live('click', function() {
                if( i > 2 ) {
                        $(this).parents('p').remove();
                        i--;
                }
                return false;
        });
});
</script>
</head>
<body>
    <div class="container_12">
        <?= require_once "./partials/adminProfile.php"?>

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
        <div class="grid_2">
            <div class="box sidemenu">
                <div class="block" id="section-menu">
                    <ul class="section menu">
                        <li><a class="menuitem">Main Menu</a>
                            <ul class="submenu">
                                <li><a href="../">Home</a> </li>
                                <li><a href="dashboard.php">Admin Page</a> </li>
                                <li><a href="agents.php">Agents Management Page</a> </li>
                                <li><a href="premessages.php">Pre-Defined Messages Page</a> </li>
                                <li><a href="files.php">Files Management</a> </li>
                                <li><a href="logout.php">logout</a> </li>

                            </ul>
                        </li>
                        <!--<li><a class="menuitem">Menu 2</a>
                            <ul class="submenu">
                                <li><a>Submenu 1</a> </li>
                                <li><a>Submenu 2</a> </li>
                                <li><a>Submenu 3</a> </li>
                                <li><a>Submenu 4</a> </li>
                                <li><a>Submenu 5</a> </li>
                            </ul>
                        </li>
                        <li><a class="menuitem">Menu 3</a>
                            <ul class="submenu">
                                <li><a>Submenu 1</a> </li>
                                <li><a>Submenu 2</a> </li>
                                <li><a>Submenu 3</a> </li>
                                <li><a>Submenu 4</a> </li>
                                <li><a>Submenu 5</a> </li>
                                <li><a>Submenu 1</a> </li>
                                <li><a>Submenu 2</a> </li>
                                <li><a>Submenu 3</a> </li>
                                <li><a>Submenu 4</a> </li>
                                <li><a>Submenu 5</a> </li>
                            </ul>
                        </li>
                        <li><a class="menuitem">Menu 4</a>
                            <ul class="submenu">
                                <li><a>Submenu 1</a> </li>
                                <li><a>Submenu 2</a> </li>
                                <li><a>Submenu 3</a> </li>
                                <li><a>Submenu 4</a> </li>
                                <li><a>Submenu 5</a> </li>
                                <li><a>Submenu 6</a> </li>
                                <li><a>Submenu 7</a> </li>
                                <li><a>Submenu 8</a> </li>
                                <li><a>Submenu 9</a> </li>
                                <li><a>Submenu 10</a> </li>

                            </ul>
                        </li>-->
                    </ul>
                </div>
            </div>
        </div>
        <div class="grid_10">
            <div class="box round first">
                <h2>Order Details</h2>
                <div class="block">

<button class="btn btn-orange" onclick="window.location.href='itemedit.php?id=<?php echo $id;?>';">Edit this order</button>&nbsp;&nbsp;&nbsp;<br>
                    <?php
$con = mysql_connect(DB_HOST,DB_USER,DB_PASS) or die(mysql_error());
mysql_select_db(DB_NAME, $con) or die(mysql_error());

$output = "";
$q = "SELECT * FROM `quote` WHERE `id`=".$id."";
$r = mysql_query($q) or die(mysql_error());
if(mysql_num_rows($r)>0){
	$_c = 1;
	while($row = mysql_fetch_array($r)){
		$output .="<tr>";
		$output .="<td >".$row['from']."</td>";
		$output .="<td >".$row['from_st']."</td>";
		$output .="<td >".$row['from_location']."</td>";
		$output .="<td >".$row['to']."</td>";
		$output .="<td >".$row['to_st']."</td>";
		$output .="<td >".$row['to_location']."</td>";
		$output .="<td >".$row['shipping_type']."</td>";
		$output .="<td >".$row['shipping_sub_type']."</td>";
		$output .="<td >".$row['ship_container']."</td>";
		$output .="<td >".$row['insurance']."</td>";
		$output .="<td >".$row['pack_type']."</td>";
		$output .="<td >".$row['item_c']."</td>";
		$output .="<td >".str_replace(" | ","<br>",$row['dims'])."</td>";
		$output .="<td >".$row['total_weight']."</td>";
		$output .="<td >".$row['item_desc']."</td>";
		$output .="</tr>";
		$_c++;
		break;
	}
}
else{
	$output = "<tr><td colspan=\"15\">No Entery Detected</td></tr>";
}

if($_c==2){
	echo "Item ID : ".$id."<br>";
	echo "Tracking ID : ".$row['tid']."<br>";
	echo "Name : ".$row['fname']."<br>";
	//echo "Last Name : ".$row['lname']."<br>";
	echo "Company : ".$row['company']."<br>";
	echo "Phone : ".$row['phone']."<br>";
	echo "E-mail : ".$row['email']."<br>";
	echo "Prefered Contact Method : ".$row['pr_contact_m']."<br>";
	echo "Prefered Contact Time : ".$row['pr_contact_t']."<br>";
	echo "Note : ".$row['note']."<br><br>";
	echo "Shipping Date : ".$row['date']."<br>";
	echo "Exact Date : ".$row['exact_date']."<br><br><br>";
}
$error_m ="";
if(isset($_POST['submit'])){
	$error = true;
	if(isset($_POST['t']) AND $_POST['t']=='1'){
		if(isset($_POST['message']) AND $_POST['message']!='' AND $_POST['message']!=null){
			if(isset($_POST['email']) AND trim($_POST['email'])!='' AND $_POST['email']!=null AND filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
			$q = "INSERT INTO `qstatus` (`rid`, `message`, `timestamp`) VALUES (".$id.", '".$_POST['message']."', ".time().")";
			mysql_query($q);


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
			//$mail->SMTPDebug = 2;
			$mail->SMTPAuth = true;
			$mail->Username = "quote1@bookingparcel.com";
			$mail->Password = "02May1964@5017@anitapouya";
			$mail->setFrom('quote1@bookingparcel.com', 'Booking Parcel');
			$mail->addReplyTo('quote1@bookingparcel.com', 'Booking Parcel');
			//$mail->addAddress($row['email'], "". $row['fname'] ." ". $row['lname'] ."");

			$mail->addAddress($_POST['email'], "". $row['fname'] ." ". $row['lname'] ."");
			if($row['cc1']!='' AND isset($_POST['cc1']) AND $_POST['cc1']==$row['cc1']) $mail->AddCC($row['cc1'], "". $row['fname'] ." ". $row['lname'] ."");
			if($row['cc2']!='' AND isset($_POST['cc2']) AND $_POST['cc2']==$row['cc2']) $mail->AddCC($row['cc2'], "". $row['fname'] ." ". $row['lname'] ."");
			if($row['cc3']!='' AND isset($_POST['cc3']) AND $_POST['cc3']==$row['cc3']) $mail->AddCC($row['cc3'], "". $row['fname'] ." ". $row['lname'] ."");
			if($row['cc4']!='' AND isset($_POST['cc4']) AND $_POST['cc4']==$row['cc4']) $mail->AddCC($row['cc4'], "". $row['fname'] ." ". $row['lname'] ."");

			//$mail->AddCC('cargo@epxcargo.co.uk', "BookingParcel(presend)");
			$mail->AddCC('backup1@bookingparcel.com', "BookingParcel(presend)");

			$mail->CharSet ="utf-8";
			$mail->isHTML(true);
			$mail->Subject = "Latest Update (". $row['tid'] .")";

$mail->Body = "<table cellpadding='5' cellspacing='1' style='margin-left:auto;margin-right:auto;width:100%;border:0px;font-family:tahoma;font-size:12px;direction:ltr;border:thin solid #777;'>
 <tr>
  <td style='background-color:#ffcc33;text-align:left;font-weight:bold;color:#ff3333;' width='80%'>
  </td>
 <td width='20%' bgcolor=\"#ffffff\" align=\"right\" valign=\"top\" style=\"background-color:#ffffff;text-align:left;font-weight:bold;color:#ff3333;padding:10px 25px 20px 0px\">
	<a href=\"http://bookingparcel.com/\" target=\"_blank\" rel=\"noreferrer\"><img src=\"http://bookingparcel.com/europost_logo.gif\" alt=\"EuropostExpress\" width=\"237\" height=\"56\" border=\"0\" style=\"display:block\"></a>
</td>
 </tr>
<tr>
	<td colspan='2' style='background-color:#3a3a3a;text-align:center;font-weight:bold;color:#E0E0E0;'>The Order Details</td>
</tr>
 <tr>
	<td colspan='2' style='background-color:#f5f5f5;padding:25px;'>
		<table border='1' bordercolor='#777' style='margin-left:auto;margin-right:auto;width:90%;border-collapse:collapse;border-color:#777;font-size:12px;'>
			<tbody>
				<tr style='background-color:#ccc;text-align:center;font-weight:bold;color:#3a3a3a;'>
					<td colspan='2' style='padding:5px;'>Order Information</td>
				</tr>
				<tr style='background-color:#ccc;text-align:center;color:#3a3a3a;'>
					<td colspan='1' width='50%' style='padding:5px;'>Order ID</td>
					<td colspan='1' width='50%' style='padding:5px;'>Tracking ID</td>
				</tr>
				<tr style='background-color:#fff;text-align:center;font-weight:bold;'>
					<td colspan='1' style='padding:15px 0;'>". $_GET['id'] ."</td>
					<td colspan='1' style='padding:15px 0;'>". $row['tid'] ."</td>
				</tr>
				<tr style='background-color:#ccc;text-align:center;font-weight:bold;color:#3a3a3a;'>
					<td colspan='2' style='padding:5px;'>Message Information</td>
				</tr>
				<tr style='background-color:#fff;text-align:ltr;font-weight:bold;'>
					<td colspan='2' style='padding:15px 0;'>Dear colleague,<br><br>
There has been an update regarding order ". $row['tid'] .". <br>
Update:<br>
". ($_POST['message']) ."<br><br>

To view all previous updates, please visit www.bookingparcel.com and click on \"I have a tracking ID\". Then proceed to enter your tracking ID (found above) and e-mail address. <br><br>

Kind regards,<br>
Europost Express team</td>
				</tr>
				<tr style='background-color:#ccc;text-align:center;font-weight:bold;color:#3a3a3a;'>
					<td colspan='2' style='padding:5px;'>Note : this mail may have an attachment, please check it if there is any.</td>
				</tr>
			</tbody>
		</table>
		<div style='font-family:tahoma;font-size:12px;direction:ltr;margin:20px;'>
Europost Express (UK) Ltd.<br>
4 Corringham Road,<br>
Wembley - Middlesex<br>
HA9 9QA- London , UK<br>
Tel : +44(0) 7886105417<br>
www.europostexpress.co.uk<br>
aircargo@europostexpress.co.uk<br>

		</div>
		</td>
	</tr>
</tbody></table>";

	if (!$mail->send()) {
		$error_m .= "". $row['fname'] ." ". $row['lname'] ." : ".$_POST['email']." Sending was not successful.<br>";
		$error_m .= "Mailer Error: " . $mail->ErrorInfo ."<br>";
	} else {
		$error_m .= "". $row['fname'] ." ". $row['lname'] ." : ".$_POST['email']." Sent Successfully<br>";
	}
			$error = false;
			}
		}
	}
	elseif(isset($_POST['t']) AND $_POST['t']=='2'){
		if(isset($_POST['name']) AND trim($_POST['name'])!='' AND $_POST['name']!=null){
			if(isset($_POST['email']) AND trim($_POST['email'])!='' AND $_POST['email']!=null AND filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
				if(isset($_POST['message_mail']) AND trim($_POST['message_mail'])!='' AND $_POST['message_mail']!=null){

			$Attachments = array();


			if(isset($_FILES['uploaded_file']['name']) AND is_array($_FILES['uploaded_file']['name']) AND count($_FILES['uploaded_file']['name'])>0){

				$target_dir = __DIR__ . DIRECTORY_SEPARATOR  ."attachments" . DIRECTORY_SEPARATOR;

				foreach($_FILES['uploaded_file']['name'] as $k => $upload){
					if(isset($_FILES['uploaded_file']['name'][$k]) AND $_FILES['uploaded_file']['name'][$k] !="" AND $_FILES['uploaded_file']['name'][$k]!=null){
						$has_attach = true;
						$target_file = $target_dir .$itemid ."_". basename($_FILES['uploaded_file']['name'][$k]);
						$uploadOk = 1;
						$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
						$format = explode(".",basename($_FILES['uploaded_file']['name'][$k]));
						$format = $format[(count($format)-1)];
						$filename = basename($_FILES['uploaded_file']['name'][$k]);
						$target_file = $target_dir . basename($_FILES['uploaded_file']['name'][$k]);
						if($_FILES["uploaded_file"]["size"][$k] > 52428801) {
							$error_m .= basename( $_FILES['uploaded_file']['name'][$k])."Invalid file size<br>";
							$uploadOk = 0;
						} elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "rtf" && $imageFileType != "zip" && $imageFileType != "pdf" && $imageFileType != "doc" && $imageFileType != "docx" && $imageFileType != "xls" && $imageFileType != "xlsx") {
							$error_m .= basename( $_FILES['uploaded_file']['name'][$k])."Invalid file format<br>";
							$uploadOk = 0;
						}
						if ($uploadOk == 0) {
							$error_m .= basename( $_FILES['uploaded_file']['name'][$k])." Sorry, your file was not uploaded.<br>";
						} else {
							if (move_uploaded_file($_FILES['uploaded_file']['tmp_name'][$k], $target_file)) {
								$error_m .= "The file ". basename( $_FILES['uploaded_file']['name'][$k]). " has been uploaded.<br>";

								$Attachments[] = $target_file;
							}
						}
					}
				}
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
	//$mail->SMTPDebug = 2;
	$mail->SMTPAuth = true;
	$mail->Username = "quote1@bookingparcel.com";
	$mail->Password = "02May1964@5017@anitapouya";
	$mail->setFrom('quote1@bookingparcel.com', 'Booking Parcel');
	$mail->addReplyTo('quote1@bookingparcel.com', 'Booking Parcel');
	$mail->addAddress($_POST['email'], $_POST['name']);
	if($row['cc1']!='' AND isset($_POST['cc1']) AND $_POST['cc1']==$row['cc1']) $mail->AddCC($row['cc1'], $_POST['name']);
	if($row['cc2']!='' AND isset($_POST['cc2']) AND $_POST['cc2']==$row['cc2']) $mail->AddCC($row['cc2'], $_POST['name']);
	if($row['cc3']!='' AND isset($_POST['cc3']) AND $_POST['cc3']==$row['cc3']) $mail->AddCC($row['cc3'], $_POST['name']);
	if($row['cc4']!='' AND isset($_POST['cc4']) AND $_POST['cc4']==$row['cc4']) $mail->AddCC($row['cc4'], $_POST['name']);
	//$mail->AddCC('cargo@epxcargo.co.uk', "BookingParcel(item)");
	$mail->AddCC('backup1@bookingparcel.com', "BookingParcel(presend)");

	$mail->CharSet ="utf-8";
	$mail->isHTML(true);
	$mail->Subject = 'Quote( '.$row['tid'].' )';

	$q_att = '';
	if(!empty($Attachments))
	{
		foreach($Attachments as $target_file)
			if($target_file!=""){
				$mail->addAttachment($target_file);
				$q_att .= $target_file ." , ";
			}
	}

$mail->Body = "<table cellpadding='5' cellspacing='1' style='margin-left:auto;margin-right:auto;width:100%;border:0px;font-family:tahoma;font-size:12px;direction:ltr;border:thin solid #777;'>
 <tr>
  <td style='background-color:#ffcc33;text-align:left;font-weight:bold;color:#ff3333;' width='80%'>
  </td>
 <td width='20%' bgcolor=\"#ffffff\" align=\"right\" valign=\"top\" style=\"background-color:#ffffff;text-align:left;font-weight:bold;color:#ff3333;padding:10px 25px 20px 0px\">
	<a href=\"http://bookingparcel.com/\" target=\"_blank\" rel=\"noreferrer\"><img src=\"http://bookingparcel.com/europost_logo.gif\" alt=\"EuropostExpress\" width=\"237\" height=\"56\" border=\"0\" style=\"display:block\"></a>
</td>
 </tr>
<tr>
	<td colspan='2' style='background-color:#3a3a3a;text-align:center;font-weight:bold;color:#E0E0E0;'>The Order Details</td>
</tr>
 <tr>
	<td colspan='2' style='background-color:#f5f5f5;padding:25px;'>
		<table border='1' bordercolor='#777' style='margin-left:auto;margin-right:auto;width:90%;border-collapse:collapse;border-color:#777;font-size:12px;'>
			<tbody>
				<tr style='background-color:#ccc;text-align:center;font-weight:bold;color:#3a3a3a;'>
					<td colspan='2' style='padding:5px;'>Order Information</td>
				</tr>
				<tr style='background-color:#ccc;text-align:center;color:#3a3a3a;'>
					<td colspan='1' width='50%' style='padding:5px;'>Order ID</td>
					<td colspan='1' width='50%' style='padding:5px;'>Tracking ID</td>
				</tr>
				<tr style='background-color:#fff;text-align:center;font-weight:bold;'>
					<td colspan='1' style='padding:15px 0;'>". $id ."</td>
					<td colspan='1' style='padding:15px 0;'>". $row['tid'] ."</td>
				</tr>
				<tr style='background-color:#ccc;text-align:center;font-weight:bold;color:#3a3a3a;'>
					<td colspan='2' style='padding:5px;'>Message Information</td>
				</tr>
				<tr style='background-color:#fff;text-align:ltr;font-weight:bold;'>
					<td colspan='2' style='padding:15px 0;'>". ($_POST['message_mail']) ."</td>
				</tr>
				<tr style='background-color:#ccc;text-align:center;font-weight:bold;color:#3a3a3a;'>
					<td colspan='2' style='padding:5px;'>Note : this mail may have an attachment, please check it if there is any.</td>
				</tr>
			</tbody>
		</table>
		<div style='font-family:tahoma;font-size:12px;direction:ltr;margin:20px;'>
Europost Express (UK) Ltd.<br>
4 Corringham Road,<br>
Wembley - Middlesex<br>
HA9 9QA- London , UK<br>
Tel : +44(0) 7886105417<br>
www.europostexpress.co.uk<br>
aircargo@europostexpress.co.uk<br>

		</div>
		</td>
	</tr>
</tbody></table>";

	if (!$mail->send()) {
		$mails_er[$email] = $info;
		$error_m .= $_POST['name']. " : ".$_POST['email']." Sending was not successful.<br>";
		$error_m .= "Mailer Error: " . $mail->ErrorInfo ."<br>";
	} else {
		mysql_query("INSERT INTO `sent_mails` (`ref`, `body`, `attachment`, `timestamp`) VALUES (". $id .", '".addslashes($mail->Body)."', '".$q_att."', ".time().");") or die(mysql_error());
		$error_m .= $_POST['name']. " : ".$_POST['email']." Sent Successfully<br>";
	}
				}
			}
		}
	}
}
?>

<table border="1" style="margin-left:auto;margin-right:auto;width:90%;border-collapse:collapse;border-color:#777;font-size:12px">
	<tbody>
		<tr style="background-color:#ccc;text-align:center;color:#3a3a3a">
			<td style="padding:5px">From</td>
			<td >From State</td>
			<td >From Location</td>
			<td >To</td>
			<td >To State</td>
			<td >To Location</td>
			<td >Shipping Type</td>
			<td >Shipping Sub-Type</td>
			<td >Shipping Container</td>
			<td >Insurance</td>
			<td >Package Type</td>
			<td >Item Count</td>
			<td >Dimension(LxWxH)(cm)</td>
			<td >Total Weight</td>
			<td >Item Description</td>
		</tr>
		<tr style="background-color:#fff;text-align:center;font-weight:bold">
			<?php echo $output; ?>
		</tr>

	</tbody>
</table>
                </div>
            </div>
        </div>
        <div class="grid_5">
            <div class="box round">
                <h2>Leave a message for tracking</h2>
                <div class="block">
                    <p class="start">
                        You can leave a message for the customer here and (s)he will see the message in tracking the order.</p>
                    <p>
                    <form method="post" >
						<input type="hidden" name="t" value="1">
						<label for="message">Message</label><br>
						<textarea name="message" id="message" class="ckeditor" style="margin: 0px; height: 187px; width: 80%;"></textarea><br>
						<br>
						<label for='email'>Email: </label><br>
						<label for='email'>Primary Email: </label><input type="radio" name="email" id="email" value="<?php echo $row['email'];?>">&nbsp;<?php echo $row['email'];?><br>
						<label for='email'>Pre-Alert Email: </label><input type="radio" name="email" id="email" value="<?php echo $row['palrtemail'];?>" <?php echo ($row['palrtemail']=='' ? "disabled" : "");?>>&nbsp;<?php echo $row['palrtemail'];?>
						<br>
						CC :<br>
						<?php if($row['cc1']!=''){ ?><label for='cc1'><input type="checkbox" name="cc1" id="cc1" value="<?php echo $row['cc1'];?>"><?php echo $row['cc1'];?></label><br><?php } ?>
						<?php if($row['cc2']!=''){ ?><label for='cc2'><input type="checkbox" name="cc2" id="cc2" value="<?php echo $row['cc2'];?>"><?php echo $row['cc2'];?></label><br><?php } ?>
						<?php if($row['cc3']!=''){ ?><label for='cc3'><input type="checkbox" name="cc3" id="cc3" value="<?php echo $row['cc3'];?>"><?php echo $row['cc3'];?></label><br><?php } ?>
						<?php if($row['cc4']!=''){ ?><label for='cc4'><input type="checkbox" name="cc4" id="cc4" value="<?php echo $row['cc4'];?>"><?php echo $row['cc4'];?></label><br><?php } ?>
						<br>
						<button type="submit" name="submit" class="btn btn-blue">Confirm</button>
					</form>
					</p>
					<p>
					Or use pre-defined messages:<br>
					<select name="choosemsg" id="choosemsg"  onchange="choosemsg();">
						<option value="-">Choose a message</option>
						<?php
						$q = "SELECT `id`,`title` FROM `prenotes` WHERE `type`=2 ORDER BY `id` ASC";
						$r = mysql_query($q);
						if(mysql_num_rows($r)>0){
							while($rowww = mysql_fetch_array($r)){
								echo "<option value=\"".$rowww['id']."\">".$rowww['title']."</option>";
							}
						}
						?>
					</select>
					</p>
					<?php
					if(isset($error)){
						if($error){
							echo "<p>An error occurred.</p>";
						}
						else{
							echo "<p>Message sent successfully.</p>";
						}
					}
					?>
					<p>
					Your previous messages:<br>
					<?php
					if(isset($_GET['del_tm']) AND is_numeric($_GET['del_tm']) AND $_GET['del_tm']>0)
					{
						mysql_query("DELETE FROM `qstatus` WHERE `id`=".intval($_GET['del_tm'])."");
					}
					$q = "SELECT * FROM `qstatus` WHERE `rid`=".$id."";
					$r = mysql_query($q);
					if(mysql_num_rows($r)>0){
						while($row1 = mysql_fetch_array($r)){
							echo "<pre>Date : ".date("Y/m/d H:i:s",$row1['timestamp'])."<br><button type=\"button\" class=\"btn btn-red\" onclick=\"window.location.href='item.php?id=".$id."&del_tm=".$row1['id']."';\">Delete</button><br>Message:<br>".$row1['message']."<hr></pre>";
						}
					}
					else{
						echo "<pre>No message found.</pre>";
					}
					?>
					</p>
                </div>
            </div>
        </div>
        <div class="grid_5">
            <div class="box round">
                <h2>Send E-mail</h2>
                <div class="block">
				<?php if($error_m != ""){
					?>
						<div class="message info">
							<h5>Result</h5>
							<p>
								<?php
					echo "<p>".$error_m ."</p>";
					?>
							</p>
						</div>
					<?php

				}
				?>
                    <p class="start">You can send your message with an attachment here. <br>Note: supported attachment files (png,gif,jpg,pdf,zip).</p>
                    <p>
						<form method="POST" name="email_form_with_php" action="" enctype="multipart/form-data" class="form">

							<input type="hidden" name="t" value="2">
							<label for='name'>Name: </label>
							<input type="text" name="name" value="<?php echo $row['fname'] . " " . $row['lname'];?>">
							<br>
							<label for='email'>Email: </label><br>
							<label for='email'>Primary Email: </label><input type="radio" name="email" id="email" value="<?php echo $row['email'];?>">&nbsp;<?php echo $row['email'];?><br>
							<label for='email'>Pre-Alert Email: </label><input type="radio" name="email" id="email" value="<?php echo $row['palrtemail'];?>" <?php echo ($row['palrtemail']=='' ? "disabled" : "");?>>&nbsp;<?php echo $row['palrtemail'];?>
							<br>
							CC :<br>
							<?php if($row['cc1']!=''){ ?><label for='cc1'><input type="checkbox" name="cc1" id="cc1" value="<?php echo $row['cc1'];?>"><?php echo $row['cc1'];?></label><br><?php } ?>
							<?php if($row['cc2']!=''){ ?><label for='cc2'><input type="checkbox" name="cc2" id="cc2" value="<?php echo $row['cc2'];?>"><?php echo $row['cc2'];?></label><br><?php } ?>
							<?php if($row['cc3']!=''){ ?><label for='cc3'><input type="checkbox" name="cc3" id="cc3" value="<?php echo $row['cc3'];?>"><?php echo $row['cc3'];?></label><br><?php } ?>
							<?php if($row['cc4']!=''){ ?><label for='cc4'><input type="checkbox" name="cc4" id="cc4" value="<?php echo $row['cc4'];?>"><?php echo $row['cc4'];?></label><br><?php } ?>
							<br>
							<label for='message_mail'>Message:</label><br>
							<textarea name="message_mail" id="message_mail" class="ckeditor" style="margin: 0px; height: 187px; width: 80%;"></textarea>
							<br>

							<div id="attach_d">
								<p>
									<label for="attachment">
										<input type="file" id="attachment" name="uploaded_file[]"  accept=".gif,.jpg,.jpeg,.png,.pdf,.zip,.rtf,.doc,.docx,.xls,.xlsx">
									</label>&nbsp;&nbsp;
									<a href="#" id="addScnt"><img src="../post_forms/images/icons/fam/add.png"></a>&nbsp;
									<a href="#" id="remScnt"><img src="../post_forms/images/icons/fam/delete.png"></a>&nbsp;&nbsp;&nbsp;
									please note that supported extentions are (.gif,.jpg,.jpeg,.png,.pdf,.zip,.rtf,.doc,.docx,.xls,.xlsx) And maximum size is 2MB.
								</p>
							</div>
							<br>
							<button type="submit" name="submit" class="btn btn-blue">Send</button>
						</form>
					</p>
					<p>
					Or use pre-defined Emails:<br>
					<select name="choosemsgemail" id="choosemsgemail"  onchange="choosemsgemail();">
						<option value="-">Choose a email</option>
						<?php
						$q = "SELECT `id`,`title` FROM `prenotes` WHERE `type`=1 ORDER BY `id` ASC";
						$r = mysql_query($q);
						if(mysql_num_rows($r)>0){
							while($rowww = mysql_fetch_array($r)){
								echo "<option value=\"".$rowww['id']."\">".$rowww['title']."</option>";
							}
						}
						?>
					</select>
					</p>
					<p>
					Your previous Emails:<br>
					<?php
					$q = "SELECT * FROM `sent_mails` WHERE `ref`=".$id." ORDER BY `timestamp` DESC";
					$rr = mysql_query($q);
					if(mysql_num_rows($rr)>0){
						$_c = 0;
						while($row3 = mysql_fetch_array($rr)){
							/*echo "<pre>
							<button type=\"button\" name=\"print\" class=\"btn btn-green\" onclick=\"printContent('printID".$_c."')\">Print the bellow E-mail Content</button>
							<div id='printID".$_c."'>Date : ".date("Y/m/d H:i:s",$row3['timestamp'])."<br>Message:<br>".$row3['body']."<br>Attachment : ".$row3['attachment']."</div><hr></pre>";*/
							echo '<pre>';
							echo '<a href="sent_mails.php?id='.$row3['id'].'">Mail ID : '.$row3['id'].' Sent On '.date("Y/m/d H:i:s",$row3['timestamp']).'</a>';
							echo '</pre>';
							$_c++;
						}
					}
					else{
						echo "<pre>No message found.</pre>";
					}
					?>
					</p>
                </div>
            </div>
        </div>
        <div class="grid_10">
            <div class="box round">

                <h2>Recommended Agents</h2>
                <div class="block">
                    <p class="start">Here are a list of the companies in the destination country, if you don't see any, so it means you did not add agents for this country!</p>
                    <p>Note :
					<br>1) the in-active agents not sorted below.
					<br>2) the special agents has star after their company name.
					<br>3) the agents that cover the destination city are marked by blue color.
                    </p>
                    <p>
<?php
mysql_close();
$con = mysql_connect(DB_HOST,DB_USER,DB_PASS) or die(mysql_error());
mysql_select_db(DB_NAME, $con) or die(mysql_error());
	$flag = false;
	if($row['shipping_type'] == 'Charter'){
		$q = "SELECT count(*) as ca FROM `agents` WHERE `country`='".$row['from']."' AND `active`=1 AND `ship_charter`=1 ORDER BY `id` ASC";
		$r = mysql_query($q);
		$row2 = mysql_fetch_array($r);
		if($row2['ca']==0){
			$q = "SELECT count(*) as ca FROM `agents` WHERE `active`=1 AND `ship_charter`=1 ORDER BY `id` ASC";
			$r = mysql_query($q);
			$row2 = mysql_fetch_array($r);
			$flag = true;
		}
	}
	else{
		$q = "SELECT count(*) as ca FROM `agents` WHERE `country`='".$row['from']."' AND `active`=1 ORDER BY `id` ASC";
		$r = mysql_query($q);
		$row2 = mysql_fetch_array($r);
	}
		//echo $q."<br>";
	if($row2['ca']>0){
		echo "<pre>";
		echo $row['from'] . " (Active Agents Count : ".$row2['ca'].")<br>";
		if($row['shipping_type'] == 'Charter'){
			$q = "SELECT * FROM `agents` WHERE `country`='".$row['from']."' AND `active`=1 AND `ship_charter`=1 ORDER BY `id` ASC";
			$r = mysql_query($q);
			if($flag){
				$q = "SELECT * FROM `agents` WHERE `active`=1 AND `ship_charter`=1 ORDER BY `id` ASC";
				$r = mysql_query($q);
			}
		}
		else{
			$q = "SELECT * FROM `agents` WHERE `country`='".$row['from']."' AND `active`=1  ORDER BY `id` ASC";
			$r = mysql_query($q);
		}
		//echo $q."<br>";
		$output = "";
		while($row3 = mysql_fetch_array($r)){
			$cities = explode(" | ",$row3['cover_city']);
			$cities[] = $row3['city'];
			$output .= "<tr ".(in_array($row['from_st'],$cities) ? "style=\"background-color:#99ccff;text-align:ltr;color:#3a3a3a\"" : "").">";
			$output .= "<td class=\"agents_td\"><input type='checkbox' name='agents[]' value='".$row3['id']."'></td>";
			$output .= "<td class=\"agents_td\">".implode("<br>",$cities)."</td>";
			$output .= "<td class=\"agents_td\">".$row3['cname']."".($row3['special']==1 ? "<img src=\"img/star_list.png\" title='This agent is special.' alt='Special'>" : "")."</td>";
			$output .= "<td class=\"agents_td\">".$row3['fname']."</td>";
			$output .= "<td class=\"agents_td\">".nl2br($row3['phones'])."</td>";
			$output .= "<td class=\"agents_td\">".nl2br($row3['emails'])."</td>";
			$output .= "<td class=\"agents_td\">".nl2br($row3['address'])."</td>";
			$output .= "<td class=\"agents_td\">".nl2br($row3['desc'])."</td>";
			$output .= "</tr>";
		}
		?>
<form method="post" action="sendtoagent.php">
<input type="hidden" name="itemid" value="<?php echo $row['id'];?>">
<table border="1" class="agents_table">
	<tbody>
		<tr style="background-color:#ccc;text-align:center;color:#3a3a3a">
			<td class="agents_td" style="padding:5px;width:2%;"><input type="checkbox" id="checkall" ></td>
			<td class="agents_td" style="padding:5px;width:9%;">Cover City</td>
			<td class="agents_td" style="width:25%;">Company</td>
			<td class="agents_td" style="width:9%;">First Name</td>
			<td class="agents_td" style="width:18%;">Phone(s)</td>
			<td class="agents_td" style="width:17%;">E-mail(s)</td>
			<td class="agents_td" style="width:10%;">Address</td>
			<td class="agents_td" style="width:10%;">Desciption</td>
		</tr>
		<?php echo $output; ?>
	</tbody>
</table>
<?php

	if($row['shipping_type'] == 'Charter' AND $flag==false){
		$q = "SELECT * FROM `agents` WHERE `country`!='".$row['from']."' AND `active`=1 AND `ship_charter`=1 ORDER BY `id` ASC";
		$r = mysql_query($q);

		echo "<pre><br>Other Contries<br>";
		echo $row['from'] . " (Active Agents Count : ".mysql_num_rows($r).")<br>";

		$output = "";
		while($row3 = mysql_fetch_array($r)){
			$cities = explode(" | ",$row3['cover_city']);
			$cities[] = $row3['city'];
			$output .= "<tr ".(in_array($row['from_st'],$cities) ? "style=\"background-color:#99ccff;text-align:ltr;color:#3a3a3a\"" : "").">";
			$output .= "<td class=\"agents_td\"><input type='checkbox' name='agents[]' value='".$row3['id']."'></td>";
			$output .= "<td class=\"agents_td\">".implode("<br>",$cities)."</td>";
			$output .= "<td class=\"agents_td\">".$row3['cname']."".($row3['special']==1 ? "<img src=\"img/star_list.png\" title='This agent is special.' alt='Special'>" : "")."</td>";
			$output .= "<td class=\"agents_td\">".$row3['fname']."</td>";
			$output .= "<td class=\"agents_td\">".nl2br($row3['phones'])."</td>";
			$output .= "<td class=\"agents_td\">".nl2br($row3['emails'])."</td>";
			$output .= "<td class=\"agents_td\">".nl2br($row3['address'])."</td>";
			$output .= "<td class=\"agents_td\">".nl2br($row3['desc'])."</td>";
			$output .= "</tr>";
		}
?>

<table border="1" style="margin-left:auto;margin-right:auto;width:98%;border-collapse:collapse;border-color:#777;font-size:12px">
	<tbody>
		<tr style="background-color:#ccc;text-align:center;color:#3a3a3a">
			<td class="agents_td" style="padding:5px;width:2%;"><input type="checkbox" id="checkall" ></td>
			<td class="agents_td" style="padding:5px;width:9%;">Cover City</td>
			<td class="agents_td" style="width:25%;">Company</td>
			<td class="agents_td" style="width:9%;">First Name</td>
			<td class="agents_td" style="width:18%;">Phone(s)</td>
			<td class="agents_td" style="width:17%;">E-mail(s)</td>
			<td class="agents_td" style="width:10%;">Address</td>
			<td class="agents_td" style="width:10%;">Desciption</td>
		</tr>
		<?php echo $output; ?>
	</tbody>
</table>
	<?php } ?>
<center>
	<button type="submit" name="submit" class="btn btn-blue">apply</button>
</center>
</form>
		<?php
		echo "</pre>";
	}
	else{
		echo "<pre><font color='red'>No company detected for this</font></pre>";
	}
mysql_close();
?>

					</p>
                </div>
            </div>
        </div>
        <div class="clear"></div>
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
