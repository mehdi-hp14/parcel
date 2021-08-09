<?php
require_once("GoogleCurrencyConvertor.inc.php");
$googleCurrencyConvertor = new GoogleCurrencyConvertor("1","EUR","GBP");
echo "Rate: ".$googleCurrencyConvertor->getRate();
echo "<br />Reverse Rate: ".$googleCurrencyConvertor->getReverseRate();
echo "<br>";
$googleCurrencyConvertor2 = new GoogleCurrencyConvertor("1","USD","GBP");
echo "Rate: ".$googleCurrencyConvertor2 ->getRate();
echo "<br />Reverse Rate: ".$googleCurrencyConvertor2 ->getReverseRate();
echo "<br>";
$googleCurrencyConvertor2 = new GoogleCurrencyConvertor("1","IRR","GBP");
echo "Rate: ".$googleCurrencyConvertor2 ->getRate();
echo "<br />Reverse Rate: ".$googleCurrencyConvertor2 ->getReverseRate();
?>