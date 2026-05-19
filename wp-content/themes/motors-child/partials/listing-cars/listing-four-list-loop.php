<?php
$show_compare = get_theme_mod('show_listing_compare', false);

$show_favorite = get_theme_mod('enable_favorite_items', true);
$show_share = get_theme_mod('show_listing_share', false);
$listing_directory_enable_dealer_info = get_theme_mod('listing_directory_enable_dealer_info', true);
//$show_share = false;
if(empty($modern_filter)){
    $modern_filter = false;
}
stm_listings_load_template('loop/start', array('modern' => $modern_filter)); 

$mileage  = get_post_meta(get_the_ID(), 'mileage', true);
$engine  = get_post_meta(get_the_ID(), 'engine', true);
$stm_car_location = get_post_meta(get_the_ID(), 'stm_car_location', true);
$mot  = get_post_meta(get_the_ID(), 'mot', true);
$exterior_color = get_post_meta(get_the_ID(), 'exterior-color', true);
$no_of_owners = get_post_meta(get_the_ID(), 'no-of-owners', true);
$post_id = get_the_ID();            
$URL = get_post_meta( $post_id, 'URL', true );

$show_history = get_theme_mod('show_history', true);
$history = get_post_meta(get_the_id(),'history',true);
$history_link = '';
$history_link = get_post_meta(get_the_id(),'history_link',true);

if($mot == 'yes'){
    $mot = 'Yes';
}else if($mot == 'no'){
    $mot = 'No';
}else {
    $mot = 'N/A';
}

/****** location code from old back *****/
// $middle_infos = stm_get_car_archive_listings();
// $middle_infos[] = 'location';
// $total_infos = count($middle_infos);

// /*Get distance value*/
// $car = get_post(get_the_ID());
// $distance = '';
// if (isset($car->stm_distance)) {
// $distance_affix = stm_distance_measure_unit();
// $distance_measure = get_theme_mod('distance_measure_unit', 'miles');
// $distance = $car->stm_distance;
// if ($distance_measure != 'kilometers') {
	// $distance = $distance / 1.609344;
// }
// $distance = round($distance, 1) . ' ' . $distance_affix;
// }

/****** location code from grid file ******/
//Lat lang location
$stm_to_lng = get_post_meta(get_the_ID(), 'stm_lng_car_admin', true);
$stm_to_lat = get_post_meta(get_the_ID(), 'stm_lat_car_admin', true);


$distance = '';
if(!empty($_GET['ca_location'])){
    $stm_to_lng = get_post_meta(get_the_ID(), 'stm_lng_car_admin', true);
    $stm_to_lat = get_post_meta(get_the_ID(), 'stm_lat_car_admin', true);

    $stm_from_lng = esc_attr(floatval($_GET['stm_lng']));
    $stm_from_lat = esc_attr(floatval($_GET['stm_lat']));
    if (!empty($stm_to_lng) and !empty($stm_to_lat)) {
        $distance = stm_calculate_distance_between_two_points($stm_from_lat, $stm_from_lng, $stm_to_lat, $stm_to_lng);
    }
}

?>

<div class="list-leftcontent">
    <h4 class="gggrr mainheadingoflisting id-<?php echo get_the_id(); ?>" style="margin-bottom: 0px;">
        <a href="<?php echo get_the_permalink(get_the_ID());?>" target="_blank"><?php 
        $term_obj_list = get_the_terms( get_the_id(), 'make' );
        if ( ! empty( $term_obj_list ) && ! is_wp_error( $term_obj_list ) ) {
            $modelname = $terms_string = join(', ', wp_list_pluck($term_obj_list, 'name'))." ";
        }
                // $term_obj_list = get_the_terms( get_the_id(), 'serie' );
                // if ( ! empty( $term_obj_list ) && ! is_wp_error( $term_obj_list ) ) {
                    // echo $terms_string = join(', ', wp_list_pluck($term_obj_list, 'name'))." ";
                // }            
        $model_range = get_post_meta(get_the_id(), 'model_range', true);
        if( empty($model_range) || $model_range == "" ){
            $model_range = get_post_meta(get_the_id(), 'serie', true);
        }           
        $title =  get_the_title( $model_range )." ";            
        echo wp_trim_words($title,6)." "; 
        $term_obj_list = get_the_terms( get_the_id(), 'ca-year' );
        if ( ! empty( $term_obj_list ) && ! is_wp_error( $term_obj_list ) ) {
            echo $yeardata = $terms_string = join('-', wp_list_pluck($term_obj_list, 'name'))." ";
        }
        ?>
    </a>
