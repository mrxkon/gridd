<?php
/**
 * Template part for the footer.
 *
 * @package Gridd
 * @since 1.0
 */

use Gridd\Theme;
use Gridd\Grid;
use Gridd\Grid_Part\Footer;
use Gridd\Style;

// Get the grid settings.
$settings = Grid::get_options( 'gridd_footer_grid', Footer::get_grid_defaults() );

$style = Style::get_instance( 'grid-part/footer' );

// Add the main grid styles.
$style->add_string(
	Grid::get_styles_responsive(
		[
			'context'    => 'footer',
			'large'      => Grid::get_options( 'gridd_footer_grid' ),
			'breakpoint' => get_theme_mod( 'gridd_mobile_breakpoint', '992px' ),
			'selector'   => '.gridd-tp-footer > .inner',
			'prefix'     => true,
		]
	)
);

// Add the stylesheet.
$style->add_file( get_theme_file_path( 'grid-parts/styles/footer/styles.min.css' ) );

// Force-override parts background images.
if ( get_theme_mod( 'gridd_grid_part_details_footer_parts_background_override', false ) ) {
	$style->add_string( '.gridd-tp.gridd-tp-footer .gridd-tp,.gridd-tp.gridd-tp-footer .gridd-tp inner,.site-info{background:none !important;}' );
}

// Add css-variables to be replaced.
$style->add_vars(
	[
		'--ft-bg'    => get_theme_mod( 'gridd_grid_footer_background_color', '#ffffff' ),
		'--ft-bt-w'  => get_theme_mod( 'gridd_grid_footer_border_top_width', 1 ),
		'--ft-bt-cl' => get_theme_mod( 'gridd_grid_footer_border_top_color', 'rgba(0,0,0,.1)' ),
		'--ft-mw'    => get_theme_mod( 'gridd_grid_footer_max_width', '' ),
	]
);

$attrs = [
	'class' => 'gridd-tp gridd-tp-footer',
	'role'  => 'contentinfo',
];
?>

<div <?php Theme::print_attributes( $attrs, 'wrapper-footer' ); ?>>
	<?php
	/**
	 * Print the styles.
	 */
	$style->the_css( 'gridd-inline-css-footer' );
	?>
	<div class="inner">
		<?php
		if ( isset( $settings['areas'] ) ) {
			foreach ( array_keys( $settings['areas'] ) as $part ) {

				if ( 0 === strpos( $part, 'footer_sidebar_' ) ) {
					$sidebar_id = (int) str_replace( 'footer_sidebar_', '', $part );
					if ( apply_filters( 'gridd_render_grid_part', true, 'footer_sidebar_' . $sidebar_id ) ) {
						/**
						 * Footer Sidebars.
						 * We use include( get_theme_file_path() ) here
						 * because we need to pass the $sidebar_id var to the template.
						 */
						include get_theme_file_path( 'grid-parts/templates/footer-sidebar.php' );
					}
				} elseif ( 'footer_social_media' === $part && apply_filters( 'gridd_render_grid_part', true, 'footer_social_media' ) ) {
					/**
					 * Social Media.
					 */
					Theme::get_template_part( 'grid-parts/templates/footer-social-media' );

				} elseif ( 'footer_copyright' === $part && apply_filters( 'gridd_render_grid_part', true, 'footer_copyright' ) ) {
					/**
					 * Copyright.
					 */
					Theme::get_template_part( 'grid-parts/templates/footer-copyright' );

				} else {
					do_action( 'gridd_the_grid_part', $part );
				}
			}
		}
		?>
	</div>
</div>
