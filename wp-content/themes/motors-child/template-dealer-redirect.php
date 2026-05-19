<?php
/* Template Name: Dealer Register Redirect Template  */ 
get_header();

//print_r($_GET);

$email = $_GET['email'];

$url = site_url()."/author/".$email;
if( $email ){
	wp_redirect($url);
	exit;
}

?>



<?php get_footer(); ?>