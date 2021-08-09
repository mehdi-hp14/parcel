<?php 

include("conf.php");
include("../post_forms/cnf.php");
unset($_SESSION['loged_in']);
unset($_SESSION['loged_in_t']);
session_destroy();


header("Location: index.php");
exit("You are logged Out....<br><a href='index.php'>Dashboard</a>");

include("footer.php");
?>