<?php
require(__DIR__ ."". DIRECTORY_SEPARATOR ."Core". DIRECTORY_SEPARATOR ."boot.php");
require_once(MODEL_PATH."order.php");
require_once(APP_PATH."Mailer.php");

class PView extends SecurePage
{

	public $show_inbox = true;
	public $page = 1;
	public $items_per_page = 30;
	public $total_Res = 0;
	public $total_Page = 0;
	public $Order_info = null;
	public $financial_info = null;
	public $oid = null;
	
	public $shipping_info = null;
	
	public $action_status = false;
	public $action_m = "";
	public $country_iso = array(
		'Afghanistan'=>'AFG',
		'Aland Islands'=>'ALA',
		'Albania'=>'ALB',
		'Algeria'=>'DZA',
		'American Samoa'=>'ASM',
		'Andorra'=>'AND',
		'Angola'=>'AGO',
		'Anguilla'=>'AIA',
		'Antarctica'=>'ATA',
		'Antigua and Barbuda'=>'ATG',
		'Argentina'=>'ARG',
		'Armenia'=>'ARM',
		'Aruba'=>'ABW',
		'Australia'=>'AUS',
		'Austria'=>'AUT',
		'Azerbaijan'=>'AZE',
		'Bahamas'=>'BHS',
		'Bahrain'=>'BHR',
		'Bangladesh'=>'BGD',
		'Barbados'=>'BRB',
		'Belarus'=>'BLR',
		'Belgium'=>'BEL',
		'Belize'=>'BLZ',
		'Benin'=>'BEN',
		'Bermuda'=>'BMU',
		'Bhutan'=>'BTN',
		'Bolivia'=>'BOL',
		'Bonaire, Saint Eustatius and Saba '=>'BES',
		'Bosnia and Herzegovina'=>'BIH',
		'Botswana'=>'BWA',
		'Bouvet Island'=>'BVT',
		'Brazil'=>'BRA',
		'British Indian Ocean Territory'=>'IOT',
		'British Virgin Islands'=>'VGB',
		'Brunei'=>'BRN',
		'Bulgaria'=>'BGR',
		'Burkina Faso'=>'BFA',
		'Burundi'=>'BDI',
		'Cambodia'=>'KHM',
		'Cameroon'=>'CMR',
		'Canada'=>'CAN',
		'Cape Verde'=>'CPV',
		'Cayman Islands'=>'CYM',
		'Central African Republic'=>'CAF',
		'Chad'=>'TCD',
		'Chile'=>'CHL',
		'China'=>'CHN',
		'Christmas Island'=>'CXR',
		'Cocos Islands'=>'CCK',
		'Colombia'=>'COL',
		'Comoros'=>'COM',
		'Cook Islands'=>'COK',
		'Costa Rica'=>'CRI',
		'Croatia'=>'HRV',
		'Cuba'=>'CUB',
		'Curacao'=>'CUW',
		'Cyprus'=>'CYP',
		'Czech Republic'=>'CZE',
		'Democratic Republic of the Congo'=>'COD',
		'Denmark'=>'DNK',
		'Djibouti'=>'DJI',
		'Dominica'=>'DMA',
		'Dominican Republic'=>'DOM',
		'East Timor'=>'TLS',
		'Ecuador'=>'ECU',
		'Egypt'=>'EGY',
		'El Salvador'=>'SLV',
		'Equatorial Guinea'=>'GNQ',
		'Eritrea'=>'ERI',
		'Estonia'=>'EST',
		'Ethiopia'=>'ETH',
		'Falkland Islands'=>'FLK',
		'Faroe Islands'=>'FRO',
		'Fiji'=>'FJI',
		'Finland'=>'FIN',
		'France'=>'FRA',
		'French Guiana'=>'GUF',
		'French Polynesia'=>'PYF',
		'French Southern Territories'=>'ATF',
		'Gabon'=>'GAB',
		'Gambia'=>'GMB',
		'Georgia'=>'GEO',
		'Germany'=>'DEU',
		'Ghana'=>'GHA',
		'Gibraltar'=>'GIB',
		'Greece'=>'GRC',
		'Greenland'=>'GRL',
		'Grenada'=>'GRD',
		'Guadeloupe'=>'GLP',
		'Guam'=>'GUM',
		'Guatemala'=>'GTM',
		'Guernsey'=>'GGY',
		'Guinea'=>'GIN',
		'Guinea-Bissau'=>'GNB',
		'Guyana'=>'GUY',
		'Haiti'=>'HTI',
		'Heard Island and McDonald Islands'=>'HMD',
		'Honduras'=>'HND',
		'Hong Kong'=>'HKG',
		'Hungary'=>'HUN',
		'Iceland'=>'ISL',
		'India'=>'IND',
		'Indonesia'=>'IDN',
		'Iran'=>'IRN',
		'Iraq'=>'IRQ',
		'Ireland'=>'IRL',
		'Isle of Man'=>'IMN',
		'Israel'=>'ISR',
		'Italy'=>'ITA',
		'Ivory Coast'=>'CIV',
		'Jamaica'=>'JAM',
		'Japan'=>'JPN',
		'Jersey'=>'JEY',
		'Jordan'=>'JOR',
		'Kazakhstan'=>'KAZ',
		'Kenya'=>'KEN',
		'Kiribati'=>'KIR',
		'Kosovo'=>'XKX',
		'Kuwait'=>'KWT',
		'Kyrgyzstan'=>'KGZ',
		'Laos'=>'LAO',
		'Latvia'=>'LVA',
		'Lebanon'=>'LBN',
		'Lesotho'=>'LSO',
		'Liberia'=>'LBR',
		'Libya'=>'LBY',
		'Liechtenstein'=>'LIE',
		'Lithuania'=>'LTU',
		'Luxembourg'=>'LUX',
		'Macao'=>'MAC',
		'Macedonia'=>'MKD',
		'Madagascar'=>'MDG',
		'Malawi'=>'MWI',
		'Malaysia'=>'MYS',
		'Maldives'=>'MDV',
		'Mali'=>'MLI',
		'Malta'=>'MLT',
		'Marshall Islands'=>'MHL',
		'Martinique'=>'MTQ',
		'Mauritania'=>'MRT',
		'Mauritius'=>'MUS',
		'Mayotte'=>'MYT',
		'Mexico'=>'MEX',
		'Micronesia'=>'FSM',
		'Moldova'=>'MDA',
		'Monaco'=>'MCO',
		'Mongolia'=>'MNG',
		'Montenegro'=>'MNE',
		'Montserrat'=>'MSR',
		'Morocco'=>'MAR',
		'Mozambique'=>'MOZ',
		'Myanmar'=>'MMR',
		'Namibia'=>'NAM',
		'Nauru'=>'NRU',
		'Nepal'=>'NPL',
		'Netherlands'=>'NLD',
		'New Caledonia'=>'NCL',
		'New Zealand'=>'NZL',
		'Nicaragua'=>'NIC',
		'Niger'=>'NER',
		'Nigeria'=>'NGA',
		'Niue'=>'NIU',
		'Norfolk Island'=>'NFK',
		'North Korea'=>'PRK',
		'Northern Mariana Islands'=>'MNP',
		'Norway'=>'NOR',
		'Oman'=>'OMN',
		'Pakistan'=>'PAK',
		'Palau'=>'PLW',
		'Palestinian Territory'=>'PSE',
		'Panama'=>'PAN',
		'Papua New Guinea'=>'PNG',
		'Paraguay'=>'PRY',
		'Peru'=>'PER',
		'Philippines'=>'PHL',
		'Pitcairn'=>'PCN',
		'Poland'=>'POL',
		'Portugal'=>'PRT',
		'Puerto Rico'=>'PRI',
		'Qatar'=>'QAT',
		'Republic of the Congo'=>'COG',
		'Reunion'=>'REU',
		'Romania'=>'ROU',
		'Russia'=>'RUS',
		'Rwanda'=>'RWA',
		'Saint Barthelemy'=>'BLM',
		'Saint Helena'=>'SHN',
		'Saint Kitts and Nevis'=>'KNA',
		'Saint Lucia'=>'LCA',
		'Saint Martin'=>'MAF',
		'Saint Pierre and Miquelon'=>'SPM',
		'Saint Vincent and the Grenadines'=>'VCT',
		'Samoa'=>'WSM',
		'San Marino'=>'SMR',
		'Sao Tome and Principe'=>'STP',
		'Saudi Arabia'=>'SAU',
		'Senegal'=>'SEN',
		'Serbia'=>'SRB',
		'Seychelles'=>'SYC',
		'Sierra Leone'=>'SLE',
		'Singapore'=>'SGP',
		'Sint Maarten'=>'SXM',
		'Slovakia'=>'SVK',
		'Slovenia'=>'SVN',
		'Solomon Islands'=>'SLB',
		'Somalia'=>'SOM',
		'South Africa'=>'ZAF',
		'South Georgia and the South Sandwich Islands'=>'SGS',
		'South Korea'=>'KOR',
		'South Sudan'=>'SSD',
		'Spain'=>'ESP',
		'Sri Lanka'=>'LKA',
		'Sudan'=>'SDN',
		'Suriname'=>'SUR',
		'Svalbard and Jan Mayen'=>'SJM',
		'Swaziland'=>'SWZ',
		'Sweden'=>'SWE',
		'Switzerland'=>'CHE',
		'Syria'=>'SYR',
		'Taiwan'=>'TWN',
		'Tajikistan'=>'TJK',
		'Tanzania'=>'TZA',
		'Thailand'=>'THA',
		'Togo'=>'TGO',
		'Tokelau'=>'TKL',
		'Tonga'=>'TON',
		'Trinidad and Tobago'=>'TTO',
		'Tunisia'=>'TUN',
		'Turkey'=>'TUR',
		'Turkmenistan'=>'TKM',
		'Turks and Caicos Islands'=>'TCA',
		'Tuvalu'=>'TUV',
		'U.S. Virgin Islands'=>'VIR',
		'Uganda'=>'UGA',
		'Ukraine'=>'UKR',
		'United Arab Emirates'=>'ARE',
		'United Kingdom'=>'GBR',
		'United States'=>'USA',
		'United States Minor Outlying Islands'=>'UMI',
		'Uruguay'=>'URY',
		'Uzbekistan'=>'UZB',
		'Vanuatu'=>'VUT',
		'Vatican'=>'VAT',
		'Venezuela'=>'VEN',
		'Vietnam'=>'VNM',
		'Wallis and Futuna'=>'WLF',
		'Western Sahara'=>'ESH',
		'Yemen'=>'YEM',
		'Zambia'=>'ZMB',
		'Zimbabwe'=>'ZWE',
		'Test Country'=>'TSTC'
	);
	/*
	inputSCName:
	inputSCPName:
	inputSeMail:
	inputSPhone:
	inputScountry:Test Country
	inputSZipCode:
	Sender:
	inputRCName:
	inputRCPName:
	inputReMail:
	inputRPhone:
	inputRcountry:United Kingdom
	inputRZipCode:
	Receiver:
	*/
	
	
	public $inputSCName = null;
	public $inputSCPName = null;
	public $inputSeMail = null;
	public $inputSPhone = null;
	public $inputScountry = null;
	public $inputSZipCode = null;
	public $Sender = null;
	public $inputRCName = null;
	public $inputRCPName = null;
	public $inputReMail = null;
	public $inputRPhone = null;
	public $inputRcountry = null;
	public $inputRZipCode = null;
	public $Receiver = null;
	public $conf_p = null;
	
