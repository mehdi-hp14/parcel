<!DOCTYPE html>
<html>
<head>
   
   <img src="http://www.bookingparcel.com/logo.gif" alt="europost Express" width="150" height="50">


</html>
<style>

ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #EE1856;
}

li {
  float: left;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover {
  background-color: #F5B041;
}
</style>
</head>
<body>
    

<ul>
    <li><a href="http://www.cp.bookingparcel.com/">Login</a></li>
  <li><a class="active" href="http://www.bookingparcel.com">Home</a></li>
  <li><a href="http://www.bookingparcel.com/about.html">About us</a></li>
  <li><a href="http://www.bookingparcel.com/services.html">Our Services</a></li>
  <li><a href="http://www.bookingparcel.com/prohibited.html">Prohibited and Dangerous Goods Descriptions</a></li>
  <li><a href="http://www.bookingparcel.com/terms.html">Terms & Conditions</a></li>
  <li><a href="http://bookingparcel.com/contact.html">Contact us</a></li>
</ul>

</body>
</html>


<?php
require_once 'php8support.php';

//session_destroy();
session_start();
$iso_country = array(
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
?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>BookingParcel | Euro Post Express</title>
		<meta charset="utf-8"> 
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="bootstrap.min.css">
		<!-- jQuery library -->
		<script src="jquery.min.js"></script>
		<!-- Latest compiled JavaScript -->
		<script src="bootstrap.min.js"></script>
		<meta http-equiv="Content-Type" content="text/html;" />
		<link rel="manifest" href="/manifest.json">
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="theme-color" content="#ffffff">
		<style>
			#forms {
				padding : 0px;
			}
			.form_header{
				border-radius: 25px;
				margin: 1px;
				color: #ff0000;
				background: url(images/red_short.png);
				width: auto;
				background-repeat: repeat;
				background-size: auto;
				padding: 0px;
			}
			.form_header h1{
				padding: 20px 10px;
				border-radius: 6px;
				font-family: Arial,Helvetica,sans-serif;
				text-align:center;
			}
			#form_body {
			 padding:5px 15px;
			}
			.required:after {
				content: "*";
				padding-left:1%;
				color: red;
			}
			.error {
				border: 2px solid red;
			}
			.drop_down{
				font-family: Arial,Helvetica,sans-serif;
				max-width: 200px;
				background-color: #ffffff;
				border: 1px solid #333333;
				color: #000000;
				margin: 6px 0px;
				padding: 4px;
				font-size: 14pt;
			}
			.forms {
				width:360px;
				min-width:360px;
				margin:60px 0px 30px 0px;
				height:auto;
				position:relative;
				float:left;
				overflow:hidden;
			}
			.trustlogo{position: fixed;left: 0;bottom: 0;  z-index: 10000;  }
