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
   // print_r($api_result);
    //$_SESSION['country'] = $api_result['country_code'];
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
	$dealeracc2 = '';

	$dealerlocation = 'collapsed';
	$dealerlocation2 = '';
	$dealercategory = 'collapsed';
	$dealercategory2 = '';
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
	if(!empty($_GET['service_category'])){
		$dealercategory = '';
		$dealercategory2 = 'in';
	}	
	if(!empty($_GET['service_parts'])){
		$dealerparts = '';
		$dealerparts2 = 'in';
	}

	if(!empty($_GET['distributors'])){
		$dealerbrand = '';
		$dealerparts3 = 'in';
	}	

	// get service parts taxonomy	
	$parts_terms = get_terms( array(
		'taxonomy' => 'parts',
		'hide_empty' => false,
	) );

	$allservice = get_terms( array(
		'taxonomy' => 'service_category',
		'hide_empty' => false,
	) );
	$distributors = get_terms( array(
		'taxonomy' => 'distributors',
		'hide_empty' => false,
	) );
	
?>

    <div class="col-md-3 col-sm-12 classic-filter-row sidebar-sm-mg-bt <?php echo esc_attr($sidebar_pos['sidebar']); ?>" style="margin-top: -20px;">
        <?php //stm_listings_load_template('filter/sidebar'); ?>
        <!--Sidebar-->
		<div class="count_list_n 443">
			<div class="row">
				<!--<div class="col-xs-2 search-div">
					<div class="service-list-serach">
						<p class="btn-search-service"><img src="https://hd-central.com/wp-content/uploads/2021/09/Vector-9.png"></p>
					</div>
				</div>-->
				<div class="col-xs-9 count-div">
					<div class="list-count">
						<?php
						$result = count_users();
						$total_count_stm_u = count( get_users( array( 'role' => 'stm_dealer' )));
						//echo $total_count_stm_u;
						$vl_n  = array_map('intval', str_split($total_count_stm_u));
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
					<div class="count-text">
						<span class="countr_blow_txt">Consequat-<span class="countr_blow_txt_inner">iaculis fermentum</span></span>
					</div>
				</div>
				<div class="col-xs-3 search-div"><span class="text_after_counter">Listings</span></div>
			</div>
		</div>


<!-- list near me for mobile start -->
		<div class="stm-accordion-single-unit stm-listing-directory-checkboxes stm-one_col stm-ajax-checkbox-instant find-dealership mobile">

<div class="stm-accordion-content">
	<div class="collapse content <?php echo $dealerlocation2;?>" id="accordion-dealerships-search">
		<div class="stm-accordion-content-wrapper stm-accordion-content-padded">
			<div class="stm-accordion-inner">

				<form  method="get" action="/service-list/">
					<div class="row row-pad-top-24">
						<!--Location inputs-->
						<div class="col-md-12 col-sm-12">
							<h5>Listings Near Me</h5>
							<span class="minus"></span>
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
					
				</form>
				<form method="get" action="">
					
						<h5>Search by business name: </h5>
						<div class="form-group boats-location">
							<div class="stm-business-search-name">
								<input type="text" id="stm_listing_search_business_nm" class="stm_listing_search_business_nm empty pac-target-input" placeholder="Business Name" name="business_name" value="<?php echo $_REQUEST['business_name'];?>" />
								<button type="submit" class="submit_btn bsn"><i class="fa fa-search"></i></button>
							</div>
						</div>
					
				</form>
				<button type="submit" class="heading-font button_for_map"><img src="https://hd-central.com/wp-content/uploads/2021/09/maps-and-flags-1.png" class="map-icon"> MapView</button>
			</div>
		</div>
	</div>
</div>



</div>

