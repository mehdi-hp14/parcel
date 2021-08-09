<?php

include("post_forms/cnf.php");

session_start();
$errors = array();      // array to hold validation errors
$data   = array();      // array to pass back data

//All Restriction On Variables
$step = array(0,1,2,3,4,5,33);
$ship_type = array(1,2,3);
$country = array(
	'AFG'=>'Afghanistan',
	'ALA'=>'Aland Islands',
	'ALB'=>'Albania',
	'DZA'=>'Algeria',
	'ASM'=>'American Samoa',
	'AND'=>'Andorra',
	'AGO'=>'Angola',
	'AIA'=>'Anguilla',
	'ATA'=>'Antarctica',
	'ATG'=>'Antigua and Barbuda',
	'ARG'=>'Argentina',
	'ARM'=>'Armenia',
	'ABW'=>'Aruba',
	'AUS'=>'Australia',
	'AUT'=>'Austria',
	'AZE'=>'Azerbaijan',
	'BHS'=>'Bahamas',
	'BHR'=>'Bahrain',
	'BGD'=>'Bangladesh',
	'BRB'=>'Barbados',
	'BLR'=>'Belarus',
	'BEL'=>'Belgium',
	'BLZ'=>'Belize',
	'BEN'=>'Benin',
	'BMU'=>'Bermuda',
	'BTN'=>'Bhutan',
	'BOL'=>'Bolivia',
	'BES'=>'Bonaire, Saint Eustatius and Saba ',
	'BIH'=>'Bosnia and Herzegovina',
	'BWA'=>'Botswana',
	'BVT'=>'Bouvet Island',
	'BRA'=>'Brazil',
	'IOT'=>'British Indian Ocean Territory',
	'VGB'=>'British Virgin Islands',
	'BRN'=>'Brunei',
	'BGR'=>'Bulgaria',
	'BFA'=>'Burkina Faso',
	'BDI'=>'Burundi',
	'KHM'=>'Cambodia',
	'CMR'=>'Cameroon',
	'CAN'=>'Canada',
	'CPV'=>'Cape Verde',
	'CYM'=>'Cayman Islands',
	'CAF'=>'Central African Republic',
	'TCD'=>'Chad',
	'CHL'=>'Chile',
	'CHN'=>'China',
	'CXR'=>'Christmas Island',
	'CCK'=>'Cocos Islands',
	'COL'=>'Colombia',
	'COM'=>'Comoros',
	'COK'=>'Cook Islands',
	'CRI'=>'Costa Rica',
	'HRV'=>'Croatia',
	'CUB'=>'Cuba',
	'CUW'=>'Curacao',
	'CYP'=>'Cyprus',
	'CZE'=>'Czech Republic',
	'COD'=>'Democratic Republic of the Congo',
	'DNK'=>'Denmark',
	'DJI'=>'Djibouti',
	'DMA'=>'Dominica',
	'DOM'=>'Dominican Republic',
	'TLS'=>'East Timor',
	'ECU'=>'Ecuador',
	'EGY'=>'Egypt',
	'SLV'=>'El Salvador',
	'GNQ'=>'Equatorial Guinea',
	'ERI'=>'Eritrea',
	'EST'=>'Estonia',
	'ETH'=>'Ethiopia',
	'FLK'=>'Falkland Islands',
	'FRO'=>'Faroe Islands',
	'FJI'=>'Fiji',
	'FIN'=>'Finland',
	'FRA'=>'France',
	'GUF'=>'French Guiana',
	'PYF'=>'French Polynesia',
	'ATF'=>'French Southern Territories',
	'GAB'=>'Gabon',
	'GMB'=>'Gambia',
	'GEO'=>'Georgia',
	'DEU'=>'Germany',
	'GHA'=>'Ghana',
	'GIB'=>'Gibraltar',
	'GRC'=>'Greece',
	'GRL'=>'Greenland',
	'GRD'=>'Grenada',
	'GLP'=>'Guadeloupe',
	'GUM'=>'Guam',
	'GTM'=>'Guatemala',
	'GGY'=>'Guernsey',
	'GIN'=>'Guinea',
	'GNB'=>'Guinea-Bissau',
	'GUY'=>'Guyana',
	'HTI'=>'Haiti',
	'HMD'=>'Heard Island and McDonald Islands',
	'HND'=>'Honduras',
	'HKG'=>'Hong Kong',
	'HUN'=>'Hungary',
	'ISL'=>'Iceland',
	'IND'=>'India',
	'IDN'=>'Indonesia',
	'IRN'=>'Iran',
	'IRQ'=>'Iraq',
	'IRL'=>'Ireland',
	'IMN'=>'Isle of Man',
	'ISR'=>'Israel',
	'ITA'=>'Italy',
	'CIV'=>'Ivory Coast',
	'JAM'=>'Jamaica',
	'JPN'=>'Japan',
	'JEY'=>'Jersey',
	'JOR'=>'Jordan',
	'KAZ'=>'Kazakhstan',
	'KEN'=>'Kenya',
	'KIR'=>'Kiribati',
	'XKX'=>'Kosovo',
	'KWT'=>'Kuwait',
	'KGZ'=>'Kyrgyzstan',
	'LAO'=>'Laos',
	'LVA'=>'Latvia',
	'LBN'=>'Lebanon',
	'LSO'=>'Lesotho',
	'LBR'=>'Liberia',
	'LBY'=>'Libya',
	'LIE'=>'Liechtenstein',
	'LTU'=>'Lithuania',
	'LUX'=>'Luxembourg',
	'MAC'=>'Macao',
	'MKD'=>'Macedonia',
	'MDG'=>'Madagascar',
	'MWI'=>'Malawi',
	'MYS'=>'Malaysia',
	'MDV'=>'Maldives',
	'MLI'=>'Mali',
	'MLT'=>'Malta',
	'MHL'=>'Marshall Islands',
	'MTQ'=>'Martinique',
	'MRT'=>'Mauritania',
	'MUS'=>'Mauritius',
	'MYT'=>'Mayotte',
	'MEX'=>'Mexico',
	'FSM'=>'Micronesia',
	'MDA'=>'Moldova',
	'MCO'=>'Monaco',
	'MNG'=>'Mongolia',
	'MNE'=>'Montenegro',
	'MSR'=>'Montserrat',
	'MAR'=>'Morocco',
	'MOZ'=>'Mozambique',
	'MMR'=>'Myanmar',
	'NAM'=>'Namibia',
	'NRU'=>'Nauru',
	'NPL'=>'Nepal',
	'NLD'=>'Netherlands',
	'NCL'=>'New Caledonia',
	'NZL'=>'New Zealand',
	'NIC'=>'Nicaragua',
	'NER'=>'Niger',
	'NGA'=>'Nigeria',
	'NIU'=>'Niue',
	'NFK'=>'Norfolk Island',
	'PRK'=>'North Korea',
	'MNP'=>'Northern Mariana Islands',
	'NOR'=>'Norway',
	'OMN'=>'Oman',
	'PAK'=>'Pakistan',
	'PLW'=>'Palau',
	'PSE'=>'Palestinian Territory',
	'PAN'=>'Panama',
	'PNG'=>'Papua New Guinea',
	'PRY'=>'Paraguay',
	'PER'=>'Peru',
	'PHL'=>'Philippines',
	'PCN'=>'Pitcairn',
	'POL'=>'Poland',
	'PRT'=>'Portugal',
	'PRI'=>'Puerto Rico',
	'QAT'=>'Qatar',
	'COG'=>'Republic of the Congo',
	'REU'=>'Reunion',
	'ROU'=>'Romania',
	'RUS'=>'Russia',
	'RWA'=>'Rwanda',
	'BLM'=>'Saint Barthelemy',
	'SHN'=>'Saint Helena',
	'KNA'=>'Saint Kitts and Nevis',
	'LCA'=>'Saint Lucia',
	'MAF'=>'Saint Martin',
	'SPM'=>'Saint Pierre and Miquelon',
	'VCT'=>'Saint Vincent and the Grenadines',
	'WSM'=>'Samoa',
	'SMR'=>'San Marino',
	'STP'=>'Sao Tome and Principe',
	'SAU'=>'Saudi Arabia',
	'SEN'=>'Senegal',
	'SRB'=>'Serbia',
	'SYC'=>'Seychelles',
	'SLE'=>'Sierra Leone',
	'SGP'=>'Singapore',
	'SXM'=>'Sint Maarten',
	'SVK'=>'Slovakia',
	'SVN'=>'Slovenia',
	'SLB'=>'Solomon Islands',
	'SOM'=>'Somalia',
	'ZAF'=>'South Africa',
	'SGS'=>'South Georgia and the South Sandwich Islands',
	'KOR'=>'South Korea',
	'SSD'=>'South Sudan',
	'ESP'=>'Spain',
	'LKA'=>'Sri Lanka',
	'SDN'=>'Sudan',
	'SUR'=>'Suriname',
	'SJM'=>'Svalbard and Jan Mayen',
	'SWZ'=>'Swaziland',
	'SWE'=>'Sweden',
	'CHE'=>'Switzerland',
	'SYR'=>'Syria',
	'TWN'=>'Taiwan',
	'TJK'=>'Tajikistan',
	'TZA'=>'Tanzania',
	'THA'=>'Thailand',
	'TGO'=>'Togo',
	'TKL'=>'Tokelau',
	'TON'=>'Tonga',
	'TTO'=>'Trinidad and Tobago',
	'TUN'=>'Tunisia',
	'TUR'=>'Turkey',
	'TKM'=>'Turkmenistan',
	'TCA'=>'Turks and Caicos Islands',
	'TUV'=>'Tuvalu',
	'VIR'=>'U.S. Virgin Islands',
	'UGA'=>'Uganda',
	'UKR'=>'Ukraine',
	'ARE'=>'United Arab Emirates',
	'GBR'=>'United Kingdom',
	'USA'=>'United States',
	'UMI'=>'United States Minor Outlying Islands',
	'URY'=>'Uruguay',
	'UZB'=>'Uzbekistan',
	'VUT'=>'Vanuatu',
	'VAT'=>'Vatican',
	'VEN'=>'Venezuela',
	'VNM'=>'Vietnam',
	'WLF'=>'Wallis and Futuna',
	'ESH'=>'Western Sahara',
	'YEM'=>'Yemen',
	'ZMB'=>'Zambia',
	'ZWE'=>'Zimbabwe'
);
$ship_kind = array('Comercial'=>1,'Personal'=>2);
$timeSelect = array('ASAP'=>0,'This week'=>1,'This month'=>2,'Exact date'=>3,'Not sure when'=>4);
$ship_method = array('Air'=>1,'Sea'=>2,'Land'=>3,'Rail Way'=>4,'Charter'=>6,'Not sure'=>5);
if($_SESSION['ship_method'] == 1){
	$shipMethod = array('Airport to Door'=>4,'Door to Door'=>1,'Door to Airport'=>2,'Airport to Airport'=>3);
}
if($_SESSION['ship_method'] == 2){
	$shipMethod = array('Door to Door'=>1,'Door to Port'=>2,'Port to Port'=>3,'Port to Door'=>4);
	$containerType = array('FCL'=>1,'LCL'=>2,'Not sure'=>3);
}
if($_SESSION['ship_method'] == 3){
	$containerType = array('FTL'=>1,'LTL'=>2,'Not sure'=>3);
}
$term = array('EX-Work'=>1,'FOB'=>2,'CPT'=>4,'DDP'=>5,'DDU'=>6,'Other'=>3);
$terms = array('PAX'=>0,'CAO'=>1,'Not sure'=>2);
$FCLType = array('20 ft container'=>1,'40 ft container'=>2,'40 ft high cube container'=>3);
$lithium = array('Yes'=>1,'No'=>2);
$chemicals = array('Yes'=>1,'No'=>2);
$dg = array('Yes'=>1,'No'=>2);
$stackable = array('Yes'=>1,'No'=>2);
$insurance = array('Yes'=>1,'No'=>2,'Not sure'=>3);
$account = array(1,2);
$contactMethod = array('Phone'=>1,'Email'=>2,'Any'=>3);
$contactTime = array('Anytime'=>1,'In the morning'=>2,'In the afternoon'=>3,'In the evening'=>4);



$time = time();
$html = "";

