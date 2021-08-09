<?php
require(__DIR__ ."". DIRECTORY_SEPARATOR ."Core". DIRECTORY_SEPARATOR ."boot.php");
require_once(MODEL_PATH."support.php");

class PView extends SecurePage
{

	public $show_inbox = true;
	public $show_new = false;
	public $inbox_info = null;
	public $Ticket_info = null;
	public $answers_info = null;
	public $page = 1;
	public $items_per_page = 30;
	public $tid = null;
	
	public $action_status = false;
	public $action_m = "";
	
	public $error = false;
	public $error_m = "";
	
	public $subject = "";
	public $tracking_id = "";
	public $content = "";
	
    public function PView( )
    {
        parent::SecurePage( );
		$this->active_page = "support";
        $this->viewFile = "support.phtml";
        
    }

    public function load( )
    {
        parent::load( );
       
        var_dump($this->account);
	   if(isset($_GET['tid']) AND is_numeric($_GET['tid']) AND $_GET['tid']>0)
	   {
		   $this->tid = $_GET['tid'];
	   }
	   elseif(isset($_GET['newticket']) AND $_GET['newticket']=='true')
	   {
		   $this->show_inbox = false;
		   $this->show_new = true;
	   }
	   
	   if(isset($this->tid) AND $this->tid!=null)
	   {
			$this->show_inbox = false;
	   }
	   
	   
	   if($this->show_inbox)
	   {
		   if(isset($_GET['page']) AND is_numeric($_GET['page']) AND $_GET['page']>1)
		   {
			   $this->page = $_GET['page'];
		   }
		   $m = new SupportModel();
		   $this->inbox_info = $m->GetTickets($this->account->uid, $this->page, $this->items_per_page);
		   
		   
		   $m->dispose();
	   }
	   elseif($this->show_new)
	   {
		   if($this->isPost())
		   {
			   $this->error = true;
			   
				if(!isset($_POST['subject']))
				{
				   $this->error_m .= "Subject is required.<br>";
				}
				elseif(!(trim($_POST['subject'])!='' AND $_POST['subject']!=null))
				{
					$this->error_m .= "Subject is blank!";
				}
				elseif(!$this->StringSafe($_POST['subject']))
				{
					$this->error_m .= "Invalid characters used in Subject! Just A-Z a-z 0-9 '_' and arabic letters are valid.";
				}
				else
				{
					$this->subject = $_POST['subject'];
				}
			   
			   
				if(!isset($_POST['content']))
				{
				   $this->error_m .= "Content is required.<br>";
				}
				elseif(!(trim($_POST['content'])!='' AND $_POST['content']!=null))
				{
					$this->error_m .= "Content is blank!";
				}
				elseif(!$this->StringSafe($_POST['content']))
				{
					$this->error_m .= "Invalid characters used in Content! Just A-Z a-z 0-9 '_' and arabic letters are valid.";
				}
				else
				{
					$this->content = $_POST['content'];
				}
			   
			   
				if(isset($_POST['service']) AND (trim($_POST['service'])!='' AND $_POST['service']!=null))
				{
					if(!$this->StringSafe($_POST['service']))
					{
						$this->error_m .= "Invalid characters used in Tracking ID! Just A-Z a-z 0-9 '_' and arabic letters are valid.";
					}
					else
					{
						$this->tracking_id = $_POST['service'];
					}
				}
				
				if($this->subject != "" AND $this->content!="")
				{
					if(isset($_POST['service']) AND (trim($_POST['service'])!='' AND $_POST['service']!=null))
					{
						if($this->tracking_id != "") 
						{
							$this->error = false;
						}
					}
					else
					{
						$this->error = false;
					}
				}
				
				if(!$this->error)
				{
					$m = new SupportModel();
					
					$ticket_id = $m->NewTicketSubmit($this->subject, $this->content, $this->tracking_id, $this->account->uid);
					
					$m->dispose();
					
					$this->action_status = true;
					$this->action_m = "<center>Your ticket has been successfully submited and support will answer you soon.<br>Your ticket ID : ".$ticket_id."</center>";
					unset($_POST['subject']);
					unset($_POST['service']);
					unset($_POST['content']);
				}
		   }
		}
		elseif(isset($this->tid) AND $this->tid!=null)
		{
			$m = new SupportModel();
			if($this->isPost())
			{
			   $this->error = true;
			   
				if(isset($_POST['subject']) AND (trim($_POST['subject'])!='' AND $_POST['subject']!=null))
				{
					if(!$this->StringSafe($_POST['subject']))
					{
						$this->error_m .= "Invalid characters used in Subject! Just A-Z a-z 0-9 '_' and arabic letters are valid.";
					}
					else
					{
						$this->subject = $_POST['subject'];
					}
				}
			   
			   
				if(!isset($_POST['content']))
				{
				   $this->error_m .= "Content is required.<br>";
				}
				elseif(!(trim($_POST['content'])!='' AND $_POST['content']!=null))
				{
					$this->error_m .= "Content is blank!";
				}
				elseif(!$this->StringSafe($_POST['content']))
				{
					$this->error_m .= "Invalid characters used in Content! Just A-Z a-z 0-9 '_' and arabic letters are valid.";
				}
				else
				{
					$this->content = $_POST['content'];
				}
				
				if($this->content!="")
				{
					$ticket_id = $m->NewTicketAnswerSubmit($this->subject, $this->content, $this->tid, $this->account->uid);
					$this->action_status = true;
					$this->action_m = "<center>Your ticket answer has been successfully submited and support will answer you soon.</center>";
					unset($_POST['subject']);
					unset($_POST['content']);
				}
			}
			if(isset($_GET['status']) AND $_GET['status']!="")
			{
				$m->UpdateTicketStatus($this->account->uid, $this->tid, $_GET['status']);
			}
			$m->SetTicketAsReaded($this->tid);
			$this->Ticket_info = $m->GetTicketByID($this->tid);
			$this->answers_info = $m->GetTicketAnswersByID($this->tid);
			
			$m->dispose();
		}
    }

    

}

$p = new PView( );
$p->run( );
