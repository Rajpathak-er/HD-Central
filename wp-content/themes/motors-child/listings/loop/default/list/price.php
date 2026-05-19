<?php
// Price
$regular_price_label = get_post_meta(get_the_ID(), 'regular_price_label', true);
$special_price_label = get_post_meta(get_the_ID(), 'special_price_label', true);
$ONO = get_post_meta(get_the_ID(), 'ONO', true);

$price = get_post_meta(get_the_id(), 'price', true);
$sale_price = get_post_meta(get_the_id(), 'sale_price', true);

$currency_id = get_post_meta(get_the_id(), 'currency_id', true);

if(empty($price) and !empty($sale_price)) {
	$price = $sale_price;
}

$car_price_form_label = get_post_meta(get_the_ID(), 'car_price_form_label', true);

if(empty($car_price_form_label)){
	if(!empty($price) and !empty($sale_price) and $price != $sale_price):?>
		<div class="price discounted-price">
			<div class="regular-price">
				<?php if(!empty($regular_price_label)): ?>
					<span class="label-price"><?php echo esc_attr($regular_price_label); ?></span>
				<?php endif; ?>
				
				<?php if( $currency_id && !empty($currency_id) ){ ?>
					<?php echo get_currency_symbol($currency_id).number_format($price,"0","",""); ?>
				<?php }else{ ?>
					<?php echo esc_attr(stm_listing_price_view($price)); ?>
				<?php } ?>	
			</div>

			<div class="sale-price">
				<?php if(!empty($special_price_label)): ?>
					<span class="label-price"><?php echo esc_attr($special_price_label); ?></span>
				<?php endif; ?>
				
				<?php if( $currency_id && !empty($currency_id) ){ ?>
					<span class="heading-font"><?php echo get_currency_symbol($currency_id).number_format($sale_price,"0","",""); ?></span>
				<?php }else{ ?>
					<span class="heading-font"><?php echo esc_attr(stm_listing_price_view($sale_price)); ?></span>
				<?php } ?>	
			</div>
		</div>
	<?php elseif(!empty($price)): ?>
		<div class="price">
			<div class="normal-price">
				<?php if(!empty($regular_price_label)): ?>
					<span class="label-price"><?php echo esc_attr($regular_price_label); ?></span>
				<?php endif; ?>
				
				<?php if( $currency_id && !empty($currency_id) ){ ?>
					<span class="heading-font"><?php echo get_currency_symbol($currency_id).number_format($price,"0","",""); ?></span> <?php echo $ONO; ?>
				<?php }else{ ?>
					<span class="heading-font"><?php echo esc_attr(stm_listing_price_view($price)); ?></span> <?php echo $ONO; ?>
				<?php } ?>
			</div>
		</div>
	<?php endif; ?>
<?php } else { ?>
	<div class="price">
        <a href="#" class="rmv_txt_drctn archive_request_price" data-toggle="modal" data-target="#get-car-price" data-title="<?php echo esc_html(get_the_title(get_the_ID())); ?>" data-id="<?php echo get_the_ID(); ?>">
		    <span class="heading-font price-form-label"><?php echo esc_attr($car_price_form_label); ?></span> 
        </a>
	</div>
<?php } ?>