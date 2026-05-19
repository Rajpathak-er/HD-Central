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

    $country_name = $api_result['country_name'];
	$country_name_count = wp_get_groupcat_postcount($country_name);
	if($country_name_count == 0){
		$country_name = "United States";
	}

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


	if(empty($_GET)){
		$_REQUEST['all_location'] =1;
		$_GET['all_location'] =1;
		$_REQUEST['ca_location_clean'] = 1;
		$_GET['ca_location_clean'] = 1;
	}
	
	
	$first = 'collapsed';
	$second = '';
	$dealeracc = 'collapsed';
	$dealeracc2 = '';

	$dealerlocation = 'collapsed';
	$dealerlocation2 = '';
	$dealercategory = 'collapsed';
	$dealercategory2 = '';
	$dealerdetails = 'collapsed';
	$dealerdetails2 = '';
	$dealerparts = 'collapsed';
	$dealerparts2 = '';
	$dealerparts3 = '';
	$dealerbrand = 'collapsed';

	if( !empty($_GET['mainaccordian']) && ($_GET['mainaccordian'] == '1') && ( !empty($_GET['region_category']))){
		$first = '';
		$second = 'in';
	}
	if( (!empty($_GET['currentaccordian']) && ($_GET['currentaccordian'] == '1') ) || (!$_GET)  ){
		$dealeracc = '';
		$dealeracc2 = 'in';
	}
	if(!empty($_GET['ca_location'])){
		$dealerlocation = '';
		$dealerlocation2 = 'in';
	}	
	if(!empty($_GET['group_category'])){
		$dealercategory = '';
		$dealercategory2 = 'in';
	}
			
	// get group taxonomy			
	$group_category = get_terms( array(
		'taxonomy' => 'group_category',
		'hide_empty' => false,
	) );


	// get group taxonomy			
	$group_additional_detail = get_terms( array(
		'taxonomy' => 'group_additional_detail',
		'hide_empty' => false,
	) );
	

	
		
	
