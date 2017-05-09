<?php

/************************************************
* @package genesischild
* @author  Nicholas Duell
* @license GPL-2.0+
* @link    http://duellingpixels.com/
************************************************/


/*
Template Name: FAQs Page
*/


// Force full-width-content layout setting
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

remove_action( 'genesis_before_content_sidebar_wrap','sk_relocate_entry_title_events' );

//* Add custom body class to the head
add_filter( 'body_class', 'sp_body_class_services_scroll' );
function sp_body_class_services_scroll( $classes ) {
	
	$classes[] = 'faq';
	return $classes;
	
} 

/*
Single Post Template:FAQ Page
*/
add_action( 'genesis_entry_content', 'wpb_faq_repeater_page_scroll2', 10 );//Position FAQs after post content
function wpb_faq_repeater_page_scroll2 () {

?><div class="one-third first qcontainer"> <?php 

if( have_rows('faqs_page') ):
 // loop through the rows of data
// while ( have_rows('faq') ) : the_row(); ?>

 <ol class="questions">
    <?php 
        $i = 1;
    ?>
        <?php while ( have_rows('faqs_page') ) : the_row();  ?>
		
            <li><a href="#<?php the_sub_field('question_page') ?>-<?php echo $i++;?>"><?php the_sub_field('question_page') ?></a></li>
		
        <?php endwhile; ?>
    </ol>
   </div>	 
<?php endif;?>



<?php if( have_rows('faqs_page') ):?>
	
<div class="two-thirds faq-entry">
 <?php  $i = 1; ?>
        <?php while ( have_rows('faqs_page') ) : the_row();  ?>

		<li>
                <h3 id="<?php the_sub_field('question_page') ?>-<?php echo $i++;?>"><?php the_sub_field('question_page') ?></h3>
                <?php the_sub_field('answer_page') ?>
                <a class="back-to-top" href="#top">Back to top</a>
         </li>
         
<?php endwhile; ?>

</div>	

<?php endif; 

}

// Enqueue sticky sidebar scripts
function jk_sticky_sidebar_scripts() {
wp_enqueue_script( 'sticky-sdiebar', get_stylesheet_directory_uri() . '/js/sticky-sidebar.js', array('jquery'), '1', true );
wp_enqueue_script( 'jk_sticky', get_stylesheet_directory_uri() . '/js/jquery.sticky-kit.min.js', array('jquery'), '1.1.1', true );
wp_enqueue_script( 'scrollTo', get_stylesheet_directory_uri() . '/js/jquery.scrollTo.min.js', array( 'jquery' ), '', true );
wp_enqueue_script( 'localScroll', get_stylesheet_directory_uri() . '/js/jquery.localScroll.min.js', array( 'scrollTo' ), '', true );
	wp_enqueue_script( 'scrollto-init', get_stylesheet_directory_uri() . '/js/scrollto-init.js', array( 'localScroll' ), '', true );

}
add_action( 'wp_enqueue_scripts', 'jk_sticky_sidebar_scripts' );


genesis();

