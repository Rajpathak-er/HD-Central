<?php 



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


$user = stm_get_user_custom_fields('');
	$arr = array();
	//echo $user['user_id'];
  if(isset($_POST) && $_POST['save'] == 'Submit'){
	
	//print_r($_POST);
	//echo $_POST['serie'];
	$mybike = get_user_meta($user['user_id'], 'my_bike', true);
	
	 $mybike = $mybike .','.$_POST['serie'];
	 $mybike = trim($mybike,',');
	//die();
	
	 update_user_meta($user['user_id'],'my_bike',$mybike);
 }
 
 if(!empty($_REQUEST['rid'])){
	
	$mybikesdata = get_user_meta($user['user_id'], 'my_bike', true);
	$mybikesdata = explode(',',$mybikesdata);
	//print_r($mybikesdata);
	$key = array_search($_REQUEST['rid'], $mybikesdata);
	if (false !== $key) {
		unset($mybikesdata[$key]);
	}
	$bikemtea = '';
	//print_r($mybikesdata);
	foreach($mybikesdata as $mybikeval){
		$bikemtea .= ','.$mybikeval;
	}
	$bikemtea = trim($bikemtea,',');
	update_user_meta($user['user_id'], "my_bike",$bikemtea);
	//echo get_user_meta($user['user_id'], 'my_bike', true);
}
 
 global $wpdb;
//echo "+++".$wpdb->prefix;

$year_qry = "SELECT distinct product_year FROM ". $wpdb->prefix ."product_list";
$y_result = $wpdb->get_results($year_qry);


?>

<?php
$user_id = get_current_user_id();
$parts = get_user_meta( $user_id, "my_parts",true );

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

if(!empty($_REQUEST['id'])){
	
	$key = array_search($_REQUEST['id'], $parts);
	if (false !== $key) {
		unset($parts[$key]);
	}
	update_user_meta($user_id, "my_parts",$parts);
}

?>
<style type="text/css">
	.collapse.in{
		display: block !important;
	}
	.stm-keyword-search-unit {
	    font-weight: 900;
	    color: #000;
	    padding: 15px 0 0;
	}
	.stm-keyword-search-unit a.button {
	    margin-top: 15px;
	    margin-left: 0;
	    box-shadow: none;
	}
	.stm-keyword-search-unit a {
	    color: #d60f17;
	    margin-left: 8px;
	}
</style>

 <!--Main information-->
<div class="stm-change-block">
	


</div>
	<div class="main-info-settings harley_ownership ">
		<div class="stm-accordion-single-unit stm-listing-directory-checkboxes stm-one_col stm-ajax-checkbox-instant">
						<a class="title collapsed" data-toggle="collapse" href="#accordion-my-hd" aria-expanded="false">
							<h2 class="parts-title"><strong>My Harley-Davidson:</strong></h2>

                                							<span class="minus"></span>
												</a>
												<div class="stm-accordion-content">
							<div class="collapse content " id="accordion-my-hd">
								<div class="stm-accordion-content-wrapper stm-accordion-content-padded">
									<div class="stm-accordion-inner">

            
            	<div class="stm-keyword-search-unit" style="clear: both;">
                                                          
