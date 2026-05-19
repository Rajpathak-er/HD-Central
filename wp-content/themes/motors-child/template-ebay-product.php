<?php 

/* Template Name: Ebay CSV Template Product */ 




// ERROR_REPORTING(E_ALL);
// ini_set('display_errors', '1'); 


// $args = array(
    
    // 'orderby' => 'user_nicename',
    // 'order'   => 'ASC'
// );
// $users = get_users( $args );

// foreach ( $users as $user ) {
    // echo $user->ID;
    // //$user_update = update_user_meta($user->ID, 'hd_state', 'England');
	// print_r(get_user_meta($user->ID));
	 // // $u = new WP_User( $user->ID );
	  // // $meta  = get_user_meta($user->ID,'dealer_user_type',true);
	 
		// // // if($meta == 'England'){
		   // // // update_user_meta($user->ID, 'hd_state', 'England');
		// // // }
       
	   // // if($meta == 'service_provider'){
		   // // $u->add_role( 'hd_service_provider' );
	   // // }
	   
	   // // if($meta == 'dealer_service_provider'){
		   // // $u->add_role( 'hd_service_provider_dealer' );
	   // // }
    // // Add role
    
	// echo '<br><br>';
// }

// /* get currency symboles */
// function get_currency_symbol1($cc = 'USD'){
	// $cc = strtoupper($cc);
	// $currency = array(
		// "USD" => "$" , //U.S. Dollar
		// "AUD" => "$" , //Australian Dollar
		// "BRL" => "R$" , //Brazilian Real
		// "CAD" => "C$" , //Canadian Dollar
		// "CZK" => "Kč" , //Czech Koruna
		// "DKK" => "kr" , //Danish Krone
		// "EUR" => "€" , //Euro
		// "HKD" => "&#36" , //Hong Kong Dollar
		// "HUF" => "Ft" , //Hungarian Forint
		// "ILS" => "₪" , //Israeli New Sheqel
		// "INR" => "₹", //Indian Rupee
		// "JPY" => "¥" , //Japanese Yen 
		// "MYR" => "RM" , //Malaysian Ringgit 
		// "MXN" => "&#36" , //Mexican Peso
		// "NOK" => "kr" , //Norwegian Krone
		// "NZD" => "&#36" , //New Zealand Dollar
		// "PHP" => "₱" , //Philippine Peso
		// "PLN" => "zł" ,//Polish Zloty
		// "GBP" => "£" , //Pound Sterling
		// "SEK" => "kr" , //Swedish Krona
		// "CHF" => "Fr" , //Swiss Franc
		// "TWD" => "$" , //Taiwan New Dollar 
		// "THB" => "฿" , //Thai Baht
		// "TRY" => "₺" //Turkish Lira
	// );
	
	// if(array_key_exists($cc, $currency)){
		// return $currency[$cc];
	// }
// }

// //echo "+++".get_currency_symbol1('GBP'); //returns Pound


//die;


ini_set('max_execution_time', 0);
ini_set('default_socket_timeout', 90);
ini_set('memory_limit', '2048M');

$access_token = "";
$client_id = "JohannWi-HDCentra-PRD-ac8eaa0db-6cade1e5";
$client_secret = "PRD-c8eaa0dbc844-1de8-4109-84ca-a8b3";

// Function to perform CURL Request on eBay API
function get_html($url, $cookiefile, $headers, $postarray)
{

    $agent= 'Mozilla/5.0 (Windows NT 6.1; rv:20.0.0) Gecko/20100101 Firefox/A20.0.0';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    //curl_setopt($ch, CURLOPT_VERBOSE, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, $agent);

    if($cookiefile != "")
    {
        curl_setopt($ch, CURLOPT_COOKIEJAR, dirname(__FILE__).'/'.$cookiefile);
        curl_setopt($ch, CURLOPT_COOKIEFILE, dirname(__FILE__).'/'.$cookiefile);
    }

    if(empty($headers))
    {
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
            'Accept-Language: q=0.9,en-US;q=0.8,en;q=0.7',
            'Connection: keep-alive',
            'Content-Type: application/x-www-form-urlencoded; charset=utf-8'
        ));
    }else
    {
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    }

    if(!empty($postarray))
    {

        $post_array = array();
        foreach ($postarray as $key => $value)
        {
            $post_array[] = urlencode($key) . '=' . urlencode($value);
        }
        $post_string = implode('&', $post_array);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);
    }


    curl_setopt($ch, CURLOPT_URL,$url);
    $pageContent = curl_exec($ch);

    curl_close($ch);

    return $pageContent;
}


// Getting Access Token
function get_access_token()
{
    global $access_token, $client_id, $client_secret;
    $headers = array(
    "Content-Type: application/x-www-form-urlencoded",
    "Authorization: Basic ". base64_encode($client_id.":".$client_secret)
    );

    $post_data = array(
        "grant_type"=>"client_credentials",
        "scope"=>"https://api.ebay.com/oauth/api_scope"

    );

    $access_token_content = get_html("https://api.ebay.com/identity/v1/oauth2/token", "", $headers, $post_data);
    $access_token = json_decode($access_token_content, true)["access_token"];
    return $access_token;
}


// Getting Product Details by ID
function get_product_details($item_id)
{
    global $access_token, $client_id, $client_secret;
    // Get Access Token if haven't retrieved before
    $access_token = get_access_token();

    // Try getting product data with existing access_token
    $url = "https://open.api.ebay.com/shopping?callname=GetSingleItem&responseencoding=JSON&appid=JohannWi-HDCentra-PRD-ac8eaa0db-6cade1e5&siteid=0&version=967&IncludeSelector=ItemSpecifics,Description&ItemID=".$item_id;
    $headers = array(
    "X-EBAY-API-IAF-TOKEN:".$access_token
    );

    $post_data = array();
    $product_details = get_html($url, "", $headers, $post_data);

    // If API request failed, refresh Access token & try again
    $response = json_decode($product_details, true);
    if(isset($response["Errors"]["ShortMessage"]))
    if($response["Errors"]["ShortMessage"] == "Invalid token.")
    {
        $access_token = get_access_token();

        $url = "https://open.api.ebay.com/shopping?callname=GetSingleItem&responseencoding=JSON&appid=JohannWi-HDCentra-PRD-ac8eaa0db-6cade1e5&siteid=0&version=967&IncludeSelector=ItemSpecifics,Description&ItemID=".$item_id;
        $headers = array(
        "X-EBAY-API-IAF-TOKEN:".$access_token
        );

        $post_data = array();

        $product_details = get_html($url, "", $headers, $post_data);
    }

    return $product_details;
}


