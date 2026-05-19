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
div#asset {
    width: 100%;
    max-width: 100%;
    padding: 0;
    margin: 0;
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
div#asset-1 {
    padding: 0;
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
    text-align: right !important; 
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
                              <div class="account_text">Signing in to HD Central will allow you to customise your feed and enjoy a better all-round experience.</div>
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
              


        
            <div class="container dura-container nav-container" id="asset" >
          <div class="row header-bottom-row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding" id="asset-1">
     
              <nav class="navbar navbar-inverse navbar-static-top">
                <div class="container-fluid">
                 
                  <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                    </button>
                   
                  </div>

                  
                  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                      <li class="dropdown active-shopping"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="ubermenu-icon fas fa-home" style="padding:0 10px"></i></i>Home <!-- <span class="caret"></span> --></a></li>
                        
                      <!-- /TABBED MENU - CUSTOM WIDTH -->

                      <!-- MEGA MENU CLASSIC -->
                      <li class="dropdown dropdown-mega"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="ubermenu-icon fas fa-book" style="padding:0 10px"></i>Magazine  <span class="caret"></span></a>
                        <div class="dropdown-menu dropdown-mega-content">
                          <div class="row" style="padding: 20px; padding-bottom: 0">
                            
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                              <h3 id="metas">Magazine and News</h3>
                              <ul>
                                <li><a href="#">Latest and trending posts</a></li>
                                <li><a href="#">News from Milwaukee</a><!-- <span class="badge-color-1">New</span> --></li>
                                <li><a href="#">Articals from around the world</a></li>
                                <li><a href="#">Meet the editional team</a></li>
                                <!-- <li><a href="#">Bra &amp; Brief Sets</a><span class="badge-color-2">Sale</span></li> -->
                              </ul>
                            </div>
                            
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                              <h3 id="metas">hd-central.com Archives</h3>
                              <ul>
                                <li><a href="#">Check out our old post and news </a></li>
                                <!-- <li><a href="#">Shorts</a></li>
                                <li><a href="#">Jeans</a></li>
                                <li><a href="#">Pants &amp; Capris</a><span class="badge-color-1">New</span></li>
                                <li><a href="#">Leggings</a></li> -->
                              </ul>
                            </div>
                                  
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                              <h3 id="metas">Lets here from you !</h3>
                              <ul>
                                <li><a href="#">Submit your articles and posts and get Amazon voucher !</a></li>
                                <!-- <li><a href="#">Hoodies &amp; Sweatshirts</a></li>
                                <li><a href="#">Basic Jackets</a></li>
                                <li><a href="#">Trench</a><span class="badge-color-2">Sale</span></li>
                                <li><a href="#">Pullovers</a></li> -->
                              </ul>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                             
                              <img src="https://via.placeholder.com/224x170.png" class="img-responsive">
                            </div>
                          </div>
                        </div>
                      </li>
                      <!-- /MEGA MENU CLASSIC -->

                       <!-- MEGA MENU General C -->
                      <li class="dropdown dropdown-mega"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="ubermenu-icon far fa-bookmark" style="padding:0 10px"></i>General  <span class="caret"></span></a>
                        <div class="dropdown-menu dropdown-mega-content">
                          <div class="row" style="padding: 20px; padding-bottom: 0">
                            
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                              <h3 id="metas">Harley-Davidson Models</h3>
                              <ul>
                                <li><a href="https://www.hd-central.com/2022-new-harley-davidson-models-line-up/">2022 Model Line-up</a></li>
                                <li><a href="https://www.hd-central.com/2021_models/">2021 Model Line-up</a></li>
                                <li><a href="https://hd-central.com/bike_guide/">Model Guide 1945-2022</a></li>  
                              </ul>
                            </div>
                            
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                              <h3 id="metas">Harley-Davidson Legacy</h3>
                              <ul>
                                <li><a href="https://www.hd-central.com/origins/">Origins </a></li>
                                <li><a href="https://www.hd-central.com/founders/">Founders</a></li>
                              </ul>
                            </div>
                                  
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                              <h3 id="metas"><a href="https://www.hd-central.com/collaborations/" style="color:#333;">Harley-Davidson Legacy collaborations</a></h3>
                              <ul>
                                <li><a href="https://www.hd-central.com/collaborations/">Read about partnerships along the way</a></li>
                                
                              </ul>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                              <h3 id="metas"><a href="https://www.hd-central.com/harley-davidson-racing-history/" style="color:#333;">Harley-Davidson Legacy Racing</a></h3>
                              <ul>
                                <li><a href="#">Flat Track Racing</a></li>
                                <li><a href="#">Board Track Racing</a></li>
                                <li><a href="#">Drag Racing</a></li>
                                <li><a href="#">King off the Baggers</a></li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </li>
                      <!-- /MEGA MENU General  -->
                      
                      <!-- MEGA MENU TABBED -->
                      <li class="active dropdown tabbed-mega"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="ubermenu-icon fas fa-cog" style="padding:0 10px"></i>Technical  <span class="caret"></span></a>
                        <div class="dropdown-menu tabbed-menu tabbed-mega-menu tabbed-height-375">
                          <ul>
                           <li><a href="#" class="active-tab">Technical</a>
                              <div class="tabbed-menu-content active-tab-content container">
                                <div class="row">
                                  
                                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <h3 id="metas"><a href="https://www.hd-central.com/oem-parts-finder/" style="color:#333;"><b>Harley OEM Parts Finder&nbsp;</b><span class="glyphicon glyphicon-fire" aria-hidden="true"></span></a></h3>
                                    <ul>
                                      <li><a href="https://www.hd-central.com/oem-parts-finder/">Find Harley-Davidson OEM Part References and Diagrams</a></li>
                                      <li><a href="https://www.hd-central.com/oem-parts-finder/">Save your OEM Parts to your dashboard</a></li>
                                  
                                  </ul>
                                    <h3 id="metas"><a href="https://www.hd-central.com/harley-davidson-manuals/" style="color:#333;"><b>Harley-Davidson Manuals and Services Guides</b></a></h3>
                                    <ul>
                                      <li><a href="https://www.hd-central.com/harley-davidson-manuals/">Manuals and Guides 1923-2022</a></li>
                                      
                                    </ul>
                                  </div>
                                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <h3 id="metas"><a href="https://www.hd-central.com/tech_live_24/" style="color:#333;"><b>DIY Servicing and Basic Harley-Davidson Tech</b></a></h3>
                                    <ul>
                                      <li><a href="https://www.hd-central.com/tech_live_24/">Everything and more you need to know about maintaining your Harley-Davidson and more.....</a></li>
                                     
                                    </ul>
                                    <h3 id="metas">Harley-Davidson DIY Tech Channel</h3>
                                    <ul>
                                      <li><a href="#">Videos and tips by model</a></li>
                                      
                                    </ul>                                 
                                  </div>
                                  
                                </div>
                              </div>
                            </li>





                          </ul>
                        </div>
                        <!-- /TABBED MENU -->                     
                      </li>
                      <!-- MEGA MENU TABBED -->
                      
                      <!-- BOOTSTRAP CLASSIC DROPDOWN -->
                      <li class="dropdown">
                        <a href="https://www.hd-central.com/directory-list/" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                          <i class="ubermenu-icon fas fa-map-marker-alt" style="padding:0 10px"></i>HDC Directory
                        </a>
                        <!-- <ul class="dropdown-menu">
                          <li><a href="#">Action</a></li>
                          <li><a href="#">Another action</a></li>
                          <li><a href="#">Something else here</a></li>
                          <li role="separator" class="divider"></li>
                          <li class="dropdown-header">Nav header</li>
                          <li><a href="#">Separated link</a></li>
                          <li><a href="#">One more separated link</a></li>
                        </ul> -->
                      </li>

                    
                      
                      <!-- MEGA MENU TABBED -->
                      <li class="active dropdown tabbed-mega"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="ubermenu-icon fas fa-shopping-cart" style="padding:0 10px"></i>Marketplace <span class="caret"></span></a>
                        <div class="dropdown-menu tabbed-menu tabbed-mega-menu tabbed-height-375">
                          <ul>
                           <li><a href="https://www.hd-central.com/harley-davidson-for-sale/" class="active-tab">Bikes for Sale</a>
                              <div class="tabbed-menu-content active-tab-content container">
                                <div class="row">
                                  
                                  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <h3 id="metas"><a href="https://www.hd-central.com/add-your-bike-4-sale/" style="color:#333;"><b>Harley-Davidson Bikes for Sale&nbsp;</b><span class="glyphicon glyphicon-fire" aria-hidden="true"></span></a></h3>
                                    <ul>
                                      <li><a href="#">New Bikes</a></li>
                                      <li><a href="#">2nd Hand Bikes for Sale</a></li>
                                      <li><a href="#">Vintage Bikes for Sale</a></li>
                                      <li><a href="#">Antique Bikes for Sale</a></li>
                                      <li><a href="#">Bargain Bikes for Sale</a></li>
                                  
                                  </ul>
                                    <h3 id="metas">Sell your Harley-Davidson</h3>
                                    <ul>
                                      <li><a href="#">List your harley-davidson on hd-central.com</a></li>
                                      <li><a href="#">Sell your Harley-Davidson on consignment</a></li>
                                      <li><a href="#">Trade your Harley-Davidson for a new ride</a></li>
                                      <li><a href="#">Sell your Harley-Davidson for cash today</a></li>
                                      
                                    </ul>
                                  </div>
                                  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <h3 id="metas">Selling Guidiance</h3>
                                    <ul>
                                      <li><a href="#">Listing advice and tips</a></li>
                                      <li><a href="#">Bikes valuation and extras</a></li>
                                      <li><a href="#">Prepping our bike for inspections</a></li>
                                     
                                    </ul>
                                     <h3 id="metas">Buying Guidiance</h3>
                                    <ul>
                                      <li><a href="#">Bike Inspection</a></li>
                                      <li><a href="#">Paperwork and Vink checks</a></li>
                                      <li><a href="#">Foreign or long distance buys</a></li>
                                    </ul>                                 
                                  </div>
                                  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <img src="https://via.placeholder.com/200x300.png" class="img-responsive">
                                  </div>
                                </div>
                              </div>
                            </li>

                             <li><a href="https://www.hd-central.com/harley-davidsons-parts-accessories-clothing-for-sale/">Parts and Accessories</a>
                              <div class="tabbed-menu-content container">
                                <div class="row">
                                  
                                  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <h3 id="metas">Harley-Davidson Parts for Sale</h3>
                                    <ul>
                                      <li><a href="#">New OEM Parts for Sale</a></li>
                                      <li><a href="#">Second Hand OEM Parts for Sale</a></li>
                                      <li><a href="#">Aftermarket Parts for Sale-New</a></li>
                                      <li><a href="#">Aftermarket Parts for Sale-Old</a></li>
                                   
                                    </ul>
                                    <h3 id="metas">Harley-Davidson Accessories</h3>
                                    <ul>
                                      <li><a href="#">OEM Accessories</a></li>
                                      <li><a href="#">Aftermarket Accessories</a></li>
                                      <li><a href="#">Harley-Davidson Tech Accessories</a></li>
                                      <li><a href="#">Tools and Garage Equipment</a></li>
                                     
                                    </ul>
                                  </div>
                                  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <h3 id="metas">Harley-Davidson Tire Finder</h3>
                                    <ul>
                                      <li><a href="#">Specialist Tires</a></li>
                                      <li><a href="#">Touring Tires</a></li>
                                      <li><a href="#">Performance Tires</a></li>
                                      <li><a href="#">Whitewalls</a></li>
                                      
                                    </ul>
                                    <h3 id="metas">Clothing, Helmets and Protection</h3>
                                    <ul>
                                      <li><a href="#">Casual Clothing</a></li>
                                      <li><a href="#">Protective Clothing</a></li>
                                      <li><a href="#">Helmets</a></li>
                                      <li><a href="#">Riding Glasses and Optics</a></li>
                                      
                                    </ul>
                                  </div>
                                  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <img src="https://via.placeholder.com/200x300.png" class="img-responsive">
                                  </div>
                                </div>
                              </div>
                            </li>
                            
                            <li><a href="https://www.hd-central.com/offers-list/">Offers and Coupons</a>
                              <div class="tabbed-menu-content container">
                                <div class="row">
                                  
                                  <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                    <h3 id="metas">Parts and Accessories Promotions and Offers</h3>
                                    <ul>
                                      <li><a href="#">Manufactures Promotions</a></li>
                                      <li><a href="#">Business Special Offers</a></li>
                                      <li><a href="#">Sale and Clearance</a></li>
                                      <li><a href="#">Bargains</a></li>
                                     
                                    </ul>
                                  
                                    <h3 id="metas">Mancfacturer Rebates</h3>
                                    <ul>
                                      <li><a href="#">Tire Rebates and Cashback</a></li>
                                      <li><a href="#">Other Cashback Offers</a></li>
                                      
                                    </ul>
                                  
                                  </div>
                                 
                                  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                   <img src="https://via.placeholder.com/200x300.png" class="img-responsive">
                                  </div>
                                </div>
                              </div>
                            </li>
                             
                            
                            <li><a href="https://www.hd-central.com/rent_a_harley_davidson/">Harley-Davidson Rentals</a>
                              <div class="tabbed-menu-content container">
                                <div class="row">
                                  
                                  <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                    <h3 id="metas">Harley-Davidson Rentals</h3>
                                    <ul>
                                      <li><a href="#">Rent a Harley-Davidson anywhere in the world</a></li> 
                                    </ul>
                                  </div>
                                 
                                  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <img src="https://via.placeholder.com/200x300.png" class="img-responsive">
                                  </div>
                                </div>
                              </div>
                            </li>

                              <li><a href="https://www.hd-central.com/harley-davidsons-parts-accessories-clothing-for-sale/">Finance and Insurance</a>
                              <div class="tabbed-menu-content container">
                                <div class="row">
                                  
                                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <h3 id="metas">Finance your next Harley-Davidson</h3>
                                    <ul>
                                      <li><a href="#">Harley-Davidson Finance</a></li>
                                       <li><a href="#">Independent Finance</a></li>
                                     
                                    </ul>
                                  
                                    <h3 id="metas">Insurance</h3>
                                    <ul>
                                      <a href="#"><li>Find the best and cheapest insurance for your current or new Harley-Davidson </li></a>
                                      <li><a href="#">Insurance for riding in other countries</a></li>
                                      
                                    </ul>
                                  
                                  </div>
                                 
                                </div>
                              </div>
                            </li>


                          </ul>
                        </div>
                        <!-- /TABBED MENU -->                     
                      </li>
                      <!-- MEGA MENU TABBED -->



                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                          <i class="ubermenu-icon fas fa-heart" style="padding:0 10px"></i>Community 
                        </a>
                      </li>

                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding-left:50px;padding-right: 10px;">
                          Login 
                        </a>
                      </li>
                      <!-- /BOOTSTRAP CLASSIC DROPDOWN -->
                    </ul>
                  </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
              </nav>
            </div>
          </div>          
        </div>
         </div>




      </div>
   </div>
</div>













<script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>