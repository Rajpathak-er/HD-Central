<?php 
/* Template Name: Download Manuals */ 

function url_title($str, $separator = 'dash', $lowercase = FALSE)
 {
 	$str = str_replace(".pdf","",$str);
  if ($separator == 'dash')
  {
   $search  = '_';
   $replace = '-';
  }
  else
  {
   $search  = '-';
   $replace = '_';
  }

  $trans = array(
      '&\#\d+?;'    => '',
      '&\S+?;'    => '',
      '\s+'     => $replace,
      '[^a-z0-9\-\._]'  => '',
      $replace.'+'   => $replace,
      $replace.'$'   => $replace,
      '^'.$replace   => $replace,
      '\.+$'     => ''
       );

  $str = strip_tags($str);

  foreach ($trans as $key => $val)
  {
   $str = preg_replace("#".$key."#i", $val, $str);
  }

  if ($lowercase === TRUE)
  {
   $str = strtolower($str);
  }
	$str = str_replace("_"," ",$str);

  return trim(stripslashes($str));
 }

get_header();

$search = '';
if( isset($_GET['keyword']) ){
	$search = $_GET['keyword'];	
}


$bike_args = array( 
	'post_type' => 'bike_guide', 
	'posts_per_page' => -1,
	'post_status' => 'publish',
	
);

if( isset($_REQUEST['years']) && !empty($_REQUEST['years']) ){
	$bike_args['tax_query'][] = array(
		'taxonomy' => 'ca-year',
        'field' => 'id',
        'terms' => $_REQUEST['years'],
	);
}

if( isset($_REQUEST['make']) && !empty($_REQUEST['make']) ){
	$bike_args['tax_query'][] = array(
		'taxonomy' => 'make',
        'field' => 'id',
        'terms' => $_REQUEST['make'],
	);
}

$bike_guide_query = new WP_Query( $bike_args );
//echo "---".$bike_guide_query->found_posts; 
$bike_guide_query_ids = array();
if( !empty($_REQUEST['years']) || !empty($_REQUEST['make']) ){
	$bike_guide_query_ids = wp_list_pluck( $bike_guide_query->posts, 'ID' );	
}
//print_r($bike_guide_query_ids);



$args = array( 
	'post_type' => 'manuals', 
	'posts_per_page' => -1,
	
);

if( isset($_REQUEST['manual_type']) && !empty($_REQUEST['manual_type']) ){
	$args['tax_query'][] = array(
		'taxonomy' => 'manual_type',
        'field' => 'slug',
        'terms' => $_REQUEST['manual_type'],
	);
}

if( isset($_REQUEST['years']) && !empty($_REQUEST['years']) ){
	$args['tax_query'][] = array(
		'taxonomy' => 'manual_year',
        'field' => 'id',
        'terms' => $_REQUEST['years'],
	);
}

if( isset($_REQUEST['make']) && !empty($_REQUEST['make']) ){
	$args['tax_query'][] = array(
		'taxonomy' => 'manual_model',
        'field' => 'id',
        'terms' => $_REQUEST['make'],
	);
}


// if( !empty($_REQUEST['years']) || !empty($_REQUEST['make']) ){
	// $args['meta_query'][] = array(
		// 'key'     => 'bike_guide',
        // // 'value'   => $bike_guide_query_ids,
        // // 'compare' => 'IN',
		// //'value'   => sprintf(':"%s";', $bike_guide_query_ids),
		// //'value' => sprintf(';i:%s;', $bike_guide_query_ids),
        // //'compare' => 'LIKE',
		// 'value'   => serialize( $bike_guide_query_ids ),
        // 'compare' => 'LIKE',
	// );
// }
print_r($args);

$manuals_query = new WP_Query( $args );
//print_r($manuals_query);
// echo "<br><br>++".$manuals_query->found_posts;
// echo $manuals_query->request."<br>";


//$bikeguide = get_post_meta( 6814, 'bike_guide', true );
//echo "++".$bikeguide;
//echo "<br>";
//print_r($bikeguide);

