<?php
/**
 * This file adds customizer color settings to the Genesis Starter theme.
 *
 * @package      Genesis Starter
 * @link         https://seothemes.net/genesis-starter
 * @author       Seo Themes
 * @copyright    Copyright © 2017 Seo Themes
 * @license      GPL-2.0+
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Register color settings with the Customizer.
 */
if ( class_exists( 'Starter_Kirki' ) ) {

	Starter_Kirki::add_field( 'starter', array(
		'type'        => 'color',
		'settings'    => 'color_background',
		'label'       => __( 'Background Color', 'genesis-starter' ),
		'section'     => 'colors',
		'default'     => '#ffffff',
		'priority'    => 10,
		'choices'     => array(
			'alpha' => true,
		),
		'output' => array(
			array(
				'element'  => 'body',
				'property' => 'background-color',
			),
		),
	) );

	Starter_Kirki::add_field( 'starter', array(
		'type'        => 'color',
		'settings'    => 'color_header',
		'label'       => __( 'Header Color', 'genesis-starter' ),
		'section'     => 'colors',
		'default'     => '#ffffff',
		'priority'    => 11,
		'choices'     => array(
			'alpha' => true,
		),
		'output' => array(
			array(
				'element'  => '.site-header',
				'property' => 'background-color',
			),
		),
	) );

	Starter_Kirki::add_field( 'starter', array(
		'type'        => 'color',
		'settings'    => 'color_sticky',
		'label'       => __( 'Sticky Header Color', 'genesis-starter' ),
		'section'     => 'colors',
		'default'     => '#ffffff',
		'priority'    => 11,
		'choices'     => array(
			'alpha' => true,
		),
		'output' => array(
			array(
				'element'  => '.site-header.shrink',
				'property' => 'background-color',
			),
		),
	) );

	Starter_Kirki::add_field( 'starter', array(
		'type'        => 'color',
		'settings'    => 'color_overlay',
		'label'       => __( 'Overlay Color', 'genesis-starter' ),
		'section'     => 'colors',
		'default'     => 'rgba(255,255,255,0.9)',
		'priority'    => 11,
		'choices'     => array(
			'alpha' => true,
		),
		'output' => array(
			array(
				'element'  => array(
					'.hero-section',
					'.overlay',
				),
				'property' => 'box-shadow',
				'value_pattern' => 'inset 0 0 0 9999px $',
			),
		),
	) );

	Starter_Kirki::add_field( 'starter', array(
		'type'        => 'color',
		'settings'    => 'color_overlay_text',
		'label'       => __( 'Overlay Text Color', 'genesis-starter' ),
		'section'     => 'colors',
		'default'     => '#333333',
		'priority'    => 11,
		'choices'     => array(
			'alpha' => true,
		),
		'output' => array(
			array(
				'element'  => '.overlay *:not(button):not(.button):not([type="submit"])',
				'property' => 'color',
				'suffix' => ' !important',
			),
		),
	) );

	Starter_Kirki::add_field( 'starter', array(
		'type'        => 'color',
		'settings'    => 'color_accent',
		'label'       => __( 'Accent Color', 'genesis-starter' ),
		'section'     => 'colors',
		'default'     => '#555555',
		'priority'    => 10,
		'choices'     => array(
			'alpha' => true,
		),
		'output' => array(
			array(
				'element'  => array(
					'a:hover',
					'a:focus',
					'.entry-title a:focus',
					'.entry-title a:hover',
					'button:disabled',
					'input[type="button"]:disabled',
					'input[type="reset"]:disabled',
					'input[type="submit"]:disabled',
					'.button:disabled',
					'.site-title a:hover',
					'.site-title a:focus',
					'.genesis-nav-menu a:hover',
					'.genesis-nav-menu a:focus',
					'.genesis-nav-menu .current-menu-item > a',
					'.genesis-nav-menu .sub-menu .current-menu-item > a:hover',
					'.genesis-nav-menu .sub-menu .current-menu-item > a:focus',
					'.woocommerce div.product p.price',
					'.woocommerce div.product span.price',
					'.woocommerce div.product .woocommerce-tabs ul.tabs li a:hover',
					'.woocommerce div.product .woocommerce-tabs ul.tabs li a:focus',
					'.woocommerce ul.products li.product h3:hover',
					'.woocommerce ul.products li.product .price',
					'.woocommerce .woocommerce-breadcrumb a:hover',
					'.woocommerce .woocommerce-breadcrumb a:focus',
					'.woocommerce .widget_layered_nav ul li.chosen a::before',
					'.woocommerce .widget_layered_nav_filters ul li a::before',
					'.woocommerce .widget_rating_filter ul li.chosen a::before',
					'.woocommerce-error::before',
					'.woocommerce-info::before',
					'.woocommerce-message::before',
				),
				'property' => 'color',
			),
			
			array(
				'element' => array(
					'input:focus',
					'select:focus',
					'textarea:focus',
					'.woocommerce-error',
					'.woocommerce-info',
					'.woocommerce-message',
				),
				'property' => 'border-color',
			),
		),
	) );
} // End if().
