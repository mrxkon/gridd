<?php
/**
 * Init all grid-parts.
 *
 * @package Gridd
 * @since 1.0.3
 */

// Require classes.
require_once get_theme_file_path( 'grid-parts/Breadcrumbs/Breadcrumbs.php' );
require_once get_theme_file_path( 'grid-parts/Content/Content.php' );
require_once get_theme_file_path( 'grid-parts/Footer/Footer.php' );
require_once get_theme_file_path( 'grid-parts/classes/Header.php' );
require_once get_theme_file_path( 'grid-parts/classes/Nav_Handheld.php' );
require_once get_theme_file_path( 'grid-parts/Navigation/Navigation.php' );
require_once get_theme_file_path( 'grid-parts/classes/Reusable_Block.php' );
require_once get_theme_file_path( 'grid-parts/classes/Sidebar.php' );

// Require customizer files.
require_once get_theme_file_path( 'grid-parts/Breadcrumbs/customizer.php' );
require_once get_theme_file_path( 'grid-parts/Content/customizer.php' );
require_once get_theme_file_path( 'grid-parts/Footer/customizer-copyright.php' );
require_once get_theme_file_path( 'grid-parts/Footer/customizer-sidebars.php' );
require_once get_theme_file_path( 'grid-parts/Footer/customizer-social-media.php' );
require_once get_theme_file_path( 'grid-parts/Footer/customizer.php' );
require_once get_theme_file_path( 'grid-parts/customizer/header-branding.php' );
require_once get_theme_file_path( 'grid-parts/customizer/header-contact-info.php' );
require_once get_theme_file_path( 'grid-parts/customizer/header-search.php' );
require_once get_theme_file_path( 'grid-parts/customizer/header-social-media.php' );
require_once get_theme_file_path( 'grid-parts/customizer/header.php' );
require_once get_theme_file_path( 'grid-parts/customizer/nav-handheld.php' );
require_once get_theme_file_path( 'grid-parts/Navigation/customizer.php' );
require_once get_theme_file_path( 'grid-parts/customizer/reusable-block.php' );
require_once get_theme_file_path( 'grid-parts/customizer/sidebar.php' );

/* Omit closing PHP tag to avoid "Headers already sent" issues. */
