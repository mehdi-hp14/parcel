<?php
include("cnf.php");
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="cache-control" content="no-cache" />
<meta http-equiv="expires" content="0" />
<title>Forms</title>
<link rel="stylesheet" type="text/css" media="screen" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css" />
<link rel="stylesheet" type="text/css" media="all" href="include/form/fonts7.css" />
<link rel="stylesheet" type="text/css" media="all" href="include/form/screen7.css" />
<link rel="stylesheet" type="text/css" media="print" href="include/form/print7.css" />

<!-- CUSTOM STYLE -->
<style type="text/css" media="all">
body{
	background: #ffffff;
	font-family: Arial,Helvetica,sans-serif;
	font-size: 14px;
	margin: 0px;
}

.form_table{
	width: 340px;
	margin-left: 0px;
	margin-right: 0px;
	background: #ffffff;
	color: #333333;
	overflow: hidden;
	moz-box-shadow: inset 0 0 20px #999999;
	webkit-box-shadow: inset 0 0 20px #999999;
	box-shadow: inset 0 0 20px #999999;
	border-radius: 10px;
	-moz-border-radius: 10px;
	-webkit-border-radius: 10px;
	padding-bottom: 15px;
}

.form_table a{
	color: #0000CC;
}

.outside a{
	color: #0000CC;
}

.form_table a:visited{
	color: #990000;
}

.outside a:visited{
	color: #990000;
}

.form_shadow_top{
	display: none;
}

.form_shadow_bottom{
	display: none;
}

.segment_header{
	margin: 1px;
	padding: 22px 0 18px 0;
	color: #FFFFFF;
	background: url(images/forms/gradients/red_short.png);
	width: auto;
	background-repeat: repeat;
}

.q{
	padding-top: 5px;
	padding-right: 25px;
	padding-bottom: 0px;
	padding-left: 25px;
	margin-bottom: 1px;
	margin-left: 5px;
	float: left;
	display: normal;
}

.q .question{
	font-weight: bold;
	font-size: 11pt;
	padding-top: 14px;
}

.q .left_question_first{
	width: 15em;
}

.required .icon{
	background-image: url(images/forms/requiredStar.png);
	background-position: left;
	background-repeat: no-repeat;
	font-size: 13px;
	padding-left: 8px;
}

.q .text_field{
	border: 1px solid #333333;
	color: #000000;
	margin: 1px 0;
	padding: 3px 2px 2px 2px;
	background: #FFFFFF url(images/forms/field_bg.png) top left;
	border-radius: 0;
	font-size: 11pt;
}

.q .file_upload{
	background: #F4F4F4;
	border: 1px solid #333333;
	color: #000000;
	margin-top: 1px;
	border-radius: 0;
	font-size: 12px;
	padding: 3px 2px 2px 2px;
}

.q .file_upload_button{
	margin-top: 2px;
}

.q .inline_grid td{
	padding: 5px;
	vertical-align: baseline;
}

.q .drop_down{
	font-family: Arial,Helvetica,sans-serif;
	width: 200px;
	background-color: #ffcc33;
	border: 1px solid #333333;
	color: #000000;
	margin: 6px 0px;
	padding: 4px;
	font-size: 14pt;
}

.q .matrix th{
	color: #FFFFFF;
	background: url(images/forms/gradients/black_short.png);
	padding: 5px;
	font-weight: bold;
	text-align: center;
	vertical-align: bottom;
}

.q .matrix td{
	padding: 5px;
	text-align: center;
	white-space: nowrap;
	height: 26px;
	border-bottom: 1px solid #CCCCCC;
	border-top: 1px solid #CCCCCC;
}

.q .matrix td.question{
	border-right: 1px solid #CCCCCC;
	font-weight: normal;
}

.q .matrix .multi_scale_sub th{
	font-weight: normal;
	border-top: 1px solid #CCCCCC !important;
	background: url(bg_images/redDiagonal.gif);
}

.q .matrix .multi_scale_break{
	border-right: 1px solid #CCCCCC;
}

.q .matrix_row_dark td{
	color: #000000;
	background: #FFDDDD;
}

