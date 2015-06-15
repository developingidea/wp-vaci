<article <?php post_class(); ?> id="post-<?php the_ID(); ?>"> 
	<?php if(has_post_thumbnail()): ?>
	<div class="post-image">
		<?php if(!is_singular('post')): ?>
		<a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Go to %s', 'cpotheme'), the_title_attribute('echo=0')); ?>" rel="bookmark">
			<?php the_post_thumbnail('blog'); ?>
		</a>
		<?php else: ?>
		<?php the_post_thumbnail(); ?>
		<?php endif; ?>
	</div>
	<?php endif; ?>
	
	
	<div class="post-body<?php if(has_post_thumbnail()) echo ' post-body-image'; ?>">
		<?php if(cpotheme_get_option('postpage_authors')): ?>
		<a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" class="post-author">
			<?php echo get_avatar(get_the_author_meta('ID'), 160); ?>
		</a>
		<?php endif; ?>
		
		<?php if(!is_singular('post')): ?>
		<h2 class="post-title">
			<a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Go to %s', 'cpotheme'), the_title_attribute('echo=0')); ?>" rel="bookmark"><?php the_title(); ?></a>
		</h2>
		<?php endif; ?>
		
		<div class="post-byline">
			<?php cpotheme_postpage_date(true); ?>
			<?php //cpotheme_postpage_author(true); ?>
			<?php cpotheme_postpage_categories(true); ?>
			<?php cpotheme_postpage_comments(true); ?>
			<?php cpotheme_edit(); ?>
		</div>
		
		<div class="post-content">
			<?php if(cpotheme_get_option('postpage_preview') == '1' || is_singular('post')){ the_content(); cpotheme_post_pagination(); }else{ the_excerpt(); } ?>
		</div>
		<?php if(is_singular('post')){ ?>
		<?php cpotheme_postpage_tags(true, '', '', ''); ?>
		<?php }else{ ?>
		<?php echo cpotheme_postpage_readmore(); ?>
		<?php } ?>
	</div>
	<div class="clear"></div>
</article>