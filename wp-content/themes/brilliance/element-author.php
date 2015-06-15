<?php if(get_the_author_meta('description')): ?>
<div id="author-info" class="author-info">
	<div class="author-image">
		<?php echo get_avatar(get_the_author_meta('user_email'), 100); ?>
	</div>
	<div class="author-body">
		<h4 class="author-name">
			<a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
				<?php echo get_the_author(); ?>
			</a>
		</h4>
		<div class="author-description">
			<?php the_author_meta('description'); ?>
		</div>
		<div class="author-social">
			<?php $user_meta = get_the_author_meta('user_url'); if($user_meta != ''): ?>
				<a target="_blank" class="author-web" href="<?php echo $user_meta; ?>"><?php _e('Website', 'cpotheme'); ?></a>
			<?php endif; ?>
			<?php $user_meta = get_the_author_meta('facebook'); if($user_meta != ''): ?>
				<a target="_blank" class="author-facebook" href="<?php echo $user_meta; ?>"><?php _e('Facebook', 'cpotheme'); ?></a>
			<?php endif; ?>
			<?php $user_meta = get_the_author_meta('twitter'); if($user_meta != ''): ?>
				<a target="_blank" class="author-twitter" href="<?php echo $user_meta; ?>"><?php _e('Twitter', 'cpotheme'); ?></a>
			<?php endif; ?>
			<?php $user_meta = get_the_author_meta('googleplus'); if($user_meta != ''): ?>
				<a target="_blank" class="author-googleplus" href="<?php echo $user_meta; ?>"><?php _e('Google+', 'cpotheme'); ?></a>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php endif; ?>