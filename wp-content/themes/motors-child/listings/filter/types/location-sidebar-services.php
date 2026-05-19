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


$radiusArr['20000000'] = array('label' => 'Any Distance','selected' => '', 'disabled' => '');
$radiusArr['1'] = array('label' => 'Within 1 mile','selected' => '', 'disabled' => '');
$radiusArr['3'] = array('label' => 'Within 3 miles','selected' => '', 'disabled' => '');
$radiusArr['5'] = array('label' => 'Within 5 miles','selected' => '', 'disabled' => '');
$radiusArr['10'] = array('label' => 'Within 10 miles','selected' => '', 'disabled' => '');
$radiusArr['20'] = array('label' => 'Within 20 miles','selected' => '', 'disabled' => '');
$radiusArr['30'] = array('label' => 'Within 30 miles','selected' => '', 'disabled' => '');
$radiusArr['40'] = array('label' => 'Within 40 miles','selected' => '', 'disabled' => '');
$radiusArr['50'] = array('label' => 'Within 50 miles','selected' => '', 'disabled' => '');
$radiusArr['100'] = array('label' => 'Within 100 miles','selected' => '', 'disabled' => '');

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
				<input type="hidden" name="stm_lat" id="stm_lat"
				       value="<?php echo esc_attr( floatval( $stm_lat ) ); ?>">
				<input type="hidden" name="stm_lng" id="stm_lng"
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


<div class="restofworld">
    
                                                      <label class="stm-option-label" style="display: block;">
                                <input type="checkbox" <?php if(empty($_REQUEST['ca_location']) && ($_REQUEST['all_location'] == '1' || $_REQUEST['ca_location_clean'] == 1))  { echo "checked='checked'";}?> class=""  id="all_over_world" name="ca_location_clean"  onchange="cleanlocation()"
                                value="1"  />
                                <span style="color:black;"> All Countries and Regions</span>
                            </label>
                        </div>
</div>

<script>


function updateQueryStringParameter(uri, key, value) {
	  var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
	  var separator = uri.indexOf('?') !== -1 ? "&" : "?";
	  if (uri.match(re)) {
	    return uri.replace(re, '$1' + key + "=" + value + '$2');
	  }
	  else {
	    return uri + separator + key + "=" + value;
	  }
}

	if (jQuery(window).width() < 767) {
		jQuery(".stm-near-me.desktop").html('');
	}
	else {
		jQuery(".mob_sidebar_inventory.mobile").html('');
		
	}
	function cleanlocation(){
		jQuery("#ca_location_listing_filter").val("");
		
		jQuery("#stm_lat").val("");
		jQuery("#stm_lng").val("");
		var newurl = updateQueryStringParameter(document.location.href,"ca_location","");	
		newurl = updateQueryStringParameter(newurl,"stm_lat","");	
		newurl = updateQueryStringParameter(newurl,"stm_lng","");	
		if(jQuery("#all_over_world").prop('checked') == true){
			newurl=	updateQueryStringParameter(newurl,"all_location",1);	
		}else{
			newurl =	updateQueryStringParameter(newurl,"all_location",0);	
		}
		document.location.href = newurl;
		
		//ca_location
		//jQuery("#service_category_form").submit();	
	}
</script>

<?php endif; ?>

