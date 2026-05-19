<?php 
/* Template Name: Servicing Harley Davidson */ 

get_header();

	$allservice = array();

    //$allservice['mot'] = "MOT";
	$allservice['service_and_repairs'] = "Service and Repairs";
    //$allservice['tyres'] = "Tyres";
    //$allservice['tyre_fitting'] = "Tyre Fitting";
    //$allservice['tyre_sales'] = "Tyre Sales";

?>

	<div class="entry-header center" style="">
	    <div class="container">
            <div class="entry-title vc_row">
            	                    <div class="sub-title h5 vc_col-sm-3" style="color: #ffffff;">
						<!-- Widget Shortcode --><div id="search-3" class="widget widget_search widget-shortcode area-arbitrary "><form role="search" method="get" class="search-form" action="https://hd-central.com/">
				<label>
					<span class="screen-reader-text">Search for:</span>
					<input type="search" class="search-field" placeholder="Search …" value="" name="s">
				</label>
				<input type="submit" class="search-submit" value="Search">
			</form></div><!-- /Widget Shortcode -->                    	<h2></h2>
                   	</div>
                                <div class="vc_col-sm-9 post_title_main_heading">
                <h2 class="h1" style="color: #ffffff;">
	                Servicing your Harley Davidson                </h2>
            	</div>
	            		            <div class="colored-separator">
			            <div class="first-long" style="background-color: #fab637"></div>
			            <div class="last-short" style="background-color: #fab637"></div>
		            </div>
	                            
            </div>
	    </div>
    </div>
	
	<!-- Breads -->
	<div class="stm_breadcrumbs_unit heading-font ">
		<div class="container">
			<div class="navxtBreads">
				<div class="vc_row">
					<div class="vc_col-sm-12" style="opacity: 0;">
						<!-- Breadcrumb NavXT 6.5.0 -->
						<span property="itemListElement" typeof="ListItem"><a property="item" typeof="WebPage" title="Go to HD Central." href="https://hd-central.com" class="home"><span property="name">HD Central</span></a><meta property="position" content="1"></span> &gt; <span property="itemListElement" typeof="ListItem"><span property="name" class="post post-page current-item">Servicing your Harley Davidson</span><meta property="url" content="https://hd-central.com/servicing-your-harley-davidson/"><meta property="position" content="2"></span>							
					</div>
				</div>
			</div>
        </div>
	</div>
	
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<?php
					while ( have_posts() ) : the_post(); ?> <!--Because the_content() works only inside a WP Loop -->
					<div class="entry-content-page">
						<?php the_content(); ?> <!-- Page Content -->
					</div><!-- .entry-content-page -->
				<?php
					endwhile; //resetting the page loop
					wp_reset_query(); //resetting the page query
				?>
			</div>
		</div>	
		
		<div class="row">	
			<div class="col-md-3 col-sm-12">
			
			</div>
			
			<div class="col-md-9 col-sm-12">
			
				<div class="classic-filter-row sidebar-sm-mg-bt" style="margin-top: 20px; margin-bottom: 30px;">					
					<form  method="get" action="">
						<div class="filter filter-sidebar" style="padding: 0 22px 10px;">
							<div class="row row-pad-top-24">
								
								<div class="col-md-12 col-sm-12">
									<div class="clearfix">
										<h4 class="pull-left " style="text-transform: uppercase;">Search by Location</h4>
									</div>
								</div>
									
								<div class="col-md-5 col-sm-12">
									<h5 class="pull-left">Postcode:</h5>
									<div class="form-group">
										<div class="stm-location-search-unit">
											<input type="text" id="ca_location_listing_filter" class="stm_listing_search_location empty pac-target-input" placeholder="Enter Postcode" data-palce="gdfdg" name="ca_location" value="<?php echo $_REQUEST['ca_location'];?>" autocomplete="off">
											<input type="hidden" name="stm_lat" value="<?php echo $_REQUEST['stm_lat'];?>">
											<input type="hidden" name="stm_lng" value="<?php echo $_REQUEST['stm_lng'];?>">
										</div>
									</div>
								</div>
								
								<div class="col-md-5 col-sm-12">
									<h5 class="pull-left">Distance:</h5>
									<select name="stm_distance" class="form-control select2-hidden-accessible" tabindex="-1" aria-hidden="true">
										<option value="" <?php if(!empty($_GET['stm_distance']) && $_GET['stm_distance'] == '') { echo " selected=selected "; }?> >Any Distance</option>
										<option value="1"  <?php if(!empty($_GET['stm_distance']) && $_GET['stm_distance'] == '1') { echo " selected=selected "; }?>>Within 1 miles</option>
										<option value="2"  <?php if(!empty($_GET['stm_distance']) && $_GET['stm_distance'] == '2') { echo " selected=selected "; }?>>Within 2 miles</option>
										<option value="5"  <?php if(!empty($_GET['stm_distance']) && $_GET['stm_distance'] == '5') { echo " selected=selected "; }?>>Within 5 miles</option>
										<option value="10"  <?php if(!empty($_GET['stm_distance']) && $_GET['stm_distance'] == '10') { echo " selected=selected "; }?>>Within 10 miles</option>
										<option value="20"  <?php if(!empty($_GET['stm_distance']) && $_GET['stm_distance'] == '20') { echo " selected=selected "; }?>>Within 20 miles</option>
										<option value="30" <?php if(!empty($_GET['stm_distance']) && $_GET['stm_distance'] == '30') { echo " selected=selected "; }?> >Within 30 miles</option>
										<option value="50"  <?php if(!empty($_GET['stm_distance']) && $_GET['stm_distance'] == '50') { echo " selected=selected "; }?>>Within 50 miles</option>
										<option value="100"  <?php if(!empty($_GET['stm_distance']) && $_GET['stm_distance'] == '100') { echo " selected=selected "; }?>>Within 100 miles</option>
										<option value="200" <?php if(!empty($_GET['stm_distance']) && $_GET['stm_distance'] == '200') { echo " selected=selected "; }?> >Within 200 miles</option>
									</select>
								</div>
									
								<div class="col-md-4 col-sm-12" style="display: none;">
									<h5 class="pull-left">Motorcycle Service:</h5>
									<div class="stm-keyword-search-unit" style="clear: both;">
										<?php foreach($allservice as $key => $service) {?>
										  <label class="stm-option-label" style="display: block;">
											<input type="checkbox" class="chk_filter_removeall chk_filter_condition" data-class="chk_all_filter_condition"  name="service_category[]"
											value="<?php echo $key; ?>" <?php if( !empty($_GET['service_category']) && in_array($key, $_GET['service_category']) ){ echo " checked=checked "; } ?> />
											<span><?php echo $service?></span>
										</label>

										<?php } ?>
									</div>
									
									<!--<select name="service_category[]" class="form-control select2-hidden-accessible" tabindex="-1" aria-hidden="true">
										<option value="" <?php if(!empty($_GET['service_category']) && $_GET['service_category'] == '') { echo " selected=selected "; }?> >Any Service</option>
										<?php foreach($allservice as $key => $service) {?>
												<option value="<?php echo $key; ?>" <?php if( !empty($_GET['service_category']) && in_array($key, $_GET['service_category']) ) { echo "selected=selected "; }?>><?php echo $service; ?></option>
										<?php } ?>
									</select>-->									
								</div>
								
								<div class="col-md-2 col-sm-12" style="margin-top: 20px !important;">
									<div class="clearfix">
										<button type="submit" class="button"><i class="fa fa-search" style="display: none;"></i>Search</button>
									</div>
								</div>
									
							</div>				
						</div>
					</form>					
				</div><!-- end of .classic-filter-row -->
				
				<?php if( $_GET['ca_location'] || $_GET['stm_lat'] || $_GET['stm_lng'] || $_GET['stm_distance'] || $_GET['service_category'] ){ ?>
				<div class="stm-ajax-row" style="margin-bottom: 20px;">
					
					<div id="listings-result">
							<?php 
							$args = array(
							  'meta_query' => array(
								'relation' => 'AND',
								array(
									'key'     => 'dealer_user_type',
									'value'   => array('service_provider','dealer_service_provider'),
									'compare' => 'IN'
								)
								

							)  
						  );

							if(!empty($_GET['user_type'])){
								$args['meta_query'][] = array(
									'key'     => 'THrtRcapabilities',
									'value'   => 'dealerships',
									'compare' => 'LIKE'
								);

							}
							
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
							
							$current_location   ='';
							$distance_user_filter = array();
							$none_dealer_users_prelist = get_users( $args );
						//echo "+++".count($none_dealer_users_prelist)."<br>";
							
							foreach ($none_dealer_users_prelist as $key => $none_dealer_user) {
								$distance = 10000000;
								$userlat =  get_user_meta($none_dealer_user->ID,'stm_dealer_location_lat',true);
								$userlng =  get_user_meta($none_dealer_user->ID,'stm_dealer_location_lng',true);
								
								/*Add distance away*/

								if ( ! empty( $_GET['ca_location'] ) and ! empty( $_GET['stm_lng'] ) and ! empty( $_GET['stm_lat'] ) and ! empty( $userlat ) and ! empty( $userlng ) ) {
									$distance   = stm_calculate_distance_between_two_points( floatval( $_GET['stm_lat'] ), floatval( floatval( $_GET['stm_lng'] ) ), $userlat, $userlng );
									
								//echo "id: ".$none_dealer_user->ID."    dist: ".$distance."<br>";
									
									$current_location                                 = explode( ',', sanitize_text_field( $_GET['ca_location'] ) );
									$current_location                                 = $current_location[0];
									

									
								}
								
								if(!empty($_GET['stm_distance'])){

									$stm_distance = $_GET['stm_distance'];
													//var_dump($user_list[ $user_id ]['fields']['distance']);
									
									if(floatval($distance) > $stm_distance){
										$distance_user_filter[] = $none_dealer_user->ID;
									}
								}


							}
							
					//print_r($distance_user_filter);
							
							$args['exclude'] = $distance_user_filter;
							$none_dealer_users = get_users( $args );
							$total_users =   count($none_dealer_users);
				//echo "<br>+++".$total_users."<br>";


							$number = get_option('posts_per_page');
							$number = 25;

							$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

							$offset = ($paged - 1) * $number;

							

							$args['number'] = $number;
							$args['offset'] = $offset;

							$none_dealer_users = get_users( $args );

							if(count($none_dealer_users) == 0){
								echo  "No Service Provider found";
							}
							else{
								echo "<hr/>";
								echo "<h3>Results</h3>";

							}
							foreach ($none_dealer_users as $key => $none_dealer_user) {
				# code...
								$userimg = get_user_meta($none_dealer_user->ID,'stm_dealer_image',true);
								if(empty($userimg)){
									$userimg = "https://hd-central.com/wp-content/themes/motors-child/assets/images/empty_dealer_logo.png";
								}

								?>
							<div class="stm-isotope-sorting stm-isotope-sorting-list list_user_id_<?php echo $none_dealer_user->ID; ?>">
									<div class="listing-list-loop stm-listing-directory-list-loop stm-isotope-listing-item ">
										<div class="image">
											<!--Hover blocks-->


											<a href="<?php echo get_author_posts_url($none_dealer_user->ID); ?>" class="rmv_txt_drctn">
												<div class="image-inner">
													<img  src="<?php echo $userimg; ?>" class="lazy img-responsive" alt=" <?php echo $none_dealer_user->first_name." ".$none_dealer_user->last_name;; ?>" style="display: block;">
												</div>
											</a>
										</div>

										<div class="content">
											<div class="meta-top">

												<!--Title-->
												<div class="title heading-font">
													<a style="display: inline-block;" href="<?php echo get_author_posts_url($none_dealer_user->ID); ?>" class="rmv_txt_drctn">
														<?php echo $none_dealer_user->first_name." ".$none_dealer_user->last_name;; ?>  </a>
														<?php 
													$user_meta=get_userdata($none_dealer_user->ID); 
													$user_roles=$user_meta->roles; 
													if (in_array("dealerships", $user_roles)){
														echo '<img style="display: inline-block;width: 35px;margin-top: -10px;" src="https://hd-central.com/wp-content/uploads/2020/07/dealership_logo.png" width="70px" />';
													}
												?>
												</div>      
												
											</div>

													<!--Item parameters-->
													<div class="meta-middle">

													  <div class="meta-middle">
														<div class="meta-middle-unit font-exists mileage">
															<div class="meta-middle-unit-top">
																<div class="icon"><i class="stm-service-icon-pin_big"></i></div>
																<div class="name">Location</div>
															</div>
															<div class="value h5">
																<?php
																	$location = get_user_meta($none_dealer_user->ID,'stm_dealer_location',true);
																	if( empty($location) || trim($location) == "," ){
																		$city = get_user_meta($none_dealer_user->ID,'billing_city',true);
																		$location = get_user_meta($none_dealer_user->ID,'billing_address_1',true). " ".$city;
																	}
																	echo $location;													
																?>
															


															<?php 
															$userlat =  get_user_meta($none_dealer_user->ID,'stm_dealer_location_lat',true);
															$userlng =  get_user_meta($none_dealer_user->ID,'stm_dealer_location_lng',true);
															
															/*Add distance away*/

															if ( ! empty( $_GET['ca_location'] ) and ! empty( $_GET['stm_lng'] ) and ! empty( $_GET['stm_lat'] ) and ! empty( $userlat ) and ! empty( $userlng ) ) {
																$distance   = stm_calculate_distance_between_two_points( floatval( $_GET['stm_lat'] ), floatval( floatval( $_GET['stm_lng'] ) ), $userlat, $userlng );
																$current_location                                 = explode( ',', sanitize_text_field( $_GET['ca_location'] ) );
																$current_location                                 = $current_location[0];
																
																echo " (".$distance.") ";
																
															}
															
															?>

														</div>

													</div>



													<div class="meta-middle-unit font-exists engine">
														<div class="meta-middle-unit-top">
															<div class="icon"><i class="stm-icon-label"></i></div>
															<div class="name">Website</div>
														</div>

														<div class="value h5">
														 <a href="<?php echo get_user_meta($none_dealer_user->ID,'stm_website_url',true); ?>">View Website </a>                         </div>
													 </div>

													 <div class="meta-middle-unit font-exists location">
														<div class="meta-middle-unit-top">
															<div class="icon"><i class="stm-service-icon-sales_phone"></i></div>
															<div class="name">Phone</div>
														</div>

														<div class="value">
															<div class="stm-tooltip-link" data-placement="bottom" title="" data-original-title="493432">
																<?php $phone =  get_user_meta($none_dealer_user->ID,'stm_phone',true); 
																if(empty($phone)){
																	$phone = get_user_meta($none_dealer_user->ID,'billing_phone',true); 
																}
																echo FormatPhone($phone);
																?>                       
															</div>
														</div>
													</div>
													<div class="meta-middle-unit meta-middle-divider"></div>


												</div>
											</div>

											<!--Item options-->
											<div class="meta-bottom">

												<div class="single-car-actions">
													<ul class="list-unstyled clearfix">


														<li class="car-action-dealer-info">
															<div class="listing-archive-dealer-info clearfix">


															 <div class="row">
																<div class="col-md-12">
																	<div class="form-group">
																		<div class="stm-label h5"><?php esc_html_e( 'Service Categories', 'motors' ); ?></div>
																		<?php 

																		$services = get_user_meta($none_dealer_user->ID,'business_category',true);
																		// print_r($services);
																		// echo "<br>";
																		
																		if(!is_array($services)){
																			$servicesarray = json_decode($services, true);  
																		}else{
																			$servicesarray = $services;
																		}								
																		// echo "+++<br>";	
																		//print_r($servicesarray);	
																		
																		foreach ($servicesarray as $key => $service) {
																			if( array_key_exists($service, $allservice) ){
																				# code...
																			?>
																			<div class="col-md-6">
																				<label>

																					<span><?php echo $allservice[$service]; ?></span>
																				</label>
																			</div>
																			<?php
																			}
																		}
																		?>
																	</div>
																</div>
															</div>
														</div>
													</li>



												</ul>
											</div>        
										</div>
									</div>
								</div>
							</div>
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
				<?php } ?>
				
			</div><!-- end of col-md-9 -->

		</div><!-- end of row2 -->	
	</div><!-- end container -->
			
<?php
	get_footer();
?>