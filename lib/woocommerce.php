<?php
/**
 * This file integrates the theme with WooCommerce.
 *
 * @package	 Architect Pro
 * @link		 https://seothemes.net/architect-pro
 * @author       Seo Themes
 * @copyright    Copyright © 2017 Seo Themes
 * @license      GPL-2.0+
 */

// Add WooCommerce support for Genesis layouts (sidebar, full-width, etc).
add_post_type_support( 'product', array( 'genesis-layouts', 'genesis-seo', 'genesis-cpt-archives-settings' ) );

// Unhook WooCommerce Sidebar - use Genesis Sidebars instead.
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

// Unhook WooCommerce wrappers.
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );


/**
 * Replace Woocommerce Default pagination with Genesis Framework Pagination
 */
 
 remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 ); 
 remove_action( 'woocommerce_pagination', 'woocommerce_pagination', 10 ); 
 add_action( 'woocommerce_after_shop_loop', 'genesis_posts_nav', 10 );


//* Remove the entry header markup (requires HTML5 theme support)
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );

add_filter( 'woocommerce_checkout_product_title', 'my_add_order_review_product_image', 10, 2 );


/**
 * Support for WooCommerce product Galleries
 */
add_action( 'after_setup_theme', 'yourtheme_setup' );

function yourtheme_setup() {
add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );
}



/**
 * Place a cart icon with number of items and total cost in the menu bar.
 *
 * Source: http://wordpress.org/plugins/woocommerce-menu-bar-cart/
 */
add_filter('wp_nav_menu_items','dit_wcmenucart', 10, 2);
function dit_wcmenucart($menu, $args) {

	// Check if WooCommerce is active and add a new item to a menu assigned to Primary Navigation Menu location
	if ( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) || 'primary' !== $args->theme_location )
		return $menu;

	ob_start();
		global $woocommerce;
		$viewing_cart = __('View your shopping cart', 'atmosphere-pro');
		$start_shopping = __('Start shopping', 'atmosphere-pro');
		$cart_url = WC()->cart->get_cart_url();
		$shop_page_url = get_permalink( woocommerce_get_page_id( 'primary' ) );
		$cart_contents_count = $woocommerce->cart->cart_contents_count;
		$cart_contents = sprintf(_n('%d item', '%d items', $cart_contents_count, 'atmosphere-pro'), $cart_contents_count);
		$cart_total = $woocommerce->cart->get_cart_total();
		// Uncomment the line below to hide nav menu cart item when there are no items in the cart
		if ( $cart_contents_count > 0 ) {
			if ($cart_contents_count == 0) {
				$menu_item = '<li class="menu-item mobile-cart"><a class="wcmenucart-contents" href="'. $shop_page_url .'" title="'. $start_shopping .'">';
			} else {
				$menu_item = '<li class="menu-item mobile-cart"><a class="wcmenucart-contents" href="'. $cart_url .'" title="'. $viewing_cart .'">';
			}

			$menu_item .= '<i class="fa fa-shopping-cart"></i> ';

			$menu_item .= $cart_contents.' - '. $cart_total;
			$menu_item .= '</a></li>';
		// Uncomment the line below to hide nav menu cart item when there are no items in the cart
		}
		echo $menu_item;
		
	$social = ob_get_clean();
	
	return $menu . $social;

}


// Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php)
add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );
function woocommerce_header_add_to_cart_fragment( $fragments ) {
	ob_start();
	?>
	<a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>"><?php echo sprintf (_n( '%d item', '%d items', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?> - <?php echo WC()->cart->get_cart_total(); ?></a> 
	<?php
	
	$fragments['a.cart-contents'] = ob_get_clean();
	
	return $fragments;
}


add_action( 'genesis_after_header', 'remove_titles_on_woocommerce_login' );
function remove_titles_on_woocommerce_login() {
    if ( ! is_user_logged_in() && is_account_page() ) {
        //remove_action( 'genesis_after_header', 'genesis_do_post_title' );
        remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
        add_action( 'genesis_entry_header', 'centric_open_post_title', 1 );
		add_action( 'genesis_entry_header', 'genesis_do_post_title_2', 2 );
		add_action( 'genesis_entry_header', 'centric_close_post_title', 3 );   
     } 
}


function centric_open_post_title() {
	echo '<div class="page-title"><div class="wrap"	>';
}

function genesis_do_post_title_2() {
	echo '<h1>';
	echo 'Login';
}


function centric_close_post_title() {
	echo '</h1></div></div>';
}

/**
 * Optimize WooCommerce Scripts.
 *
 * Remove WooCommerce Generator tag, styles,
 * and scripts from non WooCommerce pages.
 */
