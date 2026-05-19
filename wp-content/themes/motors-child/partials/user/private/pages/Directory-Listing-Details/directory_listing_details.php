<?php

    global $countryArray; // Assuming the array is placed above this function
    global $wpdb;
$countryArray = array(
    'AD'=>array('name'=>'ANDORRA','code'=>'376'),
    'AE'=>array('name'=>'UNITED ARAB EMIRATES','code'=>'971'),
    'AF'=>array('name'=>'AFGHANISTAN','code'=>'93'),
    'AG'=>array('name'=>'ANTIGUA AND BARBUDA','code'=>'1268'),
    'AI'=>array('name'=>'ANGUILLA','code'=>'1264'),
    'AL'=>array('name'=>'ALBANIA','code'=>'355'),
    'AM'=>array('name'=>'ARMENIA','code'=>'374'),
    'AN'=>array('name'=>'NETHERLANDS ANTILLES','code'=>'599'),
    'AO'=>array('name'=>'ANGOLA','code'=>'244'),
    'AQ'=>array('name'=>'ANTARCTICA','code'=>'672'),
    'AR'=>array('name'=>'ARGENTINA','code'=>'54'),
    'AS'=>array('name'=>'AMERICAN SAMOA','code'=>'1684'),
    'AT'=>array('name'=>'AUSTRIA','code'=>'43'),
    'AU'=>array('name'=>'AUSTRALIA','code'=>'61'),
    'AW'=>array('name'=>'ARUBA','code'=>'297'),
    'AZ'=>array('name'=>'AZERBAIJAN','code'=>'994'),
    'BA'=>array('name'=>'BOSNIA AND HERZEGOVINA','code'=>'387'),
    'BB'=>array('name'=>'BARBADOS','code'=>'1246'),
    'BD'=>array('name'=>'BANGLADESH','code'=>'880'),
    'BE'=>array('name'=>'BELGIUM','code'=>'32'),
    'BF'=>array('name'=>'BURKINA FASO','code'=>'226'),
    'BG'=>array('name'=>'BULGARIA','code'=>'359'),
    'BH'=>array('name'=>'BAHRAIN','code'=>'973'),
    'BI'=>array('name'=>'BURUNDI','code'=>'257'),
    'BJ'=>array('name'=>'BENIN','code'=>'229'),
    'BL'=>array('name'=>'SAINT BARTHELEMY','code'=>'590'),
    'BM'=>array('name'=>'BERMUDA','code'=>'1441'),
    'BN'=>array('name'=>'BRUNEI DARUSSALAM','code'=>'673'),
    'BO'=>array('name'=>'BOLIVIA','code'=>'591'),
    'BR'=>array('name'=>'BRAZIL','code'=>'55'),
    'BS'=>array('name'=>'BAHAMAS','code'=>'1242'),
    'BT'=>array('name'=>'BHUTAN','code'=>'975'),
    'BW'=>array('name'=>'BOTSWANA','code'=>'267'),
    'BY'=>array('name'=>'BELARUS','code'=>'375'),
    'BZ'=>array('name'=>'BELIZE','code'=>'501'),
    'CA'=>array('name'=>'CANADA','code'=>'1'),
    'CC'=>array('name'=>'COCOS (KEELING) ISLANDS','code'=>'61'),
    'CD'=>array('name'=>'CONGO, THE DEMOCRATIC REPUBLIC OF THE','code'=>'243'),
    'CF'=>array('name'=>'CENTRAL AFRICAN REPUBLIC','code'=>'236'),
    'CG'=>array('name'=>'CONGO','code'=>'242'),
    'CH'=>array('name'=>'SWITZERLAND','code'=>'41'),
    'CI'=>array('name'=>'COTE D IVOIRE','code'=>'225'),
    'CK'=>array('name'=>'COOK ISLANDS','code'=>'682'),
    'CL'=>array('name'=>'CHILE','code'=>'56'),
    'CM'=>array('name'=>'CAMEROON','code'=>'237'),
    'CN'=>array('name'=>'CHINA','code'=>'86'),
    'CO'=>array('name'=>'COLOMBIA','code'=>'57'),
    'CR'=>array('name'=>'COSTA RICA','code'=>'506'),
    'CU'=>array('name'=>'CUBA','code'=>'53'),
    'CV'=>array('name'=>'CAPE VERDE','code'=>'238'),
    'CX'=>array('name'=>'CHRISTMAS ISLAND','code'=>'61'),
    'CY'=>array('name'=>'CYPRUS','code'=>'357'),
    'CZ'=>array('name'=>'CZECH REPUBLIC','code'=>'420'),
    'DE'=>array('name'=>'GERMANY','code'=>'49'),
    'DJ'=>array('name'=>'DJIBOUTI','code'=>'253'),
    'DK'=>array('name'=>'DENMARK','code'=>'45'),
    'DM'=>array('name'=>'DOMINICA','code'=>'1767'),
    'DO'=>array('name'=>'DOMINICAN REPUBLIC','code'=>'1809'),
    'DZ'=>array('name'=>'ALGERIA','code'=>'213'),
    'EC'=>array('name'=>'ECUADOR','code'=>'593'),
    'EE'=>array('name'=>'ESTONIA','code'=>'372'),
    'EG'=>array('name'=>'EGYPT','code'=>'20'),
    'ER'=>array('name'=>'ERITREA','code'=>'291'),
    'ES'=>array('name'=>'SPAIN','code'=>'34'),
    'ET'=>array('name'=>'ETHIOPIA','code'=>'251'),
    'FI'=>array('name'=>'FINLAND','code'=>'358'),
    'FJ'=>array('name'=>'FIJI','code'=>'679'),
    'FK'=>array('name'=>'FALKLAND ISLANDS (MALVINAS)','code'=>'500'),
    'FM'=>array('name'=>'MICRONESIA, FEDERATED STATES OF','code'=>'691'),
    'FO'=>array('name'=>'FAROE ISLANDS','code'=>'298'),
    'FR'=>array('name'=>'FRANCE','code'=>'33'),
    'GA'=>array('name'=>'GABON','code'=>'241'),
    'GB'=>array('name'=>'UNITED KINGDOM','code'=>'44'),
    'GD'=>array('name'=>'GRENADA','code'=>'1473'),
    'GE'=>array('name'=>'GEORGIA','code'=>'995'),
    'GH'=>array('name'=>'GHANA','code'=>'233'),
    'GI'=>array('name'=>'GIBRALTAR','code'=>'350'),
    'GL'=>array('name'=>'GREENLAND','code'=>'299'),
    'GM'=>array('name'=>'GAMBIA','code'=>'220'),
    'GN'=>array('name'=>'GUINEA','code'=>'224'),
    'GQ'=>array('name'=>'EQUATORIAL GUINEA','code'=>'240'),
    'GR'=>array('name'=>'GREECE','code'=>'30'),
    'GT'=>array('name'=>'GUATEMALA','code'=>'502'),
    'GU'=>array('name'=>'GUAM','code'=>'1671'),
    'GW'=>array('name'=>'GUINEA-BISSAU','code'=>'245'),
    'GY'=>array('name'=>'GUYANA','code'=>'592'),
    'HK'=>array('name'=>'HONG KONG','code'=>'852'),
    'HN'=>array('name'=>'HONDURAS','code'=>'504'),
    'HR'=>array('name'=>'CROATIA','code'=>'385'),
    'HT'=>array('name'=>'HAITI','code'=>'509'),
    'HU'=>array('name'=>'HUNGARY','code'=>'36'),
    'ID'=>array('name'=>'INDONESIA','code'=>'62'),
    'IE'=>array('name'=>'IRELAND','code'=>'353'),
    'IL'=>array('name'=>'ISRAEL','code'=>'972'),
    'IM'=>array('name'=>'ISLE OF MAN','code'=>'44'),
    'IN'=>array('name'=>'INDIA','code'=>'91'),
    'IQ'=>array('name'=>'IRAQ','code'=>'964'),
    'IR'=>array('name'=>'IRAN, ISLAMIC REPUBLIC OF','code'=>'98'),
    'IS'=>array('name'=>'ICELAND','code'=>'354'),
    'IT'=>array('name'=>'ITALY','code'=>'39'),
    'JM'=>array('name'=>'JAMAICA','code'=>'1876'),
    'JO'=>array('name'=>'JORDAN','code'=>'962'),
    'JP'=>array('name'=>'JAPAN','code'=>'81'),
    'KE'=>array('name'=>'KENYA','code'=>'254'),
    'KG'=>array('name'=>'KYRGYZSTAN','code'=>'996'),
    'KH'=>array('name'=>'CAMBODIA','code'=>'855'),
    'KI'=>array('name'=>'KIRIBATI','code'=>'686'),
    'KM'=>array('name'=>'COMOROS','code'=>'269'),
    'KN'=>array('name'=>'SAINT KITTS AND NEVIS','code'=>'1869'),
    'KP'=>array('name'=>'KOREA DEMOCRATIC PEOPLES REPUBLIC OF','code'=>'850'),
    'KR'=>array('name'=>'KOREA REPUBLIC OF','code'=>'82'),
    'KW'=>array('name'=>'KUWAIT','code'=>'965'),
    'KY'=>array('name'=>'CAYMAN ISLANDS','code'=>'1345'),
    'KZ'=>array('name'=>'KAZAKSTAN','code'=>'7'),
    'LA'=>array('name'=>'LAO PEOPLES DEMOCRATIC REPUBLIC','code'=>'856'),
    'LB'=>array('name'=>'LEBANON','code'=>'961'),
    'LC'=>array('name'=>'SAINT LUCIA','code'=>'1758'),
    'LI'=>array('name'=>'LIECHTENSTEIN','code'=>'423'),
    'LK'=>array('name'=>'SRI LANKA','code'=>'94'),
    'LR'=>array('name'=>'LIBERIA','code'=>'231'),
    'LS'=>array('name'=>'LESOTHO','code'=>'266'),
    'LT'=>array('name'=>'LITHUANIA','code'=>'370'),
    'LU'=>array('name'=>'LUXEMBOURG','code'=>'352'),
    'LV'=>array('name'=>'LATVIA','code'=>'371'),
    'LY'=>array('name'=>'LIBYAN ARAB JAMAHIRIYA','code'=>'218'),
    'MA'=>array('name'=>'MOROCCO','code'=>'212'),
    'MC'=>array('name'=>'MONACO','code'=>'377'),
    'MD'=>array('name'=>'MOLDOVA, REPUBLIC OF','code'=>'373'),
    'ME'=>array('name'=>'MONTENEGRO','code'=>'382'),
    'MF'=>array('name'=>'SAINT MARTIN','code'=>'1599'),
    'MG'=>array('name'=>'MADAGASCAR','code'=>'261'),
    'MH'=>array('name'=>'MARSHALL ISLANDS','code'=>'692'),
    'MK'=>array('name'=>'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF','code'=>'389'),
    'ML'=>array('name'=>'MALI','code'=>'223'),
    'MM'=>array('name'=>'MYANMAR','code'=>'95'),
    'MN'=>array('name'=>'MONGOLIA','code'=>'976'),
    'MO'=>array('name'=>'MACAU','code'=>'853'),
    'MP'=>array('name'=>'NORTHERN MARIANA ISLANDS','code'=>'1670'),
    'MR'=>array('name'=>'MAURITANIA','code'=>'222'),
    'MS'=>array('name'=>'MONTSERRAT','code'=>'1664'),
    'MT'=>array('name'=>'MALTA','code'=>'356'),
    'MU'=>array('name'=>'MAURITIUS','code'=>'230'),
    'MV'=>array('name'=>'MALDIVES','code'=>'960'),
    'MW'=>array('name'=>'MALAWI','code'=>'265'),
    'MX'=>array('name'=>'MEXICO','code'=>'52'),
    'MY'=>array('name'=>'MALAYSIA','code'=>'60'),
    'MZ'=>array('name'=>'MOZAMBIQUE','code'=>'258'),
    'NA'=>array('name'=>'NAMIBIA','code'=>'264'),
    'NC'=>array('name'=>'NEW CALEDONIA','code'=>'687'),
    'NE'=>array('name'=>'NIGER','code'=>'227'),
    'NG'=>array('name'=>'NIGERIA','code'=>'234'),
    'NI'=>array('name'=>'NICARAGUA','code'=>'505'),
    'NL'=>array('name'=>'NETHERLANDS','code'=>'31'),
    'NO'=>array('name'=>'NORWAY','code'=>'47'),
    'NP'=>array('name'=>'NEPAL','code'=>'977'),
    'NR'=>array('name'=>'NAURU','code'=>'674'),
    'NU'=>array('name'=>'NIUE','code'=>'683'),
    'NZ'=>array('name'=>'NEW ZEALAND','code'=>'64'),
    'OM'=>array('name'=>'OMAN','code'=>'968'),
    'PA'=>array('name'=>'PANAMA','code'=>'507'),
    'PE'=>array('name'=>'PERU','code'=>'51'),
    'PF'=>array('name'=>'FRENCH POLYNESIA','code'=>'689'),
    'PG'=>array('name'=>'PAPUA NEW GUINEA','code'=>'675'),
    'PH'=>array('name'=>'PHILIPPINES','code'=>'63'),
    'PK'=>array('name'=>'PAKISTAN','code'=>'92'),
    'PL'=>array('name'=>'POLAND','code'=>'48'),
    'PM'=>array('name'=>'SAINT PIERRE AND MIQUELON','code'=>'508'),
    'PN'=>array('name'=>'PITCAIRN','code'=>'870'),
    'PR'=>array('name'=>'PUERTO RICO','code'=>'1'),
    'PT'=>array('name'=>'PORTUGAL','code'=>'351'),
    'PW'=>array('name'=>'PALAU','code'=>'680'),
    'PY'=>array('name'=>'PARAGUAY','code'=>'595'),
    'QA'=>array('name'=>'QATAR','code'=>'974'),
    'RO'=>array('name'=>'ROMANIA','code'=>'40'),
    'RS'=>array('name'=>'SERBIA','code'=>'381'),
    'RU'=>array('name'=>'RUSSIAN FEDERATION','code'=>'7'),
    'RW'=>array('name'=>'RWANDA','code'=>'250'),
    'SA'=>array('name'=>'SAUDI ARABIA','code'=>'966'),
    'SB'=>array('name'=>'SOLOMON ISLANDS','code'=>'677'),
    'SC'=>array('name'=>'SEYCHELLES','code'=>'248'),
    'SD'=>array('name'=>'SUDAN','code'=>'249'),
    'SE'=>array('name'=>'SWEDEN','code'=>'46'),
    'SG'=>array('name'=>'SINGAPORE','code'=>'65'),
    'SH'=>array('name'=>'SAINT HELENA','code'=>'290'),
    'SI'=>array('name'=>'SLOVENIA','code'=>'386'),
    'SK'=>array('name'=>'SLOVAKIA','code'=>'421'),
    'SL'=>array('name'=>'SIERRA LEONE','code'=>'232'),
    'SM'=>array('name'=>'SAN MARINO','code'=>'378'),
    'SN'=>array('name'=>'SENEGAL','code'=>'221'),
    'SO'=>array('name'=>'SOMALIA','code'=>'252'),
    'SR'=>array('name'=>'SURINAME','code'=>'597'),
    'ST'=>array('name'=>'SAO TOME AND PRINCIPE','code'=>'239'),
    'SV'=>array('name'=>'EL SALVADOR','code'=>'503'),
    'SY'=>array('name'=>'SYRIAN ARAB REPUBLIC','code'=>'963'),
    'SZ'=>array('name'=>'SWAZILAND','code'=>'268'),
    'TC'=>array('name'=>'TURKS AND CAICOS ISLANDS','code'=>'1649'),
    'TD'=>array('name'=>'CHAD','code'=>'235'),
    'TG'=>array('name'=>'TOGO','code'=>'228'),
    'TH'=>array('name'=>'THAILAND','code'=>'66'),
    'TJ'=>array('name'=>'TAJIKISTAN','code'=>'992'),
    'TK'=>array('name'=>'TOKELAU','code'=>'690'),
    'TL'=>array('name'=>'TIMOR-LESTE','code'=>'670'),
    'TM'=>array('name'=>'TURKMENISTAN','code'=>'993'),
    'TN'=>array('name'=>'TUNISIA','code'=>'216'),
    'TO'=>array('name'=>'TONGA','code'=>'676'),
    'TR'=>array('name'=>'TURKEY','code'=>'90'),
    'TT'=>array('name'=>'TRINIDAD AND TOBAGO','code'=>'1868'),
    'TV'=>array('name'=>'TUVALU','code'=>'688'),
    'TW'=>array('name'=>'TAIWAN, PROVINCE OF CHINA','code'=>'886'),
    'TZ'=>array('name'=>'TANZANIA, UNITED REPUBLIC OF','code'=>'255'),
    'UA'=>array('name'=>'UKRAINE','code'=>'380'),
    'UG'=>array('name'=>'UGANDA','code'=>'256'),
    'US'=>array('name'=>'UNITED STATES','code'=>'1'),
    'UY'=>array('name'=>'URUGUAY','code'=>'598'),
    'UZ'=>array('name'=>'UZBEKISTAN','code'=>'998'),
    'VA'=>array('name'=>'HOLY SEE (VATICAN CITY STATE)','code'=>'39'),
    'VC'=>array('name'=>'SAINT VINCENT AND THE GRENADINES','code'=>'1784'),
    'VE'=>array('name'=>'VENEZUELA','code'=>'58'),
    'VG'=>array('name'=>'VIRGIN ISLANDS, BRITISH','code'=>'1284'),
    'VI'=>array('name'=>'VIRGIN ISLANDS, U.S.','code'=>'1340'),
    'VN'=>array('name'=>'VIET NAM','code'=>'84'),
    'VU'=>array('name'=>'VANUATU','code'=>'678'),
    'WF'=>array('name'=>'WALLIS AND FUTUNA','code'=>'681'),
    'WS'=>array('name'=>'SAMOA','code'=>'685'),
    'XK'=>array('name'=>'KOSOVO','code'=>'381'),
    'YE'=>array('name'=>'YEMEN','code'=>'967'),
    'YT'=>array('name'=>'MAYOTTE','code'=>'262'),
    'ZA'=>array('name'=>'SOUTH AFRICA','code'=>'27'),
    'ZM'=>array('name'=>'ZAMBIA','code'=>'260'),
    'ZW'=>array('name'=>'ZIMBABWE','code'=>'263')
);

