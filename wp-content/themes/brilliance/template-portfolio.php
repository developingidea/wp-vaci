<?php /* Template Name: Portfolio */ ?>
<?php get_header(); ?>

<?php get_template_part('element', 'page-header'); ?>

<div id="main" class="main">
	<div class="container">
		<section id="content" class="content">
			<?php do_action('cpotheme_before_content'); ?>
			
			<?php if(have_posts()) while(have_posts()): the_post(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="page-content">
					<?php the_content(); ?>
				</div>
			</div>
			<?php endwhile; ?>

			<?php do_action('cpotheme_after_content'); ?>
		</section>
		<?php get_sidebar(); ?>
		<div class="clear"></div>
	</div>
	
	<div class="container">
		<?php get_template_part('element', 'portfolio-navigation'); ?>
	</div>
	
	<?php if(get_query_var('paged')) $current_page = get_query_var('paged'); else $current_page = 1; ?>	
	<?php $columns = 4; ?>
	<?php $post_number = $columns * 3; ?>
	<?php $query = new WP_Query('post_type=cpo_portfolio&paged='.$current_page.'&posts_per_page='.$post_number.'&order=ASC&orderby=menu_order'); ?>
	<?php if($query->posts): $feature_count = 0; ?>
	<section id="portfolio" class="portfolio">
		<?php foreach($query->posts as $post): setup_postdata($post); ?>
		<?php if($feature_count % $columns == 0 && $feature_count != 0) echo '<div class="col-divide"></div>'; ?>
		<?php $feature_count++; ?>
		<div class="column column-fit col<?php echo $columns; if($feature_count % $columns == 0 && $feature_count != 0) echo ' col-last'; ?>">
			<?php get_template_part('element', 'portfolio'); ?>
		</div>
		<?php endforeach; ?>
		<div class='clear'></div>
	</section>
	<?php cpotheme_numbered_pagination($query); ?>
	<?php wp_reset_postdata(); ?>
	<?php endif; ?>
	
	
</div>

<?php get_footer(); ?>