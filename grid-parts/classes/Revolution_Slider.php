<?php
/**
 * Gridd Revolution_Slider grid-part
 *
 * @package Gridd
 * 
 * phpcs:ignoreFile WordPress.Files.FileName
 */

namespace Gridd\Grid_Part;

use Gridd\Theme;
use Gridd\Grid_Part;

/**
 * The Gridd\Grid_Part\Breadcrumbs object.
 *
 * @since 1.0
 */
class Revolution_Slider extends Grid_Part {

	/**
	 * The grid-part ID.
	 *
	 * @access protected
	 * @since 1.0
	 * @var string
	 */
	protected $id = 'revolution-slider';

	/**
	 * Hooks & extra operations.
	 *
	 * @access public
	 * @since 1.0
	 * @return void
	 */
	public function init() {
		add_action( 'gridd_the_grid_part', [ $this, 'render' ] );
	}

	/**
	 * Returns the grid-part definition.
	 *
	 * @access protected
	 * @since 1.0
	 * @return void
	 */
	protected function set_part() {
		$this->part = [
			'label'    => esc_html__( 'Revolution Slider', 'gridd' ),
			'color'    => [ '#EF6C00', '#000' ],
			'priority' => 200,
			'id'       => 'revolution-slider',
		];
	}

	/**
	 * Render this grid-part.
	 *
	 * @access public
	 * @since 1.0
	 * @param string $part The grid-part ID.
	 * @return void
	 */
	public function render( $part ) {
		if ( $this->id === $part ) {
			Theme::get_template_part( 'grid-parts/templates/revolution-slider' );
		}
	}
}

new Revolution_Slider();