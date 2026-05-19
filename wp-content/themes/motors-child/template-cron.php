<?php
/* Template Name: User Cron Template  */ 



$users = get_users( array( 'fields' => array( 'ID' ) ) );
echo "count: ".count($users)."<br>"; 

foreach($users as $user){
	
	//echo "id: ".$user->ID . "<br>";
	
	//if( $user->ID == 8210 || $user->ID == 9730 ){
		
		/******** save user email in 'user_meta_address' metakey also *******/
		// $user_email = get_user_meta($user->ID,'user_email',true);
		// if( get_user_meta($user->ID,'user_email_address',true) ){
		// }else{
			// update_user_meta($user->ID,'user_email_address',$user_email);
		// }
		
		
		
		
		// /******* save user email in 'user_meta' and remove it from user table column *******/
		// global $wpdb;
		
		// $user_info = get_userdata($user->ID);
		// $user_email = $user_info->user_email;
		// //echo "++++".$user_email."<br>";
		
		// if( get_user_meta($user->ID,'user_email',true) ){
		// }else{
			// update_user_meta($user->ID,'user_email',$user_email);
		// }
		
		// $sql = "UPDATE " . $wpdb->prefix . "users SET user_email = '' WHERE ID = " . $user->ID;
		// //echo "----".$sql."<br>";
		// $wpdb->query($sql);
		
		
		/****** assign all user 'premium' member level ******/				
		// if( pmpro_hasMembershipLevel(8, $user->ID) ){
			// echo "has level: ". $user->ID ."<br>";
		// }else{
			// pmpro_changeMembershipLevel( 8, $user->ID );
		// }
		
		// //$get_membershiplevel = pmpro_getMembershipLevelForUser($user->ID);
		// //print_r($get_membershiplevel);
		// //echo 'Membership Level: ' . $get_membershiplevel->id;
	//}
	
}



?>



