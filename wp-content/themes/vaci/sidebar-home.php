<?php
/**
 * The Sidebar widget area for static frontpage.
 *
 * @package dazzling
 */
?>
<ul>
<?php
	$args = array( 'numberposts' => '5', 'tax_query' => array(
			array(
				'taxonomy' => 'post_format',
				'field' => 'slug',
				'terms' => 'post-format-aside',
				'operator' => 'NOT IN'
			), 
			array(
				'taxonomy' => 'post_format',
				'field' => 'slug',
				'terms' => 'post-format-image',
 				'operator' => 'NOT IN'
			)
	) );
	$recent_posts = wp_get_recent_posts( $args );
	foreach( $recent_posts as $recent ){
		echo '<li><a href="' . get_permalink($recent["ID"]) . '">' .   ( __($recent["post_title"])).'</a> </li> ';
	}
?>
</ul>
	<?php
	// If footer sidebars do not have widget let's bail.

	if ( ! is_active_sidebar( 'home-widget-1' ) && ! is_active_sidebar( 'home-widget-2' ) && ! is_active_sidebar( 'home-widget-3' ) )
		return;
	// If we made it this far we must have widgets.
	?>
asd
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

