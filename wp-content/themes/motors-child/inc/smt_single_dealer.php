<?php if(!function_exists('stm_get_single_dealer')) {
	function stm_get_single_dealer($dealer_info, $taxonomy='') {

		$dealer_cars_count = $dealer_info['cars_count'];
		$cars_count_text = esc_html__('Bikes in stock', 'motors');
		if($dealer_cars_count == 1) {
			$cars_count_text = esc_html__('Bike in stock', 'motors');
		}

		if(!empty($taxonomy)) {
			$taxonomy = $taxonomy;
		}elseif(!empty($_GET['stm_dealer_show_taxonomies'])) {
			$taxonomy = sanitize_text_field($_GET['stm_dealer_show_taxonomies']);
		} else {
			$taxonomy = '';
		}


		$taxonomy = array_filter(explode(', ',$taxonomy));
		$ratings = $dealer_info['ratings'];
		$tax_term = array();
		if(!empty($taxonomy)) {
			foreach($taxonomy as $tax) {
				$term_tax = explode(' | ', $tax);
				$tax_term[$term_tax[0]] = sanitize_title($term_tax[1]);
			}
		}

		$dealer_category_labels = array();

		$dealer_cars = $dealer_info['cars'];
		if($dealer_cars->have_posts()){
			while($dealer_cars->have_posts()){
				$dealer_cars->the_post();
				foreach($tax_term as $term => $tax) {
					$terms_all = wp_get_object_terms( get_the_ID(), $tax);
					if(!empty($terms_all)) {
						foreach ( $terms_all as $term_single ) {
							if ( $term_single->slug == $term ) {
								$dealer_category_labels[] = $term_single->name;
							}
						}
					}
				}
			}
		}
		$dealer_hd_main =  get_user_meta($dealer_info['id'],'hd_main_dealer',true);

		wp_reset_postdata();

		$dealer_category_labels = array_unique($dealer_category_labels);

		?>
			<tr class="stm-single-dealer animated fadeIn bdddddd">

				<td class="image">
					<a href="<?php echo esc_url(stm_get_author_link($dealer_info['id'])); ?>" target="_blank">
						<?php if(!empty($dealer_info['fields']['logo'])): ?>
							<img src="<?php echo esc_url($dealer_info['fields']['logo']); ?>" class="img-responsive" />
						<?php else: ?>
							<img src="<?php stm_get_dealer_logo_placeholder(); ?>" class="no-logo" />
						<?php endif; ?>
					</a>
				</td>

				<td class="dealer-info">
					<div class="title">
						<a class="h4" href="<?php echo esc_url(stm_get_author_link($dealer_info['id'])); ?>" target="_blank"><?php stm_display_user_name($dealer_info['id']); ?> <?php if($dealer_hd_main == 'Yes'){?><img class="hd_main_dealer" style="width: 25px;height: 25px;" src="<?php echo get_stylesheet_directory_uri()."/assets/images/hd_main_dealer.png"?>" /> <?php }?></a>
					</div>
					<div class="rating">
						<div class="dealer-rating">
							<div class="stm-rate-unit">
								<div class="stm-rate-inner">
									<div class="stm-rate-not-filled"></div>
									<?php if(!empty($ratings['average_width'])): ?>
										<div class="stm-rate-filled" style="width:<?php echo esc_attr($ratings['average_width']); ?>"></div>
									<?php else: ?>
										<div class="stm-rate-filled" style="width:0%"></div>
									<?php endif; ?>
								</div>
							</div>
							<div class="stm-rate-sum">(<?php esc_html_e('Reviews', 'motors'); ?> <?php echo esc_attr($ratings['count']); ?>)</div>
						</div>
					</div>
				</td>

				<td class="dealer-cars">
					<div class="inner">
						<a href="<?php echo esc_url(stm_get_author_link($dealer_info['id'])); ?>#stm_d_inv" target="_blank">
							<div class="dealer-labels heading-font">
								<?php echo intval($dealer_cars_count); ?>
								<?php if(!empty($dealer_category_labels)):
									echo esc_attr(implode('/', $dealer_category_labels));
								endif; ?>
							</div>
							<div class="dealer-cars-count">
								<i class="stm-moto-icon-motorcycle"></i>
								<?php echo esc_attr($cars_count_text); ?>
							</div>
						</a>
					</div>
				</td>

				<td class="dealer-phone">
					<div class="inner">
						<?php if(!empty($dealer_info['fields']['phone'])): ?>
							<?php $showNumber = get_theme_mod("stm_show_number", false); ?>
							<?php if($showNumber ) : ?>
								<div class="phone heading-font">
									<i class="stm-service-icon-phone_2"></i>
									<?php echo esc_attr($dealer_info['fields']['phone']); ?>
								</div>
							<?php else : ?>
								<i class="stm-service-icon-phone_2"></i>
								<div class="phone heading-font">
									<?php echo substr_replace($dealer_info['fields']['phone'], "*******", 3, strlen($dealer_info['fields']['phone'])); ?>
								</div>
								<span class="stm-show-number" data-id="<?php echo esc_attr($dealer_info['id']); ?>"><?php echo esc_html__("Show number", "motors"); ?></span>
							<?php endif; ?>
						<?php endif; ?>
					</div>
				</td>


				<td class="dealer-location">
					<div class="clearfix">
						<?php if(!empty($dealer_info['fields']['location']) and !empty($dealer_info['fields']['location_lat']) and !empty($dealer_info['fields']['location_lng'])): ?>
							<a
								href="https://maps.google.com?q=<?php echo esc_attr($dealer_info['fields']['location']); ?>"
								target="_blank"
								class="map_link"
							>
								<i class="fa fa-external-link"></i>
								<?php esc_html_e('See map', 'motors'); ?>
							</a>
						<?php endif; ?>
						<div class="dealer-location-label">
							<?php if(!empty($dealer_info['fields']['distance'])): ?>
								<div class="inner">
									<i class="stm-service-icon-pin_big"></i>
									<span class="heading-font"><?php echo esc_attr($dealer_info['fields']['distance']); ?></span>
									<?php if(!empty($dealer_info['fields']['user_location'])): ?>
										<div class="stm-label"><?php esc_html_e('From', 'motors'); echo ' ' . $dealer_info['fields']['user_location']; ?></div>
									<?php endif; ?>
								</div>
							<?php elseif(!empty($dealer_info['fields']['location'])): ?>
								<div class="inner">
									<i class="stm-service-icon-pin_big"></i>
									<span class="heading-font"><?php echo esc_attr($dealer_info['fields']['location']); ?></span>
								</div>
							<?php else: ?>
								<?php esc_html_e('N/A', 'motors'); ?>
							<?php endif; ?>
						</div>
					</div>
				</td>

			</tr>
			<tr class="dealer-single-divider"><td colspan="5"></td></tr>
		<?php
	}
} 




	function stm_get_filtered_dealers($offset = 0, $per_page = 12) {

        $offset = intval($offset);
		$per_page = intval($per_page);

		$title = esc_html__('Displaying Local Bike Dealerships', 'motors');
		global $wpdb;

		$lat = '';
		$lon = '';
		$stm_distance = '10000000';
		$user_idlist= array();
		if(!empty($_REQUEST['stm_lat']) && !empty($_REQUEST['stm_lng'])){

					/*print_r($_REQUEST);
					$lat = $_REQUEST['stm_lat'];
					$lon = $_REQUEST['stm_lng'];
					if(!empty($_REQUEST['stm_distance'])){
					$stm_distance = $_REQUEST['stm_distance'];
					}
					$query = "select p.ID, lat.meta_value AS user_lat, lon.meta_value AS user_lon,
					111.111 *
					DEGREES(ACOS(COS(RADIANS(".$lat."))
						* COS(RADIANS(lat.meta_value))
						* COS(RADIANS(lon.meta_value - ".$lon."))
						+ SIN(RADIANS(".$lat."))
						* SIN(RADIANS(lat.meta_value))
								)
							)AS dist
					from THrtRusers p
					left join THrtRusermeta lat on lat.user_id = p.ID and lat.meta_key = 'stm_dealer_location_lat'
					left join THrtRusermeta lon on lon.user_id = p.ID and lon.meta_key = 'stm_dealer_location_lng'
					where (lat.meta_value IS NOT NULL and lat.meta_value != '' ) and  (lon.meta_value IS NOT NULL and lon.meta_value != '' ) having dist < ".$stm_distance."
					ORDER BY dist";	
					echo $query;

					$result = $wpdb->get_results($query);
						if( count($result) > 0 ){
							foreach($result as $user_data){
								$user_idlist[$user_data->ID]  = $user_data->dist;

							}
						}
					print_r($user_idlist);*/
		
		}

		/*Get only dealers*/
		$user_args = array( 'role' => 'stm_dealer', 'fields' => 'all' );

		if(!empty($_GET['dealer_keyword'])) {
			$user_args['meta_query'][] = array(
				'meta_key' => 'stm_company_name',
				'value' => sanitize_text_field($_GET['dealer_keyword']),
				'compare' => 'LIKE'
			);
		}


		if(!empty($_GET['dealer_type'])) {
			$user_args['meta_query'][] = array(
				'meta_key' => 'hd_main_dealer',
				'value' => 'Yes',
				'compare' => '='
			);
		}
		$user_args['meta_query'][] = array(
				'meta_key' => 'dealer_user_type',
				'value' => array('dealer','dealer_service_provider'),
				'compare' => 'IN'
			);
		
		


		if( isset($_GET['stm_sort_by']) && $_GET['stm_sort_by'] == 'alphabet' ) {
		    $user_args['order'] = 'ASC';
		    $user_args['meta_key'] = 'stm_company_name';
		    $user_args['orderby'] = 'meta_value';

        }

		$user_query = new WP_User_Query( $user_args );
		$user_query = $user_query->get_results();

		/*Get cars from get: model, etc*/
		$filter_accept = array();
		$users_cars = array();

		if(!empty($_GET)) {
			foreach($_GET as $tax => $term) {
				if(term_exists(sanitize_title($term), sanitize_title($tax))) {
					$filter_accept[sanitize_title($tax)] = sanitize_title($term);
				}
			}
		}

		if(!empty($filter_accept)) {
			$car_args_tax = array(
				'relation' => 'AND'
			);
			foreach($filter_accept as $filter_tax => $filter_term) {
				$car_args_tax[] = array(
					'taxonomy' => $filter_tax,
					'field'    => 'slug',
					'terms' => array($filter_term)
				);
			}

			$car_args = array(
				'post_type'      => stm_listings_post_type(),
				'posts_per_page' => '-1',
				'tax_query'      => $car_args_tax
			);

			$cars = new WP_Query($car_args);

			if($cars->have_posts()){
				while($cars->have_posts()) {
					$cars->the_post();
					$stm_car_user = get_post_meta(get_the_ID(), 'stm_car_user', true);
					$users_cars[] = $stm_car_user;
				}
				wp_reset_postdata();
			}
		}

		$users_cars = array_unique($users_cars);

		$user_list = array();

		/*Generate output array*/
		if(!empty($user_query)){
			foreach($user_query as $user) {
				$user_id = $user->ID;
				if(!empty($user_id)) {
					if(!empty($filter_accept)) {
						if(in_array($user_id, $users_cars)) {
							$user_data = get_userdata($user_id);
							if(!empty($user_data->data->user_registered)) {
								$user_list[ $user_id ] ['registered'] = $user_data->data->user_registered;
							}

							$dealer_cars = (function_exists('stm_user_listings_query')) ? stm_user_listings_query( $user_id ) : null;

							/*Get views*/
							$total = 0;
							if($dealer_cars != null && $dealer_cars->have_posts()) {
								while($dealer_cars->have_posts()) {
									$dealer_cars->the_post();
									$views = get_post_meta(get_the_id(), 'stm_car_views', true);
									if(!empty($views)) {
										$total +=$views;
									}
								}
								wp_reset_postdata();
							}

							$user_list[ $user_id ]['car_views']   = $total;

							$user_list[ $user_id ]['id']         = $user_id;
							$user_list[ $user_id ]['cars']       = (function_exists('stm_user_listings_query')) ? $dealer_cars : array();
							$user_list[ $user_id ]['cars_count'] = (function_exists('stm_user_listings_query')) ? $dealer_cars->found_posts : 0;
							$user_list[ $user_id ]['fields']     = stm_get_user_custom_fields( $user_id );
							$user_list[ $user_id ]['ratings']    = stm_get_dealer_marks( $user_id );

							/*Add distance away*/
							if ( ! empty( $_GET['ca_location'] ) and ! empty( $_GET['stm_lng'] ) and ! empty( $_GET['stm_lat'] ) and ! empty( $user_list[ $user_id ]['fields']['location_lat'] ) and ! empty( $user_list[ $user_id ]['fields']['location_lng'] ) ) {
								$distance                                         = stm_calculate_distance_between_two_points( floatval( $_GET['stm_lat'] ), floatval( floatval( $_GET['stm_lng'] ) ), $user_list[ $user_id ]['fields']['location_lat'], $user_list[ $user_id ]['fields']['location_lng'] );
								$user_list[ $user_id ]['fields']['distance']      = $distance;
								$current_location                                 = explode( ',', sanitize_text_field( $_GET['ca_location'] ) );
								$current_location                                 = $current_location[0];
								$user_list[ $user_id ]['fields']['user_location'] = $current_location;
							}
						}
					} else {
						$user_data = get_userdata($user_id);
						if(!empty($user_data->data->user_registered)) {
							$user_list[ $user_id ] ['registered'] = $user_data->data->user_registered;
						}

                        $dealer_cars = (function_exists('stm_user_listings_query')) ? stm_user_listings_query( $user_id ) : null;

						/*Get views*/
						$total = 0;
						if($dealer_cars != null && $dealer_cars->have_posts()) {
							while($dealer_cars->have_posts()) {
								$dealer_cars->the_post();
								$views = get_post_meta(get_the_id(), 'stm_car_views', true);
								if(!empty($views)) {
									$total +=$views;
								}
							}
							wp_reset_postdata();
						}

						$user_list[ $user_id ]['car_views']   = $total;
						$user_list[ $user_id ]['id']         = $user_id;
                        $user_list[ $user_id ]['cars']       = (function_exists('stm_user_listings_query')) ? $dealer_cars : array();
                        $user_list[ $user_id ]['cars_count'] = (function_exists('stm_user_listings_query')) ? $dealer_cars->found_posts : 0;
						$user_list[ $user_id ]['fields']     = stm_get_user_custom_fields( $user_id );
						$user_list[ $user_id ]['ratings']    = stm_get_dealer_marks( $user_id );


						/*Add distance away*/
						if ( ! empty( $_GET['ca_location'] ) and ! empty( $_GET['stm_lng'] ) and ! empty( $_GET['stm_lat'] ) and ! empty( $user_list[ $user_id ]['fields']['location_lat'] ) and ! empty( $user_list[ $user_id ]['fields']['location_lng'] ) ) {
							$distance                                         = stm_calculate_distance_between_two_points( floatval( $_GET['stm_lat'] ), floatval( floatval( $_GET['stm_lng'] ) ), $user_list[ $user_id ]['fields']['location_lat'], $user_list[ $user_id ]['fields']['location_lng'] );
							$user_list[ $user_id ]['fields']['distance']      = $distance;
							$current_location                                 = explode( ',', sanitize_text_field( $_GET['ca_location'] ) );
							$current_location                                 = $current_location[0];
							$user_list[ $user_id ]['fields']['user_location'] = $current_location;
						}

					}
					if(!empty($_REQUEST['stm_distance'])){
							
							$stm_distance = $_REQUEST['stm_distance'];
								//var_dump($user_list[ $user_id ]['fields']['distance']);
							if($user_list[ $user_id ]['fields']['distance'] > $stm_distance || empty($user_list[ $user_id ]['fields']['distance'])){
								unset($user_list[$user_id]);
							}
						}
				}
			}
		}


		$location_pretty = '';
		if(!empty($_GET['ca_location'])) {
			$location_pretty = explode(',', $_GET['ca_location']);
			if(!empty($location_pretty[0])) {
				$location_pretty = $location_pretty[0];
			}
		}

		/*Sort by popularity*/
		if(!empty($_GET['ca_location']) and !empty($_GET['stm_lng']) and !empty($_GET['stm_lat'])) {
			usort( $user_list, 'stm_sort_distance_dealers' );
			$title = esc_html__('Displaying Dealerships near', 'motors') . ' <span class="green">' . $location_pretty . '</span>';
		} else {
			if(!empty($_GET['stm_sort_by'])) {
				$sort_type = sanitize_title($_GET['stm_sort_by']);
				if(function_exists('stm_sort_'.$sort_type.'_dealers')) {
                    usort($user_list, 'stm_sort_' . $sort_type . '_dealers');
                }
			} else {
				usort( $user_list, 'stm_sort_reviews_dealers' );
			}
		}

		if(!empty($filter_accept)) {
			$i = 0;
			foreach($filter_accept as $filter_tax => $filter_term) {
				$i++;
				if($i==1) {
					$name = get_term_by('slug', $filter_term, $filter_tax);
					if(!empty($name->name)) {
						if(!empty($_GET['ca_location']) and !empty($_GET['stm_lng']) and !empty($_GET['stm_lat'])) {
							$title = esc_html__( 'Displaying', 'motors' ) . ' <span class="green">' . sanitize_text_field( $name->name ) . '</span> ' . esc_html__( 'Dealerships near', 'motors' ) . ' <span class="green">' . $location_pretty . '</span>';;
						} else {
							$title = esc_html__( 'Displaying', 'motors' ) . ' <span class="green">' . sanitize_text_field( $name->name ) . '</span> ' . esc_html__( 'Dealerships', 'motors' );
						}
					}
				}
			}
		}



		$output = array_slice($user_list, $offset, $per_page);
		$button = 'hide';

		if(intval(count($user_list)) > intval(($offset + $per_page)) ) {
			$button = 'show';
		}

		$return = array(
			'user_list' => $output,
			'title' => $title,
			'button' => $button
		);

		return $return;
	}


?>