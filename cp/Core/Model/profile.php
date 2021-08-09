<?php
include(MODEL_PATH."base.php");

class ProfileModel extends ModelBase
{
	
	public function UpdateUserField($field, $value, $uid)
	{
		$q = "UPDATE `users` SET `".$field."`=:value WHERE `id`=:uid";
		$params = array(':uid'=>$uid, ':value'=>$value);
		return $this->ExecQuery($q, $params);
	}
	
	public function EmailExist($email)
	{
		$q = "SELECT count(*) as c FROM `users` WHERE `email`=:email";
		$params = array(':email'=>$email);
		$res = $this->singleRow($q,$params);
		return ($res['c']==1);
	}
}

?>
