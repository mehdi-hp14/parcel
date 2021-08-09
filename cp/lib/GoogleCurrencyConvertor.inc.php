<?php

class GoogleCurrencyConvertor{
    private $rate="";
    private $reverseRate="";
	private $AppID = "e9f89b6a9eea45deb4368f34552955e0";
	
    public function __construct($amount, $currFrom, $currInto){
        if (trim($amount)=="" ||!is_numeric($amount)) {
            trigger_error("Please enter a valid amount",E_USER_ERROR);         	
        }
        $return=array();
		
		$gurl = "https://openexchangerates.org/api/latest.json?app_id=".$this->AppID."&base=".$currFrom;
		//echo $gurl."<br>";
		$response = json_decode(file_get_contents($gurl));
		$rate = $response->rates->$currInto;
		
		
		
		
	    if($currInto == 'GBP') $rate += 0.05;
	    if($currInto == 'EUR') $rate += 0.03;
	    $this->rate=$rate;	
            
        $this->reverseRate=1/$this->rate;
    }
    

    function getRate(){
        return $this->rate;
    }

    function getReverseRate(){
        return $this->reverseRate;
    }
}
?>