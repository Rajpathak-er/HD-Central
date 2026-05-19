	
	
	<?php

$group_desc = get_the_content($group_id);
$group_member = get_field('number_of_members');
$website_link = get_field('website_link'); 


?>


<div class="stm-isotope-sorting stm-isotope-sorting-list list_user_id_<?php echo $group_id; ?>  dealerlistingpage grouplistingpage">
              <div class="listing-list-loop stm-listing-directory-list-loop stm-isotope-listing-item ">
                    <div class="listing-top-container">    
					<div class="col-md-3 col-sm-3 col-xs-12 listing-image-sidebar">
						<div class="image hee">
                            <!--Hover blocks-->
                              <?php $gfimage = wp_get_attachment_image_src( get_post_thumbnail_id( $group_id ), 'full' ); ?>
                            <?php 
                            //print_r($gfimage);
								$images = get_field('pictures', $group_id); 
								//print_r($images);
								// if($none_dealer_user->ID == get_current_user_id()){
									// $authorurl = esc_url(stm_get_author_link('myself-view'));
								// }

								
                            ?>
                            <a href="<?php echo $authorurl ?>" class="rmv_txt_drctn">
								<?php if( $gfimage ){ ?>
									<div class="image-inner">
										<img  src="<?php echo $gfimage[0]; ?>" class="lazy img-responsive" alt="" style="display: block;">
									</div>
								<?php }else if( $images ){ ?>
									<div class="image-inner">
										<img  src="<?php echo $images[0]['url']; ?>" class="lazy img-responsive" alt=" <?php echo $images[0]['alt']; ?>" style="display: block;">
									</div>
								<?php }else { ?>
							
									<div class="image-inner">
										<img  src="https://hd-central.com/wp-content/uploads/2020/07/dark.png" class="lazy img-responsive" alt="" style="display: block;">
									</div>
								<?php }?>
								
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
										$user_meta=get_userdata($none_dealer_user->ID); 
										$user_roles=$user_meta->roles; 
										if (in_array("dealerships", $user_roles)){
											echo '<img style="display: inline-block;width: 35px;margin-top: -10px;" src="https://hd-central.com/wp-content/uploads/2021/09/list-2-1.png" width="70px" />';
										}
									?>
                                </div>                               
                            </div>

							<!--Item parameters-->
							<div class="row">
								<div class="col-sm-6">
                            <div class="meta-middle contentblockpart">
								<div class="meta-middle titleblockpart">
									<div class="title heading-font titleblocktop">
										<a style="display: inline-block;" href="<?php echo get_permalink($group_id); ?>" target="_blank" class="rmv_txt_drctn"><?php echo get_the_title($group_id); ?></a>
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
									$location = get_field('group_location',$group_id);
																	
									// $location = get_user_meta($none_dealer_user->ID,'stm_dealer_location',true);
									// if( empty($location) || trim($location) == "," ){
										// $city = get_user_meta($none_dealer_user->ID,'billing_city',true);
										// $location = get_user_meta($none_dealer_user->ID,'billing_address_1',true). " ".$city;
									// }
																		
								?>
								










                                	
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
                                            <div class="name"><a target="_blank" href="<?php //echo get_user_meta($none_dealer_user->ID,'stm_website_url',true); ?>">View Website </a>    </div>
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
												<div class="col-sm-6">
												<div class="right_content new-contact-list">
													<style type="text/css">
														.add { color: #fff; background-color:#000 ; padding: 11px; border-radius:25px ; font-size: 14px;     margin-right: 0px !important;}
										.remove { color: #eabb3b; background-color:#000 ; padding: 11px; border-radius:25px ; font-size: 14px; margin-right: 0px !important;    }
                                         img.wpfp-hide.wpfp-img {
												    background-color: transparent;
												}
											
												@media(max-width: 767px){
											.add { margin-top: -6px;
											}
										.remove { margin-top: -6px;    }
										}
													</style>
													<?php 
global $post; 
$post = get_post( $group_id, OBJECT );
setup_postdata( $post );
wpfp_link() ;
wp_reset_postdata();
								?>									

							
							<?php if( $website_link ){ ?>
							<div class="meta-right-unit meta-right-unit-btn font-exists website">
								<a target="_blank" href="<?php echo $website_link; ?>">
									<div class="meta-right-unit-inner">
										<div class="name">
											<!-- <span style="color: #17468a;">www</span> -->
											<!-- <span>Visit Website</span> <i class="fa fa-arrow-right"></i>   -->
														<!-- <i class="fas fa-globe new-icons"></i> -->
													<img src="<?php echo get_home_url(); ?>/wp-content/uploads/2021/09/website-2-1.png">
														
										</div>
									</div>
								</a>
							</div>
							<?php } ?>

							<div class="meta-right-unit meta-right-unit-btn font-exists moredetails">
								<a target="_blank" href="<?php echo get_permalink($group_id); ?>">
									<div class="meta-right-unit-inner">
										<div class="name">
											<!-- <span>HDC Page</span> <i class="fa fa-arrow-right"></i>   -->
											<span style="color: #fff;">view</span>
											
										</div>
									</div>
								</a>
							</div>
							
							<div class="meta-right-unit titleblocktop socialblock contact-tel">
								<div class="meta-right-unit-inner share-in">
									<div class="name">
									
									<a class="a2a_dd addtoany_share_save addtoany_share" href="https://www.addtoany.com/share#url= <?php echo get_permalink($event_id); ?>;title=<?php echo get_the_title($event_id); ?>" style="color: #17468a;"><img src="<?php echo get_home_url(); ?>/wp-content/uploads/2020/07/share-2.png"></a>
									</div>
								</div>
							</div>
							
							
							
							<div class="meta-right-social socialblock" style="display: none;">											
								<ul class="social-media">
									<?php
										$facebook = get_field('facebook_link');
										if(!empty($facebook)){ ?>
											<li>
												<a class="facebook" target="_blank" href="<?php echo $facebook; ?>"><i title="facebook" class="fa fa-facebook"></i></a>
											</li>
									<?php }
										$twitter = get_field('twitter_link');
										if(!empty($twitter)){ ?>
											<li>
												<a class="twitter" target="_blank" href="<?php echo $twitter; ?>"><i title="twitter" class="fa fa-twitter"></i></a>
											</li>
									<?php }
										$linkedin = get_field('linkedin_link');
										if(!empty($linkedin)){  ?>
											<li>
												<a class="linkedin" target="_blank" href="<?php echo $linkedin; ?>"><i title="linkedin" class="fa fa-linkedin-in"></i></a>
											</li>
									<?php }
										$youtube = get_field('youtube_link');
										if(!empty($youtube)){?>
											<li>
												<a class="tumblr" target="_blank" href="<?php echo $youtube; ?>"><i title="youtube" class="fa fa-youtube-play"></i></a>
											</li>
									<?php }	 ?>								
								</ul>
							</div>
										</div>
												</div>
												</div>
                            <!--Item options-->


							<div class="meta-middle-unit font-exists mileage title_container locationblockpart">
								<?php if (!empty($location)) { ?>
<style type="text/css"> 
.acc_inner { padding: 10px !important; }
	#loc-date { padding-top: 11px;
    padding-bottom: 11px;border-bottom: 1px dashed #dddddd;padding-left: 0px; clear: both; float: none; }</style>
    <div class="col-xs-12" id="loc-date">
    <?php }
else { 
     ?>
     <div class="col-xs-12" id="loc-date" style="display:none;">
 <?php } ?>
			
										
											<div class="row">
							<div class="col-sm-7" style="padding-left: 0px !important;">
										<?php if(!empty($location)){ ?>
										<div class="meta-middle-unit-top">
											<div class="icon" style="float: left;"><i class="stm-service-icon-pin_big"></i></div>
											<div class="name"><?php echo $location; ?>
                                            
												<?php 
													$userlat = get_post_meta($group_id, 'latitude', true);
														$userlng = get_post_meta($group_id, 'longitude', true);

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

										<?php if($group_member){ ?>
							<div class="col-sm-5" id="gp" style="text-align: right;">
										<div class="inner">
											<span class="name">Group Size: </span>
											<span class="value"><?php echo $group_member; ?> Members</span>
										</div>										
									</div>
									<?php } ?>
									</div></div>
									</div>  <!--middle unit  vclosed -->
                            <div class="meta-bottom">
								<?php if( $group_desc ){ ?>
								<div class="descblockpart">
									<div class="meta-middle-unit-top" style="padding-top: 11px;padding-bottom: 11px;">
										<?php echo wp_trim_words( $group_desc, 50 ); ?>
									</div>
								</div>
								<?php } ?>
								
								<div class="single-car-actions">
                                	<div class="panel-group acc_container">
										<div class="acc_inner">
										<?php
											$category_group = get_field('category_group');
											$category_group = get_the_terms( $group_id, 'group_category' );
											//print_r($term_obj_list);
											if( $category_group ){
												foreach( $category_group as $cat ){
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
									
									<div id="<?php echo $group_id; ?>" class="">
										<div class="panel-body" id="bottom" style="padding-left: 0px !important;border-top: 1px dashed #dddddd;">
											<ul class="list-unstyled clearfix">
											<?php											
												$additional_details = get_field('additional_details_group', $group_id);
												$additional_details = get_the_terms( $group_id, 'group_additional_detail' );
												//print_r($additional_details);
												if( $additional_details ){
											?>
												<li class="car-action-dealer-info additional_details">
													<div class="listing-archive-dealer-info clearfix">
														<div class="row">
															<div class="col-md-12">
																<div class="form-group">							
																<?php
																	foreach ($additional_details as $additional ) {
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
							</div>
							
						</div>											
					</div>
					
					<!-- <div class="col-md-2 col-sm-2 col-xs-12">
						<div class="right_content">
							
							<?php if( $website_link ){ ?>
							<div class="meta-right-unit meta-right-unit-btn font-exists website">
								<a target="_blank" href="<?php echo $website_link; ?>">
									<div class="meta-right-unit-inner">
										<div class="name">
											<span>Website</span> <i class="fa fa-arrow-right"></i>  
										</div>
									</div>
								</a>
							</div>
							<?php } ?>
							
							<div class="meta-right-unit titleblocktop socialblock contact-tel">
								<div class="meta-right-unit-inner">
									<div class="name">
										<span>Share</span> <?php echo do_shortcode( '[addtoany]' ); ?>
									</div>
								</div>
							</div>
							
							<div class="meta-right-unit meta-right-unit-btn font-exists moredetails">
								<a target="_blank" href="<?php echo get_permalink($group_id); ?>">
									<div class="meta-right-unit-inner">
										<div class="name">
											<span>HDC Page</span> <i class="fa fa-arrow-right"></i>  
										</div>
									</div>
								</a>
							</div>
							
							<div class="meta-right-social socialblock" style="display: none;">											
								<ul class="social-media">
									<?php
										$facebook = get_field('facebook_link');
										if(!empty($facebook)){ ?>
											<li>
												<a class="facebook" target="_blank" href="<?php echo $facebook; ?>"><i title="facebook" class="fa fa-facebook"></i></a>
											</li>
									<?php }
										$twitter = get_field('twitter_link');
										if(!empty($twitter)){ ?>
											<li>
												<a class="twitter" target="_blank" href="<?php echo $twitter; ?>"><i title="twitter" class="fa fa-twitter"></i></a>
											</li>
									<?php }
										$linkedin = get_field('linkedin_link');
										if(!empty($linkedin)){  ?>
											<li>
												<a class="linkedin" target="_blank" href="<?php echo $linkedin; ?>"><i title="linkedin" class="fa fa-linkedin-in"></i></a>
											</li>
									<?php }
										$youtube = get_field('youtube_link');
										if(!empty($youtube)){?>
											<li>
												<a class="tumblr" target="_blank" href="<?php echo $youtube; ?>"><i title="youtube" class="fa fa-youtube-play"></i></a>
											</li>
									<?php }	 ?>								
								</ul>
							</div>
							
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
													
						</div>
					</div> -->
					
					<div style="clearfix"></div>
				</div>
					
					
					
									
                </div>
            </div>

