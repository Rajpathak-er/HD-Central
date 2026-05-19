<style>
nav ul li {
    position: unset !important;
}
div#trget .nav > li {
    position: relative !important;
}
div.nav-container .navbar ul.nav > li > div.tabbed-mega-menu { 
    width: 92%;
}
div#trget ul.dropdown-menu {
    width: auto;
}
footer#footer {
    margin-top: 20%;
}

a.ubermenu-target.ubermenu-target-with-icon.ubermenu-item-layout-default.ubermenu-item-layout-icon_left {
    color: #fff;
}
li#menu-item-42307 {
    background: #000;
    padding: 10px;
}
ul#code li a {
    background: #000;
    padding: 10px;
    color: #ffff;
    border: none;
}
div#trget {
    width: 100%;
    max-width: 100%;
    padding: 0;
    margin: 0;
}
ul#targetuse {
    width: 100%;
    text-align: center;
    display: flex;
    justify-content: center;
}

li#menu-item-42297 {
    padding: 10px;
    background: #000;
}
@media (max-width:766px) { 
.header-bottom-row {
    position: absolute;
    top: -60px;
    width: 100%;
    z-index: 999;
}
.pcss3mm-collapsable .opener {
    display: block !important;
}
button.navbar-toggle.collapsed {
margin: 0 20px;
}
ul#targetuse {
    text-align: left;
    display: unset;
 
}
ul#targetuse li {
    padding: 0 20px;
    margin-bottom: 0;
}
.navbar-header {
    background: #eee0;
}
nav.navbar.navbar-inverse.navbar-static-top {
    background-color: #0000 !important; 

}
.navbar-toggle {
    position: relative  !important; 
}
.navbar-inverse .navbar-toggle {
    border-color: #333;
    background: #000;
}
.navbar-toggle { 
    float: left; 
}
.logo-main.hidden-md.hidden-lg .ubermenu-responsive-toggle-content-align-left {
    display: none !important;
}
body .logo-main {
    text-align: left !important; 
}
div#bs-example-navbar-collapse-1 a.dropdown-toggle {
    background: #d61017;
    margin-bottom: 0px;
    color: #fff;
}
div.nav-container .navbar ul.nav { 
    width: 92%;
}
.navbar-inverse .navbar-nav .open .dropdown-menu>li>a {
    color: #000000;
    font-size: 15px;
    font-weight: 500;
}

}
@media (max-width:767px) { 
  li.opener {
    text-align: right !important;
    padding: 0 8px !important;

}
a.bloglogo.\31 11 {
    position: relative;
    z-index: 99999999;
}
/*li.opener {
    border: 1px solid !important;
    width: 100px !important;
    float: right !important;
}*/
li.opener i#abc {
    position: absolute !important;
    right: 0px !important;
    top: 2px !important;
}
.pcss3mm i#abc{
    width: unset !important;  
    font-size: 38px !important;
}
.pcss3mm i#abc {
    width: unset !important;  
    font-size: 38px !important;
}
div#close-toggle {
    position: relative;
    top: 57px;
}
div#close-toggle {
    overflow-y: scroll;
    height: 370px;
} 
.pcss3mm {
    background: #ffffff00 !important;
}
.pcss3mm { 
    box-shadow: unset !important; 
}

ul#pcss3mm {
    bottom: 166px !important;
}
li.opener {
    background: #66339900 !important;
}
ul#pcss3mm li.dropdown a {
    padding: 4px 5px;
}



}
 .right-part-icon a:after { 
    top: 25px !important;
}
@media (min-width:768px) { 
    a#root br {
    display: none;
}
}
</style>
<?php
   if ( empty( $_COOKIE['compare_ids'] ) ) {
       $_COOKIE['compare_ids'] = array();
   }
   $compare_page = get_theme_mod( 'compare_page', 156 );
   $showCompare  = get_theme_mod( 'header_compare_show', true );
   
   // Get archive shop page id
   if ( function_exists( 'WC' ) ) {
       $woocommerce_shop_page_id = wc_get_cart_url();
   }
   
   // Get page option
   $transparent_header       = get_post_meta( get_the_id(), 'transparent_header', true );
   $transparent_header_class = 'header-nav-default';
   
   if ( ! empty( $transparent_header ) and $transparent_header == 'on' ) {
       $transparent_header_class = 'header-nav-transparent';
   } else {
       $transparent_header_class = 'header-nav-default';
   }
   
   $fixed_header = get_theme_mod( 'header_sticky', true );
   if ( ! empty( $fixed_header ) and $fixed_header ) {
       $fixed_header_class = 'header-nav-fixed';
   } else {
       $fixed_header_class = '';
   }
   ?>
<?php
   $logo_main    = get_theme_mod( 'logo', get_template_directory_uri() . '/assets/images/tmp/logo.png' );
   $compare_page = get_theme_mod( 'compare_page', 156 );
   if ( function_exists( 'WC' ) ) {
       $woocommerce_shop_page_id = wc_get_cart_url();
   }
   ?>
