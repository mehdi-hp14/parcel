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
$temp=$id=null;
$id = 0;
$tid = 0;
$row=[];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Reports | Booking Parcel Admin</title>
    <link rel="stylesheet" type="text/css" href="css/reset.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/text.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/grid.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/nav.css" media="screen" />
    <!--[if IE 6]><link rel="stylesheet" type="text/css" href="css/ie6.css" media="screen" /><![endif]-->
    <!--[if IE 7]><link rel="stylesheet" type="text/css" href="css/ie.css" media="screen" /><![endif]-->
    <!-- BEGIN: load jquery -->
    <script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/jquery-ui/jquery.ui.core.min.js"></script>
    <script src="js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.core.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.slide.min.js" type="text/javascript"></script>
    <!-- END: load jquery -->
    <!-- BEGIN: load jqplot -->
    <link rel="stylesheet" type="text/css" href="css/jquery.jqplot.min.css" />
    <!--[if lt IE 9]><script language="javascript" type="text/javascript" src="js/jqPlot/excanvas.min.js"></script><![endif]-->
    <script language="javascript" type="text/javascript" src="js/jqPlot/jquery.jqplot.min.js"></script>
    <script language="javascript" type="text/javascript" src="js/jqPlot/plugins/jqplot.barRenderer.min.js"></script>
    <script language="javascript" type="text/javascript" src="js/jqPlot/plugins/jqplot.pieRenderer.min.js"></script>
    <script language="javascript" type="text/javascript" src="js/jqPlot/plugins/jqplot.categoryAxisRenderer.min.js"></script>
    <script language="javascript" type="text/javascript" src="js/jqPlot/plugins/jqplot.highlighter.min.js"></script>
    <script language="javascript" type="text/javascript" src="js/jqPlot/plugins/jqplot.pointLabels.min.js"></script>
    <!-- END: load jqplot -->
    <script src="js/setup.js" type="text/javascript"></script>
    <script type="text/javascript">

        $(document).ready(function () {
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
    </script>
</head>
<body>

<?php
if(isset($row['tid'])){
    $temp = "Item ID : ".$id."<br>Tracking ID : ".$row['tid']."<br><hr>";
    $temp .= '<table style="border-collapse: collapse; width: 566pt" border="0" cellpadding="0" cellspacing="0" width="754"><tbody><tr style="height:27.6pt" height="36"><td colspan="3" style="height: 27.6pt;; width: 470pt" height="36" align="left" width="626">Sender (Collection) Information <font color="#ff0000">( Also for HAWB)</font><br></td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt" height="26" align="left"><span style="">&nbsp;</span>Company Name</td><td >&nbsp;</td><td  align="left">'.$row2['scompany'].'</td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Address</td><td  style="border-top: none">&nbsp;</td><td  align="left">'.$row2['saddress'].'</td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Zip Code</td><td  style="border-top: none">&nbsp;</td><td >'. $row2['szipcode'].'</td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Country</td><td  style="border-top: none">&nbsp;</td><td  align="left">'.$row2['scountry'].'</td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Contact Person</td><td  style="border-top: none">&nbsp;</td><td  align="left">'.$row2['scontactp'].'</td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Telephone</td><td  style="border-top: none">&nbsp;</td><td  align="left">'.$row2['stelephone'].'</td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>E-mail</td><td  style="border-top: none">&nbsp;</td><td align="left">'.$row2['semail'].'</td></tr><tr style="height: 27.6pt" height="36"><td  colspan="3" style="height: 27.6pt;" height="36" align="left">Receiver (Delivery) Information <font color="#ff0000">( Also for HAWB)</font></td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt" height="26" align="left"><span style="">&nbsp;</span>Company Name</td><td >&nbsp;</td><td  align="left">'.$row2['rcompany'].'</td></tr>';
    $temp .= '<tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Address</td><td  style="border-top: none">&nbsp;</td><td  align="left">'. $row2['raddress'].'</td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Zip Code</td><td  style="border-top: none">&nbsp;</td><td >'. $row2['rpostcode'].'</td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Country</td><td  style="border-top: none">&nbsp;</td><td  align="left">'. $row2['rcountry'].'</td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Contact Person</td><td  style="border-top: none">&nbsp;</td><td  align="left">'. $row2['rcontactp'].'</td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Telephone</td><td  style="border-top: none">&nbsp;</td><td  align="left">'. $row2['rtelephone'].'</td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>E-mail</td><td  style="border-top: none">&nbsp;</td><td align="left">'. $row2['remail'].'</td></tr></tbody></table><br>';
    $temp .= '<br>';
    if($user_info!=null and is_array($user_info) AND false){
        $temp .= $user_info['company'] ."\n".$user_info['address']."\nTel : ".$user_info['phone'];
    }
    $temp .= '<br>';
}



$output = "";

$con = mysql_connect(DB_HOST,DB_USER,DB_PASS) or die(mysql_error());
mysql_select_db(DB_NAME, $con) or die(mysql_error());


if(isset($_GET['type']))
{
	switch($_GET['type'])
	{
		case 1:
			if(isset($_POST['qid']) AND is_numeric($_POST['qid']) AND $_POST['qid']>0){
				
				$q = "SELECT count(*) as cc FROM `quote` WHERE `id`=".$_POST['qid']."";
				$rr = mysql_fetch_array(mysql_query($q));
				if($rr['cc']>0){
					$id = $_POST['qid'];
					$airline = "";
					$row = mysql_fetch_array(mysql_query("SELECT * FROM `quote` WHERE `id`=".$id.""));
					if($row['offered_p']!='' AND $row['offered_p']!=null)
					{
						$tmp = explode(" | ",$row['offered_p']);
						foreach($tmp as $k=>$v)
						{
							if($v!='')
							{
								$t = explode(") ",$v);
								$tt = explode("=>",$t[1]);
								if($tt[0]=='on')
								{
									$airline = $tt[1];
									break;
								}
							}
						}
					}

					$res = mysql_query("SELECT * FROM `ship_info` WHERE `ref`=".$id."");
					if(mysql_num_rows($res)>0)
					{
						$row2 = mysql_fetch_array($res);
					}
					else
					{
						$row2 = array();
					}

					$res = mysql_query("SELECT * FROM `agents_official_meta` WHERE `cover_counteries` LIKE '%".$row['from']."%' OR (".($row['from']=='Iran' ? 'true' : 'false')." AND `cover_counteries` LIKE '%".$row['to']."%') ORDER by `id` DESC");
					if(mysql_num_rows($res)>0)
					{
						$official_agent = mysql_fetch_array($res);
					}
					else
					{
						$official_agent = array();
					}

					$user_info = null;
					if($row['uname']!="" AND $row['uname']!=null)
					{
						$res = mysql_query("SELECT `company`,`address`,`phone` FROM `users` WHERE `uname`='".$row['uname']."'");
						if(mysql_num_rows($res)>0)
						{
							$user_info = mysql_fetch_array($res);
						}
					}
					$res = mysql_query("SELECT * FROM `agents` WHERE `id` IN (SELECT `aref` as id FROM `urls` WHERE `ref`=".$id.")");
					if(mysql_num_rows($res)>0)
					{
						$agent = mysql_fetch_array($res);
					}
					
										
					$output .= "Item ID : ".$id."<br>Tracking ID : ".$row['tid']."<br><b>___________________________</b><br>";
					if(isset($agent) AND $agent!=null AND is_array($agent))
					{ 
						$emails = explode("\n", $agent['emails']);
						$output .= "Agent ID : ".$agent['id']."<br>";
						$output .= "Agent Email : ".$emails[0]."<br>";
						$output .= "Agent Name : ".$agent['fname']."<br>";
						$output .= "Agent Company : ".$agent['cname']."<br><b>___________________________</b><br>";
                        $output .= 'Dear '.$agent['fname'].',<br><br>';

                    }
					else
					{
						$output .= "<span style='color:#ff0000;'>Note</span> : No Agent is connected to this quote.<br>";
						$output .= "Agent ID : --<br>";
						$output .= "Agent Email : --<br>";
						$output .= "Agent Name : --<br>";
						$output .= "Agent Company : --<br><b>___________________________</b><br>";
					}
                    $row2['scompany'] = $row2['scompany'] ??'';
                    $row2['saddress'] = $row2['saddress'] ??'';
                    $row2['szipcode'] = $row2['szipcode'] ??'';
                    $row2['scountry'] = $row2['scountry'] ??'';
                    $row2['scontactp'] = $row2['scontactp'] ??'';
                    $row2['stelephone'] = $row2['stelephone'] ??'';
                    $row2['semail'] = $row2['semail'] ??'';
                    $row2['rcompany'] = $row2['rcompany'] ??'';
                    $row2['raddress'] = $row2['raddress'] ??'';
                    $row2['rpostcode'] = $row2['rpostcode'] ??'';
                    $row2['rcountry'] = $row2['rcountry'] ??'';
                    $row2['rcontactp'] = $row2['rcontactp'] ??'';
                    $row2['rtelephone'] = $row2['rtelephone'] ??'';
                    $row2['remail'] = $row2['remail'] ??'';


					$output .= 'This order (Ref. '. $row['tid'] .') Confirmed by <span style="font-weight:bold;color:#ff0000;">'.$airline.'</span>. Please arrange collection as following instruction and update us <b>ASAP</b>:<br>';
					$output .= '<span style="color:#ff0000;font-weight:bold;">Very Important Note:<br>Please make sure and write in Manifest  following information for this cargo as well:<br>Full address of sender and receiver<br>Full description of goods<br>Weight and value<br>HS code /Codes</span><br><br>';
					$output .= '<table style="border-collapse: collapse; width: 566pt" border="0" cellpadding="0" cellspacing="0" width="754"><tbody><tr style="height:27.6pt" height="36"><td colspan="3" style="height: 27.6pt;; width: 470pt" height="36" align="left" width="626">Sender (Collection) Information <font color="#ff0000">( Also for HAWB)</font><br></td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt" height="26" align="left"><span style="">&nbsp;</span>Company Name</td><td >&nbsp;</td><td  align="left">'.$row2['scompany'].'</td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Address</td><td  style="border-top: none">&nbsp;</td><td  align="left">'.$row2['saddress'].'</td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Zip Code</td><td  style="border-top: none">&nbsp;</td><td >'. $row2['szipcode'].'</td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Country</td><td  style="border-top: none">&nbsp;</td><td  align="left">'.$row2['scountry'].'</td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Contact Person</td><td  style="border-top: none">&nbsp;</td><td  align="left">'.$row2['scontactp'].'</td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Telephone</td><td  style="border-top: none">&nbsp;</td><td  align="left">'.$row2['stelephone'].'</td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>E-mail</td><td  style="border-top: none">&nbsp;</td><td align="left">'.$row2['semail'].'</td></tr><tr style="height: 27.6pt" height="36"><td  colspan="3" style="height: 27.6pt;" height="36" align="left">Receiver (Delivery) Information <font color="#ff0000">( Also for HAWB)</font></td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt" height="26" align="left"><span style="">&nbsp;</span>Company Name</td><td >&nbsp;</td><td  align="left">'.$row2['rcompany'].'</td></tr>';
					$output .= '<tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Address</td><td  style="border-top: none">&nbsp;</td><td  align="left">'. $row2['raddress'].'</td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Zip Code</td><td  style="border-top: none">&nbsp;</td><td >'. $row2['rpostcode'].'</td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Country</td><td  style="border-top: none">&nbsp;</td><td  align="left">'. $row2['rcountry'].'</td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Contact Person</td><td  style="border-top: none">&nbsp;</td><td  align="left">'. $row2['rcontactp'].'</td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Telephone</td><td  style="border-top: none">&nbsp;</td><td  align="left">'. $row2['rtelephone'].'</td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>E-mail</td><td  style="border-top: none">&nbsp;</td><td align="left">'. $row2['remail'].'</td></tr><tr style="height: 27.6pt" height="36"><td colspan="2" style="height: 27.6pt;" height="36">Shipment Information</td><td>&nbsp;</td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt" height="26" align="left"><span style="">&nbsp;</span>Contents</td><td >&nbsp;</td><td align="left"  style="margin: 0px; height: 150px;"></td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Document Info./No.</td>';
					$output .= '<td  style="border-top: none">&nbsp;</td><td ></td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Gross Weight (kg)</td><td  style="border-top: none">&nbsp;</td><td >'. $row['total_weight'].'</td></tr><tr style="height: 20.1pt" height="26"><td class="xl75" style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Dimensions (cm)</td><td class="xl76" style="border-top: none">&nbsp;</td><td align="left">'. str_replace(" | ","\n",$row['dims']).'</td></tr></tbody></table><br>';
					$output .= 'Please note, use above information for Collection and instruction  for HAWB.<br>and following information for MAWB;<br><br>Shipper:<br>Europost Express (UK) Ltd.<br>4 Corringham Road,<br>Wembley - Middlesex<br>HA9 9QA- London , UK<br>Tel : +44(0) 7886105417<br><br>And Consignee in MAWB will be:<br>';
					if($user_info!=null and is_array($user_info)){
						$output .= $user_info['company'] ."\n".$user_info['address']."\nTel : ".$user_info['phone'];
					}
					$output .= '<br><br>Please confirm that you have received this confirmation order.<br><br>Best Regards<br>Fazel Zohrabpour<br><br><div style=\'font-size:80%;color:#0033cc;\'><img src="https://bookingparcel.com/logo.gif" style="width:215px;height:50px;"><br>Europost Express (UK) Ltd.<br>4 Corringham Road,<br>Wembley - Middlesex<br>HA9 9QA- London , UK<br>Tel : +44(0) 7886105417<br></div>';

					$output .= '<br><br><br><hr><br><br>';
				}
			}
			break;
		case 2:
			if(isset($_POST['qid1']) AND is_numeric($_POST['qid1']) AND $_POST['qid1']>0 AND isset($_POST['qid2']) AND is_numeric($_POST['qid2']) AND $_POST['qid2']>0){
//				dd($_POST['qid1'],$_POST['qid2'] );
				$q = "SELECT count(*) as cc FROM `quote` WHERE `id`>= ". (int)$_POST['qid1'] ." AND  `id`<= ". (int)$_POST['qid2'] ." AND `status` IN (1,2,4)";
				$rr = mysql_fetch_array(mysql_query($q));
				echo $rr['cc']." Reports are listed bellow<br><br><br><br><br>___________________________</b><br>";
				if($rr['cc']>0){
					
					$q = "SELECT id FROM `quote` WHERE `id`>= ". (int)$_POST['qid1'] ." AND  `id`<= ". (int)$_POST['qid2'] ." AND `status` IN (1,2,4)";
					$ress = mysql_query($q);
					while($rrr = mysql_fetch_array($ress))
					{
						$id = $rrr['id'];
						$airline = "";
						$row = mysql_fetch_array(mysql_query("SELECT * FROM `quote` WHERE `id`=".$id.""));
						if($row['offered_p']!='' AND $row['offered_p']!=null)
						{
							$tmp = explode(" | ",$row['offered_p']);
							foreach($tmp as $k=>$v)
							{
								if($v!='')
								{
									$t = explode(") ",$v);
									$tt = explode("=>",$t[1]);
									if($tt[0]=='on')
									{
										$airline = $tt[1];
										break;
									}
								}
							}
						}

						$res = mysql_query("SELECT * FROM `ship_info` WHERE `ref`=".$id."");
						if(mysql_num_rows($res)>0)
						{
							$row2 = mysql_fetch_array($res);
						}
						else
						{
							$row2 = array();
						}

						$res = mysql_query("SELECT * FROM `agents_official_meta` WHERE `cover_counteries` LIKE '%".$row['from']."%' OR (".($row['from']=='Iran' ? 'true' : 'false')." AND `cover_counteries` LIKE '%".$row['to']."%') ORDER by `id` DESC");
						if(mysql_num_rows($res)>0)
						{
							$official_agent = mysql_fetch_array($res);
						}
						else
						{
							$official_agent = array();
						}

						$user_info = null;
						if($row['uname']!="" AND $row['uname']!=null)
						{
							$res = mysql_query("SELECT `company`,`address`,`phone` FROM `users` WHERE `uname`='".$row['uname']."'");
							if(mysql_num_rows($res)>0)
							{
								$user_info = mysql_fetch_array($res);
							}
						}
						$res = mysql_query("SELECT * FROM `agents` WHERE `id` IN (SELECT `aref` as id FROM `urls` WHERE `ref`=".$id.")");
						if(mysql_num_rows($res)>0)
						{
							$agent = mysql_fetch_array($res);
						}
                        $row2['scompany'] = $row2['scompany'] ??'';
                        $row2['saddress'] = $row2['saddress'] ??'';
                        $row2['szipcode'] = $row2['szipcode'] ??'';
                        $row2['scountry'] = $row2['scountry'] ??'';
                        $row2['scontactp'] = $row2['scontactp'] ??'';
                        $row2['stelephone'] = $row2['stelephone'] ??'';
                        $row2['semail'] = $row2['semail'] ??'';
                        $row2['rcompany'] = $row2['rcompany'] ??'';
                        $row2['raddress'] = $row2['raddress'] ??'';
                        $row2['rpostcode'] = $row2['rpostcode'] ??'';
                        $row2['rcountry'] = $row2['rcountry'] ??'';
                        $row2['rcontactp'] = $row2['rcontactp'] ??'';
                        $row2['rtelephone'] = $row2['rtelephone'] ??'';
                        $row2['remail'] = $row2['remail'] ??'';

						$output .= "Item ID : ".$id."<br>Tracking ID : ".$row['tid']."<br><b>___________________________</b><br>";
						$output .= '<table style="border-collapse: collapse; width: 566pt" border="0" cellpadding="0" cellspacing="0" width="754"><tbody><tr style="height:27.6pt" height="36"><td colspan="3" style="height: 27.6pt;; width: 470pt" height="36" align="left" width="626">Sender (Collection) Information <font color="#ff0000">( Also for HAWB)</font><br></td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt" height="26" align="left"><span style="">&nbsp;</span>Company Name</td><td >&nbsp;</td><td  align="left">'.$row2['scompany'].'</td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Address</td><td  style="border-top: none">&nbsp;</td><td  align="left">'.$row2['saddress'].'</td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Zip Code</td><td  style="border-top: none">&nbsp;</td><td >'. $row2['szipcode'].'</td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Country</td><td  style="border-top: none">&nbsp;</td><td  align="left">'.$row2['scountry'].'</td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Contact Person</td><td  style="border-top: none">&nbsp;</td><td  align="left">'.$row2['scontactp'].'</td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Telephone</td><td  style="border-top: none">&nbsp;</td><td  align="left">'.$row2['stelephone'].'</td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>E-mail</td><td  style="border-top: none">&nbsp;</td><td align="left">'.$row2['semail'].'</td></tr><tr style="height: 27.6pt" height="36"><td  colspan="3" style="height: 27.6pt;" height="36" align="left">Receiver (Delivery) Information <font color="#ff0000">( Also for HAWB)</font></td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt" height="26" align="left"><span style="">&nbsp;</span>Company Name</td><td >&nbsp;</td><td  align="left">'.$row2['rcompany'].'</td></tr>';
						$output .= '<tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Address</td><td  style="border-top: none">&nbsp;</td><td  align="left">'. $row2['raddress'].'</td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Zip Code</td><td  style="border-top: none">&nbsp;</td><td >'. $row2['rpostcode'].'</td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Country</td><td  style="border-top: none">&nbsp;</td><td  align="left">'. $row2['rcountry'].'</td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Contact Person</td><td  style="border-top: none">&nbsp;</td><td  align="left">'. $row2['rcontactp'].'</td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Telephone</td><td  style="border-top: none">&nbsp;</td><td  align="left">'. $row2['rtelephone'].'</td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>E-mail</td><td  style="border-top: none">&nbsp;</td><td align="left">'. $row2['remail'].'</td></tr></tbody></table><br>';

						$output .= '<br><br><br><hr><br><br>';
					}
				}
			}
		
			break;
		case 3:
			if(isset($_POST['date1']) AND $_POST['date1']!=null AND $_POST['date1']!="" AND isset($_POST['date2']) AND $_POST['date2']!=null AND $_POST['date2']!=""){
				$parms1 = explode("/",$_POST['date1']);
				$date1 = mktime(0,0,0,$parms1[1],$parms1[2],$parms1[0]);
				$parms2 = explode("/",$_POST['date2']);
				$date2 = mktime(23,59,59,$parms2[1],$parms2[2],$parms2[0]);
				$q = "SELECT count(*) as cc FROM `quote` WHERE `timestamp`>= ". $date1 ." AND  `timestamp`<= ". $date2 ."";
				$rr = mysql_fetch_array(mysql_query($q));
				if($rr['cc']>0){
					
					$q = "SELECT id FROM `quote` WHERE `timestamp`>= ". $date1 ." AND  `timestamp`<= ". $date2 ."";
					$ress = mysql_query($q);
					while($rrr = mysql_fetch_array($ress))
					{
						$id = $rrr['id'];
						$airline = "";
						$row = mysql_fetch_array(mysql_query("SELECT * FROM `quote` WHERE `id`=".$id.""));
						if($row['offered_p']!='' AND $row['offered_p']!=null)
						{
							$tmp = explode(" | ",$row['offered_p']);
							foreach($tmp as $k=>$v)
							{
								if($v!='')
								{
									$t = explode(") ",$v);
									$tt = explode("=>",$t[1]);
									if($tt[0]=='on')
									{
										$airline = $tt[1];
										break;
									}
								}
							}
						}

						$res = mysql_query("SELECT * FROM `ship_info` WHERE `ref`=".$id."");
						if(mysql_num_rows($res)>0)
						{
							$row2 = mysql_fetch_array($res);
						}
						else
						{
							$row2 = array();
						}

						$res = mysql_query("SELECT * FROM `agents_official_meta` WHERE `cover_counteries` LIKE '%".$row['from']."%' OR (".($row['from']=='Iran' ? 'true' : 'false')." AND `cover_counteries` LIKE '%".$row['to']."%') ORDER by `id` DESC");
						if(mysql_num_rows($res)>0)
						{
							$official_agent = mysql_fetch_array($res);
						}
						else
						{
							$official_agent = array();
						}

						$user_info = null;
						if($row['uname']!="" AND $row['uname']!=null)
						{
							$res = mysql_query("SELECT `company`,`address`,`phone` FROM `users` WHERE `uname`='".$row['uname']."'");
							if(mysql_num_rows($res)>0)
							{
								$user_info = mysql_fetch_array($res);
							}
						}
						$res = mysql_query("SELECT * FROM `agents` WHERE `id` IN (SELECT `aref` as id FROM `urls` WHERE `ref`=".$id.")");
						if(mysql_num_rows($res)>0)
						{
							$agent = mysql_fetch_array($res);
						}
					
						$output .= "Item ID : ".$id."<br>Tracking ID : ".$row['tid']."<br><b>___________________________</b><br>";
						if(isset($agent) AND $agent!=null AND is_array($agent))
						{ 
							$emails = explode("\n", $agent['emails']);
							$output .= "Agent ID : ".$agent['id']."<br>";
							$output .= "Agent Email : ".$emails[0]."<br>";
							$output .= "Agent Name : ".$agent['fname']."<br>";
							$output .= "Agent Company : ".$agent['cname']."<br><b>___________________________</b><br>";
                            $output .= 'Dear '.$agent['fname'].',<br><br>';

                        }
						else
						{
							$output .= "<span style='color:#ff0000;'>Note</span> : No Agent is connected to this quote.<br>";
							$output .= "Agent ID : --<br>";
							$output .= "Agent Email : --<br>";
							$output .= "Agent Name : --<br>";
							$output .= "Agent Company : --<br><b>___________________________</b><br>";
						}
$row2['scompany'] = $row2['scompany'] ??'';
$row2['saddress'] = $row2['saddress'] ??'';
$row2['szipcode'] = $row2['szipcode'] ??'';
$row2['scountry'] = $row2['scountry'] ??'';
$row2['scontactp'] = $row2['scontactp'] ??'';
$row2['stelephone'] = $row2['stelephone'] ??'';
$row2['semail'] = $row2['semail'] ??'';
$row2['rcompany'] = $row2['rcompany'] ??'';
$row2['raddress'] = $row2['raddress'] ??'';
$row2['rpostcode'] = $row2['rpostcode'] ??'';
$row2['rcountry'] = $row2['rcountry'] ??'';
$row2['rcontactp'] = $row2['rcontactp'] ??'';
$row2['rtelephone'] = $row2['rtelephone'] ??'';
$row2['remail'] = $row2['remail'] ??'';
						$output .= 'This order (Ref. '. $row['tid'] .') Confirmed by <span style="font-weight:bold;color:#ff0000;">'.$airline.'</span>
. Please arrange collection as following instruction and update us <b>ASAP</b>:<br>';
						$output .= '<span style="color:#ff0000;font-weight:bold;">Very Important Note:<br>
Please make sure and write in Manifest  following information for this cargo as well:<br>Full address of sender and receiver<br>Full description of goods<br>Weight and value<br>HS code /Codes</span><br><br>';
						$output .= '<table style="border-collapse: collapse; width: 566pt" border="0" cellpadding="0" cellspacing="0" width="754">
<tbody><tr style="height:27.6pt" height="36"><td colspan="3" style="height: 27.6pt;; width: 470pt" height="36" align="left" width="626">Sender (Collection) Information <font color="#ff0000">( Also for HAWB)</font><br></td></tr><tr style="height: 20.1pt" height="26">
<td  style="height: 20.1pt" height="26" align="left"><span style="">&nbsp;</span>Company Name</td><td >&nbsp;</td><td  align="left">'.$row2['scompany'].'</td></tr>
<tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Address</td><td  style="border-top: none">&nbsp;</td><td  align="left">'.$row2['saddress'].'</td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Zip Code</td><td  style="border-top: none">&nbsp;</td><td >'. $row2['szipcode'].'</td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Country</td><td  style="border-top: none">&nbsp;</td><td  align="left">'.$row2['scountry'].'</td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Contact Person</td><td  style="border-top: none">&nbsp;</td><td  align="left">'.$row2['scontactp'].'</td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Telephone</td><td  style="border-top: none">&nbsp;</td><td  align="left">'.$row2['stelephone'].'</td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>E-mail</td><td  style="border-top: none">&nbsp;</td><td align="left">'.$row2['semail'].'</td></tr><tr style="height: 27.6pt" height="36"><td  colspan="3" style="height: 27.6pt;" height="36" align="left">Receiver (Delivery) Information <font color="#ff0000">( Also for HAWB)</font></td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt" height="26" align="left"><span style="">&nbsp;</span>Company Name</td><td >&nbsp;</td><td  align="left">'.$row2['rcompany'].'</td></tr>';
						$output .= '<tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Address</td><td  style="border-top: none">&nbsp;</td><td  align="left">'. $row2['raddress'].'</td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Zip Code</td><td  style="border-top: none">&nbsp;</td><td >'. $row2['rpostcode'].'</td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Country</td><td  style="border-top: none">&nbsp;</td><td  align="left">'. $row2['rcountry'].'</td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Contact Person</td><td  style="border-top: none">&nbsp;</td><td  align="left">'. $row2['rcontactp'].'</td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Telephone</td><td  style="border-top: none">&nbsp;</td><td  align="left">'. $row2['rtelephone'].'</td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>E-mail</td><td  style="border-top: none">&nbsp;</td><td align="left">'. $row2['remail'].'</td></tr><tr style="height: 27.6pt" height="36"><td colspan="2" style="height: 27.6pt;" height="36">Shipment Information</td><td>&nbsp;</td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt" height="26" align="left"><span style="">&nbsp;</span>Contents</td><td >&nbsp;</td><td align="left"  style="margin: 0px; height: 150px;"></td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Document Info./No.</td>';
						$output .= '<td  style="border-top: none">&nbsp;</td><td ></td></tr><tr style="height: 20.1pt" height="26"><td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Gross Weight (kg)</td><td  style="border-top: none">&nbsp;</td><td >'. $row['total_weight'].'</td></tr><tr style="height: 20.1pt" height="26"><td class="xl75" style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Dimensions (cm)</td><td class="xl76" style="border-top: none">&nbsp;</td><td align="left">'. str_replace(" | ","\n",$row['dims']).'</td></tr></tbody></table><br>';
						$output .= 'Please note, use above information for Collection and instruction  for HAWB.<br>and following information for MAWB;<br><br>Shipper:<br>Europost Express (UK) Ltd.<br>4 Corringham Road,<br>Wembley - Middlesex<br>HA9 9QA- London , UK<br>Tel : +44(0) 7886105417<br><br>And Consignee in MAWB will be:<br>';
						if($user_info!=null and is_array($user_info)){
							$output .= $user_info['company'] ."\n".$user_info['address']."\nTel : ".$user_info['phone'];
						}
						$output .= '<br><br>Please confirm that you have received this confirmation order.<br><br>Best Regards<br>Fazel Zohrabpour<br><br><div style=\'font-size:80%;color:#0033cc;\'><img src="https://bookingparcel.com/logo.gif" style="width:215px;height:50px;"><br>Europost Express (UK) Ltd.<br>4 Corringham Road,<br>Wembley - Middlesex<br>HA9 9QA- London , UK<br>Tel : +44(0) 7886105417<br></div>';

						$output .= '<br><br><br><hr><br><br>';
					}
				}
			}
		
		
			break;
		default :
			$output = "Nothing found!";
			break;
	}
}

echo $output;
?>



</body>
</html>
<?php
mysql_close();
include("footer.php");
?>