<?php
if(stm_is_dealer_two()) {
	$sellOnline = get_theme_mod( 'enable_woo_online', false );
	$isSellOnline = ( $sellOnline ) ? !empty( get_post_meta( get_the_ID(), 'car_mark_woo_online', true ) ) : false;
}
?>
<div class="car-meta-top heading-font clearfix">
    <div class="car-title 44444 dealer_sin_page"><a href="<?php echo get_the_permalink();?>">
        <?php 
        $term_obj_list = get_the_terms( get_the_id(), 'make' );
        if ( ! empty( $term_obj_list ) && ! is_wp_error( $term_obj_list ) ) {
            $modelname = $terms_string = join(', ', wp_list_pluck($term_obj_list, 'name'))." ";
        }
                // $term_obj_list = get_the_terms( get_the_id(), 'serie' );
                // if ( ! empty( $term_obj_list ) && ! is_wp_error( $term_obj_list ) ) {
                    // echo $terms_string = join(', ', wp_list_pluck($term_obj_list, 'name'))." ";
                // }            
        $model_range = get_post_meta(get_the_id(), 'model_range', true);
        if( empty($model_range) || $model_range == "" ){
            $model_range = get_post_meta(get_the_id(), 'serie', true);
        }
        //var_dump($model_range);           
        $title =  get_the_title( $model_range );   
        //var_dump($title);         
        if(empty($title)){
            $title = get_the_title(get_the_id());
        }
https://www.hd-central.com/listings/used-2014-harley-davidson-touring-motorcycle/
        echo wp_trim_words($title,3)." "; 
        $term_obj_list = get_the_terms( get_the_id(), 'ca-year' );
        if ( ! empty( $term_obj_list ) && ! is_wp_error( $term_obj_list ) ) {
            echo $yeardata = " ".$terms_string = join('-', wp_list_pluck($term_obj_list, 'name'))." ";
        }
        ?>

        <?php
        if(!stm_is_listing_three()) {
        //    echo esc_attr(trim(preg_replace('/\s+/', ' ', mb_substr(stm_generate_title_from_slugs(get_the_id()), 0, 35))));
        } else {
          //  echo trim(stm_generate_title_from_slugs(get_the_id(), true));
        }
        ?>
        <?php if(strlen(stm_generate_title_from_slugs(get_the_id())) > 35){
            //echo esc_attr('...');
        } ?></a>
    </div>
	<?php if(stm_is_dealer_two() && $isSellOnline):?>
		<?php
		if(!empty($sale_price)) {
			$price = $sale_price;
		};
		?>
        <div class="sell-online-wrap price">
            <div class="normal-price">
                <span class="normal_font"><?php echo esc_html__('BUY ONLINE', 'motors'); ?></span>
                <span class="heading-font"><?php echo esc_attr(stm_listing_price_view($price)); ?></span>
            </div>
        </div>
	<?php else : ?>
        <?php if(empty($car_price_form_label)): ?>
            <?php if(!empty($price) and !empty($sale_price) and $price != $sale_price):?>
                <div class="price discounted-price">
                    <div class="regular-price"><?php echo esc_attr(stm_listing_price_view($price)); ?></div>
                    <div class="sale-price"><?php echo esc_attr(stm_listing_price_view($sale_price)); ?></div>
                </div>
            <?php elseif(!empty($price)): ?>
                <div class="price">
                    <div class="normal-price"><?php echo esc_attr(stm_listing_price_view($price)); ?></div>
                </div>
            <?php endif; ?>
        <?php else: ?>
            <div class="price">
                <div class="normal-price"><?php echo esc_attr($car_price_form_label); ?></div>
            </div>
        <?php endif; ?>
    <?php endif; ?>
	

    
</div>