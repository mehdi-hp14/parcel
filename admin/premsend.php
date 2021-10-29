<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php 

include("../post_forms/cnf.php");
include("conf.php");
require 'mailer/PHPMailerAutoload.php';
$_c = 0;
if(!(isset($_SESSION['loged_in']) AND isset($_SESSION['loged_in_t']) AND $_SESSION['loged_in']==true AND $_SESSION['loged_in_t']>=time())){

	header("Location: index.php");
	exit("You are not logged in....<br><a href='index.php'>Dashboard</a>");
}

if(isset($_SESSION['loged_in']) AND isset($_SESSION['loged_in_t']) AND $_SESSION['loged_in']==true AND $_SESSION['loged_in_t']>=time()){
	$_SESSION['loged_in_t'] = time()+time_out;
}
//mid=1&id=32&type=2
if(!(isset($_GET['mid']) AND is_numeric($_GET['mid']) AND $_GET['mid']>0 AND $_GET['mid']!='') OR !(isset($_GET['id']) AND is_numeric($_GET['id']) AND $_GET['id']>0 AND $_GET['id']!='') OR !(isset($_GET['type']) AND is_numeric($_GET['type']) AND $_GET['type']>0 AND $_GET['type']!='' AND $_GET['type']<4)){

	header("Location: dashboard.php");
	exit("You are logged in....<br><a href='dashboard.php'>Dashboard</a>");
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Pre-Defined Messages | Booking Parcel Admin</title>
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
            //setupTinyMCE();
            //setupDashboardChart('chart1');
            setupLeftMenu();
			setSidebarHeight();


        });
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
<?php

$con = mysql_connect(DB_HOST,DB_USER,DB_PASS) or die(mysql_error());
mysql_select_db(DB_NAME, $con) or die(mysql_error());

if(isset($_GET['id']) AND $_GET['id']!='' AND is_numeric($_GET['id']) AND $_GET['id']>0){
	$q = "SELECT *, count(*) as cq FROM `quote` WHERE `id` = ".$_GET['id']."";
	$row2 = mysql_fetch_array(mysql_query($q));
	if($row2['cq']!=1){
		header("Location: dashboard.php");
		exit;
	}
}else{
	header("Location: dashboard.php");
	exit;
}
if(isset($_GET['mid']) AND $_GET['mid']!='' AND is_numeric($_GET['mid']) AND $_GET['mid']>0){
	$q = "SELECT *, count(*) as cq FROM `prenotes` WHERE `id` = ".$_GET['mid']."";
	$row = mysql_fetch_array(mysql_query($q));
	if($row['cq']!=1){
		header("Location: dashboard.php");
		exit;
	}
}else{
	header("Location: dashboard.php");
	exit;
}


