<?php
/* Template Name: User Url Redirect Template  */ 


if ( !is_user_logged_in() ) {
    auth_redirect();
} 


if( isset($_GET['page']) && $_GET['page'] == "invoice" ){
	$user_id = get_current_user_id();
	$user_url = get_author_posts_url($user_id);
	$redirect_url = $user_url."?page=payment_settings";

	wp_redirect($redirect_url);
	exit;
}

if( isset($_GET['page']) && $_GET['page'] == "my-hd-bike" ){
	$user_id = get_current_user_id();
	$user_url = get_author_posts_url($user_id);
	$redirect_url = $user_url."?page=my-hd-bike";
	wp_redirect($redirect_url);
	exit;
}



//https://hd-central.com/user-redirect/?free-membership=1

$user_id = get_current_user_id();



$user_url = get_author_posts_url($user_id);

if(!empty($_REQUEST['free-membership'])){
	global $current_user;
	$user_id = $current_user->ID;
	if($_REQUEST['free-membership'] == 1){
		pmpro_changeMembershipLevel( 7, $user_id );
	}
	if($_REQUEST['free-membership'] == 2){
		pmpro_changeMembershipLevel( 11, $user_id );
	}

}

wp_redirect($user_url);
exit;

?>



