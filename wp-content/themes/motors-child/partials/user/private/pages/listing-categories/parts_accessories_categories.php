<?php

$user = stm_get_user_custom_fields('');
$user_id = $user['user_id'];


//$services = get_user_meta($user_id, 'business_category', true);
//$servicesarray = json_decode($services, true);

$allparts = get_terms( array(
        'taxonomy' => 'parts',
        'hide_empty' => false,
    ) );



//if (isset($_POST['parts_categories_list'])) {
if( isset($_POST['save_part']) ){
	
	$parts_categories = "";
    if( isset($_POST['parts_categories_list']) ){ $parts_categories = $_POST['parts_categories_list']; }

    update_user_meta($user_id, 'parts_category', $parts_categories);
    
}

$parts_category = get_user_meta($user_id,'parts_category',true);

?>

<div class="content-padding gray-bkg vendor-policies parts-ccess">
    <div class="notice-wrapper">
    </div>
    <div class="row">

        <form action="<?php echo esc_url(add_query_arg(array('page' => 'parts_accessories_categories'), stm_get_author_link(''))); ?>" method="post" enctype="multipart/form-data" id="stm_user_settings_edit" class="stm_save_user_settings_ajax author-form col-md-12">
            <div class="panel panel-default pannel-outer-heading">
                    <div class="panel-heading d-flex">
                        <h2>Parts & Accessories Categories</h2>
                    </div>
                    <div class="panel-body panel-content-padding">
                        <div class="form-group d-flex align-items-center mb-0">
                            <label class="control-label col-sm-2 mb-0">Categories</label>
                            <div class="col-md-10 col-sm-10">

                                <div class="row align-items-center">
                                    <div class="col-md-12">
                
            <div class="col-md-12">
                <!-- <form method="post" name="shop_settings_form" class="wcmp_policy_form form-horizontal"> -->
                <?php isset($message) ? dispay_message($message) : "" ?>
               
                <?php foreach ($allparts as $key => $part) { ?>
                                            <div class="col-md-4">
                                                <label>
                                                    <input type="checkbox" name="parts_categories_list[]" value="<?php echo $part->term_id; ?>" <?php if (in_array($part->term_id, $parts_category)) { echo "checked='checked'"; } ?>>
                                                        <?php echo $part->name; ?>
                                                </label>
                                            </div>
                                        <?php } ?>
                                    

                <div class="wcmp-action-container">
                    <button class="btn btn-default" type="submit" name="save_part">Save Changes</button>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>

        </form>
    </div>
    </form>
</div>
</div>