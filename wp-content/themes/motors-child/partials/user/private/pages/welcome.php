
<div id="current-endpoint-title-wrapper" class="current-endpoint-title-wrapper ">
        <div class="current-endpoint">
        <i class="fas fa-award"></i><span> Welcome to HD Central</span>
        </div>
    </div>
    <div class="panel panel-default pannel-outer-heading mainwelcomecontent">
                    
                    <div class="panel-body panel-content-padding">
                        <div class="form-group  align-items-center">

<?php 

$user = stm_get_user_custom_fields('');

$user_id = $user['user_id'];

global $wp_roles;
$all_roles = $wp_roles->get_names(); 


global $current_user;
    $current_user->membership_level = pmpro_getMembershipLevelForUser($current_user->ID);
$membership_level = $current_user->membership_level->ID;
$place_user = get_user_meta( $user_id, 'place_user', true );

//place 52651
// BUSINESS 52646
// Paid 52649
$my_postid = 33138;//This is page id or post id
if($place_user){
    $my_postid = 52651;
}else if($membership_level == 7){
    $my_postid = 52646;
}else if($membership_level == 8){
    $my_postid = 52649;
}
$content_post = get_post($my_postid);
$content = $content_post->post_content;
$content = apply_filters('the_content', $content);
$content = str_replace(']]>', ']]&gt;', $content);
echo $content;

?>

              </div>
                    </div>
    </div>

