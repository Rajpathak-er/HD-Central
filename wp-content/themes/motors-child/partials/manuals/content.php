<?php
$vc_status = get_post_meta( get_the_ID() , '_wpb_vc_js_status', true);
// $bike_make = get_the_terms( get_the_ID(), 'make' );
// $bike_make = join(', ', wp_list_pluck($bike_make, 'name'));

// $model_body = get_the_terms( get_the_ID(), 'serie' );
// $model_body = join(', ', wp_list_pluck($model_body, 'name'));

// $cayear = get_the_terms( get_the_ID(), 'ca-year' );
// $cayear = join(', ', wp_list_pluck($cayear, 'name'));

$title_tag = (empty(get_post_meta( get_the_ID(), 'stm_title_tag', true ))) ? 'h1' : get_post_meta( get_the_ID(), 'stm_title_tag', true );
?>

<style>
	.pdf_container{
		margin-bottom: 20px;
	}
</style>

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
		$sidebar_position = get_theme_mod('sidebar_position', 'left');

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
		<?php //echo stm_do_lmth($stm_sidebar_layout_mode['content_before']); ?>

			<!--Title-->
			<<?php echo esc_attr($title_tag); ?> class="post-title"><?php the_title(); ?></<?php echo esc_attr($title_tag); ?>>

			<!--Post thumbnail-->
			<?php if ( has_post_thumbnail() ): ?>
				<div class="post-thumbnail">
					<?php the_post_thumbnail( 'stm-img-1110-577', array( 'class' => 'img-responsive' ) ); ?>
				</div>
			<?php endif; ?>

			<!--Blog meta-->
			<?php /* ?><div class="blog-meta clearfix">
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
			</div><?php */ ?>

            <?php if(has_excerpt(get_the_ID())): ?>
                <div class="stm-excerpt">
                    <?php the_excerpt();

                     ?>
                </div>
            <?php endif; ?>

			<div class="post-content">
				<div class="manuals_pdf">

				<?php

					// Check rows exists.
					if( have_rows('manuals_file') ):
						// Loop through rows.
						while( have_rows('manuals_file') ) : the_row();
							
							$file_upload = get_sub_field('file_upload');
							//print_r($file_upload);
							
							if( $file_upload ){
								// $url = $file_upload['url'];
								// $title = $file_upload['title'];
								// $type = $file_upload['subtype'];
								
								// if($type == "pdf" ){
									// //echo "<a href='".$url."' target='_blank'><p>".$title."</p></a>";
									
									// echo "<div class='pdf_container'>";
									// echo do_shortcode( '[pdf-embedder url="'.$url.'"]' );
									// echo "</div>";
								// }
								
								 $url = site_url().'/wp-content/uploads/securepdfs/'.$file_upload;
								//$url = site_url().'/wp-content/uploads/securepdfs/Owners_Manual_Harley_Davidson_Touring_CVO_Electra_Glide_Classic_2011.pdf';
								//echo "++".$url;
								
								echo "<div class='pdf_container'>";
								echo do_shortcode( '[pdf-embedder url="'.$url.'"]' );
								echo "</div>";
							}
						endwhile;					
					else :
						// Do something...
					endif;
				?>
				
				</div>
					
				<?php 
					$filename = get_the_title(); 
					$url = 'https://d28136yw947h48.cloudfront.net/'.$filename;
					echo "<div class='pdf_container'>";
								echo do_shortcode( '[pdf-embedder url="'.$url.'"]' );
								echo "</div>";
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

			<?php /* ?><div class="blog-meta-bottom">
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
			</div><?php */ ?>

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
			<?php /* ?><?php if ( comments_open() || get_comments_number() ) { ?>
				<div class="stm_post_comments">
					<?php comments_template(); ?>
				</div>
			<?php } ?><?php */?>

		<?php //echo stm_do_lmth($stm_sidebar_layout_mode['content_after']); ?>


		<!--Sidebar-->
		<?php /* ?><?php
			if($sidebar_id == 'default') {
				echo stm_do_lmth($stm_sidebar_layout_mode['sidebar_before']);
				get_sidebar();
				echo stm_do_lmth($stm_sidebar_layout_mode['sidebar_after']);
			}else if(!empty($sidebar_id)) {
				echo stm_do_lmth($stm_sidebar_layout_mode['sidebar_before']);
					echo apply_filters( 'the_content' , $blog_sidebar->post_content);
				echo stm_do_lmth($stm_sidebar_layout_mode['sidebar_after']); ?>
				<style type="text/css">
					<?php echo get_post_meta( $sidebar_id, '_wpb_shortcodes_custom_css', true ); ?>
				</style>
			<?php }
		?><?php */ ?>
	</div>
<?php endif; ?>