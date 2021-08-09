<?php
require(__DIR__ ."". DIRECTORY_SEPARATOR ."Core". DIRECTORY_SEPARATOR ."boot.php");
require_once(MODEL_PATH."profile.php");

class PView extends SecurePage
{
	
	public $action_m = "";
	public $action_status = false;
	public $error_m = "";
	public $error = true;
	
    public function PView( )
    {
        parent::SecurePage( );
		$this->active_page = "profile";
        $this->viewFile = "profile.phtml";
        
    }

    public function load( )
    {
        parent::load( );
		
		if($this->isPost())
		{
			if(isset($_POST['t']) AND is_numeric($_POST['t']) AND $_POST['t']>=0 AND $_POST['t']<=1)
			{
				switch($_POST['t'])
				{
					case 0 : $this->UpdateProfile($_POST); break;
					case 1 : $this->AvatarUpload(); break;
				}
			}
		}
		
    }
	
	public function UpdateProfile($post)
	{
		//$this->error = true;
		$m = new ProfileModel();
		
		if(isset($post['email']) AND trim($post['email'])!="" AND $post['email']!=null)
		{
			if(!$this->EmailFormatCheck($post['email']))
			{
				$this->error_m .= "Please provide a valid E-mail address to change your E-mail.<br>";
			}
			elseif($m->EmailExist($post['email']))
			{
				$this->error_m .= "Email already exist!<br>";
			}
			else
			{
				$this->action_m .= "Email has been changed successfully.<br>";
				$m->UpdateUserField("email", $post['email'], $this->account->uid);
				unset($_POST['email']);
			}
		}
		
		if(isset($post['fname']) AND trim($post['fname'])!="" AND $post['fname']!=null)
		{
			if(!$this->StringSafe($post['fname']))
			{
				$this->error_m .= "Invalid characters used in First Name! Just A-Z a-z 0-9 '_' and arabic letters are valid.<br>";
			}
			else
			{
				$this->action_m .= "First Name has been changed successfully.<br>";
				$m->UpdateUserField("fname", $post['fname'], $this->account->uid);
				unset($_POST['fname']);
			}
		}
		
		if(isset($post['lname']) AND trim($post['lname'])!="" AND $post['lname']!=null)
		{
			if(!$this->StringSafe($post['lname']))
			{
				$this->error_m .= "Invalid characters used in Last Name! Just A-Z a-z 0-9 '_' and arabic letters are valid.<br>";
			}
			else
			{
				$this->action_m .= "Last Name has been changed successfully.<br>";
				$m->UpdateUserField("lname", $post['lname'], $this->account->uid);
				unset($_POST['lname']);
			}
		}
		
		if(isset($post['cname']) AND trim($post['cname'])!="" AND $post['cname']!=null)
		{
			if(!$this->StringSafe($post['cname']))
			{
				$this->error_m .= "Invalid characters used in Company Name! Just A-Z a-z 0-9 '_' and arabic letters are valid.<br>";
			}
			else
			{
				$this->action_m .= "Company Name has been changed successfully.<br>";
				$m->UpdateUserField("company", $post['cname'], $this->account->uid);
				unset($_POST['cname']);
			}
		}
		
		if(isset($post['birthday']) AND trim($post['birthday'])!="" AND $post['birthday']!=null)
		{
			if(!$this->StringSafe($post['birthday']))
			{
				$this->error_m .= "Invalid characters used in Birthday! Just A-Z a-z 0-9 '_' and arabic letters are valid.<br>";
			}
			else
			{
				$this->action_m .= "Birthday has been changed successfully.<br>";
				$m->UpdateUserField("birthday", $post['birthday'], $this->account->uid);
				unset($_POST['birthday']);
			}
		}
		
		if(isset($post['about']) AND trim($post['about'])!="" AND $post['about']!=null)
		{
			if(!$this->StringSafe($post['about']))
			{
				$this->error_m .= "Invalid characters used in 'About'! Just A-Z a-z 0-9 '_' and arabic letters are valid.<br>";
			}
			else
			{
				$this->action_m .= "'About' has been changed successfully.<br>";
				$m->UpdateUserField("about", $post['about'], $this->account->uid);
				unset($_POST['about']);
			}
		}
		
		if(isset($post['address']) AND trim($post['address'])!="" AND $post['address']!=null)
		{
			if(!$this->StringSafe($post['address']))
			{
				$this->error_m .= "Invalid characters used in 'address'! Just A-Z a-z 0-9 '_' and arabic letters are valid.<br>";
			}
			else
			{
				$this->action_m .= "'address' has been changed successfully.<br>";
				$m->UpdateUserField("address", $post['address'], $this->account->uid);
				unset($_POST['address']);
			}
		}
		
		if(isset($post['phone']) AND trim($post['phone'])!="" AND $post['phone']!=null)
		{
			if(!$this->StringSafe($post['phone']))
			{
				$this->error_m .= "Invalid characters used in Phone Number! Just A-Z a-z 0-9 '_' and arabic letters are valid.<br>";
			}
			else
			{
				$this->action_m .= "phone has been changed successfully.<br>";
				$m->UpdateUserField("phone", $post['phone'], $this->account->uid);
				unset($_POST['phone']);
			}
		}
		
		if(isset($post['site']) AND trim($post['site'])!="" AND $post['site']!=null)
		{
			if(!$this->URLValidator($post['site']))
			{
				$this->error_m .= "Invalid characters used in Website! Please enter a valid URL.<br>";
			}
			else
			{
				$this->action_m .= "Website has been changed successfully.<br>";
				$m->UpdateUserField("site", $post['site'], $this->account->uid);
				unset($_POST['site']);
			}
		}
		
		if(isset($post['gender']) AND trim($post['gender'])!="" AND $post['gender']!=null)
		{
			if(!($post['gender']>=0 AND $post['gender']<=1))
			{
				$this->error_m .= "Invalid value for gender.<br>";
			}
			else
			{
				$this->action_m .= "Gender has been changed successfully.<br>";
				$m->UpdateUserField("gender", $post['gender'], $this->account->uid);
				unset($_POST['gender']);
			}
		}
		
		if(isset($post['position']) AND trim($post['position'])!="" AND $post['position']!=null)
		{
			if(!($post['position']>=0 AND $post['position']<=6))
			{
				$this->error_m .= "Invalid value for position.<br>";
			}
			else
			{
				$this->action_m .= "Position has been changed successfully.<br>";
				$m->UpdateUserField("position", $post['position'], $this->account->uid);
				unset($_POST['position']);
			}
		}
		
		if(isset($post['password']) AND trim($post['password'])!="" AND $post['password']!=null)
		{
			if(!(isset($post['passwordc']) AND trim($post['passwordc'])!="" AND $post['passwordc']!=null))
			{
				$this->error_m .= "To change your password you must confirm your new password<br>";
			}
			else{
				if(!$this->StringSafe($post['password']))
				{
					$this->error_m .= "Invalid characters used in Password! Just A-Z a-z 0-9 '_' and arabic letters are valid.<br>";
				}
				elseif(!$this->StringSafe($post['passwordc']))
				{
					$this->error_m .= "Invalid characters used in Password Confirmation! Just A-Z a-z 0-9 '_' and arabic letters are valid.<br>";
				}
				elseif($post['password'] != $post['passwordc'])
				{
					$this->error_m .= "Password And Password Confirmation must be the same.<br>";
				}
				else
				{
					$this->action_m .= "Password has been changed successfully.<br>";
					$m->UpdateUserField("pwd", $this->PassToHash($post['position']), $this->account->uid);
					unset($_POST['password']);
					unset($_POST['passwordc']);
				}
			}
		}
		
		if($this->error_m != "") $this->error = true;
		if($this->action_m != "") $this->action_status = true;
	}
	
