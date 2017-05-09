/**
 * navigation.js
 *
 * Handles toggling the navigation menu for small screens.
 * Also adds a focus class to parent li's for accessibility.
 * Finally adds a class required to reveal the search in the handheld footer bar.
 */
( function() {
	// Add class to footer search when clicked
	jQuery( window ).load( function() {
		jQuery( '.storefront-handheld-footer-bar .search > a' ).click( function(e) {
			jQuery( this ).parent().toggleClass( 'active' );
			e.preventDefault();
		});
	});

	
} )();
