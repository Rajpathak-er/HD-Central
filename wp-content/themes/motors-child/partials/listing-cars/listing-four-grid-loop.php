<?php

$regular_price_label = get_post_meta(get_the_ID(), 'regular_price_label', true);
$special_price_label = get_post_meta(get_the_ID(),'special_price_label',true);
$show_share = get_theme_mod('show_listing_share', false);

$show_compare = get_theme_mod('show_listing_compare', false);

$show_favorite = get_theme_mod('enable_favorite_items', true);


$price = get_post_meta(get_the_id(),'price',true);
$sale_price = get_post_meta(get_the_id(),'sale_price',true);

$car_price_form_label = get_post_meta(get_the_ID(), 'car_price_form_label', true);

$data = array(
    'data_price' => 0,
  //  'data_mileage' => 0,
);

if(!empty($price)) {
	$data['data_price'] = $price;
}

if(!empty($sale_price)) {
    $data['data_price'] = $sale_price;
}

if(empty($price) and !empty($sale_price)) {
	$price = $sale_price;
}

/*$mileage = get_post_meta(get_the_id(),'mileage',true);

if(!empty($mileage)) {
    $data['data_mileage'] = $mileage;
}*/

$taxonomies = stm_get_taxonomies();
foreach ($taxonomies as $val) {
	$taxData = stm_get_taxonomies_with_type($val);
	if(!empty($taxData['numeric']) && !empty($taxData['slider'])) {
		$value = get_post_meta(get_the_id(), $val, true);
		$data['data_' . str_replace('-', '__', $val)] = $value;
		$data['atts'][] = str_replace('-', '__', $val);
	}
}

if(stm_is_dealer_two()) {
	$sellOnline = get_theme_mod( 'enable_woo_online', false );
	$isSellOnline = ( $sellOnline ) ? !empty( get_post_meta( get_the_ID(), 'car_mark_woo_online', true ) ) : false;
}

?>

<?php if(!stm_is_magazine()): ?>
<?php stm_listings_load_template('loop/classified/grid/start', $data); ?>
<!-- <?php stm_listings_load_template('loop/default/grid/title_price', array('price' => $price, 'sale_price' => $sale_price, 'car_price_form_label' => $car_price_form_label)); ?> -->
        <?php 

        $isitems = get_post_meta( get_the_id(), 'ItemId', true );
        $post_id = get_the_id();
        $currency_id = get_post_meta(get_the_ID(), 'currency_id', true);
        if(empty($currency_id)){
            $currency_id = "GBP";
        }

    	if(!empty($isitems)){
        	stm_listings_load_template('loop/default/grid/image-ebay');
        }else{
        	stm_listings_load_template('loop/default/grid/image');
    	}

         ?>
                    <!-- new price and share section start -->
                    <div class="modal_name">
                    <?php stm_listings_load_template('loop/default/grid/title_price', array('price' => $price, 'sale_price' => $sale_price, 'car_price_form_label' => $car_price_form_label)); ?>
    </div>
        <div class="price-share footer_elements">
    <div class="price-new">
    <!-- <div class="grid_view_option_details_key "><i class="fa fa-gbp" aria-hidden="true"></i><span>Price</span></div> -->
                        <div class="grid_view_option_details_value priceheading">
							<!--<span class="car-price">£ <?php  //echo $Year->name;?></span>-->
							<?php if(stm_is_dealer_two() && $isSellOnline):?>
								<?php
								if(!empty($sale_price)) {
									$price = $sale_price;
								};
								?>
								<div class="sell-online-wrap price">
									<div class="normal-price">
										<span class="normal_font"><?php echo esc_html__('BUY ONLINE', 'motors'); ?></span>
										<span class="heading-font"><?php echo esc_attr(stm_listing_price_view($price)); ?></span>
									</div>
								</div>
							<?php else : ?>
								<?php if(empty($car_price_form_label)): ?>
									<?php if(!empty($price) and !empty($sale_price) and $price != $sale_price):?>
										<div class="car-price discounted-price">
											<div class="regular-price"><?php echo esc_attr(stm_listing_price_view($price)); ?></div>
											<div class="sale-price"><?php echo esc_attr(stm_listing_price_view($sale_price)); ?></div>
										</div>
									<?php elseif(!empty($price)): ?>
										<div class="car-price">
											<div class="normal-price"><?php echo get_currency_symbol($currency_id).number_format($price,"0","",""); ?></div>
										</div>
									<?php endif; ?>
								<?php else: ?>
									<div class="car-price">
										<div class="normal-price"><?php echo esc_attr($car_price_form_label); ?></div>
									</div>
								<?php endif; ?>
							<?php endif; ?>
						</div>
    </div>
