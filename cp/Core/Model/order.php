<?php
include_once(MODEL_PATH."base.php");

class OrderModel extends ModelBase
{
	public function OfficialOfficeExist($from, $to="none")
	{
		$q = "SELECT * FROM `agents_official_meta` WHERE `cover_counteries` LIKE '%".$from."%' OR (".($from=='Iran' ? 'true' : 'false')." AND `cover_counteries` LIKE '%".$to."%') ORDER by `id` DESC";
		return $this->singleRow($q,$params);
	}
	public function GetOrders($uname, $page, $items_per_page)
	{
		$q = "SELECT `from`,`to`, `item_c`, `timestamp`, `status`, `id`, `tid` FROM `quote` WHERE `uname`=:uname ORDER BY `timestamp` DESC, `id` ASC LIMIT ".(($page-1)*$items_per_page).",".$items_per_page."";
		//echo $q."<br>";
		$params = array(':uname'=>$uname);
		return $this->GetRowsInArray($q, $params);
	}
	
	public function GetOrderByID($uname,$oid)
	{
		$q = "SELECT *, count(*) as counter FROM `quote` WHERE `id`=:oid AND `uname`=:uname";
		$params = array(':uname'=>$uname, ':oid'=>$oid);
		return $this->singleRow($q, $params);
	}
	
	public function GetOrderStatusByID($oid)
	{
		$q = "SELECT * FROM `qstatus` WHERE `rid`=:rid ORDER BY `timestamp` DESC, `id` ASC";
		$params = array(':rid'=>$oid);
		return $this->GetRowsInArray($q, $params);
	}
	
	public function GetOrderTransactionsByID($oid, $uid)
	{
		$q = "SELECT * FROM `transactions` WHERE `oref`=:rid AND `uref`=:uid AND type=0 ORDER BY `timestamp` DESC, `id` ASC";
		$params = array(':rid'=>$oid, ':uid'=>$uid);
		return $this->GetRowsInArray($q, $params);
	}
	
	public function NewOrderSubmit($subject, $content, $tid, $uid)
	{	
		$q = "INSERT INTO `tickets` (`subject`, `content`, `tid`, `uid`, `c_date`, `primary_p`, `status`, `usr_readed`, `adm_readed`, `user_sent`) VALUES (:subject, :content, :tid, :uid, :time, :primary_p, :status, :usr_readed, :adm_readed, :user_sent);";
		$params = array(':subject'=>$subject, ':content'=>$content, ':tid'=>$tid, ':uid'=>$uid, ':primary_p'=>1, ':status'=>0, ':usr_readed'=>1, ':adm_readed'=>0, ':time'=>time(), ':user_sent'=>1);
		$id = $this->singleInsert($q,$params);
		
		return $id;
	}
	
	public function ConfirmOrder($oid, $conf_p)
	{
		$q = "UPDATE `quote` SET `offered_p`=:conf_p WHERE `id`=:oid";
		$params = array(':oid'=>$oid, ':conf_p'=>$conf_p);
		return $this->ExecQuery($q, $params);
	}
	
	public function SetAsPaid($oid)
	{
		$q = "UPDATE `quote` SET `paid`=:stat WHERE `id`=:oid";
		$params = array(':oid'=>$oid, ':stat'=>'yes');
		return $this->ExecQuery($q, $params);
	}
	
	public function SetAsConfirmed($oid)
	{
		$q = "UPDATE `quote` SET `user_confirm`=:stat WHERE `id`=:oid";
		$params = array(':oid'=>$oid, ':stat'=>'yes');
		return $this->ExecQuery($q, $params);
	}
	
	public function GetTotalOrdersCount($uref)
	{
		$q = "SELECT count(*) as c FROM `quote` WHERE `uname`=:uref ";
		$params = array(':uref'=>$uref);
		$res = $this->singleRow($q, $params);
		return $res['c'];
	}
	
	public function ModifyUserBalance($oid, $amount, $currency, $mode=0)
	{
		if($mode==0)
		{
			$q = "UPDATE `users` SET `".$currency."_current_balance`= ".$currency."_current_balance - ".$amount.", `".$currency."_total_order_paid`= ".$currency."_total_order_paid + ".$amount." WHERE `id`=:oid";
		}
		//echo $q."<br>"; //exit;
		$params = array(':oid'=>$oid);
		return $this->ExecQuery($q, $params);
	}
	
	public function ReportForDeposite($oid, $uid, $amount, $currency)
	{
		$q = "INSERT INTO `transactions` (`oref`, `uref`, `amount`, `currency`, `timestamp`, `description`) VALUES (:oref, :uref, :amount, :currency, :time, 'Transaction has been done when user confirmed in panel.');";
		$params = array(':oref'=>$oid, ':uref'=>$uid, ':amount'=>$amount, ':currency'=>$currency,':time'=>time());
		$id = $this->singleInsert($q,$params);
		
		return $id;
	}
	
	public function InsertShipInfo($oid, $SCName, $SCPName, $SeMail, $SPhone, $Scountry, $SZipCode, $Sender, $RCName, $RCPName, $ReMail, $RPhone, $Rcountry, $RZipCode, $Receiver)
	{
		$q = "INSERT INTO `ship_info` (`ref`, `scompany`, `saddress`, `szipcode`, `scountry`, `scontactp`, `stelephone`, `semail`, `rcompany`, `raddress`, `rpostcode`, `remail`, `rcountry`, `rtelephone`, `rcontactp`) 
		VALUES (:ref, :scompany, :saddress, :szipcode, :scountry, :scontactp, :stelephone, :semail, :rcompany, :raddress, :rpostcode, :remail, :rcountry, :rtelephone, :rcontactp);";
		$params = array(
			':ref'=>$oid,
			':scompany'=>$SCName,
			':scontactp'=>$SCPName,
			':semail'=>$SeMail,
			':stelephone'=>$SPhone,
			':scountry'=>$Scountry,
			':szipcode'=>$SZipCode,
			':saddress'=>$Sender,
			':rcompany'=>$RCName,
			':rcontactp'=>$RCPName,
			':remail'=>$ReMail,
			':rtelephone'=>$RPhone,
			':rcountry'=>$Rcountry,
			':rpostcode'=>$RZipCode,
			':raddress'=>$Receiver,
		);
		$id = $this->singleInsert($q,$params);
		
		return $id;
	}
	
	public function GetShipInfoByID($oid)
	{
		$q = "SELECT *, count(*) as counter FROM `ship_info` WHERE `ref`=:oid";
		$params = array(':oid'=>$oid);
		return $this->singleRow($q, $params);
	}
}

?>
