/* global wp, jQuery */
/**
 * File customizer.js.
 */

( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );
	wp.customize( 'bloggrid_cover_title', function( value ) {
		value.bind( function( to ) {
			$( '.cover-title' ).text( to );
		} );
	} );
	wp.customize( 'bloggrid_cover_subtitle', function( value ) {
		value.bind( function( to ) {
			$( '.cover-description' ).text( to );
		} );
	} );
}( jQuery ) );
