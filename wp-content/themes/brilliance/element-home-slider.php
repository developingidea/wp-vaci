<?php $query = new WP_Query('post_type=cpo_slide&posts_per_page=-1&order=ASC&orderby=menu_order'); ?>
<div id="slider" class="slider secondary-color-bg">
	<?php if($query->posts): $slide_count = 0; ?>
	<div class="slider-slides" data-timeout="8000" data-speed="1500" data-effect="fade">
		<?php foreach($query->posts as $post): setup_postdata($post); ?>
		<?php $slide_count++; ?>
		<?php $image_url = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), array(1500, 7000), false, ''); ?>
		<div id="slide_<?php echo $slide_count; ?>" class="slide dark" style="background-image:url(<?php echo $image_url[0]; ?>);">
			<div class="container">
				<div class="slide-body fade-slide">
					<h2 class="slide-title">
						<?php the_title(); ?>
					</h2>
					<div class="slide-content">
						<?php the_content(); ?>
					</div>
					<?php cpotheme_edit(); ?>
				</div>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
	<?php if(sizeof($query->posts) > 1): ?>
	<div class="slider-pager fade-slide">
		<div class="container">
			<div class="slider-pages"></div>
		</div>
	</div>
	<?php endif; ?>
	<?php endif; ?>			
</div> 			
