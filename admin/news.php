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
    <title>News And ToS | Booking Parcel Admin</title>
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
                                <li><a href="users.php">User Management</a> </li>
                                <li><a href="news.php">News And ToS</a> </li>
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
$error_m = "";
mysql_select_db(DB_NAME, $con) or die(mysql_error());
if(isset($_GET['del']) AND is_numeric($_GET['del']) AND $_GET['del']>0)
{
	mysql_query("DELETE FROM `news` WHERE `id`=".$_GET['del']."");
	//echo "DELETE FROM `news` WHERE `id`=".$_GET['del']."<br>";
}
if(isset($_POST['t']) AND $_POST['t']!="" AND $_POST['t']!=null){
	switch($_POST['t']){
		case 1:
		$error = true;
			if(isset($_POST['title']) AND $_POST['title']!="" AND $_POST['title']!=null){
				if(isset($_POST['message']) AND $_POST['message']!="" AND $_POST['message']!=null){
					if(isset($_POST['type']) AND $_POST['type']!="" AND $_POST['type']!=null AND is_numeric($_POST['type']) AND $_POST['type']>0 AND $_POST['type']<3){
						$title = $_POST['title'];
						$message = $_POST['message'];
						$type = $_POST['type'];
						$error = false;
						
						mysql_query("INSERT INTO `news` (`title`, `text`, `type`, `creation_date`, `status`) VALUES ('".$title."','".$message."', '".$type."','".time()."',1);");
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
                <h2>Add New News Or ToS Message</h2>
                <div class="block">
				<p class="start">You can add "Terms of Use" messages Or News in order to use in User Panel.</p>
				<form method="post">
					<input type="hidden" name="t" value="1">
					<table border="1" style="margin-left:auto;margin-right:auto;width:90%;border-collapse:collapse;border-color:#777;font-size:12px">
						<tbody>
							<tr style="background-color:#ccc;text-align:center;color:#3a3a3a">
								<td style="padding:5px; width:20%;">Title</td>
								<td style="padding:5px; width:50%;">Value</td>
							</tr>
							<tr style="background-color:#fff;text-align:center;font-weight:bold">
								<td style="padding:5px;">Title</td>
								<td style="padding:5px"><input type="text" id="title" name="title"></td>
								
							</tr>
							<tr style="background-color:#fff;text-align:center;font-weight:bold">
								<td style="padding:5px;">Message</td>
								<td style="padding:5px;"><textarea name="message" class="ckeditor" style="margin: 5px; height: 75px; width:80%;"></textarea></td>
							</tr>
							<tr style="background-color:#fff;text-align:center;font-weight:bold">
								<td style="padding:5px;">Type</td>
								<td style="padding:5px;">
									<select name="type">
										<option value="1">News</option>
										<option value="2">ToS</option>
									</select>
								</td>
								
							</tr>
							<tr style="background-color:#fff;text-align:center;font-weight:bold">
								<td colspan="2">
									<button class="btn" name="submit" type="submit">Confirm</button>
								</td>
							</tr>
							
						</tbody>
					</table>
				</form>
                </div>
            </div>
        </div>
        <div class="grid_10">
            <div class="box round first">
                <h2>News Message</h2>
                <div class="block">
				<p class="start">Here is a list of your news messages.</p>
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
$q = "SELECT * FROM `news` WHERE `type`=1 ORDER BY `id` ASC";
$r = mysql_query($q);
if(mysql_num_rows($r)){
	while($row = mysql_fetch_array($r)){
		echo "<tr style=\"background-color:#fff;text-align:ltr;font-weight:bold\">";
		echo "<td style=\"padding:5px;\">".$row['title']."</td>";
		echo "<td style=\"padding:5px;\">".($row['text'])."</td>";
		echo "<td style=\"padding:5px;\">".(($row['modified_date']!="" AND $row['modified_date']> $row['creation_date']) ? date("Y/m/d H:i:s",$row['modified_date']) : date("Y/m/d H:i:s",$row['creation_date']))."</td>";
		echo "<td style=\"padding:5px;\"><a href='news.php?del=".$row['id']."'>Delete</a></td>";
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
                <h2>ToS Message</h2>
                <div class="block">
				<p class="start">Here is a list of your ToS messages.</p>
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
$q = "SELECT * FROM `news` WHERE `type`=2 ORDER BY `id` ASC";
$r = mysql_query($q);
if(mysql_num_rows($r)){
	while($row = mysql_fetch_array($r)){
		echo "<tr style=\"background-color:#fff;text-align:ltr;font-weight:bold\">";
		echo "<td style=\"padding:5px;\">".$row['title']."</td>";
		echo "<td style=\"padding:5px;\">".($row['text'])."</td>";
		echo "<td style=\"padding:5px;\">".(($row['modified_date']!="" AND $row['modified_date']> $row['creation_date']) ? date("Y/m/d H:i:s",$row['modified_date']) : date("Y/m/d H:i:s",$row['creation_date']))."</td>";
		echo "<td style=\"padding:5px;\"><a href='news.php?del=".$row['id']."'>Delete</a></td>";
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