//$data = get_product_details('294490444225');
//$obj_detail = json_decode($data);
//print_r($obj_detail);
//die;


//Edited by rezker (http://www.rezker.com)
    function code_to_country( $code ){

    $code = strtoupper($code);

    $countryList = array(
        'AF' => 'Afghanistan',
        'AX' => 'Aland Islands',
        'AL' => 'Albania',
        'DZ' => 'Algeria',
        'AS' => 'American Samoa',
        'AD' => 'Andorra',
        'AO' => 'Angola',
        'AI' => 'Anguilla',
        'AQ' => 'Antarctica',
        'AG' => 'Antigua and Barbuda',
        'AR' => 'Argentina',
        'AM' => 'Armenia',
        'AW' => 'Aruba',
        'AU' => 'Australia',
        'AT' => 'Austria',
        'AZ' => 'Azerbaijan',
        'BS' => 'Bahamas the',
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
        'BA' => 'Bosnia and Herzegovina',
        'BW' => 'Botswana',
        'BV' => 'Bouvet Island (Bouvetoya)',
        'BR' => 'Brazil',
        'IO' => 'British Indian Ocean Territory (Chagos Archipelago)',
        'VG' => 'British Virgin Islands',
        'BN' => 'Brunei Darussalam',
        'BG' => 'Bulgaria',
        'BF' => 'Burkina Faso',
        'BI' => 'Burundi',
        'KH' => 'Cambodia',
        'CM' => 'Cameroon',
        'CA' => 'Canada',
        'CV' => 'Cape Verde',
        'KY' => 'Cayman Islands',
        'CF' => 'Central African Republic',
        'TD' => 'Chad',
        'CL' => 'Chile',
        'CN' => 'China',
        'CX' => 'Christmas Island',
        'CC' => 'Cocos (Keeling) Islands',
        'CO' => 'Colombia',
        'KM' => 'Comoros the',
        'CD' => 'Congo',
        'CG' => 'Congo the',
        'CK' => 'Cook Islands',
        'CR' => 'Costa Rica',
        'CI' => 'Cote d\'Ivoire',
        'HR' => 'Croatia',
        'CU' => 'Cuba',
        'CY' => 'Cyprus',
        'CZ' => 'Czech Republic',
        'DK' => 'Denmark',
        'DJ' => 'Djibouti',
        'DM' => 'Dominica',
        'DO' => 'Dominican Republic',
        'EC' => 'Ecuador',
        'EG' => 'Egypt',
        'SV' => 'El Salvador',
        'GQ' => 'Equatorial Guinea',
        'ER' => 'Eritrea',
        'EE' => 'Estonia',
        'ET' => 'Ethiopia',
        'FO' => 'Faroe Islands',
        'FK' => 'Falkland Islands (Malvinas)',
        'FJ' => 'Fiji the Fiji Islands',
        'FI' => 'Finland',
        'FR' => 'France, French Republic',
        'GF' => 'French Guiana',
        'PF' => 'French Polynesia',
        'TF' => 'French Southern Territories',
        'GA' => 'Gabon',
        'GM' => 'Gambia the',
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
        'GG' => 'Guernsey',
        'GN' => 'Guinea',
        'GW' => 'Guinea-Bissau',
        'GY' => 'Guyana',
        'HT' => 'Haiti',
        'HM' => 'Heard Island and McDonald Islands',
        'VA' => 'Holy See (Vatican City State)',
        'HN' => 'Honduras',
        'HK' => 'Hong Kong',
        'HU' => 'Hungary',
        'IS' => 'Iceland',
        'IN' => 'India',
        'ID' => 'Indonesia',
        'IR' => 'Iran',
        'IQ' => 'Iraq',
        'IE' => 'Ireland',
        'IM' => 'Isle of Man',
        'IL' => 'Israel',
        'IT' => 'Italy',
        'JM' => 'Jamaica',
        'JP' => 'Japan',
        'JE' => 'Jersey',
        'JO' => 'Jordan',
        'KZ' => 'Kazakhstan',
        'KE' => 'Kenya',
        'KI' => 'Kiribati',
        'KP' => 'Korea',
        'KR' => 'Korea',
        'KW' => 'Kuwait',
        'KG' => 'Kyrgyz Republic',
        'LA' => 'Lao',
        'LV' => 'Latvia',
        'LB' => 'Lebanon',
        'LS' => 'Lesotho',
        'LR' => 'Liberia',
        'LY' => 'Libyan Arab Jamahiriya',
        'LI' => 'Liechtenstein',
        'LT' => 'Lithuania',
        'LU' => 'Luxembourg',
        'MO' => 'Macao',
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
        'MD' => 'Moldova',
        'MC' => 'Monaco',
        'MN' => 'Mongolia',
        'ME' => 'Montenegro',
        'MS' => 'Montserrat',
        'MA' => 'Morocco',
        'MZ' => 'Mozambique',
        'MM' => 'Myanmar',
        'NA' => 'Namibia',
        'NR' => 'Nauru',
        'NP' => 'Nepal',
        'AN' => 'Netherlands Antilles',
        'NL' => 'Netherlands the',
        'NC' => 'New Caledonia',
        'NZ' => 'New Zealand',
        'NI' => 'Nicaragua',
        'NE' => 'Niger',
        'NG' => 'Nigeria',
        'NU' => 'Niue',
        'NF' => 'Norfolk Island',
        'MP' => 'Northern Mariana Islands',
        'NO' => 'Norway',
        'OM' => 'Oman',
        'PK' => 'Pakistan',
        'PW' => 'Palau',
        'PS' => 'Palestinian Territory',
        'PA' => 'Panama',
        'PG' => 'Papua New Guinea',
        'PY' => 'Paraguay',
        'PE' => 'Peru',
        'PH' => 'Philippines',
        'PN' => 'Pitcairn Islands',
        'PL' => 'Poland',
        'PT' => 'Portugal, Portuguese Republic',
        'PR' => 'Puerto Rico',
        'QA' => 'Qatar',
        'RE' => 'Reunion',
        'RO' => 'Romania',
        'RU' => 'Russian Federation',
        'RW' => 'Rwanda',
        'BL' => 'Saint Barthelemy',
        'SH' => 'Saint Helena',
        'KN' => 'Saint Kitts and Nevis',
        'LC' => 'Saint Lucia',
        'MF' => 'Saint Martin',
        'PM' => 'Saint Pierre and Miquelon',
        'VC' => 'Saint Vincent and the Grenadines',
        'WS' => 'Samoa',
        'SM' => 'San Marino',
        'ST' => 'Sao Tome and Principe',
        'SA' => 'Saudi Arabia',
        'SN' => 'Senegal',
        'RS' => 'Serbia',
        'SC' => 'Seychelles',
        'SL' => 'Sierra Leone',
        'SG' => 'Singapore',
        'SK' => 'Slovakia (Slovak Republic)',
        'SI' => 'Slovenia',
        'SB' => 'Solomon Islands',
        'SO' => 'Somalia, Somali Republic',
        'ZA' => 'South Africa',
        'GS' => 'South Georgia and the South Sandwich Islands',
        'ES' => 'Spain',
        'LK' => 'Sri Lanka',
        'SD' => 'Sudan',
        'SR' => 'Suriname',
        'SJ' => 'Svalbard & Jan Mayen Islands',
        'SZ' => 'Swaziland',
        'SE' => 'Sweden',
        'CH' => 'Switzerland, Swiss Confederation',
        'SY' => 'Syrian Arab Republic',
        'TW' => 'Taiwan',
        'TJ' => 'Tajikistan',
        'TZ' => 'Tanzania',
        'TH' => 'Thailand',
        'TL' => 'Timor-Leste',
        'TG' => 'Togo',
        'TK' => 'Tokelau',
        'TO' => 'Tonga',
        'TT' => 'Trinidad and Tobago',
        'TN' => 'Tunisia',
        'TR' => 'Turkey',
        'TM' => 'Turkmenistan',
        'TC' => 'Turks and Caicos Islands',
        'TV' => 'Tuvalu',
        'UG' => 'Uganda',
        'UA' => 'Ukraine',
        'AE' => 'United Arab Emirates',
        'GB' => 'United Kingdom',
        'US' => 'United States',
        'UM' => 'United States Minor Outlying Islands',
        'VI' => 'United States Virgin Islands',
        'UY' => 'Uruguay, Eastern Republic of',
        'UZ' => 'Uzbekistan',
        'VU' => 'Vanuatu',
        'VE' => 'Venezuela',
        'VN' => 'Vietnam',
        'WF' => 'Wallis and Futuna',
        'EH' => 'Western Sahara',
        'YE' => 'Yemen',
        'ZM' => 'Zambia',
        'ZW' => 'Zimbabwe'
    );

    if( !$countryList[$code] ) return $code;
    else return $countryList[$code];
   }

