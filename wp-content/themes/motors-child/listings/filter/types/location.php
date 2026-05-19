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
	<div class="col-md-12 col-sm-12">

						<h5 class="pull-left" style="display: none;">Postcode:</h5>
		<div class="form-group boats-location bgbg">
			<div class="stm-location-search-unit" >
				<?php echo do_shortcode('[wd_asp id=14]'); ?>
			</div>
			<!--<div class="stm-location-search-unit">
				<select><option>Country Search</option></select>
			</div>-->
			<?php
				$view_type = stm_listings_input('view_type', get_theme_mod("listing_view_type", "list"));
				if($view_type == 'list') {
					$view_list = 'active';
					$view_grid = '';
				} else {
					$view_grid = 'active';
					$view_list = '';
				}
			?>

				<div class="stm-view-by">
					<a href="#" class="view-grid view-type <?php echo esc_attr($view_grid); ?>" data-view="grid">
						<i class="stm-icon-grid"></i>
					</a>
					<a href="#" class="view-list view-type <?php echo esc_attr($view_list); ?>" data-view="list">
						<i class="stm-icon-list"></i>
					</a>
				</div>
				<div class="map_view_inventory"><a class="heading-font button_for_map" href="javascript:void(0);"><img src="<?php echo get_home_url(); ?>/wp-content/uploads/2021/09/maps-and-flags-1.png" class="map-icon"> MapView</a></div>
				<?php //stm_listings_load_template('filter/actions-listing-archive'); ?>
			
            
		</div>
	</div>
	<div class="col-md-12 col-sm-12" style="display: none;">

						<h5 class="pull-left">Distance:</h5>
	
    <?php if ( (stm_enable_location() and is_listing()) or ( stm_enable_location() && stm_is_boats()) or ( stm_enable_location() && stm_is_car_dealer()) ) {
        stm_listings_load_template('filter/types/select', array(
            'taxonomy' => array("slug" => "search_radius", "name" => "max_search_radius", "single_name" => esc_html__("Distance:", 'motors')),
            'options' => $radiusArr,
			'name' => 'max_search_radius'
        ));
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

