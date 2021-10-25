<?php

define( "ROOT_PATH", realpath( dirname( __FILE__ )  ).DIRECTORY_SEPARATOR );
define( "LIB_PATH", ROOT_PATH."lib".DIRECTORY_SEPARATOR );

require_once(LIB_PATH . "GoogleCurrencyConvertor.inc.php");

function GetOfferPriceFromReceive($rprice, $currency="EUR", $tocurrency="GBP",$extra_c=0,$percent=0)
{
	$rprice = str_replace(",","",$rprice);
	
	$extra = 0;
	echo "rprice : ".$rprice ."<br>";
	echo "extra : ".$extra ."<br>";
	if($currency=='EUR' OR $currency=='USD')
	{
		$tmp = (int)$rprice;
    	echo "tmp : ".$tmp ."<br>";
		if($tmp>0 AND $tmp<=300)
		{
			$extra = 120;
		}
		elseif($tmp<=600)
		{
			$extra = 160;
		}
		elseif($tmp<=1000)
		{
			$extra = 200;
		}
		elseif($tmp<=1400)
		{
			$extra = 250;
		}
		elseif($tmp<=1800)
		{
			$extra = 300;
		}
		elseif($tmp<=2300)
		{
			$extra = 400;
		}
		elseif($tmp<=2600)
		{
			$extra = 500;
		}
		elseif($tmp<=2900)
		{
			$extra = 600;
		}
		elseif($tmp<=4000)
		{
			$extra = 800;
		}
		elseif($tmp<=6000)
		{
			$extra = 1000;
		}
		elseif($tmp<=8000)
		{
			$extra = 1200;
		}
		elseif($tmp<=10000)
		{
			$extra = 1400;
		}
		elseif($tmp<=12000)
		{
			$extra = 1600;
		}
		elseif($tmp<=14000)
		{
			$extra = 1800;
		}
		elseif($tmp<=16000)
		{
			$extra = 2000;
		}
		elseif($tmp<=18000)
		{
			$extra = 2200;
		}
		elseif($tmp<=20000)
		{
			$extra = 2400;
		}
		elseif($tmp<=22000)
		{
			$extra = 2600;
		}
		elseif($tmp<=24000)
		{
			$extra = 2800;
		}
		elseif($tmp<=26000)
		{
			$extra = 3000;
		}
		elseif($tmp<=28000)
		{
			$extra = 3200;
		}
		elseif($tmp<=30000)
		{
			$extra = 3400;
		}
		
		
		if($currency=='USD')
		{
			$extra += 20;
		}
		elseif($currency=='EUR')
		{
			$extra += 5;
		}
		
    	echo "rprice : ".$rprice ."<br>";
    	echo "extra : ".$extra ."<br>";
    	echo "tmp : ".$tmp ."<br>";
    	echo "here<br>";
		$googleCurrencyConvertor = new GoogleCurrencyConvertor("1",$currency,$tocurrency);
    	//echo "googleCurrencyConvertor : ".$googleCurrencyConvertor ."<br>";
		$rate = $googleCurrencyConvertor->getRate();
    	echo "rate  : ".$rate  ."<br>";
		$rprice = ceil($rprice * $rate);
    	echo "frprice : ".$rprice ."<br>";
		
		
		$temp = 1 + ($percent / 100);
		$rprice *= $temp;
	}
	
	
	
    	echo "rprice : ".$rprice ."<br>";
    	echo "extra : ".$extra ."<br>";
    	echo "tmp : ".$tmp ."<br>";
	return ceil($rprice + $extra + $extra_c);
}


echo GetOfferPriceFromReceive(148.15, "USD", "GBP",$extra_c=0,$percent=0);