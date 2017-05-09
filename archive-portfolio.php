<?php
/**
 * Portfolio Archive
 *
 */
 
 
add_action('genesis_before_loop', 'wpb_change_portfolio_loop');
function wpb_change_portfolio_loop() {
/** Replace the home loop with our custom **/
remove_action( 'genesis_loop', 'genesis_do_loop' );
	add_action( 'genesis_loop', 'wpb_custom_loop' );
		/** Custom loop **/
			 $arg = array(
            'post_type' => 'portfolio', // this can be an array : array('guide','guide1',...)
            //'posts_per_page' => 10,
           // 'order' => 'DESC',
            // 'category_name' => 6
            'post_status' => 'publish'
            );
    $query = new WP_Query($arg);
    if ( $query->have_posts() ) : 
        while ( $query->have_posts() ) : $query->the_post(); 
        ?>
        
            <div itemtype="http://schema.org/CreativeWork" class="portfolio">
            
                        
               <a class="entry-title" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?> </a> 
               
               <div itemtype="http://schema.org/VisualArtwork"  class="portfolio-front-image">
 
                   <a  href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"> <?php the_post_thumbnail(); ?></a>
                   
                 
           </div>
       
        <?php
        endwhile;
    endif;
    wp_reset_query(); 		
    
}


// Remove items from loop
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );



// Move Title below Image
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
add_action( 'genesis_entry_footer', 'genesis_entry_header_markup_open', 5 );
add_action( 'genesis_entry_footer', 'genesis_entry_header_markup_close', 15 );
add_action( 'genesis_entry_footer', 'genesis_do_post_title' );



genesis();