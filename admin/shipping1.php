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
	$country_iso = array(
		'Afghanistan'=>'AFG',
		'Aland Islands'=>'ALA',
		'Albania'=>'ALB',
		'Algeria'=>'DZA',
		'American Samoa'=>'ASM',
		'Andorra'=>'AND',
		'Angola'=>'AGO',
		'Anguilla'=>'AIA',
		'Antarctica'=>'ATA',
		'Antigua and Barbuda'=>'ATG',
		'Argentina'=>'ARG',
		'Armenia'=>'ARM',
		'Aruba'=>'ABW',
		'Australia'=>'AUS',
		'Austria'=>'AUT',
		'Azerbaijan'=>'AZE',
		'Bahamas'=>'BHS',
		'Bahrain'=>'BHR',
		'Bangladesh'=>'BGD',
		'Barbados'=>'BRB',
		'Belarus'=>'BLR',
		'Belgium'=>'BEL',
		'Belize'=>'BLZ',
		'Benin'=>'BEN',
		'Bermuda'=>'BMU',
		'Bhutan'=>'BTN',
		'Bolivia'=>'BOL',
		'Bonaire, Saint Eustatius and Saba '=>'BES',
		'Bosnia and Herzegovina'=>'BIH',
		'Botswana'=>'BWA',
		'Bouvet Island'=>'BVT',
		'Brazil'=>'BRA',
		'British Indian Ocean Territory'=>'IOT',
		'British Virgin Islands'=>'VGB',
		'Brunei'=>'BRN',
		'Bulgaria'=>'BGR',
		'Burkina Faso'=>'BFA',
		'Burundi'=>'BDI',
		'Cambodia'=>'KHM',
		'Cameroon'=>'CMR',
		'Canada'=>'CAN',
		'Cape Verde'=>'CPV',
		'Cayman Islands'=>'CYM',
		'Central African Republic'=>'CAF',
		'Chad'=>'TCD',
		'Chile'=>'CHL',
		'China'=>'CHN',
		'Christmas Island'=>'CXR',
		'Cocos Islands'=>'CCK',
		'Colombia'=>'COL',
		'Comoros'=>'COM',
		'Cook Islands'=>'COK',
		'Costa Rica'=>'CRI',
		'Croatia'=>'HRV',
		'Cuba'=>'CUB',
		'Curacao'=>'CUW',
		'Cyprus'=>'CYP',
		'Czech Republic'=>'CZE',
		'Democratic Republic of the Congo'=>'COD',
		'Denmark'=>'DNK',
		'Djibouti'=>'DJI',
		'Dominica'=>'DMA',
		'Dominican Republic'=>'DOM',
		'East Timor'=>'TLS',
		'Ecuador'=>'ECU',
		'Egypt'=>'EGY',
		'El Salvador'=>'SLV',
		'Equatorial Guinea'=>'GNQ',
		'Eritrea'=>'ERI',
		'Estonia'=>'EST',
		'Ethiopia'=>'ETH',
		'Falkland Islands'=>'FLK',
		'Faroe Islands'=>'FRO',
		'Fiji'=>'FJI',
		'Finland'=>'FIN',
		'France'=>'FRA',
		'French Guiana'=>'GUF',
		'French Polynesia'=>'PYF',
		'French Southern Territories'=>'ATF',
		'Gabon'=>'GAB',
		'Gambia'=>'GMB',
		'Georgia'=>'GEO',
		'Germany'=>'DEU',
		'Ghana'=>'GHA',
		'Gibraltar'=>'GIB',
		'Greece'=>'GRC',
		'Greenland'=>'GRL',
		'Grenada'=>'GRD',
		'Guadeloupe'=>'GLP',
		'Guam'=>'GUM',
		'Guatemala'=>'GTM',
		'Guernsey'=>'GGY',
		'Guinea'=>'GIN',
		'Guinea-Bissau'=>'GNB',
		'Guyana'=>'GUY',
		'Haiti'=>'HTI',
		'Heard Island and McDonald Islands'=>'HMD',
		'Honduras'=>'HND',
		'Hong Kong'=>'HKG',
		'Hungary'=>'HUN',
		'Iceland'=>'ISL',
		'India'=>'IND',
		'Indonesia'=>'IDN',
		'Iran'=>'IRN',
		'Iraq'=>'IRQ',
		'Ireland'=>'IRL',
		'Isle of Man'=>'IMN',
		'Israel'=>'ISR',
		'Italy'=>'ITA',
		'Ivory Coast'=>'CIV',
		'Jamaica'=>'JAM',
		'Japan'=>'JPN',
		'Jersey'=>'JEY',
		'Jordan'=>'JOR',
		'Kazakhstan'=>'KAZ',
		'Kenya'=>'KEN',
		'Kiribati'=>'KIR',
		'Kosovo'=>'XKX',
		'Kuwait'=>'KWT',
		'Kyrgyzstan'=>'KGZ',
		'Laos'=>'LAO',
		'Latvia'=>'LVA',
		'Lebanon'=>'LBN',
		'Lesotho'=>'LSO',
		'Liberia'=>'LBR',
		'Libya'=>'LBY',
		'Liechtenstein'=>'LIE',
		'Lithuania'=>'LTU',
		'Luxembourg'=>'LUX',
		'Macao'=>'MAC',
		'Macedonia'=>'MKD',
		'Madagascar'=>'MDG',
		'Malawi'=>'MWI',
		'Malaysia'=>'MYS',
		'Maldives'=>'MDV',
		'Mali'=>'MLI',
		'Malta'=>'MLT',
		'Marshall Islands'=>'MHL',
		'Martinique'=>'MTQ',
		'Mauritania'=>'MRT',
		'Mauritius'=>'MUS',
		'Mayotte'=>'MYT',
		'Mexico'=>'MEX',
		'Micronesia'=>'FSM',
		'Moldova'=>'MDA',
		'Monaco'=>'MCO',
		'Mongolia'=>'MNG',
		'Montenegro'=>'MNE',
		'Montserrat'=>'MSR',
		'Morocco'=>'MAR',
		'Mozambique'=>'MOZ',
		'Myanmar'=>'MMR',
		'Namibia'=>'NAM',
		'Nauru'=>'NRU',
		'Nepal'=>'NPL',
		'Netherlands'=>'NLD',
		'New Caledonia'=>'NCL',
		'New Zealand'=>'NZL',
		'Nicaragua'=>'NIC',
		'Niger'=>'NER',
		'Nigeria'=>'NGA',
		'Niue'=>'NIU',
		'Norfolk Island'=>'NFK',
		'North Korea'=>'PRK',
		'Northern Mariana Islands'=>'MNP',
		'Norway'=>'NOR',
		'Oman'=>'OMN',
		'Pakistan'=>'PAK',
		'Palau'=>'PLW',
		'Palestinian Territory'=>'PSE',
		'Panama'=>'PAN',
		'Papua New Guinea'=>'PNG',
		'Paraguay'=>'PRY',
		'Peru'=>'PER',
		'Philippines'=>'PHL',
		'Pitcairn'=>'PCN',
		'Poland'=>'POL',
		'Portugal'=>'PRT',
		'Puerto Rico'=>'PRI',
		'Qatar'=>'QAT',
		'Republic of the Congo'=>'COG',
		'Reunion'=>'REU',
		'Romania'=>'ROU',
		'Russia'=>'RUS',
		'Rwanda'=>'RWA',
		'Saint Barthelemy'=>'BLM',
		'Saint Helena'=>'SHN',
		'Saint Kitts and Nevis'=>'KNA',
		'Saint Lucia'=>'LCA',
		'Saint Martin'=>'MAF',
		'Saint Pierre and Miquelon'=>'SPM',
		'Saint Vincent and the Grenadines'=>'VCT',
		'Samoa'=>'WSM',
		'San Marino'=>'SMR',
		'Sao Tome and Principe'=>'STP',
		'Saudi Arabia'=>'SAU',
		'Senegal'=>'SEN',
		'Serbia'=>'SRB',
		'Seychelles'=>'SYC',
		'Sierra Leone'=>'SLE',
		'Singapore'=>'SGP',
		'Sint Maarten'=>'SXM',
		'Slovakia'=>'SVK',
		'Slovenia'=>'SVN',
		'Solomon Islands'=>'SLB',
		'Somalia'=>'SOM',
		'South Africa'=>'ZAF',
		'South Georgia and the South Sandwich Islands'=>'SGS',
		'South Korea'=>'KOR',
		'South Sudan'=>'SSD',
		'Spain'=>'ESP',
		'Sri Lanka'=>'LKA',
		'Sudan'=>'SDN',
		'Suriname'=>'SUR',
		'Svalbard and Jan Mayen'=>'SJM',
		'Swaziland'=>'SWZ',
		'Sweden'=>'SWE',
		'Switzerland'=>'CHE',
		'Syria'=>'SYR',
		'Taiwan'=>'TWN',
		'Tajikistan'=>'TJK',
		'Tanzania'=>'TZA',
		'Thailand'=>'THA',
		'Togo'=>'TGO',
		'Tokelau'=>'TKL',
		'Tonga'=>'TON',
		'Trinidad and Tobago'=>'TTO',
		'Tunisia'=>'TUN',
		'Turkey'=>'TUR',
		'Turkmenistan'=>'TKM',
		'Turks and Caicos Islands'=>'TCA',
		'Tuvalu'=>'TUV',
		'U.S. Virgin Islands'=>'VIR',
		'Uganda'=>'UGA',
		'Ukraine'=>'UKR',
		'United Arab Emirates'=>'ARE',
		'United Kingdom'=>'GBR',
		'United States'=>'USA',
		'United States Minor Outlying Islands'=>'UMI',
		'Uruguay'=>'URY',
		'Uzbekistan'=>'UZB',
		'Vanuatu'=>'VUT',
		'Vatican'=>'VAT',
		'Venezuela'=>'VEN',
		'Vietnam'=>'VNM',
		'Wallis and Futuna'=>'WLF',
		'Western Sahara'=>'ESH',
		'Yemen'=>'YEM',
		'Zambia'=>'ZMB',
		'Zimbabwe'=>'ZWE',
		'Test Country'=>'TSTC'
	);
	
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
$index = 0;
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

