<?php
define( "ROOT_PATH", realpath( dirname( dirname( __FILE__ ) ) ).DIRECTORY_SEPARATOR );
define( "APP_PATH", ROOT_PATH."Core".DIRECTORY_SEPARATOR );
define( "VIEW_PATH", APP_PATH."View".DIRECTORY_SEPARATOR );
define( "MODEL_PATH", APP_PATH."Model".DIRECTORY_SEPARATOR );
define( "LIB_PATH", ROOT_PATH."lib".DIRECTORY_SEPARATOR );



include(APP_PATH ."Security.php");
include(APP_PATH ."Config.php");
include(MODEL_PATH ."model.php");
include(APP_PATH ."View.php");
include(APP_PATH ."Controller.php");



$cookie = ClientData::getinstance( );