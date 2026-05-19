<?php
$show_compare = get_theme_mod('show_listing_compare', false);

$show_favorite = get_theme_mod('enable_favorite_items', true);

if(stm_is_dealer_two() || stm_is_aircrafts()) $show_favorite = false;
$img = get_post_meta(get_the_ID(), 'property_featured_image', true); 


$car_media_images = get_post_meta(get_the_ID(), 'gallery', true);

if(empty($car_media_images)){
        $car_media_images = get_post_meta(get_the_ID(), 'gallery_ebay', true);
        $img = $car_media_images[0];
 }

if(!empty($car_media_images[0])){
	$img = $car_media_images[0];
	$imgX2 = $car_media_images[0];
}
//echo "img_list: ".$imgX2;
$car_media = stm_get_car_medias(get_the_id());

$asSold = get_post_meta(get_the_ID(), 'car_mark_as_sold', true);
global $dynamicClassPhoto;
$dynamicClassPhoto = 'stm-car-photos-' . get_the_id() . '-' . rand();
$dynamicClassVideo = 'stm-car-videos-' . get_the_id() . '-' . rand();
?>

<div class="image">

	<!--Hover blocks-->
	<!---Media-->
	<div class="stm-car-medias">
		<?php if(!empty($car_media_images)): ?>
			<div class="stm-listing-photos-unit stm-car-photos-<?php echo get_the_id(); ?> <?php echo esc_attr($dynamicClassPhoto); ?>">
				<i class="stm-service-icon-photo"></i>
				<span><?php echo esc_html(count($car_media_images)); ?></span>
			</div>

			<script type="text/javascript">
				jQuery(document).ready(function(){
					jQuery(".<?php echo esc_attr($dynamicClassPhoto); ?>").on('click', function() {
                        jQuery(this).lightGallery({
                            dynamic: true,
                            dynamicEl: [
                                <?php foreach($car_media_images as $car_photo): ?>
                                {
                                    src  : "<?php echo esc_url($car_photo); ?>"
                                },
                                <?php endforeach; ?>
                            ],
                            download: false,
                            mode: 'lg-fade',
                        })
					});
				});

			</script>
		<?php endif; ?>
		<?php if(!empty($car_media['car_videos_count'])): ?>
			<div class="stm-listing-videos-unit stm-car-videos-<?php echo get_the_id(); ?> <?php echo esc_attr($dynamicClassVideo); ?>">
				<i class="fa fa-film"></i>
				<span><?php echo esc_html($car_media['car_videos_count']); ?></span>
			</div>

			<script type="text/javascript">
				jQuery(document).ready(function(){
					jQuery(".<?php echo esc_attr($dynamicClassVideo); ?>").on('click', function() {

                        jQuery(this).lightGallery({
                            selector: 'this',
                            dynamic: true,
                            dynamicEl: [
                                <?php foreach($car_media['car_videos'] as $car_video): ?>
                                {
                                    src : "<?php echo esc_url($car_video); ?>",
                                    thumb: ''
                                },
                                <?php endforeach; ?>
                            ],
                            download: false,
                            mode: 'lg-video',
                        })
					}); //click
				}); //ready

			</script>
		<?php endif; ?>
	</div>
<!--Compare-->

	

	<a href="<?php the_permalink() ?>" class="rmv_txt_drctn">
		<div class="image-inner">
			<?php get_template_part('partials/listing-cars/listing-directory', 'badges'); ?>
			<?php 
				
				
				$sizeImg = (stm_is_dealer_two()) ? "stm-img-275-205" : 'stm-img-255-160';
				$imgRetina = (stm_is_dealer_two()) ? 'stm-img-275-205-x-2' : 'stm-img-255-160-x-2';
                $plchldr = (stm_is_dealer_two()) ? "plchldr-275.jpg" : 'plchldr350.png';
                $plchldr = (stm_is_aircrafts()) ? 'ac_plchldr.jpg' : $plchldr;
			if($img): 

				?>
				
				<img
					data-original="<?php echo esc_url(!empty($img) ? $img : get_stylesheet_directory_uri().'/assets/images/' . $plchldr); ?>"
					<?php if(!empty($imgRetina)): ?>
                        srcset="<?php echo esc_url(!empty($img) ? $img : get_stylesheet_directory_uri().'/assets/images/' . $plchldr); ?> 1x, <?php echo esc_url(!empty($imgX2) ? $imgX2 : get_stylesheet_directory_uri().'/assets/images/' . $plchldr); ?> 2x"
					<?php endif; ?>
					src="<?php echo esc_url(get_stylesheet_directory_uri().'/assets/images/' . $plchldr); ?>"
					class="lazy img-responsive"
					alt="<?php the_title(); ?>"
				/>
			<?php else :
                $plchldr = (stm_is_dealer_two()) ? "plchldr-275.jpg" : 'plchldr350.png';
                ?>
				<img
					src="<?php echo esc_url(get_stylesheet_directory_uri().'/assets/images/' . $plchldr); ?>"
					class="img-responsive"
					alt="<?php esc_attr_e('Placeholder', 'motors'); ?>"
				/>
			<?php endif; ?>
			<?php if(is_listing() && !empty($asSold)): ?>
				<div class="stm-badge-directory heading-font" <?php echo sanitize_text_field($badge_bg_color); ?>>
					<?php echo esc_html__('Sold', 'motors'); ?>
				</div>
			<?php endif; ?>
		</div>
	</a>
</div>
