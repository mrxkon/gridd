<?php
/**
 * Customizer options.
 *
 * @package Gridd
 */

use Gridd\Customizer;
use Gridd\Customizer\Sanitize;

$sanitization = new Sanitize();

Customizer::add_outer_section(
	'gridd_grid_part_details_breadcrumbs',
	[
		/* translators: The grid-part label. */
		'title' => sprintf( esc_html__( '%s Options', 'gridd' ), esc_html__( 'Breadcrumbs', 'gridd' ) ),
	]
);

Customizer::add_field(
	[
		'type'      => 'color',
		'settings'  => 'gridd_grid_breadcrumbs_background_color',
		'label'     => esc_html__( 'Background Color', 'gridd' ),
		'section'   => 'gridd_grid_part_details_breadcrumbs',
		'default'   => '#ffffff',
		'transport' => 'postMessage',
		'transport' => 'auto',
		'output'    => [
			[
				'element'  => '.gridd-tp-breadcrumbs',
				'property' => '--bg',
			],
		],
		'choices'   => [
			'alpha' => true,
		],
		'priority' => 10,
	]
);

Customizer::add_field(
	[
		'type'        => 'dimension',
		'settings'    => 'gridd_grid_breadcrumbs_padding',
		'label'       => esc_html__( 'Padding', 'gridd' ),
		'description' => Customizer::get_control_description(
			[
				'short'   => '',
				'details' => sprintf(
					/* translators: Link properties. */
					__( 'Use any valid CSS value. For details on how padding works, please refer to <a %s>this article</a>.', 'gridd' ),
					'href="https://developer.mozilla.org/en-US/docs/Web/CSS/padding" target="_blank" rel="nofollow"'
				),
			]
		),
		'section'     => 'gridd_grid_part_details_breadcrumbs',
		'default'     => '1em',
		'transport'   => 'auto',
		'output'      => [
			[
				'element'  => '.gridd-tp-breadcrumbs',
				'property' => '--pd',
			],
		],
		'priority' => 20,
	]
);

Customizer::add_field(
	[
		'type'      => 'dimension',
		'settings'  => 'gridd_grid_breadcrumbs_max_width',
		'label'     => esc_html__( 'Breadcrumbs Maximum Width', 'gridd' ),
		'section'   => 'gridd_grid_part_details_breadcrumbs',
		'default'   => '100%',
		'transport' => 'auto',
		'output'    => [
			[
				'element'  => '.gridd-tp-breadcrumbs',
				'property' => '--mw',
			],
		],
		'priority' => 30,
	]
);

Customizer::add_field(
	[
		'type'              => 'gridd-wcag-tc',
		'settings'          => 'gridd_grid_breadcrumbs_color',
		'label'             => esc_html__( 'Text Color', 'gridd' ),
		'section'           => 'gridd_grid_part_details_breadcrumbs',
		'default'           => '#000000',
		'transport'         => 'auto',
		'output'            => [
			[
				'element'  => '.gridd-tp-breadcrumbs',
				'property' => '--cl',
			],
		],
		'choices'           => [
			'setting' => 'gridd_grid_breadcrumbs_background_color',
		],
		'sanitize_callback' => [ $sanitization, 'color_hex' ],
	]
);

Customizer::add_field(
	[
		'type'              => 'radio-buttonset',
		'settings'          => 'gridd_grid_breadcrumbs_text_align',
		'label'             => esc_html__( 'Alignment', 'gridd' ),
		'section'           => 'gridd_grid_part_details_breadcrumbs',
		'default'           => 'center',
		'transport'         => 'auto',
		'output'            => [
			[
				'element'  => '.gridd-tp-breadcrumbs',
				'property' => '--ta',
			],
		],
		'choices'           => [
			'left'   => esc_html__( 'Left', 'gridd' ),
			'center' => esc_html__( 'Center', 'gridd' ),
			'right'  => esc_html__( 'Right', 'gridd' ),
		],
		'sanitize_callback' => function( $value ) {
			return ( 'left' !== $value && 'right' !== $value && 'center' !== $value ) ? 'center' : $value;
		},
		'priority' => 40,
	]
);

/* Omit closing PHP tag to avoid "Headers already sent" issues. */
