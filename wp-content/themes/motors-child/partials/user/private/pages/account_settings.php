<?php

$user = stm_get_user_custom_fields('');

$author = get_user_by('id', $user['user_id']);
//print_r($author);

$socials_list = array('facebook' => '', 'twitter' => '', 'linkedin' => '', 'youtube' => '');
$socials = $user['socials'];
foreach ($socials_list as $key => $val) {
    $socials[$key] = (isset($socials[$key])) ? $socials[$key] : '';
}
$wsl = get_user_meta($user['user_id'], 'wsl_current_provider', true);

if (isset($_POST['stm_name'])) {

    $user_id = $user['user_id'];
	
	

    $metas = array(
        'first_name'   => $_POST['stm_name'],
        'last_name' => $_POST['stm_surname'],
        'stm_phone'  => $_POST['stm_phone'],
        'email'   => $_POST['email'],
    );

    foreach ($metas as $key => $value) {
        update_user_meta($user_id, $key, $value);
    }
    header('Location: ' . site_url($_SERVER['REQUEST_URI']));
}

?>

<div class="content-padding gray-bkg vendor-policies">
    <div class="notice-wrapper">
    </div>
    <div class="row">

        <form action="<?php echo esc_url(add_query_arg(array('page' => 'account_settings'), stm_get_author_link(''))); ?>" method="post" enctype="multipart/form-data" id="stm_user_settings_edit" class="stm_save_user_settings_ajax author-form col-md-12">
            <div class="col-md-12">
                <!-- <form method="post" name="shop_settings_form" class="wcmp_policy_form form-horizontal"> -->

                <div class="panel panel-default pannel-outer-heading">
                    <div class="panel-heading d-flex">
                        <h2>Registered User Details </h2>
                    </div>
                    <div class="panel-body panel-content-padding">
                        <div class="form-group d-flex align-items-center">
                            <label class="control-label col-sm-3 mb-0">Name</label>
                            <div class="col-md-6 col-sm-9">

                                <input class="form-control" type="text" name="stm_name" value="<?php echo esc_attr($user['name']); ?>" placeholder="<?php esc_attr_e('Enter Name', 'motors') ?>" required />
                            </div>
                        </div>


                        <div class="form-group d-flex align-items-center">
                            <label class="control-label col-sm-3 mb-0">Surname</label>
                            <div class="col-md-6 col-sm-9">

                                <input class="form-control" type="text" name="stm_surname" value="<?php echo esc_attr($user['last_name']); ?>" placeholder="<?php esc_attr_e('Enter Surname', 'motors') ?>" required />
                            </div>
                        </div>

                        <div class="form-group d-flex align-items-center">
                            <label class="control-label col-sm-3 mb-0">Mobile / Cell Number </label>
                            <div class="col-md-6 col-sm-9">

                                <input class="form-control" type="text" name="stm_phone" value="<?php echo esc_attr($user['phone']); ?>" placeholder="<?php esc_attr_e('Enter Phone Number', 'motors') ?>" required />
                            </div>
                        </div>

                        <div class="form-group d-flex align-items-center">
                            <label class="control-label col-sm-3 mb-0">Email Address</label>
                            <div class="col-md-6 col-sm-9">

                                <input class="form-control" type="email" name="stm_email" value="<?php echo esc_attr($user['email']); ?>" placeholder="<?php esc_attr_e('Enter Email', 'motors') ?>" readonly />
                            </div>
                        </div>
						
						<div class="form-group d-flex align-items-center">
                            <label class="control-label col-sm-3 mb-0">User Name</label>
                            <div class="col-md-6 col-sm-9">

                                <input class="form-control" type="text" name="stm_username" value="<?php echo esc_attr($author->user_login); ?>"  readonly />
                            </div>
                        </div>
						
                    </div>
                </div>
                <div class="wcmp-action-container">
                    <button type="submit" class="btn btn-default" name="store_save">Save Options</button>
                </div>
        </form>
    </div>
    <!-- 
    <div class="col-md-12">

        <div class="panel panel-default pannel-outer-heading">
            <div class="panel-heading d-flex">
                <h2>Profile Picture </h2>
            </div>
            <div class="panel-body panel-content-padding">
                <?php
                $img_url = '';
                $img_empty = '';
                if (!empty($user['image'])) {
                    $img_url = $user['image'];
                    $img_empty = 'hide-empty';
                } else {
                    $img_empty = 'hide-photo';
                }
                ?>
                <div class="clearfix stm-image-unit stm-image-avatar <?php echo esc_attr($img_empty); ?>">
                    <div class="image ">
                        <div class="stm_image_upl">
                            <i class="fa fa-remove"></i>
                            <img src="<?php echo esc_url($img_url); ?>" class="img-responsive" />
                        </div>
                        <script type="text/javascript">
                            jQuery('document').ready(function() {
                                var $ = jQuery;
                                $('.stm-my-profile-settings .stm-image-unit .image .fa-remove').on('click', function() {
                                    $('.stm-image-avatar').removeClass('hide-empty').addClass('hide-photo');
                                    $('.stm-new-upload-area input[type="file"]').val('');
                                    $(this).append('<input type="hidden" value="delete" id="stm_remove_img" name="stm_remove_img" />');
                                });
                            });
                        </script>

                        <div class="stm-empty-avatar-icon"><i class="fa fa-camera"></i></div>

                    </div>
                    <div class="stm-upload-new-avatar">
                        <div class="heading-font"><?php esc_html_e('Upload profile pic', 'motors'); ?></div>
                        <div class="stm-new-upload-area clearfix">
                            <a href="#" class="button stm-choose-file"><?php esc_html_e('Choose file', 'motors'); ?></a>
                            <div class="stm-new-file-label"><?php esc_html_e('No File Chosen', 'motors'); ?></div>
                            <input type="file" name="stm-avatar" />

                        </div>
                        <div class="stm-label"><?php esc_html_e('JPEG or PNG minimal 160x160px', 'motors'); ?></div>
                    </div>
                </div>

            </div>
        </div>
        <div class="wcmp-action-container">
            <div class="clear"></div>
        </div>

    </div> -->

    </form>
</div>
</div>



<script type="text/javascript">
    var stm_settings_file = {}
    jQuery(document).ready(function() {
        var $ = jQuery;
        $('body').on('change', 'input[name="stm-avatar"]', function() {
            var length = $(this)[0].files.length;

            if (length == 1) {
                $('.stm-new-file-label').text($(this).val());
            } else {
                $('.stm-new-file-label').text('<?php esc_html_e('No File Chosen', 'motors'); ?>');
            }
        });

        // var submitForm = document.getElementById('submitAccoutnForm');

        // submitForm.on("click", function)


        function submitForm() {
            var form = $('stm_user_settings_edit');
            alert("hi");
        }
    })
</script>