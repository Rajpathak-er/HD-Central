<?php
/* Template Name: Test Year Template  */ 
get_header();

?>
<div id="main">
	<div class="entry-header left small_title_box" style="">
		<div class="container">
			<div class="entry-title">
				<h2 class="h1" style="">
					Model Guide             
				</h2>
			</div>
		</div>
	</div>

	<!-- Breads -->	
	<div class="stm_breadcrumbs_unit heading-font ">
		<div class="container">
			<div class="navxtBreads">
				<!-- Breadcrumb NavXT 6.5.0 -->
				<span property="itemListElement" typeof="ListItem"><a property="item" typeof="WebPage" title="Go to HD Central." href="https://hd-central.com" class="home"><span property="name">HD Central</span></a><meta property="position" content="1"></span> &gt; <span property="itemListElement" typeof="ListItem"><span property="name" class="archive post-bike_guide-archive current-item">Test Page</span><meta property="url" content="https://hd-central.com/bike_guide/"><meta property="position" content="2"></span>					</div>
			</div>
		</div>
		<div class="container">
	<div class="row">
		<div class="col-md-9 col-md-push-3 col-sm-12"><div class="sidebar-margin-top clearfix"></div>
			<div class="classic-filter-row" style="margin-top: 0px;">
				<?php
					$args = array( 
						'post_type' => 'bike_guide',
						'post_status' => 'publish',
						'posts_per_page' => -1,
						//'post__in' => array( 4249, 4359, 6667, 4967, 6091, 6615 )
						//'post__in' => array( 6667 )
					);
					$query = new WP_Query($args);

					if ( $query->have_posts() ) {
						while ( $query->have_posts() ) {
							$query->the_post();
							// now $query->post is WP_Post Object, use:
							// $query->post->ID, $query->post->post_title, etc.
							
							$post_id = $query->post->ID;
							echo "post_id: ".$post_id."<br>";
							//echo "++".get_the_ID()."   ".get_the_title()."<br>";
							
							$yeaardata = get_post_meta($post_id, 'yeaardata', true);
							//echo "yeaardata: ".$yeaardata."<br>";
							
							$dbimage = get_post_meta($post_id, 'dbimage', true);
							//echo "images: ".$dbimage."<br>";
							
							// $images = explode('|',$dbimage);							
							// $arrimage = array();
							// foreach($images as $image){
								// $filename = trim($image);
							// }
							//update_field( 'gallery', $arrimage , $post_id );
							
							//print_r($images);
							
							
							$yrArr = array();
							
							if( strpos($yeaardata, '-') !== false ){
								
								echo "<br>******** meta has - *********<br>";
								//echo 'true';
								$year = explode('-',$yeaardata);
								echo $year[0]."     "; 
								echo $year[1];
								echo "<br>";

								// check value after - is less than 21 if so then take it as 2000 range
								if( !empty($year[1]) ){
									if( $year[1] < 21 ){
										$year[1] = "20".$year[1];
									}else{
										$year[1] = "19".$year[1];
									}
									echo "++++".$year[1]."<br><br>";
								
								
									for( $i=$year[0]; $i<=$year[1]; $i++ ){
										echo "".$i."<br>";
										
										$term = term_exists( (string)$i, 'ca-year' );
										//print_r($term);

										
										if ( $term !== 0 && $term !== null ) {
											echo "test<br>";
											echo __( "$i category exists!", "" )."<br>";
											
											// save taxonomy term id for post in array
											$yrArr[] = $term['term_id'];
																															
										}else{										
											echo "test11 insert<br>";
											// insert year in year taxonomy
											$insert_data = wp_insert_term(
																$i,   // the term 
																'ca-year', // the taxonomy
																array(
																	'slug' => $i,											
																)
															);

											if( ! is_wp_error($insert_data) )
												$term_id = $insert_data['term_id'];
											
											// save taxonomy term id for post in array
											$yrArr[] = $insert_data['term_id'];										
										}									
										
										echo "<br><br>";
									}		
								}else{
									// year	1 is empty or not set
									echo "<br>******** meta has - but year 1 is not *********<br>";
									
									$term = term_exists( (string)$year[0], 'ca-year' );
								
									if ( $term !== 0 && $term !== null ) {
										echo "test<br>";
										echo __( "$year[0] category exists!", "" )."<br>";
											
										// save taxonomy term id for post in array
										$yrArr[] = $term['term_id'];
																															
									}else{										
										echo "test11 insert<br>";
										// insert year in year taxonomy
										$insert_data = wp_insert_term(
															$year[0],   // the term 
															'ca-year', // the taxonomy
															array(
																'slug' => $year[0],											
															)
														);

										if( ! is_wp_error($insert_data) )
											$term_id = $insert_data['term_id'];
										
										// save taxonomy term id for post in array
										$yrArr[] = $insert_data['term_id'];										
									}
								}																
								
							}else{
								// has no -
								
								echo "<br>******** meta has <b>no</b> - *********<br>";
								
								$term = term_exists( (string)$yeaardata, 'ca-year' );
								
								if ( $term !== 0 && $term !== null ) {
									echo "test<br>";
									echo __( "$yeaardata category exists!", "" )."<br>";
										
									// save taxonomy term id for post in array
									$yrArr[] = $term['term_id'];
																														
								}else{										
									echo "test11 insert<br>";
									// insert year in year taxonomy
									$insert_data = wp_insert_term(
														$yeaardata,   // the term 
														'ca-year', // the taxonomy
														array(
															'slug' => $yeaardata,											
														)
													);

									if( ! is_wp_error($insert_data) )
										$term_id = $insert_data['term_id'];
									
									// save taxonomy term id for post in array
									$yrArr[] = $insert_data['term_id'];										
								}
							}
							
							//die;						
							
							// set year taxonomy term to post
							print_r($yrArr);
							wp_set_post_terms( $post_id, $yrArr, 'ca-year' );
							
							
							
							echo "<br>-------------------------------------------------------------------------------<br>";
							
							// $term_obj_list = get_the_terms( $post_id, 'ca-year' );
							// print_r($term_obj_list);
						}

					}
	
				?>
				
				
				
			</div>				
		</div>
		<div class="col-md-3 col-md-pull-9 hidden-sm hidden-xs">
			<aside id="archives-3" class="widget widget-default widget_archive">
				<div class="widget-title">
					<h4>Sidebar</h4>
				</div>		
			</aside>		
		</div>
	</div>
</div>
	<?php
	
	get_footer();