function strip_word_html($text, $allowed_tags = '<a><ul><li><b><i><sup><sub><em><strong><u><br><br/><br /><p><h2><h3><h4><h5><h6>')
{
    mb_regex_encoding('UTF-8');
    //replace MS special characters first
    $search = array('/&lsquo;/u', '/&rsquo;/u', '/&ldquo;/u', '/&rdquo;/u', '/&mdash;/u');
    $replace = array('\'', '\'', '"', '"', '-');
    $text = preg_replace($search, $replace, $text);
    //make sure _all_ html entities are converted to the plain ascii equivalents - it appears
    //in some MS headers, some html entities are encoded and some aren't
    //$text = html_entity_decode($text, ENT_QUOTES, 'UTF-8');
    //try to strip out any C style comments first, since these, embedded in html comments, seem to
    //prevent strip_tags from removing html comments (MS Word introduced combination)
    if(mb_stripos($text, '/*') !== FALSE){
        $text = mb_eregi_replace('#/\*.*?\*/#s', '', $text, 'm');
    }
    //introduce a space into any arithmetic expressions that could be caught by strip_tags so that they won't be
    //'<1' becomes '< 1'(note: somewhat application specific)
    $text = preg_replace(array('/<([0-9]+)/'), array('< $1'), $text);
    $text = strip_tags($text, $allowed_tags);
    //eliminate extraneous whitespace from start and end of line, or anywhere there are two or more spaces, convert it to one
    $text = preg_replace(array('/^\s\s+/', '/\s\s+$/', '/\s\s+/u'), array('', '', ' '), $text);
    //strip out inline css and simplify style tags
    $search = array('#<(strong|b)[^>]*>(.*?)</(strong|b)>#isu', '#<(em|i)[^>]*>(.*?)</(em|i)>#isu', '#<u[^>]*>(.*?)</u>#isu');
    $replace = array('<b>$2</b>', '<i>$2</i>', '<u>$1</u>');
    $text = preg_replace($search, $replace, $text);
    //on some of the ?newer MS Word exports, where you get conditionals of the form 'if gte mso 9', etc., it appears
    //that whatever is in one of the html comments prevents strip_tags from eradicating the html comment that contains
    //some MS Style Definitions - this last bit gets rid of any leftover comments */
    $num_matches = preg_match_all("/\<!--/u", $text, $matches);
    if($num_matches){
        $text = preg_replace('/\<!--(.)*--\>/isu', '', $text);
    }
    $text = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $text);
return $text;
}


//$detail_json = file_get_contents('https://open.api.ebay.com/shopping?callname=GetSingleItem&responseencoding=JSON&appid=JohannWi-HDCentra-PRD-ac8eaa0db-6cade1e5&siteid=0&version=967&IncludeSelector=ItemSpecifics,Description&ItemID=193728956981');
		
//	$obj_detail = json_decode($detail_json);

function removeElementsByTagName($tagName, $document) {
	  $nodeList = $document->getElementsByTagName($tagName);
	  for ($nodeIdx = $nodeList->length; --$nodeIdx >= 0; ) {
	    $node = $nodeList->item($nodeIdx);
	    $node->parentNode->removeChild($node);
	  }
}


function removestypetag($htmlcontent){
	
	// create a new DomDocument object
	$doc = new DOMDocument();

	// load the HTML into the DomDocument object (this would be your source HTML)
	$doc->loadHTML($htmlcontent);
	removeElementsByTagName('script', $doc);
	removeElementsByTagName('style', $doc);
	removeElementsByTagName('link', $doc);

	// output cleaned html
	return $doc->saveHtml();
}

