<?php
/**
 *
 * Get times as option-list.
 *
 * @return string List of times
 */
function get_times ($default = '19:00', $interval = '+15 minutes') {

    $output = '';

    $current = strtotime('00:00');
    $end = strtotime('23:59');

    while ($current <= $end) {
        $time = date('g:i a', $current);

        $sel = ($time == $default) ? ' selected' : '';

        $output .= "<option value=\"{$time}\"{$sel}>" . date('h.i A
        	', $current) .'</option>';
        $current = strtotime($interval, $current);
    }

    return $output;
}


if (!is_user_logged_in())
{
    die('You are not logged in');
}
else
{

	$hours  = array("00","01","02","03","04","05","06","07","08","09",10,11,12,13,14,15,16,17,18,19,20,21,22,23);
	$mins = array("00",15,30,45);
    $got_error_validation = false;
    $data_saved = false;
    $error_msg = esc_html__('Error, try again', 'motors');

    $user_current = wp_get_current_user();
    $user_id = $user_current->ID;
    $user = stm_get_user_custom_fields($user_id);
    $user = stm_get_user_custom_fields($user_id);
    $user['stm_user_instagram'] = get_user_meta($user_id, 'stm_user_instagram', true);
    $wsl = get_user_meta($user_id, 'wsl_current_provider', true);
    $location_address2 = get_user_meta($user_id, 'billing_address_2', true);
    $user['sunday_to'] = get_user_meta($user_id, 'sunday_to', true);
	$user['sunday_from'] = get_user_meta($user_id, 'sunday_from', true);
	
	$user['saturday_to'] = get_user_meta($user_id, 'saturday_to', true);
	$user['saturday_from'] = get_user_meta($user_id, 'saturday_from', true);
	
	$user['working_saturday'] = get_user_meta($user_id, 'working_saturday', true);
	$user['working_sunday'] = get_user_meta($user_id, 'working_sunday', true);

	$user['weekday_from'] = get_user_meta($user_id, 'weekday_from', true);
	$user['weekday_to'] = get_user_meta($user_id, 'weekday_to', true);

	$user['working_friday'] = get_user_meta($user_id, 'working_friday', true);
	$user['working_thursday'] = get_user_meta($user_id, 'working_thursday', true);
	$user['working_wednesday'] = get_user_meta($user_id, 'working_wednesday', true);
	$user['working_thesday'] = get_user_meta($user_id, 'working_thesday', true);
	$user['working_monday'] = get_user_meta($user_id, 'working_monday', true);

	$user['trade_in_facilities'] = get_user_meta($user_id, 'trade_in_facilities', true);
	$user['house_financing'] = get_user_meta($user_id, 'house_financing', true);
	$user['is_warranty'] = get_user_meta($user_id, 'is_warranty', true);
	$user['HD_Main_dealer'] = get_user_meta($user_id, 'HD_Main_dealer', true);
	$user['business_type'] = get_user_meta($user_id, 'business_type', true);
	
	$user['location_lat'] = get_user_meta($user_id, 'stm_dealer_location_lat', true);
	$user['location_lng'] = get_user_meta($user_id, 'stm_dealer_location_lng', true);

	

	

	$user['Warranty_Type'] = get_user_meta($user_id, 'Warranty_Type', true);
	$Warranty_Type = explode(",", $user['Warranty_Type']);

	if(in_array("Mechanical", $Warranty_Type)){
		$Mechanical= true;

	}
	if(in_array("Parts and labour", $warranty_type)){
		$parts= true;
	}
	
    $user['location_address2'] = $location_address2;

    /*Get current editing values*/
    $user_first_name = (isset($_POST['stm_first_name'])) ? $_POST['stm_first_name'] : $user['name'];
    $user_last_name = (isset($_POST['stm_first_name'])) ? $_POST['stm_last_name'] : $user['last_name'];
    $user_phone = (!empty($_POST['stm_phone'])) ? $_POST['stm_phone'] : $user['phone'];
    $user_mail = (!empty($_POST['stm_email'])) ? $_POST['stm_email'] : $user['email'];
    $user_mail = sanitize_email($user_mail);

    
	if (empty($_POST['stm_confirm_password']))
    {
	    /*Dealer*/
	    $company_name = (!empty($_POST['stm_company_name'])) ? $_POST['stm_company_name'] : $user['stm_company_name'];
	    $stm_website_url = (!empty($_POST['stm_website_url'])) ? $_POST['stm_website_url'] : $user['website'];
	    $license = (!empty($_POST['stm_licence'])) ? $_POST['stm_licence'] : $user['stm_company_license'];
	    $location = (!empty($_POST['stm_location'])) ? $_POST['stm_location'] : $user['location'];
	    $location_address2 = (!empty($_POST['location_address2'])) ? $_POST['location_address2'] : $user['location_address2'];

	    $location_lat = (!empty($_POST['stm_lat'])) ? $_POST['stm_lat'] : $user['location_lat'];
	    $location_lng = (!empty($_POST['stm_lng'])) ? $_POST['stm_lng'] : $user['location_lng'];
	    $sales_hours = (!empty($_POST['stm_sales_hours'])) ? $_POST['stm_sales_hours'] : $user['stm_sales_hours'];
	    $notes = (!empty($_POST['stm_notes'])) ? $_POST['stm_notes'] : $user['stm_seller_notes'];
	    $stm_user_instagram = (!empty($_POST['stm_user_instagram'])) ? $_POST['stm_user_instagram'] : $user['stm_user_instagram'];

	    $sunday_to = (!empty($_POST['sunday_to'])) ? $_POST['sunday_to'] : $user['sunday_to'];
	    $sunday_to = (!empty($_POST['sunday_to'])) ? $_POST['sunday_to'] : $user['sunday_to'];
	    $sunday_from = (!empty($_POST['sunday_from'])) ? $_POST['sunday_from'] : $user['sunday_from'];
	    $saturday_to = (!empty($_POST['saturday_to'])) ? $_POST['saturday_to'] : $user['saturday_to'];
	    $saturday_from = (!empty($_POST['saturday_from'])) ? $_POST['saturday_from'] : $user['saturday_from'];
	    $working_saturday = (!empty($_POST['working_saturday'])) ? $_POST['working_saturday'] : $user['working_saturday'];
	    $working_sunday = (!empty($_POST['working_sunday'])) ? $_POST['working_sunday'] : $user['working_sunday'];
	    $weekday_from = (!empty($_POST['weekday_from'])) ? $_POST['weekday_from'] : $user['weekday_from'];
	    $weekday_to = (!empty($_POST['weekday_to'])) ? $_POST['weekday_to'] : $user['weekday_to'];
	    $working_friday = (!empty($_POST['working_friday'])) ? $_POST['working_friday'] : $user['working_friday'];
	    $working_thursday = (!empty($_POST['working_thursday'])) ? $_POST['working_thursday'] : $user['working_thursday'];
	    $working_wednesday = (!empty($_POST['working_wednesday'])) ? $_POST['working_wednesday'] : $user['working_wednesday'];
	    $working_thesday = (!empty($_POST['working_thesday'])) ? $_POST['working_thesday'] : $user['working_thesday'];
	    $working_monday = (!empty($_POST['working_monday'])) ? $_POST['working_monday'] : $user['working_monday'];
	    $trade_in_facilities = (!empty($_POST['trade_in_facilities'])) ? $_POST['trade_in_facilities'] : $user['trade_in_facilities'];
	    $house_financing = (!empty($_POST['house_financing'])) ? $_POST['house_financing'] : $user['house_financing'];
	    $Warranty_Type = (!empty($_POST['Warranty_Type'])) ? $_POST['Warranty_Type'] : $user['Warranty_Type'];
	    $is_warranty = (!empty($_POST['is_warranty'])) ? $_POST['is_warranty'] : $user['is_warranty'];
		
		
	    $HD_Main_dealer = $user['HD_Main_dealer'];
	    $business_type = $user['business_type'];
	    $trading_type = get_user_meta($user_id, 'trading_type', true);
	    $billing_city = get_user_meta($user_id, 'billing_city', true);
	    $billing_postal_code = get_user_meta($user_id, 'billing_postal_code', true);
	    $stm_video_url = get_user_meta($user_id, 'stm_video_url', true);
	    
	   

	}else{
		  /*Dealer*/
	    $company_name = $_POST['stm_company_name'];
	    $stm_website_url =$_POST['stm_website_url'];
	    $license = $_POST['stm_licence'];
	    $location = $_POST['stm_location'];
	    $location_address2 = $_POST['location_address2'];

	    $location_lat = $_POST['stm_lat'];
	    $location_lng = $_POST['stm_lng'];
	    $sales_hours = $_POST['stm_sales_hours'];
	    $notes = $_POST['stm_notes'];
	    $stm_user_instagram = $_POST['stm_user_instagram'];

	    $sunday_to = $_POST['sunday_to'];
	    $sunday_to = $_POST['sunday_to'];
	    $sunday_from = $_POST['sunday_from'];
	    $saturday_to = $_POST['saturday_to'] ;
	    $saturday_from = $_POST['saturday_from'];
	    $working_saturday = $_POST['working_saturday'];
	    $working_sunday = $_POST['working_sunday'];
	    $weekday_from = $_POST['weekday_from'];
	    $weekday_to = $_POST['weekday_to'];
	    $working_friday = $_POST['working_friday'];
	    $working_thursday = $_POST['working_thursday'];
	    $working_wednesday =  $_POST['working_wednesday'] ;
	    $working_thesday = $_POST['working_thesday'];
	    $working_monday =  $_POST['working_monday'];
	    $is_warranty = $_POST['is_warranty'];

	    $trade_in_facilities = $_POST['trade_in_facilities'];
	    $house_financing = $_POST['house_financing'];

	    $Warranty_Type = implode(",", $_POST['Warranty_Type']);

	    $HD_Main_dealer = $_POST['HD_Main_dealer'];
	    $business_type = $_POST['business_type'];
	    $trading_type = $_POST['trading_type'];
	    $billing_city = $_POST['billing_city'];
	    $billing_postal_code = $_POST['billing_postal_code'];
		$url      = "https://api.postcodes.io/postcodes/".$billing_postal_code;
		$ch       = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = json_decode(curl_exec($ch), true);
		curl_close($ch);
		
		$billing_country = $response["result"]["country"];
		$stm_video_url = $_POST['stm_video_url'];
	}
    
   /*Socials*/
    $socs = array(
        'facebook',
        'twitter',
        'linkedin',
        'youtube'
    );
    $socials = array();
    foreach ($socs as $soc)
    {
        if (empty($user['socials'][$soc]))
        {
            $user['socials'][$soc] = '';
        }
        $socials[$soc] = (!empty($_POST['stm_user_' . $soc])) ? $_POST['stm_user_' . $soc] : $user['socials'][$soc];
    }

    $socials['instagram'] = $stm_user_instagram;
    $show_email = '';
    if (!empty($user['show_mail']) and $user['show_mail'] == 'show')
    {
        $show_email = 'checked';
    }

    $password_check = false;
    if (!empty($_POST['stm_confirm_password']))
    {
        $password_check = wp_check_password($_POST['stm_confirm_password'], $user_current
            ->data->user_pass, $user_id);
    }

    if (!$password_check and !empty($_POST['stm_confirm_password']))
    {
        $got_error_validation = true;
        $error_msg = esc_html__('Confirmation password is wrong', 'motors');
    }

    $demo = stm_is_site_demo_mode();

    if ($password_check and !$demo)
    {

        if ($_POST['business_category'])
        {
            $servicedata = json_encode($_POST['business_category']);
            update_user_meta($user_id, 'business_category', $servicedata);
        }
		
		if ($_POST['service_parts']){
            $partdata = json_encode($_POST['service_parts']);
            update_user_meta( $user_id, 'service_parts', $partdata );
        }
		
        update_user_meta($user_id, 'stm_user_instagram', $stm_user_instagram);
        update_user_meta($user_id, 'billing_address_2', $location_address2);
        update_user_meta($user_id, 'sunday_to', $sunday_to);
        update_user_meta($user_id, 'sunday_from', $sunday_from);
        update_user_meta($user_id, 'saturday_to', $saturday_to);
        update_user_meta($user_id, 'saturday_from', $saturday_from);
        update_user_meta($user_id, 'working_saturday', $working_saturday);
        update_user_meta($user_id, 'working_sunday', $working_sunday);
        update_user_meta($user_id, 'weekday_from', $weekday_from);
        update_user_meta($user_id, 'weekday_to', $weekday_to);
        update_user_meta($user_id, 'working_friday', $working_friday);
        update_user_meta($user_id, 'working_thursday', $working_thursday);
        update_user_meta($user_id, 'working_wednesday', $working_wednesday);
        update_user_meta($user_id, 'working_thesday', $working_thesday);
        update_user_meta($user_id, 'working_monday', $working_monday);
        update_user_meta($user_id, 'trade_in_facilities', $trade_in_facilities);
        update_user_meta($user_id, 'house_financing', $house_financing);
        update_user_meta($user_id, 'Warranty_Type', $Warranty_Type);
        update_user_meta($user_id, 'is_warranty', $is_warranty);

		update_user_meta($user_id, 'HD_Main_dealer', $HD_Main_dealer);    
		update_user_meta($user_id, 'business_type', $business_type);        
		update_user_meta($user_id, 'trading_type', $trading_type);  
		update_user_meta($user_id, 'billing_city', $billing_city);  
		update_user_meta($user_id, 'billing_postal_code', $billing_postal_code);    
		update_user_meta($user_id, 'billing_country', $billing_country);    		
		update_user_meta($user_id, 'stm_video_url', $stm_video_url);        

        
        //Editing/adding user filled fields
        /*Image changing*/
        $allowed = array(
            'jpg',
            'jpeg',
            'png'
        );
        if (!empty($_FILES['stm-avatar']))
        {
            $file = $_FILES['stm-avatar'];
            if (is_array($file) and !empty($file['name']))
            {
                $ext = pathinfo($file['name']);
                $ext = $ext['extension'];
                if (in_array($ext, $allowed))
                {

                    $upload_dir = wp_upload_dir();
                    $upload_url = $upload_dir['url'];
                    $upload_path = $upload_dir['path'];

                    /*Upload full image*/
                    if (!function_exists('wp_handle_upload'))
                    {
                        require_once (ABSPATH . 'wp-admin/includes/file.php');
                    }
                    $original_file = wp_handle_upload($file, array(
                        'test_form' => false
                    ));

                    if (!is_wp_error($original_file))
                    {
                        $image_user = $original_file['file'];
                        /*Crop image to square from full image*/
                        $image_cropped = image_make_intermediate_size($image_user, 236, 60, true);

                        /*Delete full image*/
                        if (file_exists($image_user))
                        {
                            unlink($image_user);
                        }

                        /*Get path and url of cropped image*/
                        $user_new_image_url = $upload_url . '/' . $image_cropped['file'];
                        $user_new_image_path = $upload_path . '/' . $image_cropped['file'];

                        /*Delete from site old avatar*/

                        $user_old_avatar = get_the_author_meta('stm_dealer_logo_path', $user_id);
                        if (!empty($user_old_avatar) and $user_new_image_path != $user_old_avatar and file_exists($user_old_avatar))
                        {

                            /*Check if prev avatar exists in another users except current user*/
                            $args = array(
                                'meta_key' => 'stm_dealer_logo_path',
                                'meta_value' => $user_old_avatar,
                                'meta_compare' => '=',
                                'exclude' => array(
                                    $user_id
                                ) ,
                            );
                            $users_db = get_users($args);
                            if (empty($users_db))
                            {
                                unlink($user_old_avatar);
                            }
                        }

                        /*Set new image tmp*/
                        $user['image'] = $user_new_image_url;

                        /*Update user meta path and url image*/
                        update_user_meta($user_id, 'stm_dealer_logo', $user_new_image_url);
                        update_user_meta($user_id, 'stm_dealer_logo_path', $user_new_image_path);

?>
						<script>
							jQuery(document).ready(function () {
								jQuery('.stm-user-avatar').html('<img src="<?php echo esc_url($user_new_image_url); ?>" class="img-avatar img-responsive">');
							})
						</script>
						<?php
                    }

                }
                else
                {
                    $got_error_validation = true;
                    $error_msg = esc_html__('Please load image with right extension (jpg, jpeg, png)', 'motors');
                }
            }
        }

        /*Dealer image*/
        if (!empty($_FILES['stm-dealer-image']))
        {
            $file = $_FILES['stm-dealer-image'];
            if (is_array($file) and !empty($file['name']))
            {
                $ext = pathinfo($file['name']);
                $ext = $ext['extension'];
                if (in_array($ext, $allowed))
                {

                    $upload_dir = wp_upload_dir();
                    $upload_url = $upload_dir['url'];
                    $upload_path = $upload_dir['path'];

                    /*Upload full image*/
                    if (!function_exists('wp_handle_upload'))
                    {
                        require_once (ABSPATH . 'wp-admin/includes/file.php');
                    }
                    $original_file = wp_handle_upload($file, array(
                        'test_form' => false
                    ));

                    if (!is_wp_error($original_file))
                    {
                        $image_user = $original_file['file'];
                        /*Crop image to square from full image*/
                        $image_cropped = image_make_intermediate_size($image_user, 500, 282, true);

                        $proceed = true;
                        if (!$image_cropped)
                        {
                            $proceed = false;
                            $got_error_validation = true;
                            $error_msg = esc_html__('Seems like image too small, please load image with minimal dimensions 500x282', 'motors');
                        }

                        if ($proceed)
                        {
                            /*Delete full image*/
                            if (file_exists($image_user))
                            {
                                unlink($image_user);
                            }

                            /*Get path and url of cropped image*/
                            $user_new_image_url = $upload_url . '/' . $image_cropped['file'];
                            $user_new_image_path = $upload_path . '/' . $image_cropped['file'];

                            /*Delete from site old avatar*/

                            $user_old_avatar = get_the_author_meta('stm_dealer_image_path', $user_id);
                            if (!empty($user_old_avatar) and $user_new_image_path != $user_old_avatar and file_exists($user_old_avatar))
                            {

                                /*Check if prev avatar exists in another users except current user*/
                                $args = array(
                                    'meta_key' => 'stm_dealer_image_path',
                                    'meta_value' => $user_old_avatar,
                                    'meta_compare' => '=',
                                    'exclude' => array(
                                        $user_id
                                    ) ,
                                );
                                $users_db = get_users($args);
                                if (empty($users_db))
                                {
                                    unlink($user_old_avatar);
                                }
                            }

                            /*Set new image tmp*/
                            $user['image'] = $user_new_image_url;

                            /*Update user meta path and url image*/
                            update_user_meta($user_id, 'stm_dealer_image', $user_new_image_url);
                            update_user_meta($user_id, 'stm_dealer_image_path', $user_new_image_path);
                        }

?>
						<?php
                    }

                }
                else
                {
                    $got_error_validation = true;
                    $error_msg = esc_html__('Please load image with right extension (jpg, jpeg, png)', 'motors');
                }
            }
        }
		
		$dealer_hidden_images = '';
		if(!empty($_POST['stm_dealer_hidden_images'])){
			$arrs = explode("," ,$_POST['stm_dealer_hidden_images']);
			foreach($arrs as $arr){
				$attach_url = wp_get_attachment_url( $arr );
				if($attach_url){
					$dealer_hidden_images .= ','.$attach_url;
				}else{
					$dealer_hidden_images .= ','.$arr;
				}
			}
			update_user_meta($user_id, 'stm_dealer_hidden_images', ltrim($dealer_hidden_images , ','));
		}

        if (empty($_FILES['stm-avatar']['name']))
        {
            if (!empty($_POST['stm_remove_dealer_logo']) and $_POST['stm_remove_dealer_logo'] == 'delete')
            {
                $user_old_avatar = get_the_author_meta('stm_dealer_logo_path', $user_id);
                /*Check if prev avatar exists in another users except current user*/
                $args = array(
                    'meta_key' => 'stm_dealer_logo_path',
                    'meta_value' => $user_old_avatar,
                    'meta_compare' => '=',
                    'exclude' => array(
                        $user_id
                    ) ,
                );
                $users_db = get_users($args);
                if (empty($users_db))
                {
                    unlink($user_old_avatar);
                }
                update_user_meta($user_id, 'stm_dealer_logo', '');
                update_user_meta($user_id, 'stm_dealer_logo_path', '');

                $user['image'] = '';
            }
        }

        if (empty($_FILES['stm-dealer-image']['name']))
        {
            if (!empty($_POST['stm_remove_dealer_img']) and $_POST['stm_remove_dealer_img'] == 'delete')
            {
                $user_old_avatar = get_the_author_meta('stm_dealer_image_path', $user_id);
                /*Check if prev avatar exists in another users except current user*/
                $args = array(
                    'meta_key' => 'stm_dealer_image_path',
                    'meta_value' => $user_old_avatar,
                    'meta_compare' => '=',
                    'exclude' => array(
                        $user_id
                    ) ,
                );
                $users_db = get_users($args);
                if (empty($users_db))
                {
                    unlink($user_old_avatar);
                }
                update_user_meta($user_id, 'stm_dealer_image', '');
                update_user_meta($user_id, 'stm_dealer_image_path', '');

                $user['image'] = '';
            }
        }

        /*Change email*/
        $new_user_data = array(
            'ID' => $user_id,
            'user_email' => $user_mail
        );

        /*Change email visiblity*/
        if (!empty($_POST['stm_show_mail']) and $_POST['stm_show_mail'] == 'on')
        {
            update_user_meta($user_id, 'stm_show_email', 'show');
        }
        else
        {
            update_user_meta($user_id, 'stm_show_email', '');
        }

        if (!empty($_POST['stm_new_password']) and !empty($_POST['stm_new_password_confirm']))
        {
            if ($_POST['stm_new_password_confirm'] == $_POST['stm_new_password'])
            {
                $new_user_data['user_pass'] = esc_attr($_POST['stm_new_password']);
            }
            else
            {
                $got_error_validation = true;
                $error_msg = esc_html__('New password not saved, because of wrong confirmation.', 'motors');
            }
        }

        $user_error = wp_update_user($new_user_data);
        if (is_wp_error($user_error))
        {
            $got_error_validation = true;
            $error_msg = $user_error->get_error_message();
            $user_mail = $user['email'];
        }

        /*Change fields with secondary privilegy*/
        /*POST key => user_meta_key*/
        $changed_info = array(
            'stm_first_name' => 'first_name',
            'stm_last_name' => 'last_name',
            'stm_phone' => 'stm_phone',
            'stm_user_facebook' => 'stm_user_facebook',
            'stm_user_twitter' => 'stm_user_twitter',
            'stm_user_linkedin' => 'stm_user_linkedin',
            'stm_user_youtube' => 'stm_user_youtube',
        );

        foreach ($changed_info as $change_to_key => $change_info)
        {
            if (isset($_POST[$change_to_key]))
            {
                $escaped_value = esc_attr($_POST[$change_to_key]);

                update_user_meta($user_id, $change_info, $escaped_value);
            }
        }

        /*Change socials*/
        foreach ($socs as $soc)
        {
            if (!empty($_POST['stm_user_' . $soc]))
            {
                $escaped_value = esc_attr($_POST['stm_user_' . $soc]);

                update_user_meta($user_id, 'stm_user_' . $soc, $escaped_value);
            }
        }

        /*Saving company name*/
        if (!empty($_POST['stm_company_name']))
        {
            update_user_meta($user_id, 'stm_company_name', sanitize_text_field($_POST['stm_company_name']));
        }

        /*Saving company license*/
        if (!empty($_POST['stm_licence']))
        {
            update_user_meta($user_id, 'stm_company_license', sanitize_text_field($_POST['stm_licence']));
        }

        /*Saving website URL*/
        if (!empty($_POST['stm_website_url']))
        {
            update_user_meta($user_id, 'stm_website_url', esc_url($_POST['stm_website_url']));
        }

        /*Location*/
        if (!empty($_POST['stm_location']))
        {
            update_user_meta($user_id, 'stm_dealer_location', sanitize_text_field($_POST['stm_location']));
            if (!empty($_POST['stm_lat']))
            {
                update_user_meta($user_id, 'stm_dealer_location_lat', floatval($_POST['stm_lat']));
            }
            if (!empty($_POST['stm_lng']))
            {
                update_user_meta($user_id, 'stm_dealer_location_lng', floatval($_POST['stm_lng']));
            }
        }

        if (isset($_POST['stm_sales_hours']))
        {
            update_user_meta($user_id, 'stm_sales_hours', sanitize_text_field($_POST['stm_sales_hours']));
        }

        if (!empty($_POST['stm_notes']))
        {
            update_user_meta($user_id, 'stm_seller_notes', sanitize_text_field($_POST['stm_notes']));
        }

        if (!$got_error_validation)
        {
            $data_saved = true;
            $error_msg = esc_html__('Account data saved. Reloading the page.', 'motors'); ?>
			<script>
				window.location.href = window.location.href
			</script>
			<?php
        }

    }
    else
    {
        if ($demo)
        {
            $error_msg = esc_html__('Site is on demo mode', 'motors');
            $got_error_validation = true;
        }
    }
}
?>

<div class="stm-user-private-settings-wrapper stm-dealer-private-settings-unit">
	<?php if ($got_error_validation): ?>
		<div class="stm-alert alert alert-danger"><?php echo stm_do_lmth($error_msg); ?></div>
	<?php
endif; ?>

	<?php if ($data_saved): ?>
		<div class="stm-alert alert alert-success"><?php echo stm_do_lmth($error_msg); ?></div>
	<?php
endif; ?>


	<h4 class="stm-seller-title"><?php esc_html_e('Profile Settings', 'motors'); ?></h4>

	<div class="stm-my-profile-settings cssssssss">
		<form action="<?php echo esc_url(add_query_arg(array(
    'page' => 'settings'
) , stm_get_author_link(''))); ?>" method="post" enctype="multipart/form-data" id="stm_user_settings_edit">

			

				

					

					<!--Main information-->
					<div class="stm-change-block">
						<div class="title">
							<div class="heading-font"><?php esc_html_e('Main Information', 'motors'); ?></div>
						</div>
						<div class="main-info-settings">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<div class="stm-label h4"><?php esc_html_e('Company Website URL', 'motors'); ?></div>
										<input type="text" name="stm_website_url" value="<?php echo esc_attr($stm_website_url); ?>" placeholder="<?php esc_attr_e('Enter Website URL', 'motors') ?>" />
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<div class="stm-label h4"><?php esc_html_e('First name', 'motors'); ?></div>
										<input type="text" name="stm_first_name" value="<?php echo esc_attr($user_first_name); ?>" placeholder="<?php esc_attr_e('Enter First Name', 'motors') ?>" />
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<div class="stm-label h4"><?php esc_html_e('Last name', 'motors'); ?></div>
										<input type="text" name="stm_last_name" value="<?php echo esc_attr($user_last_name); ?>" placeholder="<?php esc_attr_e('Enter Last Name', 'motors'); ?>"/>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<div class="stm-label h4"><?php esc_html_e('Phone', 'motors'); ?></div>
										<input type="text" name="stm_phone" value="<?php echo esc_attr($user_phone); ?>" placeholder="<?php esc_attr_e('Enter Phone', 'motors'); ?>"/>
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<div class="stm-label h4"><?php esc_html_e('Email*', 'motors'); ?></div>
										<input type="email" name="stm_email" value="<?php echo esc_attr($user_mail); ?>" placeholder="<?php esc_attr_e('Enter E-mail', 'motors'); ?>" required/>
										<label>
											<input type="checkbox" name="stm_show_mail" <?php echo stm_do_lmth($show_email); ?>/>
											<span><?php esc_html_e('Show Email Address on my Profile', 'motors'); ?></span>
										</label>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="stm-change-block">
						<div class="title">
							<div class="heading-font"><?php esc_html_e('Dealer Information', 'motors'); ?></div>
						</div>
						<div class="main-info-settings">
							<div class="row">
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<div class="stm-label h4"><?php esc_html_e('Company name*', 'motors'); ?></div>
										<input type="text" name="stm_company_name"
										value="<?php echo esc_attr($company_name); ?>"
										placeholder="<?php esc_attr_e('Enter Company Name', 'motors') ?>"
										required/>
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<div class="stm-label h4"><?php esc_html_e('License number*', 'motors'); ?></div>
										<input type="text" name="stm_licence" value="<?php echo esc_attr($license); ?>"
										placeholder="<?php esc_attr_e('Enter License number', 'motors'); ?>" />
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<div class="stm-label h4"><?php esc_html_e('Address 1', 'motors'); ?></div>
										<div class="stm-location-search-unit">
											<input type="text" id="stm_google_user_location_entry" name="stm_location"
											value="<?php echo esc_attr($location); ?>"
											placeholder="<?php esc_attr_e('Enter Your Address', 'motors'); ?>"
											required/>
											<input type="hidden" name="stm_lat"
											value="<?php echo esc_attr($location_lat); ?>"/>
											<input type="hidden" name="stm_lng"
											value="<?php echo esc_attr($location_lng); ?>"/>
										</div>
									</div>
								</div>

								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<div class="stm-label h4"><?php esc_html_e('Address 2', 'motors'); ?></div>
										<div class="stm-location-search-unit">
											<input type="text" id="stm_google_user_location_entry_adddress2" name="location_address2"
											value="<?php echo esc_attr($location_address2); ?>"
											placeholder="<?php esc_attr_e('Enter Your Address 1', 'motors'); ?>"
											/>
										</div>
									</div>
								</div>
								
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<div class="stm-label h4"><?php esc_html_e('City', 'motors'); ?></div>
										<div class="stm-location-search-unit">
											<input type="text" id="stm_google_user_location_entry_city" name="billing_city"
											value="<?php echo esc_attr($billing_city); ?>"
											placeholder="<?php esc_attr_e('Enter Your City', 'motors'); ?>"
											/>
											
										</div>
									</div>
								</div>

								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<div class="stm-label h4"><?php esc_html_e('Postal Code', 'motors'); ?></div>
										<div class="stm-location-search-unit">
											<input type="text" id="stm_google_user_location_entry_postal_code" name="billing_postal_code"
											value="<?php echo esc_attr($billing_postal_code); ?>"
											placeholder="<?php esc_attr_e('Enter Your Postal Code', 'motors'); ?>"
											required/>
										</div>
									</div>
								</div>
								
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<div class="stm-label h4"><?php esc_html_e('Description of your dealership / business', 'motors'); ?></div>
										<textarea name="stm_notes"><?php echo esc_attr($notes); ?></textarea>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<div class="stm-label h4"><?php esc_html_e('What type of business are you?', 'motors'); ?></div>
										<div class="row">
											<div class="col-md-6">
												
												<input id="limited_company" type="radio" name="business_type" <?php if($business_type == "Limited Company") { echo "checked"; } ?> value="Limited Company" >
												<label for="limited_company">
													<span for="limited_company">Limited Company</span>
												</label>
											</div>
											<div class="col-md-6">
												
												<input id="sole_proprietor" type="radio" name="business_type" <?php if($business_type == "Sole proprietor") { echo "checked"; } ?> value="Sole proprietor">
												<label for="sole_proprietor">
													<span>Sole proprietor</span>
												</label>
											</div>   
										</div>    
									</div>

								</div>
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<div class="stm-label h4"><?php esc_html_e('How long have you been trading?', 'motors'); ?></div>
										<select class="add_a_car-select select2-hidden-accessible" id="trading_type" data-class="stm_select_overflowed" name="trading_type" tabindex="-1" aria-hidden="true">
											<option value="" selected="selected">Select Year</option>
											<?php 
												 // Sets the top option to be the current year. (IE. the option that is chosen by default).
												  $currently_selected = $trading_type; 
												  
												  // Year to start available options at
												  $earliest_year = 1990; 
												  // Set your latest year you want in the range, in this case we use PHP to just set it to the current year.
												  $latest_year = date('Y'); 

												  
												  // Loops over each int[year] from current year, back to the $earliest_year [1950]
												  foreach ( range( $latest_year, $earliest_year ) as $i ) {
												    // Prints the option with the next year in range.
												    print '<option value="'.$i.'"'.($i == $currently_selected ? ' selected="selected"' : '').'>'.$i.'</option>';
												  }
											?>
											
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<div class="stm-label h4"><?php esc_html_e('Are you a Harley Davidson Main dealer?', 'motors'); ?></div>
										<div class="row">
											<div class="col-md-6">
												
												<input id="main_dealer_yes" type="radio" name="HD_Main_dealer" <?php if($HD_Main_dealer == "Yes") { echo "checked"; } ?> value="Yes" >
												<label for="main_dealer_yes">
													<span >Yes</span>
												</label>
											</div>
											<div class="col-md-6">
												
												<input id="main_dealer_no" type="radio" name="HD_Main_dealer" <?php if($HD_Main_dealer == "No") { echo "checked"; } ?> value="No">
												<label for="main_dealer_no">
													<span>No</span>
												</label>
											</div> 
										</div>      
									</div>

								</div>
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<div class="stm-label h4"><?php esc_html_e('Do you provide a warranty for all motorcycles you sell?', 'motors'); ?></div>
										<div class="row">
											<div class="col-md-6">
												
												<input id="warranty_yes" type="radio" name="is_warranty"   <?php if($is_warranty == "Yes") { echo "checked"; } ?> value="Yes" >
												<label for="warranty_yes">
													<span >Yes</span>
												</label>
											</div>
											<div class="col-md-6">
												
												<input id="warranty_no" type="radio" name="is_warranty"  <?php if($is_warranty == "No") { echo "checked"; } ?>  value="No">
												<label for="warranty_no">
													<span>No</span>
												</label>
											</div>  
										</div>     
									</div>

								</div>
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										
										<div class="stm-label h4"><?php esc_html_e('Warranty Type', 'motors'); ?></div>
										<div class="row">
											<div class="col-md-6">
												<label>
													<input type="checkbox" name="warranty_type" <?php if($Mechanical) { echo "checked"; } ?> value='Mechanical' />
													<span>Mechanical</span>
												</label>
											</div>
											<div class="col-md-6">
												<label>
													<input type="checkbox" name="warranty_type" <?php if($parts) { echo "checked"; } ?> value='Parts and labour'/>
													<span>Parts and labour</span>
												</label>
												
												
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<div class="stm-label h4"><?php esc_html_e('Do you provide trade in facilities?', 'motors'); ?></div>
										<div class="row">
											<div class="col-md-6">
												
												<input id="trade_in_yes" type="radio" <?php if($trade_in_facilities == "Yes") { echo "checked"; } ?> name="trade_in_facilities" value="Yes" >
												<label for="trade_in_yes">
													<span >Yes</span>
												</label>
											</div>
											<div class="col-md-6">
												
												<input id="trade_in_no" type="radio" <?php if($trade_in_facilities == "No") { echo "checked"; } ?> name="trade_in_facilities" value="No">
												<label for="trade_in_no">
													<span>No</span>
												</label>
											</div>   
										</div>    
									</div>

								</div>

								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<div class="row">
											<div class="stm-label h4"><?php esc_html_e('Do you provide in house financing?', 'motors'); ?></div>
											<div class="col-md-6">
												
												<input id="house_financing_yes" type="radio" <?php if($house_financing == "Yes") { echo "checked"; } ?> name="house_financing" value="Yes" >
												<label for="house_financing_yes">
													<span >Yes</span>
												</label>
											</div>
											<div class="col-md-6">
												
												<input id="house_financing_no" type="radio" <?php if($house_financing == "No") { echo "checked"; }?>  name="house_financing" value="No">
												<label for="house_financing_no">
													<span>No</span>
												</label>
											</div>       
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--Main information-->
					<div class="stm-change-block">
						<div class="title">
							<div class="heading-font"><?php esc_html_e('Trading Hours', 'motors'); ?></div>
						</div>
						<div class="main-info-settings">
							<div class="row">
								<div class="col-md-12 col-sm-12">
									<div class="form-group">
										
										<div class="stm-label h4"><?php esc_html_e('Week Days', 'motors'); ?></div>
										<div class="row">
											<div class="col-md-2">
												<label>
													<input type="checkbox" name="working_monday" value='Monday' <?php if ($working_monday)
{
    echo " checked ";
} ?>/>
													<span>Monday</span>
												</label>
											</div>
											<div class="col-md-2">
												<label>
													<input type="checkbox" name="working_thesday" value='Tuesday'  <?php if ($working_thesday)
	{
    echo " checked ";
} ?>/>
													<span> Tuesday</span>
												</label>
											</div>
											<div class="col-md-2">
												<label>
													<input type="checkbox" name="working_wednesday" value='Wednesday'  <?php if ($working_wednesday)
{
    echo " checked ";
} ?>/>
													<span> Wednesday</span>
												</label>
											</div>
											<div class="col-md-2">
												<label>
													<input type="checkbox" name="working_thursday" value='Thursday'  <?php if ($working_thursday)
{
    echo " checked ";
} ?>/>
													<span> Thursday</span>
												</label>
											</div>
											<div class="col-md-2">
												<label>
													<input type="checkbox" name="working_friday" <?php if($working_friday) { echo "checked"; } ?> value='Friday'  <?php if ($Friday)
{
    echo " checked ";
} ?>/>
													<span> Friday</span>
												</label>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<div class="stm-label h4"><?php esc_html_e('From', 'motors'); ?></div>
										<select name="weekday_from" id="input_2_48" class="medium gfield_select select2-hidden-accessible" aria-invalid="false" tabindex="-1" aria-hidden="true">
											
											<?php
											echo get_times($weekday_from);
									        ?>
										</select>
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<div class="stm-label h4"><?php esc_html_e('To', 'motors'); ?></div>
										<select name="weekday_to" id="input_2_48" class="medium gfield_select select2-hidden-accessible" aria-invalid="false" tabindex="-1" aria-hidden="true">
											<?php
											echo get_times($weekday_to);
									        ?>
										</select>

									</div>
								</div>
								
							</div>
							<div class="row">
								<div class="col-md-12 col-sm-12">
									<div class="form-group">
										
										<div class="stm-label h4"><?php esc_html_e('Weekend Days', 'motors'); ?></div>
										<div class="row">
											<div class="col-md-6">
												<label>
													<input type="checkbox" name="working_saturday"  <?php if($working_saturday) { echo "checked"; } ?> value='Saturday' />
													<span>Saturday</span>
												</label>
											</div>
											
										</div>
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<div class="stm-label h4"><?php esc_html_e('From', 'motors'); ?></div>
										<select name="saturday_from" id="input_2_48" class="medium gfield_select select2-hidden-accessible" aria-invalid="false" tabindex="-1" aria-hidden="true">
											<?php
											echo get_times($saturday_from);
									        ?>

										</select>
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<div class="stm-label h4"><?php esc_html_e('To', 'motors'); ?></div>
										<select name="saturday_to" id="input_2_48" class="medium gfield_select select2-hidden-accessible" aria-invalid="false" tabindex="-1" aria-hidden="true">
											<?php
											echo get_times($saturday_to);
									        ?>

										</select>

									</div>
								</div>
								<div class="col-md-12 col-sm-12">
									<div class="form-group">
										
										<div class="row">
											<div class="col-md-6">
												<label>
													<input type="checkbox" name="working_sunday" <?php if($working_sunday) { echo "checked"; } ?> value='Sunday' />
													<span>Sunday</span>
												</label>
											</div>
										</div>
									</div>
								</div>

								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<div class="stm-label h4"><?php esc_html_e('From', 'motors'); ?></div>
										<select name="sunday_from" id="input_2_48" class="medium gfield_select select2-hidden-accessible" aria-invalid="false" tabindex="-1" aria-hidden="true">
											
											<?php
											echo get_times($sunday_from);
									        ?>
										</select>
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<div class="stm-label h4"><?php esc_html_e('To', 'motors'); ?></div>
										<select name="sunday_to" id="input_2_48" class="medium gfield_select select2-hidden-accessible" aria-invalid="false" tabindex="-1" aria-hidden="true">
											<?php
											echo get_times($sunday_to);
									        ?>
											</select>

									</div>
								</div>
							</div>
							<?php