?>

    <div class="col-md-3 col-sm-12 classic-filter-row sidebar-sm-mg-bt <?php echo esc_attr($sidebar_pos['sidebar']); ?>" style="margin-top: -20px;">
        <?php //stm_listings_load_template('filter/sidebar'); ?>
        <!--Sidebar-->
		
		<?php
			
			$args = array(
				   'post_type' => 'group',
				   'posts_per_page' => -1,
				   'post_status' => 'publish',			   
				);

				
				if(!empty($_GET['group_category'])){                
					$group_categoryfilter = $_GET['group_category'];
							
					foreach( $group_categoryfilter as $cat ){
						$args['meta_query'][] = array(
							'key'     => 'category_group',
							'value' => sprintf(':"%s";', $cat),
							'compare' => 'LIKE'
						);
					}				
				}

				if(!empty($_GET['group_additional_detail'])){                
					$selected_group_additional_detail = $_GET['group_additional_detail'];
							
					
						$args['tax_query'][] = array(

							'taxonomy'     => 'group_additional_detail',
							'terms' => $selected_group_additional_detail,
							'field' => 'term_id'
						);
									
				}

				if(!empty($_GET['ca_keywords'])){
                 $search_string = esc_attr( trim( $_GET['ca_keywords'] ) );
                 $args['search'] = "*{$search_string}*";

	                // $meta_query_args[] = array(
							// 'key'     => 'billing_country',
							// 'value'   => $_SESSION['country'],
							// 'compare' => 'LIKE'
						// );

	               // // $args['search_columns'] = array('display_name');
	             }
	            // print_r($args);
				$none_dealer_users = get_posts( $args );
				
				 $total_users =   count($none_dealer_users);
					$location = array();
					foreach ($none_dealer_users as $key => $none_dealer_user) {

						$usermeta = get_post_meta ( $none_dealer_user->ID );
						$geot_options = get_post_meta ( $none_dealer_user->ID,'geot_options',true );
						$post_title = $none_dealer_user->post_title;
						$guid = $none_dealer_user->guid;
						
						$group_lat = $geot_options['radius_lat'];
						$group_lng = $geot_options['radius_lng'];

									$userlat =  get_user_meta($none_dealer_user->ID,'lat',true);
									$userlng =  get_user_meta($none_dealer_user->ID,'lng',true);
									
									if($userlat == ''){
										 $userlat = 0;
									}
									
									 if($userlng == ''){
										$userlng = 0;
									 }

									if($group_lat!='' && $group_lng!=''){
										$location['address'] =  "<b>".$post_title."</b><br><a  href='".$guid."' class=''>View More</a>"; 
										$location['name'] =  $post_title; 
										$location['lat'] = $group_lat;
										$location['lng'] = $group_lng;
										
										$locations[] =$location;
									}

					}
								

			if( empty($_GET['ca_location']) && $_REQUEST['ca_location_clean'] == 0 ){
							$args['tax_query'] = array(
							        array (
							            'taxonomy' => 'region',
							            'field' => 'name',
							            'terms' => $country_name,
							        )
							    );

				$meta_query_args= array();
				if(!empty($_GET['region_category'])){                
					$region_category = $_GET['region_category'];										
					foreach( $region_category as $cat ){				
						$meta_query_args[] = array(
							'key'     => 'billing_country',
							'value'   => $cat,
							'compare' => 'LIKE'
						);
					}				
				}else{				
					/*   */
				}
				$meta_query_args['relation'] = 'OR';
				$args['meta_query'][] = $meta_query_args;
			}
			
			
            // $current_location   ='';
            // $distance_user_filter = array();
            // //print_r($distance_user_filter);
          
            
           // print_r($args);
            $none_dealer_users_prelist = get_posts( $args );
			
			// //print_r($none_dealer_users_prelist);

       // echo "+++".count($none_dealer_users_prelist)."<br>";
			
			 $userdistance = array();
			 $userarr = array();
			 
				 foreach ($none_dealer_users as $key => $none_dealer_user) {
					
					 $stm_distance = 1000000;
					// $stm_distance = 200;
					//	echo $none_dealer_user->ID."<br/>";
					  $userlat =  get_post_meta($none_dealer_user->ID,'latitude',true);
					 $userlng =  get_post_meta($none_dealer_user->ID,'longitude',true);

					// /*Add distance away*/
					
					 if ( ! empty( $_GET['ca_location'] ) and ! empty( $_GET['stm_lng'] ) and ! empty( $_GET['stm_lat'] ) and ! empty( $userlat ) and ! empty( $userlng ) ) {
						 $distance   = stm_calculate_distance_between_two_points( floatval( $_GET['stm_lat'] ), floatval( floatval( $_GET['stm_lng'] ) ), $userlat, $userlng );
						 $current_location = explode( ',', sanitize_text_field( $_GET['ca_location'] ) );
						 $current_location = $current_location[0];
						
						
					
						// //echo $distance;
						 if(!empty($_GET['stm_distance'])){

							 $stm_distance = $_GET['stm_distance'];
							// //var_dump($user_list[ $user_id ]['fields']['distance']);
						 }
						 if(floatval($distance) < $stm_distance){
							 $nd = explode(" ", $distance);
							 $distance_user_filter[] = $none_dealer_user->ID;
							 $userarr[$none_dealer_user->ID] = $nd[0];
							 $userdistance[] = $userarr;
						 }
						
					 
				 }
			 }
			//print_r(($userarr));
			asort($userarr);
			// asort($userarr);
			// //print_r(array_keys($userarr));

			// if(!empty($_GET['offer'])){                
				// $offer = $_GET['offer'];
										
				
					// $args['meta_query'][] = array(
						// 'key'     => 'my_offer_id',
						// 'compare' => 'EXISTS'
					// );
							
            // }

			// $args['include'] = array_keys($userarr);
			// $args['orderby'] = 'include';
			// //print_r($args);
			// $none_dealer_users = get_users( $args );


			// $total_users =   count($none_dealer_users);
			
			// foreach ($none_dealer_users as $key => $none_dealer_user) {

				// $usermeta = get_user_meta ( $none_dealer_user->ID );

							// $userlat =  get_user_meta($none_dealer_user->ID,'stm_dealer_location_lat',true);
							// $userlng =  get_user_meta($none_dealer_user->ID,'stm_dealer_location_lng',true);
							
							// if($userlat == ''){
								// $userlat = 0;
							// }
							
							// if($userlng == ''){
								// $userlng = 0;
							// }

							// $location = array();							
							// $location['address'] =  "<b>".$none_dealer_user->first_name." ".$none_dealer_user->last_name."</b><br><a  href='".$authorurl."' class=''>View More</a>"; 
							// $location['name'] =  $none_dealer_user->first_name."".$none_dealer_user->last_name; 
							// $location['lat'] = $userlat;
							// $location['lng'] = $userlng;
							
							// $locations[] =$location;

			// }

			// $number = get_option('posts_per_page');
			// $number = 25;

			// $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

			// $offset = ($paged - 1) * $number;
            

            // $args['number'] = $number;
            // $args['offset'] = $offset;

            // $none_dealer_users = get_users( $args );

            // if(count($none_dealer_users) == 0){
                // echo  "No Service Provider found";
            // }
			
			if(!empty($_GET['ca_keywords'])){
				$bus_nam = $_GET['ca_keywords'];
				
				 $args['s'] = $bus_nam;
			}
			
			 if ( ! empty( $_GET['ca_location'] )){
				 	$args['post__in'] = array_keys($userarr);
					$args['orderby'] = 'post__in';
					$args['order'] = 'DESC';
				 }else{
					//$args['meta_key'] = 'start_date';	 	
				 }

			$number = 20;
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			$offset = ($paged - 1) * $number;            

            $args['number'] = $number;
            $args['offset'] = $offset;
            $args['posts_per_page'] = $number;
			
						
			$group_query = new WP_Query( $args );
			//print_r($group_query);
			
			$count_posts = $group_query->found_posts;

		?>
		
		<div class="count_list_n">
			<div class="row">
				<div class="col-xs-9 count-div">
					<div class="list-count">
													
							<?php
								$result = count_users();
								
								$vl_n  = array_map('intval', str_split($count_posts));
								$count = count($vl_n);
								$finvl = 5-$count;
								//echo $finvl;
								for($i=1; $i<=$finvl; $i++){
									?>
									
									<span class="ins_cntvl in_red_c">0</span>
									<?php
								}
								foreach($vl_n as $vl){
									?>
									<span class="ins_cntvl"><?php echo $vl; ?></span>
									<?php
								}
								?>
												</div>
					
				</div>
				<div class="col-xs-3 search-div"><span class="text_after_counter">Groups</span></div>
			</div>
		</div>
		<form  method="get" action="/group-list/" id="dealerships" class="dealerships">

			<div class="stm_filter_location ">
			
				<div class="filter filter-sidebar ajax-filter">
				<div class="row row-pad-top-24">
					<?php stm_listings_load_template( 'filter/types/location-sidebar-services' ); ?>
				</div>

				<div class="sidebar-action-units">
					<input id="stm-classic-filter-submit" class="hidden" type="submit"
						value="<?php esc_html_e( 'Show cars', 'motors' ); ?>"/>
					<a href="<?php echo esc_url( strtok( $_SERVER['REQUEST_URI'], '?' ) ); ?>" class="button"><span><?php _e( 'Reset all', 'motors' ); ?></span></a>
				</div>
				</div>
		
			</div>
			
        <div class="stm-inventory-sidebar dealerships-sidebar">
        	
						
						<!-- <div class="stm-accordion-single-unit stm-listing-directory-checkboxes stm-one_col stm-ajax-checkbox-instant top_no_border">
							<a class="title <?php echo $dealeracc; ?>" data-toggle="collapse" href="#accordion-dealerships" aria-expanded="false">
								<h5>Clubs & Groups in your Country</h5>
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
														//$_SESSION['country'] = $region;
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

																<?php if( $name != 'United Kingdom' ){ ?>
																<ul id="bs_l_1" class="sub_ul" style="">  

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
																<?php } ?>																	</ul>
																
																<?php } ?>
																
																</li>

													<?php } ?>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div> -->
						<input type="hidden" class="currentaccordian" name="currentaccordian" value="<?php echo $rest1; ?>">
			
			

			<div class="stm-accordion-single-unit stm-listing-directory-checkboxes stm-one_col stm-ajax-checkbox-instant group-category">
				<a class="title <?php echo $dealercategory; ?>" data-toggle="collapse" href="#accordion-dealerships-category" aria-expanded="false">
					<h5><img src="<?php echo get_home_url(); ?>/wp-content/uploads/2021/09/preferences-2.png">Group Categories</h5>
					<span class="minus"></span>
				</a>
				<div class="stm-accordion-content">
					<div class="collapse content <?php echo $dealercategory2;?>" id="accordion-dealerships-category">
						<div class="stm-accordion-content-wrapper stm-accordion-content-padded">
							<div class="stm-accordion-inner">
								
									<div class="stm-keyword-search-unit" style="clear: both;">
										<?php foreach($group_category as $ecat) {?>
											<label class="stm-option-label" style="display: block;">
												<input type="checkbox" class="chk_filter_removeall chk_filter_condition" data-class="chk_all_filter_condition"  name="group_category[]"
												value="<?php echo $ecat->term_id; ?>" <?php if( !empty($_GET['group_category']) && in_array($ecat->term_id, $_GET['group_category']) ){ echo " checked=checked "; } ?> />
												<span><?php echo $ecat->name;?></span>
											</label>

										<?php } ?>
									</div> 
								
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="stm-accordion-single-unit stm-listing-directory-checkboxes stm-one_col stm-ajax-checkbox-instant group-category">
				<a class="title <?php echo $dealercategory; ?>" data-toggle="collapse" href="#accordion-additional-category" aria-expanded="false">
					<h5><img src="<?php echo get_home_url(); ?>/wp-content/uploads/2021/09/preferences-2.png">Group Additional Detail</h5>
					<span class="minus"></span>
				</a>
				<div class="stm-accordion-content">
					<div class="collapse content <?php echo $dealercategory2;?>" id="accordion-additional-category">
						<div class="stm-accordion-content-wrapper stm-accordion-content-padded">
							<div class="stm-accordion-inner">
								
									<div class="stm-keyword-search-unit" style="clear: both;">
										<?php foreach($group_additional_detail as $ecat) {?>
											<label class="stm-option-label" style="display: block;">
												<input type="checkbox" class="chk_filter_removeall chk_filter_condition" data-class="chk_all_filter_condition"  name="group_additional_detail[]"
												value="<?php echo $ecat->term_id; ?>" <?php if( !empty($_GET['group_additional_detail']) && in_array($ecat->term_id, $_GET['group_additional_detail']) ){ echo " checked=checked "; } ?> />
												<span><?php echo $ecat->name;?></span>
											</label>

										<?php } ?>
									</div> 
								
							</div>
						</div>
					</div>
				</div>
			</div>
		
		<br/>
        </div>
        </form>  
            	
			<?php  echo do_shortcode('[widget id="custom_html-11"]'); ?>
		
    </div>

