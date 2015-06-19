<?php
/**
 * Template Name: Banner page
 *
 * This is the template that displays full width page without sidebar
 *
 * @package dazzling
 */

 ?>
<div >

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'bannerpage' ); ?>
			<?php endwhile; // end of the loop. ?>


<?php get_footer(); ?>
