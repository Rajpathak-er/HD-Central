<?php 

   // set IP address and API access key 
    $ip = getIp();
    $ip = '2.58.45.2';  
    $access_key = '3cb50795bb67753e994ff1021c467147';  

        // Initialize CURL:
    $ch = curl_init('http://api.ipstack.com/'.$ip.'?access_key='.$access_key.'');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Store the data:
    $json = curl_exec($ch);
    curl_close($ch);         

        // Decode JSON response:
    $api_result = json_decode($json, true);
    
?>


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

    $query = $GLOBALS['wp_query'];

    //echo $query->post_count;
    //die;
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

    <div class="123456 col-md-9 col-sm-12 <?php echo esc_attr($sidebar_pos['content']); ?>">

		<div class="inventory stm-accordion-single-unit stm-listing-directory-checkboxes stm-one_col stm-ajax-checkbox-instant stm-near-me desktop">
		<!--<div class="reset_searchbutton">
			<a class="button" target="" href="<?php echo site_url().'/inventory/';?>">Reset</a>
		</div>-->
		
		
		<?php $filter = stm_listings_filter();

		$query = $GLOBALS['wp_query'];

		//$locationac = 'collapsed';
		//$locationin = '';

		?>
<form action="<?php echo stm_listings_current_url() ?>" method="get" data-trigger="filter">
<!--<div class="topheadingforsidebar">
			<span id="listing_count_total" class="ac-showing ac-total"><?php //echo $query->post_count; ?></span> Bikes for sale
		</div>-->
	
	<!--<div class="filter filter-sidebar ajax-filter">
		<div class="row row-pad-top-24">

				<div class="col-md-12 col-sm-12">
					<div class="clearfix">
						<h4 class="pull-left " style="text-transform: uppercase;">Near me:</h4>
					</div>
				</div>

				<?php //stm_listings_load_template('filter/types/location'); ?>
			</div>	
		</div>-->
	
	<div class="stm-accordion-single-unit stm-listing-directory-checkboxes stm-one_col stm-ajax-checkbox-instant stm-near-me">
		
		
		
		<div class="stm-accordion-content">
			<div class="collapse content <?php //echo $locationin;?>" id="accordion-near-me">
				<div class="stm-accordion-content-wrapper stm-accordion-content-padded">
					<div class="stm-accordion-inner">
						<div class="near_me_content desktop">
							<?php stm_listings_load_template('filter/types/location'); ?>
						</div>
					</div>				
				</div>
			</div>				
		</div>
	</div>

	

		<?php do_action( 'stm_listings_filter_before' ); ?>

		<!--<div class="row row-pad-top-24">-->
		
			<?php foreach ( $filter['filters'] as $attribute => $config ):
					if ( ! empty( $config['slider'] ) && $config['slider'] ):
			?>
				
				<?php
					else: ?>
						<?php if(isset($filter['options'][ $attribute ])) : ?>	
									
						
						<?php endif; ?>
					<?php endif; ?>
				<?php endforeach; ?>


			<!--View type-->
			<input type="hidden" id="stm_view_type" name="view_type"
			value="<?php echo esc_attr( stm_listings_input( 'view_type' ) ); ?>"/>
			<!--Filter links-->
			<input type="hidden" id="stm-filter-links-input" name="stm_filter_link" value=""/>
			<!--Popular-->
			<input type="hidden" name="popular" value="<?php echo esc_attr( stm_listings_input( 'popular' ) ); ?>"/>

			<input type="hidden" name="s" value="<?php echo esc_attr( stm_listings_input( 's' ) ); ?>"/>
			<input type="hidden" name="sort_order" value="<?php echo esc_attr( stm_listings_input( 'sort_order' ) ); ?>"/>

			<div class="sidebar-action-units">
				<input id="stm-classic-filter-submit" class="hidden" type="submit"
				value="<?php _e( 'Show cars', 'motors' ); ?>"/>

				
				</div>

		<?php do_action( 'stm_listings_filter_after' ); ?>
	<!--</div>-->
			
			<script type="text/javascript">
				jQuery(document).ready(function(){
					jQuery('.list_filter_deselect_other').click(function(){
						var dataclass = jQuery(this).data('class');
						jQuery("." + dataclass).prop('checked',false);

						jQuery("." + dataclass).attr('checked', false);
						jQuery("." + dataclass).parent().removeClass('checked');

					});
					jQuery('.chk_filter_removeall').click(function(){
						var dataclass = jQuery(this).data('class');
						jQuery("." + dataclass).prop('checked',false);

						jQuery("." + dataclass).attr('checked', false);
						jQuery("." + dataclass).parent().removeClass('checked');

					});


				}); 
			</script>

		</form>

		<?php stm_listings_load_template('filter/types/links', array('filter' => $filter)); ?>

		<div class="bikeforsalefirstads">
			<?php  echo do_shortcode('[widget id="custom_html-4"]'); ?>
		</div>
		
		
     
	
	</div>


        <div class="stm-ajax-row">
			<!--<div class="topheadingforsidebar">
				<span id="listing_count_total" class="ac-showing ac-total"><?php //echo $query->post_count; ?></span> Bikes for sale
				
				<?php
					/* $view_type = stm_listings_input('view_type', get_theme_mod("listing_view_type", "list"));
					if($view_type == 'list') {
						$view_list = 'active';
						$view_grid = '';
					} else {
						$view_grid = 'active';
						$view_list = '';
					} */
				?>

				<div class="stm-view-by">
					<a href="#" class="view-grid view-type <?php //echo esc_attr($view_grid); ?>" data-view="grid">
						<i class="stm-icon-grid"></i>
					</a>
					<a href="#" class="view-list view-type <?php //echo esc_attr($view_list); ?>" data-view="list">
						<i class="stm-icon-list"></i>
					</a>
				</div>
			</div>-->
		
            <?php //stm_listings_load_template('filter/actions-listing-archive'); ?>
			
			<div id="map" style="height:425px;    margin-top: 18px;display:none;"></div>

            <div id="listings-result">
                <?php stm_listings_load_results(); ?>
            </div>
        </div>

    </div> <!--col-md-9-->
