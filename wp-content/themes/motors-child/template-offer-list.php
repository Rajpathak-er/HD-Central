<?php 
/* Template Name: Offer List */ 
	get_header();
		get_template_part('partials/title_box');
		$recaptcha_enabled = get_theme_mod('enable_recaptcha',0);
		$recaptcha_public_key = get_theme_mod('recaptcha_public_key');
		$recaptcha_secret_key = get_theme_mod('recaptcha_secret_key');
		if(!empty($recaptcha_enabled) and $recaptcha_enabled and !empty($recaptcha_public_key) and !empty($recaptcha_secret_key)) {
			wp_enqueue_script( 'stm_grecaptcha' );
		}
?>
<style type="text/css">
	.small_title_box{
		display: none;
	}
	.page-template-template-offer-list-php .find-dealership button.submit_btn.bsn{
		position: absolute;
    right: 0;
    width: 30px;
    text-align: center;
    padding: 0 !important;
    top: 1px;
    height: 27px !important;
	}
	.page-template-template-offer-list .stm_filter_location a{
		color: white;
	    border: 1px solid;
	    padding: 9px 20px;
	    display: inline-block;
	    margin-top: 16px;
	    border-radius: 5px;
	}
	.meta-right-unit{
		display: none;
	}
</style>
<div class="archive-listing-page">
    <div class="container">
        <?php 
            get_template_part('partials/services/offer-list', 'archive');		?>
    </div>
</div>
<?php	get_footer();
?>