/*
* Country Array to HTML Select List
* Developed By: Jose Philip Raja - www.josephilipraja.com
* About Author: Creative Director of CreaveLabs IT Solutions - www.creavelabs.com
*
* Usage:
*   echo countrySelector(); // Basic
*   echo countrySelector("IN"); // Set default Country with its code
*   echo countrySelector("IN", "my-country", "my-country", "form-control"); // With full Options
*
*/
function countrySelector($defaultCountry = "", $id = "", $name = "", $classes = ""){
    global $countryArray; // Assuming the array is placed above this function
    
    $output = "<select id='".$id."' name='".$name."' class='".$classes."'>";
    
    foreach($countryArray as $code => $country){
        $countryName = ucwords(strtolower($country["name"])); // Making it look good
        $output .= "<option value='".$country["code"]."' ".(($code==strtoupper($defaultCountry))?"selected":"").">".$countryName." (+".$country["code"].")</option>";
    }
    
    $output .= "</select>";
    
    return $output; // or echo $output; to print directly
}

$fromArray =  array( "12:00 am" => "12:00 am", "12:15 am" => "12:15 am", "12:30 am" => "12:30 am", "12:45 am" => "12:45 am", "1:00 am" => "1:00 am", "1:15 am" => "1:15 am", "1:30 am" => "1:30 am", "1:45 am " => "1:45 am", "2:00 am" => "2:00 am", "2:15 am" => "2:15 am", "2:30 am" => "2:30 am", "2:45 am" => "2:45 am", "3:00 am" => "3:00 am", "3:15 am" => "3:15 am", "3:30 am" => "3:30 am", "3:45 am" => "3:45 am", "4:00 am" => "4:00 am", "4:15 am" => "4:15 am", "4:30 am" => "4:30 am", "4:45 am" => "4:45 am", "5:00 am" => "5:00 am", "5:15 am" => "5:15 am", "5:30 am" => "5:30 am", "5:45 am" => "5:45 am", "6:00 am" => "6:00 am", "6:15 am" => "6:15 am", "6:30 am" => "6:30 am", "6:45 am" => "6:45 am", "7:00 am" => "7:00 am", "7:15 am" => "7:15 am", "7:30 am" => "7:30 am", "7:45 am" => "7:45 am", "8:00 am" => "8:00 am", "8:15 am" => "8:15 am", "8:30 am" => "8:30 am", "8:45 am" => "8:45 am", "9:00 am" => "9:00 am", "9:15 am" => "9:15 am", "9:30 am" => "9:30 am", "9:45 am" => "9:45 am", "10:00 am" => "10:00 am", "10:15 am" => "10:15 am", "10:30 am" => "10:30 am", "10:45 am" => "10:45 am","11:00 am" => "11:00 am", "11:15 am" => "11:15 am", "11:30 am" => "11:30 am", "11:45 am" => "11:45 am", "12:00 pm" => "12:00 pm",  "12:15 pm" => "12:15 pm", "12:30 pm" => "12:30 pm", "12:45 pm" => "12:45 pm", "1:00 pm" => "1:00 pm", "1:15 pm" => "1:15 pm", "1:30 pm" => "1:30 pm", "1:45 pm" => "1:45 pm", "2:00 pm" => "2:00 pm", "2:15 pm" => "2:15 pm", "2:30 pm" => "2:30 pm", "2:45 pm" => "2:45 pm", "3:00 pm" => "3:00 pm", "3:15 pm" => "3:15 pm", "3:30 pm" => "3:30 pm", "3:45 pm" => "3:45 pm", "4:00 pm" => "4:00 pm", "4:15 pm" => "4:15 pm", "4:30 pm" => "4:30 pm", "4:45 pm" => "4:45 pm", "5:00 pm" => "5:00 pm", "5:15 pm" => "5:15 pm", "5:30 pm" => "5:30 pm", "5:45 pm" => "5:45 pm", "6:00 pm" => "6:00 pm", "6:15 pm" => "6:15 pm", "6:30 pm" => "6:30 pm", "6:45 pm" => "6:45 pm", "7:00 pm" => "7:00 pm", "7:15 pm" => "7:15 pm", "7:30 pm" => "7:30 pm", "7:45 pm" => "7:45 pm", "8:00 pm" => "8:00 pm", "8:15 pm" => "8:15 pm", "8:30 pm" => "8:30 pm", "8:45 pm" => "8:45 pm", "9:00 pm" => "9:00 pm", "9:15 pm" => "9:15 pm", "9:30 pm" => "9:30 pm", "9:45 pm" => "9:45 pm", "10:00 pm" => "10:00 pm", "10:15 pm" => "10:15 pm", "10:30 pm" => "10:30 pm", "10:45 pm" => "10:45 pm","11:00 pm" => "11:00 pm", "11:15 pm" => "11:15 pm" );

