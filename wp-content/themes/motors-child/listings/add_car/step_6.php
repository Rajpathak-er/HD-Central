<?php

$user = stm_get_user_custom_fields('');

$user_id = $user['user_id'];

global $wp_roles;
$all_roles = $wp_roles->get_names(); 
//echo '<pre>' . print_r( $all_roles ) . '</pre>';



// Get the user object.
$userObj = get_userdata( $user_id );
$user_roles = $userObj->roles;


global $current_user;
    $current_user->membership_level = pmpro_getMembershipLevelForUser($current_user->ID);
$membership_level = $current_user->membership_level->ID;


$car_price_form_label = $price = $sale_price = '';
$price = $sale_price = $car_price_form_label = '';
if (!empty($id)) {
    $car_price_form_label = get_post_meta($id, 'car_price_form_label', true);
   $buyer_can_email = get_post_meta($id, 'buyer_can_email', true);
   $buyer_can_phone = get_post_meta($id, 'buyer_can_phone', true);
   $buyer_phone = get_post_meta($id, 'buyer_phone', true);
   $is_near_by_price = get_post_meta($id, 'is_near_by_price', true);

    
    $price = (int) getConverPrice(get_post_meta($id, 'price', true));
    $sale_price = (!empty(get_post_meta($id, 'sale_price', true))) ? (int) getConverPrice(get_post_meta($id, 'sale_price', true)) : '';
}


function countrycurrency($defaultCountry = "", $id = "", $name = "", $classes = ""){
    global $countriescurrency; // Assuming the array is placed above this function
    
    $output = "<select id='".$id."' name='".$name."' class='".$classes."'>";
    
    foreach($countriescurrency as $code => $country){
        $currency_code = ucwords(strtolower($country["name"])); // Making it look good
        $output .= "<option value='".$currency_code."' ".(($currency_code == ucwords(strtolower($defaultCountry))) ?"selected":"").">".$currency_code." - (".$country["currency_symbol"].")</option>";
    }
    
    $output .= "</select>";
    
    return $output; // or echo $output; to print directly
}

?>

<div class="stm-form-price-edit">
    <div class="stm-car-listing-data-single stm-border-top-unit stm-step-title">
        <div class="title heading-font"><span class="step_number step_number_5 heading-font"><?php esc_html_e('Step', 'motors'); ?> 4</span><?php esc_html_e('- Set Your Asking Price', 'motors'); ?></div>
        
    </div>

    <?php if (!empty($show_price_label) and $show_price_label == 'yes'): ?>
        <div class="row stm-relative">
            <div class="col-md-12 col-sm-12 stm-prices-add">
                <?php if (!empty($stm_title_price)): ?>
                    <h4><?php echo esc_attr($stm_title_price); ?></h4>
                <?php endif; ?>
                <?php if (!empty($stm_title_desc)): ?>
                    <p><?php echo esc_attr($stm_title_desc); ?></p>
                <?php endif; ?>
            </div>
            <div class="col-md-12 col-sm-6 inputboxmaindiv_add_bike">
                <div class="row">
                    
                    <div class="col-md-3 col-sm-12">
                        <div class="stm_price_input">
                            <div class="stm_label heading-font">Asking price*
                                                    </div>
                                                    <input type="text" min="0" class="heading-font" name="stm_car_price" value="<?php echo esc_attr($price); ?>" required/>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="stm_price_input">
                            <div class="stm_label heading-font">&nbsp;
                            </div>
                            
                                   <?php echo countrycurrency('United Kingdom','stm_f_currency', 'stm_f_currency','add_a_car-select') ;?>
                                
                            </div>
                        </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="stm_price_input">
                            <div class="stm_label heading-font">&nbsp;
                            </div>
                            <input type="checkbox"  <?php if($is_near_by_price){ echo "checked=checked";}?> name="is_near_by_price" id="is_near_by_price" ><label for="is_near_by_price">Or Nearest offer</label>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12" style="display: none;">
                        <div class="stm_price_input">
                            <div class="stm_label heading-font"><?php esc_html_e('Sale Price', 'motors'); ?>
                                (<?php echo stm_get_price_currency(); ?>)
                            </div>
                            <input type="number" min="0" class="heading-font" name="stm_car_sale_price" value="<?php echo esc_attr($sale_price); ?>" required/>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12" style="display: none;">
                        <div class="stm_price_input">
                            <div
                                class="stm_label heading-font"><?php esc_html_e('Custom label instead of price', 'motors'); ?></div>
                            <input type="text" class="heading-font" name="car_price_form_label" value="<?php echo esc_attr($car_price_form_label); ?>" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="row stm-relative">
            <div class="col-md-4 col-sm-6">
                <div class="stm_price_input">
                    <div class="stm_label heading-font"><?php esc_html_e('Price', 'motors'); ?>*
                        (<?php echo stm_get_price_currency(); ?>)
                    </div>
                    <input type="number" class="heading-font" name="stm_car_price" value="<?php echo esc_attr($price); ?>" required/>
                </div>
            </div>
            <div class="col-md-8 col-sm-6">
                <?php if (!empty($stm_title_price)): ?>
                    <h4><?php echo esc_attr($stm_title_price); ?></h4>
                <?php endif; ?>
                <?php if (!empty($stm_title_desc)): ?>
                    <p><?php echo esc_attr($stm_title_desc); ?></p>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
    <input type="hidden" name="btn-type" />
