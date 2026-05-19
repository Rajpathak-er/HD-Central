<?php 

$current_user = wp_get_current_user();

$vars = get_queried_object();

$current_user_email = isset($current_user->user_email) ? $current_user->user_email : false;

$view_user_email = isset($vars->user_email) ? $vars->user_email : false;

if(($current_user_email == $view_user_email) && !isset($_GET['old_view'])){ ?>


<!DOCTYPE html>
<html lang="en-US">

	
<?php  get_template_part( 'partials/layouts/author/head' )

 ?>

<body data-rsssl=1
    class="page-template-default page page-id-6763 logged-in wcmp-color-scheme-outer_space_blue theme-motors pmpro-body-has-access woocommerce-no-js motors stm-template-listing_four header_remove_compare header_remove_cart stm-layout-header-car_dealer cookies-not-set wpb-js-composer js-comp-ver-6.6.0 vc_responsive">

    <div id="wrapper" class="wcmp-wrapper">

        <!-- header -->
        <?php  get_template_part( 'partials/layouts/author/header' )
        get_header();
         ?>
        <!-- / header -->

        <!-- sidebar -->
        <?php  get_template_part( 'partials/layouts/author/sidebar' ) ?>

        <!-- / sidebar -->

        <div id="page-wrapper" class="side-collapse-container">

        <?php get_template_part( 'partials/user/private/main' ) ?>
            
        </div>


    </div>
    <!-- start/ frontend footer/ WooZone -->
    <!-- WooZone version: 13.5.6 -->


    <?php  get_template_part( 'partials/layouts/author/footer' ) 
    get_footer();
    ?>
</body>

</html>

<?php }else{ ?>


<?php get_header(); ?>
<?php
    $user = get_queried_object();
    $current_user = wp_get_current_user();

    $display_footer = '';
    if($user->ID === $current_user->ID and empty($_GET['view-myself'])) {?>
        <style type="text/css">
            footer#footer {
                display: none;
            }
        </style>

        <script>
            jQuery(document).ready(function(){
                stm_private_user_height();

                <?php if(!empty($_GET['stm_unmark_as_sold_car'])): ?>
                    window.history.pushState('','','<?php echo esc_url(stm_get_author_link('')); ?>');
                <?php endif; ?>

                <?php if(!empty($_GET['stm_mark_as_sold_car'])): ?>
                    window.history.pushState('','','<?php echo esc_url(stm_get_author_link('')); ?>');
                <?php endif; ?>

                <?php if(!empty($_GET['stm_disable_user_car'])): ?>
                    window.history.pushState('','','<?php echo esc_url(stm_get_author_link('')); ?>');
                <?php endif; ?>

                <?php if(!empty($_GET['stm_enable_user_car'])): ?>
                    window.history.pushState('','','<?php echo esc_url(stm_get_author_link('')); ?>');
                <?php endif; ?>

                <?php if(!empty($_GET['stm_move_trash_car'])): ?>
                    window.history.pushState('','','<?php echo esc_url(stm_get_author_link('')); ?>');
                <?php endif; ?>
            });

            jQuery(window).on('load', function(){
                stm_private_user_height();
            });

            jQuery(window).on('resize', function(){
                stm_private_user_height();
            });

            function stm_private_user_height() {
                var $ = jQuery;
                var windowH = $(window).outerHeight();
                var topBarH = $('#top-bar').outerHeight();
                var headerH = $('#header').outerHeight();

                var topH = 0;

                if(topBarH != null) {
                    topH = topBarH;
                }

                if(headerH != null) {
                    topH += headerH;
                }

                var minH = windowH - topH;

                $('.stm-user-private-sidebar').css({
                    'min-height' : minH + 'px'
                })
            }
        </script>
    <?php }

	
    if(!empty($_GET['view-myself']) and $_GET['view-myself']) {
        get_template_part('partials/user/user-public-profile', 'route');
    } else {
        if ( is_user_logged_in() ) {
            get_template_part( 'partials/user/user-private-profile', 'route' );
        } else {
            get_template_part( 'partials/user/user-public-profile', 'route' );
        }
    }
?>


<?php get_template_part('partials/single-car/single-car-compare-modal'); ?>

<?php get_footer(); ?>

<?php } ?>