?>
<div id="main">
	<div class="entry-header left small_title_box" style="">
		<div class="container">
			<div class="entry-title vc_row">
				<!--<div class="sub-title h5 vc_col-sm-3" style="<?php //echo implode( ' ', $title_style_subtitle ); ?>">
					<?php //echo do_shortcode('[widget id="search-3"]'); ?>
                    <h2><?php //echo apply_filters( 'stm_balance_tags', $sub_title ); ?></h2>
				</div>-->
                <div class="vc_col-sm-12 post_title_main_heading">
					<h2 class="h1" style="">
						Service , Owners, Parts guide            
					</h2>
				</div>
			</div>
		</div>
	</div>

	<!-- Breads -->	
	<div class="stm_breadcrumbs_unit heading-font ">
		<div class="container">
			<div class="navxtBreads" style="opacity: 0;">
				<!-- Breadcrumb NavXT 6.5.0 -->
								
			</div>
		</div>
	</div>
		
	<div class="container">
	<div class="row" style="margin-top: 10px;">
	
		
		<div class="col-md-12 col-sm-12">
			<div class="sidebar-margin-top clearfix"></div>
			<?php //if($_GET['keyword'] || $_REQUEST['years'] || $_REQUEST['make']){ ?>
			
			<?php 
				while ( have_posts() ) : the_post(); ?> <!--Because the_content() works only inside a WP Loop -->
					<div class="entry-content-page">
						<?php the_content(); ?> <!-- Page Content -->
					</div><!-- .entry-content-page -->
			<?php
				endwhile; //resetting the page loop
				wp_reset_query(); //resetting the page query
			?>
			
			<div class="classic-filter-row sidebar-sm-mg-bt" style="margin-top: 40px !important">
			<form action="<?php echo($_SERVER["REQUEST_URI"]); ?>" method="get" class="filter_guide">
				<div class="filter filter-sidebar">
					<div class="row row-pad-top-24">
						<div class="col-md-12 col-sm-12">
							<div class="clearfix">
								<h4 class="pull-left " style="text-transform: uppercase;">Filter</h4>
							</div>
						</div>
						
						<input type="hidden" class="" name="keyword" value="">
						
						<!--<div class="col-md-3 col-sm-12">
							<h5 class="pull-left">Search Keyword:</h5>
							<div class="form-group">
								<div class="keyword_container">
									<input type="text" id="keyword_filter" class="" placeholder="Enter keyword" name="keyword" value="<?php if(isset($_GET['keyword'])){echo $_GET['keyword'];} ?>">									
								</div>
							</div>
						</div>-->
						<?php /* ?><div class="col-md-3 col-sm-12">
							<h5 class="pull-left">Manual Type:</h5>
							<!--<select name="manual_type" id="manual_type" class="form-control">
								<option value=""><?php _e('Filter By Manual Type', ''); ?></option>
								<option value="owners"><?php _e('Owners Manuals', ''); ?></option>
								<option value="service"><?php _e('Service Manuals', ''); ?></option>
								<option value="parts"><?php _e('Parts Guide', ''); ?></option>								
                            </select>-->
							<select name="manual_type" id="manual_type" class="form-control">
								<option value=""><?php _e('Filter By Manual Type', ''); ?></option>
								<?php
									$manual_type_terms = get_terms( array( 'taxonomy' => 'manual_type', 'hide_empty' => false, 'orderby' => 'id', 'order' => 'ASC' ) );
									foreach( $manual_type_terms as $manual_type ) {
								?>
										<option value="<?php echo esc_attr( $manual_type->slug ); ?>" <?php if($_REQUEST['manual_type'] == $manual_type->slug){ echo "selected";} ?>><?php echo esc_html( $manual_type->name ); ?></option>
								<?php								
									}
								?>
                            </select>
						</div><?php */ ?>
						
						<div class="col-md-4 col-sm-12">
							<h5 class="pull-left">Years:</h5>
							<select name="years" id="years" class="form-control">
								<option value=""><?php _e('Filter By Years', ''); ?></option>
								<?php
									$termsdata  = get_terms_by_post_type(array('manual_year'),array('bike_guide'));
									//print_r($termsdata);	
									$termidarray = array();
									foreach ($termsdata as $key => $singleterms) {
										# code...
										//$termidarray[] =  $singleterms->term_id;
									}
									$terms_args = array(
										'orderby' => 'name',
										'order' => 'DESC',
										'hide_empty' => true,
										'fields' => 'all',
										'pad_counts' => false,
										'include' => $termidarray
									);
									
									$years_terms = get_terms('manual_year', $terms_args);
								
									//$years_terms = get_terms( array( 'taxonomy' => 'ca-year', 'hide_empty' => false, ) );
									foreach( $years_terms as $year ) {
								?>
										<option value="<?php echo esc_attr( $year->term_id ); ?>" <?php if($_REQUEST['years'] == $year->term_id){ echo "selected";} ?>><?php echo esc_html( $year->name ); ?></option>
								<?php								
									}
								?>
                            </select>
						</div>
						<div class="col-md-4 col-sm-12">
							<h5 class="pull-left">Models:</h5>
							<select name="make" id="make" class="form-control">
								<option value=""><?php _e('Filter By Models', ''); ?></option>
								<?php
									if( isset($_REQUEST['years']) && !empty($_REQUEST['years']) ){
										// get model based on years for dropdown
										$args = array( 
											'post_type' => 'manuals', 
											'posts_per_page' => -1,
											'tax_query' => array(
												array(
													'taxonomy' => 'manual_year',
													'field' => 'id',
													'terms' => $_REQUEST['years'],
												)
											)
										);	
										$year_posts = new WP_Query($args);	
										$count_year = $year_posts->found_posts;
										$make_arr = array();
										if( $year_posts->have_posts() ){					
											while( $year_posts->have_posts() ){
												$year_posts->the_post();			
												$make_terms = get_the_terms( get_the_ID(), 'manual_model' );
												if ( !empty($make_terms) ){				
													foreach( $make_terms as $make ){
														$make_arr[$make->term_id] = $make->name;
													}
												}
											}
										}
										
										foreach( $make_arr as $index => $value ) { 
								?>
											<option value="<?php echo $index; ?>" <?php if($_REQUEST['make'] == $index){ echo "selected";} ?>><?php echo $value; ?></option>
								<?php
										}										
									}else{
										
										$terms_args = array(
											'orderby' => 'name',
											'order' => 'ASC',
											'hide_empty' => true,
											'fields' => 'all',
											'pad_counts' => false,
											
										);
										
										$make_terms = get_terms('manual_model', $terms_args);
										//print_r($terms);
										
										//$make_terms = get_terms( array( 'taxonomy' => 'make', 'hide_empty' => false, ) );
										foreach( $make_terms as $make ) {
								?>	
											<option value="<?php echo esc_attr( $make->term_id ); ?>" <?php if($_REQUEST['make'] == $make->term_id){ echo "selected";} ?>><?php echo esc_html( $make->name ); ?></option>
								<?php
										}
									}
								?>
                            </select>
						</div>
												
						<div class="col-md-2 col-sm-12" style="margin-top: 20px;">
							<div class="clearfix">
								<button type="submit" name="filter_btn" class="button">Search <i class="fa fa-circle-o-notch fa-spin" id="loader" style="display: none;"></i></button>
							</div>
						</div>
						
						<div class="col-md-2 col-sm-12" style="margin-top: 20px !important;">
							<div class="clearfix">								
								<a type="submit"  href="<?php echo get_permalink(6730); ?>" name="filter_btn" class="button">Reset <i class="fa fa-circle-o-notch fa-spin" id="loader" style="display: none;"></i></a>
							</div>
						</div>
						
					</div>				
				</div>
			</form>	
			</div>	
			<style type="text/css">
		
		table > tbody tr td {
			padding: 9px 8px 8px;
			font-size: 14px;
			color: #888888;
			border: 1px solid #d5d9e0;
			}
			table tr td a {
			    color: #0000EE;
			}
			.manual_list td .manual_title {
			    text-transform: uppercase;
			    margin-bottom: 0;
			}
	</style>

			
			<?php
				//the_content();
				
				$make_arr = array();
				
				if( isset($_REQUEST['keyword']) ){
					?>
					<hr/>
			<h3>Results</h3>
			<table width="100%" class="manual_list">		
					<?php
					
					//$manuals_query = new WP_Query( $args );
					//echo "manual_count: ".$manuals_query->found_posts."<br>";
					//echo $manuals_query->request."<br>";
					
					
					if( $manuals_query->have_posts() ) {
						$i = 0;	
						while ( $manuals_query->have_posts() ) {
							$manuals_query->the_post();
							
							//echo "+++".get_the_ID()."<br>";
							////echo "+++".$manuals_query->post->ID."<br>";
							
							$manual_bikeguide = get_post_meta( get_the_ID(), 'bike_guide', true );
							// echo "<br>-------------<br>";
							// print_r($manual_bikeguide);
							
							
							
							if( !empty($_REQUEST['years']) || !empty($_REQUEST['make']) ){
								if( count(array_intersect($bike_guide_query_ids, $manual_bikeguide)) === 0 ){
									
									// No values from bike_guide_query_ids are in manual_bikeguide
									//echo "No values from bike_guide_query_ids are in manual_bikeguide<br>";
									//continue;		

								} else {
									
									// There is at least one value from bike_guide_query_ids present in manual_bikeguide
									//echo "There is at least one value from bike_guide_query_ids present in manual_bikeguide<br>";
								}
							}
							
							$i++;
							
							echo "<tr>";
							echo "<td>";
							//echo "<a href='".wp_get_attachment_url(get_the_ID())."'>";
							echo "<a href='".get_permalink()."'><p class='manual_title'>";
							$title = get_the_title();
							echo url_title($title);
							echo "</p></a></td>";

							 $favorite_title = '';

				        if ( is_user_logged_in() ) {
				          $user = wp_get_current_user();
				          $favorites = get_user_meta($user->ID, '_favorite_posts', true);
				          $fav_key = array_search(get_the_ID(), $favorites);
				          $is_favorite = ( $fav_key !== false );
				          if ( $is_favorite ) {
				            $favorite_class .= ' is-favorite';
				            $favorite_title = ' title="' . get_the_title() . ' ' . __('favorisieren', 'myTheme') . '"';
				          } else {
				            $favorite_title = ' title="' . get_the_title() . ' ' . __('nicht mehr favorisieren', 'myTheme') . '"';
				          }
				        }

							echo "<td>";
							wpfp_link();
							
							echo "</td>";
							echo "</tr>";
							
							
						}
						
						// // Restore original post data.
						// wp_reset_postdata();
						
						// echo "++".$i;
						
						if( $i == 0 ){
							echo "<tr><td>no result found</td></tr>";
						}
						
					}else{
						echo "<tr><td>no result found</td></tr>";
					}	
					
					// // // Restore original post data.
					// // wp_reset_postdata();	
						
				}				
			?>
			</table>
			<?php //}?>		
		</div>
		<!--
			<div class="col-md-3 col-sm-12">
			<?php //echo do_shortcode('[stm_sidebar sidebar="26599"]'); ?>
			
			<h4 style="font-size: 15px;text-align: left" class="vc_custom_heading weather-title">84 Technical</h4>
			<?php //echo do_shortcode('[widget id="wpdevart_vertical_menu_widget-2"]'); ?>
			
			<aside id="archives-3" class="widget widget-default widget_archive">
				<div class="widget-title">
					<h4>Archives</h4>
				</div>		
				<ul>
					<li><a href="https://hd-central.com/2020/07/">July 2020</a></li>
					<li><a href="https://hd-central.com/2019/12/">December 2019</a></li>
					<li><a href="https://hd-central.com/2015/12/">December 2015</a></li>
					<li><a href="https://hd-central.com/2015/11/">November 2015</a></li>
				</ul>
			</aside>
			Please enter the Page ID of the Facebook feed you'd like to display. You can do this in either the Custom Facebook Feed plugin settings or in the shortcode itself. For example, [custom-facebook-feed id=YOUR_PAGE_ID_HERE].<br><br>
			<aside id="text-2" class="widget widget-default widget_text">
				<div class="textwidget">
				</div>
			</aside>
			
			

		</div>
		-->
	</div>
</div>

<script>

	

	jQuery(document).ready(function(){
		
		jQuery('select#years').change(function(){
			var selected_year = jQuery(this).val();	

			jQuery('#loader').show();
			
			jQuery.ajax({		
				url: ajaxurl,
				method :'POST',
				dataType: 'html',
				data:{
					action : 'manual_bike_year',
					years :  selected_year
				},
				success:function(response){
					jQuery('#loader').hide();					
					jQuery('#make').html(response);
					
					//jQuery('#serie').html("<option value=''>Filter By Models Range</option>");	
				},
				error: function(error){
					console.log(error);
				}
			});
		});
		
		// jQuery('select#make').change(function(){
			// var selected_model = jQuery(this).val();
			// var selected_year = jQuery('#years').val();
			
			// jQuery('#loader').show();
					
			// jQuery.ajax({		
				// url: ajaxurl,
				// method :'POST',
				// dataType: 'html',
				// data:{
					// action : 'bike_model',
					// model :  selected_model,
					// years : selected_year
				// },
				// success:function(response){
					// jQuery('#loader').hide();					
					// jQuery('#serie').html(response);
				// },
				// error: function(error){
					// console.log(error);
				// }
			// });
		// });
	});
</script>
	<?php
	
	get_footer();