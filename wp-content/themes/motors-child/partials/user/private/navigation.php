  <?php
  $current = stm_account_current_page();

  $user_id = get_current_user_id();

  $roles = trim(get_user_meta( $user_id, 'dealer_user_type', true ));

  $user_type = trim(get_user_meta( $user_id, 'user_type', true ));


  $user = get_userdata( $user_id );
  $user_roles = $user->roles;
  //print_r($user_roles);  
  	
  ?>
  <div class="stm-actions-list heading-font">

      <?php
  	
  	do_action( 'stm_before_account_navigation' );
  ?>


      <?php
  	do_action( 'stm_after_account_navigation' );	
  	
  	?>

  <ul class="sidenav author__sidebar-menu">


        <li class="parent-menu-wrapper">
          <a class="dropdown-btn parent-menu">
              <span class="fa menu-icon fa-cog"></span>
              <span>General Settings</span>
              <span class="fa menu-icon menu-icon-down fa-caret-down"></span>
          </a>

          <ul class="dropdown-container">
            <li>

              <a href="<?php echo esc_url(add_query_arg( array( 'page' => 'settings' ), stm_get_author_link( '' ) )) ?>">Account Settings</a>
            </li>
            <li>

              <a href="#">Password and Security</a>
            </li>
            <li>
              <a href="#">Password and Security</a>
            </li>
          </ul>
        </li>


        <li class="parent-menu-wrapper">
          <a class="dropdown-btn parent-menu">
              <span class="fa menu-icon fa-briefcase"></span>
              <span>Business Information</span>
              <span class="fa menu-icon menu-icon-down fa-caret-down"></span>
          </a>
          
          <ul class="dropdown-container">
            <li>
            <a href="#">Business Information</a>
            </li>  
          </ul>

        </li>

        <li class="parent-menu-wrapper">
          
          <a href="#contact" class="parent-menu"><span class="fa menu-icon fa-list-ul"></span>Directory Listing Details</a>

        </li>

    <li class="parent-menu-wrapper">

      <a class="dropdown-btn parent-menu">
          
          <span class="fas menu-icon fa-stream"></span>
          <span>Listing Categories</span>
          <span class="fa menu-icon menu-icon-down fa-caret-down"></span>
      </a>
      <ul class="dropdown-container">
          <a href="#">Listing Categories </a>
          <a href="#">Service Provider Settings </a>
          <a href="#">Online Parts and Accessories Categories</a>
       </ul>
    </li>
	
	<li class="parent-menu-wrapper">

      <a class="dropdown-btn parent-menu">
          
          <span class="fas menu-icon fa-stream"></span>
          <span>Place Categories</span>
          <span class="fa menu-icon menu-icon-down fa-caret-down"></span>
      </a>
      <ul class="dropdown-container">
          <a href="#">Place Settings </a>
       </ul>
    </li>

      <li class="parent-menu-wrapper">
        <a href="#contact" class="parent-menu"> <span class="fas menu-icon fa-star"></span>My HDC Webshop </a>

      </li>

      <li class="parent-menu-wrapper">

        <a href="<?php echo stm_get_author_link( '' );?>/?page=inventory" class="parent-menu"> <span class="fas menu-icon fa-star"></span>My My Dealer Dashboard </a>
      </li>


      <li class="parent-menu-wrapper">

        <a class="dropdown-btn parent-menu">
        <span class="fas menu-icon fa-star"></span>
          <span>Promotions and Affiliates</span>
            <span class="fa menu-icon menu-icon-down fa-caret-down"></span>
        </a>

        <ul class="dropdown-container">
          <li>

            <a href="#">Promotions and Affiliates</a>
          </li>

          <li>

            <a href="#">Submit Videos to HDC and earn cash </a>
          </li>

        </ul>
        
      </li>

      <li class="parent-menu-wrapper">

        <a class="dropdown-btn parent-menu">

          <span class="fas menu-icon fa-heart"></span>
          <span>Favourites</span>
            <span class="fa menu-icon menu-icon-down fa-caret-down"></span>
        </a>
        <ul class="dropdown-container">
          <li>

            <a href="#" >Favourites</a>
          </li>
          <li>

            <a href="#">Page visitors </a>
          </li>
          <li>

            <a href="#">Likes</a>
          </li>
    
        </ul>
      </li>



  </ul>



      <?php
  	if( ($roles == 'service_provider' || $roles == 'dealer_service_provider') ||in_array("hd_service_provider", $user_roles) || in_array("hd_service_provider_dealer", $user_roles) && $user_type == 'Business Subscriber'){ ?>
      <a class="" href="<?php echo stm_get_author_link( '' );?>/?page=promotions"><i class="fa fa-cog"></i>
          Promotions
      </a>

      <?php } ?>


  </div>

  <script>
  /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */

  // dropdown[i].addEventListener("click", function() {
  // this.classList.toggle("active");
  // var dropdownContent = jQuery(this).next();
  // console.log(dropdownContent.classList);
  // if (dropdownContent.style.display === "block") {
  //   jQuery(dropdownContent).slideUp("slow");
  // } else {
  //   jQuery(dropdownContent).slideDown("slow");
  // }
  // });
  </script>