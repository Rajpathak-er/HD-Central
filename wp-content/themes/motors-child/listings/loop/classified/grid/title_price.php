<div class="car-meta-top heading-font clearfix 12222">
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
    <div class="car-title 111">
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
        $title =  get_the_title( $model_range )." ";            
        echo wp_trim_words($title,6)." "; 
        $term_obj_list = get_the_terms( get_the_id(), 'ca-year' );
        if ( ! empty( $term_obj_list ) && ! is_wp_error( $term_obj_list ) ) {
            echo $yeardata = $terms_string = join('-', wp_list_pluck($term_obj_list, 'name'))." ";
        }
        ?>

        <?php
        $show_title_two_params_as_labels = get_theme_mod('show_generated_title_as_label', true);
        if($show_title_two_params_as_labels) {
           // echo stm_generate_title_from_slugs(get_the_id(),$show_title_two_params_as_labels);
        } else {
           // echo esc_attr( trim( preg_replace( '/\s+/', ' ', mb_substr( stm_generate_title_from_slugs(get_the_id()), 0, 35 ) ) ) );
            if ( mb_strlen( stm_generate_title_from_slugs(get_the_id()) ) > 35 ) {
              //  echo esc_attr( '...' );
            }
        }

        ?>
    </div>
</div>