<div class="grid_share">
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
                    class="stm-listing-compare add-to-compare"
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
    </div>
            <!-- new price and share section end -->
		<div class="listing-car-item-meta">
            <?php //stm_listings_load_template('loop/default/grid/data'); ?>
            <?php
            $stm_car_location = get_post_meta(get_the_ID(), 'stm_car_location', true);
            $mileage  = get_post_meta(get_the_ID(), 'mileage', true);
            $engine  = get_post_meta(get_the_ID(), 'engine', true);
            $mot  = get_post_meta(get_the_ID(), 'mot', true);
            $Seller  = get_post_meta(get_the_ID(), 'seller', true);
            $Seller = get_the_terms( $post->ID, 'seller' ); 
            $Seller = $Seller[0];
            $Year = get_the_terms( $post->ID, 'ca-year' ); 

            $URL = get_post_meta( $post->ID, 'URL', true );
            $Year = $Year[0];
			
			$models  = get_the_terms( $post->ID, 'make' );
			$model = $models[0];
			// if( $models ){
				// $links = array();
				// foreach( $models as $model ){
					// $links[] = $model->name;
				// }
				// $model_list = implode(', ', $links);
			// }else{
				// $model_list = '';
			// }
			
			
            
            if($mot == 'yes'){
                $mot = 'Yes';
            }else if($mot == 'no'){
                $mot = 'No';
            }
            else {
                $mot = 'N/A';
            }
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
            <div class="car-meta-bottom">
                <ul>
                 	 <li>
                        <div class="grid_view_option_details_key "><i class="fa fa-gbp" aria-hidden="true"></i><span>Price</span></div>
                        <div class="grid_view_option_details_value priceheading">
							<!--<span class="car-price">£ <?php  //echo $Year->name;?></span>-->
							<?php if(stm_is_dealer_two() && $isSellOnline):?>
								<?php
								if(!empty($sale_price)) {
									$price = $sale_price;
								};
								?>
								<div class="sell-online-wrap price">
									<div class="normal-price">
										<span class="normal_font"><?php echo esc_html__('BUY ONLINE', 'motors'); ?></span>
										<span class="heading-font"><?php echo esc_attr(stm_listing_price_view($price)); ?></span>
									</div>
								</div>
							<?php else : ?>
								<?php if(empty($car_price_form_label)): ?>
									<?php if(!empty($price) and !empty($sale_price) and $price != $sale_price):?>
										<div class="car-price discounted-price">
											<div class="regular-price"><?php echo esc_attr(stm_listing_price_view($price)); ?></div>
											<div class="sale-price"><?php echo esc_attr(stm_listing_price_view($sale_price)); ?></div>
										</div>
									<?php elseif(!empty($price)): ?>
										<div class="car-price">
											<div class="normal-price"><?php echo esc_attr(stm_listing_price_view($price)); ?></div>
										</div>
									<?php endif; ?>
								<?php else: ?>
									<div class="car-price">
										<div class="normal-price"><?php echo esc_attr($car_price_form_label); ?></div>
									</div>
								<?php endif; ?>
							<?php endif; ?>
						</div>
                    </li>
					<li>
                        <div class="grid_view_option_details_key"><img src="<?php echo get_home_url(); ?>/wp-content/uploads/2021/09/4-2-harley-davidson-logo-black-and-white-black.png" class="sale-fa-icon"><span>Model</span></div>
                        <div class="grid_view_option_details_value"><?php  echo $model->name;?></div>
                    </li>
                    <li>
                        <div class="grid_view_option_details_key"><i class="fa fa-calendar" aria-hidden="true"></i><span>Year</span></div>
                        <div class="grid_view_option_details_value"><?php  echo $Year->name;?></div>
                    </li>
                    <li>
                        <div class="grid_view_option_details_key"><i class="fa fa-map-marker" aria-hidden="true"></i><span>Location</span></div>
                        <div class="grid_view_option_details_value"><?php  echo $stm_car_location;?></div>
                    </li>
                    <?php 
                    if(!empty($distance)){
                    ?>
                    <li>
                        <div class="grid_view_option_details_key"><span>Distance</span></div>
                        <div class="grid_view_option_details_value"><?php  echo $distance;?></div>
                    </li>
                    <?php 
                    }
                    ?>
                    <li>
                        <div class="grid_view_option_details_key"><svg width="16" height="14" viewBox="0 0 16 14" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M16 8.11352C16 5.92798 15.1187 3.94466 13.6933 2.49936C13.6822 2.48457 13.6703 2.47009 13.6568 2.45661C13.6433 2.44313 13.6289 2.43127 13.6141 2.4202C12.1688 0.994732 10.1855 0.113525 8 0.113525C5.81451 0.113525 3.83119 0.994784 2.38584 2.4202C2.37104 2.43132 2.35662 2.44318 2.34313 2.45661C2.32965 2.47009 2.3178 2.48452 2.30668 2.49936C0.881259 3.94466 0 5.92798 0 8.11352C0 10.2501 0.831948 12.2587 2.34256 13.7697C2.34277 13.7699 2.34298 13.7702 2.34319 13.7704C2.34334 13.7705 2.34345 13.7706 2.34361 13.7708C2.34382 13.771 2.34403 13.7712 2.34424 13.7714C2.42104 13.8482 2.5217 13.8865 2.62237 13.8865C2.72309 13.8865 2.82382 13.8481 2.90062 13.7713C2.90717 13.7647 2.9131 13.7577 2.91908 13.7508L4.13152 12.5383C4.28517 12.3846 4.28517 12.1356 4.13152 11.9819C3.97786 11.8283 3.72873 11.8283 3.57513 11.9819L2.62898 12.9281C1.52572 11.7004 0.885666 10.1552 0.797639 8.50697H2.13571C2.353 8.50697 2.52915 8.33086 2.52915 8.11352C2.52915 7.89619 2.353 7.72008 2.13571 7.72008H0.797744C0.889233 6.02712 1.56721 4.48766 2.63155 3.30151L3.57513 4.24509C3.65193 4.32189 3.75266 4.36029 3.85332 4.36029C3.95399 4.36029 4.05472 4.32189 4.13152 4.24509C4.28517 4.09139 4.28517 3.84231 4.13152 3.68866L3.18799 2.74503C4.37419 1.68069 5.9136 1.00271 7.60656 0.911269V2.24929C7.60656 2.46663 7.78271 2.64273 8 2.64273C8.21729 2.64273 8.39344 2.46663 8.39344 2.24929V0.911269C10.0864 1.00271 11.6258 1.68074 12.812 2.74508L11.8684 3.68866C11.7148 3.84236 11.7148 4.09144 11.8684 4.24509C11.9452 4.32189 12.046 4.36029 12.1466 4.36029C12.2473 4.36029 12.348 4.32189 12.4248 4.24509L13.3684 3.30151C14.4327 4.48772 15.1108 6.02712 15.2022 7.72008H13.8642C13.6469 7.72008 13.4707 7.89619 13.4707 8.11352C13.4707 8.33086 13.6469 8.50697 13.8642 8.50697H15.2023C15.1142 10.1552 14.4742 11.7004 13.371 12.9281L12.4248 11.9819C12.2712 11.8283 12.0221 11.8283 11.8684 11.9819C11.7148 12.1356 11.7148 12.3847 11.8684 12.5383L13.1004 13.7703C13.1772 13.8471 13.278 13.8855 13.3786 13.8855C13.4289 13.8855 13.4793 13.8759 13.5267 13.8567C13.574 13.8375 13.6184 13.8087 13.6569 13.7703C15.1678 12.2593 16 10.2503 16 8.11352Z" fill="#BCBCBC"/>
