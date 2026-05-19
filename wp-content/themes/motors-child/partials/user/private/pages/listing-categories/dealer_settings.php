<?php

$user_current = wp_get_current_user();

$user_id = $user_current->ID;

$is_warranty = get_the_author_meta('is_warranty', $user_id);
$warranty_type = json_decode(get_the_author_meta('Warranty_Type', $user_id));

$trade_in_facility = get_the_author_meta('trade_in_facilities', $user_id);
$house_in_facility = get_the_author_meta('house_in_facility', $user_id);
$provide_ride = get_the_author_meta('provide_ride', $user_id);

if (isset($_POST['save_dealer'])) {
	
	if( isset($_POST['warranty_type']) ){ $Warranty_Type = json_encode($_POST['warranty_type']); }else{ $Warranty_Type = ""; }

    $metas = array(
        'is_warranty'   => $_POST['is_warranty'],
        'Warranty_Type' => $Warranty_Type,
        'trade_in_facilities'  => $_POST['trade_in_facilities'],
        'house_in_facility'   => $_POST['house_in_facility'],
        'provide_ride' => $_POST['provide_ride']
    );


    foreach ($metas as $key => $value) {
        update_user_meta($user_id, $key, $value);
    }


     $service_data = "";
    if( isset($_POST['service_categories']) ){ $service_data = $_POST['service_categories']; }

    update_user_meta($user_id, 'dealer_categories', $service_data);

    header('Location: ' . site_url($_SERVER['REQUEST_URI']));
}

$servicesdata = get_user_meta($user_id,'dealer_categories',true);

?>
<div class="content-padding gray-bkg vendor-policies">
    <div class="notice-wrapper">
    </div>
    <div class="row">

        <form action="<?php echo esc_url(add_query_arg(array('page' => 'dealer_settings'), stm_get_author_link(''))); ?>" method="post" enctype="multipart/form-data" id="stm_user_settings_edit" class="stm_save_user_settings_ajax author-form col-md-12">
            <div class="col-md-12">
                <!-- <form method="post" name="shop_settings_form" class="wcmp_policy_form form-horizontal"> -->

                <?php 
                $service_categories = get_terms(array('taxonomy' => 'service_category', 'hide_empty' => false, 'parent' => 0, 'include' => '21276'));
