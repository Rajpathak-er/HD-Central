<?php
// // Get the user object.
// $user = get_userdata( $none_dealer_user->ID );
// $user_roles = $user->roles;
// //print_r($user_roles);
// $query = (function_exists('stm_user_listings_query')) ? stm_user_listings_query($user_id, 'publish', 6, false, 0, false, true) : null;
// $bike_count = 0;
// if($query != null && $query->have_posts()){
// $bike_count = $query->found_posts;
// }
// //echo "+++++".$bike_count."<br>";
// $stm_seller_notes = get_the_author_meta( 'stm_seller_notes', $none_dealer_user->ID );
// //echo "++++".$stm_seller_notes."<br>";
//$stm_dealer_logo = get_the_author_meta('stm_dealer_logo', $none_dealer_user->ID );
$event_desc = get_the_content($event_id);
$event_desc = apply_filters('the_content', get_post_field('post_content', $event_id));
$event_desc = get_field('offer_details', $event_id);

$args = array(
    'meta_query' => array(
        array(
            'key' => 'my_offer_id',
            'value' => $event_id,
            'compare' => '='
        )
    )
);
$user_id = 0;
 
$member_arr = get_users($args); //finds all users with this meta_key == 'member_id' and meta_value == $member_id passed in url
 
if ($member_arr) {  // any users found?
  foreach ($member_arr as $user) {  // in my case, there should only be one user with the id
    $user_id = $user->ID;           // so I just get the last one, which should be the only one
  }
} 

 $user_id = get_field('user', $event_id);
