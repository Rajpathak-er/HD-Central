<style>
	h4.stm-seller-title {
		font-size:18px;
	}
	</style>

<?php
	$user_page = get_queried_object();
	$user_id = $user_page->data->ID;
	$query = (function_exists('stm_user_listings_query')) ? stm_user_listings_query($user_id, 'publish', 6, false, 0, false, true) : null;
	$query_popular = (function_exists('stm_user_listings_query')) ? stm_user_listings_query($user_id, 'publish', 6, true, 0, false, true) : null;

	$row = 'row row-3';
	$active = 'grid';
	$list = '';
	$grid = 'active';
	if(!empty($_GET['view_type']) and $_GET['view_type'] == 'list') {
		$list = 'active';
		$grid = '';
		$active = 'list';
		$row = 'row-no-border-last';
	}

?>

<?php if($query != null && $query->have_posts()): ?>
	<h4 class="stm-seller-title"><?php esc_html_e('Dealer Inventory', 'motors'); ?></h4>
	<div class="stm_listing_tabs_style_2 stm-car-listing-sort-units stm-car-listing-directory-sort-units clearfix">
		<input type="hidden" id="stm_dealer_view_type" value="<?php echo esc_attr($active); ?>" />
		<?php if($query != null && $query->have_posts()): ?>
			<div class="car-listing-row <?php echo esc_attr($row); ?>">
				<?php while($query->have_posts()): $query->the_post(); ?>
					<?php get_template_part( 'partials/listing-cars/listing-'.$active.'-directory-loop-custom', 'animate' ); ?>
				<?php endwhile; ?>
			</div>
		<?php endif; ?>
	</div>
<?php else: ?>
	<h4 class="stm-seller-title" style="color:#aaa;"><?php esc_html_e('No Inventory added yet.', 'motors'); ?></h4>
<?php endif; ?>