function starter_woocommerce_styles() {

	// First check that woo exists to prevent fatal errors.
	if ( class_exists( 'WooCommerce' ) ) {

		if ( ! is_woocommerce() && ! is_cart() && ! is_checkout() ) {
			wp_dequeue_style( 'woocommerce_frontend_styles' );
			wp_dequeue_style( 'woocommerce_fancybox_styles' );
			wp_dequeue_style( 'woocommerce_chosen_styles' );
			wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
			wp_dequeue_style( 'woocommerce-general' );
			wp_dequeue_style( 'woocommerce-layout' );
			wp_dequeue_style( 'woocommerce-smallscreen' );
			wp_dequeue_script( 'wc_price_slider' );
			wp_dequeue_script( 'wc-single-product' );
			wp_dequeue_script( 'wc-add-to-cart' );
			wp_dequeue_script( 'wc-cart-fragments' );
			wp_dequeue_script( 'wc-checkout' );
			wp_dequeue_script( 'wc-add-to-cart-variation' );
			wp_dequeue_script( 'wc-single-product' );
			wp_dequeue_script( 'wc-cart' );
			wp_dequeue_script( 'wc-chosen' );
			wp_dequeue_script( 'woocommerce' );
			wp_dequeue_script( 'prettyPhoto' );
			wp_dequeue_script( 'prettyPhoto-init' );
			wp_dequeue_script( 'jquery-blockui' );
			wp_dequeue_script( 'jquery-placeholder' );
			wp_dequeue_script( 'fancybox' );
			wp_dequeue_script( 'jqueryui' );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'starter_woocommerce_styles', 99 );


add_action( 'genesis_after_footer', 'storefront_handheld_footer_bar', 99 );
	/**
	 * Display a menu intended for use on handheld devices
	 *
	 * @since 2.0.0
	 */
	function storefront_handheld_footer_bar() {
		
		$links = array(
			'my-account' => array(
				'priority' => 10,
				'callback' => 'storefront_handheld_footer_bar_account_link',
			),
			'search'     => array(
				'priority' => 20,
				'callback' => 'storefront_handheld_footer_bar_search',
			),
			'cart'       => array(
				'priority' => 30,
				'callback' => 'storefront_handheld_footer_bar_cart_link',
			),
		);

		if ( wc_get_page_id( 'myaccount' ) === -1 ) {
			unset( $links['my-account'] );
		}

		if ( wc_get_page_id( 'cart' ) === -1 ) {
			unset( $links['cart'] );
		}

		$links = apply_filters( 'storefront_handheld_footer_bar_links', $links );
		?>
		<div class="storefront-handheld-footer-bar">
			<ul class="columns-<?php echo count( $links ); ?>">
				<?php foreach ( $links as $key => $link ) : ?>
					<li class="<?php echo esc_attr( $key ); ?>">
						<?php
						if ( $link['callback'] ) {
							call_user_func( $link['callback'], $key, $link );
						}
						?>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
		<?php
		}
	

	if ( class_exists( 'WooCommerce' ) ) { {
	/**
	 * The search callback function for the handheld footer bar
	 *
	 * @since 2.0.0
	 */
		function storefront_handheld_footer_bar_search() {
			echo '<a href="">' . esc_attr__( 'Search', 'storefront' ) . '</a>';
			 storefront_product_search();
		}
	}

	if ( class_exists( 'WooCommerce' ) ) {
	/**
	 * The cart callback function for the handheld footer bar
	 *
	 * @since 2.0.0
	 */
		function storefront_handheld_footer_bar_cart_link() {
			?>
				<a class="footer-cart-contents" href="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'storefront' ); ?>">
					<span class="count"><?php echo wp_kses_data( WC()->cart->get_cart_contents_count() );?></span>
				</a>
			<?php
		}
	}
	
	if ( class_exists( 'WooCommerce' ) )  {
	/**
	 * The account callback function for the handheld footer bar
	 *
	 * @since 2.0.0
	 */
		function storefront_handheld_footer_bar_account_link() {
			echo '<a href="' . esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ) . '">' . esc_attr__( 'My Account', 'storefront' ) . '</a>';
		}
	}
	}

	if ( class_exists( 'WooCommerce' ) )  {
		/**
		 * Display Product Search
		 *
		 * @since  1.0.0
		 * @uses  storefront_is_woocommerce_activated() check if WooCommerce is activated
		 * @return void
		 */
		function storefront_product_search() {
			//if ( storefront_is_woocommerce_activated() ) { 
			?>
				<div class="site-search">
					<?php the_widget( 'WC_Widget_Product_Search', 'title=' ); ?>
				</div>
			<?php
			//}
		}
	}
