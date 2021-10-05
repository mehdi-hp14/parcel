<?php
include_once(MODEL_PATH."base.php");

class TransactionsModel extends ModelBase
{
	public function GetTransactions($uref, $page, $items_per_page)
	{

		$q = "SELECT * FROM `transactions` WHERE `uref`=:uref AND `type` IN (0,1,2,3)";

		if(isset($_GET['from_date']) || isset($_GET['to_date']) ){
			$from = $_GET['from_date'] ? (new DateTime($_GET['from_date'].' 00:00:00' ))->getTimestamp() : 0;
			$to = $_GET['to_date'] ? (new DateTime($_GET['to_date'].' 23:59:59' ))->getTimestamp() : (new DateTime($_GET['from_date'].' 23:59:59' ))->getTimestamp();
			$q.=" AND timestamp between '{$from}' and '{$to}' ";
		}

		if(!empty($_GET['per_page'])){
			$items_per_page = $_GET['per_page'];
		}

		$q.="ORDER BY `timestamp` DESC, `id` ASC LIMIT ".(($page-1)*$items_per_page).",".$items_per_page."";
		//echo $q."<br>";
		$params = array(':uref'=>$uref);
		return $this->GetRowsInArray($q, $params);
	}
	public function GetTotalTransactionsCount($uref)
	{
		$q = "SELECT count(*) as c FROM `transactions` WHERE `uref`=:uref AND `type` IN (0,1,2,3)";

		if(isset($_GET['from_date']) || isset($_GET['to_date']) ){
			$from = $_GET['from_date'] ? (new DateTime($_GET['from_date'] ))->getTimestamp() : 0;
			$to = (new DateTime($_GET['to_date'] ))->getTimestamp() ;
			$q.=" AND timestamp between '{$from}' and '{$to}' ";
		}

		$params = array(':uref'=>$uref);
		$res = $this->singleRow($q, $params);
		return $res['c'];
	}
}

?>
