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

?>


<div class="stm-isotope-sorting stm-isotope-sorting-list list_user_id_<?php echo $event_id; ?>  dealerlistingpage eventlistingpage">
              <div class="listing-list-loop stm-listing-directory-list-loop stm-isotope-listing-item ">
                    <div class="listing-top-container">    
					<div class="col-md-3 col-sm-3 col-xs-12 listing-image-sidebar">
						<div class="image hee">
                            <!--Hover blocks-->
                            <?php
$images = get_field('event_image', $event_id);
//print_r($images);
// if($none_dealer_user->ID == get_current_user_id()){
// $authorurl = esc_url(stm_get_author_link('myself-view'));
// }

?>
                            <a href="<?php echo $authorurl ?>" class="rmv_txt_drctn">
								
								<?php if ($images)
{ ?>
									<div class="image-inner">
										<img  src="<?php echo $images[0]['url']; ?>" class="lazy img-responsive" alt=" <?php echo $images[0]['alt']; ?>" style="display: block;">
									</div>
								<?php
}
else
{ ?>
							
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
                                <!--Title-->
                                <div class="title heading-font">
                                    <a  href="<?php echo $authorurl; ?>" class="rmv_txt_drctn"  style="display: none;">
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
								<div class="col-sm-8">
                            <div class="meta-middle contentblockpart">
								<div class="meta-middle titleblockpart">
									<div class="title heading-font titleblocktop">
										<a style="display: inline-block;" href="<?php echo get_permalink($event_id); ?>" target="_blank" class="rmv_txt_drctn dfdg"><?php echo get_the_title($event_id); ?></a>
									</div>
									<span class="vertical-divider"></span>
									<?php /* ?><?php
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
									?><?php */ ?>
									
									<span class="vertical-divider"></span>													
								</div>
								

								<?php
$start_date = get_field('start_date', $event_id);
$start_time = get_field('start_time', $event_id);

$city = get_post_meta($event_id, 'billing_city', true);
$location = get_post_meta($event_id, 'billing_address_1', true) . " " . $city;
if (empty(trim($location)) || trim($location) == ",")
{
    $location = get_field('venue_name', $event_id);
}
?>
								<div class="meta-middle-unit font-exists mileage title_container locationblockpart">
								
									<?php if (!empty($location))
{ ?>
										<div class="meta-middle-unit-top">
											<div class="icon"><i class="stm-service-icon-pin_big"></i></div>
											<div class="name"><?php echo $location; ?>
                                            
												<?php
    $userlat = get_post_meta($none_dealer_user->ID, 'stm_dealer_location_lat', true);
    $userlng = get_post_meta($none_dealer_user->ID, 'stm_dealer_location_lng', true);

    /*Add distance away*/

    if (!empty($_GET['ca_location']) and !empty($_GET['stm_lng']) and !empty($_GET['stm_lat']) and !empty($userlat) and !empty($userlng))
    {
        $distance = stm_calculate_distance_between_two_points(floatval($_GET['stm_lat']) , floatval(floatval($_GET['stm_lng'])) , $userlat, $userlng);
        $current_location = explode(',', sanitize_text_field($_GET['ca_location']));
        $current_location = $current_location[0];

        echo " (" . $distance . ") ";
    }
?>
											</div>
										</div>
									<?php
} ?>   
									<?php if (!empty($start_date))
{ ?>
										<div class="meta-middle-unit-top">
											<div class="icon"><i class="stm-service-icon-calendar_service"></i></div>
											<div class="name"><?php echo $start_date;
    if (!empty($start_time))
    {
        echo "&nbsp;" . $start_time;
    } ?> </div>
										</div>
									<?php
} ?>
								</div>

                                	
                                <?php /* ?><?php if( !empty($stm_seller_notes) ){ ?>
									<div class="meta-middle descblockpart">
										<div class="meta-middle-unit-top">
											<?php echo stripslashes(esc_attr($stm_seller_notes)); ?>
										</div>
									</div>
								<?php } ?><?php */ ?>
								
                                    <!--<div class="meta-middle-unit font-exists engine">
                                        <div class="meta-middle-unit-top">
                                            <div class="icon"><i class="fa fa-globe"></i></div>
                                            <div class="name"><a target="_blank" href="<?php //echo get_user_meta($none_dealer_user->ID,'stm_website_url',true);
 ?>">View Website </a>    </div>
                                        </div>

                                        <div class="value h5">
                                                              </div>
                                     </div>-->

                                     <!--<div class="meta-middle-unit font-exists location">
                                        <div class="meta-middle-unit-top">
                                            <div class="icon"><i class="stm-service-icon-sales_phone"></i></div>
                                            <div class="name"> <div class="stm-tooltip-link" data-placement="bottom" title="" data-original-title="493432">
                                                <?php
// $phone =  get_user_meta($none_dealer_user->ID,'stm_phone',true);
// if(empty($phone)){
// $phone = get_user_meta($none_dealer_user->ID,'billing_phone',true);
// }
// echo FormatPhone($phone);

?>                       
                                            </div></div>
                                        </div>

                                        <div class="value">
                                           
                                        </div>
                                    </div>-->
                                    <!--<div class="meta-middle-unit font-exists engine">
													<div class="meta-middle-unit-top">
														<div class="icon"><i class="fa fa-envelope"></i></div>
														<div class="name"><a target="_blank" href="#">Contact</a></div>
													</div>

													<div class="value h5">
														
													</div>
									</div>
                                    <div class="meta-middle-unit meta-middle-divider"></div>-->


                                
                            </div>
												</div>
												<div class="col-sm-4">
												<div class="right_content new-contact-list">
							
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
												</div>
                            <!--Item options-->
                            <div class="meta-bottom">
								<?php if ($event_desc)
{ ?>
								<div class="descblockpart">
									<div class="meta-middle-unit-top">
										<?php echo wp_trim_words($event_desc, 50); ?>
									</div>
								</div>
								<?php
} ?>
								
								<div class="single-car-actions">
                                	<div class="panel-group acc_container">
										<div class="acc_inner">
										<?php
$category_event = get_field('category_event', $event_id);
//print_r($category_event);
if ($category_event)
{
    foreach ($category_event as $cat)
    {
?>
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
							</div>
                        	
							<div class="rowdatabottom">				
								<div class="col-md-12 col-sm-12 col-xs-12 listing-image-sidebar">
									<div id="<?php echo $event_id; ?>" class="">
										<div class="panel-body">
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
											<?php
} ?>
									
							               </ul>
										</div>
									</div>
								</div>
							</div>
							
						</div>											
					</div>
					
					<!-- <div class="col-md-2 col-sm-2 col-xs-12">
						<div class="right_content">
							
							<div class="meta-right-unit meta-right-unit-btn font-exists website event_detail">
								<a target="_blank" href="<?php echo get_permalink($event_id); ?>">
									<div class="meta-right-unit-inner">
										<div class="name">
											<span>Event Details</span> <i class="fa fa-arrow-right"></i>  
										</div>
									</div>
								</a>
							</div>
							
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
							</div> -->
							
							<!--<div class="meta-right-unit meta-right-unit-btn font-exists moredetails">
								<a target="_blank" href="<?php echo $authorurl; ?>">
									<div class="meta-right-unit-inner">
										<div class="name">
											<span>HDC Listing</span> <i class="fa fa-arrow-right"></i>  
										</div>
									</div>
								</a>
							</div>-->
							
							<?php /* ?><?php  $phone =  get_user_meta($none_dealer_user->ID,'stm_phone',true);
							if(empty($phone)){
								$phone = get_user_meta($none_dealer_user->ID,'billing_phone',true); 
							}
							if(!empty($phone)){
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
							<?php } ?><?php */ ?>
													
						<!-- </div>
					</div> -->
					
					<div style="clearfix"></div>
				</div>
					
					
					
									
                </div>
            </div>