if(isset($_GET['cmd']) AND $_GET['cmd']=='previous')
{
	if(isset($_POST['step']) AND is_numeric($_POST['step']) AND (in_array($_POST['step'],$step) OR $_POST['step']==32))
	{
		switch($_POST['step'])
		{
			case 0:
$html .= '
					<div id="forms">
						<div id="infoi" style="display:none;"><div class="loader"></div></div>
						<div class="progress">
						  <div class="progress-bar  progress-bar-primary" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
							Tracking
						  </div>
						</div>

						<div class="form_header">
							<h1 style="font-size:30px;padding:20px 1em ;">Tracking quote</h1>
						</div>
						<div id="form_body">
						<form id="quote_form" method="post" action="ajax_process.php">
							<input type="hidden" name="step" value="0">
							<div class="row">
								<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
									<div class="required">Your Tracking ID :</div>
									<div><input name="tracking" type="text"></div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
									<div class="required">Your E-mail :</div>
									<div><input name="email" type="email"></div>
								</div>
							</div>

<script type="text/javascript">
	$(document).ready(function () {
		$("#NextID'.$time.'").click(function(event) {
			$(\'#infoi\').show();
			event.preventDefault();
			var formData = $("#quote_form").serialize();
			
			$.ajax({
				type        : \'POST\', 
				url         : \'ajax_process.php\', 
				data        : formData, 
				dataType    : \'json\', 
				encode          : true
			})
			
			.done(function(data) {
				
				console.log(data); 
				
				if (data.message !="") {
					$(\'#forms\').replaceWith(\'\' + data.message + \'\');
					if (data.status == false) {
						var html = "<div class=\"row\">";
						$.each(data.errors, function(key, value)
						{
							html += "<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\"><div class=\"alert alert-danger\">";
							html += "<span><strong>"+key+"</strong>&nbsp;:&nbsp;</span>";
							html += "<span>"+value+"</span>";
							html += "</div></div>";
						});
						html += "</div>";
						$(\'#forms\').prepend(html);
					}
					$(\'#infoi\').hide();
				}
				
			});

			
		});
	});
</script>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<hr>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<div class="pull-right" style="min-width:80%;"><button type="submit" class="btn btn-primary" style="min-width:80%;" id="NextID'.$time.'">Apply</button></div>
								</div>
							</div>
						</form>
						</div>
					</div>
				</div>
';
				$data['status'] = true;
				$data['message'] = $html;
			break;
			case 1:
			if(!isset($_SESSION['ship_type'])) return;
			$html .= '
					<div id="forms">
						<div id="infoi" style="display:none;"><div class="loader"></div></div>
						<div class="progress">
						  <div class="progress-bar  progress-bar-primary" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">
							Step #1 - 0% complete
						  </div>
						</div>

						<div class="form_header">
							<h1 style="font-size:30px;padding:20px 1em ;">Shipping quote</h1>
						</div>
						<div id="form_body">
						<form id="quote_form" method="post" action="ajax_process.php">
							<input type="hidden" name="step" value="1">
							<div class="row">
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="required ">Please Select&nbsp;:&nbsp;</div>
									<div>
										<input type="radio" name="ship_type" value="1"'.((isset($_SESSION['ship_type']) AND $_SESSION['ship_type']==1) ? " checked='checked'" : "").' id="ShipType1" OnClick="CountryFunction(\'from\',\'uk\');" required="true" >&nbsp;<label for="ShipType1">Shipping from the UK</label><br>
										<input type="radio" name="ship_type" value="2"'.((isset($_SESSION['ship_type']) AND $_SESSION['ship_type']==2) ? " checked='checked'" : "").' id="ShipType2" OnClick="CountryFunction(\'to\',\'uk\');" required="true">&nbsp;<label for="ShipType2">Shipping to the UK</label><br>
										<input type="radio" name="ship_type" value="3"'.((isset($_SESSION['ship_type']) AND $_SESSION['ship_type']==3) ? " checked='checked'" : "").' id="ShipType3" OnClick="CountryFunction(\'other\',\'\');" required="true">&nbsp;<label for="ShipType3">Other</label>
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="required">Collection Country&nbsp;:&nbsp;</div>
									<div>
										<select class="drop_down" name="from_country" id="from_country" required="true">
											'.((isset($_SESSION['from_country']) AND $_SESSION['from_country']!='') ? "<option value='".array_search($_SESSION['from_country'],$country)."' selected>".$_SESSION['from_country']."</option>" : "<option>---</option>").'
										
										</select>
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="required">Destination Country&nbsp;:&nbsp;</div>
									<div>
										<select class="drop_down" name="to_country" id="to_country" required="true">
											'.((isset($_SESSION['to_country']) AND $_SESSION['to_country']!='') ? "<option value='".array_search($_SESSION['to_country'],$country)."' selected>".$_SESSION['to_country']."</option>" : "<option>---</option>").'
										</select>
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="required">Shipping type&nbsp;:&nbsp;</div>
									<div>
										<input type="radio" name="ship_kind" value="1"'.((isset($_SESSION['ship_kind']) AND $_SESSION['ship_kind']==1) ? " checked='checked'" : "").' id="ShipKind1" required="true">&nbsp;<label for="ShipKind1">Comercial</label><br>
										<input type="radio" name="ship_kind" value="2"'.((isset($_SESSION['ship_kind']) AND $_SESSION['ship_kind']==2) ? " checked='checked'" : "").' id="ShipKind2" required="true">&nbsp;<label for="ShipKind2">Personal</label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<hr>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="required"><label for="when_time">When?&nbsp;</label></div>
									<div>
										<select id="when_time" name="time" class="drop_down" OnChange="HandleTimeSelection();" required="true">
											<option></option>
											<option value="0"'.((isset($_SESSION['time']) AND $_SESSION['time']==0) ? " selected" : "").'>ASAP</option>
											<option value="1"'.((isset($_SESSION['time']) AND $_SESSION['time']==1) ? " selected" : "").'>This week</option>
											<option value="2"'.((isset($_SESSION['time']) AND $_SESSION['time']==2) ? " selected" : "").'>This month</option>
											<option value="3"'.((isset($_SESSION['time']) AND $_SESSION['time']==3) ? " selected" : "").'>Enter exact date</option>
											<option value="4"'.((isset($_SESSION['time']) AND $_SESSION['time']==4) ? " selected" : "").'>Not sure when</option>
										</select>
									</div>
									<div style="display:none;" id="exact_date">
										<div class="required">Please enter a date :</div>
										<div><input name="exact_date" type="text"'.((isset($_SESSION['exact_date']) AND $_SESSION['exact_date']!='') ? " value='".$_SESSION['exact_date']."'" : "").'></div>
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="required">Collection City&nbsp;:&nbsp;</div>
									<div>
										<input type="text" name="collection_city" required="true"'.((isset($_SESSION['collection_city']) AND $_SESSION['collection_city']!='') ? " value='".$_SESSION['collection_city']."'" : "").'>
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="required">Destination City&nbsp;:&nbsp;</div>
									<div>
										<input type="text" name="destination_city" required="true"'.((isset($_SESSION['destination_city']) AND $_SESSION['destination_city']!='') ? " value='".$_SESSION['destination_city']."'" : "").'>
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="required">Shipping method&nbsp;:&nbsp;</div>
									<div>
										<input type="radio" name="ship_method" value="1"'.((isset($_SESSION['ship_method']) AND $_SESSION['ship_method']==1) ? " checked='checked'" : "").' id="ShipMethod1" required="true">&nbsp;<label for="ShipMethod1">Air</label><br>
										<input type="radio" name="ship_method" value="2"'.((isset($_SESSION['ship_method']) AND $_SESSION['ship_method']==2) ? " checked='checked'" : "").' id="ShipMethod2" required="true">&nbsp;<label for="ShipMethod2">Sea</label><br>
										<input type="radio" name="ship_method" value="3"'.((isset($_SESSION['ship_method']) AND $_SESSION['ship_method']==3) ? " checked='checked'" : "").' id="ShipMethod3" required="true">&nbsp;<label for="ShipMethod3">Land</label><br>
										<input type="radio" name="ship_method" value="4"'.((isset($_SESSION['ship_method']) AND $_SESSION['ship_method']==4) ? " checked='checked'" : "").' id="ShipMethod4" required="true">&nbsp;<label for="ShipMethod4">Rail Way</label><br>
										<input type="radio" name="ship_method" value="6"'.((isset($_SESSION['ship_method']) AND $_SESSION['ship_method']==6) ? " checked='checked'" : "").' id="ShipMethod6" required="true">&nbsp;<label for="ShipMethod6">Charter</label><br>
										<input type="radio" name="ship_method" value="5"'.((isset($_SESSION['ship_method']) AND $_SESSION['ship_method']==5) ? " checked='checked'" : "").' id="ShipMethod5" required="true">&nbsp;<label for="ShipMethod5">Not Sure</label>
									</div>
								</div>
							</div>

<script type="text/javascript">
	$(document).ready(function () {
		$("#NextID'.$time.'").click(function(event) {
			$(\'#infoi\').show();
			event.preventDefault();
			var formData = $("#quote_form").serialize();
			
			$.ajax({
				type        : \'POST\', 
				url         : \'ajax_process.php\', 
				data        : formData, 
				dataType    : \'json\', 
				encode          : true
			})
			
			.done(function(data) {
				
				console.log(data); 
				
				if (data.message !="") {
					$(\'#forms\').replaceWith(\'\' + data.message + \'\');
					if (data.status == false) {
						var html = "<div class=\"row\">";
						$.each(data.errors, function(key, value)
						{
							html += "<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\"><div class=\"alert alert-danger\">";
							html += "<span><strong>"+key+"</strong>&nbsp;:&nbsp;</span>";
							html += "<span>"+value+"</span>";
							html += "</div></div>";
						});
						html += "</div>";
						$(\'#forms\').prepend(html);
					}
			$(\'#infoi\').hide();
				}
				
			});

			
		});
	});
</script>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<hr>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
									<div class="pull-left" style="min-width:80%;"><button type="button" class="btn btn-primary" style="min-width:80%;" >I have Tracking Code</button></div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
									<div class="pull-right" style="min-width:80%;"><button type="submit" class="btn btn-primary" style="min-width:80%;" id="NextID'.$time.'">Next</button></div>
								</div>
							</div>
						</form>
						</div>
					</div>
				</div>
';
				$data['status'] = true;
				$data['message'] = $html;
			break;
			case 2:
			if(!isset($_SESSION['collection_pt'])) return;
$html .= '
					<div id="forms">
						<div id="infoi" style="display:none;"><div class="loader"></div></div>
						<div class="progress">
						  <div class="progress-bar  progress-bar-primary" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width:20%">
							Step #2 - 20% complete
						  </div>
						</div>

						<div class="form_header">
							<h1 style="font-size:30px;padding:20px 1em ;">Shipping quote</h1>
						</div>
						<div id="form_body">
						<form id="quote_form" method="post" action="ajax_process.php">
							<input type="hidden" name="step" value="2">
							<div class="row">
								<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
									<div class="required">Collection postcode & town&nbsp;:&nbsp;</div>
									<div>
										<input type="text" name="collection_pt" required="true"'.((isset($_SESSION['collection_pt']) AND $_SESSION['collection_pt']!='') ? " value='".$_SESSION['collection_pt']."'" : "").'>
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="required">Delivery postcode & town&nbsp;:&nbsp;</div>
									<div>
										<input type="text" name="delivery_pt" required="true"'.((isset($_SESSION['delivery_pt']) AND $_SESSION['delivery_pt']!='') ? " value='".$_SESSION['delivery_pt']."'" : "").'>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<hr>
								</div>
							</div>
';							
							if($_SESSION['from_country'] == 'United States' AND $_SESSION['to_country'] == 'Iran'){
								$html .='
							<div class="row">
								<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
									<div class="required">Your Shipper already obtained OFAC license for Export ?&nbsp;</div>
									<div>
										<input type="radio" name="ofac" id="ofac_yes" required="true" value="1" '.(($_SESSION['ofac']==1) ? " checked='checked'" : "").'><label for="ofac_yes">Yes</label>&nbsp;&nbsp;&nbsp;
										<input type="radio" name="ofac" id="ofac_no" required="true" value="0" '.(($_SESSION['ofac']==0) ? " checked='checked'" : "").'><label for="ofac_no">No</label>&nbsp;&nbsp;&nbsp;
									</div>
								</div>
								<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
									<div class="required">Your Shipper already registered with TSA database in USA ?&nbsp;</div>
									<div>
										<input type="radio" name="tsa" id="tsa_yes" required="true" value="1" '.(($_SESSION['tsa']==1) ? " checked='checked'" : "").'><label for="tsa_yes">Yes</label>&nbsp;&nbsp;&nbsp;
										<input type="radio" name="tsa" id="tsa_no" required="true" value="0" '.(($_SESSION['tsa']==0) ? " checked='checked'" : "").'><label for="tsa_no">No</label>&nbsp;&nbsp;&nbsp;
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
									<div  style="width:50%;">
										<div class="required">Would you prefer to transit this order to the destination Via another country ?&nbsp;</div>
										<div>
											<input type="radio" name="other_country" id="other_country_yes" required="true" value="1" '.(($_SESSION['other_country']==1) ? " checked='checked'" : "").'><label for="other_country_yes">Yes</label>&nbsp;&nbsp;&nbsp;
											<input type="radio" name="other_country" id="other_country_no" required="true" value="0"  '.(($_SESSION['other_country']==0) ? " checked='checked'" : "").'><label for="other_country_no">No</label>&nbsp;&nbsp;&nbsp;
										</div>
									</div>
									<div id="second_destination" style="width:50%;display:none;">
										<div class="required">Please Transit Via if possible :&nbsp;</div>
										<div>
											<select id="transit" name="transit" OnChange="HandleTransitSelection();" class="drop_down">
												<option ></option>
												<option value="UAE"'.(($_SESSION['transit']=="UAE") ? " selected" : "").'>UAE</option>
												<option value="Turkey"'.(($_SESSION['transit']=="Turkey") ? " selected" : "").'>Turkey</option>
												<option value="Russia"'.(($_SESSION['transit']=="Russia") ? " selected" : "").'>Russia</option>
												<option value="Oman"'.(($_SESSION['transit']=="Oman") ? " selected" : "").'>Oman</option>
												<option value="Any of above"'.(($_SESSION['transit']=="Any of above") ? " selected" : "").'>Any of above</option>
												<option value="Other"'.(($_SESSION['transit']=="Other") ? " selected" : "").'>Other</option>
											</select>
										</div>
										<div style="display:none;" id="other_transit">
											<div class="required">Please enter the country name :</div>
											<div><input name="other_transit" type="text"'.((isset($_SESSION['other_transit']) AND $_SESSION['other_transit']!='') ? " value='".$_SESSION['other_transit']."'" : "").'></div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<hr>
								</div>
							</div>
';							
							}
							switch($_SESSION['ship_method'])
							{
								case 1: //Air
$html .= '
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
									<div><b>NOTE:</b></div>
									<div>Current AIRFREIGHT transit times:</br><b>3 to 7 days</b> for all destinations.</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
									<div class="required">Air freight delivery&nbsp;:&nbsp;</div>
									<div>
										<input type="radio" name="shipMethod" value="4"'.(($_SESSION['shipMethod']==4) ? " checked='checked'" : "").' id="ShipMethod4" required="true">&nbsp;<label for="ShipMethod4">Airport To Door</label><br>
										<input type="radio" name="shipMethod" value="1"'.(($_SESSION['shipMethod']==1) ? " checked='checked'" : "").' id="ShipMethod1" required="true">&nbsp;<label for="ShipMethod1">Door To Door</label><br>
										<input type="radio" name="shipMethod" value="2"'.(($_SESSION['shipMethod']==2) ? " checked='checked'" : "").' id="ShipMethod2" required="true">&nbsp;<label for="ShipMethod2">Door To Airport</label><br>
										<input type="radio" name="shipMethod" value="3"'.(($_SESSION['shipMethod']==3) ? " checked='checked'" : "").' id="ShipMethod3" required="true">&nbsp;<label for="ShipMethod3">Airport To Airport</label>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
									<div class="required">Terms&nbsp;:&nbsp;</div>
									<div>
										<select id="terms" name="term" class="drop_down" OnChange="HandleAirTermSelection();" required="true">
											<option data-info="" data-content=""></option>
											<option data-info="EX-Work" data-content="Ex works. means that the seller fulfils his obligation to deliver when he has made the goods available at his premises (i.e. works, factory, warehouse, etc) to the buyer. ... The buyer bears all costs and risks involved in taking the goods from the seller\'s premises to the desired destination." value="1"'.(($_SESSION['term']==1) ? " selected" : "").'>EX-Work</option>
											<option data-info="FOB" data-content="«Free on Board» means that the seller delivers when the goods pass the ship\'s rail at the named port of shipment. This means that the buyer has to bear all costs and risks of loss of or damage to the goods from that point. The FOB term requires the seller to clear the goods for export." value="2"'.(($_SESSION['term']==2) ? " selected" : "").'>FOB</option>
											<option data-info="CPT" data-content="«Carriage paid to...» means that the seller pays the freight for the carriage of the goods to the named destination. ... If subsequent carriers are used for the carriage to the agreed destination, the risk passes when the goods have been delivered to the first carrier." value="4"'.(($_SESSION['term']==4) ? " selected" : "").'>CPT</option>
											<option data-info="DDP" data-content="This term means that the seller pays all the costs of transportation (export fees, carriage, insurance, and destination port charges) up to and including the delivery of the goods to the final destination. The buyer is responsible to pay only the import duty/taxes/customs costs." value="5"'.(($_SESSION['term']==5) ? " selected" : "").'>DDP</option>
											<option data-info="DDU" data-content="Delivery Duty Unpaid – Is a fairly common incoterm and can be used for any mode of transport. Under DDU terms the seller is responsible for making the goods available to the buyer at a named place of destination but not cleared for import." value="6"'.(($_SESSION['term']==6) ? " selected" : "").'>DDU</option>
											<option data-info="Other" data-content="Other terms" value="3"'.(($_SESSION['term']==3) ? " selected" : "").'>Other</option>
										</select>
									</div>
									<div style="display:none;" id="other_term">
										<div class="required">Please enter your term :</div>
										<div><input name="other_term" type="text"'.((isset($_SESSION['other_term']) AND $_SESSION['other_term']!='') ? " value='".$_SESSION['other_term']."'" : "").'></div>
									</div>
								</div>
							</div>
';						
									break;
								case 2: //Sea
$html .= '
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
									<div><b>NOTE:</b></div>
									<div>
			Current SEAFREIGHT transit times: (days)</br>
			Africa: 12 to 18</br>
			Australia: 36 to 57</br>
			China: 26 to 42</br>   
			Europe: 7 to 14s</br>
			India: 20 to 35</br> 
			Latin America: 13 to 28</br>
			Middle East: 16 to 38</br>
			North America: 10</br></div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
									<div class="required">Container specification&nbsp;:&nbsp;</div>
									<div>
										<input type="radio" name="containerType" value="1"'.(($_SESSION['containerType']==1) ? " checked='checked'" : "").' id="containerType1" required="true" OnClick="HandleFCLSelection(1);">&nbsp;<label for="containerType1">FCL (Full Container Load)</label><br>
										<input type="radio" name="containerType" value="2"'.(($_SESSION['containerType']==2) ? " checked='checked'" : "").' id="containerType2" required="true" OnClick="HandleFCLSelection(0);">&nbsp;<label for="containerType2">LCL (Less > Container Load)</label><br>
										<input type="radio" name="containerType" value="3"'.(($_SESSION['containerType']==3) ? " checked='checked'" : "").' id="containerType3" required="true" OnClick="HandleFCLSelection(0);">&nbsp;<label for="containerType3">Not Sure</label>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
									<div class="required">Air freight delivery&nbsp;:&nbsp;</div>
									<div>
										<input type="radio" name="shipMethod" value="1"'.(($_SESSION['shipMethod']==1) ? " checked='checked'" : "").' id="ShipMethod1" required="true">&nbsp;<label for="ShipMethod1">Door To Door</label><br>
										<input type="radio" name="shipMethod" value="2"'.(($_SESSION['shipMethod']==2) ? " checked='checked'" : "").' id="ShipMethod2" required="true">&nbsp;<label for="ShipMethod2">Door To Port</label><br>
										<input type="radio" name="shipMethod" value="3"'.(($_SESSION['shipMethod']==3) ? " checked='checked'" : "").' id="ShipMethod3" required="true">&nbsp;<label for="ShipMethod3">Port To Port</label><br>
										<input type="radio" name="shipMethod" value="4"'.(($_SESSION['shipMethod']==4) ? " checked='checked'" : "").' id="ShipMethod4" required="true">&nbsp;<label for="ShipMethod4">Port To Door</label>
									</div>
								</div>
							</div>
							<div class="row" id="fcl_div" style="display:none;">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<hr>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
									<div class="required">Nmber of containers (Default is 1)&nbsp;:&nbsp;</div>
									<div ><input name="containerCount" type="number" value="'.((isset($_SESSION['containerCount']) AND $_SESSION['containerCount']!='') ? $_SESSION['containerCount'] : "1").'"></div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
									<div class="required">FCL (Full Container Load)&nbsp;:&nbsp;</div>
									<div >
										<input type="radio" name="FCLType" value="1"'.(($_SESSION['FCLType']==1) ? " checked='checked'" : "").' id="FCLType1">&nbsp;<label for="FCLType1">20 ft container</label><br>
										<input type="radio" name="FCLType" value="2"'.(($_SESSION['FCLType']==2) ? " checked='checked'" : "").' id="FCLType2">&nbsp;<label for="FCLType2">40 ft container</label><br>
										<input type="radio" name="FCLType" value="3"'.(($_SESSION['FCLType']==3) ? " checked='checked'" : "").' id="FCLType3">&nbsp;<label for="FCLType3">40 ft high cube container</label>
									</div>
								</div>
							</div>
';
									break;
								case 3: //Land
$html .= '
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
									<div class="required">Land shipping&nbsp;:&nbsp;</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
									<div><input type="radio" name="containerType" value="1"'.(($_SESSION['containerType']==1) ? " checked='checked'" : "").' id="containerType1" required="true">&nbsp;<label for="containerType1">FTL (Full Truck Load)</label></div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
									<div><input type="radio" name="containerType" value="2"'.(($_SESSION['containerType']==2) ? " checked='checked'" : "").' id="containerType2" required="true">&nbsp;<label for="containerType2">LTL (Less > Truck Load)</label></div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
									<div><input type="radio" name="containerType" value="3"'.(($_SESSION['containerType']==3) ? " checked='checked'" : "").' id="containerType3" required="true">&nbsp;<label for="containerType3">Not Sure</label></div>
								</div>
							</div>
';						
									break;
							}
$html .= '


<script type="text/javascript">
	$(document).ready(function () {
		$("input[name=other_country]").on("change", function (event)
		{
            var radioValue = $("input[name=\'other_country\']:checked").val();
            if(radioValue == 1){
                
				$("#second_destination").show();
            }
			else
				$("#second_destination").hide();
				
		});
		$("#PreviousID'.$time.'").click(function(event) {
			$(\'#infoi\').show();
			var step = parseInt( $("#quote_form input[name=step]").val() ) - 1;
			
			$.ajax({
				type        : \'POST\', 
				url         : \'ajax_process.php?cmd=previous\', 
				data        : "step="+step, 
				dataType    : \'json\', 
				encode          : true
			})
			
			.done(function(data) {
				
				console.log(data); 
				
				if (data.message !=\'\') {
					$(\'#forms\').replaceWith(\'\' + data.message + \'\');
					if (data.status == false) {
						var html = "<div class=\"row\">";
						$.each(data.errors, function(key, value)
						{
							html += "<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\"><div class=\"alert alert-danger\">";
							html += "<span><strong>"+key+"</strong>&nbsp;:&nbsp;</span>";
							html += "<span>"+value+"</span>";
							html += "</div></div>";
						});
						html += "</div>";
						$(\'#forms\').prepend(html);
					}
			$(\'#infoi\').hide();
				}
				
			});

			
			event.preventDefault();
		});
		$("#NextID'.$time.'").click(function(event) {
			$(\'#infoi\').show();
			event.preventDefault();
			var formData = $("#quote_form").serialize();
			
			$.ajax({
				type        : \'POST\', 
				url         : \'ajax_process.php\', 
				data        : formData, 
				dataType    : \'json\', 
				encode          : true
			})
			
			.done(function(data) {
				
				console.log(data); 
				
				if (data.message !="") {
					$(\'#forms\').replaceWith(\'\' + data.message + \'\');
					if (data.status == false) {
						var html = "<div class=\"row\">";
						$.each(data.errors, function(key, value)
						{
							html += "<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\"><div class=\"alert alert-danger\">";
							html += "<span><strong>"+key+"</strong>&nbsp;:&nbsp;</span>";
							html += "<span>"+value+"</span>";
							html += "</div></div>";
						});
						html += "</div>";
						$(\'#forms\').prepend(html);
					}
			$(\'#infoi\').hide();
				}
				
			});

			
		});
	});
	
	
$(function () {
    $("select[name=term]").on("change", onChange);
    $("select[name=term]").on("focus", function() {
        $(this).popover(\'destroy\')
    });
});

function onChange() {
    var $this = $(this);
    var $e = $(this.target);
    $(\'#terms\').popover(\'destroy\');
	if($this.children(\'option:selected\').attr("data-info") !==\'\'){
		
		$("#terms").popover({
			title:$this.children(\'option:selected\').attr("data-info"),
			trigger: \'manual\',
			placement: \'right\',
			animation: true,
			content: $this.children(\'option:selected\').attr("data-content")
		}).popover(\'show\');
		$this.blur();
	}
}
</script>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<hr>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
									<div class="pull-left" style="min-width:80%;"><button type="button" class="btn btn-primary" style="min-width:80%;" id="PreviousID'.$time.'">Previous</button></div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
									<div class="pull-right" style="min-width:80%;"><button type="submit" class="btn btn-primary" style="min-width:80%;" id="NextID'.$time.'">Next</button></div>
								</div>
							</div>
						</form>
						</div>
					</div>
				</div>
';

				$data['status'] = true;
				$data['message'] = $html;
			break;
			case 3:
			case 32:
			if(!isset($_SESSION['dg'])) return;
			//var_dump($_SESSION['insurance']);
$html .= '

					<div id="forms">
						<div id="infoi" style="display:none;"><div class="loader"></div></div>
						<div class="progress">
						  <div class="progress-bar  progress-bar-primary" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:40%">
							Step #3 - 40% complete
						  </div>
						</div>

						<div class="form_header">
							<h1 style="font-size:30px;padding:20px 1em ;">Shipping quote</h1>
						</div>
						<div id="form_body">
						<form id="quote_form" method="post" action="ajax_process.php">
							<input type="hidden" name="step" value="3">
';
if(!(isset($_SESSION['containerType']) AND $_SESSION['containerType']==3))
{
	$html .='

<script type="text/javascript"> 
			$(document).ready(function () {
					var scntDiv = $(\'#dimsID\');
					var i = $(\'#dimsID div.dims\').size() + 1;
					
					$(\'#addScnt\').on(\'click\', \'img\', function() {
						//alert("yes");
						$(\'<div class="dims"><div class="col-xs-7 col-sm-6 col-md-6 col-lg-6"><input type="text" name="dims[]" size="25" maxlength="50"></div><div class="col-xs-3 col-sm-4 col-md-4 col-lg-4"><input type="text" name="weights[]" size="6" maxlength="6"></div><div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div></div>\').appendTo(scntDiv);
						i++;
						return false;
					});
			});
			
</script>
							<div class="row">
								<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
									<div class="required">Nmber of items&nbsp;:&nbsp;</div>
									<div>
										<input type="number" name="itemCount" id="itemCount"'.((isset($_SESSION['itemCount']) AND $_SESSION['itemCount']!='') ? " value='".$_SESSION['itemCount']."'" : "").'>
									</div>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
									<div class="row required">
										<div class="col-xs-9 col-sm-8 col-md-8 col-lg-8">
											Dimension LxWxH cm (Approx.)
										</div>
										<div class="col-xs-3 col-sm-4 col-md-4 col-lg-4">
											Weight Kg (Approx.)
										</div>
									</div>
									<div class="row" id="dimsID">
';
if(isset($_SESSION['dims']) AND $_SESSION['dims']!='')
{
	foreach($_SESSION['dims'] as $k=>$v)
	{
$html .= '
										<div class="dims">
											<div class="col-xs-8 col-sm-7 col-md-7 col-lg-7"><input type="text" name="dims[]" size="25" maxlength="50" value="'.$v.'"></div>
											<div class="col-xs-3 col-sm-4 col-md-4 col-lg-4"><input type="text" name="weights[]" size="6" maxlength="6" value="'.$_SESSION['weights'][$k].'"></div>
											<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
												<a href="#" id="addScnt"><img src="https://bookingparcel.com/images/add.png"></a>
												<a href="#" id="remScnt"><img src="https://bookingparcel.com/images/delete.png"></a>
											</div>
										</div>
';
	}
}
$html .= '
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<hr>
								</div>
							</div>
	';
}
$html .='
							<div class="row">
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="">Total weight in kg (Approx.)&nbsp;:&nbsp;</div>
									<div>
										<input type="text" name="t_weight" id="t_weight"'.((isset($_SESSION['t_weight']) AND $_SESSION['t_weight']!='') ? " value='".$_SESSION['t_weight']."'" : "").'>
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="">Are the boxes/Pallets stackable ?</div>
									<div>
										<input type="radio" name="stackable" value="1" id="stackable1"'.(($_SESSION['stackable']==1) ? " checked='checked'" : "").'>&nbsp;<label for="stackable1">Yes</label><br>
										<input type="radio" name="stackable" value="2" id="stackable2"'.(($_SESSION['stackable']==2) ? " checked='checked'" : "").'>&nbsp;<label for="stackable2">No</label>
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="">Do you need shipping insurance?</div>
									<div>
										<input type="radio" name="insurance" value="1" id="insurance1"'.(($_SESSION['insurance']==1) ? " checked='checked'" : "").'>&nbsp;<label for="insurance1">Yes</label><br>
										<input type="radio" name="insurance" value="2" id="insurance2"'.(($_SESSION['insurance']==2) ? " checked='checked'" : "").'>&nbsp;<label for="insurance2">No</label><br>
										<input type="radio" name="insurance" value="3" id="insurance3"'.(($_SESSION['insurance']==3) ? " checked='checked'" : "").'>&nbsp;<label for="insurance3">Not sure</label>
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="required">Shipment description and commodity name:&nbsp;</div>
									<div>
										<textarea name="desc" rows="6" cols="21">'.((isset($_SESSION['desc']) AND $_SESSION['desc']!='') ? "".$_SESSION['desc']."" : "").'</textarea>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<hr>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
									<div class="required">Is there any lithium battery in your cargo?</div>
									<div>
										<input type="radio" name="lithium" value="1" id="lithium1"'.(($_SESSION['lithium']==1) ? " checked='checked'" : "").'>&nbsp;<label for="lithium1">Yes</label><br>
										<input type="radio" name="lithium" value="2" id="lithium2"'.(($_SESSION['lithium']==2) ? " checked='checked'" : "").'>&nbsp;<label for="lithium2">No</label>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
									<div class="required">Is there any liquid, gas or chemicals inside of your cargo?</div>
									<div>
										<input type="radio" name="chemicals" value="1" id="chemicals1"'.(($_SESSION['chemicals']==1) ? " checked='checked'" : "").'>&nbsp;<label for="chemicals1">Yes</label><br>
										<input type="radio" name="chemicals" value="2" id="chemicals2"'.(($_SESSION['chemicals']==2) ? " checked='checked'" : "").'>&nbsp;<label for="chemicals2">No</label>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
									<div class="required">Is it your cargo DG (Dangerous Goods)?</div>
									<div>
										<input type="radio" name="dg" value="1" id="dg1"'.(($_SESSION['dg']==1) ? " checked='checked'" : "").'>&nbsp;<label for="dg1">Yes</label><br>
										<input type="radio" name="dg" value="2" id="dg2"'.(($_SESSION['dg']==2) ? " checked='checked'" : "").'>&nbsp;<label for="dg2">No</label>
									</div>
								</div>
							</div>


<script type="text/javascript">
	$(document).ready(function () {
		$("#PreviousID'.$time.'").click(function(event) {
			$(\'#infoi\').show();
			var step = parseInt( $("#quote_form input[name=step]").val() ) - 1;
			
			$.ajax({
				type        : \'POST\', 
				url         : \'ajax_process.php?cmd=previous\', 
				data        : "step="+step, 
				dataType    : \'json\', 
				encode          : true
			})
			
			.done(function(data) {
				
				console.log(data); 
				
				if (data.message !=\'\') {
					$(\'#forms\').replaceWith(\'\' + data.message + \'\');
					if (data.status == false) {
						var html = "<div class=\"row\">";
						$.each(data.errors, function(key, value)
						{
							html += "<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\"><div class=\"alert alert-danger\">";
							html += "<span><strong>"+key+"</strong>&nbsp;:&nbsp;</span>";
							html += "<span>"+value+"</span>";
							html += "</div></div>";
						});
						html += "</div>";
						$(\'#forms\').prepend(html);
					}
			$(\'#infoi\').hide();
				}
				
			});

			
			event.preventDefault();
		});
		$("#NextID'.$time.'").click(function(event) {
			$(\'#infoi\').show();
			event.preventDefault();
			var formData = $("#quote_form").serialize();
			
			$.ajax({
				type        : \'POST\', 
				url         : \'ajax_process.php\', 
				data        : formData, 
				dataType    : \'json\', 
				encode          : true
			})
			
			.done(function(data) {
				
				console.log(data); 
				
				if (data.message !="") {
					$(\'#forms\').replaceWith(\'\' + data.message + \'\');
					if (data.status == false) {
						var html = "<div class=\"row\">";
						$.each(data.errors, function(key, value)
						{
							html += "<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\"><div class=\"alert alert-danger\">";
							html += "<span><strong>"+key+"</strong>&nbsp;:&nbsp;</span>";
							html += "<span>"+value+"</span>";
							html += "</div></div>";
						});
						html += "</div>";
						$(\'#forms\').prepend(html);
					}
			$(\'#infoi\').hide();
				}
				
			});

			
		});
	});
</script>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<hr>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
									<div class="pull-left" style="min-width:80%;"><button type="button" class="btn btn-primary" style="min-width:80%;" id="PreviousID'.$time.'">Previous</button></div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
									<div class="pull-right" style="min-width:80%;"><button type="submit" class="btn btn-primary" style="min-width:80%;" id="NextID'.$time.'">Next</button></div>
								</div>
							</div>
						</form>
						</div>
					</div>
				</div>
';
				$data['status'] = true;
				$data['message'] = $html;
			break;
			case 4:
			if(!isset($_SESSION['account'])) return;
			
$html .= '
					<div id="forms">
						<div id="infoi" style="display:none;"><div class="loader"></div></div>
						<div class="progress">
						  <div class="progress-bar  progress-bar-primary" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:60%">
							Step #4 - 60% complete
						  </div>
						</div>

						<div class="form_header">
							<h1 style="font-size:30px;padding:20px 1em ;">Shipping quote</h1>
						</div>
						<div id="form_body">
						<form id="quote_form" method="post" action="ajax_process.php">
							<input type="hidden" name="step" value="4">
							<div class="row">
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class=""><b>Note:</b></div>
									<div>The following contact details are for pricing only, and wont be used for shipping documents.</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="required">Note: having account in <a href="http://cp.bookingparcel.com">User Panel</a> gives you some options such as ticketing and easily tracking and some more.<br>It is not necessary to have account but it is highly recommended.</div>
									<div>
										<input type="radio" name="account" value="1"'.(($_SESSION['account']==1) ? " checked='checked'" : "").' id="account1">&nbsp;<label for="account1">I have account in <a href="http://cp.bookingparcel.com">User Panel</a> .</label><br>
										<input type="radio" name="account" value="2"'.(($_SESSION['account']==2) ? " checked='checked'" : "").' id="account2">&nbsp;<label for="account2">I don\'t have account in <a href="http://cp.bookingparcel.com">User Panel</a> .</label>
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="required">Preferred method of contact:&nbsp;</div>
									<div>
										<input type="radio" name="contactMethod" value="1"'.(($_SESSION['contactMethod']==1) ? " checked='checked'" : "").' id="contactMethod1">&nbsp;<label for="contactMethod1">Email</label><br>
										<input type="radio" name="contactMethod" value="2"'.(($_SESSION['contactMethod']==2) ? " checked='checked'" : "").' id="contactMethod2">&nbsp;<label for="contactMethod2">Phone</label><br>
										<input type="radio" name="contactMethod" value="3"'.(($_SESSION['contactMethod']==3) ? " checked='checked'" : "").' id="contactMethod3">&nbsp;<label for="contactMethod3">Any of above</label>
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="required">Preferred time of contact:&nbsp;</div>
									<div>
										<input type="radio" name="contactTime" value="1"'.(($_SESSION['contactTime']==1) ? " checked='checked'" : "").' id="contactTime1">&nbsp;<label for="contactTime1">Anytime</label><br>
										<input type="radio" name="contactTime" value="2"'.(($_SESSION['contactTime']==2) ? " checked='checked'" : "").' id="contactTime2">&nbsp;<label for="contactTime2">In the morning</label><br>
										<input type="radio" name="contactTime" value="3"'.(($_SESSION['contactTime']==3) ? " checked='checked'" : "").' id="contactTime3">&nbsp;<label for="contactTime3">In the afternoon</label><br>
										<input type="radio" name="contactTime" value="4"'.(($_SESSION['contactTime']==4) ? " checked='checked'" : "").' id="contactTime4">&nbsp;<label for="contactTime4">In the evening</label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<hr>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="">E-mail for receive invoice :</div>
									<div><input type="email" name="invoiceEmail"'.((isset($_SESSION['invoiceEmail']) AND $_SESSION['invoiceEmail']!='') ? " value='".$_SESSION['invoiceEmail']."'" : "").'></div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="">E-mail for receive quote :</div>
									<div><input type="email" name="quoteEmail"'.((isset($_SESSION['quoteEmail']) AND $_SESSION['quoteEmail']!='') ? " value='".$_SESSION['quoteEmail']."'" : "").'></div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="">E-mail for receive prealert :</div>
									<div><input type="email" name="prealertEmail"'.((isset($_SESSION['prealertEmail']) AND $_SESSION['prealertEmail']!='') ? " value='".$_SESSION['prealertEmail']."'" : "").'></div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="">Other CC Email address :</div>
									<div>
									(1):<input type="email" name="cc1"'.((isset($_SESSION['cc1']) AND $_SESSION['cc1']!='') ? " value='".$_SESSION['cc1']."'" : "").'><br>
									(2):<input type="email" name="cc2"'.((isset($_SESSION['cc2']) AND $_SESSION['cc2']!='') ? " value='".$_SESSION['cc2']."'" : "").'><br>
									(3):<input type="email" name="cc3"'.((isset($_SESSION['cc3']) AND $_SESSION['cc3']!='') ? " value='".$_SESSION['cc3']."'" : "").'><br>
									(4):<input type="email" name="cc4"'.((isset($_SESSION['cc4']) AND $_SESSION['cc4']!='') ? " value='".$_SESSION['cc4']."'" : "").'><br>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<hr>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-4 col-md-5 col-lg-5">
									<div class="">your order reference number&nbsp;:</div>
									<div><input type="text" name="orderReference"'.((isset($_SESSION['orderReference']) AND $_SESSION['orderReference']!='') ? " value='".$_SESSION['orderReference']."'" : "").'></div>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-7 col-lg-7">
									<div class="">Note - Goods value:</div>
									<div><textarea name="note" rows="6" cols="21">'.((isset($_SESSION['note']) AND $_SESSION['note']!='') ? "".$_SESSION['note']."" : "").'</textarea></div>
								</div>
							</div>

<script type="text/javascript">
	$(document).ready(function () {
		$("#PreviousID'.$time.'").click(function(event) {
			$(\'#infoi\').show();
			var step = parseInt( $("#quote_form input[name=step]").val() ) - 1;
			
			$.ajax({
				type        : \'POST\', 
				url         : \'ajax_process.php?cmd=previous\', 
				data        : "step="+step, 
				dataType    : \'json\', 
				encode          : true
			})
			
			.done(function(data) {
				
				console.log(data); 
				
				if (data.message !=\'\') {
					$(\'#forms\').replaceWith(\'\' + data.message + \'\');
					if (data.status == false) {
						var html = "<div class=\"row\">";
						$.each(data.errors, function(key, value)
						{
							html += "<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\"><div class=\"alert alert-danger\">";
							html += "<span><strong>"+key+"</strong>&nbsp;:&nbsp;</span>";
							html += "<span>"+value+"</span>";
							html += "</div></div>";
						});
						html += "</div>";
						$(\'#forms\').prepend(html);
					}
			$(\'#infoi\').hide();
				}
				
			});

			
			event.preventDefault();
		});
		$("#NextID'.$time.'").click(function(event) {
			$(\'#infoi\').show();
			event.preventDefault();
			var formData = $("#quote_form").serialize();
			
			$.ajax({
				type        : \'POST\', 
				url         : \'ajax_process.php\', 
				data        : formData, 
				dataType    : \'json\', 
				encode          : true
			})
			
			.done(function(data) {
				
				console.log(data); 
				
				if (data.message !="") {
					$(\'#forms\').replaceWith(\'\' + data.message + \'\');
					if (data.status == false) {
						var html = "<div class=\"row\">";
						$.each(data.errors, function(key, value)
						{
							html += "<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\"><div class=\"alert alert-danger\">";
							html += "<span><strong>"+key+"</strong>&nbsp;:&nbsp;</span>";
							html += "<span>"+value+"</span>";
							html += "</div></div>";
						});
						html += "</div>";
						$(\'#forms\').prepend(html);
					}
			$(\'#infoi\').hide();
				}
				
			});

			
		});
	});
</script>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<hr>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
									<div class="pull-left" style="min-width:80%;"><button type="button" class="btn btn-primary" style="min-width:80%;" id="PreviousID'.$time.'">Previous</button></div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
									<div class="pull-right" style="min-width:80%;"><button type="submit" class="btn btn-primary" style="min-width:80%;" id="NextID'.$time.'">Next</button></div>
								</div>
							</div>
						</form>
						</div>
					</div>
				</div>
';
				$data['status'] = true;
				$data['message'] = $html;
			break;
		}
	}
}
elseif(isset($_GET['cmd']) AND $_GET['cmd']=='files')
{
	if(!isset($_SESSION['dg'])) return;
    $files = array();

	$locations = __DIR__ . DIRECTORY_SEPARATOR  ."Documents" . DIRECTORY_SEPARATOR . time() . DIRECTORY_SEPARATOR  ."";
	
	if(!is_dir($locations))
	{
		mkdir($locations, 0755, true);
	}
	
	$_c = 0;
	if(isset($_FILES['file']['name']) AND is_array($_FILES['file']['name']) AND count($_FILES['file']['name'])>0){
		unset($_SESSION['attachments']);
		foreach($_FILES['file']['name'] as $k => $upload){
			if(isset($_FILES['file']['name'][$k]) AND $_FILES['file']['name'][$k] !="" AND $_FILES['file']['name'][$k]!=null){
				$_c++;
				$target_dir = $locations;
				
				$target_file = $target_dir . basename($_FILES['file']['name'][$k]);
				$uploadOk = 1;
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				$format = explode(".",basename($_FILES['file']['name'][$k]));
				$format = strtolower($format[(count($format)-1)]);
				$filename = basename($_FILES['file']['name'][$k]);
				if($file["size"] > 52428801) {
					$errors['upload'] .= basename( $_FILES['file']['name'][$k])." Invalid file size<br>";
					$uploadOk = 0;
				} elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "rtf" && $imageFileType != "zip" && $imageFileType != "pdf" && $imageFileType != "doc" && $imageFileType != "docx" && $imageFileType != "xls" && $imageFileType != "xlsx") {
					$errors['upload'] .= basename( $_FILES['file']['name'][$k])." Invalid file format<br>";
					$uploadOk = 0;
				} 
				if ($uploadOk == 0) {
					$errors['upload'] .= basename( $_FILES['file']['name'][$k])." Sorry, your file was not uploaded.<br>";
				} else {
					if (move_uploaded_file($_FILES['file']['tmp_name'][$k], $target_file)) {
						$_SESSION['attachments'][] = $target_file;
						//$html .="yes";
					}
				}
			}
			else
			{
				$errors['upload'] .= basename( $_FILES['file']['name'][$k])." Invalid file name or not selected<br>";
			}
		}
	}
	if(count($_SESSION['attachments']) == $_c)
	{
		$_SESSION['locations'] = $locations;
	}
	
	if(!(isset($_POST['terms']) AND is_numeric($_POST['terms']) AND in_array($_POST['terms'],$terms)))
	{
		$errors['terms'] = "invalid terms data.";
	}
	if(!(isset($_POST['un']) AND trim($_POST['un'])!='' AND $_POST['un']!=null))
	{
		$errors['un'] = "invalid un data.";
	}
	if(!(isset($_POST['class']) AND trim($_POST['class'])!='' AND $_POST['class']!=null))
	{
		$errors['class'] = "invalid class data.";
	}
	if(!(isset($_POST['instruction']) AND trim($_POST['instruction'])!='' AND $_POST['instruction']!=null))
	{
		$errors['instruction'] = "invalid instruction data.";
	}
	

if ( ! empty($errors)) {

$html .= '
<script type="text/javascript"> 
			$(document).ready(function () {
					var scntDiv = $(\'#msdsID\');
					var i = $(\'#msdsID div.msds\').size() + 1;
					
					$(\'#addScntmsds\').on(\'click\', \'img\', function() {
						//alert("yes");
						$(\'<div class="msds"><div class="col-xs-11 col-sm-10 col-md-10 col-lg-10"><input type="file" name="file[]" size="25" maxlength="50"></div><div class="col-xs-1 col-sm-2 col-md-2 col-lg-2"><a href="#" id="addScntmsds"><img src="https://bookingparcel.com/images/add.png"></a></div></div>\').appendTo(scntDiv);
						i++;
						return false;
					});
			});
			
</script>
					<div id="forms">
						<div id="infoi" style="display:none;"><div class="loader"></div></div>
						<div class="progress">
						  <div class="progress-bar  progress-bar-primary" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:50%">
							Step #3B - 50% complete
						  </div>
						</div>

						<div class="form_header">
							<h1 style="font-size:30px;padding:20px 1em ;">Shipping quote</h1>
						</div>
						<div id="form_body">
						<form id="upload_form" method="post" action="ajax_process.php">
							<input type="hidden" name="step" value="33">';
if($_SESSION['dg']==1)
{
$html .= '
							<div class="row">
								<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
									<div class="required'.($errors['terms']!='' ? " error" : "").'">Aircraft Type :</div>
									<div>
										<select id="terms" name="terms" class="drop_down">
											<option></option>
											<option value="0">PAX</option>
											<option value="1">CAO</option>
											<option value="2">Not Sure</option>
										</select>
									</div>
								</div>
								<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
									<div class="required'.(($errors['un']!='' or $errors['class']!='') ? " error" : "").'">UN Number & Classification :</div>
									<div><input name="un" type="text" size="10" maxlength="255" placeholder="UN number"><input name="class" type="text" size="12" maxlength="255" placeholder="classification"></div>
								</div>
								<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
									<div class="required'.($errors['instruction']!='' ? " error" : "").'">Packing Instruction :</div>
									<div><textarea name="instruction" rows="6" cols="21"></textarea></div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<hr>
								</div>
							</div>
';
}
$html .= '
							<div class="row">
								<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
									<div class="row required'.($errors['upload']!='' ? " error" : "").'">
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
											MSDS files :
										</div>
									</div>
									<div class="row" id="msdsID">
										<div class="msds">
											<div class="col-xs-11 col-sm-10 col-md-10 col-lg-10"><input type="file" name="file[]" size="25" maxlength="50"></div>
											<div class="col-xs-1 col-sm-2 col-md-2 col-lg-2">
												<a href="#" id="addScntmsds"><img src="https://bookingparcel.com/images/add.png"></a>
											</div>
										</div>
									</div>
								</div>
							</div>
<script type="text/javascript">
	$(document).ready(function () {
		$("#PreviousID'.$time.'").click(function(event) {
			$(\'#infoi\').show();
			var step = parseInt( $("#upload_form input[name=step]").val() ) - 1;
			
			$.ajax({
				type        : \'POST\', 
				url         : \'ajax_process.php?cmd=previous\', 
				data        : "step="+step, 
				dataType    : \'json\', 
				encode          : true
			})
			
			.done(function(data) {
				
				console.log(data); 
				
				if (data.message !=\'\') {
					$(\'#forms\').replaceWith(\'\' + data.message + \'\');
					if (data.status == false) {
						var html = "<div class=\"row\">";
						$.each(data.errors, function(key, value)
						{
							html += "<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\"><div class=\"alert alert-danger\">";
							html += "<span><strong>"+key+"</strong>&nbsp;:&nbsp;</span>";
							html += "<span>"+value+"</span>";
							html += "</div></div>";
						});
						html += "</div>";
						$(\'#forms\').prepend(html);
					}
			$(\'#infoi\').hide();
				}
				
			});

			
			event.preventDefault();
		});
		//var files;
		//$(\'input[type=file]\').on(\'change\', function (event)
		//{
		 // files = event.target.files;
		//});
		$("#NextID'.$time.'").click( function (event)
		{
			$(\'#infoi\').show();
			event.stopPropagation(); // Stop stuff happening
			event.preventDefault(); // Totally stop stuff happening

			// START A LOADING SPINNER HERE

			// Create a formdata object and add the files
			//var data = new FormData();
			//$.each(files, function(key, value)
			//{
			//	data.append(key, value);
			//});
			var form = $("#upload_form");
			var formData = new FormData($(this).parents(\'form\')[0]);
			
			$.ajax({
				url: \'ajax_process.php?cmd=files\',
				type: \'POST\',
				data: formData,
				cache: false,
				dataType: \'json\',
				processData: false, // Don\'t process the files
				contentType: false, // Set content type to false as jQuery will tell the server its a query string request
				xhr: function() {
					var myXhr = $.ajaxSettings.xhr();
					return myXhr;
				},
				success: function(data, textStatus, jqXHR)
				{
					if(typeof data.error === \'undefined\')
					{
					}
					else
					{
						// Handle errors here
						console.log(\'ERRORS: \' + data.error);
					}
				},
				error: function(jqXHR, textStatus, errorThrown)
				{
					// Handle errors here
					console.log(\'ERRORS: \' + textStatus);
					// STOP LOADING SPINNER
				}
			})
			
			.done(function(data) {
				
				console.log(data); 
				
				if (data.message !=\'\') {
					$(\'#forms\').replaceWith(\'\' + data.message + \'\');
					if (data.status == false) {
						var html = "<div class=\"row\">";
						$.each(data.errors, function(key, value)
						{
							html += "<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\"><div class=\"alert alert-danger\">";
							html += "<span><strong>"+key+"</strong>&nbsp;:&nbsp;</span>";
							html += "<span>"+value+"</span>";
							html += "</div></div>";
						});
						html += "</div>";
						$(\'#forms\').prepend(html);
					}
			$(\'#infoi\').hide();
				}
				
			});
			return false;
		});
	});
	
</script>


							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<hr>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
									<div class="pull-left" style="min-width:80%;"><button type="button" class="btn btn-primary" style="min-width:80%;" id="PreviousID'.$time.'">Previous</button></div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
									<div class="pull-right" style="min-width:80%;"><button type="submit" class="btn btn-primary" style="min-width:80%;" id="NextID'.$time.'">Next</button></div>
								</div>
							</div>
						</form>
						</div>
					</div>
				</div>
';
	// if there are items in our errors array, return those errors
	$data['status'] = false;
	$data['errors']  = $errors;
	$data['message'] = $html;
}
else {
	$_SESSION['terms'] = $_POST['terms'];
	$_SESSION['un'] = $_POST['un'];
	$_SESSION['class'] = $_POST['class'];
	$_SESSION['instruction'] = $_POST['instruction'];
$html .= '
					<div id="forms">
						<div id="infoi" style="display:none;"><div class="loader"></div></div>
						<div class="progress">
						  <div class="progress-bar  progress-bar-primary" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:60%">
							Step #4 - 60% complete
						  </div>
						</div>

						<div class="form_header">
							<h1 style="font-size:30px;padding:20px 1em ;">Shipping quote</h1>
						</div>
						<div id="form_body">
						<form id="quote_form" method="post" action="ajax_process.php">
							<input type="hidden" name="step" value="4">
							<div class="row">
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class=""><b>Note:</b></div>
									<div>The following contact details are for pricing only, and wont be used for shipping documents.</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="required">Note: having account in <a href="http://cp.bookingparcel.com">User Panel</a> gives you some options such as ticketing and easily tracking and some more.<br>It is not necessary to have account but it is highly recommended.</div>
									<div>
										<input type="radio" name="account" value="1" id="account1">&nbsp;<label for="account1">I have account in <a href="http://cp.bookingparcel.com">User Panel</a> .</label><br>
										<input type="radio" name="account" value="2" id="account2">&nbsp;<label for="account2">I don\'t have account in <a href="http://cp.bookingparcel.com">User Panel</a> .</label>
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="required">Preferred method of contact:&nbsp;</div>
									<div>
										<input type="radio" name="contactMethod" value="1" id="contactMethod1">&nbsp;<label for="contactMethod1">Email</label><br>
										<input type="radio" name="contactMethod" value="2" id="contactMethod2">&nbsp;<label for="contactMethod2">Phone</label><br>
										<input type="radio" name="contactMethod" value="3" id="contactMethod3">&nbsp;<label for="contactMethod3">Any of above</label>
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="required">Preferred time of contact:&nbsp;</div>
									<div>
										<input type="radio" name="contactTime" value="1" id="contactTime1">&nbsp;<label for="contactTime1">Anytime</label><br>
										<input type="radio" name="contactTime" value="2" id="contactTime2">&nbsp;<label for="contactTime2">In the morning</label><br>
										<input type="radio" name="contactTime" value="3" id="contactTime3">&nbsp;<label for="contactTime3">In the afternoon</label><br>
										<input type="radio" name="contactTime" value="4" id="contactTime4">&nbsp;<label for="contactTime4">In the evening</label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<hr>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="">E-mail for receive invoice :</div>
									<div><input type="email" name="invoiceEmail"></div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="">E-mail for receive quote :</div>
									<div><input type="email" name="quoteEmail"></div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="">E-mail for receive prealert :</div>
									<div><input type="email" name="prealertEmail"></div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="">Other CC Email address :</div>
									<div>
									(1):<input type="email" name="cc1"><br>
									(2):<input type="email" name="cc2"><br>
									(3):<input type="email" name="cc3"><br>
									(4):<input type="email" name="cc4"><br>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<hr>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-4 col-md-5 col-lg-5">
									<div class="">your order reference number&nbsp;:</div>
									<div><input type="text" name="orderReference"></div>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-7 col-lg-7">
									<div class="">Note - Goods value:</div>
									<div><textarea name="note" rows="6" cols="21"></textarea></div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<hr>
								</div>
							</div>

<script type="text/javascript">
	$(document).ready(function () {
		$("#PreviousID'.$time.'").click(function(event) {
			$(\'#infoi\').show();
			var step = parseInt( $("#quote_form input[name=step]").val() ) - 1;
			
			$.ajax({
				type        : \'POST\', 
				url         : \'ajax_process.php?cmd=previous\', 
				data        : "step="+step, 
				dataType    : \'json\', 
				encode          : true
			})
			
			.done(function(data) {
				
				console.log(data); 
				
				if (data.message !=\'\') {
					$(\'#forms\').replaceWith(\'\' + data.message + \'\');
					if (data.status == false) {
						var html = "<div class=\"row\">";
						$.each(data.errors, function(key, value)
						{
							html += "<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\"><div class=\"alert alert-danger\">";
							html += "<span><strong>"+key+"</strong>&nbsp;:&nbsp;</span>";
							html += "<span>"+value+"</span>";
							html += "</div></div>";
						});
						html += "</div>";
						$(\'#forms\').prepend(html);
					}
			$(\'#infoi\').hide();
				}
				
			});

			
			event.preventDefault();
		});
		$("#NextID'.$time.'").click(function(event) {
			$(\'#infoi\').show();
			event.preventDefault();
			var formData = $("#quote_form").serialize();
			
			$.ajax({
				type        : \'POST\', 
				url         : \'ajax_process.php\', 
				data        : formData, 
				dataType    : \'json\', 
				encode          : true
			})
			
			.done(function(data) {
				
				console.log(data); 
				
				if (data.message !="") {
					$(\'#forms\').replaceWith(\'\' + data.message + \'\');
					if (data.status == false) {
						var html = "<div class=\"row\">";
						$.each(data.errors, function(key, value)
						{
							html += "<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\"><div class=\"alert alert-danger\">";
							html += "<span><strong>"+key+"</strong>&nbsp;:&nbsp;</span>";
							html += "<span>"+value+"</span>";
							html += "</div></div>";
						});
						html += "</div>";
						$(\'#forms\').prepend(html);
					}
			$(\'#infoi\').hide();
				}
				
			});

			
		});
	});
</script>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<hr>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
									<div class="pull-left" style="min-width:80%;"><button type="button" class="btn btn-primary" style="min-width:80%;" id="PreviousID'.$time.'">Previous</button></div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
									<div class="pull-right" style="min-width:80%;"><button type="submit" class="btn btn-primary" style="min-width:80%;" id="NextID'.$time.'">Next</button></div>
								</div>
							</div>
						</form>
						</div>
					</div>
				</div>
';
	$data['status'] = true;
	$data['message'] = $html;
}
	/*
    $uploaddir = './uploads/';
    foreach($_FILES as $file)
    {
        if(move_uploaded_file($file['tmp_name'], $uploaddir .basename($file['name'])))
        {
            $files[] = $uploaddir .$file['name'];
        }
        else
        {
            $error = true;
        }
    }
    $data = ($error) ? array('error' => 'There was an error uploading your files') : array('files' => $files);
	*/
}
else{
if(isset($_POST['step']) AND is_numeric($_POST['step']) AND in_array($_POST['step'],$step))
{
	switch($_POST['step'])
	{
		case 0:
			if(isset($_POST['tracking'])){
				$_POST['tracking'] = str_replace("-","_",$_POST['tracking']);
				if(preg_match("/^[A-Za-z0-9_]+$/",$_POST['tracking']) AND strlen(trim($_POST['tracking']))>0){
					if(isset($_POST['email']) AND filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
						$params = explode("_",$_POST['tracking']);
						if(isset($params[(count($params)-1)]) AND is_numeric($params[(count($params)-1)]) AND $params[(count($params)-1)]>0){
							$id = $params[(count($params)-1)];
							if($id>0){
								$q = "SELECT count(*) as cq FROM `quote` WHERE `id`=".$id." AND `email`='".$_POST['email']."'";
								//echo $q;
								$con = mysql_connect(DB_HOST,DB_USER,DB_PASS) or die(mysql_error());
								mysql_select_db(DB_NAME, $con) or die(mysql_error());

								$r = mysql_query($q) or die(mysql_error());
								$res = mysql_fetch_array($r);
								if($res['cq']==1){
									$q = "SELECT * FROM `qstatus` WHERE `rid` = ".$id." ORDER BY `timestamp` ASC";
									$r = mysql_query($q) or die(mysql_error());
									if(mysql_num_rows($r)>=1){
										while($res = mysql_fetch_array($r)){
$output .= '
							<div class="row">
								<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
									<div class="">'.date("Y/m/d H:i:s",$res['timestamp']).'</div>
									<div>'.$res['message'].'</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<hr>
								</div>
							</div>
';
										}
									}
									else{
$output .= '
							<div class="row">
								<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
									<div class="">Your order is under process</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<hr>
								</div>
							</div>
';
									}
								}
							}
						}
					}
				}
			}

$html .= '
					<div id="forms">
						<div id="infoi" style="display:none;"><div class="loader"></div></div>
						<div class="progress">
						  <div class="progress-bar  progress-bar-primary" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
							Tracking
						  </div>
						</div>

						<div class="form_header">
							<h1 style="font-size:30px;padding:20px 1em ;">Order Status</h1>
						</div>
						<div id="form_body">
						'.$output.'
						</div>
					</div>
				</div>
';
				$data['status'] = true;
				$data['message'] = $html;
		break;
		case 1:
			if(!(isset($_POST['ship_type']) AND is_numeric($_POST['ship_type']) AND in_array($_POST['ship_type'],$ship_type)))
			{
				$errors['ship_type'] = "invalid ship_type data.";
			}
			if(!(isset($_POST['ship_kind']) AND is_numeric($_POST['ship_kind']) AND in_array($_POST['ship_kind'],$ship_kind)))
			{
				$errors['ship_kind'] = "invalid ship_kind data.";
			}
			if(!(isset($_POST['time']) AND is_numeric($_POST['time']) AND in_array($_POST['time'],$timeSelect)))
			{
				$errors['time'] = "invalid time data.";
			}
			if($_POST['time']==3 AND !(isset($_POST['exact_date']) AND $_POST['exact_date']!=null AND $_POST['exact_date']!='' AND strlen(trim($_POST['exact_date']))>0))
			{
				$errors['exact_date'] = "invalid exact_date data.";
			}
			if(!(isset($_POST['ship_method']) AND is_numeric($_POST['ship_method']) AND in_array($_POST['ship_method'],$ship_method)))
			{
				$errors['ship_method'] = "invalid ship_method data.";
			}
			if(!(isset($_POST['from_country']) AND $_POST['from_country']!=null AND $_POST['from_country']!='' AND strlen(trim($_POST['from_country']))==3 AND array_key_exists($_POST['from_country'],$country)))
			{
				$errors['from_country'] = "invalid from_country data.";
			}
			if(!(isset($_POST['to_country']) AND $_POST['to_country']!=null AND $_POST['to_country']!='' AND strlen(trim($_POST['to_country']))==3 AND array_key_exists($_POST['to_country'],$country)))
			{
				$errors['to_country'] = "invalid to_country data.";
			}
			if(!(isset($_POST['collection_city']) AND $_POST['collection_city']!=null AND $_POST['collection_city']!='' AND strlen(trim($_POST['collection_city']))>0))
			{
				$errors['collection_city'] = "invalid collection_city data.";
			}
			if(!(isset($_POST['destination_city']) AND $_POST['destination_city']!=null AND $_POST['destination_city']!='' AND strlen(trim($_POST['destination_city']))>0))
			{
				$errors['destination_city'] = "invalid destination_city data.";
			}
			
			if ( ! empty($errors)) {
$html .= '
					<div id="forms">
						<div id="infoi" style="display:none;"><div class="loader"></div></div>
						<div class="progress">
						  <div class="progress-bar  progress-bar-primary" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">
							Step #1 - 0% complete
						  </div>
						</div>

						<div class="form_header">
							<h1 style="font-size:30px;padding:20px 1em ;">Shipping quote</h1>
						</div>
						<div id="form_body">
						<form id="quote_form" method="post" action="ajax_process.php">
							<input type="hidden" name="step" value="1">
							<div class="row">
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="required '.($errors['ship_type']!='' ? " error" : "").'">Please Select&nbsp;:&nbsp;</div>
									<div>
										<input type="radio" name="ship_type" value="1"'.((!isset($errors['ship_type']) AND $_POST['ship_type']==1) ? " checked='checked'" : "").' id="ShipType1" OnClick="CountryFunction(\'from\',\'uk\');" required="true" >&nbsp;<label for="ShipType1">Shipping from the UK</label><br>
										<input type="radio" name="ship_type" value="2"'.((!isset($errors['ship_type']) AND $_POST['ship_type']==2) ? " checked='checked'" : "").' id="ShipType2" OnClick="CountryFunction(\'to\',\'uk\');" required="true">&nbsp;<label for="ShipType2">Shipping to the UK</label><br>
										<input type="radio" name="ship_type" value="3"'.((!isset($errors['ship_type']) AND $_POST['ship_type']==3) ? " checked='checked'" : "").' id="ShipType3" OnClick="CountryFunction(\'other\',\'\');" required="true">&nbsp;<label for="ShipType3">Other</label>
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="required'.($errors['from_country']!='' ? " error" : "").'">Collection Country&nbsp;:&nbsp;</div>
									<div>
										<select class="drop_down" name="from_country" id="from_country" required="true">
											'.((!isset($errors['from_country']) AND $_POST['from_country']!='') ? "<option value='".$_POST['from_country']."' selected>".$country[$_POST['from_country']]."</option>" : "<option>---</option>").'
										
										</select>
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="required'.($errors['to_country']!='' ? " error" : "").'">Destination Country&nbsp;:&nbsp;</div>
									<div>
										<select class="drop_down" name="to_country" id="to_country" required="true">
											'.((!isset($errors['to_country']) AND $_POST['to_country']!='') ? "<option value='".$_POST['to_country']."' selected>".$country[$_POST['to_country']]."</option>" : "<option>---</option>").'
										</select>
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="required'.($errors['ship_kind']!='' ? " error" : "").'">Shipping type&nbsp;:&nbsp;</div>
									<div>
										<input type="radio" name="ship_kind" value="1"'.((!isset($errors['ship_kind']) AND $_POST['ship_kind']==1) ? " checked='checked'" : "").' id="ShipKind1" required="true">&nbsp;<label for="ShipKind1">Comercial</label><br>
										<input type="radio" name="ship_kind" value="2"'.((!isset($errors['ship_kind']) AND $_POST['ship_kind']==2) ? " checked='checked'" : "").' id="ShipKind2" required="true">&nbsp;<label for="ShipKind2">Personal</label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<hr>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="required'.($errors['time']!='' ? " error" : "").'"><label for="when_time">When?&nbsp;</label></div>
									<div>
										<select id="when_time" name="time" class="drop_down" OnChange="HandleTimeSelection();" required="true">
											<option></option>
											<option value="0"'.((!isset($errors['time']) AND $_POST['time']==0) ? " selected" : "").'>ASAP</option>
											<option value="1"'.((!isset($errors['time']) AND $_POST['time']==1) ? " selected" : "").'>This week</option>
											<option value="2"'.((!isset($errors['time']) AND $_POST['time']==2) ? " selected" : "").'>This month</option>
											<option value="3"'.((!isset($errors['time']) AND $_POST['time']==3) ? " selected" : "").'>Enter exact date</option>
											<option value="4"'.((!isset($errors['time']) AND $_POST['time']==4) ? " selected" : "").'>Not sure when</option>
										</select>
									</div>
									<div style="display:none;" id="exact_date">
										<div class="required'.($errors['exact_date']!='' ? " error" : "").'">Please enter a date :</div>
										<div><input name="exact_date" type="text"'.((!isset($errors['exact_date']) AND $_POST['exact_date']!='') ? " value='".$_POST['exact_date']."'" : "").'></div>
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="required'.($errors['collection_city']!='' ? " error" : "").'">Collection City&nbsp;:&nbsp;</div>
									<div>
										<input type="text" name="collection_city" required="true"'.((!isset($errors['collection_city']) AND $_POST['collection_city']!='') ? " value='".$_POST['collection_city']."'" : "").'>
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="required'.($errors['destination_city']!='' ? " error" : "").'">Destination City&nbsp;:&nbsp;</div>
									<div>
										<input type="text" name="destination_city" required="true"'.((!isset($errors['destination_city']) AND $_POST['destination_city']!='') ? " value='".$_POST['destination_city']."'" : "").'>
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="required'.($errors['ship_method']!='' ? " error" : "").'">Shipping method&nbsp;:&nbsp;</div>
									<div>
										<input type="radio" name="ship_method" value="1"'.((!isset($errors['ship_method']) AND $_POST['ship_method']==1) ? " checked='checked'" : "").' id="ShipMethod1" required="true">&nbsp;<label for="ShipMethod1">Air</label><br>
										<input type="radio" name="ship_method" value="2"'.((!isset($errors['ship_method']) AND $_POST['ship_method']==2) ? " checked='checked'" : "").' id="ShipMethod2" required="true">&nbsp;<label for="ShipMethod2">Sea</label><br>
										<input type="radio" name="ship_method" value="3"'.((!isset($errors['ship_method']) AND $_POST['ship_method']==3) ? " checked='checked'" : "").' id="ShipMethod3" required="true">&nbsp;<label for="ShipMethod3">Land</label><br>
										<input type="radio" name="ship_method" value="4"'.((!isset($errors['ship_method']) AND $_POST['ship_method']==4) ? " checked='checked'" : "").' id="ShipMethod4" required="true">&nbsp;<label for="ShipMethod4">Rail Way</label><br>
										<input type="radio" name="ship_method" value="6"'.((!isset($errors['ship_method']) AND $_POST['ship_method']==6) ? " checked='checked'" : "").' id="ShipMethod6" required="true">&nbsp;<label for="ShipMethod6">Charter</label><br>
										<input type="radio" name="ship_method" value="5"'.((!isset($errors['ship_method']) AND $_POST['ship_method']==5) ? " checked='checked'" : "").' id="ShipMethod5" required="true">&nbsp;<label for="ShipMethod5">Not Sure</label>
									</div>
								</div>
							</div>

<script type="text/javascript">
	$(document).ready(function () {
		$("#NextID'.$time.'").click(function(event) {
			$(\'#infoi\').show();
			event.preventDefault();
			var formData = $("#quote_form").serialize();
			
			$.ajax({
				type        : \'POST\', 
				url         : \'ajax_process.php\', 
				data        : formData, 
				dataType    : \'json\', 
				encode          : true
			})
			
			.done(function(data) {
				
				//console.log(data); 
				
				if (data.message !="") {
					$(\'#forms\').replaceWith(\'\' + data.message + \'\');
					if (data.status == false) {
						var html = "<div class=\"row\">";
						$.each(data.errors, function(key, value)
						{
							html += "<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\"><div class=\"alert alert-danger\">";
							html += "<span><strong>"+key+"</strong>&nbsp;:&nbsp;</span>";
							html += "<span>"+value+"</span>";
							html += "</div></div>";
						});
						html += "</div>";
						$(\'#forms\').prepend(html);
					}
			$(\'#infoi\').hide();
				}
				
			});

			
		});
	});
</script>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<hr>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
									<div class="pull-left" style="min-width:80%;"><button type="button" class="btn btn-primary" style="min-width:80%;" >I have Tracking Code</button></div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
									<div class="pull-right" style="min-width:80%;"><button type="submit" class="btn btn-primary" style="min-width:80%;" id="NextID'.$time.'">Next</button></div>
								</div>
							</div>
						</form>
						</div>
					</div>
				</div>
';
				$data['status'] = false;
				$data['errors']  = $errors;
				$data['message'] = $html;
			}
			else {
				$_SESSION['ship_type'] = $_POST['ship_type'];
				$_SESSION['ship_kind'] = $_POST['ship_kind'];
				$_SESSION['ship_method'] = $_POST['ship_method'];
				$_SESSION['from_country'] = $country[$_POST['from_country']];
				$_SESSION['to_country'] = $country[$_POST['to_country']];
				$_SESSION['collection_city'] = $_POST['collection_city'];
				$_SESSION['destination_city'] = $_POST['destination_city'];
				$_SESSION['time'] = ($_POST['time']==3 ? $_POST['exact_date'] : $_POST['time']);
				
				
$html .= '
					<div id="forms">
						<div id="infoi" style="display:none;"><div class="loader"></div></div>
						<div class="progress">
						  <div class="progress-bar  progress-bar-primary" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width:20%">
							Step #2 - 20% complete
						  </div>
						</div>

						<div class="form_header">
							<h1 style="font-size:30px;padding:20px 1em ;">Shipping quote</h1>
						</div>
						<div id="form_body">
						<form id="quote_form" method="post" action="ajax_process.php">
							<input type="hidden" name="step" value="2">
							<div class="row">
								<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
									<div class="required">Collection postcode & town&nbsp;:&nbsp;</div>
									<div>
										<input type="text" name="collection_pt" required="true">
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="required">Delivery postcode & town&nbsp;:&nbsp;</div>
									<div>
										<input type="text" name="delivery_pt" required="true">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<hr>
								</div>
							</div>
';							
							if($_SESSION['from_country'] == 'United States' AND $_SESSION['to_country'] == 'Iran'){
								$html .='
							<div class="row">
								<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
									<div class="required">Your Shipper already obtained OFAC license for Export ?&nbsp;</div>
									<div>
										<input type="radio" name="ofac" id="ofac_yes" required="true" value="1"><label for="ofac_yes">Yes</label>&nbsp;&nbsp;&nbsp;
										<input type="radio" name="ofac" id="ofac_no" required="true" value="0"><label for="ofac_no">No</label>&nbsp;&nbsp;&nbsp;
									</div>
								</div>
								<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
									<div class="required">Your Shipper already registered with TSA database in USA ?&nbsp;</div>
									<div>
										<input type="radio" name="tsa" id="tsa_yes" required="true" value="1"><label for="tsa_yes">Yes</label>&nbsp;&nbsp;&nbsp;
										<input type="radio" name="tsa" id="tsa_no" required="true" value="0"><label for="tsa_no">No</label>&nbsp;&nbsp;&nbsp;
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
									<div  style="width:50%;">
										<div class="required">Would you prefer to transit this order to the destination Via another country ?&nbsp;</div>
										<div>
											<input type="radio" name="other_country" id="other_country_yes" required="true" value="1"><label for="other_country_yes">Yes</label>&nbsp;&nbsp;&nbsp;
											<input type="radio" name="other_country" id="other_country_no" required="true" value="0"><label for="other_country_no">No</label>&nbsp;&nbsp;&nbsp;
										</div>
									</div>
									<div id="second_destination" style="width:50%;display:none;">
										<div class="required">Please Transit Via if possible :&nbsp;</div>
										<div>
											<select id="transit" name="transit" OnChange="HandleTransitSelection();" class="drop_down">
												<option ></option>
												<option value="UAE">UAE</option>
												<option value="Turkey">Turkey</option>
												<option value="Russia">Russia</option>
												<option value="Oman">Oman</option>
												<option value="Any of above">Any of above</option>
												<option value="Other">Other</option>
											</select>
										</div>
										<div style="display:none;" id="other_transit">
											<div class="required">Please enter the country name :</div>
											<div><input name="other_transit" type="text"></div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<hr>
								</div>
							</div>
';							
							}
							switch($_SESSION['ship_method'])
							{
								case 1: //Air
$html .= '
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
									<div><b>NOTE:</b></div>
									<div>Current AIRFREIGHT transit times:</br><b>3 to 7 days</b> for all destinations.</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
									<div class="required">Air freight delivery&nbsp;:&nbsp;</div>
									<div>
										<input type="radio" name="shipMethod" value="4" id="ShipMethod4" required="true">&nbsp;<label for="ShipMethod4">Airport To Door</label><br>
										<input type="radio" name="shipMethod" value="1" id="ShipMethod1" required="true">&nbsp;<label for="ShipMethod1">Door To Door</label><br>
										<input type="radio" name="shipMethod" value="2" id="ShipMethod2" required="true">&nbsp;<label for="ShipMethod2">Door To Airport</label><br>
										<input type="radio" name="shipMethod" value="3" id="ShipMethod3" required="true">&nbsp;<label for="ShipMethod3">Airport To Airport</label>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
									<div class="required">Terms&nbsp;:&nbsp;</div>
									<div>
										<select id="terms" name="term" class="drop_down" OnChange="HandleAirTermSelection();" required="true">
											<option data-info="" data-content=""></option>
											<option data-info="EX-Work" data-content="Ex works. means that the seller fulfils his obligation to deliver when he has made the goods available at his premises (i.e. works, factory, warehouse, etc) to the buyer. ... The buyer bears all costs and risks involved in taking the goods from the seller\'s premises to the desired destination." value="1">EX-Work</option>
											<option data-info="FOB" data-content="«Free on Board» means that the seller delivers when the goods pass the ship\'s rail at the named port of shipment. This means that the buyer has to bear all costs and risks of loss of or damage to the goods from that point. The FOB term requires the seller to clear the goods for export." value="2">FOB</option>
											<option data-info="CPT" data-content="«Carriage paid to...» means that the seller pays the freight for the carriage of the goods to the named destination. ... If subsequent carriers are used for the carriage to the agreed destination, the risk passes when the goods have been delivered to the first carrier." value="4">CPT</option>
											<option data-info="DDP" data-content="This term means that the seller pays all the costs of transportation (export fees, carriage, insurance, and destination port charges) up to and including the delivery of the goods to the final destination. The buyer is responsible to pay only the import duty/taxes/customs costs." value="5">DDP</option>
											<option data-info="DDU" data-content="Delivery Duty Unpaid – Is a fairly common incoterm and can be used for any mode of transport. Under DDU terms the seller is responsible for making the goods available to the buyer at a named place of destination but not cleared for import." value="6">DDU</option>
											<option data-info="Other" data-content="Other terms" value="3">Other</option>
										</select>
									</div>
									<div style="display:none;" id="other_term">
										<div class="required">Please enter your term :</div>
										<div><input name="other_term" type="text"></div>
									</div>
								</div>
							</div>
';						
									break;
								case 2: //Sea
$html .= '
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
									<div><b>NOTE:</b></div>
									<div>
			Current SEAFREIGHT transit times: (days)</br>
			Africa: 12 to 18</br>
			Australia: 36 to 57</br>
			China: 26 to 42</br>   
			Europe: 7 to 14s</br>
			India: 20 to 35</br> 
			Latin America: 13 to 28</br>
			Middle East: 16 to 38</br>
			North America: 10</br></div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
									<div class="required">Container specification&nbsp;:&nbsp;</div>
									<div>
										<input type="radio" name="containerType" value="1" id="containerType1" required="true" OnClick="HandleFCLSelection(1);">&nbsp;<label for="containerType1">FCL (Full Container Load)</label><br>
										<input type="radio" name="containerType" value="2" id="containerType2" required="true" OnClick="HandleFCLSelection(0);">&nbsp;<label for="containerType2">LCL (Less > Container Load)</label><br>
										<input type="radio" name="containerType" value="3" id="containerType3" required="true" OnClick="HandleFCLSelection(0);">&nbsp;<label for="containerType3">Not Sure</label>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
									<div class="required">Air freight delivery&nbsp;:&nbsp;</div>
									<div>
										<input type="radio" name="shipMethod" value="1" id="ShipMethod1" required="true">&nbsp;<label for="ShipMethod1">Door To Door</label><br>
										<input type="radio" name="shipMethod" value="2" id="ShipMethod2" required="true">&nbsp;<label for="ShipMethod2">Door To Port</label><br>
										<input type="radio" name="shipMethod" value="3" id="ShipMethod3" required="true">&nbsp;<label for="ShipMethod3">Port To Port</label><br>
										<input type="radio" name="shipMethod" value="4" id="ShipMethod4" required="true">&nbsp;<label for="ShipMethod4">Port To Door</label>
									</div>
								</div>
							</div>
							<div class="row" id="fcl_div" style="display:none;">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<hr>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
									<div class="required">Nmber of containers (Default is 1)&nbsp;:&nbsp;</div>
									<div ><input name="containerCount" type="number" value="1"></div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
									<div class="required">FCL (Full Container Load)&nbsp;:&nbsp;</div>
									<div >
										<input type="radio" name="FCLType" value="1" id="FCLType1">&nbsp;<label for="FCLType1">20 ft container</label><br>
										<input type="radio" name="FCLType" value="2" id="FCLType2">&nbsp;<label for="FCLType2">40 ft container</label><br>
										<input type="radio" name="FCLType" value="3" id="FCLType3">&nbsp;<label for="FCLType3">40 ft high cube container</label>
									</div>
								</div>
							</div>
';
									break;
								case 3: //Land
$html .= '
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
									<div class="required">Land shipping&nbsp;:&nbsp;</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
									<div><input type="radio" name="containerType" value="1" id="containerType1" required="true">&nbsp;<label for="containerType1">FTL (Full Truck Load)</label></div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
									<div><input type="radio" name="containerType" value="2" id="containerType2" required="true">&nbsp;<label for="containerType2">LTL (Less > Truck Load)</label></div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
									<div><input type="radio" name="containerType" value="3" id="containerType3" required="true">&nbsp;<label for="containerType3">Not Sure</label></div>
								</div>
							</div>
';						
									break;
							}
$html .= '

<script type="text/javascript">
	$(document).ready(function () {
		
		$("input[name=other_country]").on("change", function (event)
		{
            var radioValue = $("input[name=\'other_country\']:checked").val();
            if(radioValue == 1){
				$("#second_destination").show();
            }
			else
				$("#second_destination").hide();
				
		});

		$("#PreviousID'.$time.'").click(function(event) {
			$(\'#infoi\').show();
			var step = parseInt( $("#quote_form input[name=step]").val() ) - 1;
			
			$.ajax({
				type        : \'POST\', 
				url         : \'ajax_process.php?cmd=previous\', 
				data        : "step="+step, 
				dataType    : \'json\', 
				encode          : true
			})
			
			.done(function(data) {
				
				//console.log(data); 
				
				if (data.message !=\'\') {
					$(\'#forms\').replaceWith(\'\' + data.message + \'\');
					if (data.status == false) {
						var html = "<div class=\"row\">";
						$.each(data.errors, function(key, value)
						{
							html += "<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\"><div class=\"alert alert-danger\">";
							html += "<span><strong>"+key+"</strong>&nbsp;:&nbsp;</span>";
							html += "<span>"+value+"</span>";
							html += "</div></div>";
						});
						html += "</div>";
						$(\'#forms\').prepend(html);
					}
			$(\'#infoi\').hide();
				}
				
			});

			
			event.preventDefault();
		});
		$("#NextID'.$time.'").click(function(event) {
			$(\'#infoi\').show();
			event.preventDefault();
			var formData = $("#quote_form").serialize();
			
			$.ajax({
				type        : \'POST\', 
				url         : \'ajax_process.php\', 
				data        : formData, 
				dataType    : \'json\', 
				encode          : true
			})
			
			.done(function(data) {
				
				//console.log(data); 
				
				if (data.message !="") {
					$(\'#forms\').replaceWith(\'\' + data.message + \'\');
					if (data.status == false) {
						var html = "<div class=\"row\">";
						$.each(data.errors, function(key, value)
						{
							html += "<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\"><div class=\"alert alert-danger\">";
							html += "<span><strong>"+key+"</strong>&nbsp;:&nbsp;</span>";
							html += "<span>"+value+"</span>";
							html += "</div></div>";
						});
						html += "</div>";
						$(\'#forms\').prepend(html);
					}
			$(\'#infoi\').hide();
				}
				
			});

			
		});
	});
	
	
$(function () {
    $("select[name=term]").on("change", onChange);
    $("select[name=term]").on("focus", function() {
        $(this).popover(\'destroy\')
    });
});

function onChange() {
    var $this = $(this);
    var $e = $(this.target);
    $(\'#terms\').popover(\'destroy\');
	if($this.children(\'option:selected\').attr("data-info") !==\'\'){
		
		$("#terms").popover({
			title:$this.children(\'option:selected\').attr("data-info"),
			trigger: \'manual\',
			placement: \'right\',
			animation: true,
			content: $this.children(\'option:selected\').attr("data-content")
		}).popover(\'show\');
		$this.blur();
	}
}
</script>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<hr>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
									<div class="pull-left" style="min-width:80%;"><button type="button" class="btn btn-primary" style="min-width:80%;" id="PreviousID'.$time.'">Previous</button></div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
									<div class="pull-right" style="min-width:80%;"><button type="submit" class="btn btn-primary" style="min-width:80%;" id="NextID'.$time.'">Next</button></div>
								</div>
							</div>
						</form>
						</div>
					</div>
				</div>
';

				$data['status'] = true;
				$data['message'] = $html;
			}
			break;
		case 2:
			if(!isset($_SESSION['ship_type'])) return;
			if(!(isset($_POST['collection_pt']) AND $_POST['collection_pt']!=null AND $_POST['collection_pt']!='' AND strlen(trim($_POST['collection_pt']))>0))
			{
				$errors['collection_pt'] = "invalid collection_pt data.";
			}
			if(!(isset($_POST['delivery_pt']) AND $_POST['delivery_pt']!=null AND $_POST['delivery_pt']!='' AND strlen(trim($_POST['delivery_pt']))>0))
			{
				$errors['delivery_pt'] = "invalid delivery_pt data.";
			}
			
			if($_SESSION['from_country'] == 'United States' AND $_SESSION['to_country'] == 'Iran')
			{
				
				if(!(isset($_POST['ofac']) AND $_POST['ofac']!=null AND $_POST['ofac']!='' AND strlen(trim($_POST['ofac']))>0))
				{
					$errors['ofac'] = "invalid OFAC data.";
				}
				if(!(isset($_POST['tsa']) AND $_POST['tsa']!=null AND $_POST['tsa']!='' AND strlen(trim($_POST['tsa']))>0))
				{
					$errors['tsa'] = "invalid TSA data.";
				}
				if(!(isset($_POST['other_country']) AND $_POST['other_country']!=null AND $_POST['other_country']!='' AND ($_POST['other_country'] == 0 or $_POST['other_country'] == 1)))
				{
					$errors['other_country'] = "invalid Transit data.";
				}
				if(!(isset($_POST['transit']) AND $_POST['transit']!=null AND $_POST['transit']!='' AND strlen(trim($_POST['transit']))>0)  AND $_POST['other_country'] == 1)
				{
					$errors['transit'] = "invalid Transit data.";
				}
				if(isset($_POST['transit']) AND $_POST['transit']!=null AND $_POST['transit']!='' AND strlen(trim($_POST['transit']))>0 AND $_POST['transit']=='other'  AND $_POST['other_country'] == 1 AND !(isset($_POST['other_transit']) AND $_POST['other_transit']!=null AND $_POST['other_transit']!='' AND strlen(trim($_POST['other_transit']))>0))
				{
					$errors['other_transit'] = "invalid Transit data.";
				}
			}
			
			switch($_SESSION['ship_method'])
			{
				case 1: //Air
					if(!(isset($_POST['shipMethod']) AND is_numeric($_POST['shipMethod']) AND in_array($_POST['shipMethod'],$shipMethod)))
					{
						$errors['shipMethod'] = "invalid shipMethod data.";
					}
					if(!(isset($_POST['term']) AND is_numeric($_POST['term']) AND in_array($_POST['term'],$term)))
					{
						$errors['term'] = "invalid term data.";
					}
					if($_POST['term']==3 AND !(isset($_POST['other_term']) AND $_POST['other_term']!=null AND $_POST['other_term']!='' AND strlen(trim($_POST['other_term']))>0))
					{
						$errors['other_term'] = "invalid other_term data.";
					}
					break;
				case 2: //Sea
					if(!(isset($_POST['shipMethod']) AND is_numeric($_POST['shipMethod']) AND in_array($_POST['shipMethod'],$shipMethod)))
					{
						$errors['shipMethod'] = "invalid shipMethod data.";
					}
					if(!(isset($_POST['containerType']) AND is_numeric($_POST['containerType']) AND in_array($_POST['containerType'],$containerType)))
					{
						$errors['containerType'] = "invalid containerType data.";
					}
					if($_POST['containerType'] == 3)
					{
						if(!(isset($_POST['containerCount']) AND $_POST['containerCount']!=null AND $_POST['containerCount']!='' AND strlen(trim($_POST['containerCount']))>0 AND is_numeric($_POST['containerCount']) AND $_POST['containerCount']>0))
						{
							$errors['containerCount'] = "invalid containerCount data.";
						}
						if(!(isset($_POST['FCLType']) AND is_numeric($_POST['FCLType']) AND in_array($_POST['FCLType'],$FCLType)))
						{
							$errors['FCLType'] = "invalid FCLType data.";
						}
					}
					break;
				case 3: //Land
					if(!(isset($_POST['containerType']) AND is_numeric($_POST['containerType']) AND in_array($_POST['containerType'],$containerType)))
					{
						$errors['containerType'] = "invalid containerType data.";
					}
					break;
			}
			if ( ! empty($errors)) {
				
$html .= '
					<div id="forms">
						<div id="infoi" style="display:none;"><div class="loader"></div></div>
						<div class="progress">
						  <div class="progress-bar  progress-bar-primary" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width:20%">
							Step #2 - 20% complete
						  </div>
						</div>

						<div class="form_header">
							<h1 style="font-size:30px;padding:20px 1em ;">Shipping quote</h1>
						</div>
						<div id="form_body">
						<form id="quote_form" method="post" action="ajax_process.php">
							<input type="hidden" name="step" value="2">
							<div class="row">
								<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
									<div class="required'.($errors['collection_pt']!='' ? " error" : "").'">Collection postcode & town&nbsp;:&nbsp;</div>
									<div>
										<input type="text" name="collection_pt" required="true"'.((!isset($errors['collection_pt']) AND isset($_POST['collection_pt']) AND $_POST['collection_pt']!='') ? " value='".$_POST['collection_pt']."'" : "").'>
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="required'.($errors['delivery_pt']!='' ? " error" : "").'">Delivery postcode & town&nbsp;:&nbsp;</div>
									<div>
										<input type="text" name="delivery_pt" required="true"'.((!isset($errors['delivery_pt']) AND isset($_POST['delivery_pt']) AND $_POST['delivery_pt']!='') ? " value='".$_POST['delivery_pt']."'" : "").'>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<hr>
								</div>
							</div>
';							
							if($_SESSION['from_country'] == 'United States' AND $_SESSION['to_country'] == 'Iran'){
								$html .='
							<div class="row">
								<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
									<div class="required'.($errors['ofac']!='' ? " error" : "").'">Your Shipper already obtained OFAC license for Export ?&nbsp;</div>
									<div>
										<input type="radio" name="ofac" id="ofac_yes" required="true" value="1" '.((!isset($errors['ofac']) AND $_POST['ofac']==1) ? " checked='checked'" : "").'><label for="ofac_yes">Yes</label>&nbsp;&nbsp;&nbsp;
										<input type="radio" name="ofac" id="ofac_no" required="true" value="0" '.((!isset($errors['ofac']) AND $_POST['ofac']==0) ? " checked='checked'" : "").'><label for="ofac_no">No</label>&nbsp;&nbsp;&nbsp;
									</div>
								</div>
								<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
									<div class="required'.($errors['tsa']!='' ? " error" : "").'">Your Shipper already registered with TSA database in USA ?&nbsp;</div>
									<div>
										<input type="radio" name="tsa" id="tsa_yes" required="true" value="1" '.((!isset($errors['tsa']) AND $_POST['tsa']==1) ? " checked='checked'" : "").'><label for="tsa_yes">Yes</label>&nbsp;&nbsp;&nbsp;
										<input type="radio" name="tsa" id="tsa_no" required="true" value="0" '.((!isset($errors['tsa']) AND $_POST['tsa']==0) ? " checked='checked'" : "").'><label for="tsa_no">No</label>&nbsp;&nbsp;&nbsp;
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
									<div  style="width:50%;">
										<div class="required'.($errors['other_country']!='' ? " error" : "").'">Would you prefer to transit this order to the destination Via another country ?&nbsp;</div>
										<div>
											<input type="radio" name="other_country" id="other_country_yes" required="true" value="1" '.((!isset($errors['other_country']) AND $_POST['other_country']==1) ? " checked='checked'" : "").'><label for="other_country_yes">Yes</label>&nbsp;&nbsp;&nbsp;
											<input type="radio" name="other_country" id="other_country_no" required="true" value="0" '.((!isset($errors['other_country']) AND $_POST['other_country']==0) ? " checked='checked'" : "").'><label for="other_country_no">No</label>&nbsp;&nbsp;&nbsp;
										</div>
									</div>
									<div id="second_destination" style="width:50%;display:none;">
										<div class="required'.($errors['transit']!='' ? " error" : "").'">Please Transit Via if possible :&nbsp;</div>
										<div>
											<select id="transit" name="transit" OnChange="HandleTransitSelection();" class="drop_down">
												<option ></option>
												<option value="UAE">UAE</option>
												<option value="Turkey">Turkey</option>
												<option value="Russia">Russia</option>
												<option value="Oman">Oman</option>
												<option value="Any of above">Any of above</option>
												<option value="Other">Other</option>
											</select>
										</div>
										<div style="display:none;" id="other_transit">
											<div class="required'.($errors['other_transit']!='' ? " error" : "").'">Please enter the country name :</div>
											<div><input name="other_transit" type="text"></div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<hr>
								</div>
							</div>
';							
							}
							switch($_SESSION['ship_method'])
							{
								case 1: //Air
$html .= '
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
									<div><b>NOTE:</b></div>
									<div>Current AIRFREIGHT transit times:</br><b>3 to 7 days</b> for all destinations.</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
									<div class="required'.($errors['shipMethod']!='' ? " error" : "").'">Air freight delivery&nbsp;:&nbsp;</div>
									<div>
										<input type="radio" name="shipMethod" value="4"'.((!isset($errors['shipMethod']) AND $_POST['shipMethod']==4) ? " checked='checked'" : "").' id="ShipMethod4" required="true">&nbsp;<label for="ShipMethod4">Airport To Door</label><br>
										<input type="radio" name="shipMethod" value="1"'.((!isset($errors['shipMethod']) AND $_POST['shipMethod']==1) ? " checked='checked'" : "").' id="ShipMethod1" required="true">&nbsp;<label for="ShipMethod1">Door To Door</label><br>
										<input type="radio" name="shipMethod" value="2"'.((!isset($errors['shipMethod']) AND $_POST['shipMethod']==2) ? " checked='checked'" : "").' id="ShipMethod2" required="true">&nbsp;<label for="ShipMethod2">Door To Airport</label><br>
										<input type="radio" name="shipMethod" value="3"'.((!isset($errors['shipMethod']) AND $_POST['shipMethod']==3) ? " checked='checked'" : "").' id="ShipMethod3" required="true">&nbsp;<label for="ShipMethod3">Airport To Airport</label>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
									<div class="required'.($errors['term']!='' ? " error" : "").'">Terms&nbsp;:&nbsp;</div>
									<div>
										<select id="terms" name="term" class="drop_down" OnChange="HandleAirTermSelection();" required="true">
											<option></option>
											<option value="1">EX-Work</option>
											<option value="2">FOB</option>
											<option value="3">Other</option>
										</select>
									</div>
									<div style="display:none;" id="other_term">
										<div class="required'.($errors['other_term']!='' ? " error" : "").'">Please enter your term :</div>
										<div><input name="other_term" type="text"></div>
									</div>
								</div>
							</div>
';						
									break;
								case 2: //Sea
$html .= '
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
									<div><b>NOTE:</b></div>
									<div>
			Current SEAFREIGHT transit times: (days)</br>
			Africa: 12 to 18</br>
			Australia: 36 to 57</br>
			China: 26 to 42</br>   
			Europe: 7 to 14s</br>
			India: 20 to 35</br> 
			Latin America: 13 to 28</br>
			Middle East: 16 to 38</br>
			North America: 10</br></div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
									<div class="required'.($errors['containerType']!='' ? " error" : "").'">Container specification&nbsp;:&nbsp;</div>
									<div>
										<input type="radio" name="containerType" value="1"'.((!isset($errors['containerType']) AND $_POST['containerType']==1) ? " checked='checked'" : "").' id="containerType1" required="true" OnClick="HandleFCLSelection(1);">&nbsp;<label for="containerType1">FCL (Full Container Load)</label><br>
										<input type="radio" name="containerType" value="2"'.((!isset($errors['containerType']) AND $_POST['containerType']==2) ? " checked='checked'" : "").' id="containerType2" required="true" OnClick="HandleFCLSelection(0);">&nbsp;<label for="containerType2">LCL (Less > Container Load)</label><br>
										<input type="radio" name="containerType" value="3"'.((!isset($errors['containerType']) AND $_POST['containerType']==3) ? " checked='checked'" : "").' id="containerType3" required="true" OnClick="HandleFCLSelection(0);">&nbsp;<label for="containerType3">Not Sure</label>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
									<div class="required'.($errors['shipMethod']!='' ? " error" : "").'">Air freight delivery&nbsp;:&nbsp;</div>
									<div>
										<input type="radio" name="shipMethod" value="1"'.((!isset($errors['shipMethod']) AND $_POST['shipMethod']==1) ? " checked='checked'" : "").' id="ShipMethod1" required="true">&nbsp;<label for="ShipMethod1">Door To Door</label><br>
										<input type="radio" name="shipMethod" value="2"'.((!isset($errors['shipMethod']) AND $_POST['shipMethod']==2) ? " checked='checked'" : "").' id="ShipMethod2" required="true">&nbsp;<label for="ShipMethod2">Door To Port</label><br>
										<input type="radio" name="shipMethod" value="3"'.((!isset($errors['shipMethod']) AND $_POST['shipMethod']==3) ? " checked='checked'" : "").' id="ShipMethod3" required="true">&nbsp;<label for="ShipMethod3">Port To Port</label><br>
										<input type="radio" name="shipMethod" value="4"'.((!isset($errors['shipMethod']) AND $_POST['shipMethod']==4) ? " checked='checked'" : "").' id="ShipMethod4" required="true">&nbsp;<label for="ShipMethod4">Port To Door</label>
									</div>
								</div>
							</div>
							<div class="row" id="fcl_div" style="display:none;">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<hr>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
									<div class="required'.($errors['containerCount']!='' ? " error" : "").'">Nmber of containers (Default is 1)&nbsp;:&nbsp;</div>
									<div ><input name="containerCount" type="number" value="'.((!isset($errors['containerCount']) AND isset($_POST['containerCount']) AND $_POST['containerCount']!='') ? $_POST['containerCount'] : "1").'"></div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
									<div class="required'.($errors['FCLType']!='' ? " error" : "").'">FCL (Full Container Load)&nbsp;:&nbsp;</div>
									<div >
										<input type="radio" name="FCLType" value="1"'.((!isset($errors['FCLType']) AND $_POST['FCLType']==1) ? " checked='checked'" : "").' id="FCLType1">&nbsp;<label for="FCLType1">20 ft container</label><br>
										<input type="radio" name="FCLType" value="2"'.((!isset($errors['FCLType']) AND $_POST['FCLType']==2) ? " checked='checked'" : "").' id="FCLType2">&nbsp;<label for="FCLType2">40 ft container</label><br>
										<input type="radio" name="FCLType" value="3"'.((!isset($errors['FCLType']) AND $_POST['FCLType']==3) ? " checked='checked'" : "").' id="FCLType3">&nbsp;<label for="FCLType3">40 ft high cube container</label>
									</div>
								</div>
							</div>
';
									break;
								case 3: //Land
$html .= '
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
									<div class="required'.($errors['containerType']!='' ? " error" : "").'">Land shipping&nbsp;:&nbsp;</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
									<div><input type="radio" name="containerType" value="1"'.((!isset($errors['containerType']) AND $_POST['containerType']==1) ? " checked='checked'" : "").' id="containerType1" required="true">&nbsp;<label for="containerType1">FTL (Full Truck Load)</label></div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
									<div><input type="radio" name="containerType" value="2"'.((!isset($errors['containerType']) AND $_POST['containerType']==2) ? " checked='checked'" : "").' id="containerType2" required="true">&nbsp;<label for="containerType2">LTL (Less > Truck Load)</label></div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
									<div><input type="radio" name="containerType" value="3"'.((!isset($errors['containerType']) AND $_POST['containerType']==3) ? " checked='checked'" : "").' id="containerType3" required="true">&nbsp;<label for="containerType3">Not Sure</label></div>
								</div>
							</div>
';						
									break;
							}
$html .= '


<script type="text/javascript">
	$(document).ready(function () {
		$("input[name=other_country]").on("change", function (event)
		{
            var radioValue = $("input[name=\'other_country\']:checked").val();
            if(radioValue == 1){
                
				$("#second_destination").show();
            }
			else
				$("#second_destination").hide();
				
		});
		$("#PreviousID'.$time.'").click(function(event) {
			$(\'#infoi\').show();
			var step = parseInt( $("#quote_form input[name=step]").val() ) - 1;
			
			$.ajax({
				type        : \'POST\', 
				url         : \'ajax_process.php?cmd=previous\', 
				data        : "step="+step, 
				dataType    : \'json\', 
				encode          : true
			})
			
			.done(function(data) {
				
				console.log(data); 
				
				if (data.message !=\'\') {
					$(\'#forms\').replaceWith(\'\' + data.message + \'\');
					if (data.status == false) {
						var html = "<div class=\"row\">";
						$.each(data.errors, function(key, value)
						{
							html += "<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\"><div class=\"alert alert-danger\">";
							html += "<span><strong>"+key+"</strong>&nbsp;:&nbsp;</span>";
							html += "<span>"+value+"</span>";
							html += "</div></div>";
						});
						html += "</div>";
						$(\'#forms\').prepend(html);
					}
			$(\'#infoi\').hide();
				}
				
			});

			
			event.preventDefault();
		});
		$("#NextID'.$time.'").click(function(event) {
			$(\'#infoi\').show();
			event.preventDefault();
			var formData = $("#quote_form").serialize();
			
			$.ajax({
				type        : \'POST\', 
				url         : \'ajax_process.php\', 
				data        : formData, 
				dataType    : \'json\', 
				encode          : true
			})
			
			.done(function(data) {
				
				console.log(data); 
				
				if (data.message !="") {
					$(\'#forms\').replaceWith(\'\' + data.message + \'\');
					if (data.status == false) {
						var html = "<div class=\"row\">";
						$.each(data.errors, function(key, value)
						{
							html += "<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\"><div class=\"alert alert-danger\">";
							html += "<span><strong>"+key+"</strong>&nbsp;:&nbsp;</span>";
							html += "<span>"+value+"</span>";
							html += "</div></div>";
						});
						html += "</div>";
						$(\'#forms\').prepend(html);
					}
			$(\'#infoi\').hide();
				}
				
			});

			
		});
	});
</script>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<hr>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
									<div class="pull-left" style="min-width:80%;"><button type="button" class="btn btn-primary" style="min-width:80%;" id="PreviousID'.$time.'">Previous</button></div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
									<div class="pull-right" style="min-width:80%;"><button type="submit" class="btn btn-primary" style="min-width:80%;" id="NextID'.$time.'">Next</button></div>
								</div>
							</div>
						</form>
						</div>
					</div>
				</div>
';

				$data['status'] = false;
				$data['errors']  = $errors;
				$data['message'] = $html;
			}
			else {
				if($_SESSION['from_country'] == 'United States' AND $_SESSION['to_country'] == 'Iran'){
					$_SESSION['ofac'] = $_POST['ofac'];
					$_SESSION['tsa'] = $_POST['tsa'];
					$_SESSION['other_country'] = $_POST['other_country'];
					$_SESSION['transit'] = $_POST['transit'];
					$_SESSION['other_transit'] = $_POST['other_transit'];
				}
				$_SESSION['collection_pt'] = $_POST['collection_pt'];
				$_SESSION['delivery_pt'] = $_POST['delivery_pt'];
				switch($_SESSION['ship_method'])
				{
					case 1: //Air
						$_SESSION['shipMethod'] = $_POST['shipMethod'];
						$_SESSION['term'] = $_POST['term'];
						if($_POST['term']==3) $_SESSION['other_term'] = $_POST['other_term'];
						break;
					case 2: //Sea
						$_SESSION['shipMethod'] = $_POST['shipMethod'];
						$_SESSION['containerType'] = $_POST['containerType'];
						if($_POST['containerType'] == 3)
						{
							$_SESSION['containerCount'] = $_POST['containerCount'];
							$_SESSION['FCLType'] = $_POST['FCLType'];
						}
						break;
					case 3: //Land
						$_SESSION['containerType'] = $_POST['containerType'];
						break;
				}
$html .= '

					<div id="forms">
						<div id="infoi" style="display:none;"><div class="loader"></div></div>
						<div class="progress">
						  <div class="progress-bar  progress-bar-primary" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:40%">
							Step #3 - 40% complete
						  </div>
						</div>

						<div class="form_header">
							<h1 style="font-size:30px;padding:20px 1em ;">Shipping quote</h1>
						</div>
						<div id="form_body">
						<form id="quote_form" method="post" action="ajax_process.php">
							<input type="hidden" name="step" value="3">
';
if(!(isset($_SESSION['containerType']) AND $_SESSION['containerType']==3))
{
	$html .='
<script type="text/javascript"> 
			$(document).ready(function () {
					var scntDiv = $(\'#dimsID\');
					var i = $(\'#dimsID div.dims\').size() + 1;
					
					$(\'#addScnt\').on(\'click\', \'img\', function() {
						//alert("yes");
						$(\'<div class="dims"><div class="col-xs-7 col-sm-6 col-md-6 col-lg-6"><input type="text" name="dims[]" size="25" maxlength="50"></div><div class="col-xs-3 col-sm-4 col-md-4 col-lg-4"><input type="text" name="weights[]" size="6" maxlength="6"></div><div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div></div>\').appendTo(scntDiv);
						i++;
						return false;
					});
			});
			
</script>
							<div class="row">
								<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
									<div class="required">Nmber of items&nbsp;:&nbsp;</div>
									<div>
										<input type="number" name="itemCount" id="itemCount">
									</div>
								</div>
								<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
									<div class="row required">
										<div class="col-xs-9 col-sm-8 col-md-8 col-lg-8">
											Dimension LxWxH cm (Approx.)
										</div>
										<div class="col-xs-3 col-sm-4 col-md-4 col-lg-4">
											Weight Kg (Approx.)
										</div>
									</div>
									<div class="row" id="dimsID">
										<div class="dims">
											<div class="col-xs-7 col-sm-6 col-md-6 col-lg-6"><input type="text" name="dims[]" size="25" maxlength="50"></div>
											<div class="col-xs-3 col-sm-4 col-md-4 col-lg-4"><input type="text" name="weights[]" size="6" maxlength="6"></div>
											<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
												<a href="#" id="addScnt"><img src="https://bookingparcel.com/images/add.png"></a>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<hr>
								</div>
							</div>
	';
}
$html .='
							<div class="row">
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="">Total weight in kg (Approx.)&nbsp;:&nbsp;</div>
									<div>
										<input type="text" name="t_weight" id="t_weight">
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="">Are the boxes/Pallets stackable ?</div>
									<div>
										<input type="radio" name="stackable" value="1" id="stackable1">&nbsp;<label for="stackable1">Yes</label><br>
										<input type="radio" name="stackable" value="2" id="stackable2">&nbsp;<label for="stackable2">No</label>
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="">Do you need shipping insurance?</div>
									<div>
										<input type="radio" name="insurance" value="1" id="insurance1">&nbsp;<label for="insurance1">Yes</label><br>
										<input type="radio" name="insurance" value="2" id="insurance2">&nbsp;<label for="insurance2">No</label><br>
										<input type="radio" name="insurance" value="3" id="insurance3">&nbsp;<label for="insurance3">Not sure</label>
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="required">Shipment description and commodity name:&nbsp;</div>
									<div>
										<textarea name="desc" rows="6" cols="21"></textarea>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<hr>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
									<div class="required">Is there any lithium battery in your cargo?</div>
									<div>
										<input type="radio" name="lithium" value="1" id="lithium1">&nbsp;<label for="lithium1">Yes</label><br>
										<input type="radio" name="lithium" value="2" id="lithium2">&nbsp;<label for="lithium2">No</label>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
									<div class="required">Is there any liquid, gas or chemicals inside of your cargo?</div>
									<div>
										<input type="radio" name="chemicals" value="1" id="chemicals1">&nbsp;<label for="chemicals1">Yes</label><br>
										<input type="radio" name="chemicals" value="2" id="chemicals2">&nbsp;<label for="chemicals2">No</label>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
									<div class="required">Is it your cargo DG (Dangerous Goods)?</div>
									<div>
										<input type="radio" name="dg" value="1" id="dg1">&nbsp;<label for="dg1">Yes</label><br>
										<input type="radio" name="dg" value="2" id="dg2">&nbsp;<label for="dg2">No</label>
									</div>
								</div>
							</div>

<script type="text/javascript">
	$(document).ready(function () {
		$("#PreviousID'.$time.'").click(function(event) {
			$(\'#infoi\').show();
			var step = parseInt( $("#quote_form input[name=step]").val() ) - 1;
			
			$.ajax({
				type        : \'POST\', 
				url         : \'ajax_process.php?cmd=previous\', 
				data        : "step="+step, 
				dataType    : \'json\', 
				encode          : true
			})
			
			.done(function(data) {
				
				console.log(data); 
				
				if (data.message !=\'\') {
					$(\'#forms\').replaceWith(\'\' + data.message + \'\');
					if (data.status == false) {
						var html = "<div class=\"row\">";
						$.each(data.errors, function(key, value)
						{
							html += "<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\"><div class=\"alert alert-danger\">";
							html += "<span><strong>"+key+"</strong>&nbsp;:&nbsp;</span>";
							html += "<span>"+value+"</span>";
							html += "</div></div>";
						});
						html += "</div>";
						$(\'#forms\').prepend(html);
					}
			$(\'#infoi\').hide();
				}
				
			});

			
			event.preventDefault();
		});
		$("#NextID'.$time.'").click(function(event) {
			$(\'#infoi\').show();
			event.preventDefault();
			var formData = $("#quote_form").serialize();
			
			$.ajax({
				type        : \'POST\', 
				url         : \'ajax_process.php\', 
				data        : formData, 
				dataType    : \'json\', 
				encode          : true
			})
			
			.done(function(data) {
				
				console.log(data); 
				
				if (data.message !="") {
					$(\'#forms\').replaceWith(\'\' + data.message + \'\');
					if (data.status == false) {
						var html = "<div class=\"row\">";
						$.each(data.errors, function(key, value)
						{
							html += "<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\"><div class=\"alert alert-danger\">";
							html += "<span><strong>"+key+"</strong>&nbsp;:&nbsp;</span>";
							html += "<span>"+value+"</span>";
							html += "</div></div>";
						});
						html += "</div>";
						$(\'#forms\').prepend(html);
					}
			$(\'#infoi\').hide();
				}
				
			});

			
		});
	});
</script>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<hr>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
									<div class="pull-left" style="min-width:80%;"><button type="button" class="btn btn-primary" style="min-width:80%;" id="PreviousID'.$time.'">Previous</button></div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
									<div class="pull-right" style="min-width:80%;"><button type="submit" class="btn btn-primary" style="min-width:80%;" id="NextID'.$time.'">Next</button></div>
								</div>
							</div>
						</form>
						</div>
					</div>
				</div>
';
				
				$data['status'] = true;
				$data['message'] = $html;
			}
			break;
		case 3:
			if(!isset($_SESSION['collection_pt'])) return;
			if(!(isset($_SESSION['containerType']) AND $_SESSION['containerType']==3))
			{
				if(!(isset($_POST['itemCount']) AND is_numeric($_POST['itemCount']) AND $_POST['itemCount']>0))
				{
					$errors['itemCount'] = "invalid itemCount data."; 
				}
				if(!(isset($_POST['dims']) AND is_array($_POST['dims']) AND count($_POST['dims'])>0))
				{
					$errors['dims'] = "invalid dims data."; 
				}
				if(!(isset($_POST['weights']) AND is_array($_POST['weights']) AND count($_POST['weights'])>0 AND count($_POST['weights'])==count($_POST['dims'])))
				{
					$errors['weights'] = "invalid weights data."; 
				}
			}
			
			if(isset($_POST['t_weight']) AND !(trim($_POST['t_weight'])!='' AND $_POST['t_weight']!=null))
			{
				$errors['t_weight'] = "invalid t_weight data."; 
			}
			if(isset($_POST['stackable']) AND !(trim($_POST['stackable'])!='' AND $_POST['stackable']!=null AND in_array($_POST['stackable'],$stackable)))
			{
				$errors['stackable'] = "invalid stackable data."; 
			}
			if(isset($_POST['insurance']) AND !(trim($_POST['insurance'])!='' AND $_POST['insurance']!=null AND in_array($_POST['insurance'],$insurance)))
			{
				$errors['insurance'] = "invalid insurance data."; 
			}
			
			if(!(isset($_POST['desc']) AND trim($_POST['desc'])!='' AND $_POST['desc']!=null))
			{
				$errors['desc'] = "invalid desc data."; 
			}
			if(!(isset($_POST['lithium']) AND trim($_POST['lithium'])!='' AND $_POST['lithium']!=null AND in_array($_POST['lithium'],$lithium)))
			{
				$errors['lithium'] = "invalid lithium data."; 
			}
			if(!(isset($_POST['chemicals']) AND trim($_POST['chemicals'])!='' AND $_POST['chemicals']!=null AND in_array($_POST['chemicals'],$chemicals)))
			{
				$errors['chemicals'] = "invalid chemicals data."; 
			}
			if(!(isset($_POST['dg']) AND trim($_POST['dg'])!='' AND $_POST['dg']!=null AND in_array($_POST['dg'],$dg)))
			{
				$errors['dg'] = "invalid dg data."; 
			}
			
			if ( ! empty($errors)) {
$html .= '

					<div id="forms">
						<div id="infoi" style="display:none;"><div class="loader"></div></div>
						<div class="progress">
						  <div class="progress-bar  progress-bar-primary" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:40%">
							Step #3 - 40% complete
						  </div>
						</div>

						<div class="form_header">
							<h1 style="font-size:30px;padding:20px 1em ;">Shipping quote</h1>
						</div>
						<div id="form_body">
						<form id="quote_form" method="post" action="ajax_process.php">
							<input type="hidden" name="step" value="3">
';
if(!(isset($_SESSION['containerType']) AND $_SESSION['containerType']==3))
{
	$html .='

<script type="text/javascript"> 
			$(document).ready(function () {
					var scntDiv = $(\'#dimsID\');
					var i = $(\'#dimsID div.dims\').size() + 1;
					
					$(\'#addScnt\').on(\'click\', \'img\', function() {
						//alert("yes");
						$(\'<div class="dims"><div class="col-xs-7 col-sm-6 col-md-6 col-lg-6"><input type="text" name="dims[]" size="25" maxlength="50"></div><div class="col-xs-3 col-sm-4 col-md-4 col-lg-4"><input type="text" name="weights[]" size="6" maxlength="6"></div><div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div></div>\').appendTo(scntDiv);
						i++;
						return false;
					});
			});
			
</script>
							<div class="row">
								<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
									<div class="required'.($errors['itemCount']!='' ? " error" : "").'">Nmber of items&nbsp;:&nbsp;</div>
									<div>
										<input type="number" name="itemCount" id="itemCount"'.((!isset($errors['itemCount']) AND isset($_POST['itemCount']) AND $_POST['itemCount']!='') ? " value='".$_POST['itemCount']."'" : "").'>
									</div>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
									<div class="row required'.($errors['dims']!='' ? " error" : "").'">
										<div class="col-xs-9 col-sm-8 col-md-8 col-lg-8">
											Dimension LxWxH cm (Approx.)
										</div>
										<div class="col-xs-3 col-sm-4 col-md-4 col-lg-4">
											Weight Kg (Approx.)
										</div>
									</div>
									<div class="row" id="dimsID">
';
if(!isset($errors['dims']) AND isset($_POST['dims']) AND $_POST['dims']!='')
{
	foreach($_POST['dims'] as $k=>$v)
	{
$html .= '
										<div class="dims">
											<div class="col-xs-7 col-sm-6 col-md-6 col-lg-6"><input type="text" name="dims[]" size="25" maxlength="50" value="'.$v.'"></div>
											<div class="col-xs-3 col-sm-4 col-md-4 col-lg-4"><input type="text" name="weights[]" size="6" maxlength="6" value="'.$_POST['weights'][$k].'"></div>
											<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
												<a href="#" id="addScnt"><img src="https://bookingparcel.com/images/add.png"></a>
											</div>
										</div>
';
	}
}
$html .= '
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<hr>
								</div>
							</div>
	';
}
$html .='
							<div class="row">
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="'.($errors['t_weight']!='' ? " error" : "").'">Total weight in kg (Approx.)&nbsp;:&nbsp;</div>
									<div>
										<input type="text" name="t_weight" id="t_weight"'.((isset($_POST['t_weight']) AND $_POST['t_weight']!='') ? " value='".$_POST['t_weight']."'" : "").'>
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="'.($errors['stackable']!='' ? " error" : "").'">Are the boxes/Pallets stackable ?</div>
									<div>
										<input type="radio" name="stackable" value="1" id="stackable1"'.((!isset($errors['stackable']) AND $_POST['stackable']==1) ? " checked='checked'" : "").'>&nbsp;<label for="stackable1">Yes</label><br>
										<input type="radio" name="stackable" value="2" id="stackable2"'.((!isset($errors['stackable']) AND $_POST['stackable']==2) ? " checked='checked'" : "").'>&nbsp;<label for="stackable2">No</label>
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="'.($errors['insurance']!='' ? " error" : "").'">Do you need shipping insurance?</div>
									<div>
										<input type="radio" name="insurance" value="1" id="insurance1">&nbsp;<label for="insurance1"'.((!isset($errors['insurance']) AND $_POST['insurance']==1) ? " checked='checked'" : "").'>Yes</label><br>
										<input type="radio" name="insurance" value="2" id="insurance2">&nbsp;<label for="insurance2"'.((!isset($errors['insurance']) AND $_POST['insurance']==2) ? " checked='checked'" : "").'>No</label><br>
										<input type="radio" name="insurance" value="3" id="insurance3">&nbsp;<label for="insurance3"'.((!isset($errors['insurance']) AND $_POST['insurance']==3) ? " checked='checked'" : "").'>Not sure</label>
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="required'.($errors['desc']!='' ? " error" : "").'">Shipment description and commodity name:&nbsp;</div>
									<div>
										<textarea name="desc" rows="6" cols="21">'.((!isset($errors['desc']) AND isset($_POST['desc']) AND $_POST['desc']!='') ? "".$_POST['desc']."" : "").'</textarea>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<hr>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
									<div class="required'.($errors['lithium']!='' ? " error" : "").'">Is there any lithium battery in your cargo?</div>
									<div>
										<input type="radio" name="lithium" value="1" id="lithium1"'.((!isset($errors['lithium']) AND $_POST['lithium']==1) ? " checked='checked'" : "").'>&nbsp;<label for="lithium1">Yes</label><br>
										<input type="radio" name="lithium" value="2" id="lithium2"'.((!isset($errors['lithium']) AND $_POST['lithium']==2) ? " checked='checked'" : "").'>&nbsp;<label for="lithium2">No</label>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
									<div class="required'.($errors['chemicals']!='' ? " error" : "").'">Is there any liquid, gas or chemicals inside of your cargo?</div>
									<div>
										<input type="radio" name="chemicals" value="1" id="chemicals1"'.((!isset($errors['chemicals']) AND $_POST['chemicals']==1) ? " checked='checked'" : "").'>&nbsp;<label for="chemicals1">Yes</label><br>
										<input type="radio" name="chemicals" value="2" id="chemicals2"'.((!isset($errors['chemicals']) AND $_POST['chemicals']==2) ? " checked='checked'" : "").'>&nbsp;<label for="chemicals2">No</label>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
									<div class="required'.($errors['dg']!='' ? " error" : "").'">Is it your cargo DG (Dangerous Goods)?</div>
									<div>
										<input type="radio" name="dg" value="1" id="dg1"'.((!isset($errors['dg']) AND $_POST['dg']==1) ? " checked='checked'" : "").'>&nbsp;<label for="dg1">Yes</label><br>
										<input type="radio" name="dg" value="2" id="dg2"'.((!isset($errors['dg']) AND $_POST['dg']==2) ? " checked='checked'" : "").'>&nbsp;<label for="dg2">No</label>
									</div>
								</div>
							</div>


<script type="text/javascript">
	$(document).ready(function () {
		$("#PreviousID'.$time.'").click(function(event) {
			$(\'#infoi\').show();
			var step = parseInt( $("#quote_form input[name=step]").val() ) - 1;
			
			$.ajax({
				type        : \'POST\', 
				url         : \'ajax_process.php?cmd=previous\', 
				data        : "step="+step, 
				dataType    : \'json\', 
				encode          : true
			})
			
			.done(function(data) {
				
				console.log(data); 
				
				if (data.message !=\'\') {
					$(\'#forms\').replaceWith(\'\' + data.message + \'\');
					if (data.status == false) {
						var html = "<div class=\"row\">";
						$.each(data.errors, function(key, value)
						{
							html += "<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\"><div class=\"alert alert-danger\">";
							html += "<span><strong>"+key+"</strong>&nbsp;:&nbsp;</span>";
							html += "<span>"+value+"</span>";
							html += "</div></div>";
						});
						html += "</div>";
						$(\'#forms\').prepend(html);
					}
			$(\'#infoi\').hide();
				}
				
			});

			
			event.preventDefault();
		});
		$("#NextID'.$time.'").click(function(event) {
			$(\'#infoi\').show();
			event.preventDefault();
			var formData = $("#quote_form").serialize();
			
			$.ajax({
				type        : \'POST\', 
				url         : \'ajax_process.php\', 
				data        : formData, 
				dataType    : \'json\', 
				encode          : true
			})
			
			.done(function(data) {
				
				console.log(data); 
				
				if (data.message !="") {
					$(\'#forms\').replaceWith(\'\' + data.message + \'\');
					if (data.status == false) {
						var html = "<div class=\"row\">";
						$.each(data.errors, function(key, value)
						{
							html += "<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\"><div class=\"alert alert-danger\">";
							html += "<span><strong>"+key+"</strong>&nbsp;:&nbsp;</span>";
							html += "<span>"+value+"</span>";
							html += "</div></div>";
						});
						html += "</div>";
						$(\'#forms\').prepend(html);
					}
			$(\'#infoi\').hide();
				}
				
			});

			
		});
	});
</script>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<hr>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
									<div class="pull-left" style="min-width:80%;"><button type="button" class="btn btn-primary" style="min-width:80%;" id="PreviousID'.$time.'">Previous</button></div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
									<div class="pull-right" style="min-width:80%;"><button type="submit" class="btn btn-primary" style="min-width:80%;" id="NextID'.$time.'">Next</button></div>
								</div>
							</div>
						</form>
						</div>
					</div>
				</div>
';
				$data['status'] = false;
				$data['errors']  = $errors;
				$data['message'] = $html;
			}
			else {
				if(!(isset($_SESSION['containerType']) AND $_SESSION['containerType']==3))
				{
					$_SESSION['itemCount'] = $_POST['itemCount'];
					$_SESSION['dims'] = $_POST['dims'];
					$_SESSION['weights'] = $_POST['weights'];
				}
				
				if((isset($_POST['t_weight']) AND trim($_POST['t_weight'])!='' AND $_POST['t_weight']!=null))
				{
					$_SESSION['t_weight'] = $_POST['t_weight'];
				}
				if((isset($_POST['stackable']) AND trim($_POST['stackable'])!='' AND $_POST['stackable']!=null AND in_array($_POST['stackable'],$stackable)))
				{
					$_SESSION['stackable'] = $_POST['stackable'];
				}
				if((isset($_POST['insurance']) AND trim($_POST['insurance'])!='' AND $_POST['insurance']!=null AND in_array($_POST['insurance'],$insurance)))
				{
					$_SESSION['insurance'] = $_POST['insurance'];
				}
				
				$_SESSION['desc'] = $_POST['desc'];
				$_SESSION['lithium'] = $_POST['lithium'];
				$_SESSION['chemicals'] = $_POST['chemicals'];
				$_SESSION['dg'] = $_POST['dg'];
if($_SESSION['lithium']==1 OR $_SESSION['chemicals']==1 OR $_SESSION['dg']==1){
	
$html .= '
<script type="text/javascript"> 
			$(document).ready(function () {
					var scntDiv = $(\'#msdsID\');
					var i = $(\'#msdsID div.msds\').size() + 1;
					
					$(\'#addScntmsds\').on(\'click\', \'img\', function() {
						//alert("yes");
						$(\'<div class="msds"><div class="col-xs-11 col-sm-10 col-md-10 col-lg-10"><input type="file" name="file[]" size="25" maxlength="50"></div><div class="col-xs-1 col-sm-2 col-md-2 col-lg-2"><a href="#" id="addScntmsds"><img src="https://bookingparcel.com/images/add.png"></a></div></div>\').appendTo(scntDiv);
						i++;
						return false;
					});
			});
			
</script>
					<div id="forms">
						<div id="infoi" style="display:none;"><div class="loader"></div></div>
						<div class="progress">
						  <div class="progress-bar  progress-bar-primary" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:50%">
							Step #3B - 50% complete
						  </div>
						</div>

						<div class="form_header">
							<h1 style="font-size:30px;padding:20px 1em ;">Shipping quote</h1>
						</div>
						<div id="form_body">
						<form id="upload_form" method="post" action="ajax_process.php">
							<input type="hidden" name="step" value="33">';
if($_SESSION['dg']==1)
{
$html .= '
							<div class="row">
								<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
									<div class="required">Aircraft Type :</div>
									<div>
										<select id="terms" name="terms" class="drop_down">
											<option></option>
											<option value="0">PAX</option>
											<option value="1">CAO</option>
											<option value="2">Not Sure</option>
										</select>
									</div>
								</div>
								<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
									<div class="required">UN Number & Classification :</div>
									<div><input name="un" type="text" size="10" maxlength="255" placeholder="UN number"><input name="class" type="text" size="12" maxlength="255" placeholder="classification"></div>
								</div>
								<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
									<div class="required">Packing Instruction :</div>
									<div><textarea name="instruction" rows="6" cols="21"></textarea></div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<hr>
								</div>
							</div>
';
}
$html .= '
							<div class="row">
								<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
									<div class="row required">
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
											MSDS files :
										</div>
									</div>
									<div class="row" id="msdsID">
										<div class="msds">
											<div class="col-xs-11 col-sm-10 col-md-10 col-lg-10"><input type="file" name="file[]" size="25" maxlength="50"></div>
											<div class="col-xs-1 col-sm-2 col-md-2 col-lg-2">
												<a href="#" id="addScntmsds"><img src="https://bookingparcel.com/images/add.png"></a>
											</div>
										</div>
									</div>
								</div>
							</div>
<script type="text/javascript">
	$(document).ready(function () {
		$("#PreviousID'.$time.'").click(function(event) {
			$(\'#infoi\').show();
			var step = parseInt( $("#upload_form input[name=step]").val() ) - 1;
			
			$.ajax({
				type        : \'POST\', 
				url         : \'ajax_process.php?cmd=previous\', 
				data        : "step="+step, 
				dataType    : \'json\', 
				encode          : true
			})
			
			.done(function(data) {
				
				console.log(data); 
				
				if (data.message !=\'\') {
					$(\'#forms\').replaceWith(\'\' + data.message + \'\');
					if (data.status == false) {
						var html = "<div class=\"row\">";
						$.each(data.errors, function(key, value)
						{
							html += "<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\"><div class=\"alert alert-danger\">";
							html += "<span><strong>"+key+"</strong>&nbsp;:&nbsp;</span>";
							html += "<span>"+value+"</span>";
							html += "</div></div>";
						});
						html += "</div>";
						$(\'#forms\').prepend(html);
					}
			$(\'#infoi\').hide();
				}
				
			});

			
			event.preventDefault();
		});
		//var files;
		//$(\'input[type=file]\').on(\'change\', function (event)
		//{
		 // files = event.target.files;
		//});
		$("#NextID'.$time.'").click( function (event)
		{
			$(\'#infoi\').show();
			event.stopPropagation(); // Stop stuff happening
			event.preventDefault(); // Totally stop stuff happening

			// START A LOADING SPINNER HERE

			// Create a formdata object and add the files
			//var data = new FormData();
			//$.each(files, function(key, value)
			//{
			//	data.append(key, value);
			//});
			var form = $("#upload_form");
			var formData = new FormData($(this).parents(\'form\')[0]);
			
			$.ajax({
				url: \'ajax_process.php?cmd=files\',
				type: \'POST\',
				data: formData,
				cache: false,
				dataType: \'json\',
				processData: false, // Don\'t process the files
				contentType: false, // Set content type to false as jQuery will tell the server its a query string request
				xhr: function() {
					var myXhr = $.ajaxSettings.xhr();
					return myXhr;
				},
				success: function(data, textStatus, jqXHR)
				{
					if(typeof data.error === \'undefined\')
					{
					}
					else
					{
						// Handle errors here
						console.log(\'ERRORS: \' + data.error);
					}
				},
				error: function(jqXHR, textStatus, errorThrown)
				{
					// Handle errors here
					console.log(\'ERRORS: \' + textStatus);
					// STOP LOADING SPINNER
				}
			})
			
			.done(function(data) {
				
				console.log(data); 
				
				if (data.message !=\'\') {
					$(\'#forms\').replaceWith(\'\' + data.message + \'\');
					if (data.status == false) {
						var html = "<div class=\"row\">";
						$.each(data.errors, function(key, value)
						{
							html += "<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\"><div class=\"alert alert-danger\">";
							html += "<span><strong>"+key+"</strong>&nbsp;:&nbsp;</span>";
							html += "<span>"+value+"</span>";
							html += "</div></div>";
						});
						html += "</div>";
						$(\'#forms\').prepend(html);
					}
			$(\'#infoi\').hide();
				}
				
			});
			return false;
		});
	});
	
</script>


							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<hr>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
									<div class="pull-left" style="min-width:80%;"><button type="button" class="btn btn-primary" style="min-width:80%;" id="PreviousID'.$time.'">Previous</button></div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
									<div class="pull-right" style="min-width:80%;"><button type="submit" class="btn btn-primary" style="min-width:80%;" id="NextID'.$time.'">Next</button></div>
								</div>
							</div>
						</form>
						</div>
					</div>
				</div>
';
}
else{
$html .= '
					<div id="forms">
						<div id="infoi" style="display:none;"><div class="loader"></div></div>
						<div class="progress">
						  <div class="progress-bar  progress-bar-primary" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:60%">
							Step #4 - 60% complete
						  </div>
						</div>

						<div class="form_header">
							<h1 style="font-size:30px;padding:20px 1em ;">Shipping quote</h1>
						</div>
						<div id="form_body">
						<form id="quote_form" method="post" action="ajax_process.php">
							<input type="hidden" name="step" value="4">
							<div class="row">
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class=""><b>Note:</b></div>
									<div>The following contact details are for pricing only, and wont be used for shipping documents.</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="required">Note: having account in <a href="http://cp.bookingparcel.com">User Panel</a> gives you some options such as ticketing and easily tracking and some more.<br>It is not necessary to have account but it is highly recommended.</div>
									<div>
										<input type="radio" name="account" value="1" id="account1">&nbsp;<label for="account1">I have account in <a href="http://cp.bookingparcel.com">User Panel</a> .</label><br>
										<input type="radio" name="account" value="2" id="account2">&nbsp;<label for="account2">I don\'t have account in <a href="http://cp.bookingparcel.com">User Panel</a> .</label>
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="required">Preferred method of contact:&nbsp;</div>
									<div>
										<input type="radio" name="contactMethod" value="1" id="contactMethod1">&nbsp;<label for="contactMethod1">Email</label><br>
										<input type="radio" name="contactMethod" value="2" id="contactMethod2">&nbsp;<label for="contactMethod2">Phone</label><br>
										<input type="radio" name="contactMethod" value="3" id="contactMethod3">&nbsp;<label for="contactMethod3">Any of above</label>
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="required">Preferred time of contact:&nbsp;</div>
									<div>
										<input type="radio" name="contactTime" value="1" id="contactTime1">&nbsp;<label for="contactTime1">Anytime</label><br>
										<input type="radio" name="contactTime" value="2" id="contactTime2">&nbsp;<label for="contactTime2">In the morning</label><br>
										<input type="radio" name="contactTime" value="3" id="contactTime3">&nbsp;<label for="contactTime3">In the afternoon</label><br>
										<input type="radio" name="contactTime" value="4" id="contactTime4">&nbsp;<label for="contactTime4">In the evening</label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<hr>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="">E-mail for receive invoice :</div>
									<div><input type="email" name="invoiceEmail"></div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="">E-mail for receive quote :</div>
									<div><input type="email" name="quoteEmail"></div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="">E-mail for receive prealert :</div>
									<div><input type="email" name="prealertEmail"></div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="">Other CC Email address :</div>
									<div>
									(1):<input type="email" name="cc1"><br>
									(2):<input type="email" name="cc2"><br>
									(3):<input type="email" name="cc3"><br>
									(4):<input type="email" name="cc4"><br>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<hr>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-4 col-md-5 col-lg-5">
									<div class="">your order reference number&nbsp;:</div>
									<div><input type="text" name="orderReference"></div>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-7 col-lg-7">
									<div class="">Note - Goods value:</div>
									<div><textarea name="note" rows="6" cols="21"></textarea></div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<hr>
								</div>
							</div>

<script type="text/javascript">
	$(document).ready(function () {
		$("#PreviousID'.$time.'").click(function(event) {
			$(\'#infoi\').show();
			var step = parseInt( $("#quote_form input[name=step]").val() ) - 1;
			
			$.ajax({
				type        : \'POST\', 
				url         : \'ajax_process.php?cmd=previous\', 
				data        : "step="+step, 
				dataType    : \'json\', 
				encode          : true
			})
			
			.done(function(data) {
				
				console.log(data); 
				
				if (data.message !=\'\') {
					$(\'#forms\').replaceWith(\'\' + data.message + \'\');
					if (data.status == false) {
						var html = "<div class=\"row\">";
						$.each(data.errors, function(key, value)
						{
							html += "<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\"><div class=\"alert alert-danger\">";
							html += "<span><strong>"+key+"</strong>&nbsp;:&nbsp;</span>";
							html += "<span>"+value+"</span>";
							html += "</div></div>";
						});
						html += "</div>";
						$(\'#forms\').prepend(html);
					}
			$(\'#infoi\').hide();
				}
				
			});

			
			event.preventDefault();
		});
		$("#NextID'.$time.'").click(function(event) {
			$(\'#infoi\').show();
			event.preventDefault();
			var formData = $("#quote_form").serialize();
			
			$.ajax({
				type        : \'POST\', 
				url         : \'ajax_process.php\', 
				data        : formData, 
				dataType    : \'json\', 
				encode          : true
			})
			
			.done(function(data) {
				
				console.log(data); 
				
				if (data.message !="") {
					$(\'#forms\').replaceWith(\'\' + data.message + \'\');
					if (data.status == false) {
						var html = "<div class=\"row\">";
						$.each(data.errors, function(key, value)
						{
							html += "<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\"><div class=\"alert alert-danger\">";
							html += "<span><strong>"+key+"</strong>&nbsp;:&nbsp;</span>";
							html += "<span>"+value+"</span>";
							html += "</div></div>";
						});
						html += "</div>";
						$(\'#forms\').prepend(html);
					}
			$(\'#infoi\').hide();
				}
				
			});

			
		});
	});
</script>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<hr>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
									<div class="pull-left" style="min-width:80%;"><button type="button" class="btn btn-primary" style="min-width:80%;" id="PreviousID'.$time.'">Previous</button></div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
									<div class="pull-right" style="min-width:80%;"><button type="submit" class="btn btn-primary" style="min-width:80%;" id="NextID'.$time.'">Next</button></div>
								</div>
							</div>
						</form>
						</div>
					</div>
				</div>
';
}
				$data['status'] = true;
				$data['message'] = $html;
			}
			break;
		case 4:
			if(!isset($_SESSION['desc'])) return;
			if(!(isset($_POST['account']) AND trim($_POST['account'])!='' AND $_POST['account']!=null AND in_array($_POST['account'],$account)))
			{
				$errors['account'] = "invalid account data."; 
			}
			if(!(isset($_POST['contactMethod']) AND trim($_POST['contactMethod'])!='' AND $_POST['contactMethod']!=null AND in_array($_POST['contactMethod'],$contactMethod)))
			{
				$errors['contactMethod'] = "invalid contactMethod data."; 
			}
			if(!(isset($_POST['contactTime']) AND trim($_POST['contactTime'])!='' AND $_POST['contactTime']!=null AND in_array($_POST['contactTime'],$contactTime)))
			{
				$errors['contactTime'] = "invalid contactTime data."; 
			}
			/*
			if(isset($_POST['invoiceEmail']) AND !(trim($_POST['invoiceEmail'])!='' AND $_POST['invoiceEmail']!=null))
			{
				$errors['invoiceEmail'] = "invalid invoiceEmail data."; 
			}
			if(isset($_POST['quoteEmail']) AND !(trim($_POST['quoteEmail'])!='' AND $_POST['quoteEmail']!=null))
			{
				$errors['quoteEmail'] = "invalid quoteEmail data."; 
			}
			if(isset($_POST['prealertEmail']) AND !(trim($_POST['prealertEmail'])!='' AND $_POST['prealertEmail']!=null))
			{
				$errors['prealertEmail'] = "invalid prealertEmail data."; 
			}
			if(isset($_POST['cc1']) AND !(trim($_POST['cc1'])!='' AND $_POST['cc1']!=null))
			{
				$errors['cc1'] = "invalid cc1 data."; 
			}
			if(isset($_POST['cc2']) AND !(trim($_POST['cc2'])!='' AND $_POST['cc2']!=null))
			{
				$errors['cc2'] = "invalid cc2 data."; 
			}
			if(isset($_POST['cc3']) AND !(trim($_POST['cc3'])!='' AND $_POST['cc3']!=null))
			{
				$errors['cc3'] = "invalid cc3 data."; 
			}
			if(isset($_POST['cc4']) AND !(trim($_POST['cc4'])!='' AND $_POST['cc4']!=null))
			{
				$errors['cc4'] = "invalid cc4 data."; 
			}
			if(isset($_POST['note']) AND !(trim($_POST['note'])!='' AND $_POST['note']!=null))
			{
				$errors['note'] = "invalid note data."; 
			}
			if(isset($_POST['orderReference']) AND !(trim($_POST['orderReference'])!='' AND $_POST['orderReference']!=null))
			{
				$errors['orderReference'] = "invalid orderReference data."; 
			}
			*/
			if ( ! empty($errors)) {

$html .= '
					<div id="forms">
						<div id="infoi" style="display:none;"><div class="loader"></div></div>
						<div class="progress">
						  <div class="progress-bar  progress-bar-primary" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:60%">
							Step #4 - 60% complete
						  </div>
						</div>

						<div class="form_header">
							<h1 style="font-size:30px;padding:20px 1em ;">Shipping quote</h1>
						</div>
						<div id="form_body">
						<form id="quote_form" method="post" action="ajax_process.php">
							<input type="hidden" name="step" value="4">
							<div class="row">
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class=""><b>Note:</b></div>
									<div>The following contact details are for pricing only, and wont be used for shipping documents.</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="required'.($errors['account']!='' ? " error" : "").'">Note: having account in <a href="http://cp.bookingparcel.com">User Panel</a> gives you some options such as ticketing and easily tracking and some more.<br>It is not necessary to have account but it is highly recommended.</div>
									<div>
										<input type="radio" name="account" value="1"'.((!isset($errors['account']) AND $_POST['account']==1) ? " checked='checked'" : "").' id="account1">&nbsp;<label for="account1">I have account in <a href="http://cp.bookingparcel.com">User Panel</a> .</label><br>
										<input type="radio" name="account" value="2"'.((!isset($errors['account']) AND $_POST['account']==2) ? " checked='checked'" : "").' id="account2">&nbsp;<label for="account2">I don\'t have account in <a href="http://cp.bookingparcel.com">User Panel</a> .</label>
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="required'.($errors['contactMethod']!='' ? " error" : "").'">Preferred method of contact:&nbsp;</div>
									<div>
										<input type="radio" name="contactMethod" value="1"'.((!isset($errors['contactMethod']) AND $_POST['contactMethod']==1) ? " checked='checked'" : "").' id="contactMethod1">&nbsp;<label for="contactMethod1">Email</label><br>
										<input type="radio" name="contactMethod" value="2"'.((!isset($errors['contactMethod']) AND $_POST['contactMethod']==2) ? " checked='checked'" : "").' id="contactMethod2">&nbsp;<label for="contactMethod2">Phone</label><br>
										<input type="radio" name="contactMethod" value="3"'.((!isset($errors['contactMethod']) AND $_POST['contactMethod']==3) ? " checked='checked'" : "").' id="contactMethod3">&nbsp;<label for="contactMethod3">Any of above</label>
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="required'.($errors['contactTime']!='' ? " error" : "").'">Preferred time of contact:&nbsp;</div>
									<div>
										<input type="radio" name="contactTime" value="1"'.((!isset($errors['contactTime']) AND $_POST['contactTime']==1) ? " checked='checked'" : "").' id="contactTime1">&nbsp;<label for="contactTime1">Anytime</label><br>
										<input type="radio" name="contactTime" value="2"'.((!isset($errors['contactTime']) AND $_POST['contactTime']==2) ? " checked='checked'" : "").' id="contactTime2">&nbsp;<label for="contactTime2">In the morning</label><br>
										<input type="radio" name="contactTime" value="3"'.((!isset($errors['contactTime']) AND $_POST['contactTime']==3) ? " checked='checked'" : "").' id="contactTime3">&nbsp;<label for="contactTime3">In the afternoon</label><br>
										<input type="radio" name="contactTime" value="4"'.((!isset($errors['contactTime']) AND $_POST['contactTime']==4) ? " checked='checked'" : "").' id="contactTime4">&nbsp;<label for="contactTime4">In the evening</label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<hr>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="'.($errors['invoiceEmail']!='' ? " error" : "").'">E-mail for receive invoice :</div>
									<div><input type="email" name="invoiceEmail"'.((isset($_POST['invoiceEmail']) AND $_POST['invoiceEmail']!='') ? " value='".$_POST['invoiceEmail']."'" : "").'></div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="'.($errors['quoteEmail']!='' ? " error" : "").'">E-mail for receive quote :</div>
									<div><input type="email" name="quoteEmail"'.((isset($_POST['quoteEmail']) AND $_POST['quoteEmail']!='') ? " value='".$_POST['quoteEmail']."'" : "").'></div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="'.($errors['prealertEmail']!='' ? " error" : "").'">E-mail for receive prealert :</div>
									<div><input type="email" name="prealertEmail"'.((isset($_POST['prealertEmail']) AND $_POST['prealertEmail']!='') ? " value='".$_POST['prealertEmail']."'" : "").'></div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="'.(($errors['cc1']!='' OR $errors['cc2']!='' OR $errors['cc3']!='' OR $errors['cc4']!='') ? " error" : "").'">Other CC Email address :</div>
									<div>
									(1):<input type="email" name="cc1"'.((isset($_POST['cc1']) AND $_POST['cc1']!='') ? " value='".$_POST['cc1']."'" : "").'><br>
									(2):<input type="email" name="cc2"'.((isset($_POST['cc2']) AND $_POST['cc2']!='') ? " value='".$_POST['cc2']."'" : "").'><br>
									(3):<input type="email" name="cc3"'.((isset($_POST['cc3']) AND $_POST['cc3']!='') ? " value='".$_POST['cc3']."'" : "").'><br>
									(4):<input type="email" name="cc4"'.((isset($_POST['cc4']) AND $_POST['cc4']!='') ? " value='".$_POST['cc4']."'" : "").'><br>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<hr>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-4 col-md-5 col-lg-5">
									<div class="'.($errors['orderReference']!='' ? " error" : "").'">your order reference number&nbsp;:</div>
									<div><input type="text" name="orderReference"'.((isset($_POST['orderReference']) AND $_POST['orderReference']!='') ? " value='".$_POST['orderReference']."'" : "").'></div>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-7 col-lg-7">
									<div class="'.($errors['note']!='' ? " error" : "").'">Note - Goods value:</div>
									<div><textarea name="note" rows="6" cols="21">'.((!isset($errors['note']) AND isset($_POST['note']) AND $_POST['note']!='') ? "".$_POST['note']."" : "").'</textarea></div>
								</div>
							</div>

<script type="text/javascript">
	$(document).ready(function () {
		$("#PreviousID'.$time.'").click(function(event) {
			$(\'#infoi\').show();
			var step = parseInt( $("#quote_form input[name=step]").val() ) - 1;
			
			$.ajax({
				type        : \'POST\', 
				url         : \'ajax_process.php?cmd=previous\', 
				data        : "step="+step, 
				dataType    : \'json\', 
				encode          : true
			})
			
			.done(function(data) {
				
				console.log(data); 
				
				if (data.message !=\'\') {
					$(\'#forms\').replaceWith(\'\' + data.message + \'\');
					if (data.status == false) {
						var html = "<div class=\"row\">";
						$.each(data.errors, function(key, value)
						{
							html += "<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\"><div class=\"alert alert-danger\">";
							html += "<span><strong>"+key+"</strong>&nbsp;:&nbsp;</span>";
							html += "<span>"+value+"</span>";
							html += "</div></div>";
						});
						html += "</div>";
						$(\'#forms\').prepend(html);
					}
			$(\'#infoi\').hide();
				}
				
			});

			
			event.preventDefault();
		});
		$("#NextID'.$time.'").click(function(event) {
			$(\'#infoi\').show();
			event.preventDefault();
			var formData = $("#quote_form").serialize();
			
			$.ajax({
				type        : \'POST\', 
				url         : \'ajax_process.php\', 
				data        : formData, 
				dataType    : \'json\', 
				encode          : true
			})
			
			.done(function(data) {
				
				console.log(data); 
				
				if (data.message !="") {
					$(\'#forms\').replaceWith(\'\' + data.message + \'\');
					if (data.status == false) {
						var html = "<div class=\"row\">";
						$.each(data.errors, function(key, value)
						{
							html += "<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\"><div class=\"alert alert-danger\">";
							html += "<span><strong>"+key+"</strong>&nbsp;:&nbsp;</span>";
							html += "<span>"+value+"</span>";
							html += "</div></div>";
						});
						html += "</div>";
						$(\'#forms\').prepend(html);
					}
			$(\'#infoi\').hide();
				}
				
			});

			
		});
	});
</script>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<hr>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
									<div class="pull-left" style="min-width:80%;"><button type="button" class="btn btn-primary" style="min-width:80%;" id="PreviousID'.$time.'">Previous</button></div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
									<div class="pull-right" style="min-width:80%;"><button type="submit" class="btn btn-primary" style="min-width:80%;" id="NextID'.$time.'">Next</button></div>
								</div>
							</div>
						</form>
						</div>
					</div>
				</div>
';
				$data['status'] = false;
				$data['errors']  = $errors;
				$data['message'] = $html;
			}
			else {
				$_SESSION['account'] = $_POST['account'];
				$_SESSION['contactMethod'] = $_POST['contactMethod'];
				$_SESSION['contactTime'] = $_POST['contactTime'];
		
				if(isset($_POST['invoiceEmail']) AND (trim($_POST['invoiceEmail'])!='' AND $_POST['invoiceEmail']!=null))
				{
					$_SESSION['invoiceEmail'] = $_POST['invoiceEmail'];
				}
				if(isset($_POST['quoteEmail']) AND (trim($_POST['quoteEmail'])!='' AND $_POST['quoteEmail']!=null))
				{
					$_SESSION['quoteEmail'] = $_POST['quoteEmail'];
				}
				if(isset($_POST['prealertEmail']) AND (trim($_POST['prealertEmail'])!='' AND $_POST['prealertEmail']!=null))
				{
					$_SESSION['prealertEmail'] = $_POST['prealertEmail'];
				}
				if(isset($_POST['cc1']) AND (trim($_POST['cc1'])!='' AND $_POST['cc1']!=null))
				{
					$_SESSION['cc1'] = $_POST['cc1'];
				}
				if(isset($_POST['cc2']) AND (trim($_POST['cc2'])!='' AND $_POST['cc2']!=null))
				{
					$_SESSION['cc2'] = $_POST['cc2'];
				}
				if(isset($_POST['cc3']) AND (trim($_POST['cc3'])!='' AND $_POST['cc3']!=null))
				{
					$_SESSION['cc3'] = $_POST['cc3'];
				}
				if(isset($_POST['cc4']) AND (trim($_POST['cc4'])!='' AND $_POST['cc4']!=null))
				{
					$_SESSION['cc4'] = $_POST['cc4'];
				}
				if(isset($_POST['note']) AND (trim($_POST['note'])!='' AND $_POST['note']!=null))
				{
					$_SESSION['note'] = $_POST['note'];
				}
				if(isset($_POST['orderReference']) AND (trim($_POST['orderReference'])!='' AND $_POST['orderReference']!=null))
				{
					$_SESSION['orderReference'] = $_POST['orderReference'];
				}
if($_SESSION['account']==1)//yes
{

$html .= '
					<div id="forms">
						<div id="infoi" style="display:none;"><div class="loader"></div></div>
						<div class="progress">
						  <div class="progress-bar  progress-bar-primary" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:80%">
							Step #5 - 80% complete
						  </div>
						</div>

						<div class="form_header">
							<h1 style="font-size:30px;padding:20px 1em ;">Shipping quote</h1>
						</div>
						<div id="form_body">
						<form id="quote_form" method="post" action="ajax_process.php">
							<input type="hidden" name="step" value="5">
							<div class="row">
								<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
									<div class="required">UserName :</div>
									<div><input name="username" type="text"></div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
									<div class="required">PassWord :</div>
									<div><input name="password" type="password"></div>
								</div>
							</div>

<script type="text/javascript">
	$(document).ready(function () {
		$("#PreviousID'.$time.'").click(function(event) {
			$(\'#infoi\').show();
			var step = parseInt( $("#quote_form input[name=step]").val() ) - 1;
			
			$.ajax({
				type        : \'POST\', 
				url         : \'ajax_process.php?cmd=previous\', 
				data        : "step="+step, 
				dataType    : \'json\', 
				encode          : true
			})
			
			.done(function(data) {
				
				console.log(data); 
				
				if (data.message !=\'\') {
					$(\'#forms\').replaceWith(\'\' + data.message + \'\');
					if (data.status == false) {
						var html = "<div class=\"row\">";
						$.each(data.errors, function(key, value)
						{
							html += "<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\"><div class=\"alert alert-danger\">";
							html += "<span><strong>"+key+"</strong>&nbsp;:&nbsp;</span>";
							html += "<span>"+value+"</span>";
							html += "</div></div>";
						});
						html += "</div>";
						$(\'#forms\').prepend(html);
					}
			$(\'#infoi\').hide();
				}
				
			});

			
			event.preventDefault();
		});
		$("#NextID'.$time.'").click(function(event) {
			$(\'#infoi\').show();
			event.preventDefault();
			var formData = $("#quote_form").serialize();
			
			$.ajax({
				type        : \'POST\', 
				url         : \'ajax_process.php\', 
				data        : formData, 
				dataType    : \'json\', 
				encode          : true
			})
			
			.done(function(data) {
				
				console.log(data); 
				
				if (data.message !="") {
					$(\'#forms\').replaceWith(\'\' + data.message + \'\');
					if (data.status == false) {
						var html = "<div class=\"row\">";
						$.each(data.errors, function(key, value)
						{
							html += "<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\"><div class=\"alert alert-danger\">";
							html += "<span><strong>"+key+"</strong>&nbsp;:&nbsp;</span>";
							html += "<span>"+value+"</span>";
							html += "</div></div>";
						});
						html += "</div>";
						$(\'#forms\').prepend(html);
					}
			$(\'#infoi\').hide();
				}
				
			});

			
		});
	});
</script>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<hr>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
									<div class="pull-left" style="min-width:80%;"><button type="button" class="btn btn-primary" style="min-width:80%;" id="PreviousID'.$time.'">Previous</button></div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
									<div class="pull-right" style="min-width:80%;"><button type="submit" class="btn btn-primary" style="min-width:80%;" id="NextID'.$time.'">Next</button></div>
								</div>
							</div>
						</form>
						</div>
					</div>
				</div>
';
}
else{
$html .= $_SESSION['account'].'
					<div id="forms">
						<div id="infoi" style="display:none;"><div class="loader"></div></div>
						<div class="progress">
						  <div class="progress-bar  progress-bar-primary" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:80%">
							Step #5 - 80% complete
						  </div>
						</div>

						<div class="form_header">
							<h1 style="font-size:30px;padding:20px 1em ;">Shipping quote</h1>
						</div>
						<div id="form_body">
						<form id="quote_form" method="post" action="ajax_process.php">
							<input type="hidden" name="step" value="5">
							<div class="row">
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="required">Phone :</div>
									<div><input name="phone" type="text"></div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="required">E-mail :</div>
									<div><input name="email" type="email"></div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="required">Company :</div>
									<div><input name="company" type="text"></div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="required">Name :</div>
									<div><input name="name" type="text"></div>
								</div>
							</div>

<script type="text/javascript">
	$(document).ready(function () {
		$("#PreviousID'.$time.'").click(function(event) {
			$(\'#infoi\').show();
			var step = parseInt( $("#quote_form input[name=step]").val() ) - 1;
			
			$.ajax({
				type        : \'POST\', 
				url         : \'ajax_process.php?cmd=previous\', 
				data        : "step="+step, 
				dataType    : \'json\', 
				encode          : true
			})
			
			.done(function(data) {
				
				console.log(data); 
				
				if (data.message !=\'\') {
					$(\'#forms\').replaceWith(\'\' + data.message + \'\');
					if (data.status == false) {
						var html = "<div class=\"row\">";
						$.each(data.errors, function(key, value)
						{
							html += "<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\"><div class=\"alert alert-danger\">";
							html += "<span><strong>"+key+"</strong>&nbsp;:&nbsp;</span>";
							html += "<span>"+value+"</span>";
							html += "</div></div>";
						});
						html += "</div>";
						$(\'#forms\').prepend(html);
					}
			$(\'#infoi\').hide();
				}
				
			});

			
			event.preventDefault();
		});
		$("#NextID'.$time.'").click(function(event) {
			$(\'#infoi\').show();
			event.preventDefault();
			var formData = $("#quote_form").serialize();
			
			$.ajax({
				type        : \'POST\', 
				url         : \'ajax_process.php\', 
				data        : formData, 
				dataType    : \'json\', 
				encode          : true
			})
			
			.done(function(data) {
				
				console.log(data); 
				
				if (data.message !="") {
					$(\'#forms\').replaceWith(\'\' + data.message + \'\');
					if (data.status == false) {
						var html = "<div class=\"row\">";
						$.each(data.errors, function(key, value)
						{
							html += "<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\"><div class=\"alert alert-danger\">";
							html += "<span><strong>"+key+"</strong>&nbsp;:&nbsp;</span>";
							html += "<span>"+value+"</span>";
							html += "</div></div>";
						});
						html += "</div>";
						$(\'#forms\').prepend(html);
					}
			$(\'#infoi\').hide();
				}
				
			});

			
		});
	});
</script>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<hr>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
									<div class="pull-left" style="min-width:80%;"><button type="button" class="btn btn-primary" style="min-width:80%;" id="PreviousID'.$time.'">Previous</button></div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
									<div class="pull-right" style="min-width:80%;"><button type="submit" class="btn btn-primary" style="min-width:80%;" id="NextID'.$time.'">Next</button></div>
								</div>
							</div>
						</form>
						</div>
					</div>
				</div>
';
}
				$data['status'] = true;
				$data['message'] = $html;
			}
			break;
		case 5:
			if(!isset($_SESSION['account'])) return;
		
			$con = mysql_connect(DB_HOST,DB_USER,DB_PASS) or die(mysql_error());
			mysql_select_db(DB_NAME, $con) or die(mysql_error());
			
			if($_SESSION['account']==1)//yes
			{								
				function StringSafe($string){
					if(!preg_match("/^([a-z0-9\s\-_:.,،؛?!؟[\]()*\/]|[پچجحخهعغفقثصضشسيبلاآتنمکگوئدذرزطظةيژی])+$/i",$string) || (strpos($string,'<')!==false || strpos($string,'>')!==false )){
						return false;
					}
					return true;
				}
				if(!(isset($_POST['username']) AND trim($_POST['username'])!='' AND $_POST['username']!=null AND StringSafe($_POST['username'])))
				{
					$errors['username'] = "invalid username data";
				}
				if(!(isset($_POST['password']) AND trim($_POST['password'])!='' AND $_POST['password']!=null AND StringSafe($_POST['password'])))
				{
					$errors['password'] = "invalid password data";
				}
				
				if(empty($errors))
				{
					$_SESSION['uname'] = 'fakhimierror';
					$_active_acc = true;
					$email = $name = $company = $uname = $phone = "";
					$qq = mysql_query("SELECT count(*) as counter, email, pwd,company,status,fname,lname,cblacklist FROM `users` WHERE `uname`='".$_POST['username']."'") or die(mysql_error());
					$form_row = mysql_fetch_assoc($qq);
					
					if($form_row['counter']==1)
					{
						$blacklist_Countries = explode("|",$form_row['cblacklist']);
						if($form_row['status']==0)
						{
							//$errors['status'] = "Your account is not allowed to put new quote.";
							$_active_acc = false;
							
						}
						if(in_array($_SESSION['from_country'],$blacklist_Countries))
						{
							$errors['blacklist'] = "You are not permitted to put quote from this country.";
						}
						
						if(empty($errors))
						{
							function VerifyPassWord($pass, $hash){
								return password_verify ($pass, $hash);
							}
							if(VerifyPassWord($_POST['password'], $form_row['pwd']))
							{
								$_SESSION['phone'] = (($form_row['phone']!="" AND $form_row['phone']!=null) ? $form_row['phone'] : "not set");
								$_SESSION['email'] = $form_row['email'];
								$_SESSION['company'] = $form_row['company'];
								$_SESSION['uname'] = $_POST['username'];
								$_SESSION['name'] = $form_row['fname']." ".$form_row['lname'];
							}
							else
							{
								$errors['password'] = "password is not correct!";
							}
					
						}
					}
					else
					{
						$errors['username'] = "user not exist";
					}
				}

			}
			else{
				if(!(isset($_POST['phone']) AND trim($_POST['phone'])!='' AND $_POST['phone']!=null))
				{
					$errors['phone'] = "invalid phone data";
				}
				if(!(isset($_POST['email']) AND trim($_POST['email'])!='' AND $_POST['email']!=null))
				{
					$errors['email'] = "invalid email data";
				}
				if(!(isset($_POST['company']) AND trim($_POST['company'])!='' AND $_POST['company']!=null))
				{
					$errors['company'] = "invalid company data";
				}
				if(!(isset($_POST['name']) AND trim($_POST['name'])!='' AND $_POST['name']!=null))
				{
					$errors['name'] = "invalid name data";
				}
				if(empty($errors))
				{
					$_SESSION['phone'] = $_POST['phone'];
					$_SESSION['email'] = $_POST['email'];
					$_SESSION['company'] = $_POST['company'];
					$_SESSION['name'] = $_POST['name'];
				}
			}
			
			if(!(isset($_SESSION['phone']) AND $_SESSION['phone']!='' AND $_SESSION['phone']!=null))
			{
				$errors['phone'] = "phone is empty";
			}
			if(!(isset($_SESSION['email']) AND $_SESSION['email']!='' AND $_SESSION['email']!=null))
			{
				$errors['email'] = "email is empty";
			}
			if(!(isset($_SESSION['name']) AND $_SESSION['name']!='' AND $_SESSION['name']!=null))
			{
				$errors['name'] = "name is empty";
			}
			if(! empty($errors))
			{
				if($_SESSION['account']==1)//yes
				{

$html .= '
					<div id="forms">
						<div id="infoi" style="display:none;"><div class="loader"></div></div>
						<div class="progress">
						  <div class="progress-bar  progress-bar-primary" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:80%">
							Step #5 - 80% complete
						  </div>
						</div>

						<div class="form_header">
							<h1 style="font-size:30px;padding:20px 1em ;">Shipping quote</h1>
						</div>
						<div id="form_body">
						<form id="quote_form" method="post" action="ajax_process.php">
							<input type="hidden" name="step" value="5">
							<div class="row">
								<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
									<div class="required'.($errors['username']!='' ? " error" : "").'">UserName :</div>
									<div><input name="username" type="text"'.((!isset($errors['username']) AND isset($_POST['username']) AND $_POST['username']!='') ? " value='".$_POST['username']."'" : "").'></div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
									<div class="required'.($errors['username']!='' ? " error" : "").'">PassWord :</div>
									<div><input name="password" type="password"></div>
								</div>
							</div>

<script type="text/javascript">
	$(document).ready(function () {
		$("#PreviousID'.$time.'").click(function(event) {
			$(\'#infoi\').show();
			var step = parseInt( $("#quote_form input[name=step]").val() ) - 1;
			
			$.ajax({
				type        : \'POST\', 
				url         : \'ajax_process.php?cmd=previous\', 
				data        : "step="+step, 
				dataType    : \'json\', 
				encode          : true
			})
			
			.done(function(data) {
				
				console.log(data); 
				
				if (data.message !=\'\') {
					$(\'#forms\').replaceWith(\'\' + data.message + \'\');
					if (data.status == false) {
						var html = "<div class=\"row\">";
						$.each(data.errors, function(key, value)
						{
							html += "<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\"><div class=\"alert alert-danger\">";
							html += "<span><strong>"+key+"</strong>&nbsp;:&nbsp;</span>";
							html += "<span>"+value+"</span>";
							html += "</div></div>";
						});
						html += "</div>";
						$(\'#forms\').prepend(html);
					}
			$(\'#infoi\').hide();
				}
				
			});

			
			event.preventDefault();
		});
		$("#NextID'.$time.'").click(function(event) {
			$(\'#infoi\').show();
			event.preventDefault();
			var formData = $("#quote_form").serialize();
			
			$.ajax({
				type        : \'POST\', 
				url         : \'ajax_process.php\', 
				data        : formData, 
				dataType    : \'json\', 
				encode          : true
			})
			
			.done(function(data) {
				
				console.log(data); 
				
				if (data.message !="") {
					$(\'#forms\').replaceWith(\'\' + data.message + \'\');
					if (data.status == false) {
						var html = "<div class=\"row\">";
						$.each(data.errors, function(key, value)
						{
							html += "<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\"><div class=\"alert alert-danger\">";
							html += "<span><strong>"+key+"</strong>&nbsp;:&nbsp;</span>";
							html += "<span>"+value+"</span>";
							html += "</div></div>";
						});
						html += "</div>";
						$(\'#forms\').prepend(html);
					}
			$(\'#infoi\').hide();
				}
				
			});

			
		});
	});
</script>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<hr>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
									<div class="pull-left" style="min-width:80%;"><button type="button" class="btn btn-primary" style="min-width:80%;" id="PreviousID'.$time.'">Previous</button></div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
									<div class="pull-right" style="min-width:80%;"><button type="submit" class="btn btn-primary" style="min-width:80%;" id="NextID'.$time.'">Next</button></div>
								</div>
							</div>
						</form>
						</div>
					</div>
				</div>
';
				}
				else{
$html .= '
					<div id="forms">
						<div id="infoi" style="display:none;"><div class="loader"></div></div>
						<div class="progress">
						  <div class="progress-bar  progress-bar-primary" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:80%">
							Step #5 - 80% complete
						  </div>
						</div>

						<div class="form_header">
							<h1 style="font-size:30px;padding:20px 1em ;">Shipping quote</h1>
						</div>
						<div id="form_body">
						<form id="quote_form" method="post" action="ajax_process.php">
							<input type="hidden" name="step" value="5">
							<div class="row">
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="required'.($errors['phone']!='' ? " error" : "").'">Phone :</div>
									<div><input name="phone" type="text"></div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="required'.($errors['email']!='' ? " error" : "").'">E-mail :</div>
									<div><input name="email" type="email"></div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="required'.($errors['company']!='' ? " error" : "").'">Company :</div>
									<div><input name="company" type="text"></div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="required'.($errors['name']!='' ? " error" : "").'">Name :</div>
									<div><input name="name" type="text"></div>
								</div>
							</div>

<script type="text/javascript">
	$(document).ready(function () {
		$("#PreviousID'.$time.'").click(function(event) {
			$(\'#infoi\').show();
			var step = parseInt( $("#quote_form input[name=step]").val() ) - 1;
			
			$.ajax({
				type        : \'POST\', 
				url         : \'ajax_process.php?cmd=previous\', 
				data        : "step="+step, 
				dataType    : \'json\', 
				encode          : true
			})
			
			.done(function(data) {
				
				console.log(data); 
				
				if (data.message !=\'\') {
					$(\'#forms\').replaceWith(\'\' + data.message + \'\');
					if (data.status == false) {
						var html = "<div class=\"row\">";
						$.each(data.errors, function(key, value)
						{
							html += "<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\"><div class=\"alert alert-danger\">";
							html += "<span><strong>"+key+"</strong>&nbsp;:&nbsp;</span>";
							html += "<span>"+value+"</span>";
							html += "</div></div>";
						});
						html += "</div>";
						$(\'#forms\').prepend(html);
					}
			$(\'#infoi\').hide();
				}
				
			});

			
			event.preventDefault();
		});
		$("#NextID'.$time.'").click(function(event) {
			$(\'#infoi\').show();
			event.preventDefault();
			var formData = $("#quote_form").serialize();
			
			$.ajax({
				type        : \'POST\', 
				url         : \'ajax_process.php\', 
				data        : formData, 
				dataType    : \'json\', 
				encode          : true
			})
			
			.done(function(data) {
				
				console.log(data); 
				
				if (data.message !="") {
					$(\'#forms\').replaceWith(\'\' + data.message + \'\');
					if (data.status == false) {
						var html = "<div class=\"row\">";
						$.each(data.errors, function(key, value)
						{
							html += "<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\"><div class=\"alert alert-danger\">";
							html += "<span><strong>"+key+"</strong>&nbsp;:&nbsp;</span>";
							html += "<span>"+value+"</span>";
							html += "</div></div>";
						});
						html += "</div>";
						$(\'#forms\').prepend(html);
					}
			$(\'#infoi\').hide();
				}
				
			});

			
		});
	});
</script>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<hr>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
									<div class="pull-left" style="min-width:80%;"><button type="button" class="btn btn-primary" style="min-width:80%;" id="PreviousID'.$time.'">Previous</button></div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
									<div class="pull-right" style="min-width:80%;"><button type="submit" class="btn btn-primary" style="min-width:80%;" id="NextID'.$time.'">Next</button></div>
								</div>
							</div>
						</form>
						</div>
					</div>
				</div>
';
				}
				$data['status'] = false;
				$data['errors']  = $errors;
				$data['message'] = $html;
			}
			else{
				$tmp = "";
				$_c = 0;
				foreach($_SESSION['dims'] as $k=>$v)
				{
					$tmp .= ($_c +1).') '.$v.' => '.$_SESSION['weights'][$k].' kg | ';
					$_c++;
				}
				
				$q = "INSERT INTO `quote` (`fname`, `company`, `phone`, `email`, `pr_contact_m`, `pr_contact_t`, `note`, `item_c`, `dims`, `total_weight`, `insurance`, ";
				$q .="`item_desc`, `from`, `to`, `shipping_type`, `ship_container`, `shipping_sub_type`, `from_st`, `to_st`, `from_location`, `to_location`, `pack_type`, `date`, `exact_date`,";
				$q .="`lithiumb`, `chemical`, `danger`, `timestamp`) VALUES ";
				$q .= "('".$_SESSION['name']."', '".$_SESSION['company']."', '".$_SESSION['phone']."', '".$_SESSION['email']."', '".array_search($_SESSION['contactMethod'],$contactMethod)."', '".array_search($_SESSION['contactTime'],$contactTime)."',";
				$q .= "'".$_SESSION['note']."', '".$_SESSION['itemCount']."', '".$tmp."', '".$_SESSION['t_weight']."', '".array_search($_SESSION['insurance'],$insurance)."',";
				$q .= "'".$_SESSION['desc']."', '".$_SESSION['from_country']."', '".$_SESSION['to_country']."', '".array_search($_SESSION['ship_method'],$ship_method)."', '".array_search($_SESSION['containerType'],$containerType)."', ";
				$q .= "'".array_search($_SESSION['shipMethod'],$shipMethod)."', '".$_SESSION['collection_city']."', '".$_SESSION['destination_city']."', '".$_SESSION['collection_pt']."', '".$_SESSION['delivery_pt']."', '".array_search($_SESSION['ship_kind'],$ship_kind)."', ";
				$q .= "'".(in_array($_SESSION['time'],$timeSelect) ? array_search($_SESSION['time'],$timeSelect) : 'Exact date')."', '".(!in_array($_SESSION['time'],$timeSelect) ? $_SESSION['time'] : '')."', ";
				$q .= "'".array_search($_SESSION['lithium'],$lithium)."', '".array_search($_SESSION['chemicals'],$chemicals)."', '".array_search($_SESSION['dg'],$dg)."', '".$time."');";

				
				mysql_query($q) or die(mysql_error());
				$id = mysql_insert_id($con) or die(mysql_error());
				
				if(isset($_SESSION['cc1']) AND $_SESSION['cc1']!='' AND $_SESSION['cc1']!=null)
				{
					mysql_query("UPDATE `quote` SET `cc1`='".$_SESSION['cc1']."' WHERE `id`='".$id."'") or die(mysql_error());
				}
				if(isset($_SESSION['cc2']) AND $_SESSION['cc2']!='' AND $_SESSION['cc2']!=null)
				{
					mysql_query("UPDATE `quote` SET `cc2`='".$_SESSION['cc2']."' WHERE `id`='".$id."'") or die(mysql_error());
				}
				if(isset($_SESSION['cc3']) AND $_SESSION['cc3']!='' AND $_SESSION['cc3']!=null)
				{
					mysql_query("UPDATE `quote` SET `cc3`='".$_SESSION['cc3']."' WHERE `id`='".$id."'") or die(mysql_error());
				}
				if(isset($_SESSION['cc4']) AND $_SESSION['cc4']!='' AND $_SESSION['cc4']!=null)
				{
					mysql_query("UPDATE `quote` SET `cc4`='".$_SESSION['cc4']."' WHERE `id`='".$id."'") or die(mysql_error());
				}
				
				if(isset($_SESSION['invoiceEmail']) AND $_SESSION['invoiceEmail']!='' AND $_SESSION['invoiceEmail']!=null)
				{
					mysql_query("UPDATE `quote` SET `invemail`='".$_SESSION['invoiceEmail']."' WHERE `id`='".$id."'") or die(mysql_error());
				}
				if(isset($_SESSION['quoteEmail']) AND $_SESSION['quoteEmail']!='' AND $_SESSION['quoteEmail']!=null)
				{
					mysql_query("UPDATE `quote` SET `quotemail`='".$_SESSION['quoteEmail']."' WHERE `id`='".$id."'") or die(mysql_error());
				}
				if(isset($_SESSION['prealertEmail']) AND $_SESSION['prealertEmail']!='' AND $_SESSION['prealertEmail']!=null)
				{
					mysql_query("UPDATE `quote` SET `palrtemail`='".$_SESSION['prealertEmail']."' WHERE `id`='".$id."'") or die(mysql_error());
				}
				
				if(isset($_SESSION['ofac']) AND $_SESSION['ofac']!='' AND $_SESSION['ofac']!=null)
				{
					mysql_query("UPDATE `quote` SET `ofac`='".($_SESSION['ofac'] == 1 ? "Yes" : "No")."' WHERE `id`='".$id."'") or die(mysql_error());
				}
				if(isset($_SESSION['tsa']) AND $_SESSION['tsa']!='' AND $_SESSION['tsa']!=null)
				{
					mysql_query("UPDATE `quote` SET `tsa`='".($_SESSION['tsa'] == 1 ? "Yes" : "No")."' WHERE `id`='".$id."'") or die(mysql_error());
				}
				if(isset($_SESSION['other_country']) AND $_SESSION['other_country']!='' AND $_SESSION['other_country']!=null)
				{
					mysql_query("UPDATE `quote` SET `transit`='".($_SESSION['other_country'] == 1 ? "Yes" : "No")."' WHERE `id`='".$id."'") or die(mysql_error());
				}
				if(isset($_SESSION['transit']) AND $_SESSION['transit']!='' AND $_SESSION['transit']!=null)
				{
					mysql_query("UPDATE `quote` SET `transit_country`='".($_SESSION['transit'] == 'Other' ? $_SESSION['other_transit'] : $_SESSION['transit'])."' WHERE `id`='".$id."'") or die(mysql_error());
				}
				
				
				$tid = '';
				if(isset($_SESSION['orderReference']) AND $_SESSION['orderReference']!='' AND $_SESSION['orderReference']!=null)
				{
					$tid .= "".$_SESSION['orderReference']."-";
				}
				$tid .= "EPX-";
				if($_SESSION['company']!=''){
					$tid .= strtoupper(substr($_SESSION['company'],0,4))."-";
				}
				$tid .= $id;
				
				//$ref= "EPX-".$country_iso[$_SESSION['data']['from']]."-".$country_iso[$_SESSION['data']['to']]."";
				mysql_query("UPDATE `quote` SET `tid` = '".$tid."' WHERE `id`='".$id."'");
								
				if($_SESSION['uname']!="fakhimierror")
				{
					mysql_query("UPDATE `quote` SET `uname` = '".$_SESSION['uname']."' WHERE `id`='".$id."'");
				}
				if($_SESSION['term']!="")
				{
					mysql_query("UPDATE `quote` SET `terms` = '".((isset($_SESSION['other_term']) AND $_SESSION['other_term']!='') ? " value='".$_SESSION['other_term']."'" : $_SESSION['term'])."' WHERE `id`='".$id."'");
				}
				if($_SESSION['stackable']!="")
				{
					mysql_query("UPDATE `quote` SET `stackable` = '".$_SESSION['stackable']."' WHERE `id`='".$id."'");
				}
				
				$subject = "Quote Form (".$tid.")";
$quote_body = "<table cellpadding='5' cellspacing='1' style='margin-left:auto;margin-right:auto;width:100%;border:0px;font-family:tahoma;font-size:12px;direction:ltr;border:thin solid #777;'>
 <tr>
  <td style='background-color:#ffcc33;text-align:left;font-weight:bold;color:#ff3333;' width='80%'>
   Dear  <b>Europost Booking and Sales Department </b>,<br>Here is the details of New order:
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
					<td colspan='9' style='padding:5px;'>Order Information</td>
				</tr>
				<tr style='background-color:#ccc;text-align:center;color:#3a3a3a;'>
					<td colspan='4' width='50%' style='padding:5px;'>Order ID</td>
					<td colspan='5' width='50%' style='padding:5px;'>Tracking ID</td>
				</tr>
				<tr style='background-color:#fff;text-align:center;font-weight:bold;'>
					<td colspan='4' style='padding:15px 0;'>". $id ."</td>
					<td colspan='5' style='padding:15px 0;'>". $tid ."</td>
				</tr>
				<tr style='background-color:#ccc;text-align:center;font-weight:bold;color:#3a3a3a;'>
					<td colspan='9' style='padding:5px;'>Personal Information</td>
				</tr>
				<tr style='background-color:#ccc;text-align:center;color:#3a3a3a;'>
					<td colspan='3' width='20%' style='padding:5px;'>First Name</td>
					<td colspan='2' width='20%'>Phone</td>
					<td colspan='2' width='20%'>Email</td>
					<td colspan='2' width='20%'>Company</td>
				</tr>
				<tr style='background-color:#fff;text-align:center;font-weight:bold;'>
					<td colspan='3' style='padding:15px 0;'>". $_SESSION['name'] ."</td>
					<td colspan='2'>". $_SESSION['phone'] ."</td>
					<td colspan='2'>". $_SESSION['email'] ."</td>
					<td colspan='2'>". $_SESSION['company'] ."</td>
				</tr>
				<tr style='background-color:#ccc;text-align:center;font-weight:bold;color:#3a3a3a;'>
					<td colspan='9' style='padding:5px;'>Package Information</td>
				</tr>
				<tr style='background-color:#ccc;text-align:center;color:#3a3a3a;'>
					<td colspan='1' width='10%' style='padding:5px;color:#ff3333;'>No. of box or packages</td>
					<td colspan='2' width='30%'>Dimension(LxWxH)(cm) </td>
					<td colspan='1' width='10%'>Total Weight(kg)</td>
					<td colspan='1' width='10%'>Insurance</td>
					<td colspan='1' width='10%'>Stackable</td>
					<td colspan='3' width='30%'>Description</td>
				</tr>
				<tr style='background-color:#fff;text-align:center;font-weight:bold;'>
					<td colspan='1' style='padding:15px 0;color:#ff3333;'>". $_SESSION['itemCount'] ."</td>
					<td colspan='2'>". str_replace(" | ","<br>",$tmp) ."</td>
					<td colspan='1'>". $_SESSION['t_weight'] ."</td>
					<td colspan='1'>". array_search($_SESSION['insurance'],$insurance) ."</td>
					<td colspan='1'>". array_search($_SESSION['stackable'],$stackable) ."</td>
					<td colspan='3'>". $_SESSION['desc'] ."</td>
				</tr>
				<tr style='background-color:#ccc;text-align:center;font-weight:bold;color:#3a3a3a;'>
					<td colspan='9' style='padding:5px;'>Shipping Information</td>
				</tr>
				<tr style='background-color:#ccc;text-align:center;color:#3a3a3a;'>
					<td width='10%' style='padding:5px;color:#ff3333;'>From</td>
					<td width='10%' style='padding:5px;color:#ff3333;'>To</td>
					<td width='10%'>Shipping Method</td>
					<td width='10%'>Shipping Container</td>
					<td width='10%'>Shipping Sub-Type</td>
					<td width='15%'>From State</td>
					<td width='15%'>To State</td>
					<td width='10%'>From Location</td>
					<td width='10%'>To Location</td>
				</tr>
				<tr style='background-color:#fff;text-align:center;font-weight:bold;'>
					<td style='padding:15px 0;color:#ff3333;'>". $_SESSION['from_country'] ."</td>
					<td style='padding:15px 0;color:#ff3333;'>". $_SESSION['to_country'] ."</td>
					<td>". array_search($_SESSION['ship_method'],$ship_method) ." ".($_SESSION['ship_method']==1 ? "(Terms : ". ($_SESSION['term'] == 3 ? $_SESSION['other_term'] : array_search($_SESSION['term'],$term)) .")" : '')."</td>
					<td>". array_search($_SESSION['containerType'],$containerType) ."</td>
					<td>". array_search($_SESSION['shipMethod'],$shipMethod) ."</td>
					<td>". $_SESSION['collection_city'] ."</td>
					<td>". $_SESSION['destination_city'] ."</td>
					<td>". $_SESSION['collection_pt'] ."</td>
					<td>". $_SESSION['delivery_pt'] ."</td>
				</tr>
				<tr style='background-color:#ccc;text-align:center;font-weight:bold;color:#3a3a3a;'>
					<td colspan='9' style='padding:5px;'>Other Information</td>
				</tr>
				<tr style='background-color:#ccc;text-align:center;color:#3a3a3a;'>
					<td colspan='1' width='10%'>Preferred Contact Method</td>
					<td colspan='1' width='10%'>Preferred Contact Time</td>
					<td colspan='1' width='30%'>Contact Note</td>
					<td colspan='1' width='20%'>Package Type</td>
					<td colspan='1' width='15%'>Shipping Date</td>
					<td colspan='1' width='15%'>Exact Date</td>
					<td colspan='1' width='15%'>chemical</td>
					<td colspan='1' width='15%'>lithium battery</td>
					<td colspan='1' width='15%'>Dangerous Goods</td>
				</tr>
				<tr style='background-color:#fff;text-align:center;font-weight:bold;'>
					<td colspan='1' style='padding:15px 0;'>". array_search($_SESSION['contactMethod'],$contactMethod) ."</td>
					<td colspan='1' style='padding:15px 0;'>". array_search($_SESSION['contactTime'],$contactTime) ."</td>
					<td colspan='1' style='padding:15px 0;'>". $_SESSION['note'] ."</td>
					<td colspan='1' style='padding:15px 0;'>". array_search($_SESSION['ship_kind'],$ship_kind) ."</td>
					<td colspan='1' style='padding:15px 0;'>". array_search($_SESSION['time'],$timeSelect) ."</td>
					<td colspan='1' style='padding:15px 0;'>". $_SESSION['exact_date'] ."</td>
					<td colspan='1' style='padding:15px 0;'>". array_search($_SESSION['chemicals'],$chemicals) ."</td>
					<td colspan='1' style='padding:15px 0;'>". array_search($_SESSION['lithium'],$lithium) ."</td>
					<td colspan='1' style='padding:15px 0;'>". array_search($_SESSION['dg'],$dg) ."</td>
				</tr>";
if($_SESSION['dg']==1){
				$quote_body .= "
				<tr style='background-color:#ccc;text-align:center;font-weight:bold;color:#3a3a3a;'>
					<td colspan='9' style='padding:5px;'>ِDangerous Goods Information</td>
				</tr>
				<tr style='background-color:#ccc;text-align:center;color:#3a3a3a;'>
					<td colspan='2' width='20%' style='padding:15px 0;'>Aircraft Terms</td>
					<td colspan='2' width='20%' style='padding:15px 0;'>Un Number</td>
					<td colspan='2' width='30%' style='padding:15px 0;'>Classification</td>
					<td colspan='3' width='30%' style='padding:15px 0;'>instruction</td>
				</tr>
				<tr style='background-color:#fff;text-align:center;font-weight:bold;'>
					<td colspan='2' style='padding:15px 0;'>". array_search($_SESSION['terms'],$terms) ."</td>
					<td colspan='2' style='padding:15px 0;'>". $_SESSION['un'] ."</td>
					<td colspan='2' style='padding:15px 0;'>". $_SESSION['class'] ."</td>
					<td colspan='3' style='padding:15px 0;'>". $_SESSION['instruction'] ."</td>
				</tr>";
}
$quote_body .= "			</tbody>
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
</tbody></table>	
";
$customer_body = "<table cellpadding='5' cellspacing='1' style='margin-left:auto;margin-right:auto;width:100%;border:0px;font-family:tahoma;font-size:12px;direction:ltr;border:thin solid #777;'>
 <tr>
  <td style='background-color:#ffcc33;text-align:left;font-weight:bold;color:#ff3333;' width='80%'>
   Dear Customer <b>". $_SESSION['name'] ." </b>,<br>Here is the details of your order:
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
					<td colspan='9' style='padding:5px;'>Order Information</td>
				</tr>
				<tr style='background-color:#ccc;text-align:center;color:#3a3a3a;'>
					<td colspan='4' width='50%' style='padding:5px;'>Order ID</td>
					<td colspan='5' width='50%' style='padding:5px;'>Tracking ID</td>
				</tr>
				<tr style='background-color:#fff;text-align:center;font-weight:bold;'>
					<td colspan='4' style='padding:15px 0;'>". $id ."</td>
					<td colspan='5' style='padding:15px 0;'>". $tid ."</td>
				</tr>
				<tr style='background-color:#ccc;text-align:center;font-weight:bold;color:#3a3a3a;'>
					<td colspan='9' style='padding:5px;'>Personal Information</td>
				</tr>
				<tr style='background-color:#ccc;text-align:center;color:#3a3a3a;'>
					<td colspan='3' width='20%' style='padding:5px;'>First Name</td>
					<td colspan='2' width='20%'>Phone</td>
					<td colspan='2' width='20%'>Email</td>
					<td colspan='2' width='20%'>Company</td>
				</tr>
				<tr style='background-color:#fff;text-align:center;font-weight:bold;'>
					<td colspan='3' style='padding:15px 0;'>". $_SESSION['name'] ."</td>
					<td colspan='2'>". $_SESSION['phone'] ."</td>
					<td colspan='2'>". $_SESSION['email'] ."</td>
					<td colspan='2'>". $_SESSION['company'] ."</td>
				</tr>
				<tr style='background-color:#ccc;text-align:center;font-weight:bold;color:#3a3a3a;'>
					<td colspan='9' style='padding:5px;'>Package Information</td>
				</tr>
				<tr style='background-color:#ccc;text-align:center;color:#3a3a3a;'>
					<td colspan='1' width='10%' style='padding:5px;color:#ff3333;'>No. of box or packages</td>
					<td colspan='2' width='30%'>Dimension(LxWxH)(cm) </td>
					<td colspan='1' width='10%'>Total Weight(kg)</td>
					<td colspan='2' width='10%'>Insurance</td>
					<td colspan='2' width='10%'>Stackable</td>
					<td colspan='3' width='30%'>Description</td>
				</tr>
				<tr style='background-color:#fff;text-align:center;font-weight:bold;'>
					<td colspan='1' style='padding:15px 0;color:#ff3333;'>". $_SESSION['itemCount'] ."</td>
					<td colspan='2'>". str_replace(" | ","<br>",$tmp) ."</td>
					<td colspan='1'>". $_SESSION['t_weight'] ."</td>
					<td colspan='2'>". array_search($_SESSION['insurance'],$insurance) ."</td>
					<td colspan='2'>". array_search($_SESSION['stackable'],$stackable) ."</td>
					<td colspan='3'>". $_SESSION['desc'] ."</td>
				</tr>
				<tr style='background-color:#ccc;text-align:center;font-weight:bold;color:#3a3a3a;'>
					<td colspan='9' style='padding:5px;'>Shipping Information</td>
				</tr>
				<tr style='background-color:#ccc;text-align:center;color:#3a3a3a;'>
					<td width='10%' style='padding:5px;color:#ff3333;'>From</td>
					<td width='10%' style='padding:5px;color:#ff3333;'>To</td>
					<td width='10%'>Shipping Method</td>
					<td width='10%'>Shipping Container</td>
					<td width='10%'>Shipping Sub-Type</td>
					<td width='15%'>From State</td>
					<td width='15%'>To State</td>
					<td width='10%'>From Location</td>
					<td width='10%'>To Location</td>
				</tr>
				<tr style='background-color:#fff;text-align:center;font-weight:bold;'>
					<td style='padding:15px 0;color:#ff3333;'>". $_SESSION['from_country'] ."</td>
					<td style='padding:15px 0;color:#ff3333;'>". $_SESSION['to_country'] ."</td>
					<td>". array_search($_SESSION['ship_method'],$ship_method) ." ".($_SESSION['ship_method']==1 ? "(Terms : ". ($_SESSION['term'] == 3 ? $_SESSION['other_term'] : array_search($_SESSION['term'],$term)) .")" : '')."</td>
					<td>". array_search($_SESSION['containerType'],$containerType) ."</td>
					<td>". array_search($_SESSION['shipMethod'],$shipMethod) ."</td>
					<td>". $_SESSION['collection_city'] ."</td>
					<td>". $_SESSION['destination_city'] ."</td>
					<td>". $_SESSION['collection_pt'] ."</td>
					<td>". $_SESSION['delivery_pt'] ."</td>
				</tr>
				<tr style='background-color:#ccc;text-align:center;font-weight:bold;color:#3a3a3a;'>
					<td colspan='9' style='padding:5px;'>Other Information</td>
				</tr>
				<tr style='background-color:#ccc;text-align:center;color:#3a3a3a;'>
					<td colspan='1' width='10%'>Preferred Contact Method</td>
					<td colspan='1' width='10%'>Preferred Contact Time</td>
					<td colspan='1' width='30%'>Contact Note</td>
					<td colspan='1' width='20%'>Package Type</td>
					<td colspan='1' width='15%'>Shipping Date</td>
					<td colspan='1' width='15%'>Exact Date</td>
					<td colspan='1' width='15%'>chemical</td>
					<td colspan='1' width='15%'>lithium battery</td>
					<td colspan='1' width='15%'>Dangerous Goods</td>
				</tr>
				<tr style='background-color:#fff;text-align:center;font-weight:bold;'>
					<td colspan='1' style='padding:15px 0;'>". array_search($_SESSION['contactMethod'],$contactMethod) ."</td>
					<td colspan='1' style='padding:15px 0;'>". array_search($_SESSION['contactTime'],$contactTime) ."</td>
					<td colspan='1' style='padding:15px 0;'>". $_SESSION['note'] ."</td>
					<td colspan='1' style='padding:15px 0;'>". array_search($_SESSION['ship_kind'],$ship_kind) ."</td>
					<td colspan='1' style='padding:15px 0;'>". array_search($_SESSION['time'],$timeSelect) ."</td>
					<td colspan='1' style='padding:15px 0;'>". $_SESSION['exact_date'] ."</td>
					<td colspan='1' style='padding:15px 0;'>". array_search($_SESSION['chemicals'],$chemicals) ."</td>
					<td colspan='1' style='padding:15px 0;'>". array_search($_SESSION['lithium'],$lithium) ."</td>
					<td colspan='1' style='padding:15px 0;'>". array_search($_SESSION['dg'],$dg) ."</td>
				</tr>";
if($_SESSION['dg']==1){
				$customer_body .= "
				<tr style='background-color:#ccc;text-align:center;font-weight:bold;color:#3a3a3a;'>
					<td colspan='9' style='padding:5px;'>ِDangerous Goods Information</td>
				</tr>
				<tr style='background-color:#ccc;text-align:center;color:#3a3a3a;'>
					<td colspan='2' width='20%' style='padding:15px 0;'>Aircraft Terms</td>
					<td colspan='2' width='20%' style='padding:15px 0;'>Un Number</td>
					<td colspan='2' width='30%' style='padding:15px 0;'>Classification</td>
					<td colspan='3' width='30%' style='padding:15px 0;'>instruction</td>
				</tr>
				<tr style='background-color:#fff;text-align:center;font-weight:bold;'>
					<td colspan='2' style='padding:15px 0;'>". array_search($_SESSION['terms'],$terms) ."</td>
					<td colspan='2' style='padding:15px 0;'>". $_SESSION['un'] ."</td>
					<td colspan='2' style='padding:15px 0;'>". $_SESSION['class'] ."</td>
					<td colspan='3' style='padding:15px 0;'>". $_SESSION['instruction'] ."</td>
				</tr>";
}
$customer_body .= "
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
</tbody></table>	
";

				$official_office_email = null;
				$q = "SELECT * FROM `agents_official_meta` WHERE `cover_counteries` LIKE '%".$_SESSION['from_country']."%' ORDER by `id` DESC";
				$oores = mysql_query($q);
				if(mysql_num_rows($oores) > 0)
				{
					$oorow = mysql_fetch_array($oores);
					$official_office_email = $oorow['master_email'];
				}

				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=utf-8;' . "\r\n";
				$headers .= 'From: Booking Parcel <quote1@bookingparcel.com>' . "\r\n";
				$headers .= 'X-Sender: quote1@bookingparcel.com' . "\r\n";
				
				$mailaddress = $_SESSION['email'];

				require 'admin/mailer/PHPMailerAutoload.php';

				$mail = new PHPMailer;
				////$mail->IsSMTP();
				$mail->Host = "mail.bookingparcel.com";
				//$mail->Port = 25;
				$mail->Port = 587;
				$mail->SMTPOptions = array(
					'ssl' => array(
						'verify_peer' => false,
						'verify_peer_name' => false,
						'allow_self_signed' => true
					)
				);
				//$mail->SMTPDebug = 2;
				$mail->SMTPAuth = true;
				$mail->Username = "quote1@bookingparcel.com";
				$mail->Password = "02May1964@5017@anitapouya";
				$mail->setFrom('aircargo@europostexpress.co.uk', 'Booking Parcel');
				$mail->addReplyTo('aircargo@europostexpress.co.uk', 'Booking Parcel');
				if($official_office_email != null)
				{
					$mail->addReplyTo($official_office_email, 'Booking Parcel (Regional Office)');
				}
				
				$mail->CharSet ="utf-8";
				$mail->isHTML(true);
				$mail->Subject = $subject;
				
				if(isset($_SESSION['attachments']) AND count($_SESSION['attachments'])>0)
				{
					$old_loc = $_SESSION['locations'];
					$new_loc = __DIR__ . DIRECTORY_SEPARATOR  ."Documents" . DIRECTORY_SEPARATOR .$id. DIRECTORY_SEPARATOR  ."msds". DIRECTORY_SEPARATOR  ."";

					if(!is_dir($new_loc))
					{
						mkdir($new_loc, 0755, true);
					}
					
					foreach($_SESSION['attachments'] as $k=>$location)
					{
						$format = strtolower(pathinfo($location,PATHINFO_EXTENSION));

						$newlocation = str_replace($old_loc, $new_loc, $location);

						rename($location, $newlocation);
						if($format!='xls' AND $format!='xlsx' AND $format!='doc' AND $format!='docx')
						{
							$mail->addAttachment($newlocation);
						}
					}
				}
				
				
				$mail->addAddress("quote1@bookingparcel.com", "BookingParcel");
	
				if($official_office_email != null)
				{
					$mail->addAddress($official_office_email, 'Booking Parcel (Regional Office)');
				}
				$mail->Body = $quote_body;
				
				if (!$mail->send()) {
					echo "Quote Mail Not sent<br>";
    echo 'Mailer Error: ' . $mail->ErrorInfo;
				}
				
				$mail->clearAddresses();
				$mail->clearAttachments();
				
				if(isset($_SESSION['attachments']) AND count($_SESSION['attachments'])>0)
				{
					$new_loc = __DIR__ . DIRECTORY_SEPARATOR  ."Documents" . DIRECTORY_SEPARATOR .$id. DIRECTORY_SEPARATOR  ."msds". DIRECTORY_SEPARATOR  ."";


					if (is_dir($new_loc)){
					  if ($dh = opendir($new_loc)){
						while (($file = readdir($dh)) !== false){
							if($file == '.' OR $file=='..') continue;
							$ffile = $new_loc.$file;
							$format = strtolower(pathinfo($ffile,PATHINFO_EXTENSION));
							if($format!='xls' AND $format!='xlsx' AND $format!='doc' AND $format!='docx')
							{
								$mail->addAttachment($ffile);
							}
						}
						closedir($dh);
					  }
					}
				}
				$mail->AddCC('backup1@bookingparcel.com', "BookingParcel(Quote Request)");
				
				$mail->addAddress($mailaddress, "". $_SESSION['name'] ."");
				
				$mail->Body = $customer_body;
				
				if (!$mail->send()) {
					echo "Customer Mail Not sent<br>";
    echo 'Mailer Error: ' . $mail->ErrorInfo;
				}
				
				
				
				// Clear all addresses and attachments for next loop
				$mail->clearAddresses();
				$mail->clearAttachments();
				
				//if($_SESSION['uname']!='fakhimierror' OR $_SESSION['ship_method']!=6)
				//if($_SESSION['account']==1 OR $_SESSION['ship_method']!=6)
				if($_SESSION['account']==1 AND ($_SESSION['uname']!='fakhimierror' AND $_SESSION['ship_method']!=6) AND $_active_acc)
				{
					$mail->AddCC("quote1@bookingparcel.com", "BookingParcel(Quote Request)");
						
					if($official_office_email != null)
					{
						$mail->AddCC($official_office_email, 'Booking Parcel (Regional Office)');
					}
					
					//$q = "SELECT * FROM `agents` WHERE `country`='".$_SESSION['data']['from']."' AND (`cover_city` LIKE '%".$_SESSION['data']['from_state']."%' OR `city`='".$_SESSION['data']['from_state']."') AND `active`=1 AND `fixed`=1 ORDER BY `id` ASC";
					$q = "SELECT * FROM `agents` WHERE `country`='".$_SESSION['from_country']."' AND `active`=1 AND `fixed`=1 ORDER BY `id` ASC";
					$r = mysql_query($q);
					if(mysql_num_rows($r)>0)
					{
						$tmp_r = mysql_fetch_array(mysql_query($q));
						$q = "SELECT * FROM `prenotes` WHERE `title`='Quote Request to Agents' AND `type`=3 ORDER BY `time` DESC LIMIT 0,1";
						$res = mysql_query($q);
						if(mysql_num_rows($res)>0)
						{
							function GenerateURL($id, $aid, $from, $to)
							{
								//global $con;
								$tmp = array(
									substr(md5($id),8,10),
									substr(md5($from),8,10),
									substr(md5($to),8,10)
								);
								$q = "INSERT INTO `urls` (`ref`, `idHash`, `fromHash`, `toHash`, `aref`) VALUES ('".$id."', '".$tmp[0]."', '".$tmp[1]."', '".$tmp[2]."', '".$aid."');";
								//mysql_query($q,$con);
								mysql_query($q);
								return "<a href='http://cp.bookingparcel.com/agents.php?Param1=".$tmp[0]."&Param2=".$tmp[1]."&Param3=".$tmp[2]."'>Click here</a><br>or copy and paste the below URL into your browser:<br>http://cp.bookingparcel.com/agents.php?Param1=".$tmp[0]."&Param2=".$tmp[1]."&Param3=".$tmp[2]."";
							}
							$row = mysql_fetch_array($res);
							$tmp="";
							$_c = 0;
							foreach($_SESSION['dims'] as $k=>$v)
							{
								$tmp .= ($_c +1).') '.$v.' => '.$_SESSION['weights'][$k].' kg | ';
								$_c++;
							}
							$message = $row['message'];
							$message = str_replace("{tid}", $tid, $message);
							$message = str_replace("{GenerateUniqeURL}", GenerateURL($id, $tmp_r['id'], $_SESSION['collection_city'] . " - " .$_SESSION['collection_pt'], $_SESSION['destination_city'] . " - " .$_SESSION['delivery_pt']), $message);
							$message = str_replace("{from_country}", $_SESSION['from_country'], $message);
							$message = str_replace("{to_country}", $_SESSION['to_country'], $message);
							$message = str_replace("{from_loc}", $_SESSION['collection_city'] . " - " .$_SESSION['collection_pt'], $message);
							$message = str_replace("{to_loc}", $_SESSION['destination_city'] . " - " .$_SESSION['delivery_pt'], $message);
							$message = str_replace("{item_count}", $_SESSION['itemCount'], $message);
							$message = str_replace("{item_dims}",  str_replace(" | ","<br>",$tmp), $message);
							$message = str_replace("{item_weight}", $_SESSION['t_weight'], $message);
							$message = str_replace("{item_Desc}", $_SESSION['desc'], $message);
							$message = str_replace("{note_value}", $_SESSION['note'], $message);
							if($_SESSION['from_country'] == 'United States' AND $_SESSION['to_country'] == 'Iran'){
								$message = str_replace("{usa_iran_transit}", "<br> Your Shipper already obtained OFAC license for Export ? ".$_SESSION['ofac']."<br>Your Shipper already registered with TSA database in USA ? ".$_SESSION['tsa']."<br> Would you prefer to transit this order to the destination Via another country? ".($_SESSION['other_country'] == 1 ? "Yes" : "No")."<br>Please Transit Via if possible: ".($_SESSION['transit'] == 'Other' ? $_SESSION['other_transit'] : $_SESSION['transit']), $message);
							}
							else{
								$message = str_replace("{usa_iran_transit}", "", $message);
							
							}
							/*
							{insurance}
							{stackable}
							{chemicals}
							{lithium}
							{dg}
							{shipSubMethod}
							{ship_method}
							*/
							$tags = array("{insurance}", "{stackable}", "{chemicals}", "{lithium}", "{dg}", "{shipSubMethod}", "{ship_method}");
							$tags_replacement = array(
								array_search($_SESSION['insurance'],$insurance),
								array_search($_SESSION['stackable'],$stackable),
								array_search($_SESSION['chemicals'],$chemicals) ,
								array_search($_SESSION['lithium'],$lithium) ,
								array_search($_SESSION['dg'],$dg) ,
								array_search($_SESSION['shipMethod'],$shipMethod) ,
								(array_search($_SESSION['ship_method'],$ship_method) ." ".($_SESSION['ship_method']==1 ? "(Terms : ". ($_SESSION['term'] == 3 ? $_SESSION['other_term'] : array_search($_SESSION['term'],$term)) .")" : ''))
							);
							$message = str_replace($tags, $tags_replacement, $message);
							/*
							$message = str_replace("{insurance}", array_search($_SESSION['insurance'],$insurance), $message);
							$message = str_replace("{stackable}", array_search($_SESSION['stackable'],$stackable), $message);
							$message = str_replace("{chemicals}", array_search($_SESSION['chemicals'],$chemicals) , $message);
							$message = str_replace("{lithium}", array_search($_SESSION['lithium'],$lithium) , $message);
							$message = str_replace("{dg}", array_search($_SESSION['dg'],$dg) , $message);
							$message = str_replace("{shipSubMethod}", array_search($_SESSION['shipMethod'],$shipMethod) , $message);
							$message = str_replace("{ship_method}", (array_search($_SESSION['ship_method'],$ship_method) ." ".($_SESSION['ship_method']==1 ? "(Terms : ". ($_SESSION['term'] == 3 ? $_SESSION['other_term'] : array_search($_SESSION['term'],$term)) .")" : '')), $message);
							*/
							$mail->Subject = "New Quote request from ". $_SESSION['from_country'] .",to ". $_SESSION['to_country'] ." ,ref EPX-".array_search($_SESSION['from_country'],$country)."-".array_search($_SESSION['to_country'],$country)."-".$id."";
							//$mail->Body = $message;
							
							
							$mail->setFrom('quote1@bookingparcel.com', 'Booking Parcel');
							$mail->addReplyTo('quote1@bookingparcel.com', 'Booking Parcel');
							if($official_office_email != null)
							{
								$mail->addReplyTo($official_office_email, 'Booking Parcel (Regional Office)');
							}
							
							while($row2 = mysql_fetch_array($r)){
								
								$body1 = str_replace("{company_name}", $row2['cname'], $message, $_c);
								$body1 = str_replace("agent_name", $row2['fname'], $body1, $_c);
								$mail->Body = $body1;
								
				$mail->Body = "<table cellpadding='5' cellspacing='1' style='margin-left:auto;margin-right:auto;width:100%;border:0px;font-family:tahoma;font-size:12px;direction:ltr;border:thin solid #777;'>
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
									<td colspan='2' style='padding:15px 0;'>
				<span style='font-weight:bold;'>". ($body1) ."</span><br><br>
				Europost Express team</td>
								</tr>
								<tr style='background-color:#ccc;text-align:center;font-weight:bold;color:#3a3a3a;'>
									<td colspan='2' style='padding:5px;'>Note : This mail may have an attachment, please check it if there is any.</td>
								</tr>
							</tbody>
						</table>
						<div style='font-family:tahoma;font-size:12px;direction:ltr;margin:20px;color:#0033cc;'>
				<img src=\"https://bookingparcel.com/logo.gif\" style=\"width:215px;height:50px;\"><br>
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
								$emails = explode("\n",$row2['emails']);
								$emailad = array_shift($emails);
								
								$mail->addAddress($emailad, $row2['fname']);
								if(count($emails)>0 AND FALSE)
								{
									foreach($emails as $e)
									{
										$mail->AddCC($e, $row2['fname']);
									}
								}
								if(isset($_SESSION['attachments']) AND count($_SESSION['attachments'])>0)
								{
									$new_loc = __DIR__ . DIRECTORY_SEPARATOR  ."Documents" . DIRECTORY_SEPARATOR .$id. DIRECTORY_SEPARATOR  ."msds". DIRECTORY_SEPARATOR  ."";


									if (is_dir($new_loc)){
									  if ($dh = opendir($new_loc)){
										while (($file = readdir($dh)) !== false){
											if($file == '.' OR $file=='..') continue;
											$ffile = $new_loc.$file;
											$format = strtolower(pathinfo($ffile,PATHINFO_EXTENSION));
											if($format!='xls' AND $format!='xlsx' AND $format!='doc' AND $format!='docx')
											{
												$mail->addAttachment($ffile);
											}
										}
										closedir($dh);
									  }
									}
								}
								if(!$mail->send())
								{
									echo "sending mail to agent ". $row2['fname'] ." failed<br>";
    echo 'Mailer Error: ' . $mail->ErrorInfo;
								}
								$mail->clearAddresses();
								$mail->clearAttachments();
							}
						}
					}
				}
				session_destroy();
$html .= '
					<div id="forms">
						<div class="progress">
						  <div class="progress-bar  progress-bar-primary" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
							100% complete
						  </div>
						</div>

						<div class="form_header">
							<h1 style="font-size:30px;padding:20px 1em ;">Shipping quote</h1>
						</div>
						<div id="form_body">
							<div class="row">
								<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
									<div class=""><b>Thank you</b>';
									if($_active_acc == false){
										$html .='<br>As your account is not activated, Your order is on hold. We will contact you soon.';
									}
									$html .= '</div>
								</div>
								<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
									<div class="">Tracking ID :</div>
									<div>'.$tid.'</div>
								</div>
								<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
									<div class=""><b>Note</b> :</div>
									<div>One of our agents will call you back soon.</div>
									<div class=""><b>Note</b> :</div>
									<div>Please write down the Tracking ID somewhere for later contact.</div>
								</div>
							</div>
						</div>
					</div>
				</div>
';
				$data['status'] = true;
				$data['message'] = $html;
			}
			break;
	}
}
else{
	$errors['step'] = "invalid form data.";
}
if ( ! empty($errors)) {

	// if there are items in our errors array, return those errors
	$data['status'] = false;
	$data['errors']  = $errors;
}
else {
	$data['status'] = true;
	$data['message'] = $html;
}

}


// return all our data to an AJAX call
echo json_encode($data);