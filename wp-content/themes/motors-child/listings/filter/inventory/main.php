<?php 


//print_r($_SESSION);
    

        // set IP address and API access key 
    $ip = getIp();  
    //$ip = '2.58.45.2';  
 $api_result = '';

    if ( false === ( $api_result = get_transient( 'IP_'.$ip ) ) ) {
    // this code runs when there is no valid transient set
            //echo "API called";



       // $ip = '2.58.45.2';  
        $access_key = 'cd7730575c2f30aa0da956bb7a3d9912';  

            // Initialize CURL:
        $ch = curl_init('http://api.ipstack.com/'.$ip.'?access_key='.$access_key.'');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            // Store the data:
        $json = curl_exec($ch);
        curl_close($ch);         

            // Decode JSON response:
        $api_result = json_decode($json, true);
        set_transient( 'IP_'.$ip, $api_result, YEAR_IN_SECONDS );
    }
        // Decode JSON response:
    
  //  var_dump($api_result);
   // die;


if(empty($_GET)){
    //$_GET['ca_location'] =  $api_result['city'].", ".$api_result['region_name'].", ".$api_result['country_name'];
    //$_GET['stm_lat'] = $api_result['latitude'];
    //$_GET['stm_lng'] = $api_result['longitude'];
    //$_GET['sort_order'] = 'distance_nearby';

    $countrynameterm = term_exists( $api_result['country_name'], 'region' );

    $regiontosearch = "";
        if ( 0 !== $countrynameterm) {
            $term = get_term( $countrynameterm['term_id'], 'region' );
            $regiontosearch = $term->slug;
            //print_r($countrynameterm);
            //die;
            //$regiontosearch = $countrynameterm['term_id']; 
           // $_GET['region'][0] = $term->slug;    
            if($term->count == 0){
            //    $_GET['region'][0] = 'united-kingdom'; 
             //   $regiontosearch  = 'united-kingdom';             
            }
            
        }else{
          //  $_GET['region'][0] = 'united-kingdom';   
           // $regiontosearch  = 'united-kingdom';          
        }

   // print_r($countrynameterm);
   // die;


    $_SESSION['country'] =$api_result['country_code'];

?>
<script type="text/javascript">
   // document.location.href = "<?php echo "/inventory/?ca_location=&stm_lat=&stm_lng=&region=$regiontosearch&view_type=grid";?>";
</script>
<?php
}
?>
<div class="archive-listing-page bgbp">
    <div class="container">
        <?php $boats_template = get_theme_mod('listing_boat_filter', true);
        wp_enqueue_script( 'stm_grecaptcha' );
        if (stm_is_dealer_two() || is_listing(array('listing', 'listing_two', 'listing_three'))) {
            get_template_part('partials/listing-cars/listing-directory', 'archive');
        } elseif (stm_is_boats() and $boats_template) {
            get_template_part('partials/listing-cars/listing-boats', 'archive');
        } elseif (stm_is_motorcycle()) {
            require_once(locate_template('partials/listing-cars/motos/listing-motos-archive.php'));
        } else {
            get_template_part('partials/listing-cars/listing', 'archive');
        }
        ?>
    </div>
</div>