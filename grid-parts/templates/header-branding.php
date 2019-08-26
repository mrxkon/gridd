<?php
/**
 * Template part for the Header Branding.
 *
 * @package Gridd
 * @since 1.0
 */

use Gridd\Style;
use Gridd\Theme;

$style = Style::get_instance( 'grid-part/header/branding' );
$style->add_string( ':root{--header-textcolor:#' . esc_attr( trim( get_header_textcolor(), '#' ) ) . ';}' );
$style->add_file( get_theme_file_path( 'grid-parts/styles/header/styles-branding.min.css' ) );
$style->add_vars(
	[
		'--gridd-branding-bg'               => get_theme_mod( 'gridd_grid_header_branding_background_color', '#fff' ),
		'--gridd-branding-padding'          => get_theme_mod( 'gridd_grid_header_branding_padding', '0' ),
		'--gridd-branding-horizontal-align' => get_theme_mod( 'gridd_grid_header_branding_horizontal_align', 'left' ),
		'--gridd-branding-vertical-align'   => get_theme_mod( 'gridd_grid_header_branding_vertical_align', 'center' ),
		'--gridd-branding-elements-padding' => get_theme_mod( 'gridd_branding_inline_spacing', '0.5' ),
		'--gridd-tagline-size'              => get_theme_mod( 'gridd_branding_tagline_size', '1' ),
		'--header-textcolor'                => '#' . str_replace( '#', '', get_header_textcolor() ),
		'--gridd-sitetitle-size'            => get_theme_mod( 'gridd_branding_sitetitle_size', '2' ),
		'--gridd-logo-max-width'            => get_theme_mod( 'gridd_logo_max_width', '100' ),
	]
);
$style->the_css( 'gridd-inline-css-header-branding' );

$wrapper_class  = 'gridd-tp gridd-tp-header_branding';
$wrapper_class .= get_theme_mod( 'gridd_branding_inline', false ) ? ' inline' : ' vertical';
$wrapper_class .= ( has_custom_logo() ) ? ' has-logo' : '';
?>

<div <?php Theme::print_attributes( [ 'class' => $wrapper_class ], 'wrapper-header_branding' ); ?>>
	<?php if ( has_custom_logo() ) : ?>
		<?php the_custom_logo(); ?>
	<?php endif; ?>

	<?php if ( is_front_page() && is_home() ) : ?>
		<h1 class="site-title h3<?php echo ( ! display_header_text() ) ? ' hidden' : ''; ?>">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<?php bloginfo( 'name' ); ?>
			</a>
		</h1>
	<?php else : ?>
		<p class="site-title h3<?php echo ( ! display_header_text() ) ? ' hidden' : ''; ?>">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<?php bloginfo( 'name' ); ?>
			</a>
		</p>
	<?php endif; ?>
	<?php $description = get_bloginfo( 'description', 'display' ); ?>
	<?php if ( $description || is_customize_preview() ) : ?>
		<p class="site-description<?php echo ( ! display_header_text() ) ? ' hidden' : ''; ?>"><?php echo wp_kses_post( $description ); ?></p>
	<?php endif; ?>
</div>
