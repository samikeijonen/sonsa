/**
 * script.js
 *
 * Handles perfect scrollbars.
 */
( function() {
	
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
			
			if ( secondary ) {
				Ps.initialize( secondary, {
					suppressScrollX: true,
				});
			}
			
		},  
		unmatch : function() {
			Ps.destroy( content );
			Ps.destroy( header );
			if ( secondary ) {
				Ps.destroy( secondary );
			}
		}

	}, true );

} )();