$services = get_user_meta($user_id, 'business_category', true);
$dealer_user_type = get_user_meta($user_id, 'dealer_user_type', true);
if ($dealer_user_type == 'dealer_service_provider' || $dealer_user_type == 'service_provider')
{
?>
							</div>
						</div>
						<!--Main information-->
						<div class="stm-change-block">
							<div class="title">
								<div class="heading-font"><?php esc_html_e('Service Provider Information', 'motors'); ?></div>
							</div>
							<div class="main-info-settings">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<div class="stm-label h4"><?php esc_html_e('Service Categories', 'motors'); ?></div>
											<?php

												$allservice = array();

												$allservice['mot'] = "MOT";
												$allservice['service_and_repairs'] = "Service and Repairs";
												$allservice['custom_parts_fitting'] = "Custom Parts Fitting";
												$allservice['vehicle_recovery'] = "Vehicle Recovery";
												$allservice['bike_transporting_service'] = "Bike Transporting Service";
												$allservice['custom_fabrication'] = "Custom Fabrication";
												$allservice['custom_paint_service'] = "Custom Paint Service";
												$allservice['valet_service'] = "Valet Service";
												$allservice['bike_recovery_service'] = "Bike Recovery Service";
												$allservice['custom_fabrication'] = "MOT";
												$allservice['electrical'] = "Electrical";
												$allservice['tyre_fitting'] = "Tyre Fitting";
												$allservice['tyre_sales'] = "Tyre Sales";
												$allservice['custom_seats_n_upholstery'] = "Custom Seats and Upholstery";
												$allservice['mobile_mechanic'] = "Mobile Mechanic";
												$allservice['accident_legal_advice'] = "Accident Legal Advice";
												$allservice['riding_lessons'] = "Riding Lessons";
												$allservice['stripped_bolt_removal'] = "Stripped bolt removal";
												$allservice['harley-davidson_rentals'] = "Harley - Davidson Rentals";

												$servicesarray = json_decode($services, true);

												foreach ($allservice as $key => $service){
													# code...
													
											?>
												<div class="col-md-4">
													<label>
														<input type="checkbox" name="business_category[]" value='<?php echo $key ?>' <?php if (in_array($key, $servicesarray)){
																		echo "checked='checked'";
														} ?> />
														<span><?php echo $service; ?></span>
													</label>
												</div>
											<?php
												}
											?>
										</div>
									</div>
								</div>
								 
								<div class="row" style="margin-top: 25px;">
									<div class="col-md-12">
										<div class="form-group">
											<div class="stm-label h4"><?php esc_html_e('Service Parts', 'motors'); ?></div>
											<?php
												$parts = get_user_meta($user_id,'service_parts',true);
												$partsarray = json_decode($parts, true);
												
												$parts_terms = get_terms( array(
													'taxonomy' => 'parts',
													'hide_empty' => false,
												) );
												
												foreach ($parts_terms as $parts) {
											?>
											
												<div class="col-md-4">
													<label>
														<input type="checkbox" name="service_parts[]" value='<?php echo $parts->name; ?>' <?php if (in_array($parts->name, $partsarray)){ echo "checked='checked'"; } ?> />
														<span><?php echo $parts->name; ?></span>
													</label>
												</div>
											<?php
												}
											?>
										</div>
									</div>
								</div>
								
								<?php
}

