<?php
/**
 * Genesis Starter.
 *
 * This file adds the default functionality to the Genesis Starter
 * theme. It includes the following:
 * - theme setup
 * - theme constants
 * - theme supports
 * - theme includes
 * - theme assets
 *
 * @package      Genesis Starter
 * @link         https://seothemes.net/genesis-starter
 * @author       Seo Themes
 * @copyright    Copyright © 2017 Seo Themes
 * @license      GPL-2.0+
 */

/**
 * Theme setup.
 */
// Start the engine (do not remove).
include_once( get_template_directory() . '/lib/init.php' );

// Set Localization (do not remove).
load_child_theme_textdomain( 'genesis-starter', apply_filters( 'child_theme_textdomain', get_stylesheet_directory() . '/languages', 'genesis-starter' ) );

/**
 * Theme constants.
 */
// Child theme (do not remove).
define( 'CHILD_THEME_NAME', 'genesis-starter' );
define( 'CHILD_THEME_URL', 'http://www.seothemes.net/' );
define( 'CHILD_THEME_VERSION', '1.5.0' );

/**
 * Theme features.
 */
// Enable responsive viewport.
add_theme_support( 'genesis-responsive-viewport' );

// Enable automatic output of WordPress title tags.
add_theme_support( 'title-tag' );

// Enable selective refresh and Customizer edit icons.
add_theme_support( 'customize-selective-refresh-widgets' );

// Enable theme support for custom background image.
add_theme_support( 'custom-background' );

// Enable theme clean up.
add_theme_support( 'clean-up' );

//add_action( 'genesis_setup', 'child_after_setup_theme', 11 ); 
// Parent theme uses the default priority of 10, so
// use a priority of 11 to load after the parent theme.

function child_after_setup_theme(){
  	  if ( !is_home() || !is_front_page() ) {
		// Enable hero section.
add_theme_support( 'hero-section' );
    // ... etc.}
}

}

// Enable hero section.
//add_theme_support( 'hero-section' );

// Enable customizer settings.
add_theme_support( 'customize' );

// Enable custom widget areas.
add_theme_support( 'widget-areas' );

// Enable WooCommerce support.
add_theme_support( 'woocommerce' );

// Enable HTML5 markup structure.
add_theme_support( 'html5', array( 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ) );

// Enable Accessibility support.
add_theme_support( 'genesis-accessibility', array( '404-page', 'drop-down-menu', 'headings', 'rems', 'search-form', 'skip-links' ) );

// Rename primary and secondary navigation menus.
add_theme_support( 'genesis-menus' , array(
	'primary' => __( 'Header Menu', 'genesis-starter' ),
	//'secondary' => __( 'After Header Menu', 'genesis-starter' ),
) );

add_theme_support( 'genesis-menus', array( 'primary' => __( 'Primary Navigation Menu', 'genesis' ) ) );


// Remove unused structural wraps.
add_theme_support( 'genesis-structural-wraps', array(
	'menu-primary',
	'menu-secondary',
	'site-inner',
	'footer',
) );
	
	
	
// Add support for custom logo.
add_theme_support( 'custom-logo', array(
	'width'       => 200,
	'height'      => 60,
	'flex-width' => true,
	'flex-height' => true,
) );

add_filter( 'genesis_seo_title', 'custom_header_inline_logo', 10, 3 );
/**
 * Add an image inline in the site title element for the logo
 *
 * @param string $title Current markup of title.
 * @param string $inside Markup inside the title.
 * @param string $wrap Wrapping element for the title.
 *
 * @author @_AlphaBlossom
 * @author @_neilgee
 * @author @_JiveDig
 * @author @_srikat
 */
function custom_header_inline_logo( $title, $inside, $wrap ) {
	// If the custom logo function and custom logo exist, set the logo image element inside the wrapping tags.
	if ( function_exists( 'has_custom_logo' ) && has_custom_logo() ) {
		$inside = sprintf( '<span class="screen-reader-text">%s</span>%s', esc_html( get_bloginfo( 'name' ) ), get_custom_logo() );
	} else {
		// If no custom logo, wrap around the site name.
		$inside	= sprintf( '<a href="%s">%s</a>', trailingslashit( home_url() ), esc_html( get_bloginfo( 'name' ) ) );
	}

	// Determine which wrapping tags to use.
	$wrap = genesis_is_root_page() && 'title' === genesis_get_seo_option( 'home_h1_on' ) ? 'h1' : 'p';

	// A little fallback, in case a SEO plugin is active.
	$wrap = genesis_is_root_page() && ! genesis_get_seo_option( 'home_h1_on' ) ? 'h1' : $wrap;

	// Wrap homepage site title in p tags if static front page.
	$wrap = is_front_page() && ! is_home() ? 'p' : $wrap;

	// And finally, $wrap in h1 if HTML5 & semantic headings enabled.
	$wrap = genesis_html5() && genesis_get_seo_option( 'semantic_headings' ) ? 'h1' : $wrap;

	// Build the title.
	$title = genesis_markup( array(
		'open'    => sprintf( "<{$wrap} %s>", genesis_attr( 'site-title' ) ),
		'close'   => "</{$wrap}>",
		'content' => $inside,
		'context' => 'site-title',
		'echo'    => false,
		'params'  => array(
			'wrap' => $wrap,
		),
	) );

	return $title;
}

