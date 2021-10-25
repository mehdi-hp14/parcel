<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
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
                                <li><a href="tickets.php">Support Tickets</a> </li>
                                <li><a href="users.php">User Management</a> </li>
                                <li><a href="news.php">News And ToS</a> </li>
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
<?php
if(isset($_POST['t']) AND $_POST['t']!="" AND $_POST['t']!=null){
$con = mysql_connect(DB_HOST,DB_USER,DB_PASS) or die(mysql_error());
$error_m = "";
mysql_select_db(DB_NAME, $con) or die(mysql_error());
	switch($_POST['t']){
		case 1:
		$error = true;
			if(isset($_POST['title']) AND $_POST['title']!="" AND $_POST['title']!=null){
				if(isset($_POST['message']) AND $_POST['message']!="" AND $_POST['message']!=null){
					if(isset($_POST['type']) AND $_POST['type']!="" AND $_POST['type']!=null AND is_numeric($_POST['type']) AND $_POST['type']>0 AND $_POST['type']<4){
						$title = $_POST['title'];
						$message = $_POST['message'];
						$type = $_POST['type'];
						$error = false;
						
						mysql_query("INSERT INTO `prenotes` (`title`, `message`, `type`, `time`) VALUES ('".$title."','".$message."', '".$type."','".time()."');") or die(mysql_error());
						$error_m = "Message Successfully added.";
					}
					else{
						$error_m = "type is required.";
					}
				}
				else{
					$error_m = "Message is required.";
				}
			}
			else{
				$error_m = "title Country Name.";
			}
		break;
		
	}
mysql_close();
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
?>
        <div class="grid_10">
            <div class="box round first">
                <h2>Add New Pre-Defined Message</h2>
                <div class="block">
				<p class="start">You can add pre-defined messages and use them to answer quickly to the e-mails and Tracking messages.</p>
				<form method="post">
					<input type="hidden" name="t" value="1">
					<table border="1" style="margin-left:auto;margin-right:auto;width:90%;border-collapse:collapse;border-color:#777;font-size:12px">
						<tbody>
							<tr style="background-color:#ccc;text-align:center;color:#3a3a3a">
								<td style="padding:5px; width:20%;">Title</td>
								<td style="padding:5px; width:50%;">Value</td>
								<td style="padding:5px; width:30%;">Desciption</td>
							</tr>
							<tr style="background-color:#fff;text-align:center;font-weight:bold">
								<td style="padding:5px;">Title</td>
								<td style="padding:5px"><input type="text" id="title" name="title"></td>
								<td style="padding:5px">This is just for yourself to know what is it for next use.</td>
								
							</tr>
							<tr style="background-color:#fff;text-align:center;font-weight:bold">
								<td style="padding:5px;">Message</td>
								<td style="padding:5px;"><textarea name="message" class="ckeditor" style="margin: 5px; height: 75px; width:80%;"></textarea></td>
								<td style="padding:5px;">
									This is the message that you can send or forward it.
								</td>
							</tr>
							<tr style="background-color:#fff;text-align:center;font-weight:bold">
								<td style="padding:5px;">Type</td>
								<td style="padding:5px;"><select name="type"><option value="1">Emails</option><option value="2">Tracking Message</option><option value="3">Forward to a Agent</option></select></td>
								<td style="padding:5px;">Where do you want to use?(Emails ? Tracking Messages ? Or Email to agent?</td>
								
							</tr>
							<tr style="background-color:#fff;text-align:center;font-weight:bold">
								<td colspan="3">
									<button class="btn" name="submit" type="submit">Confirm</button>
								</td>
							</tr>
							
						</tbody>
					</table>
				</form>
				Note : all fields are required.<br>
				You can use the following tag anywhere in message:<br>
				{offer_price} : The Offered Price (Including the currency)(Not work for agents messages)<br>
				{dgr} : Dangerous Goods <br>
				{li_bat} : Lithium-ion Battery<br>
				{chemical} : Chemical Goods<br>
				{dgr_alert} : Warnning For DGR(Not work for agents messages)<br>
				{tid} : Tracking ID<br>
				{PaymentStatus} : Payment Status<br>
				{MAWB} : MAWB<br>
				{HAWB} : HAWB<br>
				{from_country} : Collection Country<br>
				{to_country} : Destination Country<br>
				{from_loc} : Collection state and zip code<br>
				{to_loc} : Destination  state and zip code<br>
				{item_count} : Item Count<br>
				{item_dims} : Item Dimensions<br>
				{item_weight} : Item Weight<br>
				{item_Desc} : Item Desciption<br>
				{note_value} : Note - Good Value<br>
				{GenerateUniqeURL} : URL For Tell the Cost (Only for agents messages.)<br>
				{CountryName} : Country Name (Only for fixed agents messages.)<br>
				{company_name} : Comapny Name (Only for agents messages.)<br>
				agent_name : Comapny Name (Only for agents messages.)<br>
				{usa_iran_transit} 4 questions and their answers for quote from USA to Iran (only for agents messages)
                </div>
            </div>
        </div>
        <div class="grid_10">
            <div class="box round first">
                <h2>Emails Pre-Defined Message</h2>
                <div class="block">
				<p class="start">Here is a list of your pre-defined messages, You can use the following messages as Emails messages.</p>
					<table border="1" style="margin-left:auto;margin-right:auto;width:90%;border-collapse:collapse;border-color:#777;font-size:12px">
						<tbody>
							<tr style="background-color:#ccc;text-align:center;color:#3a3a3a">
								<td style="padding:5px; width:20%;">Title</td>
								<td style="padding:5px; width:50%;">Message</td>
								<td style="padding:5px; width:15%;">Added Or Modified Date</td>
								<td style="padding:5px; width:15%;">Action</td>
							</tr>
<?php

$con = mysql_connect(DB_HOST,DB_USER,DB_PASS) or die(mysql_error());
mysql_select_db(DB_NAME, $con) or die(mysql_error());
$q = "SELECT * FROM `prenotes` WHERE `type`=1 ORDER BY `id` ASC";
$r = mysql_query($q);
if(mysql_num_rows($r)){
	while($row = mysql_fetch_array($r)){
		echo "<tr style=\"background-color:#fff;text-align:ltr;font-weight:bold\">";
		echo "<td style=\"padding:5px;\">".$row['title']."</td>";
		echo "<td style=\"padding:5px;\">".($row['message'])."</td>";
		echo "<td style=\"padding:5px;\">".date("Y/m/d H:i:s",$row['time'])."</td>";
		echo "<td style=\"padding:5px;\"><a href='premedit.php?id=".$row['id']."'>Edit</a></td>";
		echo "</tr>";
	}
}
else{
	echo "<tr style=\"background-color:#fff;text-align:center;font-weight:bold\">";
	echo "<td colspan='4' style=\"padding:5px;\">No Message is added yet.</td>";
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
                <h2>Tracking Pre-Defined Message</h2>
                <div class="block">
				<p class="start">Here is a list of your pre-defined messages, You can use the following messages as Tracking messages.</p>
					<table border="1" style="margin-left:auto;margin-right:auto;width:90%;border-collapse:collapse;border-color:#777;font-size:12px">
						<tbody>
							<tr style="background-color:#ccc;text-align:center;color:#3a3a3a">
								<td style="padding:5px; width:20%;">Title</td>
								<td style="padding:5px; width:50%;">Message</td>
								<td style="padding:5px; width:15%;">Added Or Modified Date</td>
								<td style="padding:5px; width:15%;">Action</td>
							</tr>
<?php

$con = mysql_connect(DB_HOST,DB_USER,DB_PASS) or die(mysql_error());
mysql_select_db(DB_NAME, $con) or die(mysql_error());
$q = "SELECT * FROM `prenotes` WHERE `type`=2 ORDER BY `id` ASC";
$r = mysql_query($q);
if(mysql_num_rows($r)){
	while($row = mysql_fetch_array($r)){
		echo "<tr style=\"background-color:#fff;text-align:center;font-weight:bold\">";
		echo "<td style=\"padding:5px;\">".$row['title']."</td>";
		echo "<td style=\"padding:5px;\">".nl2br($row['message'])."</td>";
		echo "<td style=\"padding:5px;\">".date("Y/m/d H:i:s",$row['time'])."</td>";
		echo "<td style=\"padding:5px;\"><a href='premedit.php?id=".$row['id']."'>Edit</a></td>";
		echo "</tr>";
	}
}
else{
	echo "<tr style=\"background-color:#fff;text-align:center;font-weight:bold\">";
	echo "<td colspan='4' style=\"padding:5px;\">No Message is added yet.</td>";
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
                <h2>Forward to a Agent Pre-Defined Message</h2>
                <div class="block">
				<p class="start">Here is a list of your pre-defined messages, You can use the following messages as Forward to a Agent messages.</p>
					<table border="1" style="margin-left:auto;margin-right:auto;width:90%;border-collapse:collapse;border-color:#777;font-size:12px">
						<tbody>
							<tr style="background-color:#ccc;text-align:center;color:#3a3a3a">
								<td style="padding:5px; width:20%;">Title</td>
								<td style="padding:5px; width:50%;">Message</td>
								<td style="padding:5px; width:15%;">Added Or Modified Date</td>
								<td style="padding:5px; width:15%;">Action</td>
							</tr>
<?php

$con = mysql_connect(DB_HOST,DB_USER,DB_PASS) or die(mysql_error());
mysql_select_db(DB_NAME, $con) or die(mysql_error());
$q = "SELECT * FROM `prenotes` WHERE `type`=3 ORDER BY `id` ASC";
$r = mysql_query($q);
if(mysql_num_rows($r)){
	while($row = mysql_fetch_array($r)){
		echo "<tr style=\"background-color:#fff;text-align:center;font-weight:bold\">";
		echo "<td style=\"padding:5px;\">".$row['title']."</td>";
		echo "<td style=\"padding:5px;\">".nl2br($row['message'])."</td>";
		echo "<td style=\"padding:5px;\">".date("Y/m/d H:i:s",$row['time'])."</td>";
		echo "<td style=\"padding:5px;\"><a href='premedit.php?id=".$row['id']."'>Edit</a></td>";
		echo "</tr>";
	}
}
else{
	echo "<tr style=\"background-color:#fff;text-align:center;font-weight:bold\">";
	echo "<td colspan='4' style=\"padding:5px;\">No Message is added yet.</td>";
	echo "</tr>";
}
?>							
						</tbody>
					</table>
                </div>
            </div>
        </div>
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