<div id="header-nav-holder" class="">
   <div class="header-nav <?php echo esc_attr( $transparent_header_class . ' ' . $fixed_header_class ); ?>">
      <div class="container">
         <div class="listing-logo-main hidden-sm hidden-xs" style="margin-top: <?php echo get_theme_mod( 'menu_top_margin', '17' ); ?>px;">
            <?php if ( empty( $logo_main ) ) : ?>
            <a class="blogname" href="<?php echo esc_url( home_url( '/' ) ); ?>"
               title="<?php _e( 'Home', 'motors' ); ?>">
               <h1><?php echo esc_attr( get_bloginfo( 'name' ) ); ?></h1>
            </a>
            <?php else : ?>
            <a class="bloglogo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
            <img src="<?php echo esc_url( $logo_main ); ?>"
               style="width: <?php echo get_theme_mod( 'logo_width', '138' ); ?>px;"
               title="<?php esc_attr_e( 'Home', 'motors' ); ?>"
               alt="<?php esc_attr_e( 'Logo', 'motors' ); ?>"
               />
            </a>
            <?php endif; ?>


         </div>
         <div class="searchtop">
            <?php echo do_shortcode( '[widget id="search-3"]' ); ?>
         </div>
         <?php
            $top_bar               = get_theme_mod( 'top_bar_enable', true );
            $top_bar_login         = get_theme_mod( 'top_bar_login', true );
            $top_bar_wpml_switcher = get_theme_mod( 'top_bar_wpml_switcher', true );
            
            if ( ! empty( $top_bar ) and $top_bar ) :
            
                global $sitepress;
            
                ?>
         <div id="top-bar" class="eew">
            <?php
               if ( function_exists( 'icl_get_languages' ) ) :
                   $langs = apply_filters( 'wpml_active_languages', 'skip_missing=1&orderby=id&order=asc', null );
                       endif;
               ?>
            <div class="clearfix top-bar-wrapper">
               <!--LANGS-->
               <?php if ( ! empty( $top_bar_wpml_switcher ) and $top_bar_wpml_switcher ) : ?>
               <?php if ( ! empty( $langs ) ) : ?>
               <?php
                  if ( count( $langs ) > 1 || is_author() ) {
                      $langs_exist = 'dropdown_toggle';
                  } else {
                      $langs_exist = 'no_other_langs';
                  }
                  
                  $current_lang      = '';
                  $current_lang_flag = '';
                  if ( ! empty( $langs[ ICL_LANGUAGE_CODE ] ) ) {
                      $current_lang = $langs[ ICL_LANGUAGE_CODE ];
                      if ( ! empty( $current_lang['country_flag_url'] ) ) {
                          $current_lang_flag = $current_lang['country_flag_url'];
                      }
                  }
                  ?>
               <div class="pull-left language-switcher-unit">
                  <div class="stm_current_language <?php echo esc_attr( $langs_exist ); ?>" 
                     <?php
                        if ( count( $langs ) > 1 || is_author() ) {
                            ?>
                     id="lang_dropdown" data-toggle="dropdown" <?php } ?>>
                     <?php if ( stm_is_rental() and ! empty( $current_lang_flag ) ) : ?>
                     <img src="<?php echo esc_url( $current_lang_flag ); ?>" alt="<?php esc_attr_e( 'Language flag', 'motors' ); ?>" />
                     <?php endif; ?>
                     <?php echo esc_attr( ICL_LANGUAGE_NAME ); ?>
                     <?php
                        if ( count( $langs ) > 1 || is_author() ) {
                            ?>
                     <i class="fa fa-angle-down"></i><?php } ?>
                  </div>
                  <?php if ( count( $langs ) > 1 && ! is_author() ) : ?>
                  <ul class="dropdown-menu lang_dropdown_menu" role="menu" aria-labelledby="lang_dropdown">
                     <?php foreach ( $langs as $lang ) : ?>
                     <?php if ( ! $lang['active'] ) : ?>
                     <li role="presentation">
                        <a role="menuitem" tabindex="-1" href="<?php echo esc_url( $lang['url'] ); ?>">
                        <?php if ( stm_is_rental() and ! empty( $lang['country_flag_url'] ) ) : ?>
                        <img src="<?php echo esc_url( $lang['country_flag_url'] ); ?>" alt="<?php esc_attr_e( 'Language flag', 'motors' ); ?>" />
                        <?php endif; ?>
                        <?php echo esc_attr( $lang['native_name'] ); ?>
                        </a>
                     </li>
                     <?php endif; ?>
                     <?php endforeach; ?>
                  </ul>
                  <?php
                     elseif ( is_author() ) :
                         $user = get_user_by( 'ID', get_current_user_id() );
                     
                         ?>
                  <ul class="dropdown-menu lang_dropdown_menu" role="menu" aria-labelledby="lang_dropdown">
                     <?php foreach ( icl_get_languages( 'skip_missing=0' ) as $val ) : ?>
                     <?php
                        $request_uri = str_replace( '/' . wpml_get_current_language() . '/', '/', apply_filters( 'stm_get_global_server_val', 'REQUEST_URI' ) );
                        if ( ! $val['active'] ) :
                            $mainUrl = $sitepress->language_url( $val['code'] );
                        
                            $url_append = '';
                            if ( is_multisite() ) {
                                $ms_slug     = get_blog_details()->path;
                                $request_uri = str_replace( $ms_slug, '', $request_uri );
                            }
                            ?>
                     <li role="presentation">
                        <a role="menuitem" tabindex="-1" href="<?php echo esc_url( $mainUrl . $request_uri ); ?>">
                        <?php if ( stm_is_rental() and ! empty( $val['country_flag_url'] ) ) : ?>
                        <img src="<?php echo esc_url( $val['country_flag_url'] ); ?>" alt="<?php esc_attr_e( 'Language flag', 'motors' ); ?>" />
                        <?php endif; ?>
                        <?php echo esc_attr( $val['native_name'] ); ?>
                        </a>
                     </li>
                     <?php endif; ?>
                     <?php endforeach; ?>
                  </ul>
                  <?php endif; ?>
               </div>
               <?php endif; ?>
               <?php endif; ?>
               <?php stm_getCurrencySelectorHtml(); ?>
               <!-- Header Top bar Login -->
               <?php if ( ! empty( $top_bar_login ) and $top_bar_login ) : ?>
               <?php
                  if ( ! is_listing() ) :
                      ?>
               <?php if ( class_exists( 'WooCommerce' ) ) : ?>
               <div class="pull-right hidden-xs">
                  <div class="header-login-url">
                     <?php if ( is_user_logged_in() ) : ?>
                     <?php if ( ! stm_is_rental() ) : ?>
                     <a class="logout-link 111" href="<?php echo esc_url( wp_logout_url( home_url() ) ); ?>" title="<?php _e( 'Log out', 'motors' ); ?>">
                     <i class="fa fa-icon-stm_icon_user"></i>
                     <?php _e( 'Log out', 'motors' ); ?>
                     </a>
                     <?php else : ?>
                     <div class="stm-rent-lOffer-account-unit-main">
                        <a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>" class="stm-rent-lOffer-account-main">
                           <?php
                              if ( is_user_logged_in() ) :
                                  $user_fields = stm_get_user_custom_fields( '' );
                                  if ( ! empty( $user_fields['image'] ) ) :
                                      ?>
                           <div class="stm-dropdown-user-small-avatar">
                              <img src="<?php echo esc_url( $user_fields['image'] ); ?>" class="im-responsive"/>
                           </div>
                           <?php endif; ?>
                           <?php endif; ?>
                           <i class="stm-service-icon-user"></i>
                        </a>
                     </div>
                     <?php endif; ?>
                     <?php else : ?>
                     <a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>">
                     <i class="fa fa-user"></i><span class="vt-top"><?php _e( 'Login', 'motors' ); ?></span>
                     </a>
                     <span class="vertical-divider"></span>
                     <a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>"><?php _e( 'Register', 'motors' ); ?></a>
                     <?php endif; ?>
                  </div>
               </div>
               <?php endif; ?>
               <?php else : ?>
               <?php
                  $login_page = get_theme_mod( 'login_page', 1718 );
                  $login_page = stm_motors_wpml_is_page( $login_page );
                  ?>
               <?php if ( ! empty( $login_page ) ) : ?>
               <div class="pull-right">
                  <div class="header-login-url">
                     <div class="custom_topbar_menu">
                        <div class="weather_icon menu_items">
                           <div class="weather_box ookk">
                              <?php
                                 // do_shortcode( '[ubermenu-search]' );
                                 echo do_shortcode( '[wd_asp id=4]' );
                                 ?>
                           </div>
                        </div>
                        <span style="display: none;" class="vertical-divider"></span>
                        <div class="account_icon menu_items">
                           <span class=""><i class="fa fa-user" title="account"></i></span>
                           <div class="account-wrapper item_wrapper">
                              <?php if ( is_user_logged_in() ) : ?>
                              <div class="btn_container container_login">
                                 <a class="logout-link 222 custom_btn btn_reg btn_account" href="<?php echo get_author_posts_url( get_current_user_id() ); ?>" title="<?php _e( 'My Account', 'motors' ); ?>">
                                 <i class="fa fa-icon-stm_icon_user"></i>
                                 <?php _e( 'My Account', 'motors' ); ?>
                                 </a>
                                 <a class="logout-link 222 custom_btn btn_login btn_logout" href="<?php echo esc_url( wp_logout_url( home_url() ) ); ?>" title="<?php _e( 'Log out', 'motors' ); ?>">
                                 <i class="fa fa-icon-stm_icon_user"></i>
                                 <?php _e( 'Log out', 'motors' ); ?>
                                 </a>
                              </div>
                              <hr class="line">
                              <?php else : ?>
                              <div class="account_text">Join hd-central.com today and have accesss to technical,community,products,OEM Parts lookups,manuals and much more.</div>
                              <div class="btn_container">
                                 <a class="custom_btn btn_reg" href="<?php echo site_url() . '/newregister/'; ?>"><?php _e( 'Sign Up', 'motors' ); ?></a>
                                 <a class="custom_btn btn_login" href="<?php echo site_url() . '/newlogin/'; ?>">
                                 <span class="vt-top"><?php _e( 'Login', 'motors' ); ?></span>
                                 </a>
                              </div>
                              <hr class="line">
                              <?php endif; ?>
                           </div>
                        </div>
                        <div class="shoppingcart_shortcode menu_items">
                           <div class="weather_box">
                              <?php echo do_shortcode( '[cart_button show_items="true"]' ); ?>
                           </div>
                        </div>
                        <!--<span class="vertical-divider"></span>-->
                        <!--<div class="envelope_icon menu_items">
                           <span class=""><i class="fa fa-envelope" aria-hidden="true" title="mail"></i></span>
                           <div class="env_wrapper item_wrapper">
                               <div class="mail_text">
                                   <p>Sign up to receive the Christe's weekly art news update and our personalised weekly Christe's auction update. You can unsubscribe at any time by clicking on the unsubscribe link in out emails.</p>
                               </div>
                               <div class="mail_box">
                                   <?php // echo do_shortcode( '[mc4wp_form id="1470"]' ); ?>
                               </div>
                           </div>
                           </div>-->                                      
                     </div>
                     <?php
                        /*
                        ?><?php if(is_user_logged_in()): ?>
                     <a class="logout-link 222 " style="margin-right: 10px;" href="<?php echo get_author_posts_url( get_current_user_id()); ?>" title="<?php _e('My Account', 'motors'); ?>">
                     <i class="fa fa-icon-stm_icon_user"></i>
                     <?php _e('My Account', 'motors'); ?>
                     </a>
                     <a class="logout-link 222" href="<?php echo esc_url(wp_logout_url(home_url())); ?>" title="<?php _e('Log out', 'motors'); ?>">
                     <i class="fa fa-icon-stm_icon_user"></i>
                     <?php _e('Log out', 'motors'); ?>
                     </a>
                     <?php else: ?>
                     <a href="<?php echo esc_url(get_permalink( $login_page )); ?>">
                     <i class="fa fa-user"></i><span class="vt-top"><?php _e('Login', 'motors'); ?></span>
                     </a>
                     <span class="vertical-divider"></span>
                     <a href="<?php echo esc_url(get_permalink( $login_page )); ?>"><?php _e('Register', 'motors'); ?></a>
                     <?php endif; ?><?php */
                        ?>
                  </div>
               </div>
               <?php endif; ?>
               <?php endif; ?>
               <?php endif; ?>
               <?php
                  $top_bar_address        = get_theme_mod( 'top_bar_address', '1010 Moon ave, New York, NY US' );
                  $top_bar_address_mobile = get_theme_mod( 'top_bar_address_mobile', true );
                  
                  $top_bar_working_hours        = get_theme_mod( 'top_bar_working_hours', 'Mon - Sat 8.00 - 18.00' );
                  $top_bar_working_hours_mobile = get_theme_mod( 'top_bar_working_hours_mobile', true );
                  
                  $top_bar_phone        = get_theme_mod( 'top_bar_phone', '+1 212-226-3126' );
                  $top_bar_phone_mobile = get_theme_mod( 'top_bar_phone_mobile', true );
                  
                  $top_bar_menu = get_theme_mod( 'top_bar_menu', false );
                  
                  if ( $top_bar_menu ) :
                      ?>
               <div class="pull-right">
                  <div class="top_bar_menu">
                     <?php // get_template_part('partials/top-bar', 'menu'); ?>
                  </div>
               </div>
               <?php
                  endif;
                  
                              if ( $top_bar_address || $top_bar_working_hours || $top_bar_phone ) :
                                  ?>
               <div class="pull-right xs-pull-left">
                  <ul class="top-bar-info clearfix">
                     <?php if ( $top_bar_working_hours ) { ?>
                     <li 
                        <?php
                           if ( ! $top_bar_working_hours_mobile ) {
                               ?>
                        class="hidden-info"<?php } ?>><i class="fa fa-clock-o"></i><?php stm_dynamic_string_translation_e( 'Top Bar Working Hours Label', $top_bar_working_hours ); ?></li>
                     <?php } ?>
                     <?php if ( $top_bar_address ) { ?>
                     <?php $header_address_url = get_theme_mod( 'header_address_url' ); ?>
                     <li 
                        <?php
                           if ( ! $top_bar_address_mobile ) {
                               ?>
                        class="hidden-info"<?php } ?>>
                        <span id="top-bar-address" class="fancy-iframe" data-iframe="true" data-src="<?php echo esc_attr( $header_address_url ); ?>">
                        <i class="fa fa-map-marker"></i> <?php stm_dynamic_string_translation_e( 'Top Bar Address', $top_bar_address ); ?>
                        </span>
                     </li>
                     <?php } ?>
                     <?php if ( $top_bar_phone ) { ?>
                     <li 
                        <?php
                           if ( ! $top_bar_phone_mobile ) {
                               ?>
                        class="hidden-info"<?php } ?>><i class="fa fa-phone"></i> <a href="tel:<?php echo esc_attr( $top_bar_phone ); ?>"><?php stm_dynamic_string_translation_e( 'Top Bar Phone', $top_bar_phone ); ?></a></li>
                     <?php } ?>
                  </ul>
               </div>
               <?php endif; ?>
            </div>
         </div>
         <?php endif; ?>
         <div class="header-help-bar-trigger  hidden-sm hidden-xs">
            <i class="fa fa-chevron-down"></i>
         </div>
         <div class="header-help-bar  hidden-sm hidden-xs">
            <ul>
               <?php if ( ! empty( $compare_page ) && $showCompare ) : ?>
               <li class="help-bar-compare">
                  <a
                     href="<?php echo esc_url( get_the_permalink( $compare_page ) ); ?>"
                     title="<?php esc_attr_e( 'Watch compared', 'motors' ); ?>">
                  <span class="list-label heading-font"><?php esc_html_e( 'Compare', 'motors' ); ?></span>
                  <i class="list-icon stm-icon-speedometr2"></i>
                  <span class="list-badge"><span class="stm-current-cars-in-compare"
                     data-contains="compare-count"></span></span>
                  </a>
               </li>
               <?php endif; ?>
               <?php if ( ! empty( $woocommerce_shop_page_id ) && ! stm_is_listing_four() ) : ?>
               <?php $items = WC()->cart->cart_contents_count; ?>
               <!--Shop archive-->
               <li class="help-bar-shop">
                  <a
                     href="<?php echo esc_url( $woocommerce_shop_page_id ); ?>"
                     title="<?php esc_attr_e( 'Watch shop items', 'motors' ); ?>"
                     >
                  <span class="list-label heading-font"><?php esc_html_e( 'Cart', 'motors' ); ?></span>
                  <i class="list-icon stm-icon-shop_bag"></i>
                  <span class="list-badge"><span
                     class="stm-current-items-in-cart">
                  <?php
                     if ( $items != 0 ) {
                         echo esc_attr( $items );
                     }
                     ?>
                  </span></span>
                  </a>
               </li>
               <?php endif; ?>
               <?php if ( stm_is_listing_four() ) : ?>
               <?php
                  $header_listing_btn_link = get_theme_mod( 'header_listing_btn_link', '/add-a-car' );
                  $header_listing_btn_text = get_theme_mod( 'header_listing_btn_text', esc_html__( 'Add your item', 'motors' ) );
                  ?>
               <?php if ( ! empty( $header_listing_btn_link ) and ! empty( $header_listing_btn_text ) ) : ?>
               <li>
                  <a href="<?php echo esc_url( $header_listing_btn_link ); ?>" class="listing_add_cart heading-font">
                  <span class="list-label heading-font">
                  <?php stm_dynamic_string_translation_e( 'Listing Button Text', $header_listing_btn_text ); ?>
                  </span>
                  <i class="<?php echo 'stm-service-icon-listing_car_plus'; ?>"></i>
                  </a>
               </li>
               <?php endif; ?>
               <?php endif; ?>
               <!--Live chat-->
               <li class="help-bar-live-chat">
                  <a
                     id="chat-widget"
                     title="<?php esc_attr_e( 'Open Live Chat', 'motors' ); ?>"
                     >
                  <span class="list-label heading-font"><?php esc_html_e( 'Live chat', 'motors' ); ?></span>
                  <i class="list-icon stm-icon-chat2"></i>
                  </a>
               </li>
               <?php if ( ! stm_is_listing_four() ) : ?>
               <li class="nav-search">
                  <a href="" data-toggle="modal" data-target="#searchModal"><i class="stm-icon-search"></i></a>
               </li>
               <?php endif; ?>
            </ul>
         </div>
      </div>
      <div style="">
         <div class="container-fluid">
            <?php //ubermenu( 'main', array( 'theme_location' => 'primary' ) ); ?>
            <!-- CONTAINER HEADER: BOTTOM-ROW (NAVIGATION ROW) -->
              


          <div class="container dura-container nav-container" id="trget" style="margin-bottom: 50px; display:none;">
          <div class="row header-bottom-row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding" style="padding:0;">
     









              <nav class="navbar navbar-inverse navbar-static-top">
                <div class="container-fluid">
                  <!-- Brand and toggle get grouped for better mobile display -->
                  <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                    </button>
                    <!--a class="navbar-brand" href="#">Brand</a-->
                  </div>

                  <!-- Collect the nav links, forms, and other content for toggling -->
                  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav" id="targetuse">
                      <li class="dropdown active-shopping"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Home</a>
                       
                      
                      
                      <!-- BOOTSTRAP CLASSIC DROPDOWN -->
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                          News and Articles<span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                          <li><a href="#">HDC Magazine</a></li>
                          <li><a href="#">Archives </a></li>
                          <!-- <li><a href="#">Something else here</a></li>
                          <li role="separator" class="divider"></li>
                          <li class="dropdown-header">Nav header</li>
                          <li><a href="#">Separated link</a></li>
                          <li><a href="#">One more separated link</a></li> -->
                        </ul>
                      </li>
                      <!-- /BOOTSTRAP CLASSIC DROPDOWN -->

                        <!-- BOOTSTRAP General  DROPDOWN -->
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                         General <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                          <li><a href="https://www.hd-central.com/2022-new-harley-davidson-models-line-up/
">2022 Model Line-up </a></li>
                          <li><a href=" https://www.hd-central.com/2021_models/">1938 – 2021 Model Specs</a></li>
                          <li><a href="#">Harley-Davidson Racing</a></li>
                          <li><a href="#">Harley-Davidson History</a></li>
                          <li><a href="#">Harley-Davidson Collaborations </a></li>
                        </ul>
                      </li>
                      <!-- /BOOTSTRAP General  DROPDOWN -->

                      <!-- BOOTSTRAP Technical   DROPDOWN -->
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                         Technical  <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                          <li><a href="https://www.hd-central.com/oem-parts-finder/">OEM Parts Finder</a></li>
                          <li><a href="https://www.hd-central.com/harley-davidson-manuals/">Harley-Davidson Manuals</a></li>
                          <li><a href="#">Servicing, Maintenance and DIY Tech</a></li>
                          <li><a href="https://www.hd-central.com/tech_live_24/">DIY by Model – Videos and Links</a></li>
                        </ul>
                      </li>
                      <!-- /BOOTSTRAP Technical   DROPDOWN -->

                       <!-- BOOTSTRAP Directory  DROPDOWN -->
                      <li class="dropdown">
                        <a href="https://www.hd-central.com/directory-list/" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                         Directory  <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                          <li><a href="#" id="root">Servicing, Repairs, Parts, and Other <br>Services Directory Listings</a></li>
                        </ul>
                      </li>
                      <!-- /BOOTSTRAP Directory   DROPDOWN -->

                      <!-- BOOTSTRAP Marketplace  DROPDOWN -->
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                         Marketplace  <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                          <li><a href=" https://www.hd-central.com/harley-davidson-for-sale/ ">Harley-Davidson Bikes for Sale</a></li>
                          <li><a href="https://www.hd-central.com/harley-davidsons-parts-accessories-clothing-for-sale/" id="root">Harley-Davidson Parts and Accessories <br>for Sale</a></li>
                          <li><a href="https://www.hd-central.com/offers-list/">Special Offers, Coupons and Discounts</a></li>
                          <li><a href="https://www.hd-central.com/rent_a_harley_davidson/">Harley-Davidson Rentals </a></li>
                          <li><a href="#">Finance</a></li>
                          <li><a href="#">Insurance</a></li>
                        </ul>
                      </li>
                      <!-- /BOOTSTRAP Marketplace  DROPDOWN -->

                      <!-- BOOTSTRAP Community  DROPDOWN -->
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                         Community <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                          <li><a href="#">Event Listings</a></li>
                          <li><a href="#">Harley-Davidson Clubs and Local Groups</a></li>
                          <li><a href="#">Places to Visit</a></li>
                          <li><a href="#">Legends</a></li>
                          <li><a href="#">Personalities</a></li>
                          
                        </ul>
                      </li>
                      <!-- /BOOTSTRAP Community  DROPDOWN -->

                      <!-- BOOTSTRAP Log In DROPDOWN -->
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="ubermenu-icon fas fa-user"></i>
                        </a>
                      
                         <ul class="dropdown-menu" id="code">
                          <li><a href="#">Sign-Up</a></li>
                          <li><a href="#">Login</a></li>
                          
                          
                        </ul>

                      </li>

                      <!-- <li id="menu-item-42288" class="ubermenu-item ubermenu-item-type-custom ubermenu-item-object-custom ubermenu-item-has-children ubermenu-item-42288 ubermenu-item-level-0 ubermenu-column ubermenu-column-auto ubermenu-align-right ubermenu-has-submenu-drop ubermenu-has-submenu-mega"><span class="ubermenu-target ubermenu-target-with-icon ubermenu-item-layout-default ubermenu-item-layout-icon_left ubermenu-noindicator ubermenu-item-notext" tabindex="0"><i class="ubermenu-icon fas fa-user"></i><span class="ubermenu-sub-indicator-close"><span class="ubermenu-icon ubermenu-icon-essential ubermenu-icon-essential-times"><svg class="ubermenu-icon-svg-times"><use xlink:href="#ubermenu-icon-times"></use></svg></span></span></span><ul class="ubermenu-submenu ubermenu-submenu-id-42288 ubermenu-submenu-type-auto ubermenu-submenu-type-mega ubermenu-submenu-drop ubermenu-submenu-align-right_edge_bar"><li id="menu-item-42297" class="ubermenu-item ubermenu-item-type-custom ubermenu-item-object-custom ubermenu-item-42297 ubermenu-item-auto ubermenu-item-header ubermenu-item-level-1 ubermenu-column ubermenu-column-auto"><a class="ubermenu-target ubermenu-target-with-icon ubermenu-item-layout-default ubermenu-item-layout-icon_left" href="https://hd-central.com/user-redirect/"><i class="ubermenu-icon fas fa-user"></i><span class="ubermenu-target-title ubermenu-target-text">My Account</span></a></li><li id="menu-item-42307" class="ubermenu-item ubermenu-item-type- ubermenu-item-object-logout ubermenu-item-42307 ubermenu-item-auto ubermenu-item-header ubermenu-item-level-1 ubermenu-column ubermenu-column-auto"><a class="ubermenu-target ubermenu-target-with-icon ubermenu-item-layout-default ubermenu-item-layout-icon_left" href="https://www.hd-central.com/wp-login.php?action=logout&redirect_to=https%3A%2F%2Fwww.hd-central.com&_wpnonce=da225abb80"><i class="ubermenu-icon fas fa-sign-out-alt"></i><span class="ubermenu-target-title ubermenu-target-text">Logout</span></a></li></ul></li> -->
                      <!-- /BOOTSTRAP Log In DROPDOWN -->

                    </ul>