?>
						</div>
					</div>

                    <!--Main information-->
                        <div class="stm-change-block">
                            <div class="title">
                                <div class="heading-font"><?php esc_html_e('Images and Videos', 'motors'); ?></div>
                            </div>
                            <div class="main-info-settings">
                                <div class="row">
                                    <div class="col-md-12">

                                        <!--Logo-->
            <div class="clearfix stm-image-unit stm-image-unit-logo">
                <?php if (!empty($user['logo'])): ?>
                    <div class="image no_empty">
                        <i class="fa fa-remove" data-plchdr="<?php stm_get_dealer_logo_placeholder(); ?>"></i>
                        <img src="<?php echo esc_url($user['logo']); ?>" class="img-responsive" />
                        <script>
                            jQuery('document').ready(function () {
                                var $ = jQuery;
                                $('.stm-my-profile-settings .stm-image-unit-logo .image .fa-remove').on('click', function () {
                                    $(this).append('<input type="hidden" value="delete" id="stm_remove_dealer_logo" name="stm_remove_dealer_logo" />');
                                    $(this).parent().removeClass('no_empty').addClass('private-logo-dealer-placeholder');
                                    $(this).parent().find('.img-responsive').attr('src', $(this).data('plchdr'));
                                    $('.stm-user-avatar a .img-avatar').attr('src', $(this).data('plchdr'));
                                });
                            });
                        </script>
                    </div>
                    <?php