	public function AvatarUpload()
	{
		$this->error = true;
		if(isset($_FILES['avatar']) AND $_FILES['avatar']['name'] !="" AND $_FILES['avatar']['name']!=null){
			$target_dir = "Assets/images/avatar/";
			$target_file = $target_dir .$this->account->uid ."_". basename($_FILES["avatar"]["name"]);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			$format = explode(".",basename($_FILES["avatar"]["name"]));
			$format = $format[(count($format)-1)];
			$filename = $this->account->uid ."_". substr(md5(basename($_FILES["avatar"]["name"])),1,6).".".$format;
			$target_file = $target_dir .$this->account->uid ."_". substr(md5(basename($_FILES["avatar"]["name"])),1,6).".".$format;
			
			$check = getimagesize($_FILES["avatar"]["tmp_name"]);
			if($check !== false) {
				$uploadOk = 1;
			} 
			else {
				$this->error_m .= "Invalid file type.<br>";
				$uploadOk = 0;
			}
			if($uploadOk)
			{
				if($check[0]>800) {
					$this->error_m .= "Invalid width size<br>";
					$uploadOk = 0;
				} elseif($check[1]>800) {
					$this->error_m .= "Invalid height size<br>";
					$uploadOk = 0;
				} 
				elseif($_FILES["avatar"]["size"] > 309600) {
					$this->error_m .= "Invalid file size<br>";
					$uploadOk = 0;
				} elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
					$this->error_m .= "Invalid file format<br>";
					$uploadOk = 0;
				} 
				if ($uploadOk == 0) {
					$this->error_m .= "Sorry, your file was not uploaded.<br>";
				} else {
					if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
						$this->error = false;
						$this->action_status = true;
						$this->action_m = "The file ". basename( $_FILES["avatar"]["name"]). " has been uploaded.<br><a href='profile.php'>Click Here to see the result</a>";
						
						$m = new ProfileModel();
						$m->UpdateUserField("avatar", $filename, $this->account->uid);
						$m->dispose();
					}
				}
			}
		}
	}

    

}

$p = new PView( );
$p->run( );
