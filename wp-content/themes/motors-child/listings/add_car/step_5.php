<?php
$note = '';
if (!empty($id)) {
    $note = stm_get_listing_seller_note($id);
}
?>

<div class="stm-form-5-notes clearfix">
    <div class="stm-car-listing-data-single stm-border-top-unit stm-step-title">
        <div class="title heading-font"><span class="step_number step_number_5 heading-font"><?php esc_html_e('Step', 'motors'); ?> 3</span><?php esc_html_e('- Describe your Bike', 'motors'); ?></div>
        
    </div>
    <div class="row stm-relative">

        <div class="stm-car-listing-data-single stm-border-top-unit border_bottom">
                <div class="title heading-font"><?php esc_html_e( 'Main Description', 'motors' ); ?>*</div>
            </div>
        <div class="col-md-9 col-sm-9 stm-non-relative">
            <div class="">
                
                <textarea placeholder="<?php esc_attr_e('Enter Seller\'s notes', 'motors'); ?>"
                          name="stm_seller_notes" required><?php echo esc_attr($note); ?></textarea>
            </div>
        </div>
    </div>
</div>