<!--<div id="map" style="height:425px;    margin-top: 18px;display:none;"></div>-->
<!-- list near me for mobile end -->

			<div class="sidebar-left-service ">
        <div class="stm-inventory-sidebar dealerships-sidebar">
			
			<!-- <div class="count_list_n">
				<?php
				$result = count_users();
				$total_count_stm_u = count( get_users( array( 'role' => 'stm_dealer' )));
				//echo $total_count_stm_u;
				$vl_n  = array_map('intval', str_split($total_count_stm_u));
				$count = count($vl_n);
				$finvl = 6-$count;
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
			</div> -->
			
			
			
        	<!--<form  method="get" action="/service-list/" id="dealerships" class="w435 dealerships">
						
						<div class="stm-accordion-single-unit stm-listing-directory-checkboxes stm-one_col stm-ajax-checkbox-instant top_no_border">
							<a class="title <?php echo $dealeracc; ?>" data-toggle="collapse" href="#accordion-dealerships" aria-expanded="false">
								<h5>Listings in your Country</h5>
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
						</div>
						<input type="hidden" class="currentaccordian" name="currentaccordian" value="<?php echo $rest1; ?>">
			</form>-->



<!--<div class="stm-accordion-single-unit stm-listing-directory-checkboxes stm-one_col stm-ajax-checkbox-instant find-dealership service-listing">
						<a class="title <?php echo $dealerlocation; ?>" data-toggle="collapse" href="#accordion-dealerships-search" aria-expanded="false">
							<h5>Search Listings</h5>
							<span class="minus"></span>
						</a>
						<div class="stm-accordion-content">
							<div class="collapse content <?php echo $dealerlocation2;?>" id="accordion-dealerships-search">
								<div class="stm-accordion-content-wrapper stm-accordion-content-padded">
									<div class="stm-accordion-inner">

            <form  method="get" action="/service-list/">
                
                    <div class="row row-pad-top-24">




                        <div class="col-md-12 col-sm-12">

                            
                            <div class="form-group boats-location">
                                <div class="stm-location-search-unit">
                                    <input type="text" id="ca_title_filter" class=" empty pac-target-input" placeholder="Enter title" data-palce="gdfdg" name="ca_keywords" value="<?php echo $_REQUEST['ca_keywords'];?>" autocomplete="off">
                                    
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
</div>-->




<div class="stm-accordion-single-unit stm-listing-directory-checkboxes stm-one_col stm-ajax-checkbox-instant">
						<a class="title <?php echo $dealercategory; ?>" data-toggle="collapse" href="#accordion-dealerships-category" aria-expanded="false">
							<h5><div class="imginv-icon"><img src="https://hd-central.com/wp-content/uploads/2021/09/service-category.png" class="sidebar-icons services-categories"></div> Services Categories</h5>
							<span class="minus"></span>
						</a>
						<div class="stm-accordion-content">
							<div class="collapse content <?php echo $dealercategory2;?>" id="accordion-dealerships-category">
								<div class="stm-accordion-content-wrapper stm-accordion-content-padded">
									<div class="stm-accordion-inner">

            <form  method="get" action="/service-list/">
            	 <div class="stm-keyword-search-unit" style="clear: both;">
                            <?php foreach($allservice as $service) {?>
                              <label class="stm-option-label" style="display: block;">
                                <input type="checkbox" class="chk_filter_removeall chk_filter_condition" data-class="chk_all_filter_condition"  name="service_category[]"
                                value="<?php echo $service->term_id; ?>" <?php if( !empty($_GET['service_category']) && in_array($service->term_id, $_GET['service_category']) ){ echo " checked=checked "; } ?> />
                                <span><?php echo $service->name;?></span>
                            </label>

                        <?php } ?>
						</div>  

     </form>
        </div>
    </div>