<form action="" method="post" class="filter_parts">
					
			<?php
			$years_terms = get_terms( array( 'taxonomy' => 'ca-year', 'hide_empty' => false, 'orderby' => 'name','order' => 'DESC' ) );
			?>

			<h2 class="parts-title">
						<strong>Add your current Harley-Davidson below:</strong></h2>
			<div class="row p-3">
				
					
				<div class="col-md-3 col-sm-3 col-xs-12">
					<h5 class="pull-left"><?php echo esc_html("Model Year"); ?></h5>
					<select class="add_a_car-select" id="years" data-class="stm_select_overflowed"  name="<?php echo esc_attr(str_replace("-", "_pre_", "ca-year")); ?>">
						<option value="" selected="selected"><?php esc_html_e('Select Year', 'motors'); ?></option>
						<?php foreach( $years_terms as $year ) { ?>
								<option value="<?php echo esc_attr( $year->slug ); ?>" <?php   
								
								if($year->slug == $yeardata) { echo " selected='selected' ";} ?>><?php echo esc_html( $year->name ); ?></option>
						<?php } ?>
					</select>
					
				</div>
		
				
				<div class="col-md-3 col-sm-3 col-xs-12">
					
					<h5 class="pull-left"><?php echo esc_html("Model Range"); ?></h5>
					<select class="add_a_car-select" id="make" data-class="stm_select_overflowed"  name="<?php echo esc_attr(str_replace("-", "_pre_", "make")); ?>">
						<option value="" selected="selected"><?php esc_html_e('Select Model Range', 'motors'); ?></option>
						
						<?php
							if(!empty($id)){
										
								$term_obj_list1 = get_the_terms( $id, 'make' );
								if ( ! empty( $term_obj_list1 ) && ! is_wp_error( $term_obj_list1 ) ) {
									$makedata = $terms_string1 = join('-', wp_list_pluck($term_obj_list1, 'slug'))." ";
								}
								$makedata = trim($makedata);
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
								
								foreach( $make_arr as $index => $value ){
						?>
								<option value="<?php echo $index; ?>" <?php if( $index == $makedata ){ echo " selected='selected' "; } ?>><?php echo $value; ?></option>
						<?php 
								}
								
							}		
						?>
					</select>
					
				</div>
				<div class="col-md-3 col-sm-3 col-xs-12">
					<h5 class="pull-left"><?php echo esc_html("Model"); ?></h5>
					<select class="add_a_car-select" id="model_range" data-class="stm_select_overflowed"  name="<?php echo esc_attr(str_replace("-", "_pre_", "serie")); ?>">
						
						<option value="" ><?php esc_html_e('Select Model', 'motors'); ?></option>
						<?php
							if(!empty($id)){
								
								$term_obj_list1 = get_the_terms( $id, 'make' );
								if ( ! empty( $term_obj_list1 ) && ! is_wp_error( $term_obj_list1 ) ) {
									$makedata = $terms_string1 = join('-', wp_list_pluck($term_obj_list1, 'slug'))." ";
								}
								$makedata = trim($makedata);
								
								//$makedata = get_post_meta($id, 'make', true);
								//echo "+++".$make;
								
								$model_range = get_post_meta($id, 'model_range', true);
								//echo "+++".$model_range;
								
								$args = array( 
									'post_type' => 'bike_guide', 
									'posts_per_page' => -1,
									'tax_query' => array(
										'relation' => 'AND',
										array(
											'taxonomy' => 'make',
											'field' => 'slug',
											'terms' => $makedata,
										),
										array(
											'taxonomy' => 'ca-year',
											'field' => 'slug',
											'terms' => $yeardata,
										)
									)
								);							
								$my_posts = new WP_Query($args);	
								$count_my = $my_posts->found_posts;
								//echo "++".$count_my."<br>";
																	
								$modelRange_arr = array();	
								if( $my_posts->have_posts() ){					
									while( $my_posts->have_posts() ){
										$my_posts->the_post();									
										$modelRange_arr[get_the_ID()] = get_the_title();
									}
								}	
								//print_r($modelRange_arr);
								
								foreach( $modelRange_arr as $index => $value ){
						?>
								<option value="<?php echo $index; ?>" <?php if( $index == $model_range ){ echo " selected='selected' "; } ?>><?php echo $value; ?></option>
						<?php 
								}
								
							}		
						?>
						
					</select>
					
				</div>
				
				<div class="col-md-3 col-sm-3 col-xs-12">
							<br>
					<button type="submit" id="submit_button" class="button submit_button" value="Submit" name="save">Submit<i class="fa fa-circle-o-notch fa-spin" id="loader" style="display: none;"></i></button>
							
				</div>
			</div>		
		</form>
		

	<div class="row">
			
						
			<div class="col-md-12 col-sm-12">
				<?php 
				$mybike = get_user_meta($user['user_id'], 'my_bike', true);
				
				if($mybike != ''){
				?>
					
				<table class="foo-table ninja_footable foo_table_14132 ninja_table_unique_id_677060762_14132 table  nt_type_legacy_table table-bordered vertical_centered  footable-paging-right ninja_table_search_disabled ninja_table_pro footable footable-1 breakpoint-lg">
					<thead>
						<tr>
							
							<th>
								Model Year
							</th>
							<th>
								Model Range
							</th>
							<th>
								Model
							</th>
							<th>
								Action
							</th>
							
						</tr>
					</thead>
					<tbody>
					<?php 
						
						$bikes = explode(',',$mybike);
						//print_r($bikes);
						foreach($bikes as $bike){	
							$post   = get_post( $bike );
							//print_r($post);
							$year = wp_get_post_terms( $post->ID, 'ca-year' );
							
							$make = wp_get_post_terms( $post->ID, 'make' );
							//print_r($year);
					?>					
						<tr id="pl_row_<?php echo $bike; ?>" data-tag="<?php echo $bike; ?>" data-partid="<?php echo $bike; ?>" class="ari_part_info">
							
							<td class="ari_PLTag">
								<?php echo $year[0]->name; ?>
							</td>
							<td class="ari_PLTag">
								<?php echo $make[0]->name; ?>
							</td>
							<td class="ari_PLTag">
								<a href="<?php echo esc_url( get_permalink($bike) ); ?>"><?php echo $post->post_title; ?></a>
							</td>
							<td style="width:15%">
									<a href="https://hd-central.com/author/hd_admin/?page=my-hd-bike&rid=<?php echo $bike; ?>" name="delete" class="button deletebtn" style="">Delete <i class="fa fa-trash"></i></a>
								</td>
							
						</tr>
					<?php 	}?>
					</tbody>
				</table>
				<?php } ?>
			</div>
		</div>


                        						</div>   
        </div>
    </div>
