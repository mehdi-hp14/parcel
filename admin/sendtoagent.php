<?php 
ob_start();
include("../post_forms/cnf.php");
include("conf.php");

if(!(isset($_SESSION['loged_in']) AND isset($_SESSION['loged_in_t']) AND $_SESSION['loged_in']==true AND $_SESSION['loged_in_t']>=time())){

	header("Location: index.php");
	exit("You are not logged in....<br><a href='index.php'>Dashboard</a>");
}

if(isset($_SESSION['loged_in']) AND isset($_SESSION['loged_in_t']) AND $_SESSION['loged_in']==true AND $_SESSION['loged_in_t']>=time()){
	$_SESSION['loged_in_t'] = time()+time_out;
}
if(!(isset($_POST['itemid']) AND is_numeric($_POST['itemid']) AND $_POST['itemid']>0 AND $_POST['itemid']!='') OR (!(isset($_POST['agents']) AND is_array($_POST['agents']) AND count($_POST['agents'])>0) AND !(isset($_POST['a_email']) AND is_array($_POST['a_email']) AND count($_POST['a_email'])>0))){

	header("Location: dashboard.php");
	exit("You are logged in....<br><a href='dashboard.php'>Dashboard</a>");
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
	
	
	<script type="text/javascript" src="ckeditor/ckeditor.js"></script>

    <script type="text/javascript">

        $(document).ready(function () {
            //setupTinyMCE();
            //setupDashboardChart('chart1');
            setupLeftMenu();
			setSidebarHeight();

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
$(function() {
        var scntDiv = $('#attach_d');
        var i = $('#attach_d p').size() + 1;
        
        $('#addScnt').live('click', function() {
			
                $('<p><label for="attachment"><input type="file" id="attachment" name="uploaded_file[]" accept=".gif,.jpg,.jpeg,.png,.pdf,.zip,.rtf,.doc,.docx,.xls,.xlsx"></label>&nbsp;&nbsp;<a href="#" id="addScnt"><img src="../post_forms/images/icons/fam/add.png"></a>&nbsp;<a href="#" id="remScnt"><img src="../post_forms/images/icons/fam/delete.png"></a>&nbsp;&nbsp;&nbsp;please note that supported extentions are (.gif,.jpg,.jpeg,.png,.pdf,.zip) And maximum size is 2MB.</p>').appendTo(scntDiv);
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
 
function ajax_msg(item_id){
	
	var choosemsgemail = document.getElementById('choosemsgemail');
	var p = choosemsgemail.options[choosemsgemail.selectedIndex].value;
	
	if(p!='-'){
	
		var dataString = 'item_id='+item_id+'&mid='+p;
		$.ajax({
			type: "POST",
			url: "ajax.php?cmd=load_msg",
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

$itemid = 0;

if(isset($_POST['itemid']) AND $_POST['itemid']!='' AND is_numeric($_POST['itemid']) AND $_POST['itemid']>0){
		$itemid = $_POST['itemid'];
}
if(isset($_GET['itemid']) AND $_GET['itemid']!='' AND is_numeric($_GET['itemid']) AND $_GET['itemid']>0){
		$itemid = $_GET['itemid'];
}

if($itemid>0){
	$q = "SELECT *, count(*) as cq FROM `quote` WHERE `id` = ".$itemid."";
	$row2 = mysql_fetch_array(mysql_query($q));
	if($row2['cq']!=1){
		header("Location: dashboard.php");
		exit;
	}
}else{
	header("Location: dashboard.php");
	exit;
}

$emails = array();
if(isset($_POST['agents']) AND is_array($_POST['agents']) AND count($_POST['agents'])>0){
	foreach($_POST['agents'] as $agent){
		$qq = "SELECT emails,cname,fname,id, count(*) as cq FROM `agents` WHERE `id` = ".$agent."";
		$roww = mysql_fetch_array(mysql_query($qq));
		if($roww['cq']==1){
			$emails[$roww['id']."_|_".$roww['cname']."_|_".(($roww['fname']!='') ? $roww['fname'] : "Sir/Madam")."_|_".rand(1,9999)] = explode("\n",$roww['emails']);
		}
	}
}

if(isset($_POST['a_email']) AND is_array($_POST['a_email']) AND count($_POST['a_email'])>0){
	foreach($_POST['a_email'] as $agent){
		$tmp = explode("_|_", $agent);
		$emails[$tmp[0]."_|_".$tmp[1]."_|_".rand(1,9999)] = array($tmp[2],$tmp[4]);
	}
}

if(count($emails)<=0){
	header("Location: dashboard.php");
	exit;
}

/*
image/gif
image/png
image/jpeg
application/pdf
*/


$error_m = "";
if(isset($_POST['t']) AND $_POST['t']==1){
	function CT($ext){
		switch($ext){
			case 'png' : return 'image/png'; break;
			case 'gif' : return 'image/gif'; break;
			case 'jpg' : 
			case 'jpeg' : 
				return 'image/jpeg'; break;
			case 'pdf' : return 'application/pdf'; break;
			case 'zip' : return 'application/zip'; break;
		}
	}
	if(isset($_POST['title']) AND $_POST['title']!='' AND $_POST['title']!=null){
		if(isset($_POST['message']) AND $_POST['message']!='' AND $_POST['message']!=null){
			$has_attach = false;
			$send = false;
			
			$Attachments = array();
			//$message_p1 = "";
			//$message_p2 = "";
			
			
			if(isset($_FILES['uploaded_file']['name']) AND is_array($_FILES['uploaded_file']['name']) AND count($_FILES['uploaded_file']['name'])>0){
				
				$target_dir = __DIR__ . DIRECTORY_SEPARATOR  ."attachments" . DIRECTORY_SEPARATOR;
				$uploaded_c = 0;
				
				/*
				$uid = md5(uniqid(time()));
				$eol = PHP_EOL;
				$headers = "From: EuroPostExpress <aircargo@europostexpress.co.uk>".$eol;
				$headers .= "Reply-To: aircargo@europostexpress.co.uk".$eol;
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"";
				
				$message_p1 = "--".$uid.$eol;
				$message_p1 .= "Content-Type: text/html; charset=UTF-8".$eol;
				$message_p1 .= "Content-Transfer-Encoding: 8bit".$eol.$eol;
				$message_p2 = $eol."";
				$message_p2 .= "--".$uid.$eol;
				*/
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
								//$send = true;
								$error_m .= "The file ". basename( $_FILES['uploaded_file']['name'][$k]). " has been uploaded.<br>";
								
								$Attachments[] = $target_file;
								
								/*
								
								$file_size = filesize($target_file);
								$handle = fopen($target_file, "r");
								$content = fread($handle, $file_size);
								fclose($handle);
								$content = chunk_split(base64_encode($content));

								$name = basename($target_file);
								
								
								
								$message_p2 .= "Content-Type: ".CT($imageFileType)."; name=\"".$filename."\"".$eol;
								$message_p2 .= "Content-Transfer-Encoding: base64".$eol;
								$message_p2 .= "Content-Disposition: attachment; filename=\"".$filename."\"".$eol;
								$message_p2 .= $content.$eol;
								$message_p2 .= "--".$uid.$eol;
								*/
							}
						}
					}
				}
				//$message_p2 .= "--";
			}
			//echo $message_p1 ."yes".$eol.$message_p2."<br>";
			if(($uploaded_c==count($_FILES['uploaded_file']['name']) AND $has_attach) OR !$has_attach){
				$send = true;
			} 
			
			if($send){
				/*
				if(!$has_attach AND FALSE){
					$message_p1 = $message_p2 = '';
					$headers  = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type: text/html; charset=utf-8;' . "\r\n";
					$headers .= 'From: EuroPostExpress <aircargo@europostexpress.co.uk>' . "\r\n";
					$headers .= 'X-Sender: aircargo@europostexpress.co.uk' . "\r\n";
					$headers .= 'Reply-To: aircargo@europostexpress.co.uk' . "\r\n";
				}
				*/
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
				//$txt .= "\n";
				//$txt .= '$header=\''.$headers.'\';';
				//$txt .= "\n";
				//$txt .= '$pre1=\''.$message_p1.'\';';
				//$txt .= "\n";
				//$txt .= '$pre2=\''.$message_p2.'\';';
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
					list($id,$cname,$cc) = explode("_|_",$cname1);
					//'' => array('company'=>'238','name'=>'aircargo@europostexpress.co.uk','id'=>'Fazel Zohrabpour',),
					$txt .= "\t'".$email[1]."' => array('company'=>'".$cname."','name'=>'".$email[0]."','ref'=>'".$itemid."','id'=>'".$id."','setparam'=>'".($_POST['choosemsgemail']==3 ? "true" : "false")."',),\n";
				}
				$txt .= ");\n";
				$txt .= "?>";
				
				unlink("mail_address.php");
				writeStringToFile("mail_address.php",$txt);
				//$send = false;
				$error_m .= "The needed files have been saved. your sending process will be start in <span id='countd'>5</span> seconds.<br>Note: your request of sending mail won be put in queue, means that if you send request before ending the process the prevous process will end. and new one will proceed.<br>";

				/*
				if($has_attach){
					foreach($emails as $cname1 => $email){
						list($cname,$cc) = explode("_|_",$cname1);
						
						$tmp_body = $_POST['message'];
						$aname = $email[0];
						
						$tmp_body = str_replace("{company_name}", $cname, $tmp_body, $_c);
						$tmp_body = str_replace("agent_name", $aname, $tmp_body, $_c);
						


						if (mail($email[1], $_POST['title'], $message_p1.$tmp_body.$message_p2, $headers))
						{
							$error_m .= $cname . " : ".$email[1]. " : ".$email[0]." Sent Successfully<br>";
						}
						else
						{
							$error_m .= $cname . " : ".$email[1]. " : ".$email[0]." Sending was not successful.<br>";
						}
					}
				}
				else{
					foreach($emails as $cname1 => $email){
						list($cname,$cc) = explode("_|_",$cname1);
						
						$tmp_body = $_POST['message'];
						$aname = $email[0];
						
						$tmp_body = str_replace("{company_name}", $cname, $tmp_body, $_c);
						$tmp_body = str_replace("agent_name", $aname, $tmp_body, $_c);
						
						

						if (mail($email[1], $_POST['title'], $tmp_body, $headers))
						{
							$error_m .= $cname . " : ".$email[1]. " : ".$email[0]." Sent Successfully<br>";
						}
						else
						{
							$error_m .= $cname . " : ".$email[1]. " : ".$email[0]." Sending was not successful.<br>";
						}
					}
				}*/
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
else{
?>
        <div class="grid_10">
            <div class="box round first">
                <h2>Send To Agent</h2>
                <div class="block">
				<form method="post" enctype="multipart/form-data">
					<input type="hidden" name="t" value="1">
					<input type="hidden" name="itemid" value="<?php echo $itemid; ?>">
					<table border="1" style="margin-left:auto;margin-right:auto;width:90%;border-collapse:collapse;border-color:#777;font-size:12px">
						<tbody>
							<tr style="background-color:#ccc;text-align:center;color:#3a3a3a">
								<td colspan='4' style="padding:5px">Agents</td>
							</tr>
							<tr style="background-color:#fff;text-align:center;font-weight:bold">
								<td style="padding:5px; width:20%;">Company</td>
								<td colspan="3" style="padding:5px; width:80%;">Email(s) (Select All <input type="checkbox" id="checkall" >)</td>
							</tr>
							<?php
								foreach($emails as $company => $email){
									echo "<tr style=\"background-color:#fff;text-align:center;font-weight:bold\">";
									$tmp = explode("_|_",$company);
									echo "<td width='20%'>".$tmp[1]."</td>";
									echo "<td colspan=\"3\" width='80%'>";
									foreach($email as $k=>$v){
										$v = trim($v);
										echo "<input type='checkbox' name='a_email[]' value='".$company."_|_".$v."' id='".$company."_|_".$k."'>&nbsp;<label for='".$company."_|_".$k."'>".$v."</label>&nbsp;&nbsp;&nbsp;";
									}
									echo "</td>";
									echo "</tr>";
								}
							?>
							<tr style="background-color:#ccc;text-align:center;color:#3a3a3a">
								<td colspan='4' style="padding:5px">Message</td>
							</tr>
							<tr style="background-color:#fff;text-align:center;font-weight:bold">
								<td style="padding:5px;" width='25%'>Subject</td>
								<td style="padding:5px" width='25%'><input type="text" id="title" name="title" value="New Quote request from <?php echo $row2['from']; ?>,to <?php echo $row2['to']; ?> ,ref EPX-<?php echo $country_iso[$row2['from']]."-".$country_iso[$row2['to']]."-".$row2['id']; ?>"></td>
								<td width='25%'>Pre-defined Message:</td>
								<td width='25%'>
									<select  name="choosemsgemail" id="choosemsgemail"  onchange="ajax_msg('<?php echo $itemid; ?>');">
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
									<button class="btn" name="submit" type="submit">Send</button>
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
ob_flush();
?>