$toArray =  array( "12:00 am" => "12:00 am", "12:15 am" => "12:15 am", "12:30 am" => "12:30 am", "12:45 am" => "12:45 am", "1:00 am" => "1:00 am", "1:15 am" => "1:15 am", "1:30 am" => "1:30 am", "1:45 am " => "1:45 am", "2:00 am" => "2:00 am", "2:15 am" => "2:15 am", "2:30 am" => "2:30 am", "2:45 am" => "2:45 am", "3:00 am" => "3:00 am", "3:15 am" => "3:15 am", "3:30 am" => "3:30 am", "3:45 am" => "3:45 am", "4:00 am" => "4:00 am", "4:15 am" => "4:15 am", "4:30 am" => "4:30 am", "4:45 am" => "4:45 am", "5:00 am" => "5:00 am", "5:15 am" => "5:15 am", "5:30 am" => "5:30 am", "5:45 am" => "5:45 am", "6:00 am" => "6:00 am", "6:15 am" => "6:15 am", "6:30 am" => "6:30 am", "6:45 am" => "6:45 am", "7:00 am" => "7:00 am", "7:15 am" => "7:15 am", "7:30 am" => "7:30 am", "7:45 am" => "7:45 am", "8:00 am" => "8:00 am", "8:15 am" => "8:15 am", "8:30 am" => "8:30 am", "8:45 am" => "8:45 am", "9:00 am" => "9:00 am", "9:15 am" => "9:15 am", "9:30 am" => "9:30 am", "9:45 am" => "9:45 am", "10:00 am" => "10:00 am", "10:15 am" => "10:15 am", "10:30 am" => "10:30 am", "10:45 am" => "10:45 am","11:00 am" => "11:00 am", "11:15 am" => "11:15 am", "11:30 am" => "11:30 am", "11:45 am" => "11:45 am", "12:00 pm" => "12:00 pm",  "12:15 pm" => "12:15 pm", "12:30 pm" => "12:30 pm", "12:45 pm" => "12:45 pm", "1:00 pm" => "1:00 pm", "1:15 pm" => "1:15 pm", "1:30 pm" => "1:30 pm", "1:45 pm" => "1:45 pm", "2:00 pm" => "2:00 pm", "2:15 pm" => "2:15 pm", "2:30 pm" => "2:30 pm", "2:45 pm" => "2:45 pm", "3:00 pm" => "3:00 pm", "3:15 pm" => "3:15 pm", "3:30 pm" => "3:30 pm", "3:45 pm" => "3:45 pm", "4:00 pm" => "4:00 pm", "4:15 pm" => "4:15 pm", "4:30 pm" => "4:30 pm", "4:45 pm" => "4:45 pm", "5:00 pm" => "5:00 pm", "5:15 pm" => "5:15 pm", "5:30 pm" => "5:30 pm", "5:45 pm" => "5:45 pm", "6:00 pm" => "6:00 pm", "6:15 pm" => "6:15 pm", "6:30 pm" => "6:30 pm", "6:45 pm" => "6:45 pm", "7:00 pm" => "7:00 pm", "7:15 pm" => "7:15 pm", "7:30 pm" => "7:30 pm", "7:45 pm" => "7:45 pm", "8:00 pm" => "8:00 pm", "8:15 pm" => "8:15 pm", "8:30 pm" => "8:30 pm", "8:45 pm" => "8:45 pm", "9:00 pm" => "9:00 pm", "9:15 pm" => "9:15 pm", "9:30 pm" => "9:30 pm", "9:45 pm" => "9:45 pm", "10:00 pm" => "10:00 pm", "10:15 pm" => "10:15 pm", "10:30 pm" => "10:30 pm", "10:45 pm" => "10:45 pm","11:00 pm" => "11:00 pm", "11:15 pm" => "11:15 pm" );


