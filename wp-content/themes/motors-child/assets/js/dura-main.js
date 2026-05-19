// DURAMENU V1.0 MAIN JS

    duraFunc = function()
	{
		// Strict Mode
		"use strict";
		
		// Scroll To Fixed Header
		$(window).scroll(function(){
		  if ($(window).scrollTop() >= 30) {
			$( ".absolute" ).css( "top","-100px" );
			$( ".nav-container" ).addClass( "nav-container-fixed" );
			$( ".clearance" ).addClass( "clearance-fixed" );
		  }
		  else {
			$( ".absolute" ).css( "top","0px" );
			$( ".nav-container" ).removeClass( "nav-container-fixed" );
			$( ".clearance" ).removeClass( "clearance-fixed" );
		  }
		  // SCROLL TO TOP - Set scroll amount
		  if ($(this).scrollTop() > 100) {
			$('.scrollup').fadeIn();
		  } else {
			$('.scrollup').fadeOut();
		  }
		});
		
		// SCROLL TO TOP - Click animation
		$('.scrollup').on('click', function() {
			$("html, body").animate({
				scrollTop: 0
			}, 600);
			return false;
		});
			
		// OVERLAY FUNCTIONS - When you hover a menu, a background div having an opacity is visible	
		$( ".dura-search" ).on('click', function() {
			$( ".overlay" ).addClass( "overlay-visible" );
		});
		
		$(document).mouseup(function (e)
		{
			var container = $(".dura-search");
		
			if (!container.is(e.target) // if the target of the click isn't the container...
				&& container.has(e.target).length === 0) // ... nor a descendant of the container
			{
				$( ".overlay" ).removeClass( "overlay-visible" );
			}
		});
		
		// LOGIN/REGISTER TABS
		$('#loginTab').on('click', function(e) {
			e.preventDefault()
			$(this).tab('show')
		})
			
		// PREVENT DROPDOWN TO GET CLOSED WHEN CLICKED ON LOGIN/REGISTER TABS
		$('.dropdown-menu a[data-toggle="tab"]').on('click', function(e) {
			e.stopPropagation()        
			$(this).tab('show')
		})
		
		// TABBED-MENU RETURN TO ACTIVE TAB ALWAYS WHEN MOUSEOUT
		$( "div.nav-container .navbar ul.nav > li > div.tabbed-menu > ul > li" ).mouseover(function() {
			if ( !$(this).is(":first-child") ) {
				$( "div.nav-container .navbar ul.nav > li > div.tabbed-menu > ul > li:first-child a" ).removeClass( "active-tab" )
			}
		});
		
		$( "div.nav-container .navbar ul.nav > li > div.tabbed-menu > ul > li" ).mouseleave(function() {
			$( "div.nav-container .navbar ul.nav > li > div.tabbed-menu > ul > li:first-child a" ).addClass( "active-tab" )
		});
		
		// BOOTSTRAP CAROUSEL
		$('.carousel').carousel({
			interval: 3000
		})
		
	};
	duraFunc();
	
