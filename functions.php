<?php
/**
 * Mehnaz functions and definitions
 *
 * @package WordPress
 * @subpackage mehnaz
 * @since Mehnaz 1.0
 */

 /**
 * Table of Contents:
 * Theme Support
 * Register Menus
 * Custom Logo
 * WP Body Open
 * Register Sidebars
 * Required Files
 */

/**
* Sets up theme defaults and registers support for various WordPress features
*
*  It is important to set up these functions before the init hook so that none of these
*  features are lost.
*
*  @since Mehnaz 1.0
*/

function mehnaz_support() {
    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );
    
    // Custom background color.
    add_theme_support(
        'custom-background',
        array(
            'default-color' => 'f5efe0',
        )
    );

    // Set content-width.
    global $content_width;
    if ( ! isset( $content_width ) ) {
        $content_width = 580;
    }

    /*
    * Enable support for Post Thumbnails on posts and pages.
    *
    * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
    */
    add_theme_support( 'post-thumbnails' );

    // Set post thumbnail size.
    set_post_thumbnail_size( 1200, 9999 );

    // Add custom image size used in Cover Template.
    add_image_size( 'mehnaz-fullscreen', 300, 300 );

    // Custom logo.
    $logo_width  = 120;
    $logo_height = 90;

    // If the retina setting is active, double the recommended width and height.
    if ( get_theme_mod( 'retina_logo', false ) ) {
        $logo_width  = floor( $logo_width * 2 );
        $logo_height = floor( $logo_height * 2 );
    }

    add_theme_support(
        'custom-logo',
        array(
            'height'      => $logo_height,
            'width'       => $logo_width,
            'flex-height' => true,
            'flex-width'  => true,
        )
    );

    /*
    * Let WordPress manage the document title.
    * By adding theme support, we declare that this theme does not use a
    * hard-coded <title> tag in the document head, and expect WordPress to
    * provide it for us.
    */
    add_theme_support( 'title-tag' );

    /*
    * Switch default core markup for search form, comment form, and comments
    * to output valid HTML5.
    */
    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'script',
            'style',
            'navigation-widgets',
        )
    );

    /*
    * Make theme available for translation.
    * Translations can be filed in the /languages/ directory.
    * If you're building a theme based on Mehnaz, use a find and replace
    * to change 'mehnaz' to the name of your theme in all the template files.
    */
    load_theme_textdomain( 'mehnaz' );

    // Add support for full and wide align images.
    add_theme_support( 'align-wide' );

    // Add support for responsive embeds.
    add_theme_support( 'responsive-embeds' );

    /*
    * Adds starter content to highlight the theme on fresh sites.
    * This is done conditionally to avoid loading the starter content on every
    * page load, as it is a one-off operation only needed once in the customizer.
    */
    // if ( is_customize_preview() ) {
    //     require get_template_directory() . '/inc/starter-content.php';
    //     add_theme_support( 'starter-content', mehnaz_get_starter_content() );
    // }

    // Add theme support for selective refresh for widgets.
    add_theme_support( 'customize-selective-refresh-widgets' );

    /*
    * Adds `async` and `defer` support for scripts registered or enqueued
    * by the theme.
    */
    // $loader = new Mehnaz_Script_Loader();
    // add_filter( 'script_loader_tag', array( $loader, 'filter_script_loader_tag' ), 10, 2 );

    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'custom-header' );
}

add_action( 'after_setup_theme', 'mehnaz_support' );

/**
 * Register navigation menus uses wp_nav_menu in five places.
 *
 * @since Mehnaz 1.0
 */

function mehnaz_menus() {
    $locations = array(
        'primary' => __( 'Primary Menu', 'mehnaz' ),
        'mobile' => __( 'Mobile Menu', 'mehnaz' ),
        'footer' => __( 'Footer Menu', 'mehnaz' ),
    );

    register_nav_menus( $locations );
}

add_action( 'init', 'mehnaz_menus' );

/**
 * Get the information about the logo.
 *
 * @since Mehnaz 1.0
 *
 * @param string $html The HTML output from get_custom_logo (core function).
 * @return string
 */
