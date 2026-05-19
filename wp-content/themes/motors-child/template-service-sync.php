<?php 

/* Template Name: Service Provider Sync */ 


echo "Sycn product";

$users = get_users( array( 'meta_key' => 'customimport',
    'meta_value' => '20221006') );
foreach($users as $user){
    echo "<br/>";
    echo $user->ID;
    die;
//wp_delete_user($user->ID);
    echo pmpro_changeMembershipLevel(11,$user->ID);
    continue;
    echo $stm_car_location = get_user_meta($user->ID, 'stm_dealer_location',true);
    $option_name = $stm_car_location ;
    $latlong = "";
    
    if ( get_option( $option_name ) !== false ) {
     
        // The option already exists, so update it.
        //update_option( $option_name, $new_value );
        $latlong = get_option( $option_name );
     
    } else {
     
        $data_arr = geocode($stm_car_location);
 
        // if able to geocode the address
        if($data_arr){
            
            $latlong .= $data_arr[0]."|";
            $latlong .= $data_arr[1];
            add_option( $option_name, $latlong, '', 'yes' );
           
        }

        
    }
echo $latlong;
    $latlongarray = explode("|", $latlong);
    if(!empty($latlongarray[0])){
        update_user_meta( $user->ID, 'stm_dealer_location_lat', $latlongarray[0]);     
        update_user_meta( $user->ID, 'stm_dealer_location_lng', $latlongarray[1]);         
    }
    
}

die;
   
/*$users = get_users( array( 'fields' => array( 'ID' ) ) );
foreach($users as $user){
        $user_category = get_user_meta ( $user->ID,'temp_business_category',true);
        $catnames = explode(",", $user_category);
        $carid = array();
        foreach($catnames as $cat){
            $carid[] = get_term_by( 'name', $cat, 'service_category' )->term_id;
        }
        print_r($carid);
        update_user_meta($user->ID, 'service_category', $carid);
        echo "<br/>";
    }
*/
/* Delete post
    $args = array(
   'posts_per_page' => 1000,
   'post_type' => 'listings',
   'post_status'=>'publish',
   'author' => 12238
   );  

$post_list = get_posts($args);
$i = 0;

foreach ( $post_list as $post ) {
   setup_postdata( $post );
    //the_title();
    echo  $i."<br/>";
    $i++;
   
   wp_delete_post( $post->ID, true);
}
 
    die;
*/

    $sql = "SELECT GROUP_CONCAT(Product_ID) FROM product_data_copy";
$product_ids = $wpdb->get_var($sql);

       $args = array(
        'post_type'      => 'product',
        'posts_per_page' => 1000,
         'post__not_in'  => explode(',', $product_ids),
    );



    $loop = new WP_Query( $args );

    while ( $loop->have_posts() ) : $loop->the_post();
        global $post;
        global $product;
        //print_r($post);
        //echo '<br /><a href="'.get_permalink().'">' . woocommerce_get_product_thumbnail().' '.get_the_title().'</a>';
         echo $id = $post->ID;
         echo "<br/>";
          $post_date = $post->post_date;
          $post_content = $post->post_content;
          $post_title = $post->post_title;
          $link = get_permalink();
          $image =get_post_meta($post->ID,'gallery',true);
          $product_url =get_post_meta($post->ID,'_product_url',true);
          $currency_id =get_post_meta($post->ID,'currency_id',true);
          $lat =get_post_meta($post->ID,'lat',true);
          $price =get_post_meta($post->ID,'_price',true);
          $product_type =get_post_meta($post->ID,'product_type',true);
          $country =get_post_meta($post->ID,'country',true);


          $sku = $product->get_sku();;

          // Get the product attribute value(s)
$final_fitment="";
$fitment = $product->get_attribute('pa_fitment');
$fits = $product->get_attribute('pa_fits');
$fit_for = $product->get_attribute('pa_fit-for');
$fit = $product->get_attribute('pa_fit');


$brand = $product->get_attribute('pa_brand');
$part_brand = $product->get_attribute('pa_part-brand');

$compatible_model = $product->get_attribute('pa_compatible-model');
$model = $product->get_attribute('pa_model');
$motorradmodell = $product->get_attribute('pa_motorradmodell');

 $item_condition = $product->get_attribute('pa_item-condition');

$manufacturer_part_number = $product->get_attribute('pa_manufacturer-part-number');
$reference_oe_oem_number = $product->get_attribute('pa_reference-oe-oem-number');

$model_years = $product->get_attribute('pa_model-years');
$year = $product->get_attribute('pa_years');

$warranty = $product->get_attribute('pa_warranty');

