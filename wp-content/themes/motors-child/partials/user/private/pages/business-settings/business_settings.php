<?php
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

$user = stm_get_user_custom_fields('');
global $wpdb;

$socials_list = array('facebook' => '', 'twitter' => '', 'linkedin' => '', 'youtube' => '');
$socials = $user['socials'];
foreach ($socials_list as $key => $val) {
    $socials[$key] = (isset($socials[$key])) ? $socials[$key] : '';
}

$user_id = $user['user_id'];
//echo "+++++".$user_id;

$place_user = get_user_meta( $user_id, 'place_user', true );

//$wsl = get_user_meta($user['user_id'], 'wsl_current_provider', true);


$all_meta_for_user = get_user_meta($user_id);

global $wp_roles;
$all_roles = $wp_roles->get_names(); 
//echo '<pre>' . print_r( $all_roles ) . '</pre>';

// Get the user object.
$userObj = get_userdata( $user_id );
$user_roles = $userObj->roles;
//print_r($user_roles);
// $type = array();
// foreach($user_roles as $role){
	// $type[] = $all_roles[$role];
// }
global $current_user;
$current_user->membership_level = pmpro_getMembershipLevelForUser($current_user->ID);
$membership_level = $current_user->membership_level->ID;


	if(!empty($current_user->membership_level)) {
		$type = $current_user->membership_level->name;
	}
	//echo "MeMbership:".$type;
if( in_array("stm_dealer", $user_roles) ){
	//$type = "Free Business Account";
	$type = $type;
}else{
	$type = "Personal Subscriber";
}

$current_year = date("Y");
$previousyear = $current_year - 100;



if (isset($_POST['business_name'])) {
		
	// print_r($_POST);
	// die();
	if( !isset($_POST['same_as_reg_user']) ){ $same_as_reg_user = 0; }else{ $same_as_reg_user = 1; }
	if( !isset($_POST['harley_main_dealer']) ){ $harley_main_dealer = 0; }else{ $harley_main_dealer = 1; }
	

    $metas = array(
        'business_name'   => $_POST['business_name'],
        'business_legal_type' => $_POST['legal_type'],
        'business_registration_no'  => $_POST['business_reg_no'],
		'same_as_reg_user' => $same_as_reg_user,
		'business_fname' => $_POST['business_fname'],
		'business_surname' => $_POST['business_surname'],
		'business_mobile' => $_POST['business_mobile'],
		'business_email' => $_POST['business_email'],
		'year_in_business' => $_POST['year_in_business'],
		'harley_main_dealer' => $harley_main_dealer,
    );

    foreach ($metas as $key => $value) {
        update_user_meta($user_id, $key, $value);
    }
	
	//header('Location: ' . site_url($_SERVER['REQUEST_URI']));
}


$wpdb->update('provider_live', array('stm_company_name'=> $_POST['business_name'], 
                                    
                                    'First Name' => $_POST['business_fname'] ,
                                    'Last Name' => $_POST['business_surname'] ,
                                ),  array('user_id' => $user_id));



$business_name = get_the_author_meta('business_name', $user_id);
$legal_type = get_the_author_meta('business_legal_type', $user_id);
$business_reg_no = get_the_author_meta('business_registration_no', $user_id);

$first_name = get_the_author_meta('first_name', $user_id);
$last_name = get_the_author_meta('last_name', $user_id);
$phone = get_the_author_meta('stm_phone', $user_id);
$email = get_the_author_meta('email', $user_id);
$same_as_reg_user = get_the_author_meta('same_as_reg_user', $user_id);
$year_in_business = get_the_author_meta('year_in_business', $user_id);
$harley_main_dealer = get_the_author_meta('harley_main_dealer', $user_id);


if( $legal_type == "Incorporated Business" ){ $type_class = ""; }else{ $type_class = "hide"; }
if( $harley_main_dealer == "1" ){ $class = "hide"; }else{ $class = "hide"; }


?>

<style>
	.hide{
		display: none !important;
	}
</style>

