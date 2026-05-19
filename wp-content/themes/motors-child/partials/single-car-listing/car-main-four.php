<div class="row">
    <div class="col-md-8 col-sm-12 col-xs-12">
        <div class="stm-single-car-content">


            <!--Actions-->
            <?php //get_template_part( 'partials/single-car/car', 'actions' ); 

function strip_tags_content($text, $tags = '', $invert = FALSE) {

  preg_match_all('/<(.+?)[\s]*\/?[\s]*>/si', trim($tags), $tags);
  $tags = array_unique($tags[1]);
   
  if(is_array($tags) AND count($tags) > 0) {
    if($invert == FALSE) {
      return preg_replace('@<(?!(?:'. implode('|', $tags) .')\b)(\w+)\b.*?>.*?</\1>@si', '', $text);
    }
    else {
      return preg_replace('@<('. implode('|', $tags) .')\b.*?>.*?</\1>@si', '', $text);
    }
  }
  elseif($invert == FALSE) {
    return preg_replace('@<(\w+)\b.*?>.*?</\1>@si', '', $text);
  }
  return $text;
}
            ?>

            <!--Gallery-->


            <?php 

            $term_obj_list = get_the_terms( get_the_id(), 'make' );
            //print_r($term_obj_list);
            //echo "gegfdfdfdf";
            if ( ! empty( $term_obj_list ) && ! is_wp_error( $term_obj_list ) ) {
                $modelname = $terms_string = join(', ', wp_list_pluck($term_obj_list, 'name'))." ";
            }
                    // $term_obj_list = get_the_terms( get_the_id(), 'serie' );
                    // if ( ! empty( $term_obj_list ) && ! is_wp_error( $term_obj_list ) ) {
                        // echo $terms_string = join(', ', wp_list_pluck($term_obj_list, 'name'))." ";
                    // }            
            $model_range = get_post_meta(get_the_id(), 'model_range', true);
			$model_range = get_the_title($model_range);
            if( empty($model_range) || $model_range == "" ){
                $model_range = get_post_meta(get_the_id(), 'serie', true);
                $model_range = get_post_meta(get_the_id(), 'model_range', true);
            }           
            $title = $model_range;// get_the_title( $model_range )." ";            
            $newtitle = wp_trim_words($title,6)." "; 
            $term_obj_list = get_the_terms( get_the_id(), 'ca-year' );
            if ( ! empty( $term_obj_list ) && ! is_wp_error( $term_obj_list ) ) {
                 $yeardata = $terms_string = join('-', wp_list_pluck($term_obj_list, 'name'))." ";
            }

            //$modelname = $terms_string = join(', ', wp_list_pluck($term_obj_list, 'name'))." ";
            $yeardata = $terms_string = join('-', wp_list_pluck($term_obj_list, 'name'))." ";
            $mileage  = get_post_meta(get_the_ID(), 'mileage', true);
            $engine  = get_post_meta(get_the_ID(), 'engine', true);
            $stm_car_location = get_post_meta(get_the_ID(), 'stm_car_location', true);
            $exterior_color = get_post_meta(get_the_ID(), 'exterior-color', true);
            $no_of_owners = get_post_meta(get_the_ID(), 'no-of-owners', true);
            $post_author_id = get_post_field( 'post_author', $post_id );
            $Dealer_name = get_user_meta($post_author_id,'stm_company_name',true);
			if( empty($Dealer_name) ){
				$Dealer_name = get_user_meta($post_author_id,'business_name',true);
				if( empty($Dealer_name) ){
					$fname = get_user_meta($post_author_id,'first_name',true);
					$lname = get_user_meta($post_author_id,'last_name',true);
					$Dealer_name = $fname . " " . $lname;
				}
			}
            $trade_in_facilities = get_user_meta($post_author_id,'trade_in_facilities',true);
            $is_warranty  = get_user_meta($post_author_id,'is_warranty',true);
            $Warranty_Period = get_user_meta($post_author_id,'Warranty_Period',true);
            $Warranty_Type = get_user_meta($post_author_id,'Warranty_Type',true);
            $house_financing = get_user_meta($post_author_id,'house_financing',true);
            $ratings = stm_get_dealer_marks($post_author_id);
			
			$place_user = get_user_meta( $post_author_id, 'place_user', true );

            
			$Warranty_Type = json_decode($Warranty_Type,true);

           

            $mot  = get_post_meta(get_the_ID(), 'mot', true);
            $show_compare = get_theme_mod('show_listing_compare', false);

            $show_favorite = get_theme_mod('enable_favorite_items', true);
            $show_share = get_theme_mod('show_listing_share', false);
            $listing_directory_enable_dealer_info = get_theme_mod('listing_directory_enable_dealer_info', true);

            $data = apply_filters( 'stm_single_car_data', stm_get_single_car_listings() );
            $post_id = get_the_ID();

            $show_vin = get_theme_mod('show_vin', true);
            $vin_num = get_post_meta(get_the_id(),'vin_number', true);

            $show_stock = get_theme_mod('show_stock', true);
            $stock_number = get_post_meta(get_the_id(),'stock_number',true);

            $show_registered = get_theme_mod('show_registered', true);
            $registration_date = get_post_meta(get_the_id(),'registration_date',true);
            $registration_date = date("Y-m-d", strtotime($registration_date) );

            $show_history = get_theme_mod('show_history', true);
            $history = get_post_meta(get_the_id(),'history',true);
            $history_link = '';
            $history_link = get_post_meta(get_the_id(),'history_link',true);


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
            <h1 class="title h2 kk"><?php  
            $pos = strpos(strtolower($newtitle), "davidson");
            if ($pos === false) {
                echo "Harley-Davidson ";
            }

            echo $newtitle." ".$yeardata; // the_title(); ?> <?php get_template_part( 'partials/single-car/car', 'price' );?></h1>
            <?php 

            $isitems = get_post_meta( get_the_id(), 'ItemId', true );
            $URL = get_post_meta( get_the_id(), 'URL', true );

            if(!empty($isitems)){

                get_template_part( 'partials/single-car/car', 'gallery-ebay' ); 
            }else{
                get_template_part( 'partials/single-car/car', 'gallery' ); 
            }
            ?>
            <!--Car Gurus if is style BANNER-->
            <?php if ( strpos( get_theme_mod( "carguru_style", "STYLE1" ), "BANNER" ) !== false ) get_template_part( 'partials/single-car/car', 'gurus' ); ?>

            <?php //CAR DATA
            $data =  "";//stm_get_single_car_listings();
            if(!empty($data)):
                ?>
                <div class="stm-car-listing-data-single stm-border-top-unit">
                    <div class="title heading-font"><?php esc_html_e('Car Details','motors'); ?></div>
                </div>

                <?php get_template_part('partials/single-car-listing/car-data'); ?>
            <?php endif; ?>


            

            <div class="stm-car-listing-data-single stm-border-top-unit descriptiontitle">

                <div class="title heading-font"><?php 

                echo esc_html__('Description', 'motors'); ?></div>
            </div>


            <?php //echo stm_get_listing_seller_note(get_the_ID()); ?>


            <div class="description_content_bike_single">
            
         <?php 
