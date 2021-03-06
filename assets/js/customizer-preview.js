/* global griddComputeEm */
/* jshint -W098 */
/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function() {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			jQuery( '.site-title a' ).text( to );
		});
	});
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			jQuery( '.site-description' ).text( to );
		});
	});

	wp.customize( 'content_max_width', function( value ) {
		value.bind( function() {
			griddComputeEm();
		});
	});

	_.each( [ 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ], function( i ) {
		var setting = 'nav_' + i + '_bg_color',
			cssVar  = '--nv-' + i + '-sbg';

		wp.customize( setting, function( value ) {
			document.body.style.setProperty( cssVar, jQuery.Color( value.get() ).alpha( 1 ).toHexString( false ) );
			value.bind( function( to ) {
				document.body.style.setProperty( cssVar, jQuery.Color( to ).alpha( 1 ).toHexString( false ) );
			});
		});
	});

	// Compute content-max-width.
	_.each( [ 'gridd_fluid_typography_ratio', 'content_max_width', 'gridd_body_font_size' ], function( setting ) {
		wp.customize( setting, function( value ) {
			value.bind( function( to ) { // eslint-disable-line no-unused-vars
				setTimeout( function() {
					griddComputeEm();
				}, 50 );
			});
		});
	});

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				jQuery( '.site-title, .site-description' ).css({
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				});
			} else {
				jQuery( '.site-title, .site-description' ).css({
					'clip': 'auto',
					'position': 'relative'
				});
				jQuery( '.site-title, .site-title a, .site-description' ).css({
					'color': to
				});
			}
		});
	});

	// Grid control.
	wp.customize( 'gridd_grid', function( value ) {
		value.bind( function( val ) {
			if ( 'string' === typeof val ) {
				val = JSON.parse( val );
			}
		});
	});
} () );
