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
		$sth = $this->db->prepare("SELECT `id`, `uname`, `fname`, `lname`, `company`, `mdp`, `email`, `balance`, `total_order`, `total_pay`, `gender`, `position`, `birthday`, `address`, `about`, `site`, `phone`, `orders`, `orders_c`, `unread`, `avatar`, `created_at`, `updated_at`, `IRR_total_receive`, `IRR_current_balance`, `IRR_total_order_paid`, `GBP_total_receive`, `GBP_current_balance`, `GBP_total_order_paid`, `USD_total_receive`, `USD_current_balance`, `USD_total_order_paid`, `EUR_total_receive`, `EUR_current_balance`, `EUR_total_order_paid` FROM `users` WHERE `id`=:uid");
		$sth->bindValue(':uid', $uid);
		$sth->execute();
		$res = $sth->fetch(PDO::FETCH_ASSOC);
		
		$sthh = $this->db->prepare("SELECT count(*) as co FROM `tickets` WHERE `uid`=:uid AND `usr_readed`=0");
		$sthh->bindValue(':uid', $uid);
		$sthh->execute();
		$resu = $sthh->fetch(PDO::FETCH_ASSOC);
		
		$res['support_c'] = $resu['co'];
		return $res;
	}
	
	public function dispose()
	{
		$this->db = null;
	}
}