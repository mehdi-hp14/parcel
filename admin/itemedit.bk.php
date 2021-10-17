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

if(isset($_GET['fullname']) AND $_GET['fullname']!='' AND $_GET['fullname']!=null)
{
	unlink($_GET['fullname']);
	header("Location: itemedit.php?id=".$id."");
}
$post_c = array(
	'Radio-00'=>'Test Country',
	'Radio-0'=>'Afghanistan',
	'Radio-1'=>'Albania',
	'Radio-2'=>'Algeria',
	'Radio-3'=>'Andorra',
	'Radio-4'=>'Angola',
	'Radio-5'=>'Antigua',
	'Radio-6'=>'Argentina',
	'Radio-7'=>'Armenia',
	'Radio-8'=>'Australia',
	'Radio-9'=>'Austria',
	'Radio-10'=>'Azerbaijan',
	'Radio-11'=>'Bahamas',
	'Radio-12'=>'Bahrain',
	'Radio-13'=>'Bangladesh',
	'Radio-14'=>'Barbados',
	'Radio-15'=>'Belarus',
	'Radio-16'=>'Belgium',
	'Radio-17'=>'Belize',
	'Radio-18'=>'Benin',
	'Radio-19'=>'Bhutan',
	'Radio-20'=>'Bolivia',
	'Radio-21'=>'Bosnia Herzegovina',
	'Radio-22'=>'Botswana',
	'Radio-23'=>'Brazil',
	'Radio-24'=>'Brunei',
	'Radio-25'=>'Bulgaria',
	'Radio-26'=>'Burkina',
	'Radio-27'=>'Burundi',
	'Radio-28'=>'Cambodia',
	'Radio-29'=>'Cameroon',
	'Radio-30'=>'Canada',
	'Radio-31'=>'Cape Verde',
	'Radio-32'=>'Central African Rep',
	'Radio-33'=>'Chad',
	'Radio-34'=>'Chile',
	'Radio-35'=>'China',
	'Radio-36'=>'Colombia',
	'Radio-37'=>'Comoros',
	'Radio-38'=>'Congo',
	'Radio-39'=>'Congo',
	'Radio-40'=>'Costa Rica',
	'Radio-41'=>'Croatia',
	'Radio-42'=>'Cuba',
	'Radio-43'=>'Cyprus',
	'Radio-44'=>'Czech Republic',
	'Radio-45'=>'Denmark',
	'Radio-46'=>'Djibouti',
	'Radio-47'=>'Dominica',
	'Radio-48'=>'Dominican Republic',
	'Radio-49'=>'East Timor',
	'Radio-50'=>'Ecuador',
	'Radio-51'=>'Egypt',
	'Radio-52'=>'El Salvador',
	'Radio-53'=>'Equatorial Guinea',
	'Radio-54'=>'Eritrea',
	'Radio-55'=>'Estonia',
	'Radio-56'=>'Ethiopia',
	'Radio-57'=>'Fiji',
	'Radio-58'=>'Finland',
	'Radio-59'=>'France',
	'Radio-60'=>'Gabon',
	'Radio-61'=>'Gambia',
	'Radio-62'=>'Georgia',
	'Radio-63'=>'Germany',
	'Radio-64'=>'Ghana',
	'Radio-65'=>'Greece',
	'Radio-66'=>'Grenada',
	'Radio-67'=>'Guatemala',
	'Radio-68'=>'Guinea',
	'Radio-69'=>'Guinea-Bissau',
	'Radio-70'=>'Guyana',
	'Radio-71'=>'Haiti',
	'Radio-72'=>'Honduras',
	'Radio-195'=>'Hong Kong',
	'Radio-73'=>'Hungary',
	'Radio-74'=>'Iceland',
	'Radio-75'=>'India',
	'Radio-76'=>'Indonesia',
	'Radio-77'=>'Iran',
	'Radio-78'=>'Iraq',
	'Radio-79'=>'Ireland (Republic)',
	'Radio-80'=>'Israel',
	'Radio-81'=>'Italy',
	'Radio-82'=>'Ivory Coast',
	'Radio-83'=>'Jamaica',
	'Radio-84'=>'Japan',
	'Radio-85'=>'Jordan',
	'Radio-86'=>'Kazakhstan',
	'Radio-87'=>'Kenya',
	'Radio-88'=>'Kiribati',
	'Radio-89'=>'Korea North',
	'Radio-90'=>'Korea South',
	'Radio-91'=>'Kosovo',
	'Radio-92'=>'Kuwait',
	'Radio-93'=>'Kyrgyzstan',
	'Radio-94'=>'Laos',
	'Radio-95'=>'Latvia',
	'Radio-96'=>'Lebanon',
	'Radio-97'=>'Lesotho',
	'Radio-98'=>'Liberia',
	'Radio-99'=>'Libya',
	'Radio-100'=>'Liechtenstein',
	'Radio-101'=>'Lithuania',
	'Radio-102'=>'Luxembourg',
	'Radio-103'=>'Macedonia',
	'Radio-104'=>'Madagascar',
	'Radio-105'=>'Malawi',
	'Radio-106'=>'Malaysia',
	'Radio-107'=>'Maldives',
	'Radio-108'=>'Mali',
	'Radio-109'=>'Malta',
	'Radio-110'=>'Marshall Islands',
	'Radio-111'=>'Mauritania',
	'Radio-112'=>'Mauritius',
	'Radio-113'=>'Mexico',
	'Radio-114'=>'Micronesia',
	'Radio-115'=>'Moldova',
	'Radio-116'=>'Monaco',
	'Radio-117'=>'Mongolia',
	'Radio-118'=>'Montenegro',
	'Radio-119'=>'Morocco',
	'Radio-120'=>'Mozambique',
	'Radio-121'=>'Myanmar (Burma)',
	'Radio-122'=>'Namibia',
	'Radio-123'=>'Nauru',
	'Radio-124'=>'Nepal',
	'Radio-125'=>'Netherlands',
	'Radio-126'=>'New Zealand',
	'Radio-127'=>'Nicaragua',
	'Radio-128'=>'Niger',
	'Radio-129'=>'Nigeria',
	'Radio-130'=>'Norway',
	'Radio-131'=>'Oman',
	'Radio-132'=>'Pakistan',
	'Radio-133'=>'Palau',
	'Radio-134'=>'Panama',
	'Radio-135'=>'Papua New Guinea',
	'Radio-136'=>'Paraguay',
	'Radio-137'=>'Peru',
	'Radio-138'=>'Philippines',
	'Radio-139'=>'Poland',
	'Radio-140'=>'Portugal',
	'Radio-141'=>'Qatar',
	'Radio-142'=>'Romania',
	'Radio-143'=>'Russian Federation',
	'Radio-144'=>'Rwanda',
	'Radio-145'=>'St Kitts & Nevis',
	'Radio-146'=>'St Lucia',
	'Radio-147'=>'Saint Vincent',
	'Radio-148'=>'Samoa',
	'Radio-149'=>'San Marino',
	'Radio-150'=>'Sao Tome Principe',
	'Radio-151'=>'Saudi Arabia',
	'Radio-152'=>'Senegal',
	'Radio-153'=>'Serbia',
	'Radio-154'=>'Seychelles',
	'Radio-155'=>'Sierra Leone',
	'Radio-156'=>'Singapore',
	'Radio-157'=>'Slovakia',
	'Radio-158'=>'Slovenia',
	'Radio-159'=>'Solomon Islands',
	'Radio-160'=>'Somalia',
	'Radio-161'=>'South Africa',
	'Radio-162'=>'Spain',
	'Radio-163'=>'Sri Lanka',
	'Radio-164'=>'Sudan',
	'Radio-165'=>'Suriname',
	'Radio-166'=>'Swaziland',
	'Radio-167'=>'Sweden',
	'Radio-168'=>'Switzerland',
	'Radio-169'=>'Syria',
	'Radio-170'=>'Taiwan',
	'Radio-171'=>'Tajikistan',
	'Radio-172'=>'Tanzania',
	'Radio-173'=>'Thailand',
	'Radio-174'=>'Togo',
	'Radio-175'=>'Tonga',
	'Radio-176'=>'Trinidad & Tobago',
	'Radio-177'=>'Tunisia',
	'Radio-178'=>'Turkey',
	'Radio-179'=>'Turkmenistan',
	'Radio-180'=>'Tuvalu',
	'Radio-181'=>'Uganda',
	'Radio-182'=>'Ukraine',
	'Radio-183'=>'United Arab Emirates',
	'Radio-184'=>'United Kingdom',
	'Radio-185'=>'United States',
	'Radio-186'=>'Uruguay',
	'Radio-187'=>'Uzbekistan',
	'Radio-188'=>'Vanuatu',
	'Radio-189'=>'Vatican City',
	'Radio-190'=>'Venezuela',
	'Radio-191'=>'Vietnam',
	'Radio-192'=>'Yemen',
	'Radio-193'=>'Zambia',
	'Radio-194'=>'Zimbabwe'
);
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
input[type=number]{
    width: 60px;
} 

