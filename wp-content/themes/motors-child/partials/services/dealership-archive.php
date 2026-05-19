<div class="row">

	<?php
	
	//print_r($_SESSION);
	
	// function getIP(){
		// if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			// $ip = $_SERVER['HTTP_CLIENT_IP'];
		// } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			// $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		// } else {
			// $ip = $_SERVER['REMOTE_ADDR'];
		// }
		// return $ip;  
	// }

		// set IP address and API access key 
	$ip = getIp();  
	//$ip = '2.58.45.2';  
	 $api_result = '';

    if ( false === ( $api_result = get_transient( 'IP_'.$ip ) ) ) {
    // this code runs when there is no valid transient set
    	//	echo "API called";



	   // $ip = '2.58.45.2';  
	    $access_key = 'cd7730575c2f30aa0da956bb7a3d9912';  

	        // Initialize CURL:
	    $ch = curl_init('http://api.ipstack.com/'.$ip.'?access_key='.$access_key.'');
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	        // Store the data:
	    $json = curl_exec($ch);
	    curl_close($ch);         

	        // Decode JSON response:
	    $api_result = json_decode($json, true);
	    set_transient( 'IP_'.$ip, $api_result, YEAR_IN_SECONDS );
	}

	$_SESSION['country'] = $api_result['country_code'];

		// Output the "capital" object inside "location"
		//print_r($api_result);


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


	$allservice = array();

	$allservice['mot'] = "MOT";
	$allservice['service_and_repairs'] = "Service and Repairs";
	$allservice['custom_parts_fitting'] = "Custom Parts Fitting";
	$allservice['vehicle_recovery'] = "Vehicle Recovery";
	$allservice['valet_service'] = "Valet Service";
	$allservice['bike_transporting_service'] = "Bike Transporting Service";
	$allservice['custom_fabrication'] = "Custom Fabrication";
	$allservice['custom_paint_service'] = "Custom Paint Service";
	$allservice['valet_service'] = "Valet Service";
	$allservice['bike_recovery_service'] = "Bike Recovery Service";
                                       // $allservice['custom_fabrication'] = "Custom Fabrication";
	$allservice['electrical'] = "Electrical";
	$allservice['tyre_fitting'] = "Tyre Fitting";
	$allservice['tyre_sales'] = "Tyre Sales";
	$allservice['custom_seats_n_upholstery'] = "Seats & Upholstery";
	$allservice['mobile_mechanic'] = "Mobile Mechanic";
	$allservice['accident_legal_advice'] = "Accident Legal Advice";
	$allservice['riding_lessons'] = "Riding Lessons";
	$allservice['stripped_bolt_removal'] = "Stripped bolt removal";
	$allservice['harley-davidson_rentals'] = "Harley - Davidson Rentals";

	
	$allregion = get_terms( array(
		'taxonomy' => 'region',
		'hide_empty' => false,
	) );

	//print_r($allregion);

	//$rest = '0';
	$rest1 = '1';
	if( !empty($_GET['region_category'])){
		$rest = '1';
		$rest1 = '0';
	}
	
	$first = 'collapsed';
	$second = '';
	
	$dealeracc = 'collapsed';
	$locationac = 'collapsed';
	$locationin = '';
	$dealeracc2 = '';
	if( !empty($_GET['mainaccordian']) && ($_GET['mainaccordian'] == '1') && ( !empty($_GET['region_category']))){
		$first = '';
		$second = 'in';
	}
	if( (!empty($_GET['currentaccordian']) && ($_GET['currentaccordian'] == '1') ) || (!$_GET)  ){
		$dealeracc = '';
		$dealeracc2 = 'in';
	}	
	if( !empty($_GET['ca_location'])  || (!$_GET)  ){
			$locationac = '';
			$locationin = 'in';
		}
	?>

	<div class="col-md-3 col-sm-12 classic-filter-row sidebar-sm-mg-bt <?php echo esc_attr($sidebar_pos['sidebar']); ?>" style="margin-top: -20px;">
		<?php //stm_listings_load_template('filter/sidebar'); ?>
		<!--Sidebar-->
		<div class="stm-inventory-sidebar dealerships-sidebar 56">

			<form  method="get" action="/dealerships/" id="dealerships" class="dealerships">

				<div class="stm-accordion-single-unit stm-listing-directory-checkboxes stm-one_col stm-ajax-checkbox-instant">
					<a class="title <?php echo $dealeracc; ?>" data-toggle="collapse" href="#accordion-dealerships" aria-expanded="false">
						<h5>Harley Davidson Dealership in your Country</h5>
						<span class="minus"></span>
					</a>
					<div class="stm-accordion-content">
						<div class="collapse <?php echo $dealeracc2; ?> content" id="accordion-dealerships">
							<div class="stm-accordion-content-wrapper stm-accordion-content-padded">
								<div class="stm-accordion-inner">
									<div class="tree_main">
										<ul id="bs_main" class="main_ul">
											<?php 
											$currentregion = get_terms( array(
												'taxonomy' => 'region',
												'name'    => array( $api_result['country_code']),
												'hide_empty' => false,
											) );
											foreach($currentregion as $key => $cregion) {		

												$parent= $cregion->term_id;
												$name = $cregion->name;
												$region = $api_result['region_name'];
												if($cregion->parent != 0){
													$parent= $cregion->parent;	
													$subtermsn = get_term( $parent,'region');					
																//print_r($subtermsn);
													$name = $subtermsn->name;
													$region = $api_result['country_code'];

												}
												$_SESSION['country'] = $region;
															//echo $region;

												$checked = '';
												if( !empty($_GET['region_category']) && in_array($cregion->name, $_GET['region_category']) ){ 
													$checked = " checked=checked "; }	
													elseif(empty($_GET['region_category']) &&  ($cregion->name == $region)){
														$checked = " checked=checked ";
													}

													?>  								

													<li id="bs_1">										
														<span class="font-weight-bold"><?php echo $name; ?></span>


														<?php /* ?><ul id="bs_l_1" class="sub_ul" style="">  

															<?php           
															$subterms = get_terms( array( 
																'taxonomy' => 'region',
																'parent'   => $parent,
																'hide_empty'=> false
															) );

															foreach($subterms as $key => $subregion) { 

																if( !empty($_GET['region_category']) && in_array($subregion->name, $_GET['region_category']) && (!isset($_REQUEST['ca_location'])) ){ 															
																	$subchecked = " checked=checked "; }													
																	elseif( empty($_GET['region_category']) && ($subregion->name == $region) && (!isset($_REQUEST['ca_location'])) ){
																		$subchecked = " checked=checked ";	
																	}elseif( !$_GET && $name == "United Kingdom" ){
																		$subchecked = " checked=checked ";
																	}else{
																		$subchecked = '';

																	}

																	?>


																	<li id="bf_1">							
																		<input type="checkbox" class="chk_filter_removeall chk_filter_condition" data-class="chk_all_filter_condition"  name="region_category[]" value="<?php echo $subregion->name; ?>" <?php echo $subchecked;  ?> />
																		<span><?php echo $subregion->name;?></span>

																	</li>
																<?php } ?>
															</ul><?php */ ?>
															
														</li>

													<?php } ?>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<input type="hidden" class="currentaccordian" name="currentaccordian" value="<?php echo $rest1; ?>">
					</form>


					<div class="stm-accordion-single-unit stm-listing-directory-checkboxes stm-one_col stm-ajax-checkbox-instant find-dealership">
						<a class="title <?php echo $locationac; ?>" data-toggle="collapse" href="#accordion-dealerships-search" aria-expanded="false">
							<h5>HD Dealership Near You</h5>
							<span class="minus"></span>
						</a>
						<div class="stm-accordion-content">
							<div class="collapse content <?php echo $locationin;?>" id="accordion-dealerships-search">
								<div class="stm-accordion-content-wrapper stm-accordion-content-padded">
									<div class="stm-accordion-inner">
										<form  method="get" action="/dealerships/" id="dealershipslocation" class="dealershipslocation">

											<!--Location inputs-->


											
												<div class="form-group boats-location">
													<div class="stm-location-search-unit">
														<input type="text" id="ca_location_listing_filter" class="stm_listing_search_location empty pac-target-input" placeholder="Location / Post Code / City" data-palce="gdfdg" name="ca_location" value="<?php echo $_REQUEST['ca_location'];?>" autocomplete="off">
														<input type="hidden" name="stm_lat" value="<?php echo $_REQUEST['stm_lat'];?>">
														<input type="hidden" name="stm_lng" value="<?php echo $_REQUEST['stm_lng'];?>">
													</div>
												</div>
											
											<div class="col-md-12 col-sm-12" style="display:none;">

												<h5 class="pull-left">Distance:</h5>

												<select name="stm_distance" class="form-control select2-hidden-accessible" tabindex="-1" aria-hidden="true">
													<option
													value=""  <?php if(!empty($_GET['stm_distance']) && $_GET['stm_distance'] == '') { echo " selected=selected "; }?> >Any Distance</option>
													<option
													value="20"  <?php if(!empty($_GET['stm_distance']) && $_GET['stm_distance'] == '20') { echo " selected=selected "; }?>>
												Within 20 miles            </option>
												<option
												value="30" <?php if(!empty($_GET['stm_distance']) && $_GET['stm_distance'] == '30') { echo " selected=selected "; }?> >
											Within 30 miles            </option>
											<option
											value="50"  <?php if(!empty($_GET['stm_distance']) && $_GET['stm_distance'] == '50') { echo " selected=selected "; }?>>
										Within 50 miles            </option>
										<option
										value="100"  <?php if(!empty($_GET['stm_distance']) && $_GET['stm_distance'] == '100') { echo " selected=selected "; }?>>
									Within 100 miles            </option>
									<option
									value="200" <?php if(!empty($_GET['stm_distance']) && $_GET['stm_distance'] == '200') { echo " selected=selected "; }?> >
								Within 200 miles            </option>
							</select>


						</div>

						<div class="col-md-12 col-sm-12" style="display:none;">
							<div class="clearfix">
								<h4 class="pull-left " style="text-transform: uppercase;">Search by Keywords</h4>
							</div>
						</div>
						</form>		

						<div class="col-md-12 col-sm-12" style="display:none;">

							<form  method="get" action="/dealerships/" id="dealershipskeywords" class="dealershipskeywords">
								<div class="form-group boats-keywords">
									<div class="stm-keywords-search-unit">
										<input type="text" id="ca_keywords_listing_filter" class="empty pac-target-input" placeholder="Enter Keyword" data-palce="gdfdg" name="ca_keywords" value="<?php echo $_REQUEST['ca_keywords'];?>" autocomplete="off">

									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>


		<div class="filter filter-sidebar ajax-filter" style="display: none;">
			<div class="row row-pad-top-24">



				<div class="col-md-12 col-sm-12">

				</div>

				<div class="col-md-12 col-sm-12 col-xs-12 stm-select-col row-pad-top-24" style="display:none;">
					<h5 class="pull-left">Service Categories:</h5>
					<div class="stm-keyword-search-unit" style="clear: both;">
						<?php  foreach($allservice as $key => $service) {?>
							<label class="stm-option-label" style="display: block;">
								<input type="checkbox" class="chk_filter_removeall chk_filter_condition" data-class="chk_all_filter_condition"  name="service_category[]" value="<?php echo $key; ?>" <?php if( !empty($_GET['service_category']) && in_array($key, $_GET['service_category']) ){ echo " checked=checked "; } ?> />
								<span><?php echo $service?></span>
							</label>

						<?php } ?>
					</div>
				</div>

				<div class="col-md-12 col-sm-12 col-xs-12 stm-select-col search-btn" style="display:none;">
					<button type="submit" class="heading-font" style="    width: 100%;"><i class="fa fa-search"></i> Search</button>
				</div>





			
		</div>




	</div>
