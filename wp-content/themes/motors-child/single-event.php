<?php 

get_header();

$sidebar = get_theme_mod('dealer_sidebar', '1864');

$images = get_field('event_image', get_the_ID()); 
$event_desc = get_the_content();
$category_event = get_field('category_event');
$additional_details = get_field('additional_details');
$start_date = get_field('start_date');
$start_time = get_field('start_time');
$end_date = get_field('end_date');					
									
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
				<div class="vc_col-sm-12 vc_col-xs-12 back_block"><a href="<?php echo get_permalink(41646); ?>">Back to Events</a></div>
			</div>
		</div>
	</div>
	
<div class="container stm-user-public-profile event-data">
	<div class="col-md-12 col-sm-12 col-xs-12 first_section">
		<div class="col-md-9 col-sm-12 col-xs-12">
			<div class="top_title_container">
				<h1 class="h3 author-name event-name"><?php echo get_the_title(); ?></h1>					
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
							<img src="<?php echo $images['url']; ?>" class="img-responsive" alt=" <?php echo $images['alt']; ?>"  />
						<?php }else{ ?>
							<img  src="https://hd-central.com/wp-content/uploads/2020/07/dark.png" class="img-responsive" alt="">
						<?php } ?>
					</div>
				</div>
				
				<!-- description section -->
				<?php if (!empty($event_desc)) : ?>
					<div class="stm-section stm-dealer-desc-section">
						<div class="stm-description">
							<div class="heading-title"><?php esc_html_e('Event description', 'motors'); ?></div>
							<?php
								echo $event_desc; ?>
						</div>
					</div>
				<?php endif; ?>
				
				<!-- category section -->
				
					<?php if ($category_event) { ?>
						<div class="stm-section stm-dealer-services-section stm-categories-section">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<div class="stm-label service_category heading-title"><?php esc_html_e('Event Categories', 'motors'); ?></div>
										<?php
										foreach ($category_event as $key => $category) {
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
					
				<!-- event details section -->				
					<?php if ($additional_details) { ?>
						<div class="stm-section stm-dealer-services-section stm-categories-section">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<div class="stm-label service_category heading-title"><?php esc_html_e('Additional Details', 'motors'); ?></div>
										<?php
										foreach ($additional_details as $key => $detail) {
										?>
											<div class="col-md-3 col-sm-3 col-xs-6">
												<label>
													<span class="service_data_single"><?php echo $detail->name; ?></span>
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
				<?php if( !empty($start_date) && !empty($end_date) ){ ?>
					<div class="stm-block stm-event-date-block">
						<div class="stm-dealer-info-unit event-date">
							<div class="heading-title">
								<!--<i class="stm-icon-calendar"></i>-->
								<span><?php esc_html_e('Event Date', 'motors'); ?></span>
							</div>
							<div class="inner">
								<span><?php echo $start_date; ?></span> - <span><?php echo $end_date; ?></span>
							</div>
						</div>
					</div>
					<?php } ?>
					<?php if( get_field('external_link') ){ ?>
					<div class="stm-block stm-address-block">
						<div class="stm-dealer-info-unit location">
							<div class="heading-title">
								<!--<i class="stm-icon-ico_mag_map_pin"></i>-->
								<span><?php esc_html_e('Link to event ', 'motors'); ?></span>
							</div>
							<div class="inner">
								<!--<img src="https://hd-central.com/wp-content/uploads/2021/09/website-2-1.png">-->
								<span><a href="<?php echo get_field('external_link'); ?>">Click here</a> </span>
							</div>
						</div>
					</div>
					<?php } ?>
					
					<?php if( get_field('venue_name') ){ ?>
					<div class="stm-block stm-address-block">
						<div class="stm-dealer-info-unit location">
							<div class="heading-title">
								<!--<i class="stm-icon-ico_mag_map_pin"></i>-->
								<span><?php esc_html_e('Venue Name', 'motors'); ?></span>
							</div>
							<div class="inner">
								<span><?php echo get_field('venue_name'); ?></span>
							</div>
						</div>
					</div>
					<?php } ?>
			
					<?php
						
						$location = get_post_meta(get_the_ID(),'venue_address',true);
						if( empty(trim($location)) || trim($location) == "," ){
							$location = get_field('venue_address');
						}							
						if( $location ){							
					?>
					<div class="stm-block stm-address-block">
						<div class="stm-dealer-info-unit location">
							<div class="heading-title">
								<!--<i class="stm-icon-ico_mag_map_pin"></i>-->
								<span><?php esc_html_e('Address', 'motors'); ?></span>
							</div>
							<div class="inner">
								<span><?php echo $location; ?></span>
							</div>
						</div>
					</div>
					<?php } ?>
					 
					<?php
						$location_address = get_field('location_address');
						//echo '<div style="display: none;">'; print_r($location_address); echo '</div>';
						
						// $lat = get_post_meta(get_the_ID(),'lat',true);
						// $lng = get_post_meta(get_the_ID(),'lng',true);
						// if( !empty($lat) ){
						if( $location_address ){
							$lat = $location_address['lat'];
							$lng = $location_address['lng'];
					?>
					
						<div id="stm-dealer-gmap"></div>
						<script>
							jQuery(document).ready(function ($) {
								google.maps.event.addDomListener(window, 'load', init);

								var center, map;

								function init() {
									center = new google.maps.LatLng(<?php echo $lat;?>, <?php echo $lng;?>);
									var mapOptions = {
										zoom: 15,
										center: center,
										fullscreenControl: true,
										scrollwheel: false
									};
									var mapElement = document.getElementById('stm-dealer-gmap');
									map = new google.maps.Map(mapElement, mapOptions);
									var marker = new google.maps.Marker({
										position: center,
										icon: 'https://hd-central.com/wp-content/themes/motors-child/assets/images/stm-map-marker-green.png',
										map: map
									});
								}

								$(window).on('resize', function () {
									if (typeof map != 'undefined' && typeof center != 'undefined') {
										setTimeout(function () {
											map.setCenter(center);
										}, 1000);
									}
								})
							});
						</script>
					<?php 
						} 
					?>
				</div>
					
					
					
					<?php if( get_field('external_link') ){ ?>
					<!--<div class="stm-block stm-event-link-block">
						<div class="stm-dealer-info-unit event-external-link">
							<div class="heading-title">
								<i class="fa fa-link"></i>
								<span><?php// esc_html_e('External Link', 'motors'); ?></span>
							</div>
							<div class="inner">
								<span><a class="external-link" href="<?php //echo get_field('external_link') ?>" target="_blank"><?php //echo get_field('external_link') ?></span></a>
							</div>
						</div>
					</div>-->	
					<?php } ?>
					
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
			$('#<?php echo $dynamicClassPhotonew; ?>').lightGallery({
				thumbnail: true
			});
			
			$("#car-gallery").lightGallery({
				download: false,
				enableDrag: false,
			});
			
		});
	</script>
	
<?php get_footer();?>