.q .matrix_row_dark td.question{
	color: #000000;
	background: #FFB5B5;
}

.q .matrix_row_light td{
	color: #000000;
	background: #F9F9F9;
}

.q .matrix_row_light td.question{
	color: #000000;
	background: #FFDDDD;
}

.q .rating_ranking td{
	padding: 5px;
}

.q .scroller{
	border: 1px solid #000000;
}

.highlight{
	background: #e8e8e8 !important;
	-moz-transition: background-color .25s ease-out;
	-webkit-transition: background-color .25s ease-out;
	transition: background-color .25s ease-out;
}

tr.highlight td{
	background: #e8e8e8 !important;
}

.outside{
	color: #333333;
}

.outside_container{
	width: 340px;
	padding: 1em 0;
	margin-left: 0px;
	margin-right: auto;
	text-align: center;
	color: #333333;
}

.outside_container .submit_button{
	color: #000000;
	background: url(images/forms/gradients/white_short.png);
	border-style: solid;
	border-width: 1px;
	border-color: #000000;
	border-radius: 0;
}

.outside_container .submit_button:hover{
	border-color: #444444;
}

.outside_container .progress_bar{
	background: url(images/forms/gradients/red_short.png);
	margin: 0;
}

.ui-widget{
	font-family: Arial,Helvetica,sans-serif;
}

.invalid{
	background: #FFEEEE;
}

.invalid .invalid_message{
	color: #FF0000;
	background: #FFEEEE;
	border: 1px solid #FF0000;
	border-radius: 3px;
}

.form_table.invalid{
	border: 2px solid #FF0000;
}

.invalid .matrix .invalid_row{
	background: #FFEEEE;
}

.progressBarWrapper{
	border-radius: 10px;
	background: #ffffff;
	background-size: auto;
	border-color: #CCCCCC;
}
.progressBarBack{
	background-color: #008DF2;
	color: #ffffff;
}
.progressBarFront{
	color: #333333;
}
.segment_header{
	margin: 1px;
	color: #ff3333;
	background: url(images/forms/gradients/red_short.png);
	width: auto;
	background-repeat: repeat;
	background-size: auto;
	padding: 0px;
}
.segment_header h1{
	padding: 20px 10px;
	border-radius: 6px;
	font-family: Arial,Helvetica,sans-serif;
}
.outside_container .submit_button{
	font-size: 16px;
}

</style>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
		<script type="text/javascript" src="include/form/form7.js"></script>
		<script type="text/javascript" src="include/form/embed.js"></script><script type="text/javascript">Embed.init('1332349481','');</script>
		<style type="text/css" media="screen" title="EmbedCSSChanges"></style>
	</head>
	<body>
	<?php
	$show_form = true;
	$error = true;
	$output = "";
	if(isset($_POST['Submit']) AND $_POST['Submit']=='Check'){
		if(isset($_POST['RESULT_TextField-13'])){
			$_POST['RESULT_TextField-13'] = str_replace("-","_",$_POST['RESULT_TextField-13']);
			if(preg_match("/^[A-Za-z0-9_]+$/",$_POST['RESULT_TextField-13']) AND strlen($_POST['RESULT_TextField-13'])>=10){
				if(isset($_POST['RESULT_TextField-130']) AND filter_var($_POST['RESULT_TextField-130'], FILTER_VALIDATE_EMAIL)){
					$params = explode("_",$_POST['RESULT_TextField-13']);
					if(isset($params[(count($params)-1)]) AND is_numeric($params[(count($params)-1)]) AND $params[(count($params)-1)]>0){
						$id = $params[(count($params)-1)];
						if($id>0){
							$q = "SELECT count(*) as cq FROM `quote` WHERE `id`=".$id." AND `email`='".$_POST['RESULT_TextField-130']."'";
							$con = mysql_connect(DB_HOST,DB_USER,DB_PASS) or die(mysql_error());
							mysql_select_db(DB_NAME, $con) or die(mysql_error());

							$r = mysql_query($q) or die(mysql_error());
							$res = mysql_fetch_array($r);
							if($res['cq']==1){
								$q = "SELECT * FROM `qstatus` WHERE `rid` = ".$id." ORDER BY `timestamp` ASC";
								$r = mysql_query($q) or die(mysql_error());
								$error = false;
								$show_form = false;
								if(mysql_num_rows($r)>=1){
									while($res = mysql_fetch_array($r)){
										$output .= '<tr style="background-color:#fff;text-align:center;font-weight:bold">';
										$output .= '<td style="padding:15px 0">'.date("Y/m/d H:i:s",$res['timestamp']).'</td>';
										$output .= '<td style="padding:15px 0">'.$res['message'].'</td>';
										$output .= '</tr>';
									}
								}
								else{
									$output .= '<tr style="background-color:#fff;text-align:center;font-weight:bold">';
									$output .= '<td colspan="2" style="padding:15px 0">Your order is under process</td>';
									$output .= '</tr>';
								}
							}
						}
					}
				}
			}
		}
	}
	?>
