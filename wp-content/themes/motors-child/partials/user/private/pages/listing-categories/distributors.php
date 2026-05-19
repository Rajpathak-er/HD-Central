<?php
$user = stm_get_user_custom_fields('');
$user_id = $user['user_id'];


//$services = get_user_meta($user_id, 'business_category', true);
//$servicesarray = json_decode($services, true);
$allservice = get_terms( array(
        'taxonomy' => 'distributors',
        'hide_empty' => false,
    ) );




//if (isset($_POST['distributors'])) {
if( isset($_POST['save_distributor']) ){
	
	$service_data = "";
	if( isset($_POST['distributors']) ){ $service_data = $_POST['distributors']; }

	update_user_meta($user_id, 'distributors', $service_data);
    $wpdb->update('provider_live', array('distributors'=>serialize($service_data)),  array('user_id' => $user_id));
}

$servicesdata = get_user_meta($user_id,'distributors',true);
$servicesdata = $wpdb->get_var( $wpdb->prepare("select distributors FROM provider_live where user_id = %d ",
    $user_id
) );

//var_dump($servicesdata);
$servicesdata = unserialize ($servicesdata);
//echo "<pre>";
//print_r($servicesdata);
//echo "</pre>";
//die;

?>

<div class="content-padding gray-bkg vendor-policies">
    <div class="notice-wrapper">
    </div>
    <div class="row">

        <form action="<?php echo esc_url(add_query_arg(array('page' => 'distributors'), stm_get_author_link(''))); ?>"
            method="post" enctype="multipart/form-data" id="stm_user_settings_edit"
            class="stm_save_user_settings_ajax author-form col-md-12">
            <div class="col-md-12">
                <!-- <form method="post" name="shop_settings_form" class="wcmp_policy_form form-horizontal"> -->

                <div class="panel panel-default pannel-outer-heading">
                    <div class="panel-heading d-flex">
                        <h2 class="hide_dot">Distributors / Stockists : Please choose the brands or businesses you distribute for or stock.</h2>
                    </div>
                    <div class="panel-body panel-content-padding">
                        <div class="form-group d-flex align-items-center mb-0">
                           <!-- <label class="control-label col-sm-2 mb-0">Distributor</label> -->
                            <div class="col-md-12 col-sm-12">

                                <div class="row align-items-center">
                                    <div class="col-md-12">
									
										<?php foreach ($allservice as $key => $service) { ?>
											<div class="col-md-4">
												<label>
													<input type="checkbox" name="distributors[]" value="<?php echo $service->term_id; ?>" <?php if (in_array($service->term_id, $servicesdata)) { echo "checked='checked'"; } ?>>
														<?php echo $service->name; ?>
												</label>
											</div>
										<?php } ?>
									
									
                                        <label class="mb-0" style="display: none;">
                                            <div class="col-md-4">
                                                <label>
                                                    <input type="checkbox" name="service_categories[]"
                                                        value="Mechanical">
                                                    Mechanical
                                                </label>
                                            </div>
                                            <div class="col-md-4">
                                                <label>
                                                    <input type="checkbox" name="service_categories[]" value="MOT">
                                                    MOT
                                                </label>
                                            </div>

                                            <div class="col-md-4">
                                                <label>
                                                    <input type="checkbox" name="service_categories[]"
                                                        value="Service and Repairs">
                                                    Service and Repairs
                                                </label>
                                            </div>

                                            <div class="col-md-4">
                                                <label>
                                                    <input type="checkbox" name="service_categories[]"
                                                        value="Custom Parts Fitting">
                                                    Custom Parts Fitting
                                                </label>
                                            </div>

                                            <div class="col-md-4">
                                                <label>
                                                    <input type="checkbox" name="service_categories[]"
                                                        value="Vehicle Recovery">
                                                    Vehicle Recovery
                                                </label>
                                            </div>

                                            <div class="col-md-4">
                                                <label>
                                                    <input type="checkbox" name="service_categories[]"
                                                        value="Valet Service">
                                                    Valet Service
                                                </label>
                                            </div>

                                            <div class="col-md-4">
                                                <label>
                                                    <input type="checkbox" name="service_categories[]"
                                                        value="Bike Transporting Service">
                                                    Bike Transporting Service
                                                </label>
                                            </div>
                                            <div class="col-md-4">
                                                <label>
                                                    <input type="checkbox" name="service_categories[]"
                                                        value="Custom Fabrication">
                                                    Custom Fabrication
                                                </label>
                                            </div>

                                            <div class="col-md-4">
                                                <label>
                                                    <input type="checkbox" name="service_categories[]"
                                                        value="Custom Paint Service<">
                                                    Custom Paint Service
                                                </label>
                                            </div>
                                            <div class="col-md-4">
                                                <label>
                                                    <input type="checkbox" name="service_categories[]"
                                                        value="Bike Recovery Service">
                                                    Bike Recovery Service
                                                </label>
                                            </div>

                                            <div class="col-md-4">
                                                <label>
                                                    <input type="checkbox" name="service_categories[]"
                                                        value="Electrical">

                                                    Electrical
                                                </label>
                                            </div>


                                            <div class="col-md-4">
                                                <label>
                                                    <input type="checkbox" name="service_categories[]"
                                                        value="Tyre Fitting">
                                                    Tyre Fitting
                                                </label>
                                            </div>

                                            <div class="col-md-4">
                                                <label>
                                                    <input type="checkbox" name="service_categories[]"
                                                        value="Tyre Sales">
                                                    Tyre Fitting
                                                </label>
                                            </div>
                                            <div class="col-md-4">
                                                <label>
                                                    <input type="checkbox" name="service_categories[]"
                                                        value="Seats Upholstery">
                                                    Seats Upholstery
                                                </label>
                                            </div>

                                            <div class="col-md-4">
                                                <label>
                                                    <input type="checkbox" name="service_categories[]"
                                                        value="Mobile Mechanic<">
                                                    Mobile Mechanic
                                                </label>
                                            </div>

                                            <div class="col-md-4">
                                                <label>
                                                    <input type="checkbox" name="service_categories[]"
                                                        value="Accident Legal Advice">
                                                    Accident Legal Advice
                                                </label>
                                            </div>

                                            <div class="col-md-4">
                                                <label>
                                                    <input type="checkbox" name="service_categories[]"
                                                        value="Riding Lessons">
                                                    Riding Lessons
                                                </label>
                                            </div>

                                            <div class="col-md-4">
                                                <label>
                                                    <input type="checkbox" name="service_categories[]"
                                                        value="Stripped bolt removal">
                                                    Stripped bolt removal
                                                </label>
                                            </div>

                                            <div class="col-md-4">
                                                <label>
                                                    <input type="checkbox" name="service_categories[]"
                                                        value="Harley - Davidson Rentals">
                                                    Harley - Davidson Rentals
                                                </label>
                                            </div>
                                            <div class="col-md-4">
                                                <label>
                                                    <input type="checkbox" name="service_categories[]"
                                                        value="Engine Rebuild Service ,  Restoration">
                                                    Engine Rebuild Service ,  Restoration
                                                </label>
                                            </div>

                                            



                                        </label>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="wcmp-action-container">
                    <button class="btn btn-default" type="submit" name="save_distributor">Save Changes</button>
                    <div class="clear"></div>
                </div>
        </form>
    </div>



    </form>
</div>
</div>