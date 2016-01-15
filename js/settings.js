/**
 * Sonsa JavaScript file.
 *
 * Set up the navigation and sidebar toggle.
 */
( function( $ ) {
	
	var body, page, mainNav, menuButton, menuToggle;
	
	// Set up vars.
	page       = $( '#page' );
	mainNav    = page.find( '#sonsa-secondary' );
	menuButton = page.find( '#sidebar-nav-toggle' );
	menuToggle = page.find( '.sidebar-nav-toggle' );
	
	// Preload page and fade the content.
	$( window ).load( function() { // makes sure the whole site is loaded
		$( '#status' ).fadeOut(); // will first fade out the loading animation
		$( '#preloader' ).delay( 350 ).fadeOut( 'slow' ); // will fade out the white DIV that covers the website.
	});

	/**
	 * Set up the off canvas navigation toggle. This sets
	 * up a toggle for off canvas sidebar navigation.
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
	 * Closes the off canvas sidebar navigation when
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
			
				// If aria-expanded is false, set it to true. And vica versa.
				$( menuToggle ).attr( 'aria-expanded', $( menuToggle ).attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
				$( mainNav ).attr( 'aria-expanded', $( mainNav ).attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );			
			
			}
				
		}
		
	});
	
	// Add the logic for tab and shift+tab inside Sidebar.
	function onResizeFocus() {
		
		var focusable, firstFocusable, lastFocusable;
	
		// Get all, first and last focusable elements from the Sidebar.
		focusable      = mainNav.find( 'select, input, textarea, button, a' ).filter( ':visible' );
		firstFocusable = focusable.first();
		lastFocusable  = focusable.last();

		// Redirect last tab to first input or to menu button.
		lastFocusable.on( 'keydown', function ( e ) {
			if ( ( e.keyCode === 9 && !e.shiftKey ) ) {
				e.preventDefault();
				
				if ( window.innerWidth < 960 ) {
					firstFocusable.focus(); // Set focus on first element - that's actually close menu button.
				} else {
					menuButton.focus(); // Set focus on menu button.
				}
				
			}
		});

		// Redirect first shift+tab to last input or to menu button.
		firstFocusable.on( 'keydown', function ( e ) {
			if ( ( e.keyCode === 9 && e.shiftKey ) ) {
				e.preventDefault();
		
				if ( window.innerWidth < 960 ) {
					lastFocusable.focus(); // Set focus on last element.
				} else {
					menuButton.focus(); // Set focus on menu button.
				}
				
			}
		});

	}
	
	// Call for onResizeFocus function.
	$( document ).ready( function() {
		$( window )
			.on( 'load', onResizeFocus )
			.on( 'resize', function() {
				onResizeFocus();
			} );
	} );
	
} )( jQuery );