<?php
/**
 * Handles display of 404 page.
 *
 *
 * This file should be added in the directory of your child theme! 
 
 
/*
Template Name: 404 Page
*/

/** Remove default loop **/
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'genesis_404' );
/**
 * This function outputs a 404 "Not Found" error message
 *
 * @since 1.6
 */
function genesis_404() { ?>

  <div class="post hentry">

		<h1 class="entry-title" style="text-align: center;"><?php echo the_field('page_title_404'); ?></h1>
		<div class="entry-content">
			<p><?php echo  the_field('404_page_content'); ?></p>
			<h4 style="text-align: center"><?php echo  the_field('search_text'); ?> </h4>
				<?php get_search_form(); ?>
		<div class="one-half first">
			<h4>Recent Posts</h4>
			<ul><?php wp_get_archives('type=postbypost&limit=10'); ?></ul>

		</div>
		
		<div class="one-half ">
			<h4>Pages</h4>
			<ul><?php wp_list_pages( 'title_li=&echo=10' ) ?></ul>

		</div>
	
		
		<div class="one-half first ">
			<h4>Categories</h4>
			<ul><?php  wp_list_categories('title_li=') ?></ul>
		</div>
		
		<div class="one-half">
			<h4><?php _e( 'Monthly Archive:', 'genesis' ); ?> </h4>
			<ul>
			<?php wp_get_archives( 'type=monthly' ); ?>
			</ul>
		</div>
					
		</div><!-- end .entry-content -->

	</div><!-- end .postclass -->

<?php
}


genesis();