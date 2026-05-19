<?php
/**
 * Child theme functions and definations
 *
 * @author Vijay Hardaha <https://twitter.com/vijayhardaha>
 * @package HDC
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

require get_stylesheet_directory() . '/inc/smt_single_dealer.php';
require get_stylesheet_directory() . '/countries-currency.php';

function get_currency_symbol_name( $countryname ) {
	global $countriescurrency;
	foreach ( $countriescurrency as $key => $val ) {
		if ( $val['name'] == $countryname ) {
			return $val['currency_symbol'];
		}
	}
	return null;
}

function get_country_name( $countryname ) {
	global $countriescurrency;
	foreach ( $countriescurrency as $key => $val ) {
		if ( $val['name'] == $countryname ) {
			return $val['iso_alpha2'];
		}
	}
	return null;
}


add_action( 'wp_ajax_nopriv_update_user_fav', 'update_user_fav' );
add_action( 'wp_ajax_update_user_fav', 'update_user_fav' );

function update_user_fav() {
	$userid = get_current_user_id();
	if($userid){
		$provider = $_REQUEST['user_id'];
		$metakey = $_REQUEST['user_type'];
		$fav_provider = get_user_meta($userid,$metakey,true);
		if(empty($fav_provider)){
			$fav_provider = array();
		}
		if(in_array($provider,$fav_provider)){
			if (($key = array_search($provider, $fav_provider)) !== false) {
    			unset($fav_provider[$key]);
			}
			//unset($fav_provider[$provider]);
			
			update_user_meta($userid,$metakey,$fav_provider);	
			if($metakey  == 'compare_bike'){
				wp_send_json_success( 'Removed from compare' );		
			}else{
					wp_send_json_success( 'Removed from my dashboard' );		
			}
		}else{
			$fav_provider[] = $provider;
			update_user_meta($userid,$metakey,$fav_provider);			
			if($metakey  == 'compare_bike'){
				wp_send_json_success( 'Added to compare' );	
			}else{
				wp_send_json_success( 'Added to my dashboard' );
			}
			
		}
	}else{
			wp_send_json_success( 'Login to add dashboard' );
	}
    
}


function stm_enqueue_parent_styles() {
	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'stm-theme-style' ), '1.0.0' );
	wp_enqueue_style( 'author-style', get_stylesheet_directory_uri() . '/assets/css/page/author.css', array( 'stm-theme-style' ), '1.0.0' );

	

	wp_enqueue_script( 'custom-theme', get_stylesheet_directory_uri() . '/assets/js/custom-theme.js', array( 'jquery' ), '2.0.0', true );
	wp_enqueue_script( 'popper-js', get_stylesheet_directory_uri() . '/assets/js/popper.min.js', array( 'jquery' ), '1.0.0', true );
	
	wp_register_style( 'slick-style', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', array(), '', '' );
	wp_register_style( 'slick-theme-style', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css', array(), '', '' );
	wp_register_script( 'slick-js', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js' , array('jquery'), null, true );
	
	wp_enqueue_style( 'custom-css', get_stylesheet_directory_uri() . '/assets/css/custom.css', array( 'stm-theme-style' ), '37.0.0' ); 
}		
add_action( 'wp_enqueue_scripts', 'stm_enqueue_parent_styles' );

function wsl_change_default_permissons( $provider_scope, $provider ) {
	if ( 'facebook' == strtolower( $provider ) ) { 
		$provider_scope = 'email, public_profile';
	}

	return $provider_scope;
}
add_filter( 'wsl_hook_alter_provider_scope', 'wsl_change_default_permissons', 10, 2 );

function hotspot_script() {
	if ( is_page( 26833 ) ) {
		wp_enqueue_script( 'hostpot', get_stylesheet_directory_uri() . '/assets/js/jquery.hotspot.js', array(), null, false );
		?>
		<script>
			jQuery(document).ready(function() {
				jQuery('#hotspotImg').hotSpot({
					mainselector: '#hotspotImg',
					selector: '.hot-spot',
					imageselector: '.img-responsive',
					tooltipselector: '.tooltip',
					bindselector: 'hover'
				});
			});
		</script>
		<?php
	}
}
add_action( 'wp_footer', 'hotspot_script' );

function dealer_ids_by_role() {
	$ids = get_users(
		array(
			'role'   => 'stm_dealer',
			'fields' => 'ID',
		)
	);
	return $ids;
}

function stm_listings_query_vars_new( $query_vars ) {
	$include_search = stm_listings_search_inventory();

	$is_listing = isset( $query_vars['post_type'] ) && in_array( stm_listings_post_type(), (array) $query_vars['post_type'] );

	if ( $include_search && ! empty( $_GET['s'] ) ) {
		$is_listing = true;
	}

	if ( isset( $query_vars['pagename'] ) ) {
		$listing_id = stm_listings_user_defined_filter_page();
		if ( $listing_id ) {
			$requested = get_page_by_path( $query_vars['pagename'] );
			if ( ! empty( $requested ) && $is_listing = $listing_id == $requested->ID ) {
				unset( $query_vars['pagename'] );
			}
		}
	}

	if ( ! empty( $_GET['ajax_action'] ) && $_GET['ajax_action'] == 'listings-result' ) {
		unset( $query_vars['pagename'] );
		unset( $query_vars['page_id'] );
		$is_listing = true;
	}

	if ( $is_listing && ! is_admin() && ! isset( $query_vars['listings'] ) ) {
		$meta_query = $query_vars['meta_query'];

		if ( isset( $_GET['seller_type'] ) && $_GET['seller_type'] == 'dealer' ) {
			$dealer_ids_by_role       = dealer_ids_by_role();
			$query_vars['author__in'] = $dealer_ids_by_role;
		}
		if ( isset( $_GET['seller_type'] ) && $_GET['seller_type'] == 'private' ) {
			$dealer_ids_by_role           = dealer_ids_by_role();
			$query_vars['author__not_in'] = $dealer_ids_by_role;
		}
		if ( isset( $_GET['seller_type'] ) && $_GET['seller_type'] == 'ebayforsale' ) {
			$ebayforsale              = array(
				array(
					'key'     => 'ListingType',
					'value'   => 'Auction',
					'compare' => '!=',
				),
			);
			$meta_query[]             = $ebayforsale;
			$query_vars['meta_query'] = $meta_query;

		}
		if ( isset( $_GET['seller_type'] ) && $_GET['seller_type'] == 'ebayonauction' ) {
			$ebayforsale              = array(
				array(
					'key'     => 'ListingType',
					'value'   => 'Auction',
					'compare' => '=',
				),
			);
			$meta_query[]             = $ebayforsale;
			$query_vars['meta_query'] = $meta_query;
		}

		if ( ! empty( $_REQUEST['ca_keywords'] ) ) {
			$post_in          = array();
			$ca_keywords_args = array(
				'post_type' => 'listings',
				's'         => $_REQUEST['ca_keywords'],
			);

			$custom_query = new WP_Query( $ca_keywords_args );

			if ( $custom_query->have_posts() ) {
				while ( $custom_query->have_posts() ) {
					$custom_query->the_post();
					$post_id[] = get_the_ID();
				}
			}

			wp_reset_postdata();
			$query_vars['post__in'] = $post_id;
		}
	}

	return $query_vars;
}
add_filter( 'request', 'stm_listings_query_vars_new' );

function role_exists( $role ) {
	if ( ! empty( $role ) ) {
		return $GLOBALS['wp_roles']->is_role( $role );
	}

	return false;
}

function hd_central_add_roles() {
	remove_role( 'hd_service_provider' );
	remove_role( 'hd_service_provider_dealer' );
	if ( ! role_exists( 'hd_private_seller' ) ) {
		add_role( 'hd_private_seller', 'Private Seller', get_role( 'stm_dealer' )->capabilities );
	}
	remove_role( 'dealerships' );
}
add_action( 'init', 'hd_central_add_roles' );

add_action( 'wp_head', 'update_email_provider' );
function update_email_provider() {
     if(is_author()){
          // process $_POST data here
     	$author_id = get_the_author_meta('ID');
		//echo 'ID: '.$author_id;
		//die;
				
		//echo "<pre style='display: none;'>"; print_r(get_user_meta($author_id)); echo "</pre><br>";
		
		$book_email = get_user_meta($author_id, 'book_email', true);
		//echo 'book_email: '.$book_email;
		$_GET['provider-email'] = $book_email;
		$_REQUEST['provider-email'] = $book_email;
		
		$user_email = get_user_meta($author_id, 'user_email', true);
		$_GET['contact-user-email'] = $user_email;		
		$_REQUEST['contact-user-email'] = $user_email;	
     }
	 
	 if ( is_singular( 'listings' ) ) {
		 $listing_id = get_the_ID();
		 //echo "listing_id: ".$listing_id."<br>";
		 
		 $listing_author_id = get_post_field ('post_author', $listing_id);
		 //echo "listing_author_id: ".$listing_author_id."<br>";
		 $listing_user_email = get_user_meta($listing_author_id, 'user_email', true);
		 //echo "listing_user_email: ".$listing_user_email."<br>";
		 
		 $_GET['contact-seller-email'] = $listing_user_email;		
		 $_REQUEST['contact-seller-email'] = $listing_user_email;
	 }
     
}

function so_payment_complete( $order_id ) {
	$order               = wc_get_order( $order_id );
	$business_category   = get_post_meta( $order_id, '_after_checkout_billing_form_business_category', true );
	$hd_main_dealer      = get_post_meta( $order_id, '_after_checkout_billing_form_will_be_selling_newb', true );
	$seller_shop_name    = get_post_meta( $order_id, '_after_checkout_billing_form_shop_name', true );
	$seller_shop_address = get_post_meta( $order_id, '_after_checkout_billing_form_shop_address', true );

	$user = $order->get_user();
	if ( $user ) {
		update_user_meta( $user->ID, 'business_category', $business_category, true );
		update_user_meta( $user->ID, 'hd_main_dealer', $hd_main_dealer, true );
		// do something with the user
		$items = $order->get_items();
		foreach ( $items as $item_id => $item ) {
			$product_id = $item->get_variation_id() ? $item->get_variation_id() : $item->get_product_id();
			if ( $product_id == '2992' ) {
				update_user_meta( $user->ID, 'dealer_user_type', 'service_provider', true );
			} elseif ( $product_id == '2993' ) {
				update_user_meta( $user->ID, 'dealer_user_type', 'dealer_service_provider', true );
			} elseif ( $product_id == '2991' ) {
				update_user_meta( $user->ID, 'dealer_user_type', 'dealer', true );
			} elseif ( $product_id == '6728' ) {
				// assign additional role to user
				$user = get_userdata( $user->ID );
				$user->add_role( 'wk_marketplace_seller' );

				// add userid in sellerinfo tbl
				global $wpdb;
				$query_results = $wpdb->get_results( 'SELECT * FROM THrtRmpsellerinfo WHERE user_id= ' . $user->ID . " and seller_key='role' and seller_value='seller'" );

				if ( count( $query_results ) > 0 ) {
				} else {
					$wpdb->query( "INSERT INTO THrtRmpsellerinfo(seller_id, user_id, seller_key, seller_value) VALUES( null, '" . $user->ID . "', 'role', 'seller')" );
				}

				// add shop data in usermeta
				update_user_meta( $user->ID, 'shop_name', $seller_shop_name, true );
				update_user_meta( $user->ID, 'shop_address', $seller_shop_address, true );
			}
		}
	}
}
add_action( 'woocommerce_thankyou', 'so_payment_complete' );

/**
 * Register a custom post type called "Bike Guide".
 *
 * @see get_post_type_labels() for label keys.
 */
function wpdocs_codex_bike_guide_init_callback() {
	$labels = array(
		'name'               => _x( 'Bike Guide', 'Post type general name', 'textdomain' ),
		'singular_name'      => _x( 'Bike Guide', 'Post type singular name', 'textdomain' ),
		'menu_name'          => _x( 'Bike Guide', 'Admin Menu text', 'textdomain' ),
		'name_admin_bar'     => _x( 'Bike Guide', 'Add New on Toolbar', 'textdomain' ),
		'add_new'            => __( 'Add New', 'textdomain' ),
		'add_new_item'       => __( 'Add New Bike Guide', 'textdomain' ),
		'new_item'           => __( 'New Bike Guide', 'textdomain' ),
		'edit_item'          => __( 'Edit Bike Guide', 'textdomain' ),
		'view_item'          => __( 'View Bike Guide', 'textdomain' ),
		'all_items'          => __( 'All Bike Guide', 'textdomain' ),
		'search_items'       => __( 'Search Bike Guide', 'textdomain' ),
		'parent_item_colon'  => __( 'Parent Bike Guide:', 'textdomain' ),
		'not_found'          => __( 'No Bike Guide found.', 'textdomain' ),
		'not_found_in_trash' => __( 'No Bike Guide found in Trash.', 'textdomain' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'bike_guide' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt' ),
	);

	register_post_type( 'bike_guide', $args );

}
add_action( 'init', 'wpdocs_codex_bike_guide_init_callback' );

// Add existing taxonomies to post type 'bike_guide'
function wpshout_add_taxonomies_to_bike_guide_callback() {
	register_taxonomy_for_object_type( 'make', 'bike_guide' );
	register_taxonomy_for_object_type( 'ca-year', 'bike_guide' );
}
add_action( 'init', 'wpshout_add_taxonomies_to_bike_guide_callback' );

function get_bike_details() {
	$BikeData = $_REQUEST['years'];
	$handle   = curl_init();
	$url      = 'https://api.vehiclesmart.com/rest/vehicleData?reg=' . $BikeData . '&appid=hdcentralglobal-sJRNcnwka3rjNCsNqA&isRefreshing=false&dvsaFallbackMode=false';
	curl_setopt( $handle, CURLOPT_URL, $url );
	curl_setopt( $handle, CURLOPT_RETURNTRANSFER, true );
	$output = curl_exec( $handle );
	curl_close( $handle );
	echo $output;
	die();
}
add_action( 'wp_ajax_bike_details', 'get_bike_details' );
add_action( 'wp_ajax_nopriv_bike_details', 'get_bike_details' );

// bike year change event ( get model based on year callback )
function bike_manual_year_callback() {
	$years = $_REQUEST['years'];

	$args = array(
		'post_type'      => 'manuals',
		'posts_per_page' => -1,
		'tax_query'      => array(
			array(
				'taxonomy' => 'manual_year',
				'field'    => 'id',
				'terms'    => $years,
			),
		),
	);

	$year_posts = new WP_Query( $args );
	$count_year = $year_posts->found_posts;

	$make_arr = array();
	if ( $year_posts->have_posts() ) {
		while ( $year_posts->have_posts() ) {
			$year_posts->the_post();
			$make_terms = get_the_terms( get_the_ID(), 'manual_model' );
			if ( ! empty( $make_terms ) ) {
				foreach ( $make_terms as $make ) {
					$make_arr[ $make->term_id ] = $make->name;
				}
			}
		}
	}

	$addval = '<option value="">Filter By Models</option>';
	foreach ( $make_arr as $index => $value ) {
		$addval .= '<option value="' . $index . '"> ' . $value . '</option>';
	}

	echo $addval;

	die();
}
add_action( 'wp_ajax_manual_bike_year', 'bike_manual_year_callback' );
add_action( 'wp_ajax_nopriv_manual_bike_year', 'bike_manual_year_callback' );

function wp_get_groupcat_postcount( $id ) {
	$args = array(
		'post_type'      => 'group',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'tax_query'      => array(
			'relation' => 'AND',
			array(
				'taxonomy' => 'region',
				'field'    => 'name',
				'terms'    => array( $id ),
			),
		),
	);

	$query = new WP_Query( $args );
	return (int) $query->post_count;
}

function wp_get_productcat_postcount( $id ) {
	$args = array(
		'post_type'      => 'event',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'tax_query'      => array(
			'relation' => 'AND',
			array(
				'taxonomy' => 'region',
				'field'    => 'name',
				'terms'    => array( $id ),
			),
		),
	);

	$query = new WP_Query( $args );
	return (int) $query->post_count;
}

// bike year change event ( get model based on year callback )
function bike_year_callback() {
	$years = $_REQUEST['years'];

	$args = array(
		'post_type'      => 'bike_guide',
		'posts_per_page' => -1,
		'tax_query'      => array(
			array(
				'taxonomy' => 'ca-year',
				'field'    => 'id',
				'terms'    => $years,
			),
		),
	);

	$year_posts = new WP_Query( $args );
	$count_year = $year_posts->found_posts;

	$make_arr = array();
	if ( $year_posts->have_posts() ) {
		while ( $year_posts->have_posts() ) {
			$year_posts->the_post();
			$make_terms = get_the_terms( get_the_ID(), 'make' );
			if ( ! empty( $make_terms ) ) {
				foreach ( $make_terms as $make ) {
					$make_arr[ $make->term_id ] = $make->name;
				}
			}
		}
	}

	$addval = '<option value="">Filter By Models</option>';
	foreach ( $make_arr as $index => $value ) {
		$addval .= '<option value="' . $index . '"> ' . $value . '</option>';
	}

	echo $addval;

	die();
}
add_action( 'wp_ajax_bike_year', 'bike_year_callback' );
add_action( 'wp_ajax_nopriv_bike_year', 'bike_year_callback' );

// retrieves the attachment ID from the file URL
function pippin_get_image_id( $image_url ) {
	global $wpdb;
	$attachment = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url ) );
	return $attachment[0];
}

/**
 * Custom code bike year custom
 */