</div>
</div>
</div>
		
		
	
	</div>


 <!--Main information-->

	<div class="main-info-settings harley_ownership">
		<div class="stm-accordion-single-unit stm-listing-directory-checkboxes stm-one_col stm-ajax-checkbox-instant">
						<a class="title collapsed" data-toggle="collapse" href="#accordion-my-oem" aria-expanded="false">
							
							<h2 class="parts-title"><strong>My OEM Parts List:</strong></h2>
                                							<span class="minus"></span>
												</a>
												<div class="stm-accordion-content">
							<div class="collapse content " id="accordion-my-oem">
								<div class="stm-accordion-content-wrapper stm-accordion-content-padded">
									<div class="stm-accordion-inner">

            
            	<div class="stm-keyword-search-unit" style="clear: both;">
                                                          
		
						<div class="row">
			<div class="col-md-12 col-sm-12">
				<?php
				//print_r($parts);
					global $wpdb;  
					$partid	= '';
					
					foreach(array_unique($parts) as $part_result){
						$partid .= $part_result.',';
					}
						
					$partid = rtrim($partid,',');
					$query = "SELECT DISTINCT * FROM ". $wpdb->prefix ."product_list where id IN(select plist_id from product_detail where id IN(". $partid. "))";
					$query_res = $wpdb->get_results($query);
							
					foreach($query_res as $results){
						
						//print_r($results);
			 
						$part_qry = "SELECT DISTINCT * FROM product_detail p  where id IN(".$partid.") and plist_id =".$results->id;
						$partres = $wpdb->get_results($part_qry);   ?>
								
								
					<h2 class="parts-title">
						<strong><?php echo $results->product_year .'&nbsp;&nbsp;'. $results->product_model; ?></strong>&nbsp;&nbsp;
						<?php echo $results->product_range . '&nbsp;&nbsp;'. $results->part_name; ?>
					</h2>
					
					
					<table class="foo-table ninja_footable foo_table_14132 ninja_table_unique_id_677060762_14132 table  nt_type_legacy_table table-bordered vertical_centered  footable-paging-right ninja_table_search_disabled ninja_table_pro footable footable-1 breakpoint-lg">
						<thead>
							<tr>
								
								<th>
									Ref:
								</th>
								<th>
									OEM REF:
								</th>
								<th>
									Part Description
								</th>
								<th>
									Action
								</th>
							</tr>
						</thead>
						<tbody>
						<?php 
							foreach($partres as $part){		
						?>					
							<tr id="pl_row_<?php echo $part->ref_no ."_". $part->id; ?>" data-tag="<?php echo $part->ref_no; ?>" data-partid="<?php echo $part->id; ?>" class="ari_part_info">
								
								<td class="ari_PLTag" style="width:10%">
									<?php echo $part->ref_no; ?>
								</td>
								<td class="ari_PLSku" style="width:15%">
									<?php echo $part->part_number; ?>
									
								</td>
								<td class="ari_desc" style="width:60%">
									<a href="<?php echo site_url();?>/single-parts/?id=<?php echo $results->id; ?>"><?php echo $part->part_desc; ?></a>  
								</td>
								<td style="width:15%">
									<a href="<?php echo site_url(); ?>/author/hd_admin/?page=my-parts-list&id=<?php echo $part->id; ?>" name="delete" class="button deletebtn" style="">Delete <i class="fa fa-trash"></i></a>
								</td>
							</tr>
						<?php 
								}
								
						?>
						</tbody>
					</table>
					<?php } ?>
			</div>
		</div>
