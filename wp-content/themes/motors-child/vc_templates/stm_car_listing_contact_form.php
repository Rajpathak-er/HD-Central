<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$css_class = (!empty($css)) ? apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' ')) : '';

?>

<div class="stm_listing_car_form <?php echo esc_attr($css_class); ?>">
	<div class="stm-single-car-contact">

		<?php if ( ! empty( $title ) ): ?>
			<div class="title">
				<i class="fa fa-paper-plane"></i>
				<?php echo esc_html($title); ?>
			</div>
		<?php endif; ?>

		<?php if($form != '' and $form != 'none'): ?>
			<?php $cf7 = get_post($form); ?>
			<div class="wpcf7 js" id="wpcf7-f500-p165229-o1" lang="en-US" dir="ltr" style="">
			    <div class="screen-reader-response">
			        <p role="status" aria-live="polite" aria-atomic="true" class="stm-hidden"></p>
			        <ul></ul>
			    </div>
			<?php echo(do_shortcode('[gravityform id="41" title="true"]')); ?>
		</div>
		<?php endif; ?>


	</div>
</div>

<?php
	$user_added_by = get_post_meta(get_the_id(), 'stm_car_user', true);
	if(!empty($user_added_by)):
	$user_data = get_userdata($user_added_by);
	if($user_data):
?>
		<script>
			jQuery(document).ready(function(){
				var $ = jQuery;
				var inputAuthor = '<input type="hidden" value="<?php echo intval($user_added_by); ?>" name="stm_changed_recepient"/>';
				$('.stm_listing_car_form form').append(inputAuthor);
			})
		</script>
	<?php endif; ?>
<?php endif; ?>