echo "<h3>".get_the_title()."</h3>";
         echo stm_get_listing_seller_note(get_the_ID()); 
            //echo esc_attr(trim(preg_replace('/\s+/', ' ', mb_substr(stm_get_listing_seller_note(get_the_id()), 0, 1000))));
                 
        ?>


        
            
        </div>

        <div class="stm-extras-container">
            <?php

        
            $features = get_post_meta(get_the_id(), 'additional_features', true);
            if(!empty($features)):
                ?>
                <div class="stm-car-listing-data-single stm-border-top-unit descriptiontitle">
                    <div class="title heading-font"><?php esc_html_e('Extras', 'motors'); ?></div>
                </div>
                <?php get_template_part('partials/single-car-listing/car-features'); ?>

            <?php endif; ?>
        
        </div>
        <?php if($is_warranty){ ?>
        <div class="stm-warranty-container">
            <div class="stm-car-listing-data-single stm-border-top-unit descriptiontitle">
                    <div class="title heading-font"><?php esc_html_e('Warranty', 'motors'); ?></div>
                </div>
                <div class="hmm" style="">
                    
                <?php 
                echo $Warranty_Period." ";
                echo implode(", ",$Warranty_Type);
                ?>
            
                </div>
                
        </div>
        <?php } ?>

        <?php echo get_template_part( 'partials/single-car/car', 'similar' ); ?>
        <?php wpfp_link(); ?>


		<!-- dealers inventory -->		
		<?php 
			$current_post_id = get_the_ID();
			//var_dump($place_user);
			if( empty($place_user) ){
				
				$user_id = $post_author_id;
				//echo "user_id: ".$user_id."<br>";
				$query = (function_exists('stm_user_listings_query')) ? stm_user_listings_query($user_id, 'publish', 6, false, 0, false, true) : null;
				$query_popular = (function_exists('stm_user_listings_query')) ? stm_user_listings_query($user_id, 'publish', 6, true, 0, false, true) : null;

				$row = 'row row-3';
				$active = 'grid';
				$list = '';
				$grid = 'active';
				if(!empty($_GET['view_type']) and $_GET['view_type'] == 'list') {
					$list = 'active';
					$grid = '';
					$active = 'list';
					$row = 'row-no-border-last';
				}
		?>
			<?php if( $query->found_posts > 1 ){ ?>
				<div class="separator-line"></div>
			<?php } ?>
			
			<div class="stm-section stm-dealer-tab-section">
				<?php if($query != null && $query->have_posts()): ?>
					<div class="stm_listing_tabs_style_2 stm-car-listing-sort-units stm-car-listing-directory-sort-units stm-dealer-inventory clearfix">
						<input type="hidden" id="stm_dealer_view_type" value="<?php echo esc_attr($active); ?>" />
						
						<?php if( $query->found_posts > 1 ){ ?>
							<h4 class="stm-seller-title"><?php esc_html_e('Dealer Inventory', 'motors'); ?></h4>						
						<?php } ?>
						
						<?php if($query != null && $query->have_posts()): ?>
							<div class="car-listing-row <?php echo esc_attr($row); ?>">
								<?php while($query->have_posts()): $query->the_post(); 
									if( $current_post_id == get_the_ID() ){
										continue;
									}
								?>
									
									<?php get_template_part( 'partials/listing-cars/listing-'.$active.'-directory-loop-custom', 'animate' ); ?>
								<?php endwhile; ?>
							</div>
							
						<?php endif; ?>
					</div>
				<!--</div> -->
							
				<?php else: ?>
					<!--<h4 class="stm-seller-title no-inventory" style="color:#aaa; margin-top:44px"><?php esc_html_e('No Inventory added yet.', 'motors'); ?></h4>-->
				<?php endif; ?>
			</div>
		<?php 
			}
		?>
		
    </div>
