<?php
/**
 * Template part for the handheld navigation.
 *
 * @package Gridd
 * @since 1.0
 */

use Gridd\Theme;

\Gridd\CSS::add_file( get_theme_file_path( 'assets/css/nav.min.css' ) );
\Gridd\CSS::add_file( get_theme_file_path( 'assets/css/nav-vertical.min.css' ) );

$label_class = get_theme_mod( 'nav-handheld_hide_labels', false ) ? 'screen-reader-text' : 'label';
?>
<nav id="gridd-handheld-nav" class="gridd-nav-vertical">
	<?php
	/**
	 * Prints the button.
	 * No need to escape this, there's zero user input.
	 * Everything is hardcoded and things that need escaping
	 * are properly escaped in the function itself.
	 */
	echo Theme::get_toggle_button( // phpcs:ignore WordPress.Security.EscapeOutput
		[
			'context'           => [ 'menu-handheld' ],
			'expanded_state_id' => 'griddHandheldNavMenu',
			'expanded'          => 'false',
			'label'             => '<svg aria-hidden="true" class="gridd-inline-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M24 6h-24v-4h24v4zm0 4h-24v4h24v-4zm0 8h-24v4h24v-4z"/></svg><span class="' . $label_class . '">' . esc_html__( 'Menu', 'gridd' ) . '</span>',
			'classes'           => [ 'gridd-nav-handheld-btn' ],
		]
	);
	?>
	<div id="gridd-handheld-menu-wrapper" class="gridd-hanheld-nav-popup-wrapper">
		<?php
		wp_nav_menu(
			[
				'theme_location' => 'menu-handheld',
				'menu_id'        => 'nav-handheld',
				'item_spacing'   => 'discard',
				'container'      => false,
			]
		);
		?>
	</div>
</nav>
