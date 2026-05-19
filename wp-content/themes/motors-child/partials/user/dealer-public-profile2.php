<style>
	div#welcome  img.img-distributors-logo {
    height: 60px !important;
    object-fit: contain;
    width: 60% !important;
}

div#welcome .owl-item {width: 137.824px !important;}

div#welcome .stm-section.stm-dealer-services-section.stm-categories-section.author_distributor {
    padding: 0 20px !important;
}

	</style>
	<!--Popup Lightbox Js-->

<?php


function convertYoutube($string)
{
	return preg_replace(
		"/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
		"<iframe width=\"720\" height=\"460\" src=\"//www.youtube.com/embed/$2\" allowfullscreen></iframe>",
		$string
	);
}


$user_page = get_queried_object();
$user_id = $user_page->data->ID;

$user = stm_get_user_custom_fields($user_id);
$membership_level = pmpro_getMembershipLevelForUser($user_id);
$level_id = $membership_level->ID;                                          


$services = array();
$place_user = get_user_meta( $user_id, 'place_user', true );

$servicesdata = get_user_meta($user_id,'service_category',true);

$book_email = get_user_meta($user_id,'book_email',true);
$enable_service_booking = get_user_meta($user_id,'enable_service_booking',true);
$stm_ebay_acc = get_user_meta($user_id,'stm_ebay_acc',true);
$stm_facebook_acc = get_user_meta($user_id,'stm_facebook_acc',true);
$stm_twitter_acc = get_user_meta($user_id,'stm_twitter_acc',true);
$stm_linked_acc = get_user_meta($user_id,'stm_linked_acc',true);
$stm_instagram_acc = get_user_meta($user_id,'stm_instagram_acc',true);
$stm_youtube_acc = get_user_meta($user_id,'stm_youtube_acc',true);

if(is_array($services)){
		$services = array_merge($services,$servicesdata);
}
//$services = get_user_meta($none_dealer_user->ID,'service_category',true);

$places = get_user_meta($user_id,'place_categories',true);
$things = get_user_meta($user_id,'things_to_do',true);


$parts_category = get_user_meta($user_id,'parts_category',true);
//if(is_array($parts_category)){
//		$services = array_merge($services,$parts_category);
//}
$distributors = get_user_meta($user_id,'distributors',true);
$parts = get_user_meta($user_id, 'service_parts', true);
$partsarray = json_decode($parts, true);

$stm_photoes = get_user_meta($user_id, 'stm_photoes', true);
$stm_photoesarray = json_decode($stm_photoes, true);


$dealer_user_type = get_user_meta($user_id, 'dealer_user_type', true);
$trading_type = get_user_meta($user_id, 'trading_type', true);
$is_warranty  = get_user_meta($user_id, 'is_warranty', true);
$house_financing  = get_user_meta($user_id, 'is_warhouse_financingranty', true);


$instagram  = get_user_meta($user_id, 'stm_user_instagram', true);

$ratings = stm_get_dealer_marks($user_id);
$user_show_mail =  false; //get_the_author_meta('stm_show_email', $user_id);

$sidebar = get_theme_mod('dealer_sidebar', '1864');
$sidebar_position = get_theme_mod('dealer_sidebar_position', 'right');


$layout = stm_sidebar_layout_mode($sidebar_position, $sidebar);

$inline_list = 'stm-inline-icons';

$business_name = get_the_author_meta('business_name', $user_id);
$banner = get_the_author_meta( 'stm_dealer_banner', $user_id );
$year_in_business = get_the_author_meta( 'year_in_business', $user_id );
$stm_dealer_location = get_the_author_meta( 'stm_dealer_location', $user_id );

$working_monday = get_the_author_meta('working_monday', $user_id);
$working_thesday = get_the_author_meta('working_thesday', $user_id);
$working_wednesday = get_the_author_meta('working_wednesday', $user_id);
$working_thursday = get_the_author_meta('working_thursday', $user_id);
$working_friday = get_the_author_meta('working_friday', $user_id);
$weekday_from = get_user_meta($user_id, 'weekday_from', true);
$weekday_to = get_user_meta($user_id, 'weekday_to', true);
$working_saturday = get_the_author_meta('working_saturday', $user_id);
$saturday_from = get_the_author_meta('saturday_from', $user_id);
$saturday_to = get_the_author_meta('saturday_to', $user_id);
$working_sunday = get_the_author_meta('working_sunday', $user_id);
$sunday_from = get_the_author_meta('sunday_from', $user_id);
$sunday_to = get_the_author_meta('sunday_to', $user_id);

?>

<style>
	@media only screen and (max-width: 991px) {
		.archive.author .stm-user-public-profile .col-md-3.hidden-sm.hidden-xs {
			display: block !important;
			clear: both;
		}

		.archive.author .archive.author .stm-star-rating {
			margin-left: 0;
		}

	}

.stm-dealer-info-section { padding-top: 10px;padding-bottom: 10px; box-shadow: 0px 0px 20px rgb(0 0 0 / 10%); }
	.stm-sidebar .widget .stm-block .heading-title span {    font-size: 16px !important;font-weight: 700 !important; }
	.heading-title span:after, .stm-block.stm-contact-block a.contact_title:after, .stm-block.stm-phone-block a.contact_title:after{
		display: none;
	}
	a.contact_title{
    color: #000;
    text-decoration: none;
    font-weight: 700 !important;
    font-size: 16px;
}
</style>

<div class="entry-header left small_title_box" style="">
	<div class="container">
		<div class="entry-title vc_row">
			<div class="vc_col-sm-12 vc_col-xs-12 post_title_main_heading">
				<h2 class="h1">
					Service Providers
				</h2>
			</div>
			<div class="vc_col-sm-12 vc_col-xs-12 back_block"><a href="<?php echo get_permalink(3018); ?>">Back to providers</a></div>
		</div>
	</div>
</div>