</div>
</div>
</div>
</div>
</div>
</div>
	</div>


<!--Main information-->

	<div class="main-info-settings harley_ownership ">
		<div class="stm-accordion-single-unit stm-listing-directory-checkboxes stm-one_col stm-ajax-checkbox-instant">
						<a class="title collapsed" data-toggle="collapse" href="#accordion-my-marketplace" aria-expanded="false">
							
							<h2 class="parts-title">
								<strong>My Marketplace Parts and Accessories:</strong>
							</h2>
                             <span class="minus"></span>
												</a>
												<div class="stm-accordion-content">
							<div class="collapse content " id="accordion-my-marketplace">
								<div class="stm-accordion-content-wrapper stm-accordion-content-padded">
									<div class="stm-accordion-inner">

            
            	<div class="stm-keyword-search-unit part-accessories" style="clear: both;">
					<table class="foo-table ninja_footable foo_table_14132 ninja_table_unique_id_677060762_14132 table  nt_type_legacy_table table-bordered vertical_centered  footable-paging-right ninja_table_search_disabled ninja_table_pro footable footable-1 breakpoint-lg">
						<?php 
							$favs = get_user_meta($user_id,'fav_product',true);
							//print_r($favs);
							foreach($favs as $fav){
								
								$sql = "select * from product_data where id = ".$fav;
								$result = $wpdb->get_results($sql);
								if( $result && count($result) > 0 ){
						?>
							<tr>
								<td style="width: 15%; text-align: center;">
									<img src="<?php echo $result[0]->Image_url_1; ?>" width="100" height="100" />
								</td>
								<td style="width: 42%;">
									<a  class="product_detail" target="_blank" href="<?php echo $result[0]->Product_URL; ?>" title="<?php echo esc_attr($result[0]->Product_Title); ?>"><?php echo esc_attr($result[0]->Product_Title); ?></a>
								</td>
								<td style="width: 15%; text-align: center;">
									<?php echo $result[0]->Seller; ?>
								</td>
								<td style="width: 10%; text-align: center;">
									<?php echo $result[0]->Product_Currency; ?> <?php echo $result[0]->Product_Price; ?>
								</td>
								<td style="width: 9%; text-align: center;">
									<a class="button buynow" href="<?php echo $result[0]->Product_URL; ?>" target="_blank" title="Buy Now" rel="nofollow">Buy</a>
								</td>
								<td style="width: 9%; text-align: center;">
									<a class="button deletebtn re-add-fav-btn" data-type="fav_product" data-id="<?php echo $fav; ?>"  href="javascript:void(0)" title="remove" rel="nofollow"><i class="fa fa-trash-o"></i></a>
								</td>
							</tr>
						<?php
								}
							}
						?>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
	</div>