else: ?>
                        <div class="image private-logo-dealer-placeholder">
                            <img src="<?php stm_get_dealer_logo_placeholder(); ?>" class="img-responsive" />
                        </div>
                    <?php
endif; ?>

                    <div class="stm-upload-new-avatar">
                        <div class="heading-font"><?php esc_html_e('Upload new logo', 'motors'); ?></div>
                        <div class="stm-new-upload-area clearfix">
                            <a href="#" class="button stm-choose-file"><?php esc_html_e('Choose file', 'motors'); ?></a>
                            <div class="stm-new-file-label"><?php esc_html_e('No File Chosen', 'motors'); ?></div>
                            <input type="file" name="stm-avatar" />

                        </div>
                        <div class="stm-label"><?php esc_html_e('JPEG or PNG minimal 236x60px', 'motors'); ?></div>
                    </div>
                </div>


                <!--Dealer Image-->
                <div class="clearfix stm-image-unit stm-dealer-image-front">
                    <div class="image <?php if (!empty($user['dealer_image'])) echo ' no_empty'; ?>">
                        <?php if (!empty($user['dealer_image'])): ?>
                            <i class="fa fa-remove remove-dealer-img"></i>
                            <img src="<?php echo esc_url($user['dealer_image']); ?>" class="img-responsive" />
                            <script>
                                jQuery('document').ready(function () {
                                    var $ = jQuery;
                                    $('.stm-my-profile-settings .stm-dealer-image-front .image .fa-remove').on('click', function () {
                                        $(this).append('<input type="hidden" value="delete" id="stm_remove_dealer_img" name="stm_remove_dealer_img" />');
                                        $(this).parent().removeClass('no_empty').html('<div class="stm-empty-avatar-icon"><i class="stm-service-icon-user"></i></div>');
                                    });
                                });
                            </script>
                            <?php