$user = stm_get_user_custom_fields('');
$user_id = $user['user_id'];

$selectedCountry = get_the_author_meta('billing_country', $user_id);
$stm_video_url = get_the_author_meta('stm_video_url', $user_id);
$stm_video_url_2 = get_the_author_meta('stm_video_url_2', $user_id);
$stm_video_url_3 = get_the_author_meta('stm_video_url_3', $user_id);
$stm_video_url_4 = get_the_author_meta('stm_video_url_4', $user_id);
$stm_video_url_5 = get_the_author_meta('stm_video_url_5', $user_id);
$working_monday = get_the_author_meta('working_monday', $user_id);
$working_thesday = get_the_author_meta('working_thesday', $user_id);
$working_wednesday = get_the_author_meta('working_wednesday', $user_id);
$working_thursday = get_the_author_meta('working_thursday', $user_id);
$working_friday = get_the_author_meta('working_friday', $user_id);
$weekday_from = get_user_meta($user_id, 'weekday_from', true);
$weekday_to = get_user_meta($user_id, 'weekday_to', true);
$working_saturday = get_the_author_meta('working_saturday', $user_id);
$saturday_from = get_the_author_meta('saturday_from', $user_id);
$saturday_to = get_the_author_meta('saturday_to', $user_id);
$working_sunday = get_the_author_meta('working_sunday', $user_id);
$sunday_from = get_the_author_meta('sunday_from', $user_id);
$sunday_to = get_the_author_meta('sunday_to', $user_id);
$banner = get_the_author_meta( 'stm_dealer_banner', $user_id );
$stm_ebay_acc =get_user_meta( $user_id, 'stm_ebay_acc', true );
$stm_facebook_acc =get_user_meta( $user_id, 'stm_facebook_acc', true );
$stm_twitter_acc =get_user_meta( $user_id, 'stm_twitter_acc', true );
$stm_instagram_acc =get_user_meta( $user_id, 'stm_instagram_acc', true );
$stm_youtube_acc =get_user_meta( $user_id, 'stm_youtube_acc', true );


