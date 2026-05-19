<?php get_header();?>
	<?php
    if(!stm_is_magazine()) {
        get_template_part('partials/page_bg');
        get_template_part('partials/title_box');
    } else {
        get_template_part('partials/magazine/content/breadcrumbs');
    }
	?>
	<style type="text/css">
		
		.bike_guide_table th { 
			text-transform: uppercase;
    		font-size: 14px !important;
    		color: black!important;
    		background: lightgray !important;
    	 	border-bottom: 1px solid #dddddd;
    		padding: 10px 20px;
		 }
		 .bike_guide_table td {
		 	padding: 10px 20px;	
		 }
		 table {
		 	border: 1px solid #dee2e6;
		 }
		 #vc_images-carousel-1-1601035289,.vc_images_carousel ,.post-thumbnail{
		    padding: 10px;
		    background-color: #fff;
		    border: 1px solid #ddd;
		 }
		.rightsidebarmodel .post-thumbnail{
		 	margin-bottom: 20px;
		 }

		 table > tbody > tr > td:first-child {
		    font-weight: bold;
		}
		.stm-single-post{
			padding-top: 0px;
		}
		.rightsidebarmodel{
			padding: 0px;
		}
		table > tbody tr td{
			border: 1px solid #dee2e6;
		}
	</style>
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="stm-single-post">
			<div class="container">
			
				
				<?php if ( have_posts() ) :
					while ( have_posts() ) : the_post();
						if(!stm_is_magazine()) {
							get_template_part('partials/bike-guide/content');
						} else {
							get_template_part('partials/magazine/main');
						}


					endwhile;
				endif; ?>


					

						
			</div>
		</div>
	</div>
<?php get_footer();?>