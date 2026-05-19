</div> <!--main-->
</div> <!--wrapper-->
<?php do_action( 'stm_pre_footer' ); ?>
<?php if ( ! is_404() and ! is_page_template( 'coming-soon.php' ) ) { ?>
	<footer id="footer">
		<?php get_template_part( 'partials/footer/footer' ); ?>
		<?php get_template_part( 'partials/footer/copyright' ); ?>
		<?php get_template_part( 'partials/global-alerts' ); ?>
		<!-- Searchform -->
		<?php get_template_part( 'partials/modals/searchform' ); ?>
	</footer>
	<?php
} elseif ( is_page_template( 'coming-soon.php' ) ) {
	get_template_part( 'partials/footer/footer-coming-soon' );
};
?>

<?php
if ( get_theme_mod( 'frontend_customizer' ) ) {
	get_template_part( 'partials/frontend_customizer' );
}
?>

<script>
	// for toggle submenu in top-bar menu
	jQuery(document).ready(function(){
		// Show hide popover
		jQuery(".custom_topbar_menu .menu_items span").click(function(){
			jQuery(this).parent().find(".item_wrapper").slideToggle("fast");
			jQuery(this).parent().siblings('.menu_items').find('.item_wrapper').hide('slow');
		});

		jQuery(".stm-sticky-user-sidebar .dashboard_menu").click(function(){
			jQuery(this).next().slideToggle(200);
		});

		//jQuery('.carousel').carousel();
		jQuery('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    autoplay:true,
    autoplayTimeout:20000,
    dots:false,
    nav:false,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
})
	});
	// this is for hide submenu when click outside area of screen after open submenu
	jQuery(document).on("click", function(event){
		var $trigger = jQuery(".custom_topbar_menu .menu_items");
		if($trigger !== event.target && !$trigger.has(event.target).length){
			jQuery(".item_wrapper").slideUp("fast");
		}            
	});
</script>

<script type="text/javascript">
    jQuery('body').on("click", ".re-add-fav-btn", function(e){
    	e.preventDefault();
    	var fbutton = jQuery(this);
        var id = fbutton.attr('data-id');
        var type = fbutton.attr('data-type');

        jQuery.ajax({
            type : "GET",
            dataType : "json",
            url : "<?php echo admin_url('admin-ajax.php'); ?>",
            data : {action: "update_user_fav", user_id: id,user_type: type},
            success: function(response) {
					fbutton.parent().text(response.data);
                
            }
        });


        //$("#re-compare-bar-tabs div").remove();
        //$('.re-compare-icon-toggle .re-compare-notice').text(0);

    });
</script>

<script>
jQuery(document).ready(function () {
	var owl = jQuery(".brand-carousel");
	owl.owlCarousel({
		loop: false,
		margin: 10,
		nav: false,
		dot: false,
		responsive: {
			0: {
				items: 2,
			},
			600: {
				items: 3,
			},
			1000: {
				items: 6,
			},
		},
	});

	// Custom Button
	jQuery(".customNextBtn").click(function () {
		owl.trigger("next.owl.carousel");
	});
	jQuery(".customPreviousBtn").click(function () {
		owl.trigger("prev.owl.carousel");
	});
});


  
	</script>

<?php wp_footer(); ?>

<?php
if ( ! stm_is_auto_parts() && ! stm_is_rental() ) :
	if ( is_singular( stm_listings_post_type() ) ) {
		if ( get_theme_mod( 'show_calculator', true ) ) {
			get_template_part( 'partials/modals/car-calculator' );
		}
		if ( get_theme_mod( 'show_offer_price', false ) ) {
			get_template_part( 'partials/modals/trade-offer' );
		}
		if ( get_theme_mod( 'show_trade_in', false ) ) {
			get_template_part( 'partials/modals/trade-in' );
		}
	}

	if ( stm_is_motorcycle() ) {
		if ( get_theme_mod( 'show_calculator', true ) ) {
			get_template_part( 'partials/modals/car-calculator' );
		}
		if ( get_theme_mod( 'show_offer_price', true ) ) {
			get_template_part( 'partials/modals/trade-offer' );
		}
	}

	if ( get_theme_mod( 'show_test_drive', true ) ) {
		get_template_part( 'partials/modals/test-drive' );
	}
	get_template_part( 'partials/modals/get-car-price' );

	$show_compare = ( is_single( get_the_ID() ) ) ? get_theme_mod( 'show_listing_compare', true ) : get_theme_mod( 'show_compare', true );

	if ( $show_compare ) {
		get_template_part( 'partials/single-car/single-car-compare-modal' );
	}

	if ( stm_pricing_enabled() ) {
		get_template_part( 'partials/modals/limit_exceeded' );
		get_template_part( 'partials/modals/subscription_ended' );
	}
	?>
	<?php if ( is_listing( array( 'listing_two', 'listing_three' ) ) ) : ?>
	<div class="notification-wrapper">
		<div class="notification-wrap">
			<div class="message-container">
				<span class="message"></span>
			</div>
			<div class="btn-container">
				<button class="notification-close">
					<?php echo esc_html__( 'Close', 'motors' ); ?>
				</button>
			</div>
		</div>
	</div>
<?php endif; ?>
	<div class="modal_content"></div>
	<?php
endif;

if ( stm_is_rental() ) {
	get_template_part( 'partials/modals/rental-notification-choose-another-class' );
	echo '<div class="stm-rental-overlay"></div>';
}
?>
<script>
jQuery(document).ready(function ($) {
	$(".stm-single-car-contact #wpcf7-f500-p165229-o1").hide();
	
	$(".stm-single-car-contact .title").toggle(
		function () {
			//$(".stm-single-car-contact #wpcf7-f500-p40274-o1").slideDown("slow");
			$(".stm-single-car-contact #wpcf7-f500-p165229-o1").slideDown("slow");
		},
		function () {
			//$(".stm-single-car-contact #wpcf7-f500-p40274-o1").hide("slow");
			$(".stm-single-car-contact #wpcf7-f500-p165229-o1").hide("slow");
		}
	);
});
jQuery(document).ready(function ($) {
	$(".stm-single-car-contact .title").click(function () {
		$(".stm-single-car-contact .title").toggleClass("minus-icon");
	});
});
</script>

</body>
</html>
