<style>
	.dealerlistingpage .content .stm-star-rating {
    max-width: 46% !important;
    margin-left: 5px ;
}
.wpfp-span {
    margin-bottom: -2px;
}
.count_list_n {
    box-shadow: 0px 0px 20px rgb(0 0 0 / 10%);
}
.stm_filter_location {
    box-shadow: 0px 0px 20px rgb(0 0 0 / 10%) !important;
}
.stm-accordion-single-unit.stm-listing-directory-checkboxes.stm-one_col.stm-ajax-checkbox-instant.find-dealership.place_page_listing {
    box-shadow: 0px 0px 20px rgb(0 0 0 / 10%) !important;
}
.stm-accordion-single-unit.stm-listing-directory-checkboxes.stm-one_col.stm-ajax-checkbox-instant.find-dealership.place_page_listing {
    box-shadow: 0px 0px 20px rgb(0 0 0 / 10%) !important;
}
.stm-inventory-sidebar.dealerships-sidebar.\37 6867 {
    box-shadow: 0px 0px 20px rgb(0 0 0 / 10%) !important;
}
.bikeforsaleads.filter.filter-sidebar {
    display: none;
}
</style>
<?php
// Get the user object.
$user = get_userdata($none_dealer_user->ID);
$user_roles = $user->roles;
//print_r($user_roles);
$query = (function_exists('stm_user_listings_query')) ? stm_user_listings_query($user_id, 'publish', 6, false, 0, false, true) : null;

//print_r($query);
$bike_count = 0;
if ($query != null && $query->have_posts())
{
    $bike_count = $query->found_posts;
}
//echo "+++++".$bike_count."<br>";
$stm_seller_notes = get_the_author_meta('stm_seller_notes', $none_dealer_user->ID);
//echo "++++".$stm_seller_notes."<br>";
$stm_dealer_logo = get_the_author_meta('stm_dealer_logo', $none_dealer_user->ID);

//var_dump(stm_display_user_name($none_dealer_user->ID));
$business_name = get_user_meta($none_dealer_user->ID,'business_name',true);

?>


<div class="stm-isotope-sorting stm-isotope-sorting-list list_user_id_<?php echo $none_dealer_user->ID; ?>  dealerlistingpage">
                    <div class="listing-list-loop stm-listing-directory-list-loop stm-isotope-listing-item ">
                    <div class="listing-top-container">    
					<div class="col-md-3 col-sm-3 col-xs-12 listing-image-sidebar">
						<div class="image hee">
                            <!--Hover blocks-->
                            <?php
$authorurl = get_author_posts_url($none_dealer_user->ID);

if ($none_dealer_user->ID == get_current_user_id())
{
    $authorurl = esc_url(stm_get_author_link('myself-view'));
}
?>

<?php
												$membership_level = pmpro_getMembershipLevelForUser($none_dealer_user->ID);
												$level_id = $membership_level->ID;											
												if( $level_id == 10 ){
													$link = $authorurl;
													$target = 'target="_blank"';
												}else{
													$link = 'javascript:void(0)';
													$target = '';
												}
											?>

                            <a href="<?php echo $link ?>" class="rmv_txt_drctn">
								
								<?php if (!empty($stm_dealer_logo))
{ ?>
									<div class="image-inner">
										<img  src="<?php echo $stm_dealer_logo; ?>" class="lazy img-responsive" alt=" <?php echo $none_dealer_user->first_name . " " . $none_dealer_user->last_name;; ?>" style="display: block;">
									</div>
								<?php
}
else
{ ?>
							
									<div class="image-inner">
										<img  src="<?php echo $userimg; ?>" class="lazy img-responsive" alt=" <?php echo $none_dealer_user->first_name . " " . $none_dealer_user->last_name;; ?>" style="display: block;">
									</div>
								<?php
} ?>

								
                            </a>
                            <?php if( $level_id != 10 ){ ?>
                      <a style="    text-align: center;display: block;" class="claim_business" href="<?php echo get_site_url(); ?>/claim-your-business/?userid=<?php echo $none_dealer_user->ID; ?>&sname=<?php echo rawurlencode(htmlspecialchars(stm_display_user_name($none_dealer_user->ID))); ?>"><span>Claim This Businesss</span></a>
                  		<?php } ?>
                        </div>

                      
					</div>


					<div class="col-md-9 col-sm-9 col-xs-12">
                        <div class="content">
                            <div class="meta-top">
                                <!--Title-->
                                <div class="title heading-font">
                                    <a  href="<?php echo $link; ?>" class="rmv_txt_drctn"  style="display: none;">
                                        <?php echo esc_attr(stm_display_user_name($none_dealer_user->ID)); ?>  
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
                            </div>

							<!--Item parameters-->
							<div class="row">
								<div class="col-md-6">
                            <div class="meta-middle contentblockpart">
								<div class="meta-middle titleblockpart">
									<div class="title heading-font titleblocktop 567567">
										<!--<a style="display: inline-block;" href="<?php echo $authorurl; ?>" target="_blank" class="rmv_txt_drctn"><?php $user = get_user_by('id', $none_dealer_user->ID);
