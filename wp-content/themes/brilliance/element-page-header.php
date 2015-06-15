<?php wp_reset_query(); ?>

<?php $header_image = get_header_image(); ?>
<?php if($header_image != '') $header_image = 'style="background-image:url('.$header_image.');"'; ?>
<section id="pagetitle" class="pagetitle dark secondary-color-bg" <?php echo $header_image; ?>>
	<div class="container">
		<?php cpotheme_page_title(); ?>
		<?php cpotheme_breadcrumb(); ?>
	</div>
</section>