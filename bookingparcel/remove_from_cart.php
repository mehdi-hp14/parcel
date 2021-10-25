<?php
include_once('configure.php');
include_once "session.php";
include_once "language.php";
$id=$_REQUEST["id"];
mysql_query("delete from esb2b_basket where es_pid=".$id);

header("Location:"."gen_confirm.html?errmsg=".urlencode("$Item_has_been_removed_from_the_inquiry_basket"));
die();
?>