foreach ($service_categories as $service_categorie){

    $allservice = get_terms( array(
        'taxonomy' => 'service_category',
        'hide_empty' => false,
        'parent' => $service_categorie->term_id
    ) );
?>


            
                <!-- <form method="post" name="shop_settings_form" class="wcmp_policy_form form-horizontal"> -->

                <div class="panel panel-default pannel-outer-heading" style="display:none;">
                    <div class="panel-heading d-flex">
                        <input type="checkbox" name="service_categories[]" value="<?php echo $service_categorie->term_id; ?>" <?php if (in_array($service_categorie->term_id, $servicesdata)) { echo "checked='checked'"; } ?>>
                                                        <h2><?php echo $service_categorie->name; ?></h2>
                    </div>
                    <?php 
                    if($allservice){
                    

                    ?>
                    <div class="panel-body panel-content-padding">
                        <div class="form-group d-flex align-items-center mb-0">
                            
                            <div class="col-md-10 col-sm-12">

                                <div class="row align-items-center">
                                    <div class="col-md-12">
                                    
                                        <?php foreach ($allservice as $key => $service) { ?>
                                            <div class="col-md-4">
                                                <label>
                                                    <input type="checkbox" name="service_categories[]" value="<?php echo $service->term_id; ?>" <?php if (in_array($service->term_id, $servicesdata)) { echo "checked='checked'"; } ?>>
                                                        <?php echo $service->name; ?>
                                                </label>
                                            </div>
                                        <?php } ?>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                <?php }?>
                </div>

                <?php 
}
?>

                <div class="panel panel-default pannel-outer-heading">
                    <div class="panel-heading d-flex">
                        <h2>Dealer Facilities</h2>
                    </div>
                    <div class="panel-body panel-content-padding">
                        <div class="form-group d-flex align-items-center">
                            <label class="control-label col-sm-6 mb-0">Do you provide a warranty for all motorcycles you
                                sell? Y/N </label>
                            <div class="col-md-6 col-sm-9">
                                <div class="row">
                                    <div class="col-md-4">
                                        <input id="warranty_yes" type="radio" name="is_warranty" value="Yes" <?php echo $is_warranty == 'Yes' ? 'checked' : '' ?>>
                                        <label for="warranty_yes">
                                            <span>Yes</span>
                                        </label>
                                    </div>
                                    <div class="col-md-4">

                                        <input id="warranty_no" type="radio" name="is_warranty" value="No" <?php echo $is_warranty == 'No' ? 'checked' : '' ?>>
                                        <label for="warranty_no">
                                            <span>No</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group d-flex align-items-center mb-0">
                            <label class="control-label col-sm-6 mb-0">Warranty Type </label>
                            <div class="col-md-6 col-sm-9">

                                <div class="row align-items-center">
                                    <div class="col-md-4">
                                        <label class="mb-0">
                                            <input type="checkbox" name="warranty_type[]" value='Mechanical' <?php echo in_array('Mechanical', $warranty_type) ? 'checked' : '' ?> />
                                            <span>Mechanical </span>
                                        </label>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="mb-0">
                                            <input type="checkbox" name="warranty_type[]" value='Parts and labour' <?php echo in_array('Parts and labour', $warranty_type) ? 'checked' : '' ?> />
                                            <span>Parts and labour</span>
                                        </label>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

                <div class="panel panel-default pannel-outer-heading">
                    <div class="panel-heading d-flex">
                        <h2>Trade Ins and Financing</h2>
                    </div>
                    <div class="panel-body panel-content-padding">
                        <div class="form-group d-flex align-items-center">
                            <label class="control-label col-sm-6 mb-0">Do you provide trade in facilities? </label>
                            <div class="col-md-6 col-sm-9">
                                <div class="row">
                                    <div class="col-md-4">

                                        <input id="trade_in_yes" type="radio" name="trade_in_facilities" value="Yes" <?php echo $trade_in_facility == 'Yes' ? 'checked' : '' ?>>
                                        <label for="trade_in_yes">
                                            <span>Yes</span>
                                        </label>
                                    </div>
                                    <div class="col-md-4">

                                        <input id="trade_in_no" type="radio" name="trade_in_facilities" value="No" <?php echo $trade_in_facility == 'No' ? 'checked' : '' ?>>
                                        <label for="trade_in_no">
                                            <span>No</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group d-flex align-items-center">
                            <label class="control-label col-sm-6 mb-0">Do you provide house financing facilities? </label>
                            <div class="col-md-6 col-sm-9">
                                <div class="row">
                                    <div class="col-md-4">

                                        <input id="house_in_yes" type="radio" name="house_in_facility" value="Yes" <?php echo $house_in_facility == 'Yes' ? 'checked' : '' ?>>
                                        <label for="house_in_yes">
                                            <span>Yes</span>
                                        </label>
                                    </div>
                                    <div class="col-md-4">

                                        <input id="house_in_no" type="radio" name="house_in_facility" value="No" <?php echo $house_in_facility == 'No' ? 'checked' : '' ?>>
                                        <label for="house_in_no">
                                            <span>No</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

                <div class="panel panel-default pannel-outer-heading">
                    <div class="panel-heading d-flex">
                        <h2>Test Rides ? </h2>
                    </div>
                    <div class="panel-body panel-content-padding">
                        <div class="form-group d-flex align-items-center">
                            <label class="control-label col-sm-6 mb-0"> Do you provide test rides ? </label>
                            <div class="col-md-6 col-sm-9">
                                <div class="row">
                                    <div class="col-md-4">

                                        <input id="provide_ride_yes" type="radio" name="provide_ride" value="Yes" <?php echo $provide_ride == 'Yes' ? 'checked' : '' ?>>
                                        <label for="provide_ride_yes">
                                            <span>Yes</span>
                                        </label>
                                    </div>
                                    <div class="col-md-4">

                                        <input id="provide_ride_no" type="radio" name="provide_ride" value="No" <?php echo $provide_ride == 'No' ? 'checked' : '' ?>>
                                        <label for="provide_ride_no">
                                            <span>No</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>


                <div class="wcmp-action-container">
                    <button class="btn btn-default" type="submit" name="save_dealer">Save Changes</button>
                    <div class="clear"></div>
                </div>
        </form>
    </div>



    </form>
</div>
</div>