function bike_year_change_custom_callback() {
	global $wpdb;

	$part_year = $_REQUEST['part_year'];

	$modelArr  = array();
	 $ym_qry   = 'SELECT DISTINCT product_model FROM ' . $wpdb->prefix . 'product_list WHERE product_year = ' . $_REQUEST['part_year'];
	$ym_result = $wpdb->get_results( $ym_qry );

	foreach ( $ym_result as $model ) {
		$modelArr[] = array( 'model' => $model->product_model );
	}

	echo json_encode( $modelArr );

	die();
}
add_action( 'wp_ajax_bike_year_change_custom', 'bike_year_change_custom_callback' );
add_action( 'wp_ajax_nopriv_bike_year_change_custom', 'bike_year_change_custom_callback' );

/**
 * Bike year custom
 */

// bike model change event ( get model range( model range = bike guide ->title ) based on model and year callback )
function bike_model_year_custom_callback() {
	global $wpdb;
	$modelArr3  = array();
	$part_year  = $_REQUEST['years'];
	$model      = $_REQUEST['model'];
	$ymr_qry    = 'SELECT DISTINCT product_range FROM ' . $wpdb->prefix . "product_list WHERE product_model = '$model' AND product_year = '$part_year'";
	$ymr_result = $wpdb->get_results( $ymr_qry );
	foreach ( $ymr_result as $model ) {
		?>
		<option value="<?php echo $model->product_range; ?>"><?php echo $model->product_range; ?></option>
		<?php
	}
	die();
}
add_action( 'wp_ajax_bike_model_year_custom1', 'bike_model_year_custom_callback' );
add_action( 'wp_ajax_nopriv_bike_model_year_custom1', 'bike_model_year_custom_callback' );


// bike year change event on add-acar page ( get model based on year )
function bike_year_change_callback() {
	$years = $_REQUEST['years'];

	$args = array(
		'post_type'      => 'bike_guide',
		'posts_per_page' => -1,
		'tax_query'      => array(
			array(
				'taxonomy' => 'ca-year',
				'field'    => 'slug',
				'terms'    => $years,
			),
		),
	);

	$year_posts = new WP_Query( $args );
	$count_year = $year_posts->found_posts;

	$make_arr = array();
	if ( $year_posts->have_posts() ) {
		while ( $year_posts->have_posts() ) {
			$year_posts->the_post();
			$make_terms = get_the_terms( get_the_ID(), 'make' );
			if ( ! empty( $make_terms ) ) {
				foreach ( $make_terms as $make ) {
					$make_arr[ $make->slug ] = $make->name;
				}
			}
		}
	}

	$addval = '<option value="">Select Model Range</option>';
	foreach ( $make_arr as $index => $value ) {
		$addval .= '<option value="' . $index . '"> ' . $value . '</option>';
	}

	echo $addval;

	die();
}
add_action( 'wp_ajax_bike_year_change', 'bike_year_change_callback' );
add_action( 'wp_ajax_nopriv_bike_year_change', 'bike_year_change_callback' );

// bike model change event ( get model range( model range = bike guide ->title ) based on model and year callback )
function bike_model_year_callback() {
	$model = $_REQUEST['model'];
	$years = $_REQUEST['years'];

	$args = array(
		'post_type'      => 'bike_guide',
		'posts_per_page' => -1,
		'tax_query'      => array(
			'relation' => 'AND',
			array(
				'taxonomy' => 'make',
				'field'    => 'slug',
				'terms'    => $model,
			),
			array(
				'taxonomy' => 'ca-year',
				'field'    => 'slug',
				'terms'    => $years,
			),
		),
	);

	$my_posts = new WP_Query( $args );
	$count_my = $my_posts->found_posts;

	$modelRange_arr = array();
	if ( $my_posts->have_posts() ) {
		while ( $my_posts->have_posts() ) {
			$my_posts->the_post();

			$modelRange_arr[ get_the_ID() ] = get_the_title();
		}
	}

	$addval = '<option value="">Select Model</option>';
	foreach ( $modelRange_arr as $index => $value ) {
		$addval .= '<option value="' . $index . '"> ' . $value . '</option>';
	}
	echo $addval;

	die();
}
add_action( 'wp_ajax_bike_model_year', 'bike_model_year_callback' );
add_action( 'wp_ajax_nopriv_bike_model_year', 'bike_model_year_callback' );

// bike model change event ( get model range( model range = bike guide ->title ) based on model and year callback )
function bike_model_range_callback() {
	$model_range = $_REQUEST['model_range'];

	$args = array(
		'post_type'      => 'bike_guide',
		'posts_per_page' => -1,
		'tax_query'      => array(
			'relation' => 'AND',
			array(
				'taxonomy' => 'make',
				'field'    => 'slug',
				'terms'    => $model,
			),
			array(
				'taxonomy' => 'ca-year',
				'field'    => 'slug',
				'terms'    => $years,
			),
		),
	);

	echo get_post_meta( $model_range, 'capacity', true );

	die();
}
add_action( 'wp_ajax_bike_model_range', 'bike_model_range_callback' );
add_action( 'wp_ajax_nopriv_bike_model_range', 'bike_model_range_callback' );

function custom_stm_after_listing_saved( $post_id, $response, $update ) {
	$user_id = get_current_user_id();
	$user    = new WP_User( $user_id );
	$roles   = (array) $user->roles;

	$placedata = trim( get_user_meta( $user_id, 'place_categories', true ), ',' );
	if ( ! is_array( $placedata ) ) {
		$placedata = explode( ',', $placedata );
		update_user_meta( $user_id, 'place_categories', $placedata );
	}

	if ( in_array( 'stm_dealer', $roles ) ) {
		$cat_ids = array( 1892 );
	} else {
		$cat_ids = array( 1893 );
	}

	wp_set_post_terms( $post_id, $cat_ids, 'seller' );
	update_post_meta( $post_id, 'seller', $cat_ids );

	if ( isset( $_POST['is_near_by_price'] ) ) {
		update_post_meta( $post_id, 'is_near_by_price', $_POST['is_near_by_price'] );
	}
	update_post_meta( $post_id, 'model_range', $_POST['stm_f_s']['serie'] );

	$make    = get_term_by( 'slug', $_POST['stm_f_s']['make'], 'make' );
	$title   = $make->name . '&nbsp;&nbsp;' . $_POST['stm_f_s']['ca_pre_year'] . '&nbsp;&nbsp;' . get_the_title( $_POST['stm_f_s']['serie'] );
	$my_post = array(
		'ID'         => $post_id,
		'post_title' => $title,
	);

	wp_update_post( $my_post );
}
add_action( 'stm_after_listing_saved', 'custom_stm_after_listing_saved', 10, 3 );

function hook_javascript_callback() {
	?>
	<script>
		jQuery(document).ready(function() {
			jQuery(".dealerships").on("change", "input:checkbox", function() {
				jQuery("#dealerships").submit();
			});
			jQuery("#dealershipsresetofworld").on("change", "input:checkbox", function() {
				jQuery("#dealershipsresetofworld").submit();
			});
			jQuery(".service_category").change(function() {
				jQuery("#service_category_form").submit();					
			});
			jQuery(".service_parts").change(function() {
				jQuery("#service_category_form").submit();					
			});
			jQuery(".distributors").change(function() {
				jQuery("#service_category_form").submit();					
			});
		});
	</script>
	<?php
}
add_action( 'wp_footer', 'hook_javascript_callback' );

/**
 * Register custom post type called named Manuals
 */
