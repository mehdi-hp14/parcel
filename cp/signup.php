<?php
require(__DIR__ ."". DIRECTORY_SEPARATOR ."Core". DIRECTORY_SEPARATOR ."boot.php");
require_once(MODEL_PATH."signup.php");
require_once(APP_PATH."Mailer.php");

class PView extends PageView
{
	public $processed = false;
	public $error = null;
	public $error_m = array(
		'uname'=>'', 
		'pass'=>'', 
		'email'=>'', 
		'fname'=>'', 
		'lname'=>'', 
		'company'=>'', 
		'agb'=>'', 
		'gender'=>''
	);
	public $uname ='';
	public $pass ='';
	public $email ='';
	public $fname ='';
	public $lname ='';
	public $company = '';
	public $agb = null;
	public $newsletter = 0;
	public $gender = null;
	
	
    public function PView( )
    {
        parent::PageView( );
		$this->active_page = "signup";
        $this->viewFile = "signup.phtml";
        
    }

    public function load( )
    {
        parent::load( );
		
		if($this->isPost()){
			$model = new SignupModel();
			$this->error = true;
			//username validation
			if(!isset($_POST['uname']))
			{
				$this->error_m['uname'] = "UserName Not Set!";
			}
			elseif(!(trim($_POST['uname'])!='' AND $_POST['uname']!=null))
			{
				$this->error_m['uname'] = "UserName is blank!";
			}
			elseif(!$this->StringSafe($_POST['uname']))
			{
				$this->error_m['uname'] = "Invalid characters used in UserName! Just A-Z a-z 0-9 '_' and arabic letters are valid.";
			}
			elseif(strlen(trim($_POST['uname']))<$this->CoreConfig['other']['min_user_length'])
			{
				$this->error_m['uname'] = "UserName must contain at least ".$this->CoreConfig['other']['min_user_length']." chars";
			}
			elseif($model->UserExist($_POST['uname']))
			{
				$this->error_m['uname'] = "UserName already exist!";
			}
			else{
				$this->uname = $_POST['uname'];
			}
			
			
			
			//Email validation
			if(!isset($_POST['email']))
			{
				$this->error_m['email'] = "Email Not Set!";
			}
			elseif(!(trim($_POST['email'])!='' AND $_POST['email']!=null))
			{
				$this->error_m['email'] = "Email is blank!";
			}
			elseif(!$this->EmailFormatCheck($_POST['email']))
			{
				$this->error_m['email'] = "Email you entered is not valid. please enter a correct one.";
			}
			elseif($model->EmailExist($_POST['email']))
			{
				$this->error_m['email'] = "Email already exist!";
			}
			else{
				$this->email = $_POST['email'];
			}
			
			
			
			//FirstName validation
			if(!isset($_POST['fname']))
			{
				$this->error_m['fname'] = "FirstName Not Set!";
			}
			elseif(!(trim($_POST['fname'])!='' AND $_POST['fname']!=null))
			{
				$this->error_m['fname'] = "FirstName is blank!";
			}
			elseif(!$this->StringSafe($_POST['fname']))
			{
				$this->error_m['fname'] = "Invalid characters used in FirstName! Just A-Z a-z 0-9 '_' and arabic letters are valid.";
			}
			else{
				$this->fname = $_POST['fname'];
			}
			
			
			//LastName validation
			if(!isset($_POST['lname']))
			{
				$this->error_m['lname'] = "LastName Not Set!";
			}
			elseif(!(trim($_POST['lname'])!='' AND $_POST['lname']!=null))
			{
				$this->error_m['lname'] = "LastName is blank!";
			}
			elseif(!$this->StringSafe($_POST['lname']))
			{
				$this->error_m['lname'] = "Invalid characters used in LastName! Just A-Z a-z 0-9 '_' and arabic letters are valid.";
			}
			else{
				$this->lname = $_POST['lname'];
			}
			
			
			//Company validation
			if(!isset($_POST['company']))
			{
				$this->error_m['company'] = "Company Not Set!";
			}
			elseif(!(trim($_POST['company'])!='' AND $_POST['company']!=null))
			{
				$this->error_m['company'] = "Company is blank!";
			}
			elseif(!$this->StringSafe($_POST['company']))
			{
				$this->error_m['company'] = "Invalid characters used in Company! Just A-Z a-z 0-9 '_' and arabic letters are valid.";
			}
			else{
				$this->company = $_POST['company'];
			}
			
			
			//PassWord validation
			if(!isset($_POST['pass']))
			{
				$this->error_m['pass'] = "PassWord Not Set!";
			}
			elseif(!(trim($_POST['pass'])!='' AND $_POST['pass']!=null))
			{
				$this->error_m['pass'] = "PassWord is blank!";
			}
			elseif(!$this->StringSafe($_POST['pass']))
			{
				$this->error_m['pass'] = "Invalid characters used in PassWord! Just A-Z a-z 0-9 '_' and arabic letters are valid.";
			}
			elseif(!isset($_POST['passc']))
			{
				$this->error_m['passc'] = "PassWord confirmation Not Set!";
			}
			elseif(!(trim($_POST['passc'])!='' AND $_POST['passc']!=null))
			{
				$this->error_m['passc'] = "PassWord confirmation is blank!";
			}
			elseif(!$this->StringSafe($_POST['passc']))
			{
				$this->error_m['passc'] = "Invalid characters used in PassWord confirmation! Just A-Z a-z 0-9 '_' and arabic letters are valid.";
			}
			elseif($_POST['passc'] != $_POST['pass'])
			{
				$this->error_m['passc'] = "PassWord And PassWord confirmation does not match.";
			}
			else{
				$this->pass = $_POST['pass'];
			}
			
			
			//Gender validation
			if(!isset($_POST['gender']))
			{
				$this->error_m['gender'] = "Gender Not Set!";
			}
			elseif(!(trim($_POST['gender'])!='' AND $_POST['gender']!=null))
			{
				$this->error_m['gender'] = "Gender is blank!";
			}
			elseif(!(is_numeric($_POST['gender']) AND $_POST['gender']>=0 AND $_POST['gender']<=2))
			{
				$this->error_m['gender'] = "Gender must be Male, Female or other.";
			}
			else{
				$this->gender = $_POST['gender'];
			}
			
			
			//Newsletter validation
			if(!isset($_POST['newsletter']))
			{
				$this->error_m['newsletter'] = "Newsletter Not Set!";
			}
			elseif(!(trim($_POST['newsletter'])!='' AND $_POST['newsletter']!=null))
			{
				$this->error_m['newsletter'] = "Newsletter is blank!";
			}
			elseif(!(is_numeric($_POST['newsletter']) AND $_POST['newsletter']==1))
			{
				$this->error_m['newsletter'] = "Newsletter must be Male, Female or other.";
			}
			else{
				$this->newsletter = $_POST['newsletter'];
			}
			
			
			//Agreement validation
			if(!isset($_POST['agb']))
			{
				$this->error_m['agb'] = "Agreement Not Set!";
			}
			elseif(!(trim($_POST['agb'])!='' AND $_POST['agb']!=null))
			{
				$this->error_m['agb'] = "Agreement is blank!";
			}
			elseif(!(is_numeric($_POST['agb']) AND $_POST['agb']==1))
			{
				$this->error_m['agb'] = "Agreement mus be checked";
			}
			else{
				$this->agb = $_POST['agb'];
			}
			
			
			
			//company and newsletter not required
			$this->error_m['company'] = "";
			$this->error_m['newsletter'] = "";
			
			if($this->uname!='' AND $this->email!='' AND $this->fname!='' AND $this->lname!='' AND $this->pass!='')
			{
				if($this->gender>=0 AND $this->gender<=2 AND $this->agb==1)
				{
					$result = $model->getSignupResult($this->uname, $this->PassToHash($this->pass), $this->email, $this->fname, $this->lname, $this->company, $this->gender, $this->newsletter);
					
					if(isset($result) AND is_numeric($result) AND $result>0)
					{
						$this->error = false;
						$this->processed = true;
						
						$Mailer = new MailerClass();
						$subject = "BookingParcel Account Details";
						$content = "Hello dear ".$this->fname ." ". $this->lname .",<br><br>Thank you for registration in the Booking Parcel User Panel.<br><br>";
						$content .="<br>Your login details are as bellow :<br> UserName:".$this->uname."";
						$content .= "<br> PassWord:(******) <br> login address:<a href='http://cp.bookingparcel.com'>User Panel</a><br><br>";
						$content .= "Some of the options that using this panel gives you:<br>";
						$content .= "1. Ticketing system to be in touch with support and asking your questions<br>";
						$content .= "2. Easily tracking of your orders<br><br>";
						$content .= "<p>&nbsp;Europost Express (UK) Ltd.</p><p>Unit W13, Research House Business Centre,</p><p>&nbsp;Fraser Road , Perivale, Middlesex</p><p>&nbsp;UB6 7AQ- London , UK</p><p>&nbsp;www.europostexpress.co.uk</p><p>&nbsp;cargo@europostexpress.co.uk</p><p>&nbsp;Tel: +44(0) 208 5373286</p><p>&nbsp;Mobile: +44(0) 7886105417</p>";
						
						$Mailer->SendMail(array('email'=>'cargo@europostexpress.co.uk', 'name'=>'Booking Parcel User Panel Details'), array('email'=>$this->email, 'name'=>"".$this->fname ." ". $this->lname .""), $subject, $content);
					}
					else
					{
						$this->error_m['uname'] = "Something went wrong in our database!";
						
					}
				}
			}
			
			$model->dispose();
		}
    }

    

}

$p = new PView( );
$p->run( );