// if product has attribute 'pa_color' value(s)
 $final_fitment = $fitment ?? $fits ?? $fit_for ?? $fit ?? '';
 $final_brand = $brand ?? $part_brand ?? '';
 $final_model = $motorradmodell ?? $compatible_model ?? $model ?? '';
 $final_oem =   $reference_oe_oem_number ?? '';
 $final_year = $model_years ?? $year ?? '';


          //brand
          //compatible-model
          //fitment
          //item-condition
          // manufacturer-part-number
          //manufacturer-part-number
          // model
          // model-years
          // reference-oe-oem-number
          // warranty
          // year
          // to-fit-model
          // to-fit-make
          // part-brand
          //motorradmodell
          // fits
          // fit-for
          // fit
         
$terms = get_the_terms ( $post->ID, 'product_cat' );
$cat_idname  = array();
foreach ( $terms as $term ) {
   // print_r($term);
     $cat_idname[] = $term->name;
}
$catname =  implode(", ", $cat_idname);
       

    
       global $wpdb;
       die;
        $wpdb->insert('product_data_copy', array(
            'Product_ID' => $id,
            'Product_URL' => $product_url,
            'Image_url_1' => $image,
            'Product_Listing_Date' => $post_date,
            'Seller' => 'ebay',
            'Product_Title' => $post_title, 
            'Product_Description' => $post_content, 
            'Product_Currency' => $currency_id, 
            'Product_Price' => $price, 
            'Product_Region' => $country, 
            'Master_Category' => $catname,
            'Product_Condition' => $item_condition,
            'Model' => $final_model,
            'Model_Range' => $motorradmodell,
            'Model_Year' => $final_year,
            'Model_Fitment' => $final_fitment,
            'Harley_OEM' => $final_oem,
            'Other_Man_Part_No' => $manufacturer_part_number,
            'Product_Brand' => $final_brand,
            
        ));
        //echo $wpdb->last_query ;
        //echo $wpdb->last_error ;

    endwhile;



    wp_reset_query();

    die;

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

$users = get_users( array( 'meta_key' => 'customimport',
    'meta_value' => '20220604') );
foreach($users as $user){
    echo "<br/>";
    echo $user->ID;
//wp_delete_user($user->ID);
    echo pmpro_changeMembershipLevel(11,$user->ID);
    continue;
    echo $stm_car_location = get_user_meta($user->ID, 'stm_dealer_location',true);
    $option_name = $stm_car_location ;
    $latlong = "";
    
    if ( get_option( $option_name ) !== false ) {
     
        // The option already exists, so update it.
        //update_option( $option_name, $new_value );
        $latlong = get_option( $option_name );
     
    } else {
     
        $data_arr = geocode($stm_car_location);
 
        // if able to geocode the address
        if($data_arr){
            
            $latlong .= $data_arr[0]."|";
            $latlong .= $data_arr[1];
            add_option( $option_name, $latlong, '', 'yes' );
           
        }

        
    }
echo $latlong;
    $latlongarray = explode("|", $latlong);
    if(!empty($latlongarray[0])){
        update_user_meta( $user->ID, 'stm_dealer_location_lat', $latlongarray[0]);     
        update_user_meta( $user->ID, 'stm_dealer_location_lng', $latlongarray[1]);         
    }
    
}

/*  post
// Assuming you've got $author_id set
// and your post type is called 'your_post_type'
$args = array(
    'author' => 12238,
    'post_type' => 'listings',
    'posts_per_page' => -1,
     'meta_query' => array(
                  array(
                     'key' => 'stm_lat_car_admin',
                     'compare' => '==',
                     'value' => ''
                  ),
   )
);
//print_r($args);
$author_posts = new WP_Query( $args );
if( $author_posts->have_posts() ) {
    while( $author_posts->have_posts() ) { 
        $author_posts->the_post();
        // title, content, etc
        echo "<br/>";
      //   get_the_title();
      echo $postid = get_the_ID();
      echo $stm_car_location = get_post_meta($postid, 'stm_car_location',true);
      echo "lat".get_post_meta($postid, 'stm_lat_car_admin',true);
      echo "lng".get_post_meta($postid, 'stm_lng_car_admin',true);
      delete_post_meta( $postid, 'stm_lat_car_admin', '');  
      delete_post_meta( $postid, 'stm_lng_car_admin', '');    
        $option_name = $stm_car_location ;
    $latlong = "";
     continue;
    if ( get_option( $option_name ) !== false ) {
     
        // The option already exists, so update it.
        //update_option( $option_name, $new_value );
        $latlong = get_option( $option_name );
     
    } else {
     
        $data_arr = geocode($stm_car_location);
 
        // if able to geocode the address
        if($data_arr){
            
            $latlong .= $data_arr[0]."|";
            $latlong .= $data_arr[1];
            add_option( $option_name, $latlong, '', 'yes' );
           
        }

        
    }
//echo $latlong;
    $latlongarray = explode("|", $latlong);
    update_post_meta( $postid, 'stm_lat_car_admin', $latlongarray[0]);     
    update_post_meta( $postid, 'stm_lng_car_admin', $latlongarray[1]);     
      //  $author_posts->the_content();
        // you should have access to any of the tags you normally
        // can use in The Loop
    }
    wp_reset_postdata();
}
*/