function wpdocs_codex_manuals_init_callback() {
	$labels = array(
		'name'               => _x( 'Offers', 'Post type general name', 'recipe' ),
		'singular_name'      => _x( 'Offer', 'Post type singular name', 'recipe' ),
		'menu_name'          => _x( 'Offers', 'Admin Menu text', 'recipe' ),
		'name_admin_bar'     => _x( 'Offers', 'Add New on Toolbar', 'recipe' ),
		'add_new'            => __( 'Add New', 'recipe' ),
		'add_new_item'       => __( 'Add New Offers', 'recipe' ),
		'new_item'           => __( 'New Offer', 'recipe' ),
		'edit_item'          => __( 'Edit Offer', 'recipe' ),
		'view_item'          => __( 'View Offer', 'recipe' ),
		'all_items'          => __( 'All Offers', 'recipe' ),
		'search_items'       => __( 'Search Offers', 'recipe' ),
		'parent_item_colon'  => __( 'Parent Offers:', 'recipe' ),
		'not_found'          => __( 'No Offer found.', 'recipe' ),
		'not_found_in_trash' => __( 'No Offer found in Trash.', 'recipe' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'offers' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 20,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail' ),
	);

	register_post_type( 'offers', $args );

	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Offer Categories', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Offer category', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Offer Categories', 'textdomain' ),
		'all_items'         => __( 'All Offer Categories', 'textdomain' ),
		'parent_item'       => __( 'Parent Offer Categories', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Offer Category:', 'textdomain' ),
		'edit_item'         => __( 'Edit Offer Category', 'textdomain' ),
		'update_item'       => __( 'Update Offer Category', 'textdomain' ),
		'add_new_item'      => __( 'Add New Offer Category', 'textdomain' ),
		'new_item_name'     => __( 'New Offer Category Name', 'textdomain' ),
		'menu_name'         => __( 'Offer Category', 'textdomain' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'offer-categories' ),
	);

	register_taxonomy( 'offer-categories', array( 'offers' ), $args );



	$labels = array(
		'name'               => _x( 'Ads', 'Post type general name', 'recipe' ),
		'singular_name'      => _x( 'Ads', 'Post type singular name', 'recipe' ),
		'menu_name'          => _x( 'Ads', 'Admin Menu text', 'recipe' ),
		'name_admin_bar'     => _x( 'Ads', 'Add New on Toolbar', 'recipe' ),
		'add_new'            => __( 'Add New', 'recipe' ),
		'add_new_item'       => __( 'Add New Ads', 'recipe' ),
		'new_item'           => __( 'New Ads', 'recipe' ),
		'edit_item'          => __( 'Edit Ads', 'recipe' ),
		'view_item'          => __( 'View Ads', 'recipe' ),
		'all_items'          => __( 'All Ads', 'recipe' ),
		'search_items'       => __( 'Search Ads', 'recipe' ),
		'parent_item_colon'  => __( 'Parent Ads:', 'recipe' ),
		'not_found'          => __( 'No Ads found.', 'recipe' ),
		'not_found_in_trash' => __( 'No Ads found in Trash.', 'recipe' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'ads' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 20,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail' ),
	);

	register_post_type( 'ads', $args );

	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Ads Group', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Ads Group', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Ads Group', 'textdomain' ),
		'all_items'         => __( 'All Ads Group', 'textdomain' ),
		'parent_item'       => __( 'Parent Ads Group', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Ads Group:', 'textdomain' ),
		'edit_item'         => __( 'Edit Ads Group', 'textdomain' ),
		'update_item'       => __( 'Update Ads Group', 'textdomain' ),
		'add_new_item'      => __( 'Add New Ads Group', 'textdomain' ),
		'new_item_name'     => __( 'New Ads Group Name', 'textdomain' ),
		'menu_name'         => __( 'Ads Group', 'textdomain' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'ads-groups' ),
	);

	register_taxonomy( 'ads-groups', array( 'ads' ), $args );


	$labels = array(
		'name'               => _x( 'Manuals', 'Post type general name', 'recipe' ),
		'singular_name'      => _x( 'Manual', 'Post type singular name', 'recipe' ),
		'menu_name'          => _x( 'Manuals', 'Admin Menu text', 'recipe' ),
		'name_admin_bar'     => _x( 'Manuals', 'Add New on Toolbar', 'recipe' ),
		'add_new'            => __( 'Add New', 'recipe' ),
		'add_new_item'       => __( 'Add New Manual', 'recipe' ),
		'new_item'           => __( 'New Manual', 'recipe' ),
		'edit_item'          => __( 'Edit Manual', 'recipe' ),
		'view_item'          => __( 'View Manual', 'recipe' ),
		'all_items'          => __( 'All Manuals', 'recipe' ),
		'search_items'       => __( 'Search Manuals', 'recipe' ),
		'parent_item_colon'  => __( 'Parent Manuals:', 'recipe' ),
		'not_found'          => __( 'No manuals found.', 'recipe' ),
		'not_found_in_trash' => __( 'No manuals found in Trash.', 'recipe' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'manuals' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 20,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail' ),
	);

	register_post_type( 'manuals', $args );

	// taxonomy
	$labels = array(
		'name'              => _x( 'Manual Type', 'taxonomy general name' ),
		'singular_name'     => _x( 'Manual Type', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Manual Type' ),
		'all_items'         => __( 'All Manual Type' ),
		'parent_item'       => __( 'Parent Manual Type' ),
		'parent_item_colon' => __( 'Parent Manual Type:' ),
		'edit_item'         => __( 'Edit Manual Type' ),
		'update_item'       => __( 'Update Manual Type' ),
		'add_new_item'      => __( 'Add New Manual Type' ),
		'new_item_name'     => __( 'New Manual Type Name' ),
		'menu_name'         => __( 'Manual Type' ),
	);

	register_taxonomy(
		'manual_type',
		array( 'manuals' ),
		array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'manual_type' ),
		)
	);

	// taxonomy
	$labels = array(
		'name'              => _x( 'Manual Type', 'taxonomy general name' ),
		'singular_name'     => _x( 'Manual Type', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Manual Type' ),
		'all_items'         => __( 'All Manual Type' ),
		'parent_item'       => __( 'Parent Manual Type' ),
		'parent_item_colon' => __( 'Parent Manual Type:' ),
		'edit_item'         => __( 'Edit Manual Type' ),
		'update_item'       => __( 'Update Manual Type' ),
		'add_new_item'      => __( 'Add New Manual Type' ),
		'new_item_name'     => __( 'New Manual Type Name' ),
		'menu_name'         => __( 'Manual Type' ),
	);

	register_taxonomy(
		'manual_year',
		array( 'manuals' ),
		array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'manual_year' ),
		)
	);

	// taxonomy
	$labels = array(
		'name'              => _x( 'Manual Year', 'taxonomy general name' ),
		'singular_name'     => _x( 'Manual Type', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Manual Year' ),
		'all_items'         => __( 'All Manual Year' ),
		'parent_item'       => __( 'Parent Manual Year' ),
		'parent_item_colon' => __( 'Parent Manual Year:' ),
		'edit_item'         => __( 'Edit Manual Year' ),
		'update_item'       => __( 'Update Manual Year' ),
		'add_new_item'      => __( 'Add New Manual Year' ),
		'new_item_name'     => __( 'New Manual Year Name' ),
		'menu_name'         => __( 'Manual Year' ),
	);

	register_taxonomy(
		'manual_year',
		array( 'manuals' ),
		array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'manual_year' ),
		)
	);

	// taxonomy
	$labels = array(
		'name'              => _x( 'Manual Model', 'taxonomy general name' ),
		'singular_name'     => _x( 'Manual Model', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Manual Model' ),
		'all_items'         => __( 'All Manual Model' ),
		'parent_item'       => __( 'Parent Manual Model' ),
		'parent_item_colon' => __( 'Parent Manual Model:' ),
		'edit_item'         => __( 'Edit Manual Model' ),
		'update_item'       => __( 'Update Manual Model' ),
		'add_new_item'      => __( 'Add New Manual Model' ),
		'new_item_name'     => __( 'New Manual Model Name' ),
		'menu_name'         => __( 'Manual Model' ),
	);

	register_taxonomy(
		'manual_model',
		array( 'manuals' ),
		array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'manual_model' ),
		)
	);

	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Place Categories', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Place category', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Place Categories', 'textdomain' ),
		'all_items'         => __( 'All Place Categories', 'textdomain' ),
		'parent_item'       => __( 'Parent Place Categories', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Place Category:', 'textdomain' ),
		'edit_item'         => __( 'Edit Place Category', 'textdomain' ),
		'update_item'       => __( 'Update Place Category', 'textdomain' ),
		'add_new_item'      => __( 'Add New Place Category', 'textdomain' ),
		'new_item_name'     => __( 'New Place Category Name', 'textdomain' ),
		'menu_name'         => __( 'Place Category' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'place-categories' ),
	);

	register_taxonomy( 'place-categories', array( 'listings' ), $args );

	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Things to do', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Things to do', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Things to do', 'textdomain' ),
		'all_items'         => __( 'All Things to do', 'textdomain' ),
		'parent_item'       => __( 'Parent Things to do', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Things to do:', 'textdomain' ),
		'edit_item'         => __( 'Edit Things to do', 'textdomain' ),
		'update_item'       => __( 'Update Things to do', 'textdomain' ),
		'add_new_item'      => __( 'Add New Things to do', 'textdomain' ),
		'new_item_name'     => __( 'New Place Things to do', 'textdomain' ),
		'menu_name'         => __( 'Things to do' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'things_to_do' ),
	);

	register_taxonomy( 'things_to_do', array( 'listings' ), $args );

	$labels = array(
		'name'               => _x( 'Event', 'Post type general name', 'textdomain' ),
		'singular_name'      => _x( 'Event', 'Post type singular name', 'textdomain' ),
		'menu_name'          => _x( 'Event', 'Admin Menu text', 'textdomain' ),
		'name_admin_bar'     => _x( 'Event', 'Add New on Toolbar', 'textdomain' ),
		'add_new'            => __( 'Add New', 'textdomain' ),
		'add_new_item'       => __( 'Add New Event', 'textdomain' ),
		'new_item'           => __( 'New Event', 'textdomain' ),
		'edit_item'          => __( 'Edit Event', 'textdomain' ),
		'view_item'          => __( 'View Event', 'textdomain' ),
		'all_items'          => __( 'All Event', 'textdomain' ),
		'search_items'       => __( 'Search Event', 'textdomain' ),
		'parent_item_colon'  => __( 'Parent Event:', 'textdomain' ),
		'not_found'          => __( 'No Event found.', 'textdomain' ),
		'not_found_in_trash' => __( 'No Event found in Trash.', 'textdomain' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'event' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt' ),
	);

	register_post_type( 'event', $args );

	// Add event_category taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Event Category', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Event Category', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Event Category', 'textdomain' ),
		'all_items'         => __( 'All Event Category', 'textdomain' ),
		'parent_item'       => __( 'Parent Event Category', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Event Category:', 'textdomain' ),
		'edit_item'         => __( 'Edit Event Category', 'textdomain' ),
		'update_item'       => __( 'Update Event Category', 'textdomain' ),
		'add_new_item'      => __( 'Add New Event Category', 'textdomain' ),
		'new_item_name'     => __( 'New Place Event Category', 'textdomain' ),
		'menu_name'         => __( 'Event Category' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'event_category' ),
	);

	register_taxonomy( 'event_category', array( 'event' ), $args );

	// Add event_additional_detail taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Event Additional Detail', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Event Additional Detail', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Event Additional Detail', 'textdomain' ),
		'all_items'         => __( 'All Event Additional Detail', 'textdomain' ),
		'parent_item'       => __( 'Parent Event Additional Detail', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Event Additional Detail:', 'textdomain' ),
		'edit_item'         => __( 'Edit Event Additional Detail', 'textdomain' ),
		'update_item'       => __( 'Update Event Additional Detail', 'textdomain' ),
		'add_new_item'      => __( 'Add New Event Additional Detail', 'textdomain' ),
		'new_item_name'     => __( 'New Place Event Additional Detail', 'textdomain' ),
		'menu_name'         => __( 'Event Additional Detail' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'event_additional_detail' ),
	);

	register_taxonomy( 'event_additional_detail', array( 'event' ), $args );

	// group post-type
	$labels = array(
		'name'               => _x( 'Group', 'Post type general name', 'textdomain' ),
		'singular_name'      => _x( 'Group', 'Post type singular name', 'textdomain' ),
		'menu_name'          => _x( 'Group', 'Admin Menu text', 'textdomain' ),
		'name_admin_bar'     => _x( 'Group', 'Add New on Toolbar', 'textdomain' ),
		'add_new'            => __( 'Add New', 'textdomain' ),
		'add_new_item'       => __( 'Add New Group', 'textdomain' ),
		'new_item'           => __( 'New Group', 'textdomain' ),
		'edit_item'          => __( 'Edit Group', 'textdomain' ),
		'view_item'          => __( 'View Group', 'textdomain' ),
		'all_items'          => __( 'All Groups', 'textdomain' ),
		'search_items'       => __( 'Search Group', 'textdomain' ),
		'parent_item_colon'  => __( 'Parent Group:', 'textdomain' ),
		'not_found'          => __( 'No Group found.', 'textdomain' ),
		'not_found_in_trash' => __( 'No Group found in Trash.', 'textdomain' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'group' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt' ),
	);

	register_post_type( 'group', $args );

	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Group Category', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Group Category', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Group Category', 'textdomain' ),
		'all_items'         => __( 'All Group Category', 'textdomain' ),
		'parent_item'       => __( 'Parent Group Category', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Group Category:', 'textdomain' ),
		'edit_item'         => __( 'Edit Group Category', 'textdomain' ),
		'update_item'       => __( 'Update Group Category', 'textdomain' ),
		'add_new_item'      => __( 'Add New Group Category', 'textdomain' ),
		'new_item_name'     => __( 'New Place Group Category', 'textdomain' ),
		'menu_name'         => __( 'Group Category' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'group_category' ),
	);

	register_taxonomy( 'group_category', array( 'group' ), $args );

	// Add event_additional_detail taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Group Additional Detail', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Group Additional Detail', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Group Additional Detail', 'textdomain' ),
		'all_items'         => __( 'All Group Additional Detail', 'textdomain' ),
		'parent_item'       => __( 'Parent Group Additional Detail', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Group Additional Detail:', 'textdomain' ),
		'edit_item'         => __( 'Edit Group Additional Detail', 'textdomain' ),
		'update_item'       => __( 'Update Group Additional Detail', 'textdomain' ),
		'add_new_item'      => __( 'Add New Group Additional Detail', 'textdomain' ),
		'new_item_name'     => __( 'New Place Group Additional Detail', 'textdomain' ),
		'menu_name'         => __( 'Group Additional Detail' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'group_additional_detail' ),
	);

	register_taxonomy( 'group_additional_detail', array( 'group' ), $args );
}
add_action( 'init', 'wpdocs_codex_manuals_init_callback' );

function my_acf_fields_post_object_result( $text, $post, $field, $post_id ) {
	$terms    = get_the_terms( $post->ID, 'ca-year' );
	$termname = '';
	foreach ( $terms as $term ) {
		$termname .= $term->name . '-';
	}
	$termname = trim( $termname, '-' );

	$models    = get_the_terms( $post->ID, 'make' );
	$modelname = '';
	foreach ( $models as $model ) {
		$modelname .= $model->name . '-';
	}
	$modelname = trim( $modelname, '-' );

	$text = $modelname . ' - ' . $post->post_title . ' - ' . $termname;
	return $text;
}
add_filter( 'acf/fields/post_object/result', 'my_acf_fields_post_object_result', 10, 4 );

function get_terms_by_post_type( $taxonomies, $post_types ) {
	global $wpdb;

	$query = $wpdb->prepare(
		"SELECT t.term_id, COUNT(*) ct from $wpdb->terms AS t
        INNER JOIN $wpdb->term_taxonomy AS tt ON t.term_id = tt.term_id
        INNER JOIN $wpdb->term_relationships AS r ON r.term_taxonomy_id = tt.term_taxonomy_id
        INNER JOIN $wpdb->posts AS p ON p.ID = r.object_id
        WHERE p.post_type IN('%s') AND tt.taxonomy IN('%s') AND p.post_status='publish'
        GROUP BY t.term_id",
		join( "', '", $post_types ),
		join( "', '", $taxonomies )
	);

	$results = $wpdb->get_results( $query );

	return $results;
}

function FormatPhoneNew( $phoneNumber ) {
	$phoneNumber = preg_replace( '/[^0-9]/', '', $phoneNumber );

	if ( strlen( $phoneNumber ) > 10 ) {
		$countryCode = substr( $phoneNumber, 0, strlen( $phoneNumber ) - 10 );
		$areaCode    = substr( $phoneNumber, -10, 4 );
		$nextThree   = substr( $phoneNumber, -6, 3 );
		$lastFour    = substr( $phoneNumber, -3, 3 );

		$phoneNumber = '0' . $areaCode . ' ' . $nextThree . ' ' . $lastFour;
	} elseif ( strlen( $phoneNumber ) == 10 ) {
		$areaCode  = substr( $phoneNumber, 0, 4 );
		$nextThree = substr( $phoneNumber, 4, 3 );
		$lastFour  = substr( $phoneNumber, 7, 3 );

		$phoneNumber = '0' . $areaCode . ' ' . $nextThree . ' ' . $lastFour;
	} elseif ( strlen( $phoneNumber ) == 7 ) {
		$nextThree = substr( $phoneNumber, 0, 3 );
		$lastFour  = substr( $phoneNumber, 3, 4 );

		$phoneNumber = $nextThree . '-' . $lastFour;
	}

	return $phoneNumber;
}

/**
 * Add service category checkboxes filed in user edit screen
 */
function my_custom_user_profile_fields( $user ) {
	$services      = get_user_meta( $user->ID, 'business_category', true );
	$servicesarray = json_decode( $services, true );

	$parts      = get_user_meta( $user->ID, 'service_parts', true );
	$partsarray = json_decode( $parts, true );

	$allservice = array();
	// $allservice['mot'] = "MOT";
	$allservice['service_and_repairs']       = 'Service and Repairs';
	$allservice['custom_parts_fitting']      = 'Custom Parts Fitting';
	$allservice['vehicle_recovery']          = 'Vehicle Recovery';
	$allservice['valet_service']             = 'Valet Service';
	$allservice['bike_transporting_service'] = 'Bike Transporting Service';
	$allservice['custom_fabrication']        = 'Custom Fabrication';
	$allservice['custom_paint_service']      = 'Custom Paint Service';
	$allservice['valet_service']             = 'Valet Service';
	$allservice['bike_recovery_service']     = 'Bike Recovery Service';
	// $allservice['custom_fabrication'] = "Custom Fabrication";
	$allservice['electrical']                = 'Electrical';
	$allservice['tyre_fitting']              = 'Tyre Fitting';
	$allservice['tyre_sales']                = 'Tyre Sales';
	$allservice['custom_seats_n_upholstery'] = 'Custom Seats and Upholstery';
	$allservice['mobile_mechanic']           = 'Mobile Mechanic';
	$allservice['accident_legal_advice']     = 'Accident Legal Advice';
	$allservice['riding_lessons']            = 'Riding Lessons';
	$allservice['stripped_bolt_removal']     = 'Stripped bolt removal';
	$allservice['harley-davidson_rentals']   = 'Harley - Davidson Rentals';

	$parts_terms = get_terms(
		array(
			'taxonomy'   => 'parts',
			'hide_empty' => false,
		)
	);

	?>

	<div class="panel panel-default pannel-outer-heading" style="display: none;">
		<div class="panel-heading d-flex">
			<h2>Available Parts Categories</h2>
		</div>
		<div class="panel-body panel-content-padding">
			<div class="form-group d-flex align-items-center mb-0">
				<label class="control-label col-sm-2 mb-0">Categories</label>
				<div class="col-md-10 col-sm-10">

					<div class="row align-items-center">
						<div class="col-md-12">
							<?php foreach ( $allservice as $key => $service ) { ?>
								<div class="col-md-4">
									<label>
										<input type="checkbox" name="service_category[]" value="<?php echo $key; ?>" 
																										   <?php
																											if ( in_array( $key, $servicesarray ) ) {
																																  echo "checked='checked'";
																											}
																											?>
																														>
										<?php echo $service; ?>
									</label>
								</div>
							<?php } ?>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="panel panel-default pannel-outer-heading">
		<div class="panel-heading d-flex">
			<h2>Available Parts and Accessories Categories</h2>
		</div>
		<div class="panel-body panel-content-padding">
			<div class="form-group d-flex align-items-center mb-0">
				<label class="control-label col-sm-2 mb-0">Categories</label>
				<div class="col-md-10 col-sm-10">

					<div class="row align-items-center">
						<div class="col-md-12">
							<?php foreach ( $parts_terms as $parts ) { ?>
								<div class="col-md-4">
									<label>
										<input type="checkbox" name="service_parts[]" value="<?php echo $parts->name; ?>" 
																										<?php
																										if ( in_array( $parts->name, $partsarray ) ) {
																																echo "checked='checked'";
																										}
																										?>
																															>
										<?php echo $parts->name; ?>
									</label>
								</div>
							<?php } ?>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>

	<?php
}
// add_action('edit_user_profile', 'my_custom_user_profile_fields');
// add_action('show_user_profile', 'my_custom_user_profile_fields');

/**
 * save service category checkboxes filed in database
 */
function save_custom_user_profile_fields( $user_id ) {
	if ( ! current_user_can( 'edit_user', $user_id ) ) {
		return false;
	}

	$custom_user_meta = get_user_meta( $user_id, 'billing_country', true );

	if ( ! empty( $custom_user_meta ) ) {
		// Get country name
		$country_name = WC()->countries->countries[ $custom_user_meta ];
		update_user_meta( $user_id, 'billing_country', $country_name );
	}

	if ( isset( $_POST['service_category'] ) ) {
		$servicedata = json_encode( $_POST['service_category'] );
		update_user_meta( $user_id, 'business_category', $servicedata );
	} else {
		update_user_meta( $user_id, 'business_category', '' );
	}

	if ( isset( $_POST['service_parts'] ) ) {
		$partdata = json_encode( $_POST['service_parts'] );
		update_user_meta( $user_id, 'service_parts', $partdata );
	} else {
		update_user_meta( $user_id, 'service_parts', '' );
	}
}
add_action( 'personal_options_update', 'save_custom_user_profile_fields' );
add_action( 'edit_user_profile_update', 'save_custom_user_profile_fields' );

/**
 * Auto login after registration.
 */
function wpc_gravity_registration_autologin( $user_id, $user_config, $entry, $password ) {
	
	$user          = get_userdata( $user_id );
	$user_login    = $user->user_login;
	$user_email = $user->user_email;
	$user_password = $password;
	$first_name = $user->first_name;
	$last_name = $user->last_name;
	wp_signon(
		array(
			'user_login'    => $user_login,
			'user_password' => $user_password,
			'remember'      => false,
		)
	);

	$placedata = trim( get_user_meta( $user_id, 'place_categories', true ), ',' );
	if ( ! is_array( $placedata ) ) {
		$placedata = explode( ',', $placedata );
		update_user_meta( $user_id, 'place_categories', $placedata );
	}

	/***** get data for formid:3 */
	$form_id = get_user_meta( $user_id, 'form_id', true );

	// get entry data by entry-id
	$entry_id = get_user_meta( $user_id, 'entry_id', true );
	$entry    = GFAPI::get_entry( $entry_id );

	// for gravity-form-id: 2 & gravity-form-id: 3
	// save photoes to usermeta
	if ( ! empty( $entry['32'] ) ) {
		update_user_meta( $user_id, 'stm_photoes', $entry['32'] );
	}

	// add 'dealerships' role to user if 'Harley Davidson Main dealer' is 'YES'
	if ( ! empty( $entry['9'] ) && $entry['9'] == 'Yes' ) {
		$commonRole = new WP_User( $user_id );
		$commonRole->add_role( 'dealerships' );
	}

	// save services as 'business_category' metakey
	$serviceArr = array();
	$servicedata ="";
	if ( ! empty( $entry['27.1'] ) ) {
		$serviceArr[] = $entry['27.1'];
	}
	if ( ! empty( $entry['27.2'] ) ) {
		$serviceArr[] = $entry['27.2'];
	}
	if ( ! empty( $entry['27.3'] ) ) {
		$serviceArr[] = $entry['27.3'];
	}
	if ( ! empty( $entry['27.4'] ) ) {
		$serviceArr[] = $entry['27.4'];
	}
	if ( ! empty( $entry['27.5'] ) ) {
		$serviceArr[] = $entry['27.5'];
	}
	if ( ! empty( $entry['27.6'] ) ) {
		$serviceArr[] = $entry['27.6'];
	}
	if ( ! empty( $entry['27.7'] ) ) {
		$serviceArr[] = $entry['27.7'];
	}
	if ( ! empty( $entry['27.8'] ) ) {
		$serviceArr[] = $entry['27.8'];
	}
	if ( ! empty( $entry['27.9'] ) ) {
		$serviceArr[] = $entry['27.9'];
	}
	if ( ! empty( $entry['27.11'] ) ) {
		$serviceArr[] = $entry['27.11'];
	}
	if ( ! empty( $entry['27.12'] ) ) {
		$serviceArr[] = $entry['27.12'];
	}
	if ( ! empty( $entry['27.13'] ) ) {
		$serviceArr[] = $entry['27.13'];
	}
	if ( ! empty( $entry['27.14'] ) ) {
		$serviceArr[] = $entry['27.14'];
	}
	if ( ! empty( $entry['27.15'] ) ) {
		$serviceArr[] = $entry['27.15'];
	}
    if ( ! empty( $entry['27.16'] ) ) {
        $serviceArr[] = $entry['27.16'];
    }
    if ( ! empty( $entry['27.17'] ) ) {
        $serviceArr[] = $entry['27.17'];
    }
    if ( ! empty( $entry['27.18'] ) ) {
        $serviceArr[] = $entry['27.18'];
    }
    if ( ! empty( $entry['27.19'] ) ) {
        $serviceArr[] = $entry['27.19'];
    }
    if ( ! empty( $entry['27.20'] ) ) {
        $serviceArr[] = $entry['27.20'];
    }
    if ( ! empty( $entry['27.21'] ) ) {
        $serviceArr[] = $entry['27.21'];
    }
    if ( ! empty( $entry['27.22'] ) ) {
        $serviceArr[] = $entry['27.22'];
    }
    if ( ! empty( $entry['27.23'] ) ) {
        $serviceArr[] = $entry['27.23'];
    }
    
    $entrydata = json_encode( $entry);
    update_user_meta( $user_id, 'entrydata', $entrydata );
	if ( ! empty( $serviceArr ) ) {
		$servicedata = json_encode( $serviceArr );
		update_user_meta( $user_id, 'business_category', $servicedata );
	} else {
		update_user_meta( $user_id, 'business_category', '' );
	}

	// for gravity-form-id: 14
	if ( ! empty( $form_id ) && $form_id == 'Personal subscriber' ) {
		// assign vendor role
		$theUser = new WP_User( $user_id );
		$theUser->add_role( 'dc_vendor' );

		// get city, lat, long from address
		if ( ! empty( $entry['30'] ) ) {
			$data_arr = geocode_from_address( $entry['30'] );

			// if able to geocode the address
			if ( $data_arr ) {
				$latitude    = $data_arr[0];
				$longitude   = $data_arr[1];
				$add1        = $data_arr[2];
				$add2        = $data_arr[3];
				$city        = $data_arr[4];
				$state       = $data_arr[5];
				$country     = $data_arr[6];
				$countryCode = $data_arr[7];
				$postal_code = $data_arr[8];

				update_user_meta( $user_id, 'billing_address_1', $add1 );
				update_user_meta( $user_id, 'billing_address_2', $add2 );
				update_user_meta( $user_id, 'billing_city', $city );
				update_user_meta( $user_id, 'billing_state', $state );
				update_user_meta( $user_id, 'billing_country', $country );
				update_user_meta( $user_id, 'billing_postal_code', $postal_code );
				update_user_meta( $user_id, 'stm_dealer_location_lat', $latitude );
				update_user_meta( $user_id, 'stm_dealer_location_lng', $longitude );
			}
		}
	}

	// for gravity-form-id: 15
	if ( ! empty( $form_id ) && $form_id == 'Business subscriber' ) {

		// assign vendor role
		$theUser = new WP_User( $user_id );
		$theUser->add_role( 'dc_vendor' );

		if ( ! empty( $entry['27.1'] ) && ( ! empty( $entry['27.2'] ) || ! empty( $entry['27.3'] ) ) ) {
			update_user_meta( $user_id, 'dealer_user_type', 'dealer_service_provider' );

		} elseif ( empty( $entry['27.1'] ) && ( ! empty( $entry['27.2'] ) || ! empty( $entry['27.3'] ) ) ) {
			update_user_meta( $user_id, 'dealer_user_type', 'service_provider' );

		} elseif ( ! empty( $entry['27.1'] ) && empty( $entry['27.2'] ) && empty( $entry['27.3'] ) ) {
			update_user_meta( $user_id, 'dealer_user_type', 'dealer' );
		}
		$city ="";
		$add1 = "";
		$add2 = "";
		$latitude = "";
		$longitude = "";
		$state = "";
		$postal_code = "";
		$countryCode ="";
		// get city, lat, long from address
		if ( ! empty( $entry['26'] ) ) {
			$data_arr = geocode_from_address( $entry['26'] );

			// if able to geocode the address
			if ( $data_arr ) {
				$latitude    = $data_arr[0];
				$longitude   = $data_arr[1];
				$add1        = $data_arr[2];
				$add2        = $data_arr[3];
				$city        = $data_arr[4];
				$state       = $data_arr[5];
				$country     = $data_arr[6];
				$countryCode = $data_arr[7];
				$postal_code = $data_arr[8];

				update_user_meta( $user_id, 'billing_address_1', $add1 );
				update_user_meta( $user_id, 'billing_address_2', $add2 );
				update_user_meta( $user_id, 'billing_city', $city );
				update_user_meta( $user_id, 'billing_state', $state );
				update_user_meta( $user_id, 'billing_country', $countryCode );
				update_user_meta( $user_id, 'billing_postal_code', $postal_code );
				update_user_meta( $user_id, 'stm_dealer_location_lat', $latitude );
				update_user_meta( $user_id, 'stm_dealer_location_lng', $longitude );
			}
		}
		global $wpdb;
		$businessname = get_user_meta($user_id,'business_name',true);
		$data = array(
		    'user_id' => $user_id,
		    'User Email' => $user_email,
		    'User Login' => $user_login,
		    'First Name' => $first_name,
		    'Last Name' => $last_name,
		    'business_name' => $businessname, 
		    'billing_city' => $city, 
		    'stm_dealer_location' => $add1." ".$add2, 
		    'stm_dealer_location_lat' => $latitude, 
		    'stm_dealer_location_lng' => $longitude, 
		    'billing_state' => $state, 
		    'billing_postcode' => $postal_code, 
		    'service_category' => serialize($serviceArr), 
		    'stm_company_name' => $businessname, 
		    'hd_state' => $state, 
		    'billing_country' => $countryCode,
		    'stm_dealer_logo' => 'https://hd-central.com/wp-content/uploads/2020/07/dark.png',
		    'stm_dealer_image' => 'https://hd-central.com/wp-content/uploads/2020/07/dark.png',
		    
		);

		$wpdb->insert('provider_live',$data );



	}

	// for gravity-form-id: 21
	if ( ! empty( $form_id ) && $form_id == 'Place subscriber' ) {

		// assign vendor role
		$theUser = new WP_User( $user_id );
		$theUser->add_role( 'dc_vendor' );

		// get city, lat, long from address
		if ( ! empty( $entry['26'] ) ) {
			$data_arr = geocode_from_address( $entry['26'] );

			// if able to geocode the address
			if ( $data_arr ) {
				$latitude    = $data_arr[0];
				$longitude   = $data_arr[1];
				$add1        = $data_arr[2];
				$add2        = $data_arr[3];
				$city        = $data_arr[4];
				$state       = $data_arr[5];
				$country     = $data_arr[6];
				$countryCode = $data_arr[7];
				$postal_code = $data_arr[8];

				update_user_meta( $user_id, 'billing_address_1', $add1 );
				update_user_meta( $user_id, 'billing_address_2', $add2 );
				update_user_meta( $user_id, 'billing_city', $city );
				update_user_meta( $user_id, 'billing_state', $state );
				update_user_meta( $user_id, 'billing_country', $country );
				update_user_meta( $user_id, 'billing_postal_code', $postal_code );
				update_user_meta( $user_id, 'stm_dealer_location_lat', $latitude );
				update_user_meta( $user_id, 'stm_dealer_location_lng', $longitude );
			}
		}
	}

}
add_action( 'gform_user_registered', 'wpc_gravity_registration_autologin', 10, 4 );

function change_role( $user_id, $feed, $entry, $user_pass ) {
	$form = GFAPI::get_form( $entry['form_id'] );

	$form_id  = $entry['form_id'];
	$entry_id = get_user_meta( $user_id, 'entry_id', true );
	$entry    = GFAPI::get_entry( $entry_id );
}
add_action( 'gform_user_updated', 'change_role', 10, 4 );

function custom_confirmation( $confirmation, $form, $entry, $ajax ) {
	$user_id   = get_current_user_id();
	$user      = new WP_User( $user_id );
	$user_name = $user->user_login;

	if ( $form['id'] == '4' || $form['id'] == '5' || $form['id'] == '8' ) {
		$confirmation = array( 'redirect' => 'https://hd-central.com/author/' . $user_name . '/?page=settings' );
	}

	if ( $form['id'] == '17' ) {
		$post_id = $entry['7'];
		if ( $entry['payment_status'] == 'Paid' ) {
			wp_update_post(
				array(
					'ID'          => $post_id,
					'post_status' => 'publish',
				)
			);
		}
	}

	return $confirmation;
}
add_filter( 'gform_confirmation', 'custom_confirmation', 10, 4 );

function misha_remove_my_account_links( $menu_links ) {
	unset( $menu_links['../seller/notification'] );
	unset( $menu_links['../seller/to'] );
	unset( $menu_links['../seperate-dashboard'] );
	unset( $menu_links['downloads'] );

	return $menu_links;
}
add_filter( 'woocommerce_account_menu_items', 'misha_remove_my_account_links' );

/* get currency symboles */
function get_currency_symbol( $cc = 'USD' ) {
	$cc       = strtoupper( $cc );
	$currency = array(
		'USD' => '$', // U.S. Dollar
		'AUD' => '$', // Australian Dollar
		'BRL' => 'R$', // Brazilian Real
		'CAD' => 'C$', // Canadian Dollar
		'CZK' => 'Kč', // Czech Koruna
		'DKK' => 'kr', // Danish Krone
		'EUR' => '€', // Euro
		'HKD' => '&#36', // Hong Kong Dollar
		'HUF' => 'Ft', // Hungarian Forint
		'ILS' => '₪', // Israeli New Sheqel
		'INR' => '₹', // Indian Rupee
		'JPY' => '¥', // Japanese Yen
		'MYR' => 'RM', // Malaysian Ringgit
		'MXN' => '&#36', // Mexican Peso
		'NOK' => 'kr', // Norwegian Krone
		'NZD' => '&#36', // New Zealand Dollar
		'PHP' => '₱', // Philippine Peso
		'PLN' => 'zł', // Polish Zloty
		'GBP' => '£', // Pound Sterling
		'SEK' => 'kr', // Swedish Krona
		'CHF' => 'Fr', // Swiss Franc
		'TWD' => '$', // Taiwan New Dollar
		'THB' => '฿', // Thai Baht
		'TRY' => '₺', // Turkish Lira
	);

	if ( array_key_exists( $cc, $currency ) ) {
		return $currency[ $cc ];
	}
}


function user_model( $form ) {
	foreach ( $form['fields'] as $field ) {
		if ( $field->type != 'select' || strpos( $field->cssClass, 'user-model' ) === false ) {
			continue;
		}

		// you can add additional parameters here to alter the posts that are retrieved
		// more info: http://codex.wordpress.org/Template_Tags/get_posts
		$posts = get_posts( 'numberposts=-1&post_status=publish' );

		$choices = array();

		$make_terms = get_terms(
			array(
				'taxonomy'   => 'make',
				'hide_empty' => false,
			)
		);

		foreach ( $make_terms as $make ) {
			$choices[] = array(
				'text'  => $make->name,
				'value' => $make->term_id,
			);
		}

		// update 'Select a Post' to whatever you'd like the instructive option to be
		$field->placeholder = 'Select a Model';
		$field->choices     = $choices;
	}

	return $form;
}
add_filter( 'gform_pre_render_10', 'user_model' );
add_filter( 'gform_pre_validation_10', 'user_model' );
add_filter( 'gform_pre_submission_filter_10', 'user_model' );
add_filter( 'gform_admin_pre_render_10', 'user_model' );

function service_category_date( $form ) {
	foreach ( $form['fields'] as $field ) {
		if ( $field->type != 'checkbox' || strpos( $field->cssClass, 'service_category_date' ) === false ) {
			continue;
		}
		$choices    = array();
		$make_terms = get_terms(
			array(
				'taxonomy'   => 'service_category',
				'hide_empty' => false,
				'parent'     => 0,
			)
		);

		foreach ( $make_terms as $make ) {
			$choices[] = array(
				'text'  => $make->name,
				'value' => $make->term_id,
			);
		}
		$field->choices = $choices;
	}

	return $form;
}
add_filter( 'gform_pre_render_15', 'service_category_date' );
add_filter( 'gform_pre_validation_15', 'service_category_date' );
add_filter( 'gform_pre_submission_filter_15', 'service_category_date' );
add_filter( 'gform_admin_pre_render_15', 'service_category_date' );

function reorder_my_menu_items( $items ) {
	$my_items = array(
		'business-account'            => __( 'Business Account', '' ),
		'../seller/profile/edit'      => __( 'Web Shop profile', '' ),
		'../seller/product-dashboard' => __( 'Sales Dashboard', '' ),
		'../seller/transaction'       => __( 'Transaction history', '' ),
		'../seller/shop-follower'     => __( 'Shop Follower', '' ),
		'../seller/order-history'     => __( 'My Orders / Purchases', '' ),
		'favourite-seller'            => __( 'My Favourite Seller', '' ),
		'../seller/product-list'      => __( 'Product List', '' ),
		'edit-account'                => __( 'Account details', '' ),
		'customer-logout'             => __( 'Logout', '' ),
	);

	return $my_items;
}
add_filter( 'woocommerce_account_menu_items', 'reorder_my_menu_items' );

// link 'business-account' with custom url in woocommerce menu
function misha_hook_endpoint( $url, $endpoint, $value, $permalink ) {
	if ( $endpoint === 'business-account' ) {
		foreach ( stm_account_navigation() as $key => $item ) {
			if ( $item['label'] == 'My Inventory' ) {
				$url = $item['url'];
			}
		}
	}
	return $url;
}
add_filter( 'woocommerce_get_endpoint_url', 'misha_hook_endpoint', 10, 4 );

function remove_my_cpt_from_search_results( $query ) {
	if ( is_admin() || ! $query->is_main_query() || ! $query->is_search() ) {
		return $query;
	}

	// can exclude multiple post types, for ex. array('staticcontent', 'cpt2', 'cpt3')
	$post_types_to_exclude = array( 'listings', 'product', 'manuals' );

	if ( $query->get( 'post_type' ) ) {
		$query_post_types = $query->get( 'post_type' );

		if ( is_string( $query_post_types ) ) {
			$query_post_types = explode( ',', $query_post_types );
		}
	} else {
		$query_post_types = get_post_types( array( 'exclude_from_search' => false ) );
	}

	if ( sizeof( array_intersect( $query_post_types, $post_types_to_exclude ) ) ) {
		$query->set( 'post_type', array_diff( $query_post_types, $post_types_to_exclude ) );
	}

	return $query;
}
add_action( 'pre_get_posts', 'remove_my_cpt_from_search_results' );

/**
 * Get model from year for oem parts filter
 */
function ngk_part_year_change_callback() {
	global $wpdb;

	$part_year = $_REQUEST['part_year'];
	$modelArr  = array();
	if ( ! empty( $part_year ) ) {
		$ym_qry    = "SELECT DISTINCT Model FROM ngk_partfinder WHERE model_year = $part_year";
		$ym_result = $wpdb->get_results( $ym_qry );
		foreach ( $ym_result as $model ) {
			$modelArr[] = array( 'model' => $model->Model );
		}
	}

	echo json_encode( $modelArr );

	die();
}
add_action( 'wp_ajax_ngk_part_year_change', 'ngk_part_year_change_callback' );
add_action( 'wp_ajax_nopriv_ngk_part_year_change', 'ngk_part_year_change_callback' );

/****adding custom code model****/
function bike_model_change_custom_callback() {
	$rangeArr   = array();
	$rangeArr[] = array( 'range' => '44' );
	echo json_encode( $rangeArr );

	die();
}
add_action( 'wp_ajax_ngk_bike_model_change_custom1', 'bike_model_change_custom_callback' );
add_action( 'wp_ajax_nopriv_ngk_bike_model_change_custom1', 'bike_model_change_custom_callback' );

/******** get range from model & year for oem parts filter *******/
function ngk_part_model_change_callback() {
	global $wpdb;
	$part_model = $_REQUEST['part_model'];
	$part_year  = $_REQUEST['part_year'];
	$rangeArr   = array();

	if ( ! empty( $part_model ) && ! empty( $part_year ) ) {
		$ymr_qry    = "SELECT DISTINCT engine_size FROM ngk_partfinder WHERE Model = '$part_model' AND model_year = $part_year";
		$ymr_result = $wpdb->get_results( $ymr_qry );
		foreach ( $ymr_result as $range ) {
			$rangeArr[] = array( 'range' => $range->engine_size );
		}
	}

	echo json_encode( $rangeArr );
	die();
}
add_action( 'wp_ajax_ngk_part_model_change', 'ngk_part_model_change_callback' );
add_action( 'wp_ajax_nopriv_ngk_part_model_change', 'ngk_part_model_change_callback' );

/******** get model from year for oem parts filter *******/
function part_year_change_callback() {
	global $wpdb;
	$part_year = $_REQUEST['part_year'];
	$modelArr  = array();

	if ( ! empty( $part_year ) ) {
		$ym_qry    = 'SELECT DISTINCT product_model FROM ' . $wpdb->prefix . "product_list WHERE product_year = $part_year";
		$ym_result = $wpdb->get_results( $ym_qry );
		foreach ( $ym_result as $model ) {
			$modelArr[] = array( 'model' => $model->product_model );
		}
	}

	echo json_encode( $modelArr );

	die();
}
add_action( 'wp_ajax_part_year_change', 'part_year_change_callback' );
add_action( 'wp_ajax_nopriv_part_year_change', 'part_year_change_callback' );

/******** get range from model & year for oem parts filter *******/
function part_model_change_callback() {
	global $wpdb;
	$part_model = $_REQUEST['part_model'];
	$part_year  = $_REQUEST['part_year'];
	$rangeArr   = array();

	if ( ! empty( $part_model ) && ! empty( $part_year ) ) {
		$ymr_qry    = 'SELECT DISTINCT product_range FROM ' . $wpdb->prefix . "product_list WHERE product_model = '$part_model' AND product_year = $part_year";
		$ymr_result = $wpdb->get_results( $ymr_qry );
		foreach ( $ymr_result as $range ) {
			$rangeArr[] = array( 'range' => $range->product_range );
		}
	}

	echo json_encode( $rangeArr );

	die();
}

add_action( 'wp_ajax_part_model_change', 'part_model_change_callback' );
add_action( 'wp_ajax_nopriv_part_model_change', 'part_model_change_callback' );

/******** get range from model & year for oem parts filter *******/
function my_bike_model_change_callback() {
	global $wpdb;
	$part_model = $_REQUEST['part_model'];
	$part_year  = $_REQUEST['part_year'];
	$rangeArr   = array();

	if ( ! empty( $part_model ) && ! empty( $part_year ) ) {
		$ymr_qry    = 'SELECT DISTINCT product_range FROM ' . $wpdb->prefix . "product_list WHERE product_model = '$part_model' AND product_year = $part_year";
		$ymr_result = $wpdb->get_results( $ymr_qry );
		foreach ( $ymr_result as $range ) {
			$rangeArr[] = array( 'range' => $range->product_range );
		}
	}

	echo json_encode( $rangeArr );

	die();
}
add_action( 'wp_ajax_my_bike_model_change', 'my_bike_model_change_callback' );
add_action( 'wp_ajax_nopriv_my_bike_model_change', 'my_bike_model_change_callback' );

/********** reorder (change position of) ordering dropdown in shop page ********/
function filter_ordering_callback() {
	// Remove ordering dropdown below result-count.
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

	// reorder ordering dropdown above result-count.
	add_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 15 );
}
add_action( 'init', 'filter_ordering_callback' );

