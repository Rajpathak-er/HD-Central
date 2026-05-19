<div class="row">

    <?php
    $sidebar_pos = stm_get_sidebar_position();
    $sidebar_id = get_theme_mod('listing_sidebar', 'default');
    if( !empty($sidebar_id) ) {
        $blog_sidebar = get_post( $sidebar_id );
    }

    if(!is_numeric($sidebar_id) && ($sidebar_id == 'no_sidebar' || !is_active_sidebar($sidebar_id))) {
        $sidebar_id = false;
    }

    if(is_numeric($sidebar_id) && empty($blog_sidebar->post_content)) {
        $sidebar_id = false;
    }
    ?>

    <div class="col-md-3 col-sm-12 classic-filter-row sidebar-sm-mg-bt <?php echo esc_attr($sidebar_pos['sidebar']); ?>">
        <?php stm_listings_load_template('filter/sidebar'); ?>
        <!--Sidebar-->
        <div class="stm-inventory-sidebar">
            <?php
            if($sidebar_id == 'default') {
                get_sidebar();
            } else if(!empty($sidebar_id)) {
                echo apply_filters( 'the_content' , $blog_sidebar->post_content);
            ?>
                <style type="text/css">
                    <?php echo get_post_meta( $sidebar_id, '_wpb_shortcodes_custom_css', true ); ?>
                </style>
            <?php }
            ?>
        </div>
    </div>

    <div class="12345 555 col-md-9 col-sm-12 <?php echo esc_attr($sidebar_pos['content']); ?>">
		<div class="stm-accordion-single-unit stm-listing-directory-checkboxes stm-one_col stm-ajax-checkbox-instant stm-near-me">
		<div class="reset_searchbutton">
			<a class="button" target="" href="<?php echo site_url().'/inventory/';?>">Reset</a>
		</div>
		<a class="title collapsed <?php //echo $locationac; ?>" data-toggle="collapse" href="#accordion-near-me" aria-expanded="false">
			<h5>Near me</h5>
			<span class="minus"></span>
		</a>
		
		<div class="stm-accordion-content">
			<div class="collapse content <?php //echo $locationin;?>" id="accordion-near-me">
				<div class="stm-accordion-content-wrapper stm-accordion-content-padded">
					<div class="stm-accordion-inner">
						<div class="near_me_content">
							<?php stm_listings_load_template('filter/types/location'); ?>
						</div>
					</div>				
				</div>
			</div>				
		</div>
	</div>
        <div class="stm-ajax-row">
            <?php stm_listings_load_template('filter/actions'); ?>

            <div id="listings-result">
                <?php stm_listings_load_results(); ?>
            </div>
        </div>

    </div> <!--col-md-9-->
</div>