</h4>
<?php 
$isitems = get_post_meta( get_the_id(), 'ItemId', true );

if(!empty($isitems)){
    stm_listings_load_template('loop/classified/list/image-ebay');     
}else{
    stm_listings_load_template('loop/classified/list/image'); 
}
?>

<!-- Content Parts Start -->
<div class="content">
    <!--Item parameters-->
    <div class="meta-middle newlistingleft">


        <!--Title-->
        <?php 
        if(empty($isitems)){
            stm_listings_load_template('loop/default/list/title'); 
        }
        ?>

        <div class="lisingdshortdescription">
            <?php  
            $description = get_post_meta(get_the_id(),'listing_seller_note',true);
            if(empty($description)){
                $description = get_the_content();
            }
           // echo "<pre>";
            echo wp_trim_words(strip_tags($description),50); 
            //echo "</pre>";
            ?>

        </div>



        <?php stm_listings_load_template('loop/default/list/options'); ?>


        <?php stm_listings_load_template('loop/default/list/features'); ?>



    <?php /* ?><?php
        $features = get_post_meta( get_the_id(), 'additional_features', true );
		//echo "++++".$features;			
        $features = ( !empty( $features ) ) ? explode( ',', $features ) : '';

        if ( !empty( $features ) ): ?>
        <h5 style="margin-bottom: 0px;font-size: 13px">Extras</h5>
        <div class="stm-single-listing-car-features">
            <div class="lists-inline" style="font-size: 10px;">

                <?php 
                $i =0 ;
                foreach ( $features as $key => $feature ): ?>

                    <?php

                    if($i !=0){
                        echo " | ";
                    }
                    $i++;
                    if($i>5){
                        break;
                    }
                    echo stm_dynamic_string_translation('Car feature ' . $feature, $feature ); ?>

                <?php endforeach; ?>
                </ul>
            </div>
        </div>
    <?php endif; ?><?php */ ?>

</div>
</div>
<!-- Content Parts End -->



<!-- Gallery Part -->
<div class="car-grid-slider">
    <div class="owl-carousel owl-theme car-slider">
      <?php 
      $car_media = stm_get_car_medias(get_the_id());
      $car_media_images = get_post_meta(get_the_ID(), 'gallery', true);
      
      if(empty($car_media_images)){
        $car_media_images = get_post_meta(get_the_ID(), 'gallery_ebay', true);
      }


      if(!empty($isitems)){
        $car_media['car_photos_count'] = count($car_media_images);
        //print_r($car_media_images);
        $car_media['car_photos'] = $car_media_images;

    }

    if(!empty($car_media['car_photos_count']) && count($car_media['car_photos']) > 1): 

        $imagei= 0;
    $dynamicClassPhotonew = 'stm-car-photos-' . get_the_id() . '-' . rand();


    foreach($car_media['car_photos'] as $car_photo){
            //echo $car_photo;
        $imagei++ ;
        if($imagei == 1){

            continue;
        }
        if($imagei > 6)
        {
            break;
        }

        global $dynamicClassPhoto;
        //echo $dynamicClassPhoto;
        $img = "";
        if(!empty($isitems)){
            $img = $car_photo;
        }else{
            $thumbnail_id = pippin_get_image_id($car_photo);
            $sizeImg = (stm_is_dealer_two()) ? "stm-img-275-205" : 'stm-img-255-160';
            $img = wp_get_attachment_image_src($thumbnail_id, $sizeImg)[0];
        }
        ?>

        <div  class="item link">
            <div  class="car-img" data-src="<?php echo esc_url($img); ?>" style="background-image: url(<?php echo esc_url($img); ?>);">

            </div>
        </div>

        <?php 
    }

    ?>
<?php endif; ?>
</div>
</div>

</div>