/******** get year from model for battery filter *******/
function battery_model_change_callback() {
	global $wpdb;
	$battery_model = $_REQUEST['battery_model'];
	$yearArr       = array();

	if ( ! empty( $battery_model ) ) {
		$my_qry = 'SELECT DISTINCT vehical_year FROM ' . $wpdb->prefix . "battery_product_list WHERE vehicle_model = 
		'$battery_model'";

		$my_result = $wpdb->get_results( $my_qry );
		foreach ( $my_result as $year ) {
			$yearArr[] = array( 'year' => $year->vehical_year );
		}
	}

	echo json_encode( $yearArr );

	die();
}
add_action( 'wp_ajax_battery_model_change', 'battery_model_change_callback' );
add_action( 'wp_ajax_nopriv_battery_model_change', 'battery_model_change_callback' );

function getIP() {
	if ( ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	return $ip;
}

/**
 * Opening div for our content wrapper
 */
function iconic_open_div() {
	if ( is_shop() ) {
		$ip         = getIp();
		$access_key = 'cd7730575c2f30aa0da956bb7a3d9912';
		$ch         = curl_init( 'http://api.ipstack.com/' . $ip . '?access_key=' . $access_key . '' );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		$json = curl_exec( $ch );
		curl_close( $ch );
		$api_result = json_decode( $json, true );

		if ( empty( $_GET ) ) {
			global $wpdb;

			$results        = $wpdb->get_results( "SELECT *  FROM $wpdb->postmeta WHERE meta_key LIKE 'country' AND `meta_value` LIKE '" . $api_result['country_code'] . "'  ORDER BY meta_id ASC limit 0,1", ARRAY_A );
			$f_meta_country = 454294;
			if ( ! empty( $results ) ) {
				$f_meta_country = $results[0]['meta_id'];
			}

			$_SESSION['country'] = $api_result['country_code'];

			?>
			<script type="text/javascript">
				document.location.href = "<?php echo "/shop/?f_meta_country=$f_meta_country"; ?>";
			</script>
			<?php
		}
	}
}
add_action( 'wp_head', 'iconic_open_div', 5 );

/******** register sidebar for single dealer page from service list page ******/
/**
 * Add a sidebar.
 */
function dealer_page_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Single Dealer Sidebar', '' ),
			'id'            => 'single-dealer',
			'description'   => __( 'Widgets in this area will be shown on single author or dealer page', '' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</li>',
			'before_title'  => '<h2 class="widgettitle">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'dealer_page_widgets_init' );

function dispay_message( $message ) {
	?>
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="alert alert-<?php echo $message['type']; ?>" role="alert">
				<?php echo $message['text']; ?>
			</div>
		</div>
	</div>
	<?php
}

// add custom menu to vendor dashboard
function add_tab_to_vendor_dashboard( $nav ) {
	$nav['custom_wcmp_nenu'] = array(
		'label'       => __( 'Main Dashboard', 'dc-woocommerce-multi-vendor' ), // menu label
		'url'         => '/user-redirect/', // menu url
		'capability'  => true, // capability if any
		'position'    => 100, // position of the menu
		'submenu'     => array(), // submenu if any
		'link_target' => '_blank',
		'nav_icon'    => 'wcmp-font ico-dashboard-icon', // menu icon
	);
	return $nav;
}
add_filter( 'wcmp_vendor_dashboard_nav', 'add_tab_to_vendor_dashboard' );

// function to geocode address, it will return false if unable to geocode address
function geocode_from_address( $address ) {
	// url encode the address
	$address = urlencode( $address );

	// google map geocode api url
	$url = "https://maps.googleapis.com/maps/api/geocode/json?address={$address}&key=AIzaSyChDqc8vz4Q_nj4B-jk1kGm-q0aDztUf4A";

	// get the json response
	$resp_json = file_get_contents( $url );
	$resp      = json_decode( $resp_json );

	// response status will be 'OK', if able to geocode given address
	if ( $resp->status == 'OK' ) {
		// get the important data
		$lati              = isset( $resp->results[0]->geometry->location->lat ) ? $resp->results[0]->geometry->location->lat : '';
		$longi             = isset( $resp->results[0]->geometry->location->lng ) ? $resp->results[0]->geometry->location->lng : '';
		$formatted_address = isset( $resp->results[0]->formatted_address ) ? $resp->results[0]->formatted_address : '';

		$arrComponents = $resp->results[0]->address_components;

		$add1        = '';
		$add2        = '';
		$city        = '';
		$state       = '';
		$country     = '';
		$countryCode = '';
		$postal_code = '';

		foreach ( $arrComponents as $index => $component ) {

			if ( ( in_array( 'locality', $component->types ) ) && ( in_array( 'political', $component->types ) ) ) {
				$city = trim( $component->long_name );
			}

			if ( ( in_array( 'administrative_area_level_1', $component->types ) ) && ( in_array( 'political', $component->types ) ) ) {
				$state = trim( $component->long_name );
			}

			if ( ( in_array( 'country', $component->types ) ) && ( in_array( 'political', $component->types ) ) ) {
				$country     = trim( $component->long_name );
				$countryCode = trim( $component->short_name );
			}

			if ( in_array( 'postal_code', $component->types ) ) {
				$postal_code = trim( $component->long_name );
			}

			if ( in_array( 'street_number', $component->types ) ) {
				$street_number = trim( $component->long_name );
				$add1          = $street_number . ', ';
			}
			if ( in_array( 'route', $component->types ) ) {
				$route = trim( $component->long_name );
				//$add1 .= $street_number;
				if( !empty($street_number) ){
					$add1 = $route." ".$street_number;
				}else{
					$add1 = $street_number;
				}
			}
			if ( $add1 ) {
				$add1 = trim( $add1 );
			}

			if ( ( in_array( 'administrative_area_level_2', $component->types ) ) && ( in_array( 'political', $component->types ) ) ) {
				$add2 = trim( $component->long_name );
			}
		}

		if ( empty( $postal_code ) ) {
			$geocodeFromLatlon = file_get_contents( 'http://maps.googleapis.com/maps/api/geocode/json?latlng=' . $lati . ',' . $longi . '&key=AIzaSyChDqc8vz4Q_nj4B-jk1kGm-q0aDztUf4A' );

			$output2 = json_decode( $geocodeFromLatlon );
			if ( ! empty( $output2 ) ) {
				$addressComponents = $output2->results[0]->address_components;
				foreach ( $addressComponents as $addrComp ) {
					if ( $addrComp->types[0] == 'postal_code' ) {
						// Return the zipcode
						$postal_code = $addrComp->long_name;
					}
				}
			} else {
				$postal_code = '';
			}
		}

		$data_arr = array();
		array_push(
			$data_arr,
			$lati,
			$longi,
			$add1,
			$add2,
			$city,
			$state,
			$country,
			$countryCode,
			$postal_code
		);
		return $data_arr;

	} else {
		return false;
	}
}

/******* replace add_to_cart text nad url in shop page *******/
function quantity_inputs_for_woocommerce_loop_add_to_cart_link( $button, $product ) {
	$external_url = get_post_meta( $product->get_id(), '_product_url', true );

	if ( ! empty( $external_url ) ) {
		$button_text = __( 'Buy', 'woocommerce' );
		$button      = '<a class="button alt add_to_cart_button" href="' . $external_url . '" target="_blank">' . $button_text . '</a>';
	}

	return $button;
}
add_filter( 'woocommerce_loop_add_to_cart_link', 'quantity_inputs_for_woocommerce_loop_add_to_cart_link', 12, 2 );

// Outputing a custom button in Single product pages (you need to set the button link)
function single_product_custom_button() {

	global $product;

	// WooCommerce compatibility
	if ( method_exists( $product, 'get_id' ) ) {
		$product_id = $product->get_id();
	} else {
		$product_id = $product->id;
	}

	$external_url = get_post_meta( $product_id, '_product_url', true );

	if ( ! empty( $external_url ) ) {
		// Set HERE your button link
		echo '<a href="' . $external_url . '" class="button alt add_to_cart_button" target="_blank" style="margin-bottom: 14px;">' . __( 'Buy', 'woocommerce' ) . '</a>';
	}
}

// Replacing add-to-cart button in Single product pages
function removing_addtocart_buttons() {
	global $product;

	// WooCommerce compatibility
	if ( method_exists( $product, 'get_id' ) ) {
		$product_id = $product->get_id();
	} else {
		$product_id = $product->id;
	}

	$external_url = get_post_meta( $product_id, '_product_url', true );

	if ( ! empty( $external_url ) ) {
		// Simple products
		remove_action( 'woocommerce_simple_add_to_cart', 'woocommerce_simple_add_to_cart', 30 );
		// Simple products
		add_action( 'woocommerce_simple_add_to_cart', 'single_product_custom_button', 30 );
	}
}
add_action( 'woocommerce_single_product_summary', 'removing_addtocart_buttons', 1 );

/**
 * Get the author's email address from the author meta infos in contact form for 'To' field.
 */
function custom_get_post_author_email( $atts ) {
	$value = '';
	if ( is_author() ) {
		$author    = get_queried_object();
		$author_id = $author->ID;

		if ( get_the_author_meta( 'user_email' ) ) {
			$value = get_the_author_meta( 'user_email', $author_id );
		}
	}

	return $value;
}
add_shortcode( 'CUSTOM_AUTHOR_EMAIL', 'custom_get_post_author_email' );

function my_stm_filter_add_car_media( $response ) {
	$post_id = intval( $_POST['post_id'] );
	$user_id = get_current_user_id();
	if ( $_POST['stm_edit'] == 'update' ) {
		$response['url']     = get_author_posts_url( $user_id ) . '?page=add_bike&edit_car=1&item_id=' . $post_id;
		$response['message'] = esc_html__( 'Bike updated', 'stm_vehicles_listing' );
	} else {
		$response['url']     = get_author_posts_url( $user_id ) . '?page=add_bike_payment&post_id=' . $post_id;
		$response['message'] = esc_html__( 'Bike added', 'stm_vehicles_listing' );
	}

	$stm_pricing = get_post_meta( $post_id, 'stm_pricing', true );
	if ( $stm_pricing != 0 ) {
		wp_update_post(
			array(
				'ID'          => $post_id,
				'post_status' => 'pending',
			)
		);
	}
	return $response;
}
add_filter( 'stm_filter_add_car_media', 'my_stm_filter_add_car_media', 10, 1 );

function my_stm_filter_add_a_car( $response ) {
	$response['message'] = str_replace( 'Car', 'Bike', $response['message'] );
	$post_id             = $response['post_id'];

	$latitude  = $_POST['stm_lat'];
	$longitude = $_POST['stm_lng'];

	$region = '';
	if ( ! empty( $latitude ) ) {
		$geolocation = $latitude . ',' . $longitude;
		$request     = 'https://maps.googleapis.com/maps/api/geocode/json?latlng=' . $geolocation . '&sensor=false&key=AIzaSyChDqc8vz4Q_nj4B-jk1kGm-q0aDztUf4A';

		$file_contents = file_get_contents( $request );
		$json_decode   = json_decode( $file_contents );

		if ( isset( $json_decode->results[0] ) ) {
			$responsegoogle = array();
			foreach ( $json_decode->results[0]->address_components as $addressComponet ) {
				if ( in_array( 'political', $addressComponet->types ) ) {
					$responsegoogle[] = $addressComponet->long_name;
				}
			}

			if ( isset( $responsegoogle[0] ) ) {
				$first = $responsegoogle[0];
			} else {
				$first = 'null'; }
			if ( isset( $responsegoogle[1] ) ) {
				$second = $responsegoogle[1];
			} else {
				$second = 'null'; }
			if ( isset( $responsegoogle[2] ) ) {
				$third = $responsegoogle[2];
			} else {
				$third = 'null'; }
			if ( isset( $responsegoogle[3] ) ) {
				$fourth = $responsegoogle[3];
			} else {
				$fourth = 'null'; }
			if ( isset( $responsegoogle[4] ) ) {
				$fifth = $responsegoogle[4];
			} else {
				$fifth = 'null'; }

			if ( $first != 'null' && $second != 'null' && $third != 'null' && $fourth != 'null' && $fifth != 'null' ) {
				$region = $fifth;
			} elseif ( $first != 'null' && $second != 'null' && $third != 'null' && $fourth != 'null' && $fifth == 'null' ) {
				$region = $fourth;
			} elseif ( $first != 'null' && $second != 'null' && $third != 'null' && $fourth == 'null' && $fifth == 'null' ) {
				$region = $third;
			} elseif ( $first != 'null' && $second != 'null' && $third == 'null' && $fourth == 'null' && $fifth == 'null' ) {
				$region = $second;
			} elseif ( $first != 'null' && $second == 'null' && $third == 'null' && $fourth == 'null' && $fifth == 'null' ) {
				$region = $first;
			}
		}
	}

	if ( ! empty( $region ) ) {
		$countrynameterm = term_exists( $region, 'region' );
		 // print_r($countrynameterm);
		if ( 0 !== $countrynameterm ) {
			$term_id = $countrynameterm['term_id'];
			$tag     = array( $term_id );

			$returndata = wp_set_post_terms( $post_id, $tag, 'region' );

				$term = get_term( $term_id, 'region' );
				$slug = $term->slug;
				update_post_meta( $post_id, 'region', $slug );
			   // print_r($returndata);
		}
	}

	update_post_meta( $post_id, 'stm_pricing', $_POST['bike_pricing'] );
	update_post_meta( $post_id, 'buyer_can_email', $_POST['buyer_can_email'] );
	update_post_meta( $post_id, 'buyer_can_phone', $_POST['buyer_can_phone'] );
	update_post_meta( $post_id, 'buyer_phone', $_POST['buyer_phone'] );
	update_post_meta( $post_id, 'stm_f_currency', $_POST['stm_f_currency'] );
	update_post_meta( $post_id, 'is_near_by_price', $_POST['is_near_by_price'] );
	return $response;
}
add_filter( 'stm_filter_add_a_carstm_filter_add_a_car', 'my_stm_filter_add_a_car', 10, 1 );


function action_function_name_2365( $action, $result ) {
	if ( $action == 'stm_add_a_car' ) {
		$stm_seller_notes = $_POST['stm_seller_notes'];
		if ( empty( $stm_seller_notes ) || $stm_seller_notes == 'N/A' ) {
			$error               = true;
			$response['message'] = esc_html__( 'Please Enter Description', 'motors' );
			wp_send_json( $response );
		}
		if ( empty( $_POST['stm_s_s_engine'] ) ) {
			$error               = true;
			$response['message'] = esc_html__( 'Please Enter Engine', 'motors' );
			wp_send_json( $response );
		}
		if ( empty( $_POST['stm_s_s_mileage'] ) ) {
			$error               = true;
			$response['message'] = esc_html__( 'Please Enter Mileage', 'motors' );
			wp_send_json( $response );
		}
		// if ( empty( $_POST['stm_s_s_mot'] ) ) {
			// $error               = true;
			// $response['message'] = esc_html__( 'Please Enter Road Legal Cert', 'motors' );
			// wp_send_json( $response );
		// }
		if ( empty( $_POST['stm_s_s_history'] ) ) {
			$error               = true;
			$response['message'] = esc_html__( 'Please Enter Service History', 'motors' );
			wp_send_json( $response );
		}
		if ( empty( $_POST['stm_s_s_valid-registration-document'] ) ) {
			$error               = true;
			$response['message'] = esc_html__( 'Please Enter Valid Registration Document', 'motors' );
			wp_send_json( $response );
		}
		if ( empty( $_POST['stm_s_s_exterior-color'] ) ) {
			$error               = true;
			$response['message'] = esc_html__( 'Please Enter Exterior Color', 'motors' );
			wp_send_json( $response );
		}
	}
}
add_action( 'check_ajax_referer', 'action_function_name_2365', 10, 2 );

function wptypes_listvfav_func( $atts = array(), $content = null ) {
	extract( shortcode_atts( array(), $atts ) );
	if ( function_exists( 'wpfp_get_users_favorites' ) ) :
		$favorite_post_ids = wpfp_get_users_favorites();
		$limit             = 10;
		$content          .= '';
		if ( $favorite_post_ids ) :
			$c                 = 0;
			$favorite_post_ids = array_reverse( $favorite_post_ids );
			foreach ( $favorite_post_ids as $post_id ) {
				if ( $c++ == $limit ) {
					break;
				}
				$p        = get_post( $post_id );
				$content .= '';
				$content .= "<a href='" . get_permalink( $post_id ) . "' title='" . $p->post_title . "'>" . $p->post_title . '</a> ';
				$content .= '';
			}
		else :
			$content .= '';
			$content .= 'Your favorites will be here.';
			$content .= '';
		endif;
		$content .= '';
	endif;
	return $content;
}
add_shortcode( 'wptypes_listvfav', 'wptypes_listvfav_func' );

function my_acf_save_post( $post_id ) {
	// Get newly saved values.
	$values = get_fields( $post_id );
	
	// print_r($values); echo "<br>";
	// echo "post_id: ".$post_id."<br>";
	// die;

	// Check the new value of a specific field.
	$hero_image = get_field( 'offer_details', $post_id );
	if ( $hero_image ) {
		$get_current_user_id = get_current_user_id();
		update_user_meta( $get_current_user_id, 'my_offer_id', $post_id );
		if ( ! is_admin() ) {
		//update_post_meta( $post_id, 'user', $get_current_user_id );
		update_field( 'user', $get_current_user_id, $post_id );
		}
	}

	$post_type = get_post_type( $post_id );

	// for event posttype to get address data from autocomplete address select and save in event postmeta on save of post
	if ( $post_type == 'event' ) {
		// Get previous values.
		$prev_values = get_fields( $post_id );

		if ( ! empty( $prev_values['location_address'] ) ) {
			$data_arr = geocode_from_address( $prev_values['location_address']['address'] );

			// if able to geocode the address
			if ( $data_arr ) {
				$latitude    = $data_arr[0];
				$longitude   = $data_arr[1];
				$add1        = $data_arr[2];
				$add2        = $data_arr[3];
				$city        = $data_arr[4];
				$state       = $data_arr[5];
				$country     = $data_arr[6];
				$countryCode = $data_arr[7];
				$postal_code = $data_arr[8];

				update_post_meta( $post_id, 'billing_address_1', $add1 );
				update_post_meta( $post_id, 'billing_address_2', $add2 );
				update_post_meta( $post_id, 'billing_city', $city );
				update_post_meta( $post_id, 'billing_state', $state );
				update_post_meta( $post_id, 'billing_country', $country );
				update_post_meta( $post_id, 'billing_postal_code', $postal_code );
				update_post_meta( $post_id, 'stm_dealer_location_lat', $latitude );
				update_post_meta( $post_id, 'stm_dealer_location_lng', $longitude );
			}
		}
	}

}
add_action( 'acf/save_post', 'my_acf_save_post' );

function get_place_categories( $form ) {
	foreach ( $form['fields'] as &$field ) {
		if ( $field->id == 27 ) {
			$terms = get_terms(
				array(
					'taxonomy'   => 'place-categories',
					'hide_empty' => false,
				)
			);

			$choices = array();

			foreach ( $terms as $term ) {
				$choices[] = array(
					'text'  => $term->name,
					'value' => $term->term_id,
				);
			}
			$field->choices = $choices;
		}
	}

	return $form;
}
add_filter( 'gform_pre_render_21', 'get_place_categories' );
add_filter( 'gform_pre_validation_21', 'get_place_categories' );
add_filter( 'gform_pre_submission_filter_21', 'get_place_categories' );
add_filter( 'gform_admin_pre_render_21', 'get_place_categories' );

function my_acf_init() {
	acf_update_setting( 'google_api_key', 'AIzaSyChDqc8vz4Q_nj4B-jk1kGm-q0aDztUf4A' );
}
add_action( 'acf/init', 'my_acf_init' );

// add business activity in user edit on admin-panel
function user_business_activity_fields( $user ) {
	$bike_dealer              = get_user_meta( $user->ID, 'bike_dealer', true );
	$servicing_and_maitenance = get_user_meta( $user->ID, 'servicing_and_maitenance', true );
	$parts_and_accessories    = get_user_meta( $user->ID, 'parts_and_accessories', true );
	$online_shop              = get_user_meta( $user->ID, 'online_shop', true );
	$other                    = get_user_meta( $user->ID, 'other', true );
	$business_activity        = array( $bike_dealer, $servicing_and_maitenance, $parts_and_accessories, $online_shop, $other );

	// get the form
	$form_id = '15';
	$form    = GFAPI::get_form( $form_id );
	// get the field by passinf form object
	$field = GFFormsModel::get_field( $form, 27 );
	// get the Business Activity choices
	$choices = $field->choices;

	?>
	<h2>Business Activity</h2>
	<table class="form-table">
		<tbody>
			<tr>			
				<th>Business Activity</th>
				<td>
				<?php
				foreach ( $choices as $choice ) {
					if ( $choice['value'] == 'Servicing and Maintenance' ) {
						$name = 'servicing_and_maitenance';
					} else {
						$name = str_replace( ' ', '_', strtolower( $choice['value'] ) );
					}
					?>
						
						 <div class="col-md-4">
							<label>
								<input type="checkbox" name="<?php echo $name; ?>" value="<?php echo $choice['value']; ?>" 
																		<?php
																		if ( in_array( $choice['value'], $business_activity ) ) {
																			echo "checked='checked'";}
																		?>
								 >
							<?php echo $choice['text']; ?>
							</label>
						</div>								
				<?php } ?>						
				</td>				
			</tr>
		</tbody>
	</table>
	<?php
}
add_action( 'show_user_profile', 'user_business_activity_fields' );
add_action( 'edit_user_profile', 'user_business_activity_fields' );

/**
 * save service category checkboxes filed in database
 */
function save_user_business_activity_fields( $user_id ) {
	if ( ! current_user_can( 'edit_user', $user_id ) ) {
		return false;
	}

	$baArr = array();

	if ( isset( $_POST['bike_dealer'] ) ) {
		$baArr[] = $_POST['bike_dealer'];
		update_user_meta( $user_id, 'bike_dealer', $_POST['bike_dealer'] );
	} else {
		update_user_meta( $user_id, 'bike_dealer', $_POST['bike_dealer'] );
	}

	if ( isset( $_POST['servicing_and_maitenance'] ) ) {
		$baArr[] = $_POST['servicing_and_maitenance'];
		update_user_meta( $user_id, 'servicing_and_maitenance', $_POST['servicing_and_maitenance'] );
	} else {
		update_user_meta( $user_id, 'servicing_and_maitenance', '' );
	}

	if ( isset( $_POST['parts_and_accessories'] ) ) {
		$baArr[] = $_POST['parts_and_accessories'];
		update_user_meta( $user_id, 'parts_and_accessories', $_POST['parts_and_accessories'] );
	} else {
		update_user_meta( $user_id, 'parts_and_accessories', '' );
	}

	if ( isset( $_POST['online_shop'] ) ) {
		$baArr[] = $_POST['online_shop'];
		update_user_meta( $user_id, 'online_shop', $_POST['online_shop'] );
	} else {
		update_user_meta( $user_id, 'online_shop', '' );
	}

	if ( isset( $_POST['other'] ) ) {
		$baArr[] = $_POST['other'];
		update_user_meta( $user_id, 'other', $_POST['other'] );
	} else {
		update_user_meta( $user_id, 'other', '' );
	}

	// save all selected data in common meat key
	if ( $baArr ) {
		$baString = implode( ', ', $baArr );
		update_user_meta( $user_id, 'business_activity', $baString );
	} else {
		update_user_meta( $user_id, 'business_activity', '' );
	}

}
add_action( 'personal_options_update', 'save_user_business_activity_fields' );
add_action( 'edit_user_profile_update', 'save_user_business_activity_fields' );

function showproducts_totalcount() {
	$count_posts       = wp_count_posts( 'product' );
	$total_count_stm_u = $count_posts->publish;
	$vl_n              = array_map( 'intval', str_split( $total_count_stm_u ) );
	$count             = count( $vl_n );
	$finvl             = 6 - $count;
	?>
	<div class="count_list_n">
		<div class="row">
			<div class="col-xs-10 count-div">
				<div class="list-count">	
					<?php
					for ( $i = 1; $i <= $finvl; $i++ ) {
						?>
						<span class="ins_cntvl in_red_c">0</span>
						<?php
					}
					foreach ( $vl_n as $vl ) {
						?>
						<span class="ins_cntvl"><?php echo $vl; ?></span>
						<?php
					}
					?>
						
				</div>
			</div>
			<div class="col-xs-2 search-div"><span class="text_after_counter"><i class="ubermenu-icon fas fa-shopping-cart"></i></span></div>
		</div>
	</div>
	<?php
}



add_shortcode( 'showproducts_totalcount', 'showproducts_totalcount' );

function oem_part_finder() {
	global $wpdb;
	$year_qry = 'SELECT distinct model_year FROM  ngk_partfinder order by model_year DESC';
	$y_result = $wpdb->get_results( $year_qry );
	?>

	<form action="/oem-parts-finder/" method="get" class="filter_parts">
		<div class="filter">
			<div class="">													
				<h5 class="pull-left">Years:</h5>
					<select name="part_year" id="part_years" class="form-control">
						<option value=""><?php _e( 'Filter By Years', '' ); ?></option>
						<?php foreach ( $y_result as $year ) { ?>
						<option value="<?php echo $year->model_year; ?>" 
							<?php
							if ( isset( $_REQUEST['part_year'] ) && $_REQUEST['part_year'] == $year->product_year ) {
								echo 'selected';}
							?>
							><?php echo $year->model_year; ?></option>
						<?php } ?>
					</select>
							
					<h5 class="pull-left">Models:</h5>
						<select name="part_model" id="part_models" class="form-control">
									<option value=""><?php _e( 'Filter By Models', '' ); ?></option>
									<?php
									if ( isset( $_REQUEST['part_year'] ) && ! empty( $_REQUEST['part_year'] ) ) {
										$ym_qry    = 'SELECT DISTINCT product_model FROM ' . $wpdb->prefix . 'product_list WHERE product_year = ' . $_REQUEST['part_year'];
										$ym_result = $wpdb->get_results( $ym_qry );
										foreach ( $ym_result as $model ) {
											?>
												<option value="<?php echo $model->product_model; ?>" 
																		  <?php
																			if ( isset( $_REQUEST['part_model'] ) && $_REQUEST['part_model'] == $model->product_model ) {
																				echo 'selected';}
																			?>
												><?php echo $model->product_model; ?></option>
											<?php
										}
									}
									?>
																		
								</select>
							
							
								<h5 class="pull-left">Range:</h5>
								<select name="part_range" id="part_ranges" class="form-control">
									<option value=""><?php _e( 'Filter By Range', '' ); ?></option>
									<?php
									if ( isset( $_REQUEST['part_model'] ) && ! empty( $_REQUEST['part_model'] ) && isset( $_REQUEST['part_year'] ) && ! empty( $_REQUEST['part_year'] ) ) {
										$ymr_qry    = 'SELECT DISTINCT product_range FROM ' . $wpdb->prefix . "product_list WHERE product_model = '" . $_REQUEST['part_model'] . "' AND product_year = " . $_REQUEST['part_year'];
										$ymr_result = $wpdb->get_results( $ymr_qry );
										foreach ( $ymr_result as $range ) {
											?>
												<option value="<?php echo $range->product_range; ?>" 
																		  <?php
																			if ( isset( $_REQUEST['part_range'] ) && $_REQUEST['part_range'] == $range->product_range ) {
																				echo 'selected';}
																			?>
												><?php echo $range->product_range; ?></option>
											<?php
										}
									}
									?>
											
								</select>
							
							
								<div class="row row-pad-top-24">	
									<div class="col-md-6 col-sm-6 btn_container">
										<button type="submit" name="filter_btn" class="button btn_search">Search <i class="fa fa-circle-o-notch fa-spin" id="loader_icon" style="display: none;"></i></button>
									</div>
									
								</div>
							
						</div>			
					</div>	
						
	</form>	
				
	<script>
		jQuery(document).ready(function(){
			jQuery('select#part_years').change(function(){
				var selected_year = jQuery(this).val();	

				jQuery('#loader_icon').show();
				
				jQuery.ajax({		
					url: ajaxurl,
					method :'POST',
					dataType: 'json',
					data:{
						action : 'part_year_change',
						part_year :  selected_year
					},
					success:function(response){
						jQuery('#loader_icon').hide();					
						
						var len = response.length;
						
						jQuery("#part_models option:not(:first)").remove();
						jQuery("#part_ranges option:not(:first)").remove();
						
						for( var i = 0; i<len; i++){
							jQuery('#part_models').append("<option value='"+response[i].model+"'>"+response[i].model+"</option>");
						}
						
					},
					error: function(error){
						console.log(error);
					}
				});
			});
			
			jQuery('select#part_models').change(function(){
				var selected_model = jQuery(this).val();	
				var selected_year = jQuery('#part_years').val();
				
				jQuery('#loader_icon').show();
				
				jQuery.ajax({		
					url: ajaxurl,
					method :'POST',
					dataType: 'json',
					data:{
						action : 'part_model_change',
						part_model :  selected_model,
						part_year :  selected_year,
					},
					success:function(response){
						jQuery('#loader_icon').hide();					
						
						var len = response.length;
						
						jQuery("#part_ranges option:not(:first)").remove();
						for( var i = 0; i<len; i++){
							jQuery('#part_ranges').append("<option value='"+response[i].range+"'>"+response[i].range+"</option>");
						}
						
					},
					error: function(error){
						console.log(error);
					}
				});
			});
			
		});
	</script>									
	<?php
}
add_shortcode( 'oem_part_finder', 'oem_part_finder' );

if ( function_exists( 'acf_add_options_page' ) ) {
	acf_add_options_page();
}

function change_woocommerce_currency( $currency ) {
	if ( is_singular() || is_shop() ) {
		global $post;

		$current_page_id = $post->ID;
		$currency_id     = get_post_meta( $current_page_id, 'currency_id', true );
		$saved_page_id   = 15; // get the page id you want
		if ( ! empty( $currency_id ) ) {
			$currency = $currency_id; // or whatever the currency symbol is
		}
	}
	return $currency;
}
add_filter( 'woocommerce_currency', 'change_woocommerce_currency' );

/**
 * Remove unsed image sizes.
 *
 * @author Vijay Hardaha
 */
function hdc_remove_image_sizes() {
	$sizes = array( 'stm-img-1110-577', 'stm-img-825-483', 'stm-img-796-466', 'stm-img-790-404', 'stm-img-690-410', 'stm-img-200-200', 'stm-img-350-205', 'stm-img-350-205-x-2', 'stm-img-350-216', 'stm-img-350-356', 'stm-img-350-181', 'stm-img-398-206', 'stm-img-398-223', 'stm-img-398-223-x-2', 'stm-img-255-135', 'stm-img-240-140', 'stm-img-255-135-x-2', 'stm-img-275-205', 'stm-img-275-205-x-2', 'stm-img-255-160', 'stm-img-255-160-x-2', 'stm-img-190-132', 'stm-mag-img-472-265', 'stm-img-280-165', 'stm-img-280-165-x-2', 'stm-img-350-255', 'stm-img-445-255', 'stm-img-635-255', 'stm-img-445-540', 'stm-img-100-68',  'jeg-360x540', 'jeg-360x480', 'jeg-90x90', 'jeg-370x370', 'jeg-featured-750', 'jeg-featured-1140', 'jeg-120x96', 'jeg-370x296', 'jeg-750x536', 'jeg-360x180', 'jeg-800x400', 'jeg-1140x570' );
	foreach ( $sizes as $size ) {
		remove_image_size( $size );
	}
}
add_action( 'init', 'hdc_remove_image_sizes', 20 );

/**
 * Change action scheduler retention time.
 *
 * @return int
 */
function hdc_reduce_action_scheduler_retention() {
	return 30;
}
add_filter( 'action_scheduler_retention_period', 'hdc_reduce_action_scheduler_retention' );





function show_ads($atts) {
    $default = array(
        'ads_group' => '',
    );
    $a = shortcode_atts($default, $atts);



  $Region= "USA";
                          // set IP address and API access key 
                  $ip = getIp();
                  $api_result = '';
                  $api_result =  get_transient( 'IPNEW_'.$ip );
                //  var_dump($api_result);
                  if ( empty( $api_result) ) {
                  // this code runs when there is no valid transient set
                      //echo "API called";



                   // $ip = '2.58.45.2';  
                    $access_key = 'cd7730575c2f30aa0da956bb7a3d9912';  

                        // Initialize CURL:
                    //echo 'http://ip-api.com/json/'.$ip;
                    $ch = curl_init('http://ip-api.com/json/'.$ip);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                        // Store the data:
                    $json = curl_exec($ch);
                    curl_close($ch);         

                        // Decode JSON response:
                    $api_result = json_decode($json, true);
                    set_transient( 'IPNEW_'.$ip, $api_result, YEAR_IN_SECONDS );
                }
                 //print_r($api_result);
                  //$_SESSION['country'] = $api_result['country_code'];
               $Region =  $api_result['country'];


 $args = array('post_type' => 'ads',
        'tax_query' => array(
            array(
                'taxonomy' => 'ads-groups',
                'field' => 'term_id',
                'terms' => $a['ads_group'],
            ),
        ),
     );
$loop = new WP_Query($args);
$counter = $loop->found_posts;
$owlclass = 'owl-carousel owl-theme';
if($counter == 1){
	$owlclass  = '';
}


 $return = '<div class="'.$owlclass.'" style="width:100%;height:100%;padding:0px">';

     $loop = new WP_Query($args);
     if($loop->have_posts()) {
        

        while($loop->have_posts()) : $loop->the_post();
             $post_id = get_the_ID();
             $link = get_field('ads_link');
             $all_locations = get_field('all_locations');
             $tracking_code = get_field('tracking_code');
             //print_r($all_locations);
             $regions = get_field('region');
             //print_r($regions);
             $regionarray = array();
             foreach($regions as $reg){
             	$term = get_term( $reg );
				$regionarray[] =  $term->name;
             }

             
             $url = wp_get_attachment_url( get_post_thumbnail_id($post_id), 'full' );
             if($all_locations || in_array($Region,$regionarray)){
          	   $return .='<div class="item"><a href="'.$link.'" target="_blank"> <img src="'.$url.'"/></a>'.$tracking_code.'</div>';
         	 }
        endwhile;
     }

    
    
    
$return  .='</div>';

    return $return;
}
add_shortcode('show_ads', 'show_ads');



add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar() {
  if (!current_user_can('administrator') && !is_admin()) {
    show_admin_bar(false);
  }
}

// /******** not working *******/
// add_filter( 'wp_title', 'wpdocs_filter_wp_title', 11, 1 );
// function wpdocs_filter_wp_title($title){
	
	// //echo "++++title: ".$title."<br>"; 
	
	// $title = "test title";
	
	// return $title;
// }

add_filter( 'pre_get_document_title', 'wporg_only_title_home_page', 11 );
function wporg_only_title_home_page( $title ){
	//echo "+++++title: ".$title."<br>";	
	if( is_user_logged_in() ){
		$current_user_id = get_current_user_id();			
		$business_name = get_the_author_meta('business_name', $current_user_id);
		//echo "++++".$business_name."<br>";		
		
		if( $business_name ){
			$title = $business_name . " &#8211; " . get_bloginfo( 'name' );
		}		
	}	
	return $title;
}


function get_product_data( $product_id, $field_name = '' ){
	global $wpdb;
			
	$field_data = '';	
	if( $product_id && $field_name ){
		
		if( $field_name == 'title' ){
			$field = 'Product_Title';
		}else if( $field_name == 'description' ){
			$field = 'Product_Description';
		}else if( $field_name == 'price' ){
			$field = 'Product_Price';
			
			$currency = "$";
			$cur_result = $wpdb->get_results("select Product_Currency from product_data where id = ".$product_id);
			if( $cur_result && count($cur_result) > 0 ){
				$currency = $cur_result[0]->Product_Currency;
			}
		}else if( $field_name == 'brand' ){
			$field = 'Product_Brand';
		}else if( $field_name == 'seller' ){
			$field = 'Seller';
		}else if( $field_name == 'model' ){
			$field = 'Model';
		}else if( $field_name == 'condition' ){
			$field = 'Product_Condition';
		}else if( $field_name == 'additional_info' ){
			$field = 'Product_Additional_Information';
		}else if( $field_name == 'part_no' ){
			$field = 'Other_Man_Part_No';
		}else if( $field_name == 'harley_oem' ){
			$field = 'Harley_OEM';
		}else if( $field_name == 'category'){
			$field = 'Master_Category, Parent_Catgeory, Child_Category';
		}else{
			$field = $field_name;
		}
		
		
		$sql = "select $field from product_data where id = ".$product_id;
		//echo "sql: ".$sql."<br>";
		$result = $wpdb->get_results($sql);
		//print_r($result);
		if( $result && count($result) > 0 ){
			$field_data = $result[0]->$field;
			
			if( $field_name == 'price' ){
				$field_data = $currency.' '.$field_data;
			}
			if( $field_name == 'category' ){
				$catArr[] = $result[0]->Master_Category;
				$catArr[] = $result[0]->Parent_Catgeory;
				$catArr[] = $result[0]->Child_Category;
				
				$field_data = implode(', ',$catArr);
			}
		}else{
			wp_redirect(site_url());
			exit;
		}
	}
	
	return $field_data;	
}


// proguct title return  shortcode 
add_shortcode( 'show_product_data', 'show_product_data_callback');
function show_product_data_callback( $atts = '' ){
	ob_start();
			
	$value = shortcode_atts( array(
        'field_name' => '',
        'field_label' => '',
    ), $atts );

	if( is_admin() ){
		return;
	}
	
	if( isset($_GET['ID']) && !empty($_GET['ID']) ){	
		$ID = $_GET['ID'];
	}else{
		wp_redirect(site_url());
		exit;
	}
	//echo "ID: ".$ID."<br>";
	
	$product_field_name = $field_label = '';
	if( isset($value['field_name']) && $value['field_name'] == 'title' ){		
		$product_title = get_product_data($ID, 'title');		
		echo $product_title;
		
	}else if( isset($value['field_name']) && $value['field_name'] == 'description' ){
		$product_desc = get_product_data($ID, 'description');
		echo $product_desc;
		
	}else if( isset($value['field_name']) && $value['field_name'] == 'short_description' ){
		$product_desc = get_product_data($ID, 'description');
		if( strlen($product_desc) > 300 ) {
			$stringCut = substr($product_desc, 0, 250); // change 15 top what ever text length you want to show.
			$endPoint = strrpos($stringCut, ' ');
			//if the string doesn't contain any space then it will cut without word basis.
			$product_desc = $endPoint ? substr($stringCut, 0, $endPoint):substr($stringCut, 0);
			$product_desc .= '...';
		}
		echo $product_desc;
		
	}else if( isset($value['field_name']) && $value['field_name'] == 'additional_info' ){
		$product_additional_info = get_product_data($ID, 'additional_info');
		echo $product_additional_info;
		
	}else if( isset($value['field_name']) && $value['field_name'] == 'price' ){
		$product_price = get_product_data($ID, 'price');
		echo $product_price;
		
	}else if( isset($value['field_name']) && $value['field_name'] == 'brand' ){
		if( $value['field_label'] ){ $field_label = $value['field_label']; }else{ $field_label = "Brand"; }
		$product_field_name = get_product_data($ID, 'brand');
		//echo $product_brand;
		
	}else if( isset($value['field_name']) && $value['field_name'] == 'seller' ){
		if( $value['field_label'] ){ $field_label = $value['field_label']; }else{ $field_label = "Seller"; }
		$product_field_name = get_product_data($ID, 'seller');
		//echo $product_seller;
		
	}else if( isset($value['field_name']) && $value['field_name'] == 'model' ){
		if( $value['field_label'] ){ $field_label = $value['field_label']; }else{ $field_label = "Model"; }
		$product_field_name = get_product_data($ID, 'model');
		//echo $product_field_name;
		
	}else if( isset($value['field_name']) && $value['field_name'] == 'condition' ){
		if( $value['field_label'] ){ $field_label = $value['field_label']; }else{ $field_label = "Condition "; }
		$product_field_name = get_product_data($ID, 'condition');
		//echo $product_condition;
		
	}else if( isset($value['field_name']) && $value['field_name'] == 'harley_oem' ){
		if( $value['field_label'] ){ $field_label = $value['field_label']; }else{ $field_label = "Part No"; }
		$product_field_name = get_product_data($ID, 'harley_oem');
		//echo $product_harley_oem;
		
	}else if( isset($value['field_name']) && $value['field_name'] == 'part_no' ){
		if( $value['field_label'] ){ $field_label = $value['field_label']; }else{ $field_label = "Part No / OEM"; }
		$product_field_name = get_product_data($ID, 'part_no');
		//echo $product_part_no;
		
	}else if( isset($value['field_name']) && $value['field_name'] == 'category' ){
		if( $value['field_label'] ){ $field_label = $value['field_label']; }else{ $field_label = "Category"; }
		$product_field_name = get_product_data($ID, 'category');
		//echo $product_part_no;
		
	}else{
		if( $value['field_label'] ){ $field_label = $value['field_label']; }
		
		$product_field_name = get_product_data($ID, $value['field_name']);
		//echo $product_field_name;
	}
	
	
	if( !empty($product_field_name) ){
	?>	
		<div class="vc_row wpb_row vc_inner vc_row-fluid">
						<div class="wpb_column vc_column_container vc_col-sm-12">
							<div class="vc_column-inner">
								<div class="wpb_wrapper">
									<div class="vc_empty_space" style="height: 16px">
										<span class="vc_empty_space_inner"></span>
									</div>
									<div class="wpb_text_column wpb_content_element ">
										<div class="wpb_wrapper">
											<p><strong><?php echo $field_label; ?> :&nbsp; </strong><?php echo $product_field_name; ?></p>
										</div>
									</div>
									<div class="vc_empty_space" style="height: 16px">
										<span class="vc_empty_space_inner"></span>
									</div>
								</div>								
							</div>
						</div>
					</div>				
				<div class="vc_separator wpb_content_element vc_separator_align_center vc_sep_width_100 vc_sep_pos_align_center vc_separator_no_text"><span class="vc_sep_holder vc_sep_holder_l"><span style="border-color:#efefef;" class="vc_sep_line"></span></span><span class="vc_sep_holder vc_sep_holder_r"><span style="border-color:#efefef;" class="vc_sep_line"></span></span></div>
<?php
	}
	
	
	
	//return ob_get_clean();
	
	$content = ob_get_contents();
    ob_end_clean();
    return $content;
}

// product purchase url return  shortcode 
add_shortcode( 'product_purchase_url', 'product_purchase_url_callback');
function product_purchase_url_callback( $atts = '' ){
	ob_start();
		
	global $wpdb;	
				
	if( is_admin() ){
		return;
	}
	
	if( isset($_GET['ID']) && !empty($_GET['ID']) ){	
		$ID = $_GET['ID'];
	}else{
		wp_redirect(site_url());
		exit;
	}
	//echo "ID: ".$ID."<br>";
	
	$sql = "select Product_URL from product_data where id = ".$ID;
	//echo "sql: ".$sql."<br>";
	$result = $wpdb->get_results($sql);
		
	if( $result ){			
?>
		<div class="vc_btn3-container vc_btn3-inline">
			<a class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-square vc_btn3-style-modern vc_btn3-icon-right vc_btn3-color-danger custom-btn" href="<?php echo $result[0]->Product_URL; ?>" title="">Buy Now <i class="vc_btn3-icon fas fa-shopping-cart"></i></a>
		</div>
<?php		
	}else{
		wp_redirect(site_url());
		exit;
	}
	
	$content = ob_get_contents();
    ob_end_clean();
    return $content;	
}

// product purchase url return  shortcode 
add_shortcode( 'product_save_to_favourite', 'product_save_to_favourite_callback');
function product_save_to_favourite_callback( $atts = '' ){
	ob_start();
		
	global $wpdb;	
				
	if( is_admin() ){
		return;
	}
	
	if( isset($_GET['ID']) && !empty($_GET['ID']) ){	
		$ID = $_GET['ID'];
	}else{
		wp_redirect(site_url());
		exit;
	}
?>
		<div class="vc_btn3-container vc_btn3-inline">
			<a class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-square vc_btn3-style-modern vc_btn3-icon-right vc_btn3-color-green re-add-fav-btn custom-btn" href="javascript:void(0)" data-type="fav_product" data-id="<?php echo $ID; ?>" >Save to Favourites <i class="vc_btn3-icon stm-icon-star"></i></a>
		</div>
<?php
	$content = ob_get_contents();
    ob_end_clean();
    return $content;
}

add_action( 'wp_footer', 'footer_slider_callback', 999 );
function footer_slider_callback() {
?>
	<style>	
		.slider-nav .slick-list.draggable {
			width:90%
		}
		.slider-nav.slick-slider{
			display: flex;
			align-items: center;
			justify-content: center;
		}
		.slick-prev, .slick-next {
			position: relative !important;
			-webkit-transform: none;
			-ms-transform: inherit;
			transform: none;
		}
		.slick-prev {
			left: 0;
		}
		.slick-next {
			right: 0;
		}
		.slider-single{
			margin-bottom: 10px;
		}
		.slider-single .item.slick-slide img {
			width: 100%;
		}
		.slider-nav .item.slick-slide {
			padding: 0 15px;
			cursor: pointer;
		}
		.slider-nav .item.slick-slide .thumb-img {
			width: 100%;
			height: 150px;
			object-fit: cover;			
		}
		.slider-nav .slick-prev:before, .slider-nav .slick-next:before {
			color: #CC0000;
		}
		.slider-nav button.slick-next, .slider-nav button.slick-prev {
			box-shadow: none;
			cursor: pointer;
		}
		.slider-nav .item.slick-slide.slick-active img {
			border: 4px solid #ebebeb;
		}
		.slider-nav .item.slick-slide.slick-active.is-active img {
			border: 4px solid #cc0000;
		}

	</style>
	<script>
		$(document).ready(function(){

			$('.slider-single').slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				arrows: false,
				fade: true,
				infinite: false,
				//asNavFor: '.slider-nav',
			});
			
			$('.slider-nav')
			.on('init', function(event, slick) {
				$('.slider-nav .slick-slide.slick-current').addClass('is-active');
			})
			.slick({
				slidesToShow: 3,
				slidesToScroll: 1,
				dots: false,
				infinite: false,				
				focusOnSelect: true,
				//asNavFor: '.slider-single',
			});


			$('.slider-single').on('afterChange', function(event, slick, currentSlide) {
				$('.slider-nav').slick('slickGoTo', currentSlide);
				var currrentNavSlideElem = '.slider-nav .slick-slide[data-slick-index="' + currentSlide + '"]';
				$('.slider-nav .slick-slide.is-active').removeClass('is-active');
				$(currrentNavSlideElem).addClass('is-active');
			});

			$('.slider-nav').on('click', '.slick-slide', function(event) {
				event.preventDefault();
				var goToSingleSlide = $(this).data('slick-index');

				$('.slider-single').slick('slickGoTo', goToSingleSlide);
			});
			
			
		});
	</script>	
<?php
}

