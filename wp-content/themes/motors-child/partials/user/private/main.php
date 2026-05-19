<?php

$current = stm_account_current_page();
//print($_GET['page']);
if(!isset($_GET['page'])){
$current = "welcome";
}

?>

<div class="stm-user-private-main">

    <?php if ( $current == 'welcome' ): ?>
    
    <?php get_template_part( 'partials/user/private/pages/welcome' ) ; ?>
          
    <?php elseif ( $current == 'account_settings' ): ?>

    <div id="current-endpoint-title-wrapper" class="current-endpoint-title-wrapper">
        <div class="current-endpoint">
        <i class="fas fa-cog"></i><span>User Details</span>
        </div>
    </div>
    <?php get_template_part( 'partials/user/private/pages/account_settings' ) ; ?>

    <?php elseif ( $current == 'password_settings' ): ?>


    <div id="current-endpoint-title-wrapper" class="current-endpoint-title-wrapper">
        <div class="current-endpoint">
            <i class="fas fa-lock"></i><span> Password Settings</span>
        </div>
    </div>
    <?php get_template_part( 'partials/user/private/pages/password_settings' ); ?>


    <?php elseif ( $current == 'payment_settings' ): ?>


    <div id="current-endpoint-title-wrapper" class="current-endpoint-title-wrapper">
        <div class="current-endpoint">
            <i class="fas fa-file-invoice-dollar"></i><span> Subscription and Billing</span>
        </div>
    </div>
    <?php get_template_part( 'partials/user/private/pages/payment_settings' ); ?>

    <?php elseif ( $current == 'marketing_preferences' ): ?>


    <div id="current-endpoint-title-wrapper" class="current-endpoint-title-wrapper">
        <div class="current-endpoint">
            <i class="fas fa-bullhorn"></i><span> Marketing Preferences</span>
        </div>
    </div>
    <?php get_template_part( 'partials/user/private/pages/marketing_preferences' ); ?>

	<?php elseif ( $current == 'directory_listing_details' ): ?>


	<div id="current-endpoint-title-wrapper" class="current-endpoint-title-wrapper">
		<div class="current-endpoint">
        <i class="fas fa-address-book"></i><span>Directory Listing Details</span>
		</div>
	</div>
	<?php get_template_part( 'partials/user/private/pages/Directory-Listing-Details/directory_listing_details' ); ?>

	<?php elseif ( $current == 'dealer_settings'): ?>
	<div id="current-endpoint-title-wrapper" class="current-endpoint-title-wrapper">
		<div class="current-endpoint">
        <i class="fas fa-handshake"></i><span>Dealer Categories</span>
		</div>
	</div>
	<?php get_template_part( 'partials/user/private/pages/listing-categories/dealer_settings' ); ?>
    <?php elseif ( $current == 'business_settings'): ?>
        <div id="current-endpoint-title-wrapper" class="current-endpoint-title-wrapper">
            <div class="current-endpoint">
                <i class="fas fa-briefcase"></i><span>Business Categories and Settings</span>
            </div>
        </div>
        <?php get_template_part( 'partials/user/private/pages/business-settings/business_settings' ); ?>

	<?php elseif ( $current == 'service_provider_settings'): ?>
	<div id="current-endpoint-title-wrapper" class="current-endpoint-title-wrapper">
		<div class="current-endpoint">
        <i class="fas fa-cogs"></i><span>Service Provider Settings</span>
		</div>
	</div>
	<?php get_template_part( 'partials/user/private/pages/listing-categories/service_provider_settings' ); ?>

	<?php elseif ( $current == 'parts_accessories_categories'): ?>
	<div id="current-endpoint-title-wrapper" class="current-endpoint-title-wrapper">
		<div class="current-endpoint">
        <i class="fas fa-cog"></i><span>Parts Accessories Categories</span>
		</div>
	</div>
    <?php get_template_part( 'partials/user/private/pages/listing-categories/parts_accessories_categories' ); ?>
    <?php elseif ( $current == 'distributors'): ?>
    <div id="current-endpoint-title-wrapper" class="current-endpoint-title-wrapper">
        <div class="current-endpoint">
        <i class="fab fa-stack-overflow"></i><span>Distributors / Stockists</span>
        </div>
    </div>
	<?php get_template_part( 'partials/user/private/pages/listing-categories/distributors' ); ?>
	
	<?php elseif ( $current == 'place_settings'): ?>
	<div id="current-endpoint-title-wrapper" class="current-endpoint-title-wrapper">
		<div class="current-endpoint">
        <i class="fas fa-globe-europe"></i><span>Places Categories and settings </span>
		</div>
	</div>
	<?php get_template_part( 'partials/user/private/pages/place-categories/place_settings' ); ?>
	
	<?php elseif ( $current == 'things_to_do'): ?>
	<div id="current-endpoint-title-wrapper" class="current-endpoint-title-wrapper">
		<div class="current-endpoint">
        <i class="far fa-list-alt"></i><span>Things To Do</span>
		</div>
	</div>
	<?php get_template_part( 'partials/user/private/pages/place-categories/things_to_do' ); ?>

	<?php elseif ( $current == 'add_promotions'): ?>
	<div id="current-endpoint-title-wrapper" class="current-endpoint-title-wrapper">
		<div class="current-endpoint">
        <i class="fas fa-ad"></i><span>Add Promotions</span>
		</div>
	</div>
	<?php get_template_part( 'partials/user/private/pages/promotions-and-affiliates/add_promotions' ); ?>
	

	<?php elseif ( $current == 'youtube_affiliate'): ?>
	<div id="current-endpoint-title-wrapper" class="current-endpoint-title-wrapper">
		<div class="current-endpoint">
        <i class="fas fa-play-circle"></i><span>Earn Cash with Video's</span>
		</div>
	</div>
	<?php get_template_part( 'partials/user/private/pages/promotions-and-affiliates/youtube' ); ?>
	
	<?php elseif ( $current == 'offers'): ?>
	<div id="current-endpoint-title-wrapper" class="current-endpoint-title-wrapper">
		<div class="current-endpoint">
        <i class="fas fa-tag"></i><span>Offers</span>
		</div>
	</div>
	<?php get_template_part( 'partials/user/private/user-offers' ); ?>
	
	<?php elseif ( $current == 'my-parts-list'): ?>
	<div id="current-endpoint-title-wrapper" class="current-endpoint-title-wrapper">
		<div class="current-endpoint">
        <i class="fas fa-clipboard-list"></i><span>My Parts List</span>
		</div>
	</div>
	<?php get_template_part( 'partials/user/private/user-my-parts-list' ); ?>

    <!-- old start  -->
    <?php elseif ( $current == 'favourites' ): ?>

    <div id="current-endpoint-title-wrapper" class="current-endpoint-title-wrapper">
        <div class="current-endpoint">
        <i class="fab fa-gratipay"></i><span>Favourites</span>
        </div>
    </div>
        
        <?php get_template_part( 'partials/user/private/user-favourite' ); ?>
    
       <!-- old start  -->
    <?php elseif ( $current == 'manuals' ): ?>

    <div id="current-endpoint-title-wrapper" class="current-endpoint-title-wrapper">
        <div class="current-endpoint">
        <i class="fab fa-gratipay"></i><span>My Manuals</span>
        </div>
    </div>
        
        <?php get_template_part( 'partials/user/private/user-manuals' ); ?>
    

    <?php elseif ( $current == 'promotions' ): ?>
    <div class="my-plans-wrapper">
        <h4 class="stm-seller-title stm-main-title"><?php echo esc_html__('Promotions', 'motors'); ?></h4>
        <?php get_template_part( 'partials/user/private/user-promotions' ); ?>
    </div>
    <?php elseif ( $current == 'youtube' ): ?>
    <div class="my-plans-wrapper">
        <h4 class="stm-seller-title stm-main-title"><?php echo esc_html__('Youtube Affiliate', 'motors'); ?></h4>
        <?php get_template_part( 'partials/user/private/user-youtube' ); ?>
    </div>
    <?php elseif ( $current == 'subscriptions' ): ?>
    <div class="my-plans-wrapper">
        <h4 class="stm-seller-title stm-main-title"><?php echo esc_html__('My Subsciptions', 'motors'); ?></h4>
        <?php get_template_part( 'partials/user/private/user-subscriptions' ); ?>
    </div>

    <?php elseif ( $current == 'my-harley-davidson' ): ?>
    <div class="my-plans-wrapper">
        <h4 class="stm-seller-title stm-main-title current-endpoint-title-wrapper title-harley"><img src="https://hd-central.com/wp-content/uploads/2021/08/vippng.png" width="16px"><?php echo esc_html__('My Harley-Davidson', 'motors'); ?></h4>
        <?php get_template_part( 'partials/user/private/user-my-harley-davidson' ); ?>
    </div>
	
	<?php elseif ( $current == 'my-hd-bike' ): ?>
    <div id="current-endpoint-title-wrapper" class="current-endpoint-title-wrapper">
		<div class="current-endpoint title-harley">
			<img src="https://hd-central.com/wp-content/uploads/2021/08/vippng.png" width="16px"><span>My Garage</span>
		</div>
	</div>
	<?php get_template_part( 'partials/user/private/user-my-hd-bike' ); ?>

    <?php elseif ( $current == 'my-plans' ): ?>
    <div class="my-plans-wrapper">
        <h4 class="stm-seller-title stm-main-title"><?php echo esc_html__('My Plans', 'motors'); ?></h4>
        <?php get_template_part( 'partials/user/private/user-plans' ); ?>
    </div>
    <?php elseif ( $current == 'add_bike' ): ?>
	<div id="current-endpoint-title-wrapper" class="current-endpoint-title-wrapper">
        <div class="current-endpoint">
			<span><?php echo esc_html__('Add a Bike for Sale', 'motors'); ?></span>
        </div>
    </div>
    
    <div class="content-padding gray-bkg vendor-policies add_bike_container">
    <div class="notice-wrapper">
    </div>
    <div class="row">

            <div class="">
                <!-- <form method="post" name="shop_settings_form" class="wcmp_policy_form form-horizontal"> -->

                <div class="panel panel-default pannel-outer-heading">
                    <div class="panel-heading d-flex">
                        
                    </div>
                    <div class="panel-body panel-content-padding add_bike_panel">
                        <div class="form-group d-flex align-items-center">
        
                            <?php echo do_shortcode('[stm_sidebar sidebar="15187"]'); ?>    
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    <?php elseif ( $current == 'settings' ): ?>

    <?php get_template_part( 'partials/user/private/' . ( stm_get_user_role( get_current_user_id() ) ? 'dealer-settings' : 'user-settings' ) ); ?>

    <?php elseif ( $current == 'become-dealer' ): ?>

    <?php get_template_part( 'partials/user/private/become-dealer' ); ?>
    <?php elseif ( $current == 'add_bike_payment' ): ?>

        <div id="current-endpoint-title-wrapper" class="current-endpoint-title-wrapper">
        <div class="current-endpoint">
        <i class="fas fa-motorcycle"></i><span><?php echo esc_html__('Add your bike for sale', 'motors'); ?></span>
        </div>
    </div>
    
    <div class="content-padding gray-bkg vendor-policies add_bike_container">
    <div class="notice-wrapper">
    </div>
    <div class="row">

            <div class="">
                <!-- <form method="post" name="shop_settings_form" class="wcmp_policy_form form-horizontal"> -->

                <div class="panel panel-default pannel-outer-heading">
                    <div class="panel-heading d-flex">
                        
                    </div>
                    <div class="panel-body panel-content-padding add_bike_panel">
                        <div class="form-group d-flex align-items-center 0000">
        
                            <?php 
                             $post_id = $_REQUEST['post_id'];
                            $stm_pricing = get_post_meta( $post_id , 'stm_pricing', true );
                            if($stm_pricing != "0") {

                            
                             $_GET['product_pirce'] = $stm_pricing;
                            

                             echo do_shortcode('[gravityform id="17" title="false" description="false" ajax="true"]'); 
                            }else{
                                echo "Your bike added successfully!";
                            }
                            ?>    
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        <?php elseif ( $current == 'add_commercial' ): ?>

        <div id="current-endpoint-title-wrapper" class="current-endpoint-title-wrapper">
        <div class="current-endpoint">
        <i class="fas fa-user-tag"></i><span><?php echo esc_html__('Add Commercial ', 'motors'); ?></span>
        </div>
    </div>
    
    <div class="content-padding gray-bkg vendor-policies add_bike_container">
    <div class="notice-wrapper">
    </div>
    <div class="row">

            <div class="" style="margin: 20px;">
                <h2>Coming Soon</h2>

                
                <!-- <form method="post" name="shop_settings_form" class="wcmp_policy_form form-horizontal"> -->

                <div class="panel panel-default pannel-outer-heading" style="display:none;">
                    <div class="panel-heading d-flex">
                        
                    </div>
                    <div class="panel-body panel-content-padding add_bike_panel">
                        <div class="form-group d-flex align-items-center">
                            
                            <?php 
                                //echo do_shortcode('[eventer_dashboard default="eventer_add_new"]');
                            ?>    
                        </div>
                    </div>
                </div>
            </div>
        </div> 

        <?php elseif ( $current == 'page_visitors' ): ?>

        <div id="current-endpoint-title-wrapper" class="current-endpoint-title-wrapper">
        <div class="current-endpoint">
        <i class="fas fa-users"></i><span><?php echo esc_html__('Analytics', 'motors'); ?></span>
        </div>
    </div>
    
    <div class="content-padding gray-bkg vendor-policies add_bike_container">
    <div class="notice-wrapper">
    </div>
    <div class="row">
            <div class="visitor-sec">
                <!-- <h2>Coming Soon</h2> -->
				<?php
					global $wpdb;
					$today = date("Y-m-d");
					$table = $wpdb->prefix."unique_visitors";
					$author_id = get_current_user_id();
				?>
				<div>
                    <div class="visitor-section">
                        <div class="row">
                        <div class="col-sm-4">
                                <div class="visitors">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="visitor-icon total">
                                                <i class="fas fa-users"></i>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="visitor-heading">
                                                <h2>Total page visits (All time)</h2>
                                            </div> 
                                            <div class="visitor-count">
                                                <?php 
                                                $visitors = $wpdb->get_var( "SELECT count(*) FROM $table WHERE `author_id` = '$author_id'" );
                                                $visitors = $visitors;
                                                echo $visitors;
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="visitors">
                                    <div class="row">
                                    <div class="col-lg-4">
                                            <div class="visitor-icon monthly-visitor">
                                            <i class="fas fa-calendar-alt"></i>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                        <div class="visitor-heading">
                                                <h2>Page visits this month</h2>
                                            </div> 
                                            <div class="visitor-count">
                                                <?php 
												$monthDate = date("Y-m-d", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "-1 month" ) );
                                                $visitors = $wpdb->get_var( "SELECT count(*) FROM $table WHERE `author_id` = '$author_id' AND Date between '$monthDate' and '$today'" );
                                                $visitors = $visitors;
                                                echo $visitors;
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="visitors">
                                    <div class="row">
                                    <div class="col-lg-4">
                                            <div class="visitor-icon weekly-visitor">
                                                <i class="fas fa-calendar-week"></i>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                        <div class="visitor-heading">
                                                <h2>Page visits this week</h2>
                                            </div> 
                                            <div class="visitor-count">
												<?php 
												$weekDate = date("Y-m-d", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "-1 week" ) );
												$visitors = $wpdb->get_var( "SELECT count(*) FROM $table WHERE `author_id` = '$author_id' AND Date between '$weekDate' and '$today'" );
												$visitors = $visitors;
												echo $visitors;
												?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
				</div>
				
                <!-- <form method="post" name="shop_settings_form" class="wcmp_policy_form form-horizontal"> -->

                <div class="panel panel-default pannel-outer-heading" style="display:none;">
                    <div class="panel-heading d-flex">
                        
                    </div>
                    <div class="panel-body panel-content-padding add_bike_panel">
                        <div class="form-group d-flex align-items-center">
                            
                            <?php 
                                //echo do_shortcode('[eventer_dashboard default="eventer_add_new"]');
                            ?>    
                        </div>
                    </div>
                </div>
            </div>
        </div> 

    <?php elseif ( $current == 'my_event' ): ?>

        <div id="current-endpoint-title-wrapper" class="current-endpoint-title-wrapper">
			<div class="current-endpoint">
            <i class="far fa-calendar-alt"></i><span><?php echo esc_html__('Add your Event', 'motors'); ?></span>
			</div>
		</div>
    
		<div class="content-padding gray-bkg vendor-policies add_bike_container">
			<div class="notice-wrapper"></div>
			<div class="row">

				<div class="col-md-12">
					<div class="panel panel-default pannel-outer-heading">
						<div class="panel-body panel-content-padding">
							<a class="button addeventbutton" href="<?php echo stm_get_author_link( '' ); ?>?page=add_event">Add Event</a>
						</div>
					</div>
					
					<div class="panel panel-default pannel-outer-heading">
						<div class="panel-heading d-flex"><h2>My Event Listings</h2></div>
						<div class="panel-body panel-content-padding add_bike_panel">
							<div class="form-group d-flex align-items-center">
								<?php 
									//echo do_shortcode('[eventer_dashboard default="eventer_add_new"]');
								?>   
								
								<?php get_template_part( 'partials/user/private/user-event-list' ); ?>
								
							</div>
						</div>
					</div>
					
				</div>
			</div>
		</div>

	<?php elseif ( $current == 'add_event'): ?>	
	
	<?php get_template_part( 'partials/user/private/add-event' ); ?>

    <?php elseif ( $current == 'inventory' ): ?>
    <div id="current-endpoint-title-wrapper" class="current-endpoint-title-wrapper">
        <div class="current-endpoint">
        <i class="fas fa-warehouse"></i><span>My Inventory</span>
        </div>
    </div>
    <div class="content-padding gray-bkg vendor-policies invent">
    <div class="notice-wrapper">
    </div>
    <div class="row">

            <div class="col-md-12">
                <!-- <form method="post" name="shop_settings_form" class="wcmp_policy_form form-horizontal"> -->

                <div class="panel panel-default pannel-outer-heading">
                    <div class="panel-heading d-flex">
                        <h2>Add new  Listings </h2>
                        
                    </div>
                    <div class="panel-body panel-content-padding">
                        <div class="form-group d-flex align-items-center">
                         
                       
                        <a style="display: none;"> href="<?php echo esc_url(stm_get_author_link('myself-view')); ?>" target="_blank"><i
                                class="fa fa-external-link"></i><?php esc_html_e('Show my Public Profile', 'stm_vehicles_listing'); ?>
                        </a>
                        <?php 
                            echo '<a class="button addbikebutton"  href="'.stm_get_author_link( '' ).'?page=add_bike">Add a Bike for sale </a> <div class="clearfix"></div>';
                        ?>
                        
                    </div>
                </div>
            </div>
			<div class="panel panel-default pannel-outer-heading">
                    <div class="panel-heading d-flex">
                        <h2>My Current Listings</h2>
                    </div>
                    <div class="panel-body panel-content-padding">
                        <div class="form-group  align-items-center">
                         
    <?php 
		

		$query = ( function_exists( 'stm_user_listings_query' ) ) ? stm_user_listings_query( get_current_user_id(), 'any' ) : null;
		$queryPPL = ( function_exists( 'stm_user_pay_per_listings_query' ) ) ? stm_user_pay_per_listings_query( get_current_user_id(), 'any' ) : null;
		$tabsActive = ( $query != null && $query->have_posts() && $queryPPL != null && $queryPPL->have_posts() ) ? true : false;

		if ( $query != null && $query->have_posts() || $queryPPL != null && $queryPPL->have_posts() ): ?>
    <?php get_template_part( 'partials/user/private/user', 'inventory' ); ?>
    <div class="archive-listing-page">
        <?php if ( $tabsActive ) : ?>
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item active">
                <a href="#pp" class="nav-link active heading-font" id="pp-tab" data-toggle="tab" role="tab"
                    aria-controls="pp" aria-selected="true">
                    <?php echo esc_html__( 'Subsciption Listings', 'motors' ); ?>
                </a>
            </li>
            <li class="nav-item">
                <a href="#ppl" class="nav-link heading-font" id="ppl-tab" data-toggle="tab" role="tab"
                    aria-controls="ppl" aria-selected="false">
                    <?php echo esc_html__( 'Pay Per Listings', 'motors' ); ?>
                </a>
            </li>
        </ul>
        <?php endif; ?>

        <?php if ( $tabsActive ) : ?>
        <div class="tab-content">

            <div class="tab-pane active" id="pp" role="tabpanel" aria-labelledby="pp-tab">
                <?php endif; ?>

                <?php while ( $query->have_posts() ): $query->the_post(); ?>
                <?php get_template_part( 'partials/listing-cars/listing-list-directory-edit', 'loop' ); ?>
                <?php endwhile; ?>

                <?php if ( $tabsActive ) : ?>
            </div>
            <?php endif; ?>

            <?php if ( $tabsActive ) : ?>
            <div class="tab-pane" id="ppl" role="tabpanel" aria-labelledby="ppl-tab">
                <?php endif; ?>

                <?php
						if ( $queryPPL != null && $queryPPL->have_posts() ):
							while ( $queryPPL->have_posts() ): $queryPPL->the_post();
								?>
                <?php get_template_part( 'partials/listing-cars/listing-list-directory-edit', 'loop' ); ?>
                <?php
							endwhile;
						endif;
						?>

                <?php if ( $tabsActive ) : ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
     </div>                        
                    </div>   
                </div>

                
        
    </div>



    
</div>
</div>
    <?php else: ?>
    <h4 class="stm-seller-title"><?php esc_html_e( 'No Inventory yet', 'motors' ); ?></h4>
    <?php endif; ?>

    <?php else:

		do_action( 'stm_account_custom_page', $current );

	endif; ?>
</div>