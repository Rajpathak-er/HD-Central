<?php
$user = stm_get_user_custom_fields('');
 $user_id = $user['user_id'];

$membership_level = pmpro_getMembershipLevelForUser($user_id);
$level_id = $membership_level->ID;                                          

global $wpdb;



//$services = get_user_meta($user_id, 'business_category', true);
//$servicesarray = json_decode($services, true);




//if (isset($_POST['service_categories'])) {
if (isset($_POST['save_service'])) {

	$service_data = "";
	if( isset($_POST['service_categories']) ){ $service_data = $_POST['service_categories']; }

	update_user_meta($user_id, 'service_category', $service_data);
    //echo "<pre>";
    //var_dump(serialize($service_data));
    //echo "</pre>";
    $wpdb->update('provider_live', array('service_category'=>serialize($service_data)),  array('user_id' => $user_id));

    if(!empty($_REQUEST['enable_service_booking'])){
        update_user_meta($user_id, 'enable_service_booking', $_REQUEST['enable_service_booking']);
        update_user_meta($user_id, 'book_email', $_REQUEST['book_email']);
    }else{
        update_user_meta($user_id, 'enable_service_booking', '');
        update_user_meta($user_id, 'book_email', $_REQUEST['book_email']);
    }
}

$servicesdata = get_user_meta($user_id,'service_category',true);
$servicesdata = $wpdb->get_var( $wpdb->prepare("select service_category FROM provider_live where user_id = %d ",
    $user_id
) );

//var_dump($servicesdata);
$servicesdata = unserialize ($servicesdata);
//echo "<pre>";
//print_r($servicesdata);
//echo "</pre>";
//die;

$book_email = get_user_meta($user_id,'book_email',true);
$enable_service_booking = get_user_meta($user_id,'enable_service_booking',true);

$service_categories = get_terms(array('taxonomy' => 'service_category', 'hide_empty' => false, 'parent' => 0));
?>

<div class="content-padding gray-bkg vendor-policies">
    <div class="notice-wrapper">
    </div>
    <div class="row">

        <form action="<?php echo esc_url(add_query_arg(array('page' => 'service_provider_settings'), stm_get_author_link(''))); ?>"
            method="post" enctype="multipart/form-data" id="stm_user_settings_edit"
            class="stm_save_user_settings_ajax author-form col-md-12">
            <div class="col-md-12">
                <?php if($level_id == 8) { ?>
                 <div class="panel panel-default pannel-outer-heading">
                    <div class="panel-heading d-flex">
                        <input type="checkbox" name="enable_service_booking" value="1" <?php if (!empty($enable_service_booking)) { echo "checked='checked'"; } ?>>
                                                        <h2>Enable Service and Repair Bookings</h2>
                    </div>
                    <div class="panel-body panel-content-padding" style="position: relative;">
                         <div class="form-group d-flex align-items-center mb-0">
                            
                            <div class="col-md-12 col-sm-12">

                                <div class="row align-items-center">
                                    <div class="col-md-6">Add your service and repair booking email address: </div>
                                    <div class="col-md-6">
                                        <input type="text" name="book_email"  value="<?php echo $book_email; ?>" />
                                        <br/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        <?php }?>

<?php 
foreach ($service_categories as $service_categorie){

    $allservice = get_terms( array(
        'taxonomy' => 'service_category',
        'hide_empty' => false,
        'parent' => $service_categorie->term_id
    ) );
?>




            
                <!-- <form method="post" name="shop_settings_form" class="wcmp_policy_form form-horizontal"> -->

                <div class="panel panel-default pannel-outer-heading">
                    <div class="panel-heading d-flex">
                        <input type="checkbox" name="service_categories[]" value="<?php echo $service_categorie->term_id; ?>" <?php if (in_array($service_categorie->term_id, $servicesdata)) { echo "checked='checked'"; } ?>>
                                                        <h2><?php echo $service_categorie->name; ?></h2>
                    </div>
                    
                    
                        <?php 
                    if($allservice){
                    ?>
<div class="panel-body panel-content-padding" style="position: relative;">
                    <?php
                    if($level_id != 8) {
                        $link =  esc_url( add_query_arg( array( 'page' => 'business_settings' ), stm_get_author_link( '' ) ) );
                        echo "<div class='disbaledivblock'> Upgrade to <a href='$link'>Premium Membership</a> to select</div>";
                    } 

                    ?>
                        <div class="form-group d-flex align-items-center mb-0">
                            
                            <div class="col-md-12 col-sm-12">

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
                    </div>
                <?php }?>
                

                <?php 
}
?>

                <div class="wcmp-action-container">
                    <button class="btn btn-default" type="submit" name="save_service">Save Changes</button>
                    <div class="clear"></div>
                </div>
        </form>
    </div>



    
</div>

<style type="text/css">
    .disbaledivblock {
    position: absolute;
    background: rgb(211 219 227 / 70%);
    width: 100%;
    height: 100%;
    text-align: center;
    z-index: 100;
    color: red;
    font-size: 16px;
    font-weight: bold;
    padding: 10px;
    margin: -13px;
}


</style>