//echo removestypetag($obj_detail->Item->Description);

//die;
	//print_r($obj_detail->Item->Description);
//	$output = strip_word_html($obj_detail->Item->Description);
//	print_r($output);
//	die;



// function to geocode address, it will return false if unable to geocode address
function geocode($address){
 
    // url encode the address
    $address = urlencode($address);
     
    // google map geocode api url
    $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$address}&key=AIzaSyChDqc8vz4Q_nj4B-jk1kGm-q0aDztUf4A";
 
    // get the json response
    $resp_json = file_get_contents($url);
     
    // decode the json
    $resp = json_decode($resp_json, true);
 
    // response status will be 'OK', if able to geocode given address 
    if($resp['status']=='OK'){
 
        // get the important data
        $lati = isset($resp['results'][0]['geometry']['location']['lat']) ? $resp['results'][0]['geometry']['location']['lat'] : "";
        $longi = isset($resp['results'][0]['geometry']['location']['lng']) ? $resp['results'][0]['geometry']['location']['lng'] : "";
        $formatted_address = isset($resp['results'][0]['formatted_address']) ? $resp['results'][0]['formatted_address'] : "";
         
        // verify if data is complete
        if($lati && $longi && $formatted_address){
         
            // put the data in the array
            $data_arr = array();            
             
            array_push(
                $data_arr, 
                    $lati, 
                    $longi, 
                    $formatted_address
                );
             
            return $data_arr;
             
        }else{
            return false;
        }
         
    }
 
    else{
        echo "<strong>ERROR: {$resp['status']}</strong>";
        return false;
    }
}

function get_post_id_by_meta_key_and_value($key, $value) {
	global $wpdb;
	
	$results = $wpdb->get_results( "select post_id, meta_key from  $wpdb->postmeta where meta_key='".$wpdb->escape($key)."' AND meta_value='".$wpdb->escape($value)."'", ARRAY_A );
	
	// echo "<br>".$value."<br>";
	// print_r($results);
	// echo $results[0]."<br>";
	// echo $results[0]['post_id']."<br>";
	// die;
	
	// if (is_array($meta) && !empty($meta) && isset($meta[0])) {
		// return $meta = $meta[0];
	// }
	// if (is_object($meta)) {
		// return $meta->post_id;
	// }else {
		// return false;
	// }
	
	if (is_array($results) && !empty($results) && isset($results[0])) {
		//return $results = $results[0];
		return $results = $results[0]['post_id'];
	}
	if (is_object($results)) {
		return $results->post_id;
	}else {
		return false;
	}
}

function ebay_csv_header(){
	
	$fields = array("No"=>"No", "ItemId"=>"ItemId", "Title"=>"Title", "Price"=>"Price", "Currency Id"=>"Currency Id", "URL"=>"URL", "Gallery URL"=>"Gallery URL", "Listing End Date"=>"Listing End Date", "Listing Status"=>"Listing Status", "Postal Code"=>"Postal Code", "Location"=> "Location", "Country"=>"Country", "Colour"=>"Colour", "Mileage"=>"Mileage", "Power"=>"Power", "Engine Size"=>"Engine Size", "Year"=>"Year", "Manufacturer"=>"Manufacturer", "Model"=>"Model", "Type"=>"Type", "Gears"=>"Gears", "Start Type"=>"Start Type", "Drive Type"=>"Drive Type", "Date of 1st Registration"=>"Date of 1st Registration", "MOT Expiry Date"=>"MOT Expiry Date", "MOT Expiration Date"=>"MOT Expiration Date", "Capacity (cc)"=>"Capacity (cc)", "Fuel"=>"Fuel", "Transmission"=>"Transmission", "Number of Manual Gears"=>"Number of Manual Gears", "Extra Features"=>"Extra Features", "V5 Registration Document"=>"V5 Registration Document", "Previous owners (excl. current)"=>"Previous owners (excl. current)", "Warranty"=>"Warranty", "Modified Item"=>"Modified Item", "Customised Features"=>"Customised Features", "Road Tax Remaining"=>"Road Tax Remaining", "Vehicle Type"=>"Vehicle Type", "Additional Information"=>"Additional Information", "Modification Description"=>"Modification Description", "Performance Upgrades"=>"Performance Upgrades", "Previous owners"=>"Previous owners", "Country/Region of Manufacture"=>"Country/Region of Manufacture", "Metallic Paint"=>"Metallic Paint", "Street Name"=>"Street Name", "Reg. Mark"=>"Reg. Mark", "PictureURL" => "PictureURL","Independent Vehicle Inspection"=>"Independent Vehicle Inspection");
	
	return $fields;
}

$keywords = '';
if( isset($_GET['keywords']) ){
	$keywords = urlencode($_GET['keywords']);
}else{
		//$keywords = urlencode("sportster 1200");
	$keywords = "Harley Davidson";
}

$perpage = '';
if( isset($_GET['perpage']) && !empty($_GET['perpage']) ){
		//$perpage = $_GET['perpage'];
	$perpage = '&paginationInput.entriesPerPage='.$_GET['perpage'];
}else{
	$perpage = '&paginationInput.entriesPerPage=50';
}


$pageno = '';
if( isset($_GET['pageno']) && !empty($_GET['pageno']) ){
		//$pageno = $_GET['pageno'];
	$pageno = '&paginationInput.pageNumber='.$_GET['pageno'];
}else{
	//$pageno = "1";
}

	//echo "keywords: ".$keywords." <br>perpage: ".$perpage." <br>pageno: ".$pageno; die;

	// $endtime = "2020-08-21T05:40:49.000Z";
	// $date = date('Y-m-d H:i:s', strtotime($endtime));
	// echo "+++".$date; die;


function outputCsv($fileName, $assocDataArray){
	ob_clean();
	header('Pragma: public');
	header('Expires: 0');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Cache-Control: private', false);
	header('Content-Type: text/csv');
	header('Content-Disposition: attachment;filename=' . $fileName);    
	if( isset($assocDataArray['0']) ){
		$fp = fopen('php://output', 'w');
			//fputcsv($fp, array_keys($assocDataArray['0']));
		foreach($assocDataArray AS $values){
			fputcsv($fp, $values);
		}
		fclose($fp);
	}
	ob_flush();
}



