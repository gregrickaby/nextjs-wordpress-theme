<?php
/**
 * Theme functionality.
 *
 * @author Greg Rickaby
 * @package nextjs-wordpress-theme
 * @since 1.0.0
 */

namespace NEXTJS_WORDPRESS_THEME;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

// Define constants.
define( 'NEXTJS_WORDPRESS_THEME_DIR', trailingslashit( get_stylesheet_directory() ) );
define( 'NEXTJS_WORDPRESS_THEME_URL', trailingslashit( get_stylesheet_directory_uri() ) );
define( 'NEXTJS_WORDPRESS_THEME_VERSION', '1.0.1' );

/**
 * Check for the NEXTJS_FRONTEND_URL constant.
 */
if ( ! defined( 'NEXTJS_FRONTEND_URL' ) ) {
	define( 'NEXTJS_FRONTEND_URL', 'https://nextjswp.com' );
}

/**
 * Customize settings for the page/post editor.
 */
function customize_editor(): void {
	// Add support for post thumbnails.
	add_theme_support( 'post-thumbnails' );

	// Add excerpts to pages.
	add_post_type_support( 'page', 'excerpt' );

	// Create custom image sizes.
	add_image_size( 'nineteen-twenty', 1920, 1080, true );

	// Register menus.
	register_nav_menus(
		[
			'header-menu' => esc_html__( 'Header Menu' ),
			'footer-menu' => esc_html__( 'Footer Menu' ),
		]
	);
}
add_action( 'after_setup_theme', __NAMESPACE__ . '\customize_editor' );

/**
 * Disable "BIG Image" functionality.
 *
 * @see https://developer.wordpress.org/reference/hooks/big_image_size_threshold/
 */
add_filter( 'big_image_size_threshold', '__return_false' );

/**
 * Wrap WYSIWYG embed in a div wrapper for responsive
 *
 * @param string $html HTML string.
 * @param string $url  Current URL.
 * @param string $attr Embed attributes.
 * @param string $id   Post ID.
 * @return string
 */
function embed_wrapper( $html, $url, $attr, $id ): string {
	return '<div class="iframe-wrapper">' . $html . '</div>';
}
add_filter( 'embed_oembed_html', __NAMESPACE__ . '\embed_wrapper', 10, 4 );