<?php if($show_form){ ?>
		<form method="post" id="FSForm" action="track.php" enctype="application/x-www-form-urlencoded" onsubmit="return Vromansys.Form.processSubmit(this);">
			<div style="display:none;">
				<input type="hidden" name="pt" id="pt" value="1" />
			</div>
			<?php
			if(isset($_POST['Submit']) AND $_POST['Submit']=='Check' AND $error){
				echo '<div class="form_table invalid" style="margin-bottom:10px"><div class="invalid_message" style="border:none;font-size:1em;padding:6px;text-align:center;">Invalid Tracking ID or E-mail.</div></div>';
			}
			
			?>
			<!-- BEGIN_ITEMS -->
			<div class="form_table">

				<div class="clear"></div>

				<div id="q36" class="q full_width">
					<a class="item_anchor" name="ItemAnchor0"></a>
					<div class="segment_header" style="width:auto;text-align:Center;"><h1 style="font-size:30px;padding:20px 1em ;">Tracking The Order</h1></div>
				</div>

				<div class="clear"></div>

				<div id="q38" class="q full_width">
					<a class="item_anchor" name="ItemAnchor1"></a>
					<div class="full_width_space"><div>&nbsp;</div></div>
				</div>

				<div class="clear"></div>
				<div id="q41" class="q required ">
					<a class="item_anchor" name="ItemAnchor2"></a>
					<label class="question top_question" for="RESULT_TextField-13">Please Enter Your Tracking ID:&nbsp;<span class="icon">&nbsp;</span></label>
					
					<input type="text" name="RESULT_TextField-13" class="text_field" id="RESULT_TextField-13" size="30" maxlength="30" value="" />
				</div>
				<div id="q410" class="q required ">
					<a class="item_anchor" name="ItemAnchor2"></a>
					<label class="question top_question" for="RESULT_TextField-130">Please Enter Your E-mail:&nbsp;<span class="icon">&nbsp;</span></label>
					
					<input type="text" name="RESULT_TextField-130" class="text_field" id="RESULT_TextField-130" size="30" maxlength="30" value="" />
				</div>

				<div class="clear"></div>
			</div>
			<!-- END_ITEMS -->
			<div class="outside_container">
				<div class="buttons_reverse">
					<input type="submit" name="Submit" value="Check" class="submit_button" id="FSsubmit" />
				</div>
			</div>
		</form>
	<?php
	}
	elseif($output!=''){
		?>
		<div class="form_table" style="overflow:auto;">

			<div id="q36" class="q full_width">
				<a class="item_anchor" name="ItemAnchor0"></a>
				<div class="segment_header" style="width:auto;text-align:Center;"><h1 style="font-size:30px;padding:20px 1em ;">Tracking The Order</h1></div>
			</div>

			<div class="clear"></div>
			<table border="1" style="margin-left:auto;margin-right:auto;width:90%;border-collapse:collapse;border-color:#777;font-size:12px">
				<tbody>
					<tr style="background-color:#ccc;text-align:center;color:#3a3a3a">
						<td width="20%" style="padding:5px">Time</td>
						<td width="80%" style="padding:5px">Message</td>
					</tr>
					<?php echo $output; ?>
				</tbody>
			</table>
		</div>
<?php
	}
	?>
	
	</body>
</html>
