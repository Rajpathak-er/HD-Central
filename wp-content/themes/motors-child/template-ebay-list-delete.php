<?php /* Template Name: Ebay Delete Template */ 



ini_set('max_execution_time', 0);
ini_set('default_socket_timeout', 900);
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


    $args = array(  
        'post_type' => 'listings',
        'post_status' => 'publish',
        'posts_per_page' => 50, 
        'orderby' => array( 
                'query_two' => 'ASC',
                'query_one' => 'ASC',
                'ID' => 'ASC'
        ),
        'meta_query' => array(
                    
                  array(
                     'key' => 'ItemId',
                     'compare' => 'EXISTS'
                  ),
                    array(
                        'relation' => 'OR',
                        'query_one' => array(
                        'key' => 'last-checked',
              
                        'compare' => 'EXISTS',
                    ),
                        'query_two' => array(
                        'key' => 'last-checked',
                        'compare' => 'NOT EXISTS',
              
                    ),

                    ),
                ),
        
        
    );

  //  print_r($args);
    $loop = new WP_Query( $args ); 
        
    while ( $loop->have_posts() ) : $loop->the_post(); 
       echo  $id = get_the_ID();
       
        
       
       echo "--";
        echo $ItemId = get_post_meta( get_the_ID(), 'ItemId', true );
    if($ItemId != '11111'){
        if(!empty($ItemId)){
                $product_data = get_product_details($ItemId);
                 $obj_detail = json_decode($product_data);

                echo $error_code  = $obj_detail->Errors[0]->ErrorCode;
                if($error_code == "10.12"){
                    wp_delete_post( $id, true);
                    echo "deleted";
                } 
        }
    }

        $date = new DateTime();
        $dttime =  $date->getTimestamp();
        update_post_meta( $id, 'last-checked', $dttime );

        echo "<br/>";
        //echo the_title(); 
        //the_excerpt(); 
    endwhile;

    wp_reset_postdata(); 

echo "product";
     

      $args = array(  
        'post_type' => 'product',
        'post_status' => 'publish',
        'posts_per_page' => 50, 
        'orderby' => array( 
                'query_two' => 'ASC',
                'query_one' => 'ASC',
                'ID' => 'ASC'
        ),
        'meta_query' => array(
                    
                  
                    array(
                        'relation' => 'OR',
                        'query_one' => array(
                        'key' => 'last-checked',
              
                        'compare' => 'EXISTS',
                    ),
                        'query_two' => array(
                        'key' => 'last-checked',
                        'compare' => 'NOT EXISTS',
              
                    ),

                    ),
                ),
        
        
    );

    $loop = new WP_Query( $args ); 
        
    while ( $loop->have_posts() ) : $loop->the_post(); 
       echo  $id = get_the_ID();
       echo "--";
        echo $ItemId = get_post_meta( get_the_ID(), '_sku', true );
        $product_type = get_post_meta( get_the_ID(), 'ebay', true );
        if(!empty($product_type)){
                $product_data = get_product_details($ItemId);
                $obj_detail = json_decode($product_data);
                echo $error_code  = $obj_detail->Errors[0]->ErrorCode;
                if($error_code == "10.12"){
                    wp_delete_post( $id, true);
                    echo "deleted";
                } 
        }

        $date = new DateTime();
        $dttime =  $date->getTimestamp();
        update_post_meta( $id, 'last-checked', $dttime );

        echo "<br/>";
        //echo the_title(); 
        //the_excerpt(); 
    endwhile;

    wp_reset_postdata();