$curDate = date('Y-m-d');
$filename = $curDate."-ebay.csv";

$newdatatable = array();
$maindata = array();


	//set column headers
$fields = ebay_csv_header();

	// print_r($fields);
	// echo "<br><br><br><br><br>";
	// die;

	$region_array = array(
		array("country_code"=>"EBAY-GB", "ebay_category"=>"9805"),
        array("country_code"=>"EBAY-US", "ebay_category"=>"6024"),
		
		array("country_code"=>"EBAY-AU", "ebay_category"=>"32073"),
		array("country_code"=>"EBAY-AT", "ebay_category"=>"9805"),
		array("country_code"=>"EBAY-CH", "ebay_category"=>"9805"),
		array("country_code"=>"EBAY-DE", "ebay_category"=>"9805"),
		array("country_code"=>"EBAY-ENCA", "ebay_category"=>"49992"),
		array("country_code"=>"EBAY-ES", "ebay_category"=>"9805"),
		array("country_code"=>"EBAY-FR", "ebay_category"=>"180276"),
		array("country_code"=>"EBAY-IT", "ebay_category"=>"9805"),
		array("country_code"=>"EBAY-PL", "ebay_category"=>"9805"),
	);
	$product_Category = array("180028","35559","49790","185062","180029","179853","171107", "180027","179752","178998","180033","180034","178030","178996","183504","177075","177099", "179469","43990", "179421", "179463","179443","183745","62250","179735","180513", "179731", "179715", "183530","179723", "183544" ,"183536","177962");
	$ra_random_index = array_rand($product_Category);
    echo $ra_random_country = array_rand($region_array);
    
	echo "index: ".$ra_random_index."<br>";
	$country_code = $region_array[$ra_random_country]['country_code'];
	echo $ebay_category = $product_Category[$ra_random_index];
	//$country_code = "EBAY-GB";
    //$ebay_category = "177962";
    


	// $json = file_get_contents('https://svcs.ebay.com/services/search/FindingService/v1?OPERATION-NAME=findCompletedItems&SERVICE-VERSION=1.0.0&SECURITY-APPNAME=JohannWi-HDCentra-PRD-ac8eaa0db-6cade1e5&RESPONSE-DATA-FORMAT=JSON&REST-PAYLOAD&keywords='.$keywords.'&GLOBAL-ID=EBAY-GB&categoryId=9805&paginationInput.entriesPerPage='.$perpage.'&paginationInput.pageNumber='.$pageno);
//echo 'https://svcs.ebay.com/services/search/FindingService/v1?OPERATION-NAME=findItemsByCategory&SERVICE-VERSION=1.0.0&SECURITY-APPNAME=JohannWi-HDCentra-PRD-ac8eaa0db-6cade1e5&RESPONSE-DATA-FORMAT=JSON&REST-PAYLOAD&keywords='.$keywords.'&GLOBAL-ID=EBAY-GB&categoryId=9805'.$perpage.$pageno;


function curl_get_contents($url)
{
    $ch = curl_init();

    curl_setopt_array($ch,array(
		  CURLOPT_URL => $url,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 500000,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'GET',
		));

    $data = curl_exec($ch);
	$err = curl_error($ch);
    curl_close($ch);
		
	if ($err) {
		echo "cURL Error properties #:" . $err;
	}  
    return $data;
}

// Create a stream

echo $url ='https://svcs.ebay.com/services/search/FindingService/v1?OPERATION-NAME=findItemsAdvanced&SERVICE-VERSION=1.0.0&SECURITY-APPNAME=JohannWi-HDCentra-PRD-ac8eaa0db-6cade1e5&RESPONSE-DATA-FORMAT=JSON&outputSelector(0)=PictureURLLarge&outputSelector(1)=PictureURLSuperSize&outputSelector(2)=GalleryInfo&REST-PAYLOAD&keywords='.rawurlencode($keywords).'&GLOBAL-ID='.$country_code.'&categoryId='.$ebay_category.$perpage.$pageno;
// https://svcs.ebay.com/services/search/FindingService/v1?OPERATION-NAME=findItemsByCategory&SERVICE-VERSION=1.0.0&SECURITY-APPNAME=JohannWi-HDCentra-PRD-ac8eaa0db-6cade1e5&RESPONSE-DATA-FORMAT=JSON&REST-PAYLOAD&keywords=Harley Davidson&GLOBAL-ID=EBAY-GB&categoryId=9805
$json = curl_get_contents($url);

//US - 49992

	// echo 'https://svcs.ebay.com/services/search/FindingService/v1?OPERATION-NAME=findCompletedItems&SERVICE-VERSION=1.0.0&SECURITY-APPNAME=JohannWi-HDCentra-PRD-ac8eaa0db-6cade1e5&RESPONSE-DATA-FORMAT=JSON&REST-PAYLOAD&keywords='.$keywords.'&GLOBAL-ID=EBAY-GB&categoryId=9805'.$perpage.$pageno; 
	// die;


	//var_dump($json);
	//echo "+++".$json."<br>";  
	//$error = error_get_last();
    //echo "HTTP request failed. Error was: " . $error['message'];


$obj = json_decode($json);

