<?php
if(!empty($show_car_title) and $show_car_title == 'yes'):
	$value = '';
	if(!empty($id)) {
		$value = get_the_title($id);
	} ?>
	<div class="stm-car-listing-data-single stm-border-top-unit ">
		<div class="stm_add_car_title_form">
			<div class="title heading-font"><?php esc_html_e('Add template phrases to describe your bike', 'motors'); ?></div>
		</div>
	</div>
<div class="stm-form-5-notes clearfix">
<div class="row stm-relative">
	<div class="col-md-9 col-sm-9 stm-non-relative">
            <div class="stm-phrases-unit">
                <?php if (!empty($stm_phrases)): $stm_phrases = explode(',', $stm_phrases); ?>
                    <div class="stm_phrases">
                        <div class="inner">
                            <i class="fa fa-close"></i>
                            <h5><?php esc_html_e('Select all the phrases that apply to your vehicle.', 'motors'); ?></h5>
                            <?php if (!empty($stm_phrases)): ?>
                                <div class="clearfix">
                                    <?php foreach ($stm_phrases as $phrase): ?>
                                        <label>
                                            <input type="checkbox" name="stm_phrase" value="<?php echo esc_attr($phrase); ?>"/>
                                            <span><?php echo esc_attr($phrase); ?></span>
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                                <a href="#" class="button"><?php esc_html_e('Apply', 'motors'); ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
				<input type="text" name="stm_car_main_title_show" readonly="readonly" value="<?php echo esc_attr($value); ?>" placeholder="<?php esc_attr_e('Title', 'motors'); ?>">
                <input type="hidden" name="stm_car_main_title"  value="<?php echo esc_attr($value); ?>">
            </div>
        </div>
        <?php if (!empty($stm_phrases)): ?>
            <div class="col-md-3 col-sm-3 hidden-xs">

                <div class="stm-seller-notes-phrases heading-font">
                    <span><?php esc_html_e('Add the Template Phrases', 'motors'); ?></span></div>

            </div>
        <?php endif; ?>
    </div>
   </div>
<?php endif; ?>