<div class="content-padding gray-bkg vendor-policies">
    <div class="notice-wrapper">
    </div>
    <div class="row">

		<form action="<?php echo esc_url(add_query_arg(array('page' => 'business_settings'), stm_get_author_link(''))); ?>" method="post" enctype="multipart/form-data" id="stm_user_settings_edit" class="stm_save_user_settings_ajax author-form col-md-12">
			<div class="col-md-12">
                <!-- <form method="post" name="shop_settings_form" class="wcmp_policy_form form-horizontal"> -->
						
                <div class="panel panel-default pannel-outer-heading">
                    <div class="panel-heading d-flex">
                        <h2> HD-Central Account Type</h2>
                    </div>
                    <div class="panel-body panel-content-padding">
						<div class="form-group d-flex align-items-center  mb-1">
							<label class="control-label col-sm-3 mb-0"><?php echo $type; ?></label>
						</div>
					</div>
				</div>
				<?php if($membership_level != 8) {?>
				<div class="panel panel-default pannel-outer-heading">
					<div class="panel-heading d-flex">
                        <h2> Upgrade your HD-Central Account</h2>
                    </div>
					<div class="panel-body panel-content-padding">
						<div class="form-group d-flex align-items-center mb-0">
							<div class="col-md-12" >

								<div class="row">
									<div class="col-md-4 col-sm-6">
										<a href="<?php echo get_permalink(29983); ?>?level=8" class="btn btn-default mb-0">Upgrade your account</a>
									</div>
									<div class="col-md-4 col-sm-6" style="display: none;">
										<a href="#" class="btn btn-default">Add Parts and Accessories</a>
									</div>
									<div class="col-md-4 col-sm-6" style="display: none;">
										<a href="#" class="btn btn-default">Set up HD - C Webshop</a>
									</div>
								</div>
							</div>		
						</div>
						<div class="form-group d-flex align-items-center">
							<div class="col-md-12" style="display:none;">
								<div class="row">
									<div class="col-md-6 col-sm-6">
										<a href="#" class="btn btn-default">Link and promote your current online business</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>
				<div class="panel panel-default pannel-outer-heading">
					<div class="panel-heading d-flex">
                        <h2> Business Name</h2>
                    </div>
					<div class="panel-body panel-content-padding">
						 <div class="form-group d-flex align-items-center">
                            <label class="control-label col-sm-3 mb-0">Business Legal Name</label>
                            <div class="col-md-6 col-sm-9">                               
							   <input class="form-control" type="text" name="business_name" value="<?php echo $business_name; ?>" placeholder="<?php esc_attr_e('Business Legal Name', 'motors') ?>" required />
                            </div>
                        </div>
					</div>
				</div>

				<div class="panel panel-default pannel-outer-heading">
					<div class="panel-heading d-flex">
                        <h2> Business Legal Type </h2>
                    </div>
					<div class="panel-body panel-content-padding">
						<div class="form-group d-flex align-items-center mb-0">
                            <label class="control-label col-sm-3 mb-0">Business Legal Type</label>
                            <div class="col-md-9 col-sm-9">                               
							   <div class="row">
                                    <div class="col-md-4">
                                        <input id="legal_type_incorporated" type="radio" name="legal_type" value="Incorporated Business" <?php echo $legal_type == 'Incorporated Business' ? 'checked' : '' ?>>
                                        <label for="type_incorporated">
                                            <span>Incorporated Business</span>
                                        </label>
                                    </div>
                                    <div class="col-md-4">
                                        <input id="legal_type_proprietor" type="radio" name="legal_type" value="Sole Proprietor" <?php echo $legal_type == 'Sole Proprietor' ? 'checked' : '' ?>>
                                        <label for="type_proprietor">
                                            <span>Sole Proprietor</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
						<div class="form-group d-flex align-items-center <?php echo $type_class; ?>" id="business_reg_number" >
                            <label class="control-label col-sm-3 mb-0">Business Registration Number</label>
                            <div class="col-md-9 col-sm-9">                               
							    <input type="text" class="form-control" value="<?php echo $business_reg_no; ?>" id="business_reg_no" name="business_reg_no" placeholder="<?php esc_attr_e('Add your business registration number', 'motors') ?>">
                            </div>
                        </div>
					</div>
				</div>

				<div class="panel panel-default pannel-outer-heading">
					<div class="panel-heading d-flex">
                        <h2> Appointed Business Contact</h2>
                    </div>
					<div class="panel-body panel-content-padding">
						<div class="form-group d-flex align-items-center">
                            <label class="control-label col-sm-3 mb-0">Same as Registered User</label>
                            <div class="col-md-9 col-sm-9">                               
							   <div class="row">
                                    <div class="col-md-4">
                                        <input id="same_as_reg_user" type="checkbox" name="same_as_reg_user" value="1" <?php echo $same_as_reg_user == '1' ? 'checked' : '' ?>>
                                        <label for="same_as_reg_user">
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
						
						<div class="form-group d-flex align-items-center">
							 <h2 class="control-label col-sm-6 mb-0">Add Appointed Business Contact</label>
						</div>
						<div class="form-group d-flex align-items-center">
                            <label class="control-label col-sm-3 mb-0">Name</label>
                            <div class="col-md-6 col-sm-9">
                                <input class="form-control" type="text" name="business_fname" value="<?php echo get_the_author_meta('business_fname', $user_id); ?>" placeholder="<?php esc_attr_e('Enter Name', 'motors') ?>" />
                            </div>
                        </div>
						<div class="form-group d-flex align-items-center">
                            <label class="control-label col-sm-3 mb-0">Surname</label>
                            <div class="col-md-6 col-sm-9">
                                <input class="form-control" type="text" name="business_surname" value="<?php echo get_the_author_meta('business_surname', $user_id); ?>" placeholder="<?php esc_attr_e('Enter Surname', 'motors') ?>" />
                            </div>
                        </div>
						<div class="form-group d-flex align-items-center">
                            <label class="control-label col-sm-3 mb-0">Mobile Number</label>
                            <div class="col-md-6 col-sm-9">
                                <input class="form-control" type="text" name="business_mobile" value="<?php echo get_the_author_meta('business_mobile', $user_id); ?>" placeholder="<?php esc_attr_e('Enter Mobile Number', 'motors') ?>" />
                            </div>
                        </div>
						<div class="form-group d-flex align-items-center">
                            <label class="control-label col-sm-3 mb-0">Email address</label>
                            <div class="col-md-6 col-sm-9">
                                <input class="form-control" type="text" name="business_email" value="<?php echo get_the_author_meta('business_email', $user_id); ?>" placeholder="<?php esc_attr_e('Enter Email address', 'motors') ?>" />
                            </div>
                        </div>
					</div>
				</div>

				<div class="panel panel-default pannel-outer-heading">
					<div class="panel-heading d-flex">
                        <h2> Trading History </h2>
                    </div>
					<div class="panel-body panel-content-padding">
						<div class="form-group d-flex align-items-center">
							<label class="control-label col-sm-3 mb-0">What year did you start trading ?</label>
							<div class="col-md-6 col-sm-9">
								<select class="form-control" name="year_in_business" id="year_in_business">
                                    <option value="">years in business</option>
                                    <?php for( $year = $current_year; $year >= $previousyear; $year-- ){ ?>
										<option value="<?php echo $year; ?>" <?php echo $year_in_business == $year ? 'selected' : '' ?>><?php echo $year; ?></option>
									<?php } ?>   
                                </select>
							</div>
						</div>
					</div>
				</div>
				<?php
				$placedata = get_user_meta($user_id,'place_categories',true);
				 ?>
				<div class="panel panel-default pannel-outer-heading" <?php if($placedata) { echo ' style="display:none;"';} ?>>
					<div class="panel-heading d-flex">
                        <h2> Affiliations </h2>
                    </div>
					<div class="panel-body panel-content-padding">
						<div class="form-group d-flex align-items-center">
							<label class="control-label col-sm-5 mb-0">Are you a Harley – Davidson Main Dealer ?</label>
							<div class="col-md-6 col-sm-9">
								<input id="harley_main_dealer" type="checkbox" name="harley_main_dealer" value="1" <?php echo $harley_main_dealer == '1' ? 'checked' : '' ?>>
                                <label for="harley_main_dealer">
									<span></span>
								</label>
							</div>
						</div>
						<div class="form-group d-flex align-items-center <?php echo $class; ?>" id="harley_logo_icon_container">
							<label class="control-label col-sm-3 mb-0">Harley Logo Icon</label>
                            <div class="col-md-9 col-sm-9">                               
							    <input type="file" class="form-control" id="harley_logo_icon" name="harley_logo_icon">
                            </div>
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
		
		// Business Legal Type click
		$("input[name='legal_type']").change(function() {
			if ($(this).val() == "Incorporated Business") {
				//$("#business_reg_number").css({"display": "block"});
				$("#business_reg_number").removeClass("hide");
			} else {
				//$("#business_reg_number").css({"display": "none"});
				$("#business_reg_number").addClass("hide");
				$("#business_reg_number #business_reg_no").val('');
            }
		});
		
		//Same as registered user
		$("#same_as_reg_user").click(function() {
			if( $(this).is(":checked") ){
				$("input[name='business_fname']").val('<?php echo $first_name; ?>');
				$("input[name='business_surname']").val('<?php echo $last_name; ?>');
				$("input[name='business_mobile']").val('<?php echo $phone; ?>');
				$("input[name='business_email']").val('<?php echo $email; ?>');
			}else{
				$("input[name='business_fname']").val('');
				$("input[name='business_surname']").val('');
				$("input[name='business_mobile']").val('');
				$("input[name='business_email']").val('');
			}
		});
		
		//
		$("#harley_main_dealer").click(function() {
			/*if( $(this).is(":checked") ){
				$("#harley_logo_icon_container").removeClass("hide");
			} else {
				$("#harley_logo_icon_container").addClass("hide");
			}*/
		});
		
    })
</script>