add_filter( 'genesis_attr_site-description', 'custom_add_site_description_class' );
/**
 * Add class for screen readers to site description.
 * This will keep the site description markup but will not have any visual presence on the page
 * This runs if there is a logo image set in the Customizer.
 *
 * @param array $attributes Current attributes.
 *
 * @author @_neilgee
 * @author @_srikat
 */
function custom_add_site_description_class( $attributes ) {
	if ( function_exists( 'has_custom_logo' ) && has_custom_logo() ) {
		$attributes['class'] .= ' screen-reader-text';
	}

	return $attributes;
}


/**
 * Display the custom logo if one is set.
 */
function starter_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}
add_action( 'genesis_site_title', 'starter_custom_logo', 0 );



// Enable theme support for custom header background image.
add_theme_support( 'custom-header', array(
	'header-selector' 	=> '.hero',
	'header_image'    	=> get_stylesheet_directory_uri() . '/assets/images/hero.jpg',
	'header-text'     	=> false,
	'width'           	=> 1920,
	'height'          	=> 1080,
	'flex-height'     	=> true,
	'flex-width'		=> true,
	'video'				=> true,
	'wp-head-callback'	=> 'starter_custom_header',
) );

// Register default header (just in case).
register_default_headers( array(
	'child' => array(
		'url'           => '%2$s/assets/images/hero.jpg',
		'thumbnail_url' => '%2$s/assets/images/hero.jpg',
		'description'   => __( 'Hero Image', 'genesis-starter' ),
	),
) );

// Add WooCommerce support for Genesis layouts (sidebar, full-width, etc).
add_post_type_support( 'post', 'genesis-cpt-archives-settings' );

/**
 * Theme includes.
 */
// Load theme defaults.
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );

// Load one click demo import.
include_once( get_stylesheet_directory() . '/lib/demo-import.php' );
	

// Load header functions.
include_once( get_stylesheet_directory() . '/lib/header-functions.php' );

// Load required plugins.
//include_once( get_stylesheet_directory() . '/lib/classes/class-require-plugins.php' );

// Load hero section.

//require_if_theme_supports( 'hero-section', get_stylesheet_directory() . '/lib/classes/class-genesis-hero.php' );


// Load customizer settings.
require_if_theme_supports( 'customize', get_stylesheet_directory() . '/lib/customize/customize.php' );

// Load clean up functions.
require_if_theme_supports( 'clean-up', get_stylesheet_directory() . '/lib/clean-up/clean.php' );

// Load custom widget areas.
require_if_theme_supports( 'widget-areas', get_stylesheet_directory() . '/lib/widget-areas.php' );

// Load WooCommerce setup.
require_if_theme_supports( 'woocommerce', get_stylesheet_directory() . '/lib/woocommerce.php' );

/**
 * Theme assets.
 */
function starter_enqueue_scripts_styles() {

	// Google fonts.
	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Muli:400,600', array(), CHILD_THEME_VERSION );

	// Enqueue scripts.
	wp_enqueue_script( 'genesis-starter', get_stylesheet_directory_uri() . '/assets/scripts/min/starter.min.js', array( 'jquery' ), CHILD_THEME_VERSION, true );
	
		
	// Css Scripts
	wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css' );

}
add_action( 'wp_enqueue_scripts', 'starter_enqueue_scripts_styles' );


/**
 * Display the custom logo if one is set.
 */
function remove_hero_image() {
		if ( is_account_page() ) {
			// Enable hero section.
			//remove_theme_support( 'hero-section' );
			// Add actions to genesis_hero hook.
		remove_action( 'genesis_hero', array( $this, 'remove_titles' ), 2 );
		remove_action( 'genesis_hero', array( $this, 'markup_open' ), 4 );
		remove_action( 'genesis_hero', array( $this, 'wrap_open' ), 6 );
		remove_action( 'genesis_hero', array( $this, 'title' ), 8 );
		remove_action( 'genesis_hero', array( $this, 'subtitle' ), 10 );
		remove_action( 'genesis_hero', array( $this, 'wrap_close' ), 12 );
		remove_action( 'genesis_hero', array( $this, 'markup_close' ), 14 );

		}
}
add_action( 'genesis_after_header', 'remove_hero_image', 0 );