function mehnaz_get_custom_logo( $html ) {

	$logo_id = get_theme_mod( 'custom_logo' );

	if ( ! $logo_id ) {
		return $html;
	}

	$logo = wp_get_attachment_image_src( $logo_id, 'full' );

	if ( $logo ) {
		// For clarity.
		$logo_width  = esc_attr( $logo[1] );
		$logo_height = esc_attr( $logo[2] );

		// If the retina logo setting is active, reduce the width/height by half.
		if ( get_theme_mod( 'retina_logo', false ) ) {
			$logo_width  = floor( $logo_width / 2 );
			$logo_height = floor( $logo_height / 2 );

			$search = array(
				'/width=\"\d+\"/iU',
				'/height=\"\d+\"/iU',
			);

			$replace = array(
				"width=\"{$logo_width}\"",
				"height=\"{$logo_height}\"",
			);

			// Add a style attribute with the height, or append the height to the style attribute if the style attribute already exists.
			if ( strpos( $html, ' style=' ) === false ) {
				$search[]  = '/(src=)/';
				$replace[] = "style=\"height: {$logo_height}px;\" src=";
			} else {
				$search[]  = '/(style="[^"]*)/';
				$replace[] = "$1 height: {$logo_height}px;";
			}

			$html = preg_replace( $search, $replace, $html );

		}
	}

	return $html;

}

add_filter( 'get_custom_logo', 'mehnaz_get_custom_logo' );

/**
 * Register widget areas.
 *
 * @since Mehnaz 1.0
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function mehnaz_sidebar_registration() {

	// Arguments used in all register_sidebar() calls.
	$shared_args = array(
		'before_title'  => '<h2 class="widget-title subheading heading-size-3">',
		'after_title'   => '</h2>',
		'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
		'after_widget'  => '</div></div>',
	);

    // Footer 1.
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => __( 'Sidebar', 'mehnaz' ),
				'id'          => 'sidebar',
				'description' => __( 'Widgets in this area will be displayed in the first column in the footer.', 'mehnaz' ),
			)
		)
	);

	// Footer 1.
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => __( 'Footer 1', 'mehnaz' ),
				'id'          => 'sidebar-1',
				'description' => __( 'Widgets in this area will be displayed in the first column in the footer.', 'mehnaz' ),
			)
		)
	);

	// Footer 2.
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => __( 'Footer 2', 'mehnaz' ),
				'id'          => 'sidebar-2',
				'description' => __( 'Widgets in this area will be displayed in the second column in the footer.', 'mehnaz' ),
			)
		)
	);

}

add_action( 'widgets_init', 'mehnaz_sidebar_registration' );

/**
 * REQUIRED FILES
 * Include required files.
 */
// theme directory
define( "MEHNAZ_DIR", untrailingslashit( get_template_directory() ) . "/" );

// theme_init();

// loading core files scripts
include_once MEHNAZ_DIR.'inc/hooks.php';
include_once MEHNAZ_DIR.'inc/helper.php';
include_once MEHNAZ_DIR.'inc/enqueue.php';

// Mehnaz header nav
function mehnaz_header_nav() {
    do_action("mehnaz_header_nav");
}

// register block styles
if ( function_exists( 'register_block_style' ) ) {
    register_block_style(
        'core/quote',
        array(
            'name'         => 'blue-quote',
            'label'        => __( 'Blue Quote', 'mehnaz' ),
            'is_default'   => true,
            'inline_style' => '.wp-block-quote.is-style-blue-quote { color: blue; }',
        )
    );
}

// register block pattern
register_block_pattern(
    'wpdocs-my-plugin/my-awesome-pattern',
    array(
        'title'       => __( 'Two buttons', 'mehnaz' ),
        'description' => _x( 'Two horizontal buttons, the left button is filled in, and the right button is outlined.', 'Block pattern description', 'mehnaz' ),
        'content'     => "<!-- wp:buttons {\"align\":\"center\"} -->\n<div class=\"wp-block-buttons aligncenter\"><!-- wp:button {\"backgroundColor\":\"very-dark-gray\",\"borderRadius\":0} -->\n<div class=\"wp-block-button\"><a class=\"wp-block-button__link has-background has-very-dark-gray-background-color no-border-radius\">" . esc_html__( 'Button One', 'mehnaz' ) . "</a></div>\n<!-- /wp:button -->\n\n<!-- wp:button {\"textColor\":\"very-dark-gray\",\"borderRadius\":0,\"className\":\"is-style-outline\"} -->\n<div class=\"wp-block-button is-style-outline\"><a class=\"wp-block-button__link has-text-color has-very-dark-gray-color no-border-radius\">" . esc_html__( 'Button Two', 'mehnaz' ) . "</a></div>\n<!-- /wp:button --></div>\n<!-- /wp:buttons -->",
    )
);



/**
 * Registers an editor stylesheet for the theme.
 */
function mehnaz_add_editor_styles() {
    add_editor_style( 'custom-editor-style.css' );
}
add_action( 'mehnaz_init', 'mehnaz_add_editor_styles' );