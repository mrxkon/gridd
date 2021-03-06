<?php
/**
 * Customizer options.
 *
 * @package Gridd
 */

use Gridd\Grid_Part\Navigation;
use Gridd\Customizer\Sanitize;
use Gridd\Theme;

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

	$sanitization = new Sanitize();

	/**
	 * Add Customizer Sections.
	 */
	new \Kirki\Section(
		"nav_$id",
		[
			/* translators: The navigation number. */
			'title'           => sprintf( esc_html__( 'Navigation %d', 'gridd' ), absint( $id ) ),
			'priority'        => 70,
			'type'            => 'kirki-expanded',
			'panel'           => 'theme_options',
			'active_callback' => function() use ( $id ) {
				return \Gridd\Customizer::is_section_active_part( "nav_$id" );
			},
		]
	);

	new \Kirki\Field\Checkbox_Switch(
		[
			'settings'  => "nav_{$id}_custom_options",
			'section'   => "nav_$id",
			'default'   => false,
			'transport' => 'refresh',
			'priority'  => -999,
			'choices'   => [
				'off' => esc_html__( 'Inherit Options', 'gridd' ),
				'on'  => esc_html__( 'Override Options', 'gridd' ),
			],
		]
	);

	new \Kirki\Field\RadioButtonset(
		[
			'settings'          => "nav_{$id}_responsive_behavior",
			'label'             => esc_html__( 'Responsive Behavior', 'gridd' ),
			'description'       => __( 'Select how this navigation should behave in smaller screens.', 'gridd' ),
			'section'           => "nav_$id",
			'default'           => 'desktop-normal mobile-icon',
			'choices'           => [
				'desktop-normal mobile-icon'   => esc_html__( 'Default', 'gridd' ),
				'desktop-icon mobile-icon'     => esc_html__( 'Collapsed', 'gridd' ),
				'desktop-normal mobile-hidden' => esc_html__( 'Hide on Mobile', 'gridd' ),
			],
			'sanitize_callback' => function( $value ) {
				if ( 'desktop-normal mobile-icon' !== $value && 'desktop-icon mobile-icon' !== $value && 'desktop-normal mobile-hidden' !== $value ) {
					return 'desktop-normal mobile-icon';
				}
				return $value;
			},
		]
	);

	new \Kirki\Field\ReactColor(
		[
			'label'           => esc_html__( 'Background Color', 'gridd' ),
			'settings'        => "nav_{$id}_bg_color",
			'section'         => "nav_$id",
			'default'         => '#ffffff',
			'transport'       => 'auto',
			'output'          => [
				[
					'element'  => ".gridd-tp-nav_{$id}.custom-options",
					'property' => '--bg',
				],
			],
			'choices'         => [
				'formComponent' => 'TwitterPicker',
				'colors'        => \Gridd\Theme::get_colorpicker_palette(),
			],
			'active_callback' => function() use ( $id ) {
				return get_theme_mod( "nav_{$id}_custom_options", false );
			},
		]
	);

	new \WPLemon\Field\WCAGTextColor(
		[
			'label'             => esc_html__( 'Items Color', 'gridd' ),
			'settings'          => "nav_{$id}_items_color",
			'section'           => "nav_$id",
			'choices'           => [
				'backgroundColor' => "nav_{$id}_bg_color",
				'appearance'      => 'hidden',
			],
			'default'           => '#000000',
			'transport'         => 'auto',
			'output'            => [
				[
					'element'  => ".gridd-tp-nav_{$id}.custom-options",
					'property' => '--cl',
				],
			],
			'sanitize_callback' => [ $sanitization, 'color_hex' ],
			'active_callback'   => function() use ( $id ) {
				return get_theme_mod( "nav_{$id}_custom_options", false );
			},
		]
	);

	new \WPLemon\Field\WCAGLinkColor(
		[
			'label'             => esc_html__( 'Accent Color', 'gridd' ),
			'description'       => esc_html__( 'Select the hue for you active item. The color will be auto-calculated to ensure maximum readability.', 'gridd' ),
			'settings'          => "nav_{$id}_accent_color",
			'section'           => "nav_$id",
			'default'           => '#0f5e97',
			'transport'         => 'auto',
			'output'            => [
				[
					'element'  => ".gridd-tp-nav_{$id}.custom-options",
					'property' => '--acl',
				],
			],
			'choices'           => [
				'backgroundColor' => "nav_{$id}_bg_color",
				'textColor'       => "nav_{$id}_items_color",
				'linksUnderlined' => true,
				'forceCompliance' => get_theme_mod( 'target_color_compliance', 'auto' ),
			],
			'sanitize_callback' => [ $sanitization, 'color_hex' ],
			'active_callback'   => '__return_false',
		]
	);

	new \Kirki\Field\Checkbox(
		[
			'settings'        => "nav_{$id}_vertical",
			'label'           => esc_html__( 'Enable Vertical Menu Mode', 'gridd' ),
			'description'     => esc_html__( 'If your layout is column-based and you want a vertical side-navigation enable this option.', 'gridd' ),
			'section'         => "nav_$id",
			'default'         => false,
			'active_callback' => [
				[
					'setting'  => "nav_{$id}_responsive_behavior",
					'value'    => 'desktop-icon mobile-icon',
					'operator' => '!==',
				],
			],
		]
	);

	new \Kirki\Field\RadioButtonset(
		[
			'settings'          => "nav_{$id}_justify_content",
			'label'             => esc_html__( 'Justify Items', 'gridd' ),
			'description'       => esc_html__( 'Choose how menu items will be spread horizontally inside the menu container.', 'gridd' ),
			'section'           => "nav_$id",
			'default'           => 'center',
			'transport'         => 'auto',
			'output'            => [
				[
					'element'  => ".gridd-tp-nav_$id",
					'property' => '--j',
				],
			],
			'active_callback'   => [
				[
					'setting'  => "nav_{$id}_vertical",
					'operator' => '!==',
					'value'    => true,
				],
				[
					'setting'  => "nav_{$id}_responsive_behavior",
					'value'    => 'desktop-icon mobile-icon',
					'operator' => '!==',
				],
			],
			'choices'           => [
				'flex-start'    => '<span class="gridd-flexbox-svg-option" title="' . esc_attr__( 'Start', 'gridd' ) . '"><span class="screen-reader-text">' . esc_html__( 'Start', 'gridd' ) . '</span>' . Theme::get_fcontents( 'assets/images/flexbox/justify-content-flex-start.svg' ) . '</span>',
				'flex-end'      => '<span class="gridd-flexbox-svg-option" title="' . esc_attr__( 'End', 'gridd' ) . '"><span class="screen-reader-text">' . esc_html__( 'End', 'gridd' ) . '</span>' . Theme::get_fcontents( 'assets/images/flexbox/justify-content-flex-end.svg' ) . '</span>',
				'center'        => '<span class="gridd-flexbox-svg-option" title="' . esc_attr__( 'Center', 'gridd' ) . '"><span class="screen-reader-text">' . esc_html__( 'Center', 'gridd' ) . '</span>' . Theme::get_fcontents( 'assets/images/flexbox/justify-content-center.svg' ) . '</span>',
				'space-between' => '<span class="gridd-flexbox-svg-option" title="' . esc_attr__( 'Space Between', 'gridd' ) . '"><span class="screen-reader-text">' . esc_html__( 'Space Between', 'gridd' ) . '</span>' . Theme::get_fcontents( 'assets/images/flexbox/justify-content-space-between.svg' ) . '</span>',
				'space-around'  => '<span class="gridd-flexbox-svg-option" title="' . esc_attr__( 'Space Around', 'gridd' ) . '"><span class="screen-reader-text">' . esc_html__( 'Space Around', 'gridd' ) . '</span>' . Theme::get_fcontents( 'assets/images/flexbox/justify-content-space-around.svg' ) . '</span>',
				'space-evenly'  => '<span class="gridd-flexbox-svg-option" title="' . esc_attr__( 'Space Evenly', 'gridd' ) . '"><span class="screen-reader-text">' . esc_html__( 'Space Evenly', 'gridd' ) . '</span>' . Theme::get_fcontents( 'assets/images/flexbox/justify-content-space-evenly.svg' ) . '</span>',
			],
			'hide_input'        => true,
			'sanitize_callback' => function( $value ) {
				if ( ! in_array( $value, [ 'flex-start', 'flex-end', 'center', 'space-between', 'space-around', 'space-evenly' ], true ) ) {
					return 'center';
				}
				return $value;
			},
		]
	);

	new \Kirki\Field\Text(
		[
			'settings'          => "nav_{$id}_expand_label",
			'label'             => esc_html__( 'Expand Label', 'gridd' ),
			'section'           => "nav_$id",
			'default'           => esc_html__( 'MENU', 'gridd' ),
			'transport'         => 'refresh',
			'sanitize_callback' => 'esc_html',
			'active_callback'   => function() use ( $id ) {
				return get_theme_mod( "nav_{$id}_custom_options", false );
			},
		]
	);

	new \Kirki\Field\RadioButtonset(
		[
			'settings'          => "nav_{$id}_expand_icon",
			'label'             => esc_html__( 'Expand Icon', 'gridd' ),
			'section'           => "nav_$id",
			'default'           => 'menu-1',
			'transport'         => 'refresh',
			'choices'           => Navigation::get_expand_svgs(),
			'hide_input'        => true,
			'sanitize_callback' => function( $value ) {
				return in_array( $value, array_keys( Navigation::get_expand_svgs() ), true ) ? $value : 'menu-1';
			},
			'active_callback'   => function() use ( $id ) {
				return get_theme_mod( "nav_{$id}_custom_options", false );
			},
		]
	);

	new \Kirki\Field\RadioButtonset(
		[
			'settings'          => "nav_{$id}_expand_icon_position",
			'label'             => esc_html__( 'Expand Icon Position', 'gridd' ),
			'section'           => "nav_$id",
			'default'           => 'center-right',
			'transport'         => 'refresh',
			'choices'           => [
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
			'sanitize_callback' => function( $value ) {
				if ( ! in_array( $value, [ 'top-left', 'top-center', 'top-right', 'center-left', 'center-center', 'center-right', 'bottom-left', 'bottom-center', 'bottom-right' ], true ) ) {
					return 'center-right';
				}
				return $value;
			},
			'active_callback'   => function() use ( $id ) {
				return get_theme_mod( "nav_{$id}_custom_options", false );
			},
		]
	);

	/**
	 * WIP
	new \Kirki\Field\RadioButtonset(
		[
			'settings'          => "nav_{$id}_style",
			'label'             => esc_html__( 'Hover/Focus Styles', 'gridd' ),
			'section'           => "nav_$id",
			'default'           => 'default',
			'transport'         => 'refresh',
			'choices'           => [
				'default' => esc_html__( 'Default', 'gridd' ),
				'alt1'    => esc_html__( 'Bottom Lines', 'gridd' ),
			],
			'sanitize_callback' => function( $value ) {
				if ( ! in_array( $value, [ 'default', 'alt1' ], true ) ) {
					return 'default';
				}
				return $value;
			},
		]
	);
	*/
}

/* Omit closing PHP tag to avoid "Headers already sent" issues. */