.settings {
  display: table;
  width: 100%;
}
.settings .row {
  display: table-row;
}
.settings .question,
.settings .switch {
  display: table-cell;
  vertical-align: middle;
  padding: 5px;
}
.settings .question {
  width: 60%;
  font-family: "Roboto Slab", serif;
  font-size: 15px;
}
/* ============================================================
  COMMON
============================================================ */
.cmn-toggle {
  position: absolute;
  margin-left: -9999px;
  visibility: hidden;
}
.cmn-toggle + label {
  display: block;
  position: relative;
  cursor: pointer;
  outline: none;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* ============================================================
  SWITCH 3 - YES NO
============================================================ */
input.cmn-toggle-yes-no + label {
  padding: 2px;
  width: 40%;
  height: 30px;
}
input.cmn-toggle-yes-no + label:before, input.cmn-toggle-yes-no + label:after {
  display: block;
  position: absolute;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  color: #fff;
  font-family: "Roboto Slab", serif;
  font-size: 15px;
  text-align: center;
  line-height: 30px;
}
input.cmn-toggle-yes-no + label:before {
  background-color: #ff1a1a;
  content: attr(data-off);
  -webkit-transition: -webkit-transform 0.5s;
  -moz-transition: -moz-transform 0.5s;
  -o-transition: -o-transform 0.5s;
  transition: transform 0.5s;
  -webkit-backface-visibility: hidden;
  -moz-backface-visibility: hidden;
  -ms-backface-visibility: hidden;
  -o-backface-visibility: hidden;
  backface-visibility: hidden;
}
input.cmn-toggle-yes-no + label:after {
  background-color: #8ce196;
  content: attr(data-on);
  -webkit-transition: -webkit-transform 0.5s;
  -moz-transition: -moz-transform 0.5s;
  -o-transition: -o-transform 0.5s;
  transition: transform 0.5s;
  -webkit-transform: rotateY(180deg);
  -moz-transform: rotateY(180deg);
  -ms-transform: rotateY(180deg);
  -o-transform: rotateY(180deg);
  transform: rotateY(180deg);
  -webkit-backface-visibility: hidden;
  -moz-backface-visibility: hidden;
  -ms-backface-visibility: hidden;
  -o-backface-visibility: hidden;
  backface-visibility: hidden;
}
input.cmn-toggle-yes-no:checked + label:before {
  -webkit-transform: rotateY(180deg);
  -moz-transform: rotateY(180deg);
  -ms-transform: rotateY(180deg);
  -o-transform: rotateY(180deg);
  transform: rotateY(180deg);
}
input.cmn-toggle-yes-no:checked + label:after {
  -webkit-transform: rotateY(0);
  -moz-transform: rotateY(0);
  -ms-transform: rotateY(0);
  -o-transform: rotateY(0);
  transform: rotateY(0);
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
$(function() {
        var scntDiv = $('#dimss_d');
        var i = $('#dimss_d p').size() + 1;
        
        $('#addScnt').live('click', function() {
                $('<p><label for="dimss"><input type="text" id="dimss" size="20" name="dimss[]" value="" placeholder="Dimensions" /><input type="text" id="weights" size="3" name="weights[]" value="" placeholder="Weight" /></label><a href="#" id="addScnt"><img src="../post_forms/images/icons/fam/add.png"></a><a href="#" id="remScnt"><img src="../post_forms/images/icons/fam/delete.png"></a></p>').appendTo(scntDiv);
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
        var scntDiv2 = $('#HAWB_d');
        var i = $('#HAWB_d p').size() + 1;
        
        $('#addScnt2').live('click', function() {
                $('<p><label ><input type="text"  size="40" name="hawb1[]" value="" placeholder="Consignee\'s name" />&nbsp;-&nbsp;<input type="text"  size="15" name="hawb2[]" value="" placeholder="reference" /></label>&nbsp;<a href="#" id="addScnt2"><img src="../post_forms/images/icons/fam/add.png"></a>&nbsp;<a href="#" id="remScnt2"><img src="../post_forms/images/icons/fam/delete.png"></a>&nbsp;&nbsp;&nbsp;</p>').appendTo(scntDiv2);
                i++;
                return false;
        });
        
        $('#remScnt2').live('click', function() { 
                if( i > 2 ) {
                        $(this).parents('p').remove();
                        i--;
                }
                return false;
        });
        var scntDiv3 = $('#prices_d');
        var iii = $('#prices_d p').size() + 1;
        
        $('#addScnt3').live('click', function() {
                $('<p><label for="prices"><input type="radio" name="r_price_r" id="r_price_r" value="'+ (iii - 1) +'">&nbsp;<input type="text" name="r_price_n[]" id="r_price_n" value="" placeholder="Method Name">&nbsp;<input type="text" name="r_price_p[]" id="r_price_p" value="" placeholder="Price" size="6">&nbsp;<select name="r_price_c[]"><option value="GBP">GBP</option><option value="USD">USD</option><option value="EUR" selected="selected">EUR</option><option value="IRR">IRR</option><option value="CHF">CHF</option><option value="DKK">DKK</option><option value="HKD">HKD</option><option value="SGD">SGD</option><option value="SEK">SEK</option><option value="CAD">CAD</option><option value="AED">AED</option><option value="JYP">JYP</option><option value="CNH">CNH</option><option value="TRY">TRY</option><option value="PUR">PUR</option></select></label><a href="#" id="addScnt3"><img src="../post_forms/images/icons/fam/add.png"></a><a href="#" id="remScnt3"><img src="../post_forms/images/icons/fam/delete.png"></a></p>').appendTo(scntDiv3);
                iii++;
                return false;
        });
        
        $('#remScnt3').live('click', function() { 
                if( iii > 2 ) {
                        $(this).parents('p').remove();
                        iii--;
                }
                return false;
        });
        var scntDiv4 = $('#oprices_d');
        var iiii = $('#oprices_d p').size() + 1;
        
        $('#addScnt4').live('click', function() {
                $('<p><label for="oprices"><input type="radio" name="o_price_r" id="o_price_r" value="'+ (iiii - 1) +'">&nbsp;<input type="text" name="o_price_n[]" id="o_price_n" value="" placeholder="Method Name">&nbsp;<input type="text" name="o_price_p[]" id="o_price_p" value="" placeholder="Price" size="6">&nbsp;<select name="o_price_c[]"><option value="GBP">GBP</option><option value="USD">USD</option><option value="EUR">EUR</option><option value="IRR">IRR</option></select></label><a href="#" id="addScnt4"><img src="../post_forms/images/icons/fam/add.png"></a><a href="#" id="remScnt4"><img src="../post_forms/images/icons/fam/delete.png"></a></p>').appendTo(scntDiv4);
                iiii++;
                return false;
        });
        
        $('#remScnt4').live('click', function() { 
                if( iii > 2 ) {
                        $(this).parents('p').remove();
                        iiii--;
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
                    </ul>
                </div>
            </div>
        </div>
                    <?php

require_once("CurrencyConv/GoogleCurrencyConvertor.inc.php");
/*
function GetOfferPriceFromReceive($rprice, $currency="EUR")
{
	$rprice = str_replace(",","",$rprice);
	
	$extra = 0;
	if($currency=='EUR' OR $currency=='USD')
	{
			//$mult = ceil($rprice/600);
			//$mult = max(1,$mult);
			$extra = 0;
			if($rprice<=1200)
			{
				$extra +=20;
			}
			else
			{
				$extra +=20;
				$mult = ceil(($rprice - 1200)/1000);
				$mult = max(1,$mult);
				$extra += ($mult * 7);
			}
		
		$googleCurrencyConvertor = new GoogleCurrencyConvertor("1",$currency,"GBP");
		$rate = $googleCurrencyConvertor->getRate();
		$rprice = ceil($rprice * $rate);
	}
	
	$extra_price = ($rprice * 0.43);
	
	switch($currency)
	{
		case 'USD' :
			if($rprice <= 1000)
				$extra_price = max(150, $extra_price);
			elseif($rprice>1000)
				$extra_price = max(250, $extra_price);
		case 'EUR' :
			if($rprice <= 1000)
				$extra_price = max(120, $extra_price);
			elseif($rprice>1000)
				$extra_price = max(300, $extra_price);
	}
	
	return number_format(ceil($rprice + $extra_price  + $extra),2);
}
*/

function GetOfferPriceFromReceive($rprice, $currency="EUR",$extra_c=0,$percent=0)
{
	$rprice = str_replace(",","",$rprice);
	
	$extra = 0;
	
	if($currency=='EUR' OR $currency=='USD' OR $currency=='GBP')
	{
		$tmp = (int)$rprice;
		if($tmp>0 AND $tmp<=300)
		{
			$extra = 120;
		}
		elseif($tmp<=600)
		{
			$extra = 160;
		}
		elseif($tmp<=1000)
		{
			$extra = 200;
		}
		elseif($tmp<=1400)
		{
			$extra = 250;
		}
		elseif($tmp<=1800)
		{
			$extra = 300;
		}
		elseif($tmp<=2300)
		{
			$extra = 400;
		}
		elseif($tmp<=2600)
		{
			$extra = 500;
		}
		elseif($tmp<=2900)
		{
			$extra = 600;
		}
		elseif($tmp<=4000)
		{
			$extra = 800;
		}
		elseif($tmp<=6000)
		{
			$extra = 1000;
		}
		elseif($tmp<=8000)
		{
			$extra = 1200;
		}
		elseif($tmp<=10000)
		{
			$extra = 1400;
		}
		elseif($tmp<=12000)
		{
			$extra = 1600;
		}
		elseif($tmp<=14000)
		{
			$extra = 1800;
		}
		elseif($tmp<=16000)
		{
			$extra = 2000;
		}
		elseif($tmp<=18000)
		{
			$extra = 2200;
		}
		elseif($tmp<=20000)
		{
			$extra = 2400;
		}
		elseif($tmp<=22000)
		{
			$extra = 2600;
		}
		elseif($tmp<=24000)
		{
			$extra = 2800;
		}
		elseif($tmp<=26000)
		{
			$extra = 3000;
		}
		elseif($tmp<=28000)
		{
			$extra = 3200;
		}
		elseif($tmp<=30000)
		{
			$extra = 3400;
		}
		
		
		if($currency=='USD')
		{
			$extra += 20;
		}
		elseif($currency=='EUR')
		{
			$extra += 5;
		}
		
		
		if($currency!='GBP')
		{
    		$googleCurrencyConvertor = new GoogleCurrencyConvertor("1",$currency,"GBP");
		    $rate = $googleCurrencyConvertor->getRate();
		    $rprice = ceil($rprice * $rate);
		}
		
		$temp = 1 + ($percent / 100);
		$rprice *= $temp;
	}
	
	
	
	return number_format(ceil($rprice + $extra + $extra_c),2);
}

$con = mysql_connect(DB_HOST,DB_USER,DB_PASS) or die(mysql_error());
mysql_select_db(DB_NAME, $con) or die(mysql_error());

$q = "SELECT `paid`, `uname`, `offered_p` FROM `quote` WHERE `id`=".$id."";
$r = mysql_query($q) or die(mysql_error());
$row = mysql_fetch_array($r);
if(isset($_POST['t']) AND $_POST['t']==1){
	$q_p = array();
	$tmp = "";
	$_c = 0;
	if(isset($_POST['dimss']) AND is_array($_POST['dimss']) AND count($_POST['dimss'])>0){
		foreach($_POST['dimss'] as $k=>$dim){
			$tmp .= ($_c +1).') '.$dim.' => '.$_POST['weights'][$k].' kg | ';
			$_c++;
		}
	}
	$tmp2 = "";
	$_c2 = 0;
	if(isset($_POST['hawb1']) AND is_array($_POST['hawb1']) AND count($_POST['hawb1'])>0){
		foreach($_POST['hawb1'] as $k=>$dim){
			$tmp2 .= ($_c2 +1).') '.$dim.' => '.$_POST['hawb2'][$k].'|';
			$_c2++;
		}
	}
	$tmp3 = "";
	$tmp4 = "";
	$_c = 0;
	if(isset($_POST['r_price_p']) AND is_array($_POST['r_price_p']) AND count($_POST['r_price_p'])>0){
		$extra = 0;
		$percent = 0;
		
		if($row['uname']!='')
		{
			
			$qqq = "SELECT * FROM `users` WHERE `uname`='".$row['uname']."'";
			$rrr = mysql_query($qqq) or die(mysql_error());
			$user_info = mysql_fetch_array($rrr);
			$extra = $user_info['extra_charge'];
			$percent = $user_info['extra_percent'];
		}
		foreach($_POST['r_price_p'] as $k=>$p){
			$tmp3 .= ($_c +1).') '.((isset($_POST['r_price_r']) AND $_POST['r_price_r']==$k) ? 'on' : 'off').'=>'.$_POST['r_price_n'][$k].'=>'.$_POST['r_price_p'][$k].'=>'.$_POST['r_price_c'][$k].' | ';
			if(isset($_POST['auto_off']) AND $_POST['auto_off']!='' AND $_POST['auto_off']!=null AND $_POST['auto_off']=='yes')
				$tmp4 .= ($_c +1).') '.((isset($_POST['r_price_r']) AND $_POST['r_price_r']==$k) ? 'on' : 'off').'=>'.$_POST['r_price_n'][$k].'=>'. GetOfferPriceFromReceive($_POST['r_price_p'][$k], $_POST['r_price_c'][$k], $extra, $percent).'=>'.(($_POST['r_price_c'][$k]=='EUR' OR $_POST['r_price_c'][$k]=='USD') ? 'GBP' : $_POST['r_price_c'][$k]).' | ';
			$_c++;
		}
	}
	$_c = 0;
	if(isset($_POST['o_price_p']) AND is_array($_POST['o_price_p']) AND count($_POST['o_price_p'])>0 AND !(isset($_POST['auto_off']) AND $_POST['auto_off']!='' AND $_POST['auto_off']!=null AND $_POST['auto_off']=='yes')){
		$tmp4 = "";
		foreach($_POST['o_price_p'] as $k=>$p){
			$tmp4 .= ($_c +1).') '.((isset($_POST['o_price_r']) AND $_POST['o_price_r']==$k) ? 'on' : 'off').'=>'.$_POST['o_price_n'][$k].'=>'.$_POST['o_price_p'][$k].'=>'.$_POST['o_price_c'][$k].' | ';
			$_c++;
		}
	}
	if($tmp != ''){
		$q_p[] = "`dims`='".$tmp."'";
	}
	if($tmp2 != ''){
		$q_p[] = "`hawb`='".$tmp2."'";
	}
	if($tmp3 != ''){
		$q_p[] = "`received_p`='".$tmp3."'";
	}
	if($tmp4 != ''){
		$q_p[] = "`offered_p`='".$tmp4."'";
	}
	if(isset($_POST['name']) AND $_POST['name']!=''){
		$q_p[] = "`fname`='".$_POST['name']."'";
	}
	if(isset($_POST['cname']) AND $_POST['cname']!=''){
		$q_p[] = "`company`='".$_POST['cname']."'";
	}
	if(isset($_POST['status']) AND $_POST['status']!=''){
		$q_p[] = "`status`='".$_POST['status']."'";
	}
	if(isset($_POST['status_user']) AND $_POST['status_user']!=''){
		$q_p[] = "`status_user`='".$_POST['status_user']."'";
	}
	if(isset($_POST['phone']) AND $_POST['phone']!=''){
		$q_p[] = "`phone`='".$_POST['phone']."'";
	}
	if(isset($_POST['email']) AND $_POST['email']!=''){
		$q_p[] = "`email`='".$_POST['email']."'";
	}
	if(isset($_POST['invemail']) AND $_POST['invemail']!=''){
		$q_p[] = "`invemail`='".$_POST['invemail']."'";
	}
	if(isset($_POST['quotemail']) AND $_POST['quotemail']!=''){
		$q_p[] = "`quotemail`='".$_POST['quotemail']."'";
	}
	if(isset($_POST['palrtemail']) AND $_POST['palrtemail']!=''){
		$q_p[] = "`palrtemail`='".$_POST['palrtemail']."'";
	}
	if(isset($_POST['cc1']) AND $_POST['cc1']!=''){
		$q_p[] = "`cc1`='".$_POST['cc1']."'";
	}
	if(isset($_POST['cc2']) AND $_POST['cc2']!=''){
		$q_p[] = "`cc2`='".$_POST['cc2']."'";
	}
	if(isset($_POST['cc3']) AND $_POST['cc3']!=''){
		$q_p[] = "`cc3`='".$_POST['cc3']."'";
	}
	if(isset($_POST['cc4']) AND $_POST['cc4']!=''){
		$q_p[] = "`cc4`='".$_POST['cc4']."'";
	}
	if(isset($_POST['prcm']) AND $_POST['prcm']!=''){
		$q_p[] = "`pr_contact_m`='".$_POST['prcm']."'";
	}
	if(isset($_POST['prct']) AND $_POST['prct']!=''){
		$q_p[] = "`pr_contact_t`='".$_POST['prct']."'";
	}
	if(isset($_POST['from']) AND $_POST['from']!='' AND in_array($_POST['from'],$post_c)){
		$q_p[] = "`from`='".$_POST['from']."'";
	}
	if(isset($_POST['to']) AND $_POST['to']!='' AND in_array($_POST['to'],$post_c)){
		$q_p[] = "`to`='".$_POST['to']."'";
	}
	if(isset($_POST['fromst']) AND $_POST['fromst']!=''){
		$q_p[] = "`from_st`='".$_POST['fromst']."'";
	}
	if(isset($_POST['tost']) AND $_POST['tost']!=''){
		$q_p[] = "`to_st`='".$_POST['tost']."'";
	}
	if(isset($_POST['fromloc']) AND $_POST['fromloc']!=''){
		$q_p[] = "`from_location`='".$_POST['fromloc']."'";
	}
	if(isset($_POST['toloc']) AND $_POST['toloc']!=''){
		$q_p[] = "`to_location`='".$_POST['toloc']."'";
	}
	if(isset($_POST['itemc']) AND $_POST['itemc']!=''){
		$q_p[] = "`item_c`='".$_POST['itemc']."'";
	}
	if(isset($_POST['item_desc']) AND $_POST['item_desc']!=''){
		$q_p[] = "`item_desc`='".$_POST['item_desc']."'";
	}
	if(isset($_POST['note']) AND $_POST['note']!=''){
		$q_p[] = "`note`='".$_POST['note']."'";
	}
	if(isset($_POST['ptype']) AND $_POST['ptype']!=''){
		$q_p[] = "`pack_type`='".$_POST['ptype']."'";
	}
	if(isset($_POST['insurance']) AND $_POST['insurance']!=''){
		$q_p[] = "`insurance`='".$_POST['insurance']."'";
	}
	if(isset($_POST['tweight']) AND $_POST['tweight']!=''){
		$q_p[] = "`total_weight`='".$_POST['tweight']."'";
	}
	if(isset($_POST['danger']) AND $_POST['danger']!=''){
		$q_p[] = "`danger`='".$_POST['danger']."'";
	}
	if(isset($_POST['chemical']) AND $_POST['chemical']!=''){
		$q_p[] = "`chemical`='".$_POST['chemical']."'";
	}
	if(isset($_POST['lithiumb']) AND $_POST['lithiumb']!=''){
		$q_p[] = "`lithiumb`='".$_POST['lithiumb']."'";
	}
	
	if(isset($_POST['offer_price']) AND $_POST['offer_price']!=''){
		$q_p[] = "`offer_price`='".$_POST['offer_price']."'";
	}
	if(isset($_POST['currency']) AND $_POST['currency']!=''){
		$q_p[] = "`currency`='".$_POST['currency']."'";
	}
	if(isset($_POST['confirm']) AND $_POST['confirm']!=''){
		$q_p[] = "`user_confirm`='".$_POST['confirm']."'";
	}
	if(isset($_POST['paid']) AND $_POST['paid']!='' AND $row['paid']=='no'){
		if($_POST['paid']=='yes' AND $row['uname']!="" AND $row['uname']!=null)
		{
			//var_dump($tmp4);echo "<br>";
			if($tmp4=="" OR $tmp4==null)
				$tmp4 = $row['offered_p'];
			//var_dump($tmp4);echo "<br>";
			$price = $currency = "";
			$t = explode(" | ",$tmp4);
			//var_dump($t);echo "<br>";
			foreach($t as $k=>$v)
			{
				$tt = explode(") ", $v);
				//var_dump($tt);echo "<br>";
				$ttt = explode("=>",$tt[1]);
				//var_dump($ttt);echo "<br>";
				if($ttt[0]=='on')
				{
					$price = $ttt[2];
					$currency = $ttt[3];
					break;
				}
			}
			if($price!="" AND $currency!="")
			{
				
				$ro = mysql_query("SELECT * FROM `users` WHERE `uname`='".$row['uname']."'");
				if(mysql_num_rows($ro)>0)
				{
					$row2 = mysql_fetch_array($ro);
					if(isset($row2[$currency.'_current_balance']) AND (($row2[$currency.'_current_balance']>0 AND $row2[$currency.'_current_balance']>=$price)  OR $row2['mdp']==1))
					{
						//echo "1<br>";
						$price = str_replace(",","",$price);
						$q = "INSERT INTO `transactions` (`oref`, `uref`, `amount`, `currency`, `timestamp`, `description`) VALUES (".$id.", '".$row2['id']."', '".$price."', '".$currency."', '".time()."', 'Transaction has been done by admin');";
						mysql_query($q) or die(mysql_error());
						//echo "2<br>";
						$q = "UPDATE `users` SET `".$currency."_current_balance`= `".$currency."_current_balance` - '".$price."', `".$currency."_total_order_paid`= `".$currency."_total_order_paid` + '".$price."' WHERE `id`=".$row2['id']."";
						mysql_query($q) or die(mysql_error());
						
						$q_p[] = "`paid`='".$_POST['paid']."'";
					}
					else
					{
						echo '<div class="grid_10">
    <div class="box round first">
        <h2>Notifications</h2>
		<div class="block">
			<div class="message error">
				<h5>Error!</h5>
				<p>Error Paid : not enough deposit in '.$currency.'.<br>
				</p>
			</div>
		</div>
	</div>
</div>';
					}
				}
				else
				{
					echo '<div class="grid_10">
    <div class="box round first">
        <h2>Notifications</h2>
		<div class="block">
			<div class="message error">
				<h5>Error!</h5>
				<p>Error Paid : No user found by this username : '.$row['uname'].' .<br>
				</p>
			</div>
		</div>
	</div>
</div>';
				}
			}
			else
			{
				echo '<div class="grid_10">
    <div class="box round first">
        <h2>Notifications</h2>
		<div class="block">
			<div class="message error">
				<h5>Error!</h5>
				<p>Error Paid : no confirmed offer detected.<br>
				</p>
			</div>
		</div>
	</div>
</div>';
			}
		}
		else
		{
			$q_p[] = "`paid`='".$_POST['paid']."'";
		}
	}
	if(isset($_POST['mawb1']) AND $_POST['mawb1']!=''){
		$q_p[] = "`mawb1`='".$_POST['mawb1']."'";
	}
	if(isset($_POST['mawb2']) AND $_POST['mawb2']!=''){
		$q_p[] = "`mawb2`='".$_POST['mawb2']."'";
	}
	if(isset($_POST['admin_note']) AND $_POST['admin_note']!=''){
		$q_p[] = "`admin_note`='".$_POST['admin_note']."'";
	}
	if(isset($_POST['discount']) AND $_POST['discount']!=''){
		$q_p[] = "`discount`='".$_POST['discount']."'";
	}
	if(isset($_POST['discount_type']) AND $_POST['discount_type']!=''){
		$q_p[] = "`discount_type`='".$_POST['discount_type']."'";
	}
	if(isset($_POST['vat']) AND $_POST['vat']!=''){
		$q_p[] = "`vat`='".$_POST['vat']."'";
	}
	if(isset($_POST['export']) AND $_POST['export']!=''){
		$q_p[] = "`export`='".$_POST['export']."'";
	}
	if(isset($_POST['agent_company']) AND $_POST['agent_company']!=''){
		$q_p[] = "`agent_company`='".$_POST['agent_company']."'";
	}
	if(isset($_POST['agent_name']) AND $_POST['agent_name']!=''){
		$q_p[] = "`agent_name`='".$_POST['agent_name']."'";
	}
	//mawb1
	//dif_receive
	if(isset($_POST['dif_receive']) AND $_POST['dif_receive']!=''){
		$q_p[] = "`dif_receive`='".$_POST['dif_receive']."'";
	}
	if(isset($_POST['dif_offer']) AND $_POST['dif_offer']!=''){
		$q_p[] = "`dif_offer`='".$_POST['dif_offer']."'";
	}
	$error = true;
	$error_m = "SomeThing went wrong.";
	if(count($q_p)>0){
		$q = "UPDATE `quote` SET ".implode(",", $q_p)."  WHERE `id`=".$id."";
		mysql_query($q);
		$error = false;
		$error_m = "All changes saved successfully.";
	}
}
elseif(isset($_POST['t']) AND $_POST['t']=='upload')
{
	$locations = dirname(__DIR__) . DIRECTORY_SEPARATOR  ."Documents" . DIRECTORY_SEPARATOR .$id. DIRECTORY_SEPARATOR  ."";
	//echo $locations."<br>";
	if(!is_dir($locations))
	{
		mkdir($locations, 0755, true);
	}
	if(isset($_FILES['uploaded_file']['name']) AND is_array($_FILES['uploaded_file']['name']) AND count($_FILES['uploaded_file']['name'])>0){
		foreach($_FILES['uploaded_file']['name'] as $k => $upload){
			if(isset($_FILES['uploaded_file']['name'][$k]) AND $_FILES['uploaded_file']['name'][$k] !="" AND $_FILES['uploaded_file']['name'][$k]!=null){
				
				$target_dir = $locations;
				
				$target_file = $target_dir . basename($_FILES['uploaded_file']['name'][$k]);
				$uploadOk = 1;
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				$format = explode(".",basename($_FILES['uploaded_file']['name'][$k]));
				$format = strtolower($format[(count($format)-1)]);
				$filename = basename($_FILES['uploaded_file']['name'][$k]);
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
						
					}
				}
			}
		}
	}
}
// /home/bookingparcel/public_html/admin
// /home/bookingparcel/public_html
// /home/bookingparcel/public_html/admin/itemedit.php
// /home/bookingparcel/public_html/admin
// /home/bookingparcel/public_html
// echo __DIR__ ."<br>";
// echo dirname(__DIR__) ."<br>";
// echo __FILE__ ."<br>";
// echo dirname(__FILE__) ."<br>";
// echo dirname(dirname(__FILE__)) ."<br>";

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
$q = "select * from `invoices` WHERE `qref`=".$id." ORDER BY `timestamp` DESC";
$inv_q = mysql_query($q);

$output = "";
$q = "SELECT * FROM `quote` WHERE `id`=".$id."";
$r = mysql_query($q) or die(mysql_error());
if(mysql_num_rows($r)>0){
	$_c = 1;
	$row = mysql_fetch_array($r);
		/*$output .="<tr>";
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
		$output .="<td >".$row['dims']."</td>";
		$output .="<td >".$row['total_weight']."</td>";
		$output .="<td >".$row['item_desc']."</td>";
		$output .="</tr>";*/
}
else{
	$output = "<tr><td colspan=\"15\">No Entery Detected</td></tr>";
}
?>

        <div class="grid_10">
            <div class="box round first">
                <h2>Edit Order</h2>
                <div class="block">
<?php				
if($_c==1){
	echo "Item ID : ".$id."<br>";
	echo "Tracking ID : ".$row['tid']."<br>";
	/*echo "First Name : ".$row['fname']."<br>";
	echo "Last Name : ".$row['lname']."<br>";
	echo "Company : ".$row['company']."<br>";
	echo "Phone : ".$row['phone']."<br>";
	echo "E-mail : ".$row['email']."<br>";
	echo "Prefered Contact Method : ".$row['pr_contact_m']."<br>";
	echo "Prefered Contact Time : ".$row['pr_contact_t']."<br>";
	echo "Note : ".$row['note']."<br><br>";
	echo "Shipping Date : ".$row['date']."<br>";
	echo "Exact Date : ".$row['exact_date']."<br><br><br>";*/
}
$st = "Pending";
$color = "999";
if($row['status']==1){
	$color = "066ECD";
	$st = "Under Process";
}
elseif($row['status']==2){
	$color = "77B32F";
	$st = "Active";
}
elseif($row['status']==3){
	$color = "E40001";
	$st = "Cancelled";
}
elseif($row['status']==4){
	$color = "39A7B6";
	$st = "Compeleted";
}
$error_m ="";
?>
				<p class="start"><div style="background-color:#<?php echo $color; ?>;color:#ffffff;width:99%;height:25px;font-size:16px;text-align:center;">Current Status: <?php echo $st; ?></div></p>
<form action="" method="post">
<input type="hidden" name="t" value="1">
<table border="1" style="margin-left:auto;margin-right:auto;width:90%;border-collapse:collapse;border-color:#777;font-size:12px">
	<tbody>
		<tr style="background-color:#ccc;text-align:center;color:#3a3a3a">
			<td colspan='8' style="padding:5px">Details</td>
		</tr>
		<tr>
			<td colspan="2" style="padding:5px">Name</td>
			<td colspan="2" style="padding:5px"><input name="name" type="text" value="<?php echo $row['fname']; ?>"></td>
			<td style="padding:5px">Company</td>
			<td style="padding:5px"><input name="cname" type="text" value="<?php echo $row['company']; ?>"></td>
			<td style="padding:5px">Order Status</td>
			<td style="padding:5px">
				<select name="status">
					<option value="0" <?php if($row['status']==0) echo "selected='selected'";?> style="background-color:#999;color:#ffffff;">Pending</option>
					<option value="1" <?php if($row['status']==1) echo "selected='selected'";?> style="background-color:#066ECD;color:#ffffff;">Under Process</option>
					<option value="2" <?php if($row['status']==2) echo "selected='selected'";?> style="background-color:#77B32F;color:#ffffff;">Active</option>
					<option value="3" <?php if($row['status']==3) echo "selected='selected'";?> style="background-color:#E40001;color:#ffffff;">Cancelled</option>
					<option value="4" <?php if($row['status']==4) echo "selected='selected'";?> style="background-color:#39A7B6;color:#ffffff;">Compeleted</option>
				</select>
			</td>
		</tr>
		<tr>
			<td style="padding:5px">Phone</td>
			<td style="padding:5px"><input name="phone" type="text" value="<?php echo $row['phone']; ?>"></td>
			<td style="padding:5px">Primary E-Mail</td>
			<td style="padding:5px"><input name="email" type="text" value="<?php echo $row['email']; ?>"></td>
			<td style="padding:5px">Pref. Contact Method</td>
			<td style="padding:5px"><input name="prcm" type="text" value="<?php echo $row['pr_contact_m']; ?>"></td>
			<td style="padding:5px">Pref. Contact Time</td>
			<td style="padding:5px"><input name="prct" type="text" value="<?php echo $row['pr_contact_t']; ?>"></td>
		</tr>
		<tr>
			<td style="padding:5px">Pre-Alert E-mail</td>
			<td style="padding:5px"><input name="palrtemail" type="text" value="<?php echo $row['palrtemail']; ?>"></td>
			<td style="padding:5px">Invoice E-Mail</td>
			<td style="padding:5px"><input name="invemail" type="text" value="<?php echo $row['invemail']; ?>"></td>
			<td style="padding:5px">Quote E-mail</td>
			<td style="padding:5px"><input name="quotemail" type="text" value="<?php echo $row['quotemail']; ?>"></td>
			<td style="padding:5px">Other CC</td>
			<td style="padding:5px">
				cc1 : <input name="cc1" type="text" value="<?php echo $row['cc1']; ?>"><br>
				cc2 : <input name="cc2" type="text" value="<?php echo $row['cc2']; ?>"><br>
				cc3 : <input name="cc3" type="text" value="<?php echo $row['cc3']; ?>"><br>
				cc4 : <input name="cc4" type="text" value="<?php echo $row['cc4']; ?>"><br>
			</td>
		</tr>
		<tr style="background-color:#ccc;text-align:center;color:#3a3a3a">
			<td colspan='8' style="padding:5px">Collection Details</td>
		</tr>
		<tr>
			<td style="padding:5px" colspan="2">Country</td>
			<td style="padding:5px" colspan="2">
				<select name="from">
					<?php foreach($post_c as $k=>$v){ echo "<option value='".$v."' ".($v==''.$row['from'].'' ? 'selected="selected"' : '').">".$v."</option>"; } ?>
				</select>
			</td>
			<td style="padding:5px">State</td>
			<td style="padding:5px"><input name="fromst" type="text" value="<?php echo $row['from_st']; ?>"></td>
			<td style="padding:5px">Location</td>
			<td style="padding:5px"><input name="fromloc" type="text" value="<?php echo $row['from_location']; ?>"></td>
		</tr>
		<tr style="background-color:#ccc;text-align:center;color:#3a3a3a">
			<td colspan='8' style="padding:5px">Destination Details</td>
		</tr>
		<tr>
			<td style="padding:5px" colspan="2">Country</td>
			<td style="padding:5px" colspan="2">
				<select name="to">
					<?php foreach($post_c as $k=>$v){ echo "<option value='".$v."' ".($v==''.$row['to'].'' ? 'selected="selected"' : '').">".$v."</option>"; } ?>
				</select>
			</td>
			<td style="padding:5px">State</td>
			<td style="padding:5px"><input name="tost" type="text" value="<?php echo $row['to_st']; ?>"></td>
			<td style="padding:5px">Location</td>
			<td style="padding:5px"><input name="toloc" type="text" value="<?php echo $row['to_location']; ?>"></td>
		</tr>
		<tr style="background-color:#ccc;text-align:center;color:#3a3a3a">
			<td colspan='8' style="padding:5px">Shipping Details</td>
		</tr>
		<tr>
			<td style="padding:5px">Item Count</td>
			<td style="padding:5px"><input name="itemc" type="text" value="<?php echo $row['item_c']; ?>"></td>
			<td style="padding:5px">Dimensions</td>
			<td style="padding:5px" colspan="2">
				<div id="dimss_d">
					<?php 
					if($row['dims']!=""){
						$cities = explode(" kg | ",$row['dims']);
						$_c = 1;
						foreach($cities as $k=>$v){
							if($v!=''){
								$tmp = explode(" => ",$v);
								$ttmp = explode(") ",$tmp[0]);
					?>
					<p>
						<label for="dimss"><input type="text" id="dimss" size="20" name="dimss[]" value="<?php echo $ttmp[1]; ?>" placeholder="Dimensions" /><input type="text" id="weights" size="3" name="weights[]" value="<?php echo $tmp[1]; ?>" placeholder="Weight" /></label>
						<?php 
							echo '<a href="#" id="addScnt"><img src="../post_forms/images/icons/fam/add.png"></a><a href="#" id="remScnt"><img src="../post_forms/images/icons/fam/delete.png"></a>';
					
							echo '</p>';
							$_c++;
							}
						}
					}
					else{
					?>
					<p>
						<label for="dimss"><input type="text" id="dimss" size="20" name="dimss[]" value="" placeholder="Dimensions" /><input type="text" id="weights" size="3" name="weights[]" value="" placeholder="Weight" /></label><a href="#" id="addScnt"><img src="../post_forms/images/icons/fam/add.png"></a><a href="#" id="remScnt"><img src="../post_forms/images/icons/fam/delete.png"></a>
					</p>
					<?php
					}
					?>
				</div></td>
			<td style="padding:5px">Package Type
				<select name="ptype">
					<option value="Personal" <?php if($row['pack_type']=='Personal') ?>>Personal</option>
					<option value="Commercial" <?php if($row['pack_type']=='Commercial') ?>>Commercial</option>
				</select>
			</td>
			<td style="padding:5px">Insurace</td>
			<td style="padding:5px">
				<select name="insurance">
					<option value="Yes" <?php if($row['insurance']=='Yes') ?>>Yes</option>
					<option value="No" <?php if($row['insurance']=='No') ?>>No</option>
					<option value="Not Sure" <?php if($row['insurance']=='Not Sure') ?>>Not Sure</option>
				</select>
			</td>
		</tr>
		<tr>
			<td style="padding:5px" colspan="1">Total Weight</td>
			<td style="padding:5px" colspan="1"><input type="text" name="tweight" value="<?php echo $row['total_weight']; ?>" placeholder="Total Package Weight"></td>
			<td style="padding:5px" colspan="1">Item Description</td>
			<td style="padding:5px" colspan="1"><textarea name="item_desc" placeholder="Any further information will be add here" col="30" rows="7"><?php echo $row['item_desc']; ?></textarea></td>
			<td style="padding:5px" colspan="1">Note - Goods Value</td>
			<td style="padding:5px" colspan="1"><textarea name="note" placeholder="Goods value will be add here" col="30" rows="7"><?php echo $row['note']; ?></textarea></td>
			<td style="padding:5px" colspan="1">Admin Note</td>
			<td style="padding:5px" colspan="1"><textarea name="admin_note" placeholder="Just can be seen here" col="30" rows="7"><?php echo $row['admin_note']; ?></textarea></td>
		</tr>
		<tr>
			<td colspan="1" style="padding:5px"><span class="danger"></span><br>Is it your cargo DG (Dangerous Goods)?</td>
			<td style="padding:5px">
				<input name="danger" value="Yes" type="radio" id="dg_yes" <?php if($row['danger']=="Yes") echo "checked='checked'"; ?>><label for="dg_yes">Yes</label><br>
				<input name="danger" value="No" type="radio" id="dg_no" <?php if($row['danger']=="No") echo "checked='checked'"; ?>><label for="dg_no">No</label>
			</td>
			<td colspan="1" style="padding:5px"><span class="chemical"></span><br>Is there any liquid, gas or chemicals inside of your cargo?</td>
			<td style="padding:5px">
				<input name="chemical" value="Yes" type="radio" id="chemical_yes" <?php if($row['chemical']=="Yes") echo "checked='checked'"; ?>><label for="chemical_yes">Yes</label><br>
				<input name="chemical" value="No" type="radio" id="chemical_no" <?php if($row['chemical']=="No") echo "checked='checked'"; ?>><label for="chemical_no">No</label>
			</td>
			<td style="padding:5px"><span class="battry"></span><br>Is there any lithium battery in the cargo?</td>
			<td style="padding:5px">
				<input name="lithiumb" value="Yes" type="radio" id="battry_yes" <?php if($row['lithiumb']=="Yes") echo "checked='checked'"; ?>><label for="battry_yes">Yes</label><br>
				<input name="lithiumb" value="No" type="radio" id="battry_no" <?php if($row['lithiumb']=="No") echo "checked='checked'"; ?>><label for="battry_no">No</label>
			</td>
			<td style="padding:5px">Order Status (for user)</td>
			<td style="padding:5px">
				<select name="status_user">
					<option value="0" <?php if($row['status_user']==0) echo "selected='selected'";?> style="background-color:#999;color:#ffffff;">Pending</option>
					<option value="1" <?php if($row['status_user']==1) echo "selected='selected'";?> style="background-color:#066ECD;color:#ffffff;">Under Process</option>
					<option value="2" <?php if($row['status_user']==2) echo "selected='selected'";?> style="background-color:#77B32F;color:#ffffff;">Active</option>
					<option value="3" <?php if($row['status_user']==3) echo "selected='selected'";?> style="background-color:#E40001;color:#ffffff;">Cancelled</option>
					<option value="4" <?php if($row['status_user']==4) echo "selected='selected'";?> style="background-color:#39A7B6;color:#ffffff;">Compeleted</option>
				</select>
			</td>
		</tr>
		<tr>
			<td style="padding:5px" colspan="1">OFAC</td>
			<td style="padding:5px" colspan="1"><?php echo $row['ofac']; ?></td>
			<td style="padding:5px" colspan="1">TSA</td>
			<td style="padding:5px" colspan="1"><?php echo $row['tsa']; ?></td>
			<td style="padding:5px" colspan="1">Transit via other country</td>
			<td style="padding:5px" colspan="1"><?php echo $row['transit']; ?></td>
			<td style="padding:5px" colspan="1">Transit country</td>
			<td style="padding:5px" colspan="1"><?php echo $row['transit_country']; ?></td>
		</tr>
		<tr style="background-color:#ccc;text-align:center;color:#3a3a3a">
			<td colspan='8' style="padding:5px">Financial Details and Confirmaion</td>
		</tr>
		<tr>
			<td colspan="1" style="padding:5px"><label for="r_price_n">Recieved Quote Cost : </label></td>
			<td colspan="2" style="padding:5px">
				<div id="prices_d">
					<input type="checkbox" name="auto_off" value="yes">&nbsp;&nbsp;Auto add offered prices?<br>
					<?php 
					$_c = 0;
					$currency ="";
					if($row['received_p']!=""){
						$prices = explode(" | ",$row['received_p']);
						foreach($prices as $k=>$v){
							if($v!=''){
								$tmp = explode(") ",$v);
								$ttmp = explode("=>",$tmp[1]);
								$disabled = "";
								if($ttmp[0]=='on')
								{
									$currency = $ttmp[3];
									$disabled = "disabled";
									break;
								}
							}
						}
						foreach($prices as $k=>$v){
							if($v!=''){
								$tmp = explode(") ",$v);
								$ttmp = explode("=>",$tmp[1]);// style="border:1px solid #ff0000"
								echo '<p>';
								echo '<label for="prices">';
								echo '<input type="radio" name="r_price_r" id="r_price_r" value="'.$_c.'" '.($ttmp[0]=='on' ? 'checked="checked"' : '').' '.$disabled.'>&nbsp;';
								echo '<input type="text" name="r_price_n[]" id="r_price_n" value="'.$ttmp[1].'" placeholder="Method Name" '.$disabled.''.($ttmp[0]=='on' ? ' style="border:2px solid #33cc33"' : '').'>&nbsp;';
								echo '<input type="text" name="r_price_p[]" id="r_price_p" value="'.$ttmp[2].'" placeholder="Price" size="6" '.$disabled.''.($ttmp[0]=='on' ? ' style="border:2px solid #33cc33"' : '').'>&nbsp;';
								echo '<select name="r_price_c[]" '.$disabled.'>
										<option value="GBP" '.($ttmp[3]=='GBP' ? 'selected="selected"' : '').'>GBP</option>
										<option value="USD" '.($ttmp[3]=='USD' ? 'selected="selected"' : '').'>USD</option>
										<option value="EUR" '.($ttmp[3]=='EUR' ? 'selected="selected"' : '').'>EUR</option>
										<option value="IRR" '.($ttmp[3]=='IRR' ? 'selected="selected"' : '').'>IRR</option>
										<option value="CHF" '.($ttmp[3]=='CHF' ? 'selected="selected"' : '').'>CHF</option>
										<option value="DKK" '.($ttmp[3]=='DKK' ? 'selected="selected"' : '').'>DKK</option>
										<option value="HKD" '.($ttmp[3]=='HKD' ? 'selected="selected"' : '').'>HKD</option>
										<option value="SGD" '.($ttmp[3]=='SGD' ? 'selected="selected"' : '').'>SGD</option>
										<option value="SEK" '.($ttmp[3]=='SEK' ? 'selected="selected"' : '').'>SEK</option>
										<option value="CAD" '.($ttmp[3]=='CAD' ? 'selected="selected"' : '').'>CAD</option>
										<option value="AED" '.($ttmp[3]=='AED' ? 'selected="selected"' : '').'>AED</option>
										<option value="JYP" '.($ttmp[3]=='JYP' ? 'selected="selected"' : '').'>JYP</option>
										<option value="CNH" '.($ttmp[3]=='CNH' ? 'selected="selected"' : '').'>CNH</option>
										<option value="TRY" '.($ttmp[3]=='TRY' ? 'selected="selected"' : '').'>TRY</option>
										<option value="PUR" '.($ttmp[3]=='PUR' ? 'selected="selected"' : '').'>PUR</option>
									</select>';
								echo '</label><a href="#" id="addScnt3" '.(($disabled == "disabled") ? 'style="display: none;"' : '' ).'><img src="../post_forms/images/icons/fam/add.png"></a><a href="#" id="remScnt3" '.(($disabled == "disabled") ? 'style="display: none;"' : '' ).'><img src="../post_forms/images/icons/fam/delete.png"></a>';
								echo '</p>';
								$_c++;
							}
						}
					}
					else{
					?>
					<p>
						<label for="prices">
							<input type="radio" name="r_price_r" id="r_price_r" value="<?php echo $_c;?>">&nbsp;
							<input type="text" name="r_price_n[]" id="r_price_n" value="" placeholder="Method Name">&nbsp;
							<input type="text" name="r_price_p[]" id="r_price_p" value="" placeholder="Price" size="6">&nbsp;
							<select name="r_price_c[]">
								<option value="GBP">GBP</option>
								<option value="USD">USD</option>
								<option value="EUR" selected="selected">EUR</option>
								<option value="IRR">IRR</option>
								<option value="CHF">CHF</option>
								<option value="DKK">DKK</option>
								<option value="HKD">HKD</option>
								<option value="SGD">SGD</option>
								<option value="SEK">SEK</option>
								<option value="CAD">CAD</option>
								<option value="AED">AED</option>
								<option value="JYP">JYP</option>
								<option value="CNH">CNH</option>
								<option value="TRY">TRY</option>
								<option value="PUR">PUR</option>
							</select>
						</label>
						<a href="#" id="addScnt3"><img src="../post_forms/images/icons/fam/add.png"></a>
						<a href="#" id="remScnt3"><img src="../post_forms/images/icons/fam/delete.png"></a>
					</p>
					<?php
					}
					echo "</div>";
					if($disabled == "disabled")
					{
?>
<script language="javascript">
var status = '<?php echo $disabled; ?>';
$(document).ready(function () {
	$('#cmn-toggle-1').click(function(event) {   
		if(status==='disabled')
		{
			$('#prices_d p label :input').removeAttr('disabled');
			$('#prices_d p a').show();
			status = "enabled";
		}
		else
		{
			$('#prices_d p label :input').attr('disabled',true);
			$('#prices_d p a').hide();
			status = 'disabled';
		}
	});
});
</script>
<?php
						echo "<div class='settings'>";
						echo '<div class="question">Unlock?</div>
							  <div class="switch">
								<input id="cmn-toggle-1" class="cmn-toggle cmn-toggle-yes-no" type="checkbox">
								<label for="cmn-toggle-1" data-on="No" data-off="Yes"></label>
							  </div>';
						echo "</div>";
					}
					if($disabled == "disabled")
					{
					?>
					<div>
					Difference Cost : <input type="text" name="dif_receive" value="<?php echo number_format($row['dif_receive'],2); ?>"> <?php echo $currency; ?>
					</div>
					<?php } ?>
			</td>
			<td colspan="1"><label for="offer_price">Our Offer Price : </label></td>
			<td colspan="3">
				<div id="oprices_d">
					<?php 
					$conf_prices = "";
					$currency = "";
					$_c = 0;
					if($row['offered_p']!=""){
						$prices = explode(" | ",$row['offered_p']);
						foreach($prices as $k=>$v){
							if($v!=''){
								$tmp = explode(") ",$v);
								$ttmp = explode("=>",$tmp[1]);
								$disabled = "";
								if($ttmp[0]=='on')
								{
									$disabled = "disabled";
									$currency = $ttmp[3];
									$conf_prices = "offer confirmed by client for  ".$ttmp[2]." ".$ttmp[3]." by ".$ttmp[1];
									break;
								}
							}
						}
						foreach($prices as $k=>$v){
							if($v!=''){
								$tmp = explode(") ",$v);
								$ttmp = explode("=>",$tmp[1]);
								echo '<p>';
								echo '<label for="oprices">';
								echo '<input type="radio" name="o_price_r" id="o_price_r" value="'.$_c.'" '.($ttmp[0]=='on' ? 'checked="checked"' : '').' '.$disabled.'>&nbsp;';
								echo '<input type="text" name="o_price_n[]" id="o_price_n" value="'.$ttmp[1].'" placeholder="Method Name" '.$disabled.''.($ttmp[0]=='on' ? ' style="border:2px solid #33cc33"' : '').'>&nbsp;';
								echo '<input type="text" name="o_price_p[]" id="o_price_p" value="'.$ttmp[2].'" placeholder="Price" size="6" '.$disabled.''.($ttmp[0]=='on' ? ' style="border:2px solid #33cc33"' : '').'>&nbsp;';
								echo '<select name="o_price_c[]" '.$disabled.'>
										<option value="GBP" '.($ttmp[3]=='GBP' ? 'selected="selected"' : '').'>GBP</option>
										<option value="USD" '.($ttmp[3]=='USD' ? 'selected="selected"' : '').'>USD</option>
										<option value="EUR" '.($ttmp[3]=='EUR' ? 'selected="selected"' : '').'>EUR</option>
										<option value="IRR" '.($ttmp[3]=='IRR' ? 'selected="selected"' : '').'>IRR</option>
										<option value="CHF" '.($ttmp[3]=='CHF' ? 'selected="selected"' : '').'>CHF</option>
										<option value="DKK" '.($ttmp[3]=='DKK' ? 'selected="selected"' : '').'>DKK</option>
										<option value="HKD" '.($ttmp[3]=='HKD' ? 'selected="selected"' : '').'>HKD</option>
										<option value="SGD" '.($ttmp[3]=='SGD' ? 'selected="selected"' : '').'>SGD</option>
										<option value="SEK" '.($ttmp[3]=='SEK' ? 'selected="selected"' : '').'>SEK</option>
										<option value="CAD" '.($ttmp[3]=='CAD' ? 'selected="selected"' : '').'>CAD</option>
										<option value="AED" '.($ttmp[3]=='AED' ? 'selected="selected"' : '').'>AED</option>
										<option value="JYP" '.($ttmp[3]=='JYP' ? 'selected="selected"' : '').'>JYP</option>
										<option value="CNH" '.($ttmp[3]=='CNH' ? 'selected="selected"' : '').'>CNH</option>
										<option value="TRY" '.($ttmp[3]=='TRY' ? 'selected="selected"' : '').'>TRY</option>
										<option value="PUR" '.($ttmp[3]=='PUR' ? 'selected="selected"' : '').'>PUR</option>
									</select>';
								echo '</label><a href="#" id="addScnt4" '.(($disabled == "disabled") ? 'style="display: none;"' : '' ).'><img src="../post_forms/images/icons/fam/add.png"></a><a href="#" id="remScnt4" '.(($disabled == "disabled") ? 'style="display: none;"' : '' ).'><img src="../post_forms/images/icons/fam/delete.png"></a>';
								echo '</p>';
								$_c++;
							}
						}
					}
					else{
					?>
					<p>
						<label for="oprices">
							<input type="radio" name="o_price_r" id="r_price_r" value="<?php echo $_c;?>">&nbsp;
							<input type="text" name="o_price_n[]" id="r_price_n" value="" placeholder="Method Name">&nbsp;
							<input type="text" name="o_price_p[]" id="r_price_p" value="<?php if($row['offer_price']!=0 AND $row['offer_price']!=''){ echo $row['offer_price']; }?>" placeholder="Price" size="6">&nbsp;
							<select name="o_price_c[]">
								<option value="GBP" <?php if($row['offer_price']!=0 AND $row['offer_price']!='' AND $row['currency']=='GBP'){ echo 'selected="selected"'; }?>>GBP</option>
								<option value="USD" <?php if($row['offer_price']!=0 AND $row['offer_price']!='' AND $row['currency']=='USD'){ echo 'selected="selected"'; }?>>USD</option>
								<option value="EUR" <?php if($row['offer_price']!=0 AND $row['offer_price']!='' AND $row['currency']=='EUR'){ echo 'selected="selected"'; }?>>EUR</option>
								<option value="IRR" <?php if($row['offer_price']!=0 AND $row['offer_price']!='' AND $row['currency']=='IRR'){ echo 'selected="selected"'; }?>>IRR</option>
							</select>
						</label>
						<a href="#" id="addScnt4"><img src="../post_forms/images/icons/fam/add.png"></a>
						<a href="#" id="remScnt4"><img src="../post_forms/images/icons/fam/delete.png"></a>
					</p>
					<?php
					}
					echo "</div>";
					if($disabled == "disabled")
					{
?>
<script language="javascript">
var status2 = '<?php echo $disabled; ?>';
$(document).ready(function () {
	$('#cmn-toggle-2').click(function(event) {   
		if(status2==='disabled')
		{
			$('#oprices_d p label :input').removeAttr('disabled');
			$('#oprices_d p a').show();
			status2 = "enabled";
		}
		else
		{
			$('#oprices_d p label :input').attr('disabled',true);
			$('#oprices_d p a').hide();
			status2 = 'disabled';
		}
	});
});
</script>
<?php
						echo "<div class='settings'>";
						echo '<div class="question">Unlock?</div>
							  <div class="switch">
								<input id="cmn-toggle-2" class="cmn-toggle cmn-toggle-yes-no" type="checkbox">
								<label for="cmn-toggle-2" data-on="No" data-off="Yes"></label>
							  </div>';
						echo "</div>";
					}
					if($disabled == "disabled")
					{
					?>
					<div>
					Difference Cost : <input type="text" name="dif_offer" value="<?php echo number_format($row['dif_offer'],2); ?>"> <?php echo $currency; ?>
					</div>
					<?php } ?>
				</td>
			<td colspan="1"><?php echo $conf_prices; ?></td>
		</tr>
		<tr>
			<td colspan="1" style="padding:5px"><label for="offer_price">Agents Choosen For the Job : </label></td>
			<td colspan="2" style="padding:5px">
				<input type="text" name="agent_name" id="keyword" size="10" autocomplete="off" value="<?php echo $row['agent_name']; ?>" placeholder="Enter agent name">
				<input type="text" name="agent_company" id="keyword2" size="10" autocomplete="off" value="<?php echo $row['agent_company']; ?>" placeholder="Enter agent Company">
				
			</td>
			<td colspan="1" style="padding:5px">User Confirmmed The Order?</td>
			<td colspan="2" style="padding:5px">
				<input type="radio" id="pending" name="confirm" value="pending" <?php if($row['user_confirm']=='pending') echo "checked ='true'";?> ><label for="pending">Pending</label>&nbsp;&nbsp;&nbsp;
				<input type="radio" id="no" name="confirm" value="no" <?php if($row['user_confirm']=='no') echo "checked ='true'";?> ><label for="no">No</label>&nbsp;&nbsp;&nbsp;
				<input type="radio" id="yes" name="confirm" value="yes" <?php if($row['user_confirm']=='yes') echo "checked ='true'";?> ><label for="yes">Yes</label>&nbsp;
			</td>
			<td colspan="1" style="padding:5px">Client Paid?</td>
			<td colspan="1" style="padding:5px">
				<input type="radio" id="paidno" name="paid" value="no" <?php if($row['paid']=='no') echo "checked ='true'";?> ><label for="paidno">No</label>&nbsp;&nbsp;&nbsp;
				<input type="radio" id="paidyes" name="paid" value="yes" <?php if($row['paid']=='yes') echo "checked ='true'";?> ><label for="paidyes">Yes</label>&nbsp;
			</td>
		</tr>
		<tr>
			<td colspan="1" style="padding:5px"><label for="discount">Area agent commission : </label></td>
			<td colspan="2" style="padding:5px">
				<input type="number" name="discount" id="discount" value="<?php echo $row['discount']; ?>">&nbsp;&nbsp;
				<select name="discount_type">
					<option value="percent" <?php if($row['discount_type']=='percent') echo "selected='selected'";?>>Percent</option>
					<option value="amount" <?php if($row['discount_type']=='amount') echo "selected='selected'";?>>Amount</option>
				</select>
			</td>
			<td colspan="1" style="padding:5px"><label for="vat">VAT : </label></td>
			<td colspan="1" style="padding:5px"><input type="number" name="vat" id="vat" value="<?php echo $row['vat']; ?>" size="5" min="0" max="100">&nbsp;%</td>
			<td colspan="1" style="padding:5px"><label for="export">Export Type : </label></td>
			<td colspan="2" style="padding:5px">
				<input type="radio" id="international" name="export" value="international" <?php if($row['export']=='international') echo "checked ='true'";?> ><label for="international">International Export</label>&nbsp;&nbsp;&nbsp;
				<input type="radio" id="domestic" name="export" value="domestic" <?php if($row['export']=='domestic') echo "checked ='true'";?> ><label for="domestic">Domestic</label>&nbsp;&nbsp;&nbsp;
			</td>
			
		</tr>
		<tr style="background-color:#ccc;text-align:center;color:#3a3a3a">
			<td colspan='8' style="padding:5px">Shipping Details</td>
		</tr>
		<tr>
			<td colspan="1" style="padding:5px">MAWB</td>
			<td colspan="2" style="padding:5px">
				<input type="text" name="mawb1" value="<?php echo $row['mawb1']; ?>" size="3" maxlength="3">&nbsp;-&nbsp;
				<input type="text" name="mawb2" value="<?php echo $row['mawb2']; ?>" size="9" maxlength="9">&nbsp;
				<!--<input type="text" name="mawb3" value="<?php echo $row['mawb3']; ?>" size="4" maxlength="4">&nbsp;-->
			</td>
			<td colspan="1" style="padding:5px">HAWB</td>
			<td colspan="4" style="padding:5px">
				<div id="HAWB_d">
					<?php 
					if($row['hawb']!=""){
						$hawbs = explode("|",$row['hawb']);
						foreach($hawbs as $k=>$v){
							if($v!=''){
								$tmp = explode(" => ",$v);
								$ttmp = explode(") ",$tmp[0]);
								echo '<p>
									<label><input type="text" name="hawb1[]" value="'.$ttmp[1].'" size="40" placeholder="Consignee\'s name">&nbsp;-&nbsp;
									<input type="text" name="hawb2[]" value="'.$tmp[1].'" size="15" placeholder="reference"></label>&nbsp;
									<a href="#" id="addScnt2"><img src="../post_forms/images/icons/fam/add.png"></a>&nbsp;
									<a href="#" id="remScnt2"><img src="../post_forms/images/icons/fam/delete.png"></a>&nbsp;&nbsp;&nbsp;
								<p>';
							}
						}
					}
					else{
					?>
					<p>
						<label><input type="text" name="hawb1[]" value="" size="40" placeholder="Consignee's name">&nbsp;-&nbsp;<input type="text" name="hawb2[]" value="" placeholder="reference"></label>&nbsp;<a href="#" id="addScnt2"><img src="../post_forms/images/icons/fam/add.png"></a>&nbsp;<a href="#" id="remScnt2"><img src="../post_forms/images/icons/fam/delete.png"></a>&nbsp;&nbsp;&nbsp;
					<p>
					<?php
					}
					?>
				</div>
			</td>
		</tr>
		<tr style="background-color:#ccc;text-align:center;color:#3a3a3a">
			<td colspan='8' style="padding:5px">Invoice Details</td>
		</tr>
		<tr>
		<?php if($row['paid']=='yes'){?>
			<td style="padding:5px;text-align:center;" colspan="4"><button class="btn btn-green" name="submit" type="button" onclick="window.open('invoice.php?id=<?php echo $id;?>&type=1','invoice','scrollbars=yes,status=yes,resizable=yes,toolbar=yes,width=980,height=600');return false;">Create Invoice For Customer</button></td>
			<td style="padding:5px;text-align:center;" colspan="4"><button class="btn btn-teal" name="submit" type="button" onclick="window.open('invoice.php?id=<?php echo $id;?>&type=0','invoice','scrollbars=yes,status=yes,resizable=yes,toolbar=yes,width=980,height=600');return false;">Create Invoice For Office</button></td>
		<?php 
		}
		else{?>
			<td style="padding:5px;text-align:center;" colspan="4"><button class="btn btn-grey " name="submit" type="button">Create Invoice For Customer (Not Paid Yet)</button></td>
			<td style="padding:5px;text-align:center;" colspan="4"><button class="btn btn-grey " name="submit" type="button">Create Invoice For Office (Not Paid Yet)</button></td>
		<?php 
		}
		?>
		</tr>
		<tr>
			<td style="padding:5px;text-align:center;" colspan="3">
				<button class="btn btn-teal" name="submit" type="button" onclick="window.open('shipping1.php?id=<?php echo $id;?>','invoice','scrollbars=yes,status=yes,resizable=yes,toolbar=yes,width=980,height=600');return false;">
					Step 1 : Letter to shipper
				</button>
			</td>
			<td style="padding:5px;text-align:center;" colspan="3">
				<button class="btn btn-teal" name="submit" type="button" onclick="window.open('shipping2.php?id=<?php echo $id;?>','invoice','scrollbars=yes,status=yes,resizable=yes,toolbar=yes,width=980,height=600');return false;">
					Step 2 : Letter to shipper and agent
				</button>
			</td>
			<td style="padding:5px;text-align:center;" colspan="2">
				<button class="btn btn-teal" name="submit" type="button" onclick="window.open('shipping.php?id=<?php echo $id;?>','invoice','scrollbars=yes,status=yes,resizable=yes,toolbar=yes,width=980,height=600');return false;">
					Step 3: Shipper instruction 
				</button>
			</td>
		</tr>
		<tr>
			<td style="padding:5px;text-align:center;" colspan="8"><button class="btn" name="submit" type="submit">Save</button></td>
		</tr>
	</tbody>
</table>
</form>
<div><span style="color:#ff0000;font-weight:200%;">Important Note : </span>You must first have a offered price confirmed then try to mark the order as paid. After marking the order as paid, the amount will be subtracted from the user deposit.</div>
                </div>
            </div>
        </div>
		
        <div class="grid_10">
            <div class="box round first">
                <h2>Upload New Files</h2>
                <div class="block">
					<p class="start">You can upload some files to send them directly in emails download them in case you need.<br>
					you can upload upto 10 files per using this part.
					</p>
					<form method="post" enctype="multipart/form-data">
						<input type="hidden" name="t" value="upload">
						File&nbsp;1&nbsp;:&nbsp;<input type="file" id="attachment" name="uploaded_file[]" accept=".gif,.jpg,.jpeg,.png,.pdf,.zip,.rtf,.doc,.docx,.xls,.xlsx"><br>
						File&nbsp;2&nbsp;:&nbsp;<input type="file" id="attachment" name="uploaded_file[]" accept=".gif,.jpg,.jpeg,.png,.pdf,.zip,.rtf,.doc,.docx,.xls,.xlsx"><br>
						File&nbsp;3&nbsp;:&nbsp;<input type="file" id="attachment" name="uploaded_file[]" accept=".gif,.jpg,.jpeg,.png,.pdf,.zip,.rtf,.doc,.docx,.xls,.xlsx"><br>
						File&nbsp;4&nbsp;:&nbsp;<input type="file" id="attachment" name="uploaded_file[]" accept=".gif,.jpg,.jpeg,.png,.pdf,.zip,.rtf,.doc,.docx,.xls,.xlsx"><br>
						File&nbsp;5&nbsp;:&nbsp;<input type="file" id="attachment" name="uploaded_file[]" accept=".gif,.jpg,.jpeg,.png,.pdf,.zip,.rtf,.doc,.docx,.xls,.xlsx"><br>
						File&nbsp;6&nbsp;:&nbsp;<input type="file" id="attachment" name="uploaded_file[]" accept=".gif,.jpg,.jpeg,.png,.pdf,.zip,.rtf,.doc,.docx,.xls,.xlsx"><br>
						File&nbsp;7&nbsp;:&nbsp;<input type="file" id="attachment" name="uploaded_file[]" accept=".gif,.jpg,.jpeg,.png,.pdf,.zip,.rtf,.doc,.docx,.xls,.xlsx"><br>
						File&nbsp;8&nbsp;:&nbsp;<input type="file" id="attachment" name="uploaded_file[]" accept=".gif,.jpg,.jpeg,.png,.pdf,.zip,.rtf,.doc,.docx,.xls,.xlsx"><br>
						File&nbsp;9&nbsp;:&nbsp;<input type="file" id="attachment" name="uploaded_file[]" accept=".gif,.jpg,.jpeg,.png,.pdf,.zip,.rtf,.doc,.docx,.xls,.xlsx"><br>
						File&nbsp;10&nbsp;:&nbsp;<input type="file" id="attachment" name="uploaded_file[]" accept=".gif,.jpg,.jpeg,.png,.pdf,.zip,.rtf,.doc,.docx,.xls,.xlsx"><br>
						<button type="submit" name="submit" class="btn btn-blue">Upload</button>
					</form>
                </div>
            </div>
        </div>
        <div class="grid_10">
            <div class="box round first">
                <h2>All Documnet Type Files</h2>
                <div class="block">
				<p class="start">Here is a list of your all document type files has been uploaded before.</p>
					<table border="1" style="margin-left:auto;margin-right:auto;width:90%;border-collapse:collapse;border-color:#777;font-size:12px">
						<tbody>
							<tr style="background-color:#ccc;text-align:center;color:#3a3a3a">
								<td style="padding:5px; width:20%;">name</td>
								<td style="padding:5px; width:50%;">Location</td>
								<td style="padding:5px; width:50%;">Upload/Modify Date</td>
								<td style="padding:5px; width:15%;">Action</td>
							</tr>
<?php

	$dir = dirname(__DIR__) . DIRECTORY_SEPARATOR  ."Documents" . DIRECTORY_SEPARATOR .$id. DIRECTORY_SEPARATOR  ."";

// Open a directory, and read its contents
if (is_dir($dir)){
  if ($dh = opendir($dir)){
    while (($file = readdir($dh)) !== false){
		if($file == '.' OR $file=='..' OR $file=='msds') continue;
		echo "<tr style=\"background-color:#fff;text-align:center;font-weight:bold\">";
		echo "<td style=\"padding:5px;\"><a href='../Documents" . DIRECTORY_SEPARATOR .$id. DIRECTORY_SEPARATOR  . $file."'>".$file."</a></td>";
		echo "<td style=\"padding:5px;\">".$dir.$file."</td>";
		echo "<td style=\"padding:5px;\">".date("Y/m/d H:i:s",filemtime($dir.$file))."</td>";
		echo "<td style=\"padding:5px;\"><a href='itemedit.php?id=".$id."&fullname=".$dir.$file."'>Delete</a></td>";
		echo "</tr>";
    }
    closedir($dh);
  }
}
else{
	echo "<tr style=\"background-color:#fff;text-align:center;font-weight:bold\">";
	echo "<td colspan='4' style=\"padding:5px;\">No file is added yet.</td>";
	echo "</tr>";
}
?>							
						</tbody>
					</table>
                </div>
            </div>
        </div>
        <div class="grid_10">
            <div class="box round first">
                <h2>MSDS Files</h2>
                <div class="block">
				<p class="start">Here is a list of msds files has been uploaded by customer.</p>
					<table border="1" style="margin-left:auto;margin-right:auto;width:90%;border-collapse:collapse;border-color:#777;font-size:12px">
						<tbody>
							<tr style="background-color:#ccc;text-align:center;color:#3a3a3a">
								<td style="padding:5px; width:20%;">name</td>
								<td style="padding:5px; width:50%;">Location</td>
								<td style="padding:5px; width:50%;">Upload/Modify Date</td>
								<td style="padding:5px; width:15%;">Action</td>
							</tr>
<?php

	$dir = dirname(__DIR__) . DIRECTORY_SEPARATOR  ."Documents" . DIRECTORY_SEPARATOR .$id. DIRECTORY_SEPARATOR  ."msds". DIRECTORY_SEPARATOR  ."";

// Open a directory, and read its contents
if (is_dir($dir)){
  if ($dh = opendir($dir)){
    while (($file = readdir($dh)) !== false){
		if($file == '.' OR $file=='..' OR $file=='msds') continue;
		echo "<tr style=\"background-color:#fff;text-align:center;font-weight:bold\">";
		echo "<td style=\"padding:5px;\"><a href='../Documents" . DIRECTORY_SEPARATOR .$id. DIRECTORY_SEPARATOR  . "msds". DIRECTORY_SEPARATOR  . $file."'>".$file."</a></td>";
		echo "<td style=\"padding:5px;\">".$dir.$file."</td>";
		echo "<td style=\"padding:5px;\">".date("Y/m/d H:i:s",filemtime($dir.$file))."</td>";
		echo "<td style=\"padding:5px;\"><a href='itemedit.php?id=".$id."&fullname=".$dir.$file."'>Delete</a></td>";
		echo "</tr>";
    }
    closedir($dh);
  }
}
else{
	echo "<tr style=\"background-color:#fff;text-align:center;font-weight:bold\">";
	echo "<td colspan='4' style=\"padding:5px;\">No file is added yet.</td>";
	echo "</tr>";
}
?>							
						</tbody>
					</table>
                </div>
            </div>
        </div>
        <div class="grid_10">
            <div class="box round first">
                <h2>Created invoices for this order</h2>
                <div class="block">
<?php
if(mysql_num_rows($inv_q)>0){
	while($row = mysql_fetch_array($inv_q))
	{
		if($row['invoice_type'] == 0){
			echo "<br><a href='invoice/accountant/".$row['invoice_no'].".html'>Accounancy Invoice No. ".$row['invoice_type']."  On ".date("Y/m/d H:i:s",$row['timestamp'])."</a> <br>";
		}
		else{
			echo "<br><a href='invoice/customer/".$row['invoice_no'].".html'>Customer Invoice No. ".$row['invoice_type']."  On ".date("Y/m/d H:i:s",$row['timestamp'])."</a> <br>";
		}
	}
}else{
	echo "None created yet";
}
?>
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