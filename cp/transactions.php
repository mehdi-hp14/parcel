<?php
require(__DIR__ ."". DIRECTORY_SEPARATOR ."Core". DIRECTORY_SEPARATOR ."boot.php");
require_once(MODEL_PATH."transactions.php");
require_once(APP_PATH."Mailer.php");

class PView extends SecurePage
{

	public $show_inbox = true;
	public $page = 1;
	public $items_per_page = 30;
	public $total_Res = 0;
	public $total_Page = 0;
	public $Transactons_Info = null;
	
	public $error = false;
	public $error_m = "";
	
    public function PView( )
    {
        parent::SecurePage( );
		$this->active_page = "transactions";
        $this->viewFile = "transactions.phtml";
        
    }

    public function load( )
    {
        parent::load( );
		
		$m = new TransactionsModel();
		if(isset($_GET['page']) AND is_numeric($_GET['page']) AND $_GET['page']>1)
		{
			$this->page = $_GET['page'];
		}
		$this->Transactons_Info = $m->GetTransactions($this->data['id'], $this->page, $this->items_per_page);
		$this->total_Res = $m->GetTotalTransactionsCount($this->data['id']);
		$this->total_Page = ceil($this->total_Res / $this->items_per_page);
		$m->dispose();
    }

    public function RenderPagination($cur_Page, $total_Page, $itemPerPage, $total_Res)
	{
		$output = '<div class="pull-left"><span class="text-muted"><b>'.(($itemPerPage * ($cur_Page - 1)) + 1).'</b>&nbsp; – &nbsp;<b>'.min(($itemPerPage * $cur_Page ), $total_Res).'</b>&nbsp; of &nbsp;<b>'.$total_Res.'</b></span>';
	
        $output .= '<div class="btn-group mlm">';
		if($cur_Page>1)
		{
			$output .= '<button type="button" class="btn btn-default" onclick="window.location.href=\'transactions.php?page='.($cur_Page-1).'\';"><span class="fa fa-chevron-left"></span></button>';
		}
		else
		{
			$output .= '<button type="button" class="btn btn-default"><span class="fa fa-chevron-left"></span></button>';
		}
		if($cur_Page<$total_Page)
		{
			$output .= '<button type="button" class="btn btn-default" onclick="window.location.href=\'transactions.php?page='.($cur_Page+1).'\';"><span class="fa fa-chevron-right"></span></button>';
		}
		else
		{
			$output .= '<button type="button" class="btn btn-default"><span class="fa fa-chevron-right"></span></button>';
		}
			
		$output .= '</div></div>';
		return $output;
	}

}

$p = new PView( );
$p->run( );
