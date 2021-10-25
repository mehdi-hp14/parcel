<?php 

include("../post_forms/cnf.php");
include("conf.php");

if(!(isset($_SESSION['loged_in']) AND isset($_SESSION['loged_in_t']) AND $_SESSION['loged_in']==true AND $_SESSION['loged_in_t']>=time())){

	header("Location: index.php");
	exit("You are not logged in....<br><a href='index.php'>Dashboard</a>");
}

if(isset($_SESSION['loged_in']) AND isset($_SESSION['loged_in_t']) AND $_SESSION['loged_in']==true AND $_SESSION['loged_in_t']>=time()){
	$_SESSION['loged_in_t'] = time()+3600;
}
/*
$arr1 = array ('a'=>1,'b'=>2,'c'=>3,'d'=>4,'e'=>5);
file_put_contents("array.json",json_encode($arr1));
# array.json => {"a":1,"b":2,"c":3,"d":4,"e":5}
$arr2 = json_decode(file_get_contents('array.json'), true);
$arr1 === $arr2 # => true
*/
if(!file_exists('mail_content.php') AND (!file_exists('mail_address.php') or !file_exists('mail_address.json'))){
	//header("Location: dashboard.php");
	exit("invalid request....<br><a href='dashboard.php'>Dashboard</a>");
}
else{
	if(file_exists('mail_address_er.json')){
		$mails_er = json_decode(file_get_contents('mail_address_er.json'), true);
	}else
	{
		$mails_er = array();
	}
	
	include('mail_content.php');
	if(file_exists('mail_address.php')){
		include('mail_address.php');
		unlink('mail_address.json');
	}
	elseif(file_exists('mail_address.json')){
		$mails = json_decode(file_get_contents('mail_address.json'), true);
	}
	else{
		include('mail_address.php');
	}
}

if(count($mails)<=0){
	header("Location: dashboard.php");
	exit("invalid request....<br><a href='dashboard.php'>Dashboard</a>");
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
    <!-- Load TinyMCE -->
    <script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>

    <script type="text/javascript">

        $(document).ready(function () {
            //setupDashboardChart('chart1');
            setupLeftMenu();
			setSidebarHeight();

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
(function () {
    var timeLeft = 5,
        cinterval;

    var timeDec = function (){
        timeLeft--;
        document.getElementById('countd').innerHTML = timeLeft;
        if(timeLeft === 0){
            clearInterval(cinterval);
			
        }
    };

    cinterval = setInterval(timeDec, 1000);
})();
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
$error_m="";
foreach($mails as $email=>$info){
	if(!($email !="" AND $email!=null)){
		unset($mails[$email]);
		continue;
	} 
	$body1 = str_replace("{company_name}", $info['company'], $body, $_c);
	$body1 = str_replace("agent_name", $info['name'], $body1, $_c);
	$content = $pre1 . $body1 . $pre2;
	$subject = sprintf("=?utf-8?B?" . base64_encode($subject) . "?=");
	$error_m .= $subject."<br>";
	if (mail($email, $subject, $content, $header))
	{
		unset($mails[$email]);
		$error_m .= $info['company'] . " : ".$info['name']. " : ".$email." Sent Successfully<br>";
	}
	else
	{
		$mails_er[$email] = $info;
		$error_m .= $info['company'] . " : ".$info['name']. " : ".$email." Sending was not successful.<br>";
		unset($mails[$email]);
		/*$error = error_get_last();
		$error_m .="Error details :<br>";
		foreach($error as $k=>$v){
			$error_m .= $k ." => ".$v."<br>";
		}
		$error_m .="<br>";*/
	}
	break;
}

unlink("mail_address.php");
file_put_contents("mail_address.json",json_encode($mails));
file_put_contents("mail_address_er.json",json_encode($mails_er));
if(count($mails) <= 0){
	$error_m .= "The message has been failed to send to ".count($mails_er).". <br>";
	if(count($mails_er) > 0){
		$error_m .= "Here is the list of failure!<br>";
		foreach($mails_er as $k=>$v)
		{
			$error_m .= $k." : ". $v['company']. " : ". $v['name'] ."<br>";
		}
	}
		
	unlink("mail_address.json");
	unlink("mail_content.php");
	unlink("mail_address_er.json");
} 
else{
	header( "refresh:6;url=sendmail.php" );
$error_m .= "next mail in <span id=\"countd\"></span><br>";
}
$error_m .= "Remaining mails : ".count($mails)."<br>";

if($error_m!=""){
	?>
<div class="grid_10">
    <div class="box round first">
        <h2>Notifications</h2>
		<div class="block">
			<div class="message success">
				<h5>Success!</h5>
				<p>
					<?php 
					
					echo $error_m; ?>
				</p>
			</div>
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
?>