<?php
require_once 'php8support.php';

//session_destroy();
//session_start();
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
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>BookingParcel | Euro Post Express</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="./bizland/assets/img/favicon.png" rel="icon">
    <link href="./bizland/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="./bizland/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="./bizland/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="./bizland/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="./bizland/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="./bizland/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="./bizland/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    {{--    <link rel="stylesheet" href="{{asset('A0/public/resources/site/css/app.css')}}">--}}
    <link href="./bizland/assets/css/style.css" rel="stylesheet">

    <!--  start LEGACY  -->
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
    <link rel="stylesheet" href="{{asset('A0/public/resources/site/css/app.css')}}">
    <script type="text/javascript">//<![CDATA[
        var tlJsHost = ((window.location.protocol == "https:") ? "https://secure.comodo.com/" : "http://www.trustlogo.com/");
        document.write(unescape("%3Cscript src='" + tlJsHost + "trustlogo/javascript/trustlogo.js' type='text/javascript'%3E%3C/script%3E"));
        //]]>

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


    </script>
</head>
<body>
@yield('content')
@yield('pre_scripts')
@yield('later_scripts')
<script src="{{asset('A0/public/resources/site/js/app.js')}}"></script>
</body>
</html>
