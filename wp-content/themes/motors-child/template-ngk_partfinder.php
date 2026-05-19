<?php 
/* Template Name: NGK Parts Finder */ 

/* ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); */
set_time_limit(30000);

get_header();

$upload_dir  = wp_upload_dir();
global $wpdb;
//echo "+++".$wpdb->prefix;

$year_qry = "SELECT distinct model_year FROM  ngk_partfinder order by model_year DESC";
$y_result = $wpdb->get_results($year_qry);

if( isset($_REQUEST['filter_btn']) ){
	//print_r($_REQUEST);
	
	$sql = "SELECT * from ngk_partfinder where 1=1 ";
	
	$whereParts = array();
	if( isset($_REQUEST['part_year']) && !empty($_REQUEST['part_year']) ){
		$whereParts[] = "model_year = ".$_REQUEST['part_year'];
	}
	
	if( isset($_REQUEST['part_model']) && !empty($_REQUEST['part_model']) ){
		$whereParts[] = "Model = '".$_REQUEST['part_model']."' ";
	}
	
	if( isset($_REQUEST['part_range']) && !empty($_REQUEST['part_range']) ){
		$whereParts[] = "engine_size = '".$_REQUEST['part_range']."' ";
	}
	
	
	if( !empty($_REQUEST['part_year']) || !empty($_REQUEST['part_model']) || !empty($_REQUEST['part_range']) ){
		if(count($whereParts)){
			$sql .= "and ".implode(' AND ', $whereParts);
		}
		echo "++++".$sql."<br>";
		
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
						NGK Parts finder         
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
				<h2 class="no_access">can not access NKG parts finder. Please <a href="<?php echo get_permalink(17778); ?>">Login</a> to access it</h2>
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
				<form action="<?php echo($_SERVER["REQUEST_URI"]); ?>" method="get" class="filter_parts 767jghj">
					
					<div class="filter filter-sidebar">
						<div class="row row-pad-top-24">													
							<div class="col-md-3 col-sm-4 filter_col">
								<h5 class="pull-left">Years:</h5>
								<select name="part_year" id="part_years" class="form-control">
									<option value=""><?php _e('Filter By Years', ''); ?></option>
									<?php foreach($y_result as $year){ ?>
										<option value="<?php echo $year->model_year; ?>" <?php if( isset($_REQUEST['part_year']) && $_REQUEST['part_year'] == $year->model_year){ echo "selected";} ?>><?php echo $year->model_year; ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="col-md-3 col-sm-4 filter_col 55433">
								<h5 class="pull-left">Models:</h5>
								<select name="part_model" id="part_models" class="form-control">
									<option value=""><?php _e('Filter By Models', ''); ?></option>
									<?php
										if( isset($_REQUEST['part_year']) && !empty($_REQUEST['part_year']) ){
											$ym_qry = "SELECT DISTINCT Model FROM ngk_partfinder WHERE model_year = ".$_REQUEST['part_year'];
											$ym_result = $wpdb->get_results($ym_qry);
											foreach($ym_result as $model){	
									?>
												<option value="<?php echo $model->Model; ?>" <?php if( isset($_REQUEST['part_model']) && $_REQUEST['part_model'] == $model->Model){ echo "selected";} ?>><?php echo $model->Model; ?></option>
									<?php			
											}
										}
									?>									
								</select>
							</div>
							<div class="col-md-3 col-sm-4 filter_col rer">
								<h5 class="pull-left">Engine:</h5>
								<select name="part_range" id="part_ranges" class="form-control">
									<option value=""><?php _e('Filter By Engine Size', ''); ?></option>
									<?php
										if( isset($_REQUEST['part_model']) && !empty($_REQUEST['part_model']) && isset($_REQUEST['part_year']) && !empty($_REQUEST['part_year']) ){
											$ymr_qry = "SELECT DISTINCT engine_size FROM ngk_partfinder WHERE Model = '".$_REQUEST['part_model']."' AND model_year = ".$_REQUEST['part_year'];
											$ymr_result = $wpdb->get_results($ymr_qry);
											foreach($ymr_result as $range){	
									?>
												<option value="<?php echo $range->engine_size; ?>" <?php if( isset($_REQUEST['part_range']) && $_REQUEST['part_range'] == $range->engine_size){ echo "selected";} ?>><?php echo $range->engine_size; ?></option>
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
										<a href="<?php echo get_permalink(40679); ?>" class="button btn_reset">Reset </a>
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
				<table class="foo-table ninja_footable foo_table_14132 ninja_table_unique_id_677060762_14132 table  nt_type_legacy_table table-bordered vertical_centered  footable-paging-right ninja_table_search_disabled ninja_table_pro footable footable-1 breakpoint-lg">
					<thead>
						<tr>
							<th>
								Parkplug type:
							</th>
							<th>
								NGK Part No.:
							</th>
							<th>
								Sparkplug Gap:
							</th>
							
						</tr>
					</thead>
					<tbody>
				
				
					<?php foreach($results as $row){ 
					
						?>
							<tr id="pl_row_<?php echo $part->ref_no ."_". $part->id; ?>" data-tag="<?php echo $part->ref_no; ?>" data-partid="<?php echo $part->id; ?>" class="ari_part_info">
							<td class="ari_PLTag">
						
								<?php echo $row->sparkplug_type; ?>
							</td>
							<td class="ari_PLTag">
								<?php echo $row->ngk_partno; ?>
							</td>
							<td class="ari_PLTag">
								<?php echo $row->sparkplug_gap; ?>
							</td>
							</tr>		
					<?php } ?>	
					</tbody>
				</table>
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
					action : 'ngk_part_year_change',
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
					action : 'ngk_part_model_change',
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