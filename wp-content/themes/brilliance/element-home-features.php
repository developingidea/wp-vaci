<?php $query = new WP_Query('post_type=cpo_feature&posts_per_page=-1&order=ASC&orderby=menu_order'); ?>
<?php if($query->posts): $feature_count = 0; ?>
<div id="features" class="features">
	<div class="container">
		<?php $columns = 4; ?>
		<?php foreach($query->posts as $post): setup_postdata($post); ?>
		<?php if($feature_count % $columns == 0 && $feature_count != 0) echo '<div class="col-divide"></div>'; $feature_count++; ?>
		<div class="feature column col<?php echo $columns; if($feature_count % $columns == 0) echo ' feature_right col-last'; ?>">
			<?php $icon = get_post_meta(get_the_ID(), 'feature_icon', true); ?>
			<div class="feature-icon primary-color">
				<?php echo $icon; ?>
			</div>
			<h3 class="feature-title">
				<?php the_title(); ?>
			</h3>
			<div class="feature-content"><?php the_content(); ?><?php cpotheme_edit(); ?></div>
		</div>
		<?php endforeach; ?>
		<div class='clear'></div>
	</div>
</div>
<?php endif; ?>
