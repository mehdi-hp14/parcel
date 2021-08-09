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
/*
$arr1 = array ('a'=>1,'b'=>2,'c'=>3,'d'=>4,'e'=>5);
file_put_contents("array.json",json_encode($arr1));
# array.json => {"a":1,"b":2,"c":3,"d":4,"e":5}
$arr2 = json_decode(file_get_contents('array.json'), true);
$arr1 === $arr2 # => true
*/
if(!file_exists('mail_content.php') AND (!file_exists('mail_address.php') or !file_exists('mail_address.json'))){
	//header("Location: dashboard.php");
	exit("invalid request....<br><a href='dashboard.php'>Dashboard</a>");
}
else{
	if(file_exists('mail_address_er.json')){
		$mails_er = json_decode(file_get_contents('mail_address_er.json'), true);
	}else
	{
		$mails_er = array();
	}
	
	include('mail_content.php');
	if(file_exists('mail_address.php')){
		include('mail_address.php');
		unlink('mail_address.json');
	}
	elseif(file_exists('mail_address.json')){
		$mails = json_decode(file_get_contents('mail_address.json'), true);
	}
	else{
		include('mail_address.php');
	}
}

if(count($mails)<=0){
	header("Location: dashboard.php");
	exit("invalid request....<br><a href='dashboard.php'>Dashboard</a>");
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Send Messages To Agents | Booking Parcel Admin</title>
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
    <!-- Load TinyMCE -->
    <script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>

    <script type="text/javascript">

        $(document).ready(function () {
            //setupDashboardChart('chart1');
            setupLeftMenu();
			setSidebarHeight();

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
(function () {
    var timeLeft = 5,
        cinterval;

    var timeDec = function (){
        timeLeft--;
        document.getElementById('countd').innerHTML = timeLeft;
        if(timeLeft === 0){
            clearInterval(cinterval);
			
        }
    };

    cinterval = setInterval(timeDec, 1000);
})();
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
$error_m="";
date_default_timezone_set('Etc/UTC');
foreach($mails as $email=>$info){
	if(!($email !="" AND $email!=null)){
		unset($mails[$email]);
		continue;
	} 
	
	$mail = new PHPMailer;
	//$mail->IsSMTP();
	
	//Enable SMTP debugging
	// 0 = off (for production use)
	// 1 = client messages
	// 2 = client and server messages
	//$mail->SMTPDebug = 0;
	//Ask for HTML-friendly debug output
	//$mail->Debugoutput = 'html';
	//Set the hostname of the mail server
	$mail->Host = "mail.bookingparcel.com";
	//Set the SMTP port number - likely to be 25, 465 or 587
	//$mail->SMTPSecure = 'ssl';
	$mail->Port = 25;
	$mail->SMTPOptions = array(
		'ssl' => array(
			'verify_peer' => false,
			'verify_peer_name' => false,
			'allow_self_signed' => true
		)
	);
	//Whether to use SMTP authentication
	$mail->SMTPAuth = true;
	//$mail->SMTPAuth = false;
	//Username to use for SMTP authentication
	$mail->Username = "quote1@bookingparcel.com";
	//Password to use for SMTP authentication
	$mail->Password = "02May1964@5017@anitapouya";


	//$mail->From = 'cargo@europostexpress.co.uk';
	//$mail->FromName = 'Cargo EuroPostExpress';
	$mail->setFrom('aircargo@europostexpress.co.uk', 'Cargo EuroPostExpress');
	$mail->addReplyTo('aircargo@europostexpress.co.uk', 'Cargo EuroPostExpress');
	//$mail->AddCC('cargo@epxcargo.co.uk', "BookingParcel(agents)");
	$mail->AddCC('backup1@bookingparcel.com', "BookingParcel(agents)");
	//$mail->addAddress($email, $info['name']);
	$mail->addAddress($email, $info['name']);
	
	$mail->CharSet ="utf-8";
	$mail->isHTML(true);
	$mail->Subject = $subject;
	if(isset($attachments) AND is_array($attachments) AND count($attachments)>0 )
	{
		foreach($attachments as $id => $path)
		{
			if($path!="")
				$mail->addAttachment($path);
		}
	}
	
	$body1 = str_replace("{company_name}", $info['company'], $body, $_c);
	$body1 = str_replace("agent_name", $info['name'], $body1, $_c);
	if(isset($info['country']) AND $info['country']!="" AND $info['country']!=null)
	{
		$body1 = str_replace("{CountryName}", $info['country'], $body1, $_c);
	}
	//$mail->Body = $body1;
	
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
					<td colspan='2' style='padding:5px;'>Message Information</td>
				</tr>
				<tr style='background-color:#fff;text-align:ltr;font-family:tahoma;'>
					<td colspan='2' style='padding:15px 0;'>". ($body1) ."</td>
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
		$mails_er[$email] = $info;
		$error_m .= $info['company'] . " : ".$info['name']. " : ".$email." Sending was not successful.<br>";
		$error_m .= "Mailer Error: " . $mail->ErrorInfo ."<br>";
		unset($mails[$email]);
		//echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
		if($mails[$email]['setparam']=='true')
		{
			$con = mysql_connect(DB_HOST,DB_USER,DB_PASS) or die(mysql_error());
			mysql_select_db(DB_NAME, $con) or die(mysql_error());
			mysql_query("UPDATE `urls` SET `aref`='".$mails[$email]['id']."' WHERE `ref`='".$mails[$email]['ref']."' AND (`aref`='' OR ISNULL(`aref`))");
			
		}
	    //echo "Message sent!";
		unset($mails[$email]);
		
		$error_m .= $info['company'] . " : ".$info['name']. " : ".$email." Sent Successfully<br>";
	}
	
	/*
	$content = $pre1 . $body1 . $pre2;
	$subject = sprintf("=?utf-8?B?" . base64_encode($subject) . "?=");
	$error_m .= $subject."<br>";
	if (mail($email, $subject, $content, $header))
	{
		unset($mails[$email]);
		$error_m .= $info['company'] . " : ".$info['name']. " : ".$email." Sent Successfully<br>";
	}
	else
	{
		$mails_er[$email] = $info;
		$error_m .= $info['company'] . " : ".$info['name']. " : ".$email." Sending was not successful.<br>";
		unset($mails[$email]);
		/*$error = error_get_last();
		$error_m .="Error details :<br>";
		foreach($error as $k=>$v){
			$error_m .= $k ." => ".$v."<br>";
		}
		$error_m .="<br>";
	}
	*/
	break;
}

unlink("mail_address.php");
file_put_contents("mail_address.json",json_encode($mails));
file_put_contents("mail_address_er.json",json_encode($mails_er));
if(count($mails) <= 0){
	$error_m .= "The message has been failed to send to ".count($mails_er).". <br>";
	if(count($mails_er) > 0){
		$error_m .= "Here is the list of failure!<br>";
		foreach($mails_er as $k=>$v)
		{
			$error_m .= $k." : ". $v['company']. " : ". $v['name'] ."<br>";
		}
	}
		
	unlink("mail_address.json");
	unlink("mail_content.php");
	unlink("mail_address_er.json");
} 
else{
	header( "refresh:6;url=sendmail.php" );
$error_m .= "next mail in <span id=\"countd\"></span><br>";
}
$error_m .= "Remaining mails : ".count($mails)."<br>";

if($error_m!=""){
	?>
<div class="grid_10">
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