</div>
<?php 
$args1 = array( 'post_type' => 'listings', 'post_status' => 'publish', 'posts_per_page' => 1);
$myposts = get_posts($args1);
$locations = array();	
				
foreach($myposts as $mp){
	$post_id = $mp->ID;
	$url_m = $mp->guid;
	
	$post_title1 = str_replace( '"', '', $mp->post_title);
	$post_title2 = str_replace( "'", '', $post_title1);
	$post_title3 = str_replace( ",", '', $post_title2);
	$post_title4 = str_replace( "/", '', $post_title3);
	$author_url = "$post_title4<br/><a href='$url_m'>View More</a>";
	$location['name'] = $post_title4;								
	$location['address'] = $author_url;
	
	$userlat = get_post_meta($post_id, 'stm_lat_car_admin', true);
	$userlng = get_post_meta($post_id, 'stm_lng_car_admin', true);
	
	
	$repl_lat = str_replace( ',', '', $userlat);
	$location['lat'] = $repl_lat;
	$repl_lng = str_replace( ',', '', $userlng );
	$repl_lng1 = str_replace( 'z', '', $repl_lng );
	$location['lng'] = $repl_lng1;
	
	$locations[] =$location;
}



?>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyChDqc8vz4Q_nj4B-jk1kGm-q0aDztUf4A"></script> 
<script type="text/javascript">
	jQuery(document).ready(function () {
		
		jQuery(".button_for_map").click(function () {
			jQuery("#map").slideToggle();
		});
	});
</script>

<script type="text/javascript">
	var map;
	var Markers = {};
	var infowindow;
	var locations = [
	<?php for($i=0;$i<sizeof($locations);$i++){ $j=$i+1;?>
		[
		"<?php echo $locations[$i]['address'];?>",
		"<?php echo $locations[$i]['name'];?>",
		"<?php echo $locations[$i]['lat'];?>",
		"<?php echo $locations[$i]['lng'];?>",
		0
	]<?php if($j!=sizeof($locations))echo ","; }

	?>
	];
	//console.log(locations.length);
	var origin;
	//if(locations.length == 0){
		origin = {lat:<?php echo round($api_result['latitude'],6); ?>, lng:<?php echo round($api_result['longitude'],6); ?>};
	//}else{
	//	origin =  new google.maps.LatLng(locations[0][2], locations[0][3]);
	//}


	function initialize() {
		var mapOptions = {  
			zoom: 4,
			center: origin
		};

		map = new google.maps.Map(document.getElementById('map'), mapOptions);

		if(locations.length != 0){

			infowindow = new google.maps.InfoWindow({
				maxHeight: 200,
				maxWidth: 200,
			});

			var marker;
			for(i=0; i<locations.length; i++) {
				var position = new google.maps.LatLng(locations[i][2], locations[i][3]);
				marker = new google.maps.Marker({
					position: position,
					map: map,
					//icon:'https://hd-central.com/wp-content/uploads/2020/07/kisspng-schaeffers-harley-davidson-logo-font-clip-art-art-days-679-free-vectors-logos-icons-and-ph-5c429bb24c2cf9.373035961547869106312.png',
				});

				google.maps.event.addListener(marker, 'click', (function(marker, i) {
					return function() {
						infowindow.setContent(locations[i][0]);
						infowindow.setOptions({maxWidth: 200}); 			
						infowindow.open(map, marker);  
						for (var k = 0; k < marker.length; k++) {
							infowindow[k].close();
						}

					}
				}) (marker, i));
				Markers[locations[i][4]] = marker;
			}
			locate(0);
		}
	}

	function locate(marker_id) {
		var myMarker = Markers[marker_id];
		var markerPosition = myMarker.getPosition();
		//map.setCenter(markerPosition);
        //google.maps.event.trigger(myMarker, 'click');
    }

    google.maps.event.addDomListener(window, 'load', initialize);

</script>