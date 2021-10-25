<?php

use Kaban\Models\Agent;
use Kaban\Models\Url;

require(__DIR__ . "" . DIRECTORY_SEPARATOR . "Core" . DIRECTORY_SEPARATOR . "boot.php");
require_once(MODEL_PATH . "agents.php");
require_once(APP_PATH . "Mailer.php");
require_once(LIB_PATH . "GoogleCurrencyConvertor.inc.php");

class PView extends PageView
{
    public $error = true;
    public $error_m = 'The Link is not valid';
    public $ref = null;
    public $aref = null;
    public $data = null;

    public $country_iso = array(
        'Afghanistan' => 'AFG',
        'Aland Islands' => 'ALA',
        'Albania' => 'ALB',
        'Algeria' => 'DZA',
        'American Samoa' => 'ASM',
        'Andorra' => 'AND',
        'Angola' => 'AGO',
        'Anguilla' => 'AIA',
        'Antarctica' => 'ATA',
        'Antigua and Barbuda' => 'ATG',
        'Argentina' => 'ARG',
        'Armenia' => 'ARM',
        'Aruba' => 'ABW',
        'Australia' => 'AUS',
        'Austria' => 'AUT',
        'Azerbaijan' => 'AZE',
        'Bahamas' => 'BHS',
        'Bahrain' => 'BHR',
        'Bangladesh' => 'BGD',
        'Barbados' => 'BRB',
        'Belarus' => 'BLR',
        'Belgium' => 'BEL',
        'Belize' => 'BLZ',
        'Benin' => 'BEN',
        'Bermuda' => 'BMU',
        'Bhutan' => 'BTN',
        'Bolivia' => 'BOL',
        'Bonaire, Saint Eustatius and Saba ' => 'BES',
        'Bosnia and Herzegovina' => 'BIH',
        'Botswana' => 'BWA',
        'Bouvet Island' => 'BVT',
        'Brazil' => 'BRA',
        'British Indian Ocean Territory' => 'IOT',
        'British Virgin Islands' => 'VGB',
        'Brunei' => 'BRN',
        'Bulgaria' => 'BGR',
        'Burkina Faso' => 'BFA',
        'Burundi' => 'BDI',
        'Cambodia' => 'KHM',
        'Cameroon' => 'CMR',
        'Canada' => 'CAN',
        'Cape Verde' => 'CPV',
        'Cayman Islands' => 'CYM',
        'Central African Republic' => 'CAF',
        'Chad' => 'TCD',
        'Chile' => 'CHL',
        'China' => 'CHN',
        'Christmas Island' => 'CXR',
        'Cocos Islands' => 'CCK',
        'Colombia' => 'COL',
        'Comoros' => 'COM',
        'Cook Islands' => 'COK',
        'Costa Rica' => 'CRI',
        'Croatia' => 'HRV',
        'Cuba' => 'CUB',
        'Curacao' => 'CUW',
        'Cyprus' => 'CYP',
        'Czech Republic' => 'CZE',
        'Democratic Republic of the Congo' => 'COD',
        'Denmark' => 'DNK',
        'Djibouti' => 'DJI',
        'Dominica' => 'DMA',
        'Dominican Republic' => 'DOM',
        'East Timor' => 'TLS',
        'Ecuador' => 'ECU',
        'Egypt' => 'EGY',
        'El Salvador' => 'SLV',
        'Equatorial Guinea' => 'GNQ',
        'Eritrea' => 'ERI',
        'Estonia' => 'EST',
        'Ethiopia' => 'ETH',
        'Falkland Islands' => 'FLK',
        'Faroe Islands' => 'FRO',
        'Fiji' => 'FJI',
        'Finland' => 'FIN',
        'France' => 'FRA',
        'French Guiana' => 'GUF',
        'French Polynesia' => 'PYF',
        'French Southern Territories' => 'ATF',
        'Gabon' => 'GAB',
        'Gambia' => 'GMB',
        'Georgia' => 'GEO',
        'Germany' => 'DEU',
        'Ghana' => 'GHA',
        'Gibraltar' => 'GIB',
        'Greece' => 'GRC',
        'Greenland' => 'GRL',
        'Grenada' => 'GRD',
        'Guadeloupe' => 'GLP',
        'Guam' => 'GUM',
        'Guatemala' => 'GTM',
        'Guernsey' => 'GGY',
        'Guinea' => 'GIN',
        'Guinea-Bissau' => 'GNB',
        'Guyana' => 'GUY',
        'Haiti' => 'HTI',
        'Heard Island and McDonald Islands' => 'HMD',
        'Honduras' => 'HND',
        'Hong Kong' => 'HKG',
        'Hungary' => 'HUN',
        'Iceland' => 'ISL',
        'India' => 'IND',
        'Indonesia' => 'IDN',
        'Iran' => 'IRN',
        'Iraq' => 'IRQ',
        'Ireland' => 'IRL',
        'Isle of Man' => 'IMN',
        'Israel' => 'ISR',
        'Italy' => 'ITA',
        'Ivory Coast' => 'CIV',
        'Jamaica' => 'JAM',
        'Japan' => 'JPN',
        'Jersey' => 'JEY',
        'Jordan' => 'JOR',
        'Kazakhstan' => 'KAZ',
        'Kenya' => 'KEN',
        'Kiribati' => 'KIR',
        'Kosovo' => 'XKX',
        'Kuwait' => 'KWT',
        'Kyrgyzstan' => 'KGZ',
        'Laos' => 'LAO',
        'Latvia' => 'LVA',
        'Lebanon' => 'LBN',
        'Lesotho' => 'LSO',
        'Liberia' => 'LBR',
        'Libya' => 'LBY',
        'Liechtenstein' => 'LIE',
        'Lithuania' => 'LTU',
        'Luxembourg' => 'LUX',
        'Macao' => 'MAC',
        'Macedonia' => 'MKD',
        'Madagascar' => 'MDG',
        'Malawi' => 'MWI',
        'Malaysia' => 'MYS',
        'Maldives' => 'MDV',
        'Mali' => 'MLI',
        'Malta' => 'MLT',
        'Marshall Islands' => 'MHL',
        'Martinique' => 'MTQ',
        'Mauritania' => 'MRT',
        'Mauritius' => 'MUS',
        'Mayotte' => 'MYT',
        'Mexico' => 'MEX',
        'Micronesia' => 'FSM',
        'Moldova' => 'MDA',
        'Monaco' => 'MCO',
        'Mongolia' => 'MNG',
        'Montenegro' => 'MNE',
        'Montserrat' => 'MSR',
        'Morocco' => 'MAR',
        'Mozambique' => 'MOZ',
        'Myanmar' => 'MMR',
        'Namibia' => 'NAM',
        'Nauru' => 'NRU',
        'Nepal' => 'NPL',
        'Netherlands' => 'NLD',
        'New Caledonia' => 'NCL',
        'New Zealand' => 'NZL',
        'Nicaragua' => 'NIC',
        'Niger' => 'NER',
        'Nigeria' => 'NGA',
        'Niue' => 'NIU',
        'Norfolk Island' => 'NFK',
        'North Korea' => 'PRK',
        'Northern Mariana Islands' => 'MNP',
        'Norway' => 'NOR',
        'Oman' => 'OMN',
        'Pakistan' => 'PAK',
        'Palau' => 'PLW',
        'Palestinian Territory' => 'PSE',
        'Panama' => 'PAN',
        'Papua New Guinea' => 'PNG',
        'Paraguay' => 'PRY',
        'Peru' => 'PER',
        'Philippines' => 'PHL',
        'Pitcairn' => 'PCN',
        'Poland' => 'POL',
        'Portugal' => 'PRT',
        'Puerto Rico' => 'PRI',
        'Qatar' => 'QAT',
        'Republic of the Congo' => 'COG',
        'Reunion' => 'REU',
        'Romania' => 'ROU',
        'Russia' => 'RUS',
        'Rwanda' => 'RWA',
        'Saint Barthelemy' => 'BLM',
        'Saint Helena' => 'SHN',
        'Saint Kitts and Nevis' => 'KNA',
        'Saint Lucia' => 'LCA',
        'Saint Martin' => 'MAF',
        'Saint Pierre and Miquelon' => 'SPM',
        'Saint Vincent and the Grenadines' => 'VCT',
        'Samoa' => 'WSM',
        'San Marino' => 'SMR',
        'Sao Tome and Principe' => 'STP',
        'Saudi Arabia' => 'SAU',
        'Senegal' => 'SEN',
        'Serbia' => 'SRB',
        'Seychelles' => 'SYC',
        'Sierra Leone' => 'SLE',
        'Singapore' => 'SGP',
        'Sint Maarten' => 'SXM',
        'Slovakia' => 'SVK',
        'Slovenia' => 'SVN',
        'Solomon Islands' => 'SLB',
        'Somalia' => 'SOM',
        'South Africa' => 'ZAF',
        'South Georgia and the South Sandwich Islands' => 'SGS',
        'South Korea' => 'KOR',
        'South Sudan' => 'SSD',
        'Spain' => 'ESP',
        'Sri Lanka' => 'LKA',
        'Sudan' => 'SDN',
        'Suriname' => 'SUR',
        'Svalbard and Jan Mayen' => 'SJM',
        'Swaziland' => 'SWZ',
        'Sweden' => 'SWE',
        'Switzerland' => 'CHE',
        'Syria' => 'SYR',
        'Taiwan' => 'TWN',
        'Tajikistan' => 'TJK',
        'Tanzania' => 'TZA',
        'Thailand' => 'THA',
        'Togo' => 'TGO',
        'Tokelau' => 'TKL',
        'Tonga' => 'TON',
        'Trinidad and Tobago' => 'TTO',
        'Tunisia' => 'TUN',
        'Turkey' => 'TUR',
        'Turkmenistan' => 'TKM',
        'Turks and Caicos Islands' => 'TCA',
        'Tuvalu' => 'TUV',
        'U.S. Virgin Islands' => 'VIR',
        'Uganda' => 'UGA',
        'Ukraine' => 'UKR',
        'United Arab Emirates' => 'ARE',
        'United Kingdom' => 'GBR',
        'United States' => 'USA',
        'United States Minor Outlying Islands' => 'UMI',
        'Uruguay' => 'URY',
        'Uzbekistan' => 'UZB',
        'Vanuatu' => 'VUT',
        'Vatican' => 'VAT',
        'Venezuela' => 'VEN',
        'Vietnam' => 'VNM',
        'Wallis and Futuna' => 'WLF',
        'Western Sahara' => 'ESH',
        'Yemen' => 'YEM',
        'Zambia' => 'ZMB',
        'Zimbabwe' => 'ZWE',
        'Test Country' => 'TSTC'
    );

