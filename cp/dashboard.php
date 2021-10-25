<?php
ini_set('display_errors', 1);
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
require(__DIR__ ."". DIRECTORY_SEPARATOR ."Core". DIRECTORY_SEPARATOR ."boot.php");
require_once(MODEL_PATH."support.php");

class PView extends SecurePage
{

	public $inbox_info = null;
	public $Order_info = null;
	
	
    public function __construct( )
    {
        parent::__construct( );
		$this->active_page = "dashboard";
        $this->viewFile = "dashboard.phtml";
        
    }

    public function load( )
    {
        parent::load( );
       //var_dump($this->account->uid);
		$m = new SupportModel();
		$this->inbox_info = $m->GetTickets($this->account->uid, 1, 10);
	   
		$this->Order_info = $m->GetOrders($this->data['uname'], 1, 10);
	   
	   
		$m->dispose();
    }

    

}

$p = new PView( );
//var_dump([123,$p->viewFile]);
//die(229);
$p->run( );
