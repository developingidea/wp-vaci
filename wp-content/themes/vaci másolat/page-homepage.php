<?php
/**
 * Template Name: Homepage
 *
 * This is the template that displays full width page without sidebar
 *
 * @package dazzling
 */

get_header(); ?>
<div id="homepageContent">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'homepage' ); ?>
			<?php endwhile; // end of the loop. ?>


<?php get_footer(); ?>
