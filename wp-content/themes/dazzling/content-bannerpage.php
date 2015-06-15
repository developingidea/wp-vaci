


<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package dazzling
 */
get_header(); ?>

<?php if (has_post_thumbnail( $post->ID ) ): ?>
<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
<!-- <div id="custom-bg" > -->

<header class="entry-header page-header fullBanner" style="background: url('<?php echo $image[0]; ?>') no-repeat center center fixed !important;   -webkit-background-size: cover !important;  -moz-background-size: cover !important;  -o-background-size: cover !important;  background-size: cover !important;
">
	<div class="container">
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<span class="last-page-update">Utolsó frissítés: <?php the_modified_time('Y F j');?>.</span>
	</div>
</header><!-- .entry-header -->
<?php endif; ?>
<div id="content" class="site-content container">
	<div id="primary" class="content-area col-sm-12 col-md-8 <?php echo of_get_option( 'site_layout', 'no entry' ); ?>">
		<main id="main" class="site-main" role="main">

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

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

		</main>
		</div>
		</div>


		<?php get_footer(); ?>
