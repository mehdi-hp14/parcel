<?php
include(MODEL_PATH."base.php");

class SignupModel extends ModelBase
{
	public function UserExist($name)
	{
		$q = "SELECT count(*) as c FROM `users` WHERE `uname`=:uname";
		$params = array(':uname'=>$name);
		$res = $this->singleRow($q,$params);
		return ($res['c']==1);
	}
	
	public function EmailExist($email)
	{
		$q = "SELECT count(*) as c FROM `users` WHERE `email`=:email";
		$params = array(':email'=>$email);
		$res = $this->singleRow($q,$params);
		return ($res['c']==1);
	}
	
	public function getSignupResult($uname, $pass, $email, $fname, $lname, $company, $gender, $newsletter)
	{
		$q = "INSERT INTO `users` (`uname`, `email`, `fname`, `lname`, `company`, `gender`, `newsletter`, `pwd`, `created_at`, `status`) VALUES (:uname, :email, :fname, :lname, :company, :gender, :newsletter, :pass, '".time()."', 0);";
		$params = array(':uname'=>$uname, ':pass'=>$pass, ':email'=>$email, ':fname'=>$fname, ':lname'=>$lname, ':company'=>$company, ':gender'=>$gender, ':newsletter'=>$newsletter);
		$id = $this->singleInsert($q,$params);
		
		return $id;
	}

}

?>
