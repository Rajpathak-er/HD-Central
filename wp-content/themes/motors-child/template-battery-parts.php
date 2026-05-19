<?php 
/* Template Name: Battery Parts Template */ 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

get_header();

$upload_dir  = wp_upload_dir();
global $wpdb;
//echo "+++".$wpdb->prefix;

$model_qry = "SELECT distinct vehicle_model FROM ". $wpdb->prefix ."battery_product_list";
$model_result = $wpdb->get_results($model_qry);

if( isset($_REQUEST['filter_btn']) ){
	//print_r($_REQUEST);
	
	$sql = "SELECT * from ". $wpdb->prefix ."battery_product_list where 1=1 ";
	
	$whereParts = array();
	if( isset($_REQUEST['battery_model']) && !empty($_REQUEST['battery_model']) ){
		$whereParts[] = "vehicle_model = '".$_REQUEST['battery_model']."' ";
	}
	
	if( isset($_REQUEST['battery_year']) && !empty($_REQUEST['battery_year']) ){
		$whereParts[] = "vehical_year = '".$_REQUEST['battery_year']."' ";
	}
	
	if( !empty($_REQUEST['battery_model']) || !empty($_REQUEST['battery_year']) ){
		if(count($whereParts)){
			$sql .= "and ".implode(' AND ', $whereParts);
		}
		//echo "++++".$sql."<br>";
		
		$results = $wpdb->get_results($sql);
		$results_count = count($results);
		//echo "----".$results_count;
	}else{
		$results_count = 0;
	}
	
	// /********** get data if all 2 column is set **********/
	// // $sql = "SELECT * from ". $wpdb->prefix ."battery_product_list where vehicle_model = ".$_REQUEST['battery_model']." AND vehical_year = '".$_REQUEST['battery_year']."' ";	
	// // echo "++++".$sql;	
	// // $results = $wpdb->get_results($sql);
}

