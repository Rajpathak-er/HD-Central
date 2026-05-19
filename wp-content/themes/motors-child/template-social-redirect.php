<?php
/* Template Name: Social User Url Redirect Template  */ 


if( isset($_GET['page']) && $_GET['page'] == "invoice" ){
	$user_id = get_current_user_id();
	$user_url = get_author_posts_url($user_id);
	$redirect_url = $user_url."?page=payment_settings";

	wp_redirect($redirect_url);
	exit;
}

//https://hd-central.com/user-redirect/?free-membership=1

$user_id = get_current_user_id();



$user_url = bp_loggedin_user_domain();



wp_redirect($user_url);
exit;

?>



