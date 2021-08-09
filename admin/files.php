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
if(isset($_GET['fullname']) AND $_GET['fullname']!='' AND $_GET['fullname']!=null)
{
	unlink($_GET['fullname']);
	header("Location: files.php");
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
$locations = array(
	'1' => __DIR__ . DIRECTORY_SEPARATOR  ."Admin_Attachments" . DIRECTORY_SEPARATOR ."all_docs". DIRECTORY_SEPARATOR  ."",
	'2' => __DIR__ . DIRECTORY_SEPARATOR  ."Admin_Attachments" . DIRECTORY_SEPARATOR ."agents". DIRECTORY_SEPARATOR  ."",
	'3' => __DIR__ . DIRECTORY_SEPARATOR  ."Admin_Attachments" . DIRECTORY_SEPARATOR ."others". DIRECTORY_SEPARATOR  .""
);

$error_m = "";
if(isset($_FILES['uploaded_file']['name']) AND is_array($_FILES['uploaded_file']['name']) AND count($_FILES['uploaded_file']['name'])>0){
	
	$target_dir = __DIR__ . DIRECTORY_SEPARATOR  ."attachments" . DIRECTORY_SEPARATOR;
	
	foreach($_FILES['uploaded_file']['name'] as $k => $upload){
		if(isset($_FILES['uploaded_file']['name'][$k]) AND $_FILES['uploaded_file']['name'][$k] !="" AND $_FILES['uploaded_file']['name'][$k]!=null AND isset($_POST['type'][$k]) AND $_POST['type'][$k]>0 AND $_POST['type'][$k]<4){
			
			$target_dir = $locations[$_POST['type'][$k]];
			
			$target_file = $target_dir . basename($_FILES['uploaded_file']['name'][$k]);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			$format = explode(".",basename($_FILES['uploaded_file']['name'][$k]));
			$format = $format[(count($format)-1)];
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
                <h2>Add New Files</h2>
                <div class="block">
					<p class="start">You can upload some files to send them directly in emails download them in case you need.<br>
					you can upload upto 10 files per using this part.
					</p>
					<form method="post" enctype="multipart/form-data">
						File&nbsp;1&nbsp;:&nbsp;<input type="file" id="attachment" name="uploaded_file[]" accept=".gif,.jpg,.jpeg,.png,.pdf,.zip,.rtf,.doc,.docx,.xls,.xlsx">&nbsp;&nbsp;<select name="type[]"><option value="1">All documents</option><option value="2">Our agent invoice,for this job</option><option value="3">Other</option></select><br>
						File&nbsp;2&nbsp;:&nbsp;<input type="file" id="attachment" name="uploaded_file[]" accept=".gif,.jpg,.jpeg,.png,.pdf,.zip,.rtf,.doc,.docx,.xls,.xlsx">&nbsp;&nbsp;<select name="type[]"><option value="1">All documents</option><option value="2">Our agent invoice,for this job</option><option value="3">Other</option></select><br>
						File&nbsp;3&nbsp;:&nbsp;<input type="file" id="attachment" name="uploaded_file[]" accept=".gif,.jpg,.jpeg,.png,.pdf,.zip,.rtf,.doc,.docx,.xls,.xlsx">&nbsp;&nbsp;<select name="type[]"><option value="1">All documents</option><option value="2">Our agent invoice,for this job</option><option value="3">Other</option></select><br>
						File&nbsp;4&nbsp;:&nbsp;<input type="file" id="attachment" name="uploaded_file[]" accept=".gif,.jpg,.jpeg,.png,.pdf,.zip,.rtf,.doc,.docx,.xls,.xlsx">&nbsp;&nbsp;<select name="type[]"><option value="1">All documents</option><option value="2">Our agent invoice,for this job</option><option value="3">Other</option></select><br>
						File&nbsp;5&nbsp;:&nbsp;<input type="file" id="attachment" name="uploaded_file[]" accept=".gif,.jpg,.jpeg,.png,.pdf,.zip,.rtf,.doc,.docx,.xls,.xlsx">&nbsp;&nbsp;<select name="type[]"><option value="1">All documents</option><option value="2">Our agent invoice,for this job</option><option value="3">Other</option></select><br>
						File&nbsp;6&nbsp;:&nbsp;<input type="file" id="attachment" name="uploaded_file[]" accept=".gif,.jpg,.jpeg,.png,.pdf,.zip,.rtf,.doc,.docx,.xls,.xlsx">&nbsp;&nbsp;<select name="type[]"><option value="1">All documents</option><option value="2">Our agent invoice,for this job</option><option value="3">Other</option></select><br>
						File&nbsp;7&nbsp;:&nbsp;<input type="file" id="attachment" name="uploaded_file[]" accept=".gif,.jpg,.jpeg,.png,.pdf,.zip,.rtf,.doc,.docx,.xls,.xlsx">&nbsp;&nbsp;<select name="type[]"><option value="1">All documents</option><option value="2">Our agent invoice,for this job</option><option value="3">Other</option></select><br>
						File&nbsp;8&nbsp;:&nbsp;<input type="file" id="attachment" name="uploaded_file[]" accept=".gif,.jpg,.jpeg,.png,.pdf,.zip,.rtf,.doc,.docx,.xls,.xlsx">&nbsp;&nbsp;<select name="type[]"><option value="1">All documents</option><option value="2">Our agent invoice,for this job</option><option value="3">Other</option></select><br>
						File&nbsp;9&nbsp;:&nbsp;<input type="file" id="attachment" name="uploaded_file[]" accept=".gif,.jpg,.jpeg,.png,.pdf,.zip,.rtf,.doc,.docx,.xls,.xlsx">&nbsp;&nbsp;<select name="type[]"><option value="1">All documents</option><option value="2">Our agent invoice,for this job</option><option value="3">Other</option></select><br>
						File&nbsp;10&nbsp;:&nbsp;<input type="file" id="attachment" name="uploaded_file[]" accept=".gif,.jpg,.jpeg,.png,.pdf,.zip,.rtf,.doc,.docx,.xls,.xlsx">&nbsp;&nbsp;<select name="type[]"><option value="1">All documents</option><option value="2">Our agent invoice,for this job</option><option value="3">Other</option></select><br>
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

$dir = $locations[1];

// Open a directory, and read its contents
if (is_dir($dir)){
  if ($dh = opendir($dir)){
    while (($file = readdir($dh)) !== false){
		if($file == '.' OR $file=='..') continue;
		echo "<tr style=\"background-color:#fff;text-align:center;font-weight:bold\">";
		echo "<td style=\"padding:5px;\"><a href='admin". DIRECTORY_SEPARATOR  ."Admin_Attachments" . DIRECTORY_SEPARATOR ."all_docs". DIRECTORY_SEPARATOR  ."".$file."'>".$file."</a></td>";
		echo "<td style=\"padding:5px;\">".$dir.$file."</td>";
		echo "<td style=\"padding:5px;\">".date("Y/m/d H:i:s",filemtime($dir.$file))."</td>";
		echo "<td style=\"padding:5px;\"><a href='files.php?fullname=".$dir.$file."'>Delete</a></td>";
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
                <h2>Agents Type Files</h2>
                <div class="block">
				<p class="start">Here is a list of your agents type files has been uploaded before.</p>
					<table border="1" style="margin-left:auto;margin-right:auto;width:90%;border-collapse:collapse;border-color:#777;font-size:12px">
						<tbody>
							<tr style="background-color:#ccc;text-align:center;color:#3a3a3a">
								<td style="padding:5px; width:20%;">name</td>
								<td style="padding:5px; width:50%;">Location</td>
								<td style="padding:5px; width:50%;">Upload/Modify Date</td>
								<td style="padding:5px; width:15%;">Action</td>
							</tr>
<?php

$dir = $locations[2];

// Open a directory, and read its contents
if (is_dir($dir)){
  if ($dh = opendir($dir)){
    while (($file = readdir($dh)) !== false){
		if($file == '.' OR $file=='..') continue;
		echo "<tr style=\"background-color:#fff;text-align:center;font-weight:bold\">";
		echo "<td style=\"padding:5px;\"><a href='admin". DIRECTORY_SEPARATOR  ."Admin_Attachments" . DIRECTORY_SEPARATOR ."agents". DIRECTORY_SEPARATOR  ."".$file."'>".$file."</a></td>";
		echo "<td style=\"padding:5px;\">".$dir.$file."</td>";
		echo "<td style=\"padding:5px;\">".date("Y/m/d H:i:s",filemtime($dir.$file))."</td>";
		echo "<td style=\"padding:5px;\"><a href='files.php?fullname=".$dir.$file."'>Delete</a></td>";
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
                <h2>Other Type Files</h2>
                <div class="block">
				<p class="start">Here is a list of your other type files has been uploaded before.</p>
					<table border="1" style="margin-left:auto;margin-right:auto;width:90%;border-collapse:collapse;border-color:#777;font-size:12px">
						<tbody>
							<tr style="background-color:#ccc;text-align:center;color:#3a3a3a">
								<td style="padding:5px; width:20%;">name</td>
								<td style="padding:5px; width:50%;">Location</td>
								<td style="padding:5px; width:50%;">Upload/Modify Date</td>
								<td style="padding:5px; width:15%;">Action</td>
							</tr>
<?php

$dir = $locations[3];

// Open a directory, and read its contents
if (is_dir($dir)){
  if ($dh = opendir($dir)){
    while (($file = readdir($dh)) !== false){
		if($file == '.' OR $file=='..') continue;
		echo "<tr style=\"background-color:#fff;text-align:center;font-weight:bold\">";
		echo "<td style=\"padding:5px;\"><a href='admin". DIRECTORY_SEPARATOR  ."Admin_Attachments" . DIRECTORY_SEPARATOR ."others". DIRECTORY_SEPARATOR  ."".$file."'>".$file."</a></td>";
		echo "<td style=\"padding:5px;\">".$dir.$file."</td>";
		echo "<td style=\"padding:5px;\">".date("Y/m/d H:i:s",filemtime($dir.$file))."</td>";
		echo "<td style=\"padding:5px;\"><a href='files.php?fullname=".$dir.$file."'>Delete</a></td>";
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