<?php
include("cnf.php");
session_start();
//print_r($_SESSION);echo "<br>";

$country_iso = array(
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
	//'Test Country'=>'TSTC',
	'Zimbabwe'=>'ZWE'
	
);
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

$post_c = array(
	//'Radio-00'=>'Test Country',
	'Radio-0'=>'Afghanistan',
	'Radio-1'=>'Albania',
	'Radio-2'=>'Algeria',
	'Radio-3'=>'Andorra',
	'Radio-4'=>'Angola',
	'Radio-5'=>'Antigua',
	'Radio-6'=>'Argentina',
	'Radio-7'=>'Armenia',
	'Radio-8'=>'Australia',
	'Radio-9'=>'Austria',
	'Radio-10'=>'Azerbaijan',
	'Radio-11'=>'Bahamas',
	'Radio-12'=>'Bahrain',
	'Radio-13'=>'Bangladesh',
	'Radio-14'=>'Barbados',
	'Radio-15'=>'Belarus',
	'Radio-16'=>'Belgium',
	'Radio-17'=>'Belize',
	'Radio-18'=>'Benin',
	'Radio-19'=>'Bhutan',
	'Radio-20'=>'Bolivia',
	'Radio-21'=>'Bosnia Herzegovina',
	'Radio-22'=>'Botswana',
	'Radio-23'=>'Brazil',
	'Radio-24'=>'Brunei',
	'Radio-25'=>'Bulgaria',
	'Radio-26'=>'Burkina',
	'Radio-27'=>'Burundi',
	'Radio-28'=>'Cambodia',
	'Radio-29'=>'Cameroon',
	'Radio-30'=>'Canada',
	'Radio-31'=>'Cape Verde',
	'Radio-32'=>'Central African Rep',
	'Radio-33'=>'Chad',
	'Radio-34'=>'Chile',
	'Radio-35'=>'China',
	'Radio-36'=>'Colombia',
	'Radio-37'=>'Comoros',
	'Radio-38'=>'Congo',
	'Radio-39'=>'Congo',
	'Radio-40'=>'Costa Rica',
	'Radio-41'=>'Croatia',
	'Radio-42'=>'Cuba',
	'Radio-43'=>'Cyprus',
	'Radio-44'=>'Czech Republic',
	'Radio-45'=>'Denmark',
	'Radio-46'=>'Djibouti',
	'Radio-47'=>'Dominica',
	'Radio-48'=>'Dominican Republic',
	'Radio-49'=>'East Timor',
	'Radio-50'=>'Ecuador',
	'Radio-51'=>'Egypt',
	'Radio-52'=>'El Salvador',
	'Radio-53'=>'Equatorial Guinea',
	'Radio-54'=>'Eritrea',
	'Radio-55'=>'Estonia',
	'Radio-56'=>'Ethiopia',
	'Radio-57'=>'Fiji',
	'Radio-58'=>'Finland',
	'Radio-59'=>'France',
	'Radio-60'=>'Gabon',
	'Radio-61'=>'Gambia',
	'Radio-62'=>'Georgia',
	'Radio-63'=>'Germany',
	'Radio-64'=>'Ghana',
	'Radio-65'=>'Greece',
	'Radio-66'=>'Grenada',
	'Radio-67'=>'Guatemala',
	'Radio-68'=>'Guinea',
	'Radio-69'=>'Guinea-Bissau',
	'Radio-70'=>'Guyana',
	'Radio-71'=>'Haiti',
	'Radio-72'=>'Honduras',
	'Radio-195'=>'Hong Kong',
	'Radio-73'=>'Hungary',
	'Radio-74'=>'Iceland',
	'Radio-75'=>'India',
	'Radio-76'=>'Indonesia',
	'Radio-77'=>'Iran',
	'Radio-78'=>'Iraq',
	'Radio-79'=>'Ireland (Republic)',
	'Radio-80'=>'Israel',
	'Radio-81'=>'Italy',
	'Radio-82'=>'Ivory Coast',
	'Radio-83'=>'Jamaica',
	'Radio-84'=>'Japan',
	'Radio-85'=>'Jordan',
	'Radio-86'=>'Kazakhstan',
	'Radio-87'=>'Kenya',
	'Radio-88'=>'Kiribati',
	'Radio-89'=>'Korea North',
	'Radio-90'=>'Korea South',
	'Radio-91'=>'Kosovo',
	'Radio-92'=>'Kuwait',
	'Radio-93'=>'Kyrgyzstan',
	'Radio-94'=>'Laos',
	'Radio-95'=>'Latvia',
	'Radio-96'=>'Lebanon',
	'Radio-97'=>'Lesotho',
	'Radio-98'=>'Liberia',
	'Radio-99'=>'Libya',
	'Radio-100'=>'Liechtenstein',
	'Radio-101'=>'Lithuania',
	'Radio-102'=>'Luxembourg',
	'Radio-103'=>'Macedonia',
	'Radio-104'=>'Madagascar',
	'Radio-105'=>'Malawi',
	'Radio-106'=>'Malaysia',
	'Radio-107'=>'Maldives',
	'Radio-108'=>'Mali',
	'Radio-109'=>'Malta',
	'Radio-110'=>'Marshall Islands',
	'Radio-111'=>'Mauritania',
	'Radio-112'=>'Mauritius',
	'Radio-113'=>'Mexico',
	'Radio-114'=>'Micronesia',
	'Radio-115'=>'Moldova',
	'Radio-116'=>'Monaco',
	'Radio-117'=>'Mongolia',
	'Radio-118'=>'Montenegro',
	'Radio-119'=>'Morocco',
	'Radio-120'=>'Mozambique',
	'Radio-121'=>'Myanmar (Burma)',
	'Radio-122'=>'Namibia',
	'Radio-123'=>'Nauru',
	'Radio-124'=>'Nepal',
	'Radio-125'=>'Netherlands',
	'Radio-126'=>'New Zealand',
	'Radio-127'=>'Nicaragua',
	'Radio-128'=>'Niger',
	'Radio-129'=>'Nigeria',
	'Radio-130'=>'Norway',
	'Radio-131'=>'Oman',
	'Radio-132'=>'Pakistan',
	'Radio-133'=>'Palau',
	'Radio-134'=>'Panama',
	'Radio-135'=>'Papua New Guinea',
	'Radio-136'=>'Paraguay',
	'Radio-137'=>'Peru',
	'Radio-138'=>'Philippines',
	'Radio-139'=>'Poland',
	'Radio-140'=>'Portugal',
	'Radio-141'=>'Qatar',
	'Radio-142'=>'Romania',
	'Radio-143'=>'Russian Federation',
	'Radio-144'=>'Rwanda',
	'Radio-145'=>'St Kitts & Nevis',
	'Radio-146'=>'St Lucia',
	'Radio-147'=>'Saint Vincent',
	'Radio-148'=>'Samoa',
	'Radio-149'=>'San Marino',
	'Radio-150'=>'Sao Tome Principe',
	'Radio-151'=>'Saudi Arabia',
	'Radio-152'=>'Senegal',
	'Radio-153'=>'Serbia',
	'Radio-154'=>'Seychelles',
	'Radio-155'=>'Sierra Leone',
	'Radio-156'=>'Singapore',
	'Radio-157'=>'Slovakia',
	'Radio-158'=>'Slovenia',
	'Radio-159'=>'Solomon Islands',
	'Radio-160'=>'Somalia',
	'Radio-161'=>'South Africa',
	'Radio-162'=>'Spain',
	'Radio-163'=>'Sri Lanka',
	'Radio-164'=>'Sudan',
	'Radio-165'=>'Suriname',
	'Radio-166'=>'Swaziland',
	'Radio-167'=>'Sweden',
	'Radio-168'=>'Switzerland',
	'Radio-169'=>'Syria',
	'Radio-170'=>'Taiwan',
	'Radio-171'=>'Tajikistan',
	'Radio-172'=>'Tanzania',
	'Radio-173'=>'Thailand',
	'Radio-174'=>'Togo',
	'Radio-175'=>'Tonga',
	'Radio-176'=>'Trinidad & Tobago',
	'Radio-177'=>'Tunisia',
	'Radio-178'=>'Turkey',
	'Radio-179'=>'Turkmenistan',
	'Radio-180'=>'Tuvalu',
	'Radio-181'=>'Uganda',
	'Radio-182'=>'Ukraine',
	'Radio-183'=>'United Arab Emirates',
	'Radio-184'=>'United Kingdom',
	'Radio-185'=>'United States',
	'Radio-186'=>'Uruguay',
	'Radio-187'=>'Uzbekistan',
	'Radio-188'=>'Vanuatu',
	'Radio-189'=>'Vatican City',
	'Radio-190'=>'Venezuela',
	'Radio-191'=>'Vietnam',
	'Radio-192'=>'Yemen',
	'Radio-193'=>'Zambia',
	'Radio-194'=>'Zimbabwe'
);
$country= array(
	"AF"	=>	"Afghanistan",
	"AX"	=>	"Aland Islands",
	"AL"	=>	"Albania",
	"DZ"	=>	"Algeria",
	"AS"	=>	"American Samoa",
	"AD"	=>	"Andorra",
	"AO"	=>	"Angola",
	"AI"	=>	"Anguilla",
	"AG"	=>	"Antigua And Barbuda",
	"AR"	=>	"Argentina",
	"AM"	=>	"Armenia",
	"AW"	=>	"Aruba",
	"AU"	=>	"Australia",
	"AT"	=>	"Austria",
	"AZ"	=>	"Azerbaijan",
	"BS"	=>	"Bahamas",
	"BH"	=>	"Bahrain",
	"BD"	=>	"Bangladesh",
	"BB"	=>	"Barbados",
	"BY"	=>	"Belarus",
	"BE"	=>	"Belgium",
	"BZ"	=>	"Belize",
	"BJ"	=>	"Benin",
	"BM"	=>	"Bermuda",
	"BT"	=>	"Bhutan",
	"BO"	=>	"Bolivia",
	"BA"	=>	"Bosnia And Herzegovina",
	"BW"	=>	"Botswana",
	"BR"	=>	"Brazil",
	"IO"	=>	"British Indian Ocean Territory",
	"BN"	=>	"Brunei Darussalam",
	"BG"	=>	"Bulgaria",
	"BF"	=>	"Burkina Faso",
	"BI"	=>	"Burundi",
	"KH"	=>	"Cambodia",
	"CM"	=>	"Cameroon",
	"CA"	=>	"Canada",
	"CV"	=>	"Cape Verde",
	"KY"	=>	"Cayman Islands",
	"CF"	=>	"Central African Republic",
	"TD"	=>	"Chad",
	"CL"	=>	"Chile",
	"CN"	=>	"China",
	"CX"	=>	"Christmas Island",
	"CC"	=>	"Cocos (Keeling) Islands",
	"CO"	=>	"Colombia",
	"KM"	=>	"Comoros",
	"CG"	=>	"Congo",
	"CD"	=>	"Congo, Democratic Republic",
	"CK"	=>	"Cook Islands",
	"CR"	=>	"Costa Rica",
	"CI"	=>	"Cote D'Ivoire",
	"HR"	=>	"Croatia",
	"CU"	=>	"Cuba",
	"CY"	=>	"Cyprus",
	"CZ"	=>	"Czech Republic",
	"DK"	=>	"Denmark",
	"DJ"	=>	"Djibouti",
	"DM"	=>	"Dominica",
	"DO"	=>	"Dominican Republic",
	"EC"	=>	"Ecuador",
	"EG"	=>	"Egypt",
	"SV"	=>	"El Salvador",
	"GQ"	=>	"Equatorial Guinea",
	"ER"	=>	"Eritrea",
	"EE"	=>	"Estonia",
	"ET"	=>	"Ethiopia",
	"FK"	=>	"Falkland Islands (Malvinas)",
	"FO"	=>	"Faroe Islands",
	"FJ"	=>	"Fiji",
	"FI"	=>	"Finland",
	"FR"	=>	"France",
	"PF"	=>	"French Polynesia",
	"TF"	=>	"French Southern Territories",
	"GA"	=>	"Gabon",
	"GM"	=>	"Gambia",
	"GE"	=>	"Georgia",
	"DE"	=>	"Germany",
	"GH"	=>	"Ghana",
	"GI"	=>	"Gibraltar",
	"GR"	=>	"Greece",
	"GL"	=>	"Greenland",
	"GD"	=>	"Grenada",
	"GU"	=>	"Guam",
	"GT"	=>	"Guatemala",
	"GN"	=>	"Guinea",
	"GW"	=>	"Guinea-Bissau",
	"GY"	=>	"Guyana",
	"HT"	=>	"Haiti",
	"VA"	=>	"Holy See (Vatican City State)",
	"HN"	=>	"Honduras",
	"HK"	=>	"Hong Kong",
	"HU"	=>	"Hungary",
	"IS"	=>	"Iceland",
	"IN"	=>	"India",
	"ID"	=>	"Indonesia",
	"IR"	=>	"Iran, Islamic Republic Of",
	"IQ"	=>	"Iraq",
	"IE"	=>	"Ireland",
	"IL"	=>	"Israel",
	"IT"	=>	"Italy",
	"JM"	=>	"Jamaica",
	"JP"	=>	"Japan",
	"JO"	=>	"Jordan",
	"KZ"	=>	"Kazakhstan",
	"KE"	=>	"Kenya",
	"KI"	=>	"Kiribati",
	"KR"	=>	"Korea",
	"KW"	=>	"Kuwait",
	"KG"	=>	"Kyrgyzstan",
	"LA"	=>	"Lao People's Democratic Republic",
	"LV"	=>	"Latvia",
	"LB"	=>	"Lebanon",
	"LS"	=>	"Lesotho",
	"LR"	=>	"Liberia",
	"LY"	=>	"Libyan Arab Jamahiriya",
	"LI"	=>	"Liechtenstein",
	"LT"	=>	"Lithuania",
	"LU"	=>	"Luxembourg",
	"MO"	=>	"Macao",
	"MK"	=>	"Macedonia",
	"MG"	=>	"Madagascar",
	"MW"	=>	"Malawi",
	"MY"	=>	"Malaysia",
	"MV"	=>	"Maldives",
	"ML"	=>	"Mali",
	"MT"	=>	"Malta",
	"MH"	=>	"Marshall Islands",
	"MQ"	=>	"Martinique",
	"MR"	=>	"Mauritania",
	"MU"	=>	"Mauritius",
	"MX"	=>	"Mexico",
	"FM"	=>	"Micronesia, Federated States Of",
	"MD"	=>	"Moldova",
	"MC"	=>	"Monaco",
	"MN"	=>	"Mongolia",
	"ME"	=>	"Montenegro",
	"MS"	=>	"Montserrat",
	"MA"	=>	"Morocco",
	"MZ"	=>	"Mozambique",
	"MM"	=>	"Myanmar",
	"NA"	=>	"Namibia",
	"NR"	=>	"Nauru",
	"NP"	=>	"Nepal",
	"NL"	=>	"Netherlands",
	"NC"	=>	"New Caledonia",
	"NZ"	=>	"New Zealand",
	"NI"	=>	"Nicaragua",
	"NE"	=>	"Niger",
	"NG"	=>	"Nigeria",
	"NU"	=>	"Niue",
	"NF"	=>	"Norfolk Island",
	"MP"	=>	"Northern Mariana Islands",
	"NO"	=>	"Norway",
	"OM"	=>	"Oman",
	"PK"	=>	"Pakistan",
	"PW"	=>	"Palau",
	"PS"	=>	"Palestinian Territory, Occupied",
	"PA"	=>	"Panama",
	"PG"	=>	"Papua New Guinea",
	"PY"	=>	"Paraguay",
	"PE"	=>	"Peru",
	"PH"	=>	"Philippines",
	"PN"	=>	"Pitcairn",
	"PL"	=>	"Poland",
	"PT"	=>	"Portugal",
	"PR"	=>	"Puerto Rico",
	"QA"	=>	"Qatar",
	"RE"	=>	"Reunion",
	"RO"	=>	"Romania",
	"RU"	=>	"Russian Federation",
	"RW"	=>	"Rwanda",
	"SH"	=>	"Saint Helena",
	"KN"	=>	"Saint Kitts And Nevis",
	"LC"	=>	"Saint Lucia",
	"VC"	=>	"Saint Vincent And Grenadines",
	"WS"	=>	"Samoa",
	"SM"	=>	"San Marino",
	"ST"	=>	"Sao Tome And Principe",
	"SA"	=>	"Saudi Arabia",
	"SN"	=>	"Senegal",
	"RS"	=>	"Serbia",
	"SC"	=>	"Seychelles",
	"SL"	=>	"Sierra Leone",
	"SG"	=>	"Singapore",
	"SK"	=>	"Slovakia",
	"SI"	=>	"Slovenia",
	"SB"	=>	"Solomon Islands",
	"SO"	=>	"Somalia",
	"ZA"	=>	"South Africa",
	"GS"	=>	"South Georgia And Sandwich Isl.",
	"ES"	=>	"Spain",
	"LK"	=>	"Sri Lanka",
	"SD"	=>	"Sudan",
	"SR"	=>	"Suriname",
	"SZ"	=>	"Swaziland",
	"SE"	=>	"Sweden",
	"CH"	=>	"Switzerland",
	"SY"	=>	"Syrian Arab Republic",
	"TW"	=>	"Taiwan",
	"TJ"	=>	"Tajikistan",
	"TZ"	=>	"Tanzania",
	"TH"	=>	"Thailand",
	"TL"	=>	"Timor-Leste",
	"TG"	=>	"Togo",
	"TK"	=>	"Tokelau",
	"TO"	=>	"Tonga",
	"TT"	=>	"Trinidad And Tobago",
	"TN"	=>	"Tunisia",
	"TR"	=>	"Turkey",
	"TM"	=>	"Turkmenistan",
	"TC"	=>	"Turks And Caicos Islands",
	"TV"	=>	"Tuvalu",
	"UG"	=>	"Uganda",
	"UA"	=>	"Ukraine",
	"AE"	=>	"United Arab Emirates",
	"GB"	=>	"United Kingdom",
	"US"	=>	"United States",
	"UY"	=>	"Uruguay",
	"UZ"	=>	"Uzbekistan",
	"VU"	=>	"Vanuatu",
	"VE"	=>	"Venezuela",
	"VN"	=>	"Viet Nam",
	"VG"	=>	"Virgin Islands, British",
	"VI"	=>	"Virgin Islands, U.S.",
	"YE"	=>	"Yemen",
	"ZM"	=>	"Zambia",
	"ZW"	=>	"Zimbabwe"
);
$post_USA_s = array(
	'Radio-0'=>'Alabama',
	'Radio-1'=>'Alaska',
	'Radio-2'=>'Arizona',
	'Radio-3'=>'Arkansas',
	'Radio-4'=>'California',
	'Radio-5'=>'Colorado',
	'Radio-6'=>'Connecticut',
	'Radio-7'=>'Delaware',
	'Radio-8'=>'Florida',
	'Radio-9'=>'Georgia',
	'Radio-10'=>'Hawaii',
	'Radio-11'=>'Idaho',
	'Radio-12'=>'Illinois',
	'Radio-13'=>'Indiana',
	'Radio-14'=>'Iowa',
	'Radio-15'=>'Kansas',
	'Radio-16'=>'Kentucky',
	'Radio-17'=>'Louisiana',
	'Radio-18'=>'Maine',
	'Radio-19'=>'Maryland',
	'Radio-20'=>'Massachusetts',
	'Radio-21'=>'Michigan',
	'Radio-22'=>'Minnesota',
	'Radio-23'=>'Mississippi',
	'Radio-24'=>'Missouri',
	'Radio-25'=>'Montana',
	'Radio-26'=>'Nebraska',
	'Radio-27'=>'Nevada',
	'Radio-28'=>'New Hampshire',
	'Radio-29'=>'New Jersey',
	'Radio-30'=>'New Mexico',
	'Radio-31'=>'New York',
	'Radio-32'=>'North Carolina',
	'Radio-33'=>'North Dakota',
	'Radio-34'=>'Ohio',
	'Radio-35'=>'Oklahoma',
	'Radio-36'=>'Oregon',
	'Radio-37'=>'Pennsylvania',
	'Radio-38'=>'Rhode Island',
	'Radio-39'=>'South Carolina',
	'Radio-40'=>'South Dakota',
	'Radio-41'=>'Tennessee',
	'Radio-42'=>'Texas',
	'Radio-43'=>'Utah',
	'Radio-44'=>'Vermont',
	'Radio-45'=>'Virginia',
	'Radio-46'=>'Washington',
	'Radio-47'=>'West Virginia',
	'Radio-48'=>'Wisconsin',
	'Radio-49'=>'Wyoming',
	'Radio-50'=>'Washington DC'
);
$post_af_s = array(
	'Radio-0'=>'Bagrami',
	'Radio-1'=>'Herat',
	'Radio-2'=>'Kabul',
	'Radio-3'=>'Kandahar',
	'Radio-4'=>'Not sure'
);
$post_ir_s = array(
	'Radio-0'=>'Bandar abbas',
	'Radio-1'=>'Chabahar',
	'Radio-2'=>'Imam Khomeini airport',
	'Radio-3'=>'Shahriar customs',
	'Radio-4'=>'Not sure'
);

$post_iraq_s = array(
	'Radio-0'=>'Baghdad',
	'Radio-1'=>'Basrah',
	'Radio-2'=>'Erbil',
	'Radio-3'=>'Suleymanieh',
	'Radio-4'=>'Not sure'
);

$post_uae_s = array(
	'Radio-0'=>'Abu Dhabi',
	'Radio-1'=>'Dubai',
	'Radio-2'=>'Jebel Ali',
	'Radio-3'=>'Not sure'
);