?>
	<div class="entry-header left small_title_box" style="">
		<div class="container">
			<div class="entry-title vc_row">
				<!--<div class="sub-title h5 vc_col-sm-3" style="<?php //echo implode( ' ', $title_style_subtitle ); ?>">
					<?php //echo do_shortcode('[widget id="search-3"]'); ?>
                    <h2><?php //echo apply_filters( 'stm_balance_tags', $sub_title ); ?></h2>
				</div>-->
			</div>
				<div class="vc_col-sm-12 post_title_main_heading">
					<h2 class="h1" style="">
						Battery Parts         
					</h2>
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
	
		<div class="col-md-3 col-sm-12">
			<div class="classic-filter-row sidebar-sm-mg-bt" style="margin-top: 20px;">
				<form action="<?php echo($_SERVER["REQUEST_URI"]); ?>" method="get" class="filter_parts">
					
					<div class="filter filter-sidebar">
						<div class="row row-pad-top-24">													
							<div class="col-md-12 col-sm-12">
								<h5 class="pull-left">Models:</h5>
								<select name="battery_model" id="battery_models" class="form-control">
									<option value=""><?php _e('Filter By Models', ''); ?></option>
									<?php foreach($model_result as $model){ ?>
										<option value="<?php echo $model->vehicle_model; ?>" <?php if( isset($_REQUEST['battery_model']) && $_REQUEST['battery_model'] == $model->vehicle_model){ echo "selected";} ?>><?php echo $model->vehicle_model; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>				
					
						<div class="row row-pad-top-24">	
							<div class="col-md-12 col-sm-12">
								<h5 class="pull-left">Years:</h5>
								<select name="battery_year" id="battery_years" class="form-control">
									<option value=""><?php _e('Filter By Years', ''); ?></option>
									<?php
										if( isset($_REQUEST['battery_model']) && !empty($_REQUEST['battery_model']) ){
											$my_qry = "SELECT DISTINCT vehical_year FROM ". $wpdb->prefix ."battery_product_list WHERE vehicle_model = '".$_REQUEST['battery_model']."' ";
											$my_result = $wpdb->get_results($my_qry);
											foreach($my_result as $year){	
									?>
												<option value="<?php echo $year->vehical_year; ?>" <?php if( isset($_REQUEST['battery_year']) && $_REQUEST['battery_year'] == $year->vehical_year){ echo "selected";} ?>><?php echo $year->vehical_year; ?></option>
									<?php			
											}
										}
									?>									
								</select>
							</div>			
						</div>				
																
						<div class="row row-pad-top-24">
							<div class="col-md-12 col-sm-12" style="margin-top: 20px;">
								<div class="clearfix">
									<button type="submit" name="filter_btn" class="button btn_search">Search <i class="fa fa-circle-o-notch fa-spin" id="loader_icon" style="display: none;"></i></button>
								</div>
							</div>
						
							<div class="col-md-12 col-sm-12" style="margin-top: 20px !important;">
								<div class="clearfix">								
									<a href="<?php echo get_permalink(27607); ?>" class="button">Reset </a>
								</div>
							</div>
						</div>				
					</div>	
						
				</form>	
			</div>
		</div>
		
		<div class="col-md-9 col-sm-12">
			<div class="sidebar-margin-top clearfix"></div>
			<?php 
				while ( have_posts() ) : the_post(); ?> <!--Because the_content() works only inside a WP Loop -->
					<div class="entry-content-page">
						<?php the_content(); ?> <!-- Page Content -->
					</div><!-- .entry-content-page -->
			<?php
				endwhile; //resetting the page loop
				wp_reset_query(); //resetting the page query
			?>
					
			<style type="text/css">
				.battery_container {
					position: relative;
					overflow: hidden;
					background: #ebebeb;
					border: 1px solid #cacaca;
					margin-bottom: 20px;
				}
				.battery_container .product_image{
					background-color: #fff;
					/*height: 245px;
					display: flex;*/
				}				
				.battery_container .product_details{
					padding: 25px;
				}
				.battery_name {
					font-size: 18px;
					font-weight: 800;
					color: #000;
					line-height: 24px;
				}
				.listing_features{
					margin-bottom: 10px;
				}
				.listing_features dt {
					font-weight: 700;
					color: #111;
				}
				.product_details .price{
					color: #000;
					font-weight: 700;
					font-size: 12px;
				}
				.product_details .price_primary{
					font-size: 18px;
				}
				.btn_search{
					width: 100%;
				}
				@media only screen and (min-width: 768px){
					.battery_container .product_image img{
						width: 100%;
						height: 245px;
						object-fit: contain;
					}
				}
			</style>
			
			<div class="part_row" style="margin: 40px 0 20px 0;">
			<?php
				if( isset($_REQUEST['filter_btn']) ){
					if( $results_count > 0  ){
			?>
				<h3>Results</h3>
				<div class="battery_result_container">	
					<div class="row">
					<?php foreach($results as $row){ ?>
						<div class="col-md-4 col-sm-4 col-xs-12">
							<div class="part_container battery_container">
								<div class="product_image">
									<img src="<?php echo $upload_dir['baseurl']; ?>/battery/product_image/<?php echo $row->product_sku; ?>.jpg" class="img-responsive bttery_img">
								</div>
								<div class="product_details">
									<div class="battery_name"><?php echo $row->product_name; ?></div>
									<dl class="listing_features">
										<dt>Capacity (20hr)</dt>
										<dd><?php echo $row->product_capacity; ?></dd>
										<dt>CCA (EN)</dt>
										<dd><?php echo $row->product_cca; ?></dd>
									</dl>
									<span class="price price_primary"><?php echo $row->primary_price_formatted; ?></span>
									<span class="price price_secondary">(<?php echo $row->secondary_price_formatted; ?>)</span>
								</div>
							</div>
						</div>
					<?php } ?>	
					</div>
				</div>
			<?php 
					}else{
						echo '<div class="no_data">no result found</div>';
					}
				}
			?>
			</div>
			
		</div>
		
	</div>
</div>

<script>
	jQuery(document).ready(function(){
		jQuery('select#battery_models').change(function(){
			var selected_model = jQuery(this).val();	

			jQuery('#loader_icon').show();
			
			jQuery.ajax({		
				url: ajaxurl,
				method :'POST',
				dataType: 'json',
				data:{
					action : 'battery_model_change',
					battery_model :  selected_model
				},
				success:function(response){
					jQuery('#loader_icon').hide();					
					jQuery("#battery_years option:not(:first)").remove();
					
					var len = response.length;					
					for( var i = 0; i<len; i++){
						jQuery('#battery_years').append("<option value='"+response[i].year+"'>"+response[i].year+"</option>");
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
	get_footer();
?>