<div class="container stm-user-public-profile dealerpublicprofile testtt">

	<div class="row yyy"> 
	
				<style type="text/css">
				.lft_side .author-name, .heading-title {	
font-family: Poppins; font-size: 16px !important; font-weight: bold; color: #1d1d1b;margin-bottom: 10px !important;
}
h1.h3.author-name {
    font-size: 26px !important;
}
.stm-block .heading-title {
    font-size: 14px !important;
}
h1.h3.author-name {
    margin: 0;
}
.row.yyy .lft_side .stm-star-rating {
    margin: 0 !important;
    padding-top: 4px;
}
ul.custom_tabs li a {
    color: #000;
    font-weight: 700;
    font-size: 16px;
}
p.eller_notes {
    color: black;
    font-weight: 400;
    font-size: 16px;
    line-height: 26px;
}
span.service_data_single {
    font-weight: 500;
    font-size: 12px;
    line-height: 26px;
    color: #000000;
}
.customNextBtn {
    position: absolute;
    right: 1px;
    top: 30%;
    bottom: 0;
    margin: auto;
    height: 100%;
    display: flex;
    align-items: center;
    align-items: center;
    z-index: 99;
    cursor: pointer;
    width: auto !important;
}
.customPreviousBtn {
    position: absolute;
    left: 15px;
    eft: 0px;
    top: 30%;
    bottom: 0;
    margin: auto;
    height: 100%;
    display: flex;
    align-items: center;
    align-items: center;
    z-index: 99;
    cursor: pointer;
    width: auto !important;
}
.custom-carousal .single-logo.imagedistributorcontainer {
    border: 2px solid #ddd;
    /* padding: 10px; */
    margin-bottom: 10px;
}
/*.stm-section.stm-video-section.author_video {
    box-shadow: 0px 0px 20px rgb(0 0 0 / 10%);
    border: 1px solid #ddd;
    padding: 20px !important;
    margin: 0 !important;
}*/
.stm-section.stm-video-section.author_video,.stm-section.stm-image-section.author_image,.stm-section.stm-dealer-desc-section.author_bus_desc,.stm-section.stm-dealer-services-section.stm-categories-section.author_distributor,.stm-section.stm-dealer-services-section.stm-categories-section.author_services,.stm-section.stm-dealer-tab-section,.stm-section.stm-dealer-additional-section.stm-categories-section{
    box-shadow: 0px 0px 20px rgb(0 0 0 / 10%);
    border: 1px solid #ddd;
    padding: 20px !important;
    margin: 20px 0px !important;
}  
.stm-section.stm-dealer-services-section.stm-categories-section.author_distributor.gal-img {
    border: none !important;
    box-shadow: none !important;
    padding:unset !important;
    margin: unset!important;
}
.brand-carousel {
    padding-left: 15px !important;
    padding-right: 0px !important;
}
/*span#gets {
    font-size: 16px !important;
}*/
.author_image .btns .customNextBtn {
    top: 10px;
}
.author_image .btns .customPreviousBtn {
    top: 10px;
}
.archive.author .heading-title:after{
	display: none !important;
}
			</style>
				
		<?php echo stm_do_lmth($layout['content_before']); ?>

		<div class="stm-dealer-public-profile">

<div class="lft_side" style="box-shadow: 0px 0px 20px rgb(0 0 0 / 10%);">
							<div class="top_title_container">
								<?php if( !empty($business_name) ){ ?>
									<h1 class="h3 author-name"><?php echo $business_name; ?> </h1>
									
								<?php } else { ?>
								
									<h1 class="h3 author-name"><?php stm_display_user_name($user_id); ?> </h1>
								<?php } ?>
								
								<?php if($year_in_business){ ?>
								
									<div class="in_business">In Business Since <span><?php echo $year_in_business; ?></span></div>
									
								<?php } else{ ?>
								
									
								
								<?php } ?>
							</div>
							


							
							<?php if (!empty($ratings['average'])) : ?>
								<div class="stm-star-rating">
									<div class="inner">
										<div class="stm-star-rating-upper" style="width:<?php echo esc_attr($ratings['average_width']); ?>"></div>
										<div class="stm-star-rating-lower"></div>
									</div>
									<div class="heading-font"><?php echo esc_attr($ratings['average']); ?> </div>
								</div>
							
							<?php endif; ?>

							<?php //echo stm_do_lmth($layout['sidebar_after']); ?>
							
							<?php if( $user['logo'] && 1==2) { ?>
							
								<img src="<?php echo $user['logo']; ?>" />
								
							<?php }


							 ?>
							<div class="dealer-image">
							<?php if( !empty($banner) ){ ?>
								<img src="<?php echo $banner; ?>" />
							<?php }else{ ?>
							
								<?php if (!empty($user['dealer_image'])) : $inline_list = ''; ?>
									<img src="<?php echo esc_url($user['dealer_image']); ?>" />
								<?php endif; ?>
							
							<?php } ?>
						</div>



					
							
						</div>


			

			
				<div class="stm-dealer-main-info">