$post_tr_s = array(
	'Radio-0'=>'Antalya',
	'Radio-1'=>'Ataturk in Istanbul',
	'Radio-2'=>'Edirne',
	'Radio-3'=>'Port of Istanbul',
	'Radio-4'=>'Not sure'
);
$selectable_state_countries = array(
	'United States',
	'Iran',
	'Afghanistan',
	'Iraq',
	'Turkey',
	'United Arab Emirates'
);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="cache-control" content="no-cache" />
<meta http-equiv="expires" content="0" />
<title>Forms</title>
<link rel="stylesheet" type="text/css" media="screen" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css" />
<link rel="stylesheet" type="text/css" media="all" href="include/form/fonts7.css" />
<link rel="stylesheet" type="text/css" media="all" href="include/form/screen7.css" />
<link rel="stylesheet" type="text/css" media="print" href="include/form/print7.css" />

<!-- CUSTOM STYLE -->
<style type="text/css" media="all">
body{
	background: #ffffff;
	font-family: Arial,Helvetica,sans-serif;
	font-size: 14px;
	margin: 0px;
}

.form_table{
	width: 340px;
	margin-left: 0px;
	margin-right: 0px;
	background: #ffffff;
	color: #333333;
	overflow: hidden;
	moz-box-shadow: inset 0 0 20px #999999;
	webkit-box-shadow: inset 0 0 20px #999999;
	box-shadow: inset 0 0 20px #999999;
	border-radius: 10px;
	-moz-border-radius: 10px;
	-webkit-border-radius: 10px;
	padding-bottom: 15px;
}

.form_table a{
	color: #0000CC;
}

.outside a{
	color: #0000CC;
}

.form_table a:visited{
	color: #990000;
}

.outside a:visited{
	color: #990000;
}

.form_shadow_top{
	display: none;
}

.form_shadow_bottom{
	display: none;
}

.segment_header{
	margin: 1px;
	padding: 22px 0 18px 0;
	color: #FFFFFF;
	background: url(images/forms/gradients/red_short.png);
	width: auto;
	background-repeat: repeat;
}

.q{
	padding-top: 5px;
	padding-right: 25px;
	padding-bottom: 0px;
	padding-left: 25px;
	margin-bottom: 1px;
	margin-left: 5px;
	float: left;
	display: normal;
}

.q .question{
	font-weight: bold;
	font-size: 11pt;
	padding-top: 14px;
}

.q .left_question_first{
	width: 15em;
}

.required .icon{
	background-image: url(images/forms/requiredStar.png);
	background-position: left;
	background-repeat: no-repeat;
	font-size: 13px;
	padding-left: 8px;
}

.q .text_field{
	border: 1px solid #333333;
	color: #000000;
	margin: 1px 0;
	padding: 3px 2px 2px 2px;
	background: #FFFFFF url(images/forms/field_bg.png) top left;
	border-radius: 0;
	font-size: 11pt;
}

.q .file_upload{
	background: #F4F4F4;
	border: 1px solid #333333;
	color: #000000;
	margin-top: 1px;
	border-radius: 0;
	font-size: 12px;
	padding: 3px 2px 2px 2px;
}

.q .file_upload_button{
	margin-top: 2px;
}

.q .inline_grid td{
	padding: 5px;
	vertical-align: baseline;
}

.q .drop_down{
	font-family: Arial,Helvetica,sans-serif;
	width: 200px;
	background-color: #ffffff;
	border: 1px solid #333333;
	color: #000000;
	margin: 6px 0px;
	padding: 4px;
	font-size: 14pt;
}

.q .matrix th{
	color: #FFFFFF;
	background: url(images/forms/gradients/black_short.png);
	padding: 5px;
	font-weight: bold;
	text-align: center;
	vertical-align: bottom;
}

.q .matrix td{
	padding: 5px;
	text-align: center;
	white-space: nowrap;
	height: 26px;
	border-bottom: 1px solid #CCCCCC;
	border-top: 1px solid #CCCCCC;
}

.q .matrix td.question{
	border-right: 1px solid #CCCCCC;
	font-weight: normal;
}

.q .matrix .multi_scale_sub th{
	font-weight: normal;
	border-top: 1px solid #CCCCCC !important;
	background: url(bg_images/redDiagonal.gif);
}

.q .matrix .multi_scale_break{
	border-right: 1px solid #CCCCCC;
}

.q .matrix_row_dark td{
	color: #000000;
	background: #FFDDDD;
}

.q .matrix_row_dark td.question{
	color: #000000;
	background: #FFB5B5;
}

.q .matrix_row_light td{
	color: #000000;
	background: #F9F9F9;
}

.q .matrix_row_light td.question{
	color: #000000;
	background: #FFDDDD;
}

.q .rating_ranking td{
	padding: 5px;
}

.q .scroller{
	border: 1px solid #000000;
}

.highlight{
	background: #e8e8e8 !important;
	-moz-transition: background-color .25s ease-out;
	-webkit-transition: background-color .25s ease-out;
	transition: background-color .25s ease-out;
}

tr.highlight td{
	background: #e8e8e8 !important;
}

.outside{
	color: #333333;
}

.outside_container{
	width: 340px;
	padding: 1em 0;
	margin-left: 0px;
	margin-right: auto;
	text-align: center;
	color: #333333;
}

.outside_container .submit_button{
	color: #000000;
	background: url(images/forms/gradients/white_short.png);
	border-style: solid;
	border-width: 1px;
	border-color: #000000;
	border-radius: 0;
}

.outside_container .submit_button:hover{
	border-color: #444444;
}

.outside_container .progress_bar{
	background: url(images/forms/gradients/red_short.png);
	margin: 0;
}

.ui-widget{
	font-family: Arial,Helvetica,sans-serif;
}

.invalid{
	background: #FFEEEE;
}

.invalid .invalid_message{
	color: #FF0000;
	background: #FFEEEE;
	border: 1px solid #FF0000;
	border-radius: 3px;
}

.form_table.invalid{
	border: 2px solid #FF0000;
}

.invalid .matrix .invalid_row{
	background: #FFEEEE;
}

.progressBarWrapper{
	border-radius: 10px;
	background: #ffffff;
	background-size: auto;
	border-color: #CCCCCC;
}
.progressBarBack{
	background-color: #008DF2;
	color: #ffffff;
}
.progressBarFront{
	color: #333333;
}
.segment_header{
	margin: 1px;
	color: #ff0000;
	background: url(images/forms/gradients/red_short.png);
	width: auto;
	background-repeat: repeat;
	background-size: auto;
	padding: 0px;
}
.segment_header h1{
	padding: 20px 10px;
	border-radius: 6px;
	font-family: Arial,Helvetica,sans-serif;
}
.outside_container .submit_button{
	font-size: 16px;
}

