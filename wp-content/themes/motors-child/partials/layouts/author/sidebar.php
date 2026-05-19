<?php
$user = stm_get_user_custom_fields('');

$user_id = $user['user_id'];

global $wp_roles;
$all_roles = $wp_roles->get_names(); 
//echo '<pre>' . print_r( $all_roles ) . '</pre>';

// Get the user object.
$userObj = get_userdata( $user_id );
$user_roles = $userObj->roles;


$place_cats = get_user_meta( $user_id, 'place_categories', true );
//echo "hii"; 
//print_r($place_cats);  

$place_user = get_user_meta( $user_id, 'place_user', true );


$type = array();
foreach($user_roles as $role){
    $type[] = $all_roles[$role];
}



$current = stm_account_current_page();
if(!isset($_GET['page'])){
$current = "welcome";
}

global $current_user;
    $current_user->membership_level = pmpro_getMembershipLevelForUser($current_user->ID);
$membership_level = $current_user->membership_level->ID;



//print_r($user_roles);

    //echo "MeMbership:".$type;

    



?>
<style>
    #side-menu  {
        overflow: scroll;
        display: block;
        height: 100VH;
        padding-bottom: 40px;
    }
    #side-menu li:last-child {
        margin-bottom: 40px;
    }
</style>
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <!-- /.navbar-header -->
            <div class="navbar-default sidebar side-collapse stm-usersidebar-left" id="side-collapse" role="navigation">
                <!-- <div class="mCustomScrollbar" data-mcs-theme="minimal-dark"> -->
                <div class="" data-mcs-theme="minimal-dark">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <li class="nav-item  ">
                                <a href="https://hd-central.com/user-redirect/" target="_self" data-menu_item="dashboard"
                                    class="nav-link wcmp-venrod-dashboard-nav-link wcmp-venrod-dashboard-nav-link--dashboard <?php  echo ( $current == 'welcome' ) ? "active" : "" ?> ">
                                    <i class="fas fa-tachometer-alt"></i>
                                    <span>Dashboard </span>
                                </a>
                            </li> 
                            <li class="nav-item  hasmenu">
                                <a href="#" target="_self" data-menu_item="store-settings"
                                    class="parent-menu nav-link <?php  echo ( $current == 'account_settings' ) ? "active" : "" ?> wcmp-venrod-dashboard-nav-link wcmp-venrod-dashboard-nav-link--store-settings">
                                    <i class="fas fa-cog"></i>
                                    <span>General Settings </span>
                                    <i class="wcmp-font ico-downarrow-2-icon"></i> </a>
                                <ul class="nav submenu" style="">
                                    <li>
                                        <a href="<?php echo esc_url( add_query_arg( array( 'page' => 'account_settings' ), stm_get_author_link( '' ) ) ); ?>" target="_self"
                                            class="nav-link <?php  echo ( $current == 'account_settings' ) ? "active" : "" ?> wcmp-venrod-dashboard-nav-link wcmp-venrod-dashboard-nav-link--storefront">--
                                            User Details</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo esc_url( add_query_arg( array( 'page' => 'password_settings' ), stm_get_author_link( '' ) ) ); ?>" target="_self"
                                            class="nav-link <?php  echo ( $current == 'password_settings' ) ? "active" : "" ?> wcmp-venrod-dashboard-nav-link wcmp-venrod-dashboard-nav-link--vendor-policies">--
                                            Password and Security </a>
                                    </li>
									
									<?php if(in_array("STM Dealer", $type) || current_user_can('administrator') ){ ?>
                                    <li>
                                        <a href="<?php echo esc_url( add_query_arg( array( 'page' => 'payment_settings' ), stm_get_author_link( '' ) ) ); ?>" target="_self"
                                            class="nav-link <?php  echo ( $current == 'payment_settings' ) ? "active" : "" ?> wcmp-venrod-dashboard-nav-link wcmp-venrod-dashboard-nav-link--vendor-billing">--
                                            Subscription and Billing </a>
                                    </li>
									<?php } ?>
									
                                    <li>
                                        <a href="<?php echo esc_url( add_query_arg( array( 'page' => 'marketing_preferences' ), stm_get_author_link( '' ) ) ); ?>" target="_self"
                                            class="nav-link <?php  echo ( $current == 'marketing_preferences' ) ? "active" : "" ?> wcmp-venrod-dashboard-nav-link wcmp-venrod-dashboard-nav-link--vendor-billing">--
                                            Marketing Preferences </a>
                                    </li>
                                
                                   
                                </ul>
                                <?php if($membership_level == 8 || $membership_level == 7 || $membership_level == 10 || $membership_level == 11  || current_user_can('administrator')) {?>

                                <li  class="nav-item ">
                                        <a target="_blank" href="<?php echo esc_url(stm_get_author_link('myself-view')."&old_view=1"); ?>" target="_self"
                                            class="nav-link <?php  echo ( $current == '1' ) ? "active" : "" ?> wcmp-venrod-dashboard-nav-link wcmp-venrod-dashboard-nav-link--vendor-report">
                                            <i class="fas fa-briefcase"></i>
                                           <span> View My Profile </span> </a>
                                    </li> 
                                <?php } ?>


                            </li>
                            <?php if(in_array("STM Dealer", $type) || !empty($place_user) || current_user_can('administrator')){ ?>
                            <li class="nav-item ">
                                <a href="<?php echo esc_url( add_query_arg( array( 'page' => 'business_settings' ), stm_get_author_link( '' ) ) ); ?>" target="_self" data-menu_item="vendor-products"
                                    class="parent-menu nav-link <?php  echo ( $current == 'business_settings' ) ? "active" : "" ?> wcmp-venrod-dashboard-nav-link wcmp-venrod-dashboard-nav-link--vendor-products">
                                    <i class="fas fa-briefcase"></i>
                                    <span>Business Information 
                                    </a>
                                </li>
                                
                            <?php }?>
                            <?php if((in_array("STM Dealer", $type)  || !empty($place_user)) || current_user_can('administrator')){ ?>
                            <li class="nav-item hasmenu">
								<a href="#" target="_self" data-menu_item="vendor-knowledgebase"
                                    class="parent-menu nav-link <?php  echo ( $current == 'directory_listing_details' ) ? "active" : "" ?> wcmp-venrod-dashboard-nav-link wcmp-venrod-dashboard-nav-link--vendor-knowledgebase">
                                    <i class="fas fa-address-book"></i>
                                    <span>Directory Listing</span>
                                    <i class="wcmp-font ico-downarrow-2-icon"></i> </a>
								<ul class="nav submenu" style="">
									<li>	
										<a href="<?php echo esc_url( add_query_arg( array( 'page' => 'directory_listing_details' ), stm_get_author_link( '' ) ) ); ?>" target="_self" class="nav-link <?php  echo ( $current == 'directory_listing_details' ) ? "active" : "" ?> wcmp-venrod-dashboard-nav-link wcmp-venrod-dashboard-nav-link--vendor-knowledgebase">--
											Directory Listing Details
										</a>
									</li>
								</ul>									
                            </li>
                        <?php }?>
							<?php if($membership_level == 8 || $membership_level == 7 || $membership_level == 10 || $membership_level == 11  || current_user_can('administrator')) {?>
                            <li class="nav-item  hasmenu">
                                <a href="#" target="_self" data-menu_item="vendor-promte"
                                    class=" parent-menu nav-link wcmp-venrod-dashboard-nav-link wcmp-venrod-dashboard-nav-link--vendor-promte">
                                    <i class="fas fa-clipboard-list"></i>
                                    <span>Listing Categories </span>
                                    <i class="wcmp-font ico-downarrow-2-icon"></i> </a>
                                <ul class="nav submenu" style="">
									
                                    <?php if(!empty($place_user)  || current_user_can('administrator')) {?>
                            
                                    <li>
                                        <a href="<?php echo esc_url( add_query_arg( array( 'page' => 'place_settings' ), stm_get_author_link( '' ) ) ); ?>" target="_self"
                                            class="nav-link <?php  ( $current == 'place_settings' ) ? "active"  : "" ?> wcmp-venrod-dashboard-nav-link wcmp-venrod-dashboard-nav-link--coupons">--
                                            Places Categories and settings    </a>
                                    </li>
									
                                
                            <?php }  
                                if(empty($place_user) || current_user_can('administrator')) { ?>
                               
                                    <li>
                                        <a href="<?php echo esc_url( add_query_arg( array( 'page' => 'service_provider_settings' ), stm_get_author_link( '' ) ) ); ?>" target="_self"
                                            class="nav-link <?php  echo ( $current == 'service_provider_settings' ) ? "active" : "" ?> wcmp-venrod-dashboard-nav-link wcmp-venrod-dashboard-nav-link--coupons">--
                                            Business Categories and Settings   </a>
                                    </li>
                                    
                                    

                                <?php } ?>
                                </ul>
                            </li>
                            
                                    <?php if($membership_level == 8 || current_user_can('administrator')) { ?>
                                        <li class="nav-item  ">
                                        <a href="<?php echo esc_url( add_query_arg( array( 'page' => 'distributors' ), stm_get_author_link( '' ) ) ); ?>" target="_self"
                                            class="nav-link <?php  echo ( $current == 'distributors' ) ? "active" : "" ?> wcmp-venrod-dashboard-nav-link wcmp-venrod-dashboard-nav-link--add-coupon">
                                            <i class="fas fa-address-book"></i>
                                           <span>  Distributors / Stockists</span></a>
                                    </li>
                                <?php } ?>
                            <?php } ?>
							
							<?php //if(count($place_cats) == 0 || $place_cats == '') {
									if( empty($place_user) || $place_user == '') {
								?>
                                <?php if(in_array("STM Dealer", $type) || current_user_can('administrator') ){ ?>

                            <li class="nav-item  ">
                                <a href="<?php echo esc_url( add_query_arg( array( 'page' => 'dealer_settings' ), stm_get_author_link( '' ) ) ); ?>" target="_self"
                                    data-menu_item="vendor-knowledgebase"
                                    class="nav-link <?php  echo ( $current == 'dealer_settings' ) ? "active" : "" ?> wcmp-venrod-dashboard-nav-link wcmp-venrod-dashboard-nav-link--vendor-knowledgebase">
                                    <i class="fas fa-address-book"></i>
                                    <span>Dealer Settings</span>  
                                </a>
                            </li>
                            <?php }?>
                            <li class="nav-item  ">
                                <a href="<?php echo esc_url( add_query_arg( array( 'page' => 'inventory' ), stm_get_author_link( '' ) ) ); ?>" target="_self"
                                    data-menu_item="vendor-knowledgebase"
                                    class="nav-link <?php  echo ( $current == 'account_' ) ? "active" : "" ?> wcmp-venrod-dashboard-nav-link wcmp-venrod-dashboard-nav-link--vendor-knowledgebase">
                                    <i class="fas fa-tachometer-alt"></i>
                                    <span>Bikes for Sale</span>
                                </a>
                            </li>
							<?php } ?>
							<?php if( empty($place_user) || $place_user == '') { ?>
							<li class="nav-item " style="display:none;"> 
                                <a href="<?php echo esc_url( add_query_arg( array( 'page' => 'my-hd-bike' ), stm_get_author_link( '' ) ) ); ?>" target="_self"
                                    data-menu_item="vendor-knowledgebase"
                                    class="nav-link <?php  echo ( $current == 'my-hd-bike' ) ? "active" : "" ?> wcmp-venrod-dashboard-nav-link wcmp-venrod-dashboard-nav-link--vendor-knowledgebase">
                                    <img src="https://hd-central.com/wp-content/uploads/2021/08/harley-icon.png" width="22px" style="margin-right: 9px;">
                                    <span>My Harley-Davidson</span>
                                </a>
                            </li>
							<?php }?>
							
                            <?php if(in_array("dc_vendor", $user_roles)) {
								if( empty($place_user) || $place_user == '') { ?>
                            <li class="nav-item  " style="display:none">
                                <a href="<?php echo get_site_url().'/dashboard' ?>" target="_blank"
                                    data-menu_item="vendor-knowledgebase"
                                    class="nav-link <?php  echo ( $current == 'account_' ) ? "active" : "" ?> wcmp-venrod-dashboard-nav-link wcmp-venrod-dashboard-nav-link--vendor-knowledgebase">
                                    <i class="fas fa-store"></i>
                                    <span>My HDC Webshop </span>
                                </a>
                            </li>
                            <?php }} ?>
							
							
							<?php if($membership_level == 8 || $membership_level == 7 ||  $membership_level == 10  || current_user_can('administrator')) {?>
                            <li class="nav-item  hasmenu">
                                <a href="#" target="_self" data-menu_item="vendor-report"
                                    class=" parent-menu nav-link <?php  echo ( $current == 'account_' ) ? "active" : "" ?> wcmp-venrod-dashboard-nav-link wcmp-venrod-dashboard-nav-link--vendor-report">
                                    <i class="fas fa-bullhorn"></i>
                                    <!-- <span>Promotions and Affiliates  </span> -->
                                   
                                    <span> Create Offer</span> 
                                    <i class="wcmp-font ico-downarrow-2-icon"></i> </a>
                                <ul class="nav submenu" style="">
									<?php if($membership_level == 8 || $membership_level == 10 || current_user_can('administrator')) {?>
                                    <li>
                                        <a href="<?php echo esc_url( add_query_arg( array( 'page' => 'add_promotions' ), stm_get_author_link( '' ) ) ); ?>" target="_self"
                                            class="nav-link <?php  echo ( $current == 'add_promotions' ) ? "active" : "" ?> wcmp-venrod-dashboard-nav-link wcmp-venrod-dashboard-nav-link--vendor-report">--
                                            Add Personal Offers </a>
                                    </li>
									<?php } ?>
                                    <?php if($membership_level == 8 || $membership_level == 7 || current_user_can('administrator')) {?>
                                    <li>
                                        <a href="<?php echo esc_url( add_query_arg( array( 'page' => 'add_commercial' ), stm_get_author_link( '' ) ) ); ?>" target="_self"
                                            class="nav-link <?php  echo ( $current == 'add_commercial' ) ? "active" : "" ?> wcmp-venrod-dashboard-nav-link wcmp-venrod-dashboard-nav-link--vendor-report">--
                                        Commercial Offers </a>
                                    </li>
                                    <?php }
                                    ?>
                                    <li style="display:none;">
                                        <a href="<?php echo esc_url( add_query_arg( array( 'page' => 'youtube_affiliate' ), stm_get_author_link( '' ) ) ); ?>" target="_self"
                                            class="nav-link <?php  echo ( $current == 'youtube_affiliate' ) ? "active" : "" ?> wcmp-venrod-dashboard-nav-link wcmp-venrod-dashboard-nav-link--advanced-report">--
                                            Earn Cash with Video's </a>
                                    </li>
                                    
                                </ul>
                            </li>
                            <?php } ?>
                            <?php

                             if(!in_array("subscriber", $user_roles) || !empty($place_user)  || current_user_can('administrator')){ ?>
                                    <li class="nav-item">
                                        <a href="<?php echo esc_url( add_query_arg( array( 'page' => 'page_visitors' ), stm_get_author_link( '' ) ) ); ?>" target="_self"
                                            class="nav-link <?php  echo ( $current == 'page_visitors' ) ? "active" : "" ?> wcmp-venrod-dashboard-nav-link wcmp-venrod-dashboard-nav-link--advanced-report">
                                            <i class="fas fa-user-circle"></i>
                                           <span> Analytics </span></a>
                                    </li>
                                    <?php } ?>
                            
