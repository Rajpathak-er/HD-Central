<?php
	$filter    = stm_listings_filter();
	//$show_sold = stm_me_get_wpcfto_mod( 'show_sold_listings' );
?>
<form action="<?php echo stm_listings_current_url(); ?>" method="get" data-trigger="filter">
			<div class="count_list_n 443 filter filter-sidebar ajax-filter">
			<div class="row stm_filter_listing_count">
				<!--<div class="col-xs-2 search-div">
					<div class="service-list-serach">
						<p class="btn-search-service"><img src="https://hd-central.com/wp-content/uploads/2021/09/Vector-9.png"></p>
					</div>
				</div>-->
				<div class="col-xs-12 count-div">
					<div class="ac-total ac-showing">
													
							
					<div class="count-text">
						<span class="countr_blow_txt">Consequat-<span class="countr_blow_txt_inner">iaculis fermentum</span></span>
					</div>
				</div>
				<span class="text_after_counter">Listings</span>
			</div>
				
			</div>
			
			
		
		
		</div>

	<div class="filter filter-sidebar ajax-filter">

		<?php do_action( 'stm_listings_filter_before' ); ?>
	


		<div class="sidebar-entry-header">
			<i class="stm-icon-car_search"></i>
			<span class="h4"><?php _e( 'Search Options', 'motors' ); ?></span>
		</div>
		<div class="row row-pad-top-24">
		 <div class="col-md-12" style="border-bottom: 1px dashed #ccc;"><h5 class="pull-left"><?php _e( 'Search Options', 'motors' ); ?></h5></div>
<?php stm_listings_load_template( 'filter/types/location_sidebar' ); ?>
	<div class="col-md-12 col-sm-6 stm-filter_location_search"  style="border-bottom: 1px dashed #ccc;border-top: 1px dashed #ccc;">
		<div class="form-group">
			<div class="stm-location-search-unit">
					<h5>Search by keywords</h5>
					
				<input type="text" id="ca_keywords" value="<?php echo $_REQUEST['ca_keywords'] ?>" class="443 ca_keywords empty pac-target-input" placeholder="Enter keywords" name="ca_keywords" />
			</div>
		</div>
	</div>
	<div class="col-md-12 col-sm-6 stm-filter_location_search" >
		<div class="form-group">
			<div class="stm-location-search-unit">
					<h5>Search by region, model etc </h5>
			</div>
		</div>
	</div>
	


			<?php
			foreach ( $filter['filters'] as $attribute => $config ) :
				if ( ! empty( $filter['options'][ $attribute ] ) ) :
					if ( ! empty( $config['slider'] ) && $config['slider'] ) :
						stm_listings_load_template(
							'filter/types/slider',
							array(
								'taxonomy' => $config,
								'options'  => $filter['options'][ $attribute ],
							)
						);
					else :
						?>
						<?php if ( isset( $filter['options'][ $attribute ] ) ) : ?>
						<div class="col-md-12 col-sm-6 stm-filter_<?php echo esc_attr( $attribute ); ?>">
							<div class="form-group">
								<?php
									stm_listings_load_template(
										'filter/types/select',
										array(
											'options' => $filter['options'][ $attribute ],
											'name'    => $attribute,
										)
									);
								?>
							</div>
						</div>
						<?php endif; ?>
					<?php endif; ?>
				<?php endif; ?>
			<?php endforeach; ?>

			

			<?php
				//stm_listings_load_template(	'filter/types/features',array('taxonomy' => 'stm_additional_features'));
				?>


<div class="col-md-12 col-sm-12 stm-filter-sort-by" style="    padding: 15px 10px 25px;border-bottom: 1px dashed #ccc;">
				<?php stm_listings_load_template('filter/actions-listing-archive'); ?>
</div>
			

		</div>

		<!--View type-->
		<input type="hidden" id="stm_view_type" name="view_type"
			   value="<?php echo esc_attr( stm_listings_input( 'view_type' ) ); ?>"/>
		<!--Filter links-->
		<input type="hidden" id="stm-filter-links-input" name="stm_filter_link" value=""/>
		<!--Popular-->
		<input type="hidden" name="popular" value="<?php echo esc_attr( stm_listings_input( 'popular' ) ); ?>"/>

		<input type="hidden" name="s" value="<?php echo esc_attr( stm_listings_input( 's' ) ); ?>"/>
		<input type="hidden" name="sort_order" value="<?php echo esc_attr( stm_listings_input( 'sort_order' ) ); ?>"/>

		<div class="sidebar-action-units">
			<input id="stm-classic-filter-submit" class="hidden" type="submit"
				value="<?php esc_html_e( 'Show cars', 'motors' ); ?>"/>

			<a href="<?php echo esc_url( strtok( $_SERVER['REQUEST_URI'], '?' ) ); ?>" class="button"><span><?php _e( 'Reset all', 'motors' ); ?></span></a>
		</div>

		<?php do_action( 'stm_listings_filter_after' ); ?>
	</div>

	<?php stm_listings_load_template( 'filter/types/checkboxes', array( 'filter' => $filter ) ); ?>

</form>


			<?php  echo do_shortcode('[widget id="custom_html-5"]'); ?>

		
		
		
<?php stm_listings_load_template( 'filter/types/links', array( 'filter' => $filter ) ); ?>

<style type="text/css">
	.stm-filter-sort-by .select2-selection__rendered{
		width: 100%;
	}

</style>
