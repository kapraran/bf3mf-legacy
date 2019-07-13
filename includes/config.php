<?php
$TIME_MODIFIER = 0; // HOURS
$MATCHES_PER_PAGE = 10;
$NOTIFICATIONS_PER_PAGE = 30;

// mode list
$MODE_LIST = array(
  'start',
  'login',
  'register',
  'submitlogin',
  'submitregister',
  'error',
  'logout',
  'create',
  'submitcreate',
  'find',
  //'submitfind',  to be deleted
  'findresults',
  'match',
  'controlpanel',
  'submitcontrolpanel',
  'challenge',
  'notifications',
  'deletematch',
  'declinechallenge',
  'acceptchallenge',
  'submitmessage',
  'mymatches',
);

// mode parameters
$MODE_LIST_PARAMETERS = array(
  'start' => array(
    /*NONE*/
  ),

  'login' => array(
    'email' => array(
      'required' => false,
      'type' => 'get',
    ),
    'password' => array(
      'required' => false,
      'type' => 'get',
    ),
    'success' => array(
      'required' => false,
      'type' => 'get',
    ),
    'errorcode' => array(
      'required' => false,
      'type' => 'get',
    ),
  ),

  'register' => array(
    'success' => array(
      'required' => false,
      'type' => 'get',
    ),
    'errorcode' => array(
      'required' => false,
      'type' => 'get',
    ),
  ),

  'submitlogin' => array(
    'email' => array(
      'required' => true,
      'type' => 'post',
    ),
    'password' => array(
      'required' => true,
      'type' => 'post',
    ),
  ),

  'submitregister' => array(
    'email' => array(
      'required' => true,
      'type' => 'post',
    ),
    'password' => array(
      'required' => true,
      'type' => 'post',
    ),
    'rpassword' => array(
      'required' => true,
      'type' => 'post',
    ),
    'clanname' => array(
      'required' => true,
      'type' => 'post',
    ),
    'clantag' => array(
      'required' => true,
      'type' => 'post',
    ),
    'claninfo' => array(
      'required' => true,
      'type' => 'post',
    ),
    // disable recaptcha...
    'recaptcha_challenge_field' => array(
      'required' => false,
      'type' => 'post',
    ),
    'recaptcha_response_field' => array(
      'required' => false,
      'type' => 'post',
    ),
  ),

  'error' => array(
    'errorcode' => array(
      'required' => true,
      'type' => 'get',
    ),
  ),

  'logout' => array(
    /*NONE*/
  ),
  'create' => array(
    'success' => array(
      'required' => false,
      'type' => 'get',
    ),
    'errorcode' => array(
      'required' => false,
      'type' => 'get',
    ),
  ),
  'submitcreate' => array(
    'start_day' => array(
      'required' => true,
      'type' => 'post',
    ),
    'start_month' => array(
      'required' => true,
      'type' => 'post',
    ),
    'start_year' => array(
      'required' => true,
      'type' => 'post',
    ),
    'start_hour' => array(
      'required' => true,
      'type' => 'post',
    ),
    'start_min' => array(
      'required' => true,
      'type' => 'post',
    ),
    'time_after' => array(
      'required' => true,
      'type' => 'post',
    ),
    'server_region' => array(
      'required' => true,
      'type' => 'post',
    ),
    'server_own' => array(
      'required' => true,
      'type' => 'post',
    ),
    'dlc_own' => array(
      'required' => true,
      'type' => 'post',
    ),
    'preset' => array(
      'required' => true,
      'type' => 'post',
    ),
    'mode' => array(
      'required' => true,
      'type' => 'post',
    ),
    'platform' => array(
      'required' => true,
      'type' => 'post',
    ),
    'tsize' => array(
      'required' => true,
      'type' => 'post',
    ),
    'map1' => array(
      'required' => false,
      'type' => 'post',
    ),
    'map2' => array(
      'required' => false,
      'type' => 'post',
    ),
    'map3' => array(
      'required' => false,
      'type' => 'post',
    ),
    'notes' => array(
      'required' => false,
      'type' => 'post',
    ),
    'secid' => array(
      'required' => true,
      'type' => 'post',
    ),
  ),
  'find' => array(
    /*NONE*/
  ),
  'match' => array(
    'id' => array(
      'required' => true,
      'type' => 'get',
    ),
    'success' => array(
      'required' => false,
      'type' => 'get',
    ),
    'errorcode' => array(
      'required' => false,
      'type' => 'get',
    ),
  ),
  'controlpanel' => array(
    'success' => array(
      'required' => false,
      'type' => 'get',
    ),
    'errorcode' => array(
      'required' => false,
      'type' => 'get',
    ),
  ),
  'submitcontrolpanel' => array(
    'clantag' => array(
      'required' => true,
      'type' => 'post',
    ),
    'clanlogo' => array(
      'required' => false,
      'type' => 'post',
    ),
    'battlelog' => array(
      'required' => false,
      'type' => 'post',
    ),
    'country' => array(
      'required' => true,
      'type' => 'post',
    ),
    'secid' => array(
      'required' => true,
      'type' => 'post',
    ),
  ),
  'findresults' => array(
    'start_day' => array(
      'required' => true,
      'type' => 'post',
    ),
    'start_month' => array(
      'required' => true,
      'type' => 'post',
    ),
    'start_year' => array(
      'required' => true,
      'type' => 'post',
    ),
    'start_hour' => array(
      'required' => true,
      'type' => 'post',
    ),
    'start_min' => array(
      'required' => true,
      'type' => 'post',
    ),
    'end_day' => array(
      'required' => true,
      'type' => 'post',
    ),
    'end_month' => array(
      'required' => true,
      'type' => 'post',
    ),
    'end_year' => array(
      'required' => true,
      'type' => 'post',
    ),
    'end_hour' => array(
      'required' => true,
      'type' => 'post',
    ),
    'end_min' => array(
      'required' => true,
      'type' => 'post',
    ),
    'server_region' => array(
      'required' => true,
      'type' => 'post',
    ),
    'preset' => array(
      'required' => true,
      'type' => 'post',
    ),
    'mode' => array(
      'required' => true,
      'type' => 'post',
    ),
    'platform' => array(
      'required' => true,
      'type' => 'post',
    ),
    'tsize' => array(
      'required' => true,
      'type' => 'post',
    ),
    'secid' => array(
      'required' => true,
      'type' => 'post',
    ),
    'page' => array(
      'required' => false,
      'type' => 'get',
    ),
  ),
  'submitfind' => array(
    'start_day' => array(
      'required' => true,
      'type' => 'post',
    ),
    'start_month' => array(
      'required' => true,
      'type' => 'post',
    ),
    'start_year' => array(
      'required' => true,
      'type' => 'post',
    ),
    'start_hour' => array(
      'required' => true,
      'type' => 'post',
    ),
    'start_min' => array(
      'required' => true,
      'type' => 'post',
    ),
    'end_day' => array(
      'required' => true,
      'type' => 'post',
    ),
    'end_month' => array(
      'required' => true,
      'type' => 'post',
    ),
    'end_year' => array(
      'required' => true,
      'type' => 'post',
    ),
    'end_hour' => array(
      'required' => true,
      'type' => 'post',
    ),
    'end_min' => array(
      'required' => true,
      'type' => 'post',
    ),
    'server_region' => array(
      'required' => true,
      'type' => 'post',
    ),
    'preset' => array(
      'required' => true,
      'type' => 'post',
    ),
    'mode' => array(
      'required' => true,
      'type' => 'post',
    ),
    'platform' => array(
      'required' => true,
      'type' => 'post',
    ),
    'tsize' => array(
      'required' => true,
      'type' => 'post',
    ),
    'secid' => array(
      'required' => true,
      'type' => 'post',
    ),
  ),
  'challenge' => array(
    'matchid' => array(
      'required' => true,
      'type' => 'get',
    ),
    'secid' => array(
      'required' => true,
      'type' => 'post',
    ),
  ),
  'notifications' => array(
    'page' => array(
      'required' => false,
      'type' => 'get',
    ),
  ),
  'deletematch' => array(
    'matchid' => array(
      'required' => true,
      'type' => 'get',
    ),
    'secid' => array(
      'required' => true,
      'type' => 'post',
    ),
  ),
  'declinechallenge' => array(
    'matchid' => array(
      'required' => true,
      'type' => 'get',
    ),
    'secid' => array(
      'required' => true,
      'type' => 'post',
    ),
    'cid' => array(
      'required' => true,
      'type' => 'get',
    ),
  ),
  'acceptchallenge' => array(
    'matchid' => array(
      'required' => true,
      'type' => 'get',
    ),
    'secid' => array(
      'required' => true,
      'type' => 'post',
    ),
    'cid' => array(
      'required' => true,
      'type' => 'get',
    ),
  ),
  'submitmessage' => array(
    'clanid' => array(
      'required' => true,
      'type' => 'post',
    ),
    'message' => array(
      'required' => true,
      'type' => 'post',
    ),
    'secid' => array(
      'required' => true,
      'type' => 'post',
    ),
  ),
  'mymatches' => array(
    /*NONE*/
  ),
);