<div class="col-md-5 col-sm-12 col-xs-12 ">


						<?php //echo stm_do_lmth($layout['content_before']); ?>
						
						<!-- tabs section -->
						<div class="top_review_sction" style="box-shadow: 0px 0px 20px rgb(0 0 0 / 10%);">
							<div class="stm-dealer-tabs-dealer">
								<!-- Nav tabs -->
								<ul role="tablist" class="custom_tabs">
									
									<li role="presentation" <?php if ($level_id == 8) {
																						echo "class='active'";
																					} ?>>
										<a class="stm_d_rev" href="javascript:void(0);" aria-controls="stm_d_rev1" role="tab" data-toggle="tab">
											<i class="fa fa-star"></i>
											<?php if ($level_id == 8) {
											?>
												<?php esc_html_e('Business Reviews', 'motors'); ?>
											<?php } else { ?>
												<?php esc_html_e('Reviews', 'motors'); ?>
											<?php } ?>
										</a>
									</li>
									<li role="presentation" class="<?php if ($level_id == 8) {echo " ";} ?>">
										<a class="reviw" href="#stm_w_rev" aria-controls="stm_w_rev2" role="tab" data-toggle="tab">
											<i class="stm-service-icon-write-review"></i>
											<?php esc_html_e('Write a review', 'motors'); ?>
										</a>
									</li>
								</ul>
								
							</div>
						</div>
					</div>

					
				<!-- Tab panes -->
				<div class="stm-section review_sction" style="border: none;">
					<div class="tab-content">
						<?php if ($dealer_user_type == 'dealer') {	?>
							<div role="tabpanel" class="tab-pane fade in active" id="stm_d_inv">
								
							</div>

						<?php } ?>
						
						<div style="display:none;" role="tabpanel" class='tab-pane <?php if ($level_id == 8) {	echo " in active";} ?>' id="stm_d_rev">
							<?php get_template_part('partials/user/dealer', 'reviews'); ?>
						</div>
						<div style="display:none;" role="tabpanel" class="tab-pane <?php if ($level_id == 8) {	echo "";} ?>" id="reviw">
							<?php get_template_part('partials/user/dealer-write', 'review'); ?>
						</div>
					</div>
				</div>

					
					
				
				<!-- description section -->
				<?php if (!empty($user['stm_seller_notes'])) : ?>
					<div class="stm-section stm-dealer-desc-section author_bus_desc">
						<div class="stm-seller-notes">
							<?php
							if ($dealer_user_type == 'service_provider') {
							?>

								<div class="heading-title"><?php esc_html_e('Company profile', 'motors'); ?></div>
							<?php
							} else {
							?>
								<div class="heading-title"><?php esc_html_e('Business description', 'motors'); ?></div>
							<?php
							}
							?>
							<p class="eller_notes"><?php
							echo stripslashes(esc_attr($user['stm_seller_notes'])); ?></p>
						</div>
					</div>
				<?php endif; ?>

				<?php 
					// $car_media = stm_get_car_medias(get_the_id());
					//echo $user_id;
					$car_media_images = get_user_meta($user_id, 'stm_dealer_hidden_images', true);
					$car_media_images  = explode(",", $car_media_images);
					//print_r($car_media_images);

					$car_media['car_photos_count'] = count($car_media_images);
					//print_r($car_media_images);
					$car_media['car_photos'] = $car_media_images;
					
					if((!empty($car_media['car_photos_count']) && count($car_media['car_photos']) > 1)){ ?>
						<div class="stm-section stm-image-section author_image">

<script type="text/javascript">
	brand-carousel
	jQuery(document).ready(function(){
    jQuery(".custom-carousal").owlCarousel(
		        {
		            loop:true,
		margin:10,
		autoPlay:true,
		nav:true,
		startPosition: 2,
      navText : ['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>'],
		rewindNav:false,
		responsive:{
		    0:{
		        items:1
		    },
		    600:{
		        items:3
		    },
		    1000:{
		        items:4
		    }
		}

		        }

		    );
		});


</script>

<script type="text/javascript">

	
	jQuery(document).ready(function(){
    jQuery(".brand-carousel").owlCarousel(
		        {
		            loop:true,
		margin:10,
		autoPlay:true,
		nav:true,
     	rewindNav:false,
		responsive:{
		    0:{
		        items:1
		    },
		    600:{
		        items:3
		    },
		    1000:{
		        items:4
		    }
		}

		        }

		    );
		});


</script>

<div class="stm-section stm-dealer-services-section stm-categories-section author_distributor gal-img" 

>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<div class="stm-label service_category heading-title"><?php esc_html_e('Images', 'motors'); ?></div>
										
										<div class="custom-carousal brand-carousel section-padding owl-carousel">
										<?php

							foreach ($car_media['car_photos'] as $car_photo) {

											?>
											<div class="single-logo imagedistributorcontainer">

<?php 
												$thumbnail_id = pippin_get_image_id($car_photo);
													$sizeImg = (stm_is_dealer_two()) ? "stm-img-275-205" : 'stm-img-255-160';
													$img = wp_get_attachment_image_src($thumbnail_id, $sizeImg)[0];
?>

												<a href="<?php echo esc_url($img); ?>" class="stm_fancybox" >
													<img class="gallery-img car-img img-responsive" 
													 src="<?php echo esc_url($img); ?>"/>
												</a>
											</div>
												<!--<label>

													<img class="img-distributors-logo" src="<?php //echo  get_field('logo',get_term( $distributor )); ?>"> </img>
												</label>-->
																		<!--addded-->
						
						
												<!--<div class="slick-slide">
													<div class="inner">
														<img src="<?php //echo  get_field('logo',get_term( $distributor )); ?>" alt="PAS2424-2014-1" />
													</div>
												</div>-->
										
											<?php
										}
										?>
										</div>
										<div class="btns">
										  <div class="customNextBtn"><i class="fas fa-chevron-right"></i></div>
										  <div class="customPreviousBtn"><i class="fas fa-chevron-left"></i></div>
										</div>
										
									</div>
								</div>
							</div>
						</div>




						</div>
				<?php } ?>

				<?php 
					$stm_video_url = get_user_meta($user_id, 'stm_video_url', true);
					if( !empty($stm_video_url) ){
				?>
						<div class="stm-section stm-video-section author_video">
							<div class="stm-inner">
								<div class="heading-title">Videos</div>
								<?php 
								//$stm_video_url = get_user_meta($user_id, 'stm_video_url', true);

								if (!empty($stm_video_url)) {
									echo "<center>" . convertYoutube($stm_video_url) . "</center>";
									//echo '<iframe width="736" height="414" src="'.$stm_video_url.'" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
									//die;
									//  echo do_shortcode( '[embed]'.$stm_video_url.'[/embed]' );
								}

								?>
							</div>
						</div>
				<?php } ?>
				
				
				<!-- services section -->
				
					<?php if ($distributors) { ?>
					
						<div class="stm-section stm-dealer-services-section stm-categories-section author_distributor" id="welcome" >
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<div class="stm-label service_category heading-title"><?php esc_html_e('Distributors / Stockists', 'motors'); ?></div>
										
										<div class="brand-carousel section-padding owl-carousel">
										<?php

										foreach ($distributors as $key => $distributor) {
											?>
											<div class="single-logo imagedistributorcontainer">
												<img class="img-distributors-logo" src="<?php echo  get_field('logo',get_term( $distributor )); ?>"> </img>
											</div>
												<!--<label>

													<img class="img-distributors-logo" src="<?php //echo  get_field('logo',get_term( $distributor )); ?>"> </img>
												</label>-->
																		<!--addded-->
						
						
												<!--<div class="slick-slide">
													<div class="inner">
														<img src="<?php //echo  get_field('logo',get_term( $distributor )); ?>" alt="PAS2424-2014-1" />
													</div>
												</div>-->
										
											<?php
										}
										?>
										</div>
										<div class="btns">
										  <div class="customNextBtn"><i class="fas fa-chevron-right"></i></div>
										  <div class="customPreviousBtn"><i class="fas fa-chevron-left"></i></div>
										</div>
										
									</div>
								</div>
							</div>
						</div>
					<?php } ?>
					
										
				
				<!-- services section -->
				
					<?php if ($services && !$place_user) { 
						$service_categories = get_terms(array('taxonomy' => 'service_category', 'hide_empty' => false, 'parent' => 0, 'include' => $services));
						foreach ($service_categories as $service_categorie) {

						?>
						<div class="stm-section stm-dealer-services-section stm-categories-section author_services">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<div class="stm-label service_category heading-title"><?php echo  $service_categorie->name; ?></div>
										<?php
										$allservice = get_terms( array(
									        'taxonomy' => 'service_category',
									        'hide_empty' => false,
									        'parent' => $service_categorie->term_id,
									        'include' => $services
									        
									    ) );

										foreach ($allservice as  $service) {

											# code...
										?>
											<div class="col-md-3 col-sm-3 col-xs-6">
												<label>

													<span class="service_data_single"><?php echo $service->name; ?></span>
												</label>
											</div>
										<?php
										}
										?>
									</div>
								</div>
							</div>
						</div>
					<?php } 
						}
					?>
				


				
					<?php if ($place_user) { ?>
						<div class="stm-section stm-dealer-services-section stm-categories-section">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<div class="stm-label service_category heading-title"><?php esc_html_e('Places', 'motors'); ?></div>
										<?php

										foreach ($places as $key => $place) {

											# code...
										?>
											<div class="col-md-3 col-sm-3 col-xs-6">
												<label>

													<span class="service_data_single"><?php echo get_term( $place )->name; ?></span>
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
					
					<?php if ($things) { ?>
						<div class="stm-section stm-dealer-services-section stm-categories-section">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<div class="stm-label service_category heading-title"><?php esc_html_e('Things to do', 'motors'); ?></div>
										<?php

										foreach ($things as $key => $thing) {

											# code...
										?>
											<div class="col-md-3 col-sm-3 col-xs-6">
												<label>

													<span class="service_data_single"><?php echo get_term( $thing )->name; ?></span>
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
				

				<!-- Additional Services section -->
				<?php if ($dealer_user_type == 'dealer_service_provider' || $dealer_user_type == 'service_provider') { ?>
					<?php if ($is_warranty  || $house_financing) { ?>
						<div class="stm-section stm-dealer-additional-section stm-categories-section">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<div class="stm-label additional_service heading-title"><?php esc_html_e('Dealer facilities', 'motors'); ?></div>
									</div>
									<?php if ($is_warranty) { ?>
										<div class="col-md-3 col-sm-3 col-xs-6">
											<label>
												<span class="service_data_single">Warranty</span>
											</label>
										</div>
									<?php } ?>
									<?php if ($house_financing) { ?>
										<div class="col-md-3 col-sm-3 col-xs-6">
											<label>
												<span class="service_data_single">Financing</span>
											</label>
										</div>
									<?php } ?>
								</div>
							</div>
						</div>
					<?php } ?>
				<?php } ?>

<?php 
//var_dump($place_user);
if(empty($place_user)){
?>
<div class="stm-section stm-dealer-tab-section">
	<?php get_template_part('partials/user/dealer_custom', 'inventory'); ?>
</div>
<?php 
}
?>

<div class="stm-section stm-dealer-tab-section">
	<div class="heading-title"><?php esc_html_e('Page Views', 'motors'); ?></div>
	
			<div class="visitor_sec">
			<?php 
			global $wpdb;
			$userIP = $_SERVER['REMOTE_ADDR'];
			$author = get_user_by( 'slug', get_query_var( 'author_name' ) );
			$author_id = $author->ID; 
			$table = $wpdb->prefix."unique_visitors";
			
			/* $already_user = $wpdb->get_var( "SELECT count(*) FROM $table WHERE `IP` = '$userIP' AND `author_id` = '$author_id'" );
			if($already_user == 0){ */
				$wpdb->insert($table, array(
						'IP' => $userIP,
						'author_id' => $author_id,
					) ); 
			//}
			
			$visitors = $wpdb->get_var( "SELECT count(*) FROM $table WHERE `author_id` = '$author_id'" );
				
			$visitors = $visitors;
			echo $visitors;
			?>
			</div>
</div>


				<?php /* ?>
				<div class="clearfix">
                        <div class="stm-dealer-image">
                            
                        </div>
                        <div class="stm-dealer-info <?php echo esc_attr($inline_list); ?>">
                            
                           
                            <?php if (!empty($user['stm_sales_hours'])): ?>
                            <div class="stm-dealer-info-unit sales_hours">
                                <i class="stm-service-icon-sales_hours"></i>
                                <div class="inner">
                                    <h5><?php esc_html_e('Sales Hours', 'motors'); ?></h5>
                                    <span><?php esc_html_e($user['stm_sales_hours'], 'motors'); ?></span>
                                </div>
                            </div>
                            <?php endif; ?>
                            <?php if (!empty($user['email']) and $user_show_mail == 'show'): ?>
                             <div class="stm-dealer-info-unit stm-user-email">
                                <i class="fa fa-envelope-o"></i>
                                <div class="inner">
                                   <h5><?php esc_html_e('Seller email', 'motors'); ?></h5>
                                   <a href="mailto:<?php echo esc_attr($user['email']); ?>"
                                    class="mail"><?php echo esc_attr($user['email']); ?></a>
                                </div>
                            </div>
                            <?php endif; ?>
                            <div class="clearfix"></div>
                                                

                                
                            
						</div>
					</div><?php */ ?>

			</div>
		 </div> 

		<?php echo stm_do_lmth($layout['content_after']); ?>
		
		<?php	echo stm_do_lmth($layout['sidebar_before']);
			
		// if (!empty($user['location_lat']) and !empty($user['location_lng']) and !empty($user['location'])) {
		// stm_dealer_gmap($user['location_lat'], $user['location_lng']);
		// }
		
		?>

		<div class="stm-sidebar stm-dealer-info-section">
			<div class="widget">
				<?php //if ( !empty($user['location']) ) : ?>
					<div class="stm-block stm-address-block author_address">
						<div class="stm-dealer-info-unit location">
							<div class="heading-title sidebar_cstm">								
								<span><?php esc_html_e('Contact us', 'motors'); ?></span>
							</div>
							<div class="inner add-icons">
								<span>
								<?php  
									if( !empty($user['location']) ){
										$location = $user['location'];
										
									}elseif( empty($user['location']) || trim($user['location']) == "," ){
										$city = get_user_meta($user_id,'billing_city',true);
										$location = get_user_meta($user_id,'billing_address_1',true). ", ".$city;
									}
									?><span class="address_img"><!--<img src="<?php echo get_home_url(); ?>/wp-content/uploads/2021/09/location.png" />-->
									<svg width="12" height="17" viewBox="0 0 14 17" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M7 0C3.2785 0 0.25 2.88008 0.25 6.42104C0.25 11.4523 6.3655 16.6472 6.62575 16.8654C6.733 16.9554 6.8665 17 7 17C7.1335 17 7.267 16.9554 7.37425 16.8661C7.6345 16.6472 13.75 11.4523 13.75 6.42104C13.75 2.88008 10.7215 0 7 0ZM7 9.91667C4.93225 9.91667 3.25 8.32788 3.25 6.375C3.25 4.42212 4.93225 2.83333 7 2.83333C9.06775 2.83333 10.75 4.42212 10.75 6.375C10.75 8.32788 9.06775 9.91667 7 9.91667Z" fill="black"/>
									</svg>
									</span><span class="address_nm"><?php echo $location;
								?></span>
								</span>
							</div>
						</div>
					</div>
				<?php //endif; ?>

				<?php
				$showNumber = true;
				if (empty($user['phone'])) {
					$user['phone'] = get_user_meta($user_id, 'billing_phone', true);
				}
				if (!empty($user['phone'])) : ?>
					<?php $showNumber = get_theme_mod("stm_show_number", false); ?>
					<div class="stm-block stm-phone-block author_phone">
						<div class="stm-dealer-info-unit phone">
							<!--<div class="heading-title">
								<i class="eventer-icon-phone"></i>
								<span><?php esc_html_e('Call Us', 'motors'); ?></span>
							</div>-->
							<div class="inner add-icons">
								<span class="contact_no_img"><!--<img src="<?php echo get_home_url(); ?>/wp-content/uploads/2021/09/call-5.png" />--><svg width="14" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M14.7161 10.5022C13.7365 10.5022 12.7747 10.349 11.8633 10.0478C11.4166 9.89542 10.8676 10.0352 10.595 10.3151L8.79598 11.6732C6.70961 10.5595 5.42444 9.27475 4.32595 7.20404L5.64407 5.45188C5.98653 5.10988 6.10936 4.61029 5.96219 4.14154C5.65969 3.22529 5.50603 2.26392 5.50603 1.28392C5.50607 0.575958 4.93011 0 4.2222 0H1.28387C0.575957 0 0 0.575958 0 1.28387C0 9.39846 6.60157 16 14.7161 16C15.424 16 16 15.424 16 14.7161V11.786C16 11.0781 15.424 10.5022 14.7161 10.5022Z" fill="black"/>
</svg></span>
								<?php if ($showNumber && 1 == 1) : ?>
									<?php if (!empty($user['phone'])) : ?>
										<span class="phone"></i><?php echo FormatPhone(esc_attr($user['phone'])); ?></span>
									<?php endif; ?>
								<?php else : ?>
									<span class="phone"></i><?php echo FormatPhone(esc_attr($user['phone'])); ?></span>
									<!--<span class="phone"><?php echo substr_replace($user['phone'], "*******", 3, strlen($user['phone'])); ?></span>
                                    <span class="stm-show-number" data-id="<?php echo esc_attr($user_id); ?>"><?php echo esc_html__("Show number", "motors"); ?></span>-->
								<?php endif; ?>
							</div>
						</div>
					</div>
				<?php endif; ?>
				
				<div class="stm-block stm-address-block website_details author_website">
					<div class="stm-dealer-info-unit location add-icons">
						<!--img src="<?php echo get_home_url(); ?>/wp-content/uploads/2021/09/web-1.png" />-->
<svg width="17" height="17" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M21.3884 14.6188C21.7845 13.4849 22.0007 12.2673 22.0007 10.9999C22.0007 9.7326 21.7845 8.51497 21.3884 7.38113C21.3788 7.34707 21.3673 7.31385 21.3534 7.28189C19.8256 3.04075 15.7619 0 11.0008 0C6.23975 0 2.17595 3.04075 0.648212 7.28189C0.634336 7.31396 0.622772 7.34707 0.613206 7.38113C0.217107 8.51497 0.000976562 9.7326 0.000976562 10.9999C0.000976562 12.2673 0.217107 13.4849 0.613206 14.6188C0.622877 14.6528 0.634336 14.686 0.648212 14.718C2.17605 18.9592 6.23975 21.9999 11.0008 21.9999C15.7619 21.9999 19.8256 18.9591 21.3534 14.718C21.3673 14.686 21.3788 14.6529 21.3884 14.6188ZM11.0008 20.4232C10.5819 20.4232 9.9065 19.665 9.342 17.9713C9.06952 17.154 8.85139 16.2144 8.69245 15.1923H13.3092C13.1502 16.2144 12.9321 17.1539 12.6597 17.9713C12.0951 19.665 11.4197 20.4232 11.0008 20.4232ZM8.50113 13.6155C8.42534 12.7747 8.38528 11.8976 8.38528 10.9999C8.38528 10.1023 8.42534 9.22517 8.50113 8.38441H13.5004C13.5762 9.22517 13.6163 10.1023 13.6163 10.9999C13.6163 11.8976 13.5762 12.7747 13.5004 13.6155H8.50113ZM1.5777 11.0001C1.5777 10.0929 1.70689 9.21529 1.94731 8.38452H6.91957C6.84588 9.24263 6.80846 10.1221 6.80846 11.0001C6.80846 11.878 6.84578 12.7575 6.91957 13.6156H1.94731C1.70689 12.7847 1.5777 11.9073 1.5777 11.0001ZM11.0008 1.57683C11.4197 1.57683 12.0952 2.33497 12.6597 4.02869C12.9321 4.84601 13.1504 5.78559 13.3092 6.80758H8.69235C8.85129 5.78548 9.06942 4.84601 9.34189 4.02869C9.9065 2.33497 10.5819 1.57683 11.0008 1.57683ZM15.082 8.38452H20.0542C20.2946 9.21529 20.4238 10.0929 20.4238 11.0001C20.4238 11.9073 20.2946 12.7848 20.0542 13.6156H15.082C15.1557 12.7575 15.1931 11.878 15.1931 11.0001C15.1931 10.1221 15.1557 9.24263 15.082 8.38452ZM19.4381 6.80769H14.9011C14.6206 4.87376 14.1394 3.13873 13.4645 1.90439C16.0815 2.61385 18.2496 4.42521 19.4381 6.80769ZM8.53708 1.90428C7.86209 3.13862 7.38095 4.87366 7.10049 6.80769H2.56343C3.75204 4.42521 5.92007 2.61385 8.53708 1.90428ZM2.56343 15.1923H7.10049C7.38095 17.1262 7.86209 18.8613 8.53708 20.0957C5.92007 19.3861 3.75204 17.5749 2.56343 15.1923ZM13.4645 20.0957C14.1394 18.8614 14.6206 17.1263 14.9011 15.1923H19.4381C18.2496 17.5749 16.0815 19.3861 13.4645 20.0957Z" fill="#565656"/>
</svg>
<a href="<?php echo esc_url($user['website']); ?>" class="web-link">Website</a>
					</div>
				</div>
				<div class="stm-block stm-address-block website_details author_website">
					<div class="stm-dealer-info-unit location add-icons">
						<!--img src="<?php echo get_home_url(); ?>/wp-content/uploads/2021/09/web-1.png" />-->
<svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24"><path d="M10 19.5c0 .829-.672 1.5-1.5 1.5s-1.5-.671-1.5-1.5c0-.828.672-1.5 1.5-1.5s1.5.672 1.5 1.5zm3.5-1.5c-.828 0-1.5.671-1.5 1.5s.672 1.5 1.5 1.5 1.5-.671 1.5-1.5c0-.828-.672-1.5-1.5-1.5zm1.336-5l1.977-7h-16.813l2.938 7h11.898zm4.969-10l-3.432 12h-12.597l.839 2h13.239l3.474-12h1.929l.743-2h-4.195z" fill="#565656"/></svg>

<a href="<?php echo esc_url($stm_ebay_acc); ?>" class="web-link">Online Shop</a>
					</div>
				</div>
				
				<!--map-->
				
				<div class="stm-map-block stm-block author_map">
					<?php
					//var_dump($user['location']);
					// if (!empty($user['location_lat']) and !empty($user['location_lng']) and !empty($user['location'])) {
						// stm_dealer_gmap($user['location_lat'], $user['location_lng']);
					// }
					if( !empty($user['location_lat']) and !empty($user['location_lng']) ) {
						$latitude = $user['location_lat'];
						$longitude = $user['location_lng'];
						
						stm_dealer_gmap($latitude, $longitude);
						
					}elseif( !empty($user['location']) ){
						$data_arr = geocode_from_address($user['location']);
						if($data_arr){
							$latitude = $data_arr[0];
							$longitude = $data_arr[1];
							
							stm_dealer_gmap($latitude, $longitude);
						}
					}
					?>
				</div>

				<?php
				/* echo"<pre>";
				print_r($user['socials']); */
				//if (!empty($user['socials'])) :
					$user['socials']['instagram'] = $instagram;
					if(!empty($stm_instagram_acc) ||  !empty($stm_facebook_acc) || !empty($stm_twitter_acc) || !empty($stm_youtube_acc)){
				?>
					<div class="stm-block stm-social-block author_social">
						<div class="socials-media-dealerpage clearfix">
							<div class="heading-title sidebar_cstm">								
								<span><?php esc_html_e('Social Links', 'motors'); ?></span>
							</div>
							<div class="inner stm_socials_settings social_links_c">
								<span>
									<?php //foreach ($user['socials'] as $social_key => $social) : ?>
									<?php if(!empty($stm_facebook_acc)) { ?>
										<a target="_blank" href="<?php echo $stm_facebook_acc;?>">
										<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="facebook">
<path d="M3.51562 24H11.3438V15.4688H8.53125V12.6562H11.3438V9.14062C11.3438 7.20209 12.9208 5.625 14.8594 5.625H18.375V8.4375H15.5625C14.787 8.4375 14.1562 9.0683 14.1562 9.84375V12.6562H18.2481L17.7794 15.4688H14.1562V24H20.4844C22.4229 24 24 22.4229 24 20.4844V3.51562C24 1.57709 22.4229 0 20.4844 0H3.51562C1.57709 0 0 1.57709 0 3.51562V20.4844C0 22.4229 1.57709 24 3.51562 24ZM1.40625 3.51562C1.40625 2.35254 2.35254 1.40625 3.51562 1.40625H20.4844C21.6475 1.40625 22.5938 2.35254 22.5938 3.51562V20.4844C22.5938 21.6475 21.6475 22.5938 20.4844 22.5938H15.5625V16.875H18.9706L19.9081 11.25H15.5625V9.84375H19.7812V4.21875H14.8594C12.1454 4.21875 9.9375 6.42664 9.9375 9.14062V11.25H7.125V16.875H9.9375V22.5938H3.51562C2.35254 22.5938 1.40625 21.6475 1.40625 20.4844V3.51562Z" fill="#565656"/>
</svg><span><!--Facebook--></span>
<?php 

}

if(!empty($stm_twitter_acc)) { ?>
										</a>
										<a target="_blank" href="<?php echo $stm_twitter_acc;?>">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="24px" height="24px" class="twitter"><path fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="3" d="M49,11.096c-1.768,0.784-3.664,1.311-5.658,1.552c2.035-1.22,3.597-3.151,4.332-5.448c-1.903,1.127-4.013,1.947-6.255,2.388c-1.795-1.916-4.354-3.11-7.186-3.11c-5.44,0-9.849,4.409-9.849,9.847c0,0.771,0.088,1.522,0.257,2.244c-8.184-0.412-15.441-4.332-20.299-10.29c-0.848,1.458-1.332,3.149-1.332,4.953c0,3.416,1.735,6.429,4.38,8.197c-1.616-0.051-3.132-0.495-4.46-1.233c0,0.042,0,0.082,0,0.125c0,4.773,3.394,8.748,7.896,9.657c-0.824,0.227-1.694,0.346-2.592,0.346c-0.636,0-1.253-0.062-1.856-0.178c1.257,3.909,4.892,6.761,9.201,6.84c-3.368,2.641-7.614,4.213-12.23,4.213c-0.797,0-1.579-0.044-2.348-0.137c4.356,2.795,9.534,4.425,15.095,4.425c18.114,0,28.022-15.007,28.022-28.016c0-0.429-0.011-0.856-0.029-1.275C46.012,14.807,47.681,13.071,49,11.096z"/></svg><span><!--LinkedIn--></span>
										</a>
									<?php } 

if(!empty($stm_instagram_acc)) { ?>
										</a>
										<a target="_blank" href="<?php echo $stm_instagram_acc;?>">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"  class="bi bi-instagram twitter" viewBox="0 0 18 18">
  <path  d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
</svg>
										</a>
									<?php } 


if(!empty($stm_youtube_acc)) { ?>
										</a>
										<a target="_blank" href="<?php echo $stm_youtube_acc;?>">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"  class="bi bi-instagram twitter" viewBox="0 0 18 18">
  <path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.007 2.007 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.007 2.007 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31.4 31.4 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.007 2.007 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A99.788 99.788 0 0 1 7.858 2h.193zM6.4 5.209v4.818l4.157-2.408L6.4 5.209z"/>
</svg>
										</a>
									<?php } 

if(!empty($stm_linked_acc)) {
									?>
										<a target="_blank" href="">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="24px" height="24px" class="linked"><path fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="3" d="M3 16L13 16 13 35.665 13 45 3 45z"/><path fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="3" d="M8,12L8,12c-3,0-5-1.813-5-4.053S5,4,8,4s4.875,1.707,5,3.947C13,10.187,11.125,12,8,12z"/><path fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="3" d="M37,28.5c0-2.485-2.015-4.5-4.5-4.5S28,26.015,28,28.5c0,0,0,0.125,0,0.25c0,0.125,0,0.25,0,0.25c0,1.291,0,16,0,16H18V16h10v3.639c0,0,3.27-3.639,8.787-3.639C42.422,16,47,20.135,47,28v17H37C37,45,37,29.557,37,28.5"/></svg><span><!--Twitter--></span>
										</a>
									<?php } //endforeach; ?>

									<?php
									//echo do_shortcode('[addtoany]');
									?>
								</span>
							</div>
						</div>
					</div>
				<?php } ?>

				<?php //if (!empty($user['stm_sales_hours'])){ ?>
				<?php if( !empty($working_monday) || !empty($working_thesday) || !empty($working_wednesday) || !empty($working_thursday) || !empty($working_friday) || !empty($working_saturday) || !empty($working_sunday) ){ ?>
					<div class="stm-block stm-hours-block author_hours">
						<div class="stm-dealer-info-unit sales_hours">
							<div class="heading-title">
								<span><?php esc_html_e('Opening Hours', 'motors'); ?></span>
							</div>
							<!--<div class="inner">
							
								
								
								<?php if( !empty($weekday_from) && !empty($weekday_to) ){ ?>
									<?php if( !empty($working_monday) ){ ?>
										<div class=""><?php echo $working_monday." : ".$weekday_from." - ".$weekday_to; ?></div>
									<?php } ?>
									<?php if( !empty($working_thesday) ){ ?>
										<div class=""><?php echo $working_thesday." : ".$weekday_from." - ".$weekday_to; ?></div>
									<?php } ?>
									<?php if( !empty($working_wednesday) ){ ?>
										<div class=""><?php echo $working_wednesday." : ".$weekday_from." - ".$weekday_to; ?></div>
									<?php } ?>
									<?php if( !empty($working_thursday) ){ ?>
										<div class=""><?php echo $working_thursday." : ".$weekday_from." - ".$weekday_to; ?></div>
									<?php } ?>
									<?php if( !empty($working_friday) ){ ?>
										<div class=""><?php echo $working_friday." : ".$weekday_from." - ".$weekday_to; ?></div>
									<?php } ?>
								<?php } ?>
							
								<?php if( !empty($working_saturday) ){ ?>
									<div class=""><?php echo $working_saturday." : ".$saturday_from." - ".$saturday_to; ?></div>
								<?php } ?>
								
								<?php if( !empty($working_sunday) ){ ?>
									<div class=""><?php echo $working_sunday." : ".$sunday_from." - ".$sunday_to; ?></div>
								<?php } ?>
							</div>-->
							
							<div class="opening_hours">
								<div class="week_section1 week_days">
									<div class="day1">
										<span><img src="https://hd-central.com/wp-content/uploads/2021/09/monday-1.jpg" /></span>
										<span>9:00am - 5:00pm</span>
									</div>
									<div class="day2">
										<span><img src="https://hd-central.com/wp-content/uploads/2021/09/tuesday.jpg" /></span>
										<span>9:00am - 5:00pm</span>
									</div>
								</div>
								<div class="week_section2 week_days">
									<div class="day1">
										<span><img src="https://hd-central.com/wp-content/uploads/2021/09/wednesday.jpg" /></span>
										<span>9:00am - 5:00pm</span>
									</div>
									<div class="day2">
										<span><img src="https://hd-central.com/wp-content/uploads/2021/09/thursday.jpg" /></span>
										<span>9:00am - 5:00pm</span>
									</div>
								</div>
								<div class="week_section3 week_days">
									<div class="day1">
										<span><img src="https://hd-central.com/wp-content/uploads/2021/09/friday.jpg" /></span>
										<span>9:00am - 5:00pm</span>
									</div>
									<div class="day2">
										<span><img src="https://hd-central.com/wp-content/uploads/2021/09/saturday.jpg" /></span>
										<span>9:00am - 2:00pm</span>
									</div>
								</div>
							</div>
							
						</div>
					</div>
				<?php } ?>


				
				<?php
				$promotion = get_user_meta($user_id,'my_offer_id',true);
					if( !empty($promotion) && get_post_status($promotion) ){
						$offer_title = get_the_title($promotion);
						$offer_details = get_post_meta($promotion,'offer_details', true);
						$link_to_offer = get_post_meta($promotion,'link_to_offer', true);
						$offer_end_date = get_post_meta($promotion,'offer_end_date', true);
						$offer_image = get_post_meta($promotion,'offer_image', true);
				?>			
				<div class="stm-block stm-phone-block author_special_offer">
					
					<a class="contact_title" data-toggle="collapse" href="#Special_Offer">Special Offer: <i class="fa fa-plus"></i></a>
					
					<?php if($offer_image){ ?>

						        <div id="Special_Offer" class="panel-collapse collapse inner" style="margin-top: 10px;">
						        	<img src="<?php echo wp_get_attachment_url($offer_image); ?>"/>
									<h3 style="margin-top: 10px;text-decoration: underline;"><?php echo $offer_title; ?></h3>
									<div style="min-height: 100px;"><?php echo $offer_details; ?></div>
						        </div>
						        <?php } ?>
					<!-- <h3 style="margin-top: 10px;text-decoration: underline;"><?php echo $offer_title; ?></h3>
					<div style="min-height: 100px;"><?php echo $offer_details; ?></div> -->

					<?php
						        $terms = get_the_terms( $promotion, 'offer-categories' );
								                         
								if ( $terms && ! is_wp_error( $terms ) ) : 
								 
								    $draught_links = array();
								 
								    foreach ( $terms as $term ) {

									    echo '<div class="tagboxservice Offers_tag dealer-offer">';
												
						
								        echo $term->name;
								        echo "</div>";
								    }
								                         
								    
								    ?>
								 
								<?php endif; ?>

									<div style="text-align: left;display: block;margin-top:15px;"><h3>Valid Untill: <?php
									 $date = new DateTime($offer_end_date);
									 echo $date->format('m-d-Y'); ?></h3></div>
									 <?php if($link_to_offer) {?>
									 <div>
									  <a href="<?php echo $link_to_offer; ?>">Click here for more details</a>
									</div>
								<?php }?>

				</div>
				<?php }?>
			</div>
		</div>

		<?php
		if (!empty($sidebar)) :
			$user_sidebar = get_post($sidebar);

			if (!empty($user_sidebar) and !is_wp_error($user_sidebar)) :
			
		?>

				<div class="stm-sidebar stm-contact-section author_business">
					<div class="stm-accordion-single-unit ">

						<div class="stm-block stm-contact-block">
							<div class="heading-title">
								<a class="contact_title" data-toggle="collapse" href="#contact_information">Contact this business <i class="fa fa-plus"></i></a>
							</div>
							<div id="contact_information" class="panel-collapse collapse inner">
								<div class="panel-body">

									<div class="stm-user-sidebar">
										<?php echo apply_filters('the_content', $user_sidebar->post_content); ?>

										

										<style type="text/css">
											<?php echo get_post_meta($user_sidebar, '_wpb_shortcodes_custom_css', true); ?>
										</style>

										<script type="text/javascript">
											jQuery(window).load(function() {
												var $ = jQuery;
												var inputAuthor = '<input type="hidden" value="<?php echo esc_attr($user_page->ID); ?>" name="stm_changed_recepient"/>';
												$('.stm_listing_car_form form').append(inputAuthor);
											})
										</script>
									</div>

								</div>
							</div>
						</div>

					</div>
				</div>
				<?php if(!empty($enable_service_booking) && !empty($book_email) && $level_id == 8){ ?>
				<div class="stm-sidebar stm-contact-section author_business">
					<div class="stm-accordion-single-unit ">

						<div class="stm-block stm-contact-block">
							<div class="heading-title">
								<a class="contact_title" data-toggle="collapse" href="#book_information">Book a Service <i class="fa fa-plus"></i></a>
							</div>
							<div id="book_information" class="panel-collapse collapse inner">
								<div class="panel-body">

									<div class="stm-user-sidebar">
										

										<?php
										$_REQUEST['serviceemail'] = $book_email;
										 echo do_shortcode('[gravityform id="32" title="false" description="false"]'); ?>
									</div>
									<style type="text/css">
										.serviceemail{
											display: none;
										}
									</style>

								</div>
							</div>
						</div>

					</div>
				</div>


				
				<?php } ?>
			
				<div class="button_contact" style="display:none">
					<a href="<?php echo get_site_url(); ?>/claim-your-business/?userid=<?php echo $user_id; ?>&sname=<?php echo rawurlencode(htmlspecialchars(stm_display_user_name($user_id))); ?>"><button>Claim This Business</button></a>
				</div>

			<?php endif; ?>
		<?php endif; ?>


		<?php
		if (is_active_sidebar('single-dealer')) : ?>
			<div class="stm-sidebar stm-single-dealer-sidebar">
				<?php dynamic_sidebar('single-dealer'); ?>
			</div>
		<?php endif; ?>


		<?php echo stm_do_lmth($layout['sidebar_after']); ?>

	</div>


	<script type="text/javascript">
		jQuery(document).ready(function() {
			var $ = jQuery;
			if (location.hash !== '') {
				$('a[href="' + location.hash + '"]').tab('show');
			}
			
			jQuery(".stm_d_rev").click(function() {
				console.log("xcvzxc");
				jQuery("#stm_d_rev").slideToggle();
				jQuery("#reviw").hide();
				
			});
			jQuery(".reviw").click(function() {
				console.log("vvvv");
				jQuery("#reviw").slideToggle();
				jQuery("#stm_d_rev").hide();
				
			});
			
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

	<!--
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			 $('.slick.marquee1').slick({
			   speed: 5000,
			   autoplay: true,
			   autoplaySpeed: 0,
			   centerMode: true,
			   cssEase: 'linear',
			   slidesToShow: 1,
			   slidesToScroll: 1,
			   variableWidth: true,
			   infinite: true,
			   initialSlide: 1,
			   arrows: false,
			   buttons: false
			 });
			});
	</script>-->
	
	<style>
	.archive.author .entry-header{
		
		display:none;
	}
	</style>