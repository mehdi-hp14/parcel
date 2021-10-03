<?php
include(MODEL_PATH."base.php");

class SupportModel extends ModelBase
{
	public function GetTickets($uid, $page, $items_per_page)
	{
	   // echo "GetcTickets : <br>";
	   // echo $uid ."<br>";
	   // echo $page ."<br>";
	    //echo $items_per_page ."<br><br><br>";
		$q = "SELECT `subject`,`id`,`tid`, `content`, `c_date`, `status`, `usr_readed` ,
		(SELECT COUNT(*) as c from `tickets` as `t` where t.ref=tickets.id and usr_readed=0) as not_readed_tickets
		 FROM `tickets`
		 
		  WHERE `uid`=:uid AND `primary_p`=1 ";
		if(isset($_GET['search-tid'])){
			$q .= "AND tid like '%{$_GET['search-tid']}%'";
		}
		$q .= " ORDER BY `c_date` DESC, `id` ASC LIMIT ".($page-1).",".$items_per_page."";
		$params = array(':uid'=>$uid/*, ':page'=>($page-1), ':perpage'=>$items_per_page*/);
		return $this->GetRowsInArray($q, $params);
	}

	public function SetTicketAsReaded($tid)
	{
		$q = "UPDATE `tickets` SET `usr_readed`=1 WHERE `id`=:tid OR `ref`=:ref";
		$params = array(':tid'=>$tid, ':ref'=>$tid);
		return $this->ExecQuery($q, $params);
	}

	public function UpdateTicketStatus($uid, $tid, $status)
	{
		$tmp =0;
		switch($status)
		{
			case 'close': $tmp = 1; break;
			case 'active': $tmp = 0; break;
		}
		$q = "UPDATE `tickets` SET `status`=:status WHERE `id`=:tid AND `primary_p`=1 AND `uid`=:uid";
		$params = array(':uid'=>$uid, ':tid'=>$tid, ':status'=>$tmp);
		return $this->ExecQuery($q, $params);
	}

	public function GetTicketByID($tid)
	{
		$q = "SELECT `subject`,`user_sent`, `content`, `c_date`, `status`, `tid`, count(*) as counter FROM `tickets` WHERE `id`=:tid AND `primary_p`=1 AND `ref`=0";
		$params = array(':tid'=>$tid);
		return $this->singleRow($q, $params);
	}

	public function GetTicketAnswersByID($tid)
	{
		$q = "SELECT `subject`,`user_sent`, `content`, `c_date`, `status` FROM `tickets` WHERE `primary_p`=0 AND `ref`=:tid ORDER BY `c_date` ASC, `id` ASC";
		$params = array(':tid'=>$tid);
		return $this->GetRowsInArray($q, $params);
	}

	public function NewTicketSubmit($subject, $content, $tid, $uid)
	{
		$q = "INSERT INTO `tickets` (`subject`, `content`, `tid`, `uid`, `c_date`, `primary_p`, `status`, `usr_readed`, `adm_readed`, `user_sent`) VALUES (:subject, :content, :tid, :uid, :time, :primary_p, :status, :usr_readed, :adm_readed, :user_sent);";
		$params = array(':subject'=>$subject, ':content'=>$content, ':tid'=>$tid, ':uid'=>$uid, ':primary_p'=>1, ':status'=>0, ':usr_readed'=>1, ':adm_readed'=>0, ':time'=>time(), ':user_sent'=>1);
		$id = $this->singleInsert($q,$params);

		return $id;
	}

	public function NewTicketAnswerSubmit($subject, $content, $TicketID, $uid)
	{
		$q = "INSERT INTO `tickets` (`subject`, `content`, `tid`, `uid`, `c_date`, `primary_p`, `status`, `usr_readed`, `adm_readed`, `user_sent`, `ref`) VALUES (:subject, :content, '', :uid, :time, :primary_p, :status, :usr_readed, :adm_readed, :user_sent, :ref);";
		$params = array(':subject'=>$subject, ':ref'=>$TicketID, ':content'=>$content, ':uid'=>$uid, ':primary_p'=>0, ':status'=>0, ':usr_readed'=>1, ':adm_readed'=>0, ':time'=>time(), ':user_sent'=>1);
		$id = $this->singleInsert($q,$params);

		return $id;
	}

	public function GetOrders($uname, $page, $items_per_page)
	{
		$q = "SELECT `from`,`to`, `item_c`, `timestamp`, `status`, `id`, `tid` FROM `quote` WHERE `uname`=:uname ORDER BY `timestamp` DESC, `id` ASC LIMIT ".($page-1).",".$items_per_page."";
		$params = array(':uname'=>$uname);
		return $this->GetRowsInArray($q, $params);
	}
}

?>
