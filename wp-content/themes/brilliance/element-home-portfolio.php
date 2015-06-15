<?php /* Displays the homepage portfolio */ ?>

<?php $query = new WP_Query('post_type=cpo_portfolio&order=ASC&orderby=menu_order&meta_key=portfolio_featured&meta_value=1&numberposts=-1&posts_per_page=-1'); ?>
<?php if($query->posts): $feature_count = 0; ?>
<div id="portfolio" class="portfolio secondary-color-bg">
	<?php $columns = 4; ?>
	<?php foreach($query->posts as $post): setup_postdata($post); ?>
	<?php $feature_count++; ?>
	<div class="column column-fit col<?php echo $columns; if($feature_count % $columns == 0 && $feature_count != 0) echo ' col-last'; ?>">
		<?php get_template_part('element', 'portfolio'); ?>
	</div>
	<?php endforeach; ?>
	<div class='clear'></div>
</div>
<?php endif; ?>
