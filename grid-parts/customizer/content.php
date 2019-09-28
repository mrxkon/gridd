<?php
/**
 * Customizer options.
 *
 * @package Gridd
 */

use Gridd\Customizer;
use Gridd\Customizer\Sanitize;

$sanitization = new Sanitize();

new \Kirki\Section(
	'gridd_grid_part_details_content',
	[
		/* translators: The grid-part label. */
		'title'    => esc_html__( 'Content', 'gridd' ),
		'priority' => 25,
		'panel'    => 'gridd_options',
	]
);

new \Kirki\Field\Dimension(
	[
		'type'      => 'dimension',
		'settings'  => 'gridd_grid_content_max_width',
		'label'     => esc_html__( 'Content Maximum Width', 'gridd' ),
		'section'   => 'gridd_grid_part_details_content',
		'default'   => '45em',
		'css_vars'  => '--c-mw',
		'transport' => 'postMessage',
		'priority'  => 10,
	]
);

new \Kirki\Field\Dimensions(
	[
		'type'      => 'dimensions',
		'settings'  => 'gridd_grid_content_padding',
		'label'     => esc_html__( 'Content Padding', 'gridd' ),
		'section'   => 'gridd_grid_part_details_content',
		'default'   => [
			'top'    => '0px',
			'bottom' => '0px',
			'left'   => '20px',
			'right'  => '20px',
		],
		'css_vars'  => [
			[ '--c-pd-t', '$', 'top' ],
			[ '--c-pd-b', '$', 'bottom' ],
			[ '--c-pd-l', '$', 'left' ],
			[ '--c-pd-r', '$', 'right' ],
		],
		'transport' => 'postMessage',
		'priority'  => 15,
	]
);

new \Kirki\Field\Color(
	[
		'type'      => 'color',
		'settings'  => 'gridd_grid_content_background_color',
		'label'     => esc_html__( 'Background Color', 'gridd' ),
		'section'   => 'gridd_grid_part_details_content',
		'default'   => '#ffffff',
		'css_vars'  => '--c-bg',
		'transport' => 'postMessage',
		'priority'  => 30,
		'choices'   => [
			'alpha' => true,
		],
	]
);

Customizer::add_field(
	[
		'type'              => 'gridd-wcag-tc',
		'settings'          => 'gridd_text_color',
		'label'             => esc_html__( 'Text Color', 'gridd' ),
		'section'           => 'gridd_grid_part_details_content',
		'priority'          => 40,
		'default'           => '#000000',
		'css_vars'          => '--tc',
		'transport'         => 'postMessage',
		'choices'           => [
			'setting' => 'gridd_grid_content_background_color',
		],
		'sanitize_callback' => [ $sanitization, 'color_hex' ],
	]
);

Customizer::add_field(
	[
		'settings'          => 'gridd_links_color',
		'type'              => 'gridd-wcag-lc',
		'label'             => esc_html__( 'Links Color', 'gridd' ),
		'description'       => esc_html__( 'Select the hue for you links. The color will be auto-calculated to ensure maximum readability according to WCAG.', 'gridd' ),
		'section'           => 'gridd_grid_part_details_content',
		'transport'         => 'postMessage',
		'priority'          => 50,
		'choices'           => [
			'alpha' => false,
		],
		'default'           => '#0f5e97',
		'choices'           => [
			'backgroundColor' => 'gridd_grid_content_background_color',
			'textColor'       => 'gridd_text_color',
		],
		'css_vars'          => '--lc',
		'sanitize_callback' => [ $sanitization, 'color_hex' ],
	]
);

Customizer::add_field(
	[
		'settings'          => 'gridd_links_hover_color',
		'type'              => 'gridd-wcag-lc',
		'label'             => esc_html__( 'Links Hover Color', 'gridd' ),
		'section'           => 'gridd_grid_part_details_content',
		'transport'         => 'postMessage',
		'priority'          => 60,
		'choices'           => [
			'alpha' => false,
		],
		'default'           => '#541cfc',
		'css_vars'          => '--lch',
		'choices'           => [
			'backgroundColor' => 'gridd_grid_content_background_color',
			'textColor'       => 'gridd_text_color',
		],
		'sanitize_callback' => [ $sanitization, 'color_hex' ],
	]
);

/* Omit closing PHP tag to avoid "Headers already sent" issues. */
