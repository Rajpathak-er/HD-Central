<div class="stm-form-2-features clearfix">
	<div class="stm-car-listing-data-single stm-border-top-unit stm-step-title">
		<div class="title heading-font"><span class="step_number step_number_1 heading-font"><?php esc_html_e( 'Step', 'motors' ); ?> 3</span><?php esc_html_e('- Add Custom Features', 'motors'); ?></div>
		
	</div>
<div class="Features_container_add_bike">
    <?php 
    //print_r($items);
    $newitems  = array();
    $newitemsheader = array('Body Work');
    foreach ($items as $key => $item) {
    	if(in_array($item['tab_title_single'],$newitemsheader)){
    		$newitems[] = $item;
    		unset($items[$key]); 
    	}
    }

    stm_listings_load_template('add_car/step_2_items', array('items' => $items, 'id' => $id)); 
?>


<?php
    stm_listings_load_template('add_car/step_2_items', array('items' => $newitems, 'id' => $id)); 
    ?>
    <div class="clearfix">

    </div>
</div>
</div>