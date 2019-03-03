<?php
/**
 * Customizer Grid Options.
 *
 * @package Gridd
 */

use Gridd\Grid;
use Gridd\Grid_Parts;
use Gridd\Customizer;
use Gridd\Customizer\Sanitize;

$sanitization = new Sanitize();
$grid_parts   = Grid_Parts::get_instance()->get_parts();

Customizer::add_section(
	'gridd_grid',
	[
		'title'       => esc_html__( 'Grid', 'gridd' ),
		'priority'    => 22,
		'description' => Customizer::section_description(
			'gridd_grid',
			[
				'plus' => [
					esc_html__( 'Separate grid for mobile devices.', 'gridd' ),
					esc_html__( 'Grid-parts can overlap', 'gridd' ),
				],
				'docs' => 'https://wplemon.com/documentation/gridd/grid/',
			]
		),
		'panel'       => 'gridd_options',
	]
);

Customizer::add_field(
	[
		'settings'          => 'gridd_grid',
		'section'           => 'gridd_grid',
		'type'              => 'gridd_grid',
		'grid-part'         => false,
		'label'             => esc_html__( 'Grid Settings', 'gridd' ),
		'description'       => __( 'Edit settings for the grid. For more information and documentation on how the grid works, please read <a href="https://wplemon.com/documentation/gridd/the-grid-control/" target="_blank">this article</a>.', 'gridd' ),
		'default'           => Grid::get_grid_default_value(),
		'priority'          => 10,
		'sanitize_callback' => [ $sanitization, 'grid' ],
		'choices'           => [
			'parts'     => Grid_Parts::get_instance()->get_parts(),
			'duplicate' => 'gridd_grid_mobile',
		],
	]
);

Customizer::add_field(
	[
		'type'        => 'dimension',
		'settings'    => 'gridd_mobile_breakpoint',
		'label'       => esc_html__( 'Mobile Breakpoint', 'gridd' ),
		'description' => esc_html__( 'The breakpoint that separates mobile views from desktop views. Use a valid CSS unit.', 'gridd' ),
		'tooltip'     => __( 'Screen sizes below the breakpoint defined will get a stacked view instead of grid.', 'gridd' ),
		'section'     => 'gridd_grid',
		'priority'    => 20,
		'default'     => '992px',
	]
);

Customizer::add_field(
	[
		'type'        => 'dimension',
		'settings'    => 'gridd_grid_gap',
		'label'       => esc_html__( 'Grid Container Gap', 'gridd' ),
		'description' => esc_html__( 'Adds a gap between your grid-parts, both horizontally and vertically.', 'gridd' ),
		'tooltip'     => __( 'For more information please read <a href="https://developer.mozilla.org/en-US/docs/Web/CSS/gap" target="_blank" rel="nofollow">this article</a>.', 'gridd' ),
		'section'     => 'gridd_grid',
		'default'     => '0',
		'transport'   => 'auto',
		'priority'    => 30,
		'output'      => [
			[
				'element'  => '.gridd-site-wrapper',
				'property' => 'grid-gap',
			],
		],
	]
);

Customizer::add_field(
	[
		'type'        => 'dimension',
		'settings'    => 'gridd_grid_max_width',
		'label'       => esc_html__( 'Grid Container max-width', 'gridd' ),
		'description' => esc_html__( 'The maximum width for this grid.', 'gridd' ),
		'tooltip'     => esc_html__( 'By setting the max-width to something other than 100% you can build a boxed layout.', 'gridd' ),
		'section'     => 'gridd_grid',
		'default'     => '',
		'priority'    => 40,
		'transport'   => 'postMessage',
		'css_vars'    => '--gridd-grid-max-width',
	]
);

$parts          = Grid_Parts::get_instance()->get_parts();
$sortable_parts = [];
foreach ( $parts as $part ) {
	$sortable_parts[ $part['id'] ] = $part['label'];
}

Customizer::add_field(
	[
		'type'        => 'sortable',
		'settings'    => 'gridd_grid_load_order',
		'label'       => esc_html__( 'Grid Parts Load Order', 'gridd' ),
		'description' => __( 'Changes the order in which parts get loaded. This only affects the mobile views and SEO. <strong>IMPORTANT: Please note that this setting does not live-update the preview. After making your changes you will have to save the options and refresh your page.</strong>', 'gridd' ),
		'tooltip'     => esc_html__( 'Your content should always be near the top. You can place secondary items lower in the load order', 'gridd' ),
		'section'     => 'gridd_grid',
		'default'     => array_keys( $sortable_parts ),
		'priority'    => 900,
		'choices'     => $sortable_parts,
	]
);
