<style>

.meta-right-unit.meta-right-unit-btn.font-exists.website.event_detail,.meta-right-unit.titleblocktop.socialblock {
    width: 35px!important;
    height: 35px;
    background: #000!important;
    border-radius: 40px!important;
    margin-right: 10px!important;
    flex: 0 0 35px!important;
    text-align: center;
    line-height: 26px;
    padding: 5px 5px;
    margin-bottom: 10px;
}
.page-id-41646 .right_content.new-contact-list {
    margin: -6px 0 0 0;
    padding: 6px 0;
}
.stm-template-listing_four .listing-list-loop.stm-listing-directory-list-loop .meta-middle {
    margin-bottom: 10px !important;
}
.tagboxservice {
    border: 1px solid #000;
    background-color: #000;
    color: #fff;
    padding: 5px 15px;
}
.acc_inner {
    background-color: transparent;
    padding: 10px;
}
.wpfp-span a {
    color: #cc0000 !important;
}
.title.heading-font .rmv_txt_drctn {
    padding-bottom: 5px;
	    letter-spacing: 0px;
}
</style>

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
//echo "<br> Event ID in fileeee ". $event_desc.'<br>';
?>
	<div class="stm-isotope-sorting stm-isotope-sorting-list list_user_id_<?php echo $event_id; ?>  dealerlistingpage eventlistingpage">
	    <div class="listing-list-loop stm-listing-directory-list-loop stm-isotope-listing-item ">
			<div class="listing-top-container">
				<div class="col-md-3 col-sm-3 col-xs-12 listing-image-sidebar">
					<div class="image hee">
                        <?php $images = get_field('event_image', $event_id); ?>
                        <a href="<?php echo $authorurl ?>" class="rmv_txt_drctn">	
							<?php if ($images) { ?>
								<div class="image-inner">
									<img  src="<?php echo $images['url']; ?>" class="lazy img-responsive" alt="<?php echo $images['alt']; ?>" style="display: block;">
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
								<?php
								$user_meta = get_userdata($none_dealer_user->post_author);
								// echo "<pre>";
								// print_r($user_meta); exit;
								?>
                                <a  href="https://hd-central.com/<?php echo $user_meta->data->user_nicename; ?>" class="rmv_txt_drctn">
                                    <?php echo $user_meta->data->user_login; ?>
								</a>
								<?php
								$user_roles = $user_meta->roles;
								//var_dump($user_meta);
								if (!empty($user_meta) && in_array("dealerships", $user_roles))
								{
									echo '<img style="display: inline-block;width: 35px;margin-top: -10px;" src="https://hd-central.com/wp-content/uploads/2020/07/dealership_logo.png" width="70px" />';
								}
								?>
                            </div>
						</div> <!--meta top closed-->
						<!--Item parameters-->
						<div class="row">
							<div class="col-sm-6">
								<div class="meta-middle contentblockpart">
									<div class="meta-middle titleblockpart">
										<div class="title heading-font titleblocktop">
											<a style="display: inline-block;" href="<?php echo get_permalink($event_id); ?>" target="_blank" class="rmv_txt_drctn dfdg"><?php echo get_the_title($event_id); ?></a>
										</div>
										<span class="vertical-divider"></span>
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


								</div>
							</div><!--col 8  closed-->
							<div class="col-sm-6">
							
								<div class="right_content new-contact-list">
								

<style type="text/css">
	
	.wpfp-span a { color:#cc0000 !important; }
</style>
									<div class="rowdatabottom11">				
							<div class="col-md-12 col-sm-12 col-xs-12 listing-image-sidebar">
								<div id="<?php echo $event_id; ?>" class="">
									<style type="text/css">
										.add { color: #fff; background-color:#000 ; padding: 11px; border-radius:25px ; font-size: 14px;     margin-right: -15px !important;}
										.remove { color: #eabb3b; background-color:#000 ; padding: 11px; border-radius:25px ; font-size: 14px;     margin-right: -15px !important; }
                                          img.wpfp-hide.wpfp-img {
												    background-color: transparent;
												}
												   
									</style>
								<?php 
global $post; 
$post = get_post( $event_id, OBJECT );
setup_postdata( $post );
wpfp_link() ;
wp_reset_postdata();
								?>





									<div class="panel-body" style="display: none;">
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
						</div><!--rowdata-->

								    <!-- external  link -->
									<?php $external_link = get_field('external_link', $event_id); ?>
									
									<?php if($external_link){ ?>
									
									<div class="meta-right-unit meta-right-unit-btn font-exists website event_detail">
										<a target="_blank" href="<?php echo $external_link; ?>">
											<div class="meta-right-unit-inner">
												<style type="text/css">
													#bike-extra { color: #17468a !important; }
												</style>
												<div class="name" id="bike-extra">
													<!-- <span style="color: #17468a;">www</span> -->
													 <!-- <span>Event Details</span> <i class="fa fa-arrow-right"></i> -->
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
												<div class="name" id="bike-extra" style="color:#fff !important;">
													view 
													<!-- <span>Event Details</span> <i class="fa fa-arrow-right"></i>  -->
													<!-- <img src="https://hd-central.com/wp-content/uploads/2021/09/list-2-1.png">  -->
													
												</div>
											</div>
										</a>
									</div>
									
									<div class="meta-right-unit titleblocktop socialblock contact-tel">
									<div class="meta-right-unit-inner share-in">
										<div class="name" id="bike-extra">
											<!--<span>Share</span>--><?php //echo do_shortcode('[addtoany]'); ?>

<a class="a2a_dd addtoany_share_save addtoany_share" href="https://www.addtoany.com/share#url= <?php echo get_permalink($event_id); ?>;title=<?php echo get_the_title($event_id); ?>" style="color: #17468a;"><img src="<?php echo get_home_url(); ?>/wp-content/uploads/2020/07/share-2.png"> </a>
											


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

							<div class="meta-middle-unit font-exists mileage title_container locationblockpart">
<style type="text/css"> #loc-date { padding-top: 11px;
    padding-bottom: 11px;border-bottom: 1px dashed #dddddd;padding-left: 0px; }</style>
										<div class="col-xs-12" id="loc-date">
											<div class="row">
							<div class="col-sm-7" style="padding-left: 0px !important;">
										<?php if (!empty($location)) { ?>
											<div class="meta-middle-unit-top">
												<div class="icon" style="float: left;">
													<i class="stm-service-icon-pin_big"></i>
												</div>
												<div class="name">
													<?php 
														echo $location; 
														//echo " ".$event_id;
														$userlat = get_post_meta($event_id, 'lat', true);
														$userlng = get_post_meta($event_id, 'lng', true);

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
										<?php } ?>
</div>

										<?php if (!empty($start_date)) { ?>
											<div class="col-sm-5">
											<div class="meta-middle-unit-top" style="padding-left: 32px;">
												<div class="icon" style="float: left;">
													<i class="stm-service-icon-calendar_service"></i>
												</div>
												<div class="name">
													<?php echo $start_date;
													if (!empty($start_time))
													{
														echo "&nbsp;" . $start_time;
													} ?> 
												</div>
										   </div>
										</div>
									    <?php } ?>
									</div></div>
									</div>  <!--middle unit  vclosed -->


						
						<!--Item options meta  bottom-->
						<div class="meta-bottom" style="padding-top: 5px;">
							<?php if ($event_desc) { ?>
							<div class="descblockpart">
								<div class="meta-middle-unit-top" style="padding-top: 11px;padding-bottom: 11px;">
									<?php echo wp_trim_words($event_desc, 50); ?>
								</div>
							</div>
							<?php } ?>
									
							<div class="single-car-actions">
								<div class="panel-group acc_container">
									<?php
										$category_event = get_field('category_event', $event_id);
										$term_obj_list = get_the_terms( $event_id, 'event_category' );
										?>
									<div class=" <?php if ($term_obj_list) { echo "acc_inner"; }?>">
									<?php
									
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


						<?php 
global $post; 
$post = get_post( $event_id, OBJECT );
//setup_postdata( $post );
//wpfp_link() ;
wp_reset_postdata();
								?>
									<div class="panel-body" id="bottom" style="padding-left: 0px !important;border-top: 1px dashed #dddddd;">
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

						
					</div><!--content-->
				</div><!--col 9  closed-->
			</div><!--listing top  container closed-->
		</div>
	</div>

