<?php
/* Template Name: Template With New Header  */ 
include('header_1.php');


//print_r($_GET);


?>
  <div class="container">
    <?php

	if ( have_posts() ) :
		while ( have_posts() ) : the_post();
			the_content();
		endwhile;
	endif;

	?>
    </div>


<?php get_footer(); ?>