<div class="col-md-9 col-sm-12 testtt<?php echo esc_attr($sidebar_pos['content']); ?>">
	
<?php the_content();?>

		


<div id="map" style="height:425px; margin-top: 25px;display:none;"></div>

    <div class="stm-ajax-row">
        <?php //stm_listings_load_template('filter/actions'); ?>
		
		  
        
		

        <div id="listings-result" style="margin-top: 25px;">
		
			<div class="stm-accordion-single-unit stm-listing-directory-checkboxes stm-one_col stm-ajax-checkbox-instant find-dealership place_page_listing">
				
				
				
				<div class="place_search_list stm-accordion-single-unit stm-listing-directory-checkboxes stm-one_col stm-ajax-checkbox-instant find-dealership service-listing">
					<a class="title <?php echo $dealerlocation; ?>" data-toggle="collapse" href="#accordion-dealerships-search" aria-expanded="false">
						<h5>Search Listings</h5>
						
					</a>
					<div class="stm-accordion-content">
						<div class="collapse content <?php echo $dealerlocation2;?>" id="accordion-dealerships-search">
							<div class="">
								<div class="stm-accordion-inner">

									<form  method="get" action="/group-list/">

										<div class="row row-pad-top-24">

											<div class="col-md-12 col-sm-12">
												<div class="form-group boats-location">
													<div class="stm-location-search-unit">
														<input type="text" id="ca_title_filter" class=" empty pac-target-input" placeholder="Enter title" data-palce="gdfdg" name="ca_keywords" value="<?php echo $_REQUEST['ca_keywords'];?>" autocomplete="off">		<button type="submit" class="submit_btn bsn"><i class="fa fa-search"></i></button>										
													</div>
												</div>
											</div>

											<div class="col-md-12 col-sm-12 col-xs-12 stm-select-col row-pad-top-24 search-btn">
												<button type="submit" class="heading-font" style="    width: 100%;"><i class="fa fa-search"></i> Search</button>
											</div>
										</div>

									</form>
							</div>
						</div>
					</div>
				</div>
				</div>
				
				
				<div class="stm-accordion-content place_n_list" style="display:none;">
					<div class="collapse content <?php echo $dealerlocation2;?>" id="accordion-dealerships-search">
						<div class="stm-accordion-content-wrapper stm-accordion-content-padded">
							<div class="stm-accordion-inner">
