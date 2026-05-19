<?php
$vc_status = get_post_meta( get_the_ID() , '_wpb_vc_js_status', true);
$bike_make = get_the_terms( get_the_ID(), 'make' );
$bike_make = join(', ', wp_list_pluck($bike_make, 'name'));

$model_body = get_the_terms( get_the_ID(), 'serie' );
$model_body = join(', ', wp_list_pluck($model_body, 'name'));




$title_tag = (empty(get_post_meta( get_the_ID(), 'stm_title_tag', true ))) ? 'h1' : get_post_meta( get_the_ID(), 'stm_title_tag', true );
?>

<?php if( $vc_status != 'false' && $vc_status == true ): ?>

	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="">
			<div class="post-content post-content-vc">
				<?php the_content(); ?>
			</div>
			<?php
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'motors' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'motors' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
			?>
		</div>
	</div>

<?php else: ?>

	<?php
		$sidebar_id = get_theme_mod('sidebar_blog', 'default');
		$sidebar_position = get_theme_mod('sidebar_position', 'right');

		if( !empty($sidebar_id) ) {
			$blog_sidebar = get_post( $sidebar_id );
		}

        if(!is_numeric($sidebar_id) && ($sidebar_id == 'no_sidebar' || !is_active_sidebar($sidebar_id))) {
            $sidebar_id = false;
        }

        if(is_numeric($sidebar_id) && empty($blog_sidebar->post_content)) {
            $sidebar_id = false;
        }

		$stm_sidebar_layout_mode = stm_sidebar_layout_mode($sidebar_position, $sidebar_id);

	?>

	<div class="row">
		
		<div class="col-md-9   rightsidebarmodel col-sm-12">
		
		<?php 

		//echo stm_do_lmth($stm_sidebar_layout_mode['content_before']); ?>

			<!--Title-->
			
			<?php 
			$images = get_field('gallery');

			if($images){
				$imageid = array();
				 foreach( $images as $image_id ): 
				 	$imageid[] = $image_id[ID];
				  endforeach;
				
				echo do_shortcode('[vc_images_carousel images="'.implode(",", $imageid).'" img_size="full" onclick="link_no" autoplay="yes" hide_pagination_control="yes" wrap="yes" el_class="home-slider" css=".vc_custom_1600723657818{margin-bottom: 10px !important;}"]')	;
			}else
			{
			?>
			<!--Post thumbnail-->
			

			<?php if ( has_post_thumbnail() ): ?>
				<div class="post-thumbnail">
					<?php the_post_thumbnail( 'stm-img-1110-577', array( 'class' => 'img-responsive' ) ); ?>
				</div>
			<?php endif; 
			}

			?>

			

			<!--Blog meta-->
			<div class="blog-meta clearfix" style="display: none;">
				<div class="left">
					<div class="clearfix">
						<div class="blog-meta-unit h6">
							<i class="stm-icon-date"></i>
							<span><?php echo get_the_date(); ?></span>
						</div>
						<div class="blog-meta-unit h6">
							<i class="stm-icon-author"></i>
							<span><?php esc_html_e( 'Posted by:', 'motors' ); ?></span>
							<span><?php the_author(); ?></span>
						</div>
					</div>
				</div>
				<div class="right">
					<div class="blog-meta-unit h6">
						<a href="<?php comments_link(); ?>" class="post_comments h6">
							<i class="stm-icon-message"></i> <?php comments_number(); ?>
						</a>
					</div>
				</div>
			</div>
			<h4>Bike Description</h4>
            <?php 

            the_content(); 
            if(has_excerpt(get_the_ID())): ?>
                <div class="stm-excerpt">
                    <?php the_excerpt(); 
							
                    ?>
                </div>
            <?php endif; ?>

			<div class="post-content">


						<table class="bike_guide_table" style="width:100%">
						<tr>
							<th>Build and Design Details</th><th>Specification</th>
						</tr>
							<tr>
								<td style="width: 30%;">Make Model:</td>
							    <td><?php echo $bike_make. " , " .$model_body; ?> </td>
							</tr>
							<tr>
								<td>Year:</td>
							    <td>
							    	<?php
							    	$cayear = get_the_terms( get_the_ID(), 'ca-year' );						
						if($cayear){
							$cayearnew = array();
							$cayearnew[] = $cayear[0];
							$cayearnew[] = $cayear[count($cayear) - 1];
							if($cayearnew[0]  != $cayearnew[1]){
								$cayear = join('-', wp_list_pluck($cayearnew, 'name'));
							}else {
								unset($cayearnew[1]);
								$cayear = join('-', wp_list_pluck($cayearnew, 'name'));
							}
							echo $cayear;
						}
