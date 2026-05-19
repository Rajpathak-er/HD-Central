<?php 
/* Template Name: OEM Parts Finder */ 

/* ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); */

set_time_limit(30000);

get_header();

$upload_dir  = wp_upload_dir();
global $wpdb;
//echo "+++".$wpdb->prefix;

$year_qry = "SELECT distinct product_year FROM ". $wpdb->prefix ."product_list";
$y_result = $wpdb->get_results($year_qry);

if( isset($_REQUEST['filter_btn']) ){
	//print_r($_REQUEST);
	
	$sql = "SELECT * from ". $wpdb->prefix ."product_list where 1=1 ";
	
	$whereParts = array();
	if( isset($_REQUEST['part_year']) && !empty($_REQUEST['part_year']) ){
		$whereParts[] = "product_year = ".$_REQUEST['part_year'];
	}
	
	if( isset($_REQUEST['part_model']) && !empty($_REQUEST['part_model']) ){
		$whereParts[] = "product_model = '".$_REQUEST['part_model']."' ";
	}
	
	if( isset($_REQUEST['part_range']) && !empty($_REQUEST['part_range']) ){
		$whereParts[] = "product_range = '".$_REQUEST['part_range']."' ";
	}
	
	
	if( !empty($_REQUEST['part_year']) || !empty($_REQUEST['part_model']) || !empty($_REQUEST['part_range']) ){
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
	
	// /********** get data if all 3 column is set **********/
	// // $sql = "SELECT * from ". $wpdb->prefix ."product_list where product_year = ".$_REQUEST['part_year']." AND product_model = '".$_REQUEST['part_model']."' AND product_range = '".$_REQUEST['part_range']."' ";	
	// // echo "++++".$sql;	
	// // $results = $wpdb->get_results($sql);
}

?>
	<style type="text/css">
		.part_container {
			position: relative;
			overflow: hidden;
			height: 215px;
			background: #fff;
			border: 1px solid #ccc;
			margin-bottom: 20px;
		}
		.part_img{
			width: 100%;
		}
		.part_name {
			width: 100%;
			/* height: 60px; */
			position: absolute;
			overflow: hidden;
			bottom: 0;
			left: 0;
			padding: 5px;
			background: #eee;
			border-top: 1px solid #bbb;
			text-align: center;
			line-height: 16px;
			color: #555555;
		}
		.btn_search{
			width: 100%;
		}
	</style>

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
						OEM Parts finder         
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

	<?php if( !is_user_logged_in() ){ ?>
		<div class="row" style="margin-top: 10px;">
			<div class="col-md-12 col-sm-12">
				<h2 class="no_access">can not access OEM parts finder. Please <a href="<?php echo get_permalink(17778); ?>">Login</a> to access it</h2>
			</div>
		</div>
	<?php } ?>

	<?php if( is_user_logged_in() ){ ?>
	<div class="row" style="margin-top: 10px;">

		<div class="col-md-12 col-sm-12">
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
							
		</div>

		<div class="col-md-12 col-sm-12">
			<div class="classic-filter-row sidebar-sm-mg-bt" style="margin: 20px 0;">
				<form action="<?php echo($_SERVER["REQUEST_URI"]); ?>" method="get" class="filter_parts">
					
					<div class="filter filter-sidebar">
						<div class="row row-pad-top-24">													
							<div class="col-md-3 col-sm-4 filter_col">
								<h5 class="pull-left">Years:</h5>
								<select name="part_year" id="part_years" class="form-control">
									<option value=""><?php _e('Filter By Years', ''); ?></option>
									<?php foreach($y_result as $year){ ?>
										<option value="<?php echo $year->product_year; ?>" <?php if( isset($_REQUEST['part_year']) && $_REQUEST['part_year'] == $year->product_year){ echo "selected";} ?>><?php echo $year->product_year; ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="col-md-3 col-sm-4 filter_col">
								<h5 class="pull-left">Models:</h5>
								<select name="part_model" id="part_models" class="form-control">
									<option value=""><?php _e('Filter By Models', ''); ?></option>
									<?php
										if( isset($_REQUEST['part_year']) && !empty($_REQUEST['part_year']) ){
											$ym_qry = "SELECT DISTINCT product_model FROM ". $wpdb->prefix ."product_list WHERE product_year = ".$_REQUEST['part_year'];
											$ym_result = $wpdb->get_results($ym_qry);
											foreach($ym_result as $model){	
									?>
												<option value="<?php echo $model->product_model; ?>" <?php if( isset($_REQUEST['part_model']) && $_REQUEST['part_model'] == $model->product_model){ echo "selected";} ?>><?php echo $model->product_model; ?></option>
									<?php			
											}
										}
									?>									
								</select>
							</div>
							<div class="col-md-3 col-sm-4 filter_col">
								<h5 class="pull-left">Range:</h5>
								<select name="part_range" id="part_ranges" class="form-control">
									<option value=""><?php _e('Filter By Range', ''); ?></option>
									<?php
										if( isset($_REQUEST['part_model']) && !empty($_REQUEST['part_model']) && isset($_REQUEST['part_year']) && !empty($_REQUEST['part_year']) ){
											$ymr_qry = "SELECT DISTINCT product_range FROM ". $wpdb->prefix ."product_list WHERE product_model = '".$_REQUEST['part_model']."' AND product_year = ".$_REQUEST['part_year'];
											$ymr_result = $wpdb->get_results($ymr_qry);
											foreach($ymr_result as $range){	
									?>
												<option value="<?php echo $range->product_range; ?>" <?php if( isset($_REQUEST['part_range']) && $_REQUEST['part_range'] == $range->product_range){ echo "selected";} ?>><?php echo $range->product_range; ?></option>
									<?php			
											}
										}
									?>		
								</select>
							</div>
							<div class="col-md-3 col-sm-4 filter_col_btn">
								<div class="row row-pad-top-24">	
									<div class="col-md-6 col-sm-6 btn_container">
										<button type="submit" name="filter_btn" class="button btn_search">Search <i class="fa fa-circle-o-notch fa-spin" id="loader_icon" style="display: none;"></i></button>
									</div>
									<div class="col-md-6 col-sm-6 btn_container">								
										<a href="<?php echo get_permalink(26822); ?>" class="button btn_reset">Reset </a>
									</div>
								</div>
							</div>
						</div>			
					</div>	
						
				</form>	
			</div>

			<div class="part_row" style="margin: 40px 0 20px 0;">
			<?php
				if( isset($_REQUEST['filter_btn']) ){
					if( $results_count > 0  ){
			?>
				<h3>Results</h3>
				<div class="parts_result_container">	
					<div class="row">
					<?php foreach($results as $row){ 
						$part_src = $row->part_src;
						// remove '/Small' from url 
						$url = explode('/', $part_src);
						array_pop($url);
						$part_src = implode('/', $url);
			
						//echo "part_src: ".$part_src."<br>";			
						
						$image_name = basename($part_src);
						$image_name = $image_name.".jpg";
						?>
						<div class="col-md-3 col-sm-4 col-xs-6">
							<div class="part_container">
								<a href="<?php echo get_permalink(26833); ?>?id=<?php echo $row->id; ?>" >
									<!--<img src="<?php echo $upload_dir['baseurl']; ?>/2020/07/placeholder.png" class="img-responsive part_img">-->
									<img src="https://d3w1ljn98p0vd6.cloudfront.net/parts/<?php echo $image_name; ?>" class="img-responsive part_img">
									<div class="part_name"><?php echo $row->part_name; ?></div>
								</a>
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
		</div><!-- end of col-md-12 -->			
			
	</div><!-- end of row -->	
	
	<?php } ?>
	
</div>

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
<style type="text/css">
	.page-template-template-oem-parts-finder .classic-filter-row .filter-sidebar{
		    padding: 12px !important;
	}
	.page-template-template-oem-parts-finder  .filter-sidebar .pull-left{
		margin-top: 10px !important;
    	margin-bottom: 0px !important;
	}

</style>
<?php
	get_footer();
?>