<!--
							<form  method="get" action="/places/">
								<a class="title <?php echo $dealerlocation; ?>" data-toggle="collapse" href="#accordion-dealerships-search" aria-expanded="false">
									<h5>Listings Near You</h5>
									<span class="minus"></span>
								</a>
								<div class="row row-pad-top-24 place_page_list">
									

									<div class="col-md-12 col-sm-12">
										<div class="form-group boats-location">
											<div class="stm-location-search-unit">
												<input type="text" id="ca_location_listing_filter" class="stm_listing_search_location empty pac-target-input" placeholder="Location / Post Code / City" data-palce="gdfdg" name="ca_location" value="<?php echo $_REQUEST['ca_location'];?>" autocomplete="off">
												<input type="hidden" name="stm_lat" value="<?php echo $_REQUEST['stm_lat'];?>">
												<input type="hidden" name="stm_lng" value="<?php echo $_REQUEST['stm_lng'];?>">
											</div>
										</div>
									</div>
									<div class="col-md-12 col-sm-12" style="display: none;">

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
									<div class="col-md-12 col-sm-12 col-xs-12 stm-select-col row-pad-top-24 search-btn">
										<button type="submit" class="heading-font" style="    width: 100%;"><i class="fa fa-search"></i> Search</button>
									</div>
								</div>
								
							</form>-->
						</div>
					</div>
				</div>
			</div>
			
			
			
			
				<div class="map_view_i">
					<button type="submit" class="heading-font button_for_map"><img src="<?php echo get_home_url(); ?>/wp-content/uploads/2021/09/maps-and-flags-1.png" class="map-icon"> MapView</button>
				</div>
			
		</div>
		
		
        <div id="listings-result">
			
            <?php 
            		//	$total_events =   count($none_dealer_users);
				
							//echo "+++++".$total_groups."<br>";
           // $total_events =   count($none_dealer_users);
			
			while ( $group_query->have_posts() ) : $group_query->the_post();
				$group_id = get_the_ID();
				//echo "++++".$group_id. "<br>";
	# code...
                // $userimg = get_user_meta($event->ID,'stm_dealer_image',true);
                // if(empty($userimg)){
                    // $userimg = "https://hd-central.com/wp-content/themes/motors-child/assets/images/empty_dealer_logo.png";
                // }
				
			
				//load common template
				include("content/group-listing.php");
       ?>
          
		  
      <?php 
			endwhile;
			wp_reset_postdata(); 

        // display the user list here
//echo $count_posts;
        if($count_posts > $number){

			$pl_args = array(
				'base'      => add_query_arg('paged','%#%'),
				'format'    => '',
				'total'     => ceil($count_posts / $number),
				'current'   => max(1, $paged),
				'type'      => 'list',
				'prev_text' => '<i class="fa fa-angle-left"></i>',
				'next_text' => '<i class="fa fa-angle-right"></i>',
			);

//			print_r($pl_args);

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
				
				jQuery(".button_for_map").click(function () {
					jQuery("#map").slideToggle();
				});

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
	]<?php if($j!=sizeof($locations))echo ","; }

	?>
	];
	//console.log(locations.length);
	var origin;
	//if(locations.length == 0){
		origin = {lat:<?php echo round($api_result['latitude'],6); ?>, lng:<?php echo round($api_result['longitude'],6); ?>};
//	}else{
//		origin =  new google.maps.LatLng(locations[0][2], locations[0][3]);
//	}


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

