<?php
$data = stm_get_single_car_listings();

$terms_args = array(
	'orderby'    => 'name',
	'order'      => 'ASC',
	'hide_empty' => false,
	'fields'     => 'all',
	'pad_counts' => true,
);
//echo "++".$id;
if(!empty($id)){
 $term_obj_list = get_the_terms( $id, 'ca-year' );
        if ( ! empty( $term_obj_list ) && ! is_wp_error( $term_obj_list ) ) {
            $yeardata = $terms_string = join('-', wp_list_pluck($term_obj_list, 'slug'))." ";
        }
}				
$yeardata = trim($yeardata);
?>
<div class="stm_add_car_form_1 4443">
	<div class="stm-car-listing-data-single stm-border-top-unit stm-step-title">
		
		<div class="title heading-font"><span class="step_number step_number_1 heading-font"><?php esc_html_e( 'Step', 'motors' ); ?> 1</span><?php esc_html_e( '- Add Model Details', 'motors' ); ?></div>	
	</div>

	<?php /* ?><?php if(!empty($taxonomy)): ?>
		<div class="stm-form1-intro-unit">
			<div class="row">
				<?php foreach($taxonomy as $tax):
					$tax_info = stm_get_all_by_slug($tax);
					if (!empty($tax_info['listing_taxonomy_parent'])) {
						$terms = [];
					}
					else {
						$terms = stm_get_category_by_slug_all($tax, true);
					}

                    $has_selected = '';
                    if(!empty($id)) {
                        $post_terms = wp_get_post_terms($id, $tax);
                        if(!empty($post_terms[0])) {
                            $has_selected = $post_terms[0]->slug;
                        } elseif (!empty($tax_info["slug"])) {
	                        $has_selected = get_post_meta($id, $tax_info['slug'], true);
                        }
                    }
                    ?>
					<div class="col-md-3 col-sm-3 stm-form-1-selects">
						<div class="stm-label heading-font"><?php echo esc_html(stm_get_name_by_slug($tax)); ?>*</div>
						<?php
						$number_field = false;
						if($use_inputs) {
							//$tax_info = stm_get_all_by_slug($tax);
							if(!empty($tax_info['numeric']) and $tax_info['numeric']) {
								$number_field = true;
							}
						}
						?>
						<?php if($number_field): ?>
                            <?php $value = get_post_meta($id, $tax_info['slug'], true); ?>
							<input value="<?php echo esc_attr($value); ?>" min="0" type="number" name="stm_f_s[<?php echo esc_attr($tax); ?>]" required />
						<?php else: ?>
							<select class="add_a_car-select" data-class="stm_select_overflowed" data-selected="<?php echo esc_attr($has_selected); ?>" name="stm_f_s[<?php echo esc_attr(str_replace("-", "_pre_", $tax)); ?>]">
								<option value="" selected="selected"><?php esc_html_e('Select', 'motors'); ?> <?php echo esc_html(stm_get_name_by_slug($tax)); ?></option>
								<?php if(!empty($terms)):
									foreach($terms as $term): ?>
										<option value="<?php echo esc_attr($term->slug); ?>" <?php if(!empty($has_selected) and $term->slug == $has_selected) {echo 'selected';} ?>><?php echo trim(esc_attr($term->name)); ?></option>
									<?php endforeach; ?>
								<?php endif; ?>
							</select>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
				
				
			</div>
		</div>

		<style type="text/css">
			<?php foreach($taxonomy as $tax): ?>

			.stm-form1-intro-unit .select2-selection__rendered[title="<?php esc_html_e('Select', 'motors'); ?> <?php stm_dynamic_string_translation_e('Add A Car Step 1 Slug Name', stm_get_name_by_slug($tax)); ?>"] {
				background-color: transparent !important;
				border: 1px solid rgba(255,255,255,0.5);
				color: #fff !important;
			}
			.stm-form1-intro-unit .select2-selection__rendered[title="<?php esc_html_e('Select', 'motors'); ?> <?php stm_dynamic_string_translation_e('Add A Car Step 1 Slug Name', stm_get_name_by_slug($tax)); ?>"] + .select2-selection__arrow b {
				color: rgba(255,255,255,0.5);
			}
			<?php endforeach; ?>
		</style>
	<?php endif; ?><?php 
*/
	?>
	
	<div class="stm-form1-intro-unit stm-form1-intro-unit_custom testtt" style="display: none;">
		<div class="row">
			<div class="col-md-5 col-sm-5 stm-form-1-selects">
				
				<input type="text" id="regdata" name="stm_vin"
			<?php if (!empty($data_value)) { ?> class="stm_has_value" <?php } ?>
			   value="<?php echo esc_attr($data_value); ?>" placeholder="<?php esc_attr_e('Enter reg', 'motors'); ?>"/>
			   

			   <div class="stm-label heading-font"><?php echo esc_html("Registration"); ?>*</div>
			</div>
			<div class="col-md-3 col-sm-3 stm-form-1-selects">
				<select class="add_a_car-select" data-class="stm_select_overflowed" id="stm_f_country"  name="stm_f_country">
								<option value="" selected="selected"><?php esc_html_e('Select Country', 'motors'); ?> </option>
								<option value='United Kingdom'>United Kingdom</option>
								<option value='United States'>United States</option>
								<option value='Germany'>Germany</option>
								<option value='Netherlands '>Netherlands </option>
								<option value='Denmark'>Denmark</option>
								<option value='Finland'>Finland</option>
								<option value='France'>France</option>
								<option value='Ireland'>Ireland</option>
								<option value='Italy'>Italy</option>
								<option value='Norway'>Norway</option>
								<option value='Portugal'>Portugal</option>
								<option value='Spain'>Spain</option>
								<option value='Sweden'>Sweden</option>
								<option value='Australia'>Australia</option>
								<option value='New Zealand'>New Zealand</option>
								<option value='South Africa'>South Africa</option>
								<option value='United Arab Emirates'>United Arab Emirates</option>
								<option value='Slovakia'>Slovakia</option>
								<option value='Russia'>Russia</option>
								<option value='Argentina'>Argentina</option>
								<option value='Singapore'>Singapore</option>
								<option value='Brazil'>Brazil</option>
								<option value='Mexico'>Mexico</option>
								<option value='Iceland'>Iceland</option>
								<option value='Israel'>Israel</option>
								<option value='Malaysia'>Malaysia</option>
							</select>
			</div>
				<div class="col-md-4 col-sm-4 stm-form-1-selects">
	
			<button type="button" id="findbikedetails" class="enabled" >
                                                    Lookup                                            </button>
             </div>                                       
		</div>
	</div>
	<div class="stm-car-listing-data-single stm-border-top-unit " style="display:none;">
		<div class="text-center">or<br><span class="manually_text">Manually add your bike details</span></div>
		
	</div>
	<div class="stm-form1-intro-unit stm-form1-intro-unit_custom secondrow">
		<div class="stm-car-listing-data-single stm-border-top-unit border_bottom">
		<div class="title heading-font"><?php esc_html_e( 'Model', 'motors' ); ?></div>
	</div>
				<?php
			$years_terms = get_terms( array( 'taxonomy' => 'ca-year', 'hide_empty' => false, 'orderby' => 'name',
    'order' => 'DESC' ) );
	global $wpdb;
	$year_qry = "SELECT distinct product_year FROM ". $wpdb->prefix ."product_list";
	$y_result = $wpdb->get_results($year_qry);
	
		?>

		<div class="row">
			<div class="col-md-4 col-sm-4 col-xs-12 stm-form-1-selects">
				<div class="stm-label heading-font "><?php echo esc_html("Year"); ?>*<i class="fa fa-circle-o-notch fa-spin" id="loader1" style="display: none;"></i></div>
				<div class="add_year_custom"><select class="add_a_car-select" id="years" data-class="stm_select_overflowed"  name="stm_f_s[<?php echo esc_attr(str_replace("-", "_pre_", "ca-year")); ?>]">
					<option value=""><?php esc_html_e('Select Year', 'motors'); ?></option>
					
					<?php foreach( $y_result as $year ) { ?>
						<option value="<?php echo $year->product_year; ?>" <?php if( isset($yeardata) && $yeardata == $year->product_year){ echo "selected='selected'";} ?>><?php echo $year->product_year; ?></option>	
						
					<?php } ?>
				</select></div>
				
			</div>
		

		

			
			<!--<div class="col-md-4 col-sm-4 col-xs-12 stm-form-1-selects" style="display:none;">
				<?php 
					$value = '';
					if(!empty($id)) {
						$value = get_post_meta($id, 'model_ref', true);
					} 
				?>
				<div class="stm-label heading-font"><?php echo esc_html("Model Ref"); ?>*</div>	
				<input type="text" class="text_stm_model_ref" id="model_ref" placeholder="<?php esc_attr_e('Model Ref', 'motors'); ?>"  name="stm_f_s[<?php echo esc_attr(str_replace("-", "_pre_", "model_ref")); ?>]" value="<?php echo $value; ?>" />
				
			</div>-->
			
			<div class="col-md-4 col-sm-4 col-xs-12 stm-form-1-selects">
				
				<div class="stm-label heading-font"><?php echo esc_html("Model"); ?>* <i class="fa fa-circle-o-notch fa-spin" id="loader2" style="display: none;"></i></div>
				<div class="add_model_custom"><select class="add_a_car-select" id="make" data-class="stm_select_overflowed"  name="stm_f_s[<?php echo esc_attr(str_replace("-", "_pre_", "make")); ?>]">
					<option value=""><?php _e('Filter By Models', ''); ?></option>
					
					<?php
						if(!empty($id)){
									
							$term_obj_list1 = get_the_terms( $id, 'make' );
							if ( ! empty( $term_obj_list1 ) && ! is_wp_error( $term_obj_list1 ) ) {
								$makedata = $terms_string1 = join('-', wp_list_pluck($term_obj_list1, 'slug'))." ";
							}
							$makedata = trim($makedata);
							$makedata = get_term_by('slug', $makedata, 'make');
							//print_r($makedata);
							$makedata1 = trim($makedata->name);
							//echo "+++".$makedata;
							
							$args = array( 
								'post_type' => 'bike_guide', 
								'posts_per_page' => -1,
								'tax_query' => array(
									array(
										'taxonomy' => 'ca-year',
										'field' => 'slug',
										'terms' => $yeardata,
									)
								)
							);	
							$year_posts = new WP_Query($args);	
							$count_year = $year_posts->found_posts;
																
							$make_arr = array();	
							if( $year_posts->have_posts() ){					
								while( $year_posts->have_posts() ){
									$year_posts->the_post();			
									$make_terms = get_the_terms( get_the_ID(), 'make' );
									if ( !empty($make_terms) ){				
										foreach( $make_terms as $make ){
											$make_arr[$make->slug] = $make->name;
										}
									}
								}
							}
							//print_r($make_arr);
							//echo "<br>+++".$makedata;
						
							//if( isset($_REQUEST['year']) && !empty($_REQUEST['year']) ){								
							if( isset($yeardata) && !empty($yeardata) ){
								$ym_qry = "SELECT DISTINCT product_model FROM ". $wpdb->prefix ."product_list WHERE product_year = ".$yeardata;
								$ym_result = $wpdb->get_results($ym_qry);								
								foreach($ym_result as $model){	
						?>
									<option value="<?php echo $model->product_model; ?>" <?php if( isset($makedata1) && $makedata1 == $model->product_model){ echo "selected='selected'";} ?>><?php echo $model->product_model; ?></option>
						<?php			
								}
							}										
							
						}		
					?>
				</select></div>
				
			</div>
			<div class="col-md-4 col-sm-4 col-xs-12 stm-form-1-selects">
				<div class="stm-label heading-font"><?php echo esc_html("Range"); ?>* <i class="fa fa-circle-o-notch fa-spin" id="loader3" style="display: none;"></i></div>
				<div class="add_range_custom">
				<select class="add_a_car-select" id="model_range" data-class="stm_select_overflowed"  name="stm_f_s[<?php echo esc_attr(str_replace("-", "_pre_", "serie")); ?>]">
					
					<option value="" ><?php esc_html_e('Select Range', 'motors'); ?></option>
					<?php
						if(!empty($id)){
							
							$term_obj_list1 = get_the_terms( $id, 'make' );
							if ( ! empty( $term_obj_list1 ) && ! is_wp_error( $term_obj_list1 ) ) {
								$makedata = $terms_string1 = join('-', wp_list_pluck($term_obj_list1, 'slug'))." ";
							}
							$makedata = trim($makedata);
							
							$model_range = get_post_meta($id, 'model_range', true);
							//echo "+++".$model_range;
							
							
							// if( isset($_REQUEST['part_model']) && !empty($_REQUEST['part_model']) && isset($_REQUEST['part_year']) && !empty($_REQUEST['part_year']) ){
							if( isset($makedata) && !empty($makedata) && isset($yeardata) && !empty($yeardata) ){	
								$ymr_qry = "SELECT DISTINCT product_range FROM ". $wpdb->prefix ."product_list WHERE product_model = '".$makedata1."' AND product_year = ".$yeardata;
								$ymr_result = $wpdb->get_results($ymr_qry);
								foreach($ymr_result as $range){	
					?>
									<option value="<?php echo $range->product_range; ?>" <?php if( isset($model_range) && $model_range == $range->product_range){ echo "selected='selected'";} ?>><?php echo $range->product_range; ?></option>
					<?php			
								}
							}
						
						}
					?>	
					
				</select></div>
				
			</div>
			<div class="col-md-4 col-sm-4 col-xs-12 stm-form-1-selects">
				<a class="manually_add_bike" href="javascript:void(0);">Manually add your bike</a>
			</div>
		</div>
	</div>
	<script>
		jQuery(document).ready(function(){			
			
			<?php 
				if($yeardata != ''){ ?>
					jQuery("select#years").val('<?php echo $yeardata; ?>').trigger('change');
				<?php }
			 
				if($makedata != ''){ ?>
					jQuery("select#make").val('<?php echo trim($makedata1); ?>').trigger('change');
				<?php }
			
				if($model_range != ''){ ?>
					jQuery("select#model_range").val('<?php echo $model_range; ?>').trigger('change');
				<?php }
			?>
	
			jQuery('.manually_add_bike').click(function(){
				jQuery(".add_year_custom").html('');
				jQuery(".add_year_custom").append("<input placeholder='Year' type='text' name='stm_f_s[ca_pre_year]' class='form-control'>");
				jQuery(".add_model_custom").html('');
				jQuery(".add_model_custom").append("<input placeholder='Mode' type='text' name='stm_f_s[make]' class='form-control'>");
				jQuery(".add_range_custom").html('');
				jQuery(".add_range_custom").append("<input placeholder='Range' type='text' name='stm_f_s[serie]' class='form-control'>");
			});
			
			
			/*jQuery('select#years').change(function(){
				var selected_year = jQuery(this).val();	

				jQuery('#loader1').show();
				
				jQuery.ajax({		
					url: ajaxurl,
					method :'POST',
					dataType: 'html',
					data:{
						action : 'bike_year_change_custom',
						years :  selected_year
					},
					success:function(response){
						jQuery('#loader1').hide();					
						jQuery('#make').html(response);
						
						//jQuery('#serie').html("<option value=''>Filter By Models Range</option>");	
					},
					error: function(error){
						console.log(error);
					}
				});
			});
			
			jQuery('select#make').change(function(){
				var selected_model = jQuery(this).val();
				var selected_year = jQuery('#years').val();
				
				jQuery('#loader2').show();
						
				jQuery.ajax({		
					url: ajaxurl,
					method :'POST',
					dataType: 'html',
					data:{
						action : 'bike_model_year',
						model :  selected_model,
						years : selected_year
					},
					success:function(response){
						jQuery('#loader2').hide();					
						jQuery('#model_range').html(response);
					},
					error: function(error){
						console.log(error);
					}
				});
			});
			jQuery('select#model_range').change(function(){
				var model_range = jQuery(this).val();
				
				
				jQuery('#loader3').show();
						
				jQuery.ajax({		
					url: ajaxurl,
					method :'POST',
					
					data:{
						action : 'bike_model_range',
						model_range :  model_range,
						
					},
					success:function(response){
						jQuery('#loader3').hide();					
						//jQuery('input[name="stm_s_s_engine"]').val(response);
						$('input[name ="stm_s_s_engine"]').val(response);
						$('input[name ="stm_s_s_engine"]').prop("value", response);
                    	//jQuery('input[name ="stm_s_s_engine"]').prop('readonly', true);
					},
					error: function(error){
						console.log(error);
					}
				});
			});
		
			<?php if(!empty($id)){ ?>
			//$('#years').trigger('change');
			//$('#make').trigger('change');
			$('#make').val('<?php echo $makedata; ?>'); // Select the option with a value of '1'
                   // $('#make').trigger('change');
                    $('#model_range').val('<?php echo $model_range; ?>'); // Select the option with a value of '1'
                   // $('#model_range').trigger('change');
			<?php } ?>*/
		});
	</script>
	
	
	<script>
	jQuery(document).ready(function(){
		jQuery('select#years').change(function(){
			var selected_year = jQuery(this).val();	

			jQuery('.fa-spin').show();
			
			jQuery.ajax({		
				url: ajaxurl,
				method :'POST',
				dataType: 'json',
				data:{
					action : 'bike_year_change_custom',
					part_year :  selected_year
				},
				success:function(response){
					jQuery('.fa-spin').hide();					
					
					var len = response.length;
					
					jQuery("#make option:not(:first)").remove();
					jQuery("#model_range option:not(:first)").remove();
					
					
					for( var i = 0; i<len; i++){	
						jQuery('#make').append("<option value='"+response[i].model+"'>"+response[i].model+"</option>");
					}
					
				},
				error: function(error){
					console.log(error);
				}
			});
		});
		
		jQuery('select#make').change(function(){
			var selected_model = jQuery(this).val();
				var selected_year = jQuery('#years').val();
				
				jQuery('#loader2').show();
						
				jQuery.ajax({		
					url: ajaxurl,
					method :'POST',
					dataType: 'html',
					data:{
						action : 'bike_model_year_custom1',
						model :  selected_model,
						years : selected_year
					},
					success:function(response1){
						jQuery('#loader2').hide();					
						console.log(response1);
						var len_n = response1.length;
						console.log(len_n); 
						jQuery("#model_range option:not(:first)").remove();
						jQuery('#model_range').append(response1);
						
						
					},
					error: function(error){
						console.log(error);
					}
				});
		});
		
	});
