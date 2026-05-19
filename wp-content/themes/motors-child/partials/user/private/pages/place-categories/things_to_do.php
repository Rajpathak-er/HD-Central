<?php
$user = stm_get_user_custom_fields('');
$user_id = $user['user_id'];


//$services = get_user_meta($user_id, 'business_category', true);
//$servicesarray = json_decode($services, true);
$allthings = get_terms( array(
        'taxonomy' => 'things_to_do',
        'hide_empty' => false,
    ) );



//if (isset($_POST['things'])) {
if( isset($_POST['save_thing']) ){	
	
	if( isset($_POST['things']) ){ $service_data = $_POST['things']; }else{ $service_data = ""; }
	
	update_user_meta($user_id, 'things_to_do', $service_data);
}

$placedata = get_user_meta($user_id,'things_to_do',true);

?>

<div class="content-padding gray-bkg vendor-policies">
    <div class="notice-wrapper">
    </div>
    <div class="row">

        <form action="<?php echo esc_url(add_query_arg(array('page' => 'things_to_do'), stm_get_author_link(''))); ?>"
            method="post" enctype="multipart/form-data" id="stm_user_settings_edit"
            class="stm_save_user_settings_ajax author-form col-md-12">
            <div class="col-md-12">
                <!-- <form method="post" name="shop_settings_form" class="wcmp_policy_form form-horizontal"> -->

                <div class="panel panel-default pannel-outer-heading">
                    <div class="panel-heading d-flex">
                        <h2>Things To Do</h2>
                    </div>
                    <div class="panel-body panel-content-padding">
                        <div class="form-group d-flex align-items-center mb-0">
                            <label class="control-label col-sm-2 mb-0">Categories</label>
                            <div class="col-md-10 col-sm-10">

                                <div class="row align-items-center">
                                    <div class="col-md-12">
									
										<?php foreach ($allthings as $key => $thing) { ?>
											<div class="col-md-4">
												<label>
													<input type="checkbox" name="things[]" value="<?php echo $thing->term_id; ?>" <?php if (in_array($thing->term_id, $placedata)) { echo "checked='checked'"; } ?>>
														<?php echo $thing->name; ?>
												</label>
											</div>
										<?php } ?>
									
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="wcmp-action-container">
                    <button class="btn btn-default" type="submit" name="save_thing">Save Changes</button>
					<div class="clear"></div>
                </div>
        </form>
    </div>



    </form>
</div>
</div>