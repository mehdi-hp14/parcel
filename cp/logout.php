<?php
require(__DIR__ ."". DIRECTORY_SEPARATOR ."Core". DIRECTORY_SEPARATOR ."boot.php");

class PView extends SecurePage
{
	
	
    public function PView( )
    {
        parent::SecurePage( );
		$this->active_page = "logout";
        $this->viewFile = "logout.phtml";
        
    }

    public function load( )
    {
        parent::load( );
		
		$this->account->logout( );
		unset( $this->account );
		$this->account = NULL;
		
		$this->redirect("index.php");
    }

    

}

$p = new PView( );
$p->run( );
