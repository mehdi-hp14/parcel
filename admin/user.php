<?php
require_once "php8support.php";

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
	header("Location: tickets.php");
	exit;
}
else{
	$id = intval($_GET['id']);
}
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
    <title>Users Management | Booking Parcel Admin</title>
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
	
function ConfirmFunc(a,b) {
	var r = confirm("You are about to delete '"+b+"' order.\nNote: this operation is not reversible.\n Are you sure?");
	if (r == true) {
		window.location.href = "?id=<?php echo $id; ?>&del="+a;
		x = "You pressed OK!";
	} else {
		//x = "You pressed Cancel!";
	}
}
	
function ConfirmFunc2(a) {
	var r = confirm("You are about to delete transaction '"+a+"'.\nNote: this operation is not reversible.\n Are you sure?");
	if (r == true) {
		window.location.href = "?id=<?php echo $id; ?>&index=1&del="+a;
		x = "You pressed OK!";
	} else {
		//x = "You pressed Cancel!";
	}
}


$(function() {
	var scntDiv = $('#transactions');
	var i = $('#transactions p').size() + 1;
	
	$('#addScnt').live('click', function() {
		$('<p><input type="text" id="transaction" size="20" name="amount[]" value="" placeholder="Money"><select name="currency[]"><option value="GBP">GBP</option><option value="USD">USD</option><option value="EUR" selected="selected">EUR</option><option value="IRR">IRR</option></select><select name="type[]"><option value="0">Paid For Quote</option><option value="1">Increasing The Deposit</option><option value="2">Refund</option><option value="3">Difference</option></select><input type="text" id="qid" size="7" name="qid[]" value="0" placeholder="Quote ID"><input type="text" id="desc" size="10" name="description[]" value="" placeholder="Description"><input type="text" id="datetime" size="15" name="datetime[]" value="<?php echo date("Y/m/d H:i:s",time()); ?>" placeholder="Description"><a href="#" id="addScnt"><img src="../post_forms/images/icons/fam/add.png"></a><a href="#" id="remScnt"><img src="../post_forms/images/icons/fam/delete.png"></a></p>').appendTo(scntDiv);
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
	
	
	var scntDiv_refund = $('#transactions_refund');
	var i = $('#transactions_refund p').size() + 1;
	
	$('#addScnt_refund').live('click', function() {
		$('<p><input type="text" id="transaction" size="20" name="amount_refund[]" value="" placeholder="Money"><select name="currency_refund[]"><option value="GBP">GBP</option><option value="USD">USD</option><option value="EUR" selected="selected">EUR</option><option value="IRR">IRR</option></select><input type="text" id="qid" size="7" name="qid_refund[]" value="0" placeholder="Quote ID"><input type="text" id="desc" size="10" name="description_refund[]" value="" placeholder="Description"><input type="text" id="datetime" size="15" name="datetime_refund[]" value="<?php echo date("Y/m/d H:i:s",time()); ?>" placeholder="Description"><a href="#" id="addScnt_refund"><img src="../post_forms/images/icons/fam/add.png"></a><a href="#" id="remScnt_refund"><img src="../post_forms/images/icons/fam/delete.png"></a></p>').appendTo(scntDiv_refund);
		i++;
		return false;
	});
	
	$('#remScnt_refund').live('click', function() { 
		if( i > 2 ) {
				$(this).parents('p').remove();
				i--;
		}
		return false;
	});
});

function printContent(el){
	var restorepage = document.body.innerHTML;
	var printcontent = document.getElementById(el).innerHTML;
	document.body.innerHTML = printcontent;
	window.print();
	document.body.innerHTML = restorepage;
}
</script>
<link rel="stylesheet" href="./css/chromePrint.css" media="print">
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
                                <li><a href="tickets.php">Support Tickets</a> </li>
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
					
$index=0;
if(isset($_GET['index']) AND $_GET['index']!='' AND is_numeric($_GET['index']) AND $_GET['index']>0)
{
	$index = $_GET['index'];
}	


function PassToHash($pass){
	$options = [
		'cost' => 10,
		//'salt' => $salt
	];
	return password_hash($pass, PASSWORD_BCRYPT, $options);
}
$con = mysql_connect(DB_HOST,DB_USER,DB_PASS) or die(mysql_error());
mysql_select_db(DB_NAME, $con) or die(mysql_error());

$output = "";
$q = "SELECT *, count(*) as counter FROM `users` WHERE `id`=".$id."";
$row = mysql_fetch_assoc(mysql_query($q));
$currency = array('IRR','USD','GBP','EUR');
if($row['counter']==1)
{
	if($index==3)
	{
		
		$q = "SELECT * FROM `users` WHERE `id`='".$id."'";
		$r = mysql_query($q);
		$oamrow = mysql_fetch_array($r);
		if(isset($_POST['cc_name']) AND is_array($_POST['cc_name']) AND $_POST['cc_name']!=null)
		{
			$tmp_arr = $_POST['cc_name'];
			$cc_name = implode("|",$tmp_arr);
			
			mysql_query("UPDATE `users` SET `cblacklist`='".$cc_name."' WHERE `id`=".$id."");
			header("Location: user.php?id=".$id."&index=3");
		}
		?>
		
        <div class="grid_10">
            <div class="box round first">
                <h2>Management Details</h2>
                <div class="block">
					<form method="post" >
					<input name="t" type="hidden" value="official_edit_det">
					<div style="font-family:tahoma;font-size:16px;">
						<label for="country_id">Countries that user is not permitted to put order:</label>
						<?php 
						$___cc = 0;
						$cover_counteries = explode("|",$oamrow['cblacklist']);
						foreach($country_iso as $v=>$k)
						{
							if($___cc%3 == 0) echo '<div style="padding:5px;">';
							echo '<span style="width:33%;display: inline-block;">';
							echo '<input type="checkbox" name="cc_name[]" value="'.$v.'" id="c_id_'.$___cc.'" '.(in_array($v,$cover_counteries) ? 'checked="true"' : '').'>';
							echo '<label for="c_id_'.$___cc.'">'.$v.'</label>';
							echo '</span>';
							if($___cc%3 == 2) echo '</div>';
							$___cc++;
						}
						if($___cc%3 == 1 or $___cc%3 == 2) echo '</div>';
						?>
					</div>
					<button class="btn" name="submit" type="submit" value="save">save</button>
					</form>
				</div>
			</div>
		</div>
		<?php
	}
	elseif($index==2)
	{
		$show = false;
		if(isset($_POST['submit']) AND $_POST['submit']=='Apply')
		{
			$currency = "GBP";
			$Opening_Balance = 0;
			$Payments_in = 0;
			$Payments_out = 0;
			$closing_balance = 0;
			
			
			$from = time() - 2592000;
			$to = time();
			if(isset($_POST['currency']) AND trim($_POST['currency'])!='' AND $_POST['currency']!=null)
			{
				$currency = $_POST['currency'];
			}
			/*if(isset($_POST['begining']) AND trim($_POST['begining'])!='' AND $_POST['begining']!=null)
			{
				$Opening_Balance = $_POST['begining'];
			}*/
			if(isset($_POST['from']) AND trim($_POST['from'])!='' AND $_POST['from']!=null)
			{
				//$tmp = explode(" ", $_POST['from']);
				$tmp1 = explode("/", $_POST['from']);
				//$tmp2 = explode(":", $tmp[1]);
				
				$from = mktime(0, 0, 0, $tmp1[1], $tmp1[2], $tmp1[0]);
			}
			if(isset($_POST['to']) AND trim($_POST['to'])!='' AND $_POST['to']!=null)
			{
				//$tmp = explode(" ", $_POST['to']);
				$tmp1 = explode("/", $_POST['to']);
				//$tmp2 = explode(":", $tmp[1]);
				$to = mktime(23, 59, 59, $tmp1[1], $tmp1[2], $tmp1[0]);
			}
			$qq = "SELECT SUM(`amount`) as sum FROM `transactions` WHERE `uref`=".$id." AND `currency`='".$currency."' AND `timestamp`<".$from." AND (`type`=1 or `type`=2 or `type`=4)";
			$qqq = "SELECT SUM(`amount`) as subtract FROM `transactions` WHERE `uref`=".$id." AND `currency`='".$currency."' AND `timestamp`<".$from." AND (`type`=0 or `type`=3 or `type`=5)";
			/*$qq = "SELECT 
				(SELECT SUM(`amount`) FROM `transactions` WHERE (`type`=1 or `type`=2)) sum,
				(SELECT SUM(`amount`) FROM `transactions` WHERE (`type`=0 or `type`=3)) substract,
				(sum - substract) res
				FROM `transactions` WHERE `uref`=".$id." AND `currency`='".$currency."' AND `timestamp`<".$from."";*/
			//echo $qq."<br>";
			$sum_row = mysql_fetch_array(mysql_query($qq));
			$sub_row = mysql_fetch_array(mysql_query($qqq));
			$Opening_Balance = $sum_row['sum'] - $sub_row['subtract'];
			if($to>=$from)
			{
				$show = true;
				$output="";
				$output .= '<tr class="gradeA even" style="border: none;">
								<td style="border: none;padding:3px;">'.date("d F Y",$from).'</td>
								<td style="border: none;padding:3px;"><b>Balance Brought Forward</b></td>
								<td style="border: none;padding:3px;"></td>
								<td style="border: none;padding:3px;"></td>
								<td style="border: none;padding:3px;">'.number_format($Opening_Balance,2).'</td>
							</tr>';
				$q = "SELECT * FROM `transactions` WHERE `uref`=".$id." AND `timestamp`<=".$to." AND `timestamp`>=".$from." AND `currency`='".$currency."' AND `type` IN (0,1,2,3,4,5) ORDER BY `timestamp` ASC";
				$res = mysql_query($q);
				$_c = 2;
				
				$closing_balance = $Opening_Balance;
				if(mysql_num_rows($res)>0)
				{
					while($trow = mysql_fetch_array($res))
					{//echo $trow['id']."<br>";
						if($trow['oref']>0)
						{
							$orow = mysql_fetch_array(mysql_query("SELECT `total_weight`,`tid`,`id`,`from` FROM `quote` WHERE `id`=".$trow['oref'].""));
						}
						$output .= '<tr class="gradeA '.($_c%2 == 1 ? 'even' : 'odd').'" style="border: none;">
										<td style="border: none;padding:3px;">'.date("d F Y",$trow['timestamp']).'</td>
										<td style="border: none;padding:3px;">';
						switch($trow['type'])
						{
							case 0:
								if($trow['oref']!=0)
									$output .= ''.str_replace("EPX-","",$orow['tid']).', '.$orow['total_weight'].' , '.$orow['from'].'';
								else
									$output .= '<span style="color:#51EBF2;">'.$trow['description'].'</span>';
								$Payments_out += $trow['amount'];
								$closing_balance -= $trow['amount'];
								break;
							case 1:
								$output .= '<span style="color:#BCD7E3;">The deposit has been paid</span>';
								$Payments_in += $trow['amount'];
								$closing_balance += $trow['amount'];
								break;
							case 2:
								$output .= '<span style="color:#F72424;">'.str_replace("EPX-","",$orow['tid']).', '.$orow['total_weight'].' , '.$country_iso[$orow['from']].', Credit Back, '.$trow['description'].'</span>';
								$Payments_in += $trow['amount'];
								$closing_balance += $trow['amount'];
								break;
							case 3:
								$output .= '<span style="color:#51EBF2;">'.str_replace("EPX-","",$orow['tid']).', '.$trow['description'].'</span>';
								$Payments_out += $trow['amount'];
								$closing_balance -= $trow['amount'];
								break;
							case 4:
								$output .= '<span style="color:#99ff66;">'.str_replace("EPX-","",$orow['tid']).', '.$trow['description'].'</span>';
								$Payments_in += $trow['amount'];
								$closing_balance += $trow['amount'];
								break;
							case 5:
								$output .= '<span style="color:#ffcc00;">'.str_replace("EPX-","",$orow['tid']).', '.$trow['description'].'</span>';
								$Payments_out += $trow['amount'];
								$closing_balance -= $trow['amount'];
								break;
						}						
						$output .= '</td>
										<td style="border: none;padding:3px;">'.(($trow['type']==0 OR $trow['type']==3 OR $trow['type']==5) ? number_format($trow['amount'],2) : '').'</td>
										<td style="border: none;padding:3px;">'.(($trow['type']==1 OR $trow['type']==2 OR $trow['type']==4) ? number_format($trow['amount'],2) : '').'</td>
										<td style="border: none;padding:3px;">'.number_format($closing_balance,2).'</td>
									</tr>';
									unset($orow);
						$_c++;
					}
				}
				else
				{
					$output .= "";
				}
				$output .= '<tr class="gradeA even" style="border: none;">
								<td style="border: none;padding:3px;">'.date("d F Y",$to).'</td>
								<td style="border: none;padding:3px;"><b>BALANCE CARRIED FORWARD</b></td>
								<td style="border: none;padding:3px;"></td>
								<td style="border: none;padding:3px;"></td>
								<td style="border: none;padding:3px;">'.number_format($closing_balance,2).'</td>
							</tr>';
			}
		}
		?>
		


<style>

.clear
{
clear: both;
}


table {
	border-collapse: collapse;
	border-width: 0px;
	max-width: 100%;
	background-color: transparent
}
th {
	text-align: left
}
.table {
	width: 100%;
	margin-bottom: 20px
	
}
.table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {
	padding: 8px;
	line-height: 1.42857143;
	vertical-align: top;
	border-top: 1px solid #ddd
}
.table>thead>tr>th {
	vertical-align: bottom;
	border-bottom: 2px solid #ddd
}
.table>caption+thead>tr:first-child>th, .table>colgroup+thead>tr:first-child>th, .table>thead:first-child>tr:first-child>th, .table>caption+thead>tr:first-child>td, .table>colgroup+thead>tr:first-child>td, .table>thead:first-child>tr:first-child>td {
	border-top: 0
}
.table>tbody+tbody {
	border-top: 2px solid #ddd
}
.table .table {
	background-color: #fff
}
.table-condensed>thead>tr>th, .table-condensed>tbody>tr>th, .table-condensed>tfoot>tr>th, .table-condensed>thead>tr>td, .table-condensed>tbody>tr>td, .table-condensed>tfoot>tr>td {
	padding: 5px
}
.table-bordered {
	border: 1px solid #ddd
}
.table-bordered>thead>tr>th, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>tbody>tr>td, .table-bordered>tfoot>tr>td {
	border: 1px solid #ddd
}
.table-bordered>thead>tr>th, .table-bordered>thead>tr>td {
	border-bottom-width: 2px
}
.table-striped>tbody>tr:nth-child(odd)>td, .table-striped>tbody>tr:nth-child(odd)>th {
	background-color: #ffcccc
}
.table-hover>tbody>tr:hover>td, .table-hover>tbody>tr:hover>th {
	background-color: #f5f5f5
}
@media print {

.clear
{
clear: both;
	!important;
}


table {
	border-collapse: collapse;
	border-width: 0px;
	max-width: 100%;
	background-color: transparent;
	!important;
}
th {
	text-align: left;
	!important;
}
.table {
	width: 100%;
	margin-bottom: 20px;
	!important;
	
}
.table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {
	padding: 8px;
	line-height: 1.42857143;
	vertical-align: top;
	border-top: 1px solid #ddd;
	!important;
}
.table>thead>tr>th {
	vertical-align: bottom;
	border-bottom: 2px solid #ddd;
	!important;
}
.table>caption+thead>tr:first-child>th, .table>colgroup+thead>tr:first-child>th, .table>thead:first-child>tr:first-child>th, .table>caption+thead>tr:first-child>td, .table>colgroup+thead>tr:first-child>td, .table>thead:first-child>tr:first-child>td {
	border-top: 0;
	!important;
}
.table>tbody+tbody {
	border-top: 2px solid #ddd;
	!important;
}
.table .table {
	background-color: #fff;
	!important;
}
.table-condensed>thead>tr>th, .table-condensed>tbody>tr>th, .table-condensed>tfoot>tr>th, .table-condensed>thead>tr>td, .table-condensed>tbody>tr>td, .table-condensed>tfoot>tr>td {
	padding: 5px;
	!important;
}
.table-bordered {
	border: 1px solid #ddd;
	!important;
}
.table-bordered>thead>tr>th, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>tbody>tr>td, .table-bordered>tfoot>tr>td {
	border: 1px solid #ddd;
	!important;
}
.table-bordered>thead>tr>th, .table-bordered>thead>tr>td {
	border-bottom-width: 2px;
	!important;
}
.table-striped>tbody>tr:nth-child(odd)>td, .table-striped>tbody>tr:nth-child(odd)>th {
	background-color: #ffcccc;
	!important;
}
.table-hover>tbody>tr:hover>td, .table-hover>tbody>tr:hover>th {
	background-color: #f5f5f5;
	!important;
}
}
</style>
        <div class="grid_10">
            <div class="box round first">
                <h2>Statement&nbsp;&nbsp;
				<button class="btn btn-orange" onclick="window.location.href='user.php?id=<?php echo $id;?>';">User Overview</button>&nbsp;&nbsp;
				<button class="btn btn-orange" onclick="window.location.href='user.php?id=<?php echo $id;?>&index=1';">Financial status</button></h2>
                <div class="block">
					<?php if($sys_msg!='') { echo "<div>".$sys_msg."</div>"; } ?>
					<?php if($show)
					{
						?>
							<button type="button" name="print" class="btn btn-green" onclick="printContent('statement')">Print the bellow statement</button>
							<div id="statement">
							<div>
								<div style="float:left; marging:5px;"><img src="https://bookingparcel.com/logo.gif"></div>
								<div class="clear"></div>
								<div style="float:right; marging:5px;">
									Europost Express (UK) Ltd<br>
									4 Corringham Road,<br>
									Wembley - Middlesex<br>
									HA9 9QA- London , UK<br>
									Tel: +44(0) 788 610 5417<br>
									VAT No. 220335165<br>
								</div>
								<div class="clear"></div>
								<div>
									<span style="float:left; width:50%;">
									<?php echo $row['company']."<br>".nl2br($row['address'])."<br><br><span style='font-size:15px;font-weight:bold;margin:5px;margin-left:0px;'>".date("d F",$from) ."". (date("Y",$from)!=date("Y",$to) ? " ".date("Y",$from) : "") ." to ". date("d F",$to) ." ".date("Y",$to)."</span><br><br><span style='font-size:13px;font-weight:bold;margin:3px;margin-left:0px;'>Account Name</span><br>".$row['company']; ?>
									</span>
									<span style="float:right; width:50%;">
										<div style='font-size:15px;font-weight:bold;margin:5px;text-align:center;color:#ff1a1a;'>
											Your Statement (<?php echo $currency;?>)
										</div><br>
										<table style="border: none;" class="table table-hover table-striped">
											<thead>
												<tr style="border: none;">
													<th style="border: none;" colspan="2">Account Summary</th>
												</tr>
											</thead>
											<tbody>
												<tr style="border: none;">
													<td style="border: none;">Opening Balance</td>
													<td style="border: none;"><?php echo number_format($Opening_Balance,2);?></td>
												</tr>
												<tr style="border: none;">
													<td style="border: none;">Payments In</td>
													<td style="border: none;"><?php echo number_format($Payments_in,2);?></td>
												</tr>
												<tr style="border: none;">
													<td style="border: none;">Payments Out</td>
													<td style="border: none;"><?php echo number_format($Payments_out,2);?></td>
												</tr>
												<tr style="border: none;">
													<td style="border: none;">Closing Balance</td>
													<td style="border: none;"><?php echo number_format($closing_balance,2);?></td>
												</tr>
											</tbody>
										</table>
									</span>
								</div>
								<div class="clear"></div>
								<div>
									<table class="data display datatable" id="example">
										<tbody>
											<tr class="gradeA odd" style="border: none;border-top:1px solid #ddd;">
												<td colspan="5" style="border: none;font-size:15px;font-weight:bold;margin:5px;">Your Current Account details</td>
											</tr>
											<tr class="gradeA even" style="border: none;border-bottom:1px solid #ddd;">
												<td style="border: none;width:15%">Date</td>
												<td style="border: none;width:40%">Details</td>
												<td style="border: none;width:15%">Paid Out</td>
												<td style="border: none;width:15%">Paid In</td>
												<td style="border: none;width:15%">Balance</td>
											</tr>
											<?php echo $output; ?>
										</tbody>
									</table>
								</div>
								<div class="clear"></div>
							</div>
							</div>
						<?php
					}
					else{
					?>
					<div>
						<form method="post">
							<div id="transactions">
								<!--Start Balance&nbsp;:&nbsp;<input type="text" name="begining" value="0" placeholder="Opening balance value">&nbsp;&nbsp;&nbsp;--->
								Currency&nbsp;:&nbsp;
									<select name="currency">
										<option value="GBP">GBP</option>
										<option value="USD">USD</option>
										<option value="EUR">EUR</option>
										<option value="IRR">IRR</option>
									</select>&nbsp;&nbsp;&nbsp;
								From&nbsp;:&nbsp;<input type="text" name="from" value="<?php echo date("Y/m/d",(time()-2592000)); ?>" placeholder="Y/m/d H:i:s">&nbsp;&nbsp;&nbsp;
								To&nbsp;:&nbsp;<input type="text" name="to" value="<?php echo date("Y/m/d",time()); ?>" placeholder="Y/m/d H:i:s">
								
							</div>
							<div>
								<button type="submit" name="submit" value="Apply" class="btn btn-blue">Apply</button>
							</div>
						</form>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
		<?php
		
	}
	elseif($index==1)
	{
		if(isset($_GET['del']) AND is_numeric($_GET['del']) AND $_GET['del']>0)
		{
			mysql_query("DELETE FROM `transactions` WHERE `id`=".$_GET['del']." AND `uref`=".$id."");
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
		$sys_msg = "";
		$currency = array('GBP','USD','EUR','IRR');
		$Action = array(0,1);
		$type = array(0,1,2,3,4,5);
		if(isset($_POST['submit']) AND $_POST['submit']=='Apply')
		{
			if(isset($_POST['amount']) AND $_POST['amount']!=null AND is_array($_POST['amount']) AND count($_POST['amount'])>0)
			{
				foreach($_POST['amount'] as $k=>$amt)
				{
					if(isset($_POST['currency'][$k]) AND trim($_POST['currency'][$k])!='' AND in_array($_POST['currency'][$k], $currency))
					{
						if(isset($_POST['type'][$k]) AND trim($_POST['type'][$k])!='' AND in_array($_POST['type'][$k], $type))
						{
							$datetime = time();
							$desc = '';
							$qid = 0;
							if(isset($_POST['qid'][$k]) AND trim($_POST['qid'][$k])!='' AND $_POST['qid'][$k]>0)
							{
								$qid = $_POST['qid'][$k];
							}
							if(isset($_POST['description'][$k]) AND trim($_POST['description'][$k])!='')
							{
								$desc = $_POST['description'][$k];
							}
							if(isset($_POST['datetime'][$k]) AND trim($_POST['datetime'][$k])!='')
							{
								$tmp = explode(" ", $_POST['datetime'][$k]);
								$tmp1 = explode("/", $tmp[0]);
								$tmp2 = explode(":", $tmp[1]);
								
								$datetime = mktime($tmp2[0], $tmp2[1], $tmp2[2], $tmp1[1], $tmp1[2], $tmp1[0]);
								
							}
						
						
							if($_POST['type'][$k]==0)
							{
								$q = "UPDATE `users` SET `".$_POST['currency'][$k]."_current_balance`= ".$_POST['currency'][$k]."_current_balance - ".$amt.", `".$_POST['currency'][$k]."_total_order_paid`= ".$_POST['currency'][$k]."_total_order_paid + ".$amt." WHERE `id`=".$id."";
								mysql_query($q) or die($q ." : ". mysql_error());
							}
							elseif($_POST['type'][$k]==1)
							{
								$q = "UPDATE `users` SET `".$_POST['currency'][$k]."_current_balance`= ".$_POST['currency'][$k]."_current_balance + ".$amt.", `".$_POST['currency'][$k]."_total_receive`= ".$_POST['currency'][$k]."_total_receive + ".$amt." WHERE `id`=".$id."";
								mysql_query($q) or  die($q ." : ". mysql_error());
							}
							elseif($_POST['type'][$k]==2)
							{
								$q = "UPDATE `users` SET `".$_POST['currency'][$k]."_current_balance`= ".$_POST['currency'][$k]."_current_balance + ".$amt.", `".$_POST['currency'][$k]."_total_order_paid`= ".$_POST['currency'][$k]."_total_order_paid - ".$amt." WHERE `id`=".$id."";
								mysql_query($q) or  die($q ." : ". mysql_error());
							}
							elseif($_POST['type'][$k]==3)
							{
								$q = "UPDATE `users` SET `".$_POST['currency'][$k]."_current_balance`= ".$_POST['currency'][$k]."_current_balance - ".$amt.", `".$_POST['currency'][$k]."_total_order_paid`= ".$_POST['currency'][$k]."_total_order_paid + ".$amt." WHERE `id`=".$id."";
								mysql_query($q) or  die($q ." : ". mysql_error());
							}
							
							$sys_msg .= "Transaction added ( Quote ID : ".$qid." | Amount : ".$amt." | Currency ".$_POST['currency'][$k]." )<br>";
							$q = "INSERT INTO `transactions` (`oref`, `uref`, `type`, `amount`, `currency`, `timestamp`, `description`) VALUES (".$qid.", ".$id.", ".$_POST['type'][$k].", ".$amt.", '".$_POST['currency'][$k]."', ".$datetime.", '".$desc."');";
							mysql_query($q) or die($q ." : ". mysql_error());
						}
						else
							$sys_msg .= "Transaction did not add (error : wrong type entered!)<br>";
					}
					else
						$sys_msg .= "Transaction did not add (error : wrong currency entered!)<br>";
				}
			}
			else
				$sys_msg .= "Transaction did not add (error : wrong amount entered!)<br>";
		}
		$sys_msg2 = "";
		/*
		$currency_refund = array('GBP','USD','EUR','IRR');
		if(isset($_POST['submit_refund']) AND $_POST['submit_refund']=='Apply')
		{
			if(isset($_POST['amount_refund']) AND $_POST['amount_refund']!=null AND is_array($_POST['amount_refund']) AND count($_POST['amount_refund'])>0)
			{
				foreach($_POST['amount_refund'] as $k=>$amt)
				{
					if(isset($_POST['currency_refund'][$k]) AND trim($_POST['currency_refund'][$k])!='' AND in_array($_POST['currency_refund'][$k], $currency))
					{
						$datetime_refund = time();
						$desc_refund = '';
						$qid_refund = 0;
						if(isset($_POST['qid_refund'][$k]) AND trim($_POST['qid_refund'][$k])!='' AND $_POST['qid_refund'][$k]>0)
						{
							$qid_refund = $_POST['qid_refund'][$k];
						}
						if(isset($_POST['description_refund'][$k]) AND trim($_POST['description_refund'][$k])!='')
						{
							$desc_refund = $_POST['description_refund'][$k];
						}
						if(isset($_POST['datetime_refund'][$k]) AND trim($_POST['datetime_refund'][$k])!='')
						{
							$tmp = explode(" ", $_POST['datetime_refund'][$k]);
							$tmp1 = explode("/", $tmp[0]);
							$tmp2 = explode(":", $tmp[1]);
							
							$datetime_refund = mktime($tmp2[0], $tmp2[1], $tmp2[2], $tmp1[1], $tmp1[2], $tmp1[0]);
							
						}
						
						$q = "UPDATE `users` SET `".$_POST['currency_refund'][$k]."_current_balance`= ".$_POST['currency_refund'][$k]."_current_balance + ".$amt." WHERE `id`=".$id."";
						mysql_query($q) or die($q ." : ". mysql_error());
						
						
						$sys_msg2 .= "Transaction added ( Quote ID : ".$qid_refund." | Amount : ".$amt." | Currency ".$_POST['currency_refund'][$k]." )<br>";
						$q = "INSERT INTO `transactions` (`oref`, `uref`, `type`, `amount`, `currency`, `timestamp`, `description`) VALUES (".$qid_refund.", ".$id.", 2, ".$amt.", '".$_POST['currency_refund'][$k]."', ".$datetime_refund.", '".$desc_refund."');";
						mysql_query($q) or die($q ." : ". mysql_error());
					}
					else
						$sys_msg2 .= "Transaction did not add (error : wrong currency entered!)<br>";
				}
			}
			else
				$sys_msg2 .= "Transaction did not add (error : wrong amount entered!)<br>";
		}
		*/
		if(isset($_POST['submit']) AND $_POST['submit']=='Apply2')
		{
			if(isset($_POST['amount']) AND $_POST['amount']!=null AND $_POST['amount']!='')
			{
				if(isset($_POST['currency']) AND trim($_POST['currency'])!='' AND in_array($_POST['currency'], $currency))
				{
					if(isset($_POST['currency2']) AND trim($_POST['currency2'])!='' AND in_array($_POST['currency2'], $currency))
					{
						if(isset($_POST['amount2']) AND $_POST['amount2']!=null AND $_POST['amount2']!='')
						{
							if(isset($_POST['description']) AND trim($_POST['description'])!='')
							{
								$desc = $_POST['description'];
							}
							if(isset($_POST['datetime']) AND trim($_POST['datetime'])!='')
							{
								$tmp = explode(" ", $_POST['datetime']);
								$tmp1 = explode("/", $tmp[0]);
								$tmp2 = explode(":", $tmp[1]);
								
								$datetime = mktime($tmp2[0], $tmp2[1], $tmp2[2], $tmp1[1], $tmp1[2], $tmp1[0]);
								
							}
							$qid = 0;
							if(isset($_POST['qid']) AND trim($_POST['qid'])!='' AND $_POST['qid']>0)
							{
								$qid = $_POST['qid'];
							}
							$sys_msg .= "Exchange applied (  ".$_POST['amount']."(".$_POST['currency'].") => ".$_POST['amount2']."(".$_POST['currency2'].") )<br>";
							$q = "INSERT INTO `transactions` (`oref`, `uref`, `type`, `amount`, `currency`, `timestamp`, `description`) VALUES (".$qid.", ".$id.", 4, ".$_POST['amount'].", '".$_POST['currency']."', ".$datetime.", '".$desc."');";
							mysql_query($q) or die($q ." : ". mysql_error());
							$q = "UPDATE `users` SET `".$_POST['currency']."_current_balance`=".$_POST['currency']."_current_balance - ".$_POST['amount'].", `".$_POST['currency2']."_current_balance`=".$_POST['currency2']."_current_balance + ".$_POST['amount2'].", `".$_POST['currency']."_total_receive`=".$_POST['currency']."_total_receive - ".$_POST['amount'].", `".$_POST['currency2']."_total_receive`=".$_POST['currency2']."_total_receive + ".$_POST['amount2']." WHERE `id`=".$id."";
							mysql_query($q) or die($q ." : ". mysql_error());
							$q = "INSERT INTO `transactions` (`oref`, `uref`, `type`, `amount`, `currency`, `timestamp`, `description`) VALUES (".$qid.", ".$id.", 1, ".$_POST['amount2'].", '".$_POST['currency2']."', ".$datetime.", '".$desc."');";
							mysql_query($q) or die($q ." : ". mysql_error());
						}
						else
							$sys_msg .= "Transaction did not add (error : wrong type entered!)<br>";
					}
					else
						$sys_msg .= "Transaction did not add (error : wrong currency entered!)<br>";
				}
			}
			else
				$sys_msg .= "Transaction did not add (error : wrong amount entered!)<br>";
		}
		if(isset($_POST['submit']) AND $_POST['submit']=='Apply3')
		{
			if(isset($_POST['amount']) AND $_POST['amount']!=null AND $_POST['amount']!='')
			{
				if(isset($_POST['currency']) AND trim($_POST['currency'])!='' AND in_array($_POST['currency'], $currency))
				{
					if(isset($_POST['type']) AND trim($_POST['type'])!='' AND in_array($_POST['type'], $type))
					{
						$datetime = time();
						$desc = '';
						$qid = 0;
						if(isset($_POST['qid']) AND trim($_POST['qid'])!='' AND $_POST['qid']>0)
						{
							$qid = $_POST['qid'];
						}
						if(isset($_POST['description']) AND trim($_POST['description'])!='')
						{
							$desc = $_POST['description'];
						}
						if(isset($_POST['datetime']) AND trim($_POST['datetime'])!='')
						{
							$tmp = explode(" ", $_POST['datetime']);
							$tmp1 = explode("/", $tmp[0]);
							$tmp2 = explode(":", $tmp[1]);
							
							$datetime = mktime($tmp2[0], $tmp2[1], $tmp2[2], $tmp1[1], $tmp1[2], $tmp1[0]);
							
						}
						if($_POST['action']==1)
						{
							if($_POST['type']==4)
							{
								$q = "UPDATE `users` SET `".$_POST['currency']."_current_balance`= ".$_POST['currency']."_current_balance + ".$_POST['amount'].", `".$_POST['currency']."_total_receive`= ".$_POST['currency']."_total_receive + ".$_POST['amount']." WHERE `id`=".$id."";
								mysql_query($q) or die($q ." : ". mysql_error());
							}
							elseif($_POST['type']==5)
							{
								$q = "UPDATE `users` SET `".$_POST['currency']."_current_balance`= ".$_POST['currency']."_current_balance - ".$_POST['amount'].", `".$_POST['currency']."_total_receive`= ".$_POST['currency']."_total_receive - ".$_POST['amount']." WHERE `id`=".$id."";
								mysql_query($q) or  die($q ." : ". mysql_error());
							}
						}
						$sys_msg .= "Transaction added ( Quote ID : ".$qid." | Amount : ".$_POST['amount']." | Currency ".$_POST['currency']." )<br>";
						$q = "INSERT INTO `transactions` (`oref`, `uref`, `type`, `amount`, `currency`, `timestamp`, `description`) VALUES (".$qid.", ".$id.", ".$_POST['type'].", ".$_POST['amount'].", '".$_POST['currency']."', ".$datetime.", '".$desc."');";
						mysql_query($q) or die($q ." : ". mysql_error());
					}
					else
						$sys_msg .= "Transaction did not add (error : wrong type entered!)<br>";
				}
				else
					$sys_msg .= "Transaction did not add (error : wrong currency entered!)<br>";
			}
			else
				$sys_msg .= "Transaction did not add (error : wrong amount entered!)<br>";
		}
		?>
        <div class="grid_10">
            <div class="box round first">
                <h2>Search For Transaction(s)</h2>
                <div class="block">
				<form method="post" >
					<input type="hidden" name="t" value="search">
					Transaction ID : <input type="txt" name="id" value=""><br>
					Or<br>
					Quote ID : <input type="txt" name="qid" value=""><br>
					<button class="btn btn-green" type="submit">Search</button>&nbsp;&nbsp;
				</form>
				<?php
				
				if(isset($_POST['t']) AND $_POST['t']='search')
				{
					$q="";
					if(isset($_POST['id']) AND is_numeric($_POST['id']) AND $_POST['id']>0)
					{
						$q = "SELECT * FROM `transactions` WHERE `uref`=".$id." AND `id`=".$_POST['id']." AND `type` IN (0,1,2,3,4,5)";
					}
					elseif(isset($_POST['qid']) AND is_numeric($_POST['qid']) AND $_POST['qid']>0)
					{
						$q = "SELECT * FROM `transactions` WHERE `uref`=".$id." AND `oref`=".$_POST['qid']." AND `type` IN (0,1,2,3,4,5)";
					}
					if($q!='')
					{
						$res = mysql_query($q);
						if(mysql_num_rows($res)>0)
						{
							$output = '';
							$_c = 1;
							while($trow = mysql_fetch_array($res))
							{
								$output .= '<tr style="text-align:center;">';
								$output .= '<td style="padding:5px;">'.$_c.'</td>';
								$output .= '<td style="padding:5px;">'.$trow['id'].'</td>';
								$output .= '<td style="padding:5px;"><a href="itemedit.php?id='.$trow['oref'].'">'.$trow['oref'].'</a></td>';
								$output .= '<td style="padding:5px;">'.$trow['amount'].'&nbsp;('.$trow['currency'].')</td>';
								$output .= '<td style="padding:5px;">'.($trow['type']==0 ? "Paid For Quote" : ($trow['type']==1 ? "Increasing The Deposite" : ($trow['type']==2 ? "Return Money Back" : (($trow['type']==4 or $trow['type']==5) ? "Other" : "Difference")))).'</td>';
								$output .= '<td style="padding:5px;">'.$trow['description'].'</td>';
								$output .= '<td style="padding:5px;">'.date("Y/m/d H:i:s",$trow['timestamp']).'</td>';
								$output .= "<td style=\"padding:5px;\"><a href='user.php?id=".$id."&index=1&edit=".$trow['id']."'>Edit</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href='#' OnClick=\"ConfirmFunc2('".$trow['id']."');\">Delete</a></td>";
								$output .= '</tr>';
								$_c++;
							}
							?>
							
							<table border="1" style="margin-left:auto;margin-right:auto;width:90%;border-collapse:collapse;border-color:#777;font-size:12px">
								<tbody>
									<tr style="background-color:#ccc;text-align:center;color:#3a3a3a">
										<td style="padding:5px">#</td>
										<td>Transaction ID</td>
										<td>Quote ID</td>
										<td>Amount (Currency)</td>
										<td>Transaction Type</td>
										<td>Description</td>
										<td>Date</td>
										<td>Action</td>
									</tr>
									<?php echo $output; ?>
								</tbody>
							</table>
							<?php
						}
						else
							echo "<br>Nothing Found!<br>";
					}
					else
						echo "<br>Nothing Found!<br>";
				}
				?>
				</div>
			</div>
		</div>
		<?php
		if(isset($_GET['edit']) AND is_numeric($_GET['edit']) AND $_GET['edit']>0)
		{
			$q = "SELECT * FROM `transactions` WHERE `uref`=".$id." AND `id`=".$_GET['edit']."";
			$res = mysql_query($q);
			$ed_row = mysql_fetch_array($res);
			if(isset($_POST['t']) AND $_POST['t']='edit')
			{
				$amount = '';
				$desc = '';
				$datetime = time();
				if(isset($_POST['amount']) AND trim($_POST['amount'])!='')
				{
					$amount = "`amount` = '".$_POST['amount']."'";
				}
				if(isset($_POST['description']) AND trim($_POST['description'])!='')
				{
					$desc = $_POST['description'];
				}
				if(isset($_POST['datetime']) AND trim($_POST['datetime'])!='')
				{
					$tmp = explode(" ", $_POST['datetime']);
					$tmp1 = explode("/", $tmp[0]);
					$tmp2 = explode(":", $tmp[1]);
					
					$datetime = mktime($tmp2[0], $tmp2[1], $tmp2[2], $tmp1[1], $tmp1[2], $tmp1[0]);
					
				}
				
				mysql_query("UPDATE `transactions` SET `description`='".$desc."', `timestamp`='".$datetime."' ".($amount!='' ? ",".$amount : "")." WHERE `uref`=".$id." AND `id`=".$_GET['edit']."");
				header('Location: user.php?id='.$id.'&index=1');
			}
			
		?>

        <div class="grid_10">
            <div class="box round first">
                <h2>Edit Transaction No. <?php echo $_GET['edit']; ?></h2>
                <div class="block">
				<form method="post" >
					<input type="hidden" name="t" value="edit">
					<input type="hidden" name="id" value="<?php echo $_GET['edit']; ?>">
					<?php
					echo "Transaction ID : ".$ed_row['id']."<br>";
					echo "Quote ID : ".$ed_row['oref']."<br>";
					echo "Amount : <input type=\"text\" name=\"amount\" value=\"".$ed_row['amount']."\"> (".$ed_row['currency'].")<br>";
					?>
					Description : <input type="text" name="description" value="<?php echo $ed_row['description']; ?>"><br>
					Date : <input type="text" name="datetime" value="<?php echo date("Y/m/d H:i:s",$ed_row['timestamp']); ?>"><br>
					<button class="btn btn-green" type="submit">save</button>&nbsp;&nbsp;
					<br>Note: if you make any changes in amount value! it just applys in the list bellow and the "financial statement" part, so you must correct the balance and deposit manually.
				</form>
				</div>
			</div>
		</div>
			<?php
		}
		?>
        <div class="grid_10">
            <div class="box round first">
                <h2><?php 
				$timestamp = ((isset($_GET['current_year']) AND $_GET['current_year']==1) ? mktime(0,0,0,1,1,date("Y")): "");
				$timestamp2 = ((isset($_GET['current_month']) AND $_GET['current_month']==1) ? mktime(0,0,0,date("n"),1,date("Y")): "");
		$stat = "Not-Activated";
		switch($row['status'])
		{
			case 0: $stat = "Not-Activated"; break;
			case 1: $stat = "Active"; break;
		}
		
			echo "User ID: ".$id." ) ".$row['fname'] ."&nbsp;".$row['lname'] ."&nbsp;(".$stat.") Financial Status".($timestamp != "" ? " of ".date("Y") : ""); 
			//echo "&nbsp;<span style='float:right;'>Current Balance : ".$row['balance']." $</span>";
		?></h2>
                <div class="block">
				
				<?php 
					if($timestamp == ""){ echo '<button class="btn btn-orange" onclick="window.location.href=\'user.php?id='.$id.'&index=1&current_year=1\';">Current Year Transctions</button>&nbsp;&nbsp;'; }
					if($timestamp2 == ""){ echo '<button class="btn btn-orange" onclick="window.location.href=\'user.php?id='.$id.'&index=1&current_month=1\';">Current Month Transctions</button>&nbsp;&nbsp;'; }
					if($timestamp2 != "" OR $timestamp != ""){ echo '<button class="btn btn-orange" onclick="window.location.href=\'user.php?id='.$id.'&index=1\';">All Transctions</button>&nbsp;&nbsp;'; }
					?>
				<button class="btn btn-orange" onclick="window.location.href='user.php?id=<?php echo $id;?>';">User Overview</button>&nbsp;&nbsp;
				<button class="btn btn-orange" onclick="window.location.href='user.php?id=<?php echo $id;?>&index=2';">Financial Statement</button>
					<div>
						<?php 
							$q = "SELECT * FROM `transactions` WHERE `uref`=".$id." AND (`type`=0 OR `type`=3 OR `type`=5)".($timestamp!="" ? " AND `timestamp`>=".$timestamp : "")."".($timestamp2!="" ? " AND `timestamp`>=".$timestamp2 : "")." ORDER BY `timestamp` DESC";
							if(isset($_POST['t']) AND $_POST['t']=='paid')
							{
								$from = time() - 2592000;
								$to = time();
								if(isset($_POST['from']) AND trim($_POST['from'])!='' AND $_POST['from']!=null)
								{
									$tmp = explode(" ", $_POST['from']);
									$tmp1 = explode("/", $tmp[0]);
									$tmp2 = explode(":", $tmp[1]);
									
									$from = mktime($tmp2[0], $tmp2[1], $tmp2[2], $tmp1[1], $tmp1[2], $tmp1[0]);
								}
								if(isset($_POST['to']) AND trim($_POST['to'])!='' AND $_POST['to']!=null)
								{
									$tmp = explode(" ", $_POST['to']);
									$tmp1 = explode("/", $tmp[0]);
									$tmp2 = explode(":", $tmp[1]);
									
									$to = mktime($tmp2[0], $tmp2[1], $tmp2[2], $tmp1[1], $tmp1[2], $tmp1[0]);
								}
								if($to>=$from)
								{
									$q = "SELECT * FROM `transactions` WHERE `uref`=".$id." AND (`type`=0 OR `type`=3 OR `type`=5) AND `timestamp`<=".$to." AND `timestamp`>=".$from." ORDER BY `timestamp` DESC";
								}
							}
							//echo $q."<br>";
							$res = mysql_query($q);
							if(mysql_num_rows($res)>0)
							{
								$total = mysql_num_rows($res);
								$output = '';
								while($trow = mysql_fetch_array($res))
								{
									$output .= '<tr style="text-align:center;">';
									$output .= '<td style="padding:5px;">'.$total.'</td>';
									$output .= '<td style="padding:5px;">'.$trow['id'].'</td>';
									$output .= '<td style="padding:5px;"><a href="itemedit.php?id='.$trow['oref'].'">'.$trow['oref'].'</a></td>';
									$output .= '<td style="padding:5px;">'.$trow['amount'].'&nbsp;('.$trow['currency'].')</td>';
									$output .= '<td style="padding:5px;">'.($trow['type']==0 ? "Paid For Quote" : ($trow['type']==5 ? "other" : "Difference")).'</td>';
									$output .= '<td style="padding:5px;">'.$trow['description'].'</td>';
									$output .= '<td style="padding:5px;">'.date("Y/m/d H:i:s",$trow['timestamp']).'</td>';
									$output .= "<td style=\"padding:5px;\"><a href='user.php?id=".$id."&index=1&edit=".$trow['id']."'>Edit</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href='#' OnClick=\"ConfirmFunc2('".$trow['id']."');\">Delete</a></td>";
									$output .= '</tr>';
									$total--;
								}
							}
							else
							{
								$output = "<tr style=\"text-align:center;\"><td colspan='7'>No Transaction Detected For This User</td></tr>";
							}
						?>
Paid For Quote : <br>
<form method="post">
	<input type="hidden" name="t" value="paid">
	From&nbsp;:&nbsp;<input type="text" name="from" value="<?php echo date("Y/m/d H:i:s",(time()-2592000)); ?>" placeholder="Y/m/d H:i:s">&nbsp;&nbsp;&nbsp;
	To&nbsp;:&nbsp;<input type="text" name="to" value="<?php echo date("Y/m/d H:i:s",time()); ?>" placeholder="Y/m/d H:i:s">
	<button type="submit" name="submit" value="Filter" class="btn btn-blue">Filter</button>
</form>
<br>
<button type="button" name="print" class="btn btn-green" onclick="printContent('paid')">Print the bellow report table</button>
<br>
<div id="paid">
<table border="1" style="margin-left:auto;margin-right:auto;width:90%;border-collapse:collapse;border-color:#777;font-size:12px">
	<tbody>
		<tr style="background-color:#ccc;text-align:center;color:#3a3a3a">
			<td style="padding:5px">#</td>
			<td>Transaction ID</td>
			<td>Quote ID</td>
			<td>Amount (Currency)</td>
			<td>Transaction Type</td>
			<td>Description</td>
			<td>Date</td>
			<td>Action</td>
		</tr>
		<?php echo $output; ?>
	</tbody>
</table>
</div>
					</div>
					<div>
						<?php 
							$q = "SELECT * FROM `transactions` WHERE `uref`=".$id." AND (`type`=1 OR `type`=2 OR `type`=4)".($timestamp!="" ? " AND `timestamp`>=".$timestamp : "")."".($timestamp2!="" ? " AND `timestamp`>=".$timestamp2 : "")."  ORDER BY `timestamp` DESC";
							if(isset($_POST['t']) AND $_POST['t']=='increase')
							{
								$from = time() - 2592000;
								$to = time();
								if(isset($_POST['from']) AND trim($_POST['from'])!='' AND $_POST['from']!=null)
								{
									$tmp = explode(" ", $_POST['from']);
									$tmp1 = explode("/", $tmp[0]);
									$tmp2 = explode(":", $tmp[1]);
									
									$from = mktime($tmp2[0], $tmp2[1], $tmp2[2], $tmp1[1], $tmp1[2], $tmp1[0]);
								}
								if(isset($_POST['to']) AND trim($_POST['to'])!='' AND $_POST['to']!=null)
								{
									$tmp = explode(" ", $_POST['to']);
									$tmp1 = explode("/", $tmp[0]);
									$tmp2 = explode(":", $tmp[1]);
									
									$to = mktime($tmp2[0], $tmp2[1], $tmp2[2], $tmp1[1], $tmp1[2], $tmp1[0]);
								}
								if($to>=$from)
								{
									$q = "SELECT * FROM `transactions` WHERE `uref`=".$id." AND (`type`=1 OR `type`=2 OR `type`=4) AND `timestamp`<=".$to." AND `timestamp`>=".$from." ORDER BY `timestamp` DESC";
								}
							}
							//echo $q."<br>";
							$res = mysql_query($q);
							if(mysql_num_rows($res)>0)
							{
								$total = mysql_num_rows($res);
								$output = '';
								while($trow = mysql_fetch_array($res))
								{
									$output .= '<tr style="text-align:center;">';
									$output .= '<td style="padding:5px;">'.$total.'</td>';
									$output .= '<td style="padding:5px;">'.$trow['id'].'</td>';
									$output .= '<td style="padding:5px;">'.$trow['oref'].'</td>';
									$output .= '<td style="padding:5px;">'.$trow['amount'].'&nbsp;('.$trow['currency'].')</td>';
									$output .= '<td style="padding:5px;">'.($trow['type']==2 ? "Return Back" : ($trow['type']==4 ? "Other" : "Increasing The Deposit")).'</td>';
									$output .= '<td style="padding:5px;">'.$trow['description'].'</td>';
									$output .= '<td style="padding:5px;">'.date("Y/m/d H:i:s",$trow['timestamp']).'</td>';
									$output .= "<td style=\"padding:5px;\"><a href='user.php?id=".$id."&index=1&edit=".$trow['id']."'>Edit</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href='#' OnClick=\"ConfirmFunc2('".$trow['id']."');\">Delete</a></td>";
									$output .= '</tr>';
									$total--;
								}
							}
							else
							{
								$output = "<tr style=\"text-align:center;\"><td colspan='7'>No Transaction Detected For This User</td></tr>";
							}
						?>
Increasing The Deposit : <br>
<form method="post">
	<input type="hidden" name="t" value="increase">
	From&nbsp;:&nbsp;<input type="text" name="from" value="<?php echo date("Y/m/d H:i:s",(time()-2592000)); ?>" placeholder="Y/m/d H:i:s">&nbsp;&nbsp;&nbsp;
	To&nbsp;:&nbsp;<input type="text" name="to" value="<?php echo date("Y/m/d H:i:s",time()); ?>" placeholder="Y/m/d H:i:s">
	<button type="submit" name="submit" value="Filter" class="btn btn-blue">Filter</button>
</form>

<br>
<button type="button" name="print" class="btn btn-green" onclick="printContent('increase')">Print the bellow report table</button>
<br>
<div id="increase">
<table border="1" style="margin-left:auto;margin-right:auto;width:90%;border-collapse:collapse;border-color:#777;font-size:12px">
	<tbody>
		<tr style="background-color:#ccc;text-align:center;color:#3a3a3a">
			<td style="padding:5px">#</td>
			<td>Transaction ID</td>
			<td>Qoute ID</td>
			<td>Amount (Currency)</td>
			<td>Transaction Type</td>
			<td>Description</td>
			<td>Date</td>
			<td>Action</td>
		</tr>
		<?php echo $output; ?>
	</tbody>
</table>
					</div>
					</div>
				</div>
			</div>
		</div>
<!--
        <div class="grid_10">
            <div class="box round first">
                <h2>Refund Transaction</h2>
                <div class="block">
					<?php if($sys_msg2!='') { echo "<div>".$sys_msg2."</div>"; } ?>
					<div ><span style="color:#ff0000;font-weight:200%;">Important Note : </span>If you want to refund a payment fully or partially, please use the form below because by using this the total paid amount wont be changed and just the total paid will be decreased.</div>
					<div>
						<form method="post">
							<div id="transactions_refund">
								<p>
									<input type="text" id="transaction" size="20" name="amount_refund[]" value="" placeholder="Money">
									<select name="currency_refund[]">
										<option value="GBP">GBP</option>
										<option value="USD">USD</option>
										<option value="EUR" selected="selected">EUR</option>
										<option value="IRR">IRR</option>
									</select>
									<input type="text" id="qid" size="7" name="qid_refund[]" value="0" placeholder="Quote ID">
									<input type="text" id="desc" size="10" name="description_refund[]" value="" placeholder="Description">
									<input type="text" id="datetime" size="15" name="datetime_refund[]" value="<?php echo date("Y/m/d H:i:s",time()); ?>" placeholder="Y/m/d H:i:s">
									<a href="#" id="addScnt_refund"><img src="../post_forms/images/icons/fam/add.png"></a>
									<a href="#" id="remScnt_refund"><img src="../post_forms/images/icons/fam/delete.png"></a>
								</p>
							</div>
							<div>
								<button type="submit" name="submit_refund" value="Apply" class="btn btn-blue">Apply</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
-->
        <div class="grid_10">
            <div class="box round first">
                <h2>Add New Transctions</h2>
                <div class="block">
					<?php if($sys_msg!='') { echo "<div>".$sys_msg."</div>"; } ?>
					<div ><span style="color:#ff0000;font-weight:200%;">Important Note : </span>If you want to add a "Paid For Quote" type transaction, fill the "Quote ID" input otherwise ignore it.</div>
					<div>
						<form method="post">
							<div id="transactions">
								<p>
									<input type="text" id="transaction" size="20" name="amount[]" value="" placeholder="Money">
									<select name="currency[]">
										<option value="GBP">GBP</option>
										<option value="USD">USD</option>
										<option value="EUR" selected="selected">EUR</option>
										<option value="IRR">IRR</option>
									</select>
									<select name="type[]">
										<option value="0">Paid For Quote</option>
										<option value="1">Increasing The Deposit</option>
										<option value="2">Refund</option>
										<option value="3">Difference</option>
									</select>
									<input type="text" id="qid" size="7" name="qid[]" value="0" placeholder="Quote ID">
									<input type="text" id="desc" size="10" name="description[]" value="" placeholder="Description">
									<input type="text" id="datetime" size="15" name="datetime[]" value="<?php echo date("Y/m/d H:i:s",time()); ?>" placeholder="Y/m/d H:i:s">
									<a href="#" id="addScnt"><img src="../post_forms/images/icons/fam/add.png"></a>
									<a href="#" id="remScnt"><img src="../post_forms/images/icons/fam/delete.png"></a>
								</p>
							</div>
							<div>
								<button type="submit" name="submit" value="Apply" class="btn btn-blue">Apply</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!--
        <div class="grid_10">
            <div class="box round first">
                <h2>Add Other New Transctions</h2>
                <div class="block">
					<?php if($sys_msg!='') { echo "<div>".$sys_msg."</div>"; } ?>
					<div>
						<form method="post">
							<div id="transactions">
								<p>
									<input type="text" id="transaction" size="20" name="amount" value="" placeholder="Money">
									<select name="currency">
										<option value="GBP">GBP</option>
										<option value="USD">USD</option>
										<option value="EUR" selected="selected">EUR</option>
										<option value="IRR">IRR</option>
									</select>
									<select name="type">
										<option value="4">Increase</option>
										<option value="5">Decrease</option>
									</select>
									<input type="text" id="qid" size="7" name="qid" value="0" placeholder="Quote ID">
									<input type="text" id="desc" size="10" name="description" value="" placeholder="Description">
									<input type="text" id="datetime" size="15" name="datetime" value="<?php echo date("Y/m/d H:i:s",time()); ?>" placeholder="Y/m/d H:i:s">
								</p>
							</div>
							<div>
								<button type="submit" name="submit" value="Apply3" class="btn btn-blue">Apply</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		-->
        <div class="grid_10">
            <div class="box round first">
                <h2>Exchange Currency</h2>
                <div class="block">
					<?php if($sys_msg!='') { echo "<div>".$sys_msg."</div>"; } ?>
					<div>
						<form method="post">
							<div id="transactions">
								<p>
									<input type="text" id="transaction" size="20" name="amount" value="" placeholder="Money">
									<select name="currency">
										<option value="GBP">GBP</option>
										<option value="USD">USD</option>
										<option value="EUR" selected="selected">EUR</option>
										<option value="IRR">IRR</option>
									</select>
									<input type="text" id="transaction" size="20" name="amount2" value="" placeholder="Money">
									<select name="currency2">
										<option value="GBP">GBP</option>
										<option value="USD">USD</option>
										<option value="EUR">EUR</option>
										<option value="IRR">IRR</option>
									</select>
									<input type="text" id="desc" size="10" name="description" value="" placeholder="Description">
									<input type="text" id="datetime" size="15" name="datetime" value="<?php echo date("Y/m/d H:i:s",time()); ?>" placeholder="Y/m/d H:i:s">
									<input type="text" id="qid" size="7" name="qid" value="" placeholder="Quote ID">
								</p>
							</div>
							<div>
								<button type="submit" name="submit" value="Apply2" class="btn btn-blue">Apply</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
	elseif($index==0)
	{
	if(isset($_POST['t']) AND $_POST['t']!="")
	{
		switch($_POST['t'])
		{
			case 'uped':
				if(isset($_POST['currency']) AND $_POST['currency']!='' AND $_POST['currency']!=null and in_array($_POST['currency'],array('GBP','USD','IRR','EUR')))
				{
					$q = "UPDATE `users` SET %s WHERE `id`=".$id."";
					$query_arr = array();
					if(isset($_POST['t_p_c']) AND $_POST['t_p_c']=='yes')
					{
						if(isset($_POST['t_p']) AND $_POST['t_p']!='' AND $_POST['t_p']!=null)
						{
							$query_arr[] = "`".$_POST['currency']."_total_receive`='".$_POST['t_p']."'";
						}
					}
					if(isset($_POST['o_p_c']) AND $_POST['o_p_c']=='yes')
					{
						if(isset($_POST['o_p']) AND $_POST['o_p']!='' AND $_POST['o_p']!=null)
						{
							$query_arr[] = "`".$_POST['currency']."_total_order_paid`='".$_POST['o_p']."'";
						}
					}
					if(isset($_POST['c_d_c']) AND $_POST['c_d_c']=='yes')
					{
						if(isset($_POST['c_d']) AND $_POST['c_d']!='' AND $_POST['c_d']!=null)
						{
							$query_arr[] = "`".$_POST['currency']."_current_balance`='".$_POST['c_d']."'";
						}
					}
					if(count($query_arr)>0)
					{
						//echo sprintf($q,implode(",",$query_arr))."<br>";
						mysql_query(sprintf($q,implode(",",$query_arr)));
						header("Location: user.php?id=".$id);
					}
				}
			break;
			case 'tpay':
				if((isset($_POST['tpay']) AND $_POST['tpay']!="" AND $_POST['tpay']!=null) AND (isset($_POST['currency']) AND $_POST['currency']!="" AND $_POST['currency']!=null AND in_array($_POST['currency'], $currency)))
				{
					mysql_query("UPDATE `users` SET `".$_POST['currency']."_total_receive`= ".$_POST['currency']."_total_receive + ".$_POST['tpay']." WHERE `id`=".$id."");
					$row[$_POST['currency'].'_total_receive'] = $_POST['tpay'];
				}
			break;
			case 'torder':
				if((isset($_POST['torder']) AND $_POST['torder']!="" AND $_POST['torder']!=null) AND (isset($_POST['currency']) AND $_POST['currency']!="" AND $_POST['currency']!=null AND in_array($_POST['currency'], $currency)))
				{
					mysql_query("UPDATE `users` SET `".$_POST['currency']."_total_order_paid`= ".$_POST['currency']."_total_order_paid + ".$_POST['torder']." WHERE `id`=".$id."");
					$row[$_POST['currency'].'_total_order_paid'] = $_POST['torder'];
				}
			break;
			case 'balance':
				if((isset($_POST['balance']) AND $_POST['balance']!="" AND $_POST['balance']!=null) AND (isset($_POST['currency']) AND $_POST['currency']!="" AND $_POST['currency']!=null AND in_array($_POST['currency'], $currency)))
				{
					mysql_query("UPDATE `users` SET `".$_POST['currency']."_current_balance`= ".$_POST['currency']."_current_balance + ".$_POST['balance']." WHERE `id`=".$id."");
					$row[$_POST['currency'].'_current_balance'] = $_POST['balance'];
				}
			break;
			case 'orderc':
				if((isset($_POST['orderc']) AND $_POST['orderc']!="" AND $_POST['orderc']!=null))
				{
					mysql_query("UPDATE `users` SET `orders_c`=".$_POST['orderc']." WHERE `id`=".$id."");
					$row['orders_c'] = $_POST['orderc'];
				}
			break;
			case 'orders':
				if((isset($_POST['orders']) AND $_POST['orders']!="" AND $_POST['orders']!=null))
				{
					mysql_query("UPDATE `users` SET `orders`=".$_POST['orders']." WHERE `id`=".$id."");
					$row['orders'] = $_POST['orders'];
				}
			break;
			case 'profile':
				$variables = array();
				if(isset($_POST['dcurrency']) AND $_POST['dcurrency']!='' AND $_POST['dcurrency']!=null)
				{
					$variables[] = "`default_currency`='".$_POST['dcurrency']."'";
				}
				if(isset($_POST['uname']) AND $_POST['uname']!='' AND $_POST['uname']!=null)
				{
					$variables[] = "`uname`='".$_POST['uname']."'";
				}
				if(isset($_POST['lname']) AND $_POST['lname']!='' AND $_POST['lname']!=null)
				{
					$variables[] = "`lname`='".$_POST['lname']."'";
				}
				if(isset($_POST['fname']) AND $_POST['fname']!='' AND $_POST['fname']!=null)
				{
					$variables[] = "`fname`='".$_POST['fname']."'";
				}
				if(isset($_POST['company']) AND $_POST['company']!='' AND $_POST['company']!=null)
				{
					$variables[] = "`company`='".$_POST['company']."'";
				}
				if(isset($_POST['email']) AND $_POST['email']!='' AND $_POST['email']!=null)
				{
					$variables[] = "`email`='".$_POST['email']."'";
				}
				if(isset($_POST['gender']) AND $_POST['gender']!='' AND $_POST['gender']!=null)
				{
					$variables[] = "`gender`='".$_POST['gender']."'";
				}
				if(isset($_POST['position']) AND $_POST['position']!='' AND $_POST['position']!=null)
				{
					$variables[] = "`position`='".$_POST['position']."'";
				}
				if(isset($_POST['status']) AND $_POST['status']!='' AND $_POST['status']!=null)
				{
					$variables[] = "`status`='".$_POST['status']."'";
				}
				if(isset($_POST['office_address']) AND $_POST['office_address']!='' AND $_POST['office_address']!=null)
				{
					$variables[] = "`office_address`='".$_POST['office_address']."'";
				}
				if(isset($_POST['address']) AND $_POST['address']!='' AND $_POST['address']!=null)
				{
					$variables[] = "`address`='".$_POST['address']."'";
				}
				if(isset($_POST['phone']) AND $_POST['phone']!='' AND $_POST['phone']!=null)
				{
					$variables[] = "`phone`='".$_POST['phone']."'";
				}
				if(isset($_POST['site']) AND $_POST['site']!='' AND $_POST['site']!=null)
				{
					$variables[] = "`site`='".$_POST['site']."'";
				}
				if(isset($_POST['abbr']) AND $_POST['abbr']!='' AND $_POST['abbr']!=null)
				{
					$variables[] = "`brand`='".$_POST['abbr']."'";
				}
				if(isset($_POST['extra_charge']) AND $_POST['extra_charge']!='' AND $_POST['extra_charge']!=null)
				{
					$variables[] = "`extra_charge`='".$_POST['extra_charge']."'";
				}
				if(isset($_POST['extra_percent']) AND $_POST['extra_percent']!='' AND $_POST['extra_percent']!=null)
				{
					$variables[] = "`extra_percent`='".$_POST['extra_percent']."'";
				}
				if(isset($_POST['pwd']) AND $_POST['pwd']!='' AND $_POST['pwd']!=null)
				{
					$variables[] = "`pwd`='".PassToHash($_POST['pwd'])."'";
				}
				if(isset($_POST['mdp']) AND $_POST['mdp']!='' AND $_POST['mdp']!=null AND $_POST['mdp']==1)
				{
					$variables[] = "`mdp`='1'";
				}
				else
				{
					$variables[] = "`mdp`='0'";
				}
				
				if(count($variables)>0){
					$q = "UPDATE `users` SET ".implode(",", $variables)."  WHERE `id`=".$id."";
					//echo $q;
					mysql_query($q);
					
					$q = "SELECT *, count(*) as counter FROM `users` WHERE `id`=".$id."";
					$row = mysql_fetch_assoc(mysql_query($q));
				}
			break;
		}
	}
	
?>


<style>

.clear
{
clear: both;
}
</style>

        <div class="grid_10">
            <div class="box round first">
                <h2><?php 
		$stat = "Not-Activated";
		switch($row['status'])
		{
			case 0: $stat = "Not-Activated"; break;
			case 1: $stat = "Active"; break;
		}
		
			echo "User ID: ".$id." ) ".$row['fname'] ."&nbsp;".$row['lname'] ."&nbsp;(".$stat.")"; 
			//echo "&nbsp;<span style='float:right;'>Current Balance : ".$row['balance']." $</span>";
		?></h2>
                <div class="block">
				<button class="btn btn-orange" onclick="window.location.href='user.php?id=<?php echo $id;?>&index=1';">Financial Status</button>
				<button class="btn btn-orange" onclick="window.location.href='user.php?id=<?php echo $id;?>&index=3';">Country Blacklist</button>
					<div>
<?php

	function GenderToText($gender){
		return ($gender ==0 ? "Male" : ($gender ==1 ? "Female" : "Other"));
	}
	function PositionToText($position){
		return ($position ==0 ? "CEO" : ($position ==1 ? "CTO" : ($position ==2 ? "Sell-Man" : ($position ==3 ? "Director" : ($position ==4 ? "Manager" : ($position ==5 ? "Staff" : "Office Boy"))))));
	}
	echo "<span style=\"float:left;width:50%;\">";
	echo "Avatar : ".($row['avatar']!="" ? "<img src='../cp/Assets/images/avatar/".$row['avatar']."'>" : "None")."<br>";
	echo "Gender : ".GenderToText($row['gender'])."<br>";
	echo "Birth Date : ".$row['birthday']."<br>";
	echo "Company : ".$row['company']."<br>";
	echo "Position : ".PositionToText($row['position'])."<br>";
	echo "<hr>";
	echo "Phone : ".$row['phone']."<br>";
	echo "Email : ".$row['email']."<br>";
	echo "WebSite : ".$row['site']."<br>";
	echo "Address : ".nl2br($row['address'])."<br>";
	echo "office_address : ".nl2br($row['office_address'])."<br>";
	//echo "<hr>";
	echo "</span>";
	//echo "<span style=\"float:right;width:50%;\">";
	//echo "Total Pay (by now) : ".$row['total_pay']."<br>";
	//echo "Current Balance : ".$row['balance']."<br>";
	//echo "Total orders cost : ".$row['total_order']."<br>";
	//echo "All Orders Count : ".$row['orders']."<br>";
	//echo "Completed Orders Count : ".$row['orders_c']."<br>";
	//echo "<hr>";
	//echo "About : <br>";
//	echo nl2br($row['about']);
	//echo "<hr>";
	//echo "</span>";


	$qqqq = "SELECT SUM(`amount`) as sum FROM `transactions` WHERE `uref`=".$id." AND `currency`='IRR' AND (`type`=1)";
	$inc_row = mysql_fetch_array(mysql_query($qqqq));
	$qq = "SELECT SUM(`amount`) as sum FROM `transactions` WHERE `uref`=".$id." AND `currency`='IRR' AND (`type`=1 or `type`=2 or `type`=4)";
	$qqq = "SELECT SUM(`amount`) as subtract FROM `transactions` WHERE `uref`=".$id." AND `currency`='IRR' AND (`type`=0 or `type`=3 or `type`=5)";
	$sum_row = mysql_fetch_array(mysql_query($qq));
	$sub_row = mysql_fetch_array(mysql_query($qqq));
	$IRR_total_pay = (float)$inc_row['sum'];
	$IRR_current_dep = $sum_row['sum'] - $sub_row['subtract'];
	$IRR_order_paid = $IRR_total_pay - $IRR_current_dep;
	//var_dump($IRR_total_pay); echo "<br>";
	//var_dump($IRR_order_paid); echo "<br>";
	//var_dump($IRR_current_dep); echo "<br>";


	$qqqq = "SELECT SUM(`amount`) as sum FROM `transactions` WHERE `uref`=".$id." AND `currency`='GBP' AND (`type`=1)";
	$inc_row = mysql_fetch_array(mysql_query($qqqq));
	$qq = "SELECT SUM(`amount`) as sum FROM `transactions` WHERE `uref`=".$id." AND `currency`='GBP' AND (`type`=1 or `type`=2 or `type`=4)";
	$qqq = "SELECT SUM(`amount`) as subtract FROM `transactions` WHERE `uref`=".$id." AND `currency`='GBP' AND (`type`=0 or `type`=3 or `type`=5)";
	$sum_row = mysql_fetch_array(mysql_query($qq));
	$sub_row = mysql_fetch_array(mysql_query($qqq));
	$GBP_total_pay = (float)$inc_row['sum'];
	$GBP_current_dep = $sum_row['sum'] - $sub_row['subtract'];
	$GBP_order_paid = $GBP_total_pay - $GBP_current_dep;
	//var_dump($GBP_total_pay); echo "<br>";
	//var_dump($GBP_order_paid); echo "<br>";
	//var_dump($GBP_current_dep); echo "<br>";


	$qqqq = "SELECT SUM(`amount`) as sum FROM `transactions` WHERE `uref`=".$id." AND `currency`='EUR' AND (`type`=1)";
	$inc_row = mysql_fetch_array(mysql_query($qqqq));
	$qq = "SELECT SUM(`amount`) as sum FROM `transactions` WHERE `uref`=".$id." AND `currency`='EUR' AND (`type`=1 or `type`=2 or `type`=4)";
	$qqq = "SELECT SUM(`amount`) as subtract FROM `transactions` WHERE `uref`=".$id." AND `currency`='EUR' AND (`type`=0 or `type`=3 or `type`=5)";
	$sum_row = mysql_fetch_array(mysql_query($qq));
	$sub_row = mysql_fetch_array(mysql_query($qqq));
	$EUR_total_pay = (float)$inc_row['sum'];
	$EUR_current_dep = $sum_row['sum'] - $sub_row['subtract'];
	$EUR_order_paid = $EUR_total_pay - $EUR_current_dep;
	//var_dump($EUR_total_pay); echo "<br>";
	//var_dump($EUR_order_paid); echo "<br>";
	//var_dump($EUR_current_dep); echo "<br>";


	$qqqq = "SELECT SUM(`amount`) as sum FROM `transactions` WHERE `uref`=".$id." AND `currency`='USD' AND (`type`=1)";
	$inc_row = mysql_fetch_array(mysql_query($qqqq));
	$qq = "SELECT SUM(`amount`) as sum FROM `transactions` WHERE `uref`=".$id." AND `currency`='USD' AND (`type`=1 or `type`=2 or `type`=4)";
	$qqq = "SELECT SUM(`amount`) as subtract FROM `transactions` WHERE `uref`=".$id." AND `currency`='USD' AND (`type`=0 or `type`=3 or `type`=5)";
	$sum_row = mysql_fetch_array(mysql_query($qq));
	$sub_row = mysql_fetch_array(mysql_query($qqq));
	$USD_total_pay = (float)$inc_row['sum'];
	$USD_current_dep = $sum_row['sum'] - $sub_row['subtract'];
	$USD_order_paid = $USD_total_pay - $USD_current_dep;
	//var_dump($USD_total_pay); echo "<br>";
	//var_dump($USD_order_paid); echo "<br>";
	//var_dump($USD_current_dep); echo "<br>";
?>
					</div>
					<div class="clear"></div>
					<div>
						<hr>
						<span style="float:left;width:33%;">
							<form method="post">
								<input type="hidden" name="t" value="tpay">
								<input type="hidden" name="currency" value="IRR">
								IRR Total Pay : <?php echo number_format($IRR_total_pay,2)/*$row['IRR_total_receive']*/; ?><!-- + <input type="text" name="tpay" value="0"> IRR <button class="btn btn-green" type="submit">Add&nbsp;</button>-->
							</form>
						</span>
						<span style="float:right;width:33%;">
							<form method="post">
								<input type="hidden" name="t" value="balance">
								<input type="hidden" name="currency" value="IRR">
								IRR Current Deposit : <?php echo number_format($IRR_current_dep,2)/*$row['IRR_current_balance']*/; ?><!-- + <input type="text" name="balance" value="0"> IRR <button class="btn btn-green" type="submit">Add&nbsp;</button>-->
							</form>
						</span>
						<span style="float:right;width:34%;">
							<form method="post">
								<input type="hidden" name="t" value="torder">
								<input type="hidden" name="currency" value="IRR">
								IRR Order Paid : <?php echo number_format($IRR_order_paid,2)/*$row['IRR_total_order_paid']*/; ?><!-- + <input type="text" name="torder" value="0">  IRR <button class="btn btn-green" type="submit">Add&nbsp;</button>-->
							</form>
						</span>
					</div>
					<div class="clear"></div>
					<div>
						<hr>
						<span style="float:left;width:33%;">
							<form method="post">
								<input type="hidden" name="t" value="tpay">
								<input type="hidden" name="currency" value="GBP">
								GBP Total Pay : <?php echo number_format($GBP_total_pay,2)/*$row['GBP_total_receive']*/; ?><!-- + <input type="text" name="tpay" value="0"> GBP <button class="btn btn-green" type="submit">Add&nbsp;</button>-->
							</form>
						</span>
						<span style="float:right;width:33%;">
							<form method="post">
								<input type="hidden" name="t" value="balance">
								<input type="hidden" name="currency" value="GBP">
								GBP Current Deposit : <?php echo number_format($GBP_current_dep,2)/*$row['GBP_current_balance']*/; ?><!-- + <input type="text" name="balance" value="0"> GBP <button class="btn btn-green" type="submit">Add&nbsp;</button>-->
							</form>
						</span>
						<span style="float:right;width:34%;">
							<form method="post">
								<input type="hidden" name="t" value="torder">
								<input type="hidden" name="currency" value="GBP">
								GBP Order Paid : <?php echo number_format($GBP_order_paid,2)/*$row['GBP_total_order_paid']*/; ?><!-- + <input type="text" name="torder" value="0">  GBP <button class="btn btn-green" type="submit">Add&nbsp;</button>-->
							</form>
						</span>
					</div>
					<div class="clear"></div>
					<div>
						<hr>
						<span style="float:left;width:33%;">
							<form method="post">
								<input type="hidden" name="t" value="tpay">
								<input type="hidden" name="currency" value="EUR">
								EUR Total Pay : <?php echo number_format($EUR_total_pay,2)/*$row['EUR_total_receive']*/; ?><!-- + <input type="text" name="tpay" value="0"> EUR <button class="btn btn-green" type="submit">Add&nbsp;</button>-->
							</form>
						</span>
						<span style="float:right;width:33%;">
							<form method="post">
								<input type="hidden" name="t" value="balance">
								<input type="hidden" name="currency" value="EUR">
								EUR Current Deposit : <?php echo number_format($EUR_current_dep,2)/*echo $row['EUR_current_balance']*/; ?><!-- + <input type="text" name="balance" value="0"> EUR <button class="btn btn-green" type="submit">Add&nbsp;</button>-->
							</form>
						</span>
						<span style="float:right;width:34%;">
							<form method="post">
								<input type="hidden" name="t" value="torder">
								<input type="hidden" name="currency" value="EUR">
								EUR Order Paid : <?php echo number_format($EUR_order_paid,2)/*$row['EUR_total_order_paid']*/; ?><!-- + <input type="text" name="torder" value="0">  EUR <button class="btn btn-green" type="submit">Add&nbsp;</button>-->
							</form>
						</span>
					</div>
					<div class="clear"></div>
					<div>
						<hr>
						<span style="float:left;width:33%;">
							<form method="post">
								<input type="hidden" name="t" value="tpay">
								<input type="hidden" name="currency" value="USD">
								USD Total Pay : <?php echo number_format($USD_total_pay,2)/*$row['USD_total_receive']*/; ?><!-- + <input type="text" name="tpay" value="0"> USD <button class="btn btn-green" type="submit">Add&nbsp;</button>-->
							</form>
						</span>
						<span style="float:right;width:33%;">
							<form method="post">
								<input type="hidden" name="t" value="balance">
								<input type="hidden" name="currency" value="USD">
								USD Current Deposit : <?php echo number_format($USD_current_dep,2)/*$row['USD_current_balance']*/; ?><!-- + <input type="text" name="balance" value="0"> USD <button class="btn btn-green" type="submit">Add&nbsp;</button>-->
							</form>
						</span>
						<span style="float:right;width:34%;">
							<form method="post">
								<input type="hidden" name="t" value="torder">
								<input type="hidden" name="currency" value="USD">
								USD Order Paid : <?php echo number_format($USD_order_paid,2)/*$row['USD_total_order_paid']*/; ?><!-- + <input type="text" name="torder" value="0">  USD <button class="btn btn-green" type="submit">Add&nbsp;</button>-->
							</form>
						</span>
					</div>
					<div class="clear"></div>
					<div>
						<hr>
						<form method="post">
							<input type="hidden" name="t" value="profile">
							<div>
								<span style="float:left;width:33%;">
									<span style="float:left;width:40%;">User Name : </span><span style="float:left;width:60%;"><input type="text" name="uname" value="<?php echo $row['uname']; ?>"></span>
								</span>
								<span style="float:right;width:33%;">
									<span style="float:left;width:40%;">First Name : </span><span style="float:left;width:60%;"><input type="text" name="fname" value="<?php echo $row['fname']; ?>"></span>
								</span>
								<span style="float:right;width:34%;">
									<span style="float:left;width:40%;">Last Name : </span><span style="float:left;width:60%;"><input type="text" name="lname" value="<?php echo $row['lname']; ?>"></span>
								</span>
							</div>
							<hr>
							<div>
								<span style="float:left;width:33%;">
									<span style="float:left;width:40%;">Position : </span><span style="float:left;width:60%;">
									<select class="form-control" name="position">
										<option value="0" <?php echo ($row['position']==0 ? "selected='selected'" : ""); ?>>CEO</option>
										<option value="1" <?php echo ($row['position']==1 ? "selected='selected'" : ""); ?>>CTO</option>
										<option value="2" <?php echo ($row['position']==2 ? "selected='selected'" : ""); ?>>Sell-Man</option>
										<option value="3" <?php echo ($row['position']==3 ? "selected='selected'" : ""); ?>>Director</option>
										<option value="4" <?php echo ($row['position']==4 ? "selected='selected'" : ""); ?>>Manager</option>
										<option value="5" <?php echo ($row['position']==5 ? "selected='selected'" : ""); ?>>Staff</option>
										<option value="6" <?php echo ($row['position']==6 ? "selected='selected'" : ""); ?>>Office Boy</option>
									</select></span>
								</span>
								<span style="float:right;width:33%;">
									<span style="float:left;width:40%;">Gender : </span><span style="float:left;width:60%;">
									<select class="form-control" name="gender">
										<option value="0" <?php echo ($row['gender']==0 ? "selected='selected'" : ""); ?>>Male</option>
										<option value="1" <?php echo ($row['gender']==1 ? "selected='selected'" : ""); ?>>Female</option>
									</select></span>
								</span>
								<span style="float:right;width:34%;">
									<span style="float:left;width:40%;">Status : </span><span style="float:left;width:60%;">
									<select class="form-control" name="status">
										<option value="0" <?php echo ($row['status']==0 ? "selected='selected'" : ""); ?>>In-Active</option>
										<option value="1" <?php echo ($row['status']==1 ? "selected='selected'" : ""); ?>>Active</option>
									</select></span>
								</span>
							</div>
							<hr>
							<div>
								<span style="float:left;width:33%;">
									<span style="float:left;width:40%;">Email : </span><span style="float:left;width:60%;"><input type="text" name="email" value="<?php echo $row['email']; ?>"></span>
								</span>
								<span style="float:right;width:33%;">
									<span style="float:left;width:40%;">PassWord : </span><span style="float:left;width:60%;"><input type="text" name="pwd" value=""></span>
								</span>
								<span style="float:right;width:34%;">
									<span style="float:left;width:40%;">Phone : </span><span style="float:left;width:60%;"><input type="text" name="phone" value="<?php echo $row['phone']; ?>"></span>
								</span>
							</div>
							<hr>
							<div>
								<span style="float:left;width:33%;">
									<span style="float:left;width:40%;">Company : </span><span style="float:left;width:60%;"><input type="text" name="company" value="<?php echo $row['company']; ?>"></span>
								</span>
								<span style="float:right;width:33%;">
									<span style="float:left;width:40%;">Brand/Abbreviation : </span><span style="float:left;width:60%;"><input type="text" name="abbr" value="<?php echo $row['brand']; ?>"></span>
								</span>
								<span style="float:right;width:34%;">
									<span style="float:left;width:40%;">Site : </span><span style="float:left;width:60%;"><input type="text" name="site" value="<?php echo $row['site']; ?>"></span>
								</span>
							</div>
							<hr>
							<div>
								<span style="float:right;width:33%;">
									<span style="float:left;width:50%;">Extra charge in formula (Money Unit) : </span><span style="float:left;width:50%;"><input type="text" name="extra_charge" value="<?php echo $row['extra_charge']; ?>"></span>
								</span>
								<span style="float:right;width:33%;">
									<span style="float:left;width:50%;">Extra amount after exchange (Percent) : </span><span style="float:left;width:50%;"><input type="text" name="extra_percent" value="<?php echo $row['extra_percent']; ?>">%</span>
								</span>
								<span style="float:right;width:34%;">
									<span style="float:left;width:40%;">Minus Deposit : </span><span style="float:left;width:60%;"><input type="checkbox" name="mdp" value="1" <?php echo ($row['mdp']==1 ? "checked=checked" : ""); ?>></span>
								</span>
							</div>
							<hr>
							<div>
								<span style="float:right;width:100%;">
									<span style="float:left;width:50%;">Default Currency : </span><span style="float:left;width:50%;">
										<select class="form-control" name="dcurrency">
											<option value="GBP" <?php echo ($row['default_currency'] == 'GBP' ? 'selected' : ''); ?>>GBP</option>
											<option value="EUR" <?php echo ($row['default_currency'] == 'EUR' ? 'selected' : ''); ?>>EUR</option>
										</select>
									</span>
								</span>
							</div>
							<hr>
							<div>
								<span style="float:right;width:50%;">
									<span style="float:left;width:10%;">Address : </span><span style="float:left;width:90%;"><textarea name="address" style="margin: 0px; width: 564px; height: 150px;"><?php echo $row['address']; ?></textarea></span>
								</span>
								<span style="float:right;width:50%;">
									<span style="float:left;width:15%;">Office Address : </span><span style="float:left;width:85%;"><textarea name="office_address`" style="margin: 0px; width: 564px; height: 150px;"><?php echo $row['office_address']; ?></textarea></span>
								</span>
							</div>
							<hr>
							<div>
								<button type="submit" name="submit" class="btn btn-blue">Save</button>
							</div>
						</form>
					</div>
					<div class="clear"></div>
                </div>
            </div>
        </div>
		<!--
        <div class="grid_10">
            <div class="box round first">
                <h2>Update the user financial</h2>
                <div class="block">
					<span style="color:#ff0000">Important Note</span>: DO NOT use this part unless you completely know what you are doing and know how to work this!<br><br>
					<form method="post">
						<input type="hidden" name="t" value="uped">
						Currency : 
						<select class="form-control" name="currency">
							<option value="GBP">GBP</option>
							<option value="EUR">EUR</option>
							<option value="USD">USD</option>
							<option value="IRR">IRR</option>
						</select><br>
						<input type="checkbox" name="t_p_c" value="yes"> Total Paid : <input type="text" name="t_p" value="0.00"><br>
						<input type="checkbox" name="o_p_c" value="yes"> Order Paid : <input type="text" name="o_p" value="0.00"><br>
						<input type="checkbox" name="c_d_c" value="yes"> Current Deposit : <input type="text" name="c_d" value="0.00"><br>
						<button type="submit" name="submit" class="btn btn-blue">Apply</button><br><br><br>
						<span style="color:#ff0000">Instruction</span>: <br>
						<span style="color:#33cc33">1- Choose your currency.</span><br>
						<span style="color:#ff0000">2- Fill and select each input(s) you wanna update (otherwise the amount will be set on 0.00)</span><br>
						<span style="color:#33cc33">3- Click on "Apply"</span><br>
						Then you will have new amounts on user profile.
					</form>
					<div class="clear"></div>
                </div>
            </div>
        </div>
		-->
        <div class="grid_10">
            <div class="box round first">
                <h2>The orders connected to the user</h2>
                <div class="block">

                    <?php
if(!(isset($_GET['p']) AND $_GET['p']!='' AND $_GET['p']!=null AND is_numeric($_GET['p']) AND $_GET['p']>0)){
	$p = 1;
}
else{
	$p = $_GET['p'];
}
if(!(isset($_GET['type']) AND $_GET['type']!='' AND $_GET['type']!=null AND is_numeric($_GET['type']) AND $_GET['type']>=0 AND $_GET['type']<=4)){
	$type = -1;
}
else{
	$type = $_GET['type'];
}
$item_per_page = 30;
$lim = "LIMIT ".(($p-1) * $item_per_page).",".$item_per_page."";

$prev_p = "";
$next_p = "";
$curr_p = "Page : No.".$p;


$con = mysql_connect(DB_HOST,DB_USER,DB_PASS) or die(mysql_error());
mysql_select_db(DB_NAME, $con) or die(mysql_error());


if(isset($_GET['del']) AND is_numeric($_GET['del']) AND $_GET['del']>0){
	$q = "SELECT count(*) as cc FROM `quote` WHERE `id`=".$_GET['del']." AND `uname`='".$row['uname']."'";
	$rr = mysql_fetch_array(mysql_query($q));
	if($rr['cc']>0){
		mysql_query("DELETE FROM `quote` WHERE `id`=".$_GET['del']." AND `uname`='".$row['uname']."'");
	}
}

$output = "";
$q = "SELECT * FROM `quote` WHERE TRUE AND `uname`='".$row['uname']."' ".(($type == 0-1) ? " " : "AND `status`=".$type." ")."ORDER BY `timestamp` DESC, `id` ASC";

$r = mysql_query($q) or die(mysql_error());
$total_res = mysql_num_rows($r);
$max_p = ceil($total_res/$item_per_page);

if($p<$max_p){
	$next_p = "<a class=\"btn-icon btn-black btn-arrow-right\" href='user.php?id=".$id."&p=".($p+1)."".(($type == 0-1) ? "" : "&type=".$type."")."'><span></span>Next</a>";
}
if($p>1){
	$prev_p = "<a class=\"btn-icon btn-black btn-arrow-left\" href='user.php?id=".$id."&p=".($p-1)."".(($type == 0-1) ? "" : "&type=".$type."")."'><span></span>Previous</a>";
}

$q = "SELECT * FROM `quote` WHERE TRUE AND `uname`='".$row['uname']."' ".(($type == 0-1) ? " " : "AND `status`=".$type." ")."ORDER BY `timestamp` DESC, `id` ASC ".$lim;

$r = mysql_query($q) or die(mysql_error());
if(mysql_num_rows($r)>0){
	$_c = (($p-1)*$item_per_page)+1;
	while($row = mysql_fetch_array($r)){
		$color = "999";
		if($row['status']==1){
			$color = "066ECD";
		}
		elseif($row['status']==2){
			$color = "77B32F";
		}
		elseif($row['status']==3){
			$color = "E40001";
		}
		elseif($row['status']==4){
			$color = "39A7B6";
		}
		
		$output .="<tr style=\"background-color:#".$color.";\">";
		$output .="<td >".$_c."</td><td >".$row['id']."</td><td >".$row['tid']."".($row['danger']=='Yes' ? "&nbsp;<span class=\"danger_small\"></span>" : "")."".($row['chemical']=='Yes' ? "&nbsp;<span class=\"chemical_small\"></span>" : "")."".($row['lithiumb']=='Yes' ? "&nbsp;<span class=\"battry_small\"></span>" : "")."</td><td >".$row['fname']."</td><td >".$row['company']."</td><td >".$row['phone']."</td><td >".$row['email']."</td><td >".$row['from']."</td><td >".$row['to']."</td><td >".date("Y/m/d H:i:s",$row['timestamp'])."</td>";
		$output .="<td><a href='item.php?id=".$row['id']."'>Details</a>&nbsp;|&nbsp;<a href='itemedit.php?id=".$row['id']."'>Edit</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;<a href='offers.php?id=".$row['id']."'>Agents</a>&nbsp;|&nbsp;<a href='#' OnClick=\"ConfirmFunc('".$row['id']."','".$row['tid']."');\">Delete</a></td>";
		$output .="</tr>";
		$_c++;
	}
}
else{
	$output = "<tr><td colspan=\"11\">No Entery Detected</td></tr>";
}
//mysql_close();
					?>
				
<p class="start">Choose a category : 
<button class="btn btn-orange" onclick="window.location.href='user.php?id=<?php echo $id; ?>';">All Orders&nbsp;</button>&nbsp;&nbsp;&nbsp;
<button class="btn btn-grey" onclick="window.location.href='user.php?id=<?php echo $id; ?>&type=0';">Pending&nbsp;</button>&nbsp;&nbsp;&nbsp;
<button class="btn btn-blue" onclick="window.location.href='user.php?id=<?php echo $id; ?>&type=1';">Under Process&nbsp;</button>&nbsp;&nbsp;&nbsp;
<button class="btn btn-green" onclick="window.location.href='user.php?id=<?php echo $id; ?>&type=2';">Active&nbsp;</button>&nbsp;&nbsp;&nbsp;
<button class="btn btn-red" onclick="window.location.href='user.php?id=<?php echo $id; ?>&type=3';">Cancelled&nbsp;</button>&nbsp;&nbsp;&nbsp;
<button class="btn btn-teal" onclick="window.location.href='user.php?id=<?php echo $id; ?>&type=4';">Completed&nbsp;</button>&nbsp;&nbsp;&nbsp;
</p>
<p class="start">
<span class="chemical"></span>&nbsp;chemical&nbsp;&nbsp;&nbsp;|&nbsp;
<span class="danger"></span>&nbsp;Dangerous Good&nbsp;&nbsp;&nbsp;|&nbsp;
<span class="battry"></span>&nbsp;Lithium Battery&nbsp;&nbsp;&nbsp;|&nbsp;
<span style="width:10px;height:10px;background-color:#999;display: inline-block;"></span>&nbsp;Pending&nbsp;&nbsp;&nbsp;|&nbsp;
<span style="width:10px;height:10px;background-color:#066ECD;display: inline-block;"></span>&nbsp;Under Process&nbsp;&nbsp;&nbsp;|&nbsp;
<span style="width:10px;height:10px;background-color:#77B32F;display: inline-block;"></span>&nbsp;Active&nbsp;&nbsp;&nbsp;|&nbsp;
<span style="width:10px;height:10px;background-color:#E40001;display: inline-block;"></span>&nbsp;Cancelled&nbsp;&nbsp;&nbsp;|&nbsp;
<span style="width:10px;height:10px;background-color:#39A7B6;display: inline-block;"></span>&nbsp;Completed&nbsp;&nbsp;&nbsp;
</p>
<table border="1" style="margin-left:auto;margin-right:auto;width:90%;border-collapse:collapse;border-color:#777;font-size:12px">
	<tbody>
		<tr style="background-color:#ccc;text-align:center;color:#3a3a3a">
			<td style="padding:5px">#</td>
			<td >ID</td>
			<td >Tracking ID</td>
			<td >Name</td>
			<td >Company</td>
			<td >Phone</td>
			<td >E-mail</td>
			<td >From</td>
			<td >To</td>
			<td >Date</td>
			<td >Action</td>
		</tr>
		<tr style="background-color:#fff;text-align:center;font-weight:bold">
			<?php echo $output; ?>
		</tr>
		
	</tbody>
</table>
<?php echo $prev_p .'&nbsp;'. $curr_p .'&nbsp;'. $next_p; 
echo "<br> Total Pages : ".$max_p;
?>
					<div class="clear"></div>
                </div>
            </div>
        </div>
<?php
	}
}
else
{

?>

        <div class="grid_10">
            <div class="box round first">
                <h2>Access denied</h2>
                <div class="block">
				<strong>Oops!</strong> Something went wrong!<br><br>
				you can't access this user because of the following reasons:<br>
				1. User does not exist.<br>
                </div>
            </div>
        </div>
<?php 
}
?>
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
