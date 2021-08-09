<?php
class Model
{
    public $db;

    public function __construct(){
		
		try {
			$this->db = new PDO("mysql:host=".$GLOBALS['Config']['db']['host'].";dbname=".$GLOBALS['Config']['db']['name'], $GLOBALS['Config']['db']['user'], $GLOBALS['Config']['db']['pass']);
			// set the PDO error mode to exception
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e)
		{
			echo "Connection failed: " . $e->getMessage();
			exit;
		}
    }
	
	public function getSiteNews()
	{
		$news = array();
		$sth = $this->db->prepare("SELECT title, text FROM news WHERE `status`=:status AND `type`=:type ORDER BY `creation_date` ASC, `modified_date` ASC, `id` ASC");
		$sth->bindValue(':status', 1);
		$sth->bindValue(':type', 1);
		$sth->execute();
		
		$rnews = $sth->fetchAll(PDO::FETCH_ASSOC);
		
		foreach($rnews as $n){
			//$news[] = "<b>".$n['title']."</b> : ".preg_replace('#<[^>]+>#', ' ', $n['text'])."";
			$news[] = "<b>".$n['title']."</b> : ". strip_tags($n['text']) ."";
		}
		
		return $news;
	}
	
	public function getSiteToS()
	{
		$news = array();
		$sth = $this->db->prepare("SELECT * FROM news WHERE `status`=:status AND `type`=:type ORDER BY `creation_date` ASC, `modified_date` ASC, `id` ASC");
		$sth->bindValue(':status', 1);
		$sth->bindValue(':type', 2);
		$sth->execute();
		
		$rnews = $sth->fetchAll(PDO::FETCH_ASSOC);
		
		
		return $rnews;
	}
	
