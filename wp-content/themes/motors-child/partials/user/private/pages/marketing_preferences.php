<?php

$user = stm_get_user_custom_fields('');

//print_r($user);
$user_id = $user['user_id'];
if (isset($_POST['marketingsoft'])) {

    

    $metas = array(
        'newsletteropt'   => $_POST['newsletteropt'],
        'marketingopt'   => $_POST['marketingopt'],
    );
    

    foreach ($metas as $key => $value) {
        update_user_meta($user_id, $key, $value);
    }
   // header('Location: ' . site_url($_SERVER['REQUEST_URI']));
}
$newsletter = get_the_author_meta('newsletteropt', $user_id);
$marketingopt = get_the_author_meta('marketingopt', $user_id);



?>
<div class="content-padding gray-bkg vendor-policies">
    <div class="notice-wrapper">
    </div>
    <div class="row">

        <div class="col-md-12">
            <!-- <form method="post" name="shop_settings_form" class="wcmp_policy_form form-horizontal"> -->
            <form action="<?php echo esc_url(add_query_arg(array('page' => 'marketing_preferences'), stm_get_author_link(''))); ?>" method="post" enctype="multipart/form-data" id="stm_user_settings_edit" class="stm_save_user_settings_ajax author-form">
                <div class="panel panel-default pannel-outer-heading">
                    <div class="panel-heading d-flex">
                        <?php  //print_r($_POST);?>
                        <h2>Your current selection</h2>
                    </div>
                    <div class="panel-body panel-content-padding">
                        <div class="form-group d-flex align-items-center">
                            
                            <div class="row">
                                <div class="col-md-12">
                                                <label>
                                                    <input type="checkbox" name="newsletteropt"
                                                        value="Opt in to Newsletters" <?php if($newsletter){ echo "checked";} ?>>
                                                    Opt in to Newsletters 
                                                </label>
                                            </div>
                                        
                            
                                            <div class="col-md-12">
                                                <label>
                                                    <input type="checkbox" name="marketingopt" value="Opt in to Marketing and Promotions" <?php if($marketingopt){ echo "checked";} ?>>
                                                    Opt in to Marketing and Promotions
                                                </label>
                                            </div>
                            
                                </div>
                                
                            <input type="hidden" name="marketingsoft" value="1" />


                        </div>
                    </div>
                    <div class="wcmp-action-container">
                        <button class="btn btn-default" type="submit">Save Changes</button>
                        <div class="clear"></div>
                    </div>
            </form>
        </div>
    </div>
</div>