//print_r($json);
//die();
echo "<br>count: ".count($obj->findItemsAdvancedResponse[0]->searchResult[0]->item)."<br>";	
$singleData = array();	
$i = 0;	
foreach( $obj->findItemsAdvancedResponse[0]->searchResult[0]->item as $key => $bikedata ) {			
//print_r($bikedata);
    
	$i++;		
	//echo 'https://open.api.ebay.com/shopping?callname=GetSingleItem&responseencoding=JSON&appid=JohannWi-HDCentra-PRD-ac8eaa0db-6cade1e5&siteid=0&version=967&IncludeSelector=ItemSpecifics,Description&ItemID='.$bikedata->itemId[0];
    //echo "<br/><br/>";
	//$detail_json = file_get_contents('https://open.api.ebay.com/shopping?callname=GetSingleItem&responseencoding=JSON&appid=JohannWi-HDCentra-PRD-ac8eaa0db-6cade1e5&siteid=0&version=967&IncludeSelector=ItemSpecifics,Description&ItemID='.$bikedata->itemId[0]);
    $detail_json = get_product_details($bikedata->itemId[0]);
		
    $obj_detail = json_decode($detail_json);
		//echo "+++".$obj_detail->Item->ItemSpecifics->NameValueList;

		echo "title: ".$bikedata->title[0]." price: ".$bikedata->sellingStatus[0]->currentPrice[0]->__value__."<br>";

		// $singleData["No"] = $i;
		// $singleData["Title"] = $bikedata->title[0];
		// $singleData["Price"] = $bikedata->sellingStatus[0]->currentPrice[0]->__value__;
		// $singleData["URL"] = $bikedata->viewItemURL[0];



	$attrArr = array();		
    //echo "<pre>";
    //print_r($bikedata->sellingStatus[0]);
    //echo "</pre>";
    
	$attrArr["No"] = $i;
	$attrArr["ItemId"] = $bikedata->itemId[0];
	$attrArr["Title"] = $bikedata->title[0];
	$attrArr["Price"] = $bikedata->sellingStatus[0]->currentPrice[0]->__value__;
	$attrArr["Currency Id"] = $bikedata->sellingStatus[0]->currentPrice[0]->{'@currencyId'};
	$attrArr["URL"] = $bikedata->viewItemURL[0];
	$attrArr["Gallery URL"] = $bikedata->pictureURLSuperSize[0];
	
	//$obj_detail->Item->ItemSpecifics->
		//$attrArr["Listing End Date"] = $bikedata->listingInfo[0]->endTime[0];
	$attrArr["Listing End Date"] = date('Y-m-d H:i:s', strtotime($bikedata->listingInfo[0]->endTime[0]));
	$attrArr["ListingType"] = $bikedata->listingInfo[0]->listingType[0];

	$attrArr["ConditionDisplayName"] = $bikedata->condition[0]->conditionDisplayName[0];
	$attrArr["Listing Status"] = $obj_detail->Item->ListingStatus;
	$attrArr["PictureURL"] = $bikedata->pictureURLSuperSize[0];;
    $attrArr['PrimaryCategoryName'] = $obj_detail->Item->PrimaryCategoryName;
	$attrArr["Postal Code"] = $bikedata->postalCode[0];
	$attrArr["Location"] = $bikedata->location[0];
	$attrArr["Country"] = $bikedata->country[0];
	$attrArr["Description"] = removestypetag($obj_detail->Item->Description);



	$singleData['ItemSpecifics'] = array();
	foreach ($obj_detail->Item->ItemSpecifics->NameValueList as $key => $itemdata) {
			//echo "<div>".$itemdata->Name.": ".$itemdata->Value[0]."</div>";
		
			//$singleData[$itemdata->Name] = $itemdata->Value[0];
		$attrArr[$itemdata->Name] = $itemdata->Value[0];
        $singleData['ItemSpecifics'][$itemdata->Name] = $itemdata->Value[0];
	}

		 //echo "<pre>";
		 //print_r($attrArr);
		 //echo "</pre><br>";
		 //die;
		// echo "<br>-----------------<br><br>";
		//echo "model: ".$attrArr['Model']."<br>";

	$singleData['PrimaryCategoryName'] = $attrArr['PrimaryCategoryName'];
    $singleData['PictureURL'] = $attrArr['PictureURL'];
	$singleData['ListingType'] = $attrArr['ListingType'];
	$singleData['ConditionDisplayName'] = $attrArr['ConditionDisplayName'];
	$singleData['Description'] = $attrArr['Description'];
	foreach( $fields as $key => $value ){
		if( array_key_exists($key,$attrArr) ){
			$singleData[$key] = $attrArr[$key];
		}else{
			$singleData[$key] = "";
		}
	}
//print_r($fields);
//echo "<pre>";
//		 print_r($singleData);
//		 echo "</pre><br>";
//		 die;

	$maindata[] = $singleData;		
}

	// echo "<pre>";
	// print_r($maindata);
	// echo "</pre><br><br><br>";
	// echo "**************************<br><br>";



$tempraw = array();
foreach( $fields as $key => $value ){
	$tempraw[$key] = $value;
}
//$newdatatable[] = $tempraw;


foreach( $maindata as $singeraw ){
		// $tempraw = array();
		// foreach($fields as $key => $value){
			// if( !empty($singeraw[$key]) ){
				// $tempraw[$key] = $singeraw[$key];
			// }else{
				// $tempraw[$key] = '';
			// }
		// }
		//$newdatatable[] = $tempraw;

	$newdatatable[] = $singeraw;
}


//echo "<pre>"; 
//print_r($newdatatable);
//echo "</pre><br><br>";
//die;
    // output data
//outputCsv($filename, $newdatatable);
    //insertEbayData($newdatatable);
//die;

