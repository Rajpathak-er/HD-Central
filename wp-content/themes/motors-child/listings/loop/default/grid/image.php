<?php
$placeholder_path = 'plchldr255.png';
if(wp_is_mobile()){
    $placeholder_path = 'plchldr350.png';
}
if (stm_is_boats()) {
    $show_compare = get_theme_mod('show_listing_compare', false);

    if (stm_is_boats()) {
        $placeholder_path = 'boats-placeholders/boats-250.png';
    }
}
$car_media = stm_get_car_medias(get_the_id());

global $dynamicClassPhoto;
$dynamicClassPhoto = 'stm-car-photos-' . get_the_id() . '-' . rand();
$dynamicClassVideo = 'stm-car-videos-' . get_the_id() . '-' . rand();

$placeholder_path = (stm_is_aircrafts()) ? 'ac_plchldr.jpg' : $placeholder_path;
?>

<div class="image">
    <?php if (has_post_thumbnail()): ?>
        <?php
        $size = 'stm-img-255-135';
        $sizeRetina = 'stm-img-255-135-x-2';

        if(wp_is_mobile()){
            $size = 'stm-img-796-466';
        }

        if(stm_is_boats()) {
            $size = 'stm-img-350-205';
            $sizeRetina = 'stm-img-350-205-x-2';
		}

        $img_placeholder = $img = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
		$imgX2 = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
        ?>
        <div class="stm-listing-photos-unit stm-car-photos-<?php echo get_the_id(); ?> <?php echo esc_attr($dynamicClassPhoto); ?>">
                <i class="stm-service-icon-photo"></i>
                <span><?php echo esc_html($car_media['car_photos_count']); ?></span>
        </div>

            <script type="text/javascript">
                jQuery(document).ready(function(){
                    jQuery(".<?php echo esc_attr($dynamicClassPhoto); ?>").on('click', function() {
                        jQuery(this).lightGallery({
                            dynamic: true,
                            dynamicEl: [
                                <?php foreach($car_media['car_photos'] as $car_photo): ?>
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
        <a href="<?php the_permalink() ?>" class="rmv_txt_drctn">
        <img
            data-original="<?php echo esc_url($img[0]); ?>"
            srcset="<?php echo esc_url($img[0]); ?> 1x, <?php echo esc_url($imgX2[0]); ?> 2x"
            src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/images/' . $placeholder_path); ?>"
            class="lazy img-responsive"
            alt="<?php echo stm_get_img_alt(get_post_thumbnail_id(get_the_ID())); ?>"
        />
        </a>

    <?php else: ?>
        <a href="<?php the_permalink() ?>" class="rmv_txt_drctn">

        <img
            src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/images/' . $placeholder_path); ?>"
            class="img-responsive"
            alt="<?php esc_attr_e('Placeholder', 'motors'); ?>"
        />
        </a>

    <?php endif; ?>
	<?php get_template_part('partials/listing-cars/listing-directory', 'badges'); ?>
    <?php if (stm_is_boats()) {
        stm_get_boats_image_hover(get_the_ID()); ?>
        <!--Compare-->
        <?php if (!empty($show_compare) and $show_compare): ?>
            <div
                class="stm-listing-compare stm-compare-directory-new"
                data-id="<?php echo esc_attr(get_the_id()); ?>"
                data-title="<?php echo stm_generate_title_from_slugs(get_the_id(), false); ?>"
                data-toggle="tooltip" data-placement="bottom" title="<?php esc_attr_e('Add to compare', 'motors'); ?>">
				<i class="stm-boats-icon-add-to-compare"></i>
            </div>
        <?php endif;
    } ?>
</div>