<!-- NEW STYLE MENU-->







                  </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
              </nav>
            </div>
          </div>          
        </div>



        <div class="container-fluid" id="blog">
          <div class="row">
            <div class="col-lg-12">
              

              <link rel="stylesheet" href="<?php bloginfo('url'); ?>/wp-content/themes/motors-child/partials/header/css/main.css">
                  <link rel="stylesheet" href="<?php bloginfo('url'); ?>/wp-content/themes/motors-child/partials/header/css/pcss3mm.css">
                  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans">   
              <!-- <ul class="pcss3mm">
                
                <li>
                  <a href="#"><i class="icon-home"></i>Home</a>
                </li>
             
                <li class="dropdown">
                  <a href="#" class="active"><i class="icon-star"></i>About</a><b></b>
                  <div class="grid-container3">
                    <ul>
                      <li class="dropdown">
                        <a href="#" class="active"><i class="icon-bullhorn"></i>News</a>
                        <div class="grid-container3">
                          <ul>
                            <li><a href="#"><i class="icon-ok"></i>Company</a></li>
                            <li><a href="#"><i class="icon-ok"></i>Products</a></li>
                            <li><a href="#"><i class="icon-ok"></i>Specials</a></li>
                          </ul>
                        </div>
                      </li>
                      <li><a href="#"><i class="icon-globe"></i>Mission</a></li>
                      <li class="dropdown">
                        <a href="#"><i class="icon-group"></i><b></b>Our Team</a>
                        <div class="grid-container3">
                          <ul>
                            <li class="dropdown">
                              <a href="#">Markus Fisher</a>
                              <div class="grid-container3">
                                <ul>
                                  <li><a href="#">About</a></li>
                                  <li><a href="#">Skills</a></li>
                                  <li><a href="#">Contacts</a></li>
                                </ul>
                              </div>
                            </li>
                            <li class="dropdown">
                              <a href="#">Leyla Sparks</a>
                              <div class="grid-container3">
                                <ul>
                                  <li><a href="#">About</a></li>
                                  <li><a href="#">Skills</a></li>
                                  <li><a href="#">Contacts</a></li>
                                </ul>
                              </div>
                            </li>
                            <li><a href="#">Gleb Ismailov</a></li>
                            <li><a href="#">Viktoria Gibbers</a></li>
                          </ul>
                        </div>
                      </li>
                      <li><a href="#"><i class="icon-trophy"></i>Rewards</a></a></li>
                      <li><a href="#"><i class="icon-certificate"></i>Certificates</a></a></li>
                    </ul>
                  </div>
                </li>
                
                <li class="dropdown">
                  <a href="#"><i class="icon-briefcase"></i>Portfolio</a><b></b>
                  <div class="grid-container3">
                    <ul>
                      <li><a href="#"><i class="icon-lemon"></i>Logos</a></li>
                      <li><a href="#"><i class="icon-globe"></i>Websites</a></li>
                      <li><a href="#"><i class="icon-th-large"></i>Branding</a></li>
                      <li><a href="#"><i class="icon-picture"></i>Illustrations</a></li>
                    </ul>
                  </div>
                </li>
                
                <li>
                  <a href="#"><i class="icon-phone"></i>Contacts</a><b></b>
                </li>
               
                <li class="right dropdown">
                  <a href="#"><i class="icon-envelope"></i>Drop me a line</a><b></b>
                  <div class="grid-container6">
                    <form action="">
                      <input type="text" placeholder="Enter your name">
                      <input type="text" placeholder="Enter your email">
                      <textarea cols="1" rows="1" placeholder="Enter your message"></textarea>
                      <button type="submit">Submit</button>
                    </form>
                  </div>
                </li>
          
              </ul> -->
