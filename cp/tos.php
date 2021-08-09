<?php
require(__DIR__ ."". DIRECTORY_SEPARATOR ."Core". DIRECTORY_SEPARATOR ."boot.php");
require_once(MODEL_PATH."index.php");

class PView extends PageView
{
	public $error = null;
	public $error_m = array('uname'=>'', 'pass'=>'');
	
	
    public function PView( )
    {
        parent::PageView( );
		$this->active_page = "tos";
        $this->viewFile = "tos.phtml";
        
    }

    public function load( )
    {
        parent::load( );
		
		$this->redirect("http://www.europostexpress.co.uk/index.cgi?cf=terms");

		if($this->isPost()){
			$this->error = true;
		}
    }

    

}

$p = new PView( );
$p->run( );