<div class="list-rightcontent">
    <div class="newlistinginnerprice">
        <!--Price-->
        <?php stm_listings_load_template('loop/default/list/price'); ?> 
    </div>
    <div class="rightside-list">
        <ul>
           <li><div class="leftsidecontent"   data-toggle="tooltip"  data-placement="auto left" title="Location"><i class="fa fa-map-marker" aria-hidden="true"></i><span>Location: </span></div><div class="rightsidecontent"><?php

           if( $distance != '' || !empty($distance) ){ 
            echo "<strong>".$distance."</strong>&nbsp;";

        }else{
            echo $stm_car_location;
        }

        ?></div></li>
        <li><div class="leftsidecontent"  data-toggle="tooltip"  data-placement="auto left" title="Model"><i class="stm-moto-icon-motorcycle" aria-hidden="true"></i><span>Model: </span></div><div class="rightsidecontent"><?php
        echo  $modelname; ?></div></li>
        <li><div class="leftsidecontent"   data-toggle="tooltip"  data-placement="auto left" title="Year"><i class="stm-boats-icon-calendar" aria-hidden="true"></i><span>Year: </span></div><div class="rightsidecontent"><?php
        echo  $yeardata; ?></div></li>
        <li><div class="leftsidecontent"   data-toggle="tooltip"  data-placement="auto left" title="Mileage"><i class="fa fa-road" aria-hidden="true"></i><span>Mileage: </span></div><div class="rightsidecontent"><?php
        echo  $mileage; ?></div></li>
        <li><div class="leftsidecontent"   data-toggle="tooltip"  data-placement="auto left" title="Engine"><i class="fa fa-bolt" aria-hidden="true"></i><span>Engine: </span></div><div class="rightsidecontent"><?php
        echo  $engine; ?></div></li>
        <li><div class="leftsidecontent"   data-toggle="tooltip"  data-placement="auto left" title="Colour"><i class="fa fa-paint-brush" aria-hidden="true"></i><span>Colour:</span> </div><div class="rightsidecontent"><?php
                    echo  $exterior_color; ?></div></li>
                    <li><div class="leftsidecontent"   data-toggle="tooltip"  data-placement="auto left" title="MOT Status" ><i class="fa fa-inbox" aria-hidden="true"></i><span>MOT Status: </span></div><div class="rightsidecontent"><?php
                    echo  $mot; ?></div></li>
                    <li><div class="leftsidecontent"    data-toggle="tooltip"  data-placement="auto left" title="No of Owners"><i class="fa fa-users" aria-hidden="true"></i><span>No of Owners:</span> </div><div class="rightsidecontent"><?php echo  $no_of_owners; ?></div></li>
                    
                    
        <li><div class="leftsidecontent"  data-toggle="tooltip"  data-placement="auto left" title="Seller Type"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span>Seller: </span></div>
        <div class="rightsidecontent">
           <?php if(is_listing() || stm_is_aircrafts()) :?>
           <?php if(!empty($listing_directory_enable_dealer_info) and !empty($listing_directory_enable_dealer_info) and $listing_directory_enable_dealer_info): ?>
           <?php 
           $user_id = get_the_author_meta( 'ID' );

           $dealer_user_type = get_user_meta($user_id,'dealer_user_type',true);
           if($dealer_user_type == 'dealer_service_provider' || $dealer_user_type == 'dealer'){
            echo "Dealer";
            //get_template_part('partials/user/listing-list-user', 'info'); 
        }else{
            $isitems = get_post_meta( $post_id, 'ItemId', true );
             if(!empty($isitems)){
                $listingtype = get_post_meta( $post_id, 'ListingType', true );
                $title = "Buy on eBay";
                if($listingtype == 'Auction'){
                    $title = "Bid on eBay";
                }
                echo $title;
            }else{
                echo "Personal Seller";
            }
        }?>
        <?php endif; ?>


        </div></li>

    <li style="display: none;">
        <div class="leftsidecontent"><i class="fa fa-empire " aria-hidden="true"></i><span>Trade in</span></div><div class="rightsidecontent"><i class="fa fa-check icon-green " aria-hidden="true"></i></div>

    </li>

    </ul>
   <!-- <div class="mainheadingoflistingDescription">Description</div>
    <div class="singledescriptioncontent"><?php echo esc_attr(trim(preg_replace('/\s+/', ' ', mb_substr(strip_tags(stm_get_listing_seller_note(get_the_id())), 0, 300)))); ?></div> --> 