</div>

<form  method="get" action="/dealerships/" id="dealershipsresetofworld" class="dealershipsresetofworld">
	
	<div class="stm-accordion-single-unit stm-listing-directory-checkboxes stm-one_col stm-ajax-checkbox-instant">
		<a class="restworld title  <?php echo $first; ?>" data-toggle="collapse" href="#accordion-region" aria-expanded="false">
			<h5>Rest of the world:</h5>
			<span class="minus"></span>
		</a>
		<div class="stm-accordion-content">
			<div class="collapse <?php echo $second; ?> content" id="accordion-region">
				<div class="stm-accordion-content-wrapper stm-accordion-content-padded">
					<div class="stm-accordion-inner">
						<div class="tree_main">
							<ul id="bs_main" class="main_ul">
								<?php  
								foreach($allregion as $key => $region) {

									$subtermsnew = get_terms( array( 
										'taxonomy' => 'region',
										'parent'   => $region->term_id,
										'hide_empty'=> false
									) );
									$class = '';	
									$style = 'display:none';
									foreach($subtermsnew as $key => $subregionn) {

				//echo $subregionn->name;
										$countryname = $api_result['country_code'];
										if($subregionn->name == $api_result['country_code']){
											$rsubtermsn = get_term( $subregionn->parent,'region');
											$countryname = $rsubtermsn->name;
										}

										if( !empty($_GET['region_category']) && in_array($subregionn->name, $_GET['region_category']) ){
											$class = "minus"; 
											$style = 'display:block';
										}
										elseif(empty($_GET['region_category']) &&  ($subregionn->name == $countryname)){
											$class =  "minus";
											$style = 'display:block';
										}					
									}

									$checked = '';
									if( !empty($_GET['region_category']) && in_array($region->name, $_GET['region_category']) ){ 
										$checked = " checked=checked ";
										$rest = 1;											}	
										elseif(empty($_GET['region_category']) &&  ($region->name == $countryname)){
											$checked = " checked=checked ";
											$rest = 1;
										}

										if($region->parent == 0 && ($region->name != $countryname)){  // echo $region->term_id;   ?>  

											<li id="bs_1">
												<span class="plus <?php echo $class; ?> ">&nbsp;</span>                  
												<span><?php echo $region->name;?></span>

												<ul id="bs_l_1" class="sub_ul" style="<?php echo $style; ?>">

													<?php 
						//echo $region->term_id;
													$subterms = get_terms( array( 
														'taxonomy' => 'region',
														'parent'   => $region->term_id,
														'hide_empty'=> false
													) );

						//print_r($subterms);

													foreach($subterms as $key => $subregion) { 				

														if( !empty($_GET['region_category']) && in_array($subregion->name, $_GET['region_category']) ){ 				
															$subchecked = " checked=checked "; }													
															elseif( empty($_GET['region_category']) && ($subregion->name == $countryname)){
																$subchecked = " checked=checked ";
															}else{
																$subchecked = '';
															}
															?>

															<li id="bf_1">							
																<input type="checkbox" class="chk_filter_removeall chk_filter_condition" data-class="chk_all_filter_condition"  name="region_category[]" value="<?php echo $subregion->name; ?>" <?php echo $subchecked;  ?> />
																<span><?php echo $subregion->name;?></span>

															</li>
														<?php } ?>
													</ul>
												<?php } ?>
											</li>

											<?php                 
										} ?>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<input type="hidden" class="mainaccordian" name="mainaccordian" value="<?php echo $rest;?>">
			
		</form>
	</div>