<!--Main information-->

	<div class="main-info-settings harley_ownership ">
		<div class="stm-accordion-single-unit stm-listing-directory-checkboxes stm-one_col stm-ajax-checkbox-instant">
						<a class="title collapsed" data-toggle="collapse" href="#accordion-my-directory" aria-expanded="false">
							
							<h2 class="parts-title"><strong>Directory Favourites:</strong></h2>
                                							<span class="minus"></span>
												</a>
												<div class="stm-accordion-content">
							<div class="collapse content " id="accordion-my-directory">
								<div class="stm-accordion-content-wrapper stm-accordion-content-padded">
									<div class="stm-accordion-inner">

            
            	<div class="stm-keyword-search-unit" style="clear: both;">
		
						
								
								<table class="foo-table ninja_footable foo_table_14132 ninja_table_unique_id_677060762_14132 table  nt_type_legacy_table table-bordered vertical_centered  footable-paging-right ninja_table_search_disabled ninja_table_pro footable footable-1 breakpoint-lg">
								<?php 
						$favs = get_user_meta($user_id,'fav_provider',true);
						//print_r($favs);
						foreach($favs as $fav){
							//$post   = get_post( $fav );

						$author_obj = get_user_by('id', $fav);


						$membership_level = pmpro_getMembershipLevelForUser($fav);
	//				echo 	$level_id = $membership_level->ID;		
//echo get_user_meta($fav,'stm_website_url',true);
$link ='';
						$authorurl =get_author_posts_url($fav); 
                            if($fav == get_current_user_id()){
                                $authorurl = esc_url(stm_get_author_link('myself-view'));
                            }
                            
                          if( $level_id == 8 ){
														$link = $authorurl;
														$target = 'target="_blank"';
													}else{
														$link = get_user_meta($fav,'stm_website_url',true);
														$target = '';
													}

							//$get_post_type =  get_post_type( $post->ID );
							//echo $get_post_type;
							//if ( $get_post_type != 'listings' ) {
								//continue;
							//	echo "manuals";
							//}else{
							 //echo $fav . '+++' . $post->post_title .'<br>'; ?>
								<tr><td style="display:none;"></td><td>
									<a target="_blank" href="<?php echo $link; ?>" title="<?php echo esc_attr(stm_display_user_name($fav)); ?>"><?php echo esc_attr(stm_display_user_name($fav)); ?></a>
								</td>
								<td>

									<a class="button deletebtn re-add-fav-btn" data-type="fav_provider" data-id="<?php echo $fav; ?>"  href="#" title="remove" rel="nofollow">remove</a>
								</td>
							</tr>
						<?php 
							//}
							}
						?>
								
							</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
	</div>

 <!--Main information-->

	<div class="main-info-settings harley_ownership">
			<div class="stm-accordion-single-unit stm-listing-directory-checkboxes stm-one_col stm-ajax-checkbox-instant">
						<a class="title collapsed" data-toggle="collapse" href="#accordion-my-annual" aria-expanded="false">
							
							<h2 class="parts-title"><strong>My Annual Service:</strong></h2>
                                							<span class="minus"></span>
												</a>
												<div class="stm-accordion-content">
							<div class="collapse content " id="accordion-my-annual">
								<div class="stm-accordion-content-wrapper stm-accordion-content-padded">
									<div class="stm-accordion-inner">

            
            	<div class="stm-keyword-search-unit" style="clear: both;">
                    Service Schedule for all Models
                    <a target="_blank" href="https://hd-central.com/wp-content/uploads/securepdfs/2023/05/2021-08-05-H-D_Maintenance_Schedules_Sportster_S_1.pdf">
                        (Click to open PDF)
                    </a>
                    <a style="width: fit-content;" class="button" href="https://hd-central.com/directory-list">
                        Find a service shop near you
                    </a>
                </div>
</div>
</div>
</div>
</div>
</div>		
						
	</div>



<!--Main information-->

	<div class="main-info-settings harley_ownership ">
		<div class="stm-accordion-single-unit stm-listing-directory-checkboxes stm-one_col stm-ajax-checkbox-instant">
						<a class="title collapsed" data-toggle="collapse" href="#accordion-my-guide" aria-expanded="false">
							
							<h2 class="parts-title"><strong>Service Manuals and Guides:</strong></h2>
                                							<span class="minus"></span>
												</a>
												<div class="stm-accordion-content">
							<div class="collapse content " id="accordion-my-guide">
								<div class="stm-accordion-content-wrapper stm-accordion-content-padded">
									<div class="stm-accordion-inner">

            
            	<div class="stm-keyword-search-unit" style="clear: both;">
		
						
								
							<table class="foo-table ninja_footable foo_table_14132 ninja_table_unique_id_677060762_14132 table  nt_type_legacy_table table-bordered vertical_centered  footable-paging-right ninja_table_search_disabled ninja_table_pro footable footable-1 breakpoint-lg">
								<?php 
						$favs = get_user_meta($user_id,'wpfp_favorites',true);
						//print_r($favs);
						foreach($favs as $fav){
							$post   = get_post( $fav );
							$get_post_type =  get_post_type( $post->ID );
							//echo $get_post_type;
							if ( $get_post_type != 'manuals' ) {
								//continue;
							//	echo "manuals";
							}else{
							 //echo $fav . '+++' . $post->post_title .'<br>'; ?>
								<tr><td style="display:none;"></td><td>
									<a target="_blank" href="<?php echo esc_url( get_permalink($fav) ); ?>" title="<?php echo $post->post_title; ?>"><?php echo url_title($post->post_title); ?></a>
								</td>
								<td>
									<a class="button deletebtn"   id="rem_<?php echo $post->ID; ?>" class="wpfp-link remove-parent" href="<?php echo esc_url( add_query_arg( array( 'page' => 'my-hd-bike' ), stm_get_author_link( '' ) ) ); ?>&wpfpaction=remove&postid=<?php echo $post->ID; ?>" title="remove" rel="nofollow">remove</a>
								</td>
							</tr>
						<?php 
							}
							}
						?>
								
							</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
	</div>


