<?php
$user = stm_get_user_custom_fields('');
$user_id = $user['user_id'];

//echo "123";
$placedata = trim(get_user_meta($user_id,'place_categories',true),',');
//echo "<pre>"; print_r(get_user_meta($user_id,'place_categories',true)); echo "</pre><br>";

if( !empty($placedata) && !is_array($placedata) ){
	//echo "tttt";
    $placedata = explode(",", $placedata);
	//echo "<pre>"; print_r($placedata); echo "</pre>";
    update_user_meta($user_id, 'place_categories', $placedata);
}
//$services = get_user_meta($user_id, 'business_category', true);
//$servicesarray = json_decode($services, true);
$allservice = get_terms( array(
        'taxonomy' => 'place-categories',
        'hide_empty' => false,
    ) );


//echo "+++<pre>"; print_r($_POST); echo "</pre><br>";
// die();

//if(isset($_POST['place_categories'])) {
if( isset($_POST['save_place']) && $_POST['save_place'] == 1 ){	
				
	if( isset($_POST['place_categories']) ){	
		$service_data = $_POST['place_categories'];
		update_user_meta($user_id, 'place_categories', $service_data);
	}else{		
		update_user_meta($user_id, 'place_categories', '');
	}
}
$placedata = get_user_meta($user_id,'place_categories',true);


//$services = get_user_meta($user_id, 'business_category', true);
//$servicesarray = json_decode($services, true);
$allthings = get_terms( array(
        'taxonomy' => 'things_to_do',
        'hide_empty' => false,
    ) );



//if (isset($_POST['things'])) {
if( isset($_POST['save_place']) ){  
    
    if( isset($_POST['things']) ){ $service_data = $_POST['things']; }else{ $service_data = ""; }
    
    update_user_meta($user_id, 'things_to_do', $service_data);
}

$allthingsdata = get_user_meta($user_id,'things_to_do',true);

?>

<div class="content-padding gray-bkg vendor-policies">
    <div class="notice-wrapper">
    </div>
    <div class="row">

        <form action="<?php echo esc_url(add_query_arg(array('page' => 'place_settings'), stm_get_author_link(''))); ?>"
            method="post" enctype="multipart/form-data" id="stm_user_settings_edit"
            class="stm_save_user_settings_ajax author-form col-md-12">
            <div class="col-md-12">
                <!-- <form method="post" name="shop_settings_form" class="wcmp_policy_form form-horizontal"> -->

                <div class="panel panel-default pannel-outer-heading">
                    <div class="panel-heading d-flex">
                        <h2>Place Categories</h2>
                    </div>
                    <div class="panel-body panel-content-padding">
                        <div class="form-group d-flex align-items-center mb-0">
                            <!--<label class="control-label col-sm-2 mb-0">Categories</label> -->
                            <div class="col-md-12 col-sm-12">

                                <div class="row align-items-center">
                                    <div class="col-md-12">
									
										<?php foreach ($allservice as $key => $place) { ?>
											<div class="col-md-4">
												<label>
													<input type="checkbox" name="place_categories[]" value="<?php echo $place->term_id; ?>" <?php if (in_array($place->term_id, $placedata)) { echo "checked='checked'"; } ?>>
														<?php echo $place->name; ?>
												</label>
											</div>
										<?php } ?>
									
                                    </div>

                                </div>
                            </div>
                        </div>
						<input type="hidden" name="save_place" value="1">
                    </div>
                </div>

                <div class="panel panel-default pannel-outer-heading">
                    <div class="panel-heading d-flex">
                        <h2>Things To Do</h2>
                    </div>
                    <div class="panel-body panel-content-padding">
                        <div class="form-group d-flex align-items-center mb-0">
                          <!--  <label class="control-label col-sm-2 mb-0">Categories</label> -->
                            <div class="col-md-12 col-sm-12">

                                <div class="row align-items-center">
                                    <div class="col-md-12">
                                    
                                        <?php foreach ($allthings as $key => $thing) { ?>
                                            <div class="col-md-4">
                                                <label>
                                                    <input type="checkbox" name="things[]" value="<?php echo $thing->term_id; ?>" <?php if (in_array($thing->term_id, $allthingsdata)) { echo "checked='checked'"; } ?>>
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
                    <button class="btn btn-default" type="submit">Save Changes</button>
                    <div class="clear"></div>
                </div>
        </form>
    </div>



    </form>
</div>
</div>