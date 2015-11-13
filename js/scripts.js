/**
 * navigation.js
 *
 * Handles toggling the navigation menu for small screens.
 */
( function() {
	
	// Elements.
	var headerSocial, headerSocialButton;
	
	// Header and social menu on smaller screens.
	headerSocial = document.getElementById( 'header-social-wrap' );
	
	if ( headerSocial ) {
		
		// Toggle button.
		headerSocialButton = document.getElementById( 'header-social-button' );
		
		var navMain = responsiveNav(".header-social-wrap", { // Selector
			transition: 350,                        // Integer: Speed of the transition, in milliseconds
			customToggle: "#header-social-button",  // Selector: Specify the ID of a custom toggle
			init: function () {                     // Set ARIA for menu toggle headerSocialButton
				headerSocialButton.setAttribute( 'aria-expanded', 'false' );
				headerSocialButton.setAttribute( 'aria-pressed', 'false' );
				headerSocialButton.setAttribute( 'aria-controls', 'header-social-wrap' );
			},
			open: function () {
				headerSocialButton.setAttribute( 'aria-expanded', 'true' );
				headerSocialButton.setAttribute( 'aria-pressed', 'true' );
			},
			close: function () {
				headerSocialButton.setAttribute( 'aria-expanded', 'false' );
				headerSocialButton.setAttribute( 'aria-pressed', 'false' );
			},
		});
		
	} // End check for headerSocial.
	
	// Get window width.
	var w = window,
		e = document.documentElement,
		g = document.getElementsByTagName( 'body' )[0],
		x = w.innerWidth || e.clientWidth || g.clientWidth;
	
	// Initialize perfect scrollbar.
	var content   = document.getElementById( 'content' );
	var header    = document.getElementById( 'masthead' );
	var secondary = document.getElementById( 'secondary' );
	
	// Initiliaze scrollbar at certain breakpoint.
	enquire.register( "screen and (min-width: 960px)", {
		
		match : function() {
			
			Ps.initialize( content, {
				suppressScrollX: true,
			});
			
			Ps.initialize( header, {
				suppressScrollX: true,
			});
			
			Ps.initialize( secondary, {
				suppressScrollX: true,
			});
			
		},  
		unmatch : function() {
			Ps.destroy( content );
			Ps.destroy( header );
			Ps.destroy( secondary );
		}

	});

} )();