</div>

<div class="stm-form-price-edit stm-step-5 stm-step-5-ad-type">
    <div class="stm-car-listing-data-single stm-border-top-unit stm-step-title">
        <div class="title heading-font"><span class="step_number step_number_5 heading-font"><?php esc_html_e('Step', 'motors'); ?> 5</span><?php esc_html_e('- Choose Your Ad Type and Contact Preference', 'motors'); ?></div>
        
    </div>
<div class="row stm-relative" style="margin:0px;">
    <div class="col-md-12 col-sm-12 pricingboxaddyourbike" style="<?php if($_REQUEST['edit_car']) { echo ";display: none;"; } ?>">
                <div class="row" style="    padding-bottom: 30px;">
                    <?php if(in_array("subscriber", $user_roles)){?>
                    <div class="col-md-12 col-sm-12">
                        <div class="stm_price_input">
                            <div class="stm_label heading-font">Free Ad: Your ad will run for free for 5 days
                            </div>
                            <input type="radio" checked="checked"  name="bike_pricing" value="0" id="bike_pricing_free"><label for="bike_pricing_free"></label>
                        </div>
                    </div>
                <?php } 


                ?>
                    <div class="col-md-12 col-sm-12">
                        <div class="stm_price_input">
                            <div class="stm_label heading-font">No Time limit Ad: Your ad will run until your bike is sold
                            </div>
                            <input type="radio" required name="bike_pricing" value="$<?php the_field('free_ads', 'option') ?>" id="bike_pricing_10"><label for="bike_pricing_10">USD<?php the_field('free_ads', 'option') ?></label>
                        </div>
                    </div>
                    <?php if(in_array("subscriber", $user_roles)){?>
                    <div class="col-md-12 col-sm-12">
                        <div class="stm_price_input">
                            <div class="stm_label heading-font">Premium Ad: We will actively promote your listing to our visitors and include it on specific mailings for members that are looking for a specific bike
                            </div>
                            <input type="radio" checked="checked" required name="bike_pricing" value="<?php the_field('paid_ads', 'option') ?>" id="bike_pricing_12"><label for="bike_pricing_12">USD<?php the_field('paid_ads', 'option') ?></label>
                        </div>
                    </div>
                <?php }?>
                    
                </div>
            </div>
        </div>
        <div class="stm-car-listing-data-single stm-border-top-unit border_bottom">
        
    </div>
	<?php if(in_array("subscriber", $user_roles) || 1==1){?>
	<div class="row stm-relative" style="margin:0px;">
          
		<div class="col-md-12 col-sm-12 pricingboxaddyourbike" style="padding-top: 30px;">
			<div class="stm-car-listing-data-single stm-border-top-unit border_bottom">
				<div class="title heading-font"><?php esc_html_e( 'Contact Preference:', 'motors' ); ?> <?php if(!in_array("subscriber", $user_roles)){?><span class="sub_text"><?php esc_html_e('(Private Sellers Only)', 'motors'); ?></span><?php } ?></div>
			</div>
			<div class="row contact-check-row" style="padding-bottom: 30px;">
				<div class="col-md-12 col-sm-12">
					<div class="stm_price_input">						
						<input type="checkbox" <?php if($buyer_can_email){ echo "checked=checked";}?> name="buyer_can_email" id="is_near_by_price"><label for="is_near_by_price"></label>
						<div class="stm_label heading-font">Buyer's can contact me on registered email</div>
					</div>
				</div>
				<div class="col-md-12 col-sm-12">
					<div class="stm_price_input">
						<input type="checkbox" <?php if($buyer_can_phone){ echo "checked=checked";}?>  name="buyer_can_phone" id="is_near_by_price"><!--<label for="is_near_by_price">USD9.99</label>-->
						<div class="stm_label heading-font">Buyer can contact me by phone  <?php if(!in_array("subscriber", $user_roles)){?><span class="sub_text"><?php esc_html_e('(Not Applicable for Dealers)', 'motors'); ?></span><?php }?></div>
					</div>
				</div>
				<div class="col-md-6 col-sm-6">
					<div class="stm_price_input">
						<div class="stm_label heading-font">Add Phone number <?php if(!in_array("subscriber", $user_roles)){?><span class="sub_text"><?php esc_html_e('(Not Applicable for Dealers)', 'motors'); ?></span><?php }?></div>
						<input type="text" value="<?php echo $buyer_phone; ?>" name="buyer_phone" id="is_near_by_price"/> * User phone number will be hidden, but buyer will able to use dial now button.
					</div>
				</div>
			</div>
		</div>
		
	</div>
<?php }?>
 
</div>