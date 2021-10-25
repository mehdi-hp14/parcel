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
	header("Location: tickets.php");
	exit;
}
else{
	$id = intval($_GET['id']);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Support Tickets | Booking Parcel Admin</title>
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
    </script>
<script type="text/javascript">
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

$output = "";
$q = "SELECT *, count(*) as counter FROM `tickets` WHERE `id`=".$id." AND `primary_p`=1";
$row = mysql_fetch_assoc(mysql_query($q));
if($row['counter']==1)
{
    function GetUserDetail($uid)
    {
        global $con;
        $q = "SELECT `fname`,`lname`,`company`, count(*) as counter FROM `users` WHERE `id`=".$uid."";
        
        $res = mysql_fetch_assoc(mysql_query($q, $con));
        if($res['counter']==1) return $res;
        
        return array('fname'=>'', 'lname'=>'', 'company'=>'');
    }
	if(isset($_GET['type']) AND is_numeric($_GET['type']) AND $_GET['type']>=0 AND $_GET['type']<=3)
	{
		mysql_query("UPDATE `tickets` SET `status`=".$_GET['type']." WHERE `id`=".$id."");
		$row['status'] = $_GET['type'];
		
	}
	if(isset($_POST['t']) AND $_POST['t']=="reply")
	{
		if((isset($_POST['content']) AND $_POST['content']!="" AND $_POST['content']!=null))
		{
			if(!(isset($_POST['subject']) AND $_POST['subject']!="" AND $_POST['subject']!=null))
			{
				$_POST['subject'] = "";
			}
			mysql_query("INSERT INTO `tickets` (`subject`, `content`, `ref`, `c_date`, `uid`, `status`, `adm_readed`) VALUES ('".$_POST['subject']."','".$_POST['content']."', '".$id."', '".time()."', '".$row['uid']."', 0,1);") or die(mysql_error());
			unset($_POST['subject']);
			unset($_POST['content']);
			unset($_POST['t']);
		}
	}
	mysql_query("UPDATE `tickets` SET `adm_readed`=1 WHERE `id`=".$id." OR `ref`=".$id."");
	$qq = mysql_query("SELECT * FROM `tickets` WHERE `ref`=".$id." ORDER BY `c_date` ASC, `id` ASC");
    $user = GetUserDetail($row['uid']);
?>

<style>
p.speech
{
	position: relative;
	width: 95%;
	height: 100px;
	margin:5px;
	padding:8px;
	text-align: ltr;
	background-color: #fff;
	border: 8px solid #666;
	-webkit-border-radius: 30px;
	-moz-border-radius: 30px;
	border-radius: 30px;
	-webkit-box-shadow: 2px 2px 4px #888;
	-moz-box-shadow: 2px 2px 4px #888;
	box-shadow: 2px 2px 4px #888;
}

.bubble_right 
{
float:right;
position: relative;
width: 95%;
margin: 15px;
padding: 8px;
background: #FFFFFF;
-webkit-border-radius: 10px;
-moz-border-radius: 10px;
border-radius: 10px;
border: #7F7F7F solid 2px;
}

.bubble_right:after 
{
content: '';
position: absolute;
border-style: solid;
border-width: 15px 0 15px 15px;
border-color: transparent #FFFFFF;
display: block;
width: 0;
z-index: 1;
right: -15px;
top: 17%;
}

.bubble_right:before 
{
content: '';
position: absolute;
border-style: solid;
border-width: 16px 0 16px 16px;
border-color: transparent #7F7F7F;
display: block;
width: 0;
z-index: 0;
right: -18px;
top: 17%;
}


.bubble_left 
{
position: relative;
width: 95%;
margin: 15px;
padding: 8px;
background: #FFFFFF;
-webkit-border-radius: 10px;
-moz-border-radius: 10px;
border-radius: 10px;
border: #7F7F7F solid 2px;
}

.bubble_left:after 
{
content: '';
position: absolute;
border-style: solid;
border-width: 15px 15px 15px 0;
border-color: transparent #FFFFFF;
display: block;
width: 0;
z-index: 1;
left: -15px;
top: 17%;
}

.bubble_left:before 
{
content: '';
position: absolute;
border-style: solid;
border-width: 16px 16px 16px 0;
border-color: transparent #7F7F7F;
display: block;
width: 0;
z-index: 0;
left: -18px;
top: 17%;
}
.clear
{
clear: both;
}
</style>

        <div class="grid_10">
            <div class="box round first">
                <h2><?php 
			$stat = "Active";
			switch($row['status'])
			{
				case 0: $stat = "Active"; break;
				case 1: $stat = "Close"; break;
				case 2: $stat = "Hold"; break;
				case 3: $stat = "Under Process"; break;
			}
			echo "Ticket ID: ".$id." => ".$row['subject'] ."&nbsp;(".$stat.")"; 
			if($row['tid']!='') echo "&nbsp;<span style='float:right;'>Tracking ID : ".$row['tid']."</span>";
		?></h2>
                <div class="block">
<?php
	if($row['user_sent']==0)
	{
		echo "<div class=\"bubble_left\"><b>You said : </b> <span style='float:right;'>".date("Y/m/d H:i:s", $row['c_date'])."</span><br>";
		echo ($row['content'])."<br></div><div class=\"clear\"></div>"; 
	}
	else
	{
		echo "<div class=\"bubble_right\"><b>".$user['fname'] ." ".$user['lname']." (Company : ".($user['company']!="" ? $user['company'] : "--").") said : </b> <span style='float:right;'>".date("Y/m/d H:i:s", $row['c_date'])."</span><br>";
		echo nl2br($row['content'])."<br></div><div class=\"clear\"></div>"; 
	}
	

	while($answer = mysql_fetch_array($qq))
	{
		if($answer['user_sent']==0)
		{
			echo "<div class=\"bubble_left\"><b>You said : </b> <span style='float:right;'>".date("Y/m/d H:i:s", $answer['c_date'])."</span><br>";
			echo ($answer['content'])."<br></div><div class=\"clear\"></div>"; 
		}
		else
		{
			echo "<div class=\"bubble_right\"><b>".$user['fname'] ." ".$user['lname']." (Company : ".($user['company']!="" ? $user['company'] : "--").") said : </b> <span style='float:right;'>".date("Y/m/d H:i:s", $answer['c_date'])."</span><br>";
			echo nl2br($answer['content'])."<br></div><div class=\"clear\"></div>"; 
		}
	}
?>
<div> 
	<span style="float:left;">
		<button class="btn btn-large btn-teal" onclick="document.getElementById('reply').style.display='block';">Reply</button>
	</span>
	<span style="float:right;">
		Set Status&nbsp;:&nbsp;&nbsp;
		<button class="btn btn-large btn-yellow" style="color:#00000;" onclick="window.location.href='ticket.php?id=<?php echo $id; ?>&type=0';">Active&nbsp;</button>&nbsp;&nbsp;&nbsp;
		<button class="btn btn-large btn-blue" onclick="window.location.href='ticket.php?id=<?php echo $id; ?>&type=1';">Closed&nbsp;</button>&nbsp;&nbsp;&nbsp;
		<button class="btn btn-large btn-green" onclick="window.location.href='ticket.php?id=<?php echo $id; ?>&type=2';">Hold&nbsp;</button>&nbsp;&nbsp;&nbsp;
		<button class="btn btn-large btn-red" onclick="window.location.href='ticket.php?id=<?php echo $id; ?>&type=3';">Under Process&nbsp;</button>&nbsp;&nbsp;&nbsp;
		
	</span>
</div>
<div class="clear"></div>

<div id="reply" style="display:none;"><br><br>
	<form action="" method="post">
		<input type="hidden" name="t" value="reply">
		<label for="inputSubject" class="control-label">Subject</label>
		<input type="text" id="inputSubject" class="mini" name="subject" value="<?php if(isset($_POST['subject'])) echo $_POST['subject']; ?>"><br>
		<label for="inputMessage" class="control-label">Message</label>
		<textarea id="inputMessage" rows="15" name="content" class="ckeditor"><?php if(isset($_POST['content'])) echo $_POST['content']; ?></textarea><br>
		<button type="submit" class="btn btn-large btn-teal">Submit the reply</button>
	</form>
</div>

<div class="clear"></div>

                </div>
            </div>
        </div>
<?php
}
else
{

?>

        <div class="grid_10">
            <div class="box round first">
                <h2>Access denied</h2>
                <div class="block">
				<strong>Oops!</strong> Something went wrong!<br><br>
				you can't access this ticket because of the following reasons:<br>
				1. Ticket does not exist.<br>
				2. Ticket is not yours.<br>
				3. You can not access this ticket directly(this ID belongs to a answer to another ticket)
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