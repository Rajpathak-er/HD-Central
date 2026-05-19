<?php
$regular_price_label = get_post_meta(get_the_ID(), 'regular_price_label', true);
$special_price_label = get_post_meta(get_the_ID(),'special_price_label',true);

$price = get_post_meta(get_the_id(),'price',true);
$sale_price = get_post_meta(get_the_id(),'sale_price',true);

$car_price_form_label = get_post_meta(get_the_ID(), 'car_price_form_label', true);

$data = array(
    'data_price' => 0,
    'data_mileage' => 0,
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

$mileage = get_post_meta(get_the_id(),'mileage',true);

if(!empty($mileage)) {
    $data['data_mileage'] = $mileage;
}

$data['class'] = array('animated fadeIn');

?>

<?php stm_listings_load_template('loop/classified/grid/start', $data); ?>

        <?php stm_listings_load_template('loop/classified/grid/image', $data); ?>

        <div class="listing-car-item-meta">
            <?php stm_listings_load_template('loop/default/grid/title_price_new', array('price' => $price, 'sale_price' => $sale_price, 'car_price_form_label' => $car_price_form_label)); ?>

            <?php stm_listings_load_template('loop/classified/grid/data'); ?>
			
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
							<div class="grid_share">
							<div class="stm-listing-favorite" data-id="40600" data-toggle="tooltip" data-placement="auto left" title="" data-original-title="Add to favorites">
							<i class="stm-service-icon-staricon"></i>                </div>


							<!--Compare-->
								<div class="stm-listing-compare" data-id="40600" data-title="Harley Davidson XLH1200 1993 Grey" data-toggle="tooltip" data-placement="auto left" title="" data-original-title="Add to compare">
							<i class="stm-service-icon-compare-new"></i>                 </div>
										 

							<div class="stm-shareble">
							<a href="#" class="btn btn-share ">
							<i class="stm-icon-share"></i>   


									</a><div class="stm-a2a-popup"><a href="#" class="btn btn-share ">
							</a><div class="addtoany_shortcode"><a href="#" class="btn btn-share "></a><div class="a2a_kit a2a_kit_size_24 addtoany_list" data-a2a-url="https://hd-central.com/listings/harley-davidson-xlh1200-1993-grey/" data-a2a-title="Harley Davidson XLH1200 1993 Grey" style="line-height: 24px;"><a href="#" class="btn btn-share "></a><a class="a2a_dd addtoany_share_save addtoany_share" href="https://www.addtoany.com/share#url=https%3A%2F%2Fhd-central.com%2Flistings%2Fharley-davidson-xlh1200-1993-grey%2F&amp;title=Harley%20Davidson%20XLH1200%201993%20Grey"><img src="//i0.wp.com/hd-central.com/wp-content/uploads/2020/07/share-2.png" alt="Share"></a></div></div>                </div>
									

							</div>

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
      

            </div>

        </div>
    </div>
</div>