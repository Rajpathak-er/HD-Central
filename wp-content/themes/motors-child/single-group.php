<?php 

get_header();

function convertYoutube($string)
{
	return preg_replace(
		"/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
		"<iframe width=\"720\" height=\"460\" src=\"//www.youtube.com/embed/$2\" allowfullscreen></iframe>",
		$string
	);
}

$sidebar = get_theme_mod('dealer_sidebar', '1864');

$images = get_field('pictures', get_the_ID()); 
$group_desc = get_the_content();
$category_group = get_field('category_group');
$established_year = get_field('established_year');
$additional_details = get_field('additional_details_group');

									
?>
	<style type="text/css">
		
	
	</style>
	
	<div class="entry-header left small_title_box" style="display: none;">
		<div class="container">
			<div class="entry-title vc_row">
				<div class="vc_col-sm-12 vc_col-xs-12 post_title_main_heading">
					<h2 class="h1">
						Events
					</h2>
				</div>
				<div class="vc_col-sm-12 vc_col-xs-12 back_block"><a href="<?php echo get_permalink(41676); ?>">Back to Group</a></div>
			</div>
		</div>
	</div>
	
<div class="container stm-user-public-profile event-data">
	<div class="col-md-12 col-sm-12 col-xs-12 first_section">
		<div class="col-md-9 col-sm-12 col-xs-12">
			<div class="top_title_container">
				<h1 class="h3 author-name event-name"><?php echo get_the_title(); ?></h1>

				<?php if($established_year){ ?>
					<div class="in_business">Established Year <span><?php echo $established_year; ?></span></div>
				<?php } ?>
			
			</div>
		</div>


		<div class="col-md-3 hidden-sm hidden-xs">
			<div class=""></div>
		</div>
	</div>

	<div class="row">
	
		<div class="col-md-9 col-sm-12 col-xs-12">

		<div class="stm-dealer-public-profile">
			<?php /* ?><div class="clearfix">
                <div class="stm-dealer-top-left">
                    
                    <?php 
                    if(!empty($trading_type)){
                    ?>
                    <span class="businessyear_dealerprofile"> In Business Since <?php echo $trading_type; ?></span>
                    <?php 
                    }
                    ?>
                    
                </div>
                <div class="stm-dealer-top-right">
                    <?php if (!empty($user['logo'])): ?>
                        <img src="<?php echo esc_url($user['logo']); ?>" class="img-responsive"/>
                        <?php else: ?>
                            <img src="<?php stm_get_dealer_logo_placeholder(); ?>" class="img-responsive"/>
                        <?php endif; ?>
                    </div>
            </div><?php */ ?>
			
			<div class="stm-dealer-main-info">
				
				<div class="stm-dealer-main-image-section">
					<div class="dealer-image">
						<?php if( $images ){ ?>
							<img src="<?php echo $images[0]['url']; ?>" class="img-responsive" alt=" <?php echo $images[0]['alt']; ?>"  />
						<?php }else{ ?>
							<img  src="https://hd-central.com/wp-content/uploads/2020/07/dark.png" class="img-responsive" alt="">
						<?php } ?>
					</div>
				</div>
				
				<?php
					if( $images && count($images) > 1 ){
				?>
						<div class="stm-section stm-image-section">
							<div class="stm-inner">
								<div class="heading-title">Images</div>
								<!-- Gallery Part -->
								<div class="car-grid-slider">
									<!--<div class="gallery js-gallery">-->
									<!--<div class="owl-carousel owl-theme car-slider">-->
									<div id="car-gallery" class="gallery car-gallery">

										<?php
										$i = 1;
										 foreach ($images as $image) {
										 	//echo $image['url'];
										 	if($i == 1){
										 		$i++;
										 		continue;
										 	}
										 	$i++;
										 	 ?>
											<!--<div class="item">
												<div class="car-img" style="background-image: url(<?php //echo esc_url($image['url']); ?>);">
												</div>
											</div>-->
												
												<a href="<?php echo esc_url($image['url']); ?>">
													<img class="gallery-img car-img img-responsive" src="<?php echo esc_url($image['url']); ?>" />
												</a>

										<?php } ?>										
									</div>
								</div>
							</div>
						</div>				
				<?php
					}
				?>
				
				<?php
					$group_videos = get_field('group_videos');
					if( $group_videos ) {
				?>
						<div class="stm-section stm-video-section">
							<div class="stm-inner">
								<div class="heading-title">Videos</div>
								<div class="car-grid-slider video_slider">									
									<div id="video-gallery" class="gallery video-gallery">
										<?php foreach ($group_videos as $videos) { ?>												
												<a href="<?php echo esc_url($videos['video']); ?>">
													<?php echo "<center>" . convertYoutube($videos['video']) . "</center>"; ?>
												</a>
										<?php } ?>										
									</div>
								</div>								
							</div>
						</div>				
				<?php } ?>
				
				<!-- description section -->
				<?php if (!empty($group_desc)) : ?>
					<div class="stm-section stm-dealer-desc-section">
						<div class="stm-description">
							<div class="heading-title"><?php esc_html_e('Group description', 'motors'); ?></div>
							<?php
								echo $group_desc; ?>
						</div>
					</div>
				<?php endif; ?>
				
				<!-- category section -->
				
					<?php if ($category_group) { ?>
						<div class="stm-section stm-dealer-services-section stm-categories-section">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<div class="stm-label service_category heading-title"><?php esc_html_e('Group Categories', 'motors'); ?></div>
										<?php
										foreach ($category_group as $key => $category) {
										?>
											<div class="col-md-3 col-sm-3 col-xs-6">
												<label>
													<span class="service_data_single"><?php echo $category->name; ?></span>
												</label>
											</div>
										<?php
										}
										?>
									</div>
								</div>
							</div>
						</div>
					<?php } ?>
					
				<!-- Additional Detail section -->
				
					<?php if ($additional_details) { ?>
						<div class="stm-section stm-dealer-services-section stm-categories-section">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<div class="stm-label service_category heading-title"><?php esc_html_e('Additional Details', 'motors'); ?></div>
										<?php
										foreach ($additional_details as $key => $details) {
										?>
											<div class="col-md-3 col-sm-3 col-xs-6">
												<label>
													<span class="service_data_single"><?php echo $details->name; ?></span>
												</label>
											</div>
										<?php
										}
										?>
									</div>
								</div>
							</div>
						</div>
					<?php } ?>	
										
			
			</div><!-- end of .stm-dealer-main-info -->
		
		 </div> 

		 </div> 
		
		<div class="col-md-3 hidden-sm hidden-xs">
		<?php				
		// if (!empty($user['location_lat']) and !empty($user['location_lng']) and !empty($user['location'])) {
		// stm_dealer_gmap($user['location_lat'], $user['location_lng']);
		// }
		
		?>
			<div class="stm-sidebar stm-dealer-info-section">
				<div class="widget event_margin">
					
					<?php if( get_field('website_link') ){ ?>
					<!--<div class="stm-block stm-website-block">
						<div class="stm_website_url">
							<a href="<?php //echo esc_url(get_field('website_link')); ?>" target="_blank">
								<span><?php //esc_html_e('Visit Website', 'motors'); ?></span> <i class="fa fa-arrow-right"></i>
							</a>
						</div>
					</div> -->
					<div class="stm-block stm-website-block">
						<div class="heading-title">

							
								<span><?php esc_html_e('Website', 'motors'); ?></span>
								
							</div>
							<div class="inner">
							
								<div class="stm-dealer-info-unit location add-icons">
						<!--img src="https://www.hd-central.com/wp-content/uploads/2021/09/web-1.png" />-->
<svg width="17" height="17" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M21.3884 14.6188C21.7845 13.4849 22.0007 12.2673 22.0007 10.9999C22.0007 9.7326 21.7845 8.51497 21.3884 7.38113C21.3788 7.34707 21.3673 7.31385 21.3534 7.28189C19.8256 3.04075 15.7619 0 11.0008 0C6.23975 0 2.17595 3.04075 0.648212 7.28189C0.634336 7.31396 0.622772 7.34707 0.613206 7.38113C0.217107 8.51497 0.000976562 9.7326 0.000976562 10.9999C0.000976562 12.2673 0.217107 13.4849 0.613206 14.6188C0.622877 14.6528 0.634336 14.686 0.648212 14.718C2.17605 18.9592 6.23975 21.9999 11.0008 21.9999C15.7619 21.9999 19.8256 18.9591 21.3534 14.718C21.3673 14.686 21.3788 14.6529 21.3884 14.6188ZM11.0008 20.4232C10.5819 20.4232 9.9065 19.665 9.342 17.9713C9.06952 17.154 8.85139 16.2144 8.69245 15.1923H13.3092C13.1502 16.2144 12.9321 17.1539 12.6597 17.9713C12.0951 19.665 11.4197 20.4232 11.0008 20.4232ZM8.50113 13.6155C8.42534 12.7747 8.38528 11.8976 8.38528 10.9999C8.38528 10.1023 8.42534 9.22517 8.50113 8.38441H13.5004C13.5762 9.22517 13.6163 10.1023 13.6163 10.9999C13.6163 11.8976 13.5762 12.7747 13.5004 13.6155H8.50113ZM1.5777 11.0001C1.5777 10.0929 1.70689 9.21529 1.94731 8.38452H6.91957C6.84588 9.24263 6.80846 10.1221 6.80846 11.0001C6.80846 11.878 6.84578 12.7575 6.91957 13.6156H1.94731C1.70689 12.7847 1.5777 11.9073 1.5777 11.0001ZM11.0008 1.57683C11.4197 1.57683 12.0952 2.33497 12.6597 4.02869C12.9321 4.84601 13.1504 5.78559 13.3092 6.80758H8.69235C8.85129 5.78548 9.06942 4.84601 9.34189 4.02869C9.9065 2.33497 10.5819 1.57683 11.0008 1.57683ZM15.082 8.38452H20.0542C20.2946 9.21529 20.4238 10.0929 20.4238 11.0001C20.4238 11.9073 20.2946 12.7848 20.0542 13.6156H15.082C15.1557 12.7575 15.1931 11.878 15.1931 11.0001C15.1931 10.1221 15.1557 9.24263 15.082 8.38452ZM19.4381 6.80769H14.9011C14.6206 4.87376 14.1394 3.13873 13.4645 1.90439C16.0815 2.61385 18.2496 4.42521 19.4381 6.80769ZM8.53708 1.90428C7.86209 3.13862 7.38095 4.87366 7.10049 6.80769H2.56343C3.75204 4.42521 5.92007 2.61385 8.53708 1.90428ZM2.56343 15.1923H7.10049C7.38095 17.1262 7.86209 18.8613 8.53708 20.0957C5.92007 19.3861 3.75204 17.5749 2.56343 15.1923ZM13.4645 20.0957C14.1394 18.8614 14.6206 17.1263 14.9011 15.1923H19.4381C18.2496 17.5749 16.0815 19.3861 13.4645 20.0957Z" fill="#565656"></path>
</svg>
<a href="<?php echo esc_url(get_field('website_link')); ?>" target="_blank" class="web-link">Visit Website</a>
					</div>
							</div>
						
					</div>
					<?php } ?>
											
					<?php if( get_field('group_location') ){ ?>
					<div class="stm-block stm-address-block">
						<div class="stm-dealer-info-unit location">
							<div class="heading-title">
								<!--<i class="stm-icon-ico_mag_map_pin"></i>-->
								<span><?php esc_html_e('Address', 'motors'); ?></span>
							</div>
							<div class="inner">
								<span><?php echo get_field('group_location'); ?></span>
								
							</div>
							<!-- <div class="map">
							<iframe 
							width="300" 
							height="170" 
							frameborder="0" 
							scrolling="no" 
							marginheight="0" 
							marginwidth="0" 
							style="border:0;" 
							allowfullscreen="" 
							loading="lazy" 
							referrerpolicy="no-referrer-when-downgrade"
							src="https://maps.google.com/maps?q=<?php echo $user['location_lat']; ?>,<?php echo $user['location_lng']; ?>&hl=es&z=14&amp;output=embed"
							>
							</iframe>
							<br />
							
							</div> -->
						</div>
					</div>
					<?php } ?>
					
					<?php if( get_field('number_of_members') ){ ?>
					<div class="stm-block stm-member-block">
						<div class="stm-dealer-info-unit event-date">
							<div class="heading-title">
								<!--<i class="far fa-user"></i>-->
								<span><?php esc_html_e('Number of Members', 'motors'); ?></span>
							</div>
							<div class="inner">
								<span><?php echo get_field('number_of_members'); ?></span>
							</div>
						</div>
					</div>
					<?php } ?>
					
					<div class="stm-block stm-social-block " style="display:none;">
						<!--<div class="stm-dealer-info-unit socialblock">-->
							<div class="heading-title">
								<!--<i class="fa fa-link"></i>-->
								<span><?php esc_html_e('Social Links', 'motors'); ?></span>
							</div>
							<div class="inner">
								<!--<ul class="social-media">
									
											<li>
												<a class="facebook" target="_blank" href="<?php echo $facebook; ?>"><i title="facebook" class="fa fa-facebook"></i></a>
											</li>
									
											<li>
												<a class="twitter" target="_blank" href="<?php echo $twitter; ?>"><i title="twitter" class="fa fa-twitter"></i></a>
											</li>
								
										$linkedin = get_field('linkedin_link');
										if(!empty($linkedin)){  ?>
											<li>
												<a class="linkedin" target="_blank" href="<?php echo $linkedin; ?>"><i title="linkedin" class="fa fa-linkedin-in"></i></a>
											</li>
									
										$youtube = get_field('youtube_link');
										if(!empty($youtube)){?>
											<li>
												<a class="tumblr" target="_blank" href="<?php echo $youtube; ?>"><i title="youtube" class="fa fa-youtube-play"></i></a>
											</li>
															
								</ul>-->																								<div class="socials-media-dealerpage clearfix">																<div class="inner stm_socials_settings social_links_c">								
									<span>	
										<?php
										$facebook = get_field('facebook_link');
										if(!empty($facebook)){ ?>
										<a target="_blank" href="<?php echo $facebook; ?>">									<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="facebook">									<path d="M3.51562 24H11.3438V15.4688H8.53125V12.6562H11.3438V9.14062C11.3438 7.20209 12.9208 5.625 14.8594 5.625H18.375V8.4375H15.5625C14.787 8.4375 14.1562 9.0683 14.1562 9.84375V12.6562H18.2481L17.7794 15.4688H14.1562V24H20.4844C22.4229 24 24 22.4229 24 20.4844V3.51562C24 1.57709 22.4229 0 20.4844 0H3.51562C1.57709 0 0 1.57709 0 3.51562V20.4844C0 22.4229 1.57709 24 3.51562 24ZM1.40625 3.51562C1.40625 2.35254 2.35254 1.40625 3.51562 1.40625H20.4844C21.6475 1.40625 22.5938 2.35254 22.5938 3.51562V20.4844C22.5938 21.6475 21.6475 22.5938 20.4844 22.5938H15.5625V16.875H18.9706L19.9081 11.25H15.5625V9.84375H19.7812V4.21875H14.8594C12.1454 4.21875 9.9375 6.42664 9.9375 9.14062V11.25H7.125V16.875H9.9375V22.5938H3.51562C2.35254 22.5938 1.40625 21.6475 1.40625 20.4844V3.51562Z" fill="#565656"></path>									
									</svg><span><!--Facebook--></span></a>		
									<?php }
										$twitter = get_field('twitter_link');
										if(!empty($twitter)){ ?>		

										<a target="_blank" href="<?php echo $twitter; ?>">										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="24px" height="24px" class="twitter"><path fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="3" d="M49,11.096c-1.768,0.784-3.664,1.311-5.658,1.552c2.035-1.22,3.597-3.151,4.332-5.448c-1.903,1.127-4.013,1.947-6.255,2.388c-1.795-1.916-4.354-3.11-7.186-3.11c-5.44,0-9.849,4.409-9.849,9.847c0,0.771,0.088,1.522,0.257,2.244c-8.184-0.412-15.441-4.332-20.299-10.29c-0.848,1.458-1.332,3.149-1.332,4.953c0,3.416,1.735,6.429,4.38,8.197c-1.616-0.051-3.132-0.495-4.46-1.233c0,0.042,0,0.082,0,0.125c0,4.773,3.394,8.748,7.896,9.657c-0.824,0.227-1.694,0.346-2.592,0.346c-0.636,0-1.253-0.062-1.856-0.178c1.257,3.909,4.892,6.761,9.201,6.84c-3.368,2.641-7.614,4.213-12.23,4.213c-0.797,0-1.579-0.044-2.348-0.137c4.356,2.795,9.534,4.425,15.095,4.425c18.114,0,28.022-15.007,28.022-28.016c0-0.429-0.011-0.856-0.029-1.275C46.012,14.807,47.681,13.071,49,11.096z"></path></svg><span><!--LinkedIn--></span>										</a>		
										<?php }
										$linkedin = get_field('linkedin_link');
										if(!empty($linkedin)){  ?>													

									<a target="_blank" href="<?php echo $linkedin; ?>">										
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="24px" height="24px" class="linked"><path fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="3" d="M3 16L13 16 13 35.665 13 45 3 45z"></path><path fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="3" d="M8,12L8,12c-3,0-5-1.813-5-4.053S5,4,8,4s4.875,1.707,5,3.947C13,10.187,11.125,12,8,12z"></path><path fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="3" d="M37,28.5c0-2.485-2.015-4.5-4.5-4.5S28,26.015,28,28.5c0,0,0,0.125,0,0.25c0,0.125,0,0.25,0,0.25c0,1.291,0,16,0,16H18V16h10v3.639c0,0,3.27-3.639,8.787-3.639C42.422,16,47,20.135,47,28v17H37C37,45,37,29.557,37,28.5"></path></svg><span><!--Twitter--></span>										</a>																					
											<?php }	 ?>						


								</span>										</div>									</div>																
							</div>
						<!--</div>-->
					</div>
					
				</div>
			</div>

		</div>

	</div>


	<script type="text/javascript">
		jQuery(document).ready(function() {
			var $ = jQuery;
			if (location.hash !== '') {
				$('a[href="' + location.hash + '"]').tab('show');
			}
		})
	</script>


	<script type="text/javascript">
		jQuery(document).ready(function() {
			// $('#<?php echo $dynamicClassPhotonew; ?>').lightGallery({
				// thumbnail: true
			// });
			
			$("#car-gallery").lightGallery({
				download: false,
				enableDrag: false,
			});
			
			$("#video-gallery").lightGallery();
			
		});
	</script>
	
<?php get_footer();?>