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
$post_c = $countriesOriginal = array(
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

if (isset($_GET['post_c_key'])) {
    $post_c = [$_GET['post_c_key'] => $post_c[$_GET['post_c_key']]];
    $_GET['start'] = substr($post_c[$_GET['post_c_key']],0,1);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Agents | Booking Parcel Admin</title>
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
		});

function ConfirmFunc(a,b) {
	var r = confirm("You are about to delete '"+a+"' company. Are you sure?");
	if (r == true) {
		window.location.href = "?del="+b;
		x = "You pressed OK!";
	} else {
		//x = "You pressed Cancel!";
	}
}
function ConfirmFuncOfficial(a,b) {
	var r = confirm("You are about to delete '"+a+"' company. Are you sure?");
	if (r == true) {
		window.location.href = "?delofficial="+b;
		x = "You pressed OK!";
	} else {
		//x = "You pressed Cancel!";
	}
}
$(function() {
        var scntDiv = $('#ccities');
        var i = $('#ccities p').size() + 1;

        $('#addScnt').live('click', function() {
                $('<p><label for="ccities"><input type="text" id="ccity" size="20" name="ccity[]" value="" placeholder="New City" /></label> <a href="#" id="remScnt"><img src="../post_forms/images/icons/fam/delete.png"></a></p>').appendTo(scntDiv);
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


function ajax_msg(){

	var choosemsgemail = document.getElementById('choosemsgemail');
	var p = choosemsgemail.options[choosemsgemail.selectedIndex].value;

	if(p!='-'){

		var dataString = 'mid='+p;
		$.ajax({
			type: "POST",
			url: "ajax.php?cmd=load_msg2",
			data: dataString,
			dataType: 'json',
			cache: false,
			success: function(data){
				if(data)
				{
					if(data["status"]==true){
						CKEDITOR.instances.message.setData( data['message'] );
						//$("textarea#message").val(data['message']);
					}
				}
			}
		});
	}
}

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

if(isset($_GET['del']) AND $_GET['del']!='' AND $_GET['del']!=null AND is_numeric($_GET['del']) AND $_GET['del']>0){
	$error = true;
	$q = "SELECT count(*) as c FROM `agents` WHERE `id`=".$_GET['del']."";
	$r = mysql_fetch_array(mysql_query($q));
	if($r['c']>0){
		$error = false;
		mysql_query("DELETE FROM `agents` WHERE `id`=".$_GET['del']."");
		$error_m = "Agent removed successfully";
	}
	else{
		$error_m = "Agent not found";
	}
}
if(isset($_GET['delofficial']) AND $_GET['delofficial']!='' AND $_GET['delofficial']!=null AND is_numeric($_GET['delofficial']) AND $_GET['delofficial']>0){
	$error = true;
	$q = "SELECT count(*) as c FROM `agents_official` WHERE `aid`=".$_GET['delofficial']."";
	$r = mysql_fetch_array(mysql_query($q));
	if($r['c']>0){
		$error = false;
		mysql_query("DELETE FROM `agents_official` WHERE `aid`=".$_GET['delofficial']."");
		mysql_query("UPDATE `agents_official` set `official`=0 WHERE `id`=".$_GET['delofficial']."");
		$error_m = "Agent removed successfully";
	}
	else{
		$error_m = "Agent not found";
	}
}
$send = false;
if(isset($_POST['t']) AND $_POST['t']!="" AND $_POST['t']!=null){
$error_m = "";
	switch($_POST['t']){
		case 1:
		$error = true;

			if(isset($_POST['country']) AND $_POST['country']!="" AND $_POST['country']!=null AND array_key_exists($_POST['country'],$post_c) AND $post_c[$_POST['country']]!=""){
				if(isset($_POST['emails']) AND $_POST['emails']!="" AND $_POST['emails']!=null){
					if(isset($_POST['deliver']) AND $_POST['deliver']!="" AND $_POST['deliver']!=null AND is_array($_POST['deliver']) AND count($_POST['deliver'])>0){
						$air = $sea = $land = $rail = $charter = 0;
						foreach($_POST['deliver'] as $k=>$v){
							if($v == 'air') $air = 1;
							if($v == 'sea') $sea = 1;
							if($v == 'land') $land = 1;
							if($v == 'rail') $rail = 1;
							if($v == 'charter') $charter = 1;
						}
						$ccity = implode(" | ",$_POST['ccity']);
						$address = $_POST['address'];
						$fname = ($_POST['name']!='' ? $_POST['name'] : "Cargo Expert Manager");
						$lname = $_POST['lname'];
						$special = ((isset($_POST['special']) AND $_POST['special']!="" AND $_POST['special']!=null) ? 1 : 0);
						$active = ((isset($_POST['active']) AND $_POST['active']!="" AND $_POST['active']!=null) ? 1 : 0);
						$fixed = ((isset($_POST['fixed']) AND $_POST['fixed']!="" AND $_POST['fixed']!=null) ? 1 : 0);
						$official = ((isset($_POST['official']) AND $_POST['official']!="" AND $_POST['official']!=null) ? 1 : 0);
						$cname = ((isset($_POST['cname']) AND $_POST['cname']!="" AND $_POST['cname']!=null) ? $_POST['cname'] : "---");
						$city = ((isset($_POST['city']) AND $_POST['city']!="" AND $_POST['city']!=null) ? $_POST['city'] : "---");
						$phones = $_POST['phones'];
						$emails = $_POST['emails'];
						$desc = $_POST['desc'];
						$country = $post_c[$_POST['country']];
						$error = false;

						mysql_query("INSERT INTO `agents` (`fname`, `cname`, `country`, `city`, `address`, `phones`, `emails`, `desc`, `ship_air`, `ship_sea`, `ship_land`, `ship_rail`, `ship_charter`, `special`, `time`,`active`,`fixed`, `official`, `cover_city`) VALUES ('".$fname."','".$cname."','".$country."','".$city."','".$address."','".$phones."','".$emails."','".$desc."','".$air."','".$sea."','".$land."','".$rail."','".$charter."','".$special."','".time()."','".$active."','".$fixed."', '".$official."','".$ccity."');");
						$aid = mysql_insert_id();
						if($official == 1) mysql_query("INSERT INTO `agents_official` (`aid`, `uname`, `pw`, `fname`,`lname`, `active`) values ('".$aid."', '". str_replace(" ", "_",strtolower($fname."_".$cname))."', 'sasdaq', '".$fname."', '', '1'); ");
						$error_m = "Agent Successfully added.";
					}
					else{
						$error_m = "Shipping type is required.";
					}
				}
				else{
					$error_m = "email is required.";
				}
			}
			else{
				$error_m = "Invalid Country Name.";
			}
		break;
		case 2:
		$error = true;
			if(isset($_GET['edit']) AND $_GET['edit']!='' AND $_GET['edit']!=null AND is_numeric($_GET['edit']) AND $_GET['edit']>0){

				$q = "SELECT count(*) as c FROM `agents` WHERE `id`=".$_GET['edit']."";
				$r = mysql_fetch_array(mysql_query($q));
				if($r['c']>0){
					if(isset($_POST['country']) AND $_POST['country']!="" AND $_POST['country']!=null AND array_key_exists($_POST['country'],$post_c) AND $post_c[$_POST['country']]!=""){
						if(isset($_POST['emails']) AND $_POST['emails']!="" AND $_POST['emails']!=null){
							if(isset($_POST['deliver']) AND $_POST['deliver']!="" AND $_POST['deliver']!=null AND is_array($_POST['deliver']) AND count($_POST['deliver'])>0){
								$air = $sea = $land = $rail = $charter = 0;
								foreach($_POST['deliver'] as $k=>$v){
									if($v == 'air') $air = 1;
									if($v == 'sea') $sea = 1;
									if($v == 'land') $land = 1;
									if($v == 'rail') $rail = 1;
									if($v == 'charter') $charter = 1;
								}
								$ccity = implode(" | ",$_POST['ccity']);
								$address = $_POST['address'];
								//$fname = $_POST['name'];
								$fname = ($_POST['name']!='' ? $_POST['name'] : "Cargo Expert Manager");
								$special = ((isset($_POST['special']) AND $_POST['special']!="" AND $_POST['special']!=null) ? 1 : 0);
								$active = ((isset($_POST['active']) AND $_POST['active']!="" AND $_POST['active']!=null) ? 1 : 0);
								$fixed = ((isset($_POST['fixed']) AND $_POST['fixed']!="" AND $_POST['fixed']!=null) ? 1 : 0);
								$official = ((isset($_POST['official']) AND $_POST['official']!="" AND $_POST['official']!=null) ? 1 : 0);
								$cname = ((isset($_POST['cname']) AND $_POST['cname']!="" AND $_POST['cname']!=null) ? $_POST['cname'] : "---");
								$city = ((isset($_POST['city']) AND $_POST['city']!="" AND $_POST['city']!=null) ? $_POST['city'] : "---");
								$phones = $_POST['phones'];
								$emails = $_POST['emails'];
								$desc = $_POST['desc'];
								$country = $post_c[$_POST['country']];
								$error = false;

								mysql_query("UPDATE `agents` SET `ship_air` = '".$air."', `ship_sea`= '".$sea."', `ship_land`= '".$land."', `ship_rail`= '".$rail."', `ship_charter`= '".$charter."', `special`= '".$special."' WHERE `id`=".$_GET['edit']."");
								mysql_query("UPDATE `agents` SET `fname` = '".$fname."', `cname`= '".$cname."', `city`= '".$city."' WHERE `id`=".$_GET['edit']."");
								mysql_query("UPDATE `agents` SET `address` = '".$address."', `country`= '".$country."', `phones`= '".$phones."' WHERE `id`=".$_GET['edit']."");
								mysql_query("UPDATE `agents` SET `emails` = '".$emails."', `desc`= '".$desc."', `time`= '".time()."' WHERE `id`=".$_GET['edit']."");
								mysql_query("UPDATE `agents` SET `cover_city` = '".$ccity."', `active`= '".$active."', `fixed`= '".$fixed."', `official`= '".$official."' WHERE `id`=".$_GET['edit']."");
								if($official == 1) mysql_query("INSERT INTO `agents_official` (`aid`, `uname`, `pw`, `fname`,`lname`, `active`) values ('".$_GET['edit']."', '". str_replace(" ", "_",strtolower($fname."_".$cname))."', 'sasdaq', '".$fname."', '', '1'); ");
								$error_m = "Agent Successfully Edited.";
							}
							else{
								$error_m = "Shipping type is required.";
							}
						}
						else{
							$error_m = "email is required.";
						}
					}
					else{
						$error_m = "Invalid Country Name.";
					}
				}
				else{
					$error_m = "Agent not found";
				}
			}
		break;
		case 'fixed':
			if(isset($_POST['submit']) AND $_POST['submit']!='' AND $_POST['submit']!=null){
				$error = true;
				if(isset($_GET['fixed']) AND $_GET['fixed']!='' AND $_GET['fixed']!=null AND $_GET['fixed']="show"){

					$emails = array();
					if(isset($_POST['agents']) AND is_array($_POST['agents']) AND count($_POST['agents'])>0){
						foreach($_POST['agents'] as $agent){
							$qq = "SELECT emails,cname,country,fname,id, count(*) as cq FROM `agents` WHERE `id` = ".$agent."";
							$roww = mysql_fetch_array(mysql_query($qq));
							if($roww['cq']==1){
								$emails[$roww['id']."_|_".$roww['cname']."_|_".$roww['country']."_|_".(($roww['fname']!='') ? $roww['fname'] : "Sir/Madam")."_|_".rand(1,9999)] = explode("\n",$roww['emails']);
							}
						}
					}

					if(isset($_POST['title']) AND $_POST['title']!='' AND $_POST['title']!=null){
						if(isset($_POST['message']) AND $_POST['message']!='' AND $_POST['message']!=null){
							$has_attach = false;
							$send = false;

							$Attachments = array();

							if(isset($_FILES['uploaded_file']['name']) AND is_array($_FILES['uploaded_file']['name']) AND count($_FILES['uploaded_file']['name'])>0){

								$target_dir = __DIR__ . DIRECTORY_SEPARATOR  ."attachments" . DIRECTORY_SEPARATOR;
								$uploaded_c = 0;
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
												$uploaded_c++;
												$error_m .= "The file ". basename( $_FILES['uploaded_file']['name'][$k]). " has been uploaded.<br>";

												$Attachments[] = $target_file;
											}
										}
									}
								}
							}
							if(($uploaded_c==count($_FILES['uploaded_file']['name']) AND $has_attach) OR !$has_attach){
								$send = true;
							}

							if($send){
								mb_internal_encoding("UTF-8");

								$txt = "<?php \n";
								$txt .= "\n";
								$txt .= '$subject=\''.$_POST['title'].'\';';
								if($uploaded_c>0)
								{
									$txt .= "\n";
									$txt .= '$attachments= array(';
									for($i=0;$i<$uploaded_c;$i++)
									{
										$txt .= "\n'".$Attachments[$i]."',";
									}
									$txt .= ');';
								}
								$txt .= "\n";
								$txt .= '$body=\''.$_POST['message'].'\';';
								$txt .= "\n";
								$txt .= "?>";

								function writeStringToFile($file, $string){
									$f=fopen($file, "wb");
									$file="\xEF\xBB\xBF".$file; // this is what makes the magic
									fputs($f, $string);
									fclose($f);
								}
								unlink("mail_content.php");
								writeStringToFile("mail_content.php",$txt);


								$txt = "<?php \n";
								$txt .= "\n";
								$txt .= '$mails=array( ';
								$txt .= "\n";
								foreach($emails as $cname1 => $email){
									list($id,$cname,$country,$fname) = explode("_|_",$cname1);
									foreach($email as $e)
									{
										$txt .= "\t'".trim($e)."' => array('company'=>'".$cname."','country'=>'".$country."','name'=>'".$fname."','ref'=>'','id'=>'".$id."','setparam'=>'false'),\n";

									}
								}
								$txt .= ");\n";
								$txt .= "?>";

								unlink("mail_address.php");
								writeStringToFile("mail_address.php",$txt);
								$error = false;
								$error_m .= "The needed files have been saved. your sending process will be start in <span id='countd'>5</span> seconds.<br>Note: your request of sending mail won be put in queue, means that if you send request before ending the process the prevous process will end. and new one will proceed.<br>";

							}
						}
						else{
							$error_m = "message body must not be empty";
						}
					}
					else{
						$error_m = "Subject must not be empty";
					}
				}
			}
		break;

	}
}
if(isset($error_m)&& $error_m!=""){
	?>
<div class="grid_10">
    <div class="box round first">
        <h2>Notifications</h2>
		<div class="block">
		<?php if($error == false){ ?>
			<div class="message success">
				<h5>Success!</h5>
				<p>
					<?php
					if($send) header( "refresh:5;url=sendmail.php" );
					echo $error_m; ?>
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
if(isset($_GET['fixed']) AND $_GET['fixed']!='' AND $_GET['fixed']!=null AND $_GET['fixed']=='show'){

	if(isset($_POST['report']) AND $_POST['report']!='' AND $_POST['report']!=null){
		if(isset($_POST['agents']) AND is_array($_POST['agents']) AND count($_POST['agents'])>0){
			echo '
			<div class="grid_10">
				<div class="box round first">
					<h2>Fixed Agents</h2>
					<div class="block"><center><button class="btn btn-orange" onclick="window.location.href=\'agents.php?fixed=show\';">Back&nbsp;</button>&nbsp;&nbsp;&nbsp;<button type="button" name="print" class="btn btn-green" onclick="printContent(\'printable\')">Print the report</button></center><div id="printable">
					<table border="1" style="margin-left:auto;margin-right:auto;width:98%;border-collapse:collapse;border-color:#777;font-size:12px">
						<tbody>
							<tr style="background-color:#ccc;text-align:center;color:#3a3a3a">
								<td style="padding:5px">Country</td>
								<td style="padding:5px">City</td>
								<td >Company</td>
								<td >Name</td>
								<td >Shipping Method(s)</td>
								<td >Cover City(s)</td>
								<td >Phone(s)</td>
								<td >E-mail(s)</td>
								<td >Address</td>
								<td >Desciption</td>
							</tr>';
					foreach($_POST['agents'] as $agent){
						$qq = "SELECT * FROM `agents` WHERE `id` = ".$agent."";
						$roww = mysql_fetch_array(mysql_query($qq));

						echo "<tr ".($roww['special']==1 ? "style=\"background-color:#99ccff;text-align:ltr;color:#3a3a3a\"" : ($roww['active']==0 ? "style=\"background-color:#e0e0d2;text-align:ltr;color:#3a3a3a\"" : "")).">";
						echo "<td style=\"padding:5px\">".$roww['country']."</td>";
						echo "<td style=\"padding:5px\">".$roww['city']."</td>";
						echo "<td>".$roww['cname']." ".($roww['special']==1 ? "<img src=\"img/star_list.png\" title='This agent is special.' alt='Special'>" : "")." ".($roww['fixed']==1 ? "<img src=\"fixed.gif\" title='This is a fixed agent.' alt='Fixed'>" : "")."</td>";
						echo "<td>".$roww['fname']."</td>";
						$ship = array();
						if($roww['ship_air']==1) $ship[] = "Air";
						if($roww['ship_sea']==1) $ship[] = "Sea";
						if($roww['ship_land']==1) $ship[] = "Land";
						if($roww['ship_rail']==1) $ship[] = "Rail Way";
						if($roww['ship_charter']==1) $ship[] = "Charter Broker";
						echo "<td>".implode(" | ", $ship)."</td>";
						unset($ship);
						echo "<td>".str_replace(" | ","<br>",$roww['cover_city'])."</td>";
						echo "<td>".nl2br($roww['phones'])."</td>";
						echo "<td>".nl2br($roww['emails'])."</td>";
						echo "<td>".nl2br($roww['address'])."</td>";
						echo "<td>".nl2br($roww['desc'])."</td>";
						echo "</tr>";
					}
			echo '
					</tbody>
				</table></div>
				</div>
			</div>
		</div>';
		}
	}
	else{

	$q = "SELECT * FROM `agents` WHERE `fixed`=1 ORDER BY `country` ASC,`id` ASC";
	$r = mysql_query($q);
	if(mysql_num_rows($r)>0)
	{

?>
        <div class="grid_10">
            <div class="box round first">
                <h2>Fixed Agents</h2>
                <div class="block">
					<form method="post" enctype="multipart/form-data">
					<input name="t" type="hidden" value="fixed">
					<?php
						$output = "";
						while($row = mysql_fetch_array($r)){
							$output .= "<tr ".($row['special']==1 ? "style=\"background-color:#99ccff;text-align:ltr;color:#3a3a3a\"" : ($row['active']==0 ? "style=\"background-color:#e0e0d2;text-align:ltr;color:#3a3a3a\"" : "")).">";
							$output .= "<td><input type=\"checkbox\" name=\"agents[]\" value=\"".$row['id']."\"></td>";
							$output .= "<td style=\"padding:5px\">".$row['id']."</td>";
							$output .= "<td style=\"padding:5px\">".$row['country']."</td>";
							$output .= "<td style=\"padding:5px\">".$row['city']."</td>";
							$output .= "<td>".$row['cname']." ".($row['special']==1 ? "<img src=\"img/star_list.png\" title='This agent is special.' alt='Special'>" : "")." ".($row['fixed']==1 ? "<img src=\"fixed.gif\" title='This is a fixed agent.' alt='Fixed'>" : "")."</td>";
							$output .= "<td>".$row['fname']."</td>";
							$ship = array();
							if($row['ship_air']==1) $ship[] = "Air";
							if($row['ship_sea']==1) $ship[] = "Sea";
							if($row['ship_land']==1) $ship[] = "Land";
							if($row['ship_rail']==1) $ship[] = "Rail Way";
							if($row['ship_charter']==1) $ship[] = "Charter Broker";
							$output .= "<td>".implode(" | ", $ship)."</td>";
							unset($ship);
							$output .= "<td>".str_replace(" | ","<br>",$row['cover_city'])."</td>";
							$output .= "<td>".nl2br($row['phones'])."</td>";
							$output .= "<td>".nl2br($row['emails'])."</td>";
							$output .= "<td>".nl2br($row['address'])."</td>";
							$output .= "<td>".nl2br($row['desc'])."</td>";
							$output .= "<td><a href='?edit=".$row['id']."'>Edit</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href='#' OnClick=\"ConfirmFunc('".$row['cname']."','".$row['id']."');\">Delete</a></td>";
							$output .= "</tr>";
						}
					?>
<table border="1" style="margin-left:auto;margin-right:auto;width:98%;border-collapse:collapse;border-color:#777;font-size:12px">
	<tbody>
		<tr style="background-color:#ccc;text-align:center;color:#3a3a3a">
			<td style="padding:5px"><input type="checkbox" id="checkall"></td>
			<td style="padding:5px">ID</td>
			<td style="padding:5px">Country</td>
			<td style="padding:5px">City</td>
			<td >Company</td>
			<td >Name</td>
			<td >Shipping Method(s)</td>
			<td >Cover City(s)</td>
			<td >Phone(s)</td>
			<td >E-mail(s)</td>
			<td >Address</td>
			<td >Desciption</td>
			<td >Action</td>
		</tr>
		<?php echo $output; ?>
		<tr>
			<td colspan="12"><button class="btn" name="report" type="submit" value="rep">Get Printable Report</button></td>
		</tr>
	</tbody>
</table>

					<table border="1" style="margin-left:auto;margin-right:auto;width:98%;border-collapse:collapse;border-color:#777;font-size:12px">
						<tbody>
							<tr style="background-color:#ccc;text-align:center;color:#3a3a3a">
								<td colspan='4' style="padding:5px">Message</td>
							</tr>
							<tr style="background-color:#fff;text-align:center;font-weight:bold">
								<td style="padding:5px;" width='25%'>Subject</td>
								<td style="padding:5px" width='25%'><input type="text" id="title" name="title" value=""></td>
								<td width='25%'>Pre-defined Message:</td>
								<td width='25%'>
									<select  name="choosemsgemail" id="choosemsgemail"  onchange="ajax_msg();">
										<option value="-">Choose a message</option>
										<?php
										$q = "SELECT `id`,`title` FROM `prenotes` WHERE `type`=3 ORDER BY `id` ASC";
										$r = mysql_query($q);
										if(mysql_num_rows($r)>0){
											while($rowww = mysql_fetch_array($r)){
												echo "<option value=\"".$rowww['id']."\">".$rowww['title']."</option>";
											}
										}
										?>
									</select>
								</td>
							</tr>




							<tr style="background-color:#fff;text-align:center;font-weight:bold">
								<td style="padding:5px;">Message</td>
								<td colspan="3" style="padding:5px;"><textarea name="message" id="message" class="ckeditor" style="margin: 5px; height: 525px; width:96%;"></textarea></td>
							</tr>
							<tr style="background-color:#fff;text-align:center;font-weight:bold">
								<td style="padding:5px;">Attachment</td>
								<td colspan="3" style="padding:5px;">
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
							</tr>
							<tr style="background-color:#fff;text-align:center;font-weight:bold">
								<td colspan="4">
									<button class="btn" name="submit" type="submit" value="send">Send</button>
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

	}
}
elseif(isset($_GET['official']) AND $_GET['official']!='' AND $_GET['official']!=null AND $_GET['official']=='show'){

		if(isset($_GET['oedit']) AND is_numeric($_GET['oedit']) AND $_GET['oedit']>0)
		{
			$q = "SELECT * FROM `agents` WHERE `official`=1 AND `id`=".$_GET['oedit']." ORDER BY `country` ASC,`id` ASC";
			$r = mysql_query($q);
			if(mysql_num_rows($r)>0)
			{
				$oarow = mysql_fetch_array($r);

				$q = "SELECT COUNT(*) as ac FROM `agents_official_meta` WHERE `aid`='".$_GET['oedit']."'";
				$r = mysql_query($q);
				$oamrow = mysql_fetch_array($r);
				if($oamrow['ac']>0)
				{
					$q = "SELECT * FROM `agents_official_meta` WHERE `aid`='".$_GET['oedit']."'";
					$r = mysql_query($q);
					$oamrow = mysql_fetch_array($r);
				}
				if(isset($_POST['t']) AND $_POST['t']!=null AND $_POST['t']!='')
				{
					function PassToHash($pass){
						$options = [
							'cost' => 10,
							//'salt' => $salt
						];
						return password_hash($pass, PASSWORD_BCRYPT, $options);
					}
					switch($_POST['t'])
					{
						case 'official_edit_login' :
							if(isset($_POST['fname']) AND trim($_POST['fname'])!='' AND trim($_POST['fname'])!=null)
							{
								if(isset($_POST['lname']) AND trim($_POST['lname'])!='' AND trim($_POST['lname'])!=null)
								{
									if(isset($_POST['uname']) AND trim($_POST['uname'])!='' AND trim($_POST['uname'])!=null)
									{
										if(isset($_POST['pw']) AND trim($_POST['pw'])!='' AND trim($_POST['pw'])!=null)
										{
											$fname = $_POST['fname'];
											$lname = $_POST['lname'];
											$uname = $_POST['uname'];
											$pw = PassToHash($_POST['pw']);
											$active = ((isset($_POST['active']) AND $_POST['active']=='yes') ? 1 : 0);
											$q = "INSERT INTO `agents_official` (`aid`, `uname`, `fname`, `lname`, `pw`, `active`,`last_login`) VALUES ('".$_GET['oedit']."', '".$uname."', '".$fname."', '".$lname."', '".$pw."', '".$active."', '0');";
											//echo $q."<br>";exit;
											mysql_query($q);
										}
									}
								}
							}
						break;
						case 'official_edit_login2' :
							if(isset($_POST['fname']) AND trim($_POST['fname'])!='' AND trim($_POST['fname'])!=null)
							{
								if(isset($_POST['lname']) AND trim($_POST['lname'])!='' AND trim($_POST['lname'])!=null)
								{
									if(isset($_POST['uname']) AND trim($_POST['uname'])!='' AND trim($_POST['uname'])!=null)
									{
										if(isset($_POST['pw']) AND trim($_POST['pw'])!='' AND trim($_POST['pw'])!=null)
										{
											$fname = $_POST['fname'];
											$lname = $_POST['lname'];
											$uname = $_POST['uname'];
											$pw = PassToHash($_POST['pw']);
											$active = ((isset($_POST['active']) AND $_POST['active']=='yes') ? 1 : 0);
											$q = "UPDATE `agents_official` SET `uname`='".$uname."',`fname`='".$fname."',`lname`='".$lname."',`pw`='".$pw."',`active`='".$active."' WHERE `aid`=".$_GET['oedit']." AND `id`=".$_POST['ledit']."";
											//$q = "INSERT INTO `agents_official` (`aid`, `uname`, `fname`, `lname`, `pwd`, `active`) VALUES ('".$_GET['oedit']."', '".$uname."', '".$fname."', '".$lname."', '".$pw."', '".$active."');";
											mysql_query($q);
										}
									}
								}
							}
						break;
						case 'official_edit_det' :echo "10<br>";
							if(isset($_POST['cc_name']) AND is_array($_POST['cc_name']) AND $_POST['cc_name']!=null)
							{
								$tmp_arr = $_POST['cc_name'];
								$tmp_arr[] = $oarow['country'];
								$cc_name = implode("|",$tmp_arr);


								if(isset($_POST['master_email']) AND $_POST['master_email']!=null AND $_POST['master_email']!='')
								{
									$master_email = $_POST['master_email'];
									if(isset($_POST['backup_email']) AND $_POST['backup_email']!=null AND $_POST['backup_email']!='')
									{
										$backup_email = $_POST['backup_email'];
										if(isset($_POST['currency']) AND $_POST['currency']!=null AND $_POST['currency']!='')
										{
											$currency = $_POST['currency'];
											if(isset($_POST['oname']) AND $_POST['oname']!=null AND $_POST['oname']!='')
											{
												$oname = $_POST['oname'];
												if(isset($_POST['comision']) AND $_POST['comision']!=null AND $_POST['comision']!='')
												{
													$comision = $_POST['comision'];

													$q = "SELECT COUNT(*) as ac FROM `agents_official_meta` WHERE `aid`='".$_GET['oedit']."'";
													$r = mysql_query($q);
													$oamrow = mysql_fetch_array($r);
													if($oamrow['ac']>0)
													{
														$q = "UPDATE `agents_official_meta` SET `cover_counteries`='".$cc_name."',`backup_email`='".$backup_email."',`master_email`='".$master_email."',`oname`='".$oname."',`currency`='".$currency."',`comision`='".$comision."' WHERE `aid`=".$_GET['oedit']."";
														mysql_query($q);
													}
													else
													{
														$q = "INSERT INTO `agents_official_meta` (`aid`, `cover_counteries`, `master_email`, `backup_email`, `oname`, `currency`, `comision`) VALUES ('".$_GET['oedit']."', '".$cc_name."', '".$master_email."', '".$backup_email."', '".$oname."', '".$currency."', '".$comision."');";
														mysql_query($q);
													}
													header('Location: agents.php?official=show&oedit='.$_GET['oedit']);
												}
											}
										}
									}
								}
							}
						break;
					}
				}
				if(isset($_GET['ledit']) AND is_numeric($_GET['ledit']) AND $_GET['ledit']>0)
				{
					$q = "SELECT * FROM `agents_official` WHERE `aid`=".$_GET['oedit']." AND `id`=".$_GET['ledit']." ORDER BY `id` ASC";
					$r = mysql_query($q);
					if(mysql_num_rows($r)>0)
					{
						$loarow = mysql_fetch_array($r);

?>
        <div class="grid_10">
            <div class="box round first">
                <h2>Edit Login <?php echo $loarow['uname']." (".$loarow['fname']." ".$loarow['lname'].")"; ?></h2>
                <div class="block">
					<form method="post" >
						<input name="t" type="hidden" value="official_edit_login2">
						<input name="ledit" type="hidden" value="<?php echo $_GET['ledit']; ?>">
						<label for="fname">First Name</label> : <input name="fname" type="text" id="fname" value="<?php echo $loarow['fname']; ?>"><br>
						<label for="lname">Last Name</label> : <input name="lname" type="text" id="lname" value="<?php echo $loarow['lname']; ?>"><br>
						<label for="uname">User Name</label> : <input name="uname" type="text" id="uname" value="<?php echo $loarow['uname']; ?>"><br>
						<label for="pw">PassWord</label> : <input name="pw" type="text" id="pw"><br>
						<label for="active">Active</label> : <input name="active" type="checkbox" id="active" value="yes" <?php echo ($loarow['active']==1 ? 'checked="true"' : ''); ?>><br>
						<button class="btn" name="submit" type="submit" value="apply">save</button>
					</form>
				</div>
			</div>
		</div>
<?php
					}
				}

?>
        <div class="grid_10">
            <div class="box round first">
                <h2>Login Management</h2>
                <div class="block">
					<form method="post" >
						<input name="t" type="hidden" value="official_edit_login">
						<label for="fname">First Name</label> : <input name="fname" type="text" id="fname"><br>
						<label for="lname">Last Name</label> : <input name="lname" type="text" id="lname"><br>
						<label for="uname">User Name</label> : <input name="uname" type="text" id="uname"><br>
						<label for="pw">PassWord</label> : <input name="pw" type="text" id="pw"><br>
						<label for="active">Active</label> : <input name="active" type="checkbox" id="active" value="yes"><br>
						<button class="btn" name="submit" type="submit" value="apply">create new login</button>
					</form>
					<div>
<?php
	$q = "SELECT * FROM `agents_official` WHERE `aid`=".$_GET['oedit']." ORDER BY `id` ASC";
	$r = mysql_query($q);
	if(mysql_num_rows($r)>0)
	{
		$output = "";
		while($row = mysql_fetch_array($r)){
			$output .= "<tr ".($row['active']==0 ? "style=\"background-color:#e0e0d2;text-align:ltr;color:#3a3a3a\"" : "").">";
			$output .= "<td style=\"padding:5px\">".$row['fname']."</td>";
			$output .= "<td style=\"padding:5px\">".$row['lname']."</td>";
			$output .= "<td>".$row['uname']."</td>";
			$output .= "<td>".($row['last_login']!=0 ? date("Y/m/d H:i:s",$row['last_login']) : '---')."</td>";
			$output .= "<td><a href='?official=show&oedit=".$_GET['oedit']."&ledit=".$row['id']."'>Login Edit</a>&nbsp;&nbsp;</td>";
			$output .= "</tr>";
		}
	?>
<table border="1" style="margin-left:auto;margin-right:auto;width:98%;border-collapse:collapse;border-color:#777;font-size:12px">
	<tbody>
		<tr style="background-color:#ccc;text-align:center;color:#3a3a3a">
			<td style="padding:5px">First Name</td>
			<td style="padding:5px">Last Name</td>
			<td >User Name</td>
			<td >Last Login</td>
			<td >Action</td>
		</tr>
		<?php echo $output; ?>
	</tbody>
</table>
<?php
	}
?>
					</div>
				</div>
			</div>
		</div>
        <div class="grid_10">
            <div class="box round first">
                <h2>Management Details</h2>
                <div class="block">
					<form method="post" >
					<input name="t" type="hidden" value="official_edit_det">
					<div style="font-family:tahoma;font-size:16px;">
						<label for="memail">Master Email</label> : <input type="email" name="master_email" value="<?php echo $oamrow['master_email']; ?>" id="memail"><br>
						<label for="bemail">Backup Email</label> : <input type="email" name="backup_email" value="<?php echo $oamrow['backup_email']; ?>" id="bemail"><br>
						<label for="oname">Office Name</label> : <input type="text" name="oname" value="<?php echo $oamrow['oname']; ?>" id="oname"><br>
						<label for="currency">Default Currency</label> :
						<select name="currency" id="currency">
							<option value="GBP" <?php echo ($oamrow['currency']=='GBP' ? 'selected="true"' : ''); ?>>GBP</option>
							<option value="USD" <?php echo ($oamrow['currency']=='USD' ? 'selected="true"' : ''); ?>>USD</option>
							<option value="EUR" <?php echo ($oamrow['currency']=='EUR' ? 'selected="true"' : ''); ?>>EUR</option>
							<option value="IRR" <?php echo ($oamrow['currency']=='IRR' ? 'selected="true"' : ''); ?>>IRR</option>
							<option value="CHF" <?php echo ($oamrow['currency']=='CHF' ? 'selected="true"' : ''); ?>>CHF</option>
							<option value="DKK" <?php echo ($oamrow['currency']=='DKK' ? 'selected="true"' : ''); ?>>DKK</option>
							<option value="HKD" <?php echo ($oamrow['currency']=='HKD' ? 'selected="true"' : ''); ?>>HKD</option>
							<option value="SGD" <?php echo ($oamrow['currency']=='SGD' ? 'selected="true"' : ''); ?>>SGD</option>
							<option value="SEK" <?php echo ($oamrow['currency']=='SEK' ? 'selected="true"' : ''); ?>>SEK</option>
							<option value="CAD" <?php echo ($oamrow['currency']=='CAD' ? 'selected="true"' : ''); ?>>CAD</option>
							<option value="AED" <?php echo ($oamrow['currency']=='AED' ? 'selected="true"' : ''); ?>>AED</option>
							<option value="JYP" <?php echo ($oamrow['currency']=='JYP' ? 'selected="true"' : ''); ?>>JYP</option>
							<option value="CNH" <?php echo ($oamrow['currency']=='CNH' ? 'selected="true"' : ''); ?>>CNH</option>
							<option value="TRY" <?php echo ($oamrow['currency']=='TRY' ? 'selected="true"' : ''); ?>>TRY</option>
							<option value="PUR" <?php echo ($oamrow['currency']=='PUR' ? 'selected="true"' : ''); ?>>PUR</option>
						</select><br>
						<label for="comision">Office Comision</label> : <input type="text" name="comision" value="<?php echo $oamrow['comision']; ?>" id="comision"> (Amount for every 1000 units of currency)<br>
						<label for="country_id">Cover Countries :</label>
						<div><input type="checkbox" name="" value="" id="c_id_def" disabled checked="true"><input type="hidden" name="cc_name[]" value="<?php echo $oarow['country']; ?>"><?php echo $oarow['country']; ?></div>
						<?php
						$___cc = 0;
						$cover_counteries = explode("|",$oamrow['cover_counteries']);
						foreach($post_c as $k=>$v)
						{
							if($v == $oarow['country']) continue;
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
			<div class="grid_10">
				<div class="box round first">
					<h2>Logs</h2>
					<div class="block">
						<?php
if(!(isset($_GET['logpage']) AND $_GET['logpage']!='' AND $_GET['logpage']!=null AND is_numeric($_GET['logpage']) AND $_GET['logpage']>0)){
	$logpage = 1;
}
else{
	$logpage = $_GET['logpage'];
}
$log_per_page = 30;
$lim = "LIMIT ".(($logpage-1) * $log_per_page).",".$log_per_page."";

$prev_p = "";
$next_p = "";
$curr_p = "Page : No.".$logpage;


$output = "";
$q = "SELECT * FROM `agents_official_logs` WHERE `oid`=".$_GET['oedit']." UNION SELECT * FROM `agents_official_logs` WHERE `oid`=0 AND `uid` IN (SELECT `id` as `uid` FROM `agents_official` WHERE `aid`=".$_GET['oedit'].") ORDER BY `timestamp` DESC, `id` ASC";

//echo $q."<br>";

$r = mysql_query($q) or die(mysql_error());
$total_res = mysql_num_rows($r);
$max_p = ceil($total_res/$log_per_page);

if($logpage<$max_p){
	$next_p = "<a class=\"btn-icon btn-black btn-arrow-right\" href='agents.php?official=show&oedit=".$_GET['oedit']."&logpage=".($logpage+1)."'><span></span>Next</a>";
}
if($logpage>1){
	$prev_p = "<a class=\"btn-icon btn-black btn-arrow-left\" href='agents.php?official=show&oedit=".$_GET['oedit']."&logpage=".($logpage-1)."'><span></span>Previous</a>";
}

$q = "SELECT * FROM `agents_official_logs` WHERE `oid`=".$_GET['oedit']." UNION SELECT * FROM `agents_official_logs` WHERE `oid`=0 AND `uid` IN (SELECT `id` as `uid` FROM `agents_official` WHERE `aid`=".$_GET['oedit'].") ORDER BY `timestamp` DESC, `id` ASC ".$lim;

$r = mysql_query($q) or die(mysql_error());
if(mysql_num_rows($r)>0){
	$_c = $total_res - (($logpage-1)*$log_per_page);
	while($row = mysql_fetch_array($r)){
		$output .="<tr >";
		$output .="<td >".$_c."</td><td >".$row['id']."</td><td >".$row['path']."</td><td >".$row['information']."</td><td >".date("Y/m/d H:i:s",$row['timestamp'])."</td>";
		$output .="</tr>";
		$_c--;
	}
}
else{
	$output = "<tr><td colspan=\"5\">No Entery Detected</td></tr>";
}
						?>
<table border="1" style="margin-left:auto;margin-right:auto;width:98%;border-collapse:collapse;border-color:#777;font-size:12px">
	<tbody>
		<tr style="background-color:#ccc;text-align:center;color:#3a3a3a">
			<td style="padding:5px">#</td>
			<td style="padding:5px">Log ID</td>
			<td style="padding:5px">Path</td>
			<td style="padding:5px">Message</td>
			<td >Date</td>
		</tr>
		<?php echo $output; ?>
	</tbody>
</table>
<?php echo $prev_p .'&nbsp;'. $curr_p .'&nbsp;'. $next_p;
echo "<br> Total Pages : ".$max_p;
?>
					</div>
				</div>
			</div>
<?php
			}
		}
		else{
	$q = "SELECT * FROM `agents` WHERE `official`=1 ORDER BY `country` ASC,`id` ASC";
	$r = mysql_query($q);
	if(mysql_num_rows($r)>0)
	{

?>
        <div class="grid_10">
            <div class="box round first">
                <h2>Europost Official Offices</h2>
                <div class="block">
					<form method="post" >
					<input name="t" type="hidden" value="official">
					<?php
						$output = "";
						while($row = mysql_fetch_array($r)){
							$output .= "<tr ".($row['special']==1 ? "style=\"background-color:#99ccff;text-align:ltr;color:#3a3a3a\"" : ($row['active']==0 ? "style=\"background-color:#e0e0d2;text-align:ltr;color:#3a3a3a\"" : "")).">";
							$output .= "<td><input type=\"checkbox\" name=\"agents[]\" value=\"".$row['id']."\"></td>";
							$output .= "<td style=\"padding:5px\">".$row['country']."</td>";
							$output .= "<td style=\"padding:5px\">".$row['city']."</td>";
							$output .= "<td>".$row['cname']." ".($row['special']==1 ? "<img src=\"img/star_list.png\" title='This agent is special.' alt='Special'>" : "")." ".($row['fixed']==1 ? "<img src=\"fixed.gif\" title='This is a fixed agent.' alt='Fixed'>" : "")."</td>";
							$output .= "<td>".$row['fname']."</td>";
							$ship = array();
							if($row['ship_air']==1) $ship[] = "Air";
							if($row['ship_sea']==1) $ship[] = "Sea";
							if($row['ship_land']==1) $ship[] = "Land";
							if($row['ship_rail']==1) $ship[] = "Rail Way";
							if($row['ship_charter']==1) $ship[] = "Charter Broker";
							$output .= "<td>".implode(" | ", $ship)."</td>";
							unset($ship);
							$output .= "<td>".str_replace(" | ","<br>",$row['cover_city'])."</td>";
							$output .= "<td>".nl2br($row['phones'])."</td>";
							$output .= "<td>".nl2br($row['emails'])."</td>";
							$output .= "<td>".nl2br($row['address'])."</td>";
							$output .= "<td>".nl2br($row['desc'])."</td>";
							$output .= "<td><a href='?official=show&oedit=".$row['id']."'>Official Management</a>&nbsp;&nbsp;|<a href='?edit=".$row['id']."'>Edit</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href='#' OnClick=\"ConfirmFuncOfficial('".$row['cname']."','".$row['id']."');\">Delete</a></td>";
							$output .= "</tr>";
						}
					?>
<table border="1" style="margin-left:auto;margin-right:auto;width:98%;border-collapse:collapse;border-color:#777;font-size:12px">
	<tbody>
		<tr style="background-color:#ccc;text-align:center;color:#3a3a3a">
			<td style="padding:5px"><input type="checkbox" id="checkall"></td>
			<td style="padding:5px">Country</td>
			<td style="padding:5px">City</td>
			<td >Company</td>
			<td >Name</td>
			<td >Shipping Method(s)</td>
			<td >Cover City(s)</td>
			<td >Phone(s)</td>
			<td >E-mail(s)</td>
			<td >Address</td>
			<td >Desciption</td>
			<td >Action</td>
		</tr>
		<?php echo $output; ?>
	</tbody>
</table>

					<table border="1" style="margin-left:auto;margin-right:auto;width:98%;border-collapse:collapse;border-color:#777;font-size:12px">
						<tbody>
							<tr style="background-color:#ccc;text-align:center;color:#3a3a3a">
								<td colspan='4' style="padding:5px">Message</td>
							</tr>
							<tr style="background-color:#fff;text-align:center;font-weight:bold">
								<td style="padding:5px;" width='25%'>Subject</td>
								<td style="padding:5px" width='25%'><input type="text" id="title" name="title" value=""></td>
								<td width='25%'>Pre-defined Message:</td>
								<td width='25%'>
									<select  name="choosemsgemail" id="choosemsgemail"  onchange="ajax_msg();">
										<option value="-">Choose a message</option>
										<?php
										$q = "SELECT `id`,`title` FROM `prenotes` WHERE `type`=3 ORDER BY `id` ASC";
										$r = mysql_query($q);
										if(mysql_num_rows($r)>0){
											while($rowww = mysql_fetch_array($r)){
												echo "<option value=\"".$rowww['id']."\">".$rowww['title']."</option>";
											}
										}
										?>
									</select>
								</td>
							</tr>




							<tr style="background-color:#fff;text-align:center;font-weight:bold">
								<td style="padding:5px;">Message</td>
								<td colspan="3" style="padding:5px;"><textarea name="message" id="message" class="ckeditor" style="margin: 5px; height: 525px; width:96%;"></textarea></td>
							</tr>
							<tr style="background-color:#fff;text-align:center;font-weight:bold">
								<td style="padding:5px;">Attachment</td>
								<td colspan="3" style="padding:5px;">
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
							</tr>
							<tr style="background-color:#fff;text-align:center;font-weight:bold">
								<td colspan="4">
									<button class="btn" name="submit" type="submit" value="send">Send</button>
								</td>
							</tr>

						</tbody>
					</table>
				</div>
			</div>
		</div>
<?php
	}
	else{

?>
        <div class="grid_10">
            <div class="box round first">
                <h2>Europost Official Offices</h2>
                <div class="block">
					No official office detected.
				</div>
			</div>
		</div>
<?php
	}
	}
}
else
{
if(isset($_GET['edit']) AND $_GET['edit']!='' AND $_GET['edit']!=null AND is_numeric($_GET['edit']) AND $_GET['edit']>0){

	$q = "SELECT *,count(*) as c FROM `agents` WHERE `id`=".$_GET['edit']."";
	$r = mysql_fetch_array(mysql_query($q));
	if($r['c']>0){

?>
        <div class="grid_10">
            <div class="box round first">
                <h2>Edit Agent</h2>
                <div class="block">
				<form method="post">
					<input type="hidden" name="t" value="2">
					<table border="1" style="margin-left:auto;margin-right:auto;width:90%;border-collapse:collapse;border-color:#777;font-size:12px">
						<tbody>
							<tr style="background-color:#ccc;text-align:center;color:#3a3a3a">
								<td colspan="4" style="padding:5px">agent details</td>
							</tr>
							<tr style="background-color:#fff;text-align:center;font-weight:bold">
								<td style="padding:5px;width:15%;">Country(*) : </td>
								<td style="padding:5px;width:35%;"><select name="country" id="select"><?php foreach($post_c as $k=>$v){ echo "<option value='".$k."' ".($r['country']==$v ? "selected='selected'" : "").">".$v."</option>"; } ?></select></td>

								<td  style="padding:5px;width:15%;">City : </td>
								<td  style="padding:5px;width:355%;"><input type="text" id="city" name="city" value="<?php echo $r['city']; ?>"></td>

							</tr>
							<tr style="background-color:#fff;text-align:center;font-weight:bold">
								<td  style="padding:5px">Company : </td>
								<td  style="padding:5px"><input type="text" id="cname" name="cname" class="large" value="<?php echo $r['cname']; ?>"></td>
								<td  style="padding:5px">Name : </td>
								<td  style="padding:5px"><input type="text" id="name" name="name" value="<?php echo $r['fname']; ?>"></td>
							</tr>
							<tr style="background-color:#fff;text-align:center;font-weight:bold">
								<td >Phone(s) : </td>
								<td colspan="1"><textarea name="phones" style="margin: 0px; height: 50px; width: 90%;"><?php echo $r['phones']; ?></textarea></td>
								<td >E-mail(s)(*) : </td>
								<td colspan="1"><textarea name="emails" style="margin: 0px; height: 50px; width: 90%;"><?php echo $r['emails']; ?></textarea></td>
							</tr>
							<tr style="background-color:#fff;text-align:center;font-weight:bold">
								<td >Address : </td>
								<td colspan="1"><textarea name="address" style="margin: 0px; height: 50px; width: 90%;"><?php echo $r['address']; ?></textarea></td>
								<td >Desciption : </td>
								<td colspan="1"><textarea name="desc" style="desc: 0px; height: 50px; width: 90%;"><?php echo $r['desc']; ?></textarea></td>
							</tr>
							<tr style="background-color:#fff;text-align:center;font-weight:bold">
								<td style="padding:5px;width:15%;">Shipping type(*) : </td>
								<td style="padding:5px;width:35%;">
									<input type="checkbox" name="deliver[]" value="air" id="air" <?php if($r['ship_air']==1) echo "checked='checked'"; ?>><label for="air">Air</label>
									<input type="checkbox" name="deliver[]" value="sea" id="sea" <?php if($r['ship_sea']==1) echo "checked='checked'"; ?>><label for="sea">Sea</label>
									<input type="checkbox" name="deliver[]" value="land" id="land" <?php if($r['ship_land']==1) echo "checked='checked'"; ?>><label for="land">Land</label>
									<input type="checkbox" name="deliver[]" value="rail" id="rail" <?php if($r['ship_rail']==1) echo "checked='checked'"; ?>><label for="rail">Rail Way</label>
									<input type="checkbox" name="deliver[]" value="charter" id="charter" <?php if($r['ship_charter']==1) echo "checked='checked'"; ?>><label for="charter">Charter Broker</label>
								</td>

								<td  style="padding:5px;width:15%;">Special : </td>
								<td  style="padding:5px;width:355%;"><input type="checkbox" name="special" value="special" id="special" <?php if($r['special']==1) echo "checked='checked'"; ?>><label for="special">Yes this company is our favorite.</label></td>

							</tr>
							<tr style="background-color:#fff;text-align:center;font-weight:bold">
								<td style="padding:5px;width:15%;">Cover Cities : <a href="#" id="addScnt"><img src="../post_forms/images/icons/fam/add.png"></a></td>
								<td style="padding:5px;width:35%;">
									<div id="ccities">
										<?php
										if($r['cover_city']!=""){
											$cities = explode(" | ",$r['cover_city']);
											$_c = 1;
											foreach($cities as $k=>$v){
										?>
										<p>
											<label for="ccities"><input type="text" id="ccities" size="20" name="ccity[]" value="<?php echo $v; ?>" placeholder="New City" /></label>
											<?php
												if($_c>1) echo '<a href="#" id="remScnt"><img src="../post_forms/images/icons/fam/delete.png"></a>';

												echo '</p>';
												$_c++;
											}
										}
										else{
										?>
										<p>
											<label for="ccities"><input type="text" id="ccities" size="20" name="ccity[]" value="" placeholder="New City" /></label>
										</p>
										<?php
										}
										?>
									</div>
								</td>

								<td  style="padding:5px;width:15%;">Active : <input type="checkbox" name="active" value="active" id="active" <?php if($r['active']==1) echo "checked='checked'"; ?>><label for="active">Yes this company is active.</label></td>
								<td  style="padding:5px;width:35%;">
									Fixed Agent : <input type="checkbox" name="fixed" value="fixed" id="fixed" <?php if($r['fixed']==1) echo "checked='checked'"; ?>><label for="fixed">Yes this company is fixed.</label><br>
									Official Office : <input type="checkbox" name="official" value="official" id="official" <?php if($r['official']==1) echo "checked='checked'"; ?>><label for="official">Yes this company is Europost Express Official Registered Office.</label><br>
								</td>

							</tr>
							<tr style="background-color:#fff;text-align:center;font-weight:bold">
								<td colspan="4">
									<button class="btn" name="submit" type="submit">Save agent details</button>
								</td>
							</tr>

						</tbody>
					</table>
				</form>
				Note : the stared phrases are required.
                </div>
            </div>
        </div>
<?php
	}
}

?>
        <div class="grid_10">
            <div class="box round first">
                <h2>Fixed Agents</h2>
                <div class="block">
					<button class="btn btn-orange" onclick="window.location.href='agents.php?fixed=show';">Fixed Agents&nbsp;</button>
				</div>
			</div>
            <div class="box round first">
                <h2>Europost Official Offices</h2>
                <div class="block">
					<button class="btn btn-orange" onclick="window.location.href='agents.php?official=show';">Europost Official Offices&nbsp;</button>
				</div>
			</div>
            <div class="box round first">
                <h2>Add New Agent</h2>
                <div class="block">
				<form method="post">
					<input type="hidden" name="t" value="1">
					<table border="1" style="margin-left:auto;margin-right:auto;width:90%;border-collapse:collapse;border-color:#777;font-size:12px">
						<tbody>
							<tr style="background-color:#ccc;text-align:center;color:#3a3a3a">
								<td colspan="4" style="padding:5px">agent details</td>
							</tr>
							<tr style="background-color:#fff;text-align:center;font-weight:bold">
								<td style="padding:5px;width:15%;">Country(*) : </td>
								<td style="padding:5px;width:35%;"><select name="country" id="select"><?php foreach($post_c as $k=>$v){ echo "<option value='".$k."'>".$v."</option>"; } ?></select></td>

								<td  style="padding:5px;width:15%;">City : </td>
								<td  style="padding:5px;width:355%;"><input type="text" id="city" name="city"></td>

							</tr>
							<tr style="background-color:#fff;text-align:center;font-weight:bold">
								<td  style="padding:5px">Company : </td>
								<td  style="padding:5px"><input type="text" id="cname" name="cname" class="large"></td>
								<td  style="padding:5px">Name : </td>
								<td  style="padding:5px"><input type="text" id="name" name="name"></td>
							</tr>
							<tr style="background-color:#fff;text-align:center;font-weight:bold">
								<td >Phone(s) : </td>
								<td colspan="1"><textarea name="phones" style="margin: 0px; height: 50px; width: 90%;"></textarea></td>
								<td >E-mail(s)(*) : </td>
								<td colspan="1"><textarea name="emails" style="margin: 0px; height: 50px; width: 90%;"></textarea></td>
							</tr>
							<tr style="background-color:#fff;text-align:center;font-weight:bold">
								<td >Address : </td>
								<td colspan="1"><textarea name="address" style="margin: 0px; height: 50px; width: 90%;"></textarea></td>
								<td >Desciption : </td>
								<td colspan="1"><textarea name="desc" style="desc: 0px; height: 50px; width: 90%;"></textarea></td>
							</tr>
							<tr style="background-color:#fff;text-align:center;font-weight:bold">
								<td style="padding:5px;width:15%;">Shipping type(*) : </td>
								<td style="padding:5px;width:35%;">
									<input type="checkbox" name="deliver[]" value="air" id="air"><label for="air">Air</label>
									<input type="checkbox" name="deliver[]" value="sea" id="sea"><label for="sea">Sea</label>
									<input type="checkbox" name="deliver[]" value="land" id="land"><label for="land">Land</label>
									<input type="checkbox" name="deliver[]" value="rail" id="rail"><label for="rail">Rail Way</label>
									<input type="checkbox" name="deliver[]" value="charter" id="charter"><label for="charter">Charter Broker</label>
								</td>

								<td  style="padding:5px;width:15%;">Special : </td>
								<td  style="padding:5px;width:355%;"><input type="checkbox" name="special" value="special" id="special"><label for="special">Yes this company is our favorite.</label></td>

							</tr>
							<tr style="background-color:#fff;text-align:center;font-weight:bold">
								<td style="padding:5px;width:15%;">Cover Cities : <a href="#" id="addScnt"><img src="../post_forms/images/icons/fam/add.png"></a></td>
								<td style="padding:5px;width:35%;">
									<div id="ccities">
										<p>
											<label for="ccities"><input type="text" id="ccities" size="20" name="ccity[]" value="" placeholder="New City" /></label>
										</p>
									</div>
								</td>

								<td  style="padding:5px;width:15%;">Active : <input type="checkbox" name="active" value="active" id="active" <?php if(isset($r['active']) && $r['active']==1) echo "checked='checked'"; ?>><label for="active">Yes this company is active.</label></td>
								<td  style="padding:5px;width:355%;">
									Fixed Agent : <input type="checkbox" name="fixed" value="fixed" id="fixed"><label for="fixed">Yes this company is fixed.</label><br>
									Official Agent : <input type="checkbox" name="official" value="official" id="official"><label for="official">Yes this company is Europost Express Official Registered Office.</label><br>

								</td>

							</tr>
							<tr style="background-color:#fff;text-align:center;font-weight:bold">
								<td colspan="4">
									<button class="btn" name="submit" type="submit">Add new agent</button>
								</td>
							</tr>

						</tbody>
					</table>
				</form>
				Note : the stared phrases are required.
                </div>
            </div>
        </div>

    <div class="grid_10">
        <div class="box round first">
            <h2>Search By country</h2>
            <form method="get" action="<?= (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . '://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] ?>">
                <div class="input-group" style="margin-top: 10px">
                    <select name="post_c_key" id="post_c_key" autocomplete="on">
                        <?php foreach ($countriesOriginal as $key=>$countryName) {
                            echo "<option value='$key'>$countryName</option>";
                        } ?>
                    </select>
                    <button class="btn btn-primary">search</button>
                </div>
            </form>
        </div>
    </div>

    <div class="grid_10">
            <div class="box round first">
                <h2>Your Agents</h2>
                <div class="block">
				<p class="start">Here is a list of our agents in order of country names, if you don't see any agent in specific country that means that you did not add it to your list, so please use the form above.</p>
				<p>Note : The special agents are marked by blue color and stared on their name.<br>Note : The In-Active agents are marked by gray color.</p>

<?php
if(isset($_GET['start']) AND $_GET['start']!='' AND $_GET['start']!=null AND strlen($_GET['start'])==1 AND in_array($_GET['start'],range('A','Z'))){
	$key = $_GET['start'];
}
else{
	$key = 'A';
}
echo '<p>Choose the first letter of target country: ';
foreach(range('A','Z') as $letter) { print '<a href="?start='.$letter.'" '.($letter==$key ? "style='color: red;text-decoration: none;border-bottom: 1px solid green;'" : "").'>'.$letter . '</a>&nbsp;'; }
echo '</p>';
$con = mysql_connect(DB_HOST,DB_USER,DB_PASS) or die(mysql_error());
mysql_select_db(DB_NAME, $con) or die(mysql_error());
//SELECT * FROM `agents` WHERE `country` LIKE 'B%';
foreach($post_c as $k=>$v){
	if (substr($v, 0, 1) != $key) continue;
	$q = "SELECT count(*) as ca FROM `agents` WHERE `country`='".$v."' ORDER BY `id` ASC";
	$r = mysql_query($q);
	$row = mysql_fetch_array($r);
	if($row['ca']>0){
		echo "<pre>";
		echo $v . " (Agents Count : ".$row['ca'].")<br>";
		$q = "SELECT * FROM `agents` WHERE `country`='".$v."' ORDER BY `id` ASC";
		$r = mysql_query($q);
		$output = "";
		while($row = mysql_fetch_array($r)){//9999ff
			$output .= "<tr ".($row['special']==1 ? "style=\"background-color:#99ccff;text-align:ltr;color:#3a3a3a\"" : ($row['active']==0 ? "style=\"background-color:#e0e0d2;text-align:ltr;color:#3a3a3a\"" : "")).">";
			$output .= "<td style=\"padding:5px\">".$row['id']."</td>";
			$output .= "<td style=\"padding:5px\">".$row['city']."</td>";
			$output .= "<td>".$row['cname']." ".($row['special']==1 ? "<img src=\"img/star_list.png\" title='This agent is special.' alt='Special'>" : "")." ".($row['fixed']==1 ? "<img src=\"fixed.gif\" title='This is a fixed agent.' alt='Fixed'>" : "")."</td>";
			$output .= "<td>".$row['fname']."</td>";
			$ship = array();
			if($row['ship_air']==1) $ship[] = "Air";
			if($row['ship_sea']==1) $ship[] = "Sea";
			if($row['ship_land']==1) $ship[] = "Land";
			if($row['ship_rail']==1) $ship[] = "Rail Way";
			if($row['ship_charter']==1) $ship[] = "Charter Broker";
			$output .= "<td>".implode(" | ", $ship)."</td>";
			unset($ship);
			$output .= "<td>".str_replace(" | ","<br>",$row['cover_city'])."</td>";
			$output .= "<td>".nl2br($row['phones'])."</td>";
			$output .= "<td>".nl2br($row['emails'])."</td>";
			$output .= "<td>".nl2br($row['address'])."</td>";
			$output .= "<td>".nl2br($row['desc'])."</td>";
			$output .= "<td><a href='?edit=".$row['id']."'>Edit</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href='#' OnClick=\"ConfirmFunc('".$row['cname']."','".$row['id']."');\">Delete</a></td>";
			$output .= "</tr>";
		}
		?>
<table border="1" style="margin-left:auto;margin-right:auto;width:98%;border-collapse:collapse;border-color:#777;font-size:12px">
	<tbody>
		<tr style="background-color:#ccc;text-align:center;color:#3a3a3a">
			<td style="padding:5px">ID</td>
			<td style="padding:5px">City</td>
			<td >Company</td>
			<td >Name</td>
			<td >Shipping Method(s)</td>
			<td >Cover City(s)</td>
			<td >Phone(s)</td>
			<td >E-mail(s)</td>
			<td >Address</td>
			<td >Desciption</td>
			<td >Action</td>
		</tr>
		<?php echo $output; ?>
	</tbody>
</table>
		<?php
		echo "</pre>";
	}
	else{

		echo "<pre>";
		echo $v . " (Agents Count : ".$row['ca'].")<br>";
		echo "</pre>";
	}
}
?>

                </div>
            </div>
        </div>
<?php

}
mysql_close();
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
include("footer.php");
?>
