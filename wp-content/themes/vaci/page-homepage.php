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
<div class="container">



<?php $the_query = new WP_Query( 'posts_per_page=1' ); ?>
<?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
<header class="entry-header page-header">
		<h1 class="entry-title">Legfrissebb hír:</h1>
</header>
<h1 class=""><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
<?php printf( __( ' %1$s', 'dazzling' ), $categories_list ); ?>
<?php the_excerpt(__('(more…)')); ?>

<?php 
endwhile;
wp_reset_postdata();
?>
</div>




	<?php
	// If footer sidebars do not have widget let's bail.

	if ( ! is_active_sidebar( 'home-widget-1' ) && ! is_active_sidebar( 'home-widget-2' ) && ! is_active_sidebar( 'home-widget-3' ) )
		return;
	// If we made it this far we must have widgets.
	?>

	<div id="homepageWidgets" style="display: none !important">
		<div class="container">
			<div class="home-widget-area row">
				<?php if ( is_active_sidebar( 'home-widget-1' ) ) : ?>
				<div class="col-sm-6 col-md-4 home-widget" role="complementary">
					<?php dynamic_sidebar( 'home-widget-1' ); ?>
				</div><!-- .widget-area .first -->
				<?php endif; ?>

				<?php if ( is_active_sidebar( 'home-widget-2' ) ) : ?>
				<div class="col-sm-6 col-md-4 home-widget" role="complementary">
					<?php dynamic_sidebar( 'home-widget-2' ); ?>
				</div><!-- .widget-area .second -->
				<?php endif; ?>

				<?php if ( is_active_sidebar( 'home-widget-3' ) ) : ?>
				<div class="col-sm-6 col-md-4 home-widget" role="complementary">
					<?php dynamic_sidebar( 'home-widget-3' ); ?>
				</div><!-- .widget-area .third -->
				<?php endif; ?>
			</div>
		</div>
	</div>

<?php get_footer(); ?>
