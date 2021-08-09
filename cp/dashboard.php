<?php
require(__DIR__ ."". DIRECTORY_SEPARATOR ."Core". DIRECTORY_SEPARATOR ."boot.php");
require_once(MODEL_PATH."support.php");

class PView extends SecurePage
{

	public $inbox_info = null;
	public $Order_info = null;
	
	
    public function PView( )
    {
        parent::SecurePage( );
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
$p->run( );
