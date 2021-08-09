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
		/*
		$_POST['agent']
		$_POST['scompany']
		$_POST['saddress']
		$_POST['szipcode']
		$_POST['scountry']
		$_POST['scontactp']
		
		*/
		$__Message = 'Dear '.$_POST['agent'].',<br><br>This order (Ref. '.$row['tid'].') Confirmed by <span style="font-weight:bold;color:#ff0000;">'.$airline.'</span>. Please arrange collection as following instruction and update us <b>ASAP</b>:<br>
		<span style="color:#ff0000;font-weight:bold;">Very Important Note:<br>
		Please make sure and write in Manifest  following information for this cargo as well:<br>
		Full address of sender and receiver<br>
		Full description of goods<br>
		Weight and value<br>
		HS code /Codes</span>
		<br>
		<br>
		<table style="border-collapse: collapse; width: 566pt" border="0" cellpadding="0" cellspacing="0" width="754">
			<tbody>
				<tr style="height:27.6pt" height="36">
					<td colspan="3" style="height: 27.6pt;; width: 470pt" height="36" align="left" width="626">Sender (Collection) Information <font color="#ff0000">( Also for HAWB)</font><br></td>
				</tr>
				<tr style="height: 20.1pt" height="26">
					<td  style="height: 20.1pt" height="26" align="left"><span style="">&nbsp;</span>Company Name</td>
					<td >&nbsp;</td>
					<td  align="left">'.$_POST['scompany'].'</td>
				</tr>
				<tr style="height: 20.1pt" height="26">
					<td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Address</td>
					<td  style="border-top: none">&nbsp;</td>
					<td  align="left">'.nl2br($_POST['saddress']).'</td>
				</tr>
				<tr style="height: 20.1pt" height="26">
					<td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Zip Code</td>
					<td  style="border-top: none">&nbsp;</td>
					<td >'.$_POST['szipcode'].'</td>
				</tr>
				<tr style="height: 20.1pt" height="26">
					<td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Country</td>
					<td  style="border-top: none">&nbsp;</td>
					<td  align="left">'.$_POST['scountry'].'</td>
				</tr>
				<tr style="height: 20.1pt" height="26">
					<td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Contact Person</td>
					<td  style="border-top: none">&nbsp;</td>
					<td  align="left">'.$_POST['scontactp'].'</td>
				</tr>
				<tr style="height: 20.1pt" height="26">
					<td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Telephone</td>
					<td  style="border-top: none">&nbsp;</td>
					<td  align="left">'.$_POST['stelephone'].'</td>
				</tr>
				<tr style="height: 20.1pt" height="26">
					<td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>E-mail</td>
					<td  style="border-top: none">&nbsp;</td>
					<td align="left">'.$_POST['semail'].'</td>
				</tr>
				<tr style="height: 27.6pt" height="36">
					<td  colspan="3" style="height: 27.6pt;" height="36" align="left">Receiver (Delivery) Information <font color="#ff0000">( Also for HAWB)</font></td>
				</tr>
				
				<tr style="height: 20.1pt" height="26">
					<td  style="height: 20.1pt" height="26" align="left"><span style="">&nbsp;</span>Company Name</td>
					<td >&nbsp;</td>
					<td  align="left">'.$_POST['rcompany'].'</td>
				</tr>
				<tr style="height: 20.1pt" height="26">
					<td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Address</td>
					<td  style="border-top: none">&nbsp;</td>
					<td  align="left">'.nl2br($_POST['raddress']).'</td>
				</tr>
				<tr style="height: 20.1pt" height="26">
					<td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Zip Code</td>
					<td  style="border-top: none">&nbsp;</td>
					<td >'.$_POST['rpostcode'].'</td>
				</tr>
				<tr style="height: 20.1pt" height="26">
					<td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Country</td>
					<td  style="border-top: none">&nbsp;</td>
					<td  align="left">'.$_POST['rcountry'].'</td>
				</tr>
				<tr style="height: 20.1pt" height="26">
					<td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Contact Person</td>
					<td  style="border-top: none">&nbsp;</td>
					<td  align="left">'.$_POST['rcontactp'].'</td>
				</tr>
				<tr style="height: 20.1pt" height="26">
					<td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Telephone</td>
					<td  style="border-top: none">&nbsp;</td>
					<td  align="left">'.$_POST['rtelephone'].'</td>
				</tr>
				<tr style="height: 20.1pt" height="26">
					<td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>E-mail</td>
					<td  style="border-top: none">&nbsp;</td>
					<td align="left">'.$_POST['remail'].'</td>
				</tr>
			  
				<tr style="height: 27.6pt" height="36">
					<td colspan="2" style="height: 27.6pt;" height="36">Shipment Information</td>
					<td>&nbsp;</td>
				</tr>
				<tr style="height: 20.1pt" height="26">
					<td  style="height: 20.1pt" height="26" align="left"><span style="">&nbsp;</span>Contents</td>
					<td >&nbsp;</td>
					<td align="left">'.nl2br($_POST['contents']).'</td>
				</tr>
				<tr style="height: 20.1pt" height="26">
					<td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Document Info./No.</td>
					<td  style="border-top: none">&nbsp;</td>
					<td >'.$_POST['docinfo'].'</td>
				</tr>
				<tr style="height: 20.1pt" height="26">
					<td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Gross Weight (kg)</td>
					<td  style="border-top: none">&nbsp;</td>
					<td >'.$_POST['total_weight'].'</td>
				</tr>
				<tr style="height: 20.1pt" height="26">
					<td class="xl75" style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Dimensions (cm)</td>
					<td class="xl76" style="border-top: none">&nbsp;</td>
					<td align="left">'.nl2br($_POST['rpostcode']).'</td>
				</tr>
			</tbody>
		</table>
	<br>
	Please note, use above information for Collection and instruction  for HAWB.<br>
	and following information for MAWB;<br><br>
	Shipper:<br>
	Europost Express (UK) Ltd.<br>
	4 Corringham Road,<br>
	Wembley - Middlesex<br>
	HA9 9QA- London , UK<br>
	Tel : +44(0) 7886105417<br>
	<br>
	And Consignee in MAWB will be:<br>
	'.nl2br($_POST['consignee']).'
	<br><br>
	Please confirm that you have received this confirmation order.<br><br>
	Best Regards<br>
	Fazel Zohrabpour<br><br>
	<div style=\'font-size:80%;color:#0033cc;\'>
	<img src="https://bookingparcel.com/logo.gif" style="width:215px;height:50px;"><br>
	Europost Express (UK) Ltd.<br>
	4 Corringham Road,<br>
	Wembley - Middlesex<br>
	HA9 9QA- London , UK<br>
	Tel : +44(0) 7886105417<br>
	</div>';
		$subject = "Shipment instruction for quote ref. EPX-".$country_iso[$row['from']]."-".$country_iso[$row['to']]."-".$id;
		if(isset($_POST['agent_email']) AND trim($_POST['agent_email'])!='' AND $_POST['agent_email']!='')
		{
			if(isset($_POST['agent_name']) AND trim($_POST['agent_name'])!='' AND $_POST['agent_name']!='')
			{
				//if(isset($_POST['agent_id']) AND trim($_POST['agent_id'])!='' AND $_POST['agent_id']!='')
				//{
				//	if(isset($_POST['agent_company']) AND trim($_POST['agent_company'])!='' AND $_POST['agent_company']!='')
				//	{
						
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
						$mail->addAddress($_POST['agent_email'], $row2['agent_name']);
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
							$error_m .= "". $row2['fname'] ." ". $row2['lname'] ." : ".$_POST['email']." Sending was not successful.<br>";
							$error_m .= "Mailer Error: " . $mail->ErrorInfo ."<br>";
						} else {
							//mysql_query("INSERT INTO `sent_mails` (`ref`, `body`, `attachment`, `timestamp`) VALUES (". $_GET['id'] .", '".addslashes($mail->Body)."', '".$q_att."', ".time().");") or die(mysql_error());
							$error_m .= "". $row2['fname'] ." ". $row2['lname'] ." : ".$_POST['email']." Sent Successfully<br>";
							$error = false;
						}
						
				//	}
				//}
			}
		}
	}
	elseif(isset($_POST['submit']) AND $_POST['submit']=='save')
	{
		/*
		$_POST['agent']
		$_POST['scompany']
		$_POST['saddress']
		$_POST['szipcode']
		$_POST['scountry']
		$_POST['scontactp']
		$_POST['stelephone']
		$_POST['semail']
		$_POST['rcompany']
		$_POST['raddress']
		$_POST['rpostcode']
		$_POST['rcountry']
		$_POST['rcontactp']
		$_POST['rtelephone']
		$_POST['remail']
		$_POST['contents']
		$_POST['docinfo']
		$_POST['total_weight']
		$_POST['consignee']
		
		$_POST['agent_name']
		$_POST['agent_id']
		$_POST['agent_company']
		$_POST['agent_email']
		
		*/
		if(isset($_POST['agent_id']) AND trim($_POST['agent_id'])!='' AND $_POST['agent_id']!='')
		{
			$ressq = mysql_query("SELECT * FROM `ship_info` WHERE `ref`=".$id."");
			
			if(mysql_num_rows($ressq)>0){
				mysql_query("UPDATE `ship_info` SET `scompany`='".$_POST['scompany']."', `saddress`='".$_POST['saddress']."', `szipcode`='".$_POST['szipcode']."', `scountry`='".$_POST['scountry']."', `scontactp`='".$_POST['scontactp']."', `stelephone`='".$_POST['stelephone']."', `semail`='".$_POST['semail']."' WHERE `ref`='".$id."'");
				mysql_query("UPDATE `ship_info` SET `rcompany`='".$_POST['rcompany']."', `raddress`='".$_POST['raddress']."', `rpostcode`='".$_POST['rpostcode']."', `rcountry`='".$_POST['rcountry']."', `rcontactp`='".$_POST['rcontactp']."', `rtelephone`='".$_POST['rtelephone']."', `remail`='".$_POST['remail']."' WHERE `ref`='".$id."'");
				mysql_query("UPDATE `ship_info` SET `col_ref`='".$_POST['col_ref']."' WHERE `ref`='".$id."'");
			}
			else{
				//echo "INSERT INTO `ship_info`(`ref`, `scompany`, `saddress`, `szipcode`, `scountry`, `scontactp`, `stelephone`, `semail`, `rcompany`, `raddress`, `rpostcode`, `rcountry`, `rtelephone`, `rcontactp`, `remail`) VALUES ('".$id."', '".$_POST['scompany']."', '".$_POST['saddress']."', '".$_POST['szipcode']."', '".$_POST['scountry']."', '".$_POST['scontactp']."', '".$_POST['stelephone']."', '".$_POST['semail']."', '".$_POST['rcompany']."', '".$_POST['rpostcode']."', '".$_POST['rcountry']."', '".$_POST['rtelephone']."', '".$_POST['rcontactp']."', '".$_POST['remail']."');<br>";
				mysql_query("INSERT INTO `ship_info`(`ref`, `scompany`, `saddress`, `szipcode`, `scountry`, `scontactp`, `stelephone`, `semail`, `rcompany`, `raddress`, `rpostcode`, `rcountry`, `rtelephone`, `rcontactp`, `remail`, `col_ref`) VALUES ('".$id."', '".$_POST['scompany']."', '".$_POST['saddress']."', '".$_POST['szipcode']."', '".$_POST['scountry']."', '".$_POST['scontactp']."', '".$_POST['stelephone']."', '".$_POST['semail']."', '".$_POST['rcompany']."', '".$_POST['raddress']."', '".$_POST['rpostcode']."', '".$_POST['rcountry']."', '".$_POST['rtelephone']."', '".$_POST['rcontactp']."', '".$_POST['remail']."', '".$_POST['col_ref']."');");
			}
			$resaq = mysql_query("SELECT * FROM `urls` WHERE `ref`=".$id."");
			if(mysql_num_rows($resaq)>0)
			{
				mysql_query("update `urls` set `aref`='".$_POST['agent_id']."' WHERE `ref`=".$id."");
			}
			else{
				mysql_query("INSERT INTO `urls` (`ref`, `aref`) values ('".$id."', '".$_POST['agent_id']."');");
			}
			header('Location: shipping.php?id='.$id);
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
if($index==0)
{
?>
        <div class="grid_12">
            <div class="box round first">
                <h2>Shippment Instruction</h2>
                <div class="block">
					<form action="shipping.php?id=<?php echo $id; ?>" method="post">
<?php
echo "Item ID : ".$id."<br>";
echo "Tracking ID : ".$row['tid']."<br><hr>";
if(isset($agent) AND $agent!=null AND is_array($agent))
{
	//var_dump($agent['emails']);echo "<br>";
	$emails = explode("\n", $agent['emails']);
//	var_dump($emails);echo "<br>";
	//$email = array_pop($emails);
	//var_dump($email);echo "<br>";
	echo "Agent ID : <input name='agent_id' type='text' value='".$agent['id']."'><br>";
	echo "Agent Email : <input name='agent_email' type='text' value='".$emails[0]."'><br>";
	echo "Agent Name : <input name='agent_name' type='text' value='".$agent['fname']."'><br>";
	echo "Agent Company : <input name='agent_company' type='text' value='".$agent['cname']."'><br><hr>";
}
else
{
	echo "<span style='color:#ff0000;'>Note</span> : No Agent is connected to this quote please fill the bellow inputs.<br>";
	echo "Agent ID : <input name='agent_id' type='text' value=''><br>";
	echo "Agent Email : <input name='agent_email' type='text' value=''><br>";
	echo "Agent Name : <input name='agent_name' type='text' value=''><br>";
	echo "Agent Company : <input name='agent_company' type='text' value=''><br><hr>";
}
?>
Collection Ref. : <input type="text" name="col_ref" value="<?php echo $row2['col_ref']; ?>">
<hr>
<input type="hidden" name="t" value="send">

	Dear <input type="text" name="agent" value="<?php echo $agent['fname']; ?>">,<br><br>
	This order (Ref. <?php echo $row['tid']; ?>) Confirmed by <span style="font-weight:bold;color:#ff0000;"><?php echo $airline; ?></span>. Please arrange collection as following instruction and update us <b>ASAP</b>:<br>
	<span style="color:#ff0000;font-weight:bold;">Very Important Note:<br>
	Please make sure and write in Manifest  following information for this cargo as well:<br>
	Full address of sender and receiver<br>
	Full description of goods<br>
	Weight and value<br>
	HS code /Codes</span>
	<br>
	<br>
	<table style="border-collapse: collapse; width: 566pt" border="0" cellpadding="0" cellspacing="0" width="754">
		<tbody>
			<tr style="height:27.6pt" height="36">
				<td colspan="3" style="height: 27.6pt;; width: 470pt" height="36" align="left" width="626">Sender (Collection) Information <font color="#ff0000">( Also for HAWB)</font><br></td>
			</tr>
			<tr style="height: 20.1pt" height="26">
				<td  style="height: 20.1pt" height="26" align="left"><span style="">&nbsp;</span>Company Name</td>
				<td >&nbsp;</td>
				<td  align="left"><input name="scompany" type="text" value="<?php echo $row2['scompany']; ?>"></td>
			</tr>
			<tr style="height: 20.1pt" height="26">
				<td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Address</td>
				<td  style="border-top: none">&nbsp;</td>
				<td  align="left"><textarea name="saddress" style="margin: 0px; width: 339px; height: 150px;"><?php echo $row2['saddress']; ?></textarea></td>
			</tr>
			<tr style="height: 20.1pt" height="26">
				<td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Zip Code</td>
				<td  style="border-top: none">&nbsp;</td>
				<td ><input name="szipcode" type="text" value="<?php echo $row2['szipcode']; ?>"></td>
			</tr>
			<tr style="height: 20.1pt" height="26">
				<td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Country</td>
				<td  style="border-top: none">&nbsp;</td>
				<td  align="left"><input name="scountry" type="text" value="<?php echo $row['from']; ?>"></td>
			</tr>
			<tr style="height: 20.1pt" height="26">
				<td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Contact Person</td>
				<td  style="border-top: none">&nbsp;</td>
				<td  align="left"><input name="scontactp" type="text" value="<?php echo $row2['scontactp']; ?>"></td>
			</tr>
			<tr style="height: 20.1pt" height="26">
				<td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Telephone</td>
				<td  style="border-top: none">&nbsp;</td>
				<td  align="left"><input name="stelephone" type="text" value="<?php echo $row2['stelephone']; ?>"></td>
			</tr>
			<tr style="height: 20.1pt" height="26">
				<td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>E-mail</td>
				<td  style="border-top: none">&nbsp;</td>
				<td align="left"><input name="semail" type="text" value="<?php echo $row2['semail']; ?>"></td>
			</tr>
			<tr style="height: 27.6pt" height="36">
				<td  colspan="3" style="height: 27.6pt;" height="36" align="left">Receiver (Delivery) Information <font color="#ff0000">( Also for HAWB)</font></td>
			</tr>
			
			<tr style="height: 20.1pt" height="26">
				<td  style="height: 20.1pt" height="26" align="left"><span style="">&nbsp;</span>Company Name</td>
				<td >&nbsp;</td>
				<td  align="left"><input name="rcompany" type="text" value="<?php echo $row2['rcompany']; ?>"></td>
			</tr>
			<tr style="height: 20.1pt" height="26">
				<td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Address</td>
				<td  style="border-top: none">&nbsp;</td>
				<td  align="left"><textarea name="raddress" style="margin: 0px; width: 339px; height: 150px;"><?php echo $row2['raddress']; ?></textarea></td>
			</tr>
			<tr style="height: 20.1pt" height="26">
				<td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Zip Code</td>
				<td  style="border-top: none">&nbsp;</td>
				<td ><input name="rpostcode" type="text" value="<?php echo $row2['rpostcode']; ?>"></td>
			</tr>
			<tr style="height: 20.1pt" height="26">
				<td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Country</td>
				<td  style="border-top: none">&nbsp;</td>
				<td  align="left"><input name="rcountry" type="text" value="<?php echo $row['to']; ?>"></td>
			</tr>
			<tr style="height: 20.1pt" height="26">
				<td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Contact Person</td>
				<td  style="border-top: none">&nbsp;</td>
				<td  align="left"><input name="rcontactp" type="text" value="<?php echo $row2['rcontactp']; ?>"></td>
			</tr>
			<tr style="height: 20.1pt" height="26">
				<td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Telephone</td>
				<td  style="border-top: none">&nbsp;</td>
				<td  align="left"><input name="rtelephone" type="text" value="<?php echo $row2['rtelephone']; ?>"></td>
			</tr>
			<tr style="height: 20.1pt" height="26">
				<td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>E-mail</td>
				<td  style="border-top: none">&nbsp;</td>
				<td align="left"><input name="remail" type="text" value="<?php echo $row2['remail']; ?>"></td>
			</tr>
		  
			<tr style="height: 27.6pt" height="36">
				<td colspan="2" style="height: 27.6pt;" height="36">Shipment Information</td>
				<td>&nbsp;</td>
			</tr>
			<tr style="height: 20.1pt" height="26">
				<td  style="height: 20.1pt" height="26" align="left"><span style="">&nbsp;</span>Contents</td>
				<td >&nbsp;</td>
				<td align="left"><textarea name="contents" style="margin: 0px; width: 339px; height: 150px;"><?php echo $row['item_desc']; ?></textarea></td>
			</tr>
			<tr style="height: 20.1pt" height="26">
				<td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Document Info./No.</td>
				<td  style="border-top: none">&nbsp;</td>
				<td ><input name="docinfo" type="text" value=""></td>
			</tr>
			<tr style="height: 20.1pt" height="26">
				<td  style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Gross Weight (kg)</td>
				<td  style="border-top: none">&nbsp;</td>
				<td ><input name="total_weight" type="text" value="<?php echo $row['total_weight'];?>"></td>
			</tr>
			<tr style="height: 20.1pt" height="26">
				<td class="xl75" style="height: 20.1pt; border-top: none" height="26" align="left"><span style="">&nbsp;</span>Dimensions (cm)</td>
				<td class="xl76" style="border-top: none">&nbsp;</td>
				<td align="left"><textarea name="dims" style="margin: 0px; width: 339px; height: 150px;"><?php echo str_replace(" | ","\n",$row['dims']); ?></textarea></td>
			</tr>
		</tbody>
	</table>
<br>
Please note, use above information for Collection and instruction  for HAWB.<br>
and following information for MAWB;<br><br>
Shipper:<br>
Europost Express (UK) Ltd.<br>
4 Corringham Road,<br>
Wembley - Middlesex<br>
HA9 9QA- London , UK<br>
Tel : +44(0) 7886105417<br>
<br>
And Consignee in MAWB will be:<br>
<textarea name="consignee" style="margin: 0px; width: 339px; height: 150px;"><?php if($user_info!=null and is_array($user_info)){ echo $user_info['company'] ."\n".$user_info['address']."\nTel : ".$user_info['phone'];} ?></textarea>
<br><br>
Please confirm that you have received this confirmation order.<br><br>
Best Regards<br>
Fazel Zohrabpour<br><br>
<div style='font-size:80%;color:#0033cc;'>
<img src="https://bookingparcel.com/logo.gif" style="width:215px;height:50px;"><br>
Europost Express (UK) Ltd.<br>
4 Corringham Road,<br>
Wembley - Middlesex<br>
HA9 9QA- London , UK<br>
Tel : +44(0) 7886105417<br>
</div>
	<br>
	<div style="text-align:center;"><button class="btn" name="submit" value="send" type="submit">Send To Agent</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn" name="submit" value="save" type="submit">Save</button></div>
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