$error_m = "";
if(isset($_POST['t']) AND $_POST['t']!='' AND is_numeric($_POST['t']) AND $_POST['t']>0){
	$error = true;
	switch($_POST['t']){
		case 1:
		if(isset($_POST['title']) AND trim($_POST['title'])!='' AND $_POST['title']!=null){
			if(isset($_POST['email']) AND trim($_POST['email'])!='' AND $_POST['email']!=null AND filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
				if(isset($_POST['message']) AND trim($_POST['message'])!='' AND $_POST['message']!=null){
					/*
					if(isset($_FILES['uploaded_file']) AND $_FILES['uploaded_file']['name'] !="" AND $_FILES['uploaded_file']['name']!=null){
						$target_dir = "attachments/";
						$target_file = $target_dir .$id ."_". basename($_FILES["uploaded_file"]["name"]);
						$uploadOk = 1;
						$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
						$format = explode(".",basename($_FILES["uploaded_file"]["name"]));
						$format = $format[(count($format)-1)];
						$filename = $id ."_". basename($_FILES["uploaded_file"]["name"]);
						$target_file = $target_dir .$id ."_". basename($_FILES["uploaded_file"]["name"]);
						
						if($_FILES["uploaded_file"]["size"] > 52428801) {
							$error_m .= "Invalid file size<br>";
							$uploadOk = 0;
						} elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "zip" && $imageFileType != "pdf" && $imageFileType != "doc" && $imageFileType != "docx" && $imageFileType != "xls" && $imageFileType != "xlsx") {
							$error_m .= "Invalid file format<br>";
							$uploadOk = 0;
						} 
						if ($uploadOk == 0) {
							$error_m .= "Sorry, your file was not uploaded.<br>";
						} else {
							if (move_uploaded_file($_FILES["uploaded_file"]["tmp_name"], $target_file)) {
								$error_m .= "The file ". basename( $_FILES["uploaded_file"]["name"]). " has been uploaded.<br>";
							} else {
								$error_m .= "Sorry, there was an error uploading your file.<br>";
							}
						}
					}
					else{
						$target_file="";
					}
					*/
			
			$Attachments = array();
			
			
			if(isset($_FILES['uploaded_file']['name']) AND is_array($_FILES['uploaded_file']['name']) AND count($_FILES['uploaded_file']['name'])>0){
				
				$target_dir = __DIR__ . DIRECTORY_SEPARATOR  ."attachments" . DIRECTORY_SEPARATOR;
				
				foreach($_FILES['uploaded_file']['name'] as $k => $upload){
					if(isset($_FILES['uploaded_file']['name'][$k]) AND $_FILES['uploaded_file']['name'][$k] !="" AND $_FILES['uploaded_file']['name'][$k]!=null){
						$has_attach = true;
						$target_file = $target_dir ."_". basename($_FILES['uploaded_file']['name'][$k]);
						$uploadOk = 1;
						$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
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
	$mail->addAddress($_POST['email'], "". $row2['fname'] ." ". $row2['lname'] ."");
	if($row2['cc1']!='' AND isset($_POST['cc1']) AND $_POST['cc1']==$row2['cc1']) $mail->AddCC($row2['cc1'], "". $row2['fname'] ." ". $row2['lname'] ."");
	if($row2['cc2']!='' AND isset($_POST['cc2']) AND $_POST['cc2']==$row2['cc2']) $mail->AddCC($row2['cc2'], "". $row2['fname'] ." ". $row2['lname'] ."");
	if($row2['cc3']!='' AND isset($_POST['cc3']) AND $_POST['cc3']==$row2['cc3']) $mail->AddCC($row2['cc3'], "". $row2['fname'] ." ". $row2['lname'] ."");
	if($row2['cc4']!='' AND isset($_POST['cc4']) AND $_POST['cc4']==$row2['cc4']) $mail->AddCC($row2['cc4'], "". $row2['fname'] ." ". $row2['lname'] ."");
	//$mail->AddCC('cargo@epxcargo.co.uk', "BookingParcel(presend)");
	$mail->AddCC('backup1@bookingparcel.com', "BookingParcel(presend)");
	
	$mail->CharSet ="utf-8";
	$mail->isHTML(true);
	$mail->Subject = $_POST['title'] . " (". $row2['tid'] .")";
	
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
					<td colspan='1' style='padding:15px 0;'>". $_GET['id'] ."</td>
					<td colspan='1' style='padding:15px 0;'>". $row2['tid'] ."</td>
				</tr>
				<tr style='background-color:#ccc;text-align:center;font-weight:bold;color:#3a3a3a;'>
					<td colspan='2' style='padding:5px;'>Message Information</td>
				</tr>
				<tr style='background-color:#fff;text-align:ltr;font-weight:bold;'>
					<td colspan='2' style='padding:15px 0;'>". ($_POST['message']) ."</td>
				</tr>
				<tr style='background-color:#ccc;text-align:center;font-weight:bold;color:#3a3a3a;'>
					<td colspan='2' style='padding:5px;'>Note : This mail may have an attachment, please check it if there is any.</td>
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
		$error_m .= "". $row2['fname'] ." ". $row2['lname'] ." : ".$_POST['email']." Sending was not successful.<br>";
		$error_m .= "Mailer Error: " . $mail->ErrorInfo ."<br>";
	} else {
		mysql_query("INSERT INTO `sent_mails` (`ref`, `body`, `attachment`, `timestamp`) VALUES (". $_GET['id'] .", '".addslashes($mail->Body)."', '".$q_att."', ".time().");") or die(mysql_error());
		$error_m .= "". $row2['fname'] ." ". $row2['lname'] ." : ".$_POST['email']." Sent Successfully<br>";
								$error = false;
	}
				}
			}
		}
		/*
			if(isset($_POST['title']) AND trim($_POST['title'])!='' AND $_POST['title']!=null){
				if(isset($_POST['email']) AND trim($_POST['email'])!='' AND $_POST['email']!=null AND filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
					if(isset($_POST['message']) AND trim($_POST['message'])!='' AND $_POST['message']!=null){

									$body = "<table cellpadding='5' cellspacing='1' style='margin-left:auto;margin-right:auto;width:100%;border:0px;font-family:tahoma;font-size:12px;direction:ltr;border:thin solid #777;'>
	 <tr>
	  <td style='background-color:#ffcc33;text-align:left;font-weight:bold;color:#ff3333;' width='80%'>
	   Dear Customer <b>". $row['fname'] ." ". $row['lname'] ."</b>,<br>One of our agents answered you, Here is his/her message:
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
						<td colspan='2' style='padding:15px 0;'>". $_POST['message'] ."</td>
					</tr>
					<tr style='background-color:#ccc;text-align:center;font-weight:bold;color:#3a3a3a;'>
						<td colspan='2' style='padding:5px;'>Note : this mail may have an attachment, please check it if there is any.</td>
					</tr>
				</tbody>
			</table>
			<div style='font-family:tahoma;font-size:12px;direction:ltr;margin:20px;'>
	Europost Express (UK) Ltd.<br>
	Unit W13, Research House Business Centre, <br>
	Fraser Road , Perivale, Middlesex<br>
	UB6 7AQ- London , UK<br>
	www.europostexpress.co.uk<br>
	aircargo@europostexpress.co.uk<br>
	Tel: +44(0) 208 5373286 - +44(0) 7886105417  <br>

			</div>
			</td>
		</tr>
	</tbody></table>";
						if(isset($_FILES['uploaded_file']) AND $_FILES['uploaded_file']['name'] !="" AND $_FILES['uploaded_file']['name']!=null){
							$target_dir = "attachments/";
							$target_file = $target_dir .$id ."_". basename($_FILES["uploaded_file"]["name"]);
							$uploadOk = 1;
							$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
							$format = explode(".",basename($_FILES["uploaded_file"]["name"]));
							$format = $format[(count($format)-1)];
							$filename = $id ."_". substr(md5(basename($_FILES["uploaded_file"]["name"])),1,6).".".$format;
							$target_file = $target_dir .$id ."_". substr(md5(basename($_FILES["uploaded_file"]["name"])),1,6).".".$format;
							
							if(strlen($_FILES["uploaded_file"]["name"])>20) {
								$error_m = "Invalid file name";
								$uploadOk = 0;
							} elseif($_FILES["uploaded_file"]["size"] > 204800) {
								$error_m = "Invalid file size";
								$uploadOk = 0;
							} elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "zip" && $imageFileType != "pdf") {
								$error_m = "Invalid file format";
								$uploadOk = 0;
							} 
							if ($uploadOk == 0) {
								$error_m = "Sorry, your file was not uploaded.";
							} else {
								if (move_uploaded_file($_FILES["uploaded_file"]["tmp_name"], $target_file)) {
									$error_m = "The file ". basename( $_FILES["uploaded_file"]["name"]). " has been uploaded.";
									//cy_3+(P6gJI$
									//
									
									
									$file = $target_file;
									$file_size = filesize($file);
									$handle = fopen($file, "r");
									$content = fread($handle, $file_size);
									fclose($handle);

									$content = chunk_split(base64_encode($content));
									$uid = md5(uniqid(time()));
									$name = basename($file);

									$eol = PHP_EOL;

									$header = "From: Quote Booking Parcel <quote1@bookingparcel.com>".$eol;
									$header .= "Reply-To: quote1@bookingparcel.com".$eol;
									$header .= "MIME-Version: 1.0\r\n";
									$header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"";
									$message = "--".$uid.$eol;
									$message .= "Content-Type: text/html; charset=ISO-8859-1".$eol;
									$message .= "Content-Transfer-Encoding: 8bit".$eol.$eol;
									$message .= $body.$eol;
									$message .= "--".$uid.$eol;
									$message .= "Content-Type: application/pdf; name=\"".$filename."\"".$eol;
									$message .= "Content-Transfer-Encoding: base64".$eol;
									$message .= "Content-Disposition: attachment; filename=\"".$filename."\"".$eol;
									$message .= $content.$eol;
									$message .= "--".$uid."--";

									$subject = sprintf("=?utf-8?B?" . base64_encode($_POST['title']) . "?=");
									if (mail($_POST['email'], $subject, $message, $header))
									{
										$error = false;
										$error_m = "Sent Successfully";
									}
									else
									{
										$error_m = "Sending was not successful.";
									}

									
								} else {
									$error_m = "Sorry, there was an error uploading your file.";
								}
							}
						}
						else{
							//$eol = PHP_EOL;
							//$uid = md5(uniqid(time()));
							//$header = "From: Quote Booking Parcel <quote1@bookingparcel.com>".$eol;
							//$header .= "Reply-To: quote1@bookingparcel.com".$eol;
							//$header .= "MIME-Version: 1.0\r\n";
							//$header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"";

							$headers  = 'MIME-Version: 1.0' . "\r\n";
							$headers .= 'Content-type: text/html; charset=utf-8;' . "\r\n";
							$headers .= 'From: Booking Parcel <quote1@bookingparcel.com>' . "\r\n";
							$headers .= 'X-Sender: quote1@bookingparcel.com' . "\r\n";
							//mail("e.fakhimi@esmaielfakhimi.ir", $subject, $quote_body, $headers);
							//mail($data['email'], $subject, $customer_body, $headers);
							$subject = sprintf("=?utf-8?B?" . base64_encode($_POST['title']) . "?=");
							if (mail($_POST['email'], $subject, $body, $headers))
							{
								$error = false;
								$error_m = "Sent Successfully";
							}
							else
							{
								$error_m = "Sending was not successful.";
							}
						}
					}
					else{
						$error_m = "Message is required";
					}
				}
				else{
					$error_m = "Email address is required";
				}
			}
			else{
				$error_m = "Title is required";
			}*/
		break;
		case 2:
			if(isset($_POST['title']) AND $_POST['title']!="" AND $_POST['title']!=null){
				if(isset($_POST['message']) AND $_POST['message']!="" AND $_POST['message']!=null){
					$message = "<b>".$_POST['title']."</b><br />".($_POST['message']);
					mysql_query("INSERT INTO `qstatus` (`rid`, `message`, `timestamp`) VALUES (".$_GET['id'].",'".$message."',".time().");");
					
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
					$mail->addAddress($row2['email'], "". $row2['fname'] ." ". $row2['lname'] ."");
					
					
					//$mail->AddCC('cargo@epxcargo.co.uk', "BookingParcel(presend)");
					$mail->AddCC('backup1@bookingparcel.com', "BookingParcel(presend)");
					
					$mail->CharSet ="utf-8";
					$mail->isHTML(true);
					$mail->Subject = $_POST['title'] . " (". $row2['tid'] .") Latest Update";
	
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
					<td colspan='1' style='padding:15px 0;'>". $row2['tid'] ."</td>
				</tr>
				<tr style='background-color:#ccc;text-align:center;font-weight:bold;color:#3a3a3a;'>
					<td colspan='2' style='padding:5px;'>Message Information</td>
				</tr>
				<tr style='background-color:#fff;text-align:ltr;font-family:tahoma;'>
					<td colspan='2' style='padding:15px 0;'>Dear colleague,<br><br>
There has been an update regarding order ". $row2['tid'] .". <br>
<br>
<span style='font-weight:bold;'>". ($_POST['message']) ."</span><br><br>

To view all previous updates, please visit www.bookingparcel.com and click on \"I have a tracking ID\". Then proceed to enter your tracking ID (found above) and e-mail address. <br><br>

Kind regards,<br>
Europost Express team</td>
				</tr>
				<tr style='background-color:#ccc;text-align:center;font-weight:bold;color:#3a3a3a;'>
					<td colspan='2' style='padding:5px;'>Note : This mail may have an attachment, please check it if there is any.</td>
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
		$error_m .= "". $row2['fname'] ." ". $row2['lname'] ." : ".$row2['email']." Sending was not successful.<br>";
		$error_m .= "Mailer Error: " . $mail->ErrorInfo ."<br>";
	} else {
		$error_m .= "". $row2['fname'] ." ". $row2['lname'] ." : ".$row2['email']." Sent Successfully<br>";
	}
					$error_m .= "Message Sent Successfully<br>";
					$error = false;
				}
				else{
					$error_m = "Message is required<br>";
				}
			}
			else{
				$error_m = "Title is required<br>";
			}
		break;
		case 3:
		break;
	}
}
if($error_m!=""){
	?>
<div class="grid_10">
    <div class="box round first">
        <h2>Notifications</h2>
		<div class="block">
		<?php if($error == false){ ?>
			<div class="message success">
				<h5>Success!</h5>
				<p>
					<?php echo $error_m; ?>
				</p>
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
if($_GET['type'] == 1){
	//{offer_price} : The Offered Price (Including the currency)<br>

	$message = $row['message'];
	$price = "";
	if($row2['offered_p']!='')
	{
		$prices = explode(" | ",$row2['offered_p']);
		foreach($prices as $k=>$v){
			if($v!=''){
				$tmp = explode(") ",$v);
				$ttmp = explode("=>",$tmp[1]);
				$price .='<br>';
				$price .=''.$ttmp[2].' '.$ttmp[3].' by '.$ttmp[1].'';
				$_c++;
			}
		}
	}
	elseif($row2['offer_price']!='')
	{
		$price = $row2['offer_price'] ." ". $row2['currency'];
	}
	//echo $price;
	$message = str_replace("{offer_price}", $price, $message);
	$message = str_replace("{tid}", $row2['tid'], $message);
	$message = str_replace("{PaymentStatus}", ($row2['paid']=='no' ? 'UnPaid' : 'Paid'), $message);
	$message = str_replace("{MAWB}", $row2['mawb1'].' - '.$row2['mawb2'].' '.$row2['mawb3'], $message);
	$message = str_replace("{HAWB}", str_replace('|','<br>',$row2['hawb']), $message);
	$message = str_replace("{from_country}", $row2['from'], $message);
	$message = str_replace("{to_country}", $row2['to'], $message);
	$message = str_replace("{from_loc}", $row2['from_st'] . " - " .$row2['from_location'], $message);
	$message = str_replace("{to_loc}", $row2['to_st'] . " - " .$row2['to_location'], $message);
	$message = str_replace("{item_count}", $row2['item_c'], $message);
	$message = str_replace("{item_dims}", $row2['dims'], $message);
	$message = str_replace("{item_weight}", $row2['total_weight'], $message);
	$message = str_replace("{item_Desc}", $row2['item_desc'], $message);
	$message = str_replace("{dgr}", ($row2['danger']=='yes' ? 'Yes, Cargo contains Dangerous Goods' : ''), $message);
	$message = str_replace("{li_bat}", ($row2['lithiumb']=='yes' ? 'Yes, Cargo contains Lithium-ion Battery' : ''), $message);
	$message = str_replace("{chemical}", ($row2['chemical']=='yes' ? 'Yes, Cargo contains Chemical Goods' : ''), $message);
	$message = str_replace("{dgr_alert}", (($row2['danger']=='yes' OR $row2['chemical']=='yes' OR $row2['lithiumb']=='yes') ? 'Important Note: Your order on hold, Please send MSDS to us ASAP.' : ''), $message);
	
?>
        <div class="grid_10">
            <div class="box round first">
                <h2>Send Email as Tracking Message</h2>
                <div class="block">
				<form method="POST" name="email_form_with_php" enctype="multipart/form-data" class="form">
					<input type="hidden" name="t" value="1">
					<table border="1" style="margin-left:auto;margin-right:auto;width:90%;border-collapse:collapse;border-color:#777;font-size:12px">
						<tbody>
							<tr style="background-color:#ccc;text-align:center;color:#3a3a3a">
								<td style="padding:5px; width:20%;">Title</td>
								<td style="padding:5px; width:50%;">Value</td>
								<td style="padding:5px; width:30%;">Desciption</td>
							</tr>
							<tr style="background-color:#fff;text-align:center;font-weight:bold">
								<td style="padding:5px;">Email</td>
								<td style="padding:5px">
									<label for='email'>Primary Email: </label><input type="radio" name="email" id="email" value="<?php echo $row2['email'];?>" <?php echo (($row2['palrtemail']!='' AND stristr($row['title'], 'Pre-alert')!=false) ? '' : 'checked="checked"');?>>&nbsp;<?php echo $row2['email'];?><br>
									<label for='email'>Pre-Alert Email: </label><input type="radio" name="email" id="email" value="<?php echo $row2['palrtemail'];?>" <?php echo ($row2['palrtemail']=='' ? "disabled" : ""); echo (($row2['palrtemail']!='' AND stristr($row['title'], 'pre-alert')!=false) ? 'checked="checked"' : '');?>>&nbsp;<?php echo $row2['palrtemail'];?><br>
									<label for='email'>Invoice Email: </label><input type="radio" name="email" id="email" value="<?php echo $row2['invemail'];?>" <?php echo ($row2['invemail']=='' ? "disabled" : "");?>>&nbsp;<?php echo $row2['invemail'];?><br>
								</td>
								<td style="padding:5px">The Email address of your customer.</td>
								
							</tr>
							<tr style="background-color:#fff;text-align:center;font-weight:bold">
								<td style="padding:5px;">Subject</td>
								<td style="padding:5px"><input type="text" id="title" name="title" value="<?php echo $row['title']; ?>"></td>
								<td style="padding:5px">This will be shown as subject.</td>
								
							</tr>
							<tr style="background-color:#fff;text-align:center;font-weight:bold">
								<td style="padding:5px;">Message</td>
								<td style="padding:5px;"><textarea name="message" class="ckeditor" style="margin: 5px; height: 75px; width:80%;"><?php echo ($message); ?></textarea></td>
								<td style="padding:5px;">
									This is the message that you will send or forward it.please check it and edit it if you need.<br>
									
							CC :<br>
							<?php if($row2['cc1']!=''){ ?><label for='cc1'><input type="checkbox" name="cc1" id="cc1" value="<?php echo $row2['cc1'];?>"><?php echo $row2['cc1'];?></label><br><?php } ?>
							<?php if($row2['cc2']!=''){ ?><label for='cc2'><input type="checkbox" name="cc2" id="cc2" value="<?php echo $row2['cc2'];?>"><?php echo $row2['cc2'];?></label><br><?php } ?>
							<?php if($row2['cc3']!=''){ ?><label for='cc3'><input type="checkbox" name="cc3" id="cc3" value="<?php echo $row2['cc3'];?>"><?php echo $row2['cc3'];?></label><br><?php } ?>
							<?php if($row2['cc4']!=''){ ?><label for='cc4'><input type="checkbox" name="cc4" id="cc4" value="<?php echo $row2['cc4'];?>"><?php echo $row2['cc4'];?></label><br><?php } ?>
							<br>
								</td>
							</tr>
							<tr style="background-color:#fff;text-align:center;font-weight:bold">
								<td style="padding:5px;">Attachment</td>
								<td style="padding:5px;">
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
								
								</td>
								<td style="padding:5px;">
									The files or documents that you want to attach. it is not required.
								</td>
							</tr>
							<tr style="background-color:#fff;text-align:center;font-weight:bold">
								<td colspan="3">
									<button class="btn" name="submit" type="submit">Confirm</button>
								</td>
							</tr>
						</tbody>
					</table>
				</form>
                </div>
            </div>
        </div>
<?php 	
	
}
elseif($_GET['type'] == 2){
/*
{tid} : Tracking ID<br>
{from_country} : Collection Country<br>
{to_country} : Destination Country<br>
{from_loc} : Collection state and zip code<br>
{to_loc} : Destination  state and zip code<br>
{item_count} : Item Count<br>
{item_dims} : Item Dimensions<br>
{item_weight} : Item Weight<br>
{item_Desc} : Item Weight
*/
	$message = $row['message'];
	$price = "";
	if($row2['offered_p']!='')
	{
		$prices = explode(" | ",$row2['offered_p']);
		foreach($prices as $k=>$v){
			if($v!=''){
				$tmp = explode(") ",$v);
				$ttmp = explode("=>",$tmp[1]);
				$price .='<br>';
				$price .=''.$ttmp[2].' '.$ttmp[3].' by '.$ttmp[1].'';
				$_c++;
			}
		}
	}
	elseif($row2['offer_price']!='')
	{
		$price = $row2['offer_price'] ." ". $row2['currency'];
	}
	$message = str_replace("{offer_price}", $price, $message);
	$message = str_replace("{tid}", $row2['tid'], $message);
	$message = str_replace("{PaymentStatus}", ($row2['paid']=='no' ? 'UnPaid' : 'Paid'), $message);
	$message = str_replace("{MAWB}", $row2['mawb1'].' - '.$row2['mawb2'].' '.$row2['mawb3'], $message);
	$message = str_replace("{HAWB}", str_replace('|','<br>',$row2['hawb']), $message);
	//$message = str_replace("{offer_price}", $row2['offer_price'] ." ". $row2['currency'], $message);
	$message = str_replace("{from_country}", $row2['from'], $message);
	$message = str_replace("{to_country}", $row2['to'], $message);
	$message = str_replace("{from_loc}", $row2['from_st'] . " - " .$row2['from_location'], $message);
	$message = str_replace("{to_loc}", $row2['to_st'] . " - " .$row2['to_location'], $message);
	$message = str_replace("{item_count}", $row2['item_c'], $message);
	$message = str_replace("{item_dims}", $row2['dims'], $message);
	$message = str_replace("{item_weight}", $row2['total_weight'], $message);
	$message = str_replace("{item_Desc}", $row2['item_desc'], $message);
	$message = str_replace("{dgr}", ($row2['danger']=='yes' ? 'Yes, Cargo contains Dangerous Goods' : ''), $message);
	$message = str_replace("{li_bat}", ($row2['lithiumb']=='yes' ? 'Yes, Cargo contains Lithium-ion Battery' : ''), $message);
	$message = str_replace("{chemical}", ($row2['chemical']=='yes' ? 'Yes, Cargo contains Chemical Goods' : ''), $message);
	$message = str_replace("{dgr_alert}", (($row2['danger']=='yes' OR $row2['chemical']=='yes' OR $row2['lithiumb']=='yes') ? 'Important Note: Your order on hold, Please send MSDS to us ASAP.' : ''), $message);
	
?>
        <div class="grid_10">
            <div class="box round first">
                <h2>Send Tracking Message</h2>
                <div class="block">
				<form method="post">
					<input type="hidden" name="t" value="2">
					<table border="1" style="margin-left:auto;margin-right:auto;width:90%;border-collapse:collapse;border-color:#777;font-size:12px">
						<tbody>
							<tr style="background-color:#ccc;text-align:center;color:#3a3a3a">
								<td style="padding:5px; width:20%;">Title</td>
								<td style="padding:5px; width:50%;">Value</td>
								<td style="padding:5px; width:30%;">Desciption</td>
							</tr>
							<tr style="background-color:#fff;text-align:center;font-weight:bold">
								<td style="padding:5px;">Title</td>
								<td style="padding:5px"><input type="text" id="title" name="title" value="<?php echo $row['title']; ?>"></td>
								<td style="padding:5px">This will show at the first line and bold.</td>
								
							</tr>
							<tr style="background-color:#fff;text-align:center;font-weight:bold">
								<td style="padding:5px;">Message</td>
								<td style="padding:5px;"><textarea name="message" class="ckeditor" style="margin: 5px; height: 75px; width:80%;"><?php echo ($message); ?></textarea></td>
								<td style="padding:5px;">
									This is the message that you will send or forward it.please check it and edit it if you need.
								</td>
							</tr>
							<tr style="background-color:#fff;text-align:center;font-weight:bold">
								<td colspan="3">
									<button class="btn" name="submit" type="submit">Confirm</button>
								</td>
							</tr>
							
						</tbody>
					</table>
				</form>
                </div>
            </div>
        </div>
<?php 	
}
elseif($_GET['type'] == 3){}
?>

        <div class="clear">
        </div>
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
mysql_close();
include("footer.php");
?>