// parameter validation
$MODE_PARAMETERS_VALIDATION = array(
  'submitregister' => 'valid_sregister',
  'submitlogin' => 'valid_slogin',
  'submitcreate' => 'validate_create_match',
  'submitcontrolpanel' => 'validate_update_settings',
  'submitfind' => 'validate_find_match',
  'findresults' => 'validate_find_match',
);

// BF3 map list
$MAP_LIST = array(
  'Caspian Border' => array(
    'name' => 'Caspian Border',
    'icon' => '/img/maps/icon/caspian.jpg',
    'img_wide' => '/img/maps/wide/caspian.jpg',
    'game' => 'BF3',
  ),

  'Damavand Peak' => array(
    'name' => 'Damavand Peak',
    'icon' => '/img/maps/icon/damavand.jpg',
    'img_wide' => '/img/maps/wide/damavand.jpg',
    'game' => 'BF3',
  ),

  'Grand Bazaar' => array(
    'name' => 'Grand Bazaar',
    'icon' => '/img/maps/icon/bazaar.jpg',
    'img_wide' => '/img/maps/wide/bazaar.jpg',
    'game' => 'BF3',
  ),

  'Kharg Island' => array(
    'name' => 'Kharg Island',
    'icon' => '/img/maps/icon/kharg.jpg',
    'img_wide' => '/img/maps/wide/kharg.jpg',
    'game' => 'BF3',
  ),

  'Noshahr Canals' => array(
    'name' => 'Noshahr Canals',
    'icon' => '/img/maps/icon/canals.jpg',
    'img_wide' => '/img/maps/wide/canals.jpg',
    'game' => 'BF3',
  ),

  'Seine Crossing' => array(
    'name' => 'Seine Crossing',
    'icon' => '/img/maps/icon/seine.jpg',
    'img_wide' => '/img/maps/wide/seine.jpg',
    'game' => 'BF3',
  ),

  'Tehran Highway' => array(
    'name' => 'Tehran Highway',
    'icon' => '/img/maps/icon/tehran.jpg',
    'img_wide' => '/img/maps/wide/tehran.jpg',
    'game' => 'BF3',
  ),

  'Operation Firestorm' => array(
    'name' => 'Operation Firestorm',
    'icon' => '/img/maps/icon/op_fire.jpg',
    'img_wide' => '/img/maps/wide/op_fire.jpg',
    'game' => 'BF3',
  ),

  'Operation Métro' => array(
    'name' => 'Operation Métro',
    'icon' => '/img/maps/icon/op_metro.jpg',
    'img_wide' => '/img/maps/wide/op_metro.jpg',
    'game' => 'BF3',
  ),

  'Gulf of Oman' => array(
    'name' => 'Gulf of Oman',
    'icon' => '/img/maps/icon/oman.jpg',
    'img_wide' => '/img/maps/wide/oman.jpg',
    'game' => 'B2K',
  ),

  'Sharqi Peninsula' => array(
    'name' => 'Sharqi Peninsula',
    'icon' => '/img/maps/icon/sharqi.jpg',
    'img_wide' => '/img/maps/wide/sharqi.jpg',
    'game' => 'B2K',
  ),

  'Strike at Karkand' => array(
    'name' => 'Strike at Karkand',
    'icon' => '/img/maps/icon/karkand.jpg',
    'img_wide' => '/img/maps/wide/karkand.jpg',
    'game' => 'B2K',
  ),

  'Wake Island' => array(
    'name' => 'Wake Island',
    'icon' => '/img/maps/icon/wake.jpg',
    'img_wide' => '/img/maps/wide/wake.jpg',
    'game' => 'B2K',
  ),

  'Ziba Tower' => array(
    'name' => 'Ziba Tower',
    'icon' => '/img/maps/icon/ziba.jpg',
    'img_wide' => '/img/maps/wide/ziba.jpg',
    'game' => 'CQ',
  ),

  'Donya Fortress' => array(
    'name' => 'Donya Fortress',
    'icon' => '/img/maps/icon/donya.jpg',
    'img_wide' => '/img/maps/wide/donya.jpg',
    'game' => 'CQ',
  ),

  'Scrapmetal' => array(
    'name' => 'Scrapmetal',
    'icon' => '/img/maps/icon/scrap.jpg',
    'img_wide' => '/img/maps/wide/scrap.jpg',
    'game' => 'CQ',
  ),

  'Operation 925' => array(
    'name' => 'Operation 925',
    'icon' => '/img/maps/icon/op_925.jpg',
    'img_wide' => '/img/maps/wide/op_925.jpg',
    'game' => 'CQ',
  ),
);