if($user_id != 0){


//echo "<br> Event ID in fileeee ". $event_desc.'<br>';
?>
	<div class="stm-isotope-sorting stm-isotope-sorting-list list_user_id_<?php echo $event_id; ?>  dealerlistingpage eventlistingpage">
	    <div class="listing-list-loop stm-listing-directory-list-loop stm-isotope-listing-item ">
			<div class="listing-top-container">
				<div class="col-md-3 col-sm-3 col-xs-12 listing-image-sidebar">
					<div class="image hee">
                        <?php $images = get_field('offer_image', $event_id); 
                       // print_r($images);
                        ?>
                        <!-- external  link -->
									<?php $external_link = get_field('link_to_offer', $event_id); ?>

                        <a target="_blank" href="<?php echo $external_link ?>" class="rmv_txt_drctn">	
							<?php if ($images) { ?>
								<div class="image-inner">
									<img  src="<?php echo $images; ?>" class="lazy img-responsive"  style="display: block;">
								</div>
							<?php
							}else { ?>
								<div class="image-inner">
									<img  src="https://hd-central.com/wp-content/uploads/2020/07/dark.png" class="lazy img-responsive" alt="" style="display: block;">
								</div>
							<?php
							} ?>
						</a>
                    </div>
				</div>
				<div class="col-md-9 col-sm-9 col-xs-12">
                    <div class="content">
                        <div class="meta-top">
							<div class="title heading-font">
                                <a  href="<?php echo $authorurl; ?>" class="rmv_txt_drctn"  style="display: none;">
                                    <?php 
									$business_name = get_the_author_meta('business_name', $user_id);
									if( !empty($business_name) ){
										echo $business_name;
										
									}else{
										echo stm_display_user_name($user_id); 
									}
									 ?>
								</a>
								<?php
								$user_meta = get_userdata($none_dealer_user->ID);

								$user_roles = $user_meta->roles;
								if (in_array("dealerships", $user_roles))
								{
									echo '<img style="display: inline-block;width: 35px;margin-top: -10px;" src="https://hd-central.com/wp-content/uploads/2020/07/dealership_logo.png" width="70px" />';
								}
								?>
                            </div>
						</div> <!--meta top closed-->
						<!--Item parameters-->
						<div class="row">
							<div class="col-sm-8">
								<div class="meta-middle contentblockpart">
									<div class="meta-middle titleblockpart">
										<div class="title heading-font titleblocktop">
											<?php 
											$authorurl =get_author_posts_url($user_id); 
				                            if($user_id == get_current_user_id()){
				                                $authorurl = esc_url(stm_get_author_link('myself-view'));
				                            }
											?>
											<a style="display: inline-block;" href="<?php echo $authorurl; ?>" target="_blank" class="rmv_txt_drctn dfdg"><?php 
									$business_name = get_the_author_meta('business_name', $user_id);
									if( !empty($business_name) ){
										echo $business_name;
										
									}else{
										echo stm_display_user_name($user_id); 
									}
									 ?></a>
										</div>
										<span class="vertical-divider"></span>
										<?php 
												$ratings = stm_get_dealer_marks($user_id);
												if (!empty($ratings['average'])): 
											?>
												<div class="stm-star-rating titleblocktop">
													<div class="inner">
														<div class="stm-star-rating-upper" style="width:<?php echo esc_attr($ratings['average_width']); ?>"></div>
														<div class="stm-star-rating-lower"></div>
													</div>
													<div class="heading-font"><?php echo esc_attr($ratings['average']); ?></div>
												</div>
											<?php									
												else:
											?>
												<div class="stm-star-rating titleblocktop">
													<div class="inner">	
														<div class="stm-star-rating-lower"></div>
													</div>
													<div class="heading-font"><?php echo esc_attr($ratings['average']); ?></div>
												</div>
											<?php 
												endif; 
											?>
										<span class="vertical-divider"></span>
									</div>
									<?php
									$start_date = get_post_meta ($event_id,'offer_end_date', true);
										//$start_date = get_field('offer_end_date', $event_id);
										//$start_time = get_field('start_time', $event_id);

										$city = get_post_meta($user_id, 'billing_city', true);
										$location = get_user_meta($user_id,'stm_dealer_location',true);
											if( empty($location) || trim($location) == "," ){
												$city = get_user_meta($user_id,'billing_city',true);
												$location = get_user_meta($user_id,'billing_address_1',true). " ".$city;
											}


												?>
									<div class="meta-middle-unit font-exists mileage title_container locationblockpart">
										<?php if (!empty($location)) { ?>
											<div class="meta-middle-unit-top">
                                                <div class="icon"><i class="stm-service-icon-pin_big"></i></div>
                                                <div class="name"><?php
													
													echo $location;													
												?>
                                            


                                            <?php 
                                            $userlat =  get_user_meta($none_dealer_user->ID,'stm_dealer_location_lat',true);
                                            $userlng =  get_user_meta($none_dealer_user->ID,'stm_dealer_location_lng',true);
                                            
                                            /*Add distance away*/

                                            if ( ! empty( $_GET['ca_location'] ) and ! empty( $_GET['stm_lng'] ) and ! empty( $_GET['stm_lat'] ) and ! empty( $userlat ) and ! empty( $userlng ) ) {
                                                $distance   = stm_calculate_distance_between_two_points( floatval( $_GET['stm_lat'] ), floatval( floatval( $_GET['stm_lng'] ) ), $userlat, $userlng );
                                                $current_location                                 = explode( ',', sanitize_text_field( $_GET['ca_location'] ) );
                                                $current_location                                 = $current_location[0];
                                                
                                                echo " (".$distance.") ";
                                                
                                            }
                                            
                                            ?></div>
                                            </div>
										<?php } ?>

									</div>  <!--middle unit  vclosed -->

								</div>
							</div><!--col 8  closed-->
							<div class="col-sm-4">
							
								<div class="right_content new-contact-list">
								<?php 
global $post; 
$post = get_post( $event_id, OBJECT );
setup_postdata( $post );
wpfp_link() ;
wp_reset_postdata();
								?>
								    
									
									<?php if($external_link){ ?>
									
									<div class="meta-right-unit meta-right-unit-btn font-exists website event_detail">
										<a target="_blank" href="<?php echo $external_link; ?>">
											<div class="meta-right-unit-inner">
												<div class="name">
													<!-- <span>Event Details</span> <i class="fa fa-arrow-right"></i>   -->
													<img src="<?php echo get_home_url(); ?>/wp-content/uploads/2021/09/website-2-1.png">
													
												</div>
											</div>
										</a>
									</div>
									
									<?php } ?>
									
									<!-- end external link -->
									<div class="meta-right-unit meta-right-unit-btn font-exists website event_detail">
										<a target="_blank" href="<?php echo get_permalink($event_id); ?>">
											<div class="meta-right-unit-inner">
												<div class="name">
													<!-- <span>Event Details</span> <i class="fa fa-arrow-right"></i>   -->
													<img src="https://hd-central.com/wp-content/uploads/2021/09/list-2-1.png">
													
												</div>
											</div>
										</a>
									</div>
									
									<div class="meta-right-unit titleblocktop socialblock contact-tel">
									<div class="meta-right-unit-inner share-in">
										<div class="name">
											<!--<span>Share</span>--><?php echo do_shortcode('[addtoany]'); ?>
										</div>
									</div>
									<ul class="social-media" style="display:none;">
									<?php
										$facebook = get_user_meta($none_dealer_user->ID, 'stm_user_facebook', true);
											if (!empty($facebook)){ ?>
												<li>
													<a class="facebook" target="_blank" href="<?php echo $facebook; ?>"><i title="facebook" class="fa fa-facebook"></i></a>
												</li>
											<?php }
										$twitter = get_user_meta($none_dealer_user->ID, 'stm_user_twitter', true);
										if (!empty($twitter)) { ?>
											<li>
											<a class="twitter" target="_blank" href="<?php echo $twitter; ?>"><i title="twitter" class="fa fa-twitter"></i></a>
											</li>
											<?php
										}
										$linkedin = get_user_meta($none_dealer_user->ID, 'stm_user_linkedin', true);
										if (!empty($linkedin)) { ?>
											<li>
												<a class="linkedin" target="_blank" href="<?php echo $linkedin; ?>"><i title="linkedin" class="fa fa-linkedin-in"></i></a>
											</li>
										<?php
										}
										$youtube = get_user_meta($none_dealer_user->ID, 'stm_user_youtube', true);
										if (!empty($youtube)) { ?>
											<li>
											<a class="tumblr" target="_blank" href="<?php echo $youtube; ?>"><i title="youtube" class="fa fa-youtube-play"></i></a>
											</li>
										<?php } ?>
									
									</ul>
								</div> <!--meta-right-unit titleblocktop--> 
									
									
									
								</div> <!--right_content new-contact-list-->
								

							</div><!--col 4 closed right  -->
						</div> <!--row closed-->
						<div class="meta-bottom row">
							<div class="col-md-8">
								 		<strong style="color: black;"><?php echo get_the_title($event_id); ?></strong>
								 		</div>
								 		<div class="col-md-4">
								 			<?php 
								 				$coupon_code = get_field( 'coupon_code',$event_id);
								 				if(!empty($coupon_code)){
								 					echo "Use Code: " .$coupon_code; 
								 				}
								 			?>
								 		</div>
									</div>
						<!--Item options meta  bottom-->
						<div class="meta-bottom">
							<?php if ($event_desc) { ?>
							<div class="descblockpart">
								<div class="meta-middle-unit-top">
									<?php echo wp_trim_words($event_desc, 50); ?>
								</div>
							</div>
							<?php } ?>
									
							<div class="single-car-actions">
								<div class="panel-group acc_container">
									<div class="acc_inner">
									<?php
										$category_event = get_field('offer_category', $event_id);
										$term_obj_list = get_the_terms( $event_id, 'offer-categories' );
										//print_r($category_event);
										if ($term_obj_list) {
											foreach ($term_obj_list as $cat)
											{ ?>
											   <div class="tagboxservice"><?php echo $cat->name; ?></div>
											<?php
											}
										}
										?>	
										<div class="info_heading" style="display: none;">
											<h4 class="panel-title"><a data-toggle="collapse" href="#more_information_<?php echo $none_dealer_user->ID; ?>"><i class="fa fa-plus"></i> More Information</a></h4>
										</div>
								
									</div>
								</div>							
							</div>        
						</div><!--meta-bottom-->
						<div class="rowdatabottom">				
							<div class="col-md-12 col-sm-12 col-xs-12 listing-image-sidebar">
								<div id="<?php echo $event_id; ?>" class="">
									<div class="">
										<ul class="list-unstyled clearfix">
											<?php
											$additional_details = get_field('additional_details', $event_id);
											//print_r($additional_details);
											if ($additional_details)
											{
											?>
											<li class="car-action-dealer-info additional_details">
												<div class="listing-archive-dealer-info clearfix">
													<div class="row">
														<div class="col-md-12">
															<div class="form-group"> 
															<?php
																foreach ($additional_details as $additional)
																{
																?>
																	<div class="col-md-4 test2">
																		<label>
																			<span><?php echo $additional->name; ?></span>
																		</label>
																	</div>
																<?php
																}
																?>
															</div>
														</div>
													</div>
												</div>
											</li>
											<?php } ?>
							            </ul>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-8 name"  style="color: black;">
								<?php echo "Valid Untill: ".  date("Y-m-d", strtotime($start_date));?>
								
								</div>
								<div class="col-sm-4">
									<a  style="font-size: 12px;" target="_blank" href="<?php echo $external_link; ?>">Click here for more details</a>
								</div>
							</div>
						</div><!--rowdata-->
					</div><!--content-->
				</div><!--col 9  closed-->
			</div><!--listing top  container closed-->
		</div>
	</div>
<?php 
}
?>