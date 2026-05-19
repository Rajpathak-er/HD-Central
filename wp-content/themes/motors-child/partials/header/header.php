<?php
$logo_main = get_theme_mod( 'logo', get_template_directory_uri() . '/assets/images/tmp/logo.png' );

?>
<div class="header-main">
	<div class="container">
		<div class="clearfix">
			<!--Logo-->
			<div class="logo-main hidden-md hidden-lg">
				<?php if ( empty( $logo_main ) ) : ?>
					<a class="blogname" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php _e( 'Home', 'motors' ); ?>">
						<h1><?php echo esc_attr( get_bloginfo( 'name' ) ); ?></h1>
					</a>
				<?php else : ?>
					<a class="bloglogo 111" href="<?php echo esc_url( home_url( '/' ) ); ?>">
						<button class="ubermenu-responsive-toggle ubermenu-responsive-toggle-main ubermenu-skin-grey-white ubermenu-loc-primary ubermenu-responsive-toggle-content-align-left ubermenu-responsive-toggle-align-left ubermenu-responsive-toggle-icon-only new" tabindex="0" data-ubermenu-target="ubermenu-main-340-primary-2"><i class="fas fa-bars"></i></button>
						<img src="<?php echo esc_url( $logo_main ); ?>"
								style="width: <?php echo get_theme_mod( 'logo_width', '138' ); ?>px;"
								title="<?php esc_attr_e( 'Home', 'motors' ); ?>"
								alt="<?php esc_attr_e( 'Logo', 'motors' ); ?>"
						/>
					</a>
				<div class="pull-right my">
								<div class="">
									<div class="custom_topbar_menu">
										<div class="account_icon menu_items">
											<span class=""><i class="fa fa-user" title="account"></i></span>
											<div class="account-wrapper item_wrapper">
												<?php if ( is_user_logged_in() ) : ?>
													<div class="btn_container container_login">
														<a class="logout-link 222 custom_btn btn_reg btn_account gray-btn" href="<?php echo get_author_posts_url( get_current_user_id() ); ?>" title="<?php _e( 'My Account', 'motors' ); ?>">
															<i class="fa fa-icon-stm_icon_user"></i>
															<?php _e( 'My Account', 'motors' ); ?>
														</a>
														<a class="logout-link 222 custom_btn btn_login btn_logout black-btn" href="<?php echo esc_url( wp_logout_url( home_url() ) ); ?>" title="<?php _e( 'Log out', 'motors' ); ?>">
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
									</div>
								</div>
							</div>
				<?php endif; ?>

				<?php if ( stm_is_listing_four() ) : ?>
				<div class="mobile-pull-right">
					<?php
					$header_listing_btn_link = get_theme_mod( 'header_listing_btn_link', '/add-car' );
					$header_listing_btn_text = get_theme_mod( 'header_listing_btn_text', 'Add your item' );
					?>
					<?php if ( ! empty( $header_listing_btn_link ) and ! empty( $header_listing_btn_text ) ) : ?>
						<a href="<?php echo esc_url( $header_listing_btn_link ); ?>"
						   class="listing_add_cart heading-font">
							<div>
								<i class="<?php echo ( ! is_listing( array( 'listing_two', 'listing_three' ) ) ) ? 'stm-service-icon-listing_car_plus' : 'stm-lt-icon-add_car'; ?>"></i>
							</div>
						</a>
					<?php endif; ?>
					<div class="lOffer-account-unit">
						<?php
							$login_page = get_theme_mod( 'login_page', 1718 );
							$login_page = stm_motors_wpml_is_page( $login_page );
						?>
						<?php if ( ! empty( $login_page ) ) : ?>
							<div class="pull-right">
								<div class="">
									<div class="custom_topbar_menu">
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
									</div>
								</div>
							</div>
						<?php endif; ?>

						<?php get_template_part( 'partials/user/user', 'dropdown' ); ?>
						<?php get_template_part( 'partials/user/private/mobile/user' ); ?>
					</div>
				</div>
				<?php endif; ?>

			</div>

			<div class="header-top-info" style="margin-top: <?php echo get_theme_mod( 'menu_top_margin', '0' ); ?>px;">
				<div class="clearfix">

					<!--Socials-->
					<?php $socials = stm_get_header_socials( 'header_socials_enable' ); ?>

					<!-- Header top bar Socials -->
					<?php if ( ! empty( $socials ) ) : ?>
						<div class="pull-right">
							<div class="header-main-socs">
								<ul class="clearfix">
									<?php foreach ( $socials as $key => $val ) : ?>
										<li>
											<a href="<?php echo esc_url( $val ); ?>" target="_blank">
												<i class="fa fa-<?php echo esc_attr( $key ); ?>"></i>
											</a>
										</li>
									<?php endforeach; ?>
								</ul>
							</div>
						</div>
					<?php endif; ?>

					<?php
					$header_secondary_phone_1       = get_theme_mod( 'header_secondary_phone_1', '878-3971-3223' );
					$header_secondary_phone_2       = get_theme_mod( 'header_secondary_phone_2', '878-0910-0770' );
					$header_secondary_phone_label_1 = get_theme_mod( 'header_secondary_phone_label_1', 'Service' );
					$header_secondary_phone_label_2 = get_theme_mod( 'header_secondary_phone_label_2', 'Parts' );
					?>
					<!--Header secondary phones-->
					<?php if ( ! empty( $header_secondary_phone_1 ) and ! empty( $header_secondary_phone_2 ) ) : ?>
						<div class="pull-right">
							<div class="header-secondary-phone">
								<div class="phone">
									<?php if ( ! empty( $header_secondary_phone_label_1 ) ) : ?>
										<span class="phone-label"><?php stm_dynamic_string_translation_e( 'Phone Label One', $header_secondary_phone_label_1 ); ?>
											:</span>
									<?php endif; ?>
									<span class="phone-number heading-font"><a
												href="tel:<?php stm_dynamic_string_translation_e( 'Phone Number One', $header_secondary_phone_1 ); ?>"><?php stm_dynamic_string_translation_e( 'Phone Number One', $header_secondary_phone_1 ); ?></a></span>
								</div>
								<div class="phone">
									<?php if ( ! empty( $header_secondary_phone_label_2 ) ) : ?>
										<span class="phone-label"><?php stm_dynamic_string_translation_e( 'Phone Label Two', $header_secondary_phone_label_2 ); ?>
											:</span>
									<?php endif; ?>
									<span class="phone-number heading-font"><a
												href="tel:<?php stm_dynamic_string_translation_e( 'Phone Number Two', $header_secondary_phone_2 ); ?>"><?php stm_dynamic_string_translation_e( 'Phone Number Two', $header_secondary_phone_2 ); ?></a></span>
								</div>
							</div>
						</div>
					<?php elseif ( ! empty( $header_secondary_phone_1 ) or ! empty( $header_secondary_phone_2 ) ) : ?>
						<div class="pull-right">
							<div class="header-secondary-phone header-secondary-phone-single">
								<?php if ( ! empty( $header_secondary_phone_1 ) ) : ?>
									<div class="phone">
										<?php if ( ! empty( $header_secondary_phone_label_1 ) ) : ?>
											<span class="phone-label"><?php stm_dynamic_string_translation_e( 'Phone Label One', $header_secondary_phone_label_1 ); ?>
												:</span>
										<?php endif; ?>
										<span class="phone-number heading-font"><a
													href="tel:<?php stm_dynamic_string_translation_e( 'Phone Number One', $header_secondary_phone_1 ); ?>"><?php stm_dynamic_string_translation_e( 'Phone Number One', $header_secondary_phone_1 ); ?></a></span>
									</div>
								<?php endif; ?>
								<?php if ( ! empty( $header_secondary_phone_2 ) ) : ?>
									<div class="phone">
										<?php if ( ! empty( $header_secondary_phone_label_2 ) ) : ?>
											<span class="phone-label"><?php stm_dynamic_string_translation_e( 'Phone Label Two', $header_secondary_phone_label_2 ); ?>
												:</span>
										<?php endif; ?>
										<span class="phone-number heading-font"><a
													href="tel:<?php stm_dynamic_string_translation_e( 'Phone Number Two', $header_secondary_phone_2 ); ?>"><?php stm_dynamic_string_translation_e( 'Phone Number One', $header_secondary_phone_2 ); ?></a></span>
									</div>
								<?php endif; ?>
							</div>
						</div>
					<?php endif; ?>

					<?php
					$header_main_phone       = get_theme_mod( 'header_main_phone', '878-9671-4455' );
					$header_main_phone_label = get_theme_mod( 'header_main_phone_label', 'Sales' );
					?>
					<!--Header main phone-->
					<?php if ( ! empty( $header_main_phone ) ) : ?>
						<div class="pull-right">
							<div class="header-main-phone heading-font">
								<i class="stm-icon-phone"></i>
								<div class="phone">
									<?php if ( ! empty( $header_main_phone_label ) ) : ?>
										<span class="phone-label"><?php stm_dynamic_string_translation_e( 'Header Phone Label', $header_main_phone_label ); ?>
											:</span>
									<?php endif; ?>
									<span class="phone-number heading-font"><a
												href="tel:<?php echo preg_replace( '/\s/', '', $header_main_phone ); ?>"><?php stm_dynamic_string_translation_e( 'Header Phone', $header_main_phone ); ?></a></span>
								</div>
							</div>
						</div>
					<?php endif; ?>

					<?php
					$header_address     = get_theme_mod( 'header_address', '1840 E Garvey Ave South West Covina, CA 91791' );
					$header_address_url = get_theme_mod( 'header_address_url' );
					?>
					<!--Header address-->
					<?php if ( ! empty( $header_address ) ) : ?>
						<div class="pull-right">
							<div class="header-address">
								<i class="stm-icon-pin"></i>
								<div class="address">
									<?php if ( ! empty( $header_address ) ) : ?>
										<span class="heading-font"><?php stm_dynamic_string_translation_e( 'Header address', $header_address ); ?></span>
										<?php if ( ! empty( $header_address_url ) ) : ?>
											<span id="stm-google-map" class="fancy-iframe" data-iframe="true"
												  data-src="<?php echo esc_url( $header_address_url ); ?>">
												<?php _e( 'View on map', 'motors' ); ?>
											</span>
										<?php endif; ?>
									<?php endif; ?>
								</div>
							</div>
						</div>
					<?php endif; ?>
				</div> <!--clearfix-->
			</div> <!--header-top-info-->

		</div> <!--clearfix-->
	</div> <!--container-->
</div> <!--header-main-->