</script>
	
		<div class="stm-car-listing-data-single stm-border-top-unit border_bottom">
		
	</div>


	<div class="stm-form-1-end-unit clearfix">
		
		<div class="firstbox-wrap">
			<div class="stm-car-listing-data-single stm-border-top-unit border_bottom">
				<div class="title heading-font"><?php esc_html_e( 'Bike Details', 'motors' ); ?></div>
			</div>
		<?php if ( ! empty( $data ) ): ?>
			<?php foreach ( $data as $data_key => $data_unit ): ?>
			<?php
                if(!in_array($data_unit['slug'], $taxonomy)) :
                $terms = get_terms( $data_unit['slug'], $terms_args );
                ?>
			<div class="stm-form-1-quarter container_<?php echo esc_attr( $data_unit['slug'] ); ?>">
				<div class="stm-label">
					<?php if ( ! empty( $data_unit['font'] ) ): ?>
						<i class="<?php echo esc_attr( $data_unit['font'] ); ?>"></i>
					<?php endif; ?>
					<?php stm_dynamic_string_translation_e('Add A Car Step 1 Taxonomy Label ' . $data_unit['single_name'], $data_unit['single_name']); ?>
				</div>
				<?php if ( ! empty( $data_unit['numeric'] ) and $data_unit['numeric'] ): ?>

					<?php $value = '';
					if(!empty($id)) {
						$value = get_post_meta($id, $data_unit['slug'], true);
					} 
					if(esc_attr( $data_unit['slug'] ) == 'engine'){
						?>
						<input
						type="text"
						class="form-control <?php echo (!empty($value)) ? 'stm_has_value' : ''; ?>"
						name="stm_s_s_<?php echo esc_attr( $data_unit['slug'] ); ?>"
						value="<?php echo esc_attr($value); ?>"
						placeholder="<?php printf(esc_attr__( 'Enter %s %s', 'motors' ), esc_attr__( $data_unit['single_name'], 'motors' ), ( ! empty( $data_unit['number_field_affix'] ) ) ? '(' . esc_attr__( $data_unit['number_field_affix'], 'motors' ) . ')' : '') ; ?>"
					/>
					<?php
					}else{
					?>

					<input
						type="number" onkeypress="return event.charCode >= 48" min="0" 
						class="form-control <?php echo (!empty($value)) ? 'stm_has_value' : ''; ?>"
						name="stm_s_s_<?php echo esc_attr( $data_unit['slug'] ); ?>"
						value="<?php echo esc_attr($value); ?>"
						placeholder="<?php printf(esc_attr__( 'Enter %s %s', 'motors' ), esc_attr__( $data_unit['single_name'], 'motors' ), ( ! empty( $data_unit['number_field_affix'] ) ) ? '(' . esc_attr__( $data_unit['number_field_affix'], 'motors' ) . ')' : '') ; ?>"
					/>
				<?php 
				}
			else: ?>
					<select name="stm_s_s_<?php echo esc_attr( $data_unit['slug'] ) ?>" class="add_a_car-select">
						<?php $selected = '';
						if(!empty($id)) {
							$selected = get_post_meta($id, $data_unit['slug'], true);
						}
						?>
						<option value=""><?php printf(esc_html__( 'Select %s', 'motors' ), esc_html__( $data_unit['single_name'], 'motors' )) ?></option>
						<?php if ( ! empty( $terms ) ):
							foreach ( $terms as $term ): ?>
								<?php
								$selected_opt = '';
								if($selected == $term->slug) {
									$selected_opt = 'selected';
								} ?>
								<option
									value="<?php echo esc_attr( $term->slug ); ?>" <?php echo esc_attr($selected_opt); ?>><?php echo esc_attr( $term->name ); ?></option>
							<?php endforeach; ?>
						<?php endif; ?>
					</select>
				<?php endif; ?>
				
			</div>
        <?php endif; ?>
		<?php endforeach; ?>

			<style type="text/css">
				<?php foreach($data as $data_unit): ?>

				.stm-form-1-end-unit .select2-selection__rendered[title="<?php echo esc_attr__('Select', 'motors'); ?> <?php stm_dynamic_string_translation_e('Add A Car Step 1 Taxonomy Label', $data_unit['single_name']); ?>"] {
					background-color: transparent !important;
					border: 1px solid rgba(255, 255, 255, 0.5);
					color: #888 !important;
				}

				<?php endforeach; ?>
			</style>

			<?php stm_listings_load_template('add_car/step_1_additional_fields', array('histories' => $stm_histories, 'post_id' => $id)); ?>

		<?php endif; ?>
	</div>
</div>