</div>
<div class="footer_elements">
            <div class="gridview_readmore">
                <a  <?php 
                if(!empty($URL)){
                    echo " target='_blank' ";
                }
                ?> href="<?php 
                
                if(!empty($URL)){
                    echo $URL;
                }
                else{
                    echo get_permalink();
                }
                ?>">More Details</a>

            </div>
            <?php if(!empty($show_favorite) and $show_favorite): ?>
                <div
                    class="stm-listing-favorite"
                    data-id="<?php echo esc_attr(get_the_id()); ?>"
                    data-toggle="tooltip"  data-placement="auto left" title="<?php esc_attr_e('Add to favorites', 'motors') ?>">
                    <i class="stm-service-icon-staricon"></i><?php esc_attr_e('', 'motors') ?>
                </div>
            <?php endif; ?>

   
                        <!--Compare-->
            <?php if(!empty($show_compare) and $show_compare): ?>
                <div
                    class="stm-listing-compare"
                    data-id="<?php echo esc_attr(get_the_id()); ?>"
                    data-title="<?php echo stm_generate_title_from_slugs(get_the_id(),false); ?>"
                    data-toggle="tooltip"  data-placement="auto left" title="<?php esc_attr_e('Add to compare', 'motors') ?>">
                    <i class="stm-service-icon-compare-new"></i> <?php esc_attr_e('', 'motors') ?>
                </div>
            <?php endif; ?>
             <?php if(!empty($show_share) and $show_share): ?>
            
            
            <div class="stm-shareble" >
                <a href="#" class="btn btn-share <?php if(stm_is_aircrafts()) echo 'heading-font'; ?>">
                <i class="stm-icon-share"></i>   
                    
                
                <?php //if( function_exists( 'ADDTOANY_SHARE_SAVE_KIT' ) ): ?>
                <div class="stm-a2a-popup">
                    <?php echo do_shortcode('[addtoany url="'.get_the_permalink(get_the_ID()).'" title="'.get_the_title(get_the_ID()).'"]'); ?>
                </div>
                <?php //endif; ?>
                
                </a>
            </div>
            
        <?php endif; ?>

            </div>

<div class="divfavcompare">
    <!--Favorite-->
    <?php if(!empty($show_favorite) and $show_favorite): ?>
        <div class="stm-listing-favorite"
        data-id="<?php echo esc_attr(get_the_id()); ?>"
        data-toggle="tooltip"  data-placement="auto left" title="<?php esc_attr_e('Add to favorites', 'motors') ?>">
        <i class="stm-service-icon-staricon"></i><?php esc_attr_e('', 'motors') ?>
    </div>
<?php endif; ?>


<!--Compare-->
<?php if(!empty($show_compare) and $show_compare): ?>
    <div class="stm-listing-compare"
    data-id="<?php echo esc_attr(get_the_id()); ?>"
    data-title="<?php echo stm_generate_title_from_slugs(get_the_id(),false); ?>"
    data-toggle="tooltip"  data-placement="auto left" title="<?php esc_attr_e('Add to compare', 'motors') ?>">
    <i class="stm-service-icon-compare-new"></i> <?php esc_attr_e('Compare', 'motors') ?>
</div>
<?php endif; ?>
</div>

<!--Share-->
    <?php /* ?><?php if(!empty($show_share) and $show_share): ?>
        <li class="stm-shareble">
            <a href="#" class="car-action-unit stm-share <?php if(stm_is_aircrafts()) echo 'heading-font'; ?>">
                <i class="stm-icon-share"></i>
                <?php esc_html_e('Share this', 'motors'); ?>
            </a>
            <?php //if( function_exists( 'ADDTOANY_SHARE_SAVE_KIT' ) ): ?>
            <div class="stm-a2a-popup">
                <?php echo do_shortcode('[addtoany url="'.get_the_permalink(get_the_ID()).'" title="'.get_the_title(get_the_ID()).'"]'); ?>
            </div>
            <?php //endif; ?>       
        </li>
    <?php endif; ?><?php */ ?>
</div>







<script type="text/javascript">
    jQuery(document).ready(function(){
        $('#<?php echo $dynamicClassPhotonew; ?>').lightGallery({
            thumbnail:true
        }); 
    });

</script>
<?php 

endif;

?>
</div>