    public function __construct()
    {
        parent::__construct();
        $this->active_page = "agents";
        $this->viewFile = "agents.phtml";
        $this->agentsLogin = true;
        $this->agent = auth()->guard('agentGuard')->user();
        $this->logoutLink = config('general.CP_AGENT_LOGOUT_PAGE');
    }

    public function load()
    {
        parent::load();

        $m = new AgentsModel();
        if (isset($_GET['Param1']) and trim($_GET['Param1']) != '' and $_GET['Param1'] != null and strlen($_GET['Param1']) == 10) {
            if (isset($_GET['Param2']) and trim($_GET['Param2']) != '' and $_GET['Param2'] != null and strlen($_GET['Param2']) == 10) {
                if (isset($_GET['Param3']) and trim($_GET['Param3']) != '' and $_GET['Param3'] != null and strlen($_GET['Param3']) == 10) {
                    $result = $m->URLExists($_GET['Param1'], $_GET['Param2'], $_GET['Param3']);
                    if ($result['exists'] == true) {
                        if ($this->agent->id != $result['aref']) {
                            return header('Location: ' . config('general.AGENT_PROFILE_PAGE'));
                            exit();
                        }
                        Agent::where('id', intval($result['aref']))->update(['last_url' => intval($result['modelId'])]);

                        if (auth()->guard('agentGuard')->check() === false) {
                            return header('Location: ' . config('general.CP_AGENT_LOGIN_PAGE') . '?' . http_build_query($_GET));
                            exit();
                        }

                        $this->error = false;
                        $this->error_m = "";
                        $this->ref = $result['id'];
                        $this->aref = $result['aref'];
                    }
                }
            }
        }

        if (isset($this->ref) and $this->ref > 0 and isset($this->aref) and $this->aref > 0) {
            $this->data = $m->GetQuote($this->ref);
            $this->adata = $m->GetAgent($this->aref);
            //var_dump($this->ref);
            //var_dump($this->aref);
            //var_dump($this->data);
            //var_dump($this->adata);

            if ($this->isPost()) {
                $this->error = true;

                $Attachments = array();

                if (!$this->CheckAgentCanOffer()) {
                    $this->error_m .= "user had confirmed an offered price already. if you have special offers please be in touch with us by our email.<br>";
                } elseif (isset($_FILES['IncludeFile']['name']) and is_array($_FILES['IncludeFile']['name']) and count($_FILES['IncludeFile']['name']) > 0) {

                    $error = false;
                    $target_dir = __DIR__ . DIRECTORY_SEPARATOR . "BookingAttachmentFiles" . DIRECTORY_SEPARATOR;

                    foreach ($_FILES['IncludeFile']['name'] as $k => $upload) {
                        if (isset($_FILES['IncludeFile']['name'][$k]) and $_FILES['IncludeFile']['name'][$k] != "" and $_FILES['IncludeFile']['name'][$k] != null) {
                            $target_file = $target_dir . time() . "_" . $_POST['company'] . "_" . basename($_FILES['IncludeFile']['name'][$k]);
                            $uploadOk = 1;
                            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
                            $format = explode(".", basename($_FILES['IncludeFile']['name'][$k]));
                            $format = $format[(count($format) - 1)];
                            $filename = basename($_FILES['IncludeFile']['name'][$k]);
                            //$target_file = $target_dir . basename($_FILES['IncludeFile']['name'][$k]);
                            if ($_FILES["IncludeFile"]["size"][$k] > 52428801) {
                                $this->error_m .= "<br>" . basename($_FILES['IncludeFile']['name'][$k]) . "Invalid file size<br>";
                                $uploadOk = 0;
                                $error = true;
                                break;
                            } elseif ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "rtf" && $imageFileType != "zip" && $imageFileType != "pdf" && $imageFileType != "doc" && $imageFileType != "docx" && $imageFileType != "xls" && $imageFileType != "xlsx") {
                                $this->error_m .= "<br>" . basename($_FILES['IncludeFile']['name'][$k]) . "Invalid file format<br>";
                                $uploadOk = 0;
                                $error = true;
                                break;
                            }
                            if ($uploadOk == 0) {
                                $this->error_m .= "<br>" . basename($_FILES['IncludeFile']['name'][$k]) . " Sorry, your file was not uploaded.<br>";
                                $error = true;
                                break;
                            } else {
                                if (move_uploaded_file($_FILES['IncludeFile']['tmp_name'][$k], $target_file)) {
                                    $this->error_m .= "<br>" . "The file " . basename($_FILES['IncludeFile']['name'][$k]) . " has been uploaded.<br>";

                                    $Attachments[$filename] = str_replace($target_dir, "", $target_file);
                                }
                            }
                        }
                    }
                }
                if (!(isset($_POST['name']) and trim($_POST['name']) != '' and $_POST['name'] != null/* AND $this->StringSafe($_POST['name'])*/)) {
                    $this->error_m .= "Your Name is contaning invalid character or not set.<br>";
                } elseif (!(isset($_POST['company']) and trim($_POST['company']) != '' and $_POST['company'] != null/* AND $this->StringSafe($_POST['company'])*/)) {
                    $this->error_m .= "Your company is contaning invalid character or not set.<br>";
                } elseif (!(isset($_POST['email']) and trim($_POST['email']) != '' and $_POST['email'] != null/* AND $this->StringSafe($_POST['email'])*/)) {
                    $this->error_m .= "Your email is contaning invalid character or not set.<br>";
                } elseif (!isset($_POST['message']) and !(trim($_POST['message']) != '' and $_POST['message'] != null/* AND $this->StringSafe($_POST['message'])*/)) {
                    $this->error_m .= "Your message is contaning invalid character or not set.<br>";
                } elseif (!(isset($_POST['carrier']) and is_array($_POST['carrier']) and $_POST['carrier'] != null)) {
                    $this->error_m .= "Your carrier is contaning invalid character or not set.<br>";
                } elseif (!(isset($_POST['offer']) and is_array($_POST['offer']) and $_POST['offer'] != null)) {
                    $this->error_m .= "Your offer is contaning invalid character or not set.<br>";
                } elseif (!(isset($_POST['currecy']) and is_array($_POST['currecy']) and $_POST['currecy'] != null)) {
                    $this->error_m .= "Your currecy is contaning invalid character or not set.<br>";
                } elseif ($error) {

                } else {

                    $currency = "GBP";
                    $comision = 0;
                    $official_office = $m->OfficialOfficeExist($this->data['from'], $this->data['to']);
                    if ($official_office != null and $official_office['currency'] != '' and $official_office['currency'] != null) {
                        $currency = $official_office['currency'];
                    }
                    if ($official_office != null and $official_office['comision'] != '' and $official_office['comision'] != null) {
                        $comision = $official_office['comision'];
                    }


                    $error = false;
                    $tmp = "";
                    $tmp2 = "";
                    $_c = 0;
                    $more_than_30000 = false;
                    $tw = $this->getTheMaxNumber($this->data['total_weight']);
                    foreach ($_POST['carrier'] as $k => $v) {
                        if ($v != '' and $v != null) {
                            if (!$this->StringSafe($v) and false) {
                                $error = true;
                                $this->error_m .= "Your carrier is contaning invalid character or not set.<br>";
                                break;
                            } elseif (!(isset($_POST['offer'][$k]) and $_POST['offer'][$k] != '' and $_POST['offer'][$k] != null/* AND $this->StringSafe($_POST['offer'][$k])*/)) {
                                $error = true;
                                $this->error_m .= "Your offer price is contaning invalid character or not set.<br>";
                                break;
                            } elseif (!(isset($_POST['currecy'][$k]) and $_POST['currecy'][$k] != '' and $_POST['currecy'][$k] != null/* AND $this->StringSafe($_POST['currecy'][$k])*/ and ($_POST['currecy'][$k] == 'GBP' or $_POST['currecy'][$k] == 'USD' or $_POST['currecy'][$k] == 'EUR' or $_POST['currecy'][$k] == 'IRR'))) {
                                $error = true;
                                $this->error_m .= "Your price currecy is contaning invalid character or not set.<br>";
                                break;
                            } else {
                                //number_format($price_for_office,2)
                                //echo $_POST['offer'][$k]."<br>";

                                $_POST['offer'][$k] = str_replace(",", "", $_POST['offer'][$k]);
                                //echo number_format($_POST['offer'][$k],2)."<br>";
                                //echo str_replace(",","",number_format($_POST['offer'][$k],2))."<br>";
                                //echo $_POST['offer'][$k]."<br>";
                                if ($_POST['offer'][$k] > 30000) $more_than_30000 = true;

                                $extra = 0;
                                $percent = 0;

                                $currency = 'GBP';
                                if ($this->data['uname'] != '') {
                                    $user_info = $m->GetUserInfo($this->data['uname']);
                                    $extra = $user_info['extra_charge'];
                                    $percent = $user_info['extra_percent'];

                                    $currency = $user_info['default_currency'];
                                }

                                $tmp .= ($_c + 1) . ') off=>' . $v . '=>' . number_format($_POST['offer'][$k], 2) . '=>' . $_POST['currecy'][$k] . ' | ';
                                $tmpprice = $this->GetOfferPriceFromReceive($_POST['offer'][$k], $_POST['currecy'][$k], $currency, $extra, $percent, $tw);
                                $tmpcost = $tmpprice;
                                //echo $tmpcost."<br>";
                                //echo $comision."<br>";
                                if ($comision > 0) {
                                    $tmpcost = str_replace(",", "", $tmpcost);
                                    $tmpprice = str_replace(",", "", $tmpprice);
                                    $mul_var = ceil(($tmpprice) / 1000);
                                    $tmpcost = $tmpcost + ($mul_var * $comision);


                                }
                                //echo $tmpcost."<br><br><br>";

                                $tmp2 .= ($_c + 1) . ') off=>' . $v . '=>' . number_format($tmpcost, 2) . '=>' . (($_POST['currecy'][$k] == 'EUR' or $_POST['currecy'][$k] == 'USD' or $_POST['currecy'][$k] == 'GBP') ? $currency : $_POST['currecy'][$k]) . ' | ';
                                $_c++;
                            }
                        }
                    }
                    if ($error) {

                    } else {
                        $message = $_POST['message'];
                        if (!empty($Attachments)) {
                            $message .= "\n\nAttachments:\n";
                            foreach ($Attachments as $k => $v) {
                                $message .= "<a href=\"http://cp.bookingparcel.com/BookingAttachmentFiles/" . $v . "\">" . $k . "</a>\n";
                            }
                        }
                        $result_Insert = $m->InsertOffer($_POST['name'], $_POST['company'], $_POST['email'], $tmp, $message, $this->ref);

                        if ($result_Insert > 0) {
                            if ($more_than_30000)
                                $tmp2 = "";
                            $this->error = false;
                            $this->error_m .= "Your submition was successful.";

                            $m->UpdateOfferPrice($this->ref, $tmp, $tmp2);

                            $config = json_decode(file_get_contents(dirname(dirname(__FILE__)) . "/admin/conf.json"));
                            //var_dump($config->auto_mode);
                            if ($config->auto_mode == true) {
                                $email = $m->GetEmailBySubject("Reply to your quote Request");

                                $subject = $email['title'] . " Ref. " . $this->data['tid'];
                                $message = $email['message'];


                                $price2 = "";
                                $prices2 = explode(" | ", $tmp);
                                foreach ($prices2 as $k => $v) {
                                    if ($v != '') {
                                        $tmpe = explode(") ", $v);
                                        $ttmp = explode("=>", $tmpe[1]);
                                        $price2 .= '<br>';
                                        $price2 .= '' . $ttmp[2] . ' ' . $ttmp[3] . ' by ' . $ttmp[1] . '';
                                        $_c++;
                                    }
                                }
                                $price = "";
                                $prices = explode(" | ", $tmp2);
                                foreach ($prices as $k => $v) {
                                    if ($v != '') {
                                        $tmpe = explode(") ", $v);
                                        $ttmp = explode("=>", $tmpe[1]);
                                        $price .= '<br>';
                                        $price .= '' . $ttmp[2] . ' ' . $ttmp[3] . ' by ' . $ttmp[1] . '';
                                        $_c++;
                                    }
                                }

                                $message = str_replace("{offer_price}", $price, $message);
                                $message = str_replace("{id}", $this->data['id'], $message);
                                $message = str_replace("{tid}", $this->data['tid'], $message);
                                $message = str_replace("{PaymentStatus}", ($this->data['paid'] == 'no' ? 'UnPaid' : 'Paid'), $message);
                                $message = str_replace("{MAWB}", $this->data['mawb1'] . ' - ' . $this->data['mawb2'] . ' ' . $this->data['mawb3'], $message);
                                $message = str_replace("{HAWB}", str_replace('|', '<br>', $this->data['hawb']), $message);
                                $message = str_replace("{from_country}", $this->data['from'], $message);
                                $message = str_replace("{to_country}", $this->data['to'], $message);
                                $message = str_replace("{from_loc}", $this->data['from_st'] . " - " . $this->data['from_location'], $message);
                                $message = str_replace("{to_loc}", $this->data['to_st'] . " - " . $this->data['to_location'], $message);
                                $message = str_replace("{item_count}", $this->data['item_c'], $message);
                                $message = str_replace("{item_dims}", $this->data['dims'], $message);
                                $message = str_replace("{item_weight}", $this->data['total_weight'], $message);
                                $message = str_replace("{item_Desc}", $this->data['item_desc'], $message);
                                $message = str_replace("{dgr}", ($this->data['danger'] == 'yes' ? 'Yes, Cargo contains Dangerous Goods' : ''), $message);
                                $message = str_replace("{li_bat}", ($this->data['lithiumb'] == 'yes' ? 'Yes, Cargo contains Lithium-ion Battery' : ''), $message);
                                $message = str_replace("{chemical}", ($this->data['chemical'] == 'yes' ? 'Yes, Cargo contains Chemical Goods' : ''), $message);
                                $message = str_replace("{dgr_alert}", (($this->data['danger'] == 'yes' or $this->data['chemical'] == 'yes' or $this->data['lithiumb'] == 'yes') ? 'Important Note: Your order on hold, Please send MSDS to us ASAP.' : ''), $message);

                                $message = "<table cellpadding='5' cellspacing='1' style='margin-left:auto;margin-right:auto;width:100%;border:0px;font-family:tahoma;font-size:12px;direction:ltr;border:thin solid #777;'>
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
					<td colspan='2' style='padding:15px 0;'>" . ($message) . "</td>
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
                                $from = array('email' => 'quote1@bookingparcel.com', 'name' => 'BookingParcel');
                                if ($official_office != null and $official_office['master_email'] != '' and $official_office['master_email'] != null) {
                                    $from = array('email' => $official_office['master_email'], 'name' => $official_office['oname']);
                                }

                                if ($this->data['uname'] != '' and !$more_than_30000 and !($official_office != null and $official_office['master_email'] != '' and $official_office['master_email'] != null)) {
                                    $m->InsertEmailBackup($this->ref, "Subject : " . $subject . "<br>" . $message);
                                    $mailer = new MailerClass();
                                    $mailer->SendMail($from, array('email' => "" . ($this->data['quotemail'] != '' ? $this->data['quotemail'] : $this->data['email']) . "", 'name' => "" . $this->data['fname'] . " " . $this->data['lname'] . ""), $subject, $message);
                                    $mailer = null;
                                }
                                $mailer = new MailerClass();
                                $mailer->SendMail($from, array('email' => "aircargo@europostexpress.co.uk", 'name' => "EuroPost Express"), "The prices set by agent and Sent to user, ref EPX-" . $this->country_iso[$this->data['from']] . "-" . $this->country_iso[$this->data['to']] . "-" . $this->data['id'], $message);
                                $mailer = null;

                                if ($official_office != null and $official_office['master_email'] != '' and $official_office['master_email'] != null) {
                                    $mailer = new MailerClass();
                                    $mailer->SendMail($from, array('email' => 'quote1@bookingparcel.com', 'name' => 'BookingParcel'), "The prices set by agent and Sent to user, ref EPX-" . $this->country_iso[$this->data['from']] . "-" . $this->country_iso[$this->data['to']] . "-" . $this->data['id'], $message);
                                    $mailer = null;

                                    $mailer = new MailerClass();
                                    $mailer->SendMail(array('email' => array_pop($mails), 'name' => $this->adata['cname']), array('email' => $official_office['master_email'], 'name' => $official_office['oname']), "The prices set by agent and Sent to user, ref EPX-" . $this->country_iso[$this->data['from']] . "-" . $this->country_iso[$this->data['to']] . "-" . $this->data['id'], $message);
                                    $mailer = null;
                                }

                                $message = "To : " . $this->adata['cname'] . "<br>Dear " . $this->adata['fname'] . ",<br><br>We have received your quote for ref. EPX-" . $this->country_iso[$this->data['from']] . "-" . $this->country_iso[$this->data['to']] . "-" . $this->data['id'] . " as follow:<br>";
                                $message .= $price2 . "<br><br>";
                                $message .= "Regards<br>Fazel Zohrabpour";
                                $message = "<table cellpadding='5' cellspacing='1' style='margin-left:auto;margin-right:auto;width:100%;border:0px;font-family:tahoma;font-size:12px;direction:ltr;border:thin solid #777;'>
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
					<td colspan='2' style='padding:15px 0;'>" . ($message) . "</td>
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
                                $mails = explode("\n", $this->adata['emails']);
                                $mailer = new MailerClass();
                                $mailer->SendMail(array('email' => array_pop($mails), 'name' => $this->adata['cname']), array('email' => "aircargo@europostexpress.co.uk", 'name' => "EuroPost Express"), "Quote Received for ref EPX-" . $this->country_iso[$this->data['from']] . "-" . $this->country_iso[$this->data['to']] . "-" . $this->data['id'], $message, array(), $mails);
                                $mailer = null;

                                if ($official_office != null and $official_office['master_email'] != '' and $official_office['master_email'] != null) {
                                    $mailer = new MailerClass();
                                    $mailer->SendMail(array('email' => array_pop($mails), 'name' => $this->adata['cname']), array('email' => $official_office['master_email'], 'name' => $official_office['oname']), "The prices set by agent and Sent to user, ref EPX-" . $this->country_iso[$this->data['from']] . "-" . $this->country_iso[$this->data['to']] . "-" . $this->data['id'], $message);
                                    $mailer = null;
                                }
                            }

                        } else {
                            $this->error_m .= "Oops! SOmething went wrong with server side.";
                        }
                    }

                }
            } else {
                if (!$this->CheckAgentCanOffer()) {
                    $this->error = true;
                    $this->error_m .= "user had confirmed an offered price already. if you have special offers please be in touch with us by our email.<br>";
                }
                /*
                if($this->data['offered_p']!='' OR $this->data['received_p']!='')
                {
                    $this->error_m .= "some other offers has been taken already. if you have special offers please be in touch with us by our email.<br>";
                }*/
            }
        }
        $m->dispose();
    }

    public function CheckAgentCanOffer()
    {
        if ($this->data['offered_p'] == '' and $this->data['received_p'] == '') {
            return true;
        } else {

            if (isset($this->data['offered_p']) and $this->data['offered_p'] != '') {
                $prices = explode(" | ", $this->data['offered_p']);
                foreach ($prices as $k => $v) {
                    if ($v != '') {
                        $tmp = explode(") ", $v);
                        $ttmp = explode("=>", $tmp[1]);
                        $confirmed = false;
                        $conf_text = "";
                        if ($ttmp[0] == 'on') {
                            $confirmed = true;
                            break;
                        }
                    }
                }
                if ($confirmed) {
                    return false;
                }
            }
        }

        return true;
    }

    public function getTheMaxNumber($total_weight)
    {
        $total_weight = str_ireplace("kg", " kg", $total_weight);
        $tmp = explode(" ", $total_weight);
        if (count($tmp) == 1)
            return $tmp[0];
        if (count($tmp) > 1) {
            $max = 1;
            foreach ($tmp as $tm) {
                //var_dump($tm);
                //echo "<br>";
                if (is_numeric(trim($tm)) and $tm > 0) {//echo "a<br>";
                    if ($tm > $max)
                        $max = $tm;
                }
            }
            return $max;
        }

        return 1;
    }

    public function GetOfferPriceFromReceive($rprice, $currency = "EUR", $tocurrency = "GBP", $extra_c = 0, $percent = 0, $total_weight = 0)
    {
        $q = "SELECT * FROM `settings` WHERE `keyword`='quote-formula'";
        $r = mysql_query($q) or die(mysql_error());
        $quoteFormula = mysqli_fetch_object($r);

        eval($quoteFormula->value);

        return $result;
    }
    /*
    public function GetOfferPriceFromReceive($rprice, $currency="EUR", $tocurrency="GBP",$extra_c=0,$percent=0)
    {
        $rprice = str_replace(",","",$rprice);

        $extra =$eextra = 0;

        if($currency=='EUR' OR $currency=='USD' OR $currency=='GBP')
        {
            $tmp = (int)$rprice;
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



            if($tocurrency=='GBP')
            {
                if($currency=='USD')
                {
                    $eextra += 20;
                }
                elseif($currency=='EUR')
                {
                    $eextra += 5;
                }
            }
            elseif($tocurrency=='EUR')
            {
                if($currency=='USD')
                {
                    $eextra += 19;
                }
                elseif($currency=='EUR')
                {
                    $eextra += 5;
                }
            }


            //echo "currency ".$currency."<br>";
            //echo "tocurrency ".$tocurrency."<br>";
            //echo "rprice ".$rprice."<br>";
            //echo "extra ".$extra."<br>";
            //echo "extra_c ".$extra_c."<br>";
            //echo "percent ".$percent."<br>";

            $rate = 1;
            if($currency != $tocurrency){
                $googleCurrencyConvertor = new GoogleCurrencyConvertor("1",$currency,$tocurrency);
                $rate = $googleCurrencyConvertor->getRate();
            }
            $rprice = ceil($rprice * $rate);

            //echo "rate ".$rate."<br>";
            $rate = 1;
            if($tocurrency != 'GBP'){
                $googleCurrencyConvertor = new GoogleCurrencyConvertor("1",'GBP',$tocurrency);
                $rate = $googleCurrencyConvertor->getRate();
            }
            $extra = ceil($extra * $rate);


            //echo "rate ".$rate."<br>";
            //echo "currency ".$currency."<br>";
            //echo "tocurrency ".$tocurrency."<br>";
            //echo "rprice ".$rprice."<br>";
            //echo "extra ".$extra."<br>";
            //echo "extra_c ".$extra_c."<br>";
            //echo "percent ".$percent."<br>";


            $temp = 1 + ($percent / 100);
            $rprice *= $temp;
        }

        //echo ceil($rprice + $extra + $eextra + $extra_c)."<br>";
            //echo "result ".number_format(ceil($rprice + $extra + $eextra + $extra_c),2)."<br><br><br><br>";


        return ceil($rprice + $extra + $eextra + $extra_c);
    }
    */
    /*
    public function GetOfferPriceFromReceive($rprice, $currency="EUR")
    {
        //$rprice = str_replace(",","",$rprice);
        $extra = 0;
        if($currency=='EUR' OR $currency=='USD')
        {
            //$mult = ceil($rprice/600);
            //$mult = max(1,$mult);
            $extra = 0;
            if($rprice<=1200)
            {
                $extra +=20;
            }
            else
            {
                $extra +=20;
                $mult = ceil(($rprice - 1200)/1000);
                $mult = max(1,$mult);
                $extra += ($mult * 7);
            }

            $googleCurrencyConvertor = new GoogleCurrencyConvertor("1",$currency,"GBP");
            $rate = $googleCurrencyConvertor->getRate();
            $rprice = ceil($rprice * $rate);
        }
        $extra_price = ($rprice * 0.43);

        switch($currency)
        {
            case 'USD' :
                if($rprice <= 1000)
                    $extra_price = max(150, $extra_price);//120
                elseif($rprice>1000)
                    $extra_price = max(250, $extra_price);
            case 'EUR' :
                if($rprice <= 1000)
                    $extra_price = max(120, $extra_price);
                elseif($rprice>1000)
                    $extra_price = max(300, $extra_price);
        }

        return number_format(ceil($rprice + $extra_price + $extra),2);
    }
*/
}

$p = new PView();
$p->run();