<?php if(in_array("STM Dealer", $type) || current_user_can('administrator') ){ ?>
                            <li class="nav-item">
                                        <a href="<?php echo esc_url( add_query_arg( array( 'page' => 'my_event' ), stm_get_author_link( '' ) ) ); ?>" target="_self"
                                            class="nav-link <?php  echo ( $current == 'my_event' ) ? "active" : "" ?> wcmp-venrod-dashboard-nav-link wcmp-venrod-dashboard-nav-link--vendor-report">
                                            <i class="fas fa-user-circle"></i>
                                            <span> Create Event  </span></a>
                            </li>

<?php } 

if(in_array("subscriber", $user_roles)  || current_user_can('administrator')){ ?>

                            <li class="nav-item  hasmenu">
                                <a href="<?php echo esc_url( add_query_arg( array( 'page' => 'my-hd-bike' ), stm_get_author_link( '' ) ) ); ?>" target="_self" data-menu_item="vendor-report"
                                    class=" parent-menu nav-link <?php  echo ( $current == 'account_' ) ? "active" : "" ?> wcmp-venrod-dashboard-nav-link wcmp-venrod-dashboard-nav-link--vendor-report">
                                    <i class="fas fa-user-circle"></i>
                                    <span>My Garage</span>
                                    <i class="wcmp-font ico-downarrow-2-icon"></i> </a>
                                <ul class="nav submenu" style="">
                                    

                                    
									
									<?php /* ?><li>  
                                        <a href="/service-list/?offer=1" target="_self"
                                            class="nav-link <?php  echo ( $current == 'offers' ) ? "active" : "" ?> wcmp-venrod-dashboard-nav-link wcmp-venrod-dashboard-nav-link--vendor-report">--
                                            Offers  </a>
                                    </li><?php */ ?>
									
									<?php if( empty($place_user) || $place_user == '') { ?>
									<li style="display:none;">  
                                        <a href="<?php echo esc_url( add_query_arg( array( 'page' => 'my-parts-list' ), stm_get_author_link( '' ) ) ); ?>" target="_self"
                                            class="nav-link <?php  echo ( $current == 'my-parts-list' ) ? "active" : "" ?> wcmp-venrod-dashboard-nav-link wcmp-venrod-dashboard-nav-link--vendor-report">--
                                            My parts list  </a>
                                    </li>
									<?php } ?>
									<?php if( empty($place_user) || $place_user == '') { ?>
									<li>  
                                        <a href="<?php echo get_site_url().'/compare' ?>" target="_blank"
                                            class="nav-link <?php  echo ( $current == 'compare-bikes' ) ? "active" : "" ?> wcmp-venrod-dashboard-nav-link wcmp-venrod-dashboard-nav-link--vendor-report">--
                                            Compare Bikes  </a>
                                    </li>
									<?php } ?>
									<?php if(in_array("subscriber", $user_roles) || current_user_can('administrator') ){ ?>
									<li style="display:none;">  
                                        <a href="<?php echo esc_url( add_query_arg( array( 'page' => 'my-harley-davidson' ), stm_get_author_link( '' ) ) ); ?>" target="_self"
                                            class="nav-link <?php  echo ( $current == 'my-harley-davidson' ) ? "active" : "" ?> wcmp-venrod-dashboard-nav-link wcmp-venrod-dashboard-nav-link--vendor-report">--
                                             My Harley Davidson  </a>
                                    </li>

									<?php } ?>
                                    <li style="display:none;" >  
                                        <a href="<?php echo esc_url( add_query_arg( array( 'page' => 'my-hd-bike' ), stm_get_author_link( '' ) ) ); ?>" target="_self"
                                                data-menu_item="vendor-knowledgebase"
                                                class="nav-link <?php  echo ( $current == 'my-hd-bike' ) ? "active" : "" ?> wcmp-venrod-dashboard-nav-link wcmp-venrod-dashboard-nav-link--vendor-knowledgebase">--
                                                My Harley-Davidson</a>
                                        <!--<a href="<?php echo esc_url( add_query_arg( array( 'page' => 'my-harley-davidson' ), stm_get_author_link( '' ) ) ); ?>" target="_self"
                                            class="nav-link <?php  echo ( $current == 'my-harley-davidson' ) ? "active" : "" ?> wcmp-venrod-dashboard-nav-link wcmp-venrod-dashboard-nav-link--vendor-report">--
                                             My Harley Davidson  </a>-->
                                    </li>
                                    
									
                                    <li>
                                        <a style="display: none;" href="<?php echo esc_url( add_query_arg( array( 'page' => 'likes' ), stm_get_author_link( '' ) ) ); ?>" target="_self"
                                            class="nav-link <?php  echo ( $current == 'likes' ) ? "active" : "" ?> wcmp-venrod-dashboard-nav-link wcmp-venrod-dashboard-nav-link--advanced-report">--
                                            Likes </a>
                                    </li>
                                    
                                </ul>
                            </li>
                            <li class="nav-item">
                                        <a href="<?php echo esc_url( add_query_arg( array( 'page' => 'favourites' ), stm_get_author_link( '' ) ) ); ?>" target="_self"
                                            class="nav-link <?php  echo ( $current == 'favourites' ) ? "active" : "" ?> wcmp-venrod-dashboard-nav-link wcmp-venrod-dashboard-nav-link--vendor-report">
                                          <i class="fas fa-user-circle"></i><span>  My favourites  </span></a>
                                    </li>
                            
                           <?php } ?>
                        </ul>
                    </div>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>