?>
							    </td>
							</tr>
							<?php // if( get_field('engine') ){ ?>
								<tr><td>Engine:</td><td><?php the_field('engine')?></td></tr>
							<?php //} ?>
							<?php // if( get_field('capacity') ){ ?>
								<tr><td>Capacity:</td><td><?php the_field('capacity')?></td></tr>
							<?php // } ?>
							<?php // if( get_field('bore_x_stroke') ){ ?>
								<tr><td>Bore x Stroke:</td><td><?php the_field('bore_x_stroke')?></td></tr>
							<?php // } ?>
							<?php // if( get_field('cooling_system') ){ ?>
								<tr><td>Cooling System:</td><td><?php the_field('cooling_system')?></td></tr>
							<?php // } ?>
							<?php //if( get_field('compression_ratio') ){ ?>
								<tr><td>Compression Ratio:</td><td><?php the_field('compression_ratio')?></td></tr>
							<?php //} ?>
							<?php //if( get_field('lubrication') ){ ?>
								<tr><td>Lubrication:</td><td><?php the_field('lubrication')?></td></tr>
							<?php //} ?>
							<?php //if( get_field('induction') ){ ?>
								<tr><td>Induction:</td><td><?php the_field('induction')?></td></tr>
							<?php //} ?>
							<?php //if( get_field('ignition') ){ ?>
								<tr><td>Ignition:</td><td><?php the_field('ignition')?></td></tr>
							<?php //} ?>
							<?php //if( get_field('starting') ){ ?>
								<tr><td>Starting:</td><td><?php the_field('starting')?></td></tr>
							<?php //} ?>  
							<?php //if( get_field('max_power') ){ ?>
								<tr><td>Max Power:</td><td><?php the_field('max_power')?></td></tr>
							<?php //} ?>
							<?php //if( get_field('max_torque') ){ ?>
								<tr><td>Max Torque:</td><td><?php the_field('max_torque')?></td></tr>
							<?php //} ?>
							<?php //if( get_field('clutch') ){ ?>
								<tr><td>Clutch:</td><td><?php the_field('clutch')?></td></tr>
							<?php //} ?>
							<?php //if( get_field('transmission') ){ ?>
								<tr><td>Transmission:</td><td><?php the_field('transmission')?></td></tr>
							<?php //} ?>
							<?php //if( get_field('final_drive') ){ ?>
								<tr><td>Final Drive:</td><td><?php the_field('final_drive')?></td></tr>
							<?php //} ?>
							<?php //if( get_field('frame') ){ ?>
								<tr><td>Frame:</td><td><?php the_field('frame')?></td></tr>
							<?php //} ?>
							<?php //if( get_field('front_suspension') ){ ?>
								<tr><td>Front Suspension:</td><td><?php the_field('front_suspension')?></td></tr>
							<?php //} ?> 
							<?php //if( get_field('rear_suspension') ){ ?>
								<tr><td>Rear Suspension:</td><td><?php the_field('rear_suspension')?></td></tr>
							<?php //} ?>
							<?php //if( get_field('front_brakes') ){ ?>
								<tr><td>Front Brakes:</td><td><?php the_field('front_brakes')?></td></tr>
							<?php //} ?>
							<?php //if( get_field('rear_brakes') ){ ?>
								<tr><td>Rear Brakes:</td><td><?php the_field('rear_brakes')?></td></tr>
							<?php //} ?>
							<?php //if( get_field('front_tyre') ){ ?>
								<tr><td>Front Tyre:</td><td><?php the_field('front_tyre')?></td></tr>
							<?php //} ?>
							<?php //if( get_field('rear_tyre') ){ ?>
								<tr><td>Rear Tyre:</td><td><?php the_field('rear_tyre')?></td></tr>
							<?php //} ?>
							<?php //if( get_field('seat_height') ){ ?>
								<tr><td>Seat Height:</td><td><?php the_field('seat_height')?></td></tr>
							<?php //} ?>
							<?php //if( get_field('dry_weight_') ){ ?>
								<tr><td>Dry Weight:</td><td><?php the_field('dry_weight_')?></td></tr>
							<?php //} ?>
							<?php //if( get_field('fuel_capacity') ){ ?>
								<tr><td>Fuel Capacity:</td><td><?php the_field('fuel_capacity')?></td></tr>
							<?php //} ?>
							<?php //if( get_field('wet_weight') ){ ?>
								<tr><td>Wet Weight:</td><td><?php the_field('wet_weight')?></td></tr>
							<?php //} ?>
							<?php //if( get_field('exhaust') ){ ?>
								<tr><td>Exhaust:</td><td><?php the_field('exhaust')?></td></tr>
							<?php //} ?>
							<?php //if( get_field('primary_drive') ){ ?>
								<tr><td>Primary Drive:</td><td><?php the_field('primary_drive')?></td></tr>
							<?php //} ?>
							<?php //if( get_field('gear_ratio') ){ ?>
								<tr><td>Gear Ratio:</td><td><?php the_field('gear_ratio')?></td></tr>
							<?php //} ?>
							<?php //if( get_field('front_wheel_travel') ){ ?>
								<tr><td>Front Wheel Travel:</td><td><?php the_field('front_wheel_travel')?></td></tr>
							<?php //} ?>
							<?php //if( get_field('rear_wheel_travel') ){ ?>
								<tr><td>Rear Wheel Travel:</td><td><?php the_field('rear_wheel_travel')?></td></tr>
							<?php //} ?>
							<?php //if( get_field('wheels') ){ ?>
								<tr><td>Wheels:</td><td><?php the_field('wheels')?></td></tr>
							<?php //} ?>
							<?php //if( get_field('front_wheel') ){ ?>
								<tr><td>Front Wheel:</td><td><?php the_field('front_wheel')?></td></tr>
							<?php //} ?>
							<?php //if( get_field('rear_wheel') ){ ?>
								<tr><td>Rear Wheel:</td><td><?php the_field('rear_wheel')?></td></tr>
							<?php //} ?>
							<?php //if( get_field('rake') ){ ?>
								<tr><td>Rake:</td><td><?php the_field('rake')?></td></tr>
							<?php //} ?>
							<?php //if( get_field('trail') ){ ?>
								<tr><td>Trail:</td><td><?php the_field('trail')?></td></tr>
							<?php //} ?>
							<?php //if( get_field('dimensions') ){ ?>
								<tr><td>Dimensions:</td><td><?php the_field('dimensions')?></td></tr>
							<?php //} ?>
							<?php //if( get_field('wheelbase') ){ ?>
								<tr><td>Wheelbase:</td><td><?php the_field('wheelbase')?></td></tr>
							<?php //} ?>
							<?php //if( get_field('ground_clearance') ){ ?>
								<tr><td>Ground Clearance:</td><td><?php the_field('ground_clearance')?></td></tr>
							<?php //} ?>
							
						</table>	
				<?php 
				// Check rows exists.
				if( have_rows('owners_manual') ):

					// Loop through rows.
					while( have_rows('owners_manual') ) : the_row();

						// Load sub field value.
						$sub_value = get_sub_field('file_upload');
						echo '<a href="'.$sub_value['url'].'"><img style="height:100px;width:100px;" src="'.site_url().'/wp-content/uploads/2020/07/pngtree-pdf-file-document-icon-png-image_892814.jpg">'.$sub_value['filename'].'</a>';
						//print_r($sub_value);
						// Do something...

					// End loop.
					endwhile;

				// No value.
				else :
					// Do something...
				endif;
				?>
				<div class="clearfix"></div>
			</div>

			<?php
				wp_link_pages( array(
					'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'motors' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
					'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'motors' ) . ' </span>%',
					'separator'   => '<span class="screen-reader-text">, </span>',
				) );
			?>

			<div class="blog-meta-bottom">
				<div class="clearfix">
					<div class="left">
						<!--Categories-->
						<?php $cats = get_the_category( get_the_id() ); //print_r($cats); ?>
						<?php if ( ! empty( $cats ) ): ?>
							<div class="post-cat">
								<span class="h6"><?php esc_html_e( 'Category:', 'motors' ); ?></span>
								<?php foreach ( $cats as $cat ): ?>
									<span class="post-category">
										<a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>"><span><?php echo esc_html($cat->name); ?></span></a><span class="divider">,</span>
									</span>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>

						<!--Tags-->
						<?php if( $tags = wp_get_post_tags( get_the_ID() ) ){ ?>
							<div class="post-tags">

								<span class="h6"><?php esc_html_e( 'Tags:', 'motors' ); ?></span>
								<span class="post-tag">
									<?php echo get_the_tag_list('', ', ', ''); ?>
								</span>
							</div>
						<?php } ?>
					</div>


					<div class="right">
						<div class="stm-shareble stm-single-car-link">
							<a
								href="#"
								class="car-action-unit stm-share"
								title="<?php esc_html_e('Share this', 'motors'); ?>"
								download>
								<i class="stm-icon-share"></i>
								<?php esc_html_e('Share this', 'motors'); ?>
							</a>
							<?php if(function_exists( 'ADDTOANY_SHARE_SAVE_KIT' ) && ! get_post_meta( get_the_ID(), 'sharing_disabled', true )): ?>
								<div class="stm-a2a-popup">
									<?php echo do_shortcode('[addtoany url="'.get_the_permalink(get_the_ID()).'" title="'.get_the_title(get_the_ID()).'"]'); ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>

			<!--Author info-->
			<?php if ( get_the_author_meta('description') ) : ?>
				<div class="stm-author-box clearfix">
					<div class="author-image">
						<?php echo get_avatar( get_the_author_meta( 'email' ), 86 ); ?>
					</div>
					<div class="author-content">
						<h6><?php esc_html_e( 'Author:', 'motors' ); ?></h6>
						<h4><?php the_author_meta('nickname'); ?></h4>
						<div class="author-description"><?php echo get_the_author_meta( 'description' ); ?></div>
					</div>
				</div>
			<?php endif; ?>

			<!--Comments-->
			<?php if ( comments_open() || get_comments_number() ) { ?>
				<div class="stm_post_comments">
					<?php comments_template(); ?>
				</div>
			<?php } ?>

		<?php //echo stm_do_lmth($stm_sidebar_layout_mode['content_after']); ?>
		
		</div>
				
		<!--Sidebar-->		
		<div class="col-md-3   col-sm-12">
			<?php //echo do_shortcode('[stm_sidebar sidebar="3068"]'); ?>
			<?php echo do_shortcode('[stm_sidebar sidebar="26599"]'); ?>
		</div>

		<!--Sidebar-->
		<?php
			// if($sidebar_id == 'default') {
				// echo stm_do_lmth($stm_sidebar_layout_mode['sidebar_before']);
				// get_sidebar();
				// echo stm_do_lmth($stm_sidebar_layout_mode['sidebar_after']);
			// }else if(!empty($sidebar_id)) {
				// echo stm_do_lmth($stm_sidebar_layout_mode['sidebar_before']);
					// echo apply_filters( 'the_content' , $blog_sidebar->post_content);
				// echo stm_do_lmth($stm_sidebar_layout_mode['sidebar_after']); ?>
				<!--<style type="text/css">
					<?php echo get_post_meta( $sidebar_id, '_wpb_shortcodes_custom_css', true ); ?>
				</style>-->
		<?php 
			//}
		?>
	</div>
<?php endif; ?>