<?php
class View
{
	public $viewFile = NULL;
	public $layoutViewFile = NULL;

	public function printContent()
	{
		require(VIEW_PATH . $this->viewFile);
	}

	public function preRender()
	{
		
	}
	
	public function StringSafe($string){
		if(!preg_match("/^([a-z0-9\s\- _:.,،@؛?!؟[\]()*\/]|[پچجحخهعغفقثصضشسيبلاآتنمکگوئدذرزطظةيژی])+$/i",$string) || (strpos($string,'<')!==false || strpos($string,'>')!==false )){
			return false;
		}
		return true;
	}
	
	public function EmailFormatCheck($email){
		$regexp="/^[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}$/i";
		if ( !preg_match($regexp, $email) ) {
			return false;
		}
		return true;
	}
	
	public function URLValidator($url)
	{
		return filter_var($url, FILTER_VALIDATE_URL);
	}
	
	public function PassToHash($pass){
		$options = [
			'cost' => 10,
			//'salt' => $salt
		];
		return password_hash($pass, PASSWORD_BCRYPT, $options);
	}
	
	public function VerifyPassWord($pass, $hash){
		return password_verify ($pass, $hash);
	}
	
	public function GenderToText($gender){
		return ($gender ==0 ? "Male" : ($gender ==1 ? "Female" : "Other"));
	}
	public function PositionToText($position){
		return ($position ==0 ? "CEO" : ($position ==1 ? "CTO" : ($position ==2 ? "Sell-Man" : ($position ==3 ? "Director" : ($position ==4 ? "Manager" : ($position ==5 ? "Staff" : "Office Boy"))))));
	}
	
	public function run()
	{
		$this->load();
		$this->preRender();
		if ($this->layoutViewFile != NULL) {
			require(VIEW_PATH . $this->layoutViewFile);
		} else if ($this->viewFile != NULL) {
			require(VIEW_PATH . $this->viewFile);
		}
		$this->unload();
		unset($this);
	}
	
	public function redirect($url)
	{
		$this->unload();
		unset($this);
		header("location: " . $url);
		exit(0);
	}
	public function isPost()
	{
		return strtolower($_SERVER['REQUEST_METHOD']) == "post";
	}
}

class MyView extends View {
	var $title = '';
	var $active_page;
	var $meta;
	var $CoreConfig;
	var $account= NULL;
	function MyView() {
		$this->title = $GLOBALS['Config']['site']['title'];
		$this->meta = $GLOBALS['Config']['meta'];
		
		$this->CoreConfig = $GLOBALS['Config'];
		
		$session_timeout = $GLOBALS['Config']['other']['session_timeout'];// in minute(s)
		@ini_set ('session.gc_maxlifetime', $session_timeout * 60);// set the session timeout (in seconds) 
		@session_cache_expire ($session_timeout);// expiretime is the lifetime in minutes
		session_start ();
		$this->account = $this->convert2stdClass(Account::getInstance());
		//$this->account = Account::getInstance();
	}
	function convert2stdClass($object)
	{
		$serializedObj = serialize($object);
		$stdClassObj = preg_replace('/^O:\d+:"[^"]++"/', 'O:' . strlen('stdClass') . ':"stdClass"', $serializedObj);
		
		return unserialize( $stdClassObj );
	}

}

class ClientData
{
	public $uname = NULL;
	public $upwd = NULL;
	public $uiLang = NULL;
	public $showLevels = FALSE;

	public function ClientData()
	{
		
	}

	public static function getInstance()
	{
		$cookie = new ClientData();
		$key    = Account::getkey();
		
		if (isset($_COOKIE[$key])) {
			$obj = unserialize(base64_decode($_COOKIE[$key]));
			if ($obj != NULL && is_a($obj, "ClientData")) {
				$cookie->uname = $obj->uname;
				$cookie->upwd  = $obj->upwd;
			}
		}
		return $cookie;
	}

	public function save()
	{
		setcookie(Account::getkey(), base64_encode(serialize($this)), time() + 5 * 12 * 30 * 24 * 3600);
	}

	public function clear()
	{
		$this->uname = "";
		$this->upwd  = "";
		setcookie(Account::getkey());
	}

}
class Account
{
	public $uid = NULL;
	
	public static function getDomain()
	{
		$surl  = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		$surl  = preg_replace("/^(www\\.)/", "", $surl);
		$arr   = explode("/", $surl);
		$count = sizeof($arr) - 1;
		if (0 < $count) {
			$surl = "";
			$i    = 0;
			while ($i < $count) {
				$surl .= $arr[$i] . "/";
				++$i;
			}
		}
		return strtolower($surl);
	}
	public static function getKey()
	{
		return md5(Account::getdomain());
	}

	public static function getInstance()
	{
		$key = Account::getkey();
		return isset($_SESSION[$key]) ? $_SESSION[$key] : NULL;
	}

	public function save()
	{
		$_SESSION[Account::getkey()] = $this;
	}

	public function logout()
	{
		$_SESSION[Account::getkey()] = NULL;
		unset($_SESSION);
		session_destroy();
	}

}

class PageView extends MyView {
	var $contentCssClass = '';
	var $newsText;
	var $ToSText;
	var $globalModel;

	function PageView() {
		parent::MyView();

		$this->layoutViewFile = 'layout' . DIRECTORY_SEPARATOR . 'form.phtml';
		$this->globalModel = new Model();
	}

	function load() {
		$this->ToSText =  $this->globalModel->getSiteToS();
		$this->newsText =  $this->globalModel->getSiteNews();
	}

	function unload() {
		if ($this->globalModel != NULL) {
			$this->globalModel->dispose();
		}
	}
}

class SecurePage extends PageView {
	var $customLogoutAction = FALSE;
	var $newsText;
	var $ToSText;
	var $data;

	function SecurePage() {
		parent::PageView();

		$this->layoutViewFile = 'layout' . DIRECTORY_SEPARATOR . 'inner.phtml';

		if ($this->account == NULL) {
			if (!$this->customLogoutAction) {
				$this->redirect('index.php');
			}
			return;
		}

	}
	
	function load()
	{
		$this->ToSText =  $this->globalModel->getSiteToS();
		$this->newsText =  $this->globalModel->getSiteNews();
		$this->data = $this->globalModel->GetBasicData($this->account->uid);
		if ($this->data == NULL) {
			$this->account->logout(); 
			$this->redirect('index.php'); return;
		}	
	}

}