<script>
function myFunction() {
  var x = document.getElementById("close-toggle");
  var y = document.getElementById("abc");
  if (x.style.display === "block") {
    x.style.display = "none";
     y.classList.toggle("icon-reorder");

  } else {
    x.style.display = "block";
    

  }
}
function myFunction1(x) {
   x.classList.remove("icon-reorder");
            x.classList.toggle("icon-minus");
        }
</script>


              <ul id="pcss3mm" class="pcss3mm pcss3mm-collapsable" style="margin-top: 20px;">   
                 <!-- opener (requiered) -->
        <li class="opener" onclick="myFunction()"  style="padding-left: 13px;">
        <i class="icon-reorder" id="abc" onclick="myFunction1(this)"></i> 
        </li>
        <!--/ opener -->
        <!-- home -->
        <div id="close-toggle">
        <li>
          <a href="#"><i class="icon-home"></i>Home</a>
        </li>
        <!--/ home -->
        
       
        
        
        <!-- about -->
        <li class="dropdown">
          <a href="#" class="active"><i class="icon-book"></i>NEWS AND ARTICLES</a><b></b>
          <div class="grid-container3">
            <!-- <ul>
              <li class="dropdown">
                <a href="#" class="active"><i class="icon-bullhorn"></i>News</a>
                <div class="grid-container3">
                  <ul>
                    <li><a href="https://www.hd-central.com/october/"><i class="icon-ok"></i>HDC Magazine</a></li>
                    <li><a href="#"><i class="icon-ok"></i>Archives</a></li>
                  
                  </ul>
                </div>
              </li>
              <li><a href="#"><i class="icon-globe"></i>Mission</a></li>
              <li class="dropdown">
                <a href="#"><i class="icon-group"></i><b></b>Our Team</a>
                <div class="grid-container3">
                  <ul>
                    <li class="dropdown">
                      <a href="#">Markus Fisher</a>
                      <div class="grid-container3">
                        <ul>
                          <li><a href="#">About</a></li>
                          <li><a href="#">Skills</a></li>
                          <li><a href="#">Contacts</a></li>
                        </ul>
                      </div>
                    </li>
                    <li class="dropdown">
                      <a href="#">Leyla Sparks</a>
                      <div class="grid-container3">
                        <ul>
                          <li><a href="#">About</a></li>
                          <li><a href="#">Skills</a></li>
                          <li><a href="#">Contacts</a></li>
                        </ul>
                      </div>
                    </li>
                    <li><a href="#">Gleb Ismailov</a></li>
                    <li><a href="#">Viktoria Gibbers</a></li>
                  </ul>
                </div>
              </li>
              <li><a href="#"><i class="icon-trophy"></i>Rewards</a></li>
              <li><a href="#"><i class="icon-certificate"></i>Certificates</a></li>
            </ul> -->
          </div>
        </li>
        <!--/ about -->
        
        <!-- portfolio -->
        <li class="dropdown">
          <a href="#"><i class="icon-bookmark-empty"></i>GENERAL</a><b></b>
         <!--  <div class="grid-container3">
            <ul>
              <li><a href="#">2022 Model Line-up </a></li>
              <li><a href="#">1938 – 2021 Model Specs</a></li>
              <li><a href="#">Harley-Davidson Racing</a></li>
              <li><a href="#">Harley-Davidson History</a></li>
               <li><a href="#">Harley-Davidson Collaborations</a></li>
            </ul>
          </div> -->
          <div class="box-part">
            <div class="d-flex-part">
              <div class="col-box-2"><ul>
              <li><a href="#">Name Menu </a></li>
              <li><a href="#">Name Menu</a></li>
              <li><a href="#">Name Menu</a></li>
              <li><a href="#">Name Menu</a></li>
               <li><a href="#">Name Menu</a></li>
            </ul>
          </div>
              <div class="col-box-2"><ul>
              <li><a href="#">Name Menu </a></li>
              <li><a href="#">Name Menu</a></li>
              <li><a href="#">Name Menu</a></li>
              <li><a href="#">Name Menu</a></li>
               <li><a href="#">Name Menu</a></li>
            </ul>
          </div>
              <div class="col-box-2">
                <ul>
              <li><a href="#">Name Menu </a></li>
              <li><a href="#">Name Menu</a></li>
              <li><a href="#">Name Menu</a></li>
              <li><a href="#">Name Menu</a></li>
               <li><a href="#">Name Menu</a></li>
            </ul>
              </div>
              <div class="col-box-2">
                <ul>
              <li><a href="#">Name Menu </a></li>
              <li><a href="#">Name Menu</a></li>
              <li><a href="#">Name Menu</a></li>
              <li><a href="#">Name Menu</a></li>
               <li><a href="#">Name Menu</a></li>
            </ul>
              </div>
              <div class="col-box-2">
                <ul>
              <li><a href="#">Name Menu </a></li>
              <li><a href="#">Name Menu</a></li>
              <li><a href="#">Name Menu</a></li>
              <li><a href="#">Name Menu</a></li>
               <li><a href="#">Name Menu</a></li>
            </ul>
              </div>

            </div>
          </div>
        </li>
        <li class="dropdown">
          <a href="#"><i class="icon-cog"></i>TECHNICAL</a><b></b>
          <div class="grid-container3">
            <ul>
              <li><a href="#">OEM Parts Finder</a></li>
              <li><a href="#">Harley-Davidson Manuals</a></li>
              <li><a href="https://www.hd-central.com/tech_live_24/">Servicing, Maintenance and DIY Tech</a></li>
              <li><a href="#">DIY by Model – Videos etc  </a></li>
           
            </ul>
          </div>
        </li>

        <li class="dropdown">
          <a href="#"><i class="icon-map-marker"></i>DIRECTORY</a><b></b>
          <div class="grid-container3">
            <ul>
              <li><a href="https://www.hd-central.com/directory-list/">Servicing, Repairs Parts and Business Directory </a></li>
              
           
            </ul>
          </div>
        </li>


        <li class="dropdown">
          <a href="#"><i class="icon-shopping-cart"></i>MARKETPLACE</a><b></b>
          <div class="grid-container3">
            <ul>
              <li><a href="https://www.hd-central.com/harley-davidson-for-sale/">Bikes for Sale</a></li>
              <li><a href="https://www.hd-central.com/harley-davidsons-parts-accessories-clothing-for-sale/">Parts and Accessories for Sale</a></li>
              <li><a href="#">Special Offers and Discounts</a></li>
              <li><a href="#">Harley-Davidson Rentals</a></li> 
              <li><a href="#">Finance</a></li>
              <li><a href="#">Insurance</a></li>
           
            </ul>
          </div>
        </li>


         <li class="dropdown">

          <a href="#"><i class="icon-heart"></i>COMMUNITY</a><b></b>
          <div class="grid-container3">
            <ul>
              <li><a href="#">Event Listings </a></li>
              <li><a href="#">Clubs and Local Groups</a></li>
              <li><a href="#">Places to Visit </a></li>
              <li><a href="#">Legends </a></li> 
              <li><a href="#">Finance</a></li>
              <li><a href="#">Personalities</a></li>
           
            </ul>
          </div>
        </li>
        <!--/ portfolio -->
        
        <!-- contacts -->
        <!-- <li>
          <a href="#"><i class="icon-phone"></i>Contacts</a><b></b>
        </li> -->
        <!--/ contacts -->
        
        <!-- share -->
        <li class="right dropdown right-part-icon">
          <a href="#"><i class="icon-user"></i></a><b></b>
          <div class="grid-container3">
            <ul>
              <li><a href="#"><i class="icon-user"></i>SIGN-UP</a></li>
              <li><a href="#"><i class="icon-signin"></i>lOGIN</a></li>
           
            </ul>
          </div>
        </li>
        <!--/ share -->
      </div>
      </ul>

            </div>
          </div>
        </div>




      </div>
   </div>
</div>











<script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>