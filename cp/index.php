<?php
require(__DIR__ ."". DIRECTORY_SEPARATOR ."Core". DIRECTORY_SEPARATOR ."boot.php");
require_once(MODEL_PATH."index.php");

class PView extends PageView
{
	public $error = null;
	public $error_m = array('uname'=>'', 'pass'=>'');
	
	
    public function PView( )
    {
        parent::PageView( );
		$this->active_page = "index";
        $this->viewFile = "index.phtml";
        
    }

    public function load( )
    {
        parent::load( );
		
		if($this->isPost()){
			$this->error = true;
			if(!(isset($_POST['uname']) AND $_POST['uname']!='' AND $_POST['uname']!=null)){
				$this->error_m['uname'] = "Invalid UserName.";
			}
			elseif(!(isset($_POST['password']) AND $_POST['password']!='' AND $_POST['password']!=null)){
				$this->error_m['pass'] = "Invalid password.";
			}else{
				$model = new IndexModel();
				if(!$model->UserExist($_POST['uname'])){
					$this->error_m['uname'] = "UserName not exist.";
				}
				elseif(!$model->IsPassOk($_POST['uname'], $_POST['password'])){
					$this->error_m['pass'] = "PassWord is not correct.";
				}
				else{
					$res = $model->getLoginResult($_POST['uname'], $_POST['password']);
					if($res["text"] == 'OK'){
						$this->error = false;
						$this->account = new Account();
						$this->account->uid = $res['uid'];
						$this->account->save();
						//$cookie->uname = $_POST['uname'];
						//$cookie->upwd = $_POST['password'];
						//$cookie->save();
						$model->dispose();
						$this->redirect("dashboard.php");
					}
					else{
						$this->error_m['uname'] = $res["text"];
					}
				}
			}
			$model->dispose();
		}
    }

    

}

$p = new PView( );
$p->run( );
