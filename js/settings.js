/**
 * Sonsa JavaScript file.
 *
 * Set up the navigation and sidebar toggle.
 */
( function( $ ) {
	
	var body, page, mainNav, mainNavWrap, menuButton, menuToggle;
	
	// Set up vars.
	page        = $( '#page' );
	mainNav     = page.find( '#secondary' );
	mainNavWrap = page.find( '#secondary > .wrap' );
	menuButton  = page.find( '#sidebar-nav-toggle' );
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
				
				// Enable focus.
				mainNav.attr( 'tabindex', -1 );
				mainNav.focus();
				
			} else {
				
				// Remove tabindex.
				mainNav.removeAttr( 'tabindex' );

				// Enable focus on toggle button.
				menuButton.focus();
				
			}
			
			// Change button text when opening and closing the sidebar.
			menuToggle.html( menuToggle.html() === screenReaderText.expand ? screenReaderText.collapse : screenReaderText.expand );
			
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
				
				// Remove tabindex.
				mainNav.removeAttr( 'tabindex' );
				
				// Enable focus on toggle button.
				menuButton.focus();
				
				// Change button text when opening and closing the sidebar.
				menuToggle.html( menuToggle.html() === screenReaderText.expand ? screenReaderText.collapse : screenReaderText.expand );
			
				
			}
				
		}
		
	});	
	
} )( jQuery );