<?php

class GoogleCurrencyConvertor{
    private $rate="";
    private $reverseRate="";

	
    public function __construct($amount, $currFrom, $currInto){
        if (trim($amount)=="" ||!is_numeric($amount)) {
            trigger_error("Please enter a valid amount",E_USER_ERROR);         	
        }
        $return=array();
        //$gurl = "http://www.google.com/finance/converter?a=$amount&from=$currFrom&to=$currInto"; 
        $gurl = "https://finance.google.com/finance/converter?a=$amount&from=$currFrom&to=$currInto"; 
        $html=$this->getHtmlCodeViaFopen($gurl);
		$regularExpression='#\<span class=bld\>(.+?)\<\/span\>#s';
		preg_match($regularExpression, $html, $return);
        if (isset($return[0])) {
            $rate=strip_tags($return[0]);
			
            $tmp=explode(" ",$rate);
            $rate=$tmp[0];		
	    if($currInto == 'GBP') $rate += 0.05;
	    if($currInto == 'EUR') $rate += 0.03;
	    $this->rate=$rate;	
            
            $this->reverseRate=1/$this->rate;
        }
        else {
            $this->rate=$this->reverseRate="Google could not convert your request. Please try again.";
        }
    }
    
    private function getIntegers($str){
        $ret="";
        $str=trim($str);       
        for ($i=0;$i<strlen($str);$i++){
            $code=ord($str[$i]);
            if( ($code>47 && $code<58) || $code==46) {
               $ret.=$str[$i];        	
            }
        }
        return $ret;
    }
    
    function getHtmlCodeViaFopen($url){
		$request = curl_init(); 
		$timeOut = 0; 
		curl_setopt ($request, CURLOPT_URL, $url); 
		curl_setopt ($request, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt ($request, CURLOPT_USERAGENT,"Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)"); 
		curl_setopt ($request, CURLOPT_CONNECTTIMEOUT, $timeOut); 
		$response = curl_exec($request); 
		curl_close($request); 
		return $response;
    }

    function getRate(){
        return $this->rate;
    }

    function getReverseRate(){
        return $this->reverseRate;
    }
}
?>