	public $error = false;
	public $error_m = "";
	
    public function __construct( )
    {
        parent::__construct( );
		$this->active_page = "orders";
        $this->viewFile = "order.phtml";
        
    }

    public function load( )
    {
        parent::load( );
       
       
		if(isset($_GET['oid']) AND is_numeric($_GET['oid']) AND $_GET['oid']>0)
		{
			$this->oid = $_GET['oid'];
		}
		elseif(isset($_GET['neworder']) AND $_GET['neworder']=='true')
		{
			$this->show_inbox = false;
			$this->show_new = true;
		}
		
		if(isset($this->oid) AND $this->oid!=null)
		{
			$this->show_inbox = false;
		}
	   
	   
		$m = new OrderModel();
		if($this->show_inbox)
		{
			if(isset($_GET['page']) AND is_numeric($_GET['page']) AND $_GET['page']>1)
			{
				$this->page = $_GET['page'];
			}
			$this->inbox_info = $m->GetOrders($this->data['uname'], $this->page, $this->items_per_page);
		   
		   
			$this->total_Res = $m->GetTotalOrdersCount($this->data['uname']);
			$this->total_Page = ceil($this->total_Res / $this->items_per_page);
			
		}
		elseif(isset($this->oid) AND $this->oid!=null)
		{
			$this->Order_info = $m->GetOrderByID($this->data['uname'], $this->oid);
			if($this->isPost())
			{
				$this->error = true;
			   
				if(!isset($_POST['inputSCName']))
				{
				   $this->error_m .= "Sender Company Name is required.<br>";
				}
				elseif(!(trim($_POST['inputSCName'])!='' AND $_POST['inputSCName']!=null))
				{
					$this->error_m .= "Sender Company Name is blank!";
				}
				elseif(!$this->StringSafe($_POST['inputSCName']) AND false)
				{
					$this->error_m .= "Invalid characters used in Sender Company Name! Just A-Z a-z 0-9 '_' and arabic letters are valid.";
				}
				else
				{
					$this->inputSCName = $_POST['inputSCName'];
				}
				
				if(!isset($_POST['inputSCPName']))
				{
				   $this->error_m .= "Sender Contact Person Name is required.<br>";
				}
				elseif(!(trim($_POST['inputSCPName'])!='' AND $_POST['inputSCPName']!=null))
				{
					$this->error_m .= "Sender Contact Person Name is blank!";
				}
				elseif(!$this->StringSafe($_POST['inputSCPName']) AND false)
				{
					$this->error_m .= "Invalid characters used in Sender Contact Person Name! Just A-Z a-z 0-9 '_' and arabic letters are valid.";
				}
				else
				{
					$this->inputSCPName = $_POST['inputSCPName'];
				}
				
				$this->inputSeMail = "";
				if(!isset($_POST['inputSeMail']))
				{
				   //$this->error_m .= "Sender E-mail is required.<br>";
				}
				elseif(!(trim($_POST['inputSeMail'])!='' AND $_POST['inputSeMail']!=null))
				{
					$this->error_m .= "Sender E-mail is blank!";
				}
				elseif(!$this->EmailFormatCheck($_POST['inputSeMail']) AND false)
				{
					$this->error_m .= "Invalid characters used in Sender E-mail!";
				}
				else
				{
					$this->inputSeMail = $_POST['inputSeMail'];
				}
				
				if(!isset($_POST['inputSPhone']))
				{
				   $this->error_m .= "Sender Phone is required.<br>";
				}
				elseif(!(trim($_POST['inputSPhone'])!='' AND $_POST['inputSPhone']!=null))
				{
					$this->error_m .= "Sender Phone is blank!";
				}
				elseif(!$this->StringSafe($_POST['inputSPhone']) AND false)
				{
					$this->error_m .= "Invalid characters used in Sender Phone!";
				}
				else
				{
					$this->inputSPhone = $_POST['inputSPhone'];
				}
				
				if(!isset($_POST['inputScountry']))
				{
				   $this->error_m .= "Sender Country is required.<br>";
				}
				elseif(!(trim($_POST['inputScountry'])!='' AND $_POST['inputScountry']!=null))
				{
					$this->error_m .= "Sender Country is blank!";
				}
				elseif(!array_key_exists($_POST['inputScountry'], $this->country_iso))
				{
					$this->error_m .= "Invalid characters used in Sender Country!";
				}
				else
				{
					$this->inputScountry = $_POST['inputScountry'];
				}
				
				if(!isset($_POST['inputSZipCode']))
				{
				   $this->error_m .= "Sender Zipcode is required.<br>";
				}
				elseif(!(trim($_POST['inputSZipCode'])!='' AND $_POST['inputSZipCode']!=null))
				{
					$this->error_m .= "Sender Zipcode is blank!";
				}
				elseif(!$this->StringSafe($_POST['inputSZipCode']) AND false)
				{
					$this->error_m .= "Invalid characters used in Sender Zipcode!";
				}
				else
				{
					$this->inputSZipCode = $_POST['inputSZipCode'];
				}
				
				if(!isset($_POST['Sender']))
				{
				   $this->error_m .= "Sender Address is required.<br>";
				}
				elseif(!(trim($_POST['Sender'])!='' AND $_POST['Sender']!=null))
				{
					$this->error_m .= "Sender Address is blank!";
				}
				elseif(!$this->StringSafe($_POST['Sender']) AND false)
				{
					$this->error_m .= "Invalid characters used in Sender Address!";
				}
				else
				{
					$this->Sender = $_POST['Sender'];
				}
			   
				if(!isset($_POST['inputRCName']))
				{
				   $this->error_m .= "Receiver Company Name is required.<br>";
				}
				elseif(!(trim($_POST['inputRCName'])!='' AND $_POST['inputRCName']!=null))
				{
					$this->error_m .= "Receiver Company Name is blank!";
				}
				elseif(!$this->StringSafe($_POST['inputRCName']) AND false)
				{
					$this->error_m .= "Invalid characters used in Receiver Company Name! Just A-Z a-z 0-9 '_' and arabic letters are valid.";
				}
				else
				{
					$this->inputRCName = $_POST['inputRCName'];
				}
				
				if(!isset($_POST['inputRCPName']))
				{
				   $this->error_m .= "Receiver Contact Person Name is required.<br>";
				}
				elseif(!(trim($_POST['inputRCPName'])!='' AND $_POST['inputRCPName']!=null))
				{
					$this->error_m .= "Receiver Contact Person Name is blank!";
				}
				elseif(!$this->StringSafe($_POST['inputRCPName']) AND false)
				{
					$this->error_m .= "Invalid characters used in Receiver Contact Person Name! Just A-Z a-z 0-9 '_' and arabic letters are valid.";
				}
				else
				{
					$this->inputRCPName = $_POST['inputRCPName'];
				}
				
				$this->inputReMail = "";
				if(!isset($_POST['inputReMail']))
				{
				   //$this->error_m .= "Receiver E-mail is required.<br>";
				}
				elseif(!(trim($_POST['inputReMail'])!='' AND $_POST['inputReMail']!=null))
				{
					$this->error_m .= "Receiver E-mail is blank!";
				}
				elseif(!$this->EmailFormatCheck($_POST['inputReMail']) AND false)
				{
					$this->error_m .= "Invalid characters used in Receiver E-mail!";
				}
				else
				{
					$this->inputReMail = $_POST['inputReMail'];
				}
				
				if(isset($_POST['inputRPhone']))
				{
					if(!(trim($_POST['inputRPhone'])!='' AND $_POST['inputRPhone']!=null))
					{
						$this->error_m .= "Receiver Phone is blank!";
					}
					elseif(!$this->StringSafe($_POST['inputRPhone']) AND false)
					{
						$this->error_m .= "Invalid characters used in Receiver Phone!";
					}
					else
					{
						$this->inputRPhone = $_POST['inputRPhone'];
					}
				}
				else
				{
					$this->inputRPhone = '';
				}
				
				if(!isset($_POST['inputRcountry']))
				{
				   $this->error_m .= "Receiver Country is required.<br>";
				}
				elseif(!(trim($_POST['inputRcountry'])!='' AND $_POST['inputRcountry']!=null))
				{
					$this->error_m .= "Receiver Country is blank!";
				}
				elseif(!array_key_exists($_POST['inputRcountry'], $this->country_iso))
				{
					$this->error_m .= "Invalid characters used in Receiver Country!";
				}
				else
				{
					$this->inputRcountry = $_POST['inputRcountry'];
				}
				
				if(isset($_POST['inputRZipCode']))
				{
					if(!(trim($_POST['inputRZipCode'])!='' AND $_POST['inputRZipCode']!=null))
					{
						$this->error_m .= "Receiver Zipcode is blank!";
					}
					elseif(!$this->StringSafe($_POST['inputRZipCode']) AND false)
					{
						$this->error_m .= "Invalid characters used in Receiver Zipcode!";
					}
					else
					{
						$this->inputRZipCode = $_POST['inputRZipCode'];
					}
				}
				else
				{
					$this->inputRZipCode = '';
				}
				
				
				if(!isset($_POST['Receiver']))
				{
				   $this->error_m .= "Receiver Address is required.<br>";
				}
				elseif(!(trim($_POST['Receiver'])!='' AND $_POST['Receiver']!=null))
				{
					$this->error_m .= "Receiver Address is blank!";
				}
				elseif(!$this->StringSafe($_POST['Receiver']) AND false)
				{
					$this->error_m .= "Invalid characters used in Receiver Address!";
				}
				else
				{
					$this->Receiver = $_POST['Receiver'];
				}
			   
				if(!isset($_POST['conf_p']))
				{
				   $this->error_m .= "Prices is required.<br>";
				}
				elseif(!(trim($_POST['conf_p'])!='' AND $_POST['conf_p']!=null))
				{
					$this->error_m .= "Price is blank!";
				}
				elseif(!$this->StringSafe($_POST['conf_p']) AND false)
				{
					$this->error_m .= "Invalid characters used in Price! Just A-Z a-z 0-9 '_' and arabic letters are valid.";
				}
				else
				{
					$prices = explode(" | ",$this->Order_info['offered_p']);
					foreach($prices as $k=>$v){
						if($v!=''){
							$tmp = explode(") ",$v);
							$ttmp = explode("=>",$tmp[1]);
							$confirmed = false;
							if($ttmp[0]=='on')
							{
								$confirmed = true;
								break;
							}
						}
					}
					if(!$confirmed)
					{
						$tmp1 = '';
						$tmp4 = '';
						$currency = "";
						$price = "";
						foreach($prices as $k=>$v){
							if($v!=''){
								$tmp = explode(") ",$v);
								$ttmp = explode("=>",$tmp[1]);
								$tmp4 .= ($_c +1).') '.((($_POST['conf_p']=="".$ttmp[2]."_".$ttmp[3]."_".$ttmp[1]."")) ? 'on' : 'off').'=>'.$ttmp[1].'=>'.number_format(str_replace(",","",$ttmp[2]),2).'=>'.$ttmp[3].' | ';
								$_c++;
								if($_POST['conf_p']=="".$ttmp[2]."_".$ttmp[3]."_".$ttmp[1]."")
								{
									$tmp1 = "".$ttmp[2]." ".$ttmp[3]." by ".$ttmp[1]."";
									$price = $ttmp[2];
									$currency = $ttmp[3];
								}
							}
						}
						$this->conf_p = $tmp4;
					}
					else{
						$this->error_m .= "confirmed already.";
					}
				}
				if(!($this->data[$currency.'_current_balance'] >= $price OR $this->data['mdp']==1)) $this->error_m .= "You do not have enough deposit.<br>";
				$config = json_decode(file_get_contents(dirname(dirname(__FILE__))."/admin/conf.json"));
				$price = str_replace(",","",$price);
				
				if($this->inputSCName!=null AND $this->inputSCPName!=null AND $this->inputSPhone!=null AND $this->inputScountry!=null AND 
				$this->inputSZipCode!=null AND $this->Sender!=null AND $this->inputRCName!=null AND $this->inputRCPName!=null AND 
				$this->inputRcountry!=null AND $this->Receiver!=null AND $this->conf_p!=null AND $config==true AND ($this->data[$currency.'_current_balance'] >= $price OR $this->data['mdp']==1))
				{
					
					if($this->inputRZipCode==null) $this->inputRZipCode="";
					if($this->inputRPhone==null) $this->inputRPhone="";
					if($this->inputReMail==null) $this->inputReMail="";
					$this->error = false;
					$iii = $m->InsertShipInfo($this->oid, $this->inputSCName, $this->inputSCPName, $this->inputSeMail, $this->inputSPhone, $this->inputScountry, $this->inputSZipCode, $this->Sender, $this->inputRCName, $this->inputRCPName, $this->inputReMail, $this->inputRPhone, $this->inputRcountry, $this->inputRZipCode, $this->Receiver);
					
					//echo $this->data[$currency.'_current_balance']."<b>";
					//echo $price."<b>";
					if(!(is_numeric($iii) AND $iii>0))
					{
						$this->error = true;
						$this->error_m .= "<br>Nothing saved! Please do not use special characters in the fields such as +#$%^&*()!;'\"";
					}
					else if($this->data[$currency.'_current_balance'] < $price AND $this->data['mdp']==1){
						$m->SetAsConfirmed($this->oid);
						$m->ConfirmOrder($this->oid, $this->conf_p);
						if($price!='' AND $currency!='')
						{
							//$m->ReportForDeposite($this->oid, $this->data['id'], $price, $currency);
							$mailer = new MailerClass();
							$subject = "User confirmed a price for order ".$this->Order_info['tid'];
							$body = "Order : ".$this->Order_info['tid']."<br>The confirmed price and method : ".$tmp1."<br>";
							$body .= "Sender ( Collection ) Information <span style=\"color:#ff0000;\">( Also for HAWB)</span>:<br>";
							$body .= "Company : ".$this->inputSCName ."<br>";
							$body .= "Contact Person Name : ".$this->inputSCPName ."<br>";
							$body .= "E-mail : ".$this->inputSeMail ."<br>";
							$body .= "Telephone : ".$this->inputSPhone ."<br>";
							$body .= "Country : ".$this->inputScountry ."<br>";
							$body .= "Zip Code : ".$this->inputSZipCode ."<br>";
							$body .= "Address : ".$this->Sender ."<br><br><br>";
							$body .= "Receiver ( Delivery ) Information <span style=\"color:#ff0000;\">( Also for HAWB)</span>:<br>";
							$body .= "Company : ".$this->inputRCName ."<br>";
							$body .= "Contact Person Name : ".$this->inputRCPName ."<br>";
							$body .= "E-mail : ".$this->inputReMail ."<br>";
							$body .= "Telephone : ".$this->inputRPhone ."<br>";
							$body .= "Country : ".$this->inputRcountry ."<br>";
							$body .= "Zip Code : ".$this->inputRZipCode ."<br>";
							$body .= "Address : ".$this->Receiver ."<br>";
						
							$body .= "<br><br>You did not have enough deposit so the order is just confirmed and waiting for payment.<br>";
						
							$body = "<table cellpadding='5' cellspacing='1' style='margin-left:auto;margin-right:auto;width:100%;border:0px;font-family:tahoma;font-size:12px;direction:ltr;border:thin solid #777;'>
	 <tr>
	  <td style='background-color:#ffcc33;text-align:left;font-weight:bold;color:#ff3333;' width='80%'>
	  </td>
	 <td width='20%' bgcolor=\"#ffffff\" align=\"right\" valign=\"top\" style=\"background-color:#ffffff;text-align:left;font-weight:bold;color:#ff3333;padding:10px 25px 20px 0px\">
		<a href=\"http://bookingparcel.com/\" target=\"_blank\" rel=\"noreferrer\"><img src=\"http://bookingparcel.com/europost_logo.gif\" alt=\"EuropostExpress\" width=\"237\" height=\"56\" border=\"0\" style=\"display:block\"></a>
	</td>
	 </tr>
	<tr>
		<td colspan='2' style='background-color:#3a3a3a;text-align:center;font-weight:bold;color:#E0E0E0;'>The Order Details</td>
	</tr>
	 <tr>
		<td colspan='2' style='background-color:#f5f5f5;padding:25px;'>
			<table border='1' bordercolor='#777' style='margin-left:auto;margin-right:auto;width:90%;border-collapse:collapse;border-color:#777;font-size:12px;'>
				<tbody>
					<tr style='background-color:#ccc;text-align:center;font-weight:bold;color:#3a3a3a;'>
						<td colspan='2' style='padding:5px;'>Message Information</td>
					</tr>
					<tr style='background-color:#fff;text-align:ltr;font-family:tahoma;'>
						<td colspan='2' style='padding:15px 0;'>". ($body) ."</td>
					</tr>
					<tr style='background-color:#ccc;text-align:center;font-weight:bold;color:#3a3a3a;'>
						<td colspan='2' style='padding:5px;'>Note : This mail may have an attachment, please check it if there is any.</td>
					</tr>
				</tbody>
			</table>
			<div style='font-family:tahoma;font-size:12px;direction:ltr;margin:20px;'>
	Europost Express (UK) Ltd.<br>
	4 Corringham Road,<br>
	Wembley - Middlesex<br>
	HA9 9QA- London , UK<br>
	Tel : +44(0) 7886105417<br>
	www.europostexpress.co.uk<br>
	aircargo@europostexpress.co.uk<br>

			</div>
			</td>
		</tr>
	</tbody></table>";

							$mailer->SendMail(array('email'=>'quote1@bookingparcel.com', 'name'=>'BookingParcel'), array('email'=>'aircargo@europostexpress.co.uk', 'name'=>'EuroPost Express'), $subject, $body);
							
							$official_office = $m->OfficialOfficeExist($this->Order_info['from'], $this->Order_info['to']);
							if($official_office!=null AND $official_office['master_email']!='' AND $official_office['master_email']!=null)
							{
								$mailer = null;
								$mailer = new MailerClass();
								$mailer->SendMail(array('email'=>'quote1@bookingparcel.com', 'name'=>'BookingParcel'), array('email'=>$official_office['master_email'], 'name'=>$official_office['oname']), $subject, $body);
								$mailer = null;
							}
						}
						$this->redirect("orders.php?oid=".$this->oid);
					}
					else if($this->data[$currency.'_current_balance'] >= $price){
						//echo "1<br>";
						$m->SetAsConfirmed($this->oid);
						$m->ConfirmOrder($this->oid, $this->conf_p);
						if($price!='' AND $currency!='')
						{
						//var_dump($this->data);
							/*
	array(34) { ["uname"]=> string(15) "Europost.Tehran" ["fname"]=> string(5) "Fazel" ["lname"]=> string(10) "Zohrabpour" ["company"]=> string(28) "Europost Express Middle East" ["email"]=> string(25) "office@europostexpress.ir" ["balance"]=> string(1) "0" ["total_order"]=> string(1) "0" ["total_pay"]=> string(1) "0" ["gender"]=> string(1) "0" ["position"]=> string(1) "0" ["birthday"]=> string(10) "1964-05-02" ["address"]=> string(62) "No. 7 , 3rd Floor Abbasie Building Ferdosie SQ. Tehran Iran" ["about"]=> string(27) "Cargo and Courier Services " ["site"]=> string(29) "http://www.europostexpress.ir" ["phone"]=> string(8) "88820895" ["orders"]=> string(1) "0" ["orders_c"]=> string(1) "0" ["unread"]=> string(1) "0" ["avatar"]=> string(12) "9_b3bdb1.png" ["created_at"]=> string(10) "1469874196" ["updated_at"]=> NULL ["IRR_total_receive"]=> string(11) "10000000.00" ["IRR_current_balance"]=> string(4) "0.00" ["IRR_total_order_paid"]=> string(4) "0.00" ["GBP_total_receive"]=> string(7) "1000.00" ["GBP_current_balance"]=> string(4) "0.00" ["GBP_total_order_paid"]=> string(4) "0.00" ["USD_total_receive"]=> string(7) "1000.00" ["USD_current_balance"]=> string(4) "0.00" ["USD_total_order_paid"]=> string(4) "0.00" ["EUR_total_receive"]=> string(7) "1000.00" ["EUR_current_balance"]=> string(4) "0.00" ["EUR_total_order_paid"]=> string(4) "0.00" ["support_c"]=> string(1) "0" }						
							echo $currency."<br>";
							echo $price."<br>";
							echo $this->data[$currency.'_current_balance']."<br>";
							echo $currency."_current_balance<br>";
							echo ($config==true ? "yes" : "no")."<br>";
							EUR
							233.00

							EUR_current_balance
							yes
							*/
							$mailer = new MailerClass();
							$subject = "User confirmed a price for order ".$this->Order_info['tid'];
							$body = "Order : ".$this->Order_info['tid']."<br>The confirmed price and method : ".$tmp1."<br>";
							$body .= "Sender ( Collection ) Information <span style=\"color:#ff0000;\">( Also for HAWB)</span>:<br>";
							$body .= "Company : ".$this->inputSCName ."<br>";
							$body .= "Contact Person Name : ".$this->inputSCPName ."<br>";
							$body .= "E-mail : ".$this->inputSeMail ."<br>";
							$body .= "Telephone : ".$this->inputSPhone ."<br>";
							$body .= "Country : ".$this->inputScountry ."<br>";
							$body .= "Zip Code : ".$this->inputSZipCode ."<br>";
							$body .= "Address : ".$this->Sender ."<br><br><br>";
							$body .= "Receiver ( Delivery ) Information <span style=\"color:#ff0000;\">( Also for HAWB)</span>:<br>";
							$body .= "Company : ".$this->inputRCName ."<br>";
							$body .= "Contact Person Name : ".$this->inputRCPName ."<br>";
							$body .= "E-mail : ".$this->inputReMail ."<br>";
							$body .= "Telephone : ".$this->inputRPhone ."<br>";
							$body .= "Country : ".$this->inputRcountry ."<br>";
							$body .= "Zip Code : ".$this->inputRZipCode ."<br>";
							$body .= "Address : ".$this->Receiver ."<br>";
							/*
							if($config==true AND ($this->data[$currency.'_current_balance'] >= $price OR $this->data['mdp']==1))
							{*/
								//ُSetAsPaid
								$m->SetAsPaid($this->oid);
								$m->ModifyUserBalance($this->data['id'], $price, $currency);
								$m->ReportForDeposite($this->oid, $this->data['id'], $price, $currency);
								$this->data[$currency.'_current_balance'] -= $price;
								$this->data[$currency.'_total_order_paid'] += $price;
								$body .= "<br><br>The order cost subtracted from the user deposit.<br>";
								
						/*	}
							elseif(!($this->data[$currency.'_current_balance'] >= $price OR $this->data['mdp']==1))
							{
								$body .= "<br><br>User does not have enough deposit.<br>";
							}*/
								
									$body = "<table cellpadding='5' cellspacing='1' style='margin-left:auto;margin-right:auto;width:100%;border:0px;font-family:tahoma;font-size:12px;direction:ltr;border:thin solid #777;'>
	 <tr>
	  <td style='background-color:#ffcc33;text-align:left;font-weight:bold;color:#ff3333;' width='80%'>
	  </td>
	 <td width='20%' bgcolor=\"#ffffff\" align=\"right\" valign=\"top\" style=\"background-color:#ffffff;text-align:left;font-weight:bold;color:#ff3333;padding:10px 25px 20px 0px\">
		<a href=\"http://bookingparcel.com/\" target=\"_blank\" rel=\"noreferrer\"><img src=\"http://bookingparcel.com/europost_logo.gif\" alt=\"EuropostExpress\" width=\"237\" height=\"56\" border=\"0\" style=\"display:block\"></a>
	</td>
	 </tr>
	<tr>
		<td colspan='2' style='background-color:#3a3a3a;text-align:center;font-weight:bold;color:#E0E0E0;'>The Order Details</td>
	</tr>
	 <tr>
		<td colspan='2' style='background-color:#f5f5f5;padding:25px;'>
			<table border='1' bordercolor='#777' style='margin-left:auto;margin-right:auto;width:90%;border-collapse:collapse;border-color:#777;font-size:12px;'>
				<tbody>
					<tr style='background-color:#ccc;text-align:center;font-weight:bold;color:#3a3a3a;'>
						<td colspan='2' style='padding:5px;'>Message Information</td>
					</tr>
					<tr style='background-color:#fff;text-align:ltr;font-family:tahoma;'>
						<td colspan='2' style='padding:15px 0;'>". ($body) ."</td>
					</tr>
					<tr style='background-color:#ccc;text-align:center;font-weight:bold;color:#3a3a3a;'>
						<td colspan='2' style='padding:5px;'>Note : This mail may have an attachment, please check it if there is any.</td>
					</tr>
				</tbody>
			</table>
			<div style='font-family:tahoma;font-size:12px;direction:ltr;margin:20px;'>
	Europost Express (UK) Ltd.<br>
	4 Corringham Road,<br>
	Wembley - Middlesex<br>
	HA9 9QA- London , UK<br>
	Tel : +44(0) 7886105417<br>
	www.europostexpress.co.uk<br>
	aircargo@europostexpress.co.uk<br>

			</div>
			</td>
		</tr>
	</tbody></table>";
							$mailer->SendMail(array('email'=>'quote1@bookingparcel.com', 'name'=>'BookingParcel'), array('email'=>'aircargo@europostexpress.co.uk', 'name'=>'EuroPost Express'), $subject, $body);
							
							$official_office = $m->OfficialOfficeExist($this->Order_info['from'], $this->Order_info['to']);
							if($official_office!=null AND $official_office['master_email']!='' AND $official_office['master_email']!=null)
							{
								$mailer = null;
								$mailer = new MailerClass();
								$mailer->SendMail(array('email'=>'quote1@bookingparcel.com', 'name'=>'BookingParcel'), array('email'=>$official_office['master_email'], 'name'=>$official_office['oname']), $subject, $body);
								$mailer = null;
							}
							
						}
						
					
						$this->redirect("orders.php?oid=".$this->oid);
					}
					else{
						
						//$this->redirect("orders.php?oid=".$this->oid);
					}
				}
			}
			if($this->Order_info['counter']>0)
			{
				
				$this->answers_info = $m->GetOrderStatusByID($this->oid);
				$this->transactions_info = $m->GetOrderTransactionsByID($this->oid, $this->data['id']);
				$temp = $m->GetShipInfoByID($this->oid);
				if($temp['counter'] > 0)
				{
					$this->shipping_info['consignee'] = $temp['rcompany'];
					$this->shipping_info['shipper'] = $temp['saddress']."<br><br>".$temp['scountry']."<br><br>".$temp['scompany']."<br><br>".$temp['stelephone']."<br><br>".$temp['semail'];
				}
			}
		}
		
		$m->dispose();
    }

