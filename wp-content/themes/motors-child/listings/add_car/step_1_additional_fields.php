<?php

if ( get_theme_mod('show_registered', true) ) {
	$data_value = get_post_meta($post_id, 'registration_date', true);
	?>
		<div class="stm-form-1-quarter stm_registration_date">
		<div class="stm-label">
			<i class="stm-icon-key"></i>
			<?php esc_html_e('Registered Date', 'motors'); ?>
		</div>
		<?php 
		  $currently_selected = $data_value; 
		  // Year to start available options at
		  $earliest_year = 1925; 
		  // Set your latest year you want in the range, in this case we use PHP to just set it to the current year.
		  $latest_year = date('Y'); 
		?>
		<select class="add_a_car-select" data-class="stm_select_overflowed" id="stm_registered"  name="stm_registered">
			<?php 
			foreach ( range( $latest_year, $earliest_year ) as $i ) {
			    // Prints the option with the next year in range.
			    print '<option value="'.$i.'"'.($i === $currently_selected ? ' selected="selected"' : '').'>'.$i.'</option>';
			}
			?>
		</select>
		

		
	</div>
<?php }

if ( get_theme_mod('show_vin', true) ) {
	$data_value = get_post_meta($post_id, 'vin_number', true);
	?>
	<div class="stm-form-1-quarter stm_vin">
		<div class="stm-label">
			<i class="stm-service-icon-vin_check"></i>
			<?php esc_html_e('Registration', 'motors'); ?>
		</div>
		<input type="text" name="stm_vin"
			<?php if (!empty($data_value)) { ?> class="stm_has_value" <?php } ?>
			   value="<?php echo esc_attr($data_value); ?>" placeholder="<?php esc_attr_e('Enter Registration', 'motors'); ?>"/>
		
	</div>
<?php }

if ( get_theme_mod('show_history', true) ) {
	$data_value = get_post_meta($post_id, 'history', true);
	$data_value_link = get_post_meta($post_id, 'history_link', true);
	?>
	<div class="stm-form-1-quarter stm_history">
		<div class="stm-label">
			<i class="stm-icon-time"></i>
			<?php esc_html_e('History', 'motors'); ?>
		</div>
		<input type="text" name="stm_history_label" class="<?php echo (!empty($data_value)) ? 'stm_has_value' : ''; ?>"
		       value="<?php echo esc_attr($data_value) ?>" placeholder="<?php esc_attr_e('Vehicle History Report', 'motors'); ?>"/>
		

		<div class="stm-history-popup stm-invisible">
			<div class="inner">
				<i class="fa fa-remove"></i>
				<h5><?php esc_html_e('Vehicle history', 'motors'); ?></h5>
				<?php
				$histories = explode(',', $histories);
				if (!empty($histories)):
					echo '<div class="labels-units">';
					foreach ($histories as $history): ?>
						<label>
							<input type="radio" name="stm_chosen_history" value="<?php echo esc_attr($history); ?>"/>
							<span><?php echo esc_attr($history); ?></span>
						</label>
					<?php endforeach;
					echo '</div>';
				endif;
				?>
				<input type="text" name="stm_history_link" placeholder="<?php esc_attr_e('Insert link', 'motors') ?>"
				       value="<?php echo esc_attr($data_value_link); ?>"/>
				<a href="#" class="button"><?php esc_html_e('Apply', 'motors'); ?></a>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		jQuery(document).ready(function () {
			var $ = jQuery;
			var $stm_handler = $('.stm-form-1-quarter.stm_history input[name="stm_history_label"]');
			$stm_handler.focus(function () {
				$('.stm-history-popup').removeClass('stm-invisible');
			});

			$('.stm-history-popup .button').on('click', function (e) {
				e.preventDefault();
				$('.stm-history-popup').addClass('stm-invisible');

				if ($('input[name=stm_chosen_history]:radio:checked').length > 0) {
					$stm_checked = $('input[name=stm_chosen_history]:radio:checked').val();
				} else {
					$stm_checked = '';
				}

				$stm_handler.val($stm_checked);
			});

			$('.stm-history-popup .fa-remove').on('click', function () {
				$('.stm-history-popup').addClass('stm-invisible');
			});
		});
	</script>

<?php }
?>
<div class="clearfix"></div>
</div>
<?php
if ( get_theme_mod('enable_location', true) ) {
	$data_value = get_post_meta($post_id, 'stm_car_location', true);
	$data_value_lat = get_post_meta($post_id, 'stm_lat_car_admin', true);
	$data_value_lng = get_post_meta($post_id, 'stm_lng_car_admin', true);
	?>
	</div>

	<div class="stm-car-listing-data-single stm-border-top-unit stm-step-title">
		<div class="stm-car-listing-data-single">
			<div class="title heading-font"><span class="step_number step_number_1 heading-font"><?php esc_html_e( 'Step', 'motors' ); ?> 2</span><?php esc_html_e( '- Add Bike and Seller Location', 'motors' ); ?></div>
		</div>
	</div>
	<div class="stm-form-1-end-unit clearfix">
	<div class="firstbox-wrap">

	<div class="stn-add-car-location-wrap">
		
		<div class="stm-form-1-quarter stm_location stm-location-search-unit">
			<div class="stm-location-input-wrap stm-location">
				<div class="stm-label">
					<i class="stm-service-icon-pin_2"></i>
					<?php esc_html_e('Location', 'motors'); ?>
				</div>
				<input type="text" name="stm_location_text"<?php if (!empty($data_value)) { ?> class="stm_has_value" <?php } ?>
					   id="stm-add-car-location" value="<?php echo esc_attr($data_value); ?>"
					   placeholder="<?php esc_attr_e('Enter ZIP, Post Code, Town or City', 'motors'); ?>"/>
			</div>
			<div class="stm-location-input-wrap stm-lng" style="display: none !important;">
				<div class="stm-label">
					<i class="stm-service-icon-pin_2"></i>
					<?php esc_html_e('Latitude', 'motors'); ?>
				</div>
				<input type="text" class="text_stm_lat" name="stm_lat" value="<?php echo esc_attr($data_value_lat); ?>"
				       placeholder="<?php esc_attr_e('Enter Latitude', 'motors'); ?>"/>
			</div>
			<div class="stm-location-input-wrap stm-lng"  style="display: none !important;">
				<div class="stm-label">
					<i class="stm-service-icon-pin_2"></i>
					<?php esc_html_e('Longitude', 'motors'); ?>
				</div>
				<input type="text" class="text_stm_lng" name="stm_lng" value="<?php echo esc_attr($data_value_lng); ?>"
				       placeholder="<?php esc_attr_e('Enter Longitude', 'motors'); ?>"/>
			</div>
			<div class="stm-link-lat-lng-wrap"  style="display: none;">
				<a href="http://www.latlong.net/" target="_blank"><?php echo esc_html__('Lat and Long Finder', 'motors'); ?></a>
			</div>
		</div>
	</div>
</div>
<?php }