if (isset($_POST['stm_business_description'])) {

    $user_id = $user['user_id'];

    $metas = array(
        'stm_seller_notes'   => $_POST['stm_business_description'],
        'stm_dealer_location'   => $_POST['stm_business_address'],
        'stm_phone'   => $_POST['stm_business_contact_no'],
        'stm_whatsapp'   => $_POST['stm_business_whatsapp_no'],
        'stm_website_url'   => $_POST['stm_website_link'],
		'billing_address_1'   => $_POST['billing_address_1'],
		'billing_address_2'   => $_POST['billing_address_2'],
		'billing_city'   => $_POST['billing_city'],
		'billing_state'   => $_POST['billing_state'],
		'billing_postal_code'   => $_POST['billing_postal_code'],
		'billing_country'   => $_POST['billing_country'],
		'stm_video_url' => $_POST['stm_video_url'],
		'stm_video_url_2' => $_POST['stm_video_url_2'],
		'stm_video_url_3' => $_POST['stm_video_url_3'],
		'stm_video_url_4' => $_POST['stm_video_url_4'],
		'stm_video_url_5' => $_POST['stm_video_url_5'],
		'working_monday' => $_POST['working_monday'],
		'working_thesday' => $_POST['working_thesday'],
		'working_wednesday' => $_POST['working_wednesday'],
		'working_thursday' => $_POST['working_thursday'],
		'working_friday' => $_POST['working_friday'],
		'weekday_from' => $_POST['weekday_from'],
		'weekday_to' => $_POST['weekday_to'],
		'working_saturday' => $_POST['working_saturday'],
		'saturday_from' => $_POST['saturday_from'],
		'saturday_to' => $_POST['saturday_to'],
		'working_sunday' => $_POST['working_sunday'],
		'sunday_from' => $_POST['sunday_from'],
		'sunday_to' => $_POST['sunday_to'],
        'stm_ebay_acc' => $_POST['stm_ebay_acc'],
        'stm_ebay_acc' => $_POST['stm_ebay_acc'],
        'stm_facebook_acc' => $_POST['stm_facebook_acc'],
        'stm_twitter_acc' => $_POST['stm_twitter_acc'],
        'stm_instagram_acc' => $_POST['stm_instagram_acc'],
        'stm_youtube_acc' => $_POST['stm_youtube_acc'],
    );

    foreach ($metas as $key => $value) {
        update_user_meta($user_id, $key, $value);
    }
    
  //  print_r($_POST);

$address = $_POST['billing_address_1']. ", ".$_POST['billing_address_2'];
$wpdb->update('provider_live', array('stm_seller_notes'=> $_POST['stm_business_description'], 
                                    'stm_dealer_location' => $address,
                                    'billing_phone' => $_POST['stm_business_contact_no'] ,
                                    'whatsapp_phone' => $_POST['stm_business_whatsapp_no'] ,
                                    //'stm_dealer_location' => $_POST['stm_business_address'], 
                                    'billing_postcode' => $_POST['billing_postal_code'] ,
                                    'stm_website_url' => $_POST['stm_website_link'] ,
                                    'billing_city' => $_POST['billing_city'] ,
                                    'billing_state' => $_POST['billing_state'] ,
                                    'hd_state' => $_POST['billing_state'] ,
                                    'billing_country' => $_POST['billing_country'] ,
                                    'stm_video_url' => $_POST['stm_video_url'] ,
                                    'stm_video_url_2' => $_POST['stm_video_url_2'] ,
                                    'stm_video_url_3' => $_POST['stm_video_url_3'] ,
                                    'stm_video_url_4' => $_POST['stm_video_url_4'] ,
                                    'stm_video_url_5' => $_POST['stm_video_url_5'] ,
                                    'stm_user_twitter' => $_POST['stm_twitter_acc'] ,

                                    'stm_user_facebook' => $_POST['stm_facebook_acc'] ,
                                    'stm_user_youtube' => $_POST['stm_youtube_acc'] ,


                                ),  array('user_id' => $user_id));
//echo trim($user_id);
//echo $wpdb->last_query;
//echo $wpdb->last_error;
//die;


	//Editing/adding user filled fields
	/*Image changing*/
	$allowed = array('jpg','jpeg','png');

	if (!empty($_FILES['stm-avatar'])){
		$file = $_FILES['stm-avatar'];
		if (is_array($file) and !empty($file['name'])){
			$ext = pathinfo($file['name']);
			$ext = $ext['extension'];
			if (in_array($ext, $allowed)){
				$upload_dir = wp_upload_dir();
				$upload_url = $upload_dir['url'];
				$upload_path = $upload_dir['path'];

				/*Upload full image*/
				if (!function_exists('wp_handle_upload')){
					require_once (ABSPATH . 'wp-admin/includes/file.php');
				}
				$original_file = wp_handle_upload($file, array(
					'test_form' => false
				));
				
				// print_r($original_file);
				// echo "<br>";

				if (!is_wp_error($original_file)){
					$image_user = $original_file['file'];
					
					/*Crop image to square from full image*/
					//$image_cropped = image_make_intermediate_size($image_user, 236, 60, true);
					
					// /*Delete full image*/
					// if (file_exists($image_user)){
						// unlink($image_user);
					// }

					// /*Get path and url of cropped image*/
					// $user_new_image_url = $upload_url . '/' . $image_cropped['file'];
					// $user_new_image_path = $upload_path . '/' . $image_cropped['file'];
					
					/*Get path and url of image*/
					$user_new_image_url = $upload_url . '/' . basename($image_user);
					$user_new_image_path = $upload_path . '/' . basename($image_user);
					
					// echo "+++".$user_new_image_url."<br>";
					// echo "++++".$user_new_image_path."<br>";
					// die;
					
					/*Delete from site old avatar*/
					$user_old_avatar = get_the_author_meta('stm_dealer_logo_path', $user_id);
					if (!empty($user_old_avatar) and $user_new_image_path != $user_old_avatar and file_exists($user_old_avatar)){
						/*Check if prev avatar exists in another users except current user*/
						$args = array(
							'meta_key' => 'stm_dealer_logo_path',
							'meta_value' => $user_old_avatar,
							'meta_compare' => '=',
							'exclude' => array(
								$user_id
							) ,
						);
						$users_db = get_users($args);
						if (empty($users_db)){
							unlink($user_old_avatar);
						}
					}

					/*Set new image tmp*/
					$user['image'] = $user_new_image_url;

					/*Update user meta path and url image*/
					update_user_meta($user_id, 'stm_dealer_logo', $user_new_image_url);
					update_user_meta($user_id, 'stm_dealer_logo_path', $user_new_image_path);
                    $wpdb->update('provider_live', array('stm_dealer_logo'=> $user_new_image_url ),  array('user_id' => $user_id));



	?>
					<script>
						jQuery(document).ready(function () {
							jQuery('.stm-user-avatar').html('<img src="<?php //echo esc_url($user_new_image_url); ?>" class="img-avatar img-responsive">');
						})
					</script>
	<?php
				}

			}else{
				$got_error_validation = true;
				$error_msg = esc_html__('Please load image with right extension (jpg, jpeg, png)', 'motors');
			}
		}
	}

    if( empty($_FILES['stm-avatar']['name']) ){
		if (!empty($_POST['stm_remove_dealer_logo']) and $_POST['stm_remove_dealer_logo'] == 'delete'){
			$user_old_avatar = get_the_author_meta('stm_dealer_logo_path', $user_id);
			/*Check if prev avatar exists in another users except current user*/
			$args = array(
				'meta_key' => 'stm_dealer_logo_path',
				'meta_value' => $user_old_avatar,
				'meta_compare' => '=',
				'exclude' => array($user_id) ,
			);
			$users_db = get_users($args);
			if (empty($users_db)){
				unlink($user_old_avatar);
			}
			update_user_meta($user_id, 'stm_dealer_logo', '');
			update_user_meta($user_id, 'stm_dealer_logo_path', '');
            $wpdb->update('provider_live', array('stm_dealer_logo'=> '' ),  array('user_id' => $user_id));
			$user['image'] = '';
		}
	}
	
	/*** banner code start ***/
    if (!empty($_FILES['stm-banner'])){
        $file = $_FILES['stm-banner'];
        if (is_array($file) and !empty($file['name'])){
            $ext = pathinfo($file['name']);
            $ext = $ext['extension'];
            if (in_array($ext, $allowed)){
                $upload_dir = wp_upload_dir();
                $upload_url = $upload_dir['url'];
                $upload_path = $upload_dir['path'];

                /*Upload full image*/
                if (!function_exists('wp_handle_upload')){
                    require_once (ABSPATH . 'wp-admin/includes/file.php');
                }
                $original_file = wp_handle_upload($file, array(
                    'test_form' => false
                ));

                if (!is_wp_error($original_file)){
                    $image_user = $original_file['file'];
                    
					// /*Crop image to square from full image*/
                    // $image_cropped = image_make_intermediate_size($image_user, 236, 60, true);
					
                    // /*Delete full image*/
                    // if (file_exists($image_user)){
                        // unlink($image_user);
                    // }

                    // /*Get path and url of cropped image*/
                    // $user_new_image_url = $upload_url . '/' . $image_cropped['file'];
                    // $user_new_image_path = $upload_path . '/' . $image_cropped['file'];
					
					/*Get path and url of image*/
					$user_new_image_url = $upload_url . '/' . basename($image_user);
					$user_new_image_path = $upload_path . '/' . basename($image_user);

                    /*Delete from site old avatar*/
                    $user_old_avatar = get_the_author_meta('stm_dealer_banner_path', $user_id);
                    if (!empty($user_old_avatar) and $user_new_image_path != $user_old_avatar and file_exists($user_old_avatar)){
                        /*Check if prev avatar exists in another users except current user*/
                        $args = array(
                            'meta_key' => 'stm_dealer_banner_path',
                            'meta_value' => $user_old_avatar,
                            'meta_compare' => '=',
                            'exclude' => array(
                                $user_id
                            ) ,
                        );
                        $users_db = get_users($args);
                        if (empty($users_db)){
                            unlink($user_old_avatar);
                        }
                    }

                    /*Set new image tmp*/
                    $user['banner'] = $user_new_image_url;

                    /*Update user meta path and url image*/
                    update_user_meta($user_id, 'stm_dealer_banner', $user_new_image_url);
                    update_user_meta($user_id, 'stm_dealer_banner_path', $user_new_image_path);
                    $wpdb->update('provider_live', array('stm_dealer_image'=> $user_new_image_url ),  array('user_id' => $user_id));

    ?>
                    <script>
                        jQuery(document).ready(function () {
                            jQuery('.stm-user-banner').html('<img src="<?php //echo esc_url($user_new_image_url); ?>" class="img-avatar img-responsive">');
                        })
                    </script>
    <?php
                }

            }else{
                $got_error_validation = true;
                $error_msg = esc_html__('Please load image with right extension (jpg, jpeg, png)', 'motors');
            }
        }
    }
	
	if( empty($_FILES['stm-banner']['name']) ){
		if (!empty($_POST['stm_remove_dealer_banner']) and $_POST['stm_remove_dealer_banner'] == 'delete'){
			$user_old_avatar = get_the_author_meta('stm_dealer_banner_path', $user_id);
			/*Check if prev avatar exists in another users except current user*/
			$args = array(
				'meta_key' => 'stm_dealer_banner_path',
				'meta_value' => $user_old_avatar,
				'meta_compare' => '=',
				'exclude' => array($user_id) ,
			);
			$users_db = get_users($args);
			if (empty($users_db)){
				unlink($user_old_avatar);
			}
			update_user_meta($user_id, 'stm_dealer_banner', '');
			update_user_meta($user_id, 'stm_dealer_banner_path', '');
            $wpdb->update('provider_live', array('stm_dealer_image'=> '' ),  array('user_id' => $user_id));
			$user['banner'] = '';
		}
	}
	/*** banner code end ***/
	
	/***** additional images code *****/
	$dealer_hidden_images = '';
	if(!empty($_POST['stm_dealer_hidden_images'])){
		$arrs = explode("," ,$_POST['stm_dealer_hidden_images']);
		foreach($arrs as $arr){
			$attach_url = wp_get_attachment_url( $arr );
			if($attach_url){
				$dealer_hidden_images .= ','.$attach_url;
			}else{
				$dealer_hidden_images .= ','.$arr;
			}
		}
		update_user_meta($user_id, 'stm_dealer_hidden_images', ltrim($dealer_hidden_images , ','));
	}else{
		update_user_meta($user_id, 'stm_dealer_hidden_images', '');
	}

	header('Location: ' . site_url($_SERVER['REQUEST_URI']));

    $message = [
        "type" => "success",
        "text" => 'Profile updated successfully'
    ];
}


