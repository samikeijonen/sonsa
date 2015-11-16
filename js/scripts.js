/**
 * script.js
 *
 * Handles perfect scrollbars.
 */
( function() {
	
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