    public function RenderPagination($cur_Page, $total_Page, $itemPerPage, $total_Res)
	{
		$output = '<div class="pull-right"><span class="text-muted"><b>'.(($itemPerPage * ($cur_Page - 1)) + 1).'</b>&nbsp; – &nbsp;<b>'.min(($itemPerPage * $cur_Page ), $total_Res).'</b>&nbsp; of &nbsp;<b>'.$total_Res.'</b></span>';
	
        $output .= '<div class="btn-group mlm">';
		if($cur_Page>1)
		{
			$output .= '<button type="button" class="btn btn-default" onclick="window.location.href=\'orders.php?page='.($cur_Page-1).'\';"><span class="fa fa-chevron-left"></span></button>';
		}
		else
		{
			$output .= '<button type="button" class="btn btn-default"><span class="fa fa-chevron-left"></span></button>';
		}
		if($cur_Page<$total_Page)
		{
			$output .= '<button type="button" class="btn btn-default" onclick="window.location.href=\'orders.php?page='.($cur_Page+1).'\';"><span class="fa fa-chevron-right"></span></button>';
		}
		else
		{
			$output .= '<button type="button" class="btn btn-default"><span class="fa fa-chevron-right"></span></button>';
		}
			
		$output .= '</div></div>';
		return $output;
	}

    

}

$p = new PView( );
$p->run( );
