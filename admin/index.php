<?php

include("conf.php");
include("../post_forms/cnf.php");

//dd(auth()->guest());
if (isset($_SESSION['loged_in']) and isset($_SESSION['loged_in_t']) and $_SESSION['loged_in'] == true and $_SESSION['loged_in_t'] >= time()) {

    header("Location: dashboard.php");
    exit("You are logged in....<br><a href='dashboard.php'>Dashboard</a>");
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>Login | Booking Parcel Admin</title>
    <link rel="stylesheet" type="text/css" href="css/reset.css" media="screen"/>
    <link rel="stylesheet" type="text/css" href="css/text.css" media="screen"/>
    <link rel="stylesheet" type="text/css" href="css/grid.css" media="screen"/>
    <link rel="stylesheet" type="text/css" href="css/layout.css" media="screen"/>
    <link rel="stylesheet" type="text/css" href="css/nav.css" media="screen"/>
    <!--[if IE 6]>
    <link rel="stylesheet" type="text/css" href="css/ie6.css" media="screen"/><![endif]-->
    <!--[if IE 7]>
    <link rel="stylesheet" type="text/css" href="css/ie.css" media="screen"/><![endif]-->
    <!-- BEGIN: load jquery -->
    <script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/jquery-ui/jquery.ui.core.min.js"></script>
    <script src="js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.core.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.slide.min.js" type="text/javascript"></script>
    <!-- END: load jquery -->
    <!-- BEGIN: load jqplot -->
    <link rel="stylesheet" type="text/css" href="css/jquery.jqplot.min.css"/>
    <!--[if lt IE 9]>
    <script language="javascript" type="text/javascript" src="js/jqPlot/excanvas.min.js"></script><![endif]-->
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
    </script>
</head>
<body>
<div class="container_12">
    <div class="grid_12 header-repeat">
        <div id="branding">
            <div class="floatleft">
                <img src="img/logo.png" alt="Logo"/></div>
            <div class="floatright">
                <div class="floatleft">
                    <img src="img/img-profile.jpg" alt="Profile Pic"/></div>
                <div class="floatleft marginleft10">
                    <ul class="inline-ul floatleft">
                        <li>Hello Dear User</li>
                        <li><a href="../index.html">Main Site</a></li>
                    </ul>
                    <br/>
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
            <li class="ic-dashboard"><a href="../"><span>Main Site</span></a></li>
            <li class="ic-notifications"><a href="index.php"><span>Sign In</span></a></li>

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
                            <li><a href="../">Home</a></li>
                            <li><a href="index.php">Sign In</a></li>

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
            <h2>Login</h2>
            <div class="block">
                <?php
                //                $some_name = session_name("some_name");
                //                ini_set('session.cookie_domain', '.bookingparcel.com');
                //
                //                session_set_cookie_params(0, '/', '.bookingparcel.com');
                //                session_name("testphp8.bookingparcel.com");

                //                session_start();
                //                $_SESSION['mehdi'] = 'xxxaa';

                if (isset($_POST['t']) and $_POST['t'] = 1) {
                    if (isset($_POST['username']) and $_POST['username'] == ad_user) {
                        if (isset($_POST['pass']) and $_POST['pass'] == ad_pass) {
                            session_start();
                            $_SESSION['loged_in'] = true;
                            $_SESSION['loged_in_t'] = time() + time_out;

                            echo "<script language='javascript'>window.location.href='dashboardAll.php';</script>";
                            exit;
                        }
                    }
                }
                ?>

                <table border="1" style="margin-left:auto;margin-right:auto;width:90%;border-collapse:collapse;border-color:#777;font-size:12px">
                    <tbody>
                    <tr style="background-color:#ccc;text-align:center;color:#3a3a3a">
                        <td style="padding:5px">Title</td>
                        <td>Action</td>
                    </tr>
                    <tr style="background-color:#fff;text-align:center;font-weight:bold">
                        <form action="" method="post">
                            <input type="hidden" name="t" value="1">
                            <td style="padding:5px">User Name</td>
                            <td style="padding:5px"><input type="text" name="username" value="" class="grumble"></td>
                    </tr>
                    <tr style="background-color:#fff;text-align:center;font-weight:bold">
                        <td>PassWord</td>
                        <td><input type="password" name="pass" value="" class="grumble"></td>
                    </tr>
                    <tr style="background-color:#fff;text-align:center;font-weight:bold">
                        <td>Action</td>
                        <td>
                            <button name="Confirm" type="submit" class="btn btn-blue">Login</button>
                        </td>
                    </tr>
                    </form>
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