</div>

<div class="col-md-9 col-sm-12 <?php echo esc_attr($sidebar_pos['content']); ?>">

	<div id="map" style="height:425px;    margin-top: 25px;"></div>

	<?php the_content();?>
	<div class="stm-ajax-row">
		<?php stm_listings_load_template('filter/actions'); ?>

		<div id="listings-result">
			<?php 
			$args = array(
				// 'meta_query' => array(
					// array(
						// 'key'     => 'dealer_user_type',
						// 'value'   => array('service_provider','dealer_service_provider'),
						// 'compare' => 'IN'
					// )
				// ) 
				'role'    => array('dealerships'),
			);
			
			if(!empty($_GET['service_category'])){                
				$service_category = $_GET['service_category'];

				foreach( $service_category as $cat ){
					$args['meta_query'][] = array(
						'key'     => 'business_category',
						'value'   => $cat,
						'compare' => 'LIKE'
					);
				}				
			}
			
			
			//print_r($_GET['region_category']);
			if(!isset($_GET['ca_location'])){
				$meta_query_args= array();
				if(!empty($_GET['region_category'])){                
					$region_category = $_GET['region_category'];										
					foreach( $region_category as $cat ){				
						$meta_query_args[] = array(
							'key'     => 'hd_state',
							'value'   => $cat,
							'compare' => 'LIKE'
						);
					}				
				}else{				
					//echo $_SESSION['country'];
					$region_category = $_SESSION['country'];														
					$meta_query_args[] = array(
						'key'     => 'hd_state',
						'value'   => $_SESSION['country'],
						'compare' => 'LIKE'
					);
				}
				$meta_query_args['relation'] = 'OR';
				$args['meta_query'][] = $meta_query_args;
			}
			
			
			$current_location   ='';
			$distance_user_filter = array();
            //print_r($distance_user_filter);
			if(!empty($_GET['ca_keywords'])){
				$search_string = esc_attr( trim( $_GET['ca_keywords'] ) );
				$args['search'] = "*{$search_string}*";

               // $args['search_columns'] = array('display_name');
			}

			$none_dealer_users_prelist = new WP_User_Query( $args );

        //echo "+++".count($none_dealer_users_prelist)."<br>";
			
			$userdistance = array();
			$userarr = array();
			if ( ! empty( $none_dealer_users_prelist->get_results() ) ) {
				foreach ( $none_dealer_users_prelist->get_results() as $none_dealer_user ) {
					
					$distance = 1000000;
					$stm_distance = 200;
					
					$userlat =  get_user_meta($none_dealer_user->ID,'stm_dealer_location_lat',true);
					$userlng =  get_user_meta($none_dealer_user->ID,'stm_dealer_location_lng',true);

					/*Add distance away*/
					
					if ( ! empty( $_GET['ca_location'] ) and ! empty( $_GET['stm_lng'] ) and ! empty( $_GET['stm_lat'] ) and ! empty( $userlat ) and ! empty( $userlng ) ) {
						$distance   = stm_calculate_distance_between_two_points( floatval( $_GET['stm_lat'] ), floatval( floatval( $_GET['stm_lng'] ) ), $userlat, $userlng );
						$current_location = explode( ',', sanitize_text_field( $_GET['ca_location'] ) );
						$current_location = $current_location[0];
						
						

						//echo $distance;
						if(!empty($_GET['stm_distance'])){

							$stm_distance = $_GET['stm_distance'];
							//var_dump($user_list[ $user_id ]['fields']['distance']);
						}
						if(floatval($distance) < $stm_distance){
							$nd = explode(" ", $distance);
							$distance_user_filter[] = $none_dealer_user->ID;
							$userarr[$none_dealer_user->ID] = $nd[0];
							$userdistance[] = $userarr;
						}
						
					}
				}
			}
			
			asort($userarr);
			//print_r(array_keys($userarr));

			$args['include'] = array_keys($userarr);
			$args['orderby'] = 'include';
			//print_r($args);
			$none_dealer_users = get_users( $args );


			$total_users =   count($none_dealer_users);

			foreach ($none_dealer_users as $key => $none_dealer_user) {

				$usermeta = get_user_meta ( $none_dealer_user->ID );

				$userlat =  get_user_meta($none_dealer_user->ID,'stm_dealer_location_lat',true);
				$userlng =  get_user_meta($none_dealer_user->ID,'stm_dealer_location_lng',true);

				$location = array();							
				$location['address'] =  "<b>".$none_dealer_user->first_name." ".$none_dealer_user->last_name."</b><br><a  href='".$authorurl."' class=''>View More</a>"; 
				$location['name'] =  $none_dealer_user->first_name."".$none_dealer_user->last_name; 
				$location['lat'] = $userlat;
				$location['lng'] = $userlng;

				$locations[] =$location;

			}

			$number = get_option('posts_per_page');
			$number = 25;

			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

			$offset = ($paged - 1) * $number;



			$args['number'] = $number;
			$args['offset'] = $offset;

			$none_dealer_users = get_users( $args );
			
			//print_r($args);

			if(count($none_dealer_users) == 0){
				echo  "No Service Provider found";
			}
			
			foreach ($none_dealer_users as $key => $none_dealer_user) {
				
				
# code...
				$usermeta = get_user_meta ( $none_dealer_user->ID );


							/*$location = array();							
							$location['address'] =  "<b>".$none_dealer_user->first_name." ".$none_dealer_user->last_name."</b><br><a  href='".$authorurl."' class=''>View More</a>"; 
							$location['name'] =  $none_dealer_user->first_name."".$none_dealer_user->last_name; 
							$location['lat'] = $userlat;
							$location['lng'] = $userlng;
							
							$locations[] =$location;*/


				//print_r($usermeta['billing_country']);


				//load common template
				//get_template_part('content/provider', 'listing');
				include("content/provider-listing.php");		
	?>
							
							
									<?php 

								}


            // display the user list here

								if($total_users > $number){

									$pl_args = array(
										'base'     => add_query_arg('paged','%#%'),
										'format'   => '',
										'total'    => ceil($total_users / $number),
										'current'  => max(1, $paged),
										'type'      => 'list',
										'prev_text' => '<i class="fa fa-angle-left"></i>',
										'next_text' => '<i class="fa fa-angle-right"></i>',
									);

				// // for ".../page/n"
				// if($GLOBALS['wp_rewrite']->using_permalinks())
					// $pl_args['base'] = user_trailingslashit(trailingslashit(get_pagenum_link(1)).'page/%#%/', 'paged');

									echo '<div class="custom-pagination">'.paginate_links($pl_args).'</div>';
								}
								?>
							</div>
						</div>

					</div> <!--col-md-9-->
				</div>


				<script type="text/javascript">
					jQuery(document).ready(function () {
						jQuery(".plus").click(function () {
							jQuery(this).toggleClass("minus").siblings("ul").toggle();
						})

						jQuery("input[type=checkbox]").click(function () {
					//alert($(this).attr("id"));
					//var sp = $(this).attr("id");
					//if (sp.substring(0, 4) === "c_bs" || sp.substring(0, 4) === "c_bf") {
						jQuery(this).siblings("ul").find("input[type=checkbox]").prop('checked', jQuery(this).prop('checked'));
					//}
				})

						jQuery("input[type=checkbox]").change(function () {
							var sp = jQuery(this).attr("id");
							if (sp.substring(0, 4) === "c_io") {
								var ff = $(this).parents("ul[id^=bf_l]").attr("id");
								if (jQuery('#' + ff + ' > li input[type=checkbox]:checked').length == jQuery('#' + ff + ' > li input[type=checkbox]').length) {
									jQuery('#' + ff).siblings("input[type=checkbox]").prop('checked', true);
									check_fst_lvl(ff);
								}
								else {
									jQuery('#' + ff).siblings("input[type=checkbox]").prop('checked', false);
									check_fst_lvl(ff);
								}
							}

							if (sp.substring(0, 4) === "c_bf") {
								var ss = $(this).parents("ul[id^=bs_l]").attr("id");
								if (jQuery('#' + ss + ' > li input[type=checkbox]:checked').length == jQuery('#' + ss + ' > li input[type=checkbox]').length) {
									jQuery('#' + ss).siblings("input[type=checkbox]").prop('checked', true);
									check_fst_lvl(ss);
								}
								else {
									jQuery('#' + ss).siblings("input[type=checkbox]").prop('checked', false);
									check_fst_lvl(ss);
								}
							}
						});

					})

					function check_fst_lvl(dd) {
    //var ss = $('#' + dd).parents("ul[id^=bs_l]").attr("id");
    var ss = jQuery('#' + dd).parent().closest("ul").attr("id");
    if (jQuery('#' + ss + ' > li input[type=checkbox]:checked').length == jQuery('#' + ss + ' > li input[type=checkbox]').length) {
        //$('#' + ss).siblings("input[id^=c_bs]").prop('checked', true);
        jQuery('#' + ss).siblings("input[type=checkbox]").prop('checked', true);
    }
    else {
        //$('#' + ss).siblings("input[id^=c_bs]").prop('checked', false);
        jQuery('#' + ss).siblings("input[type=checkbox]").prop('checked', false);
    }

}

