<?php
/**
 * Genesis Starter.
 *
 * This file adds scripts to the theme
 *
 * @package      Genesis Starter
 * @link         https://seothemes.net/genesis-starter
 * @author       Nicholas Duell
 * @copyright    Copyright © 2017 Nicholas Duell
 * @license      GPL-2.0+
 */

//* Enqueue scripts and styles
add_action( 'wp_enqueue_scripts', 'maker_scripts_styles' );
function maker_scripts_styles() {
	
	//JS Scripts
	
	
	// Css Scripts
	wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css' );
	
}