// productthumbnail slider shortcode
add_shortcode( 'product_slider', 'product_slider_callback');
function product_slider_callback( $atts = '' ){
	ob_start();
		
	global $wpdb;	
		
	wp_enqueue_style('slick-style');
	wp_enqueue_style('slick-theme-style');
	wp_enqueue_script('slick-js');
	
	
	if( is_admin() ){
		return;
	}
	
	if( isset($_GET['ID']) && !empty($_GET['ID']) ){	
		$ID = $_GET['ID'];
	}else{
		wp_redirect(site_url());
		exit;
	}
	//echo "ID: ".$ID."<br>";
	
	$sql = "select * from product_data where id = ".$ID;
	//echo "sql: ".$sql."<br>";
	$result = $wpdb->get_results($sql);
	
	
	$imagArr = array();
	if( $result ){		
		foreach( $result as $row ){
			if( !empty($row->Image_url_1) ){
				$imagArr[] = $row->Image_url_1;
			}
			if( !empty($row->Image_url_2) ){
				$imagArr[] = $row->Image_url_2;
			}
			if( !empty($row->Image_url_3) ){
				$imagArr[] = $row->Image_url_3;
			}
			if( !empty($row->Image_url_4) ){
				$imagArr[] = $row->Image_url_4;
			}
			if( !empty($row->Image_url_5) ){
				$imagArr[] = $row->Image_url_5;
			}
		}
	}else{
		wp_redirect(site_url());
		exit;
	}
	//print_r($imagArr);
	
	if( $imagArr ){
?>
	<div class="slider-single">
	<?php foreach($imagArr as $img_url ){ ?>
		<div class="item">
			<img src="<?php echo $img_url; ?>" class="main-img" />
		</div>
	<?php } ?>
	</div>
	
	<div class="slider-nav">
	<?php foreach($imagArr as $img_url ){ ?>
		<div class="item">
			<img src="<?php echo $img_url; ?>" class="thumb-img" />
		</div>
	<?php } ?>
	</div>
<?php	
	}

	$content = ob_get_contents();
    ob_end_clean();
    return $content;
}

