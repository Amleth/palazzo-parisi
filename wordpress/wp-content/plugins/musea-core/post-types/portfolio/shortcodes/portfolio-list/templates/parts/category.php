<?php if ($enable_category === 'yes') {
	$categories = wp_get_post_terms(get_the_ID(), 'portfolio-category');

	if(!empty($categories)) { ?>
		<div class="eltdf-pli-category-holder">
			<?php foreach ($categories as $cat) { ?>
				<span class="eltdf-pli-category"><?php echo esc_html($cat->name); ?></span>
			<?php } ?>
		</div>
	<?php } ?>
<?php } ?>