</div>
</div>
</div>
<div class="stm-accordion-single-unit stm-listing-directory-checkboxes stm-one_col stm-ajax-checkbox-instant">
						<a class="title <?php echo $dealerparts; ?>" data-toggle="collapse" href="#accordion-dealerships-parts" aria-expanded="false">
							<h5><div class="imginv-icon"><img src="https://hd-central.com/wp-content/uploads/2021/09/parts-and-accessories.png" class="sidebar-icons parts"></div> Parts and Accessories</h5>
							<span class="minus"></span>
						</a>
						<div class="stm-accordion-content">
							<div class="collapse content <?php echo $dealerparts2;?>" id="accordion-dealerships-parts">
								<div class="stm-accordion-content-wrapper stm-accordion-content-padded">
									<div class="stm-accordion-inner">
										<form  method="get" action="/service-list/">
										   <div class="stm-keyword-search-unit" style="clear: both;">
					                            <?php foreach($parts_terms as $parts) {?>
					                              <label class="stm-option-label" style="display: block;">
					                                <input type="checkbox" class="chk_filter_removeall chk_filter_condition" data-class="chk_all_filter_condition"  name="service_parts[]"
					                                value="<?php echo $parts->term_id; ?>" <?php if( !empty($_GET['service_parts']) && in_array($parts->term_id, $_GET['service_parts']) ){ echo " checked=checked "; } ?> />
					                                <span><?php echo $parts->name; ?></span>
					                            </label>

					                        <?php } ?>
											</div>  
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="stm-accordion-single-unit stm-listing-directory-checkboxes stm-one_col stm-ajax-checkbox-instant">
						<a class="title <?php echo $dealerbrand; ?>" data-toggle="collapse" href="#accordion-dealerships-brand" aria-expanded="false">
							<h5><div class="imginv-icon"><img src="https://hd-central.com/wp-content/uploads/2021/09/brans-make.png" class="sidebar-icons"></div> Brand / Make</h5>
							<span class="minus"></span>
						</a>
						<div class="stm-accordion-content">
							<div class="collapse content <?php echo $dealerparts3;?>" id="accordion-dealerships-brand">
								<div class="stm-accordion-content-wrapper stm-accordion-content-padded">
									<div class="stm-accordion-inner">
										<form  method="get" action="/service-list/">
										   <div class="stm-keyword-search-unit" style="clear: both;">
					                            <?php foreach($distributors as $distributor) {?>
					                              <label class="stm-option-label" style="display: block;">
					                                <input type="checkbox" class="chk_filter_removeall chk_filter_condition" data-class="chk_all_filter_condition"  name="distributors[]"
					                                value="<?php echo $distributor->term_id; ?>" <?php if( !empty($_GET['distributors']) && in_array($distributor->term_id, $_GET['distributors']) ){ echo " checked=checked "; } ?> />
					                                <span><?php echo $distributor->name; ?></span>
					                            </label>

					                        <?php } ?>
											</div>  
                    </form>
									</div>
								</div>
							</div>
						</div>
					</div>

<form  method="get" action="/service-list/" id="dealershipsresetofworld" class="dealershipsresetofworld" style="display: none;">
	
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
		<br/>
        </div>  
      	<div class="bikeforsalefirstads">
			<?php  echo do_shortcode('[widget id="custom_html-5"]'); ?>
		</div>
									</div>
    </div>

<div class="col-md-9 col-sm-12 testtt<?php echo esc_attr($sidebar_pos['content']); ?>">

	<div class="stm-accordion-single-unit stm-listing-directory-checkboxes stm-one_col stm-ajax-checkbox-instant find-dealership desktop 8888">

		<div class="stm-accordion-content">
			<div class="collapse content <?php echo $dealerlocation2;?>" id="accordion-dealerships-search">
				<div class="stm-accordion-content-wrapper stm-accordion-content-padded">
					<div class="stm-accordion-inner">

						<form  method="get" action="/service-list/">
							<div class="row row-pad-top-24">
								<!--Location inputs-->
								<div class="col-md-12 col-sm-12">

								<a class="title <?php echo $dealerlocation; ?>" data-toggle="collapse" href="#accordion-dealerships-search" aria-expanded="false">
			<h5>Listings Near Me</h5>
			<span class="minus"></span>
		</a>
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
							
						</form>
						<form method="get" action="">
							<a class="title <?php echo $dealerlocation; ?>" data-toggle="collapse" href="#accordion-dealerships-search" aria-expanded="false">
								<h5>Search by business name: </h5>
								<div class="form-group boats-location">
									<div class="stm-business-search-name">
										<input type="text" id="stm_listing_search_business_nm" class="stm_listing_search_business_nm empty pac-target-input" placeholder="Business Name" name="business_name" value="<?php echo $_REQUEST['business_name'];?>" />
										<button type="submit" class="submit_btn bsn"><i class="fa fa-search"></i></button>
									</div>
								</div>
							</a>
						</form>
						<button type="submit" class="heading-font button_for_map"><img src="https://hd-central.com/wp-content/uploads/2021/09/maps-and-flags-1.png" class="map-icon"> MapView</button>
					</div>
				</div>
			</div>
		</div>
		
		
		
	</div>

	