else: ?>
                                <div class="stm-empty-avatar-icon"><i class="stm-service-icon-user"></i></div>
                            <?php
endif; ?>
                        </div>
                        <div class="stm-upload-new-avatar">
                            <div class="heading-font"><?php esc_html_e('Upload Dealer Image', 'motors'); ?></div>
                            
                            <div class="stm-new-upload-area clearfix">

                                <a href="#" class="button stm-choose-file"><?php esc_html_e('Choose file', 'motors'); ?></a>
                                <div class="stm-new-file-label"><?php esc_html_e('No File Chosen', 'motors'); ?></div>
                                <input type="file" name="stm-dealer-image" />

                            </div>
                            <div class="stm-label"><?php esc_html_e('JPEG or PNG minimal 500x282', 'motors'); ?></div>
                        </div>

                         <div class="row" style="margin-top: 29px;">
                    <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <div class="stm-label h4"><?php esc_html_e('Upload Dealer Gallery', 'motors'); ?></div>
                                         <?php echo do_shortcode('[mwp_dropform]'); ?>
										 <input type="hidden" name="stm_dealer_hidden_images" id="stm_dealer_hidden_images">
                                    </div>
                                </div>
                     
                    </div>

                        
                    <div class="row">
                    <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <div class="stm-label h4"><?php esc_html_e('Video Url', 'motors'); ?></div>
                                        <input type="text" name="stm_video_url" value="<?php echo esc_attr($stm_video_url); ?>" placeholder="<?php esc_attr_e('Video URL', 'motors'); ?>"/>
                                    </div>
                                </div>
                     
                    </div>

                                    </div>
                                </div>
                            </div>
                        </div>

					<!--Change password-->
					<div class="stm-change-block stm-change-password-form">
						<div class="title">
							<div class="heading-font"><?php esc_html_e('Change password', 'motors'); ?></div>
						</div>
						<div class="stm_change_password">
							<div class="row">
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<div class="stm-label h4"><?php esc_html_e('New Password', 'motors'); ?></div>
										<input type="password" name="stm_new_password" />
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<div class="stm-label h4"><?php esc_html_e('Re-enter New Password', 'motors'); ?></div>
										<input type="password" name="stm_new_password_confirm" />
									</div>
								</div>
							</div>
						</div>
					</div>

					<!--Socials-->
					<div class="stm-change-block stm-socials-form">
						<div class="title">
							<div class="heading-font"><?php esc_html_e('Your Social Networks', 'motors'); ?></div>
						</div>
						<div class="stm_socials_settings">
							<div class="row">
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<div class="stm-label h4">
											<i class="fa fa-facebook"></i>
											<?php esc_html_e('Facebook', 'motors'); ?>
										</div>
										<input type="text" name="stm_user_facebook" value="<?php echo esc_attr($socials['facebook']); ?>" placeholder="<?php esc_attr_e('Enter your Facebook profile URL', 'motors'); ?>"/>
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<div class="stm-label h4">
											<i class="fa fa-twitter"></i>
											<?php esc_html_e('Twitter', 'motors'); ?>
										</div>
										<input type="text" name="stm_user_twitter" value="<?php echo esc_attr($socials['twitter']); ?>" placeholder="<?php esc_attr_e('Enter your Twitter URL', 'motors'); ?>"/>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<div class="stm-label h4">
											<i class="fa fa-linkedin"></i>
											<?php esc_html_e('Linked In', 'motors'); ?>
										</div>
										<input type="text" name="stm_user_linkedin" value="<?php echo esc_attr($socials['linkedin']); ?>" placeholder="<?php esc_attr_e('Enter Linkedin Public profile URL', 'motors'); ?>" />
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<div class="stm-label h4">
											<i class="fa fa-youtube-play"></i>
											<?php esc_html_e('Youtube', 'motors'); ?>
										</div>
										<input type="text" name="stm_user_youtube" value="<?php echo esc_attr($socials['youtube']); ?>" placeholder="<?php esc_attr_e('Enter Youtube channel URL', 'motors'); ?>"/>
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<div class="stm-label h4">
											<i class="fa fa-instagram"></i>
											<?php esc_html_e('Instagram', 'motors'); ?>
										</div>
										<input type="text" name="stm_user_instagram" value="<?php echo esc_attr($socials['instagram']); ?>" placeholder="<?php esc_attr_e('Enter Instagram URL', 'motors'); ?>"/>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!--Confirm Password-->
					<div class="stm-settings-confirm-password">
						<?php if (empty($wsl)): ?>
							<div class="heading-font"><?php esc_html_e('Enter your Current Password to confirm changes', 'motors'); ?></div>
							<div class="stm-show-password">
								<i class="fa fa-eye-slash"></i>
								<input type="password" name="stm_confirm_password" placeholder="<?php esc_attr_e('Current Password', 'motors'); ?>" required/>
							</div>
						<?php
