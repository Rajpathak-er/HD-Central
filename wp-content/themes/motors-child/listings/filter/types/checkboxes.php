<?php
$checkboxes = stm_get_car_filter_checkboxes();

$selected_options = array();

if (!empty($checkboxes)) {
    foreach ($checkboxes as $checkbox) {
		
		$mod_nm = $checkbox['single_name'];
		//if($mod_nm!="Region") {
	    $listing_rows_numbers_default_expanded = 'false';
	    if(isset($checkbox['listing_rows_numbers_default_expanded']) AND $checkbox['listing_rows_numbers_default_expanded'] == 'open'){
		    $listing_rows_numbers_default_expanded = 'true';
	    }

        if (!empty($_GET[$checkbox['slug']])) {
            $selected_options = sanitize_text_field($_GET[$checkbox['slug']]);
            if (!is_array($selected_options)) {
                $selected_options = array('0' => $selected_options);
            }
        }

        if (!empty($checkbox['enable_checkbox_button']) and $checkbox['enable_checkbox_button'] == 1) {
            $stm_checkbox_ajax_button = 'stm-ajax-checkbox-button';
        } else {
            $stm_checkbox_ajax_button = 'stm-ajax-checkbox-instant';
        }
        ?>

        <?php
        $termsdata  = get_terms_by_post_type(array($checkbox['slug']),array('listings'));
        $termidarray = array();
        foreach ($termsdata as $key => $singleterms) {
            # code...
            $termidarray[] =  $singleterms->term_id;
        }
        
        $terms_args = array(
            'orderby' => 'name',
            'order' => 'ASC',
            'hide_empty' => false,
            'fields' => 'all',
            'pad_counts' => false,
            'include' => $termidarray
        );
        ?>
        <div
            class="grid-check stm-accordion-single-unit stm-listing-directory-checkboxes stm-<?php echo esc_attr($checkbox['listing_rows_numbers'] . ' ' . $stm_checkbox_ajax_button) ?> stm-<?php echo $checkbox['slug']; ?>">
			
		   <a class="<?php echo $mod_nm; ?> title <?php echo (esc_attr($listing_rows_numbers_default_expanded) == 'false') ? 'collapsed':''?> " data-toggle="collapse" href="#accordion-<?php echo esc_attr($checkbox['slug']); ?>"
	            aria-expanded="<?php echo esc_attr($listing_rows_numbers_default_expanded); ?>">
                
                <h5>
                <?php if($mod_nm=="Model") { ?>
                   <div class="imginv-icon"><img src="<?php echo get_home_url(); ?>/wp-content/uploads/2021/09/harley-icon-bike-for-sale-sidevar.png" class="model" ></div>
                <?php } ?>
                <?php if($mod_nm=="Model Range") { ?>
                    <div class="imginv-icon"><img src="<?php echo get_home_url(); ?>/wp-content/uploads/2021/09/preferences-2.png" class="model_range"></div>
                <?php } ?>
                <?php if($mod_nm=="Year") { ?>
                    <div class="imginv-icon"><img src="<?php echo get_home_url(); ?>/wp-content/uploads/2021/09/Vector-13.png" class="year"></div>
                <?php } ?>
                <?php if($mod_nm=="Condition") { ?>
                    <div class="imginv-icon"><img src="<?php echo get_home_url(); ?>/wp-content/uploads/2021/09/Vector-14.png" class="condition"></div>
                <?php } ?>
                <?php if($mod_nm=="Region") { ?>
                    <div class="imginv-icon"><i class="far fa-flag region"></i></div>
                <?php } ?>
                <?php if($mod_nm=="Seller") { ?>
                    <div class="imginv-icon"><img src="<?php echo get_home_url(); ?>/wp-content/uploads/2021/09/best-product-1.png" class="seller"></div>
                <?php } ?>
                 <?php esc_html_e($checkbox['single_name'], 'motors'); ?>
                </h5>
                <span class="minus"></span>
            </a>
            <div class="stm-accordion-content">
                <div class="collapse content <?php echo (esc_attr($listing_rows_numbers_default_expanded) == 'true') ? 'in':''?>" id="accordion-<?php echo esc_attr($checkbox['slug']); ?>">
                    <div class="stm-accordion-content-wrapper stm-accordion-content-padded">
                        <div class="stm-accordion-inner">
                            <label class="stm-option-label">
                                        <input type="checkbox" class="list_filter_deselect_other chk_all_filter_<?php echo $checkbox['slug']; ?>" data-class="chk_filter_<?php echo $checkbox['slug']; ?>" name="<?php echo esc_attr($checkbox['slug']) ?>[]"
                                               value=""
                                               />
                                        <span>All</span>
                            <?php
                            $terms = get_terms($checkbox['slug'], $terms_args);

                            if (!empty($terms)) {
                                foreach ($terms as $term) {
                                    $image = get_term_meta($term->term_id, 'stm_image', true);
                                    if (!empty($image)): ?>
                                        <label class="stm-option-label">
                                        <?php
                                        $image = wp_get_attachment_image_src($image, 'stm-img-190-132');
                                        $category_image = $image[0];
                                        ?>
                                        <div class="stm-option-image">
                                            <img src="<?php echo esc_url($category_image); ?>"/>
                                        </div>
                                        <input type="checkbox" class="<?php echo $checkbox['slug']; ?>" name="<?php echo esc_attr($checkbox['slug']) ?>[]"
                                               value="<?php echo esc_attr($term->slug); ?>"
                                               <?php if (in_array($term->slug, $selected_options)): ?>checked<?php endif; ?>/>
                                        <span><?php echo esc_attr($term->name); ?></span>
                                    <?php endif; ?>
                                    </label>
                                <?php }
                                foreach ($terms as $term) {
                                    $image = get_term_meta($term->term_id, 'stm_image', true);
                                    if (empty($image)): ?>
                                        <label class="stm-option-label">
                                        <input type="checkbox" class="chk_filter_removeall chk_filter_<?php echo $checkbox['slug']; ?>" data-class="chk_all_filter_<?php echo $checkbox['slug']; ?>"  name="<?php echo esc_attr($checkbox['slug']) ?>[]"
                                               value="<?php echo esc_attr($term->slug); ?>"
                                               <?php if (in_array($term->slug, $selected_options)): ?>checked<?php endif; ?>/>
                                        <span><?php echo esc_attr($term->name); ?></span>
                                    <?php endif; ?>
                                    </label>
                                <?php }
                            }

                            if (!empty($checkbox['enable_checkbox_button']) and $checkbox['enable_checkbox_button'] == 1): ?>
                                <div class="clearfix"></div>
                                <div class="stm-checkbox-submit">
                                    <a class="button" href="#"><?php echo esc_html_e('Apply', 'motors'); ?></a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<?php //} ?>
    <?php }
}