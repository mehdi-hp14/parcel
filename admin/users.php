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
    <!-- BEGIN: load jquery -->
    <script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/jquery-ui/jquery.ui.core.min.js"></script>
    <script src="js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.core.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.slide.min.js" type="text/javascript"></script>
    <!-- END: load jquery -->
    <!-- BEGIN: load jqplot -->
    <link rel="stylesheet" type="text/css" href="css/jquery.jqplot.min.css" />
    <!--[if lt IE 9]><script language="javascript" type="text/javascript" src="js/jqPlot/excanvas.min.js"></script><![endif]-->
    <script language="javascript" type="text/javascript" src="js/jqPlot/jquery.jqplot.min.js"></script>
    <script language="javascript" type="text/javascript" src="js/jqPlot/plugins/jqplot.barRenderer.min.js"></script>
    <script language="javascript" type="text/javascript" src="js/jqPlot/plugins/jqplot.pieRenderer.min.js"></script>
    <script language="javascript" type="text/javascript" src="js/jqPlot/plugins/jqplot.categoryAxisRenderer.min.js"></script>
    <script language="javascript" type="text/javascript" src="js/jqPlot/plugins/jqplot.highlighter.min.js"></script>
    <script language="javascript" type="text/javascript" src="js/jqPlot/plugins/jqplot.pointLabels.min.js"></script>
    <!-- END: load jqplot -->
    <script src="js/setup.js" type="text/javascript"></script>
    <script type="text/javascript">

        $(document).ready(function () {
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
function ConfirmFunc(a) {
	var r = confirm("You are about to delete ticket no."+a+".\nNote: this operation is not reversible.\n Are you sure?");
	if (r == true) {
		window.location.href = "?del="+a;
		x = "You pressed OK!";
	} else {
		//x = "You pressed Cancel!";
	}
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
        <div class="grid_10">
            <div class="box round first">
                <h2>
                    Last Orders</h2>
                <div class="block">
                    <?php
if(!(isset($_GET['p']) AND $_GET['p']!='' AND $_GET['p']!=null AND is_numeric($_GET['p']) AND $_GET['p']>0)){
	$p = 1;
}
else{
	$p = $_GET['p'];
}
if(!(isset($_GET['type']) AND $_GET['type']!='' AND $_GET['type']!=null AND is_numeric($_GET['type']) AND $_GET['type']>=0 AND $_GET['type']<=3)){
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
	$q = "SELECT count(*) as cc FROM `users` WHERE `id`=".$_GET['del']."";
	$rr = mysql_fetch_array(mysql_query($q));
	if($rr['cc']>0){
		mysql_query("DELETE FROM `users` WHERE `id`=".$_GET['del']."");
	}
}

$output = "";
$q = "SELECT * FROM `users` WHERE TRUE ".(($type == 0-1) ? " " : "AND `status`=".$type." ")."ORDER BY `id` ASC";

$r = mysql_query($q) or die(mysql_error());
$total_res = mysql_num_rows($r);
$max_p = ceil($total_res/$item_per_page);

if($p<$max_p){
	$next_p = "<a class=\"btn-icon btn-black btn-arrow-right\" href='?p=".($p+1)."".(($type == 0-1) ? "" : "&type=".$type."")."'><span></span>Next</a>";
}
if($p>1){
	$prev_p = "<a class=\"btn-icon btn-black btn-arrow-left\" href='?p=".($p-1)."".(($type == 0-1) ? "" : "&type=".$type."")."'><span></span>Previous</a>";
}
function GetUserDetail($uid)
{
	global $con;
	$q = "SELECT `fname`,`lname`,`company`, count(*) as counter FROM `users` WHERE `id`=".$uid."";
	$res = mysql_fetch_assoc(mysql_query($q, $con));
	if($res['counter']==1) return $res;
	
	return array('fname'=>'', 'lname'=>'', 'company'=>'');
}

$q = "SELECT * FROM `users` WHERE TRUE ".(($type == 0-1) ? " " : "AND `status`=".$type." ")."ORDER BY `total_pay` DESC, `balance` DESC, `total_order` DESC, `id` ASC ".$lim;

$r = mysql_query($q) or die(mysql_error());
if(mysql_num_rows($r)>0){
	$_c = (($p-1)*$item_per_page)+1;
	while($row = mysql_fetch_array($r)){
		

		$qqqq = "SELECT SUM(`amount`) as sum FROM `transactions` WHERE `uref`=".$row['id']." AND `currency`='IRR' AND (`type`=1)";
		$inc_row = mysql_fetch_array(mysql_query($qqqq));
		$qq = "SELECT SUM(`amount`) as sum FROM `transactions` WHERE `uref`=".$row['id']." AND `currency`='IRR' AND (`type`=1 or `type`=2 or `type`=4)";
		$qqq = "SELECT SUM(`amount`) as subtract FROM `transactions` WHERE `uref`=".$row['id']." AND `currency`='IRR' AND (`type`=0 or `type`=3 or `type`=5)";
		$sum_row = mysql_fetch_array(mysql_query($qq));
		$sub_row = mysql_fetch_array(mysql_query($qqq));
		$IRR_total_pay = (float)$inc_row['sum'];
		$IRR_current_dep = $sum_row['sum'] - $sub_row['subtract'];
		$IRR_order_paid = $IRR_total_pay - $IRR_current_dep;
		//var_dump($IRR_total_pay); echo "<br>";
		//var_dump($IRR_order_paid); echo "<br>";
		//var_dump($IRR_current_dep); echo "<br>";


		$qqqq = "SELECT SUM(`amount`) as sum FROM `transactions` WHERE `uref`=".$row['id']." AND `currency`='GBP' AND (`type`=1)";
		$inc_row = mysql_fetch_array(mysql_query($qqqq));
		$qq = "SELECT SUM(`amount`) as sum FROM `transactions` WHERE `uref`=".$row['id']." AND `currency`='GBP' AND (`type`=1 or `type`=2 or `type`=4)";
		$qqq = "SELECT SUM(`amount`) as subtract FROM `transactions` WHERE `uref`=".$row['id']." AND `currency`='GBP' AND (`type`=0 or `type`=3 or `type`=5)";
		$sum_row = mysql_fetch_array(mysql_query($qq));
		$sub_row = mysql_fetch_array(mysql_query($qqq));
		$GBP_total_pay = (float)$inc_row['sum'];
		$GBP_current_dep = $sum_row['sum'] - $sub_row['subtract'];
		$GBP_order_paid = $GBP_total_pay - $GBP_current_dep;
		//var_dump($GBP_total_pay); echo "<br>";
		//var_dump($GBP_order_paid); echo "<br>";
		//var_dump($GBP_current_dep); echo "<br>";


		$qqqq = "SELECT SUM(`amount`) as sum FROM `transactions` WHERE `uref`=".$row['id']." AND `currency`='EUR' AND (`type`=1)";
		$inc_row = mysql_fetch_array(mysql_query($qqqq));
		$qq = "SELECT SUM(`amount`) as sum FROM `transactions` WHERE `uref`=".$row['id']." AND `currency`='EUR' AND (`type`=1 or `type`=2 or `type`=4)";
		$qqq = "SELECT SUM(`amount`) as subtract FROM `transactions` WHERE `uref`=".$row['id']." AND `currency`='EUR' AND (`type`=0 or `type`=3 or `type`=5)";
		$sum_row = mysql_fetch_array(mysql_query($qq));
		$sub_row = mysql_fetch_array(mysql_query($qqq));
		$EUR_total_pay = (float)$inc_row['sum'];
		$EUR_current_dep = $sum_row['sum'] - $sub_row['subtract'];
		$EUR_order_paid = $EUR_total_pay - $EUR_current_dep;
		//var_dump($EUR_total_pay); echo "<br>";
		//var_dump($EUR_order_paid); echo "<br>";
		//var_dump($EUR_current_dep); echo "<br>";


		$qqqq = "SELECT SUM(`amount`) as sum FROM `transactions` WHERE `uref`=".$row['id']." AND `currency`='USD' AND (`type`=1)";
		$inc_row = mysql_fetch_array(mysql_query($qqqq));
		$qq = "SELECT SUM(`amount`) as sum FROM `transactions` WHERE `uref`=".$row['id']." AND `currency`='USD' AND (`type`=1 or `type`=2 or `type`=4)";
		$qqq = "SELECT SUM(`amount`) as subtract FROM `transactions` WHERE `uref`=".$row['id']." AND `currency`='USD' AND (`type`=0 or `type`=3 or `type`=5)";
		$sum_row = mysql_fetch_array(mysql_query($qq));
		$sub_row = mysql_fetch_array(mysql_query($qqq));
		$USD_total_pay = (float)$inc_row['sum'];
		$USD_current_dep = $sum_row['sum'] - $sub_row['subtract'];
		$USD_order_paid = $USD_total_pay - $USD_current_dep;
		
		
		
		$stat = "Not-Activated";
		switch($row['status'])
		{
			case 0: $stat = "Not-Activated"; break;
			case 1: $stat = "Active"; break;
		}
		
		//<?php echo $row['IRR_total_receive'];total_order_paid
		$output .="<tr >";
		$output .="<td >".$_c."</td><td >".$row['id']."</td><td >".$row['fname']." ".$row['lname']."</td><td >".$row['company']."</td>"
		."<td >".$IRR_total_pay." IRR<br>".$EUR_total_pay." EUR<br>".$GBP_total_pay." GBP<br>".$USD_total_pay." USD</td>"
		."<td >".$IRR_current_dep." IRR<br>".$EUR_current_dep." EUR<br>".$GBP_current_dep." GBP<br>".$USD_current_dep." USD</td>"
		."<td >".$IRR_order_paid ." IRR<br>".$EUR_order_paid." EUR<br>".$GBP_order_paid." GBP<br>".$USD_order_paid." USD</td>"
		."<td >".date("Y/m/d H:i:s",$row['created_at'])."</td>"
		."<td >".$stat."</td>";
		$output .="<td><a href='user.php?id=".$row['id']."'>Details</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href='#' OnClick=\"ConfirmFunc('".$row['id']."');\">Delete</a></td>";
		$output .="</tr>";
		$_c++;
	}
}
else{
	$output = "<tr><td colspan=\"10\">No Entery Detected</td></tr>";
}
//mysql_close();
					?><!--
<p class="start">Choose a category : 
<button class="btn btn-orange" onclick="window.location.href='tickets.php';">All Orders&nbsp;</button>&nbsp;&nbsp;&nbsp;
<button class="btn btn-yellow" onclick="window.location.href='tickets.php?type=0';">Active&nbsp;</button>&nbsp;&nbsp;&nbsp;
<button class="btn btn-blue" onclick="window.location.href='tickets.php?type=1';">Closed&nbsp;</button>&nbsp;&nbsp;&nbsp;
<button class="btn btn-green" onclick="window.location.href='tickets.php?type=2';">Hold&nbsp;</button>&nbsp;&nbsp;&nbsp;
<button class="btn btn-red" onclick="window.location.href='tickets.php?type=3';">Under Process&nbsp;</button>&nbsp;&nbsp;&nbsp;
</p>-->
<table border="1" style="margin-left:auto;margin-right:auto;width:90%;border-collapse:collapse;border-color:#777;font-size:12px">
	<tbody>
		<tr style="background-color:#ccc;text-align:center;color:#3a3a3a">
			<td style="padding:5px">#</td>
			<td >ID</td>
			<td >Name</td>
			<td >Company</td>
			<td >Total Pay</td>
			<td >Balance</td>
			<td >Total Order Cost</td>
			<td >Member Since</td>
			<td >Status</td>
			<td >Action</td>
		</tr>
		<tr style="background-color:#fff;text-align:center;font-weight:bold">
			<?php echo $output; ?>
		</tr>
		
	</tbody>
</table>
<?php echo $prev_p . $curr_p . $next_p; ?>
                </div>
            </div>
        </div>
        <div class="grid_10">
            <div class="box round">
                <h2>User LookUp</h2>
                <div class="block">
                    <p class="start">Here you can enter the user ID and access to the details immediately</p>
                    <p><form method="post">
					<input type="hidden" name="t" value="3">
					User ID&nbsp;:&nbsp;<input name="tid" size="20" type="text">&nbsp;&nbsp;&nbsp;<button class="btn btn-pink" type="submit">LookUp</button>
					</form></p>
					<?php

if(isset($_POST['t']) AND $_POST['t']==3){
	if(isset($_POST['tid']) AND $_POST['tid']!=''){
		$q = "SELECT id,count(*) as cc FROM `users` WHERE `tid`='".$_POST['tid']."'";
		$rr = mysql_fetch_array(mysql_query($q));
		if($rr['cc']>0){
			header("Location: user.php?id=".$rr['id']."");
			exit("user....<br><a href='user.php?id=".$rr['id']."'>click here</a>");
		}
		else{
			echo "<p>user not found</p>";
		}
	}
	else{
		echo "<p>Invalid info</p>";
	}
}
?>
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
mysql_close();
include("footer.php");
?>