/***** change page's <title> tag base on product id in query string on product detail page template *****/
add_filter( 'document_title_parts', 'custom_title_callback' );
function custom_title_callback($title_parts) {
	
	if ( is_page_template('template-product-detail.php') && isset($_GET['ID']) && !empty($_GET['ID']) ) {
		//echo "title_parts: <pre>"; print_r($title_parts); echo "</pre><br>";
		
		global $wpdb;		
		$sql = "select Product_Title from product_data where id = ".$_GET['ID'];
		$result = $wpdb->get_results($sql);
		if( $result && count($result) > 0 ){
			$product_title = $result[0]->Product_Title;
			//echo "product_title: ".$product_title;

			$title_parts['title'] = $product_title;
		}		
	}	
	
    return $title_parts;
}


/**
 * Remove Buddypress Author Page Redirect
 */
function yzc_remove_author_page_redirect() {
	remove_action( 'template_redirect', 'youzify_redirect_author_page_to_bp_profile', 5 );
}

add_action( 'init', 'yzc_remove_author_page_redirect', 5 );

/**
 * Remove Buddypress Author Link
 */
function yzc_remove_bp_author_profile_link() {
	remove_filter( 'author_link', 'youzify_edit_author_link_url', 9999, 3 );
}
add_action( 'init', 'yzc_remove_bp_author_profile_link' );