$COUNTRIES = array(
  'AU' => 'Australia',
  'AF' => 'Afghanistan',
  'AL' => 'Albania',
  'DZ' => 'Algeria',
  'AS' => 'American Samoa',
  'AD' => 'Andorra',
  'AO' => 'Angola',
  'AI' => 'Anguilla',
  'AQ' => 'Antarctica',
  'AG' => 'Antigua & Barbuda',
  'AR' => 'Argentina',
  'AM' => 'Armenia',
  'AW' => 'Aruba',
  'AT' => 'Austria',
  'AZ' => 'Azerbaijan',
  'BS' => 'Bahamas',
  'BH' => 'Bahrain',
  'BD' => 'Bangladesh',
  'BB' => 'Barbados',
  'BY' => 'Belarus',
  'BE' => 'Belgium',
  'BZ' => 'Belize',
  'BJ' => 'Benin',
  'BM' => 'Bermuda',
  'BT' => 'Bhutan',
  'BO' => 'Bolivia',
  'BA' => 'Bosnia/Hercegovina',
  'BW' => 'Botswana',
  'BV' => 'Bouvet Island',
  'BR' => 'Brazil',
  'IO' => 'British Indian Ocean Territory',
  'BN' => 'Brunei Darussalam',
  'BG' => 'Bulgaria',
  'BF' => 'Burkina Faso',
  'BI' => 'Burundi',
  'KH' => 'Cambodia',
  'CM' => 'Cameroon',
  'CA' => 'Canada',
  'CV' => 'Cape Verde',
  'KY' => 'Cayman Is',
  'CF' => 'Central African Republic',
  'TD' => 'Chad',
  'CL' => 'Chile',
  'CN' => "China, People's Republic of",
  'CX' => 'Christmas Island',
  'CC' => 'Cocos Islands',
  'CO' => 'Colombia',
  'KM' => 'Comoros',
  'CG' => 'Congo',
  'CD' => 'Congo, Democratic Republic',
  'CK' => 'Cook Islands',
  'CR' => 'Costa Rica',
  'CI' => "Cote d'Ivoire",
  'HR' => 'Croatia',
  'CU' => 'Cuba',
  'CY' => 'Cyprus',
  'CZ' => 'Czech Republic',
  'DK' => 'Denmark',
  'DJ' => 'Djibouti',
  'DM' => 'Dominica',
  'DO' => 'Dominican Republic',
  'TP' => 'East Timor',
  'EC' => 'Ecuador',
  'EG' => 'Egypt',
  'SV' => 'El Salvador',
  'GQ' => 'Equatorial Guinea',
  'ER' => 'Eritrea',
  'EE' => 'Estonia',
  'ET' => 'Ethiopia',
  'FK' => 'Falkland Islands',
  'FO' => 'Faroe Islands',
  'FJ' => 'Fiji',
  'FI' => 'Finland',
  'FR' => 'France',
  'FX' => 'France, Metropolitan',
  'GF' => 'French Guiana',
  'PF' => 'French Polynesia',
  'TF' => 'French South Territories',
  'GA' => 'Gabon',
  'GM' => 'Gambia',
  'GE' => 'Georgia',
  'DE' => 'Germany',
  'GH' => 'Ghana',
  'GI' => 'Gibraltar',
  'GR' => 'Greece',
  'GL' => 'Greenland',
  'GD' => 'Grenada',
  'GP' => 'Guadeloupe',
  'GU' => 'Guam',
  'GT' => 'Guatemala',
  'GN' => 'Guinea',
  'GW' => 'Guinea-Bissau',
  'GY' => 'Guyana',
  'HT' => 'Haiti',
  'HM' => 'Heard Island And Mcdonald Island',
  'HN' => 'Honduras',
  'HK' => 'Hong Kong',
  'HU' => 'Hungary',
  'IS' => 'Iceland',
  'IN' => 'India',
  'ID' => 'Indonesia',
  'IR' => 'Iran',
  'IQ' => 'Iraq',
  'IE' => 'Ireland',
  'IL' => 'Israel',
  'IT' => 'Italy',
  'JM' => 'Jamaica',
  'JP' => 'Japan',
  'JT' => 'Johnston Island',
  'JO' => 'Jordan',
  'KZ' => 'Kazakhstan',
  'KE' => 'Kenya',
  'KI' => 'Kiribati',
  'KP' => 'Korea, Democratic Peoples Republic',
  'KR' => 'Korea, Republic of',
  'KW' => 'Kuwait',
  'KG' => 'Kyrgyzstan',
  'LA' => "Lao People's Democratic Republic",
  'LV' => 'Latvia',
  'LB' => 'Lebanon',
  'LS' => 'Lesotho',
  'LR' => 'Liberia',
  'LY' => 'Libyan Arab Jamahiriya',
  'LI' => 'Liechtenstein',
  'LT' => 'Lithuania',
  'LU' => 'Luxembourg',
  'MO' => 'Macau',
  'MK' => 'Macedonia',
  'MG' => 'Madagascar',
  'MW' => 'Malawi',
  'MY' => 'Malaysia',
  'MV' => 'Maldives',
  'ML' => 'Mali',
  'MT' => 'Malta',
  'MH' => 'Marshall Islands',
  'MQ' => 'Martinique',
  'MR' => 'Mauritania',
  'MU' => 'Mauritius',
  'YT' => 'Mayotte',
  'MX' => 'Mexico',
  'FM' => 'Micronesia',
  'MD' => 'Moldavia',
  'MC' => 'Monaco',
  'MN' => 'Mongolia',
  'MS' => 'Montserrat',
  'MA' => 'Morocco',
  'MZ' => 'Mozambique',
  'MM' => 'Union Of Myanmar',
  'NA' => 'Namibia',
  'NR' => 'Nauru Island',
  'NP' => 'Nepal',
  'NL' => 'Netherlands',
  'AN' => 'Netherlands Antilles',
  'NC' => 'New Caledonia',
  'NZ' => 'New Zealand',
  'NI' => 'Nicaragua',
  'NE' => 'Niger',
  'NG' => 'Nigeria',
  'NU' => 'Niue',
  'NF' => 'Norfolk Island',
  'MP' => 'Mariana Islands, Northern',
  'NO' => 'Norway',
  'OM' => 'Oman',
  'PK' => 'Pakistan',
  'PW' => 'Palau Islands',
  'PS' => 'Palestine',
  'PA' => 'Panama',
  'PG' => 'Papua New Guinea',
  'PY' => 'Paraguay',
  'PE' => 'Peru',
  'PH' => 'Philippines',
  'PN' => 'Pitcairn',
  'PL' => 'Poland',
  'PT' => 'Portugal',
  'PR' => 'Puerto Rico',
  'QA' => 'Qatar',
  'RE' => 'Reunion Island',
  'RO' => 'Romania',
  'RU' => 'Russian Federation',
  'RW' => 'Rwanda',
  'WS' => 'Samoa',
  'SH' => 'St Helena',
  'KN' => 'St Kitts & Nevis',
  'LC' => 'St Lucia',
  'PM' => 'St Pierre & Miquelon',
  'VC' => 'St Vincent',
  'SM' => 'San Marino',
  'ST' => 'Sao Tome & Principe',
  'SA' => 'Saudi Arabia',
  'SN' => 'Senegal',
  'SC' => 'Seychelles',
  'SL' => 'Sierra Leone',
  'SG' => 'Singapore',
  'SK' => 'Slovakia',
  'SI' => 'Slovenia',
  'SB' => 'Solomon Islands',
  'SO' => 'Somalia',
  'ZA' => 'South Africa',
  'GS' => 'South Georgia and South Sandwich',
  'ES' => 'Spain',
  'LK' => 'Sri Lanka',
  'XX' => 'Stateless Persons',
  'SD' => 'Sudan',
  'SR' => 'Suriname',
  'SJ' => 'Svalbard and Jan Mayen',
  'SZ' => 'Swaziland',
  'SE' => 'Sweden',
  'CH' => 'Switzerland',
  'SY' => 'Syrian Arab Republic',
  'TW' => 'Taiwan, Republic of China',
  'TJ' => 'Tajikistan',
  'TZ' => 'Tanzania',
  'TH' => 'Thailand',
  'TL' => 'Timor Leste',
  'TG' => 'Togo',
  'TK' => 'Tokelau',
  'TO' => 'Tonga',
  'TT' => 'Trinidad & Tobago',
  'TN' => 'Tunisia',
  'TR' => 'Turkey',
  'TM' => 'Turkmenistan',
  'TC' => 'Turks And Caicos Islands',
  'TV' => 'Tuvalu',
  'UG' => 'Uganda',
  'UA' => 'Ukraine',
  'AE' => 'United Arab Emirates',
  'GB' => 'United Kingdom',
  'UM' => 'US Minor Outlying Islands',
  'US' => 'USA',
  'HV' => 'Upper Volta',
  'UY' => 'Uruguay',
  'UZ' => 'Uzbekistan',
  'VU' => 'Vanuatu',
  'VA' => 'Vatican City State',
  'VE' => 'Venezuela',
  'VN' => 'Vietnam',
  'VG' => 'Virgin Islands (British)',
  'VI' => 'Virgin Islands (US)',
  'WF' => 'Wallis And Futuna Islands',
  'EH' => 'Western Sahara',
  'YE' => 'Yemen Arab Rep.',
  'YD' => 'Yemen Democratic',
  'YU' => 'Yugoslavia',
  'ZR' => 'Zaire',
  'ZM' => 'Zambia',
  'ZW' => 'Zimbabwe',
);
