/**
 * navigation.js
 *
 * Handles toggling the navigation menu for small screens.
 */
( function() {
	var container, button, page;
	
	// Off-canvas sidebar
	container = document.getElementById( 'secondary' );
	if ( container ) {

	
		button = document.getElementById( 'sidebar-nav-toggle' );
		page   = document.getElementById( 'page' );
		var navMain = responsiveNav(".secondary", { // Selector
			animate: false,                         // Boolean: Use CSS3 transitions, true or false
			customToggle: "#sidebar-nav-toggle",    // Selector: Specify the ID of a custom toggle
			init: function () {                     // Set ARIA for menu toggle button
				button.setAttribute( 'aria-expanded', 'false' );
				button.setAttribute( 'aria-pressed', 'false' );
				button.setAttribute( 'aria-controls', 'secondary' );
			},
			open: function () {
				button.setAttribute( 'aria-expanded', 'true' );
				button.setAttribute( 'aria-pressed', 'true' );
				addClass( page, 'sidebar-active' );
			},
			close: function () {
				button.setAttribute( 'aria-expanded', 'false' );
				button.setAttribute( 'aria-pressed', 'false' );
				removeClass( page, 'sidebar-active' );
			},
		});
		
	} // End check for container.
	
	// Get window width.
	var w = window,
		e = document.documentElement,
		g = document.getElementsByTagName('body')[0],
		x = w.innerWidth || e.clientWidth || g.clientWidth;
	
	// initialize perfect scrollbar
	var content = document.getElementById( 'content' );
	var header = document.getElementById( 'masthead' );
	
	// Initiliaze scrollbar at certain breakpoint.
	enquire.register( "screen and (min-width: 960px)", {
		
		match : function() {
			
			Ps.initialize( content, {
				wheelSpeed: 10,
				suppressScrollX: true,
			});
			
			Ps.initialize( header, {
				wheelSpeed: 10,
				suppressScrollX: true,
			});
			
		},  
		unmatch : function() {
			Ps.destroy( content );
			Ps.destroy( header );
		}

	});

} )();

	/**
	 * Adds a class to any element
	 *
	 * @param {element} element
	 * @param {string}  class
	 */
      addClass = function (el, cls) {
        if (el.className.indexOf(cls) !== 0) {
          el.className += " " + cls;
          el.className = el.className.replace(/(^\s*)|(\s*$)/g,"");
        }
      }
    
      /**
       * Remove a class from any element
       *
       * @param  {element} element
       * @param  {string}  class
       */
      removeClass = function (el, cls) {
        var reg = new RegExp("(\\s|^)" + cls + "(\\s|$)");
        el.className = el.className.replace(reg, " ").replace(/(^\s*)|(\s*$)/g,"");
      }