<?php the_content();?>
    <div class="stm-ajax-row">
        <?php stm_listings_load_template('filter/actions'); ?>

        <div id="listings-result servicelist">
			<div id="map" style="height:425px;    margin-top: 18px; display:none;"></div>
            <?php 
            $args = array( 'role' => 'stm_dealer');
			
			
			
			//$user_query_getcnt = new WP_User_Query( array( 'role' => 'stm_dealer' ) );
			
			//$users_count = (int) $user_query->get_total();
			
			//echo 'So much authors: ' . $users_count;

            if(!empty($_GET['user_type'])){
                $args['meta_query'][] = array(
                    'key'     => 'THrtRcapabilities',
                    'value'   => 'dealerships',
                    'compare' => 'LIKE'
                );

            }
			
			// $place_category= array();
			// $place_category[] = array(
						// 'key'     => 'place_categories',
						// 'compare' => 'NOT EXISTS'
			// );
			
			// $place_category[] = array(
						// 'key'     => 'place_categories',
						// 'value' => '',
						// 'compare' => '=='
			// );
			
			// $place_category['relation'] = 'OR';
			// $args['meta_query'][] = $place_category;
			
			
			$place_user = array();
			$place_user[] = array(
						'key'     => 'place_user',
						'compare' => 'NOT EXISTS'
			);
			
			$place_user[] = array(
						'key'     => 'place_user',
						'value' => '',
						'compare' => '=='
			);
			
			$place_user['relation'] = 'OR';
			$args['meta_query'][] = $place_user;
			
			
			if(!empty($_GET['service_category'])){                
				$service_category = $_GET['service_category'];
						
				foreach( $service_category as $cat ){
					$args['meta_query'][] = array(
						'key'     => 'service_category',
						'value' => sprintf(':"%s";', $cat),
						'compare' => 'LIKE'
					);
				}				
            }
			
			if(!empty($_GET['service_parts'])){                
				$service_parts = $_GET['service_parts'];
										
				foreach( $service_parts as $part ){
					$args['meta_query'][] = array(
						'key'     => 'parts_category',
						//'value'   => '%"'.$part.'"%',
						'value' => sprintf(':"%s";', $part),
						'compare' => 'LIKE'
					);
				}				
            }
			
			/* $args['meta_query'][] = array(
						'key'     => 'first_name',
						//'value'   => '%"'.$part.'"%',
						'value' => sprintf(':"%s";', $distributor),
						'compare' => 'LIKE'
					); */

            if(!empty($_GET['distributors'])){                
				$distributors = $_GET['distributors'];
										
				foreach( $distributors as $distributor ){
					$args['meta_query'][] = array(
						'key'     => 'distributors',
						//'value'   => '%"'.$part.'"%',
						'value' => sprintf(':"%s";', $distributor),
						'compare' => 'LIKE'
					);
				}				
            }
			
			
			
			if(!isset($_GET['ca_location'])){
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
					$region_category = $_SESSION['country'];														
					$meta_query_args[] = array(
						'key'     => 'billing_country',
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

                $meta_query_args[] = array(
						'key'     => 'billing_country',
						'value'   => $_SESSION['country'],
						'compare' => 'LIKE'
					);

               // $args['search_columns'] = array('display_name');
            }

            
            //print_r($args);
            $none_dealer_users_prelist = new WP_User_Query( $args );
			//echo "nc".count($none_dealer_users_prelist);
			//print_r($none_dealer_users_prelist);

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
			//print_r($userarr);

			asort($userarr);
			//print_r(array_keys($userarr));

			if(!empty($_GET['offer'])){                
				$offer = $_GET['offer'];
										
				
					$args['meta_query'][] = array(
						'key'     => 'my_offer_id',
						'compare' => 'EXISTS'
					);
							
            }
			if(!empty($_GET['business_name'])){
				$bus_nam = $_GET['business_name'];
				$args['meta_query'][] =  array(
					'meta_query' => array(
						'relation' => 'OR',
						array(
							'key'     => 'first_name',
							'value'   => $bus_nam,
							'compare' => 'LIKE'
						)
					)
				);
			}
			
			$args['include'] = array_keys($userarr);
			$args['orderby'] = 'include';
			//print_r($args);
			$none_dealer_users = get_users( $args );
			//echo count($none_dealer_users)

			$total_users =   count($none_dealer_users);
			
			foreach ($none_dealer_users as $key => $none_dealer_user) {

				$usermeta = get_user_meta ( $none_dealer_user->ID );

							$userlat =  get_user_meta($none_dealer_user->ID,'stm_dealer_location_lat',true);
							$userlng =  get_user_meta($none_dealer_user->ID,'stm_dealer_location_lng',true);
							
							if($userlat == ''){
								$userlat = 0;
							}
							
							if($userlng == ''){
								$userlng = 0;
							} 

							$location = array();							
							$location['address'] =  "<b>".$none_dealer_user->first_name." ".$none_dealer_user->last_name."</b><br><a  href='".$authorurl."' class=''>View More</a>"; 
							$location['name'] =  $none_dealer_user->first_name."".$none_dealer_user->last_name; 
							$location['lat'] = $userlat;
							$location['lng'] = $userlng;
							
							$repl_lat = str_replace( ',', '', $userlat);
							$location['lat'] = $repl_lat;
							//$repl_lng = str_replace(",","",$userlng);
							$repl_lng = str_replace( ',', '', $userlng );
							$repl_lng1 = str_replace( 'z', '', $repl_lng );
							$location['lng'] = $repl_lng1;
							
							$locations[] =$location;

			}

			$number = get_option('posts_per_page');
			$number = 25;

			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

			$offset = ($paged - 1) * $number;
            

            $args['number'] = $number;
            $args['offset'] = $offset;
			
			//print_r($args);

            $none_dealer_users = get_users( $args );
			
			//echo count($none_dealer_users);

            if(count($none_dealer_users) == 0){
                echo  "No Service Provider found";
            }
            foreach ($none_dealer_users as $key => $none_dealer_user) {
# code...
                $userimg = get_user_meta($none_dealer_user->ID,'stm_dealer_image',true);
                if(empty($userimg)){
                    $userimg = "https://hd-central.com/wp-content/themes/motors-child/assets/images/empty_dealer_logo.png";
                }
				
			
				//load common template
				//get_template_part('content/provider', 'listing');
				include("content/provider-listing.php");
       ?>
          
		  
            <?php 
        }

        // display the user list here

        if($total_users > $number){

			$pl_args = array(
				'base'      => add_query_arg('paged','%#%'),
				'format'    => '',
				'total'     => ceil($total_users / $number),
				'current'   => max(1, $paged),
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
				
				//jQuery(window).resize(function() {
					if (jQuery(window).width() < 768) {
						//alert("3222");
						jQuery(".find-dealership.desktop").html();
					}
					else { 
						//alert("665656");
						jQuery(".find-dealership.mobile").html('');
					} 
				//});
				
				jQuery(".button_for_map").click(function () {
					jQuery("#map").slideToggle();
				});
				
				jQuery(".bsn").click(function () {
					var get_bus_nm = jQuery("#stm_listing_search_business_nm").val();
					console.log("werwe");
					let url = window.location.href;
					console.log(url);
					if(url.includes('?')){
						window.location.href=url+"&business_name="+get_bus_nm;
					}else{
						window.location.href=url+"?business_name="+get_bus_nm;
					}
				});
				
				
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

</script>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyChDqc8vz4Q_nj4B-jk1kGm-q0aDztUf4A"></script> 
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

