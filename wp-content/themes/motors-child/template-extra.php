<?php

/* Template Name: Extra */

// ERROR_REPORTING(E_ALL);
// ini_set('display_errors', '1'); 

$args = array(
    
    'orderby' => 'user_nicename',
    'order'   => 'ASC'
);
$users = get_users( $args );

foreach ( $users as $user ) {
    echo $user->ID;
    //$user_update = update_user_meta($user->ID, 'hd_state', 'England');
	print_r(get_user_meta($user->ID));
	 // $u = new WP_User( $user->ID );
	  // $meta  = get_user_meta($user->ID,'dealer_user_type',true);
	 
		// // if($meta == 'England'){
		   // // update_user_meta($user->ID, 'hd_state', 'England');
		// // }
       
	   // if($meta == 'service_provider'){
		   // $u->add_role( 'hd_service_provider' );
	   // }
	   
	   // if($meta == 'dealer_service_provider'){
		   // $u->add_role( 'hd_service_provider_dealer' );
	   // }
    // Add role
    
	echo '<br><br>';
}
die;

	if( isset($_GET['keywords']) ){
		$keywords = urlencode($_GET['keywords']);
	}else{
			//$keywords = urlencode("sportster 1200");
		$keywords = "Harley Davidson";
	}

	$region_array = array(
		array("country_code"=>"EBAY-GB", "ebay_category"=>"9805"),
		array("country_code"=>"EBAY-US", "ebay_category"=>"49992"),
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
	$ra_random_index = array_rand($region_array);
	echo "index: ".$ra_random_index."<br>";
	$country_code = $region_array[$ra_random_index]['country_code'];
	$ebay_category = $region_array[$ra_random_index]['ebay_category'];
	
	if( isset($_GET['perpage']) && !empty($_GET['perpage']) ){
		//$perpage = $_GET['perpage'];
		$perpage = '&paginationInput.entriesPerPage='.$_GET['perpage'];
	}else{
		$perpage = '&paginationInput.entriesPerPage=100';
	}


	//$pageno = 1;
	if( isset($_GET['pageno']) && !empty($_GET['pageno']) ){
			//$pageno = $_GET['pageno'];
		$pageno = '&paginationInput.pageNumber='.$_GET['pageno'];
	}
	
	
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


echo $url ='https://svcs.ebay.com/services/search/FindingService/v1?OPERATION-NAME=findItemsByCategory&SERVICE-VERSION=1.0.0&SECURITY-APPNAME=JohannWi-HDCentra-PRD-ac8eaa0db-6cade1e5&RESPONSE-DATA-FORMAT=JSON&REST-PAYLOAD&keywords='.rawurlencode($keywords).'&GLOBAL-ID='.$country_code.'&categoryId='.$ebay_category.$perpage.$pageno;

echo '+++++<br><br>';

//echo $url ='https://svcs.ebay.com/services/search/FindingService/v1?OPERATION-NAME=findItemsByCategory&SERVICE-VERSION=1.0.0&SECURITY-APPNAME=JohannWi-HDCentra-PRD-ac8eaa0db-6cade1e5&RESPONSE-DATA-FORMAT=JSON&REST-PAYLOAD&keywords=Harley%20Davidson&GLOBAL-ID=EBAY-ES&categoryId=9805&paginationInput.entriesPerPage=100';

$json = curl_get_contents($url);

$jsonnew = json_decode($json);

echo '<br><br>';

print_r($jsonnew->findItemsByCategoryResponse[0]->searchResult[0]->item);

echo "count: ".count($jsonnew->findItemsByCategoryResponse[0]->searchResult[0]->item)."<br>";	