endif; ?>
						<input type="submit" value="<?php esc_attr_e('Save Changes', 'motors'); ?>" />
					</div>

                    

                    </div>



				</form>
			</div>
		</div>


<?php 

/* Describe what the code snippet does so you can remember later on */
add_action('wp_footer', 'sell_bike_code',100);
function sell_bike_code(){
?>
<script type="text/javascript">
            // (function ($) {
    // "use strict";

    // var ListingForm = STMListings.ListingForm = function (form) {
        // this.$form = $(form);
        // this.formUser = $('.stm-form-checking-user');
        // this.featuredId = 0;
        // this.userFiles = [];
        // this.orderChanged = false;
        // this.init();
    // };

    // ListingForm.prototype.init = function () {
        // this.$loader = $('.stm-add-a-car-loader');
        // this.$message = $('.stm-add-a-car-message');

        // this.$form.submit($.proxy(this.submit, this));

        // this.$form.on('change', 'input[name^="stm_car_gallery_add"]', $.proxy(this.onImagePicked, this));

        // $(document).on('touchend click', '.stm-media-car-gallery .stm-placeholder .inner .stm-image-preview .fa', $.proxy(this.imageRemove, this));

        // $('.stm-media-car-gallery .stm-placeholder').droppable({
            // drop: $.proxy(this.onDropped, this)
        // });
    // };

    // ListingForm.prototype.submit = function (e) {
        // e.preventDefault();

        // var loadType = $('input[name="btn-type"]').val();
        // this.$loader = $('.stm-add-a-car-loader.' + loadType);

        // $.ajax({
            // url: ajaxurl,
            // type: "POST",
            // dataType: 'json',
            // context: this,
            // data: this.submitData(),
            // beforeSend: function () {
                // this.$loader.addClass('activated');
                // this.$message.slideUp();
            // },
            // success: this.success
        // });

    // };

    // ListingForm.prototype.submitData = function () {
        // var gdpr = '';

        // if (typeof this.formUser.find('input[name="motors-gdpr-agree"]')[0] !== 'undefined') {
            // var gdprAgree = (this.formUser.find('input[name="motors-gdpr-agree"]')[0].checked) ? 'agree' : 'not_agree';
            // gdpr = '&motors-gdpr-agree=' + gdprAgree;
        // }

        // return this.$form.serialize() + gdpr + '&action=stm_ajax_add_a_car&security=' + addACar;
    // };

    // ListingForm.prototype.success = function (data) {
        // this.$loader.removeClass('activated');
        // $('.stm-form-checking-user button[type="submit"]').removeClass().addClass('enabled');

        // if (data.message) {
            // if (typeof data.html !== 'undefined') {
                // this.$message.html(data.message).slideDown();
            // } else {
                // this.$message.html(data.message).slideDown();
            // }
        // }

        // if (data.post_id) {
            // this.$message.html(data.message).slideDown();
            // this.$loader.addClass('activated');

            // if (typeof(this.userFiles) !== 'undefined') {
                // if (!this.orderChanged) {
                    // this.sortImages();
                // }

                // this.uploadImages.call(this, data);
            // }
        // }
    // };

    // ListingForm.prototype.uploadImages = function (data) {
        // var fd = new FormData();

        // if (this.$form.closest('.stm_edit_car_form').length) {
            // fd.append('stm_edit', 'update');
        // }

        // fd.append('action', 'stm_ajax_add_a_car_media');
        // fd.append('post_id', data.post_id);
        // fd.append('redirect_type', data.redirect_type);

        // $.each(this.userFiles, function (i, file) {
            // if (typeof(file) !== undefined) {
                // if (typeof(file) !== 'number') {
                    // fd.append('files[' + i + ']', file);
                // } else {
                    // fd.append('media_position_' + i, file);
                // }
            // }
        // });

        // $.ajax({
            // type: 'POST',
            // url: ajaxurl,
            // data: fd,
            // contentType: false,
            // processData: false,
            // context: this,
            // success: function (response) {

                // if (typeof(response) != 'object') {
                    // var responseObj = JSON.parse(response);
                // } else {
                    // var responseObj = response;
                // }
                // if (responseObj.allowed_posts) {
                    // $('.stm-posts-available-number span').text(responseObj.allowed_posts);
                // }
                // this.$loader.removeClass('activated');
                // if (responseObj.message) {
                    // this.$message.html(responseObj.message).slideDown();
                // }
                // if (responseObj.url) {
                    // window.location = responseObj.url;
                // }
            // }
        // });
    // };

    // ListingForm.prototype.sortImages = function () {
        // $(".stm-media-car-gallery .stm-placeholder").each(function () {
            // $(this).blur();
            // $(this).find(".inner").removeClass("active");
            // $(this).find(".stm-image-preview").blur();
        // });

        // var _this = this;

        // setTimeout(function () {
            // var tmpArr = [];

            // $('.stm-placeholder.stm-placeholder-generated').each(function (i, e) {
                // /*Get old id*/
                // var oldId = $(this).find('.stm-image-preview').attr('data-id');

                // /*Set new ids to preview and to delete icon*/
                // $(this).find('.stm-image-preview').attr('data-id', i);
                // $(this).find('.stm-image-preview .fa').attr('data-id', i);

                // if (typeof(_this.userFiles[oldId]) !== 'undefined') {
                    // tmpArr[i] = _this.userFiles[oldId];
                // }
            // });

            // _this.featuredId = 0;
            // _this.userFiles = tmpArr;
        // }, 100);
    // };

    // ListingForm.prototype.onImagePicked = function (event) {
        // var wasEmpty = this.userFiles.length === 0, _this = this;

        // [].forEach.call($(event.target)[0].files, function (file) {

            // if (typeof(file) === 'object' && file.type.match(/^image/)) {
                // _this.userFiles.push(file);
                // var index = _this.userFiles.length - 1;

                // if (index === 0 && wasEmpty) {
                    // _this.featuredId = index;
                    // $('.stm-media-car-main-input')
                        // .find('.stm-image-preview').remove().end()
                        // .append('<div class="stm-image-preview" data-id="' + index + '"></div>');
                // }

                // $('.stm-placeholder-native').remove();
                // $('.stm-media-car-gallery')
                    // .append(
                        // '<div class="stm-placeholder stm-placeholder-generated"><div class="inner">' +
                        // '<div class="stm-image-preview" data-id="' + index + '"><i class="fa fa-close" data-id="' + index + '"></i></div>' +
                        // '</div></div>'
                    // );

                // loadImage(
                    // file,
                    // function (img) {
                        // $('.stm-image-preview[data-id="' + index + '"]').css('background-image', 'url(' + img.toDataURL() + ')');
                        // $('.stm-media-car-gallery .stm-placeholder').stop().droppable({
                            // drop: $.proxy(_this.onDropped, _this),
                            // delay: 200
                        // });
                    // },
                    // {
                        // orientation: true,
                        // canvas: true
                    // }
                // );
            // }
        // });

        // if (this.userFiles.length > 0) {
            // $('.stm-media-car-main-input .stm-placeholder').addClass('hasPreviews');
        // } else {
            // $('.stm-media-car-main-input .stm-placeholder').removeClass('hasPreviews');
        // }

        // $('.stm_add_car_form input[type="file"]').val('');
    // };

    // ListingForm.prototype.onDropped = function (event, ui) {
        // var dragFrom = ui.draggable.closest('.inner');
        // var dragTo = $(event.target).find('.inner');
        // var dragToPreview = dragTo.find('.stm-image-preview');

        // if (ui.draggable.length > 0 && dragToPreview.length > 0 && dragTo.length > 0 && dragFrom.length > 0) {

            // if (dragFrom[0] !== dragTo[0]) {

                // ui.draggable.clone().appendTo(dragTo);
                // dragToPreview.clone().appendTo(dragFrom);


                // /*If placed in first pos*/
                // if (dragTo.closest('.stm-placeholder').index() === 0) {
                    // $('.stm-media-car-main-input .stm-image-preview').remove();
                    // ui.draggable.clone().appendTo('.stm-media-car-main-input');
                    // this.featuredId = ui.draggable.data('id');
                // }

                // /*If moving from first place*/
                // if (ui.draggable.closest('.stm-placeholder').index() === 0) {
                    // $('.stm-media-car-main-input .stm-image-preview').remove();
                    // dragToPreview.clone().appendTo('.stm-media-car-main-input');
                    // this.featuredId = dragToPreview.data('id');
                // }

                // ui.draggable.remove();
                // dragToPreview.remove();

                // this.sortImages();
                // this.orderChanged = true;
            // }
        // }
    // };

    // ListingForm.prototype.imageRemove = function (event) {
        // var stm_id = $(event.target).attr('data-id');
        // var stm_length = 0;
        // delete this.userFiles[stm_id];
        // $('.stm-placeholder .inner').removeClass('deleting');

        // $(event.target).closest('.stm-placeholder').remove();

        // $(this.userFiles).each(function (i, e) {
            // if (typeof(e) !== 'undefined') {
                // stm_length++;
            // }
        // });

        // if (stm_length === 0) {
            // $('.stm-media-car-main-input .stm-image-preview').remove();
            // $('.stm-media-car-main-input .stm-placeholder').removeClass('hasPreviews');
            // var defaultPlaceholders = '';
            // for (var i = 0; i < 5; i++) {
                // defaultPlaceholders += '<div class="stm-placeholder stm-placeholder-native"><div class="inner"><i class="stm-service-icon-photos"></i></div></div>';
            // }

            // $('.stm-media-car-gallery').append(defaultPlaceholders);
        // }

        // if (this.featuredId === parseInt(stm_id)) {
            // var changeFeatured = $('.stm-media-car-gallery .stm-placeholder:nth-child(1)');
            // this.featuredId = changeFeatured.find('.stm-image-preview').attr('data-id');

            // $('.stm-media-car-main-input .stm-image-preview').remove();
            // $(changeFeatured).find('.stm-image-preview').clone().appendTo('.stm-media-car-main-input');
        // }

        // this.sortImages();
    // };

    // $(document).ready(function () {

        // var $form = $('#stm_user_settings_edit'), listingForm = new ListingForm($form);

        // //window.hasOwnProperty = window.hasOwnProperty || Object.prototype.hasOwnProperty;

        // /*Sell a car*/
        // if (typeof stmUserFilesLoaded !== 'undefined') {
            // listingForm.userFiles = stmUserFilesLoaded;
        // }

        // $(document).on('mouseenter touchstart', '.stm-media-car-gallery .stm-placeholder .inner .stm-image-preview .fa', function () {
            // $(this).closest('.inner').addClass('deleting');
        // });

        // $(document).on('mouseleave touchend', '.stm-media-car-gallery .stm-placeholder .inner .stm-image-preview .fa', function () {
            // $(this).closest('.inner').removeClass('deleting');
        // });

        // /*Droppable*/
        // $(document).on("mouseenter touchstart", '.stm-media-car-gallery .stm-placeholder .inner .stm-image-preview', function (e) {
            // $(this).draggable({
                // revert: 'invalid',
                // helper: "clone"
            // })
        // });

        // $(document).on("mouseenter touchstart click", ".stm-media-car-gallery .stm-placeholder .inner", function () {
            // $(".stm-media-car-gallery .stm-placeholder").each(function () {
                // $(this).blur();
                // $(this).find(".inner").removeClass("active");
                // $(this).find(".stm-image-preview").blur();
            // });

            // $(this).addClass("active");
        // });

        // $('.stm-form-checking-user button[type="submit"]').on('click', function (e) {
            // e.preventDefault();
            // if (!$(this).hasClass('disabled')) {
                // var loadType = $(this).attr('data-load');
                // $('input[name="btn-type"]').val(loadType);

                // $(this).removeClass().addClass('disabled');
                // $form.submit();
            // }
        // });

    // });

// })(jQuery);
        </script>
<?php
};