//echo "SELECT * FROM `ship_info` WHERE `ref`=".$id."<br>";
$res = mysql_query("SELECT * FROM `ship_info` WHERE `ref`=".$id."");
//var_dump($res);
if(mysql_num_rows($res)>0)
{
	$row2 = mysql_fetch_array($res);
}
else
{
	$row2 = array();
}

//var_dump($row2);
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

if(isset($_POST['t']) AND $_POST['t']=='send')
{
	if(isset($_POST['submit']) AND $_POST['submit']=='send')
	{
		$error = true;
		$index = 1;
		
		$__Message = 'To: '.$_POST['senderc'].'<br>Dear '.$_POST['senderp'].'<br><br>

We inform you that we have received an order from our agent '.$_POST['agent'].' for collection with following information for deliver to '. $row['to'].' with Ref .: '. $row['tid'].' :<br>
Order: '. $row['tid'].'<br>
Company: '. $_POST['sendercc'].'<br>
Contact Person Name: '. $_POST['senderpp'].'<br>
Address for Collection: '. $_POST['sendera'].' <br><br>

Receiver (Delivery) Information<br>
Company: '. $_POST['receiverc'].' <br>
Contact Person Name: '. $_POST['receiverp'].'<br>
Telephone: '. $_POST['receivert'].'<br>
Country: '. $_POST['receivercou'].'<br>
Address: '. $_POST['receivera'].'  
<br><br>
Could you please provide us following information?
<br><br>
- Collection and order reference number for arranging pickup this order<br>
- Did you released cargo by own customs clearance yet. If yes please
  Provide us released export documents. If not, when you can provide us?
<br><br>
-Do you obtained export license if yes send us a copy of it. 
<br><br>
- Please provide us a copy of Invoice and packing list of this cargo.
<br><br>
- Please provide us Your VAT Number
<br><br>
- Date that this cargo ready for collection and your office opening hours.
<br><br>
- Full address for collection this cargo.
<br><br>
- Contact person in charge in collection point along with phone number.
<br><br>
- Also please confirm that total weight for this cargo will be only '.$row['total_weight'].' KG <br>
- With dim.:(cm)<br>'.str_replace(" | ","\n<br>",$row['dims']).'
<br>
<br>
<span style="color:red;font-weight:bold;">Important Legal Notes</span>: <br>

All of the rights in this order belong to Europost Express (UK) Ltd. The shipper '. $_POST['sendercc'].' ,and the Europost Express (UK) ltd agent '. $_POST['agent2'].' are not allowed to directly communicate and do business (such as current or new further orders) with one another without the full knowledge and consent of Europost Express (UK) Ltd. In the case of breach of this agreement, Europost Express (UK) Ltd may make a formal complaint to The Courts of The United Kingdom or any other relevant country and may claim compensation. By continuing with this order, the shipper and The Europost Express (UK) Ltd agent hereby agree to these terms and conditions. 
<br><br>
Regards<br><br>
Fazel Zohrabpour
<br><br>
<div style=\'font-size:80%;color:#0033cc;\'>
<img src="https://bookingparcel.com/logo.gif" style="width:215px;height:50px;"><br>
Europost Express (UK) Ltd.<br>
4 Corringham Road,<br>
Wembley - Middlesex<br>
HA9 9QA- London , UK<br>
Tel : +44(0) 7886105417<br>
</div>';
		$subject = "Confirmation need from shipper for order ref. EPX-".$country_iso[$row['from']]."-".$country_iso[$row['to']]."-".$id;
		
		
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
		
		$mail->addAddress($_POST['email'], $_POST['senderc']);
		
		//$mail->AddCC('cargo@epxcargo.co.uk', "BookingParcel(presend)");
		$mail->AddCC('backup1@bookingparcel.com', "BookingParcel(presend)");
		if(!empty($official_agent) AND count($official_agent)>0 AND is_array($official_agent))
		{
			$mail->AddCC($official_agent['master_email'], $official_agent['oname']);
			$mail->addReplyTo($official_agent['master_email'], $official_agent['oname']);
		}
		
		$mail->CharSet ="utf-8";
		$mail->isHTML(true);
		$mail->Subject = $subject;
		$mail->Body = $__Message;
		if (!$mail->send()) {
			$error_m .= "Sending was not successful.<br>";
			$error_m .= "Mailer Error: " . $mail->ErrorInfo ."<br>";
		} else {
			//mysql_query("INSERT INTO `sent_mails` (`ref`, `body`, `attachment`, `timestamp`) VALUES (". $_GET['id'] .", '".addslashes($mail->Body)."', '".$q_att."', ".time().");") or die(mysql_error());
			$error_m .= "Sent Successfully<br>";
			$error = false;
		}
		
	}
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
if($index==0)
{
?>
        <div class="grid_12">
            <div class="box round first">
                <h2>Shippment Instruction</h2>
                <div class="block">
					<form action="shipping1.php?id=<?php echo $id; ?>" method="post">
<?php
echo "Item ID : ".$id."<br>";
echo "Tracking ID : ".$row['tid']."<br>";

?>
Email : <input type="text" name="email" value="<?php echo $row2['semail']; ?>"> (Note: only one email is allowed!)<br><br><br><hr>
<input type="hidden" name="t" value="send">
To: <input type="text" name="senderc" value="<?php echo $row2['scompany']; ?>"><br>
Dear <input type="text" name="senderp" value="<?php echo $row2['scontactp']; ?>"> <br><br>

We inform you that we have received an order from our agent <input type="text" name="agent" value="<?php echo $agent['cname']; ?>"> for collection with following information for deliver to <?php echo $row['to']; ?> with Ref .: <?php echo $row['tid']; ?> :<br>
Order: <?php echo $row['tid']; ?><br>
Company: <input type="text" name="sendercc" value="<?php echo $row2['scompany']; ?>"><br>
Contact Person Name: <input type="text" name="senderpp" value="<?php echo $row2['scontactp']; ?>"> <br>
Address for Collection: <input type="text" name="sendera" value="<?php echo $row2['saddress']; ?>"> <br><br>

Receiver (Delivery) Information<br>
Company: <input type="text" name="receiverc" value="<?php echo $row2['rcompany']; ?>"> <br>
Contact Person Name: <input type="text" name="receiverp" value="<?php echo $row2['rcontactp']; ?>">  <br>
Telephone: <input type="text" name="receivert" value="<?php echo $row2['rtelephone']; ?>">   <br>
Country: <input type="text" name="receivercou" value="<?php echo $row2['rcountry']; ?>">   <br>
Address: <input type="text" name="receivera" value="<?php echo $row2['raddress']; ?>">  
<br><br>
Could you please provide us following information?
<br><br>
- Collection and order reference number for arranging pickup this order<br>
- Did you released cargo by own customs clearance yet. If yes please
  Provide us released export documents. If not, when you can provide us?
<br><br>
-Do you obtained export license if yes send us a copy of it. 
<br><br>
- Please provide us a copy of Invoice and packing list of this cargo.
<br><br>
- Please provide us Your VAT Number
<br><br>
- Date that this cargo ready for collection and your office opening hours.
<br><br>
- Full address for collection this cargo.
<br><br>
- Contact person in charge in collection point along with phone number.
<br><br>
- Also please confirm that total weight for this cargo will be only <?php echo $row['total_weight']; ?> KG <br>
- With dim.:(cm)<br><?php echo str_replace(" | ","\n<br>",$row['dims']); ?> 
<br>
<br>
<span style="color:red;font-weight:bold;">Important Legal Notes</span>: <br>

All of the rights in this order belong to Europost Express (UK) Ltd. The shipper <input type="text" name="sendercc" value="<?php echo $row2['scompany']; ?>"> ,and the Europost Express (UK) ltd agent <input type="text" name="agent2" value="<?php echo $agent['cname']; ?>"> are not allowed to directly communicate and do business (such as current or new further orders) with one another without the full knowledge and consent of Europost Express (UK) Ltd. In the case of breach of this agreement, Europost Express (UK) Ltd may make a formal complaint to The Courts of The United Kingdom or any other relevant country and may claim compensation. By continuing with this order, the shipper and The Europost Express (UK) Ltd agent hereby agree to these terms and conditions. 
<br><br>
Regards<br><br>
Fazel Zohrabpour
<br><br>
<div style='font-size:80%;color:#0033cc;'>
<img src="https://bookingparcel.com/logo.gif" style="width:215px;height:50px;"><br>
Europost Express (UK) Ltd.<br>
4 Corringham Road,<br>
Wembley - Middlesex<br>
HA9 9QA- London , UK<br>
Tel : +44(0) 7886105417<br>
</div>
	<br>
	<div style="text-align:center;"><button class="btn" name="submit" value="send" type="submit">Send To Agent</button></div>
</form>
                </div>
            </div>
        </div>
<?php
}
elseif($index==1){ 

?>
        <div class="grid_12">
            <div class="box round first">
                <h2>Shippment Instruction</h2>
                <div class="block">
					<button type="button" name="print" class="btn btn-green" onclick="printContent('print')">Print the bellow E-mail Content</button><br>
					<div id='print'>
						Subject : <?php echo $subject;?> <br>
						E-mail Body : <br><?php echo $__Message;?> <br>
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