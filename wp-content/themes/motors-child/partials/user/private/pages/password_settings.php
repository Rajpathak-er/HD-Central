<?php

$user = stm_get_user_custom_fields('');

$socials_list = array('facebook' => '', 'twitter' => '', 'linkedin' => '', 'youtube' => '');
$socials = $user['socials'];
foreach ($socials_list as $key => $val) {
    $socials[$key] = (isset($socials[$key])) ? $socials[$key] : '';
}
$wsl = get_user_meta($user['user_id'], 'wsl_current_provider', true);

if (isset($_POST['stm_current_password'])) {

    $usr = wp_get_current_user();

    $valid = wp_check_password($_POST['stm_current_password'], $usr->data->user_pass, $user['user_id']);

    if ($valid) {
        wp_set_password($_POST['stm_change_password'], $user['user_id']);
        $message = [
            "type" => "success",
            "text" => 'Password changed successfully'
        ];
    } else {
        $message = [
            "type" => "danger",
            "text" => 'Your password does not match with current password'
        ];
    }
    // header('Location: ' . site_url($_SERVER['REQUEST_URI']));
}

?>

<div class="content-padding gray-bkg vendor-policies">
    <div class="notice-wrapper">
    </div>
    <div class="row">

        <div class="col-md-12">
            <!-- <form method="post" name="shop_settings_form" class="wcmp_policy_form form-horizontal"> -->
            <form action="<?php echo esc_url(add_query_arg(array('page' => 'password_settings'), stm_get_author_link(''))); ?>" method="post" enctype="multipart/form-data" id="stm_user_settings_edit" class="stm_save_user_settings_ajax author-form">


                <div class="panel panel-default pannel-outer-heading">
                    <div class="panel-heading d-flex">
                        <h2>Change Password </h2>
                    </div>

                    <?php if (isset($message)) { ?>
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                                <div class="alert alert-<?= $message['type'] ?>" role="alert">
                                    <?php echo $message['text']; ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="panel-body panel-content-padding">
                        <div class="form-group d-flex align-items-center">
                            <label class="control-label col-sm-3 mb-0">Current Password</label>
                            <div class="col-md-6 col-sm-9">

                                <input class="form-control" type="password" name="stm_current_password" placeholder="<?php esc_attr_e('Enter Current Password', 'motors') ?>" required />
                            </div>
                        </div>


                        <div class="form-group d-flex align-items-center">
                            <label class="control-label col-sm-3 mb-0">Change Password</label>
                            <div class="col-md-6 col-sm-9">

                                <input class="form-control" type="password" name="stm_change_password" placeholder="<?php esc_attr_e('Enter New Password', 'motors') ?>" required />
                            </div>
                        </div>

                    </div>
                </div>
                <div class="wcmp-action-container">
                    <button class="btn btn-default" type="submit">Update PassWord</button>
                    <div class="clear"></div>
                </div>
            </form>
        </div>


    </div>
</div>