//echo "<pre>";	
//print_r($newdatatable);
//echo "</pre><br><br>";
//die;
foreach ($newdatatable as $key => $item) {
	

	$post_id = get_post_id_by_meta_key_and_value('_sku',$item['ItemId']);
	//ehco str_replace('United Kingdom', '', $item['Location']);
//die;
	
	

    $option_name = $item['Location'] ;
	$latlong = "";
	 
	if ( get_option( $option_name ) !== false ) {
	 
	    // The option already exists, so update it.
	    //update_option( $option_name, $new_value );
	    $latlong = get_option( $option_name );
	 
	} else {
	 
	    $data_arr = geocode($item['Location']);
 
	    // if able to geocode the address
	    if($data_arr){
	        
	        $latlong .= $data_arr[0]."|";
	        $latlong .= $data_arr[1];
	        add_option( $option_name, $latlong, '', 'yes' );
	       
	    }

	    
	}
        

	$location =  str_replace(",United Kingdom","",$item['Location']);
	$latlongarray = explode("|", $latlong);
	
	if(!$post_id){



		$my_post = array(
			'post_title'    => $item['Title'] ,
			'post_content'  =>  $item['Description'],
			'post_status'   => 'publish',
			'post_author'   => 8183,
			'post_type' => 'product'
		);
		$post_id = wp_insert_post( $my_post );
	}
echo "<br/>product id-".$post_id;

    wp_set_object_terms( $post_id, 'simple', 'product_type' );
    update_post_meta( $post_id, '_visibility', 'visible' );
    update_post_meta( $post_id, '_stock_status', 'instock');
    update_post_meta( $post_id, 'total_sales', '0' );
    update_post_meta( $post_id, '_downloadable', 'no' );

    update_post_meta( $post_id, '_virtual', 'no' );
    update_post_meta( $post_id, '_regular_price', $item['Price'] );
    update_post_meta( $post_id, '_product_url', $item['URL'] );
    
    update_post_meta( $post_id, '_sale_price', '' );
    update_post_meta( $post_id, '_purchase_note', '' );
    update_post_meta( $post_id, 'currency_id', $item['Currency Id'] );
    update_post_meta( $post_id, '_featured', 'no' );
    update_post_meta( $post_id, '_weight', '' );
    update_post_meta( $post_id, '_length', '' );
    update_post_meta( $post_id, '_width', '' );
    update_post_meta( $post_id, '_height', '' );
    update_post_meta( $post_id, 'lat', $latlongarray[0]);
    update_post_meta( $post_id, 'long', $latlongarray[1]);
    update_post_meta( $post_id, '_sku', $item['ItemId'] );
    update_post_meta( $post_id, '_product_attributes', array() );
    update_post_meta( $post_id, '_sale_price_dates_from', '' );
    update_post_meta( $post_id, '_sale_price_dates_to', '' );
    update_post_meta( $post_id, '_price', $item['Price'] );
    update_post_meta( $post_id, '_sold_individually', 'no' );
    update_post_meta( $post_id, '_manage_stock', 'no' );
    update_post_meta( $post_id, '_backorders', 'no' );
    update_post_meta( $post_id, '_stock', '' );
    update_post_meta( $post_id, '_cff_oembed_done_checking', '1' );
    update_post_meta( $post_id, '_commission_per_product', '0' );
    update_post_meta( $post_id, '_download_expiry', '-1' );
    update_post_meta( $post_id, '_download_limit', '-1' );
    update_post_meta( $post_id, '_featured', 'no' );
    update_post_meta( $post_id, '_product_version', '5.1.0' );
    update_post_meta( $post_id, '_tax_class', '' );
    update_post_meta( $post_id, '_tax_status', 'taxable' );
    update_post_meta( $post_id, '_wc_average_rating', '0' );
    update_post_meta( $post_id, '_wc_review_count', '0' );
    update_post_meta( $post_id, '_wcmp_cancallation_policy', '' );
    update_post_meta( $post_id, '_wcmp_refund_policy', '' );
    update_post_meta( $post_id, '_wcmp_seo_product_meta_description', '' );
    update_post_meta( $post_id, '_wcmp_seo_product_meta_keyword', '' );
    update_post_meta( $post_id, '_wcmp_seo_product_meta_title', '' );
    update_post_meta( $post_id, '_wcmp_shipping_policy', '' );
    update_post_meta( $post_id, '_wpb_vc_js_status', 'false' );
    update_post_meta( $post_id, 'total_sales', '0' );
    update_post_meta( $post_id, '_edit_last', '1' );
    update_post_meta( $post_id, 'alignment', 'left' );
    update_post_meta( $post_id, 'breadcrumbs', 'show' );
    update_post_meta( $post_id, 'slide_template', '' );
    update_post_meta( $post_id, 'stm_price_plan_role', 'user' );
    update_post_meta( $post_id, 'stm_title_tag', 'h2' );
    update_post_meta( $post_id, 'title', 'show' );

    echo $country =  code_to_country($item['Country']);
    update_post_meta( $post_id, 'country', $country );
    $product = wc_get_product( $post_id );
    $product->set_sku( $item['ItemId'] );
    $product->set_price( $item['Price'] );
    $product->set_regular_price( $item['Price'] );
    $product->save();




	update_post_meta( $post_id, 'product_type',  'ebay');
	update_post_meta( $post_id, 'featured_image_url', $item['Gallery URL']); 
	update_post_meta( $post_id, 'gallery',  $item['PictureURL']);
	
    echo $item['PrimaryCategoryName'];
    $singlecategory  = explode(":", $item['PrimaryCategoryName']);
    $tag = array();
    foreach($singlecategory as $prod_cat){
        if(!term_exists($prod_cat, 'product_cat')){
           // $term = wp_insert_term($prod_cat, 'product_cat');
           // array_push($tag, $term['term_id']);
        } else {
            $term_s = get_term_by( 'name', $prod_cat, 'product_cat' );
            array_push($tag , $term_s->term_id);
        }
    }
    
    wp_set_object_terms( $post_id, $tag, 'product_cat' );
	
	
	//if( $item['ItemId'] == "254366306696" ){
		//echo "testtt";
		
		// $post_meta = get_post_meta($post_id);
		// echo "<pre>";
		// print_r($post_meta);
		// echo "</pre><br><br>";		
		
		// set attributes
		$data = array();
		$product_attributes = $item['ItemSpecifics'];
		
		
            
		
		foreach($product_attributes as $key => $attributes){
				
			// if( $item['ItemId'] == "162820602974" ){
				// print_r($data);
				// echo "<br>";							
			// }

				
			$attribute_name = "pa_".sanitize_title($key);
			
			$term_taxonomy_ids = wp_set_object_terms($post_id, $attributes, $attribute_name, true);
			
			$data = array(
				$attribute_name => array(
					'name' => $attribute_name,
					'value' => $attributes,
					'is_visible' => '1',
					'is_variation' => '0',
					'is_taxonomy' => '1'
				)
			);
			//First getting the Post Meta
			$_product_attributes = get_post_meta($post_id, '_product_attributes', true);
			
			// echo "<pre>";
			// print_r(array_merge($_product_attributes, $data));
			// echo "</pre>";
			
			// if( $item['ItemId'] == "162820602974" ){
				// echo "++++<br><pre>";
				// print_r($_product_attributes);
				// echo "</pre>------------<br><pre>";			
				// print_r($data);
				// echo "</pre><br>";							
			// }
			
			
			//Updating the Post Meta
			update_post_meta($post_id, '_product_attributes', array_merge($_product_attributes, $data));
			
		}


	
	// }else{
		// echo "nodataa";
	// }
	
	// print_r($item);
    // die;
    
		

}
die;
	// output data
outputCsv($filename, $newdatatable);
	//insertEbayData($newdatatable);


