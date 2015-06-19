<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package dazzling
 */
?>
<div id="content" class="site-content container">
	<div id="primary" class="content-area col-sm-12 col-md-8 <?php echo of_get_option( 'site_layout', 'no entry' ); ?>">
		<main id="main" class="site-main" role="main">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header page-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Oldalak:', 'dazzling' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php edit_post_link( __( 'Edit', 'dazzling' ), '<footer class="entry-meta"><i class="fa fa-pencil-square-o"></i><span class="edit-link">', '</span></footer>' ); ?>
</article><!-- #post-## -->