?>

		<script type="text/javascript">
			jQuery(document).ready(function(){


        //var $form = jQuery('#stm-my-profile-settings'), listingForm = new ListingForm($form);




				var $ = jQuery;
				$('body').on('change', 'input[type="file"]', function() {
					var length = $(this)[0].files.length;

					if(length == 1) {
						$(this).closest('.stm-image-unit').find('.stm-new-file-label').text($(this).val());
					} else {
						$(this).closest('.stm-image-unit').find('.stm-new-file-label').text('<?php esc_html_e('No File Chosen', 'motors'); ?>');
					}

				});

				$('.stm-show-password .fa').mousedown(function(){
					$(this).closest('.stm-show-password').find('input').attr('type', 'text');
					$(this).addClass('fa-eye');
					$(this).removeClass('fa-eye-slash');
				});

				$(document).mouseup(function(){
					$('.stm-show-password').find('input').attr('type', 'password');
					$('.stm-show-password .fa').addClass('fa-eye-slash');
					$('.stm-show-password .fa').removeClass('fa-eye');
				});

				$("body").on('touchstart', '.stm-show-password .fa', function () {
					$(this).closest('.stm-show-password').find('input').attr('type', 'text');
					$(this).addClass('fa-eye');
					$(this).removeClass('fa-eye-slash');
				});
			})
		</script>