</div>
    <div class="col-md-4 col-sm-12 col-xs-12">
        <h1 class="title h2 maintitlepricing" style="margin-bottom: 0px;">Bike Details</h1>
        
        <div class="row bikebelowboxdesc">
                <div class="col-md-12 col-sm-12 col-xs-12" >
                    <div class="rightside-list" style="padding-bottom: 10px;">
                    <ul>
                   
                        <li style="display: none;"><div class="leftsidecontent"><i class="fa fa-gbp" aria-hidden="true"></i><span>Price: </span></div><div class="rightsidecontent"><?php get_template_part( 'partials/single-car/car', 'price' );?></div></li>
                     <li><div class="leftsidecontent"><i class="fa fa-map-marker" aria-hidden="true"></i><span>Location: </span></div><div class="rightsidecontent"><?php

                     if( $distance != '' || !empty($distance) ){ 
                        echo "<strong>".$distance."</strong>&nbsp;";

                    }else{
                        echo $stm_car_location;
                    }

                    ?></div></li>
                    <li><div class="leftsidecontent"><i class="stm-moto-icon-motorcycle" aria-hidden="true"></i><span>Model: </span></div><div class="rightsidecontent"><?php
                    echo  $modelname; ?></div></li>
                    <li style="display:none;"><div class="leftsidecontent"><i class="stm-moto-icon-motorcycle" aria-hidden="true"></i><span>Model Ref: </span></div><div class="rightsidecontent"><?php
                    echo  $modelname; ?></div></li>
                    <li><div class="leftsidecontent"><i class="stm-moto-icon-motorcycle" aria-hidden="true"></i><span>Model Family: </span></div><div class="rightsidecontent"><?php
                    echo  $model_range; ?></div></li>

                    <li><div class="leftsidecontent"><i class="stm-icon-road" aria-hidden="true"></i><span>Year:</span> </div><div class="rightsidecontent"><?php
                    echo  $yeardata; ?></div></li>
                    
                    <li><div class="leftsidecontent"><i class="fa fa-bolt" aria-hidden="true"></i><span>Engine:</span> </div><div class="rightsidecontent"><?php
                    echo  $engine; ?></div></li>
                    
                    <li><div class="leftsidecontent"><i class="fa fa-road" aria-hidden="true"></i><span>Mileage: </span></div><div class="rightsidecontent"><?php
                    echo  $mileage; ?></div></li>
                    <li><div class="leftsidecontent" ><i class="fa fa-users" aria-hidden="true"></i><span>No of Owners:</span> </div><div class="rightsidecontent"><?php echo  $no_of_owners; ?></div></li>
                    
                    <li><div class="leftsidecontent" ><i class="fa fa-inbox" aria-hidden="true"></i><span>Road Legal Cert: </span></div><div class="rightsidecontent"><?php
                    echo  $mot; ?></div></li>
                    <li><div class="leftsidecontent" ><i class="fa fa-clock-o" aria-hidden="true"></i><span>History: </span></div><div class="rightsidecontent"><?php echo  $history; ?></div></li>
                    
                     
                    
                    
                     
                    
                    
                    <li><div class="leftsidecontent"><i class="fa fa-tachometer" aria-hidden="true"></i><span>Colour:</span> </div><div class="rightsidecontent"><?php
                    echo  $exterior_color; ?></div></li>
                    <li style="display: none;"><div class="leftsidecontent" ><i class="fa fa-inbox" aria-hidden="true"></i><span>Registered:</span> </div><div class="rightsidecontent"><?php echo  $registration_date; ?></div></li>
                    <li  style="display: none;"><div class="leftsidecontent" ><i class="fa fa-inbox" aria-hidden="true"></i><span>REG No: </span></div><div class="rightsidecontent"><?php echo  $vin_num; ?></div></li>


                    
                    </ul>
                </div>

                <div class="rightside-list bikeanalysisblock" style="padding-bottom: 10px;">
                    <ul>
                   <li><div class="toplevelheadingofdetailpage">Bike Analysis: </div></li>
                        <li style="display: none;"><div class="leftsidecontent"><i class="fa fa-gbp" aria-hidden="true"></i><span>Price: </span></div><div class="rightsidecontent"><?php get_template_part( 'partials/single-car/car', 'price' );?></div></li>
                     <li><div class="leftsidecontent"><i class="fa fa-map-marker" aria-hidden="true"></i><span>Location: </span></div><div class="rightsidecontent"><?php

                     if( $distance != '' || !empty($distance) ){ 
                        echo "<strong>".$distance."</strong>&nbsp;";

                    }else{
                        echo $stm_car_location;
                    }

                    ?></div></li>
                    <li><div class="leftsidecontent"><i class="fa fa-road" aria-hidden="true"></i><span>Mileage: </span></div><div class="rightsidecontent"><?php
                    echo  $mileage; ?></div></li>
                    <li><div class="leftsidecontent" ><i class="fa fa-users" aria-hidden="true"></i><span>No of Owners:</span> </div><div class="rightsidecontent"><?php echo  $no_of_owners; ?></div></li>
                    
                    <li><div class="leftsidecontent" ><i class="fa fa-inbox" aria-hidden="true"></i><span>MOT Status: </span></div><div class="rightsidecontent"><?php
                    echo  $mot; ?></div></li>
                    <li><div class="leftsidecontent" ><i class="fa fa-clock-o" aria-hidden="true"></i><span>History: </span></div><div class="rightsidecontent"><?php echo  $history; ?></div></li>
                    <li><div class="leftsidecontent" ><i class="fa fa-clock-o" aria-hidden="true"></i><span>History: </span></div><div class="rightsidecontent"><?php echo  $history; ?></div></li>
                    
                     </ul>
                 </div>

                   <div class="rightside-list sellerinfoblock" style="padding-bottom: 10px;">
                    <ul>
                   <li><div class="toplevelheadingofdetailpage">Seller Info: </div></li>
                        <li style="display: none;"><div class="leftsidecontent"><i class="fa fa-gbp" aria-hidden="true"></i><span>Price: </span></div><div class="rightsidecontent"><?php get_template_part( 'partials/single-car/car', 'price' );?></div></li>
                     <li><div class="leftsidecontent"><i class="fa fa-map-marker" aria-hidden="true"></i><span>Location: </span></div><div class="rightsidecontent"><?php

                     if( $distance != '' || !empty($distance) ){ 
                        echo "<strong>".$distance."</strong>&nbsp;";

                    }else{
                        echo $stm_car_location;
                    }

                    ?></div></li>
                    <li><div class="leftsidecontent"><i class="fa fa-road" aria-hidden="true"></i><span>Dealer Name: </span></div><div class="rightsidecontent"><a href="<?php get_author_link( true, $post_author_id) ?>"> <?php
                    echo  $Dealer_name; ?></a></div></li>
                    <li><div class="leftsidecontent" ><i class="fa fa-users" aria-hidden="true"></i><span>Part Exchange:</span> </div><div class="rightsidecontent"><?php if($trade_in_facilities){ echo $trade_in_facilities;} else { echo "N/a"; } ?></div></li>
                    
                    <li><div class="leftsidecontent" ><i class="fa fa-inbox" aria-hidden="true"></i><span>Finance : </span></div><div class="rightsidecontent"><?php
                    echo  $house_financing; ?></div></li>
                    <li><div class="leftsidecontent" ><i class="fa fa-clock-o" aria-hidden="true"></i><span>Dealer rating: </span></div><div class="rightsidecontent">
                        <?php if(!empty($ratings['average'])): ?>
                    <div class="dealer-rating">
                            <div class="stm-rate-unit">
                                <div class="stm-rate-inner">
                                    <div class="stm-rate-not-filled"></div>
                                    <div class="stm-rate-filled" style="width:<?php echo esc_attr($ratings['average_width']); ?>"></div> <div class="stm-rate-sum">(<?php esc_html_e('Reviews', 'motors'); ?> <?php echo esc_attr($ratings['count']); ?>)</div>
                                </div>
                            </div>
                           
                        </div>
                        <?php else: 
                            echo "N/A";
                         endif; ?>

                    </div></li>
                    
                    
                     </ul>
                 </div>
                </div>
                
        </div>
        <div class="stm-single-car-side" style="margin-left: 0px;    margin-top: 10px;">
            <?php ?>
            
            <?php if(!empty($isitems)){?>
                <style type="text/css">
                    .car-action-unit.stm-schedule{
                        display: none;
                    }

                </style>

                <?php
            }
    if ( is_active_sidebar( 'stm_listing_car' ) ) {


                //dynamic_sidebar( 'stm_listing_car' );
                //get_template_part( 'partials/single-car/car', 'price' );

                ?>

                
            <?php

            /*<!--Data-->*/
           // get_template_part( 'partials/single-car/car', 'data' );




            /*<!--Calculator-->*/


            if(!empty($isitems)){
                $listingtype = get_post_meta( get_the_id(), 'ListingType', true );
                $title = "Click here for more details";
                if($listingtype == 'Auction'){
                    $title = "Click here for more details";
                }

                ?>
                <a class="button product_type_external kl" target="_blank" href="<?php echo $URL;?>"><?php echo $title;?></a>
                <br/>
                <?php
            }else{
                echo do_shortcode('[stm_car_listing_contact_form form="500" title="Contact Seller"]'); 
            }
            /*<!--Rating Review-->*/
            get_template_part( 'partials/single-car/car', 'review_rating' );

            /*<!--MPG-->*/
            get_template_part( 'partials/single-car/car', 'mpg' );

               // get_template_part( 'partials/single-car/car', 'calculator' );
            } else {

            /*<!--Prices-->*/
            get_template_part( 'partials/single-car/car', 'price' );

            /*<!--Data-->*/
            get_template_part( 'partials/single-car/car', 'data' );

            /*<!--Rating Review-->*/
            get_template_part( 'partials/single-car/car', 'review_rating' );

            /*<!--MPG-->*/
            get_template_part( 'partials/single-car/car', 'mpg' );

            /*<!--Calculator-->*/
            get_template_part( 'partials/single-car/car', 'calculator' );
            
            
        }
        ?>

    </div>
</div>
</div>