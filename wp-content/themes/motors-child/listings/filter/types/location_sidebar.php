<!--Location inputs-->
<?php

$stm_lat = $stm_lng = $stm_location = '';
if ( isset( $_GET['ca_location'] ) ) {
	$stm_location = sanitize_text_field($_GET['ca_location']);
}
if ( isset( $_GET['stm_lng'] ) ) {
	$stm_lng = sanitize_text_field($_GET['stm_lng']);
}
if ( isset( $_GET['stm_lat'] ) ) {
	$stm_lat = sanitize_text_field($_GET['stm_lat']);
}
$radius = (!empty(get_theme_mod("distance_search", ""))) ? get_theme_mod('distance_search', '') : 100;

$radiusArr = array();
//for($q=1;$q<=$radius;$q++) {
//    $radiusArr[$q] = array("label" => $q);
//}


$radiusArr[''] = array('label' => 'Any Distance','selected' => '', 'disabled' => '');
$radiusArr['1'] = array('label' => 'Within 1 mile','selected' => '', 'disabled' => '');
$radiusArr['3'] = array('label' => 'Within 3 miles','selected' => '', 'disabled' => '');
$radiusArr['5'] = array('label' => 'Within 5 miles','selected' => '', 'disabled' => '');
$radiusArr['10'] = array('label' => 'Within 10 miles','selected' => '', 'disabled' => '');
$radiusArr['20'] = array('label' => 'Within 20 miles','selected' => '', 'disabled' => '');
$radiusArr['30'] = array('label' => 'Within 30 miles','selected' => '', 'disabled' => '');
$radiusArr['50'] = array('label' => 'Within 40 miles','selected' => '', 'disabled' => '');
$radiusArr['100'] = array('label' => 'Within 50 miles','selected' => '', 'disabled' => '');
$radiusArr['200'] = array('label' => 'Within 100 miles','selected' => '', 'disabled' => '');

?>

<?php
$allregion = get_terms( array(
		'taxonomy' => 'region',
		'hide_empty' => false,
	) );
?>

<?php if ( (stm_enable_location() and is_listing()) or ( stm_enable_location() && stm_is_boats()) or ( stm_enable_location() && stm_is_car_dealer()) ): ?>
	<div class="col-md-12 col-sm-6 stm-filter_location_search">
		<div class="form-group">
			<div class="stm-location-search-unit">
					<h5 class="pull-left">Near me / Country / City</h5>
					
				<input type="text" id="ca_location_listing_filter"
				       class="443 stm_listing_search_location" placeholder="Enter Postcode/Address" data-palce="gdfdg" name="ca_location"
				       value="<?php echo esc_attr( $stm_location ); ?>"/>
				<input type="hidden" name="stm_lat"
				       value="<?php echo esc_attr( floatval( $stm_lat ) ); ?>">
				<input type="hidden" name="stm_lng"
				       value="<?php echo esc_attr( floatval( $stm_lng ) ); ?>">
			</div>
		</div>
	</div>
	<div class="col-md-12 col-sm-6 stm-filter_radius">

						<h5 class="pull-left">Search Radius:</h5>
	
    <?php if ( (stm_enable_location() and is_listing()) or ( stm_enable_location() && stm_is_boats()) or ( stm_enable_location() && stm_is_car_dealer()) ) {
		
		stm_listings_load_template(
							'filter/types/select',
							array(
								'taxonomy' => array("slug" => "search_radius", "name" => "max_search_radius", "single_name" => esc_html__("Distance:", 'motors')),
								'options' => $radiusArr,
								'name' => 'max_search_radius'
							)
						);
		
    }
    ?>
    
</div>

<script>
	if (jQuery(window).width() < 767) {
		jQuery(".stm-near-me.desktop").html('');
	}
	else {
		jQuery(".mob_sidebar_inventory.mobile").html('');
		
	}
</script>

<?php endif; ?>