function pageLoad() {
	jQuery(".plus").click(function () {
		jQuery(this).toggleClass("minus").siblings("ul").toggle();
	})
}

// for more information toggle
jQuery(document).ready(function(){
        // Add minus icon for collapse element which is open by default
        jQuery(".collapse.show").each(function(){
        	jQuery(this).prev(".info_heading").find(".fa").addClass("fa-minus").removeClass("fa-plus");
        });
        
        // Toggle plus minus icon on show hide of collapse element
        jQuery(".collapse").on('show.bs.collapse', function(){
        	jQuery(this).prev(".info_heading").find(".fa").removeClass("fa-plus").addClass("fa-minus");
        }).on('hide.bs.collapse', function(){
        	jQuery(this).prev(".info_heading").find(".fa").removeClass("fa-minus").addClass("fa-plus");
        });
    });

</script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyChDqc8vz4Q_nj4B-jk1kGm-q0aDztUf4A"></script> 
<script type="text/javascript">
	var map;
	var Markers = {};
	var infowindow;
	var locations = [
	<?php for($i=0;$i<sizeof($locations);$i++){ $j=$i+1;?>
		[
		"<?php echo $locations[$i]['address'];?>",
		"<?php echo $locations[$i]['name'];?>",
		<?php echo $locations[$i]['lat'];?>,
		<?php echo $locations[$i]['lng'];?>,
		0
	]<?php if($j!=sizeof($locations))echo ","; }?>
	];
	//console.log(locations.length);
	var origin;
	if(locations.length == 0){
		origin = {lat:<?php echo round($api_result['latitude'],6); ?>, lng:<?php echo round($api_result['longitude'],6); ?>};
	}else{
		origin =  new google.maps.LatLng(locations[0][2], locations[0][3]);
	}


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
		map.setCenter(markerPosition);
        //google.maps.event.trigger(myMarker, 'click');
    }

    google.maps.event.addDomListener(window, 'load', initialize);

</script>