//echo "+++".get_user_meta($user_id,'stm_dealer_location',true);
	
?>

<div class="content-padding gray-bkg vendor-policies directory-listing">
    <div class="notice-wrapper">
    </div>
    <div class="row">

        <form action="<?php echo esc_url(add_query_arg(array('page' => 'directory_listing_details'), stm_get_author_link(''))); ?>" method="post" enctype="multipart/form-data" id="" class="author-form col-md-12">
            <div class="col-md-12">
                <!-- <form method="post" name="shop_settings_form" class="wcmp_policy_form form-horizontal"> -->
                <?php isset($message) ? dispay_message($message) : "" ?>
                <div class="panel panel-default pannel-outer-heading">
                    <div class="panel-heading d-flex">
                        <h2>Business Description</h2>
                    </div>
                    <div class="panel-body panel-content-padding">
                        <div class="form-group d-flex align-items-center">
                            <div class="col-md-12 col-sm-12">
                                <textarea class="form-control" style="height: 300px" name="stm_business_description" id="stm_business_description" placeholder="<?php esc_attr_e('Please provide a description of your business ', 'motors') ?>"><?php echo esc_attr($user['stm_seller_notes']); ?></textarea>
                                <script src="https://cdn.ckeditor.com/4.8.0/full-all/ckeditor.js"></script>
                                <script> 
                                    CKEDITOR.replace('stm_business_description', {
                                        skin: 'moono',
                                        enterMode: CKEDITOR.ENTER_BR,
                                        shiftEnterMode:CKEDITOR.ENTER_P,
                                        toolbar: [{ name: 'basicstyles', groups: [ 'basicstyles' ], items: [ 'Bold', 'Italic', 'Underline', "-", 'TextColor' ] },
                                                    { name: 'links', items: [ 'Link', 'Unlink' ] },
                                                    { name: 'spell', items: [ 'jQuerySpellChecker' ] }
                                                ],
                                        });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default pannel-outer-heading">
                    <div class="panel-heading d-flex">
                        <h2>Business Address</h2>
                    </div>
                    <div class="panel-body panel-content-padding">
                        <div class="form-group d-flex align-items-center">  
                            <label class="control-label col-sm-3 mb-0">Address Line1</label>
                            <div class="col-md-6 col-sm-9">
								<?php if( empty(get_the_author_meta('billing_address_1', $user_id)) ){ ?>
									<input class="form-control" type="text" name="billing_address_1" value="<?php echo get_user_meta($user_id,'stm_dealer_location',true); ?>" placeholder="<?php esc_attr_e('Please provide business address 1', 'motors') ?>" />
								<?php }else{ ?>
									<input class="form-control" type="text" name="billing_address_1" value="<?php echo get_the_author_meta('billing_address_1', $user_id); ?>" placeholder="<?php esc_attr_e('Please provide business address 1', 'motors') ?>" />
								<?php } ?>
								
								<p class="desc">Street address, P.O. box, company name, c/o</p>
                               
                                <!--<textarea class="form-control"  style="height: 150px" name="stm_business_address" placeholder="<?php esc_attr_e('Please provide business address', 'motors') ?>"><?php echo esc_attr($user['location']); ?></textarea>-->
                            </div>
                        </div>
						<div class="form-group d-flex align-items-center">
                            <label class="control-label col-sm-3 mb-0">Address Line2</label>
                            <div class="col-md-6 col-sm-9">
								<input class="form-control" type="text" name="billing_address_2" value="<?php echo get_the_author_meta('billing_address_2', $user_id); ?>" placeholder="<?php esc_attr_e('Please provide business address 2', 'motors') ?>" />
								<p class="desc">Appartment, suite, unit, building, floor, etc.</p>		
                               
							</div>
                        </div>
						<div class="form-group d-flex align-items-center">
                            <label class="control-label col-sm-3 mb-0">City</label>
                            <div class="col-md-6 col-sm-9">
								<input class="form-control" type="text" name="billing_city" value="<?php echo get_the_author_meta('billing_city', $user_id); ?>" placeholder="<?php esc_attr_e('Please provide business city', 'motors') ?>" />	
                               
							</div>
                        </div>
						<div class="form-group d-flex align-items-center">
                            <label class="control-label col-sm-3 mb-0">State/Province/Region</label>
                            <div class="col-md-6 col-sm-9">
								<input class="form-control" type="text" name="billing_state" value="<?php echo get_the_author_meta('billing_state', $user_id); ?>" placeholder="<?php esc_attr_e('Please provide business state', 'motors') ?>" />	
                                
							</div>
                        </div>
						<div class="form-group d-flex align-items-center">
                            <label class="control-label col-sm-3 mb-0">ZIP/Postal Code</label>
                            <div class="col-md-6 col-sm-9">
								<input class="form-control" type="text" name="billing_postal_code" value="<?php echo get_the_author_meta('billing_postal_code', $user_id); ?>" placeholder="<?php esc_attr_e('Please provide business postal code', 'motors') ?>" />	
                                
							</div>
                        </div>
						<div class="form-group d-flex align-items-center">
                            <label class="control-label col-sm-3 mb-0">Country</label>
                            <div class="col-md-6 col-sm-9">
								<select id="billing-country" name="billing_country" class="form-control">
									<option value="">Select Country</option>
									<?php 
										foreach($countryArray as $code => $country){ 
											$countryName = ucwords(strtolower($country["name"])); // Making it look good
									?>										
										<option value="<?php echo $code; ?>" <?php echo $selectedCountry == $code ? 'selected' : '' ?> ><?php echo $countryName; ?></option>
									<?php } ?>							
								</select>
							</div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default pannel-outer-heading">
                    <div class="panel-heading d-flex">
                        <h2>Business Contact Phone Number</h2>
                    </div>
                    <div class="panel-body panel-content-padding">
                        <div class="form-group d-flex align-items-center">
                            <label class="control-label col-sm-3 mb-0">Contact Number</label>
                            <div class="col-md-3 col-sm-2">
                                <?php 
									if( $selectedCountry ){
										echo countrySelector($selectedCountry, "phone-code", "phone-code", "form-control"); 
									}else{
										echo countrySelector("", "phone-code", "phone-code", "form-control"); // Basic 
									}
								?>

                            </div>
                            <div class="col-md-4 col-sm-4">
                                <input type="text" class="form-control" value="<?php echo esc_attr($user['phone']); ?>" name="stm_business_contact_no" placeholder="<?php esc_attr_e('Please provide contact number', 'motors') ?>">
                            </div>
                        </div>
                    </div>

                </div>

                <div class="panel panel-default pannel-outer-heading">
                    <div class="panel-heading d-flex">
                        <h2>Enable What's App Messaging</h2>
                    </div>
                    <div class="panel-body panel-content-padding">
                        <div class="form-group d-flex align-items-center">
                            <label class="control-label col-sm-3 mb-0">What's App Number</label>
                            <div class="col-md-3 col-sm-2">
                                <?php 
									if( $selectedCountry ){
										echo countrySelector($selectedCountry, "phone-code", "phone-code", "form-control"); 
									}else{
										echo countrySelector("", "phone-code", "phone-code", "form-control"); // Basic 
									}
								?>

                            </div>
                            <div class="col-md-4 col-sm-4">
                                <input type="text" class="form-control" value="<?php echo esc_attr($user['whatsapp_phone']); ?>" name="stm_business_whatsapp_no" placeholder="<?php esc_attr_e('Please provide whatsapp number', 'motors') ?>">
                            </div>
                        </div>
                    </div>
                </div>


                <div class="panel panel-default pannel-outer-heading">
                    <div class="panel-heading d-flex">
                        <h2>Link to your website</h2>
                    </div>
                    <div class="panel-body panel-content-padding">
                        <div class="form-group d-flex align-items-center">
                            <label class="control-label col-sm-3 mb-0">Link</label>
                            <div class="col-md-6 col-sm-9">
                                <input type="text" class="form-control" value="<?php echo esc_attr($user['website']); ?>" name="stm_website_link" placeholder="<?php esc_attr_e('Please link your website', 'motors') ?>">
                                <div class="tooltip_s">
								    <a href="#" class="text-inherit mr-3 fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Open facebook and copy your facebok profile page url and paste it here."></a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


                <div class="panel panel-default pannel-outer-heading">
                    <div class="panel-heading d-flex">
                        <h2>Link to ebay shop or url to your e-commerce shop</h2>
                    </div>
                    <div class="panel-body panel-content-padding">
                        <div class="form-group d-flex align-items-center">
                            <label class="control-label col-sm-3 mb-0">Link account</label>
                            <div class="col-md-6 col-sm-9">
                                <input type="text" class="form-control" value="<?php echo $stm_ebay_acc; ?>" name="stm_ebay_acc" placeholder="<?php esc_attr_e('Please link your ebay shop', 'motors') ?>">
                                <div class="tooltip_s">
								    <a href="#" class="text-inherit mr-3 fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Follow on Dribbble"></a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="panel panel-default pannel-outer-heading">
                    <div class="panel-heading d-flex">
                        <h2>Link to amazon shop</h2>
                    </div>
                    <div class="panel-body panel-content-padding">
                        <div class="form-group d-flex align-items-center">
                            <label class="control-label col-sm-3 mb-0">Link to amazon</label>
                            <div class="col-md-6 col-sm-9">
                                <input type="text" class="form-control" name="stm_amazon_acc" placeholder="<?php esc_attr_e('Please link your amazon shop', 'motors') ?>">
                                <div class="tooltip_s">
								    <a href="#" class="text-inherit mr-3 fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Follow on Dribbble"></a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="panel panel-default pannel-outer-heading">
                    <div class="panel-heading d-flex">
                        <h2>Link to Social Media</h2>
                    </div>
                    <div class="panel-body panel-content-padding">
                        <div class="form-group d-flex align-items-center">
                            <label class="control-label col-sm-3 mb-0">Link to facebook</label>
                            <div class="col-md-6 col-sm-9">
                                <input type="text" class="form-control" value="<?php echo $stm_facebook_acc; ?>"   name="stm_facebook_acc" placeholder="<?php esc_attr_e('Please link your Facebook', 'motors') ?>">
                                <div class="tooltip_s">
								    <a href="#" class="text-inherit mr-3 fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Follow on Dribbble"></a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group d-flex align-items-center">
                            <label class="control-label col-sm-3 mb-0">Link to twitter</label>
                            <div class="col-md-6 col-sm-9">
                                <input type="text" class="form-control" value="<?php echo $stm_twitter_acc; ?>"   name="stm_twitter_acc" placeholder="<?php esc_attr_e('Please link your Twitter', 'motors') ?>">
                                <div class="tooltip_s">
								    <a href="#" class="text-inherit mr-3 fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Follow on Dribbble"></a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group d-flex align-items-center">
                            <label class="control-label col-sm-3 mb-0">Link to Instagram</label>
                            <div class="col-md-6 col-sm-9">
                                <input type="text" class="form-control" value="<?php echo $stm_instagram_acc; ?>"   name="stm_instagram_acc" placeholder="<?php esc_attr_e('Please link your Instagram', 'motors') ?>">
                                <div class="tooltip_s">
								    <a href="#" class="text-inherit mr-3 fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Follow on Dribbble"></a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group d-flex align-items-center">
                            <label class="control-label col-sm-3 mb-0">Link to Youtube</label>
                            <div class="col-md-6 col-sm-9">
                                <input type="text" class="form-control" value="<?php echo $stm_youtube_acc; ?>"   name="stm_youtube_acc" placeholder="<?php esc_attr_e('Please link your Youtube', 'motors') ?>">
                                <div class="tooltip_s">
								    <a href="#" class="text-inherit mr-3 fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Follow on Dribbble"></a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="panel panel-default pannel-outer-heading">
                    <div class="panel-heading d-flex">
                        <h2>Add Logo</h2>
                    </div>
                    <div class="panel-body panel-content-padding stm-image-unit-logo">
						
						<?php if (!empty($user['logo'])): ?>
							<div class="image no_empty">
								<i class="fa fa-remove" data-plchdr="<?php stm_get_dealer_logo_placeholder(); ?>"></i>
								<img src="<?php echo esc_url($user['logo']); ?>" class="img-responsive" />
								<script>
									jQuery('document').ready(function () {
										var $ = jQuery;
										$('.stm-image-unit-logo .image .fa-remove').on('click', function () {
											$(this).append('<input type="hidden" value="delete" id="stm_remove_dealer_logo" name="stm_remove_dealer_logo" />');
											$(this).parent().removeClass('no_empty').addClass('private-logo-dealer-placeholder');
											$(this).parent().find('.img-responsive').attr('src', $(this).data('plchdr'));
											$('.stm-user-avatar a .img-avatar').attr('src', $(this).data('plchdr'));
										});
									});
								</script>
							</div>
						<?php else: ?>
							<div class="image private-logo-dealer-placeholder">
								<img src="<?php stm_get_dealer_logo_placeholder(); ?>" class="img-responsive" />
							</div>
						<?php endif; ?>
						
						<div class="form-group d-flex align-items-center">
                            
                            <div class="col-md-6 col-sm-9 stm-new-upload-area">
								<input type="file" name="stm-avatar" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default pannel-outer-heading">
                    <div class="panel-heading d-flex">
                        <h2>Main Banner Image</h2>
                    </div>
                     <div class="panel-body panel-content-padding stm-image-unit-banner">
                        
                        <?php if (!empty($banner)): ?>
                            <div class="image no_empty">
                                <i class="fa fa-remove" data-plchdr="<?php stm_get_dealer_logo_placeholder(); ?>"></i>
                                <img src="<?php echo esc_url($banner); ?>" class="img-responsive" />
                                <script>
                                    jQuery('document').ready(function () {
                                        var $ = jQuery;
                                        $('.stm-image-unit-banner .image .fa-remove').on('click', function () {
                                            $(this).append('<input type="hidden" value="delete" id="stm_remove_dealer_banner" name="stm_remove_dealer_banner" />');
                                            $(this).parent().removeClass('no_empty').addClass('private-banner-dealer-placeholder');
                                            $(this).parent().find('.img-responsive').attr('src', $(this).data('plchdr'));
                                            $('.stm-user-banner a .img-avatar').attr('src', $(this).data('plchdr'));
                                        });
                                    });
                                </script>
                            </div>
                        <?php else: ?>
                            <div class="image private-banner-dealer-placeholder">
                                <img src="<?php stm_get_dealer_logo_placeholder(); ?>" class="img-responsive" />
                            </div>
                        <?php endif; ?>
                        
                        <div class="form-group d-flex align-items-center">
                            
                            <div class="col-md-6 col-sm-9 stm-new-upload-area">
                                <input type="file" name="stm-banner" class="form-control">
                            </div>
                        </div>
                    </div>

                </div>

                <div class="panel panel-default pannel-outer-heading">
                    <div class="panel-heading d-flex">
                        <h2>Add additional images about your business</h2>
                    </div>

                    <div class="panel-body panel-content-padding">
                        <div class="form-group d-flex align-items-center">
                            <label class="control-label col-sm-3 mb-0"></label>
                            <div class="col-md-6 col-sm-9">
								<?php echo do_shortcode('[mwp_dropform]'); ?>
                                <input type="hidden" name="stm_dealer_hidden_images" id="stm_dealer_hidden_images">
                            </div>
                        </div>
                    </div>

                </div>

                <div class="panel panel-default pannel-outer-heading">
                    <div class="panel-heading d-flex">
                        <h2>Add Videos</h2>
                    </div>

                    <div class="panel-body panel-content-padding">

                    <div id="accordion" class="accordion-container">
                        <article class="content-entry">
                                <h4 class="article-title"><i></i><span class="accord_text">To add videos to your profile use the following instructions</span></h4>
                                <div class="accordion-content">
                                        <h3>For Youtube videos go to your video and copy the url displyed in your browser and paste in the field below</h3>
                                        <ul>
                                            <li>- For Facebook</li>
                                            <li>- For Instagram</li>
                                        </ul>
                                </div>
                                <!--/.accordion-content-->
                        </article>
		            </div>
                        <div class="form-group d-flex align-items-center">
                            <label class="control-label col-sm-3 mb-0"> Video 1
                            </label>
                            <div class="col-md-6 col-sm-9">
                            <textarea name="stm_video_url"  placeholder="<?php esc_attr_e('Video URL', 'motors'); ?>"><?php echo esc_attr($stm_video_url); ?></textarea>
                                <div class="tooltip_s">
								    <a href="#" class="text-inherit mr-3 fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Follow on Dribbble"></a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group d-flex align-items-center">
                            <label class="control-label col-sm-3 mb-0"> Video 2
                            </label>
                            <div class="col-md-6 col-sm-9">
								<textarea name="stm_video_url_2"  placeholder="<?php esc_attr_e('Video URL', 'motors'); ?>"><?php echo esc_attr($stm_video_url_2); ?></textarea>
                                <div class="tooltip_s">
								    <a href="#" class="text-inherit mr-3 fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Follow on Dribbble"></a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group d-flex align-items-center">
                            <label class="control-label col-sm-3 mb-0"> Video 3
                            </label>
                            <div class="col-md-6 col-sm-9">
                            <textarea name="stm_video_url_3"  placeholder="<?php esc_attr_e('Video URL', 'motors'); ?>"><?php echo esc_attr($stm_video_url_3); ?></textarea>
                                <div class="tooltip_s">
								    <a href="#" class="text-inherit mr-3 fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Follow on Dribbble"></a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group d-flex align-items-center">
                            <label class="control-label col-sm-3 mb-0"> Video 4
                            </label>
                            <div class="col-md-6 col-sm-9">
                            <textarea name="stm_video_url_4"  placeholder="<?php esc_attr_e('Video URL', 'motors'); ?>"><?php echo esc_attr($stm_video_url_4); ?></textarea>
                                <div class="tooltip_s">
								    <a href="#" class="text-inherit mr-3 fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Follow on Dribbble"></a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group d-flex align-items-center">
                            <label class="control-label col-sm-3 mb-0"> Video 5
                            </label>
                            <div class="col-md-6 col-sm-9">
                            <textarea name="stm_video_url_5"  placeholder="<?php esc_attr_e('Video URL', 'motors'); ?>"><?php echo esc_attr($stm_video_url_5); ?></textarea>
                                <div class="tooltip_s">
								    <a href="#" class="text-inherit mr-3 fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Follow on Dribbble"></a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="panel panel-default pannel-outer-heading">
                    <div class="panel-heading d-flex">
                        <h2>Opening Hours </h2>
                    </div>

                    <div class="panel-body panel-content-padding">
                        <!--<div class="form-group d-flex align-items-center">
                            <label class="control-label col-sm-3 mb-0"> Hours </label>
                            <div class="col-md-6 col-sm-9">
                                <select class="form-control" name="vendor_payment_mode" id="vendor_payment_mode">
                                    <option value="">Opening Hours</option>
                                    <option value="paypal_masspay">1</option>
                                    <option value="stripe_masspay">2</option>
                                </select>
                            </div>
                        </div>-->
						<div class="form-group d-flex align-items-center">
                            <label class="control-label col-sm-3 mb-0 week-days"> Week Days </label>
                            <div class="col-md-9 col-sm-9 days_week">
                                <div class="row">
									<div class="col-md-2">
										<label>
											<input type="checkbox" name="working_monday" value='Monday' <?php if($working_monday){ echo "checked"; } ?>/>
											<span>Monday</span>
										</label>
									</div>
									<div class="col-md-2">
										<label>
											<input type="checkbox" name="working_thesday" value='Tuesday' <?php if($working_thesday){ echo "checked"; } ?>/>
											<span>Tuesday</span>
										</label>
									</div>
									<div class="col-md-2">
										<label>
											<input type="checkbox" name="working_wednesday" value='Wednesday' <?php if($working_wednesday){ echo "checked"; } ?>/>
											<span>Wednesday</span>
										</label>
									</div>
									<div class="col-md-2">
										<label>
											<input type="checkbox" name="working_thursday" value='Thursday' <?php if($working_thursday){ echo " checked "; } ?>/>
											<span>Thursday</span>
										</label>
									</div>
									<div class="col-md-2">
										<label>
											<input type="checkbox" name="working_friday" value='Friday' <?php if($working_friday){ echo " checked "; } ?>/>
											<span>Friday</span>
										</label>
									</div>
								</div>
                            </div>
                        </div>
						<div class="form-group d-flex align-items-center">
                            <label class="control-label col-sm-3 mb-0"> Week Days From </label>
							<div class="col-md-6 col-sm-9">
								<select name="weekday_from" id="weekday_from" class="form-control">
								<?php foreach($fromArray as $key => $from){ ?>
									<option value="<?php echo $key; ?>" <?php echo $weekday_from == $key ? 'selected' : '' ?>><?php echo $from; ?></option>
								<?php } ?>
								</select>
							</div>
						</div>
						<div class="form-group d-flex align-items-center">
                            <label class="control-label col-sm-3 mb-0"> Week Days To </label>
							<div class="col-md-6 col-sm-9">
								<select name="weekday_to" id="weekday_to" class="form-control">
								<?php foreach($toArray as $key => $to){ ?>
									<option value="<?php echo $key; ?>" <?php echo $weekday_to == $key ? 'selected' : '' ?>><?php echo $to; ?></option>
								<?php } ?>
								</select>
							</div>
						</div>
						<div class="form-group d-flex align-items-center">
							 <h2 class="control-label col-sm-3 mb-0">Weekends</h2>
						</div>
						<div class="form-group d-flex align-items-center">
							<div class="col-md-12 col-sm-12"> 
								<div class="row">
                                    <div class="col-md-3">
										<label>
											<input type="checkbox" name="working_saturday" value='Saturday' <?php if($working_saturday){ echo "checked"; } ?>/>
											<span>Saturday</span>
										</label>
									</div>
									<div class="col-md-4">
										<label class="control-label">From</label>
										<select name="saturday_from" id="saturday_from" class="form-control">
										<?php foreach($fromArray as $key => $from){ ?>
											<option value="<?php echo $key; ?>" <?php echo $saturday_from == $key ? 'selected' : '' ?>><?php echo $from; ?></option>
										<?php } ?>
										</select>
									</div>
									<div class="col-md-4">
										<label class="control-label">To</label>
										<select name="saturday_to" id="saturday_to" class="form-control">
										<?php foreach($toArray as $key => $to){ ?>
											<option value="<?php echo $key; ?>" <?php echo $saturday_to == $key ? 'selected' : '' ?>><?php echo $to; ?></option>
										<?php } ?>
										</select>
									</div>
								</div>
								<div class="row">
                                    <div class="col-md-3">
										<label>
											<input type="checkbox" name="working_sunday" value='Sunday' <?php if($working_sunday){ echo "checked"; } ?>/>
											<span>Sunday</span>
										</label>
									</div>
									<div class="col-md-4">
										<label class="control-label">From</label>
										<select name="sunday_from" id="sunday_from" class="form-control">
										<?php foreach($fromArray as $key => $from){ ?>
											<option value="<?php echo $key; ?>" <?php echo $sunday_from == $key ? 'selected' : '' ?>><?php echo $from; ?></option>
										<?php } ?>
										</select>
									</div>
									<div class="col-md-4">
										<label class="control-label">To</label>
										<select name="sunday_to" id="sunday_to" class="form-control">
										<?php foreach($toArray as $key => $to){ ?>
											<option value="<?php echo $key; ?>" <?php echo $sunday_to == $key ? 'selected' : '' ?>><?php echo $to; ?></option>
										<?php } ?>
										</select>
									</div>
								</div>
							</div>
							
						</div>
						
                    </div>

                </div>


                <div class="wcmp-action-container">
                    <button class="btn btn-default" type="submit">Save Changes</button>
                    <div class="clear"></div>
                </div>
        </form>
    </div>



    </form>
</div>
</div>
