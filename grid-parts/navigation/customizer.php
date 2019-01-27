<?php
/**
 * Customizer options.
 *
 * @package Gridd
 */

use Gridd\Grid_Part\Navigation;
use Gridd\AMP;

/**
 * Register the menus.
 *
 * @since 1.0
 * @return void
 */
function gridd_add_nav_parts() {
	$number = Navigation::get_number_of_nav_menus();

	for ( $i = 1; $i <= $number; $i++ ) {
		gridd_nav_customizer_options( $i );
	}
}
add_action( 'after_setup_theme', 'gridd_add_nav_parts' );

/**
 * This function creates all options for a navigation.
 * We use a parameter since we'll allow multiple navigations.
 *
 * @since 1.0
 * @param int $id The number of this navigation.
 * @return void
 */
function gridd_nav_customizer_options( $id ) {

	/**
	 * Add Customizer Sections.
	 */
	gridd_add_customizer_section(
		"gridd_grid_part_details_nav_$id",
		[
			'title'       => sprintf(
				/* translators: The grid-part label. */
				esc_html__( '%s Options', 'gridd' ),
				/* translators: The navigation number. */
				sprintf( esc_html__( 'Navigation %d', 'gridd' ), absint( $id ) )
			),
			'description' => sprintf(
				'<div class="gridd-section-description">%1$s%2$s</div>',
				( ! Gridd::is_plus_active() ) ? '<div class="gridd-go-plus">' . __( '<a href="https://wplemon.com/gridd-plus" rel="nofollow" target="_blank">Upgrade to <strong>plus</strong></a> for automatic WCAG-compliant colors suggestion on this section and additional options for font-sizes and WooCommerce cart on your menu.', 'gridd' ) . '</div>' : '',
				'<div class="gridd-docs"><a href="https://wplemon.com/documentation/gridd/grid-parts/navigation/" target="_blank" rel="noopener noreferrer nofollow">' . esc_html__( 'Learn more about these settings', 'gridd' ) . '</a></div>'
			),
			'section'     => 'gridd_grid',
		]
	);

	/**
	 * Focus on menu_locations section.
	 */
	gridd_add_customizer_field(
		[
			'settings' => "gridd_logo_focus_on_menu_locations_$id",
			'type'     => 'custom',
			'label'    => esc_html__( 'Looking for your menu items?', 'gridd' ),
			'section'  => "gridd_grid_part_details_nav_$id",
			'default'  => '<div style="margin-bottom:1em;"><button class="button-gridd-focus global-focus button button button-large" data-context="section" data-focus="menu_locations">' . esc_html__( 'Click here to edit your menus', 'gridd' ) . '</button></div>',
		]
	);

	gridd_add_customizer_field(
		[
			'type'            => 'radio-buttonset',
			'settings'        => "gridd_grid_nav_{$id}_collapse_to_icon",
			'label'           => esc_html__( 'Mobile Menu Mode', 'gridd' ),
			'description'     => esc_html__( 'Select when this menu should collapse to an icon.', 'gridd' ),
			'section'         => "gridd_grid_part_details_nav_$id",
			'default'         => 'mobile',
			'transport'       => 'postMessage',
			'choices'         => [
				'never'  => esc_html__( 'Never', 'gridd' ),
				'mobile' => esc_html__( 'Small Screens', 'gridd' ),
				'always' => esc_html__( 'Always', 'gridd' ),
			],
			'partial_refresh' => [
				"gridd_grid_nav_{$id}_collapse_to_icon_template" => [
					'selector'            => ".gridd-tp-nav_{$id}",
					'container_inclusive' => true,
					'render_callback'     => function() use ( $id ) {
						/**
						 * We use include( get_theme_file_path() ) here
						 * because we need to pass the $id var to the template.
						 */
						include get_theme_file_path( 'grid-parts/navigation/template.php' );
						/**
						 * Due to the partial refresh, JS listeners no longer work for the menu.
						 * We need to re-inject the JS here to make previews work after the partial refresh.
						 */
						if ( ! AMP::is_active() ) {
							echo '<script>';
							include get_theme_file_path( 'assets/js/nav.min.js' );
							echo '<script>';
						}
					},
				],
			],
		]
	);

	gridd_add_customizer_field(
		[
			'type'        => 'dimension',
			'settings'    => "gridd_grid_nav_{$id}_padding",
			'label'       => esc_html__( 'Padding', 'gridd' ),
			'description' => __( 'Inner padding for this grid-part. Use any valid CSS value. For details on how padding works, please refer to <a href="https://developer.mozilla.org/en-US/docs/Web/CSS/padding" target="_blank" rel="nofollow">this article</a>.', 'gridd' ),
			'section'     => "gridd_grid_part_details_nav_$id",
			'default'     => '1em',
			'transport'   => 'postMessage',
			'css_vars'    => "--gridd-nav-$id-padding",
		]
	);

	gridd_add_customizer_field(
		[
			'type'        => 'color',
			'label'       => esc_html__( 'Background Color', 'gridd' ),
			'description' => esc_html__( 'Controls the overall background color for this grid-part.', 'gridd' ),
			'settings'    => "gridd_grid_nav_{$id}_bg_color",
			'section'     => "gridd_grid_part_details_nav_$id",
			'default'     => '#ffffff',
			'transport'   => 'postMessage',
			'css_vars'    => "--gridd-nav-$id-bg",
			'choices'     => [
				'alpha' => true,
			],
		]
	);

	gridd_add_customizer_field(
		[
			'type'        => 'kirki-wcag-tc',
			'label'       => esc_html__( 'Items Color', 'gridd' ),
			'description' => esc_html__( 'Select the color used for your menu items. Please choose a color with sufficient contrast with the selected background-color.', 'gridd' ),
			'settings'    => "gridd_grid_nav_{$id}_items_color",
			'section'     => "gridd_grid_part_details_nav_$id",
			'choices'     => [
				'setting' => "gridd_grid_nav_{$id}_bg_color",
			],
			'default'     => '#000000',
			'transport'   => 'postMessage',
			'css_vars'    => "--gridd-nav-$id-color",
		]
	);

	gridd_add_customizer_field(
		[
			'type'        => 'color',
			'label'       => esc_html__( 'Accent Background Color', 'gridd' ),
			'description' => esc_html__( 'Controls the background-color for menu items on hover, as well as for the currently active menu-item. Applies to both parent and child (dropdown) menu items.', 'gridd' ),
			'settings'    => "gridd_grid_nav_{$id}_accent_bg_color",
			'section'     => "gridd_grid_part_details_nav_$id",
			'default'     => '#0f5e97',
			'transport'   => 'postMessage',
			'css_vars'    => "--gridd-nav-$id-accent-bg",
			'choices'     => [
				'alpha' => true,
			],
		]
	);

	gridd_add_customizer_field(
		[
			'type'        => 'kirki-wcag-tc',
			'label'       => esc_html__( 'Accent Items Color', 'gridd' ),
			'description' => esc_html__( 'Select the color used for your menu items on hover, as well as for the currently active menu-item. Applies to both parent and child (dropdown) menu items. Please choose a color with sufficient contrast with the selected background-color.', 'gridd' ),
			'settings'    => "gridd_grid_nav_{$id}_accent_color",
			'section'     => "gridd_grid_part_details_nav_$id",
			'choices'     => [
				'setting' => "gridd_grid_nav_{$id}_accent_bg_color",
			],
			'default'     => '#ffffff',
			'transport'   => 'postMessage',
			'css_vars'    => "--gridd-nav-$id-accent-color",
		]
	);

	gridd_add_customizer_field(
		[
			'type'            => 'checkbox',
			'settings'        => "gridd_grid_nav_{$id}_vertical",
			'label'           => esc_html__( 'Enable Vertical Menu Mode', 'gridd' ),
			'description'     => esc_html__( 'If your layout is column-based and you want a vertical side-navigation enable this option.', 'gridd' ),
			'section'         => "gridd_grid_part_details_nav_$id",
			'default'         => false,
			'active_callback' => [
				[
					'setting'  => "gridd_grid_nav_{$id}_collapse_to_icon",
					'value'    => 'always',
					'operator' => '!==',
				],
			],
			'transport'       => 'postMessage',
			'partial_refresh' => [
				"gridd_grid_nav_{$id}_vertical_template" => [
					'selector'            => ".gridd-tp-nav_{$id}",
					'container_inclusive' => true,
					'render_callback'     => function() use ( $id ) {
						/**
						 * We use include( get_theme_file_path() ) here
						 * because we need to pass the $id var to the template.
						 */
						include get_theme_file_path( 'grid-parts/navigation/template.php' );
						/**
						 * Due to the partial refresh, JS listeners no longer work for the menu.
						 * We need to re-inject the JS here to make previews work after the partial refresh.
						 */
						if ( ! AMP::is_active() ) {
							echo '<script>';
							include get_theme_file_path( 'assets/js/nav.min.js' );
							echo '<script>';
						}
					},
				],
			],
		]
	);

	gridd_add_customizer_field(
		[
			'type'            => 'radio-buttonset',
			'settings'        => "gridd_grid_nav_{$id}_justify_content",
			'label'           => esc_html__( 'Justify Items', 'gridd' ),
			'description'     => esc_html__( 'Choose how menu items will be spread horizontally inside the menu container.', 'gridd' ),
			'tooltip'         => esc_html__( 'This helps distribute extra free space left over when all the items on a line have reached their maximum size. It also exerts some control over the alignment of items when they overflow the line.', 'gridd' ),
			'section'         => "gridd_grid_part_details_nav_$id",
			'default'         => 'center',
			'transport'       => 'postMessage',
			'css_vars'        => "--gridd-nav-$id-justify",
			'active_callback' => [
				[
					'setting'  => "gridd_grid_nav_{$id}_vertical",
					'operator' => '!==',
					'value'    => true,
				],
				[
					'setting'  => "gridd_grid_nav_{$id}_collapse_to_icon",
					'value'    => 'always',
					'operator' => '!==',
				],
			],
			'choices'         => [
				'flex-start'    => '<span class="gridd-flexbox-svg-option" title="' . esc_attr__( 'Start', 'gridd' ) . '"><span class="screen-reader-text">' . esc_html__( 'Start', 'gridd' ) . '</span>' . gridd_get_file_contents( 'assets/images/flexbox/justify-content-flex-start.svg' ) . '</span>',
				'flex-end'      => '<span class="gridd-flexbox-svg-option" title="' . esc_attr__( 'End', 'gridd' ) . '"><span class="screen-reader-text">' . esc_html__( 'End', 'gridd' ) . '</span>' . gridd_get_file_contents( 'assets/images/flexbox/justify-content-flex-end.svg' ) . '</span>',
				'center'        => '<span class="gridd-flexbox-svg-option" title="' . esc_attr__( 'Center', 'gridd' ) . '"><span class="screen-reader-text">' . esc_html__( 'Center', 'gridd' ) . '</span>' . gridd_get_file_contents( 'assets/images/flexbox/justify-content-center.svg' ) . '</span>',
				'space-between' => '<span class="gridd-flexbox-svg-option" title="' . esc_attr__( 'Space Between', 'gridd' ) . '"><span class="screen-reader-text">' . esc_html__( 'Space Between', 'gridd' ) . '</span>' . gridd_get_file_contents( 'assets/images/flexbox/justify-content-space-between.svg' ) . '</span>',
				'space-around'  => '<span class="gridd-flexbox-svg-option" title="' . esc_attr__( 'Space Around', 'gridd' ) . '"><span class="screen-reader-text">' . esc_html__( 'Space Around', 'gridd' ) . '</span>' . gridd_get_file_contents( 'assets/images/flexbox/justify-content-space-around.svg' ) . '</span>',
				'space-evenly'  => '<span class="gridd-flexbox-svg-option" title="' . esc_attr__( 'Space Evenly', 'gridd' ) . '"><span class="screen-reader-text">' . esc_html__( 'Space Evenly', 'gridd' ) . '</span>' . gridd_get_file_contents( 'assets/images/flexbox/justify-content-space-evenly.svg' ) . '</span>',
			],
		]
	);

	gridd_add_customizer_field(
		[
			'type'            => 'radio-buttonset',
			'settings'        => "gridd_grid_nav_{$id}_expand_icon",
			'label'           => esc_html__( 'Expand Icon', 'gridd' ),
			'description'     => esc_html__( 'Select the icon that should be used to expand the navigation.', 'gridd' ),
			'section'         => "gridd_grid_part_details_nav_$id",
			'default'         => 'plus-5',
			'transport'       => 'refresh',
			'choices'         => Navigation::get_expand_svgs(),
			'active_callback' => [
				[
					'setting'  => "gridd_grid_nav_{$id}_collapse_to_icon",
					'value'    => 'never',
					'operator' => '!==',
				],
			],
			'transport'       => 'postMessage',
			'partial_refresh' => [
				"gridd_grid_nav_{$id}_expand_icon_template" => [
					'selector'            => ".gridd-tp-nav_{$id}",
					'container_inclusive' => true,
					'render_callback'     => function() use ( $id ) {
						/**
						 * We use include( get_theme_file_path() ) here
						 * because we need to pass the $id var to the template.
						 */
						include get_theme_file_path( 'grid-parts/navigation/template.php' );
						/**
						 * Due to the partial refresh, JS listeners no longer work for the menu.
						 * We need to re-inject the JS here to make previews work after the partial refresh.
						 */
						if ( ! AMP::is_active() ) {
							echo '<script>';
							include get_theme_file_path( 'assets/js/nav.min.js' );
							echo '<script>';
						}
					},
				],
			],
		]
	);

	gridd_add_customizer_field(
		[
			'type'            => 'radio-buttonset',
			'settings'        => "gridd_grid_nav_{$id}_expand_icon_position",
			'label'           => esc_html__( 'Expand Icon Position', 'gridd' ),
			'description'     => esc_html__( 'Changes the position of the collapsed-menu icon inside the area.', 'gridd' ),
			'section'         => "gridd_grid_part_details_nav_$id",
			'default'         => 'center-right',
			'transport'       => 'refresh',
			'choices'         => [
				'top-left'      => esc_html__( 'Top Left', 'gridd' ),
				'top-center'    => esc_html__( 'Top Center', 'gridd' ),
				'top-right'     => esc_html__( 'Top Right', 'gridd' ),
				'center-left'   => esc_html__( 'Center Left', 'gridd' ),
				'center-center' => esc_html__( 'Center Center', 'gridd' ),
				'center-right'  => esc_html__( 'Center Right', 'gridd' ),
				'bottom-left'   => esc_html__( 'Bottom Left', 'gridd' ),
				'bottom-center' => esc_html__( 'Bottom Center', 'gridd' ),
				'bottom-right'  => esc_html__( 'Bottom Right', 'gridd' ),
			],
			'active_callback' => [
				[
					'setting'  => "gridd_grid_nav_{$id}_collapse_to_icon",
					'value'    => 'never',
					'operator' => '!==',
				],
			],
			'transport'       => 'postMessage',
			'partial_refresh' => [
				"gridd_grid_nav_{$id}_expand_icon_position_template" => [
					'selector'            => ".gridd-tp-nav_{$id}",
					'container_inclusive' => true,
					'render_callback'     => function() use ( $id ) {
						/**
						 * We use include( get_theme_file_path() ) here
						 * because we need to pass the $id var to the template.
						 */
						include get_theme_file_path( 'grid-parts/navigation/template.php' );
						/**
						 * Due to the partial refresh, JS listeners no longer work for the menu.
						 * We need to re-inject the JS here to make previews work after the partial refresh.
						 */
						if ( ! AMP::is_active() ) {
							echo '<script>';
							include get_theme_file_path( 'assets/js/nav.min.js' );
							echo '<script>';
						}
					},
				],
			],
		]
	);
}
