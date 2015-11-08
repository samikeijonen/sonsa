/**
 * Sonsa JavaScript file.
 *
 * Set up the navigation and sidebar toggle.
 */
( function( $ ) {
	
	var body, page, mainNav, mainNavWrap, menuToggle;
	
	// Set up vars.
	page        = $( '#page' );
	mainNav     = page.find( '#secondary' );
	mainNavWrap = page.find( '#secondary > .wrap' );
	menuToggle  = page.find( '.sidebar-nav-toggle' );

	/**
	 * Set up the main navigation toggle. This sets
	 * up a toggle for navigation to overlay the window.
	 */
	( function() {
		
		// Return early if menuToggle is missing.
		if ( ! menuToggle.length ) {
			return;
		}
		
		// Add an initial values for the attribute.
		menuToggle.attr( 'aria-expanded', 'false' );
		mainNav.attr( 'aria-expanded', 'false' );
	
		menuToggle.on( 'click', function( event ) {
			
			// Toggle classes.
			$( 'html' ).toggleClass( 'disable-scroll' );
			$( 'body' ).toggleClass( 'main-navigation-open' );
			mainNav.toggleClass( 'open' );
			
			// Hide or show element after animation.
			if ( mainNav.hasClass( 'open' ) ) {
				
				$( mainNav ).css( 'display', 'block' );
				
				//$( mainNav ).addClass( 'fadeInLeft' );
				//$( mainNavWrap ).removeClass( 'fadeOutLeft' );
				
			} else {
				
				setTimeout( function() {
					$( mainNav ).css( 'display', 'none' );
				}, 550 );
				
				//$( mainNavWrap ).addClass( 'fadeOutLeft' );
				//$( mainNav ).removeClass( 'fadeInLeft' );
				
			}
			
			// If aria-expanded is false, set it to true. And vica versa.
			$( menuToggle ).attr( 'aria-expanded', $( menuToggle ).attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
			$( mainNav ).attr( 'aria-expanded', $( mainNav ).attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
		
		});
		
	} )();

	/**
	 * Closes the main navigation or sidebar when
	 * the esc key is pressed.
	*/
	$( document ).keyup( function( event ) {
		if ( event.keyCode == 27 ) {
			
			if ( $( 'body' ).hasClass( 'main-navigation-open' ) ) {
				
				$( 'html' ).removeClass( 'disable-scroll' );
				$( 'body' ).removeClass( 'main-navigation-open' );
				mainNav.removeClass( 'open' );
				
				setTimeout( function() {
					$( mainNav ).css( 'display', 'none' );
				}, 550 );
				
				//$( mainNav ).addClass( 'fadeOutLeft' );
				$( mainNav ).removeClass( 'fadeInLeft' );
				
			}
				
		}
		
	});
} )( jQuery );