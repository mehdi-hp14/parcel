<?php
include(MODEL_PATH."base.php");

class AgentsModel extends ModelBase
{
	public function OfficialOfficeExist($from, $to="none")
	{
		$q = "SELECT * FROM `agents_official_meta` WHERE `cover_counteries` LIKE '%".$from."%' OR (".($from=='Iran' ? 'true' : 'false')." AND `cover_counteries` LIKE '%".$to."%') ORDER by `id` DESC";
		return $this->singleRow($q,$params);
	}
	public function URLExists($idHash,$fromHash,$toHash)
	{
		$q = "SELECT `id`,`ref`,`aref`, count(*) as c FROM `urls` WHERE `idHash`=:idHash AND `fromHash`=:fromHash AND `toHash`=:toHash";
		$params = array(
			':idHash'=>$idHash,
			':fromHash'=>$fromHash,
			':toHash'=>$toHash
		);

		$res = $this->singleRow($q,$params);

		$ret = array('exists'=>($res['c']>=1),'id'=>$res['ref'],'aref'=>$res['aref'],'modelId'=> $res['id']);

		return $ret;
	}

	public function GetQuote($ref)
	{
		$q = "SELECT * FROM `quote` WHERE `id`=:ref";
		$params = array( ':ref'=>$ref );

		return $this->singleRow($q,$params);
	}

	public function GetUserInfo($uname)
	{
		$q = "SELECT * FROM `users` WHERE `uname`=:uname";
		$params = array( ':uname'=>$uname );

		return $this->singleRow($q,$params);
	}

	public function GetAgent($aref)
	{
		$q = "SELECT * FROM `agents` WHERE `id`=:aref";
		$params = array( ':aref'=>$aref );

		return $this->singleRow($q,$params);
	}

	public function UpdateOfferPrice($ref,$value, $value2)
	{
		$q = "UPDATE `quote` SET `offered_p`=:value2 , `received_p`=:value WHERE `id`=:ref";
		$params = array( ':ref'=>$ref , ':value'=>$value , ':value2'=>$value2 );

		return $this->ExecQuery($q,$params);
	}

	public function GetEmailBySubject($subject, $type=1)
	{
		$q = "SELECT * FROM `prenotes` WHERE `title`=:subject AND `type`=:type";
		$params = array( ':subject'=>$subject , ':type'=>$type );

		return $this->singleRow($q,$params);
	}

	public function InsertOffer($name,$company,$email,$offer,$message,$ref)
	{
		$q = "INSERT INTO `offers` (`ref`, `name`, `email`, `company`, `price`, `message`,`timestamp`) VALUES (:ref, :name, :email, :company, :price, :message, '".time()."');";
		$params = array(
			':ref'=>$ref,
			':name'=>$name,
			':email'=>$email,
			':company'=>$company,
			':price'=>$offer,
			':message'=>$message
		);
		$id = $this->singleInsert($q,$params);

		return $id;
	}

	public function InsertEmailBackup($ref,$body,$attachment="")
	{
		$q = "INSERT INTO `sent_mails` (`ref`, `body`, `attachment`, `timestamp`) VALUES (:ref, :body, :attachment, '".time()."');";

		$params = array(
			':ref'=>$ref,
			':body'=>$body,
			':attachment'=>$attachment
		);
		$id = $this->singleInsert($q,$params);

		return $id;
	}
	/*
	public function UserExist($name)
	{
		$q = "SELECT count(*) as c FROM `users` WHERE `uname`=:uname";
		$params = array(':uname'=>$name);
		$res = $this->singleRow($q,$params);
		return ($res['c']==1);
	}

	public function IsPassOk($name, $pass)
	{
		$q = "SELECT `pwd`,count(*) as c FROM `users` WHERE `uname`=:uname";
		$params = array(':uname'=>$name);
		$res = $this->singleRow($q,$params);
		return password_verify ($pass, $res['pwd']);
	}

	public function getLoginResult($name, $pass)
	{

		$res = array("text"=>null, "uid"=>null);
		if(!$this->IsPassOk($name, $pass)){
			$res["text"] = "UserName And PassWord does not match.";
		}
		else{
			$q = "SELECT `status`, `id` FROM `users` WHERE `uname`=:uname";
			$params = array(':uname'=>$name);
			$r = $this->singleRow($q,$params);

			if($r['status']==0){
				$res["text"] = "You need to check your email inbox (maybe your junk or spam box) to activate your account.";
			}
			elseif($r['status']==1){
				$res["text"] = "OK";
				$res["uid"] = $r['id'];
			}
		}

		return $res;
	}
*/
}

?>
