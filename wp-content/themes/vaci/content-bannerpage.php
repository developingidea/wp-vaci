


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
		<span class="last-page-update">Legutóbbi frissítés: <b><?php the_modified_time('Y F j');?>.</b></span>
		<div class="desc">	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima, accusantium, sint ullam cum nisi enim pariatur sed officiis hic fugit quisquam quibusdam perferendis tempore ipsum alias inventore voluptatum iste ab? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima, accusantium, sint ullam cum nisi enim pariatur sed officiis hic fugit quisquam quibusdam perferendis tempore ipsum alias inventore voluptatum iste ab?
			<br><a href="#" class="btn btn-default banner">Idei év eredményei</a> <a href="#" class="btn btn-default banner">Korábbi évek eredményei</a> <a href="#" class="btn btn-default banner">Kapcsolat</a>
		</div>
	</div>
	<i class="grad"></i>
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