#infoi {
	border-radius: 25px;
	background: rgba(0, 0, 0, 0.3);
  width: 100%;
  height: 100%;
  position: absolute;
  top: 0;
  left: 0;
}
#infoi {
  z-index: 9999999;
}
.loader {
  color: #004081;
  font-size: 90px;
  text-indent: -9999em;
  overflow: hidden;
  width: 1em;
  height: 1em;
  border-radius: 50%;
  margin: 72px auto;
  position: relative;
  -webkit-transform: translateZ(0);
  -ms-transform: translateZ(0);
  transform: translateZ(0);
  -webkit-animation: load6 1.7s infinite ease, round 1.7s infinite ease;
  animation: load6 1.7s infinite ease, round 1.7s infinite ease;
}
@-webkit-keyframes load6 {
  0% {
    box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
  }
  5%,
  95% {
    box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
  }
  10%,
  59% {
    box-shadow: 0 -0.83em 0 -0.4em, -0.087em -0.825em 0 -0.42em, -0.173em -0.812em 0 -0.44em, -0.256em -0.789em 0 -0.46em, -0.297em -0.775em 0 -0.477em;
  }
  20% {
    box-shadow: 0 -0.83em 0 -0.4em, -0.338em -0.758em 0 -0.42em, -0.555em -0.617em 0 -0.44em, -0.671em -0.488em 0 -0.46em, -0.749em -0.34em 0 -0.477em;
  }
  38% {
    box-shadow: 0 -0.83em 0 -0.4em, -0.377em -0.74em 0 -0.42em, -0.645em -0.522em 0 -0.44em, -0.775em -0.297em 0 -0.46em, -0.82em -0.09em 0 -0.477em;
  }
  100% {
    box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
  }
}
@keyframes load6 {
  0% {
    box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
  }
  5%,
  95% {
    box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
  }
  10%,
  59% {
    box-shadow: 0 -0.83em 0 -0.4em, -0.087em -0.825em 0 -0.42em, -0.173em -0.812em 0 -0.44em, -0.256em -0.789em 0 -0.46em, -0.297em -0.775em 0 -0.477em;
  }
  20% {
    box-shadow: 0 -0.83em 0 -0.4em, -0.338em -0.758em 0 -0.42em, -0.555em -0.617em 0 -0.44em, -0.671em -0.488em 0 -0.46em, -0.749em -0.34em 0 -0.477em;
  }
  38% {
    box-shadow: 0 -0.83em 0 -0.4em, -0.377em -0.74em 0 -0.42em, -0.645em -0.522em 0 -0.44em, -0.775em -0.297em 0 -0.46em, -0.82em -0.09em 0 -0.477em;
  }
  100% {
    box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
  }
}
@-webkit-keyframes round {
  0% {
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@keyframes round {
  0% {
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}


		</style>
<script type="text/javascript">//<![CDATA[
var tlJsHost = ((window.location.protocol == "https:") ? "https://secure.comodo.com/" : "http://www.trustlogo.com/");
document.write(unescape("%3Cscript src='" + tlJsHost + "trustlogo/javascript/trustlogo.js' type='text/javascript'%3E%3C/script%3E"));
//]]>
			
			
				function CountryFunction(a,b)
				{
					//{firstName:"John", lastName:"Doe", age:46}
					<?php 
						$_c = 1;
						$temp = "[";
						foreach($iso_country as $k=>$v)
						{
							$temp .= '{value:"'.$k.'", text:"'.$v.'"}';
							if($_c < count($iso_country)) $temp .=',';
							$_c++;
						}
						$temp .= "]";
					?>
					var Countries = <?php echo $temp; ?>;
					switch(a)
					{
						case 'from':
							$('#from_country').find('option').remove().end().append($('<option>', {
								value: 'GBR',
								text: 'United Kingdom',
								selected : true
							}));
							$('#to_country').find('option').remove().end();
							$.each(Countries, function (i, item) {
								if(item.value === 'GBR')
								{
								}
								else
								{
									$('#to_country').append($('<option>', { 
										value: item.value,
										text : item.text 
									}));
								}
							});
							break;
						case 'to':
							$('#to_country').find('option').remove().end().append($('<option>', {
								value: 'GBR',
								text: 'United Kingdom',
								selected : true
							}));
							$('#from_country').find('option').remove().end();
							$.each(Countries, function (i, item) {
								if(item.value === 'GBR')
								{
								}
								else
								{
									$('#from_country').append($('<option>', { 
										value: item.value,
										text : item.text 
									}));
								}
							});
							break;
						case 'other':
							$('#from_country').find('option').remove().end();
							$('#to_country').find('option').remove().end();
							$.each(Countries, function (i, item) {
								$('#to_country').append($('<option>', { 
									value: item.value,
									text : item.text 
								}));
								$('#from_country').append($('<option>', { 
									value: item.value,
									text : item.text 
								}));
							});
							break;
					}
				}
				function HandleTimeSelection()
				{
					var value = $("#when_time").val();
					if(value == 3)
					{
						$("#exact_date").show();
					}
				}
				function HandleAirTermSelection()
				{
					var value = $("#terms").val();
					if(value == 3)
					{
						$("#other_term").show();
					}
				}
				function HandleTransitSelection()
				{
					var value = $("#transit").val();
					if(value == "Other")
					{
						$("#other_transit").show();
					}
				}
				function HandleFCLSelection(a)
				{
					if(a == 1)
					{
						$("#fcl_div").show();
					}
					else
					{
						$("#fcl_div").hide();
					}
				}
			$(document).ready(function () {
				/*
				var files;
				$('input[type=file]').on('change', function (event)
				{
				  files = event.target.files;
				});
				$('#upload_form').on('submit', function (event)
				{
					event.stopPropagation(); // Stop stuff happening
					event.preventDefault(); // Totally stop stuff happening

					// START A LOADING SPINNER HERE

					// Create a formdata object and add the files
					var data = new FormData();
					$.each(files, function(key, value)
					{
						data.append(key, value);
					});

					$.ajax({
						url: 'ajax_process.php?cmd=files',
						type: 'POST',
						data: data,
						cache: false,
						dataType: 'json',
						processData: false, // Don't process the files
						contentType: false, // Set content type to false as jQuery will tell the server its a query string request
						success: function(data, textStatus, jqXHR)
						{
							if(typeof data.error === 'undefined')
							{
								// Success so call function to process the form
								submitForm(event, data);
							}
							else
							{
								// Handle errors here
								console.log('ERRORS: ' + data.error);
							}
						},
						      // add listener to XMLHTTPRequest object directly for progress (jquery doesn't have this yet)
						onprogress: function (progress) {
							// calculate upload progress
							var percentage = Math.floor((progress.total / progress.totalSize) * 100);
							// log upload progress to console
							console.log('progress', percentage);
							if (percentage === 100) {
								console.log('DONE!');
							}
						},
						error: function(jqXHR, textStatus, errorThrown)
						{
							// Handle errors here
							console.log('ERRORS: ' + textStatus);
							// STOP LOADING SPINNER
						}
					});
				});

				*/
				
				
				
				
				/*$('#quote_form').submit(function(event) {
					event.preventDefault();
					var formData = $('#quote_form').serialize();
					
					$.ajax({
						type        : 'POST', 
						url         : 'ajax_process.php', 
						data        : formData, 
						dataType    : 'json', 
						encode          : true
					})
					
					.done(function(data) {
						
						console.log(data); 
						
						if (data.message !='') {
							$('#forms').replaceWith('' + data.message + '');
						}
						
					});

					
				});
				// id="previousbtn"
				$("#previousbtn").click(function(event) {
					var step = parseInt( $("#quote_form input[name=step]").val() ) - 1;
					
					$.ajax({
						type        : 'POST', 
						url         : 'ajax_process.php?cmd=previous', 
						data        : formData, 
						dataType    : 'json', 
						encode          : true
					})
					
					.done(function(data) {
						
						console.log(data); 
						
						if (data.message !='') {
							$('#forms').replaceWith('' + data.message + '');
						}
						
					});

					
					event.preventDefault();
				});
				*/
			});
			
			
		</script>
	</head>
	<body bgcolor="#ffffff">
<!--		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="766" height="650" id="index" align="middle">
					<param name="allowScriptAccess" value="sameDomain" />
					<param name="movie" value="index.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" /><embed src="index.swf" quality="high" bgcolor="#ffffff" width="766" height="650" name="index" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
					</object>
				</div>
			</div>
		</div>-->
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
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
									<div class="required">Please Select&nbsp;:&nbsp;</div>
									<div>
										<input type="radio" name="ship_type" value="1" id="ShipType1" OnClick="CountryFunction('from','uk');" required="true">&nbsp;<label for="ShipType1">Shipping from the UK</label><br>
										<input type="radio" name="ship_type" value="2" id="ShipType2" OnClick="CountryFunction('to','uk');" required="true">&nbsp;<label for="ShipType2">Shipping to the UK</label><br>
										<input type="radio" name="ship_type" value="3" id="ShipType3" OnClick="CountryFunction('other','');" required="true">&nbsp;<label for="ShipType3">Other</label>
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="required">Collection Country&nbsp;:&nbsp;</div>
									<div>
										<select class="drop_down" name="from_country" id="from_country" required="true">
											<option>---</option>
										</select>
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="required">Destination Country&nbsp;:&nbsp;</div>
									<div>
										<select class="drop_down" name="to_country" id="to_country" required="true">
											<option>---</option>
										</select>
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="required">Shipping type&nbsp;:&nbsp;</div>
									<div>
										<input type="radio" name="ship_kind" value="1" id="ShipKind1" required="true">&nbsp;<label for="ShipKind1">Comercial</label><br>
										<input type="radio" name="ship_kind" value="2" id="ShipKind2" required="true">&nbsp;<label for="ShipKind2">Personal</label>
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
											<option value="0">ASAP</option>
											<option value="1">This week</option>
											<option value="2">This month</option>
											<option value="3">Enter exact date</option>
											<option value="4">Not sure when</option>
										</select>
									</div>
									<div style="display:none;" id="exact_date">
										<div class="required">Please enter a date :</div>
										<div><input name="exact_date" type="text"></div>
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="required">Collection City&nbsp;:&nbsp;</div>
									<div>
										<input type="text" name="collection_city" required="true">
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="required">Destination City&nbsp;:&nbsp;</div>
									<div>
										<input type="text" name="destination_city" required="true">
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
									<div class="required">Shipping method&nbsp;:&nbsp;</div>
									<div>
										<input type="radio" name="ship_method" value="1" id="ShipMethod1" required="true">&nbsp;<label for="ShipMethod1">Air</label><br>
										<input type="radio" name="ship_method" value="2" id="ShipMethod2" required="true">&nbsp;<label for="ShipMethod2">Sea</label><br>
										<input type="radio" name="ship_method" value="3" id="ShipMethod3" required="true">&nbsp;<label for="ShipMethod3">Land</label><br>
										<input type="radio" name="ship_method" value="4" id="ShipMethod4" required="true">&nbsp;<label for="ShipMethod4">Rail Way</label><br>
										<input type="radio" name="ship_method" value="6" id="ShipMethod6" required="true">&nbsp;<label for="ShipMethod6">Charter</label><br>
										<input type="radio" name="ship_method" value="5" id="ShipMethod5" required="true">&nbsp;<label for="ShipMethod5">Not Sure</label>
									</div>
								</div>
							</div>
<script type="text/javascript">
	$(document).ready(function () {
		$("#PreviousID").click(function(event) {
			$('#infoi').show();
			var step = parseInt( $("#quote_form input[name=step]").val() ) - 1;
			
			$.ajax({
				type        : 'POST', 
				url         : 'ajax_process.php?cmd=previous', 
				data        : "step="+step, 
				dataType    : 'json', 
				encode          : true
			})
			
			.done(function(data) {
				
				//console.log(data); 
				
				if (data.message !='') {
					$('#forms').replaceWith('' + data.message + '');
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
						$('#forms').prepend(html);
					}
					$('#infoi').hide();
				}
				
			});

			
			event.preventDefault();
		});
		$("#NextID").click(function(event) {
			$('#infoi').show();
			event.preventDefault();
			var formData = $("#quote_form").serialize();
			
			$.ajax({
				type        : 'POST', 
				url         : 'ajax_process.php', 
				data        : formData, 
				dataType    : 'json', 
				encode          : true
			})
			
			.done(function(data) {
				
				console.log(data); 
				
				if (data.message !="") {
					$('#forms').replaceWith('' + data.message + '');
					
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
						$('#forms').prepend(html);
					}
					
				}
					$('#infoi').hide();
				
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
									<div class="pull-left" style="min-width:80%;"><button type="button" class="btn btn-primary" style="min-width:80%;" id="PreviousID">I have tracking code</button></div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
									<div class="pull-right" style="min-width:80%;"><button type="submit" class="btn btn-primary" style="min-width:80%;" id="NextID">Next</button></div>
								</div>
							</div>
						</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Histats.com  START (hidden counter) -->
<img  src="https://sstatic1.histats.com/0.gif?3417786&101" alt="free hit counter code" border="0">
<!-- Histats.com  END  -->

<div class="trustlogo">
<script language="JavaScript" type="text/javascript">
TrustLogo("https://bookingparcel.com/comodo_secure_seal_113x59_transp.png", "CL1", "none");
</script>
<a  href="https://ssl.comodo.com" id="comodoTL">Comodo SSL</a>
</div>
	</body>
</html>