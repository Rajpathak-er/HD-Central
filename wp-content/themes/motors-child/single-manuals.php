<?php get_header();?>
	<?php
    if(!stm_is_magazine()) {
        get_template_part('partials/page_bg');
        get_template_part('partials/title_box');
    } else {
     //   get_template_part('partials/magazine/content/breadcrumbs');
    }
	?>
	<style type="text/css">
		
		.bike_guide_table th { 
			border-bottom: 1px solid #d5d9e0;
    		background: #eaedf0;
    		padding: 10px 20px;
		 }
		 .bike_guide_table td {
		 	padding: 10px 20px;	
		 }
		 .post-title , .blog-meta{
		 	display: none;
		 }
		 #post-6803 .col-md-3{
		 	display: none;
		 }
		 #post-6803 .col-md-9{
		 	left: 0%;
		 	width: 100%;
		 }
	</style>
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="stm-single-post">
			<div class="container">
				<?php if ( have_posts() ) :
					while ( have_posts() ) : the_post();
						if(!stm_is_magazine()) {
							get_template_part('partials/manuals/content');
						} else {
							get_template_part('partials/magazine/main');
						}


					endwhile;
				endif; ?>						
			</div>
		</div>
	</div>
<?php get_footer();?>