function insertEbayData($newdatatable){

	if( is_array($newdatatable) ){
		
		global $wpdb;
		
		// $result = $wpdb->get_results("SELECT * FROM THrtRebay_records WHERE item_id = 363018534019");
		// print_r($result);
		// echo "<br><br>".count($result)."<br><br>";	
		// die;
		
		$sql = "INSERT INTO THrtRebay_records (ID, item_id, title, price, url, gallery_image, listing_end_date, listing_status, postal_code, location, country, colour, mileage, power, engine_size, year, manufacturer, model, type, gears, start_type, drive_type, date_of_first_registration, mot_expiry_date, mot_expiration_date, capacity, fuel, transmission, number_of_manual_gears, extra_features, v5_registration_document, previous_owners_excl_current, warranty, modified_item, customised_features, road_tax_remaining, vehicle_type, additional_information, modification_description, performance_upgrades, previous_owners, country_of_manufacture, metallic_paint, street_name, reg_mark, independent_vehicle_inspection) values ";

		$valuesArr = array();
		$i = 0;
		foreach($newdatatable as $row){
			if($i != 0){
				
				$item_id = $row['ItemId'];
				$listing_end_date = date('Y-m-d H:i:s', strtotime($row['Listing End Date']));
				
				// $title = $row['Title'];
				// $price = $row['Price'];
				// $url = $row['URL'];
				// $gallery_image = $row['Gallery URL'];				
				// $colour = $row['Colour'];
				// $mileage = $row['Mileage'];
				// $power = $row['Power'];
				// $engine_size = $row['Engine Size'];
				// $year = $row['Year'];
				// $manufacturer = $row['Manufacturer'];
				// $model = $row['Model'];
				// $type = $row['Type'];
				// $gears = $row['Gears'];
				// $start_type = $row['Start Type'];
				// $drive_type = $row['Drive Type'];

				
				//check if record exists in table
				$result = $wpdb->get_results("SELECT * FROM THrtRebay_records WHERE item_id = $item_id");
				
				if( count($result) > 0 ){
					
				}else{				

					$valuesArr[] = "(null, '".$row['ItemId']."', '".addslashes($row['Title'])."', '".$row['Price']."', '".$row['URL']."', '".$row['Gallery URL']."', '".$listing_end_date."', '".$row['Listing Status']."', '".$row['Postal Code']."', '".addslashes($row['Location'])."', '".$row['Country']."', '".$row['Colour']."', '".$row['Mileage']."', '".$row['Power']."', '".$row['Engine Size']."', '".$row['Year']."', '".$row['Manufacturer']."', '".$row['Model']."', '".$row['Type']."', '".$row['Gears']."', '".$row['Start Type']."', '".$row['Drive Type']."', '".$row['Date of 1st Registration']."', '".addslashes($row['MOT Expiry Date'])."', '".addslashes($row['MOT Expiration Date'])."', '".$row['Capacity (cc)']."', '".$row['Fuel']."', '".$row['Transmission']."', '".$row['Number of Manual Gears']."', '".$row['Extra Features']."', '".$row['V5 Registration Document']."', '".$row['Previous owners (excl. current)']."', '".$row['Warranty']."', '".$row['Modified Item']."', '".$row['Customised Features']."', '".$row['Road Tax Remaining']."', '".$row['Vehicle Type']."', '".$row['Additional Information']."', '".$row['Modification Description']."', '".$row['Performance Upgrades']."', '".$row['Previous owners']."', '".$row['Country/Region of Manufacture']."', '".$row['Metallic Paint']."', '".$row['Street Name']."', '".$row['Reg. Mark']."', '".$row['Independent Vehicle Inspection']."')";

				}							
			}
			
			$i++;
		}
		
		//print_r($valuesArr); 
		// die;
		
		if( !empty($valuesArr) ){
			$sql .= implode(',', $valuesArr);
			// echo "<br><br>++".$sql."<br>";
			// die;
			
			$wpdb->query($sql);
		}
		
	}	
}






/****************** OLD CODE MAIN ***************/

	// $keywords = urlencode($_GET['keywords']); 
	// //$json = file_get_contents('https://svcs.ebay.com/services/search/FindingService/v1?OPERATION-NAME=findCompletedItems&SERVICE-VERSION=1.0.0&SECURITY-APPNAME=JohannWi-HDCentra-PRD-ac8eaa0db-6cade1e5&RESPONSE-DATA-FORMAT=JSON&REST-PAYLOAD&keywords='.$keywords.'&GLOBAL-ID=EBAY-GB&categoryId=9805');

	// $json = file_get_contents('https://svcs.ebay.com/services/search/FindingService/v1?OPERATION-NAME=findCompletedItems&SERVICE-VERSION=1.0.0&SECURITY-APPNAME=JohannWi-HDCentra-PRD-ac8eaa0db-6cade1e5&RESPONSE-DATA-FORMAT=JSON&REST-PAYLOAD&keywords='.$keywords.'&GLOBAL-ID=EBAY-GB&categoryId=9805&paginationInput.entriesPerPage=10');

	// $obj = json_decode($json);

	// foreach ($obj->findCompletedItemsResponse[0]->searchResult[0]->item as $key => $bikedata) {

		// $detail_json = file_get_contents('https://open.api.ebay.com/shopping?callname=GetSingleItem&responseencoding=JSON&appid=JohannWi-HDCentra-PRD-ac8eaa0db-6cade1e5&siteid=0&version=967&IncludeSelector=ItemSpecifics&ItemID='.$bikedata->itemId[0]);

		// $obj_detail = json_decode($detail_json);
		// //echo "+++".$obj_detail->Item->ItemSpecifics->NameValueList;

		// echo "<tr><td><a href='".$bikedata->viewItemURL[0]."'>".$bikedata->title[0]."</a></td>";
		// echo "<td>".$bikedata->sellingStatus[0]->currentPrice[0]->__value__." GBP </td>";

		// echo "<td style='width: 180px;'>";
		// //echo "<div>Condition: ".$obj_detail->Item->ConditionDisplayName."</div><div>Seller notes: ".$obj_detail->Item->ConditionDescription."</div>";
		// foreach ($obj_detail->Item->ItemSpecifics->NameValueList as $key => $itemdata) {
			// echo "<div>".$itemdata->Name.": ".$itemdata->Value[0]."</div>";
		// }
		// echo "</td>";

		// echo "</tr>";									
	// }

?>