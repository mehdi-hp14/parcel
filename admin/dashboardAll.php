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
    <title>Dashboard | Booking Parcel Admin</title>
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
function ConfirmFunc(a,b) {
	var r = confirm("You are about to delete '"+b+"' order.\nNote: this operation is not reversible.\n Are you sure?");
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
                                <li><a href="dashboardAll.php">Admin Page</a> </li>
                                <li><a href="tickets.php">Support Tickets</a> </li>
                                <li><a href="users.php">User Management</a> </li>
                                <li><a href="news.php">News And ToS</a> </li>
                                <li><a href="agents.php">Agents Management Page</a> </li>
                                <li><a href="premessages.php">Pre-Defined Messages Page</a> </li>
                                <li><a href="files.php">Files Management</a> </li>
                                <li><a href="insreport.php">Instructure Report</a> </li>
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
	$q = "SELECT count(*) as cc FROM `quote` WHERE `id`=".$_GET['del']."";
	$rr = mysql_fetch_array(mysql_query($q));
	if($rr['cc']>0){
		mysql_query("DELETE FROM `quote` WHERE `id`=".$_GET['del']."");
	}
}

$output = "";
$q = "SELECT * FROM `quote` WHERE TRUE ".(($type == 0-1) ? " " : "AND `status`=".$type." ")."ORDER BY `timestamp` DESC, `id` ASC";

$r = mysql_query($q) or die(mysql_error());
$total_res = mysql_num_rows($r);
$max_p = ceil($total_res/$item_per_page);

if($p<$max_p){
	$next_p = "<a class=\"btn-icon btn-black btn-arrow-right\" href='?p=".($p+1)."".(($type == 0-1) ? "" : "&type=".$type."")."'><span></span>Next</a>";
}
if($p>1){
	$prev_p = "<a class=\"btn-icon btn-black btn-arrow-left\" href='?p=".($p-1)."".(($type == 0-1) ? "" : "&type=".$type."")."'><span></span>Previous</a>";
}

$q = "SELECT * FROM `quote` WHERE TRUE ".(($type == 0-1) ? " " : "AND `status`=".$type." ").
    (!empty($_GET['from'])? " AND `from` like '{$_GET['from']}' ":'').
    (!empty($_GET['to'])? " AND `to` like '{$_GET['to']}' ":'').
    " ORDER BY `timestamp` DESC, `id` ASC ".$lim;

$r = mysql_query($q) or die(mysql_error());
if(mysql_num_rows($r)>0){
	$_c = $total_res - (($p-1)*$item_per_page);
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
		$output .="<td >".$_c."</td><td >".$row['id']."</td><td >".$row['tid']."".($row['danger']=='Yes' ? "&nbsp;<span class=\"danger_small\"></span>" : "")."".($row['chemical']=='Yes' ? "&nbsp;<span class=\"chemical_small\"></span>" : "")."".($row['lithiumb']=='Yes' ? "&nbsp;<span class=\"battry_small\"></span>" : "")."</td><td >".$row['fname']."</td><td >".$row['company']."</td>";
//		<td >".$row['phone']."</td>
//echo "Avatar : ".($row['avatar']!="" ? "<img src='../cp/Assets/images/avatar/".$row['avatar']."'>" : "None")."<br>";
		if($row['uname']!='' OR $row['uname']!=null)
		{
			$row2 = mysql_fetch_array(mysql_query("SELECT avatar FROM `users` WHERE `uname`='".$row['uname']."'"));
			$output .="<td>".($row2 && $row2['avatar']!="" ? "<span style='max-width:112px;max-height:48;'><img width=\"112px\" height=\"48px\" src='../cp/Assets/images/avatar/".$row2['avatar']."'></span>" : "None")."</td>";
		}
		else{
			$output .="<td>None</td>";
		}
		$output .="<td >".$row['email']."</td><td >".$row['from']."</td><td >".$row['to']."</td><td >".date("Y/m/d H:i:s",$row['timestamp'])."</td>";
		$output .="<td><a href='item.php?id=".$row['id']."'>Details</a>&nbsp;|&nbsp;<a href='itemedit.php?id=".$row['id']."'>Edit</a>&nbsp;|&nbsp;<a href='offers.php?id=".$row['id']."'>Agents</a>&nbsp;|&nbsp;<a href='#' OnClick=\"ConfirmFunc('".$row['id']."','".$row['tid']."');\">Delete</a></td>";
		$output .="</tr>";
		//$_c++;
		$_c--;
	}
}
else{
	$output = "<tr><td colspan=\"11\">No Entery Detected</td></tr>";
}
//mysql_close();
					?>