<path d="M9.8075 3.60158C9.60569 3.52074 9.37676 3.61874 9.29597 3.8205L8.15903 6.65853C8.10605 6.65286 8.05306 6.64898 8.00003 6.64898C7.44627 6.64898 6.94607 6.95571 6.69453 7.44946C6.4316 7.9656 6.49896 8.58231 6.87457 9.09903C6.91297 9.15186 6.96123 9.20017 7.01442 9.23883C7.31958 9.46068 7.66041 9.57793 8.00003 9.57793C8.55378 9.57793 9.05403 9.2712 9.30552 8.77746C9.56845 8.26131 9.50109 7.64466 9.12575 7.1283C9.08735 7.07532 9.03898 7.02685 8.98563 6.98803C8.95693 6.96715 8.92761 6.9481 8.89828 6.92911L10.0264 4.11306C10.1072 3.91141 10.0092 3.68237 9.8075 3.60158ZM8.6043 8.42026C8.48779 8.64893 8.25624 8.79099 7.99997 8.79099C7.83189 8.79099 7.66271 8.73229 7.49694 8.61646C7.30809 8.3453 7.271 8.05132 7.3957 7.8066C7.51216 7.57793 7.74371 7.43587 8.00003 7.43587C8.08176 7.43587 8.1637 7.45003 8.24543 7.47757C8.2481 7.47868 8.25057 7.48009 8.2533 7.48119C8.2619 7.4846 8.27056 7.48738 8.27921 7.49016C8.35423 7.51896 8.42893 7.55862 8.503 7.61035C8.6918 7.88151 8.72895 8.17554 8.6043 8.42026Z" fill="#BCBCBC"/>
</svg><span>Mileage</span></div>
                        <div class="grid_view_option_details_value"><?php  echo $mileage;?> mi</div>
                    </li>
                    <li>
                        <div class="grid_view_option_details_key"><i class="fa fa-bolt" aria-hidden="true"></i><span>Engine</span></div>
                        <div class="grid_view_option_details_value"><?php  echo $engine;?></div>
                    </li>
                    <!--<li>
                        <div class="grid_view_option_details_key"><i class="fa fa-inbox" aria-hidden="true"></i>MOT</div>
                        <div class="grid_view_option_details_value"><?php  echo $mot;?></div>
                    </li>-->
                    <li>
                        <div class="grid_view_option_details_key"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span>Seller</span></div>
                        <div class="grid_view_option_details_value"><?php  echo $Seller->name;?></div>
                    </li>
                </ul>
            </div>
            <div class="footer_elements">
            <div class="gridview_readmore">
            
                <a 
<?php 
                if(!empty($URL)){
                    echo " target='_blank' ";
                }
                ?>

                href="<?php 
                
                if(!empty($URL)){
                    echo $URL;
                }
                else{
                    echo get_permalink();
                }
                ?>">More Details</a>
            </div>
         <!--   <?php if(!empty($show_favorite) and $show_favorite): ?>
                <div
                    class="stm-listing-favorite"
                    data-id="<?php echo esc_attr(get_the_id()); ?>"
                    data-toggle="tooltip"  data-placement="auto left" title="<?php esc_attr_e('Add to favorites', 'motors') ?>">
                    <i class="stm-service-icon-staricon"></i><?php esc_attr_e('', 'motors') ?>
                </div>
            <?php endif; ?>

   
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
            
        <?php endif; ?> -->

            </div>

		</div>
	
</div>
</div>
<?php else:

    get_template_part('partials/listing-cars/listing-grid-loop-magazine');

endif; ?>

