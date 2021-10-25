<?php 

include("conf.php");
include("../post_forms/cnf.php");
unset($_SESSION['loged_in']);
unset($_SESSION['loged_in_t']);
auth()->guard('adminGuard')->logout();

session_destroy();

header("Location: ".config('general.ADMIN_LOGIN_PAGE'));
exit("You are logged Out....<br><a href='index.php'>Dashboard</a>");

?>