</style>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
		<script type="text/javascript" src="include/form/form7.js"></script>
		<script type="text/javascript" src="include/form/embed.js"></script><script type="text/javascript">Embed.init('1332349481','');</script>
		<style type="text/css" media="screen" title="EmbedCSSChanges"></style>
		<script  type="text/javascript">
			function cds(a){
				//alert(a);
				if(a === 'add'){
				//alert(a);
					$('#q8000').removeClass("x-hidden");
					$('#q8000').addClass("highlight");
				}
				else{
					$('#q8000').addClass("x-hidden");
					$('#q8000').removeClass("highlight");
				}
				
			}
			
			function user_part(a)
			{
				$('#moreinfo').hide();
				$('#info').show();
				if(a=='yes')
				{
					$('#user').show();
					$('#nouser').hide();
					$('#ihave').attr("checked",true);
					$('#ihavenot').attr("checked",false);
				}
				else
				{
					$('#nouser').show();
					$('#user').hide();
					$('#ihavenot').attr("checked",true);
					$('#ihave').attr("checked",false);
				}
			}
			function showother(a)
			{
				alert('none');
				if(a=='false')
				{alert('false');
					//RESULT_TextField-255_0
					document.getElementById('RESULT_TextField-255_0').style.display = 'none';
					//$('#RESULT_TextField-255_0').hide();
				}
				else
				{alert('true');
					document.getElementById('RESULT_TextField-255_0').style.display = 'block';
					//$('#RESULT_TextField-255_0').show();
				}
				return false;
			}
			function check(elem) {
				var option = elem.options[elem.selectedIndex].value;
				var status = 'none';
				if(option == 'Radio-2')
					status = 'block';
				document.getElementById('RESULT_TextField-255_0').style.display = status;
			}
			function check2(elem) {
				var currentValue = elem.value;
				var status = 'none';
				if(currentValue == 'Yes')
					status = 'block';
				document.getElementById('dgr_dv').style.display = status;
			}
		</script>
	</head>
	<body>
	<?php
	$shown_type = 0;
	$post_t = array(
		'Radio-0' => 'ASAP',
		'Radio-1' => 'This Week',
		'Radio-2' => 'This Month',
		'Radio-3' => 'Exact Date',
		'Radio-4' => 'Not sure when'
	);
	$post_ty = array(
		'Radio-0' => 'Commercial',
		'Radio-1' => 'Personal'
	);
	$post_st = array(
		'Radio-0'=>'Air',
		'Radio-1'=>'Sea',
		'Radio-2'=>'Land',
		'Radio-4'=>'Rail Way',
		'Radio-3'=>'Not sure'
	);
	$post_sta = array(
		'Radio-0'=>'Door to Door',
		'Radio-1'=>'Door to Airport',
		'Radio-2'=>'Airport to Airport',
	);
	$post_staa = array(
		'Radio-0'=>'EX-Work',
		'Radio-1'=>'FOB',
		'Radio-2'=>'other',
	);
	$post_sts = array(
		'Radio-0'=>'Door to Door',
		'Radio-1'=>'Door to Port',
		'Radio-2'=>'Port to Port',
		'Radio-3'=>'Port to Door',
	);
	$post_stss = array(
		'Radio-0'=>'FCL',
		'Radio-1'=>'LCL',
		'Radio-2'=>'Not Sure'
	);
	$post_container_size = array(
		'Radio-0'=>'20 ft container',
		'Radio-1'=>'40 ft container',
		'Radio-2'=>'40 ft high cube container'
	);
	$post_stt = array(
		'Radio-0'=>'FTL',
		'Radio-1'=>'LTL',
		'Radio-2'=>'Not Sure'
	);
	$post_insurance = array(
		'Radio-0'=>'Yes',
		'Radio-1'=>'No',
		'Radio-2'=>'Not Sure'
	);
	$post_p_contact = array(
		'Radio-0'=>'Phone',
		'Radio-1'=>'Email',
		'Radio-2'=>'any of above'
	);
	$post_contact_time = array(
		'Radio-0'=>'Anytime',
		'Radio-1'=>'In the morning',
		'Radio-2'=>'In the afternoon',
		'Radio-3'=>'In the evening'
	);
	if(isset($_POST['pt']) AND is_numeric($_POST['pt']) AND $_POST['pt']>0){
		$error = true;
		if(isset($_POST['Submit']) AND ($_POST['Submit']=='< Previous')){
			switch($_POST['pt']){
				case 1:
					$error = false;
					$shown_type = 0;
				break;
				case 2:
					$error = false;
					$shown_type = 1;
				break;
				case 3:
					$error = false;
					$shown_type = 2;
				break;
				case 4:
					$error = false;
					$shown_type = 3;
				break;
			}
		}
		elseif(isset($_POST['Submit']) AND ($_POST['Submit']=='Next >' OR $_POST['Submit']=='Submit')){
			switch($_POST['pt']){
				case 1:
					if(isset($_POST['RESULT_RadioButton-2']) AND ($_POST['RESULT_RadioButton-2']=='Radio-0' OR $_POST['RESULT_RadioButton-2']=='Radio-1' OR $_POST['RESULT_RadioButton-2']=='Radio-2')){
						
						switch($_POST['RESULT_RadioButton-2']){
							case 'Radio-0' :
								$_SESSION['data']['from'] = 'United Kingdom';
								if(isset($_POST['RESULT_RadioButton-4']) AND array_key_exists($_POST['RESULT_RadioButton-4'], $post_c) AND $post_c[$_POST['RESULT_RadioButton-4']]!='' AND $post_c[$_POST['RESULT_RadioButton-4']]!=null){
									$_SESSION['data']['to'] = $post_c[$_POST['RESULT_RadioButton-4']];
									if(isset($_POST['RESULT_RadioButton-3']) AND array_key_exists($_POST['RESULT_RadioButton-3'], $post_ty) AND $post_ty[$_POST['RESULT_RadioButton-3']]!='' AND $post_ty[$_POST['RESULT_RadioButton-3']]!=null){
										$_SESSION['data']['type'] = $post_ty[$_POST['RESULT_RadioButton-3']];
										if(isset($_POST['RESULT_RadioButton-12']) AND array_key_exists($_POST['RESULT_RadioButton-12'], $post_t) AND $post_t[$_POST['RESULT_RadioButton-12']]!='' AND $post_t[$_POST['RESULT_RadioButton-12']]!=null){
											if($_POST['RESULT_RadioButton-12']!='Radio-3' OR (isset($_POST['RESULT_TextField-13']) AND $_POST['RESULT_TextField-13']!='' AND $_POST['RESULT_TextField-13']!=null)){
												$error = false;
												//$data = array();
												$_SESSION['data']['date'] = $post_t[$_POST['RESULT_RadioButton-12']];
												if($_POST['RESULT_RadioButton-12']=='Radio-3'){
													$_SESSION['data']['exact_date'] = $_POST['RESULT_TextField-13'];
												}
												//$_SESSION['data'] = $data;
											}
										}
									}
								}
							break;
							case 'Radio-1' :
								$_SESSION['data']['to'] = 'United Kingdom';
								if(isset($_POST['RESULT_RadioButton-5']) AND array_key_exists($_POST['RESULT_RadioButton-5'], $post_c) AND $post_c[$_POST['RESULT_RadioButton-5']]!='' AND $post_c[$_POST['RESULT_RadioButton-5']]!=null){
									$_SESSION['data']['from'] = $post_c[$_POST['RESULT_RadioButton-5']];
									if(isset($_POST['RESULT_RadioButton-3']) AND array_key_exists($_POST['RESULT_RadioButton-3'], $post_ty) AND $post_ty[$_POST['RESULT_RadioButton-3']]!='' AND $post_ty[$_POST['RESULT_RadioButton-3']]!=null){
										$_SESSION['data']['type'] = $post_ty[$_POST['RESULT_RadioButton-3']];
										if(isset($_POST['RESULT_RadioButton-12']) AND array_key_exists($_POST['RESULT_RadioButton-12'], $post_t) AND $post_t[$_POST['RESULT_RadioButton-12']]!='' AND $post_t[$_POST['RESULT_RadioButton-12']]!=null){
											if($_POST['RESULT_RadioButton-12']!='Radio-3' OR (isset($_POST['RESULT_TextField-13']) AND $_POST['RESULT_TextField-13']!='' AND $_POST['RESULT_TextField-13']!=null)){
												$error = false;
												//$data = array();
												$_SESSION['data']['date'] = $post_t[$_POST['RESULT_RadioButton-12']];
												if($_POST['RESULT_RadioButton-12']=='Radio-3'){
													$_SESSION['data']['exact_date'] = $_POST['RESULT_TextField-13'];
												}
												//$_SESSION['data'] = $data;
											}
										}
									}
								}
							break;
							case 'Radio-2' :
								if(isset($_POST['RESULT_RadioButton-300']) AND array_key_exists($_POST['RESULT_RadioButton-300'], $post_c) AND $post_c[$_POST['RESULT_RadioButton-300']]!='' AND $post_c[$_POST['RESULT_RadioButton-300']]!=null){
									$_SESSION['data']['from'] = $post_c[$_POST['RESULT_RadioButton-300']];
									if(isset($_POST['RESULT_RadioButton-301']) AND array_key_exists($_POST['RESULT_RadioButton-301'], $post_c) AND $post_c[$_POST['RESULT_RadioButton-301']]!='' AND $post_c[$_POST['RESULT_RadioButton-301']]!=null){
										$_SESSION['data']['to'] = $post_c[$_POST['RESULT_RadioButton-301']];
										if(isset($_POST['RESULT_RadioButton-3']) AND array_key_exists($_POST['RESULT_RadioButton-3'], $post_ty) AND $post_ty[$_POST['RESULT_RadioButton-3']]!='' AND $post_ty[$_POST['RESULT_RadioButton-3']]!=null){
											$_SESSION['data']['type'] = $post_ty[$_POST['RESULT_RadioButton-3']];
											if(isset($_POST['RESULT_RadioButton-12']) AND array_key_exists($_POST['RESULT_RadioButton-12'], $post_t) AND $post_t[$_POST['RESULT_RadioButton-12']]!='' AND $post_t[$_POST['RESULT_RadioButton-12']]!=null){
												if($_POST['RESULT_RadioButton-12']!='Radio-3' OR (isset($_POST['RESULT_TextField-13']) AND $_POST['RESULT_TextField-13']!='' AND $_POST['RESULT_TextField-13']!=null)){
													$error = false;
													//$data = array();
													$_SESSION['data']['date'] = $post_t[$_POST['RESULT_RadioButton-12']];
													if($_POST['RESULT_RadioButton-12']=='Radio-3'){
														$_SESSION['data']['exact_date'] = $_POST['RESULT_TextField-13'];
													}
													//$_SESSION['data'] = $data;
												}
											}
										}
									}
								}
							break;
						}
					}
					if($error==false){
						$from_state = "Not Sure";
						$to_state = "Not Sure";
						if(in_array($_SESSION['data']['from'],$selectable_state_countries)){
							if($_SESSION['data']['from']=="United States" AND isset($_POST['RESULT_RadioButton-6']) AND array_key_exists($_POST['RESULT_RadioButton-6'],$post_USA_s) AND $post_USA_s[$_POST['RESULT_RadioButton-6']]!='' AND $post_USA_s[$_POST['RESULT_RadioButton-6']]!=null){
								$from_state = $post_USA_s[$_POST['RESULT_RadioButton-6']];
							}
							if($_SESSION['data']['from']=="United Arab Emirates" AND isset($_POST['RESULT_RadioButton-10']) AND array_key_exists($_POST['RESULT_RadioButton-10'],$post_uae_s) AND $post_uae_s[$_POST['RESULT_RadioButton-10']]!='' AND $post_uae_s[$_POST['RESULT_RadioButton-10']]!=null){
								$from_state = $post_uae_s[$_POST['RESULT_RadioButton-10']];
							}
							if($_SESSION['data']['from']=="Afghanistan" AND isset($_POST['RESULT_RadioButton-7']) AND array_key_exists($_POST['RESULT_RadioButton-7'],$post_af_s) AND $post_af_s[$_POST['RESULT_RadioButton-7']]!='' AND $post_af_s[$_POST['RESULT_RadioButton-7']]!=null){
								$from_state = $post_af_s[$_POST['RESULT_RadioButton-7']];
							}
							if($_SESSION['data']['from']=="Iran" AND isset($_POST['RESULT_RadioButton-8']) AND array_key_exists($_POST['RESULT_RadioButton-8'],$post_ir_s) AND $post_ir_s[$_POST['RESULT_RadioButton-8']]!='' AND $post_ir_s[$_POST['RESULT_RadioButton-8']]!=null){
								$from_state = $post_ir_s[$_POST['RESULT_RadioButton-8']];
							}
							if($_SESSION['data']['from']=="Iraq" AND isset($_POST['RESULT_RadioButton-9']) AND array_key_exists($_POST['RESULT_RadioButton-9'],$post_iraq_s) AND $post_iraq_s[$_POST['RESULT_RadioButton-9']]!='' AND $post_iraq_s[$_POST['RESULT_RadioButton-9']]!=null){
								$from_state = $post_iraq_s[$_POST['RESULT_RadioButton-9']];
							}
							if($_SESSION['data']['from']=="Turkey" AND isset($_POST['RESULT_RadioButton-11']) AND array_key_exists($_POST['RESULT_RadioButton-11'],$post_tr_s) AND $post_tr_s[$_POST['RESULT_RadioButton-11']]!='' AND $post_tr_s[$_POST['RESULT_RadioButton-11']]!=null){
								$from_state = $post_tr_s[$_POST['RESULT_RadioButton-11']];
							}
						}
						if(in_array($_SESSION['data']['to'],$selectable_state_countries)){
							if($_SESSION['data']['to']=="United States" AND isset($_POST['RESULT_RadioButton-6']) AND array_key_exists($_POST['RESULT_RadioButton-6'],$post_USA_s) AND $post_USA_s[$_POST['RESULT_RadioButton-6']]!='' AND $post_USA_s[$_POST['RESULT_RadioButton-6']]!=null){
								$to_state = $post_USA_s[$_POST['RESULT_RadioButton-6']];
							}
							if($_SESSION['data']['to']=="United Arab Emirates" AND isset($_POST['RESULT_RadioButton-10']) AND array_key_exists($_POST['RESULT_RadioButton-10'],$post_uae_s) AND $post_uae_s[$_POST['RESULT_RadioButton-10']]!='' AND $post_uae_s[$_POST['RESULT_RadioButton-10']]!=null){
								$to_state = $post_uae_s[$_POST['RESULT_RadioButton-10']];
							}
							if($_SESSION['data']['to']=="Afghanistan" AND isset($_POST['RESULT_RadioButton-7']) AND array_key_exists($_POST['RESULT_RadioButton-7'],$post_af_s) AND $post_af_s[$_POST['RESULT_RadioButton-7']]!='' AND $post_af_s[$_POST['RESULT_RadioButton-7']]!=null){
								$to_state = $post_af_s[$_POST['RESULT_RadioButton-7']];
							}
							if($_SESSION['data']['to']=="Iran" AND isset($_POST['RESULT_RadioButton-8']) AND array_key_exists($_POST['RESULT_RadioButton-8'],$post_ir_s) AND $post_ir_s[$_POST['RESULT_RadioButton-8']]!='' AND $post_ir_s[$_POST['RESULT_RadioButton-8']]!=null){
								$to_state = $post_ir_s[$_POST['RESULT_RadioButton-8']];
							}
							if($_SESSION['data']['to']=="Iraq" AND isset($_POST['RESULT_RadioButton-9']) AND array_key_exists($_POST['RESULT_RadioButton-9'],$post_iraq_s) AND $post_iraq_s[$_POST['RESULT_RadioButton-9']]!='' AND $post_iraq_s[$_POST['RESULT_RadioButton-9']]!=null){
								$to_state = $post_iraq_s[$_POST['RESULT_RadioButton-9']];
							}
							if($_SESSION['data']['to']=="Turkey" AND isset($_POST['RESULT_RadioButton-11']) AND array_key_exists($_POST['RESULT_RadioButton-11'],$post_tr_s) AND $post_tr_s[$_POST['RESULT_RadioButton-11']]!='' AND $post_tr_s[$_POST['RESULT_RadioButton-11']]!=null){
								$to_state = $post_tr_s[$_POST['RESULT_RadioButton-11']];
							}
						}
						$_SESSION['data']['from_state'] = $from_state;
						$_SESSION['data']['to_state'] = $to_state;
						$shown_type = 1;
					}
					break;
				case 2:
					$shown_type = 1;
					
					if(isset($_SESSION['data']) AND isset($_POST['RESULT_RadioButton-18']) AND array_key_exists($_POST['RESULT_RadioButton-18'],$post_st) AND $post_st[$_POST['RESULT_RadioButton-18']]!='' AND $post_st[$_POST['RESULT_RadioButton-18']]!=null){
						
						$_SESSION['data1']['type'] = $post_st[$_POST['RESULT_RadioButton-18']];
						switch($_POST['RESULT_RadioButton-18']){
							case 'Radio-0':
								if(isset($_POST['RESULT_RadioButton-25']) AND array_key_exists($_POST['RESULT_RadioButton-25'],$post_sta) AND $post_sta[$_POST['RESULT_RadioButton-25']]!='' AND $post_sta[$_POST['RESULT_RadioButton-25']]!=null){
									
									$_SESSION['data1']['ship_type'] = $post_sta[$_POST['RESULT_RadioButton-25']];
									switch($_POST['RESULT_RadioButton-25']){
										case 'Radio-0':
											if(isset($_POST['RESULT_TextField-28']) AND $_POST['RESULT_TextField-28']!='' AND $_POST['RESULT_TextField-28']!=null){
												$_SESSION['data1']['from'] = $_POST['RESULT_TextField-28'];
												if(isset($_POST['RESULT_TextField-33']) AND $_POST['RESULT_TextField-33']!='' AND $_POST['RESULT_TextField-33']!=null){
													//$error = false;
													//$data = array();
													$_SESSION['data1']['to'] = $_POST['RESULT_TextField-33'];
													//$_SESSION['data1'] = $data;
												}
											}
										break;
										case 'Radio-1':
											if(isset($_POST['RESULT_TextField-28']) AND $_POST['RESULT_TextField-28']!='' AND $_POST['RESULT_TextField-28']!=null){
												$_SESSION['data1']['from'] = $_POST['RESULT_TextField-28'];
												if(isset($_POST['RESULT_TextField-32']) AND $_POST['RESULT_TextField-32']!='' AND $_POST['RESULT_TextField-32']!=null){
													//$error = false;
													//$data = array();
													$_SESSION['data1']['to'] = $_POST['RESULT_TextField-32'];
													//$_SESSION['data1'] = $data;
												}
											}
										break;
										case 'Radio-2':
											if(isset($_POST['RESULT_TextField-31']) AND $_POST['RESULT_TextField-31']!='' AND $_POST['RESULT_TextField-31']!=null){
												$_SESSION['data1']['from'] = $_POST['RESULT_TextField-31'];
												if(isset($_POST['RESULT_TextField-32']) AND $_POST['RESULT_TextField-32']!='' AND $_POST['RESULT_TextField-32']!=null){
													//$error = false;
													//$data = array();
													$_SESSION['data1']['to'] = $_POST['RESULT_TextField-32'];
													//$_SESSION['data1'] = $data;
												}
											}
										break;
									}
									if($_SESSION['data1']['ship_type']!='' AND $_SESSION['data1']['to']!='')
									{
										if(isset($_POST['RESULT_RadioButton-255']) AND array_key_exists($_POST['RESULT_RadioButton-255'],$post_staa) AND $post_staa[$_POST['RESULT_RadioButton-255']]!='' AND $post_staa[$_POST['RESULT_RadioButton-255']]!=null)
										{
											$_SESSION['data1']['terms'] = $post_staa[$_POST['RESULT_RadioButton-255']];
											if($_SESSION['data1']['terms']=='other')
											{
												$_SESSION['data1']['terms'] =$_POST['RESULT_TextField-255_0'];
											}
											//$post_staa
											$error = false;
										}
									}
								}
							break;
							case 'Radio-1':
								if(isset($_POST['RESULT_RadioButton-24']) AND array_key_exists($_POST['RESULT_RadioButton-24'],$post_sts) AND $post_sts[$_POST['RESULT_RadioButton-24']]!='' AND $post_sts[$_POST['RESULT_RadioButton-24']]!=null){
									$_SESSION['data1']['ship_type'] = $post_sts[$_POST['RESULT_RadioButton-24']];
									if(isset($_POST['RESULT_RadioButton-21']) AND array_key_exists($_POST['RESULT_RadioButton-21'],$post_stss) AND $post_stss[$_POST['RESULT_RadioButton-21']]!='' AND $post_stss[$_POST['RESULT_RadioButton-21']]!=null){
										$_SESSION['data1']['ship_container'] = $post_stss[$_POST['RESULT_RadioButton-21']];
										switch($_POST['RESULT_RadioButton-24']){
											case 'Radio-0':
												if(isset($_POST['RESULT_TextField-28']) AND $_POST['RESULT_TextField-28']!='' AND $_POST['RESULT_TextField-28']!=null){
													$_SESSION['data1']['from'] = $_POST['RESULT_TextField-28'];
													if(isset($_POST['RESULT_TextField-33']) AND $_POST['RESULT_TextField-33']!='' AND $_POST['RESULT_TextField-33']!=null){
														$error = false;
														//$data = array();
														$_SESSION['data1']['to'] = $_POST['RESULT_TextField-33'];
														//$_SESSION['data1'] = $data;
													}
												}
											break;
											case 'Radio-1':
												if(isset($_POST['RESULT_TextField-28']) AND $_POST['RESULT_TextField-28']!='' AND $_POST['RESULT_TextField-28']!=null){
													$_SESSION['data1']['from'] = $_POST['RESULT_TextField-28'];
													if(isset($_POST['RESULT_TextField-30']) AND $_POST['RESULT_TextField-30']!='' AND $_POST['RESULT_TextField-30']!=null){
														$error = false;
														//$data = array();
														$_SESSION['data1']['to'] = $_POST['RESULT_TextField-30'];
														//$_SESSION['data1'] = $data;
													}
												}
											break;
											case 'Radio-2':
												if(isset($_POST['RESULT_TextField-29']) AND $_POST['RESULT_TextField-29']!='' AND $_POST['RESULT_TextField-29']!=null){
													$_SESSION['data1']['from'] = $_POST['RESULT_TextField-29'];
													if(isset($_POST['RESULT_TextField-30']) AND $_POST['RESULT_TextField-30']!='' AND $_POST['RESULT_TextField-30']!=null){
														$error = false;
														//$data = array();
														$_SESSION['data1']['to'] = $_POST['RESULT_TextField-30'];
														//$_SESSION['data1'] = $data;
													}
												}
											break;
											case 'Radio-3':
												if(isset($_POST['RESULT_TextField-29']) AND $_POST['RESULT_TextField-29']!='' AND $_POST['RESULT_TextField-29']!=null){
													$_SESSION['data1']['from'] = $_POST['RESULT_TextField-29'];
													if(isset($_POST['RESULT_TextField-33']) AND $_POST['RESULT_TextField-33']!='' AND $_POST['RESULT_TextField-33']!=null){
														$error = false;
														//$data = array();
														$_SESSION['data1']['to'] = $_POST['RESULT_TextField-33'];
														//$_SESSION['data1'] = $data;
													}
												}
											break;
										}
										if($error==false){
											if($_POST['RESULT_RadioButton-18']=='Radio-1' AND $_POST['RESULT_RadioButton-21']=='Radio-0'){
												$_SESSION['data1']['ship_container_c'] = ((isset($_POST['RESULT_TextField-22']) AND is_numeric($_POST['RESULT_TextField-22']) AND $_POST['RESULT_TextField-22']>0) ? $_POST['RESULT_TextField-22'] : 1);
											}
											if($_POST['RESULT_RadioButton-18']=='Radio-1' AND $_POST['RESULT_RadioButton-21']=='Radio-0')  $_SESSION['data1']['ship_container_s'] = ((isset($_POST['RESULT_RadioButton-23']) AND array_key_exists($_POST['RESULT_RadioButton-23'],$post_container_size) AND $post_container_size[$_POST['RESULT_RadioButton-23']]!='' AND $post_container_size[$_POST['RESULT_RadioButton-23']]!=null) ? $post_container_size[$_POST['RESULT_RadioButton-23']] : '20 ft container');
											//RESULT_TextField-1800
											
											//$shown_type = 2;
										}
									}
								}
							break;
							case 'Radio-2':
							//echo 
								if(isset($_POST['RESULT_RadioButton-27']) AND array_key_exists($_POST['RESULT_RadioButton-27'],$post_stt) AND $post_stt[$_POST['RESULT_RadioButton-27']]!='' AND $post_stt[$_POST['RESULT_RadioButton-27']]!=null){
									$_SESSION['data1']['ship_container'] = $post_stt[$_POST['RESULT_RadioButton-27']];
									if(isset($_POST['RESULT_TextField-28']) AND $_POST['RESULT_TextField-28']!='' AND $_POST['RESULT_TextField-28']!=null){
										$_SESSION['data1']['from'] = $_POST['RESULT_TextField-28'];
										if(isset($_POST['RESULT_TextField-33']) AND $_POST['RESULT_TextField-33']!='' AND $_POST['RESULT_TextField-33']!=null){
											$error = false;
											//$data = array();
											$_SESSION['data1']['to'] = $_POST['RESULT_TextField-33'];
											//$_SESSION['data1'] = $data;
										}
									}
								}
							break;
							case 'Radio-3':
								if(isset($_POST['RESULT_TextField-28']) AND $_POST['RESULT_TextField-28']!='' AND $_POST['RESULT_TextField-28']!=null){
									$_SESSION['data1']['from'] = $_POST['RESULT_TextField-28'];
									if(isset($_POST['RESULT_TextField-33']) AND $_POST['RESULT_TextField-33']!='' AND $_POST['RESULT_TextField-33']!=null){
										$error = false;
										//$data = array();
										$_SESSION['data1']['to'] = $_POST['RESULT_TextField-33'];
										//$_SESSION['data1'] = $data;
									}
								}
							case 'Radio-4':
										$error = false;
							break;
						}
					}
					if($error==false){
						$error=true;
						if(isset($_POST['RESULT_TextField-1800']) AND $_POST['RESULT_TextField-1800']!='' AND $_POST['RESULT_TextField-1800']!=null){
							$_SESSION['data']['from_state'] = $_POST['RESULT_TextField-1800'];
							if(isset($_POST['RESULT_TextField-1801']) AND $_POST['RESULT_TextField-1801']!='' AND $_POST['RESULT_TextField-1801']!=null){
								$error=false;
								$_SESSION['data']['to_state'] = $_POST['RESULT_TextField-1801'];
								
							}
						}
					}
					if($error==false){
						$shown_type = 2;
					}
					break;
				case 3:
					$shown_type = 2;
					if(isset($_SESSION['data1']) AND ((isset($_POST['RESULT_TextField-37']) AND is_numeric($_POST['RESULT_TextField-37']) AND $_POST['RESULT_TextField-37']>0) OR (isset($_SESSION['data1']['ship_container_s']) AND $_SESSION['data1']['ship_container_s']!='' AND $_SESSION['data1']['ship_container_s']!=null))){
						//RESULT_MatrixTextField-38-0
						$_SESSION['data2']['n_item'] = $_POST['RESULT_TextField-37'];
						$tmp = "";
						$_c = 0;
						while(isset($_POST['RESULT_MatrixTextField-38-'.$_c]) AND $_POST['RESULT_MatrixTextField-38-'.$_c]!='' AND $_POST['RESULT_MatrixTextField-38-'.$_c]!=null AND isset($_POST['RESULT_MatrixTextField_weight-38-'.$_c]) AND $_POST['RESULT_MatrixTextField_weight-38-'.$_c]!='' AND $_POST['RESULT_MatrixTextField_weight-38-'.$_c]!=null){
							$tmp .= ($_c +1).') '.$_POST['RESULT_MatrixTextField-38-'.$_c].' => '.$_POST['RESULT_MatrixTextField_weight-38-'.$_c].' kg | ';
							$_c++;
							if($_c==10) break;
						}
						if($tmp != '' OR (isset($_SESSION['data1']['ship_container_s']) AND $_SESSION['data1']['ship_container_s']!='' AND $_SESSION['data1']['ship_container_s']!=null)){
							$_SESSION['data2']['dims'] = $tmp;
							$arrrr = array(
								"Radio-0" => "Yes",
								"Radio-1" => "No");
							$arrrr2 = array(
								'Radio-0'=>"PAX",
								'Radio-1'=>"CAO",
								'Radio-2'=>"Not Sure"
							);
							if(isset($_POST['RESULT_TextField-40']) AND $_POST['RESULT_TextField-40']!='' AND $_POST['RESULT_TextField-40']!=null){
								$_SESSION['data2']['t_weight'] = $_POST['RESULT_TextField-40'];
								if(isset($_POST['RESULT_RadioButton-41']) AND array_key_exists($_POST['RESULT_RadioButton-41'], $post_insurance) AND $post_insurance[$_POST['RESULT_RadioButton-41']]!='' AND $post_insurance[$_POST['RESULT_RadioButton-41']]!=null){
									$_SESSION['data2']['insurance'] = $post_insurance[$_POST['RESULT_RadioButton-41']];
									if(isset($_POST['RESULT_TextArea-42']) AND $_POST['RESULT_TextArea-42']!='' AND $_POST['RESULT_TextArea-42']!=null){
										$_SESSION['data2']['desc'] = $_POST['RESULT_TextArea-42'];
										//RESULT_RadioButton-421
										if(isset($_POST['RESULT_RadioButton-421']) AND ($_POST['RESULT_RadioButton-421']=='Yes' OR $_POST['RESULT_RadioButton-421']=='No')){
											$_SESSION['data2']['lithium_bat'] = $_POST['RESULT_RadioButton-421'];
											if(isset($_POST['RESULT_RadioButton-422']) AND ($_POST['RESULT_RadioButton-422']=='Yes' OR $_POST['RESULT_RadioButton-422']=='No')){
												$_SESSION['data2']['dg'] = $_POST['RESULT_RadioButton-422'];
												if(isset($_POST['RESULT_RadioButton-423']) AND ($_POST['RESULT_RadioButton-423']=='Yes' OR $_POST['RESULT_RadioButton-423']=='No')){
													$_SESSION['data2']['chemical'] = $_POST['RESULT_RadioButton-423'];
													$_SESSION['data2']['terms'] = '';
													$_SESSION['data2']['un'] = '';
													$_SESSION['data2']['class'] = '';
													$_SESSION['data2']['instruction'] = '';
													if((isset($_POST['RESULT_RadioButton-424']) AND array_key_exists($_POST['RESULT_RadioButton-424'],$arrrr2)) AND $_POST['RESULT_RadioButton-424']!=''){
														$_SESSION['data2']['terms'] = $arrrr2[$_POST['RESULT_RadioButton-424']];
													}
													if((isset($_POST['RESULT_TextField-425']) AND $_POST['RESULT_TextField-425']!='')){
														$_SESSION['data2']['un'] = $_POST['RESULT_TextField-425'];
													}
													if((isset($_POST['RESULT_TextField-426']) AND $_POST['RESULT_TextField-426']!='')){
														$_SESSION['data2']['class'] = $_POST['RESULT_TextField-426'];
													}
													if((isset($_POST['RESULT_TextArea-427']) AND $_POST['RESULT_TextArea-427']!='')){
														$_SESSION['data2']['instruction'] = $_POST['RESULT_TextArea-427'];
													}
													if(isset($_POST['RESULT_RadioButton-428']) AND array_key_exists($_POST['RESULT_RadioButton-428'],$arrrr)){
														$_SESSION['data2']['stackable'] = $arrrr[$_POST['RESULT_RadioButton-428']];
														$error = false;
													}
												}
											}
										}
									}
								}
							}
						}
					}
					if($error==false){
						$shown_type = 3;
					}
					//print_r($_SESSION['data2']);exit;
					break;
				case 4:
				
					$con = mysql_connect(DB_HOST,DB_USER,DB_PASS) or die(mysql_error());
					mysql_select_db(DB_NAME, $con) or die(mysql_error());
					$shown_type = 3;
					if(isset($_SESSION['data2']) AND isset($_POST['RESULT_RadioButton-47']) AND array_key_exists($_POST['RESULT_RadioButton-47'], $post_p_contact) AND $post_p_contact[$_POST['RESULT_RadioButton-47']]!='' AND $post_p_contact[$_POST['RESULT_RadioButton-47']]!=null){
						if($post_p_contact[$_POST['RESULT_RadioButton-47']]=='Email' OR (isset($_POST['RESULT_RadioButton-48']) AND array_key_exists($_POST['RESULT_RadioButton-48'], $post_contact_time) AND $post_contact_time[$_POST['RESULT_RadioButton-48']]!='' AND $post_contact_time[$_POST['RESULT_RadioButton-48']]!=null)){
							$email = $name = $company = $uname = $phone = "";
							if(isset($_POST['have_acc']) AND $_POST['have_acc']=="yes")
							{
								function StringSafe($string){
									if(!preg_match("/^([a-z0-9\s\-_:.,،؛?!؟[\]()*\/]|[پچجحخهعغفقثصضشسيبلاآتنمکگوئدذرزطظةيژی])+$/i",$string) || (strpos($string,'<')!==false || strpos($string,'>')!==false )){
										return false;
									}
									return true;
								}
								if(isset($_POST['RESULT_TextField-4900']) AND trim($_POST['RESULT_TextField-4900'])!="" AND $_POST['RESULT_TextField-4900']!=null AND StringSafe($_POST['RESULT_TextField-4900']))
								{
									$qq = mysql_query("SELECT count(*) as counter, email, pwd,company,fname,lname FROM `users` WHERE `uname`='".$_POST['RESULT_TextField-4900']."'") or die(mysql_error());
									$form_row = mysql_fetch_assoc($qq);
									
									if($form_row['counter']==1)
									{
										if(isset($_POST['RESULT_TextField-4901']) AND trim($_POST['RESULT_TextField-4901'])!="" AND $_POST['RESULT_TextField-4901']!=null)
										{
											function VerifyPassWord($pass, $hash){
												return password_verify ($pass, $hash);
											}
											if(VerifyPassWord($_POST['RESULT_TextField-4901'], $form_row['pwd']))
											{
												$phone = (($form_row['phone']!="" AND $form_row['phone']!=null) ? $form_row['phone'] : "not set");
												$email = $form_row['email'];
												$company = $form_row['company'];
												$uname = $_POST['RESULT_TextField-4900'];
												$name = $form_row['fname']." ".$form_row['lname'];
											}
											else
											{
												$_SESSION['error_user'] = "password is not correct!";
											}
										}
										else
										{
											$_SESSION['error_user'] = "password is empty";
										}
									}
									else
									{
										$_SESSION['error_user'] = "User not exist";
									}
								}
								else
								{
									$_SESSION['error_user'] = "UserName is invalid.";
								}
							}
							else{
								if(isset($_POST['RESULT_TextField-49']) AND $_POST['RESULT_TextField-49']!='' AND $_POST['RESULT_TextField-49']!=null){
									if(isset($_POST['RESULT_TextField-50']) AND $_POST['RESULT_TextField-50']!='' AND $_POST['RESULT_TextField-50']!=null){
										if(isset($_POST['RESULT_TextField-51']) AND $_POST['RESULT_TextField-51']!='' AND $_POST['RESULT_TextField-51']!=null){
											$phone = $_POST['RESULT_TextField-49'];
											$email = $_POST['RESULT_TextField-50'];
											$name = $_POST['RESULT_TextField-51'];
											if(isset($_POST['RESULT_TextField-520']) AND $_POST['RESULT_TextField-520']!='' AND $_POST['RESULT_TextField-520']!=null){
												$company = $_POST['RESULT_TextField-520'];
											}
										}
									}
								}
							}
							if($email!="" AND $phone!="" AND $name!=""){
								$error = false;
								$data = array();
								
								$data['company'] = $company;
								$data['contact_time'] = ($post_p_contact[$_POST['RESULT_RadioButton-47']]!='Email' ? $post_contact_time[$_POST['RESULT_RadioButton-48']] : "-");
								$data['contact_method'] = $post_p_contact[$_POST['RESULT_RadioButton-47']];
								$data['phone'] = $phone;
								$data['email'] = $email;
								$data['firstname'] = $name;
								$data['uname'] = $uname;
								
								$data['note'] = $_POST['RESULT_TextArea-53'];
								
								$q = "INSERT INTO `quote` (`fname`, `company`, `phone`, `email`, `pr_contact_m`, `pr_contact_t`, `note`, `item_c`, `dims`, `total_weight`, `insurance`, `item_desc`, `from`, `to`, `shipping_type`, `ship_container`, `shipping_sub_type`, `from_st`, `to_st`, `from_location`, `to_location`, `pack_type`, `date`, `exact_date`, `lithiumb`, `chemical`, `danger`, `timestamp`) VALUES ";
								$q .= "('".$data['firstname']."', '".$data['company']."', '".$data['phone']."', '".$data['email']."', '".$data['contact_method']."', '".$data['contact_time']."', '".$data['note']."', '".$_SESSION['data2']['n_item']."', '".$_SESSION['data2']['dims']."', '".$_SESSION['data2']['t_weight']."', '".$_SESSION['data2']['insurance']."', '".$_SESSION['data2']['desc']."', '".$_SESSION['data']['from']."', '".$_SESSION['data']['to']."'";
								$q .= ", '".$_SESSION['data1']['type']."', '".$_SESSION['data1']['ship_container']."', '".$_SESSION['data1']['ship_type']."', '".$_SESSION['data']['from_state']."', '".$_SESSION['data']['to_state']."', '".$_SESSION['data1']['from']."', '".$_SESSION['data1']['to']."', '".$_SESSION['data']['type']."', '".$_SESSION['data']['date']."', '".$_SESSION['data']['exact_date']."', '".$_SESSION['data2']['lithium_bat']."', '".$_SESSION['data2']['chemical']."', '".$_SESSION['data2']['dg']."', '".time()."');";

								
								mysql_query($q) or die(mysql_error());
								$id = mysql_insert_id($con) or die(mysql_error());
								
								//RESULT_TextField-4902
								//RESULT_TextField-4903
								//RESULT_TextField-4904
								
								//RESULT_TextField-4907
								//RESULT_TextField-4908
								//RESULT_TextField-4909
								if(isset($_POST['RESULT_TextField-4902']) AND $_POST['RESULT_TextField-4902']!='' AND $_POST['RESULT_TextField-4902']!=null)
								{
									mysql_query("UPDATE `quote` SET `cc1`='".$_POST['RESULT_TextField-4902']."' WHERE `id`='".$id."'") or die(mysql_error());
								}
								
								if(isset($_POST['RESULT_TextField-4903']) AND $_POST['RESULT_TextField-4903']!='' AND $_POST['RESULT_TextField-4903']!=null)
								{
									mysql_query("UPDATE `quote` SET `cc2`='".$_POST['RESULT_TextField-4903']."' WHERE `id`='".$id."'") or die(mysql_error());
								}
								
								if(isset($_POST['RESULT_TextField-4905']) AND $_POST['RESULT_TextField-4905']!='' AND $_POST['RESULT_TextField-4905']!=null)
								{
									mysql_query("UPDATE `quote` SET `cc3`='".$_POST['RESULT_TextField-4905']."' WHERE `id`='".$id."'") or die(mysql_error());
								}
								
								if(isset($_POST['RESULT_TextField-4906']) AND $_POST['RESULT_TextField-4906']!='' AND $_POST['RESULT_TextField-4906']!=null)
								{
									mysql_query("UPDATE `quote` SET `cc4`='".$_POST['RESULT_TextField-4906']."' WHERE `id`='".$id."'") or die(mysql_error());
								}
								
								if(isset($_POST['RESULT_TextField-4907']) AND $_POST['RESULT_TextField-4907']!='' AND $_POST['RESULT_TextField-4907']!=null)
								{
									mysql_query("UPDATE `quote` SET `invemail`='".$_POST['RESULT_TextField-4907']."' WHERE `id`='".$id."'") or die(mysql_error());
								}
								
								if(isset($_POST['RESULT_TextField-4908']) AND $_POST['RESULT_TextField-4908']!='' AND $_POST['RESULT_TextField-4908']!=null)
								{
									mysql_query("UPDATE `quote` SET `quotemail`='".$_POST['RESULT_TextField-4908']."' WHERE `id`='".$id."'") or die(mysql_error());
								}
								
								if(isset($_POST['RESULT_TextField-4909']) AND $_POST['RESULT_TextField-4909']!='' AND $_POST['RESULT_TextField-4909']!=null)
								{
									mysql_query("UPDATE `quote` SET `palrtemail`='".$_POST['RESULT_TextField-4909']."' WHERE `id`='".$id."'") or die(mysql_error());
								}
								
								$tid = '';
								if(isset($_POST['RESULT_TextField-4904']) AND $_POST['RESULT_TextField-4904']!='' AND $_POST['RESULT_TextField-4904']!=null)
								{
									$tid .= "".$_POST['RESULT_TextField-4904']."-";
								}
								$tid .= "EPX-";
								if($data['company']!=''){
									$tid .= strtoupper(substr($data['company'],0,4))."-";
								}
								$tid .= $id;
								
								//$ref= "EPX-".$country_iso[$_SESSION['data']['from']]."-".$country_iso[$_SESSION['data']['to']]."";
								mysql_query("UPDATE `quote` SET `tid` = '".$tid."' WHERE `id`='".$id."'");
								
								if($uname!="")
								{
									mysql_query("UPDATE `quote` SET `uname` = '".$uname."' WHERE `id`='".$id."'");
								}
								if($_SESSION['data1']['terms']!="")
								{
									mysql_query("UPDATE `quote` SET `terms` = '".$_SESSION['data1']['terms']."' WHERE `id`='".$id."'");
								}
								if($_SESSION['data2']['terms']!="")
								{
									mysql_query("UPDATE `quote` SET `airterms` = '".$_SESSION['data2']['terms']."' WHERE `id`='".$id."'");
								}
								if($_SESSION['data2']['un']!="")
								{
									mysql_query("UPDATE `quote` SET `un_num` = '".$_SESSION['data2']['un']."' WHERE `id`='".$id."'");
								}
								if($_SESSION['data2']['class']!="")
								{
									mysql_query("UPDATE `quote` SET `class` = '".$_SESSION['data2']['class']."' WHERE `id`='".$id."'");
								}
								if($_SESSION['data2']['instruction']!="")
								{
									mysql_query("UPDATE `quote` SET `instruction` = '".$_SESSION['data2']['instruction']."' WHERE `id`='".$id."'");
								}
								if($_SESSION['data2']['stackable']!="")
								{
									mysql_query("UPDATE `quote` SET `stackable` = '".$_SESSION['data2']['stackable']."' WHERE `id`='".$id."'");
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
					<td colspan='3' style='padding:15px 0;'>". $data['firstname'] ."</td>
					<td colspan='2'>". $data['phone'] ."</td>
					<td colspan='2'>". $data['email'] ."</td>
					<td colspan='2'>". $data['company'] ."</td>
				</tr>
				<tr style='background-color:#ccc;text-align:center;font-weight:bold;color:#3a3a3a;'>
					<td colspan='9' style='padding:5px;'>Package Information</td>
				</tr>
				<tr style='background-color:#ccc;text-align:center;color:#3a3a3a;'>
					<td colspan='1' width='10%' style='padding:5px;color:#ff3333;'>No. of box or packages</td>
					<td colspan='2' width='30%'>Dimension(LxWxH)(cm) </td>
					<td colspan='1' width='10%'>Total Weight(kg)</td>
					<td colspan='1' width='10%'>Isurance</td>
					<td colspan='1' width='10%'>Stackable</td>
					<td colspan='3' width='30%'>Description</td>
				</tr>
				<tr style='background-color:#fff;text-align:center;font-weight:bold;'>
					<td colspan='1' style='padding:15px 0;color:#ff3333;'>". $_SESSION['data2']['n_item'] ."</td>
					<td colspan='2'>". str_replace(" | ","<br>",$_SESSION['data2']['dims']) ."</td>
					<td colspan='1'>". $_SESSION['data2']['t_weight'] ."</td>
					<td colspan='1'>". $_SESSION['data2']['insurance'] ."</td>
					<td colspan='1'>". $_SESSION['data2']['stackable'] ."</td>
					<td colspan='3'>". $_SESSION['data2']['desc'] ."</td>
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
					<td style='padding:15px 0;color:#ff3333;'>". $_SESSION['data']['from'] ."</td>
					<td style='padding:15px 0;color:#ff3333;'>". $_SESSION['data']['to'] ."</td>
					<td>". $_SESSION['data1']['type'] ." ".($_SESSION['data1']['type']=='Air' ? "(Terms : ". $_SESSION['data1']['terms'].")" : '')."</td>
					<td>". $_SESSION['data1']['ship_container'] ."</td>
					<td>". $_SESSION['data1']['ship_type'] ."</td>
					<td>". $_SESSION['data']['from_state'] ."</td>
					<td>". $_SESSION['data']['to_state'] ."</td>
					<td>". $_SESSION['data1']['from'] ."</td>
					<td>". $_SESSION['data1']['to'] ."</td>
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
					<td colspan='1' style='padding:15px 0;'>". $data['contact_method'] ."</td>
					<td colspan='1' style='padding:15px 0;'>". $data['contact_time'] ."</td>
					<td colspan='1' style='padding:15px 0;'>". $data['note'] ."</td>
					<td colspan='1' style='padding:15px 0;'>". $_SESSION['data']['type'] ."</td>
					<td colspan='1' style='padding:15px 0;'>". $_SESSION['data']['date'] ."</td>
					<td colspan='1' style='padding:15px 0;'>". $_SESSION['data']['exact_datedate'] ."</td>
					<td colspan='1' style='padding:15px 0;'>". $_SESSION['data2']['chemical'] ."</td>
					<td colspan='1' style='padding:15px 0;'>". $_SESSION['data2']['lithium_bat'] ."</td>
					<td colspan='1' style='padding:15px 0;'>". $_SESSION['data2']['dg'] ."</td>
				</tr>";
if($_SESSION['data2']['dg']=="Yes"){
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
					<td colspan='2' style='padding:15px 0;'>". $_SESSION['data2']['terms'] ."</td>
					<td colspan='2' style='padding:15px 0;'>". $_SESSION['data2']['un'] ."</td>
					<td colspan='2' style='padding:15px 0;'>". $_SESSION['data2']['class'] ."</td>
					<td colspan='3' style='padding:15px 0;'>". $_SESSION['data2']['instruction'] ."</td>
				</tr>";
}
$quote_body .= "			</tbody>
		</table>
		<div style='font-family:tahoma;font-size:12px;direction:ltr;margin:20px;'>
Europost Express (UK) Ltd.<br>
Unit W13, Research House Business Centre, <br>
Fraser Road , Perivale, Middlesex<br>
UB6 7AQ- London , UK<br>
www.europostexpress.co.uk<br>
cargo@europostexpress.co.uk<br>
Tel: +44(0) 208 5373286 - +44(0) 7886105417  <br>

		</div>
		</td>
	</tr>
</tbody></table>	
";
$customer_body = "<table cellpadding='5' cellspacing='1' style='margin-left:auto;margin-right:auto;width:100%;border:0px;font-family:tahoma;font-size:12px;direction:ltr;border:thin solid #777;'>
 <tr>
  <td style='background-color:#ffcc33;text-align:left;font-weight:bold;color:#ff3333;' width='80%'>
   Dear Customer <b>". $data['firstname'] ." </b>,<br>Here is the details of your order:
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
					<td colspan='3' style='padding:15px 0;'>". $data['firstname'] ."</td>
					<td colspan='2'>". $data['phone'] ."</td>
					<td colspan='2'>". $data['email'] ."</td>
					<td colspan='2'>". $data['company'] ."</td>
				</tr>
				<tr style='background-color:#ccc;text-align:center;font-weight:bold;color:#3a3a3a;'>
					<td colspan='9' style='padding:5px;'>Package Information</td>
				</tr>
				<tr style='background-color:#ccc;text-align:center;color:#3a3a3a;'>
					<td colspan='1' width='10%' style='padding:5px;color:#ff3333;'>No. of box or packages</td>
					<td colspan='2' width='30%'>Dimension(LxWxH)(cm) </td>
					<td colspan='1' width='10%'>Total Weight(kg)</td>
					<td colspan='2' width='10%'>Isurance</td>
					<td colspan='2' width='10%'>Stackable</td>
					<td colspan='3' width='30%'>Description</td>
				</tr>
				<tr style='background-color:#fff;text-align:center;font-weight:bold;'>
					<td colspan='1' style='padding:15px 0;color:#ff3333;'>". $_SESSION['data2']['n_item'] ."</td>
					<td colspan='2'>". str_replace(" | ","<br>",$_SESSION['data2']['dims']) ."</td>
					<td colspan='1'>". $_SESSION['data2']['t_weight'] ."</td>
					<td colspan='1'>". $_SESSION['data2']['insurance'] ."</td>
					<td colspan='1'>". $_SESSION['data2']['stackable'] ."</td>
					<td colspan='3'>". $_SESSION['data2']['desc'] ."</td>
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
					<td style='padding:15px 0;'>". $_SESSION['data']['from'] ."</td>
					<td style='padding:15px 0;'>". $_SESSION['data']['to'] ."</td>
					<td>". $_SESSION['data1']['type'] ." ".($_SESSION['data1']['type']=='Air' ? "(Terms : ". $_SESSION['data1']['terms'].")" : '')."</td>
					<td>". $_SESSION['data1']['ship_container'] ."</td>
					<td>". $_SESSION['data1']['ship_type'] ."</td>
					<td>". $_SESSION['data']['from_state'] ."</td>
					<td>". $_SESSION['data']['to_state'] ."</td>
					<td>". $_SESSION['data1']['from'] ."</td>
					<td>". $_SESSION['data1']['to'] ."</td>
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
					<td colspan='1' style='padding:15px 0;'>". $data['contact_method'] ."</td>
					<td colspan='1' style='padding:15px 0;'>". $data['contact_time'] ."</td>
					<td colspan='1' style='padding:15px 0;'>". $data['note'] ."</td>
					<td colspan='1' style='padding:15px 0;'>". $_SESSION['data']['type'] ."</td>
					<td colspan='1' style='padding:15px 0;'>". $_SESSION['data']['date'] ."</td>
					<td colspan='1' style='padding:15px 0;'>". $_SESSION['data']['exact_datedate'] ."</td>
					<td colspan='1' style='padding:15px 0;'>". $_SESSION['data2']['chemical'] ."</td>
					<td colspan='1' style='padding:15px 0;'>". $_SESSION['data2']['lithium_bat'] ."</td>
					<td colspan='1' style='padding:15px 0;'>". $_SESSION['data2']['dg'] ."</td>
				</tr>";
if($_SESSION['data2']['dg']=="Yes"){
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
					<td colspan='2' style='padding:15px 0;'>". $_SESSION['data2']['terms'] ."</td>
					<td colspan='2' style='padding:15px 0;'>". $_SESSION['data2']['un'] ."</td>
					<td colspan='2' style='padding:15px 0;'>". $_SESSION['data2']['class'] ."</td>
					<td colspan='3' style='padding:15px 0;'>". $_SESSION['data2']['instruction'] ."</td>
				</tr>";
}
$customer_body .= "
			</tbody>
		</table>
		<div style='font-family:tahoma;font-size:12px;direction:ltr;margin:20px;'>
Europost Express (UK) Ltd.<br>
Unit W13, Research House Business Centre, <br>
Fraser Road , Perivale, Middlesex<br>
UB6 7AQ- London , UK<br>
www.europostexpress.co.uk<br>
cargo@europostexpress.co.uk<br>
Tel: +44(0) 208 5373286 - +44(0) 7886105417  <br>

		</div>
		</td>
	</tr>
</tbody></table>	
";
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8;' . "\r\n";
	$headers .= 'From: Booking Parcel <quote1@bookingparcel.com>' . "\r\n";
	$headers .= 'X-Sender: quote1@bookingparcel.com' . "\r\n";
	
	$mailaddress = $data['email'];

require '../admin/mailer/PHPMailerAutoload.php';

	$mail = new PHPMailer;
	//$mail->IsSMTP();
	$mail->Host = "mail.bookingparcel.com";
	$mail->Port = 25;
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
	$mail->setFrom('cargo@europostexpress.co.uk', 'Booking Parcel');
	$mail->addReplyTo('cargo@europostexpress.co.uk', 'Booking Parcel');
	
	$mail->CharSet ="utf-8";
	$mail->isHTML(true);
	$mail->Subject = $subject;
	
    $mail->addAddress("quote1@bookingparcel.com", "BookingParcel");
	$mail->Body = $quote_body;
	
    if (!$mail->send()) {
		echo "Quote Mail Not sent<br>";
    }
	
    $mail->clearAddresses();
    $mail->clearAttachments();
	
	$mail->AddCC('backup1@bookingparcel.com', "BookingParcel(Quote Request)");
	
	$mail->addAddress($mailaddress, "". $row2['fname'] ." ". $row2['lname'] ."");
	
	$mail->Body = $customer_body;
	
	if (!$mail->send()) {
		echo "Customer Mail Not sent<br>";
	}
	
	
	
    // Clear all addresses and attachments for next loop
    $mail->clearAddresses();
    $mail->clearAttachments();
	
if($uname!='')
{
	$mail->AddCC("quote1@bookingparcel.com", "BookingParcel(Quote Request)");
		
	
	//$q = "SELECT * FROM `agents` WHERE `country`='".$_SESSION['data']['from']."' AND (`cover_city` LIKE '%".$_SESSION['data']['from_state']."%' OR `city`='".$_SESSION['data']['from_state']."') AND `active`=1 AND `fixed`=1 ORDER BY `id` ASC";
	$q = "SELECT * FROM `agents` WHERE `country`='".$_SESSION['data']['from']."' AND `active`=1 AND `fixed`=1 ORDER BY `id` ASC";
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
			
			$message = $row['message'];
			$message = str_replace("{tid}", $tid, $message);
			$message = str_replace("{GenerateUniqeURL}", GenerateURL($id, $tmp_r['id'], $_SESSION['data']['from_state'] . " - " .$_SESSION['data1']['from'], $_SESSION['data']['to_state'] . " - " .$_SESSION['data1']['to']), $message);
			$message = str_replace("{from_country}", $_SESSION['data']['from'], $message);
			$message = str_replace("{to_country}", $_SESSION['data']['to'], $message);
			$message = str_replace("{from_loc}", $_SESSION['data']['from_state'] . " - " .$_SESSION['data1']['from'], $message);
			$message = str_replace("{to_loc}", $_SESSION['data']['to_state'] . " - " .$_SESSION['data']['to'], $message);
			$message = str_replace("{item_count}", $_SESSION['data2']['n_item'], $message);
			$message = str_replace("{item_dims}",  str_replace(" | ","<br>",$_SESSION['data2']['dims']), $message);
			$message = str_replace("{item_weight}", $_SESSION['data2']['t_weight'], $message);
			$message = str_replace("{item_Desc}", $_SESSION['data2']['desc'], $message);
			$message = str_replace("{note_value}", $data['note'], $message);
			
			$mail->Subject = "New Quote request from ". $_SESSION['data']['from'] .",to ". $_SESSION['data']['to'] ." ,ref EPX-".$country_iso[$_SESSION['data']['from']]."-".$country_iso[$_SESSION['data']['to']]."-".$id."";
			//$mail->Body = $message;
			
			
			$mail->setFrom('quote1@bookingparcel.com', 'Booking Parcel');
			$mail->addReplyTo('quote1@bookingparcel.com', 'Booking Parcel');
			
			while($row2 = mysql_fetch_array($r)){
				
				$body1 = str_replace("{company_name}", $row2['cname'], $message, $_c);
				$body1 = str_replace("agent_name", $row2['fname'], $body1, $_c);
				$mail->Body = $body1;
				
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
				if(!$mail->send())
				{
					echo "sending mail to agent ". $row2['fname'] ." failed";
				}
				$mail->clearAddresses();
				$mail->clearAttachments();
			}
		}
	}
}
	//mail($mail, $subject, $customer_body, $headers);
	//mail("quote1@bookingparcel.com", $subject, $quote_body, $headers);
	unset($_SESSION['data']);
	unset($_SESSION['data1']);
	unset($_SESSION['data2']);
							}
						}
					}
					if($error==false){
						$shown_type = 4;
					}
					
					mysql_close($con);
					//RESULT_RadioButton-47
					break;
			}
		}
		elseif(isset($_POST['PreviousSubmit']) AND $_POST['PreviousSubmit']=='< Previous'){
			switch($_POST['pt']){
				case 2:
					if(isset($_SESSION['data'])){
						$error = false;
						$shown_type = 0;
					}
					break;
				case 3:
					if(isset($_SESSION['data1'])){
						$error = false;
						$shown_type = 1;
					}
					break;
				case 4:
					if(isset($_SESSION['data2'])){
						$error = false;
						$shown_type = 2;
					}
					break;
			}
		}
	}
	if($shown_type==0){
	?>
		<form method="post" id="FSForm" action="form.php" enctype="application/x-www-form-urlencoded" onsubmit="return Vromansys.Form.processSubmit(this);">
			<div style="display:none;">
				<input type="hidden" name="pt" id="pt" value="1" />
				<input type="text" name="subject_line" id="subject_line" autocomplete="off" /><label for="subject_line">subject_line</label>
			</div>
			<?php
			if($error){
				echo '<div class="form_table invalid" style="margin-bottom:10px"><div class="invalid_message" style="border:none;font-size:1em;padding:6px;text-align:center;">Please review the form and correct the highlighted items.</div></div>';
			}
			
			?>
			<!-- BEGIN_ITEMS -->
			<div class="form_table">

				<div class="clear"></div>

				<div id="q36" class="q full_width">
					<a class="item_anchor" name="ItemAnchor0"></a>
					<div class="segment_header" style="width:auto;text-align:Center;"><h1 style="font-size:30px;padding:20px 1em ;">Shipping quote</h1></div>
				</div>

				<div class="clear"></div>

				<div id="q38" class="q full_width">
					<a class="item_anchor" name="ItemAnchor1"></a>
					<div class="full_width_space"><div>&nbsp;</div></div>
				</div>

				<div class="clear"></div>

				<div id="q41" class="q required <?php if($error AND (!isset($_POST['RESULT_RadioButton-2']) OR ($_POST['RESULT_RadioButton-2']!='Radio-0' AND $_POST['RESULT_RadioButton-2']!='Radio-1' AND $_POST['RESULT_RadioButton-2']!='Radio-2'))){ echo "invalid"; } ?>">
					<a class="item_anchor" name="ItemAnchor2"></a>
					<span class="question top_question">Please select:&nbsp;<span class="icon">&nbsp;</span></span>
					<table class="inline_grid">
						<tr>
							<td><input type="radio" name="RESULT_RadioButton-2" class="multiple_choice" id="RESULT_RadioButton-2_0" value="Radio-0"  onClick="cds('remove');" <?php if((isset($_SESSION['data']['from']) AND $_SESSION['data']['from']=='United Kingdom') OR (isset($_POST['RESULT_RadioButton-2']) AND $_POST['RESULT_RadioButton-2']=='Radio-0')){ echo "checked='checked'"; } ?>/><label for="RESULT_RadioButton-2_0" >Shipping from the UK</label></td>
						</tr>
						<tr>
							<td><input type="radio" name="RESULT_RadioButton-2" class="multiple_choice" id="RESULT_RadioButton-2_1" value="Radio-1"  onClick="cds('remove');" <?php if((isset($_SESSION['data']['to']) AND $_SESSION['data']['to']=='United Kingdom') OR (isset($_POST['RESULT_RadioButton-2']) AND $_POST['RESULT_RadioButton-2']=='Radio-1')){ echo "checked='checked'"; } ?>/><label for="RESULT_RadioButton-2_1" >Shipping to the UK</label></td>
						</tr>
						<tr>
							<td><input type="radio" name="RESULT_RadioButton-2" class="multiple_choice" id="RESULT_RadioButton-2_2" value="Radio-2" onClick="cds('add');" <?php if(((isset($_SESSION['data']['from']) AND $_SESSION['data']['from']!='United Kingdom') AND (isset($_SESSION['data']['to']) AND $_SESSION['data']['to']!='United Kingdom')) OR(isset($_POST['RESULT_RadioButton-2']) AND $_POST['RESULT_RadioButton-2']=='Radio-2')){ echo "checked='checked'"; } ?>/><label for="RESULT_RadioButton-2_2" >Other</label></td>
						</tr>
					</table>
					 <?php if($error AND (!isset($_POST['RESULT_RadioButton-2']) OR ($_POST['RESULT_RadioButton-2']!='Radio-0' AND $_POST['RESULT_RadioButton-2']!='Radio-1' AND $_POST['RESULT_RadioButton-2']!='Radio-2'))){ echo "<div class=\"invalid_message\">Response Required</div>"; } ?>
				</div>

				<div class="clear"></div>

				<div id="q80" class="q required <?php if($error AND (!isset($_POST['RESULT_RadioButton-3']) OR ($_POST['RESULT_RadioButton-3']!='Radio-0' AND $_POST['RESULT_RadioButton-3']!='Radio-1'))){ echo "invalid"; } ?>">
					<a class="item_anchor" name="ItemAnchor3"></a>
					<span class="question top_question">Shipping type:&nbsp;<span class="icon">&nbsp;</span></span>
					<table class="inline_grid">
						<tr>
							<td><input type="radio" name="RESULT_RadioButton-3" class="multiple_choice" id="RESULT_RadioButton-3_0" value="Radio-0" <?php if((isset($_SESSION['data']['type']) AND $_SESSION['data']['type']=='Commercial') OR (isset($_POST['RESULT_RadioButton-3']) AND $_POST['RESULT_RadioButton-3']=='Radio-0')){ echo "checked='checked'"; } ?>/><label for="RESULT_RadioButton-3_0" >Commercial</label></td>
						</tr>
						<tr>
							<td><input type="radio" name="RESULT_RadioButton-3" class="multiple_choice" id="RESULT_RadioButton-3_1" value="Radio-1" <?php if((isset($_SESSION['data']['type']) AND $_SESSION['data']['type']=='Personal') OR (isset($_POST['RESULT_RadioButton-3']) AND $_POST['RESULT_RadioButton-3']=='Radio-1')){ echo "checked='checked'"; } ?>/><label for="RESULT_RadioButton-3_1" >Personal</label></td>
						</tr>
					</table>
					 <?php if($error AND (!isset($_POST['RESULT_RadioButton-3']) OR ($_POST['RESULT_RadioButton-3']!='Radio-0' AND $_POST['RESULT_RadioButton-3']!='Radio-1'))){ echo "<div class=\"invalid_message\">Response Required</div>"; } ?>
				</div>

				<div class="clear"></div>
				
				<div id="q8000" class="q required x-hidden">
					<a class="item_anchor" name="ItemAnchor3"></a>
					<span class="question top_question">Locations:&nbsp;<span class="icon">&nbsp;</span></span>
					<table class="inline_grid">
						<tr>
							<td>
								<label for="RESULT_RadioButton-300_0" >Collection Country</label>
								<select name="RESULT_RadioButton-300" id="RESULT_RadioButton-300_0" class="drop_down"/>
									<option></option>
									<?php 
									foreach($post_c as $k=>$v){
										echo "<option value=\"".$k."\"".(((isset($_SESSION['data']['from']) AND $v==$_SESSION['data']['from']) OR (isset($_POST['RESULT_RadioButton-300']) AND $_POST['RESULT_RadioButton-300']==$v)) ? " selected='selected'" : "").">".$v."</option>";
									}
									?>
								</select>
							</td>
						</tr>
						<tr>
							<td>

								<label for="RESULT_RadioButton-301_0" >Destination Country</label>
								<select name="RESULT_RadioButton-301" id="RESULT_RadioButton-301_0" class="drop_down"/>
									<option></option>
									<?php 
									foreach($post_c as $k=>$v){
										echo "<option value=\"".$k."\"".(((isset($_SESSION['data']['to']) AND $v==$_SESSION['data']['to']) OR (isset($_POST['RESULT_RadioButton-301']) AND $_POST['RESULT_RadioButton-301']==$v)) ? " selected='selected'" : "").">".$v."</option>";
									}
									?>
								</select>
							</td>
						</tr>
					</table>
				</div>

				<div class="clear"></div>

				<div id="q2" class="q required">
					<a class="item_anchor" name="ItemAnchor4"></a>
					<label class="question top_question" for="RESULT_RadioButton-4">Destination country&nbsp;<span class="icon">&nbsp;</span></label>
					<select id="RESULT_RadioButton-4" name="RESULT_RadioButton-4" class="drop_down">
						<option></option>
						<?php 
						foreach($post_c as $k=>$v){
							if($v=='United Kingdom') continue;
							echo "<option value=\"".$k."\"".(((isset($_SESSION['data']['to']) AND $v==$_SESSION['data']['to']) OR (isset($_POST['RESULT_RadioButton-4']) AND $_POST['RESULT_RadioButton-4']==$v)) ? " selected='selected'" : "").">".$v."</option>";
						}
						?>
					</select>
				</div>

				<div class="clear"></div>

				<div id="q13" class="q required">
					<a class="item_anchor" name="ItemAnchor5"></a>
					<label class="question top_question" for="RESULT_RadioButton-5">Collection country:&nbsp;<span class="icon">&nbsp;</span></label>
					<select id="RESULT_RadioButton-5" name="RESULT_RadioButton-5" class="drop_down">
						<option></option>
						<?php 
						foreach($post_c as $k=>$v){
							if($v=='United Kingdom') continue;
							echo "<option value=\"".$k."\"".(((isset($_SESSION['data']['from']) AND $v==$_SESSION['data']['from']) OR (isset($_POST['RESULT_RadioButton-5']) AND $_POST['RESULT_RadioButton-5']==$v)) ? " selected='selected'" : "").">".$v."</option>";
						}
						?>
					</select>
				</div>

				<div class="clear"></div>

				<div id="q25" class="q required">
					<a class="item_anchor" name="ItemAnchor6"></a>
					<label class="question top_question" for="RESULT_RadioButton-6">Select State:&nbsp;<span class="icon">&nbsp;</span></label>
					<select id="RESULT_RadioButton-6" name="RESULT_RadioButton-6" class="drop_down">
						<option></option>
						<option value="Radio-0">Alabama</option>
						<option value="Radio-1">Alaska</option>
						<option value="Radio-2">Arizona</option>
						<option value="Radio-3">Arkansas</option>
						<option value="Radio-4">California</option>
						<option value="Radio-5">Colorado</option>
						<option value="Radio-6">Connecticut</option>
						<option value="Radio-7">Delaware</option>
						<option value="Radio-8">Florida</option>
						<option value="Radio-9">Georgia</option>
						<option value="Radio-10">Hawaii</option>
						<option value="Radio-11">Idaho</option>
						<option value="Radio-12">Illinois</option>
						<option value="Radio-13">Indiana</option>
						<option value="Radio-14">Iowa</option>
						<option value="Radio-15">Kansas</option>
						<option value="Radio-16">Kentucky</option>
						<option value="Radio-17">Louisiana</option>
						<option value="Radio-18">Maine</option>
						<option value="Radio-19">Maryland</option>
						<option value="Radio-20">Massachusetts</option>
						<option value="Radio-21">Michigan</option>
						<option value="Radio-22">Minnesota</option>
						<option value="Radio-23">Mississippi</option>
						<option value="Radio-24">Missouri</option>
						<option value="Radio-25">Montana</option>
						<option value="Radio-26">Nebraska</option>
						<option value="Radio-27">Nevada</option>
						<option value="Radio-28">New Hampshire</option>
						<option value="Radio-29">New Jersey</option>
						<option value="Radio-30">New Mexico</option>
						<option value="Radio-31">New York</option>
						<option value="Radio-32">North Carolina</option>
						<option value="Radio-33">North Dakota</option>
						<option value="Radio-34">Ohio</option>
						<option value="Radio-35">Oklahoma</option>
						<option value="Radio-36">Oregon</option>
						<option value="Radio-37">Pennsylvania</option>
						<option value="Radio-38">Rhode Island</option>
						<option value="Radio-39">South Carolina</option>
						<option value="Radio-40">South Dakota</option>
						<option value="Radio-41">Tennessee</option>
						<option value="Radio-42">Texas</option>
						<option value="Radio-43">Utah</option>
						<option value="Radio-44">Vermont</option>
						<option value="Radio-45">Virginia</option>
						<option value="Radio-46">Washington</option>
						<option value="Radio-47">West Virginia</option>
						<option value="Radio-48">Wisconsin</option>
						<option value="Radio-49">Wyoming</option>
						<option value="Radio-50">Washington DC</option>
					</select>
				</div>

				<div class="clear"></div>

				<div id="q66" class="q required">
					<a class="item_anchor" name="ItemAnchor7"></a>
					<label class="question top_question" for="RESULT_RadioButton-7">Where in Afghanistan:&nbsp;<span class="icon">&nbsp;</span></label>
					<select id="RESULT_RadioButton-7" name="RESULT_RadioButton-7" class="drop_down">
						<option></option>
						<option value="Radio-0">Bagrami</option>
						<option value="Radio-1">Herat</option>
						<option value="Radio-2" selected="selected">Kabul</option>
						<option value="Radio-3">Kandahar</option>
						<option value="Radio-4">Not sure</option>
					</select>
				</div>

				<div class="clear"></div>

				<div id="q67" class="q required">
					<a class="item_anchor" name="ItemAnchor8"></a>
					<label class="question top_question" for="RESULT_RadioButton-8">Where in Iran:&nbsp;<span class="icon">&nbsp;</span></label>
					<select id="RESULT_RadioButton-8" name="RESULT_RadioButton-8" class="drop_down">
						<option></option>
						<option value="Radio-0">Bandar abbas</option>
						<option value="Radio-1">Chabahar</option>
						<option value="Radio-2" selected="selected">Imam Khomeini airport</option>
						<option value="Radio-3">Shahriar customs</option>
						<option value="Radio-4">Not sure</option>
					</select>
				</div>

				<div class="clear"></div>

				<div id="q68" class="q required">
					<a class="item_anchor" name="ItemAnchor9"></a>
					<label class="question top_question" for="RESULT_RadioButton-9">Where in Iraq:&nbsp;<span class="icon">&nbsp;</span></label>
					<select id="RESULT_RadioButton-9" name="RESULT_RadioButton-9" class="drop_down">
						<option></option>
						<option value="Radio-0" selected="selected">Baghdad</option>
						<option value="Radio-1">Basrah</option>
						<option value="Radio-2">Erbil</option>
						<option value="Radio-3">Suleymanieh</option>
						<option value="Radio-4">Not sure</option>
					</select>
				</div>

				<div class="clear"></div>

				<div id="q69" class="q required">
					<a class="item_anchor" name="ItemAnchor10"></a>
					<label class="question top_question" for="RESULT_RadioButton-10">Where in UAE:&nbsp;<span class="icon">&nbsp;</span></label>
					<select id="RESULT_RadioButton-10" name="RESULT_RadioButton-10" class="drop_down">
					<option></option>
						<option value="Radio-0">Abu Dhabi</option>
						<option value="Radio-1" selected="selected">Dubai</option>
						<option value="Radio-2">Jebel Ali</option>
						<option value="Radio-3">Not sure</option>
					</select>
				</div>

				<div class="clear"></div>

				<div id="q70" class="q required">
					<a class="item_anchor" name="ItemAnchor11"></a>
					<label class="question top_question" for="RESULT_RadioButton-11">Where in Turkey:&nbsp;<span class="icon">&nbsp;</span></label>
					<select id="RESULT_RadioButton-11" name="RESULT_RadioButton-11" class="drop_down">
						<option></option>
						<option value="Radio-0">Antalya</option>
						<option value="Radio-1" selected="selected">Ataturk in Istanbul</option>
						<option value="Radio-2">Edirne</option>
						<option value="Radio-3">Port of Istanbul</option>
						<option value="Radio-4">Not sure</option>
					</select>
				</div>

				<div class="clear"></div>

				<div id="q10" class="q required <?php if($error AND (!isset($_POST['RESULT_RadioButton-12']) OR ($_POST['RESULT_RadioButton-12']!='Radio-0' AND $_POST['RESULT_RadioButton-12']!='Radio-1' AND $_POST['RESULT_RadioButton-12']!='Radio-2' AND $_POST['RESULT_RadioButton-12']!='Radio-3' AND $_POST['RESULT_RadioButton-12']!='Radio-4'))){ echo "invalid"; } ?>">
					<a class="item_anchor" name="ItemAnchor12"></a>
					<label class="question top_question" for="RESULT_RadioButton-12">When?&nbsp;<span class="icon">&nbsp;</span></label>
					<select id="RESULT_RadioButton-12" name="RESULT_RadioButton-12" class="drop_down">
						<option></option>
						<option value="Radio-0" <?php if((isset($_SESSION['data']['date']) AND $_SESSION['data']['date']=='ASAP') OR (isset($_POST['RESULT_RadioButton-12']) AND $_POST['RESULT_RadioButton-12']=='Radio-0')){ echo "selected"; } ?>>ASAP</option>
						<option value="Radio-1" <?php if((isset($_SESSION['data']['date']) AND $_SESSION['data']['date']=='This week') OR (isset($_POST['RESULT_RadioButton-12']) AND $_POST['RESULT_RadioButton-12']=='Radio-1')){ echo "selected"; } ?>>This week</option>
						<option value="Radio-2" <?php if((isset($_SESSION['data']['date']) AND $_SESSION['data']['date']=='This month') OR (isset($_POST['RESULT_RadioButton-12']) AND $_POST['RESULT_RadioButton-12']=='Radio-2')){ echo "selected"; } ?>>This month</option>
						<option value="Radio-3" <?php if((isset($_SESSION['data']['date']) AND $_SESSION['data']['date']=='Enter exact date') OR (isset($_POST['RESULT_RadioButton-12']) AND $_POST['RESULT_RadioButton-12']=='Radio-3')){ echo "selected"; } ?>>Enter exact date</option>
						<option value="Radio-4" <?php if((isset($_SESSION['data']['date']) AND $_SESSION['data']['date']=='Not sure when') OR (isset($_POST['RESULT_RadioButton-12']) AND $_POST['RESULT_RadioButton-12']=='Radio-4')){ echo "selected"; } ?>>Not sure when</option>
					</select>
					 <?php if($error AND (!isset($_POST['RESULT_RadioButton-12']) OR ($_POST['RESULT_RadioButton-12']!='Radio-0' AND $_POST['RESULT_RadioButton-12']!='Radio-1' AND $_POST['RESULT_RadioButton-12']!='Radio-2' AND $_POST['RESULT_RadioButton-12']!='Radio-3' AND $_POST['RESULT_RadioButton-12']!='Radio-4'))){ echo "<div class=\"invalid_message\">Response Required</div>"; } ?>
				</div>

				<div class="clear"></div>

				<div id="q81" class="q required">
					<a class="item_anchor" name="ItemAnchor13"></a>
					<label class="question top_question" for="RESULT_TextField-13">Please enter exact date:&nbsp;<span class="icon">&nbsp;</span></label>
					<input type="text" name="RESULT_TextField-13" class="text_field calendar_field" id="RESULT_TextField-13" size="10" maxlength="10" datemax="" value="<?php if((isset($_SESSION['data']['date']) AND $_SESSION['data']['date']=='Enter exact date') AND (isset($_SESSION['data']['exact_date']) AND $_SESSION['data']['exact_date']!='')) echo $_SESSION['data']['exact_date']; ?>" datemin="" value="" date="yy-mm-dd" /><img class="svg popup_button inline_button" src="images/icons/formIcons/calendar.svg" alt="calendar" style="vertical-align:middle;"/>
					<img class="gif popup_button inline_button" src="images/icons/formIcons/calendar.gif" alt="calendar" style="vertical-align:middle;"/>

				</div>

				<div class="clear"></div>

				<div id="q23" class="q">
					<a class="item_anchor" name="ItemAnchor14"></a>
					<span class="question top_question">Need customs clearance?<span class="icon">&nbsp;</span></span>
					<table class="inline_grid">
						<tr>
							<td><input type="radio" name="RESULT_RadioButton-14" class="multiple_choice" id="RESULT_RadioButton-14_0" value="Radio-0" /><label for="RESULT_RadioButton-14_0" >Yes</label></td>
						</tr>
						<tr>
							<td><input type="radio" name="RESULT_RadioButton-14" class="multiple_choice" id="RESULT_RadioButton-14_1" value="Radio-1" /><label for="RESULT_RadioButton-14_1" >No</label></td>
						</tr>
						<tr>
							<td><input type="radio" name="RESULT_RadioButton-14" class="multiple_choice" id="RESULT_RadioButton-14_2" value="Radio-2" /><label for="RESULT_RadioButton-14_2" >Maybe, not sure</label></td>
						</tr>
					</table>
				</div>

				<div class="clear"></div>

				<div id="q98" class="q full_width">
					<a class="item_anchor" name="ItemAnchor15"></a>
					<br/>
				</div>
				<div class="clear"></div>

			</div>
			<!-- END_ITEMS -->
			<script type="text/javascript">var itemRules={2:{"criteria":[{"item":41,"answer":"0","operator":"=="}],"action":"show","join":"||"},13:{"criteria":[{"item":41,"answer":"1","operator":"=="}],"action":"show","join":"||"},25:{"criteria":[{"item":13,"answer":"185","operator":"=="},{"item":2,"answer":"184","operator":"=="}],"action":"show","join":"||"},66:{"criteria":[{"item":2,"answer":"0","operator":"=="},{"item":13,"answer":"0","operator":"=="}],"action":"show","join":"||"},67:{"criteria":[{"item":13,"answer":"77","operator":"=="}],"action":"show","join":"||"},68:{"criteria":[{"item":13,"answer":"78","operator":"=="},{"item":2,"answer":"78","operator":"=="}],"action":"show","join":"||"},69:{"criteria":[{"item":13,"answer":"183","operator":"=="},{"item":2,"answer":"183","operator":"=="}],"action":"show","join":"||"},70:{"criteria":[{"item":13,"answer":"178","operator":"=="},{"item":2,"answer":"178","operator":"=="}],"action":"show","join":"||"},81:{"criteria":[{"item":10,"answer":"3","operator":"=="}],"action":"show","join":"||"},23:{"criteria":[{"item":41,"answer":"1","operator":"=="}],"action":"show","join":"||"}};</script>
			<input type="hidden" name="EParam" value="FzpUCZwnDno=" />
			<div class="outside_container">
				<div class="buttons_reverse">
					<input type="submit" name="Submit" value="Next &gt;" class="submit_button" id="FSsubmit" />
					<input type="button" name="PreviousSubmit" value="I have a tracking ID" class="submit_button" id="FSpreviousSubmit" onClick="window.location.href='track.php'" />
				</div>
			</div>
			<input type="hidden" id="EmbeddedForm" name="EmbeddedForm" value="EmbeddedForm" style="display: none;">
			<input type="hidden" id="EmbedId" name="EmbedId" value="1332349481" style="display: none;">
			<input type="hidden" id="HostUrl" name="HostUrl" value="" style="display: none;">
		</form>
	<?php
	}
	elseif($shown_type==1){
		//print_r($_SESSION['data']);
	?>
	<form method="post" id="FSForm" action="form.php" enctype="application/x-www-form-urlencoded" onsubmit="return Vromansys.Form.processSubmit(this);">
		<div style="display:none;">
		<input type="hidden" name="pt" value="2" />
		<input type="hidden" name="locid" value="janetravis/form3" />
		<input type="hidden" name="EParam" value="AT1kKIiyxDyY+5pZv75zR4njqh0+izcTTBvqp3+bSzyXZa0SjkwcoP7xTxCbyOAXuShjugtfN46jPE1dbu+f58bUG5tNtAHhK5oMHUOxJy8=" />
		<input type="hidden" name="ElapsedTime" id="ElapsedTime" value="1228636" />
		<input type="hidden" name="Referrer" id="Referrer" value="http://www.bookingparcel.com" />
		<input type="text" name="subject_line" id="subject_line" autocomplete="off" /><label for="subject_line">subject_line</label>
		</div>

		<div class="outside_container"><div class="progressBarWrapper" ><div class="progressBarBack" style=" width:25%; " ><div class="progressBarText" >25%&nbsp;Complete</div></div><div class="progressBarFront" ><div class="progressBarText" >25%&nbsp;Complete</div></div></div></div>

		<?php
		if($error){
			echo '<div class="form_table invalid" style="margin-bottom:10px"><div class="invalid_message" style="border:none;font-size:1em;padding:6px;text-align:center;">Please review the form and correct the highlighted items.</div></div>';
		}
		
		?>
		<!-- BEGIN_ITEMS -->
		<div class="form_table">

		<div class="clear"></div>

		<div id="q100" class="q full_width">
			<a class="item_anchor" name="ItemAnchor17"></a>
			<div class="segment_header" style="width:auto;text-align:Center;"><h1 style="font-size:18px;padding:20px 1em ;"><h1>Shipping quote</h1></h1></div>
		</div>

		<div class="clear"></div>
		<div id="q1700" class="q required highlight">
			<a class="item_anchor" name="ItemAnchor1800"></a>
			<label class="question top_question" for="RESULT_TextField-1800">Which city of <?php echo $_SESSION['data']['from']; ?>:&nbsp;<span class="icon">&nbsp;</span></label>
			<input type="text" name="RESULT_TextField-1800" class="text_field" id="RESULT_TextField-1800  size="10" maxlength="255" value="" >
		</div>
		<div class="clear"></div>
		<div id="q1701" class="q required highlight">
			<a class="item_anchor" name="ItemAnchor1801"></a>
			<label class="question top_question" for="RESULT_TextField-1801">Which city of <?php echo $_SESSION['data']['to']; ?>:&nbsp;<span class="icon">&nbsp;</span></label>
			<input type="text" name="RESULT_TextField-1801" class="text_field" id="RESULT_TextField-1801  size="10" maxlength="255" value="" >
		</div>
		<div class="clear"></div>
		<div id="q17" class="q required">
			<a class="item_anchor" name="ItemAnchor18"></a>
			<label class="question top_question" for="RESULT_RadioButton-18">Please select shipping method:&nbsp;<span class="icon">&nbsp;</span></label>
			<select id="RESULT_RadioButton-18" name="RESULT_RadioButton-18" class="drop_down">
				<option></option>
				<option value="Radio-0"<?php if((isset($_SESSION['data1']['type']) AND $_SESSION['data1']['type']=='Air') OR (isset($_POST['RESULT_RadioButton-18']) AND $_POST['RESULT_RadioButton-18']=='Radio-0')) echo " selected='selected'"; ?>>Air</option>
				<option value="Radio-1"<?php if((isset($_SESSION['data1']['type']) AND $_SESSION['data1']['type']=='Sea') OR (isset($_POST['RESULT_RadioButton-18']) AND $_POST['RESULT_RadioButton-18']=='Radio-1')) echo " selected='selected'"; ?>>Sea</option>
				<option value="Radio-2"<?php if((isset($_SESSION['data1']['type']) AND $_SESSION['data1']['type']=='Land') OR (isset($_POST['RESULT_RadioButton-18']) AND $_POST['RESULT_RadioButton-18']=='Radio-2')) echo " selected='selected'"; ?>>Land</option>
				<option value="Radio-4"<?php if((isset($_SESSION['data1']['type']) AND $_SESSION['data1']['type']=='Rail Way') OR (isset($_POST['RESULT_RadioButton-18']) AND $_POST['RESULT_RadioButton-18']=='Radio-4')) echo " selected='selected'"; ?>>Rail Way</option>
				<option value="Radio-3"<?php if((isset($_SESSION['data1']['type']) AND $_SESSION['data1']['type']=='Not sure') OR (isset($_POST['RESULT_RadioButton-18']) AND $_POST['RESULT_RadioButton-18']=='Radio-3')) echo " selected='selected'"; ?>>Not sure</option>
			</select>
		</div>

		<div class="clear"></div>

		<div id="q106" class="q full_width">
			<a class="item_anchor" name="ItemAnchor19"></a>
			<p style="padding:0 30px ;"><b>NOTE:</b></br>
			Current AIRFREIGHT transit times:</br>
			<b>3 to 7 days</b> for all destinations.
		</div>

		<div class="clear"></div>

		<div id="q110" class="q full_width">
			<a class="item_anchor" name="ItemAnchor20"></a>
			<p style="padding:0 30px ;"><b>NOTE:</b></br>
			Current SEAFREIGHT transit times: (days)</br>
			Africa: 12 to 18</br>
			Australia: 36 to 57</br>
			China: 26 to 42</br>   
			Europe: 7 to 14s</br>
			India: 20 to 35</br> 
			Latin America: 13 to 28</br>
			Middle East: 16 to 38</br>
			North America: 10</br>

		</div>

		<div class="clear"></div>

		<div id="q82" class="q required">
			<a class="item_anchor" name="ItemAnchor21"></a>
			<span class="question top_question">Container specification:&nbsp;<span class="icon">&nbsp;</span></span>
			<table class="inline_grid">
				<tr>
					<td><input type="radio" name="RESULT_RadioButton-21" class="multiple_choice" id="RESULT_RadioButton-21_0" value="Radio-0" <?php if((isset($_SESSION['data1']['ship_container']) AND $_SESSION['data1']['ship_container']=='FCL') OR (isset($_POST['RESULT_RadioButton-21']) AND $_POST['RESULT_RadioButton-21']=='Radio-0')) echo " checked='checked'"; ?>/><label for="RESULT_RadioButton-21_0" >FCL (Full Container Load)</label></td>
				</tr>
				<tr>
					<td><input type="radio" name="RESULT_RadioButton-21" class="multiple_choice" id="RESULT_RadioButton-21_1" value="Radio-1" <?php if((isset($_SESSION['data1']['ship_container']) AND $_SESSION['data1']['ship_container']=='LCL') OR (isset($_POST['RESULT_RadioButton-21']) AND $_POST['RESULT_RadioButton-21']=='Radio-1')) echo " checked='checked'"; ?>/><label for="RESULT_RadioButton-21_1" >LCL (Less > Container Load)</label></td>
				</tr>
				<tr>
					<td><input type="radio" name="RESULT_RadioButton-21" class="multiple_choice" id="RESULT_RadioButton-21_2" value="Radio-2" <?php if((isset($_SESSION['data1']['ship_container']) AND $_SESSION['data1']['ship_container']=='Not Sure') OR (isset($_POST['RESULT_RadioButton-21']) AND $_POST['RESULT_RadioButton-21']=='Radio-2')) echo " checked='checked'"; ?>/><label for="RESULT_RadioButton-21_2" >Not sure</label></td>
				</tr>
			</table>
		</div>

		<div class="clear"></div>

		<div id="q86" class="q required">
			<a class="item_anchor" name="ItemAnchor22"></a>
			<label class="question top_question" for="RESULT_TextField-22">Number of containers? <br /><span style="font-size: 8pt;">(Default is 1)</span>&nbsp;<span class="icon">&nbsp;</span></label>
			<input type="text" name="RESULT_TextField-22" class="text_field" id="RESULT_TextField-22"  size="10" maxlength="255" value="<?php if(isset($_SESSION['data1']['ship_container_c']) AND $_SESSION['data1']['ship_container_c']!='') echo $_SESSION['data1']['ship_container_c']; elseif(isset($_POST['RESULT_TextField-22']) AND $_POST['RESULT_TextField-22']!='') echo $_POST['RESULT_TextField-22']; else echo 1; ?>" />
			</div>

			<div class="clear"></div>

			<div id="q83" class="q required">
			<a class="item_anchor" name="ItemAnchor23"></a>
			<span class="question top_question">FCL (Full Container Load)&nbsp;<span class="icon">&nbsp;</span></span>
			<table class="inline_grid">
				<tr>
					<td><input type="radio" name="RESULT_RadioButton-23" class="multiple_choice" id="RESULT_RadioButton-23_0" value="Radio-0" <?php if((isset($_SESSION['data1']['ship_container_s']) AND $_SESSION['data1']['ship_container_s']=='20 ft container') OR (isset($_POST['RESULT_RadioButton-23']) AND $_POST['RESULT_RadioButton-23']=='Radio-0')) echo " checked='checked'"; ?>/><label for="RESULT_RadioButton-23_0" >20 ft container</label></td>
				</tr>
				<tr>
					<td><input type="radio" name="RESULT_RadioButton-23" class="multiple_choice" id="RESULT_RadioButton-23_1" value="Radio-1" <?php if((isset($_SESSION['data1']['ship_container_s']) AND $_SESSION['data1']['ship_container_s']=='40 ft container') OR (isset($_POST['RESULT_RadioButton-23']) AND $_POST['RESULT_RadioButton-23']=='Radio-1')) echo " checked='checked'"; ?>/><label for="RESULT_RadioButton-23_1" >40 ft container</label></td>
				</tr>
				<tr>
					<td><input type="radio" name="RESULT_RadioButton-23" class="multiple_choice" id="RESULT_RadioButton-23_2" value="Radio-2" <?php if((isset($_SESSION['data1']['ship_container_s']) AND $_SESSION['data1']['ship_container_s']=='40 ft high cube container') OR (isset($_POST['RESULT_RadioButton-23']) AND $_POST['RESULT_RadioButton-23']=='Radio-2')) echo " checked='checked'"; ?>/><label for="RESULT_RadioButton-23_2" >40 ft high cube container</label></td>
				</tr>
			</table>
		</div>

		<div class="clear"></div>

		<div id="q87" class="q required">
			<a class="item_anchor" name="ItemAnchor24"></a>
			<span class="question top_question">Sea freight delivery:&nbsp;<span class="icon">&nbsp;</span></span><!--$_SESSION['data1']['ship_type']-->
			<table class="inline_grid">
				<tr>
					<td><input type="radio" name="RESULT_RadioButton-24" class="multiple_choice" id="RESULT_RadioButton-24_0" value="Radio-0" <?php if((isset($_SESSION['data1']['ship_type']) AND $_SESSION['data1']['ship_type']=='Door to Door') OR (isset($_POST['RESULT_RadioButton-24']) AND $_POST['RESULT_RadioButton-24']=='Radio-0')) echo " checked='checked'"; ?>/><label for="RESULT_RadioButton-24_0" >Door to door</label></td>
				</tr>
				<tr>
					<td><input type="radio" name="RESULT_RadioButton-24" class="multiple_choice" id="RESULT_RadioButton-24_1" value="Radio-1" <?php if((isset($_SESSION['data1']['ship_type']) AND $_SESSION['data1']['ship_type']=='Door to Port') OR (isset($_POST['RESULT_RadioButton-24']) AND $_POST['RESULT_RadioButton-24']=='Radio-1')) echo " checked='checked'"; ?>/><label for="RESULT_RadioButton-24_1" >Door to port</label></td>
				</tr>
				<tr>
					<td><input type="radio" name="RESULT_RadioButton-24" class="multiple_choice" id="RESULT_RadioButton-24_2" value="Radio-2" <?php if((isset($_SESSION['data1']['ship_type']) AND $_SESSION['data1']['ship_type']=='Port to Port') OR (isset($_POST['RESULT_RadioButton-24']) AND $_POST['RESULT_RadioButton-24']=='Radio-2')) echo " checked='checked'"; ?>/><label for="RESULT_RadioButton-24_2" >Port to port</label></td>
				</tr>
				<tr>
					<td><input type="radio" name="RESULT_RadioButton-24" class="multiple_choice" id="RESULT_RadioButton-24_3" value="Radio-3" <?php if((isset($_SESSION['data1']['ship_type']) AND $_SESSION['data1']['ship_type']=='Port to Door') OR (isset($_POST['RESULT_RadioButton-24']) AND $_POST['RESULT_RadioButton-24']=='Radio-3')) echo " checked='checked'"; ?>/><label for="RESULT_RadioButton-24_3" >Port to door</label></td>
				</tr>
			</table>
		</div>

		<div class="clear"></div>

		<div id="q88" class="q required">
			<a class="item_anchor" name="ItemAnchor25"></a>
			<span class="question top_question">Air freight delivery:&nbsp;<span class="icon">&nbsp;</span></span>
			<table class="inline_grid">
				<tr>
					<td><input type="radio" name="RESULT_RadioButton-25" class="multiple_choice" id="RESULT_RadioButton-25_0" value="Radio-0" <?php if((isset($_SESSION['data1']['ship_type']) AND $_SESSION['data1']['ship_type']=='Door to Door') OR (isset($_POST['RESULT_RadioButton-25']) AND $_POST['RESULT_RadioButton-25']=='Radio-0')) echo " checked='checked'"; ?>/><label for="RESULT_RadioButton-25_0" >Door to door</label></td>
				</tr>
				<tr>
					<td><input type="radio" name="RESULT_RadioButton-25" class="multiple_choice" id="RESULT_RadioButton-25_1" value="Radio-1" <?php if((isset($_SESSION['data1']['ship_type']) AND $_SESSION['data1']['ship_type']=='Door to Airport') OR (isset($_POST['RESULT_RadioButton-25']) AND $_POST['RESULT_RadioButton-25']=='Radio-1')) echo " checked='checked'"; ?>/><label for="RESULT_RadioButton-25_1" >Door to airport</label></td>
				</tr>
				<tr>
					<td><input type="radio" name="RESULT_RadioButton-25" class="multiple_choice" id="RESULT_RadioButton-25_2" value="Radio-2" <?php if((isset($_SESSION['data1']['ship_type']) AND $_SESSION['data1']['ship_type']=='Airport to Airport') OR (isset($_POST['RESULT_RadioButton-25']) AND $_POST['RESULT_RadioButton-25']=='Radio-2')) echo " checked='checked'"; ?>/><label for="RESULT_RadioButton-25_2" >Airport to airport</label></td>
				</tr>
			</table>
			<label class="question top_question" for="RESULT_RadioButton-255"><span class="question top_question">Terms:&nbsp;<span class="icon">&nbsp;</span></span></label>
			<table class="inline_grid">
				<tr>
					<td>
						<select id="RESULT_RadioButton-255" name="RESULT_RadioButton-255" class="drop_down" onChange="check(this);">
							<option></option>
							<option value="Radio-0"<?php if((isset($_SESSION['data1']['terms']) AND $_SESSION['data1']['terms']=='EX-Work') OR (isset($_POST['RESULT_RadioButton-255']) AND $_POST['RESULT_RadioButton-255']=='Radio-0')) echo " selected='selected'"; ?>>Ex-Work</option>
							<option value="Radio-1"<?php if((isset($_SESSION['data1']['terms']) AND $_SESSION['data1']['terms']=='FOB') OR (isset($_POST['RESULT_RadioButton-255']) AND $_POST['RESULT_RadioButton-255']=='Radio-1')) echo " selected='selected'"; ?>>FOB</option>
							<option value="Radio-2">Other</option>
						</select>
						
						<input type="text" name="RESULT_TextField-255_0" class="text_field" id="RESULT_TextField-255_0" value="<?php if(isset($_SESSION['data1']['terms']) AND $_SESSION['data1']['terms']!='') echo $_SESSION['data1']['terms']; elseif(isset($_POST['RESULT_TextField-255_0']) AND $_POST['RESULT_TextField-255_0']!='') echo $_POST['RESULT_TextField-255_0']; ?>" <?php if((isset($_SESSION['data1']['terms']) AND $_SESSION['data1']['terms']!='') or(isset($_POST['RESULT_TextField-255_0']) AND $_POST['RESULT_TextField-255_0']!='')) echo "style='display:block;'"; else echo "style='display:none;'"; ?>/>
					</td>
				</tr>
			</table>
		</div>

		<div class="clear"></div>

		<div id="q89" class="q required">
			<a class="item_anchor" name="ItemAnchor27"></a>
			<span class="question top_question">Land shipping:&nbsp;<span class="icon">&nbsp;</span></span>
			<table class="inline_grid">
				<tr>
					<td><input type="radio" name="RESULT_RadioButton-27" class="multiple_choice" id="RESULT_RadioButton-27_0" value="Radio-0" <?php if((isset($_SESSION['data1']['ship_container']) AND $_SESSION['data1']['ship_container']=='FTL') OR (isset($_POST['RESULT_RadioButton-27']) AND $_POST['RESULT_RadioButton-27']=='Radio-0')) echo " checked='checked'"; ?>/><label for="RESULT_RadioButton-27_0" >FTL (Full Truck Load)</label></td>
				</tr>
				<tr>
					<td><input type="radio" name="RESULT_RadioButton-27" class="multiple_choice" id="RESULT_RadioButton-27_1" value="Radio-1" <?php if((isset($_SESSION['data1']['ship_container']) AND $_SESSION['data1']['ship_container']=='LTL') OR (isset($_POST['RESULT_RadioButton-27']) AND $_POST['RESULT_RadioButton-27']=='Radio-1')) echo " checked='checked'"; ?>/><label for="RESULT_RadioButton-27_1" >LTL (Less than Truck Load)</label></td>
				</tr>
				<tr>
					<td><input type="radio" name="RESULT_RadioButton-27" class="multiple_choice" id="RESULT_RadioButton-27_2" value="Radio-2" <?php if((isset($_SESSION['data1']['ship_container']) AND $_SESSION['data1']['ship_container']=='Not Sure') OR (isset($_POST['RESULT_RadioButton-27']) AND $_POST['RESULT_RadioButton-27']=='Radio-2')) echo " checked='checked'"; ?>/><label for="RESULT_RadioButton-27_2" >Not sure</label></td>
				</tr>
			</table>
		</div>

		<div class="clear"></div>

		<div id="q90" class="q required">
			<a class="item_anchor" name="ItemAnchor28"></a>
			<label class="question top_question" for="RESULT_TextField-28">Collection postcode & town:&nbsp;<span class="icon">&nbsp;</span></label>
			<input type="text" name="RESULT_TextField-28" class="text_field" id="RESULT_TextField-28"  size="25" maxlength="255" value="<?php if(isset($_SESSION['data1']['from']) AND $_SESSION['data1']['from']!=''){ echo $_SESSION['data1']['from']; }elseif(isset($_POST['RESULT_TextField-28']) AND $_POST['RESULT_TextField-28']!=''){ echo $_POST['RESULT_TextField-28']; } ?>" />
		</div>

		<div class="clear"></div>

		<div id="q92" class="q required">
			<a class="item_anchor" name="ItemAnchor29"></a>
			<label class="question top_question" for="RESULT_TextField-29">Collection port:&nbsp;<span class="icon">&nbsp;</span></label>
			<input type="text" name="RESULT_TextField-29" class="text_field" id="RESULT_TextField-29"  size="25" maxlength="255" value="<?php if(isset($_SESSION['data1']['from']) AND $_SESSION['data1']['from']!=''){ echo $_SESSION['data1']['from']; }elseif(isset($_POST['RESULT_TextField-29']) AND $_POST['RESULT_TextField-29']!=''){ echo $_POST['RESULT_TextField-29']; } ?>" />
		</div>

		<div class="clear"></div>

		<div id="q93" class="q required">
			<a class="item_anchor" name="ItemAnchor30"></a>
			<label class="question top_question" for="RESULT_TextField-30">Delivery port:&nbsp;<span class="icon">&nbsp;</span></label>
			<input type="text" name="RESULT_TextField-30" class="text_field" id="RESULT_TextField-30"  size="25" maxlength="255" value="<?php if(isset($_SESSION['data1']['to']) AND $_SESSION['data1']['to']!=''){ echo $_SESSION['data1']['to']; }elseif(isset($_POST['RESULT_TextField-30']) AND $_POST['RESULT_TextField-30']!=''){ echo $_POST['RESULT_TextField-30']; } ?>" />
		</div>

		<div class="clear"></div>

		<div id="q94" class="q required">
			<a class="item_anchor" name="ItemAnchor31"></a>
			<label class="question top_question" for="RESULT_TextField-31">Collection Airport:&nbsp;<span class="icon">&nbsp;</span></label>
			<input type="text" name="RESULT_TextField-31" class="text_field" id="RESULT_TextField-31"  size="25" maxlength="255" value="<?php if(isset($_SESSION['data1']['from']) AND $_SESSION['data1']['from']!=''){ echo $_SESSION['data1']['from']; }elseif(isset($_POST['RESULT_TextField-31']) AND $_POST['RESULT_TextField-31']!=''){ echo $_POST['RESULT_TextField-31']; } ?>" />
		</div>

		<div class="clear"></div>

		<div id="q95" class="q required">
			<a class="item_anchor" name="ItemAnchor32"></a>
			<label class="question top_question" for="RESULT_TextField-32">Delivery Airport:&nbsp;<span class="icon">&nbsp;</span></label>
			<input type="text" name="RESULT_TextField-32" class="text_field" id="RESULT_TextField-32"  size="25" maxlength="255" value="<?php if(isset($_SESSION['data1']['to']) AND $_SESSION['data1']['to']!=''){ echo $_SESSION['data1']['to']; }elseif(isset($_POST['RESULT_TextField-32']) AND $_POST['RESULT_TextField-32']!=''){ echo $_POST['RESULT_TextField-32']; } ?>" />
		</div>

		<div class="clear"></div>

		<div id="q91" class="q required">
			<a class="item_anchor" name="ItemAnchor33"></a>
			<label class="question top_question" for="RESULT_TextField-33">Delivery postcode & town:&nbsp;<span class="icon">&nbsp;</span></label>
			<input type="text" name="RESULT_TextField-33" class="text_field" id="RESULT_TextField-33"  size="25" maxlength="255" value="<?php if(isset($_SESSION['data1']['to']) AND $_SESSION['data1']['to']!=''){ echo $_SESSION['data1']['to']; }elseif(isset($_POST['RESULT_TextField-33']) AND $_POST['RESULT_TextField-33']!=''){ echo $_POST['RESULT_TextField-33']; } ?>" />
		</div>

		<div class="clear"></div>

		<div id="q99" class="q full_width">
			<a class="item_anchor" name="ItemAnchor34"></a>
			<br/>
		</div>
		<div class="clear"></div>

		</div>
		<!-- END_ITEMS -->
		<script type="text/javascript">var itemRules={106:{"criteria":[{"item":17,"answer":"0","operator":"=="}],"action":"show","join":"||"},110:{"criteria":[{"item":17,"answer":"1","operator":"=="}],"action":"show","join":"||"},82:{"criteria":[{"item":17,"answer":"1","operator":"=="}],"action":"show","join":"||"},86:{"criteria":[{"item":82,"answer":"0","operator":"=="}],"action":"show","join":"||"},83:{"criteria":[{"item":82,"answer":"0","operator":"=="}],"action":"show","join":"||"},87:{"criteria":[{"item":17,"answer":"1","operator":"=="}],"action":"show","join":"||"},88:{"criteria":[{"item":17,"answer":"0","operator":"=="}],"action":"show","join":"||"},89:{"criteria":[{"item":17,"answer":"2","operator":"=="}],"action":"show","join":"||"},90:{"criteria":[{"item":17,"answer":"3","operator":"=="},{"item":17,"answer":"2","operator":"=="},{"item":87,"answer":"0","operator":"=="},{"item":87,"answer":"1","operator":"=="},{"item":88,"answer":"0","operator":"=="},{"item":88,"answer":"1","operator":"=="},{"item":89,"answer":"2","operator":"=="}],"action":"show","join":"||"},92:{"criteria":[{"item":87,"answer":"2","operator":"=="},{"item":87,"answer":"3","operator":"=="}],"action":"show","join":"||"},93:{"criteria":[{"item":87,"answer":"2","operator":"=="},{"item":87,"answer":"1","operator":"=="}],"action":"show","join":"||"},94:{"criteria":[{"item":88,"answer":"2","operator":"=="}],"action":"show","join":"||"},95:{"criteria":[{"item":88,"answer":"1","operator":"=="},{"item":88,"answer":"2","operator":"=="}],"action":"show","join":"||"},91:{"criteria":[{"item":17,"answer":"3","operator":"=="},{"item":17,"answer":"2","operator":"=="},{"item":87,"answer":"0","operator":"=="},{"item":88,"answer":"0","operator":"=="},{"item":89,"answer":"2","operator":"=="},{"item":87,"answer":"3","operator":"=="}],"action":"show","join":"||"}};</script>
		<input type="hidden" name="EParam" value="x8J1JeDzqXYCl9FCyTe7bMc/zazo1YAB" />
		<input type="hidden" id="EmbeddedForm" name="EmbeddedForm" value="EmbeddedForm" />
		<input type="hidden" id="EmbedId" name="EmbedId" value="1332349481" />
		<input type="hidden" id="HostUrl" name="HostUrl" value="" />
		<div class="outside_container">
			<div class="buttons_reverse">
				<input type="submit" name="Submit" value="Next &gt;" class="submit_button" id="FSsubmit" />
				<input type="submit" name="PreviousSubmit" value="&lt; Previous" class="submit_button" id="FSpreviousSubmit" />
			</div>
		</div>
	</form>
	<?php
	}
	elseif($shown_type==2){
		//print_r($_SESSION);
	?>
	<form method="post" id="FSForm" action="form.php" enctype="application/x-www-form-urlencoded" onsubmit="return Vromansys.Form.processSubmit(this);">
		<div style="display:none;">
			<input type="hidden" name="pt" value="3">
			<input type="hidden" name="locid" value="janetravis/form3">
			<input type="hidden" name="EParam" value="AT1kKIiyxDyY+5pZv75zR4njqh0+izcTTBvqp3+bSzyXZa0SjkwcoP7xTxCbyOAX9UeyITkhRROjPE1dbu+f58bUG5tNtAHhbeuuzzGUf94rmgwdQ7EnLw==">
			<input type="hidden" name="ElapsedTime" id="ElapsedTime" value="8638947">
			<input type="hidden" name="Referrer" id="Referrer" value="http://www.bookingparcel.com/">
			<input type="text" name="subject_line" id="subject_line" autocomplete="off"><label for="subject_line">subject_line</label>
		</div>

		<div class="outside_container"><div class="progressBarWrapper"><div class="progressBarBack" style=" width:50%; "><div class="progressBarText">50%&nbsp;Complete</div></div><div class="progressBarFront"><div class="progressBarText">50%&nbsp;Complete</div></div></div></div>

			<?php
			if($error){
				echo '<div class="form_table invalid" style="margin-bottom:10px"><div class="invalid_message" style="border:none;font-size:1em;padding:6px;text-align:center;">Please review the form and correct the highlighted items.</div></div>';
			}
			
			?>
		<!-- BEGIN_ITEMS -->
		<div class="form_table">

		<div class="clear"></div>

		<div id="q108" class="q full_width">
		<a class="item_anchor" name="ItemAnchor36"></a>
		<div class="segment_header" style="width:auto;text-align:Center;">
		<h1 style="font-size:18px;padding:20px 1em ;"></h1><h1>Your items</h1></div>
		</div>

		<div class="clear"></div>
<?php 
if(!(isset($_SESSION['data1']['ship_container_s']) AND $_SESSION['data1']['ship_container_s']!='' AND $_SESSION['data1']['ship_container_s']!=null)){ ?>
		<div id="q112" class="q required">
		<a class="item_anchor" name="ItemAnchor37"></a>
		<label class="question top_question" for="RESULT_TextField-37">Number of items:&nbsp;<span class="icon">&nbsp;</span></label>
		<input type="text" name="RESULT_TextField-37" class="text_field" id="RESULT_TextField-37" size="5" maxlength="255" value="<?php if(isset($_SESSION['data2']['n_item']) AND $_SESSION['data2']['n_item']!=''){ echo $_SESSION['data2']['n_item']; }elseif(isset($_POST['RESULT_TextField-37']) AND $_POST['RESULT_TextField-37']!='' AND is_numeric($_POST['RESULT_TextField-37']) AND $_POST['RESULT_TextField-37']>0){ echo $_POST['RESULT_TextField-37']; } ?>">
		</div>
		<div id="q30" class="q">
			<a class="item_anchor" name="ItemAnchor38"></a>
			<span class="question top_question"><span style="font-size: small;"><span style="font-size: small;"><span style="font-size: small;">Dimension LxWxH cm</span><span style="font-size: small;"><span style="font-size: x-small;"> (Approx.)</span></span></span></span><span class="icon">&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;</span><span style="font-size: small;"><span style="font-size: small;"><span style="font-size: small;">Weight Kg</span><span style="font-size: small;"><span style="font-size: x-small;"> (Approx.)</span></span></span></span><span class="icon">&nbsp;</span></span>
			<table class="text_list">
			<tbody>
<?php //echo $_SESSION['data2']['dims']."<br>"; 
if(isset($_SESSION['data2']['dims'])/* AND $_SESSION['data2']['dims']!=''*/){
	$temp_ar = explode(" kg | ",$_SESSION['data2']['dims']);
	$arr = array();
	foreach($temp_ar as $k=>$v){
		if($v!=''){
			$tmp = explode(" => ",$v);
			$ttmp = explode(") ",$tmp[0]);
			$tt = array($ttmp[1],$tmp[1]);
			$arr[]= $tt;
			unset($tmp);
			unset($ttmp);
			unset($tt);
		}
	}
}

if(isset($_POST['RESULT_MatrixTextField-38-0']) AND $_POST['RESULT_MatrixTextField-38-0']!=''){
	for($i=0;$i<10;$i++){
		$arr = array();
		if(isset($_POST['RESULT_MatrixTextField-38-'.$i]) AND $_POST['RESULT_MatrixTextField-38-'.$i]!=''){
			if(isset($_POST['RESULT_MatrixTextField_weight-38-'.$i]) AND $_POST['RESULT_MatrixTextField_weight-38-'.$i]!=''){
				$tt = array($_POST['RESULT_MatrixTextField-38-'.$i],$_POST['RESULT_MatrixTextField_weight-38-'.$i]);
				$arr[]= $tt;
				unset($tt);
			}
		}
	}
}
$_c = 0;
if(isset($arr) AND is_array($arr)){
	foreach($arr as $k=>$v){
		$col = (($_c%2==0) ? "light" : "dark");
		?>
		<tr class="matrix_row_<?php echo $col ?>">
			<td><input type="text" name="RESULT_MatrixTextField-38-<?php echo $_c ?>" class="text_field" size="25" maxlength="25" value="<?php echo $v[0] ?>"></td>
			<td><input type="text" name="RESULT_MatrixTextField_weight-38-<?php echo $_c ?>" class="text_field" size="4" maxlength="25" value="<?php echo $v[1] ?>"></td>
			<td><img class="svg add" height="16" src="images/icons/formIcons/add.svg"> 
				<img class="gif add" height="16" src="images/icons/fam/add.png">
				<img class="svg del" height="16" src="images/icons/formIcons/delete.svg"> 
				<img class="gif del" height="16" src="images/icons/fam/delete.png">
			</td>
		</tr>
		<?php
		$_c++;
	}
}
$col = (($_c%2==0) ? "light" : "dark");
?>
			<tr class="matrix_row_<?php echo $col ?>">
				<td><input type="text" name="RESULT_MatrixTextField-38-<?php echo $_c ?>" class="text_field" size="25" maxlength="25" value=""></td>
				<td><input type="text" name="RESULT_MatrixTextField_weight-38-<?php echo $_c ?>" class="text_field" size="4" maxlength="25" value=""></td>
				<td><img class="svg add" height="16" src="images/icons/formIcons/add.svg"> 
					<img class="gif add" height="16" src="images/icons/fam/add.png">
					<img class="svg del" height="16" src="images/icons/formIcons/delete.svg"> 
					<img class="gif del" height="16" src="images/icons/fam/delete.png">
				</td>
			</tr>
			</tbody></table>
			<input type="hidden" name="MaxAnswers" value="15">
		</div>

		<div class="clear"></div>

		<div id="q58" class="q full_width">
		<a class="item_anchor" name="ItemAnchor39"></a>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(click on "+" to add more lines)
		</div>

		<div class="clear"></div>
<?php } ?>
		<div id="q79" class="q">
		<a class="item_anchor" name="ItemAnchor40"></a>
		<label class="question top_question" for="RESULT_TextField-40">Total weight in kg <span style="font-size: x-small;">(Approx.)</span><span class="icon">&nbsp;</span></label>
		<input type="text" name="RESULT_TextField-40" class="text_field" id="RESULT_TextField-40" size="5" maxlength="255" value="<?php if(isset($_SESSION['data2']['t_weight']) AND $_SESSION['data2']['t_weight']!=''){ echo $_SESSION['data2']['t_weight']; }elseif(isset($_POST['RESULT_TextField-40']) AND $_POST['RESULT_TextField-40']!='' AND is_numeric($_POST['RESULT_TextField-40']) AND $_POST['RESULT_TextField-40']>0){ echo $_POST['RESULT_TextField-40']; } ?>">
		</div>

		<div class="clear"></div>
		
		<div id="q79" class="q">
		<a class="item_anchor" name="ItemAnchor40"></a>
		
		<span class="question top_question">Are the boxes/Pallets stackable ?&nbsp;<span class="icon">&nbsp;</span></span>
		<table class="inline_grid">
		<tbody><tr>
		<td><input type="radio" name="RESULT_RadioButton-428" class="multiple_choice" id="RESULT_RadioButton-428_0" value="Radio-0" <?php if((isset($_SESSION['data2']['stackable']) AND $_SESSION['data2']['stackable']=='Yes') OR (isset($_POST['RESULT_RadioButton-428']) AND $_POST['RESULT_RadioButton-428']=='Radio-0')) echo " checked='checked'"; ?>><label for="RESULT_RadioButton-428_0">Yes</label></td>
		</tr>
		<tr>
		<td><input type="radio" name="RESULT_RadioButton-428" class="multiple_choice" id="RESULT_RadioButton-428_1" value="Radio-1"<?php if((isset($_SESSION['data2']['stackable']) AND $_SESSION['data2']['stackable']=='No') OR (isset($_POST['RESULT_RadioButton-428']) AND $_POST['RESULT_RadioButton-428']=='Radio-1')) echo " checked='checked'"; ?>><label for="RESULT_RadioButton-428_1">No</label></td>
		</tr>
		</tbody></table>
		</div>

		<div class="clear"></div>

		<div id="q107" class="q required">
		<a class="item_anchor" name="ItemAnchor41"></a>
		<span class="question top_question">Do you need shipping insurance?&nbsp;<span class="icon">&nbsp;</span></span>
		<table class="inline_grid">
		<tbody><tr>
		<td><input type="radio" name="RESULT_RadioButton-41" class="multiple_choice" id="RESULT_RadioButton-41_0" value="Radio-0" <?php if((isset($_SESSION['data2']['insurance']) AND $_SESSION['data2']['insurance']=='Yes') OR (isset($_POST['RESULT_RadioButton-41']) AND $_POST['RESULT_RadioButton-41']=='Radio-0')) echo " checked='checked'"; ?>><label for="RESULT_RadioButton-41_0">Yes</label></td>
		</tr>
		<tr>
		<td><input type="radio" name="RESULT_RadioButton-41" class="multiple_choice" id="RESULT_RadioButton-41_1" value="Radio-1"<?php if((isset($_SESSION['data2']['insurance']) AND $_SESSION['data2']['insurance']=='No') OR (isset($_POST['RESULT_RadioButton-41']) AND $_POST['RESULT_RadioButton-41']=='Radio-1')) echo " checked='checked'"; ?>><label for="RESULT_RadioButton-41_1">No</label></td>
		</tr>
		<tr>
		<td><input type="radio" name="RESULT_RadioButton-41" class="multiple_choice" id="RESULT_RadioButton-41_2" value="Radio-2"<?php if((isset($_SESSION['data2']['insurance']) AND $_SESSION['data2']['insurance']=='Not Sure') OR (isset($_POST['RESULT_RadioButton-41']) AND $_POST['RESULT_RadioButton-41']=='Radio-2')) echo " checked='checked'"; ?>><label for="RESULT_RadioButton-41_2">Not sure</label></td>
		</tr>
		</tbody></table>
		</div>

		<div class="clear"></div>

		<div id="q74" class="q required">
		<a class="item_anchor" name="ItemAnchor42"></a>
		<label class="question top_question" for="RESULT_TextArea-42">Shipment description and commodity name:&nbsp;<span class="icon">&nbsp;</span></label>
		<textarea name="RESULT_TextArea-42" class="text_field" id="RESULT_TextArea-42" rows="6" cols="21"><?php if(isset($_SESSION['data2']['desc']) AND $_SESSION['data2']['desc']!=''){ echo $_SESSION['data2']['desc']; }elseif(isset($_POST['RESULT_TextArea-42']) AND $_POST['RESULT_TextArea-42']!=''){ echo $_POST['RESULT_TextArea-42']; } ?></textarea>
		</div>

		<div class="clear"></div>
		<div id="q741" class="q required">
			<a class="item_anchor" name="ItemAnchor421"></a>
			<span class="question top_question">Is there any lithium battery in your cargo?&nbsp;<span class="icon">&nbsp;</span></span>
			
			<table class="inline_grid">
				<tr>
					<td><input type="radio" name="RESULT_RadioButton-421" class="multiple_choice" id="RESULT_RadioButton-421_0" value="Yes" <?php if((isset($_SESSION['data2']['lithium_bat']) AND $_SESSION['data2']['lithium_bat']=='Yes') OR (isset($_POST['RESULT_RadioButton-421']) AND $_POST['RESULT_RadioButton-421']=='Yes')) echo " checked='checked'"; ?>/><label for="RESULT_RadioButton-421_0" >Yes</label></td>
				</tr>
				<tr>
					<td><input type="radio" name="RESULT_RadioButton-421" class="multiple_choice" id="RESULT_RadioButton-421_1" value="No" <?php if((isset($_SESSION['data2']['lithium_bat']) AND $_SESSION['data2']['lithium_bat']=='No') OR (isset($_POST['RESULT_RadioButton-421']) AND $_POST['RESULT_RadioButton-421']=='No')) echo " checked='checked'"; ?>/><label for="RESULT_RadioButton-421_1" >No</label></td>
				</tr>
			</table>
		</div>

		<div class="clear"></div>
		<div id="q743" class="q required">
			<a class="item_anchor" name="ItemAnchor423"></a>
			<span class="question top_question">Is there any liquid, gas or chemicals inside of your cargo?&nbsp;<span class="icon">&nbsp;</span></span>
			
			<table class="inline_grid">
				<tr>
					<td><input type="radio" name="RESULT_RadioButton-423" class="multiple_choice" id="RESULT_RadioButton-423_0" value="Yes" <?php if((isset($_SESSION['data2']['chemical']) AND $_SESSION['data2']['chemical']=='Yes') OR (isset($_POST['RESULT_RadioButton-423']) AND $_POST['RESULT_RadioButton-423']=='Yes')) echo " checked='checked'"; ?>/><label for="RESULT_RadioButton-423_0" >Yes</label></td>
				</tr>
				<tr>
					<td><input type="radio" name="RESULT_RadioButton-423" class="multiple_choice" id="RESULT_RadioButton-423_1" value="No" <?php if((isset($_SESSION['data2']['chemical']) AND $_SESSION['data2']['chemical']=='No') OR (isset($_POST['RESULT_RadioButton-423']) AND $_POST['RESULT_RadioButton-423']=='No')) echo " checked='checked'"; ?>/><label for="RESULT_RadioButton-423_1" >No</label></td>
				</tr>
			</table>
		</div>

		<div class="clear"></div>
		<div id="q742" class="q required">
			<a class="item_anchor" name="ItemAnchor422"></a>
			<span class="question top_question">Is it your cargo DG (Dangerous Goods)?&nbsp;<span class="icon">&nbsp;</span></span>
			
			<table class="inline_grid">
				<tr>
					<td><input onClick="check2(this);" type="radio" name="RESULT_RadioButton-422" class="multiple_choice" id="RESULT_RadioButton-422_0" value="Yes" <?php if((isset($_SESSION['data2']['dg']) AND $_SESSION['data2']['dg']=='Yes') OR (isset($_POST['RESULT_RadioButton-422']) AND $_POST['RESULT_RadioButton-422']=='Yes')) echo " checked='checked'"; ?>/><label for="RESULT_RadioButton-422_0" >Yes</label></td>
				</tr>
				<tr>
					<td><input onClick="check2(this);" type="radio" name="RESULT_RadioButton-422" class="multiple_choice" id="RESULT_RadioButton-422_1" value="No" <?php if((isset($_SESSION['data2']['dg']) AND $_SESSION['data2']['dg']=='No') OR (isset($_POST['RESULT_RadioButton-422']) AND $_POST['RESULT_RadioButton-422']=='No')) echo " checked='checked'"; ?>/><label for="RESULT_RadioButton-422_1" >No</label></td>
				</tr>
			</table>
			<div id="dgr_dv" style="<?php if((isset($_SESSION['data2']['dg']) AND $_SESSION['data2']['dg']=='Yes') OR (isset($_POST['RESULT_RadioButton-422']) AND $_POST['RESULT_RadioButton-422']=='Yes')) echo "display:block;"; else echo "display:none;";  ?>">
				<span class="question top_question">Aircraft Type :&nbsp;</span>
				
				<table class="inline_grid">
					<tr>
						<td>
							<select id="RESULT_RadioButton-424" name="RESULT_RadioButton-424" class="drop_down">
								<option></option>
								<option value="Radio-0"<?php if((isset($_SESSION['data2']['terms']) AND $_SESSION['data2']['terms']=='PAX') OR (isset($_POST['RESULT_RadioButton-424']) AND $_POST['RESULT_RadioButton-424']=='Radio-0')) echo " selected='selected'"; ?>>PAX</option>
								<option value="Radio-1"<?php if((isset($_SESSION['data2']['terms']) AND $_SESSION['data2']['terms']=='CAO') OR (isset($_POST['RESULT_RadioButton-424']) AND $_POST['RESULT_RadioButton-424']=='Radio-1')) echo " selected='selected'"; ?>>CAO</option>
								<option value="Radio-2"<?php if((isset($_SESSION['data2']['terms']) AND $_SESSION['data2']['terms']=='Not Sure') OR (isset($_POST['RESULT_RadioButton-424']) AND $_POST['RESULT_RadioButton-424']=='Radio-2')) echo " selected='selected'"; ?>>Not Sure</option>
							</select>
						</td>
					</tr>
				</table>
				
				<label class="question top_question" for="RESULT_TextField-425">UN Number & Classification :&nbsp;<span class="icon">&nbsp;</span></label>
				<input type="text" name="RESULT_TextField-425" placeholder="UN number" class="text_field" id="RESULT_TextField-425" size="10" maxlength="255" value="<?php if(isset($_POST['RESULT_TextField-425']) AND $_POST['RESULT_TextField-425']!='') echo $_POST['RESULT_TextField-425']; elseif(isset($_SESSION['data2']['un']) AND $_SESSION['data2']['un']!='') echo $_SESSION['data2']['un']; ?>">
				<input type="text" name="RESULT_TextField-426" placeholder="Classification" class="text_field" id="RESULT_TextField-426" size="12" maxlength="255" value="<?php if(isset($_POST['RESULT_TextField-426']) AND $_POST['RESULT_TextField-426']!='') echo $_POST['RESULT_TextField-426']; elseif(isset($_SESSION['data2']['class']) AND $_SESSION['data2']['class']!='') echo $_SESSION['data2']['class']; ?>">

				
				<label class="question top_question" for="RESULT_TextArea-427">Packing Instruction :&nbsp;<span class="icon">&nbsp;</span></label>
				<textarea name="RESULT_TextArea-427" class="text_field" id="RESULT_TextArea-427" rows="6" cols="21"><?php if(isset($_POST['RESULT_TextArea-427']) AND $_POST['RESULT_TextArea-427']!='') echo $_POST['RESULT_TextArea-427']; elseif(isset($_SESSION['data2']['instruction']) AND $_SESSION['data2']['instruction']!='') echo $_SESSION['data2']['instruction']; ?></textarea>
			</div>
		</div>

		<div class="clear"></div>

		<div id="q61" class="q full_width">
		<a class="item_anchor" name="ItemAnchor43"></a>
		&nbsp;
		</div>
		<div class="clear"></div>

		</div>
		<!-- END_ITEMS -->
		<input type="hidden" name="EParam" value="x8J1JeDzqXa10WWcjg3Jz7tOpgu2IeBz">
		<input type="hidden" id="EmbeddedForm" name="EmbeddedForm" value="EmbeddedForm"><input type="hidden" id="EmbedId" name="EmbedId" value="1332349481">
		<input type="hidden" id="HostUrl" name="HostUrl" value="">
		<div class="outside_container">
			<div class="buttons_reverse">
				<input type="submit" name="Submit" value="Next >" class="submit_button" id="FSsubmit">
				<input type="submit" name="PreviousSubmit" value="< Previous" class="submit_button" id="FSpreviousSubmit">
			</div>
		</div>
	</form>
	<?php
	}
	elseif($shown_type==3){
	?>
<form method="post" id="FSForm" action="form.php" enctype="application/x-www-form-urlencoded" onsubmit="return Vromansys.Form.processSubmit(this);">
<div style="display:none;">
<input type="hidden" name="pt" value="4">
<input type="hidden" name="locid" value="janetravis/form3">
<input type="hidden" name="EParam" value="AT1kKIiyxDyY+5pZv75zR4njqh0+izcTTBvqp3+bSzyXZa0SjkwcoP7xTxCbyOAX0MzAv/h+S2ajPE1dbu+f58bUG5tNtAHhbeuuzzGUf95t45FVaTXGyiuaDB1DsScv">
<input type="hidden" name="ElapsedTime" id="ElapsedTime" value="32601175">
<input type="hidden" name="Referrer" id="Referrer" value="http://www.bookingparcel.com/">
<input type="text" name="subject_line" id="subject_line" autocomplete="off"><label for="subject_line">subject_line</label>
</div>

<div class="outside_container"><div class="progressBarWrapper"><div class="progressBarBack" style=" width:75%; "><div class="progressBarText">75%&nbsp;Complete</div></div><div class="progressBarFront"><div class="progressBarText">75%&nbsp;Complete</div></div></div></div>

			<?php
			if($error){
				echo '<div class="form_table invalid" style="margin-bottom:10px"><div class="invalid_message" style="border:none;font-size:1em;padding:6px;text-align:center;">Please review the form and correct the highlighted items.</div></div>';
			}
			if((isset($_SESSION['error_user']) AND $_SESSION['error_user']!=""))
			{
				echo '<div class="form_table invalid" style="margin-bottom:10px"><div class="invalid_message" style="border:none;font-size:1em;padding:6px;text-align:center;">'.$_SESSION['error_user'].'</div></div>';
				unset($_SESSION['error_user']);
			}
			
			?>
<!-- BEGIN_ITEMS -->
<div class="form_table">

<div class="clear"></div>

<div id="q55" class="q full_width">
<a class="item_anchor" name="ItemAnchor45"></a>
<div class="segment_header" style="width:auto;text-align:Center;"><h1 style="font-size:18px;padding:20px 1em ;"></h1><h1>Contact details</h1></div>
</div>

<div class="clear"></div>

<div id="q105" class="q full_width">
<a class="item_anchor" name="ItemAnchor46"></a>
<p style="padding:0 30px;"><b>NOTE:</b><br>The following contact details are for pricing only, and wont be used for shipping documents.</p>
</div>

<div class="clear"></div>


<div id="choose_user_nouser">
	<div style="padding:0px 30px;">
		<input type="radio" name="have_acc" value="yes" id="ihave" onClick="user_part('yes');"><label for="ihave">I have account in <a href="http://cp.bookingparcel.com">User Panel</a> .</label>
	</div>
	<div style="padding:0px 30px;">
		<input type="radio" name="have_acc" value="no" id="ihavenot" onClick="user_part('no');"><label for="ihavenot">I don't have account in <a href="http://cp.bookingparcel.com">User Panel</a> .</label>
	</div>
</div>
<div class="clear"></div>
<div id="moreinfo">
	<div style="padding:0px 30px;">
		Note: having account in <a href="http://cp.bookingparcel.com">User Panel</a> gives you some options such as ticketing and easily tracking and some more.<br>
		It is not necessary to have account but it is highly recommended.
	</div>
</div>
<div class="clear"></div>

<div id="info" style="display:none;">
<div id="q101" class="q required">
<a class="item_anchor" name="ItemAnchor47"></a>
<span class="question top_question">Preferred method of contact:&nbsp;<span class="icon">&nbsp;</span></span>
<table class="inline_grid">
<tbody><tr>
<td><input type="radio" name="RESULT_RadioButton-47" class="multiple_choice" id="RESULT_RadioButton-47_0" value="Radio-0" <?php if(isset($_POST['RESULT_RadioButton-47']) AND $_POST['RESULT_RadioButton-47']=="Radio-0") echo " checked='checked'"; ?>><label for="RESULT_RadioButton-47_0">Phone</label></td>
</tr>
<tr>
<td><input type="radio" name="RESULT_RadioButton-47" class="multiple_choice" id="RESULT_RadioButton-47_1" value="Radio-1"<?php if(isset($_POST['RESULT_RadioButton-47']) AND $_POST['RESULT_RadioButton-47']=="Radio-1") echo " checked='checked'"; ?>><label for="RESULT_RadioButton-47_1">Email</label></td>
</tr>
<tr>
<td><input type="radio" name="RESULT_RadioButton-47" class="multiple_choice" id="RESULT_RadioButton-47_2" value="Radio-2"<?php if(isset($_POST['RESULT_RadioButton-47']) AND $_POST['RESULT_RadioButton-47']=="Radio-2") echo " checked='checked'"; ?>><label for="RESULT_RadioButton-47_2">Any of the above</label></td>
</tr>
</tbody></table>
</div>

<div class="clear"></div>

<div id="q102" class="q required x-hidden">
<a class="item_anchor" name="ItemAnchor48"></a>
<span class="question top_question">Preferred time of contact:&nbsp;<span class="icon">&nbsp;</span></span>
<table class="inline_grid">
<tbody><tr>
<td><input type="radio" name="RESULT_RadioButton-48" class="multiple_choice" id="RESULT_RadioButton-48_0" value="Radio-0"<?php if(isset($_POST['RESULT_RadioButton-48']) AND $_POST['RESULT_RadioButton-48']=="Radio-0") echo " checked='checked'"; ?>><label for="RESULT_RadioButton-48_0">Anytime</label></td>
</tr>
<tr>
<td><input type="radio" name="RESULT_RadioButton-48" class="multiple_choice" id="RESULT_RadioButton-48_1" value="Radio-1"<?php if(isset($_POST['RESULT_RadioButton-48']) AND $_POST['RESULT_RadioButton-48']=="Radio-1") echo " checked='checked'"; ?>><label for="RESULT_RadioButton-48_1">In the morning</label></td>
</tr>
<tr>
<td><input type="radio" name="RESULT_RadioButton-48" class="multiple_choice" id="RESULT_RadioButton-48_2" value="Radio-2"<?php if(isset($_POST['RESULT_RadioButton-48']) AND $_POST['RESULT_RadioButton-48']=="Radio-2") echo " checked='checked'"; ?>><label for="RESULT_RadioButton-48_2">In the afternoon</label></td>
</tr>
<tr>
<td><input type="radio" name="RESULT_RadioButton-48" class="multiple_choice" id="RESULT_RadioButton-48_3" value="Radio-3"<?php if(isset($_POST['RESULT_RadioButton-48']) AND $_POST['RESULT_RadioButton-48']=="Radio-3") echo " checked='checked'"; ?>><label for="RESULT_RadioButton-48_3">In the evening</label></td>
</tr>
</tbody></table>
</div>
</div>

<div class="clear"></div>
<div style="display: none;" id="nouser">
	<div id="q53" class="q required">
	<a class="item_anchor" name="ItemAnchor49"></a>
	<label class="question top_question" for="RESULT_TextField-49">Phone number&nbsp;<span class="icon">&nbsp;</span></label>
	<input type="text" name="RESULT_TextField-49" class="text_field" id="RESULT_TextField-49" size="22" maxlength="255" value="<?php if(isset($_POST['RESULT_TextField-49']) AND $_POST['RESULT_TextField-49']!='') echo $_POST['RESULT_TextField-49']; ?>">
	</div>

	<div class="clear"></div>

	<div id="q54" class="q required">
	<a class="item_anchor" name="ItemAnchor50"></a>
	<label class="question top_question" for="RESULT_TextField-50">Email address&nbsp;<span class="icon">&nbsp;</span></label>
	<input type="email" name="RESULT_TextField-50" class="text_field" id="RESULT_TextField-50" size="30" maxlength="255" value="<?php if(isset($_POST['RESULT_TextField-50']) AND $_POST['RESULT_TextField-50']!='') echo $_POST['RESULT_TextField-50']; ?>">
	</div>

	<div class="clear"></div>


	<div id="q470" class="q ">
	<a class="item_anchor" name="ItemAnchor52"></a>
	<label class="question top_question" for="RESULT_TextField-520">Company Name&nbsp;<span class="icon">&nbsp;</span></label>
	<input type="text" name="RESULT_TextField-520" class="text_field" id="RESULT_TextField-520" size="22" maxlength="255" value="<?php if(isset($_POST['RESULT_TextField-520']) AND $_POST['RESULT_TextField-520']!='') echo $_POST['RESULT_TextField-520']; ?>">
	</div>

	<div class="clear"></div>
	<div id="q46" class="q required">
	<a class="item_anchor" name="ItemAnchor51"></a>
	<label class="question top_question" for="RESULT_TextField-51">Name&nbsp;<span class="icon">&nbsp;</span></label>
	<input type="text" name="RESULT_TextField-51" class="text_field" id="RESULT_TextField-51" size="22" maxlength="255" value="<?php if(isset($_POST['RESULT_TextField-51']) AND $_POST['RESULT_TextField-51']!='') echo $_POST['RESULT_TextField-51']; ?>">
	</div>
</div>
<div style="display: none;" id="user">
	<div id="q5300" class="q required">
	<a class="item_anchor" name="ItemAnchor4900"></a>
	<label class="question top_question" for="RESULT_TextField-4900">UserName&nbsp;<span class="icon">&nbsp;</span></label>
	<input type="text" name="RESULT_TextField-4900" class="text_field" id="RESULT_TextField-4900" size="22" maxlength="255" value="<?php if(isset($_POST['RESULT_TextField-4900']) AND $_POST['RESULT_TextField-4900']!='') echo $_POST['RESULT_TextField-4900']; ?>">
	</div>

	<div class="clear"></div>
	<div id="q5301" class="q required">
	<a class="item_anchor" name="ItemAnchor4901"></a>
	<label class="question top_question" for="RESULT_TextField-4901">PassWord&nbsp;<span class="icon">&nbsp;</span></label>
	<input type="password" name="RESULT_TextField-4901" class="text_field" id="RESULT_TextField-4901" size="22" maxlength="255" value="<?php if(isset($_POST['RESULT_TextField-4901']) AND $_POST['RESULT_TextField-4901']!='') echo $_POST['RESULT_TextField-4901']; ?>">
	</div>

	<div class="clear"></div>
	
</div>
<div class="clear"></div>
	<div id="q54" class="q full_width"> 
		<p style="padding:0 30px;">
			<a class="item_anchor" name="ItemAnchor4907"></a>
			<label class="question top_question" for="RESULT_TextField-4907">email for receive invoice&nbsp;<span class="icon">&nbsp;</span>
				<input type="email" name="RESULT_TextField-4907" class="text_field" id="RESULT_TextField-4907" size="30" maxlength="255" value="<?php if(isset($_POST['RESULT_TextField-4907']) AND $_POST['RESULT_TextField-4907']!='') echo $_POST['RESULT_TextField-4907']; ?>">
			</label>
		</p>
	</div>

	<div class="clear"></div>
	<div id="q54" class="q full_width"> 
		<p style="padding:0 30px;">
			<a class="item_anchor" name="ItemAnchor4908"></a>
			<label class="question top_question" for="RESULT_TextField-4908">email for receive quote&nbsp;<span class="icon">&nbsp;</span>
				<input type="email" name="RESULT_TextField-4908" class="text_field" id="RESULT_TextField-4908" size="30" maxlength="255" value="<?php if(isset($_POST['RESULT_TextField-4908']) AND $_POST['RESULT_TextField-4908']!='') echo $_POST['RESULT_TextField-4908']; ?>">
			</label>
		</p>
	</div>

	<div class="clear"></div>
	<div id="q54" class="q full_width"> 
		<p style="padding:0 30px;">
			<a class="item_anchor" name="ItemAnchor4909"></a>
			<label class="question top_question" for="RESULT_TextField-4909">email for receive prealert&nbsp;<span class="icon">&nbsp;</span>
				<input type="email" name="RESULT_TextField-4909" class="text_field" id="RESULT_TextField-4909" size="30" maxlength="255" value="<?php if(isset($_POST['RESULT_TextField-4909']) AND $_POST['RESULT_TextField-4909']!='') echo $_POST['RESULT_TextField-4909']; ?>">
			</label>
		</p>
	</div>

	<div class="clear"></div>
	<div id="q54" class="q full_width"> 
	<p style="padding:0 30px;">Other CC Email address<br>
	<a class="item_anchor" name="ItemAnchor4902"></a>
	<label class="question top_question" for="RESULT_TextField-4902">(1)&nbsp;<span class="icon">&nbsp;</span>
	<input type="email" name="RESULT_TextField-4902" class="text_field" id="RESULT_TextField-4902" size="30" maxlength="255" value="<?php if(isset($_POST['RESULT_TextField-4902']) AND $_POST['RESULT_TextField-4902']!='') echo $_POST['RESULT_TextField-4902']; ?>">
	</label>
	<a class="item_anchor" name="ItemAnchor4903"></a>
	<label class="question top_question" for="RESULT_TextField-4903">(2)&nbsp;<span class="icon">&nbsp;</span>
	<input type="email" name="RESULT_TextField-4903" class="text_field" id="RESULT_TextField-4903" size="30" maxlength="255" value="<?php if(isset($_POST['RESULT_TextField-4903']) AND $_POST['RESULT_TextField-4903']!='') echo $_POST['RESULT_TextField-4903']; ?>">
	</label>
	<a class="item_anchor" name="ItemAnchor4905"></a>
	<label class="question top_question" for="RESULT_TextField-4905">(3)&nbsp;<span class="icon">&nbsp;</span>
	<input type="email" name="RESULT_TextField-4905" class="text_field" id="RESULT_TextField-4905" size="30" maxlength="255" value="<?php if(isset($_POST['RESULT_TextField-4905']) AND $_POST['RESULT_TextField-4905']!='') echo $_POST['RESULT_TextField-4905']; ?>">
	</label>
	<a class="item_anchor" name="ItemAnchor4906"></a>
	<label class="question top_question" for="RESULT_TextField-4906">(4)&nbsp;<span class="icon">&nbsp;</span>
	<input type="email" name="RESULT_TextField-4906" class="text_field" id="RESULT_TextField-4906" size="30" maxlength="255" value="<?php if(isset($_POST['RESULT_TextField-4906']) AND $_POST['RESULT_TextField-4906']!='') echo $_POST['RESULT_TextField-4906']; ?>">
	</label>
	</p>
	</div>

	<div class="clear"></div>
	<!---
	<div id="q54" class="q full_width"> 
	<p style="padding:0 30px;">
	<a class="item_anchor" name="ItemAnchor4903"></a>
	<label class="question top_question" for="RESULT_TextField-4903">CC Email address (2)&nbsp;<span class="icon">&nbsp;</span></label>
	<input type="email" name="RESULT_TextField-4903" class="text_field" id="RESULT_TextField-4903" size="30" maxlength="255" value="<?php if(isset($_POST['RESULT_TextField-4903']) AND $_POST['RESULT_TextField-4903']!='') echo $_POST['RESULT_TextField-4903']; ?>">
	</p>
	</div>

	<div class="clear"></div>
	<div id="q54" class="q full_width"> <p style="padding:0 30px;">
	<a class="item_anchor" name="ItemAnchor4905"></a>
	<label class="question top_question" for="RESULT_TextField-4905">CC Email address (3)&nbsp;<span class="icon">&nbsp;</span></label>
	<input type="email" name="RESULT_TextField-4905" class="text_field" id="RESULT_TextField-4905" size="30" maxlength="255" value="<?php if(isset($_POST['RESULT_TextField-4905']) AND $_POST['RESULT_TextField-4905']!='') echo $_POST['RESULT_TextField-4905']; ?>">
	</p>
	</div>

	<div class="clear"></div>
	<div id="q54" class="q full_width"> <p style="padding:0 30px;">
	<a class="item_anchor" name="ItemAnchor4906"></a>
	<label class="question top_question" for="RESULT_TextField-4906">CC Email address (4)&nbsp;<span class="icon">&nbsp;</span></label>
	<input type="email" name="RESULT_TextField-4906" class="text_field" id="RESULT_TextField-4906" size="30" maxlength="255" value="<?php if(isset($_POST['RESULT_TextField-4906']) AND $_POST['RESULT_TextField-4906']!='') echo $_POST['RESULT_TextField-4906']; ?>">
	</p>
	</div>

	<div class="clear"></div>-->
	<div id="q54" class="q full_width"> <p style="padding:0 30px;">
	<a class="item_anchor" name="ItemAnchor4904"></a>
	<label class="question top_question" for="RESULT_TextField-4904">your order reference number&nbsp;<span class="icon">&nbsp;</span></label>
	<input type="text" name="RESULT_TextField-4904" class="text_field" id="RESULT_TextField-4904" size="30" maxlength="255" placeholder="Please write your order reference number" value="<?php if(isset($_POST['RESULT_TextField-4904']) AND $_POST['RESULT_TextField-4904']!='') echo $_POST['RESULT_TextField-4904']; ?>">
	</p>
	</div>

	<div class="clear"></div>
<!--
<div id="q47" class="q required">
<a class="item_anchor" name="ItemAnchor52"></a>
<label class="question top_question" for="RESULT_TextField-52">Last name&nbsp;<span class="icon">&nbsp;</span></label>
<input type="text" name="RESULT_TextField-52" class="text_field" id="RESULT_TextField-52" size="22" maxlength="255" value="<?php if(isset($_POST['RESULT_TextField-52']) AND $_POST['RESULT_TextField-52']!='') echo $_POST['RESULT_TextField-52']; ?>">
</div>

<div class="clear"></div>-->

<div id="q57" class="q">
<a class="item_anchor" name="ItemAnchor53"></a>
<label class="question top_question" for="RESULT_TextArea-53">Note - Goods value:<span class="icon">&nbsp;</span></label>
<textarea name="RESULT_TextArea-53" class="text_field" id="RESULT_TextArea-53" rows="7" cols="23"><?php if(isset($_POST['RESULT_TextArea-53']) AND $_POST['RESULT_TextArea-53']!='') echo $_POST['RESULT_TextArea-533']; ?></textarea>
</div>

<div class="clear"></div>

<div id="q60" class="q full_width">
<a class="item_anchor" name="ItemAnchor54"></a>
&nbsp;
</div>
<div class="clear"></div>

</div>
<!-- END_ITEMS -->
<script type="text/javascript">var itemRules={102:{"criteria":[{"item":101,"answer":"0","operator":"=="},{"item":101,"answer":"2","operator":"=="}],"action":"show","join":"||"}};</script>
<input type="hidden" name="EParam" value="x8J1JeDzqXa10WWcjg3Jz7tOpgu2IeBz">
<input type="hidden" id="EmbeddedForm" name="EmbeddedForm" value="EmbeddedForm"><input type="hidden" id="EmbedId" name="EmbedId" value="1332349481">
<input type="hidden" id="HostUrl" name="HostUrl" value="">
<div class="outside_container">
<div class="buttons_reverse">
<input type="submit" name="Submit" value="Submit" class="submit_button" id="FSsubmit">
<input type="submit" name="PreviousSubmit" value="< Previous" class="submit_button" id="FSpreviousSubmit"></div></div>
</form>
	<?php
		
	}
	elseif($shown_type==4){
	?>

<div class="outside_container">
	<div class="progressBarWrapper">
		<div class="progressBarBack" style=" width:100%; "><div class="progressBarText">100%&nbsp;Complete</div></div>
		<div class="progressBarFront"><div class="progressBarText">100%&nbsp;Complete</div></div>
	</div>
</div>
<!-- BEGIN_ITEMS -->
<div class="form_table">

	<div class="clear"></div>

	<div id="q55" class="q full_width">
		<a class="item_anchor" name="ItemAnchor45"></a>
		<div class="segment_header" style="width:auto;text-align:Center;"><h1 style="font-size:18px;padding:20px 1em ;"></h1><h1>Thank You</h1></div>
	</div>

	<div class="clear"></div>

	<div id="q105" class="q full_width">
		<a class="item_anchor" name="ItemAnchor46"></a>
		<p style="padding:0 30px;"><b>Tracking ID :</b><br><?php echo $tid; ?></p>
	</div>

	<div class="clear"></div>

	<div id="q101" class="q required">
		<a class="item_anchor" name="ItemAnchor47"></a>
		<p style="padding:0 30px;"><b>Note :</b><br>One of our agents will call back you soon.</p>
		<p style="padding:0 30px;"><b>Note :</b><br>Please write down the Tracking ID somewhere for later contact.</p>
		
	</div>

	<div class="clear"></div>


</div>
<!-- END_ITEMS -->

	<?php
		
	}
	?>
	
	</body>
</html>