// product_item slider shortcode
add_shortcode( 'product_item', 'product_item_callback');
function product_item_callback( $atts ) {
	ob_start();
	global $wpdb;
	$atts = shortcode_atts( array(
		'product_id' => '',
		'width' => '',
	), $atts );

	    $product_ids = explode(',', $atts['product_id']);
    $sql = "SELECT * FROM product_data WHERE id IN (".implode(',',$product_ids).")";
	$result = $wpdb->get_results( $sql );

	if ( $result ) {
	?>
		<div class="product-shortcode">
			<?php foreach( $result as $row ) {
				$price_display = $row->Product_Currency . $row->Product_Price;
				?>
				<div class="product-item" style="width: <?php echo $atts['width']?>">
					<div class="row">
						<div class="col-md-4">
							<div class="item">
								<img src="<?php echo esc_url( $row->Image_url_1 ); ?>" class="thumb-img" />
							</div>
						</div>
						<div class="col-md-8">
							<h1><?php echo esc_html( $row->Product_Title ); ?></h1>
							<p><strong>Price: </strong><?php echo esc_html( $price_display ); ?></p>
							<div class="buttom-wapper">								
								<a style="text-decoration: none;" href="<?php echo esc_url( home_url( 'product-page-testv2/?ID=' . $row->id ) ); ?>" target="_blank">
									<div class="quick-view bg-light p-2 text-center border buy-now-buttom"> Quick View
										<svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 576 512" style="font-size: 14px;" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z"></path></svg>
									</div>
								</a>
								<a href="<?php echo esc_url( $row->Product_URL ); ?>">									
									<div class="buy-now bg-light p-2 text-center border buy-now-buttom"> Buy Now 
										<svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 576 512" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M528.12 301.319l47.273-208C578.806 78.301 567.391 64 551.99 64H159.208l-9.166-44.81C147.758 8.021 137.93 0 126.529 0H24C10.745 0 0 10.745 0 24v16c0 13.255 10.745 24 24 24h69.883l70.248 343.435C147.325 417.1 136 435.222 136 456c0 30.928 25.072 56 56 56s56-25.072 56-56c0-15.674-6.447-29.835-16.824-40h209.647C430.447 426.165 424 440.326 424 456c0 30.928 25.072 56 56 56s56-25.072 56-56c0-22.172-12.888-41.332-31.579-50.405l5.517-24.276c3.413-15.018-8.002-29.319-23.403-29.319H218.117l-6.545-32h293.145c11.206 0 20.92-7.754 23.403-18.681z"></path></svg>
									</div>
								</a>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
	<?php
	}

	$content = ob_get_clean();
	return $content;
}












add_shortcode('display_listings_by_ids', 'display_listings_by_ids_shortcode');
function display_listings_by_ids_shortcode($atts)
{
    // Parse shortcode attributes
    $atts = shortcode_atts(
        array(
            'ids' => '',
        ),
        $atts,
        'display_listings_by_ids'
    );
    // Split IDs into array
    $ids_array = explode(',', $atts['ids']);
    // Query listings by IDs
    $args = array(
        'post_type' => 'listings',
        'post__in' => $ids_array,
    );
    $$query = new WP_Query($args);
    // Display listings
    if ($$query->have_posts()) {
        ob_start();
        ?>
        <div class="listings-by-ids">
					<div class="stm_listing_tabs_style row">
          <?php
						while ($$query->have_posts()) : $$query->the_post();
						$regular_price_label = get_post_meta(get_the_ID(), 'regular_price_label', true);
						$special_price_label = get_post_meta(get_the_ID(),'special_price_label',true);

						$price = get_post_meta(get_the_id(),'price',true);
						$sale_price = get_post_meta(get_the_id(),'sale_price',true);
						$car_price_form_label = get_post_meta(get_the_ID(), 'car_price_form_label', true);
					?>
							<div class="col-md-6">
								<div class="row">
									<div class="listings-inner">
										<div class="col-md-4">
											<?php stm_listings_load_template('loop/classified/grid/image', $data); ?>
										</div>
										<div class="col-md-8">
											<div class="title-wapper">
												<h2><?php the_title(); ?></h2>
											</div>
											<div class="price-wapper">
												<div class="list_view_option_details_value priceheading">
													<!--<span class="car-price">£ <?php  //echo $Year->name;?></span>-->
													<?php if(stm_is_dealer_two() && $isSellOnline):?>
														<?php
															if(!empty($sale_price)) {
																$price = $sale_price;
															};
														?>
														<div class="sell-online-wrap price">
															<div class="normal-price">
																<span class="normal_font"><?php echo esc_html__('BUY ONLINE', 'motors'); ?></span>
																<span class="heading-font"><?php echo esc_attr(stm_listing_price_view($price)); ?></span>
															</div>
														</div>
													<?php else : ?>
														<?php if(empty($car_price_form_label)): ?>
															<?php if(!empty($price) and !empty($sale_price) and $price != $sale_price):?>
																<div class="car-price discounted-price">
																	<div class="regular-price"><?php echo esc_attr(stm_listing_price_view($price)); ?></div>
																	<div class="sale-price"><?php echo esc_attr(stm_listing_price_view($sale_price)); ?></div>
																</div>
															<?php elseif(!empty($price)): ?>
																<div class="car-price">
																	<div class="normal-price"><?php echo esc_attr(stm_listing_price_view($price)); ?></div>
																</div>
															<?php endif; ?>
														<?php else: ?>
															<div class="car-price">
																<div class="normal-price"><?php echo esc_attr($car_price_form_label); ?></div>
															</div>
														<?php endif; ?>
													<?php endif; ?>
												</div>
											</div>
											<?php
													$stm_car_location = get_post_meta(get_the_ID(), 'stm_car_location', true);
													$mileage  = get_post_meta(get_the_ID(), 'mileage', true);
													$engine  = get_post_meta(get_the_ID(), 'engine', true);
													$mot  = get_post_meta(get_the_ID(), 'mot', true);
													$Seller  = get_post_meta(get_the_ID(), 'seller', true);
													$Seller = get_the_terms( $post->ID, 'seller' );
													$Seller = $Seller[0];
													$Year = get_the_terms( $post->ID, 'ca-year' );

													$URL = get_post_meta( $post->ID, 'URL', true );
													$Year = $Year[0];

													$models  = get_the_terms( $post->ID, 'make' );
													$model = $models[0];
													if($mot == 'yes'){
															$mot = 'Yes';
													}else if($mot == 'no'){
															$mot = 'No';
													}
													else {
															$mot = 'N/A';
													}
													//Lat lang location
													$stm_to_lng = get_post_meta(get_the_ID(), 'stm_lng_car_admin', true);
													$stm_to_lat = get_post_meta(get_the_ID(), 'stm_lat_car_admin', true);

													$distance = '';
													if(!empty($_GET['ca_location'])){
															$stm_to_lng = get_post_meta(get_the_ID(), 'stm_lng_car_admin', true);
															$stm_to_lat = get_post_meta(get_the_ID(), 'stm_lat_car_admin', true);

															$stm_from_lng = esc_attr(floatval($_GET['stm_lng']));
															$stm_from_lat = esc_attr(floatval($_GET['stm_lat']));
															if (!empty($stm_to_lng) and !empty($stm_to_lat)) {
																	$distance = stm_calculate_distance_between_two_points($stm_from_lat, $stm_from_lng, $stm_to_lat, $stm_to_lng);
															}
													}

											 ?>
											<div class="meta-wapper">
												<div class="car-meta-bottom">
						                <ul>
																<li>
																	<div class="list_view_option_details_value">
																		<img src="<?php echo get_home_url(); ?>/wp-content/uploads/2021/09/4-2-harley-davidson-logo-black-and-white-black.png" class="sale-fa-icon">
																		<?php echo $model->name ? $model->name : "--"; ?>
																	</div>
																</li>
																	<li>
																		<div class="list_view_option_details_value">
																			<i class="fa fa-calendar" aria-hidden="true"></i>
																			<?php echo $Year->name ? $Year->name : "--"; ?>
																		</div>
																	</li>
																	<li>
																		 <div class="list_view_option_details_value">
																			 <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 576 512" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg" style="font-size: 15px;"><path d="M288 32C128.94 32 0 160.94 0 320c0 52.8 14.25 102.26 39.06 144.8 5.61 9.62 16.3 15.2 27.44 15.2h443c11.14 0 21.83-5.58 27.44-15.2C561.75 422.26 576 372.8 576 320c0-159.06-128.94-288-288-288zm0 64c14.71 0 26.58 10.13 30.32 23.65-1.11 2.26-2.64 4.23-3.45 6.67l-9.22 27.67c-5.13 3.49-10.97 6.01-17.64 6.01-17.67 0-32-14.33-32-32S270.33 96 288 96zM96 384c-17.67 0-32-14.33-32-32s14.33-32 32-32 32 14.33 32 32-14.33 32-32 32zm48-160c-17.67 0-32-14.33-32-32s14.33-32 32-32 32 14.33 32 32-14.33 32-32 32zm246.77-72.41l-61.33 184C343.13 347.33 352 364.54 352 384c0 11.72-3.38 22.55-8.88 32H232.88c-5.5-9.45-8.88-20.28-8.88-32 0-33.94 26.5-61.43 59.9-63.59l61.34-184.01c4.17-12.56 17.73-19.45 30.36-15.17 12.57 4.19 19.35 17.79 15.17 30.36zm14.66 57.2l15.52-46.55c3.47-1.29 7.13-2.23 11.05-2.23 17.67 0 32 14.33 32 32s-14.33 32-32 32c-11.38-.01-20.89-6.28-26.57-15.22zM480 384c-17.67 0-32-14.33-32-32s14.33-32 32-32 32 14.33 32 32-14.33 32-32 32z"></path></svg>
																			<?php echo $distance ? $distance : "--"; ?>
																		 </div>
																 </li>
						                </ul>
						            </div>

												<div class="car-meta-bottom">
						                <ul>
																<li>
						                        <div class="list_view_option_details_value">
																			<svg width="16" height="14" viewBox="0 0 16 14" fill="none" xmlns="http://www.w3.org/2000/svg">
																			<path d="M16 8.11352C16 5.92798 15.1187 3.94466 13.6933 2.49936C13.6822 2.48457 13.6703 2.47009 13.6568 2.45661C13.6433 2.44313 13.6289 2.43127 13.6141 2.4202C12.1688 0.994732 10.1855 0.113525 8 0.113525C5.81451 0.113525 3.83119 0.994784 2.38584 2.4202C2.37104 2.43132 2.35662 2.44318 2.34313 2.45661C2.32965 2.47009 2.3178 2.48452 2.30668 2.49936C0.881259 3.94466 0 5.92798 0 8.11352C0 10.2501 0.831948 12.2587 2.34256 13.7697C2.34277 13.7699 2.34298 13.7702 2.34319 13.7704C2.34334 13.7705 2.34345 13.7706 2.34361 13.7708C2.34382 13.771 2.34403 13.7712 2.34424 13.7714C2.42104 13.8482 2.5217 13.8865 2.62237 13.8865C2.72309 13.8865 2.82382 13.8481 2.90062 13.7713C2.90717 13.7647 2.9131 13.7577 2.91908 13.7508L4.13152 12.5383C4.28517 12.3846 4.28517 12.1356 4.13152 11.9819C3.97786 11.8283 3.72873 11.8283 3.57513 11.9819L2.62898 12.9281C1.52572 11.7004 0.885666 10.1552 0.797639 8.50697H2.13571C2.353 8.50697 2.52915 8.33086 2.52915 8.11352C2.52915 7.89619 2.353 7.72008 2.13571 7.72008H0.797744C0.889233 6.02712 1.56721 4.48766 2.63155 3.30151L3.57513 4.24509C3.65193 4.32189 3.75266 4.36029 3.85332 4.36029C3.95399 4.36029 4.05472 4.32189 4.13152 4.24509C4.28517 4.09139 4.28517 3.84231 4.13152 3.68866L3.18799 2.74503C4.37419 1.68069 5.9136 1.00271 7.60656 0.911269V2.24929C7.60656 2.46663 7.78271 2.64273 8 2.64273C8.21729 2.64273 8.39344 2.46663 8.39344 2.24929V0.911269C10.0864 1.00271 11.6258 1.68074 12.812 2.74508L11.8684 3.68866C11.7148 3.84236 11.7148 4.09144 11.8684 4.24509C11.9452 4.32189 12.046 4.36029 12.1466 4.36029C12.2473 4.36029 12.348 4.32189 12.4248 4.24509L13.3684 3.30151C14.4327 4.48772 15.1108 6.02712 15.2022 7.72008H13.8642C13.6469 7.72008 13.4707 7.89619 13.4707 8.11352C13.4707 8.33086 13.6469 8.50697 13.8642 8.50697H15.2023C15.1142 10.1552 14.4742 11.7004 13.371 12.9281L12.4248 11.9819C12.2712 11.8283 12.0221 11.8283 11.8684 11.9819C11.7148 12.1356 11.7148 12.3847 11.8684 12.5383L13.1004 13.7703C13.1772 13.8471 13.278 13.8855 13.3786 13.8855C13.4289 13.8855 13.4793 13.8759 13.5267 13.8567C13.574 13.8375 13.6184 13.8087 13.6569 13.7703C15.1678 12.2593 16 10.2503 16 8.11352Z" fill="#BCBCBC"/>
																			<path d="M9.8075 3.60158C9.60569 3.52074 9.37676 3.61874 9.29597 3.8205L8.15903 6.65853C8.10605 6.65286 8.05306 6.64898 8.00003 6.64898C7.44627 6.64898 6.94607 6.95571 6.69453 7.44946C6.4316 7.9656 6.49896 8.58231 6.87457 9.09903C6.91297 9.15186 6.96123 9.20017 7.01442 9.23883C7.31958 9.46068 7.66041 9.57793 8.00003 9.57793C8.55378 9.57793 9.05403 9.2712 9.30552 8.77746C9.56845 8.26131 9.50109 7.64466 9.12575 7.1283C9.08735 7.07532 9.03898 7.02685 8.98563 6.98803C8.95693 6.96715 8.92761 6.9481 8.89828 6.92911L10.0264 4.11306C10.1072 3.91141 10.0092 3.68237 9.8075 3.60158ZM8.6043 8.42026C8.48779 8.64893 8.25624 8.79099 7.99997 8.79099C7.83189 8.79099 7.66271 8.73229 7.49694 8.61646C7.30809 8.3453 7.271 8.05132 7.3957 7.8066C7.51216 7.57793 7.74371 7.43587 8.00003 7.43587C8.08176 7.43587 8.1637 7.45003 8.24543 7.47757C8.2481 7.47868 8.25057 7.48009 8.2533 7.48119C8.2619 7.4846 8.27056 7.48738 8.27921 7.49016C8.35423 7.51896 8.42893 7.55862 8.503 7.61035C8.6918 7.88151 8.72895 8.17554 8.6043 8.42026Z" fill="#BCBCBC"/></svg>
																			<?php echo $mileage ? esc_html( $mileage ) . ' mi' : '--'; ?>
																		</div>
						                    </li>
																	<li>
																		<div class="list_view_option_details_value">
																			<img class="sale-fa-icon" src="https://hd-central.com/wp-content/uploads/2021/09/pistons-cross.png" width="50" height="38">
																			<?php echo $engine ? $engine : "--"; ?>
																		</div>
																	</li>
																	<li>
																		<div class="list_view_option_details_value">
																			<i class="fa fa-map-marker" aria-hidden="true"></i>
																			<?php echo $stm_car_location ? $stm_car_location : "--"; ?>
																		</div>
																	</li>

						                </ul>
						            </div>
											</div>

											<div class="button-wapper">
												<div class="buttom-wapper">
														<a style="text-decoration: none;" href="#" target="_blank">
															<div class="quick-view bg-light p-2 text-center border buy-now-buttom">
																<svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 576 512" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M528.12 301.319l47.273-208C578.806 78.301 567.391 64 551.99 64H159.208l-9.166-44.81C147.758 8.021 137.93 0 126.529 0H24C10.745 0 0 10.745 0 24v16c0 13.255 10.745 24 24 24h69.883l70.248 343.435C147.325 417.1 136 435.222 136 456c0 30.928 25.072 56 56 56s56-25.072 56-56c0-15.674-6.447-29.835-16.824-40h209.647C430.447 426.165 424 440.326 424 456c0 30.928 25.072 56 56 56s56-25.072 56-56c0-22.172-12.888-41.332-31.579-50.405l5.517-24.276c3.413-15.018-8.002-29.319-23.403-29.319H218.117l-6.545-32h293.145c11.206 0 20.92-7.754 23.403-18.681z"></path></svg>
																  <?php echo $Seller->name; ?>
															</div>
														</a>
														<a style="text-decoration: none;" href="<?php echo the_permalink(); ?>">
															<div class="buy-now bg-light p-2 text-center border buy-now-buttom"> More Details
															</div>
														</a>
													</div>
											</div>
										</div>
									</div>
								</div>
							</div>

        	<?php endwhile; ?>
        	</div>
        </div>
        <?php
        wp_reset_postdata();
        return ob_get_clean();
    } else {
        return '<p>No listings found.</p>';
    }
}

/* These two functions no_author_base_rewrite_rules and no_author_base are for removing the "author" from the url */
/* https://hd-central.com/author/utsavtest-2/ */
/* https://wpdynamic.com/wordpress-developer/wordpress-code-snippets/how-to-remove-the-wordpress-author-prefix-from-slug/ */
add_filter('author_rewrite_rules', 'no_author_base_rewrite_rules');
function no_author_base_rewrite_rules($author_rewrite) { 
	global $wpdb;
	$author_rewrite = array();
	$authors = $wpdb->get_results("SELECT user_nicename AS nicename from $wpdb->users");    
	foreach($authors as $author) {
		$author_rewrite["({$author->nicename})/page/?([0-9]+)/?$"] = 'index.php?author_name=$matches[1]&paged=$matches[2]';
		$author_rewrite["({$author->nicename})/?$"] = 'index.php?author_name=$matches[1]';
	}   
	return $author_rewrite;
}
add_filter('author_link', 'no_author_base', 1000, 2);
function no_author_base($link, $author_id) {
	$link_base = trailingslashit(get_option('home'));
	$link = preg_replace("|^{$link_base}author/|", '', $link);
	return $link_base . $link;
}


// add_action('wp_footer', 'show_template');
// function show_template() {
//     if( is_super_admin() ){
//         global $template;
//         print_r($template); exit;
//     } 
// }

function dymic_opengraph_image() {
    
    if(is_author()) {
    $user_data = get_queried_object();
	$user_id = $user_data->ID;  
	$banner = get_the_author_meta('stm_dealer_banner', $user_id);
	if (!empty($banner)) {
		$img_src =$banner;
	} else {
		if (!empty($user_data->dealer_image)) :
			$img_src = esc_url($user_data->dealer_image);
		endif; 
	}
    ?>
    <meta property="og:image" content="<?php echo $img_src; ?>"/>
 
<?php
    }
}
add_action('wp_head', 'dymic_opengraph_image', 5);