<p class="start">Choose a category : 
<button class="btn btn-orange" onclick="window.location.href='dashboard.php';">All Orders&nbsp;</button>&nbsp;&nbsp;&nbsp;
<button class="btn btn-grey" onclick="window.location.href='dashboard.php?type=0';">Pending&nbsp;</button>&nbsp;&nbsp;&nbsp;
<button class="btn btn-blue" onclick="window.location.href='dashboard.php?type=1';">Under Process&nbsp;</button>&nbsp;&nbsp;&nbsp;
<button class="btn btn-green" onclick="window.location.href='dashboard.php?type=2';">Active&nbsp;</button>&nbsp;&nbsp;&nbsp;
<button class="btn btn-red" onclick="window.location.href='dashboard.php?type=3';">Cancelled&nbsp;</button>&nbsp;&nbsp;&nbsp;
<button class="btn btn-teal" onclick="window.location.href='dashboard.php?type=4';">Completed&nbsp;</button>&nbsp;&nbsp;&nbsp;
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
			<td >Company Logo</td>
			<td >E-mail</td>
			<td ><input type="text" placeholder="From" id="from-input" class="inline-input" name="from" style="background: #f000;border: none;text-align: center;"></td>
			<td ><input type="text" placeholder="To" id="to-input" class="inline-input" name="to" style="background: #f000;border: none;text-align: center;"></td>
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
                </div>
            </div>
        </div>
        <div class="grid_10">
            <div class="box round">
                <h2>Order LookUp</h2>
                <div class="block">
                    <p class="start">Here you can enter the tracking ID and access to the details immediately</p>
                    <p><form method="post">
					<input type="hidden" name="t" value="3">
					Tracking ID&nbsp;:&nbsp;<input name="tid" size="20" type="text">&nbsp;&nbsp;&nbsp;<hr>
					Or simply <br>
					The ID&nbsp;:&nbsp;<input name="item_id" size="20" type="text">&nbsp;&nbsp;&nbsp;<hr>
					Or MAWB&nbsp;:&nbsp;<input name="mawb1" size="3" type="text">&nbsp;-&nbsp;<input name="mawb2" size="9" type="text">&nbsp;&nbsp;&nbsp;<hr>
					Or HAWB&nbsp;:&nbsp;<input name="hawb1" size="25" type="text">&nbsp;<input name="hawb2" size="15" type="text">&nbsp;&nbsp;&nbsp;<hr>
					Or From Country :<input name="from_country" size="25" type="text"><hr>
					Or To Country :<input name="to_country" size="25" type="text"><hr>
					<button class="btn btn-pink" type="submit">LookUp</button>
					</form></p>

					<?php
$fromCondition = !empty($_POST['from_country']) ? ' AND from like \'%'.$_POST['from_country']."%'":'';
$toCondition = !empty($_POST['to_country']) ? ' AND to like \'%'.$_POST['to_country']."%'":'';

if(isset($_POST['t']) AND $_POST['t']==3){
	if(isset($_POST['tid']) AND $_POST['tid']!='' and !(isset($_POST['item_id']) AND $_POST['item_id']!='')){
		$q = "SELECT id,count(*) as cc FROM `quote` WHERE `tid`='".$_POST['tid']."'".$fromCondition.$toCondition;
		$rr = mysql_fetch_array(mysql_query($q));
		if($rr['cc']>0){
			header("Location: item.php?id=".$rr['id']."");
			exit("Item....<br><a href='item.php?id=".$rr['id']."'>click here</a>");
		}
		else{
			echo "<p>Order not found</p>";
		}
	}
	else if(isset($_POST['item_id']) AND $_POST['item_id']!='')
	{
		$q = "SELECT id,count(*) as cc FROM `quote` WHERE `id`='".$_POST['item_id']."'".$fromCondition.$toCondition;
		$rr = mysql_fetch_array(mysql_query($q));
		if($rr['cc']>0){
			header("Location: item.php?id=".$rr['id']."");
			exit("Item....<br><a href='item.php?id=".$rr['id']."'>click here</a>");
		}
		else{
			echo "<p>Order not found</p>";
		}
	}
	elseif(isset($_POST['mawb1']) AND $_POST['mawb1']!='' AND isset($_POST['mawb2']) AND $_POST['mawb2']!='')
	{
		$q = "SELECT id,count(*) as cc FROM `quote` WHERE `mawb1`='".$_POST['mawb1']."' AND `mawb2`='".$_POST['mawb2']."'".$fromCondition.$toCondition;
		$rr = mysql_fetch_array(mysql_query($q));
		if($rr['cc']>0){
			header("Location: item.php?id=".$rr['id']."");
			exit("Item....<br><a href='item.php?id=".$rr['id']."'>click here</a>");
		}
		else{
			echo "<p>Order not found</p>";
		}
	}
	elseif(isset($_POST['hawb1']) AND $_POST['hawb1']!='' AND isset($_POST['hawb2']) AND $_POST['hawb2']!='')
	{
		$tmp = $_POST['hawb1'].' => '.$_POST['hawb2'].'|';
		$q = "SELECT id,count(*) as cc FROM `quote` WHERE `hawb` LIKE '%".$tmp."%'".$fromCondition.$toCondition;
		
		$rr = mysql_fetch_array(mysql_query($q));
		if($rr['cc']>0){
			header("Location: item.php?id=".$rr['id']."");
			exit("Item....<br><a href='item.php?id=".$rr['id']."'>click here</a>");
		}
		else{
			echo "<p>Order not found</p>";
		}
	}
    elseif(isset($_POST['from_country']) OR isset($_POST['to_country']))
    {
        $q = "SELECT id,count(*) as cc FROM `quote` WHERE ".preg_replace('/AND/','',$fromCondition.$toCondition,1);

        $rr = mysql_fetch_array(mysql_query($q));
        if($rr['cc']>0){
            header("Location: item.php?id=".$rr['id']."");
            exit("Item....<br><a href='item.php?id=".$rr['id']."'>click here</a>");
        }
        else{
            echo "<p>Order not found</p>";
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
    <script>
        $('.inline-input').keypress(function (e){
            if(e.keyCode==13){
                var url = new URL(window.location.href);
                url.searchParams.delete('from');
                url.searchParams.delete('to');

                if($('#from-input').val()){
                    url.searchParams.set('from', $('#from-input').val());
                }

                if($('#to-input').val()){
                    url.searchParams.set('to', $('#to-input').val());
                }
                window.location.href = url.href
            }
        })
    </script>
<?php
mysql_close();
include("footer.php");
?>