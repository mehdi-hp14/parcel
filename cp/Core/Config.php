<?php

$Config = array();


/***********Database Configuration**************/
$Config['db']['host'] = 'localhost';
$Config['db']['port'] = '3306';
$Config['db']['name'] = 'bookingp_qdb';
$Config['db']['user'] = 'bookingp_qdusr';
$Config['db']['pass'] = ',f[~jvXI~WU)';





/**************Meta Settings******************/
$Config['site']['lang'] = "en";
$Config['site']['title'] = "User Panel | Booking Parcel";

$Config['meta']['charset'] = array(
	'charset'		=>	"UTF-8"
);
$Config['meta']['author'] = array(
	'name'		=>	"author",
	'content'	=>	"Esmaiel Fakhimi"
);
$Config['meta']['keywords'] = array(
	'name'		=>	"keywords",
	'content'	=>	"HTML, CSS, XML, XHTML, JavaScript"
);
$Config['meta']['description'] = array(
	'name'		=>	"description",
	'content'	=>	"Booking Parcel is a company which you can transport your goods by it."
);




/**********Other*****************/
$Config['other']['session_timeout'] = 3600; //Minutes
$Config['other']['min_user_length'] = 4; //chars
$Config['other']['PassWordSalt'] = '$2a$09$anexamplestringforsalt$'; //chars