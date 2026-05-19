<?php
	$list = 'active';
	$grid = '';

	if(!empty($_GET['view']) and $_GET['view'] == 'grid') {
		$list = '';
		$grid = 'active';
	}
	
	$user_id = get_current_user_id();
	global $wpdb;
?>
<style type="text/css">
	.collapse.in{
		display: block !important;
	}
</style>

 <!--Main information-->
<div class="stm-change-block">
	


</div>

<!--Main information-->

	<div class="main-info-settings harley_ownership ">
		<div class="stm-accordion-single-unit stm-listing-directory-checkboxes stm-one_col stm-ajax-checkbox-instant">
						<a class="title collapsed" data-toggle="collapse" href="#accordion-my-post" aria-expanded="false">
							
							<h2 class="parts-title"><strong>Posts and Articles:</strong></h2>
                                							<span class="minus"></span>
												</a>
												<div class="stm-accordion-content">
							<div class="collapse content " id="accordion-my-post">
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
						
							if ( $get_post_type != 'post') {
								//continue;
							//	echo "manuals";
							}else{
							 //echo $fav . '+++' . $post->post_title .'<br>'; ?>
								<tr><td style="display:none;"></td><td>
									<a href="<?php echo esc_url( get_permalink($fav) ); ?>" title="<?php echo $post->post_title; ?>"><?php echo $post->post_title; ?></a>
								</td>
								<td>
									<a class="button deletebtn"   id="rem_<?php echo $post->ID; ?>" class="wpfp-link remove-parent" href="<?php echo esc_url( add_query_arg( array( 'page' => 'favourites' ), stm_get_author_link( '' ) ) ); ?>&wpfpaction=remove&postid=<?php echo $post->ID; ?>" title="remove" rel="nofollow">remove</a>
								</td>
							</tr>
						<?php }}
						?>
								
							</table>
					</div>
					</div>
					</div>
					</div>
					</div>
					</div>
					</div>

		<!-- main -->


		<!--Main information-->

	<div class="main-info-settings harley_ownership ">
		<div class="stm-accordion-single-unit stm-listing-directory-checkboxes stm-one_col stm-ajax-checkbox-instant">
						<a class="title collapsed" data-toggle="collapse" href="#accordion-my-page" aria-expanded="false">
							
							<h2 class="parts-title"><strong>Pages:</strong></h2>
                                							<span class="minus"></span>
												</a>
												<div class="stm-accordion-content">
							<div class="collapse content " id="accordion-my-page">
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
						
							if ( $get_post_type != 'page') {
								//continue;
							//	echo "manuals";
							}else{
							 //echo $fav . '+++' . $post->post_title .'<br>'; ?>
								<tr><td style="display:none;"></td><td>
									<a href="<?php echo esc_url( get_permalink($fav) ); ?>" title="<?php echo $post->post_title; ?>"><?php echo $post->post_title; ?></a>
								</td>
								<td>
									<a class="button deletebtn"   id="rem_<?php echo $post->ID; ?>" class="wpfp-link remove-parent" href="<?php echo esc_url( add_query_arg( array( 'page' => 'favourites' ), stm_get_author_link( '' ) ) ); ?>&wpfpaction=remove&postid=<?php echo $post->ID; ?>" title="remove" rel="nofollow">remove</a>
								</td>
							</tr>
						<?php }}
						?>
								
							</table>
					</div>
					</div>
					</div>
					</div>
					</div>
					</div>
					</div>

		<!-- main -->					
						
	<!--Main information-->

	<div class="main-info-settings harley_ownership ">
		<div class="stm-accordion-single-unit stm-listing-directory-checkboxes stm-one_col stm-ajax-checkbox-instant">
						<a class="title collapsed" data-toggle="collapse" href="#accordion-my-event" aria-expanded="false">
							
							<h2 class="parts-title"><strong>Events:</strong></h2>
                                							<span class="minus"></span>
												</a>
												<div class="stm-accordion-content">
							<div class="collapse content " id="accordion-my-event">
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
						
							if ( $get_post_type != 'event') {
								//continue;
							//	echo "manuals";
							}else{
							 //echo $fav . '+++' . $post->post_title .'<br>'; ?>
								<tr><td style="display:none;"></td><td>
									<a href="<?php echo esc_url( get_permalink($fav) ); ?>" title="<?php echo $post->post_title; ?>"><?php echo $post->post_title; ?></a>
								</td>
								<td>
									<a class="button deletebtn"   id="rem_<?php echo $post->ID; ?>" class="wpfp-link remove-parent" href="<?php echo esc_url( add_query_arg( array( 'page' => 'favourites' ), stm_get_author_link( '' ) ) ); ?>&wpfpaction=remove&postid=<?php echo $post->ID; ?>" title="remove" rel="nofollow">remove</a>
								</td>
							</tr>
						<?php }}
						?>
								
							</table>
					</div>
					</div>
					</div>
					</div>
					</div>
					</div>
					</div>

		<!-- main -->					

	<!--Main information-->

	<div class="main-info-settings harley_ownership ">
		<div class="stm-accordion-single-unit stm-listing-directory-checkboxes stm-one_col stm-ajax-checkbox-instant">
						<a class="title collapsed" data-toggle="collapse" href="#accordion-my-group" aria-expanded="false">
							
							<h2 class="parts-title"><strong>My Groups:</strong></h2>
                                							<span class="minus"></span>
												</a>
												<div class="stm-accordion-content">
							<div class="collapse content " id="accordion-my-group">
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
						
							if ( $get_post_type != 'group') {
								//continue;
							//	echo "manuals";
							}else{
							 //echo $fav . '+++' . $post->post_title .'<br>'; ?>
								<tr><td style="display:none;"></td><td>
									<a href="<?php echo esc_url( get_permalink($fav) ); ?>" title="<?php echo $post->post_title; ?>"><?php echo $post->post_title; ?></a>
								</td>
								<td>
									<a class="button deletebtn"   id="rem_<?php echo $post->ID; ?>" class="wpfp-link remove-parent" href="<?php echo esc_url( add_query_arg( array( 'page' => 'favourites' ), stm_get_author_link( '' ) ) ); ?>&wpfpaction=remove&postid=<?php echo $post->ID; ?>" title="remove" rel="nofollow">remove</a>
								</td>
							</tr>
						<?php }}
						?>
								
							</table>
					</div>
					</div>
					</div>
					</div>
					</div>
					</div>
					</div>


	<div class="main-info-settings harley_ownership ">
		<div class="stm-accordion-single-unit stm-listing-directory-checkboxes stm-one_col stm-ajax-checkbox-instant">
						<a class="title collapsed" data-toggle="collapse" href="#accordion-my-directory" aria-expanded="false">
							
							<h2 class="parts-title"><strong>Places Favourites:</strong></h2>
                                							<span class="minus"></span>
												</a>
												<div class="stm-accordion-content">
							<div class="collapse content " id="accordion-my-directory">
								<div class="stm-accordion-content-wrapper stm-accordion-content-padded">
									<div class="stm-accordion-inner">

            
            	<div class="stm-keyword-search-unit" style="clear: both;">
		
						
								
								<table class="foo-table ninja_footable foo_table_14132 ninja_table_unique_id_677060762_14132 table  nt_type_legacy_table table-bordered vertical_centered  footable-paging-right ninja_table_search_disabled ninja_table_pro footable footable-1 breakpoint-lg">
								<?php 
						$favs = get_user_meta($user_id,'fav_place',true);
						//print_r($favs);
						foreach($favs as $fav){
							//$post   = get_post( $fav );

						$author_obj = get_user_by('id', $fav);
						$authorurl = get_author_posts_url($fav);

						if ($fav == get_current_user_id())
						{
						    $authorurl = esc_url(stm_get_author_link('myself-view'));
						}

						$membership_level = pmpro_getMembershipLevelForUser($fav);
												$level_id = $membership_level->ID;											
												if( $level_id == 10 ){
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
	
		<!-- main -->

	<!-- favourite product -->
	<div class="main-info-settings harley_ownership" style="">
		<div class="stm-accordion-single-unit stm-listing-directory-checkboxes stm-one_col stm-ajax-checkbox-instant">
			<a class="title collapsed" data-toggle="collapse" href="#accordion-my-products" aria-expanded="false">
				<h2 class="parts-title"><strong>Products Favourites:</strong></h2>
                <span class="minus"></span>
			</a>
			
			<div class="collapse content " id="accordion-my-products">
				<div class="stm-accordion-content-wrapper stm-accordion-content-padded">
					<div class="stm-accordion-inner">
						<div class="stm-keyword-search-unit" style="clear: both;">
							
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
									<td style="display:none;"></td><td>
										<a target="_blank" href="<?php echo $result[0]->Product_URL; ?>" title="<?php echo esc_attr($result[0]->Product_Title); ?>"><?php echo esc_attr($result[0]->Product_Title); ?></a>
									</td>
									<td>
										<a class="button deletebtn re-add-fav-btn" data-type="fav_product" data-id="<?php echo $fav; ?>"  href="javascript:void(0)" title="remove" rel="nofollow">remove</a>
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
						fbutton.closest('tr').text(response.data);
					
				}
			});


			//$("#re-compare-bar-tabs div").remove();
			//$('.re-compare-icon-toggle .re-compare-notice').text(0);

		});
	</script>