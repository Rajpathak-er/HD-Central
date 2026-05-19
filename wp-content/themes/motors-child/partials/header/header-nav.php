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
      <div style="background:black">
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"  />
         <link rel="stylesheet" href="/demo/style.css">
         <!-- Demo CSS -->
         <link rel="stylesheet" href="/src/dist/css/navik-horizontal-default-menu.min.css">
         <!-- Navik navigation CSS -->
         <div
            class="navik-header header-shadow navik-mega-menu new-header-float" style="width: 100%;
            background-color: #000 !important;
            color: #fff;
            height: 50px;"
            >
            <div class="container">
               <div class="navik-header-container">
                  <div class="burger-menu">
                     <div class="line-menu line-half first-line"></div>
                     <div class="line-menu"></div>
                     <div class="line-menu line-half last-line"></div>
                  </div>
                  <nav class="navik-menu menu-caret submenu-top-border">
                     <ul class="menusub">
                        <li class="mega-menu">
                           <a
                              href="https://www.hd-central.com/"
                              class="active"
                              >
                           <i
                              class="fa-solid fa-house-user text-end"
                              ></i>
                           </a>
                        </li>
                        <li class="drop_down">
                           <a
                              href="https://www.hd-central.com/hdc-magazine_may_2023/"
                              >
                           <i class="fa-solid fa-book text-end"></i>
                           Magazine
                           </a>
                           <ul class="widthcover">
                              <li>
                                 <a
                                    href="https://hd-central.com/hdc-magazine-news-updates-products-and-more/"
                                    >
                                 Latest News, Posts, Products and More 
                                 </a>
                              </li>
                              <li>
                                 <a
                                    href="https://www.hd-central.com/submit-tech-articles-vids/"
                                    >
                                 Submit your articles and videos!
                                 </a>
                              </li>
                           </ul>
                        </li>
                        <li class="mega-menu" id="general">
                           <a href="#">
                           <i
                              class="fa-solid fa-bookmark text-end"
                              ></i>
                           General
                           </a>
                           <ul>
                              <li>
                                 <div class="mega-menu-container">
                                    <div class="row">
                                       <div class="col-md-6 col-lg-3">
                                          <div class="mega-menu-box">
                                             <ul class="mega-menu-list">
                                                <li>
                                                   <a
                                                      href="https://www.hd-central.com/harley-davidson-models/"
                                                      >
                                                   <strong>
                                                   Harley-Davidson Models
                                                   </strong>
                                                   </a>
                                                </li>
                                                 <li>
                                                   <a
                                                      href="https://www.hd-central.com/2024-new-harley-davidson-model-line-up/"
                                                      >
                                                   2024 Models Line-up
                                                   </a>
                                                </li>
                                                <li>
                                                   <a
                                                      href="https://www.hd-central.com/2023-new-harley-davidson-model-line-up/"
                                                      >
                                                   2023 Models Line-up
                                                   </a>
                                                </li>
                                                <li>
                                                   <a
                                                      href="https://www.hd-central.com/2022-new-harley-davidson-models-line-up/"
                                                      >
                                                   2022 Models Line-up
                                                   </a>
                                                </li>
                                                <li>
                                                   <a
                                                      href="https://www.hd-central.com/2021_models/"
                                                      >
                                                   2021 Models Line-up
                                                   </a>
                                                </li>
                                                <li>
                                                   <a
                                                      href="https://www.hd-central.com/bike_guide/"
                                                      >
                                                   Model Guide 1945 - 2022
                                                   </a>
                                                </li>
                                             </ul>
                                          </div>
                                       </div>
                                       <div class="col-md-6 col-lg-3">
                                          <div class="mega-menu-box">
                                             <ul class="mega-menu-list">
                                                <li>
                                                   <a
                                                      href="#"
                                                      >
                                                   <strong>
                                                   Harley-Davidson Legacy
                                                   </strong>
                                                   </a>
                                                </li>
                                                <li>
                                                   <a
                                                      href="https://www.hd-central.com/origins/"
                                                      >
                                                   Origins
                                                   </a>
                                                </li>
                                                <li>
                                                   <a
                                                      href="https://www.hd-central.com/founders/"
                                                      >
                                                   Founders
                                                   </a>
                                                </li>
                                                <li>
                                                   <a
                                                      href="https://www.hd-central.com/collaborations/"
                                                      >
                                                   Collaborations
                                                   </a>
                                                </li>
                                             </ul>
                                          </div>
                                       </div>
                                       <div class="col-md-6 col-lg-3">
                                          <div class="mega-menu-box">
                                             <ul class="mega-menu-list">
                                                <li>
                                                   <a
                                                      href="https://www.hd-central.com/harley-davidson-racing-history/"
                                                      >
                                                   <strong>
                                                   Harley-Davidson Racing
                                                   </strong>
                                                   </a>
                                                </li>
                                                <li>
                                                   <a
                                                      href="https://www.hd-central.com/flat-track-racing/"
                                                      >
                                                   Flat Track Racing
                                                   </a>
                                                </li>
                                                <li>
                                                   <a
                                                      href="https://www.hd-central.com/harley-davidson-board-track-racing/"
                                                      >
                                                   Board Track Racing
                                                   </a>
                                                </li>
                                                <li>
                                                   <a
                                                      href="https://www.hd-central.com/harley-davidson-drag-racing/"
                                                      >
                                                   Drag Racing
                                                   </a>
                                                </li>
                                                <li>
                                                   <a
                                                      href="https://www.hd-central.com/king-of-the-baggers/"
                                                      >
                                                   King of The Baggers
                                                   </a>
                                                </li>
                                             </ul>
                                          </div>
                                       </div>
                                       <div class="col-md-6 col-lg-3">
                                          <div class="mega-menu-box">
                                             <ul class="mega-menu-list">
                                                <li>
                                                   <a
                                                      href="#"
                                                      >
                                                   <strong>Customs</strong>
                                                   </a>
                                                </li>
                                                <li>
                                                   <a
                                                      href="https://www.hd-central.com/the-history-of-customising/"
                                                      >
                                                   The history of customising
                                                   </a>
                                                </li>
                                                <li>
                                                   <a
                                                      href="https://www.hd-central.com/custom-styles-across-the-world/"
                                                      >
                                                   Custom styles across the
                                                   world
                                                   </a>
                                                </li>
                                                <li>
                                                   <a
                                                      href="https://www.hd-central.com/our-top-custom-harley-davidsons/"
                                                      >
                                                   Our top custom
                                                   Harley-Davidsons
                                                   </a>
                                                </li>
                                                <li>
                                                   <a
                                                      href="https://www.hd-central.com/legendary-custom-builders/"
                                                      >
                                                   Legendary custom builders
                                                   </a>
                                                </li>
                                             </ul>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="row">
                                       <div class="col-md-6 col-lg-3">
                                          <div class="mega-menu-box">
                                             <ul class="mega-menu-list">
                                                <li>
                                                   <a
                                                      href="https://www.hd-central.com/innovation-and-craftsmanship/"
                                                      >
                                                   <strong>
                                                   Innovation and Craftsmanship
                                                   </strong>
                                                   </a>
                                                </li>
                                             </ul>
                                          </div>
                                       </div>
                                       <div class="col-md-6 col-lg-3">
                                          <div class="mega-menu-box">
                                             <ul class="mega-menu-list">
                                                <li>
                                                   <a
                                                      href="https://www.hd-central.com/member-builds-and-showcase/"
                                                      >
                                                   <strong>
                                                   Member builds and showcase
                                                   </strong>
                                                   </a>
                                                </li>
                                             </ul>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </li>
                           </ul>
                        </li>
                        <li class="mega-menu" id="general">
                           <a href="#">
                           <i class="fa-solid fa-gear text-end"></i>
                           TECH
                           </a>
                           <ul>
                              <li>
                                 <div class="mega-menu-container">
                                    <div class="row">
                                       <div class="col-md-6 col-lg-4">
                                          <div class="mega-menu-box">
                                             <ul class="mega-menu-list">
                                                <li>
                                                   <a href="https://www.hd-central.com/harley-davidson-tire-finder">
                                                    Harley-Davidson Wheel and Tire Guide
                                                   </a>
                                                </li>
                                                <li>
                                                   <a href="https://hd-central.com/oil-guide/">
                                                  Harley-Davidson Oil and Lubrication Guide
                                                   </a>
                                                </li>
                                                <li>
                                                   <a href="https://hd-central.com/harley-davidson-oil-filter-guide/">
                                                   Harley-Davidson Oil Filter Guide 
                                                   </a>
                                                </li>
                                                <li>
                                                   <a href="https://hd-central.com/harley-davidson-air-filter-guide/">
                                                   Harley-Davidson Air Filter Guide
                                                   </a>
                                                </li>
                                                <li>
                                                   <a href="https://hd-central.com/harley-davidson-spark-plug-guide/">
                                                  Harley-Davidson Spark Plug Guide
                                                   </a>
                                                </li>
                                             </ul>
                                          </div>
                                       </div>
                                       <div class="col-md-6 col-lg-4">
                                          <div class="mega-menu-box">
                                             <ul class="mega-menu-list">
                                                <li>
                                                   <a href="https://hd-central.com/harley-davidson-battery-guide/">
                                                      Harley -Davidson Battery Guide 
                                                   </a>
                                                </li>
                                                <li>
                                                   <a href="https://hd-central.com/harley-davidson-exhausts/">
                                                      Harley-Dabidson Exhausts 
                                                   </a>
                                                </li>
                                                <li>
                                                   <a href="https://hd-central.com/harley-davidson-belts-and-chains/">
                                                      Harley-Davidson Belts and Chains 
                                                   </a>
                                                </li>
                                                <li>
                                                   <a href="https://hd-central.com/harley-davidson-fault-codes-2004-2015/">
                                                      Harley-Davidson Fault Codes 
                                                   </a>
                                                </li>
                                                <li>
                                                   <a href="https://hd-central.com/harley-davidson-electronic-tuning/">
                                                      Harley-Davison Electronic Tuning 
                                                   </a>
                                                </li>
                                             </ul>
                                          </div>
                                       </div>
                                       <div class="col-md-6 col-lg-4">
                                          <div class="mega-menu-box">
                                             <ul class="mega-menu-list">
                                                <li>
                                                   <a href="https://www.hd-central.com/oem-parts-finder/">
                                                      OEM Parts Finder
                                                   </a>
                                                </li>
                                                <li>
                                                   <a href="https://www.hd-central.com/harley-davidson-manuals/">
                                                      Harley-Davidson Manuals
                                                   </a>
                                                </li>
                                                <li>
                                                   <a href="https://www.hd-central.com/tech_live_24/">
                                                      Servicing and Maintenance
                                                   </a>
                                                </li>
                                             </ul>
                                          </div>
                                       </div>
                                    </div>
                                   
                                 </div>
                              </li>
                           </ul>
                        </li>
                       
                        <li>
                           <a
                              href="https://www.hd-central.com/directory-list/"
                              >
                           <i
                              class="fa-solid fa-location-dot text-end"
                              ></i>
                           Directory
                           </a>
                        </li>
                        <li class="mega-menu" id="general">
                           <a
                              href="https://www.hd-central.com/harley-davidson-for-sale/"
                              >
                           <img src="demo/images/Group.svg" alt="" />
                           Bikes for Sale
                           </a>
                           <ul>
                              <li>
                                 <div class="mega-menu-container">
                                    <div class="row">
                                       <div class="col-md-6 col-lg-3">
                                          <div class="mega-menu-box">
                                             <ul class="mega-menu-list">
                                                <li>
                                                   <a
                                                      href="https://www.hd-central.com/harley-davidson-for-sale/"
                                                      >
                                                   <strong>
                                                   Harley-Davidson Bikes for
                                                   Sale
                                                   </strong>
                                                   </a>
                                                </li>
                                                <li>
                                                   <a
                                                      href="https://www.hd-central.com/harley-davidson-for-sale/"
                                                      >
                                                   New Bikes
                                                   </a>
                                                </li>
                                                <li>
                                                   <a
                                                      href="https://www.hd-central.com/harley-davidson-for-sale/"
                                                      >
                                                   2nd Hand Bikes for Sale
                                                   </a>
                                                </li>
                                                <li>
                                                   <a
                                                      href="https://www.hd-central.com/harley-davidson-for-sale/"
                                                      >
                                                   Vintage Bikes For Sale
                                                   </a>
                                                </li>
                                                <li>
                                                   <a
                                                      href="https://www.hd-central.com/harley-davidson-for-sale/"
                                                      >
                                                   Antique Bikes For Sale
                                                   </a>
                                                </li>
                                                <li>
                                                   <a
                                                      href="https://www.hd-central.com/harley-davidson-for-sale/"
                                                      >
                                                   Bargain Bikes For Sale
                                                   </a>
                                                </li>
                                             </ul>
                                          </div>
                                       </div>
                                       <div class="col-md-6 col-lg-3">
                                          <div class="mega-menu-box">
                                             <ul class="mega-menu-list">
                                                <li>
                                                   <a
                                                      href="#"
                                                      >
                                                   <strong>
                                                   Buying Guidance
                                                   </strong>
                                                   </a>
                                                </li>
                                                <li>
                                                   <a
                                                      href="https://www.hd-central.com/bike-inspections"
                                                      >
                                                   Bike Inspections
                                                   </a>
                                                </li>
                                                <li>
                                                   <a
                                                      href="https://www.hd-central.com/paperwork-and-vin-checks"
                                                      >
                                                   Paperwork and VIN checks
                                                   </a>
                                                </li>
                                                <li>
                                                   <a
                                                      href="https://www.hd-central.com/foreign-or-long-distance-deals"
                                                      >
                                                   Foreign or long distance
                                                   buys
                                                   </a>
                                                </li>
                                             </ul>
                                          </div>
                                       </div>
                                       <div class="col-md-6 col-lg-3">
                                          <div class="mega-menu-box">
                                             <ul class="mega-menu-list">
                                                <li>
                                                   <a
                                                      href="#"
                                                      >
                                                   <strong>
                                                   Sell Your Harley-Davidson
                                                   </strong>
                                                   </a>
                                                </li>
                                                <li>
                                                   <a
                                                      href="https://www.hd-central.com/add-your-bike-4-sale/"
                                                      >
                                                   List your ride on
                                                   hd-central.com
                                                   </a>
                                                </li>
                                                <li>
                                                   <a
                                                      href="https://www.hd-central.com/directory-list/"
                                                      >
                                                   Sell your bike on
                                                   consignment
                                                   </a>
                                                </li>
                                                <li>
                                                   <a
                                                      href="https://www.hd-central.com/directory-list/"
                                                      >
                                                   Trade or part exchange your
                                                   bike
                                                   </a>
                                                </li>
                                                <li>
                                                   <a
                                                      href="https://www.hd-central.com/directory-list/"
                                                      >
                                                   Sell your bike for cash
                                                   today !
                                                   </a>
                                                </li>
                                             </ul>
                                          </div>
                                       </div>
                                       <div class="col-md-6 col-lg-3">
                                          <div class="mega-menu-box">
                                             <ul class="mega-menu-list">
                                                <li>
                                                   <a
                                                      href="#"
                                                      >
                                                   <strong>
                                                   Selling Guidance
                                                   </strong>
                                                   </a>
                                                </li>
                                                <li>
                                                   <a
                                                      href="https://www.hd-central.com/listing-advice-and-tips/"
                                                      >
                                                   Listing advice and tips
                                                   </a>
                                                </li>
                                                <li>
                                                   <a
                                                      href="https://www.hd-central.com/bike-valution-and-eatras/"
                                                      >
                                                   Bike valution and estimates
                                                   </a>
                                                </li>
                                                <li>
                                                   <a
                                                      href="https://www.hd-central.com/prepping-your-bike-for-inspection/"
                                                      >
                                                   Prepping your bike for
                                                   inspection
                                                   </a>
                                                </li>
                                             </ul>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </li>
                           </ul>
                        </li>
                        <li class="">
                           <a href="https://hd-central.com/harley-davidson-marketplace/">
                           <i class="fa-solid fa-cart-shopping text-end"></i>
                           Marketplace
                           </a>
                           <ul class="widthcover">
                              <li>
                                 <a href="https://www.hd-central.com/harley-davidsons-parts-accessories-clothing-for-sale/">
                                    Parts and Accessories for Sale
                                 </a>
                              </li>
                              <li>
                                 <a href="https://www.hd-central.com/harley-davidson-tire-finder">
                                    Harley-Davidson Tire Finder
                                 </a>
                              </li>
                              <li>
                                 <a href="https://www.hd-central.com/offers-list/">
                                    Special Offers and Discounts
                                 </a>
                              </li>
                              <li>
                                 <a href="https://www.hd-central.com/directory-list/">
                                    Harley-Davidson Rentals
                                 </a>
                              </li>
                              <li>
                                 <a href="https://www.hd-central.com/finance/">
                                    Finance
                                 </a>
                              </li>
                              <li>
                                 <a href="https://www.hd-central.com/insurance/">
                                    Insurance
                                 </a>
                              </li>
                              <li>
                                 <a href="https://hd-central.com/parts-wanted/">
                                    Parts Wanted 
                                 </a>
                              </li>
                           </ul>
                        </li>
                        <li class="dropdown_menu">
                           <a href="https://www.hd-central.com/social/">
                           <i
                              class="fa-brands fa-rocketchat text-end"
                              ></i>
                           Social
                           </a>
                           <ul>
                              <li>
                                 <a
                                    href="https://www.hd-central.com/social-activity-wall/"
                                    >
                                 Social Activity Wall
                                 </a>
                              </li>
                              <li>
                                 <a
                                    href="https://www.hd-central.com/groups-directory"
                                    >
                                 Group Directory
                                 </a>
                              </li>
                              <li>
                                 <a
                                    href="https://hd-central.com/user-member-redirect/"
                                    >
                                 My Social Dashboard
                                 </a>
                              </li>
                           </ul>
                        </li>
                        <li class="">
                           <a
                              href="https://www.hd-central.com/hd-community/"
                              >
                           <i class="fa-solid fa-heart text-end"></i>
                           Community
                           </a>
                           <ul>
                              <li>
                                 <a href="https://www.hd-central.com/event-list/">
                                 Event Listings
                                 </a>
                              </li>
                              <li>
                                 <a
                                    href="https://www.hd-central.com/group-list/"
                                    >
                                 Clubs and Local Groups
                                 </a>
                              </li>
                              <li>
                                 <a
                                    href="https://www.hd-central.com/places/"
                                    >
                                 Places to Visit
                                 </a>
                              </li>
                              <li>
                                 <a
                                    href="https://www.hd-central.com/legends/"
                                    >
                                 Legends
                                 </a>
                              </li>
                              <li>
                                 <a
                                    href="https://www.hd-central.com/harley-davidson-personalities/"
                                    >
                                 Personalities
                                 </a>
                              </li>
                              <li>
                                 <a
                                    href="https://www.hd-central.com/biker-help-network/"
                                    >
                                 Biker Help Network
                                 </a>
                              </li>
                              <li>
                                 <a
                                    href="https://www.hd-central.com/other-harley-davidson-groups-on-the-web/"
                                    >
                                 Other Harley-Davidson groups on the web
                                 </a>
                              </li>
                              <li>
                                 <a href="https://www.hd-central.com/road_trips_and_routes/">
                                 Road Trips and Routes
                                 </a>
                              </li>
                               <li>
                                 <a href="https://hd-central.com/harley-davidson-social-media-stars/">
                                 Social Media Stars
                                 </a>
                              </li>
                           </ul>
                        </li>
                        <li class="">
                           <a href="">
                           <i class="fa-solid fa-user"></i>
                           </a>
                           <ul class="padd1" id="postion-left">
                              <ul class="d-flex">
                                 <?php if ( !is_user_logged_in() ) { ?>
                                 <li class="sign-drop">
                                    <a href="https://www.hd-central.com/newregister/" class="p-0">
                                    SIGN UP
                                    <i class="fa-solid fa-user"></i>
                                    </a>
                                 </li>
                                 <li class="login-drop">
                                    <a href="https://www.hd-central.com/login-3/" class="p-0">
                                    LOGIN
                                    <i
                                       class="fa-solid fa-sign-in-alt"
                                       ></i>
                                    </a>
                                 </li>
                                 <?php } ?>
                                 <?php if ( is_user_logged_in() ) { ?>
                                 <li class="sign-drop">
                                    <a href="https://www.hd-central.com/user-redirect" class="p-0">
                                    My Account
                                    <i class="fa-solid fa-user"></i>
                                    </a>
                                 </li>
                                 <li class="login-drop">
                                    <a href="https://www.hd-central.com/wp-login.php?action=logout" class="p-0">
                                    Logout
                                    <i
                                       class="fa-solid fa-sign-in-alt"
                                       ></i>
                                    </a>
                                 </li>
                                 <?php } ?>
                              </ul>
                           </ul>
                        </li>
                     </ul>
                  </nav>
               </div>
            </div>
         </div>
         <?php //ubermenu( 'main', array( 'theme_location' => 'primary' ) ); ?>
      </div>
   </div>
</div>
</div>