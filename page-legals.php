<?php

/************************************************
* @package genesischild
* @author  Nicholas Duell
* @license GPL-2.0+
* @link    http://duellingpixels.com/
************************************************/


/*
Template Name: Legals Page
*/


// Force full-width-content layout setting
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

remove_action( 'genesis_before_content_sidebar_wrap','sk_relocate_entry_title_events' );

//* Add custom body class to the head
add_filter( 'body_class', 'sp_body_class_services_scroll' );
function sp_body_class_services_scroll( $classes ) {
	
	$classes[] = 'legals';
	return $classes;
	
} 

/*
Single Post Template: Legals Page
*/

add_action( 'genesis_entry_content', 'wpb_legals_new', 10 ); //Position FAQs after post content
function wpb_legals_new () {

?><div class="one-third first qcontainer"> 

 <div class="questions">		
            <li><a href="#Terms & Conditons">Terms & Conditons</a></li>
            
            <li><a href="#Privacy Policy">Privacy Policy</a></li>
              
           <li><a href="#Website Disclaimer"> Website Disclaimer</a></li>
		

   </div>	
   </div>	 
	
<div class="two-thirds faq-entry">

		<li>
               	<h3 id="Terms & Conditons"> Terms & Conditons</h3>
                <?php the_field('terms_&_conditons_content'); ?>
                <a class="back-to-top" href="#top">Back to top</a>
         </li>
         
         <li>
               <h3 id="Privacy Policy"> Privacy Policy</h3>
                <?php  the_field('privacy_policy_content'); ?>
                <a class="back-to-top" href="#top">Back to top</a>
         </li>
         
         <li>
               	<h3 id="Website Disclaimer"> Website Disclaimer</h3>
                <?php  the_field('website_disclaimer_content');  ?>
                <a class="back-to-top" href="#top">Back to top</a>
         </li>
         


</div>	

<?php  

}

// Enqueue sticky sidebar scripts
function jk_sticky_sidebar_scripts() {
wp_enqueue_script( 'sticky-sdiebar', get_stylesheet_directory_uri() . '/assets/scripts/sticky-sidebar.js', array('sticky'), '', true );
wp_enqueue_script( 'jk_sticky', get_stylesheet_directory_uri() . '/assets/scripts/jquery.sticky-kit.min.js', array('jquery'), '1.1.1', true );
wp_enqueue_script( 'scrollTo', get_stylesheet_directory_uri() . '/assets/scripts/jquery.scrollTo.min.js', array( 'jquery' ), '2.1.3', true );
wp_enqueue_script( 'localScroll', get_stylesheet_directory_uri() . '/assets/scripts/jquery.localScroll.min.js', array( 'scrollTo' ), '', true );
	wp_enqueue_script( 'scrollto-init', get_stylesheet_directory_uri() . '/assets/scripts/scrollto-init.js', array( 'localScroll' ), '', true );

}
add_action( 'wp_enqueue_scripts', 'jk_sticky_sidebar_scripts' );


genesis();