	public function GetBasicData($uid)
	{
		//, `IRR_total_receive`, `IRR_current_balance`, `IRR_total_order_paid`, `GBP_total_receive`, `GBP_current_balance`, `GBP_total_order_paid`, `USD_total_receive`, `USD_current_balance`, `USD_total_order_paid`, `EUR_total_receive`, `EUR_current_balance`, `EUR_total_order_paid`

		$sth = $this->db->prepare("SELECT `id`, `uname`, `fname`, `lname`, `company`, `mdp`, `email`, `balance`, `total_order`, `total_pay`, `gender`, `position`, `birthday`, `address`, `about`, `site`, `phone`, `orders`, `orders_c`, `unread`, `avatar`, `created_at`, `updated_at` FROM `users` WHERE `id`=:uid");
		$sth->bindValue(':uid', $uid);
		$sth->execute();
		$res = $sth->fetch(PDO::FETCH_ASSOC);
		
		$sthh = $this->db->prepare("SELECT count(*) as co FROM `tickets` WHERE `uid`=:uid AND `usr_readed`=0");
		$sthh->bindValue(':uid', $uid);
		$sthh->execute();
		$resu = $sthh->fetch(PDO::FETCH_ASSOC);
		
		$res['support_c'] = $resu['co'];
		
		
		
		
		
		
		$sth1 = $this->db->prepare("SELECT SUM(`amount`) as sum FROM `transactions` WHERE `uref`=:uid AND `currency`='IRR' AND (`type`=1)");
		$sth1->bindValue(':uid', $uid);
		$sth1->execute();
		$inc_row = $sth1->fetch(PDO::FETCH_ASSOC);
		
		$sth11 = $this->db->prepare("SELECT SUM(`amount`) as sum FROM `transactions` WHERE `uref`=:uid AND `currency`='IRR' AND (`type`=1 or `type`=2 or `type`=4)");
		$sth11->bindValue(':uid', $uid);
		$sth11->execute();
		$sum_row = $sth11->fetch(PDO::FETCH_ASSOC);
		
		$sth111 = $this->db->prepare("SELECT SUM(`amount`) as subtract FROM `transactions` WHERE `uref`=:uid AND `currency`='IRR' AND (`type`=0 or `type`=3 or `type`=5)");
		$sth111->bindValue(':uid', $uid);
		$sth111->execute();
		$sub_row = $sth111->fetch(PDO::FETCH_ASSOC);
		
		$res['IRR_total_receive'] = (float)$inc_row['sum'];
		$res['IRR_current_balance'] = $sum_row['sum'] - $sub_row['subtract'];
		$res['IRR_total_order_paid'] = $res['IRR_total_receive'] - $res['IRR_current_balance'];


		$sth2 = $this->db->prepare("SELECT SUM(`amount`) as sum FROM `transactions` WHERE `uref`=:uid AND `currency`='GBP' AND (`type`=1)");
		$sth2->bindValue(':uid', $uid);
		$sth2->execute();
		$inc_row = $sth2->fetch(PDO::FETCH_ASSOC);
		
		$sth22 = $this->db->prepare("SELECT SUM(`amount`) as sum FROM `transactions` WHERE `uref`=:uid AND `currency`='GBP' AND (`type`=1 or `type`=2 or `type`=4)");
		$sth22->bindValue(':uid', $uid);
		$sth22->execute();
		$sum_row = $sth22->fetch(PDO::FETCH_ASSOC);
		
		$sth222 = $this->db->prepare("SELECT SUM(`amount`) as subtract FROM `transactions` WHERE `uref`=:uid AND `currency`='GBP' AND (`type`=0 or `type`=3 or `type`=5)");
		$sth222->bindValue(':uid', $uid);
		$sth222->execute();
		$sub_row = $sth222->fetch(PDO::FETCH_ASSOC);
		
		$res['GBP_total_receive'] = (float)$inc_row['sum'];
		$res['GBP_current_balance'] = $sum_row['sum'] - $sub_row['subtract'];
		$res['GBP_total_order_paid'] = $res['GBP_total_receive'] - $res['GBP_current_balance'];


		$sth3 = $this->db->prepare("SELECT SUM(`amount`) as sum FROM `transactions` WHERE `uref`=:uid AND `currency`='EUR' AND (`type`=1)");
		$sth3->bindValue(':uid', $uid);
		$sth3->execute();
		$inc_row = $sth3->fetch(PDO::FETCH_ASSOC);
		
		$sth33 = $this->db->prepare("SELECT SUM(`amount`) as sum FROM `transactions` WHERE `uref`=:uid AND `currency`='EUR' AND (`type`=1 or `type`=2 or `type`=4)");
		$sth33->bindValue(':uid', $uid);
		$sth33->execute();
		$sum_row = $sth33->fetch(PDO::FETCH_ASSOC);
		
		$sth333 = $this->db->prepare("SELECT SUM(`amount`) as subtract FROM `transactions` WHERE `uref`=:uid AND `currency`='EUR' AND (`type`=0 or `type`=3 or `type`=5)");
		$sth333->bindValue(':uid', $uid);
		$sth333->execute();
		$sub_row = $sth333->fetch(PDO::FETCH_ASSOC);
		
		$res['EUR_total_receive'] = (float)$inc_row['sum'];
		$res['EUR_current_balance'] = $sum_row['sum'] - $sub_row['subtract'];
		$res['EUR_total_order_paid'] = $res['EUR_total_receive'] - $res['EUR_current_balance'];


		$sth4 = $this->db->prepare("SELECT SUM(`amount`) as sum FROM `transactions` WHERE `uref`=:uid AND `currency`='USD' AND (`type`=1)");
		$sth4->bindValue(':uid', $uid);
		$sth4->execute();
		$inc_row = $sth4->fetch(PDO::FETCH_ASSOC);
		
		$sth44 = $this->db->prepare("SELECT SUM(`amount`) as sum FROM `transactions` WHERE `uref`=:uid AND `currency`='USD' AND (`type`=1 or `type`=2 or `type`=4)");
		$sth44->bindValue(':uid', $uid);
		$sth44->execute();
		$sum_row = $sth44->fetch(PDO::FETCH_ASSOC);
		
		$sth444 = $this->db->prepare("SELECT SUM(`amount`) as subtract FROM `transactions` WHERE `uref`=:uid AND `currency`='USD' AND (`type`=0 or `type`=3 or `type`=5)");
		$sth444->bindValue(':uid', $uid);
		$sth444->execute();
		$sub_row = $sth444->fetch(PDO::FETCH_ASSOC);
		
		$res['USD_total_receive'] = (float)$inc_row['sum'];
		$res['USD_current_balance'] = $sum_row['sum'] - $sub_row['subtract'];
		$res['USD_total_order_paid'] = $res['USD_total_receive'] - $res['USD_current_balance'];
		
		
		
		
		
		return $res;
	}
	
	public function dispose()
	{
		$this->db = null;
	}
}