<!--Main information-->

	<div class="main-info-settings harley_ownership ">
		<div class="stm-accordion-single-unit stm-listing-directory-checkboxes stm-one_col stm-ajax-checkbox-instant">
						<a class="title collapsed" data-toggle="collapse" href="#accordion-my-bike" aria-expanded="false">
							
							<h2 class="parts-title"><strong>Saved Bikes For Sale:</strong></h2>
                                							<span class="minus"></span>
												</a>
												<div class="stm-accordion-content">
							<div class="collapse content " id="accordion-my-bike">
								<div class="stm-accordion-content-wrapper stm-accordion-content-padded">
									<div class="stm-accordion-inner">

            
            	<div class="stm-keyword-search-unit" style="clear: both;">
		
						
								
							<table class="foo-table ninja_footable foo_table_14132 ninja_table_unique_id_677060762_14132 table  nt_type_legacy_table table-bordered vertical_centered  footable-paging-right ninja_table_search_disabled ninja_table_pro footable footable-1 breakpoint-lg">
								<?php 
						$favs = get_user_meta($user_id,'wpfp_favorites',true);
						//print_r($favs);
						foreach($favs as $fav){
							$post   = get_post( $fav );
							$get_post_type =  get_post_type( $post->ID );
							//echo $get_post_type;
							if ( $get_post_type != 'listings' ) {
								//continue;
							//	echo "manuals";
							}else{
							 //echo $fav . '+++' . $post->post_title .'<br>'; ?>
								<tr><td style="display:none;"></td><td>
									<a target="_blank" href="<?php echo esc_url( get_permalink($fav) ); ?>" title="<?php echo $post->post_title; ?>"><?php echo url_title($post->post_title); ?></a>
								</td>
								<td>
									<a class="button deletebtn"   id="rem_<?php echo $post->ID; ?>" class="wpfp-link remove-parent" href="<?php echo esc_url( add_query_arg( array( 'page' => 'my-hd-bike' ), stm_get_author_link( '' ) ) ); ?>&wpfpaction=remove&postid=<?php echo $post->ID; ?>" title="remove" rel="nofollow">remove</a>
								</td>
							</tr>
						<?php 
							}
							}
						?>
								
							</table>
					</div>
				</div>
			</div>
		</div>
	</div>
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
						action : 'bike_year_change',
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
			
			jQuery('select#make').change(function(){
				var selected_model = jQuery(this).val();
				var selected_year = jQuery('#years').val();
				
				jQuery('#loader').show();
						
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
						jQuery('#loader').hide();					
						jQuery('#model_range').html(response);
					},
					error: function(error){
						console.log(error);
					}
				});
			});
			jQuery('select#model_range').change(function(){
				var model_range = jQuery(this).val();
				
				
				jQuery('#loader').show();
						
				jQuery.ajax({		
					url: ajaxurl,
					method :'POST',
					
					data:{
						action : 'bike_model_range',
						model_range :  model_range,
						
					},
					success:function(response){
						jQuery('#loader').hide();					
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
			<?php } ?>
		});
	</script>

	<script type="text/javascript">
    jQuery('body').on("click", ".re-add-fav-btn", function(e){
    	e.preventDefault();
    	var fbutton = jQuery(this);
        var id = fbutton.attr('data-id');
        var type = fbutton.attr('data-type');

        jQuery.ajax({
            type : "GET",
            dataType : "json",
            url : "<?php echo admin_url('admin-ajax.php'); ?>",
            data : {action: "update_user_fav", user_id: id,user_type: type},
            success: function(response) {
					fbutton.parent().text(response.data);
                
            }
        });


        //$("#re-compare-bar-tabs div").remove();
        //$('.re-compare-icon-toggle .re-compare-notice').text(0);

    });
</script>