/* echo"<pre>";
 print_r($user); */
?>
										<?php echo esc_attr(stm_display_user_name($none_dealer_user->ID)); ?>  </a>-->
										
										
																				
										<a style="display: inline-block;" href="<?php echo $link; ?>" <?php echo $target; ?> class="rmv_txt_drctn">
										<?php $user = get_user_by('id', $none_dealer_user->ID);
/* echo"<pre>";
 print_r($user); */
?>
										<?php

											if(empty($business_name)){
												echo stm_display_user_name($none_dealer_user->ID);
											}else{
												 echo esc_attr($business_name);
											}

										 ?>  </a>
									</div>
									<span class="vertical-divider"></span>
									<?php
$ratings = stm_get_dealer_marks($none_dealer_user->ID);
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
					                    

                                
                            </div>
												</div>
												<div class="col-sm-6">
												<div class="right_content new-contact-list">
													<style type="text/css">
														.add { color: #fff; background-color:#000 ; padding: 11px; border-radius:25px ; font-size: 14px;     margin-right: 0px !important;}
										.remove { color: #eabb3b; background-color:#000 ; padding: 11px; border-radius:25px ; font-size: 14px; margin-right: 0px !important;    }

										img.wpfp-hide.wpfp-img {
												    background-color: transparent;
												}
													</style>
								<?php 
global $post; 
$post = get_post( $group_id, OBJECT );
setup_postdata( $post );
wpfp_link() ;
wp_reset_postdata();
								?>	
							<?php 
											$userid = get_current_user_id();
											$fav_provider = get_user_meta($userid,'fav_place',true);
											//print_r($fav_provider);
											?>
											
							<div class="meta-right-unit meta-right-unit-btn font-exists website">
								<a target="_blank" href="<?php echo get_user_meta($none_dealer_user->ID, 'stm_website_url', true); ?>">
									<div class="meta-right-unit-inner">
										<div class="name">
											<!-- <span>Visit Website</span> <i class="fa fa-arrow-right"></i>   -->
														<!-- <i class="fas fa-globe new-icons"></i> -->
														<!-- 	<span style="color: #17468a;">www</span>  -->
														<img src="<?php echo get_home_url(); ?>/wp-content/uploads/2021/09/website-2-1.png">
										</div>
									</div>
								</a>
							</div>
							<?php
								$membership_level = pmpro_getMembershipLevelForUser($none_dealer_user->ID);
								$level_id = $membership_level->ID;
								if( $level_id == 8 ){
							?>	
							<div class="meta-right-unit meta-right-unit-btn font-exists moredetails">
								<a target="_blank" href="<?php echo $link; ?>">
									<div class="meta-right-unit-inner">
										<div class="name">
										<a class="a2a_dd addtoany_share_save addtoany_share" href="https://www.addtoany.com/share#url= <?php echo get_permalink($event_id); ?>;title=<?php echo get_the_title($event_id); ?>" style="color: #17468a;"><img src="<?php echo get_home_url(); ?>/wp-content/uploads/2020/07/share-2.png"></a>
											<span style="color: #17468a;"><img src="<?php echo get_home_url(); ?>/wp-content/uploads/2020/07/share-2.png"></span>
											<!-- <span>HDC Listing</span> <i class="fa fa-arrow-right"></i>   -->
														<!-- <i class="fas fa-clipboard-list"></i> -->
														
										</div>
									</div>
								</a>
							</div>
							<?php } ?>
							
							<?php $phone = get_user_meta($none_dealer_user->ID, 'stm_phone', true);
if (empty($phone))
{
    $phone = get_user_meta($none_dealer_user->ID, 'billing_phone', true);
}
if (!empty($phone))
{
?>
							<div class="meta-right-unit meta-right-unit-btn font-exists contact-tel">
								<a target="_blank" href="tel:<?php echo $phone; ?>">
									<div class="meta-right-unit-inner">
										<div class="name">
											<!-- <span><?php

    echo FormatPhone($phone);
?>     </span> <i class="fa fa-phone"></i> -->
														<span style="color: #17468a;"><img src="<?php echo get_home_url(); ?>/wp-content/uploads/2021/09/call-2-1.png" style="height: 26px;width: 26px;"></span>
										</div>
									</div>
								</a>
								                               
							</div>
						<?php
} ?>
					
							<div class="meta-right-unit titleblocktop socialblock contact-tel">
								<div class="meta-right-unit-inner share-in">
										<div class="name">
	<a class="a2a_dd addtoany_share_save addtoany_share" href="https://www.addtoany.com/share#url= <?php echo get_permalink($event_id); ?>;title=<?php echo get_the_title($event_id); ?>" style="color: #17468a;"><img src="<?php echo get_home_url(); ?>/wp-content/uploads/2020/07/share-2.png"></a>
										</div>
									</div>						
									
								<ul class="social-media" style="display:none;">
								<?php
$facebook = get_user_meta($none_dealer_user->ID, 'stm_user_facebook', true);
if (!empty($facebook))
{ ?>
										<li>
											<a class="facebook" target="_blank" href="<?php echo $facebook; ?>"><i title="facebook" class="fa fa-facebook"></i></a>
										</li>
								<?php
}
$twitter = get_user_meta($none_dealer_user->ID, 'stm_user_twitter', true);
if (!empty($twitter))
{ ?>
										<li>
											<a class="twitter" target="_blank" href="<?php echo $twitter; ?>"><i title="twitter" class="fa fa-twitter"></i></a>
										</li>
								<?php
}
$linkedin = get_user_meta($none_dealer_user->ID, 'stm_user_linkedin', true);
if (!empty($linkedin))
{ ?>
										<li>
											<a class="linkedin" target="_blank" href="<?php echo $linkedin; ?>"><i title="linkedin" class="fa fa-linkedin-in"></i></a>
										</li>
								<?php
}
$youtube = get_user_meta($none_dealer_user->ID, 'stm_user_youtube', true);
if (!empty($youtube))
{ ?>
										<li>
											<a class="tumblr" target="_blank" href="<?php echo $youtube; ?>"><i title="youtube" class="fa fa-youtube-play"></i></a>
										</li>
								<?php
} ?>
								
								<li>
								
								</li>
								
								</ul>
							</div>
							
						</div>
												</div>
												</div>




<div class="row">
	
	<div class="col-xs-12" style="padding-top: 11px;
    padding-bottom: 11px;
    border-bottom: 1px dashed #dddddd;border-top: 1px dashed #dddddd;">
		
			

								<?php
$location = get_user_meta($none_dealer_user->ID, 'stm_dealer_location', true);
if (empty($location) || trim($location) == ",")
{
    $city = get_user_meta($none_dealer_user->ID, 'billing_city', true);
    $location = get_user_meta($none_dealer_user->ID, 'billing_address_1', true) . " " . $city;
}
if (!empty($location))
{
?>
								<div class="meta-middle-unit font-exists mileage title_container locationblockpart">
									
									<div class="meta-middle-unit-top" style="padding-left: 0px !important;">
                                                <div class="icon" style="float: left;"><i class="stm-service-icon-pin_big"></i></div>
                                                <div class="name"><?php
    echo $location;
?>
                                            


                                            <?php
    $userlat = get_user_meta($none_dealer_user->ID, 'stm_dealer_location_lat', true);
    $userlng = get_user_meta($none_dealer_user->ID, 'stm_dealer_location_lng', true);

    /*Add distance away*/

    if (!empty($_GET['ca_location']) and !empty($_GET['stm_lng']) and !empty($_GET['stm_lat']) and !empty($userlat) and !empty($userlng))
    {
        $distance = stm_calculate_distance_between_two_points(floatval($_GET['stm_lat']) , floatval(floatval($_GET['stm_lng'])) , $userlat, $userlng);
        $current_location = explode(',', sanitize_text_field($_GET['ca_location']));
        $current_location = $current_location[0];

        echo " (" . $distance . ") ";

    }

?></div>
                                            </div>
                                            <div class="value h5">
												

                                        </div>

                                    </div>

                                	<?php
} ?>
            

	</div>
</div>
												
<?php if (!empty($stm_seller_notes))
{ ?>
	<div class="row">
													<div class="col-md-12" style="padding-top: 10px;padding-bottom: 10px;">
									<div class="meta-middle descblockpart">
										<div class="meta-middle-unit-top">
											<?php echo stripslashes(esc_attr($stm_seller_notes)); ?>
										</div>
									</div>

									 </div>
												</div>
								<?php
} ?>

                            <!--Item options-->
                            <div class="meta-bottom">

                                <div class="single-car-actions">
                                	<div class="panel-group acc_container">
										<div class="acc_inner">
												<?php
$places = get_user_meta($none_dealer_user->ID, 'place_categories', true);
//$places = explode(',', $places);
if ($places)
{
    foreach ($places as $place)
    {
        $placename = get_term_by('id', $place, 'place-categories')
?>
													<div class="tagboxservice"> 
														<?php echo $placename->name; ?>
													</div>
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
                        </div>
                        	
						
						
                    </div>
					
					</div>
					
					<!-- <div class="col-md-2 col-sm-2 col-xs-12">
						<div class="right_content">
							
							<div class="meta-right-unit meta-right-unit-btn font-exists website">
								<a target="_blank" href="<?php echo get_user_meta($none_dealer_user->ID, 'stm_website_url', true); ?>">
									<div class="meta-right-unit-inner">
										<div class="name">
											<span>Visit Website</span> <i class="fa fa-arrow-right"></i>  
										</div>
									</div>
								</a>
							</div>
							
							<div class="meta-right-unit meta-right-unit-btn font-exists moredetails">
								<a target="_blank" href="<?php echo $authorurl; ?>">
									<div class="meta-right-unit-inner">
										<div class="name">
											<span>HDC Listing</span> <i class="fa fa-arrow-right"></i>  
										</div>
									</div>
								</a>
							</div>
							<?php $phone = get_user_meta($none_dealer_user->ID, 'stm_phone', true);
if (empty($phone))
{
    $phone = get_user_meta($none_dealer_user->ID, 'billing_phone', true);
}
if (!empty($phone))
{
?>
							<div class="meta-right-unit meta-right-unit-btn font-exists contact-tel">
								<a target="_blank" href="tel:<?php echo $phone; ?>">
									<div class="meta-right-unit-inner">
										<div class="name">
											 <span><?php

    echo FormatPhone($phone);
?>     </span> <i class="fa fa-phone"></i>
										</div>
									</div>
								</a>
								                               
							</div>
						<?php
} ?>
					
							<div class="meta-right-unit titleblocktop socialblock contact-tel">
								<div class="meta-right-unit-inner">
										<div class="name">
											 <span>Share</span> <?php echo do_shortcode('[addtoany]'); ?>
										</div>
									</div>						
									
								<ul class="social-media" style="display:none;">
								<?php
$facebook = get_user_meta($none_dealer_user->ID, 'stm_user_facebook', true);
if (!empty($facebook))
{ ?>
										<li>
											<a class="facebook" target="_blank" href="<?php echo $facebook; ?>"><i title="facebook" class="fa fa-facebook"></i></a>
										</li>
								<?php
}
$twitter = get_user_meta($none_dealer_user->ID, 'stm_user_twitter', true);
if (!empty($twitter))
{ ?>
										<li>
											<a class="twitter" target="_blank" href="<?php echo $twitter; ?>"><i title="twitter" class="fa fa-twitter"></i></a>
										</li>
								<?php
}
$linkedin = get_user_meta($none_dealer_user->ID, 'stm_user_linkedin', true);
if (!empty($linkedin))
{ ?>
										<li>
											<a class="linkedin" target="_blank" href="<?php echo $linkedin; ?>"><i title="linkedin" class="fa fa-linkedin-in"></i></a>
										</li>
								<?php
}
$youtube = get_user_meta($none_dealer_user->ID, 'stm_user_youtube', true);
if (!empty($youtube))
{ ?>
										<li>
											<a class="tumblr" target="_blank" href="<?php echo $youtube; ?>"><i title="youtube" class="fa fa-youtube-play"></i></a>
										</li>
								<?php
} ?>
								
								<li>
								
								</li>
								
								</ul>
							</div>
							
						</div>
					</div> -->
					<div style="clearfix"></div>
					</div>
					
					<div class="rowdatabottom">
						<div class="col-md-3 col-sm-3 col-xs-12 listing-image-sidebar">
							<div class="panel-group acc_container">
								<div class="acc_inner" style="display:none;">
					
						<?php
$promotion = get_user_meta($none_dealer_user->ID, 'my_offer_id', true);
if (!empty($promotion) || $promotion == 1)
{
    $offer_title = get_the_title($promotion);
    $offer_details = get_post_meta($promotion, 'offer_details', true);
    $link_to_offer = get_post_meta($promotion, 'link_to_offer', true);
    $offer_end_date = get_post_meta($promotion, 'offer_end_date', true);
    $offer_image = get_post_meta($promotion, 'offer_image', true);

?>

						<div class="tagboxservice Offers_tag" style="cursor: pointer;" data-toggle="modal" data-target="#exampleModal<?php echo $none_dealer_user->ID; ?>"> 
							Offers Available
						</div>
						<!-- Modal -->
						<div class="modal fade serviceofferpopup" id="exampleModal<?php echo $none_dealer_user->ID; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						  <div class="modal-dialog" role="document">
						    <div class="modal-content">
						      <div class="modal-header">
						        <h2 class="modal-title" id="exampleModalLabel"><?php echo $offer_title; ?></h2>
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						          <span aria-hidden="true">&times;</span>
						        </button>
						      </div>
						      <div class="modal-body">
						      	<div>
						      	
						        <div style="min-height: 100px;">
						        	<?php if ($offer_image)
    { ?>
						        
						        	<img align="right" style="padding-left: 10px" src="<?php echo wp_get_attachment_url($offer_image); ?>"/>
						        
						        <?php
    } ?>
						        	<?php echo $offer_details; ?></div>
						        </div>
						        <div style="display:block;clear: both;margin-top: 20px;">
						        <?php
    $terms = get_the_terms($promotion, 'offer-categories');

    if ($terms && !is_wp_error($terms)):
        $draught_links = array();
        foreach ($terms as $term)
        {

            echo '<div class="tagboxservice Offers_tag">';
            echo $term->name;
            echo "</div>";
        }
    endif; ?>
								</div>
						      </div>
						      <div class="modal-footer">
						        <div style="float: left;text-align: left;display: block;">Valid Untill: <?php
    $date = new DateTime($offer_end_date);
    echo $date->format('m-d-Y'); ?>
								</div> 
								<a href="<?php echo $link_to_offer; ?>">Click here for more details</a> 
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						        
						      </div>
						    </div>
						  </div>
						</div>
					<?php
} ?>
					</div>
					
					<?php
						$curdate = date('Ymd');
						$args = array(
						   'post_type' => 'event',
						   'posts_per_page' => -1,
						   'post_status' => 'publish',
						   'author' => $none_dealer_user->ID,
						   'meta_query' => array(
								array(
									'key'       => 'start_date',
									'compare'   => '>=',
									'value'     => $curdate,
								),
						   ),
						);
						$event_query = new WP_Query( $args );
						//echo "+++".$event_query->found_posts."<br>";
						$post_count = $event_query->found_posts;
						
						if( $post_count > 0 ){
					?>					
					<div class="acc_inner">
						<a class="tagboxservice Offers_tag events" style="text-decoration: none;" href="<?php echo get_permalink(41646); ?>" target="_blank"> 
							Event
						</a>
					</div>
					<?php
						}
					?>
					
					
				</div>
						</div>
						
						<div class="col-md-9 col-sm-9 col-xs-12 listing-image-sidebar">

							<div id="<?php echo $none_dealer_user->ID; ?>" class="">
								
								<div class="panel-body">

                                    <ul class="list-unstyled clearfix">
											
										<?php
$services = array();
$servicesdata = get_user_meta($none_dealer_user->ID, 'things_to_do', true);
if (is_array($services))
{
    $services = array_merge($services, $servicesdata);
}

if ($services)
{
?>
                                        <li class="car-action-dealer-info">
                                            <div class="listing-archive-dealer-info clearfix">
												<div class="row">
													<div class="col-md-12">
														<div class="form-group">
															
															<?php
    if (!is_array($services))
    {
        $servicesarray = json_decode($services, true);
    }
    else
    {
        $servicesarray = $services;
    }
    // echo "+++<br>";
    //print_r($servicesarray);
    foreach ($servicesarray as $key => $service)
    {
?>
																<div class="col-md-4 test2">
																	<label>

																		<span><?php echo get_term($service)->name; ?></span>
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
									<?php
} ?>

                                </ul>
                